<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rencana Keperawatan Pra-Operasi</title>
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
                zoom: 55%;
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
                    <h6 style="color: white">RENCANA KEPERAWATAN PRA - OPERASI</h6>
                </div>
            </div>
        </div>
        {{-- Input User --}}
        <div class="table-responsive">
            <table class="table table-bordered" id="main_table">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2" colspan="2">ASSESSMENT</th>
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
                        <td colspan="2" class="text-wrap">1. Pernapasan</td>

                        {{-- Section Diagnosa --}}
                        <td rowspan="12">
                            {{-- Diagnosa 1 --}}
                            <div><strong>dx. No.</strong> <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[0]->dx_no : '' }}" id="dx_no_0"></div>
                            <h6 class="mt-2">Cemas Berhubungan Dengan:</h6>

                            <input type="checkbox" id="diagnosa_1_prosedur_operasi" {{ $diagnosa_keperawatan ? in_array('Prosedur Operasi', $diagnosa_keperawatan[0]->value) ? 'checked' : '' : '' }} value="Prosedur Operasi"> Prosedur Operasi<br>
                            <input type="checkbox" id="diagnosa_1_kurang_pengetahuan" {{ $diagnosa_keperawatan ? in_array('Kurang Pengetahuan', $diagnosa_keperawatan[0]->value) ? 'checked' : '' : '' }} value="Kurang Pengetahuan"> Kurang Pengetahuan

                            {{-- Diagnosa 2 --}}
                            <div style="margin-top: 200px">
                                <div><strong>dx. No.</strong> <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[1]->dx_no : '' }}" id="dx_no_1"></div>
                                <h6 class="mt-2">Gangguan rasa nyaman nyeri B.d:</h6>

                                <input type="checkbox" id="diagnosa_2_trauma" {{ $diagnosa_keperawatan ? in_array('Trauma', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} value="Trauma"> Trauma
                                <input type="checkbox" id="diagnosa_2_his" {{ $diagnosa_keperawatan ? in_array('HIS', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} value="HIS"> HIS <br>

                                <input type="checkbox" id="diagnosa_2_lain" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} value="Lain"> <input type="text" class="form-dotted" id="isian_diagnosa_2" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[1]->isian : '' }}">
                            </div>

                            {{-- Diagnosa 3 --}}
                            <div style="margin-top: 220px">
                                <div><strong>dx. No.</strong> <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[2]->dx_no : '' }}" id="dx_no_2"></div>
                                <h6 class="mt-2 text-wrap">Resiko/Gangguan Keseimbangan dan elektrolit B.d:</h6>

                                <input type="checkbox" id="diagnosa_3_pendarahan" {{ $diagnosa_keperawatan ? in_array('Pendarahan', $diagnosa_keperawatan[2]->value) ? 'checked' : '' : '' }} value="Pendarahan"> Pendarahan <br>

                                <input type="checkbox" id="diagnosa_3_lain" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[2]->value) ? 'checked' : '' : '' }} value="Lain"> <input type="text" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[2]->isian : '' }}" class="form-dotted" id="isian_diagnosa_3">
                            </div>

                            {{-- Diagnosa 4 --}}
                            <div class="mt-4 text-wrap">
                                <div><strong>dx. No.</strong> <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[3]->dx_no : '' }}" id="dx_no_3"></div>
                                <h6 class="mt-2">Gangguan Jalan Nafas : Pola Pertukaran Gas B.d:</h6>

                                <input type="checkbox" id="diagnosa_4_penumpukan_cairan" {{ $diagnosa_keperawatan ? in_array('Penumpukan Cairan', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} value="Penumpukan Cairan"> Penumpukan Cairan <br>
                                <input type="checkbox" id="diagnosa_4_massa" {{ $diagnosa_keperawatan ? in_array('Massa', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} value="Massa"> Massa <br>

                                <input type="checkbox" id="diagnosa_4_lain" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} value="Lain"> <input type="text" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[3]->isian : '' }}" class="form-dotted" name=""
                                    id="isian_diagnosa_4">
                            </div>

                            {{-- Diagnosa 5 --}}
                            <div class="mt-4 text-wrap">
                                <div><input type="checkbox" {{ $diagnosa_keperawatan ? $diagnosa_keperawatan[4]->checked ? 'checked' : '' : '' }} id="check_diagnosa_5"> <strong>dx. No.
                                        <input type="text" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[4]->dx_no : '' }}" class="form-dotted" id="dx_no_4">
                                </div>
                            </div>

                        </td>

                        {{-- Section Rencana --}}
                        <td rowspan="12" class="text-wrap">
                            {{-- Rencana 1 --}}
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->observasi_reaksi_non_verbal ? 'checked' : '' : '' }} id="observasi_reaksi_non_verbal" value="Observasi Reaksi Non Verbal">Observasi Reaksi Non Verbal <br>
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->tanyakan_pada_pasien_penyebab ? 'checked' : '' : '' }} id="tanyakan_pada_pasien_penyebab" value="Tanyakan Pada Pasien Penyebab">Tanyakan Pada Pasien Penyebab <br>
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->cemas_takut ? 'checked' : '' : '' }} id="cemas_takut" value="Cemas/Takut">Cemas/Takut <br>
                            <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->anjurkan_pasien_berdoa ? 'checked' : '' : '' }} id="anjurkan_pasien_berdoa" value="Anjurkan Pasien Berdoa">Anjurkan
                            Pasien Berdoa <br>
                            <input type="checkbox" id="diskusi_pasien" value="">Diskusikan Pasien
                            Tentang: <br>Tujuan Pembedahan, Prosedur Pembedahan,
                            dan Pembiusan<br>

                            {{-- Rencana 2 --}}
                            <div style="margin-top: 80px">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->kaji_lokasi_nyeri ? 'checked' : '' : '' }} id="kaji_lokasi_nyeri" value="Kaji Lokasi Nyeri, Karakteristik dan Lokasi Nyeri">Kaji Lokasi Nyeri,
                                Karakteristik
                                dan Lokasi Nyeri <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->lakukan_dan_ajarkan_manajemen_nyeri ? 'checked' : '' : '' }} id="lakukan_dan_ajarkan_manajemen_nyeri" class="mt-2" value="Lakukan dan ajarkan manajemen nyeri, tarik nafas dalam">Lakukan dan ajarkan
                                manajemen nyeri, tarik nafas dalam <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->evaluasi_skala_nyeri ? 'checked' : '' : '' }} id="evaluasi_skala_nyeri" class="mt-2" value="Evaluasi skala nyeri setelah diberi Intervensi">Evaluasi skala nyeri setelah
                                diberi
                                Intervensi <br>
                            </div>

                            {{-- Rencana 3 --}}
                            <div style="margin-top: 160px">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->kaji_adanya_pendarahan ? 'checked' : '' : '' }} id="kaji_adanya_pendarahan" value="Kaji adanya perdarahan">Kaji adanya perdarahan<br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->berikan_cairan ? 'checked' : '' : '' }} id="berikan_cairan" class="mt-2" value="Berikan cairan sesuai indikasi">Berikan cairan sesuai indikasi<br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->kolaborasi_pemberian_cairan ? 'checked' : '' : '' }} id="kolaborasi_pemberian_cairan" class="mt-2" value="Berikan cairan sesuai indikasi">Kolaborasi pemberina cairan<br>

                            </div>

                            {{-- Rencana 4 --}}
                            <div style="margin-top: 40px">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pastikan_o2_terpasaang ? 'checked' : '' : '' }} id="pastikan_o2_terpasaang" value="Pastikan O2 terpasang dengan baik ketika transportasi ke kamar Operasi">Pastikan
                                O2 terpasang dengan baik ketika transportasi ke kamar Operasi<br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->observasi_pasien ? 'checked' : '' : '' }} id="observasi_pasien" class="mt-2" value="Observasi pasien sebelum dan sesudah Operasi">Observasi pasien sebelum dan sesudah Operasi<br>
                                <div class="d-flex">
                                    <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->lainnya->value ? 'checked' : '' : '' }} id="rencana_keperawatan_lainnya"> <input type="text" id="isian_rencana_keperawatan_lainnya" class="form-dotted" value="{{ $rencana_keperawatan ? $rencana_keperawatan->lainnya->isian : '' }}">
                                </div>
                            </div>

                        </td>
                        {{-- End Section Rencana --}}

                        {{-- Section Implementasi --}}
                        <td rowspan="12">
                            {{-- Implementasi 1 --}}
                            <input type="checkbox" {{ $implementasi ? $implementasi->mengobservasi_reaksi_non_verbal ? 'checked' : '' : '' }} id="mengobservasi_reaksi_non_verbal"
                                value="Observasi Reaksi Non Verbal">Mengobservasi Reaksi Non Verbal <br>
                            <input type="checkbox" {{ $implementasi ? $implementasi->menanyakan_pada_pasien_penyebab ? 'checked' : '' : '' }} id="menanyakan_pada_pasien_penyebab"
                                value="Tanyakan Pada Pasien Penyebab">Menanyakan Pada Pasien Penyebab <br>
                            <input type="checkbox" {{ $implementasi ? $implementasi->cemas_takut ? 'checked' : '' : '' }} id="implementasi_cemas_takut" value="Cemas/Takut">Cemas/Takut <br>
                            <input type="checkbox" {{ $implementasi ? $implementasi->menganjurkan_pasien_berdoa ? 'checked' : '' : '' }} id="menganjurkan_pasien_berdoa"
                                value="Anjurkan Pasien Berdoa">Menganjurkan
                            Pasien Berdoa <br>
                            <input type="checkbox" {{ $implementasi ? $implementasi->mendiskusikan_pasien ? 'checked' : '' : '' }} id="mendiskusikan_pasien" class="text-wrap"
                                value="">mendiskusikan Pasien Tentang: <br>Tujuan Pembedahan,<br> Prosedur
                            Pembedahan,
                            dan Pembiusan<br>

                            {{-- Implementasi 2 --}}
                            <div style="margin-top: 150px">
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengkaji_lokasi_nyeri ? 'checked' : '' : '' }} id="mengkaji_lokasi_nyeri"
                                    value="Mengkaji Lokasi Nyeri, Karakteristik dan Lokasi Nyeri">Mengkaji Lokasi Nyeri,
                                Karakteristik
                                dan <br> Lokasi Nyeri <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->melakukan_dan_ajarkan_manajemen_nyeri ? 'checked' : '' : '' }} id="melakukan_dan_ajarkan_manajemen_nyeri" class="mt-2"
                                    value="Melakukan dan ajarkan manajemen nyeri, tarik nafas dalam">Melakukan dan ajarkan
                                manajemen <br> nyeri, tarik nafas dalam <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengevaluasi_skala_nyeri ? 'checked' : '' : '' }} id="mengevaluasi_skala_nyeri" class="mt-2"
                                    value="Mengevaluasi skala nyeri setelah diberi Intervensi">Mengevaluasi skala nyeri
                                setelah
                                diberi <br>
                                Intervensi <br>
                            </div>

                            {{-- Implementasi 3 --}}
                            <div style="margin-top: 180px">
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengkaji_addanya_pendarahan ? 'checked' : '' : '' }} id="mengkaji_addanya_pendarahan"
                                    value="Mengkaji adanya perdarahan">Mengkaji adanya perdarahan<br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memberikan_cairan_sesuai_indikasi ? 'checked' : '' : '' }} id="memberikan_cairan_sesuai_indikasi" class="mt-2"
                                    value="Memberikan cairan sesuai indikasi">Memberikan cairan sesuai indikasi<br>
                            </div>

                            {{-- Implementasi 4 --}}
                            <div style="margin-top: 120px">
                                <input type="checkbox" {{ $implementasi ? $implementasi->memastikan_o2_terpasang ? 'checked' : '' : '' }} id="memastikan_o2_terpasang"
                                    value="Memastikan O2 Terpasang dengan Baikn ketika transportasi ke kamar Operasi">Memastikan
                                O2 Terpasang dengan Baik <br> ketika transportasi ke kamar Operasi<br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengobservasi_pasien ? 'checked' : '' : '' }} id="mengobservasi_pasien" class="mt-2"
                                    value="Mengobservasi pasien sebelum dan sesudah Operasi">Mengobservasi pasien sebelum
                                dan sesudah <br> Operasi<br>
                            </div>
                        </td>
                        {{-- End Section Implementasi --}}

                        {{-- Section Evaluasi --}}
                        <td rowspan="12">
                            {{-- Evaluasi 1 --}}
                            <input type="checkbox" {{ $evaluasi ? $evaluasi[0]->pasien_mengatakan_tidak_cemas ? 'checked' : '' : '' }} id="pasien_mengatakan_tidak_cemas"
                                value="Observasi Reaksi Non Verbal">Pasien mengatakan tidak cemas<br>
                            <input type="checkbox" {{ $evaluasi ? $evaluasi[0]->ekspresinya_senang ? 'checked' : '' : '' }} id="ekspresinya_senang"
                                value="Ekspresinya senang">Ekspresinya senang <br>
                            <input type="checkbox" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_1"> Masalah Teratasi: <br>
                            <input type="radio" name="pilihan_masalah_teratasi_1" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} value="Ya" class="ml-4"> Ya
                            <input type="radio" name="pilihan_masalah_teratasi_1" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak

                            {{-- Evaluasi 2 --}}
                            <div style="margin-top: 210px">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->pasien_mengatakan_hilang ? 'checked' : '' : '' }} id="pasien_mengatakan_hilang"
                                    value="Pasien mengatakan hilang/berkurang">Pasien mengatakan hilang/berkurang<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->vital_sign_dalam_batas_normal ? 'checked' : '' : '' }} id="vital_sign_dalam_batas_normal_2"
                                    value="Vital sign dalam batas Normal">Vital sign dalam batas Normal <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_2"> Masalah Teratasi: <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_2" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_2" value="Tidak"> Tidak
                            </div>

                            {{-- Evaluasi 3 --}}
                            <div style="margin-top: 240px">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->vital_sign_dalam_batas_normal ? 'checked' : '' : '' }} id="vital_sign_dalam_batas_normal_3"
                                    value="Vital sign dalam batas Normal">Vital sign dalam batas Normal <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->tidak_ada_tanda_dehidrasi ? 'checked' : '' : '' }} id="tidak_ada_tanda_dehidrasi"
                                    value="Tidak ada tanda dehidrasi">Tidak
                                ada tanda dehidrasi<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->intake_output ? 'checked' : '' : '' }} id="intake_output"
                                    value="Intake Output 24 Jam seimbang">Intake Output 24 Jam seimbang<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_3"> Masalah Teratasi: <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_3" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_3" value="Tidak"> Tidak
                            </div>

                            {{-- Evaluasi 4 --}}
                            <div style="margin-top: 60px">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->rr_dalam_batas_normal ? 'checked' : '' : '' }} id="rr_dalam_batas_normal" value="RR dalam batas normal">RR
                                dalam batas normal<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->jalan_nafas_adekuat ? 'checked' : '' : '' }} id="jalan_nafas_adekuat" value="Jalan nafas adekuat">Jalan
                                nafas adekuat<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->tidak_ada_sianosis ? 'checked' : '' : '' }} id="tidak_ada_sianosis" value="Tidak ada sianosis">Tidak
                                ada sianosis<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_4"> Masalah Teratasi: <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_4" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_4" value="Tidak"> Tidak
                            </div>

                            {{-- Evaluasi 5 --}}
                            <div style="margin-top: 20px">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[4]->lainnya->value ? 'checked' : '' : '' }} id="evaluasi_lainnya" value="Lainnya">
                                <input type="text" value="{{ $evaluasi ? $evaluasi[4]->lainnya->isian : '' }}" class="form-dotted" id="isian_evaluasi_lainnya"> <br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->checked ? 'checked' : '' : '' }} id="masalah_teratasi_5"> Masalah Teratasi: <br>
                                <input type="radio" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->value == 'Ya' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_5" value="Ya" class="ml-4"> Ya
                                <input type="radio" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->value == 'Tidak' ? 'checked' : '' : '' }} name="pilihan_masalah_teratasi_5" value="Tidak"> Tidak
                            </div>
                        </td>
                        {{-- End Section Evaluasi --}}

                    </tr>

                    <tr>
                        <td>Alat Bantu Nafas <br>
                            <input type="radio" {{ $assessment ? $assessment->pernapasan->alat_bantu_nafas == 'Ya' ? 'checked' : '' : '' }} name="alat_bantu_nafas" value="Ya"> Ya
                            <input type="radio" {{ $assessment ? $assessment->pernapasan->alat_bantu_nafas == 'Tidak' ? 'checked' : '' : '' }} name="alat_bantu_nafas" value="Tidak" class="ml-2"> Tidak
                        </td>
                        <td>Normal <br>
                            <input type="radio" {{ $assessment ? $assessment->pernapasan->normal == 'Ya' ? 'checked' : '' : '' }} name="pernapasan_normal" value="Ya"> Ya
                            <input type="radio" {{ $assessment ? $assessment->pernapasan->normal == 'Tidak' ? 'checked' : '' : '' }} name="pernapasan_normal" value="Tidak" class="ml-2"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Irama dan Kedalaman <br>
                            <input type="checkbox" {{ $assessment ? in_array('Reguler', $assessment->pernapasan->irama_dan_kedalaman) ? 'checked' : '' : '' }} id="irama_reguler" value="Reguler">
                            <label for="labelReguler">Reguler</label>
                            <input type="checkbox" {{ $assessment ? in_array('Irreguler', $assessment->pernapasan->irama_dan_kedalaman) ? 'checked' : '' : '' }} id="irama_irreguler" class="ml-2" value="Irreguler">
                            <label for="labelIrreguler">Irreguler</label>
                            <input type="checkbox" {{ $assessment ? in_array('Dalam', $assessment->pernapasan->irama_dan_kedalaman) ? 'checked' : '' : '' }} id="irama_dalam" class="ml-2" value="Dalam">
                            <label for="labelDalam">Dalam</label>
                            <input type="checkbox" {{ $assessment ? in_array('Dangkal', $assessment->pernapasan->irama_dan_kedalaman) ? 'checked' : '' : '' }} id="irama_dangkal" class="ml-2" value="Dangkal">
                            <label for="labelDangkal">Dangkal</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Suara Nafas :
                            <input type="checkbox" {{ $assessment ? in_array('Normal', $assessment->pernapasan->suara_nafas) ? 'checked' : '' : '' }} id="suara_nafas_normal" value="Normal"> Normal,
                            <input type="checkbox" {{ $assessment ? in_array('Mengi', $assessment->pernapasan->suara_nafas) ? 'checked' : '' : '' }} id="suara_nafas_mengi" value="Mengi"> Mengi,
                            <input type="checkbox" {{ $assessment ? in_array('Ronkhi', $assessment->pernapasan->suara_nafas) ? 'checked' : '' : '' }} id="suara_nafas_ronkhi" value="Ronkhi"> Ronkhi <br>

                            RR : <input type="text" class="form-dotted" id="pernapasan_rr" value="{{ $assessment ? $assessment->pernapasan->rr : '' }}" style="width:25%">X/m |
                            Sp. O2 : <input type="text" id="pernapasan_spo2" value="{{ $assessment ? $assessment->pernapasan->spo2 : '' }}" class="form-dotted" style="width:25%">X/m

                        </td>
                    </tr>
                    {{-- End Assesment Section 1 --}}

                    {{-- Assesment Section 2 --}}
                    <tr>
                        <td colspan="2" class="text-wrap">
                            2. Sirkulasi
                        </td>
                    </tr>

                    {{-- Assesment Section 2 --}}
                    <tr>
                        <td>Kapiler Refill <br>
                            <input type="checkbox" id="kapiler_refil_less_2" {{ $assessment ? in_array('< 2 detik', $assessment->sirkulasi->kapiler_refil) ? 'checked' : '' : '' }} value="< 2 detik">
                            < 2 detik <input type="checkbox" id="kapiler_refil_more_2" {{ $assessment ? in_array('> 2 detik', $assessment->sirkulasi->kapiler_refil) ? 'checked' : '' : '' }} value="> 2 detik"> > 2 detik
                        </td>
                        <td>Kulit <br>
                            <input type="checkbox" {{ $assessment ? in_array('Hangat', $assessment->sirkulasi->kulit->value) ? 'checked' : '' : '' }} id="kulit_hangat" value="Hangat"> Hangat
                            <input type="checkbox" {{ $assessment ? in_array('Dingin', $assessment->sirkulasi->kulit->value) ? 'checked' : '' : '' }} id="kulit_dingin" value="Dingin"> Dingin <br>
                            <input type="checkbox" {{ $assessment ? in_array('Lainnya', $assessment->sirkulasi->kulit->value) ? 'checked' : '' : '' }} id="kulit_lain" value="Lainnya"> Lainnya : <br>
                            <input type="text" class="form-dotted" style="width: 80%" value="{{ $assessment ? $assessment->sirkulasi->kulit->isian : '' }}" id="isian_kulit">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <label for="" class="col-sm-2 col-form-label">TD : </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-dotted" style="width: 80%" value="{{ $assessment ? $assessment->sirkulasi->td : '' }}" id="sirkulasi_td">mmHg
                                </div>
                            </div>

                            <div class="row">
                                <label for="" class="col-sm-2 col-form-label">N : </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-dotted" style="width: 80%" value="{{ $assessment ? $assessment->sirkulasi->n : '' }}" id="sirkulasi_n">X/m
                                </div>
                            </div>

                            <div class="row">
                                <label for="" class="col-sm-2 col-form-label">Gds : </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-dotted" style="width: 80%" value="{{ $assessment ? $assessment->sirkulasi->gds : '' }}" id="sirkulasi_gds">mg/dl
                                </div>
                            </div>

                        </td>
                        <td>
                            Pendarahan <br>
                            <input type="radio" {{ $assessment ? $assessment->sirkulasi->pendarahan == 'Ya' ? 'checked' : '' : '' }} name="pendarahan" value="Ya"> Ya
                            <input type="radio" {{ $assessment ? $assessment->sirkulasi->pendarahan == 'Tidak' ? 'checked' : '' : '' }} name="pendarahan" value="Tidak" class="ml-2"> Tidak
                        </td>
                    </tr>
                    {{-- End Assesment Section 2 --}}

                    {{-- Assesment Section 3 --}}
                    <tr>
                        <td colspan="2" class="text-wrap">
                            3. Kesadaran : <br>
                            <input type="checkbox" {{ $assessment ? in_array('CM', $assessment->kesadaran->value) ? 'checked' : '' : '' }} id="kesadaran_cm" value="CM"> CM
                            <input type="checkbox" {{ $assessment ? in_array('Delirium', $assessment->kesadaran->value) ? 'checked' : '' : '' }} id="kesadaran_delirium" value="Delirium"> Delirium
                            <input type="checkbox" {{ $assessment ? in_array('Somnolen', $assessment->kesadaran->value) ? 'checked' : '' : '' }} id="kesadaran_somnolen" value="Somnolen"> Somnolen <br>
                            <input type="checkbox" {{ $assessment ? in_array('Koma', $assessment->kesadaran->value) ? 'checked' : '' : '' }} id="kesadaran_koma" value="Koma"> Koma
                            <input type="checkbox" {{ $assessment ? in_array('Soporocoma', $assessment->kesadaran->value) ? 'checked' : '' : '' }} id="kesadaran_soporocoma" value="Soporocoma"> Soporocoma <br>
                            {{-- input text --}}
                            GCS : <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->kesadaran->gcs : '' }}" id="kesadaran_gcs" style="width: 14%">,
                            E : <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->kesadaran->e : '' }}" id="kesadaran_e" style="width: 14%">,
                            M : <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->kesadaran->m : '' }}" id="kesadaran_m" style="width: 15%">,
                            V : <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->kesadaran->v : '' }}" id="kesadaran_v" style="width: 12%">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="text-wrap">
                            4. Perkemihan <br>
                            <input type="checkbox" id="perkemihan_terpasang_kateter" {{ $assessment ? in_array('Terpasang Kateter', $assessment->perkemihan->value) ? 'checked' : '' : '' }} value="Terpasang Kateter"> Terpasang Kateter
                            <input type="checkbox" id="perkemihan_tak" {{ $assessment ? in_array('TAK', $assessment->perkemihan->value) ? 'checked' : '' : '' }} value="TAK"> TAK <br>
                            <input type="checkbox" id="perkemihan_lain" {{ $assessment ? in_array('Lain', $assessment->perkemihan->value) ? 'checked' : '' : '' }} value="Lain"> <input type="text" class="form-dotted" name=""
                                id="isian_perkemihan" value="{{ $assessment ? $assessment->perkemihan->isian : '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-wrap">
                            5. Musculoskeletal <br>
                            <input type="checkbox" id="musculoskeletal_tak" {{ $assessment ? in_array('TAK', $assessment->musculoskeletal) ? 'checked' : '' : '' }} value="TAK"> TAK
                            <input type="checkbox" id="musculoskeletal_paralis" {{ $assessment ? in_array('Paralis', $assessment->musculoskeletal) ? 'checked' : '' : '' }} value="Paralis"> Paralis
                            <input type="checkbox" id="musculoskeletal_alat_bantu" {{ $assessment ? in_array('Alat Bantu', $assessment->musculoskeletal) ? 'checked' : '' : '' }} value="Alat Bantu"> Alat Bantu
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-wrap">
                            6. Sensorik <br>
                            <input type="checkbox" id="sensorik_tak" {{ $assessment ? in_array('TAK', $assessment->sensorik) ? 'checked' : '' : '' }} value="TAK"> TAK
                            <input type="checkbox" id="sensorik_pendengaran" {{ $assessment ? in_array('Pendengaran', $assessment->sensorik) ? 'checked' : '' : '' }} value="Pendengaran"> Pendengaran
                            <input type="checkbox" id="sensorik_penglihatan" {{ $assessment ? in_array('Penglihatan', $assessment->sensorik) ? 'checked' : '' : '' }} value="Penglihatan"> Penglihatan
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- Button Submit dan Download --}}
        <div class="row mt-2" style="margin-left: 0; width:100%;">
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
    {{-- Form Assesment  --}}
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

        toastr.warning('Sedang menyimpan dokumen, harap tunggu...');

        let irama_dan_kedalaman = [];

        if ($('#irama_reguler').is(':checked')) {
            irama_dan_kedalaman.push($('#irama_reguler').val());
        }

        if ($('#irama_irreguler').is(':checked')) {
            irama_dan_kedalaman.push($('#irama_irreguler').val());
        }

        if ($('#irama_dalam').is(':checked')) {
            irama_dan_kedalaman.push($('#irama_dalam').val());
        }

        if ($('#irama_dangkal').is(':checked')) {
            irama_dan_kedalaman.push($('#irama_dangkal').val());
        }

        let suara_nafas = [];

        if ($('#suara_nafas_normal').is(':checked')) {
            suara_nafas.push($('#suara_nafas_normal').val());
        }

        if ($('#suara_nafas_mengi').is(':checked')) {
            suara_nafas.push($('#suara_nafas_mengi').val());
        }

        if ($('#suara_nafas_ronkhi').is(':checked')) {
            suara_nafas.push($('#suara_nafas_ronkhi').val());
        }

        let kapiler_refil = [];

        if ($('#kapiler_refil_less_2').is(':checked')) {
            kapiler_refil.push($('#kapiler_refil_less_2').val());
        }

        if ($('#kapiler_refil_more_2').is(':checked')) {
            kapiler_refil.push($('#kapiler_refil_more_2').val());
        }

        let kulit = [];

        if ($('#kulit_hangat').is(':checked')) {
            kulit.push($('#kulit_hangat').val());
        }

        if ($('#kulit_dingin').is(':checked')) {
            kulit.push($('#kulit_dingin').val());
        }

        if ($('#kulit_lain').is(':checked')) {
            kulit.push($('#kulit_lain').val());
        }

        let kesadaran = [];

        if ($('#kesadaran_cm').is(':checked')) {
            kesadaran.push($('#kesadaran_cm').val());
        }

        if ($('#kesadaran_delirium').is(':checked')) {
            kesadaran.push($('#kesadaran_delirium').val());
        }

        if ($('#kesadaran_somnolen').is(':checked')) {
            kesadaran.push($('#kesadaran_somnolen').val());
        }

        if ($('#kesadaran_koma').is(':checked')) {
            kesadaran.push($('#kesadaran_koma').val());
        }

        if ($('#kesadaran_soporocoma').is(':checked')) {
            kesadaran.push($('#kesadaran_soporocoma').val());
        }

        let perkemihan = [];

        if ($('#perkemihan_terpasang_kateter').is(':checked')) {
            perkemihan.push($('#perkemihan_terpasang_kateter').val());
        }

        if ($('#perkemihan_tak').is(':checked')) {
            perkemihan.push($('#perkemihan_tak').val());
        }

        if ($('#perkemihan_lain').is(':checked')) {
            perkemihan.push($('#perkemihan_lain').val());
        }

        let musculoskeletal = [];

        if ($('#musculoskeletal_tak').is(':checked')) {
            musculoskeletal.push($('#musculoskeletal_tak').val());
        }

        if ($('#musculoskeletal_paralis').is(':checked')) {
            musculoskeletal.push($('#musculoskeletal_paralis').val());
        }

        if ($('#musculoskeletal_alat_bantu').is(':checked')) {
            musculoskeletal.push($('#musculoskeletal_alat_bantu').val());
        }

        let sensorik = [];

        if ($('#sensorik_tak').is(':checked')) {
            sensorik.push($('#sensorik_tak').val());
        }

        if ($('#sensorik_pendengaran').is(':checked')) {
            sensorik.push($('#sensorik_pendengaran').val());
        }

        if ($('#sensorik_penglihatan').is(':checked')) {
            sensorik.push($('#sensorik_penglihatan').val());
        }

        let assessment = {
            'pernapasan': {
                'alat_bantu_nafas': $('[name=alat_bantu_nafas]:checked').val() != undefined ? $('[name=alat_bantu_nafas]:checked').val() : '',
                'normal': $('[name=pernapasan_normal]:checked').val() != undefined ? $('[name=pernapasan_normal]:checked').val() : '',
                'irama_dan_kedalaman': irama_dan_kedalaman,
                'suara_nafas': suara_nafas,
                'rr': $('#pernapasan_rr').val(),
                'spo2': $('#pernapasan_spo2').val()
            },
            'sirkulasi': {
                'kapiler_refil': kapiler_refil,
                'kulit': {
                    'value': kulit,
                    'isian': $('#isian_kulit').val()
                },
                'td': $('#sirkulasi_td').val(),
                'n': $('#sirkulasi_n').val(),
                'gds': $('#sirkulasi_gds').val(),
                'pendarahan': $('[name=pendarahan]:checked').val() != undefined ? $('[name=pendarahan]:checked').val() : ''
            },
            'kesadaran': {
                'value': kesadaran,
                'gcs': $('#kesadaran_gcs').val(),
                'e': $('#kesadaran_e').val(),
                'm': $('#kesadaran_m').val(),
                'v': $('#kesadaran_v').val(),
            },
            'perkemihan': {
                'value': perkemihan,
                'isian': $('#isian_perkemihan').val()
            },
            'musculoskeletal': musculoskeletal,
            'sensorik': sensorik
        }

        let diagnosa_keperawatan = [null, null, null, null, null];

        let diagnosa_0 = [];

        if ($('#diagnosa_1_prosedur_operasi').is(':checked')) {
            diagnosa_0.push($('#diagnosa_1_prosedur_operasi').val());
        }

        if ($('#diagnosa_1_kurang_pengetahuan').is(':checked')) {
            diagnosa_0.push($('#diagnosa_1_kurang_pengetahuan').val());
        }

        let diagnosa_1 = [];

        if ($('#diagnosa_2_trauma').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_trauma').val());
        }

        if ($('#diagnosa_2_his').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_his').val());
        }

        if ($('#diagnosa_2_lain').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_lain').val());
        }

        let diagnosa_2 = [];

        if ($('#diagnosa_3_pendarahan').is(':checked')) {
            diagnosa_2.push($('#diagnosa_3_pendarahan').val());
        }

        if ($('#diagnosa_3_lain').is(':checked')) {
            diagnosa_2.push($('#diagnosa_3_lain').val());
        }

        let diagnosa_3 = [];

        if ($('#diagnosa_4_penumpukan_cairan').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_penumpukan_cairan').val());
        }

        if ($('#diagnosa_4_massa').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_massa').val());
        }

        if ($('#diagnosa_4_lain').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_lain').val());
        }

        diagnosa_keperawatan[0] = {
            'dx_no': $('#dx_no_0').val(),
            'value': diagnosa_0
        };

        diagnosa_keperawatan[1] = {
            'dx_no': $('#dx_no_1').val(),
            'value': diagnosa_1,
            'isian': $('#isian_diagnosa_2').val()
        };

        diagnosa_keperawatan[2] = {
            'dx_no': $('#dx_no_2').val(),
            'value': diagnosa_2,
            'isian': $('#isian_diagnosa_3').val()
        };

        diagnosa_keperawatan[3] = {
            'dx_no': $('#dx_no_3').val(),
            'value': diagnosa_3,
            'isian': $('#isian_diagnosa_4').val()
        };

        diagnosa_keperawatan[4] = {
            'checked': $('#check_diagnosa_5').is(':checked') ? 1 : 0,
            'dx_no': $('#dx_no_4').val()
        }

        let rencana_keperawatan = {
            'observasi_reaksi_non_verbal': $('#observasi_reaksi_non_verbal').is(':checked') ? 1 : 0,
            'tanyakan_pada_pasien_penyebab': $('#tanyakan_pada_pasien_penyebab').is(':checked') ? 1 : 0,
            'cemas_takut': $('#cemas_takut').is(':checked') ? 1 : 0,
            'anjurkan_pasien_berdoa': $('#anjurkan_pasien_berdoa').is(':checked') ? 1 : 0,
            'diskusi_pasien': $('#diskusi_pasien').is(':checked') ? 1 : 0,
            'kaji_lokasi_nyeri': $('#kaji_lokasi_nyeri').is(':checked') ? 1 : 0,
            'lakukan_dan_ajarkan_manajemen_nyeri': $('#lakukan_dan_ajarkan_manajemen_nyeri').is(':checked') ? 1 : 0,
            'evaluasi_skala_nyeri': $('#evaluasi_skala_nyeri').is(':checked') ? 1 : 0,
            'kaji_adanya_pendarahan': $('#kaji_adanya_pendarahan').is(':checked') ? 1 : 0,
            'berikan_cairan': $('#berikan_cairan').is(':checked') ? 1 : 0,
            'kolaborasi_pemberian_cairan': $('#kolaborasi_pemberian_cairan').is(':checked') ? 1 : 0,
            'pastikan_o2_terpasaang': $('#pastikan_o2_terpasaang').is(':checked') ? 1 : 0,
            'observasi_pasien': $('#observasi_pasien').is(':checked') ? 1 : 0,
            'lainnya': {
                'value': $('#rencana_keperawatan_lainnya').is(':checked') ? 1 : 0,
                'isian': $('#isian_rencana_keperawatan_lainnya').val()
            }
        }

        let implementasi = {
            'mengobservasi_reaksi_non_verbal': $('#mengobservasi_reaksi_non_verbal').is(':checked') ? 1 : 0,
            'menanyakan_pada_pasien_penyebab': $('#menanyakan_pada_pasien_penyebab').is(':checked') ? 1 : 0,
            'cemas_takut': $('#implementasi_cemas_takut').is(':checked') ? 1 : 0,
            'menganjurkan_pasien_berdoa': $('#menganjurkan_pasien_berdoa').is(':checked') ? 1 : 0,
            'mendiskusikan_pasien': $('#mendiskusikan_pasien').is(':checked') ? 1 : 0,
            'mengkaji_lokasi_nyeri': $('#mengkaji_lokasi_nyeri').is(':checked') ? 1 : 0,
            'melakukan_dan_ajarkan_manajemen_nyeri': $('#melakukan_dan_ajarkan_manajemen_nyeri').is(':checked') ? 1 : 0,
            'mengevaluasi_skala_nyeri': $('#mengevaluasi_skala_nyeri').is(':checked') ? 1 : 0,
            'mengkaji_addanya_pendarahan': $('#mengkaji_addanya_pendarahan').is(':checked') ? 1 : 0,
            'memberikan_cairan_sesuai_indikasi': $('#memberikan_cairan_sesuai_indikasi').is(':checked') ? 1 : 0,
            'memastikan_o2_terpasang': $('#memastikan_o2_terpasang').is(':checked') ? 1 : 0,
            'mengobservasi_pasien': $('#mengobservasi_pasien').is(':checked') ? 1 : 0,
        }

        let evaluasi = [{
            'pasien_mengatakan_tidak_cemas': $('#pasien_mengatakan_tidak_cemas').is(':checked') ? 1 : 0,
            'ekspresinya_senang': $('#ekspresinya_senang').is(':checked') ? 1 : 0,
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_1').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_1]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_1]:checked').val() : ''
            },
        }, {
            'pasien_mengatakan_hilang': $('#pasien_mengatakan_hilang').is(':checked') ? 1 : 0,
            'vital_sign_dalam_batas_normal': $('#vital_sign_dalam_batas_normal_2').is(':checked') ? 1 : 0,
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_2').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_2]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_2]:checked').val() : ''
            },
        }, {
            'tidak_ada_tanda_dehidrasi': $('#tidak_ada_tanda_dehidrasi').is(':checked') ? 1 : 0,
            'vital_sign_dalam_batas_normal': $('#vital_sign_dalam_batas_normal_3').is(':checked') ? 1 : 0,
            'intake_output': $('#intake_output').is(':checked') ? 1 : 0,
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_3').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_3]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_3]:checked').val() : ''
            },
        }, {
            'rr_dalam_batas_normal': $('#rr_dalam_batas_normal').is(':checked') ? 1 : 0,
            'jalan_nafas_adekuat': $('#jalan_nafas_adekuat').is(':checked') ? 1 : 0,
            'tidak_ada_sianosis': $('#tidak_ada_sianosis').is(':checked') ? 1 : 0,
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_4').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_4]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_4]:checked').val() : ''
            },
        }, {
            'lainnya': {
                'value': $('#evaluasi_lainnya').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_lainnya').val()
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
            url: "{{ url('e_rekam_medis/rencana_keperawatan_pra_operasi/store') }}",
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
    // Input Data
    function submit_form() {
        $('#form_dokumen').submit();
    }

    // function cek_form() {
    //     var catatan = [];
    //     if ($('#').is(":checked")) {
    //         catatan.push('')
    //     }

    //     $('#').val($('#').val()); 
    //     $('#').val($('[name=""]:checked').val());
    //     ();
    //     return true;
    // }



    // Checkbox Diagnosa
    function cek_diagnosa() {
        if ($("#resikoCheckbox").prop('checked') == true) {
            $('#inputResiko').removeAttr('readonly');
        } else {
            $('#inputResiko').attr('readonly', true);
            $('#inputResiko').val('');
        }
    }

    function cek_diagnosa2() {
        if ($("#hipotermiCheckbox").prop('checked') == true) {
            $('#inputHipotermi').removeAttr('readonly');
        } else {
            $('#inputHipotermi').attr('readonly', true);
            $('#inputHipotermi').val('');
        }
    }

    function cek_diagnosa3() {
        if ($("#cideraCheckbox").prop('checked') == true) {
            $('#inputCidera').removeAttr('readonly');
        } else {
            $('#inputCidera').attr('readonly', true);
            $('#inputCidera').val('');
        }
    }

    function cek_diagnosa4() {
        if ($("#gangguanCheckbox").prop('checked') == true) {
            $('#inputGangguan').removeAttr('readonly');
        } else {
            $('#inputGangguan').attr('readonly', true);
            $('#inputGangguan').val('');
        }
    }

    // Checkbox Rencana Keperawatan
    function cek_rencana3() {
        if ($("#rencanaCheckbox_3").prop('checked') == true) {
            $('#inputRencana_3').removeAttr('readonly');
        } else {
            $('#inputRencana_3').attr('readonly', true);
            $('#inputRencana_3').val('');
        }
    }

    function cek_rencana4() {
        if ($("#rencanaCheckbox_4").prop('checked') == true) {
            $('#inputRencana_4').removeAttr('readonly');
        } else {
            $('#inputRencana_4').attr('readonly', true);
            $('#inputRencana_4').val('');
        }
    }

    function cek_rencana5() {
        if ($("#rencanaCheckbox_5").prop('checked') == true) {
            $('#inputRencana_5').removeAttr('readonly');
        } else {
            $('#inputRencana_5').attr('readonly', true);
            $('#inputRencana_5').val('');
        }
    }

    // Checkbox Implementasi
    function cek_implementasi3() {
        if ($("#imCheckbox_3").prop('checked') == true) {
            $('#inputIm_3').removeAttr('readonly');
        } else {
            $('#inputIm_3').attr('readonly', true);
            $('#inputIm_3').val('');
        }
    }

    function cek_implementasi4() {
        if ($("#imCheckbox_4").prop('checked') == true) {
            $('#inputIm_4').removeAttr('readonly');
        } else {
            $('#inputIm_4').attr('readonly', true);
            $('#inputIm_4').val('');
        }
    }

    function cek_implementasi5() {
        if ($("#imCheckbox_5").prop('checked') == true) {
            $('#inputIm_5').removeAttr('readonly');
        } else {
            $('#inputIm_5').attr('readonly', true);
            $('#inputIm_5').val('');
        }
    }

    // Checkbox Evaluasi
    function cek_eval1() {
        if ($("#evalCheckbox_1").prop('checked') == true) {
            $('#inputEval_1').removeAttr('readonly');
        } else {
            $('#inputEval_1').attr('readonly', true);
            $('#inputEval_1').val('');
        }
    }

    function radio_eval1() {
        if ($("#evalCheckRadio_1").prop('checked') == true) {
            $('[name="evalRadio_1"]').removeAttr('disabled');
        } else {
            $('[name="evalRadio_1"]').attr('disabled', true);
        }
    }

    function cek_eval2() {
        if ($("#evalCheckbox_2").prop('checked') == true) {
            $('#inputEval_2').removeAttr('readonly');
        } else {
            $('#inputEval_2').attr('readonly', true);
            $('#inputEval_2').val('');
        }
    }

    function radio_eval2() {
        if ($("#evalCheckRadio_2").prop('checked') == true) {
            $('[name="evalRadio_2"]').removeAttr('disabled');
        } else {
            $('[name="evalRadio_2"]').attr('disabled', true);
        }
    }

    function radio_eval3() {
        if ($("#evalCheckRadio_3").prop('checked') == true) {
            $('[name="evalRadio_3"]').removeAttr('disabled');
        } else {
            $('[name="evalRadio_3"]').attr('disabled', true);
        }
    }

    function radio_eval4() {
        if ($("#evalCheckRadio_4").prop('checked') == true) {
            $('[name="evalRadio_4"]').removeAttr('disabled');
        } else {
            $('[name="evalRadio_4"]').attr('disabled', true);
        }
    }

    function cek_eval5() {
        if ($("#evalCheckbox_5").prop('checked') == true) {
            $('#inputEval_5').removeAttr('readonly');
        } else {
            $('#inputEval_5').attr('readonly', true);
            $('#inputEval_5').val('');
        }
    }

    function radio_eval5() {
        if ($("#evalCheckRadio_5").prop('checked') == true) {
            $('[name="evalRadio_5"]').removeAttr('disabled');
        } else {
            $('[name="evalRadio_5"]').attr('disabled', true);
        }
    }
</script>

</html>