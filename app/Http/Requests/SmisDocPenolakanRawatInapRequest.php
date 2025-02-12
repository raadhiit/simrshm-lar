<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmisDocPenolakanRawatInapRequest extends FormRequest
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
            'nama_pasien' => 'nullable',
            'tgl_lahir_pasien' => 'nullable',
            'alamat_pasien' => 'nullable',
            'ktp_pasien' => 'nullable|max:25',

            'nama_kerabat' => 'required|max:128',
            'alamat_kerabat' => 'required|max:25',
            'hubungan' => 'required|max:128',
            'tgl_lahir_kerabat' => 'required',
            'telp_kerabat' => 'required|max:25',
            'ktp_kerabat' => 'required|max:25',
            'alasan' => 'required|max:128',
            'signature_kerabat' => 'required',
            'tanggal' => '',
            'jam' => '',
        ];
    }
}
