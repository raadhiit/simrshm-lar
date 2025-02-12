<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Pemeriksaan Patologi Anatomi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>

        @media print {
            .hidden-on-print{
                display: none;
            }
        }
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }
    </style>
</head>

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif

@if(Session::has('gagal'))
<div class="alert alert-danger">{{Session::get('gagal')}}</div>
@endif

@if(Session::has('sukses'))
<div class="alert alert-success">{{Session::get('sukses')}}</div>
@endif

<body class="p-2">
    @php
    function exists_value($model, $key, $default_value = null) {
    $value = $default_value ?? '';

    if (!is_null($model) && !empty($model->$key)) {
    $value = $model->$key;
    }

    return old($key, $value);
    }

    function check_value($value, $compare_value) {
    $checked = $compare_value;
    if (!empty($value) && strpos($value, $compare_value) !== false) {
    $checked = 'checked';
    }

    return $checked;
    }
    @endphp
    <div class="container mt-5">
        @include('components.header-erm-dok-kunjungan', ['pasien' => $pasien, 'dokumen' => $dokumen])

        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <b>PERMINTAAN PEMERIKSAAN PATOLOGI ANATOMI</b>
            </div>
        </div>
        <div class="row">
            <table style="width: 100%">
                <tr>
                    <td style="width: 50%; padding: 10px">
                        <table style="border-collapse: collapse; width:100%">
                            <tr class="align-top">
                                <td style="width: 27%;">Nama pasien</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <input
                                        type="text"
                                        id="temp_nama_pasien"
                                        name="temp_nama_pasien"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                        class="form-control"
                                        value="{{ $permintaan ? $permintaan->nama_pasien : $pasien->nama }}">
                                </td>
                            </tr>

                            <tr class="align-top">
                                <td style="width: 27%;">No. Rekam Medis</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <input
                                        type="text"
                                        name="nrm"
                                        class="form-control"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                        disabled
                                        value="{{ exists_value($dokumen, 'nrm', $pasien->id) }}">
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 27%;">Hari/tanggal</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <input
                                        type="text"
                                        name="temp_tgl_pemeriksaan"
                                        id="temp_tgl_pemeriksaan"
                                        class="form-control fulldate"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                        value="{{ $permintaan ? \Carbon\Carbon::parse($permintaan->tanggal_pemeriksaan)->format('d-m-Y H:i') : \Carbon\Carbon::now()->format('d-m-Y H:i') }}">
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 27%;">DPJP</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            id="temp_dpjp"
                                            name="temp_dpjp"
                                            disabled style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                            class="form-control"
                                            value="{{ exists_value($permintaan, 'dpjp') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button" onclick="open_modal_yth()"><i class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td style="width: 50%; padding: 10px">
                        <table style="border-collapse: collapse; width:100%">
                            <tr class="align-top">
                                <td style="width: 27%;">Jenis Kelamin</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <input
                                        type="text"
                                        name="kelamin_pasien"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                        class="form-control"
                                        disabled
                                        value="{{ exists_value($permintaan, 'kelamin_pasien', $pasien->kelamin) == 0 ? 'Laki-laki' : 'Perempuan' }}">
                                </td>
                            </tr>

                            <tr class="align-top">
                                <td style="width: 27%;">Usia</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <input
                                        type="text"
                                        name="age"
                                        value="{{ $pasien->age }}"
                                        disabled
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                        class="form-control">
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 27%;">No. PA</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <input
                                        type="text"
                                        id="temp_no_pa"
                                        name="temp_no_pa"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                        class="form-control"
                                        value="{{ exists_value($permintaan, 'no_pa') }}">
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 27%;">Jaminan</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 70%;">
                                    <input
                                        type="text"
                                        id="temp_jaminan"
                                        name="temp_jaminan"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                        class="form-control"
                                        value="{{ strtoupper((string) exists_value($permintaan, 'jaminan', $layanan->carabayar)) }}">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div class="col-md-12 mt-5">
                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 25%;">Pemeriksaan Jaringan Tubuh</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 72%;">
                            <label for="radio_kecil">
                                <input
                                    type="radio"
                                    id="radio_kecil"
                                    name="temp_pemeriksaan_jaringan_tubuh"
                                    {{ check_value(exists_value($permintaan, 'pemeriksaan_jaringan_tubuh'), 'kecil') }}> Kecil
                            </label>
                            <label for="radio_sedang">
                                <input
                                    type="radio"
                                    id="radio_sedang"
                                    name="temp_pemeriksaan_jaringan_tubuh"
                                    class="ml-2"
                                    {{ check_value(exists_value($permintaan, 'pemeriksaan_jaringan_tubuh'), 'sedang') }}> Sedang
                            </label>
                            <label for="radio_besar">
                                <input
                                    type="radio"
                                    id="radio_besar"
                                    name="temp_pemeriksaan_jaringan_tubuh"
                                    class="ml-2"
                                    {{ check_value(exists_value($permintaan, 'pemeriksaan_jaringan_tubuh'), 'besar') }}> Besar
                            </label>
                            <label for="radio_besar_khusus">
                                <input
                                    type="radio"
                                    id="radio_besar_khusus"
                                    name="temp_pemeriksaan_jaringan_tubuh"
                                    class="ml-2"
                                    {{ check_value(exists_value($permintaan, 'pemeriksaan_jaringan_tubuh'), 'besar_khusus') }}> Besar Khusus
                            </label>
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 25%;">Jaringan Tubuh didapat dengan </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 72%;">
                            <label for="check_jaringan_tubuh_didapat_dari_biopsi">
                                <input
                                    type="checkbox"
                                    id="check_jaringan_tubuh_didapat_dari_biopsi"
                                    name="temp_jaringan_tubuh_didapat_dari"
                                    value="biopsi"
                                    {{ check_value(exists_value($permintaan, 'jaringan_tubuh_didapat_dari'), 'biopsi') }}> Biopsi
                            </label>
                            <label for="check_jaringan_tubuh_didapat_dari_operasi">
                                <input
                                    type="checkbox"
                                    id="check_jaringan_tubuh_didapat_dari_operasi"
                                    name="temp_jaringan_tubuh_didapat_dari"
                                    value="operasi" class="ml-2"
                                    {{ check_value(exists_value($permintaan, 'jaringan_tubuh_didapat_dari'), 'operasi') }}> Operasi
                            </label>
                            <label for="check_jaringan_tubuh_didapat_dari_kerokan">
                                <input
                                    type="checkbox"
                                    id="check_jaringan_tubuh_didapat_dari_kerokan"
                                    name="temp_jaringan_tubuh_didapat_dari"
                                    value="kerokan" class="ml-2"
                                    {{ check_value(exists_value($permintaan, 'jaringan_tubuh_didapat_dari'), 'kerokan') }}> Kerokan
                            </label>
                            <label for="check_jaringan_tubuh_didapat_dari_ekstirpasi">
                                <input
                                    type="checkbox"
                                    id="check_jaringan_tubuh_didapat_dari_ekstirpasi"
                                    name="temp_jaringan_tubuh_didapat_dari"
                                    value="ekstirpasi" class="ml-2"
                                    {{ check_value(exists_value($permintaan, 'jaringan_tubuh_didapat_dari'), 'ekstirpasi') }}> Ekstirpasi
                            </label>
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 25%;">Lokasi Jaringan Tubuh </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 72%;">
                            <input
                                type="text"
                                name="temp_lokasi_jaringan_tubuh"
                                id="temp_lokasi_jaringan_tubuh"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ exists_value($permintaan, 'lokasi_jaringan_tubuh') }}">
                        </td>
                    </tr>
                </table>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 25%;">Fiksasi Dengan</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 72%;">
                            <input type="checkbox" {{ $permintaan ? $permintaan->fiksasi == 'formalin_10%' ? 'checked' : '' : '' }} value="formalin_10%" id="fiksasi_formalin_10"> Formalin 10%
                            <span style="margin-left: 2.5%;">&nbsp;</span>
                            <input type="checkbox" {{ $permintaan ? $permintaan->fiksasi == 'formalin_4%' ? 'checked' : '' : '' }} value="formalin_4%" id="fiksasi_formalin_4"> Formaidehid 4%
                            <span style="margin-left: 2.5%;">&nbsp;</span>
                            <input type="checkbox" {{ $permintaan ? $permintaan->fiksasi == 'alkohol_80%' ? 'checked' : '' : '' }} value="alkohol_80%" id="fiksasi_alkohol"> Alkohol 80 %
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 25%;">Diagnosa Klinik</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 72%;">
                            <input
                                type="text"
                                name="temp_diagnosa_klinik"
                                id="temp_diagnosa_klinik"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ exists_value($permintaan, 'diagnosa_klinik') }}">
                        </td>
                    </tr>
                    <tr class="align-top mt-5">
                        <td style="width: 25%;">Keterangan Klinik</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 72%;">
                            {{-- <input type="text" name="" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">  --}}
                            <textarea
                                name="temp_keterangan_klinik"
                                id="temp_keterangan_klinik"
                                cols="30"
                                rows="2"
                                class="form-control">{{ exists_value($permintaan, 'keterangan_klinik') }}</textarea>
                        </td>
                    </tr>
                </table>

                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-md-12 pb-4 pl-0" id="pesanan_lab">
                        Laboratorium : <br>
                        <div id="box_pesanan_lab">
                            @if($permintaan == null || $permintaan->id_lab == 0)
                            <button class="btn btn-dark" onclick="open_modal_lab('{{ $permintaan->id_lab ?? 0 }}')"><i class="fa fa-plus"></i></button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 30%; text-align: center">
                                Cibarusah, <input type="text" class="tanggal_dmy" style="border: hidden; border-bottom: 1px dotted" name="temp_tanggal" id="temp_tanggal" value="{{ $permintaan && $permintaan->tanggal != '0000-00-00 00:00:00' ? \Carbon\Carbon::parse($permintaan->tanggal)->format('d-m-Y') : date('d-m-Y') }}">
                                <br>
                                Yang menyerahkan
                                <br>
                                <button
                                    class="text-decoration-none bg-transparent" data-toggle="modal"
                                    data-target="#verif_modal" style="outline-width: 0; border: 0;">
                                    @if(!isset($dokumen->id_verifikator))
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    @else
                                    @if(isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                        style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                    <br>
                                    <br>
                                    Simpan dan Verifikasi
                                    <br>
                                    <br>
                                    <br>
                                    @endif
                                    @endif
                                    <br>
                                    ({{ !empty($employee) ? $employee->nama : '............................................' }})
                                </button>
                            </td>
                            <td style="width: 70%"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="verif_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="verif-form" action="{{ url('e_rekam_medis/detail/verif_permintaan_pemeriksaan_patologi_anatomi') }}">
                    @csrf
                    <input type="hidden" name="id_lab" value="{{ $permintaan ? $permintaan->id_lab : 0 }}">
                    <input type="hidden" name="id_dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="nama_pasien" id="nama_pasien">
                    <input type="hidden" name="alamat_pasien" id="alamat_pasien">
                    <input type="hidden" name="kelamin_pasien" id="tgl_lahir_pasien">

                    <input type="hidden" name="jaminan" id="jaminan">
                    <input type="hidden" name="id_dpjp" id="id_dpjp" value="{{ exists_value($permintaan, 'id_dpjp', null) }}">
                    <input type="hidden" name="dpjp" id="dpjp">
                    <input type="hidden" name="no_pa" id="no_pa">
                    <input type="hidden" name="tgl_pemeriksaan" id="tgl_pemeriksaan">
                    <input type="hidden" name="pemeriksaan_jaringan_tubuh" id="pemeriksaan_jaringan_tubuh">
                    <input type="hidden" name="jaringan_tubuh_didapat_dari" id="jaringan_tubuh_didapat_dari">
                    <input type="hidden" name="lokasi_jaringan_tubuh" id="lokasi_jaringan_tubuh">
                    <input type="hidden" name="diagnosa_klinik" id="diagnosa_klinik">
                    <input type="hidden" name="fiksasi">
                    <textarea hidden name="keterangan_klinik" id="keterangan_klinik"></textarea>
                    <input type="hidden" name="tanggal" id="tanggal">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="submit_verif()" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_yth" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Kepada Yth.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabel_kepada" class="table table-striped mt-2" style="width: 100%;">
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

    <!-- Modal lab -->
    <div class="modal fade" id="modal_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesanan Lab</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_laboratorium" method="post">
                    <input type="hidden" name="nama_dokumen" value="permintaan_pemeriksaan_patologi_anatomi">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="id_pesanan" id="id_lab">
                    <input name="alamat" type="hidden" class="form-control" value="{{ $pasien->alamat }}">
                    <input type="hidden" name="ibu" value="{{ $layanan->ibu }}" class="form-control">
                    <input type="hidden" name="jenis_pasien" value="{{ $layanan->carabayar }}" class="form-control">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" class="form-control" name="noreg" value="{{ $layanan->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" name="nama_pasien" value="{{ $pasien->nama }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">NRM</label>
                            <input type="text" name="nrm" value="{{ $pasien->id }}" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">L/P</label>
                            <select name="kelamin" disabled class="form-control">
                                <option value="1" @if ($layanan->kelamin == 1) {{ 'selected' }} @endif>
                                    Perempuan
                                </option>
                                <option value="0" @if ($layanan->kelamin == 0) {{ 'selected' }} @endif>
                                    Laki-Laki
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Umur</label>
                            <input type="text" readonly value="{{ $layanan->umur }}" name="umur" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Ruangan</label>
                            <select id="ruangan_lab" name="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($ruangan as $ru)
                                <option value="{{ $ru->slug }}" @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                    {{ $ru->nama }}
                                </option>
                                @endforeach
                                <option value="pendaftaran" @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                                </option>
                                <option value="laboratory" @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                                </option>
                                <option value="radiology" @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                                    Radiology
                                </option>
                                <option value="elektromedis" @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                                </option>
                                <option value="medical_checkup" @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">BED</label>
                            <input type="text" readonly value="{{ $layanan->last_bed != "" ? $layanan->last_bed : "" }}" name="last_bed"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" readonly value="{{ date('Y-m-d') }}" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select id="kelas" name="kelas" readonly style="pointer-events: none;" onclick="return false;" onkeydown="return false;" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($list_kelas as $kls)
                                <option value="{{ $kls->slug }}" @if ($kelas_lab) @if ($kls->slug == $kelas_lab->value)
                                    {{ 'selected' }} @endif
                                    @endif>{{ $kls->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Reguler / Cito</label>
                            <select id="cito" name="cito" class="form-control">
                                <option value="0">Reguler</option>
                                <option value="1">Cito</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Dokter</label>
                            <input type="text" id="dokter_lab" name="dokter" readonly placeholder="Pilih dokter" value="{{ Auth::user()->realname }}" class="form-control">
                            <input type="hidden" value="{{ Auth::user()->id }}" id="id_dokter_lab" name="id_dokter">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa</label>
                            <input type="text" id="diagnosa_lab" name="diagnosa" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan Pemeriksaan</label>
                            <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan" style="width: 100%" class="form-control">
                                @foreach ($pemeriksaan as $pe)
                                <option value="{{ $pe->slug }}">{{ $pe->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal hasil lab -->
    <div class="modal fade" id="modal_hasil_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hasil Laboratorium</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="link_lampiran_lab" class="pb-2"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Jenis Pemeriksaan</th>
                                <th>Hasil</th>
                                <th>Nilai Rujukan</th>
                            </tr>
                        </thead>
                        <tbody id="list_hasil_lab">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- End modal hasil lab -->
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: '{{ $permintaan->id_lab ?? 0 }}'
            },
            success: function(response) {
                if (Object.keys(response).length === 0) {
                    return;
                }
                $('#box_pesanan_lab').html(render_pesanan_lab(response));
            }
        });
    });

    $('.tanggal_dmy').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
    });

    $('.tanggal_dmy').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('.tanggal_dmy').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.fulldate').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });

    $('.fulldate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm'));
    });

    $('.fulldate').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#fiksasi_formalin_10').click(function(){
        if($('#fiksasi_formalin_10').is(':checked')){
            $('#fiksasi_alkohol').prop('checked', false);
            $('#fiksasi_formalin_4').prop('checked', false);
        }
    })

    $('#fiksasi_alkohol').click(function(){
        if($('#fiksasi_alkohol').is(':checked')){
            $('#fiksasi_formalin_10').prop('checked', false);
            $('#fiksasi_formalin_4').prop('checked', false);
        }
    })

    $('#fiksasi_formalin_4').click(function(){
        if($('#fiksasi_formalin_4').is(':checked')){
            $('#fiksasi_formalin_10').prop('checked', false);
            $('#fiksasi_alkohol').prop('checked', false);
        }
    })

    function load_form_data() {
        $('[name=fiksasi]').val($('#fiksasi_formalin_10').is(':checked') ? $('#fiksasi_formalin_10').val() : $('#fiksasi_formalin_4').is(':checked') ? $('#fiksasi_formalin_4').val() : $('#fiksasi_alkohol').is(':checked') ? $('#fiksasi_alkohol').val() : '');
        const jaminan = '{{ $layanan->carabayar }}'.toUpperCase()
        $('input[type="text"]').each(function() {
            const e = $(this)
            let id = e.attr('id')

            if (id && id.includes('temp_')) {
                id = id.replace('temp_', '')
                const newValue = e.val()

                if (id == "tanggal") {
                    $(`input#${id}`).val(newValue.split('-').reverse().join('-'))
                } else if (id == "tgl_pemeriksaan") {
                    var fulldate = newValue.split(' ');
                    var tanggal = fulldate[0];
                    var jam = fulldate[1];
                    $(`input#${id}`).val(tanggal.split('-').reverse().join('-') + " " + jam)
                } else {
                    if (id === 'jaminan' && newValue !== jaminan) {
                        $(`input#${id}`).val(newValue)
                    } else {
                        $(`input#${id}`).val(newValue)
                    }
                }
            }
        });

        $('input[type="number"]').each(function() {
            const e = $(this)
            const id = e.attr('id').replace('temp_', '')
            const input = $(`input#${id}`)
            input.val(e.val())
        });

        const note = $('textarea#temp_keterangan_klinik').val()
        $('textarea#keterangan_klinik').val(note)

        const pemeriksaan_jaringan_tubuh = $('input[name="temp_pemeriksaan_jaringan_tubuh"]:checked');
        $('input#pemeriksaan_jaringan_tubuh').val(pemeriksaan_jaringan_tubuh.attr('id').replace('radio_', ''))

        let jaringan_tubuh = ''
        $('input[name="temp_jaringan_tubuh_didapat_dari"]:checked').each(function() {
            jaringan_tubuh += (jaringan_tubuh.length > 0 ? ',' : '') + $(this).val()
        })
        $('input#jaringan_tubuh_didapat_dari').val(jaringan_tubuh)
        console.log($('form#verif-form').serialize());
    }

    function submit_verif() {
        load_form_data();

        $('form#verif-form').submit()
    }

    function open_modal_yth() {
        get_data_dokter();
        $('#modal_yth').modal('show');
    }

    function get_data_dokter() {
        table = $('#tabel_kepada').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "destroy": true,
            ajax: '{{ url("ajax_request/dokter") }}',
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    render(data, type, row, meta) {
                        return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</p>';
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
                        const handleClick = `set_kepada(${data}, '${row.nama}')`
                        return '<div class="text-center"><button type="button" onclick="' + handleClick + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });
    }

    function set_kepada(id, nama) {
        $('#temp_dpjp').val(nama);
        $('#dpjp').val(nama);
        $('#id_dpjp').val(id);

        $('#modal_yth').modal('hide');
    }
</script>
<!-- SCRIPT LAB-->
<script>
    function open_modal_lab(id) {
        $('#id_lab').val(id);

        if (id == 0) {
            $('#modal_lab').modal('show');
            return;
        }

        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                let temp = [];
                if (Object.keys(response).length !== 0) {
                    if (response.status != 'Pesanan ERM') {
                        toastr.error('Tidak diperkenankan ubah pesanan laboratorium');
                        return;
                    }
                }
                if (Object.keys(response).length !== 0) {
                    const periksa = JSON.parse(response.periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push(`${key}`);
                        }
                    });
                    $('#pesan_pemeriksaan').val(temp).change();
                    $('#ruangan_lab').val(response.ruangan);
                    $('#kelas').val(response.kelas);
                    $('#diagnosa_lab').val(response.diagnosa);
                    $('#cito').val(response.cito);
                }
                $('#id_lab').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#modal_lab').modal('show');
            }
        })
    }

    $('#pesan_pemeriksaan').select2();

    $('#form_laboratorium').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang menyimpan data, harap tunggu...');
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_store_by_id') }}",
            method: 'post',
            data: $('#form_laboratorium').serialize(),
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                $('#modal_lab').modal('hide');
                toastr.success(response.message);
                $('[name=id_lab]').val(response.data.id);
                load_form_data()
                $('form#verif-form').submit();
                // $('#box_pesanan_lab').html(render_pesanan_lab(response.data));
            }
        })
    });

    function cek_nilai_normal(nilai, master) {
        let kelamin = '{{ $layanan->kelamin }}';
        switch (master.nn) {
            case 'less-than':
                if (nilai < master.lessthan) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'more-than':
                if (nilai > master.morethan) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'between':
                if (nilai >= master.valmin && nilai <= master.valmax) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'diantara_sampai':
                if (nilai >= master.valmin && nilai <= master.valmax) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'same':
                if (nilai == master.sameval) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'reaktif_nonreaktif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif_2':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'normal':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif_positif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'laper':
                if (kelamin == '0') {
                    if (nilai >= master.lmin && nilai <= master.lmax) {
                        return '';
                    }
                    return 'font-weight:bold; color:red';
                } else if (kelamin == '1') {
                    if (nilai >= master.pmin && nilai <= master.pmax) {
                        return '';
                    }
                    return 'font-weight:bold; color:red';
                }
                return '';
                break;

            default:
                return '';
                break;
        }
    }

    function render_pesanan_lab(data) {
        if (data == null) {
            return;
        }

        let result = [];
        let pemeriksaan = <?php echo $pemeriksaan ? $pemeriksaan : [] ?>;
        let yang_dipesan = data ? JSON.parse(data.periksa) : null;

        if (yang_dipesan != null) {
            for (let i = 0; i < pemeriksaan.length; i++) {
                if (yang_dipesan[pemeriksaan[i].slug] != undefined) {
                    if (yang_dipesan[pemeriksaan[i].slug] == 1) {
                        result.push(pemeriksaan[i].nama);
                    }
                }
            }
        }

        var ins = '<div style="display: flex; flex-direction: row">' +
            '<div style="width:15%">' +
            (data.angka_status == 0 || data.angka_status == 10 ? '<button type="button" data-toggle="tooltip" title="Ubah Pemeriksaan" class="btn btn-warning hidden-on-print" onclick="open_modal_lab(' + "'" + (data ? data.id : 0) + "'" + ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>' : '') +
            '<button type="button" data-toggle="tooltip" title="Hasil Lab" class="btn btn-info ml-1 hidden-on-print" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_lab(' + "'" + (data ? data.id : 0) + "'" + ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
            (data.angka_status == 0 || data.angka_status == 10 ? '<button type="button" data-toggle="tooltip" title="Hapus" class="btn btn-danger ml-1 hidden-on-print" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_lab(' + "'" + (data ? data.id : 0) + "'" + ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' : '') +
            '</div>' +
            '<div class="pl-3 pt-1" style="width:85%">' +
            (data ? data.no_lab + ' - ' + result.join(', ') : '') +
            '</div>' +
            '</div>';

        return ins;
    }

    function open_modal_hasil_lab(param) {
        let cek = false
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                let temp = JSON.parse(response.hasil);
                let hasil = Object.entries(temp);
                let key_hasil = Object.keys(hasil);
                for (let i = 0; i < hasil.length; $i++) {
                    if (hasil[key_hasil[i]] != '') {
                        cek = true;
                        break;
                    }
                }
                var ins = '';
                if (cek) {
                    let temp_grup = '';
                    let master_hasil = <?php echo $master_hasil; ?>;
                    for (let i = 0; i < master_hasil.length; i++) {
                        if (temp[master_hasil[i].slug] != '') {
                            if (temp_grup != master_hasil[i].grup) {
                                ins += '<tr>' +
                                    '<th colspan="3">' + master_hasil[i].grup + '</th>' +
                                    '</tr>';
                                temp_grup = master_hasil[i].grup;
                            }
                            if (temp[master_hasil[i].slug] != undefined && temp[master_hasil[i].slug] != '') {
                                ins += '<tr>' +
                                    '<td style="padding-left: 40px">' + master_hasil[i].name + '</td>' +
                                    '<td class="text-center" style="' + cek_nilai_normal(temp[master_hasil[i].slug], master_hasil[i]) + '">' + temp[master_hasil[i].slug] +
                                    '</td>' +
                                    '<td class="text-center">' + master_hasil[i].nt + '</td>' +
                                    '</tr>';
                            }
                        }
                    }
                } else {
                    ins = '<tr>' +
                        '<th colspan="3" class="text-center">Tidak ada hasil</th>' +
                        '</tr>';
                }
                let file = response.file != '' ? JSON.parse(response.file) : [''];
                if (file[0] != '') {
                    $('#link_lampiran_lab').html(`<a style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL ') }}/' + file[0] + '" target="_blank">Download lampiran klik disini</a>`);
                }
                $('#list_hasil_lab').html(ins);
                $('#modal_hasil_lab').modal('show');
            }
        })
    }

    function hapus_pesanan_lab(param) {
        if (confirm('Yakin melanjutkan hapus pesanan laboratorium ?')) {
            $.ajax({
                url: "{{ url('ajax_request/hapus_pesanan_lab') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    if (!response.status) {
                        toastr.error(response.message);
                        return;
                    }
                    toastr.success(response.message);
                    $('[name=id_lab]').val(0);
                    load_form_data()
                    $('form#verif-form').submit();
                    // $('#box_pesanan_lab').html(`<button type="button" class="btn btn-dark" onclick="open_modal_lab('0')"><i class="fa fa-plus" style="color:#fff;"></i></button>`);
                }
            })
        }
    }
</script>
<!-- END SCRIPT LAB -->

</html>