<?php

namespace App\Services;

use App\Models\RsCredential;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SmisService
{
    function post($url, $data = [])
    {
        try {
            // $response = Http::post($url, $data);
            $guzzleClient = new Client([
                'verify' => false
            ]);
            $response = $guzzleClient->request('post', $url, [
                'multipart' => $data
            ]);
            return $response;
        } catch (\Throwable $th) {
            return [
                'status' => 'false',
                'message' => $th->getMessage(),
                'code' => 500
            ];
        }
    }
}
