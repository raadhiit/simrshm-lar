@extends('layouts.app')
@section('content')
<style>
    .wrapper {
        position: relative;
        overflow: auto;
        white-space: nowrap;
    }

    .sticky-col {
        position: -webkit-sticky;
        position: sticky;
        background-color: #fff;
    }

    .first-col {
        width: 80px;
        min-width: 80px;
        max-width: 80px;
        left: 0px;
    }

    .second-col {
        width: 150px;
        min-width: 150px;
        max-width: 150px;
        left: 80px;
    }

    .third-col {
        width: 100px;
        min-width: 130px;
        max-width: 130px;
        left: 230px;
    }

    .fourth-col {
        width: 250px;
        min-width: 300px;
        max-width: 300px;
        left: 360px;
    }

    #show tr td{
        padding:10px;
    }
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Resume Medis</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="row pt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" id="nama_pasien" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">No. RM</label>
                            <input type="text" id="no_rm" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" id="no_reg" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Unit Kerja</label>
                            <select id="unit_kerja" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($faskes as $f)
                                <option value="{{$f->nama}}">{{$f->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 pb-3" style="text-align: center;">
                        <button class="btn btn-primary" id="btn_cari"><i class="fas fa-search"></i> Cari</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row pt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12 wrapper">
                        <table style="width: 1800px;">
                            <thead>
                                <tr class="text-center">
                                    <th class="sticky-col first-col">No</th>
                                    <th class="sticky-col second-col">No. RM</th>
                                    <th class="sticky-col third-col">No. Reg</th>
                                    <th class="sticky-col fourth-col">Nama Pasien</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Tgl. MRS</th>
                                    <th>Tgl. KRS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="show">

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

    $('#btn_cari').click(function() {
        if ($('#unit_kerja').val() == '') {
            alert('Pilih unit kerja dahulu');
        } else {
            $('#show').html('<tr class="text-center"><td colspan="9">' + spin + '</td></tr>');
            $.ajax({
                url: "{{ url('ajax_request/filter_resume_medis') }}",
                data: {
                    nama_pasien: $('#nama_pasien').val(),
                    no_rm: $('#no_rm').val(),
                    no_reg: $('#no_reg').val(),
                    unit_kerja: $('#unit_kerja').val(),
                },
                success: function(response) {
                    console.log(response);
                    if (response.length < 1) {
                        $('#show').html('<tr class="text-center"><td colspan="9">Data tidak ditemukan.</td></tr>');
                    } else {
                        var ins = '';
                        for (let i = 0; i < response.length; i++) {
                            var kelamin = 'Laki-Laki';
                            if (response[i].kelamin == 1) {
                                kelamin = 'Perempuan';
                            }
                            ins += '<tr>' +
                                '<td class="text-center sticky-col first-col">' + (i + 1) + '</td>' +
                                '<td class="sticky-col second-col">' + response[i].nrm + '</td>' +
                                '<td class="sticky-col third-col">' + response[i].id + '</td>' +
                                '<td class="sticky-col fourth-col">' + response[i].nama_pasien + '</td>' +
                                '<td class="text-center">' + kelamin + '</td>' +
                                '<td class="text-center">' + response[i].umur + '</td>' +
                                '<td class="text-center">' + format_tanggal(response[i].tanggal) + '</td>' +
                                '<td class="text-center">' + format_tanggal(response[i].tanggal_pulang) + '</td>' +
                                '<td class="text-center"><a target="_blank" href="./resume_medis/download?id=' + response[i].id + '" class="btn btn-success"><i class="fas fa-arrow-down"></i> Download</a></td>' +
                                '</tr>';
                        }
                        $('#show').html(ins);
                    }
                },
                error: function(e) {
                    $('#show').html('<tr class="text-center"><td colspan="9">Ops! Terjadi kesalahan.</td></tr>');
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