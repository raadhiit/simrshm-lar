<?php
namespace App\Services;

use GuzzleHttp\Client;

class BpjsService{

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

        $configurations = config("bpjs.live");
        foreach ($configurations as $key => $val){
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }

        //set X-Timestamp, X-Signature, and finally the headers
        $this->setTimestamp()->setSignature()->setHeaders();
    }

    public function decriptResponse($data)
    {   
        $resp =  json_decode($data);
        if (is_null($resp) || $resp->metadata->code > 200) {
            return $data;
        } else {
            $data =  json_decode($data);
            $response = $data->response;
            $d = $this->stringDecrypt($response);
            $e = $this->decompress($d);
            $data->response = json_decode($e);
            return json_encode($data);
        }
    }

    protected function stringDecrypt($string){  
        $key = $this->cons_id.$this->secret_key.$this->timestamp;
      
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
  
        return $output;
    }

    protected function decompress($string){
      
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);

    }

    protected function setHeaders()
    {
        $this->headers = [
            'X-cons-id' => $this->cons_id,
            'X-timestamp' => $this->timestamp,
            'X-signature' => $this->signature,
            'user_key' => $this->user_key
        ];
        return $this;
    }

    protected function setTimestamp()
    {
        date_default_timezone_set('UTC');
        $this->timestamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        return $this;
    }

    protected function setSignature()
    {
        $data = $this->cons_id . '&' . $this->timestamp;
        $signature = hash_hmac('sha256', $data, $this->secret_key, true);
        $encodedSignature = base64_encode($signature);
        $this->signature = $encodedSignature;
        return $this;
    }

    public function get($feature)
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';
        try {
            $response = $this->clients->request(
                'GET',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $this->decriptResponse($response);
    }

    public function post($feature, $data = [], $headers = [])
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        if(!empty($headers)){
            $this->headers = array_merge($this->headers,$headers);
        }

        try {
            $response = $this->clients->request(
                'POST',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    protected function put($feature, $data = [])
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        try {
            $response = $this->clients->request(
                'PUT',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }


    protected function delete($feature, $data = [])
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        try {
            $response = $this->clients->request(
                'DELETE',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

}
