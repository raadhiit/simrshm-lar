<?php

namespace App\Http\Controllers\DataInduk;

use App\Exports\DataIndukPendidikanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataInduk\DataIndukPendidikanRequest;
use App\Services\DataIndukService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DataIndukPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataIndukService $dataIndukService)
    {
        //dd($dataIndukService->getHrdEmploye());
        return view('data_induk.pendidikan', [
            'keyword' => '',
            'role' => 'pendidikan',
            'data' => $dataIndukService->getPendidikan()->paginate(10),
            // akan di parsing ke blade untuk mengambil data pada smis_hrd_employee fungsi getHrdEmploye(gender, pendidikan) sesuai input parameter
            'service' => $dataIndukService
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataIndukPendidikanRequest $request, DataIndukService $dataIndukService)
    {
        $store = $dataIndukService->createPendidikan($request);
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Pendidikan berhasil di tambahkan');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('pendidikan.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, DataIndukService $dataIndukService)
    {
        return response()->json($dataIndukService->getPendidikanById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataIndukPendidikanRequest $request, DataIndukService $dataIndukService)
    {
        $update = $dataIndukService->updatePendidikan($request);
        if ($update == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Pendidikan berhasil diperbarui');
        } else {
            Alert::error('Gagal', $update);
        }
        return redirect()->route('pendidikan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DataIndukService $dataIndukService)
    {
        $delete = $dataIndukService->deletePendidikan($id);
        if ($delete == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Pendidikan berhasil dihapus');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('pendidikan.index');
    }

    public function search(Request $request, DataIndukService $dataIndukService)
    {
        return view('data_induk.pendidikan', [
            'data' => $dataIndukService->getSearchPendidikan($request)->paginate(10),
            'keyword' => $request->keyword,
            'role' => 'pendidikan',
            'service' => $dataIndukService
        ]);
    }

    public function download(Request $request)
    {
        return Excel::download(new DataIndukPendidikanExport($request), 'Data_Induk_Pendidikan.xlsx');
    }
}
