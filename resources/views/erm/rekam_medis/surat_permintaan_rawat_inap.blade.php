<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Permintaan Rawat Inap</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        #data_diri_header tr td {
            font-size: 16px;
            vertical-align: top;
        }

        #data_diri_ttd tr td {
            font-size: 20px;
            vertical-align: top;
        }

        #list_numbering li {
            font-size: 18px;
            list-style-type: decimal;
        }

        #list_alfabeth li {
            font-size: 18px;
            list-style-type: lower-alpha;
        }
    </style>
</head>

<body style="margin: 20px;">
<div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('e_rekam_medis/rekam_medis/verifikasi_dokumen_kunjungan') }}">
                @csrf
                <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password :</label>
                        <input type="password" name="pass" placeholder="Input your password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form onsubmit="return cek_form(this)" id="form_persetujuan" action="{{ url('e_rekam_medis/rekam_medis/save_surat_permintaan_rawat_inap') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" id="hide_unit" name="unit">
    <input type="hidden" id="hide_indikasi_rawat" name="indikasi_rawat">
    <input type="hidden" id="hide_id_dpjp" name="id_dpjp">
    <input type="hidden" id="hide_dpjp" name="dpjp">
    <input type="hidden" id="hide_id_dokter_pengirim" name="id_dokter_pengirim">
    <input type="hidden" id="hide_dokter_pengirim" name="dokter_pengirim">
    <input type="hidden" id="hide_tgl_rawat_inap" name="tgl_rawat_inap" >
    <input type="hidden" id="hide_id_kamar" name="id_kamar">
    <input type="hidden" id="hide_kamar" name="kamar" >
    <input type="hidden" id="hide_id_petugas_ranap" name="id_petugas_ranap">
    <input type="hidden" id="hide_petugas_ranap" name="petugas_ranap" >
    <input type="hidden" id="hide_tgl_rencana_operasi" name="tgl_rencana_operasi">
</form>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
@endif
@if(Session::has('gagal'))
    <div class="alert alert-danger">{{Session::get('gagal')}}</div>
@endif
@if(Session::has('sukses'))
    <div class="alert alert-success">{{Session::get('sukses')}}</div>
@endif
<div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
    <div class="col-lg-6" style="border: 1px solid;">
        <div class="row" style="width: 100%; vertical-align: center">
            <div class="col-lg-3" style="">
                <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
            </div>
            <div class="col-lg-9" style="margin-top: 10px">
                <p style="font-weight: bold; font-size:18px; text-align: left">
                    RUMAH SAKIT HARAPAN MULIA
                </p>
                <p
                    style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
                            <span style="font-weight: normal">
                                Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                                <br>Kabupaten Bekasi Jawa Barat (17340).
                                <br>Telp.: (021) 8995 2340
                                <br>Email : info@rumahsakit-harapanmulia.id
                            </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="width: 100%; margin-left: 0; padding:10px;">
        <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 16px;">
            <tr>
                <td style="width: 40%;">No Rekam Medis</td>
                <td style="padding-left:10px; padding-right:10px"> :</td>
                <td>{{ $layanan->nrm }}</td>
            </tr>
            <tr>
                <td style="width: 40%;">Unit</td>
                <td style="padding-left:10px; padding-right:10px"> :</td>
                <td>
                    <input @if(old('unit'))
                               {{ old('unit') ==  'igd' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->surat_permintaan_rawat_inap ? ($dokumen->surat_permintaan_rawat_inap->unit == 'igd' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="igd" name="radio_unit"> IGD
                    <input @if(old('unit'))
                               {{ old('unit') ==  'rawat_inap' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->surat_permintaan_rawat_inap ? ($dokumen->surat_permintaan_rawat_inap->unit == 'rawat_inap' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="rawat_inap" name="radio_unit" class="ml-4"> Rawat Inap
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row pb-3" style="width: 100%; margin-left: 0;">
    <div class="col-md-12 text-center">
        <h6><b><u>SURAT PERMINTAAN RAWAT INAP</u></b></h6>
    </div>
</div>
<div class="row" style="width: 100%; margin-left: 0;">
    <div class="col-md-12">
        <table style="width: 100%">
            <tr>
                <td colspan="3">Kepada Yth</td>
            </tr>
            <tr>
                <td style="width: 15%">Unit Pendaftaran</td>
                <td colspan="2">:</td>
            </tr>
            <tr>
                <td colspan="3">Mohon di daftarkan sebagai pasien Rawat Inap : <br><br><br></td>
            </tr>
            <tr>
                <td style="width: 15%">Nama Pasien</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    {{ $layanan->nama_pasien }}
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Tanggal Lahir</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    {{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Diagnosa</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : '' }}
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Indikasi Rawat</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    <input type="text" class="form-control" style="border: hidden"
                           value="@if(old('indikasi_rawat')){{ old('indikasi_rawat') }}@else{{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->indikasi_rawat : '' }}@endif"
                           id="indikasi_rawat">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">DPJP</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    <div class="input-group">
                        <input type="text" hidden id="id_dpjp" value="@if(old('id_dpjp')) {{ old('id_dpjp') }} @else {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->id_dpjp : ''}} @endif">
                        <input type="text" readonly
                               value="@if(old('dpjp')) {{ old('dpjp') }} @else {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->dpjp : ''}} @endif"
                               id="dpjp" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_yth('dpjp')"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Dokter Pengirim</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    <div class="input-group">
                        <input type="text" hidden id="id_dokter_pengirim" value="@if(old('id_dokter_pengirim')) {{ old('id_dokter_pengirim') }} @else {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->id_dokter_pengirim : ''}} @endif">
                        <input type="text" readonly
                               value="@if(old('dokter_pengirim')) {{ old('dokter_pengirim') }} @else {{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->dokter_pengirim : ''}} @endif"
                               id="dokter_pengirim" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_yth('dokter_pengirim')"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Tanggal Rawat Inap</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                @if(old('tgl_rawat_inap'))
                <input type="date" class="form-control" value="{{ old('tgl_rawat_inap') }}" id="tgl_rawat_inap">
                @else
                <input type="date" class="form-control" id="tgl_rawat_inap" value="{{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->tgl_rawat_inap : '' }}">
                @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 15%">Kamar :</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    <div class="input-group">
                        <input type="text" hidden id="id_kamar" value="{{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->id_kamar : ''}}">
                        <input type="text" readonly
                               value="{{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->kamar : ''}}"
                               id="kamar" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_kamar()"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 15%">Petugas Ranap :</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    <div class="input-group">
                        <input type="text" hidden id="id_petugas_ranap" value="{{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->id_petugas_ranap : ''}}">
                        <input type="text" readonly
                               value="{{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->petugas_ranap : ''}}"
                               id="petugas_ranap" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_petugas_ranap()"><i
                                    class="fa fa-list"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 15%">Tanggal Rencana Operasi</td>
                <td>:</td>
                <td style="width: 85%; border-bottom: 2px dotted">
                    <input type="date" class="form-control" id="tgl_rencana_operasi"
                           value="@if(old('tgl_rencana_operasi')){{ old('tgl_rencana_operasi') }}
                                   @else{{ $dokumen->surat_permintaan_rawat_inap ? $dokumen->surat_permintaan_rawat_inap->tgl_rencana_operasi : '' }}@endif">
                </td>
            </tr>
            <tr>
                <td colspan="3">Atas perhatiannya kami ucapkan terimakasih.</td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row pt-4" style="width:100%; margin-left: 0; ">
                        <div class="col-md-6 text-center" style="padding-top:30px; font-weight:bold;">
                        </div>
                        <div class="col-md-6 text-center pt-2" style="padding-top: 20px; font-weight:bold;">
                            <p>Bekasi, @if(is_null($dokumen->tanggal_update)) .......................................... @else {{ date('d-m-Y', strtotime($dokumen->tanggal_update)) }} @endif
                            </p>
                            <p style="margin-top:-6px;">Dokter Pengirim</p>
                            <a @if($dokumen->surat_permintaan_rawat_inap)onclick="open_modal_dokter()"@endif href="#"
                               style="text-decoration:none; color:#111; text-align: center">
                                @if($dokumen->id_verifikator == 0)
                                    <br>
                                    Klik Disini
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>Ttd & nama jelas
                                @else
                                    @if(isset($employee))
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                             style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>({{$dokumen->nama_verifikator}})
                                @endif
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row pt-5" style="width:100%; margin-left:0">
                        <div class="col-md-12 text-center">
                            <button onclick="submit_form()" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                    <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
                        <div style="text-align: center;" class="col-md-12">
                            @if($dokumen->id_verifikator != 0)
                                <a href="{{ url('e_rekam_medis/rekam_medis/pdf_surat_permintaan_rawat_inap?dokumen='.$dokumen->id) }}"
                                   class="btn btn-success" target="_blank">Download PDF</a>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="modal fade" id="modal_yth" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Kepada Yth.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabel_kepada" class="table table-striped mt-2" style="width: 100%;">
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
<div class="modal fade" id="modal_petugas_ranap" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Petugas Ranap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabel_petugas_ranap" class="table table-striped mt-2" style="width: 100%;">
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
<div class="modal fade" id="modal_kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Data Kamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabel_kamar" class="table table-striped mt-2" style="width: 100%;">
                    <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    var sts_yth = "";
    var table;
    function get_petugas_ranap() {
        table = $('#tabel_petugas_ranap').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url("ajax_request/petugas") }}',
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</p>';
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
                        fungsi_set = 'set_petugas_ranap(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function get_data_dokter() {
        table = $('#tabel_kepada').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url("ajax_request/dokter") }}',
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</p>';
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
                        var fungsi_set = "";
                        if (sts_yth == "dpjp") {
                            fungsi_set = 'set_kepada(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        } else if (sts_yth == "dokter_pengirim") {
                            fungsi_set = 'set_dokter(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        }
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function get_kamar() {
        table = $('#tabel_kamar').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url("ajax_request/kamar") }}',
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</p>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'id',
                    name: 'id',
                    render(data, type, row) {
                        fungsi_set = 'set_kamar(' + "'" + data + "','" + row.nama + "','" + row.nama_jabatan +"'"+ ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function open_modal_petugas_ranap() {
        get_petugas_ranap();
        $('#modal_petugas_ranap').modal('show');
    }

    function open_modal_yth(sts) {
        get_data_dokter();
        sts_yth = sts;
        $('#modal_yth').modal('show');
    }

    function open_modal_kamar() {
        get_kamar();
        $('#modal_kamar').modal('show');
    }

    function set_kepada(id, nama) {
        $('#dpjp').val(nama);
        $('#id_dpjp').val(id);
        $('#modal_yth').modal('hide');
    }

    function set_dokter(id, nama) {
        $('#dokter_pengirim').val(nama);
        $('#id_dokter_pengirim').val(id);
        $('#modal_yth').modal('hide');
    }

    function set_petugas_ranap(id, nama) {
        $('#petugas_ranap').val(nama);
        $('#id_petugas_ranap').val(id);
        $('#modal_petugas_ranap').modal('hide');
    }

    function set_kamar(id, nama) {
        $('#kamar').val(nama);
        $('#id_kamar').val(id);
        $('#modal_kamar').modal('hide');
    }

    function open_modal_dokter() {
        $('#modal_petugas').modal('show');
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        $('#hide_unit').val($('[name="radio_unit"]:checked').val());
        $('#hide_indikasi_rawat').val($('#indikasi_rawat').val());
        $('#hide_id_dpjp').val($('#id_dpjp').val());
        $('#hide_dpjp').val($('#dpjp').val());
        $('#hide_id_dokter_pengirim').val($('#id_dokter_pengirim').val());
        $('#hide_dokter_pengirim').val($('#dokter_pengirim').val());
        $('#hide_tgl_rawat_inap').val($('#tgl_rawat_inap').val());
        $('#hide_id_kamar').val($('#id_kamar').val());
        $('#hide_kamar').val($('#kamar').val());
        $('#hide_id_petugas_ranap').val($('#id_petugas_ranap').val());
        $('#hide_petugas_ranap').val($('#petugas_ranap').val());
        $('#hide_tgl_rencana_operasi').val($('#tgl_rencana_operasi').val());
        return true;
    }
</script>
</html>
