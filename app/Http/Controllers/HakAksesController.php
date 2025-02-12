<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use DB;
use Alert;
use Auth;

class HakAksesController extends Controller
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
        return view('setting_hak_akses.index', [
            'user' => User::paginate(10),
            'keyword' => '',
        ]);
    }

    function search(Request $req)
    {
        $user = User::where('username', 'like', '%' . $req->keyword . '%')
            ->orWhere('email', 'like', '%' . $req->keyword . '%')
            ->orWhere('authority', 'like', '%' . $req->keyword . '%')
            ->paginate(10)->setPath('?keyword=' . $req->keyword);
        return view('setting_hak_akses.index', [
            'user' => $user,
            'keyword' => $req->keyword,
        ]);
    }

    function create(Request $req)
    {
        return view('setting_hak_akses.create', [
            'user' => User::findOrFail($req->id),
            'menu' => Menu::where('id', '<>', 1)->get(),
        ]);
    }

    function store(Request $req)
    {
        DB::table('smis_adm_user')->where('id', $req->id_user)->update([
            'menu' => $req->menu
        ]);

        Alert::success('Berhasil', 'Hak akses user berhasil diubah');

        return redirect('hak_akses');
    }
}
