@extends('layouts.app')
@section('content')
    <style>
        .datatable-orange {
            background-color: rgb(255, 242, 218) !important;
        }

        .datatable-green {
            background-color: rgb(216, 255, 216) !important;
        }
    </style>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>E-Rekam Medis Dokter</h1>
            </div>

            <div class="section-body">
                <div class="card pt-3 pb-3">
                    <form id="filter" class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Poli</label>
                                <select name="poli" id="poli" class="form-control">
                                    <option value="">--Select Here--</option>
                                    @foreach ($poli as $p)
                                        <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">--Select Here--</option>
                                    <option value="0" selected>Aktif</option>
                                    <option value="1">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Dokter</label>
                                <select name="dokter" id="dokter" class="form-control">
                                    <option value="">--Select Here--</option>
                                    @foreach ($dokter as $d)
                                        <option @if (Auth::user()->realname == $d->nama) {{ 'selected' }} @endif
                                            value="{{ $d->nama }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input class="form-control" name="tanggal" type="date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <select name="uri" class="form-control">
                                    <option value="">--Select Here--</option>
                                    <option value="0" selected>Rawat Jalan</option>
                                    <option value="1">Rawat Inap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group" style="padding-top: 30px;">
                                <button type="submit" class="btn btn-primary">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card pt-3 pb-3">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12 table-responsive">
                            <table id="tabel_pasien" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>No. RM</th>
                                        <th>No. Registrasi</th>
                                        <th>Poli</th>
                                        <th>Nama Dokter</th>
                                        <th style="width: 30%">Dokumen RM</th>
                                        <th>Cara Bayar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script>
            $('document').ready(function() {
                $('#dokter').select2();
                $('#poli').select2();
                $('#tabel_pasien').DataTable();
                $('#filter').submit();
            })

            $('#filter').submit(function(e) {
                e.preventDefault();

                if($('[name=status]').val() == '1' || $('[name=status]').val() == ''){
                    if ($('[name=tanggal]').val() == '') {
                        toastr.error('Tanggal harus dipilih');
                        return;
                    }
                }
                
                if ($.fn.DataTable.isDataTable('#tabel_pasien')) {
                    $('#tabel_pasien').dataTable().fnClearTable();
                    $('#tabel_pasien').dataTable().fnDestroy();
                }
                
                $('#tabel_pasien').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '../ajax_request/filter_erm_dokter?' + $('#filter').serialize(),
                    "createdRow": function name(row, data, dataIndex) {
                        dokumen = data.nama_dokumen.replaceAll("&quot;", "").replaceAll("[", "").replaceAll(
                            "]", "").split(", ");
                        status_dokumen = data.status_dokumen.replaceAll("&quot;", "").replaceAll("[", "")
                            .replaceAll("]", "").split(", ");
                        prp_dokumen = data.prop_dokumen.replaceAll("&quot;", "").replaceAll("[", "")
                            .replaceAll("]", "").split(", ");
                        if (dokumen.length > 0) {
                            for (let i = 0; i < dokumen.length; i++) {
                                if (prp_dokumen[i] == "") {
                                    if (dokumen[i].includes('Asesmen Medis Awal Rawat Jalan') || dokumen[i]
                                        .includes('Catatan Perkembangan Pasien')) {
                                        if (status_dokumen[i] == '1') {
                                            $(row).addClass('datatable-green');
                                        } else {
                                            $(row).addClass('datatable-orange');
                                        }
                                    }
                                }
                            }
                        }
                    },
                    columns: [{
                            data: null,
                            name: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return '<div class="text-center">' + (meta.row + meta.settings
                                    ._iDisplayStart + 1) + '</div>';
                            }
                        },
                        {
                            data: 'nama_pasien',
                            name: 'nama_pasien'
                        },
                        {
                            data: 'nrm',
                            name: 'nrm'
                        },
                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'last_nama_ruangan',
                            name: 'last_nama_ruangan'
                        },
                        {
                            data: 'nama_dokter',
                            name: 'nama_dokter'
                        },
                        {
                            data: null,
                            name: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                if (data.nama_dokumen != '[null]') {
                                    id_dokumen = data.id_dokumen.replaceAll("&quot;", "").replaceAll(
                                        "[", "").replaceAll("]", "").split(", ");
                                    prop_dokumen = data.prop_dokumen.replaceAll("&quot;", "")
                                        .replaceAll("[", "").replaceAll("]", "").split(", ");
                                    status_dokumen = data.status_dokumen.replaceAll("&quot;", "")
                                        .replaceAll("[", "").replaceAll("]", "").split(", ");
                                    dokumen = data.nama_dokumen.replaceAll("&quot;", "").replaceAll("[",
                                        "").replaceAll("]", "").split(", ");
                                    html = "";
                                    if (dokumen.length >= 0) {
                                        for (let i = 0; i < dokumen.length; i++) {
                                            if (prop_dokumen[i] == '' && status_dokumen[i] == '1') {
                                                if (dokumen[i].includes(
                                                        'Catatan Perkembangan Pasien')) {
                                                    html +=
                                                        '<a style="display:inline-flex; align-items:center;" target="_blank" href="../e_rekam_medis/detail/pdf_' +
                                                        dokumen[i].toLowerCase().replaceAll(' ', '_') +
                                                        '?dokumen=' + id_dokumen[i] +
                                                        '" class="btn btn-dark mr-1 mb-1"><i class="fas fa-arrow-down mr-1"></i>' +
                                                        dokumen[i] + '</a>';
                                                } else if (dokumen[i].includes(
                                                        'Asesment Medis Awal Rawat Jalan')) {
                                                    html +=
                                                        '<a style="display:inline-flex; align-items:center;" target="_blank" href="./detail/pdf_' +
                                                        dokumen[i].toLowerCase().replaceAll(' ', '_') +
                                                        '?dokumen=' + id_dokumen[i] +
                                                        '" class="btn btn-dark mr-1 mb-1"><i class="fas fa-arrow-down mr-1"></i>' +
                                                        dokumen[i] + '</a>';
                                                }
                                            }
                                        }
                                    } else {
                                        html += "-";
                                    }
                                    return html;
                                } else {
                                    return "-"
                                }
                            },
                            className: 'text-center'
                        },
                        {
                            data: 'carabayar',
                            name: 'carabayar',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                var html = "";
                                var asuransi = row.rg_asuransi ? row.rg_asuransi.nama : '';
                                var perusahaan = row.perusahaan ? row.perusahaan.nama : '';
                                if (row.carabayar) {
                                    html += row.carabayar.replaceAll('_', ' ').toUpperCase();
                                }
                                if (asuransi != '') {
                                    html += " - " + asuransi.toUpperCase();
                                }
                                if (perusahaan != '') {
                                    html += " / " + perusahaan.toUpperCase();
                                }
                                if (row.nobpjs) {
                                    html += " - " + row.nobpjs;
                                }
                                if (row.no_sep_rj) {
                                    html += " - " + row.no_sep_rj;
                                }
                                return html;
                            }
                        },
                        {
                            data: 'selesai',
                            name: 'selesai',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                let temp = data == 0 ? 'Aktif' : 'Tidak Aktif';
                                return temp;
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return '<div class="text-center"><a href="./dokter/detail?nrm=' + row
                                    .nrm +
                                    '" class="btn btn-success"><i class="fa fa-edit"></i></a></div>';
                            }
                        },
                    ]
                });
            })
        </script>
    @endpush
@endsection
