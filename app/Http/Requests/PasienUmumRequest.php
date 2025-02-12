<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasienUmumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nik" => "required|digits:16",
            // "no_kk" => "required",
            "nama" => "required",
            "kelamin" => "required",
            "tanggallahir" => 'date_format:Y-m-d|before_or_equal:now',
            "alamat" => "required:unique,smis_rg_patient",
            "propinsi" => "required",
            "kabupaten" => "required",
            "kecamatan" => "required",
            "rw" => "required",
            "rt" => "required",
            "kelurahan" => "required",
        ];
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK Belum Diisi',
            'nik.digits' => 'Format NIK Tidak Sesuai',
            // 'no_kk.required' => 'Nomor KK Belum Diisi',
            'tanggallahir.required' => 'Tanggal Lahir Belum Diisi',
            'tanggallahir.date_format' => 'Format Tanggal Lahir Tidak Sesuai',
            'tanggallahir.before_or_equal' => 'Format Tanggal Lahir Tidak Sesuai',
            'nama.required' => 'Nama Belum Diisi',
            'kelamin.required' => "Jenis Kelamin Belum Dipilih",
            'alamat.required' => 'Alamat Belum Diisi',
            'propinsi.required' => 'Pilih propinsi dahulu',
            'kabupaten.required' => 'Pilih kabupaten dahulu',
            'kecamatan.required' => 'Pilih kecamatan dahulu',
            'kelurahan.required' => 'Pilih kelurahan dahulu',
            'rt.required' => 'RT Belum Diisi',
            'rw.required' => 'RW Belum Diisi',
        ];
    }
}
