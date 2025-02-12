@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Aplicare - Credentials</h1>
        </div>

        <div class="section-body">
            <div class="row pt-3" style="width: 100%; margin-left: 0;">
                <div class="col-lg-5 pl-0 pr-0">
                    <div class="card p-3">
                        <h6 style="color: #111;">Data Credentials</h6>
                        <div class="form-group">
                            <label for="">Cons ID</label>
                            <input type="text" value="@if(isset($data->cons_id)){{$data->cons_id}}@endif" id="cons_id" placeholder="Tambahkan cons id disini.." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Cons Secret</label>
                            <input type="text" value="@if(isset($data->cons_secret)){{$data->cons_secret}}@endif" id="cons_secret" placeholder="Tambahkan cons secret disini.." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">User KEY</label>
                            <input type="text" value="@if(isset($data->user_key)){{$data->user_key}}@endif" id="user_key" placeholder="Tambahkan user key disini.." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kode PPK</label>
                            <input type="text" value="@if(isset($data->kode_ppk)){{$data->kode_ppk}}@endif" id="kode_ppk" placeholder="Tambahkan kode ppk disini.." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nama RS</label>
                            <input type="text" value="@if(isset($data->nama_rs)){{$data->nama_rs}}@endif" id="nama_rs" placeholder="Tambahkan nama RS disini.." class="form-control">
                        </div>
                        <div id="#msg_validation"></div>
                        <button id="btn_simpan" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 3000;
    });

    $('#btn_simpan').click(function() {
        if ($('#cons_id').val() == '') {
            toastr.error('Cons ID harus diisi');
            return;
        }
        if ($('#cons_secret').val() == '') {
            toastr.error('Cons secret harus diisi');
            return;
        }
        if ($('#user_key').val() == '') {
            toastr.error('User KEY harus diisi');
            return;
        }
        if ($('#kode_ppk').val() == '') {
            toastr.error('Kode PPK harus diisi');
            return;
        }
        if ($('#nama_rs').val() == '') {
            toastr.error('Nama RS harus diisi');
            return;
        }
        $.ajax({
            url: '{{ url("ajax_request/aplicare/post_credentials") }}',
            method: 'POST',
            data: {
                cons_id: $('#cons_id').val(),
                cons_secret: $('#cons_secret').val(),
                user_key: $('#user_key').val(),
                kode_ppk: $('#kode_ppk').val(),
                nama_rs: $('#nama_rs').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (!response.status) {
                    if (response.errors !== undefined) {
                        $.each(response.errors, function(key, val) {
                            toastr.error(val[0]);
                        });
                    }else{
                        toastr.error(response.message);
                    }
                }
                toastr.success(response.message);
            }
        })
    })
</script>
@endpush