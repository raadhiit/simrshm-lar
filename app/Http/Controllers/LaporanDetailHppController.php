<?php

namespace App\Http\Controllers;

use App\Exports\LaporanDetailHppExport;
use App\Services\LaporanDetailHppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanDetailHppController extends Controller
{

    protected $laporanDetailHppService;
    /**
     * @param $dependencies
     */
    public function __construct(LaporanDetailHppService $laporanDetailHppService)
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'kasir')) {
                $arr = (array) $menu->kasir;
                if ($arr['laporan_detail_hpp'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });

        $this->laporanDetailHppService = $laporanDetailHppService;
    }


    /**
     * undocumented function
     *
     * @return void
     */
    public function index()
    {
        //$data = $this->laporanDetailHppService->getData();
        return view('laporan_detail_hpp.index', []);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function filter(Request $request)
    {
        $data = $this->laporanDetailHppService->getData($request->all());
        return view('laporan_detail_hpp.index', [
            'data' => $data,
            'request' => $request->all()
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function download(Request $request)
    {
        return Excel::download(new LaporanDetailHppExport($request), 'Laporan Detail Hpp.csv');

        /*$data = $this->laporanDetailHppService->getData($request->all(), false);
        return view('laporan_detail_hpp.excel', [
            'data' => $data,
            'request' => $request->all()
        ]);*/
    }
}
