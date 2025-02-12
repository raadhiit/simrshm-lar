<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien BPJS</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #tabel_pasien tr {
            line-height: 40px;
        }
    </style>
</head>

<body style="background-color: lightblue;">
    <!-- Modal -->
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Masukkan data diri anda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('guest_registration/pasien_bpjs/create') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Kartu</label>
                            <input type="number" name="nobpjs" placeholder="Masukkan nomor bpjs" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">NIK</label>
                            <input type="number" name="nik" placeholder="Masukkan nomor ktp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">No. Kartu Keluarga</label>
                            <input type="number" name="no_kk" placeholder="Masukkan nomor kartu keluarga" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Masukkan nama lengkap" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select name="kelamin" id="kelamin" class="form-control" required>
                                <option value="">--Select Here--</option>
                                <option value="0">Laki-Laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggallahir" required>
                        </div>
                        <div class="form-group">
                            <label for="">No. Handphone</label>
                            <input type="number" name="phone" placeholder="Masukkan nomor hp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="alamat" placeholder="Masukkan alamat" required class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Propinsi</label>
                            <select name="propinsi" id="propinsi" class="form-control" required>
                                <option value="">--Select Here--</option>
                                @foreach($propinsi as $prop)
                                <option value="{{$prop->id}}">{{$prop->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">RT</label>
                            <input type="number" name="rt" placeholder="Masukkan nomor rt" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">RW</label>
                            <input type="number" name="rw" placeholder="Masukkan nomor rw" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
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
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
                @endforeach
                @endif
                <h3 style="text-align: center;">Pencarian Data Pasien</h3>
                <br>
                <div style="display: inline-flex; align-items: center;">
                    <div style="width:25px; height:25px; border-radius:50%; background-color: green; color:#fff; text-align: center;"></div>
                    <div style="width:25vw; height:10px; border-top:1px solid green; border-bottom:1px solid green; color:#fff; text-align: center; margin-left: -2px;margin-right: -2px;"></div>
                    <div style="width:25px; height:25px; border-radius:50%; border:1px solid green; color:#fff; text-align: center;"></div>
                    <div style="width:25vw; height:10px; border-top:1px solid green; border-bottom:1px solid green; color:#fff; text-align: center; margin-left: -2px;margin-right: -2px;"></div>
                    <div style="width:25px; height:25px; border-radius:50%; border:1px solid green; color:#fff; text-align: center;"></div>
                </div>
                <br>
                <h6 style="text-align: center;">Masukkan nomor BPJS / nomor rujukan anda pada form dibawah ini.</h6>
                <br>
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12 pl-0 pr-0">
                        <div class="input-group">
                            <input type="text" placeholder="Masukkan No. BPJS" class="form-control" id="identitas" required>
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
    var loading = '<div class="spinner-border spinner-border-sm" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div> Sedang mencari data...';

    function template_tabel(nik, nama, tgl, nrm, hp) {
        return '<table id="tabel_pasien">' +
            '<tr>' +
            '<th>NIK</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + nik + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>Nama Pasien</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + nama + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>No. RM</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + nrm + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>Tanggal Lahir</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + tgl + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th>No HP</th>' +
            '<th class="pl-2 pr-2"> : </th>' +
            '<th>' + hp + '</th>' +
            '</tr>' +
            '</table>';
    }

    $('#btn_search').click(function() {
        if ($('#identitas').val() == '') {
            alert('Masukkan nomor bpjs / nomor rujukan dahulu');
            return;
        }

        //15072022GIG0001

        $('#msg').html('');
        $('#btn_search').attr('disabled', true);
        $('#box_btn_checkin').html('');

        $('#box_tabel').html('<div class="text-center">' + loading + '</div>')

        $.ajax({
            url: '{{ url("ajax_request/get_pasien_by_bpjs_rujukan") }}',
            data: {
                nomor: $('#identitas').val()
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
                $('#box_tabel').html(template_tabel(response.ktp, response.nama, response.tgl_lahir, response.id, response.telpon));
                $('#btn_search').removeAttr('disabled');
                $('#box_btn_checkin').html('<a class="btn btn-warning" href="./pasien_bpjs/daftar?pasien=' + response.id + '" style="font-weight: bold; color:#fff;">Selanjutnya</a>');
            }
        })
    })

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