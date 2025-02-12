<?php

namespace App\Services;

use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Asesment_Praanestesi_Sedasi;
use App\Models\Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisDocAssesmentUlangNyeriIntervensi;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class AsesmenPraAnestesiDanSedasi
{
    function create($data)
    {
        $tes = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'id_ppa' => $data->id_ppa,
            'ppa' => $data->ppa,
            'subyektif' => $data->subyektif,
            'instruksi_kesehatan' => $data->instruksi_kesehatan,
        ]);

//        try {
//
//
//            return [
//                'status' => true,
//                'message' => 'OK'
//            ];
//        } catch (\Throwable $th) {
//            return [
//                'status' => false,
//                'message' => $th->getMessage()
//            ];
//        }
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('assesment_pra_anestesi_sedasi', 'assesment_pra_anestesi_sedasi.id_dokumen', 'dokumen_kunjungan_pasien.id')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();

        $data['detail'] = Smis_Doc_Asesment_Praanestesi_Sedasi::where(['id_dokumen' => $req->dokumen])->first();

        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->username)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.pekerjaan',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp', 'smis_rg_layananpasien.umur', 'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

        $data['layanan'] = $layanan;

        $data['assesment'] = Smis_Doc_Asesment_Praanestesi_Sedasi::where(['id_dokumen' => $req->dokumen])->get();


        return $data;
    }

    function verifikasi_dokumen($data){



        $verif = Smis_Doc_Asesment_Praanestesi_Sedasi::where(['id_dokumen' => $data->dokumen])->get();

        foreach ($verif as $key => $item) {
            # code...
            $item->verifikator = Auth::user()->username;
            $item->status = 1;
            $item->save();
        }


        // dd($verif);


        $dok = DokumenKunjungan::find($data->dokumen);
        $dok->id_verifikator = auth()->user()->id;
        $dok->nama_verifikator = Auth::user()->realname;
        $dok->status = 1;
        $dok->save();

        return $verif;
    }
}
