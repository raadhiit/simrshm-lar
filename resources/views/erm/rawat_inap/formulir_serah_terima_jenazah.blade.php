<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Serah Terima Jenazah</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .pagebreak {
            page-break-after: always;
        }

        @media print {
            body {
                width: 100%;
                font-size: 10pt;
                padding: 0px;
            }

            .inputan {
                border: none !important;
                border-bottom: 1px solid transparent !important;
            }

            #tabel_pemantauan {
                font-size: 10px !important;
            }

            #logo_rshm {
                width: 20% !important;
            }

            @page {
                size: legal;
                margin: 0;
            }

            #gambar_partograf {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }

            #canvas {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }

            .hidden_print {
                display: none;
            }
        }

        #logo_rshm {
            width: 20%;
        }

        body {
            width: 100%;
            font-size: 12pt;
            padding: 20px;
        }

        .row {
            width: 100%;
            margin-left: 0;
        }

        .col-lg-1 {
            width: 8%;
            float: left;
        }

        .col-lg-2 {
            width: 16%;
            float: left;
        }

        .col-lg-3 {
            width: 25%;
            float: left;
        }

        .col-lg-4 {
            width: 33%;
            float: left;
        }

        .col-lg-5 {
            width: 42%;
            float: left;
        }

        .col-lg-6 {
            width: 50%;
            float: left;
        }

        .col-lg-7 {
            width: 58%;
            float: left;
        }

        .col-lg-8 {
            width: 66%;
            float: left;
        }

        .col-lg-9 {
            width: 75%;
            float: left;
        }

        .col-lg-10 {
            width: 83%;
            float: left;
        }

        .col-lg-11 {
            width: 92%;
            float: left;
        }

        .col-lg-12 {
            width: 100%;
            float: left;
        }

        .inputan {
            border: none;
            border-bottom: 1px solid !important;
        }

        #tabel_header tr td {
            /* width: 10%; */

            padding-left: 5px;
            padding-right: 5px;
        }

        #tabel_header tr:nth-child(even) td {
            padding-top: 5px;
        }

        #title_tabel_3 {
            -webkit-transform: rotate(270deg);
        }
    </style>
</head>

<body>
    @if(Session::has('success'))
    <script>
        alert('{{ Session::get("success") }}')
    </script>
    @endif
    <div class="container">
        <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" onsubmit="return cek_form(this)" action="{{ url('e_rekam_medis/detail/save_formulir_serah_terima_jenazah') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" id="hide_hari_dokumen" name="hari_dokumen">
                        <input type="hidden" id="hide_tgl_dokumen" name="tgl_dokumen">
                        <input type="hidden" id="hide_tempat_meninggal" name="tempat_meninggal">
                        <input type="hidden" id="hide_nama" name="nama">
                        <input type="hidden" id="hide_umur" name="umur">
                        <input type="hidden" id="hide_tgl_meninggal" name="tgl_meninggal">
                        <input type="hidden" id="hide_nama_wali" name="nama_wali">
                        <input type="hidden" id="hide_umur_wali" name="umur_wali">
                        <input type="hidden" id="hide_alamat_wali" name="alamat_wali">
                        <input type="hidden" id="hide_telp_wali" name="telp_wali">
                        <input type="hidden" id="hide_ktp_wali" name="ktp_wali">
                        <input type="hidden" id="hide_hubungan" name="hubungan">
                        <input type="hidden" id="hide_ket_lain_lain" name="ket_lain_lain">
                        <input type="hidden" id="hide_tgl_ttd" name="tgl_ttd">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/detail/save_ttd_serah_terima_jenazah') }}">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                            <input type="hidden" name="status" id="status">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <h6>Nama</h6>
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
        <div class="row">
            <div class="col-lg-7">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="" id="logo_rshm">
                <p style="font-weight: bold; font-size: 12px;">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya, Kec. Cibarusah<br>
                    Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
            </div>
            <div class="col-lg-5">
                <div style="width: 100%; padding:10px; border: 1px solid; border-radius:10px;">
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
        </div>

        <div class="container mt-3">
            <table class="table table-bordered table-0 custom-table">
                <thead>
                  <tr>
                    <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">BERITA ACARA SERAH TERIMA JENAZAH</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">
                            <p>
                                Pada hari ini <input type="text" id="hari_dokumen" style="border: hidden; border-bottom: 1px dotted" class="mb-2" value="{{ $data ? $data->hari_dokumen : '' }}">, tanggal <input type="text" id="tgl_dokumen" class="fulldate" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? date('d-m-Y H:i', strtotime($data->tgl_dokumen)) : date('d-m-Y H:i') }}"> WIB, 
                                bertempat di Kamar Jenazah Rumah Sakit Harapan Mulia/<input type="text" id="tempat_meninggal" style="border: hidden; border-bottom: 1px dotted" class="mb-2" value="{{ $data ? $data->tempat_meninggal : '' }}">, telah dilakukan serah terima jenazah beridentitas :
                            </p>
                
                            <table style="border-collapse: collapse; width:100%" class="mb-3">
                                <tr class="align-top">
                                    <td style="width: 20%;">Nama</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 77%;">
                                        <input type="text" id="nama" style="border: hidden; border-bottom: 1px dotted; width: 100%" class="mb-2" value="{{ $data ? $data->nama : '' }}">
                                    </td>
                                </tr>
                
                                <tr class="align-top">
                                    <td style="width: 20%;">Umur</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 77%;">
                                        <input type="text" id="umur" style="border: hidden; border-bottom: 1px dotted; width: 100%" class="mb-2" value="{{ $data ? $data->umur : '' }}"> 
                                    </td>
                                </tr>
                
                                <tr class="align-top">
                                    <td style="width: 20%;">Tanggal dan Jam Meninggal</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 77%;">
                                        <input type="text" id="tgl_meninggal" class="fulldate" style="border: hidden; border-bottom: 1px dotted; width: 100%" value="{{ $data ? date('d-m-Y H:i', strtotime($data->tgl_meninggal)) : date('d-m-Y H:i') }}">
                                    </td>
                                </tr>
                            </table>
                
                            <p>
                                Kepada yang beridentitas di bawah ini:
                            </p>
                            
                            <table style="border-collapse: collapse; width:100%" class="mb-3">
                                <tr class="align-top">
                                    <td style="width: 12%;">Nama</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 85%;">
                                        <input type="text" id="nama_wali" style="border: hidden; border-bottom: 1px dotted; width: 100%" class="mb-2" value="{{ $data ? $data->nama_wali : '' }}">
                                    </td>
                                </tr>
                                <tr class="align-top">
                                    <td style="width: 12%;">Umur</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 85%;">
                                        <input type="text" id="umur_wali" style="border: hidden; border-bottom: 1px dotted; width: 100%" class="mb-2" value="{{ $data ? $data->umur_wali : '' }}">
                                    </td>
                                </tr>
                                <tr class="align-top">
                                    <td style="width: 12%;">Alamat</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 85%;">
                                        <input type="text" id="alamat_wali" style="border: hidden; border-bottom: 1px dotted; width: 100%" class="mb-2" value="{{ $data ? $data->alamat_wali : '' }}">
                                    </td>
                                </tr>
                                <tr class="align-top">
                                    <td style="width: 12%;">No. Tlp</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 85%;">
                                        <input type="text" id="telp_wali" style="border: hidden; border-bottom: 1px dotted; width: 100%" class="mb-2" value="{{ $data ? $data->telp_wali : '' }}">
                                    </td>
                                </tr>
                                <tr class="align-top">
                                    <td style="width: 12%;">No. KTP</td>
                                    <td style="width: 3%;"> : </td>
                                    <td style="width: 85%;">
                                        <input type="text" id="ktp_wali" style="border: hidden; border-bottom: 1px dotted; width: 100%" class="mb-2" value="{{ $data ? $data->ktp_wali : '' }}">
                                    </td>
                                </tr>
                            </table>
                
                            <p class="mt-5"> Selaku   
                                <input type="radio" value="ayah" name="radio_hubungan" {{ $data ? ($data->hubungan == 'ayah' ? 'checked' : '') : '' }}> Ayah Kandung/
                                <input type="radio" value="ibu" name="radio_hubungan" {{ $data ? ($data->hubungan == 'ibu' ? 'checked' : '') : '' }}> Ibu Kandung/
                                <input type="radio" value="saudara" name="radio_hubungan" {{ $data ? ($data->hubungan == 'saudara' ? 'checked' : '') : '' }}> Saudara Kandung/
                                <input type="radio" value="lain_lain" name="radio_hubungan" {{ $data ? ($data->hubungan == 'lain_lain' ? 'checked' : '') : '' }}> *lain-lain (sebutkan)
                                <input type="text" id="ket_lain_lain" {{ $data ? ($data->hubungan == 'lain_lain' ? '' : 'readonly') : 'readonly' }} style="border: hidden; border-bottom: 1px dotted" class="mb-2" value="{{ $data ? $data->ket_lain_lain : '' }}"> dari jenazah yang diserahkan. <br>
                                Demikianlah berita acara ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.
                            </p>
                
                            <p class="mt-5 text-right">
                                Cibarusah, <input type="text" id="tgl_ttd" class="fulldate" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? date('d-m-Y H:i', strtotime($data->tgl_ttd)) : date('d-m-Y H:i') }}">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width: 50% !important; text-align:center;" onclick="open_modal_petugas()">
                            Yang Memberikan
                            @if($dokumen->id_verifikator == 0)
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>
                                Ttd & Nama Terang
                            @else
                                <br>
                                @if(isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                @endif
                                <br>({{$dokumen->nama_verifikator}})
                            @endif
                        </td>
                        <td colspan="2" style="width: 50%; text-align:center" onclick="open_modal_pasien('penerima')">
                            Yang Menerima
                            @if (!is_null($data))
                                @if(is_null($data->nama_penerima) || $data->nama_penerima == "")
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>
                                    Ttd & Nama Terang
                                @else
                                    <br>
                                    @if(!is_null($data->ttd_penerima) || $data->ttd_penerima != "")
                                        <img src="{{ asset('signature_patient/'.$data->ttd_penerima) }}"
                                                style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>({{$data->nama_penerima}})
                                @endif
                            @else
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>
                                Ttd & Nama Terang
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width: 50%; text-align:center" onclick="open_modal_pasien('saksi')">
                            Saksi
                            @if (!is_null($data))
                                @if(is_null($data->nama_saksi) || $data->nama_saksi == "")
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>
                                    Ttd & Nama Terang
                                @else
                                    <br>
                                    @if(!is_null($data->ttd_saksi) || $data->ttd_saksi != "")
                                        <img src="{{ asset('signature_patient/'.$data->ttd_saksi) }}"
                                                style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>({{$data->nama_saksi}})
                                @endif
                            @else
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>
                                Ttd & Nama Terang
                            @endif
                        </td>
                        <td colspan="2" style="width: 50%; text-align:center" onclick="open_modal_pasien('saksi_dua')">
                            Saksi
                            @if (!is_null($data))
                                @if(is_null($data->nama_saksi_dua) || $data->nama_saksi_dua == "")
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>
                                    Ttd & Nama Terang
                                @else
                                    <br>
                                    @if(!is_null($data->ttd_saksi_dua) || $data->ttd_saksi_dua != "")
                                        <img src="{{ asset('signature_patient/'.$data->ttd_saksi_dua) }}"
                                                style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>({{$data->nama_saksi_dua}})
                                @endif
                            @else
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>
                                Ttd & Nama Terang
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="text-right">RSHM/RI/13.00/Rev.01</p>
        </div>
    </div>
</body>
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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

    $('.fulldate').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });
    
    $('.fulldate').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm'));
        setUmur();
    });

    $('.fulldate').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien(status) {
        $('#status').val(status);
        $('#modal_pasien').modal('show');
    }

    function cek_form() {
        $('#hide_hari_dokumen').val($('#hari_dokumen').val());
        $('#hide_tgl_dokumen').val($('#tgl_dokumen').val());
        $('#hide_tempat_meninggal').val($('#tempat_meninggal').val());
        $('#hide_nama').val($('#nama').val());
        $('#hide_umur').val($('#umur').val());
        $('#hide_tgl_meninggal').val($('#tgl_meninggal').val());
        $('#hide_nama_wali').val($('#nama_wali').val());
        $('#hide_umur_wali').val($('#umur_wali').val());
        $('#hide_alamat_wali').val($('#alamat_wali').val());
        $('#hide_telp_wali').val($('#telp_wali').val());
        $('#hide_ktp_wali').val($('#ktp_wali').val());
        $('#hide_hubungan').val($('[name="radio_hubungan"]:checked').val());
        $('#hide_ket_lain_lain').val($('#ket_lain_lain').val());
        $('#hide_tgl_ttd').val($('#tgl_ttd').val());

        return true;
    }

    $('[name=radio_hubungan]').change(function() {
        if ($('[name=radio_hubungan]:checked').val() == 'lain_lain') {
            $('#ket_lain_lain').removeAttr('readonly');
            return;
        }

        $('#ket_lain_lain').attr('readonly', true);
        $('#ket_lain_lain').val("");
    })
</script>

</html>