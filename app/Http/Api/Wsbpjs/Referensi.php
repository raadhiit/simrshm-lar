<?php

namespace App\Http\Controllers\Api\Wsbpjs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BpjsService;

class Referensi extends Controller
{
  public static function poli()
  {
    return (new BpjsService())->get('ref/poli');
  }

  public static function dokter()
  {
    return (new BpjsService())->get('ref/dokter');
  }

  public static function jadwalDokter($kodepoli = 0, $tanggal = "")
  {
  	$url = "jadwaldokter/kodepoli/$kodepoli/tanggal/$tanggal";
  	return (new BpjsService())->get($url);
  }

  public static function updateJadwalDokter(Request $request)
  {
  	$data = $request->all();
  	return (new BpjsService())->post('jadwaldokter/updatejadwaldokter', $data);
  }
}
