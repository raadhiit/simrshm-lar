<?php

namespace App\Http\Controllers;

use App\Models\ReferensiPoli;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\RsCredential;
use Auth;

class JadwalPoliBpjsController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'jadwal_poli')) {
                $arr = (array) $menu->jadwal_poli;
                if ($arr['bpjs'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index()
    {
        $data['kode_poli'] = ReferensiPoli::select('kode_poli')->groupBy('kode_poli')->get();
        return view('jadwal_poli.bpjs', $data);
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    function referensi_jadwal_dokter(Request $req)
    {
        $credentials = RsCredential::where('layanan', 'antrian')->first();
        // return response()->json($credentials);
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
            $response = $guzzleClient->request('get', $credentials->base_url . '/jadwaldokter/kodepoli/'.$req->kode_poli.'/'.'tanggal/'.$req->tanggal, [
                'headers' => [
                    'x-cons-id'     => $credentials->cons_id,
                    'x-timestamp'  => $timeStamp,
                    'x-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ]
            ]);
            if ($response->getStatusCode() == 200) {
                $list = json_decode($response->getBody()->getContents());
                if ($list->metadata->code == 201) {
                    return response()->json([
                        'status' => 'true',
                        'data' => [],
                    ]);
                }
                return response()->json([
                    'status' => 'true',
                    'data' => json_decode($this->decompress($this->stringDecrypt($credentials->cons_id . $credentials->cons_secret . $timeStamp, $list->response))),
                ]);
            } else {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Gagal mendapatkan data'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'false',
                'message' => $th->getMessage()
            ]);
        }
    }

    function stringDecrypt($key, $string)
    {


        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        return $output;
    }

    // function lzstring decompress 
    // download libraries lzstring : https://github.com/nullpunkt/lz-string-php
    function decompress($string)
    {

        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }
}
