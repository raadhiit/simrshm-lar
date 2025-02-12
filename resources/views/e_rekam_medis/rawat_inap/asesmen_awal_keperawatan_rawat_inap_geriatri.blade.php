<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    {{-- <meta name="viewport" content="width=device-width" /> --}}
    <title>Asesmen Awal Keperawatan Rawat Inap Geriatri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"defer></script>
    <script>
        function open_modal_dokter_mengirim() {
            if ($.fn.DataTable.isDataTable('#tabel_dokter_mengirim')) {
                $('#tabel_dokter_mengirim').dataTable().fnClearTable();
                $('#tabel_dokter_mengirim').dataTable().fnDestroy();
            }
            $('#tabel_dokter_mengirim').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('ajax_request/datatable_dokter') }}",
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'no_ijin',
                        name: 'no_ijin'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<div class="text-center"><button class="btn btn-dark" onclick="set_dokter_mengirim(' +
                                "'" + row.nama + "','" + data + "'" +
                                ')"><i class="fa fa-check"></i></button></div>';
                        }
                    },
                ]
            });
            $('#modal_dokter_mengirim').modal('show');
        }

        function open_modal_dokter_merawat() {
            if ($.fn.DataTable.isDataTable('#tabel_dokter_merawat')) {
                $('#tabel_dokter_merawat').dataTable().fnClearTable();
                $('#tabel_dokter_merawat').dataTable().fnDestroy();
            }
            $('#tabel_dokter_merawat').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('ajax_request/datatable_dokter') }}",
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'no_ijin',
                        name: 'no_ijin'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<div class="text-center"><button class="btn btn-dark" onclick="set_dokter_merawat(' +
                                "'" + row.nama + "','" + data + "'" +
                                ')"><i class="fa fa-check"></i></button></div>';
                        }
                    },
                ]
            });
            $('#modal_dokter_merawat').modal('show');
        }

        function set_dokter_mengirim(nama,id){
            $('#id_dokter_mengirim').val(id);
            $('#dokter_mengirim').val(nama);
            $('#modal_dokter_mengirim').modal('hide');
        }

        function set_dokter_merawat(nama,id){
            $('#id_dokter_merawat').val(id);
            $('#dokter_merawat').val(nama);
            $('#modal_dokter_merawat').modal('hide');
        }
    </script>
</head>
<style type="text/css" media="screen">
    body {
        margin: 50px 3%;
    }

    /* Memberikan border tabel dengan ketebalan 1px */
    .table-container {
        border-collapse: collapse;
        width: 100%;
    }

    /* Mengatur border pada sel dan header tabel */
    .table-container,
    .table-container th,
    .table-container td {
        border: 1px solid black;
        padding-left: 25px;
        padding-right: 25px;
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .title-section {
        font-size: 14pt;
        font-weight: bold;
        padding-left: 10px !important;
    }
</style>

<body>
    <div class="modal fade" id="modal_dokter_mengirim" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dokter Mengirim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="tabel_dokter_mengirim" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
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

    <div class="modal fade" id="modal_dokter_merawat" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dokter Merawat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="tabel_dokter_merawat" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
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
    <div class="modal fade" id="daftarObatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Obat-obatan di rumah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_obat_obatan_rumah">
                    <input type="hidden" id="action_obat">
                    <input type="hidden" id="index_obat">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input class="form-control" type="text" value="" name="nama_obat" id="nama_obat" />
                        </div>
                        <div class="form-group">
                            <label>Dosis/Frekuensi</label>
                            <input class="form-control" type="text" value="" name="dosis_obat"
                                id="dosis_obat" />
                        </div>
                        <div class="form-group">
                            <label>Kapan Terakhir Diberikan</label>
                            <input class="form-control" type="date" value="" name="terakhir_diberikan"
                                id="terakhir_diberikan" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="width: 100%; display: flex;">
        <div class="mb-2" style="width: 45%; border: 1px solid black; min-height: 200px; margin-right: 10%;">
            <div style="height: 100px;">
                <img style="width: 270px; height: auto; margin: -75px 0 0 2%;"
                    src="{{ asset('filelogo/logo_rshm.png') }}" alt="" />
            </div>
            <div style="margin: 12px 7%; font-size: 11pt; font-weight: bold;">
                <span>Jl.Raya Cibarusah No.5 Kebon Kopi, Cibarusah Jaya</span> <br>
                <span>Kabupaten Bekasi Jawa Barat(17340). Telp.:(021)8995 2340</span> <br>
                <span>Email: infor@rumahsakit-harapanmulian.id</span>
            </div>
        </div>
        <div class="mb-2"
            style="width: 45%; border: 1px solid black; min-height: 200px; padding: 20px 20px 0 20px;">
            <table>
                <tr>
                    <td>Nama</td>
                    <td class="pl-3 pr-3">:</td>
                    <td>{{ $pasien ? $pasien->nama : '' }}</td>
                </tr>
                <tr>
                    <td>No. RM</td>
                    <td class="pl-3 pr-3">:</td>
                    <td>{{ $pasien ? $pasien->id : '' }}</td>
                </tr>
                <tr>
                    <td>Tgl. Lahir</td>
                    <td class="pl-3 pr-3">:</td>
                    <td>{{ $pasien ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '' }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td class="pl-3 pr-3">:</td>
                    <td>
                        @if (isset($pasien))
                            @switch($pasien->jk)
                                @case(0)
                                    {{ 'Laki-Laki' }}
                                    @break
                                @case(1)
                                    {{ 'Perempuan' }}
                                    @break
                                @default
                                    
                            @endswitch
                        @endif
                    </td>
                </tr>
            </table>
            <div style="text-align: right !important; font-size: 8pt; margin-top: 20px;">
                <label>*Tempel Label</label>
            </div>
        </div>
    </div>
    <div class="text-center mt-2 mb-2" style="font-weight: bold;">
        <span>ASESMEN AWAL KEPERAWATAN RAWAT INAP GERIATRI (> 60 Tahun)</span> <br>
        <span style="font-style: italic;">(Dilengkapi dalam 24 jam pertama setelah pasien masuk ruang rawat)</span>
    </div>
    <form id="form_dokumen">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <table class="table-container">
            <tr>
                <td colspan="2">
                    <table style="border: 1px solid transparent; width:100%;">
                        <tr>
                            <td style="border:1px solid transparent; width: 20%; text-align: left; padding-left:0;">
                                Ruang Rawat</td>
                            <td style="border:1px solid transparent; width: 3%; text-align: left; padding-left:0;"> :
                            </td>
                            <td style="border:1px solid transparent; width: 77%">
                                <select name="ruangan" class="form-control" style="width: 100%">
                                    <option value="">--Select Here--</option>
                                    @foreach ($list_ruangan as $lr)
                                        <option {{ $data ? ($data->ruangan == $lr->slug ? 'selected' : '') : '' }}
                                            value="{{ $lr->slug }}">{{ $lr->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table style="border: 1px solid transparent; width:100%;">
                        <tr>
                            <td style="border:1px solid transparent; width: 20%; text-align: left; padding-left:0;">
                                Dokter yang mengirim</td>
                            <td style="border:1px solid transparent; width: 3%; text-align: left; padding-left:0;"> :
                            </td>
                            <td style="border:1px solid transparent; width: 77%">
                                <div class="input-group">
                                    <input type="hidden" value="{{$data ? $data->id_dokter_pengirim : ''}}" name="id_dokter_pengirim" id="id_dokter_mengirim">
                                    <input type="text" value="{{$data ? $data->dokter_pengirim : ''}}" readonly name="dokter_pengirim" id="dokter_mengirim" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" onclick="open_modal_dokter_mengirim()" type="button"><i
                                                class="fa fa-list"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="border: 1px solid transparent; width:100%;">
                        <tr>
                            <td style="border:1px solid transparent; width: 20%; text-align: left; padding-left:0;">
                                Kelas</td>
                            <td style="border:1px solid transparent; width: 3%; text-align: left; padding-left:0;"> :
                            </td>
                            <td style="border:1px solid transparent; width: 77%">
                                <input class="form-control" type="text" value="{{ $data ? $data->kelas : '' }}" name="kelas" />
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table style="border: 1px solid transparent; width:100%;">
                        <tr>
                            <td style="border:1px solid transparent; width: 20%; text-align: left; padding-left:0;">
                                Dokter yang merawat</td>
                            <td style="border:1px solid transparent; width: 3%; text-align: left; padding-left:0;"> :
                            </td>
                            <td style="border:1px solid transparent; width: 77%">
                                <div class="input-group">
                                    <input type="hidden" value="{{$data ? $data->id_dokter_merawat : ''}}" name="id_dokter_merawat" id="id_dokter_merawat">
                                    <input type="text" value="{{$data ? $data->dokter_merawat : ''}}" readonly name="dokter_merawat" id="dokter_merawat" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" onclick="open_modal_dokter_merawat()" type="button"><i
                                                class="fa fa-list"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="title-section" colspan="4">I. DATA UMUM</td>
            </tr>
            <tr>
                <td>Tgl Masuk</td>
                <td>
                    <input class="form-control" type="date" value="{{ $data ? $data->tgl_masuk : date('Y-m-d') }}"
                        name="tgl_masuk" id="tanggal_masuk" />
                </td>
                <td>Pendidikan</td>
                <td>
                    <select class="form-control" name="pendidikan" id="pendidikan">
                        <option value="">Pilih Pendidikan</option>
                        <option {{ $data ? ($data->pendidikan == 'SD' ? 'selected' : '') : ($pasien->pendidikan == 'SD' ? 'selected' : '') }} value="SD">SD
                        </option>
                        <option {{ $data ? ($data->pendidikan == 'SLTP' ? 'selected' : '') : ($pasien->pendidikan == 'SMP' ? 'selected' : '') }} value="SMP">SMP
                        </option>
                        <option {{ $data ? ($data->pendidikan == 'SLTA' ? 'selected' : '') : ($pasien->pendidikan == 'SMA' ? 'selected' : '') }} value="SMA">
                            SMA/Sederajat</option>
                        <option {{ $data ? ($data->pendidikan == 'Perguruan Tinggi' ? 'selected' : '') : ($pasien->pendidikan == 'SETINGKAT SARJANA' ? 'selected' : '') }}
                            value="Perguruan Tinggi">Perguruan Tinggi</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tgl/Jam Pengkajian</td>
                <td>
                    <input class="form-control" type="datetime-local"
                        value="{{ $data ? $data->tgl_pengkajian : date('Y-m-d H:i')}}" name="tgl_pengkajian"
                        id="tgl_pengkajian" />
                </td>
                <td>Pekerjaan</td>
                <td>
                    <input class="form-control" type="text" value="{{ $data ? $data->pekerjaan : ($pasien ? $pasien->pekerjaan : '') }}"
                        name="pekerjaans" id="pekerjaans" />
                </td>
            </tr>
            <tr>
                <td>Diagnosis Medik</td>
                <td>
                    <input class="form-control" type="text" value="{{ $data ? $data->diagnosis_medik : '' }}"
                        name="diagnosis_medik" id="diagnosis_medik">
                </td>
                <td>Berat Badan</td>
                <td>
                    <input class="form-control" type="number" value="{{ $data ? $data->berat_badan : '' }}"
                        name="berat_badan" id="berat_badan" />
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <input type="text" readonly value="{{ $pasien ? ($pasien->jk == 0 ? 'Laki-Laki' : 'Perempuan') : '' }}" name="" class="form-control"> 
                </td>
                <td>Tinggi Badan</td>
                <td>

                    <input class="form-control" type="number" value="{{ $data ? $data->tinggi_badan : '' }}"
                        name="tinggi_badan" id="berat_badan" />
                </td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>
                    <select class="form-control" name="status_perkawinan" id="status_perkawinan">
                        <option value="">Pilih Status Perkawinan</option>
                        <option {{ $data ? ($data->status_perkawinan == 'Kawin' ? 'selected' : '') : ($pasien ? $pasien->status == 'Kawin' ? 'selected' : '' : '') }} value="Kawin">
                            Kawin
                        </option>
                        <option {{ $data ? ($data->status_perkawinan == 'Tidak Kawin' ? 'selected' : '') : ($pasien ? $pasien->status == 'Tidak Kawin' ? 'selected' : '' : '') }}
                            value="Tidak Kawin">Tidak Kawin</option>
                        <option {{ $data ? ($data->status_perkawinan == 'Duda' ? 'selected' : '') : ($pasien ? $pasien->status == 'Duda' ? 'selected' : '' : '') }} value="Duda">Duda
                        </option>
                        <option {{ $data ? ($data->status_perkawinan == 'Janda' ? 'selected' : '') : ($pasien ? $pasien->status == 'Janda' ? 'selected' : '' : '') }} value="Janda">
                            Janda
                        </option>
                    </select>
                </td>
                <td>Agama</td>
                <td>
                    <input class="form-control" type="text" value="{{ $pasien ? $pasien->agama : '' }}"
                        name="agama" id="agama" />
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <textarea class="form-control" name="alamat" id="alamat" height="200px">{{ $pasien ? $pasien->alamat : '' }}</textarea>
                </td>
                <td>Kondisi Saat Masuk</td>
                <td>
                    <input type="radio" {{ $data ? ($data->kondisi_saat_masuk == 'Mandiri' ? 'checked' : '') : '' }}
                        value="Mandiri" name="kondisi_saat_masuk" id="mandiriRadio" /> Mandiri
                    <br>
                    <input type="radio"
                        {{ $data ? ($data->kondisi_saat_masuk == 'Kursi Roda' ? 'checked' : '') : '' }}
                        value="Kursi Roda" name="kondisi_saat_masuk" id="kursiRodaRadio" /> Kursi
                    Roda
                    <br>
                    <input type="radio"
                        {{ $data ? ($data->kondisi_saat_masuk == 'Di Papah' ? 'checked' : '') : '' }} value="Di Papah"
                        name="kondisi_saat_masuk" id="diPapahRadio" /> Di Papah
                    <br>
                    <input type="radio"
                        {{ $data ? ($data->kondisi_saat_masuk == 'Tempat Tidur' ? 'checked' : '') : '' }}
                        value="Tempat Tidur" name="kondisi_saat_masuk" id="tempatTidurRadio" />
                    Tempat
                    Tidur <br>
                    <input type="radio" {{ $data ? ($data->kondisi_saat_masuk == 'Lainya' ? 'checked' : '') : 'checked' }}
                        value="Lainya" name="kondisi_saat_masuk" id="lainyaRadio" /> Lainya <br>
                    <input
                        style="{{ $data ? ($data->kondisi_saat_masuk == 'Lainya' ? 'display:visible' : 'display:none') : 'display:none' }}"
                        class="form-control" type="text"
                        value="{{ $data ? $data->kondisi_saat_masuk_lain : '' }}" name="kondisi_saat_masuk_lain"
                        id="lainyaInput" />
                    <script>
                        // Menambahkan event handler menggunakan jQuery
                        $(document).ready(function() {
                            $("input[name='kondisi_saat_masuk']").change(function() {
                                if ($("#lainyaRadio").is(":checked")) {
                                    $("#lainyaInput").show();
                                } else {
                                    $("#lainyaInput").hide();
                                }
                            });
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td>No. Tlp Yang Dapat Dihubungi</td>
                <td>
                    <input class="form-control" type="number" value="{{ $data ? $data->telpon : ($pasien ? $pasien->telpon : '') }}"
                        name="telpon" id="tlp_dapat_dihubungi" />
                </td>
                <td>Data Diperoleh Dari</td>
                <td>
                    <input type="radio" {{ $data ? ($data->data_diperoleh == 'Pasien' ? 'checked' : '') : 'checked' }}
                        value="Pasien" name="data_diperoleh" id="pasienRadio" /> Pasien <br>
                    <input type="radio" {{ $data ? ($data->data_diperoleh == 'Orang Lain' ? 'checked' : '') : '' }}
                        value="Orang Lain" name="data_diperoleh" id="orangLainRadio" /> Orang Lain
                </td>
            </tr>
            <tr>
                <td>Hubungan</td>
                <td>
                    <input class="form-control" type="text" value="{{ $data ? $data->hubungan : '' }}"
                        name="hubungan" id="Hubungan" />
                </td>
                <td>Asal Pasien</td>
                <td>
                    <input type="radio" {{ $data ? ($data->asal_pasien == 'Poliklinik' ? 'checked' : '') : '' }}
                        value="Poliklinik" name="asal_pasien" id="poliklinikRadio" /> Poliklinik
                    <br>
                    <input type="radio" {{ $data ? ($data->asal_pasien == 'IGD' ? 'checked' : '') : 'checked' }}
                        value="IGD" name="asal_pasien" id="igdRadio" /> IGD
                </td>
            </tr>
            <tr>
                <td>No. Tlp</td>
                <td>
                    <input class="form-control" type="number" value="{{ $pasien ? $pasien->telpon : '' }}"
                        name="no_tlp" id="no_tlp" />
                </td>
                <td>Bahasa yg digunakan</td>
                <td>
                    <input class="form-control" type="text" value="{{ $data ? $data->bahasa : '' }}"
                        name="bahasa" id="bahasa" />
                </td>
            </tr>
            <tr>
                <th style="font-size: 14pt; font-style: italic; text-align: center;" colspan="4">Bila Diagnosa
                    Medik
                    Sudah Tegak Merupakan Infeksi, Lanjut Ke "Assesmen Pasien Dengan Infeksi Atau Penyakit Menular"
                </th>
            </tr>
            <tr>
                <td colspan="4" class="title-section">II. ANAMNESA</td>
            </tr>
            <tr>
                <td colspan="4">
                    Keluhan Utama (Alasan Masuk Rs) : <br>
                    <textarea class="form-control" height="300px" name="keluhan_utama" id="alasan_masuk_rs">{{ $data ? $data->keluhan_utama : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Keluhan Yang Menyertai : <br>
                    <textarea class="form-control" height="300px" name="keluhan_menyertai" id="keluhan_yang_menyertai">{{ $data ? $data->keluhan_menyertai : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Waktu dan Tempat Pengobatan Terakhir : <br>
                    <div style="display: flex;">
                        <input class="form-control" type="datetime-local"
                            value="{{ $data ? $data->waktu_pengobatan_terakhir : '' }}"
                            name="waktu_pengobatan_terakhir" id="waktu_pengobatan_terakhir" />
                        <input class="form-control ml-2" type="text"
                            value="{{ $data ? $data->tempat_pengobatan_terakhir : '' }}"
                            name="tempat_pengobatan_terakhir" id="tempat_pengobatan_terakhir"
                            placeholder="tempat pengobatan" />
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="hidden" name="riwayat_alergi">
                    Riwayat Alergi : <br>
                    <?php
                    $riwayat_alergi = $data ? json_decode($data->riwayat_alergi) : null;
                    // dd($riwayat_alergi);
                    ?>
                    <div style="display: flex;">
                        <div>
                            <input type="checkbox"
                                {{ $riwayat_alergi ? ($riwayat_alergi->tidak_ada ? 'checked' : '') : 'checked' }}
                                value="Tidak Ada" name="" id="riwayat_alergi" />
                            Tidak
                            Ada
                        </div>
                        <div class="ml-3 col-lg-4">
                            <input type="checkbox"
                                {{ $riwayat_alergi ? ($riwayat_alergi->makanan->cek ? 'checked' : '') : '' }}
                                value="Makanan" name="makanan_checkbox" id="makanan_checkbox" />
                            Makanan : <br>
                            <input class=" form-control ml-2" type="text"
                                value="{{ $riwayat_alergi ? $riwayat_alergi->makanan->value : '' }}" name="makanan"
                                id="makanan"
                                {{ $riwayat_alergi ? ($riwayat_alergi->makanan->cek ? '' : 'readonly') : 'readonly' }} />
                        </div>
                        <div class="ml-3 col-lg-4">
                            <input type="checkbox" value="Obat"
                                {{ $riwayat_alergi ? ($riwayat_alergi->obat->cek ? 'checked' : '') : '' }}
                                name="obat_checkbox" id="obat_checkbox" />
                            Obat : <br>
                            <input class=" form-control ml-2" type="text"
                                value="{{ $riwayat_alergi ? $riwayat_alergi->obat->value : '' }}" name="obat"
                                id="obat"
                                {{ $riwayat_alergi ? ($riwayat_alergi->obat->cek ? '' : 'readonly') : 'readonly' }} />
                        </div>
                    </div>
                    Reaksi : <input class="form-control" type="text" value="{{ $data ? $data->reaksi : '' }}"
                        name="reaksi" id="reaksi" />
                    <script>
                        $(document).ready(function() {
                            // Function to toggle readonly attribute based on checkbox status
                            function toggleReadonly(checkbox, input) {
                                if (checkbox.prop("checked")) {
                                    input.prop("readonly", false);
                                } else {
                                    input.prop("readonly", true);
                                    input.val('');
                                }
                            }

                            // When the "Tidak Ada" checkbox is clicked
                            $("#riwayat_alergi").click(function() {
                                // Toggle readonly for Makanan input and reset its value
                                toggleReadonly($("#makanan_checkbox"), $("#makanan"));
                                $("#makanan").val("");

                                // Toggle readonly for Obat input and reset its value
                                toggleReadonly($("#obat_checkbox"), $("#obat"));
                                $("#obat").val("");
                            });

                            // When the "Makanan" checkbox is clicked
                            $("#makanan_checkbox").click(function() {
                                // Toggle readonly for Makanan input
                                toggleReadonly($(this), $("#makanan"));
                                // toggleReadonly($(this), $("#reaksi"));
                            });

                            // When the "Obat" checkbox is clicked
                            $("#obat_checkbox").click(function() {
                                // Toggle readonly for Obat input
                                toggleReadonly($(this), $("#obat"));
                                // toggleReadonly($(this), $("#reaksi"));
                            });
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $rpd = $data ? json_decode($data->riwayat_penyakit_dahulu) : null;
                    ?>
                    <input type="hidden" name="riwayat_penyakit_dahulu">
                    Riwayat penyakit dahulu : <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Penyakit Jantung"
                            name="riwayat_penyakit" id="penyakit_jantung"
                            {{ $rpd ? ($rpd->penyakit_jantung ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Penyakit Jantung</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Diabetes" name="riwayat_penyakit"
                            id="diabetes" {{ $rpd ? ($rpd->diabetes ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Diabetes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="TB" name="riwayat_penyakit"
                            id="tb" {{ $rpd ? ($rpd->tb ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">TB</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Ginjal" name="riwayat_penyakit"
                            id="ginjal" {{ $rpd ? ($rpd->ginjal ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Ginjal</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Gangguan Jiwa"
                            name="riwayat_penyakit" id="gangguan_jiwa"
                            {{ $rpd ? ($rpd->gangguan_jiwa ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Gangguan Jiwa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Kanker" name="riwayat_penyakit"
                            id="Kanker" {{ $rpd ? ($rpd->kanker ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Kanker</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Stroke" name="riwayat_penyakit"
                            id="stroke" {{ $rpd ? ($rpd->stroke ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Stroke</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Asma" name="riwayat_penyakit"
                            id="asma" {{ $rpd ? ($rpd->asma ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Asma</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Gangguan Hematologi"
                            name="riwayat_penyakit" id="gangguan_hematologi"
                            {{ $rpd ? ($rpd->gangguan_hematologi ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Gangguan Hematologi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Hipertensi" name="riwayat_penyakit"
                            id="hipertensi" {{ $rpd ? ($rpd->hipertensi ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Hipertensi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Infark Miokard"
                            name="riwayat_penyakit" id="infark_miokard"
                            {{ $rpd ? ($rpd->infark_miokard ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Infark Miokard</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Hepatitis" name="riwayat_penyakit"
                            id="hepatitis" {{ $rpd ? ($rpd->hepatitis ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Hepatitis</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Lain-Lain" name="riwayat_penyakit"
                            id="lain_lain_checkbox" {{ $rpd ? ($rpd->lain_lain ? 'checked' : '') : 'checked' }}>
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Lain-Lain</label>
                        <input class="form-control mt-2 ml-1" style="width: 70%" type="text"
                            value="{{ $rpd ? $rpd->lain : '' }}" name="riwayat_penyakit_input"
                            id="riwayat_penyakit_input">
                    </div>
                    {{-- <script>
                        $(document).ready(function() {
                            $("#riwayat_penyakit_input").hide();
                            // Function to show/hide additional input based on checkbox status
                            function toggleAdditionalInput() {
                                const isChecked = $("#lain_lain_checkbox").prop("checked");
                                const additionalInput = $("#riwayat_penyakit_input");

                                if (isChecked) {
                                    additionalInput.show();
                                } else {
                                    additionalInput.hide();
                                }
                            }

                            // Initially hide the additional input
                            toggleAdditionalInput();

                            // When the checkbox is clicked
                            $("#lain_lain_checkbox").click(function() {
                                toggleAdditionalInput();
                            });
                        });
                    </script> --}}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php $riwayat_imuno = $data ? json_decode($data->riwayat_imuno) : []; ?>
                    <input type="hidden" name="riwayat_imuno">
                    <span style="font-size: 13pt; font-weight: bold;">Riwayat Imuno Compromais :</span> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Infeksi telinga baru sebanyak 8 ( delapan ) kali atau lebih dalam setahun', $riwayat_imuno) ? 'checked' : '' }}
                            value="Infeksi telinga baru sebanyak 8 ( delapan ) kali atau lebih dalam setahun"
                            name="riwayat_imuno_compromais" id="infeksi_telinga_baru">
                        <label class="form-check-label" for="infeksi_telinga_baru">Infeksi telinga baru sebanyak 8 (
                            delapan ) kali atau lebih dalam setahun</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Infeksi berat pada sinus sebanyak 2 ( dua ) kali atau lebih dalam setahun', $riwayat_imuno) ? 'checked' : '' }}
                            value="Infeksi berat pada sinus sebanyak 2 ( dua ) kali atau lebih dalam setahun"
                            name="riwayat_imuno_compromais" id="infeksi_berat_sinus">
                        <label class="form-check-label" for="infeksi_berat_sinus">Infeksi berat pada sinus sebanyak 2
                            {
                            dua ) kali atau lebih dalam setahun</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Penggunaan antibiotik tanpa dampak selama 2 (dua) bulan atau lebih', $riwayat_imuno) ? 'checked' : '' }}
                            value="Penggunaan antibiotik tanpa dampak selama 2 (dua) bulan atau lebih"
                            name="riwayat_imuno_compromais" id="penggunaan_antibiotik">
                        <label class="form-check-label" for="penggunaan_antibiotik">Penggunaan antibiotik tanpa dampak
                            selama 2 (dua) bulan atau lebih</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Pneumonia sebanyak 2 ( Dua ) kali atau lebih dalam setahun', $riwayat_imuno) ? 'checked' : '' }}
                            value="Pneumonia sebanyak 2 ( Dua ) kali atau lebih dalam setahun"
                            name="riwayat_imuno_compromais" id="pneumonia">
                        <label class="form-check-label" for="pneumonia">Pneumonia sebanyak 2 ( Dua ) kali atau lebih
                            dalam
                            setahun</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Adanya abses dalam atau berulang pada kulit atau organ lain', $riwayat_imuno) ? 'checked' : '' }}
                            value="Adanya abses dalam atau berulang pada kulit atau organ lain"
                            name="riwayat_imuno_compromais" id="adanya_abses">
                        <label class="form-check-label" for="adanya_abses">Adanya abses dalam atau berulang pada kulit
                            atau organ lain</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Adanya sariawan yang menetap atau luka padaa kulit" name="riwayat_imuno_compromais', $riwayat_imuno) ? 'checked' : '' }}
                            value="Adanya sariawan yang menetap atau luka padaa kulit" name="riwayat_imuno_compromais"
                            id="adanya_sariawan">
                        <label class="form-check-label" for="adanya_sariawan">Adanya sariawan yang menetap atau luka
                            padaa
                            kulit</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Memerlukan antibiotik intravena untuk infeksi" name="riwayat_imuno_compromais', $riwayat_imuno) ? 'checked' : '' }}
                            value="Memerlukan antibiotik intravena untuk infeksi" name="riwayat_imuno_compromais"
                            id="memerlukan_antibiotik">
                        <label class="form-check-label" for="memerlukan_antibiotik">Memerlukan antibiotik intravena
                            untuk
                            infeksi</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Terdapat 2 (dua) atau lebih infeksi dalam ( misalnya: meningtis, osteomielitis, selutis, sepsis.', $riwayat_imuno) ? 'checked' : '' }}
                            value="Terdapat 2 (dua) atau lebih infeksi dalam ( misalnya: meningtis, osteomielitis, selutis, sepsis."
                            name="riwayat_imuno_compromais" id="terdapat_dua_infeksi">
                        <label class="form-check-label" for="terdapat_dua_infeksi">Terdapat 2 (dua) atau lebih infeksi
                            dalam ( misalnya: meningtis, osteomielitis, selutis, sepsis.</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Adanya riwayat keluarga terhadap imunodefisiensi primer', $riwayat_imuno) ? 'checked' : '' }}
                            value="Adanya riwayat keluarga terhadap imunodefisiensi primer"
                            name="riwayat_imuno_compromais" id="imunodefisiensi">
                        <label class="form-check-label" for="imunodefisiensi">Adanya riwayat keluarga terhadap
                            imunodefisiensi primer</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Adanya infeksi yang tidak berespon dengan terapi antibiotika', $riwayat_imuno) ? 'checked' : '' }}
                            value="Adanya infeksi yang tidak berespon dengan terapi antibiotika"
                            name="riwayat_imuno_compromais" id="antibiotika">
                        <label class="form-check-label" for="antibiotika">Adanya infeksi yang tidak berespon dengan
                            terapi
                            antibiotika</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Adanya proses pemulihan yang lambat atau tidak sempurna', $riwayat_imuno) ? 'checked' : '' }}
                            value="Adanya proses pemulihan yang lambat atau tidak sempurna"
                            name="riwayat_imuno_compromais" id="pemulihan_lambat">
                        <label class="form-check-label" for="pemulihan_lambat">Adanya proses pemulihan yang lambat
                            atau
                            tidak sempurna</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('adanya jenis kanker { misalnya: sarkoma, kaposi atau limfoma non- hodgkins )', $riwayat_imuno) ? 'checked' : '' }}
                            value="adanya jenis kanker { misalnya: sarkoma, kaposi atau limfoma non- hodgkins )"
                            name="riwayat_imuno_compromais" id="adanya_kanker">
                        <label class="form-check-label" for="adanya_kanker">adanya jenis kanker { misalnya: sarkoma,
                            kaposi atau limfoma non- hodgkins )</label>
                    </div> <br>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox"
                            {{ in_array('Adanya infeksi oportunistik (misalnya: pneumonia, infeksi jamur berulang)', $riwayat_imuno) ? 'checked' : '' }}
                            value="Adanya infeksi oportunistik (misalnya: pneumonia, infeksi jamur berulang)"
                            name="riwayat_imuno_compromais" id="infeksi_oportunistik">
                        <label class="form-check-label" for="infeksi_oportunistik">Adanya infeksi oportunistik
                            (misalnya:
                            pneumonia, infeksi jamur berulang)</label>
                    </div> <br>
                    <span style="font-style: italic;">Jika ada satu yang dicentang, lanjut ke “ assesmen pasien dengan
                        daya
                        imun yang
                        dilemahkan / imunosupresi</span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $rpk = $data ? json_decode($data->riwayat_penyakit_keluarga) : null;
                    // dd($rpk)
                    ?>
                    <input type="hidden" name="riwayat_penyakit_keluarga">
                    Riwayat Penyakit Keluarga : <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Penyakit Jantung"
                            {{ $rpk ? ($rpk->penyakit_jantung ? 'checked' : '') : '' }}
                            name="riwayat_penyakit_keluarga" id="penyakit_jantung_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Penyakit Jantung</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Diabetes"
                            {{ $rpk ? ($rpk->diabetes ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="diabetes_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Diabetes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="TB"
                            {{ $rpk ? ($rpk->tb ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="tb_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">TB</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Ginjal"
                            {{ $rpk ? ($rpk->ginjal ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="ginjal_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Ginjal</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Gangguan Jiwa"
                            {{ $rpk ? ($rpk->gangguan_jiwa ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="gangguan_jiwa_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Gangguan Jiwa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Kanker"
                            {{ $rpk ? ($rpk->kanker ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="kanker_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Kanker</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Stroke"
                            {{ $rpk ? ($rpk->stroke ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="stroke_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Stroke</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Asma"
                            {{ $rpk ? ($rpk->asma ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="asma_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Asma</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Gangguan Hematologi"
                            {{ $rpk ? ($rpk->gangguan_hematologi ? 'checked' : '') : '' }}
                            name="riwayat_penyakit_keluarga" id="gangguan_hematologi_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Gangguan Hematologi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Hipertensi"
                            {{ $rpk ? ($rpk->hipertensi ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="hipertensi_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Hipertensi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Infark Miokard"
                            {{ $rpk ? ($rpk->infark_miokard ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="infark_miokard_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Infark Miokard</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Hepatitis"
                            {{ $rpk ? ($rpk->hepatitis ? 'checked' : '') : '' }} name="riwayat_penyakit_keluarga"
                            id="hepatitis_keluarga">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Hepatitis</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Lain-Lain"
                            {{ $rpk ? ($rpk->lain_lain ? 'checked' : '') : 'checked' }} name="riwayat_penyakit_keluarga"
                            id="lain_lain_keluarga_checkbox">
                        <label class="form-check-label" for="riwayat_penyakit_checkbox">Lain-Lain</label>
                        <input class="form-control mt-2 ml-1" style="width: 70%" type="text"
                            value="{{ $rpk ? $rpk->lain : '' }}" name="riwayat_penyakit_input"
                            id="riwayat_penyakit_keluarga_input">
                    </div>
                    {{-- <script>
                        $(document).ready(function() {
                            $("#riwayat_penyakit_keluarga_input").hide();
                            // Function to show/hide additional input based on checkbox status
                            function toggleAdditionalInput() {
                                const isChecked = $("#lain_lain_keluarga_checkbox").prop("checked");
                                const additionalInput = $("#riwayat_penyakit_keluarga_input");

                                if (isChecked) {
                                    additionalInput.show();
                                } else {
                                    additionalInput.hide();
                                }
                            }

                            // Initially hide the additional input
                            toggleAdditionalInput();

                            // When the checkbox is clicked
                            $("#lain_lain_keluarga_checkbox").click(function() {
                                toggleAdditionalInput();
                            });
                        });
                    </script> --}}
                </td>
            </tr>
            <tr>
                <td rowspan="4" colspan="2">
                    <?php
                    $pernah_dirawat = $data ? json_decode($data->pernah_dirawat) : null;
                    // dd($pernah_dirawat);
                    ?>
                    <input type="hidden" name="pernah_di_rawats">
                    Pernah di rawat :
                    <input type="radio" value="Ya"
                        {{ !is_null($pernah_dirawat) ? ($pernah_dirawat->pernah == 'Ya' ? 'checked' : '') : '' }}
                        name="pernah_di_rawat" id="pernah_di_rawat_ya" /> Ya
                    <input type="radio" value="Tidak"
                        {{ !is_null($pernah_dirawat) ? ($pernah_dirawat->pernah == 'Tidak' ? 'checked' : '') : 'checked' }}
                        name="pernah_di_rawat" id="pernah_di_rawat_tidak" /> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Kapan : <input class="form-control" type="text"
                        value="{{ !is_null($pernah_dirawat) ? $pernah_dirawat->kapan : '' }}" name="rawat_kapan"
                        id="rawat_kapan"
                        {{ !is_null($pernah_dirawat) ? ($pernah_dirawat->pernah == 'Tidak' ? 'readonly' : '') : 'readonly' }} />
                </td>
            </tr>
            <tr>
                <td colspan="2">Dimana :<input class="form-control" type="text"
                        value="{{ !is_null($pernah_dirawat) ? $pernah_dirawat->dimana : '' }}" name="rawat_dimana"
                        id="rawat_dimana"
                        {{ !is_null($pernah_dirawat) ? ($pernah_dirawat->pernah == 'Tidak' ? 'readonly' : '') : 'readonly' }}>
                </td>
            </tr>
            <tr>
                <td colspan="2">Sakit Apa :<input class="form-control" type="text"
                        value="{{ !is_null($pernah_dirawat) ? $pernah_dirawat->sakit : '' }}" name="rawat_sakit_apa"
                        id="rawat_sakit_apa"
                        {{ !is_null($pernah_dirawat) ? ($pernah_dirawat->pernah == 'Tidak' ? 'readonly' : '') : 'readonly' }}>
                </td>
            </tr>
            <tr>
                <td rowspan="4" colspan="2">
                    <?php $pernah_dioperasi = $data ? json_decode($data->pernah_operasi) : null; ?>
                    <input type="hidden" name="pernah_di_operasis">
                    Pernah Operasi :
                    <input type="radio" value="Ya"
                        {{ $pernah_dioperasi ? ($pernah_dioperasi->pernah == 'Ya' ? 'checked' : '') : '' }}
                        name="pernah_di_operasi" id="pernah_di_operasi_ya" /> Ya
                    <input type="radio" value="Tidak"
                        {{ $pernah_dioperasi ? ($pernah_dioperasi->pernah == 'Tidak' ? 'checked' : '') : 'checked' }}
                        name="pernah_di_operasi" id="pernah_di_operasi_tidak" />
                    Tidak
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Kapan : <input class="form-control" type="text"
                        value="{{ $pernah_dioperasi ? $pernah_dioperasi->kapan : '' }}" name="operasi_kapan"
                        id="operasi_kapan" /
                        {{ $pernah_dioperasi ? ($pernah_dioperasi->pernah == 'Tidak' ? 'readonly' : '') : 'readonly' }}>
                </td>
            </tr>
            <tr>
                <td colspan="2">Dimana :<input class="form-control" type="text"
                        value="{{ $pernah_dioperasi ? $pernah_dioperasi->dimana : '' }}" name="operasi_dimana"
                        id="operasi_dimana"
                        {{ $pernah_dioperasi ? ($pernah_dioperasi->pernah == 'Tidak' ? 'readonly' : '') : 'readonly' }}>
                </td>
            </tr>
            <tr>
                <td colspan="2">Operasi Apa :<input class="form-control" type="text"
                        value="{{ $pernah_dioperasi ? $pernah_dioperasi->operasi : '' }}" name="operasi_sakit_apa"
                        id="operasi_sakit_apa"
                        {{ $pernah_dioperasi ? ($pernah_dioperasi->pernah == 'Tidak' ? 'readonly' : '') : 'readonly' }}>
                </td>
            </tr>
            <script>
                $(document).ready(function() {
                    // Function to toggle readonly attribute based on radio button status
                    function toggleReadonly(yesRadio, inputField) {
                        if (yesRadio.prop("checked")) {
                            inputField.removeAttr("readonly");
                        } else {
                            inputField.attr("readonly", true);
                            inputField.val(""); // Clear the input field
                        }
                    }

                    // When the "Ya" radio button for "Pernah di rawat" is clicked
                    $("#pernah_di_rawat_ya").click(function() {
                        toggleReadonly($(this), $("#rawat_kapan"));
                        toggleReadonly($(this), $("#rawat_dimana"));
                        toggleReadonly($(this), $("#rawat_sakit_apa"));
                    });

                    $("#pernah_di_rawat_tidak").click(function() {
                        toggleReadonly($("#pernah_di_rawat_ya"), $("#rawat_kapan"));
                        toggleReadonly($("#pernah_di_rawat_ya"), $("#rawat_dimana"));
                        toggleReadonly($("#pernah_di_rawat_ya"), $("#rawat_sakit_apa"));
                    });

                    // When the "Ya" radio button for "Pernah Operasi" is clicked
                    $("#pernah_di_operasi_ya").click(function() {
                        toggleReadonly($(this), $("#operasi_kapan"));
                        toggleReadonly($(this), $("#operasi_dimana"));
                        toggleReadonly($(this), $("#operasi_sakit_apa"));
                    });

                    $("#pernah_di_operasi_tidak").click(function() {
                        toggleReadonly($("#pernah_di_operasi_ya"), $("#operasi_kapan"));
                        toggleReadonly($("#pernah_di_operasi_ya"), $("#operasi_dimana"));
                        toggleReadonly($("#pernah_di_operasi_ya"), $("#operasi_sakit_apa"));
                    });
                });
            </script>
            <tr>
                <td colspan="4" class="title-section"> I. SKRINING NYERI</td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    $skrining_nyeri = $data ? json_decode($data->nyeri) : null;
                    ?>
                    <input type="hidden" name="skrining_nyeri">
                    Nyeri :
                    <input type="radio" value="Ya"
                        {{ $skrining_nyeri ? ($skrining_nyeri->nyeri == 'Ya' ? 'checked' : '') : '' }} name="nyeri"
                        id="nyeri_ya" /> Ya
                    <input class="ml-3" type="radio" value="Tidak"
                        {{ $skrining_nyeri ? ($skrining_nyeri->nyeri == 'Tidak' ? 'checked' : '') : '' }}
                        name="nyeri" id="nyeri_tidak" /> Tidak
                    <input class="ml-3" type="radio" value="Tidak bisa di nilai"
                        {{ $skrining_nyeri ? ($skrining_nyeri->nyeri == 'Tidak bisa di nilai' ? 'checked' : '') : 'checked' }}
                        name="nyeri" id="nyeri_tidak_bisa_dinilai" />
                    Tidak bisa di
                    nilai
                </td>
                <td>
                    Jenis : <input type="radio" value="Akut"
                        {{ $skrining_nyeri ? ($skrining_nyeri->jenis == 'Akut' ? 'checked' : '') : '' }}
                        name="jenis" id="jenis" /> Akut
                    <input class="ml-3" type="radio" value="Kronis"
                        {{ $skrining_nyeri ? ($skrining_nyeri->jenis == 'Kronis' ? 'checked' : '') : '' }}
                        name="jenis" id="jenis_kronis" /> Krosnis
                </td>
                <td>
                    Intensitas :
                    <input class="form-control" type="text"
                        value="{{ $skrining_nyeri ? $skrining_nyeri->intensitas : '' }}" name="intensitas"
                        id="intensitas" />
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-left: 20px; font-weight: bold; font-style: italic;">
                    Function pain skale
                </td>
            </tr>
            <tr>
                <td>Skala Nyeri</td>
                <td colspan="3">Keterangan</td>
            </tr>
            <tr>
                <td>0</td>
                <td colspan="3">Tidak Nyeri</td>
            </tr>
            <tr>
                <td>1</td>
                <td colspan="3">Dapat Ditoleransi (aktifitas tidak terganggu)</td>
            </tr>
            <tr>
                <td>2</td>
                <td colspan="3">Dapat Ditoleransi (beberapa aktivitas terganggu)</td>
            </tr>
            <tr>
                <td>3</td>
                <td colspan="3">Tidak Dapat Ditoleransi (tetapi masih dapat menggunakan telepon, nonton TV, atau
                    membaca)</td>
            </tr>
            <tr>
                <td>4</td>
                <td colspan="3">Tidak Dapat Ditoleransi (tidak dapat menggunakan telepon, nonton TV, atau membaca)
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td colspan="3">Tidak Dapat Ditoleransi (dan tidak dapat berbicara karena nyeri)</td>
            </tr>
            <tr>
                <td colspan="4" style="font-weight: bold; font-style: italic;">Bila ada keluhan nyeri, maka lanjut
                    dengan "Assesmen Nyeri"</td>
            </tr>
            <tr>
                <td colspan="4" class="title-section">
                    V. PEMERIKSAAN FISIK
                    <input type="hidden" name="ttv">
                    <input type="hidden" name="kesadaran">

                    <?php
                    $ttv = $data ? json_decode($data->ttv) : null;
                    ?>
                </td>
            </tr>
            <tr>
                <td>TD: <input type="text" value="{{ $ttv ? $ttv->tensi : '' }}" name="td"
                        id="td" /> mmHg</td>
                <td>Suhu <input type="text" value="{{ $ttv ? $ttv->suhu : '' }}" name="suhu"
                        id="suhu" /> C</td>
                <td>N: <input type="text" value="{{ $ttv ? $ttv->nadi : '' }}" name="n" id="n" />
                    x/mnt</td>
                <td>P: <input type="text" value="{{ $ttv ? $ttv->rr : '' }}" name="p" id="p" />
                    x/mnt</td>
            </tr>
            <tr>
                <td colspan="4"><span style="font-weight: bold;">Kesadaran : </span>
                    <input class="ml-3" type="checkbox"
                        {{ $ttv ? (in_array('CM', $ttv->kesadaran) ? 'checked' : '') : 'checked' }} value="CM"
                        name="cm" id="cm" /> CM
                    <input class="ml-3" type="checkbox"
                        {{ $ttv ? (in_array('Apatis', $ttv->kesadaran) ? 'checked' : '') : '' }} value="Apatis"
                        name="apatis" id="apatis" /> Apatis
                    <input class="ml-3" type="checkbox"
                        {{ $ttv ? (in_array('Somnolent', $ttv->kesadaran) ? 'checked' : '') : '' }} value="Somnolent"
                        name="somnolent" id="somnolent" />
                    Somnolent
                    <input class="ml-3" type="checkbox"
                        {{ $ttv ? (in_array('Soporus', $ttv->kesadaran) ? 'checked' : '') : '' }} value="Soporus"
                        name="soporus" id="soporus" /> Soporus
                    <input class="ml-3" type="checkbox"
                        {{ $ttv ? (in_array('Koma', $ttv->kesadaran) ? 'checked' : '') : '' }} value="Koma"
                        name="koma" id="koma" /> Koma
                </td>
            </tr>
            <tr>
                <td colspan="4" style="font-weight: bold;">
                    Glasglow Coma Scale Dewasa :
                    <input type="hidden" name="glasglow_coma">
                    <?php
                    $glasglow = $data ? json_decode($data->glasglow_coma) : null;
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="4">Mata (E)</td>
                <td>Terbuka Spontan</td>
                <td> <input type="checkbox" value="4"
                        {{ $glasglow ? (in_array('4', $glasglow->mata) ? 'checked' : '') : 'checked' }} name="mata"
                        id="terbuka_spontan" /> 4 </td>
            </tr>
            <tr>
                <td>Terbuka saat di panggil/di perintah </td>
                <td> <input type="checkbox" value="3"
                        {{ $glasglow ? (in_array('3', $glasglow->mata) ? 'checked' : '') : '' }} name="mata"
                        id="terbuka_dipanggil" /> 3 </td>
            </tr>
            <tr>
                <td>Terbuka saat rangsang nyeri </td>
                <td> <input type="checkbox" value="2"
                        {{ $glasglow ? (in_array('2', $glasglow->mata) ? 'checked' : '') : '' }} name="mata"
                        id="terbuka_rangsang_nyeri" /> 2 </td>
            </tr>
            <tr>
                <td>Tidak Merespon</td>
                <td> <input type="checkbox" value="1"
                        {{ $glasglow ? (in_array('1', $glasglow->mata) ? 'checked' : '') : '' }} name="mata"
                        id="tidak_merespon_mata" /> 1 </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="5">Verbal (V)</td>
                <td>Orientasi Baik</td>
                <td> <input type="checkbox" value="5"
                        {{ $glasglow ? (in_array('5', $glasglow->verbal) ? 'checked' : '') : 'checked' }} name="verbal"
                        id="orientasi_baik" /> 5</td>
            </tr>
            <tr>
                <td>Disorientasi/bingung</td>
                <td> <input type="checkbox" value="4"
                        {{ $glasglow ? (in_array('4', $glasglow->verbal) ? 'checked' : '') : '' }} name="verbal"
                        id="disorientasi" /> 4 </td>
            </tr>
            <tr>
                <td>Jawaban Tidak Sesuai</td>
                <td> <input type="checkbox" value="3"
                        {{ $glasglow ? (in_array('3', $glasglow->verbal) ? 'checked' : '') : '' }} name="verbal"
                        id="jawaban_tidak_sesuai" /> 3 </td>
            </tr>
            <tr>
                <td>Suara yang tidak dapat dimengerti (erangan/teriakan)</td>
                <td> <input type="checkbox" value="2"
                        {{ $glasglow ? (in_array('2', $glasglow->verbal) ? 'checked' : '') : '' }} name="verbal"
                        id="suara_tidak_dimengerti" /> 2 </td>
            </tr>
            <tr>
                <td>Tidak Merespon</td>
                <td> <input type="checkbox" value="1"
                        {{ $glasglow ? (in_array('1', $glasglow->verbal) ? 'checked' : '') : '' }} name="verbal"
                        id="tidak_merespon_verbal" /> 1 </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="6">Motorik</td>
                <td>Mengikuti Perintah</td>
                <td> <input type="checkbox" value="6"
                        {{ $glasglow ? (in_array('6', $glasglow->motorik) ? 'checked' : '') : 'checked' }} name="motorik"
                        id="mengikuti_perintah" /> 6</td>
            </tr>
            <tr>
                <td>Melokalisasi Nyeri</td>
                <td> <input type="checkbox" value="5"
                        {{ $glasglow ? (in_array('5', $glasglow->motorik) ? 'checked' : '') : '' }} name="motorik"
                        id="melokalisasi_nyeri" /> 5</td>
            </tr>
            <tr>
                <td>Menarik diri (withdrawal) dari rangsangan nyeri</td>
                <td> <input type="checkbox" value="4"
                        {{ $glasglow ? (in_array('4', $glasglow->motorik) ? 'checked' : '') : '' }} name="motorik"
                        id="menarik_diri" /> 4</td>
            </tr>
            <tr>
                <td>Fleksi abnormal dari anggota Gerak terhadap rangsangan nyeri</td>
                <td> <input type="checkbox" value="3"
                        {{ $glasglow ? (in_array('3', $glasglow->motorik) ? 'checked' : '') : '' }} name="motorik"
                        id="fleksi_abnormal" /> 3</td>
            </tr>
            <tr>
                <td>Ektensi abnormal anggota gerak terhadap rangsangan</td>
                <td> <input type="checkbox" value="2"
                        {{ $glasglow ? (in_array('2', $glasglow->motorik) ? 'checked' : '') : '' }} name="motorik"
                        id="ektensi_abnormal" /> 2</td>
            </tr>
            <tr>
                <td>Tidak Merespon</td>
                <td> <input type="checkbox" value="1"
                        {{ $glasglow ? (in_array('1', $glasglow->motorik) ? 'checked' : '') : '' }} name="motorik"
                        id="tidak_merespon_motorik" /> 1</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td style="font-weight: bold; font-size: 14pt;">TOTAL GCS</td>
                <td id="total_gcs"></td>
            </tr>
            <script>
                $(document).ready(function() {
                    // Function to calculate and update the total GCS score
                    function calculateTotalGCS() {
                        let totalGCS = 0;

                        // Iterate through the checkboxes with the name attribute
                        $("input[type='checkbox']:checked[name='motorik'], input[type='checkbox']:checked[name='verbal'], input[type='checkbox']:checked[name='mata']")
                            .each(function() {
                                const value = parseInt($(this).val());
                                totalGCS += value;
                            });

                        // Update the total GCS value in the total GCS field
                        $("#total_gcs").text(totalGCS);
                    }

                    // Initially calculate the total GCS
                    calculateTotalGCS();

                    // When any of the checkboxes are clicked
                    $("input[type='checkbox']").click(function() {
                        calculateTotalGCS();
                    });
                });
            </script>
            <tr>
                <td colspan="4">
                    <?php
                    $kepala = $data ? json_decode($data->kepala) : null;
                    ?>

                    <input type="hidden" name="kepalas">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Kepala </span>:
                    <input class="ml-3" type="checkbox" value="t.a.k"
                        {{ $kepala ? ($kepala->tak ? 'checked' : '') : 'checked' }} name="kepala" id="tak_kepala" /> t.a.k
                    <input class="ml-3" type="checkbox" value="Asimetris"
                        {{ $kepala ? ($kepala->asimetris ? 'checked' : '') : '' }} name="kepala"
                        id="asimetris_kepala" />
                    Asimetris
                    <input class="ml-3" type="checkbox" value="Haematom"
                        {{ $kepala ? ($kepala->haematom ? 'checked' : '') : '' }} name="kepala"
                        id="haematom_kepala" />
                    Haematom,
                    Lokasi <input type="text" value="{{ $kepala ? $kepala->haematom_lokasi : '' }}"
                        name="kepala" id="haematom_lokasi_kepala" />
                    <input class="ml-3" type="checkbox" value="Lesi"
                        {{ $kepala ? ($kepala->lesi ? 'checked' : '') : '' }} name="kepala" id="lesi_kepala" />
                    Lesi,
                    Lokasi
                    <input type="text" value="{{ $kepala ? $kepala->lesi_lokasi : '' }}" name="kepala"
                        id="lesi_lokasi_kepala" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $rambut = $data ? json_decode($data->rambut) : null;
                    ?>

                    <input type="hidden" name="rambuts">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Rambut </span>:
                    <input class="ml-3" type="checkbox" {{ $rambut ? ($rambut->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="rambut" id="tak_rambut" /> t.a.k
                    <input class="ml-3" type="checkbox" {{ $rambut ? ($rambut->kotor ? 'checked' : '') : '' }}
                        value="Kotor" name="rambut" id="kotor_rambut" /> Kotor
                    <input class="ml-3" type="checkbox" {{ $rambut ? ($rambut->berminyak ? 'checked' : '') : '' }}
                        value="Berminyak" name="rambut" id="berminyak_rambut" />
                    Berminyak
                    <input class="ml-3" type="checkbox" {{ $rambut ? ($rambut->kering ? 'checked' : '') : '' }}
                        value="Kering" name="rambut" id="kering_rambut" />
                    Kering
                    <input class="ml-3" type="checkbox" {{ $rambut ? ($rambut->rontok ? 'checked' : '') : '' }}
                        value="Rontok" name="rambut" id="rontok_rambut" />
                    Rontok
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $muka = $data ? json_decode($data->muka) : null;
                    ?>
                    <input type="hidden" name="mukas">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Muka </span>:
                    <input class="ml-3" type="checkbox" {{ $muka ? ($muka->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="muka" id="tak_muka" /> t.a.k
                    <input class="ml-3" type="checkbox" {{ $muka ? ($muka->asimetris ? 'checked' : '') : '' }}
                        value="Asimetris" name="muka" id="asimetris_muka" />
                    Asimetris
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $mata = $data ? json_decode($data->mata) : null;
                    ?>
                    <input type="hidden" name="matas">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Mata </span>:
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="mata" id="tak_mata" /> t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $mata ? ($mata->gangguan_penglihatan ? 'checked' : '') : '' }}
                        value="Gangguan penglihatan" name="mata" id="gangguan_penglihatan_mata" /> Gangguan
                    penglihatan
                    <input class="ml-3" type="checkbox"
                        {{ $mata ? ($mata->seklera_ikterik ? 'checked' : '') : '' }} value="Seklera Ikterik"
                        name="mata" id="seklera_ikterik_mata" /> Seklera Ikterik
                    <input class="ml-3" type="checkbox"
                        {{ $mata ? ($mata->konjungtiva_anemis ? 'checked' : '') : '' }} value="Kunjungtiva Anemis"
                        name="mata" id="konjungtiva_anemis_mata" /> Kunjungtiva Anemis
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->pupil ? 'checked' : '') : '' }}
                        value="Pupil" name="mata" id="pupil_mata" /> Pupil:
                    Lokasi <input type="text" value="{{ $mata ? $mata->pupil_input : '' }}" name="mata"
                        id="pupil_input_mata" />
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->isokor ? 'checked' : '') : '' }}
                        value="Isokor" name="mata" id="isokor_mata" /> Isokor
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->anisokor ? 'checked' : '') : '' }}
                        value="Anisokor" name="mata" id="anisokor_mata" />
                    Anisokor
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->midriasis ? 'checked' : '') : '' }}
                        value="Midriasis" name="mata" id="midriasis_mata" />
                    Midriasis
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->miosis ? 'checked' : '') : '' }}
                        value="Miosis" name="mata" id="miosis_mata" /> Miosis
                    <input class="ml-3" type="checkbox"
                        {{ $mata ? ($mata->reflexy_cahaya ? 'checked' : '') : '' }} value="Reflexy Cahaya"
                        name="mata" id="reflexy_cahaya_mata" />
                    Reflexy Cahaya
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->positif ? 'checked' : '') : '' }}
                        value="Positif" name="mata" id="positif_mata" />
                    Positif
                    <input class="ml-3" type="checkbox" {{ $mata ? ($mata->negatif ? 'checked' : '') : '' }}
                        value="Positif" name="mata" id="negatif_mata" />
                    Negatif
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $telinga = $data ? json_decode($data->telinga) : null;
                    ?>
                    <input type="hidden" name="telingas">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Telinga
                    </span>:
                    <input class="ml-3" type="checkbox" {{ $telinga ? ($telinga->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="telinga" id="tak_telinga" /> t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $telinga ? ($telinga->berdengung ? 'checked' : '') : '' }} value="Berdengung"
                        name="telinga" id="berdengung_telinga" />
                    Berdengung
                    <input class="ml-3" type="checkbox"
                        {{ $telinga ? ($telinga->penurunan_pendengaran ? 'checked' : '') : '' }}
                        value="Penurunan Pendengaran" name="telinga" id="penurunan_pendengaran_telinga" />
                    Penurunan Pendengaran
                    <input class="ml-3" type="checkbox"
                        {{ $telinga ? ($telinga->keluar_cairan ? 'checked' : '') : '' }} value="Keluar Cairan"
                        name="telinga" id="keluar_cairan_telinga" />
                    Keluar Cairan
                    <input class="ml-3" type="checkbox"
                        {{ $telinga ? ($telinga->serumen ? 'checked' : '') : '' }} value="Serumen" name="telinga"
                        id="serumen_telinga" />
                    Serumen
                    <input class="ml-3" type="checkbox" {{ $telinga ? ($telinga->nyeri ? 'checked' : '') : '' }}
                        value="Nyeri" name="telinga" id="nyeri_telinga" /> Nyeri
                    <input class="ml-3" type="checkbox"
                        {{ $telinga ? ($telinga->alat_dengar ? 'checked' : '') : '' }}
                        value="Memakai Alat Bantu Dengar" name="telinga" id="alat_dengar_telinga" /> Memakai Alat
                    Bantu Dengar
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $hidung = $data ? json_decode($data->hidung) : null;
                    ?>
                    <input type="hidden" name="hidungs">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Hidung
                    </span>:
                    <input class="ml-3" type="checkbox" {{ $hidung ? ($hidung->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="hidung" id="tak_hidung" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $hidung ? ($hidung->asimetris ? 'checked' : '') : '' }} value="Asimetris"
                        name="hidung" id="asimetris_hidung" />
                    Asimetris
                    <input class="ml-3" type="checkbox"
                        {{ $hidung ? ($hidung->epistaksis ? 'checked' : '') : '' }} value="Epistaksis"
                        name="hidung" id="epistaksis_hidung" />
                    Epistaksis
                    <input class="ml-3" type="checkbox"
                        {{ $hidung ? ($hidung->lain_lain ? 'checked' : '') : '' }} value="Lain-Lain"
                        name="hidung" id="lain_lain_hidung" />
                    Lain-Lain
                    <input type="text" value="{{ $hidung ? $hidung->hidung_input : '' }}" name="hidung"
                        id="hidung_input_hidung" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $mulut = $data ? json_decode($data->mulut) : null;
                    ?>
                    <input type="hidden" name="muluts">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Mulut</span>:
                    <input class="ml-3" type="checkbox" {{ $mulut ? ($mulut->simetris ? 'checked' : '') : 'checked' }}
                        value="Simetris" name="mulut" id="simetris_mulut" />
                    Simetris
                    <input class="ml-3" type="checkbox" {{ $mulut ? ($mulut->asimetris ? 'checked' : '') : '' }}
                        value="Asimetris" name="mulut" id="asimetris_mulut" />
                    Asimetris
                    <input class="ml-3" type="checkbox" {{ $mulut ? ($mulut->pucat ? 'checked' : '') : '' }}
                        value="Pucat" name="mulut" id="pucat_mulut" />
                    Pucat
                    <input class="ml-3" type="checkbox" {{ $mulut ? ($mulut->sianosis ? 'checked' : '') : '' }}
                        value="Sianosis" name="mulut" id="sianosis_mulut" />
                    Sianosis
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $gigi = $data ? json_decode($data->gigi) : null;
                    ?>
                    <input type="hidden" name="gigis">
                    <span style="font-weight: bold; width: 10%; display: inline-block;"> Gigi</span>:
                    <input class="ml-3" type="checkbox" {{ $gigi ? ($gigi->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="gigi" id="tak_gigi" />
                    t.a.k
                    <input class="ml-3" type="checkbox" {{ $gigi ? ($gigi->karies ? 'checked' : '') : '' }}
                        value="Karies" name="gigi" id="karies_gigi" />
                    Karies
                    <input class="ml-3" type="checkbox" {{ $gigi ? ($gigi->goyang ? 'checked' : '') : '' }}
                        value="Goyang" name="gigi" id="goyang_gigi" />
                    Goyang
                    <input class="ml-3" type="checkbox" {{ $gigi ? ($gigi->tambal ? 'checked' : '') : '' }}
                        value="Tambal" name="gigi" id="tambal_gigi" />
                    Tambal
                    <input class="ml-3" type="checkbox" {{ $gigi ? ($gigi->gigi_palsu ? 'checked' : '') : '' }}
                        value="Gigi Palsu" name="gigi" id="gigi_palsu_gigi" />
                    Gigi
                    Palsu
                    <input class="ml-3" type="checkbox"
                        {{ $gigi ? ($gigi->geraham_asimetris ? 'checked' : '') : '' }} value="Geraham Asimetris"
                        name="gigi" id="geraham_asimetris_gigi" /> Geraham Asimetris
                    <input class="ml-3" type="checkbox" {{ $gigi ? ($gigi->lain_lain ? 'checked' : '') : '' }}
                        value="Lain_Lain" name="gigi" id="lain_lain_gigi" />
                    Lain-Lain
                    <input type="text" value="{{ $gigi ? $gigi->lain_lain_input : '' }}" name="gigi"
                        id="lain_lain_input_gigi" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $lidah = $data ? json_decode($data->lidah) : null;
                    ?>
                    <input type="hidden" name="lidahs">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Lidah</span>:
                    <input class="ml-3" type="checkbox" {{ $lidah ? ($lidah->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="lidah" id="tak_lidah" />
                    t.a.k
                    <input class="ml-3" type="checkbox" {{ $lidah ? ($lidah->kotor ? 'checked' : '') : '' }}
                        value="Kotor" name="lidah" id="kotor_lidah" />
                    Kotor
                    <input class="ml-3" type="checkbox"
                        {{ $lidah ? ($lidah->mukosa_kering ? 'checked' : '') : '' }} value="Mukosa Kering"
                        name="lidah" id="mukosa_kering_lidah" />
                    Mukosa Kering
                    <input class="ml-3" type="checkbox" {{ $lidah ? ($lidah->asimetris ? 'checked' : '') : '' }}
                        value="Deviasi Lateral / Asimetris" name="lidah" id="asimetris_lidah" /> Deviasi Lateral
                    / Asimetris
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $tenggorokan = $data ? json_decode($data->tenggorokan) : null;
                    ?>
                    <input type="hidden" name="tenggorokans">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Tenggorokan</span>:
                    <input class="ml-3" type="checkbox"
                        {{ $tenggorokan ? ($tenggorokan->tak ? 'checked' : '') : 'checked' }} value="t.a.k"
                        name="tenggorokan" id="tak_tenggorokan" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $tenggorokan ? ($tenggorokan->faring_merah ? 'checked' : '') : '' }} value="Faring Merah"
                        name="tenggorokan" id="faring_merah_tenggorokan" /> Faring Merah
                    <input class="ml-3" type="checkbox"
                        {{ $tenggorokan ? ($tenggorokan->sakit_menelan ? 'checked' : '') : '' }}
                        value="Sakit Menelan" name="tenggorokan" id="sakit_menelan_tenggorokan" />
                    Sakit Menelan
                    <input class="ml-3" type="checkbox"
                        {{ $tenggorokan ? ($tenggorokan->tonsil_membesar ? 'checked' : '') : '' }}
                        value="Tonsi Membesar" name="tenggorokan" id="tonsil_membesar_tenggorokan" /> Tonsil
                    Membesar
                    <input class="ml-3" type="checkbox"
                        {{ $tenggorokan ? ($tenggorokan->lain_lain ? 'checked' : '') : '' }} value="Lain_Lain"
                        name="tenggorokan" id="lain_lain_tenggorokan" /> Lain-Lain
                    <input type="text" value="{{ $tenggorokan ? $tenggorokan->lain_lain_input : '' }}"
                        name="tenggorokan" id="lain_lain_input_tenggorokan" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $leher = $data ? json_decode($data->leher) : null;
                    ?>
                    <input type="hidden" name="lehers">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Leher</span>:
                    <input class="ml-3" type="checkbox" {{ $leher ? ($leher->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="leher" id="tak_leher" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $leher ? ($leher->pemesaran_tiroid ? 'checked' : '') : '' }} value="Pembesaran Tiroid"
                        name="leher" id="pemesaran_tiroid_leher" /> Pembesaran Tiroid
                    <input class="ml-3" type="checkbox"
                        {{ $leher ? ($leher->bendungan_vena ? 'checked' : '') : '' }}
                        value="Bendungan Vena Jugularis" name="leher" id="bendungan_vena_leher" />
                    Bendungan Vena Jugularis
                    <input class="ml-3" type="checkbox"
                        {{ $leher ? ($leher->kaku_kuduk ? 'checked' : '') : '' }} value="Kaku Kuduk"
                        name="leher" id="kaku_kuduk_leher" />
                    Kaku Kuduk
                    <input class="ml-3" type="checkbox"
                        {{ $leher ? ($leher->keterbatasan_gerak ? 'checked' : '') : '' }} value="Keterbatasan Gerak"
                        name="leher" id="keterbatasan_gerak_leher" /> Keterbatasan Gerak
                    <input class="ml-3" type="checkbox" {{ $leher ? ($leher->lain_lain ? 'checked' : '') : '' }}
                        value="Lain_Lain" name="leher" id="lain_lain_leher" />
                    Lain-Lain
                    <input type="text" value="{{ $leher ? $leher->lain_lain_input : '' }}" name="leher"
                        id="lain_lain_input_leher" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $dada = $data ? json_decode($data->dada) : null;
                    ?>
                    <input type="hidden" name="dadas">
                    <span style="font-weight: bold; width: 10%; display: inline-block;"> Dada</span>:
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="dada" id="tak_dada" />
                    t.a.k
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->asimetris ? 'checked' : '') : '' }}
                        value="Asimetris" name="dada" id="asimetris_dada" />
                    Asimetris
                    <input class="ml-3" type="checkbox"
                        {{ $dada ? ($dada->retraksi ? 'checked' : '') : '' }}value="Retraksi" name="dada"
                        id="retraksi_dada" />
                    Retraksi

                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->ronchi ? 'checked' : '') : '' }}
                        value="Ronchi" name="dada" id="ronchi_dada" />
                    Ronchi
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->rales ? 'checked' : '') : '' }}
                        value="Rales" name="dada" id="rales_dada" />
                    Rales
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->wheezing ? 'checked' : '') : '' }}
                        value="Wheezing" name="dada" id="wheezing_dada" />
                    Wheezing
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->murmur ? 'checked' : '') : '' }}
                        value="Murmur" name="dada" id="murmur_dada" />
                    Murmur
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->takikardia ? 'checked' : '') : '' }}
                        value="Takikardia" name="dada" id="takikardia_dada" />
                    Takikardia
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->bradikardi ? 'checked' : '') : '' }}
                        value="Bradikardi" name="dada" id="bradikardi_dada" />
                    Bradikardi
                    <input class="ml-3" type="checkbox" {{ $dada ? ($dada->lain_lain ? 'checked' : '') : '' }}
                        value="Lain_Lain" name="dada" id="lain_lain_dada" />
                    Lain-Lain
                    <input type="text" value="{{ $dada ? $dada->lain_lain_input : '' }}" name="dada"
                        id="lain_lain_input_dada" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $abdomen = $data ? json_decode($data->abdomen) : null;
                    ?>
                    <input type="hidden" name="abdomens">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Abdomen</span>:
                    <input class="ml-3" type="checkbox" {{ $abdomen ? ($abdomen->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="abdomen" id="tak_abdomen" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $abdomen ? ($abdomen->kembung ? 'checked' : '') : '' }} value="Kembung" name="abdomen"
                        id="kembung_abdomen" />
                    Kembung
                    <input class="ml-3" type="checkbox"
                        {{ $abdomen ? ($abdomen->ascites ? 'checked' : '') : '' }} value="Ascites" name="abdomen"
                        id="ascites_abdomen" />
                    Ascites

                    <input class="ml-3" type="checkbox"
                        {{ $abdomen ? ($abdomen->benjolan ? 'checked' : '') : '' }} value="Benjolan"
                        name="abdomen" id="benjolan_abdomen" />
                    Benjolan
                    atau Masa, Lokasi
                    <input type="text" value="{{ $abdomen ? $abdomen->lokasi_benjolan : '' }}" name="abdomen"
                        id="lokasi_benjolan_abdomen" />

                    <input class="ml-3" type="checkbox" {{ $abdomen ? ($abdomen->nyeri ? 'checked' : '') : '' }}
                        value="Nyeri Tekan" name="abdomen" id="nyeri_abdomen" />
                    Nyeri
                    Tekan, Lokasi
                    <input type="text" value="" name="abdomen" id="lokasi_nyeri_abdomen" />

                    <input class="ml-3" type="checkbox"
                        {{ $abdomen ? ($abdomen->bising ? 'checked' : '') : '' }} value="Bising Usus"
                        name="abdomen" id="bising_abdomen" />
                    Bising
                    Usus, Lokasi
                    <input type="text" value="{{ $abdomen ? $abdomen->lokasi_bising : '' }}" name="abdomen"
                        id="lokasi_bising_abdomen" /> x/m

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $genitalia_wanita = $data ? json_decode($data->genitalia_wanita) : null;
                    $genitalia_pria = $data ? json_decode($data->genitalia_pria) : null;
                    ?>
                    <input type="hidden" name="genitalia_wanitas">
                    <input type="hidden" name="genitalia_prias">
                    <span style="font-weight: bold; width: 15%; display: inline-block;"> Genitalia,
                        Anus
                        dan Rektum</span>: <br>
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Wanita</span>:
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->tak ? 'checked' : '') : 'checked' }} value="t.a.k"
                        name="genitalia_wanita" id="tak_gen_wanita" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->sekret ? 'checked' : '') : '' }}
                        value="Asimetris" name="genitalia_wanita" id="sekret_gen_wanita" />
                    Sekret, Warna
                    <input type="text" value="{{ $genitalia_wanita ? $genitalia_wanita->sekret_input : '' }}"
                        name="genitalia" id="sekret_input_gen_wanita" />
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->prollaps ? 'checked' : '') : '' }}
                        value="Prollaps uteri" name="genitalia_wanita" id="prollaps_gen_wanita" />
                    Prollaps uteri
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->fistula ? 'checked' : '') : '' }}
                        value="Fistula Anai" name="genitalia_wanita" id="fistula_gen_wanita" />
                    Fistula Anai
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->haemoroid ? 'checked' : '') : '' }}
                        value="Haemoroid" name="genitalia_wanita" id="haemoroid_gen_wanita" />
                    Haemoroid
                    &nbsp; &nbsp; &nbsp; Hamil : <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->hamil_ya ? 'checked' : '') : '' }} value="Hamil"
                        name="genitalia_wanita" id="hamil_ya_gen_wanita" />
                    Ya
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->hamil_tidak ? 'checked' : '') : '' }}
                        value="Ya" name="genitalia_wanita" id="hamil_tidak_gen_wanita" />
                    Tidak
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->menstruasi_terakhir ? 'checked' : '') : '' }}
                        value="Tidak" name="genitalia_wanita" id="menstruasi_terakhir_gen_wanita" />
                    Menstruasi Terakhir
                    <input type="text"
                        value="{{ $genitalia_wanita ? $genitalia_wanita->menstruasi_trakhir_input : '' }}"
                        name="genitalia_wanita" id="menstruasi_trakhir_input_gen_wanita" />

                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->keluhan_menstruasi ? 'checked' : '') : '' }}
                        value="Keluhan Menstruasi" name="genitalia_wanita" id="keluhan_menstruasi_gen_wanita" />
                    Keluhan Menstruasi <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->keluhan_menstruasi_tidak ? 'checked' : '') : '' }}
                        value="Tidak" name="genitalia_wanita" id="keluhan_menstruasi_tidak_gen_wanita" /> Tidak
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_wanita ? ($genitalia_wanita->keluhan_menstruasi_ya ? 'checked' : '') : '' }}
                        value="Ya" name="genitalia_wanita" id="keluhan_menstruasi_ya_gen_wanita" />
                    Ya, Sebutkan: <input type="text"
                        value="{{ $genitalia_wanita ? $genitalia_wanita->keluhan_menstruasi_input : '' }}"
                        name="genitalia_wanita" id="keluhan_menstruasi_input_gen_wanita" />
                    <br>
                    <span style="font-weight: bold; width: 10%; display: inline-block;">Pria</span>:
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_pria ? ($genitalia_pria->tak ? 'checked' : '') : 'checked' }} value="t.a.k"
                        name="genitalia_pria" id="tak_gen_pria" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_pria ? ($genitalia_pria->phimosis ? 'checked' : '') : '' }} value="Phimosis"
                        name="genitalia_pria" id="phimosis_gen_pria" />
                    Phimosis
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_pria ? ($genitalia_pria->hernia ? 'checked' : '') : '' }} value="Hernia"
                        name="genitalia_pria" id="hernia_gen_pria" />
                    Hernia
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_pria ? ($genitalia_pria->haemoroid ? 'checked' : '') : '' }} value="Haemoroid"
                        name="genitalia_pria" id="haemoroid_gen_pria" />
                    Haemoroid
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_pria ? ($genitalia_pria->orchitis ? 'checked' : '') : '' }} value="Orchitis"
                        name="genitalia_pria" id="orchitis_gen_pria" />
                    Orchitis
                    <input class="ml-3" type="checkbox"
                        {{ $genitalia_pria ? ($genitalia_pria->sekret ? 'checked' : '') : '' }} value="Sekret"
                        name="genitalia_pria" id="sekret_gen_pria" />
                    Sekret, Warna
                    <input type="text" value="{{ $genitalia_pria ? $genitalia_pria->sekret_pria : '' }}"
                        name="genitalia_pria" id="sekret_pria_gen_pria" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $integumen = $data ? json_decode($data->integumen) : null;
                    // dd($integumen);
                    ?>
                    <input type="hidden" name="integumens">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Integumen</span>:
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->tak ? 'checked' : '') : 'checked' }} value="t.a.k"
                        name="integument" id="tak_integumen" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->turgor_jelek ? 'checked' : '') : '' }} value="Turgor Jelek"
                        name="integument" id="turgor_jelek_integumen" />
                    Turgor Jelek
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->dingin ? 'checked' : '') : '' }} value="Dingin"
                        name="integument" id="dingin_integumen" />
                    Dingin
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->bullac ? 'checked' : '') : '' }} value="Bullac"
                        name="integument" id="bullac_integumen" />
                    Bullac
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->fistula ? 'checked' : '') : '' }} value="Fistula"
                        name="integument" id="fistula_integumen" />
                    Fistula
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->ikterik ? 'checked' : '') : '' }} value="Ikterik"
                        name="integument" id="ikterik_integumen" />
                    Ikterik
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->diaforesi ? 'checked' : '') : '' }} value="Diaforesi"
                        name="integument" id="diaforesi_integumen" />
                    Diaforesi
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->pucat ? 'checked' : '') : '' }} value="Pucat"
                        name="integument" id="pucat_integumen" />
                    Pucat

                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->dekubitus ? 'checked' : '') : '' }} value="Dekubitus, Derajat"
                        name="integument" id="dekubitus_integumen" />
                    Dekubitus, Derajat
                    <input type="text" value="{{ $integumen ? $integumen->derajat_dekubitus : '' }}"
                        name="integument" id="derajat_dekubitus_integumen" />
                    Lokasi
                    <input type="text" value="{{ $integumen ? $integumen->lokasi_dekubitus : '' }}"
                        name="integument" id="lokasi_dekubitus_integumen" />
                    &nbsp; &nbsp; Luka:
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->luka_tidak_ada ? 'checked' : '') : '' }} value="Tidak Ada"
                        name="integument" id="luka_tidak_ada_integumen" />
                    Tidak Ada
                    <input class="ml-3" type="checkbox"
                        {{ $integumen ? ($integumen->luka_ada ? 'checked' : '') : '' }} value="Ada"
                        name="integument" id="luka_ada_integumen" />
                    Ada , Sebutkan
                    <input type="text" value="{{ $integumen ? $integumen->input_luka : '' }}"
                        name="integument" id="input_luka_integumen" />
                    <br>
                    <?php
                    $kondisi = $data ? json_decode($data->kondisi) : null;
                    ?>
                    <input type="hidden" name="kondisi">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Kondisi</span>:
                    <input class="ml-3" type="checkbox"
                        {{ $kondisi ? ($kondisi->bersih ? 'checked' : '') : 'checked' }} value="Bersih" name=""
                        id="bersih_kondisi" />
                    Bersih
                    <input class="ml-3" type="checkbox" {{ $kondisi ? ($kondisi->kotor ? 'checked' : '') : '' }}
                        value="Kotor" name="" id="kotor_kondisi" />
                    Kotor
                    &nbsp; &nbsp; Jahitan Luka :
                    <input class="ml-3" type="checkbox"
                        {{ $kondisi ? ($kondisi->jahitan_luka_ada ? 'checked' : '') : '' }} value="Ada"
                        name="" id="jahitan_luka_ada_kondisi" />
                    Ada
                    <input class="ml-3" type="checkbox"
                        {{ $kondisi ? ($kondisi->jahitan_luka_tidak_ada ? 'checked' : '') : '' }} value="Tidak Ada"
                        name="" id="jahitan_luka_tidak_ada_kondisi" />
                    Tidak Ada
                    <br>
                    <?php
                    $balutan = $data ? json_decode($data->balutan) : null;
                    ?>
                    <input type="hidden" name="balutan">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Balutan</span>:
                    <input class="ml-3" type="checkbox"
                        {{ $balutan ? ($balutan->bersih ? 'checked' : '') : 'checked' }} value="Bersih" name=""
                        id="bersih_balutan" />
                    Bersih
                    <input class="ml-3" type="checkbox" {{ $balutan ? ($balutan->kotor ? 'checked' : '') : '' }}
                        value="Kotor" name="" id="kotor_balutan" />
                    Kotor
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $ekstrem = $data ? json_decode($data->ekstremitas) : null;
                    ?>
                    <input type="hidden" name="ekstremitass">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Ekstremitas</span>:
                    <input class="ml-3" type="checkbox" {{ $ekstrem ? ($ekstrem->tak ? 'checked' : '') : 'checked' }}
                        value="t.a.k" name="ekstremitas" id="tak_ekstremitas" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->kelemahan_otot ? 'checked' : '') : '' }} value="Kelemahan Otot"
                        name="ekstremitas" id="kelemahan_otot_ekstremitas" />
                    Kelemahan Otot
                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->kejang ? 'checked' : '') : '' }} value="Kejang"
                        name="ekstremitas" id="kejang_ekstremitas" />
                    Kejang
                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->tremor ? 'checked' : '') : '' }} value="Tremor"
                        name="ekstremitas" id="tremor_ekstremitas" />
                    Tremor
                    <input class="ml-3" type="checkbox" {{ $ekstrem ? ($ekstrem->plegi ? 'checked' : '') : '' }}
                        value="Plegi" name="ekstremitas" id="plegi_ekstremitas" />
                    Plegi di <input type="text" value="{{ $ekstrem ? $ekstrem->plegi_di : '' }}"
                        name="ekstremitas" id="plegi_di_ekstremitas" />

                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->paraese ? 'checked' : '') : '' }} value="Paraese"
                        name="ekstremitas" id="paraese_ekstremitas" />
                    Paraese di <input type="text" value="{{ $ekstrem ? $ekstrem->paraese_di : '' }}"
                        name="ekstremitas" id="paraese_di_ekstremitas" />

                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->inkordinasi ? 'checked' : '') : '' }} value="Inkordinasi"
                        name="ekstremitas" id="inkordinasi_ekstremitas" />
                    Inkordinasi
                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->kelainan_kongenital ? 'checked' : '') : '' }}
                        value="Kelainan Kongenital" name="ekstremitas" id="kelainan_kongenital_ekstremitas" />
                    Kelainan Kongenital
                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->deformitas ? 'checked' : '') : '' }} value="Deformitas / Atropi"
                        name="ekstremitas" id="deformitas_ekstremitas" />
                    Deformitas / Atropi
                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->fraktur ? 'checked' : '') : '' }} value="Fraktur"
                        name="ekstremitas" id="fraktur_ekstremitas" />
                    Fraktur, Lokasi <input type="text" value="{{ $ekstrem ? $ekstrem->lokasi_fraktur : '' }}"
                        name="ekstremitas" id="lokasi_fraktur_ekstremitas" />
                    <input class="ml-3" type="checkbox"
                        {{ $ekstrem ? ($ekstrem->lain_lain ? 'checked' : '') : '' }} value="Lain-Lain"
                        name="ekstremitas" id="lain_lain_ekstremitas" />
                    Lain-Lain <input type="text" value="{{ $ekstrem ? $ekstrem->input_lain : '' }}"
                        name="ekstremitas" id="input_lain_ekstremitas" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $eliminasi = $data ? json_decode($data->eliminasi) : null;
                    ?>
                    <input type="hidden" name="eliminasi">
                    <span style="font-weight: bold; width: 10%; display: inline-block;">
                        Eliminasi</span>:
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->tak ? 'checked' : '') : 'checked' }} value="t.a.k" name=""
                        id="tak_eliminasi" />
                    t.a.k
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->diare ? 'checked' : '') : '' }} value="Diare" name=""
                        id="diare_eliminasi" />
                    Diare
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->konstipasi ? 'checked' : '') : '' }} value="Konstipasi"
                        name="" id="konstipasi_eliminasi" />
                    Konstipasi
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->inkontinetia ? 'checked' : '') : '' }}
                        value="Inkontinetia Alvi/Uri" name="" id="inkontinetia_eliminasi" />
                    Inkontinetia Alvi/Uri
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->colostomi ? 'checked' : '') : '' }} value="Colostomi"
                        name="" id="colostomi_eliminasi" />
                    colostomi
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->restensi ? 'checked' : '') : '' }} value="Restensi Uri"
                        name="" id="restensi_eliminasi" />
                    Restensi Uri
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->hematuri ? 'checked' : '') : '' }} value="Hematuri"
                        name="" id="hematuri_eliminasi" />
                    Hematuri
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->anuri ? 'checked' : '') : '' }} value="Anuri" name=""
                        id="anuri_eliminasi" />
                    Anuri
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->kandung_kemih ? 'checked' : '') : '' }} value="Kandung Kemih"
                        name="" id="kandung_kemih_eliminasi" />
                    Kandung Kemih
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->penuh ? 'checked' : '') : '' }} value="Penuh" name=""
                        id="penuh_eliminasi" />
                    Penuh
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->kosong ? 'checked' : '') : '' }} value="Kosong"
                        name="" id="kosong_eliminasi" />
                    Kosong
                    <input class="ml-3" type="checkbox"
                        {{ $eliminasi ? ($eliminasi->lain_lain ? 'checked' : '') : '' }} value="Lain-Lain"
                        name="" id="lain_lain_eliminasi" />
                    Lain-Lain <input type="text" value="{{ $eliminasi ? $eliminasi->input_lain : '' }}"
                        name="" id="input_lain_eliminasi" />
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">
                    <input type="hidden" name="obat_dirumah">
                    <span style="font-weight: bold; font-size: 14pt;">Obat - obatan di rumah (daftar obat, dosis,
                        frekuensi, kapan terakhir di konsumsi)</span>
                    <table style="width: 100%;">
                        <thead>
                            <th>
                                Nama Obat
                            </th>
                            <th>
                                Dosis/Frekuensi
                            </th>
                            <th>
                                Kapan Terakhir Kali Diberikan
                            </th>
                            <th>
                                <button type="button" class="btn btn-primary" onclick="open_modal_obat()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </th>
                        </thead>
                        <tbody id="list_obat_obatan_rumah"></tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="title-section" colspan="4">
                    V.RESIKO CIDERA/JATUH
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="hidden" name="resiko_cidera_jatuh">
                    <span style="font-style: italic; font-size: 13pt;">Tulis Skor Pada Kolom Hasil Sesuai Hasil
                        Pengkaisan</span> <br>
                    <table style="width: 100%;">
                        <thead style="text-align: center;">
                            <th>No</th>
                            <th>Tingkat Resiko</th>
                            <th>Skor</th>
                            <th>Nilai Skor</th>
                        </thead>
                        <tbody id="table_pengkaisan">
                            <?php
                            $rcj = $data ? json_decode($data->resiko_cidera_jatuh) : [];
                            ?>
                            <tr>
                                <td>1</td>
                                <td>Gangguan gaya berjalan (diseret, menghentak, berayun)</td>
                                <td>4</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[0]) ? $rcj[0] : '' }}"
                                        name="gangguan_berjalan" id="resiko_cidera_1" />
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Pusing/Pingsan posisi tegak</td>
                                <td>3</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[1]) ? $rcj[1] : '' }}"
                                        name="pingsan" id="resiko_cidera_2" />
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kebingungan setiap saat</td>
                                <td>3</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[2]) ? $rcj[2] : '' }}"
                                        name="kebingungan" id="resiko_cidera_3" />
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Nokturin/Inkontinen</td>
                                <td>3</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[3]) ? $rcj[3] : '' }}"
                                        name="nokturin" id="resiko_cidera_4" />
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Kebingungan Intermitten</td>
                                <td>2</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[4]) ? $rcj[4] : '' }}"
                                        name="kebingungan_intermitten" id="resiko_cidera_5" />
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Kelemahan Umum</td>
                                <td>2</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[5]) ? $rcj[5] : '' }}"
                                        name="kelemahan_umum" id="resiko_cidera_6" />
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Obat-obatan beresiko tinggi (Direktik, narkotik, Sedative, anti psikotik, laksatif,
                                    vasodilator, Antiaritmia, Anti Hipertensi, obat hipoglikemik, Anti Depresan,
                                    Neurolwptik, NSAID)</td>
                                <td>2</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[6]) ? $rcj[6] : '' }}"
                                        name="obat_obatan_beresiko" id="resiko_cidera_7" />
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Riwayat jatuh dalam waktu 12 bulan sebelumnya</td>
                                <td>2</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[7]) ? $rcj[7] : '' }}"
                                        name="riwayat_jatuh" id="resiko_cidera_8" />
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Osteoporosis</td>
                                <td>1</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[8]) ? $rcj[8] : '' }}"
                                        name="osteoporosis" id="resiko_cidera_9" />
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Gangguan pendengaran dan atau penglihatan</td>
                                <td>1</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[9]) ? $rcj[9] : '1' }}"
                                        name="gangguan_pendengaran_penglihatan" id="resiko_cidera_10" />
                                </td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Usia 70 tahun ke atas</td>
                                <td>1</td>
                                <td style="padding-top: 10px;">
                                    <input type="number" value="{{ isset($rcj[10]) ? $rcj[10] : '1' }}"
                                        name="usia_70" id="resiko_cidera_11" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Jumlah</td>
                                <td></td>
                                <td id="total_result">2</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <span style="font-weight: bold; margin: 25px;">Kesimpulan Resiko Jatuh : </span>
                    <input type="radio" value="Rendah" name="kesimpulan_resiko" id="kesimpulan_resiko_rendah"
                        {{ $data ? ($data->kesimpulan_resiko_jatuh == 'Rendah' ? 'checked' : '') : 'checked' }} />
                    Rendah (1-3)
                    &nbsp; &nbsp;<input type="radio" value="Tinggi" name="kesimpulan_resiko"
                        id="kesimpulan_resiko_tinggi"
                        {{ $data ? ($data->kesimpulan_resiko_jatuh == 'Tinggi' ? 'checked' : '') : '' }} />
                    Tinggi (>4)
                    <br>
                    <span style="font-weight: bold; margin: 25px;">Jika Skor >4, maka : </span>
                    <div class="ml-5">
                        <?php
                        $tindakan_rcj = $data ? json_decode($data->tindakan_resiko_jatuh) : null;
                        ?>
                        <input type="checkbox" value="" name=""
                            {{ $tindakan_rcj ? ($tindakan_rcj->pasang_pin_kuning ? 'checked' : '') : '' }}
                            id="pasang_pin_kuning" />
                        Pasang PIN Kuning pada gelang indentifikasi pasien<br>

                        <input type="checkbox" value="" name=""
                            {{ $tindakan_rcj ? ($tindakan_rcj->pencegahan_jatuh ? 'checked' : '') : '' }}
                            id="pencegahan_jatuh" />
                        Lakukan tindakan pencegahan jatuh
                        <input type="hidden" name="tindakan_resiko_jatuh">
                    </div>

                </td>
                <script>
                    $(document).ready(function() {
                        // Function to calculate the total
                        function calculateTotal() {
                            let total = 0;

                            // Iterate through the number inputs within the tbody
                            $("#table_pengkaisan input[type='number']").each(function() {
                                const value = parseInt($(this).val()) ||
                                    0; // Convert the input value to an integer or 0 if empty
                                total += value;
                            });

                            // Update the total in the desired location (e.g., an element with id "total_result")
                            $("#total_result").text(total);

                            if (total > 4) {
                                $("#kesimpulan_resiko_tinggi").prop("checked", true);
                            } else {
                                $("#kesimpulan_resiko_rendah").prop("checked", true);
                            }
                        }

                        // Initially calculate the total
                        calculateTotal();

                        // When any of the number inputs change
                        $("#table_pengkaisan input[type='number']").change(function() {
                            calculateTotal();

                        });


                    });
                </script>
            </tr>
            <tr>
                <td class="title-section" colspan="4">
                    <?php
                    $rcd = $data ? json_decode($data->resiko_dekubitus) : null;
                    ?>
                    <input type="hidden" name="resiko_dekubitus">
                    RESIKO CIDERA/DEKUBITUS (<span style="font-style: italic;">Norton Scale</span>)
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span style="padding-left: 10%;">Lingkari skor dengan jawaban (total skor adalah jumlah skor yang
                        dilingkari) </span>
                    <br>
                    <br>
                    <table width="100%">
                        <thead style="text-align: center;">
                            <th colspan="2">Keadaan Pasien</th>
                            <th>SKOR</th>
                        </thead>
                        <tbody id="nilai_keadaan_pasien">
                            <tr>
                                <th rowspan="5">Kondisi Fisik</th>
                            </tr>
                            <tr>
                                <td>Baik</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->kondisi_fisik == '4' ? 'checked' : '') : 'checked' }}
                                        value="4" name="kondisi_fisik" id="keadaan_pasien" /> 4</td>
                            </tr>
                            <tr>
                                <td>Cukup Baik</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->kondisi_fisik == '3' ? 'checked' : '') : '' }}
                                        value="3" name="kondisi_fisik" id="keadaan_pasien" /> 3</td>
                            </tr>
                            <tr>
                                <td>Buruk</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->kondisi_fisik == '2' ? 'checked' : '') : '' }}
                                        value="2" name="kondisi_fisik" id="keadaan_pasien" /> 2</td>
                            </tr>
                            <tr>
                                <td>Sangat Buruk</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->kondisi_fisik == '1' ? 'checked' : '') : '' }}
                                        value="1" name="kondisi_fisik" id="keadaan_pasien" /> 1</td>
                            </tr>
                            <tr>
                                <th rowspan="5">Mobilitas Status Mental</th>
                            </tr>
                            <tr>
                                <td>Waspada/compos mentis</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->mobilitas == '4' ? 'checked' : '') : 'checked' }} value="4"
                                        name="mobilitas" id="" /> 4
                                </td>
                            </tr>
                            <tr>
                                <td>Apatis</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->mobilitas == '3' ? 'checked' : '') : '' }} value="3"
                                        name="mobilitas" id="" /> 3
                                </td>
                            </tr>
                            <tr>
                                <td>Confue/delirium/kacau</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->mobilitas == '2' ? 'checked' : '') : '' }} value="2"
                                        name="mobilitas" id="" /> 2
                                </td>
                            </tr>
                            <tr>
                                <td>Stupor/Koma</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->mobilitas == '1' ? 'checked' : '') : '' }} value="1"
                                        name="mobilitas" id="" /> 1
                                </td>
                            </tr>
                            <tr>
                                <th rowspan="5">Aktifitas</th>
                            </tr>
                            <tr>
                                <td>Bergerak bebas/aktif berjalan</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->aktivitas == '4' ? 'checked' : '') : 'checked' }} value="4"
                                        name="aktivitas" id="" /> 4
                                </td>
                            </tr>
                            <tr>
                                <td>jalan dengan bantuan/dipapah</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->aktivitas == '3' ? 'checked' : '') : '' }} value="3"
                                        name="aktivitas" id="" /> 3
                                </td>
                            </tr>
                            <tr>
                                <td>Dengan kursi roda/sangan terbatas</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->aktivitas == '2' ? 'checked' : '') : '' }} value="2"
                                        name="aktivitas" id="" /> 2
                                </td>
                            </tr>
                            <tr>
                                <td>Tidak bisa bergerak/tirah baring</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->aktivitas == '1' ? 'checked' : '') : '' }} value="1"
                                        name="aktivitas" id="" /> 1
                                </td>
                            </tr>
                            <tr>
                                <th rowspan="5"></th>
                            </tr>
                            <tr>
                                <td>Penuh</td>
                                <td> <input type="radio" {{ $rcd ? ($rcd->empty == '4' ? 'checked' : '') : 'checked' }}
                                        value="4" name="empty" id="" /> 4
                                </td>
                            </tr>
                            <tr>
                                <td>Agak Terbatas</td>
                                <td> <input type="radio" {{ $rcd ? ($rcd->empty == '3' ? 'checked' : '') : '' }}
                                        value="3" name="empty" id="" /> 3
                                </td>
                            </tr>
                            <tr>
                                <td>Sangat Terbatas</td>
                                <td> <input type="radio" {{ $rcd ? ($rcd->empty == '2' ? 'checked' : '') : '' }}
                                        value="2" name="empty" id="" /> 2
                                </td>
                            </tr>
                            <tr>
                                <td>Imobilitas</td>
                                <td> <input type="radio" {{ $rcd ? ($rcd->empty == '1' ? 'checked' : '') : '' }}
                                        value="1" name="empty" id="" /> 1
                                </td>
                            </tr>
                            <tr>
                                <th rowspan="5">Inkontinesia</th>
                            </tr>
                            <tr>
                                <td>Tidak Ada</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->inkontinesia == '4' ? 'checked' : '') : 'checked' }}
                                        value="4" name="inkontinesia" id="" />
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>Kadang Kala</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->inkontinesia == '3' ? 'checked' : '') : '' }}
                                        value="3" name="inkontinesia" id="" />
                                    3
                                </td>
                            </tr>
                            <tr>
                                <td>Sering</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->inkontinesia == '2' ? 'checked' : '') : '' }}
                                        value="2" name="inkontinesia" id="" />
                                    2
                                </td>
                            </tr>
                            <tr>
                                <td>Selalu</td>
                                <td> <input type="radio"
                                        {{ $rcd ? ($rcd->inkontinesia == '1' ? 'checked' : '') : '' }}
                                        value="1" name="inkontinesia" id="" />
                                    1
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <th colspan="2" style="font-size: 14pt; text-align: center;">TOTAL SKOR :</th>
                            <th id="total_keadaan_pasien">0</th>
                        </tfoot>
                    </table>
                    <br>
                    <div style="display: flex;">
                        <div>
                            <span>Kesimpulan : Resiko Dekubitus </span>
                        </div>
                        <div class="ml-3">
                            <input type="radio" value="rendah"
                                {{ $data ? ($data->kesimpulan_resiko_dekubitus == 'rendah' ? 'checked' : '') : 'checked' }}
                                name="kesimpulan_resiko_dekubitus" id="resiko_dekubitus_rendah" /> Rendah (>18)
                            <input class="ml-2" type="radio" value="sedang"
                                {{ $data ? ($data->kesimpulan_resiko_dekubitus == 'sedang' ? 'checked' : '') : '' }}
                                name="kesimpulan_resiko_dekubitus" id="resiko_dekubitus_sedang" /> Sedang (14-16)
                            <input class="ml-2" type="radio" value="tinggi"
                                {{ $data ? ($data->kesimpulan_resiko_dekubitus == 'tinggi' ? 'checked' : '') : '' }}
                                name="kesimpulan_resiko_dekubitus" id="resiko_dekubitus_tinggi" /> Tinggi (10-13)
                            <input class="ml-2" type="radio" value="sangat_tinggi"
                                {{ $data ? ($data->kesimpulan_resiko_dekubitus == 'sangat_tinggi' ? 'checked' : '') : '' }}
                                name="kesimpulan_resiko_dekubitus" id="resiko_dekubitus_sangat_tinggi" /> Sangat
                            Tinggi (<10) </div>
                        </div>
                </td>
                <script charset="utf-8">
                    $(document).ready(function() {
                        // Event handler if radio button change 
                        $("input[type='radio']", "#nilai_keadaan_pasien").change(function() {
                            // Inisialisasi total skor
                            let totalSkor = 0;

                            // looping radio button there are inside tbody
                            $("input[type='radio']:checked", "#nilai_keadaan_pasien").each(function() {
                                // Mengambil nilai skor dari radio button yang dipilih
                                const skor = parseInt($(this).val());

                                // add scroe to total
                                totalSkor += skor;
                            });

                            // show total skor to elemen with id "total_keadaan_pasien"
                            $("#total_keadaan_pasien").text(totalSkor);

                            //select radio button 
                            if (totalSkor > 18) {
                                $("#resiko_dekubitus_rendah").prop("checked", true);
                            }
                            if (totalSkor >= 14 && totalSkor <= 18) {
                                $("#resiko_dekubitus_sedang").prop("checked", true);
                            }
                            if (totalSkor >= 10 && totalSkor <= 13) {
                                $("#resiko_dekubitus_tinggi").prop("checked", true);
                            }
                            if (totalSkor < 10) {
                                $("#resiko_dekubitus_sangat_tinggi").prop("checked", true);
                            }
                        });

                        // changes simulation for total awal (if radio button checked on page load)
                        $("input[type='radio']:checked", "#nilai_keadaan_pasien").change();
                    });
                </script>
            </tr>
            <tr>
                <td class="title-section" colspan="4">VII. NUTRISI</td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    $nutrisi = $data ? json_decode($data->nutrisi) : null;
                    ?>
                    <input type="hidden" name="nutrisi">
                    SKRINING GIZI (Berdasarkan Malnutrition Screening tool / MST) <br>
                    <span style="font-style: italic;"> Lingkari skor sesuai dengan jawaban, total Skor adalah jumlah
                        skor
                        yang di inginkan</span>
                    <table style="width: 100%;" class="mt-3 mb-3">
                        <tr>
                            <th>No</th>
                            <th class="text-center">Parameter</th>
                            <th>Skor</th>
                        </tr>
                        <tr>
                            <td rowspan="9" style="vertical-align: top">1</td>
                            <td>Apakah pasien mengalami penurunan berat badan yang tidak diinginkan dalam 6 bulan
                                terakhir?
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Tidak ada penurunan berat badan</td>
                            <td> <input type="radio"
                                    {{ $nutrisi ? ($nutrisi->penurunan_bb == '0' ? 'checked' : '') : 'checked' }}
                                    value="0" name="penurunan_bb" id="" /> 0
                            </td>
                        </tr>
                        <tr>
                            <td>b. Tidak yakin / tidak tahu / terasa baju lebih longgar</td>
                            <td> <input type="radio"
                                    {{ $nutrisi ? ($nutrisi->penurunan_bb == '2' ? 'checked' : '') : '' }}
                                    value="2" name="penurunan_bb" id="" /> 2
                            </td>
                        </tr>
                        <tr>
                            <td>c. Jika ya, berapa penurunan berat badan tersebut</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1-5 kg</td>
                            <td> <input type="radio"
                                    {{ $nutrisi ? ($nutrisi->penurunan_bb == '1' ? 'checked' : '') : '' }}
                                    value="1" name="penurunan_bb" id="" /> 1
                            </td>
                        </tr>
                        <tr>
                            <td>6-10 kg</td>
                            <td> <input type="radio"
                                    {{ $nutrisi ? ($nutrisi->penurunan_bb == '2' ? 'checked' : '') : '' }}
                                    value="2" name="penurunan_bb" id="" /> 2
                            </td>
                        </tr>
                        <tr>
                            <td>11-15 kg</td>
                            <td> <input type="radio"
                                    {{ $nutrisi ? ($nutrisi->penurunan_bb == '3' ? 'checked' : '') : '' }}
                                    value="3" name="penurunan_bb" id="" /> 3
                            </td>
                        </tr>
                        <tr>
                            <td>>15 kg</td>
                            <td> <input type="radio"
                                    {{ $nutrisi ? ($nutrisi->penurunan_bb == '4' ? 'checked' : '') : '' }}
                                    value="4" name="penurunan_bb" id="" /> 4
                            </td>
                        </tr>
                        <tr>
                            <td>Tidak yakin penurunannya</td>
                            <td> <input type="radio"
                                    {{ $nutrisi ? ($nutrisi->penurunan_bb == '2' ? 'checked' : '') : '' }}
                                    value="2" name="penurunan_bb" id="" /> 2
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3" style="vertical-align: top">2</td>
                            <td>Apakah asupan makanan berkurang karena berkurangnya nafsu makan?</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Tidak</td>
                            <td> <input type="radio" value="0"
                                    {{ $nutrisi ? ($nutrisi->asupan_makanan == '0' ? 'checked' : '') : 'checked' }}
                                    name="asupan_makanan" id="" /> 0
                            </td>
                        </tr>
                        <tr>
                            <td>b. Ya</td>
                            <td> <input type="radio" value="1"
                                    {{ $nutrisi ? ($nutrisi->asupan_makanan == '1' ? 'checked' : '') : '' }}
                                    name="asupan_makanan" id="" /> 1
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">3</td>
                            <td colspan="2">Pasien dengan diagnosis khusus : penyakit DM / Ginjal / Hati / Jantung
                                /
                                Paru / Stroke / Kanker/Penurunan Imunitas, Geriatri. <br>
                                <input type="radio" value="Tidak"
                                    {{ $nutrisi ? ($nutrisi->diagnosis_khusus == 'Tidak' ? 'checked' : '') : 'checked' }}
                                    name="diagnosis_khusus" id="">
                                Tidak <br>
                                <input type="radio" value="ya"
                                    {{ $nutrisi ? ($nutrisi->diagnosis_khusus == 'ya' ? 'checked' : '') : '' }}
                                    name="diagnosis_khusus" id="">
                                Ya
                            </td>
                        </tr>
                    </table>
                    Bila Skor >2 dan atau pasien dengan diagnosis / kondisi khusus, rujuk ke Ahli Gizi: <br>
                    <input type="radio" value="Ya"
                        {{ $data ? ($data->rujuk_ahli_gizi == 'Ya' ? 'checked' : '') : '' }} name="skor"
                        id="" /> Ya &nbsp; &nbsp;
                    <input type="radio" value="Tidak"
                        {{ $data ? ($data->rujuk_ahli_gizi == 'Tidak' ? 'checked' : '') : 'checked' }} name="skor"
                        id="" /> Tidak
                </td>
            </tr>
            <tr>
                <td class="title-section" colspan="4">VIII. STATUS FUNGSIONAL</td>
            </tr>
            <tr>
                <td colspan="4">
                    @php
                        $fungsional = $data ? json_decode($data->status_fungsional) : null;
                    @endphp
                    <input type="hidden" name="status_fungsional">
                    <span style="font-style: italic;"> (tulis hasil atau skor sesuai dengan hasil
                        pengkajian. Total skor adalah jumlah total skor sesuai hasil pengkajian) </span>
                    <table style="width: 100%;" class="mt-3 mb-3" id="table_status_fungsional">
                        <tr>
                            <td rowspan="3">No.</td>
                            <td rowspan="3">Fungsi</td>
                            <td rowspan="3">Skor</td>
                            <td rowspan="3">Keterangan</td>
                            <td colspan="2">Hasil Skor</td>
                        </tr>
                        <tr>
                            <td>Saat Masuk RS</td>
                            <td>Saat Pulang RS</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pemeriksaan : <br> <input class="form-control" type="date"
                                    value="{{ $fungsional ? $fungsional->masuk_rs->tanggal : '' }}"
                                    name="tgl_masuk_rs" id="tgl_masuk_rs" /> </td>
                            <td>Tanggal Pemeriksaan : <br> <input class="form-control" type="date"
                                    value="{{ $fungsional ? $fungsional->pulang_rs->tanggal : '' }}"
                                    name="tgl_pulang_rs" id="tgl_pulang_rs" /> </td>
                        </tr>
                        <tr>
                            <td rowspan="3">1</td>
                            <td rowspan="3">Mengendalikan Rangsan Defaksi</td>
                            <td>0</td>
                            <td>Tak terkendali / tak teratur (perlu pencahar)</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[0] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="rangsang_defaksi_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[0] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="rangsang_defaksi_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Kadang-kadang tak terkendali</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[0] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="rangsang_defaksi_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[0] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="rangsang_defaksi_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Terkendali teratur</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[0] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="rangsang_defaksi_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[0] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="rangsang_defaksi_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td rowspan="3">2</td>
                            <td rowspan="3">Mengendalikan Rangsan Kemih</td>
                            <td>0</td>
                            <td>Tak terkendali / pakai kateter</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[1] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="rangsang_kemih_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[1] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="rangsang_kemih_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Kadang-kadang tak terkendali / 1x24 jam</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[1] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="rangsang_kemih_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[1] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="rangsang_kemih_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[1] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="rangsang_kemih_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[1] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="rangsang_kemih_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td rowspan="2">3</td>
                            <td rowspan="2">Membersihkan Diri (Cuci Muka, Sisir Rambut, Sikat Gigi) </td>
                            <td>0</td>
                            <td>Tergantung Pertolongan Orang Lain</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[2] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="membersihkan_diri_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[2] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="membersihkan_diri_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[2] == '5' ? 'checked' : '') : 'checked' }}
                                    value="5" name="membersihkan_diri_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[2] == '5' ? 'checked' : '') : 'checked' }}
                                    value="5" name="membersihkan_diri_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td rowspan="3">4</td>
                            <td rowspan="3">Penggunaan jamban masuk dan keluar (Melepaskan memakai
                                celana,membersihkan,
                                menyiram )</td>
                            <td>0</td>
                            <td>Tergantung Pertolongan Orang Lain</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[3] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="penggunaan_jamban_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[3] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="penggunaan_jamban_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>
                                Perlu Pertolongan pada beberapa kegiatantetapi dapat mengerjakan sendiri
                                kegiatan yang
                                lain</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[3] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="penggunaan_jamban_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[3] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="penggunaan_jamban_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[3] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="penggunaan_jamban_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[3] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="penggunaan_jamban_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td rowspan="3">5</td>
                            <td rowspan="3">Makan</td>
                            <td>0</td>
                            <td>Tidak mampu</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[4] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="makan_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[4] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="makan_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Perlu pertolongan memotong makanan</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[4] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="makan_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[4] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="makan_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[4] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="makan_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[4] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="makan_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3">6</td>
                            <td rowspan="3">Berubah sikap dari berbaring ke duduk</td>
                            <td>0</td>
                            <td>Tidak mampu</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[5] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="berubah_sikap_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[5] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="berubah_sikap_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Perlu banyak bantuan untuk bisa duduk (2 orang)</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[5] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="berubah_sikap_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[5] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="berubah_sikap_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[5] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="berubah_sikap_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[5] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="berubah_sikap_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3">7</td>
                            <td rowspan="3">Berpindah / berjalan</td>
                            <td>0</td>
                            <td>Tidak mampu</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[6] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="berpindah_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[6] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="berpindah_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Bisa (pindah) dengan kursi roda</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[6] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="berpindah_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[6] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="berpindah_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Berjalan dengan bantuan 1 orang</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[6] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="berpindah_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[6] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="berpindah_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3">8</td>
                            <td rowspan="3">Memakai baju</td>
                            <td>0</td>
                            <td>Tergantung orang lain</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[7] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="memakai_baju_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[7] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="memakai_baju_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Sebagian dibantu (misal mengancingkan baju)</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[7] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="memakai_baju_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[7] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="memakai_baju_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[7] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="memakai_baju_masuk" id="" />
                            </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[7] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="memakai_baju_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3">9</td>
                            <td rowspan="3">Naik Turun Tangga</td>
                            <td>0</td>
                            <td>Tidak mampu</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[8] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="naik_turun_tangga_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[8] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="naik_turun_tangga_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Butuh pertolongan</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[8] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="naik_turun_tangga_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[8] == '5' ? 'checked' : '') : '' }}
                                    value="5" name="naik_turun_tangga_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[8] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="naik_turun_tangga_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[8] == '10' ? 'checked' : '') : 'checked' }}
                                    value="10" name="naik_turun_tangga_keluar" id="" /> </td>
                        </tr>
                        <tr>
                            <td rowspan="2">10</td>
                            <td rowspan="2">Mandi</td>
                            <td>0</td>
                            <td>Tergantung Orang Lain</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[9] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="mandi_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[9] == '0' ? 'checked' : '') : '' }}
                                    value="0" name="mandi_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Mandiri</td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->masuk_rs->skor[9] == '5' ? 'checked' : '') : 'checked' }}
                                    value="5" name="mandi_masuk" id="" /> </td>
                            <td> <input type="radio"
                                    {{ $fungsional ? ($fungsional->pulang_rs->skor[9] == '5' ? 'checked' : '') : 'checked' }}
                                    value="5" name="mandi_keluar" id="" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">Total Skor:</td>
                            <td id="total_skor_masuk"></td>
                            <td id="total_skor_keluar"></td>
                        </tr>
                    </table>
                    <div class="row mb-2" style="font-weight: bold;">
                        <div>
                            Kesimpulan :
                        </div>
                        <div class="ml-3">
                            <input type="radio" value="Ketergantungan Total"
                                {{ $data ? ($data->kesimpulan_status_fungsional == 'Ketergantungan Total' ? 'checked' : '') : '' }}
                                name="kesimpulan_status_fungsional" id="kesimpuan" />
                            Ketergantungan
                            Total (0-20) <br>
                            <input type="radio" value="Ketergantungan Sedang"
                                {{ $data ? ($data->kesimpulan_status_fungsional == 'Ketergantungan Sedang' ? 'checked' : '') : '' }}
                                name="kesimpulan_status_fungsional" id="kesimpuan" />
                            Ketergantungan Sedang (45-55) <br>
                            <input type="radio" value="Mandiri"
                                {{ $data ? ($data->kesimpulan_status_fungsional == 'Mandiri' ? 'checked' : '') : 'checked' }}
                                name="kesimpulan_status_fungsional" id="kesimpuan" /> Mandiri
                        </div>
                        <div class="ml-3">
                            <input type="radio" value="Ketergantungan Berat"
                                {{ $data ? ($data->kesimpulan_status_fungsional == 'Ketergantungan Berat' ? 'checked' : '') : '' }}
                                name="kesimpulan_status_fungsional" id="kesimpuan" />
                            Ketergantungan
                            Berat (25-40) <br>
                            <input type="radio" value="Ketergantungan Ringan"
                                {{ $data ? ($data->kesimpulan_status_fungsional == 'Ketergantungan Ringan' ? 'checked' : '') : '' }}
                                name="kesimpulan_status_fungsional" id="kesimpuan" />
                            Ketergantungan Ringan (60-90) <br>
                        </div>
                    </div>
                    Perlu bantuan, sebutkan : <input class="form-control" type="text"
                        value="{{ $data ? $data->perlu_bantuan : '' }}" name="perlu_bantuan"
                        id="perlu_bantuan" /> <br>
                    Alat bantu jalan, sebutkan : <input class="form-control" type="text"
                        value="{{ $data ? $data->alat_bantu : '' }}" name="alat_bantu" id="perlu_bantuan" />
                </td>
            </tr>
            <script charset="utf-8">
                $(document).ready(function() {
                    // Ketika ada perubahan pada input radio di dalam tabel dengan ID "table_status_fungsional"
                    $("#table_status_fungsional input[type='radio']").change(function() {
                        calculateTotalScore();
                    });

                    // Fungsi untuk menghitung total skor masuk dan keluar
                    function calculateTotalScore() {
                        var totalScoreMasuk = 0;
                        var totalScoreKeluar = 0;

                        // Loop melalui semua baris tabel dengan ID "table_status_fungsional"
                        $("#table_status_fungsional tr").each(function() {
                            var radioMasuk = $(this).find("input[name$='_masuk']:checked");
                            var radioKeluar = $(this).find("input[name$='_keluar']:checked");

                            if (radioMasuk.length > 0) {
                                var scoreMasuk = parseInt(radioMasuk.val());
                                totalScoreMasuk += scoreMasuk;
                            }

                            if (radioKeluar.length > 0) {
                                var scoreKeluar = parseInt(radioKeluar.val());
                                totalScoreKeluar += scoreKeluar;
                            }
                        });

                        // Menampilkan total skor masuk dan keluar pada elemen dengan ID 'total_skor_masuk' dan 'total_skor_keluar'
                        $("#total_skor_masuk").text(totalScoreMasuk);
                        $("#total_skor_keluar").text(totalScoreKeluar);
                    }

                    calculateTotalScore();
                });
            </script>
            <tr>
                <td colspan="4" class="title-section"> IX. KEBUTUHAN KOMUNIKASI / PENDIDIKAN DAN PENGAJARAN</td>
            </tr>
            <tr>
                <td colspan="4" class="pt-1">
                    @php
                        $kebutuhan_komunikasi = $data ? json_decode($data->kebutuhan_komunikasi) : null;
                    @endphp
                    <input type="hidden" name="kebutuhan_komunikasi">
                    Bicara : <input type="radio" value="Normal"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->bicara == 'Normal' ? 'checked' : '') : 'checked' }}
                        name="bicara" id="bicara" /> Normal &nbsp; <input type="radio" value="gangguan"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->bicara == 'gangguan' ? 'checked' : '') : '' }}
                        name="bicara" id="bicara" /> Gangguan bicara, Jelaskan &nbsp; <input type="text"
                        value="{{ $kebutuhan_komunikasi ? $kebutuhan_komunikasi->bicara_input : '' }}"
                        name="" id="bicara_input" />
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pt-1">Perlu Penerjemah: <input type="radio" value="Tidak"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->perlu_penerjemah == 'Tidak' ? 'checked' : '') : 'checked' }}
                        name="penerjemah" id="penerjema" /> Tidak <input type="radio" value="Ya"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->perlu_penerjemah == 'Ya' ? 'checked' : '') : '' }}
                        name="penerjemah" id="penerjemah" /> Ya, Bahasa: <input type="text"
                        value="{{ $kebutuhan_komunikasi ? $kebutuhan_komunikasi->bahasa : '' }}" name=""
                        id="bahasa_penerjemah" /> &nbsp; &nbsp; Bahasa isyarat : <input type="radio"
                        value="Ya"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->bahasa_isyarat == 'Ya' ? 'checked' : '') : '' }}
                        name="bahasa_isyarat" id="" /> Ya &nbsp; <input type="radio" value="Tidak"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->bahasa_isyarat == 'Tidak' ? 'checked' : '') : '' }}
                        name="bahasa_isyarat" id="" /> Tidak </td>
            </tr>
            <tr>
                <td colspan="4">Hambatan Belajar : <input type="radio" value="Tidak"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->hambatan_belajar == 'Tidak' ? 'checked' : '') : 'checked' }}
                        name="hambatan_belajar" id="hambatan_belajar" /> Tidak <input type="radio"
                        value="Ya"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->hambatan_belajar == 'Ya' ? 'checked' : '') : '' }}
                        name="" id="" /> Ya, sebutkan hambatanya ( <span
                        style="font-style: italic;"> boleh mencentang
                        lebih dari 1 pilihan) </span> <br>
                    @foreach (['pendengaran', 'penglihatan', 'kognitif', 'fisik', 'budaya', 'agama', 'emosi', 'bahasa'] as $item)
                        <input class="ml-2" type="checkbox" value="{{ $item }}"
                            {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->hambatan_belajar_value->$item ? 'checked' : '') : '' }}
                            id="hambatan_belajar_{{ $loop->iteration }}" /> {{ $item }}
                    @endforeach
                    <input class="ml-2" type="checkbox"
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->hambatan_belajar_value->lainnya ? 'checked' : '') : '' }}
                        name="" id="hambatan_belajar_9" /> Lainya : <input type="text"
                        value="{{ $kebutuhan_komunikasi ? $kebutuhan_komunikasi->hambatan_belajar_value->lain_input : '' }}"
                        name="" id="hambatan_belajar_lain" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Kebutuhan pembelajaran ( <span style="font-style: italic;"> pilih topik pembelajaran pada kotak
                        yang
                        tersedia) </span> <br>
                    Pasien/Keluarga menginginkan informasi tentang : <br>
                    @foreach (['Proses Penyakit', 'therapi/obat', 'diet dan nutrisi', 'rehabilitasi', 'managemen nyeri'] as $item)
                        <input class="ml-2" type="checkbox" value="{{ $item }}" name=""
                            @php
switch ($item) {
                                    case 'Proses Penyakit':
                                        echo $kebutuhan_komunikasi ? $kebutuhan_komunikasi->kebutuhan_pembelajaran->proses_penyakit ? 'checked' : '' : '' ;
                                        break;
                                    case 'therapi/obat':
                                        echo $kebutuhan_komunikasi ? $kebutuhan_komunikasi->kebutuhan_pembelajaran->therapi ? 'checked' : '' : '' ;
                                        break;
                                    case 'diet dan nutrisi':
                                        echo $kebutuhan_komunikasi ? $kebutuhan_komunikasi->kebutuhan_pembelajaran->diet ? 'checked' : '' : '' ;
                                        break;
                                    case 'rehabilitasi':
                                        echo $kebutuhan_komunikasi ? $kebutuhan_komunikasi->kebutuhan_pembelajaran->rehabilitasi ? 'checked' : '' : '' ;
                                        break;
                                    case 'managemen nyeri':
                                        echo $kebutuhan_komunikasi ? $kebutuhan_komunikasi->kebutuhan_pembelajaran->managemen_nyeri ? 'checked' : '' : '' ;
                                        break;
                                    default:
                                        # code...
                                        break;
                                } @endphp
                            id="kebutuhan_pembelajaran_{{ $loop->iteration }}" /> {{ $item }}
                    @endforeach
                    <input class="ml-2" type="checkbox" value="" name=""
                        {{ $kebutuhan_komunikasi ? ($kebutuhan_komunikasi->kebutuhan_pembelajaran->lainnya ? 'checked' : '') : 'checked' }}
                        id="kebutuhan_pembelajaran_6" /> Lainya : <input type="text"
                        value="{{ $kebutuhan_komunikasi ? $kebutuhan_komunikasi->kebutuhan_pembelajaran->lain_input : '' }}"
                        name="" id="kebutuhan_pembelajaran_lain" />
                </td>
            </tr>
            <tr>
                <td colspan="4" class="title-section"> X. STATUS EKONOMI </td>
            </tr>
            <tr>
                <td colspan="4">
                    @php
                        $status_ekonomi = $data ? json_decode($data->status_ekonomi) : null;
                    @endphp
                    <input type="hidden" name="status_ekonomi">
                    Penanggung Jawab : <input type="radio" value="Pribadi"
                        {{ $status_ekonomi ? ($status_ekonomi->penanggung_jawab == 'Pribadi' ? 'checked' : '') : '' }}
                        name="penangung_jawab" id="penangung_jawab" /> Pribadi &nbsp; <input type="radio"
                        value="Asuransi"
                        {{ $status_ekonomi ? ($status_ekonomi->penanggung_jawab == 'Asuransi' ? 'checked' : '') : '' }}
                        name="penangung_jawab" id="penangung_jawab" /> Asuransi <input type="text"
                        value="{{ $status_ekonomi ? $status_ekonomi->asuransi : '' }}" name=""
                        id="asuransi" /> &nbsp; &nbsp; Tanggungan
                    : <input type="" value="{{ $status_ekonomi ? $status_ekonomi->tanggungan : '' }}"
                        name="" id="tanggungan" />
                </td>
            </tr>
            <tr>
                <td colspan="4" class="title-section"> XI. RIWAYAT PSIKISOSIAL DAN SPIRITUAL </td>
            </tr>
            <tr>
                <td colspan="4">
                    @php
                        $psikisosial = $data ? json_decode($data->riwayat_psikisosial) : null;
                    @endphp
                    <input type="hidden" name="riwayat_psikososial">
                    <div style="display: flex;">
                        <div style="min-width: 10%;">
                            <label>Tinggal Bersama </label>
                        </div>
                        <div class="ml-2"> :
                            @foreach (['keluarga', 'orang tua', 'anak', 'mertua', 'teman', 'sendiri', 'Panti Jompo'] as $item)
                                <input type="radio" value="{{ $item }}" name="tinggal_bersama"
                                    {{ $psikisosial ? ($psikisosial->tinggal_bersama == $item ? 'checked' : '') : ($item == 'keluarga' ? 'checked' : '') }}
                                    id="tinggal_bersama" /> {{ $item }} &nbsp; &nbsp;
                            @endforeach
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div style="display: flex;">
                        <div style="padding-top:3px; min-width: 10%;">
                            <label>Pekerjaan </label>
                        </div>
                        <div class="ml-2"> :
                            @foreach (['wiraswasta', 'pegawai', 'tidak bekerja', 'pensiun'] as $item)
                                <input type="radio" value="{{ $item }}" name="pekerjaan"
                                    {{ $psikisosial ? ($psikisosial->pekerjaan == $item ? 'checked' : '') : '' }}
                                    id="pekerjaan" />
                                {{ $item }} &nbsp; &nbsp;
                            @endforeach
                            <input type="radio" value="Lainnya" name="pekerjaan" id="pekerjaan"
                                {{ $psikisosial ? ($psikisosial->pekerjaan == 'Lainnya' ? 'checked' : '') : 'checked' }} />
                            Lainnya :
                            <input type="text" value="{{ $psikisosial ? $psikisosial->pekerjaan_lain : '' }}"
                                name="pekerjaan" id="pekerjaan_lain" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top: 5px;">
                    Keluarga Terdekat : <input type="text"
                        value="{{ $psikisosial ? $psikisosial->keluarga_terdekat : '' }}" name="keluarga_terdekat"
                        id="keluarga_terdekat" /> &nbsp;
                    Hubungan : <input type="text" value="{{ $psikisosial ? $psikisosial->hubungan : '' }}" id="hubungan_riwayat_psiko" /> &nbsp;
                    Telepon : <input type="number" value="{{ $psikisosial ? $psikisosial->telepon : '' }}"
                        name="telepon" id="telepon_riwayat_psiko" />
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div style="display: flex;">
                        <div style="padding-top:3px; min-width: 10%;">
                            <label>Status Emosional </label>
                        </div>
                        <div class="ml-2"> :
                            @foreach (['kooperatif', 'cemas', 'depresi', 'ingin mengakhiri hidup'] as $item)
                                <input type="radio" value="{{ $item }}" name="status_emosional"
                                    {{ $psikisosial ? ($psikisosial->status_emosional == $item ? 'checked' : '') : '' }}
                                    id="status_emosional" /> {{ $item }} &nbsp; &nbsp;
                            @endforeach
                            <input type="radio" value="Lainya" name="status_emosional" id=""
                                {{ $psikisosial ? ($psikisosial->status_emosional == 'Lainya' ? 'checked' : '') : 'checked' }} />
                            Lainya : <input type="text"
                                value="{{ $psikisosial ? $psikisosial->status_emosional_lain : '' }}"
                                name="status_emosional" id="status_emosional_lain" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div style="display: flex;">
                        <div style="padding-top:3px; min-width: 10%;">
                            <label>Status Mental </label>
                        </div>
                        <div class="ml-2"> :
                            @foreach (['kooperatif', 'tidak kooperatif', 'gelisah atau delirium dan berontak', 'ketidak mampuan dalam mengikuri perintah untuk tidak meninggalkan RS '] as $item)
                                <input type="radio" value="{{ $item }}" name="status_mental"
                                    {{ $psikisosial ? ($psikisosial->status_mental == $item ? 'checked' : '') : ($item == 'kooperatif' ? 'checked' : '') }}
                                    id="" /> {{ $item }} &nbsp; &nbsp;
                            @endforeach
                            <input type="radio" value="Lainnya" name="status_mental" id=""
                                {{ $psikisosial ? ($psikisosial->status_mental == 'Lainnya' ? 'checked' : '') : '' }} />
                            Lainnya :
                            <input type="text"
                                value="{{ $psikisosial ? $psikisosial->status_mental_lain : '' }}"
                                name="status_mental" id="status_mental_lain" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div style="display: flex;">
                        <div style="padding-top:3px; min-width: 10%;">
                            <label>Restrain </label>
                        </div>
                        <div class="ml-2"> :
                            <input type="radio" value="Tidak"
                                {{ $psikisosial ? ($psikisosial->restrain == 'Tidak' ? 'checked' : '') : 'checked' }}
                                name="restrain" id="" /> Tidak
                            &nbsp;
                            <input type="radio" value="Ya"
                                {{ $psikisosial ? ($psikisosial->restrain == 'Ya' ? 'checked' : '') : '' }}
                                name="restrain" id="" /> Ya
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4"> Curiga Penganiayaan/penelantaran : <input type="radio" value="Ya"
                        {{ $psikisosial ? ($psikisosial->curiga == 'Ya' ? 'checked' : '') : '' }} name="curiga"
                        id="curiga" /> Ya &nbsp; <input type="radio" value="Tidak"
                        {{ $psikisosial ? ($psikisosial->curiga == 'Tidak' ? 'checked' : '') : 'checked' }} name="curiga"
                        id="" /> Tidak </td>
            </tr>
            <tr>
                <td colspan="4"> Hubungan pasien dengan anggota keluarga : <input type="radio" value="Baik"
                        {{ $psikisosial ? ($psikisosial->hubungan_pasien == 'Baik' ? 'checked' : '') : 'checked' }}
                        name="hubungan_pasien" id="" /> Baik &nbsp; <input type="radio"
                        {{ $psikisosial ? ($psikisosial->hubungan_pasien == 'Tidak Baik' ? 'checked' : '') : '' }}
                        value="Tidak Baik" name="hubungan_pasien" id="" /> Tidak Baik </td>
            </tr>
            <tr>
                <td colspan="4"> Spiritual, perlu dibantu dalam ibadah : <input type="radio" value="Tidak"
                        {{ $psikisosial ? ($psikisosial->spiritual == 'Tidak' ? 'checked' : '') : 'checked' }}
                        name="spiritual" id="" /> Tidak &nbsp; <input type="radio" value="Ya"
                        {{ $psikisosial ? ($psikisosial->spiritual == 'Ya' ? 'checked' : '') : '' }}
                        name="spiritual" id="" /> Ya, Sebutkan &nbsp; <input type="text"
                        value="{{ $psikisosial ? $psikisosial->spiritual_input : '' }}" name=""
                        id="spiritual_input" /> </td>
            </tr>
            <tr>
                <td colspan="3" class="title-section">XII. POLA AKTIVITAS DAN ISTIRAHAT</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white;">
                    @php
                        $pola_aktivitas = $data ? json_decode($data->pola_aktivitas) : null;
                    @endphp
                    <input type="hidden" name="pola_aktivitas">
                    Istirahat/Tidur
                </td>
                <td colspan="3">:
                    <input type="checkbox"
                        {{ $pola_aktivitas ? ($pola_aktivitas->istirahat->tak ? 'checked' : '') : 'checked' }}
                        value="" name="" id="tak_pola_aktivitas" /> t.a.k &nbsp;
                    <input type="checkbox"
                        {{ $pola_aktivitas ? ($pola_aktivitas->istirahat->insomnia ? 'checked' : '') : '' }}
                        value="" name="" id="insomnia_pola_aktivitas" />
                    Insomnia &nbsp; <input type="checkbox"
                        {{ $pola_aktivitas ? ($pola_aktivitas->istirahat->lain_lain ? 'checked' : '') : '' }}
                        value="" name="" id="lain_lain_pola_aktivitas" /> Lain-Lain <input
                        type="" value="{{ $pola_aktivitas ? $pola_aktivitas->istirahat->lain_input : '' }}"
                        name="" id="lain_input_pola_aktivitas" />
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white;">
                    Penggunaan Obat Tidur
                </td>
                <td colspan="3">:
                    <input type="radio"
                        {{ $pola_aktivitas ? ($pola_aktivitas->penggunaan_obat_tidur == 'Ya' ? 'checked' : '') : '' }}
                        value="Ya" name="obat_tidur" id="" /> Ya &nbsp;
                    <input type="radio"
                        {{ $pola_aktivitas ? ($pola_aktivitas->penggunaan_obat_tidur == 'Tidak' ? 'checked' : '') : 'checked' }}
                        value="Tidak" name="obat_tidur" id="" /> Tidak &nbsp;
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white;">
                    Olahraga
                </td>
                <td colspan="3">:
                    <input type="radio"
                        {{ $pola_aktivitas ? ($pola_aktivitas->olahraga->value == 'Tidak' ? 'checked' : '') : 'checked' }}
                        value="Tidak" name="olahraga" id="" /> Tidak &nbsp;
                    <input type="radio"
                        {{ $pola_aktivitas ? ($pola_aktivitas->olahraga->value == 'Ya' ? 'checked' : '') : '' }}
                        value="Ya" name="olahraga" id="" /> Ya, jenis <input type="text"
                        value="{{ $pola_aktivitas ? $pola_aktivitas->olahraga->jenis : '' }}" name=""
                        id="jenis_olahraga" /> &nbsp; Frekuensi :
                    <input type="text"
                        value="{{ $pola_aktivitas ? $pola_aktivitas->olahraga->frekuensi : '' }}" name=""
                        id="frekuensi_olahraga" /> x/minggu
                </td>
            </tr>
            <tr>
                <td class="title-section" colspan="4">
                    XIII. POLA KEBIASAAN SEHARI-HARI
                    <input type="hidden" name="pola_kebiasaan">
                    @php
                        $kebiasaan = $data ? json_decode($data->pola_kebiasaan) : null;
                    @endphp
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white;">Merokok</td>
                <td colspan="3">: <input type="radio"
                        {{ $kebiasaan ? ($kebiasaan->merokok->value == 'Tidak' ? 'checked' : '') : 'checked' }}
                        value="Tidak" name="merokok" id="merokok_tidak" />
                    Tidak
                    &nbsp; <input type="radio"
                        {{ $kebiasaan ? ($kebiasaan->merokok->value == 'Ya' ? 'checked' : '') : '' }} value="Ya"
                        name="merokok" id="merokok_ya" />
                    Ya
                    <input type="text" value="{{ $kebiasaan ? $kebiasaan->merokok->jumlah : '' }}"
                        name="" id="jumlah_rokok" />
                    Batang/bungkus/hari, selama
                    <input type="" value="{{ $kebiasaan ? $kebiasaan->merokok->selama : '' }}"
                        name="" id="merokok_selama" /> th
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white;">Kopi</td>
                <td colspan="3">: <input type="radio"
                        {{ $kebiasaan ? ($kebiasaan->kopi->value == 'Tidak' ? 'checked' : '') : 'checked' }} value="Tidak"
                        name="kopi" id="kopi_tidak" />
                    Tidak
                    &nbsp; <input type="radio"
                        {{ $kebiasaan ? ($kebiasaan->kopi->value == 'Ya' ? 'checked' : '') : '' }} value="Ya"
                        name="kopi" id="kopi_ya" /> Ya
                    <input type="text" value="{{ $kebiasaan ? $kebiasaan->kopi->jumlah : '' }}"
                        name="" id="jumlah_kopi" /> Gelas/Hari
                </td>
            </tr>
            <tr>
                <td class="title-section " colspan="4">
                    XIV. KETERGANTUNGAN TERHADAP ZAT / OBAT TERTENTU
                    <input type="hidden" name="ketergantungan_zat">

                    @php
                        $zat = $data ? json_decode($data->ketergantungan_zat) : null;
                    @endphp
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white">Alkohol </td>
                <td colspan="3"> :
                    <input type="radio" name="alkohol"
                        {{ $zat ? ($zat->alkohol->value == 'Tidak' ? 'checked' : '') : 'checked' }} value="Tidak"
                        id="alkohol_tidak" />
                    Tidak
                    &nbsp; <input type="radio" name="alkohol"
                        {{ $zat ? ($zat->alkohol->value == 'Ya' ? 'checked' : '') : '' }} value="Ya"
                        id="alkohol_ya" />
                    Ya,
                    <input type="text" value="{{ $zat ? $zat->alkohol->jumlah : '' }}" name=""
                        id="jumlah_alkohol" /> Gelas /
                    Hari
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white;"> Obat - obatan</td>
                <td colspan="3"> :
                    <input type="radio" name="ketergantungan_obat"
                        {{ $zat ? ($zat->obat_obatan->value == 'Tidak' ? 'checked' : '') : 'checked' }} value="Tidak"
                        id="obat_tidak" /> Tidak
                    &nbsp;
                    <input type="radio" name="ketergantungan_obat"
                        {{ $zat ? ($zat->obat_obatan->value == 'Ya' ? 'checked' : '') : '' }} value="Ya"
                        id="obat_ya" /> Ya, Jenis
                    :
                    <input type="checkbox" value=""
                        {{ $zat ? ($zat->obat_obatan->jenis->metadon ? 'checked' : '') : '' }} name=""
                        id="obat_metadon" />
                    Metadon
                    &nbsp;
                    <input type="checkbox" value=""
                        {{ $zat ? ($zat->obat_obatan->jenis->kokain ? 'checked' : '') : '' }} name=""
                        id="obat_kokain" /> Kokain
                    &nbsp;
                    <input type="checkbox" value=""
                        {{ $zat ? ($zat->obat_obatan->jenis->analgetik ? 'checked' : '') : '' }} name=""
                        id="obat_analgetik" /> Obat Lain
                    Analgetik &nbsp;
                    <input type="checkbox" value=""
                        {{ $zat ? ($zat->obat_obatan->jenis->heroin ? 'checked' : '') : '' }} name=""
                        id="obat_heroin" /> Heroin
                    &nbsp;
                    <input type="checkbox" value=""
                        {{ $zat ? ($zat->obat_obatan->jenis->amfetamin ? 'checked' : '') : '' }} name=""
                        id="obat_amfetamin" />
                    Amfetamin &nbsp;
                    <input type="checkbox" value=""
                        {{ $zat ? ($zat->obat_obatan->jenis->lain_lain ? 'checked' : '') : '' }} name=""
                        id="obat_lain_lain" />
                    Lain-lain : <input type="text"
                        value="{{ $zat ? $zat->obat_obatan->jenis->lain_input : '' }}" name=""
                        id="ketergantungan_obat_lain_input" />
                </td>
            </tr>
            <tr>
                <td class="title-section" colspan="2" style="border-right: 1px solid white;">XV. DATA PENUNJANG
                    (EKG, LAB, RADIOLOGI)</td>
                    <input type="hidden" name="data_penunjang">
                <td colspan="2" style="text-align: right; border-left:">
                    <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal"
                        data-target="#dataPenunjang">
                        Tambah
                    </button> -->
                </td>
            </tr>
            <div class="modal fade" id="dataPenunjang" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penunjang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form_data_penunjang">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Data Penunjang</label>
                                    <input class="form-control" type="text" value="" name="nama_obat"
                                        id="" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $data_penunjang = $data ? json_decode($data->data_penunjang) : null;
            ?>
            <tr>
                <td colspan="4"><input value="{{ $data_penunjang ? $data_penunjang[0] : '' }}" class="form-control" type="text" name="data_penunjang_a"></td>
            </tr>
            <tr>
                <td colspan="4"><input value="{{ $data_penunjang ? $data_penunjang[1] : '' }}" class="form-control" type="text" name="data_penunjang_b"></td>
            </tr>
            <tr>
                <td colspan="4" class="title-section">
                    XVI. ORIENTASI PADA PASIEN DAN KELUARGA
                    <input type="hidden" name="orientasi_pada_pasien">
                    @php
                        $orientasi = $data ? json_decode($data->orientasi_pada_pasien) : null;
                    @endphp
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    @foreach (['Ruang Kamar', 'Pengatur tempat tidur', 'Lemari', 'WC/Kamar Mandi', 'Pengaman Tempat Tidur', 'TV dan Remote control', 'Telepon', 'Sistem bel', 'Apotek'] as $key => $item)
                        <div class="form-check form-check-inline ml-2">
                            <input class="form-check-input" type="checkbox" value="{{ $item }}"
                                <?php
                                switch ($item) {
                                    case 'Ruang Kamar':
                                        echo $orientasi ? ($orientasi->ruang_kamar ? 'checked' : '') : 'checked';
                                        break;
                                    case 'Pengatur tempat tidur':
                                        echo $orientasi ? ($orientasi->pengatur_tempat_tidur ? 'checked' : '') : 'checked';
                                        break;
                                    case 'Lemari':
                                        echo $orientasi ? ($orientasi->lemari ? 'checked' : '') : 'checked';
                                        break;
                                    case 'WC/Kamar Mandi':
                                        echo $orientasi ? ($orientasi->kamar_mandi ? 'checked' : '') : 'checked';
                                        break;
                                    case 'Pengaman Tempat Tidur':
                                        echo $orientasi ? ($orientasi->pengaman_tempat_tidur ? 'checked' : '') : 'checked';
                                        break;
                                    case 'TV dan Remote control':
                                        echo $orientasi ? ($orientasi->tv ? 'checked' : '') : 'checked';
                                        break;
                                    case 'Telepon':
                                        echo $orientasi ? ($orientasi->telepon ? 'checked' : '') : 'checked';
                                        break;
                                    case 'Sistem bel':
                                        echo $orientasi ? ($orientasi->bel ? 'checked' : '') : 'checked';
                                        break;
                                    case 'Apotek':
                                        echo $orientasi ? ($orientasi->apotek ? 'checked' : '') : 'checked';
                                        break;
                                
                                    default:
                                        # code...
                                        break;
                                }
                                ?> id="orientasi_pasien_{{ $loop->iteration }}">
                            <label class="form-check-label"
                                for="orientasi_pasien_{{ $key }}">{{ $item }}</label>
                        </div>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="4" class="title-section">
                    XVII. INFORMASI PADA PASIEN DAN KELUARGA
                    <input type="hidden" name="informasi_pada_pasien">
                    @php
                        $informasi = $data ? json_decode($data->informasi_pada_pasien) : null;
                    @endphp
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    @foreach (['Perawat yang melakukan perawatan', 'Waktu dokter visit dan konsultasi', 'Jam berkunjung'] as $key => $item)
                        <div class="form-check form-check-inline ml-2">
                            <input class="form-check-input" type="checkbox" name="" <?php
                            switch ($item) {
                                case 'Perawat yang melakukan perawatan':
                                    echo $informasi ? ($informasi->perawat ? 'checked' : '') : 'checked';
                                    break;
                                case 'Waktu dokter visit dan konsultasi':
                                    echo $informasi ? ($informasi->waktu ? 'checked' : '') : 'checked';
                                    break;
                                case 'Jam berkunjung':
                                    echo $informasi ? ($informasi->jam ? 'checked' : '') : '';
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                            ?>
                                id="informasi_pasien_{{ $loop->iteration }}">
                            <label class="form-check-label"
                                for="informasi_pasien_{{ $key }}">{{ $item }}</label>
                        </div>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="4" class="title-section">
                    XVIII. PENGGUNAAN ALAT MEDIK
                    <input type="hidden" name="penggunaan_alat_mediks">
                    @php
                        $alat = $data ? json_decode($data->penggunaan_alat_medik) : null;
                    @endphp
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="radio" value="Tidak"
                        {{ $alat ? ($alat->value == 'Tidak' ? 'checked' : '') : '' }} name="penggunaan_alat_medik"
                        id="" /> Tidak
                    &nbsp;
                    <input type="radio" value="Ya"
                        {{ $alat ? ($alat->value == 'Ya' ? 'checked' : '') : 'checked' }} name="penggunaan_alat_medik"
                        id="" /> Ya:
                    &nbsp;
                    <input type="checkbox" value="" {{ $alat ? ($alat->infus ? 'checked' : '') : '' }}
                        name="" id="infus" /> Infus : Tanggal
                    pasang
                    <input type="date" value="{{ $alat ? $alat->tanggal_pasang_infus : '' }}" name=""
                        id="tanggal_pasang_infus" /> &nbsp;
                    &nbsp;
                    <input type="checkbox" value="" {{ $alat ? ($alat->kateter ? 'checked' : '') : '' }}
                        name="" id="kateter" /> Kateter : Tanggal
                    pasang <input type="date" value="{{ $alat ? $alat->tanggal_pasang_kateter : '' }}"
                        name="" id="tanggal_pasang_kateter" />
                    &nbsp;
                    &nbsp;
                    <input type="checkbox" value="" {{ $alat ? ($alat->ngt ? 'checked' : '') : '' }}
                        name="" id="ngt" /> NGT : Tanggal
                    pasang
                    <input type="date" value="{{ $alat ? $alat->tanggal_pasang_ngt : '' }}" name=""
                        id="tanggal_pasang_ngt" /> &nbsp; &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="4" class="title-section">
                    XIX. MASALAH KEPERAWATAN
                    <input type="hidden" name="masalah_keperawatan">
                    @php
                        $keperawatan = $data ? json_decode($data->masalah_keperawatan) : [];
                    @endphp
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    @php
                        $masalahKeperawatan = ['Ansietas', 'Bersih Jalan Nafas Tidak Efektif', 'Perubahan Nutrisi', 'Gangguan Perfusi Jaringan Cerebral', 'Risti Jatuh / Cedera', 'Hipertermi', 'Keterbatasan / Intoleransi Aktivitas', 'Infeksi', 'Defisit Perawatan Diri', 'Depresi', 'Gangguan Pertukaran Gas', 'Risti / Kerusakan Integritas Kulit', 'Risti/Kekurangan / Kelebihan Cairan', 'Kurang Pengetahuan', 'Penurunan Curah Jantung', 'Perubahan Eleminasi : Uri / Alvi', 'Nyeri', 'Resiko Pendarahan', 'Resiko Cedera Pada Janin'];
                    @endphp
                    @foreach ($masalahKeperawatan as $key => $item)
                        <div class="form-check form-check-inline ml-2">
                            <input class="form-check-input" type="checkbox" value="{{ $item }}"
                                name="" id="masalah_keperawatan_{{ $loop->iteration }}"
                                {{ $keperawatan ? ($keperawatan[$loop->iteration - 1] ? 'checked' : '') : '' }}>
                            <label class="form-check-label"
                                for="masalah_keperawatan_{{ $key }}">{{ $item }}</label>
                        </div> <br>
                    @endforeach
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="checkbox" value="" name=""
                            {{ $keperawatan ? ($keperawatan[19] ? 'checked' : '') : '' }}
                            id="masalah_keperawatan_lainnya">
                        <label class="form-check-label" for="masalah_keperawatan_lainnya">Lainnya : </label>
                    </div> <input type="text" value="{{ $keperawatan ? $keperawatan[20] : '' }}"
                        name="" id="masalah_keperawatan_lain_input" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table style="width: 100%;">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NAMA PERAWAT YANG MENGKAJI</th>
                            <th>TANGGAL</th>
                            <th>JAM</th>
                            <th>TANDA TANGAN</th>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <input type="text" readonly class="form-control" value="{{ Auth::user()->realname }}">
                            </td>
                            <td>
                                <input type="date" name="tanggal_pengkajian" value="{{ $data ? date('Y-m-d', strtotime($data->tanggal)) : date('Y-m-d') }}" class="form-control">
                            </td>
                            <td>
                                <input type="time" name="jam_pengkajian" value="{{ $data ? date('H:i', strtotime($data->jam)) : date('H:i') }}" class="form-control">
                            </td>
                            <td class="text-center">
                                @if($dokumen->status)
                                    <img style="width: 5cm; height:3cm;" src="{{ env('SMIS_UPLOAD').($employee ? $employee->ttd : '') }}" alt="">
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="col-lg-12 text-center pt-3">
            <button class="btn btn-success" type="submit">Verifikasi</button>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>
    let riwayat_alergi = null;
    let riwayat_penyakit_dahulu = null;
    let riwayat_imuno = [];
    let riwayat_penyakit_keluarga = null;
    let pernah_dirawat = null;
    let pernah_operasi = null;
    let skrining_nyeri = null;
    let ttv = null;
    let kepala = null;
    let rambut = null;
    let muka = null;
    let mata = null;
    let telinga = null;
    let hidung = null;
    let mulut = null;
    let gigi = null;
    let lidah = null;
    let tenggorokan = null;
    let leher = null;
    let dada = null;
    let abdomen = null;
    let genitalia_wanita = null;
    let genitallia_pria = null;
    let integumen = null;
    let kondisi = null;
    let balutan = null;
    let ekstremitas = null;
    let eliminasi = null;
    let resiko_cidera_jatuh = [];

    $('#form_dokumen').submit(function(e) {
        window.event.preventDefault();

        riwayat_alergi = {
            'tidak_ada': $('#riwayat_alergi').is(':checked') ? 1 : 0,
            'makanan': {
                'cek': $('#makanan_checkbox').is(':checked') ? 1 : 0,
                'value': $('#makanan').val()
            },
            'obat': {
                'cek': $('#obat_checkbox').is(':checked') ? 1 : 0,
                'value': $('#obat').val()
            },
        };

        $('[name=riwayat_alergi]').val(JSON.stringify(riwayat_alergi));

        riwayat_penyakit_dahulu = {
            'penyakit_jantung': $('#penyakit_jantung').is(':checked') ? 1 : 0,
            'diabetes': $('#diabetes').is(':checked') ? 1 : 0,
            'tb': $('#tb').is(':checked') ? 1 : 0,
            'ginjal': $('#ginjal').is(':checked') ? 1 : 0,
            'gangguan_jiwa': $('#gangguan_jiwa').is(':checked') ? 1 : 0,
            'kanker': $('#kanker').is(':checked') ? 1 : 0,
            'stroke': $('#stroke').is(':checked') ? 1 : 0,
            'asma': $('#asma').is(':checked') ? 1 : 0,
            'gangguan_hematologi': $('#gangguan_hematologi').is(':checked') ? 1 : 0,
            'hipertensi': $('#hipertensi').is(':checked') ? 1 : 0,
            'infark_miokard': $('#infark_miokard').is(':checked') ? 1 : 0,
            'hepatitis': $('#hepatitis').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_checkbox').is(':checked') ? 1 : 0,
            'lain': $('#riwayat_penyakit_input').val()
        };

        $('[name=riwayat_penyakit_dahulu]').val(JSON.stringify(riwayat_penyakit_dahulu));

        riwayat_imuno = [];

        if ($('#infeksi_telinga_baru').is(':checked')) {
            riwayat_imuno.push($('#infeksi_telinga_baru').val());
        }
        if ($('#infeksi_berat_sinus').is(':checked')) {
            riwayat_imuno.push($('#infeksi_berat_sinus').val());
        }
        if ($('#penggunaan_antibiotik').is(':checked')) {
            riwayat_imuno.push($('#penggunaan_antibiotik').val());
        }
        if ($('#pneumonia').is(':checked')) {
            riwayat_imuno.push($('#pneumonia').val());
        }
        if ($('#adanya_abses').is(':checked')) {
            riwayat_imuno.push($('#adanya_abses').val());
        }
        if ($('#adanya_sariawan').is(':checked')) {
            riwayat_imuno.push($('#adanya_sariawan').val());
        }
        if ($('#memerlukan_antibiotik').is(':checked')) {
            riwayat_imuno.push($('#memerlukan_antibiotik').val());
        }
        if ($('#terdapat_dua_infeksi').is(':checked')) {
            riwayat_imuno.push($('#terdapat_dua_infeksi').val());
        }
        if ($('#imunodefisiensi').is(':checked')) {
            riwayat_imuno.push($('#imunodefisiensi').val());
        }
        if ($('#antibiotika').is(':checked')) {
            riwayat_imuno.push($('#antibiotika').val());
        }
        if ($('#pemulihan_lambat').is(':checked')) {
            riwayat_imuno.push($('#pemulihan_lambat').val());
        }
        if ($('#adanya_kanker').is(':checked')) {
            riwayat_imuno.push($('#adanya_kanker').val());
        }
        if ($('#infeksi_oportunistik').is(':checked')) {
            riwayat_imuno.push($('#infeksi_oportunistik').val());
        }

        $('[name=riwayat_imuno]').val(JSON.stringify(riwayat_imuno));

        riwayat_penyakit_keluarga = {
            'penyakit_jantung': $('#penyakit_jantung_keluarga').is(':checked') ? 1 : 0,
            'diabetes': $('#diabetes_keluarga').is(':checked') ? 1 : 0,
            'tb': $('#tb_keluarga').is(':checked') ? 1 : 0,
            'ginjal': $('#ginjal_keluarga').is(':checked') ? 1 : 0,
            'gangguan_jiwa': $('#gangguan_jiwa_keluarga').is(':checked') ? 1 : 0,
            'kanker': $('#kanker_keluarga').is(':checked') ? 1 : 0,
            'stroke': $('#stroke_keluarga').is(':checked') ? 1 : 0,
            'asma': $('#asma_keluarga').is(':checked') ? 1 : 0,
            'gangguan_hematologi': $('#gangguan_hematologi_keluarga').is(':checked') ? 1 : 0,
            'hipertensi': $('#hipertensi_keluarga').is(':checked') ? 1 : 0,
            'infark_miokard': $('#infark_miokard_keluarga').is(':checked') ? 1 : 0,
            'hepatitis': $('#hepatitis_keluarga').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_keluarga_checkbox').is(':checked') ? 1 : 0,
            'lain': $('#riwayat_penyakit_keluarga_input').val()
        };

        $('[name=riwayat_penyakit_keluarga]').val(JSON.stringify(riwayat_penyakit_keluarga));

        pernah_dirawat = {
            'pernah': $('[name=pernah_di_rawat]:checked').val() != undefined ? $('[name=pernah_di_rawat]:checked').val() : '',
            'kapan': $('#rawat_kapan').val(),
            'dimana': $('#rawat_dimana').val(),
            'sakit': $('#rawat_sakit_apa').val(),
        };

        $('[name=pernah_di_rawats]').val(JSON.stringify(pernah_dirawat));

        pernah_operasi = {
            'pernah': $('[name=pernah_di_operasi]:checked').val() != undefined ? $('[name=pernah_di_operasi]:checked').val() : '',
            'kapan': $('#operasi_kapan').val(),
            'dimana': $('#operasi_dimana').val(),
            'operasi': $('#operasi_sakit_apa').val(),
        };

        $('[name=pernah_di_operasis]').val(JSON.stringify(pernah_operasi));

        skrining_nyeri = {
            'nyeri': $('[name=nyeri]:checked').val() != undefined ? $('[name=nyeri]:checked').val() : '',
            'jenis': $('[name=jenis]:checked').val() != undefined ? $('[name=jenis]:checked').val() : '',
            'intensitas': $('#intensitas').val(),
        };

        $('[name=skrining_nyeri]').val(JSON.stringify(skrining_nyeri));

        let temp_kesadaran = [];

        if ($('#cm').is(':checked')) {
            temp_kesadaran.push($('#cm').val());
        }
        if ($('#apatis').is(':checked')) {
            temp_kesadaran.push($('#apatis').val());
        }
        if ($('#somnolent').is(':checked')) {
            temp_kesadaran.push($('#somnolent').val());
        }
        if ($('#soporus').is(':checked')) {
            temp_kesadaran.push($('#soporus').val());
        }
        if ($('#koma').is(':checked')) {
            temp_kesadaran.push($('#koma').val());
        }

        ttv = {
            'tensi': $('#td').val(),
            'suhu': $('#suhu').val(),
            'nadi': $('#n').val(),
            'rr': $('#p').val(),
            'kesadaran': temp_kesadaran,
        }

        $('[name=ttv]').val(JSON.stringify(ttv));

        let temp_mata = [];
        let temp_verbal = [];
        let temp_motorik = [];

        if ($('#terbuka_spontan').is(':checked')) {
            temp_mata.push($('#terbuka_spontan').val());
        }
        if ($('#terbuka_dipanggil').is(':checked')) {
            temp_mata.push($('#terbuka_dipanggil').val());
        }
        if ($('#terbuka_rangsang_nyeri').is(':checked')) {
            temp_mata.push($('#terbuka_rangsang_nyeri').val());
        }
        if ($('#tidak_merespon_mata').is(':checked')) {
            temp_mata.push($('#tidak_merespon_mata').val());
        }

        if ($('#orientasi_baik').is(':checked')) {
            temp_verbal.push($('#orientasi_baik').val());
        }
        if ($('#disorientasi').is(':checked')) {
            temp_verbal.push($('#disorientasi').val());
        }
        if ($('#jawaban_tidak_sesuai').is(':checked')) {
            temp_verbal.push($('#jawaban_tidak_sesuai').val());
        }
        if ($('#suara_tidak_dimengerti').is(':checked')) {
            temp_verbal.push($('#suara_tidak_dimengerti').val());
        }
        if ($('#tidak_merespon_verbal').is(':checked')) {
            temp_verbal.push($('#tidak_merespon_verbal').val());
        }

        if ($('#mengikuti_perintah').is(':checked')) {
            temp_motorik.push($('#mengikuti_perintah').val());
        }
        if ($('#melokalisasi_nyeri').is(':checked')) {
            temp_motorik.push($('#melokalisasi_nyeri').val());
        }
        if ($('#menarik_diri').is(':checked')) {
            temp_motorik.push($('#menarik_diri').val());
        }
        if ($('#fleksi_abnormal').is(':checked')) {
            temp_motorik.push($('#fleksi_abnormal').val());
        }
        if ($('#ektensi_abnormal').is(':checked')) {
            temp_motorik.push($('#ektensi_abnormal').val());
        }
        if ($('#tidak_merespon_motorik').is(':checked')) {
            temp_motorik.push($('#tidak_merespon_motorik').val());
        }

        glasglow_coma = {
            'mata': temp_mata,
            'verbal': temp_verbal,
            'motorik': temp_motorik
        };

        $('[name=glasglow_coma]').val(JSON.stringify(glasglow_coma));

        kepala = {
            'tak': $('#tak_kepala').is(':checked') ? 1 : 0,
            'asimetris': $('#asimetris_kepala').is(':checked') ? 1 : 0,
            'haematom': $('#haematom_kepala').is(':checked') ? 1 : 0,
            'haematom_lokasi': $('#haematom_lokasi_kepala').val(),
            'lesi': $('#lesi_kepala').is(':checked') ? 1 : 0,
            'lesi_lokasi': $('#lesi_lokasi_kepala').val(),
        };

        $('[name=kepalas]').val(JSON.stringify(kepala));

        rambut = {
            'tak': $('#tak_rambut').is(':checked') ? 1 : 0,
            'kotor': $('#kotor_rambut').is(':checked') ? 1 : 0,
            'berminyak': $('#berminyak_rambut').is(':checked') ? 1 : 0,
            'kering': $('#kering_rambut').is(':checked') ? 1 : 0,
            'rontok': $('#rontok_rambut').is(':checked') ? 1 : 0,
        };

        $('[name=rambuts]').val(JSON.stringify(rambut));

        muka = {
            'tak': $('#tak_muka').is(':checked') ? 1 : 0,
            'asimetris': $('#asimetris_muka').is(':checked') ? 1 : 0,
        };

        $('[name=mukas]').val(JSON.stringify(muka));

        mata = {
            'tak': $('#tak_mata').is(':checked') ? 1 : 0,
            'gangguan_penglihatan': $('#gangguan_penglihatan_mata').is(':checked') ? 1 : 0,
            'seklera_ikterik': $('#seklera_ikterik_mata').is(':checked') ? 1 : 0,
            'konjungtiva_anemis': $('#konjungtiva_anemis_mata').is(':checked') ? 1 : 0,
            'pupil': $('#pupil_mata').is(':checked') ? 1 : 0,
            'pupil_input': $('#pupil_input_mata').val(),
            'isokor': $('#isokor_mata').is(':checked') ? 1 : 0,
            'anisokor': $('#anisokor_mata').is(':checked') ? 1 : 0,
            'midriasis': $('#midriasis_mata').is(':checked') ? 1 : 0,
            'miosis': $('#miosis_mata').is(':checked') ? 1 : 0,
            'reflexy_cahaya': $('#reflexy_cahaya_mata').is(':checked') ? 1 : 0,
            'positif': $('#positif_mata').is(':checked') ? 1 : 0,
            'negatif': $('#negatif_mata').is(':checked') ? 1 : 0,
        };

        $('[name=matas]').val(JSON.stringify(mata));

        telinga = {
            'tak': $('#tak_telinga').is(':checked') ? 1 : 0,
            'berdengung': $('#berdengung_telinga').is(':checked') ? 1 : 0,
            'penurunan_pendengaran': $('#penurunan_pendengaran_telinga').is(':checked') ? 1 : 0,
            'keluar_cairan': $('#keluar_cairan_telinga').is(':checked') ? 1 : 0,
            'serumen': $('#serumen_telinga').is(':checked') ? 1 : 0,
            'nyeri': $('#nyeri_telinga').is(':checked') ? 1 : 0,
            'alat_dengar': $('#alat_dengar_telinga').is(':checked') ? 1 : 0,
        };

        $('[name=telingas]').val(JSON.stringify(telinga));

        hidung = {
            'tak': $('#tak_hidung').is(':checked') ? 1 : 0,
            'asimetris': $('#asimetris_hidung').is(':checked') ? 1 : 0,
            'epistaksis': $('#epistaksis_hidung').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_hidung').is(':checked') ? 1 : 0,
            'hidung_input': $('#hidung_input_hidung').val(),
        };

        $('[name=hidungs]').val(JSON.stringify(hidung));

        mulut = {
            'simetris': $('#simetris_mulut').is(':checked') ? 1 : 0,
            'asimetris': $('#asimetris_mulut').is(':checked') ? 1 : 0,
            'pucat': $('#pucat_mulut').is(':checked') ? 1 : 0,
            'sianosis': $('#sianosis_mulut').is(':checked') ? 1 : 0,
        };

        $('[name=muluts]').val(JSON.stringify(mulut));

        gigi = {
            'tak': $('#tak_gigi').is(':checked') ? 1 : 0,
            'karies': $('#karies_gigi').is(':checked') ? 1 : 0,
            'goyang': $('#goyang_gigi').is(':checked') ? 1 : 0,
            'tambal': $('#tambal_gigi').is(':checked') ? 1 : 0,
            'gigi_palsu': $('#gigi_palsu_gigi').is(':checked') ? 1 : 0,
            'geraham_asimetris': $('#geraham_asimetris_gigi').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_gigi').is(':checked') ? 1 : 0,
            'lain_lain_input': $('#lain_lain_input_gigi').val(),
        };

        $('[name=gigis]').val(JSON.stringify(gigi));

        lidah = {
            'tak': $('#tak_lidah').is(':checked') ? 1 : 0,
            'kotor': $('#kotor_lidah').is(':checked') ? 1 : 0,
            'mukosa_kering': $('#mukosa_kering_lidah').is(':checked') ? 1 : 0,
            'asimetris': $('#asimetris_lidah').is(':checked') ? 1 : 0,
        };

        $('[name=lidahs]').val(JSON.stringify(lidah));

        tenggorokan = {
            'tak': $('#tak_tenggorokan').is(':checked') ? 1 : 0,
            'faring_merah': $('#faring_merah_tenggorokan').is(':checked') ? 1 : 0,
            'sakit_menelan': $('#sakit_menelan_tenggorokan').is(':checked') ? 1 : 0,
            'tonsil_membesar': $('#tonsil_membesar_tenggorokan').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_tenggorokan').is(':checked') ? 1 : 0,
            'lain_lain_input': $('#lain_lain_input_tenggorokan').val(),
        };

        $('[name=tenggorokans]').val(JSON.stringify(tenggorokan));

        leher = {
            'tak': $('#tak_leher').is(':checked') ? 1 : 0,
            'pemesaran_tiroid': $('#pemesaran_tiroid_leher').is(':checked') ? 1 : 0,
            'bendungan_vena': $('#bendungan_vena_leher').is(':checked') ? 1 : 0,
            'kaku_kuduk': $('#kaku_kuduk_leher').is(':checked') ? 1 : 0,
            'keterbatasan_gerak': $('#keterbatasan_gerak_leher').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_leher').is(':checked') ? 1 : 0,
            'lain_lain_input': $('#lain_lain_input_leher').val(),
        };

        $('[name=lehers]').val(JSON.stringify(leher));

        dada = {
            'tak': $('#tak_dada').is(':checked') ? 1 : 0,
            'asimetris': $('#asimetris_dada').is(':checked') ? 1 : 0,
            'retraksi': $('#retraksi_dada').is(':checked') ? 1 : 0,
            'ronchi': $('#ronchi_dada').is(':checked') ? 1 : 0,
            'rales': $('#rales_dada').is(':checked') ? 1 : 0,
            'wheezing': $('#wheezing_dada').is(':checked') ? 1 : 0,
            'murmur': $('#murmur_dada').is(':checked') ? 1 : 0,
            'takikardia': $('#takikardia_dada').is(':checked') ? 1 : 0,
            'bradikardi': $('#bradikardi_dada').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_dada').is(':checked') ? 1 : 0,
            'lain_lain_input': $('#lain_lain_input_dada').val(),
        };

        $('[name=dadas]').val(JSON.stringify(dada));

        abdomen = {
            'tak': $('#tak_abdomen').is(':checked') ? 1 : 0,
            'kembung': $('#kembung_abdomen').is(':checked') ? 1 : 0,
            'ascites': $('#ascites_abdomen').is(':checked') ? 1 : 0,
            'benjolan': $('#benjolan_abdomen').is(':checked') ? 1 : 0,
            'lokasi_benjolan': $('#lokasi_benjolan_abdomen').val(),
            'nyeri': $('#nyeri_abdomen').is(':checked') ? 1 : 0,
            'lokasi_nyeri': $('#lokasi_nyeri_abdomen').val(),
            'bising': $('#bising_abdomen').is(':checked') ? 1 : 0,
            'lokasi_bising': $('#lokasi_bising_abdomen').val(),
        };

        $('[name=abdomens]').val(JSON.stringify(abdomen));

        genitalia_wanita = {
            'tak': $('#tak_gen_wanita').is(':checked') ? 1 : 0,
            'sekret': $('#sekret_gen_wanita').is(':checked') ? 1 : 0,
            'sekret_input': $('#sekret_input_gen_wanita').val(),
            'prollaps': $('#prollaps_gen_wanita').is(':checked') ? 1 : 0,
            'fistula': $('#fistula_gen_wanita').is(':checked') ? 1 : 0,
            'haemoroid': $('#haemoroid_gen_wanita').is(':checked') ? 1 : 0,
            'hamil_ya': $('#hamil_ya_gen_wanita').is(':checked') ? 1 : 0,
            'hamil_tidak': $('#hamil_tidak_gen_wanita').is(':checked') ? 1 : 0,
            'menstruasi_terakhir': $('#menstruasi_terakhir_gen_wanita').is(':checked') ? 1 : 0,
            'menstruasi_trakhir_input': $('#menstruasi_trakhir_input_gen_wanita').val(),
            'keluhan_menstruasi': $('#keluhan_menstruasi_gen_wanita').is(':checked') ? 1 : 0,
            'keluhan_menstruasi_tidak': $('#keluhan_menstruasi_tidak_gen_wanita').is(':checked') ? 1 : 0,
            'keluhan_menstruasi_ya': $('#keluhan_menstruasi_ya_gen_wanita').is(':checked') ? 1 : 0,
            'keluhan_menstruasi_input': $('#keluhan_menstruasi_input_gen_wanita').val(),
        };

        $('[name=genitalia_wanitas]').val(JSON.stringify(genitalia_wanita));

        genitalia_pria = {
            'tak': $('#tak_gen_pria').is(':checked') ? 1 : 0,
            'phimosis': $('#phimosis_gen_pria').is(':checked') ? 1 : 0,
            'hernia': $('#hernia_gen_pria').is(':checked') ? 1 : 0,
            'haemoroid': $('#haemoroid_gen_pria').is(':checked') ? 1 : 0,
            'orchitis': $('#orchitis_gen_pria').is(':checked') ? 1 : 0,
            'sekret': $('#sekret_gen_pria').is(':checked') ? 1 : 0,
            'sekret_pria': $('#sekret_pria_gen_pria').val(),
        };

        $('[name=genitalia_prias]').val(JSON.stringify(genitalia_pria));

        integumen = {
            'tak': $('#tak_integumen').is(':checked') ? 1 : 0,
            'turgor_jelek': $('#turgor_jelek_integumen').is(':checked') ? 1 : 0,
            'dingin': $('#dingin_integumen').is(':checked') ? 1 : 0,
            'bullac': $('#bullac_integumen').is(':checked') ? 1 : 0,
            'fistula': $('#fistula_integumen').is(':checked') ? 1 : 0,
            'ikterik': $('#ikterik_integumen').is(':checked') ? 1 : 0,
            'diaforesi': $('#diaforesi_integumen').is(':checked') ? 1 : 0,
            'pucat': $('#pucat_integumen').is(':checked') ? 1 : 0,
            'dekubitus': $('#dekubitus_integumen').is(':checked') ? 1 : 0,
            'derajat_dekubitus': $('#derajat_dekubitus_integumen').val(),
            'lokasi_dekubitus': $('#lokasi_dekubitus_integumen').val(),
            'luka_tidak_ada': $('#luka_tidak_ada_integumen').is(':checked') ? 1 : 0,
            'luka_ada': $('#luka_ada_integumen').is(':checked') ? 1 : 0,
            'input_luka': $('#input_luka_integumen').val(),
        };

        $('[name=integumens]').val(JSON.stringify(integumen));

        kondisi = {
            'bersih': $('#bersih_kondisi').is(':checked') ? 1 : 0,
            'kotor': $('#kotor_kondisi').is(':checked') ? 1 : 0,
            'jahitan_luka_ada': $('#jahitan_luka_ada_kondisi').is(':checked') ? 1 : 0,
            'jahitan_luka_tidak_ada': $('#jahitan_luka_tidak_ada_kondisi').is(':checked') ? 1 : 0,
        };

        $('[name=kondisi]').val(JSON.stringify(kondisi));

        balutan = {
            'bersih': $('#bersih_balutan').is(':checked') ? 1 : 0,
            'kotor': $('#kotor_balutan').is(':checked') ? 1 : 0,
        };

        $('[name=balutan]').val(JSON.stringify(balutan));

        ekstremitas = {
            'tak': $('#tak_ekstremitas').is(':checked') ? 1 : 0,
            'kelemahan_otot': $('#kelemahan_otot_ekstremitas').is(':checked') ? 1 : 0,
            'kejang': $('#kejang_ekstremitas').is(':checked') ? 1 : 0,
            'tremor': $('#tremor_ekstremitas').is(':checked') ? 1 : 0,
            'plegi': $('#plegi_ekstremitas').is(':checked') ? 1 : 0,
            'plegi_di': $('#plegi_di_ekstremitas').val(),
            'paraese': $('#paraese_ekstremitas').is(':checked') ? 1 : 0,
            'paraese_di': $('#paraese_di_ekstremitas').val(),
            'inkordinasi': $('#inkordinasi_ekstremitas').is(':checked') ? 1 : 0,
            'kelainan_kongenital': $('#kelainan_kongenital_ekstremitas').is(':checked') ? 1 : 0,
            'deformitas': $('#deformitas_ekstremitas').is(':checked') ? 1 : 0,
            'fraktur': $('#fraktur_ekstremitas').is(':checked') ? 1 : 0,
            'lokasi_fraktur': $('#lokasi_fraktur_ekstremitas').val(),
            'lain_lain': $('#lain_lain_ekstremitas').is(':checked') ? 1 : 0,
            'input_lain': $('#input_lain_ekstremitas').val(),
        };

        $('[name=ekstremitass]').val(JSON.stringify(ekstremitas));

        eliminasi = {
            'tak': $('#tak_eliminasi').is(':checked') ? 1 : 0,
            'diare': $('#diare_eliminasi').is(':checked') ? 1 : 0,
            'konstipasi': $('#konstipasi_eliminasi').is(':checked') ? 1 : 0,
            'inkontinetia': $('#inkontinetia_eliminasi').is(':checked') ? 1 : 0,
            'colostomi': $('#colostomi_eliminasi').is(':checked') ? 1 : 0,
            'restensi': $('#restensi_eliminasi').is(':checked') ? 1 : 0,
            'hematuri': $('#hematuri_eliminasi').is(':checked') ? 1 : 0,
            'anuri': $('#anuri_eliminasi').is(':checked') ? 1 : 0,
            'kandung_kemih': $('#kandung_kemih_eliminasi').is(':checked') ? 1 : 0,
            'penuh': $('#penuh_eliminasi').is(':checked') ? 1 : 0,
            'kosong': $('#kosong_eliminasi').is(':checked') ? 1 : 0,
            'lain_lain': $('#lain_lain_eliminasi').is(':checked') ? 1 : 0,
            'input_lain': $('#input_lain_eliminasi').val(),
        };

        $('[name=eliminasi]').val(JSON.stringify(eliminasi));

        resiko_cidera_jatuh = [
            $('#resiko_cidera_1').val(),
            $('#resiko_cidera_2').val(),
            $('#resiko_cidera_3').val(),
            $('#resiko_cidera_4').val(),
            $('#resiko_cidera_5').val(),
            $('#resiko_cidera_6').val(),
            $('#resiko_cidera_7').val(),
            $('#resiko_cidera_8').val(),
            $('#resiko_cidera_9').val(),
            $('#resiko_cidera_10').val(),
            $('#resiko_cidera_11').val(),
        ];

        $('[name=resiko_cidera_jatuh]').val(JSON.stringify(resiko_cidera_jatuh));

        tindakan_resiko_jatuh = {
            'pasang_pin_kuning': $('#pasang_pin_kuning').is(':checked') ? 1 : 0,
            'pencegahan_jatuh': $('#pencegahan_jatuh').is(':checked') ? 1 : 0,
        };

        $('[name=tindakan_resiko_jatuh]').val(JSON.stringify(tindakan_resiko_jatuh));

        resiko_cidera_dekubitus = {
            'kondisi_fisik': $('[name=kondisi_fisik]:checked').val() != undefined ? $(
                '[name=kondisi_fisik]:checked').val() : '',
            'mobilitas': $('[name=mobilitas]:checked').val() != undefined ? $('[name=mobilitas]:checked')
                .val() : '',
            'aktivitas': $('[name=aktivitas]:checked').val() != undefined ? $('[name=aktivitas]:checked')
                .val() : '',
            'empty': $('[name=empty]:checked').val() != undefined ? $('[name=empty]:checked').val() : '',
            'inkontinesia': $('[name=inkontinesia]:checked').val() != undefined ? $(
                '[name=inkontinesia]:checked').val() : '',
        };

        $('[name=resiko_dekubitus]').val(JSON.stringify(resiko_cidera_dekubitus));

        nutrisi = {
            'penurunan_bb': $('[name=penurunan_bb]:checked').val() != undefined ? $(
                '[name=penurunan_bb]:checked').val() : '',
            'asupan_makanan': $('[name=asupan_makanan]:checked').val() != undefined ? $(
                '[name=asupan_makanan]:checked').val() : '',
            'diagnosis_khusus': $('[name=diagnosis_khusus]:checked').val() != undefined ? $(
                '[name=diagnosis_khusus]:checked').val() : '',
        }

        $('[name=nutrisi]').val(JSON.stringify(nutrisi));

        status_fungsional = {
            'masuk_rs': {
                'tanggal': $('#tgl_masuk_rs').val(),
                'skor': [
                    $('[name=rangsang_defaksi_masuk]:checked').val() != undefined ? $(
                        '[name=rangsang_defaksi_masuk]:checked').val() : '',
                    $('[name=rangsang_kemih_masuk]:checked').val() != undefined ? $(
                        '[name=rangsang_kemih_masuk]:checked').val() : '',
                    $('[name=membersihkan_diri_masuk]:checked').val() != undefined ? $(
                        '[name=membersihkan_diri_masuk]:checked').val() : '',
                    $('[name=penggunaan_jamban_masuk]:checked').val() != undefined ? $(
                        '[name=penggunaan_jamban_masuk]:checked').val() : '',
                    $('[name=makan_masuk]:checked').val() != undefined ? $('[name=makan_masuk]:checked')
                    .val() : '',
                    $('[name=berubah_sikap_masuk]:checked').val() != undefined ? $(
                        '[name=berubah_sikap_masuk]:checked').val() : '',
                    $('[name=berpindah_masuk]:checked').val() != undefined ? $(
                        '[name=berpindah_masuk]:checked').val() : '',
                    $('[name=memakai_baju_masuk]:checked').val() != undefined ? $(
                        '[name=memakai_baju_masuk]:checked').val() : '',
                    $('[name=naik_turun_tangga_masuk]:checked').val() != undefined ? $(
                        '[name=naik_turun_tangga_masuk]:checked').val() : '',
                    $('[name=mandi_masuk]:checked').val() != undefined ? $('[name=mandi_masuk]:checked')
                    .val() : ''
                ]
            },
            'pulang_rs': {
                'tanggal': $('#tgl_pulang_rs').val(),
                'skor': [
                    $('[name=rangsang_defaksi_keluar]:checked').val() != undefined ? $(
                        '[name=rangsang_defaksi_keluar]:checked').val() : '',
                    $('[name=rangsang_kemih_keluar]:checked').val() != undefined ? $(
                        '[name=rangsang_kemih_keluar]:checked').val() : '',
                    $('[name=membersihkan_diri_keluar]:checked').val() != undefined ? $(
                        '[name=membersihkan_diri_keluar]:checked').val() : '',
                    $('[name=penggunaan_jamban_keluar]:checked').val() != undefined ? $(
                        '[name=penggunaan_jamban_keluar]:checked').val() : '',
                    $('[name=makan_keluar]:checked').val() != undefined ? $(
                        '[name=makan_keluar]:checked').val() : '',
                    $('[name=berubah_sikap_keluar]:checked').val() != undefined ? $(
                        '[name=berubah_sikap_keluar]:checked').val() : '',
                    $('[name=berpindah_keluar]:checked').val() != undefined ? $(
                        '[name=berpindah_keluar]:checked').val() : '',
                    $('[name=memakai_baju_keluar]:checked').val() != undefined ? $(
                        '[name=memakai_baju_keluar]:checked').val() : '',
                    $('[name=naik_turun_tangga_keluar]:checked').val() != undefined ? $(
                        '[name=naik_turun_tangga_keluar]:checked').val() : '',
                    $('[name=mandi_keluar]:checked').val() != undefined ? $(
                        '[name=mandi_keluar]:checked').val() : ''
                ]
            }
        }

        $('[name=status_fungsional]').val(JSON.stringify(status_fungsional));

        kebutuhan_komunikasi = {
            'bicara': $('[name=bicara]:checked').val() != undefined ? $('[name=bicara]:checked').val() : '',
            'bicara_input': $('#bicara_input').val(),
            'perlu_penerjemah': $('[name=penerjemah]:checked').val() != undefined ? $(
                '[name=penerjemah]:checked').val() : '',
            'bahasa': $('#bahasa_penerjemah').val(),
            'bahasa_isyarat': $('[name=bahasa_isyarat]:checked').val() != undefined ? $(
                '[name=bahasa_isyarat]:checked').val() : '',
            'hambatan_belajar': $('[name=hambatan_belajar]:checked').val() != undefined ? $(
                '[name=hambatan_belajar]:checked').val() : '',
            'hambatan_belajar_value': {
                'pendengaran': $('#hambatan_belajar_1').is(':checked') ? 1 : 0,
                'penglihatan': $('#hambatan_belajar_2').is(':checked') ? 1 : 0,
                'kognitif': $('#hambatan_belajar_3').is(':checked') ? 1 : 0,
                'fisik': $('#hambatan_belajar_4').is(':checked') ? 1 : 0,
                'budaya': $('#hambatan_belajar_5').is(':checked') ? 1 : 0,
                'agama': $('#hambatan_belajar_6').is(':checked') ? 1 : 0,
                'emosi': $('#hambatan_belajar_7').is(':checked') ? 1 : 0,
                'bahasa': $('#hambatan_belajar_8').is(':checked') ? 1 : 0,
                'lainnya': $('#hambatan_belajar_9').is(':checked') ? 1 : 0,
                'lain_input': $('#hambatan_belajar_lain').val()
            },
            'kebutuhan_pembelajaran': {
                'proses_penyakit': $('#kebutuhan_pembelajaran_1').is(':checked') ? 1 : 0,
                'therapi': $('#kebutuhan_pembelajaran_2').is(':checked') ? 1 : 0,
                'diet': $('#kebutuhan_pembelajaran_3').is(':checked') ? 1 : 0,
                'rehabilitasi': $('#kebutuhan_pembelajaran_4').is(':checked') ? 1 : 0,
                'managemen_nyeri': $('#kebutuhan_pembelajaran_5').is(':checked') ? 1 : 0,
                'lainnya': $('#kebutuhan_pembelajaran_6').is(':checked') ? 1 : 0,
                'lain_input': $('#kebutuhan_pembelajaran_lain').val()
            }
        }

        $('[name=kebutuhan_komunikasi]').val(JSON.stringify(kebutuhan_komunikasi));

        status_ekonomi = {
            'penanggung_jawab': $('[name=penanggung_jawab]:checked').val() != undefined ? $(
                '[name=penanggung_jawab]:checked').val() : '',
            'asuransi': $('#asuransi').val(),
            'tanggungan': $('#tanggungan').val()
        }

        $('[name=status_ekonomi]').val(JSON.stringify(status_ekonomi));

        riwayat_psikososial = {
            'tinggal_bersama': $('[name=tinggal_bersama]:checked').val() != undefined ? $(
                '[name=tinggal_bersama]:checked').val() : "",
            'pekerjaan': $('[name=pekerjaan]:checked').val() != undefined ? $('[name=pekerjaan]:checked')
                .val() : "",
            'pekerjaan_lain': $('#pekerjaan_lain').val(),
            'keluarga_terdekat': $('#keluarga_terdekat').val(),
            'hubungan': $('#hubungan_riwayat_psiko').val(),
            'telepon': $('#telepon_riwayat_psiko').val(),
            'status_emosional': $('[name=status_emosional]:checked').val() != undefined ? $(
                '[name=status_emosional]:checked').val() : '',
            'status_emosional_lain': $('#status_emosional_lain').val(),
            'status_mental': $('[name=status_mental]:checked').val() != undefined ? $(
                '[name=status_mental]:checked').val() : '',
            'status_mental_lain': $('#status_mental_lain').val(),
            'restrain': $('[name=restrain]:checked').val() != undefined ? $('[name=restrain]:checked')
                .val() : '',
            'curiga': $('[name=curiga]:checked').val() != undefined ? $('[name=curiga]:checked').val() : '',
            'hubungan_pasien': $('[name=hubungan_pasien]:checked').val() != undefined ? $(
                '[name=hubungan_pasien]:checked').val() : '',
            'spiritual': $('[name=spiritual]:checked').val() != undefined ? $('[name=spiritual]:checked')
                .val() : '',
            'spiritual_input': $('#spiritual_input').val(),
        }

        $('[name=riwayat_psikososial]').val(JSON.stringify(riwayat_psikososial));

        pola_aktivitas = {
            'istirahat': {
                'tak': $('#tak_pola_aktivitas').is(':checked') ? 1 : 0,
                'insomnia': $('#insomnia_pola_aktivitas').is(':checked') ? 1 : 0,
                'lain_lain': $('#lain_lain_pola_aktivitas').is(':checked') ? 1 : 0,
                'lain_input': $('#lain_input_pola_aktivitas').val()
            },
            'penggunaan_obat_tidur': $('[name=obat_tidur]:checked').val() != undefined ? $(
                '[name=obat_tidur]:checked').val() : '',
            'olahraga': {
                'value': $('[name=olahraga]:checked').val() != undefined ? $('[name=olahraga]:checked')
                    .val() : '',
                'jenis': $('#jenis_olahraga').val(),
                'frekuensi': $('#frekuensi_olahraga').val()
            }
        }

        $('[name=pola_aktivitas]').val(JSON.stringify(pola_aktivitas));

        kebiasaan_sehari_hari = {
            'merokok': {
                'value': $('[name=merokok]:checked').val() != undefined ? $('[name=merokok]:checked')
                    .val() : '',
                'jumlah': $('#jumlah_rokok').val(),
                'selama': $('#merokok_selama').val()
            },
            'kopi': {
                'value': $('[name=kopi]:checked').val() != undefined ? $('[name=kopi]:checked').val() : '',
                'jumlah': $('#jumlah_kopi').val(),
            }
        }

        $('[name=pola_kebiasaan]').val(JSON.stringify(kebiasaan_sehari_hari));

        ketergantungan_zat = {
            'alkohol': {
                'value': $('[name=alkohol]:checked').val() != undefined ? $('[name=alkohol]:checked')
                    .val() : '',
                'jumlah': $('#jumlah_alkohol').val()
            },
            'obat_obatan': {
                'value': $('[name=ketergantungan_obat]:checked').val() != undefined ? $(
                    '[name=ketergantungan_obat]:checked').val() : '',
                'jenis': {
                    'metadon': $('#obat_metadon').is(':checked') ? 1 : 0,
                    'kokain': $('#obat_kokain').is(':checked') ? 1 : 0,
                    'analgetik': $('#obat_analgetik').is(':checked') ? 1 : 0,
                    'heroin': $('#obat_heroin').is(':checked') ? 1 : 0,
                    'amfetamin': $('#obat_amfetamin').is(':checked') ? 1 : 0,
                    'lain_lain': $('#obat_lain_lain').is(':checked') ? 1 : 0,
                    'lain_input': $('#ketergantungan_obat_lain_input').val(),
                }
            }
        }

        $('[name=ketergantungan_zat]').val(JSON.stringify(ketergantungan_zat));

        orientasi_pada_pasien = {
            'ruang_kamar': $('#orientasi_pasien_1').is(':checked') ? 1 : 0,
            'pengatur_tempat_tidur': $('#orientasi_pasien_2').is(':checked') ? 1 : 0,
            'lemari': $('#orientasi_pasien_3').is(':checked') ? 1 : 0,
            'kamar_mandi': $('#orientasi_pasien_4').is(':checked') ? 1 : 0,
            'pengaman_tempat_tidur': $('#orientasi_pasien_5').is(':checked') ? 1 : 0,
            'tv': $('#orientasi_pasien_6').is(':checked') ? 1 : 0,
            'telepon': $('#orientasi_pasien_7').is(':checked') ? 1 : 0,
            'bel': $('#orientasi_pasien_8').is(':checked') ? 1 : 0,
            'apotek': $('#orientasi_pasien_9').is(':checked') ? 1 : 0,
        };

        $('[name=orientasi_pada_pasien]').val(JSON.stringify(orientasi_pada_pasien));

        informasi_pada_pasien = {
            'perawat': $('#informasi_pasien_1').is(':checked') ? 1 : 0,
            'waktu': $('#informasi_pasien_2').is(':checked') ? 1 : 0,
            'jam': $('#informasi_pasien_3').is(':checked') ? 1 : 0,
        }

        $('[name=informasi_pada_pasien]').val(JSON.stringify(informasi_pada_pasien));

        penggunaan_alat_medik = {
            'value': $('[name=penggunaan_alat_medik]:checked').val() != undefined ? $(
                '[name=penggunaan_alat_medik]:checked').val() : '',
            'infus': $('#infus').is(':checked') ? 1 : 0,
            'tanggal_pasang_infus': $('#tanggal_pasang_infus').val(),
            'kateter': $('#kateter').is(':checked') ? 1 : 0,
            'tanggal_pasang_kateter': $('#tanggal_pasang_kateter').val(),
            'ngt': $('#ngt').is(':checked') ? 1 : 0,
            'tanggal_pasang_ngt': $('#tanggal_pasang_ngt').val(),
        }

        $('[name=penggunaan_alat_mediks]').val(JSON.stringify(penggunaan_alat_medik));

        masalah_keperawatan = [];

        for (let i = 0; i < 19; i++) {
            if ($('#masalah_keperawatan_' + (i + 1)).is(':checked')) {
                masalah_keperawatan.push(1);
            } else {
                masalah_keperawatan.push(0);
            }
        }

        $('#masalah_keperawatan_lainnya').is(':checked') ? masalah_keperawatan.push(1) : masalah_keperawatan.push(
            0);
        masalah_keperawatan.push($('#masalah_keperawatan_lain_input').val());

        $('[name=masalah_keperawatan]').val(JSON.stringify(masalah_keperawatan));
        $('[name=obat_dirumah]').val(JSON.stringify(obat_obatan_rumah));

        console.log(masalah_keperawatan);

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/asesmen_awal_keperawatan_geriatri/store') }}",
            method: 'post',
            data: $('#form_dokumen').serialize(),
            success: function(response) {
                alert(response.message);
                console.log(response);
            }
        })
    })

    let obat_obatan_rumah = [];

    $(document).ready(function() {
        <?php if (!is_null($data)) { ?>
        obat_obatan_rumah = JSON.parse('<?php echo $data->obat_dirumah; ?>');
        <?php } ?>
        render_obat_obatan_rumah();
    })

    $('#form_obat_obatan_rumah').submit(function(e) {
        e.preventDefault();

        if ($('#action_obat').val() == 'add') {
            obat_obatan_rumah.push({
                'nama': $('#nama_obat').val(),
                'dosis': $('#dosis_obat').val(),
                'kapan': $('#terakhir_diberikan').val()
            });
        } else {
            obat_obatan_rumah[$('#index_obat').val()] = {
                'nama': $('#nama_obat').val(),
                'dosis': $('#dosis_obat').val(),
                'kapan': $('#terakhir_diberikan').val()
            };
        }
        $('#index_obat').val('');
        $('#action_obat').val('');
        $('#nama_obat').val('');
        $('#dosis_obat').val('');
        $('#terakhir_diberikan').val('');
        $('#daftarObatModal').modal('hide');
        render_obat_obatan_rumah();
    })

    function render_obat_obatan_rumah() {
        if (obat_obatan_rumah.length < 1) {
            $('#list_obat_obatan_rumah').html('<tr><td class="text-center" colspan="4">Data tidak ditemukan</td></tr>');
            return;
        }

        var ins = '';
        for (let i = 0; i < obat_obatan_rumah.length; i++) {
            ins += '<tr>' +
                '<td>' + obat_obatan_rumah[i].nama + '</td>' +
                '<td>' + obat_obatan_rumah[i].dosis + '</td>' +
                '<td>' + tanggal_dmy(obat_obatan_rumah[i].kapan) + '</td>' +
                '<td><button class="btn btn-warning" type="button" style="color:#fff;" onclick="open_modal_edit_obat(' +
                "'" + i + "'" +
                ')"><i class="fa fa-pencil"></i></button></td>' +
                '</tr>';
        }

        $('#list_obat_obatan_rumah').html(ins);
    }

    function tanggal_dmy(params) {
        if (params == '' || params == null) {
            return '';
        }
        let temp = params.split('-');
        return temp[2] + '-' + temp[1] + '-' + temp[0];
    }

    function open_modal_obat() {
        $('#action_obat').val('add');
        $('#daftarObatModal').modal('show');
    }

    function open_modal_edit_obat(param) {
        $('#index_obat').val(param);
        $('#action_obat').val('edit');

        $('#nama_obat').val(obat_obatan_rumah[param].nama);
        $('#dosis_obat').val(obat_obatan_rumah[param].dosis);
        $('#terakhir_diberikan').val(obat_obatan_rumah[param].kapan);

        $('#daftarObatModal').modal('show');
    }
</script>

</html>
