<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Asesment Awal Keperawatan IGD</title>

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
                <td style="padding-left: 10px;">NIK</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->ktp }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background: black; margin-top: -2px; padding-bottom: 5px; border: 1px solid"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: white">DOKUMEN ASESMENT AWAL KEPERAWATAN IGD</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 50%; text-align: center; border-right: 1px solid">
                        Respon Time
                    </td>
                    <td style="width: 50%"></td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: justify; border-right: 1px solid">
                        Hari & Tanggal : {{ \Carbon\Carbon::parse($dokumen->created_at)->locale('id')->isoFormat('dddd, DD-MM-YYYY') }} Pukul : {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                        {{-- <span>{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_respon_time : '' }}</span>, Jam :
                        <span>{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_respon_time : '' }}</span> --}}
                    </td>
                    <td style="width: 50%; text-align: justify">
                        Umum / BPJS / Asuransi : 
                        <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="jenis_pembayaran"
                            value="@if(old('jenis_pembayaran')){{ old('jenis_pembayaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_pembayaran : '' }}@endif">
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td colspan="2">
                        Jenis Kasus : 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'bedah' ? 'checked' : '') : '' }}
                               type="checkbox" value="bedah" name="radio_jenis_kasus"> Bedah, 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'trauma' ? 'checked' : '') : '' }}
                               type="checkbox" value="trauma" name="radio_jenis_kasus" class="ml-4"> Trauma, 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'interne' ? 'checked' : '') : '' }}
                               type="checkbox" value="interne" name="radio_jenis_kasus" class="ml-4"> Interne,
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'tht' ? 'checked' : '') : '' }}
                               type="checkbox" value="tht" name="radio_jenis_kasus" class="ml-4"> THT, 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'anak' ? 'checked' : '') : '' }}
                                type="checkbox" value="anak" name="radio_jenis_kasus" class="ml-4"> Anak, 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'mata' ? 'checked' : '') : '' }}
                                type="checkbox" value="mata" name="radio_jenis_kasus" class="ml-4"> Mata, 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'neonatus' ? 'checked' : '') : '' }}
                                type="checkbox" value="neonatus" name="radio_jenis_kasus" class="ml-4"> Neonatus, 
                        <br>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'lainnya' ? 'checked' : '') : '' }}
                                type="checkbox" value="lainnya" name="radio_jenis_kasus" class="ml-6"> Lainnya
                        <input type="text" readonly
                            value="@if(old('jenis_kasus_lainnya')){{ old('jenis_kasus_lainnya') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus_lainnya : '' }}@endif"
                            id="jenis_kasus_lainnya" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('jenis_kasus'))
                                {{ old('jenis_kasus') ==  'lainnya' ? '' : 'readonly' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'lainnya' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row" style="margin-left: 1px;">
                            <div class="col-print-3">
                                Transportasi ke IGD <span style="float: right"> : </span>
                            </div>
                            <div class="col-print-9">
                                <input 
                                type="checkbox" 
                                id="ambulance" 
                                name="transportasi[]" 
                                value="ambulance"
                                @if(is_array(old('transportasi')) && in_array('ambulance', old('transportasi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('ambulance', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi, true) ?? []))
                                    checked
                                @endif
                                > 
                                Ambulance &nbsp;&nbsp;
                                {{-- <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'kendaraan_pribadi' ? 'checked' : '') : '' }}
                                    type="checkbox" value="kendaraan_pribadi" name="radio_transportasi" class="ml-4"> Kendaraan Pribadi, 
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'datang_sendiri' ? 'checked' : '') : '' }}
                                    type="checkbox" value="datang_sendiri" name="radio_transportasi" class="ml-4">  --}}
                                <input 
                                    type="checkbox" 
                                    id="pribadi" 
                                    name="transportasi[]" 
                                    value="pribadi"
                                    @if(is_array(old('transportasi')) && in_array('pribadi', old('transportasi')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('pribadi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi, true) ?? []))
                                        checked
                                    @endif
                                    > 
                                Kendaraan Pribadi, &nbsp;&nbsp;

                                <input 
                                type="checkbox" 
                                id="sendiri" 
                                name="transportasi[]" 
                                value="sendiri"
                                @if(is_array(old('transportasi')) && in_array('sendiri', old('transportasi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('sendiri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi, true) ?? []))
                                    checked
                                @endif
                                > Datang Sendiri
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row" style="margin-left: 1px;">
                            <div class="col-print-3"></div>
                            <div class="col-print-9">
                                <input 
                                type="checkbox" 
                                id="rujukan" 
                                name="transportasi[]" 
                                value="rujukan"
                                @if(is_array(old('transportasi')) && in_array('rujukan', old('transportasi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('rujukan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi, true) ?? []))
                                    checked
                                @endif
                                >   
                                Rujukan, dari 
                                <input type="text" readonly
                                    value="@if(old('rujukan_dari')){{ old('rujukan_dari') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->rujukan_dari : '' }}@endif"
                                    id="rujukan_dari" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('transportasi'))
                                        {{ old('transportasi') ==  'rujukan' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'rujukan' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                                <br>
                                <input 
                                type="checkbox" 
                                id="auto_anamnesa" 
                                name="transportasi[]" 
                                value="auto_anamnesa"
                                @if(is_array(old('transportasi')) && in_array('auto_anamnesa', old('transportasi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('auto_anamnesa', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi, true) ?? []))
                                    checked
                                @endif
                                >    
                                Auto Anamnesa &nbsp;&nbsp;

                                <input 
                                type="checkbox" 
                                id="allo" 
                                name="transportasi[]" 
                                value="allo"
                                @if(is_array(old('transportasi')) && in_array('allo', old('transportasi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('allo', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi, true) ?? []))
                                    checked
                                @endif
                                > 
                                
                                Allo Anamnesa 
                                <input type="text" readonly
                                    value="@if(old('allo_anamnesa')){{ old('allo_anamnesa') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->allo_anamnesa : '' }}@endif"
                                    id="allo_anamnesa" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('transportasi'))
                                        {{ old('transportasi') ==  'allo_anamnesa' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'allo_anamnesa' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="vertical-align: text-top">
                    <td style="width: 18%;">
                        Nama
                    </td>
                    <td style="border-left: hidden; width: 60%;" colspan="2">
                        <span>: </span>
                        <input type="text" style="width: 90%; border: hidden; border-bottom: 1px dotted; margin-top: 8px" 
                                       value="@if(old('nama')){{ old('nama') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama : '' }}@endif"
                                       id="nama">
                    </td>
                    <td>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kelamin == 'laki_laki' ? 'checked' : '') : '' }}
                               type="checkbox" value="laki_laki" name="radio_kelamin"> Laki-laki
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kelamin == 'perempuan' ? 'checked' : '') : '' }}
                               type="checkbox" value="perempuan" name="radio_kelamin"> Perempuan
                    </td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 18%;">
                        Alamat
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <span>: </span>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted; width: 90%"
                                       value="@if(old('alamat')){{ old('alamat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->alamat : '' }}@endif"
                                       id="alamat">
                    </td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 18%;">
                        Agama
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <span>: </span>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'islam' ? 'checked' : '') : '' }}
                            type="checkbox" value="islam" name="radio_agama"> Islam 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'kristen' ? 'checked' : '') : '' }}
                            type="checkbox" value="kristen" name="radio_agama" class="ml-4"> Kristen 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'katolik' ? 'checked' : '') : '' }}
                            type="checkbox" value="katolik" name="radio_agama" class="ml-4"> Katolik 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'hindu' ? 'checked' : '') : '' }}
                            type="checkbox" value="hindu" name="radio_agama" class="ml-4"> Hindu 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'budha' ? 'checked' : '') : '' }}
                            type="checkbox" value="budha" name="radio_agama" class="ml-4"> Budha
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'konghucu' ? 'checked' : '') : '' }}
                            type="checkbox" value="konghucu" name="radio_agama" class="ml-4"> Konghucu
                        <br>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'lain_lain' ? 'checked' : '') : '' }}
                            type="checkbox" value="lain_lain" name="radio_agama" style="margin-left: 12px"> 
                        <input type="text" readonly
                            value="@if(old('agama_lain')){{ old('agama_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->agama_lain : '' }}@endif"
                            id="agama_lain" style="border: 0; border-bottom: 2px dotted;">
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 18%;">
                        Status Pasien
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <span>: </span>
                        <input @if(old('status_pasien'))
                            {{ old('status_pasien') ==  'baru' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_pasien == 'baru' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="baru" name="radio_status_pasien"> Baru 
                        <input @if(old('status_pasien'))
                            {{ old('status_pasien') ==  'lama' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_pasien == 'lama' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="lama" name="radio_status_pasien" class="ml-4"> Lama
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 18%;">
                        Hambatan Pasien
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <span>: </span>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->hambatan_pasien == 'tidak_ada' ? 'checked' : '') : '' }}
                            type="checkbox" value="tidak_ada" name="radio_hambatan_pasien"> Tidak Ada 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->hambatan_pasien == 'ada' ? 'checked' : '') : '' }}
                            type="checkbox" value="ada" name="radio_hambatan_pasien" class="ml-4"> ada : 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'bahasa' ? 'checked' : '') : '' }}
                            type="checkbox" value="bahasa" name="radio_jenis_hambatan_pasien" class="ml-1"> Bahasa 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'fisik' ? 'checked' : '') : '' }}
                            type="checkbox" value="fisik" name="radio_jenis_hambatan_pasien" class="ml-4"> Fisik 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'tuli' ? 'checked' : '') : '' }}
                            type="checkbox" value="tuli" name="radio_jenis_hambatan_pasien" class="ml-4"> Tuli
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'bisu' ? 'checked' : '') : '' }}
                            type="checkbox" value="bisu" name="radio_jenis_hambatan_pasien" class="ml-4"> Bisu
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'buta' ? 'checked' : '') : '' }}
                            type="checkbox" value="buta" name="radio_jenis_hambatan_pasien" class="ml-4"> Buta
                        <br>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'lain_lain' ? 'checked' : '') : '' }}
                            type="checkbox" value="lain_lain" name="radio_jenis_hambatan_pasien" style="margin-left: 12px"> 
                        <input type="text" readonly
                            value="@if(old('ket_jenis_hambatan_pasien')){{ old('ket_jenis_hambatan_pasien') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_jenis_hambatan_pasien : '' }}@endif"
                            id="ket_jenis_hambatan_pasien" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('jenis_hambatan_pasien'))
                                {{ old('jenis_hambatan_pasien') ==  'lain_lain' ? '' : 'readonly' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="border: 1px solid">
                    <td colspan="4" style="text-align: center">
                        <b>RIWAYAT KESEHATAN</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Keluhan Utama
                        <span style="float: right">: </span>
                        
                    </td>
                    <td style="border-left: hidden" colspan="3">
                    </td>
                </tr>
                <tr>
                    <td style="border-top: hidden" colspan="4">
                        <textarea id="keluhan_utama" style="width: 99%">@if(old('keluhan_utama')){{ old('keluhan_utama') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keluhan_utama : '' }}@endif</textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="vertical-align: text-top">
                    <td style="width: 10%;">
                        Airway
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <span>: </span>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'bebas' ? 'checked' : '') : '' }}
                            type="checkbox" value="bebas" name="radio_airway"> Bebas 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'hidung' ? 'checked' : '') : '' }}
                            type="checkbox" value="hidung" name="radio_airway" class="ml-4"> Hidung / Mulut 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'pangkal_lidah' ? 'checked' : '') : '' }}
                            type="checkbox" value="pangkal_lidah" name="radio_airway" class="ml-4"> Pangkal Lidah Jatuh 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'lain_lain' ? 'checked' : '') : '' }}
                            type="checkbox" value="lain_lain" name="radio_airway" class="ml-4"> Lainnya, sebutkan 
                        <input type="text" readonly
                            value="@if(old('airway_lain')){{ old('airway_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->airway_lain : '' }}@endif"
                            id="airway_lain" style="border: 0; border-bottom: 2px dotted;">
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 10%;">
                        Breathing
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <span>: </span>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'normal' ? 'checked' : '') : '' }}
                            type="checkbox" value="normal" name="radio_breathing"> Normal 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'apnoe' ? 'checked' : '') : '' }}
                            type="checkbox" value="apnoe" name="radio_breathing" class="ml-4"> Apnoe
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'dispnea' ? 'checked' : '') : '' }}
                            type="checkbox" value="dispnea" name="radio_breathing" class="ml-4"> Dispnea 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'brandipnea' ? 'checked' : '') : '' }}
                            type="checkbox" value="brandipnea" name="radio_breathing" class="ml-4"> Brandipnea 
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'retraksi_dada' ? 'checked' : '') : '' }}
                            type="checkbox" value="retraksi_dada" name="radio_breathing" class="ml-4"> Retraksi Dana 
                        <br>
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'lain_lain' ? 'checked' : '') : '' }}
                            type="checkbox" value="lain_lain" name="radio_breathing" style="margin-left: 12px"> Lainnya
                        <input type="text" readonly
                            value="@if(old('breathing_lain')){{ old('breathing_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->breathing_lain : '' }}@endif"
                            id="breathing_lain" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('breathing'))
                                {{ old('breathing') ==  'lain_lain' ? '' : 'readonly' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                </tr>
                <tr>
                    <td style="width: 10%;">
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row" style="margin-left: 2px">
                            <div class="col-print-2" style="padding-left: 7px">
                                RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                            </div>
                            <div class="col-print-10">
                                Pola Pernafasan
                                <input onclick="cek_pola_pernafasan()" @if(old('pola_pernafasan'))
                                    {{ old('pola_pernafasan') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pola_pernafasan == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="normal" name="radio_pola_pernafasan"> Normal 
                                <input onclick="cek_pola_pernafasan()" @if(old('pola_pernafasan'))
                                    {{ old('pola_pernafasan') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pola_pernafasan == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="tidak" name="radio_pola_pernafasan" class="ml-4"> Tidak, Jelaskan 
                                <input type="text" readonly
                                    value="@if(old('pernafasan_lain')){{ old('pernafasan_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pernafasan_lain : '' }}@endif"
                                    id="pernafasan_lain" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('pola_pernafasan'))
                                        {{ old('pola_pernafasan') ==  'tidak' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pola_pernafasan == 'tidak' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%;">
                        Circulation
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row" style="margin-left: 2px">
                            <div class="col-print-3">
                                <span>: </span>TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                            </div>
                            <div class="col-print-2">
                                Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                            </div>
                            <div class="col-print-2">
                                <input @if(old('circulation'))
                                    {{ old('circulation') ==  'teratur' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->circulation == 'teratur' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="teratur" name="radio_circulation"> Teratur 
                            </div>
                            <div class="col-print-2">
                                <input @if(old('circulation'))
                                    {{ old('circulation') ==  'tidak_teratur' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->circulation == 'tidak_teratur' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="tidak_teratur" name="radio_circulation"> Tidak Teratur
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%;">
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row" style="margin-left: 2px">
                            <div class="col-print-4" style="padding-left: 7px">
                                Pendarahan / Kehilangan Cairan
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_pendarahan()" @if(old('pendarahan'))
                                    {{ old('pendarahan') ==  'tidak_ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan == 'tidak_ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="tidak_ada" name="radio_pendarahan"> Tidak Ada 
                            </div>
                            <div class="col-print-6">
                                <input onclick="cek_pendarahan()" @if(old('pendarahan'))
                                    {{ old('pendarahan') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="ada" name="radio_pendarahan"> Ada, Jelaskan
                                <input type="text" readonly
                                    value="@if(old('pendarahan_lain')){{ old('pendarahan_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan_lain : '' }}@endif"
                                    id="pendarahan_lain" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('pendarahan'))
                                        {{ old('pendarahan') ==  'ada' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan == 'ada' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="border: 1px solid;">
                    <td style="width: 20%;">
                        Luas Luka Bakar
                        <span style="float: right">: </span>
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->luka_bakar : '' }}
                        </span> %
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr>
                    <td style="width: 10%;">
                        CRT
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row">
                            <div class="col-print-3">
                                <span>: </span>
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->crt == 'lebih_dua_detik' ? 'checked' : '') : '' }}
                                    type="checkbox" value="lebih_dua_detik" name="radio_crt"> Dibawah 2 Detik 
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->crt == 'kurang_dua_detik' ? 'checked' : '') : '' }}
                                    type="checkbox" value="kurang_dua_detik" name="radio_crt"> Diatas 2 Detik 
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%;">
                        Kulit
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row">
                            <div class="col-print-3">
                                <span>: </span>
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kulit == 'kering' ? 'checked' : '') : '' }}
                                    type="checkbox" value="kering" name="radio_kulit"> Kering 
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kulit == 'lembab' ? 'checked' : '') : '' }}
                                    type="checkbox" value="lembab" name="radio_kulit"> Lembab
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%;">
                        Akral
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row">
                            <div class="col-print-3">
                                <span>: </span>
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->akral == 'hangat' ? 'checked' : '') : '' }}
                                    type="checkbox" value="hangat" name="radio_akral"> Hangat
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->akral == 'dingin' ? 'checked' : '') : '' }}
                                    type="checkbox" value="dingin" name="radio_akral"> Dingin
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->akral == 'edema' ? 'checked' : '') : '' }}
                                    type="checkbox" value="edema" name="radio_akral"> Edema
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                        Turgor
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row">
                            <div class="col-print-3">
                                <span>: </span>
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->turgor == 'normal' ? 'checked' : '') : '' }}
                                    type="checkbox" value="normal" name="radio_turgor"> Normal
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->turgor == 'sedang' ? 'checked' : '') : '' }}
                                    type="checkbox" value="sedang" name="radio_turgor"> Sedang
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->turgor == 'kurang' ? 'checked' : '') : '' }}
                                    type="checkbox" value="kurang" name="radio_turgor"> Kurang
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="page_break"></div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian_bordered">
                <tr style="text-align: center">
                    <td colspan="6">
                        <b>DISABILITY / NEUROLOGI</b>
                    </td>
                </tr>
                <tr style="text-align: center">
                    <td colspan="6">
                        <span style="font-size: 10px">
                            Table Glasgow Coma Scale
                        </span>
                    </td>
                </tr>
                <tr style="text-align: center">
                    <td>
                        PARAMETER
                    </td>
                    <td>
                        SKOR
                    </td>
                    <td>
                        KETERANGAN
                    </td>
                    <td>
                        PARAMETER
                    </td>
                    <td>
                        SKOR
                    </td>
                    <td>
                        KETERANGAN
                    </td>
                </tr>
                <tr>
                    <td rowspan="4" style="text-align: center">
                        BUKA MATA
                    </td>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_buka_mata == 4 ? 'background: red;' : '' }}
                    @endif">
                        4
                    </td>
                    <td>
                        Spontan
                    </td>
                    <td rowspan="5" style="text-align: center">
                        RESPON VERBAL
                    </td>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_verbal == 5 ? 'background:red;' : '' }}
                        @endif">
                        5
                    </td>
                    <td>
                        Oriental Baik
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_buka_mata == 3 ? 'background: red;' : '' }}
                    @endif">
                        3
                    </td>
                    <td>
                        Dengan Perintah
                    </td>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_verbal == 4 ? 'background:red;' : '' }}
                        @endif">
                        4
                    </td>
                    <td>
                        Oriental Buruk
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_buka_mata == 2 ? 'background: red;' : '' }}
                    @endif">
                        2
                    </td>
                    <td>
                        Pada Nyeri
                    </td>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_verbal == 3 ? 'background:red;' : '' }}
                        @endif">
                        3
                    </td>
                    <td>
                        Bicara Ngacau
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_buka_mata == 1 ? 'background: red;' : '' }}
                    @endif">
                        1
                    </td>
                    <td>
                        Tidak Ada
                    </td>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_verbal == 2 ? 'background:red;' : '' }}
                        @endif">
                        2
                    </td>
                    <td>
                        Tanpa Arti
                    </td>
                </tr>
                <tr>
                    <td rowspan="6" style="text-align: center">
                        RESPON MOTORIK
                    </td>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_motorik == 6 ? 'background:red;' : '' }}
                    @endif">
                        6
                    </td>
                    <td>
                        Menurut Pada Perintah
                    </td>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_verbal == 1 ? 'background:red;' : '' }}
                        @endif">
                        1
                    </td>
                    <td>
                        Tanpa Respon
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_motorik == 5 ? 'background:red;' : '' }}
                    @endif">
                        5
                    </td>
                    <td>
                        Pada Rangsang Nyeri
                    </td>
                    <td colspan="3" rowspan="5">
                        Hasil Nilai GCS
                        <br>
                        E : <input type="text"
                                       value="@if(old('e_kesadaran')){{ old('e_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->e_kesadaran : '' }}@endif"
                                       id="e_kesadaran" style="border: 0; border-bottom: 2px dotted; margin-top: 5px">
                        <br>
                        M: <input type="text"
                                       value="@if(old('m_kesadaran')){{ old('m_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->m_kesadaran : '' }}@endif"
                                       id="m_kesadaran" style="border: 0; border-bottom: 2px dotted; margin-top: 5px">
                        <br>
                        V : <input type="text"
                                       value="@if(old('v_kesadaran')){{ old('v_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->v_kesadaran : '' }}@endif"
                                       id="v_kesadaran" style="border: 0; border-bottom: 2px dotted; margin-top: 5px">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_motorik == 4 ? 'background:red' : '' }}
                    @endif">
                        4
                    </td>
                    <td>
                        Fleksi Menarik
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_motorik == 3 ? 'background:red;' : '' }}
                    @endif">
                        3
                    </td>
                    <td>
                        Fleksi Abnormal
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_motorik == 2 ? 'background:red;' : '' }}
                    @endif">
                        2
                    </td>
                    <td>
                        Ekstensi
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_motorik == 1 ? 'background:red;' : '' }}
                    @endif">
                        1
                    </td>
                    <td>
                        Tanpa Respon
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        KESADARAN
                    </td>
                    <td style="width: 40%">
                        Reflek Cahaya
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->reflek_cahaya == 'negatif' ? 'checked' : '') : '' }}
                            type="checkbox" value="negatif" name="radio_reflek_cahaya" class="ml-4"> Negatif
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->reflek_cahaya == 'positif' ? 'checked' : '') : '' }}
                            type="checkbox" value="positif" name="radio_reflek_cahaya" class="ml-4"> Positif
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'compos_mentis' ? 'checked' : '') : '' }}
                               type="checkbox" value="compos_mentis" name="radio_kesadaran"> Compos Mentis
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'apatis' ? 'checked' : '') : '' }}
                               type="checkbox" value="apatis" name="radio_kesadaran" class="ml-4"> Apatis
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'somnolen' ? 'checked' : '') : '' }}
                               type="checkbox" value="somnolen" name="radio_kesadaran" class="ml-4"> Somnolen
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'soporkoma' ? 'checked' : '') : '' }}
                               type="checkbox" value="soporkoma" name="radio_kesadaran" class="ml-4"> Soporkoma
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'coma' ? 'checked' : '') : '' }}
                               type="checkbox" value="coma" name="radio_kesadaran"> Coma
                    </td>
                    <td style="width: 40%">
                        Kekuatan Otot
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        Pupil <span class="ml-4"> : </span>
                        Diameter Pupil 
                        <input type="text"
                            value="{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->diameter_pupil : '' }}"
                            id="diameter_pupil" style="border: 0; border-bottom: 2px dotted; width: 50px"> / 
                        <input type="text"
                            value="{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->diameter_pupil1 : '' }}"
                            id="diameter_pupil1" style="border: 0; border-bottom: 2px dotted; width: 50px">
                    </td>
                    <td style="width: 40%">
                        Ekstramitas Atas <span class="ml-4"> : </span>
                        <input type="text"
                            value="@if(old('ekstramitas_atas')){{ old('ekstramitas_atas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_atas : '' }}@endif"
                            id="ekstramitas_atas" style="border: 0; border-bottom: 2px dotted; width: 50px"> / 
                        <input type="text"
                            value="@if(old('ekstramitas_atas1')){{ old('ekstramitas_atas1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_atas1 : '' }}@endif"
                            id="ekstramitas_atas1" style="border: 0; border-bottom: 2px dotted; width: 50px">
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'isokor' ? 'checked' : '') : '' }}
                                    type="checkbox" value="isokor" name="radio_kesadaran2"> Isokor
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'miosis' ? 'checked' : '') : '' }}
                                    type="checkbox" value="miosis" name="radio_kesadaran2"> Miosis
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'anisokor' ? 'checked' : '') : '' }}
                                    type="checkbox" value="anisokor" name="radio_kesadaran2"> Anisokor
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'midriasis' ? 'checked' : '') : '' }}
                                    type="checkbox" value="midriasis" name="radio_kesadaran2"> Midriasis
                            </div>
                        </div>
                    </td>
                    <td style="width: 40%">
                        Ekstramitas Bawah <span class="ml-4"> : </span>
                        <input type="text"
                            value="@if(old('ekstramitas_bawah')){{ old('ekstramitas_bawah') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_bawah : '' }}@endif"
                            id="ekstramitas_bawah" style="border: 0; border-bottom: 2px dotted; width: 50px"> / 
                        <input type="text"
                            value="@if(old('ekstramitas_bawah1')){{ old('ekstramitas_bawah1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_bawah1 : '' }}@endif"
                            id="ekstramitas_bawah1" style="border: 0; border-bottom: 2px dotted; width: 50px">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        Eksposure
                    </td>
                    <td style="padding-left: 10px; width: 40%">
                        
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        @if ($dokumen->dokumen_asesment_awal_keperawatan_igd)
                            @if ($dokumen->dokumen_asesment_awal_keperawatan_igd->gambar_status_lokalis != '')
                                <div
                                    style="background-repeat: no-repeat; width: fit-content; background-size: 67%; background-image: url('{{ asset('images/status_lokalis2.jpg') }}')">
                                    <img style="position: relative; top:0px; opacity: 0.5; width: max-content"
                                        src="{{ asset('status_lokalis/' . $dokumen->dokumen_asesment_awal_keperawatan_igd->gambar_status_lokalis) }}"
                                        alt="">
                                </div>
                            @else
                                <div
                                    style="background-repeat: no-repeat; width: fit-content; background-size: 67%; background-image: url('{{ asset('images/status_lokalis2.jpg') }}')">
                                    <div id="sig"></div>
                                </div>
                            @endif
                        @endif
                        <p>Gambar lokasi</p>
                    </td>
                    <td style="padding-left: 10px; width: 40%" rowspan="3">
                        Tanda Kehidupan
                        <br>
                        {{-- <input @if(old('tanda_kehidupan'))
                            {{ old('tanda_kehidupan') ==  'doa' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan == 'doa' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="doa" name="radio_tanda_kehidupan">  --}}
                            <input 
                            type="checkbox" 
                            id="death_on_arrival" 
                            name="tanda_kehidupan[]" 
                            value="death_on_arrival"
                            @if(is_array(old('tanda_kehidupan')) && in_array('death_on_arrival', old('tanda_kehidupan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('death_on_arrival', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan, true) ?? []))
                                checked
                            @endif
                            > 
                            Death On Arrival
                        <br>
                        {{-- <input @if(old('tanda_kehidupan'))
                            {{ old('tanda_kehidupan') ==  'denyut_nadi' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan == 'denyut_nadi' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="denyut_nadi" name="radio_tanda_kehidupan">  --}}
                            <input 
                            type="checkbox" 
                            id="denyut_nadi" 
                            name="tanda_kehidupan[]" 
                            value="denyut_nadi"
                            @if(is_array(old('tanda_kehidupan')) && in_array('denyut_nadi', old('tanda_kehidupan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('denyut_nadi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan, true) ?? []))
                                checked
                            @endif
                            > 
                            Denyut Nadi (-)
                        <br>
                        {{-- <input @if(old('tanda_kehidupan'))
                            {{ old('tanda_kehidupan') ==  'reflek_cahaya' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan == 'reflek_cahaya' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="reflek_cahaya" name="radio_tanda_kehidupan">  --}}
                            <input 
                            type="checkbox" 
                            id="reflek_cahaya" 
                            name="tanda_kehidupan[]" 
                            value="reflek_cahaya"
                            @if(is_array(old('tanda_kehidupan')) && in_array('reflek_cahaya', old('tanda_kehidupan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('reflek_cahaya', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan, true) ?? []))
                                checked
                            @endif
                            > 
                            Reflek Cahaya (-)
                        <br>
                        {{-- <input @if(old('tanda_kehidupan'))
                            {{ old('tanda_kehidupan') ==  'ekg_asystole' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan == 'ekg_asystole' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="ekg_asystole" name="radio_tanda_kehidupan">  --}}
                            <input 
                            type="checkbox" 
                            id="ekg" 
                            name="tanda_kehidupan[]" 
                            value="ekg"
                            @if(is_array(old('tanda_kehidupan')) && in_array('ekg', old('tanda_kehidupan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('ekg', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan, true) ?? []))
                                checked
                            @endif
                            > 
                            EKG Asystole
                        <br>
                        Jam Penentuan Kematian : <input type="time" style="border: hidden; border-bottom: 1px dotted"
                        value="@if(old('jam_penentuan_kematian')){{ old('jam_penentuan_kematian') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_penentuan_kematian : '' }}@endif"
                        id="jam_penentuan_kematian"> WIB
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                <input @if(old('eksposure'))
                                        {{ old('eksposure') ==  'vulnus' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'vulnus' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="vulnus" name="radio_eksposure"> Vulnus
                            </div>
                            <div class="col-print-3">
                                <input @if(old('eksposure'))
                                        {{ old('eksposure') ==  'dislokasi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'dislokasi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="dislokasi" name="radio_eksposure"> Dislokasi
                            </div>
                            <div class="col-print-3">
                                <input @if(old('eksposure'))
                                        {{ old('eksposure') ==  'fraktur' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'fraktur' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="fraktur" name="radio_eksposure"> Fraktur
                            </div>
                            <div class="col-print-3">
                                <input @if(old('eksposure'))
                                        {{ old('eksposure') ==  'ekimosis' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'ekimosis' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ekimosis" name="radio_eksposure"> Ekimosis
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 60%">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                <input @if(old('eksposure'))
                                        {{ old('eksposure') ==  'ekskoriasi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'ekskoriasi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ekskoriasi" name="radio_eksposure"> Ekskoriasi
                            </div>
                            <div class="col-print-3">
                                <input @if(old('eksposure'))
                                        {{ old('eksposure') ==  'hematoma' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'hematoma' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="hematoma" name="radio_eksposure"> Hematoma
                            </div>
                            <div class="col-print-3">
                                <input @if(old('eksposure'))
                                        {{ old('eksposure') ==  'contusio' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'contusio' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="contusio" name="radio_eksposure"> Contusio
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="border: 1px solid">
                    <td colspan="4" style="text-align: center">
                        <b>RIWAYAT KESEHATAN PASIEN KEBIDANAN</b>
                        {{-- <br> --}}
                        <span style="font-size: 10px">(diisi oleh bidan untuk pasien persalinan)</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                Riwayat Kehamilan Sekarang
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        1. HPTP : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hptp : '' }}</span> ,
                    </td>
                    <td>
                        Tafsiran Partus : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tafsiran_partus : '' }}</span> ,
                    </td>
                    <td>
                        Perkawinan : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->perkawinan : '' }}</span> Kali,
                    </td>
                    <td>
                        Lama : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lama_perkawinan : '' }}</span> tahun,
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                2. Pemeriksaan Antenatal
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        {{-- <input onclick="cek_radio_pemeriksaan_antenatal()" @if(old('pemeriksaan_antenatal'))
                                {{ old('pemeriksaan_antenatal') ==  'dokter' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal == 'dokter' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="dokter" name="radio_pemeriksaan_antenatal">  --}}
                            <input 
                            type="checkbox" 
                            id="dokter" 
                            name="pemeriksaan_antenatal[]" 
                            value="dokter"
                            @if(is_array(old('pemeriksaan_antenatal')) && in_array('dokter', old('pemeriksaan_antenatal')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('dokter', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal, true) ?? []))
                                checked
                            @endif
                            > 
                            Dokter
                    </td>
                    <td>
                        <input 
                        type="checkbox" 
                        id="bidan" 
                        name="pemeriksaan_antenatal[]" 
                        value="bidan"
                        @if(is_array(old('pemeriksaan_antenatal')) && in_array('bidan', old('pemeriksaan_antenatal')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('bidan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal, true) ?? []))
                            checked
                        @endif
                        >  
                        Bidan
                    </td>
                    <td colspan="2"></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr>
                    <td>
                        {{-- <input onclick="cek_radio_pemeriksaan_antenatal()" @if(old('pemeriksaan_antenatal'))
                                {{ old('pemeriksaan_antenatal') ==  'terdaftar' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal == 'terdaftar' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="terdaftar" name="radio_pemeriksaan_antenatal">  --}}
                             <input 
                            type="checkbox" 
                            id="terdaftar" 
                            name="pemeriksaan_antenatal[]" 
                            value="terdaftar"
                            @if(is_array(old('pemeriksaan_antenatal')) && in_array('terdaftar', old('pemeriksaan_antenatal')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('terdaftar', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal, true) ?? []))
                                checked
                            @endif
                            > 
                            Terdaftar
                    </td>
                    <td>
                        {{-- <input onclick="cek_radio_pemeriksaan_antenatal()" @if(old('pemeriksaan_antenatal'))
                                {{ old('pemeriksaan_antenatal') ==  'tidak_terdaftar' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal == 'tidak_terdaftar' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="tidak_terdaftar" name="radio_pemeriksaan_antenatal">  --}}
                            <input 
                            type="checkbox" 
                            id="tidak_terdaftar" 
                            name="pemeriksaan_antenatal[]" 
                            value="tidak_terdaftar"
                            @if(is_array(old('pemeriksaan_antenatal')) && in_array('tidak_terdaftar', old('pemeriksaan_antenatal')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('tidak_terdaftar', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal, true) ?? []))
                                checked
                            @endif
                            > 
                            Tidak Terdaftar
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>
                        {{-- <input onclick="cek_radio_pemeriksaan_antenatal()" @if(old('pemeriksaan_antenatal'))
                                {{ old('pemeriksaan_antenatal') ==  'tidak_teratur' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal == 'tidak_teratur' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="tidak_teratur" name="radio_pemeriksaan_antenatal">  --}}
                            <input 
                            type="checkbox" 
                            id="tidak_teratur" 
                            name="pemeriksaan_antenatal[]" 
                            value="tidak_teratur"
                            @if(is_array(old('pemeriksaan_antenatal')) && in_array('tidak_teratur', old('pemeriksaan_antenatal')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('tidak_teratur', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal, true) ?? []))
                                checked
                            @endif
                            > 
                            Tidak Teratur
                    </td>
                    <td>
                        {{-- <input onclick="cek_radio_pemeriksaan_antenatal()" @if(old('pemeriksaan_antenatal'))
                                {{ old('pemeriksaan_antenatal') ==  'teratur' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal == 'teratur' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="teratur" name="radio_pemeriksaan_antenatal">  --}}
                            <input 
                            type="checkbox" 
                            id="teratur" 
                            name="pemeriksaan_antenatal[]" 
                            value="teratur"
                            @if(is_array(old('pemeriksaan_antenatal')) && in_array('teratur', old('pemeriksaan_antenatal')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('teratur', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal, true) ?? []))
                                checked
                            @endif
                            > 
                            Teratur : 
                        <input type="text" readonly
                            value="@if(old('ket_pemeriksaan_antenatal')){{ old('ket_pemeriksaan_antenatal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_pemeriksaan_antenatal : '' }}@endif"
                            id="ket_pemeriksaan_antenatal" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('pemeriksaan_antenatal'))
                                {{ old('pemeriksaan_antenatal') ==  'teratur' ? '' : 'readonly' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal == 'teratur' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                3. Riwayat KB
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_kb()" @if(old('riwayat_kb'))
                                    {{ old('riwayat_kb') ==  'suntik' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb == 'suntik' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="suntik" name="radio_riwayat_kb"> Suntik 
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_kb()" @if(old('riwayat_kb'))
                                    {{ old('riwayat_kb') ==  'pil' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb == 'pil' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="pil" name="radio_riwayat_kb"> Pil 
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_kb()" @if(old('riwayat_kb'))
                                    {{ old('riwayat_kb') ==  'implan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb == 'implan' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="implan" name="radio_riwayat_kb"> Implan
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_kb()" @if(old('riwayat_kb'))
                                    {{ old('riwayat_kb') ==  'mow' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb == 'mow' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="mow" name="radio_riwayat_kb"> MOW
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_riwayat_kb()" @if(old('riwayat_kb'))
                                        {{ old('riwayat_kb') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_riwayat_kb">
                                <input type="text" readonly
                                    value="@if(old('ket_riwayat_kb')){{ old('ket_riwayat_kb') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_kb : '' }}@endif"
                                    id="ket_riwayat_kb" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('riwayat_kb'))
                                        {{ old('riwayat_kb') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                4. Riwayat Ginekologi
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                {{-- <input onclick="cek_radio_riwayat_ginekologi()" @if(old('riwayat_ginekologi'))
                                    {{ old('riwayat_ginekologi') ==  'infertilitas' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi == 'infertilitas' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="infertilitas" name="radio_riwayat_ginekologi">  --}}
                                <input 
                                type="checkbox" 
                                id="infertilitas" 
                                name="riwayat_ginekologi[]" 
                                value="infertilitas"
                                @if(is_array(old('riwayat_ginekologi')) && in_array('infertilitas', old('riwayat_ginekologi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('infertilitas', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi, true) ?? []))
                                    checked
                                @endif
                                > 
                                Infertilitas 
                            </div>
                            <div class="col-print-2">
                                {{-- <input onclick="cek_radio_riwayat_ginekologi()" @if(old('riwayat_ginekologi'))
                                    {{ old('riwayat_ginekologi') ==  'anemia' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi == 'anemia' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="anemia" name="radio_riwayat_ginekologi">  --}}
                                <input 
                                type="checkbox" 
                                id="anemia" 
                                name="riwayat_ginekologi[]" 
                                value="anemia"
                                @if(is_array(old('riwayat_ginekologi')) && in_array('anemia', old('riwayat_ginekologi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('anemia', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi, true) ?? []))
                                    checked
                                @endif
                                > 
                                Anemia 
                            </div>
                            <div class="col-print-2">
                                {{-- <input onclick="cek_radio_riwayat_ginekologi()" @if(old('riwayat_ginekologi'))
                                    {{ old('riwayat_ginekologi') ==  'infeksi_virus' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi == 'infeksi_virus' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="infeksi_virus" name="radio_riwayat_ginekologi">  --}}
                                <input 
                                type="checkbox" 
                                id="infeksi_virus" 
                                name="riwayat_ginekologi[]" 
                                value="infeksi_virus"
                                @if(is_array(old('riwayat_ginekologi')) && in_array('infeksi_virus', old('riwayat_ginekologi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('infeksi_virus', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi, true) ?? []))
                                    checked
                                @endif
                                > 
                                Infeksi Virus
                            </div>
                            <div class="col-print-2">
                                <input 
                                type="checkbox" 
                                id="pms" 
                                name="riwayat_ginekologi[]" 
                                value="pms"
                                @if(is_array(old('riwayat_ginekologi')) && in_array('pms', old('riwayat_ginekologi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('pms', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi, true) ?? []))
                                    checked
                                @endif
                                > 
                                PMS
                            </div>
                            <div class="col-print-4">
                                {{-- <input onclick="cek_radio_riwayat_ginekologi()" @if(old('riwayat_ginekologi'))
                                        {{ old('riwayat_ginekologi') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_riwayat_ginekologi"> --}}
                                    <input 
                                type="checkbox" 
                                id="rg" 
                                name="riwayat_ginekologi[]" 
                                value="rg"
                                @if(is_array(old('riwayat_ginekologi')) && in_array('rg', old('riwayat_ginekologi')))
                                    checked
                                @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('rg', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi, true) ?? []))
                                    checked
                                @endif
                                > 

                                <input type="text" readonly
                                    value="@if(old('ket_riwayat_ginekologi')){{ old('ket_riwayat_ginekologi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_ginekologi : '' }}@endif"
                                    id="ket_riwayat_ginekologi" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('riwayat_ginekologi'))
                                        {{ old('riwayat_ginekologi') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                5. Riwayat Penyakit Kehamilan
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'terdaftar' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'terdaftar' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="terdaftar" name="radio_riwayat_penyakit_kehamilan"> Terdaftar 
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'anemia' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'anemia' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="anemia" name="radio_riwayat_penyakit_kehamilan" class="ml-4"> Anemia  
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'vitium_cordis' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'vitium_cordis' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="vitium_cordis" name="radio_riwayat_penyakit_kehamilan" class="ml-4"> Vitium Cordis
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'diabetes' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'diabetes' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="diabetes" name="radio_riwayat_penyakit_kehamilan" class="ml-4"> Diabetes
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'hipertensi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'hipertensi' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="hipertensi" name="radio_riwayat_penyakit_kehamilan" class="ml-4"> Hipertensi
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'tbc' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'tbc' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="tbc" name="radio_riwayat_penyakit_kehamilan" class="ml-4"> TBC
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'hepatitis' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'hepatitis' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="hepatitis" name="radio_riwayat_penyakit_kehamilan" class="ml-4"> Hepatitis
                        <br>
                        <input @if(old('riwayat_penyakit_kehamilan'))
                                    {{ old('riwayat_penyakit_kehamilan') ==  'aca' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan == 'aca' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="aca" name="radio_riwayat_penyakit_kehamilan"> ACA
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                6. Riwayat Operasi
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                <input onclick="cek_radio_riwayat_operasi()" @if(old('riwayat_operasi'))
                                        {{ old('riwayat_operasi') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="radio_riwayat_operasi"> Tidak
                                <input onclick="cek_radio_riwayat_operasi()" @if(old('riwayat_operasi'))
                                        {{ old('riwayat_operasi') ==  'ya' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'ya' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ya" name="radio_riwayat_operasi" class="ml-4"> Ya, Jenis 
                            </div>
                            <div class="col-print-3">
                                : 
                                <input type="text" readonly
                                    value="@if(old('ket_riwayat_operasi')){{ old('ket_riwayat_operasi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_operasi : '' }}@endif"
                                    id="ket_riwayat_operasi" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('riwayat_operasi'))
                                        {{ old('riwayat_operasi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                            <div class="col-print-6">
                                Tempat : 
                                <input type="text" readonly
                                    value="@if(old('tempat_riwayat_operasi')){{ old('tempat_riwayat_operasi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tempat_riwayat_operasi : '' }}@endif"
                                    id="tempat_riwayat_operasi" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('riwayat_operasi'))
                                        {{ old('riwayat_operasi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                7. Komplikasi Kehamilan Sebelumnya
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                <input onclick="cek_radio_komplikasi_kehamilan()" @if(old('komplikasi_kehamilan'))
                                        {{ old('komplikasi_kehamilan') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="radio_komplikasi_kehamilan"> Tidak
                                <input onclick="cek_radio_komplikasi_kehamilan()" @if(old('komplikasi_kehamilan'))
                                        {{ old('komplikasi_kehamilan') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="radio_komplikasi_kehamilan" class="ml-4"> Ada
                            </div>
                            <div class="col-print-9">
                                :
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->det_komplikasi_kehamilan == 'hav' ? 'checked' : '') : '' }}
                                    type="radio" value="hav" class="radio_det_komplikasi_kehamilan" name="radio_det_komplikasi_kehamilan" disabled> HAV
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->det_komplikasi_kehamilan == 'hpp' ? 'checked' : '') : '' }}
                                    type="radio" value="hpp" class="radio_det_komplikasi_kehamilan" name="radio_det_komplikasi_kehamilan" disabled class="ml-4"> HPP
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->det_komplikasi_kehamilan == 'peb' ? 'checked' : '') : '' }}
                                    type="radio" value="peb" class="radio_det_komplikasi_kehamilan" name="radio_det_komplikasi_kehamilan" disabled class="ml-4"> PEB/PER/Eklamasi
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->det_komplikasi_kehamilan == 'lain_lain' ? 'checked' : '') : '' }}
                                    type="radio" value="lain_lain" class="radio_det_komplikasi_kehamilan" name="radio_det_komplikasi_kehamilan" disabled class="ml-4">
                                <input type="text" readonly
                                    value="@if(old('ket_det_komplikasi_kehamilan')){{ old('ket_det_komplikasi_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_det_komplikasi_kehamilan : '' }}@endif"
                                    id="ket_det_komplikasi_kehamilan" style="border: 0; border-bottom: 2px dotted;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                8. Riwayat Imunisasi
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input @if(old('riwayat_imunisasi'))
                                    {{ old('riwayat_imunisasi') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="tidak" name="radio_riwayat_imunisasi"> Tidak 
                        <input @if(old('riwayat_imunisasi'))
                                    {{ old('riwayat_imunisasi') ==  'ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi == 'ya' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="ya" name="radio_riwayat_imunisasi" class="ml-4"> Ya
                        <input @if(old('riwayat_imunisasi'))
                                    {{ old('riwayat_imunisasi') ==  'tt1' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi == 'tt1' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="tt1" name="radio_riwayat_imunisasi" class="ml-4"> TT1
                        <input @if(old('riwayat_imunisasi'))
                                    {{ old('riwayat_imunisasi') ==  'tt2' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi == 'tt2' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="tt2" name="radio_riwayat_imunisasi" class="ml-4"> TT2
                        <input @if(old('riwayat_imunisasi'))
                                    {{ old('riwayat_imunisasi') ==  'tt3' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi == 'tt3' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="tt3" name="radio_riwayat_imunisasi" class="ml-4"> TT3
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        9. Riwayat Kehamilan, Persalinan, dan Nipas : 
                        <span class="ml-4">
                            G : 
                        </span>
                        <input type="text" value="@if(old('g_riwayat_kehamilan')){{ old('g_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->g_riwayat_kehamilan : '' }}@endif"
                            id="g_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 30px;">
                        <span class="ml-4">
                            P : 
                        </span>
                        <input type="text" value="@if(old('p_riwayat_kehamilan')){{ old('p_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->p_riwayat_kehamilan : '' }}@endif"
                            id="p_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 30px;">
                        <span class="ml-4">
                            A :
                        </span>
                        <input type="text" value="@if(old('a_riwayat_kehamilan')){{ old('a_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->a_riwayat_kehamilan : '' }}@endif"
                            id="a_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 30px;">
                        <span class="ml-4">
                            Hidup : 
                        </span>
                        <input type="text" value="@if(old('hidup_riwayat_kehamilan')){{ old('hidup_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hidup_riwayat_kehamilan : '' }}@endif"
                            id="hidup_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 30px;">
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                10. Kebiasaan Ibu Saat Hamil
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                {{-- <input onclick="cek_radio_kebiasaan_ibu_hamil()" @if(old('kebiasaan_ibu_hamil'))
                                        {{ old('kebiasaan_ibu_hamil') ==  'obat_minum' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil == 'obat_minum' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="obat_minum" name="radio_kebiasaan_ibu_hamil">  --}}
                                <input 
                                    type="checkbox" 
                                    id="obat" 
                                    name="kebiasaan_ibu_hamil[]" 
                                    value="obat"
                                    @if(is_array(old('kebiasaan_ibu_hamil')) && in_array('obat', old('kebiasaan_ibu_hamil')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('obat', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil, true) ?? []))
                                        checked
                                    @endif> 
                                    Obat - obatan yang diminum 
                            </div>
                            <div class="col-print-8">
                                :
                                {{-- <input onclick="cek_radio_obat_minum()" @if(old('obat_minum'))
                                        {{ old('obat_minum') ==  'vitamin' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'vitamin' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="vitamin" class="radio_obat_minum" name="radio_obat_minum">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="vitamin" 
                                    name="kebiasaan_ibu_hamil[]" 
                                    value="vitamin"
                                    @if(is_array(old('kebiasaan_ibu_hamil')) && in_array('vitamin', old('kebiasaan_ibu_hamil')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('vitamin', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil, true) ?? []))
                                        checked
                                    @endif> 
                                    Vitamin
                                {{-- <input onclick="cek_radio_obat_minum()" @if(old('obat_minum'))
                                        {{ old('obat_minum') ==  'jamu' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'jamu' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="jamu" class="radio_obat_minum" name="radio_obat_minum" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="jamu" 
                                    name="kebiasaan_ibu_hamil[]" 
                                    value="jamu"
                                    @if(is_array(old('kebiasaan_ibu_hamil')) && in_array('jamu', old('kebiasaan_ibu_hamil')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('jamu', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil, true) ?? []))
                                        checked
                                    @endif> 
                                    Jamu - Jamuan
                                {{-- <input onclick="cek_radio_obat_minum()" @if(old('obat_minum'))
                                        {{ old('obat_minum') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" class="radio_obat_minum" name="radio_obat_minum" class="ml-4"> --}}
                                    <input 
                                    type="checkbox" 
                                    id="lain_lain" 
                                    name="kebiasaan_ibu_hamil[]" 
                                    value="lain_lain"
                                    @if(is_array(old('kebiasaan_ibu_hamil')) && in_array('lain_lain', old('kebiasaan_ibu_hamil')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('lain_lain', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil, true) ?? []))
                                        checked
                                    @endif> 

                                <input type="text" readonly
                                    value="@if(old('ket_obat_minum_lain_lain')){{ old('ket_obat_minum_lain_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_obat_minum_lain_lain : '' }}@endif"
                                    id="ket_obat_minum_lain_lain" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('obat_minum'))
                                        {{ old('obat_minum') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                {{-- <input onclick="cek_radio_kebiasaan_ibu_hamil()" @if(old('kebiasaan_ibu_hamil'))
                                        {{ old('kebiasaan_ibu_hamil') ==  'merokok' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil == 'merokok' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="merokok" name="radio_kebiasaan_ibu_hamil">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="merokok" 
                                    name="kebiasaan_ibu_hamil[]" 
                                    value="merokok"
                                    @if(is_array(old('kebiasaan_ibu_hamil')) && in_array('merokok', old('kebiasaan_ibu_hamil')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('merokok', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil, true) ?? []))
                                        checked
                                    @endif> 
                                    Merokok
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                11. Pemeriksaan Kebidanan
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-5">
                                TFU : 
                                <input type="text" value="@if(old('tfu')){{ old('tfu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tfu : '' }}@endif"
                                    id="tfu" style="border: 0; border-bottom: 2px dotted; width: 30px"> cm
                                TBJ : 
                                <input type="text" value="@if(old('tbj')){{ old('tbj') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tbj : '' }}@endif"
                                    id="tbj" style="border: 0; border-bottom: 2px dotted; width: 30px">
                                Letak : 
                                <input type="text" value="@if(old('letak')){{ old('letak') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->letak : '' }}@endif"
                                    id="letak" style="border: 0; border-bottom: 2px dotted; width: 30px">
                            </div>
                            <div class="col-print-7">
                                Presentase :
                                {{-- <input onclick="cek_radio_persentase_kebidanan()" @if(old('persentase_kebidanan'))
                                        {{ old('persentase_kebidanan') ==  'kep' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan == 'kep' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="kep" name="radio_persentase_kebidanan">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="kepala" 
                                    name="persentase_kebidanan[]" 
                                    value="kepala"
                                    @if(is_array(old('persentase_kebidanan')) && in_array('kepala', old('persentase_kebidanan')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('kepala', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan, true) ?? []))
                                        checked
                                    @endif> 
                                    Kepala
                                {{-- <input onclick="cek_radio_persentase_kebidanan()" @if(old('persentase_kebidanan'))
                                        {{ old('persentase_kebidanan') ==  'bokong' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan == 'bokong' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="bokong" name="radio_persentase_kebidanan" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="bokong" 
                                    name="persentase_kebidanan[]" 
                                    value="bokong"
                                    @if(is_array(old('persentase_kebidanan')) && in_array('bokong', old('persentase_kebidanan')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('bokong', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan, true) ?? []))
                                        checked
                                    @endif> 
                                    Bokong
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-5">
                            </div>
                            <div class="col-print-7">
                                {{-- <input onclick="cek_radio_persentase_kebidanan()" @if(old('persentase_kebidanan'))
                                        {{ old('persentase_kebidanan') ==  'penurunan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan == 'penurunan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="penurunan" name="radio_persentase_kebidanan" style="padding-left: 90px">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="penurunan" 
                                    name="persentase_kebidanan[]" 
                                    value="penurunan"
                                    @if(is_array(old('persentase_kebidanan')) && in_array('penurunan', old('persentase_kebidanan')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('penurunan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan, true) ?? []))
                                        checked
                                    @endif> 
                                    Penurunan
                                <input type="text" readonly
                                    value="@if(old('ket_persentase_kebidanan')){{ old('ket_persentase_kebidanan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_persentase_kebidanan : '' }}@endif"
                                    id="ket_persentase_kebidanan" style="border: 0; border-bottom: 2px dotted;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                Kontraksi/HIS : 
                                <input type="text" value="@if(old('kontraksi')){{ old('kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kontraksi : '' }}@endif"
                                        id="kontraksi" style="border: 0; border-bottom: 2px dotted; width: 100px"> x/10,
                            </div>
                            <div class="col-print-4">
                                Kekuatan : 
                                <input type="text" value="@if(old('kekuatan')){{ old('kekuatan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kekuatan : '' }}@endif"
                                        id="kekuatan" style="border: 0; border-bottom: 2px dotted; width: 100px">
                            </div>
                            <div class="col-print-4">
                                Lamanya : 
                                <input type="number" value="@if(old('lama')){{ old('lama') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lama : '' }}@endif"
                                        id="lama" style="border: 0; border-bottom: 2px dotted; width: 100px"> detik
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                Gerak Janin : 
                                <input type="text" value="@if(old('gerak_janin')){{ old('gerak_janin') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->gerak_janin : '' }}@endif"
                                        id="gerak_janin" style="border: 0; border-bottom: 2px dotted; width: 100px"> x/30 menit,
                            </div>
                            <div class="col-print-8">
                                BJS : 
                                <input type="text" value="@if(old('bjs')){{ old('bjs') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->bjs : '' }}@endif"
                                        id="bjs" style="border: 0; border-bottom: 2px dotted;"> menit :
                                <input @if(old('rad_gerak_janin'))
                                        {{ old('rad_gerak_janin') ==  'teratur' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->rad_gerak_janin == 'teratur' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="teratur" name="rad_gerak_janin"> Teratur
                                <input @if(old('rad_gerak_janin'))
                                        {{ old('rad_gerak_janin') ==  'tidak_teratur' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->rad_gerak_janin == 'tidak_teratur' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_teratur" name="rad_gerak_janin" class="ml-4"> Tidak Teratur
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                PD a/l : 
                                <input type="text" value="@if(old('pd')){{ old('pd') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pd : '' }}@endif"
                                id="pd" style="border: 0; border-bottom: 2px dotted; width: 50px"> cm
                            </div>
                            <div class="col-print-4">
                                Oleh : 
                                <input type="text" value="@if(old('oleh')){{ old('oleh') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oleh : '' }}@endif"
                                id="oleh" style="border: 0; border-bottom: 2px dotted; width: 50px">
                            </div>
                            <div class="col-print-4">
                                Partio : 
                                <input type="text" value="@if(old('partio')){{ old('partio') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->partio : '' }}@endif"
                                id="partio" style="border: 0; border-bottom: 2px dotted; width: 50px">
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                Pembukaan Servik / Ketuban 
                                <span style="float: right"> : </span>
                            </div>
                            <div class="col-print-3">
                                <input @if(old('pembukaan_servik'))
                                    {{ old('pembukaan_servik') ==  'utuh' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pembukaan_servik == 'utuh' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="utuh" name="radio_pembukaan_servik"> Utuh
                            </div>
                            <div class="col-print-3">
                                <input @if(old('pembukaan_servik'))
                                    {{ old('pembukaan_servik') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pembukaan_servik == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="tidak" name="radio_pembukaan_servik"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Hodge : 
                        <input type="text" value="@if(old('hodge')){{ old('hodge') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hodge : '' }}@endif"
                                        id="hodge" style="border: 0; border-bottom: 2px dotted; width: 90%">
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                Tanda - Tanda Persalinan
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                {{-- <input onclick="cek_radio_tanda_persalinan()" @if(old('tanda_persalinan'))
                                        {{ old('tanda_persalinan') ==  'mules' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'mules' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="mules" name="radio_tanda_persalinan">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="mules" 
                                    name="tanda_persalinan[]" 
                                    value="mules"
                                    @if(is_array(old('tanda_persalinan')) && in_array('mules', old('tanda_persalinan')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('mules', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan, true) ?? []))
                                        checked
                                    @endif> 
                                    Mules
                            </div>
                            <div class="col-print-10">
                                {{-- <input onclick="cek_radio_tanda_persalinan()" @if(old('tanda_persalinan'))
                                        {{ old('tanda_persalinan') ==  'kontraksi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'kontraksi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="kontraksi" name="radio_tanda_persalinan">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="tp_kontraksi" 
                                    name="tanda_persalinan[]" 
                                    value="tp_kontraksi"
                                    @if(is_array(old('tanda_persalinan')) && in_array('tp_kontraksi', old('tanda_persalinan')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('tp_kontraksi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan, true) ?? []))
                                        checked
                                    @endif> 
                                    Kontraksi, mulai tanggal :
                                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kontraksi" readonly
                                        value="@if(old('tgl_kontraksi')){{ old('tgl_kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_kontraksi : '' }}@endif"
                                        @if(old('tanda_persalinan'))
                                            {{ old('tanda_persalinan') ==  'kontraksi' ? '' : 'readonly' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'kontraksi' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                                    , Jam :
                                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_kontraksi" readonly
                                        value="@if(old('jam_kontraksi')){{ old('jam_kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_kontraksi : '' }}@endif"
                                        @if(old('tanda_persalinan'))
                                            {{ old('tanda_persalinan') ==  'kontraksi' ? '' : 'readonly' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'kontraksi' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Keluar
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                        {{ old('keluar') ==  'darah' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'darah' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="darah" name="radio_keluar"> Darah
                                <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4">
                                <input @if(old('keluar_darah'))
                                        {{ old('keluar_darah') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_darah == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="keluar_radio_darah"> Ada
                                <input @if(old('keluar_darah'))
                                        {{ old('keluar_darah') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_darah == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="keluar_radio_darah"> Tidak
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                        {{ old('keluar') ==  'air_ketuban' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'air_ketuban' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="air_ketuban" name="radio_keluar"> Air Ketuban
                                <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4">
                                <input @if(old('keluar_air_ketuban'))
                                        {{ old('keluar_air_ketuban') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_air_ketuban == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="keluar_radio_air_ketuban"> Ada
                                <input @if(old('keluar_air_ketuban'))
                                        {{ old('keluar_air_ketuban') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_air_ketuban == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="keluar_radio_air_ketuban"> Tidak
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                        {{ old('keluar') ==  'lendir' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'lendir' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lendir" name="radio_keluar"> Lendir
                                <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4">
                                <input @if(old('keluar_lendir'))
                                        {{ old('keluar_lendir') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_lendir == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="keluar_radio_lendir"> Ada
                                <input @if(old('keluar_lendir'))
                                        {{ old('keluar_lendir') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_lendir == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="keluar_radio_lendir"> Tidak
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                        {{ old('keluar') ==  'dislokasi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'dislokasi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="dislokasi" name="radio_keluar"> Dislokasi
                                <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4">
                                <input @if(old('keluar_dislokasi'))
                                        {{ old('keluar_dislokasi') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_dislokasi == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="keluar_radio_dislokasi"> Ada
                                <input @if(old('keluar_dislokasi'))
                                        {{ old('keluar_dislokasi') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_dislokasi == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="keluar_radio_dislokasi"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="page_break"></div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr style="border: 1px solid">
                    <td colspan="4" style="text-align: center">
                        <b>RIWAYAT KESEHATAN ANAK</b>
                        {{-- <br> --}}
                        <span style="font-size: 10px; font-style: italic;">(diisi pada pasien Anak/Pediatrik/Neonatus)</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                1. Riwayat Prenatal
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-left: 30px">
                                <input type="checkbox" onchange="cek_anak_ke()" @if(isset($dokumen->formulir_triage_terintegrasi))
                                    {{ in_array('anak_ke',json_decode($dokumen->formulir_triage_terintegrasi->anak_ke )) ? 'checked' : '' }}
                                @endif id="anak_ke"> Anak Ke : 
                                <input type="number" id="ket_anak_ke" readonly style="border: hidden; border-bottom: 1px dotted; width: 50px"
                                value="@if(old('ket_anak_ke')){{ old('ket_anak_ke') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_anak_ke : '' }}@endif"
                                id="ket_anak_ke">
                                Umur Kehamilan : 
                                <input type="number" id="umur_kehamilan" readonly style="border: hidden; border-bottom: 1px dotted; width: 50px;"
                                value="@if(old('umur_kehamilan')){{ old('umur_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->umur_kehamilan : '' }}@endif"
                                id="umur_kehamilan"> minggu
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-3" style="padding-left: 30px">
                                Riwayat Penyakit Ibu
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-12" style="padding-left: 30px">
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'dm' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'dm' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="dm" name="radio_penyakit_ibu">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="dm" 
                                    name="penyakit_ibu[]" 
                                    value="dm"
                                    @if(is_array(old('penyakit_ibu')) && in_array('dm', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('dm', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                    DM &nbsp;&nbsp;
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'hipertensi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'hipertensi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="hipertensi" name="radio_penyakit_ibu" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="hipertensi" 
                                    name="penyakit_ibu[]" 
                                    value="hipertensi"
                                    @if(is_array(old('penyakit_ibu')) && in_array('hipertensi', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('hipertensi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                    Hipertensi&nbsp;&nbsp;
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'jantung' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'jantung' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="jantung" name="radio_penyakit_ibu" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="jantung" 
                                    name="penyakit_ibu[]" 
                                    value="jantung"
                                    @if(is_array(old('penyakit_ibu')) && in_array('jantung', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('jantung', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                    Jantung&nbsp;&nbsp;
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'tbc' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'tbc' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tbc" name="radio_penyakit_ibu" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="tbc" 
                                    name="penyakit_ibu[]" 
                                    value="tbc"
                                    @if(is_array(old('penyakit_ibu')) && in_array('tbc', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('tbc', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                    TBC&nbsp;&nbsp;
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'hepb' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'hepb' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="hepb" name="radio_penyakit_ibu" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="hepb" 
                                    name="penyakit_ibu[]" 
                                    value="hepb"
                                    @if(is_array(old('penyakit_ibu')) && in_array('hepb', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('hepb', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                    Hep B&nbsp;&nbsp;
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'asma' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'asma' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="asma" name="radio_penyakit_ibu" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="asma" 
                                    name="penyakit_ibu[]" 
                                    value="asma"
                                    @if(is_array(old('penyakit_ibu')) && in_array('asma', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('asma', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                    Asma&nbsp;&nbsp;
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'alergi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'alergi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="alergi" name="radio_penyakit_ibu" class="ml-4">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="alergi" 
                                    name="penyakit_ibu[]" 
                                    value="alergi"
                                    @if(is_array(old('penyakit_ibu')) && in_array('alergi', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('alergi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                    Alergi&nbsp;&nbsp;
                                <br>
                                {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_penyakit_ibu"> --}}
                                    <input 
                                    type="checkbox" 
                                    id="pi_riwayat" 
                                    name="penyakit_ibu[]" 
                                    value="pi_riwayat"
                                    @if(is_array(old('penyakit_ibu')) && in_array('pi_riwayat', old('penyakit_ibu')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('pi_riwayat', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu, true) ?? []))
                                        checked
                                    @endif> 
                                <input type="text" readonly
                                    value="@if(old('ket_penyakit_ibu')){{ old('ket_penyakit_ibu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_penyakit_ibu : '' }}@endif"
                                    id="ket_penyakit_ibu" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('penyakit_ibu'))
                                        {{ old('penyakit_ibu') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-3" style="padding-left: 30px">
                                Riwayat Pengobatan Ibu 
                                <span style="float: right"> : </span>
                            </div>
                            <div class="col-print-9">
                                <span style="border-bottom: 1px dotted">
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_pengobatan_ibu : '' }}
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                2. Riwayat Persalinan
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-2" style="padding-left: 30px">
                                Ditolong <span style="float: right">:</span>
                            </div>
                            <div class="col-print-10">
                                <input onclick="cek_radio_riwayat_persalinan()" @if(old('riwayat_persalinan'))
                                        {{ old('riwayat_persalinan') ==  'dokter' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'dokter' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="dokter" name="radio_riwayat_persalinan"> Dokter
                                <input onclick="cek_radio_riwayat_persalinan()" @if(old('riwayat_persalinan'))
                                        {{ old('riwayat_persalinan') ==  'bidan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'bidan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="bidan" name="radio_riwayat_persalinan" class="ml-4"> Bidan
                                <input onclick="cek_radio_riwayat_persalinan()" @if(old('riwayat_persalinan'))
                                        {{ old('riwayat_persalinan') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_riwayat_persalinan" class="ml-4">
                                <input type="text" readonly
                                    value="@if(old('ket_riwayat_persalinan')){{ old('ket_riwayat_persalinan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_persalinan : '' }}@endif"
                                    id="ket_riwayat_persalinan" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('riwayat_persalinan'))
                                        {{ old('riwayat_persalinan') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                3. Riwayat Intranatal
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-2" style="padding-left: 30px">
                                Diagnosa Ibu <span style="float: right">:</span>
                            </div>
                            <div class="col-print-10">
                                <span style="border-bottom: 1px dotted">
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_diagnosa_ibu : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-2" style="padding-left: 30px">
                                Tanggal Lahir <span style="float: right">:</span>
                            </div>
                            <div class="col-print-10">
                                <input type="date" id="tanggal_lahir_intranatal" style="border: hidden; border-bottom: 1px dotted; width: 50px"
                                    value="@if(old('tanggal_lahir_intranatal')){{ old('tanggal_lahir_intranatal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tanggal_lahir_intranatal : '' }}@endif"
                                    id="tanggal_lahir_intranatal" class="ml-2">
                                Kondisi Saat Lahir : 
                                <input type="number" id="kondisi_saat_lahir" style="border: hidden; border-bottom: 1px dotted; width: 50px"
                                    value="@if(old('kondisi_saat_lahir')){{ old('kondisi_saat_lahir') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kondisi_saat_lahir : '' }}@endif"
                                    id="kondisi_saat_lahir"> gram, 
                                <input onclick="cek_radio_riwayat_intranatal()" @if(old('riwayat_intranatal'))
                                        {{ old('riwayat_intranatal') ==  'aspixia' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_intranatal == 'aspixia' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="aspixia" name="radio_riwayat_intranatal" class="ml-4"> Aspixia
                                <input onclick="cek_radio_riwayat_intranatal()" @if(old('riwayat_intranatal'))
                                        {{ old('riwayat_intranatal') ==  'apgar_score' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_intranatal == 'apgar_score' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="apgar_score" name="radio_riwayat_intranatal" class="ml-4"> Apgar Score
                                <input type="text" readonly
                                    value="@if(old('ket_riwayat_intranatal')){{ old('ket_riwayat_intranatal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_intranatal : '' }}@endif"
                                    id="ket_riwayat_intranatal" style="border: 0; border-bottom: 2px dotted; width: 50px">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-2" style="padding-left: 30px">
                                Cara Bersalin <span style="float: right">:</span>
                            </div>
                            <div class="col-print-10">
                                <input @if(old('cara_bersalin'))
                                        {{ old('cara_bersalin') ==  'spontan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'spontan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="spontan" name="radio_cara_bersalin" class="ml-2"> Spontan
                                <input @if(old('cara_bersalin'))
                                        {{ old('cara_bersalin') ==  'vacum_ekstraksi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'vacum_ekstraksi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="vacum_ekstraksi" name="radio_cara_bersalin" class="ml-4"> Vacum Ekstraksi
                                <input @if(old('cara_bersalin'))
                                        {{ old('cara_bersalin') ==  'porcep_ekstaksi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'porcep_ekstaksi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="porcep_ekstaksi" name="radio_cara_bersalin" class="ml-4"> Porcep Ekstaksi
                                <input @if(old('cara_bersalin'))
                                        {{ old('cara_bersalin') ==  'sectio_caesarean' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'sectio_caesarean' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="sectio_caesarean" name="radio_cara_bersalin" class="ml-4"> Sectio Caesarean
                            </div>
                        </div>
                        <div class="row" style="padding-left: 30px">
                            Letak <input type="text" id="letak_tali_pusat" style="border: hidden; border-bottom: 1px dotted; width: 100px"
                                    value="@if(old('letak_tali_pusat')){{ old('letak_tali_pusat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->letak_tali_pusat : '' }}@endif"
                                    id="letak_tali_pusat"> Tali Pusat
                            <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                        {{ old('tali_pusat') ==  'segar' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'segar' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="segar" name="radio_tali_pusat" class="ml-4"> Segar
                            <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                        {{ old('tali_pusat') ==  'layu' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'layu' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="layu" name="radio_tali_pusat" class="ml-4"> Layu
                            <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                        {{ old('tali_pusat') ==  'simpul' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'simpul' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="simpul" name="radio_tali_pusat" class="ml-4"> Simpul
                            <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                        {{ old('tali_pusat') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_tali_pusat" class="ml-4"> 
                            <input type="text" readonly
                                value="@if(old('ket_tali_pusat')){{ old('ket_tali_pusat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_tali_pusat : '' }}@endif"
                                id="ket_tali_pusat" style="border: 0; border-bottom: 2px dotted; width: 100px"
                                @if(old('tali_pusat'))
                                    {{ old('tali_pusat') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                4. Status Perkembangan Anak
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                        <div class="row" style="padding-left: 30px;">
                            <div class="col-print-2">
                                <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                        {{ old('perkembangan_anak') ==  'berguling' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berguling' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="berguling" name="radio_perkembangan_anak"> 
                                Berguling <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4" style="vertical-align: text-bottom">
                                <span style="border-bottom: 1px dotted">
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_berguling : '' }}
                                </span>
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                        {{ old('perkembangan_anak') ==  'duduk' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'duduk' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="duduk" name="radio_perkembangan_anak"> 
                                Duduk <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4" style="vertical-align: text-bottom">
                                <span style="border-bottom: 1px dotted">
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_duduk : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="row" style="padding-left: 30px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                        {{ old('perkembangan_anak') ==  'berjalan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berjalan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="berjalan" name="radio_perkembangan_anak"> 
                                Berjalan <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4">
                                <span style="border-bottom: 1px dotted">
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_berjalan : '' }}
                                </span>
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                        {{ old('perkembangan_anak') ==  'berdiri' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berdiri' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="berdiri" name="radio_perkembangan_anak"> 
                                Berdiri <span style="float: right">:</span>
                            </div>
                            <div class="col-print-4">
                                <span style="border-bottom: 1px dotted">
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_berdiri : '' }}
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">
                                5. Faktor Resiko Infeksi 
                            </div>
                            <div class="col-print-1">
                                :
                            </div>
                        </div>
                        <div class="row" style="padding-left: 30px">
                            <div class="col-print-2">
                                <input @if(old('resiko_infeksi'))
                                        {{ old('resiko_infeksi') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_infeksi == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="radio_resiko_infeksi"> Ada
                            </div>
                            <div class="col-print-2">
                                <input @if(old('resiko_infeksi'))
                                        {{ old('resiko_infeksi') ==  'tidak_ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_infeksi == 'tidak_ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_ada" name="radio_resiko_infeksi"> Tidak Ada
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-1">
                                Mayor <span style="float: right">:</span>
                            </div>
                        </div>
                        <div class="row" style="padding-left: 30px">
                            <div class="col-print-4">
                                {{-- <input @if(old('mayor'))
                                        {{ old('mayor') ==  'ibu_demam' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'ibu_demam' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ibu_demam" name="radio_mayor">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="ibu_demam" 
                                    name="mayor[]" 
                                    value="ibu_demam"
                                    @if(is_array(old('mayor')) && in_array('ibu_demam', old('mayor')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('ibu_demam', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor, true) ?? []))
                                        checked
                                    @endif> 
                                    Ibu Demam Lebih Dari 38 &deg; C
                            </div>
                            <div class="col-print-2">
                                {{-- <input @if(old('mayor'))
                                        {{ old('mayor') ==  'kpd' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'kpd' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="kpd" name="radio_mayor">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="kpd" 
                                    name="mayor[]" 
                                    value="kpd"
                                    @if(is_array(old('mayor')) && in_array('kpd', old('mayor')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('kpd', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor, true) ?? []))
                                        checked
                                    @endif> 
                                    KPD > 24 Jam
                            </div>
                            <div class="col-print-3">
                                {{-- <input @if(old('mayor'))
                                        {{ old('mayor') ==  'ketuban_hijau' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'ketuban_hijau' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ketuban_hijau" name="radio_mayor"> --}}
                                    <input 
                                    type="checkbox" 
                                    id="ketuban_hijau" 
                                    name="mayor[]" 
                                    value="ketuban_hijau"
                                    @if(is_array(old('mayor')) && in_array('ketuban_hijau', old('mayor')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('ketuban_hijau', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor, true) ?? []))
                                        checked
                                    @endif> 
                                    Ketuban Hijau
                            </div>
                            <div class="col-print-3">
                                {{-- <input @if(old('mayor'))
                                        {{ old('mayor') ==  'vetal_distress' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'vetal_distress' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="vetal_distress" name="radio_mayor">  --}}
                                    <input 
                                    type="checkbox" 
                                    id="fetal" 
                                    name="mayor[]" 
                                    value="fetal"
                                    @if(is_array(old('mayor')) && in_array('fetal', old('mayor')))
                                        checked
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('fetal', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor, true) ?? []))
                                        checked
                                    @endif> 
                                    Vetal Distress
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-1">
                                Minor <span style="float: right">:</span>
                            </div>
                        </div>
                        <div class="row" style="padding-left: 30px">
                            <div class="col-print-2">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'kpd' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'kpd' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="kpd" name="radio_minor"> KPD > 12 Jam
                            </div>
                            <div class="col-print-2">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'aspixia' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'aspixia' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="aspixia" name="radio_minor"> Aspixia
                            </div>
                            <div class="col-print-2">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'bblr' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'bblr' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="bblr" name="radio_minor"> BBLR
                            </div>
                            <div class="col-print-2">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'isk' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'isk' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="isk" name="radio_minor"> ISK
                            </div>
                            <div class="col-print-2">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'uk' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'uk' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="uk" name="radio_minor"> UK > 37 Jam
                            </div>
                            <div class="col-print-2">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'gemeli' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'gemeli' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="gemeli" name="radio_minor"> Gemeli
                            </div>
                        </div>
                        <div class="row" style="padding-left: 30px">
                            <div class="col-print-2">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'keputihan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'keputihan' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="keputihan" name="radio_minor"> Keputihan
                            </div>
                            <div class="col-print-4">
                                <input @if(old('minor'))
                                    {{ old('minor') ==  'ibu_demam' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->minor == 'ibu_demam' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="ibu_demam" name="radio_minor"> Ibu Temperatur Lebih dari 37<sup>o</sup>C
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="border: 1px solid">
                    <td colspan="4" style="text-align: center">
                        <b>PEMERIKSAAN FISIK</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                Kesadaran
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                    {{ old('kesadaran3') ==  'compos_mentis' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'compos_mentis' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="compos_mentis" name="radio_kesadaran3"> Compos Mentis
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                    {{ old('kesadaran3') ==  'apatis' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'apatis' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="apatis" name="radio_kesadaran3"> Apatis
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                    {{ old('kesadaran3') ==  'somnolen' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'somnolen' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="somnolen" name="radio_kesadaran3"> Somnolen
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                    {{ old('kesadaran3') ==  'soporkoma' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'soporkoma' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="soporkoma" name="radio_kesadaran3"> Soporkoma
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                    {{ old('kesadaran3') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="lain_lain" name="radio_kesadaran3">
                                <input type="text" readonly
                                    value="@if(old('ket_kesadaran3')){{ old('ket_kesadaran3') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kesadaran3 : '' }}@endif"
                                    id="ket_kesadaran3" style="border: 0; border-bottom: 2px dotted; width: 100px"
                                    @if(old('kesadaran3'))
                                        {{ old('kesadaran3') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                Keadaan Umum <span style="float: right">:  </span>
                            </div>
                            <div class="col-print-6">
                                &nbsp;{{ $layanan->tanda_vital ? $layanan->tanda_vital->keadaan_umum : '..../....' }} 
                                {{-- <input type="text" id="keadaan_umum2" readonly style="border: hidden; border-bottom: 1px dotted; width: 150px"
                                    value="@if(old('keadaan_umum2')){{ old('keadaan_umum2') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keadaan_umum2 : '' }}@endif"
                                    id="keadaan_umum2">&nbsp; --}}
                            </div>
                            <div class="col-print-4">
                                BB : 
                                {{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '..../....' }} Kg
                                {{-- <input type="number" id="bb" readonly style="border: hidden; border-bottom: 1px dotted; width: 100px"
                                value="@if(old('bb')){{ old('bb') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->bb : '' }}@endif"
                                id="bb">  --}}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                Tanda Vital <span style="float: right">:</span>
                            </div>
                            <div class="col-print-2">
                                TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                            </div>
                            <div class="col-print-2">
                                RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                            </div>
                            <div class="col-print-2">
                                Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                            </div>
                            <div class="col-print-2">
                                Suhu {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} &deg;C
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="border: 1px solid">
                    <td colspan="5" style="text-align: center">
                        <b>URAIAN</b>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 17%">
                        Kepala 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                        {{ old('uraian_kepala') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_kepala"> Normal
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                        {{ old('uraian_kepala') ==  'benjolan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'benjolan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="benjolan" name="radio_uraian_kepala"> Benjolan
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                        {{ old('uraian_kepala') ==  'luka' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'luka' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="luka" name="radio_uraian_kepala"> Luka
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                        {{ old('uraian_kepala') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_kepala"> 
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_kepala')){{ old('ket_uraian_kepala') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_kepala : '' }}@endif"
                                    id="ket_uraian_kepala" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('uraian_kepala'))
                                        {{ old('uraian_kepala') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Mata 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                        {{ old('uraian_mata') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_mata"> Normal
                            </div>
                            <div class="col-print-2">
                                Pupil : <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                        {{ old('uraian_mata') ==  'isokor' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'isokor' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="isokor" name="radio_uraian_mata"> Isoko
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                        {{ old('uraian_mata') ==  'anisokor' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'anisokor' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="anisokor" name="radio_uraian_mata"> Anisokor
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                        {{ old('uraian_mata') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_mata"> 
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_mata')){{ old('ket_uraian_mata') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_mata : '' }}@endif"
                                    id="ket_uraian_mata" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('uraian_mata'))
                                        {{ old('uraian_mata') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        THT 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                        {{ old('uraian_tht') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_tht"> Normal
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                        {{ old('uraian_tht') ==  'luka' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'luka' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="luka" name="radio_uraian_tht"> Luka
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                        {{ old('uraian_tht') ==  'sumbatan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'sumbatan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="sumbatan" name="radio_uraian_tht"> Sumbatan
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                        {{ old('uraian_tht') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_tht"> 
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_tht')){{ old('ket_uraian_tht') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_tht : '' }}@endif"
                                    id="ket_uraian_tht" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('uraian_tht'))
                                        {{ old('uraian_tht') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Mulut 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                        {{ old('uraian_mulut') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_mulut"> Normal
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                        {{ old('uraian_mulut') ==  'luka' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'luka' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="luka" name="radio_uraian_mulut"> Luka
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                        {{ old('uraian_mulut') ==  'benjolan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'benjolan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="benjolan" name="radio_uraian_mulut"> Benjolan
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                        {{ old('uraian_mulut') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_mulut"> 
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_mulut')){{ old('ket_uraian_mulut') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_mulut : '' }}@endif"
                                    id="ket_uraian_mulut" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('uraian_mulut'))
                                        {{ old('uraian_mulut') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Leher 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                        {{ old('uraian_leher') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_leher"> Normal
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                        {{ old('uraian_leher') ==  'luka' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'luka' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="luka" name="radio_uraian_leher"> Luka
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                        {{ old('uraian_leher') ==  'benjolan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'benjolan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="benjolan" name="radio_uraian_leher"> Benjolan
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                        {{ old('uraian_leher') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_leher"> 
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_leher')){{ old('ket_uraian_leher') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_leher : '' }}@endif"
                                    id="ket_uraian_leher" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('uraian_leher'))
                                        {{ old('uraian_leher') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Thorax 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                        {{ old('uraian_thorax') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_thorax"> Normal
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                        {{ old('uraian_thorax') ==  'luka' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'luka' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="luka" name="radio_uraian_thorax"> Luka
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                        {{ old('uraian_thorax') ==  'benjolan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'benjolan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="benjolan" name="radio_uraian_thorax"> Benjolan
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                        {{ old('uraian_thorax') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_thorax"> 
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_thorax')){{ old('ket_uraian_thorax') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_thorax : '' }}@endif"
                                    id="ket_uraian_thorax" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('uraian_thorax'))
                                        {{ old('uraian_thorax') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Payudara 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                        {{ old('uraian_payudara') ==  'keluar_asi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'keluar_asi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="keluar_asi" name="radio_uraian_payudara"> Keluar Asi
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                        {{ old('uraian_payudara') ==  'puting_tenggelam' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'puting_tenggelam' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="puting_tenggelam" name="radio_uraian_payudara"> Puting Datang / Tenggelam
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                        {{ old('uraian_payudara') ==  'puting_menonjol' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'puting_menonjol' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="puting_menonjol" name="radio_uraian_payudara"> Puting Menonjol
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                        {{ old('uraian_payudara') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_payudara"> 
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_payudara')){{ old('ket_uraian_payudara') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_payudara : '' }}@endif"
                                    id="ket_uraian_payudara" style="border: 0; border-bottom: 2px dotted; width: 100px">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Abdomen 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                        {{ old('uraian_abdomen') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_abdomen"> Normal
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                        {{ old('uraian_abdomen') ==  'asistes' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'asistes' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="asistes" name="radio_uraian_abdomen"> Asistes
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                        {{ old('uraian_abdomen') ==  'tegang' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'tegang' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tegang" name="radio_uraian_abdomen"> Tegang
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                        {{ old('uraian_abdomen') ==  'masa' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'masa' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="masa" name="radio_uraian_abdomen"> Masa
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                        {{ old('uraian_abdomen') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_abdomen"> Lainnya
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_abdomen')){{ old('ket_uraian_abdomen') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_abdomen : '' }}@endif"
                                    id="ket_uraian_abdomen" style="border: 0; border-bottom: 2px dotted; width: 100px">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Urogenital 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_uraian_urogenital()" @if(old('uraian_urogenital'))
                                        {{ old('uraian_urogenital') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_urogenital"> Normal
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_uraian_urogenital()" @if(old('uraian_urogenital'))
                                        {{ old('uraian_urogenital') ==  'tidak_normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'tidak_normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_normal" name="radio_uraian_urogenital"> Tidak Normal
                            </div>
                            <div class="col-print-8">
                                <input onclick="cek_radio_uraian_urogenital()" @if(old('uraian_urogenital'))
                                        {{ old('uraian_urogenital') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lain_lain" name="radio_uraian_urogenital">
                                <input type="text" readonly
                                    value="@if(old('ket_uraian_urogenital')){{ old('ket_uraian_urogenital') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_urogenital : '' }}@endif"
                                    id="ket_uraian_urogenital" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('uraian_urogenital'))
                                        {{ old('uraian_urogenital') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Ekstermitas 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input @if(old('uraian_ekstermitas'))
                                        {{ old('uraian_ekstermitas') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_ekstermitas"> Normal
                            </div>
                            <div class="col-print-2">
                                Atas : <input @if(old('uraian_ekstermitas'))
                                        {{ old('uraian_ekstermitas') ==  'atas_kuat' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'atas_kuat' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="atas_kuat" name="radio_uraian_ekstermitas"> Kuat
                            </div>
                            <div class="col-print-2">
                                <input @if(old('uraian_ekstermitas'))
                                        {{ old('uraian_ekstermitas') ==  'atas_lemah' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'atas_lemah' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="atas_lemah" name="radio_uraian_ekstermitas"> Lemah
                            </div>
                            <div class="col-print-2">
                                Bawah : <input @if(old('uraian_ekstermitas'))
                                        {{ old('uraian_ekstermitas') ==  'bawah_kuat' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'bawah_kuat' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="bawah_kuat" name="radio_uraian_ekstermitas"> Kuat
                            </div>
                            <div class="col-print-2">
                                <input @if(old('uraian_ekstermitas'))
                                        {{ old('uraian_ekstermitas') ==  'bawah_lemah' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'bawah_lemah' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="bawah_lemah" name="radio_uraian_ekstermitas"> Lemah
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Kulit 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input @if(old('uraian_kulit'))
                                        {{ old('uraian_kulit') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_kulit"> Normal
                            </div>
                            <div class="col-print-2">
                                Turgor : <input @if(old('uraian_kulit'))
                                        {{ old('uraian_kulit') ==  'baik' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'baik' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="baik" name="radio_uraian_kulit"> Baik
                            </div>
                            <div class="col-print-2">
                                <input @if(old('uraian_kulit'))
                                        {{ old('uraian_kulit') ==  'lemah' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'lemah' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="lemah" name="radio_uraian_kulit"> Lemah
                            </div>
                            <div class="col-print-2">
                                Luka : <input @if(old('uraian_kulit'))
                                        {{ old('uraian_kulit') ==  'ya' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'ya' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ya" name="radio_uraian_kulit"> Ya
                            </div>
                            <div class="col-print-2">
                                <input @if(old('uraian_kulit'))
                                        {{ old('uraian_kulit') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="radio_uraian_kulit"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid; width: 10%">
                        Jantung 
                    </td>
                    <td colspan="4" style="padding-left: 10px">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-print-2">
                                <input @if(old('uraian_jantung'))
                                        {{ old('uraian_jantung') ==  'normal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'normal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="normal" name="radio_uraian_jantung"> Normal
                            </div>
                            <div class="col-print-3">
                                Nyeri Dada : <input @if(old('uraian_jantung'))
                                        {{ old('uraian_jantung') ==  'ya' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'ya' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ya" name="radio_uraian_jantung"> Ya
                            </div>
                            <div class="col-print-3">
                                <input @if(old('uraian_jantung'))
                                        {{ old('uraian_jantung') ==  'tidak_bunyi' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'tidak_bunyi' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_bunyi" name="radio_uraian_jantung"> Tidak Bunyi Jantung
                            </div>
                            <div class="col-print-2">
                                <input @if(old('uraian_jantung'))
                                        {{ old('uraian_jantung') ==  'mumur' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'mumur' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="mumur" name="radio_uraian_jantung"> Mumur
                            </div>
                            <div class="col-print-2">
                                <input @if(old('uraian_jantung'))
                                        {{ old('uraian_jantung') ==  'gallop' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'gallop' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="gallop" name="radio_uraian_jantung"> Gallop
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table class="table_isian_bordered" style="width: 100%;">
                <tr style="border: 1px solid">
                    <td colspan="6" style="text-align: center">
                        <b>STATUS PSIKOLOGIS, SOSIAL, DAN SPIRITUAL</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%">Saudara</td>
                    <td colspan="2" style="padding-left: 5px">
                        <input onclick="cek_radio_saudara()"
                               @if(old('saudara'))
                                   {{ old('saudara') ==  'kandung' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'kandung' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="kandung" name="radio_saudara"> Kandung, Jumlah
                        <input type="number" readonly
                               value="@if(old('ket_kandung')){{ old('ket_kandung') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kandung : '' }}@endif"
                               id="ket_kandung" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('saudara'))
                            {{ old('saudara') ==  'kandung' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'kandung' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                    </td>
                    <td colspan="3" style="border-left: hidden">
                        <input onclick="cek_radio_saudara()"
                               @if(old('saudara'))
                                   {{ old('saudara') ==  'tiri' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'tiri' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tiri" name="radio_saudara"> Tiri, Jumlah
                        <input type="number" readonly
                               value="@if(old('ket_tiri')){{ old('ket_tiri') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_tiri : '' }}@endif"
                               id="ket_tiri" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('saudara'))
                            {{ old('saudara') ==  'tiri' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'tiri' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%">Tinggal Bersama</td>
                    <td colspan="5" style="padding-left: 5px;">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_tinggal_bersama()"
                                       @if(old('tinggal_bersama'))
                                           {{ old('tinggal_bersama') ==  'ortu' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'ortu' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="ortu" name="radio_tinggal_bersama"> Orang Tua
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_tinggal_bersama()"
                                       @if(old('tinggal_bersama'))
                                           {{ old('tinggal_bersama') ==  'tinggal_lainnya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'tinggal_lainnya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="tinggal_lainnya" name="radio_tinggal_bersama"> Lainnya, <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_tinggal_lainnya : '' }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%">Bicara</td>
                    <td colspan="5" style="padding-left: 5px;">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input
                                    @if(old('bicara'))
                                        {{ old('bicara') ==  'jelas' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bicara == 'jelas' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="jelas" name="radio_bicara"> Jelas
                            </div>
                            <div class="col-print-4">
                                <input
                                    @if(old('bicara'))
                                        {{ old('bicara') ==  'tidak_dimengerti' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bicara == 'tidak_dimengerti' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_dimengerti" name="radio_bicara"> Tidak Dapat Dimengerti
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%">Komunikasi</td>
                    <td colspan="5" style="padding-left: 5px;">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input
                                    @if(old('komunikasi'))
                                        {{ old('komunikasi') ==  'verbal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->komunikasi == 'verbal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="verbal" name="radio_komunikasi"> Verbal
                            </div>
                            <div class="col-print-2">
                                <input
                                    @if(old('komunikasi'))
                                        {{ old('komunikasi') ==  'non_verbal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->komunikasi == 'non_verbal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="non_verbal" name="radio_komunikasi"> Non Verbal
                            </div>
                        </div>
        
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%">Status Emosional</td>
                    <td colspan="5" style="padding-left: 5px;">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input
                                    @if(old('emosional'))
                                        {{ old('emosional') ==  'stabil' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'stabil' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="stabil" name="radio_emosional"> Stabil
                            </div>
                            <div class="col-print-2">
                                <input
                                    @if(old('emosional'))
                                        {{ old('emosional') ==  'tenang' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'tenang' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tenang" name="radio_emosional"> Tenang
                            </div>
                            <div class="col-print-2">
                                <input
                                    @if(old('emosional'))
                                        {{ old('emosional') ==  'cemas' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'cemas' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="cemas" name="radio_emosional"> Cemas
                            </div>
                            <div class="col-print-2">
                                <input
                                    @if(old('emosional'))
                                        {{ old('emosional') ==  'takut' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'takut' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="takut" name="radio_emosional"> Takut
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-5">Riwayat pernah mengalami gangguan jiwa : </div>
                            <div class="col-print-1">
                                <input onclick="cek_radio_gangguan_jiwa()"
                                       @if(old('gangguan_jiwa'))
                                           {{ old('gangguan_jiwa') ==  'tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_jiwa == 'tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="tidak" name="radio_gangguan_jiwa"> Tidak
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_gangguan_jiwa()"
                                       @if(old('gangguan_jiwa'))
                                           {{ old('gangguan_jiwa') ==  'ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_jiwa == 'ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="ya" name="radio_gangguan_jiwa"> Ya, Tahun :
                                <input type="number" id="tahun_gangguan_jiwa"
                                       value="@if(old('tahun_gangguan_jiwa')){{ old('tahun_gangguan_jiwa') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tahun_gangguan_jiwa : '' }}@endif"
                                       style="border: 0; border-bottom: 2px dotted; width: 100px">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%; vertical-align: text-top">Riwayat Trauma</td>
                    <td colspan="5" style="padding-left: 5px;">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_trauma()"
                                       @if(old('riwayat_trauma'))
                                           {{ old('riwayat_trauma') ==  'tidak_ada' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'tidak_ada' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="tidak_ada" name="radio_trauma"> Tidak Ada
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_trauma()"
                                       @if(old('riwayat_trauma'))
                                           {{ old('riwayat_trauma') ==  'aniaya_fisik' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'aniaya_fisik' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="aniaya_fisik" name="radio_trauma"> Aniaya Fisik
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_trauma()"
                                       @if(old('riwayat_trauma'))
                                           {{ old('riwayat_trauma') ==  'psikologis' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'psikologis' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="psikologis" name="radio_trauma"> Psikologis
                            </div>
                            <div class="col-print-2">
                                <input onclick="cek_radio_riwayat_trauma()"
                                       @if(old('riwayat_trauma'))
                                           {{ old('riwayat_trauma') ==  'kdrt' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'kdrt' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="kdrt" name="radio_trauma"> KDRT
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                <input onclick="cek_radio_riwayat_trauma()"
                                       @if(old('riwayat_trauma'))
                                           {{ old('riwayat_trauma') ==  'pemerkosaan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'pemerkosaan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="pemerkosaan" name="radio_trauma"> Aniaya Sex/Pemerkosaan
                            </div>
                            <div class="col-print-8">
                                <input onclick="cek_radio_riwayat_trauma()"
                                       @if(old('riwayat_trauma'))
                                           {{ old('riwayat_trauma') ==  'kriminal' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'kriminal' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="kriminal" name="radio_trauma"> Tindakan Kriminal, Sebutkan :
                                <input type="text" readonly
                                       value="@if(old('ket_kriminal')){{ old('ket_kriminal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kriminal : '' }}@endif"
                                       id="ket_kriminal" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_trauma'))
                                    {{ old('riwayat_trauma') ==  'kriminal' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'kriminal' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%">Alam Perasaan</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input @if(old('perasaan'))
                                           {{ old('perasaan') ==  'sedih' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'sedih' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="sedih" name="radio_perasaan"> Sedih
                            </div>
                            <div class="col-print-2">
                                <input @if(old('perasaan'))
                                           {{ old('perasaan') ==  'tenang' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'tenang' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="tenang" name="radio_perasaan"> Tenang
                            </div>
                            <div class="col-print-2">
                                <input @if(old('perasaan'))
                                           {{ old('perasaan') ==  'putus_asa' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'putus_asa' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="putus_asa" name="radio_perasaan"> Putus Asa
                            </div>
                            <div class="col-print-2">
                                <input @if(old('perasaan'))
                                           {{ old('perasaan') ==  'ketakutan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'ketakutan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="ketakutan" name="radio_perasaan"> Ketakutan
                            </div>
                            <div class="col-print-3">
                                <input @if(old('perasaan'))
                                           {{ old('perasaan') ==  'gembira_berlebih' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'gembira_berlebih' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="gembira_berlebih" name="radio_perasaan"> Gembira Berlebih
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 17%">Interaksi Selama Wawancara</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-2">
                                <input @if(old('wawancara'))
                                           {{ old('wawancara') ==  'Kooperatif' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'Kooperatif' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="Kooperatif" name="radio_wawancara"> Kooperatif
                            </div>
                            <div class="col-print-2">
                                <input @if(old('wawancara'))
                                           {{ old('wawancara') ==  'bermusuhan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'bermusuhan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="bermusuhan" name="radio_wawancara"> Bermusuhan
                            </div>
                            <div class="col-print-3">
                                <input @if(old('wawancara'))
                                           {{ old('wawancara') ==  'tidak_kooperatif' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'tidak_kooperatif' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="tidak_kooperatif" name="radio_wawancara"> Tidak Kooperatif
                            </div>
                            <div class="col-print-4">
                                <input @if(old('wawancara'))
                                           {{ old('wawancara') ==  'mudah_tersinggung' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'mudah_tersinggung' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="mudah_tersinggung" name="radio_wawancara"> Mudah Tersinggung
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                <input @if(old('wawancara'))
                                           {{ old('wawancara') ==  'kontak_mata' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'kontak_mata' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="kontak_mata" name="radio_wawancara"> Kontak Mata Berkurang
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-3">Kebutuhan Spiritual Pasien : </div>
                            <div class="col-print-1">
                                <input @if(old('spiritual'))
                                           {{ old('spiritual') ==  'baik' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->spiritual == 'baik' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="baik" name="radio_spiritual"> Baik
                            </div>
                            <div class="col-print-4">
                                <input @if(old('spiritual'))
                                           {{ old('spiritual') ==  'tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->spiritual == 'tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="tidak" name="radio_spiritual"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">Pasien Membutuhkan Spiritual Agama </div>
                            <div class="col-print-2">
                                :
                                <input @if(old('kebutuhan_spiritual'))
                                           {{ old('kebutuhan_spiritual') ==  'ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebutuhan_spiritual == 'ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="ya" name="radio_butuh_spiritual"> Ya
                            </div>
                            <div class="col-print-2">
                                <input @if(old('kebutuhan_spiritual'))
                                           {{ old('kebutuhan_spiritual') ==  'tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebutuhan_spiritual == 'tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="tidak" name="radio_butuh_spiritual"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        Pasien Membutuhkan Bantuan dalam Menjalakan Ibadah dan Menyetujuinya :
                        <input @if(old('bantuan_ibadah'))
                                {{ old('bantuan_ibadah') ==  'ya' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bantuan_ibadah == 'ya' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="ya" name="radio_bantuan_ibadah"> Ya
                        <input @if(old('bantuan_ibadah'))
                                {{ old('bantuan_ibadah') ==  'tidak' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bantuan_ibadah == 'tidak' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="tidak" name="radio_bantuan_ibadah" class="ml-4"> Tidak
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%; border-top: hidden" class="table_isian">
                <tr style="border: 1px solid">
                    <td colspan="5" style="text-align: center">
                        <b>RIWAYAT ALERGI</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4">
                                <input onclick="cek_riwayat_alergi()" @if(old('riwayat_alergi'))
                                        {{ old('riwayat_alergi') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak" name="radio_riwayat_alergi"> Tidak
                                <input onclick="cek_riwayat_alergi()" @if(old('riwayat_alergi'))
                                        {{ old('riwayat_alergi') ==  'ya' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ya" name="radio_riwayat_alergi" class="ml-4"> Ya, Sebutkan : 
                            </div>
                            <div class="col-print-8">
                                <input type="text" readonly value="@if(old('riwayat_alergi1')){{ old('riwayat_alergi1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi1 : '' }}@endif"
                                   id="riwayat_alergi1" style="border: 0; border-bottom: 2px dotted;"
                                   @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                                Reaksi
                                <input type="text" readonly value="@if(old('reaksis1')){{ old('reaksis1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->reaksis1 : '' }}@endif"
                                   id="reaksis1" style="border: 0; border-bottom: 2px dotted;"
                                   @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4"></div>
                            <div class="col-print-8">
                                <input type="text" readonly value="@if(old('riwayat_alergi2')){{ old('riwayat_alergi2') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi2 : '' }}@endif"
                                   id="riwayat_alergi2" style="border: 0; border-bottom: 2px dotted;"
                                   @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                                Reaksi
                                <input type="text" readonly value="@if(old('reaksis2')){{ old('reaksis2') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->reaksis2 : '' }}@endif"
                                   id="reaksis2" style="border: 0; border-bottom: 2px dotted;"
                                   @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row" style="padding-left: 15px">
                            <div class="col-print-4"></div>
                            <div class="col-print-8">
                                <input type="text" readonly value="@if(old('riwayat_alergi3')){{ old('riwayat_alergi3') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi3 : '' }}@endif"
                                   id="riwayat_alergi3" style="border: 0; border-bottom: 2px dotted;"
                                   @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                                Reaksi
                                <input type="text" readonly value="@if(old('reaksis3')){{ old('reaksis3') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->reaksis3 : '' }}@endif"
                                   id="reaksis3" style="border: 0; border-bottom: 2px dotted;"
                                   @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr style="border: 1px solid; text-align: center">
                    <td colspan="6">
                        <b>ASESMEN NYERI</b>
                    </td>
                </tr>
                <tr style="border-bottom: hidden">
                    <td colspan="3" style="border-right: hidden">
                        Nyeri :
                        <input
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri == 'tidak' ? 'checked' : '') : '' }}
                            type="checkbox" value="tidak" name="radio_nyeri"> Tidak
                        <input
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri == 'ya' ? 'checked' : '') : '' }}
                            type="checkbox" value="ya" name="radio_nyeri"> Ya
                    </td>
                    <td colspan="3">
                        Sifat :
                        <input
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sifat_nyeri == 'akut' ? 'checked' : '') : '' }}
                            type="checkbox" value="akut" name="radio_sifat_nyeri"> Akut
                        <input
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sifat_nyeri == 'kronis' ? 'checked' : '') : '' }}
                            type="checkbox" value="kronis" name="radio_sifat_nyeri"> Kronis
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row" style="width:100%; margin-left: 0px;">
                            <table style="width: 100%;" border="1">
                                <tr>
                                    <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                        <img src="{{ asset('images/tidak_sakit.png') }}" alt="" style="width: 50%;">
                                    </td>
                                    <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                        <img src="{{ asset('images/sedikit_sakit.png') }}" alt="" style="width: 50%;">
                                    </td>
                                    <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                        <img src="{{ asset('images/agak_mengganggu.png') }}" alt="" style="width: 50%;">
                                    </td>
                                    <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                        <img src="{{ asset('images/mengganggu_aktivitas.png') }}" alt="" style="width: 50%;">
                                    </td>
                                    <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                        <img src="{{ asset('images/sangat_mengganggu.png') }}" alt="" style="width: 50%;">
                                    </td>
                                    <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                        <img src="{{ asset('images/tak_tertahankan.png') }}" alt="" style="width: 50%;">
                                    </td>
                                </tr>
                                <tr class="text-center" style="font-weight: bold; font-size: 12px;">
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 0 || $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 1) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">0<br>Tidak sakit
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 2 || $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 3) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">2<br>Sedikit sakit
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 4 || $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 5) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">4<br>Agak mengganggu
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 6 || $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 7) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">6<br>Mengganggu aktivitas
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 8 || $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 9) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">8<br>Sangat mengganggu
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == 10) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">10<br>Tak tertahankan
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row" style="margin-left: 5px;">
                            <div class="col-print-3">1. Kualitas Nyeri <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input class{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas_nyeri == 'nyeri_tumpul' ? 'checked' : '') : '' }}
                                type="checkbox" value="nyeri_tumpul" name="radio_kualitas_nyeri"> Nyeri Tumpul
                            </div>
                            <div class="col-print-3">
                                <input
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : '' }}
                                    type="checkbox" value="nyeri_tajam" name="radio_kualitas_nyeri"> Nyeri Tajam
                            </div>
                            <div class="col-print-3">
                                <input
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas_nyeri == 'panas' ? 'checked' : '') : '' }}
                                    type="checkbox" value="panas" name="radio_kualitas_nyeri"> Panas / Terbakar
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">2. Menjalar <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri_menjalar == 'tidak' ? 'checked' : '') : '' }}
                                    type="checkbox" value="tidak" name="radio_menjalar"> Tidak
                            </div>
                            <div class="col-print-6">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri_menjalar == 'ya' ? 'checked' : '') : '' }}
                                    type="checkbox" value="ya" name="radio_menjalar"> Ya, Ke <span
                                    style="border-bottom: 2px dotted">{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_nyeri_menjalar : '' }}</span>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">3. Skor Nyeri <span style="float: right">: </span> </div>
                            <div class="col-print-9">
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri : '' }}
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">4. Frekuensi Nyeri <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->frekuensi_nyeri == 'jarang' ? 'checked' : '') : '' }}
                                       type="checkbox" value="jarang" name="radio_frekuensi_nyeri"> Jarang
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : '' }}
                                       type="checkbox" value="hilang_timbul" name="radio_frekuensi_nyeri"> Hilang Timbul
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->frekuensi_nyeri == 'terus_menerus' ? 'checked' : '') : '' }}
                                       type="checkbox" value="terus_menerus" name="radio_frekuensi_nyeri"> Terus Menerus
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">5. Nyeri Mempengaruhi <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'tidur' ? 'checked' : '') : '' }}
                                       type="checkbox" value="tidur" name="radio_pengaruh_nyeri"> Tidur
                                <br>
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'emosi' ? 'checked' : '') : '' }}
                                       type="checkbox" value="emosi" name="radio_pengaruh_nyeri"> Emosi
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : '' }}
                                       type="checkbox" value="aktifitas_fisik" name="radio_pengaruh_nyeri"> Aktifitas Fisik
                                <br>
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'nafsu_makan' ? 'checked' : '') : '' }}
                                       type="checkbox" value="nafsu_makan" name="radio_pengaruh_nyeri"> Nafsu Makan
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'konsentrasi' ? 'checked' : '') : '' }}
                                       type="checkbox" value="konsentrasi" name="radio_pengaruh_nyeri"> Konsentrasi
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian_bordered">
                <tr>
                    <td colspan="5">
                        SKALA FLACC Untuk kurang dari 6 tahun
                    </td>
                </tr>
                <tr style="border: 1px solid; text-align: center">
                    <td>
                        Pengkajian
                    </td>
                    <td style="width: 20%">
                        0
                    </td>
                    <td style="width: 20%">
                        1
                    </td>
                    <td style="width: 20%">
                        2
                    </td>
                    <td>
                        Nilai
                    </td>
                </tr>
                <tr style="border: 1px solid; vertical-align: text-top;">
                    <td>
                        Wajah
                    </td>
                    <td>
                        Tersenyum / Tidak Ada Ekspresi Khusus
                    </td>
                    <td>
                        Terkadang Meringis / Menarik Diri
                    </td>
                    <td>
                        Sering Menggetarkan Dagu
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_wajah : '' }}
                    </td>
                </tr>
                <tr style="border: 1px solid; vertical-align: text-top;">
                    <td>
                        Kaki
                    </td>
                    <td>
                        Gerakan Normal Relaksasi
                    </td>
                    <td>
                        Tidak Tenang / Tegang
                    </td>
                    <td>
                        Kaki Dibuat Menendang / Menarik Diri
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_kaki : '' }}
                    </td>
                </tr>
                <tr style="border: 1px solid; vertical-align: text-top;">
                    <td>
                        Aktifitas
                    </td>
                    <td>
                        Tidur Posisi Normal, Mudah Bergerak
                    </td>
                    <td>
                        Gerakan Menggeliat, Berguling, Kaku
                    </td>
                    <td>
                        Melengkungkan Punggung, Kaku, Menghentak
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_aktifitas : '' }}
                    </td>
                </tr>
                <tr style="border: 1px solid; vertical-align: text-top;">
                    <td>
                        Menangis
                    </td>
                    <td>
                        Tidur Menangis (Bangun / Tidur)
                    </td>
                    <td>
                        Mengerang / Merengek
                    </td>
                    <td>
                        Menangis Terus, Terisak, Menjerit
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_menangis : '' }}
                    </td>
                </tr>
                <tr style="border: 1px solid; vertical-align: text-top;">
                    <td>
                        Bersuara
                    </td>
                    <td>
                        Bersuara Normal, Tenang
                    </td>
                    <td>
                        Tenang Bila dipeluk digendong, atau diajak Berbicara
                    </td>
                    <td>
                        Sulit Untuk ditenangkan
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_bersuara : '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr style="vertical-align: text-top">
                    <td rowspan="3" style="width: 15%">
                        Hasil Skrining <span style="float: right">:</span>
                    </td>
                    <td style="width: 20%">
                        (P) Faktor Pencetus <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->faktor_pencetus : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        (Q) Kualitas <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        (R) Lokasi <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lokasi : '' }}
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" style="width: 15%">
                        &nbsp;
                    </td>
                    <td style="width: 20%">
                        (S) Skala Nyeri <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->skala_nyeri : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        (T) Lama Nyeri <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lama_nyeri : '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table class="table_isian_bordered" style="width: 100%; border-top: hidden">
                <tr>
                    <td colspan="6" style="text-align: center">
                        <b>PENGKAJIAN RESIKO JATUH</b>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2" style="width: 40%">
                        a. Resiko Jatuh Humpty Dumpty (Anak)
                    </td>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh_anak'))
                                {{ old('resiko_jatuh_anak') ==  'satu' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_anak == 'satu' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="satu" name="radio_resiko_jatuh_anak"> Skor < 7  
                    </td>
                    <td colspan="3">
                        : Tidak Resiko
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh_anak'))
                                {{ old('resiko_jatuh_anak') ==  'dua' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_anak == 'dua' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="dua" name="radio_resiko_jatuh_anak"> Skor < 7 - 11 
                    </td>
                    <td colspan="3">
                        : Resiko Rendah
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh_anak'))
                                {{ old('resiko_jatuh_anak') ==  'tiga' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_anak == 'tiga' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="tiga" name="radio_resiko_jatuh_anak"> Skor >= 12
                    </td>
                    <td colspan="3">
                        : Resiko Tinggi
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2" style="width: 40%">
                        a. Resiko Jatuh Morse (Dewasa)
                    </td>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh_dewasa'))
                                {{ old('resiko_jatuh_dewasa') ==  'satu' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_dewasa == 'satu' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="satu" name="radio_resiko_jatuh_dewasa"> Skor 0 - 24  
                    </td>
                    <td colspan="3">
                        : Tidak Resiko
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh_dewasa'))
                                {{ old('resiko_jatuh_dewasa') ==  'dua' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_dewasa == 'dua' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="dua" name="radio_resiko_jatuh_dewasa"> Skor 25 - 50 
                    </td>
                    <td colspan="3">
                        : Resiko Rendah
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh_dewasa'))
                                {{ old('resiko_jatuh_dewasa') ==  'tiga' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_dewasa == 'tiga' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="tiga" name="radio_resiko_jatuh_dewasa"> Skor >= 51
                    </td>
                    <td colspan="3">
                        : Resiko Tinggi
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2" style="width: 40%">
                        a. Resiko Jatuh (Geriatri)
                    </td>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh'))
                                {{ old('resiko_jatuh') ==  'satu' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh == 'satu' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="satu" name="radio_resiko_jatuh"> Skor 0 - 5 
                    </td>
                    <td colspan="3">
                        : Tidak Resiko
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh'))
                                {{ old('resiko_jatuh') ==  'dua' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh == 'dua' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="dua" name="radio_resiko_jatuh"> Skor 6 - 16 
                    </td>
                    <td colspan="3">
                        : Resiko Rendah
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        <input @if(old('resiko_jatuh'))
                                {{ old('resiko_jatuh') ==  'tiga' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh == 'tiga' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="tiga" name="radio_resiko_jatuh"> Skor 17 - 30
                    </td>
                    <td colspan="3">
                        : Resiko Tinggi
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian_bordered">
                <tr>
                    <td colspan="6" class="text-center">
                        <b>SKRINING GIZI</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-4">
                                BB : 
                                {{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '..../....' }} Kg
                                {{-- {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->bb_gizi : '' }}  --}}
                            </div>
                            <div class="col-print-4">
                                PB/TB : 
                                {{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '..../....' }} cm
                                {{-- {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pb_gizi : '' }}  --}}
                            </div>
                            <div class="col-print-4">
                                IMT : {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->imt_gizi : '' }} BB/TB (M<sup>3</sup>)
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        1. Apakah Klien tampak kurus ?
                    </td>
                    <td style="padding-left: 10px">
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tampak_kurus == 'ya' ? 'checked' : '') : '' }}
                               type="radio" value="ya" name="radio_tampak_kurus"> Ya
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tampak_kurus == 'tidak' ? 'checked' : '') : '' }}
                               type="radio" value="tidak" name="radio_tampak_kurus"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        2. Apakah terjadi kenaikan atau penurunan berat badan 1 bulan terakhir ?
                    </td>
                    <td style="padding-left: 10px">
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_bb == 'ya' ? 'checked' : '') : '' }}
                               type="radio" value="ya" name="radio_penurunan_bb"> Ya
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_bb == 'tidak' ? 'checked' : '') : '' }}
                               type="radio" value="tidak" name="radio_penurunan_bb"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        3. Apakah asupan makanan menurut yang dikarenakan penurunan nafsu makan ?
                    </td>
                    <td style="padding-left: 10px">
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->asupan_makanan == 'ya' ? 'checked' : '') : '' }}
                               type="radio" value="ya" name="radio_asupan_makanan"> Ya
                        <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->asupan_makanan == 'tidak' ? 'checked' : '') : '' }}
                               type="radio" value="tidak" name="radio_asupan_makanan"> Tidak
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: text-top; border-right: hidden">
                        Hasil Skrining
                    </td>
                    <td colspan="5" style="vertical-align: text-top">
                        <span> : {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hasil_skrining_gizi : '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: text-top; border-right: hidden">
                        Saran
                    </td>
                    <td colspan="5" style="vertical-align: text-top">
                        <span> : {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->saran_skrining_gizi : '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>ASSESMEN FUNGSIONAL</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <b>PENGKAJIAN FUNGSI</b>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" class="text-center">
                        a. Sensorik
                    </td>
                    <td colspan="5">
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-2">
                                Penglihatan
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'normal' ? 'checked' : '') : '' }}
                                       type="radio" value="normal" name="radio_sensorik_penglihatan"> Normal
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'kabur' ? 'checked' : '') : '' }}
                                       type="radio" value="kabur" name="radio_sensorik_penglihatan"> Kabur
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'kacamata' ? 'checked' : '') : '' }}
                                       type="radio" value="kacamata" name="radio_sensorik_penglihatan"> Kacamata
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'lensa_kontak' ? 'checked' : '') : '' }}
                                       type="radio" value="lensa_kontak" name="radio_sensorik_penglihatan"> Lensa Kontak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-2">
                                Penciuman
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penciuman == 'normal' ? 'checked' : '') : '' }}\
                                       type="radio" value="normal" name="radio_sensorik_penciuman"> Normal
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penciuman == 'tidak' ? 'checked' : '') : '' }}
                                       type="radio" value="tidak" name="radio_sensorik_penciuman"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-2">
                                Pendengaran
                            </div>
                            <div class="col-print-2">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_pendengaran == 'normal' ? 'checked' : '') : '' }}
                                       type="radio" value="normal" name="radio_sensorik_pendengaran"> Normal
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_pendengaran == 'tuli' ? 'checked' : '') : '' }}
                                       type="radio" value="tuli" name="radio_sensorik_pendengaran"> Tuli Kanan/Kiri
                            </div>
                            <div class="col-print-6">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_pendengaran == 'alat_bantu' ? 'checked' : '') : '' }}
                                       type="radio" value="alat_bantu" name="radio_sensorik_pendengaran"> Alat Bantu dengar
                                kanan dan kiri
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="text-center">
                        b. Kognitif
                    </td>
                    <td colspan="5">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                <input @if(old('kognitif_satu'))
                                           {{ old('kognitif_satu') ==  'normal' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_satu == 'normal' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="normal" name="radio_kognitif_satu"> Normal
                            </div>
                            <div class="col-print-3">
                                <input @if(old('kognitif_satu'))
                                           {{ old('kognitif_satu') ==  'pelupa' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_satu == 'pelupa' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="pelupa" name="radio_kognitif_satu"> Pelupa
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                <input @if(old('kognitif_dua'))
                                           {{ old('kognitif_dua') ==  'bingung' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_dua == 'bingung' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="bingung" name="radio_kognitif_dua"> Bingung
                            </div>
                            <div class="col-print-6">
                                <input @if(old('kognitif_dua'))
                                           {{ old('kognitif_dua') ==  'tidak_mengerti' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_dua == 'tidak_mengerti' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="tidak_mengerti" name="radio_kognitif_dua"> Tidak dapat dimengerti
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="text-center">
                        c. Motorik
                    </td>
                    <td colspan="5">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                Aktifitas sehari-hari
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_satu == 'mandiri' ? 'checked' : '') : '' }}
                                       type="radio" value="mandiri" name="radio_motorik_satu"> Mandiri
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_satu == 'bantuan_minimal' ? 'checked' : '') : '' }}
                                       type="radio" value="bantuan_minimal" name="radio_motorik_satu"> Bantuan Minimal
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3"></div>
                            <div class="col-print-8">
                                <input {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_satu == 'bantuan_total' ? 'checked' : '') : '' }}
                                       type="radio" value="bantuan_total" name="radio_motorik_satu"> Bantuan Ketergantungan Total
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                Berjalan
                            </div>
                            <div class="col-print-3">
                                <input @if(old('motorik_dua'))
                                           {{ old('motorik_dua') ==  'tidak_kesulitan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'tidak_kesulitan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="tidak_kesulitan" name="radio_motorik_dua"> Tidak ada kesulitan
                            </div>
                            <div class="col-print-3">
                                <input @if(old('motorik_dua'))
                                           {{ old('motorik_dua') ==  'perlu_bantuan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'perlu_bantuan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="perlu_bantuan" name="radio_motorik_dua"> Perlu bantuan
                            </div>
                            <div class="col-print-3">
                                <input @if(old('motorik_dua'))
                                           {{ old('motorik_dua') ==  'sering_jatuh' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'sering_jatuh' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="sering_jatuh" name="radio_motorik_dua"> Sering jatuh
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3"></div>
                            <div class="col-print-3">
                                <input @if(old('motorik_dua'))
                                           {{ old('motorik_dua') ==  'kelumpuhan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'kelumpuhan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="kelumpuhan" name="radio_motorik_dua"> Kelumpuhan
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>DISCHARGE PLANNING</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <b>SARAN</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        1. Pasien Perlu Pelayanan Home Care ?
                    </td>
                    <td style="padding-left: 10px">
                        <input @if(old('saran_satu'))
                                   {{ old('saran_satu') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_satu == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="ya" name="radio_saran_satu"> Ya
                        <input @if(old('saran_satu'))
                                   {{ old('saran_satu') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_satu == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="tidak" name="radio_saran_satu"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        2. Pasien Perlu Pemasangan Implan ?
                    </td>
                    <td style="padding-left: 10px">
                        <input @if(old('saran_dua'))
                                   {{ old('saran_dua') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_dua == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="ya" name="radio_saran_dua"> Ya
                        <input @if(old('saran_dua'))
                                   {{ old('saran_dua') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_dua == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="tidak" name="radio_saran_dua"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        3. Apakah Pasien ketika pulang perlu perawatan dirumah ?
                    </td>
                    <td style="padding-left: 10px">
                        <input @if(old('saran_tiga'))
                                   {{ old('saran_tiga') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_tiga == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="ya" name="radio_saran_tiga"> Ya
                        <input @if(old('saran_tiga'))
                                   {{ old('saran_tiga') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_tiga == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="tidak" name="radio_saran_tiga"> Tidak
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        Hasil Skrining
                    </td>
                    <td colspan="5">
                        <span> : {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hasil_discharge_planning : '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">
                        Saran
                    </td>
                    <td colspan="5">
                        <span> : {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->saran_discharge_planning : '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>RIWAYAT PENGGUNAAN OBAT</b>
                    </td>
                </tr>
                <tr style="border: 1px solid; text-align: center;">
                    <td>No.</td>
                    <td>Nama Obat</td>
                    <td>Jumlah</td>
                    <td>Aturan Pakai</td>
                    <td>Tgl. Mulai minum Obat</td>
                    <td>Keterangan</td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="text-align: center;">1.</td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_satu }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_satu }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_satu }}
                    </td>
                    <td  class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_satu))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_satu)->format('H:i') }}
                        @endif
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_satu }}
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="text-align: center;">2.</td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_dua }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_dua }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_dua }}
                    </td>
                    <td  class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_dua))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_dua)->format('H:i') }}
                        @endif
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_dua }}
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="text-align: center;">3.</td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_tiga }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_tiga }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_tiga }}
                    </td>
                    <td  class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_tiga))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_tiga)->format('H:i') }}
                        @endif
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_tiga }}
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="text-align: center;">4.</td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_empat }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_empat }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_empat }}
                    </td>
                    <td  class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_empat))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_empat)->format('H:i') }}
                        @endif
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_tiga }}
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="text-align: center;">5.</td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_lima }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_lima }}
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_lima }}
                    </td>
                    <td  class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_lima))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_lima)->format('H:i') }}
                        @endif
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_lima }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>DAFTAR MASALAH KEPERAWATAN</b>
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;
                        {{-- <input 
                            type="checkbox" 
                            id="gangguan_pernafasan" 
                            name="masalah_keperawatan[]" 
                            value="gangguan_pernafasan"
                            @if(is_array(old('masalah_keperawatan')) && in_array('gangguan_pernafasan', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('gangguan_pernafasan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_pernafasan, true)))
                                checked
                            @endif
                        > Gangguan Pernafasan --}}
                        <input 
                            type="checkbox" 
                            id="nyeri" 
                            name="masalah_keperawatan[]" 
                            value="nyeri"
                            @if(is_array(old('masalah_keperawatan')) && in_array('nyeri', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('nyeri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                                checked
                            @endif
                            > Nyeri &nbsp;&nbsp;

                        <input 
                            type="checkbox" 
                            id="gangguan_pernafasan" 
                            name="masalah_keperawatan[]" 
                            value="gangguan_pernafasan"
                            @if(is_array(old('masalah_keperawatan')) && in_array('gangguan_pernafasan', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('gangguan_pernafasan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                                checked
                            @endif
                            > Gangguan Pernafasan &nbsp;&nbsp;
                        <input 
                            type="checkbox" 
                            id="potensi_infeksi" 
                            name="masalah_keperawatan[]" 
                            value="potensi_infeksi"
                            @if(is_array(old('masalah_keperawatan')) && in_array('potensi_infeksi', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('potensi_infeksi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                                checked
                            @endif
                            > Potensi Infeksi &nbsp;&nbsp;
                        <input 
                            type="checkbox" 
                            id="volume_cairan" 
                            name="masalah_keperawatan[]" 
                            value="volume_cairan"
                            @if(is_array(old('masalah_keperawatan')) && in_array('volume_cairan', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('volume_cairan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                                checked
                            @endif
                            > Volume Cairan &nbsp;&nbsp;
                        <input 
                            type="checkbox" 
                            id="perubahan_nutrisi" 
                            name="masalah_keperawatan[]" 
                            value="perubahan_nutrisi"
                            @if(is_array(old('masalah_keperawatan')) && in_array('perubahan_nutrisi', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('perubahan_nutrisi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                                checked
                            @endif
                            > Perubahan Nutrisi &nbsp;&nbsp;
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td colspan="6" class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input 
                        type="checkbox" 
                        id="cemas" 
                        name="masalah_keperawatan[]" 
                        value="cemas"
                        @if(is_array(old('masalah_keperawatan')) && in_array('cemas', old('masalah_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('cemas', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                            checked
                        @endif
                        > Cemas &nbsp;&nbsp;

                        <input 
                        type="checkbox" 
                        id="perfusi_jaringan" 
                        name="masalah_keperawatan[]" 
                        value="perfusi_jaringan"
                        @if(is_array(old('masalah_keperawatan')) && in_array('perfusi_jaringan', old('masalah_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('perfusi_jaringan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                            checked
                        @endif
                        > Perfusi Jaringan &nbsp;&nbsp;

                        <input 
                        type="checkbox" 
                        id="mk_hipertensi" 
                        name="masalah_keperawatan[]" 
                        value="mk_hipertensi"
                        @if(is_array(old('masalah_keperawatan')) && in_array('mk_hipertensi', old('masalah_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('mk_hipertensi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan, true) ?? []))
                            checked
                        @endif
                        > Hipertensi &nbsp;&nbsp;
                        {{-- <input 
                            type="checkbox" 
                            id="cemas" 
                            name="masalah_keperawatan[]" 
                            value="cemas"
                            @if(is_array(old('masalah_keperawatan')) && in_array('cemas', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('cemas', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->cemas, true)))
                                checked
                            @endif
                        > Cemas
                        <input 
                            type="checkbox" 
                            id="perfusi_jaringan" 
                            name="masalah_keperawatan[]" 
                            value="perfusi_jaringan"
                            @if(is_array(old('masalah_keperawatan')) && in_array('perfusi_jaringan', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('perfusi_jaringan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->perfusi_jaringan, true)))
                                checked
                            @endif
                        > Gangguan Perfusi Jaringan
                        <input 
                            type="checkbox" 
                            id="hipertensi" 
                            name="masalah_keperawatan[]" 
                            value="hipertensi"
                            @if(is_array(old('masalah_keperawatan')) && in_array('hipertensi', old('masalah_keperawatan')))
                                checked
                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('hipertensi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->hipertensi, true)))
                                checked
                            @endif
                        > Hipertensi --}}
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center;">
                        <b>Jam</b>
                    </td>
                    <td colspan="5"  style="text-align: center;">
                        <b>IMPLEMENTASI KEPERAWATAN</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_satu))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_satu)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="observasi_ttv" 
                        name="implementasi_keperawatan[]" 
                        value="observasi_ttv"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('observasi_ttv', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('observasi_ttv', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > Lakukan Observasi TTV
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_dua))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_dua)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="intake_output" 
                        name="implementasi_keperawatan[]" 
                        value="intake_output"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('intake_output', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('intake_output', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                    Monitor In Take Out Put
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tiga))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tiga)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="monitor_pernafasan" 
                        name="implementasi_keperawatan[]" 
                        value="monitor_pernafasan"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('monitor_pernafasan', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('monitor_pernafasan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                    Monitor Pernafasan : Irama, Pengembangan dinding dada, Penggunaan otot tambahan pernafasan, bunyi nafas
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_empat))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_empat)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="oksimetri" 
                        name="implementasi_keperawatan[]" 
                        value="oksimetri"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('oksimetri', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('oksimetri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                    Lakukan Pemasangan Oksimetri
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_lima))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_lima)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="semi_flower" 
                        name="implementasi_keperawatan[]" 
                        value="semi_flower"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('semi_flower', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('semi_flower', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                    Berikan Posisi Semi Flower atau Posisi Miring yang Aman
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_enam))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_enam)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="pemasangan_opa" 
                        name="implementasi_keperawatan[]" 
                        value="pemasangan_opa"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('pemasangan_opa', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('pemasangan_opa', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                    Lakukan Pemasangan OPA
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tujuh))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tujuh)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="sutlon" 
                        name="implementasi_keperawatan[]" 
                        value="sutlon"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('sutlon', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('sutlon', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                    Lakukan Su tlon bila perlu
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_delapan))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_delapan)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="nafas_efektif" 
                        name="implementasi_keperawatan[]" 
                        value="nafas_efektif"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('nafas_efektif', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('nafas_efektif', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                     Ajarkan Pasien untuk Nafas dalam Bentuk Efektif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sembilan))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sembilan)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="oksigen" 
                        name="implementasi_keperawatan[]" 
                        value="oksigen"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('oksigen', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('oksigen', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                        Berilah Oksigen 
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->liter }} liter/m
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sepuluh))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sepuluh)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="imobilisasi" 
                        name="implementasi_keperawatan[]" 
                        value="imobilisasi"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('imobilisasi', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('imobilisasi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        >  
                        Imobilisasikan Daerah Cedera : Pasang Bidai / Spalak / Sling
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sebelas))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sebelas)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="perawatan_luka" 
                        name="implementasi_keperawatan[]" 
                        value="perawatan_luka"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('perawatan_luka', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('perawatan_luka', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                        Lakukan Perawatan Luka
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_duabelas))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_duabelas)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="pengelolaan_nyeri" 
                        name="implementasi_keperawatan[]" 
                        value="pengelolaan_nyeri"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('pengelolaan_nyeri', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('pengelolaan_nyeri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        >  
                        Ajarkan Management Pengelolaan Nyeri
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tigabelas))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tigabelas)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        <input 
                        type="checkbox" 
                        id="teknik_asepti" 
                        name="implementasi_keperawatan[]" 
                        value="teknik_asepti"
                        @if(is_array(old('implementasi_keperawatan')) && in_array('teknik_asepti', old('implementasi_keperawatan')))
                            checked
                        @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && in_array('teknik_asepti', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan, true) ?? []))
                            checked
                        @endif
                        > 
                        Lakukan Tindakan dengan Teknik Asepti
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_empatbelas))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_empatbelas)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->ik_satu }} 
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_limabelas))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_limabelas)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->ik_dua}} 
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_enambelas))
                        {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jam_enambelas)->format('H:i') }}
                    @else
                        -
                    @endif
                    </td>
                    <td colspan="5">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->ik_tiga }} 
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>TINDAKAN TERINTEGRASI</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> Tgl & Jam </b> 
                    </td>
                    <td colspan="4" class="text-center">
                        <b>Tindakan</b>
                    </td>
                    <td colspan="1" class="text-center">
                        <b>Nama & ttd</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsatu))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsatu)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsatu)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansatu }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansatu))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdua))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdua)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdua)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandua }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandua))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtiga))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtiga)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtiga)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantiga }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantiga))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamempat))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamempat)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamempat)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanempat }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanempat))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamlima))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamlima)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamlima)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanlima }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanlima))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamenam))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamenam)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamenam)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanenam }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanenam))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtujuh))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtujuh)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtujuh)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantujuh }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantujuh))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdelapan))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdelapan)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdelapan)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandelapan }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandelapan))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsembilan))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsembilan)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsembilan)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansembilan }} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansembilan))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsepuluh))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsepuluh)->format('d/m/Y') }}
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsepuluh)->format('H:i') }}
                        @else
                            -
                        @endif 
                    </td>
                    <td colspan="4">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansepuluh}} 
                        <b></b>
                    </td>
                    <td colspan="1" class="text-center">
                        @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansepuluh))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                            <br>Ttd & Nama Terang --}}
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                            @endif
                            <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                        @endif  
                    </td>
                </tr>

                <tr>
                    <td colspan="6" class="text-center">
                        <b>PEMBERIAN OBAT / INFUS (TERINTEGRASI)</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> No. </b> 
                    </td>
                    <td colspan="2" class="text-center">
                        <b>Nama Obat/Cairan</b>
                    </td>
                    <td colspan="1" class="text-center">
                        <b>Dosis</b>
                    </td>
                    <td colspan="1" class="text-center">
                        <b>ORAL/IV/IM/IC/SC</b>
                    </td>
                    <td colspan="1" class="text-center">
                        <b>Jam Pemberian</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 1. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_satu}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_satu}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_satu}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_satu))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_satu)->format('H:i') }}
                        @endif
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 2. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_dua}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_dua}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_dua}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_dua))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_dua)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 3. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_tiga}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_tiga}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_tiga}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_tiga))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_tiga)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 4. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_empat}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_empat}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_empat}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_empat))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_empat)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 5. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_lima}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_lima}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_lima}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_lima))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_lima)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 6. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_enam}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_enam}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_enam}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_enam))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_enam)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 7. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_tujuh}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_tujuh}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_tujuh}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_tujuh))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_tujuh)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 8. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_delapan}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_delapan}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_delapan}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_delapan))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_delapan)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 9. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_sembilan}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_sembilan}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_sembilan}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_sembilan))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_sembilan)->format('H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="text-center">
                        <b> 10. </b> 
                    </td>
                    <td colspan="2">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_sepuluh}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_sepuluh}} 
                    </td>
                    <td colspan="1">
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_sepuluh}} 
                    </td>
                    <td colspan="1" class="text-center">
                        @if(!empty($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_sepuluh))
                            {{ \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_sepuluh)->format('H:i') }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr style="border: 1px solid">
                    <td style="width: 100%; text-align: center">
                        Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}, Jam: {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    {{-- <td style="width: 50%; text-align: center">
                        @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                            <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_pasien}})
                    </td> --}}
                    <td style="width: 100%; text-align: center;">
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_verifikator}})
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>

</html>
