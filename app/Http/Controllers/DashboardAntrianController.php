<?php

namespace App\Http\Controllers;

use App\Models\RsCredential;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Auth;

class DashboardAntrianController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'dashboard')) {
                $arr = (array) $menu->dashboard;
                if ($arr['antrian'] == 0) {
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
        return view('dashboard_bpjs.index');
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    function ajax_per_tanggal(Request $req)
    {
        try {
            $client = new Client([
                'verify' => false
            ]);

            $credentials = RsCredential::where('layanan', 'like', 'antrian')->first();

            if (is_null($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Credentials tidak ditemukan'
                ]);
            }

            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);

            $response = $client->request('get', $credentials->base_url . '/dashboard/waktutunggu/tanggal/' . date('Y-m-d', strtotime($req->tanggal)) . '/waktu/rs', [
                'headers' => [
                    'x-cons-id'     => $credentials->cons_id,
                    'x-timestamp'  => $timeStamp,
                    'x-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ]
            ])->getBody()->getContents();
            $result = json_decode($response);
            if ($result->metadata->code == 200) {
                return response()->json([
                    'status' => true,
                    'message' => $result->metadata->message,
                    'data' => $result->response->list
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => $result->metadata->message,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function ajax_per_bulan(Request $req)
    {
        try {
            $client = new Client([
                'verify' => false
            ]);

            $credentials = RsCredential::where('layanan', 'like', 'antrian')->first();

            if (is_null($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Credentials tidak ditemukan'
                ]);
            }

            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);

            $response = $client->request('get', $credentials->base_url . '/dashboard/waktutunggu/bulan/' . $req->bulan. '/tahun/' . $req->tahun . '/waktu/rs', [
                'headers' => [
                    'x-cons-id'     => $credentials->cons_id,
                    'x-timestamp'  => $timeStamp,
                    'x-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ]
            ])->getBody()->getContents();
            $result = json_decode($response);
            if ($result->metadata->code == 200) {
                return response()->json([
                    'status' => true,
                    'message' => $result->metadata->message,
                    'data' => $result->response->list
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => $result->metadata->message,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
