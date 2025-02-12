@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jadwal Poli BPJS</h1>
        </div>

        <div class="section-body">
            <div class="card pt-3">
                <div class="row" style="width:100%; margin-left: 0;">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Kode Poli</label>
                            <select id="kode_poli" class="pilihan form-control">
                                <option value="">--Select Here--</option>
                                @foreach($kode_poli as $kp)
                                <option value="{{$kp->kode_poli}}">{{$kp->kode_poli}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" value="{{date('Y-m-d')}}" class="form-control" id="tanggal">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" style="padding-top:30px;">
                            <button class="btn btn-primary" id="btn_tampil">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card pt-3">
                <div class="row" style="width:100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Kapasitas Pasien</th>
                                    <th>Jadwal</th>
                                    <th>Sub Spesialis</th>
                                    <th>Dokter</th>
                                    <th>Poli</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                <tr class="text-center">
                                    <td colspan="7">Pilih kode poli dan tanggal dahulu.</td>
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
        return '<tr class="text-center">' +
            '<td colspan="7">' +
            '<div class="spinner-border spinner-border-sm mr-1" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' + param +
            '</td>' +
            '</tr>';
    }

    $(document).ready(function() {
        $('.pilihan').select2({
            theme: 'bootstrap4'
        });
    });

    $('#btn_tampil').click(function() {
        if ($('#kode_poli').val() == '') {
            toastr.error('Pilih kode poli terlebih dahulu');
        } else if ($('#tanggal').val() == '') {
            toastr.error('Pilih tanggal terlebih dahulu');
        } else {
            $('#list').html(loading('Sedang mengambil data'));
            $.ajax({
                url: "{{ url('ajax_request/referensi_jadwal_dokter') }}",
                data: {
                    kode_poli: $('#kode_poli').val(),
                    tanggal: $('#tanggal').val()
                },
                success: function(response) {
                    if (!response.status) {
                        toastr.error(response.message);
                    } else {
                        if (response.data.length < 1) {
                            $('#list').html('<tr class="text-center"><td colspan="7">Tidak ada data.</td></tr>');
                        } else {
                            var ins = '';
                            for (let i = 0; i < response.data.length; i++) {
                                ins += '<tr class="text-center">' +
                                    '<td>' + (i + 1) + '</td>' +
                                    '<td>' + response.data[i].namahari + '</td>' +
                                    '<td>' + response.data[i].kapasitaspasien + '</td>' +
                                    '<td>' + response.data[i].jadwal + '</td>' +
                                    '<td>' + response.data[i].namasubspesialis + '</td>' +
                                    '<td>' + response.data[i].namadokter + '</td>' +
                                    '<td>' + response.data[i].namapoli + '</td>' +
                                    '</tr>';
                            }
                            $('#list').html(ins);
                        }
                    }
                }
            })
        }
    })
</script>
@endpush