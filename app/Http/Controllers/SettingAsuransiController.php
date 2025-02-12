<?php

namespace App\Http\Controllers;

use App\Models\SMIS_Rg_Asuransi;
use App\Models\SMIS_Setting_Id_Asuransi;
use Illuminate\Http\Request;
use Auth;

class SettingAsuransiController extends Controller
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

    function index(){
        $data['id'] = SMIS_Setting_Id_Asuransi::join('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_setting_id_asuransi.id_asuransi')->first();
        $data['asuransi'] = SMIS_Rg_Asuransi::where('prop', '')->get();
        return view('setting.asuransi',$data);
    }

    function select(Request $req){
        $cek = SMIS_Setting_Id_Asuransi::first();
        if ($cek) {
            SMIS_Setting_Id_Asuransi::where('id', $cek->id)->update([
                'id_asuransi' => $req->id
            ]);
        }else{
            SMIS_Setting_Id_Asuransi::create([
                'id_asuransi' => $req->id
            ]);
        }
        return redirect('asuransi')->with('sukses', 'Asuransi berhasil dipilih');
    }
}
