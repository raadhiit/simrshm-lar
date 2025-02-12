<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsesmentMedisAwalRequest extends FormRequest
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
            'keluhan_utama' => 'required',
            'riwayat_penyakit_sekarang' => 'required',
            'riwayat_penyakit_dahulu' => 'required',
            'riwayat_alergi_obat' => 'required',
            'kesadaran' => 'required',
            'kesadaran_umum' => 'required',
            'berat_badan' => 'required',
            'saudara' => 'required',
            'tinggal_bersama' => 'required',
            'bicara' => 'required',
            'komunikasi' => 'required',
            'emosional' => 'required',
            'gangguan_jiwa' => 'required',
            'riwayat_trauma' => 'required',
            'perasaan' => 'required',
            'wawancara' => 'required',
            'spiritual' => 'required',
            'kebutuhan_spiritual' => 'required',
            'pekerjaan' => 'required',
            'nyeri' => 'required',
            'cara_berjalan' => 'required',
            'memegang_kursi' => 'required',
            'hasil_resiko_jatuh' => 'required',
            'beritahu_dokter' => 'required',
            'hasil_skrining_resiko_jatuh' => 'required',
            'saran_resiko_jatuh' => 'required',
            'bb_gizi' => 'required',
            'pb_gizi' => 'required',
            'imt_gizi' => 'required',
            'tampak_kurus' => 'required',
            'penurunan_bb' => 'required',
            'asupan_makanan' => 'required',
            'hasil_skrining_gizi' => 'required',
            'saran_skrining_gizi' => 'required',
            'sensorik_penglihatan' => 'required',
            'sensorik_penciuman' => 'required',
            'sensorik_pendengaran' => 'required',
            'kognitif_satu' => 'required',
            'motorik_satu' => 'required',
            'motorik_dua' => 'required',
            'saran_satu' => 'required',
            'saran_dua' => 'required',
            'saran_tiga' => 'required',
            'hasil_discharge_planning' => 'required',
            'saran_discharge_planning' => 'required',
            'status_generalis' => 'required',
            'kontrol_ulang' => 'required',
            'rujuk' => 'required',
            'penyampaian_edukasi' => 'required',
            'ppa' => 'required',
            'subyektif' => 'required',
            'instruksi_kesehatan' => 'required'
        ];
    }
}
