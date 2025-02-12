@extends('layouts.app')
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pembuatan Invoice</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Invoice</h4>
                        <form class="card-header-form" action="{{ route('invoice.search') }}">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search"
                                    value="{{ $keyword }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error_message') }}
                                </div>
                            @endif
                            @if (Session::has('success_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('success_message') }}
                                </div>
                            @endif
                        </div>
                        <div class="">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>No.Invoice</th>
                                        <th>Tanggal</th>
                                        <th>Kode Vendor</th>
                                        <th>Nama Vendor</th>
                                        <th>Total Akhir</th>
                                        <th><a href="{{ route('invoice.create') }}" class="btn btn-primary"><i
                                                    class="fas fa-plus"></i> Buat Invoice</a></th>
                                    </tr>
                                </thead>
                                <tbody id="header-tbody">
                                    @if (sizeof($data) < 1)
                                        <tr class="text-center">
                                            <td colspan="7">Data tidak ditemukan.</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $d)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $d->no_invoice }}</td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                                <td class="text-center">{{ $d->kode_vendor }}</td>
                                                <td class="text-center">{{ $d->nama_vendor }}</td>
                                                <td class="text-center">{{ number_format($d->jml_bayar, 0, '.', '.') }}
                                                </td>
                                                <td class="text-center">

                                                    <form action="{{ route('invoice.destroy', $d->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a data-header="{{$d->id}}" data-toggle="tooltip" data-placement="top" title="Duplikasi" style="color: white; cursor: pointer;"
                                                            class="btn btn-info ml-1 duplikasi_button"><i class="fas fa-copy"></i></a>
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" style="" href="{{ route('invoice.edit', $d->id) }}"
                                                            class="btn btn-warning ml-1"><i class="fas fa-edit"></i></a>
                                                        <a data-toggle="tooltip" data-placement="top" title="Cetak" style="" target="_blank" href="{{ route('invoice.download', $d->id) }}"
                                                            class="btn btn-dark ml-1"><i class="fas fa-print"></i></a>
                                                        <button data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger ml-1"
                                                            onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 mb-3" style="display: flex; align-items: center;">
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
                        <div class="col-lg-6 mb-3" style="justify-content: flex-end; display: flex;">
                            {{ $data->appends(Request::only('keyword'))->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/invoice.js') }}"></script>

<script>
window.routeShowInvoice = "{{ route('invoice.show', ['invoice' => 'id_header']) }}";
window.routeShowDetail = "{{ route('invoice.edit', 'draft') }}";
</script>
@endsection
