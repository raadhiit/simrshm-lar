<?php

namespace App\Services;

use App\Models\SatuSehatOrganisasi;
use App\Models\SatuSehatReferensiOrganisasi;
use GuzzleHttp\Client;
use Session;

class SatuSehatService
{

    /**
     * Guzzle HTTP Client object
     * @var \GuzzleHttp\Client
     */
    private $clients;

    /**
     * Request headers
     * @var array
     */
    private $headers;

    /**
     * X-cons-id header value
     * @var int
     */
    private $cons_id;

    /**
     * X-Timestamp header value
     * @var string
     */
    private $timestamp;

    /**
     * X-Signature header value
     * @var string
     */
    private $signature;

    /**
     * @var string
     */
    private $secret_key;

    /**
     * @var string
     */
    private $base_url;

    private $user_key;

    /**
     * @var string
     */
    private $service_name;

    public function __construct()
    {
        $this->clients = new Client([
            'verify' => false
        ]);
        $this->base_url = env('SATU_SEHAT_URL');
        if (Session::get('token_satu_sehat') == null) {
            $autentikasi = json_decode($this->auth());
            Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
        }
    }

    public function auth()
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';

        try {
            $response = $this->clients->request(
                'POST',
                $this->base_url . '/oauth2/v1/accesstoken?grant_type=client_credentials',
                [
                    'headers' => $this->headers,
                    'form_params' => [
                        'client_id' => env('SATU_SEHAT_CLIENT_ID'),
                        'client_secret' => env('SATU_SEHAT_CLIENT_SECRET'),
                    ],
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    public function get($url)
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';
        $this->headers['Authorization'] = 'Bearer ' . Session::get('token_satu_sehat');

        try {
            $response = $this->clients->request(
                'GET',
                $url,
                [
                    'headers' => $this->headers,
                    'http_errors' => false

                ]
            );
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    public function post($url, $data = '')
    {
        $this->headers['Content-Type'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer ' . Session::get('token_satu_sehat');
        try {
            $response = $this->clients->request(
                'POST',
                $url,
                [
                    'headers' => $this->headers,
                    'json' => json_decode($data),
                    'http_errors' => false
                ]
            );
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    public function put($url, $data = '')
    {
        $this->headers['Content-Type'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer ' . Session::get('token_satu_sehat');
        // dd($data);
        try {
            $json = json_decode($data);
            $response = $this->clients->request(
                'PUT',
                $url,
                [
                    'headers' => $this->headers,
                    'json' => json_decode($data),
                    'http_errors' => false,
                    'form_params' => [
                        'id' => $json->id
                    ]
                ]
            );
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }
}
