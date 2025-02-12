<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Anastesi dan Sedasi</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        .pagebreak {
            page-break-after: always;
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

        .table_isian_borderless td tr {
            border: hidden;
        }

        #header_judul {
            color: white;
        }

        @media print {
            #logo_rshm {
                width: 100% !important;
            }

            #gambar_anastesi1 {
                position: absolute;
                top: -1610px !important;
                left: 115px !important;
                width: 1018px !important;
                height: 505px !important;
            }

            #canvas1 {
                position: absolute;
                top: -1610px !important;
                left: 115px !important;
                width: 1018px !important;
                height: 505px !important;
            }

            #gambar_anastesi2 {
                position: absolute;
                top: -439px !important;
                left: 122px !important;
                width: 978px !important;
                height: 325px !important;
            }

            #canvas2 {
                position: absolute;
                top: -439px !important;
                left: 122px !important;
                width: 978px !important;
                height: 325px !important;
            }

            @page {
                size: legal;
                margin: 0;
            }

            .hidden_print {
                display: none;
            }

            #header_judul {
                color: white;
            }

            #background_judul {
                background: black;
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
                <form onsubmit="return cek_form(this)" id="form_persetujuan"
                    action="{{ url('e_rekam_medis/detail/save_laporan_anastesi_dan_sedasi') }}" method="post">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                required>
                            <input type="hidden" id="hide_isian_satu" name="isian_satu">
                            <input type="hidden" id="hide_isian_dua" name="isian_dua">
                            <input type="hidden" id="hide_status_fisik_asa" name="status_fisik_asa">
                            <input type="hidden" id="hide_gambar1" name="gambar1">
                            <input type="hidden" id="hide_gambar2" name="gambar2">

                            <input type="hidden" id="hide_id_d_anastesi" name="id_d_anastesi">
                            <input type="hidden" id="hide_d_anastesi" name="d_anastesi">
                            <input type="hidden" id="hide_id_perawat" name="id_perawat">
                            <input type="hidden" id="hide_perawat" name="perawat">
                            <input type="hidden" id="hide_id_instrumen" name="id_instrumen">
                            <input type="hidden" id="hide_instrumen" name="instrumen">

                            <input type="hidden" id="hide_diagnosa_pre_op" name="diagnosa_pre_op">
                            <input type="hidden" id="hide_diagnosa_post_op" name="diagnosa_post_op">
                            <input type="hidden" id="hide_tindakan" name="tindakan">
                            <input type="hidden" id="hide_jenis_anastesi" name="jenis_anastesi">
                            <input type="hidden" id="hide_resiko_anastesi" name="resiko_anastesi">
                            <input type="hidden" id="hide_tb_pre" name="tb_pre">
                            <input type="hidden" id="hide_bb_pre" name="bb_pre">
                            <input type="hidden" id="hide_td" name="td">
                            <input type="hidden" id="hide_hb" name="hb">
                            <input type="hidden" id="hide_nadi" name="nadi">
                            <input type="hidden" id="hide_ht" name="ht">
                            <input type="hidden" id="hide_suhu" name="suhu">
                            <input type="hidden" id="hide_gol_darah" name="gol_darah">
                            <input type="hidden" id="hide_gcs_e" name="gcs_e">
                            <input type="hidden" id="hide_gcs_m" name="gcs_m">
                            <input type="hidden" id="hide_gcs_v" name="gcs_v">

                            <input type="hidden" id="hide_pramedikasi" name="pramedikasi">
                            <input type="hidden" id="hide_profol" name="profol">
                            <input type="hidden" id="hide_midazolam" name="midazolam">
                            <input type="hidden" id="hide_rl" name="rl">
                            <input type="hidden" id="hide_fentanyl" name="fentanyl">
                            <input type="hidden" id="hide_medikasi1" name="medikasi1">
                            <input type="hidden" id="hide_det_medikasi1" name="det_medikasi1">
                            <input type="hidden" id="hide_pethidin" name="pethidin">
                            <input type="hidden" id="hide_medikasi2" name="medikasi2">
                            <input type="hidden" id="hide_det_medikasi2" name="det_medikasi2">
                            <input type="hidden" id="hide_atrakurium" name="atrakurium">
                            <input type="hidden" id="hide_sa" name="sa">
                            <input type="hidden" id="hide_urine" name="urine">
                            <input type="hidden" id="hide_buvupacaine" name="buvupacaine">
                            <input type="hidden" id="hide_cm_satu" name="cm_satu">
                            <input type="hidden" id="hide_cm_dua" name="cm_dua">

                            <input type="hidden" id="hide_jm_satu" name="jm_satu">
                            <input type="hidden" id="hide_jm_dua" name="jm_dua">
                            <input type="hidden" id="hide_jm_tiga" name="jm_tiga">
                            <input type="hidden" id="hide_jm_empat" name="jm_empat">
                            <input type="hidden" id="hide_jm_lima" name="jm_lima">
                            <input type="hidden" id="hide_jm_enam" name="jm_enam">
                            <input type="hidden" id="hide_jm_tujuh" name="jm_tujuh">
                            <input type="hidden" id="hide_jm_delapan" name="jm_delapan">
                            <input type="hidden" id="hide_jm_sembilan" name="jm_sembilan">
                            <input type="hidden" id="hide_jm_sepuluh" name="jm_sepuluh">

                            <input type="hidden" id="hide_pendarahan" name="pendarahan">
                            <input type="hidden" id="hide_ngt" name="ngt">

                            <input type="hidden" id="hide_catatan" name="catatan">
                            <input type="hidden" id="hide_ket_tunda" name="ket_tunda">
                            <input type="hidden" id="hide_regional" name="regional">
                            <input type="hidden" id="hide_induksi" name="induksi">
                            <input type="hidden" id="hide_tiva" name="tiva">
                            <input type="hidden" id="hide_inhalasi" name="inhalasi">
                            <input type="hidden" id="hide_ett_lma" name="ett_lma">
                            <input type="hidden" id="hide_ket_ett_lma" name="ket_ett_lma">
                            <input type="hidden" id="hide_masker" name="masker">
                            <input type="hidden" id="hide_maintenance" name="maintenance">
                            <input type="hidden" id="hide_jam_anastesi" name="jam_anastesi">
                            <input type="hidden" id="hide_spo1" name="spo1">
                            <input type="hidden" id="hide_spo2" name="spo2">
                            <input type="hidden" id="hide_spo3" name="spo3">
                            <input type="hidden" id="hide_spo4" name="spo4">

                            <input type="hidden" id="hide_waktu_anastesi" name="waktu_anastesi">
                            <input type="hidden" id="hide_selesai_anastesi" name="selesai_anastesi">
                            <input type="hidden" id="hide_pasien_masuk_rr" name="pasien_masuk_rr">
                            <input type="hidden" id="hide_id_perawat_masuk_rr" name="id_perawat_masuk_rr">
                            <input type="hidden" id="hide_perawat_masuk_rr" name="perawat_masuk_rr">
                            <input type="hidden" id="hide_id_penata_anastesi" name="id_penata_anastesi">
                            <input type="hidden" id="hide_penata_anastesi" name="penata_anastesi">
                            <input type="hidden" id="hide_jam_anastesi2" name="jam_anastesi2">
                            <input type="hidden" id="hide_pasien_keluar_rr" name="pasien_keluar_rr">
                            <input type="hidden" id="hide_keluar_rr" name="keluar_rr">
                            <input type="hidden" id="hide_id_perawat_keluar_rr" name="id_perawat_keluar_rr">
                            <input type="hidden" id="hide_perawat_keluar_rr" name="perawat_keluar_rr">
                            <input type="hidden" id="hide_id_perawat_penerima" name="id_perawat_penerima">
                            <input type="hidden" id="hide_perawat_penerima" name="perawat_penerima">

                            <input type="hidden" id="hide_aktivitas_motorik_masuk" name="aktivitas_motorik_masuk">
                            <input type="hidden" id="hide_aktivitas_motorik_keluar" name="aktivitas_motorik_keluar">
                            <input type="hidden" id="hide_respirasi_masuk" name="respirasi_masuk">
                            <input type="hidden" id="hide_respirasi_keluar" name="respirasi_keluar">
                            <input type="hidden" id="hide_sirkulasi_masuk" name="sirkulasi_masuk">
                            <input type="hidden" id="hide_sirkulasi_keluar" name="sirkulasi_keluar">
                            <input type="hidden" id="hide_kesadaran_masuk" name="kesadaran_masuk">
                            <input type="hidden" id="hide_kesadaran_keluar" name="kesadaran_keluar">
                            <input type="hidden" id="hide_warna_kulit_masuk" name="warna_kulit_masuk">
                            <input type="hidden" id="hide_warna_kulit_keluar" name="warna_kulit_keluar">
                            <input type="hidden" id="hide_bromage_masuk" name="bromage_masuk">
                            <input type="hidden" id="hide_bromage_keluar" name="bromage_keluar">
                            <input type="hidden" id="hide_kesadaran_steward_masuk" name="kesadaran_steward_masuk">
                            <input type="hidden" id="hide_kesadaran_steward_keluar" name="kesadaran_steward_keluar">
                            <input type="hidden" id="hide_respirasi_steward_masuk" name="respirasi_steward_masuk">
                            <input type="hidden" id="hide_respirasi_steward_keluar" name="respirasi_steward_keluar">
                            <input type="hidden" id="hide_aktifitas_motorik_steward_masuk"
                                name="aktifitas_motorik_steward_masuk">
                            <input type="hidden" id="hide_aktifitas_motorik_steward_keluar"
                                name="aktifitas_motorik_steward_keluar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi dan Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger hidden_print">{{ $error }}</div>
        @endforeach
    @endif
    @if (Session::has('gagal'))
        <div class="alert alert-danger hidden_print">{{ Session::get('gagal') }}</div>
    @endif
    @if (Session::has('sukses'))
        <div class="alert alert-success hidden_print">{{ Session::get('sukses') }}</div>
    @endif
    <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-md-6" style="border: 1px solid;">
            <div class="row" style="width: 100%;">
                <div class="col-md-3" style="">
                    <img id="logo_rshm" src="{{ asset('filelogo/logo_rshm.png') }}" alt=""
                        style="width: 120%;">
                </div>
                <div class="col-md-9" style="margin-top: 10px">
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
        <div class="col-md-6" style="margin-left: 0; border:1px solid; padding:10px;">
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
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
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
            <div id="background_judul" class="col-md-12 text-center" style="background: black; padding-top: 5px">
                <h6 id="header_judul">LAPORAN ANASTESI DAN SEDASI</h6>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <table style="width: 100%" class="table_isian">
                <tr>
                    <td style="padding: 10px; text-align: left">
                        DOKTER ANASTESI :
                        <div class="input-group">
                            <input type="text" hidden id="id_d_anastesi">
                            <input type="text" readonly
                                value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->d_anastesi : '' }}"
                                id="d_anastesi" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" onclick="open_modal_yth('d_anastesi')"><i
                                        class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 10px; text-align: left">
                        PERAWAT ANASTESI :
                        <div class="input-group">
                            <input type="text" hidden id="id_perawat">
                            <input type="text" readonly
                                value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->perawat : '' }}"
                                id="perawat" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button"
                                    onclick="open_modal_perawat('perawat')"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 10px; text-align: left">
                        OPERATOR :
                        <div class="input-group">
                            <input type="text" hidden id="id_instrumen">
                            <input type="text" readonly
                                value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->instrumen : '' }}"
                                id="instrumen" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button"
                                    onclick="open_modal_instrumen('instrumen')"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; text-align: left">
                        DIAGNOSA PRE OP :
                        <div class="input-group">
                            <input type="text" id="diagnosa_pre_op" class="form-control"
                                value="@if (old('diagnosa_pre_op')) {{ old('diagnosa_pre_op') }}
                                   @else{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->diagnosa_pre_op : '' }} @endif">
                        </div>
                    </td>
                    <td style="padding: 10px; text-align: left">
                        DIAGNOSA POST OP :
                        <div class="input-group">
                            <input type="text" id="diagnosa_post_op" class="form-control"
                                value="@if (old('diagnosa_post_op')) {{ old('diagnosa_post_op') }}
                                   @else{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->diagnosa_post_op : '' }} @endif">
                        </div>
                    </td>
                    <td style="padding: 10px; text-align: left">
                        TINDAKAN OPERASI :
                        <div class="input-group">
                            <input type="text" id="tindakan" class="form-control"
                                value="@if (old('tindakan')) {{ old('tindakan') }}
                                   @else{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->tindakan : '' }} @endif">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <table style="width: 100%;" class="table_isian2">
                <tr>
                    <td style="width: 10%; padding-left: 10px">
                        JENIS ANASTESI <span style="float: right">:</span>
                    </td>
                    <td style="padding-left: 10px; width: 40%; border-right: 1px solid">
                        <div class="row">
                            <div class="col-md-3">
                                <input
                                    @if (old('jenis_anastesi')) {{ old('jenis_anastesi') == 'besar' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->jenis_anastesi == 'besar' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="besar" name="radio_jenis_anastesi"> BESAR
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('jenis_anastesi')) {{ old('jenis_anastesi') == 'sedang' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->jenis_anastesi == 'sedang' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="sedang" name="radio_jenis_anastesi"> SEDANG
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('jenis_anastesi')) {{ old('jenis_anastesi') == 'kecil' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->jenis_anastesi == 'kecil' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kecil" name="radio_jenis_anastesi"> KECIL
                            </div>
                        </div>
                    </td>
                    <td style="width: 15%; padding-left: 10px">
                        RESIKO ANASTESI <span style="float: right">:</span>
                    </td>
                    <td style="padding-left: 10px; width: 40%; border-right: 1px solid">
                        <div class="row">
                            <div class="col-md-3">
                                <input
                                    @if (old('resiko_anastesi')) {{ old('resiko_anastesi') == 'besar' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->resiko_anastesi == 'besar' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="besar" name="radio_resiko_anastesi"> BESAR
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('resiko_anastesi')) {{ old('resiko_anastesi') == 'sedang' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->resiko_anastesi == 'sedang' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="sedang" name="radio_resiko_anastesi"> SEDANG
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('resiko_anastesi')) {{ old('resiko_anastesi') == 'kecil' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->resiko_anastesi == 'kecil' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kecil" name="radio_resiko_anastesi"> KECIL
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; padding: 10px">
            <table style="width: 100%;" class="table_isian_borderless">
                <tr>
                    <td style="width: 40%; vertical-align: text-top">
                        <table style="width: 100%;" class="table_isian_borderless">
                            <tr>
                                <td colspan="6">
                                    PRE OPERASI :
                                    TB <input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->tb_pre : '' }}"
                                        id="tb_pre">cm
                                    BB <input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->bb_pre : '' }}"
                                        id="bb_pre">kg
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 17%">TD</td>
                                <td style="width: 2%">:</td>
                                <td style="width: 35%"><input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->td : '' }}"
                                        id="td"> mmHg</td>

                                <td style="width: 17%">HB</td>
                                <td style="width: 2%">:</td>
                                <td style="width: 35%"><input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->hb : '' }}"
                                        id="hb"> g/dl</td>
                            </tr>
                            <tr>
                                <td style="width: 17%">N</td>
                                <td style="width: 2%">:</td>
                                <td style="width: 35%"><input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->nadi : '' }}"
                                        id="nadi"> x/menit</td>

                                <td style="width: 17%">HT</td>
                                <td style="width: 2%">:</td>
                                <td style="width: 35%"><input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->ht : '' }}"
                                        id="ht"> %</td>
                            </tr>
                            <tr>
                                <td style="width: 17%">SUHU</td>
                                <td style="width: 2%">:</td>
                                <td style="width: 35%"><input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->suhu : '' }}"
                                        id="suhu"> °C</td>

                                <td style="width: 17%">GOL. DARAH</td>
                                <td style="width: 2%">:</td>
                                <td style="width: 35%"><input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->gol_darah : '' }}"
                                        id="gol_darah"></td>
                            </tr>
                            <tr>
                                <td style="width: 17%">GCS</td>
                                <td style="width: 2%">:</td>
                                <td colspan="4">
                                    E : <input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->gcs_e : '' }}"
                                        id="gcs_e">
                                    M : <input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->gcs_m : '' }}"
                                        id="gcs_m">
                                    V : <input type="text"
                                        style="border: none; border-bottom: 2px dotted; width: 80px"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->gcs_v : '' }}"
                                        id="gcs_v">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <?php $status_fisik_asa = $dokumen->dokumen_laporan_anastesi_dan_sedasi ? json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->status_fisik_asa) : null; ?>
                                    Status Fisik ASA :
                                    <input type="checkbox" value="1"
                                        {{ $status_fisik_asa ? (in_array('1', $status_fisik_asa) ? 'checked' : '') : '' }}
                                        id="status_fisik_1"> 1
                                    <input type="checkbox" value="2"
                                        {{ $status_fisik_asa ? (in_array('2', $status_fisik_asa) ? 'checked' : '') : '' }}
                                        id="status_fisik_2"> 2
                                    <input type="checkbox" value="3"
                                        {{ $status_fisik_asa ? (in_array('3', $status_fisik_asa) ? 'checked' : '') : '' }}
                                        id="status_fisik_3"> 3
                                    <input type="checkbox" value="4"
                                        {{ $status_fisik_asa ? (in_array('4', $status_fisik_asa) ? 'checked' : '') : '' }}
                                        id="status_fisik_4"> 4
                                    <input type="checkbox" value="5"
                                        {{ $status_fisik_asa ? (in_array('5', $status_fisik_asa) ? 'checked' : '') : '' }}
                                        id="status_fisik_5"> 5
                                    <input type="checkbox" value="e"
                                        {{ $status_fisik_asa ? (in_array('e', $status_fisik_asa) ? 'checked' : '') : '' }}
                                        id="status_fisik_e"> E
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 17%">Pramedikasi</td>
                                <td style="width: 2%">:</td>
                                <td colspan="4">
                                    <input type="text" style="border: none; border-bottom: 2px dotted;"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->pramedikasi : '' }}"
                                        id="pramedikasi">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 60%; vertical-align: text-top">
                        <table style="width: 100%;">
                            <tr style="border: 1px solid;">
                                <td colspan="2" style="width: 60%; border: 1px solid; text-align: center">
                                    JUMLAH MEDIKASI
                                </td>
                                <td colspan="2" style="width: 40%; border: 1px solid; text-align: center">
                                    CAIRAN
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    Propofol
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->profol : '' }}"
                                        id="profol">mg
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    Masuk
                                </td>
                                <td style="width: 20%; border: 1px solid;">

                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    Midazolam
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->midazolam : '' }}"
                                        id="midazolam">mg
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    RL
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->rl : '' }}"
                                        id="rl">ml
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    Fentanyl
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->fentanyl : '' }}"
                                        id="fentanyl">mcg
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted;"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->medikasi1 : '' }}"
                                        id="medikasi1">
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->det_medikasi1 : '' }}"
                                        id="det_medikasi1">ml
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    {{-- Pethidin --}}
                                    Morphin
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->pethidin : '' }}"
                                        id="pethidin">mg
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->medikasi2 : '' }}"
                                        id="medikasi2">
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->det_medikasi2 : '' }}"
                                        id="det_medikasi2">ml
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    Atrakurium
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    {{-- <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%" value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->pethidin : '' }}" id="pethidin">mg --}}
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->atrakurium : '' }}"
                                        id="atrakurium">mg
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->cm_satu : '' }}"
                                        id="cm_satu">
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->cm_dua : '' }}"
                                        id="cm_dua">ml
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    {{-- Atrakurium --}}
                                    Bupivacain
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    {{-- <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%" value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->atrakurium : '' }}" id="atrakurium">mg --}}
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->buvupacaine : '' }}"
                                        id="buvupacaine">mg
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    Keluar
                                </td>
                                <td style="width: 20%; border: 1px solid;">

                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    {{-- SA --}}
                                    Ketamin
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    {{-- <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%" value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->sa : '' }}" id="sa">mg --}}
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_dua : '' }}"
                                        id="jm_dua">mg
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    Urine
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->urine : '' }}"
                                        id="urine">ml
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    {{-- Buvupacaine --}}
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_tiga : '' }}"
                                        id="jm_tiga">
                                </td>
                                <td style="width: 40%; border: 1px solid;">
                                    {{-- <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%" value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->buvupacaine : '' }}" id="buvupacaine">mg --}}
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_empat : '' }}"
                                        id="jm_empat">
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    Pendarahan
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->pendarahan : '' }}"
                                        id="pendarahan">ml
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid">
                                    {{-- Ketamin --}}
                                    {{-- <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%" value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_satu : '' }}" id="jm_satu"> --}}
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_lima : '' }}"
                                        id="jm_lima">
                                </td>
                                <td style="width: 40%; border: 1px solid">
                                    {{-- <input type="text" style="border: none; border-bottom: 2px dotted; width: 90%" value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_dua : '' }}" id="jm_dua">mg --}}
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_enam : '' }}"
                                        id="jm_enam">
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    NGT
                                </td>
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width:88%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->ngt : '' }}"
                                        id="ngt">ml
                                </td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_tujuh : '' }}"
                                        id="jm_tujuh">
                                </td>
                                <td style="width: 40%">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_delapan : '' }}"
                                        id="jm_delapan">
                                </td>
                                <td style="border: 1px solid;"></td>
                                <td style="border: 1px solid;"></td>
                            </tr>
                            <tr style="border: 1px solid;">
                                <td style="width: 20%; border: 1px solid;">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_sembilan : '' }}"
                                        id="jm_sembilan">
                                </td>
                                <td style="width: 40%">
                                    <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                        value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jm_sepuluh : '' }}"
                                        id="jm_sepuluh">
                                </td>
                                <td style="border: 1px solid;"></td>
                                <td style="border: 1px solid;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <hr style="width: 100%; border: 3px solid">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12">
                <input type="checkbox"
                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ in_array('pra_anastesi', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->catatan)) ? 'checked' : '' }} @endif
                    id="pra_anastesi">
                Sesuai dengan asesmen pra-anastesi &nbsp;&nbsp;
                <input type="checkbox"
                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ in_array('perubahan_rencana', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->catatan)) ? 'checked' : '' }} @endif
                    id="perubahan_rencana">
                Anastesi dengan perubahan rencana
            </div>
            <div class="col-md-12">
                <input type="checkbox" onchange="cek_tunda()"
                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ in_array('tunda', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->catatan)) ? 'checked' : '' }} @endif
                    id="tunda">
                Tunda, Alasan
                <input type="text" readonly
                    value="@if (old('ket_tunda')) {{ old('ket_tunda') }}@else{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->ket_tunda : '' }} @endif"
                    id="ket_tunda" style="border: 0; border-bottom: 2px dotted; width: 70%">
            </div>
            <div class="col-md-12">
                <table style="width: 100%;" class="table_isian_borderless">
                    <tr>
                        <td style="width: 15%">Tehnik Nestesi : </td>
                        <td style="width: 10%">Regional <span style="float: right">:</span></td>
                        <td style="width: 30%">
                            <input type="checkbox"
                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi) &&
                                        is_array(json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional))) {{ in_array('spinal', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional)) ? 'checked' : '' }} @endif
                                id="spinal"> Spinal &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"
                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi) &&
                                        is_array(json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional))) {{ in_array('epidural', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional)) ? 'checked' : '' }} @endif
                                id="epidural"> Epidural &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"
                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi) &&
                                        is_array(json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional))) {{ in_array('blok', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional)) ? 'checked' : '' }} @endif
                                id="blok"> Blok
                            {{-- <input @if (old('regional')) {{ old('regional') ==  'Spinal' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional == 'Spinal' ? 'checked' : '') : '' }} @endif type="radio" value="Spinal" name="radio_regional"> Spinal /
                            <input @if (old('regional')) {{ old('regional') ==  'Epidural' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional == 'Epidural' ? 'checked' : '') : '' }} @endif type="radio" value="Epidural" name="radio_regional"> Epidural /
                            <input @if (old('regional')) {{ old('regional') ==  'Blok' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->regional == 'Blok' ? 'checked' : '') : '' }} @endif type="radio" value="Blok" name="radio_regional"> Blok --}}
                        </td>
                        <td style="width: 10%">Induksi <span style="float: right;">:</span></td>
                        <td>
                            <input
                                @if (old('induksi')) {{ old('induksi') == 'Intravena' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->induksi == 'Intravena' ? 'checked' : '') : '' }} @endif
                                type="radio" value="Intravena" name="radio_induksi"> Intravena
                            <input
                                @if (old('induksi')) {{ old('induksi') == 'Inhalasi' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->induksi == 'Inhalasi' ? 'checked' : '') : '' }} @endif
                                type="radio" value="Inhalasi" name="radio_induksi"> Inhalasi
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%"></td>
                        <td style="width: 10%">TIVA <span style="float: right">:</span></td>
                        <td style="width: 30%">
                            {{-- <input @if (old('tiva')) {{ old('tiva') ==  'Y' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->tiva == 'Y' ? 'checked' : '') : '' }} @endif type="radio" value="Y" name="radio_tiva"> Y
                            <input @if (old('tiva')) {{ old('tiva') ==  'T' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->tiva == 'T' ? 'checked' : '') : '' }} @endif type="radio" value="T" name="radio_tiva"> T --}}
                            <input type="checkbox"
                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi) &&
                                        is_array(json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->tiva))) {{ in_array('iya', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->tiva)) ? 'checked' : '' }} @endif
                                id="iya"> Y &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"
                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi) &&
                                        is_array(json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->tiva))) {{ in_array('tidak', json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->tiva)) ? 'checked' : '' }} @endif
                                id="tidak"> T&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style="width: 10%">Inhalasi <span style="float: right;">:</span></td>
                        <td>
                            <input
                                @if (old('inhalasi')) {{ old('inhalasi') == 'semi closed' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->inhalasi == 'semi closed' ? 'checked' : '') : '' }} @endif
                                type="radio" value="semi closed" name="radio_inhalasi"> semi closed /
                            <input
                                @if (old('inhalasi')) {{ old('inhalasi') == 'semi open' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->inhalasi == 'semi open' ? 'checked' : '') : '' }} @endif
                                type="radio" value="semi open" name="radio_inhalasi"> semi open /
                            <input
                                @if (old('inhalasi')) {{ old('inhalasi') == 'closed' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->inhalasi == 'closed' ? 'checked' : '') : '' }} @endif
                                type="radio" value="closed" name="radio_inhalasi"> closed
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 55%">
                            <input
                                @if (old('ett_lma')) {{ old('ett_lma') == 'ett' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->ett_lma == 'ett' ? 'checked' : '') : '' }} @endif
                                type="radio" value="ett" name="radio_ett_lma"> ETT /
                            <input
                                @if (old('ett_lma')) {{ old('ett_lma') == 'lma' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->ett_lma == 'lma' ? 'checked' : '') : '' }} @endif
                                type="radio" value="lma" name="radio_ett_lma"> LMA
                            No <input type="text"
                                value="@if (old('ket_ett_lma')) {{ old('ket_ett_lma') }}@else{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->ket_ett_lma : '' }} @endif"
                                id="ket_ett_lma" style="border: 0; border-bottom: 2px dotted; width: 50px">
                            Masker dengan
                            <input
                                @if (old('masker')) {{ old('masker') == 'Mesin' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->masker == 'Mesin' ? 'checked' : '') : '' }} @endif
                                type="radio" value="Mesin" name="radio_masker"> Mesin /
                            <input
                                @if (old('masker')) {{ old('masker') == 'Tangan' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->masker == 'Tangan' ? 'checked' : '') : '' }} @endif
                                type="radio" value="Tangan" name="radio_masker"> Tangan /
                            <input
                                @if (old('masker')) {{ old('masker') == 'Trakheostomy' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->masker == 'Trakheostomy' ? 'checked' : '') : '' }} @endif
                                type="radio" value="Trakheostomy" name="radio_masker"> Trakheostomy
                        </td>
                        <td style="width: 10%; vertical-align: text-top">Maintenance <span
                                style="float: right;">:</span></td>
                        <td style="vertical-align: text-top">
                            <input
                                @if (old('maintenance')) {{ old('maintenance') == 'Sevoflurane' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->maintance == 'Sevoflurane' ? 'checked' : '') : '' }} @endif
                                type="radio" value="Sevoflurane" name="radio_maintenance"> Sevoflurane /
                            <input
                                @if (old('maintenance')) {{ old('maintenance') == 'Isoflurance' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->maintance == 'Isoflurance' ? 'checked' : '') : '' }} @endif
                                type="radio" value="Isoflurance" name="radio_maintenance"> Isoflurance /
                            <input
                                @if (old('maintenance')) {{ old('maintenance') == '02' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->maintance == '02' ? 'checked' : '') : '' }} @endif
                                type="radio" value="02" name="radio_maintenance"> 02 /
                            <input
                                @if (old('maintenance')) {{ old('maintenance') == 'N2O' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->maintance == 'N2O' ? 'checked' : '') : '' }} @endif
                                type="radio" value="N2O" name="radio_maintenance"> N2O
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <div class="chart-container"
                    style="width: 88%; height:230px; z-index: 1; position: absolute; top:225px; left: 190px;">
                    <canvas id="chart_rr_isian_satu" style="width:100%; height:215px;"></canvas>
                </div>
                <div class="chart-container"
                    style="width: 88%; height:350px; z-index: 1; position: absolute; top:300px; left: 190px;">
                    <canvas id="chart_nadi_isian_satu" style="width: 100%; height:255px;"></canvas>
                </div>
                <div class="chart-container"
                    style="width: 88%; height:330px; z-index: 1; position: absolute; top:210px; left: 190px;">
                    <canvas id="chart_sistole_isian_satu" style="width: 100%; height:330px;"></canvas>
                </div>
                <div class="chart-container"
                    style="width: 88%; height:330px; z-index: 1; position: absolute; top:210px; left: 190px;">
                    <canvas id="chart_diastole_isian_satu" style="width: 100%; height:330px;"></canvas>
                </div>

                <table style="width: 100%;" class="table_isian">
                    <tr>
                        <?php $isian_satu = $dokumen->dokumen_laporan_anastesi_dan_sedasi ? json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->isian_satu) : []; ?>
                        <td colspan="3" style="width: 10%">Jam</td>
                        @for ($j = 0; $j < 24; $j++)
                            <td class="text-center">
                                <button id="btn_isian_satu_{{ $j }}"
                                    onclick="open_modal_isian_satu('{{ $j }}')">
                                    @if (isset($isian_satu[$j]))
                                        {{ $isian_satu[$j]->jam }}
                                    @else
                                        --:--
                                    @endif
                                </button>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 10%">0<sub>2</sub></td>
                        @for ($j = 0; $j < 24; $j++)
                            <td class="text-center"> {{ isset($isian_satu[$j]) ? $isian_satu[$j]->o2 : '' }} </td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 10%">N<sub>2</sub>0</td>
                        @for ($j = 0; $j < 24; $j++)
                            <td class="text-center">{{ isset($isian_satu[$j]) ? $isian_satu[$j]->n2o : '' }}</td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 10%">Sevoflurane</td>
                        @for ($j = 0; $j < 24; $j++)
                            <td class="text-center">{{ isset($isian_satu[$j]) ? $isian_satu[$j]->sevoflurane : '' }}
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 10%">Isoflurane</td>
                        @for ($j = 0; $j < 24; $j++)
                            <td class="text-center">{{ isset($isian_satu[$j]) ? $isian_satu[$j]->isoflurane : '' }}
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 10%">Infus</td>
                        @for ($j = 0; $j < 24; $j++)
                            <td class="text-center">{{ isset($isian_satu[$j]) ? $isian_satu[$j]->infus : '' }}</td>
                        @endfor
                    </tr>
                    <tr>
                        <td style="width: 3%; text-align: center;">R</td>
                        <td style="width: 3%; text-align: center;">N</td>
                        <td style="width: 3%; text-align: center;">TD</td>
                        @for ($j = 0; $j < 24; $j++)
                            <td>&nbsp;</td>
                        @endfor
                    </tr>
                    <tr>
                        <td style="width: 3%; text-align: center;">
                            (+)
                        </td>
                        <td style="width: 3%; text-align: center;">
                            (-)
                        </td>
                        <td style="width: 3%; text-align: center;">
                            (v,^)
                        </td>
                        @for ($j = 0; $j < 24; $j++)
                            <td>&nbsp;</td>
                        @endfor
                    </tr>
                    @php
                        $var1 = 36;
                        $var2 = 200;
                        $var3 = 240;
                    @endphp
                    <tr>
                        <td rowspan="12" style="width: 3%; text-align: center;">
                            @for ($i = 0; $i <= 12; $i++)
                                @if ($var1 != 0)
                                    {{ $var1 -= 4 }}
                                @endif <br>
                            @endfor
                        </td>
                        <td rowspan="12" style="width: 3%; text-align: center;">
                            @for ($i = 0; $i <= 12; $i++)
                                @if ($i > 3)
                                    {{ $var2 -= 20 }}
                                @endif
                                <br>
                            @endfor
                        </td>
                        <td rowspan="12" style="width: 3%; text-align: center;">
                            @for ($i = 0; $i <= 12; $i++)
                                @if ($var3 != 0)
                                    {{ $var3 -= 20 }}
                                @endif <br>
                            @endfor
                        </td>
                    </tr>
                    @for ($i = 0; $i <= 10; $i++)
                        <tr>
                            @for ($j = 0; $j < 24; $j++)
                                <td>&nbsp;</td>
                            @endfor
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="3" style="width: 10%; text-align: center;">
                            SPO<sub>2</sub>
                        </td>
                        <td colspan="6">
                            <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->spo1 : '' }}"
                                id="spo1">
                        </td>
                        <td colspan="6">
                            <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->spo2 : '' }}"
                                id="spo2">
                        </td>
                        <td colspan="6">
                            <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->spo3 : '' }}"
                                id="spo3">
                        </td>
                        <td colspan="6">
                            <input type="text" style="border: none; border-bottom: 2px dotted; width: 100%"
                                value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->spo4 : '' }}"
                                id="spo4">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-4 text-center" style="padding-bottom: 10px; padding-top: 10px">
                Dokter Anastesi
                <br>
                <a href="#" style="text-decoration:none; color:#111; text-align: center">
                    @if ($dokumen->id_verifikator == 0)
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.................................................)
                        <br>Ttd & Nama Terang
                    @else
                        @if (isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}"
                                style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 4cm; width: 5cm;"
                                alt="">
                        @endif
                        <br>({{ $dokumen->nama_verifikator }})<br>
                    @endif
                </a>
            </div>
            <div class="col-md-8 text-center" style="padding-bottom: 10px; padding-top: 10px; z-index: 50;">
                (Waktu Anastesi : <input type="time" id="waktu_anastesi"
                    value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->waktu_anastesi : null }}"
                    style="border: hidden; border-bottom: 1px dotted"> WIB)
                (Selesai : <input type="time" id="selesai_anastesi"
                    value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->selesai_anastesi : null }}"
                    style="border: hidden; border-bottom: 1px dotted"> WIB)
            </div>
        </div>
        <div class="pagebreak"></div>
        <hr style="width: 100%; border: 3px solid">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center">
                <h6 style="color: black">MONITORING RECOVERY ROOM</h6>
                <table style="width: 100%" class="table_isian">
                    <tr>
                        <td style="padding: 10px; text-align: left">
                            Pasien Masuk RR :
                            <div class="input-group">
                                <input type="time" id="pasien_masuk_rr" name="pasien_masuk_rr"
                                    value="
                                    {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->pasien_masuk_rr : null }}"
                                    class="form-control">
                            </div>
                        </td>
                        <td style="padding: 10px; text-align: left">
                            PERAWAT RR :
                            <div class="input-group">
                                <input type="text" hidden id="id_perawat_masuk_rr">
                                <input type="text" readonly
                                    value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->perawat_masuk_rr : '' }}"
                                    id="perawat_masuk_rr" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button"
                                        onclick="open_modal_perawat('perawat_masuk_rr')"><i
                                            class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 10px; text-align: left">
                            Penata Anastesi :
                            {{-- <div class="input-group">
                                <input type="text" hidden id="id_penata_anastesi">
                                <input type="text" readonly value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->penata_anastesi : ''}}" id="penata_anastesi" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" onclick="open_modal_instrumen('penata_anastesi')"><i class="fa fa-list"></i></button>
                                </div>
                            </div> --}}
                            <div class="input-group">
                                <input type="text" hidden id="id_penata_anastesi">
                                <input type="text" readonly
                                    value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->penata_anastesi : '' }}"
                                    id="penata_anastesi" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button"
                                        onclick="open_modal_perawat('penata_anastesi')"><i
                                            class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="chart-container"
                    style="width: 88%; height:285px; z-index: 1; position: absolute; top:180px; left: 200px;">
                    <canvas id="chart_spo2_isian_dua" style="width: 100%; height:285px;"></canvas>
                </div>
                <div class="chart-container"
                    style="width: 88%; height:300px; z-index: 1; position: absolute; top:170px; left:200px;">
                    <canvas id="chart_nadi_isian_dua" style="width: 100%; height:300px;"></canvas>
                </div>
                <div class="chart-container"
                    style="width: 88%; height:350px; z-index: 1; position: absolute; top:140px; left: 200px;">
                    <canvas id="chart_sistole_isian_dua" style="width: 100%; height:350px;"></canvas>
                </div>
                <div class="chart-container"
                    style="width: 88%; height:350px; z-index: 1; position: absolute; top:140px; left: 200px;">
                    <canvas id="chart_diastole_isian_dua" style="width: 100%; height:350px;"></canvas>
                </div>
                <table style="width: 100%;" class="table_isian">
                    <tr>
                        <td colspan="3" style="width: 10%">Jam</td>
                        <?php $isian_dua = $dokumen->dokumen_laporan_anastesi_dan_sedasi ? json_decode($dokumen->dokumen_laporan_anastesi_dan_sedasi->isian_dua) : []; ?>
                        @for ($j = 0; $j < 24; $j++)
                            <td class="text-center">
                                <button id="btn_isian_dua_{{ $j }}"
                                    onclick="open_modal_isian_dua('{{ $j }}')">
                                    @if (isset($isian_dua[$j]))
                                        {{ $isian_dua[$j]->jam }}
                                    @else
                                        {{ '--:--' }}
                                    @endif
                                </button>
                            </td>
                        @endfor
                        <!-- <td colspan="40" style="text-align: left">
                        <input type="time" id="jam_anastesi2" value="@if (old('jam_anastesi2')) {{ old('jam_anastesi2') }}@else{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->jam_anastesi2 : '' }} @endif" style="border: hidden; border-bottom: 1px dotted">
                    </td> -->
                    </tr>
                    <tr>
                        <td style="width: 3%; text-align: center;">
                            SPO<sub>2</sub>
                        </td>
                        <td style="width: 3%; text-align: center;">
                            N
                        </td>
                        <td style="width: 3%; text-align: center;">
                            TD
                        </td>
                        @for ($j = 0; $j < 24; $j++)
                            <td>&nbsp;</td>
                        @endfor
                    </tr>
                    @php
                        $var1 = 110;
                        $var2 = 200;
                        $var3 = 220;
                    @endphp
                    @for ($i = 0; $i <= 10; $i++)
                        <tr>
                            <td style="width: 3%; text-align: center;">
                                @if ($i <= 2)
                                    {{ $var1 -= 10 }}%
                                @endif
                            </td>
                            <td style="width: 3%; text-align: center;">
                                @if ($var2 != 0)
                                    {{ $var2 -= 20 }}
                                @endif
                            </td>
                            <td style="width: 3%; text-align: center;">
                                @if ($var3 != 0)
                                    {{ $var3 -= 20 }}
                                @endif
                            </td>
                            @for ($j = 0; $j < 24; $j++)
                                <td>&nbsp;</td>
                            @endfor
                        </tr>
                    @endfor
                </table>
                <table style="width: 100%" class="table_isian">
                    <tr>
                        <td style="padding: 10px; text-align: left">
                            Pasien Keluar RR :
                            <div class="input-group">
                                <input type="time" id="pasien_keluar_rr"
                                    value="@if (old('pasien_keluar_rr')) {{ old('pasien_keluar_rr') }}@else{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->pasien_keluar_rr : '' }} @endif"
                                    class="form-control">
                            </div>
                        </td>
                        <td style="padding: 10px; text-align: left">
                            KE :
                            <input
                                @if (old('keluar_rr')) {{ old('keluar_rr') == 'ruang_rawat' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->keluar_rr == 'ruang_rawat' ? 'checked' : '') : '' }} @endif
                                type="radio" value="ruang_rawat" name="radio_keluar_rr"> Ruang Rawat /
                            <input
                                @if (old('keluar_rr')) {{ old('keluar_rr') == 'ICU' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->keluar_rr == 'ICU' ? 'checked' : '') : '' }} @endif
                                type="radio" value="ICU" name="radio_keluar_rr"> ICU /
                            <input
                                @if (old('keluar_rr')) {{ old('keluar_rr') == 'pulang' ? 'checked' : '' }} @else {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? ($dokumen->dokumen_laporan_anastesi_dan_sedasi->keluar_rr == 'pulang' ? 'checked' : '') : '' }} @endif
                                type="radio" value="pulang" name="radio_keluar_rr"> Langsung Pulang
                        </td>
                        <td style="padding: 10px; text-align: left">
                            PERAWAT RR :
                            <div class="input-group">
                                <input type="text" hidden id="id_perawat_keluar_rr">
                                <input type="text" readonly
                                    value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->perawat_keluar_rr : '' }}"
                                    id="perawat_keluar_rr" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button"
                                        onclick="open_modal_perawat('perawat_keluar_rr')"><i
                                            class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 10px; text-align: left">
                            Yang Menerima :
                            <div class="input-group">
                                <input type="text" hidden id="id_perawat_penerima">
                                <input type="text" readonly
                                    value="{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->perawat_penerima : '' }}"
                                    id="perawat_penerima" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button"
                                        onclick="open_modal_perawat('perawat_penerima')"><i
                                            class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; margin-top: 30px">
            <div class="col-md-12 text-center">
                <h5 style="color: black"><u>KRITERIA PULIH SADAR DARI ANASTESI SEBELUM PASIEN PINDAH DARI RUANG
                        PEMULIHAN KERUANGAN RAWAT</u></h5>
                <table style="width: 100%">
                    <tr>
                        <td style="width: 50%; border: hidden">
                            ALDRETTER SCORE
                            <br>
                            Kriteria pulih sadar dari anastesi umum pada dewasa,
                            <br>
                            score >= 8 boleh pindah ruangan
                            <br>
                            <table style="width: 100%" class="table_isian">
                                <tr>
                                    <td colspan="2" style="width: 70%">Kriteria</td>
                                    <td style="width: 10%">Skala</td>
                                    <td colspan="2" style="width: 20%">Nilai Skor</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Aktivitas
                                        Motorik</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Menggerakan ekstremitas dengan perintah</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="aktivitas_motorik_masuk" onchange="hitung_skor_masuk_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktivitas_motorik_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktivitas_motorik_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktivitas_motorik_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="aktivitas_motorik_keluar"
                                            onchange="hitung_skor_keluar_aldrette()" class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktivitas_motorik_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktivitas_motorik_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktivitas_motorik_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Menggerakan 2 ekstremitas dengan perintah</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Tidak mampu menggerakan semua ekstremitas</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Respirasi</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Nafas adekuat dan dapat batuk</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="respirasi_masuk" onchange="hitung_skor_masuk_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="respirasi_keluar" onchange="hitung_skor_keluar_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Nafas kurang adekuat/hipoventilasi/usaha nafas</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Apneu</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Sirkulasi</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">TD
                                        +-20% dari semula preanestesi</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="sirkulasi_masuk" onchange="hitung_skor_masuk_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->sirkulasi_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->sirkulasi_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->sirkulasi_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="sirkulasi_keluar" onchange="hitung_skor_keluar_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->sirkulasi_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->sirkulasi_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->sirkulasi_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">TD
                                        +-20% -50% dari semula preanestesi</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">TD
                                        +-50% dari semula preanestesi</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Kesadaran</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Sadar Penuh</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="kesadaran_masuk" onchange="hitung_skor_masuk_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="kesadaran_keluar" onchange="hitung_skor_keluar_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Bangun jika dipanggil</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Tidak ada respon/belum sadar</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Warna Kulit</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Kemerahan</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="warna_kulit_masuk" onchange="hitung_skor_masuk_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->warna_kulit_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->warna_kulit_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->warna_kulit_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="warna_kulit_keluar" onchange="hitung_skor_keluar_aldrette()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->warna_kulit_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->warna_kulit_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->warna_kulit_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Pucat</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Sianosis</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 35%"
                                        style="text-align: left; padding-left: 15px; border-right: hidden">Jumlah</td>
                                    <td style="width: 35%"
                                        style="text-align: left; padding-left: 15px; border-right: hidden">
                                        Masuk <span id="total_aldrette_masuk">(........)</span>
                                    </td>
                                    <td colspan="3" style="width: 30%">
                                        Keluar <span id="total_aldrette_keluar">(........)</span>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            (BROMAGE SCORE) Kriteria pulih sadar dari anastesi
                            <br>
                            spinal/edural, score <= 2 boleh pindah ruang <br>
                                <table style="width: 100%;" class="table_isian">
                                    <tr>
                                        <td colspan="2" style="width: 70%">Kriteria</td>
                                        <td style="width: 10%">Skala</td>
                                        <td colspan="2" style="width: 20%">Nilai Skor</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                            Dapat mengangkat tungkai bawah</td>
                                        <td style="width: 10%">0</td>
                                        <td rowspan="4" style="width: 10%">
                                            <select id="bromage_masuk" onchange="hitung_skor_masuk_bromage()"
                                                class="form-control">
                                                <option value="">---</option>
                                                <option value="0"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_masuk == '0' ? 'selected' : '' }} @endif>
                                                    0</option>
                                                <option value="1"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_masuk == '1' ? 'selected' : '' }} @endif>
                                                    1</option>
                                                <option value="2"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_masuk == '2' ? 'selected' : '' }} @endif>
                                                    2</option>
                                                <option value="3"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_masuk == '3' ? 'selected' : '' }} @endif>
                                                    3</option>
                                            </select>
                                        </td>
                                        <td rowspan="4" style="width: 10%">
                                            <select id="bromage_keluar" onchange="hitung_skor_keluar_bromage()"
                                                class="form-control">
                                                <option value="">---</option>
                                                <option value="0"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_keluar == '0' ? 'selected' : '' }} @endif>
                                                    0</option>
                                                <option value="1"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_keluar == '1' ? 'selected' : '' }} @endif>
                                                    1</option>
                                                <option value="2"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_keluar == '2' ? 'selected' : '' }} @endif>
                                                    2</option>
                                                <option value="3"
                                                    @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->bromage_keluar == '3' ? 'selected' : '' }} @endif>
                                                    3</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                            Tidak dapat menekuk lutut tetapi dapat mengangkat kaki</td>
                                        <td style="width: 10%">1</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                            Tidak dapat mengangkat tungkai bawah tetapi masih dapat menekuk lutut</td>
                                        <td style="width: 10%">2</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                            Tidak dapat mengangkat kaki sama sekali</td>
                                        <td style="width: 10%">3</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 35%"
                                            style="text-align: left; padding-left: 15px; border-right: hidden">Jumlah
                                        </td>
                                        <td style="width: 35%"
                                            style="text-align: left; padding-left: 15px; border-right: hidden">
                                            Masuk <span id="total_bromage_masuk">(........)</span>
                                        </td>
                                        <td colspan="3" style="width: 30%">
                                            Keluar <span id="total_bromage_keluar">(........)</span>
                                        </td>
                                    </tr>
                                </table>
                        </td>
                        <td style="width: 50%; border: hidden; vertical-align: text-top">
                            STEWARD SCORE
                            <br>
                            Kriteria pulih sadar dari anastesi umum pada anak,
                            <br>
                            score >= 5 boleh pindah ruangan
                            <br>
                            <table style="width: 100%;" class="table_isian">
                                <tr>
                                    <td colspan="2" style="width: 70%">Kriteria</td>
                                    <td style="width: 10%">Skala</td>
                                    <td colspan="2" style="width: 20%">Nilai Skor</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Kesadaran</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Bangun</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="kesadaran_steward_masuk" onchange="hitung_skor_masuk_steward()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_steward_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_steward_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_steward_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="kesadaran_steward_keluar"
                                            onchange="hitung_skor_keluar_steward()" class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_steward_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_steward_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->kesadaran_steward_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">Ada
                                        respon terhadap rangsang</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Tidak ada respon</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Respirasi</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Batuk/menangis</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="respirasi_steward_masuk" onchange="hitung_skor_masuk_steward()"
                                            class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_steward_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_steward_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_steward_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="respirasi_steward_keluar"
                                            onchange="hitung_skor_keluar_steward()" class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_steward_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_steward_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->respirasi_steward_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Berusaha bernafas</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Perlu bantuan nafas</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left; padding-left: 15px">Aktifitas
                                        Motorik</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Gerak bertujuan</td>
                                    <td style="width: 10%">2</td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="aktifitas_motorik_steward_masuk"
                                            onchange="hitung_skor_masuk_steward()" class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktifitas_motorik_steward_masuk == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktifitas_motorik_steward_masuk == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktifitas_motorik_steward_masuk == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" style="width: 10%">
                                        <select id="aktifitas_motorik_steward_keluar"
                                            onchange="hitung_skor_keluar_steward()" class="form-control">
                                            <option value="">---</option>
                                            <option value="2"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktifitas_motorik_steward_keluar == '2' ? 'selected' : '' }} @endif>
                                                2</option>
                                            <option value="1"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktifitas_motorik_steward_keluar == '1' ? 'selected' : '' }} @endif>
                                                1</option>
                                            <option value="0"
                                                @if (isset($dokumen->dokumen_laporan_anastesi_dan_sedasi)) {{ $dokumen->dokumen_laporan_anastesi_dan_sedasi->aktifitas_motorik_steward_keluar == '0' ? 'selected' : '' }} @endif>
                                                0</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Gerak tanpa tujuan</td>
                                    <td style="width: 10%">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 70%; text-align: left; padding-left: 15px">
                                        Tidak ada gerakan</td>
                                    <td style="width: 10%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 35%"
                                        style="text-align: left; padding-left: 15px; border-right: hidden">Jumlah</td>
                                    <td style="width: 35%"
                                        style="text-align: left; padding-left: 15px; border-right: hidden">
                                        Masuk <span id="total_steward_masuk">(........)</span>
                                    </td>
                                    <td colspan="3" style="width: 30%">
                                        Keluar <span id="total_steward_keluar">(........)</span>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            Dokter Anastesi
                            <br>
                            <a href="#" style="text-decoration:none; color:#111; text-align: center">
                                @if ($dokumen->id_verifikator == 0)
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>Ttd & Nama Terang
                                @else
                                    @if (isset($employee))
                                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>({{ $dokumen->nama_verifikator }})<br>
                                @endif
                            </a>
                            <br>
                            <br>
                            <img id="gambar_anastesi1" style="display:none"
                                src="{{ isset($dokumen->dokumen_laporan_anastesi_dan_sedasi) ? asset('gambar_laporan_anastesi/' . $dokumen->dokumen_laporan_anastesi_dan_sedasi->gambar1) : '' }}"
                                alt="">
                            <img id="gambar_anastesi2" style="display:none"
                                src="{{ isset($dokumen->dokumen_laporan_anastesi_dan_sedasi) ? asset('gambar_laporan_anastesi/' . $dokumen->dokumen_laporan_anastesi_dan_sedasi->gambar2) : '' }}"
                                alt="">

                            <!-- <canvas id="canvas1" style="border:1px solid;"></canvas>
                            <canvas id="canvas2" style="border:1px solid;"></canvas> -->
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12 text-center">
            <button onclick="open_modal_dokter()" class="btn btn-success hidden_print">Simpan</button>
        </div>
    </div>
    {{-- <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if ($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/detail/pdf_dokumen_laporan_anastesi_dan_sedasi?dokumen='.$dokumen->id) }}"
    class="btn btn-success" target="_blank">Download PDF</a>
    @endif
    </div>
    </div> --}}
    <div class="modal fade" id="modal_yth" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Data Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabel_kepada" class="table table-striped mt-2" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
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

    <div class="modal fade" id="modal_instrumen" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Instrumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabel_instrumen" class="table table-striped mt-2" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
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

    <div class="modal fade" id="modal_perawat" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Perawat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabel_perawat" class="table table-striped mt-2" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
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

    <div class="modal fade" id="modal_isian_satu" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_isian_satu">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="index" id="isian_satu_index">
                        <div class="form-group">
                            <label for="">Jam</label>
                            <input type="time" name="jam" id="isian_satu_jam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">O<sub>2</sub></label>
                            <input type="text" name="o2" id="isian_satu_o2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">N<sub>2</sub>O</label>
                            <input type="text" name="n2o" id="isian_satu_n2o" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Sevoflurane</label>
                            <input type="text" name="sevoflurane" id="isian_satu_sevoflurane"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Isoflurane</label>
                            <input type="text" name="isoflurane" id="isian_satu_isoflurane"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Infus</label>
                            <input type="text" name="infus" id="isian_satu_infus" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">R</label>
                            <input type="number" name="rr" id="isian_satu_rr" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">N</label>
                            <input type="number" name="nadi" id="isian_satu_nadi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">TD (Sistole)</label>
                            <input type="number" name="sistole" id="isian_satu_sistole" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">TD (Diastole)</label>
                            <input type="number" name="diastole" id="isian_satu_diastole" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_isian_dua" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_isian_dua">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="index" id="isian_dua_index">
                        <div class="form-group">
                            <label for="">Jam</label>
                            <input type="time" name="jam" id="isian_dua_jam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">SPO2</label>
                            <input type="number" name="spo2" id="isian_dua_spo2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">N</label>
                            <input type="number" name="nadi" id="isian_dua_nadi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">TD (Sistole)</label>
                            <input type="number" name="sistole" id="isian_dua_sistole" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">TD (Diastole)</label>
                            <input type="number" name="diastole" id="isian_dua_diastole" class="form-control">
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let isian_satu = <?php echo $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->isian_satu : '[]'; ?>;
    let isian_dua = <?php echo $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->isian_dua : '[]'; ?>;

    //inisialisasi data grafik RR pada isian satu
    let rr_isian_satu = [];
    for (let i = 0; i < 24; i++) {
        if (isian_satu[i] != undefined) {
            rr_isian_satu[i] = parseInt(isian_satu[i].rr);
        }
    }

    //inisialisasi data grafik nadi pada isian satu
    let nadi_isian_satu = [];
    for (let i = 0; i < 24; i++) {
        if (isian_satu[i] != undefined) {
            nadi_isian_satu[i] = parseInt(isian_satu[i].nadi);
        }
    }

    //inisialisasi data grafik Sistole pada isian satu
    let sistole_isian_satu = [];
    for (let i = 0; i < 24; i++) {
        if (isian_satu[i] != undefined) {
            sistole_isian_satu[i] = parseInt(isian_satu[i].sistole);
        }
    }

    //inisialisasi data grafik Diastole pada isian satu
    let diastole_isian_satu = [];
    for (let i = 0; i < 24; i++) {
        if (isian_satu[i] != undefined) {
            diastole_isian_satu[i] = parseInt(isian_satu[i].diastole);
        }
    }

    //inisialisasi data grafik SPO2 pada isian dua
    let spo2_isian_dua = [];
    for (let i = 0; i < 24; i++) {
        if (isian_dua[i] != undefined) {
            spo2_isian_dua[i] = parseInt(isian_dua[i].spo2);
        }
    }

    //inisialisasi data grafik nadi pada isian dua
    let nadi_isian_dua = [];
    for (let i = 0; i < 24; i++) {
        if (isian_dua[i] != undefined) {
            nadi_isian_dua[i] = parseInt(isian_dua[i].nadi);
        }
    }

    //inisialisasi data grafik Sistole pada isian dua
    let sistole_isian_dua = [];
    for (let i = 0; i < 24; i++) {
        if (isian_dua[i] != undefined) {
            sistole_isian_dua[i] = parseInt(isian_dua[i].sistole);
        }
    }

    //inisialisasi data grafik Diastole pada isian dua
    let diastole_isian_dua = [];
    for (let i = 0; i < 24; i++) {
        if (isian_dua[i] != undefined) {
            diastole_isian_dua[i] = parseInt(isian_dua[i].diastole);
        }
    }

    const ctx_rr_satu = document.getElementById('chart_rr_isian_satu');
    const ctx_nadi_satu = document.getElementById('chart_nadi_isian_satu');
    const ctx_sistole_satu = document.getElementById('chart_sistole_isian_satu');
    const ctx_diastole_satu = document.getElementById('chart_diastole_isian_satu');
    const ctx_spo2_dua = document.getElementById('chart_spo2_isian_dua');
    const ctx_nadi_dua = document.getElementById('chart_nadi_isian_dua');
    const ctx_sistole_dua = document.getElementById('chart_sistole_isian_dua');
    const ctx_diastole_dua = document.getElementById('chart_diastole_isian_dua');

    new Chart(ctx_rr_satu, {
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: 0,
                    max: 32,
                    ticks: {
                        stepSize: 4,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'green',
                borderColor: 'green',
                data: rr_isian_satu,
                label: '',
                fill: 'green',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    new Chart(ctx_nadi_satu, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: false,
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: 0,
                    max: 200,
                    ticks: {
                        stepSize: 20,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'black',
                borderColor: 'black',
                data: nadi_isian_satu,
                label: '',
                fill: 'black',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    new Chart(ctx_sistole_satu, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: false,
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: -20,
                    max: 220,
                    ticks: {
                        stepSize: 20,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'red',
                borderColor: 'red',
                data: sistole_isian_satu,
                label: '',
                fill: 'red',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    new Chart(ctx_diastole_satu, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: false,
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: -20,
                    max: 220,
                    ticks: {
                        stepSize: 20,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'blue',
                borderColor: 'blue',
                data: diastole_isian_satu,
                label: '',
                fill: 'blue',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    new Chart(ctx_spo2_dua, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: false,
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: 0,
                    max: 100,
                    ticks: {
                        stepSize: 10,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'green',
                borderColor: 'green',
                data: spo2_isian_dua,
                label: '',
                fill: 'green',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    new Chart(ctx_nadi_dua, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: false,
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: -20,
                    max: 180,
                    ticks: {
                        stepSize: 20,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'black',
                borderColor: 'black',
                data: nadi_isian_dua,
                label: '',
                fill: 'black',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    new Chart(ctx_sistole_dua, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: false,
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: -20,
                    max: 220,
                    ticks: {
                        stepSize: 20,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'red',
                borderColor: 'red',
                data: sistole_isian_dua,
                label: '',
                fill: 'red',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    new Chart(ctx_diastole_dua, {
        type: 'line',
        // responsive: true,
        // maintainAspectRatio: false,
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
                    display: false,
                    title: {
                        display: false
                    },
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                    },
                    grid: {
                        display: false
                    },
                    min: -20,
                    max: 220,
                    ticks: {
                        stepSize: 20,
                        display: false,
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
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                ''
            ],
            datasets: [{
                backgroundColor: 'blue',
                borderColor: 'blue',
                data: diastole_isian_dua,
                label: '',
                fill: 'blue',
                borderWidth: 3,
                pointRadius: 5
            }]
        }
    });

    function open_modal_isian_satu(index) {
        $('#form_isian_satu')[0].reset();
        $('#isian_satu_index').val(index);
        if (isian_satu[index] != undefined) {
            $('#isian_satu_jam').val(isian_satu[index].jam);
            $('#isian_satu_o2').val(isian_satu[index].o2);
            $('#isian_satu_n2o').val(isian_satu[index].n2o);
            $('#isian_satu_sevoflurane').val(isian_satu[index].sevoflurane);
            $('#isian_satu_isoflurane').val(isian_satu[index].isoflurane);
            $('#isian_satu_infus').val(isian_satu[index].infus);
            $('#isian_satu_rr').val(isian_satu[index].rr);
            $('#isian_satu_nadi').val(isian_satu[index].nadi);
            $('#isian_satu_sistole').val(isian_satu[index].sistole);
            $('#isian_satu_diastole').val(isian_satu[index].diastole);
        }
        $('#modal_isian_satu').modal('show');
    }

    $('#form_isian_satu').submit(function(e) {
        e.preventDefault();
        isian_satu[$('#isian_satu_index').val()] = {
            'jam': $('#isian_satu_jam').val(),
            'o2': $('#isian_satu_o2').val(),
            'n2o': $('#isian_satu_n2o').val(),
            'sevoflurane': $('#isian_satu_sevoflurane').val(),
            'isoflurane': $('#isian_satu_isoflurane').val(),
            'infus': $('#isian_satu_infus').val(),
            'rr': $('#isian_satu_rr').val(),
            'nadi': $('#isian_satu_nadi').val(),
            'sistole': $('#isian_satu_sistole').val(),
            'diastole': $('#isian_satu_diastole').val(),
        };

        $('#btn_isian_satu_' + $('#isian_satu_index').val()).html($('#isian_satu_jam').val());

        $('#modal_isian_satu').modal('hide');
    })

    function open_modal_isian_dua(index) {
        console.log(isian_dua);
        $('#form_isian_dua')[0].reset();
        $('#isian_dua_index').val(index);
        if (isian_dua[index] != undefined) {
            $('#isian_dua_jam').val(isian_dua[index].jam);
            $('#isian_dua_spo2').val(isian_dua[index].spo2);
            $('#isian_dua_nadi').val(isian_dua[index].nadi);
            $('#isian_dua_sistole').val(isian_dua[index].sistole);
            $('#isian_dua_diastole').val(isian_dua[index].diastole);
        }
        $('#modal_isian_dua').modal('show');
    }

    $('#form_isian_dua').submit(function(e) {
        e.preventDefault();
        isian_dua[$('#isian_dua_index').val()] = {
            'jam': $('#isian_dua_jam').val(),
            'spo2': $('#isian_dua_spo2').val(),
            'nadi': $('#isian_dua_nadi').val(),
            'sistole': $('#isian_dua_sistole').val(),
            'diastole': $('#isian_dua_diastole').val(),
        };

        $('#btn_isian_dua_' + $('#isian_dua_index').val()).html($('#isian_dua_jam').val());

        $('#modal_isian_dua').modal('hide');
    })
</script>
<script>
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    var canvas1 = document.getElementById("canvas1"),
        signaturePad1;

    var canvas2 = document.getElementById("canvas2"),
        signaturePad2;

    function resizeCanvas(canvas) {
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    function base64Convert1() {
        var c = document.getElementById("canvas1");
        var img = document.getElementById('gambar_anastesi1');
        c.height = img.naturalHeight;
        c.width = img.naturalWidth;
        var ctx = c.getContext('2d');

        ctx.drawImage(img, 0, 0, c.width, c.height);
        var base64String = c.toDataURL();
        return base64String;
    }

    function base64Convert2() {
        var c = document.getElementById("canvas2");;
        var img = document.getElementById('gambar_anastesi2');
        c.height = img.naturalHeight;
        c.width = img.naturalWidth;
        var ctx = c.getContext('2d');

        ctx.drawImage(img, 0, 0, c.width, c.height);
        var base64String = c.toDataURL();
        return base64String;
    }

    function hitung_skor_masuk_aldrette() {
        let total = 0;
        total += $('#aktivitas_motorik_masuk').val() != '' ? parseInt($('#aktivitas_motorik_masuk').val()) : parseInt(
            0);
        total += $('#respirasi_masuk').val() != '' ? parseInt($('#respirasi_masuk').val()) : parseInt(0);
        total += $('#sirkulasi_masuk').val() != '' ? parseInt($('#sirkulasi_masuk').val()) : parseInt(0);
        total += $('#kesadaran_masuk').val() != '' ? parseInt($('#kesadaran_masuk').val()) : parseInt(0);
        total += $('#warna_kulit_masuk').val() != '' ? parseInt($('#warna_kulit_masuk').val()) : parseInt(0);
        $('#total_aldrette_masuk').html('(' + total + ')');
    }

    function hitung_skor_keluar_aldrette() {
        let total = 0;
        total += $('#aktivitas_motorik_keluar').val() != '' ? parseInt($('#aktivitas_motorik_keluar').val()) : parseInt(
            0);
        total += $('#respirasi_keluar').val() != '' ? parseInt($('#respirasi_keluar').val()) : parseInt(0);
        total += $('#sirkulasi_keluar').val() != '' ? parseInt($('#sirkulasi_keluar').val()) : parseInt(0);
        total += $('#kesadaran_keluar').val() != '' ? parseInt($('#kesadaran_keluar').val()) : parseInt(0);
        total += $('#warna_kulit_keluar').val() != '' ? parseInt($('#warna_kulit_keluar').val()) : parseInt(0);
        $('#total_aldrette_keluar').html('(' + total + ')');
    }

    function hitung_skor_keluar_steward() {
        let total = 0;
        total += $('#aktivitas_motorik_keluar').val() != '' ? parseInt($('#aktivitas_motorik_keluar').val()) : parseInt(
            0);
        total += $('#respirasi_keluar').val() != '' ? parseInt($('#respirasi_keluar').val()) : parseInt(0);
        total += $('#sirkulasi_keluar').val() != '' ? parseInt($('#sirkulasi_keluar').val()) : parseInt(0);
        total += $('#kesadaran_keluar').val() != '' ? parseInt($('#kesadaran_keluar').val()) : parseInt(0);
        total += $('#warna_kulit_keluar').val() != '' ? parseInt($('#warna_kulit_keluar').val()) : parseInt(0);
        $('#total_aldrette_keluar').html('(' + total + ')');
    }

    function hitung_skor_masuk_steward() {
        let total = 0;
        total += $('#kesadaran_steward_masuk').val() != '' ? parseInt($('#kesadaran_steward_masuk').val()) : parseInt(
            0);
        total += $('#respirasi_steward_masuk').val() != '' ? parseInt($('#respirasi_steward_masuk').val()) : parseInt(
            0);
        total += $('#aktifitas_motorik_steward_masuk').val() != '' ? parseInt($('#aktifitas_motorik_steward_masuk')
            .val()) : parseInt(0);
        $('#total_steward_masuk').html('(' + total + ')');
    }

    function hitung_skor_keluar_steward() {
        let total = 0;
        total += $('#kesadaran_steward_keluar').val() != '' ? parseInt($('#kesadaran_steward_keluar').val()) : parseInt(
            0);
        total += $('#respirasi_steward_keluar').val() != '' ? parseInt($('#respirasi_steward_keluar').val()) : parseInt(
            0);
        total += $('#aktifitas_motorik_steward_keluar').val() != '' ? parseInt($('#aktifitas_motorik_steward_keluar')
            .val()) : parseInt(0);
        $('#total_steward_keluar').html('(' + total + ')');
    }

    function hitung_skor_masuk_bromage() {
        $('#total_bromage_masuk').html('(' + $('#bromage_masuk').val() + ')');
    }

    function hitung_skor_keluar_bromage() {
        $('#total_bromage_keluar').html('(' + $('#bromage_keluar').val() + ')');
    }

    $(document).ready(function() {
        hitung_skor_masuk_aldrette();
        hitung_skor_keluar_aldrette();
        hitung_skor_masuk_steward();
        hitung_skor_keluar_steward();
        hitung_skor_masuk_bromage();
        hitung_skor_keluar_bromage();

        let screen_width = window.screen.width;

        if (screen_width == 1366) {
            $('#canvas1').css('width', '1164px');
            $('#canvas1').css('height', '505px');
            $('#canvas1').css('position', 'absolute');
            $('#canvas1').css('top', '-1373px');
            $('#canvas1').css('left', '130px');

            $('#canvas2').css('width', '1160px');
            $('#canvas2').css('height', '325px');
            $('#canvas2').css('position', 'absolute');
            $('#canvas2').css('top', '-439px');
            $('#canvas2').css('left', '134px');
        } else if (screen_width == 1440) {
            $('#canvas1').css('width', '89%');
            $('#canvas1').css('height', '505px');
            $('#canvas1').css('position', 'absolute');
            $('#canvas1').css('top', '-1373px');
            $('#canvas1').css('left', '137px');

            $('#canvas2').css('width', '89%');
            $('#canvas2').css('height', '325px');
            $('#canvas2').css('position', 'absolute');
            $('#canvas2').css('top', '-439px');
            $('#canvas2').css('left', '137px');
        } else if (screen_width == 1920) {
            $('#canvas1').css('width', '1668px');
            $('#canvas1').css('height', '505px');
            $('#canvas1').css('position', 'absolute');
            $('#canvas1').css('top', '-1373px');
            $('#canvas1').css('left', '180px');

            $('#canvas2').css('width', '1668px');
            $('#canvas2').css('height', '325px');
            $('#canvas2').css('position', 'absolute');
            $('#canvas2').css('top', '-439px');
            $('#canvas2').css('left', '179px');
        }

        resizeCanvas(canvas1);
        signaturePad1 = new SignaturePad(canvas1);

        resizeCanvas(canvas2);
        signaturePad2 = new SignaturePad(canvas2);

        var gambar1 =
            `{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->gambar1 : '' }}`
        var gambar2 =
            `{{ $dokumen->dokumen_laporan_anastesi_dan_sedasi ? $dokumen->dokumen_laporan_anastesi_dan_sedasi->gambar2 : '' }}`
        if (gambar1 != '') {
            signaturePad1.fromDataURL(base64Convert1());
        }
        if (gambar2 != '') {
            signaturePad2.fromDataURL(base64Convert2());
        }
    })


    var sts_yth = "";
    var sts_perawat = "";
    var sts_instrumen = "";
    var table;

    function get_data_dokter() {
        table = $('#tabel_kepada').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url('ajax_request/dokter') }}',
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) +
                            '</p>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_jabatan',
                    name: 'nama_jabatan',
                    render(data, type, row) {
                        return '<p class="text-center">' + data + '</p>';
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render(data, type, row) {
                        var fungsi_set = "";
                        fungsi_set = 'set_kepada(' + "'" + data + "','" + row.nama + "','" + row
                            .nama_jabatan + "'" + ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set +
                            '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function open_modal_yth(sts) {
        get_data_dokter();
        sts_yth = sts;
        $('#modal_yth').modal('show');
    }

    function set_kepada(id, nama) {
        if (sts_yth === "d_anastesi") {
            $('#d_anastesi').val(nama);
            $('#id_d_anastesi').val(id);
            $('#modal_yth').modal('hide');
        }
    }

    function open_modal_dokter() {
        $('#modal_petugas').modal('show');
    }

    function get_instrumen() {
        table = $('#tabel_instrumen').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url('ajax_request/dokter') }}',
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) +
                            '</p>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_jabatan',
                    name: 'nama_jabatan',
                    render(data, type, row) {
                        return '<p class="text-center">' + data + '</p>';
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render(data, type, row) {
                        fungsi_set = 'set_instrumen(' + "'" + data + "','" + row.nama + "','" + row
                            .nama_jabatan + "'" + ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set +
                            '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function get_perawat() {
        table = $('#tabel_perawat').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url('ajax_request/perawat') }}',
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) +
                            '</p>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_jabatan',
                    name: 'nama_jabatan',
                    render(data, type, row) {
                        return '<p class="text-center">' + data + '</p>';
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render(data, type, row) {
                        fungsi_set = 'set_perawat(' + "'" + data + "','" + row.nama + "','" + row
                            .nama_jabatan + "'" + ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set +
                            '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function open_modal_instrumen(sts) {
        get_instrumen();
        sts_instrumen = sts;
        $('#modal_instrumen').modal('show');
    }

    function set_instrumen(id, nama) {
        if (sts_instrumen === "instrumen") {
            $('#instrumen').val(nama);
            $('#id_instrumen').val(id);
        }
        // else if (sts_instrumen === "penata_anastesi") {
        //     $('#penata_anastesi').val(nama);
        //     $('#id_penata_anastesi').val(id);
        // }

        $('#modal_instrumen').modal('hide');
    }

    function open_modal_perawat(sts) {
        get_perawat();
        sts_perawat = sts;
        $('#modal_perawat').modal('show');
    }

    function set_perawat(id, nama) {
        if (sts_perawat === "perawat") {
            $('#perawat').val(nama);
            $('#id_perawat').val(id);
        } else if (sts_perawat === "perawat_masuk_rr") {
            $('#perawat_masuk_rr').val(nama);
            $('#id_perawat_masuk_rr').val(id);
        } else if (sts_perawat === "perawat_keluar_rr") {
            $('#perawat_keluar_rr').val(nama);
            $('#id_perawat_keluar_rr').val(id);
        } else if (sts_perawat === "perawat_penerima") {
            $('#perawat_penerima').val(nama);
            $('#id_perawat_penerima').val(id);
        } else if (sts_perawat === "penata_anastesi") {
            $('#penata_anastesi').val(nama);
            $('#id_penata_anastesi').val(id);
        }

        $('#modal_perawat').modal('hide');
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        var catatan = [];
        if ($('#pra_anastesi').is(":checked")) {
            catatan.push('pra_anastesi');
        }
        if ($('#perubahan_rencana').is(":checked")) {
            catatan.push('perubahan_rencana');
        }
        if ($('#tunda').is(":checked")) {
            catatan.push('tunda');
        }

        let status_fisik_asa = [];

        if ($('#status_fisik_1').is(':checked')) {
            status_fisik_asa.push($('#status_fisik_1').val());
        }

        if ($('#status_fisik_2').is(':checked')) {
            status_fisik_asa.push($('#status_fisik_2').val());
        }

        if ($('#status_fisik_3').is(':checked')) {
            status_fisik_asa.push($('#status_fisik_3').val());
        }

        if ($('#status_fisik_4').is(':checked')) {
            status_fisik_asa.push($('#status_fisik_4').val());
        }

        if ($('#status_fisik_5').is(':checked')) {
            status_fisik_asa.push($('#status_fisik_5').val());
        }

        if ($('#status_fisik_e').is(':checked')) {
            status_fisik_asa.push($('#status_fisik_e').val());
        }

        var regional = [];
        if ($('#spinal').is(":checked")) {
            regional.push('spinal');
        }
        if ($('#epidural').is(":checked")) {
            regional.push('epidural');
        }
        if ($('#blok').is(":checked")) {
            regional.push('blok');
        }

        var tiva = [];
        if ($('#iya').is(":checked")) {
            tiva.push('iya');
        }
        if ($('#tidak').is(":checked")) {
            tiva.push('tidak');
        }

        $('#hide_regional').val(JSON.stringify(regional));
        $('#hide_tiva').val(JSON.stringify(tiva));
        $('#hide_isian_satu').val(JSON.stringify(isian_satu));
        $('#hide_isian_dua').val(JSON.stringify(isian_dua));
        $('#hide_maintenance').val($('[name=radio_maintenance]:checked').val() != undefined ? $(
            '[name=radio_maintenance]:checked').val() : '');
        $('#hide_status_fisik_asa').val(JSON.stringify(status_fisik_asa));
        $('#hide_id_d_anastesi').val($('#id_d_anastesi').val());
        $('#hide_d_anastesi').val($('#d_anastesi').val());
        $('#hide_id_perawat').val($('#id_perawat').val());
        $('#hide_perawat').val($('#perawat').val());
        $('#hide_id_instrumen').val($('#id_instrumen').val());
        $('#hide_instrumen').val($('#instrumen').val());
        $('#hide_diagnosa_pre_op').val($('#diagnosa_pre_op').val());
        $('#hide_diagnosa_post_op').val($('#diagnosa_post_op').val());
        $('#hide_tindakan').val($('#tindakan').val());
        $('#hide_jenis_anastesi').val($('[name="radio_jenis_anastesi"]:checked').val());
        $('#hide_resiko_anastesi').val($('[name="radio_resiko_anastesi"]:checked').val());
        $('#hide_tb_pre').val($('#tb_pre').val());
        $('#hide_bb_pre').val($('#bb_pre').val());
        $('#hide_td').val($('#td').val());
        $('#hide_hb').val($('#hb').val());
        $('#hide_nadi').val($('#nadi').val());
        $('#hide_ht').val($('#ht').val());
        $('#hide_suhu').val($('#suhu').val());
        $('#hide_gol_darah').val($('#gol_darah').val());
        $('#hide_gcs_e').val($('#gcs_e').val());
        $('#hide_gcs_m').val($('#gcs_m').val());
        $('#hide_gcs_v').val($('#gcs_v').val());
        $('#hide_pramedikasi').val($('#pramedikasi').val());
        $('#hide_profol').val($('#profol').val());
        $('#hide_midazolam').val($('#midazolam').val());
        $('#hide_rl').val($('#rl').val());
        $('#hide_fentanyl').val($('#fentanyl').val());
        $('#hide_medikasi1').val($('#medikasi1').val());
        $('#hide_det_medikasi1').val($('#det_medikasi1').val());
        $('#hide_pethidin').val($('#pethidin').val());
        $('#hide_medikasi2').val($('#medikasi2').val());
        $('#hide_det_medikasi2').val($('#det_medikasi2').val());
        $('#hide_atrakurium').val($('#atrakurium').val());
        $('#hide_sa').val($('#sa').val());
        $('#hide_urine').val($('#urine').val());
        $('#hide_buvupacaine').val($('#buvupacaine').val());
        $('#hide_cm_satu').val($('#cm_satu').val());
        $('#hide_cm_dua').val($('#cm_dua').val());
        $('#hide_jm_satu').val($('#jm_satu').val());
        $('#hide_jm_dua').val($('#jm_dua').val());
        $('#hide_jm_tiga').val($('#jm_tiga').val());
        $('#hide_jm_empat').val($('#jm_empat').val());
        $('#hide_jm_lima').val($('#jm_lima').val());
        $('#hide_jm_enam').val($('#jm_enam').val());
        $('#hide_jm_tujuh').val($('#jm_tujuh').val());
        $('#hide_jm_delapan').val($('#jm_delapan').val());
        $('#hide_jm_sembilan').val($('#jm_sembilan').val());
        $('#hide_jm_sepuluh').val($('#jm_sepuluh').val());

        $('#hide_pendarahan').val($('#pendarahan').val());
        $('#hide_ngt').val($('#ngt').val());
        $('#hide_catatan').val(JSON.stringify(catatan));
        $('#hide_ket_tunda').val($('#ket_tunda').val());
        // $('#hide_regional').val($('[name="radio_regional"]:checked').val());
        $('#hide_induksi').val($('[name="radio_induksi"]:checked').val());
        // $('#hide_tiva').val($('[name="radio_tiva"]:checked').val());
        $('#hide_inhalasi').val($('[name="radio_inhalasi"]:checked').val());
        $('#hide_ett_lma').val($('[name="radio_ett_lma"]:checked').val());
        $('#hide_ket_ett_lma').val($('#ket_ett_lma').val());
        $('#hide_masker').val($('[name="radio_masker"]:checked').val());
        $('#hide_maintance').val($('[name="radio_maintance"]:checked').val());
        $('#hide_jam_anastesi').val($('#jam_anastesi').val());
        $('#hide_spo1').val($('#spo1').val());
        $('#hide_spo2').val($('#spo2').val());
        $('#hide_spo3').val($('#spo3').val());
        $('#hide_spo4').val($('#spo4').val());
        $('#hide_waktu_anastesi').val($('#waktu_anastesi').val());
        $('#hide_selesai_anastesi').val($('#selesai_anastesi').val());
        $('#hide_pasien_masuk_rr').val($('#pasien_masuk_rr').val());
        $('#hide_id_perawat_masuk_rr').val($('#id_perawat_masuk_rr').val());
        $('#hide_perawat_masuk_rr').val($('#perawat_masuk_rr').val());
        $('#hide_id_penata_anastesi').val($('#id_penata_anastesi').val());
        $('#hide_penata_anastesi').val($('#penata_anastesi').val());
        $('#hide_jam_anastesi2').val($('#jam_anastesi2').val());
        $('#hide_pasien_keluar_rr').val($('#pasien_keluar_rr').val());
        $('#hide_keluar_rr').val($('#keluar_rr').val());
        $('#hide_id_perawat_keluar_rr').val($('#id_perawat_keluar_rr').val());
        $('#hide_perawat_keluar_rr').val($('#perawat_keluar_rr').val());
        $('#hide_id_perawat_penerima').val($('#id_perawat_penerima').val());
        $('#hide_perawat_penerima').val($('#perawat_penerima').val());
        $('#hide_aktivitas_motorik_masuk').val($('#aktivitas_motorik_masuk').val());
        $('#hide_aktivitas_motorik_keluar').val($('#aktivitas_motorik_keluar').val());
        $('#hide_respirasi_masuk').val($('#respirasi_masuk').val());
        $('#hide_respirasi_keluar').val($('#respirasi_keluar').val());
        $('#hide_sirkulasi_masuk').val($('#sirkulasi_masuk').val());
        $('#hide_sirkulasi_keluar').val($('#sirkulasi_keluar').val());
        $('#hide_kesadaran_masuk').val($('#kesadaran_masuk').val());
        $('#hide_kesadaran_keluar').val($('#kesadaran_keluar').val());
        $('#hide_warna_kulit_masuk').val($('#warna_kulit_masuk').val());
        $('#hide_warna_kulit_keluar').val($('#warna_kulit_keluar').val());
        $('#hide_bromage_masuk').val($('#bromage_masuk').val());
        $('#hide_bromage_keluar').val($('#bromage_keluar').val());
        $('#hide_kesadaran_steward_masuk').val($('#kesadaran_steward_masuk').val());
        $('#hide_kesadaran_steward_keluar').val($('#kesadaran_steward_keluar').val());
        $('#hide_respirasi_steward_masuk').val($('#respirasi_steward_masuk').val());
        $('#hide_respirasi_steward_keluar').val($('#respirasi_steward_keluar').val());
        $('#hide_aktifitas_motorik_steward_masuk').val($('#aktifitas_motorik_steward_masuk').val());
        $('#hide_aktifitas_motorik_steward_keluar').val($('#aktifitas_motorik_steward_keluar').val());
        $('#hide_gambar1').val(signaturePad1.toDataURL());
        $('#hide_gambar2').val(signaturePad2.toDataURL());
        return true;
    }

    function cek_radio_fasilitas() {
        if ($('[name="radio_fasilitas"]:checked').val() == 'lain_lain') {
            $('#ket_fasilitas_transfer').removeAttr('readonly');
        } else {
            $('#ket_fasilitas_transfer').attr('readonly', true);
            $('#ket_fasilitas_transfer').val('');
        }
    }

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }

    function open_form_tambah_diagnosa(tipe) {
        if (tipe == 'prabedah') {
            $("#prabedah").removeAttr('hidden');
            $("#pascabedah").prop('hidden', true);
        } else if (tipe == 'pascabedah') {
            $("#prabedah").prop('hidden', true);
            $("#pascabedah").removeAttr('hidden');
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
                    $('#diagnosa_pra_bedah').val(response.diagnosa_pra_bedah);
                    $('#diagnosa_pasca_bedah').val(response.diagnosa_pasca_bedah);
                }
                $('#modal_tambah_diagnosa').modal('show');
            }
        })

        $("#diagnosa_pra_bedah").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function(suggestion) {
                $("#diagnosa_pra_bedah").val(suggestion.nama);
            }
        });

        $("#diagnosa_pasca_bedah").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function(suggestion) {
                $("#diagnosa_pasca_bedah").val(suggestion.nama);
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
        // if ($('#diagnosa_primer').val() == '') {
        //     alert('Pilih diagnosa utama dahulu');
        //     return;
        // }
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
                    var pra = '';
                    var pasca = '';
                    if (response.kode_diagnosa_pra_bedah) {
                        pra = response.kode_diagnosa_pra_bedah.icd;
                    }

                    if (response.kode_diagnosa_pasca_bedah) {
                        pasca = response.kode_diagnosa_pasca_bedah.icd;
                    }

                    $('#box_diagnosa').html(pra + ' - ' + data.diagnosa_pra_bedah);
                    $('#box_diagnosa2').html(pasca + ' - ' + data.diagnosa_pasca_bedah);
                    $('#box_btn_asesmen').html(
                        '<button class="btn btn-warning" onclick="open_form_tambah_diagnosa(`prabedah`)" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>'
                    );
                    $('#box_btn_asesmen2').html(
                        '<button class="btn btn-warning" onclick="open_form_tambah_diagnosa(`pascabedah`)" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>'
                    );
                }
                $('#btn_simpan_diagnosa').removeAttr('disabled');
                $('#box_msg').html('');
                $('#modal_tambah_diagnosa').modal('hide');
            }
        })
    }

    function perhitungan_lama() {
        if ($("#selesai").val() <= $("#mulai").val()) {
            alert("Waktu selesai harus lebih besar dari waktu mulai !!!")
            $("#selesai").val("");
        } else {
            var time1 = $("#mulai").val().split(':'),
                time2 = $("#selesai").val().split(':');
            var hours1 = parseInt(time1[0], 10),
                hours2 = parseInt(time2[0], 10),
                mins1 = parseInt(time1[1], 10),
                mins2 = parseInt(time2[1], 10);
            var hours = hours2 - hours1,
                mins = 0;

            // get hours
            if (hours < 0) hours = 24 + hours;

            // get minutes
            if (mins2 >= mins1) {
                mins = mins2 - mins1;
            } else {
                mins = (mins2 + 60) - mins1;
                hours--;
            }

            // convert to fraction of 60
            mins = mins / 60;

            hours += mins;
            hours = hours.toFixed(2);
            var tmp_hours = hours.split(".");
            var menit = "";
            if (tmp_hours[1] != 0) {
                menit = tmp_hours[1] + " Menit";
            }
            $("#lama_pembedahan").val(tmp_hours[0] + " Jam " + menit);
        }
    }

    function cek_sbu_sayat() {
        if ($("#sbu_sayat").prop('checked') == true) {
            $('[name="radio_air_ketuban"]').removeAttr('disabled');
            $('#jumlah_air_ketuban').removeAttr('readonly');
        } else {
            $('[name="radio_air_ketuban"]').removeAttr('disabled');
            $('#jumlah_air_ketuban').removeAttr('readonly');
        }
    }

    function cek_bayi() {
        if ($("#bayi").prop('checked') == true) {
            $('[name="radio_bayi"]').removeAttr('disabled');
            $('[name="radio_kelamin"]').removeAttr('disabled');
            $('#bb1').removeAttr('readonly');
            $('#pb1').removeAttr('readonly');
            $('#as1').removeAttr('readonly');
        } else {
            $('[name="radio_bayi"]').attr('disabled', true);
            $('[name="radio_kelamin"]').attr('disabled', true);
            $('#bb1').attr('readonly', true);
            $('#pb1').attr('readonly', true);
            $('#as1').attr('readonly', true);
            $('#bb1').val('');
            $('#pb1').val('');
            $('#as1').val('');
        }
    }

    function cek_plasenta() {
        if ($("#plasenta").prop('checked') == true) {
            $('#ket_plasenta').removeAttr('readonly');
            $('#lahir_dengan').removeAttr('readonly');
            $('#kelainan').removeAttr('readonly');
        } else {
            $('#ket_plasenta').attr('readonly', true);
            $('#lahir_dengan').attr('readonly', true);
            $('#kelainan').attr('readonly', true);
            $('#ket_plasenta').val('');
            $('#lahir_dengan').val('');
            $('#kelainan').val('');
        }
    }

    function cek_sbu_jahit() {
        if ($("#sbu_jahit").prop('checked') == true) {
            $("#ket_sbu_jahit").removeAttr("readonly");
        } else {
            $("#ket_sbu_jahit").attr("readonly", true);
            $("#ket_sbu_jahit").val();
        }
    }

    function cek_tubae() {
        if ($("#tubae").prop('checked') == true) {
            $('[name="radio_tubae"]').removeAttr('disabled');
            $('[name="radio_ovarium_kiri"]').removeAttr('disabled');
            $('[name="radio_ovarium_kanan"]').removeAttr('disabled');
        } else {
            $('[name="radio_tubae"]').attr('disabled', true);
            $('[name="radio_ovarium_kiri"]').attr('disabled', true);
            $('[name="radio_ovarium_kanan"]').attr('disabled', true);
        }
    }

    function cek_jumlah() {
        if ($("#jumlah").prop('checked') == true) {
            $('[name="radio_jumlah"]').removeAttr('disabled');
            $('[name="radio_det_jumlah"]').removeAttr('disabled');
            $('#ket_jumlah').removeAttr('readonly');
        } else {
            $('[name="radio_jumlah"]').attr('disabled', true);
            $('[name="radio_det_jumlah"]').attr('disabled', true);
            $('#ket_jumlah').attr('readonly', true);
            $('#ket_jumlah').val('');
        }
    }

    function cek_tunda() {
        if ($("#tunda").prop('checked') == true) {
            $('#ket_tunda').removeAttr('readonly');
        } else {
            $('#ket_tunda').attr('readonly', true);
            $('#ket_tunda').val('');
        }
    }
</script>

</html>