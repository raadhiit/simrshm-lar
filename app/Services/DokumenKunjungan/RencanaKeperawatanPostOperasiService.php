<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use Illuminate\Support\Facades\DB;

class RencanaKeperawatanPostOperasiService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = DB::table('smis_rg_layananpasien')->where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = DB::table('smis_rg_patient')->where('id', $dokumen->nrm)->where('prop', '')->first();
        return [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => DB::table('smis_doc_rencana_keperawatan_post_operasi')->where('id_dokumen', $req->dokumen)->first()
        ];
    }

    function store($req)
    {
        DB::table('smis_doc_rencana_keperawatan_post_operasi')->updateOrInsert([
            'id_dokumen' => $req->dokumen
        ],[
            'assessment' => $req->assessment ?? '',
            'diagnosa_keperawatan' => $req->diagnosa_keperawatan ?? '',
            'rencana_keperawatan' => $req->rencana_keperawatan ?? '',
            'implementasi' => $req->implementasi ?? '',
            'evaluasi' => $req->evaluasi ?? '',
        ]);

        return DB::table('smis_doc_rencana_keperawatan_post_operasi')->where('id_dokumen', $req->dokumen)->first();
    }
}
