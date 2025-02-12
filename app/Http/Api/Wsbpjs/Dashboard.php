<?php

namespace App\Http\Controllers\Api\Wsbpjs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BpjsService;

class Dashboard extends Controller
{
  public function tanggal(Request $request, $tanggal)
  {
    $url = 'dashboard/waktutunggu/tanggal/'.$tanggal.'/waktu/rs';
    return (new BpjsService())->get($url);
  }
  public function bulan(Request $request, $bulan, $tahun)
  {
    $url = 'dashboard/waktutunggu/bulan/'.$bulan.'/tahun/'.$tahun.'/waktu/rs';
    return (new BpjsService())->get($url);
  }
}
