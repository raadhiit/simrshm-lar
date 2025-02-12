<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\Smis_Mjm_Kelas;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisDocPermintaanPemeriksaanPatologiAnatomi;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\DB;

class PermintaanPemeriksaanPatologiAnatomiService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::with([
            'rm_pasien:id,nama,tgl_lahir,kelamin,alamat',
            'permintaan_pemeriksaan_patologi_anatomi',
            'pelayanan:id,carabayar,umur,uri,last_bed,last_ruangan,kelamin',
            'verifikator:id,username'
        ])->findOrFail($req->dokumen);
        $data['pasien'] = $dokumen->rm_pasien;
        $data['dokumen'] = $dokumen;
        $data['permintaan'] = $dokumen->permintaan_pemeriksaan_patologi_anatomi;
        $data['layanan'] = $dokumen->pelayanan;
        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $data['kelas_lab'] = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $data['laboratorium'] = $dokumen->permintaan_pemeriksaan_patologi_anatomi ? DB::table('smis_lab_pesanan')->where('id', $dokumen->permintaan_pemeriksaan_patologi_anatomi->id_lab)->where('prop', '')->first() : null;
        $data['employee'] = empty($dokumen->id_verifikator)
            ? null
            : SmisHrdEmployee::where('username', $dokumen->verifikator->username)->first();
        //dd($data);
        return $data;
    }

    function save($req)
    {
        $data = is_array($req) ? $req : $req->all();
        $id_dokumen = $data['dokumen'] ?? $data['id_dokumen'];
        $data['dpjp'] = $data['dpjp'] ?? '';

        $permintaan = SmisDocPermintaanPemeriksaanPatologiAnatomi::updateOrCreate(
            ['id_dokumen' => $id_dokumen],
            $data
        );

        return $permintaan;
    }
}
