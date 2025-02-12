<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Asesment Medis Awal Rawat Jalan</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
        input[type=checkbox] {
            display: inline;
        }

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
            font-size: 14px;
        }

        .table_isian2 th {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 14px;
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

        .tabel_terapi tr td {
            border: none;
        }
    </style>
</head>

<body style="border:1px solid;">
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
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 12.2px;">
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
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <br>
                <tr>
                    <td colspan="3" style="text-align: right">*Tempel Label</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 96%; background: black; margin-left: 14px; margin-top: -1px; padding-bottom: 5px"
            class="text-center">
            <b style="color: white; text-align: center; justify-items: center">ASESMENT MEDIS AWAL RAWAT JALAN</b>
        </div>
    </div>
    <div style="border:1px solid; margin-top: -5px">
        <table class="table_isian" style="border-collapse:collapse; border: 1px solid; width: 100%;">
            <tr>
                <td colspan="2" class="text-center" style="width: 33%;">
                    Tanggal Kunjungan <br>{{ date('d-m-Y', strtotime($dokumen->created_at)) }}
                </td>
                <td colspan="2" class="text-center" class="text-center" style="width: 33%;">
                    Pukul <br>{{ date('H:i', strtotime($dokumen->created_at)) }}
                </td>
                <td colspan="2" class="text-center" style="width: 33%;">
                    Unit Kerja :
                    {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->last_nama_ruangan : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-center">
                    <b>ANAMNESIS</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <table style="width:100%; border: hidden" id="tabel_subyektif">
                        <tr>
                            <td colspan="6">
                                <div>
                                    <div class="col-print-4">Keluhan Utama</div>
                                    <div>
                                        :
                                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keluhan_utama : '' }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div>
                                    <div class="col-print-4">Riwayat Penyakit Sekarang</div>
                                    <div>
                                        :
                                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->riwayat_penyakit_sekarang : '' }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div>
                                    <div class="col-print-4">Riwayat Penyakit Dahulu</div>
                                    <div>
                                        :
                                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->riwayat_penyakit_dahulu : '' }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div>
                                    <div class="col-print-4">Riwayat Alergi Obat</div>
                                    <div>
                                        :
                                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->riwayat_alergi_obat : '' }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-center">
                    <b>PEMERIKSAAN FISIK</b>
                </td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: text-top; border-right: hidden">Kesadaran</td>
                <td colspan="5">
                    <span> : </span>
                    <input onclick="cek_radio_kesadaran()"
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'compos_mentis' ? 'checked' : '') : '' }}
                        type="checkbox" value="compos_mentis" name="radio_kesadaran"> Compos Mentis
                    <input onclick="cek_radio_kesadaran()"
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'apatis' ? 'checked' : '') : '' }}
                        type="checkbox" value="apatis" name="radio_kesadaran" class="ml-4"> Apatis
                    <input onclick="cek_radio_kesadaran()"
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'somnolen' ? 'checked' : '') : '' }}
                        type="checkbox" value="somnolen" name="radio_kesadaran" class="ml-4"> Somnolen
                    <input onclick="cek_radio_kesadaran()"
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'sopor_koma' ? 'checked' : '') : '' }}
                        type="checkbox" value="sopor_koma" name="radio_kesadaran" class="ml-4"> Sopor
                    koma/Koma, {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_sopor_koma : '' }}
                </td>
            </tr>
            <tr>
                <td style="width: 20%; border-right: hidden">Kesadaran Umum</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td style="border-right: hidden" colspan="2">
                    {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->kesadaran_umum : '' }}
                </td>
                {{-- <td style="width: 20%; border-right: hidden">Berat Badan</td> --}}
                <td colspan="2">
                    Berat Badan : {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->berat_badan : '' }} Kg
                </td>
            </tr>
            <tr>
                <td style="width: 10%">GCS</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <table style="border-collapse: collapse; width:100%">
                        <tr>
                            <td style="width: 33.3%; text-align: center; border:1px solid transparent; vertical-align: top;">
                                E : {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->gcs_e : '' }}
                            </td>
                            <td style="width: 33.3%; text-align: center; border:1px solid transparent; vertical-align: top;">
                                V : {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->gcs_v : '' }}
                            </td>
                            <td style="width: 33.3%; text-align: center; border:1px solid transparent; vertical-align: top;">
                                M : {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->gcs_m : '' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 20%; border-right: hidden; vertical-align:top;">Tanda - Tanda Vital</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden; vertical-align:top;">:</td>
                <td colspan="4" style="vertical-align: text-top">
                    <table style="border-collapse: collapse; width:100%">
                        <tr>
                            <td style="width: 25%; text-align: center; border:1px solid transparent; vertical-align: top;">
                            TD : {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                            </td>
                            <td style="width: 25%; text-align: center; border:1px solid transparent; vertical-align: top;">
                            RR : {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                            </td>
                            <td style="width: 25%; text-align: center; border:1px solid transparent; vertical-align: top;">
                            Nadi : {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                            </td>
                            <td style="width: 25%; text-align: center; border:1px solid transparent; vertical-align: top;">
                            Suhu : {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} <span>°C</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-center">
                    <b>STATUS PSIKOLOGIS, SOSIAL SPIRITUAL</b>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Saudara</td>
                <td colspan="2" style="padding-left: 10px">
                    <input onclick="cek_radio_saudara()"
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'kandung' ? 'checked' : '') : '' }}
                        type="checkbox" value="kandung" name="radio_saudara"> Kandung, Jumlah <span
                        style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_kandung : '' }}</span>
                </td>
                <td colspan="3" style="border-left: hidden">
                    <input onclick="cek_radio_saudara()"
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'tiri' ? 'checked' : '') : '' }}
                        type="checkbox" value="tiri" name="radio_saudara"> Tiri, Jumlah <span
                        style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_tiri : '' }}</span>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Tinggal Bersama</td>
                <td colspan="5" style="vertical-align: text-top">
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-3">
                            <input onclick="cek_radio_tinggal_bersama()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tinggal_bersama == 'ortu' ? 'checked' : '') : '' }}
                                type="checkbox" value="ortu" name="radio_tinggal_bersama"> Orang Tua
                        </div>
                        <div class="col-print-8">
                            <input onclick="cek_radio_tinggal_bersama()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tinggal_bersama == 'tinggal_lainnya' ? 'checked' : '') : '' }}
                                type="checkbox" value="tinggal_lainnya" name="radio_tinggal_bersama"> Lainnya, <span
                                style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_tinggal_lainnya : '' }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Bicara</td>
                <td colspan="5" style="vertical-align: text-top">
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->bicara == 'jelas' ? 'checked' : '') : '' }}
                                type="checkbox" value="jelas" name="radio_bicara"> Jelas
                        </div>
                        <div class="col-print-4">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->bicara == 'tidak_dimengerti' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak_dimengerti" name="radio_bicara"> Tidak Dapat Dimengerti
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Komunikasi</td>
                <td colspan="5" style="vertical-align: text-top">
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->komunikasi == 'verbal' ? 'checked' : '') : '' }}
                                type="checkbox" value="verbal" name="radio_komunikasi"> Verbal
                        </div>
                        <div class="col-print-8">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->komunikasi == 'non_verbal' ? 'checked' : '') : '' }}
                                type="checkbox" value="non_verbal" name="radio_komunikasi"> Non Verbal
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Status Emosional</td>
                <td colspan="5" style="vertical-align: text-top">
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'stabil' ? 'checked' : '') : '' }}
                                type="checkbox" value="stabil" name="radio_emosional"> Stabil
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'tenang' ? 'checked' : '') : '' }}
                                type="checkbox" value="tenang" name="radio_emosional"> Tenang
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'cemas' ? 'checked' : '') : '' }}
                                type="checkbox" value="cemas" name="radio_emosional"> Cemas
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'takut' ? 'checked' : '') : '' }}
                                type="checkbox" value="takut" name="radio_emosional"> Takut
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-5">Riwayat pernah mengalami gangguan jiwa :</div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_gangguan_jiwa()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->gangguan_jiwa == 'tidak' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak" name="radio_gangguan_jiwa"> Tidak
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_gangguan_jiwa()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->gangguan_jiwa == 'ya' ? 'checked' : '') : '' }}
                                type="checkbox" value="ya" name="radio_gangguan_jiwa"> Ya, Tahun : <span
                                style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tahun_gangguan_jiwa : '' }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Riwayat Trauma</td>
                <td colspan="5">
                    <div class="row" style="margin-left: 10px;">
                        <div class="col-print-3">
                            <input onclick="cek_radio_riwayat_trauma()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'tidak_ada' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak_ada" name="radio_trauma"> Tidak Ada
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_riwayat_trauma()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'aniaya_fisik' ? 'checked' : '') : '' }}
                                type="checkbox" value="aniaya_fisik" name="radio_trauma"> Aniaya Fisik
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_riwayat_trauma()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'psikologis' ? 'checked' : '') : '' }}
                                type="checkbox" value="psikologis" name="radio_trauma"> Psikologis
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_riwayat_trauma()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'kdrt' ? 'checked' : '') : '' }}
                                type="checkbox" value="kdrt" name="radio_trauma"> KDRT
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-4">
                            <input onclick="cek_radio_riwayat_trauma()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'pemerkosaan' ? 'checked' : '') : '' }}
                                type="checkbox" value="pemerkosaan" name="radio_trauma"> Aniaya Sex/Pemerkosaan
                        </div>
                        <div class="col-print-8">
                            <input onclick="cek_radio_riwayat_trauma()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'kriminal' ? 'checked' : '') : '' }}
                                type="checkbox" value="kriminal" name="radio_trauma"> Tindakan Kriminal, Sebutkan :
                            <span
                                style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_kriminal : '' }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Alam Perasaan</td>
                <td colspan="5">
                    <div class="row" style="margin-left: 10px;">
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'sedih' ? 'checked' : '') : '' }}
                                type="checkbox" value="sedih" name="radio_perasaan"> Sedih
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'putus_asa' ? 'checked' : '') : '' }}
                                type="checkbox" value="putus_asa" name="radio_perasaan"> Putus Asa
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'ketakutan' ? 'checked' : '') : '' }}
                                type="checkbox" value="ketakutan" name="radio_perasaan"> Ketakutan
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'gembira_berlebih' ? 'checked' : '') : '' }}
                                type="checkbox" value="gembira_berlebih" name="radio_perasaan"> Gembira Berlebih
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%">Interaksi Selama Wawancara</td>
                <td colspan="5">
                    <div class="row" style="margin-left: 10px;">
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'Kooperatif' ? 'checked' : '') : '' }}
                                type="checkbox" value="Kooperatif" name="radio_wawancara"> Kooperatif
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'bermusuhan' ? 'checked' : '') : '' }}
                                type="checkbox" value="bermusuhan" name="radio_wawancara"> Bermusuhan
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'tidak_kooperatif' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak_kooperatif" name="radio_wawancara"> Tidak Kooperatif
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px;">
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'mudah_tersinggung' ? 'checked' : '') : '' }}
                                type="checkbox" value="mudah_tersinggung" name="radio_wawancara"> Mudah Tersinggung
                        </div>
                        <div class="col-print-6">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'kontak_mata' ? 'checked' : '') : '' }}
                                type="checkbox" value="kontak_mata" name="radio_wawancara"> Kontak Mata Berkurang
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-4">Kebutuhan Spiritual Pasien :</div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->spiritual == 'baik' ? 'checked' : '') : '' }}
                                type="checkbox" value="baik" name="radio_spiritual"> Baik
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->spiritual == 'tidak' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak" name="radio_spiritual"> Tidak
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-4">Pasien Membutuhkan Spiritual Agama :</div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_kebutuhan_spiritual()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kebutuhan_spiritual == 'tidak' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak" name="radio_butuh_spiritual"> tidak
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_kebutuhan_spiritual()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kebutuhan_spiritual == 'ya' ? 'checked' : '') : '' }}
                                type="checkbox" value="ya" name="radio_butuh_spiritual"> Ya, Agama : <span
                                style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->agama_spiritual : '' }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Pasien Membutuhkan Bantuan dalam Menjalakan Ibadah dan Menyetujuinya :
                    <span
                        style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->bantuan_ibadah : '         ' }}</span>
                </td>
            </tr>

            <tr>
                <td colspan="6" class="text-center">
                    <b>STATUS EKONOMI</b>
                </td>
            </tr>
            <tr>
                <td style="width: 10%; border-right: hidden">Status Pernikahan</td>
                <td colspan="5">
                    <div class="row" style="margin-left: 10px;">
                        <div class="col-print-3">
                            <span>:</span>
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->status_pernikahan == 'single' ? 'checked' : '') : '' }}
                                type="checkbox" value="single" name="radio_pernikahan"> Single
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->status_pernikahan == 'menikah' ? 'checked' : '') : '' }}
                                type="checkbox" value="menikah" name="radio_pernikahan"> Menikah
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->status_pernikahan == 'janda_duda' ? 'checked' : '') : '' }}
                                type="checkbox" value="janda_duda" name="radio_pernikahan"> Janda / Duda
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%; border-right: hidden">Pekerjaan</td>
                <td colspan="5">
                    <div class="row" style="margin-left: 10px;">
                        <div class="col-print-3">
                            <span>:</span>
                            <input onclick="cek_radio_pekerjaan()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'pns' ? 'checked' : '') : '' }}
                                type="checkbox" value="pns" name="radio_pekerjaan"> PNS
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_pekerjaan()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'swasta' ? 'checked' : '') : '' }}
                                type="checkbox" value="swasta" name="radio_pekerjaan"> Swasta
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_pekerjaan()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'tni_polri' ? 'checked' : '') : '' }}
                                type="checkbox" value="tni_polri" name="radio_pekerjaan"> TNI/POLRI
                        </div>
                        <div class="col-print-3">
                            <input onclick="cek_radio_pekerjaan()"
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'lain_lain' ? 'checked' : '') : '' }}
                                type="checkbox" value="lain_lain" name="radio_pekerjaan"> Lain-lain <span
                                style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->pekerjaan_lain_lain : '' }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-center">
                    <b>ASESMEN NYERI</b>
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td colspan="3" style="border-right: hidden">
                    Nyeri :
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_nyeri"> Tidak
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'ya' ? 'checked' : '') : '' }}
                        type="checkbox" value="ya" name="radio_nyeri"> Ya
                </td>
                <td colspan="3">
                    Sifat :
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sifat_nyeri == 'akut' ? 'checked' : '') : '' }}
                        type="checkbox" value="akut" name="radio_sifat_nyeri"> Akut
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sifat_nyeri == 'kronis' ? 'checked' : '') : '' }}
                        type="checkbox" value="kronis" name="radio_sifat_nyeri"> Kronis
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row" style="width:100%; margin-left: 0px;">
                        <table style="width: 100%;" border="1">
                            <tr>
                                <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                    <img src="{{ asset('images/tidak_sakit.png') }}" alt=""
                                        style="width: 50%;">
                                </td>
                                <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                    <img src="{{ asset('images/sedikit_sakit.png') }}" alt=""
                                        style="width: 50%;">
                                </td>
                                <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                    <img src="{{ asset('images/agak_mengganggu.png') }}" alt=""
                                        style="width: 50%;">
                                </td>
                                <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                    <img src="{{ asset('images/mengganggu_aktivitas.png') }}" alt=""
                                        style="width: 50%;">
                                </td>
                                <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                    <img src="{{ asset('images/sangat_mengganggu.png') }}" alt=""
                                        style="width: 50%;">
                                </td>
                                <td style="width: 16.5%; text-align:center; padding-top:10px; padding-bottom:10px;">
                                    <img src="{{ asset('images/tak_tertahankan.png') }}" alt=""
                                        style="width: 50%;">
                                </td>
                            </tr>
                            <tr class="text-center" style="font-weight: bold; font-size: 12px;">
                                <td style="vertical-align: top; <?php if ($dokumen->asesment_medis_awal->skor_nyeri == 0 || $dokumen->asesment_medis_awal->skor_nyeri == 1) {
                                    echo 'background-color:yellow;';
                                } ?>">0<br>Tidak sakit
                                </td>
                                <td style="vertical-align: top; <?php if ($dokumen->asesment_medis_awal->skor_nyeri == 2 || $dokumen->asesment_medis_awal->skor_nyeri == 3) {
                                    echo 'background-color:yellow;';
                                } ?>">2<br>Sedikit sakit
                                </td>
                                <td style="vertical-align: top; <?php if ($dokumen->asesment_medis_awal->skor_nyeri == 4 || $dokumen->asesment_medis_awal->skor_nyeri == 5) {
                                    echo 'background-color:yellow;';
                                } ?>">4<br>Agak mengganggu
                                </td>
                                <td style="vertical-align: top; <?php if ($dokumen->asesment_medis_awal->skor_nyeri == 6 || $dokumen->asesment_medis_awal->skor_nyeri == 7) {
                                    echo 'background-color:yellow;';
                                } ?>">6<br>Mengganggu aktivitas
                                </td>
                                <td style="vertical-align: top; <?php if ($dokumen->asesment_medis_awal->skor_nyeri == 8 || $dokumen->asesment_medis_awal->skor_nyeri == 9) {
                                    echo 'background-color:yellow;';
                                } ?>">8<br>Sangat mengganggu
                                </td>
                                <td style="vertical-align: top; <?php if ($dokumen->asesment_medis_awal->skor_nyeri == 10) {
                                    echo 'background-color:yellow;';
                                } ?>">10<br>Tak tertahankan
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row" style="margin-left: 5px">
                        <div class="col-print-3">1. Kualitas Nyeri <span style="float: right">: </span> </div>
                        <div class="col-print-3">
                            <input
                                class{{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kualitas_nyeri == 'nyeri_tumpul' ? 'checked' : '') : '' }}
                                type="checkbox" value="nyeri_tumpul" name="radio_kualitas_nyeri"> Nyeri Tumpul
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : '' }}
                                type="checkbox" value="nyeri_tajam" name="radio_kualitas_nyeri"> Nyeri Tajam
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kualitas_nyeri == 'panas' ? 'checked' : '') : '' }}
                                type="checkbox" value="panas" name="radio_kualitas_nyeri"> Panas / Terbakar
                        </div>
                    </div>
                    <div class="row" style="margin-left: 5px">
                        <div class="col-print-3">2. Menjalar <span style="float: right">: </span> </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri_menjalar == 'tidak' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak" name="radio_menjalar"> Tidak
                        </div>
                        <div class="col-print-6">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri_menjalar == 'ya' ? 'checked' : '') : '' }}
                                type="checkbox" value="ya" name="radio_menjalar"> Ya, Ke <span
                                style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_nyeri_menjalar : '' }}</span>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 5px">
                        <div class="col-print-3">3. Skor Nyeri <span style="float: right">: </span> </div>
                        <div class="col-print-9">
                            {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->skor_nyeri : '' }}
                        </div>
                    </div>
                    <div class="row" style="margin-left: 5px">
                        <div class="col-print-3">4. Frekuensi Nyeri <span style="float: right">: </span> </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->frekuensi_nyeri == 'jarang' ? 'checked' : '') : '' }}
                                type="checkbox" value="jarang" name="radio_frekuensi_nyeri"> Jarang
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : '' }}
                                type="checkbox" value="hilang_timbul" name="radio_frekuensi_nyeri"> Hilang Timbul
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->frekuensi_nyeri == 'terus_menerus' ? 'checked' : '') : '' }}
                                type="checkbox" value="terus_menerus" name="radio_frekuensi_nyeri"> Terus Menerus
                        </div>
                    </div>
                    <div class="row" style="margin-left: 5px">
                        <div class="col-print-3">5. Nyeri Mempengaruhi <span style="float: right">: </span> </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'tidur' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidur" name="radio_pengaruh_nyeri"> Tidur
                            <br>
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'emosi' ? 'checked' : '') : '' }}
                                type="checkbox" value="emosi" name="radio_pengaruh_nyeri"> Emosi
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : '' }}
                                type="checkbox" value="aktifitas_fisik" name="radio_pengaruh_nyeri"> Aktifitas Fisik
                            <br>
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'nafsu_makan' ? 'checked' : '') : '' }}
                                type="checkbox" value="nafsu_makan" name="radio_pengaruh_nyeri"> Nafsu Makan
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'konsentrasi' ? 'checked' : '') : '' }}
                                type="checkbox" value="konsentrasi" name="radio_pengaruh_nyeri"> Konsentrasi
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="6" class="text-center">
                    <b>PENILAIAN RESIKO JATUH</b>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    a. Perhatikan cara berjalan pasien saat duduk di kursi. Apakah pasien tampak tidak seimbang
                    (sempoyongan) ?
                </td>
                <td style="padding-left: 10px; vertical-align: text-top">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->cara_berjalan == 'ya' ? 'checked' : '') : '' }}
                        type="checkbox" value="ya" name="radio_cara_berjalan"> Ya
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->cara_berjalan == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_cara_berjalan"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan duduk
                    ?
                </td>
                <td style="padding-left: 10px; vertical-align: text-top">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->memegang_kursi == 'ya' ? 'checked' : '') : '' }}
                        type="checkbox" value="ya" name="radio_memegang_kursi"> Ya
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->memegang_kursi == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_memegang_kursi"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="3" class="text-center">
                    <b>HASIL</b>
                </td>
                <td colspan="3" style="padding-left: 10px">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->hasil_resiko_jatuh == 'tidak_beresiko' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak_beresiko" name="radio_hasil"> Tidak Beresiko (Tidak ditemukan a
                    dan b)
                </td>
            </tr>
            <tr>
                <td colspan="3" style="padding-left: 10px">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->hasil_resiko_jatuh == 'resiko_rendah' ? 'checked' : '') : '' }}
                        type="checkbox" value="resiko_rendah" name="radio_hasil"> Resiko Rendah (Ditemukan a atau b)
                </td>
            </tr>
            <tr>
                <td colspan="3" style="padding-left: 10px">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->hasil_resiko_jatuh == 'resiko_tinggi' ? 'checked' : '') : '' }}
                        type="checkbox" value="resiko_tinggi" name="radio_hasil"> Resiko Tinggi (Ditemukan a dan b)
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td colspan="6">
                    Diberitahukan kepada dokter :
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->beritahu_dokter == 'ya' ? 'checked' : '') : '' }}
                        type="checkbox" value="ya" name="radio_beritahu_dokter"> Ya, Jam
                    <span>{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jam_diberitahukan : '...' }}WIB</span>
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->beritahu_dokter == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_beritahu_dokter"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <i>* (Jika Ya, Pasien diberi Gelang warna kuning)</i>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: text-top; border-right: hidden">
                    Hasil Skrining
                </td>
                <td colspan="5" style="vertical-align: text-top">
                    <span> :
                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->hasil_skrining_resiko_jatuh : '' }}</span>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: text-top; border-right: hidden">
                    Saran
                </td>
                <td colspan="5" style="vertical-align: text-top">
                    <span> :
                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->saran_resiko_jatuh : '' }}</span>
                </td>
            </tr>

            <tr>
                <td colspan="6" class="text-center">
                    <b>SKRINING GIZI</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-4">
                            BB : {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->bb_gizi : '' }} Kg
                        </div>
                        <div class="col-print-4">
                            PB/TB : {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->pb_gizi : '' }}
                            cm
                        </div>
                        <div class="col-print-4">
                            IMT : {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->imt_gizi : '' }},
                            BB/TB (M<sup>3</sup>)
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    1. Apakah Klien tampak kurus ?
                </td>
                <td style="padding-left: 10px">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tampak_kurus == 'ya' ? 'checked' : '') : '' }}
                        type="checkbox" value="ya" name="radio_tampak_kurus"> Ya
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tampak_kurus == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_tampak_kurus"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    2. Apakah terjadi kenaikan atau penurunan berat badan 1 bulan terakhir ?
                </td>
                <td style="padding-left: 10px">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penurunan_bb == 'ya' ? 'checked' : '') : '' }}
                        type="checkbox" value="ya" name="radio_penurunan_bb"> Ya
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penurunan_bb == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_penurunan_bb"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    3. Apakah asupan makanan menurut yang dikarenakan penurunan nafsu makan ?
                </td>
                <td style="padding-left: 10px">
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->asupan_makanan == 'ya' ? 'checked' : '') : '' }}
                        type="checkbox" value="ya" name="radio_asupan_makanan"> Ya
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->asupan_makanan == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_asupan_makanan"> Tidak
                </td>
            </tr>
            <tr>
                <td style="vertical-align: text-top; border-right: hidden">
                    Hasil Skrining
                </td>
                <td colspan="5" style="vertical-align: text-top">
                    <span> :
                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->hasil_skrining_gizi : '' }}</span>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: text-top; border-right: hidden">
                    Saran
                </td>
                <td colspan="5" style="vertical-align: text-top">
                    <span> :
                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->saran_skrining_gizi : '' }}</span>
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
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'normal' ? 'checked' : '') : '' }}
                                type="checkbox" value="normal" name="radio_sensorik_penglihatan"> Normal
                        </div>
                        <div class="col-print-2">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'kabur' ? 'checked' : '') : '' }}
                                type="checkbox" value="kabur" name="radio_sensorik_penglihatan"> Kabur
                        </div>
                        <div class="col-print-2">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'kacamata' ? 'checked' : '') : '' }}
                                type="checkbox" value="kacamata" name="radio_sensorik_penglihatan"> Kacamata
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'lensa_kontak' ? 'checked' : '') : '' }}
                                type="checkbox" value="lensa_kontak" name="radio_sensorik_penglihatan"> Lensa Kontak
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
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penciuman == 'normal' ? 'checked' : '') : '' }}\
                                type="checkbox" value="normal" name="radio_sensorik_penciuman"> Normal
                        </div>
                        <div class="col-print-2">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penciuman == 'tidak' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak" name="radio_sensorik_penciuman"> Tidak
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
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_pendengaran == 'normal' ? 'checked' : '') : '' }}
                                type="checkbox" value="normal" name="radio_sensorik_pendengaran"> Normal
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_pendengaran == 'tuli' ? 'checked' : '') : '' }}
                                type="checkbox" value="tuli" name="radio_sensorik_pendengaran"> Tuli Kanan/Kiri
                        </div>
                        <div class="col-print-6">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_pendengaran == 'alat_bantu' ? 'checked' : '') : '' }}
                                type="checkbox" value="alat_bantu" name="radio_sensorik_pendengaran"> Alat Bantu
                            dengar
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
                            <input
                                @if (old('kognitif_satu')) {{ old('kognitif_satu') == 'normal' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_satu == 'normal' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="normal" name="radio_kognitif_satu"> Normal
                        </div>
                        <div class="col-print-3">
                            <input
                                @if (old('kognitif_satu')) {{ old('kognitif_satu') == 'pelupa' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_satu == 'pelupa' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="pelupa" name="radio_kognitif_satu"> Pelupa
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-3">
                            <input
                                @if (old('kognitif_dua')) {{ old('kognitif_dua') == 'bingung' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_dua == 'bingung' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="bingung" name="radio_kognitif_dua"> Bingung
                        </div>
                        <div class="col-print-6">
                            <input
                                @if (old('kognitif_dua')) {{ old('kognitif_dua') == 'tidak_mengerti' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_dua == 'tidak_mengerti' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="tidak_mengerti" name="radio_kognitif_dua"> Tidak dapat
                            dimengerti
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
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_satu == 'mandiri' ? 'checked' : '') : '' }}
                                type="checkbox" value="mandiri" name="radio_motorik_satu"> Mandiri
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_satu == 'bantuan_minimal' ? 'checked' : '') : '' }}
                                type="checkbox" value="bantuan_minimal" name="radio_motorik_satu"> Bantuan Minimal
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-3"></div>
                        <div class="col-print-8">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_satu == 'bantuan_total' ? 'checked' : '') : '' }}
                                type="checkbox" value="bantuan_total" name="radio_motorik_satu"> Bantuan
                            Ketergantungan Total
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
                            <input
                                @if (old('motorik_dua')) {{ old('motorik_dua') == 'tidak_kesulitan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'tidak_kesulitan' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="tidak_kesulitan" name="radio_motorik_dua"> Tidak ada kesulitan
                        </div>
                        <div class="col-print-3">
                            <input
                                @if (old('motorik_dua')) {{ old('motorik_dua') == 'perlu_bantuan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'perlu_bantuan' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="perlu_bantuan" name="radio_motorik_dua"> Perlu bantuan
                        </div>
                        <div class="col-print-3">
                            <input
                                @if (old('motorik_dua')) {{ old('motorik_dua') == 'sering_jatuh' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'sering_jatuh' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="sering_jatuh" name="radio_motorik_dua"> Sering jatuh
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-print-3"></div>
                        <div class="col-print-3">
                            <input
                                @if (old('motorik_dua')) {{ old('motorik_dua') == 'kelumpuhan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'kelumpuhan' ? 'checked' : '') : '' }} @endif
                                type="checkbox" value="kelumpuhan" name="radio_motorik_dua"> Kelumpuhan
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
                    <input
                        @if (old('saran_satu')) {{ old('saran_satu') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_satu == 'ya' ? 'checked' : '') : '' }} @endif
                        type="checkbox" value="ya" name="radio_saran_satu"> Ya
                    <input
                        @if (old('saran_satu')) {{ old('saran_satu') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_satu == 'tidak' ? 'checked' : '') : '' }} @endif
                        type="checkbox" value="tidak" name="radio_saran_satu"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    2. Pasien Perlu Pemasangan Implan ?
                </td>
                <td style="padding-left: 10px">
                    <input
                        @if (old('saran_dua')) {{ old('saran_dua') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_dua == 'ya' ? 'checked' : '') : '' }} @endif
                        type="checkbox" value="ya" name="radio_saran_dua"> Ya
                    <input
                        @if (old('saran_dua')) {{ old('saran_dua') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_dua == 'tidak' ? 'checked' : '') : '' }} @endif
                        type="checkbox" value="tidak" name="radio_saran_dua"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    3. Apakah Pasien ketika pulang perlu perawatan dirumah ?
                </td>
                <td style="padding-left: 10px">
                    <input
                        @if (old('saran_tiga')) {{ old('saran_tiga') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_tiga == 'ya' ? 'checked' : '') : '' }} @endif
                        type="checkbox" value="ya" name="radio_saran_tiga"> Ya
                    <input
                        @if (old('saran_tiga')) {{ old('saran_tiga') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_tiga == 'tidak' ? 'checked' : '') : '' }} @endif
                        type="checkbox" value="tidak" name="radio_saran_tiga"> Tidak
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    Hasil Skrining
                </td>
                <td colspan="5">
                    <span> :
                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->hasil_discharge_planning : '' }}</span>
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    Saran
                </td>
                <td colspan="5">
                    <span> :
                        {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->saran_discharge_planning : '' }}</span>
                </td>
            </tr>

            <tr>
                <td colspan="6" class="text-center">
                    <b>RIWAYAT PENGGUNAAN OBAT</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <table style="width: 100%" border="1">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Nama Obat</th>
                                <th style="width: 10%">Jumlah</th>
                                <th style="width: 20%">Aturan Pakai</th>
                                <th style="width: 20%">Tgl. Mulai Minum Obat</th>
                                <th style="width: 15%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 5%; text-align:center;">1</td>
                                <td style="width: 30%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->nama_obat_1 }}
                                </td>
                                <td style="width: 10%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->jumlah_obat_1 }}
                                </td>
                                <td style="width: 20%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->aturan_pakai_obat_1 }}
                                </td>
                                <td style="width: 20%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_1 }}
                                </td>
                                <td style="width: 15%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->keterangan_obat_1 }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align:center;">2</td>
                                <td style="width: 30%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->nama_obat_2 }}
                                </td>
                                <td style="width: 10%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->jumlah_obat_2 }}
                                </td>
                                <td style="width: 20%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->aturan_pakai_obat_2 }}
                                </td>
                                <td style="width: 20%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_2 }}
                                </td>
                                <td style="width: 15%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->keterangan_obat_2 }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align:center;">3</td>
                                <td style="width: 30%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->nama_obat_3 }}
                                </td>
                                <td style="width: 10%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->jumlah_obat_3 }}
                                </td>
                                <td style="width: 20%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->aturan_pakai_obat_3 }}
                                </td>
                                <td style="width: 20%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_3 }}
                                </td>
                                <td style="width: 15%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->keterangan_obat_3 }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align:center;">4</td>
                                <td style="width: 30%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->nama_obat_4 }}
                                </td>
                                <td style="width: 10%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->jumlah_obat_4 }}
                                </td>
                                <td style="width: 20%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->aturan_pakai_obat_4 }}
                                </td>
                                <td style="width: 20%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_4 }}
                                </td>
                                <td style="width: 15%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->keterangan_obat_4 }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align:center;">5</td>
                                <td style="width: 30%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->nama_obat_5 }}
                                </td>
                                <td style="width: 10%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->jumlah_obat_5 }}
                                </td>
                                <td style="width: 20%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->aturan_pakai_obat_5 }}
                                </td>
                                <td style="width: 20%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_5 }}
                                </td>
                                <td style="width: 15%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->keterangan_obat_5 }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align:center;">6</td>
                                <td style="width: 30%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->nama_obat_6 }}
                                </td>
                                <td style="width: 10%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->jumlah_obat_6 }}
                                </td>
                                <td style="width: 20%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->aturan_pakai_obat_6 }}
                                </td>
                                <td style="width: 20%; text-align: center">
                                    {{ $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_6 }}
                                </td>
                                <td style="width: 15%; padding-left:5px;">
                                    {{ $dokumen->asesment_medis_awal->keterangan_obat_6 }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-12">
                            Pemeriksaan Penunjang :
                        </div>
                    </div>
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
                                        @endforeach
                                        {{ $pr->no_lab }} - {{ $pesan_radiologi }}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
                <td colspan="3" style="vertical-align: text-top">
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-12">
                            Status Generalis :
                        </div>
                    </div>
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-12">
                            <span>{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->status_generalis : '' }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Diagnosa :
                    <div style="display: flex; flex-direction: row">
                        <div id="box_diagnosa" class="ml-2">
                            {{ $layanan->diagnosa ? ($layanan->diagnosa->diagnosa == '' ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : $layanan->diagnosa->diagnosa) : '' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="vertical-align: text-top">
                    Diagnosa Banding :
                    <div style="display: flex; flex-direction: row">
                        <div id="box_diagnosa_pembanding" class="ml-2">
                            {{ $layanan->diagnosa ? ($layanan->diagnosa->diagnosa_pembanding == '' ? $layanan->diagnosa->kode_icd_diagnosa_pembanding . ' - ' . $layanan->diagnosa->diagnosa_pembanding : $layanan->diagnosa->diagnosa_pembanding) : '' }}
                        </div>
                    </div>
                </td>
                <td colspan="3">
                    Terapi :
                    <div id="list_e_resep">
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
                        <table style="border-collapse: collapse; width:100%;" class="tabel_terapi">
                            @if (sizeof($all_resep))
                                @foreach ($all_resep as $ar)
                                    @foreach ($ar->detail as $ar_det)
                                        <tr>
                                            {{-- @if ($loop->iteration == 1) --}}
                                            <td>{{ 'R/' }}</td>
                                            {{-- @else
                                                <td style="width:20px;"></td>
                                            @endif --}}
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
            <tr>
                <td colspan="4" class="text-center">
                    <b>RENCANA TINDAK LANJUT</b>
                </td>
                <td colspan="2" rowspan="4" class="text-center">
                    <div class="row" style="width: 100%; display: inline-block">
                        Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}
                        <br>
                        Jam: {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                        <br>
                        <a onclick="open_modal_dokter()" href="#"
                            style="text-decoration:none; color:#111; text-align: center">
                            @if ($dokumen->id_verifikator == 0)
                                <br>
                                <br>
                                <br>
                                Dokter
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>Ttd & nama jelas
                            @else
                                @if (isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}"
                                        style="height: 4cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 4cm; width: 5cm;"
                                        alt="">
                                @endif
                                <br>({{ $dokumen->nama_verifikator }})
                            @endif
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-3">
                            Kontrol Diulang
                        </div>
                        <div class="col-print-6">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kontrol_ulang == 'ya' ? 'checked' : '') : '' }}
                                type="checkbox" value="ya" name="radio_kontrol_ulang"> Ya, Tanggal :
                            <span>{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tgl_kontrol_ulang : '' }}</span>
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kontrol_ulang == 'tidak' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak" name="radio_kontrol_ulang"> Tidak
                        </div>
                    </div>
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-3">
                            Rujuk Ke
                        </div>
                        <div class="col-print-6">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'tidak_dirujuk' ? 'checked' : '') : '' }}
                                type="checkbox" value="tidak_dirujuk" name="radio_rujuk_ke"> Tidak Dirujuk
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'rs' ? 'checked' : '') : '' }}
                                type="checkbox" value="rs" name="radio_rujuk_ke"> Rs, <span
                                style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tgl_rujuk : '....' }}</span>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 1px">
                        <div class="col-print-3"></div>
                        <div class="col-print-6">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'puskesmas' ? 'checked' : '') : '' }}
                                type="checkbox" value="puskesmas" name="radio_rujuk_ke"> Puskesmas
                        </div>
                        <div class="col-print-3">
                            <input
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'dokter' ? 'checked' : '') : '' }}
                                type="checkbox" value="dokter" name="radio_rujuk_ke"> Dokter
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-center">
                    <b>EDUKASI PASIEN</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Edukasi awal disampaikan tentang diagnosis, rencana dan tujuan terapi kepada :
                    <br>
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'pasien' ? 'checked' : '') : '' }}
                        type="checkbox" value="pasien" name="radio_penyampaian_edukasi"> Pasien
                    <br>
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'keluarga' ? 'checked' : '') : '' }}
                        type="checkbox" value="keluarga" name="radio_penyampaian_edukasi"> Keluarga
                    <br>
                    <input
                        {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'tidak' ? 'checked' : '') : '' }}
                        type="checkbox" value="tidak" name="radio_penyampaian_edukasi"> tidak dapat memberikan
                    edukasi,
                    karena :
                    <br>
                    <span
                        style="border-bottom: 2px dotted">{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_penyampaian_edukasi : '.....' }}</span>
                    <br>
                </td>
            </tr>
        </table>
        {{-- <div class="page_break"></div> --}}
        {{-- <table class="table_isian" style="border-collapse:collapse; border: 1px solid; width: 100%;">
        <tr>
            <td class="text-center" style="width: 5%"><b>Tanggal/Jam</b></td>
            <td class="text-center" style="width: 5%"><b>Profesi<br>(PPA)</b></td>
            <td class="text-center" colspan="2" style="width: 50%"><b>HASIL PEMERIKSAAN, ANALISA, RENCANA PELATALAKSANAAN PASIEN</b></td>
            <td class="text-center" style="width: 20%"><b>Instruksi Tenaga Kesehatan Termasuk Pasca Bedah / Prosedur</b></td>
            <td class="text-center" style="width: 20%"><b>DPJP</b></td>
        </tr>
        <tr>
            <td style="vertical-align: text-top; text-align: center">
                {{ $dokumen ? date('d-m-Y H:i', strtotime($dokumen->created_at)) : '' }}
            </td>
            <td style="vertical-align: text-top; text-align: center">
                <span>{{ $dokumen->asesment_medis_awal ? strtok($dokumen->asesment_medis_awal->ppa, ".") : ''}}</span>
            </td>
            <td colspan="2">
                SUBYEKTIF
                <br>
                <span>{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->subyektif : '' }}</span>
                <br>
                <br>
                OBYEKTIF
                <br>
                ASESMEN
                <br>
                Diagnosa Utama :
                <div style="display: flex; flex-direction: row">
                    <div id="box_diagnosa" class="ml-2">
                        {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : '' }}
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
                            @endforeach
                            {{ $pr->no_lab }} - {{ $pesan_radiologi }}
                        @endforeach
                    @endif
                </div>
                C. Terapi
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
            <td style="width: 20%; vertical-align: text-top">
                <span>{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->instruksi_kesehatan : '' }}</span>
            </td>
            <td style="vertical-align: text-top; text-align: center">
                @if ($dokumen->asesment_medis_awal)
                    @if (isset($data_ppa))
                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$data_ppa->ttd }}"
                             style="height: 4cm; width: 5cm;" alt="">
                    @else
                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                    @endif
                    <br>({{$dokumen->asesment_medis_awal->ppa}})
                @endif
            </td>
        </tr>
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
    </table> --}}
    </div>
</body>

</html>
