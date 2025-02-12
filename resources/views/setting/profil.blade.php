@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profil</h1>
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
            <form class="card p-3" method="post" action="{{ url('profil/create') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label for="">Logo</label><br>
                    <input type="file" name="logo">
                </div>
                <div class="form-group">
                    <label for="">Nama Perusahaan</label><br>
                    <input type="text" value="<?php if (isset($profil)) {
                                                    echo $profil->name;
                                                } ?>" class="form-control" name="nama" placeholder="Masukkan nama perusahaan" required>
                </div>
                <div class="form-group">
                    <label for="">Nickname Perusahaan</label><br>
                    <input type="text" value="<?php if (isset($profil)) {
                                                    echo $profil->nickname;
                                                } ?>" class="form-control" name="nickname" placeholder="Masukkan nickname perusahaan" required>
                </div>
                <div class="form-group" style="text-align: center;">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection