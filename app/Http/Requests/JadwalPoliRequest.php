<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalPoliRequest extends FormRequest
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
            'poli' => "required",
            'poli_bpjs' => "required",
            'dokter' => "required",
            'dokter_bpjs' => "required",
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kuota_jkn' => 'required|min:0',
            'kuota_non_jkn' => 'required|min:0',
        ];
    }

    public function messages()
    {
        return [
            'poli.required' => "Pilih poli terlebih dahulu",
            'poli_bpjs.required' => 'Pilih kode poli terlebih dahulu',
            'dokter.required' => 'Pilih dokter terlebih dahulu',
            'dokter_bpjs.required' => 'Pilih kode dokter terlebih dahulu',
            'hari.required' => 'Pilih hari dahulu',
            'jam_mulai.required' => 'Pilih jam mulai dahulu',
            'jam_selesai.required' => 'Pilih jam selesai dahulu',
            'kuota_jkn.required' => 'Kuota JKN harus diisi',
            'kuota_non_jkn.required' => 'Kuota non JKN harus diisi',
            'kuota_jkn.min' => 'Kuota JKN minimal 0',
            'kuota_non_jkn.min' => 'Kuota non JKN minimal 0',
        ];
    }
}
