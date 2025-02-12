<?php

namespace App\Http\Controllers\DataInduk;

use App\Exports\DataIndukRuanganPegawaiExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataInduk\DataIndukRuanganPegawaiRequest;
use App\Services\DataIndukService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DataIndukRuanganPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataIndukService $dataIndukService)
    {
        return view('data_induk.ruangan_pegawai', [
            'keyword' => '',
            'data' => $dataIndukService->getRuanganPegawai()->paginate(10),
            'role' => 'ruangan_pegawai'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataIndukRuanganPegawaiRequest $request, DataIndukService $dataIndukService)
    {
        $store = $dataIndukService->createRuanganPegawai($request);
        if ($store == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Ruangan Pegawai berhasil ditambahkan');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('ruangan_pegawai.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, DataIndukService $dataIndukService)
    {
        return response()->json($dataIndukService->getRuanganPegawaiById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataIndukRuanganPegawaiRequest $request, DataIndukService $dataIndukService)
    {
        $update = $dataIndukService->updateRuanganPegawai($request);
        if ($update == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Ruangan Pegawai berhasil diperbarui');
        } else {
            Alert::error('Gagal', $update);
        }
        return redirect()->route('ruangan_pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DataIndukService $dataIndukService)
    {
        $delete = $dataIndukService->deleteRuanganPegawai($id);
        if ($delete == 'sukses') {
            Alert::success('Berhasil', 'Data Induk Ruangan Pegawai berhasil dihapus');
        } else {
            Alert::error('Gagal', $store);
        }
        return redirect()->route('ruangan_pegawai.index');
    }

    public function search(Request $request, DataIndukService $dataIndukService)
    {
        return view('data_induk.ruangan_pegawai', [
            'data' => $dataIndukService->getSearchRuanganPegawai($request)->paginate(10),
            'keyword' => $request->keyword,
            'role' => 'ruangan_pegawai'
        ]);
    }

    public function download(Request $request, DataIndukService $dataIndukService)
    {
        return Excel::download(new DataIndukRuanganPegawaiExport($request), 'Data_Induk_Ruangan_Pegawai.xlsx');
        return view('data_induk.ruangan_pegawai_excel', [
            'data' => $dataIndukService->getDownloadRuanganPegawai($request),
        ]);
    }
}
