<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanPerkembanganPasienTerintegrasiRequest;
use App\Http\Requests\DokumenOrientasiPasienBaruRequest;
use App\Http\Requests\IndikatorScRequest;
use App\Http\Requests\ResumeMedisPasienPulangRequest;
use App\Http\Requests\SmisDocPermintaanPemeriksaanPatologiAnatomiRequest;
use App\Http\Requests\SuratPernyataanPenitipanKelasRequest;
use App\Http\Requests\SmisDocSuratPernyataanPulangApsRequest;
use App\Http\Requests\SuratPernyataanNaikKelasRequest;
use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Daftar_Kontrol_Istimewa_Pasien_Dm;
use App\Models\DokumenKunjungan\Smis_Doc_Daftar_Pemberian_Obat;
use App\Models\DokumenKunjungan\Smis_Doc_Lembar_Konsultasi;
use App\Models\DokumenKunjungan\Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah;
use App\Models\DokumenKunjungan\Smis_Doc_Survei_Infeksi_Rumah_Sakit;
use App\Models\Smis_Doc_Asesment_Praanestesi_Sedasi;
use App\Models\Smis_Doc_Reasesmen_Resiko_Jatuh;
use App\Models\Smis_Doc_Reasesmen_Resiko_Jatuh_Detail;
use App\Models\SMIS_Diagnosa;
use App\Models\Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus;
use App\Models\Smis_Doc_Formulir_Skrining_Awal_Gizi_Dewasa;
use App\Models\Smis_Doc_Laporan_Pembedahan;
use App\Models\Smis_Doc_Surat_Pengantar_Persiapan_Tindakan_Operasi;
use App\Models\Smis_Doc_Observasi_Bayi;
use App\Models\Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran;
use App\Models\Smis_doc_skala_risiko_jatuh_humpty_dumpty_untuk_pediatri;
use App\Models\Smis_Doc_Surat_Pernyataan_Naik_Kelas;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SmisDocFormulirKriteriaPasienMasukIcu;
use App\Models\SmisDocFormulirKriteriaPasienKeluarIcu;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Mr_Tanda_Vital;
use App\Models\Smis_Rad_Layanan;
use App\Models\Smis_Rad_Pesanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisDocAssesmentUlangNyeriIntervensi;
use App\Models\SmisDocAssesmentPerioperatifMedis;
use App\Models\SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap;
use App\Models\SmisDocChecklistKeselamatanPasienOperasi;
use App\Models\SmisDocDaftarTilikPasienOperasi;
use App\Models\SmisDocEarlyWarningScoringSystemDewasa;
use App\Models\SmisDocFormulirSkriningAwalGiziAnak;
use App\Models\SmisDocObservasiCairan;
use App\Models\SmisDocPemantauanTandaTandaVital;
use App\Models\SmisDocRenpra;
use App\Models\SmisHrdEmployee;
use App\Services\AsesmenPraAnestesiDanSedasi;
use App\Services\AsesmenResikoJatuh;
use App\Services\AssesmentUlangNyeriDanIntervensiService;
use App\Services\CatatanPerkembanganPasienTerintegrasiService;
use App\Services\DokumenKunjungan\DaftarPemberianObatService;
use App\Services\DokumenKunjungan\LembarKonsultasiService;
use App\Services\DokumenKunjungan\PersetujuanAtauPenolakanTindakanBedahService;
use App\Services\DokumenKunjungan\SurveiInfeksiRumahSakitService;
use App\Services\DokumenKunjungan\RekonsiliasiObatService;
use App\Services\DokumenKunjunganService;
use App\Services\DokumenOrientasiPasienBaruService;
use App\Services\DokumentasiInformasiTindakanAnestesiService;
use App\Services\TindakanAnestesiEpiduralService;
use App\Services\ERekamMedisService;
use App\Services\IndikatorScService;
use App\Services\MedicalRecordService;
use App\Services\PersetujuanTransfusiDarahService;
use App\Services\PermintaanPemeriksaanPatologiAnatomiService;
use App\Services\RenpraService;
use App\Services\ErmRanapService;
use App\Services\JurnalService;
use App\Services\LaporanAnastesiDanSedasiService;
use App\Services\PersetujuanPenolakanTindakanKedokteranService;
use App\Services\ResepService;
use App\Services\ResumeMedisPasienPulangService;
use App\Services\SuratKeteranganKematianService;
use App\Services\SuratPernyataanNaikKelasService;
use App\Services\SuratPernyataanPulangApsService;
use App\Services\SuratPernyataanPenitipanKelasService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PDF;
use iio\libmergepdf\Merger;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use LDAP\Result;

class ErmRanapController extends Controller
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
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isJavascriptEnabled' => true]);
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
                if ($cek->value == 'URI' || $cek->value == 'URJI') {
                    array_push($poli_local, $pro);
                }
            }
        }
        $data['poli'] = $poli_local;
        $data['dokter'] = SmisHrdEmployee::where('jabatan', 1)->select('nama')->get();
        return view('erm.rawat_inap.index', $data);
    }

    function detail(Request $req, MedicalRecordService $mrs)
    {
        $data = $mrs->get_patient_and_history_kunjungan($req);
        return view('erm.rawat_inap.detail', $data);
    }

    function ajax_filter_data(Request $req)
    {
        $query = SMIS_LayananPasien::select('no_kunjungan', 'nama_dokter', 'last_nama_ruangan', 'nama_pasien', 'nrm', 'nobpjs', 'selesai')
            ->where('uri', 1);
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
        return Datatables::of($query)->make(true);
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

    function datatable_tindakan_operasi(Request $req)
    {
        $data = DB::table('smis_mjm_tindakan_operasi')->where('prop', '');
        return DataTables::of($data)->make(true);
    }

    function datatable_diagnosa(Request $req)
    {
        $data = DB::table('smis_mr_icd')->where('prop', '');
        return DataTables::of($data)->make(true);
    }

    function datatable_employee(Request $req)
    {
        $data = DB::table('smis_hrd_employee')->where('prop', '');
        return DataTables::of($data)->make(true);
    }

    function persetujuan_atau_penolakan_tindakan_kedokteran(Request $req)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->first();
        $data['dokumen'] = $dokumen;
        $data['data'] = Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran::where('id_dokumen', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        return view('erm.dokumen_kunjungan.persetujuan_atau_penolakan_tindakan_kedokteran', $data);
    }

    function persetujuan_atau_penolakan_tindakan_kedokteran_store(Request $req)
    {
        try {
            $data = Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran::where('id_dokumen', $req->dokumen)->first();
            $lampiran_pptk = $data ? $data->lampiran_pptk : '';

            if ($req->hasFile('lampiran_pptk')) {
                $file = $req->file('lampiran_pptk');
                $tujuan_upload = 'lampiran_pptk';
                $lampiran_pptk = time() . $file->getClientOriginalName();
                $file->move($tujuan_upload, $lampiran_pptk);
            }

            Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'id_dokter_pelaksana_tindakan' => $req->id_dokter_pelaksana_tindakan ? $req->id_dokter_pelaksana_tindakan : 0,
                'dokter_pelaksana_tindakan' => $req->dokter_pelaksana_tindakan ? $req->dokter_pelaksana_tindakan : '',
                'id_pemberi_informasi' => $req->id_pemberi_informasi ? $req->id_pemberi_informasi : 0,
                'pemberi_informasi' => $req->pemberi_informasi ? $req->pemberi_informasi : '',
                'penerima_informasi' => $req->penerima_informasi ? $req->penerima_informasi : '',
                'tanggal' => $req->tanggal ? $req->tanggal : '',
                'pukul' => $req->pukul ? $req->pukul : '',
                'diagnosa' => $req->diagnosa ? $req->diagnosa : '',
                'checkbox_diagnosa' => $req->checkbox_diagnosa ? $req->checkbox_diagnosa : '',
                'dasar_diagnosis' => $req->dasar_diagnosis ? $req->dasar_diagnosis : '',
                'checkbox_dasar_diagnosis' => $req->checkbox_dasar_diagnosis ? $req->checkbox_dasar_diagnosis : '',
                'tindakan_kedokteran' => $req->tindakan_kedokteran ? $req->tindakan_kedokteran : '',
                'checkbox_tindakan_kedokteran' => $req->checkbox_tindakan_kedokteran ? $req->checkbox_tindakan_kedokteran : '',
                'indikasi_tindakan' => $req->indikasi_tindakan ? $req->indikasi_tindakan : '',
                'checkbox_indikasi_tindakan' => $req->checkbox_indikasi_tindakan ? $req->checkbox_indikasi_tindakan : '',
                'tata_cara' => $req->tata_cara ? $req->tata_cara : '',
                'checkbox_tata_cara' => $req->checkbox_tata_cara ? $req->checkbox_tata_cara : '',
                'tujuan' => $req->tujuan ? $req->tujuan : '',
                'checkbox_tujuan' => $req->checkbox_tujuan ? $req->checkbox_tujuan : '',
                'risiko' => $req->risiko ? $req->risiko : '',
                'checkbox_risiko' => $req->checkbox_risiko ? $req->checkbox_risiko : '',
                'komplikasi' => $req->komplikasi ? $req->komplikasi : '',
                'checkbox_komplikasi' => $req->checkbox_komplikasi ? $req->checkbox_komplikasi : '',
                'prognosis' => $req->prognosis ? $req->prognosis : '',
                'checkbox_prognosis' => $req->checkbox_prognosis ? $req->checkbox_prognosis : '',
                'alternatif' => $req->alternatif ? $req->alternatif : '',
                'checkbox_alternatif' => $req->checkbox_alternatif ? $req->checkbox_alternatif : '',
                'hal_lain' => $req->hal_lain ? $req->hal_lain : '',
                'checkbox_hal_lain' => $req->checkbox_hal_lain ? $req->checkbox_hal_lain : '',
                'nama' => $req->nama ? $req->nama : '',
                'pekerjaan' => $req->pekerjaan ? $req->pekerjaan : '',
                'alamat' => $req->alamat ? $req->alamat : '',
                'umur' => $req->umur ? $req->umur : '',
                'jenis_kelamin' => $req->jenis_kelamin ? $req->jenis_kelamin : '',
                'no_ktp' => $req->no_ktp ? $req->no_ktp : '',
                'telepon' => $req->telepon ? $req->telepon : '',
                'menyatakan' => $req->menyatakan ? $req->menyatakan : '',
                'pernyataan' => $req->pernyataan ? $req->pernyataan : '',
                'hubungan_dengan_pasien' => $req->hubungan_dengan_pasien ? $req->hubungan_dengan_pasien : '',
                'lain_lain' => $req->lain_lain ? $req->lain_lain : '',
                'nama_yang_menyatakan' => $req->nama_yang_menyatakan ? $req->nama_yang_menyatakan : '',
                'nama_dokter' => $req->nama_dokter ? $req->nama_dokter : '',
                'saksi_satu' => $req->saksi_satu ? $req->saksi_satu : '',
                'saksi_dua' => $req->saksi_dua ? $req->saksi_dua : '',
                'tanggal_formulir' => $req->tanggal_formulir ? $req->tanggal_formulir : '',
                'waktu_formulir' => $req->waktu_formulir ? $req->waktu_formulir : '',
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
    }

    function persetujuan_atau_penolakan_tindakan_kedokteran_verifikasi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            DokumenKunjungan::findOrFail($req->dokumen);
            if (Auth::user()->password != md5($req->password)) {
                return redirect()->back()->with('message', 'Password anda salah');
            }

            $dks->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/persetujuan_atau_penolakan_tindakan_kedokteran?dokumen=' . $req->dokumen)->with('message', 'Berhasil Verifikasi Dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    function formulir_skrining_awal_gizi_anak(Request $req)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->first();
        $data['dokumen'] = $dokumen;
        $data['data'] = SmisDocFormulirSkriningAwalGiziAnak::where('id_dokumen', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        return view('erm.dokumen_kunjungan.formulir_skrining_awal_gizi_anak', $data);
    }

    function formulir_skrining_awal_gizi_anak_store(Request $req)
    {
        try {
            $data = SmisDocFormulirSkriningAwalGiziAnak::where('id_dokumen', $req->dokumen)->first();
            $lampiran_pptk = $data ? $data->lampiran_pptk : '';

            if ($req->hasFile('lampiran_pptk')) {
                $file = $req->file('lampiran_pptk');
                $tujuan_upload = 'lampiran_pptk';
                $lampiran_pptk = time() . $file->getClientOriginalName();
                $file->move($tujuan_upload, $lampiran_pptk);
            }

            SmisDocFormulirSkriningAwalGiziAnak::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'penurunan_satu' => $req->penurunan_satu ? $req->penurunan_satu : '',
                'penurunan_dua' => $req->penurunan_dua ? $req->penurunan_dua : '',
                'penurunan_tiga' => $req->penurunan_tiga ? $req->penurunan_tiga : '',
                'penurunan_empat' => $req->penurunan_empat ? $req->penurunan_empat : '',
                'penurunan_lima' => $req->penurunan_lima ? $req->penurunan_lima : '',
                'penurunan_enam' => $req->penurunan_enam ? $req->penurunan_enam : '',
                'penurunan_tujuh' => $req->penurunan_tujuh ? $req->penurunan_tujuh : '',
                'penurunan_delapan' => $req->penurunan_delapan ? $req->penurunan_delapan : '',
                'penurunan_sembilan' => $req->penurunan_sembilan ? $req->penurunan_sembilan : '',
                'total' => $req->total ? $req->total : '',
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
    }

    function formulir_skrining_awal_gizi_anak_verifikasi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            DokumenKunjungan::findOrFail($req->dokumen);
            if (Auth::user()->password != md5($req->password)) {
                return redirect()->back()->with('message', 'Password anda salah');
            }

            $dks->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/formulir_skrining_awal_gizi_anak?dokumen=' . $req->dokumen)->with('message', 'Berhasil Verifikasi Dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    function formulir_skrining_awal_gizi_dewasa(Request $req)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->first();
        $data['dokumen'] = $dokumen;
        $data['data'] = Smis_Doc_Formulir_Skrining_Awal_Gizi_Dewasa::where('id_dokumen', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        return view('erm.dokumen_kunjungan.formulir_skrining_awal_gizi_dewasa', $data);
    }

    function formulir_skrining_awal_gizi_dewasa_store(Request $req)
    {
        try {
            $data = Smis_Doc_Formulir_Skrining_Awal_Gizi_Dewasa::where('id_dokumen', $req->dokumen)->first();
            $lampiran_pptk = $data ? $data->lampiran_pptk : '';

            if ($req->hasFile('lampiran_pptk')) {
                $file = $req->file('lampiran_pptk');
                $tujuan_upload = 'lampiran_pptk';
                $lampiran_pptk = time() . $file->getClientOriginalName();
                $file->move($tujuan_upload, $lampiran_pptk);
            }

            Smis_Doc_Formulir_Skrining_Awal_Gizi_Dewasa::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'penurunan_satu' => $req->penurunan_satu ? $req->penurunan_satu : '',
                'penurunan_dua' => $req->penurunan_dua ? $req->penurunan_dua : '',
                'penurunan_tiga' => $req->penurunan_tiga ? $req->penurunan_tiga : '',
                'penurunan_empat' => $req->penurunan_empat ? $req->penurunan_empat : '',
                'penurunan_lima' => $req->penurunan_lima ? $req->penurunan_lima : '',
                'penurunan_enam' => $req->penurunan_enam ? $req->penurunan_enam : '',
                'penurunan_tujuh' => $req->penurunan_tujuh ? $req->penurunan_tujuh : '',
                'penurunan_delapan' => $req->penurunan_delapan ? $req->penurunan_delapan : '',
                'penurunan_sembilan' => $req->penurunan_sembilan ? $req->penurunan_sembilan : '',
                'total' => $req->total ? $req->total : '',
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
    }

    function formulir_skrining_awal_gizi_dewasa_verifikasi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            DokumenKunjungan::findOrFail($req->dokumen);
            if (Auth::user()->password != md5($req->password)) {
                return redirect()->back()->with('message', 'Password anda salah');
            }

            $dks->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/formulir_skrining_awal_gizi_dewasa?dokumen=' . $req->dokumen)->with('message', 'Berhasil Verifikasi Dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }


    function skala_risiko_jatuh_humpty_dumpty_untuk_pediatri(Request $req)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->first();
        $data['dokumen'] = $dokumen;
        $data['data'] = Smis_doc_skala_risiko_jatuh_humpty_dumpty_untuk_pediatri::where('id_dokumen', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        return view('erm.dokumen_kunjungan.dokumen_skala_risiko_pasien_jatuh_humpty_dumpty_untuk_pediatri', $data);
    }

    function skala_risiko_jatuh_humpty_dumpty_untuk_peidatri_store(Request $req)
    {
        try {
            $data = Smis_doc_skala_risiko_jatuh_humpty_dumpty_untuk_pediatri::where('id_dokumen', $req->dokumen)->first();
            $lampiran_pptk = $data ? $data->lampiran_pptk : '';

            if ($req->hasFile('lampiran_pptk')) {
                $file = $req->file('lampiran_pptk');
                $tujuan_upload = 'lampiran_pptk';
                $lampiran_pptk = time() . $file->getClientOriginalName();
                $file->move($tujuan_upload, $lampiran_pptk);
            }

            Smis_doc_skala_risiko_jatuh_humpty_dumpty_untuk_pediatri::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'id_dokter_pelaksana_tindakan' => $req->id_dokter_pelaksana_tindakan ? $req->id_dokter_pelaksana_tindakan : 0,
                'usia' => $req->usia ? $req->usia : '',
                'jenis_kelamin' => $req->jenis_kelamin ? $req->jenis_kelamin : '',
                'diagnosis' => $req->diagnosis ? $req->diagnosis : '',
                'gangguan_kognitif' => $req->gangguan_kognitif ? $req->gangguan_kognitif : '',
                'faktor_lingkungan' => $req->faktor_lingkungan ? $req->faktor_lingkungan : '',
                'pembedahan' => $req->pembedahan ? $req->pembedahan : '',
                'medikamentosa' => $req->medikamentosa ? $req->medikamentosa : '',
                'jumlah_skor' => $req->jumlah_skor ? $req->jumlah_skor : '',
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
    }

    public function save_ttd_yang_menyatakan(Request $req)
    {
        try {
            // Path folder untuk menyimpan tanda tangan
            $folderPath = public_path('signature_patient/');

            // Memisahkan data gambar yang diterima
            $image_parts = explode(";base64,", $req->signed_nama_yang_menyatakan);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Membuat nama file unik dan menyimpannya
            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            // Menyiapkan data untuk diupdate di database
            $val = [
                'signature_nama_yang_menyatakan' => $fileName,
                'nama_yang_menyatakan' => $req->nama_yang_menyatakan
            ];

            // Mengupdate data di database
            $updated = Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran::where('id_dokumen', $req->dokumen)->update($val);

            if ($updated) {
                return back()->with('sukses', 'Berhasil tanda tangan dokumen');
            } else {
                return back()->with('gagal', 'Gagal mengupdate dokumen');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    public function save_ttd_saksi_satu(Request $req)
    {
        // dd($req->all());

        try {
            // Path folder untuk menyimpan tanda tangan
            $folderPath = public_path('signature_patient/');

            // Memisahkan data gambar yang diterima
            $image_parts = explode(";base64,", $req->signed_saksi_satu);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Membuat nama file unik dan menyimpannya
            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            // Menyiapkan data untuk diupdate di database
            $val = [
                'signature_saksi_satu' => $fileName,
                'saksi_satu' => $req->saksi_satu
            ];

            // Mengupdate data di database
            $updated = Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran::where('id_dokumen', $req->dokumen)->update($val);

            if ($updated) {
                return back()->with('sukses', 'Berhasil tanda tangan dokumen');
            } else {
                return back()->with('gagal', 'Gagal mengupdate dokumen');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    public function save_ttd_saksi_dua(Request $req)
    {
        try {
            // Path folder untuk menyimpan tanda tangan
            $folderPath = public_path('signature_patient/');

            // Memisahkan data gambar yang diterima
            $image_parts = explode(";base64,", $req->signed_saksi_dua);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Membuat nama file unik dan menyimpannya
            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            // Menyiapkan data untuk diupdate di database
            $val = [
                'signature_saksi_dua' => $fileName,
                'saksi_dua' => $req->saksi_dua
            ];

            // Mengupdate data di database
            $updated = Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran::where('id_dokumen', $req->dokumen)->update($val);

            if ($updated) {
                return back()->with('sukses', 'Berhasil tanda tangan dokumen');
            } else {
                return back()->with('gagal', 'Gagal mengupdate dokumen');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }


    function dokumen_orientasi_pasien_baru(Request $req, DokumenOrientasiPasienBaruService $das)
    {
        $data = $das->data($req);
        return view('erm.dokumen_kunjungan.dokumen_orientasi_pasien_baru', $data);
    }

    function save_dokumen_orientasi_pasien_baru(DokumenOrientasiPasienBaruRequest $req, DokumenOrientasiPasienBaruService $das)
    {
        try {
            $das->create($req);
            return redirect('e_rekam_medis/detail/dokumen_orientasi_pasien_baru?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
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

    function catatan_perkembangan_pasien_terintegrasi(Request $req, CatatanPerkembanganPasienTerintegrasiService $cppt)
    {
        $data = $cppt->data($req);
        return view('erm.dokumen_kunjungan.catatan_perkembangan_pasien_terintegrasi', $data);
    }

    function save_catatan_perkembangan_pasien_terintegrasi(CatatanPerkembanganPasienTerintegrasiRequest $req, CatatanPerkembanganPasienTerintegrasiService $das)
    {
        try {
            $das->create($req);
            return redirect('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput(Input::all())->with('gagal', $th->getMessage());
        }
    }

    function pdf_catatan_perkembangan_pasien_terintegrasi(Request $req, CatatanPerkembanganPasienTerintegrasiService $cppt)
    {
        $data = $cppt->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_catatan_perkembangan_pasien_terintegrasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    public function rencana_keperawatan(RenpraService $svc)
    {
        $get_view_renpra = function ($name) {
            foreach (SmisDocRenpra::renpra() as $item) {
                if (isset($item['name']) && Str::upper($item['name']) == Str::upper($name)) {
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

                // if (SmisDocRenpra::where('id_dokumen', request('id_dokumen'))->where('nama_renpra', request('nama_renpra'))->where('tanggal', Carbon::now())->exists()) {
                //     $error = 'Rencana Keperawatan (' . request('nama_renpra') . ') sudah ada.';
                //     if (request()->ajax()) {
                //         return response($error, 422);
                //     } else {
                //         return redirect()->back()->withErrors(['nama_renpra' => $error]);
                //     }
                // }

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
                        'noc' => request('noc'),
                        'kriteria_hasil' => request('kriteria_hasil'),
                        'intervensi' => request('intervensi'),
                        'ket_intervensi' => request('ket_intervensi'),
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


    function assesment_ulang_nyeri_dan_intervensi(Request $req, AssesmentUlangNyeriDanIntervensiService $cppt)
    {
        $data = $cppt->data($req);
        return view('erm.dokumen_kunjungan.dokumen_assesment_ulang_nyeri_dan_intervensi', $data);
    }

    function pdf_assesment_ulang_nyeri_dan_intervensi(Request $req, AssesmentUlangNyeriDanIntervensiService $cppt)
    {
        $data = $cppt->data($req);

        // return view('erm.dokumen_kunjungan.pdf_dokumen_assesment_ulang_nyeri_dan_intervensi', $data);

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isJavascriptEnabled' => true]);
        $pdf_one = PDF::loadView('erm.dokumen_kunjungan.pdf_dokumen_assesment_ulang_nyeri_dan_intervensi', $data)->setPaper('A4', 'landscape');
        $m = new Merger();
        $m->addRaw($pdf_one->output());
        $contents = $m->merge();

        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function save_assesment_ulang_nyeri_dan_intervensi(Request $req, AssesmentUlangNyeriDanIntervensiService $dks)
    {

        // dd($req->all());

        $id_dokumen = 0;
        foreach ($req->idx as $key => $idx) {
            $id_dokumen = $req->id_dokumen[$key];
            $data = [
                'id_dokumen' => $req->id_dokumen[$key],
                'idx' => $idx,
                'tanggal1' =>  $req->Tgl1[$key] ? Carbon::createFromFormat('d/m/Y H:i', $req->Tgl1[$key]) : null,
                'skor_nyeri' => $req->SkorNyeri[$key],
                'skor_sedasi' => $req->SkorSedasi[$key],
                'tekanan_darah' => $req->TekanaDarah[$key],
                'nadi' => $req->Nadi[$key],
                'suhu' => $req->Suhu[$key],
                'respirasi' => $req->Respirasi[$key],
                'tanggal2' => $req->Tgl2[$key] ? Carbon::createFromFormat('d/m/Y H:i', $req->Tgl2[$key]) : null,
                'nama_obat' => $req->NamaObat[$key],
                'dosis' => $req->Dosis[$key],
                'rute' => $req->Rute[$key],
                'efek_samping' => $req->EfekSamping[$key],
                'intervensi_non_farmakologi' => $req->IntervensiNonFarmakologi[$key],
                'tanggal_kaji_ulang' => $req->WaktuKajiUlang[$key] ? Carbon::createFromFormat('d/m/Y H:i', $req->WaktuKajiUlang[$key]) : null,
            ];

            $objData = SmisDocAssesmentUlangNyeriIntervensi::updateOrCreate([
                'id_dokumen' => $req->id_dokumen[$key],
                'idx' => $idx,
            ], $data);
        }

        if ($req->verif > 0) {
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
                dd($th);
                return redirect()->back()->with('gagal', $th->getMessage());
            }
        }

        return redirect('e_rekam_medis/detail/assesment_ulang_nyeri_dan_intervensi?dokumen=' . $id_dokumen)->with('sukses', 'Berhasil simpan data');
    }

    function verif_assesment_ulang_nyeri_dan_intervensi(Request $req, AssesmentUlangNyeriDanIntervensiService $dks)
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
            dd($th);
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function asesmen_pra_anestesi_dan_sedasi(Request $req, AsesmenPraAnestesiDanSedasi $cppt)
    {
        $data = $cppt->data($req);

        // dd($data['detail']->sosial);

        return view('erm.dokumen_kunjungan.dokumen_asesmen_pra_anestesi_dan_sedasi', $data);
    }


    function save_asesmen_pra_anestesi_dan_sedasi(Request $req, AsesmenPraAnestesiDanSedasi $dks)
    {

        // dd($req->all());

        $id_dokumen = $req->dokumen;

        $data = [
            'id_dokumen' => $req->dokumen,
            'operator' => auth()->user()->id,
            'tanggal' => $req->tanggal ? Carbon::createFromFormat('d/m/Y', $req->tanggal) : null,
            'jam' => $req->jam,
            "sosial" => $req->sosial,
            "kebiasaan" => $req->kebiasaan,
            "pengobatan" => $req->pengobatan,
            "riwayat_keluarga" => $req->riwayat_keluarga,
            "riwayat_penyakit" => $req->riwayat_penyakit,
            "pasien_perempuan" => $req->pasien_perempuan,
            "pemeriksaan_penunjang" => $req->pemeriksaan_penunjang,
            "asesmen_dokter_anestesi" => $req->asesmen_dokter_anestesi,
        ];

        // dd($data);/

        $objData = Smis_Doc_Asesment_Praanestesi_Sedasi::updateOrCreate([
            'id_dokumen' => $req->dokumen,
        ], $data);




        if ($req->verif == 1) {
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
                dd($th);
                return redirect()->back()->with('gagal', $th->getMessage());
            }
        }

        return redirect('e_rekam_medis/detail/asesmen_pra_anestesi_dan_sedasi?dokumen=' . $id_dokumen)->with('sukses', 'Berhasil simpan data');
    }

    function verif_asesmen_pra_anestesi_dan_sedasi(Request $req, AsesmenPraAnestesiDanSedasi $dks)
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
            dd($th);
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function pdf_asesmen_pra_anestesi_dan_sedasi(Request $req, AsesmenPraAnestesiDanSedasi $cppt)
    {
        $data = $cppt->data($req);

        // return view('erm.dokumen_kunjungan.pdf_dokumen_asesmen_pra_anestesi_dan_sedasi', $data);

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isJavascriptEnabled' => true]);
        $pdf_one = PDF::loadView('erm.dokumen_kunjungan.pdf_dokumen_asesmen_pra_anestesi_dan_sedasi', $data)->setPaper('A4');
        $m = new Merger();
        $m->addRaw($pdf_one->output());
        $contents = $m->merge();

        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }


    function reassesment_resiko_jatuh(Request $req, AsesmenResikoJatuh $cppt)
    {
        $data = $cppt->data($req);

        // dd($data['detail']->sosial);

        return view('erm.dokumen_kunjungan.dokumen_re-assesment_resiko_jatuh', $data);
    }

    function verif_reassesment_resiko_jatuh(Request $req, AsesmenResikoJatuh $dks)
    {

        try {
            if (Auth::user()->password == md5($req->pass)) {
                // dd($req->all());
                if ($req->isDetail == 0) {


                    $data = [
                        "verifikator" . $req->verif => auth()->user()->username,
                        "status" . $req->verif => 1,
                    ];

                    $objData = Smis_Doc_Reasesmen_Resiko_Jatuh::updateOrCreate([
                        'id_dokumen' => $req->dokumen,
                    ], $data);
                } else {


                    $data = [
                        "verifikator" . $req->verif => auth()->user()->username,
                        "status" . $req->verif => 1,
                    ];

                    // dd($data);

                    $objData = Smis_Doc_Reasesmen_Resiko_Jatuh_Detail::updateOrCreate([
                        'id_dokumen' => $req->dokumen,
                        'jenis' => $req->JenisDetail,
                    ], $data);
                }


                return back()
                    ->with('sukses', 'Dokumen berhasil diverifikasi');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_reassesment_resiko_jatuh(Request $req)
    {
        $id_dokumen = $req->dokumen;

        // dd($req->all());

        foreach ($req->Idx as $key => $item) {
            $dataDetail = [
                'id_dokumen' => $req->dokumen,
                'idx' => $req->Idx[$item],
                'parameter' => $req->Parameter[$item],
                'tipe' => $req->Tipe[$item],

                'ScoreParameter' => (isset($req->ScoreParameter[$item]) ? $req->ScoreParameter[$item] : null),

                'Score1' => (isset($req->Score1[$item]) ? $req->Score1[$item] : null),
                'Score2' => (isset($req->Score2[$item]) ? $req->Score2[$item] : null),
                'Score3' => (isset($req->Score3[$item]) ? $req->Score3[$item] : null),
                'Score4' => (isset($req->Score4[$item]) ? $req->Score4[$item] : null),
                'Score5' => (isset($req->Score5[$item]) ? $req->Score5[$item] : null),

                'TotalScore1' => $req->TotalScore1,
                'TotalScore2' => $req->TotalScore2,
                'TotalScore3' => $req->TotalScore3,
                'TotalScore4' => $req->TotalScore4,
                'TotalScore5' => $req->TotalScore5,

                'TanggalJam1' => $req->TanggalJam1 ? Carbon::createFromFormat('d/m/Y H:i', $req->TanggalJam1)->toDateTimeString() : null,
                'TanggalJam2' => $req->TanggalJam2 ? Carbon::createFromFormat('d/m/Y H:i', $req->TanggalJam2)->toDateTimeString() : null,
                'TanggalJam3' => $req->TanggalJam3 ? Carbon::createFromFormat('d/m/Y H:i', $req->TanggalJam3)->toDateTimeString() : null,
                'TanggalJam4' => $req->TanggalJam4 ? Carbon::createFromFormat('d/m/Y H:i', $req->TanggalJam4)->toDateTimeString() : null,
                'TanggalJam5' => $req->TanggalJam5 ? Carbon::createFromFormat('d/m/Y H:i', $req->TanggalJam5)->toDateTimeString() : null,
            ];

            // dd($dataDetail);

            $objData = Smis_Doc_Reasesmen_Resiko_Jatuh::updateOrCreate([
                'id_dokumen' => $req->dokumen,
                'idx' => $req->Idx[$item],
            ], $dataDetail);
        }

        if ($req->verif >= 1) {
            try {
                if (Auth::user()->password == md5($req->pass)) {
                    // dd($req->all());
                    if ($req->isDetail == 0) {


                        $data = [
                            "verifikator" . $req->verif => auth()->user()->username,
                            "status" . $req->verif => 1,
                        ];

                        $objData = Smis_Doc_Reasesmen_Resiko_Jatuh::updateOrCreate([
                            'id_dokumen' => $req->dokumen,
                        ], $data);
                    } else {


                        $data = [
                            "verifikator" . $req->verif => auth()->user()->username,
                            "status" . $req->verif => 1,
                        ];

                        // dd($data);

                        $objData = Smis_Doc_Reasesmen_Resiko_Jatuh_Detail::updateOrCreate([
                            'id_dokumen' => $req->dokumen,
                            'jenis' => $req->JenisDetail,
                        ], $data);
                    }

                    $dok = DokumenKunjungan::find($req->dokumen);
                    $dok->id_verifikator = auth()->user()->id;
                    $dok->nama_verifikator = Auth::user()->username;
                    $dok->status = 1;
                    $dok->save();


                    return back()
                        ->with('sukses', 'Dokumen berhasil diverifikasi');
                }
                return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
            } catch (\Throwable $th) {
                // dd($th);
                return redirect()->back()->with('gagal', $th->getMessage());
            }
        }

        return redirect('e_rekam_medis/detail/re_assesment_resiko_jatuh?dokumen=' . $id_dokumen)->with('sukses', 'Berhasil simpan data');
    }

    function save_reassesment_resiko_jatuh_detail(Request $req)
    {
        $id_dokumen = $req->dokumen;

        // dd($req->all());
        $jenis = $req->Jenis[0];
        foreach ($req->Idx as $key => $item) {
            $dataDetail = [
                'id_dokumen' => $req->dokumen,
                'idx' => $req->Idx[$item],
                'parameter' => $req->Parameter[$item],
                'jenis' => $req->Jenis[$item],

                'P1' => (isset($req->P1[$item]) ? $req->P1[$item] : 0),
                'P2' => (isset($req->P2[$item]) ? $req->P2[$item] : 0),
                'P3' => (isset($req->P3[$item]) ? $req->P3[$item] : 0),
                'P4' => (isset($req->P4[$item]) ? $req->P4[$item] : 0),
                'P5' => (isset($req->P5[$item]) ? $req->P5[$item] : 0),

                'S1' => (isset($req->S1[$item]) ? $req->S1[$item] : 0),
                'S2' => (isset($req->S2[$item]) ? $req->S2[$item] : 0),
                'S3' => (isset($req->S3[$item]) ? $req->S3[$item] : 0),
                'S4' => (isset($req->S4[$item]) ? $req->S4[$item] : 0),
                'S5' => (isset($req->S5[$item]) ? $req->S5[$item] : 0),

                'M1' => (isset($req->M1[$item]) ? $req->M1[$item] : 0),
                'M2' => (isset($req->M2[$item]) ? $req->M2[$item] : 0),
                'M3' => (isset($req->M3[$item]) ? $req->M3[$item] : 0),
                'M4' => (isset($req->M4[$item]) ? $req->M4[$item] : 0),
                'M5' => (isset($req->M5[$item]) ? $req->M5[$item] : 0),

                'TanggalJam1' => $req->TanggalJamDetail1 ? Carbon::createFromFormat('d/m/Y', $req->TanggalJamDetail1)->toDateTimeString() : null,
                'TanggalJam2' => $req->TanggalJamDetail2 ? Carbon::createFromFormat('d/m/Y', $req->TanggalJamDetail2)->toDateTimeString() : null,
                'TanggalJam3' => $req->TanggalJamDetail3 ? Carbon::createFromFormat('d/m/Y', $req->TanggalJamDetail3)->toDateTimeString() : null,
                'TanggalJam4' => $req->TanggalJamDetail4 ? Carbon::createFromFormat('d/m/Y', $req->TanggalJamDetail4)->toDateTimeString() : null,
                'TanggalJam5' => $req->TanggalJamDetail5 ? Carbon::createFromFormat('d/m/Y', $req->TanggalJamDetail5)->toDateTimeString() : null,
            ];

            // dd($dataDetail);

            $objData = Smis_Doc_Reasesmen_Resiko_Jatuh_Detail::updateOrCreate([
                'id_dokumen' => $req->dokumen,
                'idx' => $req->Idx[$item],
                'jenis' => $jenis,
            ], $dataDetail);
        }

        // dd($req->verif);
        if ($req->verif != "0") {
            try {
                // dd("Asd12");
                if (Auth::user()->password == md5($req->pass)) {
                    // dd($req->all());
                    if ($req->isDetail == 0) {


                        $data = [
                            "verifikator" . $req->verif => auth()->user()->username,
                            "status" . $req->verif => 1,
                        ];



                        $objData = Smis_Doc_Reasesmen_Resiko_Jatuh::updateOrCreate([
                            'id_dokumen' => $req->dokumen,
                        ], $data);
                    } else {


                        $data = [
                            "verifikator" . $req->verif => auth()->user()->username,
                            "status" . $req->verif => 1,
                        ];

                        // dd($data);

                        $objData = Smis_Doc_Reasesmen_Resiko_Jatuh_Detail::updateOrCreate([
                            'id_dokumen' => $req->dokumen,
                            'jenis' => $req->JenisDetail,
                        ], $data);
                    }

                    $dok = DokumenKunjungan::find($req->dokumen);
                    $dok->id_verifikator = auth()->user()->id;
                    $dok->nama_verifikator = Auth::user()->username;
                    $dok->status = 1;
                    $dok->save();


                    return back()
                        ->with('sukses', 'Dokumen berhasil diverifikasi');
                }
                return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
            } catch (\Throwable $th) {
                dd($th);
                return redirect()->back()->with('gagal', $th->getMessage());
            }
        }

        return redirect('e_rekam_medis/detail/re_assesment_resiko_jatuh?dokumen=' . $id_dokumen)->with('sukses', 'Berhasil simpan data');
    }

    function pdf_reassesment_resiko_jatuh(Request $req, AsesmenResikoJatuh $cppt)
    {
        $data = $cppt->data($req);

        // return view('erm.dokumen_kunjungan.pdf_dokumen_re-assesment_resiko_jatuh_detail', $data);

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isJavascriptEnabled' => true]);
        $pdf_main = PDF::loadView('erm.dokumen_kunjungan.pdf_dokumen_re-assesment_resiko_jatuh', $data)->setPaper('A4');
        $pdf_detail = PDF::loadView('erm.dokumen_kunjungan.pdf_dokumen_re-assesment_resiko_jatuh_detail', $data)->setPaper('A4', 'landscape');
        $m = new Merger();

        $m->addRaw($pdf_main->output());
        $m->addRaw($pdf_detail->output());

        $contents = $m->merge();

        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function asesmen_awal_kebidanan_rawat_inap(Request $req, ErmRanapService $ers)
    {
        $data = $ers->asesmen_awal_kebidanan_rawat_inap($req);
        return view('erm.rawat_inap.asesmen_awal_kebidanan_rawat_inap', $data);
    }

    function save_asesmen_awal_kebidanan_rawat_inap(Request $req, ErmRanapService $ers)
    {
        try {
            $ers->save_asesmen_awal_kebidanan_rawat_inap($req);
            return redirect('e_rekam_medis/detail/asesmen_awal_kebidanan_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function resume_medis_pasien_pulang(Request $req, ResumeMedisPasienPulangService $rmpp)
    {
        $data = $rmpp->data($req);
        return view('erm.dokumen_kunjungan.resume_medis_pasien_pulang', $data);
    }

    function save_resume_medis_pasien_pulang(Request $req, ResumeMedisPasienPulangService $rmpp)
    {
        //dd($req->all());
        try {
            $rmpp->create($req);
            return response()->json('ok', 201);
            //return redirect('e_rekam_medis/detail/resume_medis_pasien_pulang?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return response()->json('error : ' . $th->getMessage(), 500);
            //return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function pdf_resume_medis_pasien_pulang(Request $req, ResumeMedisPasienPulangService $rmpp)
    {
        $data = $rmpp->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_resume_medis_pasien_pulang');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    public function daftar_tilik_pasien_operasi()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'dokumen_kunjungan_pasien.id_verifikator', 'smis_adm_user.id')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                    'smis_rg_layananpasien.last_ruangan'
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $data['dokter_spesialis'] = SmisHrdEmployee::where('dokter_spesialis', 1)->where('pendidikan', 'not like', '%anestesi%')->get();
            $data['dokter_anestesi'] = SmisHrdEmployee::where('dokter_spesialis', 1)->where('pendidikan', 'like', '%anestesi%')->get();
            $data['asal_units'] = SmisAdmPrototype::whereNull('prop')->orWhere('prop', '')->distinct()->pluck('nama')->toArray();
            $data['data'] = SmisDocDaftarTilikPasienOperasi::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocDaftarTilikPasienOperasi();
            $data['ttd_pelaksana'] = $data['data']->id_pelaksana ? SmisHrdEmployee::where('username', function ($q) use ($data) {
                $q->from('smis_adm_user')->where('id', $data['data']->id_pelaksana)->select('username')->limit(1);
            })->value('ttd') : null;
            $data['ttd_penerima'] = $data['data']->id_penerima ? SmisHrdEmployee::where('username', function ($q) use ($data) {
                $q->from('smis_adm_user')->where('id', $data['data']->id_penerima)->select('username')->limit(1);
            })->value('ttd') : null;

            return view('erm.rawat_inap.daftar_tilik_pasien_operasi', $data);
        } else if (request()->isMethod('POST')) {
            request()->validate([
                "action" => "required|in:Simpan,Verifikasi",
                "tanggal" => "required_if:action,Verifikasi",
                "asal_unit" => "required_if:action,Verifikasi",
                "transfer_ke" => "required_if:action,Verifikasi",
                "jam_transfer" => "required_if:action,Verifikasi",
                "tindakan_operasi" => "required_if:action,Verifikasi",
                "jam_rencana_operasi" => "required_if:action,Verifikasi",
                "id_dokter_spesialis" => "required_if:action,Verifikasi",
                "id_dokter_anestesi" => "required_if:action,Verifikasi",
                "daftar_periksa" => "required_if:action,Verifikasi|array",
                "pesan" => "nullable",
                "dokumen" => "required_if:action,Verifikasi",
                "password" => "required_if:action,Verifikasi",
            ], [
                'asal_unit.required' => 'Asal unit harus diisi.',
                'tindakan_operasi.required' => 'Tindakan operasi harus diisi.',
                'id_dokter_spesialis.required' => 'Dokter spesialis harus diisi.',
                'id_dokter_dokter_anestesi.required' => 'Dokter spesialis harus diisi.',
            ]);

            if (Str::lower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            try {
                DB::transaction(function () {
                    $tanggal = Carbon::createFromFormat('d/m/Y', request('tanggal'))->toDateString();

                    $update = [
                        "tanggal" => $tanggal,
                        "asal_unit" => request("asal_unit"),
                        "transfer_ke" => request("transfer_ke"),
                        "jam_transfer" => request("jam_transfer"),
                        "tindakan_operasi" => request("tindakan_operasi"),
                        "jam_rencana_operasi" => request("jam_rencana_operasi"),
                        "id_dokter_spesialis" => request("id_dokter_spesialis"),
                        "id_dokter_anestesi" => request("id_dokter_anestesi"),
                        "daftar_periksa" => request("daftar_periksa"),
                        "pesan" => request("pesan"),
                    ];
                    if (Str::lower(request('action')) == 'verifikasi') {
                        if (SmisDocDaftarTilikPasienOperasi::where('id_dokumen', request('dokumen'))->where('status', true)->exists()) {
                            $update["status_penerima"] = true;
                            $update["id_penerima"] = auth()->user()->id;
                            $update["nama_penerima"] = auth()->user()->realname;
                        } else {
                            $update["status"] = true;
                            $update["id_pelaksana"] = auth()->user()->id;
                            $update["nama_pelaksana"] = auth()->user()->realname;
                        }

                        DokumenKunjungan::updateOrCreate([
                            'id' => request('dokumen'),
                        ], [
                            'status' => true,
                            'id_verifikator' => auth()->user()->id,
                            'nama_verifikator' => auth()->user()->realname,
                        ]);
                    }
                    SmisDocDaftarTilikPasienOperasi::updateOrCreate([
                        'id_dokumen' => request('dokumen'),
                    ], $update);
                });

                return redirect()->back()->with('message', Str::lower(request('action')) == 'verifikasi' ? 'Dokumen berhasil diverifikasi.' : 'Dokumen berhasil disimpan.');
            } catch (\Exception $ex) {
                Log::error($ex->getMessage(), $ex->getTrace());

                return redirect()->back()->withErrors(['error' => "Terjadi kesalahan, silahkan coba lagi. Error: {$ex->getMessage()}"]);
            }
        }
    }

    public function pdf_daftar_tilik_pasien_operasi()
    {
        if (!request()->has('dokumen')) abort(404);

        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
            ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
            ->firstOrFail();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['dokter_spesialis'] = SmisHrdEmployee::where('dokter_spesialis', 1)->where('pendidikan', 'not like', '%anestesi%')->get();
        $data['dokter_anestesi'] = SmisHrdEmployee::where('dokter_spesialis', 1)->where('pendidikan', 'like', '%anestesi%')->get();
        $data['data'] = SmisDocDaftarTilikPasienOperasi::where('id_dokumen', request('dokumen'))->firstOrFail();

        $contents = $this->pdf($data, 'erm.rawat_inap.daftar_tilik_pasien_operasi_pdf');
        return response($contents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . request('dokumen') . ' Daftar Tilik Pasien Operasi.pdf"',
        ]);
    }

    public function assesment_perioperatif_medis()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                    'smis_rg_layananpasien.last_ruangan'
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $data['pemeriksas'] = SmisHrdEmployee::whereNull('prop')->orWhere('prop', '')->distinct()->pluck('nama')->toArray();
            $data['asal_units'] = SmisAdmPrototype::whereNull('prop')->orWhere('prop', '')->distinct()->pluck('nama')->toArray();
            $data['kesadarans'] = ['Composmentis', 'Sompolen', 'Sopor', 'Coma'];
            $data['data'] = SmisDocAssesmentPerioperatifMedis::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocAssesmentPerioperatifMedis();

            return view('erm.rawat_inap.assesment_perioperatif_medis', $data);
        } else {
            request()->validate([
                "dokumen" => "required",
                "action" => "required|in:Simpan,Verifikasi",
                "id_pasien" => "required_if:action,Verifikasi",
                "nrm_pasien" => "required_if:action,Verifikasi",
                "nama_pasien" => "required_if:action,Verifikasi",
                "ruangan" => "required_if:action,Verifikasi",
                "tanggal_assesment" => "required_if:action,Verifikasi",
                "jam_assesment" => "required_if:action,Verifikasi",
                "assesment_oleh" => "required_if:action,Verifikasi",
                "assesment_dari" => "required_if:action,Verifikasi",
                "asal_pasien" => "required_if:action,Verifikasi",
                "asal_pasien_lain" => "required_if:asal_pasien,Lain-lain",
                "anamnesis" => "required_if:action,Verifikasi",
                "pemeriksaan_fisik" => "required_if:action,Verifikasi",
                "status_generalis" => "required_if:action,Verifikasi",
                "pemeriksaan_penunjang_diagnostik" => "required_if:action,Verifikasi",
                "diagnosis_pra_operasi" => "required_if:action,Verifikasi",
                "rencana_tindakan_pengobatan" => "required_if:action,Verifikasi",
                "tanggal_jam_selesai" => "required_if:action,Verifikasi",
                "password" => "required_if:action,Verifikasi",
            ], [
                'asal_pasien_lain.required_if' => 'Asal pasien harus diisi untuk opsi pilihan Lain-lain',
            ]);

            if (Str::lower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            try {
                DB::transaction(function () {
                    $tanggal_jam_assesmen = request('tanggal_assesment') . ' ' . request('jam_assesment');
                    $tanggal_jam_assesmen = Carbon::createFromFormat('d/m/Y H:i', $tanggal_jam_assesmen)->toDateTimeString();
                    $tanggal_jam_selesai = Carbon::createFromFormat('d/m/Y H:i', request('tanggal_jam_selesai'))->toDateTimeString();

                    $update = [
                        'tanggal_jam_assesmen' => $tanggal_jam_assesmen,
                        'tanggal_jam_selesai' => $tanggal_jam_selesai,
                    ];
                    $update = array_merge(
                        $update,
                        request()->only(["assesment_oleh", "assesment_dari", "asal_pasien", "asal_pasien_lain", "anamnesis", "pemeriksaan_fisik", "status_generalis", "pemeriksaan_penunjang_diagnostik", "diagnosis_pra_operasi", "rencana_tindakan_pengobatan"])
                    );

                    if (Str::lower(request('action')) == 'verifikasi') {
                        $update["status"] = true;
                        $update["id_verifikator"] = auth()->user()->id;
                        $update["nama_verifikator"] = auth()->user()->realname;
                    }
                    SmisDocAssesmentPerioperatifMedis::updateOrCreate([
                        'id_dokumen' => request('dokumen'),
                    ], $update);

                    if (Str::lower(request('action')) == 'verifikasi') {
                        DokumenKunjungan::updateOrCreate([
                            'id' => request('dokumen'),
                        ], [
                            'status' => true,
                            'id_verifikator' => auth()->user()->id,
                            'nama_verifikator' => auth()->user()->realname,
                        ]);

                        $pemeriksaan_fisik = request('pemeriksaan_fisik');
                        $data_pemeriksaan_fisik = [
                            'nama_pasien' => request('nama_pasien'),
                        ];
                        if (isset($pemeriksaan_fisik["Keadaan umum"])) $data_pemeriksaan_fisik['keadaan_umum'] = $pemeriksaan_fisik["Keadaan umum"];
                        // if (isset($pemeriksaan_fisik["Kesadaran"])) $data_pemeriksaan_fisik['kesadaran'] = $pemeriksaan_fisik["Kesadaran"];
                        if (isset($pemeriksaan_fisik["BB"])) $data_pemeriksaan_fisik['berat_badan'] = $pemeriksaan_fisik["BB"];
                        if (isset($pemeriksaan_fisik["TB"])) $data_pemeriksaan_fisik['tinggi_badan'] = $pemeriksaan_fisik["TB"];
                        if (isset($pemeriksaan_fisik["TD"])) $data_pemeriksaan_fisik['tensi'] = $pemeriksaan_fisik["TD"];
                        if (isset($pemeriksaan_fisik["Nadi"])) $data_pemeriksaan_fisik['nadi'] = $pemeriksaan_fisik["Nadi"];
                        if (isset($pemeriksaan_fisik["Suhu"])) $data_pemeriksaan_fisik['suhu'] = $pemeriksaan_fisik["Suhu"];
                        if (isset($pemeriksaan_fisik["RR"])) $data_pemeriksaan_fisik['rr'] = $pemeriksaan_fisik["RR"];
                        Smis_Mr_Tanda_Vital::updateOrCreate([
                            'waktu' => $tanggal_jam_assesmen,
                            'ruangan' => request('ruangan'),
                            'noreg_pasien' => request('id_pasien'),
                            'nrm_pasien' => request('nrm_pasien'),
                        ], $data_pemeriksaan_fisik);
                    }
                });

                return redirect()->back()->with('message', Str::lower(request('action')) == 'verifikasi' ? 'Dokumen berhasil diverifikasi.' : 'Dokumen berhasil disimpan.');
            } catch (\Exception $ex) {
                Log::error($ex->getMessage(), $ex->getTrace());
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, silahkan coba lagi. Error: ' . $ex->getMessage()]);
            }
        }
    }

    public function pdf_assesment_perioperatif_medis()
    {
        if (!request()->has('dokumen')) abort(404);

        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
            ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
            ->firstOrFail();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['data'] = SmisDocAssesmentPerioperatifMedis::where('id_dokumen', request('dokumen'))->firstOrFail();

        $contents = $this->pdf($data, 'erm.rawat_inap.assesment_perioperatif_medis_pdf');
        return response($contents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . request('dokumen') . ' Daftar Tilik Pasien Operasi.pdf"',
        ]);
    }
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
            $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
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

            if (Str::lower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            if (Str::lower(request('action')) == 'verifikasi' && SmisDocFormulirKriteriaPasienMasukIcu::where('id_dokumen', request('dokumen'))->where('status', true)->exists()) {
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
                if (Str::lower(request('action')) == 'verifikasi') {
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

            return redirect()->back()->with('message', Str::lower(request('action')) == 'verifikasi' ? 'Dokumen berhasil diverifikasi.' : 'Dokumen berhasil disimpan.');
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
            $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
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

            if (Str::lower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            if (Str::lower(request('action')) == 'verifikasi' && SmisDocFormulirKriteriaPasienKeluarIcu::where('id_dokumen', request('dokumen'))->where('status', true)->exists()) {
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
                if (Str::lower(request('action')) == 'verifikasi') {
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

            return redirect()->back()->with('message', Str::lower(request('action')) == 'verifikasi' ? 'Dokumen berhasil diverifikasi.' : 'Dokumen berhasil disimpan.');
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

    public function early_warning_scoring_system_dewasa()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                    'smis_rg_layananpasien.last_ruangan'
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $data['data'] = SmisDocEarlyWarningScoringSystemDewasa::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocEarlyWarningScoringSystemDewasa();

            $data['items'] = [
                [
                    'key' => 'respirasi',
                    'text' => 'Respirasi',
                    'items' => [
                        ['kriteria' => '<8', 'score' => 3],
                        ['kriteria' => '9 s/d 11', 'score' => 1],
                        ['kriteria' => '12 s/d 20', 'score' => 0],
                        ['kriteria' => '21 s/d 24', 'score' => 2],
                        ['kriteria' => '>25', 'score' => 3],
                    ],
                ],
                [
                    'key' => 'saturasi_o2',
                    'text' => 'Saturasi',
                    'items' => [
                        ['kriteria' => '<92', 'score' => 3],
                        ['kriteria' => '92 s/d 93', 'score' => 2],
                        ['kriteria' => '94 s/d 95', 'score' => 1],
                        ['kriteria' => '>95', 'score' => 0],
                    ],
                ],
                [
                    'key' => 'tekanan_darah_sistolik',
                    'text' => 'Tekanan Darah Sistolik (mmHg)',
                    'items' => [
                        ['kriteria' => '<91', 'score' => 3],
                        ['kriteria' => '91 s/d 100', 'score' => 2],
                        ['kriteria' => '101 s/d 110', 'score' => 1],
                        ['kriteria' => '111 s/d 219', 'score' => 0],
                        ['kriteria' => '>219', 'score' => 3],
                    ],
                ],
                [
                    'key' => 'hr',
                    'text' => 'HR',
                    'items' => [
                        ['kriteria' => '<39', 'score' => 3],
                        ['kriteria' => '40 s/d 50', 'score' => 1],
                        ['kriteria' => '51 s/d 90', 'score' => 0],
                        ['kriteria' => '91 s/d 110', 'score' => 1],
                        ['kriteria' => '111 s/d 130', 'score' => 2],
                        ['kriteria' => '>130', 'score' => 3],
                    ],
                ],
                [
                    'key' => 'kesadaran',
                    'text' => 'Kesadaran',
                    'items' => [
                        ['kriteria' => 'Sadar', 'score' => 0],
                        ['kriteria' => 'Nyeri / Verbal', 'score' => 3],
                    ],
                ],
                [
                    'key' => 'temperatur',
                    'text' => 'Temperatur',
                    'items' => [
                        ['kriteria' => '<35,1', 'score' => 3],
                        ['kriteria' => '35,1 s/d 36', 'score' => 1],
                        ['kriteria' => '36,1 s/d 38', 'score' => 0],
                        ['kriteria' => '38,1 s/d 39', 'score' => 1],
                        ['kriteria' => '>39', 'score' => 2],
                    ],
                ],
            ];

            $data['additional'] = [
                'GDS',
                'Skor Nyeri',
                'Urine Output',
            ];

            $data['isCheckedItem'] = function ($key, $hour, $score, $kriteria) use ($data) {
                if ($data['data']) {
                    if (isset($data['data']->{$key}[$hour])) {
                        if ($data['data']->{$key} && $data['data']->{$key}[$hour] == $score) {
                            return 'checked';
                        }
                    } else {
                        switch ($key) {
                            case 'respirasi':
                                return $kriteria == '12 s/d 20' ? 'checked' : '';
                                break;
                            case 'saturasi_o2':
                                return $kriteria == '>95' ? 'checked' : '';
                                break;
                            case 'tekanan_darah_sistolik':
                                return $kriteria == '111 s/d 219' ? 'checked' : '';
                                break;
                            case 'hr':
                                return $kriteria == '51 s/d 90' ? 'checked' : '';
                                break;
                            case 'kesadaran':
                                return $kriteria == 'Sadar' ? 'checked' : '';
                                break;
                            case 'temperatur':
                                return $kriteria == '36,1 s/d 38' ? 'checked' : '';
                                break;
                            default:
                                return 'checked';
                                break;
                        }
                    }
                }

                return '';
            };

            $data['getTotalScore'] = function ($hour) use ($data) {
                $total = 0;
                foreach ($data['items'] as $item) {
                    if ($item['key'] && $data['data']->{$item['key']} && isset($data['data']->{$item['key']}[$hour])) {
                        $total += $data['data']->{$item['key']}[$hour];
                    }
                }
                return $total;
            };

            $data['getParameterTambahanValue'] = function ($key, $hour) use ($data) {
                if ($data['data'] && $data['data']->parameter_tambahan && isset($data['data']->parameter_tambahan[$key]) && isset($data['data']->parameter_tambahan[$key][$hour])) {
                    return $data['data']->parameter_tambahan[$key][$hour];
                }
                return null;
            };

            return view('erm.rawat_inap.early_warning_scoring_system_dewasa', $data);
        } else {
            request()->validate([
                "dokumen" => "required",
                "action" => "required|in:Simpan,Verifikasi",
                "tanggal" => "required_if:action,Verifikasi",
                "jam" => "required_if:action,Verifikasi",
                "password" => "required_if:action,Verifikasi",
            ]);

            if (Str::lower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            try {
                DB::transaction(function () {
                    $tanggal_jam = request('tanggal') . ' ' . request('jam');
                    $tanggal_jam = Carbon::createFromFormat('d/m/Y H:i', $tanggal_jam)->toDateTimeString();

                    $update = [
                        'tanggal_jam' => $tanggal_jam,
                    ];
                    $update = array_merge(
                        $update,
                        request()->only(["respirasi", "saturasi_o2", "tekanan_darah_sistolik", "hr", "kesadaran", "temperatur", "parameter_tambahan",])
                    );

                    if (Str::lower(request('action')) == 'verifikasi') {
                        $update["status"] = true;
                        $update["id_pemeriksa"] = auth()->user()->id;
                        $update["nama_pemeriksa"] = auth()->user()->realname;
                    }
                    SmisDocEarlyWarningScoringSystemDewasa::updateOrCreate([
                        'id_dokumen' => request('dokumen'),
                    ], $update);

                    if (Str::lower(request('action')) == 'verifikasi') {
                        DokumenKunjungan::updateOrCreate([
                            'id' => request('dokumen'),
                        ], [
                            'status' => true,
                            'id_verifikator' => auth()->user()->id,
                            'nama_verifikator' => auth()->user()->realname,
                        ]);
                    }
                });

                return redirect()->back()->with('message', Str::lower(request('action')) == 'verifikasi' ? 'Dokumen berhasil diverifikasi.' : 'Dokumen berhasil disimpan.');
            } catch (\Exception $ex) {
                Log::error($ex->getMessage(), $ex->getTrace());
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, silahkan coba lagi. Error: ' . $ex->getMessage()]);
            }
        }
    }

    public function pdf_early_warning_scoring_system_dewasa()
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
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['data'] = SmisDocEarlyWarningScoringSystemDewasa::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocAssesmentPerioperatifMedis();

        $data['items'] = [
            [
                'key' => 'respirasi',
                'text' => 'Respirasi',
                'items' => [
                    ['kriteria' => '<8', 'score' => 3],
                    ['kriteria' => '9 s/d 11', 'score' => 1],
                    ['kriteria' => '12 s/d 20', 'score' => 0],
                    ['kriteria' => '21 s/d 24', 'score' => 2],
                    ['kriteria' => '>25', 'score' => 3],
                ],
            ],
            [
                'key' => 'saturasi_o2',
                'text' => 'Saturasi',
                'items' => [
                    ['kriteria' => '<92', 'score' => 3],
                    ['kriteria' => '92 s/d 93', 'score' => 2],
                    ['kriteria' => '94 s/d 95', 'score' => 1],
                    ['kriteria' => '>95', 'score' => 0],
                ],
            ],
            [
                'key' => 'tekanan_darah_sistolik',
                'text' => 'Tekanan Darah Sistolik (mmHg)',
                'items' => [
                    ['kriteria' => '<91', 'score' => 3],
                    ['kriteria' => '91 s/d 100', 'score' => 2],
                    ['kriteria' => '101 s/d 110', 'score' => 1],
                    ['kriteria' => '111 s/d 219', 'score' => 0],
                    ['kriteria' => '>219', 'score' => 3],
                ],
            ],
            [
                'key' => 'hr',
                'text' => 'HR',
                'items' => [
                    ['kriteria' => '<39', 'score' => 3],
                    ['kriteria' => '40 s/d 50', 'score' => 1],
                    ['kriteria' => '51 s/d 90', 'score' => 0],
                    ['kriteria' => '91 s/d 110', 'score' => 1],
                    ['kriteria' => '111 s/d 130', 'score' => 2],
                    ['kriteria' => '>130', 'score' => 3],
                ],
            ],
            [
                'key' => 'kesadaran',
                'text' => 'Kesadaran',
                'items' => [
                    ['kriteria' => 'Sadar', 'score' => 0],
                    ['kriteria' => 'Nyeri / Verbal', 'score' => 3],
                ],
            ],
            [
                'key' => 'temperatur',
                'text' => 'Temperatur',
                'items' => [
                    ['kriteria' => '<35,1', 'score' => 3],
                    ['kriteria' => '35,1 s/d 36', 'score' => 1],
                    ['kriteria' => '36,1 s/d 38', 'score' => 0],
                    ['kriteria' => '38,1 s/d 39', 'score' => 1],
                    ['kriteria' => '>39', 'score' => 2],
                ],
            ],
        ];

        $data['additional'] = [
            'GDS',
            'Skor Nyeri',
            'Urine Output',
        ];

        $data['isCheckedItem'] = function ($key, $hour, $score) use ($data) {
            if ($data['data']) {
                if ($data['data']->{$key} && isset($data['data']->{$key}[$hour]) && $data['data']->{$key}[$hour] == $score) {
                    return 'checked';
                }
            }

            return '';
        };

        $data['getTotalScore'] = function ($hour) use ($data) {
            $total = 0;
            foreach ($data['items'] as $item) {
                if ($item['key'] && $data['data']->{$item['key']} && isset($data['data']->{$item['key']}[$hour])) {
                    $total += $data['data']->{$item['key']}[$hour];
                }
            }
            return $total;
        };

        $data['getParameterTambahanValue'] = function ($key, $hour) use ($data) {
            if ($data['data'] && $data['data']->parameter_tambahan && isset($data['data']->parameter_tambahan[$key]) && isset($data['data']->parameter_tambahan[$key][$hour])) {
                return $data['data']->parameter_tambahan[$key][$hour];
            }
            return null;
        };

        // return view('erm.rawat_inap.early_warning_scoring_system_dewasa_pdf', $data);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isJavascriptEnabled' => true]);
        $pdf = PDF::loadView('erm.rawat_inap.early_warning_scoring_system_dewasa_pdf', $data)->setPaper('A4');
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . request('dokumen') . ' Early Warning Scoring System (Dewasa).pdf"',
        ]);
    }

    function asesmen_awal_pasien_rawat_inap_neonatus(Request $req, ErmRanapService $ers)
    {
        $data = $ers->data_asesmen_awal_pasien_ranap_neonatus($req);
        return view('erm.rawat_inap.asesmen_awal_pasien_rawat_inap_neonatus', $data);
    }

    function update_smis_doc_asesmen_awal_pasien_ranap_neonatus(Request $req, ErmRanapService $ers, DokumenKunjunganService $dks)
    {
        try {
            if (isset($req->pass) && $req->pass != '') {
                if (md5($req->pass) != Auth::user()->password) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Password anda salah'
                    ]);
                }
                if ($req->tipe_verif == 'dokter') {
                    $dks->verifikasi_dokumen($req);
                } else {
                    Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus::where('id_dokumen', $req->dokumen)->update([
                        'id_perawat_verif' => Auth::user()->id,
                        'nama_perawat_verif' => Auth::user()->realname,
                    ]);
                }
            }
            $ers->store_asesmen_awal_pasien_ranap_neonatus($req);
            if (isset($req->pass) && $req->pass != '') {
                $dokumen = DokumenKunjungan::where('id', $req->dokumen)->first();
                $neonatus = Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus::where('id_dokumen', $req->dokumen)->first();
                return response()->json([
                    'status' => true,
                    'message' => 'Dokumen berhasil diverifikasi',
                    'neonatus' => Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus::where('id_dokumen', $req->dokumen)->first(),
                    'dokumen' => DokumenKunjungan::where('id', $req->dokumen)->first(),
                    'employee' => SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first(),
                    'perawat' => SmisHrdEmployee::where('nama', $neonatus->nama_perawat_verif)->first()
                ]);
            } else {
                $dokumen = DokumenKunjungan::where('id', $req->dokumen)->first();
                $neonatus = Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus::where('id_dokumen', $req->dokumen)->first();
                return response()->json([
                    'status' => true,
                    'message' => 'Update dokumen neonatus berhasil',
                    'neonatus' => Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus::where('id_dokumen', $req->dokumen)->first(),
                    'dokumen' => DokumenKunjungan::where('id', $req->dokumen)->first(),
                    'employee' => SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first(),
                    'perawat' => SmisHrdEmployee::where('nama', $neonatus->nama_perawat_verif)->first()
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function observasi_cairan()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                    'smis_rg_layananpasien.last_ruangan'
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $data['data'] = SmisDocObservasiCairan::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocObservasiCairan();

            $data['attributes'] = [
                'Cairan Masuk' => [
                    'Intravena' => [
                        'Jam',
                        'CC',
                        'Jenis Cairan',
                        'CCMSK'
                    ],
                    'Oral' => [
                        'Minum',
                        'Makan',
                        'Sonde'
                    ],
                ],
                'Cairan Keluar' => [
                    'Jam',
                    'Urine',
                    'Muntah',
                    'BAB',
                    'NGT',
                    'Drain'
                ],
            ];

            return view('erm.rawat_inap.observasi_cairan', $data);
        } else {
            $validator = Validator::make(request()->all(), [
                'dokumen' => 'required',
                'action' => 'required|in:save,delete',
                'index' => 'required_if:action,delete',
                'tanggal_pelaksanaan' => 'required',
                'pagi' => 'nullable|array',
                'sore' => 'nullable|array',
                'malam' => 'nullable|array',
            ], [
                'dokumen.required' => 'Dokumen tidak valid',
                'action.required' => 'Aksi tidak valid',
                'tanggal_pelaksanaan' => 'Tanggal Pelaksanaan harus diisi',
                'pagi.array' => 'Input tidak valid',
                'sore.array' => 'Input tidak valid',
                'malam.array' => 'Input tidak valid',
            ]);

            if ($validator->fails()) {
                if (request()->ajax()) {
                    return response($validator->errors()->first() ?? "Input tidak valid", 422);
                }
                return redirect()->back()->withErrors($validator->getMessageBag());
            }

            try {
                DB::transaction(function () {
                    $data = SmisDocObservasiCairan::where('id_dokumen', request('dokumen'))->first();
                    if (!$data) {
                        $data = new SmisDocObservasiCairan();
                        $data->id_dokumen = request('dokumen');
                    }
                    $data->tanggal_pelaksanaan = Carbon::createFromFormat('d/m/Y', request('tanggal_pelaksanaan'));
                    if (request()->has('cairan_masuk')) $data->cairan_masuk = request('cairan_masuk');
                    if (request()->has('cairan_keluar')) $data->cairan_keluar = request('cairan_keluar');
                    if (request()->has('diuresis_24_jam')) $data->diuresis_24_jam = request('diuresis_24_jam');
                    if (request()->has('iwl_24_jam')) $data->iwl_24_jam = request('iwl_24_jam');
                    if (request()->has('balance_cairan')) $data->balance_cairan = request('balance_cairan');
                    foreach (['pagi', 'sore', 'malam'] as $waktu) {
                        if (request()->has($waktu)) {
                            $temp = $data->{$waktu} ?? [];
                            if (request('action') == 'save') {
                                foreach (request($waktu) as $key => $value) {
                                    $temp[$key] = $value;
                                }
                            } else {
                                unset($temp[request('index')]);

                                $temp = array_values($temp);
                            }
                            $data->{$waktu} = $temp;
                        }
                    }
                    $data->save();

                    DokumenKunjungan::updateOrCreate([
                        'id' => request('dokumen'),
                    ], [
                        'status' => true,
                        'id_verifikator' => auth()->user()->id,
                        'nama_verifikator' => auth()->user()->realname,
                    ]);
                });

                if (request()->ajax()) return response("Data berhasil disimpan");
                return redirect()->back()->withMessage('message', 'Data berhasil disimpan');
            } catch (\Throwable $th) {
                Log::error($th->getMessage(), $th->getTrace());
                if (request()->ajax()) return response($th->getMessage(), 500);
                return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            }
        }
    }

    public function pdf_observasi_cairan()
    {
        if (!request()->has('dokumen')) abort(404);

        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
            ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
            ->firstOrFail();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $detail =
            SmisDocObservasiCairan::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocObservasiCairan();
        $data['data'] = $detail;

        $data['attributes'] = [
            'Cairan Masuk' => [
                'Intravena' => [
                    'Jam',
                    'CC',
                    'Jenis Cairan',
                    'CCMSK'
                ],
                'Oral' => [
                    'Minum',
                    'Makan',
                    'Sonde'
                ],
            ],
            'Cairan Keluar' => [
                'Jam',
                'Urine',
                'Muntah',
                'BAB',
                'NGT',
                'Drain'
            ],
        ];

        $data['getTotalRow'] = function ($waktu, $jenis, $kategori, $subkategori = null) use ($detail) {
            $total = 0;
            if ($detail && $detail->{$waktu} && is_array($detail->{$waktu})) {
                foreach ($detail->{$waktu} as $item) {
                    $value = null;
                    if (is_null($subkategori)) {
                        $value = $item[$jenis][$kategori];
                    } else {
                        $value = $item[$jenis][$kategori][$subkategori];
                    }
                    Log::debug('getTotalRow: ' . json_encode($item) . ' ' . $value);
                    if (!is_null($value) && !is_nan($value)) $total += $value;
                }
            }
            return $total != 0 ? $total : '';
        };

        // return view('erm.rawat_inap.observasi_cairan', $data);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isJavascriptEnabled' => true]);
        $pdf = PDF::loadView('erm.rawat_inap.observasi_cairan_pdf', $data)->setPaper('A4');
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . request('dokumen') . ' Observasi Cairan.pdf"',
        ]);
    }

    public function checklist_keselamatan_pasien_operasi()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                    'smis_rg_layananpasien.last_ruangan'
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $data['data'] = SmisDocChecklistKeselamatanPasienOperasi::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocChecklistKeselamatanPasienOperasi();

            $data['sign_in_checklist'] = [
                'Pasien sudah dikonfirmasi:' => [
                    'Identifikasi dan gelang pasien',
                    'Lokasi operasi',
                    'Prosedur',
                    'Surat Ijin Operasi',
                ],
                'Lokasi operasi sudah diberi tanda',
                'Mesin dan obat - obat anastesi sudah dicek lengkap',
                'Pulse Oksimetri sudah terpasang dan berfungsi?',
                'Apakah pasien memiliki riwayat alergi?',
                'Kesulitan bernafas, resiko aspirasi, dan menggunakan respiratory bantuan',
                'Resiko kehilangan darah > 500 ml (7ml KgBB pada anak?)',
                '2 akses intravena, akses sentral, dan rencana terapi ciran',
            ];

            $data['time_out_checklist'] = [
                [
                    'label' => 'Konfirmasi seluruh anggota tim, memperkenalkan dan menjelaskan perannya masing-masing',
                    'input' => 'radio',
                ],
                [
                    'label' => 'Dokter bedah, dokter anastesi, dan perawat melakukan konfirmasi secara verbal:',
                    'subitem' => [
                        [
                            'label' => 'Nama Pasien',
                            'input' => 'radio',
                        ],
                        [
                            'label' => 'Prosedur',
                            'input' => 'radio',
                        ],
                        [
                            'label' => 'Lokasi dimana diinsisi',
                            'input' => 'radio',
                        ],
                    ],
                ],
                [
                    'label' => 'Apakah antibiotic profilaksi sudah diberikan 30 menit sebelumnya?',
                    'subitem' => [
                        [
                            'label' => 'Nama antibiotic yang diberikan:',
                            'input' => 'text',
                        ],
                        [
                            'label' => 'Dosis antibiotic yang diberikan:',
                            'input' => 'text',
                        ],
                    ],
                ],
                [
                    'label' => 'Antisipasi kejadian kritis:',
                    'subitem' => [
                        [
                            'label' => 'Review dokter bedah, langkah apa yang akan dilakukan bila kondisi kritis atau kejadian yang tidak diharapkan, lamanya operasi, antisipasi kehilangan darah.',
                            'input' => 'text',
                        ],
                        [
                            'label' => 'Review tim anastesi apakah ada hal khusus yang perlu diperhatikan pada pasien.',
                            'input' => 'text',
                        ],
                        [
                            'label' => 'Review tim perawat apakah peralatan sudah steril, adakah alat yang perlu diperhatikan khusus atau dalam masalah.',
                            'input' => 'radio',
                        ],
                    ],
                ],
                [
                    'label' => 'Apakah foto Rontgen/CT scan dan MRI telah ditayangkan?',
                    'input' => 'radio'
                ],
            ];

            $data['sign_out_checklist'] = [
                [
                    'index' => '1',
                    'label' => 'Perawat melakukan konfirmasi secara verbal dengan tim:',
                    'subitem' => [
                        [
                            'index' => 'a',
                            'label' => 'Nama tindakan dicatat',
                            'input' => 'radio',
                        ],
                        [
                            'index' => 'b',
                            'label' => 'Specimen sudah diberikan label (atasnama pasien dan asal jaringan specimen)?',
                            'input' => 'radio',
                        ],
                        [
                            'index' => 'c',
                            'label' => 'Instrumen, kasa dan jarum sudah dihitung dengan benar?',
                            'input' => 'radio',
                        ],
                        [
                            'index' => 'd',
                            'label' => 'Kassa,',
                            'input' => 'radio',
                        ],
                        [
                            'index' => '',
                            'label' => 'Jarum,',
                            'input' => 'radio',
                        ],
                        [
                            'index' => '',
                            'label' => 'Instrumen',
                            'input' => 'radio',
                        ],
                        [
                            'index' => 'e',
                            'label' => 'Adakah masalah perawatan selama operasi?',
                            'input' => 'radio',
                        ],
                    ],
                ],
                [
                    'index' => '2',
                    'label' => 'Operator dokter bedah, dokter anastesi, dan perawat melakukan riview masalah utama apa yang harus diperhatikan, penyembuhan, dan managemen pasien berikutnya.',
                ],
                [
                    'index' => '',
                    'label' => 'Hal yang harus diperhatikan:',
                    'input' => 'textarea',
                ],
            ];

            return view('erm.rawat_inap.checklist_keselamatan_pasien_operasi', $data);
        } else {
            request()->validate([
                'action' => 'required|in:Simpan,Verifikasi',
                'password' => 'required_if:action,Verifikasi',
                'role' => 'required_if:action,Verifikasi',
            ]);

            if (Str::lower(request('action')) == 'verifikasi' && md5(request('password')) != auth()->user()->password) {
                return redirect()->back()->withErrors(['password' => 'Password Anda tidak sesuai, silahkan coba lagi.']);
            }

            $update = [];

            if (request()->has('tanggal')) $update['tanggal'] = Carbon::createFromFormat('d/m/Y', request('tanggal'))->toDateString();
            if (request()->has('sign_in_jam')) $update['sign_in_jam'] = Carbon::createFromFormat('H:i', request('sign_in_jam'))->toTimeString();
            if (request()->has('time_out_jam')) $update['time_out_jam'] = Carbon::createFromFormat('H:i', request('time_out_jam'))->toTimeString();
            if (request()->has('sign_out_jam')) $update['sign_out_jam'] = Carbon::createFromFormat('H:i', request('sign_out_jam'))->toTimeString();
            if (request()->has('sign_in_checklist') && is_array(request('sign_in_checklist'))) $update['sign_in_checklist'] = request('sign_in_checklist');
            if (request()->has('time_out_checklist') && is_array(request('time_out_checklist'))) $update['time_out_checklist'] = request('time_out_checklist');
            if (request()->has('sign_out_checklist') && is_array(request('sign_out_checklist'))) $update['sign_out_checklist'] = request('sign_out_checklist');

            if (Str::lower(request('action')) == 'verifikasi' && request('role') != null) {
                if (request('role') == 'sign_in_status_perawat_sirkuler') {
                    $update['sign_in_status_perawat_sirkuler'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_in_status_perawat_sirkuler')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_in_status_perawat_sirkuler')] = auth()->user()->realname;
                } else if (request('role') == 'sign_in_status_perawat_sirkuler') {
                    $update['sign_in_status_perawat_sirkuler'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_in_status_perawat_sirkuler')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_in_status_perawat_sirkuler')] = auth()->user()->realname;
                } else if (request('role') == 'sign_in_status_dokter_anastesi') {
                    $update['sign_in_status_dokter_anastesi'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_in_status_dokter_anastesi')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_in_status_dokter_anastesi')] = auth()->user()->realname;
                } else if (request('role') == 'sign_in_status_dokter_anastesi') {
                    $update['sign_in_status_dokter_anastesi'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_in_status_dokter_anastesi')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_in_status_dokter_anastesi')] = auth()->user()->realname;
                } else if (request('role') == 'time_out_status_perawat_sirkuler') {
                    $update['time_out_status_perawat_sirkuler'] = true;
                    $update[Str::replace('_status_', '_id_', 'time_out_status_perawat_sirkuler')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'time_out_status_perawat_sirkuler')] = auth()->user()->realname;
                } else if (request('role') == 'time_out_status_perawat_sirkuler') {
                    $update['time_out_status_perawat_sirkuler'] = true;
                    $update[Str::replace('_status_', '_id_', 'time_out_status_perawat_sirkuler')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'time_out_status_perawat_sirkuler')] = auth()->user()->realname;
                } else if (request('role') == 'time_out_status_perawat_instrumen') {
                    $update['time_out_status_perawat_instrumen'] = true;
                    $update[Str::replace('_status_', '_id_', 'time_out_status_perawat_instrumen')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'time_out_status_perawat_instrumen')] = auth()->user()->realname;
                } else if (request('role') == 'time_out_status_perawat_instrumen') {
                    $update['time_out_status_perawat_instrumen'] = true;
                    $update[Str::replace('_status_', '_id_', 'time_out_status_perawat_instrumen')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'time_out_status_perawat_instrumen')] = auth()->user()->realname;
                } else if (request('role') == 'sign_out_status_dokter_bedah') {
                    $update['sign_out_status_dokter_bedah'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_out_status_dokter_bedah')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_out_status_dokter_bedah')] = auth()->user()->realname;
                } else if (request('role') == 'sign_out_status_dokter_bedah') {
                    $update['sign_out_status_dokter_bedah'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_out_status_dokter_bedah')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_out_status_dokter_bedah')] = auth()->user()->realname;
                } else if (request('role') == 'sign_out_status_dokter_anastesi') {
                    $update['sign_out_status_dokter_anastesi'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_out_status_dokter_anastesi')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_out_status_dokter_anastesi')] = auth()->user()->realname;
                } else if (request('role') == 'sign_out_status_dokter_anastesi') {
                    $update['sign_out_status_dokter_anastesi'] = true;
                    $update[Str::replace('_status_', '_id_', 'sign_out_status_dokter_anastesi')] = auth()->user()->id;
                    $update[Str::replace('_status_', '_nama_', 'sign_out_status_dokter_anastesi')] = auth()->user()->realname;
                }
            }

            try {
                DB::transaction(function () use ($update) {
                    SmisDocChecklistKeselamatanPasienOperasi::updateOrCreate([
                        'id_dokumen' => request('dokumen'),
                    ], $update);

                    if (Str::lower(request('action')) == 'verifikasi') {
                        DokumenKunjungan::updateOrCreate([
                            'id' => request('dokumen'),
                        ], [
                            'status' => true,
                            'id_verifikator' => auth()->user()->id,
                            'nama_verifikator' => auth()->user()->realname,
                        ]);
                    }
                });

                return redirect()->back()->with('message', 'Berhasil ' . request('action'));
            } catch (\Throwable $th) {
                Log::error($th->getMessage(), $th->getTrace());
                return redirect()->back()->withErrors(['data' => 'Gagal ' . request('action') . '. error: ' . $th->getMessage()]);
            }
        }
    }

    public function pdf_checklist_keselamatan_pasien_operasi()
    {
        if (!request()->has('dokumen')) abort(404);

        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
            ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
            ->firstOrFail();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['data'] = SmisDocChecklistKeselamatanPasienOperasi::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocChecklistKeselamatanPasienOperasi();

        $data['sign_in_checklist'] = [
            'Pasien sudah dikonfirmasi:' => [
                'Identifikasi dan gelang pasien',
                'Lokasi operasi',
                'Prosedur',
                'Surat Ijin Operasi',
            ],
            'Lokasi operasi sudah diberi tanda',
            'Mesin dan obat - obat anastesi sudah dicek lengkap',
            'Pulse Oksimetri sudah terpasang dan berfungsi?',
            'Apakah pasien memiliki riwayat alergi?',
            'Kesulitan bernafas, resiko aspirasi, dan menggunakan respiratory bantuan',
            'Resiko kehilangan darah > 500 ml (7ml KgBB pada anak?)',
            '2 akses intravena, akses sentral, dan rencana terapi ciran',
        ];

        $data['time_out_checklist'] = [
            [
                'label' => 'Konfirmasi seluruh anggota tim, memperkenalkan dan menjelaskan perannya masing-masing',
                'input' => 'radio',
            ],
            [
                'label' => 'Dokter bedah, dokter anastesi, dan perawat melakukan konfirmasi secara verbal:',
                'subitem' => [
                    [
                        'label' => 'Nama Pasien',
                        'input' => 'radio',
                    ],
                    [
                        'label' => 'Prosedur',
                        'input' => 'radio',
                    ],
                    [
                        'label' => 'Lokasi dimana diinsisi',
                        'input' => 'radio',
                    ],
                ],
            ],
            [
                'label' => 'Apakah antibiotic profilaksi sudah diberikan 30 menit sebelumnya?',
                'subitem' => [
                    [
                        'label' => 'Nama antibiotic yang diberikan:',
                        'input' => 'text',
                    ],
                    [
                        'label' => 'Dosis antibiotic yang diberikan:',
                        'input' => 'text',
                    ],
                ],
            ],
            [
                'label' => 'Antisipasi kejadian kritis:',
                'subitem' => [
                    [
                        'label' => 'Review dokter bedah, langkah apa yang akan dilakukan bila kondisi kritis atau kejadian yang tidak diharapkan, lamanya operasi, antisipasi kehilangan darah.',
                        'input' => 'text',
                    ],
                    [
                        'label' => 'Review tim anastesi apakah ada hal khusus yang perlu diperhatikan pada pasien.',
                        'input' => 'text',
                    ],
                    [
                        'label' => 'Review tim perawat apakah peralatan sudah steril, adakah alat yang perlu diperhatikan khusus atau dalam masalah.',
                        'input' => 'radio',
                    ],
                ],
            ],
            [
                'label' => 'Apakah foto Rontgen/CT scan dan MRI telah ditayangkan?',
                'input' => 'radio'
            ],
        ];

        $data['sign_out_checklist'] = [
            [
                'index' => '1',
                'label' => 'Perawat melakukan konfirmasi secara verbal dengan tim:',
                'subitem' => [
                    [
                        'index' => 'a',
                        'label' => 'Nama tindakan dicatat',
                        'input' => 'radio',
                    ],
                    [
                        'index' => 'b',
                        'label' => 'Specimen sudah diberikan label (atasnama pasien dan asal jaringan specimen)?',
                        'input' => 'radio',
                    ],
                    [
                        'index' => 'c',
                        'label' => 'Instrumen, kasa dan jarum sudah dihitung dengan benar?',
                        'input' => 'radio',
                    ],
                    [
                        'index' => 'd',
                        'label' => 'Kassa,',
                        'input' => 'radio',
                    ],
                    [
                        'index' => '',
                        'label' => 'Jarum,',
                        'input' => 'radio',
                    ],
                    [
                        'index' => '',
                        'label' => 'Instrumen',
                        'input' => 'radio',
                    ],
                    [
                        'index' => 'e',
                        'label' => 'Adakah masalah perawatan selama operasi?',
                        'input' => 'radio',
                    ],
                ],
            ],
            [
                'index' => '2',
                'label' => 'Operator dokter bedah, dokter anastesi, dan perawat melakukan riview masalah utama apa yang harus diperhatikan, penyembuhan, dan managemen pasien berikutnya.',
            ],
            [
                'index' => '',
                'label' => 'Hal yang harus diperhatikan:',
                'input' => 'textarea',
            ],
        ];

        // return view('erm.rawat_inap.checklist_keselamatan_pasien_operasi', $data);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isJavascriptEnabled' => true]);
        $pdf = PDF::loadView('erm.rawat_inap.checklist_keselamatan_pasien_operasi_pdf', $data)->setPaper('Legal', 'landscape');
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=" . request('dokumen') . " Checklist Keselamatan Pasien Operasi.pdf",
        ]);
    }

    function dokumen_laporan_pembedahan(Request $req)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->first();
        $data['dokumen'] = $dokumen;
        $data['data'] = Smis_Doc_Laporan_Pembedahan::where('id_dokumen', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        return view('erm.rawat_inap.dokumen_laporan_pembedahan', $data);
    }

    function dokumen_laporan_pembedahan_store(Request $req)
    {
        try {
            $data = Smis_Doc_Laporan_Pembedahan::where('id_dokumen', $req->dokumen)->first();
            $lampiran_pembedahan = $data ? $data->lampiran_pembedahan : '';

            if ($req->hasFile('lampiran_pembedahan')) {
                $file = $req->file('lampiran_pembedahan');
                $tujuan_upload = 'lampiran_pembedahan';
                $lampiran_pembedahan = time() . $file->getClientOriginalName();
                $file->move($tujuan_upload, $lampiran_pembedahan);
            }

            Smis_Doc_Laporan_Pembedahan::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'id_dokter_operator' => $req->id_dokter_operator ? $req->id_dokter_operator : 0,
                'dokter_operator' => $req->dokter_operator ? $req->dokter_operator : '',
                'id_asisten_operator' => $req->id_asisten_operator ? $req->id_asisten_operator : 0,
                'asisten_operator' => $req->asisten_operator ? $req->asisten_operator : '',
                'id_instrumen' => $req->id_instrumen ? $req->id_instrumen : 0,
                'instrumen' => $req->instrumen ? $req->instrumen : '',
                'id_spesialis_anestesi' => $req->id_spesialis_anestesi ? $req->id_spesialis_anestesi : 0,
                'spesialis_anestesi' => $req->spesialis_anestesi ? $req->spesialis_anestesi : '',
                'id_asisten_anestesi' => $req->id_asisten_anestesi ? $req->id_asisten_anestesi : 0,
                'asisten_anestesi' => $req->asisten_anestesi ? $req->asisten_anestesi : '',
                'id_jenis_anestesi' => $req->id_jenis_anestesi ? $req->id_jenis_anestesi : 0,
                'jenis_anestesi' => $req->jenis_anestesi ? $req->jenis_anestesi : '',
                'diagnosis_pasca_bedah' => $req->diagnosis_pasca_bedah ? $req->diagnosis_pasca_bedah : '',
                'tindakan' => $req->tindakan ? $req->tindakan : '',
                'indikasi_operasi' => $req->indikasi_operasi ? $req->indikasi_operasi : '',
                'posisi' => $req->posisi ? $req->posisi : '',
                'jenis_pembedahan' => $req->jenis_pembedahan ? $req->jenis_pembedahan : '',
                'jenis_pembedahan_rencana' => $req->jenis_pembedahan_rencana ? $req->jenis_pembedahan_rencana : '',
                'jenis_luka_operasi' => $req->jenis_luka_operasi ? $req->jenis_luka_operasi : '',
                'tanggal' => date('Y-m-d', strtotime($req->tanggal)),
                'mulai' => $req->mulai,
                'selesai' => $req->selesai,
                'lama_pembedahan' => $req->lama_pembedahan ? $req->lama_pembedahan : '',
                'laporan_pembedahan' => $req->laporan_pembedahan ? $req->laporan_pembedahan : '',
                'lampiran_pembedahan' => $lampiran_pembedahan,
                'dikirim_pa' => $req->dikirim_pa ? $req->dikirim_pa : '',
                'no_batch' => $req->no_batch ? $req->no_batch : '',
                'komplikasi' => $req->komplikasi ? $req->komplikasi : '',
                'pendarahan' => $req->pendarahan ? $req->pendarahan : '',
                'asal_jaringan' => $req->asal_jaringan ? $req->asal_jaringan : '',
                'diagnosa_pra_bedah' => $req->diagnosa_pra_bedah ? $req->diagnosa_pra_bedah : ''
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
    }

    function asesmen_awal_keperawatan_geriatri(Request $req)
    {
        $data['list_ruangan'] = SmisAdmPrototype::where('prop', '')->where(function ($q) {
            $q->where('jenis_ruangan', 'like', '%urji%')->orWhere('jenis_ruangan', 'like', '%uri%');
        })->get();
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['data'] = DB::table('smis_doc_asesmen_awal_keperawatan_geriatri')->where('id_dokumen', $req->dokumen)->first();
        $user = DB::table('smis_adm_user')->where('id', $dokumen->id_verifikator)->where('prop', '')->first();
        $data['employee'] = $user ? DB::table('smis_hrd_employee')->where('username', $user->username)->where('prop', '')->first() : null;
        $data['dokumen'] = $dokumen;
        return view('e_rekam_medis/rawat_inap/asesmen_awal_keperawatan_rawat_inap_geriatri', $data);
    }

    function asesmen_awal_keperawatan_geriatri_store(Request $req, ErmRanapService $ers, DokumenKunjunganService $dks)
    {
        try {
            $ers->save_asesmen_awal_keperawatan_geriatri($req);
            $dks->verifikasi_dokumen($req);
            return response()->json([
                'status' => true,
                'message' => 'Dokumen berhasil disimpan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function observasi_bayi(Request $req)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['data'] = Smis_Doc_Observasi_Bayi::where('id_dokumen', $dokumen->id)->get();
        $data['dokumen'] = $dokumen;
        $data['layanan'] = SMIS_LayananPasien::where('prop', '')->where('id', $dokumen->noreg)->first();
        $data['ttv'] = Smis_Mr_Tanda_Vital::where('prop', '')->where('noreg_pasien', $dokumen->noreg)->first();
        return view('erm.rawat_inap.observasi_bayi', $data);
    }

    function observasi_bayi_store(Request $req)
    {
        try {
            Smis_Doc_Observasi_Bayi::create([
                'id_dokumen' => $req->dokumen,
                'bb' => $req->bb ? $req->bb : '',
                'pb' => $req->pb ? $req->pb : '',
                'tanggal' => $req->tanggal ? $req->tanggal : date('Y-m-d'),
                'jam' => $req->jam ? $req->jam : date('H:i'),
                'suhu' => $req->suhu ? $req->suhu : '',
                'rr' => $req->rr ? $req->rr : '',
                'nadi' => $req->nadi ? $req->nadi : '',
                'minum' => $req->minum ? $req->minum : '',
                'muntah' => $req->muntah ? $req->muntah : '',
                'meco' => $req->meco ? $req->meco : '',
                'miksi' => $req->miksi ? $req->miksi : '',
                'keterangan' => $req->keterangan ? $req->keterangan : '',
                'id_perawat' => $req->id_perawat ? $req->id_perawat : 0,
                'perawat' => $req->perawat ? $req->perawat : '',
            ]);

            $data = Smis_Doc_Observasi_Bayi::where('id_dokumen', $req->dokumen)->get();

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Tambah data berhasil',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function dokumen_laporan_pembedahan_verifikasi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            DokumenKunjungan::findOrFail($req->dokumen);
            if (Auth::user()->password != md5($req->password)) {
                return redirect()->back()->with('message', 'Password anda salah');
            }

            $dks->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/dokumen_laporan_pembedahan?dokumen=' . $req->dokumen)->with('message', 'Berhasil Verifikasi Dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    function surat_pengantar_persiapan_tindakan_operasi(Request $req)
    {
        $dokumen = DokumenKunjungan::where('prop', '')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->first();
        $data['dokumen'] = $dokumen;
        $data['data'] = Smis_Doc_Surat_Pengantar_Persiapan_Tindakan_Operasi::where('id_dokumen', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        return view('erm.rawat_inap.surat_pengantar_persiapan_tindakan_operasi', $data);
    }

    function surat_pengantar_persiapan_tindakan_operasi_store(Request $req)
    {
        try {
            Smis_Doc_Surat_Pengantar_Persiapan_Tindakan_Operasi::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'atas_indikasi' => $req->atas_indikasi ? $req->atas_indikasi : '',
                'tindakan' => $req->tindakan ? $req->tindakan : '',
                'tanggal' => $req->tanggal,
                'ranap' => $req->ranap == 'ranap' ? 1 : 0,
                'tidak_dirawat' => $req->ranap == 'tidak_rawat' ? 1 : 0,
                'pemeriksaan_penunjang' => $req->pemeriksaan_penunjang ? $req->pemeriksaan_penunjang : ''
            ]);
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Dokumen berhasil disimpan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function observasi_bayi_select(Request $req)
    {
        $data = Smis_Doc_Observasi_Bayi::where('id', $req->id)->first();
        return response()->json($data);
    }

    function observasi_bayi_update(Request $req)
    {
        try {
            Smis_Doc_Observasi_Bayi::where('id', $req->id)->update([
                'bb' => $req->bb ? $req->bb : '',
                'pb' => $req->pb ? $req->pb : '',
                'tanggal' => $req->tanggal ? $req->tanggal : date('Y-m-d'),
                'jam' => $req->jam ? $req->jam : date('H:i'),
                'suhu' => $req->suhu ? $req->suhu : '',
                'rr' => $req->rr ? $req->rr : '',
                'nadi' => $req->nadi ? $req->nadi : '',
                'minum' => $req->minum ? $req->minum : '',
                'muntah' => $req->muntah ? $req->muntah : '',
                'meco' => $req->meco ? $req->meco : '',
                'miksi' => $req->miksi ? $req->miksi : '',
                'keterangan' => $req->keterangan ? $req->keterangan : '',
                'id_perawat' => $req->id_perawat ? $req->id_perawat : 0,
                'perawat' => $req->perawat ? $req->perawat : '',
            ]);

            $data = Smis_Doc_Observasi_Bayi::where('id_dokumen', $req->dokumen)->get();

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Update data berhasil',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function surat_pengantar_persiapan_tindakan_operasi_verifikasi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            DokumenKunjungan::findOrFail($req->dokumen);
            if (Auth::user()->password != md5($req->password)) {
                return redirect()->back()->with('message', 'Password anda salah');
            }

            $dks->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/surat_pengantar_persiapan_tindakan_operasi?dokumen=' . $req->dokumen)->with('message', 'Berhasil Verifikasi Dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    function observasi_bayi_delete(Request $req)
    {
        Smis_Doc_Observasi_Bayi::where('id', $req->id)->delete();
        $data = Smis_Doc_Observasi_Bayi::where('id_dokumen', $req->dokumen)->get();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Hapus data berhasil',
            'data' => $data
        ]);
        return response()->json($data);
    }

    function formulir_penandaan_lokasi_operasi(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $data['data'] = DB::table('smis_doc_formulir_penandaan_lokasi_operasi')->where('id_dokumen', $req->dokumen)->first();
        $user = DB::table('smis_adm_user')->where('id', $dokumen->id_verifikator)->where('prop', '')->first();
        $data['employee'] = $user ? SmisHrdEmployee::where('username', $user->username)->where('prop', '')->first() : null;
        $data['dokumen'] = $dokumen;
        return view('erm.rawat_inap.formulir_penandaan_lokasi_operasi', $data);
    }

    function formulir_penandaan_lokasi_operasi_tanda_tangan(Request $req, ErmRanapService $ers)
    {
        try {
            $ers->tanda_tangan_formulir_penandaan_lokasi_operasi($req);

            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', 'Tanda tangan dokumen berhasil');
        } catch (\Exception $th) {
            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', $th->getMessage());
        }
    }

    function formulir_penandaan_lokasi_operasi_store(Request $req, ErmRanapService $ers)
    {
        try {
            $ers->formulir_penandaan_lokasi_operasi_store($req);

            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', 'Update dokumen berhasil');
        } catch (\Exception $th) {
            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', $th->getMessage());
        }
    }

    function formulir_penandaan_lokasi_operasi_gambar_ulang(Request $req, ErmRanapService $ers)
    {
        try {
            $data = DB::table('smis_doc_formulir_penandaan_lokasi_operasi')->where('id_dokumen', $req->dokumen)->first();
            unlink('penandaan_lokasi_operasi/' . $data->lokasi_operasi);
            DB::table('smis_doc_formulir_penandaan_lokasi_operasi')->where('id_dokumen', $req->dokumen)->update([
                'lokasi_operasi' => ''
            ]);

            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', 'Silahkan gambar ulang dan simpan');
        } catch (\Exception $th) {
            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', $th->getMessage());
        }
    }

    function formulir_penandaan_lokasi_operasi_verifikasi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password != md5($req->pass)) {
                return redirect()->back()->with('message', 'Password anda salah');
            }
            $dks->verifikasi_dokumen($req);
            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', 'Verifikasi dokumen berhasil');
        } catch (\Throwable $th) {
            return redirect('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi?dokumen=' . $req->dokumen)->with('message', $th->getMessage());
        }
    }

    public function pemantauan_tanda_tanda_vital()
    {
        if (!request()->has('dokumen')) abort(404);

        if (request()->isMethod('GET')) {
            $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();
            $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                    'smis_rg_layananpasien.last_ruangan'
                )
                ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
                ->first();
            $detail = SmisDocPemantauanTandaTandaVital::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocPemantauanTandaTandaVital();
            $data['data'] = $detail;
            $data['ruangan'] = SmisAdmPrototype::whereIn('jenis_ruangan', ['URI', 'URJ'])->orderBy('jenis_ruangan')->orderBy('nama')->pluck('nama')->toArray();

            $tanggal = [];
            if ($detail && $detail->checklist && is_array($detail->checklist)) {
                $temp = [];
                foreach ($detail->checklist as $item) {
                    $temp[] = ["tanggal" => Carbon::parse($item["tanggal"])->format('d/m/Y'), "ruang_rawat" => $item["ruang_rawat"]];
                }
                foreach (array_unique($temp, SORT_REGULAR) as $tgl) $tanggal[] = $tgl;
            }
            $data['tanggal'] = $tanggal;
            $data['getValue'] = function ($tanggal = null, $waktu = null, $attribute) use ($detail) {
                if (!is_null($tanggal) && !is_null($waktu) && $detail && $detail->checklist && is_array($detail->checklist)) {
                    $checklist = collect($detail->checklist);
                    $filter = $checklist->filter(function ($item) use ($tanggal, $waktu) {
                        return $item['tanggal'] == Carbon::createFromFormat('d/m/Y', $tanggal)->toDateString() && $item['waktu'] == $waktu;
                    })->first();
                    if ($filter && isset($filter[Str::lower($attribute)])) return $filter[Str::lower($attribute)];
                }
                return null;
            };
            $data['checkmark'] = function ($tanggal = null, $waktu = null, $attribute, $value) use ($detail) {
                if (!is_null($tanggal) && !is_null($waktu) && $detail && $detail->checklist && is_array($detail->checklist)) {
                    $checklist = collect($detail->checklist);
                    $filter = $checklist->filter(function ($item) use ($tanggal, $waktu) {
                        return $item['tanggal'] == Carbon::createFromFormat('d/m/Y', $tanggal)->toDateString() && $item['waktu'] == $waktu;
                    })->first();
                    if ($filter) {
                        $checklistValue = $filter[Str::lower($attribute)];
                        if (intval(floor($checklistValue)) == intval(floor($value))) {
                            switch (Str::lower($attribute)) {
                                case 'nadi':
                                    return '<span>&bull;</span>';
                                case 'suhu':
                                    return '<span>&deg;</span>';
                                case 'sistol':
                                    return '<span><sub>v</sub></span>';
                                case 'diastol':
                                    return '<span>^</span>';
                                case 'pernafasan':
                                    return '<span>x</span>';
                                default:
                                    return '';
                            }
                        }
                    }
                }
                return '';
            };

            return view('erm.rawat_inap.pemantauan_tanda_tanda_vital', $data);
        } else {
            // dd(request()->all());

            $dokumen = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
                ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
                ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
                ->firstOrFail();

            $data = SmisDocPemantauanTandaTandaVital::where('id_dokumen', request('dokumen'))->first();
            if (!$data) {
                $data = new SmisDocPemantauanTandaTandaVital();
                $data->id_dokumen = request('dokumen');
            }
            if (request()->has(['tanggal', 'ruang_rawat'])) {
                $tanggal = Carbon::createFromFormat('d/m/Y', request('tanggal'))->toDateString();
                $checklist = $data->checklist ?? [];
                $temp = array_merge(['tanggal' => $tanggal, 'id_operator' => auth()->user()->id], request()->only(['ruang_rawat', 'waktu', 'operator', 'pernafasan', 'nadi', 'suhu', 'sistol', 'diastol']));
                $found = false;
                foreach ($checklist as $key => $item) {
                    if ($item["tanggal"] == $tanggal && $item["ruang_rawat"] == request("ruang_rawat") && $item['waktu'] == request('waktu')) {
                        $checklist[$key] = $temp;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $checklist[] = $temp;
                }
                $data->checklist = $checklist;

                Smis_Mr_Tanda_Vital::updateOrCreate([
                    'prop' => $data->id_dokumen,
                    'ruangan' => Str::slug(request('ruang_rawat'), '_'),
                    'nrm_pasien' => $dokumen->nrm,
                    'nama_pasien' => $dokumen->nama_pasien,
                    'noreg_pasien' => $dokumen->noreg,
                    'waktu' => $tanggal,
                    'profile_number' => request('waktu'),
                ], [
                    'tensi' => request('sistol') . '/' . request('diastol'),
                    'nadi' => request('nadi'),
                    'suhu' => request('suhu'),
                    'rr' => request('pernafasan'),
                ]);
            }

            if (request()->has('BB') || request()->has('TB') || request()->has('LK')) {
                if (request()->has('BB')) $data->berat_badan = request('BB');
                if (request()->has('TB')) $data->tinggi_badan = request('TB');
                if (request()->has('LK')) $data->lingkar_kepala = request('LK');
            }

            Smis_Mr_Tanda_Vital::updateOrCreate([
                'prop' => $data->id_dokumen,
                'nrm_pasien' => $dokumen->nrm,
                'nama_pasien' => $dokumen->nama_pasien,
                'noreg_pasien' => $dokumen->noreg,
            ], [
                'berat_badan' => $data->berat_badan,
                'tinggi_badan' => $data->tinggi_badan,
            ]);

            DokumenKunjungan::updateOrCreate([
                'id' => request('dokumen'),
            ], [
                'status' => true,
                'id_verifikator' => auth()->user()->id,
                'nama_verifikator' => auth()->user()->realname,
            ]);

            $data->save();

            if (request()->ajax()) {
                return response()->json([
                    "status" => "success",
                    "message" => "Data berhasil disimpan.",
                ]);
            }

            return redirect()->back()->with('message', 'Data berhasil disimpan.');
        }
    }

    public function pdf_pemantauan_tanda_tanda_vital()
    {
        if (!request()->has('dokumen')) abort(404);

        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_hrd_employee', 'smis_adm_user.username', 'smis_hrd_employee.username')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_hrd_employee.ttd')
            ->where('dokumen_kunjungan_pasien.id', request('dokumen'))
            ->firstOrFail();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
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
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $detail = SmisDocPemantauanTandaTandaVital::where('id_dokumen', request('dokumen'))->first() ?? new SmisDocPemantauanTandaTandaVital();
        $data['data'] = $detail;

        $tanggal = [];
        if ($detail && $detail->checklist && is_array($detail->checklist)) {
            $temp = [];
            foreach ($detail->checklist as $item) {
                $temp[] = ["tanggal" => Carbon::parse($item["tanggal"])->format('d/m/Y'), "ruang_rawat" => $item["ruang_rawat"]];
            }
            foreach (array_unique($temp, SORT_REGULAR) as $tgl) $tanggal[] = $tgl;
        }
        $data['tanggal'] = $tanggal;
        $data['checkmark'] = function ($tanggal = null, $waktu = null, $attribute, $value) use ($detail) {
            if (!is_null($tanggal) && !is_null($waktu) && $detail && $detail->checklist && is_array($detail->checklist)) {
                $checklist = collect($detail->checklist);
                $filter = $checklist->filter(function ($item) use ($tanggal, $waktu) {
                    return $item['tanggal'] == Carbon::createFromFormat('d/m/Y', $tanggal)->toDateString() && $item['waktu'] == $waktu;
                })->first();
                if ($filter) {
                    $checklistValue = $filter[Str::lower($attribute)];
                    if (intval(floor($checklistValue)) == intval(floor($value))) {
                        switch (Str::lower($attribute)) {
                            case 'nadi':
                                return '<span>&bull;</span>';
                            case 'suhu':
                                return '<span>&deg;</span>';
                            case 'sistol':
                                return '<span><sub>v</sub></span>';
                            case 'diastol':
                                return '<span>^</span>';
                            case 'pernafasan':
                                return '<span>x</span>';
                            default:
                                return '';
                        }
                    }
                }
            }
            return '';
        };

        // return view('erm.rawat_inap.pemantauan_tanda_tanda_vital_pdf', $data);
        PDF::setOptions([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'isJavascriptEnabled' => true,
            'isHtml5ParserEnabled' => true
        ]);
        $pdf = PDF::loadView('erm.rawat_inap.pemantauan_tanda_tanda_vital_pdf', $data)->setPaper('A4');
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . request('dokumen') . ' Observasi Cairan.pdf"',
        ]);
    }

    function laporan_anastesi_dan_sedasi(Request $req, LaporanAnastesiDanSedasiService $dlcs)
    {
        $data = $dlcs->data($req);
        return view('erm.dokumen_kunjungan.laporan_anastesi_dan_sedasi', $data);
    }

    function save_laporan_anastesi_dan_sedasi(Request $req, LaporanAnastesiDanSedasiService $dlcs, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $dlcs->create($req);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/laporan_anastesi_dan_sedasi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function pdf_laporan_anastesi_dan_sedasi(Request $req, LaporanAnastesiDanSedasiService $dlcs)
    {
        $data = $dlcs->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_laporan_anastesi_dan_sedasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function dokumen_partograf(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_partograf')->where('id_dokumen', $dokumen->id)->first();
        return view('erm.rawat_inap.dokumen_partograf', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data
        ]);
    }

    function dokumen_partograf_store(Request $req)
    {
        try {
            // $select = DB::table('smis_doc_partograf')->where('id_dokumen', $req->dokumen)->first();
            // $nama_file = '';
            // if ($req->gambar) {
            //     $folderPath = public_path('gambar_dokumen_partograf/');

            //     $image_parts = explode(";base64,", $req->gambar);

            //     $image_type_aux = explode("image/", $image_parts[0]);

            //     $image_type = $image_type_aux[1];

            //     $image_base64 = base64_decode($image_parts[1]);

            //     $fileName = uniqid() . '.' . $image_type;
            //     $file = $folderPath . $fileName;
            //     $nama_file = $fileName;
            //     file_put_contents($file, $image_base64);
            // }

            // if ($select) {
            //     if ($select->gambar != '' || $select->gambar != null) {
            //         unlink('gambar_dokumen_partograf/' . $select->gambar);
            //     }
            // }

            DB::table('smis_doc_partograf')->updateOrInsert([
                'id_dokumen' => $req->dokumen
            ], [
                // 'gambar' => $req->gambar ? $nama_file : ($select ? $select->gambar : $nama_file),
                'noreg' => $req->noreg ? $req->noreg : '',
                'nama_ibu' => $req->ibu ? $req->ibu : '',
                'umur' => $req->umur ? $req->umur : '',
                'g' => $req->g ? $req->g : '',
                'p' => $req->p ? $req->p : '',
                'a' => $req->a ? $req->a : '',
                'nomor_puskesmas' => $req->no_puskesmas ? $req->no_puskesmas : '',
                'tanggal' => $req->tanggal ? $req->tanggal : '',
                'jam' => $req->jam ? $req->jam : '',
                'alamat' => $req->alamat ? $req->alamat : '',
                'ketuban_pecah_jam' => $req->ketuban_pecah_jam ? $req->ketuban_pecah_jam : '',
                'mutes_jam' => $req->mutes_jam ? $req->mutes_jam : '',
                'tanggal_persalinan' => $req->tanggal_persalinan ? $req->tanggal_persalinan : '',
                'id_bidan' => $req->id_bidan ? $req->id_bidan : 0,
                'nama_bidan' => $req->nama_bidan ? $req->nama_bidan : '',
                'tempat_persalinan' => $req->tempat_persalinan ? $req->tempat_persalinan : '',
                'tempat_persalinan_lain' => $req->tempat_persalinan_lain ? $req->tempat_persalinan_lain : '',
                'alamat_tempat_persalinan' => $req->alamat_tempat_persalinan ? $req->alamat_tempat_persalinan : '',
                'rujuk' => $req->rujuk ? $req->rujuk : '0',
                'kala' => $req->kala ? $req->kala : '',
                'alasan_merujuk' => $req->alasan_merujuk ? $req->alasan_merujuk : '',
                'tempat_rujukan' => $req->tempat_rujukan ? $req->tempat_rujukan : '',
                'pendamping' => $req->pendamping ? $req->pendamping : '',
                'kala_i' => $req->kala_i ? $req->kala_i : '',
                'kala_ii' => $req->kala_ii ? $req->kala_ii : '',
                'kala_iii' => $req->kala_iii ? $req->kala_iii : '',
                'kala_iv' => $req->kala_iv ? $req->kala_iv : '',
                'bayi_baru_lahir' => $req->bayi_baru_lahir ? $req->bayi_baru_lahir : '',
                'denyut_jantung_janin' => $req->denyut_jantung_janin ? $req->denyut_jantung_janin : '',
                'pembukaan_serviks' => $req->pembukaan_serviks ? $req->pembukaan_serviks : '',
                'obat_dan_cairan' => $req->obat_dan_cairan ? $req->obat_dan_cairan : '',
                'ketuban' => $req->ketuban ? $req->ketuban : '',
                'penyusupan' => $req->penyusupan ? $req->penyusupan : '',
                'oksilosin' => $req->oksilosin ? $req->oksilosin : '',
                'kontraksi' => $req->kontraksi ? $req->kontraksi : '',
                'tetes_menit' => $req->tetes_menit ? $req->tetes_menit : '',
                'suhu' => $req->suhu ? $req->suhu : '',
                'urin' => $req->urin ? $req->urin : '',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function dokumen_partograf_hapus_gambar(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        DB::table('smis_doc_partograf')->where('id_dokumen', $dokumen->id)->update([
            'gambar' => ''
        ]);

        return redirect('e_rekam_medis/detail/dokumen_partograf?dokumen=' . $dokumen->id)->with('success', 'Berhasil hapus gambar, silahkan gambar ulang');
    }

    function catatan_perkembangan_pasien_terintegrasi_rawat_inap(Request $req, ErmRanapService $ers)
    {
        $data = $ers->catatan_perkembangan_pasien_terintegrasi_rawat_inap($req);
        return view('erm.rawat_inap.catatan_perkembangan_pasien_terintegrasi_rawat_inap', $data);
    }

    function pdf_catatan_perkembangan_pasien_terintegrasi_rawat_inap(Request $req, ErmRanapService $ers)
    {
        $data['dokumen'] = DokumenKunjungan::where('id', $req->dokumen)->where('prop', '')->first();
        $data['pasien'] = SMIS_Pasien::where('id', $data['dokumen']->nrm)->where('prop', '')->first();
        $data['layanan'] = SMIS_LayananPasien::where('id', $data['dokumen']->noreg)->where('prop', '')->first();
        $data['cppt'] = $ers->data_cppt_ranap($req);
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_catatan_perkembangan_pasien_terintegrasi_rawat_inap');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function create_cppt(Request $req, ErmRanapService $ers)
    {
        try {
            $last_dr = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id_dokumen', $req->dokumen)->where('jenis_ppa', 'dr')->orderBy('id', 'desc')->first();
            $id_diagnosa = $req->jenis_ppa == 'dr' ? $last_dr ? $last_dr->id_diagnosa : 0 : 0;
            $create = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::create([
                'jenis_ppa' => $req->jenis_ppa,
                'tanggal' => date('Y-m-d H:i:s'),
                'id_dokumen' => $req->dokumen,
                'id_diagnosa' => $req->jenis_ppa == 'dr' ? $id_diagnosa : 0
            ]);
            return response()->json([
                'data' => $ers->data_cppt_ranap($req),
                'status' => true,
                'message' => 'Asesmen berhasil dibuat',
                'code' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500
            ]);
        }
    }

    function store_cppt(Request $req, ErmRanapService $ers)
    {
        try {
            $ers->cppt_store($req);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen',
                'code' => 200,
                'data' => $ers->data_cppt_ranap($req),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function download_file_penunjang_eksternal_cppt(Request $req)
    {
        return response()->download(public_path('file_penunjang_eksternal_cppt/' . $req->file));
    }

    function store_diagnosa_cppt(Request $req, ErmRanapService $ers)
    {
        try {
            $ers->cppt_diagnosa_store($req);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil update asesmen',
                'code' => 200,
                // 'data' => $ers->data_cppt_ranap($req),
                'data' => SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])->where('id', $req->id)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function store_lab_cppt(Request $req, ERekamMedisService $erms, ErmRanapService $ers)
    {
        try {
            $select = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->first();
            $update_lab = $erms->lab_pesanan_store_by_id($req);

            if ($select->id_lab != $update_lab->id) {
                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->update([
                    'id_lab' => $update_lab->id
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update pesanan lab',
                'code' => 200,
                // 'data' => $ers->data_cppt_ranap($req),
                'data' => SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])->where('id', $req->id)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function delete_lab_cppt(Request $req, ErmRanapService $ers, JurnalService $js)
    {
        try {
            $pesanan = SMIS_LabPesanan::where('id', $req->id)->first();
            if (is_null($pesanan)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Pesanan tidak ditemukan'
                ]);
            }
            DB::table('smis_lab_pesanan')->where('id', $req->id)->update([
                'prop' => 'del'
            ]);
            $js->delete_tagihan_kasir_lab($req->id);
            $js->delete_jurnal_lab($req->id);
            SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id_cppt)->update([
                'id_lab' => 0
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'code' => 200,
                // 'data' => $ers->data_cppt_ranap($req),
                'data' => SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])->where('id', $req->id_cppt)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function store_rad_cppt(Request $req, ERekamMedisService $erms, ErmRanapService $ers)
    {
        try {
            $select = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->first();
            $update_rad = $erms->pesanan_radiologi_store_by_id($req);

            if ($select->id_rad != $update_rad->id) {
                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->update([
                    'id_rad' => $update_rad->id
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update pesanan radiologi',
                'code' => 200,
                // 'data' => $ers->data_cppt_ranap($req),
                'data' => SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])->where('id', $req->id)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function delete_rad_cppt(Request $req, ErmRanapService $ers, JurnalService $js)
    {
        try {
            $pesanan = Smis_Rad_Pesanan::where('id', $req->id)->first();
            if (is_null($pesanan)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Pesanan tidak ditemukan'
                ]);
            }
            DB::table('smis_rad_pesanan')->where('id', $req->id)->update([
                'prop' => 'del'
            ]);
            $js->delete_tagihan_kasir_rad($req->id);
            $js->delete_jurnal_rad($req->id);
            SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id_cppt)->update([
                'id_rad' => 0
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'code' => 200,
                // 'data' => $ers->data_cppt_ranap($req),
                'data' => SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])->where('id', $req->id_cppt)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function store_resep_cppt(Request $req, ResepService $rs, ErmRanapService $ers)
    {
        try {
            $select = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->first();

            $update = $rs->store_by_id($req);

            if (!$update['status']) {
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => $update['message']
                ]);
            }

            if ($select->id_resep == 0) {
                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->update([
                    'id_resep' => $update['data']->id
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update resep',
                'code' => 200,
                // 'data' => $ers->data_cppt_ranap($req),
                'data' => SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])->where('id', $req->id)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function lock_resep_cppt(Request $req, ResepService $rs, ErmRanapService $ers)
    {
        try {
            $rs->lock($req);
            return response()->json([
                'code' => 200,
                'status' => true,
                'data' => SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['resep.detail'])->where('id', $req->id_formulir)->first(),
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

    function batal_form_cppt(Request $req, ErmRanapService $ers)
    {
        try {
            SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->update([
                'prop' => 'del'
            ]);
            return response()->json([
                'code' => 200,
                'status' => true,
                'data' => $ers->data_cppt_ranap($req),
                'message' => 'Form berhasil dibatalkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function asesmen_awal_pasien_rawat_inap_petriadik(Request $req, ErmRanapService $ers)
    {
        $data = $ers->data_asesmen_awal_pasien_ranap_petriadik($req);
        return view('erm.rawat_inap.asesmen_awal_pasien_rawat_inap_petriadik', $data);
    }

    function update_smis_doc_asesmen_awal_pasien_ranap_petriadik(Request $req, ErmRanapService $ers, DokumenKunjunganService $dks)
    {
        try {
            if (isset($req->pass) && $req->pass != '') {
                if (md5($req->pass) != Auth::user()->password) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Password anda salah'
                    ]);
                }
                $dks->verifikasi_dokumen($req);
            }
            $ers->store_asesmen_awal_pasien_ranap_petriadik($req);
            if (isset($req->pass) && $req->pass != '') {
                return response()->json([
                    'status' => true,
                    'message' => 'Dokumen berhasil diverifikasi',
                    'dokter' => SmisHrdEmployee::where('nama', Auth::user()->realname)->where('prop', '')->first()
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Update dokumen petriadik berhasil',
                    'perawat' => SmisHrdEmployee::where('nama', Auth::user()->realname)->where('prop', '')->first()
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function indikator_sc(Request $req, IndikatorScService $scService)
    {
        $data = $scService->data($req);
        return view('erm.dokumen_kunjungan.indikator_sc', $data);
    }

    function verif_indikator_sc(IndikatorScRequest $req, IndikatorScService $scService, DokumenKunjunganService $dokService)
    {
        DB::beginTransaction();
        try {
            $req->validate([
                'pass' => 'required',
            ]);

            if (md5($req->pass) != Auth::user()->password) {
                throw new \Exception('Verifikasi gagal, Password yang anda masukkan salah!');
            }

            $dokService->verifikasi_dokumen($req);
            $scService->save($req);
            DB::commit();
            return redirect('e_rekam_medis/detail/indikator_sc?dokumen=' . $req->dokumen ?? $req->id_dokumen)->with('sukses', 'Data berhasil diverifikasi dan disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function pdf_indikator_sc(Request $req, IndikatorScService $scService)
    {
        $data = $scService->data($req);
        $data['rows'] = $scService->map_pdf($data['indikator_sc']);

        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_indikator_sc');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function surat_pernyataan_pulang_aps(Request $req, SuratPernyataanPulangApsService $sp_pulang_aps)
    {
        $data = $sp_pulang_aps->data($req);
        return view('erm.dokumen_kunjungan.surat_pernyataan_pulang_aps', $data);
    }

    function verif_surat_pernyataan_pulang_aps(SmisDocSuratPernyataanPulangApsRequest $req, SuratPernyataanPulangApsService $sp_pulang_service, DokumenKunjunganService $dokService)
    {
        DB::beginTransaction();
        try {
            $image_path = $sp_pulang_service->upload_signature("$req->signature_kerabat");
            $data = array_merge($req->all(), ['signature_kerabat' => $image_path]);
            $sp_pulang_aps = $sp_pulang_service->save($data);

            DB::commit();
            return redirect('e_rekam_medis/detail/surat_pernyataan_pulang_aps?dokumen=' . $req->id_dokumen ?? $sp_pulang_aps->id_dokumen)
                ->with('sukses', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function sign_surat_pernyataan_pulang_aps(Request $req, SuratPernyataanPulangApsService $sp_pulang_aps)
    {
        try {
            // validate
            $req->validate([
                'id_dokumen' => 'required|integer',
                'nama_saksi' => 'string',
                'nama_saksi_2' => 'string',
                'signature' => 'required|string',
            ]);

            $image_path = $sp_pulang_aps->upload_signature("$req->signature");
            $data = ['id_dokumen' => $req->id_dokumen];

            if (!empty($req->nama_saksi)) {
                $data['nama_saksi'] = $req->nama_saksi;
                $data['signature_saksi'] = $image_path;
            } else if (!empty($req->nama_saksi_2)) {
                $data['nama_saksi_2'] = $req->nama_saksi_2;
                $data['signature_saksi_2'] = $image_path;
            } else {
                throw new \Exception('Nama kerabat atau saksi tidak boleh kosong');
            }

            $sp_pulang_aps->save($data);
            return redirect('e_rekam_medis/detail/surat_pernyataan_pulang_aps?dokumen=' . $req->id_dokumen)
                ->with('sukses', 'Tanda tangan berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function permintaan_pemeriksaan_patologi_anatomi(Request $req, PermintaanPemeriksaanPatologiAnatomiService $pppaService)
    {
        $data = $pppaService->data($req);
        return view('erm.dokumen_kunjungan.permintaan_pemeriksaan_patologi_anatomi', $data);
    }

    function verif_permintaan_pemeriksaan_patologi_anatomi(Request $req, PermintaanPemeriksaanPatologiAnatomiService $permintaan_service, DokumenKunjunganService $dok_service)
    {
        DB::beginTransaction();
        try {
            if ($req->pass) {
                if (md5($req->pass) != Auth::user()->password) {
                    throw new \Exception('Verifikasi gagal, Password yang anda masukkan salah!');
                }
                $dok_service->verifikasi_dokumen($req);
            }

            $pppa = $permintaan_service->save($req);

            DB::commit();
            return redirect('e_rekam_medis/detail/permintaan_pemeriksaan_patologi_anatomi?dokumen=' . $req->id_dokumen ?? $pppa->id_dokumen)
                ->with('sukses', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function surat_pernyataan_naik_kelas(Request $req, SuratPernyataanNaikKelasService $sp_naik_kelas)
    {
        $data = $sp_naik_kelas->data($req);
        return view('erm.dokumen_kunjungan.surat_pernyataan_naik_kelas', $data);
    }

    function save_surat_pernyataan_naik_kelas(SuratPernyataanNaikKelasRequest $req, SuratPernyataanNaikKelasService $sp_naik_kelas)
    {
        try {
            $req->validate([
                'nama_kerabat' => 'required',
                'signature_kerabat' => 'required',
            ]);

            $data = $sp_naik_kelas->create($req);
            $image = $sp_naik_kelas->save_signature($req);
            //            dd($data);
            return redirect('e_rekam_medis/detail/surat_pernyataan_naik_kelas?dokumen=' . $req->id_dokumen ?? $data->id_dokumen)
                ->with('sukses', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function verif_surat_pernyataan_naik_kelas(SuratPernyataanNaikKelasRequest $req, SuratPernyataanNaikKelasService $sp_naik_kelas, DokumenKunjunganService $dokService)
    {
        DB::beginTransaction();
        try {
            $req->validate([
                'id_dokumen' => 'required|integer',
                'pass' => 'required',
            ]);

            if (md5($req->pass) != Auth::user()->password) {
                throw new \Exception('Verifikasi gagal, Password yang anda masukkan salah!');
            }

            //            dd($req->all());
            $dokService->verifikasi_dokumen($req);
            $data = $sp_naik_kelas->create($req);
            DB::commit();
            return redirect('e_rekam_medis/detail/surat_pernyataan_naik_kelas?dokumen=' . $req->id_dokumen ?? $data->id_dokumen)
                ->with('sukses', 'Data berhasil diverifikasi dan disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function sign_surat_pernyataan_naik_kelas(Request $req, SuratPernyataanNaikKelasService $sp_naik_kelas)
    {
        try {
            $image_path = $sp_naik_kelas->save_signature($req);

            return redirect('e_rekam_medis/detail/surat_pernyataan_naik_kelas?dokumen=' . $req->id_dokumen)
                ->with('sukses', 'Tanda tangan berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($req->all())->with('gagal', $th->getMessage());
        }
    }

    function formulir_serah_terima_jenazah(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_formulir_serah_terima_jenazah')->where('id_dokumen', $dokumen->id)->first();
        $employee = null;
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        } else {
            $employee = SmisHrdEmployee::where('nama', Auth::user()->realname)->first();
        }
        return view('erm.rawat_inap.formulir_serah_terima_jenazah', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee
        ]);
    }

    function save_formulir_serah_terima_jenazah(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                DB::table('smis_doc_formulir_serah_terima_jenazah')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'hari_dokumen' => $req->hari_dokumen ? $req->hari_dokumen : '',
                    'tgl_dokumen' => $req->tgl_dokumen ? $req->tgl_dokumen : '',
                    'tempat_meninggal' => $req->tempat_meninggal ? $req->tempat_meninggal : '',
                    'nama' => $req->nama ? $req->nama : '',
                    'umur' => $req->umur ? $req->umur : '',
                    'tgl_meninggal' => $req->tgl_meninggal ? $req->tgl_meninggal : '',
                    'nama_wali' => $req->nama_wali ? $req->nama_wali : '',
                    'umur_wali' => $req->umur_wali ? $req->umur_wali : '',
                    'alamat_wali' => $req->alamat_wali ? $req->alamat_wali : '',
                    'telp_wali' => $req->telp_wali ? $req->telp_wali : '',
                    'ktp_wali' => $req->ktp_wali ? $req->ktp_wali : '',
                    'hubungan' => $req->hubungan ? $req->hubungan : '',
                    'ket_lain_lain' => $req->ket_lain_lain ? $req->ket_lain_lain : '',
                    'tgl_ttd' => $req->tgl_ttd ? $req->tgl_ttd : '',
                ]);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/formulir_serah_terima_jenazah?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_ttd_serah_terima_jenazah(Request $req, DokumenKunjunganService $dks)
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

            if ($req->status == "penerima") {
                $val = [
                    'ttd_penerima' => $fileName,
                    'nama_penerima' => $req->nama_pasien
                ];
            } else if ($req->status == "saksi") {
                $val = [
                    'ttd_saksi' => $fileName,
                    'nama_saksi' => $req->nama_pasien
                ];
            } else if ($req->status == "saksi_dua") {
                $val = [
                    'ttd_saksi_dua' => $fileName,
                    'nama_saksi_dua' => $req->nama_pasien
                ];
            }

            DB::table('smis_doc_formulir_serah_terima_jenazah')->where('id_dokumen', $req->dokumen)->update($val);
            return back()->with('sukses', 'Berhasil tanda tangan dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function observasi_keperawatan_rawat_inap(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_observasi_keperawatan_rawat_inap')->where('id_dokumen', $dokumen->id)->get();
        foreach ($data as $key => $value) {
            $value->employee = SmisHrdEmployee::select('ttd')->where('nama', $value->nama_verifikator)->first();
        }
        return view('erm.rawat_inap.observasi_keperawatan_rawat_inap', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data
        ]);
    }


    /**
     * undocumented function
     *
     * @return void
     */
    public function serahTerimaBayiRawatGabung(Request $request, ErmRanapService $ermRanapService)
    {
        $data = $ermRanapService->serahTerimaBayiRawatGabung($request->dokumen);
        return view('erm.rawat_inap.serah_terima_bayi_rawat_gabung', [
            'data' => $data
        ]);
    }

    function save_observasi_keperawatan_rawat_inap(Request $req)
    {
        try {
            $data = [
                'id_dokumen' => $req->dokumen,
                'tgl_tindakan' => $req->tgl_tindakan ? $req->tgl_tindakan : '',
                'tindakan' => $req->tindakan ? $req->tindakan : '',
            ];

            if (isset($req->id) || $req->id != "") {
                DB::table('smis_doc_observasi_keperawatan_rawat_inap')->where('id', $req->id)->update($data);
            } else {
                DB::table('smis_doc_observasi_keperawatan_rawat_inap')->insert($data);
            }

            return redirect('e_rekam_medis/detail/observasi_keperawatan_rawat_inap?dokumen=' . $req->dokumen)
                ->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verifikasi_observasi_keperawatan_rawat_inap(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $data = [
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname
                ];

                DB::table('smis_doc_observasi_keperawatan_rawat_inap')->where('id', $req->id)->update($data);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/observasi_keperawatan_rawat_inap?dokumen=' . $req->dokumen)
                    ->with('sukses', 'Berhasil verifikasi tindakan');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function hapus_observasi_keperawatan_rawat_inap(Request $req, $id)
    {
        try {
            DB::table('smis_doc_observasi_keperawatan_rawat_inap')->where('id', $id)->delete();
            return redirect()->back()->with('sukses', 'Berhasil hapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function formulir_serah_terima_bayi(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_formulir_serah_terima_bayi')->where('id_dokumen', $dokumen->id)->first();
        $employee = null;
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        } else {
            $employee = SmisHrdEmployee::where('nama', Auth::user()->realname)->first();
        }
        return view('erm.rawat_inap.formulir_serah_terima_bayi', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee
        ]);
    }

    function save_formulir_serah_terima_bayi(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                DB::table('smis_doc_formulir_serah_terima_bayi')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'nama_ibu' => $req->nama_ibu ? $req->nama_ibu : '',
                    'nama_ayah' => $req->nama_ayah ? $req->nama_ayah : '',
                    'bb_saat_pulang' => $req->bb_saat_pulang ? $req->bb_saat_pulang : '',
                    'hari_control' => $req->hari_control ? $req->hari_control : '',
                    'tgl_control' => $req->tgl_control ? $req->tgl_control : '',
                    'jk' => $req->jk ? $req->jk : '',
                    'checklist_satu' => $req->checklist_satu ? $req->checklist_satu : '',
                    'checklist_dua' => $req->checklist_dua ? $req->checklist_dua : '',
                    'checklist_tiga' => $req->checklist_tiga ? $req->checklist_tiga : '',
                    'checklist_empat' => $req->checklist_empat ? $req->checklist_empat : '',
                    'checklist_lima' => $req->checklist_lima ? $req->checklist_lima : '',
                    'checklist_enam' => $req->checklist_enam ? $req->checklist_enam : '',
                    'checklist_tujuh' => $req->checklist_tujuh ? $req->checklist_tujuh : '',
                    'checklist_delapan' => $req->checklist_delapan ? $req->checklist_delapan : '',
                    'checklist_sembilan' => $req->checklist_sembilan ? $req->checklist_sembilan : '',
                    'checklist_sepuluh' => $req->checklist_sepuluh ? $req->checklist_sepuluh : '',
                    'nama_dokter' => $req->nama_dokter ? $req->nama_dokter : '',
                    'hari_dokumen' => $req->hari_dokumen ? $req->hari_dokumen : '',
                    'tgl_dokumen' => $req->tgl_dokumen ? $req->tgl_dokumen : '',
                    'jam_dokumen' => $req->jam_dokumen ? $req->jam_dokumen : '',
                ]);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/formulir_serah_terima_bayi?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_ttd_dokumen_kunjungan(Request $req, DokumenKunjunganService $dks)
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

            $val = [
                'signature_pasien' => $fileName,
                'nama_pasien' => $req->nama_pasien
            ];

            DokumenKunjungan::where('id', $req->dokumen)->update($val);
            return back()->with('sukses', 'Berhasil tanda tangan dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function lembar_konsultasi(Request $req, LembarKonsultasiService $service)
    {
        $data = $service->data($req);
        return view('erm.dokumen_kunjungan.lembar_konsultasi', $data);
    }

    function lembar_konsultasi_store(Request $req, LembarKonsultasiService $service)
    {
        try {
            if (Auth::user()->password != md5($req->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password anda salah'
                ]);
            }

            if ($req->jenis_verif == 'jawab') {
                // $select = Smis_Doc_Lembar_Konsultasi::where('id_dokumen', $req->dokumen)->first();
                // if (is_null($select) || $select->id_kepada == 0) {
                //     return response()->json([
                //         'status' => false,
                //         'message' => 'Konsultasi belum diisi, tidak dapat menjawab'
                //     ]);
                // }

                // if ($select->kepada != Auth::user()->realname) {
                //     return response()->json([
                //         'status' => false,
                //         'message' => 'Anda tidak diperbolehkan menjawab'
                //     ]);
                // }
            }

            $dokumen = $service->store($req);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen',
                'employee' => $req->jenis_verif == 'konsul' ? SmisHrdEmployee::where('nama', $dokumen->nama_konsul)->first() : SmisHrdEmployee::where('nama', $dokumen->nama_jawab)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function lembar_konsultasi_pdf(Request $req, LembarKonsultasiService $service)
    {
        $data = $service->data($req);
        $contents = $this->pdf($data, 'erm.dokumen_kunjungan.pdf_lembar_konsultasi');
        return new Response($contents, 200, array('Content-Type' => 'application/pdf'));
    }

    function surat_keterangan_kematian(Request $req, SuratKeteranganKematianService $ppi)
    {
        $data = $ppi->data($req);

        return view('erm.rawat_inap.surat_keterangan_kematian', $data);
    }

    function save_surat_keterangan_kematian(Request $req, SuratKeteranganKematianService $ppi)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $ins = $ppi->create($req);
                if ($ins) {
                    $ppi->verifikasi($req);
                    return redirect('e_rekam_medis/detail/surat_keterangan_kematian?dokumen=' . $req->dokumen)
                        ->with('sukses', 'Dokumen berhasil disimpan');
                } else {
                    return redirect()->back()->with('gagal', 'Verifikasi Gagal');
                }
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function lembar_pemantauan_fibrinolitik(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_lembar_pemantauan_fibrinolitik')->where('id_dokumen', $dokumen->id)->get();
        foreach ($data as $key => $value) {
            $value->employee = SmisHrdEmployee::select('ttd')->where('nama', $value->nama_verifikator)->first();
        }
        return view('erm.rawat_inap.lembar_pemantauan_fibrinolitik', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data
        ]);
    }

    function save_lembar_pemantauan_fibrinolitik(Request $req)
    {
        try {
            $data = [
                'id_dokumen' => $req->dokumen,
                'tgl_tindakan' => $req->tgl_tindakan ? $req->tgl_tindakan : '',
                'skala_nyeri' => $req->skala_nyeri ? $req->skala_nyeri : '',
                'tensi' => $req->tensi ? $req->tensi : '',
                'nadi' => $req->nadi ? $req->nadi : '',
                'rr' => $req->rr ? $req->rr : '',
                'spo2' => $req->spo2 ? $req->spo2 : '',
                'pendarahan' => $req->pendarahan ? $req->pendarahan : '',
            ];

            if (isset($req->id) || $req->id != "") {
                DB::table('smis_doc_lembar_pemantauan_fibrinolitik')->where('id', $req->id)->update($data);
            } else {
                DB::table('smis_doc_lembar_pemantauan_fibrinolitik')->insert($data);
            }

            return redirect('e_rekam_medis/detail/lembar_pemantauan_fibrinolitik?dokumen=' . $req->dokumen)
                ->with('sukses', 'Berhasil simpan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verifikasi_lembar_pemantauan_fibrinolitik(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $data = [
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname
                ];

                DB::table('smis_doc_lembar_pemantauan_fibrinolitik')->where('id', $req->id)->update($data);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/lembar_pemantauan_fibrinolitik?dokumen=' . $req->dokumen)
                    ->with('sukses', 'Berhasil verifikasi tindakan');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function hapus_lembar_pemantauan_fibrinolitik(Request $req, $id)
    {
        try {
            DB::table('smis_doc_lembar_pemantauan_fibrinolitik')->where('id', $id)->delete();
            return redirect()->back()->with('sukses', 'Berhasil hapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function surat_kontrol(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();

        $layanan = SMIS_LayananPasien::with('diagnosa')->where('id', $dokumen->noreg)->where('prop', '')->first();

        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;

        $data = DB::table('smis_doc_surat_kontrol')->where('id_dokumen', $dokumen->id)->first();

        $employee = null;
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        }

        return view('erm.rawat_inap.surat_kontrol', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee
        ]);
    }

    function save_surat_kontrol(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $store = DB::table('smis_doc_surat_kontrol')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'terapi' => $req->terapi ? $req->terapi : '',
                    'tgl_surat_rujukan' => $req->tgl_surat_rujukan ? $req->tgl_surat_rujukan : '',
                    'alasan1' => $req->alasan1 ? $req->alasan1 : '',
                    'alasan2' => $req->alasan2 ? $req->alasan2 : '',
                    'tindak_lanjut1' => $req->tindak_lanjut1 ? $req->tindak_lanjut1 : '',
                    'tindak_lanjut2' => $req->tindak_lanjut2 ? $req->tindak_lanjut2 : '',
                    'tgl_keterangan' => $req->tgl_keterangan ? $req->tgl_keterangan : '',
                    'no_antrian' => $req->no_antrian ? $req->no_antrian : '',
                    'tgl_dokumen' => $req->tgl_dokumen ? $req->tgl_dokumen : '',
                ]);
                $dks->verifikasi_dokumen($req);

                $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                    ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
                    ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
                $layanan = SMIS_LayananPasien::with('diagnosa')->where('id', $dokumen->noreg)->where('prop', '')->first();
                $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
                $data = DB::table('smis_doc_surat_kontrol')->where('id_dokumen', $dokumen->id)->first();
                $employee = null;
                if ($dokumen->id_verifikator > 1) {
                    $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
                }
                $pdf = Pdf::loadView('erm.rawat_inap.surat_kontrol_pdf', [
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
                $fileName = '7_' . $req->dokumen . '_surat_kontrol.pdf';
                $pdf->save($path . '/' . $fileName);

                return redirect('e_rekam_medis/detail/surat_kontrol?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function lembar_penolakan_dnr(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_lembar_penolakan_dnr')->where('id_dokumen', $dokumen->id)->first();
        $employee = null;
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        }
        return view('erm.rawat_inap.lembar_penolakan_dnr', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee
        ]);
    }

    function save_lembar_penolakan_dnr(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                DB::table('smis_doc_lembar_penolakan_dnr')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'dokter' => $req->dokter ? $req->dokter : '',
                    'perawat' => $req->perawat ? $req->perawat : '',
                    'penerima_informasi' => $req->penerima_informasi ? $req->penerima_informasi : '',
                    'informasi' => $req->informasi ? $req->informasi : '',
                    'diagnosa' => $req->diagnosa ? $req->diagnosa : '',
                    'dasar_diagnosa' => $req->dasar_diagnosa ? $req->dasar_diagnosa : '',
                    'tindakan_dokter' => $req->tindakan_dokter ? $req->tindakan_dokter : '',
                    'indikasi_tindakan' => $req->indikasi_tindakan ? $req->indikasi_tindakan : '',
                    'tata_cara' => $req->tata_cara ? $req->tata_cara : '',
                    'tujuan' => $req->tujuan ? $req->tujuan : '',
                    'risiko' => $req->risiko ? $req->risiko : '',
                    'komplikasi' => $req->komplikasi ? $req->komplikasi : '',
                    'prognosis' => $req->prognosis ? $req->prognosis : '',
                    'alternatif' => $req->alternatif ? $req->alternatif : '',
                    'lain_lain' => $req->lain_lain ? $req->lain_lain : '',
                    'nama_pasien' => $req->nama_pasien ? $req->nama_pasien : '',
                    'alamat_pasien' => $req->alamat_pasien ? $req->alamat_pasien : '',
                    'menolak' => $req->menolak ? $req->menolak : '',
                    'terhadap' => $req->terhadap ? $req->terhadap : '',
                    'nama_wali' => $req->nama_wali ? $req->nama_wali : '',
                    'tgl_lahir_wali' => $req->tgl_lahir_wali ? $req->tgl_lahir_wali : '',
                    'kelamin' => $req->kelamin ? $req->kelamin : '',
                    'alamat' => $req->alamat ? $req->alamat : '',
                    'tgl_ttd' => $req->tgl_ttd ? $req->tgl_ttd : ''
                ]);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/lembar_penolakan_dnr?dokumen=' . $req->dokumen)
                    ->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function save_ttd_lembar_penolakan_dnr(Request $req)
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

            if ($req->status == "keluarga") {
                $val = [
                    'ttd_keluarga' => $fileName,
                    'nama_keluarga' => $req->nama_pasien
                ];
            } else if ($req->status == "saksi") {
                $val = [
                    'ttd_saksi' => $fileName,
                    'nama_saksi' => $req->nama_pasien
                ];
            } else if ($req->status == "saksi_dua") {
                $val = [
                    'ttd_saksi_dua' => $fileName,
                    'nama_saksi_dua' => $req->nama_pasien
                ];
            }

            DB::table('smis_doc_lembar_penolakan_dnr')->where('id_dokumen', $req->dokumen)->update($val);
            return back()->with('sukses', 'Berhasil tanda tangan dokumen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function daftar_kontrol_istimewa_pasien_dm(Request $req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $pasien = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $select = Smis_Doc_Daftar_Kontrol_Istimewa_Pasien_Dm::where('id_dokumen', $req->dokumen)->first();
        $data = $select ? json_decode($select->list_data) : [];

        foreach ($data as $d) {
            $d->employee = $d->id_verifikator != 0 ? SmisHrdEmployee::leftJoin('smis_adm_user', 'smis_adm_user.username', 'smis_hrd_employee.username')
                ->select('smis_hrd_employee.ttd')->where('smis_adm_user.id', $d->id_verifikator)->first() : null;
        }

        if ($select) {
            $select->list_data = $data;
        }

        return view('erm.dokumen_kunjungan.daftar_kontrol_istimewa_pasien_dm', [
            'dokumen' => $dokumen,
            'pasien' => $pasien,
            'data' => $select
        ]);
    }

    function daftar_kontrol_istimewa_pasien_dm_store(Request $req, DokumenKunjunganService $dks)
    {
        try {
            Smis_Doc_Daftar_Kontrol_Istimewa_Pasien_Dm::updateOrCreate([
                'id_dokumen' => $req->dokumen
            ], [
                'no_kamar' => $req->no_kamar ? $req->no_kamar : '',
                'id_dpjp' => $req->id_dpjp ? $req->id_dpjp : 0,
                'dpjp' => $req->dpjp ? $req->dpjp : '',
                'list_data' => $req->list_data ? $req->list_data : '[]',
                'nilai_normal' => $req->nilai_normal ? $req->nilai_normal : '',
            ]);

            if ($req->verif == 1) {
                $dks->verifikasi_dokumen($req);
            }

            $select = Smis_Doc_Daftar_Kontrol_Istimewa_Pasien_Dm::where('id_dokumen', $req->dokumen)->first();
            $data = json_decode($select->list_data);

            foreach ($data as $d) {
                $d->employee = $d->id_verifikator != 0 ? SmisHrdEmployee::leftJoin('smis_adm_user', 'smis_adm_user.username', 'smis_hrd_employee.username')
                    ->select('smis_hrd_employee.ttd')->where('smis_adm_user.id', $d->id_verifikator)->first() : null;
            }

            return response()->json([
                'data' => $data,
                'status' => true,
                'message' => 'Berhasil simpan dokumen'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function persetujuan_atau_penolakan_tindakan_bedah(Request $req, PersetujuanAtauPenolakanTindakanBedahService $service)
    {
        $data = $service->data($req);
        return view('erm.dokumen_kunjungan.persetujuan_atau_penolakan_tindakan_bedah', $data);
    }

    function persetujuan_atau_penolakan_tindakan_bedah_store(Request $req, PersetujuanAtauPenolakanTindakanBedahService $service)
    {
        try {
            if ($req->form == 1) {
                if ($req->jenis == 'dokter') {
                    if (Auth::user()->password != md5($req->password)) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Password anda salah'
                        ]);
                    }
                }
            } else if ($req->form == 2) {
                if ($req->jenis == 'perawat') {
                    if (Auth::user()->password != md5($req->password)) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Password anda salah'
                        ]);
                    }
                }

                $select = Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::where('id_dokumen', $req->dokumen)->first();

                if (is_null($select)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Simpan form pertama terlebih dahulu'
                    ]);
                }
            }

            $dokumen = $service->store($req);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen',
                'employee' => $req->jenis == 'dokter' ? SmisHrdEmployee::where('nama', $dokumen->nama_dokter)->first() : SmisHrdEmployee::where('nama', $dokumen->nama_perawat)->first(),
                'jenis' => $req->jenis,
                'data' => $dokumen
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function storeSerahTerimaBayiRawatGabung(Request $request, ErmRanapService $ermRanapService)
    {
        $data = $ermRanapService->storeSerahTerimaBayiRawatGabung($request->except("_token"));
        if ($data["status"]) {
            return redirect()->back()->with('success', $data["message"])->withInput();
        } else {
            return redirect()->back()->with('error', $data["message"])->withInput();
        }
    }

    function asesmen_pasien_terminal(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_asesmen_pasien_terminal')->where('id_dokumen', $dokumen->id)->first();
        $employee = null;
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        }
        $perawat = null;
        if ($dokumen->id_verifikator > 1) {
            $realname = $data ? DB::table('smis_adm_user')->select('realname')->where('id', $data->id_perawat)->first() : null;
            if ($realname) {
                $perawat = SmisHrdEmployee::where('nama', $realname->realname)->first();
            }
        }
        return view('erm.rawat_inap.asesmen_pasien_terminal', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee,
            'perawat' => $perawat
        ]);
    }

    function save_asesmen_pasien_terminal(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                DB::table('smis_doc_asesmen_pasien_terminal')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'tgl_pengkajian' => $req->tgl_pengkajian ? $req->tgl_pengkajian : '',
                    'informasi' => $req->informasi ? $req->informasi : '',
                    'hubungan' => $req->hubungan ? $req->hubungan : '',
                    'ket_tonus_otot' => $req->ket_tonus_otot ? $req->ket_tonus_otot : '',
                    'ket_checkbox4' => $req->ket_checkbox4 ? $req->ket_checkbox4 : '',
                    'ket_orientasi_spiritual' => $req->ket_orientasi_spiritual ? $req->ket_orientasi_spiritual : '',
                    'nama_keluarga' => $req->nama_keluarga ? $req->nama_keluarga : '',
                    'hubungan_keluarga' => $req->hubungan_keluarga ? $req->hubungan_keluarga : '',
                    'dimana' => $req->dimana ? $req->dimana : '',
                    'telp' => $req->telp ? $req->telp : '',
                    'ket_mampu_merawat' => $req->ket_mampu_merawat ? $req->ket_mampu_merawat : '',
                    'ket_checkbox9' => $req->ket_checkbox9 ? $req->ket_checkbox9 : '',
                    'donasi_organ' => $req->donasi_organ ? $req->donasi_organ : '',
                    'checkbox1' => $req->checkbox1 ? $req->checkbox1 : '[]',
                    'checkbox2' => $req->checkbox2 ? $req->checkbox2 : '[]',
                    'checkbox3' => $req->checkbox3 ? $req->checkbox3 : '[]',
                    'checkbox4' => $req->checkbox4 ? $req->checkbox4 : '[]',
                    'checkbox5' => $req->checkbox5 ? $req->checkbox5 : '[]',
                    'checkbox6' => $req->checkbox6 ? $req->checkbox6 : '[]',
                    'checkbox7' => $req->checkbox7 ? $req->checkbox7 : '[]',
                    'checkbox8' => $req->checkbox8 ? $req->checkbox8 : '[]',
                    'checkbox9' => $req->checkbox9 ? $req->checkbox9 : '[]',
                    'checkbox10' => $req->checkbox10 ? $req->checkbox10 : '[]',
                    'checkbox11' => $req->checkbox11 ? $req->checkbox11 : '[]',
                    'checkbox12' => $req->checkbox12 ? $req->checkbox12 : '[]',
                    'tonus_otot' => $req->tonus_otot ? $req->tonus_otot : '',
                    'orientasi_spiritual' => $req->orientasi_spiritual ? $req->orientasi_spiritual : '',
                    'perlu_didoakan' => $req->perlu_didoakan ? $req->perlu_didoakan : '',
                    'perlu_bimbingan' => $req->perlu_bimbingan ? $req->perlu_bimbingan : '',
                    'pendampingan_rohani' => $req->pendampingan_rohani ? $req->pendampingan_rohani : '',
                    'keluarga' => $req->keluarga ? $req->keluarga : '',
                    'penyiapan_lingkungan' => $req->penyiapan_lingkungan ? $req->penyiapan_lingkungan : '',
                    'mampu_merawat' => $req->mampu_merawat ? $req->mampu_merawat : '',
                    'homecare' => $req->homecare ? $req->homecare : '',
                ]);
                $dks->verifikasi_dokumen($req);
                return redirect('e_rekam_medis/detail/asesmen_pasien_terminal?dokumen=' . $req->dokumen)
                    ->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verifikasi_asesmen_pasien_terminal(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                DB::table('smis_doc_asesmen_pasien_terminal')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'id_perawat' => Auth::user()->id,
                    'nama_perawat' => Auth::user()->realname,
                ]);
                return redirect('e_rekam_medis/detail/asesmen_pasien_terminal?dokumen=' . $req->dokumen)
                    ->with('sukses', 'Berhasil verifikasi dokumen');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function daftar_pemberian_obat(Request $req, DaftarPemberianObatService $service)
    {

        return view('erm.dokumen_kunjungan.daftar_pemberian_obat', $service->data($req));
    }

    function daftar_pemberian_obat_store(Request $req, DaftarPemberianObatService $service)
    {
        try {

            if ($req->verif == 'bidan') {
                if (md5($req->password) != Auth::user()->password) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Password anda salah'
                    ]);
                }
            }

            $service->store($req);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen',
                'data' => Smis_Doc_Daftar_Pemberian_Obat::where('id_dokumen', $req->dokumen)->first()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function survei_infeksi_rumah_sakit(Request $req, SurveiInfeksiRumahSakitService $service)
    {
        $data = $service->data($req);
        return view('erm.dokumen_kunjungan.survei_infeksi_rumah_sakit', $data);
    }

    function survei_infeksi_rumah_sakit_store(Request $req, SurveiInfeksiRumahSakitService $service)
    {
        try {
            if (md5($req->password) != Auth::user()->password) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password anda salah'
                ]);
            }

            $service->store($req);

            $dokumen = Smis_Doc_Survei_Infeksi_Rumah_Sakit::where('id_dokumen', $req->dokumen)->first();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update dokumen',
                'employee' => $req->jeni_verif == 'dokter' ? SmisHrdEmployee::where('nama', $dokumen->nama_dokter)->first() : SmisHrdEmployee::where('nama', $dokumen->nama_kepala_ruangan)->first(),
                'jenis' => $req->jeni_verif,
                'data' => $dokumen
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
    function dokumentasi_informasi_tindakan_anestesi_sedasi(Request $req, DokumentasiInformasiTindakanAnestesiService $infoAnestesiService)
    {
        $data = $infoAnestesiService->data($req);
        return view('erm.rawat_inap.dokumentasi_informasi_tindakan_anastesi_sedasi', $data);
    }

    function save_dokumentasi_informasi_tindakan_anestesi_sedasi(Request $req, DokumentasiInformasiTindakanAnestesiService $infoAnestesiService)
    {
        try {
            $inas = $infoAnestesiService->create($req);
            if ($inas) {
                return back()->with('sukses', 'Dokumen berhasil disimpan');
            } else {
                return redirect()->back()->with('gagal', 'Dokumen Gagal disimpan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function ttd_dokumentasi_informasi_tindakan_anestesi_sedasi(Request $req, DokumentasiInformasiTindakanAnestesiService $infoAnestesiService)
    {
        try {
            $infoAnestesiService->save_signature($req);
            return back()->with('sukses', 'Tanda tangan dokumen berhasil');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function verif_dokumentasi_informasi_tindakan_anestesi_sedasi(Request $req, DokumentasiInformasiTindakanAnestesiService $infoAnestesiService)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $infoAnestesiService->verifikasi_dokumen($req);
                return back()
                    ->with('sukses', 'Dokumen berhasil diverifikasi');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function persetujuan_transfusi_darah(Request $req, PersetujuanTransfusiDarahService $ts)
    {
        $data = $ts->data($req);
        return view('erm.rawat_inap.persetujuan_atau_penolakan_transfusi_darah', $data);
    }

    function save_persetujuan_transfusi_darah(Request $req, PersetujuanTransfusiDarahService $ts, DokumenKunjunganService $dks)
    {
        try {
            $inas = $ts->create($req);
            if ($inas) {
                if ($req->action == "verif") {
                    try {
                        if (Auth::user()->password == md5($req->pass)) {
                            $dks->verifikasi_dokumen($req);
                            return back()->with('sukses', 'Dokumen berhasil diverifikasi');
                        }
                        return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
                    } catch (\Throwable $th) {
                        return redirect()->back()->with('gagal', $th->getMessage());
                    }
                } else if ($req->action == "ttd") {
                    try {
                        $ts->save_signature($req);
                        return back()->with('sukses', 'Tanda tangan dokumen berhasil');
                    } catch (\Throwable $th) {
                        return redirect()->back()->with('gagal', $th->getMessage());
                    }
                    return redirect()->back()->with('gagal', 'Dokumen Gagal disimpan');
                } else if ($req->action == 'ttd_dokter') {
                    try {
                        if (Auth::user()->password == md5($req->password)) {
                            $inas = $ts->save_ttd_dokter($req);
                            return back()->with('sukses', 'Dokumen berhasil diverifikasi');
                        }
                        return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
                    } catch (\Throwable $th) {
                        return redirect()->back()->with('gagal', $th->getMessage());
                    }
                } else {
                    return back()->with('sukses', 'Dokumen berhasil disimpan');
                }
            } else {
                return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }
    function tindakan_anestesi_spinal_atau_epidural(Request $req, TindakanAnestesiEpiduralService $anestesiEpidural)
    {
        $data = $anestesiEpidural->data($req);
        return view('erm.rawat_inap.tindakan_anestesi_spinal_atau_epidural', $data);
    }

    function save_tindakan_anestesi_spinal_atau_epidural(Request $req, TindakanAnestesiEpiduralService $anestesiEpidural)
    {
        try {
            $inas = $anestesiEpidural->create($req);
            if ($inas) {
                return back()->with('sukses', 'Dokumen berhasil disimpan');
            } else {
                return redirect()->back()->with('gagal', 'Dokumen Gagal disimpan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function ttd_tindakan_anestesi_spinal_atau_epidural(Request $req, TindakanAnestesiEpiduralService $anestesiEpidural)
    {
        try {
            $anestesiEpidural->save_signature($req);
            return back()->with('sukses', 'Tanda tangan dokumen berhasil');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function rekonsiliasi_obat(Request $req, RekonsiliasiObatService $ros)
    {
        $data = $ros->data($req);
        return view('erm.rawat_inap.rekonsiliasi_obat', $data);
    }

    function save_rekonsiliasi_obat(Request $req, RekonsiliasiObatService $ros)
    {
        try {
            $data = $ros->store($req);
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Berhasil update dokumen',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function verifikasi_apoteker_rekonsiliasi_obat(Request $req)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                return response()->json([
                    'id_apoteker' => Auth::user()->id,
                    'nama_apoteker' => Auth::user()->realname,
                    'status' => true,
                    'code' => 200,
                    'message' => 'Berhasil update dokumen'
                ]);
            }
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Password yang anda masukkan salah'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function update_info_apoteker_rekonsiliasi_obat(Request $req, RekonsiliasiObatService $ros)
    {
        try {
            $ros->update_info_apoteker($req);
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
    }

    function verifikasi_dokter_rekonsiliasi_obat(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $dks->verifikasi_dokumen($req);
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Berhasil update dokumen'
                ]);
            }
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Password yang anda masukkan salah'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    function surat_kontrol_rawat_inap(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::with('diagnosa')->where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_surat_kontrol_rawat_inap')->where('id_dokumen', $dokumen->id)->first();
        $employee = null;
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        }
        return view('erm.rawat_inap.surat_kontrol_ranap', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee
        ]);
    }

    function pdf_surat_kontrol_rawat_inap(Request $req)
    {
        $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::with('diagnosa')->where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
        $data = DB::table('smis_doc_surat_kontrol_rawat_inap')->where('id_dokumen', $dokumen->id)->first();
        $employee = null;
        if ($dokumen->id_verifikator > 1) {
            $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
        }
        return view('erm.rawat_inap.surat_kontrol_ranap_pdf', [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'data' => $data,
            'employee' => $employee
        ]);
    }

    function save_surat_kontrol_rawat_inap(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                DB::table('smis_doc_surat_kontrol_rawat_inap')->updateOrInsert([
                    'id_dokumen' => $req->dokumen
                ], [
                    'resume' => $req->resume ?? $req->resume,
                    'radio_resume' => $req->radio_resume ? $req->radio_resume : '',
                    'tgl_kontrol' => $req->tgl_kontrol ?? $req->tgl_kontrol,
                    'jam_kontrol' => $req->jam_kontrol ?? $req->jam_kontrol,
                    'nama_dokter' => $req->nama_dokter ?? $req->nama_dokter,
                    'radio_kontrol' => $req->radio_kontrol ? $req->radio_kontrol : '',
                    'alasan_istirahat' => $req->alasan_istirahat ?? $req->alasan_istirahat,
                    'radio_dokter' => $req->radio_dokter ? $req->radio_dokter : '',
                    'no_rad' => $req->no_rad ?? $req->no_rad,
                    'rad' => $req->rad ?? $req->rad,
                    'radio_rad' => $req->radio_rad ? $req->radio_rad : '',
                    'lab' => $req->lab ?? $req->lab,
                    'radio_lab' => $req->radio_lab ? $req->radio_lab : '',
                    'terapi' => $req->terapi ?? $req->terapi,
                    'radio_terapi' => $req->radio_terapi ? $req->radio_terapi : '',
                    'diagnosa' => $req->diagnosa ?? $req->diagnosa,
                    'tinggi_badan' => $req->tinggi_badan ?? $req->tinggi_badan,
                    'berat_badan' => $req->berat_badan ?? $req->berat_badan,
                    'surat_konsul' => $req->surat_konsul ?? $req->surat_konsul,
                    'radio_konsul' => $req->radio_konsul ? $req->radio_konsul : '',
                    'surat_jawaban_konsul' => $req->surat_jawaban_konsul ?? $req->surat_jawaban_konsul,
                    'radio_jawaban_konsul' => $req->radio_jawaban_konsul ? $req->radio_jawaban_konsul : '',
                    'surat_kematian' => $req->surat_kematian ?? $req->surat_kematian,
                    'radio_kematian' => $req->radio_kematian ? $req->radio_kematian : '',
                    'asuransi' => $req->asuransi ?? $req->asuransi,
                    'radio_asuransi' => $req->radio_asuransi ? $req->radio_asuransi : '',
                    'tgl_dokumen' => $req->tgl_dokumen ?? $req->tgl_dokumen,
                ]);
                $dks->verifikasi_dokumen($req);

                $dokumen = DokumenKunjungan::leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
                    ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username', 'smis_adm_user.realname')
                    ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
                $layanan = SMIS_LayananPasien::with('diagnosa')->where('id', $dokumen->noreg)->where('prop', '')->first();
                $pasien = $layanan ? SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first() : null;
                $data = DB::table('smis_doc_surat_kontrol_rawat_inap')->where('id_dokumen', $dokumen->id)->first();
                $employee = null;
                if ($dokumen->id_verifikator > 1) {
                    $employee = SmisHrdEmployee::where('nama', $dokumen->realname)->first();
                }

                $pdf = Pdf::loadView('erm.rawat_inap.surat_kontrol_ranap_pdf', [
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
                $fileName = '8_' . $req->dokumen . '_surat_kontrol_rawat_inap.pdf';
                $pdf->save($path . '/' . $fileName);

                return redirect('e_rekam_medis/detail/surat_kontrol_rawat_inap?dokumen=' . $req->dokumen)->with('sukses', 'Berhasil verifikasi dan simpan data');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }
}
