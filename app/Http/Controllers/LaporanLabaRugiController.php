<?php

namespace App\Http\Controllers;

use App\Exports\LaporanLabaRugiExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanLabaRugiController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'accounting')) {
                $arr = (array) $menu->accounting;
                if ($arr['laporan_laba_rugi'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function index()
    {
        return view('laporan_laba_rugi.index', [
            'request' => ['tanggal_dari' => date('Y-m-d'), 'tanggal_sampai' => date('Y-m-d')],
            'index' => true
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function filter(Request $request)
    {
        return view('laporan_laba_rugi.index', [
            'request' => $request
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function download(Request $request)
    {
        return Excel::download(new LaporanLabaRugiExport($request), 'Laporan Laba Rugi (Rekap).xlsx');
        /* return view('laporan_laba_rugi.excel', [
             'request' => $request
         ]); */
    }
}
