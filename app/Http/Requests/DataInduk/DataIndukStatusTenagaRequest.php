<?php

namespace App\Http\Requests\DataInduk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DataIndukStatusTenagaRequest extends FormRequest
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
            'nama' => 'required|max:32|min:2',
        ];
    }

    public function messages()
    {
        return [
            'nama.max' => 'Gagal menyimpan data maksimal form NAMA 32 karakter',
            'nama.min' => 'Gagal menyimpan data minimal form NAMA 2 karakter',
        ];
    }
}
