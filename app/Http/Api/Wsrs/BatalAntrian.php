<?php

namespace App\Http\Controllers\Api\Wsrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Antrian;

class BatalAntrian extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->all(), [
            "kodebooking"  => "required",
            "keterangan"   => "required",

        ], [
            "kodebooking.required"  => "Kode Booking Harus Disi",
            "keterangan.required"  => "Keterangan Harus Disi",
        ]);
        if ($validator->fails()) {
            return  $this->responseFormat($validator->errors()->first(), 201);
        } else {
            $cekKodeBooking = Antrian::Where('kodebooking', $request->kodebooking)->get();
            if ($cekKodeBooking->isEmpty()) {
                return  $this->responseFormat('Antrean Tidak Ditemukan', 201);
            } else {
                $cekKodeBookingDilayani1 = Antrian::Where('kodebooking', $request->kodebooking)->where('taskid', '!=', '99')->get();
                if ($cekKodeBookingDilayani1->isEmpty()) {
                    return  $this->responseFormat('Antrean Tidak Ditemukan atau Sudah Dibatalkan', 201);
                } else {
                    $cekSudahDilayani = Antrian::Where('kodebooking', $request->kodebooking)->whereInArray('taskid', ['1', '99'])->value('kodebooking');
                    if (!$cekSudahDilayani->isEmpty()) {
                        return  $this->responseFormat('Pasien Sudah Dilayani, Antrean Tidak Dapat Dibatalkan', 201);
                    } else {
                        $data = Antrian::Where('kodebooking', $request->kodebooking)->where('taskid', '0')->update(['taskid' => '99', 'keterangan' => $request->keterangan, 'updated_at' => now()]);
                        return $this->responseFormat('Ok', 200);
                    }
                }
            }
        }
    }
}
