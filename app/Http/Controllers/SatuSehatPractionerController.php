<?php

namespace App\Http\Controllers;

use App\Models\SmisHrdEmployee;
use App\Services\SatuSehatPractionerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SatuSehatPractionerController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'satu_sehat')) {
                $arr = (array) $menu->satu_sehat;
                if ($arr['practioner'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index(){
        return view('satu_sehat.practioner.index');
    }

    function datatable_practitioner(){
        $data = SmisHrdEmployee::where('prop', '')->where('jabatan', 1);
        return DataTables::of($data)->toJson();
    }

    function ajax_get_ihs_number(Request $req, SatuSehatPractionerService $ssps)
    {
        try {
            $ihs = $ssps->get_ihs_number($req);
            return $ihs;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
