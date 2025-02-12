<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Formulir Kriteria Pasien Masuk ICU</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <style>
        .border {
            border: 1px solid black !important;
        }

        .table td,
        .table th {
            padding-left: 8px;
            padding-right: 8px;
            padding-top: 1px;
            padding-bottom: 1px;
        }

        .table.table-bordered td,
        .table.table-bordered th {
            border: 1px solid black !important;
        }

        .input-dotted {
            border: none !important;
            border-bottom: 1px dotted black !important;
        }
    </style>
</head>




<body class="p-2" style="font-size: 9pt;">

    <div style="position: relative; display: flex; width: 100%; height: 65px">
        <div style="width: 100%; text-align: right">
            MR 02.31.001.Rev.0
        </div>
        <div class="font-weight-bold" style="width: 100%; text-align: center; font-size: 17px">
            FORMULIR KRITERIA PASIEN MASUK ICU
        </div>
        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo"
            style="height: 50px; position: absolute; top: 10px">
    </div>
    <div class="row">
        <div autocomplete="off">
            <table class="table table-bordered font-weight-bold" style="margin-bottom: 0; width: 100%">
                <tr>
                    <td>
                        NAMA PASIEN : {{$dokumen->nama_pasien }}
                    </td>
                    <td>
                        DIAGNOSA : {{ $data->diagnosa }}
                    </td>
                </tr>
                <tr>
                    <td>
                        TANGGAL LAHIR : {{$layanan->tgl_lahir }}
                    </td>
                    <td>
                        RUANGAN : {{ $layanan->last_nama_ruangan}}
                    </td>
                </tr>
                <tr>
                    <td>
                        DOKTER YANG MERAWAT : {{ $data && $data->dokter_yang_merawat ?
                        $data->dokter_yang_merawat->nama : '' }}
                    </td>
                    <td>
                        DOKTER KONSULANT ICU : {{ $data && $data->dokter_konsulant_icu ?
                        $data->dokter_konsulant_icu->nama : '' }}
                    </td>
                </tr>
            </table>
            <div class="d-flex my-1 w-25">
                <p>Tanggal : {{ $data && $data->tanggal ? $data->tanggal->format('d/m/Y') : '' }}</p>
            </div>
            <table class="table table-bordered" style="margin-bottom: 0; width: 100%">
                <tr>
                    <td style="text-align: center;">NO</td>
                    <td></td>
                    <td style="text-align: center;">YA</td>
                    <td style="text-align: center;">TIDAK</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><b>I</b></td>
                    <td><b>PRIORITAS 1</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>1. Pasien kritis tidak stabil</td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static prioritas1-group" type="radio"
                                data-group="prioritas" name="prioritas1[no1]" id="prioritas1-no1-1" value="1"
                                aria-label="Pasien kritis tidak stabil" {{ isset($data->prioritas1['no1'])
                            &&
                            $data->prioritas1['no1'] == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static prioritas1-group" type="radio"
                                data-group="prioritas" name="prioritas1[no1]" id="prioritas1-no1-0" value="0"
                                aria-label="Pasien tidak kritis dan stabil" {{ isset($data->prioritas1['no1'])
                            &&
                            $data->prioritas1['no1'] == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label for="prioritas1-no1-1" class="form-check-label">
                            <span class="mr-4">
                                Tensi: {{ isset($tanda_vital->tensi)?$tanda_vital->tensi:''}} mmhg
                            </span>
                            <span class="mr-4">
                                Nadi: {{ isset($tanda_vital->nadi)?$tanda_vital->nadi:''}} x/mnt
                            </span>
                            <span class="mr-4">
                                Rr: {{ isset($tanda_vital->rr)?$tanda_vital->rr:'' }} x/mnt
                            </span>
                            <br>
                            <span class="mr-4">
                                Suhu: {{ isset($tanda_vital->suhu)?$tanda_vital->suhu:'' }} &deg;C
                            </span>
                            <span>
                                Berat Badan: {{ isset($tanda_vital->berat_badan)?$tanda_vital->berat_badan:'' }} kg
                            </span>
                        </label>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span class="mr-4">GCS: {{ isset($data->etc['gcs'])?$data->etc['gcs']:'' }}</span>
                        <span class="mr-4">E: {{ isset($data->etc['e'])?$data->etc['e']:'' }}</span>
                        <span class="mr-4">V: {{ isset($data->etc['v'])?$data->etc['v']:'' }}</span>
                        <span>M: {{ isset($data->etc['m'])?$data->etc['m']:'' }}</span>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>2. Pasien memerlukan bantuan ventilasi</td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static prioritas1-group" type="radio"
                                data-group="prioritas" name="prioritas1[no2]" id="prioritas1-no2-1" value="1" {{
                                isset($data->prioritas1['no2'])
                            &&
                            $data->prioritas1['no2'] == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static prioritas1-group" type="radio"
                                data-group="prioritas" name="prioritas1[no2]" id="prioritas1-no2-0" value="0"
                                aria-label="Pasien memerlukan bantuan ventilasi" {{ isset($data->prioritas1['no2'])
                            &&
                            $data->prioritas1['no2'] == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span class="mr-5">Sebutkan:</span><br>
                        <span class="align-middle">
                            <input type="radio" name="etc[no2checkbox][]" id="etc[no2checkbox][]" {{
                                isset($data->etc['no2checkbox']) && in_array('maskernrm',$data->etc['no2checkbox'])
                            ? 'checked' : '' }}> Masker NRM
                        </span>
                        <span class="align-middle">
                            <input type="radio" name="etc[no2checkbox][]" id="etc[no2checkbox][]" {{
                                isset($data->etc['no2checkbox']) && in_array('maskerrm',$data->etc['no2checkbox'])
                            ? 'checked' : '' }}> Masker RM
                        </span>
                        <span class="align-middle">
                            <input type="radio" name="etc[no2checkbox][]" id="etc[no2checkbox][]" {{
                                isset($data->etc['no2checkbox']) && in_array('jacsonrees',$data->etc['no2checkbox'])
                            ? 'checked' : '' }}> Jackson Rees
                        </span>
                        <span class="align-middle">
                            <input type="radio" name="etc[no2checkbox][]" id="etc[no2checkbox][]" {{
                                isset($data->etc['no2checkbox']) && in_array('ventilator',$data->etc['no2checkbox'])
                            ? 'checked' : '' }}> Ventilator
                        </span>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>3. Pasien memerlukan obat-obat vasioaktif</td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static prioritas1-group" type="radio"
                                data-group="prioritas" name="prioritas1[no3]" id="prioritas1-no3-1" value="1"
                                aria-label="Pasien memerlukan obat-obat vasioaktif" {{ isset($data->prioritas1['no3'])
                            &&
                            $data->prioritas1['no3'] == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static prioritas1-group" type="radio"
                                data-group="prioritas" name="prioritas1[no3]" id="prioritas1-no3-0" value="0"
                                aria-label="Pasien tidak memerlukan obat-obat vasioaktif" {{
                                isset($data->prioritas1['no3'])
                            &&
                            $data->prioritas1['no3'] == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span class="mr-5">Sebutkan:</span><br>
                        <span class="align-middle">
                            <input type="radio" name="etc[no3checkbox][]" id="etc[no3checkbox][]" {{
                                isset($data->etc['no3checkbox']) && in_array('dopamin',$data->etc['no3checkbox'])
                            ? 'checked' : '' }}> Dopamin
                        </span>
                        <span class="align-middle">
                            <input type="radio" name="etc[no3checkbox][]" id="etc[no3checkbox][]" {{
                                isset($data->etc['no3checkbox']) && in_array('dobutamin',$data->etc['no3checkbox'])
                            ? 'checked' : '' }}> Dobutamin
                        </span>
                        <span class="align-middle">
                            <input type="radio" name="etc[no3checkbox][]" id="etc[no3checkbox][]" {{
                                isset($data->etc['no3checkbox']) && in_array('vascon',$data->etc['no3checkbox'])
                            ? 'checked' : '' }}> Vascon
                        </span>
                        <span class="align-middle">
                            <input type="radio" name="etc[no3checkbox][]" id="etc[no3checkbox][]" {{
                                isset($data->etc['no3checkbox']) && in_array('adrenalin',$data->etc['no3checkbox'])
                            ? 'checked' : '' }}> Adrenalin
                        </span>
                        <span class="align-middle">
                            <input type="radio" name="etc[no3checkbox][]" id="etc[no3checkbox][]" {{
                                isset($data->etc['no3checkbox']) &&
                            in_array('nicardipine',$data->etc['no3checkbox'])
                            ? 'checked' : '' }}> Nicardipine
                        </span>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><b>II</b></td>
                    <td><b>PRIORITAS II</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pasien yang memerlukan observasi ketat dan kondisinya sewaktu-waktu dapat
                        berubah.</td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas2"
                                id="prioritas2-1" value="1" aria-label="Pasien memerlukan observasi ketat" {{
                                isset($data->prioritas2)
                            &&
                            $data->prioritas2 == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas2"
                                id="prioritas2-0" value="0" aria-label="Pasien tidak memerlukan observasi ketat" {{
                                isset($data->prioritas2)
                            &&
                            $data->prioritas2 == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;"><b>III</b></td>
                    <td><b>PRIORITAS III</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pasien dengan penyakit primer berat atau terminal dengan komplikasi penyakit
                        akut, kritis yang memerlukan pertolongan untuk penyakit kritisnya tetapi tidak sampai
                        intubasi dan RJP</td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas3"
                                id="prioritas3-1" value="1" aria-label="Pasien memerlukan observasi ketat" {{
                                isset($data->prioritas3)
                            &&
                            $data->prioritas3 == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas3"
                                id="prioritas3-0" value="0" aria-label="Pasien tidak memerlukan observasi ketat" {{
                                isset($data->prioritas3)
                            &&
                            $data->prioritas3 == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;"><b>IV</b></td>
                    <td><b>PRIORITAS IV</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>A. Pasien Jantung <br>
                        <span class="ml-3">
                            Sebutkan diagnosanya
                        </span>
                        <span>
                            <input type="text" class="input-dotted w-50 ignore-check" id="etc[jantung-diagnosa]"
                                name="etc[jantung-diagnosa]"
                                value="{{ isset($data->etc['jantung-diagnosa']) ? $data->etc['jantung-diagnosa'] : '' }}">
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[jantung]"
                                id="prioritas4-jantung-1" value="1" {{ isset($data->prioritas4['jantung'])
                            &&
                            $data->prioritas4['jantung'] == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[jantung]"
                                id="prioritas4-jantung-0" value="0" aria-label="Pasien memerlukan bantuan ventilasi" {{
                                isset($data->prioritas4['jantung'])
                            &&
                            $data->prioritas4['jantung'] == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>B. Pasien Paru <br>
                        <span class="ml-3">
                            Sebutkan diagnosanya
                        </span>
                        <span>
                            <input type="text" class="input-dotted w-50 ignore-check" id="etc[paru-diagnosa]"
                                name="etc[paru-diagnosa]"
                                value="{{ isset($data->etc['paru-diagnosa']) ? $data->etc['paru-diagnosa'] : '' }}">
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[paru]"
                                id="prioritas4-paru-1" value="1" {{ isset($data->prioritas4['paru'])
                            &&
                            $data->prioritas4['paru'] == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[paru]"
                                id="prioritas4-paru-0" value="0" aria-label="Pasien memerlukan bantuan ventilasi" {{
                                isset($data->prioritas4['paru'])
                            &&
                            $data->prioritas4['paru'] == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>C. Pasien Neurologi <br>
                        <span class="ml-3">
                            Sebutkan diagnosanya
                        </span>
                        <span>
                            <input type="text" class="input-dotted w-50 ignore-check" id="etc[neurologi-diagnosa]"
                                name="etc[neurologi-diagnosa]"
                                value="{{ isset($data->etc['neurologi-diagnosa']) ? $data->etc['neurologi-diagnosa'] : '' }}">
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[neurologi]"
                                id="prioritas4-neurologi-1" value="1" {{ isset($data->prioritas4['neurologi'])
                            &&
                            $data->prioritas4['neurologi'] == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[neurologi]"
                                id="prioritas4-neurologi-0" value="0" aria-label="Pasien memerlukan bantuan ventilasi"
                                {{ isset($data->prioritas4['neurologi'])
                            &&
                            $data->prioritas4['neurologi'] == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>D. Pasien Post Operasi Besar <br>
                        <span class="ml-3">
                            Sebutkan diagnosanya
                        </span>
                        <span>
                            <input type="text" class="input-dotted w-50 ignore-check" id="etc[postoperasi-diagnosa]"
                                name="etc[postoperasi-diagnosa]"
                                value="{{ isset($data->etc['postoperasi-diagnosa']) ? $data->etc['postoperasi-diagnosa'] : '' }}">
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[postoperasi]"
                                id="prioritas4-postoperasi-1" value="1" {{ isset($data->prioritas4['postoperasi'])
                            &&
                            $data->prioritas4['postoperasi'] == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="prioritas4[postoperasi]"
                                id="prioritas4-postoperasi-0" value="0" aria-label="Pasien memerlukan bantuan ventilasi"
                                {{ isset($data->prioritas4['postoperasi'])
                            &&
                            $data->prioritas4['postoperasi'] == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
            </table>
            <span>Berdasarkan kondisi diatas maka pasien tersebut memenuhi kriteria untuk masuk
                ICU</span>
            <div class="w-100 mt-5 position-relative justify-content-end d-flex">
                <div style="position: absolute; right:0">
                    <b>DPJP/Konsultan ICU</b>
                    <div style="height: 100px;" class="d-flex align-items-center">
                        @if ($data && $data->status && $dokumen && $dokumen->status &&
                        $dokumen->id_verifikator)
                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}"
                            style="height: 100%;object-fit: contain;" alt="">
                        @endif
                    </div>
                    <div>Nama: {{ $dokumen->nama_verifikator ?? '' }}</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>