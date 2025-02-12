<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratPermintaanRawatInapRequest extends FormRequest
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
            'unit' => 'required',
            'indikasi_rawat' => 'required',
            'id_dpjp' => 'required',
            'dpjp' => 'required',
            'id_dokter_pengirim' => 'required',
            'dokter_pengirim' => 'required',
            'tgl_rawat_inap' => 'required',
            // 'id_kamar' => 'required',
            // 'kamar' => 'required',
            // 'id_petugas_ranap' => 'required',
            // 'petugas_ranap' => 'required'
        ];
    }
}
