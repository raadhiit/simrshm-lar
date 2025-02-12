<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rencana Keperawatan Intra-Operasi</title>
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

        @media only screen and (min-width: 500px) {
            .logo-rshm {
                object-fit: contain;
            }
        }

        #tabel_assessment tr td {
            border: 1px solid transparent;
            line-height: 1.15;
            padding-top: 5px;
            padding-bottom: 5px;
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
        {{-- Header --}}
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
                    <h6 style="color: white">RENCANA KEPERAWATAN INTRA - OPERASI</h6>
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
                    <!-- Assessment Section -->
                    <tr>
                        <td class="">
                            <div>TTV</div>
                            <table style="border-collapse: collapse;" id="tabel_assessment">
                                <tr>
                                    <td style="text-align: right;">TD</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->td : '' }}" style="width: 100px" id="assesment_td"> mmHg
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">N</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->n : '' }}" style="width: 100px" id="assesment_n"> X/m
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Suhu</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->suhu : '' }}" style="width: 100px" id="assesment_suhu"> °C
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">RR</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->rr : '' }}" style="width: 100px" id="assesment_rr"> X/m
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Sp. O2</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->spo2 : '' }}" style="width: 100px" id="assesment_spo2"> %
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Perdarahan</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->pendarahan : '' }}" style="width: 100px" id="assesment_pendarahan"> cc
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Suction</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->suction : '' }}" style="width: 100px" id="assesment_suction"> cc
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Irigasi/Pencucian</td>
                                    <td> : </td>
                                    <td>
                                        <input type="text" class="form-dotted" value="{{ $assessment ? $assessment->irigasi : '' }}" style="width: 100px" id="assesment_irigasi"> cc
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <!-- Diagnosa Keperawatan Section -->
                        <td>
                            {{-- Diagnosa 1 --}}
                            {{-- Resiko Infeksi 1 --}}
                            <div>
                                <strong>dx. No.</strong>
                                <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[0]->dx_no : '' }}" id="dx_no_1">
                            </div>
                            <h6 class="mt-2">Resiko Infeksi b.d</h6>
                            <div class="checkbox-container">
                                <input type="checkbox" id="diagnosa_1_terjadinya_kontinuitas_jaringan" {{ $diagnosa_keperawatan ? in_array('Terjadinya Kontinuitas', $diagnosa_keperawatan[0]->value) ? 'checked' : '' : '' }} value="Terjadinya Kontinuitas Jaringan"> Terjadinya Kontinuitas Jaringan
                                <br>
                                <input type="checkbox" id="diagnosa_1_masuknya_mikroorganisme" {{ $diagnosa_keperawatan ? in_array('Masuknya Mikroorganisme', $diagnosa_keperawatan[0]->value) ? 'checked' : '' : '' }} value="Masuknya Mikroorganisme"> Masuknya Mikroorganisme
                                <br>
                                <input type="checkbox" id="diagnosa_1_lainnya" value="Lain" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[0]->value) ? 'checked' : '' : '' }}> <input type="text" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[0]->isian : '' }}" class="form-dotted" id="isian_diagnosa_1_lainnya">
                            </div>
                            <br>

                            {{-- Diagnosa 2 --}}
                            {{-- Hipotermi --}}
                            <div>
                                <strong>dx. No.</strong>
                                <input type="text" class="form-dotted" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[1]->dx_no : '' }}" id="dx_no_2">
                            </div>
                            <h6 class="mt-2"> Hipotermi b.d</h6>
                            <div class="checkbox-container">
                                <input type="checkbox" id="diagnosa_2_penggunaan_ac" {{ $diagnosa_keperawatan ? in_array('Penggunaan AC', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} value="Penggunaan AC"> Penggunaan AC<br>
                                <input type="checkbox" id="diagnosa_2_proses_anestesi" {{ $diagnosa_keperawatan ? in_array('Proses Anestesi', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} value="Proses Anestesi"> Proses Anestesi<br />
                                <input type="checkbox" id="diagnosa_2_lainnya" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[1]->value) ? 'checked' : '' : '' }} value="Lain"> <input type="text" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[1]->isian : '' }}" class="form-dotted" id="isian_diagnosa_2_lainnya">
                            </div>
                            <br>
                            {{-- Diagnosa 3 --}}
                            {{-- Resiko cidera --}}
                            <div>
                                <strong>dx. No.</strong>
                                <input type="text" class="form-dotted" id="dx_no_3" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[2]->dx_no : '' }}">
                            </div>
                            <h6 class="mt-2"> Resiko Cidera b.d</h6>
                            <div class="checkbox-container">
                                <input type="checkbox" id="diagnosa_3_pemakaian_esu" {{ $diagnosa_keperawatan ? in_array('Pemakaian ESU Monopolar/Bipolar', $diagnosa_keperawatan[2]->value) ? 'checked' : '' : '' }} value="Pemakaian ESU Monopolar/Bipolar"> Pemakaian ESU Monopolar/Bipolar
                                <br>
                                <input type="checkbox" id="diagnosa_3_posisi_tidak_tepat" {{ $diagnosa_keperawatan ? in_array('Posisi Tidak Tepat Selama Pembedahan', $diagnosa_keperawatan[2]->value) ? 'checked' : '' : '' }} value="Posisi Tidak Tepat Selama Pembedahan"> Posisi Tidak Tepat Selama Pembedahan
                                <br>
                                <input type="checkbox" id="diagnosa_3_lainnya" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[2]->value) ? 'checked' : '' : '' }} value="Lain"> <input type="text" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[2]->isian : '' }}" class="form-dotted" id="isian_diagnosa_3_lainnya">
                            </div>
                            <br>

                            {{-- Diagnosa 4 --}}
                            {{-- Gangguan Jalan Napas --}}
                            <div>
                                <strong>dx. No.</strong>
                                <input type="text" class="form-dotted" id="dx_no_4" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[3]->dx_no : '' }}">
                            </div>
                            <h6 class="mt-2 text-wrap"> Gangguan Jalan Napas : Pola Napas Pertukaran Gas b.d</h6>
                            <div class="checkbox-container">
                                <input type="checkbox" id="diagnosa_4_pemakaian_esu" {{ $diagnosa_keperawatan ? in_array('Pemakaian ESU Monopolar/Bipolar', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} value="Pemakaian ESU Monopolar/Bipolar"> Pemakaian ESU Monopolar/Bipolar
                                <br>
                                <input type="checkbox" id="diagnosa_4_posisi_tidak_tepat" {{ $diagnosa_keperawatan ? in_array('Posisi Tidak Tepat Selama Pembedahan', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} value="Posisi Tidak Tepat Selama Pembedahan"> Posisi Tidak Tepat Selama Pembedahan
                                <br>
                                <input type="checkbox" id="diagnosa_4_lainnya" {{ $diagnosa_keperawatan ? in_array('Lain', $diagnosa_keperawatan[3]->value) ? 'checked' : '' : '' }} value="Lain"> <input type="text" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[3]->isian : '' }}" class="form-dotted" id="isian_diagnosa_4_lainnya">
                            </div> <br>

                            {{-- Diagnosa 5 --}}
                            {{-- input checkbox --}}
                            <div>
                                <strong>dx. No.</strong>
                                <input type="text" class="form-dotted" id="dx_no_5" value="{{ $diagnosa_keperawatan ? $diagnosa_keperawatan[4]->dx_no : '' }}">
                            </div>
                        </td>

                        <!-- Rencana Keperawatan Section -->
                        <td>
                            {{-- Rencana Keperawatan 1 --}}
                            <div>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->identifikasi_jenis_luka ? 'checked' : '' : '' }} id="identifikasi_jenis_luka" value="Identifikasi Jenis Luka"> Identifikasi Jenis Luka
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->laksanakan_prinsip_aseptik_dan_antiseptik ? 'checked' : '' : '' }} id="laksanakan_prinsip_aseptik_dan_antiseptik" value="Laksanakan Prinsip Aseptik dan Antiseptik"> Laksanakan Prinsip Aseptik dan Antiseptik
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->lakukan_preparasi_kulit_area_operasi ? 'checked' : '' : '' }} id="lakukan_preparasi_kulit_area_operasi" value="Lakukan Preparasi Kulit Area Operasi"> Lakukan Preparasi Kulit Area Operasi
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->batasi_personil_di_kamar_operasi ? 'checked' : '' : '' }} id="batasi_personil_di_kamar_operasi" value="Batasi Personil di Kamar Operasi"> Batasi Personil di Kamar Operasi
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->gunakan_teknik_steril ? 'checked' : '' : '' }} id="gunakan_teknik_steril" value="Gunakan Teknik Steril"> Gunakan Teknik Steril
                            </div>

                            {{-- Rencana Keperawatan 2 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pastikan_suhu_tidak_terlalu_dingin ? 'checked' : '' : '' }} id="pastikan_suhu_tidak_terlalu_dingin" class="mt-2" value="Pastikan Suhu Tidak Terlalu Dingin"> Pastikan Suhu Tidak Terlalu Dingin
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->kolaborasi_dengan_dokter_pemberian_operasi ? 'checked' : '' : '' }} id="rencana_keperawatan_kolaborasi_dengan_dokter_pemberian_operasi" value="Kolaborasi dengan Dokter Pemberian Operasi"> Kolaborasi dengan Dokter Pemberian Operasi
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pastikan_suhu_di_anatas_20_22_c ? 'checked' : '' : '' }} id="pastikan_suhu_di_anatas_20_22_c" value="Pastikan Suhu di Anatas 20-22 °C"> Pastikan Suhu di Anatas 20-22 °C
                            </div>

                            {{-- Rencana Keperawatan 3 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pastikan_posisi_pasien_selama_operasi ? 'checked' : '' : '' }} id="pastikan_posisi_pasien_selama_operasi" class="mt-5" value="Pastikan Posisi Pasien Selama Operasi"> Pastikan Posisi Pasien Selama Operasi
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pastikan_neutral_pad_terpasang ? 'checked' : '' : '' }} id="pastikan_neutral_pad_terpasang" value="Pastikan Neutral Pad Terpasang"> Pastikan Neutral Pad Terpasang
                                <br>
                                <input type="checkbox" id="rencana_keperawatan_lain_1" {{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[0]->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" id="isian_rencana_keperawatan_lain_1" value="{{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[0]->isian : '' }}">
                            </div>

                            {{-- Rencana Keperawatan 4 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->pastikan_o2_terpasang_dengan_baik ? 'checked' : '' : '' }} id="pastikan_o2_terpasang_dengan_baik" class="mt-5" value="Pastikan O2 Terpasang dengan Baik"> Pastikan O2 Terpasang dengan Baik
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->monitor_vital_sign ? 'checked' : '' : '' }} id="rencana_keperawatan_monitor_vital_sign" value="Monitor Vital Sign"> Monitor Vital Sign
                                <br>
                                <input type="checkbox" {{ $rencana_keperawatan ? $rencana_keperawatan->monitor_ett ? 'checked' : '' : '' }} id="rencana_keperawatan_monitor_ett" value="Monitor ETT/LMA"> Monitor ETT/LMA
                                <br>
                                <input type="checkbox" id="rencana_keperawatan_lain_2" {{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[1]->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" id="isian_rencana_keperawatan_lain_2" value="{{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[1]->isian : '' }}">
                            </div>

                            {{-- Rencana Keperawatan 5 --}}
                            {{-- input checkbox --}}
                            <div class="mt-5">
                                <input type="checkbox" class="mt-4" id="rencana_keperawatan_lain_3" {{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[2]->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" id="isian_rencana_keperawatan_lain_3" value="{{ $rencana_keperawatan ? $rencana_keperawatan->lainnya[2]->isian : '' }}">
                            </div>
                        </td>

                        <!-- Implementasi Section -->
                        <td>
                            {{-- Implementasi 1 --}}
                            <div>
                                <input type="checkbox" {{ $implementasi ? $implementasi->mengidentifikasi_jenis_luka ? 'checked' : '' : '' }} id="mengidentifikasi_jenis_luka" value="Mengidentifikasi Jenis Luka"> Mengidentifikasi Jenis Luka
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->melaksanakan_prinsip_aseptik_dan_antiseptik ? 'checked' : '' : '' }} id="melaksanakan_prinsip_aseptik_dan_antiseptik" value="Melaksanakan Prinsip Aseptik dan Antiseptik"> Melaksanakan Prinsip Aseptik dan Antiseptik
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->melakukan_preparasi_kulit_area_operasi ? 'checked' : '' : '' }} id="melakukan_preparasi_kulit_area_operasi" value="Melakukan Preparasi Kulit Area Operasi"> Melakukan Preparasi Kulit Area Operasi
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->membatasi_personil_di_kamar_operasi ? 'checked' : '' : '' }} id="membatasi_personil_di_kamar_operasi" value="Membatasi Personil di Kamar Operasi"> Membatasi Personil di Kamar Operasi
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->menggunakan_teknik_steril ? 'checked' : '' : '' }} id="menggunakan_teknik_steril" value="Menggunakan Teknik Steril"> Menggunakan Teknik Steril
                            </div>

                            {{-- Implementasi 2 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $implementasi ? $implementasi->memastikan_suhu_tidak_terlalu_dingin ? 'checked' : '' : '' }} id="memastikan_suhu_tidak_terlalu_dingin" class="mt-2" value="Memastikan Suhu Tidak Terlalu Dingin"> Memastikan Suhu Tidak Terlalu Dingin
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->kolaborasi_dengan_dokter_pemberian_operasi ? 'checked' : '' : '' }} id="implementasi_kolaborasi_dengan_dokter_pemberian_operasi" value="Kolaborasi dengan Dokter Pemberian Operasi"> Kolaborasi dengan Dokter Pemberian Operasi
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memastikan_suhu_di_anatas_20_22_c ? 'checked' : '' : '' }} id="memastikan_suhu_di_anatas_20_22_c" value="Memastikan Suhu di Anatas 20-22 °C"> Memastikan Suhu di Anatas 20-22 °C
                                <br>
                            </div>

                            {{-- Implementasi 3 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $implementasi ? $implementasi->memastikan_posisi_pasien_selama_operasi ? 'checked' : '' : '' }} id="memastikan_posisi_pasien_selama_operasi" class="mt-5" value="Memastikan Posisi Pasien Selama Operasi"> Memastikan Posisi Pasien Selama Operasi
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->memastikan_neutral_pad_terpasang ? 'checked' : '' : '' }} id="memastikan_neutral_pad_terpasang" value="Memastikan Neutral Pad Terpasang"> Memastikan Neutral Pad Terpasang
                                <br>
                                <input type="checkbox" id="implementasi_lain_1" {{ $implementasi ? $implementasi->lainnya[0]->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" id="isian_implementasi_lain_1" value="{{ $implementasi ? $implementasi->lainnya[0]->isian : '' }}">
                            </div>

                            {{-- Implementasi 4 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $implementasi ? $implementasi->memastikan_o2_terpasang_dengan_baik ? 'checked' : '' : '' }} id="memastikan_o2_terpasang_dengan_baik" class="mt-5" value="Memastikan O2 Terpasang dengan Baik"> Memastikan O2 Terpasang dengan Baik
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->monitor_vital_sign ? 'checked' : '' : '' }} id="implementasi_monitor_vital_sign" value="Monitor Vital Sign"> Monitor Vital Sign
                                <br>
                                <input type="checkbox" {{ $implementasi ? $implementasi->monitor_ett ? 'checked' : '' : '' }} id="implementasi_monitor_ett" value="Monitor ETT/LMA"> Monitor ETT/LMA
                                <br>
                                <input type="checkbox" id="implementasi_lain_2" {{ $implementasi ? $implementasi->lainnya[1]->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" id="isian_implementasi_lain_2" value="{{ $implementasi ? $implementasi->lainnya[1]->isian : '' }}">
                            </div>
                            <br>

                            {{-- Implementasi 5 --}}
                            {{-- input checkbox --}}
                            <div class="mt-5">
                                <input class="mt-2" type="checkbox" id="implementasi_lain_3" {{ $implementasi ? $implementasi->lainnya[2]->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" id="isian_implementasi_lain_3" value="{{ $implementasi ? $implementasi->lainnya[2]->isian : '' }}">
                            </div>
                        </td>

                        <!-- Evaluasi Section -->
                        <td>
                            {{-- Evaluasi 1 --}}
                            <div>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[0]->daerah_luka_operasi_tampak_bersih ? 'checked' : '' : '' }} id="daerah_luka_operasi_tampak_bersih"> Daerah Luka Operasi Tampak Bersih<br>
                                {{-- input checkbox --}}
                                <div>
                                    <input type="checkbox" id="evaluasi_1_lainnya" {{ $evaluasi ? $evaluasi[0]->lainnya->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" id="isian_evaluasi_1_lainnya" value="{{ $evaluasi ? $evaluasi[0]->lainnya->isian : '' }}">
                                </div>
                                <input type="checkbox" id="masalah_teratasi_1" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->checked ? 'checked' : '' : '' }}> Masalah teratasi :
                                <br>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_1" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->value == 'ya' ? 'checked' : '' : '' }} value="ya">
                                <label for="eval1-ya">Ya</label>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_1" {{ $evaluasi ? $evaluasi[0]->masalah_teratasi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak">
                                <label for="eval1-tidak">Tidak</label><br>
                            </div>

                            {{-- Evaluasi 2 --}}
                            <div class="mt-5">
                                <input type="checkbox" class="mt-3" {{ $evaluasi ? $evaluasi[1]->pasien_tidak_menggigil ? 'checked' : '' : '' }} id="pasien_tidak_menggigil"> Pasien Tidak Menggigil/Kedinginan<br>
                                {{-- input checkbox --}}
                                <div>
                                    <input type="checkbox" {{ $evaluasi ? $evaluasi[1]->lainnya->checked ? 'checked' : '' : '' }} id="evaluasi_2_lainnya">
                                    <input type="text" class="form-dotted" id="isian_evaluasi_2_lainnya" value="{{ $evaluasi ? $evaluasi[1]->lainnya->isian : '' }}">
                                </div>
                                <input type="checkbox" id="masalah_teratasi_2" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->checked ? 'checked' : '' : '' }}> Masalah teratasi :
                                <br>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_2" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->value == 'ya' ? 'checked' : '' : '' }} value="ya">
                                <label for="eval1-ya">Ya</label>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_2" {{ $evaluasi ? $evaluasi[1]->masalah_teratasi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak">
                                <label for="eval1-tidak">Tidak</label><br>
                            </div>

                            {{-- Evaluasi 3 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->vital_sign_dalam_batas_normal ? 'checked' : '' : '' }} id="vital_sign_dalam_batas_normal" class="mt-2"> Vital Sign dalam batas normal<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->tidak_ada_tanda_dehidrasi ? 'checked' : '' : '' }} id="tidak_ada_tanda_dehidrasi"> Tidak ada tanda dehidrasi<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[2]->intake_output ? 'checked' : '' : '' }} id="intake_output"> Intake Output 24 Jam seimbang<br>
                                <input type="checkbox" id="masalah_teratasi_3" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->checked ? 'checked' : '' : '' }}> Masalah teratasi :
                                <br>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_3" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->value == 'ya' ? 'checked' : '' : '' }} value="ya">
                                <label for="eval1-ya">Ya</label>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_3" {{ $evaluasi ? $evaluasi[2]->masalah_teratasi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak">
                                <label for="eval1-tidak">Tidak</label><br>
                            </div>

                            {{-- Evaluasi 4 --}}
                            <div class="mt-5">
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->rr_dalam_batas_normal ? 'checked' : '' : '' }} id="rr_dalam_batas_normal" class="mt-1"> RR Dalam Batas Normal<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->jalan_napas_adekuat ? 'checked' : '' : '' }} id="jalan_napas_adekuat"> Jalan Napas Adekuat<br>
                                <input type="checkbox" {{ $evaluasi ? $evaluasi[3]->tidak_ada_sianosis ? 'checked' : '' : '' }} id="tidak_ada_sianosis"> Tidak Ada Sianosis<br>
                                <input type="checkbox" id="masalah_teratasi_4" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->checked ? 'checked' : '' : '' }}> Masalah teratasi :
                                <br>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_4" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->value == 'ya' ? 'checked' : '' : '' }} value="ya">
                                <label for="eval1-ya">Ya</label>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_4" {{ $evaluasi ? $evaluasi[3]->masalah_teratasi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak">
                                <label for="eval1-tidak">Tidak</label><br>
                            </div>
                            <br>

                            {{-- Evaluasi 5 --}}
                            <div class="mt-4">
                                {{-- input checkbox --}}
                                <div>
                                    <input type="checkbox" id="evaluasi_5_lainnya" {{ $evaluasi ? $evaluasi[4]->lainnya->checked ? 'checked' : '' : '' }}> <input type="text" class="form-dotted" value="{{ $evaluasi ? $evaluasi[4]->lainnya->isian : '' }}" id="isian_evaluasi_5_lainnya">
                                </div>
                                <input type="checkbox" id="masalah_teratasi_5" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->checked ? 'checked' : '' : '' }}> Masalah teratasi :
                                <br>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_5" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->value == 'ya' ? 'checked' : '' : '' }} value="ya">
                                <label for="eval1-ya">Ya</label>
                                <input type="radio" class="ml-2" name="pilihan_masalah_teratasi_5" {{ $evaluasi ? $evaluasi[4]->masalah_teratasi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak">
                                <label for="eval1-tidak">Tidak</label>
                                <br>
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
                    class="btn btn-success hidden-on-print" target="_blank">Download PDF</a>
                @endif
            </div>
        </div> -->

        {{-- Form Assesment  --}}
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

        let assessment = {
            'td': $('#assesment_td').val(),
            'n': $('#assesment_n').val(),
            'suhu': $('#assesment_suhu').val(),
            'rr': $('#assesment_rr').val(),
            'spo2': $('#assesment_spo2').val(),
            'pendarahan': $('#assesment_pendarahan').val(),
            'suction': $('#assesment_suction').val(),
            'irigasi': $('#assesment_irigasi').val(),
        }

        let diagnosa_keperawatan = [null, null, null, null, null];

        let diagnosa_0 = [];

        if ($('#diagnosa_1_terjadinya_kontinuitas_jaringan').is(':checked')) {
            diagnosa_0.push($('#diagnosa_1_terjadinya_kontinuitas_jaringan').val());
        }

        if ($('#diagnosa_1_masuknya_mikroorganisme').is(':checked')) {
            diagnosa_0.push($('#diagnosa_1_masuknya_mikroorganisme').val());
        }

        if ($('#diagnosa_1_lainnya').is(':checked')) {
            diagnosa_0.push($('#diagnosa_1_lainnya').val());
        }

        let diagnosa_1 = [];

        if ($('#diagnosa_2_penggunaan_ac').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_penggunaan_ac').val());
        }

        if ($('#diagnosa_2_proses_anestesi').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_proses_anestesi').val());
        }

        if ($('#diagnosa_2_lainnya').is(':checked')) {
            diagnosa_1.push($('#diagnosa_2_lainnya').val());
        }

        let diagnosa_2 = [];

        if ($('#diagnosa_3_pemakaian_esu').is(':checked')) {
            diagnosa_2.push($('#diagnosa_3_pemakaian_esu').val());
        }

        if ($('#diagnosa_3_posisi_tidak_tepat').is(':checked')) {
            diagnosa_2.push($('#diagnosa_3_posisi_tidak_tepat').val());
        }

        if ($('#diagnosa_3_lainnya').is(':checked')) {
            diagnosa_2.push($('#diagnosa_3_lainnya').val());
        }

        let diagnosa_3 = [];

        if ($('#diagnosa_4_pemakaian_esu').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_pemakaian_esu').val());
        }

        if ($('#diagnosa_4_posisi_tidak_tepat').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_posisi_tidak_tepat').val());
        }

        if ($('#diagnosa_4_lainnya').is(':checked')) {
            diagnosa_3.push($('#diagnosa_4_lainnya').val());
        }

        diagnosa_keperawatan[0] = {
            'dx_no': $('#dx_no_1').val(),
            'value': diagnosa_0,
            'isian': $('#isian_diagnosa_1_lainnya').val()
        };

        diagnosa_keperawatan[1] = {
            'dx_no': $('#dx_no_2').val(),
            'value': diagnosa_1,
            'isian': $('#isian_diagnosa_2_lainnya').val()
        };

        diagnosa_keperawatan[2] = {
            'dx_no': $('#dx_no_3').val(),
            'value': diagnosa_2,
            'isian': $('#isian_diagnosa_3_lainnya').val()
        };

        diagnosa_keperawatan[3] = {
            'dx_no': $('#dx_no_4').val(),
            'value': diagnosa_3,
            'isian': $('#isian_diagnosa_4_lainnya').val()
        };

        diagnosa_keperawatan[4] = {
            'dx_no': $('#dx_no_5').val()
        }

        let rencana_keperawatan = {
            'identifikasi_jenis_luka': $('#identifikasi_jenis_luka').is(':checked') ? 1 : 0,
            'laksanakan_prinsip_aseptik_dan_antiseptik': $('#laksanakan_prinsip_aseptik_dan_antiseptik').is(':checked') ? 1 : 0,
            'lakukan_preparasi_kulit_area_operasi': $('#lakukan_preparasi_kulit_area_operasi').is(':checked') ? 1 : 0,
            'batasi_personil_di_kamar_operasi': $('#batasi_personil_di_kamar_operasi').is(':checked') ? 1 : 0,
            'gunakan_teknik_steril': $('#gunakan_teknik_steril').is(':checked') ? 1 : 0,
            'pastikan_suhu_tidak_terlalu_dingin': $('#pastikan_suhu_tidak_terlalu_dingin').is(':checked') ? 1 : 0,
            'kolaborasi_dengan_dokter_pemberian_operasi': $('#rencana_keperawatan_kolaborasi_dengan_dokter_pemberian_operasi').is(':checked') ? 1 : 0,
            'pastikan_suhu_di_anatas_20_22_c': $('#pastikan_suhu_di_anatas_20_22_c').is(':checked') ? 1 : 0,
            'pastikan_posisi_pasien_selama_operasi': $('#pastikan_posisi_pasien_selama_operasi').is(':checked') ? 1 : 0,
            'pastikan_neutral_pad_terpasang': $('#pastikan_neutral_pad_terpasang').is(':checked') ? 1 : 0,
            'pastikan_o2_terpasang_dengan_baik': $('#pastikan_o2_terpasang_dengan_baik').is(':checked') ? 1 : 0,
            'monitor_vital_sign': $('#rencana_keperawatan_monitor_vital_sign').is(':checked') ? 1 : 0,
            'monitor_ett': $('#rencana_keperawatan_monitor_ett').is(':checked') ? 1 : 0,
            'lainnya': [{
                'checked': $('#rencana_keperawatan_lain_1').is(':checked') ? 1 : 0,
                'isian': $('#isian_rencana_keperawatan_lain_1').val()
            }, {
                'checked': $('#rencana_keperawatan_lain_2').is(':checked') ? 1 : 0,
                'isian': $('#isian_rencana_keperawatan_lain_2').val()
            }, {
                'checked': $('#rencana_keperawatan_lain_3').is(':checked') ? 1 : 0,
                'isian': $('#isian_rencana_keperawatan_lain_3').val()
            }],
        }

        let implementasi = {
            'mengidentifikasi_jenis_luka': $('#mengidentifikasi_jenis_luka').is(':checked') ? 1 : 0,
            'melaksanakan_prinsip_aseptik_dan_antiseptik': $('#melaksanakan_prinsip_aseptik_dan_antiseptik').is(':checked') ? 1 : 0,
            'melakukan_preparasi_kulit_area_operasi': $('#melakukan_preparasi_kulit_area_operasi').is(':checked') ? 1 : 0,
            'membatasi_personil_di_kamar_operasi': $('#membatasi_personil_di_kamar_operasi').is(':checked') ? 1 : 0,
            'menggunakan_teknik_steril': $('#menggunakan_teknik_steril').is(':checked') ? 1 : 0,
            'memastikan_suhu_tidak_terlalu_dingin': $('#memastikan_suhu_tidak_terlalu_dingin').is(':checked') ? 1 : 0,
            'kolaborasi_dengan_dokter_pemberian_operasi': $('#implementasi_kolaborasi_dengan_dokter_pemberian_operasi').is(':checked') ? 1 : 0,
            'memastikan_suhu_di_anatas_20_22_c': $('#memastikan_suhu_di_anatas_20_22_c').is(':checked') ? 1 : 0,
            'memastikan_posisi_pasien_selama_operasi': $('#memastikan_posisi_pasien_selama_operasi').is(':checked') ? 1 : 0,
            'memastikan_neutral_pad_terpasang': $('#memastikan_neutral_pad_terpasang').is(':checked') ? 1 : 0,
            'memastikan_o2_terpasang_dengan_baik': $('#memastikan_o2_terpasang_dengan_baik').is(':checked') ? 1 : 0,
            'monitor_vital_sign': $('#implementasi_monitor_vital_sign').is(':checked') ? 1 : 0,
            'monitor_ett': $('#implementasi_monitor_ett').is(':checked') ? 1 : 0,
            'lainnya': [{
                'checked': $('#implementasi_lain_1').is(':checked') ? 1 : 0,
                'isian': $('#isian_implementasi_lain_1').val()
            }, {
                'checked': $('#implementasi_lain_2').is(':checked') ? 1 : 0,
                'isian': $('#isian_implementasi_lain_2').val()
            }, {
                'checked': $('#implementasi_lain_3').is(':checked') ? 1 : 0,
                'isian': $('#isian_implementasi_lain_3').val()
            }],
        }

        let evaluasi = [{
            'daerah_luka_operasi_tampak_bersih': $('#daerah_luka_operasi_tampak_bersih').is(':checked') ? 1 : 0,
            'lainnya': {
                'checked': $('#evaluasi_1_lainnya').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_1_lainnya').val()
            },
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_1').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_1]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_1]:checked').val() : ''
            },
        }, {
            'pasien_tidak_menggigil': $('#pasien_tidak_menggigil').is(':checked') ? 1 : 0,
            'lainnya': {
                'checked': $('#evaluasi_2_lainnya').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_2_lainnya').val()
            },
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_2').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_2]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_2]:checked').val() : ''
            },
        }, {
            'tidak_ada_tanda_dehidrasi': $('#tidak_ada_tanda_dehidrasi').is(':checked') ? 1 : 0,
            'vital_sign_dalam_batas_normal': $('#vital_sign_dalam_batas_normal').is(':checked') ? 1 : 0,
            'intake_output': $('#intake_output').is(':checked') ? 1 : 0,
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_3').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_3]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_3]:checked').val() : ''
            },
        }, {
            'rr_dalam_batas_normal': $('#rr_dalam_batas_normal').is(':checked') ? 1 : 0,
            'jalan_napas_adekuat': $('#jalan_napas_adekuat').is(':checked') ? 1 : 0,
            'tidak_ada_sianosis': $('#tidak_ada_sianosis').is(':checked') ? 1 : 0,
            'masalah_teratasi': {
                'checked': $('#masalah_teratasi_4').is(':checked') ? 1 : 0,
                'value': $('[name=pilihan_masalah_teratasi_4]:checked').val() != undefined ? $('[name=pilihan_masalah_teratasi_4]:checked').val() : ''
            },
        }, {
            'lainnya': {
                'checked': $('#evaluasi_5_lainnya').is(':checked') ? 1 : 0,
                'isian': $('#isian_evaluasi_5_lainnya').val()
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
            url: "{{ url('e_rekam_medis/rencana_keperawatan_intra_operasi/store') }}",
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