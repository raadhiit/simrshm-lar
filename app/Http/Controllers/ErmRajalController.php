<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsesmentMedisAwalRequest;
use App\Http\Requests\DokumenLaporanCaesarianRequest;
use App\Http\Requests\DokumenTransferPasienInternalRequest;
use App\Http\Requests\SmisDocPenolakanRawatInapRequest;
use App\Models\Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat;
use App\Http\Requests\FormulirTriageTerintegrasiRequest;
use App\Http\Requests\PengkajianKeperawatanRawatJalanRequest;
use App\Http\Requests\SuratPermintaanRawatInapRequest;
use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Lembar_Hasil_Tindakan_Uji_Fungsi;
use App\Models\FormulirLayananKedokteranFisikRehabilitasi;
use App\Models\SMIS_Diagnosa;
use App\Models\Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi;
use App\Models\Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd;
use App\Models\Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisDocPenolakanRawatInap;
use App\Models\SmisHrdEmployee;
use App\Services\AsesmentMedisAwalService;
use App\Services\DokumenAsesmentAwalKeperawatanIgdService;
use App\Services\DokumenAsesmentAwalMedisGawatDaruratService;
use App\Services\DokumenKunjungan\FormulirKlaimFisioterapiService;
use App\Services\DokumenKunjungan\LembarHasilTindakanUjiFungsiService;
use App\Services\DokumenKunjungan\ProgramPelayananFisioterapiService;
use App\Services\DokumenKunjunganService;
use App\Services\DokumenLaporanCaesarianService;
use App\Services\DokumenTransferPasienInternalService;
use App\Services\ErmRajalService;
use App\Services\FormulirAsesmenAwalPasienRawatInapDewasaService;
use App\Services\FormulirLayananKedokteranFisikRehabilitasiService;
use App\Services\FormulirTriageTerintegrasiService;
// use App\Services\F
use App\Services\FormulirTriageTerintgrasiServiceV2;
use App\Services\LaboratoriumService;
use App\Services\MedicalRecordService;
use App\Services\PengkajianKeperawatanRajalService;
use App\Services\PenolakanRawatInapService;
use App\Services\RadiologiService;
use App\Services\ResepService;
use App\Services\SuratPermintaanRawatInapService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Response as ResponseDownload;
use Illuminate\Support\Facades\Auth;
use PDF;
use iio\libmergepdf\Merger;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\Facades\DataTables;

class ErmRajalController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'e_rekam_medis')) {
                $arr = (array)$menu->e_rekam_medis;
                if ($arr['rawat_jalan'] == 0) {
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
        return view('erm.rawat_jalan.index', $data);
    }

    function detail(Request $req, MedicalRecordService $mrs)
    {
        $data = $mrs->get_patient_and_history_kunjungan($req);
        return view('erm.rawat_jalan.detail', $data);
    }

    function ajax_filter_data(Request $req)
    {
        $query = SMIS_LayananPasien::select('no_kunjungan', 'nama_dokter', 'last_nama_ruangan', 'nama_pasien', 'nrm', 'nobpjs', 'selesai');
        if ($req->uri != '') {
            $query->where('uri', $req->uri);
        }
        if ($req->poli) {
            $query->where('last_nama_ruangan', 'like', '%' . $req->poli . '%');
        }
        if ($req->dokter) {
            $query->where('nama_dokter', 'like', '%' . $req->dokter . '%');
        }
        if ($req->tanggal) {
            $query->whereDate('tanggal', $req->tanggal);
        }
        if ($req->status != null && $req->status != '') {
            $query->where('selesai', $req->status);
        }
        return Datatables::of($query->get())->make(true);
    }

    function ajax_create_dokumen_kunjungan(Request $req, MedicalRecordService $mrs)
    {
        try {
            // if ($req->jenis_dokumen != 'Dokumen Transfer Pasien Internal' && $req->jenis_dokumen != 'Persetujuan atau Penolakan Tindakan Kedokteran') {
            //     if (DokumenKunjungan::where('nama_dokumen', $req->jenis_dokumen)->where('noreg', $req->noreg)->where('prop', '')->first()) {
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

    function asesment_medis_awal(Request $req, AsesmentMedisAwalService $amas)
    {
        $data = $amas->data($req);
        return view('erm.dokumen_kunjungan.asesment_medis_awal', $data);
    }

    function pdf_asesment_medis_awal(Request $req, AsesmentMedisAwalService $amas)
    {
        $data = $amas->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_asesment_medis_awal');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function save_asesment_medis_awal(Request $req, AsesmentMedisAwalService $amas)
    {
        try {
            $amas->create($req);
            return redirect('e_rekam_medis/detail/asesment_medis_awal_rawat_jalan?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function surat_permintaan_rawat_inap(Request $req, SuratPermintaanRawatInapService $spris)
    {
        $data = $spris->data($req);
        return view('erm.dokumen_kunjungan.surat_permintaan_rawat_inap', $data);
    }

    function pdf_surat_permintaan_rawat_inap(Request $req, SuratPermintaanRawatInapService $spris)
    {
        $data = $spris->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_surat_permintaan_rawat_inap');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function save_surat_permintaan_rawat_inap(SuratPermintaanRawatInapRequest $req, SuratPermintaanRawatInapService $spris)
    {
        try {
            $spris->create($req);
            return redirect('e_rekam_medis/detail/surat_permintaan_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function dokumen_transfer_pasien_internal(Request $req, DokumenTransferPasienInternalService $dtpis)
    {
        $data = $dtpis->data($req);
        return view('erm.dokumen_kunjungan.dokumen_transfer_pasien_internal', $data);
    }

    function save_dokumen_transfer_pasien_internal(DokumenTransferPasienInternalRequest $req, DokumenTransferPasienInternalService $dtpis)
    {
        try {
            $dtpis->create($req);
            return redirect('e_rekam_medis/detail/dokumen_transfer_pasien_internal?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function verifikasi_petugas_penyerahan(Request $req, DokumenTransferPasienInternalService $dtpis)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $sts = $dtpis->verifikasi($req);
                if ($sts) {
                    return redirect('e_rekam_medis/detail/dokumen_transfer_pasien_internal?dokumen=' . $req->dokumen)->with('sukses', 'Dokumen berhasil diverifikasi');
                } else {
                    return redirect()->back()->with('gagal', 'Verifikasi data gagal');
                }
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function pdf_dokumen_transfer_pasien_internal(Request $req, DokumenTransferPasienInternalService $dtpis)
    {
        $data = $dtpis->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_dokumen_transfer_pasien_internal');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }
    function dokumen_laporan_caesarian(Request $req, DokumenLaporanCaesarianService $dlcs)
    {
        $data = $dlcs->data($req);
        return view('erm.dokumen_kunjungan.dokumen_laporan_caesarian', $data);
    }

    function save_dokumen_laporan_caesarian(Request $req, DokumenLaporanCaesarianService $dlcs)
    {
        try {
            $dlcs->create($req);
            return redirect('e_rekam_medis/detail/dokumen_laporan_caesarian?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function pdf_dokumen_laporan_caesarian(Request $req, DokumenLaporanCaesarianService $dlcs)
    {
        $data = $dlcs->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_dokumen_laporan_caesarian');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function formulir_triage_terintegrasi(Request $req, FormulirTriageTerintegrasiService $ftts)
    {
        $data = $ftts->data($req);
        return view('erm.dokumen_kunjungan.formulir_triage_terintegrasi', $data);
    }

    function save_formulir_triage_terintegrasi(Request $req, FormulirTriageTerintegrasiService $ftts)
    {
        try {
            $ftts->create($req);
            return redirect('e_rekam_medis/detail/formulir_triage_terintegrasi_v2?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function pdf_formulir_triage_terintegrasi(Request $req, FormulirTriageTerintegrasiService $ftts)
    {
        $data = $ftts->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_formulir_triage_terintegrasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function formulir_triage_terintegrasi_v2(Request $req, FormulirTriageTerintgrasiServiceV2 $ftts)
    {
        $data = $ftts->data($req);
        return view('erm.dokumen_kunjungan.formulir_triage_terintegrasi_v2', $data);
    }

    function save_formulir_triage_terintegrasi_v2(Request $req, FormulirTriageTerintgrasiServiceV2 $ftts)
    {
        try {
            $ftts->create($req);

            $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
                ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
            $layanan = SMIS_LayananPasien::with('diagnosa')->where('id', $dokumen->noreg)->where('prop', '')->first();
            $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
            $data = DB::table('formulir_triage_terintegrasi_v2_s')->where('id_dokumen', $dokumen->id)->first();
            $employee = null;
            if ($dokumen->id_verifikator > 1) {
                $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
            }

            $pdf = Pdf::loadView('erm.dokumen_kunjungan.pdf_triage_terintegrasi_v2', [
                'dokumen' => $dokumen,
                'layanan' => $layanan,
                'pasien' => $pasien,
                'data' => $data,
                'employee' => $employee
            ]);

            $path = '/var/www/html/casemix/files/shares/' . $dokumen->noreg;

            // Ensure the directory exists
            if (!file_exists($path)) {
                mkdir($path, 0777, true); // Create the directory if it doesn't exist
            }

            // Save the PDF in the specified directory
            $fileName = '27_' . $req->dokumen . '_formulir_triage_terintegrasi_v2.pdf';
            $pdf->save($path . '/' . $fileName);

            return redirect('e_rekam_medis/detail/formulir_triage_terintegrasi_v2?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function pdf_formulir_triage_terintegrasi_v2(Request $req, FormulirTriageTerintgrasiServiceV2 $ftts)
    {
        $data = $ftts->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_triage_terintegrasi_v2');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function formulir_layanan_kedokteran_fisik_dan_rehabilitasi(Request $req, FormulirLayananKedokteranFisikRehabilitasiService $ftts)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->first();
        $data['dokumen'] = $dokumen;
        $data['data'] = FormulirLayananKedokteranFisikRehabilitasi::where('id_dokumen', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        return view('erm.dokumen_kunjungan.formulir_layanan_kedokteran_fisik_dan_rehabilitasi', $data);
    }

    function save_formulir_layanan_kedokteran_fisik_dan_rehabilitasi(Request $req, FormulirLayananKedokteranFisikRehabilitasiService $ftts)
    {
        try {
            $data = FormulirLayananKedokteranFisikRehabilitasi::where('id_dokumen', $req->dokumen)->first();
            $lampiran_pptk = $data ? $data->lampiran_pptk : '';

            if ($req->hasFile('lampiran_pptk')) {
                $file = $req->file('lampiran_pptk');
                $tujuan_upload = 'lampiran_pptk';
                $lampiran_pptk = time() . $file->getClientOriginalName();
                $file->move($tujuan_upload, $lampiran_pptk);
            }

            FormulirLayananKedokteranFisikRehabilitasi::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'hubungan' => $req->hubungan ? $req->hubungan : '',
                'suami' => $req->suami ? $req->suami : '',
                'anak' => $req->anak ? $req->anak : '',
                'saksi_dua' => $req->saksi_dua ? $req->saksi_dua : '',
                'tanggal_pelayanan' => $req->tanggal_pelayanan ? $req->tanggal_pelayanan : '',
                'anamnesa' => $req->anamnesa ? $req->anamnesa : '',
                'pemeriksaan_fisik' => $req->pemeriksaan_fisik ? $req->pemeriksaan_fisik : '',
                'diagnosa_medis' => $req->diagnosa_medis ? $req->diagnosa_medis : '',
                'diagnosa_fungsi' => $req->diagnosa_fungsi ? $req->diagnosa_fungsi : '',
                'pemeriksaan_penunjang' => $req->pemeriksaan_penunjang ? $req->pemeriksaan_penunjang : '',
                'tata_laksana' => $req->tata_laksana ? $req->tata_laksana : '',
                'anjuran' => $req->anjuran ? $req->anjuran : '',
                'evaluasi' => $req->evaluasi ? $req->evaluasi : '',
                'tanggal_dokumen' => $req->tanggal_dokumen ? $req->tanggal_dokumen : ''
            ]);

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Berhasil update dokumen'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
        // try {
        //     $ftts->create($req);
        //     return redirect('e_rekam_medis/detail/formulir_layanan_kedokteran_fisik_dan_rehabilitasi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('gagal', $th->getMessage());
        // }
    }

    function pdf_formulir_layanan_kedokteran_fisik_dan_rehabilitasi(Request $req, FormulirLayananKedokteranFisikRehabilitasiService $ftts)
    {
        $data = $ftts->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_triage_terintegrasi_v2');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    {
        $data = $das->data($req);
        return view('erm.dokumen_kunjungan.dokumen_asesment_awal_medis_gawat_darurat', $data);
    }

    function save_dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    {
        try {
            $das->create($req);
            if (!is_null($req->signed)) {
                $das->save_gambar_lokasi_pengkajian_awal_medis($req);
            }
            return redirect('e_rekam_medis/detail/dokumen_asesment_awal_medis_gawat_darurat?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
            // return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function pdf_dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    {
        $data = $das->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_dokumen_asesment_awal_medis_gawat_darurat');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function hapus_status_lokalis_dokumen_asesment_awal_medis_gawat_darurat(Request $req)
    {
        try {
            $data = Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat::where('id_dokumen', $req->dokumen)->first();
            if ($data->gambar_status_lokalis != '') {
                unlink('status_lokalis/' . $data->gambar_status_lokalis);
            }
            Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat::where('id_dokumen', $req->dokumen)->update([
                'gambar_status_lokalis' => ''
            ]);
            return redirect('e_rekam_medis/detail/dokumen_asesment_awal_medis_gawat_darurat?dokumen=' . $req->dokumen)->with('success', 'Gambar status lokalis berhasil dihappus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function dokumen_asesment_awal_keperawatan_igd(Request $req, DokumenAsesmentAwalKeperawatanIgdService $das)
    {
        $data = $das->data($req);
        return view('erm.dokumen_kunjungan.dokumen_asesment_awal_keperawatan_igd', $data);
    }

    function save_dokumen_asesment_awal_keperawatan_igd(Request $req, DokumenAsesmentAwalKeperawatanIgdService $das)
    {
        try {
            $das->create($req);
            if (!is_null($req->signed)) {
                $das->save_gambar_lokasi_pengkajian_awal_medis($req);
            }
            return redirect('e_rekam_medis/detail/dokumen_asesment_awal_keperawatan_igd?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function hapus_gambar_lokalis(Request $req)
    {
        try {
            if ($req->jenis_dokumen == "dokumen_asesment_awal_keperawatan_igd") {
                $data = Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd::where('id_dokumen', $req->dokumen)->first();
                if ($data->gambar_status_lokalis != '') {
                    unlink('status_lokalis/' . $data->gambar_status_lokalis);
                }
                Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd::where('id_dokumen', $req->dokumen)->update([
                    'gambar_status_lokalis' => ''
                ]);
            }
            return redirect('e_rekam_medis/detail/' . $req->jenis_dokumen . '?dokumen=' . $req->dokumen)->with('success', 'Gambar status lokalis berhasil dihappus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function pdf_dokumen_asesment_awal_keperawatan_igd(Request $req, DokumenAsesmentAwalKeperawatanIgdService $das)
    {
        $data = $das->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_dokumen_asesment_awal_keperawatan_igd');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function formulir_asesmen_awal_pasien_rawat_inap_dewasa(Request $req, FormulirAsesmenAwalPasienRawatInapDewasaService $service)
    {
        $data = $service->data($req);
        return view('erm.dokumen_kunjungan.formulir_asesmen_awal_pasien_rawat_inap_dewasa', $data);
    }

    function save_formulir_asesmen_awal_pasien_rawat_inap_dewasa(Request $req, FormulirAsesmenAwalPasienRawatInapDewasaService $service, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password != md5($req->pass)) {
                return redirect()->back()->with('failed', 'Password anda salah');
            }
            $service->create($req);
            $dks->verifikasi_dokumen($req);
            if (!is_null($req->signed)) {
                $service->save_gambar_lokasi_pengkajian_awal_medis($req);
            }
            return redirect('e_rekam_medis/detail/formulir_asesmen_awal_pasien_rawat_inap_dewasa?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function save_formulir_asesmen_awal_pasien_rawat_inap_dewasa2(Request $req, FormulirAsesmenAwalPasienRawatInapDewasaService $service)
    {
        try {
            if (Auth::user()->password != md5($req->pass)) {
                return redirect()->back()->with('failed', 'Password anda salah');
            }
            $service->create2($req);
            return redirect('e_rekam_medis/detail/formulir_asesmen_awal_pasien_rawat_inap_dewasa?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_catatan_perkembangan_pasien_terintegrasi(Request $req, ErmRajalService $ers)
    {
        try {
            // if (Auth::user()->password != md5($req->pass)) {
            //     return redirect()->back()->with('failed', 'Password anda salah');
            // }
            if ($req->jenis == 'dr') {
                if ($req->file('dokumen_penunjang')) {
                    $file = $req->file('dokumen_penunjang');
                    $format_diizinkan = ['pdf', 'png', 'jpg', 'jpeg'];
                    if (!in_array($file->getClientOriginalExtension(), $format_diizinkan)) {
                        return redirect()->back()->with('failed', 'Format filde dokumen penunjang eksternal (PDF,PNG,JPG, JPEG).');
                    }
                }
            }
            $ers->save_cppt($req);
            return redirect('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi?dokumen=' . $req->id)->with('success', 'Berhasil Update Dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function download_dokumen_penunjang_eksternal_cppt(Request $req)
    {
        $dokumen = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::where('id_dokumen', $req->dokumen)->first();
        return ResponseDownload::download(public_path('/file_dokumen_penunjang_eksternal/' . $dokumen->dokumen_penunjang));
    }

    function store_resep_formulir_asesemen_awal(Request $req, ResepService $rs)
    {
        try {
            $select = Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa::where('id', $req->id)->first();

            $update = $rs->store_by_id($req);

            if (!$update['status']) {
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => $update['message']
                ]);
            }

            if ($select->id_resep == 0) {
                Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa::where('id', $req->id)->update([
                    'id_resep' => $update['data']->id
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update resep',
                'code' => 200,
                // 'data' => $ers->data_cppt_ranap($req),
                'data' => Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa::with(['resep.detail'])->where('id', $req->id)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function lock_resep_formulir_asesemen_awal(Request $req, ResepService $rs)
    {
        try {
            $rs->lock($req);
            return response()->json([
                'code' => 200,
                'status' => true,
                'data' => Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa::with(['resep.detail'])->where('id', $req->id_formulir)->first(),
                'message' => 'Resep berhasil dilock'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function observasi_keperawatan_igd(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_observasi_keperawatan_igd')->where('id_dokumen', $dokumen->id)->get();
        foreach ($data as $key => $value) {
            $value->employee = SmisHrdEmployee::select('ttd')->where('nama', $value->nama_verifikator)->first();
        }
        return view('erm.rawat_jalan.dokumen_kunjungan.observasi_keperawatan_igd', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data
        ]);
    }

    function save_observasi_keperawatan_igd(Request $req)
    {
        try {
            $data = [
                'id_dokumen' => $req->dokumen,
                'tgl_tindakan' => $req->tgl_tindakan ? $req->tgl_tindakan : '',
                'tindakan' => $req->tindakan ? $req->tindakan : '',
            ];

            if (isset($req->id) || $req->id != "") {
                DB::table('smis_doc_observasi_keperawatan_igd')->where('id', $req->id)->update($data);
            } else {
                DB::table('smis_doc_observasi_keperawatan_igd')->insert($data);
            }

            return redirect('e_rekam_medis/detail/observasi_keperawatan_igd?dokumen=' . $req->dokumen)
                ->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verifikasi_observasi_keperawatan_igd(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $data = [
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname
                ];

                DB::table('smis_doc_observasi_keperawatan_igd')->where('id', $req->id)->update($data);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/observasi_keperawatan_igd?dokumen=' . $req->dokumen)
                    ->with('sukses', 'Berhasil verifikasi tindakan');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function hapus_observasi_keperawatan_igd(Request $req, $id)
    {
        try {
            DB::table('smis_doc_observasi_keperawatan_igd')->where('id', $id)->delete();
            return redirect()->back()->with('sukses', 'Berhasil hapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function penolakan_rawat_inap(Request $req, PenolakanRawatInapService $pris)
    {
        $data = $pris->data($req);
        return view('erm.dokumen_kunjungan.penolakan_ranap', $data);
    }

    function save_penolakan_rawat_inap(SmisDocPenolakanRawatInapRequest $req, PenolakanRawatInapService $pris)
    {
        try {
            $req->validate([
                'nama_kerabat' => 'required',
                'signature_kerabat' => 'required',
            ]);

            $image = $pris->upload_signature($req->signature_kerabat);
            $data = $pris->save(array_merge($req->all(), ['signature_kerabat' => $image]));

            return redirect('e_rekam_medis/detail/penolakan_rawat_inap?dokumen=' . $req->id_dokumen ?? $data->id_dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verif_penolakan_rawat_inap(Request $req, PenolakanRawatInapService $pris, DokumenKunjunganService $dks)
    {
        try {
            $req->validate([
                'dokumen' => 'required',
                'pass' => 'required',
            ]);

            if (md5($req->pass) != Auth::user()->password) {
                throw new \Exception('Verifikasi gagal, Password yang anda masukkan salah!');
            }

            $dks->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/penolakan_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verif_penolakan_rawat_inap2(Request $req, PenolakanRawatInapService $pris, DokumenKunjunganService $dks)
    {
        try {
            $req->validate([
                'dokumen' => 'required',
                'pass' => 'required',
            ]);

            if (md5($req->pass) != Auth::user()->password) {
                throw new \Exception('Verifikasi gagal, Password yang anda masukkan salah!');
            }

            $verif = SmisDocPenolakanRawatInap::where('id_dokumen', $req->dokumen)->update([
                'id_dokter' => Auth::user()->id,
                'nama_dokter' => Auth::user()->realname,
            ]);
            return redirect('e_rekam_medis/detail/penolakan_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function sign_penolakan_rawat_inap(Request $req, PenolakanRawatInapService $pris, DokumenKunjunganService $dks)
    {
        try {
            //            dd($req->all());
            $req->validate([
                'id_dokumen' => 'required',
                'nama_saksi' => 'string|nullable',
                'signature' => 'nullable',
            ]);

            $signature = [];
            if ($req->has('nama_saksi')) {
                $signature['nama_saksi'] = $req->nama_saksi;
                $signature['signature_saksi'] = $pris->upload_signature($req->signature);
            } else if ($req->has('id_dokter') && $req->has('nama_dokter')) {
                $signature['id_dokter'] = $req->id_dokter;
                $signature['nama_dokter'] = $req->nama_dokter;
                $signature['signature_dokter'] = $pris->upload_signature($req->signature);
            }

            if ($req->has('id_verifikator')) {
                $dks->verifikasi_dokumen($req);
            } else {
                $pris->save(array_merge($req->all(), $signature));
            }

            return redirect('e_rekam_medis/detail/penolakan_rawat_inap?dokumen=' . $req->id_dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function lembar_hasil_tindakan_uji_fungsi(Request $req, LembarHasilTindakanUjiFungsiService $lhts)
    {
        $data = $lhts->data($req);
        return view('erm.dokumen_kunjungan.lembar_hasil_tindakan_uji_fungsi', $data);
    }

    function save_lembar_hasil_tindakan_uji_fungsi(Request $req, DokumenKunjunganService $dks, LembarHasilTindakanUjiFungsiService $lhts)
    {
        try {
            if (Auth::user()->password == md5($req->password)) {
                $data = [
                    'lembar_hasil' => $req->lembar_hasil ?? $req->lembar_hasil,
                    'koding' => $req->koding ?? $req->koding,
                    'tanggal_pemeriksaan' => $req->tanggal_pemeriksaan ?? $req->tanggal_pemeriksaan,
                    'diagnosis_fungsional' => $req->diagnosis_fungsional ?? $req->diagnosis_fungsional,
                    'diagnosis_medis' => $req->diagnosis_medis ?? $req->diagnosis_medis,
                    'hasil' => $req->hasil ?? $req->hasil,
                    'kesimpulan' => $req->kesimpulan ?? $req->kesimpulan,
                    'rekomendasi' => $req->rekomendasi ?? $req->rekomendasi
                ];

                $store = Smis_Doc_Lembar_Hasil_Tindakan_Uji_Fungsi::updateOrCreate([
                    'id_dokumen' => $req->dokumen
                ], $data);
                $verif = $dks->verifikasi_dokumen($req);
                if ($store && $verif) {
                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => 'Berhasil simpan dan verifikasi dokumen',
                        'data' => $lhts->data($req)
                    ]);
                } else {
                    if (!$store && !$verif) {
                        return response()->json([
                            'status' => false,
                            'code' => 500,
                            'message' => "Gagal simpan dan verifikasi dokumen"
                        ]);
                    } else if (!$store) {
                        return response()->json([
                            'status' => false,
                            'code' => 500,
                            'message' => "Gagal simpan dokumen"
                        ]);
                    } else if (!$verif) {
                        return response()->json([
                            'status' => false,
                            'code' => 500,
                            'message' => "Gagal verifikasi dokumen"
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => "Password yang Anda masukkan salah"
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function program_pelayanan_fisioterapi(Request $req, ProgramPelayananFisioterapiService $ppfs)
    {
        $data = $ppfs->data($req);
        return view('erm.dokumen_kunjungan.program_pelayanan_fisioterapi', $data);
    }

    function save_program_pelayanan_fisioterapi(Request $req, ProgramPelayananFisioterapiService $ppfs)
    {
        try {
            $ins = $ppfs->tambah_program($req);
            return redirect('e_rekam_medis/detail/program_pelayanan_fisioterapi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil Tambah Data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function ttd_petugas_program_pelayanan_fisioterapi(Request $req, ProgramPelayananFisioterapiService $ppfs)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $verif = $ppfs->verif_dokter($req);
                if ($verif) {
                    return redirect('e_rekam_medis/detail/program_pelayanan_fisioterapi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil Verifikasi Petugas');
                } else {
                    return redirect()->back()->with('gagal', 'Dokumen Gagal diverifikasi');
                }
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function ttd_pasien_program_pelayanan_fisioterapi(Request $req, ProgramPelayananFisioterapiService $ppfs)
    {
        try {
            $verif = $ppfs->ttd_pasien($req);
            if ($verif) {
                return redirect('e_rekam_medis/detail/program_pelayanan_fisioterapi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil Tanda Tangan Pasien');
            } else {
                return redirect()->back()->with('gagal', 'Dokumen Gagal ditanda tangani');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verif_program_pelayanan_fisioterapi(Request $req, ProgramPelayananFisioterapiService $ppfs)
    {
        try {
            $req->validate([
                'dokumen' => 'required',
                'pass' => 'required',
                'noreg_selesai' => 'required',
            ]);

            if (md5($req->pass) != Auth::user()->password) {
                throw new \Exception('Verifikasi gagal, Password yang anda masukkan salah!');
            }

            $ppfs->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/program_pelayanan_fisioterapi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function formulir_klaim_fisioterapi(Request $req, FormulirKlaimFisioterapiService $fkfs)
    {
        $data = $fkfs->data($req);
        return view('erm.dokumen_kunjungan.formulir_layanan_kedokteran_fisik_dan_rehabilitasi', $data);
    }

    function verifikasi_formulir_klaim_fisioterapi(Request $req, FormulirKlaimFisioterapiService $fkfs)
    {
        try {
            if (isset($req->password)) {
                if (Auth::user()->password != md5($req->password)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Password anda salah'
                    ]);
                }
            }

            $dokumen = $fkfs->store($req);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen',
                'data' => $dokumen
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function ttd_formulir_klaim_fisioterapi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            $dks->save_signature($req);
            return back()->with('sukses', 'Berhasil tanda tangan dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }
}
