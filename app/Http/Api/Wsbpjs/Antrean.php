<?php

namespace App\Http\Controllers\Api\Wsbpjs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BpjsService;

class Antrean extends Controller
{
  public function tambahAntrean(Request $request)
  {
    $data = $request->all();
    return (new BpjsService())->post('antrean/add', $data);
  }

  public function updateWaktuAntrean(Request $request)
  {
    $data = $request->all();
    return (new BpjsService())->post('antrean/updatewaktu', $data);
  }
  public function batalAntrean(Request $request)
  {
    $data = $request->all();
    return (new BpjsService())->post('antrean/batal', $data);
  }
  public function listWaktuTaskId(Request $request)
  {
    $data = $request->all();
    return (new BpjsService())->post('antrean/getlisttask', $data);
  }
}
