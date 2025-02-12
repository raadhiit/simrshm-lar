<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Penitipan Kelas</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>

    <style>
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

<body class="p-2">
@php
//dd('old values', [
//    'nama_kerabat' => old('nama_kerabat', !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->nama_kerabat : ''),
//    'alamat_kerabat' => old('alamat_kerabat', !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->alamat_kerabat : ''),
//    'telp_kerabat' => old('telp_kerabat', !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->telp_kerabat : ''),
//    'hubungan' => old('hubungan', !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : ''),
//    'kelas_lama' => old('kelas_lama', !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->kelas_lama : ''),
//    'kelas_baru' => old('kelas_baru', !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->kelas_baru : ''),
//]);
$is_other_relation = !empty($sp_penitipan_kelas) && !in_array($sp_penitipan_kelas->hubungan, \App\Models\SmisDocSuratPernyataanPenitipanKelas::CHOICES_HUBUNGAN);
@endphp

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

    <div class="container mt-3">
        @include('components.header-erm-dok-kunjungan', ['pasien' => $pasien, 'dokumen' => $dokumen])

        <div class="row py-5">
            <div class="col-md-12 text-center">
                <h3 class="mb-5">SURAT PERNYATAAN PENITIPAN KELAS</h3>
            </div>
            <div class="col-md-12">
                <p class="font-weight-bold">
                    Saya yang bertanda tangan dibawah ini:
                </p>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-middle">
                        <td style="width: 12%;">Nama</td>
                        <td class="text-center">:</td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_nama_kerabat"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ old("nama_kerabat", !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->nama_kerabat : '') }}"
                                onchange="$('#duplicate_nama_kerabat').text('('+ $(this).val() ?? '............................................' +')')"
                            >
                        </td>
                    </tr>

                    <tr class="align-middle">
                        <td style="width: 12%;">Alamat</td>
                        <td class="text-center">:</td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_alamat_kerabat"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ old("alamat_kerabat", !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->alamat_kerabat : '') }}"
                            >
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td style="width: 12%;">No. Telepon</td>
                        <td class="text-center">:</td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_telp_kerabat"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ old("telp_kerabat", !empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->telp_kerabat : '') }}"
                            >
                        </td>
                    </tr>
                </table>

                <div class="d-flex flex-column justify-content-center">
                    <div class="d-inline-flex align-items-center justify-content-between">
                        <div class="d-flex flex-nowrap">
                            <span class="d-flex align-items-center" style="margin-right: 4px;">Dengan ini menyatakan bahwa saya adalah</span>
                            <label for="hubungan_pasien" style="margin: 0 3px; display: flex; align-items: center;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    id="hubungan_pasien"
                                    value="pasien"
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "pasien") checked @endif
                                >
                                Pasien
                            </label>
                            <label for="hubungan_keluarga" style="margin: 0 3px; display: flex; align-items: center;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    id="hubungan_keluarga"
                                    value="keluarga"
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "keluarga") checked @endif
                                >
                                Keluarga
                            </label>
                            <label for="hubungan_bapak" style="margin: 0 3px; display: flex; align-items: center;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    id="hubungan_bapak"
                                    value="bapak"
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "bapak") checked @endif
                                >
                                Bapak
                            </label>
                            <label for="hubungan_ibu" style="margin: 0 3px; display: flex; align-items: center;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    id="hubungan_ibu"
                                    value="ibu"
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "ibu") checked @endif
                                >
                                Ibu
                            </label>
                            <label for="hubungan_suami" style="margin: 0 3px; display: flex; align-items: center;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    id="hubungan_suami"
                                    value="suami"
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "suami") checked @endif
                                >
                                Suami
                            </label>
                            <label for="hubungan_istri" style="margin: 0 3px; display: flex; align-items: center;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    id="hubungan_istri"
                                    value="istri"
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "istri") checked @endif
                                >
                                Istri
                            </label>
                            <label for="hubungan_anak" style="margin: 0 3px; display: flex; align-items: center;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    id="hubungan_anak"
                                    value="anak"
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "anak") checked @endif
                                >
                                Anak
                            </label>
                        </div>

                        <div class="d-inline-flex align-items-center" style="width: fit-content;">
                            <label for="other" class="d-inline-flex align-items-center align-middle" style="margin-bottom: 0;">
                                <input
                                    type="radio"
                                    name="temp_hubungan"
                                    value="other"
                                    id="hubungan_other"
                                    {{-- {{ old("hubungan") ? (old("hubungan") == "other" ? "checked" : '') : ($sp_penitipan_kelas ? ($sp_penitipan_kelas->hubungan == "other" ? "checked" : '') : '')  }} --}}
                                    @if(old('hubungan',!empty($sp_penitipan_kelas) ? $sp_penitipan_kelas->hubungan : '') == "other") checked @endif
                                    >
                                Lainnya
                                <input type="text" id="temp_ket_hubungan" value="{{ old("ket_hubungan") ? old("ket_hubungan") : ($sp_penitipan_kelas ? $sp_penitipan_kelas->ket_hubungan : '') }}" style="margin-left: 4px; width: 50%; border: 0; border-bottom: 1px dotted #000">
                                Dari pasien:
                            </label>
                        </div>
                    </div>
                </div>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-middle">
                        <td style="width: 12%;">Nama</td>
                        <td class="text-center">:</td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_nama_pasien"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ old("nama_pasien", $pasien->nama ?? '') }}"
                            >
                        </td>
                    </tr>

                    <tr class="align-middle">
                        <td style="width: 12%;">Umur</td>
                        <td class="text-center">:</td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_umur_pasien"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ old('umur_pasien', $pasien->age ?? '')  }}"
                            >
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td style="width: 12%;">Alamat</td>
                        <td class="text-center">:</td>
                        <td style="width: 85%;">
                            <input
                                type="text"
                                id="temp_alamat_pasien"
                                readonly
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                value="{{ old('alamat_pasien', $pasien->alamat ?? '')  }}"
                            >
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td style="width: 12%;">No. Telepon</td>
                        <td class="text-center">:</td>
                        <td style="width: 85%;">
                            <input
                                type="number"
                                id="temp_telp_pasien"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control"
                                value="{{ old('telp_pasien', $pasien->telpon ?? '')  }}"
                            >
                        </td>
                    </tr>
                </table>

                <p class="mt-3">
                    Menyatakan bahwa Hak Pasien Kelas
                    (<input type="text" id="temp_kelas_lama" value="{{ old('kelas_lama', !empty($sp_penitipan_kelas->kelas_lama) ? $sp_penitipan_kelas->kelas_lama : '' ) }}" style="border:1px solid transparent; border-bottom: 2px dotted; width: 20%; background-color: transparent;">)
                    bersedia untuk dititip di kelas
                    (<input type="text" id="temp_kelas_baru" value="{{ old('kelas_baru', !empty($sp_penitipan_kelas->kelas_baru) ? $sp_penitipan_kelas->kelas_baru : '' ) }}" style="border:1px solid transparent; border-bottom: 2px dotted; width: 20%; background-color: transparent;">)
                    untuk sementara waktu sampai Hak Kelas dari pasien tersedia. Demikian Surat pernyataan ini kami buat sebenarnya dalam keadaan sadar tanpa ada paksaan dari siapapun.
                </p>

                <p class="mt-5 text-right mb-5">
                    Cibarusah, <input placeholder="DD-MM-YYYY" id="temp_tanggal" value="{{ empty($sp_penitipan_kelas) ? \Carbon\Carbon::now()->format('d-m-Y') : \Carbon\Carbon::parse($sp_penitipan_kelas->tanggal)->format('d-m-Y')  }}" style="border:1px solid transparent; border-bottom: 2px dotted; width: 10%; background-color: transparent;">
                </p>

                <div class="row justify-content-center mb-5">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 33%" class="text-center">
                                Petugas Pendaftaran
                                <br>
                                <button
                                    class="text-decoration-none bg-transparent" data-toggle="modal"
                                    data-target="#verif_modal" style="outline-width: 0; border: 0;"
                                >
                                    @if(empty($employee) || empty($dokumen->id_verifikator))
                                        <br>
                                        <br>
                                        Simpan & Verifikasi
                                        <br>
                                        <br>
                                        ('............................................')
                                    @else
                                        @if (isset($employee))
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}"
                                                style="height: 3.25cm; width: 4cm;" alt="">
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                style="height: 3.25cm; width: 4cm;" alt="">
                                        @endif
                                        <br>({{ $dokumen->nama_verifikator }})
                                    @endif
                                </button>
                            </td>
        
                            <td style="width: 33%" class="text-center"
                                    data-toggle="modal"
                                    data-target="#sign_saksi_modal">
                                Saksi
                                <br>
                                @if(empty($sp_penitipan_kelas->signature_saksi))
                                    <button
                                        class="text-decoration-none bg-transparent"
                                        style="outline-width: 0; border: 0;"
                                    >
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                    </button>
                                @else
                                    <img
                                        src="{{ asset('signature_patient/'. ($sp_penitipan_kelas->signature_saksi ?? '')) }}"
                                        style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt="">
                                    <br>
                                @endif
                                <span id="duplicate_nama_saksi">
                                    @if(!empty($sp_penitipan_kelas->nama_saksi))
                                        ({{ $sp_penitipan_kelas->nama_saksi }})
                                    @else
                                    (............................................)
                                    @endif
                                </span>
                                <br>
                            </td>
        
                            <td style="width: 33%" class="text-center">
                                Yang membuat pernyataan
                                <br>
                                <button
                                        class="text-decoration-none bg-transparent"
                                        data-toggle="modal"
                                        data-target="#sign_kerabat_modal" style="outline-width: 0; border: 0;"
                                    >
                                @if(empty($sp_penitipan_kelas->signature_kerabat))
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                @else
                                    <img
                                        src="{{ asset('signature_patient/'. ($sp_penitipan_kelas->signature_kerabat ?? '')) }}"
                                        style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt="">
                                        <br>
                                @endif
                                <span id="duplicate_nama_kerabat">
                                    @if(!empty($sp_penitipan_kelas->nama_kerabat))
                                        ({{ $sp_penitipan_kelas->nama_kerabat }})
                                    @else
                                    (............................................)
                                    @endif
                                </span>
                                </button>
                                <br>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="verif_modal" tabindex="-1" role="dialog" aria-labelledby="verifModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifModalTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" onsubmit="submit_form()" id="sp_penitipan_kelas" action="{{ url('e_rekam_medis/detail/verif_surat_pernyataan_penitipan_kelas') }}">
                    @csrf
                    <input type="hidden" name="id_dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="tanggal" id="tanggal">
                    <input type="hidden" name="nama_kerabat" id="nama_kerabat">
                    <input type="hidden" name="alamat_kerabat" id="alamat_kerabat">
                    <input type="hidden" name="telp_kerabat" id="telp_kerabat">
                    <input type="hidden" name="hubungan" id="hubungan">
                    <input type="hidden" name="ket_hubungan" id="ket_hubungan">
                    <input type="hidden" name="nama_pasien" id="nama_pasien">
                    <input type="hidden" name="alamat_pasien" id="alamat_pasien">
                    <input type="hidden" name="telp_pasien" id="telp_pasien">
                    <input type="hidden" name="kelas_lama" id="kelas_lama">
                    <input type="hidden" name="kelas_baru" id="kelas_baru">
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

    <div class="modal fade" id="sign_saksi_modal" tabindex="-1" role="dialog" aria-labelledby="signModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signModalTitle">Tanda tangan Saksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" onsubmit="return konfirmasi_ttd_saksi(this)" action="{{ url('e_rekam_medis/detail/sign_surat_pernyataan_penitipan_kelas') }}">
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
                    <h5 class="modal-title" id="signModalTitle">Tanda tangan Yang Menyatakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" onsubmit="return konfirmasi_ttd_kerabat(this)" action="{{ url('e_rekam_medis/detail/sign_surat_pernyataan_penitipan_kelas') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id_dokumen" value="{{ $dokumen->id }}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Nama </h6>
                                <input type="text" class="form-control" name="nama_kerabat" id="sign_nama_kerabat">
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad-kerabat" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature64-kerabat" name="signature" style="display: none"></textarea>
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
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
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

    document.addEventListener('DOMContentLoaded', function() {
        // const tanggal = "{{ $sp_penitipan_kelas->tanggal ?? '' }}" || new Date().toISOString()
        // const formatted = new Date(tanggal).toLocaleDateString('en-GB')

        // $('input#temp_tanggal').val(formatted)

        $('#temp_tanggal').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
        })
    })

    $('.clear-btn-signature').on('click', clear_signature);

    function submit_form() {
        var tanggal = $('#temp_tanggal').val();
        $('input#tanggal').val(tanggal.split("-").reverse().join("-"))

        $('input[type="text"]').each(function() {
            const e = $(this)
            const id = e.attr('id').replace('temp_', '')

            $(`input#${id}`).val(e.val())
        });

        $('input[type="number"]').each(function() {
            const e = $(this)
            const id = e.attr('id').replace('temp_', '')

            $(`input#${id}`).val(e.val())
        });

        const hubungan = $('input[name="temp_hubungan"]:checked').val()
        // if (hubungan === 'other') {
        //     $('input#hubungan').val($('input#temp_hubungan').val())
        // } else {
            $('input#hubungan').val(hubungan)
        // }
    }

    function konfirmasi_ttd_saksi() {
        const data = signaturePadSaksi.toDataURL('image/png');

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
        const data = signaturePadKerabat.toDataURL('image/png');
        if (!data || data === '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
            return;
        }

        $('#signature64-kerabat').val(data);
    }

    function clear_signature() {
        signaturePadKerabat.clear();
        signaturePadSaksi.clear();
    }
</script>
</html>
