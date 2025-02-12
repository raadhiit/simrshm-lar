<?php

namespace App\Http\Controllers\DokumenKunjungan;

use App\Http\Controllers\Controller;
use App\Services\DokumenKunjungan\RencanaKeperawatanIntraOperasiService;
use App\Services\DokumenKunjunganService;
use Illuminate\Http\Request;

class RencanaKeperawatanIntraOperasi extends Controller
{
    function index(Request $req)
    {
        return view('erm.dokumen_kunjungan.rencana_keperawatan_intra_operasi', (new RencanaKeperawatanIntraOperasiService)->data($req));
    }

    function store(Request $req)
    {
        try {
            (new RencanaKeperawatanIntraOperasiService)->store($req);
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
