<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kematian</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
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

<body class="p-2">
    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" onsubmit="return cek_verif()"
                    action="{{ url('e_rekam_medis/detail/save_surat_keterangan_kematian') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" id="hide_dokter" name="dokter">
                    <input type="hidden" id="hide_tgl_lahir" name="tgl_lahir">
                    <input type="hidden" id="hide_umur" name="umur">
                    <input type="hidden" id="hide_alamat" name="alamat">
                    <input type="hidden" id="hide_tgl_tiba" name="tgl_tiba">
                    <input type="hidden" id="hide_jam_tiba" name="jam_tiba">
                    <input type="hidden" id="hide_diagnosa" name="diagnosa">
                    <input type="hidden" id="hide_tgl_meninggal" name="tgl_meninggal">
                    <input type="hidden" id="hide_jam_meninggal" name="jam_meninggal">
                    <input type="hidden" id="hide_sebab_kematian" name="sebab_kematian">
                    <input type="hidden" id="hide_tgl_dokumen" name="tgl_dokumen">
                    <input type="hidden" id="hide_no_dokumen" name="no_dokumen">
                    <input type="hidden" id="hide_bulan" name="bulan">
                    <input type="hidden" id="hide_tahun" name="tahun">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-auto">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="" style="width: 200px">
                    </div>
                    <div class="col-auto text-center pt-2">
                        <h2 class="text-center"> <span style="text-decoration: underline"> SURAT KETERANGAN KEMATIAN </span> 
                        <br> 
                        <span> SKK/No. <input type="text" id="no_dokumen" style="border:hidden; border-bottom: 1px dotted; width: 100px; font-weight: bold" oninput="this.style.width=this.value.length+1+'ch'" value="{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->no_dokumen : '' }}"> /RSHM/<input type="text" id="bulan" style="border:hidden; border-bottom: 1px dotted; width: 100px; font-weight: bold" oninput="this.style.width=this.value.length+1+'ch'" value="{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->bulan : '' }}">/<input type="text" id="tahun" style="border:hidden; border-bottom: 1px dotted; width: 100px; font-weight: bold" oninput="this.style.width=this.value.length+1+'ch'" value="{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->tahun : '' }}"></span> </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="font-weight-bold">
                    Yang bertanda tangan di bawah ini Dokter Rumah Sakit Harapan Mulia menerangkan bahwa :
                </p>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Nama</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" id="dokter" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->dokter : $layanan->nama_pasien }}">
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Tanggal Lahir</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <div class="row">
                                <div class="col">
                                    <input type="text" onchange="setUmur()" class="tanggal_dmy" id="tgl_lahir" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? date('d-m-Y', strtotime($dokumen->surat_keterangan_kematian->tgl_lahir)) : $layanan->tgl_lahir }}">
                                </div>
                                <div class="col-auto">
                                    (<span id="umur">{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->umur : $layanan->umur }}</span> Tahun)
                                </div>
                            </div>
                        </td>
                    </tr>    
                    <tr class="align-top">
                        <td style="width: 12%;">Alamat</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" id="alamat" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->alamat : $layanan->alamat_pasien }}"> 
                        </td>
                    </tr>      
                </table>

                <p class="font-weight-bold mt-3">
                    Tiba di Rumah Sakit Harapan Mulia pada :
                </p>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Tanggal</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 50%;">
                            <input type="text" class="tanggal_dmy" id="tgl_tiba" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? date('d-m-Y', strtotime($dokumen->surat_keterangan_kematian->tgl_tiba)) : '' }}">
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Jam </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 50%;">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="waktu_24" id="jam_tiba" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? date('H:i', strtotime($dokumen->surat_keterangan_kematian->jam_tiba)) : '' }}">
                                </div>
                                <div class="col-auto">
                                    WIB
                                </div>
                            </div>
                        </td>
                    </tr>    
                    <tr class="align-top">
                        <td style="width: 12%;">Diagnosa </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" id="diagnosa" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->diagnosa : '' }}"> 
                        </td>
                    </tr>   
                </table>

                <p class="font-weight-bold mt-3">
                    Dinyatakan Meninggal Pada :
                </p>
                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Tanggal</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" class="tanggal_dmy" id="tgl_meninggal" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? date('d-m-Y', strtotime($dokumen->surat_keterangan_kematian->tgl_meninggal)) : '' }}">
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Jam </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="waktu_24" id="jam_meninggal" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? date('H:i', strtotime($dokumen->surat_keterangan_kematian->jam_meninggal)) : '' }}">
                                </div>
                                <div class="col-auto">
                                    WIB
                                </div>
                            </div>
                        </td>
                    </tr>    
                    <tr class="align-top">
                        <td style="width: 12%;">Sebab Kematian </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" id="sebab_kematian" style="border:hidden; border-bottom: 1px dotted; width: 100%" value="{{ $dokumen->surat_keterangan_kematian ? $dokumen->surat_keterangan_kematian->sebab_kematian : '' }}"> 
                        </td>
                    </tr>   
                </table>

                <p class="mt-3" style="text-indent: 50px;">
                    Demikian Surat Keterangan Kematian ini kami buat untuk digunakan dengan sebagai mana mestinya.
                </p>
            </div>
        </div>
        <div class="row">
            <table style="width: 100%">
                <tr>
                    <td style="width: 70%"></td>
                    <td style="width: 30%; text-align: center">
                        Cibarusah, <input type="text" class="tanggal_dmy" id="tgl_dokumen" style="border:hidden; border-bottom: 1px dotted;" value="{{ $dokumen->surat_keterangan_kematian ? date('d-m-Y', strtotime($dokumen->surat_keterangan_kematian->tgl_dokumen)) : '' }}">
                        <br>
                        <br>
                        Dokter
                        @if ($dokumen->id_verifikator == 0)
                            <br>
                            <br>
                            <a href="#" style="color: #111; text-decoration: none;"
                                onclick="open_modal_verifikasi()">Simpan dan Verifikasi</a>
                            <br>
                            <br>
                            <p>
                                (...............................................)<br>
                                Tanda tangan & Nama terang
                            </p>
                        @else
                            <br>
                            <a href="#" style="color: #111; text-decoration: none;"
                                onclick="open_modal_verifikasi()"><img style="width: 5cm; height:2.5cm;"
                                    src="{{ env('SMIS_UPLOAD_URL') ."/". ($employee ? $employee->ttd : '') }}"
                                    alt="">
                            </a>
                            <p>
                                ({{ $dokumen->nama_verifikator }})<br>
                            </p>
                        @endif
                    </td>
                </tr>
            </table>        
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery.autocomplete.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
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

    // $("#dokter").devbridgeAutocomplete({
    //     serviceUrl: "{{ url('ajax_request/get_dokter') }}", // Kode php untuk prosesing data
    //     dataType: "JSON", // Tipe data JSON
    //     onSelect: function(suggestion) {
    //         $("#dokter").val(suggestion.nama);
    //     }
    // });

    function setUmur() {
        var todayDate = new Date().getTime();
        var birthDate = new Date($('#tgl_lahir').val()).getTime();
        var age = (todayDate - birthDate) / (1000 * 60 * 60 * 24 * 365)

        $('#umur').html(Math.ceil(age));
    }

    function open_modal_verifikasi() {
        window.event.preventDefault();
        $('#modal_verifikasi').modal('show');
    }

    function cek_verif() {
        if (!confirm('Yakin melanjutkan verifikasi dokumen ? ')) {
            return false;
        }

        $('#hide_dokter').val($('#dokter').val());
        $('#hide_tgl_lahir').val($('#tgl_lahir').val());
        $('#hide_umur').val($('#umur').html());
        $('#hide_alamat').val($('#alamat').val());
        $('#hide_tgl_tiba').val($('#tgl_tiba').val());
        $('#hide_jam_tiba').val($('#jam_tiba').val());
        $('#hide_diagnosa').val($('#diagnosa').val());
        $('#hide_tgl_meninggal').val($('#tgl_meninggal').val());
        $('#hide_jam_meninggal').val($('#jam_meninggal').val());
        $('#hide_sebab_kematian').val($('#sebab_kematian').val());
        $('#hide_tgl_dokumen').val($('#tgl_dokumen').val());
        $('#hide_no_dokumen').val($('#no_dokumen').val());
        $('#hide_bulan').val($('#bulan').val());
        $('#hide_tahun').val($('#tahun').val());
        return true;
    }
</script>
</html>