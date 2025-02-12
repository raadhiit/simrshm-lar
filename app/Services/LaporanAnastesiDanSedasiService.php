<?php

namespace App\Services;

use App\Models\Smis_Doc_Dokumen_Transfer_Pasien_Internal;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Laporan_Anastesi_Dan_Sedasi;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class LaporanAnastesiDanSedasiService
{
    function create($data)
    {
        $select = Smis_Doc_Laporan_Anastesi_Dan_Sedasi::where('id_dokumen', $data->dokumen)->first();

        $nama_file1 = '';
        $nama_file2 = '';
        if ($data->gambar1) {
            $folderPath = public_path('gambar_laporan_anastesi/');

            $image_parts = explode(";base64,", $data->gambar1);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            $nama_file1 = $fileName;
            file_put_contents($file, $image_base64);
        }

        if ($data->gambar2) {
            $folderPath = public_path('gambar_laporan_anastesi/');

            $image_parts = explode(";base64,", $data->gambar2);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            $nama_file2 = $fileName;
            file_put_contents($file, $image_base64);
        }

        if ($select) {
            if ($select->gambar1 != '' || $select->gambar1 != null) {
                unlink('gambar_laporan_anastesi/' . $select->gambar1);
            }
            if ($select->gambar2 != '' || $select->gambar2 != null) {
                unlink('gambar_laporan_anastesi/' . $select->gambar2);
            }
        }

        $tes = Smis_Doc_Laporan_Anastesi_Dan_Sedasi::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'isian_satu' => $data->isian_satu ? $data->isian_satu : '[]',
            'isian_dua' => $data->isian_dua ? $data->isian_dua : '[]',
            'status_fisik_asa' => $data->status_fisik_asa,
            'id_d_anastesi' => $data->id_d_anastesi,
            'd_anastesi' => $data->d_anastesi,
            'id_perawat' => $data->id_perawat,
            'perawat' => $data->perawat,
            'id_instrumen' => $data->id_instrumen,
            'instrumen' => $data->instrumen,
            'diagnosa_pre_op' => $data->diagnosa_pre_op,
            'diagnosa_post_op' => $data->diagnosa_post_op,
            'tindakan' => $data->tindakan,
            'jenis_anastesi' => $data->jenis_anastesi,
            'resiko_anastesi' => $data->resiko_anastesi,
            'tb_pre' => $data->tb_pre,
            'bb_pre' => $data->bb_pre,
            'td' => $data->td,
            'hb' => $data->hb,
            'nadi' => $data->nadi,
            'ht' => $data->ht,
            'suhu' => $data->suhu,
            'gol_darah' => $data->gol_darah,
            'gcs_e' => $data->gcs_e,
            'gcs_m' => $data->gcs_m,
            'gcs_v' => $data->gcs_v,
            'pramedikasi' => $data->pramedikasi,
            'profol' => $data->profol,
            'midazolam' => $data->midazolam,
            'rl' => $data->rl,
            'fentanyl' => $data->fentanyl,
            'medikasi1' => $data->medikasi1,
            'det_medikasi1' => $data->det_medikasi1,
            'pethidin' => $data->pethidin,
            'medikasi2' => $data->medikasi2,
            'det_medikasi2' => $data->det_medikasi2,
            'atrakurium' => $data->atrakurium,
            'sa' => $data->sa,
            'urine' => $data->urine,
            'buvupacaine' => $data->buvupacaine,
            'cm_satu' => $data->cm_satu,
            'cm_dua' => $data->cm_dua,
            'jm_satu' => $data->jm_satu,
            'jm_dua' => $data->jm_dua,
            'jm_tiga' => $data->jm_tiga,
            'jm_empat' => $data->jm_empat,
            'jm_lima' => $data->jm_lima,
            'jm_enam' => $data->jm_enam,
            'jm_tujuh' => $data->jm_tujuh,
            'jm_delapan' => $data->jm_delapan,
            'jm_sembilan' => $data->jm_sembilan,
            'jm_sepuluh' => $data->jm_sepuluh,
            'pendarahan' => $data->pendarahan,
            'ngt' => $data->ngt,
            'catatan' => $data->catatan,
            'ket_tunda' => $data->ket_tunda,
            // 'regional' => $data->regional,
            'regional' => $data->regional ? $data->regional : '[]',
            'tiva' => $data->tiva ? $data->tiva : '[]',
            'induksi' => $data->induksi,
            // 'tiva' => $data->tiva,
            'inhalasi' => $data->inhalasi,
            'ett_lma' => $data->ett_lma,
            'ket_ett_lma' => $data->ket_ett_lma,
            'masker' => $data->masker,
            'maintance' => $data->maintenance,
            'jam_anastesi' => $data->jam_anastesi,
            'spo1' => $data->spo1,
            'spo2' => $data->spo2,
            'spo3' => $data->spo3,
            'spo4' => $data->spo4,
            'waktu_anastesi' => $data->waktu_anastesi,
            'selesai_anastesi' => $data->selesai_anastesi,
            'pasien_masuk_rr' => $data->pasien_masuk_rr,
            'id_perawat_masuk_rr' => $data->id_perawat_masuk_rr,
            'perawat_masuk_rr' => $data->perawat_masuk_rr,
            'id_penata_anastesi' => $data->id_penata_anastesi,
            'penata_anastesi' => $data->penata_anastesi,
            'jam_anastesi2' => $data->jam_anastesi2,
            'pasien_keluar_rr' => $data->pasien_keluar_rr,
            'keluar_rr' => $data->keluar_rr,
            'id_perawat_keluar_rr' => $data->id_perawat_keluar_rr,
            'perawat_keluar_rr' => $data->perawat_keluar_rr,
            'id_perawat_penerima' => $data->id_perawat_penerima,
            'perawat_penerima' => $data->perawat_penerima,
            'aktivitas_motorik_masuk' => $data->aktivitas_motorik_masuk,
            'aktivitas_motorik_keluar' => $data->aktivitas_motorik_keluar,
            'respirasi_masuk' => $data->respirasi_masuk,
            'respirasi_keluar' => $data->respirasi_keluar,
            'sirkulasi_masuk' => $data->sirkulasi_masuk,
            'sirkulasi_keluar' => $data->sirkulasi_keluar,
            'kesadaran_masuk' => $data->kesadaran_masuk,
            'kesadaran_keluar' => $data->kesadaran_keluar,
            'warna_kulit_masuk' => $data->warna_kulit_masuk,
            'warna_kulit_keluar' => $data->warna_kulit_keluar,
            'bromage_masuk' => $data->bromage_masuk,
            'bromage_keluar' => $data->bromage_keluar,
            'kesadaran_steward_masuk' => $data->kesadaran_steward_masuk,
            'kesadaran_steward_keluar' => $data->kesadaran_steward_keluar,
            'respirasi_steward_masuk' => $data->respirasi_steward_masuk,
            'respirasi_steward_keluar' => $data->respirasi_steward_keluar,
            'aktifitas_motorik_steward_masuk' => $data->aktifitas_motorik_steward_masuk,
            'aktifitas_motorik_steward_keluar' => $data->aktifitas_motorik_steward_keluar,
            'gambar1' => $nama_file1,
            'gambar2' => $nama_file2,
        ]);

        return $tes;
    }

    function verifikasi($req)
    {
        $query = Smis_Doc_Dokumen_Transfer_Pasien_Internal::where('id_dokumen', $req->dokumen)
            ->update([
                'id_petugas_penyerahan' => Auth::user()->id,
                'petugas_penyerahan' => Auth::user()->realname
            ]);
        return $query;
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('dokumen_laporan_anastesi_dan_sedasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['petugas_penyerahan'] = SmisHrdEmployee::where('nama', $data['dokumen']->petugas_penyerahan)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                'smis_rg_layananpasien.tanggal'
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
        return $data;
    }
}
