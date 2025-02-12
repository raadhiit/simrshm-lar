<?php

namespace App\Http\Controllers;

use App\Models\ReferensiPoli;
use App\Models\RsCredential;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Auth;

class ReferensiPoliController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'jadwal_poli')) {
                $arr = (array) $menu->jadwal_poli;
                if ($arr['referensi_poli'] == 0) {
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
        return view('referensi_poli.index', [
            'data' => ReferensiPoli::paginate(10),
            'keyword' => ''
        ]);
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    function update_poli(){
        try {
            $poli = $this->get_referensi_poli();
            if($poli['status'] == true){
                $data = $poli['data'];
                foreach($data as $d){
                    ReferensiPoli::updateOrCreate([
                        'kode_poli' => $d->kdpoli,
                        'kode_sub_spesialis' => $d->kdsubspesialis,
                    ],[
                        'nama_poli' => $d->nmpoli,
                        'nama_sub_spesialis' => $d->nmsubspesialis,
                    ]);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil memperbarui data referensi poli, silahkan melakukan refresh halaman.',
                    'signature' => $poli['signature'],
                    'timestamp' => $poli['timestamp']
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => $poli['message']
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function get_referensi_poli()
    {
        $credentials = RsCredential::where('layanan', 'antrian')->first();
        // return response()->json($credentials);
        if ($credentials == null) {
            return [
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ];
        }
        try {
            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
            $guzzleClient = new Client([
                'verify' => false
            ]);
            $response = $guzzleClient->request('get', $credentials->base_url . '/ref/poli', [
                'headers' => [
                    'X-cons-id'     => $credentials->cons_id,
                    'X-timestamp'  => $timeStamp,
                    'X-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ]
            ]);
            $list = json_decode($response->getBody()->getContents());
            return [
                'status' => true,
                'data' => json_decode($this->decompress($this->stringDecrypt($credentials->cons_id.$credentials->cons_secret.$timeStamp,$list->response))),
                'timestamp' => $timeStamp,
                'signature' => $signature
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
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
    function decompress($string){
      
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);

    }
}
