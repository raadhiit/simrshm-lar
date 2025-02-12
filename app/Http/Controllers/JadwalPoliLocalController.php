<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalPoliRequest;
use Illuminate\Http\Request;
use App\Models\ReferensiDokter;
use App\Models\ReferensiPoli;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use App\Models\JadwalPoli;
use App\Models\RsCredential;
use Illuminate\Support\Facades\Validator;
use DB;
use GuzzleHttp\Client;
use Auth;

class JadwalPoliLocalController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'jadwal_poli')) {
                $arr = (array) $menu->jadwal_poli;
                if ($arr['local'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index(Request $req)
    {
        $data['poli'] = ReferensiPoli::all();
        $data['dokter'] = ReferensiDokter::all();
        $data['dokter_local'] = SmisHrdEmployee::where('jabatan', 1)->select('id', 'nama')->get();

        $poli_local = [];
        $proto = SmisAdmPrototype::where('parent', 'rawat')->where('prop', '<>', 'del')->get();
        foreach ($proto as $pro) {
            $cek = SmisAdmSettings::where('name', 'smis-rs-urjip-' . $pro->slug)->select('value')->first();
            if ($cek) {
                if ($cek->value == 'URJ') {
                    array_push($poli_local, $pro);
                }
            }
        }
        $data['poli_local'] = $poli_local;
        $query = JadwalPoli::select('*');
        if ($req->keyword && $req->keyword != '') {
            $query->where('nama_poli', 'like', '%'.$req->keyword.'%')->orWhere('nama_dokter', 'like', '%'.$req->keyword.'%');
        }
        $data['data'] = $query->paginate(10)->setPath('?keyword='.($req->keyword ? $req->keyword : ''));
        $data['keyword'] = $req->keyword;
        return view('jadwal_poli.local', $data);
    }

    function ajax_request_select_jadwal_poli(Request $req)
    {
        $data = JadwalPoli::findOrFail($req->id);
        return response()->json($data);
    }

    function post_jadwal_poli(JadwalPoliRequest $req)
    {
        $dok = explode('-', $req->dokter);
        $poli = explode('-', $req->poli);
        try {
            $ins = DB::table('smis_rg_jadwal_poli')->insert([
                'display' => $req->display ? $req->display : '',
                'poli_ke' => $req->poli_ke ? $req->poli_ke : '',
                'kuota_non_jkn' => $req->kuota_non_jkn,
                'kuota_jkn' => $req->kuota_jkn,
                'kodepoli_bpjs' => $req->poli_bpjs,
                'kodesubspesialis_bpjs' => $req->kode_sub,
                'kodedokter_bpjs' => $req->dokter_bpjs,
                'prop' => '',
                'nama_poli' => $poli[0],
                'slug_poli' => $poli[1],
                'nama_dokter' => $dok[1],
                'id_dokter' => $dok[0],
                'jam_mulai' => $req->jam_mulai,
                'jam_selesai' => $req->jam_selesai,
                'hari' => $req->hari,
                'estimasi_layanan' => $req->estimasi,
                'bobot' => 0,
                'autonomous' => '',
                'duplicate' => 0,
                'origin' => '',
                'origin_id' => 0,
                'time_updated' => date('Y-m-d H:i:s'),
                'origin_updated' => '',
            ]);

            // if ($ins) {
            //     $credentials = RsCredential::where('layanan', 'antrian')->first();
            //     if ($credentials == null) {
            //         return redirect('jadwal_poli/local')->with('sukses', 'Jadwal poli berhasil ditambahkan, gagal update ke BPJS (credential salah)');
            //     };
            //     date_default_timezone_set('UTC');
            //     $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            //     $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
            //     $client = new Client([
            //         'verify' => false
            //     ]);

            //     $jad = json_encode([
            //         'hari' => $req->hari,
            //         'buka' => $req->jam_mulai,
            //         'tutup' => $req->jam_selesai
            //     ]);

            //     $response = $client->request('post', $credentials->base_url . '/jadwaldokter/updatejadwaldokter', [
            //         'headers' => [
            //             'x-cons-id'     => $credentials->cons_id,
            //             'x-timestamp'  => $timeStamp,
            //             'x-signature'   => $signature,
            //             'user_key' => $credentials->user_key,
            //         ],
            //         'body' => json_encode([
            //             'kodepoli' => $req->poli_bpjs,
            //             'kodesubspesialis' => $req->kode_sub,
            //             'kodedokter' => $req->dokter_bpjs,
            //             'jadwal' => [json_decode($jad)]
            //         ])
            //     ])->getBody()->getContents();

            //     $body = json_decode($response);
            //     if ($body->metadata->code == 200) {
                    return redirect('jadwal_poli/local')->with('sukses', 'Jadwal poli berhasil ditambahkan');
            //     } else {
            //         return redirect('jadwal_poli/local')->with('sukses', 'Jadwal poli berhasil ditambahkan, gagal update ke server BPJS (' . $body->metadata->message . ')');
            //     }
            // } else {
            //     return redirect('jadwal_poli/local')->with('gagal', 'Jadwal poli gagal ditambahkan');
            // }
        } catch (\Throwable $th) {
            return redirect('jadwal_poli/local')->with('gagal', $th->getMessage());
        }
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    function update_jadwal_poli(JadwalPoliRequest $req)
    {
        $dok = explode('-', $req->dokter);
        $poli = explode('-', $req->poli);
        try {
            $ins = DB::table('smis_rg_jadwal_poli')->where('id', $req->id)->update([
                'display' => $req->display ? $req->display : '',
                'poli_ke' => $req->poli_ke ? $req->poli_ke : '',
                'kuota_non_jkn' => $req->kuota_non_jkn,
                'kuota_jkn' => $req->kuota_jkn,
                'kodepoli_bpjs' => $req->poli_bpjs,
                'kodesubspesialis_bpjs' => $req->kode_sub,
                'kodedokter_bpjs' => $req->dokter_bpjs,
                'prop' => '',
                'nama_poli' => $poli[0],
                'slug_poli' => $poli[1],
                'nama_dokter' => $dok[1],
                'id_dokter' => $dok[0],
                'jam_mulai' => $req->jam_mulai,
                'jam_selesai' => $req->jam_selesai,
                'hari' => $req->hari,
                'estimasi_layanan' => $req->estimasi,
                'bobot' => 0,
                'autonomous' => '',
                'duplicate' => 0,
                'origin' => '',
                'origin_id' => 0,
                'time_updated' => date('Y-m-d H:i:s'),
                'origin_updated' => '',
            ]);

            // if ($ins) {
            //     $credentials = RsCredential::where('layanan', 'antrian')->first();
            //     if ($credentials == null) {
            //         return redirect('jadwal_poli/local')->with('sukses', 'Jadwal poli berhasil diubah, gagal update ke BPJS (credential salah)');
            //     };
            //     date_default_timezone_set('UTC');
            //     $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            //     $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
            //     $client = new Client([
            //         'verify' => false
            //     ]);

            //     $jad = json_encode([
            //         'hari' => $req->hari,
            //         'buka' => $req->jam_mulai,
            //         'tutup' => $req->jam_selesai
            //     ]);

            //     $response = $client->request('post', $credentials->base_url . '/jadwaldokter/updatejadwaldokter', [
            //         'headers' => [
            //             'x-cons-id'     => $credentials->cons_id,
            //             'x-timestamp'  => $timeStamp,
            //             'x-signature'   => $signature,
            //             'user_key' => $credentials->user_key,
            //         ],
            //         'body' => json_encode([
            //             'kodepoli' => $req->poli_bpjs,
            //             'kodesubspesialis' => $req->kode_sub,
            //             'kodedokter' => $req->dokter_bpjs,
            //             'jadwal' => [json_decode($jad)]
            //         ])
            //     ])->getBody()->getContents();

            //     $body = json_decode($response);
            //     if ($body->metadata->code == 200) {
                    return redirect('jadwal_poli/local')->with('sukses', 'Jadwal poli berhasil diubah');
            //     } else {
            //         return redirect('jadwal_poli/local')->with('sukses', 'Jadwal poli berhasil diubah, gagal update ke server BPJS (' . $body->metadata->message . ')');
            //     }
            // } else {
            //     return redirect('jadwal_poli/local')->with('gagal', 'Jadwal poli gagal diubah');
            // }
        } catch (\Throwable $th) {
            return redirect('jadwal_poli/local')->with('gagal', $th->getMessage());
        }
    }

    function delete_jadwal_poli(Request $req)
    {
        $poli = JadwalPoli::findOrFail($req->id);
        try {
            $poli->delete();
            return redirect('jadwal_poli/local')->with('sukses', 'Jadwal poli berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('jadwal_poli/local')->with('gagal', $th->getMessage());
        }
    }
}
