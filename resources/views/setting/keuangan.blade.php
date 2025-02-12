@extends('layouts.app')
<!-- Main Content -->
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Keuangan</h1>
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
            <form class="card p-3" method="post" action="{{ route('keuangan.create') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="deskripsi" id="deskripsi">
                <input type="hidden" name="id" id="id" value="{{$deskripsi->id ?? " "}}">
                <div class="form-group">
                    <label for="">Deskripsi <span style="opacity: 0.6;">(akan digunakan untuk footer pada dokumen yang akan dicetak)</span></label><br>
                    <div id="editor" style="height: 300px;"></div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <button class="btn btn-primary" onclick="setSecondContent()" type="submit">Simpan</button>
                </div>
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
        <?php if (isset($deskripsi)) { ?>
            idbanner = '{{ $deskripsi->id }}';
            sc = '{{ $deskripsi->deskripsi }}';
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
        document.getElementById('deskripsi').value = html;
        console.log(html);
    }

</script>
