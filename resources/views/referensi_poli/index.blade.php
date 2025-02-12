@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Referensi Poli</h1>
        </div>

        <div class="section-body">
            <div class="card pt-3 pb-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12 pb-3" style="text-align: right;">
                        <button class="btn btn-warning" id="btn_update">Update Poli</button>
                    </div>
                    <div class="col-lg-12" id="msg_loading"></div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kode Poli</th>
                                    <th>Nama Poli</th>
                                    <th>Kode Sub Spesialis</th>
                                    <th>Nama Sub Spesialis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($data) < 1) <tr class="text-center">
                                    <td colspan="5">Data tidak ditemukan.</td>
                                    </tr>
                                    @else
                                    @foreach($data as $d)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$d->kode_poli}}</td>
                                        <td>{{$d->nama_poli}}</td>
                                        <td>{{$d->kode_sub_spesialis}}</td>
                                        <td>{{$d->nama_sub_spesialis}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="width: 100%; margin-left:0;">
                        <div class="col-lg-6" style="display: flex; align-items: center;">
                            @if(sizeof($data) > 0)
                            Showing data {{$data->firstItem()}} to {{$data->lastItem()}}, Page {{ $data->currentPage() }} of {{$data->lastPage()}} @if($keyword != '') (Filtered) @endif
                            @else
                            Empty result @if($keyword != '') (Filtered) @endif
                            @endif
                        </div>
                        <div class="col-lg-6" style="justify-content: flex-end; display:flex;">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function loading(param) {
        return '<div class="spinner-border spinner-border-sm mr-1" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' + param;
    }

    $('#btn_update').click(function() {
        $('#msg_loading').html('<div class="alert alert-info">' + loading('Sedang melakukan update referensi poli') + '</div>');
        $('#btn_update').attr('disabled', true);
        $.ajax({
            url: "{{ url('ajax_request/update_poli') }}",
            success: function(response) {
                console.log(response);
                if (response.status == false) {
                    $('#btn_update').removeAttr('disabled');
                    $('#msg_loading').html('');
                    toastr.error(response.message);
                } else if(response.status == true){
                    $('#msg_loading').html('<div class="alert alert-success">' + response.message + '</div>');
                }
            }
        })
    });
</script>
@endsection