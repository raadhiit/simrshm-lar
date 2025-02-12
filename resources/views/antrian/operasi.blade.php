@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<div class="modal fade" id="modalListPasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">List Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <table class="table" id="tabelListPasien" style="width: 100%;">
                    <thead>
                        <tr class="text-center">
                            <th>No. RM</th>
                            <th>No. KTP</th>
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <th>No. BPJS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalListEditPasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">List Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <table class="table" id="tabelListEditPasien" style="width: 100%;">
                    <thead>
                        <tr class="text-center">
                            <th>No. RM</th>
                            <th>No. KTP</th>
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <th>No. BPJS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="modal_add" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jadwal Operasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('antrian/operasi/post') }}" method="post">
                @csrf
                <div class="modal-body">
                <div class="form-group">
                        <label for="">Jenis Pasien</label>
                        <select id="jenis_pasien" name="jenis_pasien" class="form-control" required>
                            <option value="">--Select Here--</option>
                            @foreach($jenis_pasien as $jp)
                            <option value="{{$jp->nama}}">{{$jp->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Kartu</label>
                        <div class="input-group">
                            <input type="number" placeholder="Nomor BPJS" id="bpjs" min="0" class="form-control" name="nomor_kartu">
                            <div class="input-group-append">
                                <button type="button" id="btn_list_pasien" class="btn btn-primary"><i class="fas fa-list"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">No. RM</label>
                        <input type="text" name="nrm" id="nrm" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">No. KTP</label>
                        <input type="text" id="ktp" name="ktp" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pasien</label>
                        <input type="text" name="pasien" id="pasien" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" id="alamat" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Operasi</label>
                        <input type="date" name="tanggal_operasi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Poli</label>
                        <select name="poli" id="poli" class="form-control pilihan" required>
                            <option value="">--Select Here--</option>
                            @foreach($poli_local as $pl)
                            <option value="{{$pl->nama}}">{{$pl->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Poli BPJS</label>
                        <select name="poli_bpjs" id="poli_bpjs" class="form-control pilihan" required>
                            <option value="">--Select Here--</option>
                            @foreach($poli_bpjs as $pb)
                            <option value="{{$pb->kode_poli}}">{{$pb->kode_poli.' - '.$pb->nama_sub_spesialis}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Tindakan</label>
                        <input type="text" placeholder="Jenis tindakan" name="jenis_tindakan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Add -->

<!-- Modal Edit -->
<div class="modal fade" id="modal_edit" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Jadwal Operasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('antrian/operasi/update') }}" method="post">
                @csrf
                <input type="hidden" name="kodebooking" id="edit_kode_booking">
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                <div class="form-group">
                        <label for="">Jenis Pasien</label>
                        <select id="edit_jenis_pasien" name="jenis_pasien" class="form-control" required>
                            <option value="">--Select Here--</option>
                            @foreach($jenis_pasien as $jp)
                            <option value="{{$jp->nama}}">{{$jp->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Kartu</label>
                        <div class="input-group">
                            <input type="number" placeholder="Nomor BPJS" min="0" id="edit_nomor_kartu" class="form-control" name="nomor_kartu">
                            <div class="input-group-append">
                                <button type="button" id="btn_list_edit_pasien" class="btn btn-primary"><i class="fas fa-list"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">No. RM</label>
                        <input type="text" id="edit_nrm" name="nrm" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">No. KTP</label>
                        <input type="text" id="edit_ktp" name="ktp" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pasien</label>
                        <input type="text" id="edit_pasien" name="pasien" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" id="edit_alamat" name="alamat" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Operasi</label>
                        <input type="date" name="tanggal_operasi" id="edit_tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Poli</label>
                        <select name="poli" id="edit_poli" class="form-control pilihan" required>
                            <option value="">--Select Here--</option>
                            @foreach($poli_local as $pl)
                            <option value="{{$pl->nama}}">{{$pl->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Poli BPJS</label>
                        <select name="poli_bpjs" id="edit_poli_bpjs" class="form-control pilihan" required>
                            <option value="">--Select Here--</option>
                            @foreach($poli_bpjs as $pb)
                            <option value="{{$pb->kode_poli}}">{{$pb->kode_poli.' - '.$pb->nama_sub_spesialis}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Tindakan</label>
                        <input type="text" placeholder="Jenis tindakan" id="edit_jenis_tindakan" name="jenis_tindakan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Edit -->
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Antrian Operasi</h1>
        </div>

        <div class="section-body">
            <div class="card pt-3">
                <form class="row" style="width: 100%; margin-left: 0;" action="{{ url('antrian/operasi') }}">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Dari</label>
                            <input type="date" value="{{ $dari ? date('Y-m-d', strtotime($dari)) : date('Y-m-d') }}" name="dari" id="dari" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Sampai</label>
                            <input type="date" value="{{ $sampai ? date('Y-m-d', strtotime($sampai)) : date('Y-m-d') }}" name="sampai" id="sampai" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Status Terlaksana</label>
                            <select id="status" name="status" class="form-control">
                                <option value="">--Select Here--</option>
                                <option value="0" {{ isset($status) ? $status == '0' ? 'selected' : '' : '' }}>Belum Terlaksana</option>
                                <option value="1" {{ isset($status) ? $status == '1' ? 'selected' : '' : '' }}>Terlaksana</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 pb-3 text-center">
                        <button class="btn btn-primary" type="submit">Terapkan</button>
                    </div>
                </form>
            </div>
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
                    <div class="col-lg-12 pb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal_add"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <div class="col-lg-12 table-responsive" style="overflow-x: scroll;">
                        <table class="table table-striped" style="width: 2000px;">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Booking</th>
                                    <th>No. BPJS</th>
                                    <th>No. KTP</th>
                                    <th>No. RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat</th>
                                    <th>Poli</th>
                                    <th>Jenis Tindakan</th>
                                    <th>Jenis Pasien</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                @if(sizeof($antrian) < 1) <tr class="text-center">
                                    <td colspan="13">Data tidak ditemukan</td>
                                    </tr>
                                    @else
                                    @foreach($antrian as $ant)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{date('d-m-Y', strtotime($ant->tanggaloperasi))}}</td>
                                        <td>{{$ant->kodebooking}}</td>
                                        <td>{{$ant->nopeserta}}</td>
                                        <td>{{$ant->ktp}}</td>
                                        <td>{{$ant->id_pasien}}</td>
                                        <td>{{$ant->nama}}</td>
                                        <td>{{$ant->alamat}}</td>
                                        <td>{{$ant->namapoli}}</td>
                                        <td>{{$ant->jenistindakan}}</td>
                                        <td>{{$ant->pasien_bpjs}}</td>
                                        <td class="text-center">
                                            @if($ant->terlaksana == 0)
                                            {{ 'Belum Terlaksana' }}
                                            @else
                                            {{'Terlaksana'}}
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display: inline-flex;">
                                                <button class="btn btn-success mr-1" onclick="panggil('{{$ant->kodebooking}}')">Panggil</button>
                                                <a href="{{url('antrian/operasi/laksanakan?id='.$ant->id)}}" class="btn btn-dark mr-1" style="display: inline-flex; align-items: center;"><i class="fas fa-check mr-1"></i> Laksanakan</a>
                                                <button class="btn btn-warning mr-1" onclick="show_modal_edit('{{$ant->id}}')" style="display: inline-flex; align-items: center;"><i class="fas fa-pencil-alt mr-1"></i> Ubah</button>
                                                <a onclick="return confirm('Yakin melanjutkan hapus data ? data yang dihappus tidak dapat dikembalikan')" href="{{url('antrian/operasi/delete?id='.$ant->id)}}" class="btn btn-danger" style="display: inline-flex; align-items: center;"><i class="fas fa-trash mr-1"></i> Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 mb-3 panel_pagination" style="display: flex; align-items: center;">
                        @if(sizeof($antrian) > 0)
                        Showing data {{$antrian->firstItem()}} to {{$antrian->lastItem()}}, Page {{ $antrian->currentPage() }} of {{$antrian->lastPage()}} @if($keyword != '') (Filtered) @endif
                        @else
                        Empty result @if($keyword != '') (Filtered) @endif
                        @endif
                    </div>
                    <div class="col-lg-6 mb-3 panel_pagination" style="justify-content: flex-end; display: flex;">
                        {{ $antrian->links('pagination::bootstrap-4') }}
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
    function loading(param) {
        return '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' + param;
    }

    let synth = window.speechSynthesis;
    // let model_suara = [];

    // setInterval(function(){
    //     model_suara = synth.getVoices();
    // },1000)
    $('#btn_list_pasien').click(function() {
        $('#modal_add').modal('hide');
        $('#modalListPasien').modal('show');
    })

    $('#btn_list_edit_pasien').click(function() {
        $('#modal_edit').modal('hide');
        $('#modalListEditPasien').modal('show');
    })

    function panggil(nomor) {
        $.ajax({
            url: "{{ url('ajax_request/send_broadcast') }}",
            method: 'post',
            data: {
                loket: '',
                nomor: nomor,
                bagian: 'operasi',
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response) {
                    var msg = new SpeechSynthesisUtterance('Kode booking. ' + nomor + '. Silahkan menuju ruangan operasi.');
                    msg.rate = 0.9;
                    msg.pitch = 1;
                    // msg.voice = model_suara[$('#model').val()];
                    msg.lang = 'id-ID';
                    synth.speak(msg);
                }
            }
        })
    }

    // function search_data() {
    //     window.event.preventDefault();
    //     if ($('#dari').val() == '') {
    //         alert('Pilih tanggal dari terlebih dahulu');
    //         return;
    //     }
    //     if ($('#sampai').val() == '') {
    //         alert('Pilih tanggal sampai terlebih dahulu');
    //         return;
    //     }
    //     $('.panel_pagination').html('');
    //     $('#list').html('<tr><td colspan="13" style="color:#111;" class="text-center">' + loading("Sedang mengambil data...") + '</td></tr>');
    //     $.ajax({
    //         url: "{{ url('ajax_request/get_operasi') }}",
    //         data: {
    //             dari: $('#dari').val(),
    //             sampai: $('#sampai').val(),
    //             status: $('#status').val(),
    //         },
    //         success: function(response) {
    //             console.log(response);
    //             if (response.length < 1) {
    //                 $('#list').html('<tr><td colspan="13" style="color:#111;" class="text-center">Data tidak ditemukan</td></tr>');
    //                 return;
    //             }
    //             var ins = '';
    //             for (let i = 0; i < response.length; i++) {
    //                 var terlaksana = response[i].terlaksana == 1 ? 'Terlaksana' : 'Belum Terlaksana';
    //                 ins += '<tr>' +
    //                     '<td class="text-center">' + (i + 1) + '</td>' +
    //                     '<td>' + formatTanggalJam(response[i].tanggaloperasi) + '</td>' +
    //                     '<td>' + response[i].kodebooking + '</td>' +
    //                     '<td>' + response[i].nopeserta + '</td>' +
    //                     '<td>' + response[i].id_pasien + '</td>' +
    //                     '<td>' + response[i].ktp + '</td>' +
    //                     '<td>' + response[i].nama + '</td>' +
    //                     '<td>' + response[i].alamat + '</td>' +
    //                     '<td>' + response[i].namapoli + '</td>' +
    //                     '<td>' + response[i].jenistindakan + '</td>' +
    //                     '<td>' + response[i].pasien_bpjs + '</td>' +
    //                     '<td class="text-center">' + terlaksana + '</td>' +
    //                     '<td>' +
    //                     '<div style="display: inline-flex;">' +
    //                     '<button class="btn btn-success mr-1" onclick="panggil(' + "'" + response[i].kodebooking + "'" + ')">Panggil</button>' +
    //                     '<a href="./operasi/laksanakan?id=' + response[i].id + '" class="btn btn-dark mr-1" style="display: inline-flex; align-items: center;"><i class="fas fa-check mr-1"></i> Laksanakan</a>' +
    //                     '<button class="btn btn-warning mr-1" onclick="show_modal_edit(' + response[i].id + ')" style="display: inline-flex; align-items: center;"><i class="fas fa-pencil-alt mr-1"></i> Ubah</button>' +
    //                     '<a onclick="return konfirmasi_hapus()" href="./operasi/delete?id=' + response[i].id + '" class="btn btn-danger" style="display: inline-flex; align-items: center;"><i class="fas fa-trash mr-1"></i> Hapus</a>' +
    //                     '</div>' +
    //                     '</td>' +
    //                     '</tr>';
    //                 $('#list').html(ins);
    //             }
    //         }
    //     })
    //}

    function konfirmasi_hapus() {
        if (!confirm('Yakin melanjutkan hapus data ? data yang dihapus tidak dapat dikembalikan')) {
            return false;
        }
    }

    $(document).ready(function() {
        $('.pilihan').select2({
            theme: 'bootstrap4'
        })

        $('#tabelListPasien').DataTable({
            serverSide: 'true',
            processing: 'true',
            pagingType: "full",
            deferRender: 'true',
            ajax: '{{ url("ajax_request/datatable_pasien") }}', // memanggil route yang menampilkan data json
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'ktp',
                    name: 'ktp'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'nobpjs',
                    name: 'nobpjs'
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center"><button onclick='setPasien(` + `"` + row.nama + `","` + data + `","` + row.alamat + `","` + row.nobpjs + `","` + row.ktp + `"` + `)' class="btn btn-dark"><i class="fas fa-check"></i></button></div>`;
                    }
                }
            ]
        });

        $('#tabelListEditPasien').DataTable({
            serverSide: 'true',
            processing: 'true',
            pagingType: "full",
            deferRender: 'true',
            ajax: '{{ url("ajax_request/datatable_pasien") }}', // memanggil route yang menampilkan data json
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'ktp',
                    name: 'ktp'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'nobpjs',
                    name: 'nobpjs'
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center"><button onclick='setEditPasien(` + `"` + row.nama + `","` + data + `","` + row.alamat + `","` + row.nobpjs + `","` + row.ktp + `"` + `)' class="btn btn-dark"><i class="fas fa-check"></i></button></div>`;
                    }
                }
            ]
        });
    });

    function setPasien(nama, nrm, alamat, bpjs,ktp) {
        $('#bpjs').val(bpjs);
        $('#pasien').val(nama);
        $('#nrm').val(nrm);
        $('#ktp').val(ktp);
        $('#alamat').val(alamat);
        $('#modalListPasien').modal('hide');
        $('#modal_add').modal('show');
    }

    function setEditPasien(nama, nrm, alamat, bpjs,ktp) {
        $('#edit_nomor_kartu').val(bpjs);
        $('#edit_pasien').val(nama);
        $('#edit_nrm').val(nrm);
        $('#edit_ktp').val(ktp);
        $('#edit_alamat').val(alamat);
        $('#modalListEditPasien').modal('hide');
        $('#modal_edit').modal('show');
    }

    function formatTanggalJam(param) {
        var tmp1 = param.split(' ');
        var tmp2 = tmp1[0].split('-');
        if (tmp1[1]) {
            return tmp2[2] + '-' + tmp2[1] + '-' + tmp2[0] + ' ' + tmp1[1]
        }
        return tmp2[2] + '-' + tmp2[1] + '-' + tmp2[0];
    }

    function show_modal_edit(param) {
        $.ajax({
            url: "{{ url('ajax_request/antrian_operasi_rs') }}",
            data: {
                id: param
            },
            success: function(response) {
                console.log(response);
                if (response == null) {
                    return;
                }
                $('#edit_pasien').val(response.nama);
                $('#edit_nrm').val(response.id_pasien);
                $('#edit_jenis_pasien').val(response.pasien_bpjs).trigger('change');
                $('#edit_ktp').val(response.ktp);
                $('#edit_alamat').val(response.alamat);
                $('#edit_kode_booking').val(response.kodebooking);
                $('#edit_tanggal').val(response.tanggaloperasi);
                $('#edit_nomor_kartu').val(response.nopeserta);
                $('#edit_poli').val(response.namapoli).trigger('change');
                $('#edit_poli_bpjs').val(response.kodepoli).trigger('change');
                $('#edit_jenis_tindakan').val(response.jenistindakan);
                $('#modal_edit').modal('show');
            }
        })
    }
</script>
@endpush