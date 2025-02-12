<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\SMIS_Pasien;
use App\Models\JadwalPoli;
use App\Models\SmisAdmPrototype;
use App\Models\SmisHrdEmployee;
use App\Models\SmisAdmSettings;
use App\Services\SatuSehatEncounterService;
use Auth;

class AntrianPoliController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'antrian')) {
                $arr = (array) $menu->antrian;
                if ($arr['poli'] == 0) {
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
        $poli_local = [];
        $proto = SmisAdmPrototype::where('parent', 'rawat')->where('prop', '<>', 'del')->get();
        foreach ($proto as $pro) {
            $cek = SmisAdmSettings::where('name', 'smis-rs-urjip-' . $pro->slug)->select('value')->first();
            if ($cek) {
                if ($cek->value == 'URJ') {
                    array_push($poli_local, $pro);
                }
            }
        }
        $data['poli'] = $poli_local;
        $data['dokter'] = SmisHrdEmployee::where('jabatan', 1)->select('nama')->get();
        return view('antrian.poli', $data);
    }

    function filter(Request $req)
    {
        $query = Antrian::query();
        $query->leftJoin('smis_rg_patient', 'smis_rg_patient.id', 'antrians.norm')
            ->select('antrians.*', 'smis_rg_patient.nama as pasien', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.ktp', 'smis_rg_patient.nobpjs')
            ->where('tanggalperiksa', date('Y-m-d'))->where('smis_rg_patient.prop', '');
        if ($req->dokter != null) {
            $query->where('namadokter', 'like', '%'.$req->dokter.'%');
        }
        if ($req->poli != null) {
            $query->where('namapoli', 'like', '%'.$req->poli.'%');
        }
        $query->where(function ($q) {
            $q->where('taskid', 3)->orWhere('taskid', 4);
        });
        $hasil = $query->where('antrians.keterangan', '!=', 'farmasi')->orderBy('waktu_checkin')->get();
        return response()->json($hasil);
    }

    function layani_antrian(Request $req,SatuSehatEncounterService $sses)
    {
        $antrian = Antrian::findOrFail($req->id);
        $pasien = SMIS_Pasien::where('id', $antrian->norm)->first();
        $jadwal = JadwalPoli::findOrFail($antrian->jadwal_id);
        $employee = SmisHrdEmployee::where('id', $jadwal->id_dokter)->first();

        $waktu = strtotime(now()) . '000';

        $obj_bpjs = new CheckinController();
        $hit_bpjs = $obj_bpjs->update_waktu_antrian(4, $antrian->kodebooking, $waktu);

        Antrian::where('id', $req->id)->update([
            'taskid' => 4,
            'waktu_taskid_empat' => $waktu,
            'updated_at' => date('Y-m-d H:i:s', strtotime('+7 hours'))
        ]);

        $antrian = Antrian::findOrFail($req->id);

        if ($employee->ihs_number != '' && $pasien->ihs_number != '') {
            $encounter = $sses->update_inprogress($antrian, $waktu);

            if (!$encounter['status']) {
                return response()->json($encounter);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Ok'
        ]);
    }

    function selesai_antrian(Request $req)
    {
        $antrian = Antrian::findOrFail($req->id);

        $waktu = strtotime(now()) . '000';

        $obj_bpjs = new CheckinController();
        $obj_bpjs->update_waktu_antrian(5, $antrian->kodebooking, $waktu);

        if ($req->lanjut == 0) {
            Antrian::where('id', $req->id)->update([
                'taskid' => 5,
                'waktu_taskid_lima' => $waktu,
                'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
            ]);
        }else{
            Antrian::where('id', $req->id)->update([
                'taskid' => 5,
                'waktu_taskid_lima' => $waktu,
                'keterangan' => 'farmasi',
                'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Ok'
        ]);
    }
}
