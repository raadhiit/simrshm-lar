<?php

namespace App\Http\Controllers;

use App\Models\RsCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class CredentialsAntrianController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'jadwal_poli')) {
                $arr = (array) $menu->jadwal_poli;
                if ($arr['credentials'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index()
    {
        $data['data'] = RsCredential::where('layanan', 'antrian')->first();
        return view('credentials_antrian', $data);
    }

    function post_credentials(Request $req)
    {
        $v = Validator::make($req->all(), [
            'cons_id' => 'required',
            'cons_secret' => "required",
            'user_key' => 'required',
            'nama_rs' => 'required',
            'kode_ppk' => "required",
            'base_url' => "required"
        ]);

        if ($v->fails()) {
            $data['status'] = false;
            $data['errors'] = $v->getMessageBag()->toArray();
            return response()->json($data);
        }

        try {
            RsCredential::updateOrCreate([
                'layanan' => 'antrian'
            ], [
                'cons_id' => $req->cons_id,
                'cons_secret' => $req->cons_secret,
                'user_key' => $req->user_key,
                'nama_rs' => $req->nama_rs,
                'kode_ppk' => $req->kode_ppk,
                'base_url' => $req->base_url,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Credentials saved successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something wrong'
            ]);
        }
    }
}
