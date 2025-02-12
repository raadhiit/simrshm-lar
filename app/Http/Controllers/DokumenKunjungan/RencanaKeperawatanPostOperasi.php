<?php

namespace App\Http\Controllers\DokumenKunjungan;

use App\Http\Controllers\Controller;
use App\Services\DokumenKunjungan\RencanaKeperawatanPostOperasiService;
use App\Services\DokumenKunjunganService;
use App\Services\ERekamMedisService;
use Illuminate\Http\Request;

class RencanaKeperawatanPostOperasi extends Controller
{
    function index(Request $req)
    {
        return view('erm.dokumen_kunjungan.rencana_keperawatan_post_operasi', (new RencanaKeperawatanPostOperasiService)->data($req));
    }

    function store(Request $req)
    {
        try {
            (new RencanaKeperawatanPostOperasiService)->store($req);
            (new DokumenKunjunganService)->verifikasi_dokumen($req);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
