<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndikatorScRequest extends FormRequest
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
            'dokumen' => '',
            'tanggal' => '',
            'sc_satu' => '',
            'sc_dua' => '',
            'sc_tiga' => '',
            'sc_empat' => '',
            'sc_lima' => '',
            'sc_enam' => '',
            'sc_tujuh' => '',
            'sc_delapan' => '',
            'sc_sembilan' => '',
            'sc_sepuluh' => '',
            'sc_sebelas' => '',
            'sc_duabelas' => '',
            'sc_tigabelas' => '',
            'sc_empatbelas' => '',
            'sc_limabelas' => '',
            'sc_enambelas_a' => 'boolean',
            'sc_enambelas_b' => 'boolean',
            'sc_enambelas_c' => 'boolean',
            'sc_enambelas_d' => 'boolean',
            'sc_enambelas_e' => 'boolean',
            'sc_enambelas_f' => 'boolean',
            'sc_enambelas_g' => 'boolean',
            'sc_enambelas_h' => 'boolean',
            'sc_enambelas_i' => 'boolean',
            'sc_enambelas_j' => 'boolean',
            'sc_tujuhbelas_a' => 'boolean',
            'sc_tujuhbelas_b' => 'boolean',
            'sc_tujuhbelas_c' => 'boolean',
            'sc_tujuhbelas_d' => 'boolean',
            'sc_tujuhbelas_e' => 'boolean',
            'sc_tujuhbelas_f' => 'boolean',
            'sc_tujuhbelas_g' => 'boolean',
            'sc_tujuhbelas_h' => 'boolean',
            'sc_tujuhbelas_i' => 'nullable',
            'luaran_satu' => '',
            'luaran_dua' => '',
            'luaran_tiga' => '',
            'luaran_empat' => '',
            'luaran_lima' => '',
            'luaran_enam' => '',
            'luaran_tujuh' => '',
            'luaran_delapan' => '',
            'luaran_sembilan' => '',
            'luaran_sepuluh' => '',
            'luaran_sebelas' => '',
            'luaran_duabelas' => '',
            'luaran_tigabelas' => '',
            'password' => 'nullable',
        ];
    }
}
