<?php

namespace App\Services;
use App\Services\SmisService;

class JurnalService {
    public function insert_tagihan_kasir_lab($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_TAGIHAN_KASIR_LAB'),
        [
            [
                'name'     => 'status',
                'contents' => 'insert'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }
    
    public function delete_tagihan_kasir_lab($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_TAGIHAN_KASIR_LAB'),
        [
            [
                'name'     => 'status',
                'contents' => 'del'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }

    public function insert_jurnal_lab($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_JURNAL_LAB'),
        [
            [
                'name'     => 'status',
                'contents' => 'insert'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }

    public function delete_jurnal_lab($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_JURNAL_LAB'),
        [
            [
                'name'     => 'status',
                'contents' => 'del'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }

    public function insert_tagihan_kasir_rad($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_TAGIHAN_KASIR_RAD'),
        [
            [
                'name'     => 'status',
                'contents' => 'insert'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }
    
    public function delete_tagihan_kasir_rad($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_TAGIHAN_KASIR_RAD'),
        [
            [
                'name'     => 'status',
                'contents' => 'del'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }

    public function insert_jurnal_rad($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_JURNAL_RAD'),
        [
            [
                'name'     => 'status',
                'contents' => 'insert'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }

    public function delete_jurnal_rad($id){
        $ss = new SmisService();
        $response = $ss->post(env('SMIS_URL_JURNAL_RAD'),
        [
            [
                'name'     => 'status',
                'contents' => 'del'
            ],
            [
                'name'     => 'id',
                'contents' => $id
            ]
        ]);
        return $response->getBody()->getContents();
    }
}