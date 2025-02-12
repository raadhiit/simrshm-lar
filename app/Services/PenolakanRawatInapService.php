<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SmisDocPenolakanRawatInap;
use App\Models\SmisHrdEmployee;

class PenolakanRawatInapService
{
    function data($req) {
        $dokumen = DokumenKunjungan::where('id', $req->dokumen)
            ->with(['rm_pasien:id,nama,kelamin,tempat_lahir,tgl_lahir,alamat,ktp,telpon,kelamin', 'verifikator:id,username', 'penolakan_rawat_inap'])
            ->first();

        if (isset($dokumen->penolakan_rawat_inap)) {
            $dokter = SmisHrdEmployee::where('nama', $dokumen->penolakan_rawat_inap->nama_dokter)
                ->get(['id', 'nama', 'username', 'ttd']);
            $data['dokter'] = $dokter->first();
        }
        if (isset($dokumen->verifikator)) {
            $verifikator = SmisHrdEmployee::where('username', $dokumen->verifikator->username)
            ->get(['id', 'nama', 'username', 'ttd']);
            $data['employee'] = $verifikator->first();
        }
        $data['dokumen'] = $dokumen;
        $data['pasien'] = $dokumen->rm_pasien;
        $data['penolakan_ranap'] = $dokumen->penolakan_rawat_inap;

        return $data;
    }

    function save($req) {
        $id_dokumen = is_array($req) ? $req['id_dokumen'] : $req->id_dokumen;
        $updated = is_array($req) ? $req : $req->all();

        $penolakan_ranap = SmisDocPenolakanRawatInap::updateOrCreate([
            'id_dokumen' => $id_dokumen
        ], $updated);

        return $penolakan_ranap;
    }

    function upload_signature($sign_base64)
    {
        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $sign_base64);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        return "$fileName";
    }
}
