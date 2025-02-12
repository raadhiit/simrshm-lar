<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" type="text/css" href="//keith-wood.name/css/jquery.signature.css"> -->
</head>

<body class="container">
    @if (Session::get('sukses'))
        <script>
            alert('{{ Session::get('sukses') }}')
        </script>
    @endif
    @if (Session::get('gagal'))
        <script>
            alert('{{ Session::get('gagal') }}')
        </script>
    @endif
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
                <form method="post" onclick="cek_data_informasi()"
                    action="{{ url('e_rekam_medis/pendaftaran/detail/verifikasi_petugas') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen }}">
                    <input type="hidden" id="hide_identitas_pasien" name="identitas_pasien">
                    <input type="hidden" id="hide_nomer_identitas" name="nomer_identitas">
                    <input type="hidden" id="hide_kebangsaan" name="kebangsaan">
                    <input type="hidden" id="hide_nama_wali" name="nama_wali">
                    <input type="hidden" id="hide_hubungan_wali" name="hubungan_wali">
                    <input type="hidden" id="hide_alamat_wali" name="alamat_wali">
                    <input type="hidden" id="hide_telpon" name="telpon">
                    <input type="hidden" id="hide_suku" name="suku">
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
    <div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="return cek_persetujuan(this)"
                    action="{{ url('e_rekam_medis/pendaftaran/detail/upload_ttd_pasien') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{ $dokumen }}">
                        <label>Nama Pasien / Keluarga</label>
                        <input type="text" class="form-control" id="form_nama_pasien" name="nama_pasien">
                        <br>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400
                                    height=200></canvas>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" id="clear" class="btn btn-danger btn-sm">Clear
                                    Signature</button>
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
                    <td>{{ $pasien->nama }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">No Rekam Medis</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->nrm }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Tgl Lahir</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis Kelamin</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row pb-5" style="width:100%; margin-left: 0;">
        <div style="width: 100%;" class="container pt-2">
            <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
                <tr>
                    <td style="width: 20%;">NO REKAM MEDIS</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->nrm }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Medical Record Number</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Identitas Pasien</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">
                        <input type="radio"
                            {{ $persetujuan ? $persetujuan->identitas == 'ktp' ? 'checked' : '' : 'checked' }}
                            value="ktp" name="pilihan_identitas_pasien"> KTP
                        <input type="radio"
                            {{ $persetujuan ? $persetujuan->identitas == 'sim' ? 'checked' : '' : '' }}
                            value="sim" name="pilihan_identitas_pasien" class="ml-4"> SIM
                        <input type="radio"
                            {{ $persetujuan ? $persetujuan->identitas == 'passport' ? 'checked' : '' : '' }}
                            value="passport" name="pilihan_identitas_pasien" class="ml-4"> Passport
                        <input type="radio"
                            {{ $persetujuan ? $persetujuan->identitas == 'lainnya' ? 'checked' : '' : '' }}
                            value="lainnya" name="pilihan_identitas_pasien" class="ml-4"> Lainnya
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Identity Patient</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">No Identitas</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">
                        <input type="text"
                            value="{{ $persetujuan ? $persetujuan->nomer_identitas : ($pasien ? $pasien->ktp : '') }}"
                            class="form-control" id="nomer_identitas" style="border: 0px">
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Identity Number</i></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
            <h6 style="color: white">FORMULIR PENDAFTARAN PASIEN BARU</h6>
        </div>
    </div>
    <div class="row pb-5" style="width:100%; margin-left: 0;">
        <div style="width: 100%;" class="container pb-3 pt-2">
            <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
                <tr>
                    <td style="width: 20%;">Nama Pasien</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->nama }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Patient Name</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Jenis Kelamin</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 75%; border-bottom: 2px dotted;">
                        <div style="display:inline-flex; align-items: center;">
                            <div class="mr-2"
                                style="width:13px; height:13px; border:1px solid; font-size: 10px; text-align:center;">
                                @if ($pasien->kelamin == 0)
                                    &#10004;
                                @endif
                            </div>
                            Laki-Laki
                            <div class="ml-4 mr-2"
                                style="width:13px; height:13px; border:1px solid; font-size: 10px;">
                                @if ($pasien->kelamin == 1)
                                    &#10004;
                                @endif
                            </div>
                            Perempuan
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>sex</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Tempat dan Tanggal Lahir</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->tempat_lahir }}
                        , @if ($pasien->tgl_lahir != '')
                            {{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Place & Date of birth</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Kebangsaan</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">
                        <select id="kebangsaan" class="form-control" style="border: none">
                            <option {{ $persetujuan ? ($persetujuan->kebangsaan == 'WNI' ? 'selected' : '') : '' }}
                                value="WNI">WNI</option>
                            <option {{ $persetujuan ? ($persetujuan->kebangsaan == 'WNA' ? 'selected' : '') : '' }}
                                value="WNA">WNA</option>
                        </select>
                        {{-- <input type="text" value="{{ $persetujuan ? $persetujuan->kebangsaan ? $persetujuan->kebangsaan : "" : "" }}" class="form-control" id="kebangsaan" style="border: 0px"> --}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Nationality</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Suku Bangsa</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">
                        <input type="text" id="suku" value="{{ $persetujuan ? $persetujuan->suku : ($pasien->suku ? $pasien->suku : '-') }}"
                            style="border: none" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Nationality</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Pekerjaan</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->pekerjaan }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Employment</i></td>
                </tr>
                <tr>
                    <td style="width: 20%; vertical-align: top;">Agama</td>
                    <td style="padding-left: 3px; vertical-align: top; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->agama }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Religion</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Status Perkawinan</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">
                        <div style="display:inline-flex; align-items: center;">
                            <div class="mr-2" style="width:13px; height:13px; border:1px solid; font-size:10px">
                                @if ($pasien->status == 'Belum Menikah')
                                    &#10004;
                                @endif
                            </div>
                            Belum Menikah
                            <div class="ml-2 mr-2" style="width:13px; height:13px; border:1px solid; font-size:10px">
                                @if ($pasien->status == 'Menikah')
                                    &#10004;
                                @endif
                            </div>
                            Menikah
                            <div class="ml-2 mr-2" style="width:13px; height:13px; border:1px solid; font-size:10px">
                                @if ($pasien->status == 'Duda')
                                    &#10004;
                                @endif
                            </div>
                            Duda
                            <div class="ml-2 mr-2" style="width:13px; height:13px; border:1px solid; font-size:10px">
                                @if ($pasien->status == 'Janda')
                                    &#10004;
                                @endif
                            </div>
                            Janda
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Marital status</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Pendidikan Terakhir</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->pendidikan }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Latest education</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Alamat sesuai KTP</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->alamat }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Address based on ID</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">No. Telp. / HP</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->telpon }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Phone / Mobile number</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Nama Ibu Kandung</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->ibu ? $pasien->ibu : '-' }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Mother name</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Alamat Domisili</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->alamat }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Address based on ID</i></td>
                </tr>
            </table>
        </div>
        <div style="width: 100%; border: 1px solid" class="container pb-3 pt-2">
            <h5><b>KONTAK DARURAT</b></h5>
            <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
                <tr>
                    <td style="width: 20%;">Nama Wali Pasien</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 15%; border-bottom: 2px dotted;">
                        <input type="text"
                            value="{{ $persetujuan ? ($persetujuan->nama_wali ? $persetujuan->nama_wali : '') : '' }}"
                            class="form-control" id="nama_wali" style="border: 0px">
                    </td>
                    <td style="width: 18%;">
                        <p>Hubungan Dengan Pasien</p>
                    </td>
                    <td style="width: 38%;">
                        <input type="radio"
                            {{ $persetujuan ? ($persetujuan->hubungan_pasien ? ($persetujuan->hubungan_pasien == 'ortu' ? 'checked' : '') : '') : '' }}
                            value="ortu" name="pilihan_hubungan_wali"> Orang tua
                        <input type="radio"
                            {{ $persetujuan ? ($persetujuan->hubungan_pasien ? ($persetujuan->hubungan_pasien == 'pasangan' ? 'checked' : '') : '') : '' }}
                            value="pasangan" name="pilihan_hubungan_wali" class="ml-4"> Suami/istri
                        <input type="radio"
                            {{ $persetujuan ? ($persetujuan->hubungan_pasien ? ($persetujuan->hubungan_pasien == 'saudara' ? 'checked' : '') : '') : '' }}
                            value="saudara" name="pilihan_hubungan_wali" class="ml-4"> Saudara
                        <input type="radio"
                            {{ $persetujuan ? ($persetujuan->hubungan_pasien ? ($persetujuan->hubungan_pasien == 'lainnya' ? 'checked' : '') : '') : '' }}
                            value="lainnya" name="pilihan_hubungan_wali" class="ml-4"> Lainnya
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Patient Guardian</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Alamat Wali</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;" colspan="3">
                        <input type="text"
                            value="{{ $persetujuan ? ($persetujuan->alamat_wali ? $persetujuan->alamat_wali : '') : '' }}"
                            class="form-control" id="alamat_wali" style="border: 0px">
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Address based on ID</i></td>
                </tr>
                <tr>
                    <td style="width: 20%;">No Telp. / HP Wali</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                    <td style="width: 68%; border-bottom: 2px dotted;" colspan="3">
                        <input type="text"
                            value="{{ $persetujuan ? ($persetujuan->telpon ? $persetujuan->telpon : '') : '' }}"
                            class="form-control" id="telpon" style="border: 0px">
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><i>Phone / Mobile number</i></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-6 text-center">
            @if (isset($rm->tanggal_update))
                <p style="font-size: 14px;">Bekasi, {{ date('d/m/Y', strtotime($rm->tanggal_update)) }}</p>
            @else
                <p style="font-size: 14px;">Bekasi, ......................................
                    ................................<br></p>
            @endif
        </div>
    </div>
    <div class="row" style="width:100%; margin-left: 0;">
        <div class="col-md-6 text-center">
            <p style="font-size: 14px;">Petugas Pendaftaran,</p>
            @if (isset($rm->nama_verifikator) && $rm->nama_verifikator != '')
                {{-- @if (isset($employee)) --}}
                    <img onclick="show_modal_petugas()" src="{{ env('SMIS_UPLOAD_URL') . '/' . ($employee ? $employee->ttd : '') }}"
                        alt="" style="height: 2.5cm; width:5cm;">
                {{-- @else
                    <img onclick="show_modal_petugas()" src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" alt=""
                        style="height: 2.5cm; width:5cm;">
                @endif --}}
                <p style="font-size: 18px; font-weight: bold; text-transform: uppercase;">
                    ({{ $rm->nama_verifikator }})</p>
            @else
                <br>
                <br>
                <button class="btn btn-primary" style="margin-bottom: 10px" onclick="show_modal_petugas()">VERIFIKASI
                    PETUGAS</button>
                <br>
                <br>
            @endif
            <hr style="width: 80%; border:1px solid;">
        </div>
        <div class="col-md-6 text-center">
            <p style="font-size: 14px;">Pasien / Keluarga,</p>
            @if (isset($rm->signature_pasien))
                <img src="{{ asset('signature_patient/' . $rm->signature_pasien) }}" onclick="show_modal_pasien()"
                    alt="" style="height: 2.5cm; width:5cm;">
                <p style="font-size: 18px; font-weight: bold; text-transform: uppercase;">({{ $rm->nama_pasien }})</p>
            @else
                <br>
                <br>
                <button class="btn btn-primary" style="margin-bottom: 10px" onclick="show_modal_pasien()">TTD
                    PASIEN</button>
                <br>
                <br>
            @endif
            <hr style="width: 80%; border:1px solid;">
            </hr>
        </div>
    </div>
    <br>
    <div class="row pb-5" style="width:100%; margin-left:0;">
        <div style="text-align: center;" class="col-md-12">
            @if ($rm->status == 1)
                <a href="{{ url('e_rekam_medis/pendaftaran/detail/pdf_identitas?dokumen=' . $dokumen) }}"
                    class="btn btn-success" target="_blank">Download PDF</a>
            @endif
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//keith-wood.name/js/jquery.signature.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
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
        $("#form_nama_pasien").val('');
    });

    function show_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function show_modal_pasien() {
        $('#modal_pasien').modal('show');
    }

    function cek_persetujuan() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan ini, Anda menyetujui bahwa identitas tersebut adalah benar.')) {
            return false;
        }
    }

    function cek_data_informasi() {
        $('#hide_identitas_pasien').val($('[name=pilihan_identitas_pasien]:checked').val());
        $('#hide_nomer_identitas').val($('#nomer_identitas').val());
        $('#hide_kebangsaan').val($('#kebangsaan').val());
        $('#hide_nama_wali').val($('#nama_wali').val());
        $('#hide_hubungan_wali').val($('[name=pilihan_hubungan_wali]:checked').val());
        $('#hide_alamat_wali').val($('#alamat_wali').val());
        $('#hide_telpon').val($('#telpon').val());
        $('#hide_suku').val($('#suku').val());
    }

    $(document).ready(function() {
        var verif = '{{ $rm->id_verifikator }}';
        if (verif != 0) {
            window.scrollTo(0, document.body.scrollHeight);
        }

        auto_complete_suku();
    })

    function auto_complete_suku() {
        $.ajax({
            url: "{{ url('ajax_request/suggestion_suku') }}",
            success: function(response){
                console.log(response);
                $("#suku").autocomplete({
                    source: response
                });
            }
        })
    }
</script>

</html>
