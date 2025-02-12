@extends('layouts.app')
<div class="modal fade" id="modal_perujuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perujuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabel_perujuk" class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="form_modal_pasien" onsubmit="do_tambah_pasien()">
                <div class="modal-body" id="body_modal_pasien">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_mjkn_patient" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" onsubmit="update_mjkn()">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" id="edit_id" required>
                    <div class="form-group">
                        <label for="">No. Kartu</label>
                        <input type="number" min="0" id="edit_nobpjs" name="nobpjs" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input type="number" min="0" id="edit_nik" name="nik" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <label for="">No. Kartu Keluarga</label>
                        <input type="number" min="0" id="edit_no_kk" name="no_kk" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" id="edit_nama" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select name="kelamin" id="edit_kelamin" class="form-control">
                            <option value="">--Select Here--</option>
                            <option value="0">Laki-Laki</option>
                            <option value="1">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" id="edit_tgl_lahir" name="tgl_lahir" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">No. Handphone</label>
                        <input type="number" min="0" id="edit_telepon" name="telepon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" id="edit_alamat" cols="30" rows="5" style="height: 100%;"
                            class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Propinsi</label>
                        <select name="propinsi" id="edit_propinsi" class="form-control">
                            @foreach ($propinsi as $prop)
                                <option value="{{ $prop->id }}">{{ $prop->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kabupaten</label>
                        <select name="kabupaten" id="edit_kabupaten" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select name="kecamatan" id="edit_kecamatan" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="">Kelurahan</label>
                        <select name="kelurahan" id="edit_kelurahan" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="">RT</label>
                        <input type="number" min="0" id="edit_rt" name="rt" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">RW</label>
                        <input type="number" min="0" id="edit_rw" name="rw" class="form-control">
                    </div>
                    <div id="loading_update"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_batal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Batal Antrian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('antrian/batal_antrian') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id_batal" required>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" placeholder="Tambahkan keterangan batal disini" class="form-control" style="height:100%"
                            id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Antrian Pendaftaran</h1>
            </div>

            <div class="section-body">
                @if (Session::has('berhasil'))
                    <div class="row" style="width:100%; margin-left: 0;">
                        <div class="col-lg-12 alert alert-success">
                            {{ Session::get('berhasil') }}
                        </div>
                    </div>
                @endif
                @if (Session::has('gagal'))
                    <div class="row" style="width:100%; margin-left: 0;">
                        <div class="col-lg-12 alert alert-danger">
                            {{ Session::get('gagal') }}
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger col-lg-12">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="card pt-3">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select id="loket" class="form-control">
                                    <!-- <option value="loket 1">Loket Rawat Jalan BPJS</option>
                                    <option value="loket 2">Loket Rawat Jalan BPJS</option>
                                    <option value="loket 3">Loket Rawat Jalan Umum dan Asuransi</option>
                                    <option value="loket 4">Loket Rawat Inap IGD BPJS atau NON BPJS</option> -->
                                    <option value="loket 1">Loket 1</option>
                                    <option value="loket 2">Loket 2</option>
                                    <option value="loket 3">Loket 3</option>
                                    <option value="loket 4">Loket 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- <div class="form-group">
                                            <select id="lantai" class="form-control">
                                                <option value="1">Lantai 1</option>
                                                <option value="2">Lantai 2</option>
                                            </select>
                                        </div> -->
                        </div>
                        <div class="col-lg-3">
                            <!-- <div class="form-group">
                                            <select id="model" class="form-control">
                                                @for ($i = 1; $i <= 22; $i++)
    <option value='{{ $i }}'>{{ $i }}</option>
    @endfor
                                            </select>
                                        </div> -->
                        </div>
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="antrian-manual-tab" data-toggle="tab"
                                        href="#antrian_manual" role="tab" aria-controls="antrian-manual"
                                        aria-selected="true">Antrian manual</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pendaftaran-pasien" data-toggle="tab"
                                        href="#pendaftaran_pasien" role="tab" aria-controls="pendaaftaran-pasien"
                                        aria-selected="true">Pendaftaran pasien</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="antrian-pasien-tab" data-toggle="tab" href="#antrian_pasien"
                                        role="tab" aria-controls="antrian-pasien" aria-selected="true">Antrian pasien
                                        online</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pasien-baru-tab" data-toggle="tab" href="#pasien_baru"
                                        role="tab" aria-controls="pasien-baru" aria-selected="false">Pasien baru</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="antrian_manual" role="tabpanel"
                                    aria-labelledby="antrian-manual-tab">
                                    <div class="row pt-5 pb-5">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger pl-4 pr-4"
                                                        onclick="panggil_ulang()">Panggil ulang</button>
                                                </div>
                                                <input type="text" class="form-control" style="text-align:center;"
                                                    id="nomorantrian_manual">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" onclick="panggil_berikutnya()">Panggil
                                                        berikutnya</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                </div>
                                <!-- Form pendaftaran pasien -->
                                <div class="tab-pane fade" id="pendaftaran_pasien" role="tabpanel"
                                    aria-labelledby="pendaftaran-pasien-tab">
                                </div>
                                <div class="tab-pane fade" id="antrian_pasien" role="tabpanel"
                                    aria-labelledby="antrian-pasien-tab">
                                    <form class="row pb-2" id="form_pencarian" style="width: 100%; margin-left: 0; margin-bottom: 0;" onsubmit="search_antrian()">
                                        <div class="col-lg-3 pl-0">
                                            <input type="text" placeholder="Cari..." name="cari_keyword" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="date" value="{{date('Y-m-d')}}" name="cari_tanggal" class="form-control">
                                        </div>
                                        <div class="col-lg-3 pt-1">
                                            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i> Cari</button>
                                        </div>
                                    </form>
                                    <div id="msg"></div>
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="font-size: 14px;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nomor Antrian</th>
                                                    <th>Nama Pasien</th>
                                                    <th>No. RM</th>
                                                    <th>No. BPJS</th>
                                                    <th>NIK</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list_kiri">
                                                <!-- <tr class="text-center">
                                                            <td colspan="8">
                                                                <div class="spinner-border spinner-border-sm" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div> Sedang mengambil data...
                                                            </td>
                                                        </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pasien_baru" role="tabpanel"
                                    aria-labelledby="pasien-baru-tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="font-size: 14px;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Pasien</th>
                                                    <th>No. RM</th>
                                                    <th>No. BPJS</th>
                                                    <th>NIK</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list_kanan">
                                                <!-- <tr class="text-center">
                                                            <td colspan="6">
                                                                <div class="spinner-border spinner-border-sm" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div> Sedang mengambil data...
                                                            </td>
                                                        </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 table-responsive">

                        </div>
                        <div class="col-lg-6 table-responsive">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        var kode_booking = '';
        var baseURL = window.location.href;
        var t = baseURL.substr(0, baseURL.lastIndexOf("/"));
        var l = t.substr(0, t.lastIndexOf("/"));
        let global_asuransi = [];

        function search_antrian() {
            window.event.preventDefault();
            get_antrian();
        }

        function template_tabel(nik, nama, tgl, nrm, hp) {
            return '<table id="tabel_pasien" class="mt-3" style="line-height:2">' +
                '<tr>' +
                '<th>NIK</th>' +
                '<th class="pl-2 pr-2"> : </th>' +
                '<th>' + nik + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th>Nama Pasien</th>' +
                '<th class="pl-2 pr-2"> : </th>' +
                '<th>' + nama + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th>No. RM</th>' +
                '<th class="pl-2 pr-2"> : </th>' +
                '<th>' + nrm + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th>Tanggal Lahir</th>' +
                '<th class="pl-2 pr-2"> : </th>' +
                '<th>' + format_tanggal_dmy(tgl) + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th>No HP</th>' +
                '<th class="pl-2 pr-2"> : </th>' +
                '<th>' + hp + '</th>' +
                '</tr>' +
                '</table>';
        }

        function spinner_lg(msg) {
            return '<div class="spinner-border" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div> ' + msg;
        }

        function spinner_sm(msg) {
            return '<div class="spinner-border spinner-border-sm" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div> ' + msg;
        }

        function open_modal_pasien(tipe) {
            $('#body_modal_pasien').html(elemen_form_tambah_pasien(tipe));
            $('#modal_pasien').modal('show');
        }

        function do_search_pasien_umum() {
            window.event.preventDefault();
            $('#result_umum').html('<div class="text-center pt-1">' + spinner_sm('Sedang mencari data') + '</div>')

            $.ajax({
                url: "{{ url('ajax_request/get_pasien_by_nrm_or_ktp') }}",
                data: {
                    nomor: $('#field_search_umum').val()
                },
                success: function(response) {
                    console.log(response);
                    if ($.isEmptyObject(response)) {
                        $('#result_umum').html(
                            '<div class="alert alert-danger text-center" style="font-weight:bold;">Data tidak ditemukan<br><br><button onclick="open_modal_pasien(' +
                            "'umum'" + ')" class="btn btn-warning">Daftar</button></div>');
                        $('#selanjutnya_umum').html('');
                        kode_booking = '';
                        return;
                    }
                    // var lantai = $('#lantai').val();
                    kode_booking = response.kodebooking;
                    $('#result_umum').html(template_tabel(response.ktp, response.nama, response.tgl_lahir,
                        response.id, response.telpon));
                    $('#selanjutnya_umum').html(
                        '<button class="btn btn-warning" onclick="form_daftar_pasien_umum(' + "'" + response
                        .ktp + "','" + response.nobpjs + "'" +
                        ')" style="font-weight: bold; color:#fff;">Selanjutnya</button>');
                }
            })
        }

        function do_tambah_pasien() {
            window.event.preventDefault();
            $('#modal_pasien').modal('hide');
            $('#result_' + $('#tipe').val()).html('<div class="alert alert-info text-center" style="font-weight:bold;">' +
                spinner_sm('Harap tunggu, sedang menyimpan data pasien...') + '</div>');
            let arr_data = {
                // lantai: $('#lantai').val(),
                _method: 'post',
                _token: '{{ csrf_token() }}',
                tipe: $('#tipe').val(),
                nobpjs: $('#nobpjs').val(),
                nik: $('#nik').val(),
                nama: $('#nama').val(),
                kelamin: $('#kelamin').val(),
                tanggallahir: $('#tanggallahir').val(),
                phone: $('#phone').val(),
                alamat: $('#alamat').val(),
                propinsi: $('#edit_propinsi').val(),
                kabupaten: $('#edit_kabupaten').val(),
                kecamatan: $('#edit_kecamatan').val(),
                kelurahan: $('#edit_kelurahan').val(),
                rt: $('#rt').val(),
                rw: $('#rw').val(),
            };
            var url = "{{ url('ajax_request/tambah_pasien_umum') }}";
            if ($('#tipe').val() == 'bpjs') {
                url = "{{ url('ajax_request/tambah_pasien_bpjs') }}";
            }
            console.log(arr_data);
            $.ajax({
                url: url,
                method: 'post',
                data: arr_data,
                success: function(response) {
                    if (response.status) {
                        $('#result_' + $('#tipe').val()).html(
                            '<div class="alert alert-success text-center" style="font-weight:bold;">' +
                            response.message + '</div>');
                        return;
                    }
                    $('#result_' + $('#tipe').val()).html(
                        '<div class="alert alert-danger text-center" style="font-weight:bold;">' + response
                        .message + '</div>');
                }
            })
        }

        function do_search_pasien_bpjs() {
            window.event.preventDefault();
            $('#result_bpjs').html('<div class="text-center pt-1">' + spinner_sm('Sedang mencari data') + '</div>')

            $.ajax({
                url: "{{ url('ajax_request/get_pasien_by_bpjs_rujukan') }}",
                data: {
                    nomor: $('#field_search_bpjs').val()
                },
                success: function(response) {
                    console.log(response);
                    if ($.isEmptyObject(response)) {
                        $('#result_bpjs').html(
                            '<div class="alert alert-danger text-center" style="font-weight:bold;">Data tidak ditemukan<br><br><button onclick="open_modal_pasien(' +
                            "'bpjs'" + ')" class="btn btn-warning">Daftar</button></div>');
                        $('#selanjutnya_bpjs').html('');
                        kode_booking = '';
                        return;
                    }
                    // var lantai = $('#lantai').val();
                    kode_booking = response.kodebooking;
                    $('#result_bpjs').html(template_tabel(response.ktp, response.nama, response.tgl_lahir,
                        response.id, response.telpon));
                    $('#selanjutnya_bpjs').html(
                        '<button class="btn btn-warning" onclick="form_daftar_pasien_bpjs(' + "'" + response
                        .ktp + "','" + response.nobpjs + "'" +
                        ')" style="font-weight: bold; color:#fff;">Selanjutnya</button>');
                }
            })
        }

        var form_search_umum = '<div class="col-lg-12">' +
            '<button class="btn btn-dark p-2" onclick="pendaftaran_pasien()"><i class="fa fa-home"></i></button>' +
            '</div>' +
            '<div class="col-lg-3"></div><form class="col-lg-6" onsubmit="do_search_pasien_umum()">' +
            '<h6 style="text-align: center;">Masukkan nomor rekam medis / NIK pada form dibawah ini.</h6>' +
            '<div class="input-group">' +
            '<input id="field_search_umum" class="form-control"/>' +
            '<div class="input-group-append">' +
            '<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>' +
            '</div>' +
            '</div>' +
            '<div id="result_umum"></div>' +
            '<div id="selanjutnya_umum" class="text-center pt-3"></div>' +
            '</form><div class="col-lg-3"></div>';

        var form_search_bpjs = '<div class="col-lg-12">' +
            '<button class="btn btn-dark p-2" onclick="pendaftaran_pasien()"><i class="fa fa-home"></i></button>' +
            '</div>' +
            '<div class="col-lg-3"></div><form class="col-lg-6" onsubmit="do_search_pasien_bpjs()">' +
            '<h6 style="text-align: center;">Masukkan nomor BPJS / nomor rujukan pada form dibawah ini.</h6>' +
            '<div class="input-group">' +
            '<input id="field_search_bpjs" class="form-control"/>' +
            '<div class="input-group-append">' +
            '<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>' +
            '</div>' +
            '</div>' +
            '<div id="result_bpjs"></div>' +
            '<div id="selanjutnya_bpjs" class="text-center pt-3"></div>' +
            '</form><div class="col-lg-3"></div>';

        function elemen_form_tambah_pasien(tipe) {
            var no_kartu = '<input type="hidden" id="nobpjs" value="">';

            if (tipe == 'bpjs') {
                no_kartu = '<div class="form-group">' +
                    '<label for="">No. Kartu</label>' +
                    '<input type="number" id="nobpjs" placeholder="Masukkan nomor bpjs" class="form-control" required>' +
                    '</div>';
            }

            return '<input type="hidden" id="tipe" value="' + tipe + '">' +
                no_kartu +
                '<div class="form-group">' +
                '<label for="">NIK</label>' +
                '<input type="number" id="nik" placeholder="Masukkan nomor ktp" class="form-control" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Nama Lengkap</label>' +
                '<input type="text" id="nama" placeholder="Masukkan nama lengkap" required class="form-control">' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Jenis Kelamin</label>' +
                '<select name="kelamin" id="kelamin" class="form-control" required>' +
                '<option value="">--Select Here--</option>' +
                '<option value="0">Laki-Laki</option>' +
                '<option value="1">Perempuan</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Tanggal Lahir</label>' +
                '<input type="date" class="form-control" id="tanggallahir" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">No. Handphone</label>' +
                '<input type="number" id="phone" placeholder="Masukkan nomor hp" class="form-control" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Alamat</label>' +
                '<textarea id="alamat" placeholder="Masukkan alamat" required class="form-control"></textarea>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Propinsi</label>' +
                '<select name="propinsi" onchange="get_kabupaten(' + "'','',''" +
                ')" id="edit_propinsi" class="form-control" required>' +
                '<option value="">--Select Here--</option>' +
                '@foreach ($propinsi as $prop)' +
                '<option value="{{ $prop->id }}">{{ $prop->nama }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Kabupaten</label>' +
                '<select name="kabupaten" onchange="get_kecamatan(' + "'',''" +
                ')" id="edit_kabupaten" class="form-control" required>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Kecamatan</label>' +
                '<select name="kecamatan" onchange="get_kelurahan(' + "''" +
                ')" id="edit_kecamatan" class="form-control" required>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Kelurahan</label>' +
                '<select name="kelurahan" id="edit_kelurahan" class="form-control" required>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">RT</label>' +
                '<input type="number" id="rt" placeholder="Masukkan nomor rt" class="form-control" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">RW</label>' +
                '<input type="number" id="rw" placeholder="Masukkan nomor rw" class="form-control" required>' +
                '</div>';
        }

        function elemen_form_daftar(data, tipe) {
            global_asuransi = data.asuransi;
            var jp = '';
            var perusahaan = '';
            var asuransi = '';
            var poli = '';
            var nama_pj = data.layanan ? data.layanan.namapenanggungjawab : '';
            var telp_pj = data.layanan ? data.layanan.telponpenanggungjawab : '';

            for (let i = 0; i < data.jenispasien.length; i++) {
                jp += '<option value="' + data.jenispasien[i].slug + '-' + data.jenispasien[i].asuransi + '-' + data
                    .jenispasien[i].nama_perusahaan + '">' + data.jenispasien[i].nama + '</option>';
            }

            for (let i = 0; i < data.perusahaan.length; i++) {
                perusahaan += '<option value="' + data.perusahaan[i].id + '">' + data.perusahaan[i].nama + '</option>';
            }

            for (let i = 0; i < data.asuransi.length; i++) {
                asuransi += '<option value="' + data.asuransi[i].id + '">' + data.asuransi[i].nama + '</option>';
            }

            for (let i = 0; i < data.poli.length; i++) {
                poli += '<option value="' + data.poli[i].kodepoli_bpjs + '-' + data.poli[i].nama_poli + '">' + data.poli[i]
                    .kodepoli_bpjs + ' - ' + data.poli[i].nama_poli + '</option>';
            }

            var addOn = '';
            var btn = '';

            if (tipe == 'umum') {
                addOn = '<input type="hidden" id="nobpjs" value="">' +
                    '<input type="hidden" id="ktp" value="' + data.pasien.ktp + '">';
                btn = '<button class="btn btn-success" onclick="pasien_daftar()">Daftar</button>';
            } else if (tipe == 'bpjs') {
                addOn = '<input type="hidden" id="ktp" value="' + data.pasien.ktp + '">' +
                    '<div class="form-group">' +
                    '<label for="">No. BPJS</label>' +
                    '<input type="number" min="0" required id="nobpjs" value="' + data.pasien.nobpjs +
                    '" class="form-control">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="">No. Referensi / No. Rujukan / No. SEP</label>' +
                    '<input type="text" required id="nomorreferensi" class="form-control">' +
                    '</div>';
                btn = '<button class="btn btn-success" onclick="pasien_bpjs_daftar()">Daftar</button>';
            }

            return '<div class="col-lg-12">' +
                '<button class="btn btn-dark p-2" onclick="pendaftaran_pasien()"><i class="fa fa-home"></i></button>' +
                '</div>' +
                '<div class="col-lg-3"></div><form class="col-lg-6" onsubmit="do_daftar_pasien_umum()">' +
                addOn +
                '<div class="form-group">' +
                '<label for="">Pembayaran</label>' +
                '<select name="jenis_pasien" onchange="ubah_jenis_pasien()" id="jenis_pasien" class="form-control" required>' +
                '<option value="">--Select Here--</option>' +
                jp +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Asuransi</label>' +
                '<select name="asuransi" id="asuransi" class="form-control" disabled>' +
                '<option value="">--Select Here--</option>' +
                asuransi +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Perusahaan</label>' +
                '<select name="perusahaan" id="perusahaan" class="form-control" disabled>' +
                '<option value="">--Select Here--</option>' +
                perusahaan +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Nama Penanggung Jawab</label>' +
                '<input name="nama_pj" value="' + nama_pj + '" type="text" id="nama_pj" class="form-control" required />' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Telp. Penanggung Jawab</label>' +
                '<input name="telp_pj" value="' + telp_pj +
                '" type="number" min="0" id="telp_pj" class="form-control" required />' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Tanggal Periksa</label>' +
                '<input type="date" value="' + format_tanggal('') + '" min="' + format_tanggal('') +
                '" onchange="ubah_tanggal()" id="tanggal" name="tanggalperiksa" class="form-control" required>' +
                '</div>' +
                ' <div class="form-group">' +
                '<label for="">Poliklinik / Unit Penunjang</label>' +
                '<select name="kodepoli" onchange="ubah_poli()" id="poli" class="form-control" required>' +
                '<option value="">--Select Here--</option>' +
                poli +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Dokter</label>' +
                '<select name="kodedokter" onchange="ubah_dokter()" id="dokter" class="form-control" required>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Jam Praktek</label>' +
                '<select name="jampraktek" id="jam" class="form-control" required>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Jenis Kunjungan</label>' +
                '<select id="jenis_kunjungan" class="form-control" required>' +
                '<option value="">--Select Here--</option>' +
                '<option value="1">Rujukan FKTP</option>' +
                '<option value="2">Rujukan Internal</option>' +
                '<option value="3">Kontrol</option>' +
                '<option value="4">Rujukan Antar RS</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Kedatangan</label>' +
                '<select id="kedatangan" onchange="select_perujuk(this.value)" class="form-control" required>' +
                '<option value="">--Select Here--</option>' +
                '<option value="Datang Sendiri">Datang Sendiri</option>' +
                '<option value="Rujukan">Rujukan</option>' +
                '<option value="Diterima Kembali">Diterima Kembali</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Jenis Perujuk</label>' +
                '<select id="jenis_perujuk" class="form-control">' +
                '<option value="">--Select Here--</option>' +
                '<option value="Dokter">Dokter</option>' +
                '<option value="Mantri">Mantri</option>' +
                '<option value="Bidan">Bidan</option>' +
                '<option value="Puskesmas">Puskesmas</option>' +
                '<option value="RS Lain">RS Lain</option>' +
                '<option value="Balai Pengobatan Lain">Balai Pengobatan Lain</option>' +
                '<option value="Karyawan">Karyawan</option>' +
                '<option value="Lainnya">Lainnya</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="">Nama Perujuk</label>' +
                '<div class="input-group">' +
                '<input type="hidden" class="form-control" id="id_perujuk"/>' +
                '<input type="text" readonly class="form-control" id="nama_perujuk"/>' +
                '<div class="input-group-append">' +
                '<button class="btn btn-primary" id="btn_pilih_perujuk" type="button" onclick="open_modal_perujuk()"><i class="fas fa-list"></i></button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-group" id="msg_daftar">' +
                '</div>' +
                '<div class="form-group text-center">' +
                btn +
                '</div>' +
                '</form><div class="col-lg-3"></div>';
        }

        function select_perujuk(param) {
            if ($('#dokter').val() == '' || $('#dokter').val() == null) {
                alert('Pilih dokter dahulu');
                $('#kedatangan').val('');
                return;
            }

            if (param == 'Rujukan') {
                $('#id_perujuk').val('');
                $('#nama_perujuk').val('');
                $('#jenis_perujuk').removeAttr('disabled');
                $('#btn_pilih_perujuk').removeAttr('disabled');
                return;
            } else {
                $('#btn_pilih_perujuk').attr('disabled', true);
                $('#jenis_perujuk').attr('disabled', true);
            }

            if (param == 'Diterima Kembali') {
                $('#jenis_perujuk').removeAttr('disabled');
                $.ajax({
                    url: "{{ url('ajax_request/perujuk_by_kodedokter') }}",
                    data: {
                        kodedokter: $('#dokter').val()
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == null) {
                            return;
                        }
                        $('#id_perujuk').val(response.id);
                        $('#nama_perujuk').val(response.nama);
                    }
                })
            }
        }

        function open_modal_perujuk() {
            if ($.fn.DataTable.isDataTable('#tabel_perujuk')) {
                $('#tabel_perujuk').dataTable().fnClearTable();
                $('#tabel_perujuk').dataTable().fnDestroy();
            }
            $('#tabel_perujuk').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! url('ajax_request/perujuk') !!}", // memanggil route yang menampilkan data json
                columns: [{
                        "data": 'id',
                        name: 'id',
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart +
                                1) + '</div>';
                        }
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center"><button class="btn btn-dark" onclick="set_perujuk(' +
                                "'" + data + "','" + row.nama + "'" +
                                ')"><i class="fas fa-check"></i></button></div>';
                        }
                    }
                ]
            });
            $('#modal_perujuk').modal('show');
        }

        function set_perujuk(id, nama) {
            $('#id_perujuk').val(id);
            $('#nama_perujuk').val(nama);
            $('#modal_perujuk').modal('hide');
        }

        function pasien_daftar() {
            window.event.preventDefault();

            if ($('#jenis_pasien').val() == '') {
                alert('Pilih pembayaran dahulu');
                return;
            }

            var temp = $('#jenis_pasien').val().split('-');
            if (temp[1] == 1) {
                if ($('#asuransi').val() == '') {
                    alert('Asuransi wajib dipilih');
                    return;
                }
            }else if (temp[2] == 1) {
                if ($('#perusahaan').val() == '') {
                    alert('Perusahaan wajib dipilih');
                    return;
                }
            }

            $('#msg_daftar').html(loading);
            $.ajax({
                url: "{{ url('ajax_request/pasien_daftar') }}",
                method: 'post',
                data: {
                    _method: 'post',
                    _token: '{{ csrf_token() }}',
                    nama_pj: $('#nama_pj').val(),
                    telp_pj: $('#telp_pj').val(),
                    nobpjs: $('#nobpjs').val(),
                    ktp: $('#ktp').val(),
                    tanggalperiksa: $('#tanggal').val(),
                    kodepoli: $('#poli').val(),
                    kodedokter: $('#dokter').val(),
                    jampraktek: $('#jam').val(),
                    jenis_kunjungan: $('#jenis_kunjungan').val(),
                    jenis_pasien: $('#jenis_pasien').val(),
                    asuransi: $('#asuransi').val(),
                    perusahaan: $('#perusahaan').val(),
                    jenis_perujuk: $('#jenis_perujuk').val(),
                    id_perujuk: $('#id_perujuk').val(),
                    kedatangan: $('#kedatangan').val()
                    // lantai: $('#lantai').val()
                },
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        $('#msg_daftar').html('<div class="alert alert-success text-center">' + response
                            .message + '</div>');
                        render_hasil(response.antrian, response.pasien);
                        return;
                    }
                    $('#msg_daftar').html('<div class="alert alert-danger text-center">' + response.message +
                        '</div>');
                }
            })
        }

        function pasien_bpjs_daftar() {
            window.event.preventDefault();
            if ($('#jenis_pasien').val() == '') {
                alert('Pilih pembayaran dahulu');
                return;
            }
            var temp = $('#jenis_pasien').val().split('-');
            if (temp[1] == 1) {
                if ($('#asuransi').val() == '') {
                    alert('Asuransi wajib dipilih');
                    return;
                }
            }else if (temp[2] == 1) {
                if ($('#perusahaan').val() == '') {
                    alert('Perusahaan wajib dipilih');
                    return;
                }
            }
            $('#msg_daftar').html(loading);
            $.ajax({
                url: "{{ url('ajax_request/pasien_daftar') }}",
                method: 'post',
                data: {
                    _method: 'post',
                    _token: '{{ csrf_token() }}',
                    nama_pj: $('#nama_pj').val(),
                    telp_pj: $('#telp_pj').val(),
                    nobpjs: $('#nobpjs').val(),
                    ktp: $('#ktp').val(),
                    nomorreferensi: $('#nomorreferensi').val(),
                    tanggalperiksa: $('#tanggal').val(),
                    kodepoli: $('#poli').val(),
                    kodedokter: $('#dokter').val(),
                    jampraktek: $('#jam').val(),
                    jenis_kunjungan: $('#jenis_kunjungan').val(),
                    jenis_pasien: $('#jenis_pasien').val(),
                    asuransi: $('#asuransi').val(),
                    perusahaan: $('#perusahaan').val(),
                    jenis_kunjungan: $('#jenis_kunjungan').val(),
                    jenis_perujuk: $('#jenis_perujuk').val(),
                    id_perujuk: $('#id_perujuk').val(),
                    kedatangan: $('#kedatangan').val()
                    // lantai: $('#lantai').val()
                },
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        $('#msg_daftar').html('<div class="alert alert-success text-center">' + response
                            .message + '</div>');
                        render_hasil(response.antrian, response.pasien);
                        return;
                    }
                    $('#msg_daftar').html('<div class="alert alert-danger text-center">' + response.message +
                        '</div>');
                }
            })
        }

        function format_tanggal(param) {
            var temp = new Date();
            if (param != '') {
                temp = new Date(param);
            }
            var date = temp.getDate() < 10 ? '0' + temp.getDate() : temp.getDate();
            var month = temp.getMonth() + 1 < 10 ? '0' + (temp.getMonth() + 1) : temp.getMonth() + 1;
            return temp.getFullYear() + '-' + month + '-' + date;
        }

        function format_tanggal_dmy(param) {
            var temp = new Date();
            if (param != '') {
                temp = new Date(param);
            }
            var date = temp.getDate() < 10 ? '0' + temp.getDate() : temp.getDate();
            var month = temp.getMonth() + 1 < 10 ? '0' + (temp.getMonth() + 1) : temp.getMonth() + 1;
            return date + '-' + month + '-' + temp.getFullYear();
        }

        function format_tanggal_jam(param) {
            var temp = new Date(param);
            var date = temp.getDate() < 10 ? '0' + temp.getDate() : temp.getDate();
            var month = temp.getMonth() + 1 < 10 ? '0' + (temp.getMonth() + 1) : temp.getMonth() + 1;
            var jam = temp.getHours() < 10 ? '0' + temp.getHours() : temp.getHours();
            var menit = temp.getMinutes() < 10 ? '0' + temp.getMinutes() : temp.getMinutes();
            return date + '-' + month + '-' + temp.getFullYear() + ' ' + jam + ':' + menit;
        }

        function render_hasil(antrian, pasien) {
            $('#tab_pendaftaran_pasien').html('<div class="col-lg-12 pb-3 text-center">' + spinner_lg('') + '</div>');
            var ins = '<div class="col-lg-3"></div>' +
                '<div class="col-lg-6" style="display: flex; justify-content: center; align-items: center;">' +
                '<div id="box" class="card p-4" style="box-shadow: 3px 3px 3px 3px #999; width:100%;">' +
                '<div id="msg"></div>' +
                '<div class="alert alert-warning col-lg-112">* Harap catat atau foto nomor antrian dan kodebooking sebelum menutup halaman ini</div>' +
                '<h3 style="text-align: center;">Pendaftaran</h3>' +
                '<br>' +
                '<br>' +
                '<h6 style="text-align: center;">Nomor Antrean</h6>' +
                '<br>' +
                '<h2 class="text-center">' + antrian.nomorantrean + '</h2>' +
                '<br>' +
                '<h6 style="text-align: center;">Kode Booking</h6>' +
                '<br>' +
                '<h2 class="text-center">' + antrian.kodebooking + '</h2>' +
                '<br>' +
                '<h6 class="text-center">' +
                'Estimasi Jam Pelayanan ' + format_tanggal_jam(antrian.estimasidilayani) +
                '</h6>' +
                '<h6 class="text-center">Peserta harap 60 menit lebih awal guna pencatatan administrasi.</h6>' +
                '<button class="btn btn-danger mb-1" onclick="checkin(' + "'" + antrian.kodebooking + "'" +
                ')" id="btn_checkin">Check In</button>' +
                '<a class="btn btn-success mb-1" target="_blank" href="../cetak_antrian?nomor=' + antrian.kodebooking +
                '">Cetak Antrian</a>' +
                '<button class="btn btn-dark mb-1" onclick="pendaftaran_pasien()">Kembali ke halaman awal</button>' +
                '</div>' +
                '</div>' +
                '<div class="col-lg-3"></div>';
            $('#tab_pendaftaran_pasien').html(ins);
        }

        function ubah_poli() {
            if ($('#tanggal').val() == '') {
                alert('Pilih tanggal periksa dahulu');
                $('#poli').val('');
                return;
            }
            $('#dokter').html('');
            $('#jam').html('');
            if ($('#poli').val() == '') {
                return;
            }
            $.ajax({
                url: "{{ url('ajax_request/dokter_by_poli') }}",
                data: {
                    kode: $('#poli').val(),
                },
                success: function(response) {
                    console.log(response);
                    if (response.length <= 0) {
                        return;
                    }
                    let ins = '<option value="">--Select Here--</option>';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<option value="' + response[i].kodedokter_bpjs + '">' + response[i]
                            .nama_dokter + '</option>';
                    }
                    $('#dokter').html(ins);
                }
            })
        }

        function ubah_dokter() {
            if ($('#tanggal').val() == '') {
                alert('Pilih tanggal periksa dahulu');
                $('#dokter').val('');
                return;
            }
            $('#jam').html('');
            if ($('#dokter').val() == '') {
                return;
            }
            let day = new Date($('#tanggal').val()).getDay();
            $.ajax({
                url: "{{ url('ajax_request/jam_praktek_by_dokter') }}",
                data: {
                    dokter: $('#dokter').val(),
                    hari: day == 0 ? 7 : day
                },
                success: function(response) {
                    console.log(response);
                    if (response.length <= 0) {
                        return;
                    }
                    let ins = '';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<option value="' + response[i].jam_mulai + '-' + response[i].jam_selesai +
                            '">' + response[i].jam_mulai + '-' + response[i].jam_selesai + '</option>';
                    }
                    $('#jam').html(ins);
                }
            })
        }

        function ubah_tanggal() {
            $("#poli").val('');
            $("#dokter").html('');
            $("#jam").html('');
        }

        function ubah_jenis_pasien() {
            if ($('#jenis_pasien').val() == '') {
                $('#asuransi').attr('disabled', true);
                $('#perusahaan').attr('disabled', true);
                $('#asuransi').removeAttr('required');
                $('#perusahaan').removeAttr('required');
            } else {
                var temp = $('#jenis_pasien').val().split('-');                

                if (temp[1] == 1) {
                    $('#asuransi').removeAttr('disabled');
                    var temp_ins = '<option value="">--Select Here--</option>';
                    if(temp[0] == 'bpjs'){
                        for (let i = 0; i < global_asuransi.length; i++) {
                            if (global_asuransi[i].jenis_pasien == 'bpjs') {
                                temp_ins += '<option value="' + global_asuransi[i].id + '">' + global_asuransi[i].nama + '</option>';
                            }
                        }
                    }else{
                        for (let i = 0; i < global_asuransi.length; i++) {
                            if (global_asuransi[i].jenis_pasien != 'bpjs') {
                                temp_ins += '<option value="' + global_asuransi[i].id + '">' + global_asuransi[i].nama + '</option>';
                            }
                        }
                    }

                    $('#asuransi').html(temp_ins);
                    $('#asuransi').attr('required', true);    
                } else {
                    $('#asuransi').attr('disabled', true);
                    $('#asuransi').removeAttr('required');
                }

                if (temp[2] == 1) {
                    $('#perusahaan').removeAttr('disabled');
                    $('#perusahaan').attr('required', true);
                } else {
                    $('#perusahaan').attr('disabled', true);
                    $('#perusahaan').removeAttr('required');
                }
            }
        }

        function form_search_pasien_umum() {
            $('#tab_pendaftaran_pasien').html('<div class="col-lg-12 pb-3 text-center">' + spinner_lg('') + '</div>');
            $('#tab_pendaftaran_pasien').html(form_search_umum);
        }

        function form_search_pasien_bpjs() {
            $('#tab_pendaftaran_pasien').html('<div class="col-lg-12 pb-3 text-center">' + spinner_lg('') + '</div>');
            $('#tab_pendaftaran_pasien').html(form_search_bpjs);
        }

        function form_daftar_pasien_umum(ktp, bpjs) {
            $('#tab_pendaftaran_pasien').html('<div class="col-lg-12 pb-3 text-center">' + spinner_lg('') + '</div>');
            $.ajax({
                url: "{{ url('ajax_request/data_master_form_pendaftaran') }}",
                data: {
                    nomor: ktp
                },
                success: function(response) {
                    console.log(response);
                    // var lantai = $('#lantai').val();
                    kode_booking = response.kodebooking;
                    $('#tab_pendaftaran_pasien').html(elemen_form_daftar(response, 'umum'));
                }
            })
        }

        function form_daftar_pasien_bpjs(ktp, bpjs) {
            $('#tab_pendaftaran_pasien').html('<div class="col-lg-12 pb-3 text-center">' + spinner_lg('') + '</div>');
            $.ajax({
                url: "{{ url('ajax_request/data_master_form_pendaftaran') }}",
                data: {
                    nomor: ktp,
                },
                success: function(response) {
                    console.log(response);
                    // var lantai = $('#lantai').val();
                    kode_booking = response.kodebooking;
                    $('#tab_pendaftaran_pasien').html(elemen_form_daftar(response, 'bpjs'));
                }
            })
        }

        function update_mjkn() {
            window.event.preventDefault();
            $('#loading_update').html('<div class="alert alert-info text-center">' + loading + '</div>');
            $.ajax({
                url: "{{ url('antrian/pendaftaran/mjkn_patient/update') }}",
                method: 'post',
                data: {
                    _method: 'put',
                    _token: '{{ csrf_token() }}',
                    id: $('#edit_id').val(),
                    nobpjs: $('#edit_nobpjs').val(),
                    nik: $('#edit_nik').val(),
                    // no_kk: $('#edit_no_kk').val(),
                    nama: $('#edit_nama').val(),
                    kelamin: $('#edit_kelamin').val(),
                    tgl_lahir: $('#edit_tgl_lahir').val(),
                    telepon: $('#edit_telepon').val(),
                    alamat: $('#edit_alamat').val(),
                    propinsi: $('#edit_propinsi').val(),
                    kabupaten: $('#edit_kabupaten').val(),
                    kecamatan: $('#edit_kecamatan').val(),
                    kelurahan: $('#edit_kelurahan').val(),
                    rt: $('#edit_rt').val(),
                    rw: $('#edit_rw').val(),
                },
                success: function(response) {
                    if (response.status) {
                        $('#loading_update').html('<div class="alert alert-success text-center">' + response
                            .message + '</div>');
                        get_mjkn();
                        $('#modal_edit_mjkn_patient').modal('hide');
                    } else {
                        $('#loading_update').html('<div class="alert alert-danger text-center">' + response
                            .message + '</div>');
                    }
                },
                error: function(data) {
                    var list = '<ul>';
                    let temp = JSON.parse(data.responseText);
                    let key = Object.values(temp.errors);
                    console.log(key);
                    for (let i = 0; i < key.length; i++) {
                        list += '<li>' + key[i][0] + '</li>';
                    }
                    list += '</ul>';
                    $('#loading_update').html('<div class="alert alert-danger">' + list + '</div>');
                }
            })
        }

        let synth = window.speechSynthesis;
        var last_queue = 0;

        var loading = '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> Menyimpan data...';

        var loading_kanan = '<tr class="text-center">' +
            '<td colspan="6">' +
            '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> Sedang mengambil data...' +
            '</td>' +
            '</tr>';

        var loading_kiri = '<tr class="text-center">' +
            '<td colspan="8">' +
            '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> Sedang mengambil data...' +
            '</td>' +
            '</tr>';

        $('#edit_propinsi').change(function() {
            $('#edit_kabupaten').html('<option value=""><-- Select Here --/option>');
            $('#edit_kecamatan').html('<option value=""><-- Select Here --/option>');
            $('#edit_kelurahan').html('<option value=""><-- Select Here --/option>');
            get_kabupaten('', '', '');
        })

        $('#edit_kabupaten').change(function() {
            $('#edit_kecamatan').html('<option value=""><-- Select Here --/option>');
            $('#edit_kelurahan').html('<option value=""><-- Select Here --/option>');
            get_kecamatan('', '');
        })

        $('#edit_kecamatan').change(function() {
            $('#edit_kelurahan').html('<option value=""><-- Select Here --/option>');
            get_kelurahan('');
        })

        function pendaftaran_pasien() {
            var ins = '<div class="row pt-4" id="tab_pendaftaran_pasien" style="width: 100%; margin-left: 0;">' +
                '<div class="col-lg-12">' +
                '<h3 style="text-align: center;">Pendaftaran Pasien</h3>' +
                '<h6 style="text-align: center;">Pilih jenis pasien dibawah ini.</h6>' +
                '</div>' +
                '<div class="col-lg-6 text-center">' +
                '<button class="btn btn-danger" onclick="form_search_pasien_umum()">' +
                '<img src="../images/umum.png" alt=""><br>' +
                'Pasien Non BPJS' +
                '</button>' +
                '</div>' +
                '<div class="col-lg-6 text-center">' +
                '<button class="btn btn-success" onclick="form_search_pasien_bpjs()">' +
                '<img src="../images/bpjs.png" alt=""><br>' +
                'Pasien BPJS' +
                '</button>' +
                '</div>' +
                '<div class="col-lg-12 alert alert-info mt-4 pb-3 text-center">' +
                '<b>NON BPJS merupakan pasien umum, asuransi lainnya, rekanan, jamkesda dan jenis pembayaran NON BPJS lainnya</b>' +
                '</div>' +
                '</div>';
            $('#pendaftaran_pasien').html(ins);
        }

        $(document).ready(function() {
            get_antrian();
            get_mjkn();
            get_antrian_manual();
            pendaftaran_pasien();
        })

        $('#loket').change(function() {
            get_antrian_manual();
        })

        function tambah_mjkn(id) {
            $.ajax({
                url: "{{ url('antrian/pendaftaran/pasien_mjkn_daftar') }}",
                data: {
                    pasien: id
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    get_mjkn();
                }
            })
        }

        function get_mjkn() {
            $('#list_kanan').html(loading_kanan);
            $.ajax({
                url: "{{ url('ajax_request/mjkn_patient') }}",
                success: function(response) {
                    console.log(response);
                    if (response.length == 0) {
                        $('#list_kanan').html(
                            '<tr class="text-center"><td colspan="6">Data tidak ditemukan</td></tr>');
                        return;
                    }

                    let ins = '';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<tr>' +
                            '<td class="text-center">' + (i + 1) + '</td>' +
                            '<td>' + response[i].nama + '</td>' +
                            '<td>' + response[i].nrm + '</td>' +
                            '<td>' + response[i].nobpjs + '</td>' +
                            '<td>' + response[i].nik + '</td>' +
                            '<td class="text-center"><div style="display:flex"><button class="btn btn-warning mr-1" onclick="open_modal_edit_mjkn(' +
                            "'" + response[i].id + "'" +
                            ')">Ubah</button><button class="btn btn-dark mr-1" onclick="panggil_pasien_baru(' +
                            "'" + response[i].nama + "'" +
                            ')">Panggil</button><button class="btn btn-primary mr-1" onclick="tambah_mjkn(' +
                            "'" +
                            response[i].id + "'" + ')">Tambah</button></div></td>' +
                            '</tr>';
                    }
                    $('#list_kanan').html(ins);
                }
            })
        }

        function panggil_pasien_baru(pasien) {
            $.ajax({
                url: "{{ url('ajax_request/send_broadcast') }}",
                method: 'post',
                data: {
                    loket: $('#loket').val().replace(' ', '_'),
                    nomor: '',
                    bagian: 'pendaftaran',
                    _token: '{{ csrf_token() }}',
                    lantai: '',
                    pasien: pasien,
                    baru: 1,
                    manual: false
                },
                success: function(response) {
                    if (response) {
                        console.log(response)
                    }
                }
            })
        }

        function get_antrian_manual() {
            $.ajax({
                url: "{{ url('ajax_request/antrian_manual') }}",
                data: {
                    jenis: $('#loket').val(),
                },
                success: function(response) {
                    console.log(response);
                    if (Object.keys(response).length > 0) {
                        var alpha = '';
                        switch (response.jenis) {
                            case 'loket 1':
                                alpha = 'A';
                                break;
                            case 'loket 2':
                                alpha = 'B';
                                break;
                            case 'loket 3':
                                alpha = 'C';
                                break;
                            case 'loket 4':
                                alpha = 'D';
                                break;

                            default:
                                break;
                        }
                        $('#nomorantrian_manual').val(alpha + response.last_call + ' / ' + alpha + response
                            .last_queue);
                        last_queue = response.last_queue;
                    } else {
                        $('#nomorantrian_manual').val('');
                    }
                }
            })
        }

        function panggil_berikutnya() {
            panggil_pasien_manual('next');
        }

        function panggil_ulang() {
            panggil_pasien_manual('repeat');
        }

        function panggil_pasien_manual(tipe) {
            $.ajax({
                url: "{{ url('ajax_request/send_broadcast') }}",
                method: 'post',
                data: {
                    loket: $('#loket').val(),
                    bagian: 'pendaftaran',
                    _token: '{{ csrf_token() }}',
                    lantai: '',
                    pasien: '',
                    baru: 1,
                    jenis: $('#loket').val(),
                    manual: 1,
                    tipe: tipe
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        get_antrian_manual();
                        return;
                    }

                    if (response != null && tipe == 'next') {
                        var alpha = '';
                        switch (response.data.jenis) {
                            case 'bpjs':
                                alpha = 'A';
                                break;
                            case 'umum':
                                alpha = 'B';
                                break;
                            case 'asuransi':
                                alpha = 'C';
                                break;
                            case 'ranap':
                                alpha = 'D';
                                break;

                            default:
                                break;
                        }

                        $('#nomorantrian_manual').val(alpha + response.data.last_call + ' / '+ alpha + response.data
                            .last_queue);
                    }
                    get_antrian_manual();
                }
            })
        }

        function get_antrian() {
            $('#list_kiri').html(loading_kiri);
            $.ajax({
                url: "{{ url('ajax_request/antrian_pendaftaran') }}",
                data: $('#form_pencarian').serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.length == 0) {
                        $('#list_kiri').html(
                            '<tr class="text-center"><td colspan="8">Data tidak ditemukan</td></tr>');
                        return;
                    }

                    let ins = '';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<tr>' +
                            '<td class="text-center">' + (i + 1) + '</td>' +
                            '<td>' + response[i].nomorantrean + '</td>' +
                            '<td>' + response[i].pasien + '</td>' +
                            '<td>' + response[i].norm + '</td>' +
                            '<td>' + response[i].nobpjs + '</td>' +
                            '<td>' + response[i].ktp + '</td>' +
                            '<td>' + status(response[i].taskid) + '</td>' +
                            '<td>' + render_button(response[i]) + '</td>' +
                            '</tr>';
                    }
                    $('#list_kiri').html(ins);
                }
            })
        }

        setInterval(function() {
            $('#cari_antrian').val('');
            get_antrian();
        }, 120000)

        function status(param) {
            switch (param) {
                case 0:
                    return 'Belum Checkin';
                    break;
                case 1:
                    return 'Belum Dilayani';
                    break;
                case 2:
                    return 'Sedang Dilayani';
                    break;
                default:
                    return '';
                    break;
            }
        }

        function layani_antrian(id) {
            $.ajax({
                url: "{{ url('antrian/pendaftaran_layani_antrian') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    get_antrian();
                }
            })
        }

        function update_finger_print(id) {
            $.ajax({
                url: "{{ url('antrian/update_finger_print') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    get_antrian();
                }
            })
        }

        function selesai_antrian(id) {
            $.ajax({
                url: "{{ url('antrian/pendaftaran_selesai_antrian') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    get_antrian();
                }
            })
        }

        function render_button(param) {
            if($('[name=cari_tanggal]').val() == '{{date("Y-m-d")}}'){
                var checkin = '';
                switch (param.taskid) {
                    case 0:
                        checkin = param.noreg == '' ? '<button class="btn btn-primary mr-1 checkin" onclick="checkin(' + "'" + param.kodebooking + "'" + ')">Checkin</button>' : '';
                        return '<div style="display:flex;">' 
                            + checkin 
                            + '<button class="btn btn-danger" onclick="open_modal_batal(' + param.id + ')">Batal</button>'
                            + '<a class="btn btn-info ml-1" href="../cetak_antrian?nomor=' + param.kodebooking + '" target="_blank">Cetak</a>'
                            + '</div>';
                        break;
                    case 1:
                        checkin = param.noreg == '' ? '<button class="btn btn-primary mr-1 checkin" onclick="checkin(' + "'" + param.kodebooking + "'" + ')">Checkin</button>' : '';
                        return '<div style="display:flex;">' 
                            + checkin 
                            + '<button class="btn btn-dark mr-1" onclick="panggil(' + "'" + param.nomorantrean + "'" + ',' + "'" + param.pasien + "'" +')">Panggil</button>'
                            + '<button class="btn btn-warning mr-1" onclick="layani_antrian(' + "'" + param.id + "'" + ')">Layani</button>'
                            + '<button class="btn btn-danger" onclick="open_modal_batal(' + param.id + ')">Batal</button>'
                            + '<a class="btn btn-info ml-1" href="../cetak_antrian?nomor=' + param.kodebooking + '" target="_blank">Cetak</a>'
                            + '</div>';
                        break;
                    case 2:
                        return '<div style="display:flex;">'
                            + '<button class="btn btn-success" onclick="selesai_antrian(' + "'" + param.id + "'" + ')">Selesai</button>'
                            + '<a class="btn btn-info ml-1" href="../cetak_antrian?nomor=' + param.kodebooking + '" target="_blank">Cetak</a>'
                            + '</div>';
                        break;
                    case 3:
                        checkin = param.noreg == '' ? '<button class="btn btn-primary mr-1 checkin" onclick="checkin(' + "'" + param.kodebooking + "'" + ')">Checkin</button>' : '';
                        if (param.pasien_baru == 0 && param.carabayar == 'bpjs' && param.keterangan != 'finger-print') {
                            return '<div style="display:flex;">' 
                                + checkin 
                                + '<button class="btn btn-dark mr-1" onclick="panggil(' + "'" + param.nomorantrean + "'" + ',' + "'" + param.pasien + "'" + ')">Panggil</button>'
                                +'<button class="btn btn-danger ml-1" onclick="open_modal_batal(' + param.id + ')">Batal</button><a class="btn btn-info ml-1" href="../cetak_antrian?nomor=' + param.kodebooking + '" target="_blank">Cetak</a>'
                                +'</div>';
                        }
                        return '<div style="display:flex;">' 
                            + checkin 
                            + '<button class="btn btn-danger" onclick="open_modal_batal(' + param.id + ')">Batal</button>'
                            + '<a class="btn btn-info ml-1" href="../cetak_antrian?nomor=' + param.kodebooking + '" target="_blank">Cetak</a>'
                            + '</div>';
                        return '';
                        break;
                    default:
                        return '<a class="btn btn-info mr-1" href="../cetak_antrian?nomor=' + param.kodebooking + '" target="_blank">Cetak</a>';
                        break;
                }
            }else{
                return '<div style="display:flex;">' 
                            + '<button class="btn btn-danger" onclick="open_modal_batal(' + param.id + ')">Batal</button>'
                            + '<a class="btn btn-info ml-1" href="../cetak_antrian?nomor=' + param.kodebooking + '" target="_blank">Cetak</a>'
                            + '</div>';
            }
        }

        function panggil(nomor, pasien) {
            $.ajax({
                url: "{{ url('ajax_request/send_broadcast') }}",
                method: 'post',
                data: {
                    loket: $('#loket').val().replace(' ', '_'),
                    nomor: nomor,
                    bagian: 'pendaftaran',
                    _token: '{{ csrf_token() }}',
                    lantai: '',
                    pasien: pasien,
                    baru: 0,
                    manual: 0,
                },
                success: function(response) {
                    if (response) {
                        console.log(response)
                    }
                }
            })
        }

        function open_modal_batal(param) {
            $('#id_batal').val(param);
            $('#modal_batal').modal('show');
        }

        function open_modal_edit_mjkn(param) {
            $.ajax({
                url: "{{ url('ajax_request/select_mjkn_patient') }}",
                data: {
                    pasien: param
                },
                success: function(response) {
                    console.log(response);
                    if (response == null) {
                        return;
                    }

                    $('#edit_id').val(response.id);
                    $('#edit_nobpjs').val(response.nobpjs);
                    $('#edit_nik').val(response.nik);
                    // $('#edit_no_kk').val(response.no_kk);
                    $('#edit_nama').val(response.nama);
                    $('#edit_kelamin').val(response.kelamin);
                    $('#edit_tgl_lahir').val(response.tgl_lahir);
                    $('#edit_telepon').val(response.telepon);
                    $('#edit_alamat').val(response.alamat);
                    $('#edit_propinsi').val(response.id_propinsi);
                    get_kabupaten(response.id_kabupaten, response.id_kecamatan, response.id_kelurahan);
                    // $('#edit_kabupaten').html('<option value="'+response.id_kabupaten+'">'+response.kabupaten+'</option>');
                    // $('#edit_kecamatan').html('<option value="'+response.id_kecamatan+'">'+response.kecamatan+'</option>');
                    // $('#edit_kelurahan').html('<option value="'+response.id_kelurahan+'">'+response.kelurahan+'</option>');
                    $('#edit_rt').val(response.rt);
                    $('#edit_rw').val(response.rw);
                    $('#modal_edit_mjkn_patient').modal('show');
                }
            })
        }

        function spinner(param) {
            return '<div class="spinner-border spinner-border-sm" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div> ' + param;
        }

        function checkin(param) {
            $('#msg').html('<div class="alert alert-info text-center" style="font-weight:bold;">' + spinner(
                'Harap tunggu, sedang melakukan checkin...') + '</div>');
            $('.checkin').attr('disabled', true);
            $.ajax({
                url: "{{ url('ajax_request/checkin') }}",
                data: {
                    kodebooking: param
                },
                success: function(response) {
                    console.log(response);
                    var btn_close_alert =
                        '<button type="button" style="color:#fff;" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>';
                    if (response.status) {
                        $('#msg').html(
                            '<div class="alert alert-success text-center" style="font-weight:bold;">' +
                            response.message + btn_close_alert + '</div>');
                    } else {
                        $('#msg').html(
                            '<div class="alert alert-danger text-center" style="font-weight:bold;">' +
                            response.message + btn_close_alert + '</div>');
                    }
                    get_antrian();
                }
            })
        }

        function get_kabupaten(kab, kec, kel) {
            $('#edit_kabupaten').html('<option value="">-- Sedang mengambil data --</option>');
            $.ajax({
                url: "{{ url('ajax_request/get_kabupaten') }}",
                data: {
                    propinsi: $('#edit_propinsi').val()
                },
                success: function(response) {
                    if (response == null) {
                        $('#edit_kabupaten').html('<option value="">-- Tidak ada data --</option>');
                        return;
                    }

                    var ins = '<option value="">-- Select Here --</option>';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<option value="' + response[i].id + '">' + response[i].nama + '</option>';
                    }
                    $('#edit_kabupaten').html(ins);
                    $('#edit_kabupaten').val(kab);
                    get_kecamatan(kec, kel);
                }
            })
        }

        function get_kecamatan(kec, kel) {
            $('#edit_kecamatan').html('<option value="">-- Sedang mengambil data --</option>');
            $.ajax({
                url: "{{ url('ajax_request/get_kecamatan') }}",
                data: {
                    kabupaten: $('#edit_kabupaten').val()
                },
                success: function(response) {
                    if (response == null) {
                        $('#edit_kecamatan').html('<option value="">-- Tidak ada data --</option>');
                        return;
                    }

                    var ins = '<option value="">-- Select Here --</option>';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<option value="' + response[i].id + '">' + response[i].nama + '</option>';
                    }
                    $('#edit_kecamatan').html(ins);
                    $('#edit_kecamatan').val(kec);
                    get_kelurahan(kel)
                }
            })
        }

        function get_kelurahan(kel) {
            $('#edit_kelurahan').html('<option value="">-- Sedang mengambil data --</option>');
            $.ajax({
                url: "{{ url('ajax_request/get_kelurahan') }}",
                data: {
                    kecamatan: $('#edit_kecamatan').val()
                },
                success: function(response) {
                    if (response == null) {
                        $('#edit_kelurahan').html('<option value="">-- Tidak ada data --</option>');
                        return;
                    }

                    var ins = '<option value="">-- Select Here --</option>';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<option value="' + response[i].id + '">' + response[i].nama + '</option>';
                    }
                    $('#edit_kelurahan').html(ins);
                    $('#edit_kelurahan').val(kel);
                }
            })
        }
    </script>
@endpush
