<!DOCTYPE html>

<head>
    <title>Display Antrian Pendaftaran</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            color: #111;
        }

        @media only screen and (max-width: 640px) {
            #box_two {
                display: none;
            }

            #nama_rs {
                /* margin-top: -90px; */
                text-align: left;
                font-size: 16px;
            }

            #alamat_rs {
                text-align: left;
                font-size: 14px;
            }

            #jam {
                text-align: center;
                font-size: 16px;
            }

            #tanggal {
                text-align: center;
                font-size: 16px;
            }

            #logo {
                width: 150%;
                margin-top: -20px;
            }

            #box_logo {
                text-align: center;
            }

            .box-header {
                margin-top: -30px;
            }

            .box-loket {
                margin-top: -40px;
                padding-top: 10px;
            }
        }

        @media only screen and (min-width: 641px) and (max-width:1024px) {
            #box_two {
                display: none;
            }

            #nama_rs {
                /* margin-top: -90px; */
                text-align: left;
                font-size: 25px;
            }

            #alamat_rs {
                text-align: left;
                font-size: 22px;
            }

            #jam {
                text-align: center;
                font-size: 22px;
            }

            #tanggal {
                text-align: center;
                font-size: 22px;
            }

            #logo {
                width: 150%;
            }

            #box_logo {
                text-align: center;
                padding-right: 40px;
            }

            .box-header {
                margin-top: -30px;
            }

            .box-loket {
                margin-top: -40px;
                padding-top: 10px;
            }
        }

        @media only screen and (max-width: 1440px) {
            #box_kiri_nomor_antrian {
                height: 250px;
            }

            #box_two {
                height: 45%;
            }

            #video {
                height: 310px;
            }
        }

        @media only screen and (min-width: 1441px) {
            #logo {
                width: 100%;
            }

            #box_two {
                height: 50%;
            }

            #box_kiri_nomor_antrian {
                height: 305px;
            }

            #nama_rs {
                font-size: 70px;
            }

            #alamat_rs {
                font-size: 30px;
            }

            #called_loket {
                font-size: 75px;
            }

            #called_nomor {
                font-size: 120px;
                font-weight: bold;
            }

            #box_kiri_nomor_antrian h4 {
                font-size: 50px;
            }

            #video {
                height: 450px;
            }

            #jam {
                font-size: 60px;
            }

            #tanggal {
                font-size: 60px;
            }

            th,
            td {
                font-size: 45px;
            }
        }
    </style>
</head>

<body style="display: flex; justify-content: center; align-items:center;">
    {{-- <div class="container-fluid card pl-0 pr-0" style="height: 100vh; background-color: lightblue;"> --}}
    <div class="container-fluid card pl-0 pr-0">
        <div class="row pt-5 pb-5 box-header" style="width:100%; margin-left: 0; background-color: #fff;">
            <div class="col-lg-2 col-md-2 col-sm-2" id="box_logo">
                <img id="logo" src="{{ asset('filelogo/logo_rshm.png') }}" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6" style="margin-left: 0px;">
                <h1 id="nama_rs">RUMAH SAKIT HARAPAN MULIA</h1>
                <h5 id="alamat_rs">Jl. Raya Cibarusah No.5, Cibarusahjaya, Kec. Cibarusah, Kabupaten Bekasi, Jawa
                    Barat
                    17340</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h2 id="jam"></h2>
                <h2 id="tanggal"></h2>
            </div>
        </div>
        <div class="row" style="height: 100vh; background-color: lightblue;">
            <div class="col-lg-6">
                <div class="container-fluid pt-5">
                    <div class="container pb-3">
                        <h1 class="text-center fw-bold mb-4">
                            <i class="fa-solid fa-calendar-days"></i> JADWAL CUTI DOKTER
                        </h1>
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div class="card shadow rounded border-0 h-100">
                                <div class="card-body text-center p-4">
                                    <h3 class="text-primary fw-bold mb-1">dr. Ayuningtiyas</h3>
                                    <h5 class="text-secondary mb-3">SPESIALIS ANAK</h5>
                                    <div class="alert alert-warning p-2" role="alert">
                                        <strong>CUTI:</strong> 01-15 April 2024
                                    </div>
                                    <div class="alert alert-success p-2" role="alert">
                                        <strong>PRAKTIK KEMBALI:</strong> 17 April 2024
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow rounded border-0 h-100">
                                <div class="card-body text-center p-4">
                                    <h3 class="text-primary fw-bold mb-1">dr. Andika Pratama</h3>
                                    <h5 class="text-secondary mb-3">SPESIALIS BEDAH</h5>
                                    <div class="alert alert-warning p-2" role="alert">
                                        <strong>CUTI:</strong> 10-20 Mei 2024
                                    </div>
                                    <div class="alert alert-success p-2" role="alert">
                                        <strong>PRAKTIK KEMBALI:</strong> 22 Mei 2024
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="row pt-5" id="box_two" style="width:100%; margin-left: 0; background-color: lightblue;">
                    {{-- <div class="col-lg-5 d-none d-lg-block d-xl-block">
                        <div class="row" style="width:100%; margin-left: 0;">
                            <div class="col-lg-12 text-center" style="border:3px solid">
                                <h4 id="called_loket">&nbsp</h4>
                            </div>
                            <div id="box_kiri_nomor_antrian" class="col-lg-12 mt-3 pt-2 text-center" style="border:3px solid;">
                                <h4>NOMOR ANTRIAN</h4>
                                <br>
                                <br>
                                <h1 id="called_nomor">&nbsp</h1>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-1 d-none d-lg-block d-xl-block"></div> --}}
                    {{-- <div class="col-lg-6 d-none d-lg-block d-xl-block"> --}}
                    <div class="col-lg-12 d-none d-lg-block d-xl-block">
                        <div class="row" style="width:100%; margin-left: 0;">
                            <div class="col-lg-12 text-center"
                                style="border:3px solid; height:100px; display: flex; justify-content: center; align-items: center;">
                                <h4>ANTRIAN MANUAL</h4>
                            </div>
                            <div id="box_kiri_nomor_antrian" class="col-lg-12 mt-3 pt-2 text-center"
                                style="border:3px solid;">
                                <h4>NOMOR ANTRIAN</h4>
                                <br>
                                <br>
                                <h1 style="font-size: 100px;" id="called_nomor_manual">&nbsp</h1>
                            </div>
                        </div>
                        <!-- <iframe style="width:100%;" id="video" src="https://www.youtube.com/embed/4gtY9dQmX1g?autoplay=1&cc_load_policy=1" frameborder="0" allowfullscreen></iframe> -->
                    </div>
                </div>
                <div class="row box-loket" style="width:100%; margin-left: 0; background-color: lightblue;">
                    <div class="col-lg-3 text-center p-3">
                        <div style="border: 3px solid; width:100%; border-radius:10px;">
                            <!-- <h3 style="font-weight: bolder">Rawat Jalan<br>BPJS</h3> -->
                            <h3 style="font-weight: bolder">Loket 1</h3>
                            <br>
                            <br>
                            <h3 style="font-size: 50px;" class="loket_1"></h3>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center p-3">
                        <div style="border: 3px solid; width:100%; border-radius:10px;">
                            <!-- <h3 style="font-weight: bolder">Rawat Jalan<br>BPJS</h3> -->
                            <h3 style="font-weight: bolder">Loket 2</h3>
                            <br>
                            <br>
                            <h3 style="font-size: 50px;" class="loket_2"></h3>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center p-3">
                        <div style="border: 3px solid; width:100%; border-radius:10px;">
                            <!-- <h3 style="font-weight: bolder">Rawat Jalan<br>Umum dan Asuransi</h3> -->
                            <h3 style="font-weight: bolder">Loket 3</h3>
                            <br>
                            <br>
                            <h3 style="font-size: 50px;" class="loket_3"></h3>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center p-3">
                        <div style="border: 3px solid; width:100%; border-radius:10px;">
                            <!-- <h3 style="font-weight: bolder">Rawat Inap<br>IGD BPJS atau NON BPJS</h3> -->
                            <h3 style="font-weight: bolder">Loket 4</h3>
                            <br>
                            <br>
                            <h3 style="font-size: 50px;" class="loket_4"></h3>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>
    let synth = window.speechSynthesis;
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(data);
        if (data.bagian == 'pendaftaran') {
            var temp_pasien = data.pasien == null ? '' : data.pasien.toLowerCase();
            if (data.manual == '1') {
                var msg;

                var alpha = '';
                switch (data.jenis) {
                    case 'loket 1':
                        alpha = 'A';
                        break;
                    case 'loket 2':
                        alpha = 'B';
                        break;
                    case 'loket 3':
                        alpha = 'C';
                        break;
                    case 'loket 4':
                        alpha = 'D';
                        break;

                    default:
                        break;
                }

                msg = new SpeechSynthesisUtterance('Nomor antrian. ' + alpha + data.nomor +
                    '.silahkan menuju ' + data.loket);
                $('#called_nomor_manual').html(alpha + data.nomor);
                $('.' + data.loket.replaceAll(' ', '_')).html(alpha + data.nomor);
                msg.rate = 0.9;
                msg.pitch = 1;
                msg.lang = 'id-ID';
                synth.speak(msg);
            } else {
                if (data.baru_lama == '0') {
                    var msg;
                    msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien +
                        ', silahkan menuju ' + data.loket.replaceAll('_', ' '));
                    $('.' + data.loket.replaceAll(' ', '_')).html(data.nomor);
                    $('#called_loket').html(data.loket.replaceAll('_', ' ').toUpperCase());
                    $('#called_nomor').html(data.nomor);
                    msg.rate = 0.9;
                    msg.pitch = 1;
                    msg.lang = 'id-ID';
                    synth.speak(msg);
                } else if (data.baru_lama == '1') {
                    var msg;
                    msg = new SpeechSynthesisUtterance(temp_pasien + ', silahkan menuju ' + data.loket
                        .replaceAll('_', ' '));
                    msg.rate = 0.9;
                    msg.pitch = 1;
                    msg.lang = 'id-ID';
                    synth.speak(msg);
                }
            }
        }
    });

    setInterval(function() {

    }, 5000)

    setInterval(function() {
        var time = new Date().toLocaleTimeString();
        var tanggal = new Date().toLocaleDateString();
        var hari = new Date().getDay();
        document.getElementById('jam').innerHTML = time;
        document.getElementById('tanggal').innerHTML = convert_hari(hari) + ', ' + convert_tanggal(tanggal);
        // document.getElementById('jam_small').innerHTML = time;
        // document.getElementById('tanggal_small').innerHTML = convert_hari(hari) + ', ' + convert_tanggal(tanggal);
    }, 1000)

    function convert_tanggal(param) {
        if (param == '') {
            return '';
        }
        var temp = param.split('/');
        switch (temp[0]) {
            case '1':
                return temp[1] + ' Januari ' + temp[2];
                break;
            case '2':
                return temp[1] + ' Februari ' + temp[2];
                break;
            case '3':
                return temp[1] + ' Maret ' + temp[2];
                break;
            case '4':
                return temp[1] + ' April ' + temp[2];
                break;
            case '5':
                return temp[1] + " Mei " + temp[2];
                break;
            case '6':
                return temp[1] + ' Juni ' + temp[2];
                break;
            case '7':
                return temp[1] + ' Juli ' + temp[2];
                break;
            case '8':
                return temp[1] + ' Agustus ' + temp[2];
                break;
            case '9':
                return temp[1] + ' September ' + temp[2];
                break;
            case '10':
                return temp[1] + ' Oktober ' + temp[2];
                break;
            case '11':
                return temp[1] + ' November ' + temp[2];
                break;
            case '12':
                return temp[1] + ' Desember ' + temp[2];
                break;
            default:
                return '';
                break;
        }
    }

    function convert_hari(param) {
        switch (param) {
            case 1:
                return 'Senin';
                break;
            case 2:
                return 'Selasa';
                break;
            case 3:
                return 'Rabu';
                break;
            case 4:
                return 'Kamis';
                break;
            case 5:
                return "Jum'at";
                break;
            case 6:
                return 'Sabtu';
                break;
            case 7:
                return 'Minggu';
                break;
            default:
                return '';
                break;
        }
    }
</script>
