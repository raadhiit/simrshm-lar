<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RiwayatPasienRequest extends FormRequest
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
            'dari' => 'required',
            'sampai' => 'required',
            'ruangan' => 'required',
        ];
    }
    protected function passedValidation()
    {
        $this->merge([
            'dari' => Carbon::parse($this->dari)->format('Y-m-d'),
            'sampai' => Carbon::parse($this->sampai)->format('Y-m-d'),
        ]);
    }
}
