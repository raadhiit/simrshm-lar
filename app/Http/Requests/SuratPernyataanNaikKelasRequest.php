<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratPernyataanNaikKelasRequest extends FormRequest
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
            'nama_kerabat' => 'required|string|max:128',
            'alamat_kerabat' => 'required|string|max:128',
            'telp_kerabat' => 'required|string|max:25',
            'hubungan' => 'required|string|max:45',
            'hak_kelas_rawat' => 'required|string|max:25',
            'kelas_rawat_sekarang' => 'required|string|max:25',
            'nama_pasien' => 'nullable|string',
            'nobpjs_pasien' => 'nullable|string',
        ];
    }
}
