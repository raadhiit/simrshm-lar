<?php

namespace App\Http\Controllers;

use App\Models\SMIS_RuanganIgd;
use App\Models\User;
use Alert;
use Illuminate\Http\Request;
use Auth;

class RuanganIgdController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->authority != 'administrator') {
                    return redirect('home');
            }
            return $next($request);
        });
    }
    
    function index()
    {
        return view('setting.ruangan_igd', [
            'data' => SMIS_RuanganIgd::first(),
            'keyword' => '',
        ]);
    }

    function store(Request $req)
    {
        try {
            $cek = SMIS_RuanganIgd::first();

            if ($cek) {
                SMIS_RuanganIgd::where('id', $cek->id)->update([
                    'nama' => 'Ruangan IGD',
                    'alias' => $req->nama ? $req->nama : '',
                    'kabupaten' =>  $req->kab ? $req->kab : '',
                    'provinsi' => $req->prov ?$req->prov : '' 
                ]);
            } else {
                SMIS_RuanganIgd::create([
                    'nama' => 'Ruangan IGD',
                    'alias' => $req->nama ? $req->nama : '',
                    'kabupaten' =>  $req->kab ? $req->kab : '',
                    'provinsi' => $req->prov ?$req->prov : '' 
                ]);
            }
            Alert::success('Berhasil', 'Setting berhasil diterapkan');
        } catch (\Throwable $th) {
            Alert::error('Gagal', $th->getMessage());
        }
        return redirect('/nama_ruangan_igd');
    }
}
