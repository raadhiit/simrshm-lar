<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PDF Lembar Konsultasi</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
        .half_column {
            float: left;
            width: 50%;
            border: 1px solid;
        }

        .half_column2 {
            float: left;
            width: 50%;
        }

        #data_diri_header tr td {
            font-size: 10px;
            vertical-align: top;
        }

        #data_diri_ttd tr td {
            font-size: 14px;
            vertical-align: top;
        }

        #list_numbering li {
            font-size: 14px;
            list-style-type: decimal;
        }

        #list_alfabeth li {
            font-size: 14px;
            list-style-type: lower-alpha;
        }

        p {
            font-size: 14px;
        }

        .table_isian td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .table_isian2 tr {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 14px;
        }

        /*.table_isian2 th {*/
        /*    border: 1px solid black;*/
        /*    border-collapse: collapse;*/
        /*    font-size: 14px;*/
        /*    height: 150px;*/
        /*}*/

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            color: #111;
        }

        .pagenum:before {
            content: counter(page);
        }

        .page_break {
            page-break-before: always;
        }

        .rotate {
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            width: 1.5em;
        }

        .rotate div {
            -moz-transform: rotate(-90.0deg); /* FF3.5+ */
            -o-transform: rotate(-90.0deg); /* Opera 10.5 */
            -webkit-transform: rotate(-90.0deg); /* Saf3.1+, Chrome */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083); /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
            margin-left: -10em;
            margin-right: -10em;
        }

        .col-print-1 {
            width: 8%;
            float: left;
        }

        .col-print-2 {
            width: 16%;
            float: left;
        }

        .col-print-3 {
            width: 25%;
            float: left;
        }

        .col-print-4 {
            width: 33%;
            float: left;
        }

        .col-print-5 {
            width: 42%;
            float: left;
        }

        .col-print-6 {
            width: 50%;
            float: left;
        }

        .col-print-7 {
            width: 58%;
            float: left;
        }

        .col-print-8 {
            width: 66%;
            float: left;
        }

        .col-print-9 {
            width: 75%;
            float: left;
        }

        .col-print-10 {
            width: 83%;
            float: left;
        }

        .col-print-11 {
            width: 92%;
            float: left;
        }

        .col-print-12 {
            width: 100%;
            float: left;
        }

        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
            border: 0;
            padding: 0;
            margin-left: -0.00001;
        }
    </style>
</head>

<body>
<div class="row" style="width: 100%; margin-left: 0; font-size: 12px;">
    <div class="col-lg-12 text-right">MR 02.15.003.REV.0</div>
</div>
<div class="row" style="width:96.7%; margin-left: 0px">
    <div class="half_column text-center" style="padding: 10px; height:85px;">
        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 50px; text-align: center">
        <p style="font-weight: bold; font-size: 10px; line-height: 1em;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). <br> Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
        {{-- <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 20%;">
        <p style="font-weight: bold; padding-left: 60px; text-align: center; margin-top:-75px;">
            RUMAH SAKIT HARAPAN MULIA<br>
            <span style="font-weight: normal; font-size: 14px">
                Jl. Raya Cibarusah No. 5 Kebon Kopi
                <br>Cibarusah Jaya
                <br>Kabupaten Bekasi Jawa Barat (17340).
                <br>Telp.: (021) 8995 2340
                <br>Email : info@rumahsakit-harapanmulia.id
            </span>
        </p> --}}
    </div>
    <div class="half_column" style="height: 105px;">
        <table id="tabel_kop_identitas" style="font-size: 12px; margin-top: 20px; line-height: 1em">
            <tr>
                <td style="padding-left: 10px;">Nama</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->nama_pasien }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">No. Rekam Medis</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->nrm }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Tgl Lahir</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Jenis Kelamin</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">NIK</td>
                <td style="pl-2 pr-2"> :</td>
                <td>{{ $pasien->ktp }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background-color: rgb(222, 222, 222); margin-top: -2px; border: 1px solid; "
        class="text-center">
        <b style="text-align: center; justify-items: center; color: black; font-size: 13px;">LEMBAR KONSULTASI</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 50%">&nbsp;&nbsp;
                        <b>Kepada Yth : </b>
                        {{ $data ? $data->nama_konsul : '' }}
                    </td>
                    <td>&nbsp;&nbsp;
                      <b>Spesialis : </b> {{ $data ? $data->spesialis : '' }}

                    </td>
                </tr>
            </table> 
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width:96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; font-style: italic;" class="table_isian">
                <tr>
                    <td style="font-size: 10px; width: 50%">&nbsp;&nbsp;
                        *Lingkari pilihan nomor sesuai kebutuhan
                    </td>
                    <td style="font-size: 10px;">&nbsp;&nbsp;
                        (Coret yang tidak perlu*)
                    </td>
                </tr>
            </table> 
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width:96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; margin: 0px;" class="table_isian">
                <tr>
                    <td style="width: 50%;line-height: 1em; padding-top: 2px; padding-left: 10px;" >
                        Dengan hormat, <br>
                        Mohon bantuan sejawat atas pasien berikut untuk : <br>
                        <span style="font-weight: bold">
                            {{ $data ? $data->sejawat : '' }}
                        </span>
                        
                        {{-- <ul style="list-style-type: none;">
                            <li>
                                1. Konsultasi/Tindakan* masalah medis saat ini 
                                @if($data && $data->sejawat == 'Konsultasi/Tindakan* masalah medis saat ini')
                                    <strong>&#x2713;</strong>
                                @endif
                            </li>
                            <li>
                                2. Mengambil alih kasus ini selanjutnya 
                                @if($data && $data->sejawat == 'Mengambil alih kasus ini selanjutnya')
                                    <strong>&#x2713;</strong>
                                    <strong>&#x2713;</strong>
                                @endif
                            </li>
                            <li>
                                3. Perawatan bersama untuk selanjutnya 
                                @if($data && $data->sejawat == 'Perawatan bersama untuk selanjutnya')
                                    <strong>&#x2713;</strong>
                                @endif
                            </li>
                        </ul> --}}
                    </td>
                    <td style="padding-left: 10px;">
                        Jenis Konsul : {{ $data ? $data->jenis_konsul : '' }} <br>
                        <p>Tanggal : {{ $data ? date('d-m-Y H:i', strtotime($data->tanggal)) : date('d-m-Y H:i', strtotime($dokumen->created_at)) }} WIB</p>
                    </td>
                </tr>
            </table> 
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width:96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr>
                    <td style="width: 50%; padding-left: 10px; line-height: 1em; padding-top: 5px;" >
                        <b>Keterangan klinis terpenting adalah : </b> <br>
                        {{ $data ? $data->keterangan_klinis : '' }}
                        <br>
                        <span>
                            <b> Diagnosa : </b> {{ $data ? $data->diagnosa : '' }}
                        </span> <br><br>
                        <span style="margin-top: 5px">
                            Terima Kasih,<br>
                            <img class="mt-2" src="{{ env('SMIS_UPLOAD_URL').'/'.($employee_konsul ? $employee_konsul->ttd : '') }}" alt="" style="width: 4cm; height: 2.5cm;">

                            <br>
                            ({{ $data->nama_konsul }}) <br>
                        </span>
                    </td>
                </tr>
            </table> 
        </div>
    </div>
</div>
<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background-color: rgb(222, 222, 222); margin-top: -2px; border: 1px solid;"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: black; font-size: 13px;">JAWABAN KONSUL</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width:96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr>
                    <td style="width: 50%; padding-left: 10px; line-height: 1em; padding-top: 5px;" >
                        Dengan Hormat, <br>
                        <b>Sesuai dengan permohonan konsultasi, pada kasus ini dijumpai : </b> <br>
                        {{ $data ? $data->temuan : '' }}
                        <br><br>
                        <b> Keluhan :</b><br>
                        {{ $data ? $data->keluhan : '' }}
                        <br><br>
                        <span style="line-height: 1.5em">
                            <b>Saran tindakan medik/pengobatan : </b>
                            {{ $data ? $data->saran_tindakan : '' }} <br>
                            <b>Konsultasi ulang tanggal : </b>
                            {{-- {{ $data ? date('d-m-Y', strtotime($data->konsultasi_ulang)) }}  --}}
                            {{ date('d-m-Y', strtotime($data->konsultasi_ulang)) }}
                            <br>
                            <b> Tindakan Khusus : </b> 
                            {{ $data ? $data->tindakan_khusus : '' }}
                            <br><br>
                        </span>

                        <span style="margin-top: 5px">
                            Terima Kasih,<br>
                            Bekasi, {{ $data ? date('d-m-Y H:i', strtotime($data->tanggal_verifikasi)) : date('d-m-Y H:i', strtotime($dokumen->tanggal_verifikasi)) }} WIB <br>
                            <img class="mt-2" src="{{ env('SMIS_UPLOAD_URL').'/'.($employee_jawab ? $employee_jawab->ttd : '') }}" alt="" style="width: 4cm; height: 2.5cm;">

                            <br>
                            ({{ $data->nama_jawab }}) <br>
                        </span>
                    </td>
                </tr>
            </table> 
        </div>
    </div>
</div>

