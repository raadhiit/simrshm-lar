@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dokumen Rekam Medis</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="row pt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">No. RM</label>
                            <input type="text" id="no_rm" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" id="nama_pasien" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Unite Kerja</label>
                            <select id="unit_kerja" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($faskes as $f)
                                <option value="{{$f->nama}}">{{$f->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3" style="padding-top: 30px;">
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <button class="btn btn-primary" id="btn_cari"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row pt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>No. RM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var spin = '<div class="spinner-border spinner-border-sm mr-1" role="status">' +
        '<span class="sr-only"></span>' +
        '</div>' +
        'Sedang menambil data, harap tunggu...';

    $('#unit_kerja').on('change', function(){
        $('#list').html('');
    });

    $('#btn_cari').click(function() {
        if ($('#unit_kerja').val() == '') {
            alert('Pilih unit kerja dahulu');
        } else {
            $('#list').html('<tr class="text-center"><td colspan="6">' + spin + '</td></tr>');
            $.ajax({
                url: "{{ url('ajax_request/filter_dokumen_rm') }}",
                data: {
                    nama_pasien: $('#nama_pasien').val(),
                    no_rm: $('#no_rm').val(),
                    unit_kerja: $('#unit_kerja').val(),
                },
                success: function(response) {
                    console.log(response);
                    if (response.length < 1) {
                        $('#list').html('<tr class="text-center"><td colspan="6">Data tidak ditemukan.</td></tr>');
                    } else {
                        var ins = '';
                        for (let i = 0; i < response.length; i++) {
                            var kelamin = 'Laki-Laki';
                            if (response[i].kelamin == 1) {
                                kelamin = 'Perempuan';
                            }
                            ins += '<tr>' +
                                '<td class="text-center">' + response[i].nrm + '</td>' +
                                '<td>' + response[i].nama + '</td>' +
                                '<td class="text-center">' + kelamin + '</td>' +
                                '<td class="text-center">' + format_tanggal(response[i].tgl_lahir) + '</td>' +
                                '<td>' + response[i].alamat + '</td>' +
                                '<td class="text-center"><a target="_blank" style="display:inline-flex; align-items:center;" href="./dokumen_rm/download?id=' + response[i].nrm + '&klinik='+$('#unit_kerja').val()+'" class="btn btn-success"><i class="fas fa-arrow-down mr-1"></i> Download</a></td>' +
                                '</tr>';
                        }
                        $('#list').html(ins);
                    }
                },
                error: function(e) {
                    $('#list').html('<tr class="text-center"><td colspan="6">Ops! Terjadi kesalahan.</td></tr>');
                }
            })
        }
    })

    function format_tanggal(param) {
        if (param == '') {
            return '';
        } else {
            var tgl_full = param.split(' ');
            var tgl = tgl_full[0].split('-');
            return tgl[2] + '-' + tgl[1] + '-' + tgl[0];
        }
    }
</script>
@endsection