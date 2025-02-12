<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class PenggunaController extends Controller
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
        return view('pengguna.list', [
            'user' => User::paginate(10),
            'keyword' => ''
        ]);
    }

    function search(Request $req)
    {
        $user = User::where('realname', 'like', '%' . $req->keyword . '%')
            ->orWhere('username', 'like', '%' . $req->keyword . '%')
            ->orWhere('email', 'like', '%' . $req->keyword . '%')
            ->orWhere('authority', 'like', '%' . $req->keyword . '%')
            ->paginate(10)->setPath('?keyword=' . $req->keyword);
        return view('pengguna.list', [
            'user' => $user,
            'keyword' => $req->keyword
        ]);
    }

    function store(Request $req)
    {
        $req->validate([
            'nama' => 'required',
            'username' => 'required|unique:smis_adm_user',
            'email' => 'required|unique:smis_adm_user',
            'authority' => 'required',
        ], [
            'nama.required' => 'Nama pengguna harus diisi',
            'username.required' => 'Username pengguna harus diisi',
            'username.unique' => 'Username pengguna sudah digunakan',
            'email.required' => "Email pengguna harus diisi",
            'email.unique' => 'Email pengguna sudah digunakan',
            'authority.required' => 'Pilih authority pengguna',
        ]);
        try {
            $filename = '';
            $file = $req->file('foto');
            if (isset($file)) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $upload = $file->move('fotopengguna', $filename);
                if ($upload) {
                    DB::table('smis_adm_user')->insert([
                        'realname' => $req->nama,
                        'username' => $req->username,
                        'password' => md5('default'),
                        'menu' => '',
                        'email' => $req->email,
                        'authority' => $req->authority,
                        'foto' => $filename,
                        'last_login_ip' => '',
                        'last_login_time' => date('Y-m-d H:i:s'),
                        'last_change' => date('Y-m-d H:i:s'),
                        'last_fetch' => date('Y-m-d H:i:s'),
                        'session' => '',
                        'st_mmode' => '',
                        'session' => '',
                        'color_slide' => 0,
                        'color_invert' => 0,
                        'color_grayscale' => 0,
                        'is_active' => '',
                        'css' => '',
                        'slider' => 0,
                        'autonomous' => '',
                        'duplicate' => 0,
                        'origin' => '',
                        'origin_id' => 0,
                        'time_updated' => date('Y-m-d H:i:s'),
                        'origin_updated' => '',
                    ]);
                    Alert::success('Berhasil', 'Pengguna berhasil ditambahkan');
                } else {
                    Alert::error('Gagal', 'Gagal upload foto pengguna');
                    return redirect()->back();
                }
            } else {
                DB::table('smis_adm_user')->insert([
                    'realname' => $req->nama,
                    'username' => $req->username,
                    'password' => md5('default'),
                    'menu' => '',
                    'email' => $req->email,
                    'authority' => $req->authority,
                    'foto' => '',
                    'last_login_ip' => '',
                    'last_login_time' => date('Y-m-d H:i:s'),
                    'last_change' => date('Y-m-d H:i:s'),
                    'last_fetch' => date('Y-m-d H:i:s'),
                    'session' => '',
                    'st_mmode' => '',
                    'session' => '',
                    'color_slide' => 0,
                    'color_invert' => 0,
                    'color_grayscale' => 0,
                    'is_active' => '',
                    'css' => '',
                    'slider' => 0,
                    'autonomous' => '',
                    'duplicate' => 0,
                    'origin' => '',
                    'origin_id' => 0,
                    'time_updated' => date('Y-m-d H:i:s'),
                    'origin_updated' => '',
                ]);
            }
            Alert::success('Berhasil', 'Pengguna berhasil ditambahkan');
        } catch (\Throwable $th) {
            Alert::error('Gagal', $th->getMessage());
        }
        return redirect('pengguna');
    }

    function ajax_select_user(Request $req)
    {
        $data = User::where('id', $req->id_user)->first();
        return response()->json($data);
    }

    function update(Request $req)
    {
        $req->validate([
            'nama' => 'required',
            'username' => 'required|unique:smis_adm_user,username,' . $req->user_id,
            'email' => 'required|unique:smis_adm_user,email,' . $req->user_id,
            'authority' => 'required',
        ], [
            'nama.required' => 'Nama pengguna harus diisi',
            'username.required' => 'Username pengguna harus diisi',
            'username.unique' => 'Username pengguna sudah digunakan',
            'email.required' => "Email pengguna harus diisi",
            'email.unique' => 'Email pengguna sudah digunakan',
            'authority.required' => 'Pilih authority pengguna',
        ]);
        try {
            $filename = '';
            $file = $req->file('foto');
            if (isset($file)) {
                $cekfoto = SIMS_User::where('id', $req->user_id)->first();
                if ($cekfoto->foto != '') {
                    unlink('fotopengguna/' . $cekfoto->foto);
                }
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $upload = $file->move('fotopengguna', $filename);
                if ($upload) {
                    DB::table('smis_adm_user')->where('id', $req->user_id)->update([
                        'realname' => $req->nama,
                        'username' => $req->username,
                        'email' => $req->email,
                        'authority' => $req->authority,
                        'foto' => $filename,
                    ]);
                    Alert::success('Berhasil', 'Pengguna berhasil diubah');
                } else {
                    Alert::error('Gagal', 'Gagal upload foto pengguna');
                    return redirect()->back();
                }
            } else {
                DB::table('smis_adm_user')->where('id', $req->user_id)->update([
                    'realname' => $req->nama,
                    'username' => $req->username,
                    'email' => $req->email,
                    'authority' => $req->authority,
                ]);
            }
            Alert::success('Berhasil', 'Pengguna berhasil diubah');
        } catch (\Throwable $th) {
            Alert::error('Gagal', $th->getMessage());
        }
        return redirect('pengguna');
    }

    function delete(Request $req){
        try {
            DB::table('smis_adm_user')->where('id', $req->user_id)->delete();
            Alert::success('Berhasil', 'Data pengguna berhasil dihapus');
        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Terjadi kesalahan');
        }

        return redirect('pengguna');
    }
}
