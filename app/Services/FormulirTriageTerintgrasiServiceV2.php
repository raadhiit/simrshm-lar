<?php

namespace App\Services;

use App\Models\Smis_Doc_Asesment_Medis_Awal;
use App\Models\Smis_Doc_Dokumen_Laporan_Caesarian;
use App\Models\Smis_Doc_Dokumen_Transfer_Pasien_Internal;
use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\FormulirTriageTerintegrasiV2;
use App\Models\Smis_Doc_Surat_Permintaan_Rawat_Inap;
use App\Models\Smis_Doc_Formulir_Triage_Terintegrasi;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Mr_Tanda_Vital;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\SMIS_Rg_Perujuk;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormulirTriageTerintgrasiServiceV2
{
    function create($data)
    {
        $dokumen = DokumenKunjungan::where('id', $data->dokumen)->first();
        $layanan = DB::table('smis_rg_layananpasien')->where('id', $dokumen->noreg)->first();
        $tes = FormulirTriageTerintegrasiV2::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            // 'kontak_awal_pasien' => $data->kontak_awal_pasien,
            'kontak_awal_pasien' => $data->kontak_awal_pasien ? $data->kontak_awal_pasien : '[]',
            'tanggal' => date('Y-m-d', strtotime($data->tanggal)),
            'pukul' => date('H:i:s', strtotime($data->pukul)),
            'cara_masuk' => $data->cara_masuk,
            'ket_cara_masuk' => $data->ket_cara_masuk,
            'sudah_terpasang' => $data->sudah_terpasang,
            'alasan_kedatangan' => $data->alasan_kedatangan,
            'ket_rujukan' => $data->ket_rujukan,
            'ket_dijemput' => $data->ket_dijemput,
            'kendaraan' => $data->kendaraan,
            'ket_kendaraan' => $data->ket_kendaraan,
            'nama_pengantar' => $data->nama_pengantar,
            'no_telp_pengantar' => $data->no_telp_pengantar,
            'kasus' => $data->kasus,
            'keluhan_utama' => $data->keluhan_utama,
            'tv_nyeri' => $data->tv_nyeri,
            'esi_satu' => $data->esi_satu,
            'ket_esi_satu' => $data->ket_esi_satu,
            'esi_dua' => $data->esi_dua,
            'ket_esi_dua' => $data->ket_esi_dua,
            'sumber_daya' => $data->sumber_daya,
            'danger_zone' => $data->danger_zone,
            'esi_tiga' => $data->esi_tiga,
            'esi_empat' => $data->esi_empat,
            'esi_lima' => $data->esi_lima,
            'keputusan_pukul' => date('H:i:s', strtotime($data->keputusan_pukul)),
            'reuunp' => $data->reuunp,
            'catatan' => $data->catatan,
        ]);

        Smis_Mr_Tanda_Vital::updateOrCreate([
            'noreg_pasien' => $data->noreg
        ], [
            'ruangan' => $layanan->jenislayanan,
            'nama_pasien' => $dokumen->nama_pasien,
            'nrm_pasien' => $dokumen->nrm,
            'keadaan_umum' => $data->keadaan_umum ?? '',
            'tensi' => $data->tensi ?? '',
            'suhu' => $data->suhu ?? '',
            'nadi' => $data->nadi ?? '',
            'rr' => $data->rr ?? '',
            'spo2' => $data->spo2 ?? '',
        ]);

        return $tes;
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('formulir_triage_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['petugas_penyerahan'] = SmisHrdEmployee::where('nama', $data['dokumen']->petugas_penyerahan)->first();
        $data['pasien'] = SMIS_Pasien::where('prop', '')->where('id', $data['dokumen']->nrm)->first();
        $data['ttv'] = DB::table('smis_mr_tanda_vital')->where('prop', '')->where('noreg_pasien', $data['dokumen']->noreg)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi', 'tanda_vital'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
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
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_patient.ktp',
                'smis_rg_layananpasien.umur',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.tanggal',
                'smis_rg_layananpasien.alamat_pasien'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

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
            if ($layanan->diagnosa->diagnosa_pra_bedah) {
                $data['kode_diagnosa_pra_bedah'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_pra_bedah)->first();
            }
            if ($layanan->diagnosa->diagnosa_pasca_bedah) {
                $data['kode_diagnosa_pasca_bedah'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_pasca_bedah)->first();
            }
        }

        $data['layanan'] = $layanan;
        $data['tindakan_dokter'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'tindakan_dokter')
            ->get();
        $data['tindakan_perawat'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'tindakan_perawat')
            ->get();
        $data['oksigen_manual'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'oksigen_manual')
            ->get();
        $data['oksigen_central'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'oksigen_central')
            ->get();
        $data['all_resep'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->get();
        $data['perujuk'] = SMIS_Rg_Perujuk::all();
        return $data;
    }
}
