@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<!-- End Modal Edit -->
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Rekap Antrian</h1>
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
                            <label>Dari</label>
                            <input class="form-control" value="{{date('Y-m-d')}}" id="dari" type="date"></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Sampai</label>
                            <input class="form-control" value="{{date('Y-m-d')}}" id="sampai" type="date"></input>
                        </div>
                    </div>
                    <div class="col-lg-4" style="display: flex;padding-top:30px;">
                        <div class="form-group mr-1">
                            <button class="btn btn-primary" onclick="search()">Terapkan</button>
                        </div>
                        <form action="{{ url('antrian/rekap/export') }}">
                            <input type="hidden" value="{{date('Y-m-d')}}" name="dari" id="hide_dari">
                            <input type="hidden" value="{{date('Y-m-d')}}" name="sampai" id="hide_sampai">
                            <button class="btn btn-success" type="submit">Export</button>
                        </form>
                    </div>
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped" id="tabel_list">
                            <thead>
                                <tr class="text-center">
                                    <th>Tanggal</th>
                                    <th>Nama Poli</th>
                                    <th>Kode Booking</th>
                                    <th>Nomor Antrian</th>
                                    <th>Nama Pasien</th>
                                    <th>No. RM</th>
                                    <th>Task 1</th>
                                    <th>Task 2</th>
                                    <th>Task 3</th>
                                    <th>Task 4</th>
                                    <th>Task 5</th>
                                    <th>Task 6</th>
                                    <th>Task 7</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card pt-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <p>
                            Keterangan :
                            <br>
                            1 (mulai waktu tunggu admisi), <br>
                            2 (akhir waktu tunggu admisi/mulai waktu layan admisi), <br>
                            3 (akhir waktu layan admisi/mulai waktu tunggu poli), <br>
                            4 (akhir waktu tunggu poli/mulai waktu layan poli), <br>
                            5 (akhir waktu layan poli/mulai waktu tunggu farmasi), <br>
                            6 (akhir waktu tunggu farmasi/mulai waktu layan farmasi membuat obat), <br>
                            7 (akhir waktu obat selesai dibuat),
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $('#dari').change(function() {
        $('#hide_dari').val($('#dari').val());
    })

    $('#sampai').change(function() {
        $('#hide_sampai').val($('#sampai').val());
    })

    $(document).ready(function() {
        $('#tabel_list').DataTable({
            serverSide: 'true',
            processing: 'true',
            pagingType: "full",
            deferRender: 'true',
            ajax: '../ajax_request/datatable_rekap_antrian/' + $('#dari').val() + '/' + $('#sampai').val(), // memanggil route yang menampilkan data json
            columns: [{
                    data: 'tanggalperiksa',
                    name: 'tanggalperiksa',
                    render(data, type, row) {
                        if (data != '' && data != null) {
                            var temp = data.split('-');
                            return temp[2] + '-' + temp[1] + '-' + temp[0];
                        }
                        return '';
                    }
                },
                {
                    data: 'namapoli',
                    name: 'namapoli'
                },
                {
                    data: 'kodebooking',
                    name: 'kodebooking'
                },
                {
                    data: 'nomorantrean',
                    name: 'nomorantrean',
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'norm',
                    name: 'norm',
                },
                {
                    data: 'waktu_checkin',
                    name: 'waktu_checkin',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            if (row.pasien_baru == 1) {
                                var wkt = new Date(temp)
                                return convert_waktu(wkt);
                            }
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_dua',
                    name: 'waktu_taskid_dua',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_checkin',
                    name: 'waktu_checkin',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            if (row.pasien_baru == 0) {
                                var wkt = new Date(temp)
                                return convert_waktu(wkt);
                            } else {
                                if (row.waktu_taskid_tiga != '' && row.waktu_taskid_tiga != null) {
                                    var tiga = new Date(parseInt(row.waktu_taskid_tiga));
                                    return convert_waktu(tiga);
                                }
                                return '';
                            }
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_empat',
                    name: 'waktu_taskid_empat',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_lima',
                    name: 'waktu_taskid_lima',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_enam',
                    name: 'waktu_taskid_enam',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_tujuh',
                    name: 'waktu_taskid_tujuh',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                }
            ]
        });
    })

    function convert_waktu(param) {
        return param.getDate() + '-' + (param.getMonth() + 1) + '-' + param.getFullYear() + ' ' + param.getHours() + ':' + param.getMinutes() + ':' + param.getSeconds();
    }

    function search() {
        if ($('#dari').val() == '') {
            alert('Pilih tanggal dari terlebih dahulu');
            return;
        }
        if ($('#sampai').val() == '') {
            alert('Pilih tanggal sampai terlebih dahulu');
            return;
        }

        if ($.fn.DataTable.isDataTable("#tabel_list")) {
            $('#tabel_list').DataTable().clear().destroy();
        }

        $('#tabel_list').DataTable({
            serverSide: 'true',
            processing: 'true',
            pagingType: "full",
            deferRender: 'true',
            ajax: '../ajax_request/datatable_rekap_antrian/' + $('#dari').val() + '/' + $('#sampai').val(), // memanggil route yang menampilkan data json
            columns: [{
                    data: 'tanggalperiksa',
                    name: 'tanggalperiksa',
                    render(data, type, row) {
                        if (data != '' && data != null) {
                            var temp = data.split('-');
                            return temp[2] + '-' + temp[1] + '-' + temp[0];
                        }
                        return '';
                    }
                },
                {
                    data: 'namapoli',
                    name: 'namapoli'
                },
                {
                    data: 'kodebooking',
                    name: 'kodebooking'
                },
                {
                    data: 'nomorantrean',
                    name: 'nomorantrean',
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'norm',
                    name: 'norm',
                },
                {
                    data: 'waktu_checkin',
                    name: 'waktu_checkin',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            if (row.pasien_baru == 1) {
                                var wkt = new Date(temp)
                                return convert_waktu(wkt);
                            }
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_dua',
                    name: 'waktu_taskid_dua',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_checkin',
                    name: 'waktu_checkin',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            if (row.pasien_baru == 0) {
                                var wkt = new Date(temp)
                                return convert_waktu(wkt);
                            } else {
                                if (row.waktu_taskid_tiga != '' && row.waktu_taskid_tiga != null) {
                                    var tiga = new Date(parseInt(row.waktu_taskid_tiga));
                                    return convert_waktu(tiga);
                                }
                                return '';
                            }
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_empat',
                    name: 'waktu_taskid_empat',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_lima',
                    name: 'waktu_taskid_lima',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_enam',
                    name: 'waktu_taskid_enam',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'waktu_taskid_tujuh',
                    name: 'waktu_taskid_tujuh',
                    render(data, type, row) {
                        var temp = parseInt(data);
                        if (data != '' && data != null) {
                            var wkt = new Date(temp)
                            return convert_waktu(wkt);
                        }
                        return '';
                    }
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                }
            ]
        });
    }
</script>
@endpush