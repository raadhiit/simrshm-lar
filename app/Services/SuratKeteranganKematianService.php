<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Surat_Keterangan_Kematian;
use App\Models\SMIS_LayananPasien;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class SuratKeteranganKematianService
{
    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('surat_keterangan_kematian')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select('smis_rg_patient.telpon','smis_rg_patient.kelamin', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.ktp',
                'smis_rg_patient.nama_kelurahan', 'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 
                'smis_rg_patient.agama', 'smis_rg_patient.suku', 'smis_rg_layananpasien.*')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)->first();
        if ($data['dokumen']->id_verifikator > 1) {
            $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->realname)->first();
        } else {
            $data['employee'] = SmisHrdEmployee::where('nama', Auth::user()->realname)->first();
        }
        $data['layanan'] = $layanan;
        return $data;
    }

    function create($req) {
        $ins = Smis_Doc_Surat_Keterangan_Kematian::updateOrCreate([
            'id_dokumen' => $req->dokumen
        ], [
            'dokter' => $req->dokter ? $req->dokter : '',
            'tgl_lahir' => $req->tgl_lahir ? $req->tgl_lahir : '',
            'umur' => $req->umur ? $req->umur : '',
            'alamat' => $req->alamat ? $req->alamat : '',
            'tgl_tiba' => $req->tgl_tiba ? $req->tgl_tiba : '',
            'jam_tiba' => $req->jam_tiba ? $req->jam_tiba : '',
            'diagnosa' => $req->diagnosa ? $req->diagnosa : '',
            'tgl_meninggal' => $req->tgl_meninggal ? $req->tgl_meninggal : '',
            'jam_meninggal' => $req->jam_meninggal ? $req->jam_meninggal : '',
            'sebab_kematian' => $req->sebab_kematian ? $req->sebab_kematian : '',
            'tgl_dokumen' => $req->tgl_dokumen ? $req->tgl_dokumen : '',
            'no_dokumen' => $req->no_dokumen ? $req->no_dokumen : '',
            'bulan' => $req->bulan ? $req->bulan : '',
            'tahun' => $req->tahun ? $req->tahun : ''
        ]);
    
        return $ins;
    }

    function verifikasi($req){
        $query = DokumenKunjungan::where('id', $req->dokumen)->update([
            'id_verifikator' => Auth::user()->id,
            'nama_verifikator' => Auth::user()->realname,
            'status' => 1,
            'tanggal_update' => date('Y-m-d H:i', strtotime('+7 hours')),
        ]);
        return $query;
    }
}
