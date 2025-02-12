<?php

namespace App\Http\Controllers;

use App\Models\RsCredential;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Auth;

class WaktuTaskIdController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'antrian')) {
                $arr = (array) $menu->antrian;
                if ($arr['list_task_id'] == 0) {
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
        return view('antrian.list_task_id');
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    function ajax_request_list_task_id(Request $req)
    {
        try {
            $credentials = RsCredential::where('layanan', 'antrian')->first();
            if ($credentials == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Credential tidak valid'
                ]);
            };
            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
            $client = new Client([
                'verify' => false
            ]);

            $response = $client->request('post', $credentials->base_url . '/antrean/getlisttask', [
                'headers' => [
                    'x-cons-id'     => $credentials->cons_id,
                    'x-timestamp'  => $timeStamp,
                    'x-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ],
                'body' => json_encode([
                    'kodebooking' => $req->kode_booking,
                ])
            ])->getBody()->getContents();

            $body = json_decode($response);
            if ($body->metadata->code == 200) {
                return response()->json([
                    'status' => true,
                    'message' => $body->metadata->message,
                    'data' => json_decode($this->decompress($this->stringDecrypt($credentials->cons_id . $credentials->cons_secret . $timeStamp, $body->response)))
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $body->metadata->message
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
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
