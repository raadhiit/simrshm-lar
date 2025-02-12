<?php

namespace App\Http\Controllers;

use App\Exports\RiwayatPasienExport;
use App\Http\Requests\RiwayatPasienRequest;
use App\Services\RiwayatPasienService;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatPasienController extends Controller
{
    public function index(RiwayatPasienService $riwayatPasienService)
    {
        return view('data_riwayat.index', [
            'ruangan' => $riwayatPasienService->getRuangan()
        ]);
    }

    public function filter(RiwayatPasienRequest $request, RiwayatPasienService $riwayatPasienService)
    {
        return view('data_riwayat.index', [
            'data_riwayats' => $riwayatPasienService->getData($request)->paginate(10),
            'request' => $request->all(),
            'ruangan' => $riwayatPasienService->getRuangan()
        ]);
    }

    public function download(RiwayatPasienRequest $request)
    {
        return Excel::download(new RiwayatPasienExport($request), 'Data Riwayat Pasien ' . $request->ruangan . '.xlsx');
    }
}
