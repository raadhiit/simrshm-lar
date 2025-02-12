<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            font-family: sans-serif;
        }

        .pagebreak {
            page-break-before: always;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .asesmen tr th {
            border: 1px solid;
            padding: 5px;
        }

        .asesmen tr td {
            border-left: 1px solid;
            border-right: 1px solid;
            padding: 5px;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="row" style="width: 100%;">
        <div style="float: left; width: 75%; text-align: left; height: 100px;">
            <!-- <img src="{{ asset('filelogo/rolasmedika.png') }}" alt="" style="width:20%; margin-left: -30px;"> -->
            <img src="{{ asset('filelogo/kotakihc.png') }}" alt="" style="width:25%; margin-top: -35px;">
        </div>
        <div style="float: left; width: 25%; height: 100px;">
            <p style="color: #111; font-weight: bold; font-size: 14px; padding-top: 20px;">
                PT. ROLAS NUSANTARA MEDIKA
                <br><span style="text-transform: uppercase; font-weight: normal;">{{$klinik->nama}}</span>
                <br><span style="font-size: 12px; font-weight: normal; text-transform: uppercase;">{{$klinik->alamat}}<br>{{$klinik->telpon}}</span>
            </p>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: left; border:1px solid">
        </div>
    </div>
    <div class="row" style="padding-top: 5px;">
        <div style="float: left; width: 50%; border:1px solid;">
            <table style="border-collapse: collapse; font-size: 14px; margin:10px" class="biodata_3">
                <tr>
                    <td>Nama</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{$pasien->nama}}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>@if($pasien->kelamin == 0){{'Laki-Laki'}}@else{{'Perempuan'}}@endif</td>
                </tr>
                <tr>
                    <td>Telp / No. HP</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{$pasien->telpon}}</td>
                </tr>
            </table>
        </div>
        <div style="float: left; width: 50%; border:1px solid">
            <table style="border-collapse: collapse; font-size: 14px; margin:10px" class="biodata_3">
                <tr>
                    <td>Alamat</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{$pasien->alamat.' - '.$pasien->kabupaten}}</td>
                </tr>
                <tr>
                    <td>Status Kepesertaan</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td style="text-transform: uppercase;">@if($pasien->carabayar == 'bpjs' || $pasien->carabayar == 'asuransi')
                        {{$pasien->asuransi }}
                        @elseif($pasien->carabayar == 'perusahaan')
                        {{$pasien->carabayar.' - '.$pasien->nama_perusahaan }}
                        @else
                        {{'UMUM'}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>No. JKN</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{$pasien->nobpjs}}</td>
                </tr>
                <tr>
                    <td>No. Rekam Medis</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>
                        @if(strlen($pasien->nrm) == 1)
                        {{ '00000'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 2)
                        {{ '0000'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 3)
                        {{ '000'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 4)
                        {{ '00'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 5)
                        {{ '0'.$pasien->nrm}}
                        @else
                        {{ $pasien->nrm}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <p style="font-weight: bold; font-family: serif; font-size: 20px;">ASESMEN MEDIS RAWAT JALAN</p>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <table style="border-collapse: collapse; width:100%;" class="asesmen">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keluhan Utama</th>
                        <th style="width: 200px;">Pemeriksaan Fisik</th>
                        <th>Pemeriksaan penunjang</th>
                        <th>Diagnosa / Kode ICD</th>
                        <th>Terapi</th>
                        <th>Dokter Jaga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [];
                    foreach ($asesmen as $as) {
                        if (strpos($as->jenislayanan, 'poli_umum') !== false) {
                            array_push($data, $as);
                        }
                    }
                    ?>
                    @if(sizeof($data) > 0)
                    @php
                    $i = 0;
                    $len = count($data);
                    @endphp
                    @foreach($data as $as)
                    <tr>
                        <td style="<?php if ($i == $len - 1) {
                                        echo 'border-bottom:1px solid';
                                    } ?>">{{ date('d-m-Y', strtotime($as->tanggal)) }}</td>
                        <td style="<?php if ($i == $len - 1) {
                                        echo 'border-bottom:1px solid';
                                    } ?>">
                            @if(isset($as->diagnosa))
                            {{ $as->diagnosa->keluhan }}
                            @endif
                        </td>
                        <td style="<?php if ($i == $len - 1) {
                                        echo 'border-bottom:1px solid';
                                    } ?>">
                            @if(isset($as->diagnosa)){{'Tensi : '.$as->diagnosa->sistole.' / '.$as->diagnosa->diastole.' mm/Hg'}}<br>@endif
                            @if(isset($as->diagnosa)){{'Nadi : '.$as->diagnosa->nadi.' x/menit'}}<br>@endif
                            @if(isset($as->diagnosa)){{'Respirasi : '.$as->diagnosa->rr.' x/menit'}}<br>@endif
                            @if(isset($as->diagnosa)){{'Suhu : '.$as->diagnosa->suhu.' °C'}}@endif
                        </td>
                        <td style="<?php if ($i == $len - 1) {
                                        echo 'border-bottom:1px solid';
                                    } ?>">
                            <ul style="margin-left: -30px; list-style-type: lower-alpha;">
                                <?php
                                if (isset($as->laborat)) {
                                    $lab = json_decode($as->laborat->periksa, true);
                                    foreach ($lab as $key => $value) {
                                        if ($value == 1) {
                                ?>
                                            <li style="text-transform: capitalize;">{{ str_replace('_',' ', $key)}}</li>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </td>
                        <td style="<?php if ($i == $len - 1) {
                                        echo 'border-bottom:1px solid';
                                    } ?>">
                            @if(isset($as->diagnosa)){{$as->diagnosa->kode_icd.' - '.$as->diagnosa->nama_icd}}@endif
                        </td>
                        <td style="<?php if ($i == $len - 1) {
                                        echo 'border-bottom:1px solid';
                                    } ?>">
                            @foreach($as->resep as $r)
                            <span style="border-bottom: 2px solid;">{{ 'R/ '.$r->nomor_resep }}</span><br>
                            @if(isset($r->obat_jadi))
                            @foreach($r->obat_jadi as $oj)
                            <span>{{'- '.$oj->nama_obat}}</span><br>
                            @endforeach
                            @endif
                            @if(isset($r->obat_racik))
                            @foreach($r->obat_racik as $or)
                            @foreach($or->bahan as $ba)
                            <span>{{'- '.$ba->nama_obat}}</span><br>
                            @endforeach
                            @endforeach
                            @endif
                            <br>
                            <br>
                            @endforeach
                        </td>
                        <td style="<?php if ($i == $len - 1) {
                                        echo 'border-bottom:1px solid';
                                    } ?>">
                            @if(isset($as->diagnosa)){{$as->diagnosa->nama_dokter}}@endif
                        </td>
                    </tr>
                    @php
                    $i = $i+1;
                    @endphp
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" style="border-bottom: 1px solid; text-align: center;">Tidak ada data.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 75%; text-align: center;">
            <p>&nbsp;</p>
        </div>
        <div style="float: left; width: 25%; text-align: center; padding-top: 10px;">
            <img src="{{ asset('filelogo/logoihc.png') }}" style="width: 20%; position: absolute; bottom:0;" alt="">
        </div>
    </div>
</body>

</html>