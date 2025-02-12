<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Catatan Edukasi Pasien</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

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

        .table_isian  td {
            border: 1px solid black;
            border-collapse: collapse;
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
            <form method="post" action="{{ url('e_rekam_medis/rekam_medis/verifikasi_dokumen_kunjungan') }}">
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
<form onsubmit="return cek_form_ttd(this)" id="form_catatan_edukasi"
      action="{{ url('e_rekam_medis/rekam_medis/save_catatan_edukasi') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" id="hide_additional_topik" name="additional_topik">
    <input type="hidden" id="hide_bahasa" name="bahasa">
    <input type="hidden" id="hide_bahasa_lainnya" name="bahasa_lainnya">
    <input type="hidden" id="hide_penerjemah" name="penerjemah">
    <input type="hidden" id="hide_penerjemah_lainnya" name="penerjemah_lainnya">
    <input type="hidden" id="hide_pendidikan" name="pendidikan">
    <input type="hidden" id="hide_pendidikan_lainnya" name="pendidikan_lainnya">
    <input type="hidden" id="hide_baca_tulis" name="baca_tulis">
    <input type="hidden" id="hide_pembelajaran" name="pembelajaran">
    <input type="hidden" id="hide_pembelajaran_lainnya" name="pembelajaran_lainnya">
    <input type="hidden" id="hide_hambatan_edukasi" name="hambatan_edukasi">
    <input type="hidden" id="hide_hambatan_edukasi_lainnya" name="hambatan_edukasi_lainnya">
    <input type="hidden" id="hide_menerima_edukasi" name="menerima_edukasi">
    <input type="hidden" id="hide_metode_edukasi" name="metode_edukasi">
    <input type="hidden" id="hide_metode_edukasi_lainnya" name="metode_edukasi_lainnya">
    <input type="hidden" id="hide_evaluasi_edukasi" name="evaluasi_edukasi">
    <input type="hidden" id="hide_topik_edukasi_a" name="topik_edukasi_a">
    <input type="hidden" id="hide_topik_edukasi_b" name="topik_edukasi_b">
    <input type="hidden" id="hide_topik_edukasi_c" name="topik_edukasi_c">
    <input type="hidden" id="hide_topik_edukasi_d" name="topik_edukasi_d">
    <input type="hidden" id="hide_topik_edukasi_e" name="topik_edukasi_e">
    <input type="hidden" name="sarana_edukasi" id="hide_sarana_edukasi">
    <input type="hidden" name="sarana_edukasi_lain" id="hide_sarana_edukasi_lain">
    <input type="hidden" name="penerima_edukasi" id="hide_penerima_edukasi">
    <input type="hidden" name="penerima_edukasi_lain" id="hide_penerima_edukasi_lain">
</form>
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
        <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 16px;">
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
<div style="border:1px solid; margin-top: -17px;">
    <div class="row pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
            <h6 style="color: white">CATATAN EDUKASI TERINTEGRASI PASIEN / KELUARGA</h6>
        </div>
    </div>
    <p>* Beri tanda &#9989 pada tanda <input type="checkbox" readonly disabled></p>
    <table class="table_isian" style="border-collapse:collapse; border: 1px solid; width: 100%;">
        <tr>
            <td colspan="1" style="width: 30%;">
                <p>1. Bahasa</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Indonesia',json_decode($dokumen->catatan_edukasi_pasien->bahasa )) ? 'checked' : '' }} @endif id="indonesia"> Indonesia,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Daerah',json_decode($dokumen->catatan_edukasi_pasien->bahasa )) ? 'checked' : '' }} @endif  id="daerah" style="margin-left: 15px;"> Daerah,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Lainnya',json_decode($dokumen->catatan_edukasi_pasien->bahasa )) ? 'checked' : '' }} @endif  id="lainnya" style="margin-left: 15px;">
                Lainnya <input type="text" id="bahasa_lainnya" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->bahasa_lainnya : '' }}" style="border: 0px" placeholder="................................................">
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p>2. Kebutuhan Penerjemah</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerjemah == "tidak" ? 'checked' : "" : "" }} value="tidak" name="kebutuhan_penerjemah"> Tidak,
                <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerjemah == "ya" ? 'checked' : "" : "" }} value="ya" name="kebutuhan_penerjemah" class="ml-4"> Ya
                <input type="text" id="penerjemah_lainnya" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerjemah_lainnya : '' }}" style="border: 0px" placeholder="................................................">
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p>3. Pendidikan Pasien</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('sd',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }} @endif  id="sd"> SD,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('smp',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }} @endif  id="smp" style="margin-left: 15px;"> SMP,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('sma',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }} @endif  id="sma" style="margin-left: 15px;"> SMA,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('d1',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }} @endif  id="d1" style="margin-left: 15px;"> DI/DII/DIII,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('s1',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }} @endif  id="s1" style="margin-left: 15px;"> SI/SII/SIII,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('pendidikan',json_decode($dokumen->catatan_edukasi_pasien->pendidikan )) ? 'checked' : '' }} @endif  id="pendidikan" style="margin-left: 15px;">
                &nbsp; <input type="text" id="pendidikan_lainnya" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->pendidikan_lainnya : '' }}" style="border: 0px" placeholder="................................................">
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p>4. Baca & Tulis</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->baca_tulis == "baik" ? 'checked' : "" : "" }} value="baik" name="radio_baca_tulis"> Baik,
                <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->baca_tulis == "kurang" ? 'checked' : "" : "" }} value="kurang" name="radio_baca_tulis" class="ml-4"> Kurang
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p>5. Type Pembelajaran</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Verbal', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }} @endif  id="Verbal"> Verbal,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Tulis', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }} @endif  id="Tulis" style="margin-left: 15px;">Tulis
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('Demonstrasi', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }} @endif  id="Demonstrasi" style="margin-left: 15px;"> Demonstrasi
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('pembelajaran', json_decode($dokumen->catatan_edukasi_pasien->pembelajaran)) ? 'checked' : '' }} @endif  id="pembelajaran" style="margin-left: 15px;">
                &nbsp; <input type="text" id="pembelajaran_lainnya" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->pembelajaran_lainnya : '' }}" style="border: 0px" placeholder="................................................">
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p>6. Hambatan Edukasi</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('tidak_ada', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="tidak_ada"> Tidak Ada,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('emosional', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="emosional" style="margin-left: 15px;"> Emosional,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('fisik_lemah', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="fisik_lemah" style="margin-left: 15px;"> Fisik Lemah,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('gangguan_mata', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="gangguan_mata" style="margin-left: 15px;"> Gangguan Mata,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('gangguan_telinga', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="gangguan_telinga" style="margin-left: 15px;"> Gangguan Telinga,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('gangguan_bicara', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="gangguan_bicara" style="margin-left: 15px;"> Gangguan Bicara,<br>
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('bahasa', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="bahasa"> Bahasa/Kognitif terbatas,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('budaya', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="budaya" style="margin-left: 15px;"> Budaya / Agama / Spiritual,
                <input type="checkbox" @if(isset($dokumen->catatan_edukasi_pasien))
                    {{ in_array('hambatan_edukasi', json_decode($dokumen->catatan_edukasi_pasien->hambatan_edukasi)) ? 'checked' : '' }} @endif  id="hambatan_edukasi" style="margin-left: 15px;"> lain-lain
                &nbsp; <input type="text" id="hambatan_edukasi_lainnya" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->hambatan_edukasi_lainnya : '' }}" style="border: 0px" placeholder="................................................">
            </td>
        </tr>
        <tr>
            <td colspan="1" style="width: 30%;">
                <p>7. Kesediaan Menerima Edukasi</p>
            </td>
            <td colspan="3" style="width: 70%;padding-left: 10px">
                <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->menerima_edukasi == "bersedia" ? 'checked' : "" : "" }} value="bersedia" name="radio_menerima_edukasi" class="ml-4"> Bersedia,
                <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->menerima_edukasi == "tidak bersedia" ? 'checked' : "" : "" }} value="tidak bersedia" name="radio_menerima_edukasi" class="ml-4"> Tidak Bersedia
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 50%;">
                <p class="pl-2 pt-2" style="font-weight: bold;">METODE EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "wawancara" ? 'checked' : "" : "" }} value="wawancara" name="radio_metode_edukasi"> Wawancara</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "diskusi" ? 'checked' : "" : "" }} value="diskusi" name="radio_metode_edukasi"> Diskusi</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "demonstrasi" ? 'checked' : "" : "" }} value="demonstrasi" name="radio_metode_edukasi"> Demonstrasi</li>
                    <li>
                        <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi == "edukasi_lain_lain" ? 'checked' : "" : "" }} value="edukasi_lain_lain" name="radio_metode_edukasi"> Lain-lain
                        <input type="text" id="metode_edukasi_lainnya" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->metode_edukasi_lainnya : '' }}" style="border: none; border-bottom:2px dotted;" placeholder="................................................">
                    </li>
                </ul>
            </td>
            <td colspan="2" style="width: 50%;">
                <p class="pl-2 pt-2" style="font-weight: bold;">SARANA EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "leaflet" ? 'checked' : "" : "" }} value="leaflet" name="radio_sarana_edukasi"> Leaflet</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "audiovisual" ? 'checked' : "" : "" }} value="audiovisual" name="radio_sarana_edukasi"> Audiovisual</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "lisan" ? 'checked' : "" : "" }} value="lisan" name="radio_sarana_edukasi"> Lisan</li>
                    <li>
                        <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == "lain_lain" ? 'checked' : "" : "" }} value="lain_lain" name="radio_sarana_edukasi"> Lain-lain
                        <input type="text" id="sarana_edukasi_lain" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi_lain : '' }}" style="border: none; border-bottom:2px dotted;" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->sarana_edukasi == 'lain_lain' ? '' : 'readonly' : 'readonly' }}>
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="pl-2 pt-2" style="font-weight: bold;">PENERIMA EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "pasien" ? 'checked' : "" : "" }} value="pasien" name="radio_penerima_edukasi"> Pasien</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "pasangan" ? 'checked' : "" : "" }} value="pasangan" name="radio_penerima_edukasi"> Pasangan (Suami/Istri)</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "orang_tua" ? 'checked' : "" : "" }} value="orang_tua" name="radio_penerima_edukasi"> Orang Tua</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "saudara_kandung" ? 'checked' : "" : "" }} value="saudara_kandung" name="radio_penerima_edukasi"> Saudara Kandung</li>
                    <li>
                        <input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == "lain_lain" ? 'checked' : "" : "" }} value="lain_lain" name="radio_penerima_edukasi"> Lain-lain
                        <input type="text" value="{{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi_lain : '' }}" id="penerima_edukasi_lain" style="border: none; border-bottom:2px dotted;" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->penerima_edukasi == 'lain_lain' ? '' : 'readonly' : 'readonly' }}>
                    </li>
                </ul>
            </td>
            <td colspan="2">
                <p class="pl-2 pt-2" style="font-weight: bold;">EVALUASI EDUKASI</p>
                <ul style="list-style-type: none; margin-left: -20px;">
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->evaluasi_edukasi == "re_edukasi" ? 'checked' : "" : "" }} value="re_edukasi" name="radio_evaluasi_edukasi"> Re - Edukasi</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->evaluasi_edukasi == "mengerti" ? 'checked' : "" : "" }} value="mengerti" name="radio_evaluasi_edukasi"> Sudah Mengerti</li>
                    <li><input type="radio" {{ $dokumen->catatan_edukasi_pasien ? $dokumen->catatan_edukasi_pasien->evaluasi_edukasi == "paham" ? 'checked' : "" : "" }} value="paham" name="radio_evaluasi_edukasi"> Sudah Paham</li>
                </ul>
            </td>
        </tr>
    </table>
    <table class="table_isian" id="tabel_topik" style="border-collapse:collapse; border: 1px solid; width: 100%;">
        <tr style="text-align: center; font-weight: bold;">
            <td>Tgl / Jam</td>
            <td>Topik Edukasi</td>
            <td>Hambatan Belajar</td>
            <td>Metode Edukasi</td>
            <td>Penerima Edukasi</td>
            <td>Sarana Edukasi</td>
            <td>Evaluasi Edukasi</td>
            <td>Ttd dan Nama Edukator</td>
            <td>Ttd dan Nama Penerima Edukasi</td>
            <td>KET / CAT</td>
        </tr>
        <tr>
            <td rowspan="9" style="text-align: center">
                {{ date('d-m-Y H:i', strtotime($dokumen->created_at)) }}
            </td>
            <td style="padding:10px;">1. Menjelaskan tentang kondisi medis, diagnosis pasti, tindakan kedokteran, indikasi tindakan, tujuan tindakan, resiko, komplikasi.</td>
            <td style="text-align: center;">
                <input type="number" id="hambatan_a" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[0] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="metode_a" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[1] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="penerima_a" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[2] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="sarana_a" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[3] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="evaluasi_a" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_a)[4] : "1" : "1" }}">
            </td>
            <td rowspan="9" style="text-align: center">
                @if($dokumen->id_verifikator != 0)
                    @if(isset($employee))
                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 2.5cm; width: 5cm;" alt="">
                    @else
                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 5cm;" alt="">
                    @endif
                    <br>{{$dokumen->nama_verifikator}}
                @endif
            </td>
            <td rowspan="9" style="text-align: center">
                @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                    <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}" style="height: 2.5cm; width: 5cm;" alt="">
                    <br><?php echo $dokumen->general_consent ? $dokumen->general_consent->nama : $dokumen->nama_pasien ?>
                @endif
            </td>
            <td rowspan="9">Edukasi <br>Poin 1 <br>s/d 4 <br>dilakukan<br> oleh DPJP</td>
        </tr>
        <tr>
            <td style="padding:10px;">2. Rencana pelayanan dan pengobatan pasien.</td>
            <td style="text-align: center;">
                <input type="number" id="hambatan_b" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[0] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="metode_b" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[1] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="penerima_b" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[2] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="sarana_b" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[3] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="evaluasi_b" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_b)[4] : "1" : "1" }}">
            </td>
        </tr>
        <tr>
            <td style="padding:10px;">3. Proses untuk mendapatkan persetujuan</td>
            <td style="text-align: center;">
                <input type="number" id="hambatan_c" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[0] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="metode_c" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[1] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="penerima_c" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[2] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="sarana_c" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[3] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="evaluasi_c" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_c)[4] : "1" : "1" }}">
            </td>
        </tr>
        <tr>
            <td style="padding:10px;">4. Hak Pasien dan Keluarga untuk berpartisipasi dalam keputusan pelayanan pasien.</td>
            <td style="text-align: center;">
                <input type="number" id="hambatan_d" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[0] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="metode_d" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[1] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="penerima_d" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[2] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="sarana_d" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[3] : "1" : "1" }}">
            </td>
            <td style="text-align: center;">
                <input type="number" id="evaluasi_d" min="1" max="4" value="{{ $dokumen->catatan_edukasi_pasien ?
                $dokumen->catatan_edukasi_pasien->topik_edukasi_a ?
                json_decode($dokumen->catatan_edukasi_pasien->topik_edukasi_d)[4] : "1" : "1" }}">
            </td>
        </tr>
    </table>
</div>
<div class="row pt-5" style="width:100%; margin-left:0">
    <div class="col-md-12 text-center">
        <button onclick="submit_form()" class="btn btn-success">Simpan</button>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4" onclick="open_modal_petugas()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Edukator</h5>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-4" onclick="open_modal_pasien()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Penerima Edukasi</h5>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/rekam_medis/pdf_catatan_edukasi_pasien?dokumen='.$dokumen->id) }}" class="btn btn-success" target="_blank">Download PDF</a>
        @endif
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    let additional_topik = [{
        'topik' : '',
        'hambatan' : '1',
        'metode' : '1',
        'penerima' : '1',
        'sarana' : '1',
        'evaluasi' : '1',
    },{
        'topik' : '',
        'hambatan' : '1',
        'metode' : '1',
        'penerima' : '1',
        'sarana' : '1',
        'evaluasi' : '1',
    },{
        'topik' : '',
        'hambatan' : '1',
        'metode' : '1',
        'penerima' : '1',
        'sarana' : '1',
        'evaluasi' : '1',
    },{
        'topik' : '',
        'hambatan' : '1',
        'metode' : '1',
        'penerima' : '1',
        'sarana' : '1',
        'evaluasi' : '1',
    },{
        'topik' : '',
        'hambatan' : '1',
        'metode' : '1',
        'penerima' : '1',
        'sarana' : '1',
        'evaluasi' : '1',
    }];

    $('[name=radio_sarana_edukasi]').change(function(){
        if ($('[name=radio_sarana_edukasi]:checked').val() == 'lain_lain') {
            $('#sarana_lain').removeAttr('readonly');
            return;
        }
        $('#sarana_lain').attr('readonly', true);
        $('#sarana_lain').val('');
    })

    $('[name=radio_penerima_edukasi]').change(function(){
        if ($('[name=radio_penerima_edukasi]:checked').val() == 'lain_lain') {
            $('#penerima_edukasi_lain').removeAttr('readonly');
            return;
        }
        $('#penerima_edukasi_lain').attr('readonly', true);
        $('#penerima_edukasi_lain').val('');
    })

    $(document).ready(function() {
        var verif = '{{$dokumen->id_verifikator}}';
        if (verif != 0) {
            window.scrollTo({
                left: 0,
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        }
        <?php 
        if(isset($dokumen->catatan_edukasi_pasien)){
            if($dokumen->catatan_edukasi_pasien->additional_topik != ''){
        ?>
        additional_topik = <?php echo $dokumen->catatan_edukasi_pasien->additional_topik ?>;
        <?php
        }}
        ?>
        render_additional_topik();
    })

    function render_additional_topik(){
        var ins = '';
        for (let i = 0; i < additional_topik.length; i++) {
            ins += '<tr style="line-height:14px;">'+
                '<td class="p-2"><textarea type="text" style="width:100%; line-height:25px;" rows="2" id="topik_'+i+'">'+additional_topik[i].topik+'</textarea></td>'+
                '<td class="p-2" style="text-align:center;"><input type="number" min="1" max="4" value="'+additional_topik[i].hambatan+'" id="hambatan_'+i+'" /></td>'+
                '<td class="p-2" style="text-align:center;"><input type="number" min="1" max="4" value="'+additional_topik[i].metode+'" id="metode_'+i+'" /></td>'+
                '<td class="p-2" style="text-align:center;"><input type="number" min="1" max="4" value="'+additional_topik[i].penerima+'" id="penerima_'+i+'" /></td>'+
                '<td class="p-2" style="text-align:center;"><input type="number" min="1" max="4" value="'+additional_topik[i].sarana+'" id="sarana_'+i+'" /></td>'+
                '<td class="p-2" style="text-align:center;"><input type="number" min="1" max="4" value="'+additional_topik[i].evaluasi+'" id="evaluasi_'+i+'" /></td>'+
                '</tr>';
        }
        $('#tabel_topik').append(ins);
        console.log(additional_topik);
    }

    function submit_form() {
        console.log(additional_topik);
        for (let i = 0; i < additional_topik.length; i++) {
            additional_topik[i].topik = $('#topik_'+i).val();
            additional_topik[i].hambatan = $('#hambatan_'+i).val();
            additional_topik[i].metode = $('#metode_'+i).val();
            additional_topik[i].penerima = $('#penerima_'+i).val();
            additional_topik[i].sarana = $('#sarana_'+i).val();
            additional_topik[i].evaluasi = $('#evaluasi_'+i).val();
        }
        $('#hide_additional_topik').val(JSON.stringify(additional_topik));
        $('#form_catatan_edukasi').submit();
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

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }

    function cek_form_ttd() {
        var bahasa = [];
        if ($("#indonesia").is(":checked")) {
            bahasa.push('Indonesia');
        }
        if ($("#daerah").is(":checked")) {
            bahasa.push('Daerah');
        }
        if ($("#lainnya").is(":checked")) {
            bahasa.push('Lainnya');
        }

        var pendidikan = [];
        if ($("#sd").is(":checked")) {
            pendidikan.push('sd');
        }
        if ($("#smp").is(":checked")) {
            pendidikan.push('smp');
        }
        if ($("#sma").is(":checked")) {
            pendidikan.push('sma');
        }
        if ($("#d1").is(":checked")) {
            pendidikan.push('d1');
        }
        if ($("#s1").is(":checked")) {
            pendidikan.push('s1');
        }
        if ($("#pendidikan").is(":checked")) {
            pendidikan.push('pendidikan');
        }

        var pembelajaran = [];
        if ($("#Verbal").is(":checked")) {
            pembelajaran.push('Verbal');
        }
        if ($("#Tulis").is(":checked")) {
            pembelajaran.push('Tulis');
        }
        if ($("#Demonstrasi").is(":checked")) {
            pembelajaran.push('Demonstrasi');
        }
        if ($("#Pembelajaran").is(":checked")) {
            pembelajaran.push('Pembelajaran');
        }

        var hambatan_edukasi = [];
        if ($("#tidak_ada").is(":checked")) {
            hambatan_edukasi.push('tidak_ada');
        }
        if ($("#emosional").is(":checked")) {
            hambatan_edukasi.push('emosional');
        }
        if ($("#fisik_lemah").is(":checked")) {
            hambatan_edukasi.push('fisik_lemah');
        }
        if ($("#gangguan_mata").is(":checked")) {
            hambatan_edukasi.push('gangguan_mata');
        }
        if ($("#gangguan_telinga").is(":checked")) {
            hambatan_edukasi.push('gangguan_telinga');
        }
        if ($("#gangguan_bicara").is(":checked")) {
            hambatan_edukasi.push('gangguan_bicara');
        }
        if ($("#bahasa").is(":checked")) {
            hambatan_edukasi.push('bahasa');
        }
        if ($("#budaya").is(":checked")) {
            hambatan_edukasi.push('budaya');
        }
        if ($("#hambatan_edukasi").is(":checked")) {
            hambatan_edukasi.push('hambatan_edukasi');
        }

        var topik_a = [];
        topik_a.push($('#hambatan_a').val());
        topik_a.push($('#metode_a').val());
        topik_a.push($('#penerima_a').val());
        topik_a.push($('#sarana_a').val());
        topik_a.push($('#evaluasi_a').val());

        var topik_b = [];
        topik_b.push($('#hambatan_b').val());
        topik_b.push($('#metode_b').val());
        topik_b.push($('#penerima_b').val());
        topik_b.push($('#sarana_b').val());
        topik_b.push($('#evaluasi_b').val());

        var topik_c = [];
        topik_c.push($('#hambatan_c').val());
        topik_c.push($('#metode_c').val());
        topik_c.push($('#penerima_c').val());
        topik_c.push($('#sarana_c').val());
        topik_c.push($('#evaluasi_c').val());

        var topik_d = [];
        topik_d.push($('#hambatan_d').val());
        topik_d.push($('#metode_d').val());
        topik_d.push($('#penerima_d').val());
        topik_d.push($('#sarana_d').val());
        topik_d.push($('#evaluasi_d').val());

        var topik_e = [];
        topik_e.push($('#hambatan_e').val());
        topik_e.push($('#metode_e').val());
        topik_e.push($('#penerima_e').val());
        topik_e.push($('#sarana_e').val());
        topik_e.push($('#evaluasi_e').val());

        $('#hide_bahasa').val(JSON.stringify(bahasa));
        $('#hide_bahasa_lainnya').val($('#bahasa_lainnya').val());
        $('#hide_penerjemah').val($('[name="kebutuhan_penerjemah"]:checked').val());
        $('#hide_penerjemah_lainnya').val($("#penerjemah_lainnya").val());
        $('#hide_pendidikan').val(JSON.stringify(pendidikan));
        $('#hide_pendidikan_lainnya').val($('#pendidikan_lainnya').val());
        $('#hide_baca_tulis').val($('[name="radio_baca_tulis"]:checked').val());
        $('#hide_pembelajaran').val(JSON.stringify(pembelajaran));
        $('#hide_pembelajaran_lainnya').val($('#pemsbelajaran_lainnya').val());
        $('#hide_hambatan_edukasi').val(JSON.stringify(hambatan_edukasi));
        $('#hide_hambatan_edukasi_lainnya').val($('#hambatan_edukasi_lainnya').val());
        $('#hide_menerima_edukasi').val($('[name="radio_menerima_edukasi"]:checked').val());
        $('#hide_metode_edukasi').val($('[name="radio_metode_edukasi"]:checked').val());
        $('#hide_metode_edukasi_lainnya').val($('#metode_edukasi_lainnya').val());
        $('#hide_evaluasi_edukasi').val($('[name="radio_evaluasi_edukasi"]:checked').val());
        $('#hide_topik_edukasi_a').val(JSON.stringify(topik_a));
        $('#hide_topik_edukasi_b').val(JSON.stringify(topik_b));
        $('#hide_topik_edukasi_c').val(JSON.stringify(topik_c));
        $('#hide_topik_edukasi_d').val(JSON.stringify(topik_d));
        $('#hide_topik_edukasi_e').val(JSON.stringify(topik_e));

        $('#hide_sarana_edukasi').val($('[name=radio_sarana_edukasi]:checked').val() != undefined ? $('[name=radio_sarana_edukasi]:checked').val() : '');
        $('#hide_sarana_edukasi_lain').val($('#sarana_edukasi_lain').val());
        $('#hide_penerima_edukasi').val($('[name=radio_penerima_edukasi]:checked').val() != undefined ? $('[name=radio_penerima_edukasi]:checked').val() : '');
        $('#hide_penerima_edukasi_lain').val($('#penerima_edukasi_lain').val());

        return true;
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

</html>
