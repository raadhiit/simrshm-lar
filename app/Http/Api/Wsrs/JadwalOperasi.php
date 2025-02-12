<?php

namespace App\Http\Controllers\Api\Wsrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JadwalOperasiRs;
use Validator;

class JadwalOperasi extends Controller
{
  public function operasiRs(Request $request) {
    $tanggalawal = $request->input("tanggalawal");
    $tanggalakhir = $request->input("tanggalakhir");

    // jika format tanggal salah
    $checkTgl = Validator::make(["tanggalawal" => $tanggalawal, "tanggalakhir" => $tanggalakhir], [
      'tanggalawal' => 'date_format:Y-m-d',
      'tanggalakhir' => 'date_format:Y-m-d',
    ]);
    if ($checkTgl->fails())
      return $this->responseFormat("Format tanggal salah gunakan format Y-m-d.", 201);
    
    // get jadwal operasi rs
    $jadwal = JadwalOperasiRs::whereBetween("tanggaloperasi", [$tanggalawal, $tanggalakhir])->get();

    // jika data tidak ada
    if($jadwal->count()==0)
      return $this->responseFormat("Jadwal Operasi RS tidak ditemukan.", 201);

    return $this->responseFormat("Ok", 200, $jadwal);
  }

  public function operasiPasien(Request $request) {
    $nopeserta = $request->input("nopeserta");

    // get jadwal operasi pasien
    $jadwal = JadwalOperasiRs::where("nopeserta", $nopeserta)->get();

    // jika data tidak ada
    if($jadwal->count()==0)
      return $this->responseFormat("Jadwal Operasi Pasien tidak ditemukan.", 201);

    $jadwal->makeHidden(['nopeserta', 'lastupdate']);
    return $this->responseFormat("Ok", 200, $jadwal);
  }
}
