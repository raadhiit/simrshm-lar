<?php

namespace App\Http\Controllers\Api\Wsrs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Antrian;
use Carbon\Carbon;

class CheckIn extends Controller
{
  public function index(Request $request) {
    $validator = Validator::make($request->all(), [
      "kodebooking"  => "required",
      "waktu"   => "required",

    ], [
      'kodebooking.required' => 'Kode Booking Harus Diisi',
      'waktu.required' => 'waktu Booking Harus Diisi',
    ]);
    if ($validator->fails()) {
      return  $this->responseFormat($validator->errors()->first(), 201);
    } else {
      $keterangan = 'Pasien Check In';
      $antrian = Antrian::Where('kodebooking', $request->kodebooking)->where('taskid', '0')->first();
      if (is_null($antrian)) {
        return  $this->responseFormat('Kode Booking Tidak ditemukan atau mungkin Anda sudah melakukan check in.', 201);
      } else {
        // jika sesi jadwal telah berakhir
        $waktu = (date("H:i", $request->waktu/1000));
        if($waktu > @$antrian->jadwal->jam_selesai){
          return  $this->responseFormat('Jadwal periksa telah berakhir', 201);
        }
        // jika tanggal check in tidak sama dengan tanggal periksa
        $date = date('Y-m-d');
        if ($antrian->tanggalperiksa != $date) {
          return  $this->responseFormat('Tanggal check in tidak sesuai tanggal periksa', 201);
        }
        // berhasil check in
        $data = Antrian::Where('kodebooking', $request->kodebooking)->where('taskid', '0')->update(['taskid' => '1', 'keterangan' => $keterangan, 'updated_at' => now()]);
        return $this->responseFormat('Check In berhasil', 200);
      }
    }
  }
}
