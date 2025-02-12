<?php

namespace App\Helpers;
use App\Models\Antrian;

class GeneralHelper
{
  public static function generateAntrean($dokter,$jadwal_id, $kodepoli, $tanggalperiksa) {
    $nomor = Antrian::where("jadwal_id", $jadwal_id)->whereDate("tanggalperiksa", $tanggalperiksa)->count()+1;

    $nom = str_pad($nomor, 4, '0', STR_PAD_LEFT);
    $tanggalperiksa = date("dmY", strtotime($tanggalperiksa));
    $antrian = [
      "nomorantrean" => $kodepoli."-".$nom,
      "angkaantrean" => $nomor,
      "kodebooking" => $tanggalperiksa.$kodepoli.$dokter.$nom,
    ];
    return $antrian;
  }
}