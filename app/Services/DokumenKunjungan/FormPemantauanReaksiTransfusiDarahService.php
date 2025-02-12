<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use Illuminate\Support\Facades\DB;

class FormPemantauanReaksiTransfusiDarahService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = DB::table('smis_rg_layananpasien')->where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = DB::table('smis_rg_patient')->where('id', $dokumen->nrm)->where('prop', '')->first();
        return [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => DB::table('smis_doc_form_pemantauan_reaksi_transfusi_darah')->where('id_dokumen', $req->dokumen)->first()
        ];
    }

    function store($req)
    {
        $arrInsert['tanggal_transfusi'] = $req->tanggal_transfusi ? date('Y-m-d', strtotime($req->tanggal_transfusi)) : '';
        $arrInsert['nama_pasien'] = $req->nama_pasien ?? '';
        $arrInsert['tanggal_lahir'] = $req->tanggal_lahir ? date('Y-m-d', strtotime($req->tanggal_lahir)) : '';
        $arrInsert['umur'] = $req->umur ?? '';
        $arrInsert['nrm'] = $req->nrm ?? '';
        $arrInsert['nrm_sesuai'] = $req->nrm_sesuai ?? '';
        $arrInsert['kelamin'] = $req->kelamin ?? '';
        $arrInsert['nama_dokter_pj'] = $req->nama_dokter_pj ?? '';
        $arrInsert['berat_badan_kg'] = $req->berat_badan_kg ?? '';
        $arrInsert['berat_badan_gr'] = $req->berat_badan_gr ?? '';
        $arrInsert['ruangan'] = $req->ruangan ?? '';
        $arrInsert['golongan_darah'] = $req->golongan_darah ?? '';
        $arrInsert['riwayat_transfusi_sebelumnya'] = $req->riwayat_transfusi_sebelumnya ?? '';
        $arrInsert['tanggal_transfusi_sebelumnya'] = $req->tanggal_transfusi_sebelumnya ? date('Y-m-d', strtotime($req->tanggal_transfusi_sebelumnya)) : '';
        $arrInsert['riwayat_kehamilan'] = $req->riwayat_kehamilan ?? '';
        $arrInsert['riwayat_penyakit_berkaitan'] = $req->riwayat_penyakit_berkaitan ?? '';
        $arrInsert['jenis_komponen_darah'] = $req->jenis_komponen_darah ?? '';
        $arrInsert['volume_unit'] = $req->volume_unit ?? '';
        $arrInsert['no_kantong_darah'] = $req->no_kantong_darah ?? '';
        $arrInsert['tanggal_kadaluwarsa'] = $req->tanggal_kadaluwarsa ? date('Y-m-d', strtotime($req->tanggal_kadaluwarsa)) : '';
        $arrInsert['golongan_darah_donor'] = $req->golongan_darah_donor ?? '';
        $arrInsert['cross_match'] = $req->cross_match ?? '';
        $arrInsert['kompatibel'] = $req->kompatibel ?? '';
        $arrInsert['skrining_antibodi'] = $req->skrining_antibodi ?? '';
        $arrInsert['hasil_skrining_antibodi'] = $req->hasil_skrining_antibodi ?? '';
        $arrInsert['masalah'] = $req->masalah ?? '';
        $arrInsert['petugas_satu'] = $req->petugas_satu ?? '';
        $arrInsert['petugas_dua'] = $req->petugas_dua ?? '';
        $arrInsert['jam_mulai'] = $req->jam_mulai ?? '';
        $arrInsert['jam_berakhir'] = $req->jam_berakhir ?? '';
        $arrInsert['kecepatan_tetesan'] = $req->kecepatan_tetesan ?? '';
        $arrInsert['tanda_vital'] = $req->tanda_vital ?? '';
        $arrInsert['gejala'] = $req->gejala ?? '';
        $arrInsert['lain_lain'] = $req->lain_lain ?? '';
        $arrInsert['nama_dokter'] = $req->nama_dokter ?? '';
        $arrInsert['nama_perawat'] = $req->nama_perawat ?? '';
        
        DB::table('smis_doc_form_pemantauan_reaksi_transfusi_darah')->updateOrInsert([
            'id_dokumen' => $req->dokumen
        ], $arrInsert);

        return DB::table('smis_doc_form_pemantauan_reaksi_transfusi_darah')->where('id_dokumen', $req->dokumen)->first();
    }
}
