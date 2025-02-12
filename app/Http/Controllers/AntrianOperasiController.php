<?php

namespace App\Http\Controllers;

use App\Models\JadwalOperasiRs;
use App\Models\JadwalPoli;
use App\Models\JenisPasien;
use App\Models\ReferensiPoli;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;

class AntrianOperasiController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'antrian')) {
                $arr = (array) $menu->antrian;
                if ($arr['operasi'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index(Request $req){
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
        $data['poli_local'] = $poli_local;
        $data['poli_bpjs'] = ReferensiPoli::all();
        $data['jenis_pasien'] = JenisPasien::where('prop','')->get();
        $query = JadwalOperasiRs::leftJoin('smis_rg_patient', 'jadwal_operasi_rs.nrm', 'smis_rg_patient.id')
        ->select('jadwal_operasi_rs.*', 'smis_rg_patient.nama', 'smis_rg_patient.ktp', 'smis_rg_patient.id as id_pasien', 'smis_rg_patient.alamat')
        ;

        // if ($req->dari != '' && $req->sampai != '') {
        $query->where('tanggaloperasi', '>=', isset($req->dari) ? $req->dari : date('Y-m-d'))->where('tanggaloperasi', '<=', isset($req->sampai) ? $req->sampai : date('Y-m-d'));
        // }
        if (isset($req->status)) {
            if ($req->status != '') {
                $query->where('terlaksana', $req->status);
            }
        }

        $data['keyword'] = '';
        $data['dari'] = isset($req->dari) ? $req->dari : date('Y-m-d');
        $data['sampai'] = isset($req->sampai) ? $req->sampai : date('Y-m-d');
        $data['status'] = isset($req->status) ? $req->status : '';

        $data['antrian'] = $query->paginate(10)->setPath('?dari='.$data['dari'].'&sampai='.$data['sampai'].'&status='.$data['status']);
        return view('antrian.operasi',$data);
    }

    function post(Request $req){
        $req->validate([
            'tanggal_operasi' => 'required',
            'poli' => 'required',
            'poli_bpjs' => 'required',
            'jenis_tindakan' => 'required'
        ],[
            'tanggal_operasi.required' => 'Pilih tanggal terlebih dahulu',
            'poli.required' => 'Pilih poli terlebih dahulu',
            'poli_bpjs.required' => 'Pilih poli BPJS terlebih dahulu',
            'jenis_tindakan.required' => 'Jenis tindakan harus diisi'
        ]);

        try {
            $cek = JadwalOperasiRs::orderBy('id', 'desc')->first();
            
            $kode = 'OP00001';
            if($cek){
                $kode = $this->generate_kode($cek->id);   
            }

            if (strpos($req->jenis_pasien, 'BPJS') !== false) {
                if ($req->nomor_kartu == '' || $req->nomor_kartu == null) {
                    return redirect('antrian/operasi')->with('gagal', 'Nomor BPJS harus diisi untuk jenis pasien BPJS');
                }

                if (strlen($req->nomor_kartu) < 13) {
                    return redirect('antrian/operasi')->with('gagal', 'Nomor BPJS minimal 13 digit');
                }
            }

            JadwalOperasiRs::create([
                'kodebooking' => $kode,
                'pasien_bpjs' => $req->jenis_pasien,
                'nrm' => $req->nrm,
                'tanggaloperasi' => $req->tanggal_operasi,
                'jenistindakan' => $req->jenis_tindakan,
                'kodepoli' => $req->poli_bpjs,
                'namapoli' => $req->poli,
                'terlaksana' => '0',
                'nopeserta' => $req->nomor_kartu ? $req->nomor_kartu : '',
                'lastupdate' => strtotime('now').'000'
            ]);
            return redirect('antrian/operasi')->with('berhasil', 'Antrian operasi berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('antrian/operasi')->with('gagal', $th->getMessage());
        }
    }

    function generate_kode($param){
        $ins = 'OP';
        $count = strlen($param);
        for ($i=$count; $i < 5 ; $i++) { 
            $ins .= '0';
        }
        return $ins.($param+1);
    }

    function ajax_request_antrian_operasi(Request $req){
        $data = JadwalOperasiRs::join('smis_rg_patient', 'jadwal_operasi_rs.nrm', 'smis_rg_patient.id')
        ->select('jadwal_operasi_rs.*', 'smis_rg_patient.nama', 'smis_rg_patient.ktp', 'smis_rg_patient.id as id_pasien', 'smis_rg_patient.alamat')->where('jadwal_operasi_rs.id',$req->id)->first();
        return response()->json($data);
    }

    function ajax_request_refresh_operasi(Request $req){
        $data = JadwalOperasiRs::join('smis_rg_patient', 'jadwal_operasi_rs.nrm', 'smis_rg_patient.id')
        ->select('jadwal_operasi_rs.*', 'smis_rg_patient.nama', 'smis_rg_patient.ktp', 'smis_rg_patient.id as id_pasien', 'smis_rg_patient.alamat')->where('smis_rg_patient.prop', '')->where('jadwal_operasi_rs.tanggaloperasi',$req->tanggal)->get();
        return response()->json($data);
    }

    function ajax_get_operasi(Request $req){
        $query = JadwalOperasiRs::join('smis_rg_patient', 'jadwal_operasi_rs.nrm', 'smis_rg_patient.id')
        ->select('jadwal_operasi_rs.*', 'smis_rg_patient.nama', 'smis_rg_patient.ktp', 'smis_rg_patient.id as id_pasien', 'smis_rg_patient.alamat');
        if ($req->dari != '' && $req->sampai != '') {
            $query->where('tanggaloperasi', '>=', $req->dari)->where('tanggaloperasi', '<=', $req->sampai);
        }
        if ($req->status != '') {
            $query->where('terlaksana', $req->status);
        }
        $data = $query->where('smis_rg_patient.prop','')->get();
        return response()->json($data);
    }

    function update(Request $req){
        $req->validate([
            'tanggal_operasi' => 'required',
            'poli' => 'required',
            'poli_bpjs' => 'required',
            'jenis_tindakan' => 'required'
        ],[
            'tanggal_operasi.required' => 'Pilih tanggal terlebih dahulu',
            'poli.required' => 'Pilih poli terlebih dahulu',
            'poli_bpjs.required' => 'Pilih poli BPJS terlebih dahulu',
            'jenis_tindakan.required' => 'Jenis tindakan harus diisi'
        ]);

        try {
            if (strpos($req->jenis_pasien, 'BPJS') !== false) {
                if ($req->nomor_kartu == '' || $req->nomor_kartu == null) {
                    return redirect('antrian/operasi')->with('gagal', 'Nomor BPJS harus diisi untuk jenis pasien BPJS');
                }

                if (strlen($req->nomor_kartu) < 13) {
                    return redirect('antrian/operasi')->with('gagal', 'Nomor BPJS minimal 13 digit');
                }
            }

            JadwalOperasiRs::where('kodebooking', $req->kodebooking)->update([
                'pasien_bpjs' => $req->jenis_pasien,
                'nrm' => $req->nrm,
                'tanggaloperasi' => $req->tanggal_operasi,
                'jenistindakan' => $req->jenis_tindakan,
                'kodepoli' => $req->poli_bpjs,
                'namapoli' => $req->poli,
                'nopeserta' => $req->nomor_kartu ? $req->nomor_kartu : '',
                'lastupdate' => strtotime('now').'000'
            ]);
            return redirect('antrian/operasi')->with('berhasil', 'Antrian operasi berhasil diubah');
        } catch (\Throwable $th) {
            return redirect('antrian/operasi')->with('gagal', $th->getMessage());
        }
    }

    function delete(Request $req){
        try {
            JadwalOperasiRs::where('id', $req->id)->delete();
            return redirect('antrian/operasi')->with('berhasil', 'Antrian operasi berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('antrian/operasi')->with('gagal', $th->getMessage());
        }
    }

    function laksanakan(Request $req){
        JadwalOperasiRs::where('id', $req->id)->update([
            'terlaksana' => 1
        ]);
        return redirect('antrian/operasi')->with('berhasil', 'Antrian operasi berhasil dilaksanakan');
    }

    function datatable_pasien()
    {

        $data = SMIS_Pasien::select(
                'id',
                'ktp',
                'nama',
                'alamat',
                'nobpjs'
            )->where('prop','');

        return Datatables::of($data)->addIndexColumn()->make(true);
    }
}
