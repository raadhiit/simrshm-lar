<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Assesment Awal Pasien Rawat Inap (Dewasa)</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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

        .table_isian td {}

        .table_isian_bordered td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian2 tr {
            border: 1px solid black;
            border-collapse: collapse;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                margin: 50px;
            }

            input {
                border: none !important;
                display: inline;
            }

            span.select2-selection.select2-selection--single {
                outline: none !important;
                border: none !important;
            }

            select {
                outline: none !important;
                border: none !important;
            }

            textarea {
                field-sizing: content;
                border: none !important;
            }

            .hidden-on-print {
                display: none;
            }

            .pagebreak {
                page-break-after: always;
            }

            .col-md-1 {
                width: 8.3%;
                float: left;
            }

            .col-md-2 {
                width: 16.6%;
                float: left;
            }

            .col-md-3 {
                width: 25%;
                float: left;
            }

            .col-md-4 {
                width: 33.3%;
                float: left;
            }

            .col-md-5 {
                width: 41.6%;
                float: left;
            }

            .col-md-6 {
                width: 50%;
                float: left;
            }

            .col-md-7 {
                width: 58.3%;
                float: left;
            }

            .col-md-8 {
                width: 66.6%;
                float: left;
            }

            .col-md-9 {
                width: 75%;
                float: left;
            }

            .col-md-10 {
                width: 83.3%;
                float: left;
            }

            .col-md-11 {
                width: 91.6%;
                float: left;
            }

            .col-md-12 {
                width: 100%;
                float: left;
            }
        }
    </style>
</head>

<body style="margin: 20px;">
    @include('erm.riwayat_laboratorium')
    @include('erm.riwayat_radiologi')
    <div class="modal fade" id="modal_tambah_riwayat_penggunaan_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Riwayat Penggunaan Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="form_tambah_riwayat_penggunaan_obat">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Obat</label>
                            <input type="text" id="nama_obat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Dosis</label>
                            <input type="text" id="dosis" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Cara Pemberian</label>
                            <input type="text" id="cara_pemberian" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Frekuensi</label>
                            <input type="text" id="frekuensi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Waktu dan Tanggal Diberikan</label>
                            <input type="datetime-local" id="waktu_pemberian" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_ubah_riwayat_penggunaan_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Riwayat Penggunaan Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="form_ubah_riwayat_penggunaan_obat">
                    <input type="hidden" id="edit_index_riwayat_penggunaan_obat">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Obat</label>
                            <input type="text" id="edit_nama_obat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Dosis</label>
                            <input type="text" id="edit_dosis" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Cara Pemberian</label>
                            <input type="text" id="edit_cara_pemberian" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Frekuensi</label>
                            <input type="text" id="edit_frekuensi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Waktu dan Tanggal Diberikan</label>
                            <input type="datetime-local" id="edit_waktu_pemberian" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dokter IGD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password :</label>
                        <input type="text" hidden id="sts_simpan">
                        <input type="password" name="pass" id="pass_user" placeholder="Input your password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="set_password()" class="btn btn-success">Verifikasi</button>
                </div>
            </div>
        </div>
    </div>
    <form onsubmit="return cek_form(this)" id="form_persetujuan" action="{{ url('e_rekam_medis/detail/save_formulir_asesmen_awal_pasien_rawat_inap_dewasa') }}" method="post">
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
    <div class="row d-flex-inline pb-2" style="width: 100%; margin-left: 0;">
        <button class="btn btn-primary" id="btn_riwayat_lab">Riwayat Laboratorium</button>
        <button class="btn btn-info ml-2" id="btn_riwayat_rad">Riwayat Radiologi</button>
    </div>
    <div class="row pb-3" style="width: 100%; margin-left: 0;">
        <table style="width: 100%">
            <tr>
                <td style="width: 50%; border: 1px solid; vertical-align: text-top">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 40%">
                                <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 100%; height: 160px">
                            </td>
                            <td style="width: 60%; margin-top: 10px">
                                <p style="font-weight: bold; font-size:18px; text-align: left">
                                    RUMAH SAKIT HARAPAN MULIA
                                </p>
                                <p style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
                                    <span style="font-weight: normal">
                                        Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                                        <br>Kabupaten Bekasi Jawa Barat (17340).
                                        <br>Telp.: (021) 8995 2340
                                        <br>Email : info@rumahsakit-harapanmulia.id
                                    </span>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%; margin-left: 0; border:1px solid; padding:10px;">
                    <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px;">
                        <tr>
                            <td style="width: 40%;">Nama</td>
                            <td style="padding-left:10px; padding-right:10px"> :</td>
                            <td>{{ $layanan->nama_pasien }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">NIK</td>
                            <td style="padding-left:10px; padding-right:10px"> :</td>
                            <td>{{ $layanan->ktp }}</td>
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
                </td>
            </tr>
        </table>
    </div>
    <div style="margin-top: -17px;">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
                <h6 style="color: white">ASSESMENT AWAL PASIEN RAWAT INAP (DEWASA)</h6>
            </div>
        </div>
        <form id="form1" method="post" action="{{ url('e_rekam_medis/detail/save_formulir_asesmen_awal_pasien_rawat_inap_dewasa') }}">
            @csrf
            <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
            <input type="text" hidden id="pass" name="pass">
            <input type="text" hidden id="hide_list_riwayat_penggunaan_obat" name="list_riwayat_penggunaan_obat">
            <div class="row" style="width: 100%; margin-left: 0;">
                <table style="width: 100%" class="table_isian_bordered">
                    <tr>
                        <td style="width: 15%;">
                            Tiba diruangan
                        </td>
                        <td style="border-left: hidden; width: 35%">
                            :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kedatangan" name="tgl_kedatangan" value="@if(old('tgl_kedatangan')){{ old('tgl_kedatangan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tgl_kedatangan : '' }}@endif">
                            , Jam :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_kedatangan" name="jam_kedatangan" value="@if(old('jam_kedatangan')){{ old('jam_kedatangan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_kedatangan : '' }}@endif">
                        </td>
                        <td style="width: 15%;">
                            Pengkajian
                        </td>
                        <td style="border-left: hidden; width: 35%">
                            :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_pengkajian" name="tgl_pengkajian" value="@if(old('tgl_pengkajian')){{ old('tgl_pengkajian') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tgl_pengkajian : '' }}@endif">
                            , Jam :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_pengkajian" name="jam_pengkajian" value="@if(old('jam_pengkajian')){{ old('jam_pengkajian') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_pengkajian : '' }}@endif">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">
                            Diperoleh Dari
                        </td>
                        <td style="border-left: hidden; width: 35%">
                            :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="diperoleh_dari" name="diperoleh_dari" value="@if(old('diperoleh_dari')){{ old('diperoleh_dari') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diperoleh_dari : '' }}@endif">
                        </td>
                        <td style="width: 15%;">
                            Hubungan Dengan Pasien
                        </td>
                        <td style="border-left: hidden; width: 35%">
                            :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="hubungan_dengan_pasien" name="hubungan_dengan_pasien" value="@if(old('hubungan_dengan_pasien')){{ old('hubungan_dengan_pasien') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->hubungan_dengan_pasien : '' }}@endif">
                        </td>
                    </tr>
                    <tr style="border-bottom: hidden">
                        <td style="width: 15%;">
                            Cara Masuk
                        </td>
                        <td style="border-left: hidden" colspan="3">
                            :
                            <input onclick="cek_radio_cara_masuk()" @if(old('cara_masuk')) {{ old('cara_masuk') ==  'jalan_tanpa_bantuan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->cara_masuk == 'jalan_tanpa_bantuan' ? 'checked' : '') : '' }} @endif type="radio" value="jalan_tanpa_bantuan" name="radio_cara_masuk"> Jalan Tanpa Bantuan
                            <input onclick="cek_radio_cara_masuk()" @if(old('cara_masuk')) {{ old('cara_masuk') ==  'jalan_dengan_bantuan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->cara_masuk == 'jalan_dengan_bantuan' ? 'checked' : '') : '' }} @endif type="radio" value="jalan_dengan_bantuan" name="radio_cara_masuk" class="ml-4"> Jalan Dengan Bantuan
                            <input onclick="cek_radio_cara_masuk()" @if(old('cara_masuk')) {{ old('cara_masuk') ==  'dengan_kursi_roda' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->cara_masuk == 'dengan_kursi_roda' ? 'checked' : '') : '' }} @endif type="radio" value="dengan_kursi_roda" name="radio_cara_masuk" class="ml-4"> Dengan Kursi Roda
                            <input onclick="cek_radio_cara_masuk()" @if(old('cara_masuk')) {{ old('cara_masuk') ==  'dengan_brankar' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->cara_masuk == 'dengan_brankar' ? 'checked' : '') : '' }} @endif type="radio" value="dengan_brankar" name="radio_cara_masuk" class="ml-4"> Dengan Brankar
                        </td>
                    </tr>
                    <tr style="border-bottom: hidden">
                        <td style="width: 15%;">
                            Asal Pasien
                        </td>
                        <td style="border-left: hidden" colspan="3">
                            :
                            <input @if(old('asal_pasien')) {{ old('asal_pasien') ==  'igd' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->asal_pasien == 'igd' ? 'checked' : '') : '' }} @endif type="radio" value="igd" name="radio_asal_pasien"> IGD
                            <input @if(old('asal_pasien')) {{ old('asal_pasien') ==  'poliklinik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->asal_pasien == 'poliklinik' ? 'checked' : '') : '' }} @endif type="radio" value="poliklinik" name="radio_asal_pasien" class="ml-4"> Poliklinik
                            <input @if(old('asal_pasien')) {{ old('asal_pasien') ==  'kamar_operasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->asal_pasien == 'kamar_operasi' ? 'checked' : '') : '' }} @endif type="radio" value="kamar_operasi" name="radio_asal_pasien" class="ml-4"> Kamar Operasi
                            <input @if(old('asal_pasien')) {{ old('asal_pasien') ==  'rujukan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->asal_pasien == 'rujukan' ? 'checked' : '') : '' }} @endif type="radio" value="rujukan" name="radio_asal_pasien" class="ml-4"> Rujukan
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">
                            Nama Primary Nurse
                        </td>
                        <td style="border-left: hidden; width: 85%" colspan="3">
                            :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="nama_primary_nurse" name="nama_primary_nurse" value="@if(old('nama_primary_nurse')){{ old('nama_primary_nurse') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->nama_primary_nurse : '' }}@endif">
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
                            <input type="text" class="form-control" value="@if(old('keluhan_utama')){{ old('keluhan_utama') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keluhan_utama : '' }}@endif" id="keluhan_utama" name="keluhan_utama">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            2. Riwayat Penyakit Sekarang
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden" colspan="3">
                            <input type="text" class="form-control" value="@if(old('riwayat_penyakit_sekarang')){{ old('riwayat_penyakit_sekarang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penyakit_sekarang : '' }}@endif" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            3. Riwayat Penyakit Dahulu
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden" colspan="3">
                            <input type="text" class="form-control" value="@if(old('riwayat_penyakit_dahulu')){{ old('riwayat_penyakit_dahulu') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penyakit_dahulu : '' }}@endif" id="riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            4. Riwayat Penyakit Keluarga
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_penyakit_keluarga()" type="radio" value="tidak_ada" name="radio_riwayat_penyakit_keluarga" @if(old('riwayat_penyakit_keluarga')) {{ old('riwayat_penyakit_keluarga') ==  'tidak_ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penyakit_keluarga == 'tidak_ada' ? 'checked' : '' : 'checked' }} @endif> Tidak Ada
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_penyakit_keluarga()" @if(old('riwayat_penyakit_keluarga')) {{ old('riwayat_penyakit_keluarga') ==  'ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penyakit_keluarga == 'ada' ? 'checked' : '') : '' }} @endif type="radio" value="ada" name="radio_riwayat_penyakit_keluarga"> Ada
                            <input type="text" readonly value="@if(old('ket_riwayat_penyakit_keluarga')){{ old('ket_riwayat_penyakit_keluarga') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->ket_riwayat_penyakit_keluarga : '' }}@endif" id="ket_riwayat_penyakit_keluarga" name="ket_riwayat_penyakit_keluarga" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_penyakit_keluarga')) {{ old('riwayat_penyakit_keluarga') ==  'ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penyakit_keluarga == 'ada' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            5. Riwayat Penggunaan Obat
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_penggunaan_obat()" @if(old('riwayat_penggunaan_obat')) {{ old('riwayat_penggunaan_obat') ==  'tidak_ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penggunaan_obat == 'tidak_ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_ada" name="radio_riwayat_penggunaan_obat"> Tidak Ada
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_penggunaan_obat()" @if(old('riwayat_penggunaan_obat')) {{ old('riwayat_penggunaan_obat') ==  'ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penggunaan_obat == 'ada' ? 'checked' : '') : '' }} @endif type="radio" value="ada" name="radio_riwayat_penggunaan_obat"> Ada
                            <input type="text" readonly value="@if(old('ket_riwayat_penggunaan_obat')){{ old('ket_riwayat_penggunaan_obat') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->ket_riwayat_penggunaan_obat : '' }}@endif" id="ket_riwayat_penggunaan_obat" name="ket_riwayat_penggunaan_obat" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_penggunaan_obat')) {{ old('riwayat_penggunaan_obat') ==  'ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_penggunaan_obat == 'ada' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table style="width: 100%; " class="table_isian_bordered">
                                <thead>
                                    <tr style="text-align: center">
                                        <td>Nama Obat</td>
                                        <td>Dosis</td>
                                        <td>Cara Pemberian</td>
                                        <td>Frekuensi</td>
                                        <td>
                                            Waktu & Tgl Terakhir Diberikan
                                        </td>
                                        <td>
                                            Action
                                            <button class="btn btn-success" style="float: right" onclick="open_modal_tambah_riwayat_penggunaan_obat()" type="button"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="list_riwayat_penggunaan_obat">
                                    @if (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->list_riwayat_penggunaan_obat != null)
                                    @foreach (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->list_riwayat_penggunaan_obat) as $key => $item)
                                    <tr>
                                        <td class="text-center"><input type="hidden" name="nama_obat[]" value="{{ $item->nama_obat }}">{{ $item->nama_obat }}</td>
                                        <td class="text-center"><input type="hidden" name="dosis[]" value="{{ $item->dosis }}">{{ $item->dosis }}</td>
                                        <td class="text-center"><input type="hidden" name="cara_pemberian[]" value="{{ $item->cara_pemberian }}">{{ $item->cara_pemberian }}</td>
                                        <td class="text-center"><input type="hidden" name="frekuensi[]" value="{{ $item->frekuensi }}">{{ $item->frekuensi }}</td>
                                        <td class="text-center"><input type="hidden" name="waktu_pemberian[]" value="{{ $item->waktu_pemberian }}">{{ $item->waktu_pemberian }}</td>
                                        <td>
                                            <div style="display:flex; flex-directiion:row; justify-content:center;">
                                                <button type="button" class="btn btn-warning" onclick="open_modal_ubah_riwayat_penggunaan_obat('{{ $key }}')" style="color:#fff;"><i class="fa fa-pencil"></i></button>
                                                <button type="button" class="btn btn-danger ml-1" onclick="hapus_riwayat_penggunaan_obat('{{ $key }}')"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            6. Riwayat Alergi
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_alergi()" @if(old('riwayat_alergi')) {{ old('riwayat_alergi') ==  'tidak_ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_alergi == 'tidak_ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_ada" name="radio_riwayat_alergi"> Tidak Ada
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_alergi()" @if(old('riwayat_alergi')) {{ old('riwayat_alergi') ==  'ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_alergi == 'ada' ? 'checked' : '') : '' }} @endif type="radio" value="ada" name="radio_riwayat_alergi"> Ada
                            <input type="text" readonly value="@if(old('ket_riwayat_alergi')){{ old('ket_riwayat_alergi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->ket_riwayat_alergi : '' }}@endif" id="ket_riwayat_alergi" name="ket_riwayat_alergi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_alergi')) {{ old('riwayat_alergi') ==  'ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->riwayat_alergi == 'ada' ? '' : 'readonly') : 'readonly' }} @endif>
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
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'tampak_tidak_sakit' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keadaan_umum == 'tampak_tidak_sakit' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tampak_tidak_sakit" name="radio_keadaan_umum"> Tampak Tidak Sakit
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'sakit_ringan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keadaan_umum == 'sakit_ringan' ? 'checked' : '') : '' }} @endif type="radio" value="sakit_ringan" name="radio_keadaan_umum" class="ml-4"> Sakit Ringan
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'sakit_sedang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keadaan_umum == 'sakit_sedang' ? 'checked' : '') : '' }} @endif type="radio" value="sakit_sedang" name="radio_keadaan_umum" class="ml-4"> Sakit Sedang
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'sakit_berat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keadaan_umum == 'sakit_berat' ? 'checked' : '') : '' }} @endif type="radio" value="sakit_berat" name="radio_keadaan_umum" class="ml-4"> Sakit Berat
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%">2. Kesadaran</td>
                        <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                        <td colspan="4">
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->kesadaran == 'compos_mentis' ? 'checked' : '') : 'checked' }} @endif type="radio" value="compos_mentis" name="radio_kesadaran"> Compos Mentis
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'apatis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->kesadaran == 'apatis' ? 'checked' : '') : '' }} @endif type="radio" value="apatis" name="radio_kesadaran" class="ml-4"> Apatis
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'somnolen' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->kesadaran == 'somnolen' ? 'checked' : '') : '' }} @endif type="radio" value="somnolen" name="radio_kesadaran" class="ml-4"> Somnolen
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'sopor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->kesadaran == 'sopor' ? 'checked' : '') : '' }} @endif type="radio" value="sopor" name="radio_kesadaran" class="ml-4"> Sopor
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'sopor_koma' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->kesadaran == 'sopor_koma' ? 'checked' : '') : '' }} @endif type="radio" value="sopor_koma" name="radio_kesadaran" class="ml-4"> Sopor koma
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%"></td>
                        <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                        <td colspan="4">
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'koma' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->kesadaran == 'koma' ? 'checked' : '') : '' }} @endif type="radio" value="koma" name="radio_kesadaran"> koma
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%">3. GCS</td>
                        <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                        <td colspan="4">
                            <div class="row">
                                <div class="col-md-4">
                                    E : <input type="text" value="@if(old('e_kesadaran')){{ old('e_kesadaran') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->e_kesadaran : '' }}@endif" id="e_kesadaran" name="e_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-4">
                                    M : <input type="text" value="@if(old('m_kesadaran')){{ old('m_kesadaran') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->m_kesadaran : '' }}@endif" id="m_kesadaran" name="m_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-4">
                                    V : <input type="text" value="@if(old('v_kesadaran')){{ old('v_kesadaran') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->v_kesadaran : '' }}@endif" id="v_kesadaran" name="v_kesadaran" style="border: 0; border-bottom: 2px dotted;">
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
                                    TD <input type="text" value="@if(old('td')){{ old('td') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->td : '' }}@endif" id="td" name="td" style="border: 0; border-bottom: 2px dotted; width: 50px"> mmHg
                                </div>
                                <div class="col-md-2">
                                    RR <input type="text" value="@if(old('rr')){{ old('rr') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->rr : '' }}@endif" id="rr" name="rr" style="border: 0; border-bottom: 2px dotted; width: 50px"> x/menit
                                </div>
                                <div class="col-md-2">
                                    Nadi <input type="text" value="@if(old('nadi')){{ old('nadi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->nadi : '' }}@endif" id="nadi" name="nadi" style="border: 0; border-bottom: 2px dotted; width: 50px"> x/menit
                                </div>
                                <div class="col-md-2">
                                    Suhu <input type="text" value="@if(old('suhu')){{ old('suhu') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->suhu : '' }}@endif" id="suhu" name="suhu" style="border: 0; border-bottom: 2px dotted; width: 50px"> ᵒC
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
                            <textarea id="status_generalis" name="status_generalis" class="form-control" rows="5" class="form-control">@if(old('status_generalis')){{ old('status_generalis') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->status_generalis : '' }}@endif</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Status Lokasi
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="vertical-align: top">
                            @if ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa)
                            @if ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->gambar_status_lokalis != '')
                            <div style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis.jpg') }}')">
                                <img style="position: relative; top:0px; opacity: 0.5;" src="{{ asset('status_lokalis/' . $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->gambar_status_lokalis) }}" alt="">
                            </div>
                            @else
                            <div style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis.jpg') }}')">
                                <div id="sig" class="hidden-on-print"></div>
                            </div>
                            @endif
                            @else
                            <div style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis.jpg') }}')">
                                <div id="sig" class="hidden-on-print"></div>
                            </div>
                            @endif
                            <textarea id="gambar_status_lokalis" name="signed" style="display: none"></textarea>
                            <p>Gambar lokasi</p>
                            @if ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa)
                            @if ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->gambar_status_lokalis != '')
                            <a style="position:relative; top:0px;" onclick="return confirm('Yakin gambar ulang status lokalis ?')" class="btn btn-dark hidden-on-print" href="{{ url('e_rekam_medis/hapus_gambar_status_lokalis?dokumen=' . $dokumen->id) }}">Gambar
                                ulang</a>
                            @else
                            <button style="position:relative; top:0px;" type="button" class="btn btn-danger hidden-on-print" id="btn_clear">Clear</button>
                            @endif
                            @else
                            <button style="position:relative; top:0px;" type="button" class="btn btn-danger hidden-on-print" id="btn_clear">Clear</button>
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
                                        @if (is_null($pesanan_lab))
                                        <button class="btn btn-dark hidden-on-print" type="button" onclick="open_modal_lab()"><i class="fa fa-plus"></i></button>
                                        @endif
                                    </div>
                                    <div id="list_pesanan">
                                        @if ($pesanan_lab)
                                        @if($pesanan_lab->status == 'Pesanan ERM')
                                        <button class="btn btn-warning hidden-on-print" type="button" onclick="open_modal_lab()"><i class="fa fa-pencil" style="color:#fff;"></i></button>
                                        @endif
                                        <button class="btn btn-info hidden-on-print" type="button" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_lab('{{ $pesanan_lab->id }}')"><i class="fa fa-book" style="color:#fff;"></i></button>
                                        @if($pesanan_lab->status == 'Pesanan ERM')
                                        <button class="btn btn-danger hidden-on-print" type="button" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_lab('{{ $pesanan_lab->id }}')"><i class="fa fa-trash" style="color:#fff;"></i></button>
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
                                        {{ $pesanan_lab->no_lab }} - {{ $pesan }}
                                        @endif
                                    </div>
                                    <br>
                                    B. Radiologi
                                    <div id="box_button_pesanan_radiologi">
                                        @if (is_null($pesanan_rad))
                                        <button onclick="open_modal_pesanan_radiologi()" type="button" class="btn btn-dark hidden-on-print"><i class="fa fa-plus"></i></button>
                                        @endif
                                    </div>
                                    <div id="list_pesanan_radiologi">
                                        @if($pesanan_rad)
                                        @if($pesanan_rad->status == 'Pesanan ERM')
                                        <button class="btn btn-warning hidden-on-print" type="button" onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil" style="color:#fff;"></i>
                                        </button>
                                        @endif
                                        <button class="btn btn-info hidden-on-print" type="button" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_radiologi('{{ $pesanan_rad->id }}')"><i class="fa fa-book" style="color:#fff;"></i></button>
                                        @if($pesanan_rad->status == 'Pesanan ERM')
                                        <button class="btn btn-danger hidden-on-print" type="button" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_rad('{{ $pesanan_rad->id }}')"><i class="fa fa-trash" style="color:#fff;"></i></button>
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
                            IV. Diagnosa Kerja :
                        </td>
                    </tr>
                    <tr style="border: 1px solid">
                        <td colspan="5">
                            <div style="display: flex; flex-direction: row" class="pt-3">
                                <div id="box_btn_asesmen">
                                    @if ($layanan->diagnosa == null)
                                    <a class="btn btn-success hidden-on-print" onclick="open_form_tambah_diagnosa('diagnosa')"><i class="fa fa-plus"></i></a>
                                    @else
                                    <a class="btn btn-warning hidden-on-print" onclick="open_form_tambah_diagnosa('diagnosa')" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></a>
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
                                <div id="box_btn_asesmen_pembanding">
                                    @if ($layanan->diagnosa == null)
                                    <a class="btn btn-success hidden-on-print" onclick="open_form_tambah_diagnosa('banding')"><i class="fa fa-plus"></i></a>
                                    @else
                                    <a class="btn btn-warning hidden-on-print" onclick="open_form_tambah_diagnosa('banding')" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></a>
                                    @endif
                                </div>
                                <div id="box_diagnosa_pembanding" class="ml-2">
                                    {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd_diagnosa_pembanding != '' ? $layanan->diagnosa->kode_icd_diagnosa_pembanding.' - '.$layanan->diagnosa->diagnosa_pembanding : $layanan->diagnosa->nama_diagnosa_pembanding : '' }}
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
                            <input type="time" class="form-control" value="@if(old('jam_tindakan1')){{ old('jam_tindakan1') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_tindakan1 : '' }}@endif" id="jam_tindakan1" name="jam_tindakan1">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('tindakan1')){{ old('tindakan1') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tindakan1 : '' }}@endif" id="tindakan1" name="tindakan1">
                        </td>
                        <td>
                            <select id="diberikan_oleh1" name="diberikan_oleh1" class="form-control" style="margin-top: 5px; width: 100%">
                                <option value="" selected disabled>Pilih Perawat</option>
                                @foreach($data_employee as $item)
                                <option @if(old('diberikan_oleh1')) {{ old('diberikan_oleh1') == $item->nama ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa))
                                    {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh1 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                                    @endforeach
                                </option>
                            </select>
                            {{-- <input type="text" class="form-control"
                                       value="@if(old('diberikan_oleh1')){{ old('diberikan_oleh1') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh1 : '' }}@endif"
                            id="diberikan_oleh1"> --}}
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('keterangan1')){{ old('keterangan1') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keterangan1 : '' }}@endif" id="keterangan1" name="keterangan1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="time" class="form-control" value="@if(old('jam_tindakan2')){{ old('jam_tindakan2') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_tindakan2 : '' }}@endif" id="jam_tindakan2" name="jam_tindakan2">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('tindakan2')){{ old('tindakan2') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tindakan2 : '' }}@endif" id="tindakan2" name="tindakan2">
                        </td>
                        <td>
                            <select id="diberikan_oleh2" name="diberikan_oleh2" class="form-control" style="margin-top: 5px; width: 100%">
                                <option value="" selected disabled>Pilih Perawat</option>
                                @foreach($data_employee as $item)
                                <option @if(old('diberikan_oleh2')) {{ old('diberikan_oleh2') == $item->nama ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa))
                                    {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh2 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                                    @endforeach
                                </option>
                            </select>
                            {{-- <input type="text" class="form-control"
                                       value="@if(old('diberikan_oleh2')){{ old('diberikan_oleh2') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh2 : '' }}@endif"
                            id="diberikan_oleh2"> --}}
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('keterangan2')){{ old('keterangan2') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keterangan2 : '' }}@endif" id="keterangan2" name="keterangan2">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="time" class="form-control" value="@if(old('jam_tindakan3')){{ old('jam_tindakan3') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_tindakan3 : '' }}@endif" id="jam_tindakan3" name="jam_tindakan3">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('tindakan3')){{ old('tindakan3') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tindakan3 : '' }}@endif" id="tindakan3" name="tindakan3">
                        </td>
                        <td>
                            <select id="diberikan_oleh3" name="diberikan_oleh3" class="form-control" style="margin-top: 5px; width: 100%">
                                <option value="" selected disabled>Pilih Perawat</option>
                                @foreach($data_employee as $item)
                                <option @if(old('diberikan_oleh3')) {{ old('diberikan_oleh3') == $item->nama ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa))
                                    {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh3 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                                    @endforeach
                                </option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('keterangan3')){{ old('keterangan3') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keterangan3 : '' }}@endif" id="keterangan3" name="keterangan3">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="time" class="form-control" value="@if(old('jam_tindakan4')){{ old('jam_tindakan4') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_tindakan4 : '' }}@endif" id="jam_tindakan4" name="jam_tindakan4">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('tindakan4')){{ old('tindakan4') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tindakan4 : '' }}@endif" id="tindakan4" name="tindakan4">
                        </td>
                        <td>
                            <select id="diberikan_oleh4" name="diberikan_oleh4" class="form-control" style="margin-top: 5px; width: 100%">
                                <option value="" selected disabled>Pilih Perawat</option>
                                @foreach($data_employee as $item)
                                <option @if(old('diberikan_oleh4')) {{ old('diberikan_oleh4') == $item->nama ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa))
                                    {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh4 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                                    @endforeach
                                </option>
                            </select>
                            {{-- <input type="text" class="form-control"
                                       value="@if(old('diberikan_oleh4')){{ old('diberikan_oleh4') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh4 : '' }}@endif"
                            id="diberikan_oleh4"> --}}
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('keterangan4')){{ old('keterangan4') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keterangan4 : '' }}@endif" id="keterangan4" name="keterangan4">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="time" class="form-control" value="@if(old('jam_tindakan5')){{ old('jam_tindakan5') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_tindakan5 : '' }}@endif" id="jam_tindakan5" name="jam_tindakan5">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('tindakan5')){{ old('tindakan5') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tindakan5 : '' }}@endif" id="tindakan5" name="tindakan5">
                        </td>
                        <td>
                            <select id="diberikan_oleh5" name="diberikan_oleh5" class="form-control" style="margin-top: 5px; width: 100%">
                                <option value="" selected disabled>Pilih Perawat</option>
                                @foreach($data_employee as $item)
                                <option @if(old('diberikan_oleh5')) {{ old('diberikan_oleh5') == $item->nama ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa))
                                    {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh5 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                                    @endforeach
                                </option>
                            </select>
                            {{-- <input type="text" class="form-control"
                                       value="@if(old('diberikan_oleh5')){{ old('diberikan_oleh5') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh5 : '' }}@endif"
                            id="diberikan_oleh5"> --}}
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('keterangan5')){{ old('keterangan5') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keterangan5 : '' }}@endif" id="keterangan5" name="keterangan5">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="time" class="form-control" value="@if(old('jam_tindakan6')){{ old('jam_tindakan6') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->jam_tindakan6 : '' }}@endif" id="jam_tindakan6" name="jam_tindakan6">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('tindakan6')){{ old('tindakan6') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->tindakan6 : '' }}@endif" id="tindakan6" name="tindakan6">
                        </td>
                        <td>
                            <select id="diberikan_oleh6" name="diberikan_oleh6" class="form-control" style="margin-top: 5px; width: 100%">
                                <option value="" selected disabled>Pilih Perawat</option>
                                @foreach($data_employee as $item)
                                <option @if(old('diberikan_oleh6')) {{ old('diberikan_oleh6') == $item->nama ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa))
                                    {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh6 == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                                    @endforeach
                                </option>
                            </select>
                            {{-- <input type="text" class="form-control"
                                       value="@if(old('diberikan_oleh6')){{ old('diberikan_oleh6') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->diberikan_oleh6 : '' }}@endif"
                            id="diberikan_oleh6"> --}}
                        </td>
                        <td>
                            <input type="text" class="form-control" value="@if(old('keterangan6')){{ old('keterangan6') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->keterangan6 : '' }}@endif" id="keterangan6" name="keterangan6">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            TERAPI
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div id="box_resep" class="pt-3">
                                <div id="box_btn_terapi">
                                    @if (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa))
                                    @if ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep == null)
                                    <a class="btn btn-dark hidden-on-print" onclick="open_modal_resep('{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->id : 0) : 0 }}', '{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id : '' }}')"><i class="fa fa-plus"></i></a>
                                    @else
                                    @if ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->locked == 0)
                                    <a class="btn btn-warning hidden-on-print" onclick="open_modal_resep('{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->id : 0) : 0 }}', '{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id : '' }}')"><i class="fa fa-pencil" style="color:#fff;"></i></a>
                                    <a class="btn btn-info hidden-on-print" onclick="lock_resep('{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->id : 0) : 0 }}', '{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id : '' }}')"><i class="fa fa-lock" style="color:#fff;"></i></a>
                                    @endif
                                    <a class="btn btn-info hidden-on-print" onclick="preview_resep('{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->id : 0) : 0 }}')"><i class="fa fa-book" style="color:#fff;"></i></a>
                                    @endif
                                    No. Resep Elektronik
                                    @if (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep))
                                    {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->id }}
                                    @endif
                                    @else
                                    <a class="btn btn-dark hidden-on-print" onclick="open_modal_resep('{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->id : 0) : 0 }}', '{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id : '' }}')"><i class="fa fa-plus"></i></a>
                                    @endif
                                </div>
                                <table style="border-collapse: collapse; width:100%;">
                                    @if (isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep) && isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep))
                                    @foreach ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->resep->detail as $ar_det)
                                    <tr>
                                        <td>{{ 'R/' }} {{ $ar_det->nama_obat }}</td>
                                        <td>{{ $ar_det->signa }}</td>
                                        <td style="padding-left: 20px;">
                                            {{ $ar_det->jumlah . ' ' . $ar_det->satuan }}
                                        </td>
                                    </tr>
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
                        <td style="width: 50%; text-align: center" onclick="open_modal_ttd(`satu`)">
                            @if($dokumen->id_verifikator == 0)
                            <br>
                            Dokter IGD
                            <br>
                            <br>
                            <br>
                            <a class="btn btn-success">Simpan & Verifikasi</a>
                            <br>
                            <br>
                            <br>
                            (.................................................)
                            <br>Ttd & Nama Terang
                            @else
                            @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 4cm; width: 5cm;" alt="">
                            @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                            @endif
                            <br>({{$dokumen->nama_verifikator}})
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <form id="form2" method="post" action="{{ url('e_rekam_medis/detail/save_formulir_asesmen_awal_pasien_rawat_inap_dewasa2') }}">
            @csrf
            <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
            <input type="text" hidden id="pass2" name="pass">
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
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_pengkajian_keperawatan" name="tgl_pengkajian_keperawatan" value="@if(old('tgl_pengkajian_keperawatan')){{ old('tgl_pengkajian_keperawatan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->tgl_pengkajian_keperawatan : '' }}@endif">
                            , Jam :
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_pengkajian_keperawatan" name="jam_pengkajian_keperawatan" value="@if(old('jam_pengkajian_keperawatan')){{ old('jam_pengkajian_keperawatan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jam_pengkajian_keperawatan : '' }}@endif">
                        </td>
                        <td style="width: 15%;">
                            Diperoleh Dari
                            <span style="float: right">: </span>
                        </td>
                        <td style="border-left: hidden; width: 35%">
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="diperoleh_dari" name="diperoleh_dari" value="@if(old('diperoleh_dari')){{ old('diperoleh_dari') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->diperoleh_dari : '' }}@endif">
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
                            <input type="text" class="form-control" value="@if(old('keluhan_utama')){{ old('keluhan_utama') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->keluhan_utama : '' }}@endif" id="keluhan_utama" name="keluhan_utama">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            2. Riwayat Penyakit Sekarang
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden" colspan="3">
                            <input type="text" class="form-control" value="@if(old('riwayat_penyakit_sekarang')){{ old('riwayat_penyakit_sekarang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->riwayat_penyakit_sekarang : '' }}@endif" id="riwayat_penyakit_sekarang_p" name="riwayat_penyakit_sekarang">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            3. Riwayat Penyakit Dahulu
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden" colspan="3">
                            <input type="text" class="form-control" value="@if(old('riwayat_penyakit_dahulu')){{ old('riwayat_penyakit_dahulu') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->riwayat_penyakit_dahulu : '' }}@endif" id="riwayat_penyakit_dahulu_p" name="riwayat_penyakit_dahulu">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            4. Riwayat Penyakit Keluarga
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_penyakit_keluarga_p()" @if(old('riwayat_penyakit_keluarga')) {{ old('riwayat_penyakit_keluarga') ==  'tidak_ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_penyakit_keluarga == 'tidak_ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_ada" name="radio_riwayat_penyakit_keluarga_p"> Tidak Ada
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_penyakit_keluarga_p()" @if(old('riwayat_penyakit_keluarga')) {{ old('riwayat_penyakit_keluarga') ==  'ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_penyakit_keluarga == 'ada' ? 'checked' : '') : '' }} @endif type="radio" value="ada" name="radio_riwayat_penyakit_keluarga_p"> Ada
                            <input type="text" readonly value="@if(old('ket_riwayat_penyakit_keluarga')){{ old('ket_riwayat_penyakit_keluarga') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_riwayat_penyakit_keluarga : '' }}@endif" id="ket_riwayat_penyakit_keluarga_p" name="ket_riwayat_penyakit_keluarga" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_penyakit_keluarga')) {{ old('riwayat_penyakit_keluarga') ==  'ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_penyakit_keluarga == 'ada' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            5. Riwayat Penggunaan Obat
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_penggunaan_obat_p()" @if(old('riwayat_penggunaan_obat')) {{ old('riwayat_penggunaan_obat') ==  'tidak_ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_penggunaan_obat == 'tidak_ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_ada" name="radio_riwayat_penggunaan_obat_p"> Tidak Ada
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_penggunaan_obat_p()" @if(old('riwayat_penggunaan_obat')) {{ old('riwayat_penggunaan_obat') ==  'ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_penggunaan_obat == 'ada' ? 'checked' : '') : '' }} @endif type="radio" value="ada" name="radio_riwayat_penggunaan_obat_p"> Ada
                            <input type="text" readonly value="@if(old('ket_riwayat_penggunaan_obat')){{ old('ket_riwayat_penggunaan_obat') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_riwayat_penggunaan_obat : '' }}@endif" id="ket_riwayat_penggunaan_obat_p" name="ket_riwayat_penggunaan_obat" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_penggunaan_obat')) {{ old('riwayat_penggunaan_obat') ==  'ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_penggunaan_obat == 'ada' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            6. Riwayat Alergi
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_alergi_p()" @if(old('riwayat_alergi')) {{ old('riwayat_alergi') ==  'tidak_ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_alergi == 'tidak_ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_ada" name="radio_riwayat_alergi_p"> Tidak Ada
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_alergi_p()" @if(old('riwayat_alergi')) {{ old('riwayat_alergi') ==  'ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_alergi == 'ada' ? 'checked' : '') : '' }} @endif type="radio" value="ada" name="radio_riwayat_alergi_p"> Ada
                            <input type="text" readonly value="@if(old('ket_riwayat_alergi')){{ old('ket_riwayat_alergi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_riwayat_alergi : '' }}@endif" id="ket_riwayat_alergi_p" name="ket_riwayat_alergi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_alergi')) {{ old('riwayat_alergi') ==  'ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_alergi == 'ada' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; vertical-align: text-top">
                            7. Riwayat Transfusi Darah
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_transfusi()" @if(old('riwayat_transfusi')) {{ old('riwayat_transfusi') ==  'tidak_pernah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_transfusi == 'tidak_pernah' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_pernah" name="radio_riwayat_transfusi"> Tidak Pernah
                            <br>
                            Timbul Reaksi
                            <input onclick="cek_radio_riwayat_timbul_reaksi()" @if(old('riwayat_timbul_reaksi')) {{ old('riwayat_timbul_reaksi') ==  'tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_timbul_reaksi == 'tidak' ? 'checked' : '') : '' }} @endif type="radio" value="tidak" name="radio_riwayat_timbul_reaksi" class="ml-2"> Tidak
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_transfusi()" @if(old('riwayat_transfusi')) {{ old('riwayat_transfusi') ==  'pernah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_transfusi == 'pernah' ? 'checked' : '') : '' }} @endif type="radio" value="pernah" name="radio_riwayat_transfusi"> Pernah, Kapan :
                            <input type="datetime-local" readonly value="@if(old('ket_riwayat_transfusi')){{ old('ket_riwayat_transfusi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_riwayat_transfusi : '' }}@endif" id="ket_riwayat_transfusi" name="ket_riwayat_transfusi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_transfusi')) {{ old('riwayat_transfusi') ==  'pernah' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_transfusi == 'pernah' ? '' : 'readonly') : 'readonly' }} @endif>
                            <br>
                            <input onclick="cek_radio_riwayat_timbul_reaksi()" @if(old('riwayat_timbul_reaksi')) {{ old('riwayat_timbul_reaksi') ==  'ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_timbul_reaksi == 'ya' ? 'checked' : '') : '' }} @endif type="radio" value="ya" name="radio_riwayat_timbul_reaksi"> Ya :
                            <input type="text" readonly value="@if(old('ket_riwayat_timbul_reaksi')){{ old('ket_riwayat_timbul_reaksi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_riwayat_timbul_reaksi : '' }}@endif" id="ket_riwayat_timbul_reaksi" name="ket_riwayat_timbul_reaksi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_timbul_reaksi')) {{ old('riwayat_timbul_reaksi') ==  'ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_timbul_reaksi == 'ya' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            8. Riwayat Kemoterapi
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_kemoterapi()" @if(old('riwayat_kemoterapi')) {{ old('riwayat_kemoterapi') ==  'tidak_pernah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_kemoterapi == 'tidak_pernah' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_pernah" name="radio_riwayat_kemoterapi"> Tidak Pernah
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_kemoterapi()" @if(old('riwayat_kemoterapi')) {{ old('riwayat_kemoterapi') ==  'pernah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_kemoterapi == 'pernah' ? 'checked' : '') : '' }} @endif type="radio" value="pernah" name="radio_riwayat_kemoterapi"> Pernah, Kapan :
                            <input type="datetime-local" readonly value="@if(old('ket_riwayat_kemoterapi')){{ old('ket_riwayat_kemoterapi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_riwayat_kemoterapi : '' }}@endif" id="ket_riwayat_kemoterapi" name="ket_riwayat_kemoterapi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_kemoterapi')) {{ old('riwayat_kemoterapi') ==  'pernah' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_kemoterapi == 'pernah' ? '' : 'readonly') : 'readonly' }} @endif> Berapa Kali :
                            <input type="number" readonly value="@if(old('berapa_kali_riwayat_kemoterapi')){{ old('berapa_kali_riwayat_kemoterapi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->berapa_kali_riwayat_kemoterapi : '' }}@endif" id="berapa_kali_riwayat_kemoterapi" name="berapa_kali_riwayat_kemoterapi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_kemoterapi')) {{ old('riwayat_kemoterapi') ==  'pernah' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_kemoterapi == 'pernah' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            9. Riwayat Radioterapi
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden">
                            <input onclick="cek_radio_riwayat_radioterapi()" @if(old('riwayat_radioterapi')) {{ old('riwayat_radioterapi') ==  'tidak_pernah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_radioterapi == 'tidak_pernah' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak_pernah" name="radio_riwayat_radioterapi"> Tidak Pernah
                        </td>
                        <td style="border-left: hidden" colspan="2">
                            <input onclick="cek_radio_riwayat_radioterapi()" @if(old('riwayat_radioterapi')) {{ old('riwayat_radioterapi') ==  'pernah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_radioterapi == 'pernah' ? 'checked' : '') : '' }} @endif type="radio" value="pernah" name="radio_riwayat_radioterapi"> Pernah, Kapan :
                            <input type="datetime-local" readonly value="@if(old('ket_riwayat_radioterapi')){{ old('ket_riwayat_radioterapi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_riwayat_radioterapi : '' }}@endif" id="ket_riwayat_radioterapi" name="ket_riwayat_radioterapi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_radioterapi')) {{ old('riwayat_radioterapi') ==  'pernah' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_radioterapi == 'pernah' ? '' : 'readonly') : 'readonly' }} @endif> Berapa Kali :
                            <input type="number" readonly value="@if(old('berapa_kali_riwayat_radioterapi')){{ old('berapa_kali_riwayat_radioterapi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->berapa_kali_riwayat_radioterapi : '' }}@endif" id="berapa_kali_riwayat_radioterapi" name="berapa_kali_riwayat_radioterapi" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_radioterapi')) {{ old('riwayat_radioterapi') ==  'pernah' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->riwayat_radioterapi == 'pernah' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            10. Golongan Darah / Rh
                            <span style="float: right">: </span>

                        </td>
                        <td style="border-left: hidden" colspan="3">
                            <input @if(old('golongan_darah')) {{ old('golongan_darah') ==  'A' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->golongan_darah == 'A' ? 'checked' : '') : '' }} @endif type="radio" value="A" name="radio_golongan_darah"> A
                            <input @if(old('golongan_darah')) {{ old('golongan_darah') ==  'B' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->golongan_darah == 'B' ? 'checked' : '') : '' }} @endif type="radio" value="B" name="radio_golongan_darah" class="ml-4"> B
                            <input @if(old('golongan_darah')) {{ old('golongan_darah') ==  'O' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->golongan_darah == 'O' ? 'checked' : '') : '' }} @endif type="radio" value="O" name="radio_golongan_darah" class="ml-4"> O
                            <input @if(old('golongan_darah')) {{ old('golongan_darah') ==  'AB' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->golongan_darah == 'AB' ? 'checked' : '') : '' }} @endif type="radio" value="AB" name="radio_golongan_darah" class="ml-4"> AB
                            <span style="margin-left: 50px">Rh :</span>
                            <input @if(old('rh')) {{ old('rh') ==  'positif' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->rh == 'positif' ? 'checked' : '') : '' }} @endif type="radio" value="positif" name="radio_rh"> Positif
                            <input @if(old('rh')) {{ old('rh') ==  'negatif' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->rh == 'negatif' ? 'checked' : '') : '' }} @endif type="radio" value="negatif" name="radio_rh" class="ml-4"> Negatif
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
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'tampak_tidak_sakit' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->keadaan_umum == 'tampak_tidak_sakit' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tampak_tidak_sakit" name="radio_keadaan_umum_p"> Tampak Tidak Sakit
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'sakit_ringan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->keadaan_umum == 'sakit_ringan' ? 'checked' : '') : '' }} @endif type="radio" value="sakit_ringan" name="radio_keadaan_umum_p" class="ml-4"> Sakit Ringan
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'sakit_sedang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->keadaan_umum == 'sakit_sedang' ? 'checked' : '') : '' }} @endif type="radio" value="sakit_sedang" name="radio_keadaan_umum_p" class="ml-4"> Sakit Sedang
                            <input @if(old('keadaan_umum')) {{ old('keadaan_umum') ==  'sakit_berat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->keadaan_umum == 'sakit_berat' ? 'checked' : '') : '' }} @endif type="radio" value="sakit_berat" name="radio_keadaan_umum_p" class="ml-4"> Sakit Berat
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%">2. Kesadaran</td>
                        <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                        <td colspan="4">
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->kesadaran == 'compos_mentis' ? 'checked' : '') : 'checked' }} @endif type="radio" value="compos_mentis" name="radio_kesadaran_p"> Compos Mentis
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'apatis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->kesadaran == 'apatis' ? 'checked' : '') : '' }} @endif type="radio" value="apatis" name="radio_kesadaran_p" class="ml-4"> Apatis
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'somnolen' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->kesadaran == 'somnolen' ? 'checked' : '') : '' }} @endif type="radio" value="somnolen" name="radio_kesadaran_p" class="ml-4"> Somnolen
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'sopor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->kesadaran == 'sopor' ? 'checked' : '') : '' }} @endif type="radio" value="sopor" name="radio_kesadaran_p" class="ml-4"> Sopor
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'sopor_koma' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->kesadaran == 'sopor_koma' ? 'checked' : '') : '' }} @endif type="radio" value="sopor_koma" name="radio_kesadaran_p" class="ml-4"> Sopor koma
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%"></td>
                        <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                        <td colspan="4">
                            <input @if(old('kesadaran')) {{ old('kesadaran') ==  'koma' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->anamnesis)->kesadaran == 'koma' ? 'checked' : '') : '' }} @endif type="radio" value="koma" name="radio_kesadaran_p"> koma
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%">3. GCS</td>
                        <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                        <td colspan="4">
                            <div class="row">
                                <div class="col-md-4">
                                    E : <input type="text" value="@if(old('e_kesadaran')){{ old('e_kesadaran') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->e_kesadaran : '' }}@endif" id="e_kesadaran_p" name="e_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-4">
                                    M : <input type="text" value="@if(old('m_kesadaran')){{ old('m_kesadaran') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->m_kesadaran : '' }}@endif" id="m_kesadaran_p" name="m_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-4">
                                    V : <input type="text" value="@if(old('v_kesadaran')){{ old('v_kesadaran') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->v_kesadaran : '' }}@endif" id="v_kesadaran_p" name="v_kesadaran" style="border: 0; border-bottom: 2px dotted;">
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
                                    TD <input type="text" value="@if(old('td')){{ old('td') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->td : '' }}@endif" id="td" name="td" style="border: 0; border-bottom: 2px dotted; width: 50px"> mmHg
                                </div>
                                <div class="col-md-2">
                                    RR <input type="text" value="@if(old('rr')){{ old('rr') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rr : '' }}@endif" id="rr" name="rr" style="border: 0; border-bottom: 2px dotted; width: 50px"> x/menit
                                </div>
                                <div class="col-md-2">
                                    Nadi <input type="text" value="@if(old('nadi')){{ old('nadi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->nadi : '' }}@endif" id="nadi" name="nadi" style="border: 0; border-bottom: 2px dotted; width: 50px"> x/menit
                                </div>
                                <div class="col-md-2">
                                    Suhu <input type="text" value="@if(old('suhu')){{ old('suhu') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->suhu : '' }}@endif" id="suhu" name="suhu" style="border: 0; border-bottom: 2px dotted; width: 50px"> ᵒC
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
                                    BB : <input type="text" value="@if(old('bb')){{ old('bb') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->bb : '' }}@endif" id="bb" name="bb" style="border: 0; border-bottom: 2px dotted; width: 50px"> kg
                                </div>
                                <div class="col-md-3">
                                    TB : <input type="text" value="@if(old('tb')){{ old('tb') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->tb : '' }}@endif" id="tb" name="tb" style="border: 0; border-bottom: 2px dotted; width: 50px"> cm
                                </div>
                                <div class="col-md-3">
                                    Lingkar Kepala : <input type="text" value="@if(old('lingkar_kepala')){{ old('lingkar_kepala') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->lingkar_kepala : '' }}@endif" id="lingkar_kepala" name="lingkar_kepala" style="border: 0; border-bottom: 2px dotted; width: 50px"> cm
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Lingkar Dada : <input type="text" value="@if(old('lingkar_dada')){{ old('lingkar_dada') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->lingkar_dada : '' }}@endif" id="lingkar_dada" name="lingkar_dada" style="border: 0; border-bottom: 2px dotted; width: 50px"> cm
                                </div>
                                <div class="col-md-3">
                                    Lingkar Perut : <input type="text" value="@if(old('lingkar_perut')){{ old('lingkar_perut') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->lingkar_perut : '' }}@endif" id="lingkar_perut" name="lingkar_perut" style="border: 0; border-bottom: 2px dotted; width: 50px"> cm
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
                </table>
                <div class="pagebreak"></div>
                <table style="width: 100%; border-top: hidden" class="table_isian">
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
                                    <input @if(old('kesadaran_persistem')) {{ old('kesadaran_persistem') ==  'compos_mentis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesadaran_persistem == 'compos_mentis' ? 'checked' : '') : 'checked' }} @endif type="radio" value="compos_mentis" name="radio_kesadaran_persistem"> Compos Mentis
                                    <input @if(old('kesadaran_persistem')) {{ old('kesadaran_persistem') ==  'apatis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesadaran_persistem == 'apatis' ? 'checked' : '') : '' }} @endif type="radio" value="apatis" name="radio_kesadaran_persistem" class="ml-4"> Apatis
                                    <input @if(old('kesadaran_persistem')) {{ old('kesadaran_persistem') ==  'somnolen' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesadaran_persistem == 'somnolen' ? 'checked' : '') : '' }} @endif type="radio" value="somnolen" name="radio_kesadaran_persistem" class="ml-4"> Somnolen
                                    <input @if(old('kesadaran_persistem')) {{ old('kesadaran_persistem') ==  'sopor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesadaran_persistem == 'sopor' ? 'checked' : '') : '' }} @endif type="radio" value="sopor" name="radio_kesadaran_persistem" class="ml-4"> Sopor
                                    <input @if(old('kesadaran_persistem')) {{ old('kesadaran_persistem') ==  'sopor_koma' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesadaran_persistem == 'sopor_koma' ? 'checked' : '') : '' }} @endif type="radio" value="sopor_koma" name="radio_kesadaran_persistem" class="ml-4"> Sopor koma
                                    <input @if(old('kesadaran_persistem')) {{ old('kesadaran_persistem') ==  'koma' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesadaran_persistem == 'koma' ? 'checked' : '') : '' }} @endif type="radio" value="koma" name="radio_kesadaran_persistem" class="ml-4"> koma
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kepala <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input onclick="cek_radio_kepala()" @if(old('kepala')) {{ old('kepala') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kepala == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_kepala"> TAK
                                    <input onclick="cek_radio_kepala()" @if(old('kepala')) {{ old('kepala') ==  'hydrocephalus' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kepala == 'hydrocephalus' ? 'checked' : '') : '' }} @endif type="radio" value="hydrocephalus" name="radio_kepala" class="ml-4"> Hydrocephalus
                                    <input onclick="cek_radio_kepala()" @if(old('kepala')) {{ old('kepala') ==  'Hematoma' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kepala == 'Hematoma' ? 'checked' : '') : '' }} @endif type="radio" value="Hematoma" name="radio_kepala" class="ml-4"> Hematoma
                                    <input onclick="cek_radio_kepala()" @if(old('kepala')) {{ old('kepala') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kepala == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_kepala" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_kepala')){{ old('ket_kepala') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_kepala : '' }}@endif" id="ket_kepala" name="ket_kepala" style="border: 0; border-bottom: 2px dotted;" @if(old('kepala')) {{ old('kepala') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kepala == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Ubun - ubun <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input onclick="cek_radio_ubun_ubun()" @if(old('ubun_ubun')) {{ old('ubun_ubun') ==  'datar' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->ubun_ubun == 'datar' ? 'checked' : '') : 'checked' }} @endif type="radio" value="datar" name="radio_ubun_ubun"> datar
                                    <input onclick="cek_radio_ubun_ubun()" @if(old('ubun_ubun')) {{ old('ubun_ubun') ==  'cekung' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->ubun_ubun == 'cekung' ? 'checked' : '') : '' }} @endif type="radio" value="cekung" name="radio_ubun_ubun" class="ml-4"> Cekung
                                    <input onclick="cek_radio_ubun_ubun()" @if(old('ubun_ubun')) {{ old('ubun_ubun') ==  'Menonjol' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->ubun_ubun == 'Menonjol' ? 'checked' : '') : '' }} @endif type="radio" value="Menonjol" name="radio_ubun_ubun" class="ml-4"> Menonjol
                                    <input onclick="cek_radio_ubun_ubun()" @if(old('ubun_ubun')) {{ old('ubun_ubun') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->ubun_ubun == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_ubun_ubun" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_ubun_ubun')){{ old('ket_ubun_ubun') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_ubun_ubun : '' }}@endif" id="ket_ubun_ubun" name="ket_ubun_ubun" style="border: 0; border-bottom: 2px dotted;" @if(old('ubun_ubun')) {{ old('ubun_ubun') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->ubun_ubun == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Wajah <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input onclick="cek_radio_wajah()" @if(old('wajah')) {{ old('wajah') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->wajah == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_wajah"> TAK
                                    <input onclick="cek_radio_wajah()" @if(old('wajah')) {{ old('wajah') ==  'Asimetris' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->wajah == 'Asimetris' ? 'checked' : '') : '' }} @endif type="radio" value="Asimetris" name="radio_wajah" class="ml-4"> Asimetris
                                    <input onclick="cek_radio_wajah()" @if(old('wajah')) {{ old('wajah') ==  'kelainan_konginetal' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->wajah == 'kelainan_konginetal' ? 'checked' : '') : '' }} @endif type="radio" value="kelainan_konginetal" name="radio_wajah" class="ml-4"> Kelainan Konginetal
                                    <input type="text" value="@if(old('ket_wajah')){{ old('ket_wajah') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_wajah : '' }}@endif" id="ket_wajah" name="ket_wajah" style="border: 0; border-bottom: 2px dotted;" @if(old('wajah')) {{ old('wajah') == 'kelainan_konginetal' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->wajah == 'kelainan_konginetal' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Leher <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input onclick="cek_radio_leher()" @if(old('leher')) {{ old('leher') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_leher"> TAK
                                    <input onclick="cek_radio_leher()" @if(old('leher')) {{ old('leher') ==  'Kaku Kuduk' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'Kaku Kuduk' ? 'checked' : '') : '' }} @endif type="radio" value="Kaku Kuduk" name="radio_leher" class="ml-4"> Kaku Kuduk
                                    <input onclick="cek_radio_leher()" @if(old('leher')) {{ old('leher') ==  'Pembesaran Tiroid' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'Pembesaran Tiroid' ? 'checked' : '') : '' }} @endif type="radio" value="Pembesaran Tiroid" name="radio_leher" class="ml-4"> Pembesaran Tiroid
                                    <br>
                                    <input onclick="cek_radio_leher()" @if(old('leher')) {{ old('leher') ==  'Pembesaran KGB' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'Pembesaran KGB' ? 'checked' : '') : '' }} @endif type="radio" value="Pembesaran KGB" name="radio_leher"> Pembesaran KGB
                                    <input onclick="cek_radio_leher()" @if(old('leher')) {{ old('leher') ==  'Keterbatasan Gerak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'Keterbatasan Gerak' ? 'checked' : '') : '' }} @endif type="radio" value="Keterbatasan Gerak" name="radio_leher" class="ml-4"> Keterbatasan Gerak
                                    <input onclick="cek_radio_leher()" @if(old('leher')) {{ old('leher') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_leher" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_leher')){{ old('ket_leher') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_leher : '' }}@endif" id="ket_leher" name="ket_leher" style="border: 0; border-bottom: 2px dotted;" @if(old('leher')) {{ old('leher') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kejang <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input onclick="cek_radio_kejang()" @if(old('kejang')) {{ old('kejang') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kejang == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_kejang"> Tidak
                                    <input onclick="cek_radio_kejang()" @if(old('kejang')) {{ old('kejang') ==  'ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kejang == 'ada' ? 'checked' : '') : '' }} @endif type="radio" value="ada" name="radio_kejang" class="ml-4"> Ada, Type :
                                    <input type="text" value="@if(old('ket_kejang')){{ old('ket_kejang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_kejang : '' }}@endif" id="ket_kejang" name="ket_kejang" style="border: 0; border-bottom: 2px dotted;" @if(old('kejang')) {{ old('kejang') == 'ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kejang == 'ada' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Sensorik <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('sensorik')) {{ old('sensorik') ==  'Tidak Ada Kelainan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sensorik == 'Tidak Ada Kelainan' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada Kelainan" name="radio_sensorik"> Tidak Ada Kelainan
                                    <input @if(old('sensorik')) {{ old('sensorik') ==  'Sakit Nyeri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sensorik == 'Sakit Nyeri' ? 'checked' : '') : '' }} @endif type="radio" value="Sakit Nyeri" name="radio_sensorik" class="ml-4"> Sakit Nyeri
                                    <input @if(old('sensorik')) {{ old('sensorik') ==  'Rasa Kebas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sensorik == 'Rasa Kebas' ? 'checked' : '') : '' }} @endif type="radio" value="Rasa Kebas" name="radio_sensorik" class="ml-4"> Rasa Kebas
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Motorik <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('motorik')) {{ old('motorik') ==  'Hemiparese' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->motorik == 'Hemiparese' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Hemiparese" name="radio_motorik"> Hemiparese
                                    <input @if(old('motorik')) {{ old('motorik') ==  'Tetraparese' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->motorik == 'Tetraparese' ? 'checked' : '') : '' }} @endif type="radio" value="Tetraparese" name="radio_motorik" class="ml-4"> Tetraparese
                                    <input @if(old('motorik')) {{ old('motorik') ==  'Tidak Ada Kelainan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->motorik == 'Tidak Ada Kelainan' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Ada Kelainan" name="radio_motorik" class="ml-4"> Tidak Ada Kelainan
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kekuatan Otot <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('kekuatan_otot')) {{ old('kekuatan_otot') ==  'Kuat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Kuat' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Kuat" name="radio_kekuatan_otot"> Kuat
                                    <input @if(old('kekuatan_otot')) {{ old('kekuatan_otot') ==  'Lemah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Lemah' ? 'checked' : '') : '' }} @endif type="radio" value="Lemah" name="radio_kekuatan_otot" class="ml-4"> Lemah
                                </div>
                            </div>
                        </td>
                    <tr style="border: 1px solid">
                        <td style="width: 15%; border: 1px solid;">Sistem Penglihatan</td>
                        <td style="border: 1px solid" colspan="5">
                            <div class="row">
                                <div class="col-md-2">Posisi Mata <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('posisi_mata')) {{ old('posisi_mata') ==  'Simetris' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Simetris' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Simetris" name="radio_posisi_mata"> Simetris
                                    <input @if(old('posisi_mata')) {{ old('posisi_mata') ==  'Asimetris' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Asimetris' ? 'checked' : '') : '' }} @endif type="radio" value="Asimetris" name="radio_posisi_mata" class="ml-4"> Asimetris
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Pupil <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('pupil')) {{ old('pupil') ==  'Isokor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Isokor' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Isokor" name="radio_pupil"> Isokor
                                    <input @if(old('pupil')) {{ old('pupil') ==  'Anisokor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Anisokor' ? 'checked' : '') : '' }} @endif type="radio" value="Anisokor" name="radio_pupil" class="ml-4"> Anisokor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kelopak Mata <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('kelopak_mata')) {{ old('kelopak_mata') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelopak_mata == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_kelopak_mata"> TAK
                                    <input @if(old('kelopak_mata')) {{ old('kelopak_mata') ==  'Edema' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelopak_mata == 'Edema' ? 'checked' : '') : '' }} @endif type="radio" value="Edema" name="radio_kelopak_mata" class="ml-4"> Edema
                                    <input @if(old('kelopak_mata')) {{ old('kelopak_mata') ==  'Cekung' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelopak_mata == 'Cekung' ? 'checked' : '') : '' }} @endif type="radio" value="Cekung" name="radio_kelopak_mata" class="ml-4"> Cekung
                                    <input @if(old('kelopak_mata')) {{ old('kelopak_mata') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelopak_mata == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_kelopak_mata" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_kelopak_mata')){{ old('ket_kelopak_mata') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_kelopak_mata : '' }}@endif" id="ket_kelopak_mata" name="ket_kelopak_mata" style="border: 0; border-bottom: 2px dotted;" @if(old('kelopak_mata')) {{ old('kelopak_mata') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelopak_mata == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Konjungtiva <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('konjungtiva')) {{ old('konjungtiva') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->konjungtiva == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_konjungtiva"> TAK
                                    <input @if(old('konjungtiva')) {{ old('konjungtiva') ==  'Anemis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->konjungtiva == 'Anemis' ? 'checked' : '') : '' }} @endif type="radio" value="Anemis" name="radio_konjungtiva" class="ml-4"> Anemis
                                    <input @if(old('konjungtiva')) {{ old('konjungtiva') ==  'Konjungtivitis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->konjungtiva == 'Konjungtivitis' ? 'checked' : '') : '' }} @endif type="radio" value="Konjungtivitis" name="radio_konjungtiva" class="ml-4"> Konjungtivitis
                                    <input @if(old('konjungtiva')) {{ old('konjungtiva') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->konjungtiva == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_konjungtiva" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_konjungtiva')){{ old('ket_konjungtiva') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_konjungtiva : '' }}@endif" id="ket_konjungtiva" name="ket_konjungtiva" style="border: 0; border-bottom: 2px dotted;" @if(old('konjungtiva')) {{ old('konjungtiva') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->konjungtiva == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Seklera <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('seklera')) {{ old('seklera') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->seklera == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_seklera"> TAK
                                    <input @if(old('seklera')) {{ old('seklera') ==  'Ikterik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->seklera == 'Ikterik' ? 'checked' : '') : '' }} @endif type="radio" value="Ikterik" name="radio_seklera" class="ml-4"> Ikterik
                                    <input @if(old('seklera')) {{ old('seklera') ==  'Pendarahan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->seklera == 'Pendarahan' ? 'checked' : '') : '' }} @endif type="radio" value="Pendarahan" name="radio_seklera" class="ml-4"> Pendarahan
                                    <input @if(old('seklera')) {{ old('seklera') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->seklera == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_seklera" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_seklera')){{ old('ket_seklera') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_seklera : '' }}@endif" id="ket_seklera" name="ket_seklera" style="border: 0; border-bottom: 2px dotted;" @if(old('seklera')) {{ old('seklera') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->seklera == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Alat Bantu Penglihatan <span style="float: right">:</span></div>
                                <div class="col-md-9">
                                    <input @if(old('alat_bantu_penglihatan')) {{ old('alat_bantu_penglihatan') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_bantu_penglihatan == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_alat_bantu_penglihatan"> Tidak
                                    <input @if(old('alat_bantu_penglihatan')) {{ old('alat_bantu_penglihatan') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_bantu_penglihatan == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_alat_bantu_penglihatan" class="ml-4"> Ya :
                                    <input @if(old('detail_alat_bantu_penglihatan')) {{ old('detail_alat_bantu_penglihatan') ==  'Mata Palsu' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_alat_bantu_penglihatan == 'Mata Palsu' ? 'checked' : '') : '' }} @endif type="radio" {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_bantu_penglihatan == 'Ya' ? '' : 'disabled') : 'disabled' }} value="Mata Palsu" name="radio_detail_alat_bantu_penglihatan" class="ml-4"> Mata Palsu
                                    <input @if(old('detail_alat_bantu_penglihatan')) {{ old('detail_alat_bantu_penglihatan') ==  'Kaca Mata' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_alat_bantu_penglihatan == 'Kaca Mata' ? 'checked' : '') : '' }} @endif type="radio" {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_bantu_penglihatan == 'Ya' ? '' : 'disabled') : 'disabled' }} value="Kaca Mata" name="radio_detail_alat_bantu_penglihatan" class="ml-4"> Kaca Mata
                                    <input @if(old('detail_alat_bantu_penglihatan')) {{ old('detail_alat_bantu_penglihatan') ==  'Lensa Kontak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_alat_bantu_penglihatan == 'Lensa Kontak' ? 'checked' : '') : '' }} @endif type="radio" {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_bantu_penglihatan == 'Ya' ? '' : 'disabled') : 'disabled' }} value="Lensa Kontak" name="radio_detail_alat_bantu_penglihatan" class="ml-4"> Lensa Kontak
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="border: 1px solid">
                        <td style="width: 15%; border: 1px solid;">Sistem Pendengaran</td>
                        <td style="border: 1px solid" colspan="5">
                            <div class="row">
                                <div class="col-md-12">
                                    <input @if(old('sistem_pendengaran')) {{ old('sistem_pendengaran') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_pendengaran == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_sistem_pendengaran"> TAK
                                    <input @if(old('sistem_pendengaran')) {{ old('sistem_pendengaran') ==  'Nyeri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_pendengaran == 'Nyeri' ? 'checked' : '') : '' }} @endif type="radio" value="Nyeri" name="radio_sistem_pendengaran" class="ml-4"> Nyeri
                                    <input @if(old('sistem_pendengaran')) {{ old('sistem_pendengaran') ==  'Tuli' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_pendengaran == 'Tuli' ? 'checked' : '') : '' }} @endif type="radio" value="Tuli" name="radio_sistem_pendengaran" class="ml-4"> Tuli
                                    <input @if(old('sistem_pendengaran')) {{ old('sistem_pendengaran') ==  'Keluar Cairan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_pendengaran == 'Keluar Cairan' ? 'checked' : '') : '' }} @endif type="radio" value="Keluar Cairan" name="radio_sistem_pendengaran" class="ml-4"> Keluar Cairan
                                    <input @if(old('sistem_pendengaran')) {{ old('sistem_pendengaran') ==  'Berdengung' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_pendengaran == 'Berdengung' ? 'checked' : '') : '' }} @endif type="radio" value="Berdengung" name="radio_sistem_pendengaran" class="ml-4"> Berdengung
                                    <input @if(old('sistem_pendengaran')) {{ old('sistem_pendengaran') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_pendengaran == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_sistem_pendengaran" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_sistem_pendengaran')){{ old('ket_sistem_pendengaran') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_sistem_pendengaran : '' }}@endif" id="ket_sistem_pendengaran" name="ket_sistem_pendengaran" style="border: 0; border-bottom: 2px dotted;" @if(old('sistem_pendengaran')) {{ old('sistem_pendengaran') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_pendengaran == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                    <br>
                                    Menggunakan alat bantu pendengaran :
                                    <input @if(old('alat_bantu_pendengaran')) {{ old('alat_bantu_pendengaran') ==  'ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_bantu_pendengaran == 'ya' ? 'checked' : '') : '' }} @endif type="radio" value="ya" name="radio_alat_bantu_pendengaran" class="ml-4"> Ya
                                    <input @if(old('alat_bantu_pendengaran')) {{ old('alat_bantu_pendengaran') ==  'tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_bantu_pendengaran == 'tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak" name="radio_alat_bantu_pendengaran" class="ml-4"> Tidak
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="border: 1px solid">
                        <td style="width: 15%; border: 1px solid;">Sistem Penciuman</td>
                        <td style="border: 1px solid" colspan="5">
                            <div class="row">
                                <div class="col-md-12">
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_sistem_penciuman"> TAK
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'Asimetris' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'Asimetris' ? 'checked' : '') : '' }} @endif type="radio" value="Asimetris" name="radio_sistem_penciuman" class="ml-4"> Asimetris
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'Septum Deviasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'Septum Deviasi' ? 'checked' : '') : '' }} @endif type="radio" value="Septum Deviasi" name="radio_sistem_penciuman" class="ml-4"> Septum Deviasi
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'Pengeluaran Cairan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'Pengeluaran Cairan' ? 'checked' : '') : '' }} @endif type="radio" value="Pengeluaran Cairan" name="radio_sistem_penciuman" class="ml-4"> Pengeluaran Cairan
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'Polip' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'Polip' ? 'checked' : '') : '' }} @endif type="radio" value="Polip" name="radio_sistem_penciuman" class="ml-4"> Polip
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'Sinusitis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'Sinusitis' ? 'checked' : '') : '' }} @endif type="radio" value="Sinusitis" name="radio_sistem_penciuman" class="ml-4"> Sinusitis
                                    <br>
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'Epistaksis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'Epistaksis' ? 'checked' : '') : '' }} @endif type="radio" value="Epistaksis" name="radio_sistem_penciuman"> Epistaksis
                                    <input @if(old('sistem_penciuman')) {{ old('sistem_penciuman') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_sistem_penciuman" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_sistem_penciuman')){{ old('ket_sistem_penciuman') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_sistem_penciuman : '' }}@endif" id="ket_sistem_penciuman" name="ket_sistem_penciuman" style="border: 0; border-bottom: 2px dotted;" @if(old('sistem_penciuman')) {{ old('sistem_penciuman') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sistem_penciuman == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
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
                                    <input @if(old('pola_napas')) {{ old('pola_napas') ==  'Normal' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pola_napas == 'Normal' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Normal" name="radio_pola_napas"> Normal
                                    <input @if(old('pola_napas')) {{ old('pola_napas') ==  'Bradipnea' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pola_napas == 'Bradipnea' ? 'checked' : '') : '' }} @endif type="radio" value="Bradipnea" name="radio_pola_napas" class="ml-4"> Bradipnea
                                    <input @if(old('pola_napas')) {{ old('pola_napas') ==  'Tachipnea' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pola_napas == 'Tachipnea' ? 'checked' : '') : '' }} @endif type="radio" value="Tachipnea" name="radio_pola_napas" class="ml-4"> Tachipnea
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Volume Pernapasan <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('volume_pernapasan')) {{ old('volume_pernapasan') ==  'Normal' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->volume_pernapasan == 'Normal' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Normal" name="radio_volume_pernapasan"> Normal
                                    <input @if(old('volume_pernapasan')) {{ old('volume_pernapasan') ==  'Hiperventilasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->volume_pernapasan == 'Hiperventilasi' ? 'checked' : '') : '' }} @endif type="radio" value="Hiperventilasi" name="radio_volume_pernapasan" class="ml-4"> Hiperventilasi
                                    <input @if(old('volume_pernapasan')) {{ old('volume_pernapasan') ==  'Hipoventilasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->volume_pernapasan == 'Hipoventilasi' ? 'checked' : '') : '' }} @endif type="radio" value="Hipoventilasi" name="radio_volume_pernapasan" class="ml-4"> Hipoventilasi
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Jenis Pernapasan <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('jenis_pernapasan')) {{ old('jenis_pernapasan') ==  'Pernapasan Dada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->jenis_pernapasan == 'Pernapasan Dada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Pernapasan Dada" name="radio_jenis_pernapasan"> Pernapasan Dada
                                    <input @if(old('jenis_pernapasan')) {{ old('jenis_pernapasan') ==  'Pernapasan Perut' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->jenis_pernapasan == 'Pernapasan Perut' ? 'checked' : '') : '' }} @endif type="radio" value="Pernapasan Perut" name="radio_jenis_pernapasan" class="ml-4"> Pernapasan Perut
                                    <br>
                                    <input @if(old('jenis_pernapasan')) {{ old('jenis_pernapasan') ==  'alat_bantu_napas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->jenis_pernapasan == 'alat_bantu_napas' ? 'checked' : '') : '' }} @endif type="radio" value="alat_bantu_napas" name="radio_jenis_pernapasan"> Alat Bantu Napas, Sebutkan
                                    <input type="text" value="@if(old('ket_jenis_pernapasan')){{ old('ket_jenis_pernapasan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_jenis_pernapasan : '' }}@endif" id="ket_jenis_pernapasan" name="ket_jenis_pernapasan" style="border: 0; border-bottom: 2px dotted;" @if(old('jenis_pernapasan')) {{ old('jenis_pernapasan') == 'alat_bantu_napas' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->jenis_pernapasan == 'alat_bantu_napas' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Irama Napas <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('irama_napas')) {{ old('irama_napas') ==  'Teratur' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->irama_napas == 'Teratur' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Teratur" name="radio_irama_napas"> Teratur
                                    <input @if(old('irama_napas')) {{ old('irama_napas') ==  'Tidak Teratur' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->irama_napas == 'Tidak Teratur' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Teratur" name="radio_irama_napas" class="ml-4"> Tidak Teratur
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kesulitan Bernapas <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('kesulitan_bernapas')) {{ old('kesulitan_bernapas') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesulitan_bernapas == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_kesulitan_bernapas"> Tidak
                                    <input @if(old('kesulitan_bernapas')) {{ old('kesulitan_bernapas') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesulitan_bernapas == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_kesulitan_bernapas" class="ml-4"> Ya ;
                                    <input @if(old('detail_kesulitan_bernapas')) {{ old('detail_kesulitan_bernapas') ==  'Dyspnea' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_kesulitan_bernapas == 'Dyspnea' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesulitan_bernapas == 'Ya' ? '' : 'disabled') : 'disabled' }} type="radio" value="Dyspnea" name="radio_detail_kesulitan_bernapas" class="ml-4"> Dyspnea
                                    <input @if(old('detail_kesulitan_bernapas')) {{ old('detail_kesulitan_bernapas') ==  'Orthopnea' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_kesulitan_bernapas == 'Orthopnea' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesulitan_bernapas == 'Ya' ? '' : 'disabled') : 'disabled' }} type="radio" value="Orthopnea" name="radio_detail_kesulitan_bernapas" class="ml-4"> Orthopnea
                                    <input @if(old('detail_kesulitan_bernapas')) {{ old('detail_kesulitan_bernapas') ==  'Lain-lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_kesulitan_bernapas == 'Lain-lain' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kesulitan_bernapas == 'Ya' ? '' : 'disabled') : 'disabled' }} type="radio" value="Lain-lain" name="radio_detail_kesulitan_bernapas" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_detail_kesulitan_bernapas')){{ old('ket_detail_kesulitan_bernapas') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_detail_kesulitan_bernapas : '' }}@endif" id="ket_detail_kesulitan_bernapas" name="ket_detail_kesulitan_bernapas" style="border: 0; border-bottom: 2px dotted;" @if(old('detail_kesulitan_bernapas')) {{ old('detail_kesulitan_bernapas') == 'Lain-lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_kesulitan_bernapas == 'Lain-lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Batuk dan Sekresi <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('batuk')) {{ old('batuk') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->batuk == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_batuk"> Tidak
                                    <input @if(old('batuk')) {{ old('batuk') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->batuk == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_batuk" class="ml-4"> Ya ;
                                    <input @if(old('detail_batuk')) {{ old('detail_batuk') ==  'Produktif' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_batuk == 'Produktif' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->batuk == 'Ya' ? '' : 'disabled') : 'disabled' }} type="radio" value="Produktif" name="radio_detail_batuk" class="ml-4"> Produktif
                                    <input @if(old('detail_batuk')) {{ old('detail_batuk') ==  'Non Produktif' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->detail_batuk == 'Non Produktif' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->batuk == 'Ya' ? '' : 'disabled') : 'disabled' }} type="radio" value="Non Produktif" name="radio_detail_batuk" class="ml-4"> Non Produktif
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
                                    <input @if(old('warna_kulit')) {{ old('warna_kulit') ==  'Normal' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_kulit == 'Normal' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Normal" name="radio_warna_kulit"> Normal
                                    <input @if(old('warna_kulit')) {{ old('warna_kulit') ==  'Kemerahan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_kulit == 'Kemerahan' ? 'checked' : '') : '' }} @endif type="radio" value="Kemerahan" name="radio_warna_kulit" class="ml-4"> Kemerahan
                                    <input @if(old('warna_kulit')) {{ old('warna_kulit') ==  'Sianosis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_kulit == 'Sianosis' ? 'checked' : '') : '' }} @endif type="radio" value="Sianosis" name="radio_warna_kulit" class="ml-4"> Sianosis
                                    <input @if(old('warna_kulit')) {{ old('warna_kulit') ==  'Pucat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_kulit == 'Pucat' ? 'checked' : '') : '' }} @endif type="radio" value="Pucat" name="radio_warna_kulit" class="ml-4"> Pucat
                                    <input @if(old('warna_kulit')) {{ old('warna_kulit') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_kulit == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_warna_kulit" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_warna_kulit')){{ old('ket_warna_kulit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_warna_kulit : '' }}@endif" id="ket_warna_kulit" name="ket_warna_kulit" style="border: 0; border-bottom: 2px dotted;" @if(old('warna_kulit')) {{ old('warna_kulit') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_kulit == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Nyeri Dada <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('nyeri_dada')) {{ old('nyeri_dada') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->nyeri_dada == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_nyeri_dada"> Tidak
                                    <input @if(old('nyeri_dada')) {{ old('nyeri_dada') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->nyeri_dada == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_nyeri_dada" class="ml-4"> Ya, Sebutkan
                                    <input type="text" value="@if(old('ket_nyeri_dada')){{ old('ket_nyeri_dada') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_nyeri_dada : '' }}@endif" id="ket_nyeri_dada" name="ket_nyeri_dada" style="border: 0; border-bottom: 2px dotted;" @if(old('nyeri_dada')) {{ old('nyeri_dada') == 'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->nyeri_dada == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Denyut Nadi <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('denyut_nadi')) {{ old('denyut_nadi') ==  'Teratur' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->denyut_nadi == 'Teratur' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Teratur" name="radio_denyut_nadi"> Teratur
                                    <input @if(old('denyut_nadi')) {{ old('denyut_nadi') ==  'Tidak Teratur' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->denyut_nadi == 'Tidak Teratur' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Teratur" name="radio_denyut_nadi" class="ml-4"> Tidak Teratur
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Sirkulasi <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('sirkulasi')) {{ old('sirkulasi') ==  'Akral Hangat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkulasi == 'Akral Hangat' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Akral Hangat" name="radio_sirkulasi"> Akral Hangat
                                    <input @if(old('sirkulasi')) {{ old('sirkulasi') ==  'Akral Dingin' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkulasi == 'Akral Dingin' ? 'checked' : '') : '' }} @endif type="radio" value="Akral Dingin" name="radio_sirkulasi" class="ml-4"> Akral Dingin
                                    <input @if(old('sirkulasi')) {{ old('sirkulasi') ==  'Rasa Kebas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkulasi == 'Rasa Kebas' ? 'checked' : '') : '' }} @endif type="radio" value="Rasa Kebas" name="radio_sirkulasi" class="ml-4"> Rasa Kebas
                                    <input @if(old('sirkulasi')) {{ old('sirkulasi') ==  'Palpitasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkulasi == 'Palpitasi' ? 'checked' : '') : '' }} @endif type="radio" value="Palpitasi" name="radio_sirkulasi" class="ml-4"> Palpitasi
                                    <br>
                                    <input @if(old('sirkulasi')) {{ old('sirkulasi') ==  'Edema' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkulasi == 'Edema' ? 'checked' : '') : '' }} @endif type="radio" value="Edema" name="radio_sirkulasi"> Edema, lokasi
                                    <input type="text" value="@if(old('ket_sirkulasi')){{ old('ket_sirkulasi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_sirkulasi : '' }}@endif" id="ket_sirkulasi" name="ket_sirkulasi" style="border: 0; border-bottom: 2px dotted;" @if(old('sirkulasi')) {{ old('sirkulasi') == 'Edema' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkulasi == 'Edema' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Pulsasi <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('pulsasi')) {{ old('pulsasi') ==  'Kuat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pulsasi == 'Kuat' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Kuat" name="radio_pulsasi"> Kuat
                                    <input @if(old('pulsasi')) {{ old('pulsasi') ==  'Lemah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pulsasi == 'Lemah' ? 'checked' : '') : '' }} @endif type="radio" value="Lemah" name="radio_pulsasi" class="ml-4"> Lemah
                                    <input @if(old('pulsasi')) {{ old('pulsasi') ==  'Lain-lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pulsasi == 'Lain-lain' ? 'checked' : '') : '' }} @endif type="radio" value="Lain-lain" name="radio_pulsasi" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_pulsasi')){{ old('ket_pulsasi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_pulsasi : '' }}@endif" id="ket_pulsasi" name="ket_pulsasi" style="border: 0; border-bottom: 2px dotted;" @if(old('pulsasi')) {{ old('pulsasi') == 'Lain-lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pulsasi == 'Lain-lain' ? '' : 'readonly') : 'readonly' }} @endif>
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
                                    <input @if(old('mulut')) {{ old('mulut') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mulut == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_mulut"> TAK
                                    <input @if(old('mulut')) {{ old('mulut') ==  'Stomatitis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mulut == 'Stomatitis' ? 'checked' : '') : '' }} @endif type="radio" value="Stomatitis" name="radio_mulut" class="ml-4"> Stomatitis
                                    <input @if(old('mulut')) {{ old('mulut') ==  'Mukosa Kering' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mulut == 'Mukosa Kering' ? 'checked' : '') : '' }} @endif type="radio" value="Mukosa Kering" name="radio_mulut" class="ml-4"> Mukosa Kering
                                    <input @if(old('mulut')) {{ old('mulut') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mulut == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_mulut" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_mulut')){{ old('ket_mulut') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_mulut : '' }}@endif" id="ket_mulut" name="ket_mulut" style="border: 0; border-bottom: 2px dotted;" @if(old('mulut')) {{ old('mulut') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mulut == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Gigi <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('gigi')) {{ old('gigi') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gigi == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_gigi"> TAK
                                    <input @if(old('gigi')) {{ old('gigi') ==  'Karies' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gigi == 'Karies' ? 'checked' : '') : '' }} @endif type="radio" value="Karies" name="radio_gigi" class="ml-4"> Karies
                                    <input @if(old('gigi')) {{ old('gigi') ==  'Tambal' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gigi == 'Tambal' ? 'checked' : '') : '' }} @endif type="radio" value="Tambal" name="radio_gigi" class="ml-4"> Tambal
                                    <input @if(old('gigi')) {{ old('gigi') ==  'Goyang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gigi == 'Goyang' ? 'checked' : '') : '' }} @endif type="radio" value="Goyang" name="radio_gigi" class="ml-4"> Goyang
                                    <input @if(old('gigi')) {{ old('gigi') ==  'Gigi Palsu' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gigi == 'Gigi Palsu' ? 'checked' : '') : '' }} @endif type="radio" value="Gigi Palsu" name="radio_gigi" class="ml-4"> Gigi Palsu
                                    <input @if(old('gigi')) {{ old('gigi') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gigi == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_gigi" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_gigi')){{ old('ket_gigi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_gigi : '' }}@endif" id="ket_gigi" name="ket_gigi" style="border: 0; border-bottom: 2px dotted;" @if(old('gigi')) {{ old('gigi') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gigi == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Lidah <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('lidah')) {{ old('lidah') ==  'Bersih' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->lidah == 'Bersih' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Bersih" name="radio_lidah"> Bersih
                                    <input @if(old('lidah')) {{ old('lidah') ==  'Kotor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->lidah == 'Kotor' ? 'checked' : '') : '' }} @endif type="radio" value="Kotor" name="radio_lidah" class="ml-4"> Kotor
                                    <input @if(old('lidah')) {{ old('lidah') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->lidah == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_lidah" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_lidah')){{ old('ket_lidah') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_lidah : '' }}@endif" id="ket_lidah" name="ket_lidah" style="border: 0; border-bottom: 2px dotted;" @if(old('lidah')) {{ old('lidah') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->lidah == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Tenggorokan <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('tenggorokan')) {{ old('tenggorokan') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->tenggorokan == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_tenggorokan"> TAK
                                    <input @if(old('tenggorokan')) {{ old('tenggorokan') ==  'Hiperemis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->tenggorokan == 'Hiperemis' ? 'checked' : '') : '' }} @endif type="radio" value="Hiperemis" name="radio_tenggorokan" class="ml-4"> Hiperemis
                                    <input @if(old('tenggorokan')) {{ old('tenggorokan') ==  'Pembesaran Tonsil' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->tenggorokan == 'Pembesaran Tonsil' ? 'checked' : '') : '' }} @endif type="radio" value="Pembesaran Tonsil" name="radio_tenggorokan" class="ml-4"> Pembesaran Tonsil
                                    <input @if(old('tenggorokan')) {{ old('tenggorokan') ==  'Sakit Menelan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->tenggorokan == 'Sakit Menelan' ? 'checked' : '') : '' }} @endif type="radio" value="Sakit Menelan" name="radio_tenggorokan" class="ml-4"> Sakit Menelan
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Leher <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('leher')) {{ old('leher') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_leher_p"> TAK
                                    <input @if(old('leher')) {{ old('leher') ==  'Pembesaran KGB' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'Pembesaran KGB' ? 'checked' : '') : '' }} @endif type="radio" value="Pembesaran KGB" name="radio_leher_p" class="ml-4"> Pembesaran KGB
                                    <input @if(old('leher')) {{ old('leher') ==  'Kelenjar Tiroid' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->leher == 'Kelenjar Tiroid' ? 'checked' : '') : '' }} @endif type="radio" value="Kelenjar Tiroid" name="radio_leher_p" class="ml-4"> Kelenjar Tiroid
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Abdomen <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_abdomen_p"> TAK
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'Lembek' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'Lembek' ? 'checked' : '') : '' }} @endif type="radio" value="Lembek" name="radio_abdomen_p" class="ml-4"> Lembek
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'Distensi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'Distensi' ? 'checked' : '') : '' }} @endif type="radio" value="Distensi" name="radio_abdomen_p" class="ml-4"> Distensi
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'Kembung' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'Kembung' ? 'checked' : '') : '' }} @endif type="radio" value="Kembung" name="radio_abdomen_p" class="ml-4"> Kembung
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'Asites' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'Asites' ? 'checked' : '') : '' }} @endif type="radio" value="Asites" name="radio_abdomen_p" class="ml-4"> Asites
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'Ada Benjolan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'Ada Benjolan' ? 'checked' : '') : '' }} @endif type="radio" value="Ada Benjolan" name="radio_abdomen_p" class="ml-4"> Ada Benjolan
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'Nyeri Tekan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'Nyeri Tekan' ? 'checked' : '') : '' }} @endif type="radio" value="Nyeri Tekan" name="radio_abdomen_p" class="ml-4"> Nyeri Tekan / Lemas
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Peristaltik Usus <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_abdomen"> TAK
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'bising_usus' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'bising_usus' ? 'checked' : '') : '' }} @endif type="radio" value="bising_usus" name="radio_abdomen" class="ml-4"> Tidak Ada Bising Usus
                                    <input @if(old('abdomen')) {{ old('abdomen') ==  'Hiperperistaltik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->abdomen == 'Hiperperistaltik' ? 'checked' : '') : '' }} @endif type="radio" value="Hiperperistaltik" name="radio_abdomen" class="ml-4"> Hiperperistaltik
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Anus <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('apus')) {{ old('apus') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_apus"> TAK
                                    <input @if(old('apus')) {{ old('apus') ==  'Atresia Ani' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'Atresia Ani' ? 'checked' : '') : '' }} @endif type="radio" value="Atresia Ani" name="radio_apus" class="ml-4"> Atresia Ani
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">BAB <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('bab')) {{ old('bab') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_bab"> TAK
                                    <input @if(old('bab')) {{ old('bab') ==  'Konstipasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'Konstipasi' ? 'checked' : '') : '' }} @endif type="radio" value="Konstipasi" name="radio_bab" class="ml-4"> Konstipasi
                                    <input @if(old('bab')) {{ old('bab') ==  'Melena' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'Melena' ? 'checked' : '') : '' }} @endif type="radio" value="Melena" name="radio_bab" class="ml-4"> Melena
                                    <input @if(old('bab')) {{ old('bab') ==  'Inkontinensia Alvi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'Inkontinensia Alvi' ? 'checked' : '') : '' }} @endif type="radio" value="Inkontinensia Alvi" name="radio_bab" class="ml-4"> Inkontinensia Alvi
                                    <input @if(old('bab')) {{ old('bab') ==  'Colostomy' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'Colostomy' ? 'checked' : '') : '' }} @endif type="radio" value="Colostomy" name="radio_bab" class="ml-4"> Colostomy
                                    <input @if(old('bab')) {{ old('bab') ==  'Diare Frekuensi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'Diare Frekuensi' ? 'checked' : '') : '' }} @endif type="radio" value="Diare Frekuensi" name="radio_bab" class="ml-4"> Diare Frekuensi
                                    <input type="text" value="@if(old('ket_bab')){{ old('ket_bab') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_bab : '' }}@endif" id="ket_bab" name="ket_bab" style="border: 0; border-bottom: 2px dotted;" @if(old('bab')) {{ old('bab') == 'Diare Frekuensi' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bab == 'Diare Frekuensi' ? '' : 'readonly') : 'readonly' }} @endif> / Hari
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
                                    <input @if(old('kebersihan')) {{ old('kebersihan') ==  'Bersih' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kebersihan == 'Bersih' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Bersih" name="radio_kebersihan"> Bersih
                                    <input @if(old('kebersihan')) {{ old('kebersihan') ==  'Kotor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kebersihan == 'Kotor' ? 'checked' : '') : '' }} @endif type="radio" value="Kotor" name="radio_kebersihan" class="ml-4"> Kotor
                                    <input @if(old('kebersihan')) {{ old('kebersihan') ==  'Bau' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kebersihan == 'Bau' ? 'checked' : '') : '' }} @endif type="radio" value="Bau" name="radio_kebersihan" class="ml-4"> Bau
                                    <input @if(old('kebersihan')) {{ old('kebersihan') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kebersihan == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_kebersihan" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_kebersihan')){{ old('ket_kebersihan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_kebersihan : '' }}@endif" id="ket_kebersihan" name="ket_kebersihan" style="border: 0; border-bottom: 2px dotted;" @if(old('kebersihan')) {{ old('kebersihan') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kebersihan == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kelainan <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('kelainan')) {{ old('kelainan') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_kelainan"> TAK
                                    <input @if(old('kelainan')) {{ old('kelainan') ==  'Hipospadia' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'Hipospadia' ? 'checked' : '') : '' }} @endif type="radio" value="Hipospadia" name="radio_kelainan" class="ml-4"> Hipospadia
                                    <input @if(old('kelainan')) {{ old('kelainan') ==  'Hernia' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'Hernia' ? 'checked' : '') : '' }} @endif type="radio" value="Hernia" name="radio_kelainan" class="ml-4"> Hernia
                                    <input @if(old('kelainan')) {{ old('kelainan') ==  'Hidrokel' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'Hidrokel' ? 'checked' : '') : '' }} @endif type="radio" value="Hidrokel" name="radio_kelainan" class="ml-4"> Hidrokel
                                    <input @if(old('kelainan')) {{ old('kelainan') ==  'Ambigous' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'Ambigous' ? 'checked' : '') : '' }} @endif type="radio" value="Ambigous" name="radio_kelainan" class="ml-4"> Ambigous
                                    <br>
                                    <input @if(old('kelainan')) {{ old('kelainan') ==  'Phimosis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'Phimosis' ? 'checked' : '') : '' }} @endif type="radio" value="Phimosis" name="radio_kelainan"> Phimosis
                                    <input @if(old('kelainan')) {{ old('kelainan') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_kelainan" class="ml-4"> Lain-lain
                                    <input type="text" value="@if(old('ket_kelainan')){{ old('ket_kelainan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_kelainan : '' }}@endif" id="ket_kelainan" name="ket_kelainan" style="border: 0; border-bottom: 2px dotted;" @if(old('kelainan')) {{ old('kelainan') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kelainan == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">BAK <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('bak')) {{ old('bak') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_bak"> TAK
                                    <input @if(old('bak')) {{ old('bak') ==  'Anuria' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'Anuria' ? 'checked' : '') : '' }} @endif type="radio" value="Anuria" name="radio_bak" class="ml-4"> Anuria
                                    <input @if(old('bak')) {{ old('bak') ==  'Disuria' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'Disuria' ? 'checked' : '') : '' }} @endif type="radio" value="Disuria" name="radio_bak" class="ml-4"> Disuria
                                    <input @if(old('bak')) {{ old('bak') ==  'Poliuria' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'Poliuria' ? 'checked' : '') : '' }} @endif type="radio" value="Poliuria" name="radio_bak" class="ml-4"> Poliuria
                                    <input @if(old('bak')) {{ old('bak') ==  'Retensi Urin' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'Retensi Urin' ? 'checked' : '') : '' }} @endif type="radio" value="Retensi Urin" name="radio_bak" class="ml-4"> Retensi Urin
                                    <br>
                                    <input @if(old('bak')) {{ old('bak') ==  'Inkontinensia Urin' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'Inkontinensia Urin' ? 'checked' : '') : '' }} @endif type="radio" value="Inkontinensia Urin" name="radio_bak"> Inkontinensia Urin
                                    <input @if(old('bak')) {{ old('bak') ==  'Urostomy' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'Urostomy' ? 'checked' : '') : '' }} @endif type="radio" value="Urostomy" name="radio_bak" class="ml-4"> Urostomy, Warna
                                    <input type="text" value="@if(old('ket_bak')){{ old('ket_bak') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_bak : '' }}@endif" id="ket_bak" name="ket_bak" style="border: 0; border-bottom: 2px dotted;" @if(old('bak')) {{ old('bak') == 'Urostomy' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->bak == 'Urostomy' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="border: 1px solid">
                        <td style="width: 15%; border: 1px solid;">Sistem Reproduksi</td>
                        <td style="border: 1px solid" colspan="5">
                            <div class="row pt-2">
                                <div class="col-md-1">Wanita <span style="float: right">:</span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Menarche <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    Umur :
                                    <input type="text" value="@if(old('umur_menarche')){{ old('umur_menarche') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->umur_menarche : '' }}@endif" id="umur_menarche" name="umur_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;" {{ $layanan->kelamin == 0 ? 'readonly' : '' }}> Th,
                                    Siklus Haid :
                                    <input type="text" value="@if(old('siklus_haid_menarche')){{ old('siklus_haid_menarche') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->siklus_haid_menarche : '' }}@endif" id="siklus_haid_menarche" name="siklus_haid_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;" {{ $layanan->kelamin == 0 ? 'readonly' : '' }}> Hari,
                                    Lama Haid :
                                    <input type="text" value="@if(old('lama_haid_menarche')){{ old('lama_haid_menarche') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->lama_haid_menarche : '' }}@endif" id="lama_haid_menarche" name="lama_haid_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;" {{ $layanan->kelamin == 0 ? 'readonly' : '' }}> Hari,
                                    HPHT
                                    <input type="text" value="@if(old('hpht_menarche')){{ old('hpht_menarche') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->hpht_menarche : '' }}@endif" id="hpht_menarche" name="hpht_menarche" style="width: 100px; border: 0; border-bottom: 2px dotted;" {{ $layanan->kelamin == 0 ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Gangguan Saat Haid <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('gangguan_haid')) {{ old('gangguan_haid') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_haid == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_gangguan_haid" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> TAK
                                    <input @if(old('gangguan_haid')) {{ old('gangguan_haid') ==  'Dismenorhe' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_haid == 'Dismenorhe' ? 'checked' : '') : '' }} @endif type="radio" value="Dismenorhe" name="radio_gangguan_haid" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Dismenorhe
                                    <input @if(old('gangguan_haid')) {{ old('gangguan_haid') ==  'Metroraghi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_haid == 'Metroraghi' ? 'checked' : '') : '' }} @endif type="radio" value="Metroraghi" name="radio_gangguan_haid" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Metroraghi
                                    <input @if(old('gangguan_haid')) {{ old('gangguan_haid') ==  'Spotting' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_haid == 'Spotting' ? 'checked' : '') : '' }} @endif type="radio" value="Spotting" name="radio_gangguan_haid" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Spotting
                                    <input @if(old('gangguan_haid')) {{ old('gangguan_haid') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_haid == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_gangguan_haid" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Lain-lain
                                    <input type="text" value="@if(old('ket_gangguan_haid')){{ old('ket_gangguan_haid') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_gangguan_haid : '' }}@endif" id="ket_gangguan_haid" name="ket_gangguan_haid" style="border: 0; border-bottom: 2px dotted;" @if(old('gangguan_haid')) {{ old('gangguan_haid') == 'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_haid == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif {{ $layanan->kelamin == 0 ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Penggunaan Alat Kontrasepsi <span style="float: right">:</span></div>
                                <div class="col-md-9">
                                    <input @if(old('alat_kontrasepsi')) {{ old('alat_kontrasepsi') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_kontrasepsi == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_alat_kontrasepsi" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Tidak
                                    <input @if(old('alat_kontrasepsi')) {{ old('alat_kontrasepsi') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_kontrasepsi == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_alat_kontrasepsi" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Ya, Sebutkan
                                    <input type="text" value="@if(old('ket_alat_kontrasepsi')){{ old('ket_alat_kontrasepsi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_alat_kontrasepsi : '' }}@endif" id="ket_alat_kontrasepsi" name="ket_alat_kontrasepsi" style="border: 0; border-bottom: 2px dotted;" @if(old('alat_kontrasepsi')) {{ old('alat_kontrasepsi') == 'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->alat_kontrasepsi == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif {{ $layanan->kelamin == 0 ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Payudara <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('payudara')) {{ old('payudara') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->payudara == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_payudara" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> TAK
                                    <span class="ml-4">Asi Sudah : </span>
                                    <input @if(old('payudara')) {{ old('payudara') ==  'Keluar' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->payudara == 'Keluar' ? 'checked' : '') : '' }} @endif type="radio" value="Keluar" name="radio_payudara" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Keluar /
                                    <input @if(old('payudara')) {{ old('payudara') ==  'Belum' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->payudara == 'Belum' ? 'checked' : '') : '' }} @endif type="radio" value="Belum" name="radio_payudara" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Belum
                                    <span class="ml-4">Puting : </span>
                                    <input @if(old('puting')) {{ old('puting') ==  'Menonjol' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->puting == 'Menonjol' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Menonjol" name="radio_puting" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Menonjol /
                                    <input @if(old('puting')) {{ old('puting') ==  'Lecet' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->puting == 'Lecet' ? 'checked' : '') : '' }} @endif type="radio" value="Lecet" name="radio_puting" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Lecet /
                                    <input @if(old('puting')) {{ old('puting') ==  'Masuk Kedalam' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->puting == 'Masuk Kedalam' ? 'checked' : '') : '' }} @endif type="radio" value="Masuk Kedalam" name="radio_puting" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Masuk Kedalam
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Tanda-tanda Mastitis <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('mastitis')) {{ old('mastitis') ==  'Bengkak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mastitis == 'Bengkak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Bengkak" name="radio_mastitis" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Bengkak
                                    <input @if(old('mastitis')) {{ old('mastitis') ==  'Nyeri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mastitis == 'Nyeri' ? 'checked' : '') : '' }} @endif type="radio" value="Nyeri" name="radio_mastitis" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Nyeri
                                    <input @if(old('mastitis')) {{ old('mastitis') ==  'Kemerahan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mastitis == 'Kemerahan' ? 'checked' : '') : '' }} @endif type="radio" value="Kemerahan" name="radio_mastitis" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Kemerahan
                                    <input @if(old('mastitis')) {{ old('mastitis') ==  'Tidak Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->mastitis == 'Tidak Ada' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Ada" name="radio_mastitis" class="ml-4" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Tidak Ada
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Uterus <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    TFU :
                                    <input type="text" value="@if(old('tfu')){{ old('tfu') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->tfu : '' }}@endif" id="tfu" name="tfu" style="border: 0; border-bottom: 2px dotted;" {{ $layanan->kelamin == 0 ? 'readonly' : '' }}>
                                    <span class="ml-4">Kontraksi Uterus : </span>
                                    <input @if(old('kontraksi_uterus')) {{ old('kontraksi_uterus') ==  'Keras' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kontraksi_uterus == 'Keras' ? 'checked' : '') : '' }} @endif type="radio" value="Keras" name="radio_kontraksi_uterus" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Keras /
                                    <input @if(old('kontraksi_uterus')) {{ old('kontraksi_uterus') ==  'Lembek' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kontraksi_uterus == 'Lembek' ? 'checked' : '') : '' }} @endif type="radio" value="Lembek" name="radio_kontraksi_uterus" {{ $layanan->kelamin == 0 ? 'disabled' : '' }}> Lembek
                                </div>
                            </div>
                            <div class="row mt-2" style="border-top:1px solid; width:100%; margin-left: 0;">
                                <div class="col-md-1 pl-0 pt-2">Laki - Laki <span style="float: right">:</span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Sirkumsisi <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('sirkumsisi')) {{ old('sirkumsisi') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkumsisi == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_sirkumsisi" {{ $layanan->kelamin == 1 ? 'disabled' : '' }}> Tidak
                                    <input @if(old('sirkumsisi')) {{ old('sirkumsisi') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->sirkumsisi == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_sirkumsisi" class="ml-4" {{ $layanan->kelamin == 1 ? 'disabled' : '' }}> Ya
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-md-2">Gangguan Prostat <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('gangguan_prostat')) {{ old('gangguan_prostat') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_prostat == 'Tidak' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak" name="radio_gangguan_prostat" {{ $layanan->kelamin == 1 ? 'disabled' : '' }}> Tidak
                                    <input @if(old('gangguan_prostat')) {{ old('gangguan_prostat') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->gangguan_prostat == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_gangguan_prostat" class="ml-4" {{ $layanan->kelamin == 1 ? 'disabled' : '' }}> Ya
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="border: 1px solid">
                        <td style="width: 15%; border: 1px solid;">Sistem Integumen</td>
                        <td style="border: 1px solid" colspan="5">
                            <div class="row">
                                <div class="col-md-2">Turgor <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('turgo')) {{ old('turgo') ==  'Baik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->turgo == 'Baik' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Baik" name="radio_turgo"> Baik, Elasti
                                    <input @if(old('turgo')) {{ old('turgo') ==  'Sedang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->turgo == 'Sedang' ? 'checked' : '') : '' }} @endif type="radio" value="Sedang" name="radio_turgo" class="ml-4"> Sedang
                                    <input @if(old('turgo')) {{ old('turgo') ==  'Buruk' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->turgo == 'Buruk' ? 'checked' : '') : '' }} @endif type="radio" value="Buruk" name="radio_turgo" class="ml-4"> Buruk
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Warna <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('warna_integumen')) {{ old('warna_integumen') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_integumen == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_warna_integumen"> TAK
                                    <input @if(old('warna_integumen')) {{ old('warna_integumen') ==  'Ikterik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_integumen == 'Ikterik' ? 'checked' : '') : '' }} @endif type="radio" value="Ikterik" name="radio_warna_integumen" class="ml-4"> Ikterik
                                    <input @if(old('warna_integumen')) {{ old('warna_integumen') ==  'Pucat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->warna_integumen == 'Pucat' ? 'checked' : '') : '' }} @endif type="radio" value="Pucat" name="radio_warna_integumen" class="ml-4"> Pucat
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Integritas <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('integritas')) {{ old('integritas') ==  'Utuh' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->integritas == 'Utuh' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Utuh" name="radio_integritas"> Utuh
                                    <input @if(old('integritas')) {{ old('integritas') ==  'Dekubitus' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->integritas == 'Dekubitus' ? 'checked' : '') : '' }} @endif type="radio" value="Dekubitus" name="radio_integritas" class="ml-4"> Dekubitus
                                    <input @if(old('integritas')) {{ old('integritas') ==  'Rash' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->integritas == 'Rash' ? 'checked' : '') : '' }} @endif type="radio" value="Rash" name="radio_integritas" class="ml-4"> Rash / ruam
                                    <input @if(old('integritas')) {{ old('integritas') ==  'Ptekiae' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->integritas == 'Ptekiae' ? 'checked' : '') : '' }} @endif type="radio" value="Ptekiae" name="radio_integritas" class="ml-4"> Ptekiae
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Kriteria Risiko Dekubitus <span style="float: right">:</span></div>
                                <div class="col-md-8">
                                    <input @if(old('dekubituas')) {{ old('dekubituas') ==  'Usia > 65' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'Usia > 65' ? 'checked' : '') : '' }} @endif type="radio" value="Usia > 65" name="radio_dekubituas"> Usia > 65
                                    <input @if(old('dekubituas')) {{ old('dekubituas') ==  'Obesitas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'Obesitas' ? 'checked' : '') : '' }} @endif type="radio" value="Obesitas" name="radio_dekubituas" class="ml-4"> Obesitas
                                    <input @if(old('dekubituas')) {{ old('dekubituas') ==  'Pasien Immobilisasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'Pasien Immobilisasi' ? 'checked' : '') : '' }} @endif type="radio" value="Pasien Immobilisasi" name="radio_dekubituas" class="ml-4"> Pasien Immobilisasi
                                    <br>
                                    <input @if(old('dekubituas')) {{ old('dekubituas') ==  'Rawat Niccu' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'Rawat Niccu' ? 'checked' : '') : '' }} @endif type="radio" value="Rawat Niccu" name="radio_dekubituas"> Rawat Niccu/PICUICU
                                    <input @if(old('dekubituas')) {{ old('dekubituas') ==  'Paraplezi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'Paraplezi' ? 'checked' : '') : '' }} @endif type="radio" value="Paraplezi" name="radio_dekubituas" class="ml-4"> Paraplezi
                                    <input @if(old('dekubituas')) {{ old('dekubituas') ==  'Inkontenensia uri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'Inkontenensia uri' ? 'checked' : '') : '' }} @endif type="radio" value="Inkontenensia uri" name="radio_dekubituas" class="ml-4"> Inkontenensia uri/alvi
                                    <br>
                                    <input @if(old('dekubituas')) {{ old('dekubituas') ==  'penyakit_kronis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'penyakit_kronis' ? 'checked' : '') : '' }} @endif type="radio" value="penyakit_kronis" name="radio_dekubituas"> Penyakit Kronis
                                    <input type="text" value="@if(old('ket_dekubituas')){{ old('ket_dekubituas') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_dekubituas : '' }}@endif" id="ket_dekubituas" name="ket_dekubituas" style="border: 0; border-bottom: 2px dotted;" @if(old('dekubituas')) {{ old('dekubituas') == 'penyakit_kronis' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->dekubituas == 'penyakit_kronis' ? '' : 'readonly') : 'readonly' }} @endif>
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
                                    <input @if(old('pergerakan_sendi')) {{ old('pergerakan_sendi') ==  'Bebas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pergerakan_sendi == 'Bebas' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Bebas" name="radio_pergerakan_sendi"> Bebas
                                    <input @if(old('pergerakan_sendi')) {{ old('pergerakan_sendi') ==  'Terbatas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->pergerakan_sendi == 'Terbatas' ? 'checked' : '') : '' }} @endif type="radio" value="Terbatas" name="radio_pergerakan_sendi" class="ml-4"> Terbatas
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kekuatan Otot <span style="float: right">:</span></div>
                                <div class="col-md-10">
                                    <input @if(old('kekuatan_otot')) {{ old('kekuatan_otot') ==  'Baik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Baik' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Baik" name="radio_kekuatan_otot_m"> Baik
                                    <input @if(old('kekuatan_otot')) {{ old('kekuatan_otot') ==  'Lemah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Lemah' ? 'checked' : '') : '' }} @endif type="radio" value="Lemah" name="radio_kekuatan_otot_m" class="ml-4"> Lemah
                                    <input @if(old('kekuatan_otot')) {{ old('kekuatan_otot') ==  'Tremor' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->kekuatan_otot == 'Tremor' ? 'checked' : '') : '' }} @endif type="radio" value="Tremor" name="radio_kekuatan_otot_m" class="ml-4"> Tremor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Nyeri Sendi <span style="float: right">:</span></div>
                                <div class="col-md-8">
                                    <input @if(old('nyeri_sendi')) {{ old('nyeri_sendi') ==  'Tidak Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->nyeri_sendi == 'Tidak Ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada" name="radio_nyeri_sendi"> Tidak Ada
                                    <input @if(old('nyeri_sendi')) {{ old('nyeri_sendi') ==  'Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->nyeri_sendi == 'Ada' ? 'checked' : '') : '' }} @endif type="radio" value="Ada" name="radio_nyeri_sendi" class="ml-4"> Ada, Lokasi
                                    <input type="text" value="@if(old('ket_nyeri_sendi')){{ old('ket_nyeri_sendi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_nyeri_sendi : '' }}@endif" id="ket_nyeri_sendi" name="ket_nyeri_sendi" style="border: 0; border-bottom: 2px dotted;" @if(old('nyeri_sendi')) {{ old('nyeri_sendi') == 'Ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->nyeri_sendi == 'Ada' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Oedema <span style="float: right">:</span></div>
                                <div class="col-md-8">
                                    <input @if(old('oedema')) {{ old('oedema') ==  'Tidak Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->oedema == 'Tidak Ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada" name="radio_oedema"> Tidak Ada
                                    <input @if(old('oedema')) {{ old('oedema') ==  'Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->oedema == 'Ada' ? 'checked' : '') : '' }} @endif type="radio" value="Ada" name="radio_oedema" class="ml-4"> Ada, Lokasi
                                    <input type="text" value="@if(old('ket_oedema')){{ old('ket_oedema') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_oedema : '' }}@endif" id="ket_oedema" name="ket_oedema" style="border: 0; border-bottom: 2px dotted;" @if(old('oedema')) {{ old('oedema') == 'Ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->oedema == 'Ada' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Fraktur <span style="float: right">:</span></div>
                                <div class="col-md-8">
                                    <input @if(old('fraktur')) {{ old('fraktur') ==  'Tidak Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->fraktur == 'Tidak Ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada" name="radio_fraktur"> Tidak Ada
                                    <input @if(old('fraktur')) {{ old('fraktur') ==  'Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->fraktur == 'Ada' ? 'checked' : '') : '' }} @endif type="radio" value="Ada" name="radio_fraktur" class="ml-4"> Ada, Lokasi
                                    <input type="text" value="@if(old('ket_fraktur')){{ old('ket_fraktur') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_fraktur : '' }}@endif" id="ket_fraktur" name="ket_fraktur" style="border: 0; border-bottom: 2px dotted;" @if(old('fraktur')) {{ old('fraktur') == 'Ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->fraktur == 'Ada' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Parese <span style="float: right">:</span></div>
                                <div class="col-md-8">
                                    <input @if(old('parese')) {{ old('parese') ==  'Tidak Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->parese == 'Tidak Ada' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada" name="radio_parese"> Tidak Ada
                                    <input @if(old('parese')) {{ old('parese') ==  'Ada' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->parese == 'Ada' ? 'checked' : '') : '' }} @endif type="radio" value="Ada" name="radio_parese" class="ml-4"> Ada, Lokasi
                                    <input type="text" value="@if(old('ket_parese')){{ old('ket_parese') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_parese : '' }}@endif" id="ket_parese" name="ket_parese" style="border: 0; border-bottom: 2px dotted;" @if(old('parese')) {{ old('parese') == 'Ada' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->persistem)->parese == 'Ada' ? '' : 'readonly') : 'readonly' }} @endif>
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
                            <input @if(old('nyeri')) {{ old('nyeri') ==  'tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->nyeri == 'tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak" name="radio_nyeri"> Tidak
                            <input @if(old('nyeri')) {{ old('nyeri') ==  'ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->nyeri == 'ya' ? 'checked' : '') : '' }} @endif type="radio" value="ya" name="radio_nyeri"> Ya
                        </td>
                        <td colspan="3">
                            Sifat :
                            <input @if(old('sifat_nyeri')) {{ old('sifat_nyeri') ==  'akut' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->sifat_nyeri == 'akut' ? 'checked' : '') : '' }} @endif type="radio" value="akut" name="radio_sifat_nyeri"> Akut
                            <input @if(old('sifat_nyeri')) {{ old('sifat_nyeri') ==  'kronis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->sifat_nyeri == 'kronis' ? 'checked' : '') : '' }} @endif type="radio" value="kronis" name="radio_sifat_nyeri"> Kronis
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
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-2">1. Kualitas Nyeri</div>
                                <div>:</div>
                                <div class="col-md-2">
                                    <input @if(old('kualitas_nyeri')) {{ old('kualitas_nyeri') ==  'nyeri_tumpul' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->kualitas_nyeri == 'nyeri_tumpul' ? 'checked' : '') : '' }} @endif type="radio" value="nyeri_tumpul" name="radio_kualitas_nyeri"> Nyeri Tumpul
                                </div>
                                <div class="col-md-2">
                                    <input @if(old('kualitas_nyeri')) {{ old('kualitas_nyeri') ==  'nyeri_tajam' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : '' }} @endif type="radio" value="nyeri_tajam" name="radio_kualitas_nyeri"> Nyeri Tajam
                                </div>
                                <div class="col-md-2">
                                    <input @if(old('kualitas_nyeri')) {{ old('kualitas_nyeri') ==  'panas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->kualitas_nyeri == 'panas' ? 'checked' : '') : '' }} @endif type="radio" value="panas" name="radio_kualitas_nyeri"> Panas / Terbakar
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">2. Menjalar</div>
                                <div>:</div>
                                <div class="col-md-2">
                                    <input onclick="cek_radio_nyeri_menjalar()" @if(old('nyeri_menjalar')) {{ old('nyeri_menjalar') ==  'tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->menjalar == 'tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="tidak" name="radio_menjalar"> Tidak
                                </div>
                                <div class="col-md-6">
                                    <input onclick="cek_radio_nyeri_menjalar()" @if(old('nyeri_menjalar')) {{ old('nyeri_menjalar') ==  'ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->menjalar == 'ya' ? 'checked' : '') : '' }} @endif type="radio" value="ya" name="radio_menjalar"> Ya, Ke
                                    <input type="text" value="@if(old('ket_nyeri_menjalar')){{ old('ket_nyeri_menjalar') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_nyeri_menjalar : '' }}@endif" id="ket_nyeri_menjalar" name="ket_nyeri_menjalar" style="border: 0; border-bottom: 2px dotted;" @if(old('nyeri_menjalar')) {{ old('nyeri_menjalar') == 'ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->menjalar == 'ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">3. Skor Nyeri</div>
                                <div>:</div>
                                <div class="col-md-9">
                                    <select id="skor_nyeri" name="skor_nyeri" class="form-control" style="width: 15%;">
                                        @for($i = 0; $i<= 10; $i++) <option @if(old('skor_nyeri')) {{ old('skor_nyeri') == $i ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                            {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->skor_nyeri == $i ? 'selected' : '' }}
                                            @endif value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">4. Frekuensi Nyeri</div>
                                <div>:</div>
                                <div class="col-md-2">
                                    <input @if(old('frekuensi_nyeri')) {{ old('frekuensi_nyeri') ==  'jarang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->frekuensi_nyeri == 'jarang' ? 'checked' : '') : '' }} @endif type="radio" value="jarang" name="radio_frekuensi_nyeri"> Jarang
                                </div>
                                <div class="col-md-2">
                                    <input @if(old('frekuensi_nyeri')) {{ old('frekuensi_nyeri') ==  'hilang_timbul' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : '' }} @endif type="radio" value="hilang_timbul" name="radio_frekuensi_nyeri"> Hilang Timbul
                                </div>
                                <div class="col-md-2">
                                    <input @if(old('frekuensi_nyeri')) {{ old('frekuensi_nyeri') ==  'terus_menerus' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->frekuensi_nyeri == 'terus_menerus' ? 'checked' : '') : '' }} @endif type="radio" value="terus_menerus" name="radio_frekuensi_nyeri"> Terus Menerus
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">5. Nyeri Mempengaruhi</div>
                                <div>:</div>
                                <div class="col-md-2">
                                    <input @if(old('pengaruh_nyeri')) {{ old('pengaruh_nyeri') ==  'tidur' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->pengaruh_nyeri == 'tidur' ? 'checked' : '') : '' }} @endif type="radio" value="tidur" name="radio_pengaruh_nyeri"> Tidur
                                </div>
                                <div class="col-md-2">
                                    <input @if(old('pengaruh_nyeri')) {{ old('pengaruh_nyeri') ==  'aktifitas_fisik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : '' }} @endif type="radio" value="aktifitas_fisik" name="radio_pengaruh_nyeri"> Aktifitas Fisik
                                </div>
                                <div class="col-md-2">
                                    <input @if(old('pengaruh_nyeri')) {{ old('pengaruh_nyeri') ==  'konsentrasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->pengaruh_nyeri == 'konsentrasi' ? 'checked' : '') : '' }} @endif type="radio" value="konsentrasi" name="radio_pengaruh_nyeri"> Konsentrasi
                                </div>
                                <div class="col-md-2">
                                    <input @if(old('pengaruh_nyeri')) {{ old('pengaru_nyeri') ==  'emosi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->pengaruh_nyeri == 'emosi' ? 'checked' : '') : '' }} @endif type="radio" value="emosi" name="radio_pengaruh_nyeri"> Emosi
                                </div>
                                <div class="offset-2 col-md-2" style="padding-left: 19px">
                                    <input @if(old('pengaruh_nyeri')) {{ old('pengaru_nyeri') ==  'nafsu_makan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kualifikasi_nyeri)->pengaruh_nyeri == 'nafsu_makan' ? 'checked' : '') : '' }} @endif type="radio" value="nafsu_makan" name="radio_pengaruh_nyeri"> Nafsu Makan
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
                                            <input @if(old('aktifitas_makan_sebelum_sakit')) {{ old('aktifitas_makan_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_makan_sebelum_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_makan_sebelum_sakit"> Mandiri
                                            <input @if(old('aktifitas_makan_sebelum_sakit')) {{ old('aktifitas_makan_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_makan_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_makan_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Mandi <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_mandi_sebelum_sakit')) {{ old('aktifitas_mandi_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_mandi_sebelum_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_mandi_sebelum_sakit"> Mandiri
                                            <input @if(old('aktifitas_mandi_sebelum_sakit')) {{ old('aktifitas_mandi_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_mandi_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_mandi_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Eliminasi <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_eliminasi_sebelum_sakit')) {{ old('aktifitas_eliminasi_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_eliminasi_sebelum_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_eliminasi_sebelum_sakit"> Mandiri
                                            <input @if(old('aktifitas_eliminasi_sebelum_sakit')) {{ old('aktifitas_eliminasi_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_eliminasi_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_eliminasi_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Berpakaian <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_berpakaian_sebelum_sakit')) {{ old('aktifitas_berpakaian_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpakaian_sebelum_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_berpakaian_sebelum_sakit"> Mandiri
                                            <input @if(old('aktifitas_berpakaian_sebelum_sakit')) {{ old('aktifitas_berpakaian_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpakaian_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpakaian_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Berpindah <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_berpindah_sebelum_sakit')) {{ old('aktifitas_berpindah_sebelum_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpindah_sebelum_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_berpindah_sebelum_sakit"> Mandiri
                                            <input @if(old('aktifitas_berpindah_sebelum_sakit')) {{ old('aktifitas_berpindah_sebelum_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpindah_sebelum_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpindah_sebelum_sakit" class="ml-4"> Bantuan Orang Lain
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
                                    <input type="checkbox" onchange="cek_frekuensi_makan_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit != "" ? (in_array('frekuensi_makan_sebelum_sakit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="frekuensi_makan_sebelum_sakit" name="pola_nutrisi_sebelum_sakit[]"> Frekuensi Makan : <input type="text" value="@if(old('frekuensi_makan_sebelum_sakit')){{ old('frekuensi_makan_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->frekuensi_makan_sebelum_sakit : '' }}@endif" id="frekuensi_makan_sebelum_sakit" name="frekuensi_makan_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_jenis_makan_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit != "" ? (in_array('jenis_makan_sebelum_sakit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="jenis_makan_sebelum_sakit" name="pola_nutrisi_sebelum_sakit[]"> Jenis Makanan : <input type="text" value="@if(old('jenis_makan_sebelum_sakit')){{ old('jenis_makan_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jenis_makan_sebelum_sakit : '' }}@endif" id="jenis_makan_sebelum_sakit" name="jenis_makan_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_porsi_makan_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit != "" ? (in_array('porsi_makan_sebelum_sakit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="porsi_makan_sebelum_sakit" name="pola_nutrisi_sebelum_sakit[]"> Porsi Makan : <input type="text" value="@if(old('porsi_makan_sebelum_sakit')){{ old('porsi_makan_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->porsi_makan_sebelum_sakit : '' }}@endif" id="porsi_makan_sebelum_sakit" name="porsi_makan_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> Porsi
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            3. Pola Tidur :
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-4">
                                    Lama Tidur : <input type="text" value="@if(old('lama_tidur_sebelum_sakit')){{ old('lama_tidur_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->lama_tidur_sebelum_sakit : '' }}@endif" id="lama_tidur_sebelum_sakit" name="lama_tidur_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> Jam/hari
                                </div>
                                <div class="col-md-8">
                                    <input @if(old('pola_tidur_sebelum_sakit')) {{ old('pola_tidur_sebelum_sakit') ==  'Tidak Ada Gangguan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->pola_tidur_sebelum_sakit == 'Tidak Ada Gangguan' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Ada Gangguan" name="radio_pola_tidur_sebelum_sakit"> Tidak Ada Gangguan
                                    <input @if(old('pola_tidur_sebelum_sakit')) {{ old('pola_tidur_sebelum_sakit') ==  'Insomnia' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->pola_tidur_sebelum_sakit == 'Insomnia' ? 'checked' : '') : '' }} @endif type="radio" value="Insomnia" name="radio_pola_tidur_sebelum_sakit" class="ml-4"> Insomnia
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
                                    <input type="checkbox" onchange="cek_bak_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit != "" ? (in_array('tidak_ada_kelainan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @else
                                    {{ 'checked' }}
                                    @endif value="tidak_ada_kelainan" name="bak_sebelum_sakit[]"> Tidak Ada Kelainan : <input type="text" value="@if(old('kelinan_bak_sebelum_sakit')){{ old('kelinan_bak_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kelinan_bak_sebelum_sakit : '' }}@endif" id="kelinan_bak_sebelum_sakit" name="kelinan_bak_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bak_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit != "" ? (in_array('warna',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="warna" name="bak_sebelum_sakit[]"> Warna : <input type="text" value="@if(old('warna_bak_sebelum_sakit')){{ old('warna_bak_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->warna_bak_sebelum_sakit : '' }}@endif" id="warna_bak_sebelum_sakit" name="warna_bak_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit != "" ? (in_array('Disuria',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Disuria" name="bak_sebelum_sakit[]"> Disuria
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit != "" ? (in_array('Anuria',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Anuria" name="bak_sebelum_sakit[]"> Anuria
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit != "" ? (in_array('Poll Uria',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Poll Uria" name="bak_sebelum_sakit[]"> Poll Uria
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit != "" ? (in_array('Retensi Urine',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Retensi Urine" name="bak_sebelum_sakit[]"> Retensi Urine
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-1">
                                    BAB <span style="float: right">:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit != "" ? (in_array('tidak_ada_kelainan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @else
                                    {{ 'checked' }}
                                    @endif value="tidak_ada_kelainan" name="bab_sebelum_sakit[]"> Tidak Ada Kelainan : <input type="text" value="@if(old('kelinan_bab_sebelum_sakit')){{ old('kelinan_bab_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kelinan_bab_sebelum_sakit : '' }}@endif" id="kelinan_bab_sebelum_sakit" name="kelinan_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit != "" ? (in_array('warna',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="warna" name="bab_sebelum_sakit[]"> Warna : <input type="text" value="@if(old('warna_bab_sebelum_sakit')){{ old('warna_bab_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->warna_bab_sebelum_sakit : '' }}@endif" id="warna_bab_sebelum_sakit" name="warna_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit != "" ? (in_array('Konsistensi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Konsistensi" name="bab_sebelum_sakit[]"> Konsistensi : <input type="text" value="@if(old('konsistensi_bab_sebelum_sakit')){{ old('konsistensi_bab_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->konsistensi_bab_sebelum_sakit : '' }}@endif" id="konsistensi_bab_sebelum_sakit" name="konsistensi_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-1">
                                    <span style="float: right">:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit != "" ? (in_array('Konstipasi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Konstipasi" name="bab_sebelum_sakit[]"> Konstipasi : <input type="text" value="@if(old('konstipasi_bab_sebelum_sakit')){{ old('konstipasi_bab_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->konstipasi_bab_sebelum_sakit : '' }}@endif" id="konstipasi_bab_sebelum_sakit" name="konstipasi_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bab_sebelum_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit != "" ? (in_array('lain_lain',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_sebelum_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="lain_lain" name="bab_sebelum_sakit[]"> Lain - lain : <input type="text" value="@if(old('ket_bab_sebelum_sakit')){{ old('ket_bab_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_bab_sebelum_sakit : '' }}@endif" id="ket_bab_sebelum_sakit" name="ket_bab_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;">
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
                                    <input @if(old('riwayat_merokok_sebelum_sakit')) {{ old('riwayat_merokok_sebelum_sakit') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_merokok_sebelum_sakit == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_riwayat_merokok_sebelum_sakit"> Tidak
                                    <input @if(old('riwayat_merokok_sebelum_sakit')) {{ old('riwayat_merokok_sebelum_sakit') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_merokok_sebelum_sakit == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_riwayat_merokok_sebelum_sakit" class="ml-4"> Ya, Jumlah/hari
                                    <input type="text" readonly value="@if(old('jumlah_riwayat_merokok_sebelum_sakit')){{ old('jumlah_riwayat_merokok_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jumlah_riwayat_merokok_sebelum_sakit : '' }}@endif" id="jumlah_riwayat_merokok_sebelum_sakit" name="jumlah_riwayat_merokok_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_merokok_sebelum_sakit')) {{ old('riwayat_merokok_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_merokok_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    <span class="ml-4">Lamanya : </span>
                                    <input type="text" readonly value="@if(old('lamanya_riwayat_merokok_sebelum_sakit')){{ old('lamanya_riwayat_merokok_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->lamanya_riwayat_merokok_sebelum_sakit : '' }}@endif" id="lamanya_riwayat_merokok_sebelum_sakit" name="lamanya_riwayat_merokok_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_merokok_sebelum_sakit')) {{ old('riwayat_merokok_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_merokok_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
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
                                    <input @if(old('riwayat_miras_sebelum_sakit')) {{ old('riwayat_miras_sebelum_sakit') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_miras_sebelum_sakit == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_riwayat_miras_sebelum_sakit"> Tidak
                                    <input @if(old('riwayat_miras_sebelum_sakit')) {{ old('riwayat_miras_sebelum_sakit') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_miras_sebelum_sakit == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_riwayat_miras_sebelum_sakit" class="ml-4"> Ya, Jenis
                                    <input type="text" readonly value="@if(old('jenis_riwayat_miras_sebelum_sakit')){{ old('jenis_riwayat_miras_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jenis_riwayat_miras_sebelum_sakit : '' }}@endif" id="jenis_riwayat_miras_sebelum_sakit" name="jenis_riwayat_miras_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_miras_sebelum_sakit')) {{ old('riwayat_miras_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_miras_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    <span class="ml-4">Jumlah/hari : </span>
                                    <input type="text" readonly value="@if(old('jumlah_riwayat_miras_sebelum_sakit')){{ old('jumlah_riwayat_miras_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jumlah_riwayat_miras_sebelum_sakit : '' }}@endif" id="jumlah_riwayat_miras_sebelum_sakit" name="jumlah_riwayat_miras_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_miras_sebelum_sakit')) {{ old('riwayat_miras_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_miras_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
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
                                    <input @if(old('riwayat_obat_penenang_sebelum_sakit')) {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_obat_penenang_sebelum_sakit == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_riwayat_obat_penenang_sebelum_sakit"> Tidak
                                    <input @if(old('riwayat_obat_penenang_sebelum_sakit')) {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_obat_penenang_sebelum_sakit == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_riwayat_obat_penenang_sebelum_sakit" class="ml-4"> Ya, Jenis
                                    <input type="text" readonly value="@if(old('jenis_riwayat_obat_penenang_sebelum_sakit')){{ old('jenis_riwayat_obat_penenang_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jenis_riwayat_obat_penenang_sebelum_sakit : '' }}@endif" id="jenis_riwayat_obat_penenang_sebelum_sakit" name="jenis_riwayat_obat_penenang_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_obat_penenang_sebelum_sakit')) {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_obat_penenang_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    <span class="ml-4">Jumlah/hari : </span>
                                    <input type="text" readonly value="@if(old('jumlah_riwayat_obat_penenang_sebelum_sakit')){{ old('jumlah_riwayat_obat_penenang_sebelum_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jumlah_riwayat_obat_penenang_sebelum_sakit : '' }}@endif" id="jumlah_riwayat_obat_penenang_sebelum_sakit" name="jumlah_riwayat_obat_penenang_sebelum_sakit" style="border: 0; border-bottom: 2px dotted;" @if(old('riwayat_obat_penenang_sebelum_sakit')) {{ old('riwayat_obat_penenang_sebelum_sakit') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->riwayat_obat_penenang_sebelum_sakit == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
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
                                            <input @if(old('aktifitas_makan_saat_sakit')) {{ old('aktifitas_makan_saat_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_makan_saat_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_makan_saat_sakit"> Mandiri
                                            <input @if(old('aktifitas_makan_saat_sakit')) {{ old('aktifitas_makan_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_makan_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_makan_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Mandi <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_mandi_saat_sakit')) {{ old('aktifitas_mandi_saat_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_mandi_saat_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_mandi_saat_sakit"> Mandiri
                                            <input @if(old('aktifitas_mandi_saat_sakit')) {{ old('aktifitas_mandi_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_mandi_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_mandi_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Eliminasi <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_eliminasi_saat_sakit')) {{ old('aktifitas_eliminasi_saat_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_eliminasi_saat_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_eliminasi_saat_sakit"> Mandiri
                                            <input @if(old('aktifitas_eliminasi_saat_sakit')) {{ old('aktifitas_eliminasi_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_eliminasi_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_eliminasi_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Berpakaian <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_berpakaian_saat_sakit')) {{ old('aktifitas_berpakaian_saat_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpakaian_saat_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_berpakaian_saat_sakit"> Mandiri
                                            <input @if(old('aktifitas_berpakaian_saat_sakit')) {{ old('aktifitas_berpakaian_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpakaian_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpakaian_saat_sakit" class="ml-4"> Bantuan Orang Lain
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">Berpindah <span style="float: right;">:</span></div>
                                        <div class="col-md-10">
                                            <input @if(old('aktifitas_berpindah_saat_sakit')) {{ old('aktifitas_berpindah_saat_sakit') ==  'Mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpindah_saat_sakit == 'Mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Mandiri" name="radio_aktifitas_berpindah_saat_sakit"> Mandiri
                                            <input @if(old('aktifitas_berpindah_saat_sakit')) {{ old('aktifitas_berpindah_saat_sakit') ==  'Bantuan Orang Lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->aktifitas_berpindah_saat_sakit == 'Bantuan Orang Lain' ? 'checked' : '') : '' }} @endif type="radio" value="Bantuan Orang Lain" name="radio_aktifitas_berpindah_saat_sakit" class="ml-4"> Bantuan Orang Lain
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
                                    <input type="checkbox" onchange="cek_frekuensi_makan_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit != "" ? (in_array('frekuensi_makan_saat_sakit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="frekuensi_makan_saat_sakit" name="pola_nutrisi_saat_sakit[]"> Frekuensi Makan : <input type="text" value="@if(old('frekuensi_makan_saat_sakit')){{ old('frekuensi_makan_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->frekuensi_makan_saat_sakit : '' }}@endif" id="frekuensi_makan_saat_sakit" name="frekuensi_makan_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_jenis_makan_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit != "" ? (in_array('jenis_makan_saat_sakit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="jenis_makan_saat_sakit" name="pola_nutrisi_saat_sakit[]"> Jenis Makanan : <input type="text" value="@if(old('jenis_makan_saat_sakit')){{ old('jenis_makan_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->jenis_makan_saat_sakit : '' }}@endif" id="jenis_makan_saat_sakit" name="jenis_makan_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_porsi_makan_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit != "" ? (in_array('porsi_makan_saat_sakit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_nutrisi_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="porsi_makan_saat_sakit" name="pola_nutrisi_saat_sakit[]"> Porsi Makan : <input type="text" value="@if(old('porsi_makan_saat_sakit')){{ old('porsi_makan_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->porsi_makan_saat_sakit : '' }}@endif" id="porsi_makan_saat_sakit" name="porsi_makan_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> Porsi
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            3. Pola Tidur :
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-4">
                                    Lama Tidur : <input type="text" value="@if(old('lama_tidur_saat_sakit')){{ old('lama_tidur_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->lama_tidur_saat_sakit : '' }}@endif" id="lama_tidur_saat_sakit" name="lama_tidur_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> Jam/hari
                                </div>
                                <div class="col-md-8">
                                    <input @if(old('pola_tidur_saat_sakit')) {{ old('pola_tidur_saat_sakit') ==  'Tidak Ada Gangguan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->pola_tidur_saat_sakit == 'Tidak Ada Gangguan' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Ada Gangguan" name="radio_pola_tidur_saat_sakit"> Tidak Ada Gangguan
                                    <input @if(old('pola_tidur_saat_sakit')) {{ old('pola_tidur_saat_sakit') ==  'Insomnia' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->pola_kehidupan)->pola_tidur_saat_sakit == 'Insomnia' ? 'checked' : '') : '' }} @endif type="radio" value="Insomnia" name="radio_pola_tidur_saat_sakit" class="ml-4"> Insomnia
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
                                    <input type="checkbox" onchange="cek_bak_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit != "" ? (in_array('tidak_ada_kelainan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit )) ? 'checked' : '') : '' }}
                                    @else
                                    {{ 'checked' }}
                                    @endif value="tidak_ada_kelainan" name="bak_saat_sakit[]"> Tidak Ada Kelainan : <input type="text" value="@if(old('kelinan_bak_saat_sakit')){{ old('kelinan_bak_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kelinan_bak_saat_sakit : '' }}@endif" id="kelinan_bak_saat_sakit" name="kelinan_bak_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bak_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit != "" ? (in_array('warna',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="warna" name="bak_saat_sakit[]"> Warna : <input type="text" value="@if(old('warna_bak_saat_sakit')){{ old('warna_bak_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->warna_bak_saat_sakit : '' }}@endif" id="warna_bak_saat_sakit" name="warna_bak_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit != "" ? (in_array('Disuria',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Disuria" name="bak_saat_sakit[]"> Disuria
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit != "" ? (in_array('Anuria',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Anuria" name="bak_saat_sakit[]"> Anuria
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit != "" ? (in_array('Poll Uria',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Poll Uria" name="bak_saat_sakit[]"> Poll Uria
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit != "" ? (in_array('Retensi Urine',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bak_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Retensi Urine" name="bak_saat_sakit[]"> Retensi Urine
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-1">
                                    BAB <span style="float: right">:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit != "" ? (in_array('tidak_ada_kelainan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit )) ? 'checked' : '') : '' }}
                                    @else
                                    {{ 'checked' }}
                                    @endif value="tidak_ada_kelainan" name="bab_saat_sakit[]"> Tidak Ada Kelainan : <input type="text" value="@if(old('kelinan_bab_saat_sakit')){{ old('kelinan_bab_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->kelinan_bab_saat_sakit : '' }}@endif" id="kelinan_bab_saat_sakit" name="kelinan_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;"> x/hari
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit != "" ? (in_array('warna',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="warna" name="bab_saat_sakit[]"> Warna : <input type="text" value="@if(old('warna_bab_saat_sakit')){{ old('warna_bab_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->warna_bab_saat_sakit : '' }}@endif" id="warna_bab_saat_sakit" name="warna_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit != "" ? (in_array('Konsistensi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Konsistensi" name="bab_saat_sakit[]"> Konsistensi : <input type="text" value="@if(old('konsistensi_bab_saat_sakit')){{ old('konsistensi_bab_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->konsistensi_bab_saat_sakit : '' }}@endif" id="konsistensi_bab_saat_sakit" name="konsistensi_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-1">
                                    <span style="float: right">:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit != "" ? (in_array('Konstipasi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="Konstipasi" name="bab_saat_sakit[]"> Konstipasi : <input type="text" value="@if(old('konstipasi_bab_saat_sakit')){{ old('konstipasi_bab_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->konstipasi_bab_saat_sakit : '' }}@endif" id="konstipasi_bab_saat_sakit" name="konstipasi_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" onchange="cek_bab_saat_sakit()" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit != "" ? (in_array('lain_lain',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->bab_saat_sakit )) ? 'checked' : '') : '' }}
                                    @endif value="lain_lain" name="bab_saat_sakit[]"> Lain - lain : <input type="text" value="@if(old('ket_bab_saat_sakit')){{ old('ket_bab_saat_sakit') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa2->ket_bab_saat_sakit : '' }}@endif" id="ket_bab_saat_sakit" name="ket_bab_saat_sakit" style="border: 0; border-bottom: 2px dotted;">
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
                            <input onclick="cek_radio_agama()" @if(old('agama')) {{ old('agama') ==  'islam' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->agama == 'islam' ? 'checked' : '') : 'checked' }} @endif type="radio" value="islam" name="radio_agama"> Islam
                            <input onclick="cek_radio_agama()" @if(old('agama')) {{ old('agama') ==  'Protestan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->agama == 'Protestan' ? 'checked' : '') : '' }} @endif type="radio" value="Protestan" name="radio_agama" class="ml-4"> Protestan
                            <input onclick="cek_radio_agama()" @if(old('agama')) {{ old('agama') ==  'katolik' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->agama == 'katolik' ? 'checked' : '') : '' }} @endif type="radio" value="katolik" name="radio_agama" class="ml-4"> Katolik
                            <input onclick="cek_radio_agama()" @if(old('agama')) {{ old('agama') ==  'hindu' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->agama == 'hindu' ? 'checked' : '') : '' }} @endif type="radio" value="hindu" name="radio_agama" class="ml-4"> Hindu
                            <input onclick="cek_radio_agama()" @if(old('agama')) {{ old('agama') ==  'budha' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->agama == 'budha' ? 'checked' : '') : '' }} @endif type="radio" value="budha" name="radio_agama" class="ml-4"> Budha
                            <input onclick="cek_radio_agama()" @if(old('agama')) {{ old('agama') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->agama == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_agama" class="ml-4">
                            <input type="text" readonly value="@if(old('agama_lain')){{ old('agama_lain') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->agama_lain : '' }}@endif" id="agama_lain" name="agama_lain" style="border: 0; border-bottom: 2px dotted;" @if(old('agama')) {{ old('agama') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->agama == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            2. Mengungkapkan Keprihatinan yang Berhubungan Dengan Rawat Inap :
                            <div class="row">
                                <div class="col-md-2">
                                    <input @if(old('keprihatinan')) {{ old('keprihatinan') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->keprihatinan == 'Tidak' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak" name="radio_keprihatinan"> Tidak
                                    <input @if(old('keprihatinan')) {{ old('keprihatinan') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->keprihatinan == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_keprihatinan" class="ml-4"> Ya <span style="float: right">:</span>
                                </div>
                                <div class="col-md-10">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual) ? (in_array('satu',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual )) ? 'checked' : '') : '' }}
                                    @endif value="satu" name="checkbox_spiritual[]"> Ketidakmampuan Untuk Mempertahankan Praktek Spiritual Seperti Biasa
                                    <br>
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual) ? (in_array('dua',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual )) ? 'checked' : '') : '' }}
                                    @endif value="dua" name="checkbox_spiritual[]"> Perasaan Negatif Tentang Sistem Kepercayaan Terhadap Spiritual
                                    <br>
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual) ? (in_array('tiga',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual )) ? 'checked' : '') : '' }}
                                    @endif value="tiga" name="checkbox_spiritual[]"> Konflik Antara Kepercayaan Spiritual Dengan Ketentuan Sistem Kesehatan
                                    <br>
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual) ? (in_array('empat',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual )) ? 'checked' : '') : '' }}
                                    @endif value="empat" name="checkbox_spiritual[]"> Bimbingan Rohani
                                    <br>
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual) ? (in_array('lima',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->checkbox_spiritual )) ? 'checked' : '') : '' }}
                                    @endif value="lima" name="checkbox_spiritual[]"> Lain - lain
                                    <input type="text" value="@if(old('ket_keprihatinan_detail')){{ old('ket_keprihatinan_detail') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_keprihatinan_detail : '' }}@endif" id="ket_keprihatinan_detail" name="ket_keprihatinan_detail" style="border: 0; border-bottom: 2px dotted;">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            3. Pekerjaan :
                            <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan')) {{ old('pekerjaan') ==  'PNS' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pekerjaan == 'PNS' ? 'checked' : '') : '' }} @endif type="radio" value="PNS" name="radio_pekerjaan"> PNS/TNI/POLRI
                            <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan')) {{ old('pekerjaan') ==  'Swasta' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pekerjaan == 'Swasta' ? 'checked' : '') : '' }} @endif type="radio" value="Swasta" name="radio_pekerjaan" class="ml-4"> Swasta
                            <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan')) {{ old('pekerjaan') ==  'Pensiun' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pekerjaan == 'Pensiun' ? 'checked' : '') : '' }} @endif type="radio" value="Pensiun" name="radio_pekerjaan" class="ml-4"> Pensiun
                            <input onclick="cek_radio_pekerjaan()" @if(old('pekerjaan')) {{ old('pekerjaan') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pekerjaan == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_pekerjaan" class="ml-4"> Lain - lain :
                            <input type="text" readonly value="@if(old('pekerjaan_lain')){{ old('pekerjaan_lain') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pekerjaan_lain : '' }}@endif" id="pekerjaan_lain" name="pekerjaan_lain" style="border: 0; border-bottom: 2px dotted;" @if(old('pekerjaan')) {{ old('pekerjaan') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pekerjaan == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            4. Tinggal Bersama :
                            <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama')) {{ old('tinggal_bersama') ==  'suami' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->tinggal_bersama == 'suami' ? 'checked' : '') : '' }} @endif type="radio" value="suami" name="radio_tinggal_bersama"> Suami/Istri
                            <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama')) {{ old('tinggal_bersama') ==  'Orang Tua' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->tinggal_bersama == 'Orang Tua' ? 'checked' : '') : '' }} @endif type="radio" value="Orang Tua" name="radio_tinggal_bersama" class="ml-4"> Orang Tua
                            <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama')) {{ old('tinggal_bersama') ==  'Anak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->tinggal_bersama == 'Anak' ? 'checked' : '') : '' }} @endif type="radio" value="Anak" name="radio_tinggal_bersama" class="ml-4"> Anak
                            <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama')) {{ old('tinggal_bersama') ==  'Kerabat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->tinggal_bersama == 'Kerabat' ? 'checked' : '') : '' }} @endif type="radio" value="Kerabat" name="radio_tinggal_bersama" class="ml-4"> Kerabat
                            <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama')) {{ old('tinggal_bersama') ==  'Sendiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->tinggal_bersama == 'Sendiri' ? 'checked' : '') : '' }} @endif type="radio" value="Sendiri" name="radio_tinggal_bersama" class="ml-4"> Sendiri
                            <input onclick="cek_radio_tinggal_bersama()" @if(old('tinggal_bersama')) {{ old('tinggal_bersama') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->tinggal_bersama == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_tinggal_bersama" class="ml-4"> Lain - lain :
                            <input type="text" readonly value="@if(old('tinggal_bersama_lain')){{ old('tinggal_bersama_lain') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->tinggal_bersama_lain : '' }}@endif" id="tinggal_bersama_lain" name="tinggal_bersama_lain" style="border: 0; border-bottom: 2px dotted;" @if(old('tinggal_bersama')) {{ old('tinggal_bersama') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->tinggal_bersama == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            5. Pendidikan Pasien :
                            <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'TK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'TK' ? 'checked' : '') : '' }} @endif type="radio" value="TK" name="radio_pendidikan_pasien"> TK
                            <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'SD' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'SD' ? 'checked' : '') : '' }} @endif type="radio" value="SD" name="radio_pendidikan_pasien" class="ml-4"> SD
                            <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'SMP' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'SMP' ? 'checked' : '') : '' }} @endif type="radio" value="SMP" name="radio_pendidikan_pasien" class="ml-4"> SMP
                            <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'SLTA' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'SLTA' ? 'checked' : '') : '' }} @endif type="radio" value="SLTA" name="radio_pendidikan_pasien" class="ml-4"> SLTA
                            <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'Akademi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'Akademi' ? 'checked' : '') : '' }} @endif type="radio" value="Akademi" name="radio_pendidikan_pasien" class="ml-4"> Akademi
                            <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'Pasca Sarjana' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'Pasca Sarjana' ? 'checked' : '') : '' }} @endif type="radio" value="Pasca Sarjana" name="radio_pendidikan_pasien" class="ml-4"> Pasca Sarjana
                            <input onclick="cek_radio_pendidikan_pasien()" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_pendidikan_pasien" class="ml-4"> Lain - lain :
                            <input type="text" readonly value="@if(old('pendidikan_pasien_lain')){{ old('pendidikan_pasien_lain') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pendidikan_pasien_lain : '' }}@endif" id="pendidikan_pasien_lain" name="pendidikan_pasien_lain" style="border: 0; border-bottom: 2px dotted;" @if(old('pendidikan_pasien')) {{ old('pendidikan_pasien') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pasien == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            &nbsp;&nbsp;&nbsp; Pendidikan Penanggung Jawab :
                            <input onclick="cek_radio_pendidikan_pj()" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'TK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'TK' ? 'checked' : '') : '' }} @endif type="radio" value="TK" name="radio_pendidikan_pj"> TK
                            <input onclick="cek_radio_pendidikan_pj()" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'SD' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'SD' ? 'checked' : '') : '' }} @endif type="radio" value="SD" name="radio_pendidikan_pj" class="ml-4"> SD
                            <input onclick="cek_radio_pendidikan_pj()" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'SMP' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'SMP' ? 'checked' : '') : '' }} @endif type="radio" value="SMP" name="radio_pendidikan_pj" class="ml-4"> SMP
                            <input onclick="cek_radio_pendidikan_pj()" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'SLTA' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'SLTA' ? 'checked' : '') : '' }} @endif type="radio" value="SLTA" name="radio_pendidikan_pj" class="ml-4"> SLTA
                            <input onclick="cek_radio_pendidikan_pj()" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'Akademi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'Akademi' ? 'checked' : '') : '' }} @endif type="radio" value="Akademi" name="radio_pendidikan_pj" class="ml-4"> Akademi
                            <input onclick="cek_radio_pendidikan_pj()" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'Pasca Sarjana' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'Pasca Sarjana' ? 'checked' : '') : '' }} @endif type="radio" value="Pasca Sarjana" name="radio_pendidikan_pj" class="ml-4"> Pasca Sarjana
                            <input onclick="cek_radio_pendidikan_pj()" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_pendidikan_pj" class="ml-4"> Lain - lain :
                            <input type="text" readonly value="@if(old('pendidikan_pj_lain')){{ old('pendidikan_pj_lain') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pendidikan_pj_lain : '' }}@endif" id="pendidikan_pj_lain" name="pendidikan_pj_lain" style="border: 0; border-bottom: 2px dotted;" @if(old('pendidikan_pj')) {{ old('pendidikan_pj') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->spiritual)->pendidikan_pj == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            6. Suku : <input type="text" value="@if(old('suku')){{ old('suku') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->suku : '' }}@endif" id="suku" name="suku" style="border: 0; border-bottom: 2px dotted; width: 95%">
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
                                <div class="col-md-3">
                                    1. Status Mental
                                </div>
                                <div class="col-md-9">
                                    :
                                    <input @if(old('status_mental')) {{ old('status_mental') ==  'Orientasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_mental == 'Orientasi' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Orientasi" name="radio_status_mental"> Orientasi
                                    <input @if(old('status_mental')) {{ old('status_mental') ==  'Tidak Ada Respon' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_mental == 'Tidak Ada Respon' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Ada Respon" name="radio_status_mental" class="ml-4"> Tidak Ada Respon
                                    <input @if(old('status_mental')) {{ old('status_mental') ==  'Agitasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_mental == 'Agitasi' ? 'checked' : '') : '' }} @endif type="radio" value="Agitasi" name="radio_status_mental" class="ml-4"> Agitasi
                                    <input @if(old('status_mental')) {{ old('status_mental') ==  'Menyerang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_mental == 'Menyerang' ? 'checked' : '') : '' }} @endif type="radio" value="Menyerang" name="radio_status_mental" class="ml-4"> Menyerang
                                    <input @if(old('status_mental')) {{ old('status_mental') ==  'Kooperatif' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_mental == 'Kooperatif' ? 'checked' : '') : '' }} @endif type="radio" value="Kooperatif" name="radio_status_mental" class="ml-4"> Kooperatif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-9">
                                    :
                                    <input @if(old('status_mental')) {{ old('status_mental') ==  'Letargi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_mental == 'Letargi' ? 'checked' : '') : '' }} @endif type="radio" value="Letargi" name="radio_status_mental"> Letargi
                                    <input @if(old('status_mental')) {{ old('status_mental') ==  'Disorientasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_mental == 'Disorientasi' ? 'checked' : '') : '' }} @endif type="radio" value="Disorientasi" name="radio_status_mental" class="ml-4"> Disorientasi :
                                    <input @if(old('detail_status_mental')) {{ old('detail_status_mental') ==  'Orang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->detail_status_mental == 'Orang' ? 'checked' : '') : '' }} @endif type="radio" value="Orang" name="radio_detail_status_mental" class="ml-4"> Orang
                                    <input @if(old('detail_status_mental')) {{ old('detail_status_mental') ==  'Tempat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->detail_status_mental == 'Tempat' ? 'checked' : '') : '' }} @endif type="radio" value="Tempat" name="radio_detail_status_mental" class="ml-4"> Tempat
                                    <input @if(old('detail_status_mental')) {{ old('detail_status_mental') ==  'Waktu' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->detail_status_mental == 'Waktu' ? 'checked' : '') : '' }} @endif type="radio" value="Waktu" name="radio_detail_status_mental" class="ml-4"> Waktu
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            <div class="row">
                                <div class="col-md-3">
                                    2. Status Psikologis
                                </div>
                                <div class="col-md-9">
                                    :
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'Tenang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'Tenang' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tenang" name="radio_status_psikologis"> Tenang
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'Cemas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'Cemas' ? 'checked' : '') : '' }} @endif type="radio" value="Cemas" name="radio_status_psikologis" class="ml-4"> Cemas
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'Sedih' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'Sedih' ? 'checked' : '') : '' }} @endif type="radio" value="Sedih" name="radio_status_psikologis" class="ml-4"> Sedih
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'Depresi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'Depresi' ? 'checked' : '') : '' }} @endif type="radio" value="Depresi" name="radio_status_psikologis" class="ml-4"> Depresi
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'Marah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'Marah' ? 'checked' : '') : '' }} @endif type="radio" value="Marah" name="radio_status_psikologis" class="ml-4"> Marah
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'Hiperaktif' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'Hiperaktif' ? 'checked' : '') : '' }} @endif type="radio" value="Hiperaktif" name="radio_status_psikologis" class="ml-4"> Hiperaktif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-9">
                                    :
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'Mengganggu Sekitar' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'Mengganggu Sekitar' ? 'checked' : '') : '' }} @endif type="radio" value="Mengganggu Sekitar" name="radio_status_psikologis"> Mengganggu Sekitar
                                    <input @if(old('status_psikologis')) {{ old('status_psikologis') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->status_psikologis == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_status_psikologis" class="ml-4"> Lain - lain :
                                    <input type="text" readonly value="@if(old('ket_status_psikologis')){{ old('ket_status_psikologis') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_status_psikologis : '' }}@endif" id="ket_status_psikologis" name="ket_status_psikologis" style="border: 0; border-bottom: 2px dotted;" @if(old('status_psikologis')) {{ old('status_psikologis') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->status_psikologis == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            <div class="row">
                                <div class="col-md-3">
                                    3. Penggunaan Restrain
                                </div>
                                <div class="col-md-9">
                                    :
                                    <input @if(old('penggunaan_restrain')) {{ old('penggunaan_restrain') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->penggunaan_restrain == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_penggunaan_restrain"> Tidak
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-9">
                                    :
                                    <input @if(old('penggunaan_restrain')) {{ old('penggunaan_restrain') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->penggunaan_restrain == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_penggunaan_restrain"> Ya, Alasan :
                                    <input @if(old('detail_penggunaan_restrain')) {{ old('detail_penggunaan_restrain') ==  'membahayakan_diri_sendiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->detail_penggunaan_restrain == 'membahayakan_diri_sendiri' ? 'checked' : '') : '' }} @endif type="radio" value="membahayakan_diri_sendiri" name="radio_detail_penggunaan_restrain" class="ml-4"> Membahayakan Diri Sendiri
                                    <input @if(old('detail_penggunaan_restrain')) {{ old('detail_penggunaan_restrain') ==  'membahayakan_orang_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->detail_penggunaan_restrain == 'membahayakan_orang_lain' ? 'checked' : '') : '' }} @endif type="radio" value="membahayakan_orang_lain" name="radio_detail_penggunaan_restrain" class="ml-4"> Membahayakan Orang Lain
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 17px">
                            4. Pengkajian Resiko Jatuh
                            <li>Risiko Jatuh Morse (Dewasa)</li>
                            <input type="radio" {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->pengkajian_resiko_jatuh == 'tidak_risiko' ? 'checked' : '') : '' }} value="tidak_risiko" id="tidak_risiko" name="radio_pengkajian_resiko_jatuh"> Skor 0 - 24 : Tidak Risiko
                            <input type="radio" {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->pengkajian_resiko_jatuh == 'risiko_rendah' ? 'checked' : '') : '' }} value="risiko_rendah" id="risiko_rendah" name="radio_pengkajian_resiko_jatuh" class="ml-5"> Skor 25 - 50 : Risiko Rendah
                            <input type="radio" {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->proteksi)->pengkajian_resiko_jatuh == 'risiko_tinggi' ? 'checked' : '') : '' }} value="risiko_tinggi" id="risiko_tinggi" name="radio_pengkajian_resiko_jatuh" class="ml-5"> Skor > 51 : Risiko Tinggi
                        </td>
                    </tr>
                </table>
                <table style="width: 100%; border-top: hidden" class="table_isian">
                    <tr>
                        <td>
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
                                        <select onchange="hitung_score()" id="riwayat_jatuh" name="riwayat_jatuh" class="form-control">
                                            <option @if(old('riwayat_jatuh')) {{ old('riwayat_jatuh') == '0' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->riwayat_jatuh == '0' ? 'selected' : '' }}
                                                @endif value="0">0
                                            </option>
                                            <option @if(old('riwayat_jatuh')) {{ old('riwayat_jatuh') == '25' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->riwayat_jatuh == '25' ? 'selected' : '' }}
                                                @endif value="25">25
                                            </option>
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
                                        <select onchange="hitung_score()" id="diagnosis_sekunder" name="diagnosis_sekunder" class="form-control">
                                            <option @if(old('diagnosis_sekunder')) {{ old('diagnosis_sekunder') == '0' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->diagnosis_sekunder == '0' ? 'selected' : '' }}
                                                @endif value="0">0
                                            </option>
                                            <option @if(old('diagnosis_sekunder')) {{ old('diagnosis_sekunder') == '15' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->diagnosis_sekunder == '15' ? 'selected' : '' }}
                                                @endif value="15">15
                                            </option>
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
                                        <select onchange="hitung_score()" id="ambulasi" name="ambulasi" class="form-control">
                                            <option @if(old('ambulasi')) {{ old('ambulasi') == '0' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->ambulasi == '0' ? 'selected' : '' }}
                                                @endif value="0">0
                                            </option>
                                            <option @if(old('ambulasi')) {{ old('ambulasi') == '15' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->ambulasi == '15' ? 'selected' : '' }}
                                                @endif value="15">15
                                            </option>
                                            <option @if(old('ambulasi')) {{ old('ambulasi') == '30' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->ambulasi == '30' ? 'selected' : '' }}
                                                @endif value="30">30
                                            </option>
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
                                        <select onchange="hitung_score()" id="heparin_lock" name="heparin_lock" class="form-control">
                                            <option @if(old('heparin_lock')) {{ old('heparin_lock') == '0' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->heparin_lock == '0' ? 'selected' : '' }}
                                                @endif value="0">0
                                            </option>
                                            <option @if(old('heparin_lock')) {{ old('heparin_lock') == '20' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->heparin_lock == '20' ? 'selected' : '' }}
                                                @endif value="20">20
                                            </option>
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
                                        <select onchange="hitung_score()" id="gaya_berjalan" name="gaya_berjalan" class="form-control">
                                            <option @if(old('gaya_berjalan')) {{ old('gaya_berjalan') == '0' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->gaya_berjalan == '0' ? 'selected' : '' }}
                                                @endif value="0">0
                                            </option>
                                            <option @if(old('gaya_berjalan')) {{ old('gaya_berjalan') == '10' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->gaya_berjalan == '10' ? 'selected' : '' }}
                                                @endif value="10">10
                                            </option>
                                            <option @if(old('gaya_berjalan')) {{ old('gaya_berjalan') == '20' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->gaya_berjalan == '20' ? 'selected' : '' }}
                                                @endif value="20">20
                                            </option>
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
                                        <select onchange="hitung_score()" id="status_mental" name="status_mental" class="form-control">
                                            <option @if(old('status_mental')) {{ old('status_mental') == '0' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->status_mental == '0' ? 'selected' : '' }}
                                                @endif value="0">0
                                            </option>
                                            <option @if(old('status_mental')) {{ old('status_mental') == '15' ? 'selected' : '' }} @elseif(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                                {{ json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skor)->status_mental == '15' ? 'selected' : '' }}
                                                @endif value="15">15
                                            </option>
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
                                    <td>
                                        <input type="number" readonly class="form-control" name="total_score" id="total_score">
                                    </td>
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
                                    <td>
                                        <input type="text" id="alkohol" name="alkohol" class="form-control" value="@if(old('alkohol')){{ old('alkohol') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->alkohol : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Anti Kejang Sedative</td>
                                    <td></td>
                                    <td>
                                        <input type="text" id="anti_kejang" name="anti_kejang" class="form-control" value="@if(old('anti_kejang')){{ old('anti_kejang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->anti_kejang : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Diuretik Narkotik</td>
                                    <td></td>
                                    <td>
                                        <input type="text" id="narkotik" name="narkotik" class="form-control" value="@if(old('narkotik')){{ old('narkotik') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->narkotik : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Psikotropik Anti Hipertensi</td>
                                    <td></td>
                                    <td>
                                        <input type="text" id="psikotropik" name="psikotropik" class="form-control" value="@if(old('psikotropik')){{ old('psikotropik') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->psikotropik : '' }}@endif">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="pagebreak"></div>
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
                                        <input @if(old('kemampuan_aktifitas')) {{ old('kemampuan_aktifitas') ==  'mandiri' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_aktifitas == 'mandiri' ? 'checked' : '') : 'checked' }} @endif type="radio" value="mandiri" name="radio_kemampuan_aktifitas"> Mandiri
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('kemampuan_aktifitas')) {{ old('kemampuan_aktifitas') ==  'bantuan_minimal' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_aktifitas == 'bantuan_minimal' ? 'checked' : '') : '' }} @endif type="radio" value="bantuan_minimal" name="radio_kemampuan_aktifitas"> Bantuan Minimal
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('kemampuan_aktifitas')) {{ old('kemampuan_aktifitas') ==  'bantuan_sebagian' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_aktifitas == 'bantuan_sebagian' ? 'checked' : '') : '' }} @endif type="radio" value="bantuan_sebagian" name="radio_kemampuan_aktifitas"> Bantuan Sebagian
                                    </div>
                                    <div class="col-md-3">
                                        <input @if(old('kemampuan_aktifitas')) {{ old('kemampuan_aktifitas') ==  'bantuan_total' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_aktifitas == 'bantuan_total' ? 'checked' : '') : '' }} @endif type="radio" value="bantuan_total" name="radio_kemampuan_aktifitas"> Bantuan Ketergantungan Total
                                    </div>
                                </div>
                                <li>Aktivitas : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('aktivitas')) {{ old('aktivitas') ==  'Tirah Baring' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->aktivitas == 'Tirah Baring' ? 'checked' : '') : '' }} @endif type="radio" value="Tirah Baring" name="radio_aktivitas"> Tirah Baring
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('aktivitas')) {{ old('aktivitas') ==  'Duduk' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->aktivitas == 'Duduk' ? 'checked' : '') : '' }} @endif type="radio" value="Duduk" name="radio_aktivitas"> Duduk
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('aktivitas')) {{ old('aktivitas') ==  'Berjalan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->aktivitas == 'Berjalan' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Berjalan" name="radio_aktivitas"> Berjalan
                                    </div>
                                </div>
                                <li>Berjalan : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_berjalan"> TAK
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'Penurunan Kekuatan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'Penurunan Kekuatan' ? 'checked' : '') : '' }} @endif type="radio" value="Penurunan Kekuatan" name="radio_berjalan"> Penurunan Kekuatan
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'Paralisis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'Paralisis' ? 'checked' : '') : '' }} @endif type="radio" value="Paralisis" name="radio_berjalan"> Paralisis
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'Sering Jatuh' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'Sering Jatuh' ? 'checked' : '') : '' }} @endif type="radio" value="Sering Jatuh" name="radio_berjalan"> Sering Jatuh
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'Deformitas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'Deformitas' ? 'checked' : '') : '' }} @endif type="radio" value="Deformitas" name="radio_berjalan"> Deformitas
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'Hilang Keseimbangan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'Hilang Keseimbangan' ? 'checked' : '') : '' }} @endif type="radio" value="Hilang Keseimbangan" name="radio_berjalan"> Hilang Keseimbangan
                                    </div>
                                    <div class="col-md-4">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'Riwayat Patah Tulang' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'Riwayat Patah Tulang' ? 'checked' : '') : '' }} @endif type="radio" value="Riwayat Patah Tulang" name="radio_berjalan"> Riwayat Patah Tulang :
                                        <input type="text" readonly value="@if(old('ket_patah_tulang')){{ old('ket_patah_tulang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_patah_tulang : '' }}@endif" id="ket_patah_tulang" name="ket_patah_tulang" style="border: 0; border-bottom: 2px dotted;" @if(old('berjalan')) {{ old('berjalan') ==  'Riwayat Patah Tulang' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->berjalan == 'Riwayat Patah Tulang' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                    <div class="col-md-4">
                                        <input @if(old('berjalan')) {{ old('berjalan') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->berjalan == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_berjalan"> Lain - lain :
                                        <input type="text" readonly value="@if(old('ket_berjalan')){{ old('ket_berjalan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_berjalan : '' }}@endif" id="ket_berjalan" name="ket_berjalan" style="border: 0; border-bottom: 2px dotted;" @if(old('berjalan')) {{ old('berjalan') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->berjalan == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <li>Alat Ambulasi : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('alat_ambulasi')) {{ old('alat_ambulasi') ==  'Walker' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->alat_ambulasi == 'Walker' ? 'checked' : '') : '' }} @endif type="radio" value="Walker" name="radio_alat_ambulasi"> Walker
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('alat_ambulasi')) {{ old('alat_ambulasi') ==  'Tongkat' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->alat_ambulasi == 'Tongkat' ? 'checked' : '') : '' }} @endif type="radio" value="Tongkat" name="radio_alat_ambulasi"> Tongkat
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('alat_ambulasi')) {{ old('alat_ambulasi') ==  'Kursi Roda' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->alat_ambulasi == 'Kursi Roda' ? 'checked' : '') : '' }} @endif type="radio" value="Kursi Roda" name="radio_alat_ambulasi"> Kursi Roda
                                    </div>
                                    <div class="col-md-3">
                                        <input @if(old('alat_ambulasi')) {{ old('alat_ambulasi') ==  'Tidak Menggunakan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->alat_ambulasi == 'Tidak Menggunakan' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Menggunakan" name="radio_alat_ambulasi"> Tidak Menggunakan
                                    </div>
                                </div>
                                <li>Ekstremitas Atas : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('ekstremitas_atas')) {{ old('ekstremitas_atas') ==  'Tidak Ada Kesulitan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->ekstremitas_atas == 'Tidak Ada Kesulitan' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada Kesulitan" name="radio_ekstremitas_atas"> Tidak Ada Kesulitan
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('ekstremitas_atas')) {{ old('ekstremitas_atas') ==  'Lemah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->ekstremitas_atas == 'Lemah' ? 'checked' : '') : '' }} @endif type="radio" value="Lemah" name="radio_ekstremitas_atas"> Lemah
                                    </div>
                                </div>
                                <li>Ekstremitas Bawah : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('ekstremitas_bawah')) {{ old('ekstremitas_bawah') ==  'TAK' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->ekstremitas_bawah == 'TAK' ? 'checked' : '') : 'checked' }} @endif type="radio" value="TAK" name="radio_ekstremitas_bawah"> TAK
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('ekstremitas_bawah')) {{ old('ekstremitas_bawah') ==  'Varises' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->ekstremitas_bawah == 'Varises' ? 'checked' : '') : '' }} @endif type="radio" value="Varises" name="radio_ekstremitas_bawah"> Varises
                                    </div>
                                    <div class="col-md-4">
                                        <input @if(old('ekstremitas_bawah')) {{ old('ekstremitas_bawah') ==  'Edema' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->ekstremitas_bawah == 'Edema' ? 'checked' : '') : '' }} @endif type="radio" value="Edema" name="radio_ekstremitas_bawah"> Edema
                                        <input type="text" readonly value="@if(old('ket_edema')){{ old('ket_edema') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_edema : '' }}@endif" id="ket_edema" name="ket_edema" style="border: 0; border-bottom: 2px dotted;" @if(old('ekstremitas_bawah')) {{ old('ekstremitas_bawah') ==  'Edema' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ekstremitas_bawah == 'Edema' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('ekstremitas_bawah')) {{ old('ekstremitas_bawah') ==  'Tidak Simetris' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->ekstremitas_bawah == 'Tidak Simetris' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak Simetris" name="radio_ekstremitas_bawah"> Tidak Simetris
                                    </div>
                                    <div class="col-md-4">
                                        <input @if(old('ekstremitas_bawah')) {{ old('ekstremitas_bawah') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->ekstremitas_bawah == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_ekstremitas_bawah"> Lain - lain
                                        <input type="text" readonly value="@if(old('ket_ekstremitas_bawah')){{ old('ket_ekstremitas_bawah') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_ekstremitas_bawah : '' }}@endif" id="ket_ekstremitas_bawah" name="ket_ekstremitas_bawah" style="border: 0; border-bottom: 2px dotted;" @if(old('ekstremitas_bawah')) {{ old('ekstremitas_bawah') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ekstremitas_bawah == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <li>Kemampuan Menggenggam : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('kemampuan_menggenggam')) {{ old('kemampuan_menggenggam') ==  'Tidak Ada Kesulitan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_menggenggam == 'Tidak Ada Kesulitan' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada Kesulitan" name="radio_kemampuan_menggenggam"> Tidak Ada Kesulitan
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('kemampuan_menggenggam')) {{ old('kemampuan_menggenggam') ==  'Terakhir' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_menggenggam == 'Terakhir' ? 'checked' : '') : '' }} @endif type="radio" value="Terakhir" name="radio_kemampuan_menggenggam"> Terakhir
                                    </div>
                                    <div class="col-md-4">
                                        <input @if(old('kemampuan_menggenggam')) {{ old('kemampuan_menggenggam') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_menggenggam == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_kemampuan_menggenggam"> Lain - lain
                                        <input type="text" readonly value="@if(old('ket_kemampuan_menggenggam')){{ old('ket_kemampuan_menggenggam') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_kemampuan_menggenggam : '' }}@endif" id="ket_kemampuan_menggenggam" name="ket_kemampuan_menggenggam" style="border: 0; border-bottom: 2px dotted;" @if(old('kemampuan_menggenggam')) {{ old('kemampuan_menggenggam') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kemampuan_menggenggam == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <li>Kemampuan Koordinasi : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('kemampuan_koordinasi')) {{ old('kemampuan_koordinasi') ==  'Tidak Ada Kelainan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_koordinasi == 'Tidak Ada Kelainan' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak Ada Kelainan" name="radio_kemampuan_koordinasi"> Tidak Ada Kelainan
                                    </div>
                                    <div class="col-md-4">
                                        <input @if(old('kemampuan_koordinasi')) {{ old('kemampuan_koordinasi') ==  'Ada Masalah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_koordinasi == 'Ada Masalah' ? 'checked' : '') : '' }} @endif type="radio" value="Ada Masalah" name="radio_kemampuan_koordinasi"> Ada Masalah :
                                        <input type="text" readonly value="@if(old('ket_kemampuan_koordinasi')){{ old('ket_kemampuan_koordinasi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_kemampuan_koordinasi : '' }}@endif" id="ket_kemampuan_koordinasi" name="ket_kemampuan_koordinasi" style="border: 0; border-bottom: 2px dotted;" @if(old('kemampuan_koordinasi')) {{ old('kemampuan_koordinasi') ==  'Ada Masalah' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kemampuan_koordinasi == 'Ada Masalah' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <li>Kemampuan Gangguan Fungsi : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('kemampuan_gangguan_fungsi')) {{ old('kemampuan_gangguan_fungsi') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_gangguan_fungsi == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_kemampuan_gangguan_fungsi"> Ya (Konsul DPJP)
                                    </div>
                                    <div class="col-md-3">
                                        <input @if(old('kemampuan_gangguan_fungsi')) {{ old('kemampuan_gangguan_fungsi') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pengkajian_fungsi)->kemampuan_gangguan_fungsi == 'Tidak' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak" name="radio_kemampuan_gangguan_fungsi"> Tidak (Tidak Perlu Konsul DPJP)
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
                                        <input @if(old('pendidikan_bicara')) {{ old('pendidikan_bicara') ==  'Normal' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->pendidikan_bicara == 'Normal' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Normal" name="radio_pendidikan_bicara"> Normal
                                    </div>
                                    <div class="col-md-4">
                                        <input @if(old('pendidikan_bicara')) {{ old('pendidikan_bicara') ==  'Gangguan Bicara' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->pendidikan_bicara == 'Gangguan Bicara' ? 'checked' : '') : '' }} @endif type="radio" value="Gangguan Bicara" name="radio_pendidikan_bicara"> Gangguan Bicara Sejak
                                        <input type="text" readonly value="@if(old('ket_gangguan_bicara')){{ old('ket_gangguan_bicara') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_gangguan_bicara : '' }}@endif" id="ket_gangguan_bicara" name="ket_gangguan_bicara" style="border: 0; border-bottom: 2px dotted;" @if(old('pendidikan_bicara')) {{ old('pendidikan_bicara') ==  'Gangguan Bicara' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pendidikan_bicara == 'Gangguan Bicara' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Bahasa Sehari - hari <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('pendidikan_bahasa')) {{ old('pendidikan_bahasa') ==  'Indonesia' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->pendidikan_bahasa == 'Indonesia' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Indonesia" name="radio_pendidikan_bahasa"> Indonesia
                                    </div>
                                    <div class="col-md-3">
                                        <input @if(old('pendidikan_bahasa')) {{ old('pendidikan_bahasa') ==  'Daerah' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->pendidikan_bahasa == 'Daerah' ? 'checked' : '') : '' }} @endif type="radio" value="Daerah" name="radio_pendidikan_bahasa"> Daerah
                                        <input type="text" readonly value="@if(old('ket_bahasa_daerah')){{ old('ket_bahasa_daerah') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_bahasa_daerah : '' }}@endif" id="ket_bahasa_daerah" name="ket_bahasa_daerah" style="border: 0; border-bottom: 2px dotted;" @if(old('pendidikan_bahasa')) {{ old('pendidikan_bahasa') ==  'Daerah' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pendidikan_bahasa == 'Daerah' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('pendidikan_bahasa')) {{ old('pendidikan_bahasa') ==  'Inggris' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->pendidikan_bahasa == 'Inggris' ? 'checked' : '') : '' }} @endif type="radio" value="Inggris" name="radio_pendidikan_bahasa"> Inggris Aktif/Pasif
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('pendidikan_bahasa')) {{ old('pendidikan_bahasa') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->pendidikan_bahasa == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_pendidikan_bahasa">
                                        <input type="text" readonly value="@if(old('ket_pendidikan_bahasa')){{ old('ket_pendidikan_bahasa') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_pendidikan_bahasa : '' }}@endif" id="ket_pendidikan_bahasa" name="ket_pendidikan_bahasa" style="border: 0; border-bottom: 2px dotted;" @if(old('pendidikan_bahasa')) {{ old('pendidikan_bahasa') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->pendidikan_bahasa == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Penerjemah <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('penerjemah')) {{ old('penerjemah') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->penerjemah == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_penerjemah"> Tidak
                                    </div>
                                    <div class="col-md-3">
                                        <input @if(old('penerjemah')) {{ old('penerjemah') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->penerjemah == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_penerjemah"> Ya, Bahasa
                                        <input type="text" readonly value="@if(old('ket_bahasa_penerjemah')){{ old('ket_bahasa_penerjemah') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_bahasa_penerjemah : '' }}@endif" id="ket_bahasa_penerjemah" name="ket_bahasa_penerjemah" style="border: 0; border-bottom: 2px dotted;" @if(old('penerjemah')) {{ old('penerjemah') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->penerjemah == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                    <div class="col-md-2">
                                        Bahasa Isyarat :
                                        <input @if(old('bahasa_isyarat')) {{ old('bahasa_isyarat') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->bahasa_isyarat == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_bahasa_isyarat"> Ya
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('bahasa_isyarat')) {{ old('bahasa_isyarat') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->bahasa_isyarat == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_bahasa_isyarat"> Tidak
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Hambatan Belajar <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('hambatan_belajar')) {{ old('hambatan_belajar') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_hambatan_belajar"> Tidak
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('hambatan_belajar')) {{ old('hambatan_belajar') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_hambatan_belajar"> Ya :
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Bahasa' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Bahasa' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Bahasa" name="radio_detail_hambatan_belajar"> Bahasa
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Cemas' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Cemas' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Cemas" name="radio_detail_hambatan_belajar"> Cemas
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Kognitif' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Kognitif' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Kognitif" name="radio_detail_hambatan_belajar"> Kognitif
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Pendengaran' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Pendengaran' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Pendengaran" name="radio_detail_hambatan_belajar"> Pendengaran
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Emosi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Emosi' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Emosi" name="radio_detail_hambatan_belajar"> Emosi
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Hilang Memory' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Hilang Memory' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Hilang Memory" name="radio_detail_hambatan_belajar"> Hilang Memory
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Motivasi Buruk' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Motivasi Buruk' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Motivasi Buruk" name="radio_detail_hambatan_belajar"> Motivasi Buruk
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Masalah Penglihatan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Masalah Penglihatan' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Masalah Penglihatan" name="radio_detail_hambatan_belajar"> Masalah Penglihatan
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'Kesulitan Bicara' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'Kesulitan Bicara' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="Kesulitan Bicara" name="radio_detail_hambatan_belajar"> Kesulitan Bicara
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <input @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->detail_hambatan_belajar == 'lain_lain' ? 'checked' : '') : '' }} @endif {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->hambatan_belajar == 'Tidak' ? 'disabled' : '') : 'disabled' }} type="radio" value="lain_lain" name="radio_detail_hambatan_belajar"> Lain - lain
                                        <input type="text" readonly value="@if(old('ket_detail_hambatan_belajar')){{ old('ket_detail_hambatan_belajar') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_detail_hambatan_belajar : '' }}@endif" id="ket_detail_hambatan_belajar" name="ket_detail_hambatan_belajar" style="border: 0; border-bottom: 2px dotted;" @if(old('detail_hambatan_belajar')) {{ old('detail_hambatan_belajar') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->detail_hambatan_belajar == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Cara Belajar yang disukai <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('cara_belajar')) {{ old('cara_belajar') ==  'Menulis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->cara_belajar == 'Menulis' ? 'checked' : '') : '' }} @endif type="radio" value="Menulis" name="radio_cara_belajar"> Menulis
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('cara_belajar')) {{ old('cara_belajar') ==  'Diskusi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->cara_belajar == 'Diskusi' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Diskusi" name="radio_cara_belajar"> Diskusi
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('cara_belajar')) {{ old('cara_belajar') ==  'Mendengar' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->cara_belajar == 'Mendengar' ? 'checked' : '') : '' }} @endif type="radio" value="Mendengar" name="radio_cara_belajar"> Mendengar
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('cara_belajar')) {{ old('cara_belajar') ==  'Demonstrasi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->cara_belajar == 'Demonstrasi' ? 'checked' : '') : '' }} @endif type="radio" value="Demonstrasi" name="radio_cara_belajar"> Demonstrasi
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('cara_belajar')) {{ old('cara_belajar') ==  'Membaca' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->cara_belajar == 'Membaca' ? 'checked' : '') : '' }} @endif type="radio" value="Membaca" name="radio_cara_belajar"> Membaca
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2">
                                        <input @if(old('cara_belajar')) {{ old('cara_belajar') ==  'Audio' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->cara_belajar == 'Audio' ? 'checked' : '') : '' }} @endif type="radio" value="Audio" name="radio_cara_belajar"> Audio/Visual
                                    </div>
                                </div>
                                <li>Pasien atau Keluarga Menginginkan Informasi Tentang : </li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input @if(old('informasi_tentang')) {{ old('informasi_tentang') ==  'Proses Penyakit' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->informasi_tentang == 'Proses Penyakit' ? 'checked' : '') : '' }} @endif type="radio" value="Proses Penyakit" name="radio_informasi_tentang"> Proses Penyakit
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('informasi_tentang')) {{ old('informasi_tentang') ==  'Terapi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->informasi_tentang == 'Terapi' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Terapi" name="radio_informasi_tentang"> Terapi/Obat
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('informasi_tentang')) {{ old('informasi_tentang') ==  'Nutrisi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->informasi_tentang == 'Nutrisi' ? 'checked' : '') : '' }} @endif type="radio" value="Nutrisi" name="radio_informasi_tentang"> Nutrisi
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('informasi_tentang')) {{ old('informasi_tentang') ==  'Penggunaan Alat Medis' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->informasi_tentang == 'Penggunaan Alat Medis' ? 'checked' : '') : '' }} @endif type="radio" value="Penggunaan Alat Medis" name="radio_informasi_tentang"> Penggunaan Alat Medis
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('informasi_tentang')) {{ old('informasi_tentang') ==  'Tindakan' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->informasi_tentang == 'Tindakan' ? 'checked' : '') : '' }} @endif type="radio" value="Tindakan" name="radio_informasi_tentang"> Tindakan
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('informasi_tentang')) {{ old('informasi_tentang') ==  'lain_lain' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->informasi_tentang == 'lain_lain' ? 'checked' : '') : '' }} @endif type="radio" value="lain_lain" name="radio_informasi_tentang">
                                        <input type="text" readonly value="@if(old('ket_informasi_tentang')){{ old('ket_informasi_tentang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_informasi_tentang : '' }}@endif" id="ket_informasi_tentang" name="ket_informasi_tentang" style="border: 0; border-bottom: 2px dotted;" @if(old('informasi_tentang')) {{ old('informasi_tentang') ==  'lain_lain' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_komunikasi)->informasi_tentang == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
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
                            <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                            {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien != '' ? (in_array('tempat_khusus',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien )) ? 'checked' : '') : '' }}
                            @endif value="tempat_khusus" id="kebutuhan_privasi_tempat_khusus" name="kebutuhan_privasi_pasien[]"> Keinginan Waktu / Tempat Khusus Saat Wawancara dan Tindakan
                            <input type="text" readonly value="@if(old('ket_tempat_khusus')){{ old('ket_tempat_khusus') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_tempat_khusus : '' }}@endif" id="ket_tempat_khusus" name="ket_tempat_khusus" style="border: 0; border-bottom: 2px dotted; width: 50%" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                            {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien != '' ? (in_array('tempat_khusus',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien )) ? '' : 'readonly') : '' }}
                            @endif>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left: 20px">
                            <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                            {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien != '' ? (in_array('privasi_pengobatan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien )) ? 'checked' : '') : '' }}
                            @endif value="privasi_pengobatan" name="kebutuhan_privasi_pasien[]"> Pengobatan
                            <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                            {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien != '' ? (in_array('privasi_terapi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien )) ? 'checked' : '') : '' }}
                            @endif value="privasi_terapi" name="kebutuhan_privasi_pasien[]" class="ml-4"> Terapi / Obat
                            <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                            {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien != '' ? (in_array('privasi_transportasi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien )) ? 'checked' : '') : '' }}
                            @endif value="privasi_transportasi" name="kebutuhan_privasi_pasien[]" class="ml-4"> Transportasi
                            <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                            {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien != '' ? (in_array('privasi_lain_lain',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien )) ? 'checked' : '') : '' }}
                            @endif value="privasi_lain_lain" id="kebutuhan_privasi_lain_lain" name="kebutuhan_privasi_pasien[]" class="ml-4"> Lain - lain
                            <input type="text" readonly value="@if(old('ket_privasi_lain_lain')){{ old('ket_privasi_lain_lain') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_privasi_lain_lain : '' }}@endif" id="ket_privasi_lain_lain" name="ket_privasi_lain_lain" style="border: 0; border-bottom: 2px dotted;" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                            {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien != '' ? (in_array('privasi_lain_lain',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kebutuhan_privasi_pasien )) ? '' : 'readonly') : '' }}
                            @endif>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="pagebreak"></div>
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
                                        <input @if(old('penurunan_nafsu_makan')) {{ old('penurunan_nafsu_makan') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->penurunan_nafsu_makan == 'Tidak' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak" name="radio_penurunan_nafsu_makan"> Tidak (0)
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('penurunan_nafsu_makan')) {{ old('penurunan_nafsu_makan') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->penurunan_nafsu_makan == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_penurunan_nafsu_makan"> Ya (1)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <li>Penurunan BB 6 Bulan Terakhir > 10% <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('penurunan_bb')) {{ old('penurunan_bb') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->penurunan_bb == 'Tidak' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak" name="radio_penurunan_bb"> Tidak (0)
                                    </div>
                                    <div class="col-md-2">
                                        <input @if(old('penurunan_bb')) {{ old('penurunan_bb') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->penurunan_bb == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_penurunan_bb"> Ya (1)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <li>Penyakit / kelainan yang menyertai pasien jika ada salah satu atau lebih scoringnya (2) : </li>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('diabetes_militus',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="diabetes_militus" name="kelainan_pasien[]"> Diabetes Militus
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('obesitas',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="obesitas" name="kelainan_pasien[]"> Obesitas
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('penyakit_jantung',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="penyakit_jantung" name="kelainan_pasien[]"> Penyakit Jantung
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('kanker',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="kanker" name="kelainan_pasien[]"> Kanker
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('penyakit_paru_kronis',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="penyakit_paru_kronis" name="kelainan_pasien[]"> Penyakit Paru Kronis
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('hipertensi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="hipertensi" name="kelainan_pasien[]"> Hipertensi ( > 170 / 100 mmHg )
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('gangguan_fungsi_hati',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="gangguan_fungsi_hati" name="kelainan_pasien[]"> Gangguan Fungsi Hati
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('gangguan_fungsi_ginjal',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="gangguan_fungsi_ginjal" name="kelainan_pasien[]"> Gangguan Fungsi Ginjal
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('diare_mall_aborsi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="diare_mall_aborsi" name="kelainan_pasien[]"> Diare/Mall Aborsi
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('hiperkalemmi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="hiperkalemmi" name="kelainan_pasien[]"> Hiperkalemi
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien != "" ? (in_array('hiperlipidemia',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kelainan_pasien )) ? 'checked' : '') : '' }}
                                        @endif value="hiperlipidemia" name="kelainan_pasien[]"> Hiperlipidemia
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
                                        <input @if(old('diet_diberikan')) {{ old('diet_diberikan') ==  'Biasa' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_diberikan == 'Biasa' ? 'checked' : '') : '' }} @endif type="radio" value="Biasa" name="diet_diberikan"> Biasa
                                        <input @if(old('diet_diberikan')) {{ old('diet_diberikan') ==  'Tim' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_diberikan == 'Tim' ? 'checked' : '') : '' }} @endif type="radio" value="Tim" name="diet_diberikan" class="ml-4"> Tim
                                        <input @if(old('diet_diberikan')) {{ old('diet_diberikan') ==  'Lunak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_diberikan == 'Lunak' ? 'checked' : '') : '' }} @endif type="radio" value="Lunak" name="diet_diberikan" class="ml-4"> Lunak
                                        <input @if(old('diet_diberikan')) {{ old('diet_diberikan') ==  'Saring / Bubur Susu' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_diberikan == 'Saring / Bubur Susu' ? 'checked' : '') : '' }} @endif type="radio" value="Saring / Bubur Susu" name="diet_diberikan" class="ml-4"> Saring / Bubur Susu
                                        <input @if(old('diet_diberikan')) {{ old('diet_diberikan') ==  'Cair' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_diberikan == 'Cair' ? 'checked' : '') : '' }} @endif type="radio" value="Cair" name="diet_diberikan" class="ml-4"> Cair
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        Jika > 2 <span style="float: right">:</span>
                                    </div>
                                    <div class="col-md-11">
                                        <input @if(old('lebih_dari_dua')) {{ old('lebih_dari_dua') ==  'Lapor DPJP' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->lebih_dari_dua == 'Lapor DPJP' ? 'checked' : '') : '' }} @endif type="radio" value="Lapor DPJP" name="lebih_dari_dua"> Lapor DPJP
                                        <input @if(old('lebih_dari_dua')) {{ old('lebih_dari_dua') ==  'Asesmen Lanjutan Oleh Ahli Gizi' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->lebih_dari_dua == 'Asesmen Lanjutan Oleh Ahli Gizi' ? 'checked' : '') : '' }} @endif type="radio" value="Asesmen Lanjutan Oleh Ahli Gizi" name="lebih_dari_dua" class="ml-4"> Asesmen Lanjutan Oleh Ahli Gizi
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
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('nyeri_keperawatan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="nyeri_keperawatan"> Nyeri
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('keselamatan_pasien',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="keselamatan_pasien"> Keselamatan Pasien
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('tumbuh_kembang',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="tumbuh_kembang"> Tumbuh Kembang
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('pola_tidur',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="pola_tidur"> Pola Tidur
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('nutrisi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="nutrisi"> Nutrisi
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('suhu_tubuh',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="suhu_tubuh"> Suhu Tubuh
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('mobilitas_keperawatan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="mobilitas_keperawatan"> Mobilitas / Aktifitas
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('eliminasi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="eliminasi"> Eliminasi
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('perfusi_jaringan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="perfusi_jaringan"> Perfusi Jaringan
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('integritas_kulit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="integritas_kulit"> Integritas Kulit
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('pengetahuan_komunikasi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="pengetahuan_komunikasi"> Pengetahuan / Komunikasi
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('konflik_peran',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="konflik_peran"> Konflik Peran
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('perawatan_diri',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="perawatan_diri"> Perawatan Diri
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('keseimbangan_cairan_elektrolit',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="keseimbangan_cairan_elektrolit"> Keseimbangan Cairan dan Elektrolit
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('jalan_nafas',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="jalan_nafas"> Jalan Nafas / Pertukaran Gas
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('infeksi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="infeksi"> Infeksi
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('pola_nafas',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" value="pola_nafas"> Pola Nafas
                                </div>
                                <div class="col-md-8">
                                    <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('masalah_keperawatan_lain_lain',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan )) ? 'checked' : '') : '' }}
                                    @endif name="masalah_keperawatan[]" id="masalah_keperawatan_lain_lain" value="masalah_keperawatan_lain_lain"> Lain - lain
                                    <input type="text" readonly value="@if(old('ket_masalah_keperawatan')){{ old('ket_masalah_keperawatan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_masalah_keperawatan : '' }}@endif" id="ket_masalah_keperawatan" name="ket_masalah_keperawatan" style="border: 0; border-bottom: 2px dotted; width: 50%" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                    {{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan != "" ? (in_array('masalah_keperawatan_lain_lain',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->masalah_keperawatan)) ? '' : 'readonly') : '' }}
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
                                    <input type="text" class="form-control" value="@if(old('rencana_keperawatan_satu')){{ old('rencana_keperawatan_satu') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rencana_keperawatan_satu : '' }}@endif" id="rencana_keperawatan_satu" name="rencana_keperawatan_satu">
                                </li>
                                <li>
                                    <input type="text" class="form-control" value="@if(old('rencana_keperawatan_dua')){{ old('rencana_keperawatan_dua') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rencana_keperawatan_dua : '' }}@endif" id="rencana_keperawatan_dua" name="rencana_keperawatan_dua">
                                </li>
                                <li>
                                    <input type="text" class="form-control" value="@if(old('rencana_keperawatan_tiga')){{ old('rencana_keperawatan_tiga') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rencana_keperawatan_tiga : '' }}@endif" id="rencana_keperawatan_tiga" name="rencana_keperawatan_tiga">
                                </li>
                                <li>
                                    <input type="text" class="form-control" value="@if(old('rencana_keperawatan_empat')){{ old('rencana_keperawatan_empat') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rencana_keperawatan_empat : '' }}@endif" id="rencana_keperawatan_empat" name="rencana_keperawatan_empat">
                                </li>
                                <li>
                                    <input type="text" class="form-control" value="@if(old('rencana_keperawatan_lima')){{ old('rencana_keperawatan_lima') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rencana_keperawatan_lima : '' }}@endif" id="rencana_keperawatan_lima" name="rencana_keperawatan_lima">
                                </li>
                                <li>
                                    <input type="text" class="form-control" value="@if(old('rencana_keperawatan_enam')){{ old('rencana_keperawatan_enam') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rencana_keperawatan_enam : '' }}@endif" id="rencana_keperawatan_enam" name="rencana_keperawatan_enam">
                                </li>
                                <li>
                                    <input type="text" class="form-control" value="@if(old('rencana_keperawatan_tujuh')){{ old('rencana_keperawatan_tujuh') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->rencana_keperawatan_tujuh : '' }}@endif" id="rencana_keperawatan_tujuh" name="rencana_keperawatan_tujuh">
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
                                        <input @if(old('diet_nutrisi')) {{ old('diet_nutrisi') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_nutrisi == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_diet_nutrisi"> Tidak
                                        <input @if(old('diet_nutrisi')) {{ old('diet_nutrisi') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_nutrisi == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_diet_nutrisi" class="ml-4"> Ya :
                                        <input type="text" value="@if(old('ket_diet_nutrisi')){{ old('ket_diet_nutrisi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_diet_nutrisi : '' }}@endif" id="ket_diet_nutrisi" name="ket_diet_nutrisi" style="border: 0; border-bottom: 2px dotted;" @if(old('diet_nutrisi')) {{ old('diet_nutrisi') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->diet_nutrisi == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Rehabilitas Medik <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-10">
                                        <input @if(old('rehab_medik')) {{ old('rehab_medik') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->rehab_medik == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_rehab_medik"> Tidak
                                        <input @if(old('rehab_medik')) {{ old('rehab_medik') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->rehab_medik == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_rehab_medik" class="ml-4"> Ya :
                                        <input type="text" value="@if(old('ket_rehab_medik')){{ old('ket_rehab_medik') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_rehab_medik : '' }}@endif" id="ket_rehab_medik" name="ket_rehab_medik" style="border: 0; border-bottom: 2px dotted;" @if(old('rehab_medik')) {{ old('rehab_medik') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->rehab_medik == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Farmasi <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-10">
                                        <input @if(old('farmasi')) {{ old('farmasi') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->farmasi == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_farmasi"> Tidak
                                        <input @if(old('farmasi')) {{ old('farmasi') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->farmasi == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_farmasi" class="ml-4"> Ya :
                                        <input type="text" value="@if(old('ket_farmasi')){{ old('ket_farmasi') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_farmasi : '' }}@endif" id="ket_farmasi" name="ket_farmasi" style="border: 0; border-bottom: 2px dotted;" @if(old('farmasi')) {{ old('farmasi') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->farmasi == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Perawatan Luka <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-10">
                                        <input @if(old('perawatan_luka')) {{ old('perawatan_luka') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->perawatan_luka == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_perawatan_luka"> Tidak
                                        <input @if(old('perawatan_luka')) {{ old('perawatan_luka') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->perawatan_luka == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_perawatan_luka" class="ml-4"> Ya :
                                        <input type="text" value="@if(old('ket_perawatan_luka')){{ old('ket_perawatan_luka') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_perawatan_luka : '' }}@endif" id="ket_perawatan_luka" name="ket_perawatan_luka" style="border: 0; border-bottom: 2px dotted;" @if(old('perawatan_luka')) {{ old('perawatan_luka') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->perawatan_luka == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Manajemen Nyeri <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-10">
                                        <input @if(old('manajemen_nyeri')) {{ old('manajemen_nyeri') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->manajemen_nyeri == 'Tidak' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Tidak" name="radio_manajemen_nyeri"> Tidak
                                        <input @if(old('manajemen_nyeri')) {{ old('manajemen_nyeri') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->manajemen_nyeri == 'Ya' ? 'checked' : '') : '' }} @endif type="radio" value="Ya" name="radio_manajemen_nyeri" class="ml-4"> Ya :
                                        <input type="text" value="@if(old('ket_manajemen_nyeri')){{ old('ket_manajemen_nyeri') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_manajemen_nyeri : '' }}@endif" id="ket_manajemen_nyeri" name="ket_manajemen_nyeri" style="border: 0; border-bottom: 2px dotted;" @if(old('manajemen_nyeri')) {{ old('manajemen_nyeri') ==  'Ya' ? '' : 'readonly' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? (json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->skrining_gizi_perawat)->manajemen_nyeri == 'Ya' ? '' : 'readonly') : 'readonly' }} @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Lain - lain <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" value="@if(old('perencanaan_perawatan_lain_lain')){{ old('perencanaan_perawatan_lain_lain') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perencanaan_perawatan_lain_lain : '' }}@endif" id="perencanaan_perawatan_lain_lain" name="perencanaan_perawatan_lain_lain" style="border: 0; border-bottom: 2px dotted; width: 80%">
                                    </div>
                                </div>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="pagebreak"></div>
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
                            <input @if(old('info_perencanaan_pulang')) {{ old('info_perencanaan_pulang') ==  'Tidak' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->info_perencanaan_pulang == 'Tidak' ? 'checked' : '') : '' }} @endif type="radio" value="Tidak" name="radio_info_perencanaan_pulang"> Tidak
                            <input @if(old('info_perencanaan_pulang')) {{ old('info_perencanaan_pulang') ==  'Ya' ? 'checked' : '' }} @else {{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? ($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->info_perencanaan_pulang == 'Ya' ? 'checked' : '') : 'checked' }} @endif type="radio" value="Ya" name="radio_info_perencanaan_pulang" class="ml-4"> Ya :
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
                                        <input type="text" style="border: 0; border-bottom: 2px dotted; width: 100%" value="@if(old('kondisi_pulang')){{ old('kondisi_pulang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->kondisi_pulang : '' }}@endif" id="kondisi_pulang" name="kondisi_pulang">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Lama Perawatan rata - rata <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" style="border: 0; border-bottom: 2px dotted; " value="@if(old('lama_perawatan')){{ old('lama_perawatan') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->lama_perawatan : '' }}@endif" id="lama_perawatan" name="lama_perawatan"> hari
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Tanggal Perencanaan Pulang <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" style="border: 0; border-bottom: 2px dotted; width: 100%" value="@if(old('tgl_rencana_pulang')){{ old('tgl_rencana_pulang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->tgl_rencana_pulang : '' }}@endif" id="tgl_rencana_pulang" name="tgl_rencana_pulang">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <li>Perawatan lanjutan yang diberikan dirumah : </li>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('perawatan_diri',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @else
                                        {{ 'checked' }}
                                        @endif value="perawatan_diri" name="perawatan_lanjutan[]"> Perawatan diri (Mandiri, BAB/BAK)
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('aktifitas_sehari_hari',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="aktifitas_sehari_hari" name="perawatan_lanjutan[]"> Aktifitas sehari - hari (makan, berjalan)
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('perawatan_luka',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="perawatan_luka" name="perawatan_lanjutan[]"> Perawatan Luka
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('pemberian_minum',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="pemberian_minum" name="perawatan_lanjutan[]"> Pemberian minum/makan melalui AGT
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('perawatan_bayi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="perawatan_bayi" name="perawatan_lanjutan[]"> Perawatan Bayi
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('diet_nutrisi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="diet_nutrisi" name="perawatan_lanjutan[]"> Diet/Nutrisi
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('pemberian_obat',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="pemberian_obat" name="perawatan_lanjutan[]"> Pemberian Obat
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('perawatan_payudara',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="perawatan_payudara" name="perawatan_lanjutan[]"> Perawatan Payudara
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('home_care',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="home_care" name="perawatan_lanjutan[]"> Home Care
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('latihan_gerak',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="latihan_gerak" name="perawatan_lanjutan[]"> Latihan Gerak / Exercise
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('lain_lain',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->perawatan_lanjutan )) ? 'checked' : '' }}
                                        @endif value="lain_lain" name="perawatan_lanjutan[]"> Lain - lain :
                                        <input type="text" value="@if(old('ket_perencanaan_pulang')){{ old('ket_perencanaan_pulang') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_perencanaan_pulang : '' }}@endif" id="ket_perencanaan_pulang" name="ket_perencanaan_pulang" style="border: 0; border-bottom: 2px dotted;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Cara Transportasi Pulang <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('transportasi_mandiri',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_pulang )) ? 'checked' : '' }}
                                        @else
                                        {{ 'checked' }}
                                        @endif value="transportasi_mandiri" name="transportasi_pulang[]"> Mandiri
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('transportasi_dibantu_sebagian',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_pulang )) ? 'checked' : '' }}
                                        @endif value="transportasi_dibantu_sebagian" name="transportasi_pulang[]"> Dibantu Sebagian
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('transportasi_dibantu_keseluruhan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_pulang )) ? 'checked' : '' }}
                                        @endif value="transportasi_dibantu_keseluruhan" name="transportasi_pulang[]"> Dibantu Keseluruhan
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span style="float: right">:</span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('transportasi_menggunakan_rostul',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_pulang )) ? 'checked' : '' }}
                                        @endif value="transportasi_menggunakan_rostul" name="transportasi_pulang[]"> Menggunakan Rostul
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('transportasi_menggunakan_brangkar',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_pulang )) ? 'checked' : '' }}
                                        @endif value="transportasi_menggunakan_brangkar" name="transportasi_pulang[]"> Menggunakan Brangkar
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('transportasi_berjalan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_pulang )) ? 'checked' : '' }}
                                        @endif value="transportasi_berjalan" name="transportasi_pulang[]"> Berjalan
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Transportasi yang digunakan <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('kendaraan_pribadi',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_digunakan_pulang )) ? 'checked' : '' }}
                                        @else
                                        {{ 'checked' }}
                                        @endif value="kendaraan_pribadi" name="transportasi_digunakan_pulang[]"> Kendaraan Pribadi (Mobil, Motor)
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('ambulan',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_digunakan_pulang )) ? 'checked' : '' }}
                                        @endif value="ambulan" name="transportasi_digunakan_pulang[]"> Ambulan
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('kendaraan_umum',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->transportasi_digunakan_pulang )) ? 'checked' : '' }}
                                        @endif value="kendaraan_umum" name="transportasi_digunakan_pulang[]"> Kendaraan Umum
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <li>Barang - barang Milik Pasien <span style="float: right">:</span></li>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('lengkap',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->barang_milik_pasien )) ? 'checked' : '' }}
                                        @else
                                        {{ 'checked' }}
                                        @endif value="lengkap" name="barang_milik_pasien[]"> Lengkap
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" @if(isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3))
                                        {{ in_array('tidak_lengkap',json_decode($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->barang_milik_pasien )) ? 'checked' : '' }}
                                        @endif value="tidak_lengkap" name="barang_milik_pasien[]"> Tidak Lengkap
                                        <input type="text" value="@if(old('ket_barang_tidak_lengkap')){{ old('ket_barang_tidak_lengkap') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->ket_barang_tidak_lengkap : '' }}@endif" id="ket_barang_tidak_lengkap" name="ket_barang_tidak_lengkap" style="border: 0; border-bottom: 2px dotted;">
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
            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_pengkajian" name="jam_pengkajian" value="@if(old('jam_pengkajian')){{ old('jam_pengkajian') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->jam_pengkajian : '' }}@endif">
            WIB
        </div>
        <div class="col-md-6 text-right">
            CIBARUSAH,
            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_pengkajian" name="tgl_pengkajian" value="@if(old('tgl_pengkajian')){{ old('tgl_pengkajian') }}@else{{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->tgl_pengkajian : '' }}@endif">
        </div>
    </div>
    </form>
    {{-- <div class="row pt-5" style="width:100%; margin-left:0">
    <div class="col-md-4"></div>
    <div class="col-md-4" onclick="open_modal_pasien()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Perawat</h5>
    </div>
    <div class="col-md-4"></div>
</div> --}}
    <div class="row mt-4">
        <div class="col-md-12 text-center" onclick="open_modal_ttd(`dua`)">
            @if(!$dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3)
            <br>
            Perawat
            <br>
            <br>
            <br>
            <a class="btn btn-success">Simpan & Verifikasi Perawat</a>
            <br>
            <br>
            <br>
            (.................................................)
            <br>Ttd & Nama Terang
            @else
            @if(isset($employee2))
            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee2->ttd }}" style="height: 4cm; width: 5cm;" alt="">
            @else
            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
            @endif
            <br>({{ $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa3->nama_verifikator : '' }})
            @endif
        </div>
    </div>
    {{-- <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/detail/pdf_formulir_asesmen_awal_pasien_ranap_dewasa?dokumen='.$dokumen->id) }}"
    class="btn btn-success" target="_blank">Download PDF</a>
    @endif
    </div>
    </div> --}}

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
    <div class="modal fade" id="modal_tambah_diagnosa" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asesmen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="submit_diagnosa()" id="form_asesmen">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="POST" />
                    <input type="hidden" name="kode_icd_tindakan" id="kode_icd_tindakan" />
                    <input type="hidden" name="noreg" value="{{ $layanan->id }}" />
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}" />
                    <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}" id="id_dokter" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" readonly class="form-control" value="{{ date('Y-m-d', strtotime($dokumen->created_at)) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Asal Ruangan</label>
                            <input type="text" name="ruangan" id="ruangan" value="{{ $layanan->last_ruangan }}" readonly class="form-control">
                        </div>
                        <hr>
                        <p style="font-weight: bold; font-size:14px;">DATA DOKTER / PSIKOLOG</p>
                        <div class="form-group">
                            <label for="">Dokter / Psikolog</label>
                            <input type="text" name="dokter" value="{{ Auth::user()->realname }}" id="dokter" readonly class="form-control">
                        </div>
                        <input type="hidden" name="nip_dokter" value="{{ $employee ? $employee->nip : '' }}" id="nip_dokter" readonly class="form-control">
                        <hr>
                        <p style="font-weight: bold; font-size:14px;">DIAGNOSA</p>
                        <div id="diagnosa">
                            <div class="form-group">
                                <label for="">Diagnosa Utama</label>
                                <input type="text" class="form-control" name="diagnosa" id="diagnosa_primer">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 1</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_satu" id="diagnosa_sekunder_satu">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 2</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_dua" id="diagnosa_sekunder_dua">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 3</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_tiga" id="diagnosa_sekunder_tiga">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 4</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_empat" id="diagnosa_sekunder_empat">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 5</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_lima" id="diagnosa_sekunder_lima">
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

    {{-- RESEP --}}
    <div class="modal fade" id="modal_dokter_e_resep" tabindex="-1" style="overflow-y: scroll;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="modal_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p style="text-align:center"><b>RUMAH SAKIT HARAPAN MULIA</b><br>Jl. Raya Cibarusah No.
                                    5 Kebon Kopi, Cibarusah Jaya
                                    <br><b>Kabupaten Bekasi Jawa Barat</b>
                                </p>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 40%">Dokter</td>
                                        <td style="width: 3%"> : </td>
                                        <td style="width: 57%" id="preview_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>SIP</td>
                                        <td> : </td>
                                        <td id="preview_sip_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Unit Pelayanan</td>
                                        <td> : </td>
                                        <td id="preview_unit_pelayanan" style="text-transform: uppercase">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Catatan Obat Racikan</td>
                                        <td> : </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td id="preview_catatan_obat_racikan" colspan="3">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td colspan="4" style="text-align: right">
                                            Bekasi, <span id="preview_tanggal"></span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="width: 100%;" id="preview_list_obat"></table>
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
                                        <td style="text-transform: uppercase">
                                            {{ str_replace('_', ' ', $layanan->carabayar) }}
                                        </td>
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
    <div class="modal fade" id="modal_list_obat" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="hidden" id="tipe_form_search_obat">
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

    <!-- modal list riwayat eResep -->
    <div class="modal fade" id="modal_list_riwayat_eresep" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Riwayat eResep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_browse_riwayat_eresep_button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div id='riwayat_eresep_section' class="col-lg-7">
                            <div id="msg_list_riwayat_eresep"></div>
                            <table class="table-striped" id="tabel_list_riwayat_eresep" style="width: 100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No. Resep</th>
                                        <th>Tanggal</th>
                                        <th>Nama Dokter</th>
                                        <th>Poli</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id='detail_riwayat_eresep_section' class="col-lg-5">
                            <table class="table-striped" id="tabel_list_detail_riwayat_eresep" style="width: 100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama Obat</th>
                                        <th>Signa</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- end modal list riwayat eResep -->

    <!-- modal e_resep -->
    <div class="modal fade" style="overflow-y: scroll" id="modal_resep" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="hidden" name="id_resep" id="id_resep">
                    <input type="hidden" name="id" id="id_formulir_resep">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="ruangan" value="{{ $layanan->last_ruangan }}">
                    <div class="modal-body">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Waktu</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" name="waktu" id="e_resep_waktu" type="date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">NRM</label>
                                    <input class="form-control" name="nrm" value="{{ $layanan->nrm }}" id="e_resep_nrm" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input class="form-control" name="usia" value="{{ $layanan->umur }} Tahun" id="e_resep_usia" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Asuransi</label>
                                    <input class="form-control" name="asuransi" id="e_resep_asuransi" value="{{ $layanan->asuransi }}" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dokter" value="{{ Auth::user()->realname }}" id="e_resep_dokter" type="text" readonly>
                                        <input class="form-control" name="id_dokter" value="{{ Auth::user()->id }}" id="e_resep_id_dokter" type="hidden">
                                        <div class="input-grou-append">
                                            <button class="btn btn-dark" type="button" onclick="open_modal_dokter_e_resep('tambah')"><i class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" name="nama" value="{{ $layanan->nama_pasien }}" id="e_resep_nama" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Badan</label>
                                    <input class="form-control" name="berat_badan" value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '' }}" id="e_resep_berat_badan" type="text" readonly>
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
                                    <input class="form-control" name="sip" id="e_resep_sip" value="{{ Session::has('sip') ? Session::get('sip') : '' }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="alamat" id="e_resep_alamat" value="{{ $layanan->alamat }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Pasien</label>
                                    <input class="form-control" name="jenis_pasien" id="e_resep_jenis_pasien" value="{{ $layanan->carabayar }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Obat Racikan</label>
                                    <textarea style="height: 100%;" name="catatan_obat_racikan" id="e_resep_obat_racikan" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">No. Reg</label>
                                    <input class="form-control" name="noreg" value="{{ $dokumen->noreg }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Telp</label>
                                    <input class="form-control" name="telp" value="{{ $layanan->telpon }}" id="e_resep_telp" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <input class="form-control" name="perusahaan" id="e_resep_perusahaan" value="{{ $layanan->nama_perusahaan }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Catatan</label>
                                    <textarea style="height: 100%;" name="catatan" id="e_resep_catatan" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12" style="border: 1px dashed"></div>
                        </div>
                        <div class="row pt-3" style="width: 100%; margin-left: 0;">
                            <input type="hidden" id="e_resep_id_obat" readonly class="form-control">
                            <input type="hidden" id="e_resep_index_edit" readonly class="form-control">
                            <div class="col-lg-4">
                                {{-- <div class="form-group text-center">
                                <button class="btn btn-dark" type="button" style="color:#fff;" onclick="browse_riwayat_eresep('add')">Copy Riwayat eResep</button>
                            </div> --}}
                                <div class="form-group" style="display: none">
                                    <label for="">Kode</label>
                                    <input type="text" id="e_resep_kode_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Obat</label>
                                    <div class="input-group">
                                        <input type="text" id="e_resep_nama_obat" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button" onclick="open_modal_list_obat()"><i class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
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
                                    <label for="">Harga (Rp.)</label>
                                    <input type="text" id="e_resep_harga_obat" readonly class="form-control">
                                    <input type="hidden" id="e_resep_markup" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" id="e_resep_jumlah_obat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Signa</label>
                                    <input class="form-control" name="signa" id="e_resep_signa" type="text">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;" onclick="simpan_detail_e_resep()">Simpan
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-8 pr-0" style="padding-top: 30px; font-size:12px;">
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
    {{-- END OF RESEP --}}

    {{-- Lab --}}
    <div class="modal fade" id="modal_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll">
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
                    <input type="hidden" name="id_pesanan" id="id_lab" value="{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) && $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id_pesanan_lab != 0 ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id_pesanan_lab : '' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" class="form-control" name="noreg" value="{{ $layanan->id }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" name="nama_pasien" value="{{ $layanan->nama_pasien }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">NRM</label>
                            <input type="text" name="nrm" value="{{ $layanan->nrm }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">L/P</label>
                            <select name="kelamin" disabled class="form-control">
                                <option value="1" @if ($layanan->kelamin == 1) {{ 'selected' }} @endif>
                                    Perempuan
                                </option>
                                <option value="0" @if ($layanan->kelamin == 0) {{ 'selected' }} @endif>
                                    Laki-Laki
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Umur</label>
                            <input type="text" value="{{ $layanan->umur }}" name="umur" class="form-control">
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
                        <input type="hidden" name="jenis_pasien" value="{{ $layanan->carabayar }}" class="form-control">
                        {{-- </div> --}}
                        <div class="form-group">
                            <label for="">Ruangan</label>
                            <select id="ruangan_lab" name="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($ruangan as $ru)
                                <option value="{{ $ru->slug }}" @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                    {{ $ru->nama }}
                                </option>
                                @endforeach
                                <option value="pendaftaran" @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                                </option>
                                <option value="laboratory" @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                                </option>
                                <option value="radiology" @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                                    Radiology
                                </option>
                                <option value="elektromedis" @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                                </option>
                                <option value="medical_checkup" @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                                </option>
                            </select>
                            {{-- <input type="text" name="ruangan" value="{{ $layanan->last_ruangan }}"
                            class="form-control"> --}}
                        </div>
                        <div class="form-group">
                            <label for="">BED</label>
                            <input type="text" readonly value="{{ $layanan->last_bed != "" ? $layanan->last_bed : "" }}" name="last_bed"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" value="{{ date('Y-m-d') }}" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select id="kelas" name="kelas" style="pointer-events: none;" onclick="return false;" onkeydown="return false;" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($list_kelas as $kls)
                                <option value="{{ $kls->slug }}" @if ($kelas_lab) @if ($kls->slug == $kelas_lab->value)
                                    {{ 'selected' }} @endif
                                    @endif>{{ $kls->nama }}
                                </option>
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
                            <input type="text" id="dokter_lab" name="dokter" placeholder="Pilih dokter" value="{{ Auth::user()->realname }}" class="form-control">
                            <input type="hidden" value="{{ Auth::user()->id }}" id="id_dokter_lab" name="id_dokter">
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
                            <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan" style="width: 100%" class="form-control">
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

    <div class="modal fade" id="modal_hasil_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    <div class="modal fade" id="modal_hasil_radiologi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="modal_pesanan_radiologi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" name="noreg" value="{{ $layanan->id }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pasien</label>
                            <input type="text" name="pasien" value="{{ $layanan->nama_pasien }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">NRM</label>
                            <input type="text" name="nrm" value="{{ $layanan->nrm }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <input type="hidden" name="kelamin" value="{{ $layanan->kelamin }}" class="form-control">
                            <input type="text" value="{{ $layanan->kelamin == 0 ? 'Laki-laki' : 'Perempuan' }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Umur</label>
                            <input type="text" name="umur" value="{{ $layanan->umur }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Ruangan</label>
                            <select id="ruangan_rad" name="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($ruangan as $ru)
                                <option value="{{ $ru->slug }}" @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                    {{ $ru->nama }}
                                </option>
                                @endforeach
                                <option value="pendaftaran" @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                                </option>
                                <option value="laboratory" @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                                </option>
                                <option value="radiology" @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                                    Radiology
                                </option>
                                <option value="elektromedis" @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                                </option>
                                <option value="medical_checkup" @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
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
                            <input type="text" name="dokter" value="{{ Auth::user()->realname }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan Pemeriksaan</label>
                            <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan_radiologi" style="width: 100%" class="form-control">
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- awal script --}}
@include('erm.script_riwayat_laboratorium')
@include('erm.script_riwayat_radiologi')
<script>
    var riwayat_penggunaan_obat = [];
    var tipe_diagnosa = '';

    $(document).ready(function() {
        hitung_score();

        riwayat_penggunaan_obat = '{{ isset($dokumen->formulir_asesmen_awal_pasien_ranap_dewasa) ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->list_riwayat_penggunaan_obat : "[]" }}';
    });

    function open_modal_ttd(sts_simpan) {
        $('#sts_simpan').val(sts_simpan);
        $('#modal_petugas').modal('show');
    }

    function update_pesanan() {
        $.ajax({
            url: "{{ url('ajax_request/update_pesanan') }}",
            method: 'post',
            data: {
                id_dokumen: '{{ $dokumen->id }}',
                dokumen: 'formulir_asesmen_awal_pasien_ranap_dewasa',
                id_pesanan_lab: id_pesanan_lab,
                id_pesanan_rad: id_pesanan_rad,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
            }
        })
    }

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }

    function hitung_score() {
        var riwayat_jatuh = parseInt($('#riwayat_jatuh').val());
        var diagnosis_sekunder = parseInt($('#diagnosis_sekunder').val());
        var ambulasi = parseInt($('#ambulasi').val());
        var heparin_lock = parseInt($('#heparin_lock').val());
        var gaya_berjalan = parseInt($('#gaya_berjalan').val());
        var status_mental = parseInt($('#status_mental').val());

        var total = riwayat_jatuh + diagnosis_sekunder + ambulasi + heparin_lock + gaya_berjalan + status_mental;
        $('#total_score').val(total);
        console.log(total);
        if (total >= 0 && total <= 24) {
            $('#tidak_risiko').attr('checked', true);
            $('#risiko_rendah').removeAttr('checked');
            $('#risiko_tinggi').removeAttr('checked');
        } else if (total >= 25 && total <= 50) {
            $('#tidak_risiko').removeAttr('checked');
            $('#risiko_rendah').attr('checked', true);
            $('#risiko_tinggi').removeAttr('checked');
        } else if (total >= 51) {
            $('#tidak_risiko').removeAttr('checked');
            $('#risiko_rendah').removeAttr('checked');
            $('#risiko_tinggi').attr('checked', true);
        }

    }

    function open_modal_tambah_riwayat_penggunaan_obat() {
        $('#modal_tambah_riwayat_penggunaan_obat').modal('show');
    }

    function open_modal_ubah_riwayat_penggunaan_obat(index) {
        $('#edit_index_riwayat_penggunaan_obat').val(index);
        $('#edit_nama_obat').val(riwayat_penggunaan_obat[index].nama_obat);
        $('#edit_dosis').val(riwayat_penggunaan_obat[index].dosis);
        $('#edit_cara_pemberian').val(riwayat_penggunaan_obat[index].cara_pemberian);
        $('#edit_frekuensi').val(riwayat_penggunaan_obat[index].frekuensi);
        $('#edit_waktu_pemberian').val(riwayat_penggunaan_obat[index].waktu_pemberian);
        $('#modal_ubah_riwayat_penggunaan_obat').modal('show');
    }

    $('#form_tambah_riwayat_penggunaan_obat').submit(function() {
        window.event.preventDefault();
        riwayat_penggunaan_obat.push({
            'id': 0,
            'nrm': '{{ $layanan->nrm }}',
            'nama_obat': $('#nama_obat').val(),
            'dosis': $('#dosis').val(),
            'cara_pemberian': $('#cara_pemberian').val(),
            'frekuensi': $('#frekuensi').val(),
            'waktu_pemberian': $('#waktu_pemberian').val().replace('T', ' '),
            'prop': ''
        });
        $('#modal_tambah_riwayat_penggunaan_obat').modal('hide');
        $('#form_tambah_riwayat_penggunaan_obat')[0].reset();
        render_riwayat_penggunaan_obat();
    })

    $('#form_ubah_riwayat_penggunaan_obat').submit(function() {
        window.event.preventDefault();
        riwayat_penggunaan_obat[$('#edit_index_riwayat_penggunaan_obat').val()] = {
            'id': riwayat_penggunaan_obat[$('#edit_index_riwayat_penggunaan_obat').val()].id,
            'nrm': '{{ $layanan->nrm }}',
            'nama_obat': $('#edit_nama_obat').val(),
            'dosis': $('#edit_dosis').val(),
            'cara_pemberian': $('#edit_cara_pemberian').val(),
            'frekuensi': $('#edit_frekuensi').val(),
            'waktu_pemberian': $('#edit_waktu_pemberian').val().replace('T', ' '),
            'prop': ''
        };
        $('#modal_ubah_riwayat_penggunaan_obat').modal('hide');
        $('#form_ubah_riwayat_penggunaan_obat')[0].reset();
        render_riwayat_penggunaan_obat();
    })

    function hapus_riwayat_penggunaan_obat(index) {
        if (confirm('Yakin melanjutkan hapus riwayat penggunaan_obat ?')) {
            riwayat_penggunaan_obat[index].prop = 'del';
            render_riwayat_penggunaan_obat();
        }
    }

    function render_riwayat_penggunaan_obat() {
        let count = 0;
        for (let i = 0; i < riwayat_penggunaan_obat.length; i++) {
            if (riwayat_penggunaan_obat[i].prop == '') {
                count++;
            }
        }
        if (count < 1) {
            $('#list_riwayat_penggunaan_obat').html(
                '<tr><td colspan="12" class="text-center">Data tidak ditemukan</td></tr>');
            return;
        }
        console.log(riwayat_penggunaan_obat);
        var ins = '';
        for (let i = 0; i < riwayat_penggunaan_obat.length; i++) {
            if (riwayat_penggunaan_obat[i].prop == '') {
                ins += '<tr>' +
                    '<td class="text-center"><input type="hidden" name="nama_obat[]" value="' + riwayat_penggunaan_obat[i].nama_obat + '">' + riwayat_penggunaan_obat[i].nama_obat + '</td>' +
                    '<td class="text-center"><input type="hidden" name="dosis[]" value="' + riwayat_penggunaan_obat[i].dosis + '">' + riwayat_penggunaan_obat[i].dosis + '</td>' +
                    '<td class="text-center"><input type="hidden" name="cara_pemberian[]" value="' + riwayat_penggunaan_obat[i].cara_pemberian + '">' + riwayat_penggunaan_obat[i].cara_pemberian + '</td>' +
                    '<td class="text-center"><input type="hidden" name="frekuensi[]" value="' + riwayat_penggunaan_obat[i].frekuensi + '">' + riwayat_penggunaan_obat[i].frekuensi + '</td>' +
                    '<td class="text-center"><input type="hidden" name="waktu_pemberian[]" value="' + riwayat_penggunaan_obat[i].waktu_pemberian + '">' + riwayat_penggunaan_obat[i].waktu_pemberian + '</td>' +
                    '<td>' +
                    '<div style="display:flex; flex-directiion:row; justify-content:center;">' +
                    '<button type="button" class="btn btn-warning" onclick="open_modal_ubah_riwayat_penggunaan_obat(' + i +
                    ')" style="color:#fff;"><i class="fa fa-pencil"></i></button>' +
                    '<button type="button" class="btn btn-danger ml-1" onclick="hapus_riwayat_penggunaan_obat(' + i +
                    ')"><i class="fa fa-trash"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
            }
        }
        $('#list_riwayat_penggunaan_obat').html(ins);
    }

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

    var sig = $('#sig').signature({
        syncField: '#gambar_status_lokalis',
        syncFormat: 'PNG',
    });

    $('#btn_clear').click(function() {
        sig.signature('clear');
    })

    function set_password() {
        var sts_simpan = $('#sts_simpan').val();
        if (sts_simpan == "satu") {
            $('#pass').val($('#pass_user').val());
            // if (riwayat_penggunaan_obat.length > 0) {
            //     $('#hide_list_riwayat_penggunaan_obat').val(serialize(riwayat_penggunaan_obat));
            // }
            $('#form1').submit();
        } else if (sts_simpan == "dua") {
            $('#pass2').val($('#pass_user').val());
            $('#form2').submit();
        }
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }

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
</script>
{{--diagnosa--}}
<script>
    $(document).ready(function() {
        $("#e_resep_nama_obat").devbridgeAutocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            params: {
                'depo': function() {
                    return $('#e_resep_depo_tujuan').val();
                }
            },
            onSelect: function(suggestion) {
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

        $("#edit_resep_nama_obat").devbridgeAutocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            params: {
                'depo': function() {
                    return $('#edit_resep_depo_tujuan').val();
                }
            },
            onSelect: function(suggestion) {
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
        console.log(tipe)
        if (tipe == 'diagnosa') {
            $("#diagnosa").removeAttr('hidden');
            $("#pembanding").attr('hidden', true);
        } else if (tipe == 'banding') {
            $("#diagnosa").attr('hidden', true);
            $("#pembanding").removeAttr('hidden');
        }
        $.ajax({
            url: "{{ url('ajax_request/diagnosa_by_noreg') }}",
            data: {
                noreg: '{{ $layanan->id }}',
            },
            success: function(response) {
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
            success: function(response) {
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
                        '<a class="btn btn-warning" onclick="open_form_tambah_diagnosa(`diagnosa`)" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></a>'
                    );
                    $('#box_btn_asesmen_pembanding').html(
                        '<a class="btn btn-warning" onclick="open_form_tambah_diagnosa(`banding`)" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></a>'
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

<!-- Script Resep -->
<script>
    let detail_e_resep = [];

    function empty_detail_e_resep() {
        if (detail_e_resep.length > 0)
            detail_e_resep.splice(0, detail_e_resep.length);
    }

    function preview_riwayat_eresep(id, action) {
        $.ajax({
            type: 'GET',
            url: '<?php echo url("ajax_request/preview_riwayat_eresep"); ?>',
            data: {
                'id': id
            },
            success: function(response) {
                let html = "";
                if (response.data != null) {
                    for (let i = 0; i < response.data.length; i++) {
                        html += "<tr>" +
                            "<td>" + (i + 1) + "</td>" +
                            "<td>" + response.data[i].nama_obat + "</td>" +
                            "<td>" + response.data[i].signa + "</td>" +
                            "<td>" + response.data[i].jumlah + " " + response.data[i].satuan + "</td>" +
                            "</tr>";
                    };
                }
                $('#tabel_list_detail_riwayat_eresep tbody').html(html);
                reset_detail_riwayat_eresep();
                $('#button_preview_' + id).hide();
                $('#button_action_' + id).show();
            }
        });
    }

    function select_riwayat_eresep(id, action) {
        $.ajax({
            type: 'GET',
            url: '<?php echo url("ajax_request/select_riwayat_eresep"); ?>',
            data: {
                'id': id
            },
            success: function(response) {
                console.log(response);

                empty_detail_e_resep();
                if (response.data.length > 0) {
                    for (let i = 0; i < response.data.length; i++) {
                        detail_e_resep.push({
                            id: '',
                            id_obat: response.data[i].id_obat,
                            kode_obat: response.data[i].kode_obat,
                            nama_obat: response.data[i].nama_obat,
                            nama_jenis_obat: response.data[i].nama_jenis_obat,
                            jumlah: parseFloat(response.data[i].jumlah),
                            satuan: response.data[i].satuan,
                            aturan_pakai: response.data[i].aturan_pakai ? response.data[i].aturan_pakai : '',
                            obat_luar_check: response.data[i].obat_luar_check ? response.data[i].obat_luar_check : 0,
                            malam_check: response.data[i].malam_check ? response.data[i].malam_check : 0,
                            malam: response.data[i].malam ? response.data[i].malam : '',
                            sore_check: response.data[i].sore_check ? response.data[i].sore_check : 0,
                            sore: response.data[i].sore ? response.data[i].sore : '',
                            siang_check: response.data[i].siang_check ? response.data[i].siang_check : 0,
                            siang: response.data[i].siang ? response.data[i].siang : '',
                            pagi_check: response.data[i].pagi_check ? response.data[i].pagi_check : 0,
                            pagi: response.data[i].pagi ? response.data[i].pagi : '',
                            pemakaian: response.data[i].pemakaian,
                            keterangan_tambahan: response.data[i].keterangan_tambahan ? response.data[i].keterangan_tambahan : '',
                            satuan_pakai: response.data[i].satuan_pakai,
                            takaran_pakai: response.data[i].takaran_pakai,
                            jumlah_pakai_sehari: response.data[i].jumlah_pakai_sehari,
                            aturan_pakai_mode: response.data[i].aturan_pakai_mode ? response.data[i].aturan_pakai_mode : '',
                            harga: parseFloat(response.data[i].harga).toFixed(2),
                            markup: response.data[i].markup,
                            signa: response.data[i].signa,
                            deleted: false
                        });
                    }
                }
                render_detail_resep();

                reset_detail_riwayat_eresep();
                $('#modal_list_riwayat_eresep').modal('hide');
                if (action == "add") {
                    $('#modal_resep').modal('show');
                } else if (action == "edit") {
                    $('#modal_edit_resep').modal('show');
                }
            }
        });
    }

    function reset_detail_riwayat_eresep() {
        const n_row = $('#tabel_list_riwayat_eresep tbody tr').length;
        for (let i = 0; i < n_row; i++) {
            const id = $('#tabel_list_riwayat_eresep tbody tr:eq(' + i + ') td:eq(0)').text();
            $('#button_preview_' + id).show();
            $('#button_action_' + id).hide();
        }
    }

    function browse_riwayat_eresep(action) {
        let prefix = "e_resep";
        if (action == "edit") {
            prefix = "edit_resep";
        }

        const nrm_pasien = $("#" + prefix + "_nrm").val();
        const id_dokter = $("#" + prefix + "_id_dokter").val();

        if (nrm_pasien == "" || nrm_pasien == null || id_dokter == "" || id_dokter == null) {
            return;
        }

        $.ajax({
            type: 'GET',
            url: '<?php echo url("ajax_request/list_riwayat_eresep"); ?>',
            data: {
                'nrm_pasien': nrm_pasien,
                'id_dokter': id_dokter
            },
            success: function(response) {
                let html = "";
                if (response.data != null) {
                    for (let i = 0; i < response.data.length; i++) {
                        html += "<tr>" +
                            "<td>" + response.data[i].id + "</td>" +
                            "<td>" + response.data[i].tanggal + "</td>" +
                            "<td>" + response.data[i].nama_dokter + "</td>" +
                            "<td>" + response.data[i].ruangan + "</td>" +
                            "<td>" +
                            '<div class="text-center">' +
                            '<button id="button_preview_' + response.data[i].id + '" class="btn btn-dark" onclick="preview_riwayat_eresep(' + "'" + response.data[i].id + "','" + action + "'" + ')">' +
                            '<i class="fa fa-arrow-right"></i>' +
                            '</button>' +
                            '<div id="button_action_' + response.data[i].id + '" class="btn-group" role="group" style="display: none;">' +
                            '<button class="btn btn-danger" onclick="clear_detail_riwayat_eresep(' + "'" + response.data[i].id + "'" + ')">' +
                            '<i class="fa fa-times"></i>' +
                            '</button>' +
                            '<button class="btn btn-success" onclick="select_riwayat_eresep(' + "'" + response.data[i].id + "','" + action + "'" + ')">' +
                            '<i class="fa fa-check"></i>' +
                            '</button>' +
                            '</div>' +
                            '</div>' +
                            "</td>" +
                            "</tr>";
                    };
                }
                $('#tabel_list_riwayat_eresep tbody').html(html);
                if (action == "add") {
                    $('#modal_resep').modal('hide');
                } else if (action == "edit") {
                    $('#modal_edit_resep').modal('hide');
                }
                $('#close_browse_riwayat_eresep_button').removeAttr('tag');
                $('#close_browse_riwayat_eresep_button').attr('tag', action);
                reset_detail_riwayat_eresep();
                $('#modal_list_riwayat_eresep').modal('show');
            }
        });
    }

    $("#e_resep_nama_obat").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        params: {
            'depo': function() {
                return $('#e_resep_depo_tujuan').val();
            }
        },
        onSelect: function(suggestion) {
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

    function dmyhi_to_dmy(deta) {
        if (deta == null || deta == '') {
            return '';
        }
        let temp = deta.split(' ');
        let tgl = temp[0].split('-');
        return tgl[2] + '-' + tgl[1] + '-' + tgl[0];
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function rupiah(param) {
        if (param == '' || param == null) {
            return '';
        }
        var temp = param.toString().replaceAll('.', ',');
        return temp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function open_modal_resep(id, id_formulir) {
        $('#id_resep').val(id);
        $('#id_formulir_resep').val(id_formulir);

        if (id == 0) {
            $('#modal_resep').modal('show');
        }

        $.ajax({
            url: "{{ url('ajax_request/select_resep') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }

                console.log("{{Session::get('sip')}}");

                $('#e_resep_obat_racikan').val(response.catatan_obat_racikan);
                $('#e_resep_catatan').val(response.catatan);
                $('#e_resep_dokter').val(Object.keys(response).length > 0 ? response.nama_dokter : '{{ Auth::user()->realname }}');
                $('#e_resep_id_dokter').val(Object.keys(response).length > 0 ? response.id_dokter : '{{ Auth::user()->id }}');
                $('#e_resep_sip').val(Object.keys(response).length > 0 ? response.sip_dokter : '{{ Session::get("sip") }}');

                detail_e_resep = [];

                if (Object.keys(response).length > 0) {
                    for (let i = 0; i < response.detail.length; i++) {
                        detail_e_resep[i] = response.detail[i];
                        detail_e_resep[i].deleted = false;
                    }
                }

                render_detail_resep();

                $('#modal_resep').modal('show');
            }
        })
    }

    function open_modal_list_obat() {
        if ($('#e_resep_depo_tujuan').val() == '') {
            alert('Pilih depo tujuan dahulu');
            return;
        }
        $('#modal_resep').modal('hide');
        get_list_obat();
        $('#modal_list_obat').modal('show');
    }

    function get_list_obat() {
        $('#msg_list_obat').html('');
        if ($.fn.DataTable.isDataTable("#tabel_list_obat")) {
            $('#tabel_list_obat').DataTable().clear().destroy();
        }
        $('#tabel_list_obat').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: "../../ajax_request/list_obat?depo=" + $('#e_resep_depo_tujuan').val() + '&kriteria=' + $('#search_obat').val(),
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
                    render: function(data, type, row) {
                        return '';
                    }
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    render: function(data, type, row) {
                        return '';
                    }
                },
                {
                    data: 'sisa',
                    name: 'sisa',
                    render: function(data, type, row) {
                        return data + ' ' + capitalizeFirstLetter(row.satuan);
                    }
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<div class="text-center">' +
                            '<button onclick="get_detail_obat(' + "'" + data + "','" + row.kode_obat +
                            "','" + row.nama_obat + "','" + row.satuan + "','" + row.nama_jenis_obat +
                            "','" + row.sisa + "'" +
                            ')" class="btn btn-dark"><i class="fa fa-check"></i></button>' +
                            '</div>';
                    }
                },
            ]
        });
    }

    $('#form_search_obat').submit(function(e) {
        e.preventDefault();
        get_list_obat();
    })

    function get_detail_obat(param, kode, nama, satuan, jenis, sisa) {
        $('#msg_list_obat').html(loading('Sedang mengambil harga obat, harap tunggu...', 'info'));
        $('#e_resep_id_obat').val(param);
        $('#e_resep_kode_obat').val(kode);
        $('#e_resep_nama_obat').val(nama);
        $('#e_resep_satuan_obat').val(satuan);
        $('#e_resep_jenis_obat').val(jenis);
        $('#e_resep_sisa_obat').val(sisa);
        get_harga_obat(param);
    }

    function get_harga_obat(param) {
        $.ajax({
            url: "{{ url('ajax_request/harga_obat') }}",
            data: {
                noreg: "{{ $layanan->id }}",
                id_obat: param,
                depo: $('#e_resep_depo_tujuan').val()
            },
            success: function(response) {
                if (response == null) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">Harga obat tidak ditemukan</div>');
                    return;
                } else if (response.code == 500) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">' + response.message + '</div>');
                    return;
                }
                $('#e_resep_harga_obat').val(rupiah(response.toFixed(2)));
                $('#modal_list_obat').modal('hide');
                $('#modal_resep').modal('show');
            }
        })
    }

    function simpan_detail_e_resep() {
        if (
            $('#e_resep_sisa_obat').val() == '' ||
            $('#e_resep_satuan_obat').val() == '' ||
            $('#e_resep_harga_obat').val() == ''
        ) {
            alert('Obat tidak valid');
            return;
        }

        if ($('#e_resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }
        if ($('#e_resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }

        let obj_ins = {
            id: $('#e_resep_index_edit').val() != '' ? detail_e_resep[$('#e_resep_index_edit').val()].id : '',
            id_obat: parseInt($('#e_resep_id_obat').val()),
            kode_obat: $('#e_resep_kode_obat').val(),
            nama_obat: $('#e_resep_nama_obat').val(),
            nama_jenis_obat: $('#e_resep_jenis_obat').val(),
            jumlah: parseFloat($('#e_resep_jumlah_obat').val()),
            satuan: $('#e_resep_satuan_obat').val(),
            aturan_pakai: $('#e_resep_aturan_pakai').val() != undefined ? $('#e_resep_aturan_pakai').val() : '',
            obat_luar_check: $('#e_resep_obat_luar_aktif').val() != undefined ? $('#e_resep_obat_luar_aktif').val() : '',
            malam_check: $('#e_resep_malam').is(':checked') ? 1 : 0,
            malam: "",
            sore_check: $('#e_resep_sore').is(':checked') ? 1 : 0,
            sore: "",
            siang_check: $('#e_resep_siang').is(':checked') ? 1 : 0,
            siang: "",
            pagi_check: $('#e_resep_pagi').is(':checked') ? 1 : 0,
            pagi: "",
            pemakaian: $('#e_resep_pemakaian').val() != undefined ? $('#e_resep_pemakaian').val() : '',
            keterangan_tambahan: "",
            satuan_pakai: $('#e_resep_satuan_obat').val(),
            takaran_pakai: $('#e_resep_satuan_pakai').val() != undefined ? $('#e_resep_satuan_pakai').val() : '',
            jumlah_pakai_sehari: $('#e_resep_jumlah_pakai').val() != undefined ? $('#e_resep_jumlah_pakai').val() : '',
            aturan_pakai_mode: $('#e_resep_aturan_pakai_mode').val() != undefined ? $('#e_resep_aturan_pakai_mode').val() : '',
            harga: parseFloat($('#e_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(
                ',', '.')),
            markup: $('#e_resep_markup').val() != undefined ? parseInt($('#e_resep_markup').val()) : '',
            signa: $('#e_resep_signa').val(),
            deleted: false
        };

        if ($('#e_resep_index_edit').val() != '') {
            detail_e_resep[$('#e_resep_index_edit').val()] = obj_ins;
        } else {
            detail_e_resep.push(obj_ins);
        }

        console.log(detail_e_resep);

        $('#e_resep_index_edit').val('');
        $('#e_resep_id_obat').val('');
        $('#e_resep_kode_obat').val('');
        $('#e_resep_nama_obat').val('');
        $('#e_resep_jenis_obat').val('');
        $('#e_resep_sisa_obat').val('');
        $('#e_resep_satuan_obat').val('');
        $('#e_resep_jumlah_obat').val('');
        $('#e_resep_harga_obat').val('');
        $('#e_resep_signa').val('');
        $('#e_resep_signa').val('');

        render_detail_resep();
    }

    function render_detail_resep() {
        var ins = '';
        var footer = '';
        let jml = 0;
        for (let i = 0; i < detail_e_resep.length; i++) {
            if (!detail_e_resep[i].deleted) {
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
                    '<td class="text-center" style="display:inline-flex;">' +
                    '<button onclick="edit_detail_e_resep(' + i + ')" class="btn btn-warning mr-1" style="color:#fff" type="button"><i class="fa fa-pencil"></i></button>' +
                    '<button onclick="hapus_detail_e_resep(' + i + ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>' +
                    '</td>' +
                    '</tr>';
                jml += parseFloat((detail_e_resep[i].harga * detail_e_resep[i].jumlah).toFixed(2));
            }
        }
        if (detail_e_resep.length > 0) {
            footer = '<tr>' +
                '<td colspan="6" style="text-align:right; font-weight:bold;">Total : </td>' +
                '<td style="font-weight:bold;">Rp. ' + rupiah(jml.toFixed(2)) + '</td>' +
                '<td colspan="2"></td>' +
                '</tr>';
        }
        $('#list_detail_e_resep').html(ins);
        $('#footer_list_detail_e_resep').html(footer);
    }

    function edit_detail_e_resep(index) {
        $('#e_resep_index_edit').val(index);
        $('#e_resep_id_obat').val(detail_e_resep[index].id_obat);
        $('#e_resep_kode_obat').val(detail_e_resep[index].kode_obat);
        $('#e_resep_nama_obat').val(detail_e_resep[index].nama_obat);
        $('#e_resep_jenis_obat').val(detail_e_resep[index].nama_jenis_obat);
        $('#e_resep_satuan_obat').val(detail_e_resep[index].satuan);
        $('#e_resep_jumlah_obat').val(detail_e_resep[index].jumlah);
        $('#e_resep_harga_obat').val(detail_e_resep[index].harga);
        $('#e_resep_signa').val(detail_e_resep[index].signa);

        select_obat(detail_e_resep[index].id_obat);
    }

    function select_obat(id) {
        let prefix = 'e';

        $.ajax({
            url: "{{ url('ajax_request/select_obat') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                $('#e_resep_sisa_obat').val(response.sisa);
            }
        })
    }

    function hapus_detail_e_resep(index) {
        detail_e_resep[index].deleted = true;
        render_detail_resep();
    }

    $('#form_e_resep').submit(function(e) {
        e.preventDefault();
        $('#detail_resep').val(JSON.stringify(detail_e_resep));
        toastr.warning('Sedang menyimpan resep, harap tunggu...');
        $.ajax({
            url: "{{ url('e_rekam_medis/formulir_asesmen_awal_pasien_rawat_inap_dewasa/ajax_request/resep_store') }}",
            method: 'post',
            data: $('#form_e_resep').serialize(),
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return
                }
                $('#modal_resep').modal('hide');
                toastr.success(response.message);
                // for (let i = 0; i < data.length; i++) {
                //     if (data[i].id == response.data.id) {
                //         data[i] = response.data;
                //         break;
                //     }
                // }
                $('#box_resep').html(render_resep(response.data));
                // render_dokumen();
            }
        })
    })

    function render_resep(deta) {
        if (deta.id_resep == 0) {
            return '<button class="btn btn-dark" onclick="open_modal_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "','" + deta.id + "'" + ')"><i class="fa fa-plus"></i></button><br>';
        }
        var ins = '<div style="display: flex; flex-direction: row">' +
            '<div>' +
            (deta.resep ? deta.resep.locked == 0 ? '<button type="button" data-toggle="tooltip" title="Ubah Resep" class="btn btn-warning" onclick="open_modal_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "','" + deta.id + "'" + ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>' : '' : '') +
            '<button type="button" data-toggle="tooltip" title="Preview Resep" class="btn btn-info ml-1" onclick="preview_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "'" + ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
            (deta.resep ? deta.resep.locked == 0 ? '<button type="button" data-toggle="tooltip" title="Lock Resep" class="btn btn-info ml-1" onclick="lock_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "', '" + deta.id + "'" + ')"><i class="fa fa-lock" style="color:#fff;"></i></button>' : '' : '') +
            '</div>' +
            '<div class="pl-3 pt-1" style="width:70%">' +
            (deta.resep ? 'No Resep Elektronik ' + deta.resep.id : '') +
            '</div>' +
            '</div>';

        ins += deta.resep ? render_obat_resep(deta.resep.detail) : '';

        return ins;
    }

    function render_obat_resep(deta) {
        var ins = '<table id="tabel_obat_resep" style="width:100%;">';
        for (let i = 0; i < deta.length; i++) {
            ins += '<tr>' +
                '<td>R/</td>' +
                '<td>' + deta[i].nama_obat + '</td>' +
                '<td>' + deta[i].signa + '</td>' +
                '<td>' + deta[i].jumlah + ' ' + deta[i].satuan + '</td>' +
                '</tr>';
        }
        ins += '</table>';
        return ins;
    }

    function preview_resep(param) {
        $.ajax({
            url: "{{ url('ajax_request/select_resep') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                console.log(response);
                $('#preview_tanggal').html(dmyhi_to_dmy(response.tanggal));
                $('#preview_dokter').html(response.nama_dokter);
                $('#preview_sip_dokter').html(response.sip_dokter);
                $('#preview_catatan_obat_racikan').html(response.catatan_obat_racikan);
                $('#preview_list_obat').html(render_obat_resep(response.detail));
                $('#modal_preview').modal('show');
            }
        })
    }

    function lock_resep(param, id_formulir) {
        if (confirm('Apakah anda yakin melanjutkan lock e-resep ? resep yang dilock tidak dapat diubah lagi')) {
            $.ajax({
                url: "{{ url('e_rekam_medis/formulir_asesmen_awal_pasien_rawat_inap_dewasa/ajax_request/resep_lock') }}",
                method: 'post',
                data: {
                    id: param,
                    dokumen: '{{ $dokumen->id }}',
                    id_formulir: id_formulir,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (!response.status) {
                        toastr.error(response.message);
                    }
                    toastr.success(response.message);
                    $('#box_resep').html(render_resep(response.data));
                }
            })
        }
    }

    function open_modal_dokter_e_resep() {
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
                    render: function(data, type, row) {
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_dokter_e_resep(' +
                            "'" + row.nama + "','" + data + "','" + row.no_ijin + "'" +
                            ')"><i class="fa fa-check"></i></button></div>';
                    }
                },
            ]
        });
        $('#modal_resep').modal('hide');
        $('#modal_dokter_e_resep').modal('show');
    }

    function set_dokter_e_resep(nama, id, sip) {
        $('#e_resep_dokter').val(nama);
        $('#e_resep_id_dokter').val(id);
        $('#e_resep_sip').val(sip);
        $('#modal_dokter_e_resep').modal('hide');
        $('#modal_resep').modal('show');
    }
</script>
<!-- End Script Resep -->

{{-- LAB --}}
<script>
    let id_pesanan_lab = <?php echo $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id_pesanan_lab : '0' ?>;

    function open_modal_lab() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: id_pesanan_lab,
            },
            success: function(response) {
                console.log(response);
                let temp = [];
                if (Object.keys(response).length !== 0) {
                    if (response.status != 'Pesanan ERM') {
                        alert('Tidak diperkenankan ubah pesanan laboratorium');
                        return;
                    }
                }

                if (Object.keys(response).length !== 0) {
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

    function hapus_pesanan_lab(param) {
        if (confirm('Yakin melanjutkan hapus pesanan laboratorium ?')) {
            $.ajax({
                url: "{{ url('ajax_request/hapus_pesanan_lab') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#list_pesanan').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_lab').val(0);
                    id_pesanan_lab = 0;
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
                if (file[0] != '') {
                    $('#link_lampiran_lab').html('<a style="text-decoration:underline; color:#111;" href="{{ env('
                        SMIS_UPLOAD_URL ') }}/' + file[0] + '" target="_blank">Download lampiran klik disini</a>');
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
    let id_pesanan_rad = <?php echo $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa ? $dokumen->formulir_asesmen_awal_pasien_ranap_dewasa->id_pesanan_rad : '0' ?>;

    function open_modal_pesanan_radiologi() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: id_pesanan_rad,
            },
            success: function(response) {
                console.log(response);
                if (Object.keys(response).length !== 0) {
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

    function hapus_pesanan_rad(param) {
        if (confirm('Yakin melanjutkan hapus pesanan radiologi ?')) {
            $.ajax({
                url: "{{ url('ajax_request/hapus_pesanan_rad') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#list_pesanan_radiologi').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_rad').val(0);
                    id_pesanan_rad = 0;
                    update_pesanan();
                }
            })
        }
    }

    function sortObject(obj) {
        if (typeof obj !== 'object')
            return obj
        var temp = {};
        var keys = [];
        for (var key in obj)
            keys.push(key.replace('rad_', ''));
        keys.sort(function(a, b) {
            return a - b
        });
        for (var index in keys)
            temp['rad_' + keys[index]] = sortObject(obj['rad_' + keys[index]]);
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
                                                '<td style="vertical-align:top; line-height:2;">' + (hasil[i][1] ? hasil[i][1].includes('img') ? hasil[i][1].replace('\n', '<br>').replace('smis-upload', '{{ request()->getScheme().': //' .request()->getHost() . env('SMIS_URL').'/smis-upload' }}') : hasil[i][1].replace('\n', '<br>') : '') + '</td>' +
                                                        '</tr>'; no++;
                                                        break;
                                                    }
                                                }
                                        }
                                    }
                                    let file = response.file != '' ? JSON.parse(response.file) : [''];
                                    if (file[0] != '') {
                                        $('#link_lampiran_radiologi').html('<a style="text-decoration:underline; color:#111;" href="{{ env('
                                            SMIS_UPLOAD_URL ') }}/' + file[0] + '" target="_blank">Download lampiran klik disini</a>');
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

<script>
    $("#diagnosa_primer").devbridgeAutocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_primer").val(suggestion.nama);
        }
    });

    $("#diagnosa_pembanding").devbridgeAutocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_pembanding").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_satu").devbridgeAutocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_satu").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_dua").devbridgeAutocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_dua").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_tiga").devbridgeAutocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_tiga").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_empat").devbridgeAutocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_empat").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_lima").devbridgeAutocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_lima").val(suggestion.nama);
        }
    });
</script>
<script>
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

    function cek_radio_riwayat_penyakit_keluarga_p() {
        if ($('[name="radio_riwayat_penyakit_keluarga_p"]:checked').val() == 'ada') {
            $('#ket_riwayat_penyakit_keluarga_p').removeAttr('readonly');
        } else {
            $('#ket_riwayat_penyakit_keluarga_p').attr('readonly', true);
            $('#ket_riwayat_penyakit_keluarga_p').val('');
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

    function cek_radio_riwayat_penggunaan_obat_p() {
        if ($('[name="radio_riwayat_penggunaan_obat_p"]:checked').val() == 'ada') {
            $('#ket_riwayat_penggunaan_obat_p').removeAttr('readonly');
        } else {
            $('#ket_riwayat_penggunaan_obat_p').attr('readonly', true);
            $('#ket_riwayat_penggunaan_obat_p').val('');
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

    function cek_radio_riwayat_alergi_p() {
        if ($('[name="radio_riwayat_alergi_p"]:checked').val() == 'ada') {
            $('#ket_riwayat_alergi_p').removeAttr('readonly');
        } else {
            $('#ket_riwayat_alergi_p').attr('readonly', true);
            $('#ket_riwayat_alergi_p').val('');
        }
    }

    function cek_radio_riwayat_transfusi() {
        if ($('[name="radio_riwayat_transfusi"]:checked').val() == 'pernah') {
            $('#ket_riwayat_transfusi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_transfusi').attr('readonly', true);
            $('#ket_riwayat_transfusi').val('');
        }
    }

    function cek_radio_riwayat_timbul_reaksi() {
        if ($('[name="radio_riwayat_timbul_reaksi"]:checked').val() == 'ya') {
            $('#ket_riwayat_timbul_reaksi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_timbul_reaksi').attr('readonly', true);
            $('#ket_riwayat_timbul_reaksi').val('');
        }
    }

    function cek_radio_riwayat_kemoterapi() {
        if ($('[name="radio_riwayat_kemoterapi"]:checked').val() == 'pernah') {
            $('#ket_riwayat_kemoterapi').removeAttr('readonly');
            $('#berapa_kali_riwayat_kemoterapi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_kemoterapi').attr('readonly', true);
            $('#ket_riwayat_kemoterapi').val('');
            $('#berapa_kali_riwayat_kemoterapi').attr('readonly', true);
            $('#berapa_kali_riwayat_kemoterapi').val('');
        }
    }

    function cek_radio_riwayat_radioterapi() {
        if ($('[name="radio_riwayat_radioterapi"]:checked').val() == 'pernah') {
            $('#ket_riwayat_radioterapi').removeAttr('readonly');
            $('#berapa_kali_riwayat_radioterapi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_radioterapi').attr('readonly', true);
            $('#ket_riwayat_radioterapi').val('');
            $('#berapa_kali_riwayat_radioterapi').attr('readonly', true);
            $('#berapa_kali_riwayat_radioterapi').val('');
        }
    }

    function cek_radio_kepala() {
        if ($('[name="radio_kepala"]:checked').val() == 'lain_lain') {
            $('#ket_kepala').removeAttr('readonly');
        } else {
            $('#ket_kepala').attr('readonly', true);
            $('#ket_kepala').val('');
        }
    }

    function cek_radio_ubun_ubun() {
        if ($('[name="radio_ubun_ubun"]:checked').val() == 'lain_lain') {
            $('#ket_ubun_ubun').removeAttr('readonly');
        } else {
            $('#ket_ubun_ubun').attr('readonly', true);
            $('#ket_ubun_ubun').val('');
        }
    }

    function cek_radio_wajah() {
        if ($('[name="radio_wajah"]:checked').val() == 'kelainan_konginetal') {
            $('#ket_wajah').removeAttr('readonly');
        } else {
            $('#ket_wajah').attr('readonly', true);
            $('#ket_wajah').val('');
        }
    }

    function cek_radio_leher() {
        if ($('[name="radio_leher"]:checked').val() == 'lain_lain') {
            $('#ket_leher').removeAttr('readonly');
        } else {
            $('#ket_leher').attr('readonly', true);
            $('#ket_leher').val('');
        }
    }

    function cek_radio_kejang() {
        if ($('[name="radio_kejang"]:checked').val() == 'ada') {
            $('#ket_kejang').removeAttr('readonly');
        } else {
            $('#ket_kejang').attr('readonly', true);
            $('#ket_kejang').val('');
        }
    }

    $('input[name=radio_kelopak_mata]').change(function() {
        if ($('input[name=radio_kelopak_mata]:checked').val() != 'lain_lain') {
            $('input[name=ket_kelopak_mata]').attr('readonly', true);
            $('input[name=ket_kelopak_mata]').val('');
            return;
        }

        $('input[name=ket_kelopak_mata]').removeAttr('readonly');
    })

    $('input[name=radio_konjungtiva]').change(function() {
        if ($('input[name=radio_konjungtiva]:checked').val() != 'lain_lain') {
            $('input[name=ket_konjungtiva]').attr('readonly', true);
            $('input[name=ket_konjungtiva]').val('');
            return;
        }

        $('input[name=ket_konjungtiva]').removeAttr('readonly');
    })

    $('input[name=radio_seklera]').change(function() {
        if ($('input[name=radio_seklera]:checked').val() != 'lain_lain') {
            $('input[name=ket_seklera]').attr('readonly', true);
            $('input[name=ket_seklera]').val('');
            return;
        }

        $('input[name=ket_seklera]').removeAttr('readonly');
    })

    $('input[name=radio_sistem_pendengaran]').change(function() {
        if ($('input[name=radio_sistem_pendengaran]:checked').val() != 'lain_lain') {
            $('input[name=ket_sistem_pendengaran]').attr('readonly', true);
            $('input[name=ket_sistem_pendengaran]').val('');
            return;
        }

        $('input[name=ket_sistem_pendengaran]').removeAttr('readonly');
    })

    $('input[name=radio_sistem_penciuman]').change(function() {
        if ($('input[name=radio_sistem_penciuman]:checked').val() != 'lain_lain') {
            $('input[name=ket_sistem_penciuman]').attr('readonly', true);
            $('input[name=ket_sistem_penciuman]').val('');
            return;
        }

        $('input[name=ket_sistem_penciuman]').removeAttr('readonly');
    })

    $('input[name=radio_jenis_pernapasan]').change(function() {
        if ($('input[name=radio_jenis_pernapasan]:checked').val() != 'alat_bantu_napas') {
            $('input[name=ket_jenis_pernapasan]').attr('readonly', true);
            $('input[name=ket_jenis_pernapasan]').val('');
            return;
        }

        $('input[name=ket_jenis_pernapasan]').removeAttr('readonly');
    })

    $('input[name=radio_kesulitan_bernapas]').change(function() {
        if ($('input[name=radio_kesulitan_bernapas]:checked').val() != 'Ya') {
            $('input[name=radio_detail_kesulitan_bernapas]').attr('disabled', true);
            return;
        }

        $('input[name=radio_detail_kesulitan_bernapas]').removeAttr('disabled');
    })

    $('input[name=radio_detail_kesulitan_bernapas]').change(function() {
        if ($('input[name=radio_detail_kesulitan_bernapas]:checked').val() != 'Lain-lain') {
            $('input[name=ket_detail_kesulitan_bernapas]').attr('readonly', true);
            $('input[name=ket_detail_kesulitan_bernapas]').val('');
            return;
        }

        $('input[name=ket_detail_kesulitan_bernapas]').removeAttr('readonly');
    })

    $('input[name=radio_warna_kulit]').change(function() {
        if ($('input[name=radio_warna_kulit]:checked').val() != 'lain_lain') {
            $('input[name=ket_warna_kulit]').attr('readonly', true);
            $('input[name=ket_warna_kulit]').val('');
            return;
        }

        $('input[name=ket_warna_kulit]').removeAttr('readonly');
    })

    $('input[name=radio_nyeri_dada]').change(function() {
        if ($('input[name=radio_nyeri_dada]:checked').val() != 'Ya') {
            $('input[name=ket_nyeri_dada]').attr('readonly', true);
            $('input[name=ket_nyeri_dada]').val('');
            return;
        }

        $('input[name=ket_nyeri_dada]').removeAttr('readonly');
    })

    $('input[name=radio_sirkulasi]').change(function() {
        if ($('input[name=radio_sirkulasi]:checked').val() != 'Edema') {
            $('input[name=ket_sirkulasi]').attr('readonly', true);
            $('input[name=ket_sirkulasi]').val('');
            return;
        }

        $('input[name=ket_sirkulasi]').removeAttr('readonly');
    })

    $('input[name=radio_pulsasi]').change(function() {
        if ($('input[name=radio_pulsasi]:checked').val() != 'Lain-lain') {
            $('input[name=ket_pulsasi]').attr('readonly', true);
            $('input[name=ket_pulsasi]').val('');
            return;
        }

        $('input[name=ket_pulsasi]').removeAttr('readonly');
    })

    $('input[name=radio_mulut]').change(function() {
        if ($('input[name=radio_mulut]:checked').val() != 'lain_lain') {
            $('input[name=ket_mulut]').attr('readonly', true);
            $('input[name=ket_mulut]').val('');
            return;
        }

        $('input[name=ket_mulut]').removeAttr('readonly');
    })

    $('input[name=radio_gigi]').change(function() {
        if ($('input[name=radio_gigi]:checked').val() != 'lain_lain') {
            $('input[name=ket_gigi]').attr('readonly', true);
            $('input[name=ket_gigi]').val('');
            return;
        }

        $('input[name=ket_gigi]').removeAttr('readonly');
    })

    $('input[name=radio_lidah]').change(function() {
        if ($('input[name=radio_lidah]:checked').val() != 'lain_lain') {
            $('input[name=ket_lidah]').attr('readonly', true);
            $('input[name=ket_lidah]').val('');
            return;
        }

        $('input[name=ket_lidah]').removeAttr('readonly');
    })

    $('input[name=radio_bab]').change(function() {
        if ($('input[name=radio_bab]:checked').val() != 'Diare Frekuensi') {
            $('input[name=ket_bab]').attr('readonly', true);
            $('input[name=ket_bab]').val('');
            return;
        }

        $('input[name=ket_bab]').removeAttr('readonly');
    })

    $('input[name=radio_kebersihan]').change(function() {
        if ($('input[name=radio_kebersihan]:checked').val() != 'lain_lain') {
            $('input[name=ket_kebersihan]').attr('readonly', true);
            $('input[name=ket_kebersihan]').val('');
            return;
        }

        $('input[name=ket_kebersihan]').removeAttr('readonly');
    })

    $('input[name=radio_kelainan]').change(function() {
        if ($('input[name=radio_kelainan]:checked').val() != 'lain_lain') {
            $('input[name=ket_kelainan]').attr('readonly', true);
            $('input[name=ket_kelainan]').val('');
            return;
        }

        $('input[name=ket_kelainan]').removeAttr('readonly');
    })

    $('input[name=radio_bak]').change(function() {
        if ($('input[name=radio_bak]:checked').val() != 'Urostomy') {
            $('input[name=ket_bak]').attr('readonly', true);
            $('input[name=ket_bak]').val('');
            return;
        }

        $('input[name=ket_bak]').removeAttr('readonly');
    })

    $('input[name=radio_gangguan_haid]').change(function() {
        if ($('input[name=radio_gangguan_haid]:checked').val() != 'lain_lain') {
            $('input[name=ket_gangguan_haid]').attr('readonly', true);
            $('input[name=ket_gangguan_haid]').val('');
            return;
        }

        $('input[name=ket_gangguan_haid]').removeAttr('readonly');
    })

    $('input[name=radio_alat_kontrasepsi]').change(function() {
        if ($('input[name=radio_alat_kontrasepsi]:checked').val() != 'Ya') {
            $('input[name=ket_alat_kontrasepsi]').attr('readonly', true);
            $('input[name=ket_alat_kontrasepsi]').val('');
            return;
        }

        $('input[name=ket_alat_kontrasepsi]').removeAttr('readonly');
    })

    $('input[name=radio_dekubituas]').change(function() {
        if ($('input[name=radio_dekubituas]:checked').val() != 'penyakit_kronis') {
            $('input[name=ket_dekubituas]').attr('readonly', true);
            $('input[name=ket_dekubituas]').val('');
            return;
        }

        $('input[name=ket_dekubituas]').removeAttr('readonly');
    })

    $('input[name=radio_nyeri_sendi]').change(function() {
        if ($('input[name=radio_nyeri_sendi]:checked').val() != 'Ada') {
            $('input[name=ket_nyeri_sendi]').attr('readonly', true);
            $('input[name=ket_nyeri_sendi]').val('');
            return;
        }

        $('input[name=ket_nyeri_sendi]').removeAttr('readonly');
    })

    $('input[name=radio_oedema]').change(function() {
        if ($('input[name=radio_oedema]:checked').val() != 'Ada') {
            $('input[name=ket_oedema]').attr('readonly', true);
            $('input[name=ket_oedema]').val('');
            return;
        }

        $('input[name=ket_oedema]').removeAttr('readonly');
    })

    $('input[name=radio_fraktur]').change(function() {
        if ($('input[name=radio_fraktur]:checked').val() != 'Ada') {
            $('input[name=ket_fraktur]').attr('readonly', true);
            $('input[name=ket_fraktur]').val('');
            return;
        }

        $('input[name=ket_fraktur]').removeAttr('readonly');
    })

    $('input[name=radio_parese]').change(function() {
        if ($('input[name=radio_parese]:checked').val() != 'Ada') {
            $('input[name=ket_parese]').attr('readonly', true);
            $('input[name=ket_parese]').val('');
            return;
        }

        $('input[name=ket_parese]').removeAttr('readonly');
    })

    $('input[name=radio_alat_bantu_penglihatan]').change(function() {
        if ($('input[name=radio_alat_bantu_penglihatan]:checked').val() != 'Ya') {
            $('input[name=radio_detail_alat_bantu_penglihatan]').attr('disabled', true);
            return;
        }

        $('input[name=radio_detail_alat_bantu_penglihatan]').removeAttr('disabled');
        $('input[name=radio_detail_alat_bantu_penglihatan]').removeAttr('checked');
    })

    $('input[name=radio_batuk]').change(function() {
        if ($('input[name=radio_batuk]:checked').val() != 'Ya') {
            $('input[name=radio_detail_batuk]').attr('disabled', true);
            return;
        }

        $('input[name=radio_detail_batuk]').removeAttr('disabled');
    })

    $('input[name=radio_riwayat_merokok_sebelum_sakit]').change(function() {
        if ($('input[name=radio_riwayat_merokok_sebelum_sakit]:checked').val() != 'Ya') {
            $('input[name=jumlah_riwayat_merokok_sebelum_sakit]').attr('readonly', true);
            $('input[name=jumlah_riwayat_merokok_sebelum_sakit]').val('');
            $('input[name=lamanya_riwayat_merokok_sebelum_sakit]').attr('readonly', true);
            $('input[name=lamanya_riwayat_merokok_sebelum_sakit]').val('');
            return;
        }

        $('input[name=jumlah_riwayat_merokok_sebelum_sakit]').removeAttr('readonly');
        $('input[name=lamanya_riwayat_merokok_sebelum_sakit]').removeAttr('readonly');
    })

    $('input[name=radio_riwayat_miras_sebelum_sakit]').change(function() {
        if ($('input[name=radio_riwayat_miras_sebelum_sakit]:checked').val() != 'Ya') {
            $('input[name=jenis_riwayat_miras_sebelum_sakit]').attr('readonly', true);
            $('input[name=jenis_riwayat_miras_sebelum_sakit]').val('');
            $('input[name=jumlah_riwayat_miras_sebelum_sakit]').attr('readonly', true);
            $('input[name=jumlah_riwayat_miras_sebelum_sakit]').val('');
            return;
        }

        $('input[name=jenis_riwayat_miras_sebelum_sakit]').removeAttr('readonly');
        $('input[name=jumlah_riwayat_miras_sebelum_sakit]').removeAttr('readonly');
    })

    $('input[name=radio_riwayat_obat_penenang_sebelum_sakit]').change(function() {
        if ($('input[name=radio_riwayat_obat_penenang_sebelum_sakit]:checked').val() != 'Ya') {
            $('input[name=jenis_riwayat_obat_penenang_sebelum_sakit]').attr('readonly', true);
            $('input[name=jenis_riwayat_obat_penenang_sebelum_sakit]').val('');
            $('input[name=jumlah_riwayat_obat_penenang_sebelum_sakit]').attr('readonly', true);
            $('input[name=jumlah_riwayat_obat_penenang_sebelum_sakit]').val('');
            return;
        }

        $('input[name=jenis_riwayat_obat_penenang_sebelum_sakit]').removeAttr('readonly');
        $('input[name=jumlah_riwayat_obat_penenang_sebelum_sakit]').removeAttr('readonly');
    })

    $('input[name=radio_agama]').change(function() {
        if ($('input[name=radio_agama]:checked').val() != 'lain_lain') {
            $('input[name=agama_lain]').attr('readonly', true);
            $('input[name=agama_lain]').val('');
            return;
        }

        $('input[name=agama_lain]').removeAttr('readonly');
    })

    $('input[name=radio_pekerjaan]').change(function() {
        if ($('input[name=radio_pekerjaan]:checked').val() != 'lain_lain') {
            $('input[name=pekerjaan_lain]').attr('readonly', true);
            $('input[name=pekerjaan_lain]').val('');
            return;
        }

        $('input[name=pekerjaan_lain]').removeAttr('readonly');
    })

    $('input[name=radio_tinggal_bersama]').change(function() {
        if ($('input[name=radio_tinggal_bersama]:checked').val() != 'lain_lain') {
            $('input[name=tinggal_bersama_lain]').attr('readonly', true);
            $('input[name=tinggal_bersama_lain]').val('');
            return;
        }

        $('input[name=tinggal_bersama_lain]').removeAttr('readonly');
    })

    $('input[name=radio_pendidikan_pasien]').change(function() {
        if ($('input[name=radio_pendidikan_pasien]:checked').val() != 'lain_lain') {
            $('input[name=pendidikan_pasien_lain]').attr('readonly', true);
            $('input[name=pendidikan_pasien_lain]').val('');
            return;
        }

        $('input[name=pendidikan_pasien_lain]').removeAttr('readonly');
    })

    $('input[name=radio_pendidikan_pj]').change(function() {
        if ($('input[name=radio_pendidikan_pj]:checked').val() != 'lain_lain') {
            $('input[name=pendidikan_pj_lain]').attr('readonly', true);
            $('input[name=pendidikan_pj_lain]').val('');
            return;
        }

        $('input[name=pendidikan_pj_lain]').removeAttr('readonly');
    })

    $('input[name=radio_berjalan]').change(function() {
        if ($('input[name=radio_berjalan]:checked').val() == 'Riwayat Patah Tulang') {
            $('input[name=ket_patah_tulang]').removeAttr('readonly');
            $('input[name=ket_berjalan]').attr('readonly', true);
            $('input[name=ket_berjalan]').val('');
            return;
        } else if ($('input[name=radio_berjalan]:checked').val() == 'lain_lain') {
            $('input[name=ket_berjalan]').removeAttr('readonly');
            $('input[name=ket_patah_tulang]').attr('readonly', true);
            $('input[name=ket_patah_tulang]').val('');
            return;
        } else {
            $('input[name=ket_berjalan]').attr('readonly', true);
            $('input[name=ket_berjalan]').val('');
            $('input[name=ket_patah_tulang]').attr('readonly', true);
            $('input[name=ket_patah_tulang]').val('');
            return;
        }
    })

    $('input[name=radio_ekstremitas_bawah]').change(function() {
        if ($('input[name=radio_ekstremitas_bawah]:checked').val() == 'Edema') {
            $('input[name=ket_edema]').removeAttr('readonly');
            $('input[name=ket_ekstremitas_bawah]').attr('readonly', true);
            $('input[name=ket_ekstremitas_bawah]').val('');
            return;
        } else if ($('input[name=radio_ekstremitas_bawah]:checked').val() == 'lain_lain') {
            $('input[name=ket_ekstremitas_bawah]').removeAttr('readonly');
            $('input[name=ket_edema]').attr('readonly', true);
            $('input[name=ket_edema]').val('');
            return;
        } else {
            $('input[name=ket_ekstremitas_bawah]').attr('readonly', true);
            $('input[name=ket_ekstremitas_bawah]').val('');
            $('input[name=ket_edema]').attr('readonly', true);
            $('input[name=ket_edema]').val('');
            return;
        }
    })

    $('input[name=radio_kemampuan_menggenggam]').change(function() {
        if ($('input[name=radio_kemampuan_menggenggam]:checked').val() == 'lain_lain') {
            $('input[name=ket_kemampuan_menggenggam]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_kemampuan_menggenggam]').attr('readonly', true);
            $('input[name=ket_kemampuan_menggenggam]').val('');
            return;
        }
    })

    $('input[name=radio_kemampuan_koordinasi]').change(function() {
        if ($('input[name=radio_kemampuan_koordinasi]:checked').val() == 'Ada Masalah') {
            $('input[name=ket_kemampuan_koordinasi]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_kemampuan_koordinasi]').attr('readonly', true);
            $('input[name=ket_kemampuan_koordinasi]').val('');
            return;
        }
    })

    $('input[name=radio_pendidikan_bicara]').change(function() {
        if ($('input[name=radio_pendidikan_bicara]:checked').val() == 'Gangguan Bicara') {
            $('input[name=ket_gangguan_bicara]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_gangguan_bicara]').attr('readonly', true);
            $('input[name=ket_gangguan_bicara]').val('');
            return;
        }
    })

    $('input[name=radio_pendidikan_bahasa]').change(function() {
        if ($('input[name=radio_pendidikan_bahasa]:checked').val() == 'Daerah') {
            $('input[name=ket_bahasa_daerah]').removeAttr('readonly');
            $('input[name=ket_pendidikan_bahasa]').attr('readonly', true);
            $('input[name=ket_pendidikan_bahasa]').val('');
            return;
        } else if ($('input[name=radio_pendidikan_bahasa]:checked').val() == 'lain_lain') {
            $('input[name=ket_pendidikan_bahasa]').removeAttr('readonly');
            $('input[name=ket_bahasa_daerah]').attr('readonly', true);
            $('input[name=ket_bahasa_daerah]').val('');
            return;
        } else {
            $('input[name=ket_pendidikan_bahasa]').attr('readonly', true);
            $('input[name=ket_pendidikan_bahasa]').val('');
            $('input[name=ket_bahasa_daerah]').attr('readonly', true);
            $('input[name=ket_bahasa_daerah]').val('');
            return;
        }
    })

    $('input[name=radio_penerjemah]').change(function() {
        if ($('input[name=radio_penerjemah]:checked').val() == 'Ya') {
            $('input[name=ket_bahasa_penerjemah]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_bahasa_penerjemah]').attr('readonly', true);
            $('input[name=ket_bahasa_penerjemah]').val('');
            return;
        }
    })

    $('input[name=radio_hambatan_belajar]').change(function() {
        if ($('input[name=radio_hambatan_belajar]:checked').val() != 'Ya') {
            $('input[name=radio_detail_hambatan_belajar]').attr('disabled', true);
            $('input[name=ket_detail_hambatan_belajar]').attr('readonly', true);
            $('input[name=ket_detail_hambatan_belajar]').val('');
            return;
        }

        $('input[name=radio_detail_hambatan_belajar]').removeAttr('disabled');
        $('input[name=radio_detail_hambatan_belajar]').removeAttr('checked');
    })

    $('input[name=radio_detail_hambatan_belajar]').change(function() {
        if ($('input[name=radio_detail_hambatan_belajar]:checked').val() == 'lain_lain') {
            $('input[name=ket_detail_hambatan_belajar]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_detail_hambatan_belajar]').attr('readonly', true);
            $('input[name=ket_detail_hambatan_belajar]').val('');
            return;
        }
    })

    $('input[name=radio_informasi_tentang]').change(function() {
        if ($('input[name=radio_informasi_tentang]:checked').val() == 'lain_lain') {
            $('input[name=ket_informasi_tentang]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_informasi_tentang]').attr('readonly', true);
            $('input[name=ket_informasi_tentang]').val('');
            return;
        }
    })

    $('#kebutuhan_privasi_tempat_khusus').change(function() {
        if ($('#kebutuhan_privasi_tempat_khusus').is(":checked")) {
            $('input[name=ket_tempat_khusus]').removeAttr('readonly');
        } else {
            $('input[name=ket_tempat_khusus]').attr('readonly', true);
            $('input[name=ket_tempat_khusus]').val('');
        }
    })

    $('#kebutuhan_privasi_lain_lain').change(function() {
        if ($('#kebutuhan_privasi_lain_lain').is(":checked")) {
            $('input[name=ket_privasi_lain_lain]').removeAttr('readonly');
        } else {
            $('input[name=ket_privasi_lain_lain]').attr('readonly', true);
            $('input[name=ket_privasi_lain_lain]').val('');
        }
    })

    $('#masalah_keperawatan_lain_lain').change(function() {
        if ($('#masalah_keperawatan_lain_lain').is(":checked")) {
            $('input[name=ket_masalah_keperawatan]').removeAttr('readonly');
        } else {
            $('input[name=ket_masalah_keperawatan]').attr('readonly', true);
            $('input[name=ket_masalah_keperawatan]').val('');
        }
    })

    $('input[name=radio_diet_nutrisi]').change(function() {
        if ($('input[name=radio_diet_nutrisi]:checked').val() == 'Ya') {
            $('input[name=ket_diet_nutrisi]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_diet_nutrisi]').attr('readonly', true);
            $('input[name=ket_diet_nutrisi]').val('');
            return;
        }
    })

    $('input[name=radio_rehab_medik]').change(function() {
        if ($('input[name=radio_rehab_medik]:checked').val() == 'Ya') {
            $('input[name=ket_rehab_medik]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_rehab_medik]').attr('readonly', true);
            $('input[name=ket_rehab_medik]').val('');
            return;
        }
    })

    $('input[name=radio_farmasi]').change(function() {
        if ($('input[name=radio_farmasi]:checked').val() == 'Ya') {
            $('input[name=ket_farmasi]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_farmasi]').attr('readonly', true);
            $('input[name=ket_farmasi]').val('');
            return;
        }
    })

    $('input[name=radio_perawatan_luka]').change(function() {
        if ($('input[name=radio_perawatan_luka]:checked').val() == 'Ya') {
            $('input[name=ket_perawatan_luka]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_perawatan_luka]').attr('readonly', true);
            $('input[name=ket_perawatan_luka]').val('');
            return;
        }
    })

    $('input[name=radio_manajemen_nyeri]').change(function() {
        if ($('input[name=radio_manajemen_nyeri]:checked').val() == 'Ya') {
            $('input[name=ket_manajemen_nyeri]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_manajemen_nyeri]').attr('readonly', true);
            $('input[name=ket_manajemen_nyeri]').val('');
            return;
        }
    })

    $('input[name=radio_status_psikologis]').change(function() {
        if ($('input[name=radio_status_psikologis]:checked').val() == 'lain_lain') {
            $('input[name=ket_status_psikologis]').removeAttr('readonly');
            return;
        } else {
            $('input[name=ket_status_psikologis]').attr('readonly', true);
            $('input[name=ket_status_psikologis]').val('');
            return;
        }
    })

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
</script>

</html>