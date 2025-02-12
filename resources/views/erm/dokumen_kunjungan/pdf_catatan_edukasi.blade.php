<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>General Consent</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
        input[type=checkbox] { display: inline; }

        .half_column {
            float: left;
            width: 50%;
            border: 1px solid;
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

        .table_isian2 td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 12px;
        }

        .table_isian2 th {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 12px;
            height: 150px;
        }

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

        thead {display: table-row-group;}
    </style>
</head>

<body style="border:1px solid;">
<footer>
    <div class="row" style="width: 100%; margin-left: 0;">
        <div style="width: 50%; float:left;">
            Halaman <span class="pagenum"></span>
        </div>
        <div style="width: 50%; float:left; text-align:right; color:#777; font-style:italic;">
            MR. 04.06.001.Rev.1
        </div>
    </div>
</footer>
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
        <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 13px;">
            <tr>
                <td style="padding-left: 10px;">Nama</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->nama }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">No. Rekam Medis</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->nrm }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Tgl. Lahir</td>
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
            {{-- <br> --}}
            <tr>
                <td colspan="3" style="text-align: right">*Tempel Label</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div style="float: left; width: 96%; background: black; margin-left: 14px; margin-top: -1px">
        <p style="color: white; text-align: center; justify-items: center">CATATAN EDUKASI TERINTEGRASI PASIEN /
            KELUARGA</p>
    </div>
</div>
<div style="margin-top: -5px">
    <table class="table_isian" style="border-collapse:collapse; border: 1px solid; width: 100%;">
        <tr>
            <td colspan="1" style="width: 30%;">
                <p style="padding-left: 10px; padding-top:10px">1. Bahasa</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Indonesia',json_decode($dokumen->catatan_edukasi_pasien->bahasa )) ? 'checked' : '' }}
                @endif id="indonesia"> Indonesia,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Daerah',json_decode($dokumen->catatan_edukasi_pasien->bahasa )) ? 'checked' : '' }}
                @endif  id="daerah" style="margin-left: 40px;"> Daerah,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Lainnya',json_decode($dokumen->catatan_edukasi_pasien->bahasa )) ? 'checked' : '' }}
                @endif  id="lainnya" style="margin-left: 40px;">
                Lainnya : {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->bahasa_lainnya : '' }}
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p style="padding-left: 10px; padding-top:10px">2. Kebutuhan Penerjemah</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox"
                       {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerjemah == "tidak" ? 'checked' : "" : "" }} value="tidak"
                       name="kebutuhan_penerjemah"> Tidak,
                <input type="checkbox"
                       {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerjemah == "ya" ? 'checked' : "" : "" }} value="ya"
                       name="kebutuhan_penerjemah" class="ml-4"> Ya : {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerjemah_lainnya : '' }}
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p style="padding-left: 10px; padding-top:10px">3. Pendidikan Pasien</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('sd',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }}
                @endif  id="sd"> SD,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('smp',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }}
                @endif  id="smp" style="margin-left: 15px;"> SMP,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('sma',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }}
                @endif  id="sma" style="margin-left: 15px;"> SMA,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('d1',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }}
                @endif  id="d1" style="margin-left: 15px;"> DI/DII/DIII,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('s1',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }}
                @endif  id="s1" style="margin-left: 15px;"> SI/SII/SIII,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('pendidikan',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }}
                @endif  id="pendidikan" style="margin-left: 15px;">
                &nbsp; <input type="text" id="pendidikan_lainnya"
                              value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->pendidikan_lainnya : '' }}"
                              style="border: 0px" placeholder="................................................">
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p style="padding-left: 10px; padding-top:10px">4. Baca & Tulis</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox"
                       {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->baca_tulis == "baik" ? 'checked' : "" : "" }} value="baik"
                       name="radio_baca_tulis"> Baik,
                <input type="checkbox"
                       {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->baca_tulis == "kurang" ? 'checked' : "" : "" }} value="kurang"
                       name="radio_baca_tulis" class="ml-4"> Kurang
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p style="padding-left: 10px; padding-top:10px">5. Type Pembelajaran</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Verbal', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }}
                @endif  id="Verbal"> Verbal,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Tulis', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }}
                @endif  id="Tulis" style="margin-left: 15px;">Tulis
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Demonstrasi', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }}
                @endif  id="Demonstrasi" style="margin-left: 15px;"> Demonstrasi
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Pembelajaran', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }}
                @endif  id="pembelajaran" style="margin-left: 15px;"> {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->pembelajaran_lainnya : '' }}
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p style="padding-left: 10px; padding-top:10px">6. Hambatan Edukasi</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('tidak_ada', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="tidak_ada"> Tidak Ada,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('emosional', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="emosional" style="margin-left: 15px;"> Emosional,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('fisik_lemah', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="fisik_lemah" style="margin-left: 15px;"> Fisik Lemah,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('gangguan_mata', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="gangguan_mata" style="margin-left: 15px;"> Gangguan Mata,
                <br>
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('gangguan_telinga', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="gangguan_telinga" style="margin-left: 15px;"> Gangguan Telinga,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('gangguan_bicara', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="gangguan_bicara" style="margin-left: 15px;"> Gangguan Bicara,<br>
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('bahasa', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="bahasa"> Bahasa/Kognitif terbatas,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('budaya', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="budaya" style="margin-left: 15px;"> Budaya / Agama / Spiritual,<br>
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('hambatan_edukasi', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }}
                @endif  id="hambatan_edukasi"> lain-lain : {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->hambatan_edukasi_lainnya : '' }}
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p style="padding-left: 10px; padding-top:10px">7. Kesediaan Menerima Edukasi</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox"
                       {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->menerima_edukasi == "bersedia" ? 'checked' : "" : "" }} value="bersedia"
                       name="radio_menerima_edukasi" class="ml-4"> Bersedia,
                <input type="checkbox"
                       {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->menerima_edukasi == "tidak bersedia" ? 'checked' : "" : "" }} value="tidak bersedia"
                       name="radio_menerima_edukasi" class="ml-4"> Tidak Bersedia
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 50%; padding:10px;">
                <p class="pl-2 pt-2" style="font-weight: bold;">METODE EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "wawancara" ? 'checked' : "" : "" }} value="wawancara" name="radio_metode_edukasi"> Wawancara</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "diskusi" ? 'checked' : "" : "" }} value="diskusi" name="radio_metode_edukasi"> Diskusi</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "demonstrasi" ? 'checked' : "" : "" }} value="demonstrasi" name="radio_metode_edukasi"> Demonstrasi</li>
                    <li>
                        <input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "edukasi_lain_lain" ? 'checked' : "" : "" }} value="edukasi_lain_lain" name="radio_metode_edukasi"> Lain-lain : 
                        {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi_lainnya : '' }}
                    </li>
                </ul>
            </td>
            <td colspan="2" style="width: 50%;">
                <p class="pl-2 pt-2" style="font-weight: bold;">SARANA EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "leaflet" ? 'checked' : "" : "" }} value="leaflet" name="radio_sarana_edukasi"> Leaflet</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "audiovisual" ? 'checked' : "" : "" }} value="audiovisual" name="radio_sarana_edukasi"> Audiovisual</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "lisan" ? 'checked' : "" : "" }} value="lisan" name="radio_sarana_edukasi"> Lisan</li>
                    <li>
                        <input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "lain_lain" ? 'checked' : "" : "" }} value="lain_lain" name="radio_sarana_edukasi"> Lain-lain : 
                        {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi_lain : '' }}
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:14px;">
                <p class="pl-2 pt-2" style="font-weight: bold;">PENERIMA EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "pasien" ? 'checked' : "" : "" }} value="pasien" name="radio_penerima_edukasi"> Pasien</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "pasangan" ? 'checked' : "" : "" }} value="pasangan" name="radio_penerima_edukasi"> Pasangan (Suami/Istri)</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "orang_tua" ? 'checked' : "" : "" }} value="orang_tua" name="radio_penerima_edukasi"> Orang Tua</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "saudara_kandung" ? 'checked' : "" : "" }} value="saudara_kandung" name="radio_penerima_edukasi"> Saudara Kandung</li>
                    <li>
                        <input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "lain_lain" ? 'checked' : "" : "" }} value="lain_lain" name="radio_penerima_edukasi"> Lain-lain : 
                        {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi_lain : '' }}
                    </li>
                </ul>
            </td>
            <td colspan="2">
                <p class="pl-2 pt-2" style="font-weight: bold;">EVALUASI EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->evaluasi_edukasi == "re_edukasi" ? 'checked' : "" : "" }} value="re_edukasi" name="radio_evaluasi_edukasi"> Re - Edukasi</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->evaluasi_edukasi == "mengerti" ? 'checked' : "" : "" }} value="mengerti" name="radio_evaluasi_edukasi"> Sudah Mengerti</li>
                    <li><input type="checkbox" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->evaluasi_edukasi == "paham" ? 'checked' : "" : "" }} value="paham" name="radio_evaluasi_edukasi"> Sudah Paham</li>
                </ul>
            </td>
        </tr>
    </table>
</div>
</body>
<body style="margin-left: -20px">
<table class="table_isian2" style="border-collapse:collapse; border: 1px solid; width: 100%;">
    <thead>
    <tr style="height: 100">
        <th style="width: 5%">Tgl / Jam</th>
        <th style="width: 30%">Topik Edukasi</th>
        <th class="rotate" style="width: 8%">
            <div>Hambatan Belajar</div>
        </th>
        <th class="rotate" style="width: 8%">
            <div>Metode Edukasi</div>
        </th>
        <th class="rotate" style="width: 8%">
            <div>Penerima Edukasi</div>
        </th>
        <th class="rotate" style="width: 8%">
            <div>Sarana Edukasi</div>
        </th>
        <th class="rotate" style="width: 8%">
            <div>Evaluasi Edukasi</div>
        </th>
        <th style="width: 10%">Ttd dan Nama<br>Edukator</th>
        <th style="width: 10%">Ttd dan Nama<br>Penerima Edukasi</th>
        <th style="width: 5%" class="rotate">
            <div>KET / CAT</div>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td rowspan="9" class="rotate">
            <div>
                {{ date('d-m-Y H:i', strtotime($dokumen->created_at)) }}
            </div>
        </td>
        <td class="pl-2">1. Menjelaskan tentang kondisi medis, diagnosis pasti, tindakan kedokteran, indikasi tindakan, tujuan
            tindakan, resiko, komplikasi.
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[0] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[1] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[2] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[3] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[4] : "1" : "1" }}
        </td>
        <td rowspan="9" style="text-align: center">
            @if($dokumen->id_verifikator != 0)
                @if(isset($employee))
                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1.5cm; width: 1.5cm;"
                         alt="">
                @else
                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1.5cm; width: 1.5cm;" alt="">
                @endif
                <br>{{$dokumen->nama_verifikator}}
            @endif
        </td>
        <td rowspan="9" style="text-align: center">
            @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                     style="height: 1.5cm; width: 1.5cm;" alt="">
                <br><?php echo $dokumen->general_consent ? $dokumen->general_consent->nama : $dokumen->nama_pasien ?>
            @endif
        </td>
        <td rowspan="9" class="rotate">
            <div>Edukasi Poin 1 s/d 4 dilakukan oleh DPJP</div>
        </td>
    </tr>
    <tr>
        <td class="pl-2">2. Rencana pelayanan dan pengobatan pasien.</td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[0] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[1] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[2] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[3] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[4] : "1" : "1" }}
        </td>
    </tr>
    <tr>
        <td class="pl-2">3. Proses untuk mendapatkan persetujuan</td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[0] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[1] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[2] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[3] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[4] : "1" : "1" }}
        </td>
    </tr>
    <tr>
        <td class="pl-2">4. Hak Pasien dan Keluarga untuk berpartisipasi dalam keputusan pelayanan pasien.</td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[0] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[1] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[2] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[3] : "1" : "1" }}
        </td>
        <td style="text-align: center;">
            {{ $dokumen->catatan_edukasi_pasien ?
            $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
            json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[4] : "1" : "1" }}
        </td>
    </tr>
    <?php
    $additional_topik = json_decode($dokumen->catatan_edukasi_pasien->additional_topik)
    ?>
    @for ($i=0; $i < sizeof($additional_topik); $i++)
        <tr>
            <td class="pl-2">{{ $additional_topik[$i]->topik }}</td>
            <td style="text-align: center">{{ $additional_topik[$i]->hambatan }}</td>
            <td style="text-align: center">{{ $additional_topik[$i]->metode }}</td>
            <td style="text-align: center">{{ $additional_topik[$i]->penerima }}</td>
            <td style="text-align: center">{{ $additional_topik[$i]->sarana }}</td>
            <td style="text-align: center">{{ $additional_topik[$i]->evaluasi }}</td>
        </tr>
    @endfor
    </tbody>
</table>
</body>

</html>
