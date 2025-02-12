<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Skrining_Gizi_Rawat_Inap;
use App\Services\DokumenKunjunganService;
use App\Models\SMIS_LayananPasien;
use Illuminate\Support\Facades\DB;

class SkriningGiziRawatInapService {
    function data($req){
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $data['dokumen'] = $dokumen;
        $data['data'] = DB::table('smis_doc_skrining_gizi_rawat_inap')->where('id_dokumen', $dokumen->id)->first();
        $data['layanan'] = SMIS_LayananPasien::with('tanda_vital', 'pesanan_lab', 'pesanan_radiologi')->where('id', $dokumen->noreg)->first();
        return $data;
    }

    function store($req){
        $query = Smis_Doc_Skrining_Gizi_Rawat_Inap::updateOrCreate([
            'id_dokumen' => $req->dokumen
        ], [
            
            'alamat' => $req->alamat?$req->alamat:'',
            'pekerjaan' => $req->pekerjaan?$req->pekerjaan:'',
            'peran' => $req->peran?$req->peran:'',
            'mobilitas' => $req->mobilitas?$req->mobilitas:'',
            'riwayat_medis' => $req->riwayat_medis?$req->riwayat_medis:'',
            'diagnosa_medis' => $req->diagnosa_medis?$req->diagnosa_medis:'',
            'dengan_siapa' => $req->dengan_siapa?$req->dengan_siapa:'',
            'keluhan_makan' => $req->keluhan_makan?$req->keluhan_makan:'',
            'dengan_siapa' => $req->dengan_siapa?$req->dengan_siapa:'',
            'keluhan_makan' => $req->keluhan_makan?$req->keluhan_makan:'',
            'bb' => $req->bb?$req->bb:'',
            'pbtb' => $req->pbtb?$req->pbtb:'',
            'imt' => $req->imt?$req->imt:'',
            'lla' => $req->lla?$req->lla:'',
            'kesimpulan_antropemetri' => $req->kesimpulan_antropemetri?$req->kesimpulan_antropemetri:'',
            'kesimpulan_biokimia' => $req->kesimpulan_biokimia?$req->kesimpulan_biokimia:'',
            'keadaan' => $req->keadaan?$req->keadaan:'',
            'td' => $req->td?$req->td:'',
            'n' => $req->n?$req->n:'',
            'rr' => $req->rr?$req->rr:'',
            't' => $req->t?$req->t:'',
            'recall' => $req->recall?$req->recall:'',
            'ni' => $req->ni?$req->ni:'',
            'nc' => $req->nc?$req->nc:'',
            'nb' => $req->nb?$req->nb:'',
            'terapi_gizi' => $req->terapi_gizi?$req->terapi_gizi:'',
            'jenis_makanan' => $req->jenis_makanan?$req->jenis_makanan:'',
            'rute' => $req->rute?$req->rute:'',
            'jadwal_pemberian' => $req->jadwal_pemberian?$req->jadwal_pemberian:'',
            'edukasi_gizi' => $req->edukasi_gizi?$req->edukasi_gizi:'',
            'perhitungan_kebutuhan' => $req->perhitungan_kebutuhan?$req->perhitungan_kebutuhan:'',
            'e' => $req->e?$req->e:'',
            'p' => $req->p?$req->p:'',
            'l' => $req->l?$req->l:'',
            'kh' => $req->kh?$req->kh:'',
            'monitoring_evaluasi_gizi' => $req->monitoring_evaluasi_gizi?$req->monitoring_evaluasi_gizi:'',
            'dietisien' => $req->dietisien?$req->dietisien:'',
            'kemampuan_baca' => $req->kemampuan_baca ? $req->kemampuan_baca : '',
            'alergi_makan' => $req->alergi_makan ? $req->alergi_makan : '',
            'tidak_suka' => $req->tidak_suka ? $req->tidak_suka : '',
            'pengalaman_diet' => $req->pengalaman_diet ? $req->pengalaman_diet : '',
            'hilang_lemak' => $req->hilang_lemak ? $req->hilang_lemak : '',
            'edema' => $req->edema ? $req->edema : '',
            'keterbatasan_fisik' => $req->keterbatasan_fisik ? $req->keterbatasan_fisik : ''
            
        ]);
        (new DokumenKunjunganService)->verifikasi_dokumen($req);

        return $query;
    }

    /*
    function simpan_ttv($req){
        $update = Smis_Mr_Tanda_Vital::updateOrCreate([
            'id' => $req->id_ttv
        ], [
            'tinggi_badan' => $req->tinggi_badan
        ]);

        return $update;
    }*/
}
