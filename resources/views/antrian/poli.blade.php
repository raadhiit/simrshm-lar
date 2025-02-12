@extends('layouts.app')
@section('content')
<div class="modal fade" id="modal_konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hide_id_konfirmasi">
                <p>Lanjut ke farmasi atau tidak ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="do_selesai('Lanjut')" class="btn btn-success">Lanjut</button>
                <button type="button" onclick="do_selesai('Selesai')" class="btn btn-primary">Selesai</button>
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Antrian Poli</h1>
        </div>

        <div class="section-body">
            @if(Session::has('berhasil'))
            <div class="row" style="width:100%; margin-left: 0;">
                <div class="col-lg-12 alert alert-success">
                    {{Session::get('berhasil')}}
                </div>
            </div>
            @endif
            @if(Session::has('gagal'))
            <div class="row" style="width:100%; margin-left: 0;">
                <div class="col-lg-12 alert alert-danger">
                    {{Session::get('gagal')}}
                </div>
            </div>
            @endif
            <div class="card pt-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12" id="box_msg"></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Poli</label>
                            <select id="poli" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($poli as $p)
                                <option value="{{$p->nama}}">{{$p->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Dokter</label>
                            <select id="dokter" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($dokter as $d)
                                <option value="{{$d->nama}}">{{$d->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group" style="padding-top: 30px;">
                            <button id="btn_tampilkan" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </div>
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nomor Antrian</th>
                                    <th>Nama Dokter</th>
                                    <th>Poli</th>
                                    <th>Nama Pasien</th>
                                    <th>No. RM</th>
                                    <th>No. BPJS</th>
                                    <th>NIK</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                <tr class="text-center">
                                    <td colspan="10">Filter terlebih dahaulu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    function loading(param) {
        return '<tr class="text-center"><td colspan="10"><div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' + param + '</td></tr>';
    }

    let synth = window.speechSynthesis;

    setInterval(function() {
        if ($('#dokter').val() == '' && $('#poli').val() == '') {
            $('#list').html('<tr class="text-center"><td colspan="10">Data tidak ditemukan</td></tr>')
        }
        ajax_get_data();
    }, 120000)

    function panggil(nomor, poli, pasien, jadwal) {
        $.ajax({
            url: "{{ url('ajax_request/send_broadcast') }}",
            method: 'post',
            data: {
                id_jadwal : jadwal,
                loket: poli,
                nomor: nomor,
                bagian: 'poli',
                _token: '{{ csrf_token() }}',
                pasien: pasien,
                lantai: ''
            },
            success: function(response) {
                if (response) {
                    console.log(response)
                }
            }
        })
    }

    $("#btn_tampilkan").click(function() {
        if ($('#poli').val() == '' && $('#dokter').val() == '') {
            alert('Pilih filter dahulu');
            return;
        }

        $('#btn_tampilkan').attr('disabled', true);
        $('#list').html(loading('Sedang mengambil data'));
        ajax_get_data();
    });

    function ajax_get_data() {
        console.log($('#poli').val());
        $.ajax({
            url: '{{ url("ajax_request/filter_antrian_poli") }}',
            data: {
                poli: $('#poli').val(),
                dokter: $('#dokter').val()
            },
            success: function(response) {
                console.log(response);
                render_data(response);
                $('#btn_tampilkan').removeAttr('disabled');
            }
        })
    }

    function render_data(param) {
        if (param.length == 0) {
            $('#list').html('<tr class="text-center"><td colspan="10">Data tidak ditemukan</td></tr>')
        } else {
            var ins = '';
            for (let i = 0; i < param.length; i++) {
                ins += '<tr>' +
                    '<td class="text-center">' + (i + 1) + '</td>' +
                    '<td>' + param[i].nomorantrean + '</td>' +
                    '<td>' + param[i].namadokter + '</td>' +
                    '<td>' + param[i].namapoli + '</td>' +
                    '<td>' + param[i].pasien + '</td>' +
                    '<td>' + param[i].norm + '</td>' +
                    '<td>' + param[i].nobpjs + '</td>' +
                    '<td>' + param[i].ktp + '</td>' +
                    '<td>' + check_task_id(param[i].taskid) + '</td>' +
                    '<td>' + check_button(param[i].taskid, param[i].id, param[i].nomorantrean, param[i].namapoli, param[i].pasien, param[i].jadwal_id) + '</td>' +
                    '</tr>';
            }
            $('#list').html(ins);
        }
        $('#btn_tampilkan').removeAttr('disabled');
    }

    function check_task_id(param) {
        if (param == '') {
            return '';
        }
        if (param == 3) {
            return 'Menunggu Dilayani';
        }
        if (param == 4) {
            return 'Sedang Dilayani';
        }
    }

    function check_button(param, id, nomor, poli, pasien, jadwal) {
        if (param == '') {
            return '';
        }
        if (param == 3) {
            return '<div style="display:inline-flex"><button onclick="panggil(' + "'" + nomor + "','" + poli + "','" + pasien + "','" + jadwal + "'" + ')" class="btn btn-dark mr-1 tbl_panggil">Panggil</button><button onclick="layani(' + id + ')" class="btn btn-warning tbl_layani">Layani</button></div>';
        }
        if (param == 4) {
            return '<button onclick="selesai(' + id + ')" class="btn btn-success tbl_selesai">Selesai</button>';
        }
        return '';
    }

    function layani(param) {
        $('#btn_tampilkan').attr('disabled', true);
        $('.tbl_layani').attr('disabled', true);
        $('.tbl_selesai').attr('disabled', true);
        $.ajax({
            url: '{{ url("ajax_request/layani_poli") }}',
            data: {
                id: param
            },
            success: function(response) {
                if (response.status) {
                    $('#box_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    ajax_get_data();
                } else {
                    $('#box_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
                $('.tbl_layani').removeAttr('disabled');
                $('#btn_tampilkan').removeAttr('disabled');
                $('.tbl_selesai').removeAttr('disabled');
            }
        })
    }

    function selesai(param) {
        $('#btn_tampilkan').attr('disabled', true);
        $('.tbl_layani').attr('disabled', true);
        $('.tbl_selesai').attr('disabled', true);
        $('#hide_id_konfirmasi').val(param);
        $('#modal_konfirmasi').modal('show');
    }

    function do_selesai(param) {
        var next = 0;
        var farmasi = 0;
        if (param == 'Lanjut') {
            next = 1;
        }
        $.ajax({
            url: '{{ url("ajax_request/selesai_poli") }}',
            data: {
                id: $('#hide_id_konfirmasi').val(),
                lanjut: next,
            },
            success: function(response) {
                if (response.status) {
                    $('#box_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    ajax_get_data();
                } else {
                    $('#box_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
                $('#modal_konfirmasi').modal('hide');
                $('.tbl_layani').removeAttr('disabled');
                $('#btn_tampilkan').removeAttr('disabled');
                $('.tbl_selesai').removeAttr('disabled');
            }
        })
    }

    $(document).ready(function() {
        $('#poli').select2();
        $('#dokter').select2();
    })
</script>
@endpush