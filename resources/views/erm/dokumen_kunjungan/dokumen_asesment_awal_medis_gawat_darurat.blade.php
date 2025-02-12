<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Asesment Awal Medis Gawat Darurat</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <style type="text/css">
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

        .kbw-signature {
            width: 100%;
            height: 450px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
            position: relative;
            left: 0;
            top: 0;
            border: 1px solid;
        }

        #sig {
            opacity: 0.5;
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

        .table_isian {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian td {
        }

        .table_isian_bordered td {
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
@include('erm.riwayat_laboratorium')
@include('erm.riwayat_radiologi')
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
      action="{{ url('e_rekam_medis/detail/save_dokumen_asesment_awal_medis_gawat_darurat') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" id="hide_tgl_kedatangan" name="tgl_kedatangan">
    <input type="hidden" id="hide_jam_kedatangan" name="jam_kedatangan">
    <input type="hidden" id="hide_cara_masuk" name="cara_masuk">
    <input type="hidden" id="hide_ket_cara_masuk" name="ket_cara_masuk">
    <input type="hidden" id="hide_td_keluar" name="td_keluar">
    <input type="hidden" id="hide_td_rr" name="td_rr">
    <input type="hidden" id="hide_td_nadi" name="td_nadi">
    <input type="hidden" id="hide_td_suhu" name="td_suhu">
    <input type="hidden" id="hide_td_spo2" name="td_spo2">
    <input type="hidden" id="hide_asal_rujukan" name="asal_rujukan">
    <input type="hidden" id="hide_cara_bayar" name="cara_bayar">
    <input type="hidden" id="hide_ket_bayar_lain" name="ket_bayar_lain">
    <input type="hidden" id="hide_kondisi_pasien" name="kondisi_pasien">
    <input type="hidden" id="hide_ket_kondisi_lain" name="ket_kondisi_lain">
    <input type="hidden" id="hide_jenis_pelayanan" name="jenis_pelayanan">
    <input type="hidden" id="hide_keluhan_utama" name="keluhan_utama">
    <input type="hidden" id="hide_riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang">
    <input type="hidden" id="hide_riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu">
    <input type="hidden" id="hide_riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga">
    <input type="hidden" id="hide_ket_riwayat_penyakit_keluarga" name="ket_riwayat_penyakit_keluarga">
    <input type="hidden" id="hide_riwayat_penggunaan_obat" name="riwayat_penggunaan_obat">
    <input type="hidden" id="hide_ket_riwayat_penggunaan_obat" name="ket_riwayat_penggunaan_obat">
    <input type="hidden" id="hide_riwayat_alergi" name="riwayat_alergi">
    <input type="hidden" id="hide_ket_riwayat_alergi" name="ket_riwayat_alergi">
    <input type="hidden" id="hide_keadaan_umum_keluar" name="keadaan_umum_keluar">
    <input type="hidden" id="hide_kesadaran_keluar" name="kesadaran_keluar">
    <input type="hidden" id="hide_e_kesadaran" name="e_kesadaran">
    <input type="hidden" id="hide_m_kesadaran" name="m_kesadaran">
    <input type="hidden" id="hide_v_kesadaran" name="v_kesadaran">
    <input type="hidden" id="hide_status_generalis" name="status_generalis">
    <input type="hidden" id="hide_nyeri" name="nyeri">
    <input type="hidden" id="hide_sifat_nyeri" name="sifat_nyeri">
    <input type="hidden" id="hide_kualitas_nyeri" name="kualitas_nyeri">
    <input type="hidden" id="hide_nyeri_menjalar" name="nyeri_menjalar">
    <input type="hidden" id="hide_ket_nyeri_menjalar" name="ket_nyeri_menjalar">
    <input type="hidden" id="hide_skor_nyeri" name="skor_nyeri">
    <input type="hidden" id="hide_frekuensi_nyeri" name="frekuensi_nyeri">
    <input type="hidden" id="hide_pengaruh_nyeri" name="pengaruh_nyeri">
    <input type="hidden" id="hide_nilai_wajah" name="nilai_wajah">
    <input type="hidden" id="hide_nilai_kaki" name="nilai_kaki">
    <input type="hidden" id="hide_nilai_aktifitas" name="nilai_aktifitas">
    <input type="hidden" id="hide_nilai_menangis" name="nilai_menangis">
    <input type="hidden" id="hide_nilai_bersuara" name="nilai_bersuara">
    <input type="hidden" id="hide_faktor_pencetus" name="faktor_pencetus">
    <input type="hidden" id="hide_kualitas" name="kualitas">
    <input type="hidden" id="hide_lokasi" name="lokasi">
    <input type="hidden" id="hide_skala_nyeri" name="skala_nyeri">
    <input type="hidden" id="hide_lama_nyeri" name="lama_nyeri">
    <input type="hidden" id="hide_jam_tindakan1" name="jam_tindakan1">
    <input type="hidden" id="hide_tindakan1" name="tindakan1">
    <input type="hidden" id="hide_diberikan_oleh1" name="diberikan_oleh1">
    <input type="hidden" id="hide_keterangan1" name="keterangan1">
    <input type="hidden" id="hide_jam_tindakan2" name="jam_tindakan2">
    <input type="hidden" id="hide_tindakan2" name="tindakan2">
    <input type="hidden" id="hide_diberikan_oleh2" name="diberikan_oleh2">
    <input type="hidden" id="hide_keterangan2" name="keterangan2">
    <input type="hidden" id="hide_jam_tindakan3" name="jam_tindakan3">
    <input type="hidden" id="hide_tindakan3" name="tindakan3">
    <input type="hidden" id="hide_diberikan_oleh3" name="diberikan_oleh3">
    <input type="hidden" id="hide_keterangan3" name="keterangan3">
    <input type="hidden" id="hide_jam_tindakan4" name="jam_tindakan4">
    <input type="hidden" id="hide_tindakan4" name="tindakan4">
    <input type="hidden" id="hide_diberikan_oleh4" name="diberikan_oleh4">
    <input type="hidden" id="hide_keterangan4" name="keterangan4">
    <input type="hidden" id="hide_jam_tindakan5" name="jam_tindakan5">
    <input type="hidden" id="hide_tindakan5" name="tindakan5">
    <input type="hidden" id="hide_diberikan_oleh5" name="diberikan_oleh5">
    <input type="hidden" id="hide_keterangan5" name="keterangan5">
    <input type="hidden" id="hide_jam_tindakan6" name="jam_tindakan6">
    <input type="hidden" id="hide_tindakan6" name="tindakan6">
    <input type="hidden" id="hide_diberikan_oleh6" name="diberikan_oleh6">
    <input type="hidden" id="hide_keterangan6" name="keterangan6">
    <input type="hidden" id="hide_konsultasi" name="konsultasi">
    <input type="hidden" id="hide_indikasi_rawat_inap" name="indikasi_rawat_inap">
    <input type="hidden" id="hide_pulang" name="pulang">
    <input type="hidden" id="hide_kontrol_poli" name="kontrol_poli">
    <input type="hidden" id="hide_tgl_kontrol" name="tgl_kontrol">
    <input type="hidden" id="hide_rujuk_ke" name="rujuk_ke">
    <input type="hidden" id="hide_alasan_rujuk" name="alasan_rujuk">
    <input type="hidden" id="hide_alasan_menolak" name="alasan_menolak">
    <input type="hidden" id="hide_tgl_keluar" name="tgl_keluar">
    <input type="hidden" id="hide_jam_keluar" name="jam_keluar">
    <input type="hidden" id="hide_kondisi_keluar" name="kondisi_keluar">
    <input type="hidden" id="hide_tgl_meninggal" name="tgl_meninggal">
    <input type="hidden" id="hide_jam_meninggal" name="jam_meninggal">
    <input type="hidden" id="hide_keadaan_umum" name="keadaan_umum">
    <input type="hidden" id="hide_kesadaran" name="kesadaran">
    <input type="hidden" id="hide_catatan_penting" name="catatan_penting">
    <input type="hidden" id="hide_edukasi" name="edukasi">
    <input type="hidden" id="hide_penyampaian_edukasi" name="penyampaian_edukasi">
    <input type="hidden" id="hide_alasan_tidak_menyampaikan_edukasi" name="alasan_tidak_menyampaikan_edukasi">
    <textarea id="signature_status_lokasi" name="signed" style="display: none"></textarea>
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
<div class="row d-flex-inline pb-2" style="width: 100%; margin-left: 0;">
    <button class="btn btn-primary" id="btn_riwayat_lab">Riwayat Laboratorium</button>
    <button class="btn btn-info ml-2" id="btn_riwayat_rad">Riwayat Radiologi</button>
</div>
<div class="row pb-3" style="width: 100%; margin-left: 0;">
    <div class="col-lg-6" style="border: 1px solid;">
        <div class="row" style="width: 100%;">
            <div class="col-lg-3" style="">
                <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
            </div>
            <div class="col-lg-9" style="margin-top: 10px">
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
        <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px;">
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
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
            <h6 style="color: white">DOKUMEN ASESMENT AWAL MEDIS GAWAT DARURAT</h6>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%" class="table_isian">
            <tr>
                <td style="width: 20%;">
                    Tanggal dan Jam Kedatangan 
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="2">
                    {{ date('d-m-Y', strtotime($dokumen->created_at)) }},
                    {{-- {{ \Carbon\Carbon::parse($dokumen->created_at)->locale('id')->isoFormat('dddd, DD-MM-YYYY') }} --}}
                    {{-- <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kedatangan"
                        value="@if(old('tgl_kedatangan')){{ old('tgl_kedatangan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_kedatangan : '' }}@endif"> --}}
                    Pukul :
                    {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                    {{-- <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_kedatangan"
                        value="@if(old('jam_kedatangan')){{ old('jam_kedatangan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_kedatangan : '' }}@endif"> --}}
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Cara Masuk
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_cara_masuk()"
                           @if(old('cara_masuk'))
                               {{ old('cara_masuk') ==  'sendiri' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'sendiri' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="sendiri" name="radio_cara_masuk"> Datang Sendiri
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_cara_masuk()"
                           @if(old('cara_masuk'))
                               {{ old('cara_masuk') ==  'rujukan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'rujukan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="rujukan" name="radio_cara_masuk"> Rujukan
                    <select id="asal_rujukan" disabled style="margin-top: 5px">
                        <option value="" selected disabled>Pilih Asal Rujukan</option>
                        @foreach($perujuk as $item)
                            <option @if(old('asal_rujukan'))
                                        {{ old('asal_rujukan') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->asal_rujukan == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select> &nbsp;&nbsp;
                    Lain-lain :
                    <input type="text"value="@if(old('ket_cara_masuk')){{ old('ket_cara_masuk') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_cara_masuk : '' }}@endif" id="ket_cara_masuk" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Penanggung Pembayaran 
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="2">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_cara_bayar()"
                                @if(old('cara_bayar'))
                                    {{ old('cara_bayar') ==  'umum' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'umum' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="umum" name="radio_cara_bayar"> Umum
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_cara_bayar()"
                                @if(old('cara_bayar'))
                                    {{ old('cara_bayar') ==  'bpjs' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'bpjs' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="bpjs" name="radio_cara_bayar"> BPJS
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_cara_bayar()"
                                @if(old('cara_bayar'))
                                    {{ old('cara_bayar') ==  'jamkesda' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'jamkesda' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="jamkesda" name="radio_cara_bayar"> Jamkesda
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_cara_bayar()"
                                @if(old('cara_bayar'))
                                    {{ old('cara_bayar') ==  'jampersal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'jampersal' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="jampersal" name="radio_cara_bayar"> Jampersal
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_cara_bayar()"
                                @if(old('cara_bayar'))
                                    {{ old('cara_bayar') ==  'bayar_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'bayar_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="bayar_lain" name="radio_cara_bayar">
                            <input type="text" readonly
                                value="@if(old('ket_bayar_lain')){{ old('ket_bayar_lain') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bayar_lain : '' }}@endif"
                                id="ket_bayar_lain" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('cara_bayar'))
                                    {{ old('cara_bayar') ==  'bayar_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_bayar == 'bayar_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Kondisi Pasien
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="2">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_kondisi_pasien()"
                                @if(old('kondisi_pasien'))
                                    {{ old('kondisi_pasien') ==  'emergency' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'emergency' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="emergency" name="radio_kondisi_pasien"> Emergency
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_kondisi_pasien()"
                                @if(old('kondisi_pasien'))
                                    {{ old('kondisi_pasien') ==  'false_emergency' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'false_emergency' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="false_emergency" name="radio_kondisi_pasien"> False Emergency
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_kondisi_pasien()"
                                @if(old('kondisi_pasien'))
                                    {{ old('kondisi_pasien') ==  'no_emergency' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'no_emergency' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="no_emergency" name="radio_kondisi_pasien"> No. Emergency
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_kondisi_pasien()"
                                @if(old('kondisi_pasien'))
                                    {{ old('kondisi_pasien') ==  'kondisi_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'kondisi_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="kondisi_lain" name="radio_kondisi_pasien">
                            <input type="text" readonly
                                value="@if(old('ket_kondisi_lain')){{ old('ket_kondisi_lain') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_kondisi_lain : '' }}@endif"
                                id="ket_kondisi_lain" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('kondisi_pasien'))
                                    {{ old('kondisi_pasien') ==  'kondisi_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pasien == 'kondisi_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Jenis Pelayanan 
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="2">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('jenis_pelayanan'))
                                    {{ old('jenis_pelayanan') ==  'preventif' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'preventif' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="preventif" name="radio_jenis_pelayanan"> Preventif
                        </div>
                        <div class="col-md-4">
                            <input @if(old('jenis_pelayanan'))
                                    {{ old('jenis_pelayanan') ==  'paliatif' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'paliatif' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="paliatif" name="radio_jenis_pelayanan"> Paliatif
                        </div>
                        <div class="col-md-2">
                            <input @if(old('jenis_pelayanan'))
                                    {{ old('jenis_pelayanan') ==  'kuratif' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'kuratif' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="kuratif" name="radio_jenis_pelayanan"> Kuratif
                        </div>
                        <div class="col-md-2">
                            <input @if(old('jenis_pelayanan'))
                                    {{ old('jenis_pelayanan') ==  'rehabilitatif' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pelayanan == 'rehabilitatif' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="rehabilitatif" name="radio_jenis_pelayanan"> Rehabilitatif
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4">
                    I. Anamnesis
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Keluhan Utama
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input type="text" class="form-control"
                                   value="@if(old('keluhan_utama')){{ old('keluhan_utama') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keluhan_utama : '' }}@endif"
                                   id="keluhan_utama">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Riwayat Penyakit Sekarang
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input type="text" class="form-control"
                                   value="@if(old('riwayat_penyakit_sekarang')){{ old('riwayat_penyakit_sekarang') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_sekarang : '' }}@endif"
                                   id="riwayat_penyakit_sekarang">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Riwayat Penyakit Dahulu
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input type="text" class="form-control"
                                   value="@if(old('riwayat_penyakit_dahulu')){{ old('riwayat_penyakit_dahulu') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_dahulu : '' }}@endif"
                                   id="riwayat_penyakit_dahulu">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Riwayat Penyakit Keluarga
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_penyakit_keluarga()"
                    @if(old('riwayat_penyakit_keluarga'))
                        {{ old('riwayat_penyakit_keluarga') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_keluarga == 'tidak_ada' ? 'checked' : '') : 'checked' }}
                    @endif
                    type="radio" value="tidak_ada" name="radio_riwayat_penyakit_keluarga"> Tidak Ada
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input onclick="cek_radio_riwayat_penyakit_keluarga()"
                        @if(old('riwayat_penyakit_keluarga'))
                            {{ old('riwayat_penyakit_keluarga') ==  'ada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_keluarga == 'ada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="ada" name="radio_riwayat_penyakit_keluarga"> Ada
                        <input type="text" readonly
                        value="@if(old('ket_riwayat_penyakit_keluarga')){{ old('ket_riwayat_penyakit_keluarga') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_penyakit_keluarga : '' }}@endif"
                        id="ket_riwayat_penyakit_keluarga" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_penyakit_keluarga'))
                            {{ old('riwayat_penyakit_keluarga') ==  'ada' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_keluarga == 'ada' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Riwayat Penggunaan Obat
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_penggunaan_obat()"
                    @if(old('riwayat_penggunaan_obat'))
                        {{ old('riwayat_penggunaan_obat') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penggunaan_obat == 'tidak_ada' ? 'checked' : '') : 'checked' }}
                    @endif
                    type="radio" value="tidak_ada" name="radio_riwayat_penggunaan_obat"> Tidak Ada
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input onclick="cek_radio_riwayat_penggunaan_obat()"
                        @if(old('riwayat_penggunaan_obat'))
                            {{ old('riwayat_penggunaan_obat') ==  'ada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penggunaan_obat == 'ada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="ada" name="radio_riwayat_penggunaan_obat"> Ada
                        <input type="text" readonly
                        value="@if(old('ket_riwayat_penggunaan_obat')){{ old('ket_riwayat_penggunaan_obat') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_penggunaan_obat : '' }}@endif"
                        id="ket_riwayat_penggunaan_obat" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_penggunaan_obat'))
                            {{ old('riwayat_penggunaan_obat') ==  'ada' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penggunaan_obat == 'ada' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Riwayat Alergi
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_alergi()"
                    @if(old('riwayat_alergi'))
                        {{ old('riwayat_alergi') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_alergi == 'tidak_ada' ? 'checked' : '') : 'checked' }}
                    @endif
                    type="radio" value="tidak_ada" name="radio_riwayat_alergi"> Tidak Ada
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input onclick="cek_radio_riwayat_alergi()"
                        @if(old('riwayat_alergi'))
                            {{ old('riwayat_alergi') ==  'ada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_alergi == 'ada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="ada" name="radio_riwayat_alergi"> Ada
                        <input type="text" readonly
                        value="@if(old('ket_riwayat_alergi')){{ old('ket_riwayat_alergi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_alergi : '' }}@endif"
                        id="ket_riwayat_alergi" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_alergi'))
                            {{ old('riwayat_alergi') ==  'ada' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_alergi == 'ada' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="6">
                    II. Pemeriksaan Fisik
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Keadaan Umum</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <input @if(old('keadaan_umum'))
                               {{ old('keadaan_umum') ==  'tampak_tidak_sakit' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'tampak_tidak_sakit' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tampak_tidak_sakit" name="radio_keadaan_umum"> Tampak Tidak Sakit
                    <input @if(old('keadaan_umum'))
                               {{ old('keadaan_umum') ==  'sakit_ringan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_ringan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="sakit_ringan" name="radio_keadaan_umum" class="ml-4"> Sakit Ringan
                    <input @if(old('keadaan_umum'))
                               {{ old('keadaan_umum') ==  'sakit_sedang' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_sedang' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="sakit_sedang" name="radio_keadaan_umum" class="ml-4"> Sakit Sedang
                    <input @if(old('keadaan_umum'))
                               {{ old('keadaan_umum') ==  'sakit_berat' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_berat' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="sakit_berat" name="radio_keadaan_umum" class="ml-4"> Sakit Berat
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Kesadaran</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'compos_mentis' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="compos_mentis" name="radio_kesadaran"> Compos Mentis
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'apatis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'apatis' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="apatis" name="radio_kesadaran" class="ml-4"> Apatis
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'somnolen' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'somnolen' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="somnolen" name="radio_kesadaran" class="ml-4"> Somnolen
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'sopor' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'sopor' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="sopor" name="radio_kesadaran" class="ml-4"> Sopor
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'sopor_koma' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'sopor_koma' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="sopor_koma" name="radio_kesadaran" class="ml-4"> Sopor koma
                </td>
            </tr>
            <tr>
                <td style="width: 15%"></td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'koma' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'koma' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="koma" name="radio_kesadaran"> koma
                </td>
            </tr>
            <tr>
                <td style="width: 15%">GCS</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-4">
                            E : <input type="text"
                                       value="@if(old('e_kesadaran')){{ old('e_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->e_kesadaran : '' }}@endif"
                                       id="e_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-4">
                            M : <input type="text"
                                       value="@if(old('m_kesadaran')){{ old('m_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->m_kesadaran : '' }}@endif"
                                       id="m_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-4">
                            V : <input type="text"
                                       value="@if(old('v_kesadaran')){{ old('v_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->v_kesadaran : '' }}@endif"
                                       id="v_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Tanda - Tanda Vital</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            TD : {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                        </div>
                        <div class="col-md-2">
                            RR : {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Nadi : {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Suhu : {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} ᵒC
                        </div>
                        <div class="col-md-2">
                            SpO2 : {{ $layanan->tanda_vital ? $layanan->tanda_vital->spo2 : '....' }} %
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="6">
                    III. Status Generalis
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <textarea id="status_generalis" class="form-control"
                                  rows="5" class="form-control">@if(old('status_generalis')){{ old('status_generalis') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->status_generalis : '' }}@endif</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    IV. Status Lokasi
                </td>
            </tr>
            <tr>
                <td colspan="6" style="vertical-align: top">
                    @if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat)
                        @if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gambar_status_lokalis != '')
                            <div
                                style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis.jpg') }}')">
                                <img style="position: relative; top:0px; opacity: 0.5;"
                                    src="{{ asset('status_lokalis/' . $dokumen->dokumen_asesment_awal_medis_gawat_darurat->gambar_status_lokalis) }}"
                                    alt="">
                            </div>
                        @else
                            <div
                                style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis.jpg') }}')">
                                <div id="sig"></div>
                            </div>
                        @endif
                    @else
                        <div
                            style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis.jpg') }}')">
                            <div id="sig"></div>
                        </div>
                    @endif
                    {{-- <img style="position: relative; top:-180px; z-index: -1;"
                        src="{{ asset('images/status_lokalis.jpg') }}" alt=""> --}}
                    <p>Gambar lokasi</p>
                    @if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat)
                        @if ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gambar_status_lokalis != '')
                            <a style="position:relative; top:0px;"
                                onclick="return confirm('Yakin gambar ulang status lokalis ?')"
                                class="btn btn-dark"
                                href="{{ url('e_rekam_medis/hapus_gambar_status_lokalis?dokumen=' . $dokumen->id) }}">Gambar
                                ulang</a>
                        @else
                            <button style="position:relative; top:0px;" type="button" class="btn btn-danger"
                                id="btn_clear">Clear</button>
                        @endif
                    @else
                        <button style="position:relative; top:0px;" type="button" class="btn btn-danger"
                            id="btn_clear">Clear</button>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid;">
                <td colspan="6">
                    V. Asesmen Nyeri
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td colspan="3" style="border-right: hidden">
                    Nyeri :
                    <input @if(old('nyeri'))
                               {{ old('nyeri') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_nyeri"> Tidak
                    <input @if(old('nyeri'))
                               {{ old('nyeri') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri == 'ya' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="ya" name="radio_nyeri"> Ya
                </td>
                <td colspan="3">
                    Sifat :
                    <input @if(old('sifat_nyeri'))
                               {{ old('sifat_nyeri') ==  'akut' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sifat_nyeri == 'akut' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="akut" name="radio_sifat_nyeri"> Akut
                    <input @if(old('sifat_nyeri'))
                               {{ old('sifat_nyeri') ==  'kronis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sifat_nyeri == 'kronis' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="kronis" name="radio_sifat_nyeri"> Kronis
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-12 pt-2">
                            <table style="width: 100%;" border="1">
                                <tr>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128516;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128522;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128528;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128542;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128534;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128557;</p>
                                    </td>
                                </tr>
                                <tr class="text-center" style="font-weight: bold;">
                                    <td>0<br>Tidak Nyeri</td>
                                    <td>2<br>Sedikit Nyeri</td>
                                    <td>4<br>Sedikit Lebih Nyeri</td>
                                    <td>6<br>Lebih Nyeri</td>
                                    <td>8<br>Sangat Nyeri</td>
                                    <td>10<br>Nyeri Sangat Hebat</td>
                                </tr>
                            </table>
                            <!-- <img src="{{ asset('images/asesmen_nyeri.png') }}" alt=""> -->
                        </div>
                        <div class="col-md-12">
                            <p>Klasifikasi nyeri : </p>
                        </div>
                        <div class="col-md-4">
                            <ul style="list-style-type: none; margin-left: -30px;">
                                <li>0 = tidak ada nyeri</li>
                                <li>1 = nyeri seperti gatal, nyut-nyutan</li>
                                <li>2 = nyeri seperti melilit atau terpukul</li>
                                <li>3 = nyeri seperti perih atau mules</li>
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <ul style="list-style-type: none; margin-left: -70px;">
                                <li>4 = nyeri seperti kram atau kaku</li>
                                <li>5 = nyeri seperti tertekan</li>
                                <li>6 = nyeri seperti terbakar atau ditusuk-tusuk</li>
                                <li>7-9 = sangat nyeri tapi masih bisa dikontrol oleh pasien</li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul style="list-style-type: none; margin-left: -30px;">
                                <li>10 = sangat nyeri, tidak dapat dikontrol oleh pasien</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">1. Kualitas Nyeri</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input @if(old('kualitas_nyeri'))
                                       {{ old('kualitas_nyeri') ==  'nyeri_tumpul' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas_nyeri == 'nyeri_tumpul' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="nyeri_tumpul" name="radio_kualitas_nyeri"> Nyeri Tumpul
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kualitas_nyeri'))
                                       {{ old('kualitas_nyeri') ==  'nyeri_tajam' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="nyeri_tajam" name="radio_kualitas_nyeri"> Nyeri Tajam
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kualitas_nyeri'))
                                       {{ old('kualitas_nyeri') ==  'panas' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas_nyeri == 'panas' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="panas" name="radio_kualitas_nyeri"> Panas / Terbakar
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">2. Menjalar</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_nyeri_menjalar()" @if(old('nyeri_menjalar'))
                                {{ old('nyeri_menjalar') ==  'tidak' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_menjalar == 'tidak' ? 'checked' : '') : 'checked' }}
                            @endif
                            type="radio" value="tidak" name="radio_menjalar"> Tidak
                        </div>
                        <div class="col-md-6">
                            <input onclick="cek_radio_nyeri_menjalar()" @if(old('nyeri_menjalar'))
                                {{ old('nyeri_menjalar') ==  'ya' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_menjalar == 'ya' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="ya" name="radio_menjalar"> Ya, Ke
                            <input type="text"
                                   value="@if(old('ket_nyeri_menjalar')){{ old('ket_nyeri_menjalar') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_nyeri_menjalar : '' }}@endif"
                                   id="ket_nyeri_menjalar" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('nyeri_menjalar'))
                                {{ old('nyeri_menjalar') == 'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_menjalar == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">3. Skor Nyeri</div>
                        <div>:</div>
                        <div class="col-md-9">
                            <select id="skor_nyeri" class="form-control" style="width: 15%;">
                                @for($i = 1; $i<=10; $i++)
                                    <option @if(old('skor_nyeri'))
                                                {{ old('skor_nyeri') == $i ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skor_nyeri == $i ? 'selected' : '' }}
                                            @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">4. Frekuensi Nyeri</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input @if(old('frekuensi_nyeri'))
                                       {{ old('frekuensi_nyeri') ==  'jarang' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_nyeri == 'jarang' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="jarang" name="radio_frekuensi_nyeri"> Jarang
                        </div>
                        <div class="col-md-2">
                            <input @if(old('frekuensi_nyeri'))
                                       {{ old('frekuensi_nyeri') ==  'hilang_timbul' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="hilang_timbul" name="radio_frekuensi_nyeri"> Hilang Timbul
                        </div>
                        <div class="col-md-2">
                            <input @if(old('frekuensi_nyeri'))
                                       {{ old('frekuensi_nyeri') ==  'terus_menerus' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_nyeri == 'terus_menerus' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="terus_menerus" name="radio_frekuensi_nyeri"> Terus Menerus
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">5. Nyeri Mempengaruhi</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'tidur' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'tidur' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tidur" name="radio_pengaruh_nyeri"> Tidur
                        </div>
                        <div class="col-md-2">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'aktifitas_fisik' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="aktifitas_fisik" name="radio_pengaruh_nyeri"> Aktifitas Fisik
                        </div>
                        <div class="col-md-2">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'konsentrasi' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'konsentrasi' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="konsentrasi" name="radio_pengaruh_nyeri"> Konsentrasi
                        </div>
                        <div class="col-md-2">
                            <input @if(old('pengaru_nyeri'))
                                       {{ old('pengaru_nyeri') ==  'emosi' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'emosi' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="emosi" name="radio_pengaruh_nyeri"> Emosi
                        </div>
                        <div class="offset-2 col-md-2" style="padding-left: 19px">
                            <input @if(old('pengaru_nyeri'))
                                       {{ old('pengaru_nyeri') ==  'nafsu_makan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'nafsu_makan' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="nafsu_makan" name="radio_pengaruh_nyeri"> Nafsu Makan
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr>
                <td colspan="5">
                    SKALA FLACC Untuk < 6 tahun
                </td>
            </tr>
            <tr style="border: 1px solid; text-align: center">
                <td>
                    Pengkajian
                </td>
                <td>
                    0
                </td>
                <td>
                    1
                </td>
                <td>
                    2
                </td>
                <td>
                    Nilai
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Wajah
                </td>
                <td>
                    Tersenyum / Tidak Ada Ekspresi Khusus
                </td>
                <td>
                    Terkadang Meringis / Menarik Diri
                </td>
                <td>
                    Sering Menggetarkan Dagu
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_wajah')){{ old('nilai_wajah') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_wajah : '' }}@endif"
                               id="nilai_wajah" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Kaki
                </td>
                <td>
                    Gerakan Normal Relaksasi
                </td>
                <td>
                    Tidak Tenang / Tegang
                </td>
                <td>
                    Kaki Dibuat Menendang / Menarik Diri
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_kaki')){{ old('nilai_kaki') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_kaki : '' }}@endif"
                               id="nilai_kaki" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Aktifitas
                </td>
                <td>
                    Tidur Posisi Normal, Mudah Bergerak
                </td>
                <td>
                    Gerakan Menggeliat, Berguling, Kaku
                </td>
                <td>
                    Melengkungkan Punggung, Kaku, Menghentak
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_aktifitas')){{ old('nilai_aktifitas') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_aktifitas : '' }}@endif"
                               id="nilai_aktifitas" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Menangis
                </td>
                <td>
                    Tidur Menangis (Bangun / Tidur)
                </td>
                <td>
                    Mengerang / Merengek
                </td>
                <td>
                    Menangis Terus, Terisak, Menjerit
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_menangis')){{ old('nilai_menangis') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_menangis : '' }}@endif"
                               id="nilai_menangis" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Bersuara
                </td>
                <td>
                    Bersuara Normal, Tenang
                </td>
                <td>
                    Tenang Bila dipeluk digendong, atau diajak Berbicara
                </td>
                <td>
                    Sulit Untuk ditenangkan
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_bersuara')){{ old('nilai_bersuara') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nilai_bersuara : '' }}@endif"
                               id="nilai_bersuara" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="vertical-align: text-top">
                <td rowspan="6" style="width: 15%">
                    Hasil Skrining <span style="float: right">:</span>
                </td>
                <td style="width: 15%">
                    (P) Faktor Pencetus <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('faktor_pencetus')){{ old('faktor_pencetus') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->faktor_pencetus : '' }}@endif"
                               id="faktor_pencetus" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (Q) Kualitas <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('kualitas')){{ old('kualitas') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas : '' }}@endif"
                               id="kualitas" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (R) Lokasi <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('lokasi')){{ old('lokasi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lokasi : '' }}@endif"
                               id="lokasi" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (S) Skala Nyeri <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('skala_nyeri')){{ old('skala_nyeri') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->skala_nyeri : '' }}@endif"
                               id="skala_nyeri" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (T) Lama Nyeri <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('lama_nyeri')){{ old('lama_nyeri') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lama_nyeri : '' }}@endif"
                               id="lama_nyeri" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr>
                <td colspan="5">
                    VI. Pemeriksaan Penunjang
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td colspan="5">
                    <div class="row">
                        <div class="col-md-12">
                            A. Laboratorium
                            <div id="box_button_pesanan_lab">
                                @if (is_null($pesanan_lab))
                                    <button class="btn btn-dark" type="button" onclick="open_modal_lab()"><i
                                            class="fa fa-plus"></i></button>
                                @endif
                            </div>
                            <div id="list_pesanan">
                                @if ($pesanan_lab)
                                    @if($pesanan_lab->status == 'Pesanan ERM')
                                    <button class="btn btn-warning" type="button"
                                        onclick="open_modal_lab()"><i class="fa fa-pencil"
                                            style="color:#fff;"></i></button>
                                    @endif
                                    <button class="btn btn-info" type="button" data-toggle="tooltip"
                                        title="Hasil"
                                        onclick="open_modal_hasil_lab('{{ $pesanan_lab->id }}')"><i
                                            class="fa fa-book" style="color:#fff;"></i></button>
                                    @if($pesanan_lab->status == 'Pesanan ERM')
                                        <button class="btn btn-danger" type="button" data-toggle="tooltip"
                                                title="Hapus"
                                                onclick="hapus_pesanan_lab('{{ $pesanan_lab->id }}')"><i
                                                    class="fa fa-trash" style="color:#fff;"></i></button>
                                    @endif
                                    @php
                                        $iterasi_pesanan_lab = 0;
                                        $pesan = '';
                                    @endphp
                                    <?php $yang_dipesan = json_decode($pesanan_lab->periksa); ?>
                                    @foreach ($pemeriksaan as $pem)
                                        @php
                                            $temp_slug = $pem->slug;
                                        @endphp
                                        @if (isset($yang_dipesan->$temp_slug))
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
                                    {{ $pesanan_lab->no_lab }} - {{ $pesan }}
                                @endif
                            </div>
                            <br>
                            B. Radiologi
                            <div id="box_button_pesanan_radiologi">
                                @if (is_null($pesanan_rad))
                                    <button onclick="open_modal_pesanan_radiologi()" type="button" class="btn btn-dark"><i
                                            class="fa fa-plus"></i></button>
                                @endif
                            </div>
                            <div id="list_pesanan_radiologi">
                                @if($pesanan_rad)
                                    @if($pesanan_rad->status == 'Pesanan ERM')
                                    <button class="btn btn-warning" type="button"
                                        onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil"
                                            style="color:#fff;"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-info" type="button" data-toggle="tooltip" title="Hasil"
                                        onclick="open_modal_hasil_radiologi('{{ $pesanan_rad->id }}')"><i
                                            class="fa fa-book" style="color:#fff;"></i></button>
                                    @if($pesanan_rad->status == 'Pesanan ERM')
                                        <button class="btn btn-danger" type="button" data-toggle="tooltip"
                                                title="Hapus"
                                                onclick="hapus_pesanan_rad('{{ $pesanan_rad->id }}')"><i
                                                    class="fa fa-trash" style="color:#fff;"></i></button>
                                    @endif
                                    @php
                                        $iterasi_pesanan_radiologi = 0;
                                        $pesan_radiologi = '';
                                    @endphp
                                    <?php $yang_dipesan = json_decode($pesanan_rad->periksa); ?>
                                    @foreach ($pemeriksaan_radiologi as $pemrad)
                                        @php
                                            $temp_slug = 'rad_' . $pemrad->id;
                                        @endphp
                                        @if (isset($yang_dipesan->$temp_slug))
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
                                    {{ $pesanan_rad->no_lab }} - {{ $pesan_radiologi }}
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr>
                <td colspan="5">
                    VII. Diagnosa Kerja
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td colspan="5">
                    <div style="display: flex; flex-direction: row" class="pt-3">
                        <div id="box_btn_asesmen">
                            @if ($diagnosa == null)
                                <button class="btn btn-success" onclick="open_form_tambah_diagnosa('diagnosa')"><i
                                        class="fa fa-plus"></i></button>
                            @else
                                <button class="btn btn-warning" onclick="open_form_tambah_diagnosa('diagnosa')"
                                        style="color:#fff; font-weight: bold;"><i
                                        class="fa fa-pencil"></i></button>
                            @endif
                        </div>
                        <div id="box_diagnosa" class="ml-2">
                            {{ $diagnosa ? $diagnosa->kode_icd . ' - ' . $diagnosa->nama_icd : '' }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr>
                <td colspan="4">
                    VIII. TERAPI / TINDAKAN
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    TINDAKAN
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width:10%">
                    Jam
                </td>
                <td style="text-align: center">
                    Tindakan
                </td>
                <td style="text-align: center">
                    Diberikan Oleh
                </td>
                <td style="text-align: center">
                    Evaluasi / Keterangan
                </td>
            </tr>
            <tr>
                <td>
                    <input type="time" class="form-control"
                                   value="@if(old('jam_tindakan1')){{ old('jam_tindakan1') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan1 : '' }}@endif"
                                   id="jam_tindakan1">
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('tindakan1')){{ old('tindakan1') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan1 : '' }}@endif"
                                   id="tindakan1">
                </td>
                <td>
                    <select id="diberikan_oleh1" class="form-control" style="margin-top: 5px; width:99.5%">
                        <option value="" selected disabled>Pilih Perawat</option>
                        @foreach($data_employee as $item)
                            <option @if(old('diberikan_oleh1'))
                                        {{ old('diberikan_oleh1') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh1 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('keterangan1')){{ old('keterangan1') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan1 : '' }}@endif"
                                   id="keterangan1">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="time" class="form-control"
                                   value="@if(old('jam_tindakan2')){{ old('jam_tindakan2') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan2 : '' }}@endif"
                                   id="jam_tindakan2">
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('tindakan2')){{ old('tindakan2') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan2 : '' }}@endif"
                                   id="tindakan2">
                </td>
                <td>
                    <select id="diberikan_oleh2" class="form-control" style="margin-top: 5px; width:99.5%">
                        <option value="" selected disabled>Pilih Perawat</option>
                        @foreach($data_employee as $item)
                            <option @if(old('diberikan_oleh2'))
                                        {{ old('diberikan_oleh2') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh2 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('keterangan2')){{ old('keterangan2') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan2 : '' }}@endif"
                                   id="keterangan2">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="time" class="form-control"
                                   value="@if(old('jam_tindakan3')){{ old('jam_tindakan3') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan3 : '' }}@endif"
                                   id="jam_tindakan3">
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('tindakan3')){{ old('tindakan3') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan3 : '' }}@endif"
                                   id="tindakan3">
                </td>
                <td>
                    <select id="diberikan_oleh3" class="form-control" style="margin-top: 5px; width:99.5%">
                        <option value="" selected disabled>Pilih Perawat</option>
                        @foreach($data_employee as $item)
                            <option @if(old('diberikan_oleh3'))
                                        {{ old('diberikan_oleh3') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh3 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('keterangan3')){{ old('keterangan3') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan3 : '' }}@endif"
                                   id="keterangan3">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="time" class="form-control"
                                   value="@if(old('jam_tindakan4')){{ old('jam_tindakan4') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan4 : '' }}@endif"
                                   id="jam_tindakan4">
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('tindakan4')){{ old('tindakan4') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan4 : '' }}@endif"
                                   id="tindakan4">
                </td>
                <td>
                    <select id="diberikan_oleh4" class="form-control" style="margin-top: 5px; width:99.5%">
                        <option value="" selected disabled>Pilih Perawat</option>
                        @foreach($data_employee as $item)
                            <option @if(old('diberikan_oleh4'))
                                        {{ old('diberikan_oleh4') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh4 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('keterangan4')){{ old('keterangan4') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan4 : '' }}@endif"
                                   id="keterangan4">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="time" class="form-control"
                                   value="@if(old('jam_tindakan5')){{ old('jam_tindakan5') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan5 : '' }}@endif"
                                   id="jam_tindakan5">
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('tindakan5')){{ old('tindakan5') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan5 : '' }}@endif"
                                   id="tindakan5">
                </td>
                <td>
                    <select id="diberikan_oleh5" class="form-control" style="margin-top: 5px; width:99.5%">
                        <option value="" selected disabled>Pilih Perawat</option>
                        @foreach($data_employee as $item)
                            <option @if(old('diberikan_oleh5'))
                                        {{ old('diberikan_oleh5') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh5 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('keterangan5')){{ old('keterangan5') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan5 : '' }}@endif"
                                   id="keterangan5">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="time" class="form-control"
                                   value="@if(old('jam_tindakan6')){{ old('jam_tindakan6') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_tindakan6 : '' }}@endif"
                                   id="jam_tindakan6">
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('tindakan6')){{ old('tindakan6') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tindakan6 : '' }}@endif"
                                   id="tindakan6">
                </td>
                <td>
                    <select id="diberikan_oleh6" class="form-control" style="margin-top: 5px; width:99.5%">
                        <option value="" selected disabled>Pilih Perawat</option>
                        @foreach($data_employee as $item)
                            <option @if(old('diberikan_oleh6'))
                                        {{ old('diberikan_oleh6') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh6 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control"
                                   value="@if(old('keterangan6')){{ old('keterangan6') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keterangan6 : '' }}@endif"
                                   id="keterangan6">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    TERAPI
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="list_e_resep" class="pt-3">
                        <div id="box_btn_terapi">
                            @if ($layanan->resep == null)
                                <button class="btn btn-dark" onclick="open_modal_e_resep()"><i
                                        class="fa fa-plus"></i></button>
                            @else
                                @if ($layanan->resep->locked == 0)
                                    <button class="btn btn-warning"
                                            onclick="open_modal_edit_resep('{{ $layanan->resep->id }}')"><i
                                            class="fa fa-pencil" style="color:#fff;"></i></button>
                                    <button class="btn btn-info"
                                            onclick="lock_terapi('{{ $layanan->resep->id }}')"><i
                                            class="fa fa-lock" style="color:#fff;"></i></button>
                                @endif
                                <button class="btn btn-info"
                                        onclick="preview_terapi('{{ $layanan->resep->id }}')"><i
                                        class="fa fa-book" style="color:#fff;"></i></button>
                            @endif
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
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td>
                    IX. Tindak Lanjut
                </td>
            </tr>
            <tr>
                <td style="width: 5%">
                    Dirawat, konsultasi dengan Dokter <span style="float: right">:</span>
                </td>
                <td class="pl-2">
                    <select id="konsultasi" class="form-control" style="margin-top: 5px">
                        <option value="" selected disabled>Pilih Asal Rujukan</option>
                        @foreach($dokter as $item)
                            <option @if(old('konsultasi'))
                                        {{ old('konsultasi') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->konsultasi == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 5%">
                    Indikasi Rawat Inap <span style="float: right">:</span>
                </td>
                <td class="pl-2"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea id="indikasi_rawat_inap" class="form-control"
                                  rows="5" class="form-control">@if(old('indikasi_rawat_inap')){{ old('indikasi_rawat_inap') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->indikasi_rawat_inap : '' }}@endif</textarea>
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    Pulang <span style="float: right">:</span>
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input @if(old('pulang'))
                            {{ old('pulang') ==  'izin_dokter' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pulang == 'izin_dokter' ? 'checked' : '') : 'checked' }}
                        @endif
                        type="radio" value="izin_dokter" name="radio_pulang"> Atas Izin Dokter
                    <input style="margin-left: 100px" @if(old('pulang'))
                            {{ old('pulang') ==  'permintaan_sendiri' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pulang == 'permintaan_sendiri' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="permintaan_sendiri" name="radio_pulang"> Atas Permintaan Sendiri
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Kontrol ke Poliklinik
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="2">
                    <select id="kontrol_poli" style="margin-top: 5px">
                        <option value="" selected disabled>Pilih Poliklinik</option>
                        @foreach($klinik as $item)
                            <option @if(old('kontrol_poli'))
                                        {{ old('kontrol_poli') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kontrol_poli == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                    {{-- <input type="text" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('kontrol_poli')){{ old('kontrol_poli') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kontrol_poli : '' }}@endif"
                                   id="kontrol_poli"> --}}
                    , Pada tanggal
                    <input type="date" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('tgl_kontrol')){{ old('tgl_kontrol') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_kontrol : '' }}@endif"
                                   id="tgl_kontrol">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Rujuk ke
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input type="text" class="form-control" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('rujuk_ke')){{ old('rujuk_ke') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rujuk_ke : '' }}@endif"
                                   id="rujuk_ke">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Alasan Rujuk
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input type="text" class="form-control" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('alasan_rujuk')){{ old('alasan_rujuk') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->alasan_rujuk : '' }}@endif"
                                   id="alasan_rujuk">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Menolak Rawat Inap
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Alasan
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input type="text" class="form-control" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('alasan_menolak')){{ old('alasan_menolak') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->alasan_menolak : '' }}@endif"
                                   id="alasan_menolak">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td style="width: 20%;">
                    X. Keluar IGD Pada Tanggal
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input type="date" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('tgl_keluar')){{ old('tgl_keluar') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_keluar : '' }}@endif"
                                   id="tgl_keluar">
                    , dan Jam :
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_keluar"
                           value="@if(old('jam_keluar')){{ old('jam_keluar') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_keluar : '' }}@endif">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4" style="border: 1px solid">
                    XI. KONDISI SAAT KELUAR IGD
                </td>
            </tr>
            <tr>
                <td style="width: 25%">
                    <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                            {{ old('kondisi_keluar') ==  'sembuh' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'sembuh' ? 'checked' : '') : 'checked' }}
                        @endif
                        type="radio" value="sembuh" name="radio_kondisi_keluar"> Sembuh / Membaik
                </td>
                <td style="width: 25%">
                    <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                            {{ old('kondisi_keluar') ==  'memburuk' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'memburuk' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="memburuk" name="radio_kondisi_keluar"> Memburuk
                </td>
                <td style="width: 25%">
                    <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                            {{ old('kondisi_keluar') ==  'tetap' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'tetap' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tetap" name="radio_kondisi_keluar"> Tetap
                </td>
                <td style="width: 25%">
                    <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                            {{ old('kondisi_keluar') ==  'doa' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'doa' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="doa" name="radio_kondisi_keluar"> DOA
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input onclick="cek_radio_kondisi_keluar()" @if(old('kondisi_keluar'))
                            {{ old('kondisi_keluar') ==  'meninggal' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_keluar == 'meninggal' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="meninggal" name="radio_kondisi_keluar"> Meninggal Pada Tanggal : 
                    <input type="date" style="border: hidden; border-bottom: 2px dotted" readonly
                        value="@if(old('tgl_meninggal')){{ old('tgl_meninggal') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_meninggal : '' }}@endif"
                        id="tgl_meninggal">
                    , dan Jam :
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_meninggal" readonly
                        value="@if(old('jam_meninggal')){{ old('jam_meninggal') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_meninggal : '' }}@endif"
                        id="jam_meninggal">
                </td>
            </tr>
            <tr>
                <td style="width: 25%">
                    Keadaan Umum <span style="float: right">:</span>
                </td>
                <td colspan="3">
                    <input type="text" class="form-control" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('keadaan_umum_keluar')){{ old('keadaan_umum_keluar') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum_keluar : '' }}@endif"
                                   id="keadaan_umum_keluar">
                </td>
            </tr>
            <tr>
                <td style="width: 25%">
                    Kesadaran <span style="float: right">:</span>
                </td>
                <td colspan="3">
                    <input type="text" class="form-control" style="border: hidden; border-bottom: 2px dotted"
                                   value="@if(old('kesadaran_keluar')){{ old('kesadaran_keluar') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran_keluar : '' }}@endif"
                                   id="kesadaran_keluar">
                </td>
            </tr>
            <tr>
                <td style="width: 10%">
                    Tanda Vital <span style="float: right">:</span>
                </td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-12">
                            TD :
                            <input type="text"value="@if(old('td_keluar')){{ old('td_keluar') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_keluar : '' }}@endif" id="td_keluar" style="border: 0; border-bottom: 2px dotted; width: 70px;">mmHg &nbsp;&nbsp;&nbsp;&nbsp;
                            RR :
                            <input type="text"value="@if(old('td_rr')){{ old('td_rr') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_rr : '' }}@endif" id="td_rr" style="border: 0; border-bottom: 2px dotted; width: 60px;">x/menit &nbsp;&nbsp;&nbsp;&nbsp;
                            Nadi :
                            <input type="text"value="@if(old('td_nadi')){{ old('td_nadi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_nadi : '' }}@endif" id="td_nadi" style="border: 0; border-bottom: 2px dotted; width: 60px;">x/menit &nbsp;&nbsp;&nbsp;&nbsp;
                            Suhu :
                            <input type="text"value="@if(old('td_suhu')){{ old('td_suhu') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_suhu : '' }}@endif" id="td_suhu" style="border: 0; border-bottom: 2px dotted; width: 60px;">&deg; C &nbsp;&nbsp;&nbsp;&nbsp;
                            SpO2 :
                            <input type="text"value="@if(old('td_spo2')){{ old('td_spo2') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->td_spo2 : '' }}@endif" id="td_spo2" style="border: 0; border-bottom: 2px dotted; width: 60px;">% &nbsp;&nbsp;&nbsp;&nbsp;

                        </div>                        
                        {{-- <div class="col-md-2">
                            RR : {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Nadi : {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Suhu : {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} ᵒC
                        </div>
                        <div class="col-md-2">
                            SpO2 : {{ $layanan->tanda_vital ? $layanan->tanda_vital->spo2 : '....' }} %
                        </div> --}}
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Catatan Penting (Kondisi Saat Ini) :
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <textarea id="catatan_penting" class="form-control"
                                  rows="5" class="form-control">@if(old('catatan_penting')){{ old('catatan_penting') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->catatan_penting : '' }}@endif</textarea>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4" style="border: 1px solid">
                    XII. EDUKASI
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border: 1px solid">
                    <textarea id="edukasi" class="form-control"
                                  rows="5" class="form-control">@if(old('edukasi')){{ old('edukasi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->edukasi : '' }}@endif</textarea>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4">
                    XIII. Edukasi awal mengenai diagnosa, terapi, dan tindakan disampaikan kepada :
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input onclick="cek_radio_penyampaian_edukasi()" @if(old('penyampaian_edukasi'))
                                {{ old('penyampaian_edukasi') ==  'pasien' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->penyampaian_edukasi == 'pasien' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="pasien" name="radio_penyampaian_edukasi"> Pasien / Keluarga
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input onclick="cek_radio_penyampaian_edukasi()" @if(old('penyampaian_edukasi'))
                            {{ old('penyampaian_edukasi') ==  'tidak_dapat_menyampaikan' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->penyampaian_edukasi == 'tidak_dapat_menyampaikan' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tidak_dapat_menyampaikan" name="radio_penyampaian_edukasi"> Tidak dapat menyampaikan edukasi, karena :
                    <input type="text" class="form-control" style="border: hidden; border-bottom: 2px dotted" readonly
                        value="@if(old('alasan_tidak_menyampaikan_edukasi')){{ old('alasan_tidak_menyampaikan_edukasi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->alasan_tidak_menyampaikan_edukasi : '' }}@endif"
                        id="alasan_tidak_menyampaikan_edukasi">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td style="width: 50%">
                    
                </td>
                <td style="width: 50%; text-align: center">
                    Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}, Jam: {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td style="width: 50%; text-align: center">
                    @if(is_null($dokumen->signature_pasien) && $dokumen->signature_pasien == "")
                        Mengetahui
                        <br>
                        Pasien / Keluarga
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.................................................)
                        <br>Ttd & Nama Terang
                    @else
                        @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                            <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_pasien}})
                        
                    @endif
                </td>
                <td style="width: 50%; text-align: center">
                    @if($dokumen->id_verifikator == 0)
                        <br>
                        Dokter IGD
                        <br>
                        <br>
                        <br>
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
                        <br>({{$dokumen->nama_verifikator}})
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row pt-5" style="width:100%; margin-left:0">
    <div class="col-md-1"></div>
    <div class="col-md-4" onclick="open_modal_pasien()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Pasien / Keluarga</h5>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-4" onclick="open_modal_petugas()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Dokter</h5>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <button onclick="submit_form()" class="btn btn-success">Simpan</button>
    </div>
</div>
<div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/detail/pdf_dokumen_asesment_awal_medis_gawat_darurat?dokumen='.$dokumen->id) }}"
               class="btn btn-success" target="_blank">Download PDF</a>
        @endif
    </div>
</div>

<div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/detail/save_ttd_dokumen_kunjungan') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Nama Penerima Edukasi</h6>
                            <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                        </div>
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                        </div>
                    </div>
                    <br />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--Diagnosa--}}
<div class="modal fade" id="modal_tambah_diagnosa" style="overflow-y: scroll;" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asesmen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form onsubmit="submit_diagnosa()" id="form_asesmen">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="_method" value="POST"/>
                <input type="hidden" name="erm" value="true">
                <input type="hidden" name="tabel" value="smis_doc_dokumen_asesment_awal_medis_gawat_darurat">
                <input type="hidden" name="kode_icd_tindakan" id="kode_icd_tindakan"/>
                <input type="hidden" name="noreg" value="{{ $layanan->id }}"/>
                <input type="hidden" name="dokumen" value="{{ $dokumen->id }}"/>
                <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}" id="id_dokter"/>
                <input type="hidden" name="id_diagnosa" value="{{ $diagnosa ? $diagnosa->id : 0 }}" id="id_diagnosa"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" readonly class="form-control"
                               value="{{ date('Y-m-d', strtotime($dokumen->created_at)) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Asal Ruangan</label>
                        <input type="text" name="ruangan" id="ruangan" value="{{ $layanan->last_ruangan }}"
                               readonly class="form-control">
                    </div>
                    <hr>
                    <p style="font-weight: bold; font-size:14px;">DATA DOKTER / PSIKOLOG</p>
                    <div class="form-group">
                        <label for="">Dokter / Psikolog</label>
                        <input type="text" name="dokter" value="{{ Auth::user()->realname }}" id="dokter"
                               readonly class="form-control">
                    </div>
                    <input type="hidden" name="nip_dokter" value="{{ $employee ? $employee->nip : '' }}"
                           id="nip_dokter" readonly class="form-control">
                    {{-- </div> --}}
                    <hr>
                    <p style="font-weight: bold; font-size:14px;">DIAGNOSA</p>
                    <div id="diagnosa">
                        <div class="form-group">
                            <label for="">Diagnosa Utama</label>
                            <input type="text" class="form-control" name="diagnosa" id="diagnosa_primer">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa Sekunder 1</label>
                            <input type="text" class="form-control" name="diagnosa_sekunder_satu"
                                   id="diagnosa_sekunder_satu">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa Sekunder 2</label>
                            <input type="text" class="form-control" name="diagnosa_sekunder_dua"
                                   id="diagnosa_sekunder_dua">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa Sekunder 3</label>
                            <input type="text" class="form-control" name="diagnosa_sekunder_tiga"
                                   id="diagnosa_sekunder_tiga">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa Sekunder 4</label>
                            <input type="text" class="form-control" name="diagnosa_sekunder_empat"
                                   id="diagnosa_sekunder_empat">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa Sekunder 5</label>
                            <input type="text" class="form-control" name="diagnosa_sekunder_lima"
                                   id="diagnosa_sekunder_lima">
                        </div>
                    </div>
                    <div id="pembanding">
                        <div class="form-group">
                            <label for="">Diagnosa Pembanding</label>
                            <input type="text" class="form-control" name="diagnosa_pembanding" id="diagnosa_pembanding">
                        </div>
                    </div>
                    <div id="box_msg"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_simpan_diagnosa" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--End Of Diagnosa--}}

{{--Resep--}}
<div class="modal fade" id="modal_dokter_e_resep" tabindex="-1" style="overflow-y: scroll;" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <table class="table" id="tabel_dokter_e_resep" style="width: 100%;">
                        <thead>
                        <tr class="text-center">
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>NIP</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 14px;">
                <table id="tabel_preview" style="border: 1px solid; width:100%;">
                    <tr style="border:1px solid;">
                        <td style="padding: 10px;">
                            <p style="text-align:center"><b>RUMAH SAKIT HARAPAN MULIA</b><br>Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                                <br><b>Kabupaten Bekasi Jawa Barat</b></p>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 40%">Dokter</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 57%">{{ sizeof($all_resep) > 0 ? $all_resep[0]->nama_dokter : '' }}</td>
                                </tr>
                                <tr>
                                    <td>SIP</td>
                                    <td> :</td>
                                    <td>{{ sizeof($all_resep) > 0 ? $all_resep[0]->sip_dokter : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Unit Pelayanan</td>
                                    <td> :</td>
                                    <td style="text-transform: uppercase">{{ sizeof($all_resep) > 0 ? str_replace('_',' ',$all_resep[0]->ruangan) : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Catatan Obat Racikan</td>
                                    <td> :</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3">{{ sizeof($all_resep) > 0 ? $all_resep[0]->catatan_obat_racikan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td colspan="4" style="text-align: right">
                                        Jombang, {{ $dokumen->asesmen_ulang ? date('d-m-Y', strtotime($dokumen->asesmen_ulang->tanggal)) : '' }}</td>
                                </tr>
                                @if (sizeof($all_resep) > 0)
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
                        </td>
                    </tr>
                    <tr style="border: 1px solid red;">
                        <td style="border: 1px solid; padding:10px;">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td> :</td>
                                    <td>{{ $layanan->nama_pasien }}</td>
                                </tr>
                                <tr>
                                    <td>No. Reg</td>
                                    <td> :</td>
                                    <td>{{ $layanan->id }}</td>
                                </tr>
                                <tr>
                                    <td>No. RM</td>
                                    <td> :</td>
                                    <td>{{ $layanan->nrm }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> :</td>
                                    <td>{{ $layanan->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Pasien</td>
                                    <td> :</td>
                                    <td style="text-transform: uppercase">{{ str_replace('_',' ',$layanan->carabayar) }}</td>
                                </tr>
                                <tr>
                                    <td>Perusahaan</td>
                                    <td> :</td>
                                    <td>{{ $layanan->nama_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td>Asuransi</td>
                                    <td> :</td>
                                    <td>{{ $layanan->asuransi == null ? '' : $layanan->asuransi }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- modal list obat -->
<div class="modal fade" id="modal_list_obat" style="overflow-y: scroll;" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="msg_list_obat"></div>
                <div class="row">
                    <div class="col-lg-8"></div>
                    <form class="col-lg-4" id="form_search_obat">
                        <div class="input-group">
                            <input type="text" id="search_obat" placeholder="Cari.." class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table-striped" id="tabel_list_obat" style="width: 100%;">
                    <thead>
                    <tr class="text-center">
                        <th>Obat</th>
                        <th>Jenis</th>
                        <th>Zat Aktif</th>
                        <th>Komposisi</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- end modal list obat -->

<!-- modal e_resep -->
<div class="modal fade" style="overflow-y: scroll" id="modal_e_resep" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Formulir E-Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_e_resep">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="detail" id="detail_resep">
                <input type="hidden" name="ruangan" value="{{ $layanan->last_ruangan }}">
                <div class="modal-body">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Waktu</label>
                                <input class="form-control" value="{{ date('Y-m-d') }}" name="waktu"
                                       id="e_resep_waktu" type="date" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">NRM</label>
                                <input class="form-control" name="nrm" id="e_resep_nrm" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Usia</label>
                                <input class="form-control" name="usia" id="e_resep_usia" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Asuransi</label>
                                <input class="form-control" name="asuransi" value="{{ $layanan->asuransi }}" id="e_resep_asuransi" type="text"
                                       readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Dokter</label>
                                <div class="input-group">
                                    <input class="form-control" name="dokter"
                                           value="{{ Auth::user()->realname }}" id="e_resep_dokter" type="text"
                                           readonly>
                                    <input class="form-control" name="id_dokter" value="{{ Auth::user()->id }}"
                                           id="e_resep_id_dokter" type="hidden">
                                    <div class="input-grou-append">
                                        <button class="btn btn-dark" type="button"
                                                onclick="open_modal_dokter_e_resep('tambah')"><i
                                                class="fa fa-list"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input class="form-control" name="nama" id="e_resep_nama" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Berat Badan</label>
                                <input class="form-control" name="berat_badan"
                                       value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '' }}"
                                       id="e_resep_berat_badan" type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Depo Tujuan</label>
                                <select name="depo_tujuan" id="e_resep_depo_tujuan" class="form-control">
                                    <option value="depo_farmasi">DEPO FARMASI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">SIP</label>
                                <input class="form-control" name="sip" id="e_resep_sip" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input class="form-control" name="alamat" id="e_resep_alamat" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pasien</label>
                                <input class="form-control" name="jenis_pasien" id="e_resep_jenis_pasien"
                                       type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Obat Racikan</label>
                                <textarea style="height: 100%;" name="catatan_obat_racikan" id="e_resep_obat_racikan"
                                          cols="30" rows="5"
                                          class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">No. Reg</label>
                                <input class="form-control" name="noreg" value="{{ $dokumen->noreg }}"
                                       type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">No. Telp</label>
                                <input class="form-control" name="telp" id="e_resep_telp" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <input class="form-control" name="perusahaan" value="{{ $layanan->nama_perusahaan }}" id="e_resep_perusahaan"
                                       type="text" readonly>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="kategori" id="e_resep_kategori" class="form-control">
                                    <option value="">--Select Here--</option>
                                    <option value="umum">UMUM</option>
                                    <option value="ina_cbgs">INA CBGS</option>
                                    <option value="covid">COVID</option>
                                    <option value="kronis">KRONIS</option>
                                    <option value="inhealth">INHEALTH</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12" style="border: 1px dashed"></div>
                    </div>
                    <div class="row pt-3" style="width: 100%; margin-left: 0;">
                        <input type="hidden" id="e_resep_id_obat" readonly class="form-control">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" id="e_resep_kode_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Obat</label>
                                <div class="input-group">
                                    <input type="text" id="e_resep_nama_obat" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button"
                                                onclick="open_modal_list_obat('', 'tambah')"><i
                                                class="fa fa-list"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <input type="text" id="e_resep_jenis_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Sisa</label>
                                <input type="text" id="e_resep_sisa_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <input type="text" id="e_resep_satuan_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah</label>
                                <input type="text" id="e_resep_jumlah_obat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Harga (Rp.)</label>
                                <input type="text" id="e_resep_harga_obat" readonly class="form-control">
                                <input type="hidden" id="e_resep_markup" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Signa</label>
                                <input class="form-control" name="signa" id="e_resep_signa"
                                       type="text">
                            </div>
                            <div id="additional_form_e_resep"></div>
                            {{-- <div class="form-group">
                                <label for="">Jml. Pakai (x Sehari)</label>
                                <input type="number" value="1" id="e_resep_aturan_pakai"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Pemakaian</label>
                                <input type="text" placeholder="Ex : Sesudah makan" id="e_resep_pemakaian"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Takaran</label>
                                <input type="text" id="e_resep_takaran" class="form-control">
                            </div> --}}
                            <div class="form-group text-center">
                                <button class="btn btn-dark" type="button" style="color:#fff;"
                                        onclick="tambah_detail_e_resep()">Tambahkan
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-9 pr-0" style="padding-top: 30px; font-size:12px;">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="text-center" style="line-height: 1.15">
                                        <th>No</th>
                                        <th>Obat</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Signa</th>
                                        <th>Hapus</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list_detail_e_resep"></tbody>
                                    <tfoot id="footer_list_detail_e_resep"></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12 pl-0 pr-0" id="msg_e_resep"></div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal e_resep -->

<!-- modal edit resep -->
<div class="modal fade" style="overflow-y: scroll" id="modal_edit_resep" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Formulir E-Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_edit_resep">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_resep" id="edit_resep_id">
                <input type="hidden" name="detail" id="edit_detail_resep">
                <input type="hidden" name="ruangan" id="edit_ruangan">
                <div class="modal-body">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Waktu</label>
                                <input class="form-control" value="{{ date('Y-m-d') }}" name="waktu"
                                       id="edit_resep_waktu" type="date" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">NRM</label>
                                <input class="form-control" name="nrm" id="edit_resep_nrm" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Usia</label>
                                <input class="form-control" name="usia" id="edit_resep_usia" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Asuransi</label>
                                <input class="form-control" name="asuransi" value="{{ $layanan->asuransi }}" id="edit_resep_asuransi"
                                       type="text" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Dokter</label>
                                <div class="input-group">
                                    <input class="form-control" name="dokter"
                                           value="{{ Auth::user()->realname }}" id="edit_resep_dokter"
                                           type="text" readonly>
                                    <input class="form-control" name="id_dokter" value="{{ Auth::user()->id }}"
                                           id="edit_resep_id_dokter" type="hidden">
                                    <div class="input-grou-append">
                                        <button class="btn btn-dark" type="button"
                                                onclick="open_modal_dokter_e_resep('edit')"><i
                                                class="fa fa-list"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input class="form-control" name="nama" id="edit_resep_nama" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Berat Badan</label>
                                <input class="form-control" name="berat_badan"
                                       value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '' }}"
                                       id="edit_resep_berat_badan" type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Depo Tujuan</label>
                                <select name="depo_tujuan" id="edit_resep_depo_tujuan" class="form-control">
                                    <option value="depo_farmasi">DEPO FARMASI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">SIP</label>
                                <input class="form-control" name="sip" id="edit_resep_sip" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input class="form-control" name="alamat" id="edit_resep_alamat" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pasien</label>
                                <input class="form-control" name="jenis_pasien" id="edit_resep_jenis_pasien"
                                       type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Obat Racikan</label>
                                <textarea style="height: 100%;" name="catatan_obat_racikan" id="edit_resep_obat_racikan"
                                          cols="30"
                                          rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">No. Reg</label>
                                <input class="form-control" id="edit_resep_noreg" name="noreg"
                                       value="{{ $dokumen->noreg }}" type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">No. Telp</label>
                                <input class="form-control" name="telp" id="edit_resep_telp" type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <input class="form-control" name="perusahaan" value="{{ $layanan->nama_perusahaan }}" id="edit_resep_perusahaan"
                                       type="text" readonly>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="kategori" id="edit_kategori" class="form-control">
                                    <option value="">--Select Here--</option>
                                    <option value="umum">UMUM</option>
                                    <option value="ina_cbgs">INA CBGS</option>
                                    <option value="covid">COVID</option>
                                    <option value="kronis">KRONIS</option>
                                    <option value="inhealth">INHEALTH</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12" style="border: 1px dashed"></div>
                    </div>
                    <div class="row pt-3" style="width: 100%; margin-left: 0;">
                        <input type="hidden" id="edit_resep_id_obat" readonly class="form-control">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" id="edit_resep_kode_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Obat</label>
                                <div class="input-group">
                                    <input type="text" id="edit_resep_nama_obat" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button"
                                                onclick="open_modal_list_obat('', 'edit')"><i
                                                class="fa fa-list"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <input type="text" id="edit_resep_jenis_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Sisa</label>
                                <input type="text" id="edit_resep_sisa_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <input type="text" id="edit_resep_satuan_obat" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah</label>
                                <input type="text" id="edit_resep_jumlah_obat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Harga (Rp.)</label>
                                <input type="text" id="edit_resep_harga_obat" readonly class="form-control">
                                <input type="hidden" id="edit_resep_markup" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Signa</label>
                                <input class="form-control" name="signa" id="edit_resep_signa"
                                       type="text">
                            </div>
                            <div id="additional_form_edit_resep"></div>
                            <div class="form-group text-center">
                                <button class="btn btn-dark" type="button" style="color:#fff;"
                                        onclick="tambah_detail_edit_resep()">Tambahkan
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-9 pr-0" style="padding-top: 30px; font-size:12px;">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="text-center" style="line-height: 1.15">
                                        <th>No</th>
                                        <th>Obat</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Signa</th>
                                        <th>Hapus</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list_detail_edit_resep"></tbody>
                                    <tfoot id="footer_list_detail_edit_resep"></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12 pl-0 pr-0" id="msg_edit_resep"></div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal edit resep -->
{{--End Of Resep--}}

{{-- Lab --}}
<div class="modal fade" id="modal_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true" style="overflow-y: scroll">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pesanan Lab</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form_laboratorium" method="post">
            @csrf
            <input type="hidden" name="keluhan_klinis">
            <input type="hidden" name="id_pesanan" id="id_lab">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">No. Reg</label>
                    <input type="text" class="form-control" name="noreg"
                        value="{{ $layanan->id }}" >
                </div>
                <div class="form-group">
                    <label for="">Nama Pasien</label>
                    <input type="text" name="nama_pasien" value="{{ $layanan->nama_pasien }}"
                        class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">NRM</label>
                    <input type="text" name="nrm" value="{{ $layanan->nrm }}" 
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">L/P</label>
                    <select name="kelamin" disabled class="form-control">
                        <option value="1"
                            @if ($layanan->kelamin == 1) {{ 'selected' }} @endif>
                            Perempuan
                        </option>
                        <option value="0"
                            @if ($layanan->kelamin == 0) {{ 'selected' }} @endif>
                            Laki-Laki
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Umur</label>
                    <input type="text"  value="{{ $layanan->umur }}" name="umur"
                        class="form-control">
                </div>
                {{-- <div class="form-group">
                <label for="">Alamat</label> --}}
                <input name="alamat" type="hidden" class="form-control"
                    value="{{ $layanan->alamat }}">
                {{-- </div> --}}
                {{-- <div class="form-group">
                <label for="">Ibu Kandung</label> --}}
                <input type="hidden" name="ibu" value="{{ $layanan->ibu }}" class="form-control">
                {{-- </div> --}}
                {{-- <div class="form-group">
                <label for="">Jenis Pasien</label> --}}
                <input type="hidden" name="jenis_pasien" value="{{ $layanan->carabayar }}"
                    class="form-control">
                {{-- </div> --}}
                <div class="form-group">
                    <label for="">Ruangan</label>
                    <select id="ruangan_lab" name="ruangan" class="form-control">
                        <option value="">--Select Here--</option>
                        @foreach ($ruangan as $ru)
                            <option value="{{ $ru->slug }}"
                                @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                {{ $ru->nama }}
                            </option>
                        @endforeach
                        <option value="pendaftaran"
                            @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                        </option>
                        <option value="laboratory"
                            @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                        </option>
                        <option value="radiology"
                            @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                            Radiology
                        </option>
                        <option value="elektromedis"
                            @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                        </option>
                        <option value="medical_checkup"
                            @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                        </option>
                    </select>
                    {{-- <input type="text" name="ruangan" value="{{ $layanan->last_ruangan }}"
                class="form-control"> --}}
                </div>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date"  value="{{ date('Y-m-d') }}" name="tanggal"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">BED</label>
                    <input type="text" readonly value="{{ $layanan->last_bed }}" name="last_bed"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Kelas</label>
                    <select id="kelas" name="kelas"  style="pointer-events: none;" onclick="return false;" onkeydown="return false;" class="form-control">
                        <option value="">--Select Here--</option>
                        @foreach ($list_kelas as $kls)
                            <option value="{{ $kls->slug }}"
                                @if ($kelas_lab) @if ($kls->slug == $kelas_lab->value)
                                {{ 'selected' }} @endif
                                @endif>{{ $kls->nama }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="kelas" value="{{ $kelas ? $kelas->value : '' }}"
                class="form-control"> --}}
                </div>
                <div class="form-group">
                    <label for="">Reguler / Cito</label>
                    <select id="cito" name="cito" class="form-control">
                        <option value="0">Reguler</option>
                        <option value="1">Cito</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Dokter</label>
                    {{-- <div class="input-group"> --}}
                    <input type="text" id="dokter_lab" name="dokter" 
                        placeholder="Pilih dokter" value="{{ Auth::user()->realname }}"
                        class="form-control">
                    <input type="hidden" value="{{ Auth::user()->id }}" id="id_dokter_lab"
                        name="id_dokter">
                    {{-- <div class="input-group-append">
                        <button type="button" onclick="open_modal_dokter_lab()"
                            class="btn btn-primary"><i class="fa fa-list"></i></button>
                    </div>
                </div> --}}
                </div>
                {{-- <div class="form-group">
                <label for="">Konsultan</label>
                <div class="input-group">
                    <input type="text" name="konsultan" id="konsultan" 
                        placeholder="Pilih konsultan" class="form-control">
                    <input type="hidden" name="id_konsultan" id="id_konsultan">
                    <div class="input-group-append">
                        <button type="button" onclick="open_modal_konsultan()"
                            class="btn btn-primary"><i class="fa fa-list"></i></button>
                    </div>
                </div>
            </div> --}}
                {{-- <div class="form-group">
                <label for="">Petugas</label>
                <div class="input-group">
                    <input type="text" name="petugas" id="petugas_lab" 
                        placeholder="Pilih petugas" class="form-control">
                    <input type="hidden" name="id_petugas" id="id_petugas_lab">
                    <div class="input-group-append">
                        <button type="button" onclick="open_modal_petugas_lab()"
                            class="btn btn-primary"><i class="fa fa-list"></i></button>
                    </div>
                </div>
            </div> --}}
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <input type="text" id="diagnosa_lab" name="diagnosa" value="{{ $layanan->diagnosa ? $layanan->diagnosa->diagnosa != '' ? $layanan->diagnosa->diagnosa : $layanan->diagnosa->nama_icd : '' }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Pesan Pemeriksaan</label>
                    <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan"
                        style="width: 100%" class="form-control">
                        @foreach ($pemeriksaan as $pe)
                            <option value="{{ $pe->slug }}">{{ $pe->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="loading_pesanan_lab"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="modal_hasil_lab" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Hasil Laboratorium</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="link_lampiran_lab" class="pb-2"></div>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Jenis Pemeriksaan</th>
                        <th>Hasil</th>
                        <th>Nilai Rujukan</th>
                    </tr>
                </thead>
                <tbody id="list_hasil_lab">
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        </div>
    </div>
</div>
</div>
{{-- End Of Lab --}}

{{-- Radiologi --}}
<!-- Modal hasil radiologi -->
<div class="modal fade" id="modal_hasil_radiologi" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hasil Radiologi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="link_lampiran_radiologi" class="pb-2"></div>
            <table id="list_hasil_radiologi" style="border-collapse: collapse; width:100%;">

            </table>
        </div>
        <div class="modal-footer">
        </div>
    </div>
</div>
</div>
<!-- End modal hasil radiologi -->

<!-- Modal pesanan radiologi -->
<div class="modal fade" id="modal_pesanan_radiologi" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Radiologi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="form_radiologi">
            <input type="hidden" name="_method" value="post">
            <input type="hidden" name="id_pesanan" id="id_rad">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">No. Reg</label>
                    <input type="text" name="noreg" value="{{ $layanan->id }}" 
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Pasien</label>
                    <input type="text" name="pasien" value="{{ $layanan->nama_pasien }}" 
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">NRM</label>
                    <input type="text" name="nrm" value="{{ $layanan->nrm }}" 
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <input type="hidden" name="kelamin" value="{{ $layanan->kelamin }}" 
                        class="form-control">
                    <input type="text" 
                        value="{{ $layanan->kelamin == 0 ? 'Laki-laki' : 'Perempuan' }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Umur</label>
                    <input type="text" name="umur" value="{{ $layanan->umur }}" 
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Ruangan</label>
                    <select id="ruangan_rad" name="ruangan" class="form-control">
                        <option value="">--Select Here--</option>
                        @foreach ($ruangan as $ru)
                            <option value="{{ $ru->slug }}"
                                @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                {{ $ru->nama }}
                            </option>
                        @endforeach
                        <option value="pendaftaran"
                            @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                        </option>
                        <option value="laboratory"
                            @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                        </option>
                        <option value="radiology"
                            @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                            Radiology
                        </option>
                        <option value="elektromedis"
                            @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                        </option>
                        <option value="medical_checkup"
                            @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Dokter</label>
                    <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}">
                    <input type="text" name="dokter" value="{{ Auth::user()->realname }}" 
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Pesan Pemeriksaan</label>
                    <select name="pesan_pemeriksaan[]" multiple="multiple"
                        id="pesan_pemeriksaan_radiologi" style="width: 100%" class="form-control">
                        @foreach ($pemeriksaan_radiologi as $per)
                            <option value="{{ $per->id }}">{{ $per->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="loading_pesanan_rad"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- End modal pesanan radiologi -->
{{-- End Of Radiologi --}}

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
@include('erm.script_riwayat_laboratorium')
@include('erm.script_riwayat_radiologi')
<script>
    function update_pesanan(){
        $.ajax({
            url : "{{ url('ajax_request/update_pesanan') }}",
            method : 'post',
            data : {
                id_dokumen : '{{ $dokumen->id }}',
                dokumen : 'dokumen_asesment_awal_medis_gawat_darurat',
                id_pesanan_lab : id_pesanan_lab,
                id_pesanan_rad : id_pesanan_rad,
                _token : '{{ csrf_token() }}'
            },
            success:function(response){
                console.log(response);
            }
        })
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        $("#hide_tgl_kedatangan").val($("#tgl_kedatangan").val());
        $("#hide_jam_kedatangan").val($("#jam_kedatangan").val());
        $("#hide_cara_masuk").val($('[name="radio_cara_masuk"]:checked').val());
        $("#hide_ket_cara_masuk").val($("#ket_cara_masuk").val());
        $("#hide_td_keluar").val($("#td_keluar").val());
        $("#hide_td_rr").val($("#td_rr").val());
        $("#hide_td_nadi").val($("#td_nadi").val());
        $("#hide_td_suhu").val($("#td_suhu").val());
        $("#hide_td_spo2").val($("#td_spo2").val());
        $("#hide_asal_rujukan").val($("#asal_rujukan").val());
        $("#hide_cara_bayar").val($('[name="radio_cara_bayar"]:checked').val());
        $("#hide_ket_bayar_lain").val($("#ket_bayar_lain").val());
        $("#hide_kondisi_pasien").val($('[name="radio_kondisi_pasien"]:checked').val());
        $("#hide_ket_kondisi_lain").val($("#ket_kondisi_lain").val());
        $("#hide_jenis_pelayanan").val($('[name="radio_jenis_pelayanan"]:checked').val());
        $("#hide_keluhan_utama").val($("#keluhan_utama").val());
        $("#hide_riwayat_penyakit_sekarang").val($("#riwayat_penyakit_sekarang").val());
        $("#hide_riwayat_penyakit_dahulu").val($("#riwayat_penyakit_dahulu").val());
        $("#hide_riwayat_penyakit_keluarga").val($('[name="radio_riwayat_penyakit_keluarga"]:checked').val());
        $("#hide_ket_riwayat_penyakit_keluarga").val($("#ket_riwayat_penyakit_keluarga").val());
        $("#hide_riwayat_penggunaan_obat").val($('[name="radio_riwayat_penggunaan_obat"]:checked').val());
        $("#hide_ket_riwayat_penggunaan_obat").val($("#ket_riwayat_penggunaan_obat").val());
        $("#hide_riwayat_alergi").val($('[name="radio_riwayat_alergi"]:checked').val());
        $("#hide_ket_riwayat_alergi").val($("#ket_riwayat_alergi").val());
        $("#hide_keadaan_umum").val($('[name="radio_keadaan_umum"]:checked').val());
        $("#hide_kesadaran").val($('[name="radio_kesadaran"]:checked').val());
        $("#hide_e_kesadaran").val($("#e_kesadaran").val());
        $("#hide_m_kesadaran").val($("#m_kesadaran").val());
        $("#hide_v_kesadaran").val($("#v_kesadaran").val());
        $("#hide_status_generalis").val($("#status_generalis").val());
        $("#hide_nyeri").val($('[name="radio_nyeri"]:checked').val());
        $("#hide_sifat_nyeri").val($('[name="radio_sifat_nyeri"]:checked').val());
        $("#hide_kualitas_nyeri").val($('[name="radio_kualitas_nyeri"]:checked').val());
        $("#hide_nyeri_menjalar").val($('[name="radio_menjalar"]:checked').val());
        $("#hide_ket_nyeri_menjalar").val($("#ket_nyeri_menjalar").val());
        $("#hide_skor_nyeri").val($("#skor_nyeri").val());
        $("#hide_frekuensi_nyeri").val($('[name="radio_frekuensi_nyeri"]:checked').val());
        $("#hide_pengaruh_nyeri").val($('[name="radio_pengaruh_nyeri"]:checked').val());
        $("#hide_nilai_wajah").val($("#nilai_wajah").val());
        $("#hide_nilai_kaki").val($("#nilai_kaki").val());
        $("#hide_nilai_aktifitas").val($("#nilai_aktifitas").val());
        $("#hide_nilai_menangis").val($("#nilai_menangis").val());
        $("#hide_nilai_bersuara").val($("#nilai_bersuara").val());
        $("#hide_faktor_pencetus").val($("#faktor_pencetus").val());
        $("#hide_kualitas").val($("#kualitas").val());
        $("#hide_lokasi").val($("#lokasi").val());
        $("#hide_skala_nyeri").val($("#skala_nyeri").val());
        $("#hide_lama_nyeri").val($("#lama_nyeri").val());
        $("#hide_jam_tindakan1").val($("#jam_tindakan1").val());
        $("#hide_tindakan1").val($("#tindakan1").val());
        $("#hide_diberikan_oleh1").val($("#diberikan_oleh1").val());
        $("#hide_keterangan1").val($("#keterangan1").val());
        $("#hide_jam_tindakan2").val($("#jam_tindakan2").val());
        $("#hide_tindakan2").val($("#tindakan2").val());
        $("#hide_diberikan_oleh2").val($("#diberikan_oleh2").val());
        $("#hide_keterangan2").val($("#keterangan2").val());
        $("#hide_jam_tindakan3").val($("#jam_tindakan3").val());
        $("#hide_tindakan3").val($("#tindakan3").val());
        $("#hide_diberikan_oleh3").val($("#diberikan_oleh3").val());
        $("#hide_keterangan3").val($("#keterangan3").val());
        $("#hide_jam_tindakan4").val($("#jam_tindakan4").val());
        $("#hide_tindakan4").val($("#tindakan4").val());
        $("#hide_diberikan_oleh4").val($("#diberikan_oleh4").val());
        $("#hide_keterangan4").val($("#keterangan4").val());
        $("#hide_jam_tindakan5").val($("#jam_tindakan5").val());
        $("#hide_tindakan5").val($("#tindakan5").val());
        $("#hide_diberikan_oleh5").val($("#diberikan_oleh5").val());
        $("#hide_keterangan5").val($("#keterangan5").val());
        $("#hide_jam_tindakan6").val($("#jam_tindakan6").val());
        $("#hide_tindakan6").val($("#tindakan6").val());
        $("#hide_diberikan_oleh6").val($("#diberikan_oleh6").val());
        $("#hide_keterangan6").val($("#keterangan6").val());
        $("#hide_konsultasi").val($("#konsultasi").val());
        $("#hide_indikasi_rawat_inap").val($("#indikasi_rawat_inap").val());
        $("#hide_pulang").val($('[name="radio_pulang"]:checked').val());
        $("#hide_kontrol_poli").val($("#kontrol_poli").val());
        $("#hide_tgl_kontrol").val($("#tgl_kontrol").val());
        $("#hide_rujuk_ke").val($("#rujuk_ke").val());
        $("#hide_alasan_rujuk").val($("#alasan_rujuk").val());
        $("#hide_alasan_menolak").val($("#alasan_menolak").val());
        $("#hide_tgl_keluar").val($("#tgl_keluar").val());
        $("#hide_jam_keluar").val($("#jam_keluar").val());
        $("#hide_kondisi_keluar").val($('[name="radio_kondisi_keluar"]:checked').val());
        $("#hide_tgl_meninggal").val($("#tgl_meninggal").val());
        $("#hide_jam_meninggal").val($("#jam_meninggal").val());
        $("#hide_keadaan_umum_keluar").val($("#keadaan_umum_keluar").val());
        $("#hide_kesadaran_keluar").val($("#kesadaran_keluar").val());
        $("#hide_catatan_penting").val($("#catatan_penting").val());
        $("#hide_edukasi").val($("#edukasi").val());
        $("#hide_penyampaian_edukasi").val($('[name="radio_penyampaian_edukasi"]:checked').val());
        $("#hide_alasan_tidak_menyampaikan_edukasi").val($("#alasan_tidak_menyampaikan_edukasi").val());

        return true;
    }

    function cek_radio_cara_masuk() {
        if ($('[name="radio_cara_masuk"]:checked').val() == 'rujukan') {
            $('#asal_rujukan').removeAttr('disabled');
        } else {
            $('#asal_rujukan').attr('disabled', true);
        }
    }

    function cek_radio_cara_bayar() {
        if ($('[name="radio_cara_bayar"]:checked').val() == 'bayar_lain') {
            $('#ket_bayar_lain').removeAttr('readonly');
        } else {
            $('#ket_bayar_lain').attr('readonly', true);
            $('#ket_bayar_lain').val('');
        }
    }

    function cek_radio_kondisi_pasien() {
        if ($('[name="radio_kondisi_pasien"]:checked').val() == 'kondisi_lain') {
            $('#ket_kondisi_lain').removeAttr('readonly');
        } else {
            $('#ket_kondisi_lain').attr('readonly', true);
            $('#ket_kondisi_lain').val('');
        }
    }

    function cek_radio_riwayat_penyakit_keluarga() {
        if ($('[name="radio_riwayat_penyakit_keluarga"]:checked').val() == 'ada') {
            $('#ket_riwayat_penyakit_keluarga').removeAttr('readonly');
        } else {
            $('#ket_riwayat_penyakit_keluarga').attr('readonly', true);
            $('#ket_riwayat_penyakit_keluarga').val('');
        }
    }

    function cek_radio_riwayat_penggunaan_obat() {
        if ($('[name="radio_riwayat_penggunaan_obat"]:checked').val() == 'ada') {
            $('#ket_riwayat_penggunaan_obat').removeAttr('readonly');
        } else {
            $('#ket_riwayat_penggunaan_obat').attr('readonly', true);
            $('#ket_riwayat_penggunaan_obat').val('');
        }
    }

    function cek_radio_riwayat_alergi() {
        if ($('[name="radio_riwayat_alergi"]:checked').val() == 'ada') {
            $('#ket_riwayat_alergi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_alergi').attr('readonly', true);
            $('#ket_riwayat_alergi').val('');
        }
    }

    function cek_radio_nyeri_menjalar() {
        if ($('[name="radio_menjalar"]:checked').val() == 'ya') {
            $('#ket_nyeri_menjalar').removeAttr('readonly');
        } else {
            $('#ket_nyeri_menjalar').attr('readonly', true);
            $('#ket_nyeri_menjalar').val('');
        }
    }

    function cek_radio_kondisi_keluar() {
        if ($('[name="radio_kondisi_keluar"]:checked').val() == 'ya') {
            $('#tgl_meninggal').removeAttr('readonly');
            $('#jam_meninggal').removeAttr('readonly');
        } else {
            $('#tgl_meninggal').attr('readonly', true);
            $('#tgl_meninggal').val('');
            $('#jam_meninggal').attr('readonly', true);
            $('#jam_meninggal').val('');
        }
    }

    function cek_radio_penyampaian_edukasi() {
        if ($('[name="radio_penyampaian_edukasi"]:checked').val() == 'tidak_dapat_menyampaikan') {
            $('#alasan_tidak_menyampaikan_edukasi').removeAttr('readonly');
        } else {
            $('#alasan_tidak_menyampaikan_edukasi').attr('readonly', true);
            $('#alasan_tidak_menyampaikan_edukasi').val('');
        }
    }

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature64").val('');
        $("#nama_pasien").val('');
    });

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

    var sig = $('#sig').signature({
        syncField: '#signature_status_lokasi',
        syncFormat: 'PNG',
    });

    $('#btn_clear').click(function() {
        sig.signature('clear');
    })
</script>
{{--diagnosa--}}
<script>
    $(document).ready(function () {
        $("#e_resep_nama_obat").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            params: {
                'depo': function () {
                    return $('#e_resep_depo_tujuan').val();
                }
            },
            onSelect: function (suggestion) {
                $('#additional_form_e_resep').html('');
                $("#e_resep_nama_obat").val(suggestion.nama);
                $('#e_resep_kode_obat').val(suggestion.kode_obat);
                $("#e_resep_id_obat").val(suggestion.id);
                $("#e_resep_jenis_obat").val(suggestion.jenis_obat);
                $("#e_resep_satuan_obat").val(suggestion.satuan_obat);
                $("#e_resep_sisa_obat").val(suggestion.sisa);

                get_harga_obat(suggestion.id, 'tambah');
            }
        })

        $("#edit_resep_nama_obat").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            params: {
                'depo': function () {
                    return $('#edit_resep_depo_tujuan').val();
                }
            },
            onSelect: function (suggestion) {
                $('#additional_form_edit_resep').html('');
                $("#edit_resep_nama_obat").val(suggestion.nama);
                $('#edit_resep_kode_obat').val(suggestion.kode_obat);
                $("#edit_resep_id_obat").val(suggestion.id);
                $("#edit_resep_jenis_obat").val(suggestion.jenis_obat);
                $("#edit_resep_satuan_obat").val(suggestion.satuan_obat);
                $("#edit_resep_sisa_obat").val(suggestion.sisa);

                get_harga_obat(suggestion.id, 'edit');
            }
        })

        $('#kontrol_poli').select2();
        $('#diberikan_oleh1').select2();
        $('#diberikan_oleh2').select2();
        $('#diberikan_oleh3').select2();
        $('#diberikan_oleh4').select2();
        $('#diberikan_oleh5').select2();
        $('#diberikan_oleh6').select2();
        $('#konsultasi').select2();
        $('#pesan_pemeriksaan').select2();
        $('#pesan_pemeriksaan_radiologi').select2();
    });

    function open_modal_dokter() {
        $('#modal_petugas').modal('show');
    }

    function open_form_tambah_diagnosa(tipe) {
        if (tipe == 'diagnosa') {
            $("#diagnosa").removeAttr('hidden');
            $("#pembanding").prop('hidden', true);
        } else if (tipe == 'pembanding') {
            $("#diagnosa").prop('hidden', true);
            $("#pembanding").removeAttr('hidden');
        }
        $.ajax({
            url: "{{ url('ajax_request/diagnosa_by_id') }}",
            data: {
                id: '{{ $diagnosa ? $diagnosa->id : 0 }}',
            },
            success: function (response) {
                if (Object.keys(response).length > 0) {
                    $('#tanggal').val(response.tanggal);
                    $('#dokter').val(response.nama_dokter);
                    $('#nip_dokter').val(response.id_dokter);
                    $('#id_dokter').val(response.id_dokter);
                    $('#diagnosa_primer').val(response.diagnosa);
                    $('#diagnosa_sekunder_satu').val(response.diagnosa_sekunder1);
                    $('#diagnosa_sekunder_dua').val(response.diagnosa_sekunder2);
                    $('#diagnosa_sekunder_tiga').val(response.diagnosa_sekunder3);
                    $('#diagnosa_sekunder_empat').val(response.diagnosa_sekunder4);
                    $('#diagnosa_sekunder_lima').val(response.diagnosa_sekunder5);
                    $('#diagnosa_tindakan_satu').val(response.diagnosa_tindakan);
                    $('#diagnosa_tindakan_dua').val(response.diagnosa_tindakan2);
                    $('#diagnosa_tindakan_tiga').val(response.diagnosa_tindakan3);
                    $('#diagnosa_tindakan_empat').val(response.diagnosa_tindakan4);
                    $('#diagnosa_tindakan_lima').val(response.diagnosa_tindakan5);
                    $('#diagnosa_kematian').val(response.diagnosa_kematian);
                    $('#diagnosa_pembanding').val(response.diagnosa_pembanding);
                    $('#icd').val(response.nama_icd);
                    $('#kode_icd').val(response.kode_icd);
                    $('#kode_icd_tindakan').val(response.kode_icd_tindakan);
                    $('#penyebab').val(response.sebab_sakit);
                }
                $('#modal_tambah_diagnosa').modal('show');
            }
        })

        $("#diagnosa_primer").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_primer").val(suggestion.nama);
            }
        });

        $("#diagnosa_pembanding").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_pembanding").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_satu").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_satu").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_dua").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_dua").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_tiga").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_tiga").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_empat").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_empat").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_lima").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_lima").val(suggestion.nama);
            }
        });
    }

    function submit_diagnosa() {
        window.event.preventDefault();
        if ($('#tanggal').val() == '') {
            alert('Pilih tanggal dahulu');
            return;
        }
        if ($('#dokter').val() == '') {
            alert('Pilih dokter dahulu');
            return;
        }
        // if ($('#nip_dokter').val() == '') {
        //     alert('Pilih dokter dahulu');
        //     return;
        // }
        if ($('#diagnosa_primer').val() == '') {
            alert('Pilih diagnosa utama dahulu');
            return;
        }
        $('#box_msg').html(loading('Sedang menyimpan data...', 'info'));
        $('#btn_simpan_diagnosa').attr('disabled', true);
        $.ajax({
            url: "{{ url('ajax_request/update_diagnosa_by_id') }}",
            method: 'post',
            data: $('#form_asesmen').serialize(),
            success: function (response) {
                console.log(response);
                if (!response.status) {
                    alert(response.message);
                    $('#box_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                } else {
                    $('#box_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    let data = response.data;
                    var temp = '';
                    $('#box_diagnosa').html(data.diagnosa);
                    if (data.diagnosa_sekunder1 != '') {
                        temp += response.kode_sekunder1.icd + ' - ' + data.diagnosa_sekunder1;
                    }
                    if (data.diagnosa_sekunder2 != '') {
                        temp += '<br>' + response.kode_sekunder2.icd + ' - ' + data.diagnosa_sekunder2;
                    }
                    if (data.diagnosa_sekunder3 != '') {
                        temp += '<br>' + response.kode_sekunder3.icd + ' - ' + data.diagnosa_sekunder3;
                    }
                    if (data.diagnosa_sekunder4 != '') {
                        temp += '<br>' + response.kode_sekunder4.icd + ' - ' + data.diagnosa_sekunder4;
                    }
                    if (data.diagnosa_sekunder5 != '') {
                        temp += '<br>' + response.kode_sekunder5.icd + ' - ' + data.diagnosa_sekunder5;
                    }
                    $('#box_diagnosa').html(data.kode_icd + ' - ' + data.nama_icd);
                    $('#box_diagnosa_pembanding').html(data.kode_icd_diagnosa_pembanding + ' - ' + data.nama_diagnosa_pembanding);
                    $('#box_diagnosa_sekunder').html(temp);
                    $('#box_btn_asesmen').html(
                        '<button class="btn btn-warning" onclick="open_form_tambah_diagnosa()" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>'
                    );
                }
                $('#btn_simpan_diagnosa').removeAttr('disabled');
                $('#box_msg').html('');
                $('#modal_tambah_diagnosa').modal('hide');
            }
        })
    }
</script>
{{--end of diagnosa--}}

{{--E RESEP--}}
<script>
    var detail_e_resep = [];
    var detail_edit_resep = [];

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }

    function open_modal_e_resep() {
        $.ajax({
            url: "{{ url('ajax_request/select_kunjungan') }}",
            data: {
                noreg: '{{ $dokumen->noreg }}'
            },
            success: function (response) {
                console.log(response);
                $('#e_resep_nrm').val(response.nrm);
                $('#e_resep_nama').val(response.nama_pasien);
                $('#e_resep_usia').val(response.umur);
                $('#e_resep_alamat').val(response.alamat_pasien);
                $('#e_resep_telp').val(response.telp);
                $('#e_resep_jenis_pasien').val(response.carabayar);
                $('#modal_e_resep').modal('show');
            }
        })
    }

    function open_modal_edit_resep(param) {
        $.ajax({
            url: "{{ url('ajax_request/select_resep') }}",
            data: {
                id: param
            },
            success: function (response) {
                console.log(response);
                $('#edit_resep_id').val(response.id);
                $('#edit_resep_nrm').val(response.nrm_pasien);
                $('#edit_resep_noreg').val(response.noreg_pasien);
                $('#edit_resep_nama').val(response.nama_pasien);
                $('#edit_resep_usia').val(response.usia);
                $('#edit_resep_id_dokter').val(response.id_dokter);
                $('#edit_resep_dokter').val(response.nama_dokter);
                $('#edit_resep_sip').val(response.sip_dokter);
                $('#edit_resep_id_dokter').val(response.id_dokter);
                $('#edit_resep_alamat').val(response.alamat_pasien);
                $('#edit_resep_telp').val(response.no_telpon);
                $('#edit_resep_jenis_pasien').val(response.jenis);
                $('#edit_resep_depo_tujuan').val(response.depo).trigger('change');
                // $('#edit_kategori').val(response.kategori).trigger('change');
                $('#edit_resep_obat_racikan').val(response.catatan_obat_racikan);
                $('#edit_resep_signa').val(response.signa);

                mapping_edit_detail(response.detail);
            }
        })
    }

    function mapping_edit_detail(data) {
        detail_edit_resep = [];
        if (data != undefined) {
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    detail_edit_resep.push({
                        id: data[i].id,
                        id_obat: data[i].id_obat,
                        kode_obat: data[i].kode_obat,
                        nama_obat: data[i].nama_obat,
                        nama_jenis_obat: data[i].nama_jenis_obat,
                        jumlah: parseFloat(data[i].jumlah),
                        satuan: data[i].satuan,
                        aturan_pakai: data[i].aturan_pakai ? data[i].aturan_pakai : '',
                        obat_luar_check: data[i].obat_luar_check ? data[i].obat_luar_check : 0,
                        malam_check: data[i].malam_check ? data[i].malam_check : 0,
                        malam: data[i].malam ? data[i].malam : '',
                        sore_check: data[i].sore_check ? data[i].sore_check : 0,
                        sore: data[i].sore ? data[i].sore : '',
                        siang_check: data[i].siang_check ? data[i].siang_check : 0,
                        siang: data[i].siang ? data[i].siang : '',
                        pagi_check: data[i].pagi_check ? data[i].pagi_check : 0,
                        pagi: data[i].pagi ? data[i].pagi : '',
                        pemakaian: data[i].pemakaian,
                        keterangan_tambahan: data[i].keterangan_tambahan ? data[i].keterangan_tambahan : '',
                        satuan_pakai: data[i].satuan_pakai,
                        takaran_pakai: data[i].takaran_pakai,
                        jumlah_pakai_sehari: data[i].jumlah_pakai_sehari,
                        aturan_pakai_mode: data[i].aturan_pakai_mode ? data[i].aturan_pakai_mode : '',
                        harga: parseFloat(data[i].harga),
                        markup: data[i].markup,
                        signa: data[i].signa,
                        deleted: false
                    });
                }
            }
        }
        console.log(detail_edit_resep);
        render_detail_edit_resep();
    }

    function tambah_detail_edit_resep() {
        if ($('#edit_resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }
        if ($('#edit_resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }
        if (confirm('Yakin data yang dimasukkan sudah benar ?')) {
            detail_edit_resep.push({
                id: '',
                id_obat: parseInt($('#edit_resep_id_obat').val()),
                kode_obat: $('#edit_resep_kode_obat').val(),
                nama_obat: $('#edit_resep_nama_obat').val(),
                nama_jenis_obat: $('#edit_resep_jenis_obat').val(),
                jumlah: parseFloat($('#edit_resep_jumlah_obat').val()),
                satuan: $('#edit_resep_satuan_obat').val(),
                aturan_pakai: $('#edit_resep_aturan_pakai').val(),
                obat_luar_check: parseInt($('#edit_resep_obat_luar_aktif').val()),
                malam_check: $('#edit_resep_malam').is(':checked') ? 1 : 0,
                malam: "",
                sore_check: $('#edit_resep_sore').is(':checked') ? 1 : 0,
                sore: "",
                siang_check: $('#edit_resep_siang').is(':checked') ? 1 : 0,
                siang: "",
                pagi_check: $('#edit_resep_pagi').is(':checked') ? 1 : 0,
                pagi: "",
                pemakaian: $('#edit_resep_pemakaian').val(),
                keterangan_tambahan: "",
                satuan_pakai: $('#edit_resep_satuan_obat').val(),
                takaran_pakai: $('#edit_resep_satuan_pakai').val(),
                jumlah_pakai_sehari: $('#edit_resep_jumlah_pakai').val(),
                aturan_pakai_mode: $('#edit_resep_aturan_pakai_mode').val(),
                harga: parseFloat($('#edit_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(
                    ',', '.')),
                markup: parseInt($('#edit_resep_markup').val()),
                signa: $('#edit_resep_signa').val(),
                deleted: false
            });
            $('#edit_resep_id_obat').val('');
            $('#edit_resep_kode_obat').val('');
            $('#edit_resep_nama_obat').val('');
            $('#edit_resep_jenis_obat').val('');
            $('#edit_resep_sisa_obat').val('');
            $('#edit_resep_satuan_obat').val('');
            $('#edit_resep_jumlah_obat').val('');
            $('#edit_resep_harga_obat').val('');
            $('#edit_resep_signa').val('');
            $('#additional_form_edit_resep').html('');
            console.log(detail_edit_resep);
            render_detail_edit_resep();
        }
    }

    function preview_terapi(param) {
        $('#modal_preview').modal('show');
    }

    function lock_terapi(param) {
        if (confirm('Apakah anda yakin melanjutkan lock e-resep ? resep yang dilock tidak dapat diubah lagi')) {
            $.ajax({
                url: "{{ url('ajax_request/lock_resep') }}",
                data: {
                    id: param
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                }
            })
        }
    }

    function open_modal_list_obat(param, tipe_form) {
        if (tipe_form == 'tambah') {
            if ($('#e_resep_depo_tujuan').val() == '') {
                alert('Pilih depo tujuan dahulu');
                return;
            }
            $('#modal_e_resep').modal('hide');
        } else {
            if ($('#edit_resep_depo_tujuan').val() == '') {
                alert('Pilih depo tujuan dahulu');
                return;
            }
            $('#modal_edit_resep').modal('hide');
        }
        get_list_obat(param, tipe_form);
        $('#modal_list_obat').modal('show');
    }

    function tambah_detail_e_resep() {
        if ($('#e_resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }
        if ($('#e_resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }
        if (confirm('Yakin data yang dimasukkan sudah benar ?')) {
            detail_e_resep.push({
                id: '',
                id_obat: parseInt($('#e_resep_id_obat').val()),
                kode_obat: $('#e_resep_kode_obat').val(),
                nama_obat: $('#e_resep_nama_obat').val(),
                nama_jenis_obat: $('#e_resep_jenis_obat').val(),
                jumlah: parseFloat($('#e_resep_jumlah_obat').val()),
                satuan: $('#e_resep_satuan_obat').val(),
                aturan_pakai: $('#e_resep_aturan_pakai').val(),
                obat_luar_check: $('#e_resep_obat_luar_aktif').val(),
                malam_check: $('#e_resep_malam').is(':checked') ? 1 : 0,
                malam: "",
                sore_check: $('#e_resep_sore').is(':checked') ? 1 : 0,
                sore: "",
                siang_check: $('#e_resep_siang').is(':checked') ? 1 : 0,
                siang: "",
                pagi_check: $('#e_resep_pagi').is(':checked') ? 1 : 0,
                pagi: "",
                pemakaian: $('#e_resep_pemakaian').val(),
                keterangan_tambahan: "",
                satuan_pakai: $('#e_resep_satuan_obat').val(),
                takaran_pakai: $('#e_resep_satuan_pakai').val(),
                jumlah_pakai_sehari: $('#e_resep_jumlah_pakai').val(),
                aturan_pakai_mode: $('#e_resep_aturan_pakai_mode').val(),
                harga: parseFloat($('#e_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(
                    ',', '.')),
                markup: parseInt($('#e_resep_markup').val()),
                signa: $('#e_resep_signa').val()
            });

            $('#e_resep_id_obat').val('');
            $('#e_resep_kode_obat').val('');
            $('#e_resep_nama_obat').val('');
            $('#e_resep_jenis_obat').val('');
            $('#e_resep_sisa_obat').val('');
            $('#e_resep_satuan_obat').val('');
            $('#e_resep_jumlah_obat').val('');
            $('#e_resep_harga_obat').val('');
            $('#e_resep_signa').val('');
            $('#additional_form_e_resep').html('');
            $('#e_resep_signa').val('');
            console.log(detail_e_resep);
            render_detail_e_resep();
        }
    }

    function render_detail_e_resep() {
        var ins = '';
        var footer = '';
        let jml = 0;
        for (let i = 0; i < detail_e_resep.length; i++) {
            ins += '<tr>' +
                '<td class="text-center">' + (i + 1) + '</td>' +
                '<td>' + detail_e_resep[i].nama_obat + '</td>' +
                '<td class="text-center">' + detail_e_resep[i].nama_jenis_obat + '</td>' +
                '<td class="text-center">' + detail_e_resep[i].jumlah + '</td>' +
                '<td class="text-center">' + detail_e_resep[i].satuan + '</td>' +
                '<td>Rp. ' + rupiah(detail_e_resep[i].harga) + '</td>' +
                '<td>Rp. ' + rupiah((detail_e_resep[i].harga * detail_e_resep[i].jumlah).toFixed(2)) +
                '</td>' +
                '<td class="text-center">' + detail_e_resep[i].signa + '</td>' +
                '<td class="text-center"><button onclick="hapus_detail_e_resep(' + i +
                ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>' +
                '</tr>';
            jml += parseFloat((detail_e_resep[i].harga * detail_e_resep[i].jumlah).toFixed(2));
        }
        if (detail_e_resep.length > 0) {
            footer = '<tr>' +
                '<td colspan="6" style="text-align:right; font-weight:bold;">Total : </td>' +
                '<td style="font-weight:bold;">Rp. ' + rupiah(jml) + '</td>' +
                '<td colspan="2"></td>' +
                '</tr>';
        }
        $('#list_detail_e_resep').html(ins);
        $('#footer_list_detail_e_resep').html(footer);

        // if (detail_e_resep.length > 0) {
        //     $('#e_resep_kategori').prop('disabled', true);
        // }
    }

    function render_detail_edit_resep() {
        var ins = '';
        var footer = '';
        let jml = 0;
        for (let i = 0; i < detail_edit_resep.length; i++) {
            if (!detail_edit_resep[i].deleted) {
                ins += '<tr>' +
                    '<td class="text-center">' + (i + 1) + '</td>' +
                    '<td>' + detail_edit_resep[i].nama_obat + '</td>' +
                    '<td class="text-center">' + detail_edit_resep[i].nama_jenis_obat + '</td>' +
                    '<td class="text-center">' + detail_edit_resep[i].jumlah + '</td>' +
                    '<td class="text-center">' + detail_edit_resep[i].satuan + '</td>' +
                    '<td>Rp. ' + rupiah(detail_edit_resep[i].harga) + '</td>' +
                    '<td>Rp. ' + rupiah((detail_edit_resep[i].harga * detail_edit_resep[i].jumlah).toFixed(2)) +
                    '</td>' +
                    '<td class="text-center">' + detail_edit_resep[i].signa + '</td>' +
                    '<td class="text-center"><button onclick="hapus_detail_edit_resep(' + i +
                    ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>' +
                    '</tr>';
                jml += parseFloat((detail_edit_resep[i].harga * detail_edit_resep[i].jumlah).toFixed(2));
            }
        }
        if (detail_edit_resep.length > 0) {
            footer = '<tr>' +
                '<td colspan="6" style="text-align:right; font-weight:bold;">Total : </td>' +
                '<td style="font-weight:bold;">Rp. ' + rupiah(jml) + '</td>' +
                '<td colspan="2"></td>' +
                '</tr>';
        }
        $('#list_detail_edit_resep').html(ins);
        $('#footer_list_detail_edit_resep').html(footer);
        $('#modal_edit_resep').modal('show');

        // if (detail_edit_resep.length > 0) {
        //     $('#edit_kategori').prop('disabled', true);
        // }
    }

    function set_dokter_e_resep(nama, id, sip, tipe) {
        $('#e_resep_dokter').val(nama);
        $('#e_resep_id_dokter').val(id);
        tipe == 'tambah' ? $('#e_resep_sip').val(sip) : $('#edit_resep_sip').val(sip);
        $('#modal_dokter_e_resep').modal('hide');
        tipe == 'tambah' ? $('#modal_e_resep').modal('show') : $('#modal_edit_resep').modal('show');
    }

    function hapus_detail_e_resep(index) {
        if (confirm('Yakin melanjutkan hapus data ?')) {
            detail_e_resep.splice(index, 1);
            render_detail_e_resep();
        }
    }

    function hapus_detail_edit_resep(index) {
        if (confirm('Yakin melanjutkan hapus data ?')) {
            detail_edit_resep[index].deleted = true;
            render_detail_edit_resep();
        }
    }

    function open_modal_list_obat(param, tipe_form) {
        if (tipe_form == 'tambah') {
            if ($('#e_resep_depo_tujuan').val() == '') {
                alert('Pilih depo tujuan dahulu');
                return;
            }
            $('#modal_e_resep').modal('hide');
        } else {
            if ($('#edit_resep_depo_tujuan').val() == '') {
                alert('Pilih depo tujuan dahulu');
                return;
            }
            $('#modal_edit_resep').modal('hide');
        }
        get_list_obat(param, tipe_form);
        $('#modal_list_obat').modal('show');
    }

    $('#form_search_obat').submit(function (e) {
        e.preventDefault();
        get_list_obat($('#search_obat').val(), "tambah");
    })

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function get_list_obat(kriteria, tipe_form) {
        $('#msg_list_obat').html('');
        if ($.fn.DataTable.isDataTable("#tabel_list_obat")) {
            $('#tabel_list_obat').DataTable().clear().destroy();
        }
        $('#tabel_list_obat').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: "../../ajax_request/list_obat?depo=" + (tipe_form == 'tambah' ? $('#e_resep_depo_tujuan')
                    .val() : $('#edit_resep_depo_tujuan').val()) + '&kriteria=' +
                kriteria,
            columns: [{
                data: 'nama_obat',
                name: 'nama_obat'
            },
                {
                    data: 'nama_jenis_obat',
                    name: 'nama_jenis_obat'
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    render: function (data, type, row) {
                        return '';
                    }
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    render: function (data, type, row) {
                        return '';
                    }
                },
                {
                    data: 'sisa',
                    name: 'sisa',
                    render: function (data, type, row) {
                        return data + ' ' + capitalizeFirstLetter(row.satuan);
                    }
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return '<div class="text-center">' +
                            '<button onclick="get_detail_obat(' + "'" + data + "','" + row.kode_obat +
                            "','" + row.nama_obat + "','" + row.satuan + "','" + row.nama_jenis_obat +
                            "','" + row.sisa + "','" + tipe_form + "'" +
                            ')" class="btn btn-dark"><i class="fa fa-check"></i></button>' +
                            '</div>';
                    }
                },
            ]
        });
    }

    function get_detail_obat(param, kode, nama, satuan, jenis, sisa, tipe_form) {
        $('#msg_list_obat').html(loading('Sedang mengambil harga obat, harap tunggu...', 'info'));
        if (tipe_form == 'edit') {
            $('#edit_resep_id_obat').val(param);
            $('#edit_resep_kode_obat').val(kode);
            $('#edit_resep_nama_obat').val(nama);
            $('#edit_resep_satuan_obat').val(satuan);
            $('#edit_resep_jenis_obat').val(jenis);
            $('#edit_resep_sisa_obat').val(sisa);
        } else {
            $('#e_resep_id_obat').val(param);
            $('#e_resep_kode_obat').val(kode);
            $('#e_resep_nama_obat').val(nama);
            $('#e_resep_satuan_obat').val(satuan);
            $('#e_resep_jenis_obat').val(jenis);
            $('#e_resep_sisa_obat').val(sisa);
        }
        get_harga_obat(param, tipe_form);
    }

    function get_harga_obat(param, tipe_form) {
        $.ajax({
            url: "{{ url('ajax_request/harga_obat') }}",
            data: {
                noreg: "{{ $layanan->id }}",
                id_obat: param,
                // kategori: (tipe_form == 'tambah' ? $('#e_resep_kategori').val() : $('#edit_kategori')
                //     .val()),
                depo: (tipe_form == 'tambah' ? $('#e_resep_depo_tujuan').val() : $('#edit_resep_depo_tujuan')
                    .val())
            },
            success: function (response) {
                console.log(response);
                if (response == null) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">Harga obat tidak ditemukan</div>');
                    return;
                } else if (response.code == 500) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">' + response.message + '</div>');
                    return;
                }
                if (tipe_form == 'edit') {
                    $('#edit_resep_harga_obat').val(rupiah(response.toFixed(2)));
                    $('#modal_list_obat').modal('hide');
                    $('#modal_edit_resep').modal('show');
                } else {
                    $('#e_resep_harga_obat').val(rupiah(response.toFixed(2)));
                    $('#modal_list_obat').modal('hide');
                    $('#modal_e_resep').modal('show');
                }
            }
        })
    }

    function render_field_pemakaian(data) {
        var ins = '';
        if (data.pemakaian_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Pemakaian</label>' +
                '<select class="form-control" id="e_resep_pemakaian">' +
                '<option value="">--Select Here--</option>';

            let temp_pemakaian_option = data.pemakaian_option.split(';');
            console.log(temp_pemakaian_option);

            for (let i = 0; i < temp_pemakaian_option.length; i++) {
                ins += '<option value="' + temp_pemakaian_option[i] + '">' + temp_pemakaian_option[i] + '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_satuan_pakai(data) {
        var ins = '<div class="form-group">' +
            '<label>Satuan Pakai</label>' +
            '<select class="form-control" id="e_resep_satuan_pakai">' +
            '<option value="">--Select Here--</option>';

        let temp_satuan_pakai_option = data.satuan_pakai_option.split(';');

        for (let i = 0; i < temp_satuan_pakai_option.length; i++) {
            ins += '<option value="' + temp_satuan_pakai_option[i] + '">' + temp_satuan_pakai_option[i] +
                '</option>';
        }

        ins += '</select>' +
            '</div>';

        return ins;
    }

    function render_field_edit_satuan_pakai(data) {
        var ins = '<div class="form-group">' +
            '<label>Satuan Pakai</label>' +
            '<select class="form-control" id="edit_resep_satuan_pakai">' +
            '<option value="">--Select Here--</option>';

        let temp_satuan_pakai_option = data.satuan_pakai_option.split(';');

        for (let i = 0; i < temp_satuan_pakai_option.length; i++) {
            ins += '<option value="' + temp_satuan_pakai_option[i] + '">' + temp_satuan_pakai_option[i] +
                '</option>';
        }

        ins += '</select>' +
            '</div>';

        return ins;
    }

    function render_field_aturan_pakai(data) {
        var ins = '';
        if (data.aturan_pakai_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Aturan Pakai</label>' +
                '<select class="form-control" id="e_resep_aturan_pakai">' +
                '<option value="">--Select Here--</option>';

            let temp_aturan_pakai_option = data.aturan_pakai_option.split(';');
            console.log(temp_aturan_pakai_option);

            for (let i = 0; i < temp_aturan_pakai_option.length; i++) {
                ins += '<option value="' + temp_aturan_pakai_option[i] + '">' + temp_aturan_pakai_option[i] +
                    '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_pagi_siang_sore(data) {
        var ins = '';
        ins += '<div class="form-group">' +
            '<label>Pagi</label>' +
            '<input style="margin-left:34px" type="checkbox" id="e_resep_pagi">';

        ins += '<div class="form-group">' +
            '<label>Siang</label>' +
            '<input style="margin-left:25px;" type="checkbox" id="e_resep_siang">';
        ins += '<div class="form-group">' +
            '<label>Sore</label>' +
            '<input style="margin-left:33px" type="checkbox" id="e_resep_sore">';
        ins += '<div class="form-group">' +
            '<label>Malam</label>' +
            '<input class="ml-3" type="checkbox" id="e_resep_malam">';
        return ins;
    }

    function render_field_edit_pemakaian(data) {
        var ins = '';
        if (data.pemakaian_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Pemakaian</label>' +
                '<select class="form-control" id="edit_resep_pemakaian">' +
                '<option value="">--Select Here--</option>';

            let temp_pemakaian_option = data.pemakaian_option.split(';');
            console.log(temp_pemakaian_option);

            for (let i = 0; i < temp_pemakaian_option.length; i++) {
                ins += '<option value="' + temp_pemakaian_option[i] + '">' + temp_pemakaian_option[i] + '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_edit_aturan_pakai(data) {
        var ins = '';
        if (data.aturan_pakai_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Aturan Pakai</label>' +
                '<select class="form-control" id="edit_resep_aturan_pakai">' +
                '<option value="">--Select Here--</option>';

            let temp_aturan_pakai_option = data.aturan_pakai_option.split(';');
            console.log(temp_aturan_pakai_option);

            for (let i = 0; i < temp_aturan_pakai_option.length; i++) {
                ins += '<option value="' + temp_aturan_pakai_option[i] + '">' + temp_aturan_pakai_option[i] +
                    '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_edit_pagi_siang_sore(data) {
        var ins = '';
        if (data.pagi_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Pagi</label>' +
                '<input style="margin-left:34px" checked value="1" type="checkbox" id="edit_resep_pagi">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Pagi</label>' +
                '<input style="margin-left:34px" type="checkbox" id="edit_resep_pagi">';
        }
        if (data.siang_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Siang</label>' +
                '<input style="margin-left:25px;" checked value="1" type="checkbox" id="edit_resep_siang">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Siang</label>' +
                '<input style="margin-left:25px;" type="checkbox" id="edit_resep_siang">';
        }
        if (data.sore_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Sore</label>' +
                '<input style="margin-left:33px" checked value="1" type="checkbox" id="edit_resep_sore">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Sore</label>' +
                '<input style="margin-left:33px" type="checkbox" id="edit_resep_sore">';
        }
        if (data.malam_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Malam</label>' +
                '<input class="ml-3" checked value="1" type="checkbox" id="edit_resep_malam">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Malam</label>' +
                '<input class="ml-3" type="checkbox" id="edit_resep_malam">';
        }
        return ins;
    }

    function rupiah(param) {
        if (param == '' || param == null) {
            return '';
        }
        var temp = param.toString().replaceAll('.', ',');
        return temp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#form_e_resep').submit(function (e) {
        e.preventDefault();
        $('#detail_resep').val(JSON.stringify(detail_e_resep));
        $('#msg_e_resep').html('<div class="alert alert-info">' + loading(
            'Sedang menyimpan resep, harap tunggu...', 'sm') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/resep_store') }}",
            method: 'post',
            data: $('#form_e_resep').serialize(),
            success: function (response) {
                console.log(response);
                if (response.code == 200) {
                    $('#msg_e_resep').html('<div class="alert alert-success">' + response
                        .message + '</div>');
                    var ins = '';
                    if (response.data.locked == 0) {
                        ins += '<button class="btn btn-warning"' +
                            'onclick="open_modal_edit_resep(' + response.data.id +
                            ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>';
                    }
                    ins += '<button class="btn btn-info ml-1"' +
                        'onclick="preview_terapi(' + response.data.id + ')"><i class="fa fa-book"' +
                        'style="color:#fff;"></i></button>' +
                        '<button class="btn btn-info ml-1"' +
                        'onclick="lock_terapi(' + response.data.id + ')"><i class="fa fa-lock"' +
                        'style="color:#fff;"></i></button>';
                    $('#box_btn_terapi').html(ins)
                    $('#modal_e_resep').modal('hide');
                    return;
                } else {
                    $('#msg_e_resep').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                }
            }
        })
    })

    $('#form_edit_resep').submit(function (e) {
        window.event.preventDefault();
        $('#edit_detail_resep').val(JSON.stringify(detail_edit_resep));
        $('#msg_edit_resep').html('<div class="alert alert-info">' + loading(
            'Sedang menyimpan resep, harap tunggu...', 'sm') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/resep_update') }}",
            method: 'post',
            data: $('#form_edit_resep').serialize(),
            success: function (response) {
                console.log(response);
                if (response.code == 200) {
                    $('#msg_edit_resep').html('<div class="alert alert-success">' + response
                        .message + '</div>');
                    $('#modal_edit_resep').modal('hide');
                    return;
                } else {
                    $('#msg_edit_resep').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                }
            }
        })
    })

    function open_modal_dokter_e_resep(param) {
        if ($.fn.DataTable.isDataTable('#tabel_dokter_e_resep')) {
            $('#tabel_dokter_e_resep').dataTable().fnClearTable();
            $('#tabel_dokter_e_resep').dataTable().fnDestroy();
        }
        $('#tabel_dokter_e_resep').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('ajax_request/datatable_dokter') }}",
            columns: [{
                data: 'nama',
                name: 'nama'
            },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'no_ijin',
                    name: 'no_ijin'
                },
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_dokter_e_resep(' +
                            "'" + row.nama + "','" + data + "','" + row.no_ijin + "','" + param + "'" +
                            ')"><i class="fa fa-check"></i></button></div>';
                    }
                },
            ]
        });
        param == 'tambah' ? $('#modal_e_resep').modal('hide') : $('#modal_edit_resep').modal('hide');
        $('#modal_dokter_e_resep').modal('show');
    }
</script>
{{--END OF E RESEP--}}

{{-- LAB --}}
<script>
    let id_pesanan_lab = <?php echo $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->id_pesanan_lab : '0' ?>;
    function open_modal_lab() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: id_pesanan_lab,
            },
            success: function(response) {
                console.log(response);
                let temp = [];
                if(Object.keys(response).length !== 0){
                    if (response.status != 'Pesanan ERM') {
                        alert('Tidak diperkenankan ubah pesanan laboratorium');
                        return;
                    }
                }
                if(Object.keys(response).length !== 0){
                    const periksa = JSON.parse(response.periksa);
                    console.log(periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push(`${key}`);
                        }
                        console.log(`${key} ${value}`);
                    });
                    console.log('-------------------');
                    $('#pesan_pemeriksaan').val(temp).change();
                    $('#ruangan_lab').val(response.ruangan);
                    $('#kelas').val(response.kelas);
                    $('#cito').val(response.cito);
                }
                $('#id_lab').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#modal_lab').modal('show');
            }
        })
    }

    function hapus_pesanan_lab(param){
        if (confirm('Yakin melanjutkan hapus pesanan laboratorium ?')) {
            $.ajax({
                url : "{{ url('ajax_request/hapus_pesanan_lab') }}",
                data : {
                    id : param
                },
                success : function(response){
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#list_pesanan').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_lab').val(0);
                    update_pesanan();
                }
            })
        }
    }

    function open_modal_hasil_lab(param) {
        let cek = false
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                console.log(response);
                if (response == null) {
                    return;
                }
                let temp = JSON.parse(response.hasil);
                let hasil = Object.entries(temp);
                let key_hasil = Object.keys(hasil);
                for (let i = 0; i < hasil.length; $i++) {
                    if (hasil[key_hasil[i]] != '') {
                        cek = true;
                        break;
                    }
                }
                var ins = '';
                if (cek) {
                    let temp_grup = '';
                    let master_hasil = <?php echo $master_hasil; ?>;
                    console.log(master_hasil);
                    for (let i = 0; i < master_hasil.length; i++) {
                        if (temp[master_hasil[i].slug] != '') {
                            if (temp_grup != master_hasil[i].grup) {
                                ins += '<tr>' +
                                    '<th colspan="3">' + master_hasil[i].grup + '</th>' +
                                    '</tr>';
                                temp_grup = master_hasil[i].grup;
                            }
                            if (temp[master_hasil[i].slug] != undefined && temp[master_hasil[i].slug] != '') {
                                ins += '<tr>' +
                                    '<td style="padding-left: 40px">' + master_hasil[i].name + '</td>' +
                                    '<td class="text-center" style="' + cek_nilai_normal(temp[master_hasil[i]
                                        .slug], master_hasil[i]) + '">' + temp[master_hasil[i].slug] + '</td>' +
                                    '<td class="text-center">' + master_hasil[i].nt + '</td>' +
                                    '</tr>';
                            }
                        }
                    }
                } else {
                    ins = '<tr>' +
                        '<th colspan="3" class="text-center">Tidak ada hasil</th>' +
                        '</tr>';
                }
                let file = response.file != '' ? JSON.parse(response.file) : [''];
                if(file[0] != ''){
                    $('#link_lampiran_lab').html('<a style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL') }}/'+file[0]+'" target="_blank">Download lampiran klik disini</a>');
                }
                $('#list_hasil_lab').html(ins);
                $('#modal_hasil_lab').modal('show');
            }
        })
    }

    function cek_nilai_normal(nilai, master) {
        let kelamin = '{{ $layanan->kelamin }}';
        switch (master.nn) {
            case 'less-than':
                if (nilai < master.lessthan) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'more-than':
                if (nilai > master.morethan) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'between':
                if (nilai >= master.valmin && nilai <= master.valmax) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'diantara_sampai':
                if (nilai >= master.valmin && nilai <= master.valmax) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'same':
                if (nilai == master.sameval) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'reaktif_nonreaktif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif_2':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'normal':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif_positif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'laper':
                if (kelamin == '0') {
                    if (nilai >= master.lmin && nilai <= master.lmax) {
                        return '';
                    }
                    return 'font-weight:bold; color:red';
                } else if (kelamin == '1') {
                    if (nilai >= master.pmin && nilai <= master.pmax) {
                        return '';
                    }
                    return 'font-weight:bold; color:red';
                }
                return '';
                break;

            default:
                return '';
                break;
        }
    }

    $('#form_laboratorium').submit(function(e) {
        e.preventDefault();
        $('[name=keluhan_klinis]').val($('#keluhan_utama').val());
        $('#loading_pesanan_lab').html('<div class="alert alert-info">' + loading('Sedang menyimpan data...',
            'sm') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_store_by_id') }}",
            method: 'post',
            data: $('#form_laboratorium').serialize(),
            success: function(response) {
                if (!response.status) {
                    $('#loading_pesanan_lab').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                    return;
                }
                $('#modal_lab').modal('hide');
                let data = response.data;
                console.log(data);
                id_pesanan_lab = data.id;
                $('#id_lab').val(id_pesanan_lab);
                $('#loading_pesanan_lab').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                let pemeriksaan = <?php echo $pemeriksaan; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                ins += data.no_lab + ' - ';
                var temp = JSON.parse(data.periksa);
                for (let j = 0; j < pemeriksaan.length; j++) {
                    var temp_slug = pemeriksaan[j].slug;
                    if (temp[temp_slug] == 1) {
                        if (iterasi_pesanan < 1) {
                            ins += pemeriksaan[j].nama;
                        } else {
                            ins += ', ' + pemeriksaan[j].nama;
                        }
                        iterasi_pesanan++;
                    }
                }
                $('#box_button_pesanan_lab').html('');
                $('#list_pesanan').html(
                    '<button type="button" class="btn btn-warning" onclick="open_modal_lab()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_lab(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-danger ml-1" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_lab(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' +
                    ins);
                update_pesanan();
            }
        })
    });
</script>
{{-- END OF LAB --}}

{{-- RADIOLOGI --}}
<script>
    let id_pesanan_rad = <?php echo $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->id_pesanan_rad : '0' ?>;
    function open_modal_pesanan_radiologi() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: id_pesanan_rad,
            },
            success: function(response) {
                console.log(response);
                if(Object.keys(response).length !== 0){
                    if (response.status != 'Pesanan ERM') {
                        alert('Tidak diperkenankan ubah pesanan radiologi');
                        return;
                    }
                }

                let temp = [];
                if (Object.keys(response).length !== 0) {
                    const periksa = JSON.parse(response.periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push((`${key}`).replace('rad_', ''));
                        }
                    });
                    console.log(temp);
                    console.log('-------------------');
                    $('#pesan_pemeriksaan_radiologi').val(temp).change();
                    $('#ruangan_rad').val(response.ruangan);
                }
                $('#id_rad').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#modal_pesanan_radiologi').modal('show');
            }
        })
    }

    function hapus_pesanan_rad(param){
        if (confirm('Yakin melanjutkan hapus pesanan radiologi ?')) {
            $.ajax({
                url : "{{ url('ajax_request/hapus_pesanan_rad') }}",
                data : {
                    id : param
                },
                success : function(response){
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#list_pesanan_radiologi').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_rad').val(0);
                    update_pesanan();
                }
            })
        }
    }

    function sortObject(obj) {
        if(typeof obj !== 'object')
            return obj
        var temp = {};
        var keys = [];
        for(var key in obj)
            keys.push(key.replace('rad_',''));
        keys.sort(function(a,b){return a - b});
        for(var index in keys)
            temp['rad_'+keys[index]] = sortObject(obj['rad_'+keys[index]]);       
        return temp;
    }

    function open_modal_hasil_radiologi(param) {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                console.log(response);
                if (response.hasil != '') {
                    var ins = '';
                    let temp = JSON.parse(response.hasil);
                    let temp2 = sortObject(JSON.parse(response.periksa));
                    let hasil = Object.entries(temp);
                    let key_hasil = Object.keys(temp);
                    let periksa = Object.entries(temp2);
                    let key_periksa = Object.keys(temp2);
                    let pemeriksaan = <?php echo $pemeriksaan_radiologi ?>;
                    let no = 1;
                    console.log(periksa);
                    // console.log(pemeriksaan);
                    for (let i = 0; i < hasil.length; i++) {
                        let temp_slug = key_hasil[i];
                        if (temp[key_hasil[i]] != '') {
                            for (let j = 0; j < periksa.length; j++) {
                                if (temp_slug == key_periksa[j] && periksa[j][1] == 1) {
                                    ins += '<tr>' +
                                        '<td style="vertical-align:top; line-height:2;">' + no + '. </td>' +
                                        '<td style="vertical-align:top; line-height:2;" class="pl-2">' +
                                        pemeriksaan[j].nama + '</td>' +
                                        '<td style="vertical-align:top; line-height:2;" class="pl-4 pr-4"> : </td>' +
                                        '<td style="vertical-align:top; line-height:2;">' + (hasil[i][1] ? hasil[i][1].includes('img') ?  hasil[i][1].replace('\n', '<br>').replace('smis-upload', '{{ request()->getScheme().'://' .request()->getHost() . env('SMIS_URL').'/smis-upload' }}') : hasil[i][1].replace('\n', '<br>') : '') + '</td>' +
                                        '</tr>';
                                    no++;
                                    break;
                                }
                            }
                        }
                    }
                    let file = response.file != '' ? JSON.parse(response.file) : [''];
                    if(file[0] != ''){
                        $('#link_lampiran_radiologi').html('<a style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL') }}/'+file[0]+'" target="_blank">Download lampiran klik disini</a>');
                    }
                    $('#list_hasil_radiologi').html(ins);
                    $('#modal_hasil_radiologi').modal('show');
                }
            }
        })
    }

    $('#form_radiologi').submit(function(e) {
        e.preventDefault();
        $('#loading_pesanan_rad').html(loading('Sedang menyimpan data harap tunggu...', 'info'));
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_store_by_id') }}",
            method: "post",
            data: $('#form_radiologi').serialize(),
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    $('#loading_pesanan_rad').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                    return;
                }
                $('#loading_pesanan_rad').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                $('#modal_pesanan_radiologi').modal('hide');
                let data = response.data;
                id_pesanan_rad = data.id;
                let pemeriksaan = <?php echo $pemeriksaan_radiologi; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                ins += data.no_lab + ' - ';
                var temp = JSON.parse(data.periksa);
                for (let j = 0; j < pemeriksaan.length; j++) {
                    var temp_slug = 'rad_' + pemeriksaan[j].id;
                    if (temp[temp_slug] == 1) {
                        if (iterasi_pesanan < 1) {
                            ins += pemeriksaan[j].nama;
                        } else {
                            ins += ', ' + pemeriksaan[j].nama;
                        }
                        iterasi_pesanan++;
                    }
                }
                $('#box_button_pesanan_radiologi').html('');
                $('#list_pesanan_radiologi').html(
                    '<button type="button" class="btn btn-warning" onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_radiologi(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' + 
                    '<button type="button" class="btn btn-danger ml-1 mr-2" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_rad(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' + 
                    ins);
                $('#id_rad').val(id_pesanan_rad);
                update_pesanan();
            }
        })
    })
</script>
{{-- END OF RADIOLOGI --}}

</html>
