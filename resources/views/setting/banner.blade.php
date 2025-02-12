@extends('layouts.app')
<!-- Main Content -->
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Banner</h1>
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
            <form class="card p-3" method="post" action="{{ url('banner/create') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="second_content" id="second_content">
                <div class="form-group">
                    <label for="">Banner</label><br>
                    <input type="file" name="banner">
                </div>
                <div class="form-group">
                    <label for="">Konten Pertama</label><br>
                    <input type="text" value="<?php if (isset($banner)) {
                                                    echo $banner->first_content;
                                                } ?>" class="form-control" name="first_content" placeholder="Masukkan konten pertama" required>
                </div>
                <div class="form-group">
                    <label for="">Konten Kedua</label><br>
                    <div id="editor" style="height: 300px;"></div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <button class="btn btn-primary" onclick="setSecondContent()" type="submit">Simpan</button>
                </div>
                <!-- @if(isset($banner))
                <div class="col-lg-12 pl-0 pr-0" style="text-align: right;">
                    <?php
                    $status = '';
                    if ($banner->status == 1) {
                        $status = 'checked';
                    }
                    ?>
                    <input type="checkbox" id="statusbanner" onchange="aktivasiBanner()" data-toggle="toggle" {{$status}}>
                </div>
                <div class="col-lg-12 pl-0 pr-0 pt-2">
                    <img src="{{ asset('filebanner/'.$banner->name) }}" style="width: 100%;" alt="">
                </div>
                @endif -->
            </form>
        </div>
    </section>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var idbanner = 0;
    sc = '';

    $(document).ready(function() {
        <?php if (isset($banner)) { ?>
            idbanner = '{{ $banner->id }}';
            sc = '{{ $banner->second_content }}';
        <?php } ?>

        sc = ubah(sc);
        console.log(sc);

        var quill = new Quill('#editor', {
            theme: 'snow',
        });

        var myEditor = document.querySelector('#editor')
        myEditor.children[0].innerHTML = sc;
    })

    function ubah(param) {
        var ret = param.replace(/&gt;/g, '>');
        ret = ret.replace(/&lt;/g, '<');
        ret = ret.replace(/&quot;/g, '"');
        ret = ret.replace(/&apos;/g, "'");
        ret = ret.replace(/&amp;/g, '&');
        return ret;
    }

    function setSecondContent() {
        var edit = document.querySelector('#editor');
        var html = edit.children[0].innerHTML;
        document.getElementById('second_content').value = html;
        console.log(html);
    }

    function aktivasiBanner() {
        var checkbox = document.getElementById('statusbanner');
        $('#statusbanner').attr('disabled', true);
        var status = 0;
        var ubah = '';
        if (checkbox.checked != true) {
            status = 0;
            ubah = '';
        } else {
            status = 1;
            ubah = 'checked';
        }
        console.log(idbanner);
        $.ajax({
            url: '{{ url("ajax/ubah/banner") }}',
            data: {
                post_status: status,
                id_banner: idbanner
            },
            success: function(response) {
                console.log(response)
                if (response.status) {
                    $('#statusbanner').attr(ubah);
                    $('#statusbanner').removeAttr('disabled');
                } else {
                    $('#statusbanner').removeAttr('disabled');
                    alert('Gagal ubah status banner');
                }
            }
        })
    }
</script>