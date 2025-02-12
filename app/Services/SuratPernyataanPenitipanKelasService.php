<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SmisDocSuratPernyataanPenitipanKelas;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class SuratPernyataanPenitipanKelasService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $id_verifikator = $dokumen->id_verifikator;
        $data['pasien'] = $dokumen->rm_pasien()->select('id', 'nama', 'tgl_lahir', 'kelamin', 'telpon', 'alamat', 'ktp')->first();
        $data['employee'] = null;
        if ($dokumen->id_verifikator > 1) {
            $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        } else {
            $data['employee'] = SmisHrdEmployee::where('nama', Auth::user()->realname)->first();
        }

        $data['dokumen'] = $dokumen;
        $data['sp_penitipan_kelas'] = $dokumen->sp_penitipan_kelas;

        return $data;
    }

    function save($req)
    {
        $id_dokumen = is_array($req) ? $req['id_dokumen'] : $req->id_dokumen;
        $updated = is_array($req) ? $req : $req->all();
        $sp_penitipan_kelas = SmisDocSuratPernyataanPenitipanKelas::updateOrCreate([
            'id_dokumen' => $id_dokumen
        ], $updated);

        return $sp_penitipan_kelas;
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
