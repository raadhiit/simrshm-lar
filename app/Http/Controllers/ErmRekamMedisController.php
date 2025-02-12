<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanPerkembanganPasienTerintegrasiRequest;
use App\Http\Requests\DokumenLaporanCaesarianRequest;
use App\Http\Requests\DokumenOrientasiPasienBaruRequest;
use App\Http\Requests\DokumenTransferPasienInternalRequest;
use App\Http\Requests\GeneralConsentRequest;
use App\Http\Requests\SuratPermintaanRawatInapRequest;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi;
use App\Models\Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd;
use App\Models\Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat;
use App\Models\Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mr_Tanda_Vital;
use App\Models\SmisDocFormulirKriteriaPasienKeluarIcu;
use App\Models\SmisDocFormulirKriteriaPasienMasukIcu;
use App\Models\SmisDocRenpra;
use App\Models\SmisHrdEmployee;
use App\Services\AsesmentMedisAwalService;
use App\Services\CatatanEdukasiService;
use App\Services\CatatanPerkembanganPasienTerintegrasiService;
use App\Services\DokumenAsesmentAwalKeperawatanIgdService;
use App\Services\DokumenAsesmentAwalMedisGawatDaruratService;
use App\Services\DokumenKunjunganService;
use App\Services\DokumenLaporanCaesarianService;
use App\Services\DokumenOrientasiPasienBaruService;
use App\Services\DokumenTransferPasienInternalService;
use App\Services\ErmRajalService;
use App\Services\ErmRanapService;
use App\Services\FormulirTriageTerintegrasiService;
use App\Services\GeneralConsentService;
use App\Services\PersetujuanPenolakanTindakanKedokteranService;
use App\Services\RenpraService;
use App\Services\ResumeMedisPasienPulangService;
use App\Services\SuratPermintaanRawatInapService;
use Carbon\Carbon;
use iio\libmergepdf\Merger;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PDF;
use Symfony\Component\Console\Input\Input;
use Response as ResponseDownload;

class ErmRekamMedisController extends Controller
{
    function index(Request $req)
    {
        return view('erm.rekam_medis.index');
    }

    function verifikasi_dokumen_kunjungan(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $dks->verifikasi_dokumen($req);
                return back()->with('sukses', 'Dokumen berhasil diverifikasi');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_ttd_dokumen_kunjungan(Request $req, DokumenKunjunganService $dks)
    {
        try {
            $dks->save_signature($req);
            return back()->with('sukses', 'Berhasil tanda tangan dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
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

    //CATATAN EDUKASI PASIEN
    function catatan_edukasi_pasien(Request $req, CatatanEdukasiService $ces)
    {
        $data = $ces->data($req);
        return view('erm.rekam_medis.catatan_edukasi_pasien', $data);
    }

    function pdf_catatan_edukasi(Request $req, CatatanEdukasiService $ces)
    {
        $data = $ces->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_catatan_edukasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function save_catatan_edukasi(Request $req, CatatanEdukasiService $ces)
    {
        try {
            $ces->create($req);
            return redirect('e_rekam_medis/rekam_medis/catatan_edukasi_pasien?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    //GENERAL CONSENT
    function general_consent(Request $req, GeneralConsentService $gcs)
    {
        $data = $gcs->data($req);
        return view('erm.rekam_medis.general_consent', $data);
    }

    function pdf_general_consent(Request $req, GeneralConsentService $gcs)
    {
        $data = $gcs->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_persetujuan_umum');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function save_general_consent(GeneralConsentRequest $req, GeneralConsentService $gcs)
    {
        try {
            $gcs->create($req);
            return redirect('e_rekam_medis/rekam_medis/general_consent?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    //SURAT PERMINTAAN RAWAT INAP
    function surat_permintaan_rawat_inap(Request $req, SuratPermintaanRawatInapService $spris)
    {
        $data = $spris->data($req);
        return view('erm.rekam_medis.surat_permintaan_rawat_inap', $data);
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
            return redirect('e_rekam_medis/rekam_medis/surat_permintaan_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    //DOKUMEN TRANSFER PASIEN INTERNAL
    function dokumen_transfer_pasien_internal(Request $req, DokumenTransferPasienInternalService $dtpis)
    {
        $data = $dtpis->data($req);
        return view('erm.rekam_medis.dokumen_transfer_pasien_internal', $data);
    }

    function save_dokumen_transfer_pasien_internal(DokumenTransferPasienInternalRequest $req, DokumenTransferPasienInternalService $dtpis)
    {
        try {
            $dtpis->create($req);
            return redirect('e_rekam_medis/rekam_medis/dokumen_transfer_pasien_internal?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
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
                    return redirect('e_rekam_medis/rekam_medis/dokumen_transfer_pasien_internal?dokumen=' . $req->dokumen)->with('sukses', 'Dokumen berhasil diverifikasi');
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

    //DOKUMEN LAPORAN CAESARIAN
    function dokumen_laporan_caesarian(Request $req, DokumenLaporanCaesarianService $dlcs)
    {
        $data = $dlcs->data($req);
        return view('erm.rekam_medis.dokumen_laporan_caesarian', $data);
    }

    function save_dokumen_laporan_caesarian(Request $req, DokumenLaporanCaesarianService $dlcs)
    {
        try {
            $dlcs->create($req);
            return redirect('e_rekam_medis/rekam_medis/dokumen_laporan_caesarian?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
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

    //FORMULIR TRIAGE TERINTEGRASI
    function formulir_triage_terintegrasi(Request $req, FormulirTriageTerintegrasiService $ftts)
    {
        $data = $ftts->data($req);
        return view('erm.rekam_medis.formulir_triage_terintegrasi', $data);
    }

    function save_formulir_triage_terintegrasi(Request $req, FormulirTriageTerintegrasiService $ftts)
    {
        try {
            $ftts->create($req);
            return redirect('e_rekam_medis/rekam_medis/formulir_triage_terintegrasi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function pdf_formulir_triage_terintegrasi(Request $req, FormulirTriageTerintegrasiService $ftts)
    {
        $data = $ftts->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_formulir_triage_terintegrasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    //DOKUMEN ASESMENT AWAL KEPERAWATAN IGD
    function dokumen_asesment_awal_keperawatan_igd(Request $req, DokumenAsesmentAwalKeperawatanIgdService $das)
    {
        $data = $das->data($req);
        return view('erm.rekam_medis.dokumen_asesment_awal_keperawatan_igd', $data);
    }

    function save_dokumen_asesment_awal_keperawatan_igd(Request $req, DokumenAsesmentAwalKeperawatanIgdService $das)
    {
        try {
            $das->create($req);
            if (!is_null($req->signed)) {
                $das->save_gambar_lokasi_pengkajian_awal_medis($req);
            }
            return redirect('e_rekam_medis/rekam_medis/dokumen_asesment_awal_keperawatan_igd?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
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
            return redirect('e_rekam_medis/rekam_medis/' . $req->jenis_dokumen . '?dokumen=' . $req->dokumen)->with('success', 'Gambar status lokalis berhasil dihappus');
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

    //CATATAN PERKEMBANGAN PASIEN TERINTEGRASI
    function catatan_perkembangan_pasien_terintegrasi(Request $req, CatatanPerkembanganPasienTerintegrasiService $cppt)
    {
        $data = $cppt->data($req);
        return view('erm.rekam_medis.catatan_perkembangan_pasien_terintegrasi', $data);
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
            return redirect('e_rekam_medis/rekam_medis/catatan_perkembangan_pasien_terintegrasi?dokumen=' . $req->id)->with('success', 'Berhasil Verifikasi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function download_dokumen_penunjang_eksternal_cppt(Request $req)
    {
        $dokumen = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::where('id_dokumen', $req->dokumen)->first();
        return ResponseDownload::download(public_path('/file_dokumen_penunjang_eksternal/' . $dokumen->dokumen_penunjang));
    }

    function pdf_catatan_perkembangan_pasien_terintegrasi(Request $req, CatatanPerkembanganPasienTerintegrasiService $cppt)
    {
        $data = $cppt->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_catatan_perkembangan_pasien_terintegrasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    //DOKUMEN ORIENTASI PASIEN BARU
    function dokumen_orientasi_pasien_baru(Request $req, DokumenOrientasiPasienBaruService $das)
    {
        $data = $das->data($req);
        return view('erm.rekam_medis.dokumen_orientasi_pasien_baru', $data);
    }

    function save_dokumen_orientasi_pasien_baru(DokumenOrientasiPasienBaruRequest $req, DokumenOrientasiPasienBaruService $das)
    {
        try {
            $das->create($req);
            return redirect('e_rekam_medis/rekam_medis/dokumen_orientasi_pasien_baru?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function pdf_dokumen_orientasi_pasien_baru(Request $req, DokumenOrientasiPasienBaruService $das)
    {
        $data = $das->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_dokumen_orientasi_pasien_baru');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    public function rencana_keperawatan(RenpraService $svc)
    {
        $get_view_renpra = function ($name) {
            foreach (SmisDocRenpra::renpra() as $item) {
                if (isset($item['name']) && strtoupper($item['name']) == strtoupper($name)) {
                    return $item['view'];
                }
            }

            return null;
        };

        if (request()->method() == 'GET') {
            $data = $svc->data(request());
            $params = array_merge($data, []);

            $params['jenis_renpras'] = SmisDocRenpra::renpra();
            $params['get_view_renpra'] = $get_view_renpra;

            return view('erm.rawat_inap.renpra.index', $params);
        } else if (request()->method() == 'POST') {
            if (request()->has('add_renpra')) {
                request()->validate([
                    'id_dokumen' => 'required',
                    'nama_renpra' => 'required',
                ]);

                $renpra = new SmisDocRenpra();
                $renpra->id = time();
                $renpra->id_dokumen = request('id_dokumen');
                $renpra->nama_renpra = request('nama_renpra');
                $renpra->tanggal = Carbon::now();
                $renpra->created_at = Carbon::now();
                if ($view = $get_view_renpra(request('nama_renpra'))) {
                    if (request()->ajax()) {
                        if (view()->exists($view)) {
                            $view = view($view, ['renpra' => $renpra])->render();
                            return response($view);
                        } else {
                            $error = 'Modul Rencana Keperawatan (' . $renpra->nama_renpra . ') belum tersedia';
                            return response($error, 500);
                        }
                    } else {
                        $renpra->save();
                    }
                } else {
                    $error = 'Modul Rencana Keperawatan (' . $renpra->nama_renpra . ') belum tersedia';
                    if (request()->ajax()) {
                        return response($error, 500);
                    } else {
                        return redirect()->back()->withErrors(['nama_renpra' => $error]);
                    }
                }
            } else {
                $validator = Validator::make(request()->all(), [
                    'action' => 'required|in:save,verify',
                    'id_dokumen' => 'required_if:action,verify',
                    'nama_renpra' => 'required_if:action,verify',
                    'created_at' => 'required_if:action,verify',
                    'tanggal' => 'required_if:action,verify',
                    'password' => 'required_if:action,verify',
                ], [
                    'password.required_if' => 'Password harus diisi untuk verifikasi.',
                ]);

                if ($validator->fails() && request()->ajax()) {
                    return response($validator->errors()->first(), 422);
                }

                $verify = false;
                if (request('action') == 'verify') {
                    if (request()->has('password') && md5(request('password')) == auth()->user()->password) {
                        $verify = true;
                    } else {
                        if (request()->ajax()) {
                            return response('Password yang Anda masukkan tidak sesuai, silahkan coba lagi', 422);
                        }
                    }
                }

                try {
                    $tanggal = Carbon::createFromFormat('d/m/Y H:i', request('tanggal'));

                    $data = [
                        'tanggal' => $tanggal,
                        'diagnosa_keperawatan' => request('diagnosa_keperawatan'),
                        'do' => request('do'),
                        'ds' => request('ds'),
                        'lama_tindakan' => request('lama_tindakan'),
                        'kriteria_hasil' => request('kriteria_hasil'),
                        'intervensi' => request('intervensi'),
                        'jam' => request('jam'),
                        'implementasi' => request('implementasi'),
                    ];

                    if ($verify) {
                        $data['verifikator'] = auth()->user()->username;
                        $data['status'] = $verify;
                    }

                    DB::beginTransaction();

                    $renpra = SmisDocRenpra::updateOrCreate([
                        'id_dokumen' => request('id_dokumen'),
                        'nama_renpra' => request('nama_renpra'),
                        'created_at' => request('created_at'),
                    ], $data);

                    if ($verify) {
                        DokumenKunjungan::where('id', request('id_dokumen'))
                            ->update([
                                'status' => $verify,
                                'id_verifikator' => auth()->user()->id,
                                'nama_verifikator' => auth()->user()->realname ?? auth()->user()->username,
                                'tanggal_update' => Carbon::now()->toDateTimeString(),
                            ]);
                    }

                    DB::commit();

                    if (request()->ajax() && $view = $get_view_renpra(request('nama_renpra'))) {
                        $renpra = SmisDocRenpra::with('user_verifikator.hrd_employee')->findOrFail($renpra->id);
                        $view = view($view, ['renpra' => $renpra])->render();
                        return response($view);
                    }
                } catch (\Exception $ex) {
                    // dd($ex);
                    Log::error($ex->getMessage(), $ex->getTrace());
                    if (request()->ajax()) {
                        return response('Terjadi kesalahan, silahkan coba lagi.', 500);
                    }
                }
            }

            return redirect()->back();
        } else {
            abort(405);
        }
    }

    public function pdf_rencana_keperawatan()
    {
        // code
    }

    function asesmen_awal_kebidanan_rawat_inap(Request $req, ErmRanapService $ers)
    {
        $data = $ers->asesmen_awal_kebidanan_rawat_inap($req);
        return view('erm.rekam_medis.asesmen_awal_kebidanan_rawat_inap', $data);
    }

    function save_asesmen_awal_kebidanan_rawat_inap(Request $req, ErmRanapService $ers)
    {
        try {
            $ers->save_asesmen_awal_kebidanan_rawat_inap($req);
            return redirect('e_rekam_medis/rekam_medis/asesmen_awal_kebidanan_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    //RESUME MEDIS PASIEN PULANG
    function resume_medis_pasien_pulang(Request $req, ResumeMedisPasienPulangService $rmpp)
    {
        $data = $rmpp->data($req);
        return view('erm.rekam_medis.resume_medis_pasien_pulang', $data);
    }

    function save_resume_medis_pasien_pulang(Request $req, ResumeMedisPasienPulangService $rmpp)
    {
        try {
            $rmpp->create($req);
            return redirect('e_rekam_medis/rekam_medis/resume_medis_pasien_pulang?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function pdf_resume_medis_pasien_pulang(Request $req, ResumeMedisPasienPulangService $rmpp)
    {
        $data = $rmpp->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_resume_medis_pasien_pulang');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    //ASESMEN AWAL PASIEN RAWAT INAP DEWASA
    function formulir_asesmen_awal_pasien_rawat_inap_dewasa(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    {
        $data = $das->data($req);
        return view('erm.rekam_medis.formulir_asesmen_awal_pasien_rawat_inap_dewasa', $data);
    }

    // function save_dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    // {
    //     try {
    //         $das->create($req);
    //         if (!is_null($req->signed)) {
    //             $das->save_gambar_lokasi_pengkajian_awal_medis($req);
    //         }
    //         return redirect('e_rekam_medis/rekam_medis/formulir_asesmen_awal_pasien_rawat_inap_dewasa?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
    //     }
    // }

    // function pdf_dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    // {
    //     $data = $das->data($req);
    //     $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_formulir_asesmen_awal_pasien_rawat_inap_dewasa');
    //     return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    // }

    //FORMULIR KRITERIA PASIEN KELUAR MASUK ICU
    public function formulir_kriteria_pasien_masuk_icu()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi', 'tanda_vital'])
                ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
                ->select(
                    'smis_rg_patient.telpon',
                    'smis_rg_patient.nama',
                    'smis_rg_patient.tgl_lahir',
                    'smis_rg_patient.kelamin',
                    'smis_rg_patient.alamat',
                    'smis_rg_patient.rt',
                    'smis_rg_patient.rw',
                    'smis_rg_patient.nama_kelurahan',
                    'smis_rg_patient.nama_kecamatan',
                    'smis_rg_patient.nama_kabupaten',
                    'smis_rg_layananpasien.id',
                    'smis_rg_layananpasien.nrm',
                    'smis_rg_patient.ktp',
                    'smis_rg_layananpasien.umur',
                    'smis_rg_layananpasien.carabayar',
                    'smis_rg_layananpasien.nama_pasien',
                    'smis_rg_layananpasien.last_nama_ruangan',
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $data['dokter_yang_merawat'] = SmisHrdEmployee::where('jabatan', 1)->get();
            $data['dokter_konsulant_icu'] = SmisHrdEmployee::where('jabatan', 1)->get();
            $data['data'] = SmisDocFormulirKriteriaPasienMasukIcu::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocFormulirKriteriaPasienMasukIcu();
            $data['tanda_vital'] = Smis_Mr_Tanda_Vital::find($data['data']->id_ttv) ?? new Smis_Mr_Tanda_Vital();
            $data['ruangan'] = DB::table('smis_adm_prototype')->where(function ($q) {
                $q->where('jenis_ruangan', 'URI')->orWhere('jenis_ruangan', 'URJI');
            })->where('prop', '')->get();
            return view('erm.rawat_inap.formulir_kriteria_pasien_masuk_icu', $data);
        } else if (request()->isMethod('POST')) {
            request()->validate([
                "action" => "required|in:Simpan,Verifikasi",
                // "diagnosa" => "required_if:action,Verifikasi",
                // "tanggal" => "required_if:action,Verifikasi",
                // "prioritas1" => "required_if:action,Verifikasi|array",
                // "prioritas2" => "required_if:action,Verifikasi",
                // "prioritas3" => "required_if:action,Verifikasi",
                // "prioritas4" => "required_if:action,Verifikasi|array",
                // "etc" => "array",
                // "id_dokter_yang_merawat" => "required_if:action,Verifikasi",
                // "id_dokter_konsulant_icu" => "required_if:action,Verifikasi",
                // "dokumen" => "required_if:action,Verifikasi",
                // "password" => "required_if:action,Verifikasi",
            ]);
            $tanggal = Carbon::createFromFormat('d/m/Y', request('tanggal'))->toDateString();

            if (strtolower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            if (strtolower(request('action')) == 'verifikasi' && SmisDocFormulirKriteriaPasienMasukIcu::where('id_dokumen', request('dokumen'))->where('status', true)->exists()) {
                DokumenKunjungan::updateOrCreate([
                    'id' => request('dokumen'),
                ], [
                    'status' => true,
                    'id_verifikator' => auth()->user()->id,
                    'nama_verifikator' => auth()->user()->realname,
                ]);
            } else {
                $update = [
                    "tanggal" => $tanggal,
                    "ruangan" => request("ruangan"),
                    "diagnosa" => request("diagnosa"),
                    "prioritas1" => request("prioritas1"),
                    "prioritas2" => request("prioritas2"),
                    "prioritas3" => request("prioritas3"),
                    "prioritas4" => request("prioritas4"),
                    "id_ttv" => request("id_ttv"),
                    "etc" => request("etc"),
                    "id_dokter_yang_merawat" => request("id_dokter_yang_merawat"),
                    "id_dokter_konsulant_icu" => request("id_dokter_konsulant_icu"),
                ];
                if (strtolower(request('action')) == 'verifikasi') {
                    $update["status"] = true;
                    $update["id_verifikator"] = auth()->user()->id;
                    $update["nama_verifikator"] = auth()->user()->realname;
                    DokumenKunjungan::updateOrCreate([
                        'id' => request('dokumen'),
                    ], [
                        'status' => true,
                        'id_verifikator' => auth()->user()->id,
                        'nama_verifikator' => auth()->user()->realname,
                    ]);
                }
                if (request('tensi') !== null || request('nadi') !== null || request('suhu') !== null || request('berat_badan') !== null || request('rr') !== null) {
                    $ttv = Smis_Mr_Tanda_Vital::updateOrCreate([
                        'id' => request("id_ttv")
                    ], [
                        'ruangan' => "masuk_icu",
                        'nrm_pasien' => request("nrm"),
                        'noreg_pasien' => request("noreg"),
                        'nama_pasien' => request("nama_pasien"),
                        'tensi' => request("tensi"),
                        'nadi' => request("nadi"),
                        'suhu' => request("suhu"),
                        'berat_badan' => request("berat_badan"),
                        'rr' => request("rr"),
                    ]);
                    $update["id_ttv"] = $ttv->id;
                }
                SmisDocFormulirKriteriaPasienMasukIcu::updateOrCreate([
                    'id_dokumen' => request('dokumen'),
                ], $update);
            }

            return redirect()->back()->with('message', strtolower(request('action')) == 'verifikasi' ? 'Dokumen berhasil diverifikasi.' : 'Dokumen berhasil disimpan.');
        } else {
            abort(405);
        }
    }

    public function formulir_kriteria_pasien_keluar_icu()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi', 'tanda_vital'])
                ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
                ->select(
                    'smis_rg_patient.telpon',
                    'smis_rg_patient.nama',
                    'smis_rg_patient.tgl_lahir',
                    'smis_rg_patient.kelamin',
                    'smis_rg_patient.alamat',
                    'smis_rg_patient.rt',
                    'smis_rg_patient.rw',
                    'smis_rg_patient.nama_kelurahan',
                    'smis_rg_patient.nama_kecamatan',
                    'smis_rg_patient.nama_kabupaten',
                    'smis_rg_layananpasien.id',
                    'smis_rg_layananpasien.nrm',
                    'smis_rg_patient.ktp',
                    'smis_rg_layananpasien.umur',
                    'smis_rg_layananpasien.carabayar',
                    'smis_rg_layananpasien.nama_pasien',
                    'smis_rg_layananpasien.last_nama_ruangan',
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $data['dokter_yang_merawat'] = SmisHrdEmployee::where('jabatan', 1)->get();
            $data['dokter_konsulant_icu'] = SmisHrdEmployee::where('jabatan', 1)->get();
            $data['data'] = SmisDocFormulirKriteriaPasienKeluarIcu::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocFormulirKriteriaPasienKeluarIcu();
            $data['tanda_vital'] = Smis_Mr_Tanda_Vital::find($data['data']->id_ttv) ?? new Smis_Mr_Tanda_Vital();
            $data['ruangan'] = DB::table('smis_adm_prototype')->where(function ($q) {
                $q->where('jenis_ruangan', 'URI')->orWhere('jenis_ruangan', 'URJI');
            })->where('prop', '')->get();
            return view('erm.rawat_inap.formulir_kriteria_pasien_keluar_icu', $data);
        } else if (request()->isMethod('POST')) {
            request()->validate([
                "action" => "required|in:Simpan,Verifikasi",
                // "diagnosa" => "required_if:action,Verifikasi",
                // "tanggal" => "required_if:action,Verifikasi",
                // "no1" => "required_if:action,Verifikasi",
                // "no2" => "required_if:action,Verifikasi",
                // "no4" => "required_if:action,Verifikasi",
                // "etcNo1" => "array",
                // "etcNo3" => "array",
                // "id_dokter_yang_merawat" => "required_if:action,Verifikasi",
                // "id_dokter_konsulant_icu" => "required_if:action,Verifikasi",
                // "dokumen" => "required_if:action,Verifikasi",
                // "password" => "required_if:action,Verifikasi",
            ]);
            $tanggal = Carbon::createFromFormat('d/m/Y', request('tanggal'))->toDateString();

            if (strtolower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            if (strtolower(request('action')) == 'verifikasi' && SmisDocFormulirKriteriaPasienKeluarIcu::where('id_dokumen', request('dokumen'))->where('status', true)->exists()) {
                DokumenKunjungan::updateOrCreate([
                    'id' => request('dokumen'),
                ], [
                    'status' => true,
                    'id_verifikator' => auth()->user()->id,
                    'nama_verifikator' => auth()->user()->realname,
                ]);
            } else {
                $update = [
                    "tanggal" => $tanggal,
                    "ruangan" => request("ruangan"),
                    "diagnosa" => request("diagnosa"),
                    "no1" => request("no1"),
                    "no2" => request("no2"),
                    "no3" => request("no3"),
                    "no4" => request("no4"),
                    "etcNo1" => request("etcNo1"),
                    "etcNo4" => request("etcNo4"),
                    "id_dokter_yang_merawat" => request("id_dokter_yang_merawat"),
                    "id_dokter_konsulant_icu" => request("id_dokter_konsulant_icu"),
                ];
                if (strtolower(request('action')) == 'verifikasi') {
                    $update["status"] = true;
                    $update["id_verifikator"] = auth()->user()->id;
                    $update["nama_verifikator"] = auth()->user()->realname;
                    DokumenKunjungan::updateOrCreate([
                        'id' => request('dokumen'),
                    ], [
                        'status' => true,
                        'id_verifikator' => auth()->user()->id,
                        'nama_verifikator' => auth()->user()->realname,
                    ]);
                }
                if (request('tensi') !== null || request('nadi') !== null || request('suhu') !== null || request('berat_badan') !== null || request('rr') !== null) {
                    $ttv = Smis_Mr_Tanda_Vital::updateOrCreate([
                        'id' => request("id_ttv")
                    ], [
                        'ruangan' => "keluar_icu",
                        'nrm_pasien' => request("nrm"),
                        'noreg_pasien' => request("noreg"),
                        'nama_pasien' => request("nama_pasien"),
                        'tensi' => request("tensi"),
                        'nadi' => request("nadi"),
                        'suhu' => request("suhu"),
                        'berat_badan' => request("berat_badan"),
                        'rr' => request("rr"),
                    ]);
                    $update["id_ttv"] = $ttv->id;
                }
                SmisDocFormulirKriteriaPasienKeluarIcu::updateOrCreate([
                    'id_dokumen' => request('dokumen'),
                ], $update);
            }

            return redirect()->back()->with('message', strtolower(request('action')) == 'verifikasi' ? 'Dokumen berhasil diverifikasi.' : 'Dokumen berhasil disimpan.');
        } else {
            abort(405);
        }
    }
    public function pdf_formulir_kriteria_pasien_keluar_icu()
    {
        if (!request()->has('dokumen')) abort(404);
        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
            ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
            ->firstOrFail();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi', 'tanda_vital'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select(
                'smis_rg_patient.telpon',
                'smis_rg_patient.nama',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat',
                'smis_rg_patient.rt',
                'smis_rg_patient.rw',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_patient.ktp',
                'smis_rg_layananpasien.umur',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.last_nama_ruangan',
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['dokter_yang_merawat'] = SmisHrdEmployee::where('jabatan', 1)->get();
        $data['dokter_konsulant_icu'] = SmisHrdEmployee::where('jabatan', 1)->get();
        $data['data'] = SmisDocFormulirKriteriaPasienKeluarIcu::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocFormulirKriteriaPasienKeluarIcu();
        $data['tanda_vital'] = Smis_Mr_Tanda_Vital::find($data['data']->id_ttv) ?? new Smis_Mr_Tanda_Vital();
        $contents = $this->pdf($data, 'erm.rawat_inap.formulir_kriteria_pasien_keluar_icu_pdf');
        return response($contents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . request('dokumen') . ' Formulir Kriteria Pasien Keluar ICU.pdf"',
        ]);
    }


    public function pdf_formulir_kriteria_pasien_masuk_icu()
    {
        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
            ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
            ->firstOrFail();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi', 'tanda_vital'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select(
                'smis_rg_patient.telpon',
                'smis_rg_patient.nama',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat',
                'smis_rg_patient.rt',
                'smis_rg_patient.rw',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_patient.ktp',
                'smis_rg_layananpasien.umur',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.last_nama_ruangan',
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['dokter_yang_merawat'] = SmisHrdEmployee::where('jabatan', 1)->get();
        $data['dokter_konsulant_icu'] = SmisHrdEmployee::where('jabatan', 1)->get();
        $data['data'] = SmisDocFormulirKriteriaPasienMasukIcu::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocFormulirKriteriaPasienMasukIcu();
        $data['tanda_vital'] = Smis_Mr_Tanda_Vital::find($data['data']->id_ttv) ?? new Smis_Mr_Tanda_Vital();
        $contents = $this->pdf($data, 'erm.rawat_inap.formulir_kriteria_pasien_masuk_icu_pdf');
        return response($contents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . request('dokumen') . ' Formulir Kriteria Pasien Masuk ICU.pdf"',
        ]);
    }

    //ASESMEN AWAL PASIEN RAWAT INAP NEONATUS
    function asesmen_awal_pasien_rawat_inap_neonatus(Request $req, ErmRanapService $ers)
    {
        $data = $ers->data_asesmen_awal_pasien_ranap_neonatus($req);
        return view('erm.rekam_medis.asesmen_awal_pasien_rawat_inap_neonatus', $data);
    }

    //ASESMENT MEDIS AWAL RAWAT JALAN
    function asesment_medis_awal(Request $req, AsesmentMedisAwalService $amas)
    {
        $data = $amas->data($req);
        return view('erm.rekam_medis.asesment_medis_awal', $data);
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
            return redirect('e_rekam_medis/rekam_medis/asesment_medis_awal_rawat_jalan?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    //DOKUMEN ASESMENT AWAL MEDIS GAWAT DARURAT
    function dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    {
        $data = $das->data($req);
        return view('erm.rekam_medis.dokumen_asesment_awal_medis_gawat_darurat', $data);
    }

    function save_dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    {
        try {
            $das->create($req);
            if (!is_null($req->signed)) {
                $das->save_gambar_lokasi_pengkajian_awal_medis($req);
            }
            return redirect('e_rekam_medis/rekam_medis/dokumen_asesment_awal_medis_gawat_darurat?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function pdf_dokumen_asesment_awal_medis_gawat_darurat(Request $req, DokumenAsesmentAwalMedisGawatDaruratService $das)
    {
        $data = $das->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_dokumen_asesment_awal_medis_gawat_darurat');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function upload_dokumen_kunjungan(Request $req, DokumenKunjunganService $dks)
    {
        if (is_null($req->dokumen)) {
            return response()->json([
                'status' => false,
                'message' => 'Tambahkan dokumen dahulu'
            ]);
        }
        try {
            $dks->upload_dokumen_kunjungan($req);
            return response()->json([
                'status' => true,
                'message' => 'Dokumen berhasil diupload'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function download_dokumen_kunjungan(Request $req)
    {
        $data = DokumenKunjungan::where('id', $req->dokumen)->first();

        if ($data->path_dokumen == '') {
            return redirect()->back()->with('gagal', 'Dokumen belum diupload');
        }

        $file = public_path() . "/dokumen_kunjungan/" . $data->path_dokumen;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return ResponseDownload::download($file, $data->path_dokumen, $headers);
    }
}
