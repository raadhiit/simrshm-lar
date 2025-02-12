<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormulirTriageTerintegrasiRequest extends FormRequest
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
            'cara_datang' => 'required',
            'rujukan' => 'required',
            'jam_datang' => 'required',
            'alamat' => 'required',
            'nama_pengantar' => 'required',
            'doa' => 'required',
            'keluhan_utama' => 'required',
            'trauma' => 'required',
            'riwayat_penyakit' => 'required',
            'imunisasi' => 'required',
            'riwayat_alergi' => 'required'
        ];
    }
}
