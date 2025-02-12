<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Orientasi Pasien Baru</title>

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
      action="{{ url('e_rekam_medis/rekam_medis/save_dokumen_orientasi_pasien_baru') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type='hidden' id='hide_tanggal' name='tanggal'>
    <input type='hidden' id='hide_satu' name='satu'>
    <input type='hidden' id='hide_dua' name='dua'>
    <input type='hidden' id='hide_tiga' name='tiga'>
    <input type='hidden' id='hide_empat' name='empat'>
    <input type='hidden' id='hide_lima' name='lima'>
    <input type='hidden' id='hide_enam' name='enam'>
    <input type='hidden' id='hide_tujuh_satu' name='tujuh_satu'>
    <input type='hidden' id='hide_tujuh_dua' name='tujuh_dua'>
    <input type='hidden' id='hide_tujuh_tiga' name='tujuh_tiga'>
    <input type='hidden' id='hide_pemahaman' name='pemahaman'>
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
            <h6 style="color: white">ORIENTASI PENERIMAAN PASIEN BARU</h6>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0; border: 1px solid">
        <div class="col-md-12">
            Tanggal : 
            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tanggal"
                        value="@if(old('tanggal')){{ old('tanggal') }}@else{{ $dokumen->dokumen_orientasi_pasien_baru ? $dokumen->dokumen_orientasi_pasien_baru->tanggal : '' }}@endif">
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%;" class="table_isian_bordered">
            <tr style="text-align: center">
                <td>
                    <b>NO</b>
                </td>
                <td>
                    <b>Keterangan Edukasi</b>
                </td>
                <td>
                    <b>Ya</b>
                </td>
                <td>
                    <b>Tidak</b>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 5%">1</td>
                <td style="width: 65%">
                    Perawat memperkenalkan dirinya dan menanyakan nama lengkap dan tanggal lahir 
                    pasien serta mencocokkannya dengan status rekam medis pasien, gelang pasien dan memperkenalkan
                    kepada pasien yang lain yang berada di ruangan tersebut, bila ada
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('satu'))
                               {{ old('satu') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->satu == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_satu">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('satu'))
                               {{ old('satu') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->satu == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_satu">
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 5%">2</td>
                <td style="width: 65%">
                    Mengenalkan perawat koordinator dan dokter jaga ruangan perawatan, Dokter Penanggung
                    Jawab Pelayanan serta dokter yang merawat pasien
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('dua'))
                               {{ old('dua') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->dua == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_dua">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('dua'))
                               {{ old('dua') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->dua == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_dua">
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 5%">3</td>
                <td style="width: 65%">
                    Ingatkan pasien bahwa Rumah Sakit tidak bertanggung jawab atas kehilangan dan kerusakan
                    barang-barang berharga.
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tiga'))
                               {{ old('tiga') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tiga == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_tiga">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tiga'))
                               {{ old('tiga') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tiga == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_tiga">
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 5%">4</td>
                <td style="width: 65%">
                    Orientasi Lingkungan rumah sakit mengenai :
                    <br>
                    <ul>
                        <li>Nurse Call System, Toilet emergency call</li>
                        <li>Waktu pemberian makan</li>
                        <li>Jam kunjung Pagi & Sore</li>
                        <li>Cara mengatur tempat tidur, lampu, air panas</li>
                        <li>Penggunaan telepon/televisi/kulkas</li>
                        <li>Jalur Evakuasi</li>
                    </ul>
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('empat'))
                               {{ old('empat') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->empat == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_empat">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('empat'))
                               {{ old('empat') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->empat == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_empat">
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 5%">5</td>
                <td style="width: 65%">
                    Menanyakan kebutuhan privasi pasien
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('lima'))
                               {{ old('lima') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->lima == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_lima">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('lima'))
                               {{ old('lima') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->lima == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_lima">
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 5%">6</td>
                <td style="width: 65%">
                    Edukasi pasien agar melapor ke perawat / bidan / Dokter jaga jika pasien mengalami
                    penurunan kondisi seperti : selalu tidur pulas, sulit dibangunkan, makin sesak, makin nyeri,
                    dan lain-lain.
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('enam'))
                               {{ old('enam') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->enam == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_enam">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('enam'))
                               {{ old('enam') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->enam == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_enam">
                </td>
            </tr>
            <tr>
                <td rowspan="3" style="text-align: center; width: 5%">7</td>
                <td style="width: 65%">
                    Pada pasien anak, orang tua atau pasien dengan kesadaran kurang, harap memasang pengaman
                    tempat tidur
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tujuh_satu'))
                               {{ old('tujuh_satu') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_satu == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_tujuh_satu">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tujuh_satu'))
                               {{ old('tujuh_satu') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_satu == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_tujuh_satu">
                </td>
            </tr>
            <tr>
                <td style="width: 65%">
                    Jumlah penunggu pasien di ruangan maksimal 1 orang
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tujuh_dua'))
                               {{ old('tujuh_dua') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_dua == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_tujuh_dua">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tujuh_dua'))
                               {{ old('tujuh_dua') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_dua == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_tujuh_dua">
                </td>
            </tr>
            <tr>
                <td style="width: 65%">
                    Pengunjung pasien hanya bisa mengunjungi pada jam kunjung atau atas izin dari perawat atau bidan jaga
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tujuh_tiga'))
                               {{ old('tujuh_tiga') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_tiga == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_tujuh_tiga">
                </td>
                <td style="width: 15%; text-align: center">
                    <input @if(old('tujuh_tiga'))
                               {{ old('tujuh_tiga') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->tujuh_tiga == 'tidak' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak" name="radio_tujuh_tiga">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border-bottom: hidden">
                <td colspan="2">
                    Pasien / Keluarga (
                    <input @if(old('pemahaman'))
                               {{ old('pemahaman') ==  'memahami' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->pemahaman == 'memahami' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="memahami" name="radio_pemahaman"> memahami / 
                    <input @if(old('pemahaman'))
                               {{ old('pemahaman') ==  'tidak_memahami' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_orientasi_pasien_baru ? ($dokumen->dokumen_orientasi_pasien_baru->pemahaman == 'tidak_memahami' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tidak_memahami" name="radio_pemahaman"> tidak memahami )
                    orientasi ruangan yang telah diberikan
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td style="width: 50%; text-align: center">
                    <br>
                    Nama & Tanda tangan Perawat/Bidan
                    <br>
                    @if($dokumen->id_verifikator == 0)
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
                <td style="width: 50%; text-align: center">
                    <br>
                    Nama & Tanda tangan Pasien/Keluarga
                    <br>
                    @if(is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.................................................)
                        <br>Ttd & Nama Terang
                    @else
                        @if(!is_null($dokumen->signature_pasien) || $dokumen->signature_pasien != "")
                            <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_pasien}})
                        
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row pt-5" style="width:100%; margin-left:0">
    <div class="col-md-1"></div>
    <div class="col-md-4" onclick="open_modal_petugas()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Perawat / Bidan</h5>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-4" onclick="open_modal_pasien()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Pasien / Keluarga</h5>
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
            <a href="{{ url('e_rekam_medis/rekam_medis/pdf_dokumen_orientasi_pasien_baru?dokumen='.$dokumen->id) }}"
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
        $('#hide_tanggal').val($("#tanggal").val());
        $('#hide_satu').val($('[name="radio_satu"]:checked').val());
        $('#hide_dua').val($('[name="radio_dua"]:checked').val());
        $('#hide_tiga').val($('[name="radio_tiga"]:checked').val());
        $('#hide_empat').val($('[name="radio_empat"]:checked').val());
        $('#hide_lima').val($('[name="radio_lima"]:checked').val());
        $('#hide_enam').val($('[name="radio_enam"]:checked').val());
        $('#hide_tujuh_satu').val($('[name="radio_tujuh_satu"]:checked').val());
        $('#hide_tujuh_dua').val($('[name="radio_tujuh_dua"]:checked').val());
        $('#hide_tujuh_tiga').val($('[name="radio_tujuh_tiga"]:checked').val());
        $('#hide_pemahaman').val($('[name="radio_pemahaman"]:checked').val());

        return true;
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
</script>

</html>
