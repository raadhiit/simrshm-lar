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
        </table>
    </div>
</div>
<div class="row">
    <div
        style="float: left; width: 95.8%; margin-left: 15px; background: black; margin-top: -2px; padding-bottom: 5px; border: 1px solid"
        class="text-center">
        <b style="text-align: center; justify-items: center; color: white">ORIENTASI PENERIMAAN PASIEN BARU</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <div class="col-md-12">
                Tanggal : <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_orientasi_pasien_baru ? $dokumen->dokumen_orientasi_pasien_baru->tanggal : '' }}</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
        <div class="col-md-12">
            <table style="width: 100%;" class="table_isian_bordered">
                <tr style="text-align: center">
                    <td>
                        <b>NO</b>
                    </td>
                    <td>
                        <b>Keterangan Edukasi</b>
                    </td>
                    <td>
                        <b>Ya</b>
                    </td>
                    <td>
                        <b>Tidak</b>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 5%">1</td>
                    <td style="width: 65%">
                        Perawat memperkenalkan dirinya dan menanyakan nama lengkap dan tanggal lahir 
                        pasien serta mencocokkannya dengan status rekam medis pasien, gelang pasien dan memperkenalkan
                        kepada pasien yang lain yang berada di ruangan tersebut, bila ada
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('satu'))
                                   {{ old('satu') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->satu == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_satu">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('satu'))
                                   {{ old('satu') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->satu == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_satu">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 5%">2</td>
                    <td style="width: 65%">
                        Mengenalkan perawat koordinator dan dokter jaga ruangan perawatan, Dokter Penanggung
                        Jawab Pelayanan serta dokter yang merawat pasien
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('dua'))
                                   {{ old('dua') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->dua == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_dua">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('dua'))
                                   {{ old('dua') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->dua == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_dua">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 5%">3</td>
                    <td style="width: 65%">
                        Ingatkan pasien bahwa Rumah Sakit tidak bertanggung jawab atas kehilangan dan kerusakan
                        barang-barang berharga.
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tiga'))
                                   {{ old('tiga') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tiga == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_tiga">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tiga'))
                                   {{ old('tiga') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tiga == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_tiga">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 5%">4</td>
                    <td style="width: 65%">
                        Orientasi Lingkungan rumah sakit mengenai :
                        <br>
                        <ul>
                            <li>Nurse Call System, Toilet emergency call</li>
                            <li>Waktu pemberian makan</li>
                            <li>Jam kunjung Pagi & Sore</li>
                            <li>Cara mengatur tempat tidur, lampu, air panas</li>
                            <li>Penggunaan telepon/televisi/kulkas</li>
                            <li>Jalur Evakuasi</li>
                        </ul>
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('empat'))
                                   {{ old('empat') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->empat == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_empat">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('empat'))
                                   {{ old('empat') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->empat == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_empat">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 5%">5</td>
                    <td style="width: 65%">
                        Menanyakan kebutuhan privasi pasien
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('lima'))
                                   {{ old('lima') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->lima == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_lima">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('lima'))
                                   {{ old('lima') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->lima == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_lima">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 5%">6</td>
                    <td style="width: 65%">
                        Edukasi pasien agar melapor ke perawat / bidan / Dokter jaga jika pasien mengalami
                        penurunan kondisi seperti : selalu tidur pulas, sulit dibangunkan, makin sesak, makin nyeri,
                        dan lain-lain.
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('enam'))
                                   {{ old('enam') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->enam == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_enam">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('enam'))
                                   {{ old('enam') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->enam == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_enam">
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" style="text-align: center; width: 5%">7</td>
                    <td style="width: 65%">
                        Pada pasien anak, orang tua atau pasien dengan kesadaran kurang, harap memasang pengaman
                        tempat tidur
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tujuh_satu'))
                                   {{ old('tujuh_satu') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_satu == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_tujuh_satu">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tujuh_satu'))
                                   {{ old('tujuh_satu') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_satu == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_tujuh_satu">
                    </td>
                </tr>
                <tr>
                    <td style="width: 65%">
                        Jumlah penunggu pasien di ruangan maksimal 1 orang
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tujuh_dua'))
                                   {{ old('tujuh_dua') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_dua == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_tujuh_dua">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tujuh_dua'))
                                   {{ old('tujuh_dua') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_dua == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_tujuh_dua">
                    </td>
                </tr>
                <tr>
                    <td style="width: 65%">
                        Pengunjung pasien hanya bisa mengunjungi pada jam kunjung atau atas izin dari perawat atau bidan jaga
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tujuh_tiga'))
                                   {{ old('tujuh_tiga') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_tiga == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="ya" name="radio_tujuh_tiga">
                    </td>
                    <td style="width: 15%; text-align: center">
                        <input @if(old('tujuh_tiga'))
                                   {{ old('tujuh_tiga') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_tiga == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak" name="radio_tujuh_tiga">
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
                <tr style="border: hidden;">
                    <td colspan="2">
                        Pasien / Keluarga (
                        <input @if(old('pemahaman'))
                                   {{ old('pemahaman') ==  'memahami' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->pemahaman == 'memahami' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="memahami" name="radio_pemahaman"> memahami / 
                        <input @if(old('pemahaman'))
                                   {{ old('pemahaman') ==  'tidak_memahami' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->pemahaman == 'tidak_memahami' ? 'checked' : '') : '' }}
                               @endif
                               type="checkbox" value="tidak_memahami" name="radio_pemahaman"> tidak memahami )
                        orientasi ruangan yang telah diberikan
                    </td>
                </tr>
                <tr style="border: hidden;">
                    <td style="width: 50%; text-align: center; padding-top: 20px">
                        Nama & Tanda tangan Perawat/Bidan
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_verifikator}})
                    </td>
                    <td style="width: 50%; text-align: center; padding-top: 20px">
                        Nama & Tanda tangan Pasien/Keluarga
                        @if(!is_null($dokumen->signature_pasien) || $dokumen->signature_pasien != "")
                            <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_pasien}})
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>

</html>
