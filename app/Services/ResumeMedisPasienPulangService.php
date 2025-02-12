<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Resume_Medis_Pasien_Pulang;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Mr_Tanda_Vital;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ResumeMedisPasienPulangService
{
    function create($data)
    {
        $tes = Smis_Doc_Resume_Medis_Pasien_Pulang::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'indikasi_rawat_inap' => $data->indikasi_rawat_inap ? $data->indikasi_rawat_inap : '',
            'riwayat_kesehatan' => $data->riwayat_kesehatan ? $data->riwayat_kesehatan : '',
            'pemeriksaan_fisik' => $data->pemeriksaan_fisik ? $data->pemeriksaan_fisik : '',
            'pemeriksaan_penunjang' => $data->pemeriksaan_penunjang ? $data->pemeriksaan_penunjang : '[]',
            'ket_pemeriksaan_penunjang' => $data->ket_pemeriksaan_penunjang ? $data->ket_pemeriksaan_penunjang : "",
            'tgl_kontrol' => $data->tgl_kontrol ?? "",
            'tgl_keluar' => $data->tgl_keluar ?? "",
            'perawatan_dirumah' => $data->perawatan_dirumah ? $data->perawatan_dirumah : "",
            'rencana_pemeriksaan_penunjang' => $data->rencana_pemeriksaan_penunjang ? $data->rencana_pemeriksaan_penunjang : "",
            'kebutuhan_edukasi' => $data->kebutuhan_edukasi ? $data->kebutuhan_edukasi : "",
            'ket_pertolongan_mendesak' => $data->ket_pertolongan_mendesak ? $data->ket_pertolongan_mendesak : "",
            'ket_kebutuhan_edukasi' => $data->ket_kebutuhan_edukasi ? $data->ket_kebutuhan_edukasi : "",
            'keadaan_akhir' => $data->keadaan_akhir ? $data->keadaan_akhir : '',
            'mobilisasi_pulang' => $data->mobilisasi_pulang ? $data->mobilisasi_pulang : '',
            'alat_bantu' => $data->alat_bantu ? $data->alat_bantu : '',
            'alkes' => $data->alkes ? $data->alkes : '',
            'dit' => $data->dit ? $data->dit : '',
            'disertakan_waktu_pulang' => $data->disertakan_waktu_pulang ? $data->disertakan_waktu_pulang : '[]',
            'ket_disertakan_waktu_pulang' => $data->ket_disertakan_waktu_pulang ? $data->ket_disertakan_waktu_pulang : "",
            'penyakit_berhubungan' => $data->penyakit_berhubungan ? $data->penyakit_berhubungan : '',
            'icd_tindakan' => $data->icd_tindakan ? $data->icd_tindakan : '',
            'diagnosa_primer' => $data->diagnosa_primer ? $data->diagnosa_primer : '',
            'icd_primer' => $data->icd_primer ? $data->icd_primer : '',
            'diagnosa_sekunder' => $data->diagnosa_sekunder ? $data->diagnosa_sekunder : '',
            'icd_sekunder' => $data->icd_sekunder ? $data->icd_sekunder : '',
            'tindakan_prosedur' => $data->tindakan_prosedur ? $data->tindakan_prosedur : '',
            "diagnosa_sekunder2" => $data->diagnosa_sekunder2 ?? "",
            "icd_sekunder2" => $data->icd_sekunder2 ?? "",
            "diagnosa_sekunder3" => $data->diagnosa_sekunder3 ?? "",
            "icd_sekunder3" => $data->icd_sekunder3 ?? "",
            "diagnosa_sekunder4" => $data->diagnosa_sekunder4 ?? "",
            "icd_sekunder4" => $data->icd_sekunder4 ?? "",
            "diagnosa_sekunder5" => $data->diagnosa_sekunder5 ?? "",
            "icd_sekunder5" => $data->icd_sekunder5 ?? "",
            "pemeriksaan_lainnya" => $data->pemeriksaan_lainnya ?? "",
            "diagnosa_penyerta1" => $data->diagnosa_penyerta1 ?? "",
            "icd_penyerta1" => $data->icd_penyerta1 ?? "",
            "diagnosa_penyerta2" => $data->diagnosa_penyerta2 ?? "",
            "icd_penyerta2" => $data->icd_penyerta2 ?? "",
            "diagnosa_penyerta3" => $data->diagnosa_penyerta3 ?? "",
            "icd_penyerta3" => $data->icd_penyerta3 ?? "",
            "diagnosa_penyerta4" => $data->diagnosa_penyerta4 ?? "",
            "icd_penyerta4" => $data->icd_penyerta4 ?? "",
            "diagnosa_penyerta5" => $data->diagnosa_penyerta5 ?? "",
            "icd_penyerta5" => $data->icd_penyerta5 ?? "",
            "pemeriksaan_lainnya" => $data->pemeriksaan_lainnya ?? "",
            "tindakan_prosedur" => $data->tindakan_prosedur ?? "",
            "tgl_dokumen" => $data->tgl_dokumen ?? "",
        ]);

        $cek = DB::table('smis_mr_tanda_vital')->where('id', $data->id_ttv)->get();
        if (count($cek) > 0) {
            DB::table('smis_mr_tanda_vital')->where('id', $data->id_ttv)->update([
                'ruangan' => $data->ruangan,
                'noreg_pasien' => $data->noreg,
                'nrm_pasien' => $data->nrm,
                'nama_pasien' => $data->nama_pasien,
                'time_updated' => Carbon::now()->toDateTimeString(),
                'keadaan_umum' => $data->keadaan_umum,
                'kesadaran' => $data->kesadaran ? $data->kesadaran : '',
                'tensi' => $data->tensi,
                'nadi' => $data->nadi,
                'suhu' => $data->suhu,
                'rr' => $data->rr
            ]);
        } else {
            $id_ttv = DB::table('smis_mr_tanda_vital')->insertGetId([
                'waktu' => Carbon::now()->toDateTimeString(),
                'ruangan' => $data->ruangan,
                'noreg_pasien' => $data->noreg,
                'nrm_pasien' => $data->nrm,
                'nama_pasien' => $data->nama_pasien,
                'time_updated' => Carbon::now()->toDateTimeString(),
                'keadaan_umum' => $data->keadaan_umum,
                'kesadaran' => $data->kesadaran ? $data->kesadaran : '',
                'tensi' => $data->tensi,
                'nadi' => $data->nadi,
                'suhu' => $data->suhu,
                'rr' => $data->rr
            ]);

            if ($tes) {
                Smis_Doc_Resume_Medis_Pasien_Pulang::where('id_dokumen', $data->dokumen)->update([
                    'id_ttv' => $id_ttv
                ]);
            } else {
                Smis_Doc_Resume_Medis_Pasien_Pulang::updateOrCreate([
                    'id_dokumen' => $data->dokumen,
                ], [
                    'id_ttv' => $id_ttv
                ]);
            }
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

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('resume_medis_pasien_pulang')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();

        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->realname)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['tanda_vital'] = Smis_Mr_Tanda_Vital::where('id', $data['dokumen']->resume_medis_pasien_pulang ? $data['dokumen']->resume_medis_pasien_pulang->id_ttv : '')->first();

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
                'smis_rg_layananpasien.tanggal_inap',
                'smis_rg_layananpasien.tanggal_pulang',
                'smis_rg_layananpasien.last_kelas',
                'smis_rg_layananpasien.last_nama_ruangan'
            )
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
        $data['tindakan'] = DB::table('smis_rwt_ok_ok')->where('noreg_pasien', $data['dokumen']->noreg)
            ->get();
        // dd($data['dokumen']->noreg);
        // $data['tindakan_dokter'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
        //     ->where('nama_grup', 'tindakan_dokter')
        //     ->get();
        // $data['tindakan_perawat'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
        //     ->where('nama_grup', 'tindakan_perawat')
        //     ->get();
        // $data['oksigen_manual'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
        //     ->where('nama_grup', 'oksigen_manual')
        //     ->get();
        // $data['oksigen_central'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
        //     ->where('nama_grup', 'oksigen_central')
        //     ->get();
        $data['all_resep'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->where('krs', 0)->where('prop', '')->get();
        $data['resep_post_rawat'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->where('krs', 1)->where('prop', '')->get();
        return $data;
    }
}
