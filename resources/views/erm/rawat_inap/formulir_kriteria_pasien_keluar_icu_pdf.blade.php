<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Formulir Kriteria Pasien Keluar ICU</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style>
        .table td,
        .table th {
            padding-left: 8px;
            padding-right: 8px;
            padding-top: 1px;
            padding-bottom: 1px;
        }


        .border {
            border: 1px solid black !important;
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
            MR 02.33.001.Rev.0
        </div>
        <div class="font-weight-bold" style="width: 100%; text-align: center; font-size: 17px">
            FORMULIR KRITERIA PASIEN KELUAR ICU
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
                    <td style="text-align: center;">I</td>
                    <td>
                        <span>Pasien tidak lagi memerlukan alat bantu atau obat untuk life-support</span><br>
                        @foreach([
                        'Masker NRM',
                        'Masker RM',
                        'Jacson Rees',
                        'Ventilator',
                        'Dopamin',
                        'Dobutamin',
                        'Vascon',
                        'Adrenalin',
                        'Nicardipine',
                        ] as $index => $item)
                        @if ($item == "Dopamin")
                        <br>
                        @endif
                        <span class="align-middle">
                            <input type="radio" name="{{ Illuminate\Support\Str::slug($item, '-') }}"
                                id="{{ Illuminate\Support\Str::slug($item, '-') }}" {{ is_array($data->etcNo1)
                            && in_array($item,$data->etcNo1) ? 'checked' :
                            ''
                            }}> {{ $item }}</span>
                        @endforeach
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no1" id="no1-1" value="1"
                                {{ isset($data->no1)
                            &&
                            $data->no1 == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no1" id="no1-0" value="0"
                                {{ isset($data->no1)
                            &&
                            $data->no1 == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">II</td>
                    <td>Terapi telah dinyatakan gagal, prognosis jangka pendek jelek dan manfaat
                        kelanjutan terapi intensif kecil (gagal multi oragan tidak berespons terhadap terapi
                        agresif).</td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no2" id="no2-1" value="1"
                                {{ isset($data->no2)
                            &&
                            $data->no2 == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no2" id="no2-0" value="0"
                                {{ isset($data->no2)
                            &&
                            $data->no2 == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">III</td>
                    <td>Pasien dalam kondisi stabil normal (sesuai parameter base line) dan kemungkinan
                        kebutuhan terapi intensif secara mendadak kecil/kurang.<br>
                        <label for="no3" class="form-check-label">
                            <span class="mr-4">Tensi: {{ isset($tanda_vital->tensi)?$tanda_vital->tensi:'' }}
                                mmhg</span>
                            <span class="mr-4">Nadi: {{ isset($tanda_vital->nadi)?$tanda_vital->nadi:'' }}
                                x/mnt</span>
                            <span class="mr-4">Rr: {{ isset($tanda_vital->rr)?$tanda_vital->rr:'' }} x/mnt</span>
                            <br>
                            <span class="mr-4">Suhu: {{ isset($tanda_vital->suhu)?$tanda_vital->suhu:'' }}
                                &deg;C</span>
                            <span>Berat Badan: {{ isset($tanda_vital->berat_badan)?$tanda_vital->berat_badan:'' }}
                                kg</span>
                        </label>
                    </td>
                    <td style="text-align: center;">
                        <dv class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no3" id="no3-1" value="1"
                                {{ isset($data->no3)
                            &&
                            $data->no3 == 1 ? 'checked' : '' }} />
                        </dv>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no3" id="no3-0" value="0"
                                {{ isset($data->no3)
                            &&
                            $data->no3 == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">IV</td>
                    <td>Manfaat terapi intensif kecil karena penyakit primernya sudah terminal, tidak
                        berespons terhadap terapi ICU untuk penyakit akutnya, prognosis jangka pendek kecil dan
                        tidak ada terapi potensial untuk memperbaiki prognosisnya.<br><br>
                        <span>
                            LAIN - LAIN :
                        </span>
                        <br>
                        <span>
                            {{ isset($data->etcNo4) ? $data->etcNo4 : '' }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no4" id="no4-1" value="1"
                                {{ isset($data->no4)
                            &&
                            $data->no4 == 1 ? 'checked' : '' }} />
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="radio" name="no4" id="no4-0" value="0"
                                {{ isset($data->no4)
                            &&
                            $data->no4 == 0 ? 'checked' : '' }} />
                        </div>
                    </td>
                </tr>
            </table>
            <span>Berdasarkan kondisi diatas maka pasien tersebut memenuhi kriteria untuk keluar
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