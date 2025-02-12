@extends('layouts.app')
@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembuatan PO Jasa</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar PO Jasa</h4>
                    <form class="card-header-form" action="{{url('/pembelian/po-jasa/cari')}}">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{$keyword}}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        @if(Session::has('error_message'))
                        <div class="alert alert-danger">
                            {{ Session::get('error_message') }}
                        </div>
                        @endif
                        @if(Session::has('success_message'))
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
                                    <th>No.PO</th>
                                    <th>Tanggal</th>
                                    <th>Kode Vendor</th>
                                    <th>Nama Vendor</th>
                                    <th>Total Akhir</th>
                                    <th><a href="{{url('pembelian/po-jasa/po-mandiri')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Buat PO</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($data) < 1) <tr class="text-center">
                                    <td colspan="7">Data tidak ditemukan.</td>
                                    </tr>
                                    @else
                                    @foreach($data as $d)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$d->no_opl}}</td>
                                        <td class="text-center">{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                        <td class="text-center">{{$d->kode_vendor}}</td>
                                        <td class="text-center">{{$d->nama_vendor}}</td>
                                        <td class="text-center">{{number_format( $d->jml_bayar, 0 , '.' , ',' )}}</td>
                                        <td class="text-center">
                                            <a style="" href="{{ url('pembelian/po-jasa/lihat?id_header='.$d->id) }}" class="btn btn-info ml-1"><i class="fas fa-eye"></i></a>
                                            <a style="" href="{{ url('pembelian/po-jasa/edit?id_header='.$d->id) }}" class="btn btn-warning ml-1"><i class="fas fa-edit"></i></a>
                                            <a style="" href="{{ url('pembelian/po-jasa/hapus?id_header='.$d->id) }}" class="btn btn-danger ml-1" onclick="return confirm('Yakin melanjutkan hapus data ? data yang dihapus tidak bisa dikembalikan')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 mb-3" style="display: flex; align-items: center;">
                        @if(sizeof($data) > 0)
                        Showing data {{$data->firstItem()}} to {{$data->lastItem()}}, Page {{ $data->currentPage() }} of {{$data->lastPage()}} @if($keyword != '') (Filtered) @endif
                        @else
                        Empty result @if($keyword != '') (Filtered) @endif
                        @endif
                    </div>
                    <div class="col-lg-6 mb-3" style="justify-content: flex-end; display: flex;">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>


<script>
</script>
@endsection