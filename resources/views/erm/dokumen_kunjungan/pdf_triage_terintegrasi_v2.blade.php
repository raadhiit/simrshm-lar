<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PDF Formulir Triase Terintegrasi V2</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
        input[type=checkbox] { display: inline; }

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
        <table id="tabel_kop_identitas" style="font-size: 12px; margin-top: 20px;">
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
                <td style="pl-2 pr-2"> :</td>
                <td>{{ $layanan->ktp }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background-color: rgb(222, 222, 222); margin-top: -2px; padding-bottom: 5px; border: 1px solid"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: black">TRIAGE</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td>
                        {{-- <div style="display: flex; align-items: center;">&nbsp; --}}
                            <span style="margin-right: 5px">Kontak Awal Pasien</span> : &nbsp;
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)))
                            {{ in_array('telepon', json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)) ? 'checked' : '' }}
                            @endif 
                            id="telepon"> Telepon &nbsp;&nbsp;&nbsp;&nbsp;
        
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)))
                                {{ in_array('langsung', json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)) ? 'checked' : '' }}
                            @endif 
                            id="langsung"> Langsung &nbsp;&nbsp;&nbsp;&nbsp;
    
                            Tanggal :
                            <span>
                                @if(isset($dokumen->formulir_triage_terintegrasi_v2) && !empty($dokumen->formulir_triage_terintegrasi_v2->tanggal))
                                    {{ date('d-m-Y', strtotime($dokumen->formulir_triage_terintegrasi_v2->tanggal)) }}
                                @else
                                    -
                                @endif
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                Pukul :
                                @if(isset($dokumen->formulir_triage_terintegrasi_v2) && !empty($dokumen->formulir_triage_terintegrasi_v2->pukul))
                                    {{ date('H:i', strtotime($dokumen->formulir_triage_terintegrasi_v2->pukul)) }}
                                @else
                                    -
                                @endif
                            </span>                            
                        {{-- </div>    --}}
                    </td>
    
                    <tr>
                        <td>
                            <span style="margin-right: 50px"> Cara masuk</span> : &nbsp;&nbsp;
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)))
                            {{ in_array('jalan', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                            @endif 
                            id="jalan"> Jalan &nbsp;&nbsp;&nbsp;
        
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)))
                            {{ in_array('brankar', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                            @endif 
                            id="brankar"> Brankar &nbsp;&nbsp;&nbsp;
        
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)))
                            {{ in_array('kursi_roda', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                            @endif 
                            id="kursi_roda"> Kursi Roda &nbsp;&nbsp;&nbsp;
        
                            <input type="checkbox" onclick="cek_pemeriksaan_antenatal()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk))){{ in_array('lainnya', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                            @endif 
                            id="lainnya" class="ml-4"> Lainnya <span style="border-bottom: 2px dotted;">
                                {{$dokumen->formulir_triage_terintegrasi_v2->ket_cara_masuk}}                          
                            </span>
                                
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <div>
                                <span>Sudah terpasang</span> &nbsp;&nbsp;&nbsp;&nbsp; :
                                    {{$dokumen->formulir_triage_terintegrasi_v2->sudah_terpasang}}  
                            </div>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <span> Alasan Kedatangan </span>  :&nbsp;
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)))
                            {{ in_array('sendiri', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                            @endif 
                            id="sendiri"> Datang Sendiri &nbsp;&nbsp;&nbsp;
        
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)))
                            {{ in_array('polisi', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                            @endif 
                            id="polisi"> Polisi &nbsp;&nbsp;&nbsp;
        
                            <input type="checkbox" onclick="cek_rujukan_dari()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan))){{ in_array('rujukan', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                            @endif 
                            id="rujukan" class="ml-4"> Rujukan dari
                          
                            <span style="border-bottom: 2px dotted;">
                                {{$dokumen->formulir_triage_terintegrasi_v2->ket_rujukan}}                          
                            </span>
    
                            <input type="checkbox" onclick="cek_rujukan_dari()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan))){{ in_array('dijemput', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                            @endif 
                            id="dijemput" class="ml-4"> Dijemput oleh

                            <span style="border-bottom: 2px dotted;">
                                {{$dokumen->formulir_triage_terintegrasi_v2->ket_dijemput}}                          
                            </span>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <span style="margin-right: 50px"> Kendaraan </span>  :&nbsp;
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan)))
                            {{ in_array('ambulans', json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan)) ? 'checked' : '' }}
                            @endif 
                            id="ambulans"> Ambulans &nbsp;&nbsp;&nbsp;
        
                            <input type="checkbox" onclick="cek_kendaraan()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan))){{ in_array('bukan_ambulans', json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan)) ? 'checked' : '' }}
                            @endif 
                            id="bukan_ambulans" class="ml-4"> Kendaraan bukan ambulans, jelaskan
                          
                            <span style="border-bottom: 2px dotted;">
                                {{$dokumen->formulir_triage_terintegrasi_v2->ket_kendaraan}}                          
                            </span>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <span> Identitas pengantar </span>  :
                                Nama : {{ $dokumen->formulir_triage_terintegrasi_v2->nama_pengantar }} &nbsp;&nbsp;&nbsp;
                                No. Telepon : &nbsp;
                                {{ $dokumen->formulir_triage_terintegrasi_v2->no_telp_pengantar }}
                               
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <span style="margin-right: 79px"> Kasus </span>  :&nbsp;
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)))
                            {{ in_array('trauma', json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)) ? 'checked' : '' }}
                            @endif 
                            id="trauma"> Trauma &nbsp;&nbsp;&nbsp;
    
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)))
                            {{ in_array('non_trauma', json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)) ? 'checked' : '' }}
                            @endif 
                            id="non_trauma"> Non trauma &nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background-color: rgb(222, 222, 222); margin-top: -2px; padding-bottom: 5px; border: 1px solid"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: black">KELUHAN UTAMA</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td>
                        {{$dokumen->formulir_triage_terintegrasi_v2->keluhan_utama}} 
                    </td>
                </tr>
            </table> 
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td>
                        Tekanan darah : 
                        {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '' }} mmHg
                    </td>
                    <td>
                        Pernapasan : {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '' }} x/menit

                    </td>
                    <td>
                        Saturasi O2 : {{ $layanan->tanda_vital ? $layanan->tanda_vital->spo2 : '' }} %
                    </td>
                </tr>
                <tr>
                    <td>
                        Nadi : 
                        {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '' }} x/menit
                    </td>
                    <td>
                        Temperatur : {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '' }} &deg;C

                    </td>
                    <td>
                        Nyeri (VAS) : {{$dokumen->formulir_triage_terintegrasi_v2->tv_nyeri}} 
                    </td>
                </tr>
            </table> 
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table class="table_isian">
                <tr>
                    <td style="padding-left: 5px; width: auto">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('cardiac', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="cardiac"> Cardiac Arrest <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('apneu', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="apneu"> Apneu <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('distress', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="distress"> Distress napas hebat <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('sumbatan', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="sumbatan"> Sumbatan jalan napas (gargling, stridor, total) <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('spo', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="spo"> SpO2 < 50% <br><br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('respiration', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="respiration"> RR < 10 x/mnt <br><br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('crt', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="crt"> CRT > 2 detik <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('sianosis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="sianosis"> sianosis <br>
                    </td>
                    <td style="padding-left: 5px; width:auto">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('td_sistolik', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="td_sistolik"> TD Sistolik < 60 mmHg <br><br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('gcs', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif 
                            id="gcs"> GCS 3-8 <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('midriasis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="midriasis"> Pupil midriasis <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('miosis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="miosis"> Pupil miosis / pin point <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('luas_tubuh', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="luas_tubuh"> Luka bakar > 30 % BSA (Luas Tubuh) <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('daerah_vital', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="daerah_vital"> Luka bakar di daerah vital <br>
        
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('suhu_neo', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="suhu_neo"> Suhu &lt; 36&deg;C Neonatus<br>
        
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('kejang', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="kejang"> Kejang pada ibu hamil <br>
        
                        <input type="checkbox" onclick="cek_esi_satu()"
                        @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu))){{ in_array('kritis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif 
                        id="kritis"> Kondisi kritis lain
                      
                        <input type="text"
                        value="@if(old('ket_esi_satu')){{ old('ket_esi_satu') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->ket_esi_satu : '' }}@endif"
                        id="ket_esi_satu" style="border: 0; border-bottom: 2px dotted;"
                        @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('kritis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? '' : 'readonly' }} 
                        @else
                            readonly
                        @endif>
                    </td>
                    <td style="background-color: rgb(244, 109, 104); width: 8%; font-weight: bold">
                        <div style="transform: rotate(90deg); text-align: center">
                            <label for="header_satu" style="text-align: center">
                                <input type="checkbox" 
                                       @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                                       {{ in_array('header_satu', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                                       @endif 
                                       id="header_satu">
                                <span style="text-align: center">
                                    ESI <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                                </span>
                            </label>
                        </div>
                    </td>                    
                    <td rowspan="2" style="width: 10%">
                        <h3 style="transform: rotate(90deg);" > DARURAT </h3>
                    </td>
                    {{-- <td rowspan="2" style="transform: rotate(90deg);">
                        <h3> DARURAT </h3>
                    </td> --}}
                </tr>
                <tr>
                    <td style="padding-left:5px;">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('skala_nyeri', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="skala_nyeri"> Skala Nyeri >= 7 <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('agitasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="agitasi"> Agitasi <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('esi2_gcs', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="esi2_gcs"> GCS 9-12 <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('amnesia', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="amnesia"> Amnesia retrograd <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('kll', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="kll"> KLL dengan riwayat pingsan <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('disorientasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="disorientasi"> Disorientasi (nama, waktu, tempat) <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('esi2_kejang', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="esi2_kejang"> Kejang demam pada anak dengan riwayat kejang demam <br>
                    </td>
                    <td style="padding-left:5px;">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('muntah', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="muntah"> Muntah proyektil <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('trismus', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="trismus"> Trismus <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('kejang2', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="kejang2"> Kejang <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('suhu1', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="suhu1"> Suhu >= 38&deg;C (usia 1-28 hari/1-3 bln)  <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('suhu2', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="suhu2">  Suhu >= 39&deg;C (usia 3 bln - 1 thn) <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('pendarahan', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="pendarahan"> Perdarahan aktif <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('nyeri_dada', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif 
                        id="nyeri_dada"> Nyeri Dada khas <br>
                    </td>
                    <td style="background-color: rgb(244, 109, 104); text-align: center; font-weight: bold">
                        <div style="transform: rotate(90deg);">
                            <label for="header_satu">
                                <input type="checkbox" 
                                       @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                                       {{ in_array('header_dua', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                                       @endif 
                                       id="header_dua">
                                ESI <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                            </label>
                        </div>
                    </td>  
                </tr>
            </table>
        </div>
    </div> 
</div>
<br><br><br><br><br>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;" >
        <div class="col-md-12">
            <table class="table_isian" style="width: 100%">
                <tr>
                    <td style="width: 40%; font-weight: bold; text-align: center;">
                        SUMBER DAYA
                    </td>
                    <td style="width: 60%; font-weight: bold; text-align: center;">
                        DANGER ZONE
                    </td>
                </tr>
            </table>
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 20%; padding-left: 10px">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('laboratorium', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="laboratorium"> Laboratorium <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('ekg', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="ekg"> EKG <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('monitor', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="monitor"> Monitor <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('sinar', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="sinar"> Sinar X <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('usg', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="usg"> USG <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('konsultasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="konsultasi"> Konsultasi
                    </td>
                    <td style="width: 20%; padding-left: 10px;">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('cairan', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="cairan"> Cairan melalui IV <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('injeksi', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="injeksi"> Inj. IV / IM <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('nebulisasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="nebulisasi"> Nebulisasi <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('kateter', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="kateter"> Pasang Kateter Urin <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('pipa', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="pipa"> Pasang Pipa Lambung <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('jahit', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif 
                        id="jahit"> Jahit / Hecting
                    </td>
                    <td style="width: 15%; padding-left: 10px;">
                        <span style="text-align: center;"></span>Usia <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                        {{ in_array('usia_satu', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                        @endif 
                        id="usia_satu"> &lt; 3 bulan <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                        {{ in_array('usia_dua', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                        @endif 
                        id="usia_dua"> 3 bln - 3 thn <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                        {{ in_array('usia_tiga', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                        @endif 
                        id="usia_tiga"> 3 thn - 8 thn  <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                        {{ in_array('usia_satu', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                        @endif 
                        id="usia_satu"> > 8 thn
                    </td>
                    <td style="width: 15%; text-align: center">
                        HR <br>
                        > 180 <br>
                        > 160 <br>
                        > 140 <br>
                        > 100
                    </td>
                    <td style="width: 15%; text-align: center;">
                        RR <br>
                        > 50 <br>
                        > 40 <br>
                        > 30 <br>
                        > 20 <br>
                    </td>
                    <td style="width: 15%; text-align: center">
                        Sp02 <br>
                        &lt; 92 <br>
                        &lt; 92 <br>
                        &lt; 92 <br>
                        &lt; 92 <br>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 30%; font-weight: bold; text-align: center;">
                        DARURAT
                    </td>
                    <td style="width: 70%; font-weight: bold; text-align: center;">
                        NON DARURAT
                    </td>
                </tr>
            </table>
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 30%; font-weight: bold; text-align: center; background-color: rgb(241, 241, 144)">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)))
                        {{ in_array('header_tiga', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)) ? 'checked' : '' }}
                        @endif 
                        id="header_tiga">
                        ESI 3 
                    </td>
                    <td style="width: 35%; font-weight: bold; text-align: center; background-color: rgb(156, 224, 192)">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)))
                        {{ in_array('header_empat', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)) ? 'checked' : '' }}
                        @endif 
                        id="header_empat">
                        ESI 4
                    </td>
                    <td style="width: 35%; font-weight: bold; text-align: center; background-color: rgb(156, 224, 192)">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)))
                        {{ in_array('header_lima', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)) ? 'checked' : '' }}
                        @endif 
                        id="header_lima">
                        ESI 5
                    </td>
                </tr>
            </table>
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 30%; padding-left: 10px;">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)))
                        {{ in_array('sumber_daya', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)) ? 'checked' : '' }}
                        @endif 
                        id="sumber_daya"> Menggunakan lebih dari satu sumber daya <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)))
                        {{ in_array('dg_vital', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)) ? 'checked' : '' }}
                        @endif 
                        id="dg_vital"> Danger Zone Vital Sign
                    </td>
                    <td style="width: 35%; padding-left: 10px">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)))
                        {{ in_array('sd_empat', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)) ? 'checked' : '' }}
                        @endif 
                        id="sd_empat"> Menggunakan satu sumber daya
                    </td>
                    <td style="width: 35%; padding-left: 10px;">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)))
                        {{ in_array('sd_lima', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)) ? 'checked' : '' }}
                        @endif 
                        id="sd_lima"> Tidak menggunakan sumber daya
                    </td>
                </tr>
            </table>
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 70%; padding-left: 10px;">
                        <div class="mb-2">
                            <span>Keputusan Pukul : </span>
                            {{-- {{ date('H:i', strtotime($dokumen->formulir_triage_terintegrasi_v2->keputusan_pukul)) }}  --}}
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && !empty($dokumen->formulir_triage_terintegrasi_v2->keputusan_pukul))
                            {{ date('H:i', strtotime($dokumen->formulir_triage_terintegrasi_v2->keputusan_pukul)) }} WIB
                            @else
                                -
                            @endif
                        </div>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('resusitasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif 
                        id="resusitasi"> Resusitasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('urgensi_rendah', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif 
                        id="urgensi_rendah"> Urgensi Rendah <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('emergensi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif 
                        id="emergensi"> Emergensi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('non_urgensi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif 
                        id="non_urgensi"> Non Urgensi <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('urgensi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif 
                        id="urgensi"> Urgensi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('ponek', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif 
                        id="ponek"> PONEK <br>
    
                        Catatan :
                        <textarea name="catatan" id="catatan" rows="3" style="box-sizing: border-box;"> @if(old('catatan')){{ old('catatan') }} @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->catatan : '' }} @endif
                        </textarea>
                    </td>
                    <td style="width: 30%; text-align: center;">
                        Petugas Triage
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
