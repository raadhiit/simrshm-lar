<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmisDocSuratPernyataanPulangApsRequest extends FormRequest
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
            'id_dokumen' => ['required'],
            'nama_kerabat' => ['required', 'string', 'max:128'],
            'alamat_kerabat' => ['required', 'string', 'max:25'],
            'hubungan' => ['required'],
            'alasan' => ['required'],
            'tanggal' => ['required'],
            'signature_kerabat' => ['required'],
        ];
    }
}
