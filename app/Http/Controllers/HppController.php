<?php

namespace App\Http\Controllers;

use App\Models\SMIS_LayananPasien;
use Illuminate\Http\Request;
use Auth;

class HppController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'kasir')) {
                $arr = (array) $menu->kasir;
                if ($arr['hpp'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index(){
        return view('kasir.hpp');
    }

    function ajax_get_hpp(Request $req){
        $query = SMIS_LayananPasien::query();
        $query->select('nrm', 'id','nama_pasien','kelamin','tanggal_inap','tanggal_pulang','last_nama_ruangan');
        if ($req->nama != '') {
            $query->where('nama_pasien', 'like', '%'.$req->nama.'%');
        }
        if ($req->no_rm != '') {
            $query->where('nrm', 'like', '%'.$req->no_rm.'%');
        }
        if ($req->no_reg != '') {
            $query->where('id', 'like', '%'.$req->no_reg.'%');
        }
        $data = $query->get();
        return response()->json($data);
    }

    function download(Request $req){
        $data['pasien'] = SMIS_LayananPasien::with('hpp')->leftJoin('smis_rg_asuransi', 'smis_rg_layananpasien.asuransi', 'smis_rg_asuransi.id')->select('nrm','smis_rg_layananpasien.id','nama_pasien','kelamin','carabayar','smis_rg_asuransi.nama as asuransi' ,'nobpjs','tanggal_inap','tanggal_pulang','lama_dirawat','last_nama_ruangan')
        ->where('smis_rg_layananpasien.id', $req->noreg)->first();
        return view('kasir.pdf_hpp', $data);
    }
}
