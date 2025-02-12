<?php

namespace App\Http\Controllers\DataInduk;

use App\Exports\DataIndukStatusTenagaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataInduk\DataIndukStatusTenagaRequest;
use App\Services\DataIndukService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DataIndukStatusTenagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataIndukService $dataIndukService)
    {
        return view('data_induk.status_tenaga', [
            'data'  => $dataIndukService->getStatusTenaga()->paginate(10),
            'keyword' => '',
            'role' => 'status_tenaga'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataIndukStatusTenagaRequest $request, DataIndukService $dataIndukService)
    {
        $store = $dataIndukService->createStatusTenaga($request);
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Status Tenaga berhasil ditambahkan');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('status_tenaga.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, DataIndukService $dataIndukService)
    {
        return response()->json($dataIndukService->getStatusTenagaById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataIndukStatusTenagaRequest $request, DataIndukService $dataIndukService)
    {
        $update = $dataIndukService->updateStatusTenaga($request);
        if ($update == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Status Tenaga berhasil diperbarui');
        } else {
            Alert::error('Gagal', $update);
        }
        return redirect()->route('status_tenaga.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DataIndukService $dataIndukService)
    {
        $delete = $dataIndukService->deleteStatusTenaga($id);
        if ($delete == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Status Tenaga berhasil dihapus');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('status_tenaga.index');
    }

    public function search(Request $request, DataIndukService $dataIndukService)
    {
        return view('data_induk.status_tenaga', [
            'data' => $dataIndukService->getSearchStatusTenaga($request)->paginate(10),
            'keyword' => $request->keyword,
            'role' => 'status_tenaga'
        ]);
    }

    public function download(Request $request)
    {
        return Excel::download(new DataIndukStatusTenagaExport($request), 'Data_Induk_Status_Tenaga.xlsx');
    }
}
