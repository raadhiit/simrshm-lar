<?php

namespace App\Http\Controllers;

use App\Models\OPLJasa;
use App\Models\OPLJasaDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class OPLJasaController extends Controller
{
    //ajax 
    public function getBarang()
    {
        $vendor = DB::table('smis_pr_barang')
            ->select('kode', 'id', 'nama_jenis_barang', 'nama', 'satuan')
            ->where('prop', ' ')
            ->where('medis', 0)
            ->get();
        return DataTables::of($vendor)->toJson();
    }

    public function getVendor()
    {
        $vendor = DB::table('smis_pb_vendor')
            ->select('kode', 'id', 'alamat', 'nama')
            ->where('prop', ' ')
            ->get();
        return DataTables::of($vendor)->toJson();
    }

    public function index()
    {
        $data = OPLJasa::where('prop', ' ')
            ->paginate(10);

        return view('opl_jasa.index', [
            'keyword' => '',
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        if ($request->keyword == "") {
            return redirect('pembelian/po-jasa');
        }
        $data = OPLJasa::where([['prop', " "], ["no_opl", 'like', '%' . $request->keyword . '%']])
            ->orWhere([['prop', " "], ["tanggal", 'like', '%' . $request->keyword . '%']])
            ->orWhere([['prop', " "], ["kode_vendor", 'like', '%' . $request->keyword]])
            ->orWhere([['prop', " "], ["nama_vendor", 'like', '%' . $request->keyword . '%']])
            ->paginate(10);
        return view('opl_jasa.index', [
            'keyword' => $request->keyword,
            'data' => $data
        ]);
    }

    public function detailOPL(Request $request)
    {
        $dataHeader = OPLJasa::where('prop', ' ')
            ->where('id', $request->id_header)
            ->first();

        $dataDetail = OPLJasaDetail::where('id_header', $request->id_header)
            ->where('prop', ' ')
            ->get();

        return view('opl_jasa.detail_data', [
            'dataHeader' => $dataHeader,
            'dataDetail' => $dataDetail
        ]);
    }

    public function OPLMandiri()
    {
        return view('opl_jasa.create_opl_mandiri', [
            'user' => User::paginate(10),
            'keyword' => '',
            'dataDetail' => []
        ]);
    }

    //store 
    public function storeOplMandiri(Request $request)
    {
        $getRequest = $request->all();
        $cekId = OPLJasa::where('id', $getRequest[0]['id_header'])->first();
        if (isset($cekId)) {
            try {
                OPLJasa::where('id', $getRequest[0]['id_header'])->update([
                    'id_vendor' => $getRequest[0]['id_vendor'],
                    'prop' => " ",
                    'tanggal' => $getRequest[0]['tanggal'],
                    'kode_vendor' => $getRequest[0]['kode_vendor'],
                    'nama_vendor' => $getRequest[0]['vendor'],
                    'alamat' => $getRequest[0]['alamat'],
                    'kode_rekanan' => null,
                    'inc_ppn' => "",
                    'ppn' => $getRequest[0]['ppn'],
                    'pph' => $getRequest[0]['pph'],
                    'total' => $getRequest[0]['total'],
                    'jml_ppn' => $getRequest[0]['jml_ppn'],
                    'jml_pph' => $getRequest[0]['jml_pph'],
                    'jml_bayar' => $getRequest[0]['jml_bayar'],
                ]);

                for ($i = 1; $i < sizeof($getRequest); $i++) {
                    if (isset($getRequest[$i]['id_detail'])) {
                        OPLJasaDetail::where('id_header', $getRequest[0]['id_header'])
                            ->where('id', $getRequest[$i]['id_detail'])->update([
                                'prop' => ' ',
                                'kode_barang' => $getRequest[$i]['kode_barang'],
                                'nama_barang' => $getRequest[$i]['nama_barang'],
                                'jenis_barang' => $getRequest[$i]['jenis_barang'],
                                'jumlah_dipesan' => $getRequest[$i]['jumlah_dipesan'],
                                'satuan' => $getRequest[$i]['satuan'],
                                'hna' => $getRequest[$i]['hna'],
                                'diskon' => $getRequest[$i]['diskon'],
                                'subtotal' => $getRequest[$i]['subtotal'],
                            ]);
                    } else {
                        OPLJasaDetail::create([
                            'id_header' => $getRequest[0]['id_header'],
                            'prop' => ' ',
                            'kode_barang' => $getRequest[$i]['kode_barang'],
                            'nama_barang' => $getRequest[$i]['nama_barang'],
                            'jenis_barang' => $getRequest[$i]['jenis_barang'],
                            'jumlah_dipesan' => $getRequest[$i]['jumlah_dipesan'],
                            'satuan' => $getRequest[$i]['satuan'],
                            'hna' => $getRequest[$i]['hna'],
                            'diskon' => $getRequest[$i]['diskon'],
                            'subtotal' => $getRequest[$i]['subtotal'],
                        ]);
                    }
                }
                return response()->json('Data berhasil diperbarui');
            } catch (\Throwable $th) {
                return response()->json('Data gagal diperbarui' . $th);
            }
        } else {
            try {
                $idHeader =  OPLJasa::create([
                    'id_vendor' => $getRequest[0]['id_vendor'],
                    'prop' => " ",
                    'no_opl' => $getRequest[0]['no_opl'],
                    'tanggal' => $getRequest[0]['tanggal'],
                    'kode_vendor' => $getRequest[0]['kode_vendor'],
                    'nama_vendor' => $getRequest[0]['vendor'],
                    'alamat' => $getRequest[0]['alamat'],
                    'kode_rekanan' => null,
                    'inc_ppn' => "",
                    'ppn' => $getRequest[0]['ppn'],
                    'pph' => $getRequest[0]['pph'],
                    'total' => $getRequest[0]['total'],
                    'jml_ppn' => $getRequest[0]['jml_ppn'],
                    'jml_pph' => $getRequest[0]['jml_pph'],
                    'jml_bayar' => $getRequest[0]['jml_bayar'],
                ])->id;

                for ($i = 1; $i < sizeof($getRequest); $i++) {
                    OPLJasaDetail::create([
                        'id_header' => $idHeader,
                        'prop' => ' ',
                        'kode_barang' => $getRequest[$i]['kode_barang'],
                        'nama_barang' => $getRequest[$i]['nama_barang'],
                        'jenis_barang' => $getRequest[$i]['jenis_barang'],
                        'jumlah_dipesan' => $getRequest[$i]['jumlah_dipesan'],
                        'satuan' => $getRequest[$i]['satuan'],
                        'hna' => $getRequest[$i]['hna'],
                        'diskon' => $getRequest[$i]['diskon'],
                        'subtotal' => $getRequest[$i]['subtotal'],

                    ]);
                }
                return response()->json('Data Berhasil di tambahkan');
            } catch (\Throwable $th) {
                return response($th);
            }
        }
    }

    public function editOPL(Request $request)
    {
        $dataHeader = OPLJasa::where('prop', ' ')
            ->where('id', $request->id_header)
            ->first();

        $dataDetail = OPLJasaDetail::where('id_header', $request->id_header)
            ->where('prop', ' ')
            ->get();

        return view('opl_jasa.create_opl_mandiri', [
            'dataHeader' => $dataHeader,
            'dataDetail' => $dataDetail
        ]);
    }

    public function hapus(Request $request)
    {
        try {
            OPLJasa::where('id', $request->id_header)->update([
                'prop' => "del"
            ]);
            OPLJasaDetail::where('id_header', $request->id_header)->update([
                'prop' => "del"
            ]);
            Alert::success('Berhasil', 'Berhasil Hapus Data');
        } catch (\Throwable $th) {
            return redirect('/pembelian/po-jasa')->with("Gagal menghapus data");
        }
        return redirect('/pembelian/po-jasa');
    }

    public function hapusDetail(Request $request)
    {
        try {
            OPLJasaDetail::where('id', $request->id_detail)->update([
                'prop' => "del"
            ]);
            return response()->json('Berhasil Hapus Data');
        } catch (\Throwable $th) {
            return response()->json('Gagal Hapus Data' . $th);
        }
    }
}
