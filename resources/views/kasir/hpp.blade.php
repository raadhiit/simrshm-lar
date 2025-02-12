@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>HPP Pasien</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="row pt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" id="nama" class="form-control">
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
                        <div class="form-group" style="padding-top: 30px;">
                            <button class="btn btn-primary" id="tmbl_cari"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12 pt-3 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>No. RM</th>
                                    <th>No. Reg</th>
                                    <th>Nama Pasien</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tgl. MRS</th>
                                    <th>Tgl. KRS</th>
                                    <th>Ruangan Terakhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list_hpp"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var loading = '<div class="spinner-border spinner-border-sm mr-1 text-primary" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div>'+
        'Sedang mengambil data, harap tunggu..';
    $('#tmbl_cari').on('click', function() {
        $('#list_hpp').html('<tr class="text-center"><td colspan="9">'+loading+'</td></tr>')
        $.ajax({
            url: '{{ url("ajax_request/hpp") }}',
            data: {
                nama: $('#nama').val(),
                no_rm: $('#no_rm').val(),
                no_reg: $('#no_reg').val()
            },
            success: function(response) {
                console.log(response);
                if (response == null) {
                    $('#list_hpp').html('<tr class="text-center"><td colspan="9">Data tidak ditemukan.</td></tr>');
                } else {
                    var ins = '';
                    for (let i = 0; i < response.length; i++) {
                        ins += '<tr>'+
                        '<td class="text-center">'+(i+1)+'</td>'+
                        '<td>'+response[i].nrm+'</td>'+
                        '<td>'+response[i].id+'</td>'+
                        '<td>'+response[i].nama_pasien+'</td>'+
                        '<td class="text-center">'+parse_kelamin(response[i].kelamin)+'</td>'+
                        '<td>'+format_tanggal(response[i].tanggal_inap)+'</td>'+
                        '<td>'+format_tanggal(response[i].tanggal_pulang)+'</td>'+
                        '<td>'+response[i].last_nama_ruangan+'</td>'+
                        '<td><a target="_blank" style="display:inline-flex; justify-content:center;" href="./hpp/download?noreg='+response[i].id+'" class="btn btn-success"><i class="fas fa-arrow-down mr-1 mt-2"></i> Download</a></td>'+
                        '</tr>';
                    }
                    $('#list_hpp').html(ins);
                }
            }
        })
    })

    function parse_kelamin(param){
        if(param == 1){
            return 'Perempuan';
        }else{
            return 'Laki-Laki';
        }
    }

    function format_tanggal(param){
        if (param == '') {
            return '';
        }else{
            let temp = param.split(' ');
            let tempz = temp[0].split('-');
            return tempz[2]+'-'+tempz[1]+'-'+tempz[0];
        }
    }
</script>
@endsection