<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratPernyataanPenitipanKelasRequest extends FormRequest
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
            'id_dokumen' => 'required',
            'tanggal' => 'required',
            'nama_pasien' => 'nullable|string|max:128',
            'alamat_pasien' => 'nullable|string|max:128',
            'telp_pasien' => 'nullable|string|max:25',
            'nama_kerabat' => 'required|string|max:128',
            'telp_kerabat' => 'required|string|max:25',
            'alamat_kerabat' => 'required|string|max:128',
            'hubungan' => 'required|string|max:128',
            'kelas_lama' => 'required|string:max:25',
            'kelas_baru' => 'required|string|max:25',
            'signature_kerabat' => 'nullable',
            'nama_saksi' => 'nullable|string',
            'signature_saksi' => 'nullable',
            'pass' => 'nullable',
        ];
    }
}
