<?php

namespace App\Http\Requests\DataInduk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DataIndukPendidikanRequest extends FormRequest
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
            'nama' => 'required|max:64|min:2',
            'k_laki' => 'required|numeric|digits_between:1,11',
            'k_perempuan' => 'required|digits_between:1,11|numeric',
            'keterangan' => 'max:128',
        ];
    }

    public function messages()
    {
        return [
            'nama.max' => 'Gagal menyimpan data maksimal form NAMA 64 karakter',
            'nama.min' => 'Gagal menyimpan data minimal form NAMA 2 karakter',
            'k_laki.digits_between' => 'Gagal menyimpan data maksimal form KEBUTUHAN LAKI-LAKI 11 karakter',
            'k_perempuan.digits_between' => 'Gagal menyimpan data maksimal form KEBUTUHAN PEREMPUAN 11 karakter',
            'k_laki.numeric' => 'Gagal menyimpan data pastikan form diisi dengan angka',
            'k_perempuan.numeric' => 'Gagal menyimpan data pastikan form diisi dengan angka',
            'keterangan.max' => 'Gagal menyimpan data maksimal form KETERANGAN 128 karakter',
        ];
    }
}
