@extends('layouts.app')
@section('content')
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah nama ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('nama_ruangan_igd/create') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Ruangan</label>
                        <input type="text" placeholder="Masukkan nama ruangan" required name="nama" class="form-control">
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
            <h1>Setting Dashboard</h1>
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
            <form class="card p-3" method="post" action="{{ url('nama_ruangan_igd/create') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label for="">Nama Ruangan</label>
                    <input value="@if(isset($data)){{ $data->alias }}@endif" class="form-control" name="nama" placeholder="Isikan nama ruangan IGD tersebut dengan Slug Ruangan IGD dari SIMRS">
                </div>
                <div class="form-group">
                    <label for="">Kabupaten</label>
                    <input value="@if(isset($data)){{ $data->kabupaten }}@endif" class="form-control" name="kab" placeholder="Isikan nama kabupaten">
                </div>
                <div class="form-group">
                    <label for="">Provinsi</label>
                    <input value="@if(isset($data)){{ $data->provinsi }}@endif" class="form-control" name="prov" placeholder="Isikan nama provinsi">
                </div>
                <div class="form-group" style="text-align: center;">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection