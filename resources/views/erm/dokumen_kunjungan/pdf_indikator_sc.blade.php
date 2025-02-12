<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Orientasi Pasien Baru</title>

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

        .table_isian {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .table_isian td {
        }

        .table_isian_bordered td {
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
@php
    /**
    * @param \App\Models\SmisDocIndikatorSc|null $data_sc ,
    * @param string $key,
    * @param mixed $value
    */
    function check_input($data_sc, $key, $value) {
        return !empty($data_sc) && $data_sc->$key == $value;
    }

    function is_checkbox(string $key) {
        return strpos($key, 'belas_') && $key != 'sc_tujuhbelas_i';
    }
@endphp

<div class="row" style="width:96.7%; margin-left: 0px">
    <div class="half_column" style="padding: 10px; height:120px;">
        <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 20%;">
        <p style="font-weight: bold; padding-left: 60px; text-align: center; margin-top:-75px;">
            RUMAH SAKIT HARAPAN MULIA<br>
            <span style="font-weight: normal; font-size: 14px">
                Jl. Raya Cibarusah No. 5 Kebon Kopi
                <br>Cibarusah Jaya
                <br>Kabupaten Bekasi Jawa Barat (17340).
                <br>Telp.: (021) 8995 2340
                <br>Email : info@rumahsakit-harapanmulia.id
            </span>
        </p>
    </div>
    <div class="half_column" style="height: 140px;">
        <table id="tabel_kop_identitas" style="font-size: 12px;">
            <tr>
                <td style="padding-left: 10px;">Nama</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $pasien->nama ?? $ookumen->nama_pasien }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">No. Rekam Medis</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $pasien->id ?? $dokumen->nrm }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Tgl Lahir</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Jenis Kelamin</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $pasien->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">NIK</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $pasien->id ?? $dokumen->nrm }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background: black; margin-top: -2px; padding-bottom: 5px; border: 1px solid"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: white">INDIKATOR PROSES SC</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-bottom: 15px;">
        <div class="col-md-12">
            <div class="col-md-12">
                Tanggal : <span style="border-bottom: 1px dotted">{{ $indikator_sc->tanggal ?? '' }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian_bordered">
                <thead style="text-align: center">
                    <td style="width: 5%;">
                        <b>NO</b>
                    </td>
                    <td>
                        <b>Indikator</b>
                    </td>
                    <td style="width: 15%;">
                        <b>Ya</b>
                    </td>
                    <td style="width: 15%;">
                        <b>Tidak</b>
                    </td>
                </thead>

                <tbody>
                @foreach($rows['sc'] as $key => $value)
                    {!! $value['raw_html'] !!}
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="width: 100%; height: 520px;"></div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background: black; padding-bottom: 5px; border: 1px solid"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: white;">INDIKATOR LUARAN (PER REKAM MEDIS)</b>
    </div>
</div>

<div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
    <div class="col-md-12">
        <table style="width: 100%;" class="table_isian_bordered">
            <thead style="text-align: center">
            <td style="width: 5%;">
                <b>NO</b>
            </td>
            <td>
                <b>Indikator</b>
            </td>
            <td style="width: 15%;">
                <b>Ya</b>
            </td>
            <td style="width: 15%;">
                <b>Tidak</b>
            </td>
            </thead>

            <tbody>
            @foreach($rows['luaran'] as $key => $value)
                {!! $value['raw_html'] !!}
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<br/>

<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table table-bordered custom-table">
                <tr>
                    <td style="width: 30%;">Nama</td>
                    <td style="width: 70%;">
                        : {{ $pasien->nama ?? $dokumen->nama_pasien  }}"
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">Tanggal Pengisian</td>
                    <td style="width: 70%;">
                        : {{ $indikator_sc->tanggal ?? $dokumen->tanggal_pengisian }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="d-flex align-items-center justify-content-center" style="width: 100%; height: auto; padding: 20px 0;">
                        Dengan ini menyatakan bahwa data yang<br/>diisi pada Assesmen Diri ini adalah benar.
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pengisian</td>
                    <td colspan="2" class="d-block" style="padding: 4px 0;">
                        <img
                            src="{{ env('SMIS_UPLOAD_URL').'/'. (!empty($employee) ? $employee->ttd : '') }}"
                            style="height: 2.5cm; width: auto; aspect-ratio: auto;"
                            alt=""
                        >
                        <br/>
                        ({{$dokumen->nama_verifikator}})
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>

</html>
