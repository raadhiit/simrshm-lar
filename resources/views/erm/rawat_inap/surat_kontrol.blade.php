<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Kontrol</title>
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
                    <form method="post" onsubmit="return cek_form(this)" action="{{ url('e_rekam_medis/detail/save_surat_kontrol') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" id="hide_terapi" name="terapi">
                        <input type="hidden" id="hide_tgl_surat_rujukan" name="tgl_surat_rujukan">
                        <input type="hidden" id="hide_alasan1" name="alasan1">
                        <input type="hidden" id="hide_alasan2" name="alasan2">
                        <input type="hidden" id="hide_tindak_lanjut1" name="tindak_lanjut1">
                        <input type="hidden" id="hide_tindak_lanjut2" name="tindak_lanjut2">
                        <input type="hidden" id="hide_tgl_keterangan" name="tgl_keterangan">
                        <input type="hidden" id="hide_no_antrian" name="no_antrian">
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

        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-md-12">
                    <h4 class="text-center">SURAT KONTROL</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">    
                        <table style="border-collapse: collapse; width:100%" class="mb-3">
                            <tr class="align-top">
                                <td style="width: 12%;">No. RM</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" name="" value="{{ $pasien->id }}" readonly style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                </td>
                            </tr>
        
                            <tr class="align-top">
                                <td style="width: 12%;">Nama Pasien</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" name="" value="{{ $pasien->nama}}" readonly style="border: hidden; border-bottom: 1px dotted; width: 100%"> 
                                </td>
                            </tr>    
                            <tr class="align-top">
                                <td style="width: 12%;">Diagnosa</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" name="" readonly value="{{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd." - ".$layanan->diagnosa->nama_icd : '-' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%"> 
                                </td>
                            </tr>    
                            <tr class="align-top">
                                <td style="width: 12%;">Terapi</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" id="terapi" value="{{ $data ? $data->terapi : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                </td>
                            </tr>    
                            <tr class="align-top">
                                <td style="width: 12%;">Tgl Surat Rujukan</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" class="tanggal_dmy" id="tgl_surat_rujukan" value="{{ $data ? date('d-m-Y', strtotime($data->tgl_surat_rujukan)) : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                </td>
                            </tr>    
                        </table>
    
                        <p>
                            Belum dapat dikembalikan ke fasilitas perujuk dengan alasan :
                            <ol>
                                <li>
                                    <input type="text" id="alasan1" value="{{ $data ? $data->alasan1 : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                </li>
                                <li>
                                    <input type="text" id="alasan2" value="{{ $data ? $data->alasan2 : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                </li>
                            </ol>
                        </p>
    
                        <p>
                            Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya :
                            <ol>
                                <li>
                                    <input type="text" id="tindak_lanjut1" value="{{ $data ? $data->tindak_lanjut1 : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                </li>
                                <li>
                                    <input type="text" id="tindak_lanjut2" value="{{ $data ? $data->tindak_lanjut2 : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                </li>
                            </ol>
                        </p>
    
                        <div class="row">
                            <div class="col-md-12">    
                                <p>Surat keterangan ini digunakan untuk 1 (satu) kali kunjungan dengan diagnosa diatas pada:</p>
                                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                                        <tr class="align-top">
                                            <td style="width: 12%;">Tanggal</td>
                                            <td style="width: 3%;"> : </td>
                                            <td style="width: 85%;">
                                                <input type="text" class="tanggal_dmy" id="tgl_keterangan" value="{{ $data ? date('d-m-Y', strtotime($data->tgl_keterangan)) : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                            </td>
                                        </tr>
                                        <tr class="align-top">
                                            <td style="width: 12%;">No. Antrian</td>
                                            <td style="width: 3%;"> : </td>
                                            <td style="width: 85%;">
                                                <input type="text" id="no_antrian" value="{{ $data ? $data->no_antrian : '' }}" style="border: hidden; border-bottom: 1px dotted; width: 100%">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                        </div>
                        
                        <div class="row">
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 70%"></td>
                                    <td style="width: 30%; text-align: center">
                                        Cibarusah, <input type="text" id="tgl_dokumen" class="tanggal_dmy" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? date('d-m-Y', strtotime($data->tgl_dokumen)) : date('d-m-Y') }}">
                                        <br>
                                        <div onclick="open_modal_petugas()">
                                            @if($dokumen->id_verifikator == 0)
                                                <br>
                                                <br>
                                                <button class="btn btn-primary">Simpan & Verifikasi</button>
                                                <br>
                                                <br>
                                                <br>
                                                (.................................................)
                                                <br>
                                                Ttd & Nama Terang
                                            @else
                                                @if(isset($employee))
                                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                                            style="height: 4cm; width: 5cm;" alt="">
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                                @endif
                                                <br>({{$dokumen->nama_verifikator}})
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
        $('#modal_pasien').modal('show');
    }

    function cek_form() {
        $('#hide_terapi').val($('#terapi').val());
        $('#hide_tgl_surat_rujukan').val($('#tgl_surat_rujukan').val());
        $('#hide_alasan1').val($('#alasan1').val());
        $('#hide_alasan2').val($('#alasan2').val());
        $('#hide_tindak_lanjut1').val($('#tindak_lanjut1').val());
        $('#hide_tindak_lanjut2').val($('#tindak_lanjut2').val());
        $('#hide_tgl_keterangan').val($('#tgl_keterangan').val());
        $('#hide_no_antrian').val($('#no_antrian').val());
        $('#hide_tgl_dokumen').val($('#tgl_dokumen').val());

        return true;
    }
</script>

</html>