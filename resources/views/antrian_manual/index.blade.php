<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Antrian Manual</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/sweetlaert2.min.css') }}">

</head>

<body>
    <div style="margin-top: 80px;">
        <div class="row col-lg-12" style="height:250px;">
            <div class="col-lg-4" style="">
                <img style="float: right; margin-top:-30px;" src="{{ URL::asset('/filelogo/logo_rshm.png') }}"
                    alt="logo_slg" height="250" width="250">
            </div>
            <div class="col-lg-6 pt-5">
                <div style="float: left;">
                    <p style="font-size: 32pt;">Selamat Datang di</p>
                    <p style="font-size: 32pt; margin-top: -15px;">RUMAH SAKIT HARAPAN MULIA</p>
                </div>
            </div>
        </div>

        <p class="text-center pt-5" style="font-size: 24pt;">Silahkan ambil nomor antrian pendaftaran</p>
        <div class="row" style="width: 100%;">
            <div class="col-lg-3">
                <p style="text-align:center; font-size:25pt;">A{{ $antrian_bpjs }}</p>
                <form class="col-lg-12 text-center" action="{{ route('antrian_manual.ambil', 1) }}" method="POST"
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="jenis" value="loket 1">
                    <button style="width:100%; text-align:center; font-size: 16pt; padding: 20px;"
                        class="btn btn-warning">
                        <span style="padding: 10px 15px; background-color: #fff; border-radius:5px;">Poli Rawat
                            Jalan</span>
                        <!-- <br>RAWAT JALAN<br>BPJS -->
                    </button>
                </form>
            </div>
            <div class="col-lg-3">
                <p style="text-align:center; font-size:25pt;">B{{ $antrian_umum }}</p>
                <form class="col-lg-12 text-center" action="{{ route('antrian_manual.ambil', 1) }}" method="POST"
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="jenis" value="loket 2">
                    <button style="width:100%; text-align:center; font-size: 16pt; padding: 20px;"
                        class="btn btn-warning">
                        <span style="padding: 10px 15px; background-color: #fff; border-radius:5px;">Poli Rawat
                            Inap</span>
                        <!-- <br>RAWAT JALAN<br>BPJS -->
                    </button>
                </form>
            </div>
            <div class="col-lg-3">
                <p style="text-align:center; font-size:25pt;">C{{ $antrian_asuransi }}</p>
                <form class="col-lg-12 text-center" action="{{ route('antrian_manual.ambil', 1) }}" method="POST"
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="jenis" value="loket 3">
                    <button style="width:100%; text-align:center; font-size: 16pt; padding: 20px;"
                        class="btn btn-warning">
                        <span style="padding: 10px 15px; background-color: #fff; border-radius:5px;">IGD Rawat
                            Jalan</span>
                        <!-- <br>RAWAT JALAN<br>UMUM & ASURANSI -->
                    </button>
                </form>
            </div>
            <div class="col-lg-3">
                <p style="text-align:center; font-size:25pt;">D{{ $antrian_ranap }}</p>
                <form class="col-lg-12 text-center" action="{{ route('antrian_manual.ambil', 1) }}" method="POST"
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="jenis" value="loket 4">
                    <button style="width:100%; text-align:center; font-size: 16pt; padding: 20px;"
                        class="btn btn-warning">
                        <span style="padding: 10px 15px; background-color: #fff; border-radius:5px;">IGD Rawat
                            Inap</span>
                        <!-- <br>RAWAT INAP IGD<br>BPJS / NON BPJS -->
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/sweetalert2.min.js') }}"></script>

@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Mohon Maaf',
            // text: "{{ session('warning') }}",
            html: '<span style="font-size: 1.5rem;">{{ session("warning") }}</span>',
            // confirmButtonText: 'OK',
            showConfirmButton: false,
            timer: 4500
        });
    </script>
@endif

</html>
