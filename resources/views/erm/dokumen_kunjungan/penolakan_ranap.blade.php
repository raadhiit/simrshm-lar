<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>SMIS - Assesment Perioperatif Medis</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <title>Penolakan Rawat Inap</title>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
       .custom-table td{
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }
       .custom-table th{
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
    @endphp
    <div class="container">
        @include('components.header-erm-dok-kunjungan', ['pasien' => $pasien, 'dokumen' => $dokumen])
    </div>

    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12">
                <h4 class="text-center">PENOLAKAN RAWAT INAP</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>
                    Saya yang bertanda tangan dibawah ini :
                </p>
                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Nama</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_nama_kerabat"
                                name="temp_nama_kerabat"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 80%"
                                value="{{ exists_value($penolakan_ranap, 'nama_kerabat', $pasien->nama) }}"
                            >
                            <input type="radio" value="laki-laki" name="temp_kelamin" {{ $penolakan_ranap ? ($penolakan_ranap->kelamin == "laki-laki" ? 'checked' : '' ) : ($pasien->kelamin == 0 ? "checked" : "") }}> Laki-laki
                            <input type="radio" value="Perempuan" name="temp_kelamin" {{ $penolakan_ranap ? ($penolakan_ranap->kelamin == "Perempuan" ? 'checked' : '' ) : ($pasien->kelamin == 0 ? "" : "checked") }}> Perempuan
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Tempat/Tgl. Lahir</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 20%">
                                        <input
                                            type="text"
                                            id="temp_tempat_lahir_kerabat"
                                            name="temp_tempat_lahir_kerabat"
                                            style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                            value="{{ exists_value($penolakan_ranap, 'tempat_lahir_kerabat', ($pasien->tempat_lahir != "" ? $pasien->tempat_lahir : '-')) }}">
                                    </td>
                                    <td style="width: 1%">/</td>
                                    <td style="width: 79%">
                                        <input
                                            type="text"
                                            id="temp_tgl_lahir_kerabat"
                                            name="temp_tgl_lahir_kerabat"
                                            style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                            class="tanggal_dmy"
                                            value="{{ $penolakan_ranap ? date('d-m-Y', strtotime($penolakan_ranap->tgl_lahir_kerabat)) : ($pasien->tgl_lahir != "0000-00-00" ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : date('d-m-Y')) }}">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td style="width: 12%;">Alamat Rumah</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_alamat_kerabat"
                                name="temp_alamat_kerabat"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                value="{{ exists_value($penolakan_ranap, 'alamat_kerabat', $pasien->alamat) }}"
                            >
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td style="width: 12%;">No Telepon</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="number"
                                id="temp_telp_kerabat"
                                name="temp_telp_kerabat"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                value="{{ exists_value($penolakan_ranap, 'telp_kerabat', $pasien->telpon) }}"
                            >
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td style="width: 12%;">No. Identitas/KTP</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_ktp_kerabat"
                                name="temp_ktp_kerabat"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                value="{{ exists_value($penolakan_ranap, 'ktp_kerabat', $pasien->ktp) }}"
                            >
                        </td>
                    </tr>
                </table>

                <p>
                    Dengan ini menyatakan dengan sesungguhnya telah memberikan :
                </p>

                <div class="col-md-12">
                    <h4 class="text-center">PENOLAKAN</h4>
                </div>

                <p> Untuk menjalani PELAYANAN RAWAT INAP terhadap
                    <input
                        type="radio"
                        name="temp_hubungan"
                        id="radio_diri_sendiri"
                        {{ $penolakan_ranap ? ($penolakan_ranap->hubungan == "diri_sendiri" ? "checked" : "" ) : "" }}
                    > Saya Sendiri /
                    <input
                        type="radio"
                        name="temp_hubungan"
                        id="radio_istri"
                        {{ $penolakan_ranap ? ($penolakan_ranap->hubungan == "istri" ? "checked" : "" ) : "" }}
                    > Istri /
                    <input
                        type="radio"
                        name="temp_hubungan"
                        id="radio_suami"
                        {{ $penolakan_ranap ? ($penolakan_ranap->hubungan == "suami" ? "checked" : "" ) : "" }}
                    > Suami /
                    <input
                        type="radio"
                        name="temp_hubungan"
                        id="radio_anak"
                        {{ $penolakan_ranap ? ($penolakan_ranap->hubungan == "anak" ? "checked" : "" ) : "" }}
                    > Anak /
                    <input
                        type="radio"
                        name="temp_hubungan"
                        id="radio_kerabat"
                        {{ $penolakan_ranap ? ($penolakan_ranap->hubungan == "kerabat" ? "checked" : "" ) : "" }}
                    > Kerabat Saya
                </p>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Nama</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_nama_pasien"
                                name="temp_nama_pasien"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 90%"
                                value="{{ exists_value($penolakan_ranap, 'temp_nama_pasien', $pasien->nama) }}"
                            > {{ $pasien->kelamin == 0 ? "Laki-laki" : "Perempuan" }}
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Tempat/Tgl Lahir </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 20%">
                                        <input
                                            type="text"
                                            id="temp_tempat_lahir_pasien"
                                            name="temp_tempat_lahir_pasien"
                                            style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                            value="{{ exists_value($penolakan_ranap, 'tempat_lahir_pasien', ($pasien->tempat_lahir != "" ? $pasien->tempat_lahir : '-')) }}">
                                    </td>
                                    <td style="width: 1%">/</td>
                                    <td style="width: 79%">
                                        <input
                                            type="text"
                                            id="temp_tgl_lahir_pasien"
                                            name="temp_tgl_lahir_pasien"
                                            style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                            class="tanggal_dmy"
                                            value="{{ $penolakan_ranap ? date('d-m-Y', strtotime($penolakan_ranap->tgl_lahir_pasien)) : ($pasien->tgl_lahir != "0000-00-00" ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : date('d-m-Y')) }}">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">No. RM </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" name="nrm" value="{{ old('nrm', $dokumen->nrm) }}" disabled style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%">
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td style="width: 12%;">Alamat Rumah </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_alamat_pasien"
                                name="temp_alamat_pasien"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                value="{{ exists_value($penolakan_ranap, 'temp_alamat_pasien', $pasien->alamat) }}"
                            >
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td style="width: 12%;">No. Identitas/KTP </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_ktp_pasien"
                                name="temp_ktp_pasien"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                value="{{ exists_value($penolakan_ranap, 'temp_ktp_pasien', $pasien->ktp) }}"
                            >
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td style="width: 12%;">Alasan Menolak </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_alasan"
                                name="temp_alasan"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                value="{{ exists_value($penolakan_ranap, 'alasan') }}"
                            >
                        </td>
                    </tr>
                </table>

                <p class="mt-3">
                    Yang tujuan sifat dan perlunya PELAYANAN RAWAT INAP tersebut di atas, serta resiko yang dapat ditimbulkan telah cukup dijelaskan oleh dokter dan telah saya mengerti sepenuhnya. <br>
                    Demikian pernyataan penolakan ini saya buat dengan penuh kesadaran dan tanpa paksaan.
                </p>

                <p class="mt-5 text-right mb-5">
                    Bekasi, <input type="text" class="tanggal_dmy" id="temp_tanggal" name="temp_tanggal" value="{{ $penolakan_ranap ? date('d-m-Y', strtotime($penolakan_ranap->tanggal))  : date('d-m-Y') }}" style="border:1px solid transparent; border-bottom: 2px dotted; width: 5% background-color: transparent;">
                    Jam <input type="text" class="waktu_24" id="temp_jam" name="temp_jam" value="{{ $penolakan_ranap ? \Carbon\Carbon::parse($penolakan_ranap->jam)->format('H:i') : date('H:i') }}" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;">WIB
                </p>

                <p class="text-center mb-5">Saksi-saksi;</p>

                <div class="row justify-content-center mb-5">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 33%" class="text-center">
                                Perawat,
                                <br>
                                <button
                                    class="text-decoration-none bg-transparent" data-toggle="modal"
                                    data-target="#verif_modal" style="outline-width: 0; border: 0;">
                                    @if(empty($employee) || empty($dokumen->id_verifikator))
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    @else
                                        @if (isset($employee))
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}"
                                                style="height: 3.25cm; width: 4cm;" alt="">
                                                <br>
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                style="height: 3.25cm; width: 4cm;" alt="">
                                                <br>
                                        @endif
                                    @endif
                                    ({{ !empty($employee) ? $employee->nama : '............................................' }})
                                </button>
                            </td>
        
                            <td style="width: 33%" class="text-center">
                                Dokter yang menjelaskan,
                                <br>
                                <button
                                    class="text-decoration-none bg-transparent" data-toggle="modal"
                                    data-target="#verif_modal2" style="outline-width: 0; border: 0;">
                                    @if(empty($dokter))
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <span>(............................................)</span>
                                    @else
                                        @if (isset($dokter))
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokter->ttd }}"
                                                style="height: 3.25cm; width: 4cm;" alt="">
                                                <br>
                                            <span>({{ exists_value($dokter, 'nama', '............................................') }})</span>
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                style="height: 3.25cm; width: 4cm;" alt="">
                                                <br>
                                            <span>(............................................)</span>
                                        @endif
                                    @endif
                                </button>
                            </td>
        
                            <td style="width: 33%" class="text-center"
                                data-toggle="modal"
                                data-target="#sign_kerabat_modal">
                                yang menyatakan menolak,
                                <br>
                                @if(empty($penolakan_ranap->signature_kerabat))
                                <button
                                    class="text-decoration-none bg-transparent" style="outline-width: 0; border: 0;">
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <span>(............................................)</span>
                                </button>
                                @else
                                    <img
                                        src="{{ asset('signature_patient/'. ($penolakan_ranap->signature_kerabat ?? '')) }}"
                                        style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt=""
                                        data-toggle="modal"
                                        data-target="#sign_kerabat_modal"
                                    >
                                    <br>
                                    <span id="duplicate_nama_kerabat">
                                        ({{ exists_value($penolakan_ranap, 'nama_kerabat', '............................................') }})
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-md-12 text-center d-flex flex-column">
                        Saksi dari pihak pasien,
                        @if(empty($penolakan_ranap->signature_saksi))
                            <button
                                class="text-decoration-none bg-transparent"
                                data-toggle="modal"
                                data-target="#sign_saksi_modal"
                                style="outline-width: 0; border: 0;"
                                id="nama_saksi"
                            >
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                            </button>
                        @else
                            <img
                                src="{{ asset('signature_patient/'. ($penolakan_ranap->signature_saksi ?? '')) }}"
                                style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt=""
                                data-toggle="modal"
                                data-target="#sign_saksi_modal">
                        @endif
                        <span id="duplicate_nama_saksi">
                            ({{ exists_value($penolakan_ranap, 'nama_saksi', '............................................') }})
                        </span>
                    </div>
                </div>
                <p class="text-right">RSHM/DMT/09.00/Rev.01</p>
            </div>
        </div>
    </div>

    {{-- all hidden modals --}}


    <div class="modal fade" id="sign_saksi_modal" tabindex="-1" role="dialog" aria-labelledby="signModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signModalTitle">Tanda tangan Saksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" onsubmit="return konfirmasi_ttd_saksi(this)" action="{{ url('e_rekam_medis/detail/sign_penolakan_rawat_inap') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id_dokumen" value="{{$dokumen->id}}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Nama </h6>
                                <input type="text" class="form-control" name="nama_saksi" id="sign_nama_saksi">
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad-saksi" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature64-saksi" name="signature" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" class="clear-btn-signature btn btn-danger btn-sm">Clear Signature</button>
                            </div>
                        </div>
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sign_kerabat_modal" tabindex="-1" role="dialog" aria-labelledby="signModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signModalTitle">Tanda tangan Kerabat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" id="penolakan_ranap" action="{{ url('e_rekam_medis/detail/save_penolakan_rawat_inap') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id_dokumen" value="{{ $dokumen->id }}">
                        <input type="hidden" name="nama_pasien" id="nama_pasien">
                        <input type="hidden" name="alamat_pasien" id="alamat_pasien">
                        <input type="hidden" name="tempat_lahir_pasien" id="tempat_lahir_pasien">
                        <input type="hidden" name="tgl_lahir_pasien" id="tgl_lahir_pasien">
                        <input type="hidden" name="ktp_pasien" id="ktp_pasien">

                        <input type="hidden" name="nama_kerabat" readonly id="nama_kerabat">
                        <input type="hidden" name="alamat_kerabat" id="alamat_kerabat">
                        <input type="hidden" name="tempat_lahir_kerabat" id="tempat_lahir_kerabat">
                        <input type="hidden" name="tgl_lahir_kerabat" id="tgl_lahir_kerabat">
                        <input type="hidden" name="ktp_kerabat" id="ktp_kerabat">
                        <input type="hidden" name="telp_kerabat" id="telp_kerabat">
                        <input type="hidden" name="hubungan" id="hubungan">
                        <input type="hidden" name="alasan" id="alasan">
                        <input type="hidden" name="tanggal" id="tanggal">
                        <input type="hidden" name="jam" id="jam">
                        <input type="hidden" name="kelamin" id="kelamin">

                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Nama </h6>
                                <input type="text" class="form-control" name="nama_kerabat" id="sign_nama_kerabat">
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad-kerabat" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature64-kerabat" name="signature_kerabat" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                            </div>
                        </div>
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button onclick="konfirmasi_ttd_kerabat(this)" class="btn btn-success">Simpan</button>
                    </div>
                </form>
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
                <form method="post" action="{{ url('e_rekam_medis/detail/verif_penolakan_rawat_inap') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}"/>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="verif_modal2" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('e_rekam_medis/detail/verif_penolakan_rawat_inap2') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}"/>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    const oldPasien = @json($pasien);
    const pasienKeys = Object.keys(oldPasien);

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
    
    $('.tanggal_dmy').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        setUmur();
    });

    $('.tanggal_dmy').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    $('.waktu_24').daterangepicker({
        locale: {
            format: 'HH:mm',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('.waktu_24').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('HH:mm'));
    });

    $('.waktu_24').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    const signaturePadKerabat = new SignaturePad(document.getElementById('signature-pad-kerabat'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    const signaturePadSaksi = new SignaturePad(document.getElementById('signature-pad-saksi'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    function submit_form() {
        const tanggal = $('#temp_tanggal').val();
        const jam = $('#temp_jam').val();
        const isoDate = new Date(`${tanggal} ${jam}`).toISOString();
        $('#tanggal').val(isoDate);

        $('input[type="text"]').each(function() {
            const e = $(this)
            let id = e.attr('id')

            if (id && id.includes('temp_')) {
                id = id.replace('temp_', '')
                const newValue = e.val()

                console.log(`${id} => ${newValue}`)

                // if (
                //     (pasienKeys.includes(id) && newValue !== oldPasien[id]) ||
                //     !pasienKeys.includes(id) ||
                //     id === 'nama_pasien' && oldPasien.nama === newValue
                // ) {
                    $(`input#${id}`).val(newValue)
                // } else {
                //     console.log('exclude:', id)
                // }
            }
        });

        $('input[type="number"]').each(function() {
            const e = $(this)
            const id = e.attr('id').replace('temp_', '')
            $(`input#${id}`).val(e.val())
            console.log(`${id} => ${e.val()}`)
        });

        const hubungan = $('input[name="temp_hubungan"]:checked').attr('id').replace('radio_', '')
        $('input#hubungan').val(hubungan)

        $('#kelamin').val($('input[name="temp_kelamin"]:checked').val());

        $('form#penolakan_ranap').submit()
    }

    function konfirmasi_ttd_saksi() {
        const data = signaturePadSaksi.toDataURL('image/webp');

        if (!data || data === '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
            return;
        }

        $('#signature64-saksi').val(data);
    }

    function konfirmasi_ttd_kerabat() {
        const data = signaturePadKerabat.toDataURL('image/webp');
        if (!data || data === '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
            return;
        }

        $('#signature64-kerabat').val(data);
        submit_form()
    }

    function clear_signature() {
        signaturePadKerabat.clear();
        signaturePadSaksi.clear();
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Kode Anda di sini
        let oldTanggal = "{{ $penolakan_ranap->tanggal ?? '' }}" || Date.now();
        const created = new Date(oldTanggal);

        // formatting to yyyy-MM-dd
        const tanggal = new Intl.DateTimeFormat('en-CA', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        }).format(created);

        const jam = new Intl.DateTimeFormat('en-CA', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        }).format(created);

        $('input#temp_tanggal').val(tanggal);
        $('input#temp_jam').val(jam);
    })

    $('.clear-btn-signature').on('click', clear_signature);

    $('input#temp_nama_kerabat').on('change', function () {
        const value = $(this).val() ?? '............................................';
        $('#duplicate_nama_kerabat').text(`(${value})`)
        $('#sign_nama_kerabat').val(`${value}`)
    })

    //detect #sign_saksi_modal open
    $('#sign_saksi_modal')
        .on('shown.bs.modal', function (e) {
            // detect trigger button
            const trigger = $(e.relatedTarget);
            const inputNamaSaksi = $('#sign_nama_saksi');
            console.log('clicked from:', trigger);
            inputNamaSaksi.attr('name', trigger.attr('id'));
        })
        .on('hidden.bs.modal', function (e) {
            signaturePadSaksi.clear();
            $('#signature64-saksi').val('');
        });

    $('#sign_kerabat_modal').on('hidden.bs.modal', function (e) {
        signaturePadKerabat.clear();
        $('#signature64-kerabat').val('');
    });</script>
</html>
