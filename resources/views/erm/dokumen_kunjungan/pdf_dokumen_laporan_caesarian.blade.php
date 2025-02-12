<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Laporan Caesarian</title>

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
            font-size: 14px;
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
        <b style="text-align: center; justify-items: center; color: white">LAPORAN SECTION CAESARIAN</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="padding: 10px; text-align: center">
                        Dokter Operator :
                        <br>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->d_operator : ''}}
                    </td>
                    <td style="padding: 10px; text-align: center">
                        Asisten Operator :
                        <br>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->a_operator : ''}}
                    </td>
                    <td style="padding: 10px; text-align: center">
                        Instrumen :
                        <br>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->instrumen : ''}}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; text-align: center">
                        Spesialis Anastesi :
                        <br>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->d_anastesi : ''}}
                    </td>
                    <td style="padding: 10px; text-align: center">
                        Asisten Anastesi :
                        <br>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->a_anastesi : ''}}
                    </td>
                    <td style="padding: 10px; text-align: center">
                        Jenis Anastesi :
                        <br>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->jenis_anastesi : '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian2">
                <tr>
                    <td style="width: 25%">
                        Diagnosis Pra Bedah <span style="float: right; justify-content: space-between; align-items: center ">:</span>
                    </td>
                    <td colspan="3" style="padding-left: 10px">
                        {!! nl2br(e($dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->pra_bedah : '')) !!}
                    </td>                    
                </tr>
                <tr>
                    <td style="width: 25%">
                        Diagnosis Pasca Bedah <span style="float: right">:</span>
                    </td>
                    <td colspan="3" style="padding-left: 10px">
                        {{-- {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : '' }} --}}
                        {!! nl2br(e($dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->pasca_bedah : '')) !!}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        Tindakan <span style="float: right">:</span>
                    </td>
                    <td colspan="3" style="padding-left: 10px">
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->tindakan : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        Indikasi Operasi <span style="float: right">:</span>
                    </td>
                    <td style="padding-left: 10px; width: 30%; border-right: 1px solid">
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->indikasi_operasi : '' }}
                    </td>
                    <td colspan="2" style="width: 45%; vertical-align: text-top">
                        Posisi :
                        @if($dokumen->dokumen_laporan_caesarian)
                            @if($dokumen->dokumen_laporan_caesarian->posisi == 'supine')
                                <s>Supine</s>/
                            @else
                                Supine/
                            @endif
                            @if($dokumen->dokumen_laporan_caesarian->posisi == 'tiring')
                                <s>Tiring</s>/
                            @else
                                Tiring/
                            @endif
                            @if($dokumen->dokumen_laporan_caesarian->posisi == 'tengkurap')
                                <s>Tengkurap</s>/
                            @else
                                Tengkurap/
                            @endif
                            @if($dokumen->dokumen_laporan_caesarian->posisi == 'prone')
                                <s>Prone</s>/
                            @else
                                Prone/
                            @endif
                            @if($dokumen->dokumen_laporan_caesarian->posisi == 'trendelenburg')
                                <s>Tredelenburg</s>/
                            @else
                                Tredelenburg/
                            @endif
                            @if($dokumen->dokumen_laporan_caesarian->posisi == 'litotomy')
                                <s>Litotomy</s>
                            @else
                                Litotomy
                            @endif
                        @endif
                    </td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 25%">
                        Jenis Pembedahan <span style="float: right">:</span>
                    </td>
                    <td style="padding-left: 10px; width: 40%; border-right: 1px solid; vertical-align: text-top !important;">
                        <span>
                            <input {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'khusus' ? 'checked' : '') : '' }}
                                   type="checkbox" value="khusus" name="radio_jenis_pembedahan"> Khusus
                        </span>
                        <span>
                            <input {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'besar' ? 'checked' : '') : '' }}
                                   type="checkbox" value="besar" name="radio_jenis_pembedahan"> Besar
                        </span>
                        <span>
                            <input {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'sedang' ? 'checked' : '') : '' }}
                                   type="checkbox" value="sedang" name="radio_jenis_pembedahan"> Sedang
                        </span>
                        <span>
                            <input {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'kecil' ? 'checked' : '') : '' }}
                                   type="checkbox" value="kecil" name="radio_jenis_pembedahan"> Kecil
                        </span>
                    </td>
                    <td colspan="2" style="width: 35%;">
                        <input
                            {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan2 == 'terencana' ? 'checked' : '') : '' }}
                            type="checkbox" value="terencana" name="radio_jenis_pembedahan2"> Terencana
                        <input
                            {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan2 == 'gawat' ? 'checked' : '') : '' }}
                            type="checkbox" value="gawat" name="radio_jenis_pembedahan2"> Gawat Darurat
                    </td>
                </tr>
                <tr style="vertical-align: text-top">
                    <td style="width: 25%">
                        Jenis Luka Operasi <span style="float: right">:</span>
                    </td>
                    <td colspan="3" style="padding-left: 10px;">
                        <div>
                            <div class="col-print-2">
                                <input @if(old('jenis_luka_operasi'))
                                           {{ old('jenis_luka_operasi') ==  'bersih' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'bersih' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="bersih" name="radio_jenis_luka_operasi"> Bersih
                            </div>
                            <div class="col-print-4">
                                <input @if(old('jenis_luka_operasi'))
                                           {{ old('jenis_luka_operasi') ==  'bersih_terkontaminasi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'bersih_terkontaminasi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="bersih_terkontaminasi" name="radio_jenis_luka_operasi">
                                Bersih Terkontaminasi
                            </div>
                            <div class="col-print-3">
                                <input @if(old('jenis_luka_operasi'))
                                           {{ old('jenis_luka_operasi') ==  'terkontaminasi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'terkontaminasi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="terkontaminasi" name="radio_jenis_luka_operasi">
                                Terkontaminasi
                            </div>
                            <div class="col-print-3">
                                <input @if(old('jenis_luka_operasi'))
                                           {{ old('jenis_luka_operasi') ==  'terinfeksi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'terinfeksi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="checkbox" value="terinfeksi" name="radio_jenis_luka_operasi">
                                Kotor/Terinfeksi
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="width: 100%">
                        <table style="width: 100%; border: hidden">
                            <tr>
                                <td style="width: 25%; border: 1px solid">
                                    Tanggal :
                                    <br>
                                    {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->tanggal : '' }}
                                </td>
                                <td style="width: 25%; border: 1px solid">
                                    Mulai :
                                    <br>
                                    {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->mulai : '' }}
                                </td>
                                <td style="width: 25%; border: 1px solid">
                                    Selesai :
                                    <br>
                                    {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->selesai : '' }}
                                </td>
                                <td style="width: 25%; border: 1px solid">
                                    Lama Pembedahan :
                                    <br>
                                    {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->lama_pembedahan : '' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        (Centang yang diperlukan *)
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="row" style="width: 95.7%; margin-left: 15px; margin-top: -2px; font-size: 14px; border: 1px solid">
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('antisepsis',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif id="antisepsis">
            A dan anti sepsis
            <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_antisepsis : '' }}</span>
        </div>
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('insisi',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif id="insisi">
            Insisi
            <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_insisi : '' }}</span>
        </div>
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('peritonium',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="peritonium">
            Setelah peritonium di buka uterus membesar sesuai kehamilan
        </div>
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('plika',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="plika">
            Plika Vesika uterina disayat semilunar, kandung kencing disisihkan kebawah.
        </div>
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('sbu_sayat',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="sbu_sayat">
            SBU disayat semilunar, air ketuban
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('jernih',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="jernih">Jernih
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('putih_keruh',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="putih_keruh">Putih Keruh
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('hijau_encer',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="hijau_encer">Hijau Encer
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('hijau_kental',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="hijau_kental">Hijau Kental
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('berbau',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="berbau">Berbau
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('tidak_berbau',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="tidak_berbau">Tidak Berbau, jumlah : 
            {{-- <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'jernih' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'jernih' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="jernih" name="radio_air_ketuban" disabled> Jernih
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'putih_keruh' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'putih_keruh' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="putih_keruh" name="radio_air_ketuban" disabled> Putih Keruh
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'hijau_encer' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'hijau_encer' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="hijau_encer" name="radio_air_ketuban" disabled> Hijau Encer
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'hijau_kental' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'hijau_kental' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="hijau_kental" name="radio_air_ketuban" disabled> Hijau Kental
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'berbau' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'berbau' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="berbau" name="radio_air_ketuban" disabled> Berbau --}}
            {{-- <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'tidak_berbau' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'tidak_berbau' ? 'checked' : '') : '' }}
                   @endif style="padding-left: 15px"
                   type="checkbox" value="tidak_berbau" name="radio_air_ketuban" disabled> Tidak Berbau, jumlah :  --}}
                   <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->jumlah_air_ketuban : '' }}</span> ml
        </div>
        <div class="col-md-12">
            <input onchange="cek_bayi()" type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('bayi',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif id="bayi">
            Bayi
            <input @if(old('bayi'))
                       {{ old('bayi') ==  'tunggal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->bayi == 'tunggal' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="tunggal" name="radio_bayi" disabled> Tunggal /
            <input @if(old('bayi'))
                       {{ old('bayi') ==  'gemelli' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->bayi == 'gemelli' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="gemelli" name="radio_bayi" disabled> Gemelli, dilahirkan dengan :
                   {{ $dokumen->dokumen_laporan_caesarian->dilahirkan_dengan ?? '' }}
            <table style="width: 100%">
                <tr>
                    <td style="width: 20%; padding-left: 15px">
                        BB : {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->bb1 : '' }} gram
                    </td>
                    <td style="width: 20%">
                        PB : {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->pb1 : '' }} cm
                    </td>
                    <td style="width: 20%">
                        AS : {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->as1 : '' }}
                    </td>
                    <td style="width: 40%">
                        Kelamin : {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->kelamin1 : '' }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12">
            <input onchange="cek_plasenta()" type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('plasenta',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="plasenta">
            Plasenta berinplantasi di : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_plasenta : '.........................' }}</span>
            <br>
            <span style="margin-left: 19px">Lahir dengan :</span><span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->lahir_dengan : '.........................' }}</span>
            <br>
            <span style="margin-left: 19px">Keadaan / Kelainan :</span><span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->kelainan : '.........................' }}</span>
        </div>
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_sbu_jahit()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('sbu_jahit',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="sbu_jahit">
            SBU dijahit 1 lapis / 2 lapis dengan : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_sbu_jahit : '..........................' }}</span>
            <br>
            <span style="margin-left: 19px">Setelah diyakinkan tidak ada pendarahan, rongga abdomen di tutup lapis demi lapis dengan/tanpa</span>
            <br>
            <span style="margin-left: 19px">meninggalkan Dextran 70/NaCL</span>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid">
            <input type="checkbox" onchange="cek_tubae()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('tubae',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="tubae">
            Ke dua tubae <span style="padding-left: 40px">:</span>
            <input @if(old('tubae'))
                       {{ old('tubae') ==  'normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->tubae == 'normal' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="normal" name="radio_tubae" disabled> Normal /
            <input @if(old('tubae'))
                       {{ old('tubae') ==  'tidak_normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->tubae == 'tidak_normal' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="tidak_normal" name="radio_tubae" disabled> Tidak Normal {{ $dokumen->dokumen_laporan_caesarian->isian_tubae && $dokumen->dokumen_laporan_caesarian->isian_tubae != '' ? ', '.$dokumen->dokumen_laporan_caesarian->isian_tubae : '' }}
            <br>
            <span style="padding-left: 18px">Ovarium Kiri</span> <span style="padding-left: 45px">:</span>
            <input @if(old('ovarium_kiri'))
                       {{ old('ovarium_kiri') ==  'normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kiri == 'normal' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="normal" name="radio_ovarium_kiri" disabled> Normal /
            <input @if(old('ovarium_kiri'))
                       {{ old('ovarium_kiri') ==  'tidak_normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kiri == 'tidak_normal' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="tidak_normal" name="radio_ovarium_kiri" disabled> Tidak Normal {{ $dokumen->dokumen_laporan_caesarian->isian_ovarium_kiri && $dokumen->dokumen_laporan_caesarian->isian_ovarium_kiri != '' ? ', '.$dokumen->dokumen_laporan_caesarian->isian_ovarium_kiri : '' }}
            <br>
            <span style="padding-left: 18px">Ovarium Kanan</span> <span style="padding-left: 25px">:</span>
            <input @if(old('ovarium_kanan'))
                       {{ old('ovarium_kanan') ==  'normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kanan == 'normal' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="normal" name="radio_ovarium_kanan" disabled> Normal /
            <input @if(old('ovarium_kanan'))
                       {{ old('ovarium_kanan') ==  'tidak_normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kanan == 'tidak_normal' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="tidak_normal" name="radio_ovarium_kanan" disabled> Tidak Normal {{ $dokumen->dokumen_laporan_caesarian->isian_ovarium_kanan && $dokumen->dokumen_laporan_caesarian->isian_ovarium_kanan != '' ? ', '.$dokumen->dokumen_laporan_caesarian->isian_ovarium_kanan : '' }}
        </div>
        <div class="page_break"></div>
        <div class="col-md-12" style="border-top: 1px solid">
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('jumlah',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="jumlah">
            Jumlah
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('depper',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="depper"> depper /
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('kassa',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="kassa"> kassa /
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('bendera',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="bendera"> bendera /
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('kassa_gulung',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="kassa_gulung"> kassa gulung :
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('lengkap',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="lengkap"> lengkap /
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
            {{ in_array('kurang',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="kurang"> kurang :   <input type="text" id="ket_jumlah" readonly
            value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_jumlah : '' }}"
            style="border: hidden" placeholder="................................................">
        </div>

            {{-- <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'depper' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'depper' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="depper" name="radio_jumlah" disabled> depper /
            <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'kassa' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'kassa' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="kassa" name="radio_jumlah" disabled> kassa /
            <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'bendera' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'bendera' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="bendera" name="radio_jumlah" disabled> bendera /
            <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'kassa_gulung' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'kassa_gulung' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="kassa_gulung" name="radio_jumlah" disabled> kassa gulung :
            <input @if(old('det_jumlah'))
                       {{ old('det_jumlah') ==  'lengkap' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->det_jumlah == 'lengkap' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="lengkap" name="radio_det_jumlah" disabled> lengkap /
            <input @if(old('det_jumlah'))
                       {{ old('det_jumlah') ==  'kurang' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->det_jumlah == 'kurang' ? 'checked' : '') : '' }}
                   @endif
                   type="checkbox" value="kurang" name="radio_det_jumlah" disabled> kurang --}}
          
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_pendarahan()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('pendarahan',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="pendarahan">
            Pendarahan : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_pendarahan : '' }}</span> ml
        </div>
    </div>
</div>
<div class="row">
    <div style="width: 96.4%; margin-left: 15px; margin-top: -2px; font-size: 14px;">
        <div class="col-print-8" style="border: 1px solid; padding-bottom: 10px; padding-top: 10px;">
            <table style="width: 100%; height: 5cm" >
                <tr>
                    <td style="width: 30%">No. Batch implan <span style="float: right">:</span></td>
                    <td>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->no_batch : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Komplikasi <span style="float: right">:</span></td>
                    <td>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->komplikasi : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Pendarahan <span style="float: right">:</span></td>
                    <td>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->pendarahan : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Dikirim PA <span style="float: right">:</span></td>
                    <td>
                        <input @if(old('dikirim_pa'))
                                   {{ old('dikirim_pa') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->dikirim_pa == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_dikirim_pa"> Ya
                        <input @if(old('dikirim_pa'))
                                   {{ old('dikirim_pa') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->dikirim_pa == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_dikirim_pa"> Tidak
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Asal Jaringan <span style="float: right">:</span></td>
                    <td>
                        {{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->asal_jaringan : '' }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-print-4 text-center" style="padding-bottom: 10px; padding-top: 10px; border: 1px solid; height: 5cm">
            Dokter Operator
            <br>
            @if(isset($employee))
                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                     style="height: 4cm; width: 5cm;" alt="">
            @else
                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
            @endif
            <br>({{$dokumen->nama_verifikator}})<br>
        </div>
    </div>
</div>
</body>

</html>
