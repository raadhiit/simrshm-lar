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
    @include('erm.riwayat_rm')
    <section class="section">
        <div class="section-header">
            <h1>E-Rekam Medis Rawat Jalan</h1>
        </div>

        <div class="section-body">
            @if (Session::has('sukses'))
            <div class="alert alert-success">{{ Session::get('sukses') }}</div>
            @endif
            @if (Session::has('gagal'))
            <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
            @endif
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-lg-5 pl-0">
                    <div class="card p-3">
                        <p style="font-size: 18px; font-weight: bold;">Data Pasien</p>
                        <div class="form-group">
                            <label for="">No. RM</label>
                            <input type="text" readonly value="{{ $patient->id }}" class="form-control">
                        </div>
                        <table id="tabel_data_diri" style="border-collapse: collapse">
                            <tr>
                                <td style="width: 20%;">Nama</td>
                                <td style="width: 5%"> : </td>
                                <td style="width: 75%">{{ $patient->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tgl. Lahir</td>
                                <td> : </td>
                                <td>{{ date('d-m-Y', strtotime($patient->tgl_lahir)) }}</td>
                            </tr>
                            <tr>
                                <td>Kelamin</td>
                                <td> : </td>
                                <td>{{ $patient->kelamin ? 'Perempuan' : 'Laki-Laki' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td> : </td>
                                <td>{{ $patient->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row d-flex-inline pb-2" style="width: 100%; margin-left: 0;">
                        <button class="btn btn-primary" id="btn_riwayat_lab">Riwayat Laboratorium</button>
                        <button class="btn btn-info ml-2" id="btn_riwayat_rad">Riwayat Radiologi</button>
                        <button class="btn btn-success ml-2" id="btn_riwayat_rm">Riwayat RM</button>
                    </div>
                    <div class="card p-3 table-responsive">
                        <p style="font-size: 18px; font-weight: bold;">Riwayat Kunjungan</p>
                        <table id="tabel_history" class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Tgl. Kunjungan</th>
                                    <th>Jenis</th>
                                    <th>Ruangan</th>
                                    <th>Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($history) < 1) <tr class="text-center">
                                    <th colspan="4">Tidak ada data kunjungan.</th>
                                    </tr>
                                    @else
                                    @foreach ($history as $hi)
                                    <tr>
                                        <td class="pt-1 pb-1"><a style="text-decoration:none; color:#111;" href="" onclick="get_dokumen_kunjungan('{{ $hi->id }}')">{{ date('d-m-Y H:i', strtotime($hi->tanggal)) }}</a>
                                        </td>
                                        <td class="pt-1 pb-1">
                                            {{ ucwords(str_replace('_', ' ', $hi->jenislayanan)) }}
                                        </td>
                                        <td class="pt-1 pb-1">{{ ucwords(str_replace('_', ' ', $hi->ruangan)) }}
                                        </td>
                                        <td class="pt-1 pb-1">{{ $hi->diagnosa }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7 pr-0">
                    <div id="box_dokumen_kunjungan"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
@include('erm.script_riwayat_laboratorium')
@include('erm.script_riwayat_radiologi')
<script>
    var sts_observasi_keperawatan = 0;
    var sts_program_pelayanan_fisioterapi = 0;
    const list_docs = [
        "Surat Permintaan Rawat Inap",
        "Dokumen Transfer Pasien Internal",
        "Dokumen Laporan Caesarian",
        "Formulir Triage Terintegrasi",
        // "Catatan Perkembangan Pasien Terintegrasi",
        "Checklist Keselamatan Pasien Operasi",
        "Dokumen Laporan Pembedahan",
        "Surat Pengantar Persiapan Tindakan Operasi",
        "Formulir Penandaan Lokasi Operasi",
        "Laporan Anastesi Dan Sedasi",
        "Formulir Kriteria Pasien Masuk ICU",
        "Dokumen Partograf",
        "Asesmen Pra Anestesi Dan Sedasi",
        "Dokumen Asesment Awal Keperawatan IGD",
        "Penolakan Rawat Inap",
        "Catatan Perkembangan Pasien Terintegrasi (CPPT)",
        "Observasi Keperawatan (IGD)",
        "Indikator SC",
        "Lembar Konsultasi",
        "Surat Kontrol",
        "Persetujuan atau Penolakan Tindakan Bedah",
        'Persetujuan atau Penolakan Transfusi Darah',
        'Tindakan Anestesi Spinal atau Epidural',
        'Persetujuan atau Penolakan Tindakan Kedokteran',
        'Catatan Edukasi Pasien',
        'Daftar Pemberian Obat',
        'Daftar Tilik Pasien Operasi',
        'Assesment Perioperatif Medis',
        'Observasi Cairan',
        'Surat Pernyataan Pulang APS',
        'Formulir Serah Terima Jenazah',
        'Surat Keterangan Kematian',
        'Lembar Pemantauan Fibrinolitik',
        'Lembar Penolakan DNR',
        'Asesmen Pasien Terminal',
        'Survei Infeksi Rumah Sakit',
        'Dokumentasi Informasi Tindakan Anestesi Umum atau Sedasi',
        'Bukti Pendaftaran Rawat Jalan',
        'Formulir Triage Terintegrasi V2',
        'Formulir Layanan Kedokteran Fisik dan Rehabilitasi',
        'Lembar Hasil Tindakan Uji Fungsi',
        'Program Pelayanan Fisioterapi',
        'Formulir Klaim Fisioterapi',
        'Rencana Keperawatan Pra Operasi',
        'Rencana Keperawatan Intra Operasi',
        'Rencana Keperawatan Post Operasi',
        'Form Pemantauan Reaksi Transfusi Darah'
    ];

    const ignore_pdf = [
        'dokumen laporan pembedahan',
        'laporan anastesi dan sedasi',
        'asesmen pra anestesi dan sedasi',
        'rencana keperawatan',
        'penolan rawat inap',
        'observasi keperawatan (igd)',
        'lembar hasil tindakan uji fungsi',
        'program pelayanan fisioterapi',
        'formulir klaim fisioterapi',
        'rencana keperawatan pra operasi',
        'rencana keperawatan intra operasi',
        'rencana keperawatan post operasi',
    ];

    function loading(msg, tipe) {
        return '<div class="spinner-border spinner-border-' + tipe + '" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' +
            msg;
    }

    function get_dokumen_kunjungan(noreg) {
        window.event.preventDefault();
        $('#box_dokumen_kunjungan').html(loading('', 'sm'));
        var baseURL = window.location.href;
        var t = baseURL.substr(0, baseURL.lastIndexOf("/"));
        var l = t.substr(0, t.lastIndexOf("/"));
        $.ajax({
            url: "{{ url('ajax_request/dokumen_kunjungan_rajal') }}",
            data: {
                noreg: noreg
            },
            success: function(response) {
                console.log(response);
                var ins = '';
                if (response.dokumen.length < 1) {
                    ins += '<tr>' +
                        '<td colspan="7" class="text-center">Data tidak ditemukan</td>' +
                        '</tr>';
                } else {
                    var no = 1;
                    for (let i = 0; i < response.dokumen.length; i++) {

                        if (list_docs.includes(response.dokumen[i].nama_dokumen)) {
                            let pdf = '';

                            if (!ignore_pdf.includes(response.dokumen[i].nama_dokumen.toLowerCase())) {
                                pdf = response.dokumen[i].status ? '<a class="btn btn-dark mr-1" href="' + l + '/detail/pdf_' + response.dokumen[i].nama_dokumen.replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_').toLowerCase() + '?dokumen=' + response.dokumen[i].id + '" target="_blank"><i class="fas fa-arrow-down"></i></a>' : '';
                            }

                            if (response.dokumen[i].nama_dokumen == "Program Pelayanan Fisioterapi") {
                                if (!response.dokumen2) {
                                    sts_program_pelayanan_fisioterapi == 1;
                                }
                            }

                            var lihat = '<a class="btn btn-primary" href="' + l + '/detail/' + convert_slug_nama_dokumen(response.dokumen[i].nama_dokumen) + '?dokumen=' + response.dokumen[i].id + '" target="_blank"><i class="fas fa-pencil-alt"></i></a>';

                            if (
                                response.dokumen[i].nama_dokumen == 'Rencana Keperawatan Pra Operasi' || 
                                response.dokumen[i].nama_dokumen == 'Rencana Keperawatan Intra Operasi' || 
                                response.dokumen[i].nama_dokumen == 'Rencana Keperawatan Post Operasi' ||
                                response.dokumen[i].nama_dokumen == 'Form Pemantauan Reaksi Transfusi Darah'
                            ) {
                                lihat = '<a class="btn btn-primary" href="' + l + '/' + convert_slug_nama_dokumen(response.dokumen[i].nama_dokumen) + '?dokumen=' + response.dokumen[i].id + '" target="_blank"><i class="fas fa-pencil-alt"></i></a>';
                            }

                            ins += '<tr>' +
                                '<td class="text-center">' + no + '</td>' +
                                '<td>' + response.dokumen[i].nama_dokumen + '</td>' +
                                '<td class="text-center">' + (response.dokumen[i].status ?
                                    'Sudah diverifikasi' :
                                    'Belum diverifikasi') + '</td>' +
                                '<td class="text-center">' + tanggal_dmy(response.dokumen[i].tanggal_update) +
                                '</td>' +
                                '<td>' + response.dokumen[i].nama_verifikator + '</td>' +
                                '<td class="text-center">' +
                                '<div style="display:flex; flex-direction:row;">' +
                                pdf +
                                lihat +
                                '</div>' +
                                '</td>' +
                                '</tr>';
                            no++;
                        }
                    }

                    if (response.dokumen2 != null) {
                        let pdf = '';

                        ins += '<tr>' +
                            '<td class="text-center">' + no + '</td>' +
                            '<td>' + response.dokumen2.nama_dokumen + '</td>' +
                            '<td class="text-center">' + (response.dokumen2.status ?
                                'Sudah diverifikasi' :
                                'Belum diverifikasi') + '</td>' +
                            '<td class="text-center">' + tanggal_dmy(response.dokumen2.tanggal_update) +
                            '</td>' +
                            '<td>' + response.dokumen2.nama_verifikator + '</td>' +
                            '<td class="text-center">' +
                            '<div style="display:flex; flex-direction:row;">' +
                            pdf +
                            '<a class="btn btn-primary" href="' + l + '/detail/' + convert_slug_nama_dokumen(response.dokumen2.nama_dokumen) + '?dokumen=' + response.dokumen2
                            .id + '&noreg=' + noreg + '" target="_blank"><i class="fas fa-pencil-alt"></i></a>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';

                        no++;
                        sts_program_pelayanan_fisioterapi == 1;
                    }
                }
                render_dokumen_kunjungan(ins, response.layanan);
            }
        })
    }

    function convert_slug_nama_dokumen(dokumen) {
        if (dokumen == '' || dokumen == null) {
            return '';
        }
        let result = dokumen == 'Catatan Perkembangan Pasien Terintegrasi (CPPT)' ? 'catatan_perkembangan_pasien_terintegrasi_v2' : dokumen.replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_').toLowerCase();
        return result;
    }

    function render_dokumen_kunjungan(body, layanan) {
        const options = list_docs.map(doc => '<option value="' + doc + '">' + doc + '</option>')

        var ins = '<div class="card p-3">' +
            '<p style="font-weight:bold; font-size:18px;">Dokumen Kunjungan ' + tanggal_dmy(layanan.tanggal) + '</p>' +
            '<form class="row" id="form_dokumen_kunjungan" onsubmit="create_dokumen_kunjungan()" style="display:flex; flex-direaction:row">' +
            '<div class="col-lg-12" id="loading_form_dokumen_kunjungan">' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<input type="hidden" name="noreg" value="' + layanan.id + '"/>' +
            '<input type="hidden" name="_token" value="{{ csrf_token() }}"/>' +
            '<select name="jenis_dokumen" class="form-control">' +
            options +
            '</select>' +
            '</div>' +
            '<div class="col-lg-6 pt-1">' +
            '<button class="btn btn-success" type="submit">Create</button>' +
            '</div>' +
            '</form>' +
            '<div class="table-responsive pt-3">' +
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
        $('#box_dokumen_kunjungan').html(ins);
        $('[name=jenis_dokumen]').select2();
    }

    function tanggal_dmy(tanggal) {
        if (tanggal == null || tanggal == '') {
            return '';
        }

        if (tanggal.includes(' ')) {
            var tgl = tanggal.split(' ');
            var temp = tgl[0].split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        } else {
            var temp = tanggal.split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        }
    }

    function tanggal_dmyhi(tanggal) {
        if (tanggal == null || tanggal == '') {
            return '';
        }
        var tgl = tanggal.split(' ');
        var temp = tgl[0].split('-');
        var temp_jam = tgl[1].split('-');
        return temp[2] + '-' + temp[1] + '-' + temp[0] + ' ' + temp_jam[0] + ':' + temp_jam[1];
    }

    function create_dokumen_kunjungan() {
        window.event.preventDefault();
        if (sts_observasi_keperawatan == 1 && $('#jenis_dokumen').val() == "Observasi Keperawatan (IGD)") {
            alert("Dokumen Observasi Keperawatan Telah Dibuat");
        } else if (sts_program_pelayanan_fisioterapi == 1 && $('#jenis_dokumen').val() == "Program Pelayanan Fisioterapi") {
            alert("Program Pelayanan Fisioterapi Telah Dibuat");
        } else {
            $('#loading_form_dokumen_kunjungan').html('<div class="alert alert-info">' + loading(
                'Sedang membuat dokumen, harap tunggu...', 'sm') + '</div>');
            $.ajax({
                url: "{{ url('e_rekam_medis/rawat_jalan/ajax_create_dokumen_kunjungan') }}",
                data: $('#form_dokumen_kunjungan').serialize(),
                method: 'post',
                success: function(response) {
                    console.log(response);
                    if (!response.status) {
                        $('#loading_form_dokumen_kunjungan').html('<div class="alert alert-danger">' + response
                            .message + '</div>');
                        return;
                    }
                    $('#loading_form_dokumen_kunjungan').html('<div class="alert alert-success">' + response
                        .message + '</div>');
                    get_dokumen_kunjungan(response.data.noreg);
                }
            })
        }
    }
</script>
@endpush