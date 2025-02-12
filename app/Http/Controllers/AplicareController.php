<?php

namespace App\Http\Controllers;

use App\Models\AvailableBed;
use App\Models\RsCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use DB;
use Auth;

class AplicareController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'aplicare')) {
                $arr = (array) $menu->aplicare;
                if (request()->segment(2) == 'aplicare') { 
                    if ($arr['aplicare'] == 0) {
                        return redirect('home');
                    }
                }
                if (request()->segment(2) == 'credentials') { 
                    if ($arr['credentials'] == 0) {
                        return redirect('home');
                    }
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function kamar_tersedia()
    {
        $data['available_beds'] = DB::table('available_beds')->where('deleted_at', null)->paginate(10);
        return view('aplicare.kamar_tersedia', $data);
    }

    function credentials()
    {
        $data['data'] = RsCredential::where('layanan', 'aplicare')->first();
        return view('aplicare.credentials', $data);
    }

    function post_credentials(Request $req)
    {
        $v = Validator::make($req->all(), [
            'cons_id' => 'required',
            'cons_secret' => "required",
            'user_key' => 'required',
            'nama_rs' => 'required',
            'kode_ppk' => "required"
        ]);

        if ($v->fails()) {
            $data['status'] = false;
            $data['errors'] = $v->getMessageBag()->toArray();
            return response()->json($data);
        }

        try {
            $data = RsCredential::first();
            if ($data) {
                RsCredential::where('id', $data->id)->update([
                    'cons_id' => $req->cons_id,
                    'cons_secret' => $req->cons_secret,
                    'user_key' => $req->user_key,
                    'nama_rs' => $req->nama_rs,
                    'layanan' => 'aplicare',
                    'kode_ppk' => $req->kode_ppk,
                ]);
            } else {
                RsCredential::create([
                    'cons_id' => $req->cons_id,
                    'cons_secret' => $req->cons_secret,
                    'user_key' => $req->user_key,
                    'nama_rs' => $req->nama_rs,
                    'layanan' => 'aplicare',
                    'kode_ppk' => $req->kode_ppk,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Credentials saved successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something wrong'
            ]);
        }
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);

        return $encodedSignature;
    }

    function display(){
        $data['beds'] = AvailableBed::select('namakelas',DB::raw('SUM(kapasitas) as total'), DB::raw('SUM(tersedia) as total_tersedia'))->where('namakelas','!=','')->groupBy('namakelas')->get();
        // dd($data['beds']);
        return view('aplicare.display', $data);
    }

    function available_beds(Request $req)
    {
        $credentials = RsCredential::where('layanan', 'aplicare')->first();
        if ($credentials == null) {
            return response()->json([
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ]);
        }
        try {
            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
            $guzzleClient = new Client([
                'verify' => false
            ]);
            $response = $guzzleClient->request('get', 'https://apijkn.bpjs-kesehatan.go.id/aplicaresws/rest/bed/read/' . $credentials->kode_ppk . '/1'.'/'.$req->limit, [
                'headers' => [
                    'X-cons-id'     => $credentials->cons_id,
                    'X-timestamp'  => $timeStamp,
                    'X-signature'   => $signature,
                    'Content-Type: Application/JSON',
                    'Accept: Application/JSON',
                ]
            ]);
            return response()->json([
                'status' => true,
                'data' => $response->getBody()->getContents()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function create_beds()
    {
        $credentials = RsCredential::where('layanan', 'aplicare')->first();
        if ($credentials == null) {
            return response()->json([
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ]);
        }

        $berhasil = 0;

        try {
            $selected = DB::table('available_beds')->select('id', 'kodekelas', 'namakelas', 'koderuang', 'namaruang', 'kapasitas', 'tersedia', 'tersediapria', 'tersediawanita', 'tersediapriawanita')
            ->where('created_at', null)
            ->get();
            // return response()->json($selected[0]);
            if (sizeof($selected) == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang bisa di create ke BPJS'
                ]);
            }
            for ($i = 0; $i < sizeof($selected); $i++) {
                date_default_timezone_set('UTC');
                $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
                $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
                $guzzleClient = new Client([
                    'verify' => false
                ]);
                $response = $guzzleClient->request('post', 'https://apijkn.bpjs-kesehatan.go.id/aplicaresws/rest/bed/create/' . $credentials->kode_ppk, [
                    'headers' => [
                        'X-cons-id'     => $credentials->cons_id,
                        'X-timestamp'  => $timeStamp,
                        'X-signature'   => $signature,
                        'Content-Type: Application/JSON',
                        'Accept: Application/JSON',
                    ],
                    'body' => json_encode([
                        'kodekelas' => $selected[$i]->kodekelas,
                        'namakelas' => $selected[$i]->namakelas,
                        'namaruang' => $selected[$i]->namaruang,
                        'koderuang' => $selected[$i]->koderuang,
                        'kapasitas' => $selected[$i]->kapasitas,
                        'tersedia' => $selected[$i]->tersedia,
                        'tersediapria' => $selected[$i]->tersediapria,
                        'tersediawanita' => $selected[$i]->tersediawanita,
                        'tersediapriawanita' => $selected[$i]->tersediapriawanita,
                    ])
                ]);
                $waktu = date('Y-m-d H:i:s', strtotime('+7 hours'));
                if ($response->getStatusCode() == 200) {
                    DB::table('available_beds')->where('id', $selected[$i]->id)->update([
                        'created_at' => $waktu,
                        'updated_at' => $waktu
                    ]);
                    $berhasil++;
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Create beds berhasil ' . $berhasil . ' dari ' . sizeof($selected)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function update_beds()
    {
        $credentials = RsCredential::where('layanan', 'aplicare')->first();
        if ($credentials == null) {
            return response()->json([
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ]);
        }

        $berhasil = 0;

        try {
            $selected = DB::table('available_beds')->select('id', 'kodekelas', 'koderuang', 'namaruang', 'kapasitas', 'tersedia', 'tersediapria', 'tersediawanita', 'tersediapriawanita')
            ->where('updated_at', '<>', null)->where('deleted_at', null)
            ->get();
            // return response()->json($selected[0]);
            if (sizeof($selected) == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang bisa di update ke BPJS'
                ]);
            }
            for ($i = 0; $i < sizeof($selected); $i++) {
                date_default_timezone_set('UTC');
                $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
                $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
                $guzzleClient = new Client([
                    'verify' => false
                ]);
                $response = $guzzleClient->request('post', 'https://apijkn.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/' . $credentials->kode_ppk, [
                    'headers' => [
                        'X-cons-id'     => $credentials->cons_id,
                        'X-timestamp'  => $timeStamp,
                        'X-signature'   => $signature,
                        'Content-Type: Application/JSON',
                        'Accept: Application/JSON',
                    ],
                    'body' => json_encode([
                        'kodekelas' => $selected[$i]->kodekelas,
                        'namaruang' => $selected[$i]->namaruang,
                        'koderuang' => $selected[$i]->koderuang,
                        'kapasitas' => $selected[$i]->kapasitas,
                        'tersedia' => $selected[$i]->tersedia,
                        'tersediapria' => $selected[$i]->tersediapria,
                        'tersediawanita' => $selected[$i]->tersediawanita,
                        'tersediapriawanita' => $selected[$i]->tersediapriawanita,
                    ])
                ]);
                if ($response->getStatusCode() == 200) {
                    DB::table('available_beds')->where('id', $selected[$i]->id)->update([
                        'updated_at' => date('Y-m-d H:i:s', strtotime('+7 hours'))
                    ]);
                    $berhasil++;
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Update beds berhasil ' . $berhasil . ' dari ' . sizeof($selected)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function delete_beds()
    {
        $credentials = RsCredential::where('layanan', 'aplicare')->first();
        if ($credentials == null) {
            return response()->json([
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ]);
        }

        $berhasil = 0;

        try {
            $selected = DB::table('available_beds')->select('id', 'kodekelas', 'koderuang', 'namaruang', 'kapasitas', 'tersedia', 'tersediapria', 'tersediawanita', 'tersediapriawanita')
            ->where('deleted_at', '<>', null)
            ->get();
            // return response()->json($selected[0]);
            if (sizeof($selected) == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang bisa di hapus ke BPJS'
                ]);
            }
            for ($i = 0; $i < sizeof($selected); $i++) {
                date_default_timezone_set('UTC');
                $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
                $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
                $guzzleClient = new Client([
                    'verify' => false
                ]);
                $response = $guzzleClient->request('post', 'https://apijkn.bpjs-kesehatan.go.id/aplicaresws/rest/bed/delete/' . $credentials->kode_ppk, [
                    'headers' => [
                        'X-cons-id'     => $credentials->cons_id,
                        'X-timestamp'  => $timeStamp,
                        'X-signature'   => $signature,
                        'Content-Type: Application/JSON',
                        'Accept: Application/JSON',
                    ],
                    'body' => json_encode([
                        'kodekelas' => $selected[$i]->kodekelas,
                        'koderuang' => $selected[$i]->koderuang,
                    ])
                ]);
                if ($response->getStatusCode() == 200) {
                    $berhasil++;
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Hapus beds berhasil ' . $berhasil . ' dari ' . sizeof($selected)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
