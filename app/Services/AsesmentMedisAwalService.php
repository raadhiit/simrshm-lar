<?php

namespace App\Services;

use App\Models\Smis_Doc_Asesment_Medis_Awal;
use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\Smis_Rad_Pesanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\DB;

class AsesmentMedisAwalService
{
    function create($data)
    {
        $tes = Smis_Doc_Asesment_Medis_Awal::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'last_nama_ruangan' => $data->ruangan ? $data->ruangan : '',
            'keluhan_utama' => $data->keluhan_utama ? $data->keluhan_utama : '',
            'riwayat_penyakit_sekarang' => $data->riwayat_penyakit_sekarang ? $data->riwayat_penyakit_sekarang : '',
            'riwayat_penyakit_dahulu' => $data->riwayat_penyakit_dahulu ? $data->riwayat_penyakit_dahulu : '',
            'riwayat_alergi_obat' => $data->riwayat_alergi_obat ? $data->riwayat_alergi_obat : '',
            'kesadaran' => $data->kesadaran ? $data->kesadaran : '',
            'ket_sopor_koma' => $data->ket_sopor_koma ? $data->ket_sopor_koma : '',
            'kesadaran_umum' => $data->kesadaran_umum ? $data->kesadaran_umum : '',
            'berat_badan' => $data->berat_badan ? $data->berat_badan : '',
            'saudara' => $data->saudara ? $data->saudara : '',
            'ket_kandung' => $data->ket_kandung ? $data->ket_kandung : '',
            'ket_tiri' => $data->ket_tiri ? $data->ket_tiri : '',
            'tinggal_bersama' => $data->tinggal_bersama ? $data->tinggal_bersama : '',
            'ket_tinggal_lainnya' => $data->ket_tinggal_lainnya ? $data->ket_tinggal_lainnya : '',
            'bicara' => $data->bicara ? $data->bicara : '',
            'komunikasi' => $data->komunikasi ? $data->komunikasi : '',
            'emosional' => $data->emosional ? $data->emosional : '',
            'gangguan_jiwa' => $data->gangguan_jiwa ? $data->gangguan_jiwa : '',
            'tahun_gangguan_jiwa' => $data->tahun_gangguan_jiwa ? $data->tahun_gangguan_jiwa : '',
            'riwayat_trauma' => $data->riwayat_trauma ? $data->riwayat_trauma : '',
            'ket_kriminal' => $data->ket_kriminal ? $data->ket_kriminal : '',
            'perasaan' => $data->perasaan ? $data->perasaan : '',
            'wawancara' => $data->wawancara ? $data->wawancara : '',
            'spiritual' => $data->spiritual ? $data->spiritual : '',
            'kebutuhan_spiritual' => $data->kebutuhan_spiritual ? $data->kebutuhan_spiritual : '',
            'agama_spiritual' => $data->agama_spiritual ? $data->agama_spiritual : '',
            'bantuan_ibadah' => $data->bantuan_ibadah ? $data->bantuan_ibadah : '',
            'status_pernikahan' => $data->status_pernikahan ? $data->status_pernikahan : '',
            'pekerjaan' => $data->pekerjaan ? $data->pekerjaan : '',
            'pekerjaan_lain_lain' => $data->pekerjaan_lain_lain ? $data->pekerjaan_lain_lain : '',
            'nyeri' => $data->nyeri ? $data->nyeri : '',
            'sifat_nyeri' => $data->sifat_nyeri ? $data->sifat_nyeri : '',
            'kualitas_nyeri' => $data->kualitas_nyeri ? $data->kualitas_nyeri : '',
            'nyeri_menjalar' => $data->nyeri_menjalar ? $data->nyeri_menjalar : '',
            'ket_nyeri_menjalar' => $data->ket_nyeri_menjalar ? $data->ket_nyeri_menjalar : '',
            'skor_nyeri' => $data->skor_nyeri ? $data->skor_nyeri : '',
            'frekuensi_nyeri' => $data->frekuensi_nyeri ? $data->frekuensi_nyeri : '',
            'pengaruh_nyeri' => $data->pengaruh_nyeri ? $data->pengaruh_nyeri : '',
            'cara_berjalan' => $data->cara_berjalan ? $data->cara_berjalan : '',
            'memegang_kursi' => $data->memegang_kursi ? $data->memegang_kursi : '',
            'hasil_resiko_jatuh' => $data->hasil_resiko_jatuh ? $data->hasil_resiko_jatuh : '',
            'beritahu_dokter' => $data->beritahu_dokter ? $data->beritahu_dokter : '',
            'jam_diberitahukan' => $data->jam_diberitahukan ? $data->jam_diberitahukan : '',
            'hasil_skrining_resiko_jatuh' => $data->hasil_skrining_resiko_jatuh ? $data->hasil_skrining_resiko_jatuh : '',
            'saran_resiko_jatuh' => $data->saran_resiko_jatuh ? $data->saran_resiko_jatuh : '',
            'bb_gizi' => $data->bb_gizi ? $data->bb_gizi : '',
            'pb_gizi' => $data->pb_gizi ? $data->pb_gizi : '',
            'imt_gizi' => $data->imt_gizi ? $data->imt_gizi : '',
            'tampak_kurus' => $data->tampak_kurus ? $data->tampak_kurus : '',
            'penurunan_bb' => $data->penurunan_bb ? $data->penurunan_bb : '',
            'asupan_makanan' => $data->asupan_makanan ? $data->asupan_makanan : '',
            'hasil_skrining_gizi' => $data->hasil_skrining_gizi ? $data->hasil_skrining_gizi : '',
            'saran_skrining_gizi' => $data->saran_skrining_gizi ? $data->saran_skrining_gizi : '',
            'sensorik_penglihatan' => $data->sensorik_penglihatan ? $data->sensorik_penglihatan : '',
            'sensorik_penciuman' => $data->sensorik_penciuman ? $data->sensorik_penciuman : '',
            'sensorik_pendengaran' => $data->sensorik_pendengaran ? $data->sensorik_pendengaran : '',
            'kognitif_satu' => $data->kognitif_satu ? $data->kognitif_satu : '',
            'kognitif_dua' => '',
            'motorik_satu' => $data->motorik_satu ? $data->motorik_satu : '',
            'motorik_dua' => $data->motorik_dua ? $data->motorik_dua : '',
            'saran_satu' => $data->saran_satu ? $data->saran_satu : '',
            'saran_dua' => $data->saran_dua ? $data->saran_dua : '',
            'saran_tiga' => $data->saran_tiga ? $data->saran_tiga : '',
            'hasil_discharge_planning' => $data->hasil_discharge_planning ? $data->hasil_discharge_planning : '',
            'saran_discharge_planning' => $data->saran_discharge_planning ? $data->saran_discharge_planning : '',
            'pemeriksaan_penunjang' => $data->pemeriksaan_penunjang ? $data->pemeriksaan_penunjang : '',
            'status_generalis' => $data->status_generalis ? $data->status_generalis : '',
            'kontrol_ulang' => $data->kontrol_ulang ? $data->kontrol_ulang : '',
            'tgl_kontrol_ulang' => $data->tgl_kontrol_ulang ? $data->tgl_kontrol_ulang : '',
            'rujuk' => $data->rujuk ? $data->rujuk : '',
            'tgl_rujuk' => $data->tgl_rujuk ? $data->tgl_rujuk : '',
            'penyampaian_edukasi' => $data->penyampaian_edukasi ? $data->penyampaian_edukasi : '',
            'id_ppa' => $data->id_ppa ? $data->id_ppa : '',
            'ppa' => $data->ppa ? $data->ppa : '',
            'subyektif' => $data->subyektif ? $data->subyektif : '',
            'instruksi_kesehatan' => $data->instruksi_kesehatan ? $data->instruksi_kesehatan : '',
            'nama_obat_1' => $data->nama_obat_1 ? $data->nama_obat_1 : '',
            'jumlah_obat_1' => $data->jumlah_obat_1 ? $data->jumlah_obat_1 : '',
            'aturan_pakai_obat_1' => $data->aturan_pakai_obat_1 ? $data->aturan_pakai_obat_1 : '',
            'tanggal_mulai_minum_obat_1' => $data->tanggal_mulai_minum_obat_1 ? $data->tanggal_mulai_minum_obat_1 : '',
            'keterangan_obat_1' => $data->keterangan_obat_1 ? $data->keterangan_obat_1 : '',
            'nama_obat_2' => $data->nama_obat_2 ? $data->nama_obat_2 : '',
            'jumlah_obat_2' => $data->jumlah_obat_2 ? $data->jumlah_obat_2 : '',
            'aturan_pakai_obat_2' => $data->aturan_pakai_obat_2 ? $data->aturan_pakai_obat_2 : '',
            'tanggal_mulai_minum_obat_2' => $data->tanggal_mulai_minum_obat_2 ? $data->tanggal_mulai_minum_obat_2 : '',
            'keterangan_obat_2' => $data->keterangan_obat_2 ? $data->keterangan_obat_2 : '',
            'nama_obat_3' => $data->nama_obat_3 ? $data->nama_obat_3 : '',
            'jumlah_obat_3' => $data->jumlah_obat_3 ? $data->jumlah_obat_3 : '',
            'aturan_pakai_obat_3' => $data->aturan_pakai_obat_3 ? $data->aturan_pakai_obat_3 : '',
            'tanggal_mulai_minum_obat_3' => $data->tanggal_mulai_minum_obat_3 ? $data->tanggal_mulai_minum_obat_3 : '',
            'keterangan_obat_3' => $data->keterangan_obat_3 ? $data->keterangan_obat_3 : '',
            'nama_obat_4' => $data->nama_obat_4 ? $data->nama_obat_4 : '',
            'jumlah_obat_4' => $data->jumlah_obat_4 ? $data->jumlah_obat_4 : '',
            'aturan_pakai_obat_4' => $data->aturan_pakai_obat_4 ? $data->aturan_pakai_obat_4 : '',
            'tanggal_mulai_minum_obat_4' => $data->tanggal_mulai_minum_obat_4 ? $data->tanggal_mulai_minum_obat_4 : '',
            'keterangan_obat_4' => $data->keterangan_obat_4 ? $data->keterangan_obat_4 : '',
            'nama_obat_5' => $data->nama_obat_5 ? $data->nama_obat_5 : '',
            'jumlah_obat_5' => $data->jumlah_obat_5 ? $data->jumlah_obat_5 : '',
            'aturan_pakai_obat_5' => $data->aturan_pakai_obat_5 ? $data->aturan_pakai_obat_5 : '',
            'tanggal_mulai_minum_obat_5' => $data->tanggal_mulai_minum_obat_5 ? $data->tanggal_mulai_minum_obat_5 : '',
            'keterangan_obat_5' => $data->keterangan_obat_5 ? $data->keterangan_obat_5 : '',
            'nama_obat_6' => $data->nama_obat_6 ? $data->nama_obat_6 : '',
            'jumlah_obat_6' => $data->jumlah_obat_6 ? $data->jumlah_obat_6 : '',
            'aturan_pakai_obat_6' => $data->aturan_pakai_obat_6 ? $data->aturan_pakai_obat_6 : '',
            'tanggal_mulai_minum_obat_6' => $data->tanggal_mulai_minum_obat_6 ? $data->tanggal_mulai_minum_obat_6 : '',
            'keterangan_obat_6' => $data->keterangan_obat_6 ? $data->keterangan_obat_6 : '',
            'gcs_e' => $data->gcs_e ? $data->gcs_e : '',
            'gcs_v' => $data->gcs_v ? $data->gcs_v : '',
            'gcs_m' => $data->gcs_m ? $data->gcs_m : '',
        ]);

        $selected = Smis_Doc_Asesment_Medis_Awal::where('id_dokumen', $data->dokumen)->first();
        if ($selected->id_pesanan_lab != 0) {
            DB::table('smis_lab_pesanan')->where('id', $selected->id_pesanan_lab)->update([
                'keluhan_klinis' => $data->keluhan_utama
            ]);
        }

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

    function update_persetujuan($data)
    {
        try {
            Smis_Doc_General_Consent::where('id_dokumen', $data->dokumen)->update([
                'nama' => $data->nama,
                'tgl_lahir' => $data->tgl_lahir,
                'alamat' => $data->alamat,
                'telpon' => $data->telepon,
                'no_identitas' => $data->no_identitas,
                'pi_satu' => $data->pi_satu,
                'pi_dua' => $data->pi_dua,
                'pi_tiga' => $data->pi_tiga,
                'hubungan_satu' => $data->hubungan_satu,
                'hubungan_dua' => $data->hubungan_dua,
                'hubungan_tiga' => $data->hubungan_tiga,
                'mengijinkan' => $data->perijinan,
                'keterangan_mengijinkan' => $data->keterangan_mengijinkan,
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('asesment_medis_awal')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
//        $data['layanan'] = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
//            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
//                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
//                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
//                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp',
//                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
//            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
//            ->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'tanda_vital'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp', 'smis_rg_layananpasien.umur', 'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan', 'smis_rg_layananpasien.last_nama_ruangan',
                'smis_rg_layananpasien.nama_perusahaan', 'smis_rg_asuransi.nama as asuransi', 'smis_rg_layananpasien.last_bed',
                'smis_rg_layananpasien.uri')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $data['kelas_lab'] = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $data['kelas_rad'] = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-jenis')->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();

        $data['pesanan_lab'] = SMIS_LabPesanan::where('id', ($data['dokumen']->asesment_medis_awal ? $data['dokumen']->asesment_medis_awal->id_pesanan_lab : 0))->where('prop', '')->first();
        $data['pesanan_rad'] = Smis_Rad_Pesanan::where('id', ($data['dokumen']->asesment_medis_awal ? $data['dokumen']->asesment_medis_awal->id_pesanan_rad : 0))->where('prop', '')->first();

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
