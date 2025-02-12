<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulir Triase Terintegrasi</title>

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
      action="{{ url('e_rekam_medis/rekam_medis/save_formulir_triage_terintegrasi') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" id="hide_cara_datang" name="cara_datang">
    <input type="hidden" id="hide_no_ambulan" name="no_ambulan">
    <input type="hidden" id="hide_rujukan" name="rujukan">
    <input type="hidden" id="hide_asal_rujukan" name="asal_rujukan">
    <input type="hidden" id="hide_jam_datang" name="jam_datang">
    <input type="hidden" id="hide_alamat" name="alamat">
    <input type="hidden" id="hide_nama_pengantar" name="nama_pengantar">
    <input type="hidden" id="hide_doa" name="doa">
    <input type="hidden" id="hide_jam_doa" name="jam_doa">
    <input type="hidden" id="hide_keluhan_utama" name="keluhan_utama">
    <input type="hidden" id="hide_trauma" name="trauma">
    <input type="hidden" id="hide_riwayat_penyakit" name="riwayat_penyakit">
    <input type="hidden" id="hide_obstetri" name="obstetri">
    <input type="hidden" id="hide_imunisasi" name="imunisasi">
    <input type="hidden" id="hide_riwayat_alergi" name="riwayat_alergi">
    <input type="hidden" id="hide_jalan_nafas" name="jalan_nafas">
    <input type="hidden" id="hide_pernafasan" name="pernafasan">
    <input type="hidden" id="hide_sirkulasi" name="sirkulasi">
    <input type="hidden" id="hide_kesadaran" name="kesadaran">
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
            <h6 style="color: white">FORMULIR TRIASE TERINTEGRASI</h6>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%" class="table_isian">
            <tr>
                <td style="width: 40%; padding: 10px;">
                    Cara datang :
                    <br>
                    <input onclick="cek_radio_cara_datang()"
                           @if(old('cara_datang'))
                               {{ old('cara_datang') ==  'sendiri' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->cara_datang == 'sendiri' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="sendiri" name="radio_cara_datang"> Sendiri
                    <br>
                    <input onclick="cek_radio_cara_datang()"
                           @if(old('cara_datang'))
                               {{ old('cara_datang') ==  'diantar_polisi' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->cara_datang == 'diantar_polisi' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="diantar_polisi" name="radio_cara_datang"> Diantar Polisi
                    <br>
                    <input onclick="cek_radio_cara_datang()"
                           @if(old('cara_datang'))
                               {{ old('cara_datang') ==  'ambulan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->cara_datang == 'ambulan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ambulan" name="radio_cara_datang"> Ambulans No.ID
                    <input type="text" readonly
                           value="@if(old('no_ambulan')){{ old('no_ambulan') }}@else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->no_ambulan : '' }}@endif"
                           id="no_ambulan" style="border: 0; border-bottom: 2px dotted;"
                    @if(old('cara_datang'))
                        {{ old('cara_datang') ==  'ambulan' ? '' : 'readonly' }}
                        @else
                        {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->cara_datang == 'ambulan' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
                <td style="width: 20%; padding: 10px; vertical-align: text-top">
                    <input type="checkbox" onchange="cek_asal_rujukan()" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('rujukan',json_decode($dokumen->formulir_triage_terintegrasi->rujukan )) ? 'checked' : '' }}
                    @endif id="rujukan"> Asal Rujukan
                    <select id="asal_rujukan" class="form-control" disabled style="margin-top: 5px">
                        <option value="" selected disabled>Pilih Asal Rujukan</option>
                        @foreach($perujuk as $item)
                            <option @if(old('asal_rujukan'))
                                        {{ old('asal_rujukan') == $item->nama ? 'selected' : '' }}
                                    @elseif(isset($dokumen->formulir_triage_terintegrasi))
                                        {{ $dokumen->formulir_triage_terintegrasi->asal_rujukan == $item->nama ? 'selected' : '' }}
                                    @endif value="{{ $item->nama }}">{{ $item->nama }}
                        @endforeach
                        </option>
                    </select>
                </td>
                <td style="width: 20%; padding: 10px; vertical-align: text-top">
                    Jam Datang :
                    <input style="margin-top: 5px" type="time" class="form-control" id="jam_datang"
                           value="@if(old('jam_datang')){{ old('jam_datang') }}
                                   @else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->jam_datang : '' }}@endif">
                </td>
                <td style="width: 20%; padding: 10px; vertical-align: text-top">
                    Jam Registrasi :
                    <input style="margin-top: 5px" type="time" class="form-control" id="jam_registrasi" readonly
                           value="{{ date('H:i', strtotime($layanan->tanggal)) }}">
                </td>
            </tr>
            <tr>
                <td style="width: 40%; padding: 10px;">
                    Alamat :
                    <br>
                    <textarea id="alamat" class="form-control" style="margin-top: 5px"
                              rows="5">@if(old('alamat')){{ old('alamat') }}@else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->alamat : $layanan->alamat }}@endif</textarea>
                </td>
                <td style="width: 20%; padding: 10px; vertical-align: text-top">
                    Nama Pengantar :
                    <input style="margin-top: 5px" type="text" class="form-control" id="nama_pengantar"
                           placeholder="Nama Pengantar"
                           value="@if(old('nama_pengantar')){{ old('nama_pengantar') }}
                                   @else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->nama_pengantar : '' }}@endif">
                </td>
                <td colspan="2" rowspan="3" style="width: 40%; padding: 10px; vertical-align: text-top">
                    <input onclick="cek_radio_doa()"
                           @if(old('doa'))
                               {{ old('doa') ==  'doa' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'doa' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="doa" name="radio_doa"> DOA
                    <br>
                    <input onclick="cek_radio_doa()"
                           @if(old('doa'))
                               {{ old('doa') ==  'tanda_kehidupan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'tanda_kehidupan' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tanda_kehidupan" name="radio_doa"> Tanda Kehidupan (-)
                    <br>
                    <input onclick="cek_radio_doa()"
                           @if(old('doa'))
                               {{ old('doa') ==  'denyut_nadi' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'denyut_nadi' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="denyut_nadi" name="radio_doa"> Denyut Nadi (-)
                    <br>
                    <input onclick="cek_radio_doa()"
                           @if(old('doa'))
                               {{ old('doa') ==  'ekg_flat' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'ekg_flat' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ekg_flat" name="radio_doa"> EKG Flat
                    <br>
                    Jam DOA :
                    <input type="text" readonly
                           value="@if(old('jam_doa')){{ old('jam_doa') }}@else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->jam_doa : '' }}@endif"
                           id="jam_doa" style="border: 0; border-bottom: 2px dotted;"
                    @if(old('doa'))
                        {{ old('doa') ==  'doa' ? '' : 'readonly' }}
                        @else
                        {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->doa == 'doa' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; padding: 10px;">
                    Keluhan Utama :
                    <br>
                    <input style="margin-top: 5px" type="text" class="form-control" id="keluhan_utama"
                           placeholder="Keluhan Utama"
                           value="@if(old('keluhan_utama')){{ old('keluhan_utama') }}
                                   @else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->keluhan_utama : '' }}@endif">
                </td>
                <td style="width: 20%; padding: 10px; vertical-align: text-top">
                    <input @if(old('trauma'))
                               {{ old('trauma') ==  'trauma' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->trauma == 'trauma' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="trauma" name="radio_trauma"> Trauma
                    <br>
                    <input @if(old('trauma'))
                               {{ old('trauma') ==  'non_trauma' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->trauma == 'non_trauma' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="non_trauma" name="radio_trauma"> Non Trauma
                </td>
            </tr>
            <tr>
                <td style="width: 40%; padding: 10px;">
                    Riwayat Penyakit Dahulu :
                    <br>
                    <input style="margin-top: 5px" type="text" class="form-control" id="riwayat_penyakit"
                           placeholder="Riwayat Penyakit Dahulu"
                           value="@if(old('riwayat_penyakit')){{ old('riwayat_penyakit') }}
                                   @else{{ $dokumen->formulir_triage_terintegrasi ? $dokumen->formulir_triage_terintegrasi->riwayat_penyakit : '' }}@endif">
                </td>
                <td style="width: 20%; padding: 10px; vertical-align: text-top">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('obstetri',json_decode($dokumen->formulir_triage_terintegrasi->obstetri )) ? 'checked' : '' }}
                    @endif id="obstetri"> Obstetri
                </td>
            </tr>
        </table>
        <table style="width: 100%" class="table_isian">
            <tr>
                <td colspan="3" class="text-center">
                    <b>TRIASE PRIMER</b>
                </td>
                <td colspan="4" class="text-center">
                    <b>TRIASE SEKUNDER</b>
                </td>
            </tr>
            <tr>
                <td style="width: 14%; text-align: center"><b>PEMERIKSAAN</b></td>
                <td style="width: 14%; text-align: center; background-color: red"><b>RESUSITASI</b></td>
                <td style="width: 14%; text-align: center; background-color: red"><b>EMERGENT</b></td>
                <td style="width: 14%; text-align: center"><b>TANDA VITAL</b></td>
                <td style="width: 14%; text-align: center; background-color: yellow"><b>URGENT</b></td>
                <td style="width: 14%; text-align: center; background-color: green"><b>NOT URGENT</b></td>
                <td style="width: 14%; text-align: center; background-color: green"><b>FALSE EMERGENCY</b></td>
            </tr>
            <tr>
                <td style="width: 14%;">Jalan Nafas</td>
                <td style="width: 14%; background-color: red">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('sumbatan',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                    @endif id="sumbatan"> Sumbatan
                </td>
                <td style="width: 14%; background-color: red">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                    @endif id="bebas"> Bebas
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->jalan_nafas )) ? 'checked' : '' }}
                    @endif id="ancaman"> Ancaman
                </td>
                <td style="width: 14%;">
                    Keadaan Umum
                </td>
                <td style="width: 14%; background-color: yellow">Bebas</td>
                <td style="width: 14%; background-color: green">Bebas</td>
                <td style="width: 14%; background-color: green">Bebas</td>
            </tr>
            <tr>
                <td style="width: 14%;">Pernafasan</td>
                <td style="width: 14%; background-color: red">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('sumbatan',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="henti_nafas"> Henti Nafas
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('sumbatan',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="bradipnea"> Bradipnea
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('sumbatan',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="sianosis"> Sianosis
                </td>
                <td style="width: 14%; background-color: red">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="takipnea"> Takipnea
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="mengi"> Mengi
                </td>
                <td style="width: 14%; vertical-align: text-top" rowspan="3">
                    Tekanan Darah :
                    <br>
                    {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '_______/_______' }} mmHg
                    <br>
                    Suhu :
                    <br>
                    {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '_______' }} ᵒC
                    <br>
                    Frek. Nadi :
                    <br> 
                    {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '_______' }} x/menit
                    <br>
                    Frek. Napas :
                    <br>
                    {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '_______' }} x/menit
                    <br>
                    SaO<sub>2</sub> :
                    <br>
                    {{ $layanan->tanda_vital ? $layanan->tanda_vital->spo2 : '_______' }} %
                    <br>
                    <br>
                    Imunisasi : 
                    <br>
                    <input @if(old('imunisasi'))
                                {{ old('imunisasi') ==  'ya' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->imunisasi == 'ya' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="ya" name="radio_imunisasi"> Ya
                    <br>
                    <input @if(old('imunisasi'))
                                {{ old('imunisasi') ==  'tidak' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->formulir_triage_terintegrasi ? ($dokumen->formulir_triage_terintegrasi->imunisasi == 'tidak' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="tidak" name="radio_imunisasi"> Tidak
                            
                    <br>
                    <br>
                    Riwayat Alergi : 
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('makanan',json_decode($dokumen->formulir_triage_terintegrasi->riwayat_alergi )) ? 'checked' : '' }}
                    @endif id="makanan"> Makanan
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('obat',json_decode($dokumen->formulir_triage_terintegrasi->riwayat_alergi )) ? 'checked' : '' }}
                    @endif id="obat"> Obat
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('lain_lain',json_decode($dokumen->formulir_triage_terintegrasi->riwayat_alergi )) ? 'checked' : '' }}
                    @endif id="lain_lain"> Lain - Lain
                </td>
                <td style="width: 14%; background-color: yellow">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="normal"> Normal
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="mengi2"> Mengi
                </td>
                <td style="width: 14%; background-color: green">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="napas_normal"> Frek, Napas<br>Normal
                </td>
                <td style="width: 14%; background-color: green">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->pernafasan )) ? 'checked' : '' }}
                    @endif id="napas_normal2"> Frek, Napas<br>Normal
                </td>
            </tr>
            <tr style="vertical-align: text-top">
                <td style="width: 14%;">Sirkulasi</td>
                <td style="width: 14%; background-color: red">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('henti_jantung',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="henti_jantung"> Henti Jantung
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('nadi_tidak_teraba',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nadi_tidak_teraba"> Nadi Tidak Teraba
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('akral_dingin',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="akral_dingin"> Akral Dingin
                </td>
                <td style="width: 14%; background-color: red">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('nadi_lemah',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nadi_lemah"> Nadi Lemah
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bradikardi',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="bradikardi"> Bradikardi
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('takikardi',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="takikardi"> Takikardi
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('pucat',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="pucat"> Pucat
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('akral_dingin2',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="akral_dingin2"> Akral Dingin
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('crt',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="crt"> CRT > 2 dtk
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('gcs',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="gcs"> GCS 9 - 12
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('gelisah',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="gelisah"> Gelisah
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('hemiparesi',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="hemiparesi"> Hemiparesi
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('nyeri_dada',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nyeri_dada"> Nyeri Dada
                </td>
                <td style="width: 14%; background-color: yellow">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nadi_kuat"> Nadi Kuat
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="takikardi2"> Takikardi
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="tds160"> TDS > 160
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="tdd100"> TDD > 100
                </td>
                <td style="width: 14%; background-color: green">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nadi_kuat2"> Nadi Kuat
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nadi_normal"> Frek Nadi<br>Normal
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="tds120"> TDS 120
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="tdd80"> TDD 80
                </td>
                <td style="width: 14%; background-color: green">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('bebas',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nadi_kuat3"> Nadi Kuat
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="nadi_normal2"> Frek Nadi<br>Normal
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="tds120_2"> TDS 120
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('ancaman',json_decode($dokumen->formulir_triage_terintegrasi->sirkulasi )) ? 'checked' : '' }}
                    @endif id="tdd80_2"> TDD 80
                </td>
            </tr>
            <tr style="vertical-align: text-top">
                <td style="width: 14%;">Kesadaran</td>
                <td style="width: 14%; background-color: red">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                            {{ in_array('gcs9',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="gcs9"> GCS < 9
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('kejang',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="kejang"> Kejang
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('tidak_ada',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="tidak_ada"> Tidak Ada
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('respon',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="respon"> Respon
                </td>
                <td style="width: 14%; background-color: red">
                    &nbsp;
                </td>
                <td style="width: 14%; background-color: yellow">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('gcs12',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="gcs12"> GCS > 12
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('apatis',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="apatis"> Apatis
                    <br>
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('somnolen',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="somnolen"> Somnolen
                </td>
                <td style="width: 14%; background-color: green">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('gcs15',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="gcs15"> GCS 15
                </td>
                <td style="width: 14%; background-color: green">
                    <input type="checkbox" @if(isset($dokumen->formulir_triage_terintegrasi))
                        {{ in_array('gcs15_2',json_decode($dokumen->formulir_triage_terintegrasi->kesadaran )) ? 'checked' : '' }}
                    @endif id="gcs15_2"> GCS 15
                </td>
            </tr>
            <tr>
                <td colspan="5" style="vertical-align: text-top">
                    Keterangan Warna :
                    <br>
                    1. Merah : Pasien Gawat Darurat (pada pasien dengan label merah perlu mendapatkan penanganan langsung saat itu juga)
                    <br>
                    2. Kuning : Pasien Gawat tapi tidak darurat (pada label kuning perlu ditangani < 15 menit)
                    <br>
                    3. Hijau : Pasien tidak gawat, tidak darurat (pada pasien dengan label hijau mendapatkan penanganan < 30 menit)
                    <br>
                    4. Hitam : Pasien dengan label hitam (MENINGGAL)
                </td>
                <td colspan="2" style="vertical-align: text-top; text-align: center">
                    Bekasi, {{ date('Y-m-d', strtotime($dokumen->created_at)) }}
                    <br>
                    Petugas
                    <br>
                    <a @if($dokumen->formulir_triage_terintegrasi)onclick="open_modal_dokter()"@endif href="#"
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
                </td>
            </tr>
        </table>
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
            <a href="{{ url('e_rekam_medis/rekam_medis/pdf_formulir_triage_terintegrasi?dokumen='.$dokumen->id) }}"
               class="btn btn-success" target="_blank">Download PDF</a>
        @endif
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
    function open_modal_dokter() {
        $('#modal_petugas').modal('show');
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        var rujukan = [];
        if ($('#rujukan').is(":checked")) {
            rujukan.push('rujukan')
        }

        var obstetri = [];
        if ($('#obstetri').is(":checked")) {
            obstetri.push('obstetri')
        }

        var riwayat_alergi = [];
        if ($('#makanan').is(":checked")) {
            riwayat_alergi.push('makanan');
        }
        if ($('#obat').is(":checked")) {
            riwayat_alergi.push('obat');
        }
        if ($('#lain_lain').is(":checked")) {
            riwayat_alergi.push('lain_lain');
        }

        var jalan_nafas = [];
        if ($('#sumbatan').is(":checked")) {
            jalan_nafas.push('sumbatan');
        }
        if ($('#bebas').is(":checked")) {
            jalan_nafas.push('bebas');
        }
        if ($('#ancaman').is(":checked")) {
            jalan_nafas.push('ancaman');
        }

        var pernafasan = [];
        if ($('#henti_nafas').is(":checked")) {
            pernafasan.push('henti_nafas');
        }
        if ($('#bradipnea').is(":checked")) {
            pernafasan.push('bradipnea');
        }
        if ($('#sianosis').is(":checked")) {
            pernafasan.push('sianosis');
        }
        if ($('#takipnea').is(":checked")) {
            pernafasan.push('takipnea');
        }
        if ($('#mengi').is(":checked")) {
            pernafasan.push('mengi');
        }
        if ($('#normal').is(":checked")) {
            pernafasan.push('normal');
        }
        if ($('#mengi2').is(":checked")) {
            pernafasan.push('mengi2');
        }
        if ($('#napas_normal').is(":checked")) {
            pernafasan.push('napas_normal');
        }
        if ($('#napas_normal2').is(":checked")) {
            pernafasan.push('napas_normal2');
        }

        var sirkulasi = [];
        if ($('#henti_jantung').is(":checked")) {
            sirkulasi.push('henti_jantung');
        }
        if ($('#nadi_tidak_teraba').is(":checked")) {
            sirkulasi.push('nadi_tidak_teraba');
        }
        if ($('#akral_dingin').is(":checked")) {
            sirkulasi.push('akral_dingin');
        }
        if ($('#nadi_lemah').is(":checked")) {
            sirkulasi.push('nadi_lemah');
        }
        if ($('#bradikardi').is(":checked")) {
            sirkulasi.push('bradikardi');
        }
        if ($('#takikardi').is(":checked")) {
            sirkulasi.push('takikardi');
        }
        if ($('#pucat').is(":checked")) {
            sirkulasi.push('pucat');
        }
        if ($('#akral_dingin2').is(":checked")) {
            sirkulasi.push('akral_dingin2');
        }
        if ($('#crt').is(":checked")) {
            sirkulasi.push('crt');
        }
        if ($('#gcs').is(":checked")) {
            sirkulasi.push('gcs');
        }
        if ($('#gelisah').is(":checked")) {
            sirkulasi.push('gelisah');
        }
        if ($('#hemiparesi').is(":checked")) {
            sirkulasi.push('hemiparesi');
        }
        if ($('#nyeri_dada').is(":checked")) {
            sirkulasi.push('nyeri_dada');
        }
        if ($('#nadi_kuat').is(":checked")) {
            sirkulasi.push('nadi_kuat');
        }
        if ($('#takikardi2').is(":checked")) {
            sirkulasi.push('takikardi2');
        }
        if ($('#tds160').is(":checked")) {
            sirkulasi.push('tds160');
        }
        if ($('#tdd100').is(":checked")) {
            sirkulasi.push('tdd100');
        }
        if ($('#nadi_kuat2').is(":checked")) {
            sirkulasi.push('nadi_kuat2');
        }
        if ($('#nadi_normal').is(":checked")) {
            sirkulasi.push('nadi_normal');
        }
        if ($('#tds120').is(":checked")) {
            sirkulasi.push('tds120');
        }
        if ($('#tdd80').is(":checked")) {
            sirkulasi.push('tdd80');
        }
        if ($('#nadi_kuat3').is(":checked")) {
            sirkulasi.push('nadi_kuat3');
        }
        if ($('#nadi_normal2').is(":checked")) {
            sirkulasi.push('nadi_normal2');
        }
        if ($('#tds120_2').is(":checked")) {
            sirkulasi.push('tds120_2');
        }
        if ($('#tdd80_2').is(":checked")) {
            sirkulasi.push('tdd80_2');
        }

        var kesadaran = [];
        if ($('#gcs9').is(":checked")) {
            kesadaran.push('gcs9');
        }
        if ($('#kejang').is(":checked")) {
            kesadaran.push('kejang');
        }
        if ($('#tidak_ada').is(":checked")) {
            kesadaran.push('tidak_ada');
        }
        if ($('#respon').is(":checked")) {
            kesadaran.push('respon');
        }
        if ($('#gcs12').is(":checked")) {
            kesadaran.push('gcs12');
        }
        if ($('#apatis').is(":checked")) {
            kesadaran.push('apatis');
        }
        if ($('#somnolen').is(":checked")) {
            kesadaran.push('somnolen');
        }
        if ($('#gcs15').is(":checked")) {
            kesadaran.push('gcs15');
        }
        if ($('#gcs15_2').is(":checked")) {
            kesadaran.push('gcs15_2');
        }

        $('#hide_cara_datang').val($('[name="radio_cara_datang"]:checked').val());
        $('#hide_no_ambulan').val($("#no_ambulan").val());
        $('#hide_rujukan').val(JSON.stringify(rujukan));
        $('#hide_asal_rujukan').val($("#asal_rujukan").val());
        $('#hide_jam_datang').val($("#jam_datang").val());
        $('#hide_alamat').val($("#alamat").val());
        $('#hide_nama_pengantar').val($("#nama_pengantar").val());
        $('#hide_doa').val($('[name="radio_doa"]:checked').val());
        $('#hide_jam_doa').val($("#jam_doa").val());
        $('#hide_keluhan_utama').val($("#keluhan_utama").val());
        $('#hide_trauma').val($('[name="radio_trauma"]:checked').val());
        $('#hide_riwayat_penyakit').val($("#riwayat_penyakit").val());
        $('#hide_obstetri').val(JSON.stringify(obstetri));
        $('#hide_imunisasi').val($('[name="radio_imunisasi"]:checked').val());
        $('#hide_riwayat_alergi').val(JSON.stringify(riwayat_alergi));
        $('#hide_jalan_nafas').val(JSON.stringify(jalan_nafas));
        $('#hide_pernafasan').val(JSON.stringify(pernafasan));
        $('#hide_sirkulasi').val(JSON.stringify(sirkulasi));
        $('#hide_kesadaran').val(JSON.stringify(kesadaran));
        return true;
    }

    function cek_radio_cara_datang() {
        if ($('[name="radio_cara_datang"]:checked').val() == 'ambulan') {
            $('#no_ambulan').removeAttr('readonly');
        } else {
            $('#no_ambulan').attr('readonly', true);
            $('#no_ambulan').val('');
        }
    }

    function cek_asal_rujukan() {
        if ($("#rujukan").prop('checked') == true) {
            $('#asal_rujukan').removeAttr('disabled');
        } else {
            $('#asal_rujukan').attr('disabled', true);
        }
    }

    function cek_radio_doa() {
        if ($('[name="radio_doa"]:checked').val() == 'doa') {
            $('#jam_doa').removeAttr('readonly');
        } else {
            $('#jam_doa').attr('readonly', true);
            $('#jam_doa').val('');
        }
    }
</script>
</html>
