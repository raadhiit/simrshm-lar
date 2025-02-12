@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Waktu Task ID</h1>
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
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            @endif
            <div class="card pt-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Kode Booking</label>
                            <input type="text" placeholder="masukkan kode booking disini" id="kode_booking" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" style="padding-top: 31px;">
                            <button class="btn btn-success" id="btn_search"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kode Booking</th>
                                    <th>Task ID</th>
                                    <th>Task Name</th>
                                    <th>Waktu</th>
                                    <th>Waktu RS</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                <tr class="text-center">
                                    <th colspan="6">Cari kode booking dahulu.</th>
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
        return '<tr class="text-center"><td colspan="6"><div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' + param + '</td></tr>';
    }

    $('#btn_search').click(function(){
        if ($('#kode_booking').val() == '') {
            alert('Masukkan kode booking dahulu');
            return;
        }

        $('#result').html(loading('Sedang mengambil data...'));

        $.ajax({
            url : '{{ url("ajax_request/list_task_id") }}',
            data : {
                kode_booking : $('#kode_booking').val()
            },
            success:function(response){
                console.log(response.data);
                if (response.status) {
                    var ins = '';
                    for (let i = 0; i < response.data.length; i++) {
                        ins += '<tr>'+
                        '<td class="text-center">'+(i+1)+'</td>'+
                        '<td>'+response.data[i].kodebooking+'</td>'+
                        '<td class="text-center">'+response.data[i].taskid+'</td>'+
                        '<td>'+response.data[i].taskname+'</td>'+
                        '<td>'+response.data[i].waktu+'</td>'+
                        '<td>'+response.data[i].wakturs+'</td>'+
                        '</tr>';
                    }
                    $('#result').html(ins);
                }else{
                    $('#result').html('<tr class="text-center"><td colspan="6">'+response.message+'</td></tr>');
                }
            }
        })
    })
</script>
@endpush