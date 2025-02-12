<?php

namespace App\Services;

use App\Imports\KonsulDokterImport;
use App\Imports\PeriksaDokterImport;
use App\Imports\TindakanDokterInapImport;
use App\Imports\TindakanDokterJalanImport;
use App\Imports\VisiteDokterImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

/**
 * Class Services
 * @author rivald 
 */
class TindakanDokterService
{
    public function deleteData($id, $table)
    {
        try {
            DB::table($table)
                ->where('id', $id)
                ->update([
                    'prop' => "del",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);
            return 'sukses';
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    public function getData($table)
    {
        return DB::table($table)->where('prop', " ");
    }

    public function getDataById($id, $table)
    {
        return DB::table($table)->where([
            ['id', $id],
            ['prop', ' '],
        ])->first();
    }

    public function storeData($table, $param)
    {
        $requestData = $param->except('_token'); // Mendapatkan semua data dari request

        $filteredData = array_filter($requestData, function ($value) {
            return $value !== null; // Mengembalikan true hanya untuk nilai yang tidak null
        });

        try {
            DB::table($table)->insert($filteredData);
            return 'sukses';
        } catch (Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updateData($request, $table)
    {
        try {
            DB::table($table)
                ->where('id', $request->id)
                ->update($request->except('_token', '_method'));

            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getDataRanap()
    {

        $getQuery = DB::table('smis_mjm_tindakan_dokter')
                ->select(
                    '*'
                )
                ->where("uri","=",1)
                ->get();

        return $getQuery;

    }

    public function getDataRajal()
    {

        $getQuery = DB::table('smis_mjm_tindakan_dokter')
                ->select(
                    '*'
                )
                ->where("uri","=",0)
                ->get();

        return $getQuery;

    }

    public function getSearchTindakanDokterJalan($request)
    {
        $data = DB::table('smis_mjm_tindakan_dokter')
            ->where([
                ['uri', 0],
                ['prop', ' '],
                ['nama', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['uri', 0],
                ['prop', ' '],
                ['jenis_pasien', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['uri', 0],
                ['prop', ' '],
                ['kelas', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getSearchTindakanDokterInap($request)
    {
        $data = DB::table('smis_mjm_tindakan_dokter')
            ->where([
                ['uri', 1],
                ['prop', ' '],
                ['nama', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['uri', 1],
                ['prop', ' '],
                ['jenis_pasien', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['uri', 1],
                ['prop', ' '],
                ['kelas', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getSearchKonsulDokter($request)
    {
        $data = DB::table('smis_mjm_konsul')
            ->where([
                ['prop', ' '],
                ['nama_konsul', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['prop', ' '],
                ['carabayar', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['prop', ' '],
                ['kelas', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getSearchPeriksaDokter($request)
    {
        $data = DB::table('smis_mjm_periksa')
            ->where([
                ['prop', ' '],
                ['nama_periksa', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['prop', ' '],
                ['carabayar', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['prop', ' '],
                ['kelas', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getSearchVisiteDokter($request)
    {
        $data = DB::table('smis_mjm_visite')
            ->where([
                ['prop', ' '],
                ['nama_visite', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['prop', ' '],
                ['carabayar', 'like', '%' . $request->keyword . '%']
            ])->orWhere([
                ['prop', ' '],
                ['kelas', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function importKonsulDokter($param)
    {
        try {
            Excel::import(new KonsulDokterImport, $param->file('file_csv'));
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function importTindakanDokterInap($param)
    {
        try {
            Excel::import(new TindakanDokterInapImport, $param->file('file_csv'));
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function importTindakanDokterJalan($param)
    {
        try {
            Excel::import(new TindakanDokterJalanImport, $param->file('file_csv'));
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function importPeriksaDokter($param)
    {
        try {
            Excel::import(new PeriksaDokterImport, $param->file('file_csv'));
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function importVisiteDokter($param)
    {
        try {
            Excel::import(new VisiteDokterImport, $param->file('file_csv'));
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function getKelas()
    {
        return DB::table('smis_mjm_kelas')->where('prop', '')->get();
    }

    public function getCarabayar()
    {
        return DB::table('smis_rg_jenispasien')->where('prop', '')->get();
    }
}
