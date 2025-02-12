@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Referensi Organisasi</h1>
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
                    <div class="col-lg-12 pb-3">
                        <a href="{{ url('satu_sehat/organisasi/referensi_update') }}" class="btn btn-warning pull-right"><i class="fas fa-refresh"></i> Update</a>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Organisasi</th>
                                    <th>Tipe Organisasi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($organisasi) < 1) <tr class="text-center">
                                    <td colspan="4">Data tidak ditemukan.</td>
                                    </tr>
                                    @else
                                    @foreach($organisasi as $org)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$org->code}}</td>
                                        <td>{{$org->display}}</td>
                                        <td>{{$org->definition}}</td>
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