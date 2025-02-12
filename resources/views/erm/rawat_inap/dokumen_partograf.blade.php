<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMIS - Dokumen Partograf</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <style>
        .pagebreak {
            page-break-after: always;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #tabel_pemantauan {
            width: 100%;
        }

        @media print {
            body {
                width: 100%;
                font-size: 10pt;
                padding: 0px;
            }

            .inputan {
                border: none !important;
                border-bottom: 1px solid transparent !important;
            }

            #tabel_pemantauan {
                font-size: 10px !important;
            }

            #logo_rshm {
                width: 20% !important;
            }

            @page {
                size: legal;
                margin: 0;
            }

            #gambar_partograf {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }

            #canvas {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }

            .hidden_print {
                display: none;
            }
        }

        #logo_rshm {
            width: 10%;
        }

        body {
            width: 100%;
            font-size: 12pt;
            padding: 20px;
        }

        .row {
            width: 100%;
            margin-left: 0;
        }

        .col-lg-1 {
            width: 8%;
            float: left;
        }

        .col-lg-2 {
            width: 16%;
            float: left;
        }

        .col-lg-3 {
            width: 25%;
            float: left;
        }

        .col-lg-4 {
            width: 33%;
            float: left;
        }

        .col-lg-5 {
            width: 42%;
            float: left;
        }

        .col-lg-6 {
            width: 50%;
            float: left;
        }

        .col-lg-7 {
            width: 58%;
            float: left;
        }

        .col-lg-8 {
            width: 66%;
            float: left;
        }

        .col-lg-9 {
            width: 75%;
            float: left;
        }

        .col-lg-10 {
            width: 83%;
            float: left;
        }

        .col-lg-11 {
            width: 92%;
            float: left;
        }

        .col-lg-12 {
            width: 100%;
            float: left;
        }

        .inputan {
            border: none;
            border-bottom: 1px solid !important;
        }

        #tabel_header tr td {
            /* width: 10%; */

            padding-left: 5px;
            padding-right: 5px;
        }

        #tabel_header tr:nth-child(even) td {
            padding-top: 5px;
        }

        #title_tabel_3 {
            -webkit-transform: rotate(270deg);
        }

        .pilihan_kontraksi {
            border: 1px solid transparent !important;
            width: 50px;
        }
    </style>
</head>

<body>
    @if(Session::has('success'))
    <script>
        alert('{{ Session::get("success") }}')
    </script>
    @endif
    <form id="form_dokumen">
        @csrf
        <div class="row">
            <div class="col-lg-7">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="" id="logo_rshm">
                <p style="font-weight: bold; font-size: 12px;">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya, Kec. Cibarusah<br>
                    Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
            </div>
            <div class="col-lg-5">
                <div style="width: 100%; padding:10px; border: 1px solid; border-radius:10px;">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ $pasien->nama }}</td>
                        </tr>
                        <tr>
                            <td>No. RM</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ $pasien->id }}</td>
                        </tr>
                        <tr>
                            <td>Tgl Lahir</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center" style="margin-top: -20px;">
                <h5 style="font-weight: bolder;">PARTOGRAF</h5>
            </div>
        </div>
        <div class="row" style="font-size: 9pt;">
            <div class="col-lg-12">
                <table id="tabel_header">
                    <tr>
                        <td style="width: 15%;">No. Register</td>
                        <td style="width: 8%;"><input class="inputan" type="text" name="noreg" value="{{ $data ? $data->noreg : $layanan->id }}" readonly></td>
                        <td style="width: 8%;">Nama Ibu</td>
                        <td style="width: 2%;"> : </td>
                        <td style="width: 5%;"><input class="inputan" type="text" value="{{ $data ? $data->nama_ibu : '' }}" name="ibu"></td>
                        <td style="width: 8%;">Umur</td>
                        <td style="width: 2%;"> : </td>
                        <td style="width: 5%;"><input class="inputan" type="number" value="{{ $data ? $data->umur : '' }}" name="umur" min="0"></td>
                        <td style="text-align: right; width: 8%;">G</td>
                        <td style="width: 2%;"> : </td>
                        <td style="width: 5%;"><input class="inputan" style="width: 100%;" type="text" value="{{ $data ? $data->g : '' }}" name="g"></td>
                        <td style="text-align: right; width: 8%;">P</td>
                        <td style="width: 2%;"> : </td>
                        <td style="width: 5%;"><input class="inputan" style="width: 100%;" type="text" value="{{ $data ? $data->p : '' }}" name="p"></td>
                        <td style="text-align: right; width: 8%;">A</td>
                        <td style="width: 2%;"> : </td>
                        <td style="width: 5%;"><input class="inputan" style="width: 100%;" type="text" value="{{ $data ? $data->a : '' }}" name="a"></td>
                    </tr>
                    <tr>
                        <td class="pt-3">No. Puskesmas</td>
                        <td class="pt-3">
                            <input class="inputan" type="text" name="no_puskesmas" value="{{ $data ? $data->nomor_puskesmas : '' }}">
                        </td>
                        <td class="pt-3">Tanggal</td>
                        <td> : </td>
                        <td><input type="date" name="tanggal" value="{{ $data ? date('Y-m-d', strtotime($data->tanggal)) : '' }}" class="inputan"></td>
                        <td>Jam</td>
                        <td> : </td>
                        <td><input class="inputan" type="time" value="{{ $data ? date('H:i', strtotime($data->jam)) : '' }}" name="jam" min="0"></td>
                        <td colspan="3">Alamat</td>
                        <td> : </td>
                        <td colspan="5"><input class="inputan" style="width: 100%;" type="text" value="{{ $data ? $data->alamat : '' }}" name="alamat"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-top:5px;">
                            Ketuban Pecah Sejak Jam <input class="inputan" type="time" value="{{ $data ? date('H:i', strtotime($data->ketuban_pecah_jam)) : '' }}" name="ketuban_pecah_jam">
                        </td>
                        <td colspan="10" style="padding-top:5px;">
                            mutes sejak jam <input class="inputan" type="time" value="{{ $data ? date('H:i', strtotime($data->mutes_jam)) : '' }}" name="mutes_jam">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table style="border-collapse: collapse; width:100%;">
                    <tr>
                        <td style="width: 5%;">Denyut Jantung Janin (/menit)</td>
                        <!-- <td class="pl-3" style="width: 5%;">
                            <p style="line-height:1.65; padding-top:0px; font-size: 14px; text-align: center;">
                                <br>
                                <br>
                                <?php for ($i = 200; $i >= 80; $i -= 10) { ?>
                                    {{ $i }}<br>
                                <?php } ?>
                            </p>
                        </td> -->
                        <td colspan="2" class="pt-4">
                            <table style="border-collapse: collapse; margin-left: 3px;">
                                <tr>
                                    <?php $jam_denyut_jantung_janin = $data ? json_decode($data->denyut_jantung_janin) : []; ?>
                                    <?php for ($j = 0; $j < 16; $j++) { ?>
                                        <td style="padding-left:29px">
                                            <button style="font-size:12px;" type="button" id="btn_denyut_jantung_janin_{{ $j }}" onclick="open_form_denyut_jantung_janin('{{$j}}')">@if(isset($jam_denyut_jantung_janin[$j]) && $jam_denyut_jantung_janin[$j]->waktu != '') {{ $jam_denyut_jantung_janin[$j]->waktu }} @else --:-- @endif</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                            <div class="chart-container" style="width: 100%;">
                                <canvas id="chart_denyut_jantung_janin"></canvas>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right pr-4">
                            Air ketuban
                        </td>
                        <td>
                            <?php $ketuban = $data ? isset($data->ketuban) ? json_decode($data->ketuban) : [] : []; ?>
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <?php for ($i = 0; $i < 16; $i++) { ?>
                                        <td>
                                            <input type="text" class="form-control" value="{{ isset($ketuban[$i]) ? $ketuban[$i] : '' }}" id="ketuban_{{$i}}">
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right pr-4">
                            Penyusupan
                        </td>
                        <td>
                            <?php $penyusupan = $data ? isset($data->penyusupan) ? json_decode($data->penyusupan) : [] : []; ?>
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <?php for ($i = 0; $i < 16; $i++) { ?>
                                        <td>
                                            <input type="text" class="form-control" value="{{ isset($penyusupan[$i]) ? $penyusupan[$i] : '' }}" id="penyusupan_{{$i}}">
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 10px;">
                            <p id="title_tabel_3" style="width:320%; margin-left:-100%;">Pembukaan serviks (cm) beri tanda x<br>Turunnya kepala beri tanda o</p>
                        </td>
                        <!-- <td class="pl-3" style="width: 5%; padding-top: 10px;">
                            <p style="font-size: 14px; text-align: center; line-height:1.55; padding-top:0px">
                                <br>
                                <?php for ($i = 10; $i > 0; $i--) { ?>
                                    {{ $i }}<br>
                                <?php } ?>
                            </p>
                            
                        </td> -->
                        <td style="padding-top: 10px;" colspan="2">
                            <!-- <div style="width: 585px; border:3px solid; position:relative; top:215px; left: 5px; transform: rotate(-33.5deg);"></div>
                            <div style="width: 585px; border:3px solid; position:relative; top:210px; left: 535px; transform: rotate(-33.5deg);"></div> -->
                            <p style="font-size: 10px; position: relative; top:610px; line-height:1.5;">Waktu (Jam)</p>
                            <div class="chart-container" style="width: 100%;">
                                <canvas id="chart_pembukaan_serviks"></canvas>
                            </div>                                
                            <div style="padding-left: 50px;">
                            <table border="1" style="margin-right: 15px;">
                                <!-- <?php for ($i = 0; $i < 10; $i++) { ?>
                                    <tr>
                                        <?php for ($j = 0; $j < 32; $j++) { ?>
                                            <td style="line-height:1.2;">&nbsp;</td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?> -->
                                <tr>
                                    <?php for ($j = 0; $j < 16; $j++) { ?>
                                        <td style="width: 85px; line-height:1.2; text-align: right;">{{ $j+1 }}</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php $serviks = $data ? json_decode($data->pembukaan_serviks) : []; ?>
                                    <?php for ($j = 0; $j < 16; $j++) { ?>
                                        <td style="line-height:1.2; text-align: center; padding-bottom: 5px; padding-top: 5px; font-size:12px; ">
                                            <button type="button" onclick="open_form_pembukaan_serviks('{{ $j }}')" id="btn_pembukaan_serviks_{{ $j }}">@if(isset($serviks[$j]) && $serviks[$j]->waktu != '') {{ $serviks[$j]->waktu }} @else --:-- @endif</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 11px;" class="pt-4">
                            <?php $arr = ['0 Menit (dok)', 'tiap > 40', 'Kontraksi 20-40', '< 20', ''];
                            for ($i = 4; $i >= 0; $i--) { ?>
                                <p style="line-height:0.7; margin-top:15px;">{{ $arr[$i] }}<br></p>
                            <?php } ?>
                        </td>
                        <td style="text-align: center;" class="pt-4">
                            <?php for ($i = 5; $i > 0; $i--) { ?>
                                {{ $i }}<br>
                            <?php } ?>
                        </td>
                        <td class="pt-4">
                            <table border="1" style="width: 100%;">
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <tr>
                                        <?php for ($j = 0; $j < 16; $j++) { ?>
                                            <td style="line-height:1.2; text-align: center;">
                                                <select id="kontraksi_{{$i}}_{{$j}}" onchange="set_kontraksi(this.value, '{{$i}}', '{{$j}}')" class="pilihan_kontraksi">
                                                </select>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <p style="font-size: 12px;">Oksilosin U/L</p>
                        </td>
                        <td>
                            <?php $oksilosin = $data ? json_decode($data->oksilosin) : []; ?>
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <?php for ($j = 0; $j < 16; $j++) { ?>
                                        <td style="line-height:1.2;">
                                            <input type="text" id="oksilosin_{{$j}}" class="form-control" value="{{ isset($oksilosin[$j]) ? $oksilosin[$j] : '' }}">
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <p style="font-size: 12px;">tetes/menit</p>
                        </td>
                        <td>
                            <?php $tetes_menit = $data ? json_decode($data->tetes_menit) : []; ?>
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <?php for ($j = 0; $j < 16; $j++) { ?>
                                        <td style="line-height:1.2;">
                                            <input type="text" id="tetes_menit_{{$j}}" class="form-control" value="{{ isset($tetes_menit[$j]) ? $tetes_menit[$j] : '' }}">
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px; vertical-align: top; padding-top: 30px">Obat dan<br>Cairan IV<br><br><br><br><br>*Nadi<br><br><br><br><br>Tekanan darah</td>
                        <td colspan="2" style="padding-top: 30px;">
                            <table style="border-collapse: collapse;">
                                <tr>
                                    <?php $odc = $data ? json_decode($data->obat_dan_cairan) : []; ?>
                                    <?php for ($j = 0; $j < 16; $j++) { ?>
                                        <td style="padding-left: 14.5px;">
                                            <button type="button" style="width: 60px; font-size:12px;" id="btn_obat_dan_cairan_{{$j}}" onclick="open_form_obat_dan_cairan('{{ $j }}')">@if(isset($odc[$j]) && $odc[$j]->value != '') {{ $odc[$j]->value }} @else &nbsp; @endif</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <!-- <?php for ($i = 180; $i > 60; $i -= 10) { ?>
                                    <tr>
                                        <?php for ($j = 0; $j < 32; $j++) { ?>
                                            <td style="line-height:1.2;">&nbsp;</td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?> -->
                            </table>
                            <div class="chart-container" style="width:100%">
                                <canvas id="chart_tekanan_darah"></canvas>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Suhu</td>
                        <td>°C</td>
                        <td>
                            <?php $suhu = $data ? json_decode($data->suhu) : []; ?>
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <?php for ($i = 0; $i < 16; $i++) { ?>
                                        <td>
                                            <input type="number" step="0.01" class="form-control" value="{{ isset($suhu[$i]) ? $suhu[$i] : '' }}" id="suhu_{{$i}}">
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Urin</td>
                        <td style="font-size: 12px;">
                            <p style="line-height:3; padding-top:10px;">Protein<br>
                                Aseton<br>
                                Volume</p>
                        </td>
                        <td>
                            <?php $urin = $data ? json_decode($data->urin) : []; ?>
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <?php for ($i = 0; $i < 16; $i++) { ?>
                                        <td>
                                            <input type="text" class="form-control" value="{{ isset($urin[$i]) ? $urin[$i]->protein : '' }}" id="urin_protein_{{$i}}">
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php for ($i = 0; $i < 16; $i++) { ?>
                                        <td>
                                            <input type="text" class="form-control" value="{{ isset($urin[$i]) ? $urin[$i]->aseton : '' }}" id="urin_aseton_{{$i}}">
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php for ($i = 0; $i < 16; $i++) { ?>
                                        <td>
                                            <input type="text" class="form-control" value="{{ isset($urin[$i]) ? $urin[$i]->volume : '' }}" id="urin_volume_{{$i}}">
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- @if($data != null && $data->gambar != '')
        <div class="row hidden_print">
            <div class="col-lg-12 text-center pt-3">
                <a class="btn btn-danger" onclick="return confirm('Yakin hapus gambar dan menggambar ulang ?')" href="{{ url('e_rekam_medis/detail/dokumen_partograf/gambar_ulang?dokumen='.$dokumen->id) }}"><i class="fa fa-trash"></i> Gambar Ulang</a>
            </div>
        </div>
        @endif -->
        <div class="row">
            <div class="col-lg-12 text-right">
                <p>RSHM/VK/03.01/Rev.00</p>
            </div>
        </div>
        <div class="pagebreak"></div>
        <div class="row pt-2">
            <div class="col-lg-6">
                <h5>CATATAN PERSALINAN</h5>
                <table style="width: 100%;">
                    <tr>
                        <td>1.</td>
                        <td>Tanggal : </td>
                        <td><input type="date" name="tanggal_persalinan" value="{{ $data ? date('Y-m-d', strtotime($data->tanggal_persalinan)) : '' }}" class="inputan"></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Nama Bidan : </td>
                        <td>
                            <div class="input-group">
                                <input type="hidden" name="id_bidan" value="{{ $data ? $data->id_bidan : '' }}">
                                <input type="text" name="nama_bidan" value="{{ $data ? $data->nama_bidan : '' }}" class="inputan">
                                <div class="input-group-append hidden_print">
                                    <button class="btn btn-dark" type="button" onclick="open_modal_bidan()"><i class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">3.</td>
                        <td colspan="2">
                            Tempat Persalinan : <br>
                            <input type="radio" name="tempat_persalinan" {{ $data ? $data->tempat_persalinan == 'rumah_ibu' ? 'checked' : '' : '' }} value="rumah_ibu"> Rumah Ibu
                            <input class="ml-4" type="radio" name="tempat_persalinan" {{ $data ? $data->tempat_persalinan == 'puskesmas' ? 'checked' : '' : '' }} value="puskesmas"> Puskesmas<br>
                            <input type="radio" name="tempat_persalinan" {{ $data ? $data->tempat_persalinan == 'polindes' ? 'checked' : '' : '' }} value="polindes"> Polindes
                            <input class="ml-4" type="radio" name="tempat_persalinan" {{ $data ? $data->tempat_persalinan == 'rumah_sakit' ? 'checked' : '' : '' }} value="rumah_sakit"> Rumah Sakit<br>
                            <input type="radio" name="tempat_persalinan" {{ $data ? $data->tempat_persalinan == 'klinik_swasta' ? 'checked' : '' : '' }} value="klinik_swasta"> Klinik Swasta
                            <input class="ml-4" type="radio" name="tempat_persalinan" {{ $data ? $data->tempat_persalinan == 'lainnya' ? 'checked' : '' : '' }} value="lainnya"> Lainnya : <input class="inputan" type="text" value="{{ $data ? $data->tempat_persalinan_lain : '' }}" name="tempat_persalinan_lain">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="vertical-align: top;">4. Alamat tempat persalinan : <input class="inputan" type="text" value="{{ $data ? $data->alamat_tempat_persalinan : '' }}" name="alamat_tempat_persalinan"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">5.</td>
                        <td style="vertical-align: top;">Catatan</td>
                        <td>
                            <input type="checkbox" {{ $data ? $data->rujuk == '1' ? 'checked' : '' : '' }} name="rujuk" value="1"> Rujuk, kala : <input type="radio" name="kala" {{ $data ? $data->kala == '1' ? 'checked' : '' : '' }} value="1"> I / <input type="radio" name="kala" {{ $data ? $data->kala == '2' ? 'checked' : '' : '' }} value="2"> II / <input type="radio" name="kala" {{ $data ? $data->kala == '3' ? 'checked' : '' : '' }} value="3"> III / <input type="radio" name="kala" {{ $data ? $data->kala == '4' ? 'checked' : '' : '' }} value="4"> IV
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="vertical-align: top;">6. Alasan merujuk : <input class="inputan" type="text" value="{{ $data ? $data->alasan_merujuk : '' }}" name="alasan_merujuk"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="vertical-align: top;">7. Tempat Rujukan : <input class="inputan" type="text" value="{{ $data ? $data->tempat_rujukan : '' }}" name="tempat_rujukan"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">8.</td>
                        <td colspan="2">
                            Pendamping pada saat merujuk : <br>
                            <input type="radio" name="pendamping" {{ $data ? $data->pendamping == 'bidan' ? 'checked' : '' : '' }} value="bidan"> Bidan
                            <input class="ml-4" type="radio" name="pendamping" {{ $data ? $data->pendamping == 'teman' ? 'checked' : '' : '' }} value="teman"> Teman<br>
                            <input type="radio" name="pendamping" {{ $data ? $data->pendamping == 'suami' ? 'checked' : '' : '' }} value="suami"> Suami
                            <input class="ml-4" type="radio" name="pendamping" {{ $data ? $data->pendamping == 'dukun' ? 'checked' : '' : '' }} value="dukun"> Dukun<br>
                            <input type="radio" name="pendamping" {{ $data ? $data->pendamping == 'keluarga' ? 'checked' : '' : '' }} value="keluarga"> Keluarga
                            <input class="ml-4" type="radio" name="pendamping" {{ $data ? $data->pendamping == 'tidak_ada' ? 'checked' : '' : '' }} value="tidak_ada"> Tidak ada
                        </td>
                    </tr>
                    <?php
                    $kala_i = $data ? json_decode($data->kala_i) : null;
                    $kala_ii = $data ? json_decode($data->kala_ii) : null;
                    $kala_iii = $data ? json_decode($data->kala_iii) : null;
                    $kala_iv = $data ? json_decode($data->kala_iv) : null;
                    $bbl = $data ? json_decode($data->bayi_baru_lahir) : null;
                    ?>
                    <tr>
                        <th colspan="3" style="border-bottom: 2px solid; padding-top:10px;">KALA I</th>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td colspan="2">
                            Partogram melewati garis waspada : <input type="radio" {{ $kala_i ? $kala_i->melewati_garis == 'y' ? 'checked' : '' : '' }} name="melewati_garis" value="y"> Y / <input type="radio" {{ $kala_i ? $kala_i->melewati_garis == 't' ? 'checked' : '' : '' }} name="melewati_garis" value="t"> T
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">10. Masalah lain, sebutkan : <br>
                            <textarea id="masalah_lain_kala_i" cols="30" rows="2" class="form-control">{{ $kala_i ? $kala_i->masalah : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">11. Penatalaksanaan masalah Tsb : <br>
                            <textarea id="penatalaksanaan_masalah_kala_i" cols="30" rows="2" class="form-control">{{ $kala_i ? $kala_i->penatalaksanaan_masalah : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">12. Hasilnya : <input class="inputan" value="{{ $kala_i ? $kala_i->hasil : '' }}" type="text" id="hasil_kala_i">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" style="border-bottom: 2px solid; padding-top:10px;">KALA II</th>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">13.</td>
                        <td colspan="2">Episiotomi : <br>
                            <input type="radio" name="episiotomi" {{ $kala_ii ? $kala_ii->episiotomi->value == 'ya' ? 'checked' : '' : '' }} value="ya"> Ya, Indikasi <input type="text" class="inputan" value="{{ $kala_ii ? $kala_ii->episiotomi->indikasi : '' }}" id="indikasi_episiotomi"><br>
                            <input type="radio" name="episiotomi" {{ $kala_ii ? $kala_ii->episiotomi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">14.</td>
                        <td colspan="2">
                            Pendamping pada saat persalinan : <br>
                            <input type="radio" name="pendamping_persalinan" {{ $kala_ii ? $kala_ii->pendamping == 'suami' ? 'checked' : '' : '' }} value="suami"> Suami
                            <input class="ml-4" type="radio" name="pendamping_persalinan" {{ $kala_ii ? $kala_ii->pendamping == 'teman' ? 'checked' : '' : '' }} value="teman"> Teman
                            <input class="ml-4" type="radio" name="pendamping_persalinan" {{ $kala_ii ? $kala_ii->pendamping == 'tidak_ada' ? 'checked' : '' : '' }} value="tidak_ada"> Tidak ada<br>
                            <input type="radio" name="pendamping_persalinan" {{ $kala_ii ? $kala_ii->pendamping == 'keluarga' ? 'checked' : '' : '' }} value="keluarga"> Keluarga
                            <input class="ml-4" type="radio" name="pendamping_persalinan" {{ $kala_ii ? $kala_ii->pendamping == 'dukun' ? 'checked' : '' : '' }} value="dukun"> Dukun
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">15.</td>
                        <td colspan="2">Gawat Janin : <br>
                            <input type="radio" name="gawat_janin" {{ $kala_ii ? $kala_ii->gawat_janin->value == 'ya' ? 'checked' : '' : '' }} value="ya"> Ya, tindakan yang dilakukan<br>
                            <ul style="list-style-type: lower-alpha;">
                                <li><input type="text" value="{{ $kala_ii ? $kala_ii->gawat_janin->tindakan[0] : '' }}" id="tindakan_gawat_janin_1" class="form-control inputan"></li>
                                <li><input type="text" value="{{ $kala_ii ? $kala_ii->gawat_janin->tindakan[1] : '' }}" id="tindakan_gawat_janin_2" class="form-control inputan"></li>
                                <li><input type="text" value="{{ $kala_ii ? $kala_ii->gawat_janin->tindakan[2] : '' }}" id="tindakan_gawat_janin_3" class="form-control inputan"></li>
                            </ul>
                            <input type="radio" name="gawat_janin" {{ $kala_ii ? $kala_ii->gawat_janin->value == 'tidak' ? 'checked' : '' : '' }} value="tidak"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">16.</td>
                        <td colspan="2">Distosia Bahu : <br>
                            <input type="radio" {{ $kala_ii ? $kala_ii->distosia_bahu->value == 'ya' ? 'checked' : '' : '' }} name="distosia_bahu" value="ya"> Ya, tindakan yang dilakukan<br>
                            <ul style="list-style-type: lower-alpha;">
                                <li><input type="text" value="{{ $kala_ii ? $kala_ii->distosia_bahu->tindakan[0] : '' }}" id="tindakan_distosia_bahu_1" class="form-control inputan"></li>
                                <li><input type="text" value="{{ $kala_ii ? $kala_ii->distosia_bahu->tindakan[1] : '' }}" id="tindakan_distosia_bahu_2" class="form-control inputan"></li>
                                <li><input type="text" value="{{ $kala_ii ? $kala_ii->distosia_bahu->tindakan[2] : '' }}" id="tindakan_distosia_bahu_3" class="form-control inputan"></li>
                            </ul>
                            <input type="radio" {{ $kala_ii ? $kala_ii->distosia_bahu->value == 'tidak' ? 'checked' : '' : '' }} name="distosia_bahu" value="tidak"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">17. Masalah lain, sebutkan : <br>
                            <textarea id="masalah_lain_kala_ii" cols="30" rows="2" class="form-control">{{ $kala_ii ? $kala_ii->masalah : ''}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">18. Penatalaksanaan masalah Tsb : <br>
                            <textarea id="penatalaksanaan_masalah_kala_ii" cols="30" rows="2" class="form-control">{{ $kala_ii ? $kala_ii->penatalaksanaan_masalah : ''}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">19. Hasilnya : <input value="{{ $kala_ii ? $kala_ii->hasil : ''}}" class="inputan" type="text" id="hasil_kala_ii">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" style="border-bottom: 2px solid; padding-top:10px;">KALA III</th>
                    </tr>
                    <tr>
                        <td style="padding-top: 10px;">20.</td>
                        <td style="padding-top: 10px;">Lama Kala III : </td>
                        <td style="padding-top: 10px;"><input type="number" value="{{ $kala_iii ? $kala_iii->lama : ''}}" class="inputan" id="lama_kala_iii" min="1"> menit</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">21.</td>
                        <td colspan="2">
                            Pemberian Oisitosin 10 U lm ?<br>
                            <input type="radio" name="pemberian_oisitosin" {{ $kala_iii ? $kala_iii->oisitosin->value == 'ya' ? 'checked' : '' : ''}} value="ya"> Ya, waktu : <input type="number" class="inputan" value="{{ $kala_iii ? $kala_iii->oisitosin->waktu : '' }}" style="width:50px;" id="waktu_oisitosin"> menit sesudah persalinan<br>
                            <input type="radio" name="pemberian_oisitosin" {{ $kala_iii ? $kala_iii->oisitosin->value == 'tidak' ? 'checked' : '' : ''}} value="tidak"> Tidak, alasan <input type="text" class="inputan" value="{{ $kala_iii ? $kala_iii->oisitosin->alasan : '' }}" id="alasan_oisitosin">
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">22.</td>
                        <td colspan="2">
                            Pemberian Ulang Oksitosin (2x) ?<br>
                            <input type="radio" name="pemberian_oksitosin" {{ $kala_iii ? $kala_iii->oksitosin->value == 'ya' ? 'checked' : '' : ''}} value="ya"> Ya, alasan <input type="text" class="inputan" value="{{ $kala_iii ? $kala_iii->oksitosin->alasan : '' }}" id="alasan_oksitosin"><br>
                            <input type="radio" name="pemberian_oksitosin" {{ $kala_iii ? $kala_iii->oksitosin->value == 'tidak' ? 'checked' : '' : ''}} value="tidak"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">23.</td>
                        <td colspan="2">
                            Penegangan tali pusar terkendali ?<br>
                            <input type="radio" name="penegangan_tali_pusar" {{ $kala_iii ? $kala_iii->penegangan_tali_pusar->value == 'ya' ? 'checked' : '' : ''}} value="ya"> Ya<br>
                            <input type="radio" name="penegangan_tali_pusar" {{ $kala_iii ? $kala_iii->penegangan_tali_pusar->value == 'tidak' ? 'checked' : '' : ''}} value="tidak"> Tidak, alasan <input type="text" value="{{ $kala_iii ? $kala_iii->penegangan_tali_pusar->alasan : '' }}" class="inputan" id="alasan_penegangan_tali_pusar">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%;">
                    <tr>
                        <td style="vertical-align: top;">24.</td>
                        <td colspan="2">
                            Masase fundus uteri ?<br>
                            <input type="radio" name="masase_fundus_uteri" {{ $kala_iii ? $kala_iii->masase_fundus_uteri->value == 'ya' ? 'checked' : '' : ''}} value="ya"> Ya<br>
                            <input type="radio" name="masase_fundus_uteri" {{ $kala_iii ? $kala_iii->masase_fundus_uteri->value == 'tidak' ? 'checked' : '' : ''}} value="tidak"> Tidak, alasan <input type="text" class="inputan" value="{{ $kala_iii ? $kala_iii->masase_fundus_uteri->alasan : '' }}" id="alasan_masase_fundus_uteri">
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">25.</td>
                        <td colspan="2">
                            Plasenta lahir lengkap (intact) <input type="radio" name="intact" {{ $kala_iii ? $kala_iii->intact->value == 'ya' ? 'checked' : '' : ''}} value="ya"> Ya / <input type="radio" name="intact" {{ $kala_iii ? $kala_iii->intact->value == 'tidak' ? 'checked' : '' : ''}} value="tidak"> Tidak<br>
                            Jika tidak lengkap, tindakan yang dilakukan :
                            <ul style="list-style-type: lower-alpha;">
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->intact->tindakan[0] : ''}}" id="tindakan_intact_1"></li>
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->intact->tindakan[1] : ''}}" id="tindakan_intact_2"></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">26.</td>
                        <td colspan="2">
                            Plasenta tidak lahir > 30 menit : <input type="radio" name="plasenta_tidak_lahir" {{ $kala_iii ? $kala_iii->plasenta_tidak_lahir->value == 'ya' ? 'checked' : '' : ''}} value="ya"> Ya / <input type="radio" name="plasenta_tidak_lahir" {{ $kala_iii ? $kala_iii->plasenta_tidak_lahir->value == 'tidak' ? 'checked' : '' : ''}} value="tidak"> Tidak<br>
                            tindakan :
                            <ul style="list-style-type: lower-alpha;">
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->plasenta_tidak_lahir->tindakan[0]  : ''}}" id="tindakan_plasenta_tidak_lahir_1"></li>
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->plasenta_tidak_lahir->tindakan[1]  : ''}}" id="tindakan_plasenta_tidak_lahir_2"></li>
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->plasenta_tidak_lahir->tindakan[2]  : ''}}" id="tindakan_plasenta_tidak_lahir_3"></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">27.</td>
                        <td colspan="2">
                            Laserasi : <br>
                            <input type="radio" name="laserasi" {{ $kala_iii ? $kala_iii->laserasi->value == 'ya' ? 'checked' : '' : ''}} value="ya"> Ya, dimana <input type="text" value="{{ $kala_iii ? $kala_iii->laserasi->tempat : '' }}" class="inputan" id="tempat_laserasi"> <br>
                            <input type="radio" name="laserasi" {{ $kala_iii ? $kala_iii->laserasi->value == 'tidak' ? 'checked' : '' : ''}} value="tidak"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">28.</td>
                        <td colspan="2">
                            Jika laserasi perineum, derajat :
                            <input type="radio" name="laserasi_perineum" {{ $kala_iii ? $kala_iii->laserasi_perineum->value == '1' ? 'checked' : '' : ''}} value="1"> 1 /
                            <input type="radio" name="laserasi_perineum" {{ $kala_iii ? $kala_iii->laserasi_perineum->value == '2' ? 'checked' : '' : ''}} value="2"> 2 /
                            <input type="radio" name="laserasi_perineum" {{ $kala_iii ? $kala_iii->laserasi_perineum->value == '3' ? 'checked' : '' : ''}} value="3"> 3 /
                            <input type="radio" name="laserasi_perineum" {{ $kala_iii ? $kala_iii->laserasi_perineum->value == '4' ? 'checked' : '' : ''}} value="4"> 4 <br>
                            Tindakan :
                            <input type="checkbox" id="penjahitan" {{ $kala_iii ? $kala_iii->laserasi_perineum->tindakan == 'penjahitan' ? 'checked' : '' : '' }} value="penjahitan"> Penjahitan, <input type="checkbox" id="anestesi" {{ $kala_iii ? $kala_iii->laserasi_perineum->penjahitan == 'anestesi' ? 'checked' : '' : '' }} value="anestesi"> dengan /
                            <input type="checkbox" id="tanpa_anestesi" {{ $kala_iii ? $kala_iii->laserasi_perineum->penjahitan == 'tanpa_anestesi' ? 'checked' : '' : '' }} value="tanpa_anestesi"> tanpa anestesi
                            <input type="checkbox" id="tidak_dijahit" {{ $kala_iii ? $kala_iii->laserasi_perineum->tindakan == 'tidak_dijahit' ? 'checked' : '' : '' }} value="tidak_dijahit"> Tidak dijahit, alasan <input type="text" value="{{ $kala_iii ? $kala_iii->laserasi_perineum->alasan : '' }}" class="inputan" id="alasan_tindakan_laserasi_perineum"> <br>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">29.</td>
                        <td colspan="2">
                            Atoni uteri : <br>
                            <input type="radio" name="atoni_uteri" {{ $kala_iii ? $kala_iii->atoni_uteri->value == 'ya' ? 'checked' : '' : '' }} value="ya"> Ya, tindakan
                            <ul style="list-style-type: lower-alpha;">
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->atoni_uteri->tindakan[0] : '' }}" id="tindakan_atoni_uteri_1"></li>
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->atoni_uteri->tindakan[1] : '' }}" id="tindakan_atoni_uteri_2"></li>
                                <li><input type="text" class="form-control inputan" value="{{ $kala_iii ? $kala_iii->atoni_uteri->tindakan[2] : '' }}" id="tindakan_atoni_uteri_3"></li>
                            </ul>
                            <input type="radio" name="atoni_uteri" {{ $kala_iii ? $kala_iii->atoni_uteri->value == 'tidak' ? 'checked' : '' : '' }} value="tidak"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td>30</td>
                        <td colspan="2">Jumlah pendarahan : <input type="number" value="{{ $kala_iii ? $kala_iii->jumlah_pendarahan : '' }}" class="inputan" id="jumlah_pendarahan" min="0"> ml</td>
                    </tr>
                    <tr>
                        <td colspan="3">31. Masalah lain, sebutkan : <br>
                            <textarea id="masalah_lain_kala_iii" cols="30" rows="2" class="form-control">{{ $kala_iii ? $kala_iii->masalah : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">32. Penatalaksanaan masalah Tsb : <br>
                            <textarea id="penatalaksanaan_masalah_kala_iii" cols="30" rows="2" class="form-control">{{ $kala_iii ? $kala_iii->penatalaksanaan_masalah : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">33. Hasilnya : <input class="inputan" value="{{ $kala_iii ? $kala_iii->hasil: '' }}" type="text" id="hasil_kala_iii">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" style="border-bottom: 2px solid; padding-top:10px;">BAYI BARU LAHIR :</th>
                    </tr>
                    <tr>
                        <td style="padding-top: 10px;">34</td>
                        <td style="padding-top: 10px;" colspan="2">Berat Badan <input type="number" value="{{ $bbl ? $bbl->berat_badan : '' }}" class="inputan" id="berat_badan"> gram</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td colspan="2">Panjang <input type="number" class="inputan" value="{{ $bbl ? $bbl->panjang : '' }}" id="panjang"> cm</td>
                    </tr>
                    <tr>
                        <td>36</td>
                        <td colspan="2">Jenis Kelamin <input type="radio" name="jenis_kelamin" {{ $bbl ? $bbl->kelamin == 'l' ? 'checked' : '' : '' }} value="l"> L / <input type="radio" name="jenis_kelamin" {{ $bbl ? $bbl->kelamin == 'p' ? 'checked' : '' : '' }} value="p"> P</td>
                    </tr>
                    <tr>
                        <td>37</td>
                        <td colspan="2">Penilaian bayi baru lahir <input type="radio" name="penilaian" {{ $bbl ? $bbl->penilaian == 'baik' ? 'checked' : '' : '' }} value="baik"> baik / <input type="radio" name="penilaian" {{ $bbl ? $bbl->penilaian == 'penyulit' ? 'checked' : '' : '' }} value="penyulit"> ada penyulit</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">38</td>
                        <td colspan="2">
                            Bayi lahir : <br>
                            <input type="radio" name="bayi_lahir" {{ $bbl ? $bbl->bayi_lahir->value == 'normal' ? 'checked' : '' : '' }} value="normal"> Normal, tindakan :
                            <ul style="list-style-type: none;">
                                <li><input type="radio" name="bayi_lahir_normal" {{ $bbl ? $bbl->bayi_lahir->lahir_normal == 'mengeringkan' ? 'checked' : '' : '' }} value="mengeringkan"> mengeringkan</li>
                                <li><input type="radio" name="bayi_lahir_normal" {{ $bbl ? $bbl->bayi_lahir->lahir_normal == 'menghangatkan' ? 'checked' : '' : '' }} value="menghangatkan"> menghangatkan</li>
                                <li><input type="radio" name="bayi_lahir_normal" {{ $bbl ? $bbl->bayi_lahir->lahir_normal == 'rangsang' ? 'checked' : '' : '' }} value="rangsang"> rangsang taktil</li>
                                <li><input type="radio" name="bayi_lahir_normal" {{ $bbl ? $bbl->bayi_lahir->lahir_normal == 'bungkus_bayi' ? 'checked' : '' : '' }} value="bungkus_bayi"> bungkus bayi dan tempatkan di sisi ibu</li>
                            </ul>
                            <input type="radio" name="bayi_lahir" {{ $bbl ? $bbl->bayi_lahir->value == 'aspiksia' ? 'checked' : '' : '' }} value="aspiksia"> Aspiksia ringan/pucat/biru/lemas/,tindakan :
                            <ul style="list-style-type: none;">
                                <li><input type="radio" name="bayi_lahir_aspiksia" {{ $bbl ? $bbl->bayi_lahir->aspiksia == 'mengeringkan' ? 'checked' : '' : '' }} value="mengeringkan"> mengeringkan <input class="ml-4" type="radio" name="bayi_lahir_aspiksia" value="bebaskan_jalan_napas"> bebaskan jalan napas</li>
                                <li><input type="radio" name="bayi_lahir_aspiksia" {{ $bbl ? $bbl->bayi_lahir->aspiksia == 'rangsang' ? 'checked' : '' : '' }} value="rangsang"> rangsang taktil <input class="ml-4" type="radio" name="bayi_lahir_aspiksia" value="menghangatkan"> menghangatkan</li>
                                <li><input type="radio" name="bayi_lahir_aspiksia" {{ $bbl ? $bbl->bayi_lahir->aspiksia == 'bungkus_bayi' ? 'checked' : '' : '' }} value="bungkus_bayi"> bungkus bayi dan tempatkan di sisi ibu</li>
                                <li><input type="radio" name="bayi_lahir_aspiksia" {{ $bbl ? $bbl->bayi_lahir->aspiksia == 'lain_lain' ? 'checked' : '' : '' }} value="lain_lain"> lain - lain sebutkan <input type="text" class="inputan" value="{{ $bbl ? $bbl->bayi_lahir->aspiksia_input : '' }}" id="bayi_lahir_aspiksia_input"></li>
                            </ul>
                            <input type="radio" name="bayi_lahir" {{ $bbl ? $bbl->bayi_lahir->value == 'cacat_bawaan' ? 'checked' : '' : '' }} value="cacat_bawaan"> Cacat bawaan, sebutkan : <input type="text" class="inputan" value="{{ $bbl ? $bbl->bayi_lahir->cacat : '' }}" id="cacat_bawaan"><br>
                            <input type="radio" name="bayi_lahir" {{ $bbl ? $bbl->bayi_lahir->value == 'hipotemi' ? 'checked' : '' : '' }} value="hipotemi"> Hipotemi, tindakan :
                            <ul style="list-style-type: lower-alpha;">
                                <li><input type="text" value="{{ $bbl ? $bbl->bayi_lahir->tindakan_hipotemi[0] : '' }}" id="tindakan_hipotemi_1" class="inputan"></li>
                                <li><input type="text" value="{{ $bbl ? $bbl->bayi_lahir->tindakan_hipotemi[1] : '' }}" id="tindakan_hipotemi_2" class="inputan"></li>
                                <li><input type="text" value="{{ $bbl ? $bbl->bayi_lahir->tindakan_hipotemi[2] : '' }}" id="tindakan_hipotemi_3" class="inputan"></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">39</td>
                        <td colspan="2">
                            Pemberian ASI<br>
                            <input type="radio" name="pemberian_asi" {{ $bbl ? $bbl->pemberian_asi->value == 'ya' ? 'checked' : '' : '' }} value="ya"> Ya, waktu : <input style="width: 20%;" type="number" id="waktu_pemberian_asi" class="inputan" min="0"> jam setelah bayi lahir<br>
                            <input type="radio" name="pemberian_asi" {{ $bbl ? $bbl->pemberian_asi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak"> Tidak, alasan : <input type="text" class="inputan" value="{{ $bbl ? $bbl->pemberian_asi->alasan : '' }}" id="alasan_pemberian_asi">
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">40.</td>
                        <td>
                            Masalah lain, sebutkan : <input value="{{ $bbl ? $bbl->masalah : '' }}" class="inputan" type="text" id="masalah_lain_bayi_baru_lahir"><br>
                            Hasilnya : <input value="{{ $bbl ? $bbl->hasil : '' }}" class="inputan" type="text" id="hasil_bayi_baru_lahir">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="pagebreak"></div>
        <div class="row">
            <div class="col-lg-12 pt-3">
                <h5>PEMANTAUAN PERSALINAN KALA IV</h5>
                <table id="tabel_pemantauan" style="width:100%; border-collapse: collapse;" border="1">
                    <thead>
                        <tr class="text-center">
                            <th>Jam ke</th>
                            <th>Waktu</th>
                            <th>Tekanan Darah</th>
                            <th>Nadi</th>
                            <th></th>
                            <th>Tinggi Fundus Uteri</th>
                            <th>Kontraksi Uterus</th>
                            <th>Kandung Kemih</th>
                            <th>Pendarahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="4" style="vertical-align: top;">1</td>
                            <td class="text-center"><input class="inputan" type="time" value="{{ $kala_iv ? isset($kala_iv->pemantauan[0]) ? $kala_iv->pemantauan[0]->waktu : '' : '' }}" id="{{'waktu_pemantauan_1_jam_ke_satu'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[0]) ? $kala_iv->pemantauan[0]->tekanan_darah : '' : '' }}" id="{{'tekanan_darah_pemantauan_1_jam_ke_satu'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[0]) ? $kala_iv->pemantauan[0]->nadi : '' : '' }}" id="{{'nadi_pemantauan_1_jam_ke_satu'}}"></td>
                            <td></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[0]) ? $kala_iv->pemantauan[0]->tinggi_fundus : '' : '' }}" id="{{'tinggi_fundus_pemantauan_1_jam_ke_satu'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[0]) ? $kala_iv->pemantauan[0]->kontraksi_uterus : '' : '' }}" id="{{'kontraksi_uterus_pemantauan_1_jam_ke_satu'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[0]) ? $kala_iv->pemantauan[0]->kandung_kemih : '' : '' }}" id="{{'kandung_kemih_pemantauan_1_jam_ke_satu'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[0]) ? $kala_iv->pemantauan[0]->pendarahan : '' : '' }}" id="{{'pendarahan_pemantauan_1_jam_ke_satu'}}"></td>
                        </tr>
                        <?php for ($i = 2; $i < 5; $i++) { ?>
                            <tr>
                                <td class="text-center"><input class="inputan" type="time" value="{{ $kala_iv ? isset($kala_iv->pemantauan[$i-1]) ? $kala_iv->pemantauan[$i-1]->waktu : '' : '' }}" id="{{'waktu_pemantauan_'.$i.'_jam_ke_satu'}}"></td>
                                <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[$i-1]) ? $kala_iv->pemantauan[$i-1]->tekanan_darah : '' : '' }}" id="{{'tekanan_darah_pemantauan_'.$i.'_jam_ke_satu'}}"></td>
                                <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[$i-1]) ? $kala_iv->pemantauan[$i-1]->nadi : '' : '' }}" id="{{'nadi_pemantauan_'.$i.'_jam_ke_satu'}}"></td>
                                <td></td>
                                <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[$i-1]) ? $kala_iv->pemantauan[$i-1]->tinggi_fundus : '' : '' }}" id="{{'tinggi_fundus_pemantauan_'.$i.'_jam_ke_satu'}}"></td>
                                <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[$i-1]) ? $kala_iv->pemantauan[$i-1]->kontraksi_uterus : '' : '' }}" id="{{'kontraksi_uterus_pemantauan_'.$i.'_jam_ke_satu'}}"></td>
                                <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[$i-1]) ? $kala_iv->pemantauan[$i-1]->kandung_kemih : '' : '' }}" id="{{'kandung_kemih_pemantauan_'.$i.'_jam_ke_satu'}}"></td>
                                <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[$i-1]) ? $kala_iv->pemantauan[$i-1]->pendarahan : '' : '' }}" id="{{'pendarahan_pemantauan_'.$i.'_jam_ke_satu'}}"></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td rowspan="4" style="vertical-align: top;">2</td>
                            <td class="text-center"><input class="inputan" type="time" value="{{ $kala_iv ? isset($kala_iv->pemantauan[4]) ? $kala_iv->pemantauan[4]->waktu : '' : '' }}" id="{{'waktu_pemantauan_1_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[4]) ? $kala_iv->pemantauan[4]->tekanan_darah : '' : '' }}" id="{{'tekanan_darah_pemantauan_1_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[4]) ? $kala_iv->pemantauan[4]->nadi : '' : '' }}" id="{{'nadi_pemantauan_1_jam_ke_dua'}}"></td>
                            <td></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[4]) ? $kala_iv->pemantauan[4]->tinggi_fundus : '' : '' }}" id="{{'tinggi_fundus_pemantauan_1_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[4]) ? $kala_iv->pemantauan[4]->kontraksi_uterus : '' : '' }}" id="{{'kontraksi_uterus_pemantauan_1_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[4]) ? $kala_iv->pemantauan[4]->kandung_kemih : '' : '' }}" id="{{'kandung_kemih_pemantauan_1_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[4]) ? $kala_iv->pemantauan[4]->pendarahan : '' : '' }}" id="{{'pendarahan_pemantauan_1_jam_ke_dua'}}"></td>
                        </tr>
                        <tr>
                            <td class="text-center"><input class="inputan" type="time" value="{{ $kala_iv ? isset($kala_iv->pemantauan[5]) ? $kala_iv->pemantauan[5]->waktu : '' : '' }}" id="{{'waktu_pemantauan_2_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[5]) ? $kala_iv->pemantauan[5]->tekanan_darah : '' : '' }}" id="{{'tekanan_darah_pemantauan_2_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[5]) ? $kala_iv->pemantauan[5]->nadi : '' : '' }}" id="{{'nadi_pemantauan_2_jam_ke_dua'}}"></td>
                            <td></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[5]) ? $kala_iv->pemantauan[5]->tinggi_fundus : '' : '' }}" id="{{'tinggi_fundus_pemantauan_2_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[5]) ? $kala_iv->pemantauan[5]->kontraksi_uterus : '' : '' }}" id="{{'kontraksi_uterus_pemantauan_2_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[5]) ? $kala_iv->pemantauan[5]->kandung_kemih : '' : '' }}" id="{{'kandung_kemih_pemantauan_2_jam_ke_dua'}}"></td>
                            <td class="text-center"><input class="inputan" type="text" value="{{ $kala_iv ? isset($kala_iv->pemantauan[5]) ? $kala_iv->pemantauan[5]->pendarahan : '' : '' }}" id="{{'pendarahan_pemantauan_2_jam_ke_dua'}}"></td>
                        </tr>
                    </tbody>
                </table>
                <p>Masalah kala IV : <input type="text" id="masalah_kala_iv" value="{{ $kala_iv ? $kala_iv->masalah : '' }}" class="form-control inputan"></p>
                <p>Penatalaksanaan masalah tersebut : <input type="text" id="penatalaksanaan_masalah_kala_iv" value="{{ $kala_iv ? $kala_iv->penatalaksanaan_masalah : '' }}" class="form-control inputan"></p>
                <p>Hasilnya : <input type="text" id="hasil_kala_iv" value="{{ $kala_iv ? $kala_iv->hasil : '' }}" class="form-control inputan"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <input type="hidden" id="gambar" name="gambar">
                <button class="btn btn-success hidden_print" type="submit" id="simpan">Simpan</button>
            </div>
        </div>

        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="kala_i" id="kala_i">
        <input type="hidden" name="kala_ii" id="kala_ii">
        <input type="hidden" name="kala_iii" id="kala_iii">
        <input type="hidden" name="kala_iv" id="kala_iv">
        <input type="hidden" name="ketuban" id="ketuban">
        <input type="hidden" name="penyusupan" id="penyusupan">
        <input type="hidden" name="oksilosin" id="oksilosin">
        <input type="hidden" name="tetes_menit" id="tetes_menit">
        <input type="hidden" name="suhu" id="suhu">
        <input type="hidden" name="urin" id="urin">
        <input type="hidden" name="bayi_baru_lahir" id="bayi_baru_lahir">
        <input type="hidden" name="denyut_jantung_janin" id="denyut_jantung_janin">
        <input type="hidden" name="pembukaan_serviks" id="pembukaan_serviks">
        <input type="hidden" name="obat_dan_cairan" id="obat_dan_cairan">
        <input type="hidden" name="kontraksi" id="kontraksi">
    </form>

    <div class="modal fade" id="modal_bidan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Bidan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tabel_bidan" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDenyutJantungJanin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Denyut Jantung Janin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_denyut_jantung_janin">
                    <div class="modal-body">
                        <input type="hidden" id="index_denyut_jantung_janin">
                        <div class="form-group">
                            <label for="">Waktu</label>
                            <input type="time" id="waktu_denyut_jantung_janin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Denyut Jantung</label>
                            <input type="number" step="0.01" min="0" id="value_denyut_jantung_janin" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalServiks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pembukaan Serviks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_pembukaan_serviks">
                    <div class="modal-body">
                        <input type="hidden" id="index_pembukaan_serviks">
                        <div class="form-group">
                            <label for="">Waktu</label>
                            <input type="time" id="waktu_pembukaan_serviks" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pembukaan Serviks 1</label>
                            <input type="number" step="0.01" min="0" max="10" id="value_pembukaan_serviks_satu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pembukaan Serviks 2</label>
                            <input type="number" step="0.01" min="0" max="10" id="value_pembukaan_serviks_dua" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Turun Kepala 1</label>
                            <input type="number" step="0.01" min="0" max="10" id="value_turun_kepala_satu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Turun Kepala 2</label>
                            <input type="number" step="0.01" min="0" max="10" id="value_turun_kepala_dua" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalObatDanCairan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Obat dan Cairan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_obat_dan_cairan">
                    <div class="modal-body">
                        <input type="hidden" id="index_obat_dan_cairan">
                        <div class="form-group">
                            <label for="">Isian</label>
                            <input type="text" id="value_obat_dan_cairan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nadi</label>
                            <input type="number" step="0.01" min="0" id="nadi_obat_dan_cairan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tekanan Darah</label>
                            <input type="number" step="0.01" min="0" id="tekanan_darah_obat_dan_cairan" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let data = null;
    const ratio = Math.max(window.devicePixelRatio || 1, 1);

    <?php if ($data) { ?>
        data = <?php echo json_encode($data); ?>;
    <?php } ?>

    function base64Convert() {
        var c = document.createElement('canvas');
        var img = document.getElementById('gambar_partograf');
        c.height = img.naturalHeight;
        c.width = img.naturalWidth;
        var ctx = c.getContext('2d');

        ctx.drawImage(img, 0, 0, c.width, c.height);
        var base64String = c.toDataURL();
        return base64String;
    }

    let kontraksi = <?php echo $data ? isset($data->kontraksi) ? $data->kontraksi : '[[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ]]' : '[[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ],[
    [],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]
    ]]' ?>;

    function set_kontraksi(value, x, y) {
        let base_url = '{{ url("/") }}';
        kontraksi[x][y] = value.replace(base_url.replace('index.php', '') + 'images/', '');
    }

    $(document).ready(function() {
        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            var optionWithImage = $(
                '<span><img src="' + option.id + '" class="img-flag" style="width:30px; height:15px;" /> ' + option.text + '</span>'
            );
            return optionWithImage;
        }

        // Add options dynamically
        var options = [{
                id: '',
                text: ''
            },
            {
                id: '{{ asset("images/kotak_penuh.png") }}',
                text: ''
            },
            {
                id: '{{ asset("images/arsir.png") }}',
                text: ''
            },
            {
                id: '{{ asset("images/kotak.png") }}',
                text: ''
            }
        ];

        $('.pilihan_kontraksi').select2({
            templateResult: formatOption,
            templateSelection: formatOption,
            data: options,
            minimumResultsForSearch: Infinity
        });

        for (let i = 0; i < 5; i++) {
            for (let j = 0; j < 16; j++) {
                if (kontraksi[i] != undefined) {
                    if (kontraksi[i][j] != undefined) {
                        let base_url = '{{ url("/") }}';
                        $('#kontraksi_' + i + '_' + j).val('{{ asset("images") }}/' + kontraksi[i][j]).trigger('change');
                    }
                }
            }
        }
    })

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        let kala_i = {
            'melewati_garis': $('[name=melewati_garis]:checked').val() != undefined ? $('[name=melewati_garis]:checked').val() : '',
            'masalah': $('#masalah_lain_kala_i').val(),
            'penatalaksanaan_masalah': $('#penatalaksanaan_masalah_kala_i').val(),
            'hasil': $('#hasil_kala_i').val()
        };

        let kala_ii = {
            'episiotomi': {
                'value': $('[name=episiotomi]:checked').val() != undefined ? $('[name=episiotomi]:checked').val() : '',
                'indikasi': $('#indikasi_episiotomi').val()
            },
            'pendamping': $('[name=pendamping_persalinan]:checked').val() != undefined ? $('[name=pendamping_persalinan]:checked').val() : '',
            'gawat_janin': {
                'value': $('[name=gawat_janin]:checked').val() != undefined ? $('[name=gawat_janin]:checked').val() : '',
                'tindakan': [
                    $('#tindakan_gawat_janin_1').val(),
                    $('#tindakan_gawat_janin_2').val(),
                    $('#tindakan_gawat_janin_3').val()
                ]
            },
            'distosia_bahu': {
                'value': $('[name=distosia_bahu]:checked').val() != undefined ? $('[name=distosia_bahu]:checked').val() : '',
                'tindakan': [
                    $('#tindakan_distosia_bahu_1').val(),
                    $('#tindakan_distosia_bahu_2').val(),
                    $('#tindakan_distosia_bahu_3').val()
                ]
            },
            'masalah': $('#masalah_lain_kala_ii').val(),
            'penatalaksanaan_masalah': $('#penatalaksanaan_masalah_kala_ii').val(),
            'hasil': $('#hasil_kala_ii').val()
        };

        let kala_iii = {
            'lama': $('#lama_kala_iii').val(),
            'oisitosin': {
                'value': $('[name=pemberian_oisitosin]:checked').val() != undefined ? $('[name=pemberian_oisitosin]:checked').val() : '',
                'waktu': $('#waktu_oisitosin').val(),
                'alasan': $('#alasan_oisitosin').val()
            },
            'oksitosin': {
                'value': $('[name=pemberian_oksitosin]:checked').val() != undefined ? $('[name=pemberian_oksitosin]:checked').val() : '',
                'alasan': $('#alasan_oksitosin').val()
            },
            'penegangan_tali_pusar': {
                'value': $('[name=penegangan_tali_pusar]:checked').val() != undefined ? $('[name=penegangan_tali_pusar]:checked').val() : '',
                'alasan': $('#alasan_penegangan_tali_pusar').val()
            },
            'masase_fundus_uteri': {
                'value': $('[name=masase_fundus_uteri]:checked').val() != undefined ? $('[name=masase_fundus_uteri]:checked').val() : '',
                'alasan': $('#alasan_masase_fundus_uteri').val()
            },
            'intact': {
                'value': $('[name=intact]:checked').val() != undefined ? $('[name=intact]:checked').val() : '',
                'tindakan': [
                    $('#tindakan_intact_1').val(),
                    $('#tindakan_intact_2').val()
                ]
            },
            'plasenta_tidak_lahir': {
                'value': $('[name=plasenta_tidak_lahir]:checked').val() != undefined ? $('[name=plasenta_tidak_lahir]:checked').val() : '',
                'tindakan': [
                    $('#tindakan_plasenta_tidak_lahir_1').val(),
                    $('#tindakan_plasenta_tidak_lahir_2').val(),
                    $('#tindakan_plasenta_tidak_lahir_3').val()
                ]
            },
            'laserasi': {
                'value': $('[name=laserasi]:checked').val() != undefined ? $('[name=laserasi]:checked').val() : '',
                'tempat': $('#tempat_laserasi').val()
            },
            'laserasi_perineum': {
                'value': $('[name=laserasi_perineum]:checked').val() != undefined ? $('[name=laserasi_perineum]:checked').val() : '',
                'tindakan': $('#penjahitan').is(':checked') ? $('#penjahitan').val() : $('#tidak_dijahit').is(':checked') ? $('#tidak_dijahit').val() : '',
                'penjahitan': $('#anestesi').is(':checked') ? $('#anestesi').val() : $('#tanpa_anestesi').is(':checked') ? $('#tanpa_anestesi').val() : '',
                'alasan': $('#alasan_tindakan_laserasi_perineum').val()
            },
            'atoni_uteri': {
                'value': $('[name=atoni_uteri]:checked').val() != undefined ? $('[name=atoni_uteri]:checked').val() : '',
                'tindakan': [
                    $('#tindakan_atoni_uteri_1').val(),
                    $('#tindakan_atoni_uteri_2').val(),
                    $('#tindakan_atoni_uteri_3').val()
                ]
            },
            'jumlah_pendarahan': $('#jumlah_pendarahan').val(),
            'masalah': $('#masalah_lain_kala_iii').val(),
            'penatalaksanaan_masalah': $('#penatalaksanaan_masalah_kala_iii').val(),
            'hasil': $('#hasil_kala_iii').val(),
        };

        let bayi_baru_lahir = {
            'berat_badan': $('#berat_badan').val(),
            'panjang': $('#panjang').val(),
            'kelamin': $('[name=jenis_kelamin]:checked').val() != undefined ? $('[name=jenis_kelamin]:checked').val() : '',
            'penilaian': $('[name=penilaian]:checked').val() != undefined ? $('[name=penilaian]:checked').val() : '',
            'bayi_lahir': {
                'value': $('[name=bayi_lahir]:checked').val() != undefined ? $('[name=bayi_lahir]:checked').val() : '',
                'lahir_normal': $('[name=bayi_lahir_normal]:checked').val() != undefined ? $('[name=bayi_lahir_normal]:checked').val() : '',
                'aspiksia': $('[name=bayi_lahir_aspiksia]:checked').val() != undefined ? $('[name=bayi_lahir_aspiksia]:checked').val() : '',
                'aspiksia_input': $('#bayi_lahir_aspiksia_input').val(),
                'cacat': $('#cacat_bawaan').val(),
                'tindakan_hipotemi': [
                    $('#tindakan_hipotemi_1').val(),
                    $('#tindakan_hipotemi_2').val(),
                    $('#tindakan_hipotemi_3').val()
                ]
            },
            'pemberian_asi': {
                'value': $('[name=pemberian_asi]:checked').val() != undefined ? $('[name=pemberian_asi]:checked').val() : '',
                'waktu': $('#waktu_pemberian_asi').val(),
                'alasan': $('#alasan_pemberian_asi').val(),
            },
            'masalah': $('#masalah_lain_bayi_baru_lahir').val(),
            'hasil': $('#hasil_bayi_baru_lahir').val()
        };

        let kala_iv = {
            'pemantauan': [{
                'jam_ke': 1,
                'waktu': $('#waktu_pemantauan_1_jam_ke_satu').val(),
                'tekanan_darah': $('#tekanan_darah_pemantauan_1_jam_ke_satu').val(),
                'nadi': $('#nadi_pemantauan_1_jam_ke_satu').val(),
                'tinggi_fundus': $('#tinggi_fundus_pemantauan_1_jam_ke_satu').val(),
                'kontraksi_uterus': $('#kontraksi_uterus_pemantauan_1_jam_ke_satu').val(),
                'kandung_kemih': $('#kandung_kemih_pemantauan_1_jam_ke_satu').val(),
                'pendarahan': $('#pendarahan_pemantauan_1_jam_ke_satu').val(),
            }, {
                'jam_ke': 1,
                'waktu': $('#waktu_pemantauan_2_jam_ke_satu').val(),
                'tekanan_darah': $('#tekanan_darah_pemantauan_2_jam_ke_satu').val(),
                'nadi': $('#nadi_pemantauan_2_jam_ke_satu').val(),
                'tinggi_fundus': $('#tinggi_fundus_pemantauan_2_jam_ke_satu').val(),
                'kontraksi_uterus': $('#kontraksi_uterus_pemantauan_2_jam_ke_satu').val(),
                'kandung_kemih': $('#kandung_kemih_pemantauan_2_jam_ke_satu').val(),
                'pendarahan': $('#pendarahan_pemantauan_2_jam_ke_satu').val(),
            }, {
                'jam_ke': 1,
                'waktu': $('#waktu_pemantauan_3_jam_ke_satu').val(),
                'tekanan_darah': $('#tekanan_darah_pemantauan_3_jam_ke_satu').val(),
                'nadi': $('#nadi_pemantauan_3_jam_ke_satu').val(),
                'tinggi_fundus': $('#tinggi_fundus_pemantauan_3_jam_ke_satu').val(),
                'kontraksi_uterus': $('#kontraksi_uterus_pemantauan_3_jam_ke_satu').val(),
                'kandung_kemih': $('#kandung_kemih_pemantauan_3_jam_ke_satu').val(),
                'pendarahan': $('#pendarahan_pemantauan_3_jam_ke_satu').val(),
            }, {
                'jam_ke': 1,
                'waktu': $('#waktu_pemantauan_4_jam_ke_satu').val(),
                'tekanan_darah': $('#tekanan_darah_pemantauan_4_jam_ke_satu').val(),
                'nadi': $('#nadi_pemantauan_4_jam_ke_satu').val(),
                'tinggi_fundus': $('#tinggi_fundus_pemantauan_4_jam_ke_satu').val(),
                'kontraksi_uterus': $('#kontraksi_uterus_pemantauan_4_jam_ke_satu').val(),
                'kandung_kemih': $('#kandung_kemih_pemantauan_4_jam_ke_satu').val(),
                'pendarahan': $('#pendarahan_pemantauan_4_jam_ke_satu').val(),
            }, {
                'jam_ke': 2,
                'waktu': $('#waktu_pemantauan_1_jam_ke_dua').val(),
                'tekanan_darah': $('#tekanan_darah_pemantauan_1_jam_ke_dua').val(),
                'nadi': $('#nadi_pemantauan_1_jam_ke_dua').val(),
                'tinggi_fundus': $('#tinggi_fundus_pemantauan_1_jam_ke_dua').val(),
                'kontraksi_uterus': $('#kontraksi_uterus_pemantauan_1_jam_ke_dua').val(),
                'kandung_kemih': $('#kandung_kemih_pemantauan_1_jam_ke_dua').val(),
                'pendarahan': $('#pendarahan_pemantauan_1_jam_ke_dua').val(),
            }, {
                'jam_ke': 2,
                'waktu': $('#waktu_pemantauan_2_jam_ke_dua').val(),
                'tekanan_darah': $('#tekanan_darah_pemantauan_2_jam_ke_dua').val(),
                'nadi': $('#nadi_pemantauan_2_jam_ke_dua').val(),
                'tinggi_fundus': $('#tinggi_fundus_pemantauan_2_jam_ke_dua').val(),
                'kontraksi_uterus': $('#kontraksi_uterus_pemantauan_2_jam_ke_dua').val(),
                'kandung_kemih': $('#kandung_kemih_pemantauan_2_jam_ke_dua').val(),
                'pendarahan': $('#pendarahan_pemantauan_2_jam_ke_dua').val(),
            }],
            'masalah': $('#masalah_kala_iv').val(),
            'penatalaksanaan_masalah': $('#penatalaksanaan_masalah_kala_iv').val(),
            'hasil': $('#hasil_kala_iv').val(),
        };

        let ketuban = [];
        let penyusupan = [];
        let oksilosin = [];
        let tetes_menit = [];
        let suhu = [];
        let urin = [];

        for (let i = 0; i < 16; i++) {
            ketuban[i] = $('#ketuban_' + i).val();
        }

        for (let i = 0; i < 16; i++) {
            penyusupan[i] = $('#penyusupan_' + i).val();
        }

        for (let i = 0; i < 16; i++) {
            oksilosin[i] = $('#oksilosin_' + i).val();
        }

        for (let i = 0; i < 16; i++) {
            tetes_menit[i] = $('#tetes_menit_' + i).val();
        }

        for (let i = 0; i < 16; i++) {
            suhu[i] = $('#suhu_' + i).val();
        }

        for (let i = 0; i < 16; i++) {
            urin.push({
                protein : $('#urin_protein_' + i).val(),
                aseton : $('#urin_aseton_' + i).val(),
                volume : $('#urin_volume_' + i).val(),
            });
        }

        $('#kala_i').val(JSON.stringify(kala_i));
        $('#kala_ii').val(JSON.stringify(kala_ii));
        $('#kala_iii').val(JSON.stringify(kala_iii));
        $('#kala_iv').val(JSON.stringify(kala_iv));
        $('#ketuban').val(JSON.stringify(ketuban));
        $('#penyusupan').val(JSON.stringify(penyusupan));
        $('#oksilosin').val(JSON.stringify(oksilosin));
        $('#tetes_menit').val(JSON.stringify(tetes_menit));
        $('#suhu').val(JSON.stringify(suhu));
        $('#urin').val(JSON.stringify(urin));
        $('#bayi_baru_lahir').val(JSON.stringify(bayi_baru_lahir));
        $('#denyut_jantung_janin').val(JSON.stringify(data_denyut_jantung_janin));
        $('#pembukaan_serviks').val(JSON.stringify(data_pembukaan_serviks));
        $('#obat_dan_cairan').val(JSON.stringify(data_obat_dan_cairan));
        $('#kontraksi').val(JSON.stringify(kontraksi));

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/dokumen_partograf/store') }}",
            method: 'post',
            data: $('#form_dokumen').serialize(),
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                    return;
                }
                toastr.error(response.message);
            }
        })
    })

    function open_modal_bidan() {
        if ($.fn.DataTable.isDataTable("#tabel_bidan")) {
            $('#tabel_bidan').DataTable().clear().destroy();
        }

        $('#tabel_bidan').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("ajax_request/datatable_bidan") }}', // memanggil route yang menampilkan data json
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama',
                    name: 'nama',
                    render: function(data, type, row, meta) {
                        return "<div class='text-center'><button class='btn btn-dark' type='button' onclick='set_bidan(" + '"' + row.ud + '","' + data + '"' + ")'><i class='fa fa-check'></i></button></div>"
                    }
                }
            ]
        });

        $('#modal_bidan').modal('show');
    }

    function set_bidan(id, nama) {
        $('[name=id_bidan]').val(id);
        $('[name=nama_bidan]').val(nama);
        $('#modal_bidan').modal('hide');
    }
</script>

<script>
    let data_denyut_jantung_janin = <?php echo $data ? isset($data->denyut_jantung_janin) ? $data->denyut_jantung_janin :
                                        "[{ waktu: '', value: null },{ waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null },{ waktu: '', value: null },{ waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }]" :
                                        "[{ waktu: '', value: null },{ waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null },{ waktu: '', value: null },{ waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }, { waktu: '', value: null }]" ?>;

    let arr_denyut_jantung_janin = data_denyut_jantung_janin.map(a => a.value);
    let arr_waktu_denyut_jangtung_janin = data_denyut_jantung_janin.map(a => a.waktu);

    const chart_denyut_jantung_janin = document.getElementById('chart_denyut_jantung_janin')
    var objChartDenyutJantungJanin = new Chart(chart_denyut_jantung_janin, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: true,
        legend: {
            display: false
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true
                    },
                    ticks: {
                        display: true,
                    },
                    grid: {
                        display: true,
                        color : function(context){
                            return '#111';
                        }
                    },
                    min: 0,
                    max: 16,
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                    },
                    grid: {
                        display: true,
                        color : function(context){
                            return '#111';
                        }
                    },
                    min: 80,
                    max: 200,
                    ticks: {
                        stepSize: 10,
                        display: true,
                        font: {
                            size: 16
                        }
                    },
                    afterFit: function(scale) {
                        scale.marginBottom = 400 //<-- set value as you wish 
                    },
                }
            }
        },
        data: {
            labels: arr_waktu_denyut_jangtung_janin,
            datasets: [{
                backgroundColor: 'green',
                borderColor: 'green',
                data: arr_denyut_jantung_janin,
                label: '',
                fill: 'green',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    function open_form_denyut_jantung_janin(index) {
        $('#index_denyut_jantung_janin').val(index);
        $('#waktu_denyut_jantung_janin').val(data_denyut_jantung_janin[index] != undefined ? data_denyut_jantung_janin[index].waktu : '');
        $('#value_denyut_jantung_janin').val(data_denyut_jantung_janin[index] != undefined ? data_denyut_jantung_janin[index].value : '');
        $('#modalDenyutJantungJanin').modal('show');
    }

    $('#form_denyut_jantung_janin').submit(function(e) {
        e.preventDefault();
        data_denyut_jantung_janin[$('#index_denyut_jantung_janin').val()] = {
            waktu: $('#waktu_denyut_jantung_janin').val(),
            value: $('#value_denyut_jantung_janin').val(),
        };
        $('#btn_denyut_jantung_janin_' + $('#index_denyut_jantung_janin').val()).html($('#waktu_denyut_jantung_janin').val());
        $('#modalDenyutJantungJanin').modal('hide');
        $('#form_dokumen').submit();
        arr_denyut_jantung_janin = data_denyut_jantung_janin.map(a => a.value);
        arr_waktu_denyut_jangtung_janin = data_denyut_jantung_janin.map(a => a.waktu);
        objChartDenyutJantungJanin.data.labels = arr_waktu_denyut_jangtung_janin;
        objChartDenyutJantungJanin.data.datasets[0].data = arr_denyut_jantung_janin;
        objChartDenyutJantungJanin.update();
    })
</script>

<script>
    let data_pembukaan_serviks = <?php echo $data ? isset($data->pembukaan_serviks) ? $data->pembukaan_serviks :
                                        "[{ waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null },{ waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }]" :
                                        "[{ waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null },{ waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }, { waktu: '', value_satu: null, value_dua: null, 'value_turun_kepala_satu': null, 'value_turun_kepala_dua':null }]" ?>;

    let arr_pembukaan_serviks_satu = data_pembukaan_serviks.map(a => a.value_satu);
    let arr_pembukaan_serviks_dua = data_pembukaan_serviks.map(a => a.value_dua);
    let arr_turun_kepala_satu = data_pembukaan_serviks.map(a => a.value_turun_kepala_satu);
    let arr_turun_kepala_dua = data_pembukaan_serviks.map(a => a.value_turun_kepala_dua);
    let arr_waktu_pembukaan_serviks = data_pembukaan_serviks.map(a => a.waktu);

    let result_arr = [];
    let result_arr_turun_kepala = [];
    let result_waktu_pembukaan_serviks = [];

    for (var i = 0; i < 16; i++) {
        result_arr.push(arr_pembukaan_serviks_satu[i]);
        result_arr.push(arr_pembukaan_serviks_dua[i]);

        result_arr_turun_kepala.push(arr_turun_kepala_satu[i]);
        result_arr_turun_kepala.push(arr_turun_kepala_dua[i]);

        result_waktu_pembukaan_serviks.push(arr_waktu_pembukaan_serviks[i]);
        result_waktu_pembukaan_serviks.push('');
    }

    const chart_pembukaan_serviks = document.getElementById('chart_pembukaan_serviks')
    var objChartPembukaanServiks = new Chart(chart_pembukaan_serviks, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: true,
        legend: {
            display: true
        },
        options: {
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true
                    },
                    ticks: {
                        display: true,
                        padding : 15
                    },
                    grid: {
                        display: true,
                        color : function(context){
                            return '#111';
                        }
                    },
                    min: 0,
                    max: 32,
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                    },
                    grid: {
                        display: true,
                        color : function(context){
                            return '#111';
                        }
                    },
                    min: 0,
                    max: 10,
                    ticks: {
                        stepSize: 1,
                        display: true,
                        font: {
                            size: 14
                        }
                    },
                    afterFit: function(scale) {
                        scale.marginBottom = 400 //<-- set value as you wish 
                    },
                }
            }
        },
        data: {
            labels: result_waktu_pembukaan_serviks,
            datasets: [{
                backgroundColor: 'green',
                borderColor: 'green',
                data: result_arr,
                label: 'PEMBUKAAN SERVIKS',
                fill: 'green',
                borderWidth: 3,
                pointRadius: 5
            },{
                backgroundColor: 'red',
                borderColor: 'red',
                data: result_arr_turun_kepala,
                label: 'TURUNNYA KEPALA',
                fill: 'red',
                borderWidth: 3,
                pointRadius: 5
            },{
                backgroundColor: 'black',
                borderColor: 'black',
                data: [4,null,5,null,6,null,7,null,8,null,9,null,10],
                label: 'WASPADA',
                fill: 'red',
                borderWidth: 3,
                pointRadius: 5,
                spanGaps: true
            },{
                backgroundColor: 'black',
                borderColor: 'black',
                data: [null,null,null,null,null,null,null,null,4,null,5,null,6,null,7,null,8,null,9,null,10],
                label: 'BERTINDAK',
                fill: 'red',
                borderWidth: 3,
                pointRadius: 5,
                spanGaps: true
            }]
        }
    });

    function open_form_pembukaan_serviks(index) {
        console.log(index);
        $('#index_pembukaan_serviks').val(index);
        $('#waktu_pembukaan_serviks').val(data_pembukaan_serviks[index] != undefined ? data_pembukaan_serviks[index].waktu : '');
        $('#value_pembukaan_serviks_satu').val(data_pembukaan_serviks[index] != undefined ? data_pembukaan_serviks[index].value_satu : '');
        $('#value_pembukaan_serviks_dua').val(data_pembukaan_serviks[index] != undefined ? data_pembukaan_serviks[index].value_dua : '');
        $('#value_turun_kepala_satu').val(data_pembukaan_serviks[index] != undefined ? data_pembukaan_serviks[index].value_turun_kepala_satu : '');
        $('#value_turun_kepala_dua').val(data_pembukaan_serviks[index] != undefined ? data_pembukaan_serviks[index].value_turun_kepala_dua : '');
        $('#modalServiks').modal('show');
    }

    $('#form_pembukaan_serviks').submit(function(e) {
        e.preventDefault();
        data_pembukaan_serviks[$('#index_pembukaan_serviks').val()] = {
            waktu: $('#waktu_pembukaan_serviks').val(),
            value_satu: $('#value_pembukaan_serviks_satu').val(),
            value_dua: $('#value_pembukaan_serviks_dua').val(),
            value_turun_kepala_satu: $('#value_turun_kepala_satu').val(),
            value_turun_kepala_dua: $('#value_turun_kepala_dua').val(),
        };
        $('#btn_pembukaan_serviks_' + $('#index_pembukaan_serviks').val()).html($('#waktu_pembukaan_serviks').val());
        $('#modalServiks').modal('hide');
        $('#form_dokumen').submit();

        arr_pembukaan_serviks_satu = data_pembukaan_serviks.map(a => a.value_satu);
        arr_pembukaan_serviks_dua = data_pembukaan_serviks.map(a => a.value_dua);
        arr_turun_kepala_satu = data_pembukaan_serviks.map(a => a.value_turun_kepala_satu);
        arr_turun_kepala_dua = data_pembukaan_serviks.map(a => a.value_turun_kepala_dua);
        arr_waktu_pembukaan_serviks = data_pembukaan_serviks.map(a => a.waktu);

        let result_arr = [];
        let result_arr_turun_kepala = [];
        let result_waktu_pembukaan_serviks = [];

        for (var i = 0; i < 16; i++) {
            result_arr.push(arr_pembukaan_serviks_satu[i]);
            result_arr.push(arr_pembukaan_serviks_dua[i]);

            result_arr_turun_kepala.push(arr_turun_kepala_satu[i]);
            result_arr_turun_kepala.push(arr_turun_kepala_dua[i]);

            result_waktu_pembukaan_serviks.push(arr_waktu_pembukaan_serviks[i]);
            result_waktu_pembukaan_serviks.push('');
        }

        objChartPembukaanServiks.data.datasets[0].data = result_arr;
        objChartPembukaanServiks.data.datasets[1].data = result_arr_turun_kepala;
        objChartPembukaanServiks.data.labels = result_waktu_pembukaan_serviks;
        objChartPembukaanServiks.update();
    })
</script>

<script>
    let data_obat_dan_cairan = <?php echo $data ? isset($data->obat_dan_cairan) ? $data->obat_dan_cairan :
                                    "[{ value: '', nadi: null, tekanan_darah:null },{ value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }]" :
                                    "[{ value: '', nadi: null, tekanan_darah:null },{ value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }, { value: '', nadi: null, tekanan_darah:null }]" ?>;

    let arr_nadi = data_obat_dan_cairan.map(a => a.nadi);
    let arr_tekanan_darah = data_obat_dan_cairan.map(a => a.tekanan_darah);

    const chart_tekanan_darah = document.getElementById('chart_tekanan_darah')
    var objChartTekananDarah = new Chart(chart_tekanan_darah, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: true,
        legend: {
            display: false
        },
        options: {
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true
                    },
                    ticks: {
                        display: true
                    },
                    grid: {
                        display: true,
                        color : function(context){
                            return '#111';
                        }
                    },
                    min: 0,
                    max: 16,
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                    },
                    grid: {
                        display: true,
                        color : function(context){
                            return '#111';
                        }
                    },
                    min: 60,
                    max: 180,
                    ticks: {
                        stepSize: 10,
                        display: true,
                        font: {
                            size: 14
                        }
                    },
                    afterFit: function(scale) {
                        scale.marginBottom = 400 //<-- set value as you wish 
                    },
                }
            }
        },
        data: {
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            datasets: [{
                backgroundColor: 'green',
                borderColor: 'green',
                data: arr_tekanan_darah,
                label: 'TEKANAN DARAH',
                fill: 'green',
                borderWidth: 3,
                pointRadius: 5
            },{
                backgroundColor: 'red',
                borderColor: 'red',
                data: arr_nadi,
                label: 'NADI',
                fill: 'red',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    function open_form_obat_dan_cairan(index) {
        $('#index_obat_dan_cairan').val(index);
        $('#value_obat_dan_cairan').val(data_obat_dan_cairan[index] != undefined ? data_obat_dan_cairan[index].value : '');
        $('#nadi_obat_dan_cairan').val(data_obat_dan_cairan[index] != undefined ? data_obat_dan_cairan[index].nadi : '');
        $('#tekanan_darah_obat_dan_cairan').val(data_obat_dan_cairan[index] != undefined ? data_obat_dan_cairan[index].tekanan_darah : '');
        $('#modalObatDanCairan').modal('show');
    }

    $('#form_obat_dan_cairan').submit(function(e) {
        e.preventDefault();
        data_obat_dan_cairan[$('#index_obat_dan_cairan').val()] = {
            value: $('#value_obat_dan_cairan').val(),
            nadi: $('#nadi_obat_dan_cairan').val(),
            tekanan_darah: $('#tekanan_darah_obat_dan_cairan').val(),
        };
        $('#btn_obat_dan_cairan_' + $('#index_obat_dan_cairan').val()).html($('#value_obat_dan_cairan').val());
        $('#modalObatDanCairan').modal('hide');
        $('#form_dokumen').submit();
        arr_nadi = data_obat_dan_cairan.map(a => a.nadi);
        arr_tekanan_darah = data_obat_dan_cairan.map(a => a.tekanan_darah);

        objChartTekananDarah.data.datasets[0].data = arr_tekanan_darah;
        objChartTekananDarah.data.datasets[1].data = arr_nadi;
        objChartTekananDarah.update();
    })
</script>

</html>