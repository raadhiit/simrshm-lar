<?php

namespace App\Services;

use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\Smis_Rad_Pesanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;

class CatatanPerkembanganPasienTerintegrasiService
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
        $dokumen = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        //        $data['layanan'] = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
        //            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
        //                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
        //                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
        //                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp',
        //                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
        //            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
        //            ->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        $data['employee_ns'] = $dokumen->catatan_perkembangan_pasien_terintegrasi ? SmisHrdEmployee::where('nama', $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa)->first() : null;
        $data['employee_dr'] = $dokumen->catatan_perkembangan_pasien_terintegrasi ? SmisHrdEmployee::where('nama', $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa_dr)->first() : null;
        $data['employee_fp'] = $dokumen->catatan_perkembangan_pasien_terintegrasi ? SmisHrdEmployee::where('nama', $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa_fp)->first() : null;
        $data['employee_apt'] = $dokumen->catatan_perkembangan_pasien_terintegrasi ? SmisHrdEmployee::where('nama', $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa_apt)->first() : null;
        // $data['data_ppa'] = SmisHrdEmployee::where('nama', $dokumen->ppa)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select(
                'smis_rg_patient.telpon',
                'smis_rg_patient.nama',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat',
                'smis_rg_patient.rt',
                'smis_rg_patient.rw',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_patient.ktp',
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.umur',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.nama_perusahaan',
                'smis_rg_asuransi.nama as asuransi'
            )
            ->where('smis_rg_layananpasien.id', $dokumen->noreg)
            ->first();

        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $data['kelas_lab'] = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $data['kelas_rad'] = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-jenis')->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();

        $data['pesanan_lab'] = SMIS_LabPesanan::where('id', ($dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->id_pesanan_lab : 0))->where('prop', '')->first();
        $data['pesanan_rad'] = Smis_Rad_Pesanan::where('id', ($dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->id_pesanan_rad : 0))->where('prop', '')->first();

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
        $data['all_resep'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->where('prop', '')->get();
        $data['dokumen'] = $dokumen;
        return $data;
    }
}
