<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan;
use App\Models\SMIS_Diagnosa;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SMIS_Rg_Asuransi;
use App\Models\SMIS_Rg_Perusahaan;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\DB;

class BuktiPendaftaranRawatJalanService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $asuransi = SMIS_Rg_Asuransi::where('id', $layanan->asuransi)->where('prop', '')->first();

        $mitra = $asuransi ? $asuransi : SMIS_Rg_Perusahaan::where('id', $layanan->nama_perusahaan)->where('prop', '')->first();
        $diagnosa = SMIS_Diagnosa::where('noreg_pasien', $layanan->id)->where('prop', '')->first();
        $kasir = SMIS_Ksr_Kolektif::where('nama_grup', 'like', '%tindakan%')->where('ruangan', $layanan->jenislayanan)->where('noreg_pasien', $layanan->id)->first();

        return [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'mitra' => $mitra,
            'diagnosa' => $diagnosa,
            'kasir' => $kasir,
            'data' => Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::where('id_dokumen', $req->dokumen)->first(),
            'employee' => SmisHrdEmployee::where('nama', $dokumen->realname)->where('prop', '')->first()
        ];
    }

    function tanda_tangan($req)
    {
        $select = Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::where('id_dokumen', $req->dokumen)->first();
        $fileName = $select ? $select->signature : '';

        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        DB::table('dokumen_kunjungan_pasien')->where('id', $req->dokumen)->update([
            'nama_pasien' => $req->nama_pasien,
            'signature_pasien' => $fileName
        ]);

        Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::updateOrCreate([
            'id_dokumen' => $req->dokumen,
        ], [
            'pengirim' => $req->pengirim ? $req->pengirim : '',
            'ditujukan' => $req->ditujukan ? $req->ditujukan : '',
            'catatan' => $req->catatan ? $req->catatan : '',
            'tindakan' => $req->tindakan ? $req->tindakan : '',
            'diagnosa' => $req->diagnosa ? $req->diagnosa : '',
            'nama_user' => $req->nama_user ? $req->nama_user : '',
            'nama_pasien' => $req->nama_pasien,
            'signature' => $fileName,
            'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00'
        ]);

        return Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::where('id_dokumen', $req->dokumen)->first();
    }

    function verifikasi($req)
    {
        $select = Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::where('id_dokumen', $req->dokumen)->first();

        $query = Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::updateOrCreate([
            'id_dokumen' => $req->dokumen,
        ], [
            'pengirim' => $req->pengirim ? $req->pengirim : '',
            'ditujukan' => $req->ditujukan ? $req->ditujukan : '',
            'catatan' => $req->catatan ? $req->catatan : '',
            'tindakan' => $req->tindakan ? $req->tindakan : '',
            'diagnosa' => $req->diagnosa ? $req->diagnosa : '',
            'nama_user' => $req->nama_user ? $req->nama_user : '',
            'nama_pasien' => $select ? $select->nama_pasien : '',
            'signature' => $select ? $select->signature : '',
            'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00'
        ]);

        return $query;
    }
}
