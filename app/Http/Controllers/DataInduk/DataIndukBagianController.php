<?php

namespace App\Http\Controllers\DataInduk;

use App\Exports\DataIndukBagianExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataInduk\DataIndukBagianRequest;
use App\Services\DataIndukService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DataIndukBagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataIndukService $dataIndukService)
    {
        return view('data_induk.bagian', [
            'keyword' => '',
            'data' => $dataIndukService->getBagian()->paginate(10),
            'role' => 'bagian'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataIndukBagianRequest $request, DataIndukService $dataIndukService)
    {
        $store = $dataIndukService->createBagian($request);
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Bagian berhasil di tambahkan');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('bagian.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, DataIndukService $dataIndukService)
    {
        return response()->json($dataIndukService->getBagianById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataIndukBagianRequest $request, DataIndukService $dataIndukService)
    {
        $update = $dataIndukService->updateBagian($request);
        if ($update == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Bagian berhasil diperbarui');
        } else {
            Alert::error('Gagal', $update);
        }
        return redirect()->route('bagian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DataIndukService $dataIndukService)
    {
        $delete = $dataIndukService->deleteBagian($id);
        if ($delete == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Bagian berhasil dihapus');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('bagian.index');
    }

    public function search(Request $request, DataIndukService $dataIndukService)
    {
        return view('data_induk.bagian', [
            'data' => $dataIndukService->getSearchBagian($request)->paginate(10),
            'keyword' => $request->keyword,
            'role' => 'bagian'
        ]);
    }

    public function download(Request $request)
    {
        return Excel::download(new DataIndukBagianExport($request), 'Data_Induk_Bagian.xlsx');
    }
}
