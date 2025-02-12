<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Kontrol Istimewa Pasien DM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }

        #tabel_identitas tr td {
            border: 1px solid transparent;
        }

        .inputan {
            border: none;
            border-bottom: 1px dotted;
        }

        @media print {
            #main_table td:last-child {
                display: none
            }

            /* table th:last-child {
                display: none
            } */
            .inputan {
                border: none !important;
                border-bottom: 1px dotted !important;
            }

            .input-group-append {
                display: none;
            }
        }
    </style>
</head>

<body>
    <form id="form_dokumen" class="container-fluid">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="verif">
        <div class="container-fluid mt-3">
            <table style="width: 100%;" border="1">
                <tr>
                    <th colspan="4" class="p-3">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                        <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                    </th>
                    <th colspan="4" class="p-3">
                        <table id="tabel_identitas">
                            <tr class="align-top">
                                <td>Nama</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->nama }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>No. RM</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->id }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tgl Lahir</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis Kelamin</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien ? ($pasien->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>NIK</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->ktp }}</td>
                            </tr>
                        </table>
                        <p class="text-right" style="font-weight: normal">
                            <i> *Tempel Label</i>
                        </p>
                    </th>
                </tr>
            </table>
            <table class="table table-bordered table-0 custom-table" id="main_table">
                <tr>
                    <th scope="col" colspan="9" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black">DAFTAR KONTROL ISTIMEWA PASIEN DM</th>
                </tr>
                <tr>
                    <th colspan="2" style="text-indent: 5px;">No. Kamar </th>
                    <th colspan="7"> <input type="text" name="no_kamar" value="{{ $data ? $data->no_kamar : '' }}" class="form-control inputan"></th>
                </tr>
                <tr>
                    <th colspan="2" style="text-indent: 5px;">DPJP </th>
                    <th colspan="7">
                        <input type="hidden" value="{{ $data ? $data->id_dpjp : '' }}" name="id_dpjp">
                        <div class="input-group">
                            <input type="text" value="{{ $data ? $data->dpjp : '' }}" name="dpjp" class="form-control inputan" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" onclick="open_modal_dpjp()"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td rowspan="2" style="text-align: center; width: 10%;">Tanggal </td>
                    <td rowspan="2" style="text-align: center; width: 10%;"> Jam </td>
                    <td style="height: 30px;"> </td>
                    <td style="height: 30px;"></td>
                    <td style="height: 30px;"></td>
                    <td style="height: 30px;"></td>
                    <td style="height: 30px;"></td>
                </tr>
                <tr>
                    <td style="text-align: center; height: 30px;">Hasil </td>
                    <td style="text-align: center; height: 30px;">Terapi </td>
                    <td style="text-align: center; height: 30px;">Nama </td>
                    <td style="text-align: center; height: 30px;">Paraf</td>
                    <td style="text-align: center; height: 30px;" class="pt-2 pb-2">
                        <button type="button" class="btn btn-success" id="btn-plus"><i class="fa fa-plus"></i></button>
                    </td>
                </tr>
                <tbody id="list_data"></tbody>
                <textarea name="list_data" id="list_data_input" style="display: none;"></textarea>
            </table>

            <table style="border-collapse: collapse; width:100%" class="mb-3">
                <tr class="align-top">
                    <td style="width: 12%;">Nilai Normal</td>
                    <td style="width: 3%;"> : </td>
                    <td style="width: 85%;">
                        <input name="nilai_normal" value="{{ $data ? $data->nilai_normal : '' }}" type="text" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <div class="modal fade" id="modal_dpjp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pilih DPJP.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabel_dpjp" class="table table-striped mt-2" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let data = <?php echo $data ? json_encode($data->list_data) : '[]' ?>;
    $(document).ready(function(){
        render_data();
    })

    $('#btn-plus').click(function() {
        data.push({
            'tanggal': '',
            'jam': '',
            'hasil': '',
            'terapi': '',
            'nama': '',
            'status': 0,
            'id_verifikator': 0,
            'nama_verifikator': ''
        });

        render_data();
    })

    function render_data() {
        if (data.length < 1) {
            $('#list_data').html('');
            return;
        }

        var ins = '';
        for (let i = 0; i < data.length; i++) {
            ins += '<tr>' +
                `<td style="text-align: center; height: 30px; padding:10px"><input value="`+data[i].tanggal+`" `+(data[i].status ? `disabled` : ``)+` id="tanggal_` + i + `" type="text" class="text-center form-control datepicker inputan"></td>` +
                `<td style="text-align: center; height: 30px; padding:10px"><input value="`+data[i].jam+`" `+(data[i].status ? `disabled` : ``)+` id="jam_` + i + `" type="text" class="text-center form-control timepicker inputan"></td>` +
                '<td style="text-align: center; height: 30px; padding:10px">' +
                `<input `+(data[i].status ? `readonly` : ``)+` id="hasil_` + i + `" value="`+data[i].hasil+`" type="text" class="form-control inputan">` +
                '</td>' +
                '<td style="text-align: center; height: 30px; padding:10px">' +
                `<input `+(data[i].status ? `readonly` : ``)+` id="terapi_` + i + `" value="`+data[i].terapi+`" type="text" class="form-control inputan">` +
                '</td>' +
                '<td style="text-align: center; height: 30px; padding:10px">' +
                `<input `+(data[i].status ? `readonly` : ``)+` id="nama_` + i + `" value="`+data[i].nama+`" type="text" class="form-control inputan">` +
                '</td>' +
                '<td style="text-align: center; height: 30px; padding:10px">' +
                (data[i].status == 1 ? `<img src="{{ env('SMIS_UPLOAD_URL') }}/`+(data[i].employee ? data[i].employee.ttd : '')+`" style="width:4cm; height:2.5cm" />` : '')+
                '</td>' +
                '<td style="text-align: center; height: 30px; padding:10px">' +
                '<div style="fisplay:flex; justify-content:center;">' +
                (data[i].status == 0 ? `<button type="button" date-toggle="tooltip" title="Verifikasi" class="btn btn-warning mr-1" style="color:#fff;" onclick="verifikasi_data(` + i + `)"><i class="fa fa-check"></i></button>` : '') +
                (data[i].status == 0 ? `<button type="button" date-toggle="tooltip" title="Simpan" class="btn btn-primary mr-1" onclick="simpan_data(` + i + `)"><i class="fa fa-floppy-o"></i></button>` : '') +
                (data[i].status == 0 ? '<button type="button" date-toggle="tooltip" title="Hapus" onclick="hapus_data('+i+')" class="btn btn-danger"><i class="fa fa-trash"></i></button>' : '') +
                '</div>' +
                '</td>' +
                '</tr>';
        }

        $('#list_data').html(ins);

        $('.timepicker').daterangepicker({
            locale: {
                format: 'HH:mm'
            },
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find(".calendar-table").hide();
        });

        $('.datepicker').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            useCurrent: false,
            autoUpdateInput: false,
            singleDatePicker: true,
            timePicker: false,
            timePicker24Hour: false,
        });

        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            if ($(this).is('[readonly]')) {
                return;
            }
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });

        $('.timepicker').on('apply.daterangepicker', function(ev, picker) {
            if ($(this).is('[readonly]')) {
                $(this).val($(this).val());
                return;
            }else{
                $(this).val(picker.startDate.format('HH:mm'));
            }
        });
    }

    function hapus_data(index){
        if (!confirm('Yakin melanjutkan hapus data ? data yang dihapus tidak dapat dikembalikan')) {
            return;
        }

        if(data[index].status){
            toastr.error('Data sudah diverifikasi, tidak dapat dihapus.');
            return;
        }

        data.splice(index,1);
        update_dokumen();
    }

    function verifikasi_data(index) {
        if (!confirm('Yakin melanjutkan verifikasi ? ')) {
            return;
        }

        if (cek_tanggal()) {
            toastr.error('Terdapat tanggal yang tidak valid');
            return;
        }

        data[index].tanggal = $('#tanggal_' + index).val();
        data[index].jam = $('#jam_' + index).val();
        data[index].hasil = $('#hasil_' + index).val();
        data[index].terapi = $('#terapi_' + index).val();
        data[index].nama = $('#nama_' + index).val();
        data[index].status = 1;
        data[index].id_verifikator = '{{ Auth::user()->id }}';
        data[index].nama_verifikator = '{{ Auth::user()->realname }}';

        $('[name=verif]').val('1');

        update_dokumen();
    }

    function cek_tanggal(){
        let cek = false;
        for (let i = 0; i < data.length; i++) {
            if (!moment($('#tanggal_' + i).val(), "DD-MM-YYYY", true).isValid()) {
                cek = true;
                break;
            }
        }
        return cek;
    }

    function simpan_data(index) {

        if (cek_tanggal()) {
            toastr.error('Terdapat tanggal yang tidak valid');
            return;
        }

        data[index].tanggal = $('#tanggal_' + index).val();
        data[index].jam = $('#jam_' + index).val();
        data[index].hasil = $('#hasil_' + index).val();
        data[index].terapi = $('#terapi_' + index).val();
        data[index].nama = $('#nama_' + index).val();
        
        $('[name=verif]').val('0');

        update_dokumen();        
    }

    // function set_value_data(kolom, value, index) {
    //     switch (kolom) {
    //         case 'tanggal':
    //             data[index].tanggal = value;
    //             break;
    //         case 'jam':
    //             data[index].jam = value;
    //             break;
    //         case 'hasil':
    //             data[index].hasil = value;
    //             break;
    //         case 'terapi':
    //             data[index].terapi = value;
    //             break;
    //         case 'nama':
    //             data[index].nama = value;
    //             break;

    //         default:
    //             break;
    //     }
    // }

    function update_dokumen() {
        $('#list_data_input').val(JSON.stringify(data));
        toastr.warning('Sedang update dokumen, harap tunggu...');
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/daftar_kontrol_istimewa_pasien_dm/store') }}",
            method: 'post',
            data: $('#form_dokumen').serialize(),
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                data = response.data;
                $('[name=verif]').val('');
                render_data();
            }
        })
    }
</script>

<script>
    function open_modal_dpjp() {
        if ($.fn.DataTable.isDataTable("#tabel_dpjp")) {
            $('#tabel_dpjp').DataTable().clear().destroy();
        }

        $('#tabel_dpjp').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: '{{ url("ajax_request/dokter") }}',
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) +
                            '</p>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_jabatan',
                    name: 'nama_jabatan',
                    render(data, type, row) {
                        return '<p class="text-center">' + data + '</p>';
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render(data, type, row) {
                        var fungsi_set = 'set_dpjp(' + "'" + data + "','" + row.nama + "'" + ')';
                        return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });

        $('#modal_dpjp').modal('show');
    }

    function set_dpjp(id, nama) {
        $('[name=dpjp]').val(nama);
        $('[name=id_dpjp]').val(id);
        $('#modal_dpjp').modal('hide');
    }
</script>

<script>
    $('.datetimepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm'
        },
        useCurrent: false,
        autoUpdateInput: true,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });

    $('.timepicker').daterangepicker({
        locale: {
            format: 'HH:mm'
        },
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY'
        },
        useCurrent: false,
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
        timePicker24Hour: false,
    });

    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });
</script>

</html>