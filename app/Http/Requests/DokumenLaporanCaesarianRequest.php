<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumenLaporanCaesarianRequest extends FormRequest
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
            'id_d_operator' => 'required',
            'd_operator' => 'required',
            'id_a_operator' => 'required',
            'a_operator' => 'required',
            'id_instrumen' => 'required',
            'instrumen' => 'required',
            'id_d_anastesi' => 'required',
            'd_anastesi' => 'required',
            'id_a_anastesi' => 'required',
            'a_anastesi' => 'required',
            'jenis_anastesi' => 'required',
            'tindakan' => 'required',
            'indikasi_operasi' => 'required',
            'posisi' => 'required',
            'jenis_pembedahan' => 'required',
            'jenis_pembedahan2' => 'required',
            'jenis_luka_operasi' => 'required',
            'tanggal' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'lama_pembedahan' => 'required',
            'no_batch' => 'required',
            'komplikasi' => 'required',
            'pendarahan' => 'required',
            'dikirim_pa' => 'required',
            'asal_jaringan' => 'required'
        ];
    }
}
