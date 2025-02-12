<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoiceService $invoiceService)
    {
        return view('invoice.index', [
            'keyword' => '',
            'data' => $invoiceService->getInvoice()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create_invoice', [
            'dataDetail' => [],
            'create' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, InvoiceService $invoiceService)
    {
        $store = $invoiceService->storeInvoice($request->all());
        if ($store == "sukses") {
            return response()->json("Data berhasil ditambahkan", 201);
        } else {
            return response()->json("Gagal " . $store, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, InvoiceService $invoiceService)
    {
        $getDetail = $invoiceService->getDetailInvoice($id);

        return response()->json([
            'dataHeader' => $getDetail['header'],
            'dataDetail' => $getDetail['detail'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, InvoiceService $invoiceService)
    {
        $edit = $invoiceService->editInvoice($id);
        return view('invoice.create_invoice', [
            'dataHeader' => $edit['header'],
            'dataDetail' => $edit['detail']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, InvoiceService $invoiceService)
    {
        $update = $invoiceService->updateInvoice($request->all(), $id);
        if ($update == "sukses") {
            return response()->json("Data berhasil diubah", 201);
        } else {
            return response()->json("Gagal " . $update, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, InvoiceService $invoiceService)
    {
        $delete = $invoiceService->deleteInvoice($id);
        if ($delete == "sukses") {
            Alert::success('Berhasil', 'Berhasil Hapus Data');
        } else {
            Alert::error('Gagal', $delete);
        }
        return redirect()->route('invoice.index');
    }

    public function destroyDetail($id, InvoiceService $invoiceService)
    {
        $delete = $invoiceService->deleteDetail($id);
        if ($delete == "sukses") {
            return response()->json("Data berhasil dihapus", 201);
        } else {
            return response()->json("Gagal " . $delete, 500);
        }
    }

    public function search(Request $request, InvoiceService $invoiceService)
    {
        if ($request->keyword == "") {
            return redirect()->route('invoice.index');
        }
        return view('invoice.index', [
            'keyword' => $request->keyword,
            'data' => $invoiceService->getSearch($request)->paginate(10)
        ]);
    }


    public function download($id, InvoiceService $invoiceService)
    {
        $getDetail = $invoiceService->getDetailInvoice($id);
        $angka = $getDetail['header']->jml_bayar;
        $noInvoice = $getDetail['header']->no_invoice;
        $urlInvoice = route('invoice.view_pdf', $noInvoice);
        $getSetting = $invoiceService->getSetting();
        $getLogo = $invoiceService->getImgLogo();

        $pdf = PDF::loadView('invoice.cetak_invoice', [
            'dataHeader' => $getDetail['header'],
            'dataDetail' => $getDetail['detail'],
            'terbilang' => $invoiceService->terbilang($angka),
            'deskripsi' => Keuangan::select('deskripsi')->first(),
            'url_invoice' => $urlInvoice,
            'setting' => $getSetting,
            'logo' => $getLogo
        ])->setPaper('legal', 'potrait');

        $filename = $noInvoice . '.pdf';

        $directory = storage_path('app/document/invoice');

        File::makeDirectory($directory, 0755, true, true);

        $pdf->save($directory . '/' . $filename);

        return $pdf->stream('Pengajuan.pdf');

        // return view('invoice.cetak_invoice', [
        //     'dataHeader' => $getDetail['header'],
        //     'dataDetail' => $getDetail['detail'],
        //     'terbilang' => $invoiceService->terbilang($angka),
        //     'deskripsi' => Keuangan::select('deskripsi')->first(),
        // ]);
    }


    /**
     * undocumented function
     *
     * @return void
     */
    public function viewPDF($no_invoice)
    {
        $path = storage_path('app/document/invoice/' . $no_invoice . '.pdf');

        return response()->file($path);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function showSetting(InvoiceService $invoiceService)
    {
        $getSetting = $invoiceService->getSetting();
        $getLogo = $invoiceService->getImgLogo();
        return view('invoice.setting', [
            'data' => $getSetting,
            'img' => $getLogo // parsing img disini dari storage path
        ]);
    }

    public function createSetting(Request $request, InvoiceService $invoiceService)
    {

        $store = $invoiceService->storeSetting($request);

        if ($store['create'] == "sukses" && $store['upload'] == "sukses") {
            Alert::success('Berhasil', 'Berhasil Menambahkan data');
        }
        if ($store['create'] == "sukses" && $store['upload'] != "sukses") {
            Alert::warning('Berhasil', 'Berhasil Menambahkan data, gagal menyimpan logo silahkan coba kembali');
        }
        if ($store['create'] != "sukses" && $store['upload'] == "sukses") {
            Alert::warning('Berhasil', 'Berhasil Menambahkan logo, gagal menyimpan data silahkan coba kembali');
        }
        if ($store['create'] != "sukses" && $store['upload'] != "sukses") {
            Alert::error('Gagal', $store['create'] . $store['upload']);
        }

        return redirect()->route('invoice.setting_index');
    }
}
