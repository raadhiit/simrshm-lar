@extends('layouts.app')
@section('content')
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin-top: -15px;">
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Tambah Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bagian.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body mt-3">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required name="nama" placeholder=""
                                value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text" class="form-control" required name="slug" placeholder=""
                                value="{{ old('slug') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" style="height:120px ;" name="keterangan" id="keterangan" cols="30" rows="10">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin-top: -15px;">
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Ubah Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bagian.update', 0) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" hidden id="id_edit" name="id">
                    <div class="modal-body mt-3">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required name="nama" id="nama_edit"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text" class="form-control" required name="slug" id="slug_edit"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" style="height:120px ;" name="keterangan" id="keterangan_edit" cols="30"
                                rows="10"></textarea>
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
                <h1>Data Induk</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="section-body">
                <div class="card">
                        @include('data_induk.nav_tab')
                        <h4></h4>
                    <div class="card-body">
                    <div class="card-header" style="margin-left: -25px;">
                        <div class="card-header-form">
                            <form method="get" action="{{ route('bagian.search') }}">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search"
                                        value="{{ $keyword }}">
                                    <div class="input-group-btn ml-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama</th>
                                        <th>Slug</th>
                                        <th>Keterangan</th>
                                        <th>
                                            <div class="row">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalAdd"><i class="fas fa-plus"></i></button>
                                                <button  onclick="downloadExcel()"class="btn btn-info"
                                                    style="margin-left:3px ;"><i style="font-size:12pt;"
                                                        class="fa fa-print"></i></button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $dt)
                                        <tr class="">
                                            <td>{{ $dt->nama }}</td>
                                            <td>{{ $dt->slug }}</td>
                                            <td style="text-align:justify;">{{ $dt->keterangan }}</td>
                                            <td style="width:5%;">
                                                <div style="display: flex; flex-direction: row;">
                                                    <button onclick="showEditModal('{{ $dt->id }}')"
                                                        class="btn btn-warning mr-1"><i class="fa fa-pencil"></i></button>
                                                    <form action="{{ route('bagian.destroy', $dt->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Yakin melanjutkan hapus data pengguna {{ $dt->nama }} ?')"
                                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="10">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3" style="width: 100%; margin-left:0;">
                            <div class="col-lg-6" style="display: flex; align-items: center;">
                                @if (sizeof($data) > 0)
                                    Showing data {{ $data->firstItem() }} to {{ $data->lastItem() }}, Page
                                    {{ $data->currentPage() }} of {{ $data->lastPage() }} @if ($keyword != '')
                                        (Filtered)
                                    @endif
                                @else
                                    Empty result @if ($keyword != '')
                                        (Filtered)
                                    @endif
                                @endif
                            </div>
                            <div class="col-lg-6" style="justify-content: flex-end; display: flex;">
                                {{ $data->appends(Request::only('keyword'))->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        function showEditModal(param) {
            var url = "{{ route('bagian.edit', ':id') }}";
            url = url.replace(':id', param);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                    $('#id_edit').val(response.id);
                    $('#nama_edit').val(response.nama);
                    $('#slug_edit').val(response.slug);
                    $('#keterangan_edit').val(response.keterangan);
                    $('#modalEdit').modal('show');
                },
                error: function(request, status, error) {
                    alert("Terjadi error saat edit data, silahkan hubungi admin");
                }
            })
        }

        function downloadExcel() {

            var keyword = $('input[name=keyword]').val();
            var url = "{{ route('bagian.download') }}/?keyword=" + keyword;
            if (confirm("Apakah anda ingin melanjutkan download ?")) {
                window.location.href = url;
            } else {
                return false;
            }
        }
    </script>
@endsection
