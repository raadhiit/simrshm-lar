<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Lembar_Konsultasi;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SmisHrdEmployee;
use App\Services\DokumenKunjunganService;
use Illuminate\Support\Facades\Auth;

class LembarKonsultasiService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $data = Smis_Doc_Lembar_Konsultasi::where('id_dokumen', $dokumen->id)->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first();
        // $employee_konsul = $dokumen ? $dokumen->id_konsul != 0 ? SmisHrdEmployee::where('nama', $dokumen->nama_konsul)->where('prop','')->first() : null : null;
        // $employee_jawab = $dokumen ? $dokumen->id_jawab != 0 ? SmisHrdEmployee::where('nama', $dokumen->nama_jawab)->where('prop','')->first() : null : null;
        $employee_konsul = null;
        if ($data && $data->id_konsul != 0) {
            $employee_konsul = SmisHrdEmployee::where('nama', $data->nama_konsul)->where('prop', '')->first();
        }

        $employee_jawab = null;
        if ($data && $data->id_jawab != 0) {
            $employee_jawab = SmisHrdEmployee::where('nama', $data->nama_jawab)->where('prop', '')->first();
        }

        return [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien'  => $pasien,
            'data' => $data,
            'employee_konsul' => $employee_konsul,
            'employee_jawab' => $employee_jawab,
        ];
    }

    function store($req)
    {
        $select = Smis_Doc_Lembar_Konsultasi::where('id_dokumen', $req->dokumen)->first();

        switch ($req->jenis_verif) {
            case 'konsul':
                Smis_Doc_Lembar_Konsultasi::updateOrCreate([
                    'id_dokumen' => $req->dokumen,
                ], [
                    'id_kepada' => $req->id_kepada ? $req->id_kepada : 0,
                    'kepada' => $req->kepada ? $req->kepada : '',
                    'sejawat' => $req->sejawat ? $req->sejawat : '',
                    'spesialis' => $req->spesialis ? $req->spesialis : '',
                    'jenis_konsul' => $req->jenis_konsul ? $req->jenis_konsul : '',
                    'tanggal' => $req->tanggal ? date('Y-m-d H:i:s', strtotime($req->tanggal)) : '0000-00-00 00:00:00',
                    'keterangan_klinis' => $req->keterangan_klinis ? $req->keterangan_klinis : '',
                    'diagnosa' => $req->diagnosa ? $req->diagnosa : '',
                    'id_konsul' => Auth::user()->id,
                    'nama_konsul' => Auth::user()->realname,
                    'temuan' => $select ? $select->temuan : '',
                    'keluhan' => $select ? $select->keluhan : '',
                    'saran_tindakan' => $select ? $select->saran_tindakan : '',
                    'konsultasi_ulang' => $select ? $select->konsultasi_ulang : '0000-00-00',
                    'tindakan_khusus' => $select ? $select->tindakan_khusus : '',
                    'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00 00:00:00',
                    'id_jawab' => $select ? $select->id_jawab : 0,
                    'nama_jawab' => $select ? $select->nama_jawab : '',
                ]);
                break;
            case 'jawab':
                Smis_Doc_Lembar_Konsultasi::updateOrCreate([
                    'id_dokumen' => $req->dokumen,
                ], [
                    'id_kepada' => $select ? $select->id_kepada : 0,
                    'kepada' => $select ? $select->kepada : '',
                    'sejawat' => $req->sejawat ? $req->sejawat : '',
                    'spesialis' => $select ? $select->spesialis : '',
                    'jenis_konsul' => $select ? $select->jenis_konsul : '',
                    'tanggal' => $select ? $select->tanggal : '0000-00-00 00:00:00',
                    'keterangan_klinis' => $select ? $select->keterangan_klinis : '',
                    'diagnosa' => $select ? $select->diagnosa : '',
                    'id_konsul' => $select ? $select->id_konsul : 0,
                    'nama_konsul' => $select ? $select->nama_konsul : '',
                    'temuan' => $req->temuan ? $req->temuan : '',
                    'keluhan' => $req->keluhan ? $req->keluhan : '',
                    'saran_tindakan' => $req->saran_tindakan ? $req->saran_tindakan : '',
                    'konsultasi_ulang' => $req->konsultasi_ulang ? date('Y-m-d', strtotime($req->konsultasi_ulang)) : '0000-00-00',
                    'tindakan_khusus' => $req->tindakan_khusus ? $req->tindakan_khusus : '',
                    'tanggal_verifikasi' => $req->tanggal_jawab ? date('Y-m-d H:i:s', strtotime($req->tanggal_jawab)) : '0000-00-00 00:00:00',
                    'id_jawab' => Auth::user()->id,
                    'nama_jawab' => Auth::user()->realname,
                ]);

                $dokumen_kunjungan_service = new DokumenKunjunganService();

                $dokumen_kunjungan_service->verifikasi_dokumen($req);

                break;

            default:
                # code...
                break;
        }

        return Smis_Doc_Lembar_Konsultasi::where('id_dokumen', $req->dokumen)->first();
    }
}
