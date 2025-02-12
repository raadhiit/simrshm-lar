<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganisasiRequest extends FormRequest
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
            'tipe' => 'required',
            'nama' => 'required',
            'active' => 'required',
            'telepon' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'part_of' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tipe.required' => 'Pilih tipe organisasi dahulu',
            'nama.required' => 'Nama organisasi harus diisi',
            'active.required' => 'Pilih aktif dahulu',
            'telepon.required' => 'Telepon organisasi harus diisi',
            'email.required' => 'Email organisasi harus diisi',
            'alamat.required' => 'Alamat organisasi harus diisi',
            'part_of.required' => 'Pilih bagian dari organisasi dahulu',
        ];
    }
}
