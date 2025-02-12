<?php

namespace App\Http\Controllers\Api\Wsrs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Exceptions\ErrorValidation;
use App\Models\Patient;
use Carbon\Carbon;

class TambahPasien extends Controller
{
  public function index(Request $request) {
    $req = $request->all();
    $this->valid($req);
    $dataPasien = [
      "nobpjs" => $req['nomorkartu'],
      "ktp" => $req['nik'],
      // "kartu" => $req['nomorkk'],
      "nama" => $req['nama'],
      "kelamin" => $req['jeniskelamin'] == 'L',
      "tgl_lahir" => $req['tanggallahir'],
      "telpon" => $req['nohp'],
      "alamat" => $req['alamat'],
      // "provinsi" => $req['kodeprop'],
      "provinsi" => 1,
      "nama_provinsi" => $req['namaprop'],
      // "kabupaten" => $req['kodedati2'],
      "kabupaten" => 1,
      "nama_kabupaten" => $req['namadati2'],
      // "kecamatan" => $req['kodekec'],
      "kecamatan" => 1,
      "nama_kecamatan" => $req['namakec'],
      // "kelurahan" => $req['kodekel'],
      "kelurahan" => 1,
      "nama_kelurahan" => $req['namakel'],
      "rw" => $req['rw'],
      "rt" => $req['rt'],
      "nrm" => Patient::max('id')+1,
      // "id" => Patient::max('id')+1,
      "tanggal" => Carbon::now(),
      "sebutan" => $req['jeniskelamin'] == "L" ? "Tn." : "Ny.",
      "tempat_lahir" => "",
      "status" => "",
      "nama_kedusunan" => "",
      "kedusunan" => "",
      "pekerjaan" => "",
      "pendidikan" => "",
      "agama" => "",
      "umur" => "",
      "suami" => "",
      "istri" => "",
      "ayah" => "",
      "ibu" => "",
      "jenis" => "",
      "suku" => "",
      "bahasa" => "",
      "email" => "",
      "bbm" => "",
      "gol_darah" => "",
      "document" => "",
      "keterangan" => "",
      "id_karyawan" => "",
      "nama_karyawan" => "",
      "hubungan" => "",
      "synch" => "",
      "fingerprint" => "",
      "fingerprint_proses" => "",
      "profile_number" => "",
      "alamat_keluarga" => "",
      "desa_keluarga" => "",
      "kecamatan_keluarga" => "",
      "pekerjaan_keluarga" => "",
      "kabupaten_keluarga" => "",
      "umur_keluarga" => "",
      "telepon_keluarga" => "",
      "autonomous" => "",
      "duplicate" => 0,
      "origin" => "",
      "origin_id" => 0,
      "origin_updated" => "",
      "time_updated" => "",
      "kartu" => 0,
      "time_updated" => "",
      "kedusunan" => 0,
      "umur" => 0,
      "id_karyawan" => 0,
      "synch" => 0,
      "time_updated" => Carbon::now(),
    ];
    $addPasien = Patient::insert($dataPasien);
    return $this->responseFormat("Data pasien berhasil disimpan.");
  }

  private function valid($req) {
    $valid = Validator::make($req, [
      // "nomorkartu" => ["required"],
      "nik" => ["required"],
      "nomorkk" => ["required"],
      "nama" => ["required"],
      "jeniskelamin" => ["required"],
      "tanggallahir" => ["required"],
      "nohp" => ["required"],
      "alamat" => ["required", Rule::unique('smis_rg_patient', 'alamat')],
      "kodeprop" => ["required"],
      "namaprop" => ["required"],
      "kodedati2" => ["required"],
      "namadati2" => ["required"],
      "kodekec" => ["required"],
      "namakec" => ["required"],
      "kodekel" => ["required"],
      "namakel" => ["required"],
      "rw" => ["required"],
      "rt" => ["required"],
    ]);
    if ($valid->fails()) {
      $errors = $valid->errors()->getMessages();
      $error_key = array_keys($valid->failed())[0];
      $error_message = $errors[$error_key][0];
      throw new ErrorValidation($error_message, 201);
    }
  }
}
