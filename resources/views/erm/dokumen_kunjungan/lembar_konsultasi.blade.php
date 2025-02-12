<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Konsultasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }

        #tabel_bawah_keluhan tr td {
            border: 1px solid transparent;
            vertical-align: top;
            padding-bottom: 20px;
        }

        #tabel_bawah_keluhan {
            width: 100%;
        }

        .isian {
            border: 1px solid transparent;
            border-bottom: 2px dotted;
        }

        #tabel_kepada tr td {
            border: 1px solid transparent;
        }

        #tabel_identitas tr td {
            border: 1px solid transparent;
        }

        #box_ttd_konsul:hover {
            cursor: pointer;
        }

        #box_ttd_jawab:hover {
            cursor: pointer;
        }

        #diagnosa {
            width: 90%;
        }

        #label_saran_tindakan {
            width: 25%;
        }

        @media print {
            #label_saran_tindakan {
                width: 30%;
            }

            .col-lg-4 {
                width: 25%;
            }

            #diagnosa {
                width: 85%;
            }

            .custom-table td {
                padding: 0;
                vertical-align: middle;
                border-color: black;
            }

            .custom-table th {
                border-color: black;
            }

            #tabel_bawah_keluhan tr td {
                border: 1px solid transparent !important;
                vertical-align: top;
                padding-bottom: 20px;
            }

            #tabel_bawah_keluhan {
                width: 100%;
            }

            .isian {
                border: 1px solid transparent !important;
                border-bottom: 2px dotted !important;
            }

            #tabel_kepada tr td {
                border: 1px solid transparent !important;
            }

            #tabel_identitas tr td {
                border: 1px solid transparent !important;
            }

            #box_ttd_konsul:hover {
                cursor: pointer;
            }

            #box_ttd_jawab:hover {
                cursor: pointer;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }

        .pagebreak {
            page-break-before: always;
        }
    </style>
</head>

<body class="p-2">
    <form class="container" id="form_dokumen">
        @csrf
        <input type="hidden" name="jenis_verif" id="jenis_verif">
        <input type="hidden" name="password">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-lg-12 text-right">MR 02.15.003.REV.0</div>
        </div>
        <div class="container mt-3">
            <table class="table table-bordered table-0 custom-table" style="width: 100%">
                <tr>
                    <th>
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                        <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                    </th>
                    <th>
                        <table id="tabel_identitas">
                            <tr class="align-top">
                                <td>Nama</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->nama }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>No. RM</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->id }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tgl Lahir</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis Kelamin</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien ? ($pasien->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>NIK</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->ktp }}</td>
                            </tr>
                        </table>
                        <p class="text-right" style="font-weight: normal">
                            <i> *Tempel Label</i>
                        </p>
                    </th>
                </tr>
                <tr>
                    <th scope="col" colspan="2" class="text-center" style="background-color: lightgrey !important; margin-bottom:0; border-color: black;">LEMBAR KONSULTASI</th>
                </tr>
                <tr>
                    <td style="width: 50%; padding-left: 5px;">
                        <table id="tabel_kepada" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td>Kepada Yth</td>
                                <td class="pl-2 pr-2"> : </td>
                                <td>
                                    <div class="input-group" style="width: 98%;">
                                        <input type="hidden" name="id_kepada" value="{{ $data ? $data->id_kepada : '' }}">
                                        <input type="text" name="kepada" value="{{ $data ? $data->kepada : '' }}" class="form-control" readonly style="display: inline-block; width: 75%;">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button" onclick="open_modal_yth()"><i class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="p-2">
                        Spesialis <span class="pl-2 pr-2">:</span> <input type="text" value="{{ $data ? $data->spesialis : '' }}" name="spesialis" class="form-control isian" style="display: inline-block; width: 80%;">
                    </td>
                </tr>

                <tr>
                    <td style="width: 50%; font-style: italic; font-size: 14px; padding-left: 5px;">*Lingkari pilihan nomor sesuai kebutuhan</td>
                    <td style="width: 50%; font-style: italic; font-size: 14px; padding-left: 5px;">(Coret yang tidak perlu*)</td>
                </tr>

                <tr>
                    <td style="width: 50%; padding-left: 5px;">
                        <p> Dengan hormat, <br /> Mohon bantuan sejawat atas pasien berikut untuk : </p>
                        <ul style="list-style-type: none; margin-left: -5%;">
                            <li><input type="radio" name="sejawat" {{ $data ? $data->sejawat == 'Konsultasi/Tindakan* masalah medis saat ini' ? 'checked' : '' : '' }} value="Konsultasi/Tindakan* masalah medis saat ini"> 1. Konsultasi/Tindakan* masalah medis saat ini</li>
                            <li><input type="radio" name="sejawat" {{ $data ? $data->sejawat == 'Mengambil alih kasus ini selanjutnya' ? 'checked' : '' : '' }} value="Mengambil alih kasus ini selanjutnya"> 2. Mengambil alih kasus ini selanjutnya</li>
                            <li><input type="radio" name="sejawat" {{ $data ? $data->sejawat == 'Perawatan bersama untuk selanjutnya' ? 'checked' : '' : '' }} value="Perawatan bersama untuk selanjutnya"> 3. Perawatan bersama untuk selanjutnya</li>
                        </ul>
                    </td>
                    <td style="width: 50%; padding-left: 5px;">
                        Jenis Konsul <span class="pl-2 pr-2">:</span> <input {{ $data ? $data->jenis_konsul == 'biasa' ? 'checked' : '' : '' }} type="radio" name="jenis_konsul" value="biasa"> Biasa / <input {{ $data ? $data->jenis_konsul == 'cito' ? 'checked' : '' : '' }} type="radio" name="jenis_konsul" value="cito"> Cito <br /><br />
                        tanggal <span class="pl-2 pr-2">:</span> <input value="{{ $data ? date('d-m-Y H:i', strtotime($data->tanggal)) : date('d-m-Y H:i', strtotime($dokumen->created_at)) }}" type="text" name="tanggal" class="isian datetimepicker" style="display: inline-block; width: 25%"> <br>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="pt-2" style="padding-left: 10px; padding-right: 10px;">
                        <div class="form-group">
                            <label for="">Keterangan klinis terpenting adalah :</label>
                            <textarea name="keterangan_klinis" class="form-control" rows="4">{{ $data ? $data->keterangan_klinis : '' }}</textarea>
                        </div>

                        Diagnosa <span class="pl-2 pr-2">:</span> <input type="text" value="{{ $data ? $data->diagnosa : '' }}" name="diagnosa" class="form-control mb-4 isian" style="display:inline-block;" id="diagnosa">

                        <div class="row pt-3 pb-4" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-4 text-center" id="box_ttd_konsul" onclick="open_modal_verifikasi('konsul')">
                                Terima kasih,
                                @if($data)
                                    @if($data->id_konsul != 0)
                                    <br>
                                    <img class="mt-2" src="{{ env('SMIS_UPLOAD_URL').'/'.($employee_konsul ? $employee_konsul->ttd : '') }}" alt="" style="width: 4cm; height: 2.5cm;">

                                    <br>
                                    ({{ $data->nama_konsul }})
                                    <br>
                                @else
                                <br />
                                <br />
                                <br />
                                Klik Disini
                                <br />
                                <br />
                                <br />
                                (..............................................................)<br>
                                @endif
                                @else
                                <br />
                                <br />
                                <br />
                                Klik Disini
                                <br />
                                <br />
                                <br />
                                (..............................................................)<br>
                                @endif
                                Ttd & Nama Terang
                            </div>
                            <div class="col-lg-8">&nbsp;</div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="pagebreak"></div>
            <table class="table table-bordered table-0 custom-table" style="width: 100%;">
                <tr>
                    <th scope="col" colspan="2" class="text-center" style="background-color: lightgrey !important; margin-bottom:0; border-color: black;">
                        JAWABAN KONSUL
                    </th>
                </tr>

                <tr>
                    <td colspan="2" style="padding-left: 10px; padding-right: 10px;">
                        <p class="pt-2">Dengan Hormat, <br> Sesuai dengan permohonan konsultasi, pada kasus ini dijumpai :</p>
                        <textarea class="form-control mb-3" name="temuan" rows="6">{{ $data ? $data->temuan : '' }}</textarea>

                        <p>Keluhan :</p>
                        <textarea class="form-control mb-3" rows="6" name="keluhan">{{ $data ? $data->keluhan : '' }}</textarea>

                        <table id="tabel_bawah_keluhan">
                            <tr>
                                <td class="pl-2" id="label_saran_tindakan">Saran tindakan medik/pengobatan</td>
                                <td class="text-center" style="width: 3%;"> : </td>
                                <td>
                                    <input type="text" name="saran_tindakan" value="{{ $data ? $data->saran_tindakan : '' }}" class="form-control isian" style="width: 100%">
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-2">Konsultasi ulang tanggal</td>
                                <td class="text-center"> : </td>
                                <td>
                                    <input type="text" name="konsultasi_ulang" value="{{ $data ? $data->konsultasi_ulang != '0000-00-00' ? date('d-m-Y', strtotime($data->konsultasi_ulang)) : '' : '' }}" class="form-control isian datepicker">
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-2">Tindakan Khusus</td>
                                <td class="text-center"> : </td>
                                <td>
                                    <input type="text" value="{{ $data ? $data->tindakan_khusus : '' }}" name="tindakan_khusus" class="form-control isian" style="width: 100%">
                                </td>
                            </tr>
                        </table>

                        <div class="row pt-3 pb-4" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-4 pl-2">
                                Terima kasih, <br>
                                Bekasi, <input type="text" style="width: 40%;" name="tanggal_jawab" value="{{ $data ? $data->tanggal_verifikasi != '0000-00-00 00:00:00' ? date('d-m-Y H:i', strtotime($data->tanggal_verifikasi)) : date('d-m-Y H:i') : date('d-m-Y H:i') }}" class="datetimepicker isian"> WIB
                                <span onclick="open_modal_verifikasi('jawab')" id="box_ttd_jawab">
                                    @if($data)
                                    @if($data->id_jawab != 0)
                                    <img class="mt-2" src="{{ env('SMIS_UPLOAD_URL').'/'.($employee_jawab ? $employee_jawab->ttd : '') }}" alt="" style="width: 4cm; height: 2.5cm;" id="ttd_jawab">
                    
                                    <br>
                                    ({{ $data->nama_jawab }})
                                    <br>
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik Disini
                                    <br />
                                    <br />
                                    <br />
                                    (.....................................................)<br>
                                    @endif
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik Disini
                                    <br />
                                    <br />
                                    <br />
                                    (.....................................................)<br>
                                    @endif
                                    Tanda tangan & nama jelas
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <div class="container">
        <div class="col-md-12 text-center">
            @if($dokumen->id_verifikator != 0)
                <a href="{{ url('e_rekam_medis/detail/lembar_konsultasi/lembar_konsultasi_pdf?dokumen='.$dokumen->id) }}" class="btn btn-success" target="_blank">
                    Download PDF
                </a>
            @endif                     
        </div>
    </div>

  

    <div class="modal fade" id="modal_yth" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Kepada Yth.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabel_yth" class="table table-striped mt-2" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verif">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" id="password" placeholder="Masukkan password anda" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- script verifikasi -->
<script>
    function open_modal_verifikasi(jenis_verif) {
        $('#jenis_verif').val(jenis_verif);
        $('#modal_verif').modal('show');
    }

    $('#form_verif').submit(function(e) {
        e.preventDefault();

        if ($('#password').val() == '') {
            toastr.error('Password harus diisi');
            return;
        }

        $('[name=password]').val($('#password').val());
        $('#form_dokumen').submit();
    })

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang update dokumen, harap tunggu...');
        $('#modal_verif').modal('hide');
        $('#form_verif')[0].reset();

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/lembar_konsultasi/store') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                render_tanda_tangan(response.employee);
            }
        })
    })

    function render_tanda_tangan(employee) {
        let jenis_verif = $('[name=jenis_verif]').val();

        var ins = '';

        switch (jenis_verif) {
            case 'jawab':
                ins += '<br>' +
                    `<img class="mt-2" src="{{ env('SMIS_UPLOAD_URL') }}/` + employee.ttd + `" alt="" style="width: 4cm; height: 2.5cm; margin-left: 15%;">` +
                    '<br>' +
                    '(' + employee.nama + ')' +
                    '<br>' +
                    'Tanda tangan & nama jelas';
                break;
            case 'konsul':
                ins += 'Terima kasih,' +
                    '<br>' +
                    `<img class="mt-2" src="{{ env('SMIS_UPLOAD_URL') }}/` + employee.ttd + `" alt="" style="width: 4cm; height: 2.5cm;">` +
                    '<br>' +
                    '(' + employee.nama + ')' +
                    '<br>' +
                    'Tanda tangan & nama jelas';
                break;
            default:
                break;
        }

        $('#box_ttd_' + jenis_verif).html(ins);
    }
</script>
<!-- end script verifikasi -->

<!-- script yth-->
<script>
    function open_modal_yth() {
        if ($.fn.DataTable.isDataTable("#tabel_yth")) {
            $('#tabel_yth').DataTable().clear().destroy();
        }

        $('#tabel_yth').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: '{{ url("ajax_request/employee") }}',
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) +
                            '</p>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_jabatan',
                    name: 'nama_jabatan',
                    render(data, type, row) {
                        return '<p class="text-center">' + data + '</p>';
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render(data, type, row) {
                        var fungsi_set = 'set_yth(' + "'" + data + "','" + row.nama + "'" + ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });

        $('#modal_yth').modal('show');
    }

    function set_yth(id, nama) {
        $('[name=kepada]').val(nama);
        $('[name=id_kepada]').val(id);
        $('#modal_yth').modal('hide');
    }
</script>
<!-- end script yth-->

<script>
    $('.datetimepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm'
        },
        useCurrent: false,
        autoUpdateInput: true,
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

    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY'
        },
        useCurrent: false,
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
        timePicker24Hour: false,
    });

    $('[name=konsultasi_ulang]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('[name=konsultasi_ulang]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('[name=tanggal_jawab]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm'));
    });

    $('[name=tanggal_jawab]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('[name=tanggal]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm'));
    });

    $('[name=tanggal]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>

</html>