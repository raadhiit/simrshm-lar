<?php

namespace App\Http\Controllers;

use App\Models\SatuSehatLocation;
use App\Models\SatuSehatLocationReference;
use App\Models\SatuSehatOrganisasi;
use App\Models\SmisAdmPrototype;
use App\Services\SatuSehatLocationService;
use App\Services\SatuSehatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SatuSehatLocationController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'satu_sehat')) {
                $arr = (array) $menu->satu_sehat;
                if ($arr['location'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index(Request $req){
        $data['referensi'] = SatuSehatLocationReference::all();
        $data['prototype'] = SmisAdmPrototype::all();
        $data['organisasi'] = SatuSehatOrganisasi::all();
        return view('satu_sehat.location.index', $data);
    }

    function datatable_location(Request $req){
        $data = SatuSehatLocation::leftJoin('smis_ss_organisasi', 'smis_ss_organisasi.id_organisasi', 'smis_ss_lokasi.dikelola_oleh')->select('smis_ss_lokasi.*', 'smis_ss_organisasi.nama as organisasi');
        return DataTables::of($data)->toJson();
    }

    function datatable_location_reference(Request $req){
        $data = SatuSehatLocationReference::select('*');
        return DataTables::of($data)->toJson();
    }

    function ajax_update_location_reference(Request $req, SatuSehatLocationService $ssls){
        try {
            $ssls->update_referensi();
            return response()->json([
                'status' => true,
                'message' => 'Update data referensi lokasi berhasil'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function store(Request $req, SatuSehatLocationService $ssls){
        try {
            $store = $ssls->store($req);
            return response()->json($store);
        } catch (\Throwable $th) {
            toastr()->error('Oops! Something went wrong!');
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function update(Request $req, SatuSehatLocationService $ssls){
        try {
            $store = $ssls->update($req);
            return response()->json($store);
        } catch (\Throwable $th) {
            toastr()->error('Oops! Something went wrong!');
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function ajax_select_location(Request $req){
        $data = SatuSehatLocation::where('id', $req->id)->first();
        return response()->json($data);
    }
}
