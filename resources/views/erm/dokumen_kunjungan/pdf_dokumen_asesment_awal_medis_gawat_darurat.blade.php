<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Asesment Awal Medis Gawat Darurat</title>

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
        <b style="text-align: center; justify-items: center; color: white">DOKUMEN ASESMENT AWAL MEDIS GAWAT DARURAT</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width:30%;"> 
                        Tanggal dan Jam Kedatangan
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <span> : </span>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->created_at ? date('d-m-Y', strtotime($dokumen->created_at)) : '' }}

                            {{-- {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? date('d-m-Y', strtotime($dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_kedatangan)) : '' }} --}}
                        </span>                        
                        , Pukul :
                        {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                        {{-- <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_kedatangan : '' }}</span> --}}
                    </td>
                </tr>
                <tr style="vertical-align: middle">
                    <td style="width: 30%;">
                        Cara Masuk
                        <span style="float: right; padding-left: 20px">: </span>
                    </td>
                    <td style="border-left: hidden;" colspan="2">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-4">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'sendiri' ? 'checked' : '') : '' }}
                                   type="checkbox" value="sendiri" name="radio_cara_masuk"> Datang Sendiri
                            </div>
                            <div class="col-print-8">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'rujukan' ? 'checked' : '') : '' }}
                                type="checkbox" value="rujukan" name="radio_cara_masuk"> Rujukan
                                <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->asal_rujukan : '-'}}</span>

                                Lain-lain : {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_cara_masuk : '' }}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 20%;">
                        Penanggung Pembayaran 
                        <span style="float: right; padding-left: 20px">: </span>
                    </td>
                    <td colspan="2" style="vertical-align: text-top">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-2"><input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'umum' ? 'checked' : '') : '' }}
                                type="checkbox" value="umum" name="radio_cara_bayar"> Umum</div>
                            <div class="col-print-2"><input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'bpjs' ? 'checked' : '') : '' }}
                                    type="checkbox" value="bpjs" name="radio_cara_bayar"> BPJS</div>
                            <div class="col-print-3"><input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'jamkesda' ? 'checked' : '') : '' }}
                                    type="checkbox" value="jamkesda" name="radio_cara_bayar"> Jamkesda</div>
                            <div class="col-print-3"><input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'jampersal' ? 'checked' : '') : '' }}
                                    type="checkbox" value="jampersal" name="radio_cara_bayar"> Jampersal</div>
                            <div class="col-print-4"><input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'bayar_lain' ? 'checked' : '') : '' }}
                                    type="checkbox" value="bayar_lain" name="radio_cara_bayar"> <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bayar_lain : '' }}</span></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Kondisi Pasien
                        <span style="float: right">: </span>
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                <input onclick="cek_radio_kondisi_pasien()"
                                    @if(old('kondisi_pasien'))
                                        {{ old('kondisi_pasien') ==  'emergency' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'emergency' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="emergency" name="radio_kondisi_pasien"> Emergency
                            </div>
                            <div class="col-print-4">
                                <input onclick="cek_radio_kondisi_pasien()"
                                    @if(old('kondisi_pasien'))
                                        {{ old('kondisi_pasien') ==  'false_emergency' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'false_emergency' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="false_emergency" name="radio_kondisi_pasien"> False Emergency
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_kondisi_pasien()"
                                    @if(old('kondisi_pasien'))
                                        {{ old('kondisi_pasien') ==  'no_emergency' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'no_emergency' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="no_emergency" name="radio_kondisi_pasien"> No. Emergency
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_kondisi_pasien()"
                                    @if(old('kondisi_pasien'))
                                        {{ old('kondisi_pasien') ==  'kondisi_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'kondisi_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="kondisi_lain" name="radio_kondisi_pasien"> <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_kondisi_lain : '' }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Jenis Pelayanan 
                        <span style="float: right">: </span>
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                <input @if(old('jenis_pelayanan'))
                                        {{ old('jenis_pelayanan') ==  'preventif' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'preventif' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="preventif" name="radio_jenis_pelayanan"> Preventif
                            </div>
                            <div class="col-print-3">
                                <input @if(old('jenis_pelayanan'))
                                        {{ old('jenis_pelayanan') ==  'paliatif' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'paliatif' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="paliatif" name="radio_jenis_pelayanan"> Paliatif
                            </div>
                            <div class="col-print-3">
                                <input @if(old('jenis_pelayanan'))
                                        {{ old('jenis_pelayanan') ==  'kuratif' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'kuratif' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="kuratif" name="radio_jenis_pelayanan"> Kuratif
                            </div>
                            <div class="col-print-3">
                                <input @if(old('jenis_pelayanan'))
                                        {{ old('jenis_pelayanan') ==  'rehabilitatif' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'rehabilitatif' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="rehabilitatif" name="radio_jenis_pelayanan"> Rehabilitatif
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
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td colspan="4">
                        I. Anamnesis
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        Keluhan Utama
                        <span style="float: right">: </span>
                        
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keluhan_utama : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        Riwayat Penyakit Sekarang
                        <span style="float: right">: </span>
                        
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_sekarang : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        Riwayat Penyakit Dahulu
                        <span style="float: right">: </span>   
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_dahulu : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Riwayat Penyakit Keluarga
                        <span style="float: right">: </span>
                        
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                <input onclick="cek_radio_riwayat_penyakit_keluarga()"
                                    @if(old('riwayat_penyakit_keluarga'))
                                        {{ old('riwayat_penyakit_keluarga') ==  'tidak_ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_keluarga == 'tidak_ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_ada" name="radio_riwayat_penyakit_keluarga"> Tidak Ada
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_riwayat_penyakit_keluarga()"
                                    @if(old('riwayat_penyakit_keluarga'))
                                        {{ old('riwayat_penyakit_keluarga') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_keluarga == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="radio_riwayat_penyakit_keluarga"> Ada <span style="border-bottom: 1px solid">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_penyakit_keluarga : '' }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Riwayat Penggunaan Obat
                        <span style="float: right">: </span>
                        
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                <input onclick="cek_radio_riwayat_penggunaan_obat()"
                                    @if(old('riwayat_penggunaan_obat'))
                                        {{ old('riwayat_penggunaan_obat') ==  'tidak_ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penggunaan_obat == 'tidak_ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_ada" name="radio_riwayat_penggunaan_obat"> Tidak Ada
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_riwayat_penggunaan_obat()"
                                    @if(old('riwayat_penggunaan_obat'))
                                        {{ old('riwayat_penggunaan_obat') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penggunaan_obat == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="ada" name="radio_riwayat_penggunaan_obat"> Ada <span style="border-bottom: 1px solid">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_penggunaan_obat : '' }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Riwayat Alergi
                        <span style="float: right">: </span>
                        
                    </td>
                    <td style="border-left: hidden" colspan="3">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                <input onclick="cek_radio_riwayat_alergi()"
                                    @if(old('riwayat_alergi'))
                                        {{ old('riwayat_alergi') ==  'tidak_ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_alergi == 'tidak_ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="checkbox" value="tidak_ada" name="radio_riwayat_alergi"> Tidak Ada
                            </div>
                            <div class="col-print-3">
                                <input onclick="cek_radio_riwayat_alergi()"
                                @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ada' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_alergi == 'ada' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="ada" name="radio_riwayat_alergi"> Ada <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_alergi : '' }}</span>
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
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td colspan="6">
                        II. Pemeriksaan Fisik
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">Keadaan Umum</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td colspan="4">
                        <input @if(old('keadaan_umum'))
                                   {{ old('keadaan_umum') ==  'tampak_tidak_sakit' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'tampak_tidak_sakit' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="tampak_tidak_sakit" name="radio_keadaan_umum"> Tampak Tidak Sakit
                        <input @if(old('keadaan_umum'))
                                   {{ old('keadaan_umum') ==  'sakit_ringan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_ringan' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="sakit_ringan" name="radio_keadaan_umum" class="ml-4"> Sakit Ringan
                        <input @if(old('keadaan_umum'))
                                   {{ old('keadaan_umum') ==  'sakit_sedang' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_sedang' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="sakit_sedang" name="radio_keadaan_umum" class="ml-4"> Sakit Sedang
                        <input @if(old('keadaan_umum'))
                                   {{ old('keadaan_umum') ==  'sakit_berat' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_berat' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="sakit_berat" name="radio_keadaan_umum" class="ml-4"> Sakit Berat
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">Kesadaran</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td colspan="4">
                        <input @if(old('kesadaran'))
                                   {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'compos_mentis' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="compos_mentis" name="radio_kesadaran"> Compos Mentis
                        <input @if(old('kesadaran'))
                                   {{ old('kesadaran') ==  'apatis' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'apatis' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="apatis" name="radio_kesadaran" class="ml-4"> Apatis
                        <input @if(old('kesadaran'))
                                   {{ old('kesadaran') ==  'somnolen' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'somnolen' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="somnolen" name="radio_kesadaran" class="ml-4"> Somnolen
                        <input @if(old('kesadaran'))
                                   {{ old('kesadaran') ==  'sopor' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'sopor' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="sopor" name="radio_kesadaran" class="ml-4"> Sopor
                        <input @if(old('kesadaran'))
                                   {{ old('kesadaran') ==  'sopor_koma' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'sopor_koma' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="sopor_koma" name="radio_kesadaran" class="ml-4"> Sopor koma
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%"></td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td colspan="4">
                        <input @if(old('kesadaran'))
                                   {{ old('kesadaran') ==  'koma' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'koma' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="koma" name="radio_kesadaran"> koma
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">GCS</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td colspan="4">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                E : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->e_kesadaran : '' }}</span>
                            </div>
                            <div class="col-print-3">
                                M : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->m_kesadaran : '' }}</span>
                            </div>
                            <div class="col-print-3">
                                V : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->v_kesadaran : '' }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">Tanda - Tanda Vital</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td colspan="4">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg <br>
                                SpO2 : {{ $layanan->tanda_vital ? $layanan->tanda_vital->spo2 : '....' }} %
                            </div>
                            <div class="col-print-3">
                                RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                            </div>
                            <div class="col-print-3">
                                Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                            </div>
                            <div class="col-print-3">
                                Suhu {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} &deg;C <br>
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
                <tr>
                    <td colspan="6">
                        III. Status Generalis
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->status_generalis : '' }}
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td colspan="6">
                        IV. Status Lokasi
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center">
                        @if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat)
                            @if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gambar_status_lokalis != '')
                                <div
                                    style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis.jpg') }}')">
                                    <img style="position: relative; top:0px; left: 303px; opacity: 0.5; "
                                        src="{{ asset('status_lokalis/' . $dokumen->dokumen_asesment_awal_medis_gawat_darurat->gambar_status_lokalis) }}"
                                        alt="">
                                </div>
                                <p>Gambar lokasi</p>
                            @else
                                <img style="position: relative; top:0px; z-index: -1;"
                                    src="{{ asset('images/status_lokalis.jpg') }}" alt="">
                                <p style="position:relative; top:0px;">Gambar lokasi</p>
                            @endif
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
                <tr style="border: 1px solid;">
                    <td colspan="6">
                        V. Asesmen Nyeri
                    </td>
                </tr>
                <tr style="border-bottom: hidden">
                    <td colspan="3" style="border-right: hidden">
                        Nyeri :
                        <input
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri == 'tidak' ? 'checked' : '') : '' }}
                            type="radio" value="tidak" name="radio_nyeri"> Tidak
                        <input
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri == 'ya' ? 'checked' : '') : '' }}
                            type="radio" value="ya" name="radio_nyeri"> Ya
                    </td>
                    <td colspan="3">
                        Sifat :
                        <input
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sifat_nyeri == 'akut' ? 'checked' : '') : '' }}
                            type="radio" value="akut" name="radio_sifat_nyeri"> Akut
                        <input
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sifat_nyeri == 'kronis' ? 'checked' : '') : '' }}
                            type="radio" value="kronis" name="radio_sifat_nyeri"> Kronis
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
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 0 || $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 1) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">0<br>Tidak sakit
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 2 || $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 3) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">2<br>Sedikit sakit
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 4 || $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 5) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">4<br>Agak mengganggu
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 6 || $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 7) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">6<br>Mengganggu aktivitas
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 8 || $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 9) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">8<br>Sangat mengganggu
                                    </td>
                                    <td style="vertical-align: top; <?php if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == 10) {
                                                                echo 'background-color:yellow;';
                                                            } ?>">10<br>Tak tertahankan
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row" style="margin-left: 5px;">
                            <div class="col-print-3">1. Kualitas Nyeri <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input class{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas_nyeri == 'nyeri_tumpul' ? 'checked' : '') : '' }}
                                type="radio" value="nyeri_tumpul" name="radio_kualitas_nyeri"> Nyeri Tumpul
                            </div>
                            <div class="col-print-3">
                                <input
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : '' }}
                                    type="radio" value="nyeri_tajam" name="radio_kualitas_nyeri"> Nyeri Tajam
                            </div>
                            <div class="col-print-3">
                                <input
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas_nyeri == 'panas' ? 'checked' : '') : '' }}
                                    type="radio" value="panas" name="radio_kualitas_nyeri"> Panas / Terbakar
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">2. Menjalar <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_menjalar == 'tidak' ? 'checked' : '') : '' }}
                                    type="radio" value="tidak" name="radio_menjalar"> Tidak
                            </div>
                            <div class="col-print-6">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_menjalar == 'ya' ? 'checked' : '') : '' }}
                                    type="radio" value="ya" name="radio_menjalar"> Ya, Ke <span
                                    style="border-bottom: 2px dotted">{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_nyeri_menjalar : '' }}</span>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">3. Skor Nyeri <span style="float: right">: </span> </div>
                            <div class="col-print-9">
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri : '' }}
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">4. Frekuensi Nyeri <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_nyeri == 'jarang' ? 'checked' : '') : '' }}
                                       type="radio" value="jarang" name="radio_frekuensi_nyeri"> Jarang
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : '' }}
                                       type="radio" value="hilang_timbul" name="radio_frekuensi_nyeri"> Hilang Timbul
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_nyeri == 'terus_menerus' ? 'checked' : '') : '' }}
                                       type="radio" value="terus_menerus" name="radio_frekuensi_nyeri"> Terus Menerus
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-print-3">5. Nyeri Mempengaruhi <span style="float: right">: </span> </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'tidur' ? 'checked' : '') : '' }}
                                       type="radio" value="tidur" name="radio_pengaruh_nyeri"> Tidur
                                <br>
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'emosi' ? 'checked' : '') : '' }}
                                       type="radio" value="emosi" name="radio_pengaruh_nyeri"> Emosi
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : '' }}
                                       type="radio" value="aktifitas_fisik" name="radio_pengaruh_nyeri"> Aktifitas Fisik
                                <br>
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'nafsu_makan' ? 'checked' : '') : '' }}
                                       type="radio" value="nafsu_makan" name="radio_pengaruh_nyeri"> Nafsu Makan
                            </div>
                            <div class="col-print-3">
                                <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'konsentrasi' ? 'checked' : '') : '' }}
                                       type="radio" value="konsentrasi" name="radio_pengaruh_nyeri"> Konsentrasi
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
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_wajah : '' }}
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
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_kaki : '' }}
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
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_aktifitas : '' }}
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
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_menangis : '' }}
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
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_bersuara : '' }}
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
                    <td rowspan="6" style="width: 15%">
                        Hasil Skrining <span style="float: right">:</span>
                    </td>
                    <td style="width: 20%">
                        (P) Faktor Pencetus <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->faktor_pencetus : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        (Q) Kualitas <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        (R) Lokasi <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lokasi : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        (S) Skala Nyeri <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skala_nyeri : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">
                        (T) Lama Nyeri <span style="float: right">:</span>
                    </td>
                    <td>
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lama_nyeri : '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -7px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian">
                <tr>
                    <td colspan="5">
                        VI. Pemeriksaan Penunjang
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td colspan="5">
                        <div class="row" style="margin-left: 1px">
                            <div class="col-print-12">
                                A. Laboratorium
                                <div id="list_pesanan">
                                    @if ($layanan->pesanan_lab)
                                        @foreach ($layanan->pesanan_lab as $pl)
                                            @php
                                                $iterasi_pesanan_lab = 0;
                                                $pesan = '';
                                            @endphp
                                                <?php $yang_dipesan = json_decode($pl->periksa); ?>
                                            @foreach ($pemeriksaan as $pem)
                                                @php
                                                    $temp_slug = $pem->slug;
                                                @endphp
                                                @if(isset($yang_dipesan->$temp_slug))
                                                    @if ($yang_dipesan->$temp_slug == 1)
                                                        @if ($iterasi_pesanan_lab > 0)
                                                            @php
                                                                $pesan .= ', ' . $pem->nama;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $pesan .= $pem->nama;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $iterasi_pesanan_lab++;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            {{ $pl->no_lab }} - {{ $pesan }}
                                        @endforeach
                                    @endif
                                </div>
                                <br>
                                B. Radiologi
                                <div id="list_pesanan_radiologi">
                                    @if ($layanan->pesanan_radiologi)
                                        @foreach ($layanan->pesanan_radiologi as $pr)
                                            @php
                                                $iterasi_pesanan_radiologi = 0;
                                                $pesan_radiologi = '';
                                            @endphp
                                                <?php $yang_dipesan = json_decode($pr->periksa); ?>
                                            @foreach ($pemeriksaan_radiologi as $pemrad)
                                                @php
                                                    $temp_slug = 'rad_' . $pemrad->id;
                                                @endphp
                                                @if(isset($yang_dipesan->$temp_slug))
                                                    @if ($yang_dipesan->$temp_slug == 1)
                                                        @if ($iterasi_pesanan_radiologi > 0)
                                                            @php
                                                                $pesan_radiologi .= ', ' . $pemrad->nama;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $pesan_radiologi .= $pemrad->nama;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $iterasi_pesanan_radiologi++;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            {{ $pr->no_lab }} - {{ $pesan_radiologi }}
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        VII. Diagnosa Kerja
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td colspan="5">
                        <div style="display: flex; flex-direction: row">
                            <div id="box_diagnosa" class="ml-2">
                                {{ $diagnosa ? $diagnosa->kode_icd . ' - ' . $diagnosa->nama_icd : '' }}
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
                    <td colspan="4">
                        VIII. TERAPI / TINDAKAN
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        TINDAKAN
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        Jam
                    </td>
                    <td style="text-align: center;">
                        Tindakan
                    </td>
                    <td style="text-align: center; width: 40%">
                        Diberikan Oleh
                    </td>
                    <td style="text-align: center">
                        Evaluasi / Keterangan
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan1 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('tindakan1')){{ old('tindakan1') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan1 : '' }}@endif"
                                       id="tindakan1">
                    </td>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh1 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('keterangan1')){{ old('keterangan1') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan1 : '' }}@endif"
                                       id="keterangan1">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan2 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('tindakan2')){{ old('tindakan2') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan2 : '' }}@endif"
                                       id="tindakan2">
                    </td>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh2 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('keterangan2')){{ old('keterangan2') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan2 : '' }}@endif"
                                       id="keterangan2">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan3 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('tindakan3')){{ old('tindakan3') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan3 : '' }}@endif"
                                       id="tindakan3">
                    </td>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh3 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('keterangan3')){{ old('keterangan3') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan3 : '' }}@endif"
                                       id="keterangan3">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan4 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('tindakan4')){{ old('tindakan4') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan4 : '' }}@endif"
                                       id="tindakan4">
                    </td>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh4 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('keterangan4')){{ old('keterangan4') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan4 : '' }}@endif"
                                       id="keterangan4">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan5 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('tindakan5')){{ old('tindakan5') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan5 : '' }}@endif"
                                       id="tindakan5">
                    </td>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh5 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('keterangan5')){{ old('keterangan5') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan5 : '' }}@endif"
                                       id="keterangan5">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan6 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('tindakan6')){{ old('tindakan6') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan6 : '' }}@endif"
                                       id="tindakan6">
                    </td>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh6 : '' }}
                        </span>
                    </td>
                    <td>
                        <input type="text" style="border: hidden; border-bottom: 1px dotted" value="@if(old('keterangan6')){{ old('keterangan6') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan6 : '' }}@endif"
                                       id="keterangan6">
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        TERAPI
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="list_e_resep" class="pt-3">
                            <div id="box_btn_terapi">
                                No. Resep Elektronik
                                @if (sizeof($all_resep))
                                    @foreach ($all_resep as $ar)
                                        @if ($loop->iteration > 1)
                                            {{ ', ' . $ar->id }}
                                        @else
                                            {{ $ar->id }}
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <table style="border-collapse: collapse; width:100%;">
                                @if (sizeof($all_resep))
                                    @foreach ($all_resep as $ar)
                                        @foreach ($ar->detail as $ar_det)
                                            <tr>
                                                <td colspan="4">{{ 'R/' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20px;"></td>
                                                <td>{{ $ar_det->nama_obat }}</td>
                                                <td>{{ $ar_det->jumlah_pakai_sehari . ' x 1' }}</td>
                                                <td style="padding-left: 20px;">
                                                    {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endif
                            </table>
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
                <tr>
                    <td colspan="3">
                        IX. Tindak Lanjut
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 25%">
                        Dirawat, konsultasi dengan Dokter <span style="float: right">:</span>
                    </td>
                    <td>
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->konsultasi : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">
                        Indikasi Rawat Inap <span style="float: right">:</span>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->indikasi_rawat_inap : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">
                        Pulang <span style="float: right">:</span>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pulang == 'izin_dokter' ? 'checked' : '') : '' }}
                            type="checkbox" value="izin_dokter" name="radio_pulang"> Atas Izin Dokter
                        <input style="margin-left: 100px" {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pulang == 'permintaan_sendiri' ? 'checked' : '') : '' }}
                            type="checkbox" value="permintaan_sendiri" name="radio_pulang"> Atas Permintaan Sendiri
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Kontrol ke Poliklinik
                        <span style="float: right">: </span>
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kontrol_poli : '' }}
                        </span>
                        , Pada tanggal
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_kontrol : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Rujuk ke
                        <span style="float: right">: </span>
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rujuk_ke : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Alasan Rujuk
                        <span style="float: right">: </span>
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->alasan_rujuk : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Menolak Rawat Inap
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;">
                        Alasan
                        <span style="float: right">: </span>
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->alasan_menolak : '' }}
                        </span>
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
                <tr>
                    <td style="width: 30%;">
                        X. Keluar IGD Pada Tanggal
                        <span style="float: right">: </span>
                        
                    </td>
                    <td style="border-left: hidden" colspan="2">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_keluar : '' }}
                        </span>
                        , dan Jam :
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_keluar : '' }}
                        </span>
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
                <tr>
                    <td colspan="4" style="border: 1px solid">
                        XI. KONDISI SAAT KELUAR IGD
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                                {{ old('kondisi_keluar') ==  'sembuh' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'sembuh' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="sembuh" name="radio_kondisi_keluar"> Sembuh / Membaik
                    </td>
                    <td style="width: 25%">
                        <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                                {{ old('kondisi_keluar') ==  'memburuk' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'memburuk' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="memburuk" name="radio_kondisi_keluar"> Memburuk
                    </td>
                    <td style="width: 25%">
                        <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                                {{ old('kondisi_keluar') ==  'tetap' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'tetap' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="tetap" name="radio_kondisi_keluar"> Tetap
                    </td>
                    <td style="width: 25%">
                        <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                                {{ old('kondisi_keluar') ==  'doa' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'doa' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="doa" name="radio_kondisi_keluar"> DOA
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                                {{ old('kondisi_keluar') ==  'meninggal' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'meninggal' ? 'checked' : '') : '' }}
                            @endif
                            type="checkbox" value="meninggal" name="radio_kondisi_keluar"> Meninggal Pada Tanggal : 
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_meninggal : '' }}
                        </span>
                        , dan Jam :
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_meninggal : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        Keadaan Umum <span style="float: right">:</span>
                    </td>
                    <td colspan="3">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum_keluar : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        Kesadaran <span style="float: right">:</span>
                    </td>
                    <td colspan="3">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran_keluar : '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        Tanda Vital <span style="float: right">:</span>
                    </td>
                    <td colspan="3">
                        <div class="row" style="margin-left: 10px">
                            <div class="col-print-3">
                                TD :  {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_keluar : '' }} mmHg <br>
                                SpO2 :  {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_spo2 : '' }} %
                            </div>
                            <div class="col-print-3">
                                RR :  {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_rr : '' }} x/menit
                            </div>
                            <div class="col-print-3">
                                Nadi :  {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_nadi : '' }} x/menit
                            </div>
                            <div class="col-print-3">
                                Suhu : {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_suhu : '' }} &deg;C
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Catatan Penting (Kondisi Saat Ini) :
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <span style="border-bottom: 1px dotted;">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->catatan_penting : '' }}
                        </span>
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
                <tr>
                    <td colspan="4" style="border: 1px solid">
                        XII. EDUKASI
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="border: 1px solid">
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->edukasi : '' }}
                        </span>
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
                <tr>
                    <td colspan="4">
                        XIII. Edukasi awal mengenai diagnosa, terapi, dan tindakan disampaikan kepada :
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->penyampaian_edukasi == 'pasien' ? 'checked' : '') : '' }}
                                type="checkbox" value="pasien" name="radio_penyampaian_edukasi"> Pasien / Keluarga
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->penyampaian_edukasi == 'tidak_dapat_menyampaikan' ? 'checked' : '') : '' }}
                            type="checkbox" value="tidak_dapat_menyampaikan" name="radio_penyampaian_edukasi"> Tidak dapat menyampaikan edukasi, karena :
                        <span style="border-bottom: 1px dotted">
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->alasan_tidak_menyampaikan_edukasi : '' }}
                        </span>
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
                    <td style="width: 50%">
                        
                    </td>
                    <td style="width: 50%; text-align: center">
                        Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}, Jam: {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 50%; text-align: center">
                        @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                            <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_pasien}})
                    </td>
                    <td style="width: 50%; text-align: center">
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
