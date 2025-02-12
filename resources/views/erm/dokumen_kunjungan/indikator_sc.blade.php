<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>SMIS - Assesment Perioperatif Medis</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="atidaknymous" referrerpolicy="tidak-referrer" /> --}}
    <title>Indikator Proses SC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="atidaknymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="atidaknymous">
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="atidaknymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="atidaknymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="atidaknymous">
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }
    </style>
</head>

<body class="p-2">
@php
    /**
    * @param \App\Models\SmisDocIndikatorSc|null $data_sc ,
    * @param string $key,
    * @param mixed $value
    */
    function check_input($data_sc, string $key, $value) {
        return old($key, !empty($data_sc) ? $data_sc->$key : '') == $value;
    }
@endphp

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
@endif

@if(Session::has('gagal'))
    <div class="alert alert-danger">{{Session::get('gagal')}}</div>
@endif

@if(Session::has('sukses'))
    <div class="alert alert-success">{{Session::get('sukses')}}</div>
@endif

<div class="container-fluid">
    @include('components.header-erm-dok-kunjungan', ['pasien' => $pasien, 'dokumen' => $dokumen])

    <div class="row mt-3">
        <table style="width: 100%">
            <tr>
                <td style="width: 50%; vertical-align: text-top">
                    <p class="font-weight-bold">Indikator Proses SC</p>
                    <table class="table table-bordered custom-table">
                        <tbody style="width: 100%;">
                        <tr class="text-center">
                            <td class="font-weight-bold" style="min-width: 30px;">No.</td>
                            <td class="font-weight-bold">Indikator</td>
                            <td class="font-weight-bold" style="min-width: 50px;">Ya</td>
                            <td class="font-weight-bold" style="min-width: 50px;">Tidak</td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Pasien melakukan ANC minimal 3x di Rumah Sakit tersebut</td>
                            <td class="text-center">
                                <input value="ya" @if(check_input($indikator_sc, 'sc_satu', 'ya')) checked @endif type="radio"
                                       name="sc_radio_satu">
                            </td>
                            <td class="text-center">
                                <input value="tidak" @if(check_input($indikator_sc, 'sc_satu', 'tidak')) checked
                                       @endif type="radio" name="sc_radio_satu">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Pasien memiliki & membawa buku pink KIA sebelum SC</td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_dua"
                                       @if(check_input($indikator_sc, 'sc_dua', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_dua"
                                       @if(check_input($indikator_sc, 'sc_dua', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Pasien datang dengan KU baik sebelum tindakan SC</td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_tiga"
                                       @if(check_input($indikator_sc, 'sc_tiga','ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_tiga"
                                       @if(check_input($indikator_sc, 'sc_tiga','tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>Pasien datang dengan GCS normal (14-15) sebelum sc</td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_empat"
                                       @if(check_input($indikator_sc, 'sc_empat','ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_empat"
                                       @if(check_input($indikator_sc, 'sc_empat','tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>Pasien mengalami perubahan TD sistolik > 30 mmHg sebelum dan selesai SC disertai gejala syok
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_lima"
                                       @if(check_input($indikator_sc, 'sc_lima','ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_lima"
                                       @if(check_input($indikator_sc, 'sc_lima','tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>Pasien diperiksa darah lengkap sebelum SC (Hb, Leukosit, Tormbosit, Ht)</td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_enam"
                                       @if(check_input($indikator_sc, 'sc_enam','ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_enam"
                                       @if(check_input($indikator_sc, 'sc_enam','tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td>Pasien diperiksa darah lengkap setelah SC (Hb, Leukosit, Tormbosit, Ht)</td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_tujuh"
                                       @if(check_input($indikator_sc, 'sc_tujuh','ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_tujuh"
                                       @if(check_input($indikator_sc, 'sc_tujuh','tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td>Pasien yang diperiksa :
                                <ul>
                                    <li> PT/APTT atau</li>
                                    <li>CT/BT</li>
                                </ul>
                                sebelum dilakukan SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_delapan"
                                       @if(check_input($indikator_sc, 'sc_delapan','ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_delapan"
                                       @if(check_input($indikator_sc, 'sc_delapan','tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td>Pasien dilakukan transfusi darah sesuai indikasi dan/atau memiiliki Hb < 8 g/dL sebelum SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_sembilan"
                                       @if(check_input($indikator_sc, 'sc_sembilan','ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_sembilan"
                                       @if(check_input($indikator_sc, 'sc_sembilan','tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">10</td>
                            <td>Pasien diketahui golongan darah sebelum SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_sepuluh"
                                       @if(check_input($indikator_sc, 'sc_sepuluh', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_sepuluh"
                                       @if(check_input($indikator_sc, 'sc_sepuluh', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">11</td>
                            <td>Pasien diperiksa urinalisis sebelum tindakan SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_sebelas"
                                       @if(check_input($indikator_sc, 'sc_sebelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_sebelas"
                                       @if(check_input($indikator_sc, 'sc_sebelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">12</td>
                            <td>Pasien memiliki data USG sebelum SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_duabelas"
                                       @if(check_input($indikator_sc, 'sc_duabelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_duabelas"
                                       @if(check_input($indikator_sc, 'sc_duabelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">13</td>
                            <td>Pasien memiliki data laboratorium HIV sebelum SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_tigabelas"
                                       @if(check_input($indikator_sc, 'sc_tigabelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_tigabelas"
                                       @if(check_input($indikator_sc, 'sc_tigabelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">14</td>
                            <td>Pasien memiliki data laboratorium Hepatitis sebelum SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_empatbelas"
                                       @if(check_input($indikator_sc, 'sc_empatbelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_empatbelas"
                                       @if(check_input($indikator_sc, 'sc_empatbelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">15</td>
                            <td>
                                Assesmen persalinan pasien menggunakan patograf ditulis lengkap sebelum SC
                            </td>
                            <td class="text-center">
                                <input value="ya" type="radio" name="sc_radio_limabelas"
                                       @if(check_input($indikator_sc, 'sc_limabelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input value="tidak" type="radio" name="sc_radio_limabelas"
                                       @if(check_input($indikator_sc, 'sc_limabelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">16</td>
                            <td colspan="3">Diagnosis Kehamilan Pasien (pilih salah satu)</td>
                        </tr>
                        <tr>
                            <td class="text-center">a.</td>
                            <td colspan="2">Nullipara, janin tunggal, presentasi Kepala, usia kehamilan >= 37 minggu, lahir
                                spontan
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_a"
                                       @if(check_input($indikator_sc, 'sc_enambelas_a', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">b.</td>
                            <td colspan="2">Nullipara, janin tunggal, presentasi Kepala, usia kehamilan >= 37 minggu, lahir
                                dengan induksi
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_b"
                                       @if(check_input($indikator_sc, 'sc_enambelas_b', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">c.</td>
                            <td colspan="2">Multipara, tanpa riwayat perlukaan utarus, janin tunggal, presentasi Kepala, usia
                                kehamilan >= 37 minggu, lahir dengan spontan
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_c"
                                       @if(check_input($indikator_sc, 'sc_enambelas_c', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">d.</td>
                            <td colspan="2">Multipara, tanpa riwayat perlukaan utarus, janin tunggal, presentasi Kepala, usia
                                kehamilan >= 37 minggu, lahir dengan induksi atau SC
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_d"
                                       @if(check_input($indikator_sc, 'sc_enambelas_d', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">e.</td>
                            <td colspan="2">Multipara, memiliki riwayat perlukaan utarus, janin tunggal, presentasi Kepala, usia
                                kehamilan >= 37 minggu
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_e"
                                       @if(check_input($indikator_sc, 'sc_enambelas_e', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">f.</td>
                            <td colspan="2">Nullipara, janin tunggal, sungsang</td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_f"
                                       @if(check_input($indikator_sc, 'sc_enambelas_f', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">g.</td>
                            <td colspan="2">Multipara, janin tunggal, sungsang, memiliki riwayat perlukaan uterus</td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_g"
                                       @if(check_input($indikator_sc, 'sc_enambelas_g', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">h.</td>
                            <td colspan="2">Seluruh kehamilan dengan janin multipel, memiliki riwayat perlukaan uterus</td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_h"
                                       @if(check_input($indikator_sc, 'sc_enambelas_h', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">i.</td>
                            <td colspan="2">Seluruh kehamilan dengan janin tunggal, posisi janin oblik atau melintang, memiliki
                                riwayat perkukaan uterus
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_i"
                                       @if(check_input($indikator_sc, 'sc_enambelas_i', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">j.</td>
                            <td colspan="2">Seluruh kehamilan dengan janin tunggal, presentasi kepala, usia kehamilan <= 36
                                minggu, memiliki riwayat perlukaan uterus
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="sc_check_enambelas_j"
                                       @if(check_input($indikator_sc, 'sc_enambelas_j', true)) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="10" style="text-align: center;">17</td>
                            <td colspan="3">Pasien dilakukan SC dengan indikasi (pilih)</td>
                        </tr>
                        <tr>
                            <td colspan="2">(a) PEB</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox" name="sc_check_tujuhbelas_a"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_a', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">(b) Ketuban Pecah Dini</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox"
                                    name="sc_check_tujuhbelas_b"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_b', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">(c) Bekas Sectio</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox"
                                    name="sc_check_tujuhbelas_c"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_c', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">(d) Kelainan letak Janin</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox"
                                    name="sc_check_tujuhbelas_d"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_d', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">(e) Gagal Induksi</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox"
                                    name="sc_check_tujuhbelas_e"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_e', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">(f) Kelainan Letak Plasenta</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox"
                                    name="sc_check_tujuhbelas_f"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_f', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">(g) Persalinan TIdak Maju</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox"
                                    name="sc_check_tujuhbelas_g"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_g', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">(h) Disproporsi Kepala Panggul</td>
                            <td colspan="1" class="text-center">
                                <input
                                    type="checkbox"
                                    name="sc_check_tujuhbelas_h"
                                    @if(check_input($indikator_sc, 'sc_tujuhbelas_h', true)) checked @endif
                                >
                            </td>
                        </tr>
                        <tr style="width: 100%;" class="">
                            <td colspan="3" style="width: 100%;">
                                <div class="d-flex align-items-start justify-content-between pr-3">
                                    <span class="pr-3">(i) Lain-lain (sebutkan):</span>
                                    <textarea
                                        class="flex-grow-1" id="sc_text_tujuhbelas_i"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    >{{ $indikator_sc->sc_tujuhbelas_i ?? '' }}</textarea>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: text-top">
                    <p class="font-weight-bold">
                        Indikator Luaran (Per Rekam Medik)
                    </p>
                    <table class="table table-bordered custom-table">
                        <tbody>
                        <tr class="text-center">
                            <td class="font-weight-bold" style="min-width: 30px;">No.</td>
                            <td class="font-weight-bold">Indikator</td>
                            <td class="font-weight-bold" style="min-width: 50px;">Ya</td>
                            <td class="font-weight-bold" style="min-width: 50px;">Tidak</td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>KU Pasien baik setelah SC</td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_satu"
                                       @if(check_input($indikator_sc, 'luaran_satu', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_satu"
                                       @if(check_input($indikator_sc, 'luaran_satu', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Pasien meninggal (Ibu) pasca dilakukan tindakan SC</td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_dua"
                                       @if(check_input($indikator_sc, 'luaran_dua', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_dua"
                                       @if(check_input($indikator_sc, 'luaran_dua', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Pasien meninggal (Ibu) pasca dilakukan tindakan SC yang merupakan pasien rujukan</td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_tiga"
                                       @if(check_input($indikator_sc, 'luaran_tiga', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_tiga"
                                       @if(check_input($indikator_sc, 'luaran_tiga', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>Pasien mengalami komplikasi pasca tindakan SC (syok hipovolemik, syok lain, sepsis, gagal
                                ginjal, gagal jantung, ARDS, atau komplikasi lainnya
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_empat"
                                       @if(check_input($indikator_sc, 'luaran_empat', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_empat"
                                       @if(check_input($indikator_sc, 'luaran_empat', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>Pasien mengalami perluasan tindakan (ligasi, B-lynch, histerktomi, pembedahan lain akibat cedera
                                organ)
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_lima"
                                       @if(check_input($indikator_sc, 'luaran_lima', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_lima"
                                       @if(check_input($indikator_sc, 'luaran_lima', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>Pasien memerlukan perluasan pengobatan (transfusi darah, hemodialisis, heparin)</td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_enam"
                                       @if(check_input($indikator_sc, 'luaran_enam', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_enam"
                                       @if(check_input($indikator_sc, 'luaran_enam', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td>Pasien saat pulang membutuhkan perawatan lanjutan</td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_tujuh"
                                       @if(check_input($indikator_sc, 'luaran_tujuh', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_tujuh"
                                       @if(check_input($indikator_sc, 'luaran_tujuh', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td>Neonatus Pasien meninggal pasca dilakukan tindakan SC di Rumah Sakit setempat
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_delapan"
                                       @if(check_input($indikator_sc, 'luaran_delapan', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_delapan"
                                       @if(check_input($indikator_sc, 'luaran_delapan', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td>Neonatus Pasien meninggal pasca dilakukan tindakan SC di Rumah Sakit setempat yang Ibunya
                                merupakan pasien rujukan
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_sembilan"
                                       @if(check_input($indikator_sc, 'luaran_sembilan', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_sembilan"
                                       @if(check_input($indikator_sc, 'luaran_sembilan', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">10</td>
                            <td>Neonatus Pasien mengalami komplikasi pasca tindakan SC (RDS, Sepsis, HIE) di Rumah Sakit
                                setempat
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_sepuluh"
                                       @if(check_input($indikator_sc, 'luaran_sepuluh', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_sepuluh"
                                       @if(check_input($indikator_sc, 'luaran_sepuluh', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">11</td>
                            <td>Neonatus Pasien memerlukan perluasan pengobatan (CPAP, Ventilator, Transfusi) di Rumah Sakit
                                Setempat
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_sebelas"
                                       @if(check_input($indikator_sc, 'luaran_sebelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_sebelas"
                                       @if(check_input($indikator_sc, 'luaran_sebelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">12</td>
                            <td>Neonatus Pasien saat pulang membutuhkan perawatan lanjutan di Rumah Sakit Setempat
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_duabelas"
                                       @if(check_input($indikator_sc, 'luaran_duabelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_duabelas"
                                       @if(check_input($indikator_sc, 'luaran_duabelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">13</td>
                            <td>Tarif pembiayaan SC Rumah Sakit tidak melebihi tarif INACBGs
                            </td>
                            <td class="text-center">
                                <input type="radio" value="ya" name="luaran_radio_tigabelas"
                                       @if(check_input($indikator_sc, 'luaran_tigabelas', 'ya')) checked @endif>
                            </td>
                            <td class="text-center">
                                <input type="radio" value="tidak" name="luaran_radio_tigabelas"
                                       @if(check_input($indikator_sc, 'luaran_tigabelas', 'tidak')) checked @endif>
                            </td>
                        </tr>
                        </tbody>
                    </table>
        
                    <p class="font-weight-bold">PENGISI ASSESMEN DIRI</p>
        
                    <table class="table table-bordered custom-table">
                        <tbody>
                        <tr>
                            <td style="width: 30%;">Nama :</td>
                            <td style="width: 70%;">
                                <input
                                    type="text"
                                    name="nama_pasien"
                                    style="border: hidden; width: 100%"
                                    value="{{ $employee->nama ?? $dokumen->nama_verifikator }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Tanggal Pengisian :</td>
                            <td style="width: 70%;">
                                <input
                                    type="text"
                                    id="date_input"
                                    class="tanggal_dmy"
                                    style="border: hidden; width: 100%"
                                    value="{{ old('tanggal', empty($indikator_sc) ? \Carbon\Carbon::parse($dokumen->tanggal)->format('d-m-Y') : \Carbon\Carbon::parse($indikator_sc->tanggal)->format('d-m-Y'))  }}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center" style="height: 100px;">Dengan ini menyatakan bahwa data yang
                                <br/>diisi pada Assesmen Diri ini adalah benar.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Tanda Tangan Petugas:</td>
                            <td style="width: 70%; height: 100px;">
                                <button
                                    class="text-decoration-none bg-transparent" data-toggle="modal"
                                    data-target="#verif_modal" style="outline-width: 0; border: 0;"
                                >
                                    @if(!isset($dokumen->id_verifikator))
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    @else
                                        <figure class="w-100 d-flex flex-column align-items-center m-0">
                                            @if(isset($employee))
                                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                                    style="height: 4cm; width: 5cm;" alt="">
                                            @else
                                                <br>
                                                <br>
                                                Simpan dan Verifikasi
                                                <br>
                                                <br>
                                            @endif
                                        </figure>
                                    @endif
                                    ({{ !empty($employee) ? $employee->nama : '............................................' }})
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="modal fade" id="verif_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Verifikasi Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" onsubmit="submit_form()" id="verif_indikator_sc" action="{{ url('e_rekam_medis/detail/verif_indikator_sc') }}">
                @csrf
                <input type="hidden" name="dokumen" value="{{$dokumen->id}}"/>
                <input type="hidden" name="tanggal" id="tanggal"/>
                <input type="hidden" name="sc_satu" id="sc_satu"/>
                <input type="hidden" name="sc_dua" id="sc_dua"/>
                <input type="hidden" name="sc_tiga" id="sc_tiga"/>
                <input type="hidden" name="sc_empat" id="sc_empat"/>
                <input type="hidden" name="sc_lima" id="sc_lima"/>
                <input type="hidden" name="sc_enam" id="sc_enam"/>
                <input type="hidden" name="sc_tujuh" id="sc_tujuh"/>
                <input type="hidden" name="sc_delapan" id="sc_delapan"/>
                <input type="hidden" name="sc_sembilan" id="sc_sembilan"/>
                <input type="hidden" name="sc_sepuluh" id="sc_sepuluh"/>
                <input type="hidden" name="sc_sebelas" id="sc_sebelas"/>
                <input type="hidden" name="sc_duabelas" id="sc_duabelas"/>
                <input type="hidden" name="sc_tigabelas" id="sc_tigabelas"/>
                <input type="hidden" name="sc_empatbelas" id="sc_empatbelas"/>
                <input type="hidden" name="sc_limabelas" id="sc_limabelas"/>
                <input type="hidden" name="sc_enambelas_a" id="sc_enambelas_a"/>
                <input type="hidden" name="sc_enambelas_b" id="sc_enambelas_b"/>
                <input type="hidden" name="sc_enambelas_c" id="sc_enambelas_c"/>
                <input type="hidden" name="sc_enambelas_d" id="sc_enambelas_d"/>
                <input type="hidden" name="sc_enambelas_e" id="sc_enambelas_e"/>
                <input type="hidden" name="sc_enambelas_f" id="sc_enambelas_f"/>
                <input type="hidden" name="sc_enambelas_g" id="sc_enambelas_g"/>
                <input type="hidden" name="sc_enambelas_h" id="sc_enambelas_h"/>
                <input type="hidden" name="sc_enambelas_i" id="sc_enambelas_i"/>
                <input type="hidden" name="sc_enambelas_j" id="sc_enambelas_j"/>
                <input type="hidden" name="sc_tujuhbelas_a" id="sc_tujuhbelas_a"/>
                <input type="hidden" name="sc_tujuhbelas_b" id="sc_tujuhbelas_b"/>
                <input type="hidden" name="sc_tujuhbelas_c" id="sc_tujuhbelas_c"/>
                <input type="hidden" name="sc_tujuhbelas_d" id="sc_tujuhbelas_d"/>
                <input type="hidden" name="sc_tujuhbelas_e" id="sc_tujuhbelas_e"/>
                <input type="hidden" name="sc_tujuhbelas_f" id="sc_tujuhbelas_f"/>
                <input type="hidden" name="sc_tujuhbelas_g" id="sc_tujuhbelas_g"/>
                <input type="hidden" name="sc_tujuhbelas_h" id="sc_tujuhbelas_h"/>
                <textarea hidden name="sc_tujuhbelas_i" id="sc_tujuhbelas_i"></textarea>
                <input type="hidden" name="luaran_satu" id="luaran_satu"/>
                <input type="hidden" name="luaran_dua" id="luaran_dua"/>
                <input type="hidden" name="luaran_tiga" id="luaran_tiga"/>
                <input type="hidden" name="luaran_empat" id="luaran_empat"/>
                <input type="hidden" name="luaran_lima" id="luaran_lima"/>
                <input type="hidden" name="luaran_enam" id="luaran_enam"/>
                <input type="hidden" name="luaran_tujuh" id="luaran_tujuh"/>
                <input type="hidden" name="luaran_delapan" id="luaran_delapan"/>
                <input type="hidden" name="luaran_sembilan" id="luaran_sembilan"/>
                <input type="hidden" name="luaran_sepuluh" id="luaran_sepuluh"/>
                <input type="hidden" name="luaran_sebelas" id="luaran_sebelas"/>
                <input type="hidden" name="luaran_duabelas" id="luaran_duabelas"/>
                <input type="hidden" name="luaran_tigabelas" id="luaran_tigabelas"/>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password :</label>
                        <input type="password" name="pass" placeholder="Input your password" class="form-control"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('.tanggal_dmy').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
    });
    
    $('.tanggal_dmy').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        setUmur();
    });

    $('.tanggal_dmy').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    function submit_form() {
        var tgl = $('#date_input').val();
        $('#tanggal').val(tgl.split('-').reverse().join('-'));
        $('textarea#sc_tujuhbelas_i').val($('textarea#sc_text_tujuhbelas_i').val())

        $('input[type="radio"]:checked').each(function () {
            const e = $(this)
            const id = e.attr('name').replace('_radio_', '_')

            $('input#' + id).val(e.val())
        })

        $('input[type="checkbox"]').each(function () {
            const e = $(this)
            const id = e.attr('name').replace('_check_', '_')

            $('input#' + id).val(e.is(':checked') ? '1' : '0')
        })
    }
</script>
</html>
