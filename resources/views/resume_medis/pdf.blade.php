<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @page {
            margin: 1.27cm;
        }

        * {
            font-family: sans-serif;
            color: #111;
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

        header {
            position: fixed;
            height: 120px;
            width: 100%;
        }

        footer {
            position: fixed;
            bottom: 0;
            height: 50px;
            width: 100%;
            color: #111;
            line-height: 35px;
        }

        #biodata tr th {
            line-height: 17px;
            text-align: left;
        }

        #pemeriksaan tr th {
            line-height: 17px;
            text-align: left;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <header>
        <div style="float: left; width: 50%; text-align: left; height: 120px;">
            <img src="{{ asset('filelogo/kotakihc.png') }}" alt="" style="width:50%; margin-top: -30px;">
        </div>
        <div style="float: left; width: 50%; height: 120px; margin-top: -20px; padding-left: 30px;">
            <h4 style="color: #111;">{{$klinik->nama}}<br><span style="color:lightgray">{{$klinik->alamat}}
            <br>T/F : {{$klinik->telpon}}</span></h4>
        </div>
    </header>
    <main style="font-size: 12px;">
        <div class="row" style="margin-top: 120px; width:100%; margin-left: 0; border:1px solid transparent">
            <div style="float: left; width: 100%; text-align: center;">
                <h3 style="font-size: 16px;">RESUME MEDIK</h3>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div style="float: left; width: 100%;">
                <table style="border-collapse: collapse; font-size: 13px;" id="biodata">
                    <tr>
                        <th>Nama</th>
                        <th style="padding-left: 5px; padding-right: 5px;"> : </th>
                        <th>{{$data->nama_pasien}}</th>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <th style="padding-left: 5px; padding-right: 5px;"> : </th>
                        <th>{{$data->umur}}</th>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <th style="padding-left: 5px; padding-right: 5px;"> : </th>
                        <th>@if($data->kelamin == 0){{ 'Laki-laki' }}@else{{'Perempuan'}}@endif</th>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th style="padding-left: 5px; padding-right: 5px;"> : </th>
                        <th>{{$data->alamat_pasien.' - '.$data->nama_kelurahan.' - '.$data->nama_kecamatan.' - '.$data->nama_kabupaten}}</th>
                    </tr>
                    <tr>
                        <th>MRS</th>
                        <th style="padding-left: 5px; padding-right: 5px;"> : </th>
                        <th>
                            @if($data->tanggal == '-')
                            {{$data->tanggal}}
                            @else
                            {{ date('d-m-Y', strtotime($data->tanggal)) }}
                            @endif
                            <span style="padding-left: 20px;">Jam : {{ date('H:i', strtotime($data->tanggal)) }}</span>
                        </th>
                    </tr>
                    <tr>
                        <th>KRS</th>
                        <th style="padding-left: 5px; padding-right: 5px;"> : </th>
                        <th>{{ date('d-m-Y', strtotime($data->tanggal_pulang)) }} <span style="padding-left: 20px;">Jam : {{ date('H:i', strtotime($data->tanggal_pulang)) }}</span></th>
                    </tr>
                    <tr>
                        <th>Dokter yang merawat</th>
                        <th style="padding-left: 5px; padding-right: 5px;"> : </th>
                        <th>{{$data->nama_dokter}}</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div style="float: left; width: 100%;">
                <table style="border-collapse: collapse; font-size: 13px;" id="pemeriksaan">
                    <tr>
                        <th>I.</th>
                        <th>ANAMNESE</th>
                        <th></th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>@if(isset($data->diagnosa)){{$data->diagnosa->anamnesa}}@endif</th>
                    </tr>
                    <tr>
                        <th>II.</th>
                        <th>PEMERIKSAAN FISIK</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Tensi</th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>@if(isset($data->diagnosa)){{$data->diagnosa->sistole.'/'.$data->diagnosa->diastole.' mmHg'}}@endif</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Nadi</th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>@if(isset($data->diagnosa)){{$data->diagnosa->nadi.' x/menit'}}@endif</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Respirasi</th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>@if(isset($data->diagnosa)){{$data->diagnosa->rr.' x/menit'}}@endif</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Suhu</th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>@if(isset($data->diagnosa)){{$data->diagnosa->suhu}} &deg;C @endif</th>
                    </tr>
                    <tr>
                        <th>III.</th>
                        <th>PEMERIKSAAN PENUNJANG</th>
                        <th></th>
                        <th style="padding-left: 5px; padding-right: 5px;"></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Laborat</th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>
                            <ul style="margin-left: -30px; list-style-type: lower-alpha;">
                                <?php
                                if (isset($data->laborat)) {
                                    $lab = json_decode($data->laborat->periksa, true);
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
                        </th>
                    </tr>
                    <tr>
                        <th>IV.</th>
                        <th>DIAGNOSA</th>
                        <th></th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>@if(isset($data->diagnosa)){{$data->diagnosa->kode_icd.' - '.$data->diagnosa->nama_icd}}@endif</th>
                    </tr>
                    <tr>
                        <th>V.</th>
                        <th>THERAPY</th>
                        <th></th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>
                            @foreach($resep as $r)
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
                        </th>
                    </tr>
                    <tr>
                        <th>VI.</th>
                        <th>PROGNOSA</th>
                        <th></th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th>@if(isset($data->diagnosa)){{$data->diagnosa->prognosa}}@endif</th>
                    </tr>
                    <tr>
                        <th>VII.</th>
                        <th>KEADAAN KELUAR</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Sembuh</th>
                        <th style="padding-left: 5px; padding-right: 5px;">
                            <span style="<?php if(isset($data->diagnosa)){if(strpos('Sembuh', $data->diagnosa->status_pulang) === false){ echo 'padding:4px;'; }} ?>border:1px solid #111; font-size: 12px; font-family:'DeJaVu Sans Mono',monospace;">
                                @if(isset($data->diagnosa))
                                @if(strpos($data->diagnosa->status_pulang,'Sembuh') !== false)
                                √
                                @else
                                &nbsp;
                                @endif
                                @else
                                &nbsp;
                                @endif
                            </span>
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Berobat Jalan</th>
                        <th style="padding-left: 5px; padding-right: 5px;">
                            <span style="<?php if(isset($data->diagnosa)){if(strpos('Berobat Jalan', $data->diagnosa->status_pulang) === false){ echo 'padding:4px;'; }} ?>border:1px solid #111; font-size: 12px; font-family:'DeJaVu Sans Mono',monospace;">
                                @if(isset($data->diagnosa))
                                @if(strpos($data->diagnosa->status_pulang,'Berobat Jalan') !== false)
                                √
                                @else
                                &nbsp;
                                @endif
                                @else
                                &nbsp;
                                @endif
                            </span>
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Rujuk</th>
                        <th style="padding-left: 5px; padding-right: 5px;">
                            <span style="<?php if(isset($data->diagnosa)){if(strpos('Rujuk', $data->diagnosa->status_pulang) === false){ echo 'padding:4px;'; }} ?>border:1px solid #111; font-size: 12px; font-family:'DeJaVu Sans Mono',monospace;">
                                @if(isset($data->diagnosa))
                                @if(strpos($data->diagnosa->status_pulang,'Rujuk') !== false)
                                √
                                @else
                                &nbsp;
                                @endif
                                @else
                                &nbsp;
                                @endif
                            </span>
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Pulang paksa</th>
                        <th style="padding-left: 5px; padding-right: 5px;">
                        <span style="<?php if(isset($data->diagnosa)){if(strpos('Pulang Paksa', $data->diagnosa->status_pulang) === false){ echo 'padding:4px;'; }} ?>border:1px solid #111; font-size: 12px; font-family:'DeJaVu Sans Mono',monospace;">
                                @if(isset($data->diagnosa))
                                @if(strpos($data->diagnosa->status_pulang,'Pulang Paksa') !== false)
                                √
                                @else
                                &nbsp;
                                @endif
                                @else
                                &nbsp;
                                @endif
                            </span>
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Meninggal</th>
                        <th style="padding-left: 5px; padding-right: 5px;">
                            <span style="<?php if(isset($data->diagnosa)){if(strpos('Meninggal', $data->diagnosa->status_pulang) === false){ echo 'padding:4px;'; }} ?>border:1px solid #111; font-size: 12px; font-family:'DeJaVu Sans Mono',monospace;">
                                @if(isset($data->diagnosa))
                                @if(strpos($data->diagnosa->status_pulang,'Meninggal') !== false)
                                √
                                @else
                                &nbsp;
                                @endif
                                @else
                                &nbsp;
                                @endif
                            </span>
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>VIII.</th>
                        <th>SARAN</th>
                        <th></th>
                        <th style="padding-left: 5px; padding-right: 5px;">:</th>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div style="float: left; width: 70%;">
                <p>&nbsp;</p>
            </div>
            <div style="float: left; width: 30%; font-size: 15px;">
                <p>Jember, {{ date('d-m-Y') }}<br>Dokter yg merawat</p>
                <br>
                <br>
                <br>
                <p>{{$data->nama_dokter}}</p>
            </div>
        </div>
    </main>
    <footer>
        <div style="float: left; width: 50%; text-align: left; height: 120px;">
            <h5 style="color: #111;">www.rolasmedika.com</h5>
        </div>
        <div style="float: left; width: 50%; height: 120px; padding-top: 30px; text-align: right;">
            <img src="{{ asset('filelogo/logoihc.png') }}" style="width: 50%;" alt="">
        </div>
    </footer>
</body>

</html>