@extends('layouts.app')
@section('content')
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Organisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('satu_sehat/organisasi/store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tipe Organisasi</label>
                        <select name="tipe" id="tipe" class="form-control" required>
                            <option value="">--Select Here--</option>
                            @foreach($referensi as $ref)
                            <option value="{{$ref->id}}">{{$ref->display}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Organisasi</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Tambahkan nama organisasi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Active</label>
                        <select name="active" id="active" class="form-control" required>
                            <option value="">--Select Here--</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <input type="number" min="0" name="telepon" id="telepon" class="form-control" placeholder="Tambahkan telepon organisasi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Tambahkan email organisasi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" placeholder="Tambahkan alamat organisasi disini.." style="height: 100%;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Sub Bagian Dari</label>
                        <select name="part_of" id="part_of" class="form-control" required>
                            <option value="">--Select Here--</option>
                            <option value="{{env('IHS_RS')}}">{{env('NAMA_RS')}}</option>
                            @foreach($all_organisasi as $org)
                                <option value="{{$org->id_organisasi}}">{{$org->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Organisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('satu_sehat/organisasi/update') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="id_organisasi" id="edit_id_organisasi">
                <input type="hidden" name="_method" value="put">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tipe Organisasi</label>
                        <select name="tipe" id="edit_tipe" class="form-control" required>
                            <option value="">--Select Here--</option>
                            @foreach($referensi as $ref)
                            <option value="{{$ref->id}}">{{$ref->display}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Organisasi</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" placeholder="Tambahkan nama organisasi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Active</label>
                        <select name="active" id="edit_active" class="form-control" required>
                            <option value="">--Select Here--</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <input type="number" min="0" name="telepon" id="edit_telepon" class="form-control" placeholder="Tambahkan telepon organisasi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" placeholder="Tambahkan email organisasi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control" name="alamat" id="edit_alamat" cols="30" rows="5" placeholder="Tambahkan alamat organisasi disini.." style="height: 100%;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Sub Bagian Dari</label>
                        <select name="part_of" id="edit_part_of" class="form-control" required>
                            <option value="">--Select Here--</option>
                            <option value="{{env('IHS_RS')}}">{{env('NAMA_RS')}}</option>
                            @foreach($all_organisasi as $org)
                            <option value="{{$org->id_organisasi}}">{{$org->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Organisasi</h1>
        </div>

        <div class="section-body">
            <div class="card pt-3 pb-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    @if(Session::has('sukses'))
                    <div class="col-lg-12">
                        <div class="alert alert-success">{{Session::get('sukses')}}</div>
                    </div>
                    @endif
                    @if(Session::has('gagal'))
                    <div class="col-lg-12">
                        <div class="alert alert-danger">{{Session::get('gagal')}}</div>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-8">
                        <button class="btn btn-success" onclick="open_modal_add()"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <form class="col-lg-4" action="{{ url('satu_sehat/organisasi/rs') }}">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{$keyword}}" placeholder="Cari nama organisasi.." class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-12 pt-3 table-responsive">
                        <table class="table table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Tipe Organisasi</th>
                                    <th>Sub Bagian Dari</th>
                                    <th>Nama Organisasi</th>
                                    <th>Status</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($organisasi) < 1) <tr class="text-center">
                                    <td colspan="9">Data tidak ditemukan.</td>
                                    </tr>
                                    @else
                                    @foreach($organisasi as $org)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$org->tipe}}</td>
                                        <td>
                                            @if($org->part_of == env('IHS_RS'))
                                            {{env('NAMA_RS')}}
                                            @else
                                            {{$org->bagian_dari}}
                                            @endif
                                        </td>
                                        <td>{{$org->nama}}</td>
                                        <td>{{$org->aktif == 1 ? 'Aktif' : 'Tidak Aktif'}}</td>
                                        <td>{{$org->telepon}}</td>
                                        <td>{{$org->email}}</td>
                                        <td>{{$org->alamat}}</td>
                                        <td>
                                            <button class="btn btn-warning" onclick="open_modal_edit('{{$org->id}}')"><i class="fas fa-pencil-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="width: 100%; margin-left:0;">
                        <div class="col-lg-6" style="display: flex; align-items: center;">
                            @if(sizeof($organisasi) > 0)
                            Showing data {{$organisasi->firstItem()}} to {{$organisasi->lastItem()}}, Page {{ $organisasi->currentPage() }} of {{$organisasi->lastPage()}} @if($keyword != '') (Filtered) @endif
                            @else
                            Empty result @if($keyword != '') (Filtered) @endif
                            @endif
                        </div>
                        <div class="col-lg-6" style="justify-content: flex-end; display:flex;">
                            {{ $organisasi->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    function open_modal_add() {
        $('#modal_add').modal('show');
    }

    function open_modal_edit(param) {
        $.ajax({
            url: "{{ url('satu_sehat/organisasi/ajax_request/select_organisasi') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                $('#edit_id').val(response.id);
                $('#edit_id_organisasi').val(response.id_organisasi);
                $("#edit_tipe option:contains(" + response.tipe + ")").attr('selected', true);
                // $('#edit_tipe').val(response.tipe).change();
                $('#edit_nama').val(response.nama);
                $('#edit_active').val(response.aktif);
                $('#edit_telepon').val(response.telepon);
                $('#edit_email').val(response.email);
                $('#edit_alamat').val(response.alamat);
                $('#edit_part_of').val(response.part_of);
                $('#modal_edit').modal('show');
            }
        })
    }
</script>
@endpush