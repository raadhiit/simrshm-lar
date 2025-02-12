<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DokumenKunjungan\SkriningGiziRawatInapService;
use App\Services\MedicalRecordService;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkriningGiziRawatInapController extends Controller
{
    function skrining_gizi_rawat_inap(Request $req, SkriningGiziRawatInapService $service)
    {
        $data = $service->data($req, $service);
        return view('erm.rawat_inap.skrining_gizi_rawat_inap', $data);
    }

    function skrining_gizi_rawat_inap_store(Request $req, SkriningGiziRawatInapService $service){
        try {
            $data  = $service->store($req);
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Berhasil update dokumen',
                'employee' => DB::table('smis_hrd_employee')->where('id', Auth::user()->id)->where('prop','')->first(),
                'data' => $data
            ]);
            //$simpan_ttv = $service->simpan_ttv($req);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function verifikasi_skrining_gizi_rawat_inap(Request $req, MedicalRecordService $mrs)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $mrs->verifikasi($req);
                return redirect('erm/rawat_inap/skrining_gizi_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Dokumen berhasil diverifikasi');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

}
