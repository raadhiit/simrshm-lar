@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Selamat Datang</h1>
        </div>

        <div class="section-body">
            @if($banner != null)
            <div class="card pt-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <img src="{{ asset('filebanner/'.$banner->name) }}" alt="" style="width: 100%;">
                    </div>
                    <div class="col-lg-12 pt-3">
                        <h2 class="text-center">Welcome back, {{Auth::user()->realname}}</h2>
                        <p style="text-align: center; font-size: 20px;">{{$banner->first_content}}</p>
                    </div>
                    <div class="col-lg-12">
                        <div id="second"></div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        <?php if (isset($banner)) { ?>
            var sc = '<?php echo $banner->second_content ?>';

            $('#second').html(sc);
        <?php } ?>
    });
</script>
@endsection