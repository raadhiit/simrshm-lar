<?php

namespace App\Http\Controllers;

use App\Exports\RekapAntrianExport;
use Illuminate\Http\Request;
use App\Models\Antrian;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class RekapAntrianController extends Controller
{
    function index(){
        return view('antrian.rekap');
    }

    function datatable_rekap_antrian($dari,$sampai)
    {
        $data = Antrian::leftJoin('smis_rg_patient', 'antrians.norm', 'smis_rg_patient.id')->select(
                'smis_rg_patient.nama',
                'antrians.*'
            )->whereBetween('tanggalperiksa',[$dari,$sampai])->get();

        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    function export(Request $req){
        return Excel::download(new RekapAntrianExport($req->dari, $req->sampai), 'rekap_antrian_'.date('d-m-Y', strtotime($req->dari)).'_'.date('d-m-Y', strtotime($req->sampai)).'.xlsx');
    }
}
