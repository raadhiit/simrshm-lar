<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesmen Pasien Terminal</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .pagebreak {
            page-break-after: always;
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
            width: 20%;
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

        .table-main tr td {
            border: 1px solid;
            padding: 5px
        }

        .table-main tr th {
            border: 1px solid
        }

        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
            cursor: pointer;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>
    @if(Session::has('success'))
    <script>
        alert('{{ Session::get("success") }}')
    </script>
    @endif
    @if(Session::has('gagal'))
    <script>
        alert('{{ Session::get("gagal") }}')
    </script>
    @endif
    <div class="container">
        <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" onsubmit="return cek_form(this)" action="{{ url('e_rekam_medis/detail/save_asesmen_pasien_terminal') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" id="hide_tgl_pengkajian" name="tgl_pengkajian">
                        <input type="hidden" id="hide_informasi" name="informasi">
                        <input type="hidden" id="hide_hubungan" name="hubungan">
                        <input type="hidden" id="hide_ket_tonus_otot" name="ket_tonus_otot">
                        <input type="hidden" id="hide_ket_checkbox4" name="ket_checkbox4">
                        <input type="hidden" id="hide_ket_orientasi_spiritual" name="ket_orientasi_spiritual">
                        <input type="hidden" id="hide_nama_keluarga" name="nama_keluarga">
                        <input type="hidden" id="hide_hubungan_keluarga" name="hubungan_keluarga">
                        <input type="hidden" id="hide_dimana" name="dimana">
                        <input type="hidden" id="hide_telp" name="telp">
                        <input type="hidden" id="hide_ket_mampu_merawat" name="ket_mampu_merawat">
                        <input type="hidden" id="hide_ket_checkbox9" name="ket_checkbox9">
                        <input type="hidden" id="hide_donasi_organ" name="donasi_organ">
                        <input type="hidden" id="hide_checkbox1" name="checkbox1">
                        <input type="hidden" id="hide_checkbox2" name="checkbox2">
                        <input type="hidden" id="hide_checkbox3" name="checkbox3">
                        <input type="hidden" id="hide_checkbox4" name="checkbox4">
                        <input type="hidden" id="hide_checkbox5" name="checkbox5">
                        <input type="hidden" id="hide_checkbox6" name="checkbox6">
                        <input type="hidden" id="hide_checkbox7" name="checkbox7">
                        <input type="hidden" id="hide_checkbox8" name="checkbox8">
                        <input type="hidden" id="hide_checkbox9" name="checkbox9">
                        <input type="hidden" id="hide_checkbox10" name="checkbox10">
                        <input type="hidden" id="hide_checkbox11" name="checkbox11">
                        <input type="hidden" id="hide_checkbox12" name="checkbox12">
                        <input type="hidden" id="hide_tonus_otot" name="tonus_otot">
                        <input type="hidden" id="hide_orientasi_spiritual" name="orientasi_spiritual">
                        <input type="hidden" id="hide_perlu_didoakan" name="perlu_didoakan">
                        <input type="hidden" id="hide_perlu_bimbingan" name="perlu_bimbingan">
                        <input type="hidden" id="hide_pendampingan_rohani" name="pendampingan_rohani">
                        <input type="hidden" id="hide_keluarga" name="keluarga">
                        <input type="hidden" id="hide_penyiapan_lingkungan" name="penyiapan_lingkungan">
                        <input type="hidden" id="hide_mampu_merawat" name="mampu_merawat">
                        <input type="hidden" id="hide_homecare" name="homecare">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Password :</label>
                                <input type="password" name="pass" placeholder="Input your password" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_petugas2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ url('e_rekam_medis/detail/verifikasi_asesmen_pasien_terminal') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Password :</label>
                                <input type="password" name="pass" placeholder="Input your password" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-0 custom-table" style="width: 100%">
                    <tr>
                        <th colspan="2" style="width: 33%">
                            <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="" id="logo_rshm">
                            <p style="font-weight: bold; font-size: 12px;">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya, Kec. Cibarusah<br>
                                Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
            </div>
            </th>
            <th colspan="2" style="text-align: center; padding-top: 20px; width: 33%">
                PENGKAJIAN AWAL PASIEN <br> MENJELANG AKHIR HAYAT <br> (PASIEN TERMINAL)
            </th>
            <th colspan="2" style="width: 33%">
                <table style="width: 100%; border: hidden">
                    <tr style="border: hidden">
                        <td style="width: 40%; padding: 0px; border: hidden">No. RM <span style="float: right">:</span></td>
                        <td style="width: 60%; padding: 0px; border: hidden">
                            <input type="text" readonly style="border: 0; border-bottom: 2px dotted;" value="{{ $pasien->id }}">
                        </td>
                    </tr>
                    <tr style="border: hidden">
                        <td style="width: 40%; padding: 0px; border: hidden">Nama <span style="float: right">:</span></td>
                        <td style="width: 60%; padding: 0px; border: hidden">
                            <input type="text" readonly style="border: 0; border-bottom: 2px dotted;" value="{{ $pasien->nama }}">
                        </td>
                    </tr>
                    <tr style="border: hidden">
                        <td style="width: 40%; padding: 0px; border: hidden">Tgl Lahir <span style="float: right">:</span></td>
                        <td style="width: 60%; padding: 0px; border: hidden">
                            <input type="text" readonly style="border: 0; border-bottom: 2px dotted;" value="{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}">
                        </td>
                    </tr>
                    <tr style="border: hidden">
                        <td style="width: 40%; padding: 0px; border: hidden">Kelamin <span style="float: right">:</span></td>
                        <td style="width: 60%; padding: 0px; border: hidden">
                            <input type="text" readonly style="border: 0; border-bottom: 2px dotted;" value="{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}">
                        </td>
                    </tr>
                    <tr style="border: hidden">
                        <td style="width: 40%; padding: 0px; border: hidden">Nama <span style="float: right">:</span></td>
                        <td style="width: 60%; padding: 0px; border: hidden">
                            <input type="text" readonly style="border: 0; border-bottom: 2px dotted;" value="{{ $pasien->ktp }}">
                        </td>
                    </tr>
                </table>
            </th>
            </tr>
            <tr>
                <td colspan="6">
                    <table style="width: 100%; border: hidden">
                        <tr style="border: hidden">
                            <td style="width: 25%; padding: 0px; border: hidden">Tanggal Pengkajian <span style="float: right">:</span></td>
                            <td style="width: 75%; padding: 0px; border: hidden">
                                <input type="text" id="tgl_pengkajian" class="tanggal_dmy" style="border: 0; border-bottom: 2px dotted; width: 100%" value="{{ $data ? date('d-m-Y', strtotime($data->tgl_pengkajian)) : date('d-m-Y') }}">
                            </td>
                        </tr>
                        <tr style="border: hidden">
                            <td style="width: 25%; padding: 0px; border: hidden">Informasi diperoleh dari <span style="float: right">:</span></td>
                            <td style="width: 75%; padding: 0px; border: hidden">
                                <input type="text" id="informasi" style="border: 0; border-bottom: 2px dotted; width: 100%" value="{{ $data ? $data->informasi : '' }}">
                            </td>
                        </tr>
                        <tr style="border: hidden">
                            <td style="width: 25%; padding: 0px; border: hidden">Hubungan dengan pasien <span style="float: right">:</span></td>
                            <td style="width: 75%; padding: 0px; border: hidden">
                                <input type="text" id="hubungan" style="border: 0; border-bottom: 2px dotted; width: 100%" value="{{ $data ? $data->hubungan : '' }}">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="text-indent: 5px;">
                <td colspan="6">
                    <span style="font-weight: bold">1. Gejala mual dan kesulitan bernafas <br></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">1.1 Kegawatan Pernafasan </span>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="satu" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('satu', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> Dyspnoe &nbsp;&nbsp; <input type="checkbox" value="empat" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('empat', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> Nafas cepat dan dangkal &nbsp;&nbsp; <input type="checkbox" value="tujuh" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('tujuh', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> Nafas lambat <br>
                    </div>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="dua" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('dua', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> Nafas tak teratur &nbsp;&nbsp; <input type="checkbox" value="lima" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('lima', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> Nafas melalui mulut&nbsp;&nbsp; <input type="checkbox" value="delapan" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('delapan', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> Mukosa oral kering<br>
                    </div>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="tiga" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('tiga', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> Ada sekret &nbsp;&nbsp; <input type="checkbox" value="enam" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('enam', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> SpO2 < normal &nbsp;&nbsp; <input type="checkbox" value="sembilan" name="checkbox1" {{ $data ? is_array(json_decode($data->checkbox1)) ? (in_array('sembilan', json_decode($data->checkbox1)) ? 'checked' : '') : '' : '' }}> TAK
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">1.2 Kehilangan Tonus otot </span>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="satu" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('satu', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> Mual &nbsp;&nbsp; <input type="checkbox" value="empat" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('empat', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> Penurunan Pergeraka Tubuh &nbsp;&nbsp; <input type="checkbox" value="tujuh" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('tujuh', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> Sulit berbicara <br>
                    </div>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="dua" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('dua', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> Sulit menelan &nbsp;&nbsp; <input type="checkbox" value="lima" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('lima', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> Distensi Abdomen&nbsp;&nbsp; <input type="checkbox" value="delapan" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('delapan', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> Inkontinensia Urine<br>
                    </div>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="tiga" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('tiga', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> Inkontinensia alvi &nbsp;&nbsp; <input type="checkbox" value="enam" name="checkbox2" {{ $data ? is_array(json_decode($data->checkbox2)) ? (in_array('enam', json_decode($data->checkbox2)) ? 'checked' : '') : '' : '' }}> TAK
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">1.3 Kehilangan Tonus otot </span>
                    <div style="text-indent: 45px;">
                        <input type="radio" value="Tidak" name="radio_tonus_otot" {{ $data ? ($data->tonus_otot == "Tidak" ? 'checked' : '') : '' }}> Tidak
                        &nbsp;&nbsp; <input type="radio" value="Ya" name="radio_tonus_otot" {{ $data ? ($data->tonus_otot == "Ya" ? 'checked' : '') : '' }}> Ya
                        <input type="text" id="ket_tonus_otot" style="border: 0; border-bottom: 2px dotted;" value="{{ $data ? $data->ket_tonus_otot : '' }}" {{ $data ? ($data->tonus_otot == "Ya" ? '' : 'readonly') : 'readonly' }}>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">1.4 Perlambatan Sirkulasi </span>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox3)) ? (in_array('satu', json_decode($data->checkbox3)) ? 'checked' : '' ) : '' : '' }} value="satu" name="checkbox3"> Bercak dan sianosis pada ekstremitas &nbsp;&nbsp; <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox3)) ? (in_array('empat', json_decode($data->checkbox3)) ? 'checked' : '') : '' : '' }} value="empat" name="checkbox3"> Kulit dingin dan berkeringat &nbsp;&nbsp;
                    </div>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox3)) ? (in_array('dua', json_decode($data->checkbox3)) ? 'checked' : '' ) : '' : '' }} value="dua" name="checkbox3"> Gelisah &nbsp;&nbsp; <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox3)) ? (in_array('lima', json_decode($data->checkbox3)) ? 'checked' : '') : '' : '' }} value="lima" name="checkbox3"> Tekanan Darah menurun&nbsp;&nbsp;
                    </div>
                    <div style="text-indent: 45px;">
                        <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox3)) ? (in_array('tiga', json_decode($data->checkbox3)) ? 'checked' : '' ) : '' : '' }} value="tiga" name="checkbox3"> Lemas &nbsp;&nbsp; <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox3)) ? (in_array('enam', json_decode($data->checkbox3)) ? 'checked' : '') : '' : '' }} value="enam" name="checkbox3"> nadi lambat dan lemah &nbsp;&nbsp; <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox3)) ? (in_array('tujuh', json_decode($data->checkbox3)) ? 'checked' : '') : '' : '' }} value="tujuh" name="checkbox3"> TAK
                    </div> <br>

                    &nbsp;<span style="font-weight: bold;">2. Faktor-faktor yang mempengaruhi gejala fisik : <br></span>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox4)) ? (in_array('satu', json_decode($data->checkbox4)) ? 'checked' : '') : '' : '' }} value="satu" name="checkbox4"> Melakukan aktivitas fisik
                        &nbsp;&nbsp; <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox4)) ? (in_array('dua', json_decode($data->checkbox4)) ? 'checked' : '') : '' : '' }} value="dua" name="checkbox4"> Pindah Posisi &nbsp;&nbsp; <input type="checkbox" {{ $data ? is_array(json_decode($data->checkbox4)) ? (in_array('tiga', json_decode($data->checkbox4)) ? 'checked' : '') : '' : '' }} value="tiga" onchange="checkbox4()" id="checkbox4" name="checkbox4">
                        <input type="text" id="ket_checkbox4" {{ $data ? is_array(json_decode($data->checkbox4)) ? (in_array('tiga', json_decode($data->checkbox4)) ? '' : 'readonly') : '' : 'readonly' }} style="border: 0; border-bottom: 2px dotted; width:50%" value="{{ $data ? $data->ket_checkbox4 : '' }}">
                    </div><br>

                    &nbsp;<span style="font-weight: bold; margin-top: 5px;">3. Manajemen gejala saat ini dan respon pasien : <br></span>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('satu', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="satu"> Mual &nbsp;&nbsp; <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('empat', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="empat"> Pola nafas tidak efektif &nbsp;&nbsp; <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('tujuh', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="tujuh"> Bersihan jalan nafas tidak efektif
                    </div>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('dua', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="dua"> Perubahan persepsi sensori &nbsp;&nbsp; <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('lima', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="lima"> Konstipasi&nbsp;&nbsp; <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('delapan', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="delapan"> Defisit Perawatan Diri
                    </div>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('tiga', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="tiga"> Nyeri akut &nbsp;&nbsp; <input type="checkbox" name="checkbox5" {{ $data ? is_array(json_decode($data->checkbox5)) ? (in_array('enam', json_decode($data->checkbox5)) ? 'checked' : '') : '' : '' }} value="enam"> Nyeri kronis &nbsp;&nbsp;
                    </div> <br>

                    &nbsp;<span style="font-weight: bold">4. Orientasi spiritual pasien dan keluarga : </span>
                    <div style="text-indent: 30px;">
                        Apakah perlu pelayanan spiritual ? &nbsp;&nbsp;&nbsp;
                        <input type="radio" value="Tidak" {{ $data ? ($data->orientasi_spiritual == "Tidak" ? 'checked' : '') : '' }} name="radio_orientasi_spiritual"> Tidak
                        &nbsp;&nbsp; <input type="radio" value="Ya" {{ $data ? ($data->orientasi_spiritual == "Ya" ? 'checked' : '') : '' }} name="radio_orientasi_spiritual"> Ya , oleh :
                        <input type="text" id="ket_orientasi_spiritual" style="border: 0; border-bottom: 2px dotted;" value="{{ $data ? $data->ket_orientasi_spiritual : '' }}" {{ $data ? ($data->orientasi_spiritual == "Ya" ? '' : 'readonly') : 'readonly' }}>
                    </div> <br>

                    &nbsp;<span style="font-weight: bold">5. Urusan dan kebutuhan spiritual pasien dan keluarga seperti putus asa, penderitaanm rasa bersalah atau pengampunan</span>
                    <div style="text-indent: 30px;">
                        Perlu didoakan : &nbsp;&nbsp;&nbsp; <input type="radio" name="radio_perlu_didoakan" value="Tidak" {{ $data ? ($data->perlu_didoakan == "Tidak" ? 'checked' : '') : '' }}> Tidak &nbsp;&nbsp; <input type="radio" name="radio_perlu_didoakan" value="Ya" {{ $data ? ($data->perlu_didoakan == "Ya" ? 'checked' : '') : '' }}> Ya <br>
                    </div>
                    <div style="text-indent: 30px;">
                        Perlu bimbingan rohani : &nbsp;&nbsp;&nbsp; <input type="radio" name="radio_perlu_bimbingan" value="Tidak" {{ $data ? ($data->perlu_bimbingan == "Tidak" ? 'checked' : '') : '' }}> Tidak &nbsp;&nbsp; <input type="radio" name="radio_perlu_bimbingan" value="Ya" {{ $data ? ($data->perlu_bimbingan == "Ya" ? 'checked' : '') : '' }}> Ya <br>
                    </div>
                    <div style="text-indent: 30px;">
                        Perlu pendampingan rohani : &nbsp;&nbsp;&nbsp; <input type="radio" name="radio_pendampingan_rohani" value="Tidak" {{ $data ? ($data->pendampingan_rohani == "Tidak" ? 'checked' : '') : '' }}> Tidak &nbsp;&nbsp; <input type="radio" name="radio_pendampingan_rohani" value="Ya" {{ $data ? ($data->pendampingan_rohani == "Ya" ? 'checked' : '') : '' }}> Ya <br>
                    </div> <br>

                    &nbsp;<span style="font-weight: bold">6. Status psikososial dan keluarga : <br></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">6.1 Apakah ada orang yang ingin dihubungi saat ini ? </span> <input type="radio" name="radio_keluarga" value="Tidak" {{ $data ? ($data->keluarga == "Tidak" ? 'checked' : '') : '' }}> Tidak <br>
                    <div style="text-indent: 45px">
                        <input type="radio" name="radio_keluarga" value="Ya" {{ $data ? ($data->keluarga == "Ya" ? 'checked' : '') : '' }}> Ya, siapa :
                        <input type="text" id="nama_keluarga" style="border: 0; border-bottom: 2px dotted;" value="{{ $data ? $data->nama_keluarga : '' }}" {{ $data ? ($data->keluarga == "Ya" ? '' : 'readonly') : 'readonly' }}> &nbsp;
                        Hubungan dengan pasien sebagai : <input type="text" id="hubungan_keluarga" style="border: 0; border-bottom: 2px dotted;" value="{{ $data ? $data->hubungan_keluarga : '' }}" {{ $data ? ($data->keluarga == "Ya" ? '' : 'readonly') : 'readonly' }}> <br>
                    </div>
                    <div style="text-indent: 45px">
                        &nbsp;&nbsp;&nbsp;&nbsp;Di mana : <input type="text" id="dimana" style="border: 0; border-bottom: 2px dotted;" value="{{ $data ? $data->dimana : '' }}" {{ $data ? ($data->keluarga == "Ya" ? '' : 'readonly') : 'readonly' }}>
                        &nbsp; No. Telepon/HP : <input type="text" id="telp" style="border: 0; border-bottom: 2px dotted;" value="{{ $data ? $data->telp : '' }}" {{ $data ? ($data->keluarga == "Ya" ? '' : 'readonly') : 'readonly' }}>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">6.2 Bagaimana rencana perawatan selanjutnya? </span> <br>
                    <div style="text-indent: 45px">
                        <input type="checkbox" value="satu" {{ $data ? is_array(json_decode($data->checkbox6)) ? (in_array('satu', json_decode($data->checkbox6)) ? 'checked' : '') : '' : '' }} name="checkbox6"> Tetap dirawat di RS
                    </div>
                    <div style="text-indent: 45px">
                        <input type="checkbox" value="dua" {{ $data ? is_array(json_decode($data->checkbox6)) ? (in_array('dua', json_decode($data->checkbox6)) ? 'checked' : '') : '' : '' }} name="checkbox6"> Dirawat di rumah
                    </div>
                    <div style="text-indent: 45px">
                        Apakah lingkungan rumah sudah disiapkan ? &nbsp;&nbsp; <input type="radio" value="Ya" {{ $data ? ($data->penyiapan_lingkungan == "Ya" ? 'checked' : '') : '' }} name="radio_penyiapan_lingkungan"> Ya &nbsp;&nbsp;<input type="radio" value="Tidak" {{ $data ? ($data->penyiapan_lingkungan == "Tidak" ? 'checked' : '') : '' }} name="radio_penyiapan_lingkungan"> Tidak
                    </div>
                    <div style="text-indent: 45px">
                        Jika Ya, apakah ada yang mampu merawat pasien di rumah ? &nbsp;&nbsp; <input type="radio" value="Ya" {{ $data ? ($data->mampu_merawat == "Ya" ? 'checked' : '') : '' }} name="radio_mampu_merawat"> Ya, oleh: <input type="text" id="ket_mampu_merawat" style="border: 0; border-bottom: 2px dotted;" value="{{ $data ? $data->ket_mampu_merawat : '' }}" {{ $data ? ($data->mampu_merawat == "Ya" ? '' : 'readonly') : 'readonly' }}>
                    </div>
                    <div style="text-indent: 45px">
                        <input type="radio" value="Tidak" {{ $data ? ($data->mampu_merawat == "Tidak" ? 'checked' : '') : '' }} name="radio_mampu_merawat"> Tidak
                    </div>
                    <div style="text-indent: 45px">
                        Jika tidak, apakah perlu difasilitasi RS (Home Care) ? &nbsp;&nbsp; <input type="radio" value="Ya" {{ $data ? ($data->homecare == "Ya" ? 'checked' : '') : '' }} name="radio_homecare"> Ya &nbsp;&nbsp;<input type="radio" value="Tidak" {{ $data ? ($data->homecare == "Tidak" ? 'checked' : '') : '' }} name="radio_homecare"> Tidak
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">6.3 Reaksi pasien atas penyakitnya <br> </span>
                    <div style="text-indent: 45px; font-weight: bold">
                        Asesmen Informasi
                    </div>

                    <div style="text-indent: 45px">
                        <input type="checkbox" value="satu" {{ $data ? is_array(json_decode($data->checkbox7)) ? (in_array('satu', json_decode($data->checkbox7)) ? 'checked' : '') : '' : '' }} name="checkbox7"> Menyangkal &nbsp;&nbsp; <input type="checkbox" name=""> Sedih/menangis &nbsp;&nbsp;
                        <input type="checkbox" value="dua" {{ $data ? is_array(json_decode($data->checkbox7)) ? (in_array('dua', json_decode($data->checkbox7)) ? 'checked' : '') : '' : '' }} name="checkbox7"> Marah &nbsp;&nbsp; <input type="checkbox" name=""> Rasa bersalah &nbsp;&nbsp;
                        <input type="checkbox" value="tiga" {{ $data ? is_array(json_decode($data->checkbox7)) ? (in_array('tiga', json_decode($data->checkbox7)) ? 'checked' : '') : '' : '' }} name="checkbox7"> Takut &nbsp;&nbsp; <input type="checkbox" name=""> Ketidak berdayaan
                    </div>

                    <div style="text-indent: 45px; font-weight: bold">
                        Masalah keperawatan *
                    </div>

                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="empat" {{ $data ? is_array(json_decode($data->checkbox7)) ? (in_array('empat', json_decode($data->checkbox7)) ? 'checked' : '') : '' : '' }} name="checkbox7"> Anxietas &nbsp;&nbsp; <input type="checkbox" value="lima" {{ $data ? is_array(json_decode($data->checkbox7)) ? (in_array('lima', json_decode($data->checkbox7)) ? 'checked' : '') : '' : '' }} name="checkbox7"> Distress Spiritual
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">6.4 Reaksi keluarga atas penyakit pasien : <br> </span>
                    <div style="text-indent: 45px; font-weight: bold">
                        Asesmen Informasi
                    </div>
                    <div style="text-indent: 45px">
                        <input type="checkbox" value="satu" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('satu', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Marah &nbsp;&nbsp; <input type="checkbox" value="tujuh" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('tujuh', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Letih/lelah &nbsp;&nbsp;
                        <input type="checkbox" value="dua" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('dua', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Gangguan Tidur &nbsp;&nbsp; <input type="checkbox" value="delapan" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('delapan', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Rasa bersalah &nbsp;&nbsp;
                        <input type="checkbox" value="tiga" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('tiga', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Penurunan konsentrasi &nbsp;&nbsp; <input type="checkbox" value="sembilan" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('sembilan', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Perubahan kebiasaan pola komunikasi <br>
                    </div>
                    <div style="text-indent: 45px">
                        <input type="checkbox" value="empat" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('empat', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Ketidakmampuan memenuhi peran yang diharapkan &nbsp;&nbsp; <input type="checkbox" value="sepuluh" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('sepuluh', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Keluarga kurang berpartisipasi membuat <br>
                    </div>
                    <div style="text-indent: 45px">
                        <input type="checkbox" value="lima" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('lima', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Keluarga kurang komunikasi dengan pasien &nbsp;&nbsp; <input type="checkbox" value="sebelas" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('sebelas', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Keputusan dalam perawatan pasien <br>
                    </div>

                    <div style="text-indent: 45px; font-weight: bold">
                        Masalah keperawatan *
                    </div>

                    <div style="text-indent: 45px;">
                        <input type="checkbox" value="enam" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('enam', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Koping individu tidak efektif &nbsp;&nbsp; <input type="checkbox" value="duabelas" {{ $data ? is_array(json_decode($data->checkbox8)) ? (in_array('duabelas', json_decode($data->checkbox8)) ? 'checked' : '') : '' : '' }} name="checkbox8"> Distress Spiritual
                    </div><br>

                    &nbsp;<span style="font-weight: bold">7. Kebutuhan dukungan atau kelonggaran pelayanan bagi pasien, keluara dan pemberi pelayanan lain : <br></span>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" value="satu" {{ $data ? is_array(json_decode($data->checkbox9)) ? (in_array('satu', json_decode($data->checkbox9)) ? 'checked' : '') : '' : '' }} name="checkbox9"> Pasien perlu pendampingan keluarga
                    </div>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" value="dua" {{ $data ? is_array(json_decode($data->checkbox9)) ? (in_array('dua', json_decode($data->checkbox9)) ? 'checked' : '') : '' : '' }} name="checkbox9"> Keluarga dapat mengunjungi pasien di luar waktu berkunjung
                    </div>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" value="tiga" {{ $data ? is_array(json_decode($data->checkbox9)) ? (in_array('tiga', json_decode($data->checkbox9)) ? 'checked' : '') : '' : '' }} name="checkbox9"> Sahabat dapat mengunjungi pasien di luar waktu berkunjung
                    </div>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" value="empat" {{ $data ? is_array(json_decode($data->checkbox9)) ? (in_array('empat', json_decode($data->checkbox9)) ? 'checked' : '') : '' : '' }} onchange="checkbox9()" id="checkbox9" name="checkbox9">
                        <input type="text" id="ket_checkbox9" {{ $data ? is_array(json_decode($data->checkbox9)) ? (in_array('empat', json_decode($data->checkbox9)) ? '' : 'readonly') : '' : 'readonly' }} style="border: 0; border-bottom: 2px dotted; width:30%" value="{{ $data ? $data->ket_checkbox9 : '' }}">
                    </div>

                    &nbsp;<span style="font-weight: bold">8. Apakah ada kebutuhan akan alternatif atau tingkat pelayanan lain :<br></span>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" value="satu" {{ $data ? is_array(json_decode($data->checkbox10)) ? (in_array('satu', json_decode($data->checkbox10)) ? 'checked' : '') : '' : '' }} name="checkbox10"> Tidak &nbsp;&nbsp;&nbsp; <input type="checkbox" value="dua" {{ $data ? is_array(json_decode($data->checkbox10)) ? (in_array('dua', json_decode($data->checkbox10)) ? 'checked' : '') : '' : '' }} name="checkbox10"> Autopsi
                    </div>
                    <div style="text-indent: 30px;">
                        <input type="checkbox" value="tiga" {{ $data ? is_array(json_decode($data->checkbox10)) ? (in_array('tiga', json_decode($data->checkbox10)) ? 'checked' : '') : '' : '' }} id="checkbox10" onclick="checkbox10()" name="checkbox10"> Donasi organ : <input type="text" id="donasi_organ" value="{{ $data ? $data->donasi_organ : '' }}" style="border: 0; border-bottom: 2px dotted; width: 30%;" {{ $data ? is_array(json_decode($data->checkbox10)) ? (in_array('tiga', json_decode($data->checkbox10)) ? '' : 'readonly') : '' : 'readonly' }}>
                    </div>

                    &nbsp;<span style="font-weight: bold">9.Faktor resiko bagi keluarga yang ditinggalkan :<br></span>
                    <div style="text-indent: 20px; font-weight: bold">
                        Asesmen Informasi
                    </div>
                    <div style="text-indent: 20px">
                        <input type="checkbox" value="satu" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('satu', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Marah &nbsp;&nbsp; <input type="checkbox" value="lima" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('lima', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Letih/lelah &nbsp;&nbsp;
                        <input type="checkbox" value="dua" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('dua', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Depresi &nbsp;&nbsp; <input type="checkbox" value="enam" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('enam', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> gangguan tidur &nbsp;&nbsp;
                        <input type="checkbox" value="tiga" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('tiga', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Rasa bersalah &nbsp;&nbsp; <input type="checkbox" value="tujuh" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('tujuh', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Sedih/menangis <br>
                    </div>
                    <div style="text-indent: 20px">
                        <input type="checkbox" value="empat" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('empat', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Perubahan kebiasaan pola komunikasi &nbsp;&nbsp; <input type="checkbox" value="delapan" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('delapan', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Penuruanan konsentrasi <input type="checkbox" name=""> ketidakmampuan memenuhi peran yang diharapkan <br>
                    </div>
                    <div style="text-indent: 20px; font-weight: bold">
                        Masalah keperawatan *
                    </div>

                    <div style="text-indent: 20px;">
                        <input type="checkbox" value="sembilan" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('sembilan', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Koping individu tidak efektif &nbsp;&nbsp; <input type="checkbox" value="sepuluh" {{ $data ? is_array(json_decode($data->checkbox11)) ? (in_array('sepuluh', json_decode($data->checkbox11)) ? 'checked' : '') : '' : '' }} name="checkbox11"> Distress Spiritual
                    </div><br>
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-weight: bold; text-align: center">
                    DAFTAR MASALAH KEPERAWATAN
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <div style="text-indent: 10px;">
                        &nbsp;<input type="checkbox" value="satu" {{ $data ? is_array(json_decode($data->checkbox12)) ? (in_array('satu', json_decode($data->checkbox12)) ? 'checked' : '') : '' : '' }} name="checkbox12"> Kecemasan atau ketakutan individu/keluarga berhubungan dengan kematian
                    </div>
                    <div style="text-indent: 10px;">
                        &nbsp;<input type="checkbox" value="dua" {{ $data ? is_array(json_decode($data->checkbox12)) ? (in_array('dua', json_decode($data->checkbox12)) ? 'checked' : '') : '' : '' }} name="checkbox12"> Berduka berhubungan dengan penyakit terminal dan kematian
                    </div>
                    <div style="text-indent: 10px;">
                        &nbsp;<input type="checkbox" value="tiga" {{ $data ? is_array(json_decode($data->checkbox12)) ? (in_array('tiga', json_decode($data->checkbox12)) ? 'checked' : '') : '' : '' }} name="checkbox12"> Perubahan proses keluarga berhubungan dengan takut akan kematian keluarga
                    </div>
                    <div style="text-indent: 10px;">
                        &nbsp;<input type="checkbox" value="empat" {{ $data ? is_array(json_decode($data->checkbox12)) ? (in_array('empat', json_decode($data->checkbox12)) ? 'checked' : '') : '' : '' }} name="checkbox12"> Resiko terhadap distres spiritual
                    </div>
                </td>
            </tr>

            <tr style="text-align: center">
                <td colspan="3" style="width: 50%">
                    Dokter
                </td>
                <td colspan="3" style="width: 50%">
                    Perawat /Bidan
                </td>
            </tr>

            <tr style="text-align: center">
                <td style="width: 16.6%">Tgl/Jam</td>
                <td style="width: 16.6%">Nama </td>
                <td style="width: 16.6%">Tanda Tangan</td>
                <td style="width: 16.6%">Tgl/Jam</td>
                <td style="width: 16.6%">Nama</td>
                <td style="width: 16.6%">Tanda Tangan</td>
            </tr>

            <tr style="text-align: center">
                <td style="width: 16.6%; vertical-align: middle">{{ \Carbon\Carbon::parse($dokumen->tanggal_update)->format('d-m-Y H:i') }}</td>
                <td style="width: 16.6%; vertical-align: middle">
                    {{ $dokumen ? ($dokumen->nama_verifikator != "" ? $dokumen->nama_verifikator : '') : '' }}
                </td>
                <td style="width: 16.6%; vertical-align: middle" onclick="open_modal_petugas()">
                    @if ($dokumen->id_verifikator == 0)
                    <br>
                    <br>
                    <br>
                    <br>
                    (.................................................)
                    <br>
                    Ttd & Nama Terang
                    @else
                    @if (isset($employee))
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 2.5cm; width: 4cm;" alt="">
                    @else
                    <br>
                    <br>
                    <br>
                    <br>
                    (.................................................)
                    <br>
                    Ttd & Nama Terang
                    @endif
                    @endif
                </td>
                <td style="width: 16.6%; vertical-align: middle">{{ \Carbon\Carbon::parse($dokumen->tanggal_update)->format('d-m-Y H:i') }}</td>
                <td style="width: 16.6%; vertical-align: middle">
                    {{ $data ? ($data->nama_perawat != "" ? $data->nama_perawat : '') : '' }}
                </td>
                <td style="width: 16.6%; vertical-align: middle" onclick="open_modal_petugas2()">
                    @if (isset($data) && $data->id_perawat == 0)
                    <br>
                    <br>
                    <br>
                    <br>
                    (.................................................)
                    <br>
                    Ttd & Nama Terang
                    @else
                    @if (isset($perawat))
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $perawat->ttd }}" style="height: 2.5cm; width: 4cm;" alt="">
                    @else
                    <br>
                    <br>
                    <br>
                    <br>
                    (.................................................)
                    <br>
                    Ttd & Nama Terang
                    @endif
                    @endif
                </td>
            </tr>
            </table>
        </div>
    </div>
    <p>Keterangan : <br>
        Berilah tanda ( &#10004;) pada tanda (&#9744) untuk pilihan yang sesuai
    </p>
</body>
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    function konfirmasi_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
            return false;
        }
    }

    $('.tanggal_dmy').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
    });

    $('.tanggal_dmy').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        setUmur();
    });

    $('.tanggal_dmy').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.waktu_24').daterangepicker({
        locale: {
            format: 'HH:mm',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('.waktu_24').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('HH:mm'));
    });

    $('.waktu_24').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_petugas2() {
        $('#modal_petugas2').modal('show');
    }

    function open_modal_pasien(status) {
        $('#status').val(status);
        $('#modal_pasien').modal('show');
    }

    function cek_form() {
        var checkbox1 = [];
        $.each($("input[name='checkbox1']:checked"), function(K, V) {
            checkbox1.push(V.value);
        });
        var checkbox2 = [];
        $.each($("input[name='checkbox2']:checked"), function(K, V) {
            checkbox2.push(V.value);
        });
        var checkbox3 = [];
        $.each($("input[name='checkbox3']:checked"), function(K, V) {
            checkbox3.push(V.value);
        });
        var checkbox4 = [];
        $.each($("input[name='checkbox4']:checked"), function(K, V) {
            checkbox4.push(V.value);
        });
        var checkbox5 = [];
        $.each($("input[name='checkbox5']:checked"), function(K, V) {
            checkbox5.push(V.value);
        });
        var checkbox6 = [];
        $.each($("input[name='checkbox6']:checked"), function(K, V) {
            checkbox6.push(V.value);
        });
        var checkbox7 = [];
        $.each($("input[name='checkbox7']:checked"), function(K, V) {
            checkbox7.push(V.value);
        });
        var checkbox8 = [];
        $.each($("input[name='checkbox8']:checked"), function(K, V) {
            checkbox8.push(V.value);
        });
        var checkbox9 = [];
        $.each($("input[name='checkbox9']:checked"), function(K, V) {
            checkbox9.push(V.value);
        });
        var checkbox10 = [];
        $.each($("input[name='checkbox10']:checked"), function(K, V) {
            checkbox10.push(V.value);
        });
        var checkbox11 = [];
        $.each($("input[name='checkbox11']:checked"), function(K, V) {
            checkbox11.push(V.value);
        });
        var checkbox12 = [];
        $.each($("input[name='checkbox12']:checked"), function(K, V) {
            checkbox12.push(V.value);
        });

        $('#hide_tgl_pengkajian').val($('#tgl_pengkajian').val());
        $('#hide_informasi').val($('#informasi').val());
        $('#hide_hubungan').val($('#hubungan').val());
        $('#hide_ket_tonus_otot').val($('#ket_tonus_otot').val());
        $('#hide_ket_checkbox4').val($('#ket_checkbox4').val());
        $('#hide_ket_orientasi_spiritual').val($('#ket_orientasi_spiritual').val());
        $('#hide_nama_keluarga').val($('#nama_keluarga').val());
        $('#hide_hubungan_keluarga').val($('#hubungan_keluarga').val());
        $('#hide_dimana').val($('#dimana').val());
        $('#hide_telp').val($('#telp').val());
        $('#hide_ket_mampu_merawat').val($('#ket_mampu_merawat').val());
        $('#hide_ket_checkbox9').val($('#ket_checkbox9').val());
        $('#hide_donasi_organ').val($('#donasi_organ').val());
        $('#hide_checkbox1').val(JSON.stringify(checkbox1));
        $('#hide_checkbox2').val(JSON.stringify(checkbox2));
        $('#hide_checkbox3').val(JSON.stringify(checkbox3));
        $('#hide_checkbox4').val(JSON.stringify(checkbox4));
        $('#hide_checkbox5').val(JSON.stringify(checkbox5));
        $('#hide_checkbox6').val(JSON.stringify(checkbox6));
        $('#hide_checkbox7').val(JSON.stringify(checkbox7));
        $('#hide_checkbox8').val(JSON.stringify(checkbox8));
        $('#hide_checkbox9').val(JSON.stringify(checkbox9));
        $('#hide_checkbox10').val(JSON.stringify(checkbox10));
        $('#hide_checkbox11').val(JSON.stringify(checkbox11));
        $('#hide_checkbox12').val(JSON.stringify(checkbox12));
        $('#hide_tonus_otot').val($('[name="radio_tonus_otot"]:checked').val());
        $('#hide_orientasi_spiritual').val($('[name="radio_orientasi_spiritual"]:checked').val());
        $('#hide_perlu_didoakan').val($('[name="radio_perlu_didoakan"]:checked').val());
        $('#hide_perlu_bimbingan').val($('[name="radio_perlu_bimbingan"]:checked').val());
        $('#hide_pendampingan_rohani').val($('[name="radio_pendampingan_rohani"]:checked').val());
        $('#hide_keluarga').val($('[name="radio_keluarga"]:checked').val());
        $('#hide_penyiapan_lingkungan').val($('[name="radio_penyiapan_lingkungan"]:checked').val());
        $('#hide_mampu_merawat').val($('[name="radio_mampu_merawat"]:checked').val());
        $('#hide_homecare').val($('[name="radio_homecare"]:checked').val());

        return true;
    }

    $('[name=radio_tonus_otot]').change(function() {
        if ($('[name=radio_tonus_otot]:checked').val() == 'Ya') {
            $('#ket_tonus_otot').removeAttr('readonly');
            return;
        }
        $('#ket_tonus_otot').val('');
        $('#ket_tonus_otot').attr('readonly', true);
    })

    function checkbox4() {
        if ($("#checkbox4").prop('checked') == true) {
            $('#ket_checkbox4').removeAttr('readonly');
        } else {
            $('#ket_checkbox4').attr('readonly', true);
            $('#ket_checkbox4').val('');
        }
    }

    $('[name=radio_orientasi_spiritual]').change(function() {
        if ($('[name=radio_orientasi_spiritual]:checked').val() == 'Ya') {
            $('#ket_orientasi_spiritual').removeAttr('readonly');
            return;
        }
        $('#ket_orientasi_spiritual').val('');
        $('#ket_orientasi_spiritual').attr('readonly', true);
    })

    $('[name=radio_keluarga]').change(function() {
        if ($('[name=radio_keluarga]:checked').val() == 'Ya') {
            $('#nama_keluarga').removeAttr('readonly');
            $('#hubungan_keluarga').removeAttr('readonly');
            $('#dimana').removeAttr('readonly');
            $('#telp').removeAttr('readonly');
            return;
        }
        $('#nama_keluarga').val('');
        $('#nama_keluarga').attr('readonly', true);
        $('#hubungan_keluarga').val('');
        $('#hubungan_keluarga').attr('readonly', true);
        $('#dimana').val('');
        $('#dimana').attr('readonly', true);
        $('#telp').val('');
        $('#telp').attr('readonly', true);
    })

    $('[name=radio_mampu_merawat]').change(function() {
        if ($('[name=radio_mampu_merawat]:checked').val() == 'Ya') {
            $('#ket_mampu_merawat').removeAttr('readonly');
            return;
        }
        $('#ket_mampu_merawat').val('');
        $('#ket_mampu_merawat').attr('readonly', true);
    })

    function checkbox9() {
        if ($("#checkbox9").prop('checked') == true) {
            $('#ket_checkbox9').removeAttr('readonly');
        } else {
            $('#ket_checkbox9').attr('readonly', true);
            $('#ket_checkbox9').val('');
        }
    }

    function checkbox10() {
        if ($("#checkbox10").prop('checked') == true) {
            $('#donasi_organ').removeAttr('readonly');
        } else {
            $('#donasi_organ').attr('readonly', true);
            $('#donasi_organ').val('');
        }
    }
</script>

</html>