@extends('layouts.app')
@section('content')
<div class="modal fade" id="modal_layani_antrian" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pilih Jenis Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="layani_id">
                <select id="jenis_obat" class="form-control">
                    <option value="1">Racikan</option>
                    <option value="0">Non Racikan</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="layani_antrian()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Antrian Farmasi</h1>
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
            <div id="msg"></div>
            <div class="card pt-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nomor Antrian</th>
                                    <th>Nama Pasien</th>
                                    <th>No. RM</th>
                                    <th>No. BPJS</th>
                                    <th>NIK</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                @if(sizeof($antrian) < 1) <tr class="text-center">
                                    <td colspan="8">Data tidak ditemukan</td>
                                    </tr>
                                    @else
                                    @foreach($antrian as $ant)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$ant->nomorantrean}}</td>
                                        <td>{{$ant->pasien}}</td>
                                        <td>{{$ant->norm}}</td>
                                        <td>{{$ant->nobpjs}}</td>
                                        <td>{{$ant->ktp}}</td>
                                        <td>
                                            <?php
                                            switch ($ant->taskid) {
                                                case '5':
                                                    echo 'Menunggu Dilayani';
                                                    break;
                                                case '6':
                                                    echo 'Sedang Dilayani';
                                                    break;
                                                case '7':
                                                    echo 'Selesai Dilayani';
                                                    break;
                                                default:
                                                    echo '';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            switch ($ant->taskid) {
                                                case '5':
                                                    $antrian = "'" . $ant->nomorantrean . "'";
                                                    $pasien = "'" . $ant->pasien . "'";
                                                    echo '<div style="display:flex;"><button class="btn btn-dark mr-1" onclick="panggil(' . $antrian . ',' . $pasien . ')">Panggil</button><button class="btn btn-warning" onclick="modal_layani_antrian(' . $ant->id . ')">Layani</button></div>';
                                                    break;
                                                case '6':
                                                    echo '<butt class="btn btn-success" onclick="selesai_antrian(' . $ant->id . ')">Selesai</button>';
                                                    break;
                                                case '7':
                                                    $antrian = "'" . $ant->nomorantrean . "'";
                                                    $pasien = "'" . $ant->pasien . "'";
                                                    echo '<div style="display:flex;"><button class="btn btn-dark mr-1" onclick="panggil(' . $antrian . ',' . $pasien . ')">Panggil</button></div>';
                                                    break;
                                                default:
                                                    echo '';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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
    // let model_suara = [];
    function loading(msg) {
        return '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' + msg;
    }

    function get_data() {
        $.ajax({
            url: '{{ url("ajax_request/antrian_farmasi") }}',
            success: function(response) {
                console.log(response);
                if (response.length == 0) {
                    $('#list').html('<tr class="text-center"><td colspan="8">Data tidak ditemukan</td></tr>');
                    return;
                }

                let ins = '';
                for (let i = 0; i < response.length; i++) {
                    ins += '<tr>' +
                        '<td class="text-center">' + (i + 1) + '</td>' +
                        '<td>' + response[i].nomorantrean + '</td>' +
                        '<td>' + response[i].pasien + '</td>' +
                        '<td>' + response[i].norm + '</td>' +
                        '<td>' + response[i].nobpjs + '</td>' +
                        '<td>' + response[i].ktp + '</td>' +
                        '<td>' + status(response[i].taskid) + '</td>' +
                        '<td>' + render_button(response[i].taskid, response[i].id, response[i].nomorantrean, response[i].pasien) + '</td>' +
                        '</tr>';
                }
                $('#list').html(ins);
            }
        })
    }

    setInterval(function() {
        get_data();
    }, 120000)

    function status(param) {
        switch (param) {
            case 5:
                return 'Menunggu Dilayani';
                break;
            case 6:
                return 'Sedang Dilayani';
                break;
            case 7:
                return 'Selesai Dilayani';
                break;
            default:
                return '';
                break;
        }
    }

    function render_button(param, id, antrian, pasien) {
        switch (param) {
            case 5:
                return '<div style="display:flex;"><button class="btn btn-dark mr-1" onclick="panggil(' + "'" + antrian + "'" + ',' + "'" + pasien + "'" + ')">Panggil</button><button class="btn btn-warning" onclick="modal_layani_antrian(' + "'" + id + "'" + ')">Layani</button></div>';
                break;
            case 6:
                return '<div style="display:flex;"><button class="btn btn-dark mr-1" onclick="panggil(' + "'" + antrian + "'" + ',' + "'" + pasien + "'" + ')">Panggil</button><button class="btn btn-success" onclick="selesai_antrian(' + id + ')">Selesai</button></div>';
                break;
            case 7:
                return '<div style="display:flex;"><button class="btn btn-dark mr-1" onclick="panggil(' + "'" + antrian + "'" + ',' + "'" + pasien + "'" + ')">Panggil</button></div>';
                break;
            default:
                return '';
                break;
        }
    }

    function modal_layani_antrian(id) {
        $('#layani_id').val(id);
        $('#modal_layani_antrian').modal('show');
    }

    function layani_antrian() {
        $('#modal_layani_antrian').modal('hide');
        $('#msg').html('<div class="alert alert-info">' + loading('Sedang proses, harap tunggu...') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/farmasi_layani_antrian') }}",
            data: {
                id: $('#layani_id').val(),
                jenis_obat: $('#jenis_obat').val()
            },
            success: function(response) {
                if (response.status) {
                    $('#msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    get_data();
                    return;
                }

                $('#msg').html('<div class="alert alert-danger">' + response.message + '</div>');
            }
        })
    }

    function selesai_antrian(id){
        $('#msg').html('<div class="alert alert-info">' + loading('Sedang proses, harap tunggu...') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/farmasi_selesai_antrian') }}",
            data: {
                id: id,
            },
            success: function(response) {
                if (response.status) {
                    $('#msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    get_data();
                    return;
                }

                $('#msg').html('<div class="alert alert-danger">' + response.message + '</div>');
            }
        })
    }

    function panggil(nomor, pasien) {
        $.ajax({
            url: "{{ url('ajax_request/send_broadcast') }}",
            method: 'post',
            data: {
                loket: '',
                nomor: nomor,
                bagian: 'farmasi',
                _token: '{{ csrf_token() }}',
                pasien: pasien
            },
            success: function(response) {
                console.log(response);
            }
        })
    }
</script>
@endpush