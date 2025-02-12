<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Assesment Awal Pasien Rawat Inap (Dewasa)</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>

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

        .li_numbering li {
            list-style-type: decimal;
        }

        .list_alfabeth li {
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
            <form method="post" action="{{ url('e_rekam_medis/rekam_medis/verifikasi_dokumen_kunjungan') }}">
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
      action="{{ url('e_rekam_medis/rekam_medis/save_dokumen_asesment_awal_medis_gawat_darurat') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" id="hide_tgl_kedatangan" name="tgl_kedatangan">
    <input type="hidden" id="hide_jam_kedatangan" name="jam_kedatangan">
    <input type="hidden" id="hide_cara_masuk" name="cara_masuk">
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
<div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
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
        </table>
    </div>
</div>
<div style="margin-top: -17px;">
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
            <h6 style="color: white">ASSESMENT AWAL PASIEN RAWAT INAP (DEWASA)</h6>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%" class="table_isian_bordered">
            <tr>
                <td style="width: 15%;">
                    Tiba diruangan
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 35%">
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kedatangan"
                        value="@if(old('tgl_kedatangan')){{ old('tgl_kedatangan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_kedatangan : '' }}@endif">
                    , Jam :
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_kedatangan"
                        value="@if(old('jam_kedatangan')){{ old('jam_kedatangan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_kedatangan : '' }}@endif">
                </td>
                <td style="width: 15%;">
                    Pengkajian
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 35%">
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_pengkajian"
                        value="@if(old('tgl_pengkajian')){{ old('tgl_pengkajian') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_pengkajian : '' }}@endif">
                    , Jam :
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_pengkajian"
                        value="@if(old('jam_pengkajian')){{ old('jam_pengkajian') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_pengkajian : '' }}@endif">
                </td>
            </tr>
            <tr>
                <td style="width: 15%;">
                    Diperoleh Dari
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 35%">
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="diperoleh_dari"
                        value="@if(old('diperoleh_dari')){{ old('diperoleh_dari') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diperoleh_dari : '' }}@endif">
                </td>
                <td style="width: 15%;">
                    Hubungan Dengan Pasien
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 35%">
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="hubungan_dengan_pasien"
                        value="@if(old('hubungan_dengan_pasien')){{ old('hubungan_dengan_pasien') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->hubungan_dengan_pasien : '' }}@endif">
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td style="width: 15%;">
                    Cara Masuk
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input onclick="cek_radio_cara_masuk()"
                           @if(old('cara_masuk'))
                               {{ old('cara_masuk') ==  'jalan_tanpa_bantuan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'jalan_tanpa_bantuan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="jalan_tanpa_bantuan" name="radio_cara_masuk"> Jalan Tanpa Bantuan
                    <input onclick="cek_radio_cara_masuk()"
                           @if(old('cara_masuk'))
                               {{ old('cara_masuk') ==  'jalan_dengan_bantuan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'jalan_dengan_bantuan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="jalan_dengan_bantuan" name="radio_cara_masuk" class="ml-4"> Jalan Dengan Bantuan
                    <input onclick="cek_radio_cara_masuk()"
                           @if(old('cara_masuk'))
                               {{ old('cara_masuk') ==  'dengan_kursi_roda' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'dengan_kursi_roda' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="dengan_kursi_roda" name="radio_cara_masuk" class="ml-4"> Dengan Kursi Roda
                    <input onclick="cek_radio_cara_masuk()"
                           @if(old('cara_masuk'))
                               {{ old('cara_masuk') ==  'dengan_brankar' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->cara_masuk == 'dengan_brankar' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="dengan_brankar" name="radio_cara_masuk" class="ml-4"> Dengan Brankar
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td style="width: 15%;">
                    Asal Pasien
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input @if(old('asal_pasien'))
                               {{ old('asal_pasien') ==  'igd' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->asal_pasien == 'igd' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="igd" name="radio_asal_pasien"> IGD
                    <input @if(old('asal_pasien'))
                               {{ old('asal_pasien') ==  'poliklinik' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->asal_pasien == 'poliklinik' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="poliklinik" name="radio_asal_pasien" class="ml-4"> Poliklinik
                    <input @if(old('asal_pasien'))
                               {{ old('asal_pasien') ==  'kamar_operasi' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->asal_pasien == 'kamar_operasi' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="kamar_operasi" name="radio_asal_pasien" class="ml-4"> Kamar Operasi
                    <input @if(old('asal_pasien'))
                               {{ old('asal_pasien') ==  'rujukan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->asal_pasien == 'rujukan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="rujukan" name="radio_asal_pasien" class="ml-4"> Rujukan
                </td>
            </tr>
            <tr>
                <td style="width: 15%;">
                    Nama Primary Nurse
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 85%" colspan="3">
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="nama_primary_nurse"
                        value="@if(old('nama_primary_nurse')){{ old('nama_primary_nurse') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->nama_primary_nurse : '' }}@endif">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4" style="text-align: center; border: 1px solid">
                    <b>PENGKAJIAN MEDIS (diisi oleh dokter)</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    I. Anamnesis
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    1. Keluhan Utama
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
                    2. Riwayat Penyakit Sekarang
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
                    3. Riwayat Penyakit Dahulu
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
                    4. Riwayat Penyakit Keluarga
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_penyakit_keluarga()"
                    @if(old('riwayat_penyakit_keluarga'))
                        {{ old('riwayat_penyakit_keluarga') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_keluarga == 'tidak_ada' ? 'checked' : '') : '' }}
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
                    5. Riwayat Penggunaan Obat
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_penggunaan_obat()"
                    @if(old('riwayat_penggunaan_obat'))
                        {{ old('riwayat_penggunaan_obat') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penggunaan_obat == 'tidak_ada' ? 'checked' : '') : '' }}
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
                <td colspan="4">
                    <table style="width: 100%; " class="table_isian_bordered">
                        <tr style="text-align: center">
                            <td>Nama Obat</td>
                            <td>Dosis</td>
                            <td>Cara Pemberian</td>
                            <td>Frekuensi</td>
                            <td>Waktu & Tgl Terakhir Diberikan</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    6. Riwayat Alergi
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_alergi()"
                    @if(old('riwayat_alergi'))
                        {{ old('riwayat_alergi') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_alergi == 'tidak_ada' ? 'checked' : '') : '' }}
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
                <td style="width: 15%">1. Keadaan Umum</td>
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
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_sedang' ? 'checked' : '') : '' }}
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
                <td style="width: 15%">2. Kesadaran</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'compos_mentis' ? 'checked' : '') : '' }}
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
                <td style="width: 15%">3. GCS</td>
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
                <td style="width: 15%">4. Tanda - Tanda Vital</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                        </div>
                        <div class="col-md-2">
                            RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Suhu {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} ᵒC
                        </div>
                    </div>
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td style="width: 15%">5. Pemeriksaan</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border-top: hidden">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="6">
                    Status Generalis
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
                   Status Lokasi
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
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr>
                <td colspan="5">
                    III. Pemeriksaan Penunjang
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td colspan="5">
                    <div class="row">
                        <div class="col-md-12">
                            A. Laboratorium
                            <div id="box_button_pesanan_lab">
                                @if (sizeof($layanan->pesanan_lab) < 1)
                                    <button class="btn btn-dark" onclick="open_modal_lab()"><i
                                            class="fa fa-plus"></i></button>
                                @endif
                            </div>
                            <div id="list_pesanan">
                                @if ($layanan->pesanan_lab)
                                    @foreach ($layanan->pesanan_lab as $pl)
                                        <button class="btn btn-warning" onclick="open_modal_lab()"><i
                                                class="fa fa-pencil" style="color:#fff;"></i></button>
                                        <button class="btn btn-info" data-toggle="tooltip" title="Hasil"
                                                onclick="open_modal_hasil_lab('{{ $pl->id }}')"><i
                                                class="fa fa-book" style="color:#fff;"></i></button>
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
                            <div id="box_button_pesanan_radiologi">
                                @if (sizeof($layanan->pesanan_radiologi) < 1)
                                    <button onclick="open_modal_pesanan_radiologi()" class="btn btn-dark"><i
                                            class="fa fa-plus"></i></button>
                                @endif
                            </div>
                            <div id="list_pesanan_radiologi">
                                @if ($layanan->pesanan_radiologi)
                                    @foreach ($layanan->pesanan_radiologi as $pr)
                                        <button class="btn btn-warning"
                                                onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil"
                                                                                            style="color:#fff;"></i>
                                        </button>
                                        <button class="btn btn-info" data-toggle="tooltip" title="Hasil"
                                                onclick="open_modal_hasil_radiologi('{{ $pr->id }}')"><i
                                                class="fa fa-book" style="color:#fff;"></i></button>
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
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr>
                <td colspan="5">
                    IV. Diagnosa Kerja :
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td colspan="5">
                    <div style="display: flex; flex-direction: row" class="pt-3">
                        <div id="box_btn_asesmen">
                            @if ($layanan->diagnosa == null)
                                <button class="btn btn-success" onclick="open_form_tambah_diagnosa('diagnosa')"><i
                                        class="fa fa-plus"></i></button>
                            @else
                                <button class="btn btn-warning" onclick="open_form_tambah_diagnosa('diagnosa')"
                                        style="color:#fff; font-weight: bold;"><i
                                        class="fa fa-pencil"></i></button>
                            @endif
                        </div>
                        <div id="box_diagnosa" class="ml-2">
                            {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : '' }}
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
                    V. Diagnosa Banding : 
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td colspan="5">
                    <div style="display: flex; flex-direction: row" class="pt-3">
                        <div id="box_btn_asesmen">
                            @if ($layanan->diagnosa == null)
                                <button class="btn btn-success" onclick="open_form_tambah_diagnosa('diagnosa')"><i
                                        class="fa fa-plus"></i></button>
                            @else
                                <button class="btn btn-warning" onclick="open_form_tambah_diagnosa('diagnosa')"
                                        style="color:#fff; font-weight: bold;"><i
                                        class="fa fa-pencil"></i></button>
                            @endif
                        </div>
                        <div id="box_diagnosa" class="ml-2">
                            {{ $layanan->diagnosa ? !is_null($kode_sekunder1) ? $kode_sekunder1->icd . ' - ' . $layanan->diagnosa->diagnosa_sekunder1 : '' : '' }}
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
                    VI. Penatalaksanaan / Perencanaan Pelayanan : 
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    TINDAKAN
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
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
                    <select id="diberikan_oleh1" class="form-control" style="margin-top: 5px">
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
                    {{-- <input type="text" class="form-control"
                                   value="@if(old('diberikan_oleh1')){{ old('diberikan_oleh1') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh1 : '' }}@endif"
                                   id="diberikan_oleh1"> --}}
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
                    <select id="diberikan_oleh2" class="form-control" style="margin-top: 5px">
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
                    {{-- <input type="text" class="form-control"
                                   value="@if(old('diberikan_oleh2')){{ old('diberikan_oleh2') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh2 : '' }}@endif"
                                   id="diberikan_oleh2"> --}}
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
                    <select id="diberikan_oleh3" class="form-control" style="margin-top: 5px">
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
                    <select id="diberikan_oleh4" class="form-control" style="margin-top: 5px">
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
                    {{-- <input type="text" class="form-control"
                                   value="@if(old('diberikan_oleh4')){{ old('diberikan_oleh4') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh4 : '' }}@endif"
                                   id="diberikan_oleh4"> --}}
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
                    <select id="diberikan_oleh5" class="form-control" style="margin-top: 5px">
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
                    {{-- <input type="text" class="form-control"
                                   value="@if(old('diberikan_oleh5')){{ old('diberikan_oleh5') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh5 : '' }}@endif"
                                   id="diberikan_oleh5"> --}}
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
                    <select id="diberikan_oleh6" class="form-control" style="margin-top: 5px">
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
                    {{-- <input type="text" class="form-control"
                                   value="@if(old('diberikan_oleh6')){{ old('diberikan_oleh6') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diberikan_oleh6 : '' }}@endif"
                                   id="diberikan_oleh6"> --}}
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
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr style="border: 1px solid">
                <td style="width: 50%; text-align: center">
                    Diisi Oleh Dokter yang Melakukan Pengkajian Medis
                </td>
                <td style="width: 50%; text-align: center">
                    Tanda Tangan Dokter
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td style="width: 50%; text-align: center; vertical-align: middle">
                    Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}, Jam: {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
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
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4" style="text-align: center; border: 1px solid">
                    <b>PENGKAJIAN KEPERAWATAN (diisi oleh tenaga keperawatan)</b>
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td style="width: 15%;">
                    Tanggal
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 30%; border-right: 1px solid">
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_pengkajian_keperawatan"
                        value="@if(old('tgl_pengkajian_keperawatan')){{ old('tgl_pengkajian_keperawatan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_pengkajian_keperawatan : '' }}@endif">
                    , Jam :
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_pengkajian_keperawatan"
                        value="@if(old('jam_pengkajian_keperawatan')){{ old('jam_pengkajian_keperawatan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_pengkajian_keperawatan : '' }}@endif">
                </td>
                <td style="width: 15%;">
                    Diperoleh Dari
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 35%">
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="diperoleh_dari"
                        value="@if(old('diperoleh_dari')){{ old('diperoleh_dari') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diperoleh_dari : '' }}@endif">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    I. Anamnesis
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    1. Keluhan Utama
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
                    2. Riwayat Penyakit Sekarang
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
                    3. Riwayat Penyakit Dahulu
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
                    4. Riwayat Penyakit Keluarga
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_penyakit_keluarga()"
                    @if(old('riwayat_penyakit_keluarga'))
                        {{ old('riwayat_penyakit_keluarga') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penyakit_keluarga == 'tidak_ada' ? 'checked' : '') : '' }}
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
                    5. Riwayat Penggunaan Obat
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_penggunaan_obat()"
                    @if(old('riwayat_penggunaan_obat'))
                        {{ old('riwayat_penggunaan_obat') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_penggunaan_obat == 'tidak_ada' ? 'checked' : '') : '' }}
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
                    6. Riwayat Alergi
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_alergi()"
                    @if(old('riwayat_alergi'))
                        {{ old('riwayat_alergi') ==  'tidak_ada' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_alergi == 'tidak_ada' ? 'checked' : '') : '' }}
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
            <tr>
                <td style="width: 20%; vertical-align: text-top">
                    7. Riwayat Transfusi Darah
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_transfusi()"
                    @if(old('riwayat_transfusi'))
                        {{ old('riwayat_transfusi') ==  'tidak_pernah' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_transfusi == 'tidak_pernah' ? 'checked' : '') : '' }}
                    @endif
                    type="radio" value="tidak_pernah" name="radio_riwayat_transfusi"> Tidak Pernah
                    <br>
                    Timbul Reaksi 
                    <input onclick="cek_radio_riwayat_timbul_reaksi()"
                    @if(old('riwayat_timbul_reaksi'))
                        {{ old('riwayat_timbul_reaksi') ==  'tidak' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_timbul_reaksi == 'tidak' ? 'checked' : '') : '' }}
                    @endif
                    type="radio" value="tidak" name="radio_riwayat_timbul_reaksi" class="ml-2"> Tidak
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input onclick="cek_radio_riwayat_transfusi()"
                        @if(old('riwayat_transfusi'))
                            {{ old('riwayat_transfusi') ==  'pernah' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_transfusi == 'pernah' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="pernah" name="radio_riwayat_transfusi"> Pernah, Kapan :
                        <input type="datetime-local" readonly
                        value="@if(old('ket_riwayat_transfusi')){{ old('ket_riwayat_transfusi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_transfusi : '' }}@endif"
                        id="ket_riwayat_transfusi" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_transfusi'))
                            {{ old('riwayat_transfusi') ==  'pernah' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_transfusi == 'pernah' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                    <br>
                    <input onclick="cek_radio_riwayat_timbul_reaksi()"
                        @if(old('riwayat_timbul_reaksi'))
                            {{ old('riwayat_timbul_reaksi') ==  'ya' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_timbul_reaksi == 'ya' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="ya" name="radio_riwayat_timbul_reaksi"> Ya :
                        <input type="text" readonly
                        value="@if(old('ket_riwayat_timbul_reaksi')){{ old('ket_riwayat_timbul_reaksi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_timbul_reaksi : '' }}@endif"
                        id="ket_riwayat_timbul_reaksi" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_timbul_reaksi'))
                            {{ old('riwayat_timbul_reaksi') ==  'ya' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_timbul_reaksi == 'ya' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    8. Riwayat Kemoterapi
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_kemoterapi()"
                    @if(old('riwayat_kemoterapi'))
                        {{ old('riwayat_kemoterapi') ==  'tidak_pernah' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_kemoterapi == 'tidak_pernah' ? 'checked' : '') : '' }}
                    @endif
                    type="radio" value="tidak_pernah" name="radio_riwayat_kemoterapi"> Tidak Pernah
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input onclick="cek_radio_riwayat_kemoterapi()"
                        @if(old('riwayat_kemoterapi'))
                            {{ old('riwayat_kemoterapi') ==  'pernah' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_kemoterapi == 'pernah' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="pernah" name="radio_riwayat_kemoterapi"> Pernah, Kapan :
                        <input type="datetime-local" readonly
                        value="@if(old('ket_riwayat_kemoterapi')){{ old('ket_riwayat_kemoterapi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_kemoterapi : '' }}@endif"
                        id="ket_riwayat_kemoterapi" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_kemoterapi'))
                            {{ old('riwayat_kemoterapi') ==  'pernah' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_kemoterapi == 'pernah' ? '' : 'readonly') : 'readonly' }}
                        @endif> Berapa Kali : 
                        <input type="number" readonly
                        value="@if(old('berapa_kali_riwayat_kemoterapi')){{ old('berapa_kali_riwayat_kemoterapi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->berapa_kali_riwayat_kemoterapi : '' }}@endif"
                        id="berapa_kali_riwayat_kemoterapi" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_kemoterapi'))
                            {{ old('riwayat_kemoterapi') ==  'pernah' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_kemoterapi == 'pernah' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    9. Riwayat Radioterapi
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden">
                    <input onclick="cek_radio_riwayat_radioterapi()"
                    @if(old('riwayat_radioterapi'))
                        {{ old('riwayat_radioterapi') ==  'tidak_pernah' ? 'checked' : '' }}
                    @else
                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_radioterapi == 'tidak_pernah' ? 'checked' : '') : '' }}
                    @endif
                    type="radio" value="tidak_pernah" name="radio_riwayat_radioterapi"> Tidak Pernah
                </td>
                <td style="border-left: hidden" colspan="2">
                    <input onclick="cek_radio_riwayat_radioterapi()"
                        @if(old('riwayat_radioterapi'))
                            {{ old('riwayat_radioterapi') ==  'pernah' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_radioterapi == 'pernah' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="pernah" name="radio_riwayat_radioterapi"> Pernah, Kapan :
                        <input type="datetime-local" readonly
                        value="@if(old('ket_riwayat_radioterapi')){{ old('ket_riwayat_radioterapi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_riwayat_radioterapi : '' }}@endif"
                        id="ket_riwayat_radioterapi" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_radioterapi'))
                            {{ old('riwayat_radioterapi') ==  'pernah' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_radioterapi == 'pernah' ? '' : 'readonly') : 'readonly' }}
                        @endif> Berapa Kali : 
                        <input type="number" readonly
                        value="@if(old('berapa_kali_riwayat_radioterapi')){{ old('berapa_kali_riwayat_radioterapi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->berapa_kali_riwayat_radioterapi : '' }}@endif"
                        id="berapa_kali_riwayat_radioterapi" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('riwayat_radioterapi'))
                            {{ old('riwayat_radioterapi') ==  'pernah' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_radioterapi == 'pernah' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    10. Golongan Darah / Rh
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input @if(old('golongan_darah'))
                            {{ old('golongan_darah') ==  'A' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->golongan_darah == 'A' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="A" name="radio_golongan_darah"> A
                    <input @if(old('golongan_darah'))
                            {{ old('golongan_darah') ==  'B' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->golongan_darah == 'B' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="B" name="radio_golongan_darah" class="ml-4"> B
                    <input @if(old('golongan_darah'))
                            {{ old('golongan_darah') ==  'O' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->golongan_darah == 'O' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="O" name="radio_golongan_darah" class="ml-4"> O
                    <input @if(old('golongan_darah'))
                            {{ old('golongan_darah') ==  'AB' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->golongan_darah == 'AB' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="AB" name="radio_golongan_darah" class="ml-4"> AB 
                    <span style="margin-left: 50px">Rh :</span>
                    <input @if(old('rh'))
                            {{ old('rh') ==  'positif' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->rh == 'positif' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="positif" name="radio_rh"> Positif
                    <input @if(old('rh'))
                            {{ old('rh') ==  'negatif' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->rh == 'negatif' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="negatif" name="radio_rh" class="ml-4"> Negatif
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
                <td style="width: 15%">1. Keadaan Umum</td>
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
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keadaan_umum == 'sakit_sedang' ? 'checked' : '') : '' }}
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
                <td style="width: 15%">2. Kesadaran</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'compos_mentis' ? 'checked' : '') : '' }}
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
                <td style="width: 15%">3. GCS</td>
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
                <td style="width: 15%">4. Tanda - Tanda Vital</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                        </div>
                        <div class="col-md-2">
                            RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            Suhu {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} ᵒC
                        </div>
                    </div>
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td style="width: 15%; vertical-align: text-top">5. Antropometri</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden; vertical-align: text-top">:</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            BB : {{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '....' }} kg
                        </div>
                        <div class="col-md-3">
                            TB : {{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '....' }} cm
                        </div>
                        <div class="col-md-3">
                            Lingkar Kepala : {{ $layanan->tanda_vital ? $layanan->tanda_vital->lingkar_kepala : '....' }} cm
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Lingkar Dada : {{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '....' }} cm
                        </div>
                        <div class="col-md-3">
                            Lingkar Perut : {{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '....' }} cm
                        </div>
                    </div>
                </td>
            </tr>
            <tr style="border-bottom">
                <td style="width: 15%; vertical-align: text-top">6. Pengkajian Persistem</td>
                <td style="width: 2%; border-left: hidden; border-right: hidden; vertical-align: text-top">:</td>
                <td colspan="4">
                    
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td style="width: 15%; border: 1px solid">Pengkajian Persistem</td>
                <td style="border: 1px solid" colspan="5">
                    Hasil Pemeriksaan
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td style="width: 15%; border: 1px solid; vertical-align: text-top">Sistem Susunan Saraf Pusat</td>
                <td style="border: 1px solid" colspan="5">
                    <div class="row">
                        <div class="col-md-2">Kesadaran <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('kesadaran'))
                                        {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'compos_mentis' ? 'checked' : '') : '' }}
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
                            <input @if(old('kesadaran'))
                                        {{ old('kesadaran') ==  'koma' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesadaran == 'koma' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="koma" name="radio_kesadaran" class="ml-4"> koma
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Kepala <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('kepala'))
                                        {{ old('kepala') ==  'TAK' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kepala == 'TAK' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="TAK" name="radio_kepala"> TAK
                            <input @if(old('kepala'))
                                        {{ old('kepala') ==  'hydrocephalus' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kepala == 'hydrocephalus' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="hydrocephalus" name="radio_kepala" class="ml-4"> Hydrocephalus
                            <input @if(old('kepala'))
                                        {{ old('kepala') ==  'Hematoma' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kepala == 'Hematoma' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Hematoma" name="radio_kepala" class="ml-4"> Hematoma
                            <input @if(old('kepala'))
                                        {{ old('kepala') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kepala == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="lain_lain" name="radio_kepala" class="ml-4"> Lain-lain
                            <input type="text"
                                   value="@if(old('ket_kepala')){{ old('ket_kepala') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kepala : '' }}@endif"
                                   id="ket_kepala" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('kepala'))
                                    {{ old('kepala') == 'lain_lain' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kepala == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Ubun - ubun <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('ubun_ubun'))
                                        {{ old('ubun_ubun') ==  'datar' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->ubun_ubun == 'datar' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="datar" name="radio_ubun_ubun"> datar
                            <input @if(old('ubun_ubun'))
                                        {{ old('ubun_ubun') ==  'cekung' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->ubun_ubun == 'cekung' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="cekung" name="radio_ubun_ubun" class="ml-4"> Cekung
                            <input @if(old('ubun_ubun'))
                                        {{ old('ubun_ubun') ==  'Menonjol' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->ubun_ubun == 'Menonjol' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Menonjol" name="radio_ubun_ubun" class="ml-4"> Menonjol
                            <input @if(old('ubun_ubun'))
                                        {{ old('ubun_ubun') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->ubun_ubun == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="lain_lain" name="radio_ubun_ubun" class="ml-4"> Lain-lain
                            <input type="text"
                                   value="@if(old('ket_ubun_ubun')){{ old('ket_ubun_ubun') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_ubun_ubun : '' }}@endif"
                                   id="ket_ubun_ubun" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('ubun_ubun'))
                                    {{ old('ubun_ubun') == 'lain_lain' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ubun_ubun == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Wajah <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('wajah'))
                                        {{ old('wajah') ==  'TAK' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->wajah == 'TAK' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="TAK" name="radio_wajah"> TAK
                            <input @if(old('wajah'))
                                        {{ old('wajah') ==  'Asimetris' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->wajah == 'Asimetris' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Asimetris" name="radio_wajah" class="ml-4"> Asimetris
                            <input @if(old('wajah'))
                                        {{ old('wajah') ==  'kelainan_konginetal' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->wajah == 'kelainan_konginetal' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="kelainan_konginetal" name="radio_wajah" class="ml-4"> Kelainan Konginetal
                            <input type="text"
                                   value="@if(old('ket_wajah')){{ old('ket_wajah') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_wajah : '' }}@endif"
                                   id="ket_wajah" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('wajah'))
                                    {{ old('wajah') == 'kelainan_konginetal' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wajah == 'kelainan_konginetal' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Leher <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('leher'))
                                        {{ old('leher') ==  'TAK' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'TAK' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="TAK" name="radio_leher"> TAK
                            <input @if(old('leher'))
                                        {{ old('leher') ==  'Kaku Kuduk' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'Kaku Kuduk' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Kaku Kuduk" name="radio_leher" class="ml-4"> Kaku Kuduk
                            <input @if(old('leher'))
                                        {{ old('leher') ==  'Pembesaran Tiroid' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'Pembesaran Tiroid' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Pembesaran Tiroid" name="radio_leher" class="ml-4"> Pembesaran Tiroid
                            <br>
                            <input @if(old('leher'))
                                        {{ old('leher') ==  'Pembesaran KGB' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'Pembesaran KGB' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Pembesaran KGB" name="radio_leher"> Pembesaran KGB
                            <input @if(old('leher'))
                                        {{ old('leher') ==  'Keterbatasan Gerak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'Keterbatasan Gerak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Keterbatasan Gerak" name="radio_leher" class="ml-4"> Keterbatasan Gerak
                            <input @if(old('leher'))
                                        {{ old('leher') ==  'lain_lain' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'lain_lain' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="lain_lain" name="radio_leher" class="ml-4"> Lain-lain
                            <input type="text"
                                   value="@if(old('ket_leher')){{ old('ket_leher') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_leher : '' }}@endif"
                                   id="ket_leher" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('leher'))
                                    {{ old('leher') == 'lain_lain' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->leher == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Kejang <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('kejang'))
                                        {{ old('kejang') ==  'Tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kejang == 'Tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Tidak" name="radio_kejang"> Tidak
                            <input @if(old('kejang'))
                                        {{ old('kejang') ==  'ada' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kejang == 'ada' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="ada" name="radio_kejang" class="ml-4"> Ada, Type :
                            <input type="text"
                                   value="@if(old('ket_kejang')){{ old('ket_kejang') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kejang : '' }}@endif"
                                   id="ket_kejang" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('kejang'))
                                    {{ old('kejang') == 'ada' ? '' : 'readonly' }}
                                    @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kejang == 'ada' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Sensorik <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('sensorik'))
                                        {{ old('sensorik') ==  'Tidak Ada Kelainan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sensorik == 'Tidak Ada Kelainan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Tidak Ada Kelainan" name="radio_sensorik"> Tidak Ada Kelainan
                            <input @if(old('sensorik'))
                                        {{ old('sensorik') ==  'Sakit Nyeri' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sensorik == 'Sakit Nyeri' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Sakit Nyeri" name="radio_sensorik" class="ml-4"> Sakit Nyeri
                            <input @if(old('sensorik'))
                                        {{ old('sensorik') ==  'Rasa Kebas' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sensorik == 'Rasa Kebas' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Rasa Kebas" name="radio_sensorik" class="ml-4"> Rasa Kebas
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Motorik <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('motorik'))
                                        {{ old('motorik') ==  'Hemiparese' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->motorik == 'Hemiparese' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Hemiparese" name="radio_motorik"> Hemiparese
                            <input @if(old('motorik'))
                                        {{ old('motorik') ==  'Tetraparese' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->motorik == 'Tetraparese' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Tetraparese" name="radio_motorik" class="ml-4"> Tetraparese
                            <input @if(old('motorik'))
                                        {{ old('motorik') ==  'Tidak Ada Kelainan' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->motorik == 'Tidak Ada Kelainan' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Tidak Ada Kelainan" name="radio_motorik" class="ml-4"> Tidak Ada Kelainan
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Kekuatan Otot <span style="float: right">:</span></div>
                        <div class="col-md-10">
                            <input @if(old('kekuatan_otot'))
                                        {{ old('kekuatan_otot') ==  'Kuat' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Kuat' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Kuat" name="radio_kekuatan_otot"> Kuat
                            <input @if(old('kekuatan_otot'))
                                        {{ old('kekuatan_otot') ==  'Lemah' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Lemah' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="Lemah" name="radio_kekuatan_otot" class="ml-4"> Lemah
                        </div>
                    </div>
                </td>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Penglihatan</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-2">Posisi Mata <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('kekuatan_otot'))
                                            {{ old('kekuatan_otot') ==  'Simetris' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Simetris' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Simetris" name="radio_kekuatan_otot"> Simetris
                                <input @if(old('kekuatan_otot'))
                                            {{ old('kekuatan_otot') ==  'Asimetris' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Asimetris' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Asimetris" name="radio_kekuatan_otot" class="ml-4"> Asimetris
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Pupil <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('kekuatan_otot'))
                                            {{ old('kekuatan_otot') ==  'Isokor' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Isokor' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Isokor" name="radio_kekuatan_otot"> Isokor
                                <input @if(old('kekuatan_otot'))
                                            {{ old('kekuatan_otot') ==  'Anisokor' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Anisokor' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Anisokor" name="radio_kekuatan_otot" class="ml-4"> Anisokor
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Kelopak Mata <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('kelopak_mata'))
                                            {{ old('kelopak_mata') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelopak_mata == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_kelopak_mata"> TAK
                                <input @if(old('kelopak_mata'))
                                            {{ old('kelopak_mata') ==  'Edema' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelopak_mata == 'Edema' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Edema" name="radio_kelopak_mata" class="ml-4"> Edema
                                <input @if(old('kelopak_mata'))
                                            {{ old('kelopak_mata') ==  'Cekung' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelopak_mata == 'Cekung' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Cekung" name="radio_kelopak_mata" class="ml-4"> Cekung
                                <input @if(old('kelopak_mata'))
                                            {{ old('kelopak_mata') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelopak_mata == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_kelopak_mata" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_kelopak_mata')){{ old('ket_kelopak_mata') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kelopak_mata : '' }}@endif"
                                       id="ket_kelopak_mata" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('kelopak_mata'))
                                        {{ old('kelopak_mata') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kelopak_mata == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Konjungtiva <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('konjungtiva'))
                                            {{ old('konjungtiva') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->konjungtiva == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_konjungtiva"> TAK
                                <input @if(old('konjungtiva'))
                                            {{ old('konjungtiva') ==  'Anemis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->konjungtiva == 'Anemis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Anemis" name="radio_konjungtiva" class="ml-4"> Anemis
                                <input @if(old('konjungtiva'))
                                            {{ old('konjungtiva') ==  'Konjungtivitis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->konjungtiva == 'Konjungtivitis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Konjungtivitis" name="radio_konjungtiva" class="ml-4"> Konjungtivitis
                                <input @if(old('konjungtiva'))
                                            {{ old('konjungtiva') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->konjungtiva == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_konjungtiva" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_konjungtiva')){{ old('ket_konjungtiva') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_konjungtiva : '' }}@endif"
                                       id="ket_konjungtiva" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('konjungtiva'))
                                        {{ old('konjungtiva') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->konjungtiva == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Seklera <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('seklera'))
                                            {{ old('seklera') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->seklera == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_seklera"> TAK
                                <input @if(old('seklera'))
                                            {{ old('seklera') ==  'Ikterik' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->seklera == 'Ikterik' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ikterik" name="radio_seklera" class="ml-4"> Ikterik
                                <input @if(old('seklera'))
                                            {{ old('seklera') ==  'Pendarahan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->seklera == 'Pendarahan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pendarahan" name="radio_seklera" class="ml-4"> Pendarahan
                                <input @if(old('seklera'))
                                            {{ old('seklera') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->seklera == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_seklera" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_seklera')){{ old('ket_seklera') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_seklera : '' }}@endif"
                                       id="ket_seklera" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('seklera'))
                                        {{ old('seklera') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->seklera == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Alat Bantu Penglihatan <span style="float: right">:</span></div>
                            <div class="col-md-9">
                                <input @if(old('alat_bantu_penglihatan'))
                                            {{ old('alat_bantu_penglihatan') ==  'Tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_bantu_penglihatan == 'Tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak" name="radio_alat_bantu_penglihatan"> Tidak
                                <input @if(old('alat_bantu_penglihatan'))
                                            {{ old('alat_bantu_penglihatan') ==  'Ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_bantu_penglihatan == 'Ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ya" name="radio_alat_bantu_penglihatan" class="ml-4"> Ya :
                                <input @if(old('alat_bantu_penglihatan'))
                                            {{ old('alat_bantu_penglihatan') ==  'Mata Palsu' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_bantu_penglihatan == 'Mata Palsu' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mata Palsu" name="radio_alat_bantu_penglihatan" class="ml-4"> Mata Palsu
                                <input @if(old('alat_bantu_penglihatan'))
                                            {{ old('alat_bantu_penglihatan') ==  'Kaca Mata' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_bantu_penglihatan == 'Kaca Mata' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kaca Mata" name="radio_alat_bantu_penglihatan" class="ml-4"> Kaca Mata
                                <input @if(old('alat_bantu_penglihatan'))
                                            {{ old('alat_bantu_penglihatan') ==  'Lensa Kontak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_bantu_penglihatan == 'Lensa Kontak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lensa Kontak" name="radio_alat_bantu_penglihatan" class="ml-4"> Lensa Kontak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Pendengaran</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-12">
                                <input @if(old('sistem_pendengaran'))
                                            {{ old('sistem_pendengaran') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_pendengaran == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_sistem_pendengaran"> TAK
                                <input @if(old('sistem_pendengaran'))
                                            {{ old('sistem_pendengaran') ==  'Nyeri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_pendengaran == 'Nyeri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Nyeri" name="radio_sistem_pendengaran" class="ml-4"> Nyeri
                                <input @if(old('sistem_pendengaran'))
                                            {{ old('sistem_pendengaran') ==  'Tuli' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_pendengaran == 'Tuli' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tuli" name="radio_sistem_pendengaran" class="ml-4"> Tuli
                                <input @if(old('sistem_pendengaran'))
                                            {{ old('sistem_pendengaran') ==  'Keluar Cairan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_pendengaran == 'Keluar Cairan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Keluar Cairan" name="radio_sistem_pendengaran" class="ml-4"> Keluar Cairan
                                <input @if(old('sistem_pendengaran'))
                                            {{ old('sistem_pendengaran') ==  'Berdengung' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_pendengaran == 'Berdengung' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Berdengung" name="radio_sistem_pendengaran" class="ml-4"> Berdengung
                                <input @if(old('sistem_pendengaran'))
                                            {{ old('sistem_pendengaran') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_pendengaran == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_sistem_pendengaran" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_sistem_pendengaran')){{ old('ket_sistem_pendengaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_sistem_pendengaran : '' }}@endif"
                                       id="ket_sistem_pendengaran" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('sistem_pendengaran'))
                                        {{ old('sistem_pendengaran') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sistem_pendengaran == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                                <br>
                                Menggunakan alat bantu pendengaran : 
                                <input @if(old('alat_bantu_pendengaran'))
                                            {{ old('alat_bantu_pendengaran') ==  'ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_bantu_pendengaran == 'ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="ya" name="radio_alat_bantu_pendengaran" class="ml-4"> Ya
                                <input @if(old('alat_bantu_pendengaran'))
                                            {{ old('alat_bantu_pendengaran') ==  'tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_bantu_pendengaran == 'tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="tidak" name="radio_alat_bantu_pendengaran" class="ml-4"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Penciuman</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-12">
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_sistem_penciuman"> TAK
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'Asimetris' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'Asimetris' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Asimetris" name="radio_sistem_penciuman" class="ml-4"> Asimetris
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'Septum Deviasi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'Septum Deviasi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Septum Deviasi" name="radio_sistem_penciuman" class="ml-4"> Septum Deviasi
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'Pengeluaran Cairan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'Pengeluaran Cairan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pengeluaran Cairan" name="radio_sistem_penciuman" class="ml-4"> Pengeluaran Cairan
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'Polip' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'Polip' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Polip" name="radio_sistem_penciuman" class="ml-4"> Polip
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'Sinusitis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'Sinusitis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Sinusitis" name="radio_sistem_penciuman" class="ml-4"> Sinusitis
                                <br>
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'Epistaksis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'Epistaksis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Epistaksis" name="radio_sistem_penciuman"> Epistaksis
                                <input @if(old('sistem_penciuman'))
                                            {{ old('sistem_penciuman') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sistem_penciuman == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_sistem_penciuman" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_sistem_penciuman')){{ old('ket_sistem_penciuman') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_sistem_penciuman : '' }}@endif"
                                       id="ket_sistem_penciuman" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('sistem_penciuman'))
                                        {{ old('sistem_penciuman') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sistem_penciuman == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Pernafasan</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-2">Pola Napas <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('pola_napas'))
                                            {{ old('pola_napas') ==  'Normal' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_napas == 'Normal' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Normal" name="radio_pola_napas"> Normal
                                <input @if(old('pola_napas'))
                                            {{ old('pola_napas') ==  'Bradipnea' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_napas == 'Bradipnea' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bradipnea" name="radio_pola_napas" class="ml-4"> Bradipnea
                                <input @if(old('pola_napas'))
                                            {{ old('pola_napas') ==  'Tachipnea' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_napas == 'Tachipnea' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tachipnea" name="radio_pola_napas" class="ml-4"> Tachipnea
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Volume Pernapasan <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('volume_pernapasan'))
                                            {{ old('volume_pernapasan') ==  'Normal' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->volume_pernapasan == 'Normal' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Normal" name="radio_volume_pernapasan"> Normal
                                <input @if(old('volume_pernapasan'))
                                            {{ old('volume_pernapasan') ==  'Hiperventilasi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->volume_pernapasan == 'Hiperventilasi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Hiperventilasi" name="radio_volume_pernapasan" class="ml-4"> Hiperventilasi
                                <input @if(old('volume_pernapasan'))
                                            {{ old('volume_pernapasan') ==  'Hipoventilasi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->volume_pernapasan == 'Hipoventilasi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Hipoventilasi" name="radio_volume_pernapasan" class="ml-4"> Hipoventilasi
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Jenis Pernapasan <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('jenis_pernapasan'))
                                            {{ old('jenis_pernapasan') ==  'Pernapasan Dada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pernapasan == 'Pernapasan Dada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pernapasan Dada" name="radio_jenis_pernapasan"> Pernapasan Dada
                                <input @if(old('jenis_pernapasan'))
                                            {{ old('jenis_pernapasan') ==  'Pernapasan Perut' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pernapasan == 'Pernapasan Perut' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pernapasan Perut" name="radio_jenis_pernapasan" class="ml-4"> Pernapasan Perut
                                <br>
                                <input @if(old('jenis_pernapasan'))
                                            {{ old('jenis_pernapasan') ==  'alat_bantu_napas' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_pernapasan == 'alat_bantu_napas' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="alat_bantu_napas" name="radio_jenis_pernapasan"> Alat Bantu Napas, Sebutkan 
                                <input type="text"
                                       value="@if(old('ket_jenis_pernapasan')){{ old('ket_jenis_pernapasan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_jenis_pernapasan : '' }}@endif"
                                       id="ket_jenis_pernapasan" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('jenis_pernapasan'))
                                        {{ old('jenis_pernapasan') == 'alat_bantu_napas' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_pernapasan == 'alat_bantu_napas' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Irama Napas <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('irama_napas'))
                                            {{ old('irama_napas') ==  'Teratur' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->irama_napas == 'Teratur' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Teratur" name="radio_irama_napas"> Teratur
                                <input @if(old('irama_napas'))
                                            {{ old('irama_napas') ==  'Tidak Teratur' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->irama_napas == 'Tidak Teratur' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak Teratur" name="radio_irama_napas" class="ml-4"> Tidak Teratur
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Kesulitan Bernapas <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('kesulitan_bernapas'))
                                            {{ old('kesulitan_bernapas') ==  'Tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesulitan_bernapas == 'Tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak" name="radio_kesulitan_bernapas"> Tidak
                                <input @if(old('kesulitan_bernapas'))
                                            {{ old('kesulitan_bernapas') ==  'Ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kesulitan_bernapas == 'Ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ya" name="radio_kesulitan_bernapas" class="ml-4"> Ya ;
                                <input @if(old('detail_kesulitan_bernapas'))
                                            {{ old('detail_kesulitan_bernapas') ==  'Dyspnea' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->detail_kesulitan_bernapas == 'Dyspnea' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Dyspnea" name="radio_detail_kesulitan_bernapas" class="ml-4"> Dyspnea
                                <input @if(old('detail_kesulitan_bernapas'))
                                            {{ old('detail_kesulitan_bernapas') ==  'Orthopnea' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->detail_kesulitan_bernapas == 'Orthopnea' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Orthopnea" name="radio_detail_kesulitan_bernapas" class="ml-4"> Orthopnea
                                <input @if(old('detail_kesulitan_bernapas'))
                                            {{ old('detail_kesulitan_bernapas') ==  'Lain-lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->detail_kesulitan_bernapas == 'Lain-lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lain-lain" name="radio_detail_kesulitan_bernapas" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_detail_kesulitan_bernapas')){{ old('ket_detail_kesulitan_bernapas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_detail_kesulitan_bernapas : '' }}@endif"
                                       id="ket_detail_kesulitan_bernapas" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('detail_kesulitan_bernapas'))
                                        {{ old('detail_kesulitan_bernapas') == 'alat_bantu_napas' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_kesulitan_bernapas == 'alat_bantu_napas' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Batuk dan Sekresi <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('batuk'))
                                            {{ old('batuk') ==  'Tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->batuk == 'Tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak" name="radio_batuk"> Tidak
                                <input @if(old('batuk'))
                                            {{ old('batuk') ==  'Ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->batuk == 'Ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ya" name="radio_batuk" class="ml-4"> Ya ;
                                <input @if(old('detail_batuk'))
                                            {{ old('detail_batuk') ==  'Produktif' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->detail_batuk == 'Produktif' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Produktif" name="radio_detail_batuk" class="ml-4"> Produktif
                                <input @if(old('detail_batuk'))
                                            {{ old('detail_batuk') ==  'Non Produktif' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->detail_batuk == 'Non Produktif' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Non Produktif" name="radio_detail_batuk" class="ml-4"> Non Produktif
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Kardiovaskler</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-2">Warna Kulit <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('warna_kulit'))
                                            {{ old('warna_kulit') ==  'Normal' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_kulit == 'Normal' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Normal" name="radio_warna_kulit"> Normal
                                <input @if(old('warna_kulit'))
                                            {{ old('warna_kulit') ==  'Kemerahan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_kulit == 'Kemerahan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kemerahan" name="radio_warna_kulit" class="ml-4"> Kemerahan
                                <input @if(old('warna_kulit'))
                                            {{ old('warna_kulit') ==  'Sianosis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_kulit == 'Sianosis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Sianosis" name="radio_warna_kulit" class="ml-4"> Sianosis
                                <input @if(old('warna_kulit'))
                                            {{ old('warna_kulit') ==  'Pucat' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_kulit == 'Pucat' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pucat" name="radio_warna_kulit" class="ml-4"> Pucat
                                <input @if(old('warna_kulit'))
                                            {{ old('warna_kulit') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_kulit == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_warna_kulit" class="ml-4"> Lain-lain 
                                <input type="text"
                                       value="@if(old('ket_warna_kulit')){{ old('ket_warna_kulit') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_warna_kulit : '' }}@endif"
                                       id="ket_warna_kulit" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('warna_kulit'))
                                        {{ old('warna_kulit') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->warna_kulit == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Nyeri Dada <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('nyeri_dada'))
                                            {{ old('nyeri_dada') ==  'Tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_dada == 'Tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak" name="radio_nyeri_dada"> Tidak
                                <input @if(old('nyeri_dada'))
                                            {{ old('nyeri_dada') ==  'Ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_dada == 'Ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ya" name="radio_nyeri_dada" class="ml-4"> Ya, Sebutkan 
                                <input type="text"
                                       value="@if(old('ket_nyeri_dada')){{ old('ket_nyeri_dada') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_nyeri_dada : '' }}@endif"
                                       id="ket_nyeri_dada" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('nyeri_dada'))
                                        {{ old('nyeri_dada') == 'Ya' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri_dada == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Denyut Nadi <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('denyut_nadi'))
                                            {{ old('denyut_nadi') ==  'Teratur' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->denyut_nadi == 'Teratur' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Teratur" name="radio_denyut_nadi"> Teratur
                                <input @if(old('denyut_nadi'))
                                            {{ old('denyut_nadi') ==  'Tidak Teratur' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->denyut_nadi == 'Tidak Teratur' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak Teratur" name="radio_denyut_nadi" class="ml-4"> Tidak Teratur
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Sirkulasi <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('sirkulasi'))
                                            {{ old('sirkulasi') ==  'Akral Hangat' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sirkulasi == 'Akral Hangat' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Akral Hangat" name="radio_sirkulasi"> Akral Hangat
                                <input @if(old('sirkulasi'))
                                            {{ old('sirkulasi') ==  'Akral Dingin' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sirkulasi == 'Akral Dingin' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Akral Dingin" name="radio_sirkulasi" class="ml-4"> Akral Dingin
                                <input @if(old('sirkulasi'))
                                            {{ old('sirkulasi') ==  'Rasa Kebas' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sirkulasi == 'Rasa Kebas' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Rasa Kebas" name="radio_sirkulasi" class="ml-4"> Rasa Kebas
                                <input @if(old('sirkulasi'))
                                            {{ old('sirkulasi') ==  'Palpitasi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sirkulasi == 'Palpitasi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Palpitasi" name="radio_sirkulasi" class="ml-4"> Palpitasi
                                <br>
                                <input @if(old('sirkulasi'))
                                            {{ old('sirkulasi') ==  'Edema' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sirkulasi == 'Edema' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Edema" name="radio_sirkulasi"> Edema, lokasi
                                <input type="text"
                                       value="@if(old('ket_sirkulasi')){{ old('ket_sirkulasi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_sirkulasi : '' }}@endif"
                                       id="ket_sirkulasi" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('sirkulasi'))
                                        {{ old('sirkulasi') == 'Edema' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sirkulasi == 'Edema' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Pulsasi <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('pulsasi'))
                                            {{ old('pulsasi') ==  'Kuat' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pulsasi == 'Kuat' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kuat" name="radio_pulsasi"> Kuat
                                <input @if(old('pulsasi'))
                                            {{ old('pulsasi') ==  'Lemah' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pulsasi == 'Lemah' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lemah" name="radio_pulsasi" class="ml-4"> Lemah
                                <input @if(old('pulsasi'))
                                            {{ old('pulsasi') ==  'Lain-lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pulsasi == 'Lain-lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lain-lain" name="radio_pulsasi" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_pulsasi')){{ old('ket_pulsasi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_pulsasi : '' }}@endif"
                                       id="ket_pulsasi" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('pulsasi'))
                                        {{ old('pulsasi') == 'Lain-lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pulsasi == 'Lain-lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Pencernaan</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-2">Mulut <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('mulut'))
                                            {{ old('mulut') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mulut == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_mulut"> TAK
                                <input @if(old('mulut'))
                                            {{ old('mulut') ==  'Stomatitis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mulut == 'Stomatitis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Stomatitis" name="radio_mulut" class="ml-4"> Stomatitis
                                <input @if(old('mulut'))
                                            {{ old('mulut') ==  'Mukosa Kering' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mulut == 'Mukosa Kering' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mukosa Kering" name="radio_mulut" class="ml-4"> Mukosa Kering
                                <input @if(old('mulut'))
                                            {{ old('mulut') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mulut == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_mulut" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_mulut')){{ old('ket_mulut') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_mulut : '' }}@endif"
                                       id="ket_mulut" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('mulut'))
                                        {{ old('mulut') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mulut == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Gigi <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('gigi'))
                                            {{ old('gigi') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gigi == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_gigi"> TAK
                                <input @if(old('gigi'))
                                            {{ old('gigi') ==  'Karies' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gigi == 'Karies' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Karies" name="radio_gigi" class="ml-4"> Karies
                                <input @if(old('gigi'))
                                            {{ old('gigi') ==  'Tambal' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gigi == 'Tambal' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tambal" name="radio_gigi" class="ml-4"> Tambal
                                <input @if(old('gigi'))
                                            {{ old('gigi') ==  'Goyang' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gigi == 'Goyang' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Goyang" name="radio_gigi" class="ml-4"> Goyang
                                <input @if(old('gigi'))
                                            {{ old('gigi') ==  'Gigi Palsu' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gigi == 'Gigi Palsu' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Gigi Palsu" name="radio_gigi" class="ml-4"> Gigi Palsu
                                <input @if(old('gigi'))
                                            {{ old('gigi') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gigi == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_gigi" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_gigi')){{ old('ket_gigi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_gigi : '' }}@endif"
                                       id="ket_gigi" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('gigi'))
                                        {{ old('gigi') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->gigi == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Lidah <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('lidah'))
                                            {{ old('lidah') ==  'Bersih' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->lidah == 'Bersih' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bersih" name="radio_lidah"> Bersih
                                <input @if(old('lidah'))
                                            {{ old('lidah') ==  'Kotor' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->lidah == 'Kotor' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kotor" name="radio_lidah" class="ml-4"> Kotor
                                <input @if(old('lidah'))
                                            {{ old('lidah') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->lidah == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_lidah" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_lidah')){{ old('ket_lidah') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_lidah : '' }}@endif"
                                       id="ket_lidah" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('lidah'))
                                        {{ old('lidah') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->lidah == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Tenggorokan <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('tenggorokan'))
                                            {{ old('tenggorokan') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->tenggorokan == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_tenggorokan"> TAK
                                <input @if(old('tenggorokan'))
                                            {{ old('tenggorokan') ==  'Hiperemis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->tenggorokan == 'Hiperemis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Hiperemis" name="radio_tenggorokan" class="ml-4"> Hiperemis
                                <input @if(old('tenggorokan'))
                                            {{ old('tenggorokan') ==  'Pembesaran Tonsil' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->tenggorokan == 'Pembesaran Tonsil' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pembesaran Tonsil" name="radio_tenggorokan" class="ml-4"> Pembesaran Tonsil
                                <input @if(old('tenggorokan'))
                                            {{ old('tenggorokan') ==  'Sakit Menelan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->tenggorokan == 'Sakit Menelan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Sakit Menelan" name="radio_tenggorokan" class="ml-4"> Sakit Menelan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Leher <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('leher'))
                                            {{ old('leher') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_leher"> TAK
                                <input @if(old('leher'))
                                            {{ old('leher') ==  'Pembesaran KGB' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'Pembesaran KGB' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pembesaran KGB" name="radio_leher" class="ml-4"> Pembesaran KGB
                                <input @if(old('leher'))
                                            {{ old('leher') ==  'Kelenjar Tiroid' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->leher == 'Kelenjar Tiroid' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kelenjar Tiroid" name="radio_leher" class="ml-4"> Kelenjar Tiroid
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Abdomen <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_abdomen"> TAK
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'Lembek' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'Lembek' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lembek" name="radio_abdomen" class="ml-4"> Lembek
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'Distensi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'Distensi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Distensi" name="radio_abdomen" class="ml-4"> Distensi
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'Kembung' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'Kembung' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kembung" name="radio_abdomen" class="ml-4"> Kembung
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'Asites' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'Asites' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Asites" name="radio_abdomen" class="ml-4"> Asites
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'Ada Benjolan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'Ada Benjolan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ada Benjolan" name="radio_abdomen" class="ml-4"> Ada Benjolan
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'Nyeri Tekan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'Nyeri Tekan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Nyeri Tekan" name="radio_abdomen" class="ml-4"> Nyeri Tekan / Lemas
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Peristaltik Usus <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_abdomen"> TAK
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'bising_usus' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'bising_usus' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="bising_usus" name="radio_abdomen" class="ml-4"> Tidak Ada Bising Usus
                                <input @if(old('abdomen'))
                                            {{ old('abdomen') ==  'Hiperperistaltik' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->abdomen == 'Hiperperistaltik' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Hiperperistaltik" name="radio_abdomen" class="ml-4"> Hiperperistaltik
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Apus <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_apus"> TAK
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'Atresia Ani' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'Atresia Ani' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Atresia Ani" name="radio_apus" class="ml-4"> Atresia Ani
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">BAB <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_apus"> TAK
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'Konstipasi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'Konstipasi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Konstipasi" name="radio_apus" class="ml-4"> Konstipasi
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'Melena' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'Melena' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Melena" name="radio_apus" class="ml-4"> Melena
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'Inkontinensia Alvi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'Inkontinensia Alvi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Inkontinensia Alvi" name="radio_apus" class="ml-4"> Inkontinensia Alvi
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'Colostomy' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'Colostomy' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Colostomy" name="radio_apus" class="ml-4"> Colostomy
                                <input @if(old('apus'))
                                            {{ old('apus') ==  'Diare Frekuensi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->apus == 'Diare Frekuensi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Diare Frekuensi" name="radio_apus" class="ml-4"> Diare Frekuensi
                                <input type="text"
                                       value="@if(old('ket_apus')){{ old('ket_apus') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_apus : '' }}@endif"
                                       id="ket_apus" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('apus'))
                                        {{ old('apus') == 'Diare Frekuensi' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->apus == 'Diare Frekuensi' ? '' : 'readonly') : 'readonly' }}
                                        @endif> / Hari
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Genitourinaria</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-2">Kebersihan <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('kebersihan'))
                                            {{ old('kebersihan') ==  'Bersih' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebersihan == 'Bersih' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bersih" name="radio_kebersihan"> Bersih
                                <input @if(old('kebersihan'))
                                            {{ old('kebersihan') ==  'Kotor' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebersihan == 'Kotor' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kotor" name="radio_kebersihan" class="ml-4"> Kotor
                                <input @if(old('kebersihan'))
                                            {{ old('kebersihan') ==  'Bau' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebersihan == 'Bau' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bau" name="radio_kebersihan" class="ml-4"> Bau
                                <input @if(old('kebersihan'))
                                            {{ old('kebersihan') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebersihan == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_kebersihan" class="ml-4"> Lain-lain 
                                <input type="text"
                                       value="@if(old('ket_kebersihan')){{ old('ket_kebersihan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kebersihan : '' }}@endif"
                                       id="ket_kebersihan" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('kebersihan'))
                                        {{ old('kebersihan') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebersihan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Kelainan <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('kelainan'))
                                            {{ old('kelainan') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_kelainan"> TAK
                                <input @if(old('kelainan'))
                                            {{ old('kelainan') ==  'Hipospadia' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan == 'Hipospadia' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Hipospadia" name="radio_kelainan" class="ml-4"> Hipospadia
                                <input @if(old('kelainan'))
                                            {{ old('kelainan') ==  'Hernia' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan == 'Hernia' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Hernia" name="radio_kelainan" class="ml-4"> Hernia
                                <input @if(old('kelainan'))
                                            {{ old('kelainan') ==  'Hidrokel' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan == 'Hidrokel' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Hidrokel" name="radio_kelainan" class="ml-4"> Hidrokel
                                <input @if(old('kelainan'))
                                            {{ old('kelainan') ==  'Ambigous' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan == 'Ambigous' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ambigous" name="radio_kelainan" class="ml-4"> Ambigous
                                <br>
                                <input @if(old('kelainan'))
                                            {{ old('kelainan') ==  'Phimosis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan == 'Phimosis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Phimosis" name="radio_kelainan"> Phimosis
                                <input @if(old('kelainan'))
                                            {{ old('kelainan') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_kelainan" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_kelainan')){{ old('ket_kelainan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kelainan : '' }}@endif"
                                       id="ket_kelainan" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('kelainan'))
                                        {{ old('kelainan') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kelainan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">BAK <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('bak'))
                                            {{ old('bak') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_bak"> TAK
                                <input @if(old('bak'))
                                            {{ old('bak') ==  'Anuria' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak == 'Anuria' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Anuria" name="radio_bak" class="ml-4"> Anuria
                                <input @if(old('bak'))
                                            {{ old('bak') ==  'Disuria' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak == 'Disuria' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Disuria" name="radio_bak" class="ml-4"> Disuria
                                <input @if(old('bak'))
                                            {{ old('bak') ==  'Poliuria' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak == 'Poliuria' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Poliuria" name="radio_bak" class="ml-4"> Poliuria
                                <input @if(old('bak'))
                                            {{ old('bak') ==  'Retensi Urin' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak == 'Retensi Urin' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Retensi Urin" name="radio_bak" class="ml-4"> Retensi Urin
                                <br>
                                <input @if(old('bak'))
                                            {{ old('bak') ==  'Inkontinensia Urin' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak == 'Inkontinensia Urin' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Inkontinensia Urin" name="radio_bak"> Inkontinensia Urin
                                <input @if(old('bak'))
                                            {{ old('bak') ==  'Urostomy' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak == 'Urostomy' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Urostomy" name="radio_bak" class="ml-4"> Urostomy, Warna 
                                <input type="text"
                                       value="@if(old('ket_bak')){{ old('ket_bak') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_bak : '' }}@endif"
                                       id="ket_bak" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('bak'))
                                        {{ old('bak') == 'Urostomy' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bak == 'Urostomy' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Reproduksi</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-1">Wanita <span style="float: right">:</span></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Menarche <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                Umur :
                                <input type="text"
                                       value="@if(old('umur_menarche')){{ old('umur_menarche') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->umur_menarche : '' }}@endif"
                                       id="umur_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;"> Th, 
                                Siklus Haid : 
                                <input type="text"
                                       value="@if(old('siklus_haid_menarche')){{ old('siklus_haid_menarche') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->siklus_haid_menarche : '' }}@endif"
                                       id="siklus_haid_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;"> Hari, 
                                Lama Haid :
                                <input type="text"
                                       value="@if(old('lama_haid_menarche')){{ old('lama_haid_menarche') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lama_haid_menarche : '' }}@endif"
                                       id="lama_haid_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;"> Hari, 
                                HPHT
                                <input type="text"
                                       value="@if(old('hpht_menarche')){{ old('hpht_menarche') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hpht_menarche : '' }}@endif"
                                       id="hpht_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Gangguan Saat Haid <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('gangguan_haid'))
                                            {{ old('gangguan_haid') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gangguan_haid == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_gangguan_haid"> TAK
                                <input @if(old('gangguan_haid'))
                                            {{ old('gangguan_haid') ==  'Dismenorhe' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gangguan_haid == 'Dismenorhe' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Dismenorhe" name="radio_gangguan_haid" class="ml-4"> Dismenorhe
                                <input @if(old('gangguan_haid'))
                                            {{ old('gangguan_haid') ==  'Metroraghi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gangguan_haid == 'Metroraghi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Metroraghi" name="radio_gangguan_haid" class="ml-4"> Metroraghi
                                <input @if(old('gangguan_haid'))
                                            {{ old('gangguan_haid') ==  'Spotting' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gangguan_haid == 'Spotting' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Spotting" name="radio_gangguan_haid" class="ml-4"> Spotting
                                <input @if(old('gangguan_haid'))
                                            {{ old('gangguan_haid') ==  'lain_lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gangguan_haid == 'lain_lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="lain_lain" name="radio_gangguan_haid" class="ml-4"> Lain-lain
                                <input type="text"
                                       value="@if(old('ket_gangguan_haid')){{ old('ket_gangguan_haid') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_gangguan_haid : '' }}@endif"
                                       id="ket_gangguan_haid" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('gangguan_haid'))
                                        {{ old('gangguan_haid') == 'lain_lain' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_haid == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Penggunaan Alat Kontrasepsi <span style="float: right">:</span></div>
                            <div class="col-md-9">
                                <input @if(old('alat_kontrasepsi'))
                                            {{ old('alat_kontrasepsi') ==  'Tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_kontrasepsi == 'Tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak" name="radio_alat_kontrasepsi"> Tidak
                                <input @if(old('alat_kontrasepsi'))
                                            {{ old('alat_kontrasepsi') ==  'Ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->alat_kontrasepsi == 'Ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ya" name="radio_alat_kontrasepsi" class="ml-4"> Ya, Sebutkan 
                                <input type="text"
                                       value="@if(old('ket_alat_kontrasepsi')){{ old('ket_alat_kontrasepsi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_alat_kontrasepsi : '' }}@endif"
                                       id="ket_alat_kontrasepsi" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('alat_kontrasepsi'))
                                        {{ old('alat_kontrasepsi') == 'Ya' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->alat_kontrasepsi == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Payudara <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('payudara'))
                                            {{ old('payudara') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->payudara == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_payudara"> TAK
                                <span class="ml-4">Asi Sudah : </span>
                                <input @if(old('payudara'))
                                            {{ old('payudara') ==  'Keluar' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->payudara == 'Keluar' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Keluar" name="radio_payudara"> Keluar /
                                <input @if(old('payudara'))
                                            {{ old('payudara') ==  'Belum' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->payudara == 'Belum' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Belum" name="radio_payudara"> Belum
                                <span class="ml-4">Puting : </span>
                                <input @if(old('payudara'))
                                            {{ old('payudara') ==  'Menonjol' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->payudara == 'Menonjol' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Menonjol" name="radio_payudara"> Menonjol /
                                <input @if(old('payudara'))
                                            {{ old('payudara') ==  'Lecet' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->payudara == 'Lecet' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lecet" name="radio_payudara"> Lecet /
                                <input @if(old('payudara'))
                                            {{ old('payudara') ==  'Masuk Kedalam' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->payudara == 'Masuk Kedalam' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Masuk Kedalam" name="radio_payudara"> Masuk Kedalam
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Tanda-tanda Mastitis <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('mastitis'))
                                            {{ old('mastitis') ==  'Bengkak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mastitis == 'Bengkak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bengkak" name="radio_mastitis"> Bengkak
                                <input @if(old('mastitis'))
                                            {{ old('mastitis') ==  'Nyeri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mastitis == 'Nyeri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Nyeri" name="radio_mastitis" class="ml-4"> Nyeri
                                <input @if(old('mastitis'))
                                            {{ old('mastitis') ==  'Kemerahan' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mastitis == 'Kemerahan' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Kemerahan" name="radio_mastitis" class="ml-4"> Kemerahan
                                <input @if(old('mastitis'))
                                            {{ old('mastitis') ==  'Tidak Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->mastitis == 'Tidak Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak Ada" name="radio_mastitis" class="ml-4"> Tidak Ada
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Uterus <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                TFU :
                                <input type="text"
                                       value="@if(old('umur_menarche')){{ old('umur_menarche') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->umur_menarche : '' }}@endif"
                                       id="umur_menarche" style="border: 0; border-bottom: 2px dotted;"> 
                                <span class="ml-4">Kontraksi Uterus : </span>
                                <input @if(old('kontraksi_uterus'))
                                            {{ old('kontraksi_uterus') ==  'Keras' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kontraksi_uterus == 'Keras' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Keras" name="radio_kontraksi_uterus"> Keras /
                                <input @if(old('kontraksi_uterus'))
                                            {{ old('kontraksi_uterus') ==  'Lembek' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kontraksi_uterus == 'Lembek' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lembek" name="radio_kontraksi_uterus" > Lembek
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">Laki - Laki <span style="float: right">:</span></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Sirkumsisi <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('sirkumsisi'))
                                            {{ old('sirkumsisi') ==  'Tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sirkumsisi == 'Tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak" name="radio_sirkumsisi"> Tidak
                                <input @if(old('sirkumsisi'))
                                            {{ old('sirkumsisi') ==  'Ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sirkumsisi == 'Ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ya" name="radio_sirkumsisi" class="ml-4"> Ya
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Gangguan Prostat <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('gangguan_prostat'))
                                            {{ old('gangguan_prostat') ==  'Tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gangguan_prostat == 'Tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak" name="radio_gangguan_prostat"> Tidak
                                <input @if(old('gangguan_prostat'))
                                            {{ old('gangguan_prostat') ==  'Ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->gangguan_prostat == 'Ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ya" name="radio_gangguan_prostat" class="ml-4"> Ya
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Integumen</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-2">Turgo <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('turgo'))
                                            {{ old('turgo') ==  'Baik' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->turgo == 'Baik' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Baik" name="radio_turgo"> Baik, Elasti
                                <input @if(old('turgo'))
                                            {{ old('turgo') ==  'Sedang' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->turgo == 'Sedang' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Sedang" name="radio_turgo" class="ml-4"> Sedang
                                <input @if(old('turgo'))
                                            {{ old('turgo') ==  'Buruk' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->turgo == 'Buruk' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Buruk" name="radio_turgo" class="ml-4"> Buruk
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Warna <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('warna_integumen'))
                                            {{ old('warna_integumen') ==  'TAK' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_integumen == 'TAK' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="TAK" name="radio_warna_integumen"> TAK
                                <input @if(old('warna_integumen'))
                                            {{ old('warna_integumen') ==  'Ikterik' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_integumen == 'Ikterik' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ikterik" name="radio_warna_integumen" class="ml-4"> Ikterik
                                <input @if(old('warna_integumen'))
                                            {{ old('warna_integumen') ==  'Pucat' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_integumen == 'Pucat' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pucat" name="radio_warna_integumen" class="ml-4"> Pucat
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Integritas <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('integritas'))
                                            {{ old('integritas') ==  'Utuh' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->integritas == 'Utuh' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Utuh" name="radio_integritas"> Utuh
                                <input @if(old('integritas'))
                                            {{ old('integritas') ==  'Dekubitus' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->integritas == 'Dekubitus' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Dekubitus" name="radio_integritas" class="ml-4"> Dekubitus
                                <input @if(old('integritas'))
                                            {{ old('integritas') ==  'Rash' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->integritas == 'Rash' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Rash" name="radio_integritas" class="ml-4"> Rash / ruam
                                <input @if(old('integritas'))
                                            {{ old('integritas') ==  'Ptekiae' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->integritas == 'Ptekiae' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ptekiae" name="radio_integritas" class="ml-4"> Ptekiae
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Kriteria Risiko Dekubituas <span style="float: right">:</span></div>
                            <div class="col-md-8">
                                <input @if(old('dekubituas'))
                                            {{ old('dekubituas') ==  'Usia > 65' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->dekubituas == 'Usia > 65' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Usia > 65" name="radio_dekubituas"> Usia > 65
                                <input @if(old('dekubituas'))
                                            {{ old('dekubituas') ==  'Obesitas' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->dekubituas == 'Obesitas' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Obesitas" name="radio_dekubituas" class="ml-4"> Obesitas
                                <input @if(old('dekubituas'))
                                            {{ old('dekubituas') ==  'Pasien Immobilisasi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->dekubituas == 'Pasien Immobilisasi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Pasien Immobilisasi" name="radio_dekubituas" class="ml-4"> Pasien Immobilisasi
                                <br>
                                <input @if(old('dekubituas'))
                                            {{ old('dekubituas') ==  'Rawat Niccu' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->dekubituas == 'Rawat Niccu' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Rawat Niccu" name="radio_dekubituas"> Rawat Niccu/PICUICU
                                <input @if(old('dekubituas'))
                                            {{ old('dekubituas') ==  'Paraplezi' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->dekubituas == 'Paraplezi' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Paraplezi" name="radio_dekubituas" class="ml-4"> Paraplezi
                                <input @if(old('dekubituas'))
                                            {{ old('dekubituas') ==  'Inkontenensia uri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->dekubituas == 'Inkontenensia uri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Inkontenensia uri" name="radio_dekubituas" class="ml-4"> Inkontenensia uri/alvi
                                <br>
                                <input @if(old('dekubituas'))
                                            {{ old('dekubituas') ==  'penyakit_kronis' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->dekubituas == 'penyakit_kronis' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="penyakit_kronis" name="radio_dekubituas"> Penyakit Kronis
                                <input type="text"
                                       value="@if(old('ket_dekubituas')){{ old('ket_dekubituas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_dekubituas : '' }}@endif"
                                       id="ket_dekubituas" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('dekubituas'))
                                        {{ old('dekubituas') == 'penyakit_kronis' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->dekubituas == 'penyakit_kronis' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 1px solid">
                    <td style="width: 15%; border: 1px solid;">Sistem Muskuloskeletal</td>
                    <td style="border: 1px solid" colspan="5">
                        <div class="row">
                            <div class="col-md-2">Pergerakan Sendi <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('pergerakan_sendi'))
                                            {{ old('pergerakan_sendi') ==  'Bebas' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pergerakan_sendi == 'Bebas' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bebas" name="radio_pergerakan_sendi"> Bebas
                                <input @if(old('pergerakan_sendi'))
                                            {{ old('pergerakan_sendi') ==  'Terbatas' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pergerakan_sendi == 'Terbatas' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Terbatas" name="radio_pergerakan_sendi" class="ml-4"> Terbatas
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Kekuatan Otot <span style="float: right">:</span></div>
                            <div class="col-md-10">
                                <input @if(old('kekuatan_otot'))
                                            {{ old('kekuatan_otot') ==  'Baik' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Baik' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Baik" name="radio_kekuatan_otot"> Baik
                                <input @if(old('kekuatan_otot'))
                                            {{ old('kekuatan_otot') ==  'Lemah' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Lemah' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Lemah" name="radio_kekuatan_otot" class="ml-4"> Lemah
                                <input @if(old('kekuatan_otot'))
                                            {{ old('kekuatan_otot') ==  'Tremor' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kekuatan_otot == 'Tremor' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tremor" name="radio_kekuatan_otot" class="ml-4"> Tremor
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Nyeri Sendi <span style="float: right">:</span></div>
                            <div class="col-md-8">
                                <input @if(old('nyeri_sendi'))
                                            {{ old('nyeri_sendi') ==  'Tidak Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_sendi == 'Tidak Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak Ada" name="radio_nyeri_sendi"> Tidak Ada
                                <input @if(old('nyeri_sendi'))
                                            {{ old('nyeri_sendi') ==  'Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_sendi == 'Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ada" name="radio_nyeri_sendi" class="ml-4"> Ada, Lokasi
                                <input type="text"
                                       value="@if(old('ket_nyeri_sendi')){{ old('ket_nyeri_sendi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_nyeri_sendi : '' }}@endif"
                                       id="ket_nyeri_sendi" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('nyeri_sendi'))
                                        {{ old('nyeri_sendi') == 'Ada' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri_sendi == 'Ada' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Oedema <span style="float: right">:</span></div>
                            <div class="col-md-8">
                                <input @if(old('oedema'))
                                            {{ old('oedema') ==  'Tidak Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->oedema == 'Tidak Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak Ada" name="radio_oedema"> Tidak Ada
                                <input @if(old('oedema'))
                                            {{ old('oedema') ==  'Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->oedema == 'Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ada" name="radio_oedema" class="ml-4"> Ada, Lokasi
                                <input type="text"
                                       value="@if(old('ket_oedema')){{ old('ket_oedema') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_oedema : '' }}@endif"
                                       id="ket_oedema" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('oedema'))
                                        {{ old('oedema') == 'Ada' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->oedema == 'Ada' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Fraktur <span style="float: right">:</span></div>
                            <div class="col-md-8">
                                <input @if(old('fraktur'))
                                            {{ old('fraktur') ==  'Tidak Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->fraktur == 'Tidak Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak Ada" name="radio_fraktur"> Tidak Ada
                                <input @if(old('fraktur'))
                                            {{ old('fraktur') ==  'Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->fraktur == 'Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ada" name="radio_fraktur" class="ml-4"> Ada, Lokasi
                                <input type="text"
                                       value="@if(old('ket_fraktur')){{ old('ket_fraktur') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_fraktur : '' }}@endif"
                                       id="ket_fraktur" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('fraktur'))
                                        {{ old('fraktur') == 'Ada' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->fraktur == 'Ada' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Parese <span style="float: right">:</span></div>
                            <div class="col-md-8">
                                <input @if(old('parese'))
                                            {{ old('parese') ==  'Tidak Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->parese == 'Tidak Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Tidak Ada" name="radio_parese"> Tidak Ada
                                <input @if(old('parese'))
                                            {{ old('parese') ==  'Ada' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->parese == 'Ada' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Ada" name="radio_parese" class="ml-4"> Ada, Lokasi
                                <input type="text"
                                       value="@if(old('ket_parese')){{ old('ket_parese') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_parese : '' }}@endif"
                                       id="ket_parese" style="border: 0; border-bottom: 2px dotted;"
                                        @if(old('parese'))
                                        {{ old('parese') == 'Ada' ? '' : 'readonly' }}
                                        @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->parese == 'Ada' ? '' : 'readonly') : 'readonly' }}
                                        @endif>
                            </div>
                        </div>
                    </td>
                </tr>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="6">
                    III. Kenyamanan
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
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_nyeri"> Ya
                </td>
                <td colspan="3">
                    Sifat :
                    <input @if(old('sifat_nyeri'))
                               {{ old('sifat_nyeri') ==  'akut' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->sifat_nyeri == 'akut' ? 'checked' : '') : '' }}
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
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : '' }}
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
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->nyeri_menjalar == 'tidak' ? 'checked' : '') : '' }}
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
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : '' }}
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
                                       {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : '' }}
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
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4">
                    IV. Pola Kehidupan Sehari - Hari
                    <br>
                    <span style="padding-left: 23px"> Sebelum Sakit : </span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    1. Pola aktifitas (makanan/minuman, mandi, eliminasi, berpakaian dan berpindah) :
                    <ul class="list_alfabeth">
                        <li>
                            <div class="row">
                                <div class="col-md-2">Makan/Minum <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_makan_sebelum_sakit'))
                                            {{ old('aktifitas_makan_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_makan_sebelum_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_makan_sebelum_sakit"> Mandiri
                                    <input @if(old('aktifitas_makan_sebelum_sakit'))
                                            {{ old('aktifitas_makan_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_makan_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_makan_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Mandi <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_mandi_sebelum_sakit'))
                                            {{ old('aktifitas_mandi_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_mandi_sebelum_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_mandi_sebelum_sakit"> Mandiri
                                    <input @if(old('aktifitas_mandi_sebelum_sakit'))
                                            {{ old('aktifitas_mandi_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_mandi_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_mandi_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Eliminasi <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_eliminasi_sebelum_sakit'))
                                            {{ old('aktifitas_eliminasi_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_eliminasi_sebelum_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_eliminasi_sebelum_sakit"> Mandiri
                                    <input @if(old('aktifitas_eliminasi_sebelum_sakit'))
                                            {{ old('aktifitas_eliminasi_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_eliminasi_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_eliminasi_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Berpakaian <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_berpakaian_sebelum_sakit'))
                                            {{ old('aktifitas_berpakaian_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpakaian_sebelum_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_berpakaian_sebelum_sakit"> Mandiri
                                    <input @if(old('aktifitas_berpakaian_sebelum_sakit'))
                                            {{ old('aktifitas_berpakaian_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpakaian_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpakaian_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Berpindah <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_berpindah_sebelum_sakit'))
                                            {{ old('aktifitas_berpindah_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpindah_sebelum_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_berpindah_sebelum_sakit"> Mandiri
                                    <input @if(old('aktifitas_berpindah_sebelum_sakit'))
                                            {{ old('aktifitas_berpindah_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpindah_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpindah_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    2. Pola Nutrisi :
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_frekuensi_makan_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_sebelum_sakit ? in_array('frekuensi_makan_sebelum_sakit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="frekuensi_makan_sebelum_sakit"> Frekuensi Makan : <input type="text"
                            value="@if(old('frekuensi_makan_sebelum_sakit')){{ old('frekuensi_makan_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_makan_sebelum_sakit : '' }}@endif"
                            id="frekuensi_makan_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_jenis_makan_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_sebelum_sakit ? in_array('jenis_makan_sebelum_sakit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="jenis_makan_sebelum_sakit"> Jenis Makanan : <input type="text"
                            value="@if(old('jenis_makan_sebelum_sakit')){{ old('jenis_makan_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_makan_sebelum_sakit : '' }}@endif"
                            id="jenis_makan_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_porsi_makan_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_sebelum_sakit ? in_array('porsi_makan_sebelum_sakit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="porsi_makan_sebelum_sakit"> Porsi Makan : <input type="text"
                            value="@if(old('porsi_makan_sebelum_sakit')){{ old('porsi_makan_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->porsi_makan_sebelum_sakit : '' }}@endif"
                            id="porsi_makan_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> Porsi
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    3. Pola Tidur :
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-4">
                            Lama Tidur : <input type="text"
                            value="@if(old('lama_tirud_sebelum_sakit')){{ old('lama_tirud_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lama_tirud_sebelum_sakit : '' }}@endif"
                            id="lama_tirud_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> Jam/hari
                        </div>
                        <div class="col-md-8">
                            <input @if(old('pola_tidur_sebelum_sakit'))
                                    {{ old('pola_tidur_sebelum_sakit') ==  'Tidak Ada Gangguan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_tidur_sebelum_sakit == 'Tidak Ada Gangguan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak Ada Gangguan" name="radio_pola_tidur_sebelum_sakit"> Tidak Ada Gangguan
                            <input @if(old('pola_tidur_sebelum_sakit'))
                                    {{ old('pola_tidur_sebelum_sakit') ==  'Insomnia' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_tidur_sebelum_sakit == 'Insomnia' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Insomnia" name="radio_pola_tidur_sebelum_sakit" class="ml-4"> Insomnia
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    4. Pola Eliminasi :
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                            BAK <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_bak_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit ? in_array('tidak_ada_kelainan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="tidak_ada_kelainan"> Tidak Ada Kelainan : <input type="text"
                            value="@if(old('kelinan_bak_sebelum_sakit')){{ old('kelinan_bak_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelinan_bak_sebelum_sakit : '' }}@endif"
                            id="kelinan_bak_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bak_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit ? in_array('warna',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="warna"> Warna : <input type="text"
                            value="@if(old('warna_bak_sebelum_sakit')){{ old('warna_bak_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_bak_sebelum_sakit : '' }}@endif"
                            id="warna_bak_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit ? in_array('Disuria',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Disuria"> Disuria 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit ? in_array('Anuria',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Anuria"> Anuria 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit ? in_array('Poll Uria',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Poll Uria"> Poll Uria 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit ? in_array('Retensi Urine',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Retensi Urine"> Retensi Urine 
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                            BAB <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit ? in_array('tidak_ada_kelainan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="tidak_ada_kelainan"> Tidak Ada Kelainan : <input type="text"
                            value="@if(old('kelinan_bab_sebelum_sakit')){{ old('kelinan_bab_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelinan_bab_sebelum_sakit : '' }}@endif"
                            id="kelinan_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit ? in_array('warna',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="warna"> Warna : <input type="text"
                            value="@if(old('warna_bab_sebelum_sakit')){{ old('warna_bab_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_bab_sebelum_sakit : '' }}@endif"
                            id="warna_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit ? in_array('Konsistensi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Konsistensi"> Konsistensi : <input type="text"
                            value="@if(old('konsistensi_bab_sebelum_sakit')){{ old('konsistensi_bab_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->konsistensi_bab_sebelum_sakit : '' }}@endif"
                            id="konsistensi_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit ? in_array('Konstipasi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Konstipasi"> Konstipasi : <input type="text"
                            value="@if(old('konstipasi_bab_sebelum_sakit')){{ old('konstipasi_bab_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->konstipasi_bab_sebelum_sakit : '' }}@endif"
                            id="konstipasi_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit ? in_array('lain_lain',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_sebelum_sakit )) ? 'checked' : '' : '' }}
                            @endif id="lain_lain"> Lain - lain : <input type="text"
                            value="@if(old('ket_bab_sebelum_sakit')){{ old('ket_bab_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bab_sebelum_sakit : '' }}@endif"
                            id="ket_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            5. Riwayat Merokok <span style="float: right"> : </span>
                        </div>
                        <div class="col-md-9">
                            <input @if(old('riwayat_merokok_sebelum_sakit'))
                                    {{ old('riwayat_merokok_sebelum_sakit') ==  'Tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_merokok_sebelum_sakit == 'Tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak" name="radio_riwayat_merokok_sebelum_sakit"> Tidak
                            <input @if(old('riwayat_merokok_sebelum_sakit'))
                                    {{ old('riwayat_merokok_sebelum_sakit') ==  'Ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_merokok_sebelum_sakit == 'Ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Ya" name="radio_riwayat_merokok_sebelum_sakit" class="ml-4"> Ya, Jumlah/hari
                            <input type="text" readonly
                                value="@if(old('jumlah_riwayat_merokok_sebelum_sakit')){{ old('jumlah_riwayat_merokok_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jumlah_riwayat_merokok_sebelum_sakit : '' }}@endif"
                                id="jumlah_riwayat_merokok_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_merokok_sebelum_sakit'))
                                    {{ old('riwayat_merokok_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_merokok_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                            <span class="ml-4">Lamanya : </span>
                            <input type="text" readonly
                                value="@if(old('lamanya_riwayat_merokok_sebelum_sakit')){{ old('lamanya_riwayat_merokok_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lamanya_riwayat_merokok_sebelum_sakit : '' }}@endif"
                                id="lamanya_riwayat_merokok_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_merokok_sebelum_sakit'))
                                    {{ old('riwayat_merokok_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_merokok_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            6. Riwayat Minum Minuman Keras <span style="float: right"> : </span>
                        </div>
                        <div class="col-md-9">
                            <input @if(old('riwayat_miras_sebelum_sakit'))
                                    {{ old('riwayat_miras_sebelum_sakit') ==  'Tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_miras_sebelum_sakit == 'Tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak" name="radio_riwayat_miras_sebelum_sakit"> Tidak
                            <input @if(old('riwayat_miras_sebelum_sakit'))
                                    {{ old('riwayat_miras_sebelum_sakit') ==  'Ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_miras_sebelum_sakit == 'Ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Ya" name="radio_riwayat_miras_sebelum_sakit" class="ml-4"> Ya, Jenis
                            <input type="text" readonly
                                value="@if(old('jenis_riwayat_miras_sebelum_sakit')){{ old('jenis_riwayat_miras_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_riwayat_miras_sebelum_sakit : '' }}@endif"
                                id="jenis_riwayat_miras_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_miras_sebelum_sakit'))
                                    {{ old('riwayat_miras_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_miras_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                            <span class="ml-4">Jumlah/hari : </span>
                            <input type="text" readonly
                                value="@if(old('jumlah_riwayat_miras_sebelum_sakit')){{ old('jumlah_riwayat_miras_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jumlah_riwayat_miras_sebelum_sakit : '' }}@endif"
                                id="jumlah_riwayat_miras_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_miras_sebelum_sakit'))
                                    {{ old('riwayat_miras_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_miras_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            7. Riwayat Penggunaan Obat Penenang <span style="float: right"> : </span>
                        </div>
                        <div class="col-md-9">
                            <input @if(old('riwayat_obat_penenang_sebelum_sakit'))
                                    {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_obat_penenang_sebelum_sakit == 'Tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak" name="radio_riwayat_obat_penenang_sebelum_sakit"> Tidak
                            <input @if(old('riwayat_obat_penenang_sebelum_sakit'))
                                    {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_obat_penenang_sebelum_sakit == 'Ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Ya" name="radio_riwayat_obat_penenang_sebelum_sakit" class="ml-4"> Ya, Jenis
                            <input type="text" readonly
                                value="@if(old('jenis_riwayat_obat_penenang_sebelum_sakit')){{ old('jenis_riwayat_obat_penenang_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_riwayat_obat_penenang_sebelum_sakit : '' }}@endif"
                                id="jenis_riwayat_obat_penenang_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_obat_penenang_sebelum_sakit'))
                                    {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_obat_penenang_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                            <span class="ml-4">Jumlah/hari : </span>
                            <input type="text" readonly
                                value="@if(old('jumlah_riwayat_obat_penenang_sebelum_sakit')){{ old('jumlah_riwayat_obat_penenang_sebelum_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jumlah_riwayat_obat_penenang_sebelum_sakit : '' }}@endif"
                                id="jumlah_riwayat_obat_penenang_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_obat_penenang_sebelum_sakit'))
                                    {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_obat_penenang_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <br>
                    <span style="padding-left: 23px"> Saat Sakit : </span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    1. Pola aktifitas (makanan/minuman, mandi, eliminasi, berpakaian dan berpindah) :
                    <ul class="list_alfabeth">
                        <li>
                            <div class="row">
                                <div class="col-md-2">Makan/Minum <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_makan_saat_sakit'))
                                            {{ old('aktifitas_makan_saat_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_makan_saat_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_makan_saat_sakit"> Mandiri
                                    <input @if(old('aktifitas_makan_saat_sakit'))
                                            {{ old('aktifitas_makan_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_makan_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_makan_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Mandi <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_mandi_saat_sakit'))
                                            {{ old('aktifitas_mandi_saat_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_mandi_saat_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_mandi_saat_sakit"> Mandiri
                                    <input @if(old('aktifitas_mandi_saat_sakit'))
                                            {{ old('aktifitas_mandi_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_mandi_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_mandi_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Eliminasi <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_eliminasi_saat_sakit'))
                                            {{ old('aktifitas_eliminasi_saat_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_eliminasi_saat_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_eliminasi_saat_sakit"> Mandiri
                                    <input @if(old('aktifitas_eliminasi_saat_sakit'))
                                            {{ old('aktifitas_eliminasi_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_eliminasi_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_eliminasi_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Berpakaian <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_berpakaian_saat_sakit'))
                                            {{ old('aktifitas_berpakaian_saat_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpakaian_saat_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_berpakaian_saat_sakit"> Mandiri
                                    <input @if(old('aktifitas_berpakaian_saat_sakit'))
                                            {{ old('aktifitas_berpakaian_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpakaian_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpakaian_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2">Berpindah <span style="float: right;">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('aktifitas_berpindah_saat_sakit'))
                                            {{ old('aktifitas_berpindah_saat_sakit') ==  'Mandiri' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpindah_saat_sakit == 'Mandiri' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Mandiri" name="radio_aktifitas_berpindah_saat_sakit"> Mandiri
                                    <input @if(old('aktifitas_berpindah_saat_sakit'))
                                            {{ old('aktifitas_berpindah_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->aktifitas_berpindah_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpindah_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                </div>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    2. Pola Nutrisi :
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_frekuensi_makan_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_saat_sakit ? in_array('frekuensi_makan_saat_sakit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="frekuensi_makan_saat_sakit"> Frekuensi Makan : <input type="text"
                            value="@if(old('frekuensi_makan_saat_sakit')){{ old('frekuensi_makan_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->frekuensi_makan_saat_sakit : '' }}@endif"
                            id="frekuensi_makan_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_jenis_makan_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_saat_sakit ? in_array('jenis_makan_saat_sakit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="jenis_makan_saat_sakit"> Jenis Makanan : <input type="text"
                            value="@if(old('jenis_makan_saat_sakit')){{ old('jenis_makan_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jenis_makan_saat_sakit : '' }}@endif"
                            id="jenis_makan_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_porsi_makan_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_saat_sakit ? in_array('porsi_makan_saat_sakit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_nutrisi_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="porsi_makan_saat_sakit"> Porsi Makan : <input type="text"
                            value="@if(old('porsi_makan_saat_sakit')){{ old('porsi_makan_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->porsi_makan_saat_sakit : '' }}@endif"
                            id="porsi_makan_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> Porsi
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    3. Pola Tidur :
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-4">
                            Lama Tidur : <input type="text"
                            value="@if(old('lama_tirud_saat_sakit')){{ old('lama_tirud_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lama_tirud_saat_sakit : '' }}@endif"
                            id="lama_tirud_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> Jam/hari
                        </div>
                        <div class="col-md-8">
                            <input @if(old('pola_tidur_saat_sakit'))
                                    {{ old('pola_tidur_saat_sakit') ==  'Tidak Ada Gangguan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_tidur_saat_sakit == 'Tidak Ada Gangguan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak Ada Gangguan" name="radio_pola_tidur_saat_sakit"> Tidak Ada Gangguan
                            <input @if(old('pola_tidur_saat_sakit'))
                                    {{ old('pola_tidur_saat_sakit') ==  'Insomnia' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pola_tidur_saat_sakit == 'Insomnia' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Insomnia" name="radio_pola_tidur_saat_sakit" class="ml-4"> Insomnia
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    4. Pola Eliminasi :
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                            BAK <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_bak_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit ? in_array('tidak_ada_kelainan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="tidak_ada_kelainan"> Tidak Ada Kelainan : <input type="text"
                            value="@if(old('kelinan_bak_saat_sakit')){{ old('kelinan_bak_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelinan_bak_saat_sakit : '' }}@endif"
                            id="kelinan_bak_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bak_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit ? in_array('warna',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="warna"> Warna : <input type="text"
                            value="@if(old('warna_bak_saat_sakit')){{ old('warna_bak_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_bak_saat_sakit : '' }}@endif"
                            id="warna_bak_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit ? in_array('Disuria',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Disuria"> Disuria 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit ? in_array('Anuria',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Anuria"> Anuria 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit ? in_array('Poll Uria',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Poll Uria"> Poll Uria 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit ? in_array('Retensi Urine',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bak_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Retensi Urine"> Retensi Urine 
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                            BAB <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit ? in_array('tidak_ada_kelainan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="tidak_ada_kelainan"> Tidak Ada Kelainan : <input type="text"
                            value="@if(old('kelinan_bab_saat_sakit')){{ old('kelinan_bab_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelinan_bab_saat_sakit : '' }}@endif"
                            id="kelinan_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit ? in_array('warna',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="warna"> Warna : <input type="text"
                            value="@if(old('warna_bab_saat_sakit')){{ old('warna_bab_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->warna_bab_saat_sakit : '' }}@endif"
                            id="warna_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit ? in_array('Konsistensi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Konsistensi"> Konsistensi : <input type="text"
                            value="@if(old('konsistensi_bab_saat_sakit')){{ old('konsistensi_bab_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->konsistensi_bab_saat_sakit : '' }}@endif"
                            id="konsistensi_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px">
                        <div class="col-md-1">
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit ? in_array('Konstipasi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="Konstipasi"> Konstipasi : <input type="text"
                            value="@if(old('konstipasi_bab_saat_sakit')){{ old('konstipasi_bab_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->konstipasi_bab_saat_sakit : '' }}@endif"
                            id="konstipasi_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit ? in_array('lain_lain',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->bab_saat_sakit )) ? 'checked' : '' : '' }}
                            @endif id="lain_lain"> Lain - lain : <input type="text"
                            value="@if(old('ket_bab_saat_sakit')){{ old('ket_bab_saat_sakit') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bab_saat_sakit : '' }}@endif"
                            id="ket_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
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
                    V. Spiritual, Sosial, dan Budaya
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    1. Agama : 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'islam' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'islam' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="islam" name="radio_agama"> Islam 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'Protestan' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'Protestan' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Protestan" name="radio_agama" class="ml-4"> Protestan 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'katolik' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'katolik' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="katolik" name="radio_agama" class="ml-4"> Katolik 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'hindu' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'hindu' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="hindu" name="radio_agama" class="ml-4"> Hindu 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'budha' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'budha' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="budha" name="radio_agama" class="ml-4"> Budha
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_agama" class="ml-4"> 
                    <input type="text" readonly
                        value="@if(old('agama_lain')){{ old('agama_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->agama_lain : '' }}@endif"
                        id="agama_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('agama'))
                            {{ old('agama') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    2. Mengungkapkan Keprihatinan yang Berhubungan Dengan Rawat Inap : 
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_keprihatinan()" @if(old('keprihatinan'))
                                {{ old('keprihatinan') ==  'Tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keprihatinan == 'Tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak" name="radio_keprihatinan"> Tidak 
                            <input onclick="cek_radio_keprihatinan()" @if(old('keprihatinan'))
                                {{ old('keprihatinan') ==  'Ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keprihatinan == 'Ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Ya" name="radio_keprihatinan" class="ml-4"> Ya <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail ? in_array('satu',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail )) ? 'checked' : '' : '' }}
                            @endif id="satu"> Ketidakmampuan Untuk Mempertahankan Praktek Spiritual Seperti Biasa
                            <br>
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail ? in_array('dua',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail )) ? 'checked' : '' : '' }}
                            @endif id="dua"> Perasaan Negatif Tentang Sistem Kepercayaan Terhadap Spiritual
                            <br>
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail ? in_array('tiga',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail )) ? 'checked' : '' : '' }}
                            @endif id="tiga"> Konflik Antara Kepercayaan Spiritual Dengan Ketentuan Sistem Kesehatan
                            <br>
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail ? in_array('empat',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail )) ? 'checked' : '' : '' }}
                            @endif id="empat"> Bimbingan Rohani
                            <br>
                            <input onclick="cek_detail_keprihatinan()" type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail ? in_array('lima',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->keprihatinan_detail )) ? 'checked' : '' : '' }}
                            @endif id="lima"> Lain - lain
                            <input type="text"
                            value="@if(old('ket_keprihatinan_detail')){{ old('ket_keprihatinan_detail') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_keprihatinan_detail : '' }}@endif"
                            id="ket_keprihatinan_detail" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    3. Pekerjaan : 
                    <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan'))
                        {{ old('pekerjaan') ==  'PNS' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pekerjaan == 'PNS' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="PNS" name="radio_pekerjaan"> PNS/TNI/POLRI
                    <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan'))
                        {{ old('pekerjaan') ==  'Swasta' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pekerjaan == 'Swasta' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Swasta" name="radio_pekerjaan" class="ml-4"> Swasta 
                    <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan'))
                        {{ old('pekerjaan') ==  'Pensiun' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pekerjaan == 'Pensiun' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Pensiun" name="radio_pekerjaan" class="ml-4"> Pensiun 
                    <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan'))
                        {{ old('pekerjaan') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pekerjaan == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_pekerjaan" class="ml-4"> Lain - lain : 
                    <input type="text" readonly
                        value="@if(old('pekerjaan_lain')){{ old('pekerjaan_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pekerjaan_lain : '' }}@endif"
                        id="pekerjaan_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('pekerjaan'))
                            {{ old('pekerjaan') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pekerjaan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    4. Tinggal Bersama : 
                    <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama'))
                        {{ old('tinggal_bersama') ==  'suami' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'suami' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="suami" name="radio_tinggal_bersama"> Suami/Istri
                    <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama'))
                        {{ old('tinggal_bersama') ==  'Orang Tua' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'Orang Tua' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Orang Tua" name="radio_tinggal_bersama" class="ml-4"> Orang Tua 
                    <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama'))
                        {{ old('tinggal_bersama') ==  'Anak' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'Anak' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Anak" name="radio_tinggal_bersama" class="ml-4"> Anak 
                    <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama'))
                        {{ old('tinggal_bersama') ==  'Kerabat' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'Kerabat' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Kerabat" name="radio_tinggal_bersama" class="ml-4"> Kerabat 
                    <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama'))
                        {{ old('tinggal_bersama') ==  'Sendiri' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'Sendiri' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Sendiri" name="radio_tinggal_bersama" class="ml-4"> Sendiri 
                    <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama'))
                        {{ old('tinggal_bersama') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_tinggal_bersama" class="ml-4"> Lain - lain : 
                    <input type="text" readonly
                        value="@if(old('tinggal_bersama_lain')){{ old('tinggal_bersama_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama_lain : '' }}@endif"
                        id="tinggal_bersama_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('tinggal_bersama'))
                            {{ old('tinggal_bersama') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    5. Pendidikan Pasien : 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'TK' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'TK' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="TK" name="radio_pendidikan_pasien"> TK
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'SD' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'SD' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="SD" name="radio_pendidikan_pasien" class="ml-4"> SD 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'SMP' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'SMP' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="SMP" name="radio_pendidikan_pasien" class="ml-4"> SMP 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'SLTA' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'SLTA' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="SLTA" name="radio_pendidikan_pasien" class="ml-4"> SLTA 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'Akademi' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'Akademi' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Akademi" name="radio_pendidikan_pasien" class="ml-4"> Akademi 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'Pasca Sarjana' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'Pasca Sarjana' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Pasca Sarjana" name="radio_pendidikan_pasien" class="ml-4"> Pasca Sarjana 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_pendidikan_pasien" class="ml-4"> Lain - lain : 
                    <input type="text" readonly
                        value="@if(old('pendidikan_pasien_lain')){{ old('pendidikan_pasien_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien_lain : '' }}@endif"
                        id="pendidikan_pasien_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('pendidikan_pasien'))
                            {{ old('pendidikan_pasien') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    &nbsp;&nbsp;&nbsp; Pendidikan Penanggung Jawab : 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'TK' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'TK' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="TK" name="radio_pendidikan_pasien"> TK
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'SD' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'SD' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="SD" name="radio_pendidikan_pasien" class="ml-4"> SD 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'SMP' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'SMP' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="SMP" name="radio_pendidikan_pasien" class="ml-4"> SMP 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'SLTA' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'SLTA' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="SLTA" name="radio_pendidikan_pasien" class="ml-4"> SLTA 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'Akademi' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'Akademi' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Akademi" name="radio_pendidikan_pasien" class="ml-4"> Akademi 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'Pasca Sarjana' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'Pasca Sarjana' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="Pasca Sarjana" name="radio_pendidikan_pasien" class="ml-4"> Pasca Sarjana 
                    <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien'))
                        {{ old('pendidikan_pasien') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_pendidikan_pasien" class="ml-4"> Lain - lain : 
                    <input type="text" readonly
                        value="@if(old('pendidikan_pasien_lain')){{ old('pendidikan_pasien_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien_lain : '' }}@endif"
                        id="pendidikan_pasien_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('pendidikan_pasien'))
                            {{ old('pendidikan_pasien') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_pasien == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    6. Suku : <input type="text" 
                        value="@if(old('suku')){{ old('suku') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->suku : '' }}@endif"
                        id="suku" style="border: 0; border-bottom: 2px dotted; width: 95%">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4">
                    VI. Proteksi
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    <div class="row">
                        <div class="col-md-2">
                            1. Status Mental <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input @if(old('status_mental'))
                                {{ old('status_mental') ==  'Orientasi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_mental == 'Orientasi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Orientasi" name="radio_status_mental"> Orientasi 
                            <input @if(old('status_mental'))
                                {{ old('status_mental') ==  'Tidak Ada Respon' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_mental == 'Tidak Ada Respon' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak Ada Respon" name="radio_status_mental" class="ml-4"> Tidak Ada Respon 
                            <input @if(old('status_mental'))
                                {{ old('status_mental') ==  'Agitasi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_mental == 'Agitasi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Agitasi" name="radio_status_mental" class="ml-4"> Agitasi 
                            <input @if(old('status_mental'))
                                {{ old('status_mental') ==  'Menyerang' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_mental == 'Menyerang' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Menyerang" name="radio_status_mental" class="ml-4"> Menyerang 
                            <input @if(old('status_mental'))
                                {{ old('status_mental') ==  'Kooperatif' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_mental == 'Kooperatif' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Kooperatif" name="radio_status_mental" class="ml-4"> Kooperatif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input @if(old('status_mental'))
                                {{ old('status_mental') ==  'Letargi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_mental == 'Letargi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Letargi" name="radio_status_mental"> Letargi 
                            <input @if(old('status_mental'))
                                {{ old('status_mental') ==  'Disorientasi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_mental == 'Disorientasi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Disorientasi" name="radio_status_mental" class="ml-4"> Disorientasi :
                            <input @if(old('detail_status_mental'))
                                {{ old('detail_status_mental') ==  'Orang' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_status_mental == 'Orang' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Orang" name="radio_detail_status_mental" class="ml-4"> Orang 
                            <input @if(old('detail_status_mental'))
                                {{ old('detail_status_mental') ==  'Tempat' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_status_mental == 'Tempat' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tempat" name="radio_detail_status_mental" class="ml-4"> Tempat 
                            <input @if(old('detail_status_mental'))
                                {{ old('detail_status_mental') ==  'Waktu' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_status_mental == 'Waktu' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Waktu" name="radio_detail_status_mental" class="ml-4"> Waktu
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    <div class="row">
                        <div class="col-md-2">
                            2. Status Psikologis <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'Tenang' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'Tenang' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tenang" name="radio_status_psikologis"> Tenang 
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'Cemas' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'Cemas' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Cemas" name="radio_status_psikologis" class="ml-4"> Cemas 
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'Sedih' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'Sedih' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Sedih" name="radio_status_psikologis" class="ml-4"> Sedih 
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'Depresi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'Depresi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Depresi" name="radio_status_psikologis" class="ml-4"> Depresi 
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'Marah' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'Marah' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Marah" name="radio_status_psikologis" class="ml-4"> Marah
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'Hiperaktif' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'Hiperaktif' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Hiperaktif" name="radio_status_psikologis" class="ml-4"> Hiperaktif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'Mengganggu Sekitar' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'Mengganggu Sekitar' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Mengganggu Sekitar" name="radio_status_psikologis"> Mengganggu Sekitar 
                            <input @if(old('status_psikologis'))
                                {{ old('status_psikologis') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_psikologis == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_status_psikologis" class="ml-4"> Lain - lain :
                            <input type="text" readonly
                                value="@if(old('ket_status_psikologis')){{ old('ket_status_psikologis') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_status_psikologis : '' }}@endif"
                                id="ket_status_psikologis" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('status_psikologis'))
                                    {{ old('status_psikologis') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->status_psikologis == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    <div class="row">
                        <div class="col-md-2">
                            3. Penggunaan Restrain <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input @if(old('penggunaan_restrain'))
                                {{ old('penggunaan_restrain') ==  'Tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penggunaan_restrain == 'Tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Tidak" name="radio_penggunaan_restrain"> Tidak 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input @if(old('penggunaan_restrain'))
                                {{ old('penggunaan_restrain') ==  'Ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penggunaan_restrain == 'Ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="Ya" name="radio_penggunaan_restrain"> Ya, Alasan :
                            <input @if(old('detail_penggunaan_restrain'))
                                {{ old('detail_penggunaan_restrain') ==  'membahayakan_diri_sendiri' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_penggunaan_restrain == 'membahayakan_diri_sendiri' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="membahayakan_diri_sendiri" name="radio_detail_penggunaan_restrain" class="ml-4"> Membahayakan Diri Sendiri
                            <input @if(old('detail_penggunaan_restrain'))
                                {{ old('detail_penggunaan_restrain') ==  'membahayakan_orang_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_penggunaan_restrain == 'membahayakan_orang_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="membahayakan_orang_lain" name="radio_detail_penggunaan_restrain" class="ml-4"> Membahayakan Orang Lain
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 17px">
                    4. Pengkajian Resiko Jatuh
                    <ul>
                        <li>Risiko Jatuh Morse (Dewasa)</li>
                        <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->risiko_jatuh ? in_array('tidak_risiko',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->risiko_jatuh )) ? 'checked' : '' : '' }}
                        @endif id="tidak_risiko"> Skor 0 - 24 : Tidak Risiko
                        <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->risiko_jatuh ? in_array('risiko_rendah',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->risiko_jatuh )) ? 'checked' : '' : '' }}
                        @endif id="risiko_rendah" class="ml-5"> Skor 25 - 50 : Risiko Rendah
                        <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                            {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->risiko_jatuh ? in_array('risiko_tinggi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->risiko_jatuh )) ? 'checked' : '' : '' }}
                        @endif id="risiko_tinggi" class="ml-5"> Skor > 51 : Risiko Tinggi
                        <table class="table_isian_bordered" style="width: 100%">
                            <tr style="text-align: center; font-weight: bold">
                                <td colspan="2">No</td>
                                <td style="width: 50%">Faktor Risiko</td>
                                <td style="width: 15%">Skala</td>
                                <td>Score</td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2" rowspan="2">1</td>
                                <td rowspan="2">Riwayat Jatuh segera atau dalam waktu 3 bukan (Umum > 65 Th, dalam waktu 12 bulan)</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">Tidak</div>
                                        <div class="col-md-6">: 0</div>
                                    </div>
                                </td>
                                <td rowspan="2">
                                    <select id="riwayat_jatuh" class="form-control">
                                        <option @if(old('riwayat_jatuh'))
                                                {{ old('riwayat_jatuh') == '0' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_jatuh == '0' ? 'selected' : '' }}
                                            @endif value="0">0</option>
                                        <option @if(old('riwayat_jatuh'))
                                                {{ old('riwayat_jatuh') == '25' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->riwayat_jatuh == '25' ? 'selected' : '' }}
                                            @endif value="25">25</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">Ya</div>
                                        <div class="col-md-6">: 25</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2" rowspan="2">2</td>
                                <td rowspan="2">Diagnosis Sekunder</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">Tidak</div>
                                        <div class="col-md-6">: 0</div>
                                    </div>
                                </td>
                                <td rowspan="2">
                                    <select id="diagnosis_sekunder" class="form-control">
                                        <option @if(old('diagnosis_sekunder'))
                                                {{ old('diagnosis_sekunder') == '0' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diagnosis_sekunder == '0' ? 'selected' : '' }}
                                            @endif value="0">0</option>
                                        <option @if(old('diagnosis_sekunder'))
                                                {{ old('diagnosis_sekunder') == '15' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->diagnosis_sekunder == '15' ? 'selected' : '' }}
                                            @endif value="15">15</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">Ya</div>
                                        <div class="col-md-6">: 15</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="4" class="text-center">3</td>
                                <td></td>
                                <td>Ambulasi : </td>
                                <td>-</td>
                                <td rowspan="4">
                                    <select id="ambulasi" class="form-control">
                                        <option @if(old('ambulasi'))
                                                {{ old('ambulasi') == '0' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ambulasi == '0' ? 'selected' : '' }}
                                            @endif value="0">0</option>
                                        <option @if(old('ambulasi'))
                                                {{ old('ambulasi') == '15' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ambulasi == '15' ? 'selected' : '' }}
                                            @endif value="15">15</option>
                                        <option @if(old('ambulasi'))
                                                {{ old('ambulasi') == '30' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ambulasi == '30' ? 'selected' : '' }}
                                            @endif value="30">30</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3.1</td>
                                <td>Istirahat di tempat tidur, kursi roda, bantuan perawat</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="text-center">3.2</td>
                                <td>Kruk, Tongkat, Walker</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td class="text-center">3.3</td>
                                <td>Furniture</td>
                                <td>30</td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2" rowspan="2">4</td>
                                <td rowspan="2">IV Line / Heparin Lock / Obat</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">Tidak</div>
                                        <div class="col-md-6">: 0</div>
                                    </div>
                                </td>
                                <td rowspan="2">
                                    <select id="heparin_lock" class="form-control">
                                        <option @if(old('heparin_lock'))
                                                {{ old('heparin_lock') == '0' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->heparin_lock == '0' ? 'selected' : '' }}
                                            @endif value="0">0</option>
                                        <option @if(old('heparin_lock'))
                                                {{ old('heparin_lock') == '20' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->heparin_lock == '20' ? 'selected' : '' }}
                                            @endif value="20">20</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">Ya</div>
                                        <div class="col-md-6">: 20</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="4" class="text-center">5</td>
                                <td></td>
                                <td>Gaya Berjalan : </td>
                                <td>-</td>
                                <td rowspan="4">
                                    <select id="gaya_berjalan" class="form-control">
                                        <option @if(old('gaya_berjalan'))
                                                {{ old('gaya_berjalan') == '0' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->gaya_berjalan == '0' ? 'selected' : '' }}
                                            @endif value="0">0</option>
                                        <option @if(old('gaya_berjalan'))
                                                {{ old('gaya_berjalan') == '10' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->gaya_berjalan == '10' ? 'selected' : '' }}
                                            @endif value="10">10</option>
                                        <option @if(old('gaya_berjalan'))
                                                {{ old('gaya_berjalan') == '20' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->gaya_berjalan == '20' ? 'selected' : '' }}
                                            @endif value="20">20</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5.1</td>
                                <td>Normal, Istirahat Total</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="text-center">5.2</td>
                                <td>Lemah</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td class="text-center">5.3</td>
                                <td>Gangguan</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="text-center">6</td>
                                <td></td>
                                <td>Status Mental : </td>
                                <td>-</td>
                                <td rowspan="3">
                                    <select id="status_mental" class="form-control">
                                        <option @if(old('status_mental'))
                                                {{ old('status_mental') == '0' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->status_mental == '0' ? 'selected' : '' }}
                                            @endif value="0">0</option>
                                        <option @if(old('status_mental'))
                                                {{ old('status_mental') == '15' ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->status_mental == '15' ? 'selected' : '' }}
                                            @endif value="15">15</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">6.1</td>
                                <td>Orientasi Baik</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="text-center">6.2</td>
                                <td>Keterbatasan Daya Ingat</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>Total Score</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center" rowspan="5">7</td>
                                <td></td>
                                <td>Daftar Obat</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Alkohol Anti Hipertensi</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Anti Kejang Sedative</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Diuretik Narkotik</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>Psikotropik Anti Hipertensi</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4">
                    VII. Pengkajian Fungsi : 
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul class="li_numbering">
                        <li>Kemampuan Aktifitas Sehari - hari : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('kemampuan_aktifitas'))
                                           {{ old('kemampuan_aktifitas') ==  'mandiri' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_aktifitas == 'mandiri' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="mandiri" name="radio_kemampuan_aktifitas"> Mandiri
                            </div>
                            <div class="col-md-2">
                                <input @if(old('kemampuan_aktifitas'))
                                           {{ old('kemampuan_aktifitas') ==  'bantuan_minimal' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_aktifitas == 'bantuan_minimal' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="bantuan_minimal" name="radio_kemampuan_aktifitas"> Bantuan Minimal
                            </div>
                            <div class="col-md-2">
                                <input @if(old('kemampuan_aktifitas'))
                                           {{ old('kemampuan_aktifitas') ==  'bantuan_sebagian' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_aktifitas == 'bantuan_sebagian' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="bantuan_sebagian" name="radio_kemampuan_aktifitas"> Bantuan Sebagian
                            </div>
                            <div class="col-md-3">
                                <input @if(old('kemampuan_aktifitas'))
                                           {{ old('kemampuan_aktifitas') ==  'bantuan_total' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_aktifitas == 'bantuan_total' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="bantuan_total" name="radio_kemampuan_aktifitas"> Bantuan Ketergantungan Total
                            </div>
                        </div>
                        <li>Aktivitas : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('aktivitas'))
                                           {{ old('aktivitas') ==  'Tirah Baring' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->aktivitas == 'Tirah Baring' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tirah Baring" name="radio_aktivitas"> Tirah Baring
                            </div>
                            <div class="col-md-2">
                                <input @if(old('aktivitas'))
                                           {{ old('aktivitas') ==  'Duduk' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->aktivitas == 'Duduk' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Duduk" name="radio_aktivitas"> Duduk
                            </div>
                            <div class="col-md-2">
                                <input @if(old('aktivitas'))
                                           {{ old('aktivitas') ==  'Berjalan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->aktivitas == 'Berjalan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Berjalan" name="radio_aktivitas"> Berjalan
                            </div>
                        </div>
                        <li>Berjalan : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'TAK' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'TAK' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="TAK" name="radio_berjalan"> TAK
                            </div>
                            <div class="col-md-2">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'Penurunan Kekuatan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'Penurunan Kekuatan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Penurunan Kekuatan" name="radio_berjalan"> Penurunan Kekuatan
                            </div>
                            <div class="col-md-2">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'Paralisis' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'Paralisis' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Paralisis" name="radio_berjalan"> Paralisis
                            </div>
                            <div class="col-md-2">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'Sering Jatuh' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'Sering Jatuh' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Sering Jatuh" name="radio_berjalan"> Sering Jatuh
                            </div>
                            <div class="col-md-2">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'Deformitas' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'Deformitas' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Deformitas" name="radio_berjalan"> Deformitas
                            </div>
                            <div class="col-md-2">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'Hilang Keseimbangan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'Hilang Keseimbangan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Hilang Keseimbangan" name="radio_berjalan"> Hilang Keseimbangan
                            </div>
                            <div class="col-md-4">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'Riwayat Patah Tulang' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'Riwayat Patah Tulang' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Riwayat Patah Tulang" name="radio_berjalan"> Riwayat Patah Tulang : 
                                <input type="text" readonly
                                    value="@if(old('ket_patah_tulang')){{ old('ket_patah_tulang') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_patah_tulang : '' }}@endif"
                                    id="ket_patah_tulang" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('berjalan'))
                                        {{ old('berjalan') ==  'Riwayat Patah Tulang' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->berjalan == 'Riwayat Patah Tulang' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                            <div class="col-md-4">
                                <input @if(old('berjalan'))
                                           {{ old('berjalan') ==  'lain_lain' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->berjalan == 'lain_lain' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="lain_lain" name="radio_berjalan"> Lain - lain : 
                                <input type="text" readonly
                                    value="@if(old('ket_berjalan')){{ old('ket_berjalan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_berjalan : '' }}@endif"
                                    id="ket_berjalan" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('berjalan'))
                                        {{ old('berjalan') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->berjalan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <li>Alat Ambulasi : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('alat_ambulasi'))
                                           {{ old('alat_ambulasi') ==  'Walker' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->alat_ambulasi == 'Walker' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Walker" name="radio_alat_ambulasi"> Walker
                            </div>
                            <div class="col-md-2">
                                <input @if(old('alat_ambulasi'))
                                           {{ old('alat_ambulasi') ==  'Tongkat' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->alat_ambulasi == 'Tongkat' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tongkat" name="radio_alat_ambulasi"> Tongkat
                            </div>
                            <div class="col-md-2">
                                <input @if(old('alat_ambulasi'))
                                           {{ old('alat_ambulasi') ==  'Kursi Roda' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->alat_ambulasi == 'Kursi Roda' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Kursi Roda" name="radio_alat_ambulasi"> Kursi Roda
                            </div>
                            <div class="col-md-3">
                                <input @if(old('alat_ambulasi'))
                                           {{ old('alat_ambulasi') ==  'Tidak Menggunakan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->alat_ambulasi == 'Tidak Menggunakan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak Menggunakan" name="radio_alat_ambulasi"> Tidak Menggunakan
                            </div>
                        </div>
                        <li>Ekstremitas Atas : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('ekstremitas_atas'))
                                           {{ old('ekstremitas_atas') ==  'Tidak Ada Kesulitan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ekstremitas_atas == 'Tidak Ada Kesulitan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak Ada Kesulitan" name="radio_ekstremitas_atas"> Tidak Ada Kesulitan
                            </div>
                            <div class="col-md-2">
                                <input @if(old('ekstremitas_atas'))
                                           {{ old('ekstremitas_atas') ==  'Lemah' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ekstremitas_atas == 'Lemah' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Lemah" name="radio_ekstremitas_atas"> Lemah
                            </div>
                        </div>
                        <li>Ekstremitas Bawah : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('ekstremitas_bawah'))
                                           {{ old('ekstremitas_bawah') ==  'TAK' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ekstremitas_bawah == 'TAK' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="TAK" name="radio_ekstremitas_bawah"> TAK
                            </div>
                            <div class="col-md-2">
                                <input @if(old('ekstremitas_bawah'))
                                           {{ old('ekstremitas_bawah') ==  'Varises' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ekstremitas_bawah == 'Varises' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Varises" name="radio_ekstremitas_bawah"> Varises
                            </div>
                            <div class="col-md-4">
                                <input @if(old('ekstremitas_bawah'))
                                           {{ old('ekstremitas_bawah') ==  'Edema' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ekstremitas_bawah == 'Edema' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Edema" name="radio_ekstremitas_bawah"> Edema
                                <input type="text" readonly
                                    value="@if(old('ket_edema')){{ old('ket_edema') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_edema : '' }}@endif"
                                    id="ket_edema" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('ekstremitas_bawah'))
                                        {{ old('ekstremitas_bawah') ==  'Edema' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->ekstremitas_bawah == 'Edema' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('ekstremitas_bawah'))
                                           {{ old('ekstremitas_bawah') ==  'Tidak Simetris' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ekstremitas_bawah == 'Tidak Simetris' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak Simetris" name="radio_ekstremitas_bawah"> Tidak Simetris
                            </div>
                            <div class="col-md-4">
                                <input @if(old('ekstremitas_bawah'))
                                           {{ old('ekstremitas_bawah') ==  'lain_lain' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->ekstremitas_bawah == 'lain_lain' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="lain_lain" name="radio_ekstremitas_bawah"> Lain - lain
                                <input type="text" readonly
                                    value="@if(old('ket_ekstremitas_bawah')){{ old('ket_ekstremitas_bawah') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_ekstremitas_bawah : '' }}@endif"
                                    id="ket_ekstremitas_bawah" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('ekstremitas_bawah'))
                                        {{ old('ekstremitas_bawah') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->ekstremitas_bawah == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <li>Kemampuan Menggenggam : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('kemampuan_menggenggam'))
                                           {{ old('kemampuan_menggenggam') ==  'Tidak Ada Kesulitan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_menggenggam == 'Tidak Ada Kesulitan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak Ada Kesulitan" name="radio_kemampuan_menggenggam"> Tidak Ada Kesulitan
                            </div>
                            <div class="col-md-2">
                                <input @if(old('kemampuan_menggenggam'))
                                           {{ old('kemampuan_menggenggam') ==  'Terakhir' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_menggenggam == 'Terakhir' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Terakhir" name="radio_kemampuan_menggenggam"> Terakhir
                            </div>
                            <div class="col-md-4">
                                <input @if(old('kemampuan_menggenggam'))
                                           {{ old('kemampuan_menggenggam') ==  'lain_lain' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_menggenggam == 'lain_lain' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="lain_lain" name="radio_kemampuan_menggenggam"> Lain - lain
                                <input type="text" readonly
                                    value="@if(old('ket_edema')){{ old('ket_edema') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_edema : '' }}@endif"
                                    id="ket_edema" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('kemampuan_menggenggam'))
                                        {{ old('kemampuan_menggenggam') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kemampuan_menggenggam == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <li>Kemampuan Koordinasi : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('kemampuan_koordinasi'))
                                           {{ old('kemampuan_koordinasi') ==  'Tidak Ada Kelainan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_koordinasi == 'Tidak Ada Kelainan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak Ada Kelainan" name="radio_kemampuan_koordinasi"> Tidak Ada Kelainan
                            </div>
                            <div class="col-md-4">
                                <input @if(old('kemampuan_koordinasi'))
                                           {{ old('kemampuan_koordinasi') ==  'Ada Masalah' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_koordinasi == 'Ada Masalah' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ada Masalah" name="radio_kemampuan_koordinasi"> Ada Masalah :
                                <input type="text" readonly
                                    value="@if(old('ket_kemampuan_koordinasi')){{ old('ket_kemampuan_koordinasi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_kemampuan_koordinasi : '' }}@endif"
                                    id="ket_kemampuan_koordinasi" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('kemampuan_koordinasi'))
                                        {{ old('kemampuan_koordinasi') ==  'Ada Masalah' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kemampuan_koordinasi == 'Ada Masalah' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <li>Kemampuan Gangguan Fungsi : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('kemampuan_gangguan_fungsi'))
                                           {{ old('kemampuan_gangguan_fungsi') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_gangguan_fungsi == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_kemampuan_gangguan_fungsi"> Ya (Konsul DPJP)
                            </div>
                            <div class="col-md-2">
                                <input @if(old('kemampuan_gangguan_fungsi'))
                                           {{ old('kemampuan_gangguan_fungsi') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kemampuan_gangguan_fungsi == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_kemampuan_gangguan_fungsi"> Tidak (Tidak Perlu Konsul DPJP)
                            </div>
                        </div>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4">
                    VIII. Kebutuhan Komunikasi / Pendidikan dan Pengajar : 
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul class="li_numbering">
                        <div class="row">
                            <div class="col-md-2">
                                <li>Bicara <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('pendidikan_bicara'))
                                           {{ old('pendidikan_bicara') ==  'Normal' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_bicara == 'Normal' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Normal" name="radio_pendidikan_bicara"> Normal
                            </div>
                            <div class="col-md-4">
                                <input @if(old('pendidikan_bicara'))
                                           {{ old('pendidikan_bicara') ==  'Gangguan Bicara' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_bicara == 'Gangguan Bicara' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Gangguan Bicara" name="radio_pendidikan_bicara"> Gangguan Bicara Sejak
                                <input type="text" readonly
                                    value="@if(old('ket_gangguan_bicara')){{ old('ket_gangguan_bicara') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_gangguan_bicara : '' }}@endif"
                                    id="ket_gangguan_bicara" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('pendidikan_bicara'))
                                        {{ old('pendidikan_bicara') ==  'Gangguan Bicara' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pendidikan_bicara == 'Gangguan Bicara' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Bahasa Sehari - hari <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('pendidikan_bahasa'))
                                           {{ old('pendidikan_bahasa') ==  'Indonesia' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_bahasa == 'Indonesia' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Indonesia" name="radio_pendidikan_bahasa"> Indonesia
                            </div>
                            <div class="col-md-3">
                                <input @if(old('pendidikan_bahasa'))
                                           {{ old('pendidikan_bahasa') ==  'Daerah' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_bahasa == 'Daerah' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Daerah" name="radio_pendidikan_bahasa"> Daerah
                                <input type="text" readonly
                                    value="@if(old('ket_bahasa_daerah')){{ old('ket_bahasa_daerah') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bahasa_daerah : '' }}@endif"
                                    id="ket_bahasa_daerah" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('pendidikan_bahasa'))
                                        {{ old('pendidikan_bahasa') ==  'Daerah' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pendidikan_bahasa == 'Daerah' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('pendidikan_bahasa'))
                                           {{ old('pendidikan_bahasa') ==  'Inggris' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_bahasa == 'Inggris' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Inggris" name="radio_pendidikan_bahasa"> Inggris Aktif/Pasif
                            </div>
                            <div class="col-md-2">
                                <input @if(old('pendidikan_bahasa'))
                                           {{ old('pendidikan_bahasa') ==  'lain_lain' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendidikan_bahasa == 'lain_lain' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="lain_lain" name="radio_pendidikan_bahasa">
                                <input type="text" readonly
                                    value="@if(old('ket_pendidikan_bahasa')){{ old('ket_pendidikan_bahasa') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_pendidikan_bahasa : '' }}@endif"
                                    id="ket_pendidikan_bahasa" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('pendidikan_bahasa'))
                                        {{ old('pendidikan_bahasa') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->pendidikan_bahasa == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Penerjemah <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('penerjemah'))
                                           {{ old('penerjemah') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penerjemah == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_penerjemah"> Tidak
                            </div>
                            <div class="col-md-3">
                                <input @if(old('penerjemah'))
                                           {{ old('penerjemah') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penerjemah == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_penerjemah"> Ya, Bahasa
                                <input type="text" readonly
                                    value="@if(old('ket_bahasa_penerjemah')){{ old('ket_bahasa_penerjemah') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bahasa_penerjemah : '' }}@endif"
                                    id="ket_bahasa_penerjemah" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('penerjemah'))
                                        {{ old('penerjemah') ==  'Ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->penerjemah == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                            <div class="col-md-2">
                                Bahasa Isyarat : 
                                <input @if(old('bahasa_isyarat'))
                                           {{ old('bahasa_isyarat') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bahasa_isyarat == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_bahasa_isyarat"> Ya
                            </div>
                            <div class="col-md-2">
                                <input @if(old('bahasa_isyarat'))
                                           {{ old('bahasa_isyarat') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bahasa_isyarat == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_bahasa_isyarat"> Tidak
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Hambatan Belajar <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('hambatan_belajar'))
                                           {{ old('hambatan_belajar') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->hambatan_belajar == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_hambatan_belajar"> Tidak
                            </div>
                            <div class="col-md-2">
                                <input @if(old('hambatan_belajar'))
                                           {{ old('hambatan_belajar') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->hambatan_belajar == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_hambatan_belajar"> Ya : 
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Bahasa' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Bahasa' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Bahasa" name="radio_detail_hambatan_belajar"> Bahasa
                            </div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Cemas' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Cemas' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Cemas" name="radio_detail_hambatan_belajar"> Cemas
                            </div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Kognitif' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Kognitif' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Kognitif" name="radio_detail_hambatan_belajar"> Kognitif
                            </div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Pendengaran' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Pendengaran' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Pendengaran" name="radio_detail_hambatan_belajar"> Pendengaran
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Emosi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Emosi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Emosi" name="radio_detail_hambatan_belajar"> Emosi
                            </div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Hilang Memory' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Hilang Memory' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Hilang Memory" name="radio_detail_hambatan_belajar"> Hilang Memory
                            </div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Motivasi Buruk' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Motivasi Buruk' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Motivasi Buruk" name="radio_detail_hambatan_belajar"> Motivasi Buruk
                            </div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Masalah Penglihatan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Masalah Penglihatan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Masalah Penglihatan" name="radio_detail_hambatan_belajar"> Masalah Penglihatan
                            </div>
                            <div class="col-md-2">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'Kesulitan Bicara' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'Kesulitan Bicara' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Kesulitan Bicara" name="radio_detail_hambatan_belajar"> Kesulitan Bicara
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <input @if(old('detail_hambatan_belajar'))
                                           {{ old('detail_hambatan_belajar') ==  'lain_lain' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->detail_hambatan_belajar == 'lain_lain' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="lain_lain" name="radio_detail_hambatan_belajar"> Lain - lain
                                <input type="text" readonly
                                    value="@if(old('ket_detail_hambatan_belajar')){{ old('ket_detail_hambatan_belajar') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_detail_hambatan_belajar : '' }}@endif"
                                    id="ket_detail_hambatan_belajar" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('detail_hambatan_belajar'))
                                        {{ old('detail_hambatan_belajar') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->detail_hambatan_belajar == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Cara Belajar yang disukai <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('cara_belajar'))
                                           {{ old('cara_belajar') ==  'Menulis' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_belajar == 'Menulis' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Menulis" name="radio_cara_belajar"> Menulis
                            </div>
                            <div class="col-md-2">
                                <input @if(old('cara_belajar'))
                                           {{ old('cara_belajar') ==  'Diskusi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_belajar == 'Diskusi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Diskusi" name="radio_cara_belajar"> Diskusi
                            </div>
                            <div class="col-md-2">
                                <input @if(old('cara_belajar'))
                                           {{ old('cara_belajar') ==  'Mendengar' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_belajar == 'Mendengar' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Mendengar" name="radio_cara_belajar"> Mendengar
                            </div>
                            <div class="col-md-2">
                                <input @if(old('cara_belajar'))
                                           {{ old('cara_belajar') ==  'Demonstrasi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_belajar == 'Demonstrasi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Demonstrasi" name="radio_cara_belajar"> Demonstrasi
                            </div>
                            <div class="col-md-2">
                                <input @if(old('cara_belajar'))
                                           {{ old('cara_belajar') ==  'Membaca' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_belajar == 'Membaca' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Membaca" name="radio_cara_belajar"> Membaca
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <input @if(old('cara_belajar'))
                                           {{ old('cara_belajar') ==  'Audio' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_belajar == 'Audio' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Audio" name="radio_cara_belajar"> Audio/Visual
                            </div>
                        </div>
                        <li>Pasien atau Keluarga Menginginkan Informasi Tentang : </li>
                        <div class="row">
                            <div class="col-md-2">
                                <input @if(old('informasi_tentang'))
                                           {{ old('informasi_tentang') ==  'Proses Penyakit' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->informasi_tentang == 'Proses Penyakit' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Proses Penyakit" name="radio_informasi_tentang"> Proses Penyakit
                            </div>
                            <div class="col-md-2">
                                <input @if(old('informasi_tentang'))
                                           {{ old('informasi_tentang') ==  'Terapi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->informasi_tentang == 'Terapi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Terapi" name="radio_informasi_tentang"> Terapi/Obat
                            </div>
                            <div class="col-md-2">
                                <input @if(old('informasi_tentang'))
                                           {{ old('informasi_tentang') ==  'Nutrisi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->informasi_tentang == 'Nutrisi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Nutrisi" name="radio_informasi_tentang"> Nutrisi
                            </div>
                            <div class="col-md-2">
                                <input @if(old('informasi_tentang'))
                                           {{ old('informasi_tentang') ==  'Penggunaan Alat Medis' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->informasi_tentang == 'Penggunaan Alat Medis' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Penggunaan Alat Medis" name="radio_informasi_tentang"> Penggunaan Alat Medis
                            </div>
                            <div class="col-md-2">
                                <input @if(old('informasi_tentang'))
                                           {{ old('informasi_tentang') ==  'Tindakan' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->informasi_tentang == 'Tindakan' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tindakan" name="radio_informasi_tentang"> Tindakan
                            </div>
                            <div class="col-md-2">
                                <input @if(old('informasi_tentang'))
                                           {{ old('informasi_tentang') ==  'lain_lain' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->informasi_tentang == 'lain_lain' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="lain_lain" name="radio_informasi_tentang">
                                <input type="text" readonly
                                    value="@if(old('ket_informasi_tentang')){{ old('ket_informasi_tentang') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_informasi_tentang : '' }}@endif"
                                    id="ket_informasi_tentang" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('informasi_tentang'))
                                        {{ old('informasi_tentang') ==  'lain_lain' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->informasi_tentang == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4">
                    IX. Kebutuhan Privasi Pasien : 
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 20px">
                    <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien ? in_array('tempat_khusus',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien )) ? 'checked' : '' : '' }}
                            @endif id="tempat_khusus"> Keinginan Waktu / Tempat Khusus Saat Wawancara dan Tindakan 
                    <input type="text" readonly
                            value="@if(old('ket_tempat_khusus')){{ old('ket_tempat_khusus') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_tempat_khusus : '' }}@endif"
                            id="ket_tempat_khusus" style="border: 0; border-bottom: 2px dotted; width: 50%"
                            @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien ? in_array('tempat_khusus',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien )) ? '' : 'readonly' : '' }}
                            @endif>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 20px">
                    <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien ? in_array('privasi_pengobatan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien )) ? 'checked' : '' : '' }}
                            @endif id="privasi_pengobatan"> Pengobatan
                    <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien ? in_array('privasi_terapi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien )) ? 'checked' : '' : '' }}
                            @endif id="privasi_terapi" class="ml-4"> Terapi / Obat
                    <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien ? in_array('privasi_transportasi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien )) ? 'checked' : '' : '' }}
                            @endif id="privasi_transportasi" class="ml-4"> Transportasi
                    <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien ? in_array('privasi_lain_lain',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien )) ? 'checked' : '' : '' }}
                            @endif id="privasi_lain_lain" class="ml-4"> Lain - lain
                    <input type="text" readonly
                            value="@if(old('ket_privasi_lain_lain')){{ old('ket_privasi_lain_lain') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_privasi_lain_lain : '' }}@endif"
                            id="ket_privasi_lain_lain" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien ? in_array('privasi_lain_lain',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kebutuhan_privasi_pasien )) ? '' : 'readonly' : '' }}
                            @endif>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4" style="text-align: center; border: 1px solid">
                    <b>SKRINING GIZI OLEH PERAWAT</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul class="li_numbering">
                        <div class="row">
                            <div class="col-md-3">
                                <li>Penurunan Nafsu Makan <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('penurunan_nafsu_makan'))
                                           {{ old('penurunan_nafsu_makan') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_nafsu_makan == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_penurunan_nafsu_makan"> Tidak (0)
                            </div>
                            <div class="col-md-2">
                                <input @if(old('penurunan_nafsu_makan'))
                                           {{ old('penurunan_nafsu_makan') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_nafsu_makan == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_penurunan_nafsu_makan"> Ya (1)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <li>Penurunan BB 6 Bulan Terakhir > 10% <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input @if(old('penurunan_bb'))
                                           {{ old('penurunan_bb') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_bb == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_penurunan_bb"> Tidak (0)
                            </div>
                            <div class="col-md-2">
                                <input @if(old('penurunan_bb'))
                                           {{ old('penurunan_bb') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_bb == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_penurunan_bb"> Ya (1)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <li>Penyakit / kelainan yang menyertai pasien jika ada salah satu atau lebih scoringnya (2) : </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('diabetes_militus',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="diabetes_militus"> Diabetes Militus
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('obesitas',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="obesitas"> Obesitas
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('penyakit_jantung',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="penyakit_jantung"> Penyakit Jantung
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('kanker',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="kanker"> Kanker
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('penyakit_paru_kronis',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="penyakit_paru_kronis"> Penyakit Paru Kronis
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('hipertensi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="hipertensi"> Hipertensi ( > 170 / 100 mmHg )
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('gangguan_fungsi_hati',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="gangguan_fungsi_hati"> Gangguan Fungsi Hati
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('gangguan_fungsi_ginjal',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="gangguan_fungsi_ginjal"> Gangguan Fungsi Ginjal
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('diare_mall_aborsi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="diare_mall_aborsi"> Diare/Mall Aborsi
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('hiperkalemmi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="hiperkalemmi"> Hiperkalemi
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien ? in_array('hiperlipidemia',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->kelainan_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="hiperlipidemia"> Hiperlipidemia
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                Total Score
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                Jika < 2 <span style="float: right">:</span>
                            </div>
                            <div class="col-md-11">
                                Diet yang diberikan :
                                <input @if(old('diet_diberikan'))
                                           {{ old('diet_diberikan') ==  'Biasa' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->diet_diberikan == 'Biasa' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Biasa" name="diet_diberikan"> Biasa
                                <input @if(old('diet_diberikan'))
                                           {{ old('diet_diberikan') ==  'Tim' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->diet_diberikan == 'Tim' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tim" name="diet_diberikan" class="ml-4"> Tim
                                <input @if(old('diet_diberikan'))
                                           {{ old('diet_diberikan') ==  'Lunak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->diet_diberikan == 'Lunak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Lunak" name="diet_diberikan" class="ml-4"> Lunak
                                <input @if(old('diet_diberikan'))
                                           {{ old('diet_diberikan') ==  'Saring / Bubur Susu' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->diet_diberikan == 'Saring / Bubur Susu' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Saring / Bubur Susu" name="diet_diberikan" class="ml-4"> Saring / Bubur Susu
                                <input @if(old('diet_diberikan'))
                                           {{ old('diet_diberikan') ==  'Cair' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->diet_diberikan == 'Cair' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Cair" name="diet_diberikan" class="ml-4"> Cair
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                Jika > 2 <span style="float: right">:</span>
                            </div>
                            <div class="col-md-11">
                                <input @if(old('lebih_dari_dua'))
                                           {{ old('lebih_dari_dua') ==  'Lapor DPJP' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->lebih_dari_dua == 'Lapor DPJP' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Lapor DPJP" name="lebih_dari_dua"> Lapor DPJP
                                <input @if(old('lebih_dari_dua'))
                                           {{ old('lebih_dari_dua') ==  'Asesmen Lanjutan Oleh Ahli Gizi' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->lebih_dari_dua == 'Asesmen Lanjutan Oleh Ahli Gizi' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Asesmen Lanjutan Oleh Ahli Gizi" name="lebih_dari_dua" class="ml-4"> Asesmen Lanjutan Oleh Ahli Gizi
                            </div>
                        </div>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border: 1px solid; padding-left: 20px; padding-right: 20px">
                    Daftar Masalah Keperawatan :
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('nyeri_keperawatan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="nyeri_keperawatan"> Nyeri
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('keselamatan_pasien',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="keselamatan_pasien"> Keselamatan Pasien
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('tumbuh_kembang',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="tumbuh_kembang"> Tumbuh Kembang
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('pola_tidur',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="pola_tidur"> Pola Tidur
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('nutrisi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="nutrisi"> Nutrisi
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('suhu_tubuh',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="suhu_tubuh"> Suhu Tubuh
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('mobilitas_keperawatan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="mobilitas_keperawatan"> Mobilitas / Aktifitas
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('eliminasi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="eliminasi"> Eliminasi
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('perfusi_jaringan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="perfusi_jaringan"> Perfusi Jaringan
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('integritas_kulit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="integritas_kulit"> Integritas Kulit
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('pengetahuan_komunikasi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="pengetahuan_komunikasi"> Pengetahuan / Komunikasi
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('konflik_peran',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="konflik_peran"> Konflik Peran
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('perawatan_diri',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="perawatan_diri"> Perawatan Diri
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('keseimbangan_cairan_elektrolit',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="keseimbangan_cairan_elektrolit"> Keseimbangan Cairan dan Elektrolit
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('jalan_nafas',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="jalan_nafas"> Jalan Nafas / Pertukaran Gas
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('infeksi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="infeksi"> Infeksi
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('pola_nafas',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="pola_nafas"> Pola Nafas
                        </div>
                        <div class="col-md-8">
                            <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('masalah_keperawatan_lain_lain',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? 'checked' : '' : '' }}
                                @endif id="masalah_keperawatan_lain_lain"> Lain - lain
                            <input type="text" readonly
                                value="@if(old('ket_masalah_keperawatan')){{ old('ket_masalah_keperawatan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_masalah_keperawatan : '' }}@endif"
                                id="ket_masalah_keperawatan" style="border: 0; border-bottom: 2px dotted; width: 50%"
                                @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                    {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan ? in_array('masalah_keperawatan_lain_lain',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->masalah_keperawatan )) ? '' : 'readonly' : '' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>Rencana Keperawatan</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul class="li_numbering">
                        <li>
                            <input type="text" class="form-control"
                                value="@if(old('rencana_keperawatan_satu')){{ old('rencana_keperawatan_satu') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rencana_keperawatan_satu : '' }}@endif"
                                id="rencana_keperawatan_satu">
                        </li>
                        <li>
                            <input type="text" class="form-control"
                                value="@if(old('rencana_keperawatan_dua')){{ old('rencana_keperawatan_dua') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rencana_keperawatan_dua : '' }}@endif"
                                id="rencana_keperawatan_dua">
                        </li>
                        <li>
                            <input type="text" class="form-control"
                                value="@if(old('rencana_keperawatan_tiga')){{ old('rencana_keperawatan_tiga') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rencana_keperawatan_tiga : '' }}@endif"
                                id="rencana_keperawatan_tiga">
                        </li>
                        <li>
                            <input type="text" class="form-control"
                                value="@if(old('rencana_keperawatan_empat')){{ old('rencana_keperawatan_empat') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rencana_keperawatan_empat : '' }}@endif"
                                id="rencana_keperawatan_empat">
                        </li>
                        <li>
                            <input type="text" class="form-control"
                                value="@if(old('rencana_keperawatan_lima')){{ old('rencana_keperawatan_lima') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rencana_keperawatan_lima : '' }}@endif"
                                id="rencana_keperawatan_lima">
                        </li>
                        <li>
                            <input type="text" class="form-control"
                                value="@if(old('rencana_keperawatan_enam')){{ old('rencana_keperawatan_enam') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rencana_keperawatan_enam : '' }}@endif"
                                id="rencana_keperawatan_enam">
                        </li>
                        <li>
                            <input type="text" class="form-control"
                                value="@if(old('rencana_keperawatan_tujuh')){{ old('rencana_keperawatan_tujuh') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->rencana_keperawatan_tujuh : '' }}@endif"
                                id="rencana_keperawatan_tujuh">
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>Perencanaan Perawatan Interdisiplin/Referal</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul class="li_numbering">
                        <div class="row">
                            <div class="col-md-2">
                                <li>Diet dan Nutrisi <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input @if(old('diet_nutrisi'))
                                           {{ old('diet_nutrisi') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->diet_nutrisi == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_diet_nutrisi"> Tidak
                                <input @if(old('diet_nutrisi'))
                                           {{ old('diet_nutrisi') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->diet_nutrisi == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_diet_nutrisi" class="ml-4"> Ya : 
                                <input type="text" readonly
                                    value="@if(old('ket_bahasa_diet_nutrisi')){{ old('ket_bahasa_diet_nutrisi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bahasa_diet_nutrisi : '' }}@endif"
                                    id="ket_bahasa_diet_nutrisi" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('diet_nutrisi'))
                                        {{ old('diet_nutrisi') ==  'Ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->diet_nutrisi == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Rehabilitas Medik <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input @if(old('rehab_medik'))
                                           {{ old('rehab_medik') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->rehab_medik == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_rehab_medik"> Tidak
                                <input @if(old('rehab_medik'))
                                           {{ old('rehab_medik') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->rehab_medik == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_rehab_medik" class="ml-4"> Ya : 
                                <input type="text" readonly
                                    value="@if(old('ket_bahasa_rehab_medik')){{ old('ket_bahasa_rehab_medik') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bahasa_rehab_medik : '' }}@endif"
                                    id="ket_bahasa_rehab_medik" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('rehab_medik'))
                                        {{ old('rehab_medik') ==  'Ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->rehab_medik == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Farmasi <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input @if(old('farmasi'))
                                           {{ old('farmasi') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->farmasi == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_farmasi"> Tidak
                                <input @if(old('farmasi'))
                                           {{ old('farmasi') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->farmasi == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_farmasi" class="ml-4"> Ya : 
                                <input type="text" readonly
                                    value="@if(old('ket_bahasa_farmasi')){{ old('ket_bahasa_farmasi') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bahasa_farmasi : '' }}@endif"
                                    id="ket_bahasa_farmasi" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('farmasi'))
                                        {{ old('farmasi') ==  'Ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->farmasi == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Perawatan Luka <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input @if(old('perawatan_luka'))
                                           {{ old('perawatan_luka') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perawatan_luka == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_perawatan_luka"> Tidak
                                <input @if(old('perawatan_luka'))
                                           {{ old('perawatan_luka') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perawatan_luka == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_perawatan_luka" class="ml-4"> Ya : 
                                <input type="text" readonly
                                    value="@if(old('ket_bahasa_perawatan_luka')){{ old('ket_bahasa_perawatan_luka') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bahasa_perawatan_luka : '' }}@endif"
                                    id="ket_bahasa_perawatan_luka" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('perawatan_luka'))
                                        {{ old('perawatan_luka') ==  'Ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_luka == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Manajemen Nyeri <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input @if(old('manajemen_nyeri'))
                                           {{ old('manajemen_nyeri') ==  'Tidak' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->manajemen_nyeri == 'Tidak' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Tidak" name="radio_manajemen_nyeri"> Tidak
                                <input @if(old('manajemen_nyeri'))
                                           {{ old('manajemen_nyeri') ==  'Ya' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->manajemen_nyeri == 'Ya' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="Ya" name="radio_manajemen_nyeri" class="ml-4"> Ya : 
                                <input type="text" readonly
                                    value="@if(old('ket_bahasa_manajemen_nyeri')){{ old('ket_bahasa_manajemen_nyeri') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_bahasa_manajemen_nyeri : '' }}@endif"
                                    id="ket_bahasa_manajemen_nyeri" style="border: 0; border-bottom: 2px dotted;"
                                    @if(old('manajemen_nyeri'))
                                        {{ old('manajemen_nyeri') ==  'Ya' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? ($dokumen->dokumen_asesment_awal_medis_gawat_darurat->manajemen_nyeri == 'Ya' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Lain - lain <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input type="text"
                                    value="@if(old('perencanaan_perawatan_lain_lain')){{ old('perencanaan_perawatan_lain_lain') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perencanaan_perawatan_lain_lain : '' }}@endif"
                                    id="perencanaan_perawatan_lain_lain" style="border: 0; border-bottom: 2px dotted; width: 80%">
                            </div>
                        </div>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>PERENCANAAN PULANG (Discharge Planning)</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Pasien dan keluarga diberikan informasi tentang perencanaan pulang ? 
                    <input @if(old('info_perencanaan_pulang'))
                                {{ old('info_perencanaan_pulang') ==  'Tidak' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->info_perencanaan_pulang == 'Tidak' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="Tidak" name="radio_info_perencanaan_pulang"> Tidak
                    <input @if(old('info_perencanaan_pulang'))
                                {{ old('info_perencanaan_pulang') ==  'Ya' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->info_perencanaan_pulang == 'Ya' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="Ya" name="radio_info_perencanaan_pulang" class="ml-4"> Ya : 
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul class="li_numbering">
                        <div class="row">
                            <div class="col-md-2">
                                <li>Kondisi klinis saat pulang <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input type="text" style="border: 0; border-bottom: 2px dotted; width: 100%"
                                    value="@if(old('kondisi_pulang')){{ old('kondisi_pulang') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->kondisi_pulang : '' }}@endif"
                                    id="kondisi_pulang">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Lama Perawatan rata - rata <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input type="text" style="border: 0; border-bottom: 2px dotted; "
                                    value="@if(old('lama_perawatan')){{ old('lama_perawatan') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->lama_perawatan : '' }}@endif"
                                    id="lama_perawatan"> hari
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Tanggal Perencanaan Pulang <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-10">
                                <input type="text" style="border: 0; border-bottom: 2px dotted; width: 100%"
                                    value="@if(old('tgl_rencana_pulang')){{ old('tgl_rencana_pulang') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_rencana_pulang : '' }}@endif"
                                    id="tgl_rencana_pulang">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <li>Perawatan lanjutan yang diberikan dirumah : </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('perawatan_diri',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="perawatan_diri"> Perawatan diri (Mandiri, BAB/BAK)
                            </div>
                            <div class="col-md-4">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('aktifitas_sehari_hari',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="aktifitas_sehari_hari"> Aktifitas sehari - hari (makan, berjalan)
                            </div>
                            <div class="col-md-4">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('perawatan_luka',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="perawatan_luka"> Perawatan Luka
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('pemberian_minum',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="pemberian_minum"> Pemberian minum/makan melalui AGT
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('perawatan_bayi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="perawatan_bayi"> Perawatan Bayi
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('diet_nutrisi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="diet_nutrisi"> Diet/Nutrisi
                            </div>
                            <div class="col-md-4">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('pemberian_obat',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="pemberian_obat"> Pemberian Obat
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('perawatan_payudara',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="perawatan_payudara"> Perawatan Payudara
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('home_care',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="home_care"> Home Care
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('latihan_gerak',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="latihan_gerak"> Latihan Gerak / Exercise
                            </div>
                            <div class="col-md-4">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan ? in_array('lain_lain',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->perawatan_lanjutan )) ? 'checked' : '' : '' }}
                                    @endif id="lain_lain"> Lain - lain : 
                                <input type="text"
                                    value="@if(old('ket_perencanaan_pulang')){{ old('ket_perencanaan_pulang') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_perencanaan_pulang : '' }}@endif"
                                    id="ket_perencanaan_pulang" style="border: 0; border-bottom: 2px dotted;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Cara Transportasi Pulang <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang ? in_array('transportasi_mandiri',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="transportasi_mandiri"> Mandiri
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang ? in_array('transportasi_dibantu_sebagian',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="transportasi_dibantu_sebagian"> Dibantu Sebagian
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang ? in_array('transportasi_dibantu_keseluruhan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="transportasi_dibantu_keseluruhan"> Dibantu Keseluruhan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <span style="float: right">:</span>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang ? in_array('transportasi_menggunakan_rostul',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="transportasi_menggunakan_rostul"> Menggunakan Rostul
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang ? in_array('transportasi_menggunakan_brangkar',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="transportasi_menggunakan_brangkar"> Menggunakan Brangkar
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang ? in_array('transportasi_berjalan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="transportasi_berjalan"> Berjalan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Transportasi yang digunakan <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_digunakan_pulang ? in_array('kendaraan_pribadi',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_digunakan_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="kendaraan_pribadi"> Kendaraan Pribadi (Mobil, Motor)
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_digunakan_pulang ? in_array('ambulan',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_digunakan_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="ambulan"> Ambulan
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_digunakan_pulang ? in_array('kendaraan_umum',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->transportasi_digunakan_pulang )) ? 'checked' : '' : '' }}
                                    @endif id="kendaraan_umum"> Kendaraan Umum
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <li>Barang - barang Milik Pasien <span style="float: right">:</span></li>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->barang_milik_pasien ? in_array('lengkap',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->barang_milik_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="lengkap"> Lengkap
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_medis_gawat_darurat))
                                        {{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat->barang_milik_pasien ? in_array('tidak_lengkap',json_decode($dokumen->dokumen_asesment_awal_medis_gawat_darurat->barang_milik_pasien )) ? 'checked' : '' : '' }}
                                    @endif id="tidak_lengkap"> Tidak Lengkap
                                <input type="text"
                                    value="@if(old('ket_barang_tidak_lengkap')){{ old('ket_barang_tidak_lengkap') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->ket_barang_tidak_lengkap : '' }}@endif"
                                    id="ket_barang_tidak_lengkap" style="border: 0; border-bottom: 2px dotted;">
                            </div>
                        </div>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row pt-2" style="width:100%; margin-left:0">
    <div class="col-md-6 text-left">
        <span></span>Jam Selesai Pengkajian
        <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_pengkajian"
            value="@if(old('jam_pengkajian')){{ old('jam_pengkajian') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->jam_pengkajian : '' }}@endif">
        WIB
    </div>
    <div class="col-md-6 text-right">
        CIBARUSAH, 
        <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_pengkajian"
            value="@if(old('tgl_pengkajian')){{ old('tgl_pengkajian') }}@else{{ $dokumen->dokumen_asesment_awal_medis_gawat_darurat ? $dokumen->dokumen_asesment_awal_medis_gawat_darurat->tgl_pengkajian : '' }}@endif">
    </div>
</div>
<div class="row pt-5" style="width:100%; margin-left:0">
    <div class="col-md-4"></div>
    <div class="col-md-4" onclick="open_modal_pasien()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Perawat</h5>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <button onclick="submit_form()" class="btn btn-success">Simpan</button>
    </div>
</div>
<div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/rekam_medis/pdf_dokumen_asesment_awal_medis_gawat_darurat?dokumen='.$dokumen->id) }}"
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
            <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/rekam_medis/save_ttd_dokumen_kunjungan') }}">
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
                <input type="hidden" name="kode_icd_tindakan" id="kode_icd_tindakan"/>
                <input type="hidden" name="noreg" value="{{ $layanan->id }}"/>
                <input type="hidden" name="dokumen" value="{{ $dokumen->id }}"/>
                <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}" id="id_dokter"/>
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
                    <table class="table" id="tabel_dokter_e_resep">
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
                                    <td>{{ $layanan->perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td>Asuransi</td>
                                    <td> :</td>
                                    <td>{{ $layanan->asuransi == 0 ? '' : $layanan->asuransi }}</td>
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
                                <input class="form-control" name="asuransi" id="e_resep_asuransi" type="text"
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
                                <input class="form-control" name="perusahaan" id="e_resep_perusahaan"
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
                                <input class="form-control" name="asuransi" id="edit_resep_asuransi"
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
                                <input class="form-control" name="perusahaan" id="edit_resep_perusahaan"
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

{{--Lab--}}
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
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">No. Reg</label>
                        <input type="text" class="form-control" name="noreg" value="{{ $layanan->id }}"
                               readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pasien</label>
                        <input type="text" name="nama_pasien" value="{{ $layanan->nama_pasien }}"
                               class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">NRM</label>
                        <input type="text" name="nrm" value="{{ $layanan->nrm }}" readonly
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">L/P</label>
                        <select name="kelamin" disabled class="form-control">
                            <option value="1" @if ($layanan->kelamin == 1)
                                {{ 'selected' }}
                                @endif>
                                Perempuan
                            </option>
                            <option value="0" @if ($layanan->kelamin == 0)
                                {{ 'selected' }}
                                @endif>
                                Laki-Laki
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Umur</label>
                        <input type="text" readonly value="{{ $layanan->umur }}" name="umur"
                               class="form-control">
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Alamat</label> --}}
                    <input name="alamat" type="hidden" class="form-control" value="{{ $layanan->alamat }}">
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
                                @if ($layanan->last_ruangan == $ru->slug)
                                    {{ 'selected' }}
                                    @endif>
                                    {{ $ru->nama }}
                                </option>
                            @endforeach
                            <option value="pendaftaran"
                            @if ($layanan->last_ruangan == 'pendaftaran')
                                {{ 'selected' }}
                                @endif>Pendaftaran
                            </option>
                            <option value="laboratory"
                            @if ($layanan->last_ruangan == 'laboratory')
                                {{ 'selected' }}
                                @endif>Laboratory
                            </option>
                            <option value="radiology"
                            @if ($layanan->last_ruangan == 'radiology')
                                {{ 'selected' }}
                                @endif>
                                Radiology
                            </option>
                            <option value="elektromedis"
                            @if ($layanan->last_ruangan == 'elektromedis')
                                {{ 'selected' }}
                                @endif>Elektromedis
                            </option>
                            <option value="medical_checkup"
                            @if ($layanan->last_ruangan == 'medical_checkup')
                                {{ 'selected' }}
                                @endif>Medical Checkup
                            </option>
                        </select>
                        {{-- <input type="text" name="ruangan" value="{{ $layanan->last_ruangan }}"
                        class="form-control"> --}}
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" readonly value="{{ date('Y-m-d') }}" name="tanggal"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select id="kelas" name="kelas" class="form-control">
                            <option value="">--Select Here--</option>
                            @foreach ($list_kelas as $kls)
                                <option value="{{ $kls->slug }}"
                                @if ($kelas)
                                    @if ($kls->slug == $kelas->value)
                                        {{ 'selected' }}
                                        @endif
                                    @endif>{{ $kls->nama }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="kelas" value="{{ $kelas ? $kelas->value : '' }}"
                        class="form-control"> --}}
                    </div>
                    <div class="form-group">
                        <label for="">Dokter</label>
                        {{-- <div class="input-group"> --}}
                        <input type="text" id="dokter_lab" name="dokter" readonly placeholder="Pilih dokter"
                               value="{{ Auth::user()->realname }}" class="form-control">
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
                            <input type="text" name="konsultan" id="konsultan" readonly
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
                            <input type="text" name="petugas" id="petugas_lab" readonly
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
                        <input type="text" readonly id="diagnosa_lab" name="diagnosa" class="form-control">
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
{{--End Of Lab--}}

{{--Radiologi--}}
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
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">No. Reg</label>
                        <input type="text" name="noreg" value="{{ $layanan->id }}" readonly
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Pasien</label>
                        <input type="text" name="pasien" value="{{ $layanan->nama_pasien }}" readonly
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">NRM</label>
                        <input type="text" name="nrm" value="{{ $layanan->nrm }}" readonly
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <input type="hidden" name="kelamin" value="{{ $layanan->kelamin }}" readonly
                               class="form-control">
                        <input type="text" readonly
                               value="{{ $layanan->kelamin == 0 ? 'Laki-laki' : 'Perempuan' }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Umur</label>
                        <input type="text" name="umur" value="{{ $layanan->umur }}" readonly
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Ruangan</label>
                        <select id="ruangan_rad" name="ruangan" class="form-control">
                            <option value="">--Select Here--</option>
                            @foreach ($ruangan as $ru)
                                <option value="{{ $ru->slug }}"
                                @if ($layanan->last_ruangan == $ru->slug)
                                    {{ 'selected' }}
                                    @endif>
                                    {{ $ru->nama }}
                                </option>
                            @endforeach
                            <option value="pendaftaran"
                            @if ($layanan->last_ruangan == 'pendaftaran')
                                {{ 'selected' }}
                                @endif>Pendaftaran
                            </option>
                            <option value="laboratory"
                            @if ($layanan->last_ruangan == 'laboratory')
                                {{ 'selected' }}
                                @endif>Laboratory
                            </option>
                            <option value="radiology"
                            @if ($layanan->last_ruangan == 'radiology')
                                {{ 'selected' }}
                                @endif>
                                Radiology
                            </option>
                            <option value="elektromedis"
                            @if ($layanan->last_ruangan == 'elektromedis')
                                {{ 'selected' }}
                                @endif>Elektromedis
                            </option>
                            <option value="medical_checkup"
                            @if ($layanan->last_ruangan == 'medical_checkup')
                                {{ 'selected' }}
                                @endif>Medical Checkup
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Dokter</label>
                        <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}">
                        <input type="text" name="dokter" value="{{ Auth::user()->realname }}" readonly
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Pesan Pemeriksaan</label>
                        <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan_radiologi"
                                style="width: 100%" class="form-control">
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
{{--End Of Radiologi--}}

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        $("#hide_tgl_kedatangan").val($("#tgl_kedatangan").val());
        $("#hide_jam_kedatangan").val($("#jam_kedatangan").val());
        $("#hide_cara_masuk").val($('[name="radio_cara_masuk"]:checked').val());
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
            url: "{{ url('ajax_request/diagnosa_by_noreg') }}",
            data: {
                noreg: '{{ $layanan->id }}',
            },
            success: function (response) {
                console.log(response);
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
            url: "{{ url('ajax_request/update_diagnosa') }}",
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
                $('#edit_resep_dokter').val(response.nama_dokter);
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

{{--LAB--}}
<script>
    function open_modal_lab() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_noreg') }}",
            data: {
                noreg: '{{ $layanan->id }}',
            },
            success: function (response) {
                let temp = [];
                if (response.diagnosa) {
                    $('#diagnosa_lab').val(response.diagnosa.nama_icd);
                }
                if (response.pesanan_lab) {
                    const periksa = JSON.parse(response.pesanan_lab.periksa);
                    console.log(periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push(`${key}`);
                        }
                        console.log(`${key} ${value}`);
                    });
                    console.log('-------------------');
                    $('#pesan_pemeriksaan').val(temp).change();
                    $('#ruangan_lab').val(response.pesanan_lab.ruangan);
                    $('#kelas').val(response.pesanan_lab.kelas);
                }
                $('#modal_lab').modal('show');
            }
        })
    }

    function open_modal_hasil_lab(param) {
        let cek = false
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: param
            },
            success: function (response) {
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
                            ins += '<tr>' +
                                '<td style="padding-left: 40px">' + master_hasil[i].name + '</td>' +
                                '<td class="text-center" style="' + cek_nilai_normal(temp[master_hasil[i]
                                    .slug], master_hasil[i]) + '">' + temp[master_hasil[i].slug] + '</td>' +
                                '<td class="text-center">' + master_hasil[i].nt + '</td>' +
                                '</tr>';
                        }
                    }
                } else {
                    ins = '<tr>' +
                        '<th colspan="3" class="text-center">Tidak ada hasil</th>' +
                        '</tr>';
                }
                $('#list_hasil_lab').html(ins);
                $('#modal_hasil_lab').modal('show');
            }
        })
    }

    $('#form_laboratorium').submit(function (e) {
        e.preventDefault();
        $('#loading_pesanan_lab').html('<div class="alert alert-info">' + loading('Sedang menyimpan data...',
            'sm') + '</div>');
        console.log($('#form_laboratorium').serialize());
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_store') }}",
            method: 'post',
            data: $('#form_laboratorium').serialize(),
            success: function (response) {
                if (!response.status) {
                    $('#loading_pesanan_lab').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                    return;
                }
                $('#modal_lab').modal('hide');
                let data = response.data;
                console.log(data);
                $('#loading_pesanan_lab').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                let pemeriksaan = <?php echo $pemeriksaan; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                for (let i = 0; i < data.length; i++) {
                    ins += data[i].no_lab + ' - ';
                    var temp = JSON.parse(data[i].periksa);
                    console.log(temp);
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
                }
                $('#list_pesanan').html(
                    '<button class="btn btn-warning" onclick="open_modal_lab()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_lab(' +
                    "'" + data[0].id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                    ins);
            }
        })
    });
</script>
{{--END OF LAB--}}

{{--RADIOLOGI--}}
<script>
    function open_modal_pesanan_radiologi() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_noreg') }}",
            data: {
                noreg: '{{ $layanan->id }}',
            },
            success: function (response) {
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
                $('#modal_pesanan_radiologi').modal('show');
            }
        })
    }

    function open_modal_hasil_radiologi(param) {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: param
            },
            success: function (response) {
                if (response == null) {
                    return;
                }
                console.log(response);
                if (response.hasil != '') {
                    var ins = '';
                    let temp = JSON.parse(response.hasil);
                    let temp2 = JSON.parse(response.periksa);
                    let hasil = Object.entries(temp);
                    let key_hasil = Object.keys(temp);
                    let periksa = Object.entries(temp2);
                    let key_periksa = Object.keys(temp2);
                    let pemeriksaan = <?php echo $pemeriksaan_radiologi; ?>;
                    let no = 1;
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
                                        '<td style="vertical-align:top; line-height:2;">' + (hasil[i][1] ?
                                            hasil[i][1].replace('\n', '<br>') : '') + '</td>' +
                                        '</tr>';
                                    no++;
                                    break;
                                }
                            }
                        }
                    }
                    $('#list_hasil_radiologi').html(ins);
                    $('#modal_hasil_radiologi').modal('show');
                }
            }
        })
    }

    $('#form_radiologi').submit(function (e) {
        e.preventDefault();
        $('#loading_pesanan_rad').html(loading('Sedang menyimpan data harap tunggu...', 'info'));
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_store') }}",
            method: "post",
            data: $('#form_radiologi').serialize(),
            success: function (response) {
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
                console.log(data);
                let pemeriksaan = <?php echo $pemeriksaan_radiologi; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                for (let i = 0; i < data.length; i++) {
                    ins += data[i].no_lab + ' - ';
                    var temp = JSON.parse(data[i].periksa);
                    console.log(temp);
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
                }
                $('#list_pesanan_radiologi').html(
                    '<button class="btn btn-warning" onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button class="btn btn-info ml-1 mr-2" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_radiologi(' +
                    "'" + data[0].id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' + ins);
            }
        })
    })
</script>
{{--END OF RADIOLOGI--}}

</html>
