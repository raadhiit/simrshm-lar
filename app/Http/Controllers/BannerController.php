<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Alert;
use DB;
use Auth;

class BannerController extends Controller
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

    function index(Request $req)
    {
        return view('setting.banner', [
            'banner' => Banner::first(),
        ]);
    }

    function store(Request $req)
    {
        $req->validate([
            'banner' => 'mimes:jpg,jpeg,png',
            'first_content' => 'required',
            'second_content' => 'required'
        ], [
            'banner.mimes' => 'Format file tidak diizinkan (png,jpeg,jpg)',
            'first_content.required' => 'Konten pertama harus diisi',
            'second_content.required' => 'Konten kedua harus diisi',
        ]);

        try {
            $cek = Banner::first();
            $file = $req->file('banner');
            if (isset($file)) {
                $namafile = time() . '_Banner.' . $file->getClientOriginalExtension();
                $upload = $file->move('filebanner', $namafile);
                if ($upload) {
                    if ($cek) {
                        unlink(public_path() . '/' . 'filebanner' . '/' . $cek->name);
                        DB::table('banner')->where('id', $cek->id)->update([
                            'name' => $namafile,
                            'first_content' => $req->first_content,
                            'second_content' => $req->second_content
                        ]);
                        Alert::success('Berhasil', 'Banner berhasil diubah');
                    } else {
                        DB::table('banner')->insert([
                            'name' => $namafile,
                            'first_content' => $req->first_content,
                            'second_content' => $req->second_content
                        ]);
                        Alert::success('Berhasil', 'Banner berhasil ditambahkan');
                    }
                } else {
                    Alert::error('Gagal', 'Gagal upload file');
                }
            } else {
                DB::table('banner')->where('id', $cek->id)->update([
                    'first_content' => $req->first_content,
                    'second_content' => $req->second_content
                ]);
                Alert::success('Berhasil', 'Konten berhasil diubah');
            }
        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Terjadi kesalahan');
        }
        return redirect('/banner');
    }
}
