<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Pemberian Obat</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap4.css">

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

        #list_pemberian_obat tr td {
            padding: 5px;
        }

        .inputan {
            border: none;
            border-bottom: 1px dotted;
        }

        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
            cursor: pointer;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }

        @media print {
            @page {
                size: landscape
            }

            .hidden-on-print {
                display: none;
            }
        }
    </style>
</head>

<body class="mt-3 p-3">
    <div class="container-fluid mt-3">
        <table class="table table-bordered table-0 custom-table" style="width: 150%; margin-bottom:0;">
            <tr>
                <th style="width: 50%;">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                    <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                </th>
                <th style="width: 50%;">
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
        <table class="table table-bordered table-0 custom-table" style="width: 150%">
            <thead>
                <tr>
                    <th scope="col" colspan="3" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">DAFTAR PEMBERIAN OBAT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 33%; font-size: 14px; padding: 4px;" class="pl-3">
                        *Tuliskan Pada Kolom Jam Pemberian Obat <br />
                        Tulis Angka : Setelah Obat diberikan <br />
                        T &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Pasien Menolak <br />
                        K &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Kondisi Pasien Menyebabkan ditundanya Pemberian Obat <br />
                        A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Reaksi Obat <br />
                        ESO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Reaksi Efeksamping Obat Setelah Pemberian <br />
                        TAP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Obat Tidak Tersedia
                    </td>

                    <td style="width: 33%; font-size: 14px;" class="pl-3">
                        KETERANGAN PEMBERIAN OBAT <br />
                        <ol>
                            <li>Tulis nama obat dengan hurus kapital</li>
                            <li>Tulis jam pemberian obat pada kolom waktu pemberian. Contoh: 13</li>
                            <li>Bila obat sudah diberikan kepada pasien tandai dengan melingkari pada kolom jam yang sudah diberikan. Contoh : 13</li>
                        </ol>
                    </td>

                    <td style="width: 33%; font-size: 14px;" class="pl-3">
                        OBAT INJEK <br />
                        1 x 1 &nbsp;&nbsp; : Pagi 06. - 07. WIB <br />
                        1 x 1 &nbsp;&nbsp; : Sore 21. - 22. WIB <br />
                        2 x 1 &nbsp;&nbsp; : 06. - 07. / 18. - 19. WIB <br />
                        1 x 1 &nbsp;&nbsp; : 06. - 07. / 14. - 15. / 22. - 23. WIB <br />
                        1 x 1 &nbsp;&nbsp; : 06. - 07. / 12. - 13. / 18. - 19. / 24. - 01. WIB
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container-fluid mt-3">
        <table class="table table-bordered table-0 custom-table" style="width: 150%;">
            <tbody>
                <?php $tanggal = $data ? json_decode($data->tanggal) : ['','','']; ?>
                <tr>
                    <td style=" font-size: 14px; text-align: center; width:2%"> No </td>
                    <td style=" font-size: 14px; text-align: center; width:15%"> Nama Obat </td>
                    <td style=" font-size: 14px; text-align: center; width:15%"> Dosis </td>
                    <td style=" font-size: 14px; text-align: center; width:15%"> Cara Pemberian </td>
                    <td style=" font-size: 14px; text-align: center; width:15%"> Jumlah Obat </td>
                    <td colspan="6" style=" font-size: 14px; text-align: center;"> Tgl: <input type="text" value="{{ $tanggal[0] }}" class="inputan datepicker" id="tanggal_1" style="width:25%" /></td>
                    <td style=" font-size: 14px; text-align: center;"> Ket </td>
                    <td colspan="6" style=" font-size: 14px; text-align: center;"> Tgl: <input type="text" value="{{ $tanggal[1] }}" class="inputan datepicker" id="tanggal_2" style="width:25%" /> </td>
                    <td style=" font-size: 14px; text-align: center;">ket </td>
                    <td colspan="6" style=" font-size: 14px; text-align: center;"> Tgl: <input type="text" value="{{ $tanggal[2] }}" class="inputan datepicker" id="tanggal_3" style="width:25%" /> </td>
                    <td style=" font-size: 14px; text-align: center;">ket </td>
                    <td class="text-center p-2" style="width:3%;">
                        <button class="btn btn-success" onclick="add_row()"><i class="fa fa-plus"></i></button>
                    </td>
                </tr>
            <tbody id="list_pemberian_obat"></tbody>
            <tr>
                <td class="pl-2" colspan="5"> Nama & Paraf Perawat/Bidan :</td>
                @for($i =0; $i < 6; $i++) <td class="p-2" style="width:3%; text-align: center; font-size:10px;" id="paraf_bidan_{{$i}}">
                    </td>
                    @endfor
                    <td style=" font-size: 14px;"> </td>
                    @for($i =6; $i < 12; $i++) <td class="p-2" style="width:3%; text-align: center; font-size:10px;" id="paraf_bidan_{{$i}}">
                        </td>
                        @endfor
                        <td style=" font-size: 14px;"> </td>
                        @for($i =12; $i < 18; $i++) <td class="p-2" style="width:3%; text-align: center; font-size:10px;" id="paraf_bidan_{{$i}}">
                            </td>
                            @endfor
                            <td style=" font-size: 14px;"> </td>
                            <td style=" font-size: 14px;"> </td>
            </tr>
            <tr>
                <td class="pl-2" colspan="5"> Paraf Pasien/Keluarga Pasien :</td>
                @for($i =0; $i < 6; $i++) <td class="text-center p-2" style="width:3%; text-align: center; font-size:10px;" id="paraf_pasien_{{$i}}">
                    </td>
                    @endfor
                    <td style=" font-size: 14px;"> </td>
                    @for($i =6; $i < 12; $i++) <td class="text-center p-2" style="width:3%; text-align: center; font-size:10px;" id="paraf_pasien_{{$i}}">
                        </td>
                        @endfor
                        <td style=" font-size: 14px;"> </td>
                        @for($i =12; $i < 18; $i++) <td class="text-center p-2" style="width:3%; text-align: center; font-size:10px;" id="paraf_pasien_{{$i}}">
                            </td>
                            @endfor
                            <td style=" font-size: 14px;"> </td>
                            <td style=" font-size: 14px;"> </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modal_list_obat" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered nowrap" id="tabel_list_obat" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>Obat</th>
                                <th>Jenis</th>
                                <!-- <th>Zat Aktif</th>
                                <th>Komposisi</th>
                                <th>Stok</th> -->
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

    <div class="modal fade" id="modal_tanda_tangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_tanda_tangan">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="index_verifikasi_pasien">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                            </div>
                            <div class="form-group text-center">
                                <input type="text" id="nama_pasien" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Bidan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verifikasi">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="index_verifikasi">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Masukkan password anda">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="form_dokumen" style="display: hidden;">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="password">
        <input type="hidden" name="idx">
        <input type="hidden" name="tanggal">
        <input type="hidden" name="signed">
        <input type="hidden" name="nama_pasien">
        <input type="hidden" name="verif" id="jenis_verif">
        <input type="hidden" name="list_pemberian_obat">
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    let data = <?php echo $data ? $data->list_pemberian_obat : '[]' ?>;
    let paraf = <?php echo $data ? $data->paraf : '[{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{}]' ?>

    $(document).ready(function() {
        render_data();
        render_paraf();
    })

    function add_row() {
        data.push({
            'nama_obat': '',
            'dosis': '',
            'cara_pemberian': '',
            'jumlah': '',
            'jam_1': ['00', '00', '00', '00', '00', '00'],
            'ket_1': '',
            'jam_2': ['00', '00', '00', '00', '00', '00'],
            'ket_2': '',
            'jam_3': ['00', '00', '00', '00', '00', '00'],
            'ket_3': '',
        });

        render_data();
    }

    function simpan_data(index) {
        set_data(index);
        update_dokumen();
    }

    function convert_jam(jam){
        if (jam == '' || jam == null) {
            return '';
        }

        let temp = jam.split(':');
        return temp[0];
    }

    function set_data(index){
        data[index] = {
            'nama_obat': $('#nama_obat_' + index).val(),
            'dosis': $('#dosis_' + index).val(),
            'cara_pemberian': $('#cara_pemberian_' + index).val(),
            'jumlah': $('#jumlah_' + index).val(),
            'jam_1': [
                convert_jam($('#jam_1_' + index + '_0').val()),
                convert_jam($('#jam_1_' + index + '_1').val()),
                convert_jam($('#jam_1_' + index + '_2').val()),
                convert_jam($('#jam_1_' + index + '_3').val()),
                convert_jam($('#jam_1_' + index + '_4').val()),
                convert_jam($('#jam_1_' + index + '_5').val())
            ],
            'ket_1': $('#ket_1_' + index).val(),
            'jam_2': [
                convert_jam($('#jam_2_' + index + '_0').val()),
                convert_jam($('#jam_2_' + index + '_1').val()),
                convert_jam($('#jam_2_' + index + '_2').val()),
                convert_jam($('#jam_2_' + index + '_3').val()),
                convert_jam($('#jam_2_' + index + '_4').val()),
                convert_jam($('#jam_2_' + index + '_5').val())
            ],
            'ket_2': $('#ket_2_' + index).val(),
            'jam_3': [
                convert_jam($('#jam_3_' + index + '_0').val()),
                convert_jam($('#jam_3_' + index + '_1').val()),
                convert_jam($('#jam_3_' + index + '_2').val()),
                convert_jam($('#jam_3_' + index + '_3').val()),
                convert_jam($('#jam_3_' + index + '_4').val()),
                convert_jam($('#jam_3_' + index + '_5').val())
            ],
            'ket_3': $('#ket_3_' + index).val()
        }
        return true;
    }

    function render_paraf() {
        if (paraf.length < 1) {
            return;
        }

        console.log(paraf);

        for (let i = 0; i < paraf.length; i++) {
            paraf[i].bidan != undefined && paraf[i].bidan.name != '' ? $('#paraf_bidan_' + i).html(`<img style="width:0.5cm; height:0.5cm;" src="{{ url('SMIS_UPLOAD_URL') }}/`+paraf[i].bidan.signature+`" /><br>`+paraf[i].bidan.name) : $('#paraf_bidan_' + i).html('<button onclick="open_modal_verifikasi_bidan(' + i + ')" class="btn btn-sm btn-warning" style="font-size:12px; color:#fff"><i class="fa fa-pencil"></i></button>');
            paraf[i].pasien != undefined && paraf[i].pasien.name != '' ? $('#paraf_pasien_' + i).html(`<img style="width:0.5cm; height:0.5cm;" src="{{ asset('signature_patient') }}/`+paraf[i].pasien.signature+`" /><br>`+paraf[i].pasien.name) : $('#paraf_pasien_' + i).html('<button onclick="open_modal_verifikasi_pasien(' + i + ')" class="btn btn-sm btn-warning" style="font-size:12px; color:#fff"><i class="fa fa-pencil"></i></button>');
        }
    }

    function open_modal_verifikasi_bidan(index) {
        $('#index_verifikasi').val(index);
        $('#modal_verifikasi').modal('show');
    }

    function open_modal_verifikasi_pasien(index) {
        $('#index_verifikasi_pasien').val(index);
        $('#modal_tanda_tangan').modal('show');
    }

    $('#form_verifikasi').submit(function(e) {
        e.preventDefault();

        if (!confirm('Yakin melanjutkan verifikasi ? tidak dapat mengubah tanda tangan setelah verifikasi')) {
            $('#modal_verifikasi').modal('hide');
            $('#form_verifikasi')[0].reset();
            return;
        }

        $('[name=password]').val($('#password').val());
        $('#jenis_verif').val('bidan');
        $('[name=idx]').val($('#index_verifikasi').val());
        $('#modal_verifikasi').modal('hide');
        update_dokumen();
    })

    $('#form_tanda_tangan').submit(function(e) {
        e.preventDefault();

        if (!confirm('Yakin melanjutkan simpan tanda tangan dan nama pasien ? tidak dapat mengubah tanda tangan setelah disimpan')) {
            $('#modal_tanda_tangan').modal('hide');
            $('#form_tanda_tangan')[0].reset();
            return;
        }

        $('[name=signed]').val(signaturePad.toDataURL('image/png'));
        $('[name=nama_pasien]').val($('#nama_pasien').val());
        $('[name=idx]').val($('#index_verifikasi_pasien').val());
        $('#jenis_verif').val('pasien');
        $('#modal_tanda_tangan').modal('hide');
        update_dokumen();
    })

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("[name=signed]").val('');
        $("#nama_pasien").val('');
    });

    function update_dokumen() {
        toastr.warning('Sedang update dokumen, harap tunggu...');
        $('[name=list_pemberian_obat]').val(JSON.stringify(data));

        let tanggal = [];

        for (let i = 0; i < 3; i++) {
            tanggal[i] = $('#tanggal_'+(i+1)).val();
        }

        $('[name=tanggal]').val(JSON.stringify(tanggal));

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/daftar_pemberian_obat/store') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    $('#form_verifikasi')[0].reset();
                    $('#form_tanda_tangan')[0].reset();
                    return;
                }

                toastr.success(response.message);

                data = JSON.parse(response.data.list_pemberian_obat);
                paraf = JSON.parse(response.data.paraf);

                $('#form_verifikasi')[0].reset();
                $('#form_tanda_tangan')[0].reset();
                $('#form_dokumen')[0].reset();
                $('[name=dokumen]').val('{{ $dokumen->id }}');

                render_data();
                render_paraf();
            }
        })
    }

    function render_data() {
        if (data.length < 1) {
            $('#list_pemberian_obat').html('');
            return;
        }

        var ins = '';
        for (let i = 0; i < data.length; i++) {
            ins += '<tr>' +
                '<td style="font-size: 14px; text-align:center;">' + (i + 1) + '</td>' +
                '<td style="font-size: 14px; width: 35%;"><input type="text" id="nama_obat_' + i + '" value="' + data[i].nama_obat + '" style="width: 100%" class="inputan" /> </td>' +
                '<td style="font-size: 14px; width: 25%;"><input type="text" id="dosis_' + i + '" value="' + data[i].dosis + '" style="width: 100%" class="inputan" /></td>' +
                '<td style="font-size: 14px; width: 25%;"><input type="text" id="cara_pemberian_' + i + '" value="' + data[i].cara_pemberian + '" style="width: 100%" class="inputan" /></td>' +
                '<td style="font-size: 14px; width: 25%;"><input type="text" id="jumlah_' + i + '" value="' + data[i].jumlah + '" style="width: 100%" class="inputan" /></td>';
            for (let j = 0; j < 6; j++) {
                ins += '<td style="font-size: 14px; text-align:center;"><input type="text" value="' + data[i].jam_1[j] + '" style="width:30px; text-align:center;" class="" id="jam_1_' + i + '_' + j + '" /></td>';
            }

            ins += '<td style="font-size: 14px;"><input type="text" id="ket_1_' + i + '" value="' + data[i].ket_1 + '" class="inputan form-control"</td>';
            for (let j = 0; j < 6; j++) {
                ins += '<td style="font-size: 14px; text-align:center;"><input type="text" value="' + data[i].jam_2[j] + '" style="width:30px; text-align:center;" class="" id="jam_2_' + i + '_' + j + '" /></td>';
            }

            ins += '<td style="font-size: 14px;"><input type="text" id="ket_2_' + i + '" value="' + data[i].ket_2 + '" class="inputan form-control"</td>';
            for (let j = 0; j < 6; j++) {
                ins += '<td style="font-size: 14px; text-align:center;"><input type="text" value="' + data[i].jam_3[j] + '" style="width:30px; text-align:center;" class="" id="jam_3_' + i + '_' + j + '" /></td>';
            }

            ins += '<td style="font-size: 14px;"><input type="text" id="ket_3_' + i + '" value="' + data[i].ket_3 + '" class="inputan form-control"</td>' +
                '<td style="font-size: 14px; text-align:center;">' +
                '<button class="btn btn-info" onclick="simpan_data(' + i + ')"><i class="fa fa-check"></i></button>' +
                '</td>' +
                '</tr>';
        }
        $('#list_pemberian_obat').html(ins);
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

        $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('.timepicker').daterangepicker({
            locale: {
                format: 'HH'
            },
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find(".calendar-table").hide();
        });

        $('.timepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('HH'));
        });

        $('.timepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    }

    $(".autocomplete_obat").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {}
    })

    function open_modal_obat(index) {
        if ($.fn.DataTable.isDataTable("#tabel_list_obat")) {
            $('#tabel_list_obat').DataTable().clear().destroy();
        }
        $('#tabel_list_obat').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            theme: 'bootstrap4',
            ajax: "{{ url('ajax_request/list_obat?depo=depo_farmasi&kriteria=') }}",
            columns: [{
                    data: 'nama_obat',
                    name: 'nama_obat'
                },
                {
                    data: 'nama_jenis_obat',
                    name: 'nama_jenis_obat'
                },
                {
                    data: 'nama_obat',
                    name: 'nama_obat',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<div class="text-center">' +
                            '<button onclick="set_obat(' + "'" + data + "','" + index + "'" + ')" class="btn btn-dark"><i class="fa fa-check"></i></button>' +
                            '</div>';
                    }
                },
            ]
        });
        $('#modal_list_obat').modal('show');
    }

    function set_obat(obat, index) {
        $('#nama_obat_' + index).val(obat);
        $('#modal_list_obat').modal('hide');
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
</script>
<script>
    $('.timepicker').daterangepicker({
        locale: {
            format: 'HH'
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

    $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.timepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('HH'));
    });

    $('.timepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });
</script>

</html>