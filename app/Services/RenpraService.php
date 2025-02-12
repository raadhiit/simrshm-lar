<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SMIS_LayananPasien;
use App\Models\SmisDocRenpra;
use App\Models\SmisHrdEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RenpraService
{
    public function data(Request $req)
    {
        // dd($req->dokumen);
        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();

            // dd($data['dokumen']->username);
        $data['employee'] = SmisHrdEmployee::where('username', $data['dokumen']->username)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
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
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['layanan'] = $layanan;
        $data['renpra'] = SmisDocRenpra::leftJoin('smis_adm_user', 'smis_doc_renpras.verifikator', '=', 'smis_adm_user.username')
            ->where('id_dokumen', $req->dokumen)
            ->orderBy('tanggal')
            ->selectRaw('smis_doc_renpras.*, smis_adm_user.realname as verifikator_realname')
            ->get();
        return $data;
    }

    function verifikasi_dokumen($data){
        // dd($data);
        $verif = SmisDocRenpra::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'status' => 1,
            'id_verifikator' => Auth::user()->id,
            'verifikator' => Auth::user()->realname,
        ]);



        return $verif;
    }
}
