<?php

namespace App\Http\Requests;

use App\Models\SmisDocPermintaanPemeriksaanPatologiAnatomi;
use Illuminate\Foundation\Http\FormRequest;

class SmisDocPermintaanPemeriksaanPatologiAnatomiRequest extends FormRequest
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
            'nama_pasien' => ['nullable', 'string'],
            'kelamin_pasien' => ['nullable', 'boolean'],
            'id_dpjp' => ['required', 'integer'],
            'dpjp' => ['required', 'string'],
            'no_pa' => ['required', 'string', 'max:64'],
            'tgl_pemeriksaan' => ['required'],
            'pemeriksaan_jaringan_tubuh' => ['required','string'],
            'jaringan_tubuh_didapat_dari' => ['required','string'],
            'diagnosa_klinik' => ['required', 'string', 'max:128'],
            'jaminan' => ['required', 'string'],
            'keterangan_klinik' => ['required', 'string'],
            'tanggal' => ['required'],
        ];
    }
}
