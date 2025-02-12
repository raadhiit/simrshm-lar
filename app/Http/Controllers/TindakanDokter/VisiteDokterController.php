<?php

namespace App\Http\Controllers\TindakanDokter;

use App\Exports\VisiteDokterExport;
use App\Http\Controllers\Controller;
use App\Services\TindakanDokterService;
use App\Services\VisiteDokterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
class VisiteDokterController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            //return $next($request);
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'manajer_tarif')) {
                $arr = (array) $menu->manajer_tarif;
                if ($arr['tindakan_dokter'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TindakanDokterService $tindakanDokterService)
    {
        return view('tindakan_dokter.visite_dokter.index', [
            'role' => 'visite_dokter',
            'data' => $tindakanDokterService->getData('smis_mjm_visite')->paginate(10),
            'kelas' => $tindakanDokterService->getKelas(),
            'carabayar' => $tindakanDokterService->getCarabayar(),
            'keyword' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TindakanDokterService $tindakanDokterService)
    {
        $store = $tindakanDokterService->storeData('smis_mjm_visite', $request);
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Visite Dokter berhasil ditambahkan');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('visite_dokter.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, TindakanDokterService $tindakanDokterService)
    {
        return response()->json($tindakanDokterService->getDataById($id, 'smis_mjm_visite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TindakanDokterService $tindakanDokterService)
    {
        $update = $tindakanDokterService->updateData($request, 'smis_mjm_visite');
        if ($update == 'sukses') {
            Alert::success('Berhasil', 'Visite Dokter berhasil diperbarui');
        } else {
            Alert::error('Gagal', $update);
        }
        return redirect()->route('visite_dokter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, TindakanDokterService $tindakanDokterService)
    {
        $delete = $tindakanDokterService->deleteData($id, 'smis_mjm_visite');
        if ($delete == 'sukses') {
            Alert::success('Berhasil', 'Visite Dokter berhasil dihapus');
        } else {
            Alert::error('Gagal', $delete);
        }
        return redirect()->route('visite_dokter.index');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function search(Request $request, TindakanDokterService $tindakanDokterService)
    {
        return view('tindakan_dokter.visite_dokter.index', [
            'role' => 'visite_dokter',
            'data' => $tindakanDokterService->getSearchVisiteDokter($request)->paginate(10),
            'kelas' => $tindakanDokterService->getKelas(),
            'carabayar' => $tindakanDokterService->getCarabayar(),
            'keyword' => $request->keyword
        ]);
    }

    public function import(Request $request, TindakanDokterService $tindakanDokterService)
    {
        $import = $tindakanDokterService->importVisiteDokter($request);
        if ($import == 'sukses') {
            Alert::success('Berhasil', 'Import Visite Dokter Berhasil');
        } else {
            Alert::error('Gagal', $import);
        }
        return redirect()->route('visite_dokter.index');
    }

    public function download(Request $request)
    {
        return Excel::download(new VisiteDokterExport($request), 'Data_Master_Visite_Dokter.xlsx');
        //return view('tindakan_dokter.visite_dokter.excel', [
        //    'data' => $VisiteDokterService->getData(),
        //]);
    }
}
