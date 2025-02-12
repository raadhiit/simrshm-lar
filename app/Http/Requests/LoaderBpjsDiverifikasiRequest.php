<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoaderBpjsDiverifikasiRequest extends FormRequest
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
            'tanggal_jurnal' => 'required',
            'bulan_klaim' => 'required',
            'jenis_layanan' => 'required',
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'tanggal_jurnal' => Carbon::parse($this->tanggal_jurnal)->format('Y-m-d'),
            'bulan_klaim' => Carbon::parse($this->bulan_klaim)->format('Y-m'),
        ]);
    }
}
