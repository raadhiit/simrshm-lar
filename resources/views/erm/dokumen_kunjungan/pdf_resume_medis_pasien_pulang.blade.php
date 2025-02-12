<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Resume Medis Pasien Pulang</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
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
/* 
        .pagenum:before {
            content: counter(page);
        } */

        .page_break {
            page-break-before: always;
        }

        .prescription-block {
            page-break-inside: avoid;
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

        .table_isian_bordered td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 14px;
        }

        .col-md-1 {
            width: 8%;
            float: left;
        }

        .col-md-2 {
            width: 16%;
            float: left;
        }

        .col-md-3 {
            width: 25%;
            float: left;
        }

        .col-md-4 {
            width: 33%;
            float: left;
        }

        .col-md-5 {
            width: 42%;
            float: left;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        .col-md-7 {
            width: 58%;
            float: left;
        }

        .col-md-8 {
            width: 66%;
            float: left;
        }

        .col-md-9 {
            width: 75%;
            float: left;
        }

        .col-md-10 {
            width: 83%;
            float: left;
        }

        .col-md-11 {
            width: 92%;
            float: left;
        }

        .col-md-12 {
            width: 100%;
            float: left;
        }

    </style>
</head>

<body style="border:1px solid;">
{{-- <footer>
    <div class="row" style="width: 100%; margin-left: 0;">
        <div style="width: 50%; float:left;">
            Halaman <span class="pagenum"></span>
        </div>
        <div style="width: 50%; float:left; text-align:right; color:#777; font-style:italic;">
            MR. 04.06.001.Rev.1
        </div>
    </div>
</footer> --}}
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
            <br>
            <tr>
                <td colspan="3" style="text-align: right">*Tempel Label</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div style="float: left; width: 96%; background: black; margin-left: 14px; margin-top: -1px">
        <p style="color: white; text-align: center; justify-items: center">RESUME MEDIS PASIEN PULANG</p>
    </div>
</div>
<div style="margin-top: -5px">
    <table style="width: 100%;" class="table_isian_bordered">
        <tr>
            <td style="width: 50%">
                <u>No. Rekam Medis</u> : <span>{{ $layanan->nrm }}</span>
                <br>
                Medical Record Number
            </td>
            <td style="width: 50%">
                <u>Tanggal Masuk RS</u> : 
                {{-- <span>{{ date('d-m-Y', strtotime($layanan->tanggal_inap)) }}</span> --}}
                <span>
                    @if(!empty($layanan->tanggal_inap) && $layanan->tanggal_inap !== '0000-00-00 00:00:00')
                        {{ date('d-m-Y', strtotime($layanan->tanggal_inap)) }}
                    @else
                        Tanggal rawat inap belum terisi
                    @endif
                </span> 
                <br>
                Admitted
            </td>
        </tr>
        <tr>
            <td style="width: 50%">
                <u>Nama Pasien</u> : <span>{{ $layanan->nama }}</span>
                <br>
                Patient Name
            </td>
            <td style="width: 50%">
                <u>Tanggal Keluar RS</u> : <span>{{ date('d-m-Y', strtotime($dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->tgl_keluar : '')) }}</span>
                <br>
                Date of discharge
            </td>
        </tr>
        <tr>
            <td style="width: 50%">
                <u>Nama Orang Tua / Suami / Istri</u> : <span>{{ $layanan->namapenanggungjawab }}</span>
                <br>
                Family Name
            </td>
            <td style="width: 50%">
                <u>Jenis Kelamin</u> : <span>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</span>
                <br>
                Sex
            </td>
        </tr>
        <tr>
            <td style="width: 50%">
                <u>Tanggal Lahir</u> : <span>{{ date('d-m-Y', strtotime($layanan->tgl_lahir))  }}</span>
                <br>
                Date of Birthday
            </td>
            <td style="width: 50%">
                <u>Kelas / Kamar</u> : <span>{{ $layanan->last_kelas }} / {{ $layanan->last_nama_ruangan }}</span>
                <br>
                Class / Room
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Indikasi Rawat Inap : 
                <br>
                <span style="border-bottom: 1px dotted">
                    {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->indikasi_rawat_inap : '' }}
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Riwayat Kesehatan (Medical History): 
                <br>
                <span style="border-bottom: 1px dotted">
                    {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->riwayat_kesehatan : '' }}
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Pemeriksaan Fisik (Physical Examination): 
                <br>
                <span style="border-bottom: 1px dotted">
                    {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->pemeriksaan_fisik : '' }}
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Pemeriksaan Penunjang Diagnosis (Significant Ancillary Examination Result) :
                <br>
                <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('pemeriksaan_penunjang_ct_scan',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang)) ? 'checked' : '' }}
                        @endif id="pemeriksaan_penunjang_ct_scan"> CT Scan
                <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('pemeriksaan_penunjang_usg',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                        @endif id="pemeriksaan_penunjang_usg" class="ml-4"> USG
                <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('pemeriksaan_penunjang_ekg',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                        @endif id="pemeriksaan_penunjang_ekg" class="ml-4"> EKG
                <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('pemeriksaan_penunjang_echocardiography',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                        @endif id="pemeriksaan_penunjang_echocardiography" class="ml-4"> Echocardiography
                <input onclick="cek_pemeriksaan_penunjang()" type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                    {{ in_array('pemeriksaan_penunjang_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                    @endif id="pemeriksaan_penunjang_lain_lain" class="ml-4"> Lain - lain
                <input type="text"
                    value="@if(old('ket_pemeriksaan_penunjang')){{ old('ket_pemeriksaan_penunjang') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_pemeriksaan_penunjang : '' }}@endif"
                    id="ket_pemeriksaan_penunjang" style="border: 0; border-bottom: 2px dotted;">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-8" style="border-right: 1px solid">
                        Diagnosis primer (Primary Diagnose):
                        <br>
                        <div id="box_diagnosa" class="ml-2">
                            {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->diagnosa_primer : '' }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        Kode ICD X :
                        <br>
                        <div id="box_diagnosa" class="ml-2">
                            {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->icd_primer : '' }}
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-8" style="border-right: 1px solid">
                        Diagnosis sekunder (Secondary Diagnose) :
                        <br>
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '.$dokumen->resume_medis_pasien_pulang->diagnosa_sekunder : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '.$dokumen->resume_medis_pasien_pulang->diagnosa_sekunder2 : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '.$dokumen->resume_medis_pasien_pulang->diagnosa_sekunder3 : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '.$dokumen->resume_medis_pasien_pulang->diagnosa_sekunder4 : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '.$dokumen->resume_medis_pasien_pulang->diagnosa_sekunder5 : '' !!}
                        <br>
                        <br>
                        Diagnosis Penyerta (Comorbide Diagnose) :
                        <br>
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '. $dokumen->resume_medis_pasien_pulang->diagnosa_penyerta1 : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '. $dokumen->resume_medis_pasien_pulang->diagnosa_penyerta2 : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '. $dokumen->resume_medis_pasien_pulang->diagnosa_penyerta3 : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '. $dokumen->resume_medis_pasien_pulang->diagnosa_penyerta4 : '' !!}
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '. $dokumen->resume_medis_pasien_pulang->diagnosa_penyerta5 : '' !!}
                        <br>
                        <div id="box_diagnosa" class="ml-2">
                            {{-- {{ $layanan->diagnosa ? $layanan->diagnosa->diagnosa_sekunder1 : '' }} --}}
                            {{-- {{ $layanan->diagnosa ? $layanan->diagnosa->diagnosa_sekunder1 : '' }}
                            {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder2 : '' !!}
                            {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder3 : '' !!}
                            {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder4 : '' !!}
                            {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder5 : '' !!} --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        Kode ICD X :
                        <br>
                        {!! $dokumen->resume_medis_pasien_pulang ? '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_sekunder : '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_sekunder2 ?? '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_sekunder3 ?? '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_sekunder4 ?? '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_sekunder5 ?? '' !!}
                        <br>
                        <br>
                        <br>
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_penyerta1 ?? '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_penyerta2 ?? '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_penyerta3 ?? '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_penyerta4 ?? '' !!}
                        {!! '<br> - '.$dokumen->resume_medis_pasien_pulang->icd_penyerta5 ?? '' !!}
                        <br>
                        <div id="box_diagnosa" class="ml-2">
                            {{-- {{ $kode_sekunder1 ? $kode_sekunder1->icd : '' }} --}}
                            {{-- {{ isset($kode_sekunder1) ? $kode_sekunder1->icd : '' }}
                            {!! isset($kode_sekunder2) ? '<br>'.$kode_sekunder2->icd : '' !!}
                            {!! isset($kode_sekunder3) ? '<br>'.$kode_sekunder3->icd : '' !!}
                            {!! isset($kode_sekunder4) ? '<br>'.$kode_sekunder4->icd : '' !!}
                            {!! isset($kode_sekunder5) ? '<br>'.$kode_sekunder5->icd : '' !!} --}}
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-8" style="border-right: 1px solid">
                        Tindakan/Prosedur Bedah (Medical/Surgical Procedures)
                        <br>
                        {{-- {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->tindakan_prosedur : '' }} --}}
                        {!! nl2br(e($dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->tindakan_prosedur : '')) !!}
                        <div>
                            @if (isset($tindakan))
                                @foreach ($tindakan as $key => $td)
                                    {{ ($key+1).". ".$td->nama_tindakan }}
                                    <br>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                        {{-- A. Tindakan Dokter
                        <div>
                            @if ($tindakan_dokter)
                                @foreach ($tindakan_dokter as $key => $td)
                                    {{ ($key+1)." ".$td->nama_tagihan }}
                                    <br>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                        B. Tindakan Perawat
                        <div>
                            @if ($tindakan_perawat)
                                @foreach($tindakan_perawat as $key2 => $tp)
                                    {{ ($key2+1)." ".$tp->nama_tagihan }}
                                @endforeach
                            @else
                                -
                            @endif
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
                        </div> --}}
                    </div>
                    <div class="col-md-4">
                        Kode ICD X :
                        <br>
                        {{-- {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->icd_tindakan : '' }} --}}
                        {!! nl2br(e($dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->icd_tindakan : '')) !!}
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Terapi / Pengobatan (Terapy / Treatment) :
                Selama Dirawat (Durante Treatment) :
                <br>
                {{-- <div id="list_e_resep">
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
                    <table id="resepTable" style="border-collapse: collapse; width:100%;">
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
                                        <td>{{ $ar_det->signa }}</td>
                                        <td style="padding-left: 20px;">
                                            {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                    </table>
                </div>     --}}
                {{-- <div id="list_e_resep">
                    @php
                        $counter = 0;
                    @endphp
                
                    @if (sizeof($all_resep))
                        @foreach ($all_resep as $ar)
                            <div style="page-break-inside: avoid;">
                                <strong>No. Resep: {{ $ar->id }}</strong>
                                @foreach ($ar->detail as $ar_det)
                                    <div style="padding-left: 20px;">
                                        <span>{{ $ar_det->nama_obat }} :</span>
                                        <span>{{ $ar_det->signa }}</span>,
                                        <span>Jml : {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</span>
                                    </div>
                                @endforeach
                            </div>
                
                            @php
                                $counter++;
                            @endphp
                
                            @if ($counter % 3 == 0)
                                <div style="page-break-before: always;"></div>
                            @endif
                        @endforeach
                    @endif
                </div>  --}}

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

            </td>
        </tr>
        <tr>
            <td colspan="2">
                Setelah Dirawat (Post Treatment) :
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-12">
                        <b>Instruksi / Tindak Lanjut (Instruction/Follow Up/Medical Advice) : Rencana Kontrol Tgl :</b>
                        {{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->tgl_kontrol : '' }}
                        {{-- <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kontrol"
                            value="@if(old('tgl_kontrol')){{ old('tgl_kontrol') }}@else 
                            {{ date('d-m-Y', strtotime($dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->tgl_kontrol : '')) }}
                             @endif"> --}}
                    </div>
                </div>
                <span style="width: 150px">Perawatan Dirumah :</span>
                <div class="row" style="padding-left: 15px">
                    <div class="col-md-3">
                        <input @if(old('perawatan_dirumah'))
                            {{ old('perawatan_dirumah') ==  'tidak_ada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'tidak_ada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tidak_ada" name="radio_perawatan_dirumah"> Tidak Ada
                    </div>
                    <div class="col-md-3">
                        <input @if(old('perawatan_dirumah'))
                            {{ old('perawatan_dirumah') ==  'home_visite' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'home_visite' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="home_visite" name="radio_perawatan_dirumah"> Home Visite/Care
                    </div>
                    <div class="col-md-3">
                        <input @if(old('perawatan_dirumah'))
                            {{ old('perawatan_dirumah') ==  'perawatan_lanjutan' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'perawatan_lanjutan' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="perawatan_lanjutan" name="radio_perawatan_dirumah"> Perawatan Lanjutan
                    </div>
                </div>
                <div class="row" style="padding-left: 15px">
                    <span style="width: 150px"></span>
                    <div class="col-md-3">
                        <input @if(old('perawatan_dirumah'))
                            {{ old('perawatan_dirumah') ==  'perawatan_luka' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'perawatan_luka' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="perawatan_luka" name="radio_perawatan_dirumah"> Perawatan Luka
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <input @if(old('perawatan_dirumah'))
                            {{ old('perawatan_dirumah') ==  'pengobatan_lanjutan' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'pengobatan_lanjutan' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="pengobatan_lanjutan" name="radio_perawatan_dirumah"> Pengobatan Lanjutan
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        Rencana pemeriksaan penunjang : 
                        <input @if(old('rencana_pemeriksaan_penunjang'))
                            {{ old('rencana_pemeriksaan_penunjang') ==  'laboratorium' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->rencana_pemeriksaan_penunjang == 'laboratorium' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="laboratorium" name="radio_rencana_pemeriksaan_penunjang"> Laboratorium
                        <input @if(old('rencana_pemeriksaan_penunjang'))
                            {{ old('rencana_pemeriksaan_penunjang') ==  'radiologi' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->rencana_pemeriksaan_penunjang == 'radiologi' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="radiologi" name="radio_rencana_pemeriksaan_penunjang" class="ml-4"> Radiologi
                        <input @if(old('rencana_pemeriksaan_penunjang'))
                            {{ old('rencana_pemeriksaan_penunjang') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->rencana_pemeriksaan_penunjang == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_rencana_pemeriksaan_penunjang" class="ml-4"> Lain-lain
                    </div>
                </div>
                <span style="width: 150px">Kebutuhan Edukasi :</span>
                <div class="row" style="padding-left: 15px">
                    <div class="col-md-12">
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('penyakit',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="penyakit"> Penyakit
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('efek_obat',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="efek_obat" class="ml-4"> Obat dan efek samping obat
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('diet',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="diet" class="ml-4"> Diet
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('istirahat_dirumah',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="istirahat_dirumah" class="ml-4"> Aktifitas dan istirahat dirumah
                    </div>
                </div>
                <div class="row" style="padding-left: 15px">
                    <span style="width: 150px"></span>
                    <div class="col-md-12">
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('hygine',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif id="hygine"> Hygine
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('perawatan_luka',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="perawatan_luka" class="ml-4"> Perawatan luka dirumah
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('perawatan_ibu_bayi',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="perawatan_ibu_bayi" class="ml-4"> Perawatan ibu dan bayi
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('nyeri',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="nyeri" class="ml-4"> Nyeri
                    </div>
                </div>
                <div class="row" style="padding-left: 15px">
                    <span style="width: 150px"></span>
                    <div class="col-md-10">
                        <input onclick="cek_pertolongan_mendesak()" type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('pertolongan_mendesak',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif id="pertolongan_mendesak"> Pertolongan mendesak
                        <input type="text"
                            value="@if(old('ket_pertolongan_mendesak')){{ old('ket_pertolongan_mendesak') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_pertolongan_mendesak : '' }}@endif"
                            id="ket_pertolongan_mendesak" style="border: 0; border-bottom: 2px dotted;">
                        <input type="text" readonly
                        value="@if(old('ket_pertolongan_mendesak')){{ old('ket_pertolongan_mendesak') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_pertolongan_mendesak : '' }}@endif"
                        id="ket_pertolongan_mendesak" style="border: 0; border-bottom: 2px dotted;"
                        @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('pertolongan_mendesak',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? '' : 'readonly' }}
                        @endif>
                    </div>
                </div>
                <div class="row" style="padding-left: 15px">
                    <span style="width: 150px"></span>
                    <div class="col-md-10">
                        <input onclick="cek_kebutuhan_edukasi()"  type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('kebutuhan_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                        @endif  id="kebutuhan_lain_lain"> Lain-lain
                        <input type="text" readonly
                            value="@if(old('ket_kebutuhan_edukasi')){{ old('ket_kebutuhan_edukasi') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_kebutuhan_edukasi : '' }}@endif"
                            id="ket_kebutuhan_edukasi" style="border: 0; border-bottom: 2px dotted;">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Keadaan akhir Perawatan (Discharge Condition) :
                <div class="row">
                    <div class="col-md-4">
                        <input @if(old('keadaan_akhir'))
                            {{ old('keadaan_akhir') ==  'pulang_dengan_indikasi' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'pulang_dengan_indikasi' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="pulang_dengan_indikasi" name="radio_keadaan_akhir"> <u>Pulang atas Indikasi Medis</u>
                        <br><span style="padding-left: 18px">Accord on Medical Indication</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('keadaan_akhir'))
                            {{ old('keadaan_akhir') ==  'pulang_sendiri' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'pulang_sendiri' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="pulang_sendiri" name="radio_keadaan_akhir"> <u>Pulang atas Permintaan Sendiri</u>
                        <br><span style="padding-left: 18px">Accord on Patient Request</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('keadaan_akhir'))
                            {{ old('keadaan_akhir') ==  'kondisi_khusus' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'kondisi_khusus' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kondisi_khusus" name="radio_keadaan_akhir"> <u>Pulang kondisi khusus</u>
                        <br><span style="padding-left: 18px">Accord on Special Condition</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input @if(old('keadaan_akhir'))
                            {{ old('keadaan_akhir') ==  'rujuk' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'rujuk' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="rujuk" name="radio_keadaan_akhir"> <u>Pindah / Rujuk ke RS lain</u>
                        <br><span style="padding-left: 18px">Reffered to Another Hospital</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('keadaan_akhir'))
                            {{ old('keadaan_akhir') ==  'meninggal' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'meninggal' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="meninggal" name="radio_keadaan_akhir"> <u>Meninggal</u>
                        <br><span style="padding-left: 18px">Death</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('keadaan_akhir'))
                            {{ old('keadaan_akhir') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_keadaan_akhir"> <u>Lain-lain</u>
                        <br><span style="padding-left: 18px">Other</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span style="width: 155px">Keadaan saat pulang : </span>
                <div class="row" style="padding-left: 15px">
                    <div class="col-md-2">
                        KU <span style="border-bottom: 1px dotted">{{ $tanda_vital ? $tanda_vital->keadaan_umum : '' }}</span>
                    </div>
                    <div class="col-md-3">
                        Kesadaran <span style="border-bottom: 1px dotted">{{ $tanda_vital ? $tanda_vital->kesadaran : '' }}</span>
                    </div>
                    <div class="col-md-2">
                        TD <span style="border-bottom: 1px dotted">{{ $tanda_vital ? $tanda_vital->tensi : '..../....' }}</span> mmHg
                    </div>
                    <div class="col-md-2">
                        Nadi <span style="border-bottom: 1px dotted">{{ $tanda_vital ? $tanda_vital->nadi : '....' }}</span> x/menit
                    </div>
                </div>
                <div class="row" style="padding-left: 15px">
                    <span style="width: 155px"></span>
                    <div class="col-md-2">
                        Suhu <span style="border-bottom: 1px dotted">{{ $tanda_vital ? $tanda_vital->suhu : '....' }}</span> &deg;C
                    </div>
                    <div class="col-md-3">
                        Pernafasan <span style="border-bottom: 1px dotted">{{ $tanda_vital ? $tanda_vital->rr : '....' }}</span> x/menit
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pemeriksaan Lainnya</label>
                    <br>
                    <span>{{ $dokumen->resume_medis_pasien_pulang->pemeriksaan_lainnya ?? '' }}</span>
                </div>
                <span style="width: 165px">Mobilisasi saat pulang : </span>
                <div class="row" style="padding-left: 15px">
                    <div class="col-md-2">
                        <input @if(old('mobilisasi_pulang'))
                            {{ old('mobilisasi_pulang') ==  'mandiri' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->mobilisasi_pulang == 'mandiri' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="mandiri" name="radio_mobilisasi_pulang"> Mandiri
                    </div>
                    <div class="col-md-2">
                        <input @if(old('mobilisasi_pulang'))
                            {{ old('mobilisasi_pulang') ==  'dibantu_sebagian' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->mobilisasi_pulang == 'dibantu_sebagian' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="dibantu_sebagian" name="radio_mobilisasi_pulang"> Dibantu Sebagian
                    </div>
                    <div class="col-md-3">
                        <input @if(old('mobilisasi_pulang'))
                            {{ old('mobilisasi_pulang') ==  'dibantu_penuh' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->mobilisasi_pulang == 'dibantu_penuh' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="dibantu_penuh" name="radio_mobilisasi_pulang"> Dibantu Penuh
                    </div>
                </div>
                <span style="width: 165px">Alat bantu : </span>
                <div class="row" style="padding-left: 15px">
                    <div class="col-md-2">
                        <input @if(old('alat_bantu'))
                            {{ old('alat_bantu') ==  'tongkat' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'tongkat' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tongkat" name="radio_alat_bantu"> Tongkat
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alat_bantu'))
                            {{ old('alat_bantu') ==  'kursi_roda' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'kursi_roda' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kursi_roda" name="radio_alat_bantu"> Kursi roda
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alat_bantu'))
                            {{ old('alat_bantu') ==  'brandcard' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'brandcard' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="brandcard" name="radio_alat_bantu"> Brandcard
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alat_bantu'))
                            {{ old('alat_bantu') ==  'walker' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'walker' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="walker" name="radio_alat_bantu"> Walker
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alat_bantu'))
                            {{ old('alat_bantu') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_alat_bantu"> Lain-lain
                    </div>
                </div>
                <span style="width: 165px">Alkes yang terpasang : </span>
                <div class="row" style="padding-left: 15px">
                    <div class="col-md-2">
                        <input @if(old('alkes'))
                            {{ old('alkes') ==  'tidak_ada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'tidak_ada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tidak_ada" name="radio_alkes"> Tidak ada
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alkes'))
                            {{ old('alkes') ==  'catheter' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'catheter' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="catheter" name="radio_alkes"> IV Catheter
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alkes'))
                            {{ old('alkes') ==  'dobel_lumen' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'dobel_lumen' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="dobel_lumen" name="radio_alkes"> Dobel Lumen
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alkes'))
                            {{ old('alkes') ==  'ngt' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'ngt' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="ngt" name="radio_alkes"> NGT
                    </div>
                </div>
                <div class="row" style="padding-left: 15px">
                    <span style="width: 165px"></span>
                    <div class="col-md-2">
                        <input @if(old('alat_bantu'))
                            {{ old('alkes') ==  'oksigen' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'oksigen' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="oksigen" name="radio_alkes"> Oksigen
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alkes'))
                            {{ old('alkes') ==  'catheter_urine' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'catheter_urine' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="catheter_urine" name="radio_alkes"> Catheter urine
                    </div>
                    <div class="col-md-2">
                        <input @if(old('alkes'))
                            {{ old('alkes') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_alkes"> Lain-lain
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        Dit : <span style="border-bottom: 1px dotted">{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->dit : '' }}</span>
                    </div>
                </div>
                <span style="width: 190px">Disertakan waktu pulang : </span>
                <div class="row" style="padding-left: 15px">
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('foto_rongent',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                        @endif id="foto_rongent"> Foto Rongent
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('ct_scan',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                        @endif id="ct_scan" class="ml-4"> CT Scan
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('ekg',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                        @endif id="ekg" class="ml-4"> EKG
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('hasil_lab',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                        @endif id="hasil_lab" class="ml-4"> Hasil Lab
                </div>
                <div class="row" style="padding-left: 15px">
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('obat_tidak_terpakai',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                        @endif id="obat_tidak_terpakai"> Obat yang tidak terpakai
                    <input onclick="cek_disertakan_waktu_pulang()" type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('disertakan_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                        @endif id="disertakan_lain_lain" class="ml-4"> Lain - lain
                    <input type="text" readonly
                        value="@if(old('ket_disertakan_waktu_pulang')){{ old('ket_disertakan_waktu_pulang') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_disertakan_waktu_pulang : '' }}@endif"
                        id="ket_disertakan_waktu_pulang" style="border: 0; border-bottom: 2px dotted;"
                        @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('disertakan_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? '' : 'readonly' }}
                        @endif>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Penyakit Berhubungan Dengan (Related Diseases) : 
                <div class="row">
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'kelainan_bawaan' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kelainan_bawaan' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kelainan_bawaan" name="radio_penyakit_berhubungan"> <u>Kelainan Bawaan/kongenital</u>
                        <br><span style="padding-left: 18px">Kongenital Disorders</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'kesuburan' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kesuburan' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kesuburan" name="radio_penyakit_berhubungan"> <u>Kesuburan</u>
                        <br><span style="padding-left: 18px">Fertility</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'gangguan_hormonal' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'gangguan_hormonal' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="gangguan_hormonal" name="radio_penyakit_berhubungan"> <u>Gangguan Hormonal</u>
                        <br><span style="padding-left: 18px">Hormonal Disorders</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'gangguan_mental' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'gangguan_mental' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="gangguan_mental" name="radio_penyakit_berhubungan"> <u>Gangguan Mental</u>
                        <br><span style="padding-left: 18px">Mental Disorders</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'kecelakaan_kerja' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kecelakaan_kerja' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kecelakaan_kerja" name="radio_penyakit_berhubungan"> <u>Kecelakaan Kerja</u>
                        <br><span style="padding-left: 18px">Accident</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'kosmetik' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kosmetik' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kosmetik" name="radio_penyakit_berhubungan"> <u>Kosmetik / Estetika</u>
                        <br><span style="padding-left: 18px">Cosmetics / Estetics</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'kehamilan' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kehamilan' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kehamilan" name="radio_penyakit_berhubungan"> <u>Kehamilan / Keguguran</u>
                        <br><span style="padding-left: 18px">Pregnancy / Abortion</span>
                    </div>
                    <div class="col-md-4">
                        <input @if(old('penyakit_berhubungan'))
                            {{ old('penyakit_berhubungan') ==  'hpht' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'hpht' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="hpht" name="radio_penyakit_berhubungan"> <u>HPHT :</u>
                        <br><span style="padding-left: 18px">Estimated Day of Birth</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-6 text-center">
                        Bekasi, {{ date('d-m-Y', strtotime($dokumen->resume_medis_pasien_pulang->tgl_dokumen)) }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 text-center">
                        @if(is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            (.................................................)
                            <br><u>Tanda Tangan & Nama Jelas Pasien</u>
                            <br>Attending Patient Name And Signature
                        @else
                            @if(!is_null($dokumen->signature_pasien) || $dokumen->signature_pasien != "")
                                <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                        style="height: 4cm; width: 5cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                            @endif
                            <br>({{$dokumen->nama_pasien}})
                        @endif
                    </div>
                    <div class="col-md-6 text-center">
                        @if($dokumen->id_verifikator == 0)
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            (.................................................)
                            <br><u>Tanda Tangan & Nama Jelas Dokter</u>
                            <br>Attending Doctors Name And Signature
                        @else
                            @if(isset($employee))
                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                        style="height: 4cm; width: 5cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                            @endif
                            <br>({{$dokumen->nama_verifikator}})
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>

</html>
