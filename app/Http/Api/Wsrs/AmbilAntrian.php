<?php

namespace App\Http\Controllers\Api\Wsrs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Wsbpjs\Referensi;
use App\Models\JadwalPoli;
use App\Models\Patient;
use App\Models\Antrian;
use App\Helpers\GeneralHelper as GH;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AmbilAntrian extends Controller
{
  public function __construct(Request $request) {
    $this->kodepoli = $request->input("kodepoli", "");
    $this->kodedokter = $request->input("kodedokter", "");
    $this->tanggalperiksa = $request->input("tanggalperiksa", "");
    $this->nobpjs = $request->input("nomorkartu", "");
    $this->nik = $request->input("nik", "");
    $this->jampraktek = $request->input("jampraktek", "");
  }

  public function index(Request $request) {
    // validasi
    $valid = $this->valid();
    if($valid['metadata']['code'] != "200") return $valid;
    
    // data antrian
    $req = $request->all();
    $jadwal = $valid['response']['jadwal'];
    $pasien = $valid['response']['pasien'];
    $sisakuotajkn = $valid['response']['sisakuotajkn'];
    $sisakuotanonjkn = $valid['response']['sisakuotanonjkn'];
    $generate = GH::generateAntrean($jadwal['id'], $req['kodepoli'], $req['tanggalperiksa']);

    $estimasi = Carbon::createFromFormat("H:i", $jadwal->jam_mulai)->timestamp + (($generate['angkaantrean']-1) * ($jadwal->estimasi_layanan * 60));

    // create new antrian
    $antrian = new Antrian();
    $antrian->taskid = 99;
    $antrian->tanggalperiksa = $req['tanggalperiksa'];
    $antrian->jadwal_id = $jadwal['id'];
    $antrian->nomorantrean = $generate['nomorantrean'];
    $antrian->angkaantrean = $generate['angkaantrean'];
    $antrian->kodebooking = $generate['kodebooking'];
    $antrian->norm = $pasien['nrm'];
    $antrian->namapoli = $jadwal['nama_poli'];
    $antrian->namadokter = $jadwal['nama_dokter'];
    $antrian->estimasidilayani = $estimasi; // masih salah harus di ganti
    $antrian->sisakuotajkn = $sisakuotajkn;
    $antrian->sisakuotanonjkn = $sisakuotanonjkn;
    $antrian->kuotajkn = $jadwal['kuota_jkn'];
    $antrian->kuotanonjkn = $jadwal['kuota_non_jkn'];
    $antrian->keterangan = 'Peserta harap 60 menit lebih awal guna pencatatan administrasi.';
    $antrian->save();

    return $this->responseFormat("Anda berhasil mengambil antrian.", 200, $antrian);
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
    // jika tanggal telah berlalu
    if (date("Y-m-d") > $this->tanggalperiksa) {
      return $this->responseFormat("Tanggal periksa yang anda masukkan telah berlalu.", 201);
    }
    // tidak bisa ambil antrian di hari H
    if (date("Y-m-d") == $this->tanggalperiksa) {
      return $this->responseFormat("Anda tidak dapat mengambil antrian di hari H.", 201);
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
    // jika jam jadwal sudah tutup
    $jadwal_selesai = date("H:i", strtotime($jadwal->jam_selesai));
    if(date("H:i") > $jadwal_selesai) {
      return $this->responseFormat("Jadwal periksa sudah tutup.", 201);
    }
    // jika data pasien tidak ada
    if($this->nobpjs!="") // jika pasien bpjs
      $pasien = Patient::where("nobpjs", $this->nobpjs)->first();
    else // jika pasien non bpjs
      $pasien = Patient::where("ktp", $this->nik)->first();
    if(is_null($pasien)) {
      return $this->responseFormat("Data Pasien tidak ditemukan, silahkan daftar baru.", 201);
    }
    
    // last antrian
    $lastAntrian = Antrian::where(['jadwal_id'=>$jadwal->id, 'tanggalperiksa'=>$this->tanggalperiksa])->orderBy("id", "desc");
    // sisa antrian jkn
    if($lastAntrian->value('sisakuotajkn'))
      $sisakuotajkn = $lastAntrian->value('sisakuotajkn');
    else
      $sisakuotajkn = $jadwal->kuota_jkn;
    if($this->nobpjs!="") { // jika pasien bpjs
      $sisakuotajkn = $sisakuotajkn-1;
      if($sisakuotajkn <= 0) // jika kuota jkn habis
        return $this->responseFormat("Sisa kuota Pasien BPJS sudah habis.", 201);
    }
    // sisa antrian non jkn
    if($lastAntrian->value('sisakuotanonjkn'))
      $sisakuotanonjkn = $lastAntrian->value('sisakuotanonjkn');
    else
      $sisakuotanonjkn = $jadwal->kuota_non_jkn;
    if($this->nobpjs=="") { // jika pasien non bpjs
      $sisakuotanonjkn = $sisakuotanonjkn-1;
      if($sisakuotanonjkn <= 0) // jika kuota non jkn habis
        return $this->responseFormat("Sisa kuota Pasien Non BPJS sudah habis.", 201);
    }
    
    // jika sudah ambil antrian
    if(!is_null($lastAntrian->where("norm", $pasien->nrm)->first()))
      return $this->responseFormat("Anda telah mengambil Antrian di poli ini tanggal ".$this->tanggalperiksa, 201);
    // jika validasi sudah benar
    return $this->responseFormat("ok", 200, ["jadwal" => $jadwal, "sisakuotajkn" => $sisakuotajkn, "sisakuotanonjkn" => $sisakuotanonjkn, "pasien" => $pasien]);
  }
}
