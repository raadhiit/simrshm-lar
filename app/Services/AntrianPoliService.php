<?php

namespace App\Services;

use App\Models\Antrian;
use App\Models\JadwalPoli;
use Illuminate\Support\Facades\DB;

class AntrianPoliService
{
    function antrian_selesai()
    {
        $data = Antrian::where('taskid', 3)->where('tanggalperiksa', date('Y-m-d'))->get();
        return $data;
    }

    function data_antrian_display($nomor_display)
    {
        $hari = date('w') == 0 ? 7 : date('w');
        $query = Antrian::leftJoin('smis_rg_jadwal_poli', 'smis_rg_jadwal_poli.id', 'antrians.jadwal_id');
        // $query = Antrian::leftJoin('smis_rg_jadwal_poli_backup', 'smis_rg_jadwal_poli_backup.id', 'antrians_backup.jadwal_id');

        switch ($nomor_display) {
            case '1':
                $query->whereIn('slug_poli', [
                    'poli_paru',
                    'poli_tht',
                    'poli_bedah_umum',
                    'poli_penyakit_dalam'
                ]);
                break;
            case '2':
                $query->whereIn('slug_poli', [
                    'poli_jantung_dan_pembuluh_darah',
                    'poli_penyakit_dalam',
                    'poli_mata',
                    'poli_syaraf'
                ]);
                break;
            case '3':
                $query->whereIn('slug_poli', [
                    'poli_kandungan',
                    'poli_anak_spesialis'
                ]);
                break;
            case '4':
                $query->whereIn('slug_poli', [
                    'poli_rehab_medik',
                    'poli_urologi',
                    'poli_ortopedi'
                ]);
                
                break;

            default:
                # code...
                break;
        }

        $data = $query->select('antrians.*', 'smis_rg_jadwal_poli.nama_dokter', 'smis_rg_jadwal_poli.slug_poli')
        // $data = $query->select('antrians_backup.*', 'smis_rg_jadwal_poli_backup.nama_dokter', 'smis_rg_jadwal_poli_backup.slug_poli')
            ->where('taskid', 3)->where('tanggalperiksa', date('Y-m-d'))->where('prop', '')->get();

        return $data;
    }

    function data_dokter_display($nomor_display){
        $hari = date('w') == 0 ? 7 : date('w');
        $query = JadwalPoli::select('slug_poli', 'nama_dokter');

        switch ($nomor_display) {
            case '1':
                $query->whereIn('slug_poli', [
                    'poli_paru',
                    'poli_tht',
                    'poli_bedah_umum',
                    'poli_penyakit_dalam'
                ]);
                break;
            case '2':
                $query->whereIn('slug_poli', [
                    'poli_jantung_dan_pembuluh_darah',
                    'poli_penyakit_dalam',
                    'poli_mata',
                    'poli_syaraf'
                ]);
                break;
            case '3':
                $query->whereIn('slug_poli', [
                    'poli_kandungan',
                    'poli_anak'
                ]);
                break;
            case '4':
                $query->whereIn('slug_poli', [
                    'poli_rehab_medik',
                    'poli_urologi',
                    'poli_ortopedi'
                ]);
                break;

            default:
                # code...
                break;
        }

        $data = $query->where('hari', $hari)->where('prop', '')->groupBy('slug_poli','nama_dokter')->get();

        return $data;
    }
}
