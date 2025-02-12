@extends('layouts.app')
@section('content')
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_tambah_lokasi" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tipe Lokasi</label>
                            <select name="tipe" id="tipe" class="form-control" required>
                                <option value="">--Select Here--</option>
                                @foreach ($referensi as $ref)
                                    <option value="{{ $ref->id }}">{{ $ref->display }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <select name="nama" id="nama" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($prototype as $pro)
                                    <option value="{{ $pro->nama }}">{{ $pro->nama }}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" name="nama" id="nama" class="form-control" placeholder="Tambahkan nama lokasi disini.." required> -->
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" required id="deskripsi" style="height:100%;" cols="30" rows="5"
                                class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select Here--</option>
                                <option value="active">Sedang Beroperasi</option>
                                <option value="suspended">Ditutup Sementara</option>
                                <option value="inactive">Tidak Digunakan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Telepon</label>
                            <input type="number" min="0" name="telepon" id="telepon" class="form-control"
                                placeholder="Tambahkan telepon lokasi disini.." required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Tambahkan email lokasi disini.." required>
                        </div>
                        <div class="form-group">
                            <label for="">Dikelola Oleh Bagian</label>
                            <select name="dikelola_oleh" id="dikelola_oleh" class="form-control" required>
                                <option value="">--Select Here--</option>
                                <option value="{{ env('IHS_RS') }}">{{ env('NAMA_RS') }}</option>
                                @foreach ($organisasi as $org)
                                    <option value="{{ $org->id_organisasi }}">{{ $org->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_lokasi" method="post">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="id_lokasi" id="edit_id_lokasi">
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tipe Lokasi</label>
                            <select name="tipe" id="edit_tipe" class="form-control" required>
                                <option value="">--Select Here--</option>
                                @foreach ($referensi as $ref)
                                    <option value="{{ $ref->id }}">{{ $ref->display }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <select name="nama" id="edit_nama" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($prototype as $pro)
                                    <option value="{{ $pro->nama }}">{{ $pro->nama }}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" name="nama" id="edit_nama" class="form-control" placeholder="Tambahkan nama lokasi disini.." required> -->
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" required id="edit_deskripsi" style="height:100%;" cols="30" rows="5"
                                class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="edit_status" class="form-control" required>
                                <option value="">--Select Here--</option>
                                <option value="active">Sedang Beroperasi</option>
                                <option value="suspended">Ditutup Sementara</option>
                                <option value="inactive">Tidak Digunakan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Telepon</label>
                            <input type="number" min="0" name="telepon" id="edit_telepon" class="form-control"
                                placeholder="Tambahkan telepon lokasi disini.." required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control"
                                placeholder="Tambahkan email lokasi disini.." required>
                        </div>
                        <div class="form-group">
                            <label for="">Dikelola Oleh Bagian</label>
                            <select name="dikelola_oleh" id="edit_dikelola_oleh" class="form-control" required>
                                <option value="">--Select Here--</option>
                                <option value="{{ env('IHS_RS') }}">{{ env('NAMA_RS') }}</option>
                                @foreach ($organisasi as $org)
                                    <option value="{{ $org->id_organisasi }}">{{ $org->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Location</h1>
            </div>

            <div class="section-body">
                <div class="card pt-3 pb-3">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12" id="message">
                            @if (Session::has('sukses'))
                                <div class="alert alert-success">{{ Session::get('sukses') }}</div>
                            @endif
                            @if (Session::has('gagal'))
                                <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="location-tab" data-toggle="tab"
                                        data-target="#location" type="button" role="tab" aria-controls="location"
                                        aria-selected="true">Location</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="location-reference-tab" data-toggle="tab"
                                        data-target="#location-reference" type="button" role="tab"
                                        aria-controls="location-reference" aria-selected="false">Referensi Lokasi</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="location" role="tabpanel"
                                    aria-labelledby="location-tab">
                                    <div class="row" style="width: 100%; margin-left: 0;">
                                        <div class="col-lg-12 pl-0 pr-0 pt-2">
                                            <button class="btn btn-success" onclick="open_modal_add()"><i
                                                    class="fas fa-plus"></i> Tambah</button>
                                        </div>
                                        <div class="col-lg-12 pl-0 pr-0 table-responsive">
                                            <table class="table table-striped" id="tabel_lokasi" style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Dikelola Oleh</th>
                                                        <th>Tipe</th>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                        <th>Deskripsi</th>
                                                        <th>Telepon</th>
                                                        <th>Email</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="location-reference" role="tabpanel"
                                    aria-labelledby="location-reference-tab">
                                    <div class="row" style="width: 100%; margin-left: 0;">
                                        <div class="col-lg-12 pl-0 pr-0">
                                            <button onclick="update_referensi_lokasi()"
                                                class="btn btn-warning"><i class="fas fa-refresh"></i>
                                                Update</button>
                                        </div>
                                        <div class="col-lg-12 pl-0 pr-0">
                                            <table class="table table-striped" id="tabel_referensi_lokasi"
                                                style="width: 100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 3%">No.</th>
                                                        <th style="width: 10%">Code</th>
                                                        <th style="width: 10%">Display</th>
                                                        <th style="width: 77%">Definition</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            get_data_referensi_lokasi();
            get_data_lokasi();
        })

        function loading(tipe, msg) {
            return '<div class="spinner-border spinner-border-' + tipe + '" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div> ' + msg;
        }

        function open_modal_add() {
            $('#modal_add').modal('show');
        }

        function open_modal_edit(param) {
            console.log(param);
            $.ajax({
                url: "{{ url('satu_sehat/ajax_request/select_location') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                    $('#edit_id').val(response.id);
                    $('#edit_id_lokasi').val(response.id_lokasi);
                    $("#edit_tipe option:contains(" + response.tipe + ")").attr('selected', true);
                    // $('#edit_tipe').val(response.tipe).change();
                    $('#edit_nama').val(response.nama);
                    $('#edit_status').val(response.status);
                    $('#edit_telepon').val(response.telepon);
                    $('#edit_email').val(response.email);
                    $('#edit_deskripsi').val(response.deskripsi);
                    $('#edit_dikelola_oleh').val(response.dikelola_oleh);
                    $('#modal_edit').modal('show');
                }
            })
        }

        function update_referensi_lokasi() {
            $('#message').html('<div class="alert alert-info">' + loading('sm',
                'Sedang memperbarui data, harap tunggu...') + '</div>');
            $.ajax({
                url: "{{ url('satu_sehat/location/update_location_reference') }}",
                success: function(response) {
                    if (!response.status) {
                        $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        return;
                    }
                    $('#message').html('');
                    get_data_referensi_lokasi();
                }
            })
        }

        function get_data_referensi_lokasi() {
            if ($.fn.DataTable.isDataTable("#tabel_referensi_lokasi")) {
                $('#tabel_referensi_lokasi').DataTable().clear().destroy();
            }

            $('#tabel_referensi_lokasi').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                bLengthChange: false,
                ajax: "{{ url('satu_sehat/location_reference_datatable') }}", // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: null,
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart +
                                1) + '</div>';
                        }
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'display',
                        name: 'display'
                    },
                    {
                        data: 'definition',
                        name: 'definition'
                    }
                ],
            })
        }

        function get_data_lokasi() {
            if ($.fn.DataTable.isDataTable("#tabel_lokasi")) {
                $('#tabel_lokasi').DataTable().clear().destroy();
            }

            $('#tabel_lokasi').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                bLengthChange: false,
                ajax: "{{ url('satu_sehat/location_datatable') }}", // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: null,
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart +
                                1) + '</div>';
                        }
                    },
                    {
                        data: 'organisasi',
                        name: 'smis_ss_organisasi.nama'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center">'+
                                '<button class="btn btn-warning" onclick="open_modal_edit('+"'"+data+"'"+')"><i class="fa fa-pencil"></i></button>'+
                                '</div>';
                        }
                    }
                ]
            })
        }

        $('#form_tambah_lokasi').submit(function(e) {
            e.preventDefault();
            $('#message').html('<div class="alert alert-info">' + loading('sm',
                'Sedang menyimpan data, harap tunggu...') + '</div>');
            $.ajax({
                url: "{{ url('satu_sehat/location/store') }}",
                data: $('#form_tambah_lokasi').serialize(),
                method: 'post',
                success: function(response) {
                    console.log(response);
                    $('#modal_add').modal('hide');
                    $('#message').html('');
                    if (!response.status) {
                        toastr.error(response.message);
                        return;
                    }
                    toastr.success(response.message);
                    get_data_lokasi();
                }
            })
        })

        $('#form_edit_lokasi').submit(function(e) {
            e.preventDefault();
            $('#message').html('<div class="alert alert-info">' + loading('sm',
                'Sedang menyimpan data, harap tunggu...') + '</div>');
            $.ajax({
                url: "{{ url('satu_sehat/location/update') }}",
                data: $('#form_edit_lokasi').serialize(),
                method: 'post',
                success: function(response) {
                    console.log(response);
                    $('#modal_edit').modal('hide');
                    $('#message').html('');
                    if (!response.status) {
                        toastr.error(response.message);
                        return;
                    }
                    toastr.success(response.message);
                    get_data_lokasi();
                }
            })
        })
    </script>
@endpush
