<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Early Warning Scoring System (Dewasa)</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .col-input {
            width: 64px;
        }
    </style>
</head>

<body class="p-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-right">MR 01.35.001.REV 1</div>
        </div>
        <div class="row align-items-stretch justify-conten-between">
            <div class="col-sm-12 col-md-5">
                <div class="w-100" style="padding:30px; font-weight: bold;">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                </div>
            </div>
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-5">
                <div class="w-100" style="border: 2px solid; padding:30px; font-weight: bold;height: 100%;">
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
        <div class="row mt-2">
            <div class="col-12">
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
                @if (session()->has('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="p-2 font-weight-bold text-center text-uppercase">Early Warning Scoring System (Dewasa)</h3>
            </div>
        </div>
        <div class="row">
            <form method="post" class="col-12" autocomplete="off">
                @csrf
                <input type="hidden" name="action" value="Simpan" />
                <div class="table-responsive">
                    <table cellpadding="0" class="w-100 mt-2">
                        <tr>
                            <td class="border px-2 py-1" colspan="3">
                                <div class="d-flex align-items-center">
                                    <div style="width: 100px;">Tanggal</div>
                                    <div>:</div>
                                    <input type="text" class="rounded-0 input-dotted datepicker" id="tanggal" name="tanggal" value="{{ $data && $data->tanggal_jam ? $data->tanggal_jam->format('d/m/Y') : '' }}" />
                                </div>
                            </td>
                            <td colspan="24" class="border">&nbsp;</td>
                            <td rowspan="2" class="border">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="border px-2 py-1" colspan="3">
                                <div class="d-flex align-items-center">
                                    <div style="width: 100px;">Jam</div>
                                    <div>:</div>
                                    <input type="text" class="rounded-0 input-dotted timepicker" id="jam" name="jam" value="{{ $data && $data->tanggal_jam ? $data->tanggal_jam->format('H:i') : '' }}" />
                                </div>
                            </td>
                            @for($i=7;$i<=24;$i++) <td class="border text-center" style="width: 30px;">{{ $i }}</td>
                                @endfor
                                @for($i=1;$i<=6;$i++) <td class="border text-center" style="width: 30px;">{{ $i }}</td>
                                    @endfor
                        </tr>
                        <tr>
                            <td class="" colspan="2">&nbsp;</td>
                            <td class="text-center border px-2">Score</td>
                            @for($i=1;$i<=24;$i++) <td class="border text-center" style="width: 30px;">&nbsp;</td>
                                @endfor
                                <td class="border"></td>
                        </tr>
                        @foreach($items as $item)
                        <?php for ($j = 0; $j < count($item['items']); $j++) : ?>
                            <tr>
                                @if($j == 0)
                                <td rowspan="{{ count($item['items']) }}" class="border px-2 text-center align-middle">{{ $item['text'] }}</td>
                                @endif
                                <td class="border px-2 text-nowrap">{{ $item['items'][$j]['kriteria'] }}</td>
                                <td class="text-center border">{{ $item['items'][$j]['score'] }}</td>
                                @for($i=7;$i<=24;$i++) <td class="border text-center col-input">
                                    <div class="form-check">
                                        <input class="form-check-input position-static item-check"
                                        type="radio" name="{{ $item['key'] }}[{{ $i }}]" id="chk-{{ $item['key'] }}-{{ Str::slug($item['items'][$j]['kriteria'], '-') }}-{{ $i }}" value="{{ $item['items'][$j]['score'] }}" data-key="{{ $item['key'] }}" data-hour="{{ $i }}" {{ $isCheckedItem($item['key'], $i, $item['items'][$j]['score'], $item['items'][$j]['kriteria']) }} />
                                    </div>
                                    </td>
                                    @endfor
                                    @for($i=1;$i<=6;$i++) <td class="border text-center col-input">
                                        <div class="form-check">
                                            <input class="form-check-input position-static item-check"
                                            type="radio" name="{{ $item['key'] }}[{{ $i }}]" id="chk-{{ $item['key'] }}-{{ Str::slug($item['items'][$j]['kriteria'], '-') }}-{{ $i }}" value="{{ $item['items'][$j]['score'] }}" data-key="{{ $item['key'] }}" data-hour="{{ $i }}" {{ $isCheckedItem($item['key'], $i, $item['items'][$j]['score'], $item['items'][$j]['kriteria']) }} />
                                        </div>
                                        </td>
                                        @endfor
                                        <td class="border px-2 text-nowrap">{{ $item['items'][$j]['kriteria'] }}</td>
                            </tr>
                        <?php endfor; ?>
                        @if ($item['key'] == 'saturasi_o2')
                        <tr>
                            <td class="border text-center">O2</td>
                            <td class="border px-2">%</td>
                            <td class="border"></td>
                            @for($i=7;$i<=24;$i++) <td class="border text-center col-input">
                                </td>
                                @endfor
                                @for($i=1;$i<=6;$i++) <td class="border text-center col-input">
                                    </td>
                                    @endfor
                                    <td class="border px-2 text-nowrap">%</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="28">&nbsp;</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="border px-2">Total Score</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            @for($i=7;$i<=24;$i++) <td class="border px-2 text-center col-input total-score" data-hour="{{ $i }}">
                                {{ $getTotalScore($i) }}
                                </td>
                                @endfor
                                @for($i=1;$i<=6;$i++) <td class="border px-2 text-center col-input total-score" data-hour="{{ $i }}">
                                    {{ $getTotalScore($i) }}
                                    </td>
                                    @endfor
                                    <td class="border text-nowrap"></td>
                        </tr>
                        <tr>
                            <td colspan="28">&nbsp;</td>
                        </tr>
                        <?php for ($j = 0; $j < count($additional); $j++) : ?>
                            <tr>
                                @if ($j == 0)
                                <td rowspan="{{ count($additional) + 1 }}" class="border px-2 text-center text-uppercase">Parameter Tambahan yang Mendukung</td>
                                @endif
                                <td class="border px-2 text-uppercase text-nowrap">{{ $additional[$j] }}</td>
                                <td class="border px-2"></td>
                                @for($i=7;$i<=24;$i++) <td class="border text-center col-input">
                                    <input type="text" class="rounded-0 input-dotted text-center" style="width: 100%;" name="parameter_tambahan[{{ $additional[$j] }}][{{ $i }}]" value="{{ $getParameterTambahanValue($additional[$j], $i) }}" />
                                    </td>
                                    @endfor
                                    @for($i=1;$i<=6;$i++) <td class="border text-center col-input">
                                        <input type="text" class="rounded-0 input-dotted text-center" style="width: 100%;" name="parameter_tambahan[{{ $additional[$j] }}][{{ $i }}]" value="{{ $getParameterTambahanValue($additional[$j], $i) }}" />
                                        </td>
                                        @endfor
                                        <td class="border px-2 text-nowrap"></td>
                            </tr>
                        <?php endfor; ?>
                        <tr>
                            <td class="border">&nbsp;</td>
                            <td class="border" colspan="26"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border px-2 text-uppercase text-center">Skor 0</td>
                            <td colspan="26" class="border px-2 text-uppercase text-center">Observasi</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border px-2 text-uppercase">Skor 1 s/d 4 (Resiko Ringan)</td>
                            <td colspan="26" class="border px-2 text-uppercase text-center">Asesment segera oleh perawat senior, eskalasi perawatan dan monitoring per 4 sampai 6 jam jika diperlukan konsultasi segera ke dokter jaga</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border px-2 text-uppercase">Skor 5 s/d 6 (Resiko Sedang)</td>
                            <td colspan="26" class="border px-2 text-uppercase text-center">Asesment segera oleh dokter jaga (respon segera, max 5 menit) konsultasi DPJP dan spesialis terkait dan monitoring tiap 1 jam, pertimbangkan perawatan di HCU</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border px-2 text-uppercase text-center">Skor 7 atau lebih / 1 Parameter Kriteria (Resiko Tinggi)</td>
                            <td colspan="26" class="border px-2 text-uppercase text-center">Resusitasi dari monitoring secara terus menerus oleh dokter jaga dan perawat senior, informasikan dan konsultasikan ke DPJP dan transfer ke ICU</td>
                        </tr>
                    </table>
                </div>
                <div class="text-center float-right" style="width: 500px;">
                    <div class="pt-4 d-flex align-items-center justify-content-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-outline-secondary">Simpan</button>
                            <button type="button" class="btn btn-success btn-verifikasi" data-toggle="modal" data-target="#passwordModal">Verifikasi</button>
                        </div>
                        <div class="modal fade" id="passwordModal" data-backdrop="static" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
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
                                        <button type="button" class="btn btn-primary btn-submit-password btn-verify">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($data && $data->status)
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}" style="height: 100%;object-fit: contain;" alt="" />
                    @else
                    <div class="pb-4">&nbsp;</div>
                    @endif
                    <div>{{ $dokumen->nama_verifikator ?? '' }}</div>
                    <div style="text-decoration: underline;">( Ka Instalasi / Dokter Jaga )</div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
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

            $('.item-check').on('click', function(e) {
                let total = {};
                $('.item-check:checked').each(function(index, el) {
                    const hour = $(el).data('hour');
                    const value = parseFloat($(el).val());
                    total[hour] = (total[hour] ?? 0) + value;
                });
                for (const hour in total) {
                    if (Object.hasOwnProperty.call(total, hour)) {
                        const value = total[hour];
                        $('.total-score[data-hour="' + hour + '"]').text(value);
                    }
                }
            });

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
        });
    </script>
</body>

</html>