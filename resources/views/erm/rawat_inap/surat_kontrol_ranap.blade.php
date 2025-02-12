{{-- pending dluu --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Kontrol Ranap</title>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <style type="text/css">
        input{
            border: hidden;
            border-bottom: 1px dotted;   
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
    </style>
    
</head>

<body style="margin: 20px;">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @endif
    @if (Session::has('gagal'))
    <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
    @endif
    @if (Session::has('sukses'))
    <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    
    <!-- Header -->
    <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
        <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" onsubmit="return cek_form(this)" action="{{ url('e_rekam_medis/detail/save_surat_kontrol_rawat_inap') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" id="hide_resume" name="resume">
                        <input type="hidden" id="hide_radio_resume" name="radio_resume">
                        <input type="hidden" id="hide_tgl_kontrol" name="tgl_kontrol">
                        <input type="hidden" id="hide_jam_kontrol" name="jam_kontrol">
                        <input type="hidden" id="hide_nama_dokter" name="nama_dokter">
                        <input type="hidden" id="hide_radio_kontrol" name="radio_kontrol">
                        <input type="hidden" id="hide_alasan_istirahat" name="alasan_istirahat">
                        <input type="hidden" id="hide_radio_dokter" name="radio_dokter">
                        <input type="hidden" id="hide_no_rad" name="no_rad">
                        <input type="hidden" id="hide_rad" name="rad">
                        <input type="hidden" id="hide_radio_rad" name="radio_rad">
                        <input type="hidden" id="hide_lab" name="lab">
                        <input type="hidden" id="hide_radio_lab" name="radio_lab">
                        <input type="hidden" id="hide_terapi" name="terapi">
                        <input type="hidden" id="hide_radio_terapi" name="radio_terapi">
                        <input type="hidden" id="hide_diagnosa" name="diagnosa">
                        <input type="hidden" id="hide_tinggi_badan" name="tinggi_badan">
                        <input type="hidden" id="hide_berat_badan" name="berat_badan">
                        <input type="hidden" id="hide_surat_konsul" name="surat_konsul">
                        <input type="hidden" id="hide_radio_konsul" name="radio_konsul">
                        <input type="hidden" id="hide_surat_jawaban_konsul" name="surat_jawaban_konsul">
                        <input type="hidden" id="hide_radio_jawaban_konsul" name="radio_jawaban_konsul">
                        <input type="hidden" id="hide_surat_kematian" name="surat_kematian">
                        <input type="hidden" id="hide_radio_kematian" name="radio_kematian">
                        <input type="hidden" id="hide_asuransi" name="asuransi">
                        <input type="hidden" id="hide_radio_asuransi" name="radio_asuransi">
                        <input type="hidden" id="hide_tgl_dokumen" name="tgl_dokumen">
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

        <div class="col-md-6" style="border: 1px solid;">
            <div class="row" style="width: 100%;">
                <div class="col-md-3" style="">
                    <img id="logo_rshm" src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
                </div>
                <div class="col-md-9" style="margin-top: 10px">
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
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-left: 0; border:1px solid; padding:10px;">
            <table>
                <tr>
                    <td>Nama</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->nama }}</td>
                </tr>
                <tr>
                    <td>No. RM</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->id }}</td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->ktp }}</td>
                </tr>
            </table>
        </div>
    </div>
    <!-- End Of Header -->
    
    <!-- isian -->
    <div style="margin-top: -17px;">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center" style="background: black; padding-top: 5px;">
                <h6 class="text-white">SURAT KONTROL</h6>
            </div>
        </div>
        
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12" style="padding-top: 5px; border: 1px solid;">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-10">
                                    <ol>
                                        <li><strong>RESUME</strong>
                                            <p>Serahkan pada saat kontrol / untuk diserahkan kepada instansi yang bersangkutan.</p>
                                            <p style="margin-top: -15px;">Bila tidak ada, alasan : 
                                                <input type="text" id="resume" value="{{ $data ? $data->resume : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 80%;">
                                            </p>
                                        </li>
                                    </ol>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div style="text-align: center;">
                                        Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_resume == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_resume" value="ya">
                                        Tidak <input class="ml-1" {{ $data ? ($data->radio_resume == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_resume" value="tidak">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-10">
                                    <ol start="2">
                                        <li><strong>SURAT KETERANGAN KONTROL</strong>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p>
                                                        Tanggal Kontrol : 
                                                        <input type="text" id="tgl_kontrol" class="tanggal_dmy" value="{{ $data ? $data->tgl_kontrol : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 60%;">
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    {{-- timepicker format 24 jam --}}
                                                    <p>
                                                        Jam: 
                                                        <input type="text" id="jam_kontrol" class="waktu_24" value="{{ $data ? $data->jam_kontrol : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 70%;"> WIB
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p>
                                                        Pada Dokter: 
                                                        <input type="text" id="nama_dokter" value="{{ $data ? $data->nama_dokter : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 70%;">
                                                    </p>
                                                </div>
                                            </div>
                                            <p style="margin-top: -15px;">Serahkan keterangan tersebut pada rumah sakit harapan mulia</p>
                                        </li>
                                    </ol>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div style="text-align: center;">
                                        Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_kontrol == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_kontrol" value="ya">
                                        Tidak <input class="ml-1" {{ $data ? ($data->radio_kontrol == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_kontrol" value="tidak">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-10">
                                    <ol start="3">
                                        <li><strong>SURAT KETERANGAN DOKTER (Ketrangan Rawat / Istirahat)</strong>
                                            <p>Bila tidak ada, alasan : <input type="text" id="alasan_istirahat" value="{{ $data ? $data->alasan_istirahat : '' }}" style="width: 80%;"></p>
                                        </li>
                                    </ol>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div style="text-align: center;">
                                        Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_dokter == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_dokter" value="ya">
                                        Tidak <input class="ml-1" {{ $data ? ($data->radio_dokter == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_dokter" value="tidak">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-10">
                                    <ol start="4">
                                        <li><strong>HASIL RADIOLOGI</strong></li>
                                        <p>No. Radiologi : <input type="text" id="no_rad" value="{{ $data ? $data->no_rad : '' }}" style="width: 80%;"></p>
                                        <p style="margin-top: -15px;">Jenis Pemeriksaan : <input type="text" id="rad" value="{{ $data ? $data->rad : '' }}" style="width: 80%;"></p>
                                    </ol>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div style="text-align: center;">
                                        Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_rad == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_rad" value="ya">
                                        Tidak <input class="ml-1" {{ $data ? ($data->radio_rad == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_rad" value="tidak">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-10">
                                    <ol start="5">
                                        <li><strong>HASIL LABORATORIUM</strong></li>
                                        <p>Jenis Pemeriksaan : <input type="text" id="lab" value="{{ $data ? $data->lab : '' }}" style="width: 80%;"></p>
                                    </ol>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div style="text-align: center;">
                                        Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_lab == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_lab" value="ya">
                                        Tidak <input class="ml-1" {{ $data ? ($data->radio_lab == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_lab" value="tidak">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-10">
                                    <ol start="6">
                                        <li><strong>OBAT - OBATAN</strong></li>
                                        <div style="display: flex; align-items: center;">
                                            <p style="margin-right: 10px; margin-top: -35px;">Jenis Obat dan Dosis :</p>
                                            <textarea id="terapi" class="form-control" style="border: 1px dotted; width: 80%; height: 80px; resize: none;">{{ $data ? $data->terapi : '' }}</textarea>
                                        </div>
                                    </ol>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div style="text-align: center;">
                                        Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_terapi == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_terapi" value="ya">
                                        Tidak <input class="ml-1" {{ $data ? ($data->radio_terapi == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_terapi" value="tidak">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <ol start="7">
                                        <li><strong>DIAGNOSA : </strong> <input type="text" id="diagnosa" value="{{ $data ? $data->diagnosa : '' }}" style="border: none; border-bottom: 1px dotted; width: 80%;"></li>
                                        <p style="margin-top: 5px;">Tinggi Badan : <input type="text" id="tinggi_badan" value="{{ $data ? $data->tinggi_badan : '' }}" style="border: hidden; border-bottom: 1px dotted;"> Cm</p>
                                        <p style="margin-top: -10px;">Berat Badan : <input type="text" id="berat_badan" value="{{ $data ? $data->berat_badan : '' }}" style="border: hidden; border-bottom: 1px dotted;"> Kg</p>
                                        {{-- <p><strong>LAIN - LAIN</strong></p> --}}
                                        <div>
                                            <p><strong>LAIN - LAIN</strong></p>
                                            <div class="row" style="width: 98%">
                                                <div class="col-auto">a. Surat Konsul Ditujukan : </div>
                                                <div class="col">
                                                    <input type="text" style="border: none; border-bottom: 1px dotted; width: 100%" id="surat_konsul" value="{{ $data ? $data->surat_konsul : '' }}">
                                                </div>
                                                <div class="col-auto">
                                                    Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_konsul == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_konsul" value="ya">
                                                    Tidak <input class="ml-1" {{ $data ? ($data->radio_konsul == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_konsul" value="tidak">
                                                </div>
                                            </div>
                                            <div class="row" style="width: 98%">
                                                <div class="col-auto">b. Surat Jawaban Konsul Ditujukan : </div>
                                                <div class="col">
                                                    <input type="text" style="border: none; border-bottom: 1px dotted; width: 100%" id="surat_jawaban_konsul" value="{{ $data ? $data->surat_jawaban_konsul : '' }}">
                                                </div>
                                                <div class="col-auto">
                                                    Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_jawaban_konsul == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_jawaban_konsul" value="ya">
                                                    Tidak <input class="ml-1" {{ $data ? ($data->radio_jawaban_konsul == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_jawaban_konsul" value="tidak">
                                                </div>
                                            </div>
                                            <div class="row" style="width: 98%">
                                                <div class="col-auto">c. Surat Kematian : </div>
                                                <div class="col">
                                                    <input type="text" style="border: none; border-bottom: 1px dotted; width: 100%" id="surat_kematian" value="{{ $data ? $data->surat_kematian : '' }}">
                                                </div>
                                                <div class="col-auto">
                                                    Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_kematian == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_kematian" value="ya">
                                                    Tidak <input class="ml-1" {{ $data ? ($data->radio_kematian == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_kematian" value="tidak">
                                                </div>
                                            </div>
                                            <div class="row" style="width: 98%">
                                                <div class="col-auto">d. Asuransi : </div>
                                                <div class="col">
                                                    <input type="text" style="border: none; border-bottom: 1px dotted; width: 100%" id="asuransi" value="{{ $data ? $data->asuransi : '' }}">
                                                </div>
                                                <div class="col-auto">
                                                    Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_asuransi == "ya" ? 'checked' : '') : '' }} type="radio" id="radio_asuransi" value="ya">
                                                    Tidak <input class="ml-1" {{ $data ? ($data->radio_asuransi == "tidak" ? 'checked' : '') : '' }} type="radio" id="radio_asuransi" value="tidak">
                                                </div>
                                            </div>
                                        </div>
                                    </ol>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="row text-center pt-5 mb-3">
                    <div class="col-6">
                        <table style="width: 100%;">
                            <tr>
                                <td colspan="6">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    Petugas
                                </td>
                            </tr>
                            {{-- sign petugas darah O.S --}}
                            <tr>
                                <td colspan="6">
                                    <div onclick="open_modal_petugas()">
                                        @if($dokumen->id_verifikator == 0)
                                            <br>
                                            Simpan & Verifikasi
                                            <br>
                                            <br>
                                            (.................................................)
                                            <br>
                                            Ttd & Nama Terang
                                        @else
                                            @if(isset($employee))
                                                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                                        style="height: 2.5cm; width: 4cm;" alt="">
                                            @else
                                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                                            @endif
                                            <br>({{$dokumen->nama_verifikator}})
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table style="width: 100%;">
                            <tr>
                                <td colspan="6">
                                    Bekasi, <input type="text" id="tgl_dokumen" class="tanggal_dmy" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->tgl_dokumen : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    Pasien/keluarga
                                </td>
                            </tr>
                            {{-- sign dokter --}}
                            <tr>
                                <td colspan="6">
                                    <div onclick="open_modal_pasien()" id="box_ttd_pasien">
                                        @if(is_null($dokumen) || is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                                        <br>
                                        Klik Disini
                                        <br>
                                        <br>
                                        (.................................................)
                                        <br>
                                        Ttd & Nama Terang
                                        @else
                                        @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                                        <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}" style="height: 2.5cm; width: 4cm;" alt="">
                                        @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                                        @endif
                                        <br>({{ $dokumen->nama_pasien }})
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Of isian -->
    
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    var verif = '{{ $data ? true : false }}';
    
    $("#nama_dokter").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_dokter') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function (suggestion) {
            console.log(suggestion);
            $("#nama_dokter").val(suggestion.nama);
        }
    });

    $("#diagnosa").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function (suggestion) {
            console.log(suggestion);
            $("#diagnosa").val(suggestion.icd+' - '+suggestion.nama);
        }
    });

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
        setUmur();
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
    
    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        if (!verif) {
            alert('Dokumen Belum Diverifikasi')
        } else {
            $('#modal_pasien').modal('show');
        }
    }

    function cek_form() {
        $('#hide_resume').val($('#resume').val());
        $('#hide_radio_resume').val($('#radio_resume').val());
        $('#hide_tgl_kontrol').val($('#tgl_kontrol').val());
        $('#hide_jam_kontrol').val($('#jam_kontrol').val());
        $('#hide_nama_dokter').val($('#nama_dokter').val());
        $('#hide_radio_kontrol').val($('#radio_kontrol').val());
        $('#hide_alasan_istirahat').val($('#alasan_istirahat').val());
        $('#hide_radio_dokter').val($('#radio_dokter').val());
        $('#hide_no_rad').val($('#no_rad').val());
        $('#hide_rad').val($('#rad').val());
        $('#hide_radio_rad').val($('#radio_rad').val());
        $('#hide_lab').val($('#lab').val());
        $('#hide_radio_lab').val($('#radio_lab').val());
        $('#hide_terapi').val($('#terapi').val());
        $('#hide_radio_terapi').val($('#radio_terapi').val());
        $('#hide_diagnosa').val($('#diagnosa').val());
        $('#hide_tinggi_badan').val($('#tinggi_badan').val());
        $('#hide_berat_badan').val($('#berat_badan').val());
        $('#hide_surat_konsul').val($('#surat_konsul').val());
        $('#hide_radio_konsul').val($('#radio_konsul').val());
        $('#hide_surat_jawaban_konsul').val($('#surat_jawaban_konsul').val());
        $('#hide_radio_jawaban_konsul').val($('#radio_jawaban_konsul').val());
        $('#hide_surat_kematian').val($('#surat_kematian').val());
        $('#hide_radio_kematian').val($('#radio_kematian').val());
        $('#hide_asuransi').val($('#asuransi').val());
        $('#hide_radio_asuransi').val($('#radio_asuransi').val());
        $('#hide_tgl_dokumen').val($('#tgl_dokumen').val());

        return true;
    }
</script>

</html>
