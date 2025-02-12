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
            <h1>E-Rekam Medis Rawat Inap</h1>
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
                                        <td class="pt-1 pb-1"><a style="text-decoration:none; color:#111;" href="#" onclick="get_dokumen_kunjungan('{{ $hi->id }}')">{{ date('d-m-Y H:i',
                                                strtotime($hi->tanggal)) }}</a>
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
    // add new docs here only for simpler logic
    const list_docs = [
        "Dokumen Orientasi Pasien Baru",
        // "Catatan Perkembangan Pasien Terintegrasi",
        "Rencana Keperawatan",
        "Assesment Ulang Nyeri dan Intervensi",
        "Asesmen Pra Anestesi dan Sedasi",
        "Re-Assesment Resiko Jatuh",
        "Dokumen Orientasi Pasien Baru",
        "Dokumen Transfer Pasien Internal",
        "Asesmen Awal Kebidanan Rawat Inap",
        "Catatan Perkembangan Pasien Terintegrasi (CPPT)",
        "Resume Medis Pasien Pulang",
        "Formulir Asesmen Awal Pasien Rawat Inap Dewasa",
        "Rencana Keperawatan",
        "Daftar Tilik Pasien Operasi",
        "Assesment Perioperatif Medis",
        "Formulir Kriteria Pasien Masuk ICU",
        "Formulir Kriteria Pasien Keluar ICU",
        "Early Warning Scoring System (Dewasa)",
        "Asesmen Awal Pasien Rawat Inap (Neonatus)",
        "Asesmen Awal Pasien Rawat Inap (Pediatrik)",
        "Penolakan Rawat Inap",
        "Observasi Cairan",
        "Checklist Keselamatan Pasien Operasi",
        "Dokumen Laporan Pembedahan",
        "Surat Pengantar Persiapan Tindakan Operasi",
        "Observasi Bayi",
        "Asesmen Awal Keperawatan Geriatri",
        "Formulir Penandaan Lokasi Operasi",
        "Laporan Anastesi Dan Sedasi",
        "Pemantauan Tanda-Tanda Vital",
        "Dokumen Laporan Caesarian",
        "Dokumen Partograf",
        "Indikator SC",
        "Surat Pernyataan Pulang APS",
        "Permintaan Pemeriksaan Patologi Anatomi",
        "Surat Permintaan Rawat Inap",
        "Formulir Serah Terima Jenazah",
        "Observasi Keperawatan Rawat Inap",
        "Formulir Serah Terima Bayi",
        "Lembar Konsultasi",
        "Surat Keterangan Kematian",
        "Lembar Pemantauan Fibrinolitik",
        "Surat Kontrol",
        "Lembar Penolakan DNR",
        "Daftar Kontrol Istimewa Pasien DM",
        "Persetujuan atau Penolakan Tindakan Bedah",
        "Serah Terima Bayi Rawat Gabung",
        "Asesmen Pasien Terminal",
        'Dokumentasi Informasi Tindakan Anestesi Umum atau Sedasi',
        'Persetujuan atau Penolakan Transfusi Darah',
        'Tindakan Anestesi Spinal atau Epidural',
        'Daftar Pemberian Obat',
        'Persetujuan atau Penolakan Tindakan Kedokteran',
        'Survei Infeksi Rumah Sakit',
        'Skala Risiko Jatuh Humpty Dumpty untuk Pediatri',
        'Catatan Edukasi Pasien',
        'Dokumen Asesment Awal Medis Gawat Darurat',
        'Bukti Pendaftaran Rawat Inap',
        'Formulir Skrining Awal Gizi Dewasa',
        'Formulir Skrining Awal Gizi Anak',
        'Formulir Triage Terintegrasi V2',
        'Lembar Hasil Tindakan Uji Fungsi',
        'Rekonsiliasi Obat',
        'Rencana Keperawatan Pra Operasi',
        'Rencana Keperawatan Intra Operasi',
        'Rencana Keperawatan Post Operasi',
        "Surat Kontrol Rawat Inap",
        'Skrining Gizi Rawat Inap',
        'Form Pemantauan Reaksi Transfusi Darah'
    ];

    const ignore_pdf = [
        'dokumen laporan pembedahan',
        'laporan anastesi dan sedasi',
        'asesmen pra anestesi dan sedasi',
        'rencana keperawatan',
        'indikator sc',
        'surat pernyataan pulang aps',
        'permintaan pemeriksaan patologi anatomi',
        'formulir serah terima jenazah',
        'formulir serah terima bayi',
        'surat keterangan kematian',
        'observasi keperawatan rawat inap',
        'lembar konsultasi',
        'lembar pemantauan fibrinolitik',
        'surat kontrol',
        'lembar penolakan dnr',
        'asesmen pasien terminal',
        'dokumentasi informasi tindakan anestesi umum atau sedasi',
        'persetujuan atau penolakan transfusi darah',
        'tindakan anestesi spinal atau epidural',
        'lembar hasil tindakan uji fungsi',
        'rekonsiliasi_obat',
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
            url: "{{ url('ajax_request/dokumen_kunjungan_by_noreg') }}",
            data: {
                noreg: noreg
            },
            success: function(response) {
                var ins = '';
                if (response && response.dokumen.length < 1) {
                    ins = '<tr>' +
                        '<td colspan="7" class="text-center">Data tidak ditemukan</td>' +
                        '</tr>';
                } else {
                    var no = 1;
                    for (let i = 0; i < response.dokumen.length; i++) {
                        if (response.dokumen[i].nama_dokumen == "Observasi Keperawatan Rawat Inap") {
                            sts_observasi_keperawatan = 1;
                        } else {
                            sts_observasi_keperawatan = 0;
                        }
                        if (
                            list_docs.indexOf(response.dokumen[i].nama_dokumen) >= 0 ||
                            list_docs.includes(response.dokumen[i].nama_dokumen)
                        ) {
                            let pdf = '';
                            if (!ignore_pdf.includes(response.dokumen[i].nama_dokumen.toLowerCase()) && response.dokumen[i].status) {
                                pdf = '<a class="btn btn-dark mr-1" href="' + l + '/detail/pdf_' + response.dokumen[i].nama_dokumen.replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_').toLowerCase() + '?dokumen=' + response.dokumen[i].id + '" target="_blank"><i class="fas fa-arrow-down"></i></a>';
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
                                '<td>' + (response.dokumen[i].nama_dokumen == "Formulir Serah Terima Bayi" ? "Checklist Serah Terima Bayi" : response.dokumen[i].nama_dokumen) + '</td>' +
                                '<td class="text-center">' + (response.dokumen[i].status ?
                                    'Sudah diverifikasi' :
                                    'Belum diverifikasi') + '</td>' +
                                '<td class="text-center">' + tanggal_dmy(response.dokumen[i]
                                    .tanggal_update) +
                                '</td>' +
                                '<td>' + response.dokumen[i].nama_verifikator + '</td>' +
                                '<td class="text-center">' +
                                '<div style="display:flex; flex-direction:row;">' +
                                pdf +
                                lihat +
                                '<button class="btn btn-danger ml-1" type="button" onclick="hapus_dokumen_kunjungan(' + response.dokumen[i].id + ')"><i class="fas fa-trash"></i></button>'+
                            '</div>' +
                            '</td>' +
                            '</tr>';
                            no++;
                        }
                    }
                }
                render_dokumen_kunjungan(ins, response.layanan);
            }
        })
    }

    function convert_slug_nama_dokumen(dokumen){
        if (dokumen == '' || dokumen == null) {
            return '';
        }
        let result = dokumen == 'Catatan Perkembangan Pasien Terintegrasi (CPPT)' ? 'catatan_perkembangan_pasien_terintegrasi_v2' : dokumen.replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_').toLowerCase();
        return result;
    }

    function hapus_dokumen_kunjungan(param) {
        if (confirm('Yakin melanjutkan hapus dokumen ?')) {
            $.ajax({
                url: "{{ url('ajax_request/hapus_dokumen_kunjungan') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    get_dokumen_kunjungan(response.noreg);
                }
            })
        }
    }

    function render_dokumen_kunjungan(body, layanan) {
        const doc_options = list_docs.map(doc => {
            return `<option value="${doc}">${doc}</option>`;
        }).join()

        var ins = '<div class="card p-3">' +
            '<p style="font-weight:bold; font-size:18px;">Dokumen Kunjungan ' + tanggal_dmy(layanan.tanggal) + '</p>' +
            '<form class="row" id="form_dokumen_kunjungan" onsubmit="create_dokumen_kunjungan()" style="display:flex; flex-direaction:row">' +
            '<div class="col-lg-12" id="loading_form_dokumen_kunjungan">' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<input type="hidden" name="noreg" value="' + layanan.id + '"/>' +
            '<input type="hidden" name="_token" value="{{ csrf_token() }}"/>' +
            '<select name="jenis_dokumen" class="form-control">' +
            doc_options +
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
        if (tanggal.includes(' ')) {
            var tgl = tanggal.split(' ');
            var temp = tgl[0].split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        } else {
            var temp = tanggal.split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        }
    }

    function create_dokumen_kunjungan() {
        window.event.preventDefault();
        if (sts_observasi_keperawatan == 1 && $('#jenis_dokumen').val() == "Observasi Keperawatan Rawat Inap") {
            alert("Dokumen Observasi Keperawatan Telah Dibuat");
        } else {
            $('#loading_form_dokumen_kunjungan').html('<div class="alert alert-info">' + loading('Sedang membuat dokumen, harap tunggu...', 'sm') + '</div>');
            $.ajax({
                url: "{{ url('e_rekam_medis/rawat_inap/ajax_create_dokumen_kunjungan') }}",
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
