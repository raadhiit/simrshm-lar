@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Setting Invoice</h1>
            </div>
            <div class="section-body">
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
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('invoice.setting_create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input class="form-control" type="text" name="nama_perusahaan" id="nama_perusahaan"
                                        placeholder="Silahkan isi text" value="{{ $data->nama_perusahaan ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label>Nama Penanggungjawab</label>
                                    <input class="form-control" type="text" name="nama_penanggungjawab" id="nama_penanggungjawab"
                                        placeholder="Silahkan isi text" value="{{ $data->nama_penanggungjawab ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input class="form-control" type="text" name="kota" id="kota"
                                        placeholder="Silahkan isi text" value="{{ $data->kota ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" type="text" name="alamat" id="alamat"
                                        placeholder="Silahkan isi text" value="{{ $data->alamat ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input class="form-control" type="file" name="logo" id="logo"
                                        accept=".jpg, .png" onchange="previewImage(this)" value="{{$data->nama_logo ?? ''}}" />
                                    <div id="showImage" class="mt-3"></div>
                                    <div id="imgNow">
                                        <img style="width: 25vw;" src="data:image/jpeg;base64,{{ $img }}"
                                            alt="">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script>
        function previewImage(input) {
            $('#imgNow').hide();
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var image = document.createElement('img');
                image.src = e.target.result;
                image.style.maxWidth = '100%';
                document.getElementById('showImage').innerHTML = '';
                document.getElementById('showImage').appendChild(image);
            };

            reader.readAsDataURL(file);
        }
    </script>
@endsection
