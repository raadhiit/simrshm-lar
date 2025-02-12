<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap;
use App\Models\SmisDocPenolakanRawatInap;
use App\Models\SmisHrdEmployee;

class LembarHasilTindakanUjiFungsiService
{
    function data($req) {
        $dokumen = DokumenKunjungan::where('id', $req->dokumen)
            ->with(['rm_pasien:id,nama,kelamin,tempat_lahir,tgl_lahir,alamat,ktp,telpon,kelamin', 'verifikator:id,username', 'lembar_hasil_tindakan_uji_fungsi'])
            ->first();
        $cppt = DokumenKunjungan::where('noreg', '=', $dokumen->noreg)
            ->where('nrm', '=', $dokumen->nrm)
            ->where('nama_dokumen', 'like', '%Catatan Perkembangan Pasien Terintegrasi (CPPT)%')
            ->orderBy('id', 'desc')
            ->first();
        $data_cppt = null;
        if ($cppt) {
            $data_cppt = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])
                ->select('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.*')
                ->where('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.id_dokumen', $cppt->id)
                ->where('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.prop', '')->first();
        }

        if (isset($dokumen->verifikator)) {
            $verifikator = SmisHrdEmployee::where('username', $dokumen->verifikator->username)
            ->get(['id', 'nama', 'username', 'ttd']);
            $data['employee'] = $verifikator->first();
        }
        $data['dokumen'] = $dokumen;
        $data['pasien'] = $dokumen->rm_pasien;
        $data['lembar_hasil_tindakan_uji_fungsi'] = $dokumen->lembar_hasil_tindakan_uji_fungsi;
        $data['data_cppt'] = $data_cppt;

        return $data;
    }
}
