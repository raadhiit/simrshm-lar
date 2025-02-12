<?php

namespace App\Services;

use App\Models\Smis_Doc_Asesment_Medis_Awal;
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

class DokumenTransferPasienInternalService
{
    function create($data)
    {
        $tes = Smis_Doc_Dokumen_Transfer_Pasien_Internal::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'tgl_transfer' => $data->tgl_transfer,
            'jam_transfer' => $data->jam_transfer,
            'id_dpjp' => $data->id_dpjp,
            'dpjp' => $data->dpjp,
            'riwayat_penyakit' => $data->riwayat_penyakit,
            'indikasi_rawat' => $data->indikasi_rawat,
            'id_unit' => $data->id_unit,
            'unit' => $data->unit,
            'keadaan_umum' => $data->keadaan_umum,
            'tindakan_dokter' => $data->tindakan_dokter,
            'tindakan_perawat' => $data->tindakan_perawat,
            'gcs_e' => $data->gcs_e ? $data->gcs_e : '',
            'gcs_m' => $data->gcs_m ? $data->gcs_m : '',
            'gcs_v' => $data->gcs_v ? $data->gcs_v : '',
            'kesadaran' => $data->kesadaran ? $data->kesadaran : '',
            'fasilitas_transfer' => $data->fasilitas_transfer,
            'ket_fasilitas_transfer' => $data->ket_fasilitas_transfer ? $data->ket_fasilitas_transfer : '',
            'TD' => $data->TD ? $data->TD : '',
            'RR' => $data->RR ? $data->RR : '',
            'Nadi' => $data->Nadi ? $data->Nadi : '',
            'Suhu' => $data->Suhu ? $data->Suhu : ''
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
        $data['dokumen'] = DokumenKunjungan::with('dokumen_transfer_pasien_internal')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['petugas_penyerahan'] = $data['dokumen']->dokumen_transfer_pasien_internal ? SmisHrdEmployee::where('nama', $data['dokumen']->dokumen_transfer_pasien_internal->petugas_penyerahan)->first() : [];

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
