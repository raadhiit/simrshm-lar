<?php

namespace App\Http\Controllers\Api\Wsrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JadwalPoli;
use App\Models\Antrian;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StatusAntrian extends Controller
{
  public function __construct(Request $request) {
    $this->kodepoli = $request->input("kodepoli", "");
    $this->kodedokter = $request->input("kodedokter", "");
    $this->tanggalperiksa = $request->input("tanggalperiksa", "");
    $this->jampraktek = $request->input("jampraktek", "");
  }

  public function index(Request $request) {
    // validasi
    $valid = $this->valid();
    if($valid['metadata']['code'] != "200") return $valid;
    
    $jadwal = $valid['response']['jadwal'];
    $antrian = Antrian::getjadwal($jadwal->id, $this->tanggalperiksa)->orderBy("id", "desc");

    $totalantrean = $antrian->count();
    $sisaantrean = Antrian::getjadwal($jadwal->id, $this->tanggalperiksa)->where("taskid", "<", 2)->count();
    $antreanpanggil = Antrian::getjadwal($jadwal->id, $this->tanggalperiksa)->where("taskid", 2)->orderBy("id", "desc")->value("nomorantrean");


    return $this->responseFormat("Ok", 200,[
      "namapoli" => $jadwal->nama_poli,
      "namadokter" => $jadwal->nama_dokter,
      "totalantrean" => $totalantrean,
      "sisaantrean" => $sisaantrean,
      "antreanpanggil" => $antreanpanggil,
      "sisakuotajkn" => $antrian->value("sisakuotajkn"),
      "kuotajkn" => $antrian->value("kuotajkn"),
      "sisakuotanonjkn" => $antrian->value("sisakuotanonjkn"),
      "kuotanonjkn" => $antrian->value("kuotanonjkn"),
      "keterangan" => $antrian->value("keterangan")
    ]);
  }

  private function valid()
  {
    $jadwal = new JadwalPoli();
    // jika poli tidak ada
    $jadwal = $jadwal->where("kodepoli_bpjs", $this->kodepoli);
    if(is_null($jadwal->first())) {
      return $this->responseFormat("Poli tidak ditemukan.", 201);
    }
    // jika dokter tidak ada
    $jadwal = $jadwal->where("kodedokter_bpjs", $this->kodedokter);
    if(is_null($jadwal->first())) {
      return $this->responseFormat("Dokter di Poli ini tidak ditemukan.", 201);
    }
    // jika format tanggal salah
    $checkTgl = Validator::make(["tanggalperiksa" => $this->tanggalperiksa], [
      'tanggalperiksa' => 'date_format:Y-m-d',
    ]);
    if ($checkTgl->fails()) {
      return $this->responseFormat("Format tanggal salah gunakan format Y-m-d.", 201);
    }
    // jika format jam praktek salah
    $jampraktek = explode("-", $this->jampraktek);
    if(count($jampraktek) < 2 || ($jampraktek[0] == "" && $jampraktek[1] == ""))
      return $this->responseFormat("Format jam praktek salah, contoh yang benar: 08:00-10:00", 201);
    // jika jadwal tidak ada
    $hari = Carbon::createFromFormat("Y-m-d", $this->tanggalperiksa)->dayOfWeek;
    $jadwal = $jadwal->where("hari", $hari);
    $jadwal = $jadwal->where("jam_mulai", $jampraktek[0]);
    $jadwal = $jadwal->where("jam_selesai", $jampraktek[1])->first();
    if(is_null($jadwal)) {
      return $this->responseFormat("Jadwal tidak ditemukan.", 201);
    }
    // jika validasi sudah benar
    return $this->responseFormat("ok", 200, ["jadwal" => $jadwal]);
  }
}
