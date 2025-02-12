<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Daftar_Pemberian_Obat;
use App\Models\SMIS_Pasien;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class DaftarPemberianObatService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $pasien = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data = Smis_Doc_Daftar_Pemberian_Obat::where('id_dokumen', $req->dokumen)->first();
        return [
            'dokumen' => $dokumen,
            'pasien' => $pasien,
            'data' => $data
        ];
    }

    function store($req)
    {
        $select = Smis_Doc_Daftar_Pemberian_Obat::where('id_dokumen', $req->dokumen)->first();

        $empty_paraf = [];

        for ($i = 0; $i < 18; $i++) {
            array_push($empty_paraf, json_decode(json_encode([
                'bidan' => json_decode(json_encode([
                    'username' => '',
                    'name' => '',
                    'signature' => ''
                ])),
                'pasien' => json_decode(json_encode([
                    'signature' => '',
                    'name' => ''
                ]))
            ])));
        }

        $paraf = $select ? json_decode($select->paraf) : $empty_paraf;

        switch ($req->verif) {
            case 'bidan':
                $employee = SmisHrdEmployee::where('username', Auth::user()->username)->where('prop', '')->first();
                $paraf[$req->idx]->bidan->signature = $employee ? $employee->ttd : '';
                $paraf[$req->idx]->bidan->username = Auth::user()->username;
                $paraf[$req->idx]->bidan->name = Auth::user()->realname;
                break;
            case 'pasien':
                $folderPath = public_path('signature_patient/');

                $image_parts = explode(";base64,", $req->signed);

                $image_type_aux = explode("image/", $image_parts[0]);

                $image_type = $image_type_aux[1];

                $image_base64 = base64_decode($image_parts[1]);

                $fileName = uniqid() . '.' . $image_type;
                $file = $folderPath . $fileName;
                file_put_contents($file, $image_base64);

                $paraf[$req->idx]->pasien->signature = $fileName;
                $paraf[$req->idx]->pasien->name = $req->nama_pasien;

                break;

            default:
                # code...
                break;
        }

        $query = Smis_Doc_Daftar_Pemberian_Obat::updateOrCreate([
            'id_dokumen' => $req->dokumen,
        ],[
            'tanggal' => $req->tanggal,
            'list_pemberian_obat' => $req->list_pemberian_obat,
            'paraf' => json_encode($paraf),
        ]);

        return $query;
    }
}
