<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use Alert;
use DB;
use Auth;

class ProfilController extends Controller
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
        return view('setting.profil', [
            'profil' => Profil::first(),
        ]);
    }

    function store(Request $req)
    {
        $req->validate([
            'logo' => 'mimes:jpg,jpeg,png',
            'nama' => 'required',
            'nickname' => 'required'
        ], [
            'logo.mimes' => 'Format file tidak diizinkan (png,jpeg,jpg)',
            'nama.required' => 'Nama perusahaan harus diisi',
            'nickname.required' => 'Nickname harus diisi',
        ]);

        try {
            $cek = Profil::first();
            $file = $req->file('logo');
            if (isset($file)) {
                $namafile = time() . '_Logo.' . $file->getClientOriginalExtension();
                $upload = $file->move('filelogo', $namafile);
                if ($upload) {
                    if ($cek) {
                        unlink(public_path() . '/' . 'filelogo' . '/' . $cek->logo);
                        DB::table('profil')->where('id', $cek->id)->update([
                            'logo' => $namafile,
                            'name' => $req->nama,
                            'nickname' => $req->nickname
                        ]);
                        Alert::success('Berhasil', 'Profil berhasil diubah');
                    } else {
                        DB::table('profil')->insert([
                            'logo' => $namafile,
                            'name' => $req->nama,
                            'nickname' => $req->nickname
                        ]);
                        Alert::success('Berhasil', 'Profil berhasil ditambahkan');
                    }
                } else {
                    Alert::error('Gagal', 'Gagal upload file');
                }
            } else {
                DB::table('profil')->where('id', $cek->id)->update([
                    'name' => $req->nama,
                    'nickname' => $req->nickname
                ]);
                Alert::success('Berhasil', 'Data berhasil diubah');
            }
        } catch (\Throwable $th) {
            Alert::error('Gagal', $th->getMessage());
        }
        return redirect('/profil');
    }
}
