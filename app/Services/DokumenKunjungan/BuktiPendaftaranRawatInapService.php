<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Bukti_Pendaftaran_Rawat_Inap;
use App\Models\SMIS_Diagnosa;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SMIS_Rg_Asuransi;
use App\Models\SMIS_Rg_Perusahaan;
use App\Models\SmisHrdEmployee;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BuktiPendaftaranRawatInapService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $asuransi = SMIS_Rg_Asuransi::where('id', $layanan->asuransi)->where('prop', '')->first();

        $mitra = $asuransi ? $asuransi : SMIS_Rg_Perusahaan::where('id', $layanan->nama_perusahaan)->where('prop', '')->first();
        $diagnosa = SMIS_Diagnosa::where('noreg_pasien', $layanan->id)->where('prop', '')->first();
        $kasir = SMIS_Ksr_Kolektif::where('nama_grup', 'like', '%tindakan%')->where('ruangan', $layanan->jenislayanan)->where('noreg_pasien', $layanan->id)->first();
        $user = User::where('id', $dokumen->id_verifikator)->where('prop', '')->first();

        return [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'mitra' => $mitra,
            'diagnosa' => $diagnosa,
            'kasir' => $kasir,
            'data' => Smis_Doc_Bukti_Pendaftaran_Rawat_Inap::where('id_dokumen', $req->dokumen)->first(),
            'employee' => $user ? SmisHrdEmployee::where('username', $user->username)->where('prop', '')->first() : null
        ];
    }

    function store($req)
    {
        $query = Smis_Doc_Bukti_Pendaftaran_Rawat_Inap::updateOrCreate([
            'id_dokumen' => $req->dokumen,
        ], [
            'kontraktor' => $req->kontraktor ? $req->kontraktor : '',
            'telepon' => $req->telepon ? $req->telepon : '',
            'cara_masuk' => $req->cara_masuk ? $req->cara_masuk : '',
            'datang_melalui' => $req->datang_melalui ? $req->datang_melalui : '',
            'dikirim_oleh' => $req->dikirim_oleh ? $req->dikirim_oleh : '',
            'tanggal_verifikasi' => $req ? $req->tanggal_verifikasi : date('Y-m-d')
        ]);
        
        return $query;
    }
}
