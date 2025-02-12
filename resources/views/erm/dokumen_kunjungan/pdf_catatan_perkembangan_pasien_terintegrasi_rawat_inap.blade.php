<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Catatan Perkembangan Pasien Terintegrasi</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
        .half_column {
            float: left;
            width: 50%;
            border: 1px solid;
        }

        thead {
            display: table-row-group;
        }

        .tabel_objective_dr tr td {
            border: 1px solid transparent;
            vertical-align: text-top;
            font-size: 12px;
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

        .table_isian td {}

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
            -moz-transform: rotate(-90.0deg);
            /* FF3.5+ */
            -o-transform: rotate(-90.0deg);
            /* Opera 10.5 */
            -webkit-transform: rotate(-90.0deg);
            /* Saf3.1+, Chrome */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);
            /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
            /* IE8 */
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

        .col-xs-1,
        .col-sm-1,
        .col-md-1,
        .col-lg-1,
        .col-xs-2,
        .col-sm-2,
        .col-md-2,
        .col-lg-2,
        .col-xs-3,
        .col-sm-3,
        .col-md-3,
        .col-lg-3,
        .col-xs-4,
        .col-sm-4,
        .col-md-4,
        .col-lg-4,
        .col-xs-5,
        .col-sm-5,
        .col-md-5,
        .col-lg-5,
        .col-xs-6,
        .col-sm-6,
        .col-md-6,
        .col-lg-6,
        .col-xs-7,
        .col-sm-7,
        .col-md-7,
        .col-lg-7,
        .col-xs-8,
        .col-sm-8,
        .col-md-8,
        .col-lg-8,
        .col-xs-9,
        .col-sm-9,
        .col-md-9,
        .col-lg-9,
        .col-xs-10,
        .col-sm-10,
        .col-md-10,
        .col-lg-10,
        .col-xs-11,
        .col-sm-11,
        .col-md-11,
        .col-lg-11,
        .col-xs-12,
        .col-sm-12,
        .col-md-12,
        .col-lg-12 {
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
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">Jenis Kelamin</td>
                    <td class="pl-2 pr-2"> :</td>
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">NIK</td>
                    <td class="pl-2 pr-2"> :</td>
                    <td>{{ $pasien->ktp }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 95.8%; margin-left: 15px; background: black; margin-top: -2px; padding-bottom: 5px; border: 1px solid" class="text-center">
            <b style="text-align: center; justify-items: center; color: white">CATATAN PERKEMBANGAN PASIEN
                TERINTEGRASI</b>
        </div>
    </div>
    <div class="row">
        <div class="row" style="width: 96%; margin-left: 15px; margin-top: -2px;">
            <div class="col-md-12">
                <table style="width: 100%;" class="table_isian_bordered">
                    <thead>
                        <tr>
                            <th class="p-3 text-center" style="font-size:12px; border:1px solid; width: 5%">Tanggal/Jam
                            </th>
                            <th class="p-3 text-center" style="font-size:12px; border:1px solid; width: 5%">
                                Profesi<br>(PPA)</th>
                            <th class="p-3 text-center" colspan="2" style="font-size:12px; border:1px solid; width: 50%">HASIL PEMERIKSAAN, ANALISA,
                                RENCANA PELATALAKSANAAN PASIEN</th>
                            <th class="p-3 text-center" style="font-size:12px; border:1px solid; width: 20%">Instruksi
                                Tenaga Kesehatan Termasuk Pasca
                                Bedah / Prosedur</th>
                            <th class="p-3 text-center" style="font-size:12px; border:1px solid; width: 20%">DPJP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < sizeof($cppt); $i++) @if ($cppt[$i]->jenis_ppa == 'dr')
                            <tr>
                                <th style="border:1px solid;" colspan="6" class="text-center">DR Ruangan</th>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    {{ date('d-m-Y H:i', strtotime($cppt[$i]->tanggal))}}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->nama_ppa }}
                                </td>
                                <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                    Subjective : <br>
                                    {{ $cppt[$i]->subjective }}<br><br>
                                    Objective : <br>
                                    {{ $cppt[$i]->objective_lain }}
                                    <br><br>
                                    Asesmen : <br>
                                    <?php if ($cppt[$i]->diagnosa) { ?>
                                        <div style="display:flex; flex-direction:row;">
                                            {{ $cppt[$i]->diagnosa->kode_icd.' - '.$cppt[$i]->diagnosa->nama_icd }}<br>
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder1 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder1.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder1 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder2 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder2.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder2 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder3 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder3.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder3 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder4 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder4.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder4 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder5 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder5.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder5 }}<br>
                                            @endif
                                        </div>
                                    <?php } ?>
                                    <br><br>
                                    Planning : <br>
                                    Laboratorium <br>
                                    <?php if ($cppt[$i]->lab) { ?>
                                        <?php
                                        $result = [];
                                        $yang_dipesan = json_decode($cppt[$i]->lab->periksa, true);
                                        for ($j = 0; $j < sizeof($pemeriksaan); $j++) {
                                            if (isset($yang_dipesan[$pemeriksaan[$j]->slug])) {
                                                if ($yang_dipesan[$pemeriksaan[$j]->slug] == 1) {
                                                    array_push($result, $pemeriksaan[$j]->nama);
                                                }
                                            }
                                        }
                                        ?>
                                        {{ $cppt[$i]->lab->no_lab.' - '.join(', ', $result) }}<br>
                                    <?php } ?>
                                    <br>
                                    Radiologi <br>
                                    <?php if ($cppt[$i]->rad) { ?>
                                        <?php
                                        $result = [];
                                        $yang_dipesan = json_decode($cppt[$i]->rad->periksa, true);
                                        for ($j = 0; $j < sizeof($pemeriksaan_radiologi); $j++) {
                                            if (isset($yang_dipesan['rad_' . $pemeriksaan_radiologi[$j]->id])) {
                                                if ($yang_dipesan['rad_' . $pemeriksaan_radiologi[$j]->id] == 1) {
                                                    array_push($result, $pemeriksaan_radiologi[$j]->nama);
                                                }
                                            }
                                        }
                                        ?>
                                        {{ $cppt[$i]->rad->no_lab.' - '.join(', ', $result) }}<br>
                                    <?php } ?>
                                    <br>
                                    Terapi <br>
                                    <?php if ($cppt[$i]->resep) { ?>
                                        No Resep Elektronik {{ $cppt[$i]->resep->id }}
                                        <table>
                                            @foreach($cppt[$i]->resep->detail as $obat)
                                            <tr>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:10px;" colspan="4">R/</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;"></td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->nama_obat }}</td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->signa }}</td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->jumlah.' '.$obat->satuan }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    <?php } ?>
                                    <br>
                                    Tindak Lanjut<br>
                                    {{ $cppt[$i]->tindak_lanjut }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->instruksi }}
                                </td>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    @if ($cppt[$i]->status == 1)
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$cppt[$i]->ttd }}" style="height: 2cm; width: 4cm;" alt="">
                                    <br>({{ $cppt[$i]->nama_verifikator }})
                                    @endif
                                    <br><span style="font-size: 12px; text-align:center;"><b>Catatan DPJP :</b></span>
                                    <br>
                                    <p style="text-align: left;">{{ $cppt[$i]->catatan_dpjp }}</p>
                                    @if ($cppt[$i]->id_dpjp != 0)
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $cppt[$i]->ttd_dpjp }}" class="mt-2" style="height: 2cm; width: 4cm;" alt="">
                                    <br>
                                    {{ $cppt[$i]->nama_dpjp }}
                                    @endif
                                </td>
                            </tr>
                            @elseif($cppt[$i]->jenis_ppa == 'dpjp_pendamping')
                            <tr>
                                <th style="border:1px solid;" colspan="6" class="text-center">DPJP Pendamping</th>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    {{ date('d-m-Y H:i', strtotime($cppt[$i]->tanggal))}}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->nama_ppa }}
                                </td>
                                <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                    Subjective : <br>
                                    {{ $cppt[$i]->subjective }}<br><br>
                                    Objective : <br>
                                    {{ $cppt[$i]->objective_lain }}
                                    <br><br>
                                    Asesmen : <br>
                                    <?php if ($cppt[$i]->diagnosa) { ?>
                                        <div style="display:flex; flex-direction:row;">
                                            {{ $cppt[$i]->diagnosa->kode_icd.' - '.$cppt[$i]->diagnosa->nama_icd }}<br>
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder1 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder1.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder1 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder2 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder2.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder2 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder3 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder3.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder3 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder4 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder4.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder4 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder5 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder5.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder5 }}<br>
                                            @endif
                                        </div>
                                    <?php } ?>
                                    <br><br>
                                    Planning : <br>
                                    Laboratorium <br>
                                    <?php if ($cppt[$i]->lab) { ?>
                                        <?php
                                        $result = [];
                                        $yang_dipesan = json_decode($cppt[$i]->lab->periksa, true);
                                        for ($j = 0; $j < sizeof($pemeriksaan); $j++) {
                                            if (isset($yang_dipesan[$pemeriksaan[$j]->slug])) {
                                                if ($yang_dipesan[$pemeriksaan[$j]->slug] == 1) {
                                                    array_push($result, $pemeriksaan[$j]->nama);
                                                }
                                            }
                                        }
                                        ?>
                                        {{ $cppt[$i]->lab->no_lab.' - '.join(', ', $result) }}<br>
                                    <?php } ?>
                                    <br>
                                    Radiologi <br>
                                    <?php if ($cppt[$i]->rad) { ?>
                                        <?php
                                        $result = [];
                                        $yang_dipesan = json_decode($cppt[$i]->rad->periksa, true);
                                        for ($j = 0; $j < sizeof($pemeriksaan_radiologi); $j++) {
                                            if (isset($yang_dipesan['rad_' . $pemeriksaan_radiologi[$j]->id])) {
                                                if ($yang_dipesan['rad_' . $pemeriksaan_radiologi[$j]->id] == 1) {
                                                    array_push($result, $pemeriksaan_radiologi[$j]->nama);
                                                }
                                            }
                                        }
                                        ?>
                                        {{ $cppt[$i]->rad->no_lab.' - '.join(', ', $result) }}<br>
                                    <?php } ?>
                                    <br>
                                    Terapi <br>
                                    <?php if ($cppt[$i]->resep) { ?>
                                        No Resep Elektronik {{ $cppt[$i]->resep->id }}
                                        <table>
                                            @foreach($cppt[$i]->resep->detail as $obat)
                                            <tr>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:10px;" colspan="4">R/</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;"></td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->nama_obat }}</td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->signa }}</td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->jumlah.' '.$obat->satuan }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    <?php } ?>
                                    <br>
                                    Tindak Lanjut<br>
                                    {{ $cppt[$i]->tindak_lanjut }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->instruksi }}
                                </td>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    @if ($cppt[$i]->status == 1)
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$cppt[$i]->ttd }}" style="height: 2cm; width: 4cm;" alt="">
                                    <br>({{ $cppt[$i]->nama_verifikator }})
                                    @endif
                                    <br><span style="font-size: 12px; text-align:center;"><b>Catatan DPJP :</b></span>
                                    <br>
                                    <p style="text-align: left;">{{ $cppt[$i]->catatan_dpjp }}</p>
                                    @if ($cppt[$i]->id_dpjp != 0)
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $cppt[$i]->ttd_dpjp }}" class="mt-2" style="height: 2cm; width: 4cm;" alt="">
                                    <br>
                                    {{ $cppt[$i]->nama_dpjp }}
                                    @endif
                                </td>
                            </tr>
                            @elseif($cppt[$i]->jenis_ppa == 'dpjp_utama')
                            <tr>
                                <th style="border:1px solid;" colspan="6" class="text-center">DPJP Utama</th>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    {{ date('d-m-Y H:i', strtotime($cppt[$i]->tanggal))}}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->nama_ppa }}
                                </td>
                                <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                    Subjective : <br>
                                    {{ $cppt[$i]->subjective }}<br><br>
                                    Objective : <br>
                                    {{ $cppt[$i]->objective_lain }}
                                    <br><br>
                                    Asesmen : <br>
                                    <?php if ($cppt[$i]->diagnosa) { ?>
                                        <div style="display:flex; flex-direction:row;">
                                            {{ $cppt[$i]->diagnosa->kode_icd.' - '.$cppt[$i]->diagnosa->nama_icd }}<br>
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder1 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder1.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder1 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder2 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder2.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder2 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder3 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder3.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder3 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder4 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder4.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder4 }}<br>
                                            @endif
                                            @if($cppt[$i]->diagnosa->diagnosa_sekunder5 != '')
                                            {{ $cppt[$i]->diagnosa->kode_icd_diagnosa_sekunder5.' - '.$cppt[$i]->diagnosa->diagnosa_sekunder5 }}<br>
                                            @endif
                                        </div>
                                    <?php } ?>
                                    <br><br>
                                    Planning : <br>
                                    Laboratorium <br>
                                    <?php if ($cppt[$i]->lab) { ?>
                                        <?php
                                        $result = [];
                                        $yang_dipesan = json_decode($cppt[$i]->lab->periksa, true);
                                        for ($j = 0; $j < sizeof($pemeriksaan); $j++) {
                                            if (isset($yang_dipesan[$pemeriksaan[$j]->slug])) {
                                                if ($yang_dipesan[$pemeriksaan[$j]->slug] == 1) {
                                                    array_push($result, $pemeriksaan[$j]->nama);
                                                }
                                            }
                                        }
                                        ?>
                                        {{ $cppt[$i]->lab->no_lab.' - '.join(', ', $result) }}<br>
                                    <?php } ?>
                                    <br>
                                    Radiologi <br>
                                    <?php if ($cppt[$i]->rad) { ?>
                                        <?php
                                        $result = [];
                                        $yang_dipesan = json_decode($cppt[$i]->rad->periksa, true);
                                        for ($j = 0; $j < sizeof($pemeriksaan_radiologi); $j++) {
                                            if (isset($yang_dipesan['rad_' . $pemeriksaan_radiologi[$j]->id])) {
                                                if ($yang_dipesan['rad_' . $pemeriksaan_radiologi[$j]->id] == 1) {
                                                    array_push($result, $pemeriksaan_radiologi[$j]->nama);
                                                }
                                            }
                                        }
                                        ?>
                                        {{ $cppt[$i]->rad->no_lab.' - '.join(', ', $result) }}<br>
                                    <?php } ?>
                                    <br>
                                    Terapi <br>
                                    <?php if ($cppt[$i]->resep) { ?>
                                        No Resep Elektronik {{ $cppt[$i]->resep->id }}
                                        <table>
                                            @foreach($cppt[$i]->resep->detail as $obat)
                                            <tr>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:10px;" colspan="4">R/</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;"></td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->nama_obat }}</td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->signa }}</td>
                                                <td style="border: 1px solid transparent !important; border-color:#fff; font-size:9px;">{{ $obat->jumlah.' '.$obat->satuan }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    <?php } ?>
                                    <br>
                                    Tindak Lanjut<br>
                                    {{ $cppt[$i]->tindak_lanjut }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->instruksi }}
                                </td>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    @if ($cppt[$i]->status == 1)
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$cppt[$i]->ttd }}" style="height: 2cm; width: 4cm;" alt="">
                                    <br>({{ $cppt[$i]->nama_verifikator }})
                                    @endif
                                    <br><span style="font-size: 12px; text-align:center;"><b>Catatan DPJP :</b></span>
                                    <br>
                                    <p style="text-align: left;">{{ $cppt[$i]->catatan_dpjp }}</p>
                                    @if ($cppt[$i]->id_dpjp != 0)
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $cppt[$i]->ttd_dpjp }}" class="mt-2" style="height: 2cm; width: 4cm;" alt="">
                                    <br>
                                    {{ $cppt[$i]->nama_dpjp }}
                                    @endif
                                </td>
                            </tr>
                            @elseif($cppt[$i]->jenis_ppa == 'ns')
                            <tr>
                                <th style="border:1px solid;" colspan="6" class="text-center">NS</th>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    {{ date('d-m-Y H:i', strtotime($cppt[$i]->tanggal)) }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->nama_ppa }}
                                </td>
                                <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                    Subjective : <br>
                                    {{ $cppt[$i]->subjective }}<br><br>
                                    Objective : <br>
                                    <div class="row" style="width: 100%; margin-left: 0;">
                                        <table class="tabel_objective_dr">
                                            <tr>
                                                <td style="width: 52%;">Keadaan Umum</td>
                                                <td class="pl-1 pr-1" style="width: 3%"> : </td>
                                                <td style="width:45%">{{ $cppt[$i]->ttv ? ucfirst($cppt[$i]->ttv->keadaan_umum) : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kesadaran</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? ucfirst($cppt[$i]->ttv->kesadaran) : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Berat Badan</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? $cppt[$i]->ttv->berat_badan : '0' }}
                                                    kg</td>
                                            </tr>
                                            <tr>
                                                <td>IMT</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? $cppt[$i]->ttv->tinggi_badan != '0' && $cppt[$i]->ttv->tinggi_badan != '' && $cppt[$i]->ttv->tinggi_badan != null ? number_format($cppt[$i]->ttv->berat_badan / (($cppt[$i]->ttv->tinggi_badan / 100) * ($cppt[$i]->ttv->tinggi_badan / 100)), 2, '.', ',') : '0' : '0' }}
                                                    kg/m2</td>
                                            </tr>
                                            <tr>
                                                <td>Tinggi Badan</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? $cppt[$i]->ttv->tinggi_badan : '0' }}
                                                    cm</td>
                                            </tr>
                                            <tr>
                                                <td>Status Gizi</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? ucfirst($cppt[$i]->ttv->status_gizi) : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tensi</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? $cppt[$i]->ttv->tensi : '-' }}
                                                    mmHg</td>
                                            </tr>
                                            <tr>
                                                <td>Nadi</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? $cppt[$i]->ttv->nadi : '-' }}
                                                    x/mnt</td>
                                            </tr>
                                            <tr>
                                                <td>Suhu</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? $cppt[$i]->ttv->suhu : '-' }}
                                                    &deg;C</td>
                                            </tr>
                                            <tr>
                                                <td>RR</td>
                                                <td class="pl-1 pr-1"> : </td>
                                                <td>{{ $cppt[$i]->ttv ? $cppt[$i]->ttv->rr : '-' }}
                                                    x/mnt</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    Asesmen : <br>
                                    {{ $cppt[$i]->asesmen }}<br><br>
                                    Planning : <br>
                                    {{ $cppt[$i]->planning }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->instruksi }}
                                </td>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    @if ($cppt[$i]->status != 0)
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $cppt[$i]->ttd }}" style="height: 2cm; width: 3cm;" alt="">
                                    <br>({{ $cppt[$i]->nama_verifikator }})
                                    @endif
                                </td>
                            </tr>
                            @elseif($cppt[$i]->jenis_ppa == 'apt')
                            <tr>
                                <th style="border:1px solid;" colspan="6" class="text-center">APT</th>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    {{ date('d-m-Y H:i', strtotime($cppt[$i]->tanggal)) }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->nama_ppa }}
                                </td>
                                <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                    Subjective : <br>
                                    {{ $cppt[$i]->subjective }}<br><br>
                                    Objective : <br>
                                    {{ $cppt[$i]->objective_lain }}<br><br>
                                    Asesmen : <br>
                                    {{ $cppt[$i]->asesmen }}<br><br>
                                    Planning : <br>
                                    {{ $cppt[$i]->planning }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->instruksi }}
                                </td>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    @if ($cppt[$i]->status != 0)
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $cppt[$i]->ttd }}" style="height: 2cm; width: 3cm;" alt="">
                                    <br>({{ $cppt[$i]->nama_verifikator }})
                                    @endif
                                </td>
                            </tr>
                            @elseif($cppt[$i]->jenis_ppa == 'fp')
                            <tr>
                                <th style="border:1px solid;" colspan="6" class="text-center">FP</th>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    {{ date('d-m-Y H:i', strtotime($cppt[$i]->tanggal)) }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->nama_ppa }}
                                </td>
                                <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                    Subjective : <br>
                                    {{ $cppt[$i]->subjective }}<br><br>
                                    Objective : <br>
                                    {{ $cppt[$i]->objective_lain }}<br><br>
                                    Asesmen : <br>
                                    {{ $cppt[$i]->asesmen }}<br><br>
                                    Planning : <br>
                                    {{ $cppt[$i]->planning }}
                                </td>
                                <td style="vertical-align: text-top; padding:10px;">
                                    {{ $cppt[$i]->instruksi }}
                                </td>
                                <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                    @if ($cppt[$i]->status != 0)
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $cppt[$i]->ttd }}" style="height: 2cm; width: 3cm;" alt="">
                                    <br>({{ $cppt[$i]->nama_verifikator }})
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="row">
                                    <div class="col-print-3" style="text-align: right">PPA:</div>
                                    <div class="col-print-2">Dr: Dokter</div>
                                    <div class="col-print-2">Ns: Perawat</div>
                                    <div class="col-print-2">Fp: Fisioterapist</div>
                                    <div class="col-print-3">Apt: Apoteker</div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>