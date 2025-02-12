<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PenerimaanKasirRequest extends FormRequest
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
            'tanggal_dari' => 'required | date_format:d-m-Y',
            'tanggal_sampai' => 'required | date_format:d-m-Y',
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'tanggal_dari_conv' => Carbon::parse($this->tanggal_dari)->format('Y-m-d'),
            'tanggal_sampai_conv' => Carbon::parse($this->tanggal_sampai)->format('Y-m-d'),
        ]);
    }
}
