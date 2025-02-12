<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\CheckinController;
use App\Models\JadwalPoli;
use Illuminate\Support\Facades\Validator;
use App\Models\RsCredential;
use GuzzleHttp\Client;
use App\Models\Propinsi;
use App\Http\Requests\MjknPatientRequest;
use App\Services\AntrianPendaftaranService;
use Auth;

class AntrianPendaftaranController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'antrian')) {
                $arr = (array) $menu->antrian;
                if ($arr['pendaftaran'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function mjkn_patient_update(MjknPatientRequest $req, AntrianPendaftaranService $aps)
    {
        try {
            $aps->update_mjkn_patient($req);

            // return redirect('antrian/pendaftaran')->with('berhasil', 'Pasien MJKN berhasil diperbarui');
            return response()->json([
                'status' => true,
                'message' => 'Pasien MJKN berhasil diperbarui'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function pasien_mjkn_daftar(Request $req, AntrianPendaftaranService $aps)
    {
        try {
            $aps->pasien_mjkn_daftar($req->pasien);
            return response()->json([
                'status' => true,
                'message' => 'Pendaftaran pasien berhasil'
            ]);
            // return redirect('antrian/pendaftaran')->with('berhasil', 'Pendaftaran pasien berhasil');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function index()
    {
        $data['propinsi'] = Propinsi::all();
        return view('antrian.pendaftaran', $data);
    }

    function layani_antrian(Request $req)
    {
        try {
            $antrian = Antrian::findOrFail($req->id);

            $waktu = strtotime(now()) . '000';

            $obj_bpjs = new CheckinController();
            $hit_bpjs = $obj_bpjs->update_waktu_antrian(2, $antrian->kodebooking, $waktu);

            Antrian::where('id', $req->id)->update([
                'taskid' => 2,
                'waktu_taskid_dua' => $waktu
            ]);
            return response()->json([
                'status' => true,
                'message' => $hit_bpjs['message']
            ]);
            // return redirect('antrian/pendaftaran')->with('berhasil', $hit_bpjs['message']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function selesai_antrian(Request $req)
    {
        try {
            $antrian = Antrian::findOrFail($req->id);

            $waktu = strtotime(now()) . '000';

            $obj_bpjs = new CheckinController();
            $hit_bpjs = $obj_bpjs->update_waktu_antrian(3, $antrian->kodebooking, $waktu);

            Antrian::where('id', $req->id)->update([
                'taskid' => 3,
                'waktu_taskid_tiga' => $waktu
            ]);
            return response()->json([
                'status' => true,
                'message' => $hit_bpjs['message']
            ]);
            // return redirect('antrian/pendaftaran')->with('berhasil', $hit_bpjs['message']);
            //code...
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    function ajax_request_antrian(Request $req)
    {
        $query = Antrian::leftJoin('smis_rg_patient', 'smis_rg_patient.id', 'antrians.norm')
            ->select('antrians.*', 'smis_rg_patient.nama as pasien', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.ktp', 'smis_rg_patient.nobpjs')
            ->where('smis_rg_patient.prop', '')
            ->where('taskid', '!=', 99)
            ->orderBy('waktu_checkin');

        if ($req->cari_keyword != '') {
            $key = $req->cari_keyword;
            $query->where(function ($q) use ($key) {
                $q->where('smis_rg_patient.nama', 'like', '%' . $key . '%')->orWhere('antrians.norm', 'like', '%' . $key . '%');
            });
        }

        if(isset($req->cari_tanggal)){
            $query->where('tanggalperiksa', $req->cari_tanggal);
        }

        $data = $query->get();
        return response()->json($data);
    }

    function batal_antrian(Request $req)
    {
        $antrian = Antrian::findOrFail($req->id);
        $v = Validator::make($req->all(), [
            'keterangan' => 'required'
        ], [
            'keterangan.required' => 'Alasan melakukan batal antrian harus diisi'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        try {
            $client = new Client([
                'verify' => false
            ]);

            $credentials = RsCredential::where('layanan', 'antrian')->first();

            if (is_null($credentials)) {
                return redirect()->back()->with('gagal', 'RS Credential tidak valid');
            }

            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);

            $response = $client->request('post', $credentials->base_url . '/antrean/batal', [
                'headers' => [
                    'x-cons-id'     => $credentials->cons_id,
                    'x-timestamp'  => $timeStamp,
                    'x-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ],
                'body' => json_encode([
                    "kodebooking" => $antrian->kodebooking,
                    "keterangan" => $req->keterangan
                ])
            ])->getBody()->getContents();

            $result = json_decode($response);

            if ($result->metadata->code == 200) {
                $cek = Antrian::where('id', $req->id)->first();
                $ant = Antrian::where('jadwal_id', $cek->jadwal_id)->orderBy('id', 'desc')->first();
                $sebelum = Antrian::where('jadwal_id', $cek->jadwal_id)->where('tanggalperiksa', $cek->tanggalperiksa)->where('angkaantrean', '<', $cek->angkaantrean)->where('taskid', '!=', 99)->orderBy('id', 'desc')->first();
                $jadwal = JadwalPoli::where('id', $cek->jadwal_id)->first();

                if ($cek->angkaantrean == $ant->angkaantrean) {
                    if (!is_null($sebelum)) {
                        // dd('batal terakhir, data lebih dari 1');
                        if ($sebelum->sisakuotajkn == $cek->sisakuotajkn) {
                            Antrian::where('kodebooking', $cek->kodebooking)->update([
                                'sisakuotanonjkn' => $cek->sisakuotanonjkn + 1
                            ]);
                        } else {
                            Antrian::where('kodebooking', $cek->kodebooking)->update([
                                'sisakuotajkn' => $cek->sisakuotajkn + 1
                            ]);
                        }
                    } else {
                        // dd('batal terakhir, data cuman 1');
                        if ($jadwal->kuota_jkn == $cek->sisakuotajkn) {
                            Antrian::where('kodebooking', $cek->kodebooking)->update([
                                'sisakuotanonjkn' => $cek->sisakuotanonjkn + 1
                            ]);
                        } else {
                            Antrian::where('kodebooking', $cek->kodebooking)->update([
                                'sisakuotajkn' => $cek->sisakuotajkn + 1
                            ]);
                        }
                    }
                } else {
                    // return $this->responseFormat('yang dibatal bukan terakhir');
                    // dd('batal bukan terakhir');
                    if ($cek->sisakuotajkn == $ant->sisakuotajkn) {
                        Antrian::where('kodebooking', $ant->kodebooking)->update([
                            'sisakuotajkn' => $ant->sisakuotajkn + 1
                        ]);
                    } else {
                        Antrian::where('kodebooking', $ant->kodebooking)->update([
                            'sisakuotanonjkn' => $ant->sisakuotanonjkn + 1
                        ]);
                    }
                }
                // exit();
                Antrian::where('id', $req->id)->update([
                    'taskid' => 99
                ]);
                return redirect('antrian/pendaftaran')->with('berhasil', 'Ok');
            }

            return redirect('antrian/pendaftaran')->with('gagal', 'Gagal');
        } catch (\Throwable $th) {
            return redirect('antrian/pendaftaran')->with('gagal', $th->getMessage());
        }
    }
}
