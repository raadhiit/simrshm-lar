@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Practioner</h1>
            </div>

            <div class="section-body">
                <div class="card pt-3 pb-3">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        @if (Session::has('sukses'))
                            <div class="col-lg-12">
                                <div class="alert alert-success">{{ Session::get('sukses') }}</div>
                            </div>
                        @endif
                        @if (Session::has('gagal'))
                            <div class="col-lg-12">
                                <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
                            </div>
                        @endif
                        <div class="col-lg-12">
                            <table class="table table-striped" id="tabel_practioner" style="width: 100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Nomor IHS</th>
                                        <th>Alamat</th>
                                        <th>Ruangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
        $(document).ready(function(){
            get_data_practioner();
        })

        function get_data_practioner() {
            if ($.fn.DataTable.isDataTable("#tabel_practioner")) {
                $('#tabel_practioner').DataTable().clear().destroy();
            }

            $('#tabel_practioner').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                bLengthChange: false,
                ajax: "{{ url('satu_sehat/practioner_datatable') }}", // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: null,
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart +
                                1) + '</div>';
                        }
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'noktp',
                        name: 'noktp'
                    },
                    {
                        data: 'ihs_number',
                        name: 'ihs_number'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'ruangan_pegawai',
                        name: 'ruangan_pegawai'
                    },
                    {
                        data: 'noktp',
                        name: 'noktp',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center">'+
                                '<button class="btn btn-warning" onclick="get_ihs_number('+"'"+data+"'"+')"><i class="fa fa-pencil"></i></button>'+
                                '</div>';
                        }
                    }
                ],
            })
        }

        function get_ihs_number(param){
            $.ajax({
                url : "{{ url('satu_sehat/ajax_request/get_ihs_number') }}",
                data : {
                    nik : param
                },
                success:function(response){
                    if(!response.status){
                        toastr.error(response.message);
                        return;
                    }
                    toastr.success(response.message);
                    get_data_practioner();
                }
            })
        }
    </script>
@endpush
