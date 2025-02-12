<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian</title>
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
                <div id="msg"></div>
                <div class="alert alert-warning col-lg-112">* Harap catat atau foto nomor antrian dan kodebooking sebelum menutup halaman ini</div>
                <h3 style="text-align: center;">Pendaftaran</h3>
                <br>
                <div style="display: inline-flex; align-items: center;">
                    <div style="width:25px; height:25px; border-radius:50%; background-color: green; color:#fff; text-align: center;"></div>
                    <div style="width:25vw; height:10px; background-color: green; color:#fff; text-align: center; margin-left: -2px;margin-right: -2px;"></div>
                    <div style="width:25px; height:25px; border-radius:50%; background-color: green; color:#fff; text-align: center;"></div>
                    <div style="width:25vw; height:10px; background-color: green; color:#fff; text-align: center; margin-left: -2px;margin-right: -2px;"></div>
                    <div style="width:25px; height:25px; border-radius:50%; background-color: green; color:#fff; text-align: center;"></div>
                </div>
                <br>
                <h6 style="text-align: center;">Nomor Antrean</h6>
                <br>
                <h2 class="text-center">{{$nomorantrian}}</h2>
                <br>
                <h6 style="text-align: center;">Kode Booking</h6>
                <br>
                <h2 class="text-center">{{$kodebooking}}</h2>
                <br>
                <h6 class="text-center">
                    <?php
                    // $dat = date_create(strtotime($estimasi));
                    // $d = new DateTime( '@'. $estimasi );0
                    echo 'Estimasi Jam Pelayanan ' . date("d-m-Y H:i", $estimasi/1000);
                    ?>
                </h6>
                <h6 class="text-center">Peserta harap 60 menit lebih awal guna pencatatan administrasi.</h6>
                <button class="btn btn-danger mb-1" onclick="checkin()" id="btn_checkin" <?php if ($antrian->taskid != 0) echo 'disabled'; ?>>Check In</button>
                <a class="btn btn-success mb-1" target="_blank" href="../cetak_antrian?nomor={{$kodebooking}}">Cetak Antrian</a>
                <a class="btn btn-dark mb-1" href="{{ url('guest_home') }}">Kembali ke halaman awal</a>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>
    var kode_booking = '';

    function spinner(param) {
        return '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' + param;
    }

    var loading = '<div class="spinner-border spinner-border-sm" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div> Sedang mencari data...';

    function template_tabel(nama, tgl, nrm, poli) {
        return '<table id="tabel_pasien">' +
            '<tr>' +
            '<th>Nama Pasien</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + nama + '</th>' +
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

    function checkin() {
        $('#btn_checkin').attr('disabled', true);
        $('#msg').html('<div class="alert alert-info text-center" style="font-weight:bold;">' + spinner('Harap tunggu, sedang melakukan checkin...') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/checkin') }}",
            data: {
                kodebooking: '{{$kodebooking}}'
            },
            success: function(response) {
                console.log(response);
                if (response.status) {
                    $('#msg').html('<div class="alert alert-success text-center" style="font-weight:bold;">' + response.message + '</div>');
                } else {
                    $('#msg').html('<div class="alert alert-danger text-center" style="font-weight:bold;">' + response.message + '</div>');
                }
            }
        })
    }
</script>

</html>