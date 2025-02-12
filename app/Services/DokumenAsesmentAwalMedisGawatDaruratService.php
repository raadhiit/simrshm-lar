<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SMIS_Diagnosa;
use App\Models\Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SMIS_Rg_Perujuk;
use App\Models\SmisHrdEmployee;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Rad_Pesanan;
use Illuminate\Support\Facades\Auth;

class DokumenAsesmentAwalMedisGawatDaruratService
{
    function create($data)
    {
        $tes = Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'tgl_kedatangan' => $data->tgl_kedatangan,
            'jam_kedatangan' => $data->jam_kedatangan,
            'cara_masuk' => $data->cara_masuk,
            'ket_cara_masuk' => $data->ket_cara_masuk,
            'td_keluar' => $data->td_keluar,
            'td_rr' => $data->td_rr,
            'td_nadi' => $data->td_nadi,
            'td_suhu' => $data->td_suhu,
            'td_spo2' => $data->td_spo2,
            'asal_rujukan' => $data->asal_rujukan,
            'cara_bayar' => $data->cara_bayar,
            'ket_bayar_lain' => $data->ket_bayar_lain,
            'kondisi_pasien' => $data->kondisi_pasien,
            'ket_kondisi_lain' => $data->ket_kondisi_lain,
            'jenis_pelayanan' => $data->jenis_pelayanan,
            'keluhan_utama' => $data->keluhan_utama,
            'riwayat_penyakit_sekarang' => $data->riwayat_penyakit_sekarang,
            'riwayat_penyakit_dahulu' => $data->riwayat_penyakit_dahulu,
            'riwayat_penyakit_keluarga' => $data->riwayat_penyakit_keluarga,
            'ket_riwayat_penyakit_keluarga' => $data->ket_riwayat_penyakit_keluarga,
            'riwayat_penggunaan_obat' => $data->riwayat_penggunaan_obat,
            'ket_riwayat_penggunaan_obat' => $data->ket_riwayat_penggunaan_obat,
            'riwayat_alergi' => $data->riwayat_alergi,
            'ket_riwayat_alergi' => $data->ket_riwayat_alergi,
            'keadaan_umum' => $data->keadaan_umum,
            'kesadaran' => $data->kesadaran,
            'e_kesadaran' => $data->e_kesadaran,
            'm_kesadaran' => $data->m_kesadaran,
            'v_kesadaran' => $data->v_kesadaran,
            'status_generalis' => $data->status_generalis,
            'nyeri' => $data->nyeri,
            'sifat_nyeri' => $data->sifat_nyeri,
            'kualitas_nyeri' => $data->kualitas_nyeri,
            'nyeri_menjalar' => $data->nyeri_menjalar,
            'ket_nyeri_menjalar' => $data->ket_nyeri_menjalar,
            'skor_nyeri' => $data->skor_nyeri,
            'frekuensi_nyeri' => $data->frekuensi_nyeri,
            'pengaruh_nyeri' => $data->pengaruh_nyeri,
            'nilai_wajah' => $data->nilai_wajah,
            'nilai_kaki' => $data->nilai_kaki,
            'nilai_aktifitas' => $data->nilai_aktifitas,
            'nilai_menangis' => $data->nilai_menangis,
            'nilai_bersuara' => $data->nilai_bersuara,
            'faktor_pencetus' => $data->faktor_pencetus,
            'kualitas' => $data->kualitas,
            'lokasi' => $data->lokasi,
            'skala_nyeri' => $data->skala_nyeri,
            'lama_nyeri' => $data->lama_nyeri,
            'jam_tindakan1' => $data->jam_tindakan1,
            'tindakan1' => $data->tindakan1,
            'diberikan_oleh1' => $data->diberikan_oleh1,
            'keterangan1' => $data->keterangan1,
            'jam_tindakan2' => $data->jam_tindakan2,
            'tindakan2' => $data->tindakan2,
            'diberikan_oleh2' => $data->diberikan_oleh2,
            'keterangan2' => $data->keterangan2,
            'jam_tindakan3' => $data->jam_tindakan3,
            'tindakan3' => $data->tindakan3,
            'diberikan_oleh3' => $data->diberikan_oleh3,
            'keterangan3' => $data->keterangan3,
            'jam_tindakan4' => $data->jam_tindakan4,
            'tindakan4' => $data->tindakan4,
            'diberikan_oleh4' => $data->diberikan_oleh4,
            'keterangan4' => $data->keterangan4,
            'jam_tindakan5' => $data->jam_tindakan5,
            'tindakan5' => $data->tindakan5,
            'diberikan_oleh5' => $data->diberikan_oleh5,
            'keterangan5' => $data->keterangan5,
            'jam_tindakan6' => $data->jam_tindakan6,
            'tindakan6' => $data->tindakan6,
            'diberikan_oleh6' => $data->diberikan_oleh6,
            'keterangan6' => $data->keterangan6,
            'konsultasi' => $data->konsultasi,
            'indikasi_rawat_inap' => $data->indikasi_rawat_inap,
            'pulang' => $data->pulang,
            'kontrol_poli' => $data->kontrol_poli,
            'tgl_kontrol' => $data->tgl_kontrol,
            'rujuk_ke' => $data->rujuk_ke,
            'alasan_rujuk' => $data->alasan_rujuk,
            'alasan_menolak' => $data->alasan_menolak,
            'tgl_keluar' => $data->tgl_keluar,
            'jam_keluar' => $data->jam_keluar,
            'kondisi_keluar' => $data->kondisi_keluar,
            'tgl_meninggal' => $data->tgl_meninggal,
            'jam_meninggal' => $data->jam_meninggal,
            'keadaan_umum_keluar' => $data->keadaan_umum_keluar,
            'kesadaran_keluar' => $data->kesadaran_keluar,
            'catatan_penting' => $data->catatan_penting,
            'edukasi' => $data->edukasi,
            'penyampaian_edukasi' => $data->penyampaian_edukasi,
            'alasan_tidak_menyampaikan_edukasi' => $data->alasan_tidak_menyampaikan_edukasi,
        ]);
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('dokumen_asesment_awal_medis_gawat_darurat')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['petugas_penyerahan'] = SmisHrdEmployee::where('nama', $data['dokumen']->petugas_penyerahan)->first();

        $layanan = SMIS_LayananPasien::with('tanda_vital')
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
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_patient.ktp',
                'smis_rg_layananpasien.umur',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.last_nama_ruangan',
                'smis_rg_layananpasien.nama_perusahaan',
                'smis_rg_asuransi.nama as asuransi',
                'smis_rg_layananpasien.last_bed',
                'smis_rg_layananpasien.uri'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

        $data['pesanan_lab'] = SMIS_LabPesanan::where('id', (isset($data['dokumen']->dokumen_asesment_awal_medis_gawat_darurat) ? $data['dokumen']->dokumen_asesment_awal_medis_gawat_darurat->id_pesanan_lab : 0))->where('prop', '')->first();
        $data['pesanan_rad'] = Smis_Rad_Pesanan::where('id', (isset($data['dokumen']->dokumen_asesment_awal_medis_gawat_darurat) ? $data['dokumen']->dokumen_asesment_awal_medis_gawat_darurat->id_pesanan_rad : 0))->where('prop', '')->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $data['kelas_lab'] = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $data['kelas_rad'] = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-kelas')->first();
        $data['kelas'] = SmisAdmSettings::where('name', 'smis-rs-kelas-' . $layanan->last_ruangan)->first();
        $diagnosa = $data['dokumen']->dokumen_asesment_awal_medis_gawat_darurat ? SMIS_Diagnosa::where('id', $data['dokumen']->dokumen_asesment_awal_medis_gawat_darurat->id_diagnosa)->where('prop', '')->first() : null;

        if ($diagnosa) {
            if ($diagnosa->diagnosa_sekunder1) {
                $data['kode_sekunder1'] = Smis_Mr_Icd::where('nama', $diagnosa->diagnosa_sekunder1)->first();
            } else {
                $data['kode_sekunder1'] = null;
            }
            if ($diagnosa->diagnosa_sekunder2) {
                $data['kode_sekunder2'] = Smis_Mr_Icd::where('nama', $diagnosa->diagnosa_sekunder2)->first();
            } else {
                $data['kode_sekunder2'] = null;
            }
            if ($diagnosa->diagnosa_sekunder3) {
                $data['kode_sekunder3'] = Smis_Mr_Icd::where('nama', $diagnosa->diagnosa_sekunder3)->first();
            } else {
                $data['kode_sekunder3'] = null;
            }
            if ($diagnosa->diagnosa_sekunder4) {
                $data['kode_sekunder4'] = Smis_Mr_Icd::where('nama', $diagnosa->diagnosa_sekunder4)->first();
            } else {
                $data['kode_sekunder4'] = null;
            }
            if ($diagnosa->diagnosa_sekunder5) {
                $data['kode_sekunder5'] = Smis_Mr_Icd::where('nama', $diagnosa->diagnosa_sekunder5)->first();
            } else {
                $data['kode_sekunder5'] = null;
            }
            if ($diagnosa->diagnosa_pra_bedah) {
                $data['kode_diagnosa_pra_bedah'] = Smis_Mr_Icd::where('nama', $diagnosa->diagnosa_pra_bedah)->first();
            } else {
                $data['kode_diagnosa_pra_bedah'] = null;
            }
            if ($diagnosa->diagnosa_pasca_bedah) {
                $data['kode_diagnosa_pasca_bedah'] = Smis_Mr_Icd::where('nama', $diagnosa->diagnosa_pasca_bedah)->first();
            } else {
                $data['kode_diagnosa_pasca_bedah'] = null;
            }
        }
        $data['diagnosa'] = $diagnosa;

        $data['layanan'] = $layanan;
        $data['all_resep'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->get();
        $data['perujuk'] = SMIS_Rg_Perujuk::all();
        $data['dokter'] = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', 'dokter')->get();
        $data['data_employee'] = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', '!=', 'dokter')->get();
        $data['klinik'] = SmisAdmPrototype::where('prop', '!=', 'del')
            ->where('nama', 'LIKE', '%poli%')
            ->where('status', 'actived')
            ->get();
        return $data;
    }

    function save_gambar_lokasi_pengkajian_awal_medis($req)
    {
        $folderPath = public_path('status_lokalis/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $query = Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat::where('id_dokumen', $req->dokumen)->update([
            'gambar_status_lokalis' => $fileName
        ]);

        return $query;
    }
}
