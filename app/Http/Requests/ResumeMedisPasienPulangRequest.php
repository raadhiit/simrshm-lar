<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeMedisPasienPulangRequest extends FormRequest
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
            'indikasi_rawat_inap' => 'required',
            'riwayat_kesehatan' => 'required',
            'pemeriksaan_fisik' => 'required',
            'pemeriksaan_penunjang' => 'required',
            'tgl_kontrol' => 'required',
            'perawatan_dirumah' => 'required',
            'rencana_pemeriksaan_penunjang' => 'required',
            'kebutuhan_edukasi' => 'required',
            'keadaan_akhir' => 'required',
            'mobilisasi_pulang' => 'required',
            'alat_bantu' => 'required',
            'alkes' => 'required',
            'dit' => 'required',
            'disertakan_waktu_pulang' => 'required',
            'penyakit_berhubungan' => 'required',
        ];
    }
}
