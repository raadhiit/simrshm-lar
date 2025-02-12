<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMIS_Faskes;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SMIS_DFM1_Penjualan_Resep;
use App\Models\SMIS_DFM2_Penjualan_Resep;
use App\Models\SMIS_DFM3_Penjualan_Resep;
use App\Models\SMIS_DFM4_Penjualan_Resep;
use App\Models\SMIS_DFM5_Penjualan_Resep;
use PDF;
use iio\libmergepdf\Merger;
use Illuminate\Http\Response;
use Auth;

class DokumenRmController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'medical_record')) {
                $arr = (array) $menu->medical_record;
                if ($arr['dokumen_rm'] == 0) {
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
        return view('dokumen_rm.index', [
            'faskes' => SMIS_Faskes::select('nama')->get()
        ]);
    }

    function ajax_filter_dokumen_rm(Request $req)
    {
        $query = SMIS_Pasien::query();
        $query->select('nrm', 'nama', 'kelamin', 'tgl_lahir', 'alamat');
        if ($req->nama_pasien != '') {
            $query->where('nama', 'like', '%' . $req->nama_pasien . '%');
        }
        if ($req->no_rm != '') {
            $query->where('nrm', 'like', '%' . $req->no_rm . '%');
        }
        if ($req->unit_kerja != '') {
            $query->where('ukerja', 'like', '%' . $req->unit_kerja . '%');
        }
        $data = $query->get();
        return response()->json($data);
    }

    function download(Request $req)
    {
        $data['pasien'] = SMIS_Pasien::leftJoin('smis_rg_layananpasien', 'smis_rg_patient.nrm', 'smis_rg_layananpasien.nrm')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_layananpasien.asuransi', 'smis_rg_asuransi.id')
            ->select(
                'smis_rg_layananpasien.jenislayanan',
                'smis_rg_layananpasien.kabupaten_pj',
                'smis_rg_layananpasien.kecamatan_pj',
                'smis_rg_layananpasien.desa_pj',
                'smis_rg_layananpasien.alamat_pj',
                'smis_rg_layananpasien.namapenanggungjawab',
                'smis_rg_layananpasien.telponpenanggungjawab',
                'smis_rg_patient.nrm as nrm',
                'smis_rg_patient.nobpjs as nobpjs',
                'smis_rg_patient.nama as nama',
                'smis_rg_patient.alamat as alamat',
                'smis_rg_patient.nama_kelurahan as kelurahan',
                'smis_rg_patient.nama_kecamatan as kecamatan',
                'smis_rg_patient.nama_kabupaten as kabupaten',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.asuransi as asuransi',
                'smis_rg_layananpasien.nama_perusahaan as perusahaan',
                'smis_rg_patient.telpon',
                'smis_rg_patient.pekerjaan',
                'smis_rg_patient.pendidikan',
                'smis_rg_patient.suku',
                'smis_rg_patient.agama',
                'smis_rg_patient.status',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_asuransi.nama as asuransi'
            )
            ->where('smis_rg_patient.nrm', $req->id)
            ->orderBy('smis_rg_layananpasien.id', 'asc')->first();

        $asesmen = SMIS_LayananPasien::with(['diagnosa', 'laborat'])->where('nrm', $req->id)->get();
        foreach ($asesmen as $as) {
            $cek_prefix = $as->id;
            if (strpos($cek_prefix, 'pratama') !== false) {
                $as->resep = SMIS_DFM1_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $as->id)->get();
            } else if (strpos($cek_prefix, 'banjarsari') !== false) {
                $as->resep = SMIS_DFM2_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $as->id)->get();
            } else if (strpos($cek_prefix, 'kalikempit') !== false) {
                $as->resep = SMIS_DFM3_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $as->id)->get();
                // dd($data['resep']);
            } else if (strpos($cek_prefix, 'kalibaru') !== false) {
                $as->resep = SMIS_DFM4_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $as->id)->get();
            } else if (strpos($cek_prefix, 'siliragung') !== false) {
                $as->resep = SMIS_DFM5_Penjualan_Resep::with(['obat_jadi', 'obat_racik.bahan'])->where('noreg_pasien', $as->id)->get();
            } else {
                $as->resep = [];
            }
        }
        $data['asesmen'] = $asesmen;

        $data['klinik'] = SMIS_Faskes::where('nama', $req->klinik)->first();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf_one = PDF::loadView('dokumen_rm.pdf', $data)->setPaper('A4');
        $pdf_two = PDF::loadView('dokumen_rm.pdf_asesmen', $data)->setPaper('A4', 'landscape');
        $pdf_three = PDF::loadView('dokumen_rm.pdf_asesmen_gigi', $data)->setPaper('A4', 'landscape');
        $m = new Merger();
        $m->addRaw($pdf_one->output());
        $m->addRaw($pdf_two->output());
        $m->addRaw($pdf_three->output());
        $contents = $m->merge();
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
        // return response()->download($m->merge(),'Dokumen_rekam_medis_' . $data['pasien']->nama . '_' . $data['pasien']->nrm . '.pdf');
    }
}
