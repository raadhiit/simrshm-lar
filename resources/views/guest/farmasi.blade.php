<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Antrian Farmasi</title>
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
            <div id="box" class="card p-4" style="box-shadow: 3px 3px #999; width:100%;">
                @if(Session::has('gagal'))
                <div class="alert alert-danger text-center">{{Session::get('gagal')}}</div>
                @endif
                @if(Session::has('sukses'))
                <div class="alert alert-success text-center">{{Session::get('sukses')}}</div>
                @endif
                <h3 style="text-align: center;">Antrian Ambil Farmasi</h3>
                <div id="msg">
                    <br>
                    <br>
                </div>
                <h6 style="text-align: center;">Masukkan nomor kode booking anda.</h6>
                <br>
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12 pl-0 pr-0">
                        <div class="input-group">
                            <input type="text" placeholder="Kode booking" class="form-control" id="identitas" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="btn_search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
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

    function loading(param) {
        return '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div> ' + param;
    }

    function template_tabel(nama, tgl, nrm, poli) {
        return '<table id="tabel_pasien">' +
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
            '<th>' + poli + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>Jenis Obat</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' +
            '<select class="form-control" id="jenis_obat">' +
            '<option value="1">Racikan</option>' +
            '<option value="0">Non Racikan</option>' +
            '</select>' +
            '</th>' +
            '</tr>' +
            '</table>';
    }

    $('#btn_search').click(function() {
        if ($('#identitas').val() == '') {
            alert('Masukkan nomor kode booking dahulu');
            return;
        }

        //15072022GIG0001

        $('#msg').html('');
        $('#btn_search').attr('disabled', true);
        $('#box_btn_checkin').html('');

        $('#box_tabel').html('<div class="text-center">' + loading('Sedang mencari data...') + '</div>')

        $.ajax({
            url: '{{ url("ajax_request/antrian_by_kode_booking") }}',
            data: {
                kode_booking: $('#identitas').val()
            },
            success: function(response) {
                console.log(response);
                if ($.isEmptyObject(response)) {
                    $('#box_tabel').html('<div class="alert alert-danger text-center" style="font-weight:bold;">Data tidak ditemukan<br><br><button onclick="open_modal_pasien()" class="btn btn-warning">Daftar</button></div>');
                    $('#btn_search').removeAttr('disabled');
                    $('#box_btn_checkin').html('');
                    kode_booking = '';
                    return;
                }
                kode_booking = response.kodebooking;
                $('#box_tabel').html(template_tabel(response.pasien, response.tgl_lahir, response.norm, response.namapoli));
                $('#btn_search').removeAttr('disabled');
                $('#box_btn_checkin').html('<button id="btn_ambil_antrian" class="btn btn-warning" onclick="ambil_antrian(' + "'" + response.kodebooking + "'" + ')" style="font-weight: bold; color:#fff;">Ambil Antrian</button>');
            }
        })
    })

    function ambil_antrian(kodebooking) {
        $('#msg').html('<div class="alert alert-info">' + loading('Sedang proses, harap tunggu...') + '</div>');
        $('#btn_search').attr('disabled', true);
        $('#btn_ambil_antrian').attr('disabled', true);

        $.ajax({
            url: "{{ url('ajax_request/ambil_antrian_farmasi') }}",
            data: {
                kodebooking: kodebooking,
                jenis_obat: $('#jenis_obat').val(),
            },
            success: function(response) {
                if (!response.status) {
                    $('#msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                } else {
                    $('#msg').html('<div class="alert alert-success">' + response.message + '</div>');
                }
                $('#btn_search').removeAttr('disabled');
                $('#btn_ambil_antrian').removeAttr('disabled');
            }
        })
    }

    function open_modal_pasien(params) {
        $('#modal_add').modal('show');
    }

    $('#propinsi').change(function() {
        $('#kecamatan').html('');
        $('#kelurahan').html('');
        $('#kabupaten').html('');
        $.ajax({
            url: "{{ url('ajax_request/get_kabupaten') }}",
            data: {
                propinsi: $('#propinsi').val()
            },
            success: function(response) {
                console.log(response);
                if (response.length <= 0) {
                    return;
                }
                let ins = '';
                for (let i = 0; i < response.length; i++) {
                    ins += '<option value="' + response[i].id + '">' + response[i].nama + '</option>'
                }
                $('#kabupaten').html(ins);
            }
        })
    })

    $('#kabupaten').change(function() {
        $('#kecamatan').html('');
        $('#kelurahan').html('');
        $.ajax({
            url: "{{ url('ajax_request/get_kecamatan') }}",
            data: {
                kabupaten: $('#kabupaten').val()
            },
            success: function(response) {
                console.log(response);
                if (response.length <= 0) {
                    return;
                }
                let ins = '';
                for (let i = 0; i < response.length; i++) {
                    ins += '<option value="' + response[i].id + '">' + response[i].nama + '</option>'
                }
                $('#kecamatan').html(ins);
            }
        })
    })

    $('#kecamatan').change(function() {
        $('#kelurahan').html('');
        $.ajax({
            url: "{{ url('ajax_request/get_kelurahan') }}",
            data: {
                kecamatan: $('#kecamatan').val()
            },
            success: function(response) {
                console.log(response);
                if (response.length <= 0) {
                    return;
                }
                let ins = '';
                for (let i = 0; i < response.length; i++) {
                    ins += '<option value="' + response[i].id + '">' + response[i].nama + '</option>'
                }
                $('#kelurahan').html(ins);
            }
        })
    })
</script>

</html>