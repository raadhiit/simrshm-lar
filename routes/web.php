<?php

use Alexusmai\LaravelFileManager\Controllers\FileManagerController;
use App\Http\Controllers\AjaxRequestController;
use App\Http\Controllers\AplicareController;
use App\Http\Controllers\AntrianManualController;
use App\Http\Controllers\AntrianPendaftaranController;
use App\Http\Controllers\AntrianPoliController;
use App\Http\Controllers\AntrianFarmasiController;
use App\Http\Controllers\AntrianOperasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CasemixController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CredentialsAntrianController;
use App\Http\Controllers\CustomFileManagerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAntrianController;
use App\Http\Controllers\DataInduk\DataIndukBagianController;
use App\Http\Controllers\DataInduk\DataIndukPendidikanController;
use App\Http\Controllers\DataInduk\DataIndukRuanganPegawaiController;
use App\Http\Controllers\DataInduk\DataIndukStatusTenagaController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\DokumenKunjungan\FormPemantauanReaksiTransfusiDarahController;
use App\Http\Controllers\DokumenKunjungan\RencanaKeperawatanIntraOperasi;
use App\Http\Controllers\DokumenKunjungan\RencanaKeperawatanPostOperasi;
use App\Http\Controllers\DokumenKunjungan\RencanaKeperawatanPraOperasi;
use App\Http\Controllers\DokumenRmController;
use App\Http\Controllers\ErmDokterController;
use App\Http\Controllers\ErmPendaftaranController;
use App\Http\Controllers\ErmRajalController;
use App\Http\Controllers\ErmRanapController;
use App\Http\Controllers\ErmRekamMedisController;
use App\Http\Controllers\GuestRegistrationController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\JadwalPoliLocalController;
use App\Http\Controllers\JadwalPoliBpjsController;
use App\Http\Controllers\LaporanHutangPoController;
use App\Http\Controllers\LaporanHutangNonPoController;
use App\Http\Controllers\HppController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanDetailHppController;
use App\Http\Controllers\LaporanLabaRugiController;
use App\Http\Controllers\LapRiwayatAccJurnalController;
use App\Http\Controllers\LoaderBpjsDiverifikasiController;
use App\Http\Controllers\TindakanDokter\KonsulDokterController;
use App\Http\Controllers\LoaderBpjsLayakController;
use App\Http\Controllers\OPLJasaController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\Pendaftaran\LapDataPasienController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RekapAntrianController;
use App\Http\Controllers\RuanganIgdController;
use App\Http\Controllers\ResumeMedisController;
use App\Http\Controllers\ReferensiPoliController;
use App\Http\Controllers\ReferensiDokterController;
use App\Http\Controllers\RiwayatPasienController;
use App\Http\Controllers\SatuSehatLocationController;
use App\Http\Controllers\SatuSehatPractionerController;
use App\Http\Controllers\SatuSehatRawatJalanController;
use App\Http\Controllers\SettingAsuransiController;
use App\Http\Controllers\SkriningGiziRawatInapController;
use App\Http\Controllers\TindakanDokter\PeriksaDokterController;
use App\Http\Controllers\TindakanDokter\TindakanDokterInapController;
use App\Http\Controllers\TindakanDokter\TindakanDokterJalanController;
use App\Http\Controllers\TindakanDokter\VisiteDokterController;
use App\Http\Controllers\WaktuTaskIdController;
use Illuminate\Support\Facades\Route;
use App\Models\AvailableBed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\JadwalOperasiRs;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'loginpage'])->name('loginpage');
    Route::post('do_login', [AuthController::class, 'do_login']);

    Route::controller(AntrianManualController::class)->group(function () {
        Route::group(['prefix' => 'antrian_manual'], function () {
            Route::get('/', 'index')->name('antrian_manual.index');
            Route::post('ambil/{lantai}', 'getAntrian')->name('antrian_manual.ambil');
            Route::get('download', 'download')->name('kunjungan_bayi_anak.download');
        });
    });

    Route::get('checkin', [CheckinController::class, 'index']);
    Route::get('guest_home', function () {
        return view('guest.super');
    });

    Route::group(['prefix' => "guest_registration"], function () {
        Route::get('/', [GuestRegistrationController::class, 'index']);
        Route::get('pasien_umum', [GuestRegistrationController::class, 'umum']);
        Route::post('pasien_umum/create', [GuestRegistrationController::class, 'tambah_pasien']);
        Route::post('pasien_bpjs/create', [GuestRegistrationController::class, 'tambah_pasien_bpjs']);
        Route::get('pasien_umum/daftar', [GuestRegistrationController::class, 'daftar_pasien_umum']);
        Route::get('pasien_bpjs/daftar', [GuestRegistrationController::class, 'daftar_pasien_bpjs']);
        Route::post('pasien_umum/daftar/post', [GuestRegistrationController::class, 'pasien_umum_daftar_post']);
        Route::post('pasien_bpjs/daftar/post', [GuestRegistrationController::class, 'pasien_umum_daftar_post']);
        Route::get('pasien_bpjs', [GuestRegistrationController::class, 'bpjs']);
        Route::get('hasil_antrian', [GuestRegistrationController::class, 'hasil']);
        Route::get('farmasi', function (Request $req) {
            return view('guest.farmasi');
        });
    });
});

Route::get('cetak_antrian', [GuestRegistrationController::class, 'cetak_antrian']);

Route::get('aplicare/display', function (Request $req) {
    $data['beds'] =
        AvailableBed::select(
            "namakelas",
            "namaruang",
            "kapasitas as total",
            "tersedia as total_tersedia",
            "updated_at"
        )
        ->where("namakelas", "<>", " ")
        ->whereNull("deleted_at")
        ->where("kapasitas", ">", 0)
        ->where("namakelas", "<>", "KELAS II")
        ->union(
            AvailableBed::select(
                "namakelas",
                DB::raw("'As Salam' as namaruang"),
                DB::raw('SUM(kapasitas) as total'),
                DB::raw('SUM(tersedia) as total_tersedia'),
                DB::raw("(select updated_at from available_beds WHERE namakelas = 'KELAS II' and koderuang = 19) as updated_at")
            )
                ->where("namakelas", "<>", " ")
                ->whereNull("deleted_at")
                ->where("kapasitas", ">", 0)
                ->where("namakelas", "=", "KELAS II")
                ->groupby("namakelas")
        )
        ->orderby("namakelas")
        ->get();
    return view('aplicare.display', $data);
});

Route::get('auth_from_simrs', [AuthController::class, 'auth_from_simrs']);
Route::get('logout_from_simrs', [AuthController::class, 'logout_from_simrs']);

Route::group(['prefix' => 'ajax_request'], function () {
    Route::get('datatable_bidan', [AjaxRequestController::class, 'datatable_bidan']);
    Route::get('select_obat', [AjaxRequestController::class, 'select_obat']);

    Route::get('list_riwayat_eresep', [AjaxRequestController::class, 'list_riwayat_eresep']);
    Route::get('preview_riwayat_eresep', [AjaxRequestController::class, 'preview_riwayat_eresep']);
    Route::get('select_riwayat_eresep', [AjaxRequestController::class, 'select_riwayat_eresep']);

    Route::get('hapus_pesanan_lab', [AjaxRequestController::class, 'hapus_pesanan_lab']);
    Route::get('hapus_pesanan_rad', [AjaxRequestController::class, 'hapus_pesanan_rad']);
    Route::get('e_rekam_medis', [AjaxRequestController::class, 'e_rekam_medis']);

    Route::get('suggestion_suku', [AjaxRequestController::class, 'suggestion_suku']);

    Route::get('employee', [AjaxRequestController::class, 'employee']);
    Route::get('dokter', [AjaxRequestController::class, 'dokter']);
    Route::get('petugas', [AjaxRequestController::class, 'petugas']);
    Route::get('perawat', [AjaxRequestController::class, 'perawat']);
    Route::get('kamar', [AjaxRequestController::class, 'kamar']);
    Route::get('unit', [AjaxRequestController::class, 'unit']);
    Route::get('get_dokter', [AjaxRequestController::class, 'get_dokter']);
    Route::get('get_perawat', [AjaxRequestController::class, 'get_perawat']);
    Route::get('diagnosa', [AjaxRequestController::class, 'diagnosa']);

    Route::get('hapus_dokumen_kunjungan', [AjaxRequestController::class, 'hapus_dokumen_kunjungan']);

    Route::get('perujuk', [AjaxRequestController::class, 'perujuk']);
    Route::get('perujuk_by_kodedokter', [AjaxRequestController::class, 'perujuk_by_kodedokter']);
    Route::get('farmasi_layani_antrian', [AntrianFarmasiController::class, 'layani_antrian']);
    Route::get('farmasi_selesai_antrian', [AntrianFarmasiController::class, 'selesai_antrian']);
    Route::post('tambah_pasien_umum', [AjaxRequestController::class, 'tambah_pasien_umum']);
    Route::post('tambah_pasien_bpjs', [AjaxRequestController::class, 'tambah_pasien_bpjs']);
    Route::post('pasien_daftar', [AjaxRequestController::class, 'pasien_daftar']);
    Route::get('data_master_form_pendaftaran', [AjaxRequestController::class, 'data_master_form_pendaftaran']);
    Route::get('get_antrian_selesai_poli', [AjaxRequestController::class, 'get_antrian_selesai_poli']);
    Route::get('get_kabupaten', [GuestRegistrationController::class, 'ajax_request_kabupaten']);
    Route::get('get_kecamatan', [GuestRegistrationController::class, 'ajax_request_kecamatan']);
    Route::get('get_kelurahan', [GuestRegistrationController::class, 'ajax_request_kelurahan']);
    Route::get('get_pasien_by_nrm_or_ktp', [GuestRegistrationController::class, 'ajax_request_pasien']);
    Route::get('get_pasien_by_bpjs_rujukan', [GuestRegistrationController::class, 'ajax_request_pasien_bpjs']);
    Route::get('dokter_by_poli', [GuestRegistrationController::class, 'ajax_request_dokter_by_poli']);
    Route::get('jam_praktek_by_dokter', [GuestRegistrationController::class, 'ajax_request_jam_praktek_by_dokter']);
    Route::get('set_session', [AuthController::class, 'set_session']);
    Route::get('jumlah_kunjungan', [DashboardController::class, 'ajax_jumlah_kunjungan']);
    Route::get('jumlah_kunjungan_berdasarkan_cara_bayar', [DashboardController::class, 'ajax_jumlah_kunjungan_berdasarkan_cara_bayar']);
    Route::get('jumlah_kunjungan_berdasarkan_jenis_kelamin', [DashboardController::class, 'ajax_jumlah_kunjungan_berdasarkan_jenis_kelamin']);
    Route::get('jumlah_kunjungan_tertinggi_kecamatan', [DashboardController::class, 'ajax_jumlah_kunjungan_tertinggi_kecamatan']);
    Route::get('jumlah_kunjungan_terendah_kecamatan', [DashboardController::class, 'ajax_jumlah_kunjungan_terendah_kecamatan']);
    Route::get('jumlah_kunjungan_berdasarkan_baru_lama', [DashboardController::class, 'ajax_jumlah_kunjungan_berdasarkan_baru_lama']);
    Route::get('jumlah_kunjungan_rawat_jalan', [DashboardController::class, 'ajax_jumlah_kunjungan_rawat_jalan']);
    Route::get('jumlah_ketersediaan_kamar', [DashboardController::class, 'ajax_jumlah_ketersediaan_kamar']);
    Route::get('jumlah_kunjungan_rawat_inap', [DashboardController::class, 'ajax_jumlah_kunjungan_rawat_inap']);
    Route::get('jumlah_kunjungan_tertinggi_diagnosa', [DashboardController::class, 'ajax_jumlah_kunjungan_tertinggi_diagnosa']);
    Route::get('filter_resume_medis', [ResumeMedisController::class, 'ajax_filter_resume_medis']);
    Route::get('filter_dokumen_rm', [DokumenRmController::class, 'ajax_filter_dokumen_rm']);
    Route::get('search/menu', [AuthController::class, 'ajax_search_menu']);
    Route::get('select/user', [PenggunaController::class, 'ajax_select_user']);
    Route::get('search_vendor', [LaporanHutangPoController::class, 'ajaxSearchVendor']);
    Route::get('prepare_excel', [LaporanHutangPoController::class, 'ajax_prepare_excel']);
    Route::get('write_excel', [LaporanHutangPoController::class, 'ajaxWriteExcel']);
    Route::post('write_excel', [LaporanHutangPoController::class, 'ajaxWriteExcel']);
    Route::get('doing_filter_laporan_hutang_po', [LaporanHutangPoController::class, 'ajaxDoingFilter']);
    Route::get('doing_filter_laporan_hutang_non_po', [LaporanHutangNonPoController::class, 'ajaxDoingFilter']);
    Route::get('prepare_excel/laporan_hutang_non_po', [LaporanHutangNonPoController::class, 'ajax_prepare_excel']);
    Route::post('write_excel/laporan_hutang_non_po', [LaporanHutangNonPoController::class, 'ajaxWriteExcel']);
    Route::get('hpp', [HppController::class, 'ajax_get_hpp']);
    Route::get('update_referensi_dokter', [ReferensiDokterController::class, 'update_dokter']);
    Route::get('select_jadwal_poli', [JadwalPoliLocalController::class, 'ajax_request_select_jadwal_poli']);
    Route::post('post_credentials_antrian', [CredentialsAntrianController::class, 'post_credentials']);
    Route::get('referensi_jadwal_dokter', [JadwalPoliBpjsController::class, 'referensi_jadwal_dokter']);
    Route::get('dashboard_bpjs_per_tanggal', [DashboardAntrianController::class, 'ajax_per_tanggal']);
    Route::get('dashboard_bpjs_per_bulan', [DashboardAntrianController::class, 'ajax_per_bulan']);
    Route::get('antrian_by_kode_booking', [CheckinController::class, 'antrian_by_kode_booking']);
    Route::get('checkin', [CheckinController::class, 'checkin']);
    Route::post('send_broadcast', [GuestRegistrationController::class, 'send_broadcast']);
    Route::get('filter_antrian_poli', [AntrianPoliController::class, 'filter']);
    Route::get('layani_poli', [AntrianPoliController::class, 'layani_antrian']);
    Route::get('selesai_poli', [AntrianPoliController::class, 'selesai_antrian']);
    Route::get('antrian_operasi_rs', [AntrianOperasiController::class, 'ajax_request_antrian_operasi']);
    Route::get('refresh_operasi', [AntrianOperasiController::class, 'ajax_request_refresh_operasi']);
    Route::get('get_operasi', [AntrianOperasiController::class, 'ajax_get_operasi']);
    Route::get('list_task_id', [WaktuTaskIdController::class, 'ajax_request_list_task_id']);
    Route::get('antrian_pendaftaran', [AntrianPendaftaranController::class, 'ajax_request_antrian']);
    Route::get('antrian_farmasi', [AntrianFarmasiController::class, 'ajax_request_antrian']);
    Route::get('datatable_pasien', [AntrianOperasiController::class, 'datatable_pasien']);
    Route::get('datatable_rekap_antrian/{dari}/{sampai}', [RekapAntrianController::class, 'datatable_rekap_antrian']);
    Route::get('select_mjkn_patient', [AjaxRequestController::class, 'select_mjkn_patient']);
    Route::get('mjkn_patient', [AjaxRequestController::class, 'pasien_mjkn']);
    Route::get('antrian_obat', [AjaxRequestController::class, 'antrian_obat']);
    Route::get('antrian_manual', [AjaxRequestController::class, 'antrian_manual']);
    Route::get('ambil_antrian_farmasi', [AjaxRequestController::class, 'ambil_antrian_farmasi']);
    Route::get('update_poli', [ReferensiPoliController::class, 'update_poli']);

    Route::get('patient_and_history_by_nrm', [AjaxRequestController::class, 'patient_and_history_by_nrm']);
    Route::get('filter_erm_rajal', [ErmRajalController::class, 'ajax_filter_data']);
    Route::get('filter_erm_dokter', [ErmDokterController::class, 'ajax_filter_data']);
    Route::get('filter_erm_ranap', [ErmRanapController::class, 'ajax_filter_data']);

    Route::get('dokumen_kunjungan', [AjaxRequestController::class, 'dokumen_kunjungan']);
    Route::post('create_dokumen_kunjungan', [AjaxRequestController::class, 'create_dokumen_kunjungan']);
    Route::get('dokumen_kunjungan_by_noreg', [AjaxRequestController::class, 'dokumen_kunjungan_by_noreg']);
    Route::get('dokumen_kunjungan_rajal', [AjaxRequestController::class, 'dokumen_kunjungan_rajal']);

    Route::get('diagnosa_by_noreg', [AjaxRequestController::class, 'diagnosa_by_noreg']);
    Route::get('diagnosa_by_id', [AjaxRequestController::class, 'diagnosa_by_id']);
    Route::get('autocomplete_diagnosa', [AjaxRequestController::class, 'autocomplete_diagnosa']);
    Route::get('autocomplete_dokter', [AjaxRequestController::class, 'autocomplete_dokter']);
    Route::post('update_diagnosa', [AjaxRequestController::class, 'update_diagnosa']);
    Route::post('update_diagnosa_by_id', [AjaxRequestController::class, 'update_diagnosa_by_id']);

    Route::post('resep_store', [AjaxRequestController::class, 'resep_store']);
    Route::post('resep_store_by_id', [AjaxRequestController::class, 'resep_store_by_id']);
    Route::post('resep_update', [AjaxRequestController::class, 'resep_update']);
    Route::get('preview_resep', [AjaxRequestController::class, 'preview_resep']);
    Route::get('lock_resep', [AjaxRequestController::class, 'lock_resep']);

    Route::get('select_kunjungan', [AjaxRequestController::class, 'select_kunjungan']);
    Route::get('select_resep', [AjaxRequestController::class, 'select_resep']);
    Route::get('list_obat', [AjaxRequestController::class, 'list_obat']);
    Route::get('harga_obat', [AjaxRequestController::class, 'harga_obat']);
    Route::get('autocomplete_obat', [AjaxRequestController::class, 'autocomplete_obat']);
    Route::get('datatable_dokter', [AjaxRequestController::class, 'datatable_dokter']);
    Route::get('datatable_dokter_dan_perawat', [AjaxRequestController::class, 'datatable_dokter_dan_perawat']);

    Route::get('pesanan_lab_by_noreg', [AjaxRequestController::class, 'pesanan_lab_by_noreg']);
    Route::post('pesanan_lab_store', [AjaxRequestController::class, 'pesanan_lab_store']);
    Route::post('pesanan_lab_store_by_id', [AjaxRequestController::class, 'pesanan_lab_store_by_id']);
    Route::get('pesanan_lab_by_id', [AjaxRequestController::class, 'pesanan_lab_by_id']);
    Route::get('pesanan_radiologi_by_noreg', [AjaxRequestController::class, 'pesanan_radiologi_by_noreg']);
    Route::get('pesanan_radiologi_by_id', [AjaxRequestController::class, 'pesanan_radiologi_by_id']);
    Route::post('pesanan_radiologi_store', [AjaxRequestController::class, 'pesanan_radiologi_store']);
    Route::post('pesanan_radiologi_store_by_id', [AjaxRequestController::class, 'pesanan_radiologi_store_by_id']);

    Route::group(['prefix' => 'aplicare'], function () {
        Route::post('post_credentials', [AplicareController::class, 'post_credentials']);
        Route::get('available_beds', [AplicareCOntroller::class, 'available_beds']);
        Route::get('create_beds', [AplicareController::class, 'create_beds']);
        Route::get('update_beds', [AplicareController::class, 'update_beds']);
        Route::get('delete_beds', [AplicareController::class, 'delete_beds']);
    });

    Route::get('icd_by_nama', [AjaxRequestController::class, 'icd_by_nama']);
    Route::post('update_pesanan', [AjaxRequestController::class, 'update_pesanan']);
    Route::post('update_smis_doc_asesmen_awal_pasien_ranap_neonatus', [ErmRanapController::class, 'update_smis_doc_asesmen_awal_pasien_ranap_neonatus']);

    Route::get('riwayat_lab', [AjaxRequestController::class, 'riwayat_lab']);
    Route::get('riwayat_rad', [AjaxRequestController::class, 'riwayat_rad']);
    Route::get('riwayat_rm', [AjaxRequestController::class, 'riwayat_rm'])->name('ajax.riwayat_rm');
});

Route::get('pendaftaran_display', function () {
    return view('antrian.display_pendaftaran');
});

Route::get('add_jadwal_cuti', [GuestRegistrationController::class, 'pendaftaran_dislay']);

Route::get('poli_display_v2', [GuestRegistrationController::class, 'display_poli']);
Route::get('poli_display', function () {
    return view('antrian.display_poli');
});

Route::get('farmasi_display_v2', [GuestRegistrationController::class, 'display_farmasi']);
Route::get('farmasi_display', function () {
    return view('antrian.display_farmasi');
});

Route::get('display_IGD', [GuestRegistrationController::class, 'display_IGD']);

Route::get('operasi_display', function () {
    $data['antrian'] = JadwalOperasiRs::join('smis_rg_patient', 'jadwal_operasi_rs.nrm', 'smis_rg_patient.id')
        ->select('jadwal_operasi_rs.*', 'smis_rg_patient.nama', 'smis_rg_patient.id as id_pasien', 'smis_rg_patient.alamat')->where('smis_rg_patient.prop', '')->where('tanggaloperasi', date('Y-m-d'))->get();
    return view('antrian.display_operasi', $data);
});

Route::get('operasi_display_v2', function () {
    $ukuran_halaman = 5;

    $data['ant_belum'] =
        JadwalOperasiRs::join(
            'smis_rg_patient',
            'jadwal_operasi_rs.nrm',
            'smis_rg_patient.id'
        )
        ->select(
            'jadwal_operasi_rs.jenistindakan',
            'jadwal_operasi_rs.namapoli',
            'smis_rg_patient.nama',
        )
        ->where('smis_rg_patient.prop', "")
        ->where('tanggaloperasi', date('Y-m-d'))
        // ->where('jadwal_operasi_rs.tanggaloperasi', "2024-07-17")
        ->where('jadwal_operasi_rs.terlaksana', 0)
        ->groupBy("jadwal_operasi_rs.jenistindakan", "jadwal_operasi_rs.namapoli", "smis_rg_patient.nama")
        ->orderBy("smis_rg_patient.nama")
        ->get();

    $len_loop = ceil(count($data['ant_belum']) / $ukuran_halaman);
    $ls_ant_temp = [];
    for ($i = 0; $i < $len_loop; $i++) {
        if ($i == 0) {
            $ls_ant_temp[] = array_slice($data['ant_belum']->toArray(), $i, 5);
        } else {
            $ls_ant_temp[] = array_slice($data['ant_belum']->toArray(), $ukuran_halaman * $i, 5);
        }
    }
    $data['total_ant_belum'] = count($data['ant_belum']);
    $data['ant_belum'] = $ls_ant_temp;

    $data['ant_sudah'] =
        JadwalOperasiRs::join(
            'smis_rg_patient',
            'jadwal_operasi_rs.nrm',
            'smis_rg_patient.id'
        )
        ->select(
            'jadwal_operasi_rs.jenistindakan',
            'jadwal_operasi_rs.namapoli',
            'smis_rg_patient.nama',
        )
        ->where('smis_rg_patient.prop', "")
        ->where('tanggaloperasi', date('Y-m-d'))
        // ->where('tanggaloperasi', "2024-07-17")
        ->where('jadwal_operasi_rs.terlaksana', 1)
        ->groupBy("jadwal_operasi_rs.jenistindakan", "jadwal_operasi_rs.namapoli", "smis_rg_patient.nama")
        ->orderBy("smis_rg_patient.nama")
        ->get();

    $len_loop = ceil(count($data['ant_sudah']) / $ukuran_halaman);
    $ls_ant_temp = [];
    for ($i = 0; $i < $len_loop; $i++) {
        if ($i == 0) {
            $ls_ant_temp[] = array_slice($data['ant_sudah']->toArray(), $i, 5);
        } else {
            $ls_ant_temp[] = array_slice($data['ant_sudah']->toArray(), $ukuran_halaman * $i, 5);
        }
    }
    $data['total_ant_sudah'] = count($data['ant_sudah']);
    $data['ant_sudah'] = $ls_ant_temp;

    return view('antrian.display_operasi_v2', $data);
});

// TODO
Route::get('kasir_display_laporan_uang_masuk', function () {
    return view('kasir.display_laporan_uang_masuk', []);
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'registration/lap_data_pasien'], function () {
        Route::controller(LapDataPasienController::class)->group(function(){
            Route::get('/', 'index');
            Route::get('prepare_file_excel', 'prepare_file_excel');
            Route::get('data_pasien', 'data_pasien');
            Route::get('write_file_excel', 'write_file_excel');
            Route::get('export','export');
        });
    });

    Route::group(['prefix' => 'aplicare'], function () {
        Route::get('aplicare', [AplicareController::class, 'kamar_tersedia']);
        // Route::get('display', [AplicareController::class, 'display']);
        Route::get('credentials', [AplicareController::class, 'credentials']);
    });

    Route::group(['prefix' => 'antrian'], function () {
        Route::post('batal_antrian', [AntrianPendaftaranController::class, 'batal_antrian']);
        Route::get('pendaftaran', [AntrianPendaftaranController::class, 'index']);
        Route::get('pendaftaran_layani_antrian', [AntrianPendaftaranController::class, 'layani_antrian']);
        Route::get('pendaftaran_selesai_antrian', [AntrianPendaftaranController::class, 'selesai_antrian']);
        Route::get('poli', [AntrianPoliController::class, 'index']);
        Route::get('farmasi', [AntrianFarmasiController::class, 'index']);
        Route::put('pendaftaran/mjkn_patient/update', [AntrianPendaftaranController::class, 'mjkn_patient_update']);
        Route::get('pendaftaran/pasien_mjkn_daftar', [AntrianPendaftaranController::class, 'pasien_mjkn_daftar']);

        Route::get('rekap', [RekapAntrianController::class, 'index']);
        Route::get('rekap/export', [RekapAntrianController::class, 'export']);

        Route::group(['prefix' => 'operasi'], function () {
            Route::controller(AntrianOperasiController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('post', 'post');
                Route::put('update', 'update');
                Route::get('delete', 'delete');
                Route::get('laksanakan', 'laksanakan');
            });
        });

        Route::get('list_task_id', [WaktuTaskIdController::class, 'index']);
    });

    Route::get('/home', function () {
        $data['banner'] = Banner::first();
        return view('home', $data);
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('pelayanan', [DashboardController::class, 'index']);
        Route::get('antrian', [DashboardAntrianController::class, 'index']);
    });

    Route::group(['prefix' => 'profil'], function () {
        Route::get('/', [ProfilController::class, 'index']);
        Route::post('create', [ProfilController::class, 'store']);
    });

    Route::group(['prefix' => 'banner'], function () {
        Route::get('/', [BannerController::class, 'index']);
        Route::post('create', [BannerController::class, 'store']);
    });

    Route::group(['prefix' => 'hak_akses'], function () {
        Route::get('/', [HakAksesController::class, 'index']);
        Route::get('cari', [HakAksesController::class, 'search']);
        Route::get('create', [HakAksesController::class, 'create']);
        Route::post('create', [HakAksesController::class, 'store']);
    });

    Route::group(['prefix' => 'keuangan'], function () {
        Route::controller(KeuanganController::class)->group(function () {
            Route::get('/', 'index')->name('keuangan.index');
            Route::post('/create', 'createUpdate')->name('keuangan.create');
        });
    });

    Route::group(['prefix' => 'pengguna'], function () {
        Route::get('/', [PenggunaController::class, 'index']);
        Route::get('/cari', [PenggunaController::class, 'search']);
        Route::post('create', [PenggunaController::class, 'store']);
        Route::put('update', [PenggunaController::class, 'update']);
        Route::get('ajax_request/select/user', [PenggunaController::class, 'ajax_select_pengguna']);
        Route::get('delete', [PenggunaController::class, 'delete']);
    });

    Route::get('logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'nama_ruangan_igd'], function () {
        Route::get('/', [RuanganIgdController::class, 'index']);
        Route::post('create', [RuanganIgdController::class, 'store']);
    });

    Route::group(['prefix' => 'medical_record'], function () {
        Route::group(['prefix' => 'resume_medis'], function () {
            Route::get('/', [ResumeMedisController::class, 'index']);
            Route::get('download', [ResumeMedisController::class, 'download']);
        });

        Route::group(['prefix' => 'dokumen_rm'], function () {
            Route::get('/', [DokumenRmController::class, 'index']);
            Route::get('download', [DokumenRmController::class, 'download']);
        });
    });

    Route::group(['prefix' => 'laporan_keuangan'], function () {
        Route::get('laporan_hutang_po', [LaporanHutangPoController::class, 'index']);
        Route::get('laporan_hutang_po/download_excel', [LaporanHutangPoController::class, 'downloadExcel'])->name('download.excel');
        Route::get('laporan_hutang_non_po', [LaporanHutangNonPoController::class, 'index']);
        Route::get('laporan_hutang_non_po/download_excel', [LaporanHutangNonPoController::class, 'downloadExcel'])->name('download.excel.laporan_hutang_non_po');
    });

    Route::group(['prefix' => 'kasir'], function () {
        Route::get('hpp', [HppController::class, 'index']);
        Route::get('hpp/download', [HppController::class, 'download']);

        Route::controller(LaporanDetailHppController::class)->group(function () {
            Route::group(['prefix' => 'laporan_detail_hpp'], function () {
                Route::get('/', 'index');
                Route::get('filter', 'filter')->name('laporan_detail_hpp.filter');
                Route::get('download', 'download')->name('laporan_detail_hpp.download');
            });
        });
    });

    Route::controller(OPLJasaController::class)->group(function () {
        Route::group(['prefix' => 'pembelian/po-jasa'], function () {
            //ajax
            Route::get('vendor', 'getVendor');
            Route::get('barang', 'getBarang');
            //index
            Route::get('/', 'index');
            Route::get('po-mandiri', 'OPLMandiri');
            Route::get('lihat', 'detailOPL');
            //edit
            Route::get('edit', 'editOPL');
            //store
            Route::post('opl-mandiri/store', 'storeOplMandiri');

            Route::get('hapus', 'hapus');
            Route::get('hapus-detail', 'hapusDetail');

            Route::get('cari', 'search');
            // Route::get('hpp/download', [HppController::class, 'download']);
        });
    });

    Route::group(['prefix' => 'hrd'], function () {
        Route::group(['prefix' => 'data_induk'], function () {
            Route::get('/', [DataIndukBagianController::class, 'index']);
            Route::get('bagian/cari', [DataIndukBagianController::class, 'search'])->name('bagian.search');
            Route::get('bagian/download', [DataIndukBagianController::class, 'download'])->name('bagian.download');
            Route::resource('bagian', DataIndukBagianController::class);

            Route::get('ruangan_pegawai/cari', [DataIndukRuanganPegawaiController::class, 'search'])->name('ruangan_pegawai.search');
            Route::get('ruangan_pegawai/download', [DataIndukRuanganPegawaiController::class, 'download'])->name('ruangan_pegawai.download');
            Route::resource('ruangan_pegawai', DataIndukRuanganPegawaiController::class);

            Route::get('status_tenaga/cari', [DataIndukStatusTenagaController::class, 'search'])->name('status_tenaga.search');
            Route::get('status_tenaga/download', [DataIndukStatusTenagaController::class, 'download'])->name('status_tenaga.download');
            Route::resource('status_tenaga', DataIndukStatusTenagaController::class);

            Route::get('pendidikan/cari', [DataIndukPendidikanController::class, 'search'])->name('pendidikan.search');
            Route::get('pendidikan/download', [DataIndukPendidikanController::class, 'download'])->name('pendidikan.download');
            Route::resource('pendidikan', DataIndukPendidikanController::class);
        });

        Route::resource('data_karyawan', DataKaryawanController::class);
    });

    Route::group(['prefix' => 'jadwal_poli'], function () {
        Route::get('referensi_poli', [ReferensiPoliController::class, 'index']);
        Route::get('referensi_dokter', [ReferensiDokterController::class, 'index']);
        Route::get('local', [JadwalPoliLocalController::class, 'index']);
        Route::post('create', [JadwalPoliLocalController::class, 'post_jadwal_poli']);
        Route::put('update', [JadwalPoliLocalController::class, 'update_jadwal_poli']);
        Route::get('delete', [JadwalPoliLocalController::class, 'delete_jadwal_poli']);
        Route::get('bpjs', [JadwalPoliBpjsController::class, 'index']);
        Route::get('credentials', [CredentialsAntrianController::class, 'index']);
    });

    Route::group(['prefix' => 'keuangan_kas_bank'], function () {
        Route::delete('invoice/{id}/delete_detail', [InvoiceController::class, 'destroyDetail'])->name('invoice.destroy_detail');
        Route::get('invoice/search', [InvoiceController::class, 'search'])->name('invoice.search');
        Route::get('invoice/download/{id}', [InvoiceController::class, 'download'])->name('invoice.download');
        Route::get('invoice/view/{no_invoice}', [InvoiceController::class, 'viewPDF'])->name('invoice.view_pdf');
        Route::resource('invoice', InvoiceController::class);

        Route::controller(CasemixController::class)->group(function () {
            Route::group(['prefix' => 'casemix'], function () {
                Route::get('/', 'index')->name('casemix.index');
                Route::get('/filter', 'filter')->name('casemix.filter');
                Route::get('/search', 'search')->name('casemix.search');
                Route::get('/cek_casemix_folder', 'checkCasemixFolder')->name('casemix.checkfolder');
                Route::get('/download_casemix', 'downloadCasemix')->name('casemix.download');
                Route::post('/manual_upload', 'uploadFileManual')->name('casemix.manual_upload');
                Route::post('/merge_document', 'mergeDocument')->name('casemix.merge_document');
            });
        });
    });

    Route::group(['prefix' => 'asuransi'], function () {
        Route::get('/', [SettingAsuransiController::class, 'index']);
        Route::get('select', [SettingAsuransiController::class, 'select']);
    });

    Route::group(['prefix' => 'accounting'], function () {
        Route::controller(LoaderBpjsLayakController::class)->group(function () {
            Route::group(['prefix' => 'loader_bpjs_layak'], function () {
                Route::get('/', 'index')->name('loader_bpjs_layak.index');
                Route::get('detail/{id}', 'detail')->name('loader_bpjs_layak.detail');
                Route::post('store', 'store')->name('loader_bpjs_layak.store');
                Route::post('import', 'import')->name('loader_bpjs_layak.import');
                Route::get('/data_generate/{id}', 'dataGenerate')->name('loader_bpjs_layak.data_generate');
                Route::post('/post_draft', 'postToDraftJurnal')->name('loader_bpjs_layak.post_draft');
                Route::post('/post_detail_draft', 'postToDraftDetailJurnal')->name('loader_bpjs_layak.post_detail_draft');
                Route::delete('destroy/{id}', 'destroy')->name('loader_bpjs_layak.destroy');
            });
        });

        Route::controller(LaporanLabaRugiController::class)->group(function () {
            Route::group(['prefix' => 'laporan_laba_rugi'], function () {
                Route::get('/', 'index')->name('laporan_laba_rugi.index');
                Route::get('filter', 'filter')->name('laporan_laba_rugi.filter');
                Route::get('download', 'download')->name('laporan_laba_rugi.download');
            });
        });

        Route::controller(LoaderBpjsDiverifikasiController::class)->group(function () {
            Route::group(['prefix' => 'loader_bpjs_diverifikasi'], function () {
                Route::get('/', 'index')->name('loader_bpjs_diverifikasi.index');
                Route::get('detail/{id}', 'detail')->name('loader_bpjs_diverifikasi.detail');
                Route::get('detail/{id}/edit', 'detailById')->name('loader_bpjs_diverifikasi.detail_edit');
                Route::post('store', 'store')->name('loader_bpjs_diverifikasi.store');
                Route::post('generate_detail', 'generateDetail')->name('loader_bpjs_diverifikasi.generate_detail');
                Route::put('detail', 'updateDetail')->name('loader_bpjs_diverifikasi.update_detail');
                Route::post('import', 'import')->name('loader_bpjs_diverifikasi.import');
                Route::get('/data_generate/{id}', 'dataGenerate')->name('loader_bpjs_diverifikasi.data_generate');
                Route::post('/post_draft', 'postToDraftJurnal')->name('loader_bpjs_diverifikasi.post_draft');
                Route::post('/post_detail_draft', 'postToDraftDetailJurnal')->name('loader_bpjs_diverifikasi.post_detail_draft');
                Route::delete('destroy/{id}', 'destroy')->name('loader_bpjs_diverifikasi.destroy');
            });
        });

        Route::controller(LapRiwayatAccJurnalController::class)->group(function () {
            Route::group(['prefix' => 'lap_riwayat_jurnal'], function () {
                Route::get('/', 'index')->name('lap_riwayat_jurnal.index');
                Route::get('/filter', 'filter')->name('lap_riwayat_jurnal.filter');
                Route::get('/download', 'download')->name('lap_riwayat_jurnal.download');
            });
        });
    });

    Route::group(['prefix' => 'data_riwayat'], function () {
        Route::controller(RiwayatPasienController::class)->group(function () {
            Route::group(['prefix' => 'riwayat'], function () {
                Route::get('/', 'index')->name('riwayat.index');
                Route::get('filter', 'filter')->name('riwayat.filter');
                Route::get('download', 'download')->name('riwayat.download');
            });
        });
    });

    Route::group(['prefix' => 'manajer_tarif'], function () {
        Route::group(['prefix' => 'tindakan_dokter'], function () {
            Route::get('/', [KonsulDokterController::class, 'index']);
            Route::get('konsul_dokter/search', [KonsulDokterController::class, 'search'])->name('konsul_dokter.search');
            Route::get('konsul_dokter/download', [KonsulDokterController::class, 'download'])->name('konsul_dokter.download');
            Route::post('konsul_dokter/import', [KonsulDokterController::class, 'import'])->name('konsul_dokter.import');
            Route::resource('konsul_dokter', KonsulDokterController::class);

            Route::get('tindakan_dokter_inap/search', [TindakanDokterInapController::class, 'search'])->name('tindakan_dokter_inap.search');
            Route::post('tindakan_dokter_inap/import', [TindakanDokterInapController::class, 'import'])->name('tindakan_dokter_inap.import');
            Route::get('tindakan_dokter_inap/download', [TindakanDokterInapController::class, 'download'])->name('tindakan_dokter_inap.download');
            Route::resource('tindakan_dokter_inap', TindakanDokterInapController::class);

            Route::get('tindakan_dokter_jalan/search', [TindakanDokterJalanController::class, 'search'])->name('tindakan_dokter_jalan.search');
            Route::post('tindakan_dokter_jalan/import', [TindakanDokterJalanController::class, 'import'])->name('tindakan_dokter_jalan.import');
            Route::get('tindakan_dokter_jalan/download', [TindakanDokterJalanController::class, 'download'])->name('tindakan_dokter_jalan.download');
            Route::resource('tindakan_dokter_jalan', TindakanDokterJalanController::class);

            Route::get('periksa_dokter/search', [PeriksaDokterController::class, 'search'])->name('periksa_dokter.search');
            Route::post('periksa_dokter/import', [PeriksaDokterController::class, 'import'])->name('periksa_dokter.import');
            Route::get('periksa_dokter/download', [PeriksaDokterController::class, 'download'])->name('periksa_dokter.download');
            Route::resource('periksa_dokter', PeriksaDokterController::class);

            Route::get('visite_dokter/search', [VisiteDokterController::class, 'search'])->name('visite_dokter.search');
            Route::post('visite_dokter/import', [VisiteDokterController::class, 'import'])->name('visite_dokter.import');
            Route::get('visite_dokter/download', [VisiteDokterController::class, 'download'])->name('visite_dokter.download');
            Route::resource('visite_dokter', VisiteDokterController::class);
        });
    });

    Route::group(['prefix' => 'e_rekam_medis'], function () {
        Route::get('pendaftaran', [ErmPendaftaranController::class, 'index']);
        Route::get('pendaftaran/detail', [ErmPendaftaranController::class, 'detail']);
        Route::get('pendaftaran/detail/show_dokumen', [ErmPendaftaranController::class, 'show_dokumen']);
        Route::get('pendaftaran/detail/pdf_identitas', [ErmPendaftaranController::class, 'pdf_identitas']);
        Route::post('pendaftaran/detail/verifikasi_petugas', [ErmPendaftaranController::class, 'verifikasi_petugas']);
        Route::post('pendaftaran/detail/upload_ttd_pasien', [ErmPendaftaranController::class, 'upload_signature_pasien']);
        // Route::get('detail/surat_pernyataan_naik_kelas', [ErmPendaftaranController::class, 'surat_pernyataan_naik_kelas']);
        // Route::post('detail/save_pernyataan_naik_kelas', [ErmPendaftaranController::class, 'save_pernyataan_naik_kelas']);

        Route::post('upload_dokumen_kunjungan', [ErmRekamMedisController::class, 'upload_dokumen_kunjungan']);
        Route::get('download_dokumen_kunjungan', [ErmRekamMedisController::class, 'download_dokumen_kunjungan']);

        Route::group(['prefix' => 'rawat_jalan'], function () {
            Route::get('/', [ErmRajalController::class, 'index']);
            Route::get('detail', [ErmRajalController::class, 'detail']);
            Route::post('ajax_create_dokumen_kunjungan', [ErmRajalController::class, 'ajax_create_dokumen_kunjungan']);
            Route::post('catatan_perkembangan_pasien_terintegrasi/verifikasi', [ErmRajalController::class, 'save_catatan_perkembangan_pasien_terintegrasi']);
            Route::get('catatan_perkembangan_pasien_terintegrasi/download_dokumen_penunjang_eksternal', [ErmRajalController::class, 'download_dokumen_penunjang_eksternal_cppt']);
        });

        Route::group(['prefix' => 'dokter'], function () {
            Route::get('/', [ErmDokterController::class, 'index']);
            Route::get('detail', [ErmDokterController::class, 'detail']);
            Route::post('ajax_create_dokumen_kunjungan', [ErmDokterController::class, 'ajax_create_dokumen_kunjungan']);
        });

        Route::group(['prefix' => 'rawat_inap'], function () {
            Route::get('/', [ErmRanapController::class, 'index']);
            Route::get('detail', [ErmRanapController::class, 'detail']);
            Route::post('ajax_create_dokumen_kunjungan', [ErmRanapController::class, 'ajax_create_dokumen_kunjungan']);
            Route::get('datatable_tindakan_operasi', [ErmRanapController::class, 'datatable_tindakan_operasi']);
            Route::get('datatable_diagnosa', [ErmRanapController::class, 'datatable_diagnosa']);
            Route::get('datatable_employee', [ErmRanapController::class, 'datatable_employee']);
        });

        Route::controller(ErmPendaftaranController::class)->group(function () {
            Route::get('detail/general_consent', 'general_consent');
            Route::post('detail/save_general_consent', 'save_general_consent');
            Route::get('detail/pdf_general_consent', 'pdf_general_consent');
            Route::post('detail/verifikasi_dokumen_kunjungan', 'verifikasi_dokumen_kunjungan');
            Route::post('detail/save_ttd_dokumen_kunjungan', 'save_ttd_general_consent');

            Route::get('detail/catatan_edukasi_pasien', 'catatan_edukasi_pasien');
            Route::get('detail/pdf_catatan_edukasi_pasien', 'pdf_catatan_edukasi');
            Route::post('detail/save_catatan_edukasi', 'save_catatan_edukasi');

            Route::get('detail/surat_pernyataan_penitipan_kelas', 'surat_pernyataan_penitipan_kelas');
            Route::post('detail/sign_surat_pernyataan_penitipan_kelas', 'sign_surat_pernyataan_penitipan_kelas');
            Route::post('detail/verif_surat_pernyataan_penitipan_kelas', 'verif_surat_pernyataan_penitipan_kelas');

            Route::get('/detail/formulir_surat_pernyataan_rawat_inap', 'formulir_surat_pernyataan_rawat_inap');
            Route::post('/detail/save_formulir_surat_pernyataan_rawat_inap', 'save_formulir_surat_pernyataan_rawat_inap');
            Route::post('/detail/save_ttd_formulir_surat_pernyataan_rawat_inap', 'save_ttd_formulir_surat_pernyataan_rawat_inap');

            Route::group(['prefix' => 'detail/bukti_pendaftaran_rawat_inap'], function () {
                Route::get('/', 'bukti_pendaftaran_rawat_inap');
                Route::post('store', 'bukti_pendaftaran_rawat_inap_store');
            });

            Route::group(['prefix' => 'detail/tata_tertib_dan_peraturan_pelayanan_rawat_inap'], function () {
                Route::get('/', 'tata_tertib_dan_peraturan_pelayanan_rawat_inap');
                Route::post('signature', 'tata_tertib_dan_peraturan_pelayanan_rawat_inap_signature');
                Route::post('verifikasi', 'tata_tertib_dan_peraturan_pelayanan_rawat_inap_verifikasi');
            });

            Route::group(['prefix' => 'detail/bukti_pendaftaran_rawat_jalan'], function () {
                Route::get('/', 'bukti_pendaftaran_rawat_jalan');
                Route::post('store', 'bukti_pendaftaran_rawat_jalan_store');
            });

            Route::controller(SkriningGiziRawatInapController::class)->group(function () {
                Route::group(['prefix' => 'detail/skrining_gizi_rawat_inap'], function () {
                    Route::get('/', 'skrining_gizi_rawat_inap');
                    Route::post('store', 'skrining_gizi_rawat_inap_store');
                    Route::post('verifikasi', 'verifikasi_skrining_gizi_rawat_inap');
                });
            });

            Route::get('detail/surat_pernyataan_penitipan_kelas', 'surat_pernyataan_penitipan_kelas');
            Route::post('detail/sign_surat_pernyataan_penitipan_kelas', 'sign_surat_pernyataan_penitipan_kelas');
            Route::post('detail/verif_surat_pernyataan_penitipan_kelas', 'verif_surat_pernyataan_penitipan_kelas');
        });

        Route::controller(ErmRajalController::class)->group(function () {
            Route::get('detail/asesment_medis_awal_rawat_jalan', 'asesment_medis_awal');
            Route::get('detail/pdf_asesment_medis_awal_rawat_jalan', 'pdf_asesment_medis_awal');
            Route::post('detail/save_asesment_medis_awal_rawat_jalan', 'save_asesment_medis_awal');

            Route::get('detail/surat_permintaan_rawat_inap', 'surat_permintaan_rawat_inap');
            Route::get('detail/pdf_surat_permintaan_rawat_inap', 'pdf_surat_permintaan_rawat_inap');
            Route::post('detail/save_surat_permintaan_rawat_inap', 'save_surat_permintaan_rawat_inap');

            Route::get('detail/dokumen_transfer_pasien_internal', 'dokumen_transfer_pasien_internal');

            Route::post('detail/save_dokumen_transfer_pasien_internal', 'save_dokumen_transfer_pasien_internal');
            Route::post('detail/verifikasi_petugas_penyerahan', 'verifikasi_petugas_penyerahan');
            Route::get('detail/pdf_dokumen_transfer_pasien_internal', 'pdf_dokumen_transfer_pasien_internal');

            Route::get('detail/dokumen_laporan_caesarian', 'dokumen_laporan_caesarian');
            Route::post('detail/save_dokumen_laporan_caesarian', 'save_dokumen_laporan_caesarian');
            Route::get('detail/pdf_dokumen_laporan_caesarian', 'pdf_dokumen_laporan_caesarian');

            Route::get('detail/formulir_triage_terintegrasi', 'formulir_triage_terintegrasi');
            Route::post('detail/save_formulir_triage_terintegrasi', 'save_formulir_triage_terintegrasi');
            Route::get('detail/pdf_formulir_triage_terintegrasi', 'pdf_formulir_triage_terintegrasi');

            Route::get('detail/formulir_triage_terintegrasi_v2', 'formulir_triage_terintegrasi_v2');
            Route::post('detail/save_formulir_triage_terintegrasi_v2', 'save_formulir_triage_terintegrasi_v2');
            Route::get('detail/pdf_formulir_triage_terintegrasi_v2', 'pdf_formulir_triage_terintegrasi_v2');

            Route::get('detail/formulir_layanan_kedokteran_fisik_dan_rehabilitasi', 'formulir_layanan_kedokteran_fisik_dan_rehabilitasi');
            Route::post('detail/save_formulir_layanan_kedokteran_fisik_dan_rehabilitasi', 'save_formulir_layanan_kedokteran_fisik_dan_rehabilitasi');
            Route::get('detail/pdf_formulir_layanan_kedokteran_fisik_dan_rehabilitasi', 'pdf_formulir_layanan_kedokteran_fisik_dan_rehabilitasi');

            Route::get('detail/dokumen_asesment_awal_medis_gawat_darurat', 'dokumen_asesment_awal_medis_gawat_darurat');
            Route::post('detail/save_dokumen_asesment_awal_medis_gawat_darurat', 'save_dokumen_asesment_awal_medis_gawat_darurat');
            Route::get('detail/pdf_dokumen_asesment_awal_medis_gawat_darurat', 'pdf_dokumen_asesment_awal_medis_gawat_darurat');
            Route::get('hapus_gambar_status_lokalis', 'hapus_status_lokalis_dokumen_asesment_awal_medis_gawat_darurat');

            Route::get('detail/dokumen_asesment_awal_keperawatan_igd', 'dokumen_asesment_awal_keperawatan_igd');
            Route::post('detail/save_dokumen_asesment_awal_keperawatan_igd', 'save_dokumen_asesment_awal_keperawatan_igd');
            Route::get('detail/pdf_dokumen_asesment_awal_keperawatan_igd', 'pdf_dokumen_asesment_awal_keperawatan_igd');
            Route::get('hapus_gambar_lokalis', 'hapus_gambar_lokalis');

            Route::get('/detail/observasi_keperawatan_igd', 'observasi_keperawatan_igd');
            Route::post('/detail/save_observasi_keperawatan_igd', 'save_observasi_keperawatan_igd');
            Route::post('/detail/verifikasi_observasi_keperawatan_igd', 'verifikasi_observasi_keperawatan_igd');
            Route::get('/detail/hapus_observasi_keperawatan_igd/{id}', 'hapus_observasi_keperawatan_igd');

            Route::get('detail/penolakan_rawat_inap', 'penolakan_rawat_inap');
            Route::post('detail/save_penolakan_rawat_inap', 'save_penolakan_rawat_inap');
            Route::post('detail/verif_penolakan_rawat_inap', 'verif_penolakan_rawat_inap');
            Route::post('detail/verif_penolakan_rawat_inap2', 'verif_penolakan_rawat_inap2');
            Route::post('detail/sign_penolakan_rawat_inap', 'sign_penolakan_rawat_inap');

            Route::get('detail/lembar_hasil_tindakan_uji_fungsi', 'lembar_hasil_tindakan_uji_fungsi');
            Route::post('detail/save_lembar_hasil_tindakan_uji_fungsi', 'save_lembar_hasil_tindakan_uji_fungsi');

            Route::get('detail/program_pelayanan_fisioterapi', 'program_pelayanan_fisioterapi');
            Route::post('detail/save_program_pelayanan_fisioterapi', 'save_program_pelayanan_fisioterapi');
            Route::post('detail/ttd_petugas_program_pelayanan_fisioterapi', 'ttd_petugas_program_pelayanan_fisioterapi');
            Route::post('detail/ttd_pasien_program_pelayanan_fisioterapi', 'ttd_pasien_program_pelayanan_fisioterapi');
            Route::post('detail/verif_program_pelayanan_fisioterapi', 'verif_program_pelayanan_fisioterapi');
        });

        Route::controller(ErmRanapController::class)->group(function () {
            Route::get('detail/dokumen_orientasi_pasien_baru', 'dokumen_orientasi_pasien_baru');
            Route::post('detail/save_dokumen_orientasi_pasien_baru', 'save_dokumen_orientasi_pasien_baru');
            Route::get('detail/pdf_dokumen_orientasi_pasien_baru', 'pdf_dokumen_orientasi_pasien_baru');

            Route::get('detail/catatan_perkembangan_pasien_terintegrasi', 'catatan_perkembangan_pasien_terintegrasi');
            Route::post('detail/save_catatan_perkembangan_pasien_terintegrasi', 'save_catatan_perkembangan_pasien_terintegrasi');
            Route::get('detail/pdf_catatan_perkembangan_pasien_terintegrasi', 'pdf_catatan_perkembangan_pasien_terintegrasi');

            Route::get('detail/assesment_ulang_nyeri_dan_intervensi', 'assesment_ulang_nyeri_dan_intervensi');
            Route::post('detail/save_assesment_ulang_nyeri_dan_intervensi', 'save_assesment_ulang_nyeri_dan_intervensi');
            Route::post('detail/verif_assesment_ulang_nyeri_dan_intervensi', 'verif_assesment_ulang_nyeri_dan_intervensi');
            Route::get('detail/pdf_assesment_ulang_nyeri_dan_intervensi', 'pdf_assesment_ulang_nyeri_dan_intervensi');

            Route::get('detail/asesmen_pra_anestesi_dan_sedasi', 'asesmen_pra_anestesi_dan_sedasi');
            Route::post('detail/save_asesmen_pra_anestesi_dan_sedasi', 'save_asesmen_pra_anestesi_dan_sedasi');
            Route::post('detail/verif_asesmen_pra_anestesi_dan_sedasi', 'verif_asesmen_pra_anestesi_dan_sedasi');
            Route::get('detail/pdf_asesmen_pra_anestesi_dan_sedasi', 'pdf_asesmen_pra_anestesi_dan_sedasi');

            Route::get('detail/re_assesment_resiko_jatuh', 'reassesment_resiko_jatuh');
            Route::post('detail/save_reassesment_resiko_jatuh', 'save_reassesment_resiko_jatuh');
            Route::post('detail/verif_reassesment_resiko_jatuh', 'verif_reassesment_resiko_jatuh');
            Route::post('detail/save_reassesment_resiko_jatuh_detail', 'save_reassesment_resiko_jatuh_detail');
            Route::get('detail/pdf_re_assesment_resiko_jatuh', 'pdf_reassesment_resiko_jatuh');


            Route::match(['GET', 'POST'], 'detail/rencana_keperawatan', 'rencana_keperawatan');
            Route::post('detail/verifikasi_dokumen', 'verifikasi_dokumen');
            Route::get('detail/rencana_keperawatan/pdf', 'pdf_rencana_keperawatan');
            Route::get('detail/pdf_rencana_keperawatan', 'pdf_rencana_keperawatan');

            Route::get('detail/asesmen_awal_kebidanan_rawat_inap', 'asesmen_awal_kebidanan_rawat_inap');
            Route::post('detail/save_asesmen_awal_kebidanan_rawat_inap', 'save_asesmen_awal_kebidanan_rawat_inap');
            Route::match(['GET', 'POST'], 'detail/daftar_tilik_pasien_operasi', 'daftar_tilik_pasien_operasi');
            Route::get('detail/pdf_daftar_tilik_pasien_operasi', 'pdf_daftar_tilik_pasien_operasi');

            Route::match(['GET', 'POST'], 'detail/assesment_perioperatif_medis', 'assesment_perioperatif_medis');
            Route::get('detail/pdf_assesment_perioperatif_medis', 'pdf_assesment_perioperatif_medis');

            Route::match(['GET', 'POST'], 'detail/formulir_kriteria_pasien_masuk_icu', 'formulir_kriteria_pasien_masuk_icu');
            Route::match(['GET', 'POST'], 'detail/formulir_kriteria_pasien_keluar_icu', 'formulir_kriteria_pasien_keluar_icu');
            Route::get('detail/pdf_formulir_kriteria_pasien_masuk_icu', 'pdf_formulir_kriteria_pasien_masuk_icu');
            Route::get('detail/pdf_formulir_kriteria_pasien_keluar_icu', 'pdf_formulir_kriteria_pasien_keluar_icu');

            Route::match(['GET', 'POST'], 'detail/early_warning_scoring_system_dewasa', 'early_warning_scoring_system_dewasa');
            Route::get('detail/pdf_early_warning_scoring_system_(dewasa)', 'pdf_early_warning_scoring_system_dewasa');

            Route::get('detail/asesmen_awal_pasien_rawat_inap_neonatus', 'asesmen_awal_pasien_rawat_inap_neonatus');

            Route::match(['GET', 'POST'], 'detail/observasi_cairan', 'observasi_cairan');
            Route::get('detail/pdf_observasi_cairan', 'pdf_observasi_cairan');

            Route::match(['GET', 'POST'], 'detail/checklist_keselamatan_pasien_operasi', 'checklist_keselamatan_pasien_operasi');
            Route::get('detail/pdf_checklist_keselamatan_pasien_operasi', 'pdf_checklist_keselamatan_pasien_operasi');

            Route::get('detail/dokumen_laporan_pembedahan', 'dokumen_laporan_pembedahan');
            Route::post('detail/dokumen_laporan_pembedahan/store', 'dokumen_laporan_pembedahan_store');
            Route::post('detail/dokumen_laporan_pembedahan/verifikasi', 'dokumen_laporan_pembedahan_verifikasi');

            Route::get('detail/surat_pengantar_persiapan_tindakan_operasi', 'surat_pengantar_persiapan_tindakan_operasi');
            Route::post('detail/surat_pengantar_persiapan_tindakan_operasi/store', 'surat_pengantar_persiapan_tindakan_operasi_store');
            Route::post('detail/surat_pengantar_persiapan_tindakan_operasi/verifikasi', 'surat_pengantar_persiapan_tindakan_operasi_verifikasi');

            Route::get('/detail/observasi_bayi', 'observasi_bayi');
            Route::post('rawat_inap/observasi_bayi/store', 'observasi_bayi_store');
            Route::get('rawat_inap/observasi_bayi/select', 'observasi_bayi_select');
            Route::put('rawat_inap/observasi_bayi/update', 'observasi_bayi_update');
            Route::get('rawat_inap/observasi_bayi/delete', 'observasi_bayi_delete');

            Route::get('detail/asesmen_awal_keperawatan_geriatri', 'asesmen_awal_keperawatan_geriatri');
            Route::post('detail/asesmen_awal_keperawatan_geriatri/store', 'asesmen_awal_keperawatan_geriatri_store');

            Route::get('/detail/formulir_penandaan_lokasi_operasi', 'formulir_penandaan_lokasi_operasi');
            Route::post('/detail/formulir_penandaan_lokasi_operasi/tanda_tangan', 'formulir_penandaan_lokasi_operasi_tanda_tangan');
            Route::post('/detail/formulir_penandaan_lokasi_operasi/store', 'formulir_penandaan_lokasi_operasi_store');
            Route::get('/detail/formulir_penandaan_lokasi_operasi/gambar_ulang', 'formulir_penandaan_lokasi_operasi_gambar_ulang');
            Route::post('/detail/formulir_penandaan_lokasi_operasi/verifikasi', 'formulir_penandaan_lokasi_operasi_verifikasi');

            Route::match(['GET', 'POST'], 'detail/pemantauan_tanda_tanda_vital', 'pemantauan_tanda_tanda_vital');
            Route::get('detail/pdf_pemantauan_tanda_tanda_vital', 'pdf_pemantauan_tanda_tanda_vital');

            Route::get('detail/laporan_anastesi_dan_sedasi', 'laporan_anastesi_dan_sedasi');
            Route::post('detail/save_laporan_anastesi_dan_sedasi', 'save_laporan_anastesi_dan_sedasi');
            Route::get('detail/pdf_laporan_anastesi_dan_sedasi', 'pdf_laporan_anastesi_dan_sedasi');

            Route::get('/detail/dokumen_partograf', 'dokumen_partograf');
            Route::post('/detail/dokumen_partograf/store', 'dokumen_partograf_store');
            Route::get('/detail/dokumen_partograf/gambar_ulang', 'dokumen_partograf_hapus_gambar');

            Route::get('detail/asesmen_awal_pasien_rawat_inap_pediatrik', 'asesmen_awal_pasien_rawat_inap_petriadik');
            Route::post('detail/smis_doc_asesmen_awal_pasien_ranap_pediatrik/store', 'update_smis_doc_asesmen_awal_pasien_ranap_petriadik');

            Route::get('detail/resume_medis_pasien_pulang', 'resume_medis_pasien_pulang');
            Route::post('detail/save_resume_medis_pasien_pulang', 'save_resume_medis_pasien_pulang');
            Route::get('detail/pdf_resume_medis_pasien_pulang', 'pdf_resume_medis_pasien_pulang');
            Route::get('detail/catatan_perkembangan_pasien_terintegrasi', 'catatan_perkembangan_pasien_terintegrasi');
            Route::post('detail/save_catatan_perkembangan_pasien_terintegrasi', 'save_catatan_perkembangan_pasien_terintegrasi');
            Route::get('detail/pdf_catatan_perkembangan_pasien_terintegrasi', 'pdf_catatan_perkembangan_pasien_terintegrasi');

            Route::get('detail/catatan_perkembangan_pasien_terintegrasi_rawat_inap', 'catatan_perkembangan_pasien_terintegrasi_rawat_inap');
            Route::get('detail/catatan_perkembangan_pasien_terintegrasi_rawat_inap/download_file_penunjang_eksternal', 'download_file_penunjang_eksternal_cppt');
            Route::get('detail/pdf_catatan_perkembangan_pasien_terintegrasi_rawat_inap', 'pdf_catatan_perkembangan_pasien_terintegrasi_rawat_inap');
            Route::get('detail/dokumentasi_informasi_tindakan_anestesi_umum_atau_sedasi', 'dokumentasi_informasi_tindakan_anestesi_sedasi');
            Route::post('detail/save_informasi_tindakan_anestesi_umum_atau_sedasi', 'save_dokumentasi_informasi_tindakan_anestesi_sedasi');
            Route::post('detail/ttd_informasi_tindakan_anestesi_umum_atau_sedasi', 'ttd_dokumentasi_informasi_tindakan_anestesi_sedasi');
            Route::post('detail/verif_informasi_tindakan_anestesi_umum_atau_sedasi', 'verif_dokumentasi_informasi_tindakan_anestesi_sedasi');
            Route::get('detail/persetujuan_atau_penolakan_transfusi_darah', 'persetujuan_transfusi_darah');
            Route::post('detail/save_persetujuan_atau_penolakan_transfusi_darah', 'save_persetujuan_transfusi_darah');
            Route::post('detail/ttd_persetujuan_atau_penolakan_transfusi_darah', 'ttd_persetujuan_transfusi_darah');
            Route::post('detail/verif_persetujuan_atau_penolakan_transfusi_darah', 'verif_persetujuan_transfusi_darah');
            Route::get('detail/tindakan_anestesi_spinal_atau_epidural', 'tindakan_anestesi_spinal_atau_epidural');
            Route::post('detail/save_tindakan_anestesi_spinal_atau_epidural', 'save_tindakan_anestesi_spinal_atau_epidural');
            Route::post('detail/ttd_tindakan_anestesi_spinal_atau_epidural', 'ttd_tindakan_anestesi_spinal_atau_epidural');
            Route::post('detail/verif_tindakan_anestesi_spinal_atau_epidural', 'verif_tindakan_anestesi_spinal_atau_epidural');

            Route::group(['prefix' => 'detail/rekonsiliasi_obat'], function () {
                Route::get('/', 'rekonsiliasi_obat');
                Route::post('/store', 'save_rekonsiliasi_obat');
                Route::post('/update_info_apoteker', 'update_info_apoteker_rekonsiliasi_obat');
                Route::post('/verifikasi_apoteker', 'verifikasi_apoteker_rekonsiliasi_obat');
                Route::post('/verifikasi_dokter', 'verifikasi_dokter_rekonsiliasi_obat');
            });

            Route::group(['prefix' => 'detail/lembar_konsultasi'], function () {
                Route::get('/', 'lembar_konsultasi');
                Route::post('store', 'lembar_konsultasi_store');
                Route::get('lembar_konsultasi_pdf', 'lembar_konsultasi_pdf');
            });

            Route::group(['prefix' => 'detail/persetujuan_atau_penolakan_tindakan_bedah'], function () {
                Route::get('/', 'persetujuan_atau_penolakan_tindakan_bedah');
                Route::post('store', 'persetujuan_atau_penolakan_tindakan_bedah_store');
            });

            Route::get('detail/serah_terima_bayi_rawat_gabung', 'serahTerimaBayiRawatGabung');
            Route::post('detail/store_serah_terima_bayi_rawat_gabung', 'storeSerahTerimaBayiRawatGabung')->name('serah_terima_bayi_rawat_gabung.store');

            Route::get('detail/persetujuan_atau_penolakan_tindakan_kedokteran', 'persetujuan_atau_penolakan_tindakan_kedokteran');
            Route::post('detail/persetujuan_atau_penolakan_tindakan_kedokteran/store', 'persetujuan_atau_penolakan_tindakan_kedokteran_store');
            Route::post('detail/persetujuan_atau_penolakan_tindakan_kedokteran/verifikasi', 'persetujuan_atau_penolakan_tindakan_kedokteran_verifikasi');
            Route::post('/save-nama-menyatakan', [ErmRanapController::class, 'save_ttd_yang_menyatakan'])->name('save.nama_yang_menyatakan');
            Route::post('/save-saksi-satu', [ErmRanapController::class, 'save_ttd_saksi_satu'])->name('save.saksi_satu');
            Route::post('/save-saksi-dua', [ErmRanapController::class, 'save_ttd_saksi_dua'])->name('save.saksi_dua');

            Route::get('detail/skala_risiko_jatuh_humpty_dumpty_untuk_pediatri', 'skala_risiko_jatuh_humpty_dumpty_untuk_pediatri');
            Route::post('detail/skala_risiko_jatuh_humpty_dumpty_untuk_pediatri/store', 'skala_risiko_jatuh_humpty_dumpty_untuk_peidatri_store');
            Route::post('detail/skala_risiko_jatuh_humpty_dumpty_untuk_pediatri/verifikasi', 'skala_risiko_jatuh_humpty_dumpty_untuk_peidatri_verifikasi');

            Route::get('detail/formulir_skrining_awal_gizi_dewasa', 'formulir_skrining_awal_gizi_dewasa');
            Route::post('detail/formulir_skrining_awal_gizi_dewasa/store', 'formulir_skrining_awal_gizi_dewasa_store');
            Route::post('detail/formulir_skrining_awal_gizi_dewasa/verifikasi', 'formulir_skrining_awal_gizi_dewasa_verifikasi');

            Route::get('detail/formulir_skrining_awal_gizi_anak', 'formulir_skrining_awal_gizi_anak');
            Route::post('detail/formulir_skrining_awal_gizi_anak/store', 'formulir_skrining_awal_gizi_anak_store');
            Route::post('detail/formulir_skrining_awal_gizi_anak/verifikasi', 'formulir_skrining_awal_gizi_anak_verifikasi');
            // Route::get('detail/pdf_laporan_anastesi_dan_sedasi', 'pdf_laporan_anastesi_dan_sedasi');

            Route::get('detail/persetujuan_atau_penolakan_tindakan_kedokteran', 'persetujuan_atau_penolakan_tindakan_kedokteran');
            Route::post('detail/persetujuan_atau_penolakan_tindakan_kedokteran/store', 'persetujuan_atau_penolakan_tindakan_kedokteran_store');
            Route::post('detail/persetujuan_atau_penolakan_tindakan_kedokteran/verifikasi', 'persetujuan_atau_penolakan_tindakan_kedokteran_verifikasi');
            Route::post('/save-nama-menyatakan', [ErmRanapController::class, 'save_ttd_yang_menyatakan'])->name('save.nama_yang_menyatakan');
            Route::post('/save-saksi-satu', [ErmRanapController::class, 'save_ttd_saksi_satu'])->name('save.saksi_satu');
            Route::post('/save-saksi-dua', [ErmRanapController::class, 'save_ttd_saksi_dua'])->name('save.saksi_dua');

            // Route::get('detail/pdf_laporan_anastesi_dan_sedasi', 'pdf_laporan_anastesi_dan_sedasi');

            Route::group(['prefix' => 'catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request'], function () {
                Route::post('create', 'create_cppt');
                Route::put('store', 'store_cppt');
                Route::post('diagnosa_store', 'store_diagnosa_cppt');
                Route::get('batal_form', 'batal_form_cppt');

                Route::post('lab_store', 'store_lab_cppt');
                Route::get('lab_delete', 'delete_lab_cppt');

                Route::post('rad_store', 'store_rad_cppt');
                Route::get('rad_delete', 'delete_rad_cppt');

                Route::post('resep_store', 'store_resep_cppt');
                Route::post('resep_lock', 'lock_resep_cppt');
            });

            Route::get('detail/indikator_sc', 'indikator_sc');
            Route::post('detail/verif_indikator_sc', 'verif_indikator_sc');

            Route::get('detail/surat_pernyataan_pulang_aps', 'surat_pernyataan_pulang_aps');
            Route::post('detail/sign_surat_pernyataan_pulang_aps', 'sign_surat_pernyataan_pulang_aps');
            Route::post('detail/verif_surat_pernyataan_pulang_aps', 'verif_surat_pernyataan_pulang_aps');

            Route::get('detail/permintaan_pemeriksaan_patologi_anatomi', 'permintaan_pemeriksaan_patologi_anatomi');
            Route::post('detail/verif_permintaan_pemeriksaan_patologi_anatomi', 'verif_permintaan_pemeriksaan_patologi_anatomi');

            Route::get('detail/surat_pernyataan_naik_kelas', 'surat_pernyataan_naik_kelas');
            Route::post('detail/save_surat_pernyataan_naik_kelas', 'save_surat_pernyataan_naik_kelas');
            Route::post('detail/sign_surat_pernyataan_naik_kelas', 'sign_surat_pernyataan_naik_kelas');
            Route::post('detail/verif_surat_pernyataan_naik_kelas', 'verif_surat_pernyataan_naik_kelas');

            Route::get('/detail/formulir_serah_terima_jenazah', 'formulir_serah_terima_jenazah');
            Route::post('/detail/save_formulir_serah_terima_jenazah', 'save_formulir_serah_terima_jenazah');
            Route::post('/detail/save_ttd_serah_terima_jenazah', 'save_ttd_serah_terima_jenazah');

            Route::get('/detail/observasi_keperawatan_rawat_inap', 'observasi_keperawatan_rawat_inap');
            Route::post('/detail/save_observasi_keperawatan_rawat_inap', 'save_observasi_keperawatan_rawat_inap');
            Route::post('/detail/verifikasi_observasi_keperawatan_rawat_inap', 'verifikasi_observasi_keperawatan_rawat_inap');
            Route::get('/detail/hapus_observasi_keperawatan_rawat_inap/{id}', 'hapus_observasi_keperawatan_rawat_inap');

            Route::get('/detail/formulir_serah_terima_bayi', 'formulir_serah_terima_bayi');
            Route::post('/detail/save_formulir_serah_terima_bayi', 'save_formulir_serah_terima_bayi');
            Route::post('/detail/save_ttd_dokumen_kunjungan', 'save_ttd_dokumen_kunjungan');

            Route::get('/detail/surat_keterangan_kematian', 'surat_keterangan_kematian');
            Route::post('/detail/save_surat_keterangan_kematian', 'save_surat_keterangan_kematian');

            Route::get('/detail/lembar_pemantauan_fibrinolitik', 'lembar_pemantauan_fibrinolitik');
            Route::post('/detail/save_lembar_pemantauan_fibrinolitik', 'save_lembar_pemantauan_fibrinolitik');
            Route::post('/detail/verifikasi_lembar_pemantauan_fibrinolitik', 'verifikasi_lembar_pemantauan_fibrinolitik');
            Route::get('/detail/hapus_lembar_pemantauan_fibrinolitik/{id}', 'hapus_lembar_pemantauan_fibrinolitik');

            Route::get('/detail/surat_kontrol', 'surat_kontrol');
            Route::post('/detail/save_surat_kontrol', 'save_surat_kontrol');

            Route::get('/detail/surat_kontrol_rawat_inap', 'surat_kontrol_rawat_inap');
            Route::post('/detail/save_surat_kontrol_rawat_inap', 'save_surat_kontrol_rawat_inap');

            Route::get('/detail/lembar_penolakan_dnr', 'lembar_penolakan_dnr');
            Route::post('/detail/save_lembar_penolakan_dnr', 'save_lembar_penolakan_dnr');
            Route::post('/detail/save_ttd_lembar_penolakan_dnr', 'save_ttd_lembar_penolakan_dnr');

            Route::group(['prefix' => 'detail/daftar_kontrol_istimewa_pasien_dm'], function () {
                Route::get('/', 'daftar_kontrol_istimewa_pasien_dm');
                Route::post('store', 'daftar_kontrol_istimewa_pasien_dm_store');
            });

            Route::group(['prefix' => 'detail/daftar_pemberian_obat'], function () {
                Route::get('/', 'daftar_pemberian_obat');
                Route::post('store', 'daftar_pemberian_obat_store');
            });

            Route::group(['prefix' => 'detail/survei_infeksi_rumah_sakit'], function () {
                Route::get('/', 'survei_infeksi_rumah_sakit');
                Route::post('store', 'survei_infeksi_rumah_sakit_store');
            });
            Route::get('/detail/asesmen_pasien_terminal', 'asesmen_pasien_terminal');
            Route::post('/detail/save_asesmen_pasien_terminal', 'save_asesmen_pasien_terminal');
            Route::post('/detail/verifikasi_asesmen_pasien_terminal', 'verifikasi_asesmen_pasien_terminal');
        });

        Route::controller(ErmDokterController::class)->group(function () {
            Route::group(['prefix' => 'detail'], function () {
                Route::group(['prefix' => 'catatan_perkembangan_pasien_terintegrasi_v2'], function () {
                    Route::get('/', 'catatan_perkembangan_pasien_terintegrasi_v2');
                    Route::get('asesmen_medis_terakhir', 'asesmen_medis_terakhir_cppt_v2');
                    Route::get('riwayat', 'riwayat_cppt_v2');
                });
            });
        });

        Route::get('detail/formulir_asesmen_awal_pasien_rawat_inap_dewasa', [ErmRajalController::class, 'formulir_asesmen_awal_pasien_rawat_inap_dewasa']);
        Route::post('detail/save_formulir_asesmen_awal_pasien_rawat_inap_dewasa', [ErmRajalController::class, 'save_formulir_asesmen_awal_pasien_rawat_inap_dewasa']);
        Route::post('detail/save_formulir_asesmen_awal_pasien_rawat_inap_dewasa2', [ErmRajalController::class, 'save_formulir_asesmen_awal_pasien_rawat_inap_dewasa2']);
        Route::post('formulir_asesmen_awal_pasien_rawat_inap_dewasa/ajax_request/resep_store', [ErmRajalController::class, 'store_resep_formulir_asesemen_awal']);
        Route::post('formulir_asesmen_awal_pasien_rawat_inap_dewasa/ajax_request/resep_lock', [ErmRajalController::class, 'lock_resep_formulir_asesemen_awal']);

        Route::get('detail/formulir_klaim_fisioterapi', [ErmRajalController::class, 'formulir_klaim_fisioterapi']);
        Route::post('detail/verifikasi_formulir_klaim_fisioterapi', [ErmRajalController::class, 'verifikasi_formulir_klaim_fisioterapi']);
        Route::post('detail/ttd_formulir_klaim_fisioterapi', [ErmRajalController::class, 'ttd_formulir_klaim_fisioterapi']);

        Route::controller(ErmRekamMedisController::class)->group(function () {
            Route::group(['prefix' => 'rekam_medis'], function () {
                Route::get('/', 'index');

                Route::post('verifikasi_dokumen_kunjungan', 'verifikasi_dokumen_kunjungan');
                Route::post('save_ttd_dokumen_kunjungan', 'save_ttd_dokumen_kunjungan');

                Route::post('save_ttd_saksi_satu_dokumen_kunjungan', 'save_ttd_saksi_satu_dokumen_kunjungan');
                Route::post('save_ttd_saksi_dua_dokumen_kunjungan', 'save_ttd_saksi_dua_dokumen_kunjungan');

                Route::get('catatan_edukasi_pasien', 'catatan_edukasi_pasien');
                Route::get('pdf_catatan_edukasi_pasien', 'pdf_catatan_edukasi');
                Route::post('save_catatan_edukasi', 'save_catatan_edukasi');

                Route::get('general_consent', 'general_consent');
                Route::post('save_general_consent', 'save_general_consent');
                Route::get('pdf_general_consent', 'pdf_general_consent');

                Route::get('surat_permintaan_rawat_inap', 'surat_permintaan_rawat_inap');
                Route::get('pdf_surat_permintaan_rawat_inap', 'pdf_surat_permintaan_rawat_inap');
                Route::post('save_surat_permintaan_rawat_inap', 'save_surat_permintaan_rawat_inap');

                Route::get('dokumen_transfer_pasien_internal', 'dokumen_transfer_pasien_internal');
                Route::post('save_dokumen_transfer_pasien_internal', 'save_dokumen_transfer_pasien_internal');
                Route::post('verifikasi_petugas_penyerahan', 'verifikasi_petugas_penyerahan');
                Route::get('pdf_dokumen_transfer_pasien_internal', 'pdf_dokumen_transfer_pasien_internal');

                Route::get('dokumen_laporan_caesarian', 'dokumen_laporan_caesarian');
                Route::post('save_dokumen_laporan_caesarian', 'save_dokumen_laporan_caesarian');
                Route::get('pdf_dokumen_laporan_caesarian', 'pdf_dokumen_laporan_caesarian');

                Route::get('formulir_triage_terintegrasi', 'formulir_triage_terintegrasi');
                Route::post('save_formulir_triage_terintegrasi', 'save_formulir_triage_terintegrasi');
                Route::get('pdf_formulir_triage_terintegrasi', 'pdf_formulir_triage_terintegrasi');

                Route::get('dokumen_asesment_awal_keperawatan_igd', 'dokumen_asesment_awal_keperawatan_igd');
                Route::post('save_dokumen_asesment_awal_keperawatan_igd', 'save_dokumen_asesment_awal_keperawatan_igd');
                Route::get('pdf_dokumen_asesment_awal_keperawatan_igd', 'pdf_dokumen_asesment_awal_keperawatan_igd');
                Route::get('hapus_gambar_lokalis', 'hapus_gambar_lokalis');

                Route::get('catatan_perkembangan_pasien_terintegrasi', 'catatan_perkembangan_pasien_terintegrasi');
                Route::post('save_catatan_perkembangan_pasien_terintegrasi', 'save_catatan_perkembangan_pasien_terintegrasi');
                Route::get('pdf_catatan_perkembangan_pasien_terintegrasi', 'pdf_catatan_perkembangan_pasien_terintegrasi');
                Route::post('catatan_perkembangan_pasien_terintegrasi/verifikasi', 'save_catatan_perkembangan_pasien_terintegrasi');
                Route::get('catatan_perkembangan_pasien_terintegrasi/download_dokumen_penunjang_eksternal', 'download_dokumen_penunjang_eksternal_cppt');

                Route::get('dokumen_orientasi_pasien_baru', 'dokumen_orientasi_pasien_baru');
                Route::post('save_dokumen_orientasi_pasien_baru', 'save_dokumen_orientasi_pasien_baru');
                Route::get('pdf_dokumen_orientasi_pasien_baru', 'pdf_dokumen_orientasi_pasien_baru');

                Route::match(['GET', 'POST'], 'rencana_keperawatan', 'rencana_keperawatan');
                Route::post('verifikasi_dokumen', 'verifikasi_dokumen');
                Route::get('pdf_rencana_keperawatan', 'pdf_rencana_keperawatan');

                Route::get('asesmen_awal_kebidanan_rawat_inap', 'asesmen_awal_kebidanan_rawat_inap');
                Route::post('save_asesmen_awal_kebidanan_rawat_inap', 'save_asesmen_awal_kebidanan_rawat_inap');

                Route::get('resume_medis_pasien_pulang', 'resume_medis_pasien_pulang');
                Route::post('save_resume_medis_pasien_pulang', 'save_resume_medis_pasien_pulang');
                Route::get('pdf_resume_medis_pasien_pulang', 'pdf_resume_medis_pasien_pulang');

                Route::get('formulir_asesmen_awal_pasien_rawat_inap_dewasa', 'formulir_asesmen_awal_pasien_rawat_inap_dewasa');
                // Route::post('save_dokumen_asesment_awal_medis_gawat_darurat', 'save_dokumen_asesment_awal_medis_gawat_darurat');
                // Route::get('pdf_dokumen_asesment_awal_medis_gawat_darurat', 'pdf_dokumen_asesment_awal_medis_gawat_darurat');
                Route::get('hapus_gambar_status_lokalis', 'hapus_status_lokalis_dokumen_asesment_awal_medis_gawat_darurat');

                Route::match(['GET', 'POST'], 'formulir_kriteria_pasien_masuk_icu', 'formulir_kriteria_pasien_masuk_icu');
                Route::match(['GET', 'POST'], 'formulir_kriteria_pasien_keluar_icu', 'formulir_kriteria_pasien_keluar_icu');
                Route::get('pdf_formulir_kriteria_pasien_masuk_icu', 'pdf_formulir_kriteria_pasien_masuk_icu');
                Route::get('pdf_formulir_kriteria_pasien_keluar_icu', 'pdf_formulir_kriteria_pasien_keluar_icu');

                Route::get('asesmen_awal_pasien_rawat_inap_neonatus', 'asesmen_awal_pasien_rawat_inap_neonatus');

                Route::get('asesment_medis_awal_rawat_jalan', 'asesment_medis_awal');
                Route::get('pdf_asesment_medis_awal_rawat_jalan', 'pdf_asesment_medis_awal');
                Route::post('save_asesment_medis_awal_rawat_jalan', 'save_asesment_medis_awal');

                Route::get('dokumen_asesment_awal_medis_gawat_darurat', 'dokumen_asesment_awal_medis_gawat_darurat');
            });
        });

        Route::controller(RencanaKeperawatanPraOperasi::class)->group(function () {
            Route::group(['prefix' => 'rencana_keperawatan_pra_operasi'], function () {
                Route::get('/', 'index');
                Route::post('store', 'store');
            });
        });

        Route::controller(RencanaKeperawatanIntraOperasi::class)->group(function () {
            Route::group(['prefix' => 'rencana_keperawatan_intra_operasi'], function () {
                Route::get('/', 'index');
                Route::post('store', 'store');
            });
        });

        Route::controller(RencanaKeperawatanPostOperasi::class)->group(function () {
            Route::group(['prefix' => 'rencana_keperawatan_post_operasi'], function () {
                Route::get('/', 'index');
                Route::post('store', 'store');
            });
        });

        Route::controller(FormPemantauanReaksiTransfusiDarahController::class)->group(function () {
            Route::group(['prefix' => 'form_pemantauan_reaksi_transfusi_darah'], function () {
                Route::get('/', 'index');
                Route::post('store', 'store');
            });
        });
    });

    Route::group(['prefix' => 'satu_sehat'], function () {
        Route::controller(OrganisasiController::class)->group(function () {
            Route::group(['prefix' => 'organisasi'], function () {
                Route::get('rs', 'index');
                Route::post('store', 'store');
                Route::put('update', 'update');
                Route::get('referensi', 'referensi_organisasi');
                Route::get('referensi_update', 'update_referensi_organisasi');
                Route::get('ajax_request/select_organisasi', 'ajax_select_organisasi');
            });
        });

        Route::controller(SatuSehatLocationController::class)->group(function () {
            Route::get('location', 'index');
            Route::get('location_datatable', 'datatable_location');
            Route::get('location_reference_datatable', 'datatable_location_reference');
            Route::get('location/update_location_reference', 'ajax_update_location_reference');
            Route::post('location/store', 'store');
            Route::put('location/update', 'update');
            Route::get('ajax_request/select_location', 'ajax_select_location');
        });

        Route::controller(SatuSehatPractionerController::class)->group(function () {
            Route::get('practioner', 'index');
            Route::get('practioner_datatable', 'datatable_practitioner');
            Route::get('ajax_request/get_ihs_number', 'ajax_get_ihs_number');
        });

        Route::controller(SatuSehatRawatJalanController::class)->group(function () {
            Route::group(['prefix' => 'rawat_jalan'], function () {
                Route::get('', 'index');
                Route::get('filter', 'filter');
                Route::get('datatable', 'datatable');
                Route::get('send', 'send');
                Route::post('export', 'export');
            });
        });
    });

    Route::group(['prefix' => 'invoice'], function () {
        Route::controller(InvoiceController::class)->group(function () {
            Route::get('/', 'showSetting')->name('invoice.setting_index');
            Route::post('/create', 'createSetting')->name('invoice.setting_create');
        });
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
