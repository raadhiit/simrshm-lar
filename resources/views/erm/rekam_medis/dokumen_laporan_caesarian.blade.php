<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Section Caesarian</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
      action="{{ url('e_rekam_medis/rekam_medis/save_dokumen_laporan_caesarian') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" id="hide_id_d_operator" name="id_d_operator">
    <input type="hidden" id="hide_d_operator" name="d_operator">
    <input type="hidden" id="hide_id_a_operator" name="id_a_operator">
    <input type="hidden" id="hide_a_operator" name="a_operator">
    <input type="hidden" id="hide_id_instrumen" name="id_instrumen">
    <input type="hidden" id="hide_instrumen" name="instrumen">
    <input type="hidden" id="hide_id_d_anastesi" name="id_d_anastesi">
    <input type="hidden" id="hide_d_anastesi" name="d_anastesi">
    <input type="hidden" id="hide_id_a_anastesi" name="id_a_anastesi">
    <input type="hidden" id="hide_a_anastesi" name="a_anastesi">
    <input type="hidden" id="hide_jenis_anastesi" name="jenis_anastesi">
    <input type="hidden" id="hide_tindakan" name="tindakan">
    <input type="hidden" id="hide_indikasi_operasi" name="indikasi_operasi">
    <input type="hidden" id="hide_posisi" name="posisi">
    <input type="hidden" id="hide_jenis_pembedahan" name="jenis_pembedahan">
    <input type="hidden" id="hide_jenis_pembedahan2" name="jenis_pembedahan2">
    <input type="hidden" id="hide_jenis_luka_operasi" name="jenis_luka_operasi">
    <input type="hidden" id="hide_tanggal" name="tanggal">
    <input type="hidden" id="hide_mulai" name="mulai">
    <input type="hidden" id="hide_selesai" name="selesai">
    <input type="hidden" id="hide_lama_pembedahan" name="lama_pembedahan">
    <input type="hidden" id="hide_catatan" name="catatan">
    <input type="hidden" id="hide_air_ketuban" name="air_ketuban">
    <input type="hidden" id="hide_jumlah_air_ketuban" name="jumlah_air_ketuban">
    <input type="hidden" id="hide_bayi" name="bayi">
    <input type="hidden" id="hide_bb1" name="bb1">
    <input type="hidden" id="hide_pb1" name="pb1">
    <input type="hidden" id="hide_as1" name="as1">
    <input type="hidden" id="hide_kelamin1" name="kelamin1">
    <input type="hidden" id="hide_ket_plasenta" name="ket_plasenta">
    <input type="hidden" id="hide_lahir_dengan" name="lahir_dengan">
    <input type="hidden" id="hide_kelainan" name="kelainan">
    <input type="hidden" id="hide_ket_sbu_jahit" name="ket_sbu_jahit">
    <input type="hidden" id="hide_tubae" name="tubae">
    <input type="hidden" id="hide_ovarium_kiri" name="ovarium_kiri">
    <input type="hidden" id="hide_ovarium_kanan" name="ovarium_kanan">
    <input type="hidden" id="hide_jumlah" name="jumlah">
    <input type="hidden" id="hide_det_jumlah" name="det_jumlah">
    <input type="hidden" id="hide_ket_jumlah" name="ket_jumlah">
    <input type="hidden" id="hide_ket_pendarahan" name="ket_pendarahan">
    <input type="hidden" id="hide_no_batch" name="no_batch">
    <input type="hidden" id="hide_komplikasi" name="komplikasi">
    <input type="hidden" id="hide_pendarahan" name="pendarahan">
    <input type="hidden" id="hide_dikirim_pa" name="dikirim_pa">
    <input type="hidden" id="hide_asal_jaringan" name="asal_jaringan">
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
            <h6 style="color: white">LAPORAN SECTION CAESARIAN</h6>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%" class="table_isian">
            <tr>
                <td style="padding: 10px; text-align: center">
                    Dokter Operator :
                    <div class="input-group">
                        <input type="text" hidden id="id_d_operator">
                        <input type="text" readonly
                               value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->d_operator : ''}}"
                               id="d_operator" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_yth('d_operator')"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
                <td style="padding: 10px; text-align: center">
                    Asisten Operator :
                    <div class="input-group">
                        <input type="text" hidden id="id_a_operator">
                        <input type="text" readonly
                               value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->a_operator : ''}}"
                               id="a_operator" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_yth('a_operator')"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
                <td style="padding: 10px; text-align: center">
                    Instrumen :
                    <div class="input-group">
                        <input type="text" hidden id="id_instrumen">
                        <input type="text" readonly
                               value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->instrumen : ''}}"
                               id="instrumen" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_instrumen()"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align: center">
                    Spesialis Anastesi :
                    <div class="input-group">
                        <input type="text" hidden id="id_d_anastesi">
                        <input type="text" readonly
                               value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->d_anastesi : ''}}"
                               id="d_anastesi" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_yth('d_anastesi')"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
                <td style="padding: 10px; text-align: center">
                    Asisten Anastesi :
                    <div class="input-group">
                        <input type="text" hidden id="id_a_anastesi">
                        <input type="text" readonly
                               value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->a_anastesi : ''}}"
                               id="a_anastesi" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_yth('a_anastesi')"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
                <td style="padding: 10px; text-align: center">
                    Jenis Anastesi :
                    <div class="input-group">
                        <select id="jenis_anastesi" class="form-control" style="width: 15%;">
                            <option value="" selected disabled>Pilih Jenis Anastesi</option>
                            <option @if(old('jenis_anastesi'))
                                        {{ old('jenis_anastesi') == "lokal" ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_laporan_caesarian))
                                        {{ $dokumen->dokumen_laporan_caesarian->jenis_anastesi == "lokal" ? 'selected' : '' }}
                                    @endif value="lokal">Lokal
                            </option>
                            <option @if(old('jenis_anastesi'))
                                        {{ old('jenis_anastesi') == "general" ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_laporan_caesarian))
                                        {{ $dokumen->dokumen_laporan_caesarian->jenis_anastesi == "general" ? 'selected' : '' }}
                                    @endif value="general">Regional/General
                            </option>
                        </select>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%;" class="table_isian2">
            <tr>
                <td style="width: 20%">
                    Diagnosis Pra Bedah <span style="float: right">:</span>
                </td>
                <td colspan="3" style="padding-left: 10px">
                    <div style="display: flex; flex-direction: row" class="pt-3">
                        <div id="box_btn_asesmen">
                            @if ($layanan->diagnosa == null)
                                <button class="btn btn-success" onclick="open_form_tambah_diagnosa('prabedah')"><i
                                        class="fa fa-plus"></i></button>
                            @else
                                <button class="btn btn-warning" onclick="open_form_tambah_diagnosa('prabedah')"
                                        style="color:#fff; font-weight: bold;"><i
                                        class="fa fa-pencil"></i></button>
                            @endif
                        </div>
                        <div id="box_diagnosa" class="ml-2">
                            {{ $layanan->diagnosa && isset($kode_diagnosa_pra_bedah) ? $kode_diagnosa_pra_bedah->icd . ' - ' . $layanan->diagnosa->diagnosa_pra_bedah : '' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    Diagnosis Pasca Bedah <span style="float: right">:</span>
                </td>
                <td colspan="3" style="padding-left: 10px">
                    <div style="display: flex; flex-direction: row" class="pt-3">
                        <div id="box_btn_asesmen2">
                            @if ($layanan->diagnosa == null)
                                <button class="btn btn-success" onclick="open_form_tambah_diagnosa('pascabedah')"><i
                                        class="fa fa-plus"></i></button>
                            @else
                                <button class="btn btn-warning" onclick="open_form_tambah_diagnosa('pascabedah')"
                                        style="color:#fff; font-weight: bold;"><i
                                        class="fa fa-pencil"></i></button>
                            @endif
                        </div>
                        <div id="box_diagnosa2" class="ml-2">
                            {{ $layanan->diagnosa && isset($kode_diagnosa_pasca_bedah) ? $kode_diagnosa_pasca_bedah->icd . ' - ' . $layanan->diagnosa->diagnosa_pasca_bedah : '' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    Tindakan <span style="float: right">:</span>
                </td>
                <td colspan="3" style="padding-left: 10px">
                    <input type="text" id="tindakan" class="form-control"
                           value="@if(old('tindakan')){{ old('tindakan') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->tindakan : '' }}@endif">
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    Indikasi Operasi <span style="float: right">:</span>
                </td>
                <td style="padding-left: 10px; width: 40%; border-right: 1px solid">
                    <input type="text" id="indikasi_operasi" class="form-control"
                           value="@if(old('indikasi_operasi')){{ old('indikasi_operasi') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->indikasi_operasi : '' }}@endif">
                </td>
                <td colspan="2" style="width: 40%">
                    <div class="row">
                        <div class="col-md-3" style="padding-left: 20px">
                            Posisi <span style="float: right">:</span>
                        </div>
                        <div class="col-md-3">
                            <input @if(old('posisi'))
                                       {{ old('posisi') ==  'supine' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->posisi == 'supine' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="supine" name="radio_posisi"> Supine
                        </div>
                        <div class="col-md-3">
                            <input @if(old('posisi'))
                                       {{ old('posisi') ==  'tiring' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->posisi == 'tiring' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tiring" name="radio_posisi"> Tiring
                        </div>
                        <div class="col-md-3">
                            <input @if(old('posisi'))
                                       {{ old('posisi') ==  'tengkurap' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->posisi == 'tengkurap' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tengkurap" name="radio_posisi"> Tengkurap
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    Jenis Pembedahan <span style="float: right">:</span>
                </td>
                <td style="padding-left: 10px; width: 40%; border-right: 1px solid">
                    <div class="row">
                        <div class="col-md-3">
                            <input @if(old('jenis_pembedahan'))
                                       {{ old('jenis_pembedahan') ==  'khusus' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'khusus' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="khusus" name="radio_jenis_pembedahan"> Khusus
                        </div>
                        <div class="col-md-3">
                            <input @if(old('jenis_pembedahan'))
                                       {{ old('jenis_pembedahan') ==  'besar' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'besar' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="besar" name="radio_jenis_pembedahan"> Besar
                        </div>
                        <div class="col-md-3">
                            <input @if(old('jenis_pembedahan'))
                                       {{ old('jenis_pembedahan') ==  'sedang' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'sedang' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="sedang" name="radio_jenis_pembedahan"> Sedang
                        </div>
                        <div class="col-md-3">
                            <input @if(old('jenis_pembedahan'))
                                       {{ old('jenis_pembedahan') ==  'kecil' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan == 'kecil' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="kecil" name="radio_jenis_pembedahan"> Kecil
                        </div>
                    </div>
                </td>
                <td colspan="2" style="width: 40%">
                    <div class="row">
                        <div class="col-md-6">
                            <input @if(old('jenis_pembedahan2'))
                                       {{ old('jenis_pembedahan2') ==  'supine' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan2 == 'terencana' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="terencana" name="radio_jenis_pembedahan2"> Terencana
                        </div>
                        <div class="col-md-6">
                            <input @if(old('jenis_pembedahan2'))
                                       {{ old('jenis_pembedahan2') ==  'tiring' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_pembedahan2 == 'gawat' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="gawat" name="radio_jenis_pembedahan2"> Gawat Darurat
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    Jenis Luka Operasi <span style="float: right">:</span>
                </td>
                <td colspan="3" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-3">
                            <label>
                                <input @if(old('jenis_luka_operasi'))
                                           {{ old('jenis_luka_operasi') ==  'bersih' ? 'checked' : '' }}
                                       @else
                                           {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'bersih' ? 'checked' : '') : '' }}
                                       @endif
                                       type="radio" value="bersih" name="radio_jenis_luka_operasi">
                            </label> Bersih
                        </div>
                        <div class="col-md-3">
                            <input @if(old('jenis_luka_operasi'))
                                       {{ old('jenis_luka_operasi') ==  'bersih_terkontaminasi' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'bersih_terkontaminasi' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="bersih_terkontaminasi" name="radio_jenis_luka_operasi"> Bersih
                            Terkontaminasi
                        </div>
                        <div class="col-md-3">
                            <input @if(old('jenis_luka_operasi'))
                                       {{ old('jenis_luka_operasi') ==  'terkontaminasi' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'terkontaminasi' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="terkontaminasi" name="radio_jenis_luka_operasi"> Terkontaminasi
                        </div>
                        <div class="col-md-3">
                            <input @if(old('jenis_luka_operasi'))
                                       {{ old('jenis_luka_operasi') ==  'terinfeksi' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jenis_luka_operasi == 'terinfeksi' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="terinfeksi" name="radio_jenis_luka_operasi"> Kotor/Terinfeksi
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3" style="border-right: 1px solid">
                            Tanggal :
                            <input type="date" class="form-control" id="tanggal"
                                   value="@if(old('tanggal')){{ old('tanggal') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->tanggal : '' }}@endif">
                        </div>
                        <div class="col-md-3" style="border-right: 1px solid">
                            Mulai :
                            <input type="time" class="form-control" id="mulai" onchange="perhitungan_lama()"
                                   value="@if(old('mulai')){{ old('mulai') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->mulai : '' }}@endif">
                        </div>
                        <div class="col-md-3" style="border-right: 1px solid">
                            Selesai :
                            <input type="time" class="form-control" id="selesai" onchange="perhitungan_lama()"
                                   value="@if(old('selesai')){{ old('selesai') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->selesai : '' }}@endif">
                        </div>
                        <div class="col-md-3">
                            Lama Pembedahan :
                            <input type="text" class="form-control" id="lama_pembedahan" readonly
                                   value="@if(old('lama_pembedahan')){{ old('lama_pembedahan') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->lama_pembedahan : '' }}@endif">
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border-left: 1px solid; border-right: 1px solid">
        <div class="col-md-12">
            (Centang yang diperlukan *)
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid; padding-bottom: 10px">
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('antisepsis',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif id="antisepsis">
            A dan anti sepsis
        </div>
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('insisi',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif id="insisi">
            Insisi
        </div>
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('peritonium',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="peritonium">
            Setelah peritonium di buka uterus membesar sesuai kehamilan
        </div>
        <div class="col-md-12">
            <input type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('plika',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="plika">
            Plika Vesika uterina disayat semilunar, kandung kencing disisihkan kebawah.
        </div>
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_sbu_sayat()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('sbu_sayat',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="sbu_sayat">
            SBU disayat semilunar, air ketuban
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'jernih' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'jernih' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="jernih" name="radio_air_ketuban" disabled> Jernih
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'putih_keruh' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'putih_keruh' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="putih_keruh" name="radio_air_ketuban" disabled> Putih Keruh
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'hijau_encer' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'hijau_encer' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="hijau_encer" name="radio_air_ketuban" disabled> Hijau Encer
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'hijau_kental' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'hijau_kental' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="hijau_kental" name="radio_air_ketuban" disabled> Hijau Kental
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'berbau' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'berbau' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="berbau" name="radio_air_ketuban" disabled> Berbau
            <input @if(old('air_ketuban'))
                       {{ old('air_ketuban') ==  'tidak_berbau' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->air_ketuban == 'tidak_berbau' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="tidak_berbau" name="radio_air_ketuban" disabled> Tidak Berbau, jumlah :
            <input type="text" id="jumlah_air_ketuban" readonly
                   value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->jumlah_air_ketuban : '' }}"
                   style="border: hidden" placeholder="................................................"> ml
        </div>
        <div class="col-md-12">
            <input onchange="cek_bayi()" type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('bayi',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif id="bayi">
            Bayi
            <input @if(old('bayi'))
                       {{ old('bayi') ==  'tunggal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->bayi == 'tunggal' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="tunggal" name="radio_bayi" disabled> Tunggal /
            <input @if(old('bayi'))
                       {{ old('bayi') ==  'gemelli' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->bayi == 'gemelli' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="gemelli" name="radio_bayi" disabled> Gemelli, dilahirkan dengan :
            <div class="row">
                <div class="col-md-3">
                    BB :
                    <input type="number" readonly
                           value="@if(old('bb1')){{ old('bb1') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->bb1 : '' }}@endif"
                           id="bb1" style="border: 0; border-bottom: 2px dotted;"> gram
                </div>
                <div class="col-md-3">
                    PB :
                    <input type="number" readonly
                           value="@if(old('pb1')){{ old('pb1') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->pb1 : '' }}@endif"
                           id="pb1" style="border: 0; border-bottom: 2px dotted;"> cm
                </div>
                <div class="col-md-3">
                    AS :
                    <input type="number" readonly
                           value="@if(old('as1')){{ old('as1') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->as1 : '' }}@endif"
                           id="as1" style="border: 0; border-bottom: 2px dotted;">,
                </div>
                <div class="col-md-3">
                    Kelamin :
                    <input @if(old('kelamin1'))
                               {{ old('kelamin1') ==  'laki_laki' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->kelamin1 == 'laki_laki' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="laki_laki" name="radio_kelamin" disabled> Laki-laki
                    <input @if(old('kelamin1'))
                               {{ old('kelamin1') ==  'perempuan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->kelamin1 == 'perempuan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="perempuan" name="radio_kelamin" disabled> Perempuan
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <input onchange="cek_plasenta()" type="checkbox" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('plasenta',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="plasenta">
            Plasenta berinplantasi di :
            <input type="text" readonly
                   value="@if(old('ket_plasenta')){{ old('ket_plasenta') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_plasenta : '' }}@endif"
                   id="ket_plasenta" style="border: 0; border-bottom: 2px dotted;">
            <br>
            <span style="margin-left: 19px">Lahir dengan :</span>
            <input type="text" readonly
                   value="@if(old('lahir_dengan')){{ old('lahir_dengan') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->lahir_dengan : '' }}@endif"
                   id="lahir_dengan" style="border: 0; border-bottom: 2px dotted;">
            <br>
            <span style="margin-left: 19px">Keadaan / Kelainan :</span>
            <input type="text" readonly
                   value="@if(old('kelainan')){{ old('kelainan') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->kelainan : '' }}@endif"
                   id="kelainan" style="border: 0; border-bottom: 2px dotted;">
        </div>
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_sbu_jahit()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('sbu_jahit',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="sbu_jahit">
            SBU dijahit 1 lapis / 2 lapis dengan :
            <input type="text" readonly
                   value="@if(old('ket_sbu_jahit')){{ old('ket_sbu_jahit') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_sbu_jahit : '' }}@endif"
                   id="ket_sbu_jahit" style="border: 0; border-bottom: 2px dotted;">
            <br>
            <span style="margin-left: 19px">Setelah diyakinkan tidak ada pendarahan, rongga abdomen di tutup lapis demi lapis dengan/tanpa meninggalkan Dextran 70/NaCL</span>
        </div>
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_tubae()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('tubae',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="tubae">
            Ke dua tubae <span style="padding-left: 40px">:</span>
            <input @if(old('tubae'))
                       {{ old('tubae') ==  'normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->tubae == 'normal' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="normal" name="radio_tubae" disabled> Normal /
            <input @if(old('tubae'))
                       {{ old('tubae') ==  'tidak_normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->tubae == 'tidak_normal' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="tidak_normal" name="radio_tubae" disabled> Tidak Normal
            <br>
            <span style="padding-left: 18px">Ovarium Kiri</span> <span style="padding-left: 45px">:</span>
            <input @if(old('ovarium_kiri'))
                       {{ old('ovarium_kiri') ==  'normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kiri == 'normal' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="normal" name="radio_ovarium_kiri" disabled> Normal /
            <input @if(old('ovarium_kiri'))
                       {{ old('ovarium_kiri') ==  'tidak_normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kiri == 'tidak_normal' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="tidak_normal" name="radio_ovarium_kiri" disabled> Tidak Normal
            <br>
            <span style="padding-left: 18px">Ovarium Kanan</span> <span style="padding-left: 25px">:</span>
            <input @if(old('ovarium_kanan'))
                       {{ old('ovarium_kanan') ==  'normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kanan == 'normal' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="normal" name="radio_ovarium_kanan" disabled> Normal /
            <input @if(old('ovarium_kanan'))
                       {{ old('ovarium_kanan') ==  'tidak_normal' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->ovarium_kanan == 'tidak_normal' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="tidak_normal" name="radio_ovarium_kanan" disabled> Tidak Normal
        </div>
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_jumlah()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('jumlah',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="jumlah">
            Jumlah
            <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'depper' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'depper' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="depper" name="radio_jumlah" disabled> depper /
            <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'kassa' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'kassa' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="kassa" name="radio_jumlah" disabled> kassa /
            <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'bendera' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'bendera' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="bendera" name="radio_jumlah" disabled> bendera /
            <input @if(old('jumlah'))
                       {{ old('jumlah') ==  'kassa_gulung' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->jumlah == 'kassa_gulung' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="kassa_gulung" name="radio_jumlah" disabled> kassa gulung :
            <input @if(old('det_jumlah'))
                       {{ old('det_jumlah') ==  'lengkap' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->det_jumlah == 'lengkap' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="lengkap" name="radio_det_jumlah" disabled> lengkap /
            <input @if(old('det_jumlah'))
                       {{ old('det_jumlah') ==  'kurang' ? 'checked' : '' }}
                   @else
                       {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->det_jumlah == 'kurang' ? 'checked' : '') : '' }}
                   @endif
                   type="radio" value="kurang" name="radio_det_jumlah" disabled> kurang
            <input type="text" id="ket_jumlah" readonly
                   value="{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_jumlah : '' }}"
                   style="border: hidden" placeholder="................................................">
        </div>
        <div class="col-md-12">
            <input type="checkbox" onchange="cek_pendarahan()" @if(isset($dokumen->dokumen_laporan_caesarian))
                {{ in_array('pendarahan',json_decode($dokumen->dokumen_laporan_caesarian->catatan )) ? 'checked' : '' }}
            @endif  id="pendarahan">
            Pendarahan :
            <input type="text" readonly
                   value="@if(old('ket_pendarahan')){{ old('ket_pendarahan') }}@else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->ket_pendarahan : '' }}@endif"
                   id="ket_pendarahan" style="border: 0; border-bottom: 2px dotted;"> ml
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border-width: 0px 1px 1px 1px; border-style: solid;">
        <div class="col-md-8" style="border-right: 1px solid; padding-bottom: 10px; padding-top: 10px">
            <table style="width: 100%">
                <tr>
                    <td style="width: 30%">No. Batch implan</td>
                    <td>:</td>
                    <td>
                        <input type="text" id="no_batch" class="form-control"
                               value="@if(old('no_batch')){{ old('no_batch') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->no_batch : '' }}@endif">
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Komplikasi</td>
                    <td>:</td>
                    <td>
                        <input type="text" id="komplikasi" class="form-control"
                               value="@if(old('komplikasi')){{ old('komplikasi') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->komplikasi : '' }}@endif">
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Pendarahan</td>
                    <td>:</td>
                    <td>
                        <input type="text" id="pendarahan" class="form-control"
                               value="@if(old('pendarahan')){{ old('pendarahan') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->pendarahan : '' }}@endif">
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Dikirim PA</td>
                    <td>:</td>
                    <td>
                        <input @if(old('dikirim_pa'))
                                   {{ old('dikirim_pa') ==  'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->dikirim_pa == 'ya' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="ya" name="radio_dikirim_pa"> Ya
                        <input @if(old('dikirim_pa'))
                                   {{ old('dikirim_pa') ==  'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->dokumen_laporan_caesarian ? ($dokumen->dokumen_laporan_caesarian->dikirim_pa == 'tidak' ? 'checked' : '') : '' }}
                               @endif
                               type="radio" value="tidak" name="radio_dikirim_pa"> Tidak
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">Asal Jaringan</td>
                    <td>:</td>
                    <td>
                        <input type="text" id="asal_jaringan" class="form-control"
                               value="@if(old('asal_jaringan')){{ old('asal_jaringan') }}
                                   @else{{ $dokumen->dokumen_laporan_caesarian ? $dokumen->dokumen_laporan_caesarian->asal_jaringan : '' }}@endif">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 text-center" style="padding-bottom: 10px; padding-top: 10px">
            Dokter Operator
            <br>
            <a @if($dokumen->dokumen_laporan_caesarian)onclick="open_modal_dokter()"@endif href="#"
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
                @endif
            </a>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12 text-center">
        <button onclick="submit_form()" class="btn btn-success">Simpan</button>
    </div>
</div>
<div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/rekam_medis/pdf_dokumen_laporan_caesarian?dokumen='.$dokumen->id) }}"
               class="btn btn-success" target="_blank">Download PDF</a>
        @endif
    </div>
</div>
<div class="modal fade" id="modal_yth" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
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

<div class="modal fade" id="modal_instrumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
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
                    <div id="prabedah">
                        <div class="form-group">
                            <label for="">Diagnosa Pra Bedah</label>
                            <input type="text" class="form-control" name="diagnosa_pra_bedah" id="diagnosa_pra_bedah">
                        </div>
                    </div>
                    <div id="pascabedah" hidden>
                        <div class="form-group">
                            <label for="">Diagnosa Pasca Bedah</label>
                            <input type="text" class="form-control" name="diagnosa_pasca_bedah" id="diagnosa_pasca_bedah">
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

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    var sts_yth = "";
    var table;

    function get_data_dokter(param) {
        table = $('#tabel_kepada').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: param == 'a_operator' || param =='a_anastesi' ? '{{ url("ajax_request/petugas") }}' : '{{ url("ajax_request/dokter") }}',
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</p>';
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
                        fungsi_set = 'set_kepada(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan + "'" + ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function open_modal_yth(sts) {
        get_data_dokter(sts);
        sts_yth = sts;
        $('#modal_yth').modal('show');
    }

    function set_kepada(id, nama) {
        if (sts_yth === "d_operator") {
            $('#d_operator').val(nama);
            $('#id_d_operator').val(id);
            $('#modal_yth').modal('hide');
        } else if (sts_yth === "a_operator") {
            $('#a_operator').val(nama);
            $('#id_a_operator').val(id);
            $('#modal_yth').modal('hide');
        } else if (sts_yth === "d_anastesi") {
            $('#d_anastesi').val(nama);
            $('#id_d_anastesi').val(id);
            $('#modal_yth').modal('hide');
        } else if (sts_yth === "a_anastesi") {
            $('#a_anastesi').val(nama);
            $('#id_a_anastesi').val(id);
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
            ajax: '{{ url("ajax_request/petugas") }}',
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</p>';
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
                        fungsi_set = 'set_instrumen(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function open_modal_instrumen() {
        get_instrumen();
        $('#modal_instrumen').modal('show');
    }

    function set_instrumen(id, nama) {
        $('#instrumen').val(nama);
        $('#id_instrumen').val(id);
        $('#modal_instrumen').modal('hide');
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        var catatan = [];
        if ($('#antisepsis').is(":checked")) {
            catatan.push('antisepsis')
        }
        if ($('#insisi').is(":checked")) {
            catatan.push('insisi')
        }
        if ($('#peritonium').is(":checked")) {
            catatan.push('peritonium')
        }
        if ($('#plika').is(":checked")) {
            catatan.push('plika')
        }
        if ($('#sbu_sayat').is(":checked")) {
            catatan.push('sbu_sayat')
        }
        if ($('#bayi').is(":checked")) {
            catatan.push('bayi')
        }
        if ($('#plasenta').is(":checked")) {
            catatan.push('plasenta')
        }
        if ($('#sbu_jahit').is(":checked")) {
            catatan.push('sbu_jahit')
        }
        if ($('#tubae').is(":checked")) {
            catatan.push('tubae')
        }
        if ($('#jumlah').is(":checked")) {
            catatan.push('jumlah')
        }
        if ($('#pendarahan').is(":checked")) {
            catatan.push('pendarahan')
        }

        $('#hide_id_d_operator').val($('#id_d_operator').val());
        $('#hide_d_operator').val($('#d_operator').val());
        $('#hide_id_a_operator').val($('#id_a_operator').val());
        $('#hide_a_operator').val($('#a_operator').val());
        $('#hide_id_instrumen').val($('#id_instrumen').val());
        $('#hide_instrumen').val($('#instrumen').val());
        $('#hide_id_d_anastesi').val($('#id_d_anastesi').val());
        $('#hide_d_anastesi').val($('#d_anastesi').val());
        $('#hide_id_a_anastesi').val($('#id_a_anastesi').val());
        $('#hide_a_anastesi').val($('#a_anastesi').val());
        $('#hide_jenis_anastesi').val($('#jenis_anastesi').val());
        $('#hide_tindakan').val($('#tindakan').val());
        $('#hide_indikasi_operasi').val($('#indikasi_operasi').val());
        $('#hide_posisi').val($('[name="radio_posisi"]:checked').val());
        $('#hide_jenis_pembedahan').val($('[name="radio_jenis_pembedahan"]:checked').val());
        $('#hide_jenis_pembedahan2').val($('[name="radio_jenis_pembedahan2"]:checked').val());
        $('#hide_jenis_luka_operasi').val($('[name="radio_jenis_luka_operasi"]:checked').val());
        $('#hide_tanggal').val($('#tanggal').val());
        $('#hide_mulai').val($('#mulai').val());
        $('#hide_selesai').val($('#selesai').val());
        $('#hide_lama_pembedahan').val($('#lama_pembedahan').val());
        $('#hide_catatan').val(JSON.stringify(catatan));
        $('#hide_air_ketuban').val($('[name="radio_air_ketuban"]:checked').val());
        $('#hide_jumlah_air_ketuban').val($('#jumlah_air_ketuban').val());
        $('#hide_bayi').val($('[name="radio_bayi"]:checked').val());
        $('#hide_bb1').val($('#bb1').val());
        $('#hide_pb1').val($('#pb1').val());
        $('#hide_as1').val($('#as1').val());
        $('#hide_kelamin1').val($('[name="radio_kelamin1"]:checked').val());
        $('#hide_ket_plasenta').val($('#ket_plasenta').val());
        $('#hide_lahir_dengan').val($('#lahir_dengan').val());
        $('#hide_kelainan').val($('#kelainan').val());
        $('#hide_ket_sbu_jahit').val($('#ket_sbu_jahit').val());
        $('#hide_tubae').val($('[name="radio_tubae"]:checked').val());
        $('#hide_ovarium_kiri').val($('[name="radio_ovarium_kiri"]:checked').val());
        $('#hide_ovarium_kanan').val($('[name="radio_ovarium_kanan"]:checked').val());
        $('#hide_jumlah').val($('[name="radio_jumlah"]:checked').val());
        $('#hide_det_jumlah').val($('[name="radio_det_jumlah"]:checked').val());
        $('#hide_ket_jumlah').val($('#ket_jumlah').val());
        $('#hide_ket_pendarahan').val($('#ket_pendarahan').val());
        $('#hide_no_batch').val($('#no_batch').val());
        $('#hide_komplikasi').val($('#komplikasi').val());
        $('#hide_pendarahan').val($('#pendarahan').val());
        $('#hide_dikirim_pa').val($('[name="radio_dikirim_pa"]:checked').val());
        $('#hide_asal_jaringan').val($('#asal_jaringan').val());
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
            success: function (response) {
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
            onSelect: function (suggestion) {
                $("#diagnosa_pra_bedah").val(suggestion.nama);
            }
        });

        $("#diagnosa_pasca_bedah").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
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
            success: function (response) {
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
            var time1 = $("#mulai").val().split(':'), time2 = $("#selesai").val().split(':');
            var hours1 = parseInt(time1[0], 10),
                hours2 = parseInt(time2[0], 10),
                mins1 = parseInt(time1[1], 10),
                mins2 = parseInt(time2[1], 10);
            var hours = hours2 - hours1, mins = 0;

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
        if ($("#sbu_sayat").prop('checked') == true){
            $('[name="radio_air_ketuban"]').removeAttr('disabled');
            $('#jumlah_air_ketuban').removeAttr('readonly');
        } else {
            $('[name="radio_air_ketuban"]').removeAttr('disabled');
            $('#jumlah_air_ketuban').removeAttr('readonly');
        }
    }

    function cek_bayi() {
        if($("#bayi").prop('checked') == true){
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
        if($("#plasenta").prop('checked') == true){
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

    function cek_pendarahan() {
        if ($("#pendarahan").prop('checked') == true) {
            $('#ket_pendarahan').removeAttr('readonly');
        } else {
            $('#ket_pendarahan').attr('readonly', true);
            $('#ket_pendarahan').val('');
        }
    }
</script>
</html>
