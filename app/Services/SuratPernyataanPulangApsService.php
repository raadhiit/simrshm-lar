<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SmisDocSuratPernyataanPulangAps;

class SuratPernyataanPulangApsService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::with([
            'rm_pasien' => function ($q) {
                $q->select('id', 'nama', 'kelamin', 'tgl_lahir', 'alamat', 'ktp')->first();
            },
            'sp_pulang_aps'
        ])->findOrFail($req->dokumen);
        $data['pasien'] = $dokumen->rm_pasien;
        $data['dokumen'] = $dokumen;
        $data['sp_pulang_aps'] = $dokumen->sp_pulang_aps;
        //        dd($data);
        return $data;
    }

    function save($req)
    {
        $id_dokumen = is_array($req) ? $req['id_dokumen'] : $req->id_dokumen;
        $updated = is_array($req) ? $req : $req->all();

        $sp_pulang_aps = SmisDocSuratPernyataanPulangAps::updateOrCreate([
            'id_dokumen' => $id_dokumen
        ], $updated);

        return $sp_pulang_aps;
    }

    function upload_signature($sign_base64)
    {
        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $sign_base64);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        return "$fileName";
    }
}
