<?php

namespace App\Http\Controllers\DokumenKunjungan;

use App\Http\Controllers\Controller;
use App\Services\DokumenKunjungan\FormPemantauanReaksiTransfusiDarahService;
use App\Services\DokumenKunjunganService;
use Illuminate\Http\Request;

class FormPemantauanReaksiTransfusiDarahController extends Controller
{
    function index(Request $req)
    {
        return view('erm.dokumen_kunjungan.form_pemantauan_reaksi_transfusi_darah', (new FormPemantauanReaksiTransfusiDarahService)->data($req));
    }

    function store(Request $req)
    {
        try {
            (new FormPemantauanReaksiTransfusiDarahService)->store($req);
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
