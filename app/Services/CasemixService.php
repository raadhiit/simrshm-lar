<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Driver\Fpdi2Driver;
use Illuminate\Support\Facades\Cache;
use Throwable;

/**
 * Class CasemixService.
 */
class CasemixService
{
    public function getDiagnosaById($noreg = 0)
    {
        return DB::table("smis_mr_diagnosa")->where([
            ['prop', ''],
            ['noreg_pasien', $noreg]
        ])->select(
            DB::raw("CONCAT(kode_icd, ' - ', nama_icd) AS diagnosa")
        )->orderBy('id', 'DESC')
            ->value('diagnosa');
    }

    public function getAsuransiById($id = 0)
    {
        return DB::table("smis_rg_asuransi")->where([
            ['prop', ''],
            ['id', $id]
        ])->value('nama');
    }

    public function getPerusahaanById($id = 0)
    {
        return DB::table("smis_rg_perusahaan")->where([
            ['prop', ''],
            ['id', $id]
        ])->value('nama');
    }

    public function pasienData($request)
    {
        return  DB::table('smis_rg_layananpasien AS a')
            ->select(
                'a.tanggal',
                'a.tanggal_pulang',
                DB::raw("CASE WHEN a.uri = 1 THEN 'Rawat Inap' ELSE 'Rawat Jalan' END AS layanan"),
                'a.nama_pasien',
                'a.nrm',
                'a.id AS noreg',
                'a.nobpjs',
                DB::raw("CASE WHEN a.uri = 1 THEN a.no_sep_ri ELSE a.no_sep_rj END AS nomor_sep"),
                'a.last_nama_ruangan AS ruangan_akhir',
                'a.carabayar',
                'a.total_tagihan',
                'a.asuransi',
                'a.nama_perusahaan',
            )
            ->where([
                ['a.prop', ''],
            ])
            ->when(($request['mode'] ?? "") === "MRS", function ($query) use ($request) {
                $query->where(DB::raw('DATE(a.tanggal)'), '>=', date('Y-m-d', strtotime($request['dari_tanggal'])));
                $query->where(DB::raw('DATE(a.tanggal)'), '<=', date('Y-m-d', strtotime($request['sampai_tanggal'])));
            })
            ->when(($request['mode'] ?? "") === "KRS", function ($query) use ($request) {
                $query->where(DB::raw('DATE(a.tanggal)'), '>=', date('Y-m-d', strtotime($request['dari_tanggal'])));
                $query->where(DB::raw('DATE(a.tanggal)'), '<=', date('Y-m-d', strtotime($request['sampai_tanggal'])));
            })
            ->when(isset($request['urji']), function ($query) use ($request) {
                $query->where('a.uri', $request['urji']);
            })
            ->when(isset($request['carabayar']), function ($query) use ($request) {
                $query->where('a.carabayar', $request['carabayar']);
            })
            ->when(isset($request['asuransi']), function ($query) use ($request) {
                $query->where('a.asuransi', $request['asuransi']);
            })
            ->when(isset($request['perusahaan']), function ($query) use ($request) {
                $query->where('a.nama_perusahaan', $request['perusahaan']);
            })
            ->when(isset($request['ruangan']), function ($query) use ($request) {
                $query->where('a.last_nama_ruangan', $request['ruangan']);
            })
            ->when($request['search'] ?? "", function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    return $query->where('a.nrm', $search)
                        ->orWhere('a.id', $search)
                        ->orWhere('a.nobpjs', $search)
                        ->orWhere(DB::raw("CASE WHEN a.uri = 1 THEN a.no_sep_ri ELSE a.no_sep_rj END"), $search)
                        ->orWhere('a.nama_pasien', 'like', "%{$search}%");
                });
            })
            ->groupBy('a.id')
            ->orderBy('a.id', 'DESC')
            ->paginate(10);
    }

    public function queryFilter()
    {
        // Cache for 'caraBayar', expire in 1 month (43,200 minutes)
        $caraBayar = Cache::remember('caraBayar', 43200, function () {
            return DB::table('smis_rg_layananpasien')
                ->where('prop', '')
                ->distinct('carabayar')
                ->pluck('carabayar');
        });

        // Cache for 'asuransi', expire in 1 month (43,200 minutes)
        $asuransi = Cache::remember('asuransi', 43200, function () {
            return DB::table('smis_rg_asuransi')
                ->where('prop', '')
                ->select('nama', 'id')
                ->get();
        });

        // Cache for 'perusahaan', expire in 1 month (43,200 minutes)
        $perusahaan = Cache::remember('perusahaan', 43200, function () {
            return DB::table('smis_rg_perusahaan')
                ->where('prop', '')
                ->select('nama', 'id')
                ->get();
        });

        // Cache for 'ruangan', expire in 1 month (43,200 minutes)
        $ruangan = Cache::remember('ruangan', 43200, function () {
            return DB::table('smis_adm_prototype')
                ->where('prop', '')
                ->where('status', 'actived')
                ->select('nama', 'id', 'slug')
                ->get();
        });

        return [
            'carabayar' => $caraBayar,
            'asuransi' => $asuransi,
            'perusahaan' => $perusahaan,
            'ruangan' => $ruangan
        ];
    }

    public function checkCasemixFolder($noreg): array
    {
        $path = env('CASEMIX_PATH') . "/files/shares/" . $noreg;
        if (file_exists($path)) {
            $files = File::files($path);
            if (count($files) > 0) {
                $data = [];
                foreach ($files as $file) {
                    array_push($data, $file->getFilename());
                }
                return [
                    'noreg' => $noreg,
                    'status' => true,
                    'message' => 'Files ditemukan',
                    'data' => $data
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Files tidak ditemukan'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Directory tidak ditemukan'
            ];
        }
    }

    public function uploadManualFile($request)
    {
        // Proses upload
        if ($request->file('upload_file')) {
            $file = $request->file('upload_file');

            $fileName = $request->document_code .
                '_' .
                $request->name_document .
                "." .
                $file->getClientOriginalExtension();

            $path = env('CASEMIX_PATH') . "/files/shares/" . $request->noreg;
            $file->move($path, $fileName);

            // Return response
            return [
                'status' => 'success',
                'message' => 'File uploaded successfully',
                'noreg' => $request->noreg,
                'code' => 201
            ];
        }

        return [
            'status' => 'error',
            'message' => 'File not uploaded',
            'code' => 400
        ];
    }

    public function mergeDocument($id = null): array
    {
        $path = env('CASEMIX_PATH') . "/files/shares/" . $id;

        if (!File::exists($path)) {
            return [
                'status' => 'error',
                'message' => 'Folder not found.',
                'code' => 404
            ];
        }

        $pdfFiles = File::files($path);

        $merger = new Merger(new Fpdi2Driver());

        for ($i = 1; $i <= 36; $i++) {
            foreach ($pdfFiles as $pdf) {
                $fileNumber = (int)preg_replace('/[^0-9]/', '', strtok($pdf->getFilename(), '_'));

                if ($fileNumber === $i) {
                    //$testFileNumber[] = $fileNumber . $pdf->getRealPath();
                    $merger->addFile($pdf->getRealPath());
                    continue;
                }
            }
        }

        $createdPdf = $merger->merge();

        try {
            $createdPdf = $merger->merge();
            file_put_contents($path . '/document_merged.pdf', $createdPdf);
            return [
                'status' => 'success',
                'message' => 'Success merged',
                'file' =>$path  . '/document_merged.pdf',
                'code' => 200
            ];
        } catch (Throwable $e) {
            return [
                'status' => 'success',
                'message' => $e->getMessage(),
                'code' => 500
            ];
        }
    }
}
