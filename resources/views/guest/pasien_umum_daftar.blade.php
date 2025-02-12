<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Antrian</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        #tabel_pasien tr {
            line-height: 40px;
        }
    </style>
</head>

<body style="background-color: lightblue;">
    <div class="modal fade" id="modal_perujuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Perujuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabel_perujuk" class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 0; width:100%; height:100vh;">
        <div class="col-lg-3"></div>
        <div class="col-lg-6" style="display: flex; justify-content: center; align-items: center;">
            <div id="box" class="card p-4" style="box-shadow: 3px 3px #999; width:100%;">
                <h3 style="text-align: center;">Ambil Antrian</h3>
                <br>
                <div style="display: inline-flex; align-items: center;">
                    <div style="width:25px; height:25px; border-radius:50%; background-color: green; color:#fff; text-align: center;"></div>
                    <div style="width:25vw; height:10px; background-color: green; color:#fff; text-align: center; margin-left: -2px;margin-right: -2px;"></div>
                    <div style="width:25px; height:25px; border-radius:50%; background-color: green; color:#fff; text-align: center;"></div>
                    <div style="width:25vw; height:10px; border-top:1px solid green; border-bottom:1px solid green; color:#fff; text-align: center; margin-left: -2px;margin-right: -2px;"></div>
                    <div style="width:25px; height:25px; border-radius:50%; border:1px solid green; color:#fff; text-align: center;"></div>
                </div>
                <br>
                <h6 style="text-align: center;">Pendaftaran Pasien Umum.</h6>
                <br>
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
                <div class="row" style="width: 100%; margin-left: 0;">
                    <form class="col-lg-12 pl-0 pr-0" method="post" action="{{ url('guest_registration/pasien_umum/daftar/post') }}">
                        @csrf
                        <input type="hidden" name="pasien" value="{{$pasien->id}}">
                        <input type="hidden" name="ktp" value="{{$pasien->ktp}}">
                        <input type="hidden" name="nobpjs" value="">
                        <div class="form-group">
                            <label for="">Pembayaran</label>
                            <select name="jenis_pasien" id="jenis_pasien" class="form-control" required>
                                <option value="">--Select Here--</option>
                                @foreach($jenispasien as $jp)
                                <option value="{{$jp->slug.'-'.$jp->asuransi.'-'.$jp->nama_perusahaan}}">{{$jp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Asuransi</label>
                            <select name="asuransi" id="asuransi" class="form-control" disabled>
                                <option value="">--Select Here--</option>
                                @foreach($asuransi as $asuran)
                                <option value="{{$asuran->id}}">{{$asuran->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Perusahaan</label>
                            <select name="perusahaan" id="perusahaan" class="form-control" disabled>
                                <option value="">--Select Here--</option>
                                @foreach($perusahaan as $peru)
                                <option value="{{$peru->id}}">{{$peru->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Penanggung Jawab</label>
                            <input type="text" name="nama_pj" id="nama_pj" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Telp. Penanggung Jawab</label>
                            <input type="number" min="0" name="telp_pj" id="telp_pj" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Periksa</label>
                            <input type="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" id="tanggal" name="tanggalperiksa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Poliklinik / Unit Penunjang</label>
                            <select name="kodepoli" id="poli" class="form-control" required>
                                <option value="">--Select Here--</option>
                                @foreach($poli as $pol)
                                <option value="{{$pol->kodepoli_bpjs.'-'.$pol->nama_poli}}">{{$pol->kodepoli_bpjs.' - '.$pol->nama_poli}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Dokter</label>
                            <select name="kodedokter" id="dokter" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jam Praktek</label>
                            <select name="jampraktek" id="jam" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kunjungan</label>
                            <select name="jenis_kunjungan" class="form-control" required>
                                <option value="">--Select Here--</option>
                                <option value="1">Rujukan FKTP</option>
                                <option value="2">Rujukan Internal</option>
                                <option value="3">Kontrol</option>
                                <option value="4">Rujukan Antar RS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kedatangan</label>
                            <select id="kedatangan" name="kedatangan" onchange="select_perujuk(this.value)" class="form-control" required>
                                <option value="">--Select Here--</option>
                                <option value="Datang Sendiri">Datang Sendiri</option>
                                <option value="Rujukan">Rujukan</option>
                                <option value="Diterima Kembali">Diterima Kembali</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Perujuk</label>
                            <select id="jenis_perujuk" name="jenis_perujuk" class="form-control">
                                <option value="">--Select Here--</option>
                                <option value="Dokter">Dokter</option>
                                <option value="Mantri">Mantri</option>
                                <option value="Bidan">Bidan</option>
                                <option value="Puskesmas">Puskesmas</option>
                                <option value="RS Lain">RS Lain</option>
                                <option value="Balai Pengobatan Lain">Balai Pengobatan Lain</option>
                                <option value="Karyawan">Karyawan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Perujuk</label>
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="id_perujuk" id="id_perujuk" />
                                <input type="text" readonly class="form-control" id="nama_perujuk" name="nama_perujuk" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btn_pilih_perujuk" type="button" onclick="open_modal_perujuk()"><i class="fas fa-list"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group pt-3 text-center">
                            <button class="btn btn-success" type="submit">Ambil Antrian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    var kode_booking = '';
    var loading = '<div class="spinner-border spinner-border-sm" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div> Sedang mencari data...';
    let global_asuransi = <?php echo $asuransi ? $asuransi : null ?>;

    function select_perujuk(param) {
        if ($('#dokter').val() == '' || $('#dokter').val() == null) {
            alert('Pilih dokter dahulu');
            $('#kedatangan').val('');
            return;
        }

        if (param == 'Rujukan') {
            $('#id_perujuk').val('');
            $('#nama_perujuk').val('');
            $('#jenis_perujuk').removeAttr('disabled');
            $('#btn_pilih_perujuk').removeAttr('disabled');
            return;
        } else {
            $('#btn_pilih_perujuk').attr('disabled', true);
            $('#jenis_perujuk').attr('disabled', true);
        }

        if (param == 'Diterima Kembali') {
            $('#jenis_perujuk').removeAttr('disabled');
            $.ajax({
                url: "{{ url('ajax_request/perujuk_by_kodedokter') }}",
                data: {
                    kodedokter: $('#dokter').val()
                },
                success: function(response) {
                    console.log(response);
                    if (response == null) {
                        return;
                    }
                    $('#id_perujuk').val(response.id);
                    $('#nama_perujuk').val(response.nama);
                }
            })
        }
    }

    function open_modal_perujuk() {
        if ($.fn.DataTable.isDataTable('#tabel_perujuk')) {
            $('#tabel_perujuk').dataTable().fnClearTable();
            $('#tabel_perujuk').dataTable().fnDestroy();
        }
        $('#tabel_perujuk').DataTable({
            processing: true,
            serverSide: true,
            pagingType: 'simple',
            ajax: "{!! url('ajax_request/perujuk') !!}", // memanggil route yang menampilkan data json
            columns: [{
                    "data": 'id',
                    name: 'id',
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart +
                            1) + '</div>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_perujuk(' +
                            "'" + data + "','" + row.nama + "'" +
                            ')"><i class="fas fa-check"></i></button></div>';
                    }
                }
            ]
        });
        $('#modal_perujuk').modal('show');
    }

    function set_perujuk(id, nama) {
        $('#id_perujuk').val(id);
        $('#nama_perujuk').val(nama);
        $('#modal_perujuk').modal('hide');
    }

    $('#poli').on('change', function() {
        if ($('#tanggal').val() == '') {
            alert('Pilih tanggal periksa dahulu');
            $('#poli').val('');
            return;
        }
        $('#dokter').html('');
        $('#jam').html('');
        if ($('#poli').val() == '') {
            return;
        }
        $.ajax({
            url: '{{ url("ajax_request/dokter_by_poli") }}',
            data: {
                kode: $('#poli').val(),
            },
            success: function(response) {
                console.log(response);
                if (response.length <= 0) {
                    return;
                }
                let ins = '<option value="">--Select Here--</option>';
                for (let i = 0; i < response.length; i++) {
                    ins += '<option value="' + response[i].kodedokter_bpjs + '">' + response[i].nama_dokter + '</option>';
                }
                $('#dokter').html(ins);
            }
        })
    })

    $('#tanggal').on('change', function() {
        $("#poli").val('');
        $("#dokter").html('');
        $("#jam").html('');
    })

    $('#dokter').on('change', function() {
        if ($('#tanggal').val() == '') {
            alert('Pilih tanggal periksa dahulu');
            $('#dokter').val('');
            return;
        }
        $('#jam').html('');
        if ($('#dokter').val() == '') {
            return;
        }
        $.ajax({
            url: '{{ url("ajax_request/jam_praktek_by_dokter") }}',
            data: {
                dokter: $('#dokter').val(),
                hari: new Date($('#tanggal').val()).getDay()
            },
            success: function(response) {
                console.log(response);
                if (response.length <= 0) {
                    return;
                }
                let ins = '';
                for (let i = 0; i < response.length; i++) {
                    ins += '<option value="' + response[i].jam_mulai + '-' + response[i].jam_selesai + '">' + response[i].jam_mulai + '-' + response[i].jam_selesai + '</option>';
                }
                $('#jam').html(ins);
            }
        })
    })

    $('#jenis_pasien').on('change', function() {
        if ($('#jenis_pasien').val() == '') {
            $('#asuransi').attr('disabled', true);
            $('#perusahaan').attr('disabled', true);
            $('#asuransi').removeAttr('required');
            $('#perusahaan').removeAttr('required');
        } else {
            var temp = $('#jenis_pasien').val().split('-');

            if (temp[1] == 1) {
                $('#asuransi').removeAttr('disabled');
                var temp_ins = '<option value="">--Select Here--</option>';
                if (temp[0] == 'bpjs') {
                    for (let i = 0; i < global_asuransi.length; i++) {
                        if (global_asuransi[i].jenis_pasien == 'bpjs') {
                            temp_ins += '<option value="' + global_asuransi[i].id + '">' + global_asuransi[i].nama + '</option>';
                        }
                    }
                } else {
                    for (let i = 0; i < global_asuransi.length; i++) {
                        if (global_asuransi[i].jenis_pasien != 'bpjs') {
                            temp_ins += '<option value="' + global_asuransi[i].id + '">' + global_asuransi[i].nama + '</option>';
                        }
                    }
                }

                $('#asuransi').html(temp_ins);
                $('#asuransi').attr('required', true);
            } else {
                $('#asuransi').attr('disabled', true);
                $('#asuransi').removeAttr('required');
            }

            if (temp[2] == 1) {
                $('#perusahaan').removeAttr('disabled');
                $('#perusahaan').attr('required', true);
            } else {
                $('#perusahaan').attr('disabled', true);
                $('#perusahaan').removeAttr('required');
            }
        }
    })
</script>

</html>