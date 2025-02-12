<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Formulir Kriteria Pasien Keluar ICU</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"
        integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="container-fluid">
        <div class="row align-items-stretch justify-conten-between">
            <div class="col-sm-12 col-md-3">
                <div class="w-100" style="padding:30px; padding-bottom:0; font-weight: bold;">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 100px;">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 text-center font-weight-bold my-auto" style="font-size: 20px">
                FORMULIR
                KRITERIA PASIEN KELUAR ICU</div>
            <div class="col-sm-12 col-md-3 text-right pr-5 ">
                MR 02.33.001.Rev.0
                <table>
                    <tr style="text-align: left">
                        <th>Nama</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ $layanan->nama_pasien }}</th>
                    </tr>
                    <tr style="text-align: left">
                        <th>No. RM</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ $layanan->nrm }}</th>
                    </tr>
                    <tr style="text-align: left">
                        <th>Tgl Lahir</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</th>
                    </tr>
                    <tr style="text-align: left">
                        <th>Jenis Kelamin</th>
                        <th class="pl-3 pr-3"> : </th>
                        <th>{{ $layanan->jk ? 'Perempuan' : 'Laki-Laki' }}</th>
                    </tr>
                </table>
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
            <form method="post" class="col-12" autocomplete="off">
                @csrf
                <input type="hidden" name="action" value="Simpan" />
                <input type="hidden" name="nrm" value="{{ $dokumen->nrm }}" />
                <input type="hidden" name="noreg" value="{{ $dokumen->noreg }}" />
                <table class="table table-bordered font-weight-bold W-100" style="margin-bottom: 0">
                    <tr>
                        <td>
                            <label for="ruangan" style="width: 230px">RUANGAN</label>:
                            <select name="ruangan" id="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($ruangan as $ru)
                                <option @if(old('ruangan')) {{ old('ruangan') == $ru->slug ? 'selected' : '' }} @else {{ is_null($data) ? ($ru->slug == $layanan->last_ruangan ? 'selected' : '') : ($ru->slug == $data->ruangan ? 'selected' : '') }} @endif value="{{ $ru->slug }}">{{ $ru->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <label for="nama" style="width: 230px">DIAGNOSA</label>:
                            <input type="text" name="diagnosa" id="diagnosa" class="form-control"
                                value="{{ old('diagnosa') ?? ($data && $data->diagnosa ? $data->diagnosa : '') }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="id_dokter_yang_merawat" style="width: 230px">DOKTER YANG MERAWAT</label>:
                            <select name="id_dokter_yang_merawat" id="id_dokter_yang_merawat"
                                class="w-100 form-control select2">
                                <option disabled selected></option>
                                @foreach($dokter_yang_merawat as $dokter)
                                <option value="{{ $dokter->id }}" {{ old('id_dokter_yang_merawat')==$dokter->id
                                    || ($data && $data->id_dokter_yang_merawat == $dokter->id) ? 'selected'
                                    :
                                    '' }}>{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <label for="id_dokter_yang_merawat" style="width: 230px">DOKTER KONSULANT ICU</label>:
                            <select name="id_dokter_konsulant_icu" id="id_dokter_konsulant_icu"
                                class="w-100 form-control select2">
                                <option disabled selected></option>
                                @foreach($dokter_konsulant_icu as $dokter)
                                <option value="{{ $dokter->id }}" {{ old('id_dokter_konsulant_icu')==$dokter->id
                                    || ($data && $data->id_dokter_konsulant_icu == $dokter->id) ? 'selected'
                                    : ''
                                    }}>{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="d-flex my-3 w-25">
                    <label for="tanggal" class="mr-4 my-auto">Tanggal:</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control datepicker"
                        value="{{ old('tanggal') ?? ($data && $data->tanggal ? $data->tanggal->format('d/m/Y') : '') }}" />
                </div>
                <table class="table table-bordered" cellpadding="0">
                    <tr>
                        <td style="width: 100px">NO</td>
                        <td colspan="9"></td>
                        <td style="width: 200px">YA</td>
                        <td style="width: 200px">TIDAK</td>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td colspan="9">
                            <span>Pasien tidak lagi memerlukan alat bantu atau obat untuk life-support</span><br><br>
                            @foreach([
                            'Masker NRM',
                            'Masker RM',
                            'Jacson Rees',
                            'Ventilator',
                            'Dopamin',
                            'Dobutamin',
                            'Vascon',
                            'Adrenalin',
                            'Nicardipine',
                            ] as $index => $item)
                            @if ($item == "Dopamin")
                            <br>
                            <br>
                            @endif
                            <span class="ml-5">
                                <input class="form-check-input position-static ignore-check" type="checkbox"
                                    name="etcNo1[]" id="{{ Illuminate\Support\Str::slug($item, '-') }}"
                                    value="{{ $item }}" aria-label="{{ $item }}" {{ is_array($data->etcNo1) &&
                                in_array($item,$data->etcNo1) ? 'checked' : '' }} />
                                <label for="{{ Illuminate\Support\Str::slug($item, '-') }}">{{ $item }}</label>
                            </span>
                            @endforeach
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no1" id="no1-1"
                                    value="1" {{ isset($data->no1)
                                &&
                                $data->no1 == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no1" id="no1-0"
                                    value="0" {{ isset($data->no1)
                                &&
                                $data->no1 == 0 ? 'checked' : '' }} />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>II</td>
                        <td colspan="9">Terapi telah dinyatakan gagal, prognosis jangka pendek jelek dan manfaat
                            kelanjutan terapi intensif kecil (gagal multi oragan tidak berespons terhadap terapi
                            agresif).</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no2" id="no2-1"
                                    value="1" {{ isset($data->no2)
                                &&
                                $data->no2 == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no2" id="no2-0"
                                    value="0" {{ isset($data->no2)
                                &&
                                $data->no2 == 0 ? 'checked' : '' }} />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>III</td>
                        <td colspan="9">Pasien dalam kondisi stabil normal (sesuai parameter base line) dan kemungkinan
                            kebutuhan terapi intensif secara mendadak kecil/kurang.<br><br>
                            <label for="no3" class="form-check-label">
                                <span class="mr-4 ml-3">Tensi:<input class="input-dotted text-center"
                                        style="width: 60px" type="text" name="tensi" id="no3-tensi"
                                        value="{{ isset($tanda_vital->tensi)?$tanda_vital->tensi:'' }}"
                                        aria-label="tensi">mmhg</span>
                                <span class="mr-4">Nadi:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="nadi" id="no3-nadi"
                                        value="{{ isset($tanda_vital->nadi)?$tanda_vital->nadi:'' }}"
                                        aria-label="nadi">x/mnt</span>
                                <span class="mr-4">Rr:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="rr" id="no3-rr"
                                        value="{{ isset($tanda_vital->rr)?$tanda_vital->rr:'' }}"
                                        aria-label="rr">x/mnt</span>
                                <span class="mr-4">Suhu:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="suhu" id="no3-suhu"
                                        value="{{ isset($tanda_vital->suhu)?$tanda_vital->suhu:'' }}"
                                        aria-label="suhu">&deg;C</span>
                                <span>Berat Badan:<input class="input-dotted text-center" style="width: 60px"
                                        type="text" name="berat_badan" id="no3-berat_badan"
                                        value="{{ isset($tanda_vital->berat_badan)?$tanda_vital->berat_badan:'' }}"
                                        aria-label="berat_badan">kg</span>
                            </label>
                        </td>
                        <td>
                            <dv class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no3" id="no3-1"
                                    value="1" {{ isset($data->no3)
                                &&
                                $data->no3 == 1 ? 'checked' : '' }} />
                            </dv>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no3" id="no3-0"
                                    value="0" {{ isset($data->no3)
                                &&
                                $data->no3 == 0 ? 'checked' : '' }} />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>IV</td>
                        <td colspan="9">Manfaat terapi intensif kecil karena penyakit primernya sudah terminal, tidak
                            berespons terhadap terapi ICU untuk penyakit akutnya, prognosis jangka pendek kecil dan
                            tidak ada terapi potensial untuk memperbaiki prognosisnya.<br><br>
                            <span class="ml-3">
                                LAIN - LAIN :
                            </span>
                            <br>
                            <span>
                                <textarea name="etcNo4" id="etcNo4" class="w-100 p-3 ignore-check"
                                    rows="8">{{ isset($data->etcNo4) ? $data->etcNo4 : '' }}</textarea>
                            </span>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no4" id="no4-1"
                                    value="1" {{ isset($data->no4)
                                &&
                                $data->no4 == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="no4" id="no4-0"
                                    value="0" {{ isset($data->no4)
                                &&
                                $data->no4 == 0 ? 'checked' : '' }} />
                            </div>
                        </td>
                    </tr>
                </table>
                <span class="ml-5">Berdasarkan kondisi diatas maka pasien tersebut memenuhi kriteria untuk keluar
                    ICU</span>
                <div class="w-100 justify-content-between d-flex">
                    <div style="margin-top: 50px; margin-left: 100px">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-outline-secondary">Simpan</button>
                        </div>
                    </div>

                    <div style="margin-right: 300px">
                        <b>DPJP/Konsultan ICU</b>
                        <div style="height: 128px;" class="d-flex align-items-center">
                            @if ($data && $data->status && $dokumen && $dokumen->status &&
                            $dokumen->id_verifikator)
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}"
                                style="height: 100%;object-fit: contain;" alt="">
                            @else
                            <div class="btn-group">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#passwordModal">Verifikasi</button>
                            </div>
                            @endif
                        </div>
                        <div>Nama: {{ $dokumen->nama_verifikator ?? '' }}</div>
                    </div>
                </div>

                <div class="modal fade" id="passwordModal" data-backdrop="static" tabindex="-1"
                    aria-labelledby="passwordModalLabel" aria-hidden="true">
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
                                <button type="button" class="btn btn-outline-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="button"
                                    class="btn btn-primary btn-submit-password btn-verify">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"
        integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

            var validator = null;

            $('#passwordModal').on('show.bs.modal', function(e) {
                $('form input:not([id^="catatan-"]):not([type="radio"][id^="item-0-"]), form select, form textarea').prop('required', false);
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
                    ignore : ".ignore-check",
                    showErrors: function(errorMap, errorList) {
                        if (Array.isArray(errorList) && errorList.length > 0) {
                            console.log(errorList);
                            const el = $(errorList[0].element);
                            el.attr('data-toggle', 'tooltip');
                            el.attr('data-placement', 'top');
                            el.prop('title', String(el.prop('name')).includes('no') ? 'Harus dipilih minimal satu.' : 'Harus diisi.');
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
