<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Naik Kelas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>
    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }
/* nama_kerabat */
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
@endphp
    <div class="container mt-3">
        @include('components.header-erm-dok-kunjungan')

        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center mt-5 mb-3"> SURAT PERNYATAAN NAIK KELAS</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                    <p class="font-weight-bold">
                        Saya yang bertanda tangan dibawah ini:
</p>
<?php $sp_naik_kelas = $dokumen->surat_pernyataan_naik_kelas ? $dokumen->surat_pernyataan_naik_kelas : null; ?> 
                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                        <tr class="align-top">
                            <td style="width: 12%;">Nama</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="text"
                                    name="temp_nama_kerabat"
                                    id="temp_nama_kerabat"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'nama_pengampu') }}"
                                >
                            </td>
                        </tr>

                        <tr class="align-top">
                            <td style="width: 12%;">Alamat</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="text"
                                    name="temp_alamat_kerabat"
                                    id="temp_alamat_kerabat"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'alamat_pengampu') }}"
                                >
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 12%;">No. Telepon</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="number"
                                    name="temp_telp_kerabat"
                                    id="temp_telp_kerabat"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'telp_pengampu') }}"
                                >
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 12%;">Hubungan dengan Pasien</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="text"
                                    name="temp_hubungan"
                                    id="temp_hubungan"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'hubungan') }}"
                                >
                            </td>
                        </tr>
                    </table>

                    <p class="font-weight-bold">
                        Menerangkan bahwa :
                    </p>

                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                        <tr class="align-top">
                            <td style="width: 12%;">Nama</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="text"
                                    name="temp_nama_pasien"
                                    id="temp_nama_pasien"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'nama_pasien', $pasien->nama) }}"
                                >
                            </td>
                        </tr>

                        <tr class="align-top">
                            <td style="width: 12%;">No BPJS</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="text"
                                    name="temp_nobpjs_pasien"
                                    id="temp_nobpjs_pasien"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'nobpjs_pasien', $pasien->nobpjs) }}"
                                >
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 12%;">Hak kelas Rawat </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="text"
                                    name="temp_hak_kelas_rawat"
                                    id="temp_hak_kelas_rawat"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'hak_kelas') }}"
                                >
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 12%;">Kelas Rawat yang di Tempati</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input
                                    type="text"
                                    name="temp_kelas_rawat_sekarang"
                                    id="temp_kelas_rawat_sekarang"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                    class="form-control"
                                    value="{{ exists_value($sp_naik_kelas, 'kelas_ditempati') }}"
                                >
                            </td>
                        </tr>
                    </table>

                    <p class="mt-3">
                        Bahwa yang bersangkutan telah memilih kamar dengan tarif lebih tinggi atas dasar keinginan sendiri. <br>
                        Bersama ini saya mengetahui seluruh resiko selisih biaya perawatan yang akan terjadi: <br>
                        <ol>
                            <li>
                                Jika pasien hak rawat kelas 2 naik ke kelas 1 maka pasien harus membayar selisih antara tarif INA-CBG kelas 1 dengan kelas 2
                            </li>
                            <li>
                                Jika pasien hak rawat kelas 1 naik ke VIP maka pasien harus membayar selisih sebesar 75% dari tarif INA-CBG kelas 1
                            </li>
                            <li>
                                Jika pasien hak rawat kelas 2 naik ke VIP maka pasien harus membayar selisih antara tarif INA-CBG kelas 1 dengan kelas 2 ditambah 75% dari tarif INA-CBG kelas 1
                            </li>
                        </ol>
                        Demikian surat pernyataan ini dibuat atas permintaan sendiri dengan tanpa paksaan dari pihak manapun. Terima Kasih.
                    </p>

                    <p class="mt-5 text-right mb-5">
                        Cibarusah, <input type="date" id="temp_tanggal" name="temp_tanggal" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">
                    </p>

                    <div class="row justify-content-center mb-5">
                        <div class="col-md-4 text-center d-flex flex-column ">
                            Petugas Pendaftaran
                            <button
                                class="text-decoration-none bg-transparent" data-toggle="modal"
                                data-target="#verif_modal" style="outline-width: 0; border: 0;"
                            >
                                @if(empty($employee))
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                @else
                                    @if(isset($employee))
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                                style="height: 3.25cm; width: 4cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>
                                @endif
                                ({{ !empty($employee) ? $employee->nama : '............................................' }})
                            </button>
                            <br>
                        </div>

                        <div class="col-md-4 text-center d-flex flex-column"
                            data-toggle="modal"
                            data-target="#sign_saksi_modal">
                            Saksi
                            @if(empty($sp_naik_kelas->ttd_saksi))
                                <button
                                    class="text-decoration-none bg-transparent"
                                    style="outline-width: 0; border: 0;" id="nama_saksi">
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                </button>
                            @else
                                <img
                                    src="{{ asset('signature_patient/'. ($sp_naik_kelas->ttd_saksi ?? '')) }}"
                                    style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt="">
                            @endif
                            <span id="duplicate_nama_saksi">
                                ({{ exists_value($sp_naik_kelas, 'nama_saksi', '............................................') }})
                            </span>
                            <br>
                        </div>
                        <div class="col-md-4 text-center d-flex flex-column"
                            data-toggle="modal"
                            data-target="#sign_kerabat_modal">
                            Yang membuat pernyataan
                            @if(empty($sp_naik_kelas->ttd_pernyataan))
                                <button class="text-decoration-none bg-transparent" style="outline-width: 0; border: 0;">
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                </button>
                            @else
                                <img
                                    src="{{ asset('signature_patient/'. ($sp_naik_kelas->ttd_pernyataan ?? '')) }}"
                                    style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt=""
                                >
                            @endif
                            <span id="duplicate_nama_kerabat">
                                ({{ exists_value($sp_naik_kelas, 'nama_pernyataan', '............................................') }})
                            </span>
                            <br>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    {{-- modals --}}
    <div class="modal fade" id="sign_saksi_modal" tabindex="-1" role="dialog" aria-labelledby="signModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signModalTitle">Tanda tangan Saksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" onsubmit="return konfirmasi_ttd_saksi(this)" action="{{ url('e_rekam_medis/detail/sign_surat_pernyataan_naik_kelas') }}">
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

                <form method="POST" id="sp_naik_kelas" action="{{ url('e_rekam_medis/detail/save_surat_pernyataan_naik_kelas') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id_dokumen" value="{{ $dokumen->id }}">
                        <input type="hidden" name="nama_pasien" id="nama_pasien">

                        <input type="hidden" name="nama_kerabat" readonly id="nama_kerabat" value="{{ exists_value($sp_naik_kelas, 'nama_pengampu') }}">
                        <input type="hidden" name="alamat_kerabat" id="alamat_kerabat">
                        <input type="hidden" name="telp_kerabat" id="telp_kerabat">
                        <input type="hidden" name="hubungan" id="hubungan">
                        <input type="hidden" name="nobpjs_pasien" id="nobpjs_pasien">
                        <input type="hidden" name="hak_kelas_rawat" id="hak_kelas_rawat">
                        <input type="hidden" name="kelas_rawat_sekarang" id="kelas_rawat_sekarang">
                        <input type="hidden" name="tanggal" id="tanggal">

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
                <form method="post" id="verif-form" action="{{ url('e_rekam_medis/detail/verif_surat_pernyataan_naik_kelas') }}">
                    @csrf
                    <input type="hidden" name="id_dokumen" value="{{$dokumen->id}}"/>

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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    const oldPasien = @json($pasien);
    const pasienKeys = Object.keys(oldPasien);

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

    function load_form_data(outside = null) {
        const tanggal = $('#temp_tanggal').val();
        const jam = $('#temp_jam').val() ?? '00:00:00';

        const date = new Date(`${tanggal} ${jam}`)
        date.setMinutes(date.getMinutes() - date.getTimezoneOffset())

        const newTanggal = date.toISOString();
        $('#tanggal').val(newTanggal);
        if (outside) {
            $(`form#${outside}`).append(`<input type="hidden" name="tanggal" value="${newTanggal}">`);
        }

        $('input[type="text"]').each(function() {
            const e = $(this)
            let id = e.attr('id')

            if (id && id.includes('temp_')) {
                id = id.replace('temp_', '')
                const newValue = e.val()

                if (
                    (pasienKeys.includes(id) && newValue !== oldPasien[id]) ||
                    !pasienKeys.includes(id) ||
                    id === 'nama_pasien' && oldPasien.nama === newValue
                ) {
                    const input = $(`input#${id}`)
                    input.val(newValue)

                    if (outside) {
                        const newInput = input.clone()
                        newInput.attr('id', `verif_${id}`)

                        $(`form#${outside}`).append(newInput)
                    }
                }
            }
        });

        $('input[type="number"]').each(function() {
            const e = $(this)
            const id = e.attr('id').replace('temp_', '')
            const input = $(`input#${id}`)
            input.val(e.val())

            if (outside) {
                const newInput = input.clone()
                newInput.attr('id', `verif_${id}`)

                $(`form#${outside}`).append(newInput)
            }
        });
    }

    function submit_form() {
        load_form_data()
        $('form#sp_naik_kelas').submit()
    }

    function submit_verif() {
        load_form_data('verif-form')
        $('form#verif_form').submit()
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
        let oldTanggal = "{{ $sp_naik_kelas->tanggal ?? '' }}" || Date.now();
        const created = new Date(oldTanggal);

        // formatting to yyyy-MM-dd
        const tanggal = new Intl.DateTimeFormat('en-CA', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
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
    });
</script>
</html>
