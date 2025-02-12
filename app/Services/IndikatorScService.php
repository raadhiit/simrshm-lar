<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SMIS_LayananPasien;
use App\Models\SmisDocIndikatorSc;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\DB;

class IndikatorScService
{
    const map_contents = [
        'sc_satu' => 'Pasien melakukan ANC minimal 3x di Rumah Sakit tersebut',
        'sc_dua' => 'Pasien memiliki & membawa buku pink KIA sebelum SC',
        'sc_tiga' => 'Pasien datang dengan KU baik sebelum tindakan SC',
        'sc_empat' => 'Pasien datang dengan GCS normal (14-15) sebelum SC',
        'sc_lima' => 'Pasien mengalami perubahan TD sistolik > 30 mmHg sebelum dan selesai SC disertai gejala syok',
        'sc_enam' => 'Pasien diperiksa darah lengkap sebelum SC (Hb, Leukosit, Tormbosit, Ht)',
        'sc_tujuh' => 'Pasien diperiksa darah lengkap setelah SC (Hb, Leukosit, Tormbosit, Ht)',
        'sc_delapan' => 'Pasien yang diperiksa :
                        <ul style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
                            <li style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;"> PT/APTT atau</li>
                            <li style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">CT/BT</li>
                        </ul>
                        sebelum dilakukan SC',
        'sc_sembilan' => 'Pasien dilakukan transfusi darah sesuai indikasi dan/atau memiiliki Hb < 8 g/dL sebelum SC',
        'sc_sepuluh' => 'Pasien diketahui golongan darah sebelum SC',
        'sc_sebelas' => 'Pasien diperiksa urinalisis sebelum tindakan SC',
        'sc_duabelas' => 'Pasien memiliki data SC sebelum SC',
        'sc_tigabelas' => 'Pasien memiliki data laboratorium HIV sebelum SC',
        'sc_empatbelas' => 'Pasien memiliki data laboratorium Hepatitis sebelum SC',
        'sc_limabelas' => 'Assesmen persalinan pasien menggunakan patograf ditulis lengkap sebelum SC',
        'sc_enambelas' => 'Diagtidaksis Kehamilan Pasien (pilih salah satu)',
        'sc_enambelas_a' => 'Nullipara, janin tunggal, presentasi Kepala, usia kehamilan >= 37 minggu, lahir spontan',
        'sc_enambelas_b' => 'Nullipara, janin tunggal, presentasi Kepala, usia kehamilan >= 37 minggu, lahir dengan induksi',
        'sc_enambelas_c' => 'Multipara, tanpa riwayat perlukaan utarus, janin tunggal, presentasi Kepala, usia kehamilan >= 37 minggu, lahir dengan spontan',
        'sc_enambelas_d' => 'Multipara, tanpa riwayat perlukaan utarus, janin tunggal, presentasi Kepala, usia kehamilan >= 37 minggu, lahir dengan induksi atau SC',
        'sc_enambelas_e' => 'Multipara, memiliki riwayat perlukaan utarus, janin tunggal, presentasi Kepala, usia kehamilan >= 37 minggu',
        'sc_enambelas_f' => 'Nullipara, janin tunggal, sungsang',
        'sc_enambelas_g' => 'Multipara, janin tunggal, sungsang, memiliki riwayat perlukaan uterus',
        'sc_enambelas_h' => 'Seluruh kehamilan dengan janin multipel, memiliki riwayat perlukaan uterus',
        'sc_enambelas_i' => 'Seluruh kehamilan dengan janin tunggal, posisi janin oblik atau melintang, memiliki riwayat perkukaan uterus',
        'sc_enambelas_j' => 'Seluruh kehamilan dengan janin tunggal, presentasi kepala, usia kehamilan <= 36 minggu, memiliki riwayat perlukaan uterus',
        'sc_tujuhbelas' => 'Pasien dilakukan SC dengan indikasi (pilih)',
        'sc_tujuhbelas_a' => 'PEB',
        'sc_tujuhbelas_b' => 'Ketuban Pecah Dini',
        'sc_tujuhbelas_c' => 'Bekas Sectio',
        'sc_tujuhbelas_d' => 'Kelainan letak Janin',
        'sc_tujuhbelas_e' => 'Gagal Induksi',
        'sc_tujuhbelas_f' => 'Kelainan Letak Plasenta',
        'sc_tujuhbelas_g' => 'Persalinan Tidak Maju',
        'sc_tujuhbelas_h' => 'Dispropporsi Kepala Panggul',
        'sc_tujuhbelas_i' => 'Lain-lain',
        'luaran_satu' => 'KU Pasien baik setelah SC',
        'luaran_dua' => 'Pasien meninggal (Ibu) pasca dilakukan tindakan SC',
        'luaran_tiga' => 'Pasien meninggal (Ibu) pasca dilakukan tindakan SC yang merupakan pasien rujukan',
        'luaran_empat' => 'Pasien mengalami komplikasi pasca tindakan SC (syok hipovolemik, syok lain, sepsis, gagal ginjal, gagal jantung, ARDS, atau komplikasi lainnya',
        'luaran_lima' => 'Pasien mengalami perluasan tindakan (ligasi, B-lynch, histerktomi, pembedahan lain akibat cedera organ)',
        'luaran_enam' => 'Pasien memerlukan perluasan pengobatan (transfusi darah, hemodialisis, heparin)',
        'luaran_tujuh' => 'Pasien saat pulang membutuhkan perawatan lanjutan',
        'luaran_delapan' => 'Neonatus Pasien meninggal pasca dilakukan tindakan SC di Rumah Sakit setempat',
        'luaran_sembilan' => 'Neonatus Pasien meninggal pasca dilakukan tindakan SC di Rumah Sakit setempat yang Ibunya merupakan pasien rujukan',
        'luaran_sepuluh' => 'Neonatus Pasien mengalami komplikasi pasca tindakan SC (RDS, Sepsis, HIE) di Rumah Sakit setempat',
        'luaran_sebelas' => 'Neonatus Pasien memerlukan perluasan pengobatan (CPAP, Ventilator, Transfusi) di Rumah Sakit Setempat',
        'luaran_duabelas' => 'Neonatus Pasien saat pulang membutuhkan perawatan lanjutan di Rumah Sakit Setempat',
        'luaran_tigabelas' => 'Tarif pembiayaan SC Rumah Sakit tidak melebihi tarif INACBGs',
    ];

    function data($req)
    {
        $dokumen = DokumenKunjungan::select('id', 'noreg', 'nama_pasien', 'nrm', 'id_verifikator', 'nama_verifikator')->findOrFail($req->dokumen);
        $id_verifikator = $dokumen->id_verifikator;
        $data['pasien'] = $dokumen->rm_pasien()->select('id', 'nama', 'kelamin', 'tgl_lahir', 'ktp')->first();
        $data['employee'] = SmisHrdEmployee::select('id', 'nama', 'username', 'ttd')
            ->where('username', function ($query) use ($id_verifikator) {
                $query->select('username')
                    ->from('smis_adm_user')
                    ->where('id', $id_verifikator)
                    ->limit(1);
            })->first();
        $data['dokumen'] = $dokumen;
        $data['indikator_sc'] = $dokumen->indikator_sc ?? null;

        return $data;
    }

    function save($req)
    {
        $indikator_sc = SmisDocIndikatorSc::updateOrCreate([
            'id_dokumen' => $req->dokumen,
        ], [
            'id_dokumen' => $req->dokumen,
            'tanggal' => $req->tanggal,
            'sc_satu' => $req->sc_satu,
            'sc_dua' => $req->sc_dua,
            'sc_tiga' => $req->sc_tiga,
            'sc_empat' => $req->sc_empat,
            'sc_lima' => $req->sc_lima,
            'sc_enam' => $req->sc_enam,
            'sc_tujuh' => $req->sc_tujuh,
            'sc_delapan' => $req->sc_delapan,
            'sc_sembilan' => $req->sc_sembilan,
            'sc_sepuluh' => $req->sc_sepuluh,
            'sc_sebelas' => $req->sc_sebelas,
            'sc_duabelas' => $req->sc_duabelas,
            'sc_tigabelas' => $req->sc_tigabelas,
            'sc_empatbelas' => $req->sc_empatbelas,
            'sc_limabelas' => $req->sc_limabelas,
            'sc_enambelas_a' => $req->sc_enambelas_a,
            'sc_enambelas_b' => $req->sc_enambelas_b,
            'sc_enambelas_c' => $req->sc_enambelas_c,
            'sc_enambelas_d' => $req->sc_enambelas_d,
            'sc_enambelas_e' => $req->sc_enambelas_e,
            'sc_enambelas_f' => $req->sc_enambelas_f,
            'sc_enambelas_g' => $req->sc_enambelas_g,
            'sc_enambelas_h' => $req->sc_enambelas_h,
            'sc_enambelas_i' => $req->sc_enambelas_i,
            'sc_enambelas_j' => $req->sc_enambelas_j,
            'sc_tujuhbelas_a' => $req->sc_tujuhbelas_a,
            'sc_tujuhbelas_b' => $req->sc_tujuhbelas_b,
            'sc_tujuhbelas_c' => $req->sc_tujuhbelas_c,
            'sc_tujuhbelas_d' => $req->sc_tujuhbelas_d,
            'sc_tujuhbelas_e' => $req->sc_tujuhbelas_e,
            'sc_tujuhbelas_f' => $req->sc_tujuhbelas_f,
            'sc_tujuhbelas_g' => $req->sc_tujuhbelas_g,
            'sc_tujuhbelas_h' => $req->sc_tujuhbelas_h,
            'sc_tujuhbelas_i' => $req->sc_tujuhbelas_i,
            'luaran_satu' => $req->luaran_satu,
            'luaran_dua' => $req->luaran_dua,
            'luaran_tiga' => $req->luaran_tiga,
            'luaran_empat' => $req->luaran_empat,
            'luaran_lima' => $req->luaran_lima,
            'luaran_enam' => $req->luaran_enam,
            'luaran_tujuh' => $req->luaran_tujuh,
            'luaran_delapan' => $req->luaran_delapan,
            'luaran_sembilan' => $req->luaran_sembilan,
            'luaran_sepuluh' => $req->luaran_sepuluh,
            'luaran_sebelas' => $req->luaran_sebelas,
            'luaran_duabelas' => $req->luaran_duabelas,
            'luaran_tigabelas' => $req->luaran_tigabelas,
        ]);

        return $indikator_sc;
    }

    /**
     * @param \App\Models\SmisDocIndikatorSc|null $data_sc ,
     * @param string $key ,
     * @param mixed $value
     */
    function check_input($data_sc, $key, $value)
    {
        return !empty($data_sc) && $data_sc[$key] == $value;
    }

    function is_checkbox(string $key)
    {
        return strpos($key, 'belas_') && $key != 'sc_tujuhbelas_i';
    }

    function map_pdf(SmisDocIndikatorSc $indikator_sc)
    {
        $map = [];

        foreach (self::map_contents as $key => $label) {
            $split_keys = explode('_', $key);
            $group_key = $split_keys[0];

            if ($key == 'sc_satu' || $key == 'luaran_satu') {
                $id = '1';
            } else if (!empty($split_keys[2])) {
                $id = $split_keys[2];
            } else if ($key == 'sc_tujuhbelas') {
                $id = '17';
            } else if ($key == 'sc_enambelas') {
                $id = '16';
            } else {
                $id = (string) ($id + 1);
            }

            if ($group_key != 'sc' && $group_key != 'luaran') {
                continue;
            }

            $is_label = $key == 'sc_enambelas' || $key == 'sc_tujuhbelas';
            $is_checkbox = !$is_label && $this->is_checkbox($key);
            $is_radio = in_array($indikator_sc->$key, ['ya', 'tidak']);
            $map[$group_key][$key] = [
                'id' => $id,
                'key' => $key,
                'value' => $indikator_sc->$key,
                'label' => $label,
                'is_checkbox' => $is_checkbox,
                'is_radio' => $is_radio,
                'is_label' => $is_label,
                'is_text' => !$is_label && !$is_checkbox && !$is_radio,
                'type' => $is_label ? 'label' : ($is_checkbox ? 'checkbox' : ($is_radio ? 'radio' : 'text')),
            ];
            $map[$group_key][$key]['raw_html'] = $this->raw_element($map[$group_key][$key]);
        }

        return $map;
    }

    function raw_element($data)
    {
        $element = '';

        switch ($data['type']) {
            case 'label':
                $element = '<tr>
                    <td style="text-align: center;">' . $data['id'] . '</td>
                    <td colspan="4">' . $data['label'] . '</td>
                </tr>';
                break;

            case 'checkbox':
                $checked = $data['value'] ? 'checked' : '';
                $element = '<tr>
                    <td style="text-align: center;">' . $data["id"] . '</td>
                    <td style="width: 95%" colspan="2">' . $data["label"] . '</td>
                    <td style="text-align: center; width: 15%;">
                        <input
                            type="checkbox"
                            name="' . $data["key"] . '"
                            ' . $checked . '
                        >
                    </td>
                </tr>';
                break;

            case 'radio':
                $checked_true = $this->check_input($data, 'value', 'ya') ? 'checked' : '';
                $checked_false = $this->check_input($data, 'value', 'tidak') ? 'checked' : '';

                $element = '<tr>
                    <td style="text-align: center; width: 5%">' . $data["id"] . '</td>
                    <td style="width: 65%">' . $data["label"] . '</td>
                    <td style="width: 15%; text-align: center">
                        <input
                            type="radio"
                            value="ya"
                            name="' . $data["key"] . '"
                            ' . $checked_true . '
                            style="margin-bottom: 4px;"
                        >
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input
                            type="radio"
                            value="tidak"
                            name="' . $data["key"] . '"
                            ' . $checked_false . '
                            style="margin-bottom: 4px;"
                        >
                    </td>
                </tr>';
                break;

            case 'text':
                $element = '<tr>
                    <td style="text-align: center;">' . $data["id"] . '</td>
                    <td colspan="3" style="width: 100%">
                        <div class="d-flex align-items-start justify-content-between pr-3">
                            <span class="pr-3">' . $data["label"] . '</span>
                            <p class="flex-grow-1" style="padding: 0; margin: 4px; margin-top: 2px; border: 0; border-bottom: 2px dotted; background-color: transparent;">
                                ' . $data["value"] . '
                            </p>
                        </div>
                    </td>
                </tr>';
        }

        return $element;
    }
}
