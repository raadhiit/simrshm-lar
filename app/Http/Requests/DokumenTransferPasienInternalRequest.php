<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumenTransferPasienInternalRequest extends FormRequest
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
            'tgl_transfer' => 'required',
            'jam_transfer' => 'required',
            'id_dpjp' => 'required',
            'dpjp' => 'required',
            'riwayat_penyakit' => 'required',
            'indikasi_rawat' => 'required',
            'id_unit' => 'required',
            'unit' => 'required',
            'keadaan_umum' => 'required',
            // 'gcs_e' => 'required',
            // 'gcs_m' => 'required',
            // 'gcs_v' => 'required',
            // 'kesadaran' => 'required',
            'fasilitas_transfer' => 'required',
        ];
    }
}
