<?php

namespace App\Services;

use App\Models\Smis_Doc_Asesment_Medis_Awal;
use App\Models\Smis_Doc_Dokumen_Laporan_Caesarian;
use App\Models\Smis_Doc_Dokumen_Transfer_Pasien_Internal;
use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Surat_Permintaan_Rawat_Inap;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class DokumenLaporanCaesarianService
{
    function create($data)
    {
        $tes = Smis_Doc_Dokumen_Laporan_Caesarian::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'id_d_operator' => $data->id_d_operator ? $data->id_d_operator : 0,
            'd_operator' => $data->d_operator ? $data->d_operator : '',
            'id_a_operator' => $data->id_a_operator ? $data->id_a_operator : 0,
            'a_operator' => $data->a_operator ? $data->a_operator : '',
            'id_instrumen' => $data->id_instrumen ? $data->id_instrumen : 0,
            'instrumen' => $data->instrumen ? $data->instrumen : '',
            'id_d_anastesi' => $data->id_d_anastesi ? $data->id_d_anastesi : 0,
            'd_anastesi' => $data->d_anastesi ? $data->d_anastesi : '',
            'id_a_anastesi' => $data->id_a_anastesi ? $data->id_a_anastesi : 0,
            'a_anastesi' => $data->a_anastesi ? $data->a_anastesi : '',
            'jenis_anastesi' => $data->jenis_anastesi ? $data->jenis_anastesi : '',
            'tindakan' => $data->tindakan ? $data->tindakan : '',
            'indikasi_operasi' => $data->indikasi_operasi ? $data->indikasi_operasi : '',
            'posisi' => $data->posisi ? $data->posisi : '',
            'jenis_pembedahan' => $data->jenis_pembedahan ? $data->jenis_pembedahan : '',
            'jenis_pembedahan2' => $data->jenis_pembedahan2 ? $data->jenis_pembedahan2 : '',
            'jenis_luka_operasi' => $data->jenis_luka_operasi ? $data->jenis_luka_operasi : '',
            'tanggal' => $data->tanggal ? $data->tanggal : date('Y-m-d'),
            'mulai' => $data->mulai ? $data->mulai : date('H:i'),
            'selesai' => $data->selesai ? $data->selesai : date('H:i'),
            'lama_pembedahan' => $data->lama_pembedahan ? $data->lama_pembedahan : '',
            'catatan' => $data->catatan ? $data->catatan : '',
            'ket_antisepsis' => $data->ket_antisepsis ? $data->ket_antisepsis : '',
            'ket_insisi' => $data->ket_insisi ? $data->ket_insisi : '',
            'air_ketuban' => $data->air_ketuban ? $data->air_ketuban : '',
            'jumlah_air_ketuban' => $data->jumlah_air_ketuban ? $data->jumlah_air_ketuban : '',
            'bayi' => $data->bayi ? $data->bayi : '',
            'bb1' => $data->bb1 ? $data->bb1 : '',
            'pb1' => $data->pb1 ? $data->pb1 : '',
            'as1' => $data->as1 ? $data->as1 : '',
            'kelamin1' => $data->kelamin1 ? $data->kelamin1 : '',
            'ket_plasenta' => $data->ket_plasenta ? $data->ket_plasenta : '',
            'lahir_dengan' => $data->lahir_dengan ? $data->lahir_dengan : '',
            'kelainan' => $data->kelainan ? $data->kelainan : '',
            'ket_sbu_jahit' => $data->ket_sbu_jahit ? $data->ket_sbu_jahit : '',
            'tubae' => $data->tubae ? $data->tubae : '',
            'ovarium_kiri' => $data->ovarium_kiri ? $data->ovarium_kiri : '',
            'ovarium_kanan' => $data->ovarium_kanan ? $data->ovarium_kanan : '',
            'jumlah' => $data->jumlah ? $data->jumlah : '',
            'det_jumlah' => $data->det_jumlah ? $data->det_jumlah : '',
            'ket_jumlah' => $data->ket_jumlah ? $data->ket_jumlah : '',
            'ket_pendarahan' => $data->ket_pendarahan ? $data->ket_pendarahan : '',
            'no_batch' => $data->no_batch ? $data->no_batch : '',
            'komplikasi' => $data->komplikasi ? $data->komplikasi : '',
            'pendarahan' => $data->pendarahan ? $data->pendarahan : '',
            'dikirim_pa' => $data->dikirim_pa ? $data->dikirim_pa : '',
            'asal_jaringan' => $data->asal_jaringan ? $data->asal_jaringan : '',
            'pra_bedah' => $data->pra_bedah ? $data->pra_bedah : '',
            'pasca_bedah' => $data->pasca_bedah ? $data->pasca_bedah : '',
            'dilahirkan_dengan' => $data->dilahirkan_dengan ?? '',
            'isian_tubae' => $data->isian_tubae ?? '',
            'isian_ovarium_kiri' => $data->isian_ovarium_kiri ?? '',
            'isian_ovarium_kanan' => $data->isian_ovarium_kanan ?? '',
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
        $data['dokumen'] = DokumenKunjungan::with('dokumen_laporan_caesarian')
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
