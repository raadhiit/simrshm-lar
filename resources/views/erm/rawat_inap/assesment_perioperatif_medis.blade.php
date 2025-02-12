<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMIS - Assesment Perioperatif Medis</title>
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
            <div class="col-12 text-right">MR 02.01.007.REV 0</div>
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
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                <div class="mt-1 alert alert-danger alert-dismissible fade show" role="alert">
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
                <div class="mt-1 alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <form class="col-12" method="post" autocomplete="off">
                @csrf
                <input type="hidden" name="id_pasien" value="{{ $dokumen->noreg }}">
                <input type="hidden" name="nrm_pasien" value="{{ $dokumen->nrm }}">
                <input type="hidden" name="nama_pasien" value="{{ $dokumen->nama_pasien }}">
                <input type="hidden" name="ruangan" value="{{ $dokumen->ruangan }}">
                <input type="hidden" name="action" value="Simpan">
                <table cellpadding="0" class="w-100 mt-2">
                    <tr>
                        <td colspan="2" class="p-2 border bg-dark text-light text-center">Assesment Perioperatif Medis</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border p-2">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="mr-1 font-weight-bold">Tanggal Asesmen: </div>
                                    <input name="tanggal_assesment" id="tanggal_assesment" class="input-dotted datepicker" value="{{ old('tanggal_assesment') ?? ($data && $data->tanggal_jam_assesmen ? $data->tanggal_jam_assesmen->format('d/m/Y') : '') }}" />
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mx-1 font-weight-bold">jam: </div>
                                    <input name="jam_assesment" id="jam_assesment" class="input-dotted timepicker" value="{{ old('jam_assesment') ?? ($data && $data->tanggal_jam_assesmen ? $data->tanggal_jam_assesmen->format('H:i') : '') }}" />
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mr-1 font-weight-bold">oleh: </div>
                                    <select name="assesment_oleh" id="assesment_oleh" class="select2">
                                        <option disabled selected></option>
                                        @foreach($pemeriksas as $pemeriksa)
                                        <option value="{{ $pemeriksa }}" {{ $data && $data->assesment_oleh == $pemeriksa ? 'selected' : '' }}>{{ $pemeriksa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mx-1 font-weight-bold">dari: </div>
                                    <select name="assesment_dari" id="assesment_dari" class="select2">
                                        <option disabled selected></option>
                                        @foreach($asal_units as $asal_unit)
                                        <option value="{{ $asal_unit }}" {{ old('assesment_dari') == $asal_unit || $data->assesment_dari == $asal_unit ? 'selected' : '' }}>{{ $asal_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="w-100">
                                <tr>
                                    <td class="align-top font-weight-bold" style="width: 25%;">Asal pasien</td>
                                    <td class="align-top font-weight-bold">:</td>
                                    <td class="align-top">
                                        @foreach(['IGD', 'Poliklinik', 'Rujukan dari luar dokter/klinik', 'Ruang perawatan', 'Lain-lain'] as $index => $asal_pasien)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asal_pasien" id="asal_pasien_{{ Str::slug($asal_pasien, '_') }}" value="{{ $asal_pasien }}" {{ (old('asal_pasien') && old('asal_pasien') == $asal_pasien) || ($data && $data->asal_pasien == $asal_pasien) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="asal_pasien_{{ Str::slug($asal_pasien, '_') }}">
                                                {{ $asal_pasien }}
                                                @if ($asal_pasien == 'Lain-lain')
                                                : <input type="text" id="asal_pasien_lain_lain_input" name="asal_pasien_lain" class="input-dotted" value="{{ $data && $data->asal_pasien_lain ? $data->asal_pasien_lain : '' }}" />
                                                @endif
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                            <div class="w-100 mt-2">
                                <p class="font-weight-bold">I. Assesmen Medis Pra Operasi (diisi oleh dokter)</p>
                                <ol>
                                    <li>
                                        <div class="font-weight-bold">
                                            Anamnesis:
                                            <table class="w-100 font-weight-normal">
                                                @foreach([
                                                'a' => 'Keluhan utama',
                                                'b' => 'Riwayat penyakit sekarang',
                                                'c' => 'Riwayat penyakit dahulu',
                                                'd' => 'Riwayat penyakit keluarga',
                                                'e' => 'Riwayat penggunaan obat',
                                                'f' => 'Riwayat alergi obat / makanan / lain-lain',
                                                ] as $index => $anamnesis)
                                                <tr>
                                                    <td style="width: 12pt;" class="text-right">{{ $index }}.</td>
                                                    <td style="width: 25%;">{{ $anamnesis }}</td>
                                                    <td style="width: 12pt">:</td>
                                                    <td><input type="text" name="anamnesis[{{ $anamnesis }}]" id="anamnesis-{{ Str::slug($anamnesis, '-') }}" class="form-control rounded-0 input-dotted" value="{{ isset($data->anamnesis[$anamnesis]) ? $data->anamnesis[$anamnesis] : '' }}" /></td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="font-weight-bold">
                                            Pemeriksaan Fisik dan Status Generalis:
                                            <div class="font-weight-normal d-flex align-items-center flex-wrap">
                                                <div class="mr-1">Keadaan umum: <input type="text" name="pemeriksaan_fisik[Keadaan umum]" class="input-dotted" value="{{ isset($data->pemeriksaan_fisik['Keadaan umum']) ? $data->pemeriksaan_fisik['Keadaan umum'] : '' }}" />,</div>
                                                <div class="d-flex align-items-center mr-1">
                                                    <div class="mr-1">Kesadaran: </div>
                                                    <select name="pemeriksaan_fisik[Kesadaran]" id="pemeriksaan_fisik-kesadaran" class="select2">
                                                        <option disabled selected></option>
                                                        @foreach($kesadarans as $kesadaran)
                                                        <option value="{{ $kesadaran }}" {{ isset($data->pemeriksaan_fisik['Kesadaran']) && $data->pemeriksaan_fisik['Kesadaran'] == $kesadaran ? 'selected' : '' }}>{{ $kesadaran }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                , BB: <input type="text" name="pemeriksaan_fisik[BB]" class="input-dotted" value="{{ isset($data->pemeriksaan_fisik['BB']) ? $data->pemeriksaan_fisik['BB'] : '' }}" />kg,
                                                TB: <input type="text" name="pemeriksaan_fisik[TB]" class="input-dotted" value="{{ isset($data->pemeriksaan_fisik['TB']) ? $data->pemeriksaan_fisik['TB'] : '' }}" />cm
                                            </div>
                                            <p class="font-weight-normal">
                                                TD: <input type="text" name="pemeriksaan_fisik[TD]" class="input-dotted" value="{{ isset($data->pemeriksaan_fisik['TD']) ? $data->pemeriksaan_fisik['TD'] : '' }}" /> mmHg,
                                                Nadi: <input type="text" name="pemeriksaan_fisik[Nadi]" class="input-dotted" value="{{ isset($data->pemeriksaan_fisik['Nadi']) ? $data->pemeriksaan_fisik['Nadi'] : '' }}" />x/menit,
                                                Suhu: <input type="text" name="pemeriksaan_fisik[Suhu]" class="input-dotted" value="{{ isset($data->pemeriksaan_fisik['Suhu']) ? $data->pemeriksaan_fisik['Suhu'] : '' }}" />&deg;C,
                                                RR: <input type="text" name="pemeriksaan_fisik[RR]" class="input-dotted" value="{{ isset($data->pemeriksaan_fisik['RR']) ? $data->pemeriksaan_fisik['RR'] : '' }}" />x/menit</p>
                                            <p class="font-weight-normal">Status Generalis:
                                                <textarea name="status_generalis" id="status_generalis" class="form-control rounded-0 input-dotted" rows="1">{{ old('status_generalis') ?? ($data && $data->status_generalis ? $data->status_generalis : '') }}</textarea>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="font-weight-bold">Pemeriksaan Penunjang / Diagnostik:</div>
                                        <textarea class="form-control input-dotted" name="pemeriksaan_penunjang_diagnostik" id="pemeriksaan_penunjang_diagnostik" rows="2">{{ old('pemeriksaan_penunjang_diagnostik') ?? ($data && $data->pemeriksaan_penunjang_diagnostik ? $data->pemeriksaan_penunjang_diagnostik : '') }}</textarea>
                                    </li>
                                    <li>
                                        <div class="font-weight-bold">Diagnosis Pra Operasi :</div>
                                        <textarea class="form-control input-dotted" name="diagnosis_pra_operasi" id="diagnosis_pra_operasi" rows="2">{{ old('diagnosis_pra_operasi') ?? ($data && $data->diagnosis_pra_operasi ? $data->diagnosis_pra_operasi : '') }}</textarea>
                                    </li>
                                    <li>
                                        <div class="font-weight-bold">Rencana Tindakan dan Pengobatan:</div>
                                        <textarea class="form-control input-dotted" name="rencana_tindakan_pengobatan" id="rencana_tindakan_pengobatan" rows="4">{{ old('rencana_tindakan_pengobatan') ?? ($data && $data->rencana_tindakan_pengobatan ? $data->rencana_tindakan_pengobatan : '') }}</textarea>
                                    </li>
                                </ol>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border p-2 text-center"><button type="submit" class="btn btn-block btn-outline-secondary">Simpan</button></td>
                    </tr>
                    <tr>
                        <td class="border text-center font-weight-bold p-2" style="width: 50%;">Diisi Oleh Dokter Yang Melakukan Pengkajian</td>
                        <td class="border text-center font-weight-bold p-2" style="width: 50%;">Tanda Tangan & Nama Jelas</td>
                    </tr>
                    <tr>
                        <td class="border p-2 align-top">
                            Tanggal dan Jam Selesai
                            <input type="text" name="tanggal_jam_selesai" id="tanggal_jam_selesai" class="form-control rounded-0 input-dotted datetimepicker" value="{{ $data && $data->tanggal_jam_selesai ? $data->tanggal_jam_selesai->format('d/m/Y H:i') : '' }}" />
                        </td>
                        <td class="border p-2 align-top text-center">
                            @if ($data && $data->status)
                            <img class="btn-verifikasi" src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}" style="height: 3cm; width: 4cm;" alt="">
                            @else
                            <div style="height: 128px;" class="d-flex align-items-center justify-content-center">
                                <div class="btn-group">
                                    <!-- <button type="submit" class="btn btn-outline-secondary">Simpan</button> -->
                                    <button type="button" class="btn btn-success btn-verifikasi">Verifikasi</button>
                                </div>
                            </div>
                            @endif
                            <div>{{ $dokumen->nama_verifikator ?? '' }}</div>
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

            $('select.select2').select2({
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

            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY HH:mm',
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

            let validator = null;

            $('.btn-verifikasi').on('click', function(e) {
                e.preventDefault();

                $('form input:text:not(#asal_pasien_lain_lain_input), form input:radio[name="asal_pasien"]:first, form select, form textarea').prop('required', true);

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

                if ($('form').valid()) {
                    $('#passwordModal').modal('show');
                }
                validator.destroy();
            })

            $('#passwordModal').on('show.bs.modal', function(e) {
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

                $('form').submit();
            });

            $('form .btn-save').click(function(e) {
                $('form').trigger('submit');
            });
        });
    </script>
</body>

</html>