<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\Profil;
use DB;

class AuthController extends Controller
{
    function loginpage(){
        Session::put('profil', Profil::first());
        return view('login');
    }

    function do_login(Request $req){
        $cek_user = User::leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
        ->select('smis_adm_user.id', 'smis_hrd_employee.no_ijin')
        ->where('smis_adm_user.username', $req->username)->where('password', md5($req->password))->first();
        
        if($cek_user){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            }
            else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_address = $_SERVER['REMOTE_ADDR'];
            }
            $time = date('dmyhisu');
            $rand = rand(0,10000);
            Session::put('rsudslg2-sessionid', md5($ip_address.$cek_user->id.$time.$rand));
            Session::put('rsudslg2-userid', $cek_user->id);
            $sess = md5($ip_address.$cek_user->id.$time.$rand);
            DB::table('smis_adm_user')->where('id', $cek_user->id)->update([
                'session' => $sess
            ]);
            Auth::loginUsingId($cek_user->id);
            Session::put('sip', $cek_user->no_ijin);
            Session::put('menu', Menu::all());
            return redirect()->intended('/home');
        }else{
            return redirect()->back()->with('failed_message', 'Username atau password salah');
        }
    }

    function auth_from_simrs(Request $req){
        $cek_user = User::leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
        ->select('smis_adm_user.id', 'smis_hrd_employee.no_ijin')
        ->where('session', $req->session)->first();
        if (Auth::check()) {
            Auth::logout();
        }
        if($cek_user){
            Session::put('rsudslg2-sessionid', $req->session);
            Session::put('rsudslg2-userid', $cek_user->id);
            Auth::loginUsingId($cek_user->id);
            Session::put('sip', $cek_user->no_ijin);
            Session::put('menu', Menu::all());
            return redirect()->intended($req->page.'/'.$req->action);
        }else{
            abort(401);
        }
    }

    function logout(){
        if(Auth::check()){
            DB::table('smis_adm_user')->where('id', Auth::user()->id)->update([
                'session' => ''
            ]);
            Auth::logout();
            return redirect('/')->with('success_message', 'Berhasil keluar');
        }else{
            abort(401);
        }
    }

    function logout_from_simrs(){
        try {
            if(Auth::check()){
                Auth::logout();
                return redirect(env('SMIS_URL'));
            }else{
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    function ajax_search_menu(Request $req)
    {
        $hasil = [];
        $user = User::where('id', Auth::user()->id)->select('menu')->first();
        $menu = Menu::where('menu','<>','smis-administrator')->get();
        foreach ($menu as $m) {
            $sub = json_decode($m->sub_menu);
            foreach ($sub as $s) {
                // dd($s->name.' - '.$req->keyword);
                if (stripos($s->name, $req->keyword) !== false) {
                    $sub_now = $m->menu;
                    $slug = $s->slug;
                    $mymenu = json_decode($user);
                    foreach ($mymenu as $my) {
                        $mysub = json_decode($my);
                        // dd($mysub);
                        if (property_exists($mysub->$sub_now, $s->slug)) {
                            if ($mysub->$sub_now->$slug == '1') {
                                array_push($hasil, ['menu' => $m->menu, 'sub' => $s->slug, 'is_laravel' => $m->is_laravel, 'alias' => $s->name]);
                            }
                        }
                    }
                    // dd('temu');
                }
            }
        }
        return response()->json($hasil);
    }

    function set_session(Request $req){
        Session::put($req->key, $req->nilai);
        return response()->json(Session::get($req->key));
    }
}
