@extends('layouts.app')
@section('content')
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin-top: -15px;">
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Tambah Ruangan Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ruangan_pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required name="nama" placeholder=""
                                value="{{ old('nama') }}">
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
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Ubah Ruangan Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ruangan_pegawai.update', 0) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="text" hidden id="id_edit" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required name="nama" id="nama_edit"
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
                    <h4></h4>
                    @include('data_induk.nav_tab')
                    <div class="card-body">
                        <div class="card-header" style="margin-left:-25px ;">
                            <div class="card-header-form">
                                <form method="get" action="{{ route('ruangan_pegawai.search') }}">
                                    <div class="input-group">
                                        <input type="text" name="keyword" id="keyword" class="form-control"
                                            placeholder="Search" value="{{ $keyword }}">
                                        <div class="input-group-btn ml-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100%;" id="printTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th>
                                            <div class="row">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalAdd"><i class="fas fa-plus"></i></button>
                                                <button class="btn btn-info" onclick="downloadExcel()"
                                                    style="margin-left:3px ;"><i style="font-size:12pt;"
                                                        class="fa fa-print"></i></button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $dt)
                                        <tr>
                                            <td>{{ $dt->ruangan_pegawai }}</td>
                                            <td style="text-align:justify;">{{ $dt->keterangan }}</td>
                                            <td style="width:5%;">
                                                <div style="display: flex; flex-direction: row;">
                                                    <button onclick="showEditModal('{{ $dt->id }}')"
                                                        class="btn btn-warning mr-1"><i class="fa fa-pencil"></i></button>
                                                    <form action="{{ route('ruangan_pegawai.destroy', $dt->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Yakin melanjutkan hapus data {{ $dt->ruangan_pegawai }} ?')"
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
                                    Menampilkan data {{ $data->firstItem() }} to {{ $data->lastItem() }}, Page
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
                                {{ $data->links('pagination::bootstrap-4') }}
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
            var url = "{{ route('ruangan_pegawai.edit', ':id') }}";
            url = url.replace(':id', param);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                    $('#id_edit').val(response.id);
                    $('#nama_edit').val(response.ruangan_pegawai);
                    $('#keterangan_edit').val(response.keterangan);
                    $('#modalEdit').modal('show');
                }
            })
        }

        function downloadExcel() {
            var keyword = $('input[name=keyword]').val();
            var url = "{{ route('ruangan_pegawai.download') }}/?keyword=" + keyword;
            if (confirm("Apakah anda ingin melanjutkan download ?")) {
                window.location.href = url;
            } else {
                return false;
            }
        }
    </script>
@endsection
