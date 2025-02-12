<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Formulir Kriteria Pasien Masuk ICU</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"
        integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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



<body class="p-2">
    <div class="container-fluid">
        <div class="row align-items-stretch justify-conten-between">
            <div class="col-sm-12 col-md-3">
                <div class="w-100" style="padding:30px; padding-bottom:0; font-weight: bold;">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 100px;">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 text-center font-weight-bold my-auto" style="font-size: 20px">
                FORMULIR
                KRITERIA PASIEN MASUK ICU</div>
            <div class="col-sm-12 col-md-3 text-right pr-5 ">
                MR 02.31.001.Rev.0
                <table>
                    <tr style="text-align: left">
                        <th>Nama</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ $layanan->nama_pasien }}</th>
                    </tr>
                    <tr style="text-align: left">
                        <th>No. RM</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ $layanan->nrm }}</th>
                    </tr>
                    <tr style="text-align: left">
                        <th>Tgl Lahir</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</th>
                    </tr>
                    <tr style="text-align: left">
                        <th>Jenis Kelamin</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ $layanan->jk ? 'Perempuan' : 'Laki-Laki' }}</th>
                    </tr>
                    <tr style="text-align: left">
                        <th>NIK</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ $layanan->ktp }}</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="m-0 p-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session()->has('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <form method="post" class="col-12" autocomplete="off">
                @csrf
                <input type="hidden" name="action" value="Simpan" />
                <input type="hidden" name="id_ttv" value="{{ $data->id_ttv }}" />
                <input type="hidden" name="nrm" value="{{ $dokumen->nrm }}" />
                <input type="hidden" name="noreg" value="{{ $dokumen->noreg }}" />
                <table class="table table-bordered font-weight-bold W-100" style="margin-bottom: 0">
                    <tr>
                        <td>
                            <label for="ruangan" style="width: 230px">RUANGAN</label>:
                            <select name="ruangan" id="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($ruangan as $ru)
                                <option @if(old('ruangan')) {{ old('ruangan') == $ru->slug ? 'selected' : '' }} @else {{ is_null($data) ? ($ru->slug == $layanan->last_ruangan ? 'selected' : '') : ($ru->slug == $data->ruangan ? 'selected' : '') }} @endif value="{{ $ru->slug }}">{{ $ru->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <label for="nama" style="width: 230px">DIAGNOSA</label>:
                            <input type="text" name="diagnosa" id="diagnosa" class="form-control"
                                value="{{ old('diagnosa') ?? ($data && $data->diagnosa ? $data->diagnosa : '') }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="id_dokter_yang_merawat" style="width: 230px">DOKTER YANG MERAWAT</label>:
                            <select name="id_dokter_yang_merawat" id="id_dokter_yang_merawat"
                                class="w-100 form-control select2">
                                <option disabled selected></option>
                                @foreach($dokter_yang_merawat as $dokter)
                                <option value="{{ $dokter->id }}" {{ old('id_dokter_yang_merawat')==$dokter->id
                                    || ($data && $data->id_dokter_yang_merawat == $dokter->id) ? 'selected'
                                    :
                                    '' }}>{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <label for="id_dokter_yang_merawat" style="width: 230px">DOKTER KONSULANT ICU</label>:
                            <select name="id_dokter_konsulant_icu" id="id_dokter_konsulant_icu"
                                class="w-100 form-control select2">
                                <option disabled selected></option>
                                @foreach($dokter_konsulant_icu as $dokter)
                                <option value="{{ $dokter->id }}" {{ old('id_dokter_konsulant_icu')==$dokter->id
                                    || ($data && $data->id_dokter_konsulant_icu == $dokter->id) ? 'selected'
                                    : ''
                                    }}>{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="d-flex my-3 w-25">
                    <label for="tanggal" class="mr-4 my-auto">Tanggal:</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control datepicker"
                        value="{{ old('tanggal') ?? ($data && $data->tanggal ? $data->tanggal->format('d/m/Y') : '') }}" />
                </div>
                <table class="table table-bordered" cellpadding="0">
                    <tr>
                        <td style="width: 100px">NO</td>
                        <td colspan="9"></td>
                        <td style="width: 200px">YA</td>
                        <td style="width: 200px">TIDAK</td>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td colspan="9">PRIORITAS 1</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">1. Pasien kritis tidak stabil</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static prioritas1-group" type="radio"
                                    data-group="prioritas" name="prioritas1[no1]" id="prioritas1-no1-1" value="1"
                                    aria-label="Pasien kritis tidak stabil" {{ isset($data->prioritas1['no1'])
                                &&
                                $data->prioritas1['no1'] == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
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
                        <td colspan="9">
                            <label for="prioritas1-no1-1" class="form-check-label">
                                <span class="mr-4 ml-3">Tensi:<input class="input-dotted text-center"
                                        style="width: 60px" type="text" name="tensi" id="prioritas1-tensi"
                                        value="{{ isset($tanda_vital->tensi)?$tanda_vital->tensi:'' }}"
                                        aria-label="tensi">mmhg</span>
                                <span class="mr-4">Nadi:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="nadi" id="prioritas1-nadi"
                                        value="{{ isset($tanda_vital->nadi)?$tanda_vital->nadi:'' }}"
                                        aria-label="nadi">x/mnt</span>
                                <span class="mr-4">Rr:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="rr" id="prioritas1-rr"
                                        value="{{ isset($tanda_vital->rr)?$tanda_vital->rr:'' }}"
                                        aria-label="rr">x/mnt</span>
                                <span class="mr-4">Suhu:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="suhu" id="prioritas1-suhu"
                                        value="{{ isset($tanda_vital->suhu)?$tanda_vital->suhu:'' }}"
                                        aria-label="suhu">&deg;C</span>
                                <span>Berat Badan:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="berat_badan" id="prioritas1-berat_badan"
                                        value="{{ isset($tanda_vital->berat_badan)?$tanda_vital->berat_badan:'' }}"
                                        aria-label="berat_badan">kg</span>
                            </label>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">
                            <span class="mr-4 ml-3">GCS:<input class="input-dotted text-center ignore-check"
                                    style="width:100px" type="text" name="etc[gcs]" id="etc-gcs"
                                    value="{{ isset($data->etc['gcs'])?$data->etc['gcs']:'' }}" aria-label="gcs"></span>
                            <span class="mr-4">E:<input class="input-dotted text-center ignore-check"
                                    style="width:100px" type="text" name="etc[e]" id="etc-e"
                                    value="{{ isset($data->etc['e'])?$data->etc['e']:'' }}" aria-label="e"></span>
                            <span class="mr-4">V:<input class="input-dotted text-center ignore-check"
                                    style="width:100px" type="text" name="etc[v]" id="etc-v"
                                    value="{{ isset($data->etc['v'])?$data->etc['v']:'' }}" aria-label="v"></span>
                            <span>M:<input class="input-dotted text-center ignore-check" style="width:100px" type="text"
                                    name="etc[m]" id="etc-m" value="{{ isset($data->etc['m'])?$data->etc['m']:'' }}"
                                    aria-label="m"></span>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">2. Pasien memerlukan bantuan ventilasi</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static prioritas1-group" type="radio"
                                    data-group="prioritas" name="prioritas1[no2]" id="prioritas1-no2-1" value="1" {{
                                    isset($data->prioritas1['no2'])
                                &&
                                $data->prioritas1['no2'] == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
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
                        <td colspan="9">
                            <span class="mr-5 ml-3">Sebutkan:</span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no2checkbox][]" id="etc-maskernrm" value="maskernrm"
                                    aria-label="Masker NRM" {{ isset($data->etc['no2checkbox'])
                                &&
                                in_array('maskernrm',$data->etc['no2checkbox']) ? 'checked' : '' }} />
                                <label for="etc-maskernrm">Masker NRM </label>
                            </span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no2checkbox][]" id="etc-maskerrm" value="maskerrm" aria-label="Masker RM"
                                    {{ isset($data->etc['no2checkbox'])
                                &&
                                in_array('maskerrm',$data->etc['no2checkbox']) ? 'checked' : '' }} />
                                <label for="etc-maskerrm">Masker RM</label>

                            </span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no2checkbox][]" id="etc-jacsonrees" value="jacsonrees"
                                    aria-label="Jackson Rees" {{ isset($data->etc['no2checkbox'])
                                &&
                                in_array('jacsonrees',$data->etc['no2checkbox']) ? 'checked' : '' }} />
                                <label for="etc-jacsonrees">Jackson Rees</label>

                            </span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no2checkbox][]" id="etc-ventilator" value="ventilator"
                                    aria-label="Ventilator" {{ isset($data->etc['no2checkbox'])
                                &&
                                in_array('ventilator',$data->etc['no2checkbox']) ? 'checked' : '' }} />
                                <label for="etc-ventilator">Ventilator</label>
                            </span>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">3. Pasien memerlukan obat-obat vasioaktif</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static prioritas1-group" type="radio"
                                    data-group="prioritas" name="prioritas1[no3]" id="prioritas1-no3-1" value="1"
                                    aria-label="Pasien memerlukan obat-obat vasioaktif" {{
                                    isset($data->prioritas1['no3'])
                                &&
                                $data->prioritas1['no3'] == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
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
                        <td colspan="9">
                            <span class="mr-5 ml-3">Sebutkan:</span>
                            <span class="mr-5 ">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no3checkbox][]" id="etc-dopamin" value="dopamin" aria-label="Dopamin" {{
                                    isset($data->etc['no3checkbox'])
                                &&
                                in_array('dopamin',$data->etc['no3checkbox']) ? 'checked' : '' }} />
                                <label for="etc-dopamin">Dopamin</label>
                            </span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no3checkbox][]" id="etc-dobutamin" value="dobutamin"
                                    aria-label="Dobutamin" {{ isset($data->etc['no3checkbox'])
                                &&
                                in_array('dobutamin',$data->etc['no3checkbox']) ? 'checked' : '' }} />
                                <label for="etc-dopamin">Dobutamin</label>
                            </span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no3checkbox][]" id="etc-vascon" value="vascon" aria-label="Vascon" {{
                                    isset($data->etc['no3checkbox'])
                                &&
                                in_array('vascon',$data->etc['no3checkbox']) ? 'checked' : '' }} />
                                <label for="etc-dopamin">Vascon</label>
                            </span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no3checkbox][]" id="etc-adrenalin" value="adrenalin"
                                    aria-label="Adrenalin" {{ isset($data->etc['no3checkbox'])
                                &&
                                in_array('adrenalin',$data->etc['no3checkbox']) ? 'checked' : '' }} />
                                Adrenalin
                            </span>
                            <span class="mr-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etc[no3checkbox][]" id="etc-nicardipine" value="nicardipine"
                                    aria-label="Nicardipine" {{ isset($data->etc['no3checkbox'])
                                &&
                                in_array('nicardipine',$data->etc['no3checkbox']) ? 'checked' : '' }} />
                                <label for="etc-dopamin">Nicardipine</label>
                            </span>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>II</td>
                        <td colspan="9"> PRIORITAS II</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">Pasien yang memerlukan observasi ketat dan kondisinya sewaktu-waktu dapat
                            berubah.</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="prioritas2"
                                    id="prioritas2-1" value="1" aria-label="Pasien memerlukan observasi ketat" {{
                                    isset($data->prioritas2)
                                &&
                                $data->prioritas2 == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
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
                        <td>III</td>
                        <td colspan="9"> PRIORITAS III</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">Pasien dengan penyakit primer berat atau terminal dengan komplikasi penyakit
                            akut, kritis yang memerlukan pertolongan untuk penyakit kritisnya tetapi tidak sampai
                            intubasi dan RJP</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="prioritas3"
                                    id="prioritas3-1" value="1" aria-label="Pasien memerlukan observasi ketat" {{
                                    isset($data->prioritas3)
                                &&
                                $data->prioritas3 == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
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
                        <td>IV</td>
                        <td colspan="9"> PRIORITAS IV</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">A. Pasien Jantung <br>
                            <span class="ml-3">
                                Sebutkan diagnosanya
                            </span>
                            <span>
                                <input type="text" class="input-dotted w-50 ignore-check" id="etc[jantung-diagnosa]"
                                    name="etc[jantung-diagnosa]"
                                    value="{{ isset($data->etc['jantung-diagnosa']) ? $data->etc['jantung-diagnosa'] : '' }}">
                            </span>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="prioritas4[jantung]"
                                    id="prioritas4-jantung-1" value="1" {{ isset($data->prioritas4['jantung'])
                                &&
                                $data->prioritas4['jantung'] == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="prioritas4[jantung]"
                                    id="prioritas4-jantung-0" value="0" aria-label="Pasien memerlukan bantuan ventilasi"
                                    {{ isset($data->prioritas4['jantung'])
                                &&
                                $data->prioritas4['jantung'] == 0 ? 'checked' : '' }} />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">B. Pasien Paru <br>
                            <span class="ml-3">
                                Sebutkan diagnosanya
                            </span>
                            <span>
                                <input type="text" class="input-dotted w-50 ignore-check" id="etc[paru-diagnosa]"
                                    name="etc[paru-diagnosa]"
                                    value="{{ isset($data->etc['paru-diagnosa']) ? $data->etc['paru-diagnosa'] : '' }}">
                            </span>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="prioritas4[paru]"
                                    id="prioritas4-paru-1" value="1" {{ isset($data->prioritas4['paru'])
                                &&
                                $data->prioritas4['paru'] == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
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
                        <td colspan="9">C. Pasien Neurologi <br>
                            <span class="ml-3">
                                Sebutkan diagnosanya
                            </span>
                            <span>
                                <input type="text" class="input-dotted w-50 ignore-check" id="etc[neurologi-diagnosa]"
                                    name="etc[neurologi-diagnosa]"
                                    value="{{ isset($data->etc['neurologi-diagnosa']) ? $data->etc['neurologi-diagnosa'] : '' }}">
                            </span>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio"
                                    name="prioritas4[neurologi]" id="prioritas4-neurologi-1" value="1" {{
                                    isset($data->prioritas4['neurologi'])
                                &&
                                $data->prioritas4['neurologi'] == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio"
                                    name="prioritas4[neurologi]" id="prioritas4-neurologi-0" value="0"
                                    aria-label="Pasien memerlukan bantuan ventilasi" {{
                                    isset($data->prioritas4['neurologi'])
                                &&
                                $data->prioritas4['neurologi'] == 0 ? 'checked' : '' }} />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">D. Pasien Post Operasi Besar <br>
                            <span class="ml-3">
                                Sebutkan diagnosanya
                            </span>
                            <span>
                                <input type="text" class="input-dotted w-50 ignore-check" id="etc[postoperasi-diagnosa]"
                                    name="etc[postoperasi-diagnosa]"
                                    value="{{ isset($data->etc['postoperasi-diagnosa']) ? $data->etc['postoperasi-diagnosa'] : '' }}">
                            </span>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio"
                                    name="prioritas4[postoperasi]" id="prioritas4-postoperasi-1" value="1" {{
                                    isset($data->prioritas4['postoperasi'])
                                &&
                                $data->prioritas4['postoperasi'] == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio"
                                    name="prioritas4[postoperasi]" id="prioritas4-postoperasi-0" value="0"
                                    aria-label="Pasien memerlukan bantuan ventilasi" {{
                                    isset($data->prioritas4['postoperasi'])
                                &&
                                $data->prioritas4['postoperasi'] == 0 ? 'checked' : '' }} />
                            </div>
                        </td>
                    </tr>
                </table>
                <span class="ml-5">Berdasarkan kondisi diatas maka pasien tersebut memenuhi kriteria untuk masuk
                    ICU</span>
                <div class="w-100 justify-content-between d-flex">
                    <div style="margin-top: 50px; margin-left: 100px">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-outline-secondary">Simpan</button>
                        </div>
                    </div>

                    <div style="margin-right: 300px">
                        <b>DPJP/Konsultan ICU</b>
                        <div style="height: 128px;" class="d-flex align-items-center">
                            @if ($data && $data->status && $dokumen && $dokumen->status &&
                            $dokumen->id_verifikator)
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}"
                                style="height: 100%;object-fit: contain;" alt="">
                            @else
                            <div class="btn-group">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#passwordModal">Verifikasi</button>
                            </div>
                            @endif
                        </div>
                        <div>Nama: {{ $dokumen->nama_verifikator ?? '' }}</div>
                    </div>
                </div>

                <div class="modal fade" id="passwordModal" data-backdrop="static" tabindex="-1"
                    aria-labelledby="passwordModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Verifikasi Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="password" name="password" id="verify-password" class="form-control" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="button"
                                    class="btn btn-primary btn-submit-password btn-verify">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"
        integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $('select.form-control.select2').select2({
                width: '100%',
                placeholder: 'Pilih',
                theme: 'bootstrap',
            });

            $('.datepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                },
                singleDatePicker: true,
                timePicker: false,
            });

            $('.timepicker').daterangepicker({
                locale: {
                    format: 'HH:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            }).on('show.daterangepicker', function(ev, picker) {
                picker.container.find(".calendar-table").hide();
            });

            var validator = null;

            $('#passwordModal').on('show.bs.modal', function(e) {
                $('form input:not([id^="catatan-"]):not([type="radio"][id^="item-0-"]), form select, form textarea').prop('required', false);
                $('form input:hidden[name="action"]').val('Verifikasi');
                $('#passwordModal #verify-password').prop('required', true);
            });

            $('#passwordModal').on('hidden.bs.modal', function(e) {
                $('#verify-password').val(null).prop('required', false);
                $('form input:hidden[name="action"]').val('Simpan');
                $('form input, form select, form textarea').prop('required', false);
                if (validator != null) validator.destroy();
            });
            $('form .btn-verify').on('click', function(e) {
                e.preventDefault();
                validator = $('form').validate({
                    rules: {
                        "prioritas": {
                            require_from_group: [1, '.prioritas1-group']
                        }
                    },
                    groups: {
                        prioritas: "prioritas1[no1] prioritas1[no2] prioritas1[no3]"
                    },
                    debug: true,
                    ignore : ".ignore-check",
                    showErrors: function(errorMap, errorList) {
                        if (Array.isArray(errorList) && errorList.length > 0) {
                            console.log(errorList);
                            const el = $(errorList[0].element);
                            el.attr('data-toggle', 'tooltip');
                            el.attr('data-placement', 'top');
                            el.prop('title', String(el.prop('name')).includes('[]') ? 'Harus dipilih minimal satu.' : 'Harus diisi.');
                            el.focus();
                            el.tooltip('show');
                        }
                    }
                });

                if ($('form input:hidden[name="action"]').val() == 'Verifikasi' && $('form').valid()) {
                    validator.destroy();
                    $('form').submit();
                } else {
                    $('#passwordModal').modal('hide');
                }
            });

            $('form .btn-save').click(function(e) {
                $('form').trigger('submit');
            });
        });
    </script>
</body>

</html>