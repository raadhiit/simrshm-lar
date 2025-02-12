@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Karyawan</h1>
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
                    <div class="card-body">
                        {{-- <div class="card-header" style="margin-left: -25px;"> --}}
                        {{--     <div class="card-header-form"> --}}
                        {{--         <form method="get" action="{{ route('bagian.search') }}"> --}}
                        {{--             <div class="input-group"> --}}
                        {{--                 <input type="text" name="keyword" class="form-control" placeholder="Search" --}}
                        {{--                     value="{{ $keyword }}"> --}}
                        {{--                 <div class="input-group-btn ml-2"> --}}
                        {{--                     <button type="submit" class="btn btn-primary"><i --}}
                        {{--                             class="fas fa-search"></i></button> --}}
                        {{--                 </div> --}}
                        {{--             </div> --}}
                        {{--         </form> --}}
                        {{--     </div> --}}
                        {{-- </div> --}}
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Tgl Masuk</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nomor Pegawai</th>
                                        <th>Pendidikan</th>
                                        <th>Bagian</th>
                                        <th>
                                            <div class="row">
                                                <a href="{{ route('data_karyawan.create') }}">
                                                    <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                                </a>
                                                {{-- <button  onclick="downloadExcel()"class="btn btn-info" --}}
                                                {{--     style="margin-left:3px ;"><i style="font-size:12pt;" --}}
                                                {{--         class="fa fa-print"></i></button> --}}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $dt)
                                        <tr class="">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($dt->tanggal_masuk)) }}</td>
                                            <td>{{ $dt->nama }}</td>
                                            <td>{{ $dt->jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
                                            <td style="">{{ $dt->kode }}</td>
                                            <td>{{ $dt->pendidikan }}</td>
                                            <td style="text-align:justify;">{{ $dt->unit_kerja }}</td>
                                            <td style="width:5%;">
                                                <div style="display: flex; flex-direction: row;">
                                                    <a href="{{ route('data_karyawan.edit', $dt->id) }}"
                                                        class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <form action="{{ route('data_karyawan.destroy', $dt->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Yakin melanjutkan hapus data {{ $dt->nama }} ?')"
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
