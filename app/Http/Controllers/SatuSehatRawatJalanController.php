<?php

namespace App\Http\Controllers;

use App\Exports\FailedSatuSehatRawatJalanExport;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Services\SatuSehatEncounterService;
use App\Services\SatuSehatService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SatuSehatRawatJalanController extends Controller
{
    function index()
    {
        return view('satu_sehat.rawat_jalan.index', ['datas' => [], 'all_data' => null]);
    }

    function filter(Request $req)
    {
        /*$query = SMIS_LayananPasien::leftJoin('smis_mr_diagnosa', 'smis_mr_diagnosa.noreg_pasien', 'smis_rg_layananpasien.id')
            ->where(function ($q) use ($req) {
                $q->whereDate('smis_rg_layananpasien.tanggal', '>=', $req->dari)->whereDate('smis_rg_layananpasien.tanggal', '<=', $req->sampai);
            })->where('smis_rg_layananpasien.prop', '')->where('smis_rg_layananpasien.uri', 0)->where('status_ss', 0)
            ->where('selesai', 1)->where(function($z){
                $z->where('smis_rg_layananpasien.carapulang','!=','Tidak Datang')->where('smis_rg_layananpasien.carapulang','!=','Rawat Inap');
            })
            ->select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.last_nama_ruangan',
                'smis_rg_layananpasien.tanggal',
                'smis_rg_layananpasien.status_ss',
                'smis_mr_diagnosa.diagnosa',
            )->get();
        return response()->json($query); */

        $query = SMIS_LayananPasien::whereNotIn('carapulang', ['Tidak Datang', 'Rawat Inap'])
            ->join('smis_rg_patient', 'smis_rg_layananpasien.nrm', 'smis_rg_patient.id')
            ->where([
                ['smis_rg_patient.prop', ''],
                ['smis_rg_layananpasien.prop', ''],
                ['uri', 0],
                ['selesai', 1],
                [DB::raw('date(smis_rg_layananpasien.tanggal)'), '>=', $req->dari],
                [DB::raw('date(smis_rg_layananpasien.tanggal)'), '<=', $req->sampai]
            ])
            ->select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.last_nama_ruangan',
                'smis_rg_layananpasien.tanggal',
                'smis_rg_layananpasien.status_ss'
            )
            ->get();

        $noregValues = $query->pluck('id');

        // Retrieve the diagnostic data
        $diagnosa = DB::table('smis_mr_diagnosa')
            ->where('prop', '')
            ->whereIn('noreg_pasien', $noregValues)
            ->select('noreg_pasien', 'nama_icd')
            ->get()
            ->keyBy('noreg_pasien');

        // Merge the diagnostic data back into the main results
        $results = $query->map(function ($item) use ($diagnosa) {
            $noreg = $item->id;
            if (isset($diagnosa[$noreg])) {
                $item->diagnosa = $diagnosa[$noreg]->nama_icd;
            } else {
                $item->diagnosa = null;
            }
            return $item;
        });

        return response()->json($results);
    }

    function datatable(Request $req)
    {
        $query = SMIS_LayananPasien::whereNotIn('carapulang', ['Tidak Datang', 'Rawat Inap'])
            ->join('smis_rg_patient', 'smis_rg_layananpasien.nrm', 'smis_rg_patient.id')
            ->where([
                ['smis_rg_patient.prop', ''],
                ['smis_rg_layananpasien.prop', ''],
                ['uri', 0],
                ['selesai', 1],
                [DB::raw('date(smis_rg_layananpasien.tanggal)'), '>=', $req->dari],
                [DB::raw('date(smis_rg_layananpasien.tanggal)'), '<=', $req->sampai],
            ])
            ->when($req->search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('smis_rg_layananpasien.nrm', 'like', "%{$search}%")
                        ->orWhere('smis_rg_layananpasien.id', 'like', "%{$search}%")
                        ->orWhere('smis_rg_layananpasien.nama_pasien', 'like', "%{$search}%");
                });
            })
            ->select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.last_nama_ruangan',
                'smis_rg_layananpasien.tanggal',
                'smis_rg_layananpasien.tanggal_pulang',
                'smis_rg_layananpasien.ktp',
                'smis_rg_layananpasien.status_ss',
                'smis_rg_layananpasien.jenislayanan',
                'smis_rg_layananpasien.response_code_satu_sehat',
                'smis_rg_layananpasien.response_message_satu_sehat',
                'smis_rg_patient.ihs_number'
            )
            ->paginate(10);

        $noregValues = $query->pluck('id');

        // Retrieve the diagnostic data
        $diagnosa = DB::table('smis_mr_diagnosa')
            ->where('prop', '')
            ->whereIn('noreg_pasien', $noregValues)
            ->select('noreg_pasien', 'nama_icd', 'nama_dokter')
            ->get()
            ->keyBy('noreg_pasien');

        // Merge the diagnostic data back into the main results
        $results = $query->getCollection()->map(function ($item) use ($diagnosa) {
            $noreg = $item->id;
            if (isset($diagnosa[$noreg])) {
                $item->nama_icd = $diagnosa[$noreg]->nama_icd;
                $item->nama_dokter = $diagnosa[$noreg]->nama_dokter;
            } else {
                $item->nama_icd = null;
                $item->nama_dokter = null;
            }
            return $item;
        });

        $paginatedResults = new LengthAwarePaginator(
            $results,
            $query->total(),
            $query->perPage(),
            $query->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view("satu_sehat.rawat_jalan.index", [
            'datas' => $paginatedResults,
            'date_filter' => ['dari' => $req->dari, 'sampai' => $req->sampai]
        ]);
    }

    function send(Request $req, SatuSehatEncounterService $sses, SatuSehatService $sss)
    {
        try {
            $kunjungan = SMIS_LayananPasien::where('id', $req->id)->first();
            $pasien = SMIS_Pasien::where('id', $kunjungan->nrm)->where('prop', '')->first();

            $get_ihs = $sss->get(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Patient?identifier=https://fhir.kemkes.go.id/id/nik|' . $pasien->ktp);

            if ($pasien->ihs_number != '') {
                $data = $sses->bundle($kunjungan);

                $result = $sss->post(env('SATU_SEHAT_URL') . '/fhir-r4/v1', json_encode($data));
                // dd(json_decode($result->getBody()->getContents()));

                if ($result->getStatusCode() == 401) {
                    $autentikasi = json_decode($sss->auth());
                    Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
                    $result = $sss->post(env('SATU_SEHAT_URL') . '/fhir-r4/v1', json_encode($data));
                }

                if ($result->getStatusCode() == 200) {
                    $data = json_decode($result->getBody()->getContents());
                    if (isset($data->entry[0])) {

                        DB::table('smis_rg_layananpasien')->where('id', $req->id)->update([
                            'status_ss' => 1,
                            'id_encounter' => $data->entry[0]->response->resourceID
                        ]);
                    }
                    if (isset($data->entry[1])) {
                        DB::table('smis_mr_diagnosa')->where('noreg_pasien', $req->id)->update([
                            'id_diagnosa_primer' => $data->entry[1]->response->resourceID
                        ]);
                    }
                    if (isset($data->entry[2])) {
                        DB::table('smis_mr_diagnosa')->where('noreg_pasien', $req->id)->update([
                            'id_diagnosa_sekunder1' => $data->entry[2]->response->resourceID
                        ]);
                    }
                    if (isset($data->entry[3])) {
                        DB::table('smis_mr_diagnosa')->where('noreg_pasien', $req->id)->update([
                            'id_diagnosa_sekunder2' => $data->entry[3]->response->resourceID
                        ]);
                    }
                    if (isset($data->entry[4])) {
                        DB::table('smis_mr_diagnosa')->where('noreg_pasien', $req->id)->update([
                            'id_diagnosa_sekunder3' => $data->entry[4]->response->resourceID
                        ]);
                    }
                    if (isset($data->entry[5])) {
                        DB::table('smis_mr_diagnosa')->where('noreg_pasien', $req->id)->update([
                            'id_diagnosa_sekunder4' => $data->entry[5]->response->resourceID
                        ]);
                    }
                    if (isset($data->entry[6])) {
                        DB::table('smis_mr_diagnosa')->where('noreg_pasien', $req->id)->update([
                            'id_diagnosa_sekunder5' => $data->entry[6]->response->resourceID
                        ]);
                    }
                } else if ($result->getStatusCode() == 400) {
                    $err = json_decode($result->getBody()->getContents());
                    $temp = '';
                    for ($i = 0; $i < sizeof($err->issue); $i++) {
                        if ($i == 0) {
                            $temp .= isset($err->issue[$i]->details->text) ? $err->issue[$i]->details->text . '(' . (isset($err->issue[$i]->expression) ? $err->issue[$i]->expression[0] : (isset($err->issue[$i]->diagnostics) ? $err->issue[$i]->diagnostics : '-')) . ')' : '';
                        } else {
                            $temp .= isset($err->issue[$i]->details->text) ? ', ' . $err->issue[$i]->details->text . '(' . (isset($err->issue[$i]->expression) ? $err->issue[$i]->expression[0] : (isset($err->issue[$i]->diagnostics) ? $err->issue[$i]->diagnostics : '-')) . ')' : '';
                        }
                    }
                    DB::table('smis_rg_layananpasien')->where('id', $req->id)->update([
                        'response_code_satu_sehat' => $result->getStatusCode(),
                        'response_message_satu_sehat' => $temp
                    ]);
                }

                return response()->json([
                    'code' => $result->getStatusCode(),
                    'status' => true,
                    'message' => $result->getReasonPhrase()
                ]);
            } else {
                DB::table('smis_rg_layananpasien')->where('id', $req->id)->update([
                    'response_code_satu_sehat' => 500,
                    'response_message_satu_sehat' => 'IHS Number Pasien Kosong'
                ]);
            }

            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => 'IHS Number Pasien Kosong'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function export(Request $req)
    {
        return Excel::download(new FailedSatuSehatRawatJalanExport($req), 'Data_gagal_kirim_satu_sehat_tanggal_' . date('d_m_y', strtotime($req->from)) . '_sampai_' . date('d_m_y', strtotime($req->to)) . '.xlsx');
    }
}
