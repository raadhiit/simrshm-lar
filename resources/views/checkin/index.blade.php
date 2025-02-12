<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <title>Checkin</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS Libraries -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('app-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/custom.css') }}">

    <!-- Custom CSS for Anjungan Mandiri page -->
    <link rel="stylesheet" href="{{ asset('app-assets/css/anjungan-mandiri.css') }}">
</head>

<body class="full-height">
    @yield('modal')
    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="logo" width="200" class="logo-rs">
    <img src="{{ asset('shape/triangle-green.png') }}" alt="logo" width="80" class="triangel-green">
    <img src="{{ asset('shape/triangle-red.png') }}" alt="logo" width="60" class="triangel-red">
    <img src="{{ asset('shape/circle-red.png') }}" alt="logo" width="350" class="circle-red">
    <img src="{{ asset('shape/circle-green.png') }}" alt="logo" width="50" class="circle-green">

    <div class="layout-custom" style="scale: 100%">
        <div class="vertical-middle">
            <div class="row" style="margin-left: 0; width:100%; height:100vh;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="display: flex; justify-content: center; align-items: center;">
                    <div id="box" class="card p-4" style="box-shadow: 3px 3px #999;">
                        <h3 style="text-align: center;">Checkin Pendaftaran Online</h3>
                        <br>
                        <br>
                        <h6 style="text-align: center;">Pilih dan masukkan nomor identitas anda</h6>
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12 pl-0 pr-0" id="msg"></div>
                            <div class="col-lg-12 pl-0 pr-0">
                                <div class="form-group">
                                    <select name="jenis_nomor" class="form-control">
                                        <option value="nobpjs">Nomor BPJS</option>
                                        <option value="kodebooking">Kode Booking</option>
                                        <option value="nrm">Nomor Rekam Medis</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="kode_booking" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" type="text" placeholder="Masukkan nomor identitas" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="btn_ok" style="width: 100%; font-weight: bold; border-top-left-radius: 0; border-bottom-left-radius: 0;">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-4 pr-0 pl-0"> -->

                            <!-- </div> -->
                            <div id="box_tabel" style="text-align: left;" class="col-lg-12 pl-0 pr-0 pt-2">

                            </div>
                            <div class="col-lg-12 pl-0 pr-0 pb-3 pt-3 text-center" id="box_btn_checkin">

                            </div>
                            <div class="col-lg-12 pl-0 pr-0" style="text-align: left;">
                                <a href="{{ url('guest_home') }}" class="btn btn-dark"><i class="fa fa-home"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>

    <div class="copyright">
        crafted with <div class="text-danger">❤️</div> by&nbsp;<a href="https://ideplex.com/">ideplex.com</a>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('app-assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('app-assets/js/scripts.js') }}"></script>
    <script src="{{ asset('app-assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function() {
                //
            },
            complete: function() {
                //
            },
        });

        var url = "{{ env('BASE_URL_APLIKASI_SEP') }}";
        var kode_booking = '';
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
                '<th>' + reformat_tanggal(tgl) + '</th>' +
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

        function reformat_tanggal(tgl) {
            if (tgl == '' || tgl == null) {
                return '';
            }
            let temp = tgl.split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
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
                    kode_booking: $('#kode_booking').val(),
                    jenis_nomor: $('[name=jenis_nomor]').val()
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

                    if (response.taskid != 0) {
                        $('#msg').html('<div class="alert alert-danger text-center" style="font-weight:bold;">Anda sudah berhasil checkin</div>');
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
                        $('#box_btn_checkin').html(
                            '<div style="display:flex; flex-direction:row; justify-content:center;"><a class="btn btn-danger" href="./guest_home">Kembali ke halaman utama</a><a class="btn btn-info ml-2" href="' +
                            url + '/cari-data-rujukan?nomor_kartu=' + response.antrian.nomorkartu +
                            '">Data Rujukan</a></div>');
                    } else {
                        $('#msg').html('<div class="alert alert-danger text-center" style="font-weight:bold;">' + response.message + '</div>');
                        $('#btn_checkin').removeAttr('disabled');
                    }
                    $('#btn_ok').removeAttr('disabled');
                }
            })
        }
    </script>
    @yield('js')
</body>

</html>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkin</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <div id="box" class="card p-4" style="box-shadow: 3px 3px #999;">
                <h3 style="text-align: center;">Check In Pendaftaran Online</h3>
                <br>
                <br>
                <h6 style="text-align: center;">Masukkan nomor kode booking anda</h6>
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12 pl-0 pr-0" id="msg"></div>
                    <div class="col-lg-8 pl-0 pr-0">
                        <input id="kode_booking" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" type="text" placeholder="kode booking" class="form-control">
                    </div>
                    <div class="col-lg-4 pr-0 pl-0">
                        <button class="btn btn-success" id="btn_ok" style="width: 100%; font-weight: bold; border-top-left-radius: 0; border-bottom-left-radius: 0;">Ok</button>
                    </div>
                    <div id="box_tabel" class="col-lg-12 pl-0 pr-0 pt-4">

                    </div>
                    <div class="col-lg-12 pl-0 pr-0 pt-5 text-center" id="box_btn_checkin">

                    </div>
                    <div class="col-lg-12 pl-0 pr-0">
                        <a href="{{ url('guest_home') }}" class="btn btn-dark"><i class="fa fa-home"></i></a>
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

                if (response.taskid != 0) {
                    $('#msg').html('<div class="alert alert-danger text-center" style="font-weight:bold;">Anda sudah berhasil checkin</div>');
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

</html> -->