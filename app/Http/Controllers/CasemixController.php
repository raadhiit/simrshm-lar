<?php

namespace App\Http\Controllers;

use App\Services\CasemixService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CasemixController extends Controller
{
    protected $casemixService;

    /**
     * @param $dependencies
     */
    public function __construct(CasemixService $casemixService)
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'keuangan_kas_bank')) {
                $arr = (array)$menu->keuangan_kas_bank;
                if ($arr['casemix'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
        $this->casemixService = $casemixService;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->working_dir) {
            session(['working_dir' => '/shares/' . $request->working_dir]);
        } else {
            session(['working_dir' => null]);
        }

        $dataRequest = session('data_request');
        //$dataPasien = $this->casemixService->pasienData($dataRequest);
        $dataFilter = $this->casemixService->queryFilter();

        if (!$request->slug) {
            session()->forget('data_request');
            $dataPasien = null;
        }

        return view('casemix.index', [
            //'data_pasiens' => $dataPasien,
            'slug' => $request->slug ?? "data_pasien",
            'data_filter' => $dataFilter,
            'request' => $dataRequest
        ]);
    }

    public function filter(Request $request)
    {
        $dataRequest = $request->except("search");
        $dataPasien = $this->casemixService->pasienData($dataRequest);
        $dataFilter = $this->casemixService->queryFilter();

        session(['data_request' => $dataRequest]);

        return view('casemix.index', [
            'data_pasiens' => $dataPasien,
            'slug' => 'data_pasien',
            'data_filter' => $dataFilter,
            'request' => $dataRequest
        ]);
    }

    public function search(Request $request)
    {
        $dataRequest = session('data_request');
        $dataRequest['search'] = $request->search;
        if (!isset($dataRequest['dari_tanggal']) || !isset($dataRequest['sampai_tanggal'])) {
            Alert::error("Error", "Silahkan terapkan filter terlebih dulu");
            return redirect()->back();
        }

        $dataPasien = $this->casemixService->pasienData($dataRequest);
        $dataFilter = $this->casemixService->queryFilter();
        return view('casemix.index', [
            'data_pasiens' => $dataPasien,
            'slug' => $request->slug,
            'data_filter' => $dataFilter,
            'request' => $dataRequest
        ]);
    }

    public function checkCasemixFolder(Request $request)
    {
        $response = $this->casemixService->checkCasemixFolder($request->noreg);
        return response()->json($response);
    }

    public function uploadFileManual(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|mimes:pdf|max:20048',
        ]);

        $response = $this->casemixService->uploadManualFile($request);
        return response()->json($response, $response['code']);
    }

    public function mergeDocument(Request $request)
    {
        $response = $this->casemixService->mergeDocument($request->id);
        return response()->json($response, $response['code']);
    }

    public function downloadCasemix(Request $request)
    {
        $file = $request->file_path;

        if (file_exists($file)) {
            return response()->download($file);
        } else {
            return back()->with('error', 'File not found.');
        }
    }
}
