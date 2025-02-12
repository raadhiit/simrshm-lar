<!DOCTYPE html>

<head>
    <title>Display Antrian Farmasi</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <style>
        * {
            color: #111;
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

            #called_poli {
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
    <div class="container-fluid card pl-0 pr-0" style="height: 100vh; background-color: lightblue;">
        <div class="row pt-5 pb-5" style="width:100%; margin-left: 0; background-color: #fff;">
        <div class="col-lg-2">
                <img id="logo" src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 100%;">
            </div>
            <div class="col-lg-6" style="margin-left: 0px;">
                <h1 id="nama_rs">RUMAH SAKIT HARAPAN MULIA</h1>
                <h5 id="alamat_rs">Jl. Raya Cibarusah No.5, Cibarusahjaya, Kec. Cibarusah, Kabupaten Bekasi, Jawa Barat 17340</h5>
            </div>
            <div class="col-lg-4">
                <h2 id="jam"></h2>
                <h2 id="tanggal"></h2>
            </div>
        </div>
        <div class="row pt-5" id="box_two" style="width:100%; margin-left: 0; background-color: lightblue;">
            <!-- <div class="col-lg-5">
                <div class="row" style="width:100%; margin-left: 0;">
                    <div class="col-lg-12 text-center" style="border:3px solid">
                        <h4 id="called_poli">PHARMACY</h4>
                    </div>
                    <div id="box_kiri_nomor_antrian" class="col-lg-12 mt-3 pt-2 text-center" style="border:3px solid;">
                        <h4>NAMA PASIEN</h4>
                        <br>
                        <br>
                        <h4 id="called_nomor">&nbsp</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6">
            <iframe style="width:100%;" id="video" src="https://www.youtube.com/embed/4gtY9dQmX1g?autoplay=1&cc_load_policy=1" frameborder="0" allowfullscreen></iframe>
            </div> -->
            <div class="col-lg-6">
                <h4>Racikan</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 30%;">Nomor Antrian</th>
                            <th style="width: 40%;">Nama</th>
                            <th style="width: 30%;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="list_satu">

                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <h4>Non Racikan</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 30%;">Nomor Antrian</th>
                            <th style="width: 40%;">Nama</th>
                            <th style="width: 30%;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="list_dua">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>
    var idx_racik = 0
    var idx_non_racik = 0;
    let data_racikan = [];
    let data_non_racikan = [];

    let synth = window.speechSynthesis;

    function loading(param) {
        return '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' + param;
    }

    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        if (data.bagian == 'farmasi') {
            console.log(data);
            var temp_pasien = data.pasien.toLowerCase();
            var msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien + '. Silahkan menuju farmasi');
            msg.rate = 0.9;
            msg.pitch = 1;
            // msg.voice = model_suara[$('#model').val()];
            msg.lang = 'id-ID';
            synth.speak(msg);
            $('#called_nomor').html(data.pasien);
        }
    });

    setInterval(function() {
        var time = new Date().toLocaleTimeString();
        var tanggal = new Date().toLocaleDateString();
        var hari = new Date().getDay();
        document.getElementById('jam').innerHTML = time;
        document.getElementById('tanggal').innerHTML = convert_hari(hari) + ', ' + convert_tanggal(tanggal);
    }, 1000)

    $(document).ready(function() {
        var tanggal = new Date().toLocaleDateString();
        var hari = new Date().getDay();
        document.getElementById('tanggal').innerHTML = convert_hari(hari) + ', ' + convert_tanggal(tanggal);

        get_racikan();
        get_non_racikan();
    })

    setInterval(function() {
        get_racikan();
        get_non_racikan();
    }, 30000);

    // setInterval(function() {
    //     render_racikan();
    //     render_non_racikan();
    // }, 5000);

    function render_racikan() {
        if (data_racikan.length < 1) {
            idx_racik = 0;
            $('#list_satu').html('<tr class="text-center"><td colspan="3">Tidak ada data.</td></tr>');
            return;
        }
        var ins = '';
        for (let i = 0; i < data_racikan.length; i++) {
            ins += '<tr>' +
                '<td>' + data_racikan[i].nomorantrean + '</td>' +
                '<td>' + data_racikan[i].pasien + '</td>' +
                '<td>' + status(data_racikan[i].taskid) + '</td>' +
                '</tr>';
        }
        // if (idx_racik != 0) {
        //     for (let i = 0; i < idx_racik; i++) {
        //         ins += '<tr>' +
        //             '<td>' + data_racikan[i].nomorantrean + '</td>' +
        //             '<td>' + data_racikan[i].pasien + '</td>' +
        //             '<td>' + status(data_racikan[i].taskid) + '</td>' +
        //             '</tr>';
        //     }
        // }
        // if (idx_racik == (data_racikan.length - 1)) {
        //     idx_racik = 0;
        // } else {
        //     idx_racik++;
        // }
        $('#list_satu').html(ins);
    }

    function render_non_racikan() {
        if (data_non_racikan.length < 1) {
            idx_racik = 0;
            $('#list_dua').html('<tr class="text-center"><td colspan="3">Tidak ada data.</td></tr>');
            return;
        }
        var ins = '';
        for (let i = 0; i < data_non_racikan.length; i++) {
            ins += '<tr>' +
                '<td>' + data_non_racikan[i].nomorantrean + '</td>' +
                '<td>' + data_non_racikan[i].pasien + '</td>' +
                '<td>' + status(data_non_racikan[i].taskid) + '</td>' +
                '</tr>';
        }
        // if (idx_non_racik != 0) {
        //     for (let i = 0; i < idx_non_racik; i++) {
        //         ins += '<tr>' +
        //             '<td>' + data_non_racikan[i].nomorantrean + '</td>' +
        //             '<td>' + data_non_racikan[i].pasien + '</td>' +
        //             '<td>' + status(data_non_racikan[i].taskid) + '</td>' +
        //             '</tr>';
        //     }
        // }
        // if (idx_non_racik == (data_non_racikan.length - 1)) {
        //     idx_non_racik = 0;
        // } else {
        //     idx_non_racik++;
        // }
        $('#list_dua').html(ins);
    }

    function get_racikan() {
        $('#list_satu').html('<tr class="text-center"><td colspan="3">' + loading('Sedang mengambil data...') + '</td></tr>')
        $.ajax({
            url: "{{ url('ajax_request/antrian_obat') }}",
            data: {
                jenis: 1,
            },
            success: function(response) {
                data_racikan = response;
                render_racikan();
                console.log(data_racikan);
            }
        })
    }

    function get_non_racikan() {
        $('#list_dua').html('<tr class="text-center"><td colspan="3">' + loading('Sedang mengambil data...') + '</td></tr>');
        $.ajax({
            url: "{{ url('ajax_request/antrian_obat') }}",
            data: {
                jenis: 0,
            },
            success: function(response) {
                data_non_racikan = response;
                render_non_racikan();
                console.log(data_non_racikan);
            }
        })
    }

    function status(param) {
        switch (param) {
            case 5:
                return 'Belum Dilayani';
                break;
            case 6:
                return 'Sedang Dilayani';
                break;
            case 7:
                return 'Selesai Dilayani';
                break;
            default:
                return '';
                break;
        }
    }

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