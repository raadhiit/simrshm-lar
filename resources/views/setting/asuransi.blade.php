@extends('layouts.app')
@section('content')
<div class="modal fade" id="modal_list_asuransi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pilih Asuransi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Asuransi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(sizeof($asuransi) < 1) <tr class="text-center">
                            <td colspan="3">Data tidak ditemukan</td>
                            </tr>
                            @else
                            @foreach($asuransi as $as)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$as->nama}}</td>
                                <td class="text-center">
                                    <a href="{{ url('asuransi/select?id='.$as->id) }}" class="btn btn-dark"><i class="fas fa-check"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Setting Asuransi</h1>
        </div>

        <div class="section-body">
            <div class="card pt-3 pb-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    @if(Session::has('sukses'))
                    <div class="col-lg-12">
                        <div class="alert alert-success text-center">
                            {{Session::get('sukses')}}
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal_list_asuransi"><i class="fas fa-pencil-alt"></i> Ubah</button>
                    </div>
                    <div class="col-lg-12 pt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Asuransi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($id)
                                <tr class="text-center">
                                    <td>1.</td>
                                    <td>{{$id->nama}}</td>
                                </tr>
                                @else
                                <tr class="text-center">
                                    <td colspan="3">Data tidak ditemukan</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
</script>
@endsection