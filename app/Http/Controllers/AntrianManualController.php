<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\AntrianManualService;

class AntrianManualController extends Controller
{
    public function index(AntrianManualService $antrianManualService)
    {
        return view('antrian_manual.index', [
            'antrian_bpjs' => $antrianManualService->getLastAntrian('loket 1')->last_queue ?? 0,
            'antrian_umum' => $antrianManualService->getLastAntrian('loket 2')->last_queue ?? 0,
            'antrian_asuransi' => $antrianManualService->getLastAntrian('loket 3')->last_queue ?? 0,
            'antrian_ranap' => $antrianManualService->getLastAntrian('loket 4')->last_queue ?? 0,
        ]);
    }

    public function getAntrian(Request $req, $lantai, AntrianManualService $antrianManualService)
    {
        $current_time = Carbon::now()->format('H:i');

        if ($req->jenis === 'loket 1' && $current_time >= '19:00') {
            return redirect()->route('antrian_manual.index')->with('warning', 'Pelayanan Hanya Tersedia Dari Pukul 07:00 Sampai Pukul 19:00 WIB. Mohon Datang Kembali Pada Besok Hari');
        }

        $alphabet = '';

        switch ($req->jenis) {
            case 'loket 1':
                $alphabet = 'A';
                break;
            case 'loket 2':
                $alphabet = 'B';
                break;
            case 'loket 3':
                $alphabet = 'C';
                break;
            case 'loket 4':
                $alphabet = 'D';
                break;
            default:
                break;
        }

        return view('antrian_manual.cetak_antrian_manual', [
            'nomor_antrean' => $alphabet.$antrianManualService->getAntrian($req->jenis),
        ]);
    }
}
