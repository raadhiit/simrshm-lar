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
                <h1>E-Rekam Medis Dokter</h1>
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
                                    @if (sizeof($history) < 1)
                                        <tr class="text-center">
                                            <th colspan="4">Tidak ada data kunjungan.</th>
                                        </tr>
                                    @else
                                        @foreach ($history as $hi)
                                            <tr>
                                                <td class="pt-1 pb-1"><a style="text-decoration:none; color:#111;"
                                                        href=""
                                                        onclick="get_dokumen_kunjungan('{{ $hi->id }}')">{{ date('d-m-Y H:i', strtotime($hi->tanggal)) }}</a>
                                                </td>
                                                <td class="pt-1 pb-1">
                                                    {{ ucwords(str_replace('_', ' ', $hi->jenislayanan)) }}</td>
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
        var sts_program_pelayanan_fisioterapi = 0;
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
                            if (response.dokumen[i].nama_dokumen == "Asesment Medis Awal Rawat Jalan" ||
                                response.dokumen[i].nama_dokumen == "Surat Permintaan Rawat Inap" ||
                                response.dokumen[i].nama_dokumen == "Dokumen Transfer Pasien Internal" ||
                                response.dokumen[i].nama_dokumen == "Dokumen Laporan Caesarian" ||
                                // response.dokumen[i].nama_dokumen == "Catatan Perkembangan Pasien Terintegrasi" ||
                                response.dokumen[i].nama_dokumen == "Catatan Perkembangan Pasien Terintegrasi (CPPT)" ||
                                response.dokumen[i].nama_dokumen == "Surat Pengantar Persiapan Tindakan Operasi" ||
                                response.dokumen[i].nama_dokumen == "Daftar Tilik Pasien Operasi" ||
                                response.dokumen[i].nama_dokumen == "Assesment Perioperatif Medis" ||
                                response.dokumen[i].nama_dokumen == "Dokumen Laporan Pembedahan" ||
                                response.dokumen[i].nama_dokumen == "Formulir Penandaan Lokasi Operasi" ||
                                response.dokumen[i].nama_dokumen == "Asesmen Pra Anestesi Dan Sedasi" ||
                                response.dokumen[i].nama_dokumen == "Laporan Anastesi Dan Sedasi" ||
                                response.dokumen[i].nama_dokumen == "Checklist Keselamatan Pasien Operasi" ||
                                // response.dokumen[i].nama_dokumen == "Skrining Gizi Rawat Inap" ||

                                response.dokumen[i].nama_dokumen == "Dokumen Asesment Awal Medis Gawat Darurat" ||
                                response.dokumen[i].nama_dokumen == "Lembar Konsultasi" ||
                                response.dokumen[i].nama_dokumen == "Persetujuan atau Penolakan Tindakan Kedokteran" ||
                                response.dokumen[i].nama_dokumen == "Persetujuan atau Penolakan Tindakan Bedah" ||
                                response.dokumen[i].nama_dokumen == "Persetujuan atau Penolakan Transfusi Darah" ||
                                response.dokumen[i].nama_dokumen == "Catatan Edukasi Pasien" ||
                                response.dokumen[i].nama_dokumen == "Surat Kontrol" ||
                                response.dokumen[i].nama_dokumen == "Indikator SC" ||
                                response.dokumen[i].nama_dokumen == "Tindakan Anestesi Spinal atau Epidural" ||
                                response.dokumen[i].nama_dokumen == "Daftar Pemberian Obat" ||
                                response.dokumen[i].nama_dokumen == "Daftar Tilik Pasien Operasi" ||
                                response.dokumen[i].nama_dokumen == "Surat Pengantar Persiapan Tindakan Operasi" ||
                                response.dokumen[i].nama_dokumen == "Observasi Cairan" ||
                                response.dokumen[i].nama_dokumen == "Surat Pernyataan Pulang APS" ||
                                response.dokumen[i].nama_dokumen == "Formulir Serah Terima Jenazah" ||
                                response.dokumen[i].nama_dokumen == "Surat Keterangan Kematian" ||
                                response.dokumen[i].nama_dokumen == "Lembar Pemantauan Fibrinolitik" ||
                                response.dokumen[i].nama_dokumen == "Lembar Penolakan DNR" ||
                                response.dokumen[i].nama_dokumen == "Asesmen Pasien Terminal" ||
                                response.dokumen[i].nama_dokumen == "Survei Infeksi Rumah Sakit" ||
                                response.dokumen[i].nama_dokumen == "Dokumentasi Informasi Tindakan Anestesi Umum atau Sedasi" ||
                                response.dokumen[i].nama_dokumen == "Bukti Pendaftaran Rawat Jalan" ||
                                response.dokumen[i].nama_dokumen == "Persetujuan atau Penolakan Tindakan Kedokteran" ||
                                response.dokumen[i].nama_dokumen == "Formulir Klaim Fisioterapi" ||
                                response.dokumen[i].nama_dokumen == "Program Pelayanan Fisioterapi" ||
                                response.dokumen[i].nama_dokumen == "Lembar Hasil Tindakan Uji Fungsi" ||
                                response.dokumen[i].nama_dokumen == "Form Pemantauan Reaksi Transfusi Darah"
                                // "Lembar Konsultasi",
                                // "Surat Kontrol",
                                // "Persetujuan Atau Penolakan Tindakan Bedah",
                                // 'Persetujuan atau Penolakan Transfusi Darah',
                                // 'Tindakan Anestesi Spinal atau Epidural',
                                // 'Persetujuan atau Penolakan Tindakan Kedokteran',
                                // 'Catatan Edukasi Pasien',

                            ) {

                                let pdf = response.dokumen[i].status ? '<a class="btn btn-dark mr-1" href="' + l + '/detail/pdf_' + response.dokumen[i].nama_dokumen.replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_').toLowerCase() + '?dokumen=' + response.dokumen[i].id + '" target="_blank"><i class="fas fa-arrow-down"></i></a>' : '';

                                let ignore_pdf = [
                                    'dokumen laporan pembedahan',
                                    'laporan anastesi dan sedasi',
                                    'asesmen pra anestesi dan sedasi',
                                    'rencana keperawatan',
                                    'lembar hasil tindakan uji fungsi',
                                    'program pelayanan fisioterapi',
                                    'formulir klaim fisioterapi',
                                ];

                                if (ignore_pdf.includes(response.dokumen[i].nama_dokumen.toLowerCase())) {
                                    pdf = '';
                                }

                                if (response.dokumen[i].nama_dokumen == "Program Pelayanan Fisioterapi") {
                                    if (!response.dokumen2) {
                                        sts_program_pelayanan_fisioterapi == 1;
                                    }
                                }


                                let lihat = '<a class="btn btn-primary" href="'+l+'/detail/' + convert_slug_nama_dokumen(response.dokumen[i].nama_dokumen) + '?dokumen=' + response.dokumen[i].id + '" target="_blank"><i class="fas fa-pencil-alt"></i></a>';

                                if (response.dokumen[i].nama_dokumen == 'Form Pemantauan Reaksi Transfusi Darah') {
                                    lihat = '<a class="btn btn-primary" href="../' + convert_slug_nama_dokumen(response.dokumen[i].nama_dokumen) + '?dokumen=' + response.dokumen[i].id + '" target="_blank"><i class="fas fa-pencil-alt"></i></a>';
                                }

                                ins += '<tr>' +
                                    '<td class="text-center">' + no + '</td>' +
                                    '<td>' + response.dokumen[i].nama_dokumen + '</td>' +
                                    '<td>' + response.dokumen[i].ruangan + '</td>' +
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
                                    '<td>' + response.dokumen2.ruangan + '</td>' +
                                    '<td class="text-center">' + (response.dokumen2.status ?
                                        'Sudah diverifikasi' :
                                        'Belum diverifikasi') + '</td>' +
                                    '<td class="text-center">' + tanggal_dmy(response.dokumen2.tanggal_update) +
                                    '</td>' +
                                    '<td>' + response.dokumen2.nama_verifikator + '</td>' +
                                    '<td class="text-center">' +
                                    '<div style="display:flex; flex-direction:row;">' +
                                    pdf +
                                    '<a class="btn btn-primary" href="'+l+'/detail/' + convert_slug_nama_dokumen(response.dokumen2.nama_dokumen) + '?dokumen=' + response.dokumen2
                                        .id + '" target="_blank"><i class="fas fa-pencil-alt"></i></a>' +
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

        function convert_slug_nama_dokumen(dokumen){
            if (dokumen == '' || dokumen == null) {
                return '';
            }
            let result = dokumen == 'Catatan Perkembangan Pasien Terintegrasi (CPPT)' ? 'catatan_perkembangan_pasien_terintegrasi_v2' : dokumen.replaceAll(' ', '_').replaceAll('(', '').replaceAll(')', '').replaceAll('-', '_').toLowerCase();
            return result;
        }

        function render_dokumen_kunjungan(body, layanan) {
            var ins = '<div class="card p-3">' +
                '<p style="font-weight:bold; font-size:18px;">Dokumen Kunjungan ' + tanggal_dmy(layanan.tanggal) + '</p>' +
                '<form class="row" id="form_dokumen_kunjungan" onsubmit="create_dokumen_kunjungan()" style="display:flex; flex-direaction:row">' +
                '<div class="col-lg-12" id="loading_form_dokumen_kunjungan">' +
                '</div>' +
                '<div class="col-lg-6">' +
                '<input type="hidden" name="noreg" value="' + layanan.id + '"/>' +
                '<input type="hidden" name="_token" value="{{ csrf_token() }}"/>' +
                '<select name="jenis_dokumen" class="form-control">' +
                '<option value="Asesment Medis Awal Rawat Jalan">Asesment Medis Awal Rawat Jalan</option>' +
                '<option value="Surat Permintaan Rawat Inap">Surat Permintaan Rawat Inap</option>' +
                '<option value="Dokumen Transfer Pasien Internal">Dokumen Transfer Pasien Internal</option>' +
                '<option value="Dokumen Laporan Caesarian">Dokumen Laporan Caesarian</option>' +
                '<option value="Dokumen Asesment Awal Medis Gawat Darurat">Dokumen Asesment Awal Medis Gawat Darurat</option>' +
                // '<option value="Catatan Perkembangan Pasien Terintegrasi">Catatan Perkembangan Pasien Terintegrasi</option>' +
                '<option value="Catatan Perkembangan Pasien Terintegrasi (CPPT)">Catatan Perkembangan Pasien Terintegrasi (CPPT)</option>' +
                '<option value="Surat Pengantar Persiapan Tindakan Operasi">Surat Pengantar Persiapan Tindakan/Operasi</option>' +
                '<option value="Daftar Tilik Pasien Operasi">Daftar Tilik Pasien Operasi</option>' +
                '<option value="Assesment Perioperatif Medis">Assesment Perioperatif Medis</option>' +
                '<option value="Dokumen Laporan Pembedahan">Dokumen Laporan Pembedahan</option>' +
                '<option value="Formulir Penandaan Lokasi Operasi">Formulir Penandaan Lokasi Operasi</option>' +
                '<option value="Asesmen Pra Anestesi Dan Sedasi">Asesmen Pra Anastesi Dan Sedasi</option>' +
                '<option value="Laporan Anastesi Dan Sedasi">Laporan Anastesi Dan Sedasi</option>' +
                '<option value="Checklist Keselamatan Pasien Operasi">Checklist Keselamatan Pasien Operasi</option>' +
                '<option value="Formulir Klaim Fisioterapi">Formulir Klaim Fisioterapi</option>' +
                '<option value="Program Pelayanan Fisioterapi">Program Pelayanan Fisioterapi</option>' +
                '<option value="Lembar Hasil Tindakan Uji Fungsi">Lembar Hasil Tindakan Uji Fungsi</option>' +
                // '<option value="Skrining Gizi Rawat Inap">Skrining Gizi Rawat Inap</option>' +
                '<option value="Lembar Konsultasi">Lembar Konsultasi</option>' +
                '<option value="Persetujuan atau Penolakan Tindakan Kedokteran">Persetujuan atau Penolakan Tindakan Kedokteran</option>' +
                '<option value="Persetujuan atau Penolakan Tindakan Bedah">Persetujuan atau Penolakan Tindakan Bedah</option>' +
                '<option value="Persetujuan atau Penolakan Transfusi Darah">Persetujuan atau Penolakan Transfusi Darah</option>' +
                '<option value="Catatan Edukasi Pasien">Catatan Edukasi Pasien</option>' +
                '<option value="Surat Kontrol">Surat Kontrol</option>' +
                '<option value="Indikator SC">Indikator SC</option>' +
                '<option value="Tindakan Anestesi Spinal atau Epidural">Tindakan Anestesi Spinal atau Epidural</option>' +
                '<option value="Daftar Pemberian Obat">Daftar Pemberian Obat </option> ' +
                '<option value="Observasi Cairan">Observasi Cairan</option>'+
                '<option value="Surat Pernyataan Pulang APS"> Surat Pernyataan Pulang APS </option>'+
                '<option value="Formulir Serah Terima Jenazah">Formulir Serah Terima Jenazah </option>'+
                '<option value="Surat Keterangan Kematian">Surat Keterangan Kematian</option>'+
                '<option value="Lembar Pemantauan Fibrinolitik">Lembar Pemantauan Fibrinolitik</option>'+
                '<option value="Lembar Penolakan DNR">Lembar Penolakan DNR </option>' +
                '<option value="Asesmen Pasien Terminal"> Assesmen Pasien Terminal</option>' +
                '<option value="Survei Infeksi Rumah Sakit"> Survei Infeksi Rumah Sakit</option>' +
                '<option value="Dokumentasi Informasi Tindakan Anestesi Umum atau Sedasi">Dokumentasi Informasi Tindakan Anestesi Umum atau Sedasi</option>' +
                '<option value="Bukti Pendaftaran Rawat Jalan">Bukti Pendaftaran Rawat Jalan</option>' +
                '<option value="Form Pemantauan Reaksi Transfusi Darah">Form Pemantauan Reaksi Transfusi Darah</option>' +
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
                '<th>Ruangan</th>' +
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
            if (sts_program_pelayanan_fisioterapi == 1 && $('#jenis_dokumen').val() == "Program Pelayanan Fisioterapi") {
                alert("Program Pelayanan Fisioterapi Telah Dibuat");
            } else {
                $('#loading_form_dokumen_kunjungan').html('<div class="alert alert-info">' + loading(
                    'Sedang membuat dokumen, harap tunggu...', 'sm') + '</div>');
                $.ajax({
                    url: "{{ url('e_rekam_medis/dokter/ajax_create_dokumen_kunjungan') }}",
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
