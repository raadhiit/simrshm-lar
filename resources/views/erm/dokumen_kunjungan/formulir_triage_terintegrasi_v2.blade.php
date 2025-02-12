<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulir Triase Terintegrasi V2</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style type="text/css">
        #box_ttd:hover {
            cursor: pointer;
        }

        #data_diri_header tr td {
            font-size: 16px;
            vertical-align: top;
        }

        #data_diri_ttd tr td {
            font-size: 20px;
            vertical-align: top;
        }

        #list_numbering li {
            font-size: 18px;
            list-style-type: decimal;
        }

        #list_alfabeth li {
            font-size: 18px;
            list-style-type: lower-alpha;
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

        .table_isian td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian2 tr {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body style="margin: 20px;">
    <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('e_rekam_medis/detail/verifikasi_dokumen_kunjungan') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form onsubmit="return cek_form(this)" id="form_persetujuan"
        action="{{ url('e_rekam_medis/detail/save_formulir_triage_terintegrasi_v2') }}" method="post">
        @csrf
        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
        <input type="hidden" name="noreg" value="{{$dokumen->noreg}}">
        <input type="hidden" id="hide_kontak_awal_pasien" name="kontak_awal_pasien">
        <input type="hidden" id="hide_tanggal" name="tanggal">
        <input type="hidden" id="hide_pukul" name="pukul">
        <input type="hidden" id="hide_cara_masuk" name="cara_masuk">
        <input type="hidden" id="hide_ket_cara_masuk" name="ket_cara_masuk">
        <input type="hidden" id="hide_sudah_terpasang" name="sudah_terpasang">
        <input type="hidden" id="hide_alasan_kedatangan" name="alasan_kedatangan">
        <input type="hidden" id="hide_ket_rujukan" name="ket_rujukan">
        <input type="hidden" id="hide_ket_dijemput" name="ket_dijemput">
        <input type="hidden" id="hide_kendaraan" name="kendaraan">
        <input type="hidden" id="hide_ket_kendaraan" name="ket_kendaraan">
        <input type="hidden" id="hide_nama_pengantar" name="nama_pengantar">
        <input type="hidden" id="hide_no_telp_pengantar" name="no_telp_pengantar">
        <input type="hidden" id="hide_kasus" name="kasus">
        <input type="hidden" id="hide_keluhan_utama" name="keluhan_utama">
        <input type="hidden" id="hide_tv_nyeri" name="tv_nyeri">
        <input type="hidden" id="hide_esi_satu" name="esi_satu">
        <input type="hidden" id="hide_ket_esi_satu" name="ket_esi_satu">
        <input type="hidden" id="hide_esi_dua" name="esi_dua">
        <input type="hidden" id="hide_ket_esi_dua" name="ket_esi_dua">
        <input type="hidden" id="hide_sumber_daya" name="sumber_daya">
        <input type="hidden" id="hide_danger_zone" name="danger_zone">
        <input type="hidden" id="hide_esi_tiga" name="esi_tiga">
        <input type="hidden" id="hide_esi_empat" name="esi_empat">
        <input type="hidden" id="hide_esi_lima" name="esi_lima">
        <input type="hidden" id="hide_keputusan_pukul" name="keputusan_pukul">
        <input type="hidden" id="hide_reuunp" name="reuunp">
        <input type="hidden" id="hide_catatan" name="catatan">
        <input type="hidden" id="hide_tensi" name="tensi">
        <input type="hidden" id="hide_suhu" name="suhu">
        <input type="hidden" id="hide_nadi" name="nadi">
        <input type="hidden" id="hide_rr" name="rr">
        <input type="hidden" id="hide_spo2" name="spo2">
    </form>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach
    @endif
    @if(Session::has('gagal'))
    <div class="alert alert-danger">{{Session::get('gagal')}}</div>
    @endif
    @if(Session::has('sukses'))
    <div class="alert alert-success">{{Session::get('sukses')}}</div>
    @endif
    <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-lg-6" style="border: 1px solid;">
            <div class="row" style="width: 100%;">
                <div class="col-lg-3" style="">
                    <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
                </div>
                <div class="col-lg-9" style="margin-top: 50px">
                    <p style="font-weight: bold; font-size:18px; text-align: left">
                        RUMAH SAKIT HARAPAN MULIA
                    </p>
                    <p
                        style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
                        <span style="font-weight: normal">
                            Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                            <br>Kabupaten Bekasi Jawa Barat (17340).
                            <br>Telp.: (021) 8995 2340
                            <br>Email : info@rumahsakit-harapanmulia.id
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6" style="width: 100%; margin-left: 0; border:1px solid; padding:10px;">
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px; margin-top: 30px;">
                <tr>
                    <td style="width: 40%;">Nama</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nama_pasien }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">No Rekam Medis</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nrm }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Tgl Lahir</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis Kelamin</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">NIK</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->ktp }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="margin-top: -17px;">
        <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
            <div class="col-md-12 text-center" style="background: rgb(222, 222, 222); padding-top: 5px">
                <h5>TRIASE</h5>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td>
                        <div style="display: flex; align-items: center;">
                            &nbsp;&nbsp; <span style="margin-right: 10px">Kontak Awal Pasien</span> : &nbsp;
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)))
                            {{ in_array('telepon', json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)) ? 'checked' : '' }}
                            @endif
                            id="telepon"> Telepon &nbsp;&nbsp;&nbsp;&nbsp;

                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)))
                            {{ in_array('langsung', json_decode($dokumen->formulir_triage_terintegrasi_v2->kontak_awal_pasien)) ? 'checked' : '' }}
                            @endif
                            id="langsung"> Langsung

                            <label style="margin-left: 50px;" for="tanggal">Tanggal : </label> &nbsp;
                            <input style="margin-top: 5px; width: 150px; margin-right: 30px; margin-bottom:5px;" type="text" autocomplete="off" class="form-control tanggal_dmy" id="tanggal"
                                value="@if(old('tanggal')){{ old('tanggal') }}
                                @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? date('d-m-Y', strtotime($dokumen->formulir_triage_terintegrasi_v2->tanggal)) : '' }}@endif">

                            <label for="pukul">Pukul : </label>&nbsp;
                            <input style="width: 100px;" type="text" class="form-control waktu_24" id="pukul"
                                value="@if(old('pukul')){{ old('pukul') }}
                                @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? date('H:i', strtotime($dokumen->formulir_triage_terintegrasi_v2->pukul)) : '' }}@endif">
                        </div>
                    </td>

                <tr>
                    <td>
                        &nbsp;<span style="margin-right: 60px"> Cara masuk </span> :&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)))
                        {{ in_array('jalan', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                        @endif
                        id="jalan"> Jalan &nbsp;&nbsp;&nbsp;

                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)))
                        {{ in_array('brankar', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                        @endif
                        id="brankar"> Brankar &nbsp;&nbsp;&nbsp;

                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)))
                        {{ in_array('kursi_roda', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                        @endif
                        id="kursi_roda"> Kursi Roda &nbsp;&nbsp;&nbsp;

                        <input type="checkbox" onclick="cek_pemeriksaan_antenatal()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk))){{ in_array('lainnya', json_decode($dokumen->formulir_triage_terintegrasi_v2->cara_masuk)) ? 'checked' : '' }}
                        @endif
                        id="lainnya" class="ml-4"> Lainnya

                        <input type="text"
                            value="@if(old('ket_cara_masuk')){{ old('ket_cara_masuk') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->ket_cara_masuk : '' }}@endif"
                            id="ket_cara_masuk" style="border: 0; border-bottom: 2px dotted;">
                    </td>
                </tr>

                <tr>
                    <td>
                        <div style="display: flex; align-items: center;">
                            &nbsp;&nbsp;<span style="margin-right: 40px"> Sudah terpasang </span> :&nbsp;
                            <input class="form-control" type="text" value="@if(old('sudah_terpasang')){{ old('sudah_terpasang') }} @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->sudah_terpasang : '' }} @endif" id="sudah_terpasang">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        &nbsp;<span style="margin-right: 7px"> Alasan Kedatangan </span> :&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)))
                        {{ in_array('sendiri', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                        @endif
                        id="sendiri"> Datang Sendiri &nbsp;&nbsp;&nbsp;

                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)))
                        {{ in_array('polisi', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                        @endif
                        id="polisi"> Polisi &nbsp;&nbsp;&nbsp;

                        <input type="checkbox" onclick="cek_rujukan_dari()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan))){{ in_array('rujukan', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                        @endif
                        id="rujukan" class="ml-4"> Rujukan dari

                        <input type="text"
                            value="@if(old('ket_rujukan')){{ old('ket_rujukan') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->ket_rujukan : '' }}@endif"
                            id="ket_rujukan" style="border: 0; border-bottom: 2px dotted;">

                        <input type="checkbox" onclick="cek_rujukan_dari()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan))){{ in_array('dijemput', json_decode($dokumen->formulir_triage_terintegrasi_v2->alasan_kedatangan)) ? 'checked' : '' }}
                        @endif
                        id="dijemput" class="ml-4"> Dijemput oleh

                        <input type="text"
                            value="@if(old('ket_dijemput')){{ old('ket_dijemput') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->ket_dijemput : '' }}@endif"
                            id="ket_dijemput" style="border: 0; border-bottom: 2px dotted;">
                    </td>
                </tr>

                <tr>
                    <td>
                        &nbsp;<span style="margin-right: 67px"> Kendaraan </span> :&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan)))
                        {{ in_array('ambulans', json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan)) ? 'checked' : '' }}
                        @endif
                        id="ambulans"> Ambulans &nbsp;&nbsp;&nbsp;

                        <input type="checkbox" onclick="cek_kendaraan()"
                            @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan))){{ in_array('bukan_ambulans', json_decode($dokumen->formulir_triage_terintegrasi_v2->kendaraan)) ? 'checked' : '' }}
                        @endif
                        id="bukan_ambulans" class="ml-4"> Kendaraan bukan ambulans, jelaskan

                        <input type="text"
                            value="@if(old('ket_kendaraan')){{ old('ket_kendaraan') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->ket_kendaraan : '' }}@endif"
                            id="ket_kendaraan" style="border: 0; border-bottom: 2px dotted;">
                    </td>
                </tr>

                <tr>
                    <td>
                        <div style="display: flex; align-items: center;">
                            &nbsp;&nbsp;<span style="margin-right: 8px"> Identitas pengantar </span> :&nbsp;
                            Nama : &nbsp;
                            <input style="width: 350px; margin-right: 50px;" class="form-control" type="text" value="@if(old('nama_pengantar')){{ old('nama_pengantar') }} @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->nama_pengantar : '' }} @endif" id="nama_pengantar">
                            No. Telepon : &nbsp;
                            <input style="width: 250px" class="form-control" type="text" value="@if(old('no_telp_pengantar')){{ old('no_telp_pengantar') }} @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->no_telp_pengantar : '' }} @endif" id="no_telp_pengantar">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        &nbsp;<span style="margin-right: 100px"> Kasus </span> :&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)))
                        {{ in_array('trauma', json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)) ? 'checked' : '' }}
                        @endif
                        id="trauma"> Trauma &nbsp;&nbsp;&nbsp;

                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)))
                        {{ in_array('non_trauma', json_decode($dokumen->formulir_triage_terintegrasi_v2->kasus)) ? 'checked' : '' }}
                        @endif
                        id="non_trauma"> Non trauma &nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
            <div class="col-md-12 text-center" style="background: rgb(222, 222, 222); padding-top: 5px">
                <h5>KELUHAN UTAMA</h5>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <table style="width: 100%;" class="table_isian">
                <tr>
                    <td style="padding: 0;">
                        <textarea name="keluhan_utama" id="keluhan_utama" rows="5" style="width: 100%; box-sizing: border-box;">@if(old('keluhan_utama')){{ old('keluhan_utama') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->keluhan_utama : '' }}@endif</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-center">TANDA VITAL</h5>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <table style="width: 100%;" class="table_isian">
                <tr>
                    <td>
                        Tekanan Darah : <input type="text"
                            value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '' }}"
                            id="tensi" style="border: 0; border-bottom: 2px dotted; width: 30%;"> mmHg
                    </td>
                    <td>
                        Pernafasan : <input type="number" onkeyup="cek_danger_zone()"
                            value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '' }}"
                            id="rr" style="border: 0; border-bottom: 2px dotted; width: 30%;"> x/menit
                    </td>
                    <td>
                        Saturasi O2 : <input type="number" onkeyup="cek_danger_zone()"
                            value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->spo2 : '' }}"
                            id="spo2" style="border: 0; border-bottom: 2px dotted; width: 30%;"> %
                    </td>
                </tr>
                <tr>
                    <td>
                        Nadi : <input type="number" onkeyup="cek_danger_zone()"
                            value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '' }}"
                            id="nadi" style="border: 0; border-bottom: 2px dotted; width: 30%"> x/menit
                    </td>
                    <td>
                        Temperatur : <input type="text"
                            value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '' }}"
                            id="suhu" style="border: 0; border-bottom: 2px dotted; width: 30%"> &deg;C
                    </td>
                    <td>
                        Nyeri (VAS) : <input style="border: 0; border-bottom: 2px dotted; width: 30%;" type="text" value="@if(old('tv_nyeri')){{ old('tv_nyeri') }} @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->tv_nyeri : '' }} @endif" id="tv_nyeri">
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <table style="width: 100%;" class="table_isian">
                <tr>
                    <td style="width: 40%; padding-left: 10px;">
                        <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('cardiac', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif
                        id="cardiac"> Cardiac Arrest <br>
                        <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('apneu', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif
                        id="apneu"> Apneu <br>
                        <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('distress', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif
                        id="distress"> Distress napas hebat <br>
                        <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('sumbatan', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif
                        id="sumbatan"> Sumbatan jalan napas (gargling, stridor, total) <br>
                        <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('spo', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif
                        id="spo"> SpO2 < 50% <br>
                            <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('respiration', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="respiration"> RR < 10 x/mnt <br>
                                <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                                {{ in_array('crt', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                                @endif
                                id="crt"> CRT > 2 detik <br>
                                <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                                {{ in_array('sianosis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                                @endif
                                id="sianosis"> sianosis <br>
                    </td>
                    <td style="width: 40%; padding-left: 10px;">
                        <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                        {{ in_array('td_sistolik', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                        @endif
                        id="td_sistolik"> TD Sistolik < 60 mmHg <br>
                            <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('gcs', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="gcs"> GCS 3-8 <br>
                            <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('midriasis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="midriasis"> Pupil midriasis <br>
                            <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('miosis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="miosis"> Pupil miosis / pin point <br>
                            <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('luas_tubuh', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="luas_tubuh"> Luka bakar > 30 % BSA (Luas Tubuh) <br>
                            <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('daerah_vital', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="daerah_vital"> Luka bakar di daerah vital <br>

                            <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('suhu_neo', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="suhu_neo"> Suhu < 36 &deg;C pada Neonatus<br>

                                <input onclick="cek_item_esi_satu()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                                {{ in_array('kejang', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                                @endif
                                id="kejang"> Kejang pada ibu hamil <br>

                                <input onclick="cek_item_esi_satu()" type="checkbox"
                                    @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu))){{ in_array('kritis', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                                @endif
                                id="kritis"> Kondisi kritis lain

                                <input onclick="cek_item_esi_satu()" type="text"
                                    value="@if(old('ket_esi_satu')){{ old('ket_esi_satu') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->ket_esi_satu : '' }}@endif"
                                    id="ket_esi_satu" style="border: 0; border-bottom: 2px dotted;">
                    </td>
                    <td style="width:10%;  background-color: rgb(244, 109, 104)">
                        <h4 style="transform: rotate(90deg);  text-align: center;">
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)))
                            {{ in_array('header_satu', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_satu)) ? 'checked' : '' }}
                            @endif
                            id="header_satu">
                            ESI <br> 1
                        </h4>
                    </td>
                    <td rowspan="2" style="transform: rotate(90deg); width: 10%">
                        <h3> DARURAT </h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('skala_nyeri', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="skala_nyeri"> Skala Nyeri >= 7 <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('agitasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="agitasi"> Agitasi <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('esi2_gcs', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="esi2_gcs"> GCS 9-12 <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('amnesia', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="amnesia"> Amnesia retrograd <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('kll', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="kll"> KLL dengan riwayat pingsan <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('disorientasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="disorientasi"> Disorientasi (nama, waktu, tempat) <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('esi2_kejang', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="esi2_kejang"> Kejang demam pada anak dengan riwayat kejang demam <br>
                    </td>
                    <td style="padding-left: 10px;">
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('muntah', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="muntah"> Muntah proyektil <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('trismus', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="trismus"> Trismus <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('kejang2', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="kejang2"> Kejang <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('suhu1', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="suhu1"> Suhu >= 38&deg;C (usia 1-28 hari/1-3 bln) <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('suhu2', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="suhu2"> Suhu >= 39&deg;C (usia 3 bln - 1 thn) <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('pendarahan', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="pendarahan"> Perdarahan aktif <br>
                        <input onclick="cek_item_esi_dua()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                        {{ in_array('nyeri_dada', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                        @endif
                        id="nyeri_dada"> Nyeri Dada khas <br>
                    </td>
                    <td style="width:10%; background-color: rgb(244, 109, 104)">
                        <h4 style="transform: rotate(90deg);  text-align: center;">
                            <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)))
                            {{ in_array('header_dua', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_dua)) ? 'checked' : '' }}
                            @endif
                            id="header_dua">
                            ESI <br> 2
                        </h4>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 40%; font-weight: bold; text-align: center;">
                        SUMBER DAYA
                    </td>
                    <td style="width: 60%; font-weight: bold; text-align: center;">
                        DANGER ZONE
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 20%; padding-left: 10px">
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('laboratorium', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="laboratorium"> Laboratorium <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('ekg', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="ekg"> EKG <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('monitor', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="monitor"> Monitor <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('sinar', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="sinar"> Sinar X <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('usg', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="usg"> USG <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('konsultasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="konsultasi"> Konsultasi
                    </td>
                    <td style="width: 20%; padding-left: 10px;">
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('cairan', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="cairan"> Cairan melalui IV <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('injeksi', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="injeksi"> Inj. IV / IM <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('nebulisasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="nebulisasi"> Nebulisasi <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('kateter', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="kateter"> Pasang Kateter Urin <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('pipa', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="pipa"> Pasang Pipa Lambung <br>
                        <input onclick="cek_item_sumberdaya()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)))
                        {{ in_array('jahit', json_decode($dokumen->formulir_triage_terintegrasi_v2->sumber_daya)) ? 'checked' : '' }}
                        @endif
                        id="jahit"> Jahit / Hecting
                    </td>
                    <td style="width: 15%; padding-left: 10px;">
                        <span style="text-align: center">
                            Usia</span> <br>
                        <input onclick="cek_item_danger_zone()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                        {{ in_array('usia_satu', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                        @endif
                        id="usia_satu"> < 3 bulan <br>
                            <input onclick="cek_item_danger_zone()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                            {{ in_array('usia_dua', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                            @endif
                            id="usia_dua"> 3 bln - 3 thn <br>
                            <input onclick="cek_item_danger_zone()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                            {{ in_array('usia_tiga', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                            @endif
                            id="usia_tiga"> 3 thn - 8 thn <br>
                            <input onclick="cek_item_danger_zone()" type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)))
                            {{ in_array('usia_empat', json_decode($dokumen->formulir_triage_terintegrasi_v2->danger_zone)) ? 'checked' : '' }}
                            @endif
                            id="usia_empat"> > 8 thn
                    </td>
                    <td style="width: 15%; text-align: center">
                        HR <br>
                        > 180 <br>
                        > 160 <br>
                        > 140 <br>
                        > 100
                    </td>
                    <td style="width: 15%; text-align: center;">
                        RR <br>
                        > 50 <br>
                        > 40 <br>
                        > 30 <br>
                        > 20 <br>
                    </td>
                    <td style="width: 15%; text-align: center">
                        Sp02 <br>
                        < 92 <br>
                            < 92 <br>
                                < 92 <br>
                                    < 92 <br>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 30%; font-weight: bold; text-align: center;">
                        DARURAT
                    </td>
                    <td style="width: 70%; font-weight: bold; text-align: center;">
                        NON DARURAT
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 30%; font-weight: bold; text-align: center; background-color: rgb(241, 241, 144)">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)))
                        {{ in_array('header_tiga', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)) ? 'checked' : '' }}
                        @endif
                        id="header_tiga">
                        ESI 3
                    </td>
                    <td style="width: 35%; font-weight: bold; text-align: center; background-color: rgb(156, 224, 192)">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)))
                        {{ in_array('header_empat', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)) ? 'checked' : '' }}
                        @endif
                        id="header_empat">
                        ESI 4
                    </td>
                    <td style="width: 35%; font-weight: bold; text-align: center; background-color: rgb(156, 224, 192)">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)))
                        {{ in_array('header_lima', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)) ? 'checked' : '' }}
                        @else
                        {{ 'checked' }}
                        @endif
                        id="header_lima">
                        ESI 5
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 30%; padding-left: 10px;">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)))
                        {{ in_array('sumber_daya', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)) ? 'checked' : '' }}
                        @endif
                        id="sumber_daya"> Menggunakan lebih dari satu sumber daya <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)))
                        {{ in_array('dg_vital', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_tiga)) ? 'checked' : '' }}
                        @endif
                        id="dg_vital"> Danger Zone Vital Sign
                    </td>
                    <td style="width: 35%; padding-left: 10px">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)))
                        {{ in_array('sd_empat', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_empat)) ? 'checked' : '' }}
                        @endif
                        id="sd_empat"> Menggunakan satu sumber daya
                    </td>
                    <td style="width: 35%; padding-left: 10px;">
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)))
                        {{ in_array('sd_lima', json_decode($dokumen->formulir_triage_terintegrasi_v2->esi_lima)) ? 'checked' : '' }}
                        @else
                        {{ 'checked' }}
                        @endif
                        id="sd_lima"> Tidak menggunakan sumber daya
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="width: 70%; padding-left: 10px;">
                        <div style="display: flex; align-items: center; margin-bottom: 5px">
                            <label for="pukul">Keputusan Pukul : </label>&nbsp;
                            <input style="width: 100px;" type="text" class="form-control waktu_24" id="keputusan_pukul"
                                value="@if(old('keputusan_pukul')){{ old('keputusan_pukul') }}
                                @else{{ $dokumen->formulir_triage_terintegrasi_v2 ? date('H:i', strtotime($dokumen->formulir_triage_terintegrasi_v2->keputusan_pukul)) : '' }}@endif"> &nbsp; WIB
                        </div>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('resusitasi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif
                        id="resusitasi"> Resusitasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('urgensi_rendah', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif
                        id="urgensi_rendah"> Urgensi Rendah <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('emergensi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif
                        id="emergensi"> Emergensi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('non_urgensi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif
                        id="non_urgensi"> Non Urgensi <br>
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('urgensi', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif
                        id="urgensi"> Urgensi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi_v2) && is_array(json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)))
                        {{ in_array('ponek', json_decode($dokumen->formulir_triage_terintegrasi_v2->reuunp)) ? 'checked' : '' }}
                        @endif
                        id="ponek"> PONEK <br>

                        Catatan :
                        <textarea name="catatan" id="catatan" rows="3" style="width: 100%; box-sizing: border-box;">@if(old('catatan')){{ old('catatan') }}@else{{ $dokumen->formulir_triage_terintegrasi_v2 ? $dokumen->formulir_triage_terintegrasi_v2->catatan : '' }}@endif</textarea>
                    </td>
                    <td style="width: 30%; text-align: center;">
                        Petugas Triase
                        <br>
                        {{-- <a @if($dokumen->formulir_triage_terintegrasi)onclick="open_modal_dokter()"@endif href="#"
                        style="text-decoration:none; color:#111; text-align: center">
                         @if($dokumen->id_verifikator == 0)
                             <br>
                             <br>
                             <br>
                             Klik Disini
                             <br>
                             <br>
                             <br>
                             (.................................................)
                             <br>Ttd & Nama Terang
                         @else
                             @if(isset($employee))
                                 <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                        style="height: 4cm; width: 5cm;" alt="">
                        @else
                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_verifikator}})<br>
                        @endif --}}
                        <div onclick="open_modal_dokter()" id="box_ttd">
                            @if ($dokumen->id_verifikator == 0)
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p><u>Nama dan Tanda Tangan </u></p>
                            @else
                            @if (isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 2cm; width: 4cm;" alt="">
                            @else
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 2cm; width: 4cm;" alt="">
                            @endif
                            <br>({{ $dokumen->nama_verifikator }})
                            @endif
                        </div>
                        {{-- </a> --}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mt-2" style="width: 100%; margin-left: 0;">
        <div class="col-md-12 text-center">
            <button onclick="submit_form()" class="btn btn-success">Simpan</button>
        </div>
    </div>
    <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
        <div style="text-align: center;" class="col-md-12">
            @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/detail/pdf_formulir_triage_terintegrasi_v2?dokumen='.$dokumen->id) }}"
                class="btn btn-success" target="_blank">Download PDF</a>
            @endif
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
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
    
    $('.tanggal_dmy').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('.tanggal_dmy').on('cancel.daterangepicker', function (ev, picker) {
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

    $('.waktu_24').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('HH:mm'));
    });

    $('.waktu_24').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    function cek_danger_zone() {
        
        if ($('#rr').val() == '' || $('#spo2').val() == '' || $('#nadi').val() == '') {
            return;
        }

        let tgl_lahir = new Date('{{ date("m/d/Y", strtotime($pasien->tgl_lahir)) }}');
        let sekarang = new Date('{{ date("m/d/Y") }}');

        let selisih = sekarang.getTime() - tgl_lahir.getTime();
        let result = Math.round(selisih / (1000 * 3600 * 24));

        if (parseFloat($('#rr').val()) > 50 && parseFloat($('#spo2').val()) < 92 && parseFloat($('#nadi').val()) > 180) {
            result < 90 ? $('#usia_satu').prop('checked', true) : $('#usia_satu').prop('checked', false);
        }else{
            $('#usia_satu').prop('checked', false);
        }

        if (parseFloat($('#rr').val()) > 40 && parseFloat($('#spo2').val()) < 92 && parseFloat($('#nadi').val()) > 160) {
            result >= 90 && result < 1095 ? $('#usia_dua').prop('checked', true) : $('#usia_dua').prop('checked', false);
        }else{
            $('#usia_dua').prop('checked', false);
        }

        if (parseFloat($('#rr').val()) > 30 && parseFloat($('#spo2').val()) < 92 && parseFloat($('#nadi').val()) > 140) {
            result >= 1095 && result <= 2920 ? $('#usia_tiga').prop('checked', true) : $('#usia_tiga').prop('checked', false);
        }else{
            $('#usia_tiga').prop('checked', false);
        }

        if (parseFloat($('#rr').val()) > 20 && parseFloat($('#spo2').val()) < 92 && parseFloat($('#nadi').val()) > 100) {
            result > 2920 ? $('#usia_empat').prop('checked', true) : $('#usia_empat').prop('checked', false);
        }else{
            $('#usia_empat').prop('checked', false);
        }

        cek_item_danger_zone();
    }

    function cek_item_esi_satu() {
        $('#header_satu').prop('checked', false);

        if ($('#cardiac').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#apneu').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#distress').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#sumbatan').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#spo').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#respiration').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#crt').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#sianosis').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#td_sistolik').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#gcs').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#midriasis').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#miosis').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#luas_tubuh').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#daerah_vital').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#suhu_neo').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#kejang').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#kritis').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
        if ($('#header_satu').is(":checked")) {
            $('#header_satu').prop('checked', true);
        }
    }

    function cek_item_esi_dua() {
        $('#header_dua').prop('checked', false);

        if ($('#skala_nyeri').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#agitasi').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#esi2_gcs').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#amnesia').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#kll').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#disorientasi').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#esi2_kejang').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#muntah').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#trismus').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#kejang2').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#suhu1').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#suhu2').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#pendarahan').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#nyeri_dada').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
        if ($('#header_dua').is(":checked")) {
            $('#header_dua').prop('checked', true);
        }
    }

    function cek_item_esi_tiga() {
        $('#header_tiga').prop('checked', false);

        if ($('#sumber_daya').is(':checked')) {
            $('#header_tiga').prop('checked', true);
        }

        if ($('#dg_vital').is(':checked')) {
            $('#header_tiga').prop('checked', true);
        }
    }

    function cek_item_danger_zone() {
        $('#dg_vital').prop('checked', false);
        if ($('#usia_satu').is(":checked")) {
            $('#dg_vital').prop('checked', true);
        }
        if ($('#usia_dua').is(":checked")) {
            $('#dg_vital').prop('checked', true);
        }
        if ($('#usia_tiga').is(":checked")) {
            $('#dg_vital').prop('checked', true);
        }
        if ($('#usia_empat').is(":checked")) {
            $('#dg_vital').prop('checked', true);
        }
        cek_item_esi_tiga();
    }

    function cek_item_sumberdaya() {
        let count_item = 0;

        $('#sumber_daya').prop('checked', false);
        $('#header_lima').prop('checked', true);
        $('#sd_lima').prop('checked', true);
        $('#sumber_daya').prop('checked', false);

        if ($('#laboratorium').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#ekg').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#monitor').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#sinar').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#usg').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#konsultasi').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#cairan').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#injeksi').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#nebulisasi').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#kateter').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#pipa').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }
        if ($('#jahit').is(":checked")) {
            $('#header_lima').prop('checked', false);
            $('#sd_lima').prop('checked', false);
            count_item++;
        }

        if (count_item > 1) {
            $('#sumber_daya').prop('checked', true);
        }

        if (count_item == 1) {
            $('#header_empat').prop('checked', true);
            $('#sd_empat').prop('checked', true);
        } else {
            $('#header_empat').prop('checked', false);
            $('#sd_empat').prop('checked', false);
        }

        cek_item_esi_tiga();
    }
</script>
<script>
    function open_modal_dokter() {
        $('#modal_petugas').modal('show');
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        if ($('#keluhan_utama').val() == '') {
            alert('Keluhan utama harus diisi');
            return false;
        }

        if ($('#tanggal').val() == '') {
            alert('Tanggal harus diisi');
            return false;
        }

        if ($('#pukul').val() == '') {
            alert('Pukul harus diisi');
            return false;
        }

        if ($('#keputusan_pukul').val() == '') {
            alert('Keputusan pukul harus diisi');
            return false;
        }

        var kontak_awal_pasien = [];
        if ($('#telepon').is(":checked")) {
            kontak_awal_pasien.push('telepon');
        }
        if ($('#langsung').is(":checked")) {
            kontak_awal_pasien.push('langsung');
        }

        var cara_masuk = [];
        if ($('#jalan').is(":checked")) {
            cara_masuk.push('jalan');
        }
        if ($('#brankar').is(":checked")) {
            cara_masuk.push('brankar');
        }
        if ($('#kursi_roda').is(":checked")) {
            cara_masuk.push('kursi_roda');
        }
        if ($('#lainnya').is(":checked")) {
            cara_masuk.push('lainnya');
        }

        var alasan_kedatangan = [];
        if ($('#sendiri').is(":checked")) {
            alasan_kedatangan.push('sendiri');
        }
        if ($('#polisi').is(":checked")) {
            alasan_kedatangan.push('polisi');
        }
        if ($('#rujukan').is(":checked")) {
            alasan_kedatangan.push('rujukan');
        }
        if ($('#dijemput').is(":checked")) {
            alasan_kedatangan.push('dijemput');
        }

        var kendaraan = [];
        if ($('#ambulans').is(":checked")) {
            kendaraan.push('ambulans');
        }
        if ($('#bukan_ambulans').is(":checked")) {
            kendaraan.push('bukan_ambulans');
        }

        var kasus = [];
        if ($('#trauma').is(":checked")) {
            kasus.push('trauma');
        }
        if ($('#non_trauma').is(":checked")) {
            kasus.push('non_trauma');
        }

        var esi_satu = [];
        if ($('#cardiac').is(":checked")) {
            esi_satu.push('cardiac');
        }
        if ($('#apneu').is(":checked")) {
            esi_satu.push('apneu');
        }
        if ($('#distress').is(":checked")) {
            esi_satu.push('distress');
        }
        if ($('#sumbatan').is(":checked")) {
            esi_satu.push('sumbatan');
        }
        if ($('#spo').is(":checked")) {
            esi_satu.push('spo');
        }
        if ($('#respiration').is(":checked")) {
            esi_satu.push('respiration');
        }
        if ($('#crt').is(":checked")) {
            esi_satu.push('crt');
        }
        if ($('#sianosis').is(":checked")) {
            esi_satu.push('sianosis');
        }
        if ($('#td_sistolik').is(":checked")) {
            esi_satu.push('td_sistolik');
        }
        if ($('#gcs').is(":checked")) {
            esi_satu.push('gcs');
        }
        if ($('#midriasis').is(":checked")) {
            esi_satu.push('midriasis');
        }
        if ($('#miosis').is(":checked")) {
            esi_satu.push('miosis');
        }
        if ($('#luas_tubuh').is(":checked")) {
            esi_satu.push('luas_tubuh');
        }
        if ($('#daerah_vital').is(":checked")) {
            esi_satu.push('daerah_vital');
        }
        if ($('#suhu_neo').is(":checked")) {
            esi_satu.push('suhu_neo');
        }
        if ($('#kejang').is(":checked")) {
            esi_satu.push('kejang');
        }
        if ($('#kritis').is(":checked")) {
            esi_satu.push('kritis');
        }
        if ($('#header_satu').is(":checked")) {
            esi_satu.push('header_satu');
        }

        var esi_dua = [];
        if ($('#skala_nyeri').is(":checked")) {
            esi_dua.push('skala_nyeri');
        }
        if ($('#agitasi').is(":checked")) {
            esi_dua.push('agitasi');
        }
        if ($('#esi2_gcs').is(":checked")) {
            esi_dua.push('esi2_gcs');
        }
        if ($('#amnesia').is(":checked")) {
            esi_dua.push('amnesia');
        }
        if ($('#kll').is(":checked")) {
            esi_dua.push('kll');
        }
        if ($('#disorientasi').is(":checked")) {
            esi_dua.push('disorientasi');
        }
        if ($('#esi2_kejang').is(":checked")) {
            esi_dua.push('esi2_kejang');
        }
        if ($('#muntah').is(":checked")) {
            esi_dua.push('muntah');
        }
        if ($('#trismus').is(":checked")) {
            esi_dua.push('trismus');
        }
        if ($('#kejang2').is(":checked")) {
            esi_dua.push('kejang2');
        }
        if ($('#suhu1').is(":checked")) {
            esi_dua.push('suhu1');
        }
        if ($('#suhu2').is(":checked")) {
            esi_dua.push('suhu2');
        }
        if ($('#pendarahan').is(":checked")) {
            esi_dua.push('pendarahan');
        }
        if ($('#nyeri_dada').is(":checked")) {
            esi_dua.push('nyeri_dada');
        }
        if ($('#header_dua').is(":checked")) {
            esi_dua.push('header_dua');
        }

        var sumber_daya = [];
        if ($('#laboratorium').is(":checked")) {
            sumber_daya.push('laboratorium');
        }
        if ($('#ekg').is(":checked")) {
            sumber_daya.push('ekg');
        }
        if ($('#monitor').is(":checked")) {
            sumber_daya.push('monitor');
        }
        if ($('#sinar').is(":checked")) {
            sumber_daya.push('sinar');
        }
        if ($('#usg').is(":checked")) {
            sumber_daya.push('usg');
        }
        if ($('#konsultasi').is(":checked")) {
            sumber_daya.push('konsultasi');
        }
        if ($('#cairan').is(":checked")) {
            sumber_daya.push('cairan');
        }
        if ($('#injeksi').is(":checked")) {
            sumber_daya.push('injeksi');
        }
        if ($('#nebulisasi').is(":checked")) {
            sumber_daya.push('nebulisasi');
        }
        if ($('#kateter').is(":checked")) {
            sumber_daya.push('kateter');
        }
        if ($('#pipa').is(":checked")) {
            sumber_daya.push('pipa');
        }
        if ($('#jahit').is(":checked")) {
            sumber_daya.push('jahit');
        }

        var danger_zone = [];
        if ($('#usia_satu').is(":checked")) {
            danger_zone.push('usia_satu');
        }
        if ($('#usia_dua').is(":checked")) {
            danger_zone.push('usia_dua');
        }
        if ($('#usia_tiga').is(":checked")) {
            danger_zone.push('usia_tiga');
        }
        if ($('#usia_empat').is(":checked")) {
            danger_zone.push('usia_empat');
        }

        var esi_tiga = [];
        if ($('#sumber_daya').is(":checked")) {
            esi_tiga.push('sumber_daya');
        }
        if ($('#dg_vital').is(":checked")) {
            esi_tiga.push('dg_vital');
        }
        if ($('#header_tiga').is(":checked")) {
            esi_tiga.push('header_tiga');
        }

        var esi_empat = [];
        if ($('#sd_empat').is(":checked")) {
            esi_empat.push('sd_empat');
        }
        if ($('#header_empat').is(":checked")) {
            esi_empat.push('header_empat');
        }

        var esi_lima = [];
        if ($('#sd_lima').is(":checked")) {
            esi_lima.push('sd_lima');
        }
        if ($('#header_lima').is(":checked")) {
            esi_lima.push('header_lima');
        }

        var reuunp = [];
        if ($('#resusitasi').is(":checked")) {
            reuunp.push('resusitasi');
        }
        if ($('#emergensi').is(":checked")) {
            reuunp.push('emergensi');
        }
        if ($('#urgensi').is(":checked")) {
            reuunp.push('urgensi');
        }
        if ($('#urgensi_rendah').is(":checked")) {
            reuunp.push('urgensi_rendah');
        }
        if ($('#non_urgensi').is(":checked")) {
            reuunp.push('non_urgensi');
        }
        if ($('#ponek').is(":checked")) {
            reuunp.push('ponek');
        }

        $('#hide_kontak_awal_pasien').val(JSON.stringify(kontak_awal_pasien));
        $('#hide_cara_masuk').val(JSON.stringify(cara_masuk));
        $('#hide_alasan_kedatangan').val(JSON.stringify(alasan_kedatangan));
        $('#hide_kendaraan').val(JSON.stringify(kendaraan));
        $('#hide_kasus').val(JSON.stringify(kasus));
        $('#hide_esi_satu').val(JSON.stringify(esi_satu));
        $('#hide_esi_dua').val(JSON.stringify(esi_dua));
        $('#hide_sumber_daya').val(JSON.stringify(sumber_daya));
        $('#hide_danger_zone').val(JSON.stringify(danger_zone));
        $('#hide_esi_tiga').val(JSON.stringify(esi_tiga));
        $('#hide_esi_empat').val(JSON.stringify(esi_empat));
        $('#hide_esi_lima').val(JSON.stringify(esi_lima));
        $('#hide_reuunp').val(JSON.stringify(reuunp));

        $('#hide_tanggal').val($('#tanggal').val());
        $('#hide_pukul').val($('#pukul').val());
        $('#hide_sudah_terpasang').val($('#sudah_terpasang').val());
        $('#hide_ket_cara_masuk').val($('#ket_cara_masuk').val());
        $('#hide_ket_rujukan').val($('#ket_rujukan').val());
        $('#hide_ket_dijemput').val($('#ket_dijemput').val());
        $('#hide_ket_kendaraan').val($('#ket_kendaraan').val());
        $('#hide_ket_kendaraan').val($('#ket_kendaraan').val());
        $('#hide_nama_pengantar').val($('#nama_pengantar').val());
        $('#hide_no_telp_pengantar').val($('#no_telp_pengantar').val());
        $('#hide_tv_nyeri').val($('#tv_nyeri').val());
        $('#hide_keluhan_utama').val($('#keluhan_utama').val());
        $('#hide_ket_esi_satu').val($('#ket_esi_satu').val());
        $('#hide_ket_esi_dua').val($('#ket_esi_dua').val());
        $('#hide_keputusan_pukul').val($('#keputusan_pukul').val());
        $('#hide_catatan').val($('#catatan').val());

        $('#hide_tensi').val($('#tensi').val());
        $('#hide_suhu').val($('#suhu').val());
        $('#hide_nadi').val($('#nadi').val());
        $('#hide_rr').val($('#rr').val());
        $('#hide_spo2').val($('#spo2').val());

        return true;
    }

    function cek_cara_masuk() {
        if ($("#lainnya").prop('checked') == true) {
            $('#ket_cara_masuk').removeAttr('readonly');
        } else {
            $('#ket_cara_masuk').attr('readonly', true);
            $('#ket_cara_masuk').val('');
        }
    }

    function cek_rujukan_dari() {
        if ($("#rujukan").prop('checked') == true) {
            $('#ket_rujukan').removeAttr('readonly');
            $('#ket_dijemput').removeAttr('readonly');
        } else {
            $('#ket_rujukan').attr('readonly', true);
            $('#ket_rujukan').val('');
            $('#ket_dijemput').attr('readonly', true);
            $('#ket_dijemput').val('');
        }
    }

    function cek_kendaraan() {
        if ($("#bukan_ambulans").prop('checked') == true) {
            $('#ket_kendaraan').removeAttr('readonly');
        } else {
            $('#ket_kendaraan').attr('readonly', true);
            $('#ket_kendaraan').val('');
        }
    }

    function cek_esi_satu() {
        if ($("#kritis").prop('checked') == true) {
            $('#ket_esi_satu').removeAttr('readonly');
        } else {
            $('#ket_esi_satu').attr('readonly', true);
            $('#ket_esi_satu').val('');
        }
    }
</script>

</html>