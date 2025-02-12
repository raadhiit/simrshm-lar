<?php

namespace App\Http\Controllers;

use App\Exports\LaporanDetailTindakanExport;
use App\Http\Requests\LaporanTindakanDetailRequest;
use App\Services\LaporanTindakanDetailDokterService;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTindakanDetailDokterController extends Controller
{
    public function index(LaporanTindakanDetailDokterService $laporanTindakanDetailDokterService)
    {
        return view('laporan_tindakan_detail_dokter.index', [
            'tanggal_dari' => date('Y-m-d'),
            'tanggal_sampai' => date('Y-m-d'),
            'list_nama_dokter' => $laporanTindakanDetailDokterService->getDokterName()->get(),
            'req_nama_dokter' => " "
        ]);
    }

    public function filter(LaporanTindakanDetailRequest $request, LaporanTindakanDetailDokterService $laporanTindakanDetailDokterService)
    {
        return view('laporan_tindakan_detail_dokter.index', [
            'tanggal_dari' => $request->tanggal_dari_conv,
            'tanggal_sampai' => $request->tanggal_sampai_conv,
            'req_nama_dokter' => $request->nama_dokter,
            'data_operator' => $laporanTindakanDetailDokterService->getDataByFilter($request, "operator")->paginate(10),
            'data_referal' => $laporanTindakanDetailDokterService->getDataByFilter($request, "referal")->paginate(10),
            'list_nama_dokter' => $laporanTindakanDetailDokterService->getDokterName()->get()

        ]);
    }

    public function download(LaporanTindakanDetailRequest $request, LaporanTindakanDetailDokterService $laporanTindakanDetailDokterService)
    {
        return Excel::download(new LaporanDetailTindakanExport($request), 'Laporan Tindakan Detail Dokter ' . $request->nama_dokter . '.xlsx');

        /* return view('laporan_tindakan_detail_dokter.excel', [ */
        /*     'tanggal_dari' => $request->tanggal_dari_conv, */
        /*     'tanggal_sampai' => $request->tanggal_sampai_conv, */
        /*     'req_nama_dokter' => $request->nama_dokter, */
        /*     'data_operator' => $laporanTindakanDetailDokterService->getDataByFilter($request, "operator")->get(), */
        /*     'data_referal' => $laporanTindakanDetailDokterService->getDataByFilter($request, "referal")->get(), */
        /*     'count_data' => $laporanTindakanDetailDokterService->getDataByFilter($request, "operator")->get()->sum('nilai') + $laporanTindakanDetailDokterService->getDataByFilter($request, "referal")->get()->sum('nilai') */
        //'list_nama_dokter' => $laporanTindakanDetailDokterService->getDokterName()->get()
        /* ]); */
        /* return "work"; */
    }
}
