<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DataKaryawanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_pegawai' => 'required',
            'pendidikan' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'bagian' => 'required',
            'foto' => 'image|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bidang :attribute tidak diperkenankan kosong.',
            'numeric' => 'Silahkan isi bidang :attribute hanya dengan angka.',
            'foto.max' => 'Maksimal foto yang bisa diupload sebesar 5 MB'
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->file('foto') != null) {
            $this->merge([
                'image' => $this->file('foto')->getClientOriginalName()
            ]);
        }
    }
}
