<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormDataLoaderBpjsLayakRequest;
use App\Services\LoaderBpjsLayakService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class LoaderBpjsLayakController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'accounting')) {
                $arr = (array) $menu->accounting;
                if ($arr['loader_bpjs_layak'] == 0) {
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
    public function index(LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        return view('loader_bpjs_layak.index', [
            'data' => $loaderBpjsLayakService->getData()->paginate(10),
            'keyword' => ''
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function detail($id, LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        return view('loader_bpjs_layak.detail', [
            'data' => $loaderBpjsLayakService->getDataDetail($id)->paginate(10),
            'keyword' => ''
        ]);
    }


    /**
     * undocumented function
     *
     * @return void
     */
    public function store(FormDataLoaderBpjsLayakRequest $request, LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        $store = $loaderBpjsLayakService->store($request->except('_token'));
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Data Loader Klaim Layak Berhasil di simpan');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('loader_bpjs_layak.index');
    }
    /**
     * undocumented function
     *
     * @return void
     */
    public function import(Request $request, LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        $import = $loaderBpjsLayakService->import($request);
        if ($import == 'sukses') {
            Alert::success('Berhasil', 'Import Data Loader Klaim Bpjs Layak Berhasil');
        } else {
            Alert::error('Gagal', $import);
        }
        return redirect()->route('loader_bpjs_layak.index');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function destroy($id, LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        $destroy = $loaderBpjsLayakService->destroyData($id);
        if ($destroy == 'sukses') {
            Alert::success('Berhasil', 'Hapus Data Loader Klaim Bpjs Layak Berhasil');
        } else {
            Alert::error('Gagal', $destroy);
        }
        return redirect()->route('loader_bpjs_layak.index');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function dataGenerate($id, LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        $data = $loaderBpjsLayakService->getDataGenerate($id);
        return response()->json($data);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function postToDraftJurnal(Request $request, LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        $generateDraft = $loaderBpjsLayakService->generateDraftJurnal($request);
        if ($generateDraft['message'] == 'sukses') {
            return response()->json($generateDraft['id'], 201);
        } else {
            return response()->json($generateDraft, 500);
        }
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function postToDraftDetailJurnal(Request $request, LoaderBpjsLayakService $loaderBpjsLayakService)
    {
        $generateDraft = $loaderBpjsLayakService->generateDraftDetailJurnal($request);
        if ($generateDraft['message'] == 'sukses') {
            return response()->json(['no_sep' => $request->no_sep, 'status' => $generateDraft['status']], 201);
        } else {
            Log::error('ERORR LOADER BPJS :' . $generateDraft);
            return response()->json($request->no_sep, 500);
        }
    }
}
