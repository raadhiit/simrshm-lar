<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Survei_Infeksi_Rumah_Sakit;
use App\Models\SMIS_Pasien;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class SurveiInfeksiRumahSakitService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $pasien = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data = Smis_Doc_Survei_Infeksi_Rumah_Sakit::where('id_dokumen', $dokumen->id)->first();
        return [
            'dokumen' => $dokumen,
            'pasien' => $pasien,
            'data' => $data,
            'dokter' => $data ? SmisHrdEmployee::where('nama', $data->nama_dokter)->where('prop','')->first() : null,
            'kepala_ruangan' => $data ? SmisHrdEmployee::where('nama', $data->nama_kepala_ruangan)->where('prop','')->first() : null,
        ];
    }

    function store($req)
    {
        $select = Smis_Doc_Survei_Infeksi_Rumah_Sakit::where('id_dokumen', $req->dokumen)->first();
        switch ($req->jenis_verif) {
            case 'dokter':
                // dd($req->dokumen);
                $query = Smis_Doc_Survei_Infeksi_Rumah_Sakit::updateOrCreate([
                    'id_dokumen' => $req->dokumen
                ],[
                    'smf_utama' => $req->smf_utama,
                    'tanggal_masuk' => $req->tanggal_masuk ? date('Y-m-d', strtotime($req->tanggal_masuk)) : date('Y-m-d'),
                    'tanggal_keluar' => $req->tanggal_keluar ? date('Y-m-d', strtotime($req->tanggal_keluar)) : date('Y-m-d'),
                    'bb' => $req->bb ? $req->bb : '',
                    'tb' => $req->tb ? $req->tb : '',
                    'cara_masuk' => $req->cara_masuk ? $req->cara_masuk : '',
                    'keadaan_keluar' => $req->keadaan_keluar ? $req->keadaan_keluar : '',
                    'diagnosa_akhir' => $req->diagnosa_akhir ? $req->diagnosa_akhir : '',
                    'tempat_dirawat' => $req->tempat_dirawat ? $req->tempat_dirawat : '',
                    'faktor_resiko' => $req->faktor_resiko ? $req->faktor_resiko : '',
                    'iadp' => $req->iadp ? $req->iadp : '',
                    'infeksi_saluran_kemih' => $req->infeksi_saluran_kemih ? $req->infeksi_saluran_kemih : '',
                    'pneumonia_ventilator' => $req->pneumonia_ventilator ? $req->pneumonia_ventilator : '',
                    'infeksi_luka_operasi' => $req->infeksi_luka_operasi ? $req->infeksi_luka_operasi : '',
                    'id_dokter' => Auth::user()->id,
                    'nama_dokter' => Auth::user()->realname,
                    'id_kepala_ruangan' => $select ? $select->id_kepala_ruangan : 0,
                    'nama_kepala_ruangan' => $select ? $select->nama_kepala_ruangan : '',
                    'tanggal_verifikasi' => $req->tanggal_verifikasi ? date('Y-m-d', strtotime($req->tanggal_verifikasi)) : date('Y-m-d'),
                ]);
                break;
            case 'kepala_ruangan':
                Smis_Doc_Survei_Infeksi_Rumah_Sakit::updateOrCreate([
                    'id_dokumen' => $req->dokumen
                ],[
                    'smf_utama' => $req->smf_utama,
                    'tanggal_masuk' => $req->tanggal_masuk ? date('Y-m-d', strtotime($req->tanggal_masuk)) : date('Y-m-d'),
                    'tanggal_keluar' => $req->tanggal_keluar ? date('Y-m-d', strtotime($req->tanggal_keluar)) : date('Y-m-d'),
                    'bb' => $req->bb ? $req->bb : '',
                    'tb' => $req->tb ? $req->tb : '',
                    'cara_masuk' => $req->cara_masuk ? $req->cara_masuk : '',
                    'keadaan_keluar' => $req->keadaan_keluar ? $req->keadaan_keluar : '',
                    'diagnosa_akhir' => $req->diagnosa_akhir ? $req->diagnosa_akhir : '',
                    'tempat_dirawat' => $req->tempat_dirawat ? $req->tempat_dirawat : '',
                    'faktor_resiko' => $req->faktor_resiko ? $req->faktor_resiko : '',
                    'iadp' => $req->iadp ? $req->iadp : '',
                    'infeksi_saluran_kemih' => $req->infeksi_saluran_kemih ? $req->infeksi_saluran_kemih : '',
                    'pneumonia_ventilator' => $req->pneumonia_ventilator ? $req->pneumonia_ventilator : '',
                    'infeksi_luka_operasi' => $req->infeksi_luka_operasi ? $req->infeksi_luka_operasi : '',
                    'id_dokter' => $select ? $select->id_dokter : 0,
                    'nama_dokter' => $select ? $select->nama_dokter : '',
                    'id_kepala_ruangan' => Auth::user()->id,
                    'nama_kepala_ruangan' => Auth::user()->realname,
                    'tanggal_verifikasi' => $req->tanggal_verifikasi ? date('Y-m-d', strtotime($req->tanggal_verifikasi)) : date('Y-m-d'),
                ]);
                break;

            default:
                # code...
                break;
        }

        return Smis_Doc_Survei_Infeksi_Rumah_Sakit::where('id_dokumen', $req->dokumen)->first();
    }
}
