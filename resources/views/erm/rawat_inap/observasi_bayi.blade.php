<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Observasi Bayi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        @media print {
            .hidden_on_print {
                display: none;
            }

            #tabel_data td:nth-child(12) {
                display: none;
            }

            #tabel_data th:nth-child(12) {
                display: none;
            }
        }

        .border {
            border: 1px solid black !important;
        }

        .table.table-bordered td,
        .table.table-bordered th {
            border: 1px solid black !important;
        }

        .input-dotted {
            border: none !important;
            border-bottom: 1px dotted black !important;
        }
    </style>
</head>

<body class="p-2">
    <div class="container-fluid pl-0 pr-0">
        <div class="w-100 text-right">RSHM/VK/02/.00/Rev.00</div>
        <table class="w-100">
            <tr>
                <td class="align-top" style="width: 47.5%;">
                    <div class="px-4 py-3" style="height: 100%;">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                        <div class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupaten Bekasi Jawa Barat (17340).<br>Telp : (021) 8995 2340, Fax : (021) 8995 2340</div>
                    </div>
                </td>
                <td style="width: 5%;"></td>
                <td class="align-top" style="width: 47.5%;">
                    <div class="float-right px-4 py-3 border" style="height: 100%; border-radius:20px;">
                        <table>
                            <tr class="align-top">
                                <td>Nama</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ $dokumen->nama_pasien }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>No. RM</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ $dokumen->nrm }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tgl Lahir</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis Kelamin</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <table class="mt-2 w-100">
            <tr>
                <th class="align-middle text-center" style="font-size: 20px;">OBSERVASI BAYI</th>
            </tr>
        </table>
        <table class="mt-2">
            <tr>
                <td class="pt-4">BB</td>
                <td class="pt-4"> : </td>
                <td class="pt-4">
                    <input type="text" value="{{ isset($data) ? isset($data[0]) ? $data[0]->bb : ($ttv ? $ttv->berat_badan : '') : ($ttv ? $ttv->berat_badan : '') }}" id="bb">
                </td>
            </tr>
            <tr>
                <td class="pt-4">PB</td>
                <td class="pt-4"> : </td>
                <td class="pt-4">
                    <input type="text" value="{{ isset($data) ? isset($data[0]) ? $data[0]->pb : ($ttv ? $ttv->tinggi_badan : '') : ($ttv ? $ttv->tinggi_badan : '') }}" id="pb">
                </td>
            </tr>
        </table>
        <table class="mt-2 w-100 hidden_on_print">
            <tr>
                <td style="text-align:right;">
                    <button class="btn btn-success" onclick="open_modal_add()" type="button">Tambah</button>
                </td>
            </tr>
        </table>
        <table class="mt-2 w-100" border="1" id="tabel_data">
            <thead>
                <tr class="text-center">
                    <th class="p-2">TGL</th>
                    <th class="p-2">JAM</th>
                    <th class="p-2">SUHU</th>
                    <th class="p-2">RR</th>
                    <th class="p-2">NADI</th>
                    <th class="p-2">MINUM</th>
                    <th class="p-2">MUNTAH</th>
                    <th class="p-2">MECO</th>
                    <th class="p-2">MIKSI</th>
                    <th class="p-2">KETERANGAN</th>
                    <th class="p-2">PERAWAT</th>
                    <th class="p-2">ACTION</th>
                </tr>
            </thead>
            <tbody id="list">
                @if(sizeof($data) < 1) <tr>
                    <td colspan="12" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @else
                    @foreach($data as $d)
                    <tr>
                        <td class="p-2">{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                        <td class="p-2">{{ $d->jam }}</td>
                        <td class="p-2">{{ $d->suhu }}</td>
                        <td class="p-2">{{ $d->rr }}</td>
                        <td class="p-2">{{ $d->nadi }}</td>
                        <td class="p-2">{{ $d->minum }}</td>
                        <td class="p-2">{{ $d->muntah }}</td>
                        <td class="p-2">{{ $d->meco }}</td>
                        <td class="p-2">{{ $d->miksi }}</td>
                        <td class="p-2">{{ $d->keterangan }}</td>
                        <td class="p-2">{{ $d->perawat }}</td>
                        <td class="p-2">
                            <div style="display: flex; flex-direction: row; justify-content: center;">
                                <button class="btn btn-warning" onclick="open_modal_edit('{{$d->id}}')" style="color: #fff;"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger ml-1" onclick="hapus_data('{{$d->id}}')" style="color: #fff;"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_add">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="bb">
                    <input type="hidden" name="pb">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jam</label>
                            <input type="time" name="jam" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Suhu</label>
                            <input type="number" min="0" step="0.01" name="suhu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">RR</label>
                            <input type="number" min="0" name="rr" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nadi</label>
                            <input type="number" min="0" name="nadi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Minum</label>
                            <input type="text" name="minum" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Muntah</label>
                            <input type="text" name="muntah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Meco</label>
                            <input type="text" name="meco" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Miksi</label>
                            <input type="text" name="miksi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Perawat</label>
                            <input type="hidden" name="id_perawat" value="{{ Auth::user()->id }}">
                            <input type="text" name="perawat" readonly value="{{ Auth::user()->realname }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="bb">
                    <input type="hidden" name="pb">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jam</label>
                            <input type="time" name="jam" id="edit_jam" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Suhu</label>
                            <input type="number" min="0" name="suhu" step="0.01" id="edit_suhu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">RR</label>
                            <input type="number" min="0" name="rr" id="edit_rr" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nadi</label>
                            <input type="number" min="0" name="nadi" id="edit_nadi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Minum</label>
                            <input type="text" name="minum" id="edit_minum" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Muntah</label>
                            <input type="text" name="muntah" id="edit_muntah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Meco</label>
                            <input type="text" name="meco" id="edit_meco" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Miksi</label>
                            <input type="text" name="miksi" id="edit_miksi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="keterangan" id="edit_keterangan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Perawat</label>
                            <input type="hidden" name="id_perawat" value="{{ Auth::user()->id }}">
                            <input type="text" name="perawat" readonly value="{{ Auth::user()->realname }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://malsup.github.io/jquery.blockUI.js"></script>
<script>
    function open_modal_add() {
        $('#modal_add').modal('show');
    }

    $('#form_add').submit(function(e) {
        e.preventDefault();
        $('[name=bb]').val($('#bb').val());
        $('[name=pb]').val($('#pb').val());
        $.ajax({
            url: "{{ url('e_rekam_medis/rawat_inap/observasi_bayi/store') }}",
            data: $('#form_add').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    alert(response.message);
                    return;
                }
                $('#modal_add').modal('hide');
                $('#form_add')[0].reset();
                render_data(response.data);
            }
        })
    })

    $('#form_edit').submit(function(e) {
        e.preventDefault();
        $('[name=bb]').val($('#bb').val());
        $('[name=pb]').val($('#pb').val());
        $.ajax({
            url: "{{ url('e_rekam_medis/rawat_inap/observasi_bayi/update') }}",
            data: $('#form_edit').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    alert(response.message);
                    return;
                }
                $('#modal_edit').modal('hide');
                $('#form_edit')[0].reset();
                render_data(response.data);
            }
        })
    })

    function hapus_data(id) {
        if (confirm('Yakin melanjutkan hapus data ? data yang dihapus tidak dapat dikembalikan')) {
            $.ajax({
                url: "{{ url('e_rekam_medis/rawat_inap/observasi_bayi/delete') }}",
                data: {
                    id: id,
                    dokumen : '{{ $dokumen->id }}'
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    render_data(response.data);
                }
            })
        }
    }

    function render_data(data) {
        if (data.length < 1) {
            $('#list').html('<td colspan="12" class="text-center">Data tidak ditemukan</td></tr>');
            return;
        }
        var ins = '';
        for (let i = 0; i < data.length; i++) {
            ins += '<tr>' +
                '<td class="p-2">' + tanggal_dmy(data[i].tanggal) + '</td>' +
                '<td class="p-2">' + data[i].jam + '</td>' +
                '<td class="p-2">' + data[i].suhu + '</td>' +
                '<td class="p-2">' + data[i].rr + '</td>' +
                '<td class="p-2">' + data[i].nadi + '</td>' +
                '<td class="p-2">' + data[i].minum + '</td>' +
                '<td class="p-2">' + data[i].muntah + '</td>' +
                '<td class="p-2">' + data[i].meco + '</td>' +
                '<td class="p-2">' + data[i].miksi + '</td>' +
                '<td class="p-2">' + data[i].keterangan + '</td>' +
                '<td class="p-2">' + data[i].perawat + '</td>' +
                '<td class="p-2">' +
                '<div style="display: flex; flex-direction: row; justify-content: center;">' +
                '<button class="btn btn-warning" onclick="open_modal_edit(' + "'" + data[i].id + "'" + ')" style="color: #fff;"><i class="fa fa-pencil"></i></button>' +
                '<button class="btn btn-danger ml-1" onclick="hapus_data(' + "'" + data[i].id + "'" + ')" style="color: #fff;"><i class="fa fa-trash"></i></button>' +
                '</div>' +
                '</td>' +
                '</tr>';
        }
        $('#list').html(ins);
    }

    function tanggal_dmy(param) {
        if (param == '' || param == null) {
            return '';
        }
        let temp = param.split('-');
        return temp[2] + '-' + temp[1] + '-' + temp[0];
    }

    function open_modal_edit(id) {
        $.ajax({
            url: "{{ url('e_rekam_medis/rawat_inap/observasi_bayi/select') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }

                $('#edit_id').val(response.id);
                $('#edit_tanggal').val(response.tanggal);
                $('#edit_jam').val(response.jam);
                $('#edit_suhu').val(response.suhu);
                $('#edit_rr').val(response.rr);
                $('#edit_nadi').val(response.nadi);
                $('#edit_minum').val(response.minum);
                $('#edit_muntah').val(response.muntah);
                $('#edit_meco').val(response.meco);
                $('#edit_miksi').val(response.miksi);
                $('#edit_keterangan').val(response.keterangan);
                $('#edit_perawat').val(response.perawat);

                $('#modal_edit').modal('show');
            }
        })
    }
</script>

</html>