<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Observasi Cairan</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .border {
            border: 1px solid black !important;
        }

        .table.table-bordered td,
        .table.table-bordered th {
            border: 1px solid black !important;
        }

        .input-dotted {
            border: none !important;
            border-bottom: 1px dotted black !important;
        }
    </style>
</head>

<body class="p-2">
    <div class="w-100 text-right">MR 01.35.001.REV 1</div>
    <table class="w-100">
        <tr>
            <td class="align-top" style="width: 47.5%;">
                <div class="px-4 py-3 border" style="height: 100%;">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                    <div class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</div>
                </div>
            </td>
            <td style="width: 5%;"></td>
            <td class="align-top" style="width: 47.5%;">
                <div class="float-right px-4 py-3 border" style="height: 100%;">
                    <table>
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $dokumen->nama_pasien }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $dokumen->nrm }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $layanan->ktp }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table class="mt-2">
        <tr>
            <td class="align-middle">Tanggal Pelaksanaan</td>
            <td class="align-middle">: <input type="text" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" class="input-dotted rounded-0 datepicker" value="{{ $data && $data->tanggal_pelaksanaan ? $data->tanggal_pelaksanaan->format('d/m/Y') : '' }}" /></td>
        </tr>
    </table>
    <table cellpadding="0" class="w-100 mt-2">
        <thead>
            <tr>
                <th colspan="16" class="p-1 border bg-dark font-weight-bold text-uppercase text-white text-center">Observasi Cairan</th>
            </tr>
            <tr class="text-center">
                <th rowspan="3" class="border">Jenis Cairan dan Tambahan</th>
                <th rowspan="3" class="border">KOLF</th>
                <th colspan="7" class="border text-uppercase">Cairan Masuk</th>
                <th colspan="6" class="border text-uppercase">Cairan Keluar</th>
                <th rowspan="3" class="border">Nama Perawat</th>
            </tr>
            <tr>
                <th colspan="4" class="border text-center align-middle text-uppercase">Intravena</th>
                <th colspan="3" class="border text-center align-middle text-uppercase">Oral</th>
                <th rowspan="2" class="border text-center align-middle text-uppercase">Jam</th>
                <th rowspan="2" class="border text-center align-middle text-uppercase">Urine</th>
                <th rowspan="2" class="border text-center align-middle text-uppercase">Muntah</th>
                <th rowspan="2" class="border text-center align-middle text-uppercase">BAB</th>
                <th rowspan="2" class="border text-center align-middle text-uppercase">NGT</th>
                <th rowspan="2" class="border text-center align-middle">Drain</th>
            </tr>
            <tr>
                <th class="border text-center align-middle text-uppercase">Jam</th>
                <th class="border text-center align-middle text-uppercase">CC</th>
                <th class="border text-center align-middle text-uppercase">Jenis Cairan</th>
                <th class="border text-center align-middle text-uppercase">CCMSK</th>
                <th class="border text-center align-middle text-uppercase">Minum</th>
                <th class="border text-center align-middle text-uppercase">Makan</th>
                <th class="border text-center align-middle text-uppercase">Sonde</th>
            </tr>
        </thead>
        <tbody class="table-data">
            @foreach(['Pagi', 'Sore', 'Malam'] as $waktu)
            @if($data && $data->{Illuminate\Support\Str::lower($waktu)} && is_array($data->{Illuminate\Support\Str::lower($waktu)}))
            <?php for ($x = 0; $x < count($data->{Illuminate\Support\Str::lower($waktu)}); $x++) : ?>
                @if(isset($data->{Illuminate\Support\Str::lower($waktu)}[$x]))
                <?php $temp = $data->{Illuminate\Support\Str::lower($waktu)}[$x]; ?>
                <tr data-index="{{ $x }}" data-waktu="{{ Str::lower($waktu) }}">
                    <td class="p-1 border">
                        <input type="text" class="input-dotted" name="{{ Str::lower($waktu) }}[{{ $x }}][Jenis Cairan dan Tambahan]" value="{{ isset($temp['Jenis Cairan dan Tambahan']) ? $temp['Jenis Cairan dan Tambahan'] : '' }}" />
                    </td>
                    <td class="p-1 border">
                        <input type="text" class="input-dotted" name="{{ Str::lower($waktu) }}[{{ $x }}][KOLF]" style="width: 100%;" value="{{ isset($temp['KOLF']) ? $temp['KOLF'] : '' }}" />
                    </td>
                    @foreach($attributes['Cairan Masuk'] as $attribute => $value)
                    @foreach($value as $key => $attr)
                    <td class="p-1 border baris">
                        <input type="text" class="input-dotted {{ Str::slug($attr, '-') == 'jam' ? 'timepicker' : '' }} {{ Str::lower($waktu) }} cairan-masuk {{ Str::slug($attribute, '-') }} {{ Str::slug($attr, '-') }}" name="{{ Str::lower($waktu) }}[{{ $x }}][Cairan Masuk][{{ $attribute }}][{{ $attr }}]" data-waktu="{{ $waktu }}" data-attr1="Cairan Masuk" data-attr2="{{ $attribute }}" data-attr3="{{ $attr }}" style="width: 100%;" value="{{ isset($temp['Cairan Masuk'][$attribute][$attr]) ? $temp['Cairan Masuk'][$attribute][$attr] : '' }}" />
                    </td>
                    @endforeach
                    @endforeach
                    @foreach($attributes['Cairan Keluar'] as $attr)
                    <td class="p-1 border baris">
                        <input type="text" class="input-dotted {{ Str::slug($attr, '-') == 'jam' ? 'timepicker' : '' }} {{ Str::lower($waktu) }} cairan-keluar {{ Str::slug($attr, '-') }}" name="{{ Str::lower($waktu) }}[{{ $x }}][Cairan Keluar][{{ $attr }}]" data-waktu="{{ $waktu }}" data-attr1="Cairan Keluar" data-attr2="{{ $attr }}" style="width: 100%;" value="{{ isset($temp['Cairan Keluar'][$attr]) ? $temp['Cairan Keluar'][$attr] : '' }}" />
                    </td>
                    @endforeach
                    <td class="p-1 border">
                        <div class="d-flex">
                            <input type="text" class="input-dotted" name="{{ Str::lower($waktu) }}[{{ $x }}][Nama Perawat]" data-key="Nama Perawat" value="{{ isset($temp['Nama Perawat']) ? $temp['Nama Perawat'] : '' }}" readonly />
                            <div class="btn-group ml-1">
                                <button type="button" class="btn btn-sm btn-success btn-save-row" data-action="save" title="Simpan"><i class="fa fa-floppy-o"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn-delete-row" data-action="delete" title="Hapus"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
            <?php endfor; ?>
            @else
            <?php $index = $data && $data->{Illuminate\Support\Str::lower($waktu)} && is_array($data->{Illuminate\Support\Str::lower($waktu)}) ? count($data->{Illuminate\Support\Str::lower($waktu)}) : 0 ?>
            <tr data-index="{{ $index }}" data-waktu="{{ Str::lower($waktu) }}">
                <td class="p-1 border"><input type="text" class="input-dotted" name="{{ Str::lower($waktu) }}[{{ $index }}][Jenis Cairan dan Tambahan]" /></td>
                <td class="p-1 border"><input type="text" class="input-dotted" name="{{ Str::lower($waktu) }}[{{ $index }}][KOLF]" style="width: 100%;" /></td>
                @foreach($attributes['Cairan Masuk'] as $attribute => $value)
                @foreach($value as $key => $attr)
                <td class="p-1 border baris">
                    <input type="text" class="input-dotted {{ Str::slug($attr, '-') == 'jam' ? 'timepicker' : '' }} {{ Str::lower($waktu) }} cairan-masuk {{ Str::slug($attribute, '-') }} {{ Str::slug($attr, '-') }}" name="{{ Str::lower($waktu) }}[{{ $index }}][Cairan Masuk][{{ $attribute }}][{{ $attr }}]" data-waktu="{{ $waktu }}" data-attr1="Cairan Masuk" data-attr2="{{ $attribute }}" data-attr3="{{ $attr }}" style="width: 100%;" />
                </td>
                @endforeach
                @endforeach
                @foreach($attributes['Cairan Keluar'] as $attr)
                <td class="p-1 border baris">
                    <input type="text" class="input-dotted {{ Str::slug($attr, '-') == 'jam' ? 'timepicker' : '' }} {{ Str::lower($waktu) }} cairan-keluar {{ Str::slug($attr, '-') }}" name="{{ Str::lower($waktu) }}[{{ $index }}][Cairan Keluar][{{ $attr }}]" data-waktu="{{ $waktu }}" data-attr1="Cairan Keluar" data-attr2="{{ $attr }}" style="width: 100%;" />
                </td>
                @endforeach
                <td class="p-1 border">
                    <div class="d-flex">
                        <input type="text" class="input-dotted" name="{{ Str::lower($waktu) }}[{{ $index }}][Nama Perawat]" data-key="Nama Perawat" value="{{ auth()->user()->realname }}" readonly />
                        <div class="btn-group ml-1">
                            <button type="button" class="btn btn-sm btn-success btn-save-row" data-action="save" title="Simpan"><i class="fa fa-floppy-o"></i></button>
                            <button type="button" class="btn btn-sm btn-danger btn-delete-row" data-action="delete" title="Hapus"><i class="fa fa-trash-o"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            @endif
            <tr>
                <td class="p-1 border" colspan="16">
                    <button type="button" class="btn btn-md btn-block btn-secondary btn-add-row" data-waktu="{{ $waktu }}" title="Tambah Data {{ $waktu }}"><i class="fa fa-plus-square-o mr-2"></i>Tambah Data {{ $waktu }}</button>
                </td>
            </tr>
            <tr>
                <td class="px-2 border text-center align-middle text-uppercase">Total {{ $waktu }}</td>
                <td class="px-2 border"></td>
                @foreach($attributes['Cairan Masuk'] as $attribute => $value)
                @foreach($value as $key => $attr)
                <td class="px-2 border {{ in_array($attr, ['CC', 'CCMSK', 'Minum', 'Makan', 'Sonde']) ? 'total' : ''}} {{ Str::lower($waktu) }} cairan-masuk {{ Str::slug($attribute, '-') }} {{ Str::slug($attr, '-') }}" data-waktu="{{ $waktu }}" data-attr1="Cairan Masuk" data-attr2="{{ $attribute }}" data-attr3="{{ $attr }}"></td>
                @endforeach
                @endforeach
                @foreach($attributes['Cairan Keluar'] as $attr)
                <td class="px-2 border {{ in_array($attr, ['Urine', 'Muntah', 'BAB', 'NGT', 'Drain']) ? 'total' : ''}} {{ Str::lower($waktu) }} cairan-keluar {{ Str::slug($attr, '-') }}" data-waktu="{{ $waktu }}" data-attr1="Cairan Keluar" data-attr2="{{ $attr }}"></td>
                @endforeach
                <td class="px-2 border"></td>
            </tr>
            <tr>
                <td class="px-2 border text-center align-middle text-uppercase">Balance</td>
                @if($waktu == 'Pagi')
                <td class="px-2 border align-middle" colspan="15">Jam 07.00 - 14.00 WIB</td>
                @elseif($waktu == 'Sore')
                <td class="px-2 border align-middle" colspan="15">Jam 15.00 - 21.00 WIB</td>
                @elseif($waktu == 'Malam')
                <td class="px-2 border align-middle" colspan="15">Jam 21.00 - 06.00 WIB</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="mt-2 w-100">
        <tr>
            <td class="p-2 border" style="width: 30%;">
                <table class="w-100">
                    <tr>
                        <td>Cairan Masuk</td>
                        <td>=</td>
                        <td><input type="number" name="cairan_masuk" id="cairan_masuk" class="input-dotted text-right" value="{{ $data ? $data->cairan_masuk : '' }}" readonly />ml</td>
                    </tr>
                    <tr>
                        <td>Cairan Keluar</td>
                        <td>=</td>
                        <td><input type="number" name="cairan_keluar" id="cairan_keluar" class="input-dotted text-right" value="{{ $data ? $data->cairan_keluar : '' }}" readonly />ml</td>
                    </tr>
                    <tr>
                        <td>Diuresis / 24 Jam</td>
                        <td>=</td>
                        <td><input type="number" name="diuresis_24_jam" id="diuresis_24_jam" class="input-dotted text-right" value="{{ $data ? $data->diuresis_24_jam : '' }}" />ml</td>
                    </tr>
                    <tr>
                        <td>IWL / 24 Jam</td>
                        <td>=</td>
                        <td><input type="number" name="iwl_24_jam" id="iwl_24_jam" class="input-dotted text-right" value="{{ $data ? $data->iwl_24_jam : '' }}" />ml</td>
                    </tr>
                    <tr>
                        <td>Balance Cairan</td>
                        <td>=</td>
                        <td><input type="number" name="balance_cairan" id="balance_cairan" class="input-dotted text-right" value="{{ $data ? $data->balance_cairan : '' }}" readonly />ml</td>
                    </tr>
                </table>
            </td>
            <td style="width: 10%;"></td>
            <td class="p-2" style="width: 60%;">
                Keterangan:
                <table class="w-100">
                    <tr>
                        <td>Urin / diuresis</td>
                        <td>=</td>
                        <td>0,5 ml - 1 ml / jam</td>
                    </tr>
                    <tr>
                        <td>IWL Dewasa</td>
                        <td>=</td>
                        <td>10 ml/kg BB / jam</td>
                    </tr>
                    <tr>
                        <td>IWL Anak</td>
                        <td>=</td>
                        <td>(30 - usia dalam tahun) x BB/24 jam</td>
                    </tr>
                    <tr>
                        <td>IWL Bayi</td>
                        <td>=</td>
                        <td>30 ml/kg BB / jam</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://malsup.github.io/jquery.blockUI.js"></script>
    <script>
        $(function() {
            $.fn.blockMessage = function(message = 'Sedang memproses...', color = "#FFF") {
                this.block({
                    message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp;' +
                        message +
                        "</span>",
                    overlayCSS: {
                        backgroundColor: color,
                        opacity: 0.8,
                        cursor: "wait",
                    },
                    css: {
                        border: 0,
                        padding: "10px 15px",
                        color: "#fff",
                        width: "auto",
                        "-webkit-border-radius": 2,
                        "-moz-border-radius": 2,
                        backgroundColor: "#333",
                    },
                });

                return this;
            };

            $.fn.unblockMessage = function() {
                this.unblock();

                return this;
            };

            function countTotal() {
                $('.table-data input.cairan-masuk, .table-data input.cairan-keluar').each(function(index, elem) {
                    const waktu = $(this).data('waktu');
                    const data = $(this).data();
                    var inputFiltered = $('input').filter(function() {
                        var match = true;
                        var element = $(this);

                        $.each(data, function(key, value) {
                            if (element.data(key) !== value) {
                                match = false;
                                return false;
                            }
                        });

                        return match;
                    });
                    var total = 0;
                    inputFiltered.each(function(index, el) {
                        const value = $(el).val();
                        if (!isNaN(value) && value != '') total += parseFloat(value);
                    });
                    $('td.total').filter(function() {
                        var match = true;
                        var element = $(this);

                        $.each(data, function(key, value) {
                            if (element.data(key) !== value) {
                                match = false;
                                return false;
                            }
                        });

                        if (match) {
                            element.text(total);
                        }
                    });
                });

                let totalCairanMasuk = 0;
                $('.table-data .total.cairan-masuk').each(function(index, el) {
                    if ($(el).attr('data-attr3') != "CC") {
                        const value = $(el).text();
                        if (!isNaN(value) && value != '') totalCairanMasuk += parseFloat(value);
                    }
                });
                $('#cairan_masuk').val(totalCairanMasuk);

                let totalCairanKeluar = 0;
                $('.table-data .total.cairan-keluar').each(function(index, el) {
                    const value = $(el).text();
                    if (!isNaN(value) && value != '') totalCairanKeluar += parseFloat(value);
                });
                $('#cairan_keluar').val(totalCairanKeluar);

                let diuresis24Jam = $('#diuresis_24_jam').val();
                if (!isNaN(diuresis24Jam) && diuresis24Jam != '') diuresis24Jam = parseFloat(diuresis24Jam);
                else diuresis24Jam = 0;

                let iwl24Jam = $('#iwl_24_jam').val();
                if (!isNaN(iwl24Jam) && iwl24Jam != '') iwl24Jam = parseFloat(iwl24Jam);
                else iwl24Jam = 0;

                $('#balance_cairan').val(totalCairanMasuk - totalCairanKeluar - diuresis24Jam - iwl24Jam);
            }

            $('#diuresis_24_jam, #iwl_24_jam').on('change, keyup', function(e) {
                countTotal();
            });

            function initControl() {
                $('.table-data input').prop('autocomplete', 'off');

                $('[data-toggle="tooltip"]').tooltip();

                $('select.form-control.select2').select2({
                    width: '100%',
                    placeholder: 'Pilih',
                    theme: 'bootstrap',
                });

                $('.datepicker').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY',
                    },
                    singleDatePicker: true,
                    timePicker: false,
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

                $('input.cairan-masuk, input.cairan-keluar').on('change, keyup', function(e) {
                    countTotal();
                });
            }

            initControl();
            countTotal();

            var validator = null;

            $('#passwordModal').on('show.bs.modal', function(e) {
                $('form #tanggal, form #jam').prop('required', true);
                $('form input:hidden[name="action"]').val('Verifikasi');
                $('#passwordModal #verify-password').prop('required', true);
            });

            $('#passwordModal').on('hidden.bs.modal', function(e) {
                $('#verify-password').val(null).prop('required', false);
                $('form input:hidden[name="action"]').val('Simpan');
                $('form input, form select, form textarea').prop('required', false);
                if (validator != null) validator.destroy();
            });

            $('form .btn-verify').on('click', function(e) {
                e.preventDefault();

                validator = $('form').validate({
                    debug: true,
                    showErrors: function(errorMap, errorList) {
                        if (Array.isArray(errorList) && errorList.length > 0) {
                            const el = $(errorList[0].element);
                            el.attr('data-toggle', 'tooltip');
                            el.attr('data-placement', 'top');
                            el.prop('title', String(el.prop('type')) == 'radio' ? 'Harus dipilih.' : 'Harus diisi.');
                            el.focus();
                            el.tooltip('show');
                        }
                    }
                });

                if ($('form input:hidden[name="action"]').val() == 'Verifikasi' && $('form').valid()) {
                    validator.destroy();
                    $('form').submit();
                } else {
                    $('#passwordModal').modal('hide');
                }
            });

            $('form .btn-save').click(function(e) {
                $('form').trigger('submit');
            });

            const bindSaveEvent = function(e) {
                e.preventDefault();

                var action = $(this).data('action');
                var row = $(this).closest('tr');
                var data = row.find('input').serializeArray();
                data.push({
                    name: 'action',
                    value: action,
                });
                data.push({
                    name: '_token',
                    value: '{{ csrf_token() }}',
                });
                ['tanggal_pelaksanaan', 'cairan_masuk', 'cairan_keluar', 'diuresis_24_jam', 'iwl_24_jam', 'balance_cairan'].forEach(function(elId, idx) {
                    data.push({
                        name: elId,
                        value: $('#' + elId).val(),
                    });
                });
                if (action == 'delete') {
                    data.push({
                        name: 'index',
                        value: row.data('index'),
                    });
                }

                $.ajax({
                    url: '{{ request()->fullUrl() }}',
                    method: 'POST',
                    data: data,
                    beforeSend: function(xhr, settings) {
                        row.blockMessage();
                    },
                    success: function(data, status, xhr) {
                        row.unblockMessage();
                        toastr.success('Aksi berhasil dijalankan.', 'Sukses');
                        if (action == 'delete') {
                            setTimeout(function() {
                                row.remove();
                                location.reload();
                            }, 300);
                        }
                    },
                    error: function(xhr, status, error) {
                        row.unblockMessage();
                        toastr.error(xhr.responseText ?? 'Terjadi kesalahan', 'Gagal');
                    },
                });
            };

            $('.btn-save-row').on('click', bindSaveEvent);
            $('.btn-delete-row').on('click', bindSaveEvent);

            $('.btn-add-row').on('click', function(e) {
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                var lastRow = currentRow.prev('tr');
                var lastIndex = lastRow.data('index');
                var waktu = lastRow.data('waktu');
                var newRow = lastRow.clone();
                var newIndex = lastIndex + 1;
                newRow.attr('data-index', newIndex);
                newRow.find('input:not(input[data-key="Nama Perawat"])').val(null);
                newRow.find('input').each(function(index, el) {
                    var name = $(el).prop('name');
                    name = name.replace(waktu + '[' + lastIndex + ']', waktu + '[' + newIndex + ']');
                    $(el).prop('name', name);
                });
                newRow.insertAfter(lastRow);

                initControl();
                $('.btn-save-row, .btn-delete-row').off('click');
                $('.btn-save-row, .btn-delete-row').on('click', bindSaveEvent);
            });
        });
    </script>
</body>

</html>