<?php

namespace App\Http\Controllers;

use App\Exports\PenerimaanKasirExport;
use App\Http\Requests\PenerimaanKasirRequest;
use App\Services\PenerimaanKasirService;
use Maatwebsite\Excel\Facades\Excel;

class PenerimaanKasirController extends Controller
{
    public function index()
    {
        return view('laporan_penerimaan_kasir.index', [
            'tanggal_dari' => date('Y-m-d'),
            'tanggal_sampai' => date('Y-m-d'),
        ]);
    }

    public function filter(PenerimaanKasirRequest $request, PenerimaanKasirService $penerimaanKasirService)
    {
        return view('laporan_penerimaan_kasir.index', [
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'data' => $penerimaanKasirService->getByFilter($request)->paginate(10)
        ]);
    }

    public function download(PenerimaanKasirRequest $request, PenerimaanKasirService $penerimaanKasirService)
    {
        return Excel::download(new PenerimaanKasirExport($request), 'Penerimaan_Kasir_' . $request->tanggal_dari . ' sd ' . $request->tanggal_sampai . '.xlsx');
        return view('laporan_penerimaan_kasir.excel', [
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'data' => $penerimaanKasirService->getByFilter($request)->get()
        ]);
        return "it work";
    }
}
