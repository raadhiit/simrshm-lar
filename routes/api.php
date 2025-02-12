<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::group(["prefix"=>"wsrs"], function() { */
/*     Route::get("/token", "Api\Wsrs\Token@index")->name('token'); */
    
/*     Route::group(["middleware"=>"wsrs"], function() { */
/*         Route::post("/ambil-antrian", "Api\Wsrs\AmbilAntrian@index")->name('ambilAntrian'); */
/*         Route::post("/tambah-pasien", "Api\Wsrs\TambahPasien@index")->name('tambahPasien'); */
/*         Route::post("/check-in", "Api\Wsrs\CheckIn@index")->name('checkIn'); */
/*         Route::post("/batal-antrian", "Api\Wsrs\BatalAntrian@index")->name('batalAntrian'); */
/*         Route::post("/status-antrian", "Api\Wsrs\StatusAntrian@index")->name('statusAntrian'); */
/*         Route::post("/sisa-antrian", "Api\Wsrs\SisaAntrian@index")->name('sisaAntrian'); */
/*         Route::post("/jadwal-operasi-rs", "Api\Wsrs\JadwalOperasi@operasiRs")->name('operasiRs'); */
/*         Route::post("/jadwal-operasi-pasien", "Api\Wsrs\JadwalOperasi@operasiPasien")->name('operasiPasien'); */
/*     }); */

/* }); */

/* Route::group(["prefix"=>"wsbpjs"], function() { */
/*     // referensi */
/*     Route::get("/poli", "Api\Wsbpjs\Referensi@poli")->name('getPoli'); */
/*     Route::get("/dokter", "Api\Wsbpjs\Referensi@dokter")->name('getDokter'); */
/*     Route::get("/jadwal-dokter/{kodepoli}/{tanggal}", "Api\Wsbpjs\Referensi@jadwalDokter")->name('jadwalDokter'); */
/*     Route::post("/update-jadwal-dokter", "Api\Wsbpjs\Referensi@updateJadwalDokter")->name('updateJadwalDokter'); */
/*     // antrean */
/*     Route::post("/tambah-antrean", "Api\Wsbpjs\Antrean@tambahAntrean")->name('tambahAntrean'); */
/*     Route::post("/update-waktu-antrean", "Api\Wsbpjs\Antrean@updateWaktuAntrean")->name('updateWaktuAntrean'); */
/*     Route::post("/batal-antrean", "Api\Wsbpjs\Antrean@batalAntrean")->name('batalAntrean'); */
/*     Route::post("/list-waktu-task-id", "Api\Wsbpjs\Antrean@listWaktuTaskId")->name('listWaktuTaskId'); */
/*     Route::get("/dashboard-tanggal/{tanggal}", "Api\Wsbpjs\Dashboard@tanggal")->name('dashboardTanggal'); */
/*     Route::get("/dashboard-bulan/{bulan}/{tahun}", "Api\Wsbpjs\Dashboard@bulan")->name('dashboardBulan'); */
/* }); */
