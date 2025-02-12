<!DOCTYPE html>

<head>
    <title>Display Antrian Poli</title>
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
            <div class="col-lg-5">
                <div class="row" style="width:100%; margin-left: 0;">
                    <div class="col-lg-12 text-center" style="border:3px solid">
                        <h4 id="called_poli">&nbsp</h4>
                    </div>
                    <div id="box_kiri_nomor_antrian" class="col-lg-12 mt-3 pt-2 text-center" style="border:3px solid;">
                        <h4>NOMOR ANTRIAN</h4>
                        <br>
                        <br>
                        <h4 style="font-size: 120px;" id="called_nomor">&nbsp</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Nomor Antrean</th>
                            <th>Nama Poli</th>
                        </tr>
                    </thead>
                    <tbody id="list_history"></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>
    var idx = 0;
    let history = [];

    let synth = window.speechSynthesis;

    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(data);
        if (data.bagian == 'poli') {
            var temp_pasien = data.pasien.toLowerCase();
            var msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien + '. Silahkan menuju ' + data.loket);
            msg.rate = 0.9;
            msg.pitch = 1;
            // msg.voice = model_suara[$('#model').val()];
            msg.lang = 'id-ID';
            synth.speak(msg);
            $('#called_nomor').html(data.nomor);
            $('#called_poli').html(data.loket);
        }
    });

    $(document).ready(function() {
        get_data_history();
        run_history();
    })

    function run_history() {
        console.log(history);
        if (history.length == 0) {
            $('#list_history').html('<tr><td colspan="2" class="text-center">Data tidak ditemukan</td></tr>');
        } else {
            var ins = '';
            for (let i = idx; i < history.length; i++) {
                ins += '<tr>' +
                    '<td>' + history[i].nomorantrean + '</td>' +
                    '<td>' + history[i].namapoli + '</td>' +
                    '</tr>';
            }
            if (idx != 0) {
                for (let i = 0; i < idx; i++) {
                    ins += '<tr>' +
                        '<td>' + history[i].nomorantrean + '</td>' +
                        '<td>' + history[i].namapoli + '</td>' +
                        '</tr>';
                }
            }
            if (idx == (history.length - 1)) {
                idx = 0;
            } else {
                idx++;
            }
            $('#list_history').html(ins);
        }
    };

    setInterval(function() {
        get_data_history();
    }, 30000);

    function get_data_history() {
        $.ajax({
            url: "{{ url('ajax_request/get_antrian_selesai_poli') }}",
            success: function(response) {
                history = response;
                console.log(idx);
                run_history();
            }
        })
    }

    setInterval(function() {
        var time = new Date().toLocaleTimeString();
        var tanggal = new Date().toLocaleDateString();
        var hari = new Date().getDay();
        document.getElementById('jam').innerHTML = time;
        document.getElementById('tanggal').innerHTML = convert_hari(hari) + ', ' + convert_tanggal(tanggal);
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