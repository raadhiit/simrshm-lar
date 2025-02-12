<?php

namespace App\Http\Controllers\Api\Wsrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Antrian;

class SisaAntrian extends Controller
{
  public function index(Request $request){
    $kodebooking = $request->input("kodebooking", "");
    $antrian = Antrian::where("kodebooking", $kodebooking)->first();
    
    if(is_null($antrian)) // jika antrian tidak ditemukan
      return $this->responseFormat("Kodebooking tidak ditemukan.", 201);
    if(is_null($antrian->jadwal)) // jika jadwal tidak ditemukan
      return $this->responseFormat("Jadwal di antrian ini tidak ditemukan.", 201);

    $antreanpanggil = Antrian::whereDate("tanggalperiksa", $antrian->tanggalperiksa)->where("taskid", 2)->orderBy("id", "desc");
    $lastantrian = Antrian::whereDate("tanggalperiksa", $antrian->tanggalperiksa)->orderBy("id", "desc")->value("angkaantrean");
    $sisaantrean = $lastantrian - $antreanpanggil->value("angkaantrean");
    $waktutunggu = $antrian->jadwal->bobot*($sisaantrean-1);

    return $this->responseFormat("Kodebooking tidak ditemukan.", 202, [
      "nomorantrean" => $antrian->nomorantrean,
      "namapoli" => $antrian->jadwal->nama_poli,
      "namadokter" => $antrian->jadwal->nama_dokter,
      "sisaantrean" => $sisaantrean,
      "antreanpanggil" => $antreanpanggil->value("nomorantrean"),
      "waktutunggu" => $waktutunggu,
      "keterangan" => $antrian->keterangan
    ]);
  }
}
