@extends('layouts.app')
@section('content')
<style>
    #tabel_data_diri tr {
        line-height: 2.5;
    }
</style>
<div class="main-content">
    @include('erm.riwayat_laboratorium')
    @include('erm.riwayat_radiologi')
    <section class="section">
        <div class="section-header">
            <h1>E-Rekam Medis Pendaftaran</h1>
        </div>
        @if (Session::has('success'))
        <div class="alert alert-success text-center">
            {{ Session::get('success') }}
        </div>
        @endif
        @if (Session::has('failed'))
        <div class="alert alert-danger text-center">
            {{ Session::get('failed') }}
        </div>
        @endif
        <div class="section-body">
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-lg-5 pl-0">
                    <div class="card row p-3">
                        <p style="font-size: 18px; font-weight: bold;">Data Pasien</p>
                        <div class="form-group">
                            <label for="">No. RM</label>
                            <input type="text" readonly value="{{ $pasien->id }}" id="nrm" class="form-control">
                        </div>
                        @if ($pasien)
                        <table id="tabel_data_diri" style="border-collapse: collapse">
                            <tr>
                                <td style="width: 20%;">Nama</td>
                                <td style="width: 5%"> : </td>
                                <td style="width: 75%">{{ $pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tgl. Lahir</td>
                                <td> : </td>
                                <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                            </tr>
                            <tr>
                                <td>Kelamin</td>
                                <td> : </td>
                                <td>{{ $pasien->kelamin ? 'Perempuan' : 'Laki-Laki' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td> : </td>
                                <td>{{ $pasien->alamat }}</td>
                            </tr>
                        </table>
                        @endif
                    </div>
                    <div class="row d-flex-inline pb-2" style="width: 100%; margin-left: 0;">
                        <button class="btn btn-primary" id="btn_riwayat_lab">Riwayat Laboratorium</button>
                        <button class="btn btn-info ml-2" id="btn_riwayat_rad">Riwayat Radiologi</button>
                    </div>
                    <div class="card row pt-3">
                        <div class="col-lg-12">
                            <h5>Riwayat Kunjungan</h5>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-striped" id="tabel_riwayat" style="font-size:12px;">
                                <thead>
                                    <tr>
                                        <th>Tgl. Kunjungan</th>
                                        <th>Jenis</th>
                                        <th>Ruangan</th>
                                        <th>Diagnosa</th>
                                    </tr>
                                </thead>
                                <tbody id="list_riwayat">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 pr-0">
                    <div class="card row pt-3 pb-3" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12">
                            <h5>Dokumen Pasien</h5>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Dokumen</th>
                                        <th>Status</th>
                                        <th>Tanggal Update</th>
                                        <th>Verifikator</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dokumen)
                                    <tr>
                                        <td class="text-center">1.</td>
                                        <td>{{ $dokumen->nama_dokumen }}</td>
                                        <td>{{ $dokumen->status ? 'Sudah diverifikasi' : 'Belum diverifikasi' }}
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($dokumen->tanggal_update)) }}</td>
                                        <td>{{ $dokumen->nama_verifikator }}</td>
                                        <td class="text-center">
                                            <div style="display: flex; flex-direction: row">
                                                @if ($dokumen->status == 1)
                                                <a href="{{ url('e_rekam_medis/pendaftaran/detail/pdf_identitas?dokumen=' . $dokumen->id) }}" target="_blank" class="btn btn-dark mr-1"><i class="fas fa-arrow-down"></i></a>
                                                @endif
                                                <a href="{{ url('e_rekam_medis/pendaftaran/detail/show_dokumen?dokumen=' . $dokumen->id) }}" target="_blank" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card row pt-3 pb-3" style="width: 100%; margin-left: 0;" id="box_tabel_dokumen_kunjungan">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
@include('erm.script_riwayat_laboratorium')
@include('erm.script_riwayat_radiologi')
<script>
    var loading = '<div class="spinner-border spinner-border-sm" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div>';

    var baseURL = window.location.href;
    var t = baseURL.substr(0, baseURL.lastIndexOf("/"));
    var l = t.substr(0, t.lastIndexOf("/"));

    const list_docs = [
        'General Consent',
        'Catatan Edukasi Pasien',
        'Surat Permintaan Rawat Inap',
        'Surat Pernyataan Penitipan Kelas',
        "Surat Pernyataan Naik Kelas",
        'Bukti Pendaftaran Rawat Inap',
        'Bukti Pendaftaran Rawat Jalan',
        'Tata Tertib dan Peraturan Pelayanan Rawat Inap',
        'Surat Kontrol',
        'Formulir Surat Pernyataan Rawat Inap',
    ];

    const ignore_pdf_docs = [
        'Surat Permintaan Rawat Inap',
        'Surat Pernyataan Penitipan Kelas',
        'Surat Pernyataan Naik Kelas',
        'Bukti Pendaftaran Rawat Inap',
        'Tata Tertib Dan Peraturan Pelayanan Rawat Inap',
        'Bukti Pendaftaran Rawat Jalan',
        'Formulir Surat Pernyataan Rawat Inap',
        'Surat Pernyataan Penitipan Kelas',
        'Surat Pernyataan Naik Kelas'
    ];

    const display_pdf_docs = [
        'General Consent',
        'Catatan Edukasi Pasien',
        'Surat Pernyataan Penitipan Kelas'
    ];

    $(document).ready(function() {
        request_riwayat_kunjungan();
    });

    function request_riwayat_kunjungan() {
        $.ajax({
            url: "{{ url('ajax_request/patient_and_history_by_nrm') }}",
            data: {
                nrm: $('#nrm').val()
            },
            success: function(response) {
                console.log(response);
                if (response.patient != null) {
                    $('#nama_patient').html(response.patient.nama);
                    $('#tgl_lahir_patient').html(reformat_tanggal(response.patient.tgl_lahir));
                    $('#kelamin_patient').html(response.patient.kelamin == 0 ? 'LAKI-LAKI' :
                        'PEREMPUAN');
                    $('#alamat_patient').html(response.patient.alamat);
                    // get_data_e_rekam_medis();
                } else {
                    $('#nama_patient').html('');
                    $('#tgl_lahir_patient').html('');
                    $('#kelamin_patient').html('');
                    $('#alamat_patient').html('');
                    $('#list_riwayat').html('');
                    $('#box_tabel_e_rekam_medis').html('');
                }
                $('#box_tabel_dokumen_kunjungan').html('');
                render_table_history(response.history);
            }
        });
    }

    function render_table_history(data) {
        if ($.fn.DataTable.isDataTable("#tabel_riwayat")) {
            $('#tabel_riwayat').DataTable().clear().destroy();
        }
        var history = '';
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                history += '<tr>' +
                    '<td><a style="text-decoration:none; color:#111;" href="" onclick="get_dokumen_kunjungan(' + "'" +
                    data[i].tanggal + "','" + data[i].id + "'" + ')">' + reformat_tanggal(data[i].tanggal) +
                    '</a></td>' +
                    '<td>' + convert_slug(data[i].jenislayanan) + '</td>' +
                    '<td>' + convert_slug(data[i].ruangan) + '</td>' +
                    '<td>' + data[i].diagnosa + '</td>' +
                    '</tr>';
            }
        } else {
            history = '<tr class="text-center"><td colspan="4">Tidak ada riwayat</td></tr>';
        }
        $('#list_riwayat').html(history);
        $('#tabel_riwayat').DataTable({
            "pageLength": 5,
            "bLengthChange": false,
            "searching": false
        });
    }

    function reformat_tanggal(tanggal) {
        if (tanggal == '' || tanggal == null) {
            return '';
        }
        var temp = [];
        var jam = [];
        if (tanggal.includes(' ')) {
            var tgl = tanggal.split(' ');
            temp = tgl[0].split('-');
            jam = tgl[1].split(':');
            return temp[2] + '-' + temp[1] + '-' + temp[0] + ' ' + jam[0] + ':' + jam[1];
        } else {
            temp = tanggal.split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        }
    }

    function get_dokumen_kunjungan(param, noreg) {
        console.log(noreg);
        window.event.preventDefault();
        $('#box_tabel_dokumen_kunjungan').html(loading);
        $.ajax({
            url: "{{ url('ajax_request/dokumen_kunjungan') }}",
            data: {
                nrm: $('#nrm').val(),
                profile: $('#profile').val(),
                noreg: noreg,
                tanggal: param
            },
            success: function(response) {
                render_dokumen_kunjungan(response, param, noreg);
            }
        })
    }

    function render_dokumen_kunjungan(data, tanggal, noreg) {
        var body = '';
        var tgl = tanggal.split(' ');

        const options = list_docs.map(doc => `<option value="${doc}">${doc}</option>`).join('');

        var no = 1;
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                if (list_docs.includes(data[i].nama_dokumen)) {
                    let verifikator = data[i].status === 0 ? data[i].nama_verifikator : '';
                    let status = data[i].status === 0 ? 'Belum Diverifikasi' : 'Sudah Diverifikasi';
                    let pdf = '';

                    if (
                        list_docs.indexOf(data[i].nama_dokumen) >= 0 ||
                        list_docs.includes(data[i].nama_dokumen)
                    ) {
                        verifikator = data[i].nama_verifikator;
                        status = data[i].status == 0 ? 'Belum Diverifikasi' : 'Sudah Diverifikasi';
                        // pdf = data[i].status == 0 ? '' :
                        if (!ignore_pdf_docs.includes(data[i].nama_dokumen)) {
                            pdf = data[i].status === 0 ? '' :
                                '<a style="display:inline-flex; align-items:center;" target="_blank" href="' + l +
                                '/detail/pdf_' +
                                data[i].nama_dokumen.toLowerCase().replaceAll(' ', '_') + '?dokumen=' + data[i].id +
                                '" class="btn btn-dark mr-1"><i class="fas fa-arrow-down mr-1"></i> Pdf</a>';
                        }

                        body += '<tr>' +
                            '<td class="text-center">' + no + '</td>' +
                            '<td class="text-center">' + data[i].nama_dokumen + '</td>' +
                            '<td class="text-center">' + status + '</td>' +
                            '<td class="text-center">' + reformat_tanggal(data[i].tanggal_update) + '</td>' +
                            '<td class="text-center">' + verifikator + '</td>' +
                            '<td class="text-center">' +
                            '<div style="display:inline-flex;">' +
                            pdf +
                            '<a class="btn btn-success" href="' + l + '/detail/' + data[i].nama_dokumen.toLowerCase()
                            .replaceAll(
                                ' ', '_') + '?dokumen=' + data[i].id +
                            '" style="display:inline-flex; align-items:center;" target="_blank"><i class="fas fa-eye mr-1"></i> Lihat</a>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                        no++;
                    }
                }
            }
        } else {
            body = '<tr class="text-center"><td colspan="6">Data tidak ditemukan</td></tr>';
        }
        var tabel = '<div class="card row pt-3 pb-3" style="width: 100%; margin-left: 0;">' +
            '<div class="col-lg-12">' +
            '<h5>Dokumen Kunjungan ' + reformat_tanggal(tgl[0]) + '</h5>' +
            '</div>' +
            '<div class="row pb-3" style="width:100%; margin-left:0;">' +
            '<div class="col-lg-6">' +
            '<select class="form-control" id="jenis">' +
            options +
            '</select>' +
            '</div>' +
            '<div class="col-lg-6" style="padding-top:3px">' +
            '<button class="btn btn-success" onclick="create_dokumen(' + "'" + tanggal + "','" + noreg + "'" +
            ')">Create</button>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-12 table-responsive">' +
            '<table class="table table-striped">' +
            '<thead>' +
            '<tr class="text-center">' +
            '<th>No</th>' +
            '<th>Nama Dokumen</th>' +
            '<th>Status</th>' +
            '<th>Tanggal Update</th>' +
            '<th>Verifikator</th>' +
            '<th>Action</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            body +
            '</tbody>' +
            '</table>' +
            '</div>' +
            '</div>';
        $('#box_tabel_dokumen_kunjungan').html(tabel);

    }

    function create_dokumen(tanggal, noreg) {
        if (confirm('Yakin membuat dokumen ' + $('#jenis').val() + ' ?')) {
            try {
                $.ajax({
                    url: "{{ url('ajax_request/create_dokumen_kunjungan') }}",
                    method: 'post',
                    data: {
                        jenis: $('#jenis').val(),
                        noreg: noreg,
                        tanggal: tanggal,
                        _token: "{{ csrf_token() }}",
                        nrm: $('#nrm').val()
                    },
                    success: function(response) {
                        if (response.status) {
                            alert(response.message);
                            get_dokumen_kunjungan(tanggal, noreg);
                        } else {
                            console.log(response);
                            alert(response.message);
                        }
                    }
                })
            } catch (error) {
                alert(error);
            }
        }
    }

    function convert_slug(param) {
        if (param == '' || param == null) {
            return '';
        }
        arr = param.split('_');
        for (var i = 0; i < arr.length; i++) {
            arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

        }
        return arr.join(' ');
    }
</script>
@endpush
@endsection