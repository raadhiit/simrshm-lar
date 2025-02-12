<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaderBpjsDiverifikasiRequest;
use App\Services\LoaderBpjsDiverifikasiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class LoaderBpjsDiverifikasiController extends Controller
{
    private $loaderBpjsDiverifikasiService;

    public function __construct(LoaderBpjsDiverifikasiService $loaderBpjsDiverifikasiService)
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'accounting')) {
                $arr = (array) $menu->accounting;
                if (($arr['loader_bpjs_diverifikasi'] ?? 0) == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
        $this->loaderBpjsDiverifikasiService = $loaderBpjsDiverifikasiService;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function index()
    {
        return view('loader_bpjs_diverifikasi.index', [
            'data' => $this->loaderBpjsDiverifikasiService->getData()->paginate(10),
            'keyword' => ''
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function detail($id, Request $request)
    {
        return view('loader_bpjs_diverifikasi.detail', [
            'data' => $this->loaderBpjsDiverifikasiService->getDataDetail($id)->paginate(10),
            'keyword' => '',
            'id_header' => $id,
            'uri' => $request->uri
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function detailById($id)
    {
        $data = $this->loaderBpjsDiverifikasiService->getDataDetailById($id);

        return response()->json($data);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function store(LoaderBpjsDiverifikasiRequest $request)
    {
        $store = $this->loaderBpjsDiverifikasiService->store($request->except('_token'));
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Loader BPJS Diverifikasi Berhasil di simpan');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('loader_bpjs_diverifikasi.index');
    }

    public function updateDetail(Request $request)
    {
        $store = $this->loaderBpjsDiverifikasiService->updateDetail($request);
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Loader BPJS Diverifikasi Detail Berhasil di perbarui');
        } else {
            Alert::error('Gagal', $store);
            Log::error('Loader BPJS Diverifikasi -> ' . $store);
        }
        return redirect()->route('loader_bpjs_diverifikasi.detail', $request->id_header);
    }

    public function dataGenerate($id)
    {
        $data = $this->loaderBpjsDiverifikasiService->getDataGenerate($id);
        return response()->json($data);
    }

    public function postToDraftJurnal(Request $request)
    {
        $generateDraft = $this->loaderBpjsDiverifikasiService->generateDraftJurnal($request);
        if ($generateDraft['message'] == 'sukses') {
            return response()->json($generateDraft['id'], 201);
        } else {
            Log::error('Loader BPJS Diverifikasi post jurnal -> ', $generateDraft);
            return response()->json($generateDraft, 500);
        }
    }

    public function postToDraftDetailJurnal(Request $request)
    {
        //$generateDraft = $loaderBpjsLayakService->generateDraftDetailJurnal($request);
        $generateDraft = $this->loaderBpjsDiverifikasiService->generateDraftDetailJurnal($request);
        if ($generateDraft['message'] == 'sukses') {
            return response()->json(['sep' => $request->sep, 'status' => $generateDraft['status']], 201);
        } else {
            Log::error('ERORR LOADER BPJS :' . $generateDraft);
            return response()->json($request->no_sep, 500);
        }
    }

    public function generateDetail(Request $request)
    {
        $generateDetail = $this->loaderBpjsDiverifikasiService->generateDetail($request);
        if ($generateDetail == 'sukses') {
            Alert::success('Berhasil', 'Loader BPJS Diverifikasi Detail Berhasil di perbarui');
        } else {
            Alert::error('Gagal', $generateDetail);
            Log::error('Loader BPJS Diverifikasi Generate Error -> ' . $generateDetail);
        }
        return redirect()->route('loader_bpjs_diverifikasi.detail', $request->id_header);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function import(Request $request)
    {
        $import = $this->loaderBpjsDiverifikasiService->import($request);
        if ($import == 'sukses') {
            Alert::success('Berhasil', 'Import Data Loader Bpjs Diverifikasi Berhasil');
        } else {
            Alert::error('Gagal', $import);
        }
        return redirect()->route('loader_bpjs_diverifikasi.index');
    }

    public function destroy($id)
    {
        $destroy = $this->loaderBpjsDiverifikasiService->destroyData($id);
        if ($destroy == 'sukses') {
            Alert::success('Berhasil', 'Hapus Loader Klaim Bpjs Diverifikasi Berhasil');
        } else {
            Alert::error('Gagal', $destroy);
        }
        return redirect()->route('loader_bpjs_diverifikasi.index');
    }
}
