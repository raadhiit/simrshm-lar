<?php

namespace App\Services;

use App\Models\AvailableBed;
use App\Models\RsCredential;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class AplicareService
{
    public function getData()
    {
        $data['available_beds'] = DB::table('available_beds')->where('deleted_at', null)->get();
        return $data;
    }

    public function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);

        return $encodedSignature;
    }

    public function available_beds()
    {
        $credentials = RsCredential::first();
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
            $response = $guzzleClient->request('get', 'https://apijkn.bpjs-kesehatan.go.id/aplicaresws/rest/bed/read/' . $credentials->kode_ppk . '/1/20', [
                'headers' => [
                    'X-cons-id'     => $credentials->cons_id,
                    'X-timestamp'  => $timeStamp,
                    'X-signature'   => $signature,
                    'Content-Type: Application/JSON',
                    'Accept: Application/JSON',
                ]
            ]);
            return response()->json([
                'status' => 'true',
                'data' => $response->getBody()->getContents()
            ], $response->getStatusCode());
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function create_beds()
    {
        $credentials = RsCredential::first();
        if ($credentials == null) {
            return response()->json([
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ], 500);
        }

        $berhasil = 0;

        try {
            $selected = AvailableBed::select('id', 'kodekelas', 'namakelas', 'koderuang', 'namaruang', 'kapasitas', 'tersedia', 'tersediapria', 'tersediawanita', 'tersediapriawanita')
                ->where('created_at', null)
                ->get();
            if (sizeof($selected) == 0) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Tidak ada data yang bisa di create ke BPJS'
                ], 402);
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
                'status' => 'true',
                'message' => 'Create beds berhasil ' . $berhasil . ' dari ' . sizeof($selected)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'false',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update_beds()
    {
        $credentials = RsCredential::first();
        if ($credentials == null) {
            return response()->json([
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ], 500);
        }

        $berhasil = 0;

        try {
            $selected = AvailableBed::select('id', 'kodekelas', 'koderuang', 'namaruang', 'kapasitas', 'tersedia', 'tersediapria', 'tersediawanita', 'tersediapriawanita')
                ->where('updated_at', '<>', null)->where('deleted_at', null)
                ->get();
            if (sizeof($selected) == 0) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Tidak ada data yang bisa di update ke BPJS'
                ], 402);
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
                'status' => 'true',
                'message' => 'Update beds berhasil ' . $berhasil . ' dari ' . sizeof($selected)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'false',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function delete_beds()
    {
        $credentials = RsCredential::first();
        if ($credentials == null) {
            return response()->json([
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ], 500);
        }

        $berhasil = 0;

        try {
            $selected = AvailableBed::select('id', 'kodekelas', 'koderuang', 'namaruang', 'kapasitas', 'tersedia', 'tersediapria', 'tersediawanita', 'tersediapriawanita')
                ->where('deleted_at', '<>', null)
                ->get();
            if (sizeof($selected) == 0) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Tidak ada data yang bisa di hapus ke BPJS'
                ], 402);
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
                'status' => 'true',
                'message' => 'Hapus beds berhasil ' . $berhasil . ' dari ' . sizeof($selected)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'false',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
