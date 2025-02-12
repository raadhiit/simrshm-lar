@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>E-Rekam Medis Rawat Jalan</h1>
            </div>

            <div class="section-body">
                <div class="card pt-3 pb-3">
                    <form id="filter" class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Jenis Rawat</label>
                                <select name="uri" id="uri" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="0" selected>Rawat Jalan</option>
                                    <option value="1">Rawat Inap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Poli</label>
                                <select name="poli" id="poli" class="form-control">
                                    <option value="">--Select Here--</option>
                                    @foreach ($poli as $p)
                                        <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">--Select Here--</option>
                                    <option value="0" selected>Aktif</option>
                                    <option value="1">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Dokter</label>
                                <select name="dokter" id="dokter" class="form-control">
                                    <option value="">--Select Here--</option>
                                    @foreach ($dokter as $d)
                                        <option value="{{ $d->nama }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input class="form-control" name="tanggal" type="date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-lg-2" style="padding-top: 30px;">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </form>
                </div>
                <div class="card pt-3 pb-3">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-12 table-responsive">
                            <table id="tabel_pasien" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nomor Antrian</th>
                                        <th>Nama Dokter</th>
                                        <th>Poli</th>
                                        <th>Nama Pasien</th>
                                        <th>No. RM</th>
                                        <th>No. BPJS</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script>
            $('document').ready(function() {
                $('#dokter').select2();
                $('#poli').select2();
                $('#tabel_pasien').DataTable();
                $('#filter').submit();
            })

            $('#filter').submit(function(e) {
                e.preventDefault();

                if($('[name=status]').val() == '1' || $('[name=status]').val() == ''){
                    if ($('[name=tanggal]').val() == '') {
                        toastr.error('Tanggal harus dipilih');
                        return;
                    }
                }
                
                if ($.fn.DataTable.isDataTable('#tabel_pasien')) {
                    $('#tabel_pasien').dataTable().fnClearTable();
                    $('#tabel_pasien').dataTable().fnDestroy();
                }

                $('#tabel_pasien').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '../ajax_request/filter_erm_rajal?'+$('#filter').serialize(),
                    columns: [{
                            data: null,
                            name:null,
                            orderable: false,
                            searchable:false,
                            render: function(data, type, row, meta) {
                                return '<div class="text-center">'+(meta.row + meta.settings._iDisplayStart + 1)+'</div>';
                            }
                        },
                        {
                            data: 'no_kunjungan',
                            name: 'no_kunjungan'
                        },
                        {
                            data: 'nama_dokter',
                            name: 'nama_dokter'
                        },
                        {
                            data: 'last_nama_ruangan',
                            name: 'last_nama_ruangan'
                        },
                        {
                            data: 'nama_pasien',
                            name: 'nama_pasien'
                        },
                        {
                            data: 'nrm',
                            name: 'nrm'
                        },
                        {
                            data: 'nobpjs',
                            name: 'nobpjs'
                        },
                        {
                            data: 'selesai',
                            name: 'selesai',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                let temp = data == 0 ? 'Aktif' : 'Tidak Aktif';
                                return temp;
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return '<div class="text-center"><a href="./rawat_jalan/detail?nrm='+row.nrm+'" class="btn btn-success"><i class="fa fa-edit"></i></a></div>';
                            }
                        },
                    ]
                });
            })
        </script>
    @endpush
@endsection
