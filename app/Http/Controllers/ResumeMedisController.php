<?php

namespace App\Http\Controllers;

use App\Models\SMIS_DFM3;
use App\Models\SMIS_DFM1_Penjualan_Resep;
use App\Models\SMIS_DFM2_Penjualan_Resep;
use App\Models\SMIS_DFM3_Penjualan_Resep;
use App\Models\SMIS_DFM4_Penjualan_Resep;
use App\Models\SMIS_DFM5_Penjualan_Resep;
use App\Models\SMIS_Faskes;
use App\Models\SMIS_LayananPasien;
use Illuminate\Http\Request;
use iio\libmergepdf\Merger;
use PDF;
use Illuminate\Http\Response;
use Auth;

class ResumeMedisController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'medical_record')) {
                $arr = (array) $menu->medical_record;
                if ($arr['resume_medis'] == 0) {
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
        return view('resume_medis.index', [
            'faskes' => SMIS_Faskes::select('nama')->get()
        ]);
    }

    function ajax_filter_resume_medis(Request $req)
    {
        $query = SMIS_LayananPasien::query();
        $query->select('nrm', 'id', 'nama_pasien', 'kelamin', 'tanggal', 'tanggal_inap', 'tanggal_pulang', 'umur');
        if ($req->nama_pasien != null) {
            $query->where('nama_pasien', 'like', '%' . $req->nama_pasien . '%');
        }
        if ($req->no_rm != null) {
            $query->where('nrm', 'like', '%' . $req->no_rm . '%');
        }
        if ($req->no_reg != null) {
            $query->where('id', 'like', '%' . $req->no_reg . '%');
        }
        if ($req->unit_kerja != null) {
            $query->where('unit_kerja', 'like', '%' . $req->unit_kerja . '%');
        }
        $data = $query->get();
        return response()->json($data);
    }

    function download(Request $req)
    {
        $data['data'] = SMIS_LayananPasien::with(['diagnosa', 'laborat'])->where('id', $req->id)->first();
        $cek_prefix = $data['data']->id;
        if (strpos($cek_prefix, 'pratama') !== false) {
            $data['resep'] = SMIS_DFM1_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $req->id)->get();
        } else if (strpos($cek_prefix, 'banjarsari') !== false) {
            $data['resep'] = SMIS_DFM2_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $req->id)->get();
        } else if (strpos($cek_prefix, 'kalikempit') !== false) {
            $data['resep'] = SMIS_DFM3_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $req->id)->get();
            // dd($data['resep']);
        } else if (strpos($cek_prefix, 'kalibaru') !== false) {
            $data['resep'] = SMIS_DFM4_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $req->id)->get();
        } else if (strpos($cek_prefix, 'siliragung') !== false) {
            $data['resep'] = SMIS_DFM5_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $req->id)->get();
        } else {
            $data['resep'] = [];
        }

        $data['klinik'] = SMIS_Faskes::where('nama', $data['data']->unit_kerja)->first();

        // dd($data['data']->diagnosa);
        $merger = new Merger();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('resume_medis.pdf', $data)->setPaper('A4');
        // return $pdf->download('Resume_medis_' . $data['data']->nama_pasien . '.pdf');
        $merger->addRaw($pdf->output());
        $contents = $merger->merge();
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }
}
