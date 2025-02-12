<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SatuSehatPractionerService
{
    function get_ihs_number($req)
    {
        $sss = new SatuSehatService();
        $result = $sss->get(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|' . $req->nik);
        if ($result->getStatusCode() == 401) {
            $autentikasi = json_decode($sss->auth());
            Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
            return redirect()->back()->with('gagal', 'Token expired, silahkan coba kembali');
        }
        if ($result->getStatusCode() == 200) {
            $data = json_decode($result->getBody()->getContents());
            if($data->total == 1){
                DB::table('smis_hrd_employee')->where('noktp', $req->nik)->update([
                    'ihs_number' => $data->entry[0]->resource->id
                ]);
                return [
                    'status' => true,
                    'message' => 'Update ihs number berhasil'
                ];
            }else{
                return [
                    'status' => false,
                    'message' => 'Data practitoner tidak ditemukan'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Gagal mendapatkan data practioner'
            ];
        }
    }
}
