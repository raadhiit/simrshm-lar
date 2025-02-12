<?php

namespace App\Http\Controllers\DokumenKunjungan;

use App\Http\Controllers\Controller;
use App\Services\DokumenKunjungan\RencanaKeperawatanPraOperasiService;
use App\Services\DokumenKunjunganService;
use Illuminate\Http\Request;

class RencanaKeperawatanPraOperasi extends Controller
{
    function index(Request $req)
    {
        return view('erm.dokumen_kunjungan.rencana_keperawatan_pra_operasi', (new RencanaKeperawatanPraOperasiService)->data($req));
    }

    function store(Request $req)
    {
        try {
            (new RencanaKeperawatanPraOperasiService)->store($req);
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
