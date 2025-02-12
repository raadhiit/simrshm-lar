<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Observasi Keperawatan Rawat Inap</title>
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
        <div class="modal fade" id="modal_simpan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Simpan Tindakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" onsubmit="return cek_form(this)" action="{{ url('e_rekam_medis/detail/save_observasi_keperawatan_rawat_inap') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Tanggal dan Jam Tindakan</label>
                                <input type="text" name="tgl_tindakan" id="tgl_tindakan" class="fulldate form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tindakan</label>
                                <textarea type="text" name="tindakan" id="tindakan" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ url('e_rekam_medis/detail/verifikasi_observasi_keperawatan_rawat_inap') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" name="id" id="id_item">
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

        <div class="container mt-3">
            <table class="table table-bordered table-0 custom-table">
                <thead>
                  <tr>
                    <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">
                        OBSERVASI KEPERAWATAN RAWAT INAP
                    </th>
                  </tr>
                </thead>
                <tbody>
                    <tr class="text-center mt-2" >
                        <td class="font-weight-bold" style="width: 15%; vertical-align: middle" >TANGGAL</td>
                        <td class="font-weight-bold" style="width: 60%; vertical-align: middle">TINDAKAN KEPERAWATAN</td>
                        <td class="font-weight-bold" style="width: 15%; vertical-align: middle">PARAF & TTD</td>
                        <td class="font-weight-bold" style="width: 10%; vertical-align: middle">
                            <button class="btn btn-primary btn-sm" onclick="open_modal_simpan(0)"><i class="fa fa-plus"></i></button>
                        </td>
                    </tr>
                    @if (isset($data))
                        @foreach ($data as $item)
                            <tr>
                                <td id="isian_tgl_tindakan_{{ $item->id }}">{{ date('d-m-Y H:i', strtotime($item->tgl_tindakan)) }}</td>
                                <td id="isian_tindakan_{{ $item->id }}">{{ $item->tindakan }}</td>
                                <td style="text-align: center" onclick="open_modal_petugas(`{{ $item->id }}`)">
                                    @if ($item->id_verifikator != 0)
                                        @if(isset($item->employee))
                                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$item->employee->ttd }}"
                                                    style="height: 3cm; width: 4cm;" alt="">
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 3cm; width: 4cm;" alt="">
                                        @endif
                                        <br>({{$item->nama_verifikator}})
                                    @else
                                    <button class="btn btn-primary btn-sm">Verifikasi</button>
                                    @endif
                                </td>
                                <!-- Lama -->
                                {{-- <td style="text-align: center">
                                    <button class="btn btn-success btn-sm" onclick="open_modal_simpan('{{ $item->id }}')"><i class="fa fa-pencil"></i></button>
                                    @if (!isset($item->id_verifikator) || $item->id_verifikator == 0)
                                    <a onclick="if (confirm('Apakah Anda yakin akan menghapus?')){return true;}else{event.stopPropagation(); event.preventDefault();};" href="{{ url('e_rekam_medis/detail/hapus_observasi_keperawatan_rawat_inap') }}/{{ $item->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td> --}}
                                
                                <!--- Baru -->
                                <td style="text-align: center">
                                    <button class="btn btn-success btn-sm" onclick="open_modal_simpan('{{ $item->id }}')"><i class="fa fa-pencil"></i></button>
                                    <a onclick="if (confirm('Apakah Anda yakin akan menghapus?')){return true;}else{event.stopPropagation(); event.preventDefault();};" href="{{ url('e_rekam_medis/detail/hapus_observasi_keperawatan_rawat_inap') }}/{{ $item->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
    });

    $('.fulldate').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    function open_modal_simpan(id) {
        if (id != 0) {
            $('#id').val(id);
            $('#tgl_tindakan').val($('#isian_tgl_tindakan_'+id).html());
            $('#tindakan').val($('#isian_tindakan_'+id).html());
        }
        $('#modal_simpan').modal('show');
    }

    function open_modal_petugas(id) {
        if (id != 0) {
            $('#id_item').val(id);
        }
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }

    function cek_form() {
        $('#hide_id_ppa').val($("#id_ppa").val());
        $('#hide_perawatan_dirumah').val($('[name="radio_perawatan_dirumah"]:checked').val());
        $('#hide_nama_ibu').val($('#nama_ibu').val());
        $('#hide_nama_ayah').val($('#nama_ayah').val());
        $('#hide_bb_saat_pulang').val($('#bb_saat_pulang').val());
        $('#hide_hari_control').val($('#hari_control').val());
        $('#hide_tgl_control').val($('#tgl_control').val());
        $('#hide_jk').val($('[name="radio_jk"]:checked').val());
        $('#hide_checklist_satu').val($('[name="radio_checklist_satu"]:checked').val());
        $('#hide_checklist_dua').val($('[name="radio_checklist_dua"]:checked').val());
        $('#hide_checklist_tiga').val($('[name="radio_checklist_tiga"]:checked').val());
        $('#hide_checklist_empat').val($('[name="radio_checklist_empat"]:checked').val());
        $('#hide_checklist_lima').val($('[name="radio_checklist_lima"]:checked').val());
        $('#hide_checklist_enam').val($('[name="radio_checklist_enam"]:checked').val());
        $('#hide_checklist_tujuh').val($('[name="radio_checklist_tujuh"]:checked').val());
        $('#hide_checklist_delapan').val($('[name="radio_checklist_delapan"]:checked').val());
        $('#hide_checklist_sembilan').val($('[name="radio_checklist_sembilan"]:checked').val());
        $('#hide_checklist_sepuluh').val($('[name="radio_checklist_sepuluh"]:checked').val());
        $('#hide_nama_dokter').val($('#nama_dokter').val());
        $('#hide_hari_dokumen').val($('#hari_dokumen').val());
        $('#hide_tgl_dokumen').val($('#tgl_dokumen').val());
        $('#hide_jam_dokumen').val($('#jam_dokumen').val());

        return true;
    }
</script>

</html>