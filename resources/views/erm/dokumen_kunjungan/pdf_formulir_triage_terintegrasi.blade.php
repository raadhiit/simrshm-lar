<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulir Triase Terintegrasi</title>

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
                <td>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Jenis Kelamin</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
            </tr>
            <tr>
                <td style="width: 40%;">NIK</td>
                <td style="padding-left:10px; padding-right:10px"> :</td>
                <td>{{ $layanan->ktp }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background: black; margin-top: -2px; padding-bottom: 5px; border: 1px solid"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: white">FORMULIR TRIASE TERINTEGRASI</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 40%; padding: 10px;">
                        Cara datang :
                        <br>
                        <input onclick="cek_radio_cara_datang()"
                               @if(old('cara_datang'))
                                   {{ old('cara_datang') ==  'sendiri' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->cara_datang == 'sendiri' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="sendiri" name="radio_cara_datang"> Sendiri
                        <br>
                        <input onclick="cek_radio_cara_datang()"
                               @if(old('cara_datang'))
                                   {{ old('cara_datang') ==  'diantar_polisi' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->cara_datang == 'diantar_polisi' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="diantar_polisi" name="radio_cara_datang"> Diantar Polisi
                        <br>
                        <input onclick="cek_radio_cara_datang()"
                               @if(old('cara_datang'))
                                   {{ old('cara_datang') ==  'ambulan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->cara_datang == 'ambulan' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="ambulan" name="radio_cara_datang"> Ambulans No.ID <span style="border-bottom: 1px dotted;">{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->no_ambulan : '-' }}</span>
                    </td>
                    <td style="width: 20%; padding: 10px; vertical-align: text-top">
                        <input type="checkbox" onchange="cek_asal_rujukan()" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('rujukan',json_decode($dokumen->formulir_triage_terintegrasi->rujukan )) ? 'checked' : '' }}
                        @endif id="rujukan"> Asal Rujukan <span style="border-bottom: 1px dotted; width: 100%; display: block">{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->asal_rujukan : '-' }}</span>
                    </td>
                    <td style="width: 20%; padding: 10px; vertical-align: text-top">
                        Jam Datang : 
                        <br>
                        <span style="border-bottom: 1px dotted; width: 100%; display: block">{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->jam_datang : '-' }}</span>
                    </td>
                    <td style="width: 20%; padding: 10px; vertical-align: text-top">
                        Jam Registrasi :
                        <br>
                        <span style="border-bottom: 1px dotted; width: 100%; display: block">{{ date('H:i', strtotime($layanan->tanggal)) }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding: 10px;">
                        Alamat :
                        <br>
                        <span style="border-bottom: 1px dotted; width: 100%; display: block">{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->alamat : '' }}</span>
                    </td>
                    <td style="width: 20%; padding: 10px; vertical-align: text-top">
                        Nama Pengantar :
                        <br>
                        <span style="border-bottom: 1px dotted; width: 100%; display: block">{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->nama_pengantar : '' }}</span>
                    </td>
                    <td colspan="2" rowspan="3" style="width: 40%; padding: 10px; vertical-align: text-top">
                        <input onclick="cek_radio_doa()"
                               @if(old('doa'))
                                   {{ old('doa') ==  'doa' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'doa' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="doa" name="radio_doa"> DOA
                        <br>
                        <input onclick="cek_radio_doa()"
                               @if(old('doa'))
                                   {{ old('doa') ==  'tanda_kehidupan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'tanda_kehidupan' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="tanda_kehidupan" name="radio_doa"> Tanda Kehidupan (-)
                        <br>
                        <input onclick="cek_radio_doa()"
                               @if(old('doa'))
                                   {{ old('doa') ==  'denyut_nadi' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'denyut_nadi' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="denyut_nadi" name="radio_doa"> Denyut Nadi (-)
                        <br>
                        <input onclick="cek_radio_doa()"
                               @if(old('doa'))
                                   {{ old('doa') ==  'ekg_flat' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'ekg_flat' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="ekg_flat" name="radio_doa"> EKG Flat
                        <br>
                        Jam DOA :
                        <input type="text" readonly
                               value="@if(old('jam_doa')){{ old('jam_doa') }}@else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->jam_doa : '' }}@endif"
                               id="jam_doa" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('doa'))
                            {{ old('doa') ==  'doa' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'doa' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding: 10px;">
                        Keluhan Utama :
                        <br>
                        <span style="border-bottom: 1px dotted; width: 100%; display: block">{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->keluhan_utama : '' }}</span>
                    </td>
                    <td style="width: 20%; padding: 10px; vertical-align: text-top">
                        <input @if(old('trauma'))
                                   {{ old('trauma') ==  'trauma' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->trauma == 'trauma' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="trauma" name="radio_trauma"> Trauma
                        <br>
                        <input @if(old('trauma'))
                                   {{ old('trauma') ==  'non_trauma' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->trauma == 'non_trauma' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="non_trauma" name="radio_trauma"> Non Trauma
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding: 10px;">
                        Riwayat Penyakit Dahulu :
                        <br>
                        <span style="border-bottom: 1px dotted; width: 100%; display: block">{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->riwayat_penyakit : '' }}</span>
                    </td>
                    <td style="width: 20%; padding: 10px; vertical-align: text-top">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('obstetri',json_decode($dokumen->formulir_triage_terintegrasi->obstetri )) ? 'checked' : '' }}
                        @endif id="obstetri"> Obstetri
                    </td>
                </tr>
            </table>
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td colspan="3" class="text-center">
                        <b>TRIASE PRIMER</b>
                    </td>
                    <td colspan="4" class="text-center">
                        <b>TRIASE SEKUNDER</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 14%; text-align: center"><b>PEMERIKSAAN</b></td>
                    <td style="width: 14%; text-align: center; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('resusitasi',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="resusitasi">
                        <b>RESUSITASI</b>
                    </td>
                    <td style="width: 14%; text-align: center; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('emergent',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="emergent">
                        <b>EMERGENT</b>
                    </td>
                    <td style="width: 14%; text-align: center"><b>TANDA VITAL</b></td>
                    <td style="width: 14%; text-align: center; background-color: yellow">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('urgent',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="urgent">
                        <b>URGENT</b>
                    </td>
                    <td style="width: 14%; text-align: center; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('not_urgent',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="not_urgent">
                        <b>NOT URGENT</b>
                    </td>
                    <td style="width: 14%; text-align: center; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('false_emergency',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="false_emergency">
                        <b>FALSE EMERGENCY</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 14%;">Jalan Nafas</td>
                    <td style="width: 14%; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('sumbatan',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="sumbatan"> Sumbatan
                    </td>
                    <td style="width: 14%; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="bebas"> Bebas
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                        @endif id="ancaman"> Ancaman
                    </td>
                    <td style="width: 14%;">
                        Keadaan Umum
                        <br>
                        {{ $layanan->tanda_vital ? $layanan->tanda_vital->keadaan_umum : '-' }} mmHg
                    </td>
                    <td style="width: 14%; background-color: yellow">Bebas</td>
                    <td style="width: 14%; background-color: green">Bebas</td>
                    <td style="width: 14%; background-color: green">Bebas</td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 14%;">Pernafasan</td>
                    <td style="width: 14%; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('henti_nafas',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="henti_nafas"> Henti Nafas
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('bradipnea',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="bradipnea"> Bradipnea
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('sianosis',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="sianosis"> Sianosis
                    </td>
                    <td style="width: 14%; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('takipnea',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="takipnea"> Takipnea
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('mengi',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="mengi"> Mengi
                    </td>
                    <td style="width: 14%; vertical-align: text-top">
                        Tekanan Darah :
                        <br>
                        {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '_______/_______' }} mmHg
                        <br>
                        Suhu :
                        <br>
                        {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '_______' }} ᵒC
                        <br>
                        Frek. Nadi :
                        <br> 
                        {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '_______' }} x/menit
                        <br>
                        Frek. Napas :
                        <br>
                        {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '_______' }} x/menit
                        <br>
                        SaO<sub>2</sub> :
                        <br>
                        _______ %
                        <br>
                    </td>
                    <td style="width: 14%; background-color: yellow">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('satu',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="satu"> Normal
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('dua',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="dua"> Mengi
                    </td>
                    <td style="width: 14%; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tiga',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="tiga"> Frek, Napas<br>Normal
                    </td>
                    <td style="width: 14%; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('empat',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                        @endif id="empat"> Frek, Napas<br>Normal
                    </td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 14%;">Sirkulasi</td>
                    <td style="width: 14%; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('henti_jantung',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="henti_jantung"> Henti Jantung
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nadi_tidak_teraba',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nadi_tidak_teraba"> Nadi Tidak Teraba
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('akral_dingin',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="akral_dingin"> Akral Dingin
                    </td>
                    <td style="width: 14%; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nadi_lemah',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nadi_lemah"> Nadi Lemah
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('bradikardi',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="bradikardi"> Bradikardi
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('takikardi',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="takikardi"> Takikardi
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('pucat',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="pucat"> Pucat
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('akral_dingin2',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="akral_dingin2"> Akral Dingin
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('crt',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="crt"> CRT > 2 dtk
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('gcs',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="gcs"> GCS 9 - 12
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('gelisah',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="gelisah"> Gelisah
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('hemiparesi',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="hemiparesi"> Hemiparesi
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nyeri_dada',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nyeri_dada"> Nyeri Dada
                    </td>
                    <td style="width: 14%; vertical-align: text-top" rowspan="2">
                        Imunisasi : 
                        <br>
                        <input @if(old('imunisasi'))
                                    {{ old('imunisasi') ==  'ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->imunisasi == 'ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ya" name="radio_imunisasi"> Ya
                        <br>
                        <input @if(old('imunisasi'))
                                    {{ old('imunisasi') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->imunisasi == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak" name="radio_imunisasi"> Tidak
                                
                        <br>
                        <br>
                        Riwayat Alergi : 
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('makanan',json_decode($dokumen->formulir_triage_terintegrasi->riwayat_alergi )) ? 'checked' : '' }}
                        @endif id="makanan"> Makanan
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('obat',json_decode($dokumen->formulir_triage_terintegrasi->riwayat_alergi )) ? 'checked' : '' }}
                        @endif id="obat"> Obat
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('lain_lain',json_decode($dokumen->formulir_triage_terintegrasi->riwayat_alergi )) ? 'checked' : '' }}
                        @endif id="lain_lain"> Lain - Lain
                    </td>
                    <td style="width: 14%; background-color: yellow">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nadi_kuat',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nadi_kuat"> Nadi Kuat
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('takikardi2',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="takikardi2"> Takikardi
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tds160',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="tds160"> TDS > 160
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tdd100',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="tdd100"> TDD > 100
                    </td>
                    <td style="width: 14%; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nadi_kuat2',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nadi_kuat2"> Nadi Kuat
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nadi_normal',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nadi_normal"> Frek Nadi<br>Normal
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tds120',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="tds120"> TDS 120
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tdd80',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="tdd80"> TDD 80
                    </td>
                    <td style="width: 14%; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nadi_kuat3',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nadi_kuat3"> Nadi Kuat
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('nadi_normal2',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="nadi_normal2"> Frek Nadi<br>Normal
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tds120_2',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="tds120_2"> TDS 120
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tdd80_2',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                        @endif id="tdd80_2"> TDD 80
                    </td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 14%;">Kesadaran</td>
                    <td style="width: 14%; background-color: red">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                                {{ in_array('gcs9',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="gcs9"> GCS < 9
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('kejang',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="kejang"> Kejang
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('tidak_ada',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="tidak_ada"> Tidak Ada
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('respon',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="respon"> Respon
                    </td>
                    <td style="width: 14%; background-color: red">
                        &nbsp;
                    </td>
                    <td style="width: 14%; background-color: yellow">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('gcs12',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="gcs12"> GCS > 12
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('apatis',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="apatis"> Apatis
                        <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('somnolen',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="somnolen"> Somnolen
                    </td>
                    <td style="width: 14%; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('gcs15',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="gcs15"> GCS 15
                    </td>
                    <td style="width: 14%; background-color: green">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('gcs15_2',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                        @endif id="gcs15_2"> GCS 15
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="vertical-align: text-top">
                        Keterangan Warna :
                        <br>1. Merah : Pasien Gawat Darurat (pada pasien dengan label merah perlu mendapatkan penanganan langsung saat itu juga)
                        <br>2. Kuning : Pasien Gawat tapi tidak darurat (pada label kuning perlu ditangani kurang dari 15 menit)
                        <br>3. Hijau : Pasien tidak gawat, tidak darurat (pada pasien dengan label hijau mendapatkan penanganan kurang dari 30 menit)
                        <br>4. Hitam : Pasien dengan label hitam (MENINGGAL)
                    </td>
                    <td colspan="2" style="vertical-align: text-top; text-align: center">
                        Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}
                        <br>
                        Petugas
                        <br>
                        <a @if($dokumen->formulir_triage_terintegrasi)onclick="open_modal_dokter()"@endif href="#"
                           style="text-decoration:none; color:#111; text-align: center">
                            @if($dokumen->id_verifikator == 0)
                                <br>
                                <br>
                                <br>
                                Klik Disini
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>Ttd & Nama Terang
                            @else
                                @if(isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                         style="height: 4cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                @endif
                                <br>({{$dokumen->nama_verifikator}})<br>
                            @endif
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>

</html>
