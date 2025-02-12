<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Daftar Tilik Pasien Operasi</title>
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
    </style>
</head>

<body class="p-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-right">MR 02.25.001.REV 0</div>
        </div>
        <div class="row align-items-stretch justify-conten-between">
            <div class="col-sm-12 col-md-5">
                <div class="w-100" style="border: 2px solid; padding:30px; font-weight: bold;">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                    <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
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
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $layanan->ktp }}</td>
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
            <form method="post" class="col-12" autocomplete="off">
                @csrf
                <input type="hidden" name="action" value="Simpan" />
                <table cellpadding="0" class="w-100 mt-2">
                    <tr>
                        <td class="p-2 border bg-dark text-light text-center">Daftar Tilik Pasien Operasi</td>
                    </tr>
                    <tr>
                        <td class="border p-2">
                            <table class="w-100">
                                <tr>
                                    <td style="width: 200px;"><label for="tanggal">Tanggal</label></td>
                                    <td>:</td>
                                    <td class="pr-2"><input type="text" name="tanggal" id="tanggal" class="form-control datepicker" value="{{ old('tanggal') ?? ($data && $data->tanggal ? $data->tanggal->format('d/m/Y') : '') }}" /></td>
                                    <td style="width: 200px;"><label for="asal_unit">Asal Unit</label></td>
                                    <td>:</td>
                                    <td class="pr-2">
                                        <select name="asal_unit" id="asal_unit" class="w-100 form-control select2">
                                            <option disabled selected></option>
                                            @foreach($asal_units as $asal_unit)
                                            <option value="{{ $asal_unit }}" {{ old('asal_unit') == $asal_unit || ($data && $data->asal_unit == $asal_unit) ? 'selected' : '' }}>{{ $asal_unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="transfer_ke">Transfer Ke</label></td>
                                    <td>:</td>
                                    <td class="pr-2"><input type="text" name="transfer_ke" id="transfer_ke" class="form-control" value="Kamar Operasi" readonly /></td>
                                    <td><label for="jam_transfer">Jam Transfer</label></td>
                                    <td>:</td>
                                    <td class="pr-2"><input type="text" name="jam_transfer" id="jam_transfer" class="form-control timepicker" value="{{ old('jam_transfer') ?? ($data && $data->jam_transfer ? $data->jam_transfer : '') }}" /></td>
                                </tr>
                                <tr>
                                    <td><label for="tindakan_operasi">Tindakan / Operasi</label></td>
                                    <td>:</td>
                                    <td class="pr-2"><input type="text" name="tindakan_operasi" id="tindakan_operasi" class="form-control" value="{{ old('tindakan_operasi') ?? ($data && $data->tindakan_operasi ? $data->tindakan_operasi : '') }}" /></td>
                                    <td><label for="jam_rencana_operasi">Rencana Operasi Jam</label></td>
                                    <td>:</td>
                                    <td class="pr-2"><input type="text" name="jam_rencana_operasi" id="jam_rencana_operasi" class="form-control timepicker" value="{{ old('jam_rencana_operasi') ?? ($data && $data->jam_rencana_operasi ? $data->jam_rencana_operasi : '') }}" /></td>
                                </tr>
                                <tr>
                                    <td><label for="id_dokter_spesialis">Dokter Spesialis</label></td>
                                    <td>:</td>
                                    <td class="pr-2">
                                        <select name="id_dokter_spesialis" id="id_dokter_spesialis" class="w-100 form-control select2">
                                            <option disabled selected></option>
                                            @foreach($dokter_spesialis as $dokter)
                                            <option value="{{ $dokter->id }}" {{ old('id_dokter_spesialis') == $dokter->id || ($data && $data->id_dokter_spesialis == $dokter->id) ? 'selected' : '' }}>{{ $dokter->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><label for="id_dokter_anestesi">Spesialis Anestesi</label></td>
                                    <td>:</td>
                                    <td class="pr-2">
                                        <select name="id_dokter_anestesi" id="id_dokter_anestesi" class="w-100 form-control select2">
                                            <option disabled selected></option>
                                            @foreach($dokter_anestesi as $dokter)
                                            <option value="{{ $dokter->id }}" {{ old('id_dokter_anestesi') == $dokter->id || ($data && $data->id_dokter_anestesi == $dokter->id) ? 'selected' : '' }}>{{ $dokter->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="border p-2">
                            <table class="w-100 table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-center">Daftar Periksa</th>
                                        <th class="text-uppercase text-center">Ya</th>
                                        <th class="text-uppercase text-center">Tidak</th>
                                        <th class="text-uppercase text-center">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach([
                                    'Berkas rekam medis',
                                    'Puasa sesuai ketentuan',
                                    'Lepas gigi palsu, kaca mata, kontak lensa, hearing aid, wig telah dilepas dan disimpan',
                                    'Gelang identitas terpasang, lengkap, benar',
                                    'Edukasi nyeri pasca operasi',
                                    'Persetujuan tindakan / operasi',
                                    'Persetujuan anestesi',
                                    'Penandaan lokasi operasi (Site Marking)',
                                    'Asesmen beda dan pra operasi lengkap',
                                    'Persiapan darah, termasuk persetujuan transfusi bila ada',
                                    'Persiapan implan',
                                    'Stabilisasi kondisi pasien' => ['Terpasang Infus', 'Terpasang Kateter'],
                                    'Konsul dokter anak',
                                    'Konsul dokter penyakit dalam',
                                    'Konsul dokter kardiologi',
                                    'Konsul dokter anastesi',
                                    'Konsul dokter paru',
                                    'Golongan darah dan darah tersedia',
                                    'Formulir transfer terisi lengkap',
                                    'Hasil laboratorium terlampir',
                                    'Hasil radiologi, USG, CT Scan, MRI',
                                    'Huknah / Klisma',
                                    'Kebersihan Pasien (Mandi dengan antiseptic)',
                                    'Area operasi di cukur',
                                    'Tata rias dan cat kuku di hapus',
                                    'Pesan ICU tersedia',
                                    ] as $index => $item)
                                    @if (!is_array($item))
                                    <tr>
                                        <td class="align-middle"><i class="fa fa-circle mr-4"></i>{{ $item }}</td>
                                        <td class="p-0 align-middle text-center">
                                            <div class="form-check">
                                                <input class="form-check-input position-static" type="radio" name="daftar_periksa[{{ $item }}][nilai]" id="item-1-{{ Str::slug($item, '-') }}" value="1" aria-label="{{ $item }}" {{ isset($data->daftar_periksa[$item]['nilai']) && $data->daftar_periksa[$item]['nilai'] == 1 ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td class="p-0 align-middle text-center">
                                            <div class="form-check">
                                                <input class="form-check-input position-static" type="radio" name="daftar_periksa[{{ $item }}][nilai]" id="item-0-{{ Str::slug($item, '-') }}" value="0" aria-label="{{ $item }}" {{ isset($data->daftar_periksa[$item]['nilai']) && $data->daftar_periksa[$item]['nilai'] == 0 ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td class="p-0 align-middle"><input type="text" name="daftar_periksa[{{ $item }}][catatan]" id="catatan-{{Str::slug($item, '-')}}" class="form-control w-100 bg-transparant border-0 rounded-0 input-dotted" value="{{ isset($data->daftar_periksa[$item]['catatan']) ? $data->daftar_periksa[$item]['catatan'] : '' }}" /></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td><i class="fa fa-circle mr-4"></i>{{ $index }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach($item as $subitem)
                                    <tr>
                                        <td><i class="fa fa-circle-o mr-4 ml-5"></i>{{ $subitem }}</td>
                                        <td class="p-0 align-middle text-center">
                                            <div class="form-check">
                                                <input class="form-check-input position-static" type="radio" name="daftar_periksa[{{ $index }}][{{ $subitem }}][nilai]" id="item-1-{{ Str::slug($subitem, '-') }}" value="1" aria-label="{{ $subitem }}" {{ isset($data->daftar_periksa[$index][$subitem]['nilai']) && $data->daftar_periksa[$index][$subitem]['nilai'] == 1 ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td class="p-0 align-middle text-center">
                                            <div class="form-check">
                                                <input class="form-check-input position-static" type="radio" name="daftar_periksa[{{ $index }}][{{ $subitem }}][nilai]" id="item-0-{{ Str::slug($subitem, '-') }}" value="0" aria-label="{{ $subitem }}" {{ isset($data->daftar_periksa[$index][$subitem]['nilai']) && $data->daftar_periksa[$index][$subitem]['nilai'] == 0 ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td class="p-0 align-middle"><input type="text" name="daftar_periksa[{{ $index }}][{{ $subitem }}][catatan]" id="catatan-{{Str::slug($subitem, '-')}}" class="form-control w-100 bg-transparant border-0 rounded-0 input-dotted" value="{{ isset($data->daftar_periksa[$index][$subitem]['catatan']) ? $data->daftar_periksa[$index][$subitem]['catatan'] : '' }}" /></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="p-1">
                                            <div class="d-flex flex-row align-items-baseline">
                                                <label for="pesan">Pesan:</label>
                                                <input type="text" name="pesan" id="pesan" class="form-control ml-2 flex-grow w-100 bg-transparant border-0 rounded-0 input-dotted" value="{{ old('pesan') ?? ($data && $data->pesan ? $data->pesan : '') }}" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border text-center p-2">
                            <button type="submit" class="btn btn-block btn-outline-secondary btn-save">Simpan</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="border p-2">
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <div>Pelaksana daftar tilik:</div>
                                        <div style="height: 128px;" class="d-flex align-items-center">
                                            @if ($data && $data->status && $data->user_pelaksana)
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->user_pelaksana ? $data->user_pelaksana->hrd_employee ? $data->user_pelaksana->hrd_employee->ttd : '' : '') }}" style="height: 100%;object-fit: contain;" alt="">
                                            @else
                                            <div class="btn-group">
                                                <!-- <button type="submit" class="btn btn-outline-secondary btn-save">Simpan</button> -->
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#passwordModal">Verifikasi</button>
                                            </div>
                                            @endif
                                        </div>
                                        <div>Nama: {{ $data && $data->nama_pelaksana ? $data->nama_pelaksana : '' }}</div>
                                    </td>
                                    <td>
                                        <div>Penerima Pasien:</div>
                                        <div style="height: 128px;" class="d-flex align-items-center">
                                            @if ($data && $data->status && $data->user_penerima)
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->user_penerima ? $data->user_penerima->hrd_employee ? $data->user_penerima->hrd_employee->ttd : '' : '') }}" style="height: 100%;object-fit: contain;" alt="">
                                            @elseif ($data && $data->status)
                                            <div class="btn-group">
                                                <!-- <button type="submit" class="btn btn-outline-secondary">Simpan</button> -->
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#passwordModal">Verifikasi</button>
                                            </div>
                                            @endif
                                        </div>
                                        <div>Nama: {{ $data && $data->nama_penerima ? $data->nama_penerima : '' }}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
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

            var validator = null;

            $('#passwordModal').on('show.bs.modal', function(e) {
                $('form input:not([id^="catatan-"]):not([type="radio"][id^="item-0-"]), form select, form textarea').prop('required', true);
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