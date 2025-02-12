<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Transfer Pasien Internal</title>

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

        .tabel_layout tr td{
            padding: 10px 0px;
        }
    </style>
</head>

<body style="margin: 20px;">
<div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            <form method="post" action="{{ url('e_rekam_medis/detail/verifikasi_petugas_penyerahan') }}">
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
<form onsubmit="return cek_form(this)" id="form_persetujuan" action="{{ url('e_rekam_medis/detail/save_dokumen_transfer_pasien_internal') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" id="hide_tgl_transfer" name="tgl_transfer">
    <input type="hidden" id="hide_jam_transfer" name="jam_transfer">
    <input type="hidden" id="hide_tgl_masuk" name="tgl_masuk">
    <input type="hidden" id="hide_id_dpjp" name="id_dpjp">
    <input type="hidden" id="hide_dpjp" name="dpjp">
    <input type="hidden" id="hide_riwayat_penyakit" name="riwayat_penyakit">
    <input type="hidden" id="hide_diagnosa_medis_masuk" name="diagnosa_medis_masuk">
    <input type="hidden" id="hide_indikasi_rawat" name="indikasi_rawat">
    <input type="hidden" id="hide_id_unit" name="id_unit">
    <input type="hidden" id="hide_unit" name="unit">
    <input type="hidden" id="hide_keadaan_umum" name="keadaan_umum">
    <input type="hidden" id="hide_tindakan_dokter" name="tindakan_dokter">
    <input type="hidden" id="hide_tindakan_perawat" name="tindakan_perawat">
    <input type="hidden" id="hide_gcs_e" name="gcs_e">
    <input type="hidden" id="hide_gcs_m" name="gcs_m">
    <input type="hidden" id="hide_gcs_v" name="gcs_v">
    <input type="hidden" id="hide_kesadaran" name="kesadaran">
    <input type="hidden" id="hide_fasilitas_transfer" name="fasilitas_transfer">
    <input type="hidden" id="hide_ket_fasilitas_transfer" name="ket_fasilitas_transfer">
    <input type="hidden" id="hide_TD" name="TD">
    <input type="hidden" id="hide_RR" name="RR">
    <input type="hidden" id="hide_Nadi" name="Nadi">
    <input type="hidden" id="hide_Suhu" name="Suhu">
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
        <div class="row" style="width: 100%; vertical-align: center">
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
    <div class="col-lg-6" style="width: 100%; margin-left: 0; padding:10px; border: 1px solid;">
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
<div style="border:1px solid; margin-top: -17px;">
    <div class="row pt-1" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12 text-center">
            <h5><b>FORMULIR TRANSFER PASIEN INTERNAL</b></h5>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <table style="width: 100%" class="tabel_layout">
                <tr>
                    <td style="width: 20%">1. Tanggal Transfer</td>
                    <td>:</td>
                    <td style="width: 85%;">
                        <div class="row">
                            <div class="col-md-7">
                                <input type="date" id="tgl_transfer"
                                       class="form-control"
                                       value="@if(old('tgl_transfer')){{ old('tgl_transfer') }}
                                   @else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->tgl_transfer : '' }}@endif">
                            </div>
                            <div class="col-md-5">
                                <div style="float: right; display: flex; flex-direction: row; width:100%; justify-content: flex-end; align-items: center">
                                    <span class="pr-2">Jam : </span>
                                    <input type="time" class="form-control" style="width: 30%"
                                           value="@if(old('jam_transfer')){{ old('jam_transfer') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->jam_transfer : '' }}@endif"
                                           id="jam_transfer"><span class="pl-2"></span>WIB
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">2. Tanggal Masuk</td>
                    <td>:</td>
                    <td style="width: 85%; border-bottom: 2px dotted">
                        {{ date('d-m-Y', strtotime($layanan->tanggal)) }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">3. Dokter Penanggung Jawab Pelayanan (DPJP) :</td>
                    <td>:</td>
                    <td style="width: 85%;">
                        <input type="text" hidden id="id_dpjp" value="{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->id_dpjp : ''}}">
                        <div class="input-group">
                            <input type="text" readonly
                                   value="{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->dpjp : ''}}"
                                   id="dpjp" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" onclick="open_modal_yth('dpjp')"><i
                                        class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                    {{-- <td colspan="3">
                        <div class="row">
                            <div class="col-md-4">
                                <span>3. Dokter Penanggung Jawab Pelayanan (DPJP) :</span>
                            </div>
                            <div class="col-md-8 text-left">
                                <div class="input-group">
                                    <input type="text" hidden id="id_dpjp">
                                    <input type="text" readonly
                                           value="{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->dpjp : ''}}"
                                           id="dpjp" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button" onclick="open_modal_yth('dpjp')"><i
                                                class="fa fa-list"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td> --}}
                </tr>
                <tr>
                    <td style="width: 20%">4. Riwayat Penyakit Dahulu</td>
                    <td>:</td>
                    <td style="width: 85%;">
                        <input type="text" id="riwayat_penyakit" class="form-control"
                               value="@if(old('riwayat_penyakit')){{ old('riwayat_penyakit') }}
                                   @else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->riwayat_penyakit : '' }}@endif">
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">5. Diagnosa Medis Masuk</td>
                    <td>:</td>
                    <td style="width: 85%;">
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
                <tr>
                    <td style="width: 20%">6. Indikasi Rawat</td>
                    <td>:</td>
                    <td style="width: 85%;">
                        <input type="text" id="indikasi_rawat" class="form-control"
                               value="@if(old('indikasi_rawat')){{ old('indikasi_rawat') }}
                                   @else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->indikasi_rawat : '' }}@endif">
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">7. Unit yang dituju</td>
                    <td>:</td>
                    <td style="width: 85%;">
                        <input type="text" hidden value="@if(old('id_unit')) {{ old('id_unit') }} @else {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->id_unit : ''}} @endif" id="id_unit">
                        <div class="input-group">
                            <input type="text" readonly
                                   value="@if(old('unit')) {{ old('unit') }} @else {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->unit : ''}} @endif"
                                   id="unit" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" onclick="open_modal_kamar()"><i
                                        class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <li>KEADAAN SAAT TRANSFER</li>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <table style="width: 100%" class="tabel_layout">
                <tr>
                    <td style="width: 20%; vertical-align: text-top">1. Keadaan Umum</td>
                    <td style="vertical-align: text-top">:</td>
                    <td style="width: 85%;">
                        <textarea id="keadaan_umum" class="form-control"
                                  rows="5" class="form-control">@if(old('keadaan_umum')){{ old('keadaan_umum') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->keadaan_umum : '' }}@endif</textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; vertical-align: text-top">2. Kesadaran</td>
                    <td style="vertical-align: text-top">:</td>
                    <td style="width: 85%;">
                        <select id="kesadaran" class="form-control">
                            <option value="">--Select Here--</option>
                            <option @if(old('kesadaran')) {{ old('kesadaran') == 'composmentis' ? 'selected' : '' }} @endif {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->kesadaran == 'composmentis' ? 'selected' : '' : '' }} value="composmentis">Composmentis</option>
                            <option @if(old('kesadaran')) {{ old('kesadaran') == 'sompolen' ? 'selected' : '' }} @endif {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->kesadaran == 'sompolen' ? 'selected' : '' : '' }} value="sompolen">Sompolen</option>
                            <option @if(old('kesadaran')) {{ old('kesadaran') == 'sopor' ? 'selected' : '' }} @endif {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->kesadaran == 'sopor' ? 'selected' : '' : '' }} value="sopor">Sopor</option>
                            <option @if(old('kesadaran')) {{ old('kesadaran') == 'coma' ? 'selected' : '' }} @endif {{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->kesadaran == 'coma' ? 'selected' : '' : '' }} value="coma">Coma</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; vertical-align: text-top">GCS</td>
                    <td style="vertical-align: text-top">:</td>
                    <td style="width: 85%;">
                        <div class="row">
                            <div class="col-md-4">
                                E : <input type="text"
                                           value="@if(old('gcs_e')){{ old('gcs_e') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->gcs_e : '' }}@endif"
                                           id="gcs_e" style="border: 0; border-bottom: 2px dotted;">
                            </div>
                            <div class="col-md-4">
                                M : <input type="text"
                                           value="@if(old('gcs_m')){{ old('gcs_m') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->gcs_m : '' }}@endif"
                                           id="gcs_m" style="border: 0; border-bottom: 2px dotted;">
                            </div>
                            <div class="col-md-4">
                                V : <input type="text"
                                           value="@if(old('gcs_v')){{ old('gcs_v') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->gcs_v : '' }}@endif"
                                           id="gcs_v" style="border: 0; border-bottom: 2px dotted;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                TD : 
                                <input type="text"
                                    value="{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->TD : ($layanan->tanda_vital ? $layanan->tanda_vital->tensi : '') }}"
                                    id="TD" style="border: 0; border-bottom: 2px dotted;">
                                mmHg
                            </div>
                            <div class="col-md-3 text-center">
                                RR : 
                                <input type="text"
                                    value="{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->RR : ($layanan->tanda_vital ? $layanan->tanda_vital->rr : '') }}"
                                    id="RR" style="border: 0; border-bottom: 2px dotted;">
                                x/menit
                            </div>
                            <div class="col-md-3 text-center">
                                Nadi : 
                                <input type="text"
                                    value="{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->Nadi : ($layanan->tanda_vital ? $layanan->tanda_vital->nadi : '') }}"
                                    id="Nadi" style="border: 0; border-bottom: 2px dotted;">
                                x/menit
                            </div>
                            <div class="col-md-3 text-center">
                                Suhu : 
                                <input type="text"
                                    value="{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->Suhu : ($layanan->tanda_vital ? $layanan->tanda_vital->suhu : '') }}"
                                    id="Suhu" style="border: 0; border-bottom: 2px dotted;">
                                ᵒC
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <li>HASIL PEMERIKSAAN DIAGNOSTIK YANG DISERTAKAN (LABORATORIUM, RADIOLOGI, dll)</li>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-12">
            A. Laboratorium
            <div id="list_pesanan">
                @if ($layanan->pesanan_lab)
                    @foreach ($layanan->pesanan_lab as $pl)
                        @php
                            $iterasi_pesanan_lab = 0;
                            $pesan = '';
                        @endphp
                            <?php $yang_dipesan = json_decode($pl->periksa); ?>
                        @foreach ($pemeriksaan as $pem)
                            @php
                                $temp_slug = $pem->slug;
                            @endphp
                            @if(isset($yang_dipesan->$temp_slug))
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
                        {{ $pl->no_lab }} - {{ $pesan }}
                    @endforeach
                @endif
            </div>
            <br>
            B. Radiologi
            <div id="list_pesanan_radiologi">
                @if ($layanan->pesanan_radiologi)
                    @foreach ($layanan->pesanan_radiologi as $pr)
                        @php
                            $iterasi_pesanan_radiologi = 0;
                            $pesan_radiologi = '';
                        @endphp
                            <?php $yang_dipesan = json_decode($pr->periksa); ?>
                        @foreach ($pemeriksaan_radiologi as $pemrad)
                            @php
                                $temp_slug = 'rad_' . $pemrad->id;
                            @endphp
                            @if(isset($yang_dipesan->$temp_slug))
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
                        {{ $pr->no_lab }} - {{ $pesan_radiologi }}
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <li>PROSEDUR TINDAKAN YANG SUDAH DILAKUKAN</li>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-12">
            A. Tindakan Dokter
            <div>
                @if ($tindakan_dokter)
                    @foreach ($tindakan_dokter as $key => $td)
                        &nbsp;&nbsp;&nbsp;{{ ($key+1).". ".$td->nama_tagihan }}
                        <br>
                    @endforeach
                @else
                    -
                @endif

                <textarea id="tindakan_dokter" class="form-control"
                                  rows="5" class="form-control">@if(old('tindakan_dokter')){{ old('tindakan_dokter') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->tindakan_dokter : '' }}@endif</textarea>
            </div>
            B. Tindakan Perawat
            <div>
                @if ($tindakan_perawat)
                    @foreach($tindakan_perawat as $key2 => $tp)
                    &nbsp;&nbsp;&nbsp;{{ ($key2+1).". ".$tp->nama_tagihan }}
                        <br>
                    @endforeach
                @else
                    -
                @endif
                <textarea id="tindakan_perawat" class="form-control"
                                  rows="5" class="form-control">@if(old('tindakan_perawat')){{ old('tindakan_perawat') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->tindakan_perawat : '' }}@endif</textarea>
            </div>
            C. Oksigen Manual
            <div>
                @if ($oksigen_manual)
                    @foreach ($oksigen_manual as $key3 => $om)
                        {{ ($key3+1)." ".$om->nama_tagihan." ".$om->keterangan }}
                    @endforeach
                @else
                    -
                @endif
            </div>
            D. Oksigen Central
            <div>
                @if ($oksigen_central)
                    @foreach ($oksigen_central as $key4 => $oc)
                        {{ ($key4+1)." ".$oc->nama_tagihan." ".$oc->keterangan }}
                    @endforeach
                @else
                    -
                @endif
            </div>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <li>TERAPI YANG SUDAH DIBERIKAN</li>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-12">
            <div id="list_e_resep" class="pt-3">
                <div id="box_btn_terapi">
                    {{-- No. Resep Elektronik
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
                                    <td>{{ $ar_det->signa }}</td>
                                    <td>{{ $ar_det->jumlah_pakai_sehari . ' x 1' }}</td>
                                    <td style="padding-left: 20px;">
                                        {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </table> --}}

                    @php
                        $charCount = 0;
                        $maxCharsPerPage = 1620; // misalnya, 1000 karakter per halaman
                    @endphp

                    @foreach ($all_resep as $ar)
                        <div style="page-break-inside: avoid;">
                            <strong>No. Resep: {{ $ar->id }}</strong>
                            @php
                                $charCount += strlen($ar->id);
                            @endphp
                            
                            @foreach ($ar->detail as $ar_det)
                                @php
                                    $lineContent = $ar_det->nama_obat . $ar_det->signa . 'Jml : ' . $ar_det->jumlah . ' ' . $ar_det->satuan_pakai;
                                    $charCount += strlen($lineContent);
                                @endphp
                                
                                <div style="padding-left: 20px;">
                                    <span>{{ $ar_det->nama_obat }} :</span>
                                    <span>{{ $ar_det->signa }}</span>,
                                    <span>Jumlah : {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</span>
                                </div>
                                
                                @if ($charCount > $maxCharsPerPage)
                                    @php
                                        $charCount = 0; // reset for new page
                                    @endphp
                                    <div style="page-break-before: always;"></div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <li>PERALATAN / FASILITAS PADA SAAT TRANSFER</li>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                                     @if(old('fasilitas_transfer'))
                                         {{ old('fasilitas_transfer') ==  'kursi_roda' ? 'checked' : '' }}
                                     @else
                                         {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'kursi_roda' ? 'checked' : '') : '' }}
                                     @endif
                                     type="radio" value="kursi_roda" name="radio_fasilitas"> 1. Kursi Roda
            </div>
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                          @if(old('fasilitas_transfer'))
                              {{ old('fasilitas_transfer') ==  'berangkar' ? 'checked' : '' }}
                          @else
                              {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'berangkar' ? 'checked' : '') : '' }}
                          @endif
                          type="radio" value="berangkar" name="radio_fasilitas"> 2. Berangkar
            </div>
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                          @if(old('fasilitas_transfer'))
                              {{ old('fasilitas_transfer') ==  'oksigen' ? 'checked' : '' }}
                          @else
                              {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'oksigen' ? 'checked' : '') : '' }}
                          @endif
                          type="radio" value="oksigen" name="radio_fasilitas"> 3. Oksigen
            </div>
            <div class="row col-md-12">
                <input onclick="cek_radio_fasilitas()"
                          @if(old('fasilitas_transfer'))
                              {{ old('fasilitas_transfer') ==  'lain_lain' ? 'checked' : '' }}
                          @else
                              {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'lain_lain' ? 'checked' : '') : '' }}
                          @endif
                          type="radio" value="lain_lain" name="radio_fasilitas"> 4. Lain - lain
                <input type="text" readonly
                       value="@if(old('ket_fasilitas_transfer')){{ old('ket_fasilitas_transfer') }}@else{{ $dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->ket_fasilitas_transfer : '' }}@endif"
                       id="ket_fasilitas_transfer" style="border: 0; border-bottom: 2px dotted;"
                @if(old('fasilitas_transfer'))
                    {{ old('fasilitas_transfer') ==  'lain_lain' ? '' : 'readonly' }}
                    @else
                    {{ $dokumen->dokumen_transfer_pasien_internal ? ($dokumen->dokumen_transfer_pasien_internal->fasilitas_transfer == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                    @endif>
            </div>
        </div>
    </div>
    <div class="row pt-2" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-6 text-center">
            <a @if($dokumen->dokumen_transfer_pasien_internal)onclick="open_modal_dokter2()"@endif href="#"
               style="text-decoration:none; color:#111; text-align: center">
                @if(!isset($dokumen->dokumen_transfer_pasien_internal) && !isset($dokumen->dokumen_transfer_pasien_internal->id_petugas_penyerahan))
                    <br>
                    <br>
                    Klik Disini
                    <br>
                    <br>
                    (.................................................)
                    <br>Petugas yang menyerahkan
                @else
                    @if(isset($petugas_penyerahan))
                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$petugas_penyerahan->ttd }}"
                             style="height: 4cm; width: 5cm;" alt="">
                    @else
                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                    @endif
                    <br>({{$dokumen->dokumen_transfer_pasien_internal ? $dokumen->dokumen_transfer_pasien_internal->petugas_penyerahan : ''}})<br>Petugas yang menyerahkan
                @endif
            </a>
        </div>
        <div class="col-md-6 text-center">
            <a @if($dokumen->dokumen_transfer_pasien_internal)onclick="open_modal_dokter()"@endif href="#"
               style="text-decoration:none; color:#111; text-align: center">
                @if($dokumen->id_verifikator == 0)
                    <br>
                    <br>
                    Klik Disini
                    <br>
                    <br>
                    (.................................................)
                    <br>Petugas yang menerima
                @else
                    @if(isset($employee))
                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                             style="height: 4cm; width: 5cm;" alt="">
                    @else
                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                    @endif
                    <br>({{$dokumen->nama_verifikator}})<br>Petugas yang menerima
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
            <a href="{{ url('e_rekam_medis/detail/pdf_dokumen_transfer_pasien_internal?dokumen='.$dokumen->id) }}"
               class="btn btn-success" target="_blank">Download PDF</a>
        @endif
    </div>
</div>
<div class="modal fade" id="modal_yth" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Kepada Yth.</h5>
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
<div class="modal fade" id="modal_kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Data Kamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabel_kamar" class="table table-striped mt-2" style="width: 100%;">
                    <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    var sts_yth = "";
    var table;

    function get_data_dokter() {
        table = $('#tabel_kepada').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url("ajax_request/dokter") }}',
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
                        if (sts_yth == "dpjp") {
                            fungsi_set = 'set_kepada(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        } else if (sts_yth == "dokter_pengirim") {
                            fungsi_set = 'set_dokter(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        }
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function get_kamar() {
        table = $('#tabel_kamar').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url("ajax_request/unit") }}',
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
                    data: 'id',
                    name: 'id',
                    render(data, type, row) {
                        fungsi_set = 'set_kamar(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
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

    function open_modal_kamar() {
        get_kamar();
        $('#modal_kamar').modal('show');
    }

    function set_kepada(id, nama) {
        $('#dpjp').val(nama);
        $('#id_dpjp').val(id);
        $('#modal_yth').modal('hide');
    }

    function set_kamar(id, nama) {
        $('#unit').val(nama);
        $('#id_unit').val(id);
        $('#modal_kamar').modal('hide');
    }

    function open_modal_dokter() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_dokter2() {
        $('#modal_petugas2').modal('show');
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        $('#hide_tgl_transfer').val($('#tgl_transfer').val());
        $('#hide_jam_transfer').val($('#jam_transfer').val());
        $('#hide_tgl_masuk').val($('#tgl_masuk').val());
        $('#hide_id_dpjp').val($('#id_dpjp').val());
        $('#hide_dpjp').val($('#dpjp').val());
        $('#hide_riwayat_penyakit').val($('#riwayat_penyakit').val());
        $('#hide_diagnosa_medis_masuk').val($('#diagnosa_medis_masuk').val());
        $('#hide_indikasi_rawat').val($('#indikasi_rawat').val());
        $('#hide_id_unit').val($('#id_unit').val());
        $('#hide_unit').val($('#unit').val());
        $('#hide_keadaan_umum').val($('#keadaan_umum').val());
        $('#hide_tindakan_dokter').val($('#tindakan_dokter').val());
        $('#hide_tindakan_perawat').val($('#tindakan_perawat').val());
        $('#hide_gcs_e').val($('#gcs_e').val());
        $('#hide_gcs_m').val($('#gcs_m').val());
        $('#hide_gcs_v').val($('#gcs_v').val());
        $('#hide_kesadaran').val($('#kesadaran').val());
        $('#hide_fasilitas_transfer').val($('[name="radio_fasilitas"]:checked').val());
        $('#hide_ket_fasilitas_transfer').val($('#ket_fasilitas_transfer').val());
        $('#hide_TD').val($('#TD').val());
        $('#hide_RR').val($('#RR').val());
        $('#hide_Nadi').val($('#Nadi').val());
        $('#hide_Suhu').val($('#Suhu').val());
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

    function open_form_tambah_diagnosa() {
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
</html>
