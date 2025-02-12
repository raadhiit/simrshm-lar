<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumenOrientasiPasienBaruRequest extends FormRequest
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
            'tanggal' => 'required',
            'satu' => 'required',
            'dua' => 'required',
            'tiga' => 'required',
            'empat' => 'required',
            'lima' => 'required',
            'enam' => 'required',
            'tujuh_satu' => 'required',
            'tujuh_dua' => 'required',
            'tujuh_tiga' => 'required',
            'pemahaman' => 'required',
        ];
    }
}
