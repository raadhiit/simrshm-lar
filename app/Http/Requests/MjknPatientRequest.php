<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MjknPatientRequest extends FormRequest
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
            'nik' => 'required',
            'nama' => 'required',
            'kelamin' => 'required',
            'tgl_lahir' => 'required|date:Y-m-d',
            'telepon' => 'required|min:10',
            'alamat' => 'required',
            'propinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ];
    }

    public function messages(){
        return [
            'nik.required' => 'Nomor ktp harus diisi',
            'nama.required' => 'Nama harus diisi',
            'kelamin.required' => 'Pilih jenis kelamin dahulu',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi',
            'tgl_lahir.date' => 'Format tanggal lahir tidak sesuai',
            'telepon.required' => 'Nomor telepon harus diisi',
            'telepon.min' => 'Nomor telepon minimal 10 digit',
            'alamat.required' => 'Alamat harus diisi',
            'propinsi.required' => 'Pilih propinsi dahulu',
            'kabupaten.required' => 'Pilih kabupaten dahulu',
            'kecamatan.required' => 'Pilih kecamatan dahulu',
            'kelurahan.required' => 'Pilih kelurahan dahulu',
            'rt.required' => 'RT harus diisi',
            'rw.required' => 'RW harus diisi',
        ];
    }
}
