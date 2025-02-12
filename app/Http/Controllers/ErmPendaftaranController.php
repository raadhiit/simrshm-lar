<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanEdukasiRequest;
use App\Http\Requests\GeneralConsentRequest;
use App\Http\Requests\SuratPernyataanPenitipanKelasRequest;
use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Bukti_Pendaftaran_Rawat_Inap;
use App\Models\DokumenKunjungan\Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan;
use App\Models\ERekamMedis;
use App\Models\Patient;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisHrdEmployee;
use App\Models\User;
use App\Services\CatatanEdukasiService;
use App\Services\DokumenKunjungan\BuktiPendaftaranRawatInapService;
use App\Services\DokumenKunjungan\TataTertibDanPeraturanPelayananRawatInapService;
use App\Services\DokumenKunjungan\BuktiPendaftaranRawatJalanService;
use App\Services\DokumenKunjunganService;
use App\Services\ErmPendaftaranService;
use App\Services\GeneralConsentService;
use App\Services\SuratPernyataanPenitipanKelasService;
use App\Services\SuratPernyataanPulangApsService;
use App\Services\SuratPernyataanNaikKelasService;
use iio\libmergepdf\Merger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ErmPendaftaranController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'e_rekam_medis')) {
                $arr = (array) $menu->e_rekam_medis;
                if ($arr['pendaftaran'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function ajax_filter_data(Request $req)
    {
        $query = SMIS_LayananPasien::select('no_kunjungan', 'nama_dokter', 'last_nama_ruangan', 'nama_pasien', 'nrm', 'nobpjs', 'selesai')
            ->where('uri', 0);
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
        return view('erm.pendaftaran.index');
    }

    function detail(Request $req)
    {
        $data['pasien'] = Patient::where('id', $req->nrm)->first();
        $data['dokumen'] = ERekamMedis::where('nrm', $req->nrm)->first();

        $query_history = SMIS_LayananPasien::select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.nama_pasien',
            );
        $query_history->where('smis_rg_layananpasien.nrm', $req->nrm);
        $data['layanan'] = $query_history->orderBy('tanggal', 'desc')->first();

        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();

//        dd($data);
        return view('erm.pendaftaran.detail', $data);
    }

    function show_dokumen(Request $req, ErmPendaftaranService $eps)
    {
        $data = $eps->data_identitas_pasien($req);
        return view('erm.pendaftaran.show', $data);
    }

    function pdf_identitas(Request $req, ErmPendaftaranService $eps)
    {
        try {
            $data = $eps->data_identitas_pasien($req);
            $contents = $this->pdf($data, 'erm.pendaftaran.pdf_identitas');
            return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    function verifikasi_petugas(Request $req, ErmPendaftaranService $eps)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $sts = $eps->verifikasi($req);
                if ($sts) {
                    return redirect('e_rekam_medis/pendaftaran/detail/show_dokumen?dokumen=' . $req->dokumen)->with('sukses', 'Dokumen berhasil diverifikasi');
                } else {
                    return redirect()->back()->with('gagal', 'Input data persetujuan gagal');
                }
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function upload_signature_pasien(Request $req, ErmPendaftaranService $eps)
    {
        try {
            $eps->upload_signature($req);
            return back()->with('sukses', 'successfull upload signature');
        } catch (\Throwable $th) {
            return back()->with('gagal', $th->getMessage());
        }
    }

    function general_consent(Request $req, GeneralConsentService $gcs)
    {
        $data = $gcs->data($req);
        return view('erm.dokumen_kunjungan.general_consent', $data);
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
            return redirect('e_rekam_medis/detail/general_consent?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verifikasi_dokumen_kunjungan(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $dks->verifikasi_dokumen($req);
                //                return redirect('e_rekam_medis/detail/general_consent?dokumen=' . $req->dokumen)
                //                    ->with('sukses', 'Dokumen berhasil diverifikasi');
                return back()
                    ->with('sukses', 'Dokumen berhasil diverifikasi');
            }

            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_ttd_general_consent(Request $req, DokumenKunjunganService $dks)
    {
        try {
            $dks->save_signature($req);
            return back()->with('sukses', 'Berhasil tanda tangan dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function catatan_edukasi_pasien(Request $req, CatatanEdukasiService $ces)
    {
        $data = $ces->data($req);
        return view('erm.dokumen_kunjungan.catatan_edukasi_pasien', $data);
    }

    function pdf_catatan_edukasi(Request $req, CatatanEdukasiService $ces)
    {
        $data = $ces->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_catatan_edukasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function save_catatan_edukasi(Request $req, CatatanEdukasiService $ces)
    {
        if($req->jenis_verifikasi == 'petugas'){
            if (Auth::user()->password != md5($req->password)) {
                return redirect()->back()->with('gagal', 'Password anda salah');
            }
        }

        try {
            $ins = $ces->create($req);
            if ($ins['status']) {
                return redirect('e_rekam_medis/detail/catatan_edukasi_pasien?dokumen=' . $req->dokumen)
                ->with('sukses', 'Berhasil simpan data');
            }
            return redirect()->back()->with('gagal', $ins['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function surat_pernyataan_penitipan_kelas(Request $req, SuratPernyataanPenitipanKelasService $spService)
    {
        $data = $spService->data($req);
        return view('erm.dokumen_kunjungan.surat_pernyataan_penitipan_kelas', $data);
    }

    function save_surat_pernyataan_penitipan_kelas(SuratPernyataanPenitipanKelasRequest $req, SuratPernyataanPenitipanKelasService $spService)
    {
        try {
            $spService->save($req);
            return redirect('e_rekam_medis/detail/surat_pernyataan_penitipan_kelas?dokumen=' . $req->dokumen ?? $req->id_dokumen)
                ->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function sign_surat_pernyataan_penitipan_kelas(Request $req, SuratPernyataanPenitipanKelasService $spService)
    {
        try {
            // validate
            $req->validate([
                'id_dokumen' => 'required|integer',
                'nama_kerabat' => 'string',
                'nama_saksi' => 'string',
                'signature' => 'required',
            ]);

            $image_path = $spService->upload_signature("$req->signature");
            $data = ['id_dokumen' => $req->id_dokumen];

            if ($req->nama_kerabat) {
                $data['nama_kerabat'] = $req->nama_kerabat;
                $data['signature_kerabat'] = $image_path;
            } else if ($req->nama_saksi) {
                $data['nama_saksi'] = $req->nama_saksi;
                $data['signature_saksi'] = $image_path;
            } else {
                throw new \Exception('Nama kerabat atau saksi tidak boleh kosong');
            }

            $spService->save($data);
            return redirect('e_rekam_medis/detail/surat_pernyataan_penitipan_kelas?dokumen=' . $req->id_dokumen)
                ->with('sukses', 'Berhasil verifikasi data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function verif_surat_pernyataan_penitipan_kelas(SuratPernyataanPenitipanKelasRequest $req, SuratPernyataanPenitipanKelasService $spService, DokumenKunjunganService $dks)
    {
        DB::beginTransaction();
        try {
            // validate
            $req->validate([
                'pass' => 'required|string',
            ]);

            if (md5($req->pass) != Auth::user()->password) {
                throw new \Exception('Verifikasi gagal, Password yang anda masukkan salah!');
            }

            $dks->verifikasi_dokumen($req);
            $spService->save($req);
            DB::commit();
            return redirect('e_rekam_medis/detail/surat_pernyataan_penitipan_kelas?dokumen=' . $req->id_dokumen)
                ->with('sukses', 'Data berhasil diverifikasi dan disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function formulir_surat_pernyataan_rawat_inap(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_formulir_surat_pernyataan_rawat_inap')->where('id_dokumen', $dokumen->id)->first();
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        } else {
            $employee = SmisHrdEmployee::where('nama', Auth::user()->realname)->first();
        }
        return view('erm.pendaftaran.formulir_sp_ranap', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee
        ]);
    }

    function save_formulir_surat_pernyataan_rawat_inap(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                DB::table('smis_doc_formulir_surat_pernyataan_rawat_inap')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'nama' => $req->nama ? $req->nama : '',
                    'umur' => $req->umur ? $req->umur : '',
                    'alamat' => $req->alamat ? $req->alamat : '',
                    'no_ktp' => $req->no_ktp ? $req->no_ktp : '',
                    'hubungan' => $req->hubungan ? $req->hubungan : '',
                    'ket_lain_lain' => $req->ket_lain_lain ? $req->ket_lain_lain : '',
                    'nama_wali' => $req->nama_wali ? $req->nama_wali : '',
                    'umur_wali' => $req->umur_wali ? $req->umur_wali : '',
                    'alamat_wali' => $req->alamat_wali ? $req->alamat_wali : '',
                    'no_ktp_wali' => $req->no_ktp_wali ? $req->no_ktp_wali : '',
                    'tgl_dokumen' => $req->tgl_dokumen ? $req->tgl_dokumen : '',
                ]);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/formulir_surat_pernyataan_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_ttd_formulir_surat_pernyataan_rawat_inap(Request $req)
    {
        try {
            $folderPath = public_path('signature_patient/');

            $image_parts = explode(";base64,", $req->signed);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            if ($req->status == "petugas") {
                $val = [
                    'ttd_petugas' => $fileName,
                    'nama_petugas' => $req->nama_pasien
                ];
            } else if ($req->status == "saksi") {
                $val = [
                    'ttd_saksi' => $fileName,
                    'nama_saksi' => $req->nama_pasien
                ];
            }

            DB::table('smis_doc_formulir_surat_pernyataan_rawat_inap')->where('id_dokumen', $req->dokumen)->update($val);
            return back()->with('sukses', 'Berhasil tanda tangan dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function bukti_pendaftaran_rawat_inap(Request $req, BuktiPendaftaranRawatInapService $service)
    {
        $data = $service->data($req);
        return view('erm.dokumen_kunjungan.bukti_pendaftaran_rawat_inap', $data);
    }

    function bukti_pendaftaran_rawat_inap_store(Request $req, BuktiPendaftaranRawatInapService $service, DokumenKunjunganService $dks)
    {
        try {

            if (md5($req->password) != Auth::user()->password) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password anda salah',
                ]);
            }

            $service->store($req);

            $dks->verifikasi_dokumen($req);

            $dokumen = DokumenKunjungan::where('id', $req->dokumen)->first();
            $user = User::where('id', $dokumen->id_verifikator)->where('prop', '')->first();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil verifikasi dokumen',
                'dokumen' => DokumenKunjungan::where('id', $req->dokumen)->first(),
                'data' => Smis_Doc_Bukti_Pendaftaran_Rawat_Inap::where('id_dokumen', $req->dokumen)->first(),
                'employee' => SmisHrdEmployee::where('username', $user->username)->where('prop', '')->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function tata_tertib_dan_peraturan_pelayanan_rawat_inap(Request $req, TataTertibDanPeraturanPelayananRawatInapService $service)
    {
        $data = $service->data($req);
        return view('erm.dokumen_kunjungan.tata_tertib_dan_peraturan_pelayanan_rawat_inap', $data);
    }

    function tata_tertib_dan_peraturan_pelayanan_rawat_inap_signature(Request $req, TataTertibDanPeraturanPelayananRawatInapService $service)
    {
        try {
            $result = $service->tanda_tangan($req);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil tanda tangan dokumen',
                'data' => $result
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function tata_tertib_dan_peraturan_pelayanan_rawat_inap_verifikasi(Request $req, TataTertibDanPeraturanPelayananRawatInapService $service, DokumenKunjunganService $dks)
    {
        try {

            if (md5($req->password) != Auth::user()->password) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password anda salah',
                ]);
            }

            $service->verifikasi($req);

            $dks->verifikasi_dokumen($req);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil verifikasi dokumen',
                'data' => DokumenKunjungan::where('id', $req->dokumen)->first(),
                'employee' => SmisHrdEmployee::where('nama', Auth::user()->realname)->where('prop', '')->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function bukti_pendaftaran_rawat_jalan(Request $req, BuktiPendaftaranRawatJalanService $service)
    {
        $data = $service->data($req);
        return view('erm.dokumen_kunjungan.bukti_pendaftaran_rawat_jalan', $data);
    }

    function bukti_pendaftaran_rawat_jalan_store(Request $req, BuktiPendaftaranRawatJalanService $service, DokumenKunjunganService $dks)
    {
        try {
            $dokumen = DokumenKunjungan::where('id', $req->dokumen)->first();
            $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();

            if ($req->jenis_verif == 'tanda_tangan') {
                $result = $service->tanda_tangan($req);
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil tanda tangan dokumen',
                    'dokumen' => DokumenKunjungan::where('id', $req->dokumen)->first(),
                    'data' => Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::where('id_dokumen', $req->dokumen)->first(),
                    'employee' => SmisHrdEmployee::where('id', $layanan->id_dokter)->where('prop', '')->first()
                ]);
            } else if ($req->jenis_verif == 'verifikasi') {
                if (md5($req->password) != Auth::user()->password) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Password anda salah',
                    ]);
                }

                $service->verifikasi($req);

                $dks->verifikasi_dokumen($req);

                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil verifikasi dokumen',
                    'dokumen' => DokumenKunjungan::where('id', $req->dokumen)->first(),
                    'data' => Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan::where('id_dokumen', $req->dokumen)->first(),
                    'employee' => SmisHrdEmployee::where('id', $layanan->id_dokter)->where('prop', '')->first()
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
