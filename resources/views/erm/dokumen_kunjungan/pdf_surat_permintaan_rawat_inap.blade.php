<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Permintaan Rawat Inap</title>

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
            -moz-transform: rotate(-90.0deg); /* FF3.5+ */
            -o-transform: rotate(-90.0deg); /* Opera 10.5 */
            -webkit-transform: rotate(-90.0deg); /* Saf3.1+, Chrome */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083); /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
            margin-left: -10em;
            margin-right: -10em;
        }
    </style>
</head>

<body>
<div class="row" style="width:96.7%; margin-left: 18px; margin-top: 0px;">
    <div class="half_column" style="padding: 5px; height:55px;">
        <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 20%;">
        <p style="font-weight: bold; font-size: 12px; padding-left: 60px; text-align: center; margin-top:-75px;">
            RUMAH SAKIT HARAPAN MULIA<br>
            <span style="font-weight: normal;  font-size: 10px; line-height: 1em">
                Jl. Raya Cibarusah No. 5 Kebon Kopi Cibarusah Jaya
                <br>Kabupaten Bekasi Jawa Barat (17340)
                <br>Telp.: (021) 8995 2340 <br>
                Email : info@rumahsakit-harapanmulia.id
            </span>
        </p>
    </div>
    <div class="half_column2">
        <table id="tabel_kop_identitas" style="font-size: 13px;">
            <tr>
                <td style="padding-left: 10px;">No. Rekam Medis</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->nrm }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px; width: 40%;">Unit</td>
                <td style="padding-left:10px; padding-right:10px"> :</td>
                <td>
                    <input @if(old('unit'))
                               {{ old('unit') ==  'igd' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->surat_permintaan_rawat_inap ? ($dokumen->surat_permintaan_rawat_inap->unit == 'igd' ? 'checked' : '') : '' }}
                           @endif
                           type="checkbox" value="igd" name="radio_unit"> IGD
                    <input @if(old('unit'))
                               {{ old('unit') ==  'rawat_inap' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->surat_permintaan_rawat_inap ? ($dokumen->surat_permintaan_rawat_inap->unit == 'rawat_inap' ? 'checked' : '') : '' }}
                           @endif
                           type="checkbox" value="rawat_inap" name="radio_unit" class="ml-4"> Rawat Inap
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row mt-1" style="width: 96.7%; margin-left: 0;" >
    <div class="col-md-12 text-center">
        <h6 style="font-size: 12px"><b><u>SURAT PERMINTAAN RAWAT INAP</u></b></h6>
    </div>
</div>
<div class="row" style="width: 96.7%; margin-left: 0; font-size: 12px">
    <div class="col-md-12">
        <table style="width: 100%; line-height: 1em">
            <tr>
                <td colspan="3">Kepada Yth</td>
            </tr>
            <tr>
                <td style="width: 35%">Unit Pendaftaran</td>
                <td colspan="2">:</td>
            </tr>
            <tr>
                <td colspan="3">Mohon di daftarkan sebagai pasien Rawat Inap :</td>
            </tr>
            <tr>
                <td style="width: 35%">Nama Pasien</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ $layanan->nama_pasien }}
                </td>
            </tr>
            <tr>
                <td style="width: 35%">Tanggal Lahir</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}
                </td>
            </tr>
            <tr>
                <td style="width: 35%">Diagnosa</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : '' }}
                </td>
            </tr>
            <tr>
                <td style="width: 35%">Indikasi Rawat</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->indikasi_rawat : '' }}
                </td>
            </tr>
            <tr>
                <td style="width: 35%">DPJP</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->dpjp : ''}}
                </td>
            </tr>
            <tr>
                <td style="width: 35%">Dokter Pengirim</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->dokter_pengirim : ''}}
                </td>
            </tr>
            <tr>
                <td style="width: 35%">Tanggal Rawat Inap</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{-- {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->tgl_rawat_inap : '' }} --}}
                    {{ $dokumen->surat_permintaan_rawat_inap ? date('d-m-Y', strtotime($dokumen->surat_permintaan_rawat_inap->tgl_rawat_inap)) : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 35%">Kamar :</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->kamar : ''}}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 35%">Petugas Ranap :</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->petugas_ranap : ''}}
                </td>
            </tr>
            <tr>
                <td style="width: 35%">Tanggal Rencana Operasi</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 1px dotted">
                    {{ !empty($dokumen->surat_permintaan_rawat_inap) && !empty($dokumen->surat_permintaan_rawat_inap->tgl_rencana_operasi) ? date('d-m-Y', strtotime($dokumen->surat_permintaan_rawat_inap->tgl_rencana_operasi)) : '' }}
          
                    {{-- {{ $dokumen->surat_permintaan_rawat_inap ? date('d-m-Y', strtotime($dokumen->surat_permintaan_rawat_inap->tgl_rencana_operasi)) : '' }} --}}

                </td>
            </tr>
            <tr>
                <td colspan="3">Atas perhatiannya kami ucapkan terimakasih.</td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row pt-4" style="width:100%; margin-left: 0; margin-top: -10px ">
                        <div class="half_column2 text-center" style="padding-top:20px; font-weight:bold;">
                        </div>
                        <div class="half_column2 text-center" style="font-weight: bold;">
                            <p style="font-size: 12px;">Bekasi, {{ $dokumen->surat_permintaan_rawat_inap ? ($dokumen->surat_permintaan_rawat_inap->tanggal_ttd != null || $dokumen->surat_permintaan_rawat_inap->tanggal_ttd != "" ? date('d-m-Y', strtotime($dokumen->surat_permintaan_rawat_inap->tanggal_ttd)) : '..................................') : '..................................' }}
                            </p>
                            <p style="font-size: 12px; margin-top: -15px;">Dokter Pengirim</p>
                            <div style="margin-top: -15px;">
                                <a onclick="open_modal_dokter()" href="#"
                                style="text-decoration:none; color:#111; text-align: center;">
                                    @if($dokumen->id_verifikator == 0)
                                        <br>
                                        Klik Disini
                                        <br>
                                        <br>
                                        <br>
                                        (.................................................)
                                        <br>Ttd & nama jelas
                                    @else
                                        @if(isset($employee))
                                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                                style="height: 3cm; width: 4cm;" alt="">
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 3cm; width: 4cm;" alt="">
                                        @endif
                                        <br><span style="font-size: 12px;">({{$dokumen->nama_verifikator}}) </span>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>

</html>
