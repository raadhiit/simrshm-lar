<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataKaryawanRequest;
use App\Services\DataIndukService;
use App\Services\DataKaryawanServices;
use RealRashid\SweetAlert\Facades\Alert;

class DataKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataKaryawanServices $dataKaryawanServices)
    {
        return view('data_karyawan.index', [
            'data' => $dataKaryawanServices->getDataKaryawan()->paginate(10),
            'keyword' => ' ',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DataIndukService $dataIndukService)
    {
        return view('data_karyawan.create', [
            'bagian' => $dataIndukService->getBagian()->select('nama')->get(),
            'pendidikan' => $dataIndukService->getPendidikan()->select('pendidikan')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataKaryawanRequest $request, DataKaryawanServices $datakaryawanService)
    {
        $store = $datakaryawanService->storeDataKaryawan($request);
        if ($store == "sukses") {
            Alert::success("Berhasil", "Data berhasil ditambahkan");
        } else {
            Alert::error("Gagal", $store);
        }
        return redirect()->route('data_karyawan.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, DataIndukService $dataIndukService, DataKaryawanServices $datakaryawanService)
    {
        //dd($datakaryawanService->getDataKaryawanById($id));
        return view('data_karyawan.edit', [
            'data' => $datakaryawanService->getDataKaryawanById($id),
            'bagian' => $dataIndukService->getBagian()->select('nama')->get(),
            'pendidikan' => $dataIndukService->getPendidikan()->select('pendidikan')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataKaryawanRequest $request, DataKaryawanServices $datakaryawanService)
    {
        $update = $datakaryawanService->updateDataKaryawan($request);
        if ($update == "sukses") {
            Alert::success("Berhasil", "Data berhasil ditambahkan");
        } else {
            return response()->json($update, 500);
            Alert::error("Gagal", $update);
        }
        return redirect()->route('data_karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DataKaryawanServices $datakaryawanService)
    {
        $delete = $datakaryawanService->deleteDataKaryawan($id);
        if ($delete == "sukses") {
            Alert::success('Berhasil', 'Data Karywan berhasil dihapus');
        } else {
            Alert::error('Gagal', $delete);
        }
        return redirect()->route('data_karyawan.index');
    }
}
