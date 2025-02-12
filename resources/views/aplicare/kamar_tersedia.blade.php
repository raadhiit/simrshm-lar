@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Aplicare - Ketersediaan Kamar</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="row pt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-6">
                        <h6 style="color: #111;">Data Ketersediaan Kamar (Local)</h6>
                    </div>
                    <div class="col-lg-6" style="display: flex; justify-content: flex-end;">
                        <button class="btn btn-primary mr-1" id="btn_create">Create</button>
                        <button class="btn btn-warning mr-1" id="btn_update">Update</button>
                        <button class="btn btn-danger" id="btn_delete">Delete</button>
                    </div>
                    <div class="col-lg-12 pt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>KODE KELAS</th>
                                    <th>NAMA KELAS</th>
                                    <th>KODE RUANG</th>
                                    <th>NAMA RUANG</th>
                                    <th>KAPASITAS</th>
                                    <th>TERSEDIA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($available_beds as $ab)
                                <tr>
                                    <td>{{$ab->kodekelas}}</td>
                                    <td>{{$ab->namakelas}}</td>
                                    <td>{{$ab->koderuang}}</td>
                                    <td>{{$ab->namaruang}}</td>
                                    <td>{{$ab->kapasitas}}</td>
                                    <td>{{$ab->tersedia}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3" style="width: 100%; margin-left:0;">
                        <div class="col-lg-6" style="display: flex; align-items: center;">
                            @if(sizeof($available_beds) > 0)
                            Showing data {{$available_beds->firstItem()}} to {{$available_beds->lastItem()}}, Page {{ $available_beds->currentPage() }} of {{$available_beds->lastPage()}}
                            @else
                            Empty result
                            @endif
                        </div>
                        <div class="col-lg-6" style="justify-content: flex-end; display: flex;">
                            {{ $available_beds->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row pt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <h6 style="color: #111;">Data Ketersediaan Kamar (Aplicare)</h6>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label style="color: #111;">Pilih jumlah data yang ingin ditampilkan</label>
                            <select id="limit" class="form-control">
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>KODE KELAS</th>
                                    <th>NAMA KELAS</th>
                                    <th>KODE RUANG</th>
                                    <th>NAMA RUANG</th>
                                    <th>KAPASITAS</th>
                                    <th>TERSEDIA</th>
                                </tr>
                            </thead>
                            <tbody id="show_aplicare"></tbody>
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
    var spin = '<div class="spinner-border spinner-border-sm text-primary mr-1" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div> Sedang mengambil data';

    $(document).ready(function() {
        toastr.options.timeOut = 3000;
        get_data_aplicare();
    })

    setInterval(function(){
        get_data_aplicare();
    },3600000);

    $('#limit').change(function(){get_data_aplicare()});

    function get_data_aplicare() {
        $('#show_aplicare').html('<tr class="text-center"><td colspan="6">' + spin + '</td></tr>');
        $.ajax({
            url: '{{ url("ajax_request/aplicare/available_beds") }}',
            data : {
                limit : $('#limit').val()
            },
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    $('#show_aplicare').html('<tr class="text-center"><td colspan="6">' + response.message + '</td></tr>');
                    return;
                }
                var data = JSON.parse(response.data);
                console.log(data);
                if (data.metadata.totalitems !== 0) {
                    if (Object.keys(data.response.list).length === 0) {
                        $('#show_aplicare').html('<tr class="text-center"><td colspan="6">Data tidak ditemukan</td></tr>');
                    } else {
                        var ins = '';
                        for (let i = 0; i < data.response.list.length; i++) {
                            ins += '<tr>' +
                                '<td>' + data.response.list[i].kodekelas + '</td>' +
                                '<td>' + data.response.list[i].namakelas + '</td>' +
                                '<td>' + data.response.list[i].koderuang + '</td>' +
                                '<td>' + data.response.list[i].namaruang + '</td>' +
                                '<td>' + data.response.list[i].kapasitas + '</td>' +
                                '<td>' + data.response.list[i].tersedia + '</td>' +
                                '</tr>';
                        }
                        $('#show_aplicare').html(ins);
                    }
                } else {
                    $('#show_aplicare').html('<tr class="text-center"><td colspan="6">' + data.metadata.message + '</td></tr>');
                }
            }
        })
    }

    $('#btn_create').click(function() {
        $.ajax({
            url: "{{ url('ajax_request/aplicare/create_beds') }}",
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
                console.log(response);
                get_data_aplicare()
            }
        })
    })

    $('#btn_update').click(function() {
        $.ajax({
            url: "{{ url('ajax_request/aplicare/update_beds') }}",
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
                console.log(response);
                get_data_aplicare()
            }
        })
    })

    $('#btn_delete').click(function() {
        $.ajax({
            url: "{{ url('ajax_request/aplicare/delete_beds') }}",
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
                console.log(response);
                get_data_aplicare()
            }
        })
    })
</script>
@endpush