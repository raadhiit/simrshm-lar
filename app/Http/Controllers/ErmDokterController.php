<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsesmenUlangRequest;
use App\Http\Requests\CatatanPerkembanganPasienTerintegrasiRequest;
use App\Http\Requests\PengkajianKeperawatanRawatJalanRequest;
use App\Http\Requests\PengkajianMedisAwalRawatJalanRequest;
use App\Models\DokumenKunjungan;
use App\Models\SMIS_Diagnosa;
use App\Models\Smis_Doc_Asesmen_Ulang;
use App\Models\Smis_Doc_Asesment_Medis_Awal;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\Smis_Rad_Pesanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use App\Services\AsesmenUlangService;
use App\Services\CatatanPerkembanganPasienTerintegrasiService;
use App\Services\DokumenKunjunganService;
use App\Services\ERekamMedisService;
use App\Services\ErmRanapService;
use App\Services\LaboratoriumService;
use App\Services\MedicalRecordService;
use App\Services\PengkajianKeperawatanRajalService;
use App\Services\PengkajianMedisAwalRajalService;
use App\Services\RadiologiService;
use App\Services\ResepService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PDF;
use iio\libmergepdf\Merger;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\Facades\DataTables;

class ErmDokterController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'e_rekam_medis')) {
                $arr = (array)$menu->e_rekam_medis;
                if ($arr['dokter'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function pdf($data, $view)
    {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf_one = PDF::loadView($view, $data)->setPaper('A4');
        $m = new Merger();
        $m->addRaw($pdf_one->output());
        $contents = $m->merge();
        return $contents;
    }

    function index(Request $req)
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
        return view('erm.dokter.index', $data);
    }

    function detail(Request $req, MedicalRecordService $mrs)
    {
        $query_pasien = SMIS_Pasien::select('*');
        $query_history = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->leftJoin('smis_mr_diagnosa', 'smis_rg_layananpasien.id', 'smis_mr_diagnosa.noreg_pasien')
            ->select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.tanggal',
                'smis_rg_layananpasien.jenislayanan',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.last_nama_ruangan',
                'smis_rg_layananpasien.nama_pasien',
                'smis_mr_diagnosa.diagnosa',
                'smis_mr_diagnosa.ruangan',
            );
        if ($req->nrm != '' && $req->nrm != null) {
            $query_pasien->where('id', '=', $req->nrm);
            $query_history->where('smis_rg_layananpasien.nrm', $req->nrm);
        }
        $data['patient'] = $query_pasien->first();
        $data['history'] = $query_history->orderBy('tanggal', 'desc')->get();
        $data['layanan'] = count($data['history']) > 0 ? $data['history'][0] : null;
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();

        return view('erm.dokter.detail', $data);
    }

    function ajax_filter_data(Request $req)
    {
        $query = SMIS_LayananPasien::with('rg_asuransi', 'perusahaan')
            ->select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.last_nama_ruangan',
                'no_kunjungan',
                'nama_dokter',
                'last_ruangan',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.nrm',
                'no_sep_rj',
                'nobpjs',
                'carabayar',
                'selesai',
                'smis_rg_layananpasien.tanggal',
                'smis_rg_layananpasien.nama_perusahaan',
                'smis_rg_layananpasien.asuransi'
            )
            ->selectRaw('JSON_ARRAYAGG(nama_dokumen) as nama_dokumen')
            ->selectRaw('JSON_ARRAYAGG(dokumen_kunjungan_pasien.status) as status_dokumen')
            ->selectRaw('JSON_ARRAYAGG(dokumen_kunjungan_pasien.id) as id_dokumen')
            ->selectRaw('JSON_ARRAYAGG(dokumen_kunjungan_pasien.prop) as prop_dokumen')
            ->leftjoin('dokumen_kunjungan_pasien', 'smis_rg_layananpasien.id', 'dokumen_kunjungan_pasien.noreg')
            ->groupBy('smis_rg_layananpasien.id');

        if ($req->poli) {
            $query->where('last_nama_ruangan', 'like', '%' . $req->poli . '%');
        }
        if ($req->dokter) {
            $query->where('nama_dokter', 'like', '%' . $req->dokter . '%');
        }
        if ($req->tanggal) {
            $query->whereDate('smis_rg_layananpasien.tanggal', $req->tanggal);
        }
        if ($req->status != null && $req->status != '') {
            $query->where('selesai', $req->status);
        }

        if ($req->uri) {
            $query->where('uri', $req->uri);
        }
        return Datatables::of($query)->make(true);
    }

    function ajax_create_dokumen_kunjungan(Request $req, MedicalRecordService $mrs)
    {
        try {
            // $layanan = SMIS_LayananPasien::findOrFail($req->noreg);
            // if ($req->jenis_dokumen != 'Persetujuan atau Penolakan Tindakan Kedokteran') {
            //     $cek = DokumenKunjungan::where('nama_dokumen', $req->jenis_dokumen)->where('noreg', $req->noreg)->where('ruangan', $layanan->last_ruangan)->where('prop', '')->first();
            //     if ($cek) {
            //         return response()->json([
            //             'status' => false,
            //             'message' => 'Dokumen sudah pernah dibuat'
            //         ]);
            //     }
            // }
            $data = $mrs->create_dokumen_kunjungan($req);
            return response()->json([
                'status' => true,
                'message' => 'Dokumen berhasil dibuat',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function catatan_perkembangan_pasien_terintegrasi_v2(Request $req, ErmRanapService $ers)
    {
        $data['jenis'] = $req->jenis ? $req->jenis : 'cppt';

        switch ($req->jenis) {
            case 'cppt':
                $data = $ers->catatan_perkembangan_pasien_terintegrasi_rawat_inap($req);
                return view('erm.dokumen_kunjungan.cppt_v2.catatan_perkembangan_pasien_terintegrasi', $data);
                break;

            default:
                $data = $ers->catatan_perkembangan_pasien_terintegrasi_rawat_inap($req);
                return view('erm.dokumen_kunjungan.cppt_v2.catatan_perkembangan_pasien_terintegrasi', $data);
                break;
        }
    }

    function asesmen_medis_terakhir_cppt_v2(Request $req, LaboratoriumService $ls, RadiologiService $rs)
    {
        $data['dokumen'] = DokumenKunjungan::findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $data['dokumen']->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $data['dokumen']->nrm)->where('prop', '')->first();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['asesmen_medis_awal_rajal'] = DokumenKunjungan::with('asesment_medis_awal')
            ->join('smis_rg_layananpasien', 'smis_rg_layananpasien.id', 'dokumen_kunjungan_pasien.noreg')
            ->leftJoin('smis_mr_tanda_vital', 'smis_mr_tanda_vital.noreg_pasien', 'smis_rg_layananpasien.id')
            ->select(
                'dokumen_kunjungan_pasien.*',
                'smis_rg_layananpasien.uri',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.tanggal as tanggal_masuk',
                'smis_mr_tanda_vital.tensi',
                'smis_mr_tanda_vital.nadi',
                'smis_mr_tanda_vital.suhu',
                'smis_mr_tanda_vital.rr',
            )
            ->where('noreg', $data['dokumen']->noreg)->where('nama_dokumen', 'Asesment Medis Awal Rawat Jalan')->orderBy('id', 'desc')->first();

        $data['asesmen_gawat_darurat'] = DokumenKunjungan::with('dokumen_asesment_awal_medis_gawat_darurat')
            ->join('smis_rg_layananpasien', 'smis_rg_layananpasien.id', 'dokumen_kunjungan_pasien.noreg')
            ->leftJoin('smis_mr_tanda_vital', 'smis_mr_tanda_vital.noreg_pasien', 'smis_rg_layananpasien.id')
            ->select(
                'dokumen_kunjungan_pasien.*',
                'smis_rg_layananpasien.uri',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.tanggal as tanggal_masuk',
                'smis_mr_tanda_vital.tensi',
                'smis_mr_tanda_vital.nadi',
                'smis_mr_tanda_vital.suhu',
                'smis_mr_tanda_vital.rr',
            )
            ->where('noreg', $data['dokumen']->noreg)->where('nama_dokumen', 'Dokumen Asesment Awal Medis Gawat Darurat')->orderBy('id', 'desc')->first();

        $data['asesmen_awal_pasien_ranap'] = DokumenKunjungan::join('smis_rg_layananpasien', 'smis_rg_layananpasien.id', 'dokumen_kunjungan_pasien.noreg')
            ->leftJoin('smis_mr_tanda_vital', 'smis_mr_tanda_vital.noreg_pasien', 'smis_rg_layananpasien.id')
            ->select(
                'dokumen_kunjungan_pasien.*',
                'smis_rg_layananpasien.uri',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.tanggal as tanggal_masuk',
                'smis_mr_tanda_vital.tensi',
                'smis_mr_tanda_vital.nadi',
                'smis_mr_tanda_vital.suhu',
                'smis_mr_tanda_vital.rr',
            )
            ->where('dokumen_kunjungan_pasien.noreg', $data['dokumen']->noreg)->where('nama_dokumen', 'like', '%Asesmen Awal Pasien Rawat Inap%')->first();



        return view('erm.dokumen_kunjungan.cppt_v2.asesmen_medis_terakhir', $data);
    }

    function riwayat_cppt_v2(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        return view('erm.dokumen_kunjungan.cppt_v2.riwayat_cppt', [
            'dokumen' => $dokumen,
            'pasien' => SMIS_Pasien::where('id', $dokumen->nrm)->first(),
            'layanan' => SMIS_LayananPasien::where('id', $dokumen->noreg)->first(),
            'data' => DokumenKunjungan::where('nama_dokumen', 'Catatan Perkembangan Pasien Terintegrasi (CPPT)')
                ->join('smis_rg_layananpasien', 'smis_rg_layananpasien.id', 'dokumen_kunjungan_pasien.noreg')
                ->select(
                    'dokumen_kunjungan_pasien.*',
                    'smis_rg_layananpasien.uri',
                    'smis_rg_layananpasien.last_ruangan',
                    'smis_rg_layananpasien.tanggal as tanggal_masuk',
                )
                ->where('noreg', '!=', $dokumen->noreg)
                ->where('dokumen_kunjungan_pasien.nrm', $dokumen->nrm)
                ->orderBy('id', 'desc')->limit(10)->get()
        ]);
    }

    function pdf_catatan_perkembangan_pasien_terintegrasi_v2(Request $req, ErmRanapService $ers)
    {
        $data['dokumen'] = DokumenKunjungan::where('id', $req->dokumen)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $data['dokumen']->nrm)->where('prop', '')->first();
        $data['layanan'] = SMIS_LayananPasien::where('id', $data['dokumen']->noreg)->where('prop', '')->first();
        $data['cppt'] = $ers->data_cppt_ranap($req);
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.cppt_v2.pdf_catatan_perkembangan_pasien_terintegrasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }
}
