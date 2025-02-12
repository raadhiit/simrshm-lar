<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rencana Keperawatan Post Operasi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <style>
        .form-dotted {
            outline: none;
            border: none;
            border-bottom: 2px dotted;
            margin-left: 5px;
        }

        .logo-rshm {
            width: 200px;
            height: 140px;
        }

        .table {
            overflow-x: scroll;
            white-space: nowrap;
        }

        th {
            white-space: nowrap;

        }

        input[type=checkbox] {
            margin-right: 4px;
        }

        @media only screen and (min-width: 500px) {
            .logo-rshm {
                object-fit: contain;
            }
        }

        @media print {
            @page {
                size: Legal landscape;
                margin: 0;
            }

            body {
                zoom: 60%;
                -webkit-print-color-adjust: exact;
            }

            #main_table tr td{
                border: 1px solid #111 !important;
            }

            #main_table tr th{
                border: 1px solid #111 !important;
            }

            .hidden-on-print{
                display: none;
            }

            #tabel_assessment tr td {
                border: 1px solid transparent !important;
                line-height: 1.15;
                padding-top: 5px;
                padding-bottom: 5px;
            }

            .col-lg-1 {
                width: 8%;
                float: left;
            }

            .col-lg-2 {
                width: 16%;
                float: left;
            }

            .col-lg-3 {
                width: 25%;
                float: left;
            }

            .col-lg-4 {
                width: 33%;
                float: left;
            }

            .col-lg-5 {
                width: 42%;
                float: left;
            }

            .col-lg-6 {
                width: 50%;
                float: left;
            }

            .col-lg-7 {
                width: 58%;
                float: left;
            }

            .col-lg-8 {
                width: 66%;
                float: left;
            }

            .col-lg-9 {
                width: 75%;
                float: left;
            }

            .col-lg-10 {
                width: 83%;
                float: left;
            }

            .col-lg-11 {
                width: 92%;
                float: left;
            }

            .col-lg-12 {
                width: 100%;
                float: left;
            }
        }
    </style>
</head>

<body class="px-2 w-full">
    <?php
    $assessment = $data ? json_decode($data->assessment) : null;
    $diagnosa_keperawatan = $data ? json_decode($data->diagnosa_keperawatan) : null;
    $rencana_keperawatan = $data ? json_decode($data->rencana_keperawatan) : null;
    $implementasi = $data ? json_decode($data->implementasi) : null;
    $evaluasi = $data ? json_decode($data->evaluasi) : null;
    ?>

    <form id="form_dokumen">
        @csrf
        <input type="hidden" name="assessment">
        <input type="hidden" name="diagnosa_keperawatan">
        <input type="hidden" name="rencana_keperawatan">
        <input type="hidden" name="implementasi">
        <input type="hidden" name="evaluasi">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
            <div class="col-lg-6" style="border: 1px solid;">
                <div class="row align-items-center justify-content-center" style="width: 100%;">
                    <div class="col-lg-4">
                        <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" class="logo-rshm">
                    </div>
                    <div class="col-lg-8>
                    <p style=" font-weight: bold; font-size:18px; text-align:
                        left">
                        RUMAH SAKIT HARAPAN MULIA
                        </p>
                        <p
                            style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
                            <span style="font-weight: normal">
                                Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                                <br>Kabupaten Bekasi Jawa Barat (17340).
                                <br>Telp.: (021) 8995 2340
                                <br>Email : info@rumahsakit-harapanmulia.id
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="border:1px solid; padding:10px;">
                <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px;">
                    <tr>
                        <td style="width: 40%;">Nama</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ $pasien->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">No Rekam Medis</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ $pasien->id }}</td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Tgl Lahir</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Jenis Kelamin</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">NIK</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ $pasien->ktp }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Body --}}
        <div style="margin-top: -17px">
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
                    <h6 style="color: white">RENCANA KEPERAWATAN POST - OPERASI</h6>
                </div>
            </div>
        </div>
        {{-- Input User --}}
        <div class="table-responsive">
            <table class="table table-bordered" id="main_table">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">ASSESSMENT</th>
                        <th rowspan="2">DIAGNOSA KEPERAWATAN</th>
                        <th rowspan="2">RENCANA KEPERAWATAN</th>
                        <th colspan="2">ASSESMENT KEPERAWATAN</th>
                    </tr>
                    <tr class="text-center">
                        <th>IMPLEMENTASI</th>
                        <th>EVALUASI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h6 class="mt-4">Keluhan Nyeri</h6>
                            <div class="ml-4">
                                <input type="radio" {{ $assessment ? $assessment->keluhan_nyeri == 'Ya' ? 'checked' : '' : '' }} name="keluhan_nyeri" id="" value="Ya"> Ya
                                <input type="radio" {{ $assessment ? $assessment->keluhan_nyeri == 'Tidak' ? 'checked' : '' : '' }} class="ml-2" name="keluhan_nyeri" id="" value="Tidak"> Tidak <br>
                                <input type="radio" {{ $assessment ? $assessment->keluhan_nyeri == 'Tidak bisa dikaji' ? 'checked' : '' : '' }} name="keluhan_nyeri" id="" value="Tidak bisa dikaji"> Tidak bisa dikaji <br>
                            </div>
                            Skala nyeri (0-10): <input type="text" class="form-dotted mt" style="width: 100px" id="skala_nyeri" value="{{ $assessment ? $assessment->skala_nyeri : '' }}">
                        </td>

                        {{-- Section Diagnosa --}}
                        <td rowspan="3" class="">
                            {{-- Diagnosa 1 --}}
                            <div>
                                <strong>dx. No.</strong>
                                <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[0]->dx_no : '' }}" id="diagnosa_1_dx_no">
                            </div>
                            <h6 class="mt-2" class="text-wrap">Gangguan Jalan Napas: Pola Napas <br> Pertukaran Gas b.d
                            </h6>

                            <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Penumpukan Sekret', $diagnosa_keperawatan[0]->value) ? 'checked' : '' : '' }} id="diagnosa_1_penumpukan_sekret" value="Penumpukan Sekret"> Penumpukan Sekret
                            <br>
                            <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[0]->value) ? 'checked' : '' : '' }} id="diagnosa_1_lain" value="Lain">
                            <input type="text" class="form-dotted" id="isian_diagnosa_1_lain" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[0]->isian : '' }}">

                            {{-- Diagnosa 2 --}}
                            <div class="mt-4">
                                <div>
                                    <strong>dx. No.</strong>
                                    <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[1]->dx_no : '' }}" id="diagnosa_2_dx_no">
                                </div>
                                <h6 class="mt-2" class="text-wrap">Resiko Kekurangan Volume Cairan <br> Tubuh
                                    b.d
                                </h6>

                                <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Pendarahan', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} id="diagnosa_2_pendarahan" value="Pendarahan"> Perdarahan<br>
                                <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} id="diagnosa_2_lain" value="Lain">
                                <input type="text" class="form-dotted" id="isian_diagnosa_2_lain" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[1]->isian : '' }}">
                            </div>

                            {{-- Diagnosa 3 --}}
                            <div class="mt-4">
                                <div>
                                    <strong>dx. No.</strong>
                                    <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[2]->dx_no : '' }}" id="diagnosa_3_dx_no">
                                </div>
                                <h6 class="mt-2" class="text-wrap">Gangguan Rasa Nyaman Nyeri b.d
                                    b.d
                                </h6>

                                <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Pasca Operasi', $diagnosa_keperawatan[2]->value) ? 'checked' : '' : '' }} id="diagnosa_3_pasca_operasi" value="Pasca Operasi"> Pasca Operasi<br>
                                <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[2]->value) ? 'checked' : '' : '' }} id="diagnosa_3_lain" value="Lain">
                                <input type="text" class="form-dotted" id="isian_diagnosa_3_lain" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[2]->isian : '' }}">
                            </div>

                            {{-- Diagnosa 4 --}}
                            <div class="mt-4">
                                <div>
                                    <strong>dx. No.</strong>
                                    <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[3]->dx_no : '' }}" id="diagnosa_4_dx_no">
                                </div>
                                <h6 class="mt-2" class="text-wrap">Hipotermi b.d
                                    b.d
                                </h6>

                                <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Proses Anestesi', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} id="diagnosa_4_proses_anestesi" value="Proses Anestesi"> Proses Anestesi<br>
                                <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Lingkungan', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} id="diagnosa_4_lingkungan" value="Lingkungan"> Lingkungan<br>
                                <input type="checkbox" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} id="diagnosa_4_lain" value="Lain">
                                <input type="text" class="form-dotted" id="isian_diagnosa_4_lain" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[3]->isian : '' }}">
                            </div>

                            {{-- Diagnosa 5 --}}
                            <div>
                                <strong>dx. No.</strong>
                                <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[4]->dx_no : '' }}" id="diagnosa_5_dx_no">
                            </div>

                        </td>

                        {{-- Section Rencana --}}
                        <td rowspan="3" class="text-wrap">
                            {{-- Rencana 1 --}}
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->rencana_keperawatan_1_monitor_vital_sign ? 'checked' : '' : '' }} id="rencana_keperawatan_1_monitor_vital_sign">Monitor Vital Sign
                            <br>
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->monitor_kepatenan_jalan_napas ? 'checked' : '' : '' }} id="monitor_kepatenan_jalan_napas">Monitor Kepatenan Jalan Napas
                            <br>
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->berikan_posisi_nyaman_pada_pasien ? 'checked' : '' : '' }} id="berikan_posisi_nyaman_pada_pasien">Berikan Posisi Nyaman Pada Pasien
                            <br>
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pasang_guedel_sesuai_indikasi ? 'checked' : '' : '' }} id="pasang_guedel_sesuai_indikasi">Pasang Guedel Sesuai Indikasi
                            <br>
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->berikan_o2 ? 'checked' : '' : '' }} id="berikan_o2">Berikan O2
                            <input type="text" class="form-dotted" style="width: 20%" value="{{ $rencana_keperawatan ? $rencana_keperawatan->isian_berikan_o2 : '' }}" id="isian_rencana_keperawatan_berikan_o2"> L/m Sesuai Instruksi

                            {{-- Rencana 2 --}}
                            <div class="mt-4">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->rencana_keperawatan_2_monitor_vital_sign ? 'checked' : '' : '' }} id="rencana_keperawatan_2_monitor_vital_sign">Monitor Vital Sign
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->kaji_tanda_tanda_dehidrasi ? 'checked' : '' : '' }} id="kaji_tanda_tanda_dehidrasi">Kaji Tanda - tanda dehidrasi
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->monitor_tanda_syok ? 'checked' : '' : '' }} id="monitor_tanda_syok">Monitor Tanda Syok
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->balance_cairan ? 'checked' : '' : '' }} id="balance_cairan">Balance Cairan
                                <br>
                            </div>

                            {{-- Rencana 3 --}}
                            <div class="text-wrap mt-4">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->kaji_lokasi_nyeri ? 'checked' : '' : '' }} id="kaji_lokasi_nyeri">Kaji Lokasi Nyeri, Karakteristik dan Lokasi Nyeri
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->lakukan_dan_ajarkan_manaheman_nyeri ? 'checked' : '' : '' }} id="lakukan_dan_ajarkan_manaheman_nyeri">Lakukan dan Ajarkan Manaheman Nyeri, dan <br> Tarik Napas Dalam
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->evaluasi_skala_nyeri ? 'checked' : '' : '' }} id="evaluasi_skala_nyeri">Evaluasi Skala Nyeri Setelah diberi Intervensi
                            </div>

                            {{-- Rencana 4 --}}
                            <div class="mt-4">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->monitor_suhu_tubuh ? 'checked' : '' : '' }} id="monitor_suhu_tubuh">Monitor Suhu Tubuh
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->berikan_selimut_tebal ? 'checked' : '' : '' }} id="berikan_selimut_tebal">Berikan Selimut Tebal
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pasang_pemanas ? 'checked' : '' : '' }} id="pasang_pemanas">Pasang Pemanas
                                <br>
                                <input type="checkbox" id="rencana_keperawatan_lain_1" {{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[0]->checked ? 'checked' : '' : '' }}>
                                <input type="text" class="form-dotted" value="{{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[0]->isian : '' }}" id="isian_rencana_keperawatan_lain_1">
                            </div>

                            {{-- Rencana 5 --}}
                            <div class="mt-4">
                                <input type="checkbox" id="rencana_keperawatan_lain_2" {{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[1]->checked ? 'checked' : '' : '' }}>
                                <input type="text" class="form-dotted" value="{{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[1]->isian : '' }}" id="isian_rencana_keperawatan_lain_2">
                            </div>

                        </td>
                        {{-- End Section Rencana --}}

                        {{-- Section Implementasi --}}
                        <td rowspan="3">
                            {{-- Implementasi 1 --}}
                            <div>
                                <input type="checkbox" {{ $implementasi ? $implementasi->implementasi_1_memonitor_vital_sign ? 'checked' : '' : '' }} id="implementasi_1_memonitor_vital_sign">Memonitor Vital Sign
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memonitor_kepatenan_jalan_napas ? 'checked' : '' : '' }} id="memonitor_kepatenan_jalan_napas">Memonitor Kepatenan Jalan Napas
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memberikan_posisi_nyaman_pada_pasien ? 'checked' : '' : '' }} id="memberikan_posisi_nyaman_pada_pasien">Memberikan Posisi Nyaman Pada Pasien
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memasang_guedel_sesuai_indikasi ? 'checked' : '' : '' }} id="memasang_guedel_sesuai_indikasi">Memasang Guedel Sesuai Indikasi
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memberikan_o2 ? 'checked' : '' : '' }} id="memberikan_o2">Memberikan O2
                                <input type="text" class="form-dotted" value="{{ $implementasi ? $implementasi->isian_berikan_o2 : '' }}" style="width: 20%" id="isian_implementasi_berikan_o2"> L/m Sesuai
                                Instruksi
                            </div>

                            {{-- Implementasi 2 --}}
                            <div class="mt-4">
                                <input type="checkbox" {{ $implementasi ? $implementasi->implementasi_2_memonitor_vital_sign ? 'checked' : '' : '' }} id="implementasi_2_memonitor_vital_sign">Memonitor Vital Sign
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengkaji_tanda_tanda_dehidrasi ? 'checked' : '' : '' }} id="mengkaji_tanda_tanda_dehidrasi">Mengkaji Tanda - tanda dehidrasi
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memonitor_tanda_syok ? 'checked' : '' : '' }} id="memonitor_tanda_syok">Memonitor Tanda Syok
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->menghitung_balance_cairan ? 'checked' : '' : '' }} id="menghitung_balance_cairan">Menghitung Balance Cairan
                                <br>
                            </div>

                            {{-- Implementasi 3 --}}
                            <div class="text-wrap mt-4">
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengkaji_lokasi_nyeri ? 'checked' : '' : '' }} id="mengkaji_lokasi_nyeri">Mengkaji Lokasi Nyeri, Karakteristik dan Lokasi Nyeri
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->melakukan_dan_ajarkan_manaheman_nyeri ? 'checked' : '' : '' }} id="melakukan_dan_ajarkan_manaheman_nyeri">Melakukan dan Ajarkan Manaheman Nyeri, dan <br> Tarik Napas Dalam
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengevaluasi_skala_nyeri ? 'checked' : '' : '' }} id="mengevaluasi_skala_nyeri">Mengevaluasi Skala Nyeri Setelah diberi Intervensi
                            </div>

                            {{-- Implementasi 4 --}}
                            <div class="mt-4">
                                <input type="checkbox" {{ $implementasi ? $implementasi->memonitor_suhu_tubuh ? 'checked' : '' : '' }} id="memonitor_suhu_tubuh">Memonitor Suhu Tubuh
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memberikan_selimut_tebal ? 'checked' : '' : '' }} id="memberikan_selimut_tebal">Memberikan Selimut Tebal
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memasang_pemanas ? 'checked' : '' : '' }} id="memasang_pemanas">Memasang Pemanas
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->lainnya[0]->checked ? 'checked' : '' : '' }} id="implementasi_lain_1">
                                <input type="text" value="{{ $implementasi ? $implementasi->lainnya[0]->isian : '' }}" class="form-dotted" id="isian_implementasi_lain_1">
                            </div>

                            {{-- Implementasi 5 --}}
                            <div class="mt-4">
                                <input type="checkbox" {{ $implementasi ? $implementasi->lainnya[1]->checked ? 'checked' : '' : '' }} id="implementasi_lain_2">
                                <input type="text" value="{{ $implementasi ? $implementasi->lainnya[1]->isian : '' }}" class="form-dotted" id="isian_implementasi_lain_2">
                            </div>
                        </td>
                        {{-- End Section Implementasi --}}

                        {{-- Section Evaluasi --}}
                        <td rowspan="3">
                            {{-- Evaluasi 1 --}}
                            <div>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[0]->vital_sign_dalam_batas_normal ? 'checked' : '' : '' }} id="evaluasi_1_vital_sign_dalam_batas_normal">Vital Sign Dalam Batas Normal
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[0]->lainnya->checked ? 'checked' : '' : '' }} id="evaluasi_1_lain">
                                <input type="text" value="{{ $evaluasi ? $evaluasi[0]->lainnya->isian : '' }}" class="form-dotted" id="isian_evaluasi_1_lain">
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_1"> Masalah Teratasi:
                                <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_1" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_1" value="Tidak"> Tidak
                            </div>

                            {{-- Evaluasi 2 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->tidak_ada_tanda_syok ? 'checked' : '' : '' }} id="tidak_ada_tanda_syok">Tidak Ada Tanda Syok
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->vital_sign_dalam_batas_normal ? 'checked' : '' : '' }} id="evaluasi_2_vital_sign_dalam_batas_normal">Vital Sign Dalam Batas Normal
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->lainnya->checked ? 'checked' : '' : '' }} id="evaluasi_2_lain">
                                <input type="text" value="{{ $evaluasi ? $evaluasi[1]->lainnya->isian : '' }}" class="form-dotted" id="isian_evaluasi_2_lain">
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_2"> Masalah Teratasi:
                                <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_2" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_2" value="Tidak"> Tidak
                            </div>

                            {{-- Evaluasi 3 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->vital_sign_dalam_batas_normal ? 'checked' : '' : '' }} id="evaluasi_3_vital_sign_dalam_batas_normal">Vital Sign Dalam Batas Normal
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->tidak_ada_tanda_dehidrasi ? 'checked' : '' : '' }} id="tidak_ada_tanda_dehidrasi">Tidak Ada Tanda dehidrasi
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->intake_output ? 'checked' : '' : '' }} id="intake_output">Intake Output 24 Jam seimbang
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->lainnya->checked ? 'checked' : '' : '' }} id="evaluasi_3_lain">
                                <input type="text" value="{{ $evaluasi ? $evaluasi[2]->lainnya->isian : '' }}" class="form-dotted" id="isian_evaluasi_3_lain">
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_3"> Masalah Teratasi:
                                <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_3" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_3" value="Tidak"> Tidak
                            </div>

                            {{-- Evaluasi 4 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->suhu_normal ? 'checked' : '' : '' }} id="suhu_normal">Suhu Normal
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->lainnya->checked ? 'checked' : '' : '' }} id="evaluasi_4_lain">
                                <input type="text" value="{{ $evaluasi ? $evaluasi[3]->lainnya->isian : '' }}" class="form-dotted" id="isian_evaluasi_4_lain">
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_4"> Masalah Teratasi:
                                <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_4" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_4" value="Tidak"> Tidak
                            </div>

                            {{-- Evaluasi 5 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[4]->lainnya->checked ? 'checked' : '' : '' }} id="evaluasi_5_lain">
                                <input type="text" value="{{ $evaluasi ? $evaluasi[4]->lainnya->isian : '' }}" class="form-dotted" id="isian_evaluasi_5_lain">
                                <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_5"> Masalah Teratasi:
                                <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_5" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_5" value="Tidak"> Tidak
                            </div>
                        </td>
                        {{-- End Section Evaluasi --}}

                    </tr>

                    {{-- End Assesment Section 1 --}}
                    <tr>
                        <td>
                            <h6 class="mt-4">Kondisi Kulit</h6>
                            <div class="ml-4">

                                <input type="checkbox" {{ $assessment ? in_array('Dingin', $assessment->kondisi_kulit) ? 'checked' : '' : '' }} id="kondisi_kulit_dingin" value="Dingin"> Dingin
                                <input type="checkbox" {{ $assessment ? in_array('Hangat', $assessment->kondisi_kulit) ? 'checked' : '' : '' }} id="kondisi_kulit_hangat" value="Hangat" class="ml-2"> Hangat
                                <br>
                                <input type="checkbox" {{ $assessment ? in_array('Kering', $assessment->kondisi_kulit) ? 'checked' : '' : '' }} id="kondisi_kulit_kering" value="Kering"> Kering
                                <input type="checkbox" {{ $assessment ? in_array('Lembab Utuh', $assessment->kondisi_kulit) ? 'checked' : '' : '' }} id="kondisi_kulit_lembab_utuh" value="Lembab Utuh" class="ml-3">Lembab Utuh
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="4">
                            <div class="row align-items-center">
                                <h6 for="" class="col-sm-2 col-form-label">TTV</h6>
                                <span class="col-sm-2">:</span>
                            </div>
                            <div class="row align-items-center">
                                <label for="" class="col-sm-2 col-form-label">TD</label>
                                <span class="col-sm-1">:</span>
                                <div class="col-sm-8">
                                    <input type="text" class="form-dotted" style="width: 60%" value="{{ $assessment ? $assessment->td : '' }}" id="ttv_td"> mg/dl
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <label for="" class="col-sm-2 col-form-label">N</label>
                                <span class="col-sm-1">:</span>
                                <div class="col-sm-8">
                                    <input type="text" class="form-dotted" style="width: 60%" value="{{ $assessment ? $assessment->n : '' }}" id="ttv_n"> X/m
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <label for="" class="col-sm-2 col-form-label">Sp. O2</label>
                                <span class="col-sm-1">:</span>
                                <div class="col-sm-8">
                                    <input type="text" class="form-dotted" style="width: 60%" value="{{ $assessment ? $assessment->spo2 : '' }}" id="ttv_spo2"> %
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Button Submit dan Download --}}
        <div class="row mt-2" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success hidden-on-print">Simpan</button>
            </div>
        </div>
        <!-- <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
            <div style="text-align: center;" class="col-md-12">
                @if ($dokumen->id_verifikator != 0)
                <a href="{{ url('e_rekam_medis/detail/pdf_dokumen_laporan_caesarian?dokumen=' . $dokumen->id) }}"
                    class="btn btn-success" target="_blank">Download PDF</a>
                @endif
            </div>
        </div> -->
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
    $('#form_dokumen').submit(function(e) {
        e.preventDefault();

        let kondisi_kulit = [];

        if ($('#kondisi_kulit_dingin').is(':checked')) {
            kondisi_kulit.push($('#kondisi_kulit_dingin').val());
        }

        if ($('#kondisi_kulit_hangat').is(':checked')) {
            kondisi_kulit.push($('#kondisi_kulit_hangat').val());
        }

        if ($('#kondisi_kulit_kering').is(':checked')) {
            kondisi_kulit.push($('#kondisi_kulit_kering').val());
        }

        if ($('#kondisi_kulit_lembab_utuh').is(':checked')) {
            kondisi_kulit.push($('#kondisi_kulit_lembab_utuh').val());
        }

        let assessment = {
            'keluhan_nyeri': $('[name=keluhan_nyeri]:checked').val() != undefined ? $('[name=keluhan_nyeri]:checked').val() : '',
            'skala_nyeri': $('#skala_nyeri').val(),
            'kondisi_kulit': kondisi_kulit,
            'td': $('#ttv_td').val(),
            'n': $('#ttv_n').val(),
            'spo2': $('#ttv_spo2').val(),
        }

        let diagnosa_keperawatan = [null, null, null, null, null];

        let diagnosa_0 = [];

        if ($('#diagnosa_1_penumpukan_sekret').is(':checked')) {
            diagnosa_0.push($('#diagnosa_1_penumpukan_sekret').val());
        }

        if ($('#diagnosa_1_lain').is(':checked')) {
            diagnosa_0.push($('#diagnosa_1_lain').val());
        }

        let diagnosa_1 = [];

        if ($('#diagnosa_2_pendarahan').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_pendarahan').val());
        }

        if ($('#diagnosa_2_lain').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_lain').val());
        }

        let diagnosa_2 = [];

        if ($('#diagnosa_3_pasca_operasi').is(':checked')) {
            diagnosa_2.push($('#diagnosa_3_pasca_operasi').val());
        }

        if ($('#diagnosa_3_lain').is(':checked')) {
            diagnosa_2.push($('#diagnosa_3_lain').val());
        }

        let diagnosa_3 = [];

        if ($('#diagnosa_4_proses_anestesi').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_proses_anestesi').val());
        }

        if ($('#diagnosa_4_lingkungan').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_lingkungan').val());
        }

        if ($('#diagnosa_4_lain').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_lain').val());
        }

        diagnosa_keperawatan[0] = {
            'dx_no': $('#diagnosa_1_dx_no').val(),
            'value': diagnosa_0,
            'isian': $('#isian_diagnosa_1_lain').val()
        };

        diagnosa_keperawatan[1] = {
            'dx_no': $('#diagnosa_2_dx_no').val(),
            'value': diagnosa_1,
            'isian': $('#isian_diagnosa_2_lain').val()
        };

        diagnosa_keperawatan[2] = {
            'dx_no': $('#diagnosa_3_dx_no').val(),
            'value': diagnosa_2,
            'isian': $('#isian_diagnosa_3_lain').val()
        };

        diagnosa_keperawatan[3] = {
            'dx_no': $('#diagnosa_4_dx_no').val(),
            'value': diagnosa_3,
            'isian': $('#isian_diagnosa_4_lain').val()
        };

        diagnosa_keperawatan[4] = {
            'dx_no': $('#diagnosa_5_dx_no').val()
        }

        let rencana_keperawatan = {
            'rencana_keperawatan_1_monitor_vital_sign': $('#rencana_keperawatan_1_monitor_vital_sign').is(':checked') ? 1 : 0,
            'monitor_kepatenan_jalan_napas': $('#monitor_kepatenan_jalan_napas').is(':checked') ? 1 : 0,
            'berikan_posisi_nyaman_pada_pasien': $('#berikan_posisi_nyaman_pada_pasien').is(':checked') ? 1 : 0,
            'pasang_guedel_sesuai_indikasi': $('#pasang_guedel_sesuai_indikasi').is(':checked') ? 1 : 0,
            'berikan_o2': $('#berikan_o2').is(':checked') ? 1 : 0,
            'rencana_keperawatan_2_monitor_vital_sign': $('#rencana_keperawatan_2_monitor_vital_sign').is(':checked') ? 1 : 0,
            'kaji_tanda_tanda_dehidrasi': $('#kaji_tanda_tanda_dehidrasi').is(':checked') ? 1 : 0,
            'monitor_tanda_syok': $('#monitor_tanda_syok').is(':checked') ? 1 : 0,
            'balance_cairan': $('#balance_cairan').is(':checked') ? 1 : 0,
            'kaji_lokasi_nyeri': $('#kaji_lokasi_nyeri').is(':checked') ? 1 : 0,
            'lakukan_dan_ajarkan_manaheman_nyeri': $('#lakukan_dan_ajarkan_manaheman_nyeri').is(':checked') ? 1 : 0,
            'evaluasi_skala_nyeri': $('#evaluasi_skala_nyeri').is(':checked') ? 1 : 0,
            'monitor_suhu_tubuh': $('#monitor_suhu_tubuh').is(':checked') ? 1 : 0,
            'berikan_selimut_tebal': $('#berikan_selimut_tebal').is(':checked') ? 1 : 0,
            'pasang_pemanas': $('#pasang_pemanas').is(':checked') ? 1 : 0,
            'lainnya': [{
                'checked': $('#rencana_keperawatan_lain_1').is(':checked') ? 1 : 0,
                'isian': $('#isian_rencana_keperawatan_lain_1').val()
            }, {
                'checked': $('#rencana_keperawatan_lain_2').is(':checked') ? 1 : 0,
                'isian': $('#isian_rencana_keperawatan_lain_2').val()
            }],
            'isian_berikan_o2': $('#isian_rencana_keperawatan_berikan_o2').val()
        }

        let implementasi = {
            'implementasi_1_memonitor_vital_sign': $('#implementasi_1_memonitor_vital_sign').is(':checked') ? 1 : 0,
            'memonitor_kepatenan_jalan_napas': $('#memonitor_kepatenan_jalan_napas').is(':checked') ? 1 : 0,
            'memberikan_posisi_nyaman_pada_pasien': $('#memberikan_posisi_nyaman_pada_pasien').is(':checked') ? 1 : 0,
            'memasang_guedel_sesuai_indikasi': $('#memasang_guedel_sesuai_indikasi').is(':checked') ? 1 : 0,
            'memberikan_o2': $('#memberikan_o2').is(':checked') ? 1 : 0,
            'implementasi_2_memonitor_vital_sign': $('#implementasi_2_memonitor_vital_sign').is(':checked') ? 1 : 0,
            'mengkaji_tanda_tanda_dehidrasi': $('#mengkaji_tanda_tanda_dehidrasi').is(':checked') ? 1 : 0,
            'memonitor_tanda_syok': $('#memonitor_tanda_syok').is(':checked') ? 1 : 0,
            'menghitung_balance_cairan': $('#menghitung_balance_cairan').is(':checked') ? 1 : 0,
            'mengkaji_lokasi_nyeri': $('#mengkaji_lokasi_nyeri').is(':checked') ? 1 : 0,
            'melakukan_dan_ajarkan_manaheman_nyeri': $('#melakukan_dan_ajarkan_manaheman_nyeri').is(':checked') ? 1 : 0,
            'mengevaluasi_skala_nyeri': $('#mengevaluasi_skala_nyeri').is(':checked') ? 1 : 0,
            'memonitor_suhu_tubuh': $('#memonitor_suhu_tubuh').is(':checked') ? 1 : 0,
            'memberikan_selimut_tebal': $('#memberikan_selimut_tebal').is(':checked') ? 1 : 0,
            'memasang_pemanas': $('#memasang_pemanas').is(':checked') ? 1 : 0,
            'lainnya': [{
                'checked': $('#implementasi_lain_1').is(':checked') ? 1 : 0,
                'isian': $('#isian_implementasi_lain_1').val()
            }, {
                'checked': $('#implementasi_lain_2').is(':checked') ? 1 : 0,
                'isian': $('#isian_implementasi_lain_2').val()
            }],
            'isian_berikan_o2': $('#isian_implementasi_berikan_o2').val()
        }

        let evaluasi = [{
            'vital_sign_dalam_batas_normal': $('#evaluasi_1_vital_sign_dalam_batas_normal').is(':checked') ? 1 : 0,
            'lainnya': {
                'checked': $('#evaluasi_1_lain').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_1_lain').val()
            },
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_1').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_1]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_1]:checked').val() : ''
            },
        }, {
            'tidak_ada_tanda_syok': $('#tidak_ada_tanda_syok').is(':checked') ? 1 : 0,
            'vital_sign_dalam_batas_normal': $('#evaluasi_2_vital_sign_dalam_batas_normal').is(':checked') ? 1 : 0,
            'lainnya': {
                'checked': $('#evaluasi_2_lain').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_2_lain').val()
            },
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_2').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_2]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_2]:checked').val() : ''
            },
        }, {
            'tidak_ada_tanda_dehidrasi': $('#tidak_ada_tanda_dehidrasi').is(':checked') ? 1 : 0,
            'vital_sign_dalam_batas_normal': $('#evaluasi_3_vital_sign_dalam_batas_normal').is(':checked') ? 1 : 0,
            'intake_output': $('#intake_output').is(':checked') ? 1 : 0,
            'lainnya': {
                'checked': $('#evaluasi_3_lain').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_3_lain').val()
            },
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_3').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_3]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_3]:checked').val() : ''
            },
        }, {
            'suhu_normal': $('#suhu_normal').is(':checked') ? 1 : 0,
            'lainnya': {
                'checked': $('#evaluasi_4_lain').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_4_lain').val()
            },
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_4').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_4]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_4]:checked').val() : ''
            },
        }, {
            'lainnya': {
                'checked': $('#evaluasi_5_lain').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_5_lain').val()
            },
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_5').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_5]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_5]:checked').val() : ''
            },
        }]

        $('[name=assessment]').val(JSON.stringify(assessment));
        $('[name=diagnosa_keperawatan]').val(JSON.stringify(diagnosa_keperawatan));
        $('[name=rencana_keperawatan]').val(JSON.stringify(rencana_keperawatan));
        $('[name=implementasi]').val(JSON.stringify(implementasi));
        $('[name=evaluasi]').val(JSON.stringify(evaluasi));

        $.ajax({
            url: "{{ url('e_rekam_medis/rencana_keperawatan_post_operasi/store') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
            }
        })
    })
</script>

</html>