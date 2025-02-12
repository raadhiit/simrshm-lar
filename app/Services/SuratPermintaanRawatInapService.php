<?php

namespace App\Services;

use App\Models\Smis_Doc_Asesment_Medis_Awal;
use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Surat_Permintaan_Rawat_Inap;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;

class SuratPermintaanRawatInapService
{
    function create($data)
    {
        $tes = Smis_Doc_Surat_Permintaan_Rawat_Inap::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'unit' => $data->unit,
            'indikasi_rawat' => $data->indikasi_rawat,
            'id_dpjp' => $data->id_dpjp,
            'dpjp' => $data->dpjp,
            'id_dokter_pengirim' => $data->id_dokter_pengirim,
            'dokter_pengirim' => $data->dokter_pengirim,
            'tgl_rawat_inap' => $data->tgl_rawat_inap,
            'id_kamar' => $data->id_kamar ? $data->id_kamar : 0,
            'kamar' => $data->kamar ? $data->kamar : '',
            'id_petugas_ranap' => $data->id_petugas_ranap ? $data->id_petugas_ranap : 0,
            'petugas_ranap' => $data->petugas_ranap ? $data->petugas_ranap : '',
            'tgl_rencana_operasi' => $data->tgl_rencana_operasi ? $data->tgl_rencana_operasi : "",
            'tanggal_ttd' => $data->tanggal_ttd ? $data->tanggal_ttd : null,
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
        $data['dokumen'] = DokumenKunjungan::with('surat_permintaan_rawat_inap')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp', 'smis_rg_layananpasien.umur', 'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $data['kelas'] = SmisAdmSettings::where('name', 'smis-rs-kelas-' . $layanan->last_ruangan)->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();

        if ($layanan->diagnosa) {
            if ($layanan->diagnosa->diagnosa_sekunder1) {
                $data['kode_sekunder1'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder1)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder2) {
                $data['kode_sekunder2'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder2)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder3) {
                $data['kode_sekunder3'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder3)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder4) {
                $data['kode_sekunder4'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder4)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder5) {
                $data['kode_sekunder5'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder5)->first();
            }
        }

        $data['layanan'] = $layanan;
        $data['all_resep'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->get();
        return $data;
    }
}
