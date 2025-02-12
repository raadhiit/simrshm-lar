<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\SmisAdmPrototype;
use App\Models\SmisHrdEmployee;
use Auth;

class AntrianFarmasiController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'antrian')) {
                $arr = (array) $menu->antrian;
                if ($arr['farmasi'] == 0) {
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
        $data['antrian'] = Antrian::leftJoin('smis_rg_patient', 'smis_rg_patient.id', 'antrians.norm')
            ->select('antrians.*', 'smis_rg_patient.nama as pasien', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.ktp', 'smis_rg_patient.nobpjs')
            ->where('smis_rg_patient.prop', '')
            ->where('tanggalperiksa', date('Y-m-d'))
            ->where(function ($q) {
                $q->where('taskid', '5')->orWhere('taskid', '6')->orWhere('taskid', '7');
            })
            ->where('antrians.keterangan', 'farmasi')
            ->orderBy('waktu_checkin')
            ->get();
        return view('antrian.farmasi', $data);
    }

    function ajax_request_antrian()
    {
        $data = Antrian::leftJoin('smis_rg_patient', 'smis_rg_patient.id', 'antrians.norm')
            ->select('antrians.*', 'smis_rg_patient.nama as pasien', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.ktp', 'smis_rg_patient.nobpjs')
            ->where('smis_rg_patient.prop', '')
            ->where('tanggalperiksa', date('Y-m-d'))
            ->where(function ($q) {
                $q->where('taskid', '5')->orWhere('taskid', '6')->orWhere('taskid', '7');
            })
            ->where('antrians.keterangan', 'farmasi')
            ->orderBy('waktu_checkin')
            ->get();
        return response()->json($data);
    }

    function layani_antrian(Request $req)
    {
        try {
            $antrian = Antrian::findOrFail($req->id);

            $waktu = strtotime(now()) . '000';

            $obj_bpjs = new CheckinController();
            $hit_bpjs = $obj_bpjs->update_waktu_antrian(6, $antrian->kodebooking, $waktu);

            if ($hit_bpjs['status'] == false) {
                return response()->json([
                    'status' => false,
                    'message' => $hit_bpjs['message']
                ]);
            }

            Antrian::where('id', $req->id)->update([
                'jenis_obat' => $req->jenis_obat,
                'taskid' => 6,
                'waktu_taskid_enam' => $waktu,
                'updated_at' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ]);

            return response()->json([
                'status' => true,
                'message' => $hit_bpjs['message'],
                'data' => $antrian
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function selesai_antrian(Request $req)
    {
        try {
            $antrian = Antrian::findOrFail($req->id);

            $waktu = strtotime(now()) . '000';

            $obj_bpjs = new CheckinController();
            $hit_bpjs = $obj_bpjs->update_waktu_antrian(7, $antrian->kodebooking, $waktu);

            if ($hit_bpjs['status'] == false) {
                return response()->json([
                    'status' => false,
                    'message' => $hit_bpjs['message']
                ]);
            }

            Antrian::where('id', $req->id)->update([
                'taskid' => 7,
                'waktu_taskid_tujuh' => $waktu,
                'updated_at' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ]);

            return response()->json([
                'status' => true,
                'message' => $hit_bpjs['message'],
                'data' => $antrian
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
