@extends('layouts.app')

<div class="modal fade" id="modal_upload_erm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Dokumen ERM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_upload_erm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_erm">
                    <input type="file" required onchange="ValidateSingleInput(this)" id="file_erm" name="dokumen" class="form-control">
                    <div id="msg_upload_erm"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_upload_dokumen_kunjungan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_upload_dokumen_kunjungan" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_dokumen" id="id_upload_dokumen_kunjungan">
                        <div class="form-group">
                            <label for="">File :</label>
                            <input type="file" onchange="ValidateSingleInput(this)" name="dokumen" id="file_dokumen"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Dokumen :</label>
                            <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen">
                        </div>
                        <div id="msg_upload_dokumen_kunjungan"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>E-Rekam Medis</h1>
            </div>

            <div class="section-body">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-5 p-0">
                        <div class="card row pt-3 pb-3" style="margin-left: 0; width:100%;">
                            <div class="col-lg-12">
                                <h5>Pencarian Pasien</h5>
                            </div>
                            <form id="form_patient" class="col-lg-12">
                                <div class="form-group">
                                    <label for="">No. RM</label>
                                    <input type="text" class="form-control" id="nrm">
                                </div>
                                <input type="submit" style="visibility: hidden;">
                                <table style="border-collapse: collapse;">
                                    <tr style="line-height:40px;">
                                        <td class="pl-0">Nama</td>
                                        <td class="pl-2 pr-2"> : </td>
                                        <td id="nama_patient"></td>
                                    </tr>
                                    <tr style="line-height:40px;">
                                        <td class="pl-0">Tgl. Lahir</td>
                                        <td class="pl-2 pr-2"> : </td>
                                        <td id="tgl_lahir_patient"></td>
                                    </tr>
                                    <tr style="line-height:40px;">
                                        <td class="pl-0">Kelamin</td>
                                        <td class="pl-2 pr-2"> : </td>
                                        <td id="kelamin_patient"></td>
                                    </tr>
                                    <tr style="line-height:40px;">
                                        <td class="pl-0">Alamat</td>
                                        <td class="pl-2 pr-2"> : </td>
                                        <td id="alamat_patient"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div class="card row pt-3 pb-3" style="margin-left: 0; width:100%;">
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
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 pr-0">
                        <div id="box_tabel_e_rekam_medis" class="mb-3">
                        </div>

                        <div id="box_tabel_dokumen_kunjungan">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        var baseURL = window.location.href;
        var t = baseURL.substr(0, baseURL.lastIndexOf("/"));
        var l = t.substr(0, t.lastIndexOf("/"));
        
        var noreg_aktif = "";
        var tgl_aktif = "";

        var loading = '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>';

        function loading_func(msg, tipe) {
            return '<div class="spinner-border spinner-border-' + tipe + '" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div> ' +
                msg;
        }

        function convert_slug(param) {
            if (param == '' || param == null) {
                return '';
            }
            let arr = param.split('_');
            for (var i = 0; i < arr.length; i++) {
                arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

            }
            return arr.join(' ');
        }

        function hapus_dokumen_kunjungan(id,tanggal,noreg){
            if (confirm('Yakin melanjutkan hapus dokumen kunjungan ? dokumen yang dihapus tidak dapat dikembalikan')) {
                $.ajax({
                    url : "{{ url('ajax_request/dokumen_kunjungan/delete') }}",
                    data : {
                        dokumen : id
                    },
                    success:function(response){
                        console.log(response);
                        alert(response.message);
                        if (!response.status) {
                            return;
                        }
                        get_dokumen_kunjungan(tanggal,noreg);
                    }
                })
            }
        }

        function render_e_rekam_medis(data) {
            var body = '';
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    var status = data[i].status == 0 ? 'Belum Diverifikasi' : 'Sudah Diverifikasi';
                    var upload = data[i].status == 0 ? '<button  style="display: flex; justify-content:center;" onclick="open_modal_upload_erm(' + "'" + data[i].id +"'" + ')" class="btn btn-warning mr-1"><i class="fas fa-arrow-up pt-1 mr-1"></i> Upload</button>' : '';
                    var download = data[i].status == 0 ? '' :
                        '<a style="display:inline-flex; justify-content:center; align-items:center;" class="btn btn-dark mr-1" target="_blank" href="'+t+'/pendaftaran/download_erm?dokumen=' +
                        data[i].id + '"><i class="fa fa-arrow-down mr-1"></i> Download</a>';
                    body += '<tr>' +
                        '<td class="text-center">' + (i + 1) + '</td>' +
                        '<td class="text-center">' + data[i].nama_dokumen + '</td>' +
                        '<td class="text-center">' + status + '</td>' +
                        '<td class="text-center">' + reformat_tanggal(data[i].tanggal_update) + '</td>' +
                        '<td class="text-center">' + data[i].nama_verifikator + '</td>' +
                        '<td class="text-center"><div style="display:inline-flex;">' + upload + download +
                        '<a class="btn btn-success" target="_blank" href="'+t+'/pendaftaran/'+data[i].nama_dokumen.toLowerCase().replaceAll(' ', '_')+'?dokumen=' + data[i].id + '" style="display:inline-flex; justify-content:center; align-items:center;"><i class="fa fa-eye mr-1"></i> Lihat</a></td></div>' +
                        '</tr>';
                }
            } else {
                body = '<tr class="text-center"><td colspan="6">Data tidak ditemukan</td></tr>';
            }
            var tabel = '<div class="card row pt-3 pb-3" style="width: 100%; margin-left: 0;">' +
                // '<div class="row" style="width: 100%; margin-left: 0;">' +
                // '    <div class="col-lg-8">' +
                // '        <div class="form-group">' +
                // '            <select id="dokumen_erm" class="form-control">' +
                // '                <option value="Asesmen Informasi Pasien Rawat Jalan dan Rawat Inap">Asesmen' +
                // '                    Informasi Pasien Rawat Jalan dan Rawat Inap</option>' +
                // '                <option value="Persetujuan Umum Rawat Jalan">Persetujuan Umum Rawat Jalan' +
                // '                </option>' +
                // '            </select>' +
                // '        </div>' +
                // '    </div>' +
                // '    <div class="col-lg-4" style="padding-top: 4px;">' +
                // '        <button class="btn btn-success" onclick="submit_dokumen_pasien()">Create</button>' +
                // '    </div>' +
                // '</div>' +
                '<div class="col-lg-12">' +
                '<h5>Dokumen Pasien</h5>' +
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
            $('#box_tabel_e_rekam_medis').html(tabel);

        }

        function render_dokumen_kunjungan(data, tanggal, noreg) {
            var body = '';
            var tgl = tanggal.split(' ');
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    var status = data[i].status == 0 ? 'Belum Diverifikasi' : 'Sudah Diverifikasi';
                    var pdf = '';
                    var hapus = '';
                    status = data[i].status == 0 ? 'Belum Diverifikasi' : 'Sudah Diverifikasi';
                    pdf = data[i].status == 0 ? '' :
                        `<a style="display:inline-flex; align-items:center;" target="_blank" href="{{ url('e_rekam_medis/detail') }}/pdf_` +
                        data[i].nama_dokumen.toLowerCase().replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_') + '?dokumen=' + data[i].id +
                        '" class="btn btn-dark mr-1"><i class="fas fa-arrow-down mr-1"></i> Pdf</a>';
                    let ignore_pdf = [
                        'dokumen laporan pembedahan',
                        'laporan anastesi dan sedasi',
                        'asesmen pra anestesi dan sedasi',
                        'rencana keperawatan',
                        'rencana keperawatan pra operasi',
                        'rencana keperawatan intra operasi',
                        'rencana keperawatan post operasi',
                    ];

                    if (ignore_pdf.includes(data[i].nama_dokumen.toLowerCase())) {
                        pdf = '';
                    }

                    if (data[i].nama_dokumen == "Scan Dokumen RM") {
                        nama_dokumen = data[i].nama_dokumen + " - " + data[i].path_dokumen;
                        verifikator = data[i].nama_verifikator;
                        status = data[i].status == 0 ? 'Belum Diverifikasi' : 'Sudah Diverifikasi';
                        pdf = data[i].status ? '<a href="./download_dokumen_kunjungan?dokumen=' + data[i].id +
                        '" target="_blank" class="btn btn-lg btn-success mr-1"><i class="fas fa-arrow-down"></i></a>' : '';
                        lihat = '<button onclick="open_modal_upload_dokumen_kunjungan(' + data[i].id +
                            ')" class="btn btn-lg btn-warning mr-1"><i class="fas fa-arrow-up"></i></button>';
                        hapus = data[i].status == 0 ?
                            '<button style="display:flex; flex-direction:row;" class="btn btn-danger ml-1" onclick="hapus_dokumen_kunjungan(' +"'" + data[i].id + "','" + tanggal + "','" + noreg +"'"+
                            ')"><i class="fas fa-trash pt-1 mr-1"></i> Hapus</button>' : '';
                    } else {
                        lihat = `<a style="display:inline-flex; align-items:center;" target="_blank" href="{{ url('e_rekam_medis/detail') }}/` +convert_slug_nama_dokumen(data[i].nama_dokumen) + '?dokumen=' + data[i].id +'" class="btn btn-success mr-1"><i class="fas fa-pencil-alt mr-1"></i> Lihat</a>';
                        hapus = data[i].status == 0 ?
                            '<button style="display:flex; flex-direction:row;" class="btn btn-danger ml-1" onclick="hapus_dokumen_kunjungan(' +"'" + data[i].id + "','" + tanggal + "','" + noreg +"'"+
                            ')"><i class="fas fa-trash pt-1 mr-1"></i> Hapus</button>' : '';
                    }

                    if (data[i].nama_dokumen == 'Rencana Keperawatan Pra Operasi' || data[i].nama_dokumen == 'Rencana Keperawatan Intra Operasi' || data[i].nama_dokumen == 'Rencana Keperawatan Post Operasi') {
                        lihat = '<a class="btn btn-success" href="./' + convert_slug_nama_dokumen(data[i].nama_dokumen) + '?dokumen=' + data[i].id + '" target="_blank"><i class="fas fa-pencil-alt"></i> Lihat</a>';
                    }

                    body += '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].nama_dokumen+'</td>'+
                        '<td>'+status+'</td>'+
                        '<td>'+data[i].tanggal_update+'</td>'+
                        '<td>'+data[i].nama_verifikator+'</td>'+
                        '<td>'+
                        '<div style="display:flex; flex-direction:row; justify-content:center">'+
                        pdf+
                        // `<a style="display:inline-flex; align-items:center;" target="_blank" href="{{ url('e_rekam_medis/detail') }}/` +data[i].nama_dokumen.toLowerCase().replaceAll(' ', '_').replaceAll('(','').replaceAll(')','').replaceAll('-', '_') + '?dokumen=' + data[i].id +'" class="btn btn-success mr-1"><i class="fas fa-arrow-down mr-1"></i> Lihat</a>'+
                        lihat +
                        hapus +
                        '</div>'+
                        '</td>'+
                        '</tr>';
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
                '<option value="Scan Dokumen RM">Scan Dokumen RM</option>' +
                '<option value="General Consent">General Consent</option>' +
                '<option value="Catatan Edukasi Pasien">Catatan Edukasi Pasien</option>' +
                '<option value="Surat Permintaan Rawat Inap">Surat Permintaan Rawat Inap</option>' +
                '<option value="Dokumen Transfer Pasien Internal">Dokumen Transfer Pasien Internal</option>' +
                '<option value="Dokumen Laporan Caesarian">Dokumen Laporan Caesarian</option>' +
                '<option value="Formulir Triage Terintegrasi">Formulir Triage Terintegrasi</option>' +
                '<option value="Dokumen Asesment Awal Keperawatan IGD">Dokumen Asesment Awal Keperawatan IGD</option>' +
                '<option value="Catatan Perkembangan Pasien Terintegrasi">Catatan Perkembangan Pasien Terintegrasi</option>' +
                '<option value="Dokumen Orientasi Pasien Baru">Dokumen Orientasi Pasien Baru</option>' +
                '<option value="Rencana Keperawatan">Rencana Keperawatan</option>' +
                '<option value="Asesmen Awal Kebidanan Rawat Inap">Asesmen Awal Kebidanan Rawat Inap</option>' +
                '<option value="Resume Medis Pasien Pulang">Resume Medis Pasien Pulang</option>' +
                '<option value="Formulir Asesmen Awal Pasien Rawat Inap Dewasa">Formulir Asesmen Awal Pasien Rawat Inap (Dewasa)</option>' +
                '<option value="Formulir Kriteria Pasien Masuk ICU">Formulir Kriteria Pasien Masuk ICU</option>' +
                '<option value="Formulir Kriteria Pasien Keluar ICU">Formulir Kriteria Pasien Keluar ICU</option>' +
                '<option value="Asesmen Awal Pasien Rawat Inap (Neonatus)">Asesmen Awal Pasien Rawat Inap (Neonatus)</option>' +
                '<option value="Asesment Medis Awal Rawat Jalan">Asesment Medis Awal Rawat Jalan</option>' +
                '<option value="Dokumen Asesment Awal Medis Gawat Darurat">Dokumen Asesment Awal Medis Gawat Darurat</option>' +
                '<option value="Asesmen Pra Anestesi dan Sedasi">Asesmen Pra Anestesi dan Sedasi</option>' +
                '<option value="Checklist Keselamatan Pasien Operasi">Checklist Keselamatan Pasien Operasi</option>' +
                '<option value="Dokumen Laporan Pembedahan">Dokumen Laporan Pembedahan</option>' +
                '<option value="Re-Assesment Resiko Jatuh">Re-Assesment Resiko Jatuh</option>' +
                '<option value="Observasi Cairan">Observasi Cairan</option>' +
                '<option value="Pemantauan Tanda-Tanda Vital">Pemantauan Tanda-Tanda Vital</option>' +
                '<option value="Rencana Keperawatan Pra Operasi">Rencana Keperawatan Pra Operasi</option>' +
                '<option value="Rencana Keperawatan Intra Operasi">Rencana Keperawatan Intra Operasi</option>' +
                '<option value="Rencana Keperawatan Post Operasi">Rencana Keperawatan Post Operasi</option>' +
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

        function convert_slug_nama_dokumen(dokumen){
            if (dokumen == '' || dokumen == null) {
                return '';
            }
            let result = dokumen == 'Catatan Perkembangan Pasien Terintegrasi' || dokumen == 'Catatan Perkembangan Pasien Terintegrasi (CPPT)' ? 'catatan_perkembangan_pasien_terintegrasi_v2' : dokumen.replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_').toLowerCase();
            console.log(result);
            return result;
        }

        function render_table_history(data) {
            console.log(data);
            if ($.fn.DataTable.isDataTable("#tabel_riwayat")) {
                $('#tabel_riwayat').DataTable().clear().destroy();
            }

            $('#list_riwayat').html(history);
            $('#tabel_riwayat').DataTable({
                "pageLength": 5,
                "bLengthChange": false,
                "searching": false,
                "order": [
                    [0, 'desc']
                ],
                "pagingType" : 'simple',
                "data": data,
                columns: [{
                        data: 'tanggal',
                        name: 'tanggal',
                        render: function(data, type, row) {
                            if (type === "sort" || type === 'type') {
                                return data;
                            }
                            return '<a href="#" style="text-decoration:none; color:#111;" onclick="get_dokumen_kunjungan(' +
                                "'" + data + "','" + row.id + "'" + ')">' + reformat_tanggal(data) +
                                '</a>';
                        }
                    },
                    {
                        data: 'jenislayanan',
                        name: 'jenislayanan',
                        render: function(data, type, row) {
                            return convert_slug(data);
                        }
                    }, //or { data: 'MONTH', title: 'Month' }`
                    {
                        data: 'diagnosa',
                        name: 'ruangan',
                        render: function(data, type, row) {
                            return convert_slug(data && data.ruangan ? data.ruangan : '-');
                        }
                    },
                    {
                        data: 'diagnosa',
                        name: 'diagnosa',
                        render: function(data, type, row) {
                            return convert_slug(data && data.diagnosa ? data.diagnosa : '-');
                        }
                    },
                ]
            });
        }

        function get_dokumen_kunjungan(param, noreg) {
            console.log(noreg);
            noreg_aktif = noreg;
            tgl_aktif = param;
            window.event.preventDefault();
            $('#box_tabel_dokumen_kunjungan').html(loading);
            $.ajax({
                url: "{{ url('ajax_request/dokumen_kunjungan') }}",
                data: {
                    nrm: $('#nrm').val(),
                    noreg: noreg,
                    tanggal: param
                },
                success: function(response) {
                    render_dokumen_kunjungan(response, param, noreg);
                }
            })
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

        function get_data_e_rekam_medis() {
            $.ajax({
                url: '{{ url('ajax_request/e_rekam_medis') }}',
                data: {
                    nrm: $('#nrm').val(),
                },
                success: function(response) {
                    render_e_rekam_medis(response);
                }
            })
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

        $('#form_patient').submit(function(e) {
            e.preventDefault();
            if ($('#nrm').val() == '') {
                alert('Nomor rekam medis harus diisi');
                return;
            }
            $('#nama_patient').html(loading);
            $('#tgl_lahir_patient').html(loading);
            $('#kelamin_patient').html(loading);
            $('#alamat_patient').html(loading);
            $('#list_riwayat').html('<tr class="text-center"><td colspan="4">' + loading + '</td></tr>');
            $('#box_tabel_e_rekam_medis').html(loading);
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
                        get_data_e_rekam_medis();
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
        })

        function submit_dokumen_pasien() {
            if (confirm('Yakin membuat dokumen ' + $('#dokumen_erm').val() + ' ?')) {
                var doc = $('#dokumen_erm').val();
                console.log(doc);
                $('#box_tabel_e_rekam_medis').html(loading);
                try {
                    $.ajax({
                        url: "{{ url('ajax_request/create_dokumen_erm') }}",
                        method: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            dokumen: doc,
                            nrm: $("#nrm").val()
                        },
                        success: function(response) {
                            if (response.status) {
                                alert(response.message);
                                $("#nrm").submit();
                            } else {
                                alert(response.message);
                            }
                        }
                    })
                } catch (error) {
                    alert(error);
                }
            }
        }

        function open_modal_upload_erm(id) {
            $('#msg_upload_erm').html('');
            $('#id_erm').val(id);
            $("#file_erm").val(null);
            $('#modal_upload_erm').modal('show');
        }

        function open_modal_upload_dokumen_kunjungan(param) {
            $('#msg_upload_dokumen_kunjungan').html('');
            $('#id_upload_dokumen_kunjungan').val(param);
            $('#modal_upload_dokumen_kunjungan').modal('show');
        }

        $('#form_upload_dokumen_kunjungan').submit(function(e) {
            e.preventDefault();
            $('#msg_upload_dokumen_kunjungan').html('<div class="alert alert-info">'+loading_func('Sedang upload dokumen...', 'sm')+'</div>');
            var data = new FormData(this);
            $.ajax({
                url: "{{ url('e_rekam_medis/upload_dokumen_kunjungan') }}",
                method: 'post',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success: function(response) {
                    if (!response.status) {
                        $('#msg_upload_dokumen_kunjungan').html('<div class="alert alert-danger">'+response.message+'</div>');
                        return;
                    }
                    $('#form_upload_dokumen_kunjungan')[0].reset();
                    $('#modal_upload_dokumen_kunjungan').modal('hide');
                    get_dokumen_kunjungan(tgl_aktif, noreg_aktif);
                }
            })
        })

        var _validFileExtensions = [".pdf"];

        function ValidateSingleInput(oInput) {
            if (oInput.type == "file") {
                var sFileName = oInput.value;
                if (sFileName.length > 0) {
                    var blnValid = false;
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() ==
                            sCurExtension.toLowerCase()) {
                            blnValid = true;
                            $('#nama_dokumen').val(sFileName.split('\\').pop().split('.').slice(0, -1).join('.'));
                            break;
                        }
                    }

                    if (!blnValid) {
                        alert("Maaf file yang anda tambahkan tidak sesuai, tipe file harus: " + _validFileExtensions.join(
                            ", "));
                        oInput.value = "";
                        return false;
                    }
                }
            }
            return true;
        }

        $('#form_upload_erm').submit(function(e) {
            window.event.preventDefault();
            $('#msg_upload_erm').html('<div class="alert alert-info">'+loading+ ' Sedang upload dokumen...</div>');
            var data = new FormData(this);
            $.ajax({
                url: "{{ url('e_rekam_medis/rekam_medis/upload_dokumen_erm') }}",
                method: 'post',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success: function(response) {
                    if (!response.status) {
                        $('#msg_upload_erm').html('<div class="alert alert-danger">'+response.message+'</div>');
                        return;
                    }
                    $('#modal_upload_erm').modal('hide');
                    get_data_e_rekam_medis();
                }
            })
        })
    </script>
@endpush
