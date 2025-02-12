<?php

namespace App\Http\Controllers;

use App\Exports\LapRiwayatAccJurnalExport;
use App\Services\LapRiwayatAccJurnalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LapRiwayatAccJurnalController extends Controller
{

    protected $lapRiwayatAccJurnalService;

    public function __construct(LapRiwayatAccJurnalService $lapRiwayatAccJurnalService)
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'accounting')) {
                $arr = (array) $menu->accounting;
                if ($arr['lap_riwayat_jurnal'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });

        $this->lapRiwayatAccJurnalService = $lapRiwayatAccJurnalService;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function index()
    {
        $request['tanggal_dari'] = '';
        $request['tanggal_sampai'] = '';

        $request['status'] = 'belum_dikunci';

        return view('lap_riwayat_jurnal.index', [
            'request' => $request
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function filter(Request $request)
    {
        //dd($request->all());
        return view('lap_riwayat_jurnal.index', [
            'request' => $request,
            'data' => $this->lapRiwayatAccJurnalService->getData($request->all())
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function download(Request $request)
    {
        return Excel::download(new LapRiwayatAccJurnalExport($request), 'Laporan Riwayat Acc Jurnal Keuangan.xlsx');
        return view('lap_riwayat_jurnal.excel', [
            'request' => $request,
            'data' => $this->lapRiwayatAccJurnalService->getData($request->all())
        ]);
    }
}
