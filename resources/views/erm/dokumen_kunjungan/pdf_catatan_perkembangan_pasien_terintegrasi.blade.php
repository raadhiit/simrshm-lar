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

        thead {display: table-row-group;}

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
                    <td>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">Jenis Kelamin</td>
                    <td class="pl-2 pr-2"> :</td>
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
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
        <div style="float: left; width: 95.8%; margin-left: 15px; background: black; margin-top: -2px; padding-bottom: 5px; border: 1px solid"
            class="text-center">
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
                            <th class="p-3 text-center" colspan="2"
                                style="font-size:12px; border:1px solid; width: 50%">HASIL PEMERIKSAAN, ANALISA,
                                RENCANA PELATALAKSANAAN PASIEN</th>
                            <th class="p-3 text-center" style="font-size:12px; border:1px solid; width: 20%">Instruksi
                                Tenaga Kesehatan Termasuk Pasca
                                Bedah / Prosedur</th>
                            <th class="p-3 text-center" style="font-size:12px; border:1px solid; width: 20%">DPJP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $active_form = $dokumen->catatan_perkembangan_pasien_terintegrasi ? json_decode($dokumen->catatan_perkembangan_pasien_terintegrasi->active_form) : [];
                        @endphp
                        @for ($i = 0; $i < sizeof($active_form); $i++)
                            @if ($active_form[$i] == 'ns')
                                <tr>
                                    <th style="border:1px solid;" colspan="6" class="text-center">NS</th>
                                </tr>
                                <tr>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        {{ $dokumen ? date('d-m-Y H:i', strtotime($dokumen->catatan_perkembangan_pasien_terintegrasi->tanggal_ns)) : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; padding:10px;">
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa : '' }}
                                    </td>
                                    <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                        Subjective : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->subjective_ns : '' }}<br><br>
                                        Objective : <br>
                                        <div class="row" style="width: 100%; margin-left: 0;">
                                            <table class="tabel_objective_dr">
                                                <tr>
                                                    <td style="width: 52%;">Keadaan Umum</td>
                                                    <td class="pl-1 pr-1" style="width: 3%"> : </td>
                                                    <td style="width:45%">{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->keadaan_umum) : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kesadaran</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->kesadaran) : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Berat Badan</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '0' }}
                                                        kg</td>
                                                </tr>
                                                <tr>
                                                    <td>IMT</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan != '0' && $layanan->tanda_vital->tinggi_badan != '' && $layanan->tanda_vital->tinggi_badan != null ? number_format($layanan->tanda_vital->berat_badan / (($layanan->tanda_vital->tinggi_badan / 100) * ($layanan->tanda_vital->tinggi_badan / 100)), 2, '.', ',') : '0' : '0' }}
                                                        kg/m2</td>
                                                </tr>
                                                <tr>
                                                    <td>Tinggi Badan</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '0' }}
                                                        cm</td>
                                                </tr>
                                                <tr>
                                                    <td>Status Gizi</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->status_gizi) : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tensi</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '-' }}
                                                        mmHg</td>
                                                </tr>
                                                <tr>
                                                    <td>Nadi</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '-' }}
                                                        x/mnt</td>
                                                </tr>
                                                <tr>
                                                    <td>Suhu</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '-' }}
                                                        &deg;C</td>
                                                </tr>
                                                <tr>
                                                    <td>RR</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '-' }}
                                                        x/mnt</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <br>
                                        Asesmen : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->asesmen_ns : '' }}<br><br>
                                        Planning : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->planning_ns : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; padding:10px;">
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->instruksi_ns : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        @if ($dokumen->catatan_perkembangan_pasien_terintegrasi->status_ns != 0)
                                            @if (isset($employee_ns))
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee_ns->ttd }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @else
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @endif
                                            <br>({{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_ns }})
                                        @endif
                                    </td>
                                </tr>
                            @elseif ($active_form[$i] == 'dr')
                                <tr>
                                    <th style="border:1px solid;" colspan="6" class="text-center">DR</th>
                                </tr>
                                <tr>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        {{ $dokumen ? date('d-m-Y H:i', strtotime($dokumen->catatan_perkembangan_pasien_terintegrasi->tanggal_dr)) : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; padding:10px;">
                                        <span>{{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa_dr : '' }}</span>
                                    </td>
                                    <td colspan="2" style="padding:10px;">
                                        Subjective :
                                        <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->subjective_dr : '' }}
                                        <br>
                                        <br>
                                        Objective :
                                        <div class="row" style="width: 100%; margin-left: 0;">
                                            <table class="tabel_objective_dr">
                                                <tr>
                                                    <td style="width: 52%;">Keadaan Umum</td>
                                                    <td class="pl-1 pr-1" style="width: 3%"> : </td>
                                                    <td style="width:45%">{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->keadaan_umum) : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kesadaran</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->kesadaran) : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Berat Badan</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '0' }}
                                                        kg</td>
                                                </tr>
                                                <tr>
                                                    <td>Tinggi Badan</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '0' }}
                                                        cm</td>
                                                </tr>
                                                <tr>
                                                    <td>Status Gizi</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->status_gizi) : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tensi</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '-' }}
                                                        mmHg</td>
                                                </tr>
                                                <tr>
                                                    <td>Nadi</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '-' }}
                                                        x/mnt</td>
                                                </tr>
                                                <tr>
                                                    <td>Suhu</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '-' }}
                                                        &deg;C</td>
                                                </tr>
                                                <tr>
                                                    <td>RR</td>
                                                    <td class="pl-1 pr-1"> : </td>
                                                    <td>{{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '-' }}
                                                        x/mnt</td>
                                                </tr>
                                            </table>
                                            <div class="col-md-12 pt-2">
                                                Dokumen Penunjang Eksternal :
                                                <br>
                                                {{ $dokumen->catatan_perkembangan_pasien_terintegrasi->dokumen_penunjang }}
                                            </div>
                                        </div>
                                        <br>
                                        Lain-lain :
                                        <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi->lain_lain_dr }}
                                        <br><br>

                                        Assesmen :
                                        <br>
                                        Diagnosa Utama :
                                        <div style="display: flex; flex-direction: row">
                                            <div id="box_diagnosa">
                                                {{ $layanan->diagnosa ? ($layanan->diagnosa->diagnosa == '' ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : $layanan->diagnosa->diagnosa) : '' }}
                                            </div>
                                        </div>
                                        <br>
                                        Diagnosa Sekunder :
                                        <div style="display: flex; flex-direction: row" id="box_diagnosa_sekunder">
                                            <?php
                                            if ($layanan->diagnosa != null) {
                                                $temp = '';
                                                if ($layanan->diagnosa->diagnosa_sekunder1 != null) {
                                                    $temp .= ($kode_sekunder1 ? $kode_sekunder1->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder1;
                                                }
                                                if ($layanan->diagnosa->diagnosa_sekunder2 != null) {
                                                    $temp .= '<br>' . ($kode_sekunder2 ? $kode_sekunder2->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder2;
                                                }
                                                if ($layanan->diagnosa->diagnosa_sekunder3 != null) {
                                                    $temp .= '<br>' . ($kode_sekunder3 ? $kode_sekunder3->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder3;
                                                }
                                                if ($layanan->diagnosa->diagnosa_sekunder4 != null) {
                                                    $temp .= '<br>' . ($kode_sekunder4 ? $kode_sekunder4->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder4;
                                                }
                                                if ($layanan->diagnosa->diagnosa_sekunder5 != null) {
                                                    $temp .= '<br>' . ($kode_sekunder5 ? $kode_sekunder5->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder5;
                                                }
                                                echo $temp;
                                            }
                                            ?>
                                        </div>
                                        <br>
                                        PLANNING
                                        <br>
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
                                        <br>
                                        C. Terapi
                                        <div>
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
                                                            <tr style="font-size: 5px;">
                                                                <td colspan="4"
                                                                    style="border: 1px solid transparent; font-size:10px;">
                                                                    {{ 'R/' }}</td>
                                                            </tr>
                                                            <tr style="font-size: 5px;">
                                                                <td
                                                                    style="width:20px; border: 1px solid transparent; font-size:10px;">
                                                                </td>
                                                                <td
                                                                    style="border: 1px solid transparent; font-size:10px;">
                                                                    {{ $ar_det->nama_obat }}</td>
                                                                <td
                                                                    style="border: 1px solid transparent; font-size:10px;">
                                                                    {{ $ar_det->signa }}</td>
                                                                <td
                                                                    style="padding-left: 20px; border: 1px solid transparent; font-size:10px;">
                                                                    {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </td>
                                    <td style="width: 20%; vertical-align: text-top; padding:10px;">
                                        <span>{{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->instruksi_dr : '' }}</span>
                                    </td>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        @if ($dokumen->catatan_perkembangan_pasien_terintegrasi->status_dr != 0)
                                            @if (isset($employee_dr))
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee_dr->ttd }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @else
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @endif
                                            <br>({{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_dr }})
                                        @endif
                                    </td>
                                </tr>
                            @elseif ($active_form[$i] == 'fp')
                                <tr>
                                    <th style="border:1px solid;" colspan="6" class="text-center">FP</th>
                                </tr>
                                <tr>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        {{ $dokumen ? date('d-m-Y H:i', strtotime($dokumen->catatan_perkembangan_pasien_terintegrasi->tanggal_fp)) : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; padding:10px;">
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa_fp : '' }}
                                    </td>
                                    <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                        Subjective : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->subjective_fp : '' }}<br><br>
                                        Objective : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->objective_fp : '' }}<br><br>
                                        Asesmen : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->asesmen_fp : '' }}<br><br>
                                        Planning : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->planning_fp : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; padding:10px;">
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->instruksi_fp : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        @if ($dokumen->catatan_perkembangan_pasien_terintegrasi->status_fp != 0)
                                            @if (isset($employee_fp))
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee_fp->ttd }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @else
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @endif
                                            <br>({{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_fp }})
                                        @endif
                                    </td>
                                </tr>
                            @elseif ($active_form[$i] == 'apt')
                                <tr>
                                    <th style="border:1px solid;" colspan="6" class="text-center">APT</th>
                                </tr>
                                <tr>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        {{ $dokumen ? date('d-m-Y H:i', strtotime($dokumen->catatan_perkembangan_pasien_terintegrasi->tanggal_apt)) : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; padding:10px;">
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->ppa_apt : '' }}
                                    </td>
                                    <td colspan="2" style="vertical-align: text-top; padding:10px;">
                                        Subjective : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->subjective_apt : '' }}<br><br>
                                        Objective : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->objective_apt : '' }}<br><br>
                                        Asesmen : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->asesmen_apt : '' }}<br><br>
                                        Planning : <br>
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->planning_apt : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; padding:10px;">
                                        {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->instruksi_apt : '' }}
                                    </td>
                                    <td style="vertical-align: text-top; text-align: center; padding:10px;">
                                        @if ($dokumen->catatan_perkembangan_pasien_terintegrasi->status_apt != 0)
                                            @if (isset($employee_apt))
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee_apt->ttd }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @else
                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                    style="height: 2cm; width: 3cm;" alt="">
                                            @endif
                                            <br>({{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_apt }})
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
