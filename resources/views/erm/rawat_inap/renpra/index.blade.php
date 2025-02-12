<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Rencana Keperawatan</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <style>
        .table-renpra td {
            border: black 1px solid;
        }

        .table-renpra .header-renpra {
            background-color: #ccc;
        }

        .table-renpra .input-dotted {
            border: none;
            border-bottom: 1px dotted black;
        }

        .table-renpra input:disabled,
        .table-renpra textarea:disabled {
            background-color: white;
        }

        .table-renpra .form-check-label {
            width: 100%;
            text-align: justify;
        }

        .table-renpra td:first-of-type {
            width: 132px;
        }

        .table-renpra .form-check input[type="checkbox"]:not(:checked)~label .input-dotted {
            pointer-events: none;
            background-color: #f1f1f1;
        }
    </style>
</head>

<body class="p-2">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-8">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                <p style="font-weight: bold">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya,<br>Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="w-100" style="border: 2px solid; padding:30px; border-radius:10px; font-weight: bold;float: right;">
                    <table>
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $dokumen->nama_pasien }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $dokumen->nrm }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="alert-wrapper">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="m-0 p-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahRenpraModal"><i class="fa fa-plus mr-2"></i>Rencana Keperawatan</button>
            </div>
        </div>
        <div class="row item-wrapper">
            @foreach($renpra as $rp)
            @if($get_view_renpra($rp['nama_renpra']) && view()->exists($get_view_renpra($rp['nama_renpra'])))
            <div class="col-12">
                @include($get_view_renpra($rp['nama_renpra']), ['renpra' => $rp])
            </div>
            @else
            <div class="col-12">
                <table class="w-100 table-renpra mt-1">
                    @include('erm.rawat_inap.renpra.header', ['renpra' => $rp])
                    <tr class="align-top">
                        <td colspan="7" class="text-center text-secondary font-italic">Modul Rencana Keperawatan ({{ $rp->nama_renpra }}) belum tersedia</td>
                    </tr>
                </table>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="tambahRenpraModal" aria-labelledby="tambahRenpraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form method="post" id="formTambahRenpra" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRenpraModalLabel">Pilih Rencana Keperawatan yang akan dibuat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="add_renpra" value="1" />
                    <input type="hidden" name="id_dokumen" value="{{ $dokumen->id }}" />
                    <select name="nama_renpra" id="nama_renpra" class="form-control select2 w-100" required>
                        <option></option>
                        @foreach($jenis_renpras as $jenis_renpra)
                        <option value="{{ $jenis_renpra['name'] }}">{{ $jenis_renpra['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Verifikasi Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="password" name="password" id="verify-password" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit-password">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        $(function() {
            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY HH:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });

            $('.timepicker').daterangepicker({
                locale: {
                    format: 'H:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            }).on('show.daterangepicker', function(ev, picker) {
                picker.container.find(".calendar-table").hide();
            });

            $('select.form-control.select2').select2({
                width: '100%',
                placeholder: 'Pilih',
                theme: 'bootstrap',
            });

            $('#tambahRenpraModal').on('hidden.bs.modal', function(e) {
                $('#formTambahRenpra .select2').val(null).trigger('change');
            });

            let activeForm = null;
            $('#passwordModal').on('shown.bs.modal', function(e) {
                $('#passwordModal #verify-password').focus();
                if (activeForm) {
                    $('#passwordModal .btn-submit-password').on('click', function(e) {
                        let pass = $('#passwordModal #verify-password').val();
                        // console.log(pass);
                        $(`#${activeForm} input[name="password"]`).val(pass);
                        $(`form#${activeForm}`).trigger('submit');
                        $('#passwordModal').modal('hide');
                        // location.reload();

                    });
                }
            });

            $('#passwordModal').on('hidden.bs.modal', function(e) {
                $('#passwordModal #verify-password').val(null);
            });

            $('[data-toggle="tooltip"]').tooltip();

            function checkInput() {
                var isChecked = $('.check-with-input').prop('checked');
                var textInput = $('.input-with-check');
     

                if (isChecked) {
                    textInput.prop('required', true);
                } else {
                    textInput.prop('required', false);
                }
            };

            function submitRenpra(e) {
                e.preventDefault();

                $('.alert-wrapper').html('');

                checkInput();

                $(this).validate({
                    debug: true,
                    showErrors: function(errorMap, errorList) {
                        if (Array.isArray(errorList) && errorList.length > 0) {
                            const el = $(errorList[0].element);
                            el.attr('data-toggle', 'tooltip');
                            el.attr('data-placement', 'top');
                            el.prop('title', String(el.prop('name')).includes('[]') ? 'Harus dipilih minimal satu.' : 'Harus diisi.');
                            el.focus();
                            el.tooltip('show');
                        }
                    }
                });

                let saveOnly = true;
                if ($(this).find('input[name="action"]').val() == 'verify' && $(this).find('input[name="password"]').val() == '') {
                    if ($(this).valid()) {
                        $('#passwordModal').modal('show');
                    }
                } else {
                    $.ajax({
                        url: "{{ url()->current() }}",
                        method: "POST",
                        cache: false,
                        data: $(this).serializeArray(),
                        dataType: 'html',
                        context: this,
                        success: function(data, status, xhr) {
                            // console.debug(data);
                            $(this).parent('div.col-12').html(data);
                            // toastr.success('Success');
                        },
                        error: function(xhr, status, error) {
                            // toastr.error('Error', xhr.responseText);
                            console.error(xhr.responseText);
                            const alert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert" />').html(xhr.responseText ?? 'Terjadi kesalahan, silahkan coba lagi.').append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                            $('.alert-wrapper').html('').append(alert);
                            $(this).find('input[name="password"]').val(null).trigger('change');
                        },
                    }).done(function() {
                        bindFormEvent();
                    });
                }
            }

            function submitForm(e) {
                e.preventDefault();
                const action = $(this).data('action');
                activeForm = $(this).closest('form').prop('id');
                $(this).closest('form').find('input[name="action"]').val(action);
                $(this).closest('form').find(':input[required]:visible').prop('required', action == 'verify');
                $(this).closest('form').trigger('submit');
            }

            function bindFormEvent() {
                $('.item-wrapper .form-renpra').unbind('submit');
                $('.item-wrapper .form-renpra .btn-submit').unbind('click');
                $('.item-wrapper .form-renpra').on('submit', submitRenpra);
                $('.item-wrapper .form-renpra').on('click', '.btn-submit', submitForm);
                $('.datetimepicker').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY HH:mm'
                    },
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                });
                $('.timepicker').daterangepicker({
                    locale: {
                        format: 'HH:mm'
                    },
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                }).on('show.daterangepicker', function(ev, picker) {
                    picker.container.find(".calendar-table").hide();
                });
            }

            bindFormEvent();

            $('#formTambahRenpra').on('submit', function(e) {
                e.preventDefault();

                if (!confirm('Apakah Anda yakin?')) return;

                $.ajax({
                    url: "{{ url()->current() }}",
                    method: "POST",
                    cache: false,
                    data: $(this).serializeArray(),
                    dataType: 'html',
                    success: function(data, status, xhr) {
                        // console.debug(data);
                        const col = $('<div class="col-12" />').append(data);
                        $('.item-wrapper').append(col);

                        $('html, body').animate({
                            scrollTop: $('.item-wrapper').height()
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        const alert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert" />').html(xhr.responseText ?? 'Terjadi kesalahan, silahkan coba lagi.').append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                        $('.alert-wrapper').html('').append(alert);
                    },
                }).done(function() {
                    bindFormEvent();
                    $('#tambahRenpraModal').modal('hide');
                });
            });
        });
        
    </script>
    @stack('scripts')
</body>

</html>