<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Pulang APS</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
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
        @include('components.header-erm-dok-kunjungan')
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center">SURAT PERNYATAAN PULANG APS <br> (ATAS PERMINTAAN SENDIRI)</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <p>
                        Saya yang bertanda tangan dibawah ini:
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
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                    value="{{ old("nama_kerabat", !empty($sp_pulang_aps) ? $sp_pulang_aps->nama_kerabat : $pasien->nama) }}"
                                >
                            </td>
                        </tr>

                        <tr class="align-top">
                            <label for="temp_alamat_kerabat">
                                <td style="width: 12%;">Alamat</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input
                                        type="text"
                                        id="temp_alamat_kerabat"
                                        name="temp_alamat_kerabat"
                                        style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%"
                                        value="{{ old("alamat_kerabat", !empty($sp_pulang_aps) ? $sp_pulang_aps->alamat_kerabat : $pasien->alamat)  }}"
                                    >
                                </td>
                            </label>
                        </tr>
                    </table>

                    <p> Selaku
                        <label for="radio_diri_sendiri">
                            <input
                                type="radio"
                                id="radio_diri_sendiri"
                                name="temp_hubungan"
                                value="diri_sendiri"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'diri_sendiri') checked @endif
                            > Diri sendiri
                        </label>
                        <label for="radio_istri">
                            <input
                                type="radio"
                                id="radio_istri"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'istri') checked @endif
                            > Istri
                        </label>
                        <label for="radio_suami">
                            <input
                                type="radio"
                                id="radio_suami"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'suami') checked @endif
                            > Suami
                        </label>
                        <label for="radio_ayah">
                            <input
                                type="radio"
                                id="radio_ayah"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'ayah') checked @endif
                            > Ayah
                        </label>
                        <label for="radio_ibu">
                            <input
                                type="radio"
                                id="radio_ibu"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'ibu') checked @endif
                            > Ibu
                        </label>
                        <label for="radio_anak">
                            <input
                                type="radio"
                                id="radio_anak"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'anak') checked @endif
                            > Anak
                        </label>
                        <label for="radio_kaka">
                            <input
                                type="radio"
                                id="radio_kaka"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'kaka') checked @endif
                            > Kaka
                        </label>
                        <label for="radio_adik">
                            <input
                                type="radio"
                                id="radio_adik"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'adik') checked @endif
                            > Adik
                        </label>
                        <label for="radio_teman">
                            <input
                                type="radio"
                                id="radio_teman"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'teman') checked @endif
                            > Teman
                        </label>
                        <label for="radio_kerabat">
                            <input
                                type="radio"
                                id="radio_kerabat"
                                name="temp_hubungan"
                                @if(exists_value($sp_pulang_aps, 'hubungan') == 'kerabat') checked @endif
                            > Kerabat
                        </label>

                        dari pasien:
                    </p>

                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                        <tr class="align-top">
                            <td style="width: 12%;">Nama</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 70%;">
                                <input type="text" name="temp_nama_pasien" id="temp_nama_pasien" value="{{ $pasien->nama }}" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%">
                            </td>
                        </tr>

                        <tr class="align-top">
                            <td style="width: 12%;">No. RM</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="temp_nrm" id="temp_nrm" disabled value="{{ $dokumen->nrm }}" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 90%">
                                <label for="kelamin_l" style="pointer-events: none;">
                                    <input
                                        style="pointer-events: none;"
                                        type="radio"
                                        name="kelamin"
                                        readonly
                                        id="kelamin_l"
                                        value="0"
                                        @if($pasien->kelamin == 0) checked @endif
                                    > L
                                </label>
                                /
                                <label for="kelamin_p" style="pointer-events: none;">
                                    <input
                                        style="pointer-events: none;"
                                        type="radio"
                                        name="kelamin"
                                        readonly
                                        id="kelamin_p"
                                        value="1"
                                        @if($pasien->kelamin == 1) checked @endif
                                    > P
                                </label>
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 12%;">Tgl Lahir</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" readonly name="temp_tgl_lahir_pasien" id="temp_tgl_lahir_pasien" value="{{ $pasien->tgl_lahir }}" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent; width: 100%">
                            </td>
                        </tr>
                    </table>

                    <p class="mt-3">
                        Dengan ini menyatakan bahwa :
                        <ol>
                            <li class="mb-2">
                                Dengan sadar dan tanpa paksaan dari pihak manapun meminta pihak Rumah Sakit untuk PULANG ATAS PERMINTAAN SENDIRI yang merupakan bagian dari hak pasien, dengan alasan :
                                <input
                                    type="text"
                                    name="temp_alasan"
                                    id="temp_alasan"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; width: 60%; background-color: transparent;"
                                    value="{{ exists_value($sp_pulang_aps, 'alasan') }}"
                                >
                            </li>

                            <li class="mb-2">
                                Saya telah memahami sepenuhnya penjelasan yang diberikan dari pihak Rumah Sakit mengenai penyakit dan kemungkinan / konsekuensi terbaik sampai dengan terburuk atas keputusan yang saya ambil serta tanggung jawab saya dalam mengambil keputusan ini.
                            </li>

                            <li class="mb-2">
                                Apabila terjadi sesuatu hal berkaitan dengan putusan yang telah diambil, maka hal tersebut adalah menjadi tanggung jawab pasien/keluarga sepenuhnya dan tidak akan menyangkut - pautkan / menuntut Rumah Sakit.
                            </li>
                            <li>
                                Atas putusan saya ini, Rumah Sakit telah memberikan penjelasan mengenai alternatif pengobatan selanjutnya.
                            </li>
                        </ol>

                        Demikian pernyataan ini saya buat dengan sesungguhnya untuk diketahui dan digunakan sebagaimana perlunya.
                    </p>

                    <p class="mt-5 text-right mb-5">
                        Bekasi, <input type="date" name="temp_tanggal" id="temp_tanggal" style="border: hidden; border-bottom: 1px dotted" value="{{ old('tanggal') }}">, Jam <input type="time" name="temp_jam" id="temp_jam" style="border: hidden; border-bottom: 1px dotted" value="{{ old('jam') }}"> WIB
                    </p>

                    <div class="row justify-content-center mb-5">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 33%" class="text-center">
                                    Saksi 1
                                    <br>
                                    <button
                                            class="text-decoration-none bg-transparent"
                                            data-toggle="modal"
                                            data-target="#sign_saksi_modal"
                                            style="outline-width: 0; border: 0;"
                                            id="nama_saksi"   
                                        >
                                    @if(empty($sp_pulang_aps->signature_saksi))
                                        <!-- onclick="event.stopPropagation(); alert('Verifikasi Terlebih dahulu');" -->
                                            <br/>
                                            <br/>
                                            Klik disini
                                            <br/>
                                            <br/>
                                    @else
                                        <img
                                            src="{{ asset('signature_patient/'. ($sp_pulang_aps->signature_saksi ?? '')) }}"
                                            style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt="">
                                    @endif
                                    </button>
                                    <span id="duplicate_nama_saksi">
                                        <br>
                                        ({{ exists_value($sp_pulang_aps, 'nama_saksi', '............................................') }})
                                    </span>
                                </td>
                                <td style="width: 33%" class="text-center">
                                    Saksi 2
                                    <br>
                                    <button
                                            class="text-decoration-none bg-transparent"
                                            data-toggle="modal"
                                            data-target="#sign_saksi_modal"
                                            style="outline-width: 0; border: 0;"
                                            id="nama_saksi_2"
                                        >
                                    @if(empty($sp_pulang_aps->signature_saksi_2))                                        
                                            <br/>
                                            <br/>
                                            Klik disini
                                            <br/>
                                            <br/>
                                    @else
                                        <img
                                            src="{{ asset('signature_patient/'. ($sp_pulang_aps->signature_saksi_2 ?? '')) }}"
                                            style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt="">
                                    @endif
                                    </button>
                                    <span id="duplicate_nama_saksi_2">
                                        <br>
                                        ({{ exists_value($sp_pulang_aps, 'nama_saksi_2', '............................................') }})
                                    </span>
                                </td>
                                <td style="width: 33%" class="text-center">
                                    Yang membuat pernyataan
                                    <br>
                                    <button
                                            class="text-decoration-none bg-transparent"
                                            data-toggle="modal"
                                            data-target="#sign_kerabat_modal" style="outline-width: 0; border: 0;"
                                        >
                                    @if(empty($sp_pulang_aps->signature_kerabat))
                                        
                                            <br/>
                                            <br/>
                                            Verifikasi dan simpan
                                            <br>
                                            <br/>
                                            <br/>
                                    @else
                                        <img
                                            src="{{ asset('signature_patient/'. ($sp_pulang_aps->signature_kerabat ?? '')) }}"
                                            style="height: 3.25cm; width: auto; aspect-ratio: auto; object-fit: contain" alt=""
                                        >
                                    @endif
                                    </button>
                                    <span id="duplicate_nama_kerabat">
                                        <br>
                                        ({{ exists_value($sp_pulang_aps, 'nama_kerabat', $pasien->nama) }})
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                (*Coret yang Tidak Perlu)
            </div>
            <div class="col-md-6 text-right">
                RSHM/DMT/14/00/Rev.01
            </div>
        </div>
    </div>

    {{-- all modals & hidden elements --}}
    <div class="modal fade" id="sign_saksi_modal" tabindex="-1" role="dialog" aria-labelledby="signModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signModalTitle">Tanda tangan Saksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" onsubmit="return konfirmasi_ttd_saksi(this)" action="{{ url('e_rekam_medis/detail/sign_surat_pernyataan_pulang_aps') }}">
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

                <form method="POST" id="sp_pulang_aps" action="{{ url('e_rekam_medis/detail/verif_surat_pernyataan_pulang_aps') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id_dokumen" value="{{ $dokumen->id }}">
                        <input type="hidden" name="nama_pasien" id="nama_pasien">
                        <input type="hidden" name="alamat_pasien" id="alamat_pasien">
                        <input type="hidden" name="kelamin" id="kelamin">
                        <input type="hidden" name="tgl_lahir_pasien" id="tgl_lahir_pasien">
                        <input type="hidden" name="nama_kerabat" readonly id="nama_kerabat" value="{{ exists_value($sp_pulang_aps, 'nama_kerabat') }}">
                        <input type="hidden" name="alamat_kerabat" id="alamat_kerabat">
                        <input type="hidden" name="hubungan" id="hubungan">
                        <input type="hidden" name="alasan" id="alasan">
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
                                <button type="button" class="btn btn-danger btn-sm clear-btn-signature2">Clear Signature</button>
                            </div>
                        </div>
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button onclick="konfirmasi_ttd_kerabat(this)" class="btn btn-success">Simpan</button>
                    </div>
{{--                </form>--}}
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

                if (
                    (pasienKeys.includes(id) && newValue !== oldPasien[id]) ||
                    !pasienKeys.includes(id) ||
                    id === 'nama_pasien' && oldPasien.nama === newValue
                ) {
                    $(`input#${id}`).val(newValue)
                } else {
                    console.log('exclude:', id)
                }
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

        $('form#sp_pulang_aps').submit()
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
        signaturePadSaksi.clear();
    }

    function clear_signature2() {
        signaturePadKerabat.clear();
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Kode Anda di sini
        let oldTanggal = "{{ $sp_pulang_aps->tanggal ?? '' }}" || Date.now();
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

    $('.clear-btn-signature2').on('click', clear_signature2);

    $('input#temp_nama_kerabat').on('change', function () {
        const value = $(this).val() ?? '............................................';
        $('#duplicate_nama_kerabat').text(`(${value})`)
        $('#sign_nama_kerabat').val(`${value}`)
    })

    $(document).ready(function() {
        $('#sign_nama_kerabat').val('{{ $pasien->nama }}')
    });

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

    $('[name=temp_hubungan]').change(function(){
        if ($('[name=temp_hubungan]:checked').val() == 'diri_sendiri') {
            $('#temp_nama_kerabat').val('{{ $pasien->nama }}')
            $('#temp_alamat_kerabat').val('{{ $pasien->alamat }}')
            return;
        }
        $('#temp_nama_kerabat').val('')
        $('#temp_alamat_kerabat').val('')
    })
    
</script>
</html>
