<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <style>
        #tabel_pasien tr {
            line-height: 40px;
        }
    </style>
</head>

<body style="background-color: lightblue;">
    <div class="row" style="margin-left: 0; width:100%; height:100vh;">
        <div class="col-lg-3"></div>
        <div class="col-lg-6" style="display: flex; justify-content: center; align-items: center;">
            <div id="box" class="card p-4" style="box-shadow: 3px 3px #999; width:100%;">
                <h3 style="text-align: center;">Selamat Datang di<br>Rumah Sakit Harapan Mulia.</h3>
                <br>
                <h5 class="text-center">Pilih keperluan anda</h5>
                <br>
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4 pl-0 pr-0 text-center">
                        <a style="color:#fff; font-weight:bold;" href="{{ url('checkin') }}" class="btn btn-warning btn-lg"><img src="{{ asset('images/checkin.png') }}" alt=""><br>Check In</a>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4 pr-0 pl-0 text-center">
                        <a style="color:#fff; font-weight:bold;" href="{{ url('guest_registration') }}" class="btn btn-primary btn-lg pl-4 pr-4"><img src="{{ asset('images/register.png') }}" alt=""><br>Daftar</a>
                    </div>
                    <div class="col-lg-1"></div>
                    <div id="box_tabel" class="col-lg-12 pl-0 pr-0 pt-4">

                    </div>
                    <div class="col-lg-12 pl-0 pr-0 pt-5 text-center" id="box_btn_checkin">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>
    var kode_booking = '';
    var loading = '<div class="spinner-border spinner-border-sm" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div> Sedang mencari data...';

    function template_tabel(nama, tgl, nrm, poli) {
        return '<table id="tabel_pasien">' +
            '<tr>' +
            '<th>Nama Pasien</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            
            '<th>' + ama + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>Tanggal Lahir</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + tgl + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>No. RM</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + nrm + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>Poliklinik / Unit Penunjang</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + poli +
            '</tr>' +
            '</table>';
    }

    $('#btn_ok').click(function() {
        if ($('#kode_booking').val() == '') {
            alert('Masukkan kode booking dahulu');
            return;
        }

        //15072022GIG0001

        $('#msg').html('');
        $('#btn_ok').attr('disabled', true);
        $('#box_btn_checkin').html('');

        $('#box_tabel').html('<div class="text-center">' + loading + '</div>')

        $.ajax({
            url: '{{ url("ajax_request/antrian_by_kode_booking") }}',
            data: {
                kode_booking: $('#kode_booking').val()
            },
            success: function(response) {
                console.log(response);
                if ($.isEmptyObject(response)) {
                    $('#msg').html('<div class="alert alert-danger text-center" style="font-weight:bold;">Data tidak ditemukan</div>');
                    $('#box_tabel').html('');
                    $('#btn_ok').removeAttr('disabled');
                    $('#box_bnt_checkin').html('');
                    kode_booking = '';
                    return;
                }

                kode_booking = response.kodebooking;
                $('#box_tabel').html(template_tabel(response.pasien, response.tgl_lahir, response.norm, response.namapoli));
                $('#btn_ok').removeAttr('disabled');
                $('#box_btn_checkin').html('<button class="btn btn-warning" id="btn_checkin" onclick="checkin()" style="font-weight: bold; color:#fff;">Check In</button>');
            }
        })
    })

    function checkin() {
        $('#btn_checkin').attr('disabled', true);
        $('#btn_ok').attr('disabled');
        if (kode_booking == '') {
            alert('Kode booking salah');
            return;
        }

        $.ajax({
            url: "{{ url('ajax_request/checkin') }}",
            data: {
                kodebooking: kode_booking
            },
            success: function(response) {
                console.log(response);
                if (response.status) {
                    $('#msg').html('<div class="alert alert-success text-center" style="font-weight:bold;">' + response.message + '</div>');
                    $('#box_btn_checkin').html('');
                } else {
                    $('#msg').html('<div class="alert alert-danger text-center" style="font-weight:bold;">' + response.message + '</div>');
                    $('#btn_checkin').removeAttr('disabled');
                }
                $('#btn_ok').removeAttr('disabled');
            }
        })
    }
</script>

</html>