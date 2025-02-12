@extends('layouts.app')
<!-- Main Content -->
@section('content')
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('pengguna/create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Pengguna</label>
                        <input type="text" class="form-control" required name="nama" placeholder="Masukkan nama pengguna">
                    </div>
                    <div class="form-group">
                        <label for="">Username Pengguna</label>
                        <input type="text" class="form-control" required name="username" placeholder="Masukkan username pengguna">
                    </div>
                    <div class="form-group">
                        <label for="">Email Pengguna</label>
                        <input type="email" class="form-control" required name="email" placeholder="Masukkan email pengguna">
                    </div>
                    <div class="form-group">
                        <label for="">Authority</label>
                        <select name="authority" required class="form-control">
                            <option value="">--Select Here--</option>
                            <option value="user">User</option>
                            <option value="operator">Operator</option>
                            <option value="administrator">Administrator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Foto Pengguna</label><br>
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Ubah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('pengguna/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" id="edit_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Pengguna</label>
                        <input type="text" class="form-control" id="edit_nama" required name="nama" placeholder="Masukkan nama pengguna">
                    </div>
                    <div class="form-group">
                        <label for="">Username Pengguna</label>
                        <input type="text" class="form-control" id="edit_uname" required name="username" placeholder="Masukkan username pengguna">
                    </div>
                    <div class="form-group">
                        <label for="">Email Pengguna</label>
                        <input type="email" class="form-control" id="edit_email" required name="email" placeholder="Masukkan email pengguna">
                    </div>
                    <div class="form-group">
                        <label for="">Authority</label>
                        <select name="authority" id="edit_authority" required class="form-control">
                            <option value="">--Select Here--</option>
                            <option value="user">User</option>
                            <option value="operator">Operator</option>
                            <option value="administrator">Administrator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Foto Pengguna</label><br>
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pengguna</h1>
        </div>

        <div class="section-body">
            <div class="card">
                @if ($errors->any())
                <div class="col-lg-12 mt-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <div class="row mt-3" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-9">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <form method="get" action="{{ url('pengguna/cari') }}" class="col-lg-3" style="display: flex; justify-content: flex-end;">
                        <input type="text" class="form-control" placeholder="Masukkan keyword" value="{{$keyword}}" name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 mt-3 mb-3">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Authority</th>
                                    <th>Last IP</th>
                                    <th>Last Time</th>
                                    <th>Last Change</th>
                                    <th>Foto</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($user) < 1) <tr class="text-center">
                                    <td colspan="10">Tidak ada data</td>
                                    </tr>
                                    @else
                                    @foreach($user as $u)
                                    <tr class="text-center">
                                        <td>{{$u->realname}}</td>
                                        <td>{{$u->username}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>{{$u->authority}}</td>
                                        <td>{{$u->last_login_ip}}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($u->last_login_time)) }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($u->last_change)) }}</td>
                                        <td>{{$u->foto}}</td>
                                        <td></td>
                                        <td>
                                            <div style="display: flex; flex-direction: row;">
                                                <button onclick="showFormEditPengguna('{{$u->id}}')" class="btn btn-primary mr-1"><i class="fa fa-pencil"></i></button>
                                                <a href="{{ url('pengguna/delete?user_id='.$u->id) }}" onclick="return confirm('Yakin melanjutkan hapus data pengguna {{$u->realname}} ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3" style="width: 100%; margin-left:0;">
                        <div class="col-lg-6" style="display: flex; align-items: center;">
                            @if(sizeof($user) > 0)
                            Showing data {{$user->firstItem()}} to {{$user->lastItem()}}, Page {{ $user->currentPage() }} of {{$user->lastPage()}} @if($keyword != '') (Filtered) @endif
                            @else
                            Empty result @if($keyword != '') (Filtered) @endif
                            @endif
                        </div>
                        <div class="col-lg-6" style="justify-content: flex-end; display: flex;">
                            {{ $user->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    function showFormEditPengguna(param) {
        $.ajax({
            url: '{{ url("ajax_request/select/user") }}',
            data: {
                id_user: param
            },
            success: function(response) {
                console.log(response);
                if (response == null) {
                    return;
                }
                $('#edit_id').val(response.id);
                $('#edit_nama').val(response.realname);
                $('#edit_uname').val(response.username);
                $('#edit_email').val(response.email);
                $('#edit_authority').val(response.authority);
                $('#modalEdit').modal('show');
            }
        })
    }
</script>
@endsection