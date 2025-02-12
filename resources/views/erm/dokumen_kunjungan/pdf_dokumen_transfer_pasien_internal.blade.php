<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Transfer Pasien Internal</title>

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
        <table id="tabel_kop_identitas" style="font-size: 13px;">
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
    <div style="float: left; width: 95.8%; margin-left: 15px; margin-top: -2px; padding-bottom: 5px; border: 1px solid"
         class="text-center">
        <b style="text-align: center; justify-items: center">FORMULIR TRANSFER PASIEN INTERNAL</b>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -2px; border: 1px solid">
        <div class="col-md-12">
            <table style="width: 100%; font-size: 13px">
                <tr>
                    <td style="width: 40%; padding-left:10px">1. Tanggal Transfer</td>
                    <td>:</td>
                    <td style="width: 60%; vertical-align: text-top">
                        <div>
                            <div class="col-print-8">
                                {{ $dokumen->dokumen_transfer_pasien_internal ? date('d-m-Y', strtotime($dokumen->dokumen_transfer_pasien_internal->tgl_transfer)) : '' }}
                            </div>
                            <div class="col-print-4">
                                <div style="float: right">
                                    <span>Jam : {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->jam_transfer : '' }} WIB</span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding-left:10px">2. Tanggal Masuk</td>
                    <td>:</td>
                    <td style="width: 65%; vertical-align: text-top">
                        {{ date('d-m-Y', strtotime($layanan->tanggal)) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="vertical-align: text-top; padding-left:10px;">
                        3. Dokter Penanggung Jawab Pelayanan (DPJP) : {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->dpjp : ''}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding-left:10px">4. Riwayat Penyakit Dahulu</td>
                    <td>:</td>
                    <td style="width: 60%; vertical-align: text-top">
                        {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->riwayat_penyakit : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding-left:10px">5. Diagnosa Medis Masuk</td>
                    <td>:</td>
                    <td style="width: 60%; vertical-align: text-top">
                        <div id="box_diagnosa">
                            {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : '' }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding-left:10px">6. Indikasi Rawat</td>
                    <td>:</td>
                    <td style="width: 60%; vertical-align: text-top">
                        {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->indikasi_rawat : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%; padding-left:10px">7. Unit yang dituju</td>
                    <td>:</td>
                    <td style="width: 60%; vertical-align: text-top">
                        {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->unit : ''}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid">
        <li style="list-style-type:none;font-size: 13px; margin-left: 15px">KEADAAN SAAT TRANSFER</li>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid">
        <div class="col-md-12">
            <table style="width: 100%; font-size: 13px;">
                <tr>
                    <td style="width: 20%; vertical-align: text-top; padding-left:10px;">1. Keadaan Umum</td>
                    <td style="vertical-align: text-top">:</td>
                    <td style="width: 85%;">
                        {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->keadaan_umum : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; vertical-align: text-top; padding-left:10px;">2. Kesadaran</td>
                    <td style="vertical-align: text-top">:</td>
                    <td style="width: 85%; vertical-align: text-top">
                            {{ $dokumen->dokumen_transfer_pasien_internal ? ucfirst($dokumen->dokumen_transfer_pasien_internal->kesadaran) : '' }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; vertical-align: text-top; padding-left:10px;">GCS</td>
                    <td style="vertical-align: text-top">:</td>
                    <td style="width: 85%; vertical-align: text-top">
                        <table style="border-collapse: collapse; width:100%;">
                            <tr>
                                <td style="width: 33.3%">
                                E : {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->gcs_e : '' }}
                                </td>
                                <td style="width: 33.3%">
                                M : {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->gcs_m : '' }}
                                </td>
                                <td style="width: 33.3%">
                                V : {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->gcs_v : '' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table style="border-collapse: collapse; width:100%;">
                            <tr>
                                <td style="width: 12%; text-align: center">TD : {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg</td>
                                <td style="width: 12%; text-align: center">RR : {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit</td>
                                <td style="width: 12%; text-align: center">Nadi : {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit</td>
                                <td style="width: 12%; text-align: center">Suhu : {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} °C</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid">
        <li style="list-style-type:none; font-size: 13px; margin-left: 15px">HASIL PEMERIKSAAN DIAGNOSTIK YANG DISERTAKAN (LABORATORIUM, RADIOLOGI, dll)</li>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid; font-size: 13px">
        <div class="col-md-12" style="padding-left: 10px;">
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
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid">
        <li style="list-style-type: none; font-size: 13px; margin-left: 15px">PROSEDUR TINDAKAN YANG SUDAH DILAKUKAN</li>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid; font-size: 13px">
        <div class="col-md-12" style="padding-left: 10px;">
            A. Tindakan Dokter
            <div>
                @if ($tindakan_dokter)
                    @foreach ($tindakan_dokter as $key => $td)
                        &nbsp;&nbsp;&nbsp;{{ ($key+1).". ".$td->nama_tagihan }}
                        <br>
                    @endforeach
                @else
                    -
                @endif
                &nbsp;&nbsp;&nbsp;{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->tindakan_dokter : '' }}
            </div>
            B. Tindakan Perawat
            <div>
                @if ($tindakan_perawat)
                    @foreach($tindakan_perawat as $key2 => $tp)
                    &nbsp;&nbsp;&nbsp;{{ ($key2+1).". ".$tp->nama_tagihan }}
                        <br>
                    @endforeach
                @else
                    -
                @endif
                &nbsp;&nbsp;&nbsp;
                    {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->tindakan_perawat : '' }}
            </div>
            C. Oksigen Manual
            <div>
                @if ($oksigen_manual)
                    @foreach ($oksigen_manual as $key3 => $om)
                        {{ ($key3+1)." ".$om->nama_tagihan." ".$om->keterangan }}
                    @endforeach
                @else
                    -
                @endif
            </div>
            D. Oksigen Central
            <div>
                @if ($oksigen_central)
                    @foreach ($oksigen_central as $key4 => $oc)
                        {{ ($key4+1)." ".$oc->nama_tagihan." ".$oc->keterangan }}
                    @endforeach
                @else
                    -
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid">
        <li style="list-style-type: none; font-size: 13px; margin-left: 15px">TERAPI YANG SUDAH DIBERIKAN</li>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid; font-size: 13px">
        <div class="col-md-12" style="padding-left: 10px;">
            <div id="list_e_resep">
                <div id="box_btn_terapi">
                    @php
                        $charCount = 0;
                        $maxCharsPerPage = 1620; // misalnya, 1000 karakter per halaman
                    @endphp

                    @foreach ($all_resep as $ar)
                        <div style="page-break-inside: avoid;">
                            <strong>No. Resep: {{ $ar->id }}</strong>
                            @php
                                $charCount += strlen($ar->id);
                            @endphp
                            
                            @foreach ($ar->detail as $ar_det)
                                @php
                                    $lineContent = $ar_det->nama_obat . $ar_det->signa . 'Jml : ' . $ar_det->jumlah . ' ' . $ar_det->satuan_pakai;
                                    $charCount += strlen($lineContent);
                                @endphp
                                
                                <div style="padding-left: 20px;">
                                    <span>{{ $ar_det->nama_obat }} :</span>
                                    <span>{{ $ar_det->signa }}</span>,
                                    <span>Jumlah : {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</span>
                                </div>
                                
                                @if ($charCount > $maxCharsPerPage)
                                    @php
                                        $charCount = 0; // reset for new page
                                    @endphp
                                    <div style="page-break-before: always;"></div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
                    {{-- No. Resep Elektronik
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
                                    <td>{{ $ar_det->signa }}</td>
                                    <td>{{ $ar_det->jumlah_pakai_sehari . ' x 1' }}</td>
                                    <td style="padding-left: 20px;">
                                        {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </table> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid">
        <li style="list-style-type: none; font-size: 13px; margin-left: 15px">PERALATAN / FASILITAS PADA SAAT TRANSFER</li>
    </div>
</div>
<div class="row">
    <div class="row" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid; font-size: 13px">
        <div class="col-md-12" style="padding-left: 10px">
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                       @if(old('fasilitas_transfer'))
                           {{ old('fasilitas_transfer') ==  'kursi_roda' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'kursi_roda' ? 'checked' : '') : '' }}
                       @endif
                       type="checkbox" value="kursi_roda" name="radio_fasilitas"> 1. Kursi Roda
            </div>
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                       @if(old('fasilitas_transfer'))
                           {{ old('fasilitas_transfer') ==  'berangkar' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'berangkar' ? 'checked' : '') : '' }}
                       @endif
                       type="checkbox" value="berangkar" name="radio_fasilitas"> 2. Berangkar
            </div>
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                       @if(old('fasilitas_transfer'))
                           {{ old('fasilitas_transfer') ==  'oksigen' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'oksigen' ? 'checked' : '') : '' }}
                       @endif
                       type="checkbox" value="oksigen" name="radio_fasilitas"> 3. Oksigen
            </div>
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                       @if(old('fasilitas_transfer'))
                           {{ old('fasilitas_transfer') ==  'lain_lain' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'lain_lain' ? 'checked' : '') : '' }}
                       @endif
                       type="checkbox" value="lain_lain" name="radio_fasilitas"> 4. Lain - lain
                <span style="border-bottom: 1px dotted">{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->ket_fasilitas_transfer : '' }}</span>
            </div>
        </div>
    </div>
</div>
<div class="page_break"></div>
<div class="row">
    <div class="row pt-2" style="width: 95.8%; margin-left: 15px; margin-top: -1px; border: 1px solid; font-size: 13px">
        <div class="col-print-6 text-center">
            @if(isset($petugas_penyerahan))
                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$petugas_penyerahan->ttd }}"
                     style="height: 4cm; width: 5cm;" alt="">
            @else
                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
            @endif
            <br>({{$dokumen->dokumen_transfer_pasien_internal->petugas_penyerahan}})<br>Petugas yang menyerahkan
        </div>
        <div class="col-print-6 text-center">
            @if(isset($employee))
                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                     style="height: 4cm; width: 5cm;" alt="">
            @else
                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
            @endif
            <br>({{$dokumen->nama_verifikator}})<br>Petugas yang menerima
        </div>
    </div>
</div>
</body>

</html>
