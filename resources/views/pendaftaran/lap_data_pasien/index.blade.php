@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Lap. Data Pasien</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form class="row pt-3 pb-3" id="form_export" action="{{ url('registration/lap_data_pasien/export') }}" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Dari : </label>
                            <input type="date" id="tanggal_dari" name="tanggal_dari" value="{{ date('Y-m-d') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Sampai : </label>
                            <input type="date" id="tanggal_sampai" name="tanggal_sampai" value="{{ date('Y-m-d') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-3" style="padding-top: 30px;">
                        <button class="btn btn-success" type="submit"><i class="fa fa-file"></i> Export</button>
                    </div>
                </form>
            </div>      
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    let namafile = '';
    let last_page = 0;
    let iteration = 1;

    $('#btn_export').click(function(e){
        e.preventDefault();

        if($('#tanggal').val() == ''){
            alert('Tanggal harus dipilih');
            return;
        }

        iteration = 1;

        $.ajax({
            url : "{{ url('registration/lap_data_pasien/prepare_file_excel') }}",
            data : {
                'tanggal' : $('#tanggal').val()
            },
            success:function(response){
                if (response.status) {
                    namafile = response.namafile;
                    get_pasien();
                }
            }
        })
    })

    function get_pasien(namafile){
        $.ajax({
            url : "{{ url('registration/lap_data_pasien/data_pasien') }}",
            data : {
                'tanggal' : $('#tanggal').val()
            },
            success:function(response){
                last_page = response.last_page;
                write_file_excel(2);
            }
        })
    }

    function write_file_excel(last_row){
        $.ajax({
            url : "{{ url('registration/lap_data_pasien/write_file_excel') }}",
            data : {
                namafile : namafile,
                iteration : iteration,
                tanggal : $('#tanggal').val(),
                last_row : last_row
            },
            success:function(response){
                if (iteration < last_page) {
                    iteration++;
                    write_file_excel(response.last_row);
                }
            }
        })
    }
</script>
@endpush