<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Antrian;

class Antrian extends Model
{

  // test code
  // protected $table = "antrians_backup";


  public function jadwal() {
    return $this->hasOne("App\Models\JadwalPoli", "id", "jadwal_id");
  }

  public static function getjadwal($jadwal_id, $tanggalperiksa) {
    return Antrian::where(["jadwal_id" => $jadwal_id, "tanggalperiksa" => $tanggalperiksa]);
  }
}
