<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serah Terima Bayi Rawat Gabung</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }

        .li-suggestion:hover {
            background-color: #e0e0e0;
        }

        .li-suggestion {
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body class="p-2">
    <div class="modal fade" id="modal_menerima" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="modal_menerima_form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{ $data['dokumen']->id }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Yang Menerima :</label>
                                <input type="text" class="form-control" value="" name="menerima" id="menerima"
                                    required />
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad-menerima" class="signature-pad"
                                    width=400 height=200></canvas>
                                <textarea id="menerima_signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button id="clear-menerima" type="button" class="btn btn-danger btn-sm">Clear
                                    Signature</button>
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

    <div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="modal_pasien_form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{ $data['dokumen']->id }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mengetahui :</label>
                                <input type="text" class="form-control" value="" name="mengetahui"
                                    id="mengetahui" required />
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400
                                    height=200></canvas>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button id="clear" type="button" class="btn btn-danger btn-sm">Clear
                                    Signature</button>
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

    <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="verifyForm" method="post"
                    action="{{ url('e_rekam_medis/rekam_medis/verifikasi_dokumen_kunjungan') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $data['dokumen']->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <table border="1" style="width: 100%;">
            <tbody>
                <tr>
                    <th style="width: 50%; padding-left: 20px; padding-top: 10px;">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo"
                            style="height: 112px;">
                        <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br>Kabupater
                            Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br>Email: info@rumahsakit-harapanmulia.id
                        </p>
                    </th>
                    <th style="width: 50%; padding-left: 20px;">
                        <table id="tabel_identitas">
                            <tbody>
                                <tr class="align-top">
                                    <td>Nama</td>
                                    <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                    <td>{{ $data['pasien']->nama }}</td>
                                </tr>
                                <tr class="align-top">
                                    <td>No. RM</td>
                                    <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                    <td>{{ $data['pasien']->nrm }}</td>
                                </tr>
                                <tr class="align-top">
                                    <td>Tgl Lahir</td>
                                    <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                    <td>{{ $data['pasien']->tgl_lahir }}</td>
                                </tr>
                                <tr class="align-top">
                                    <td>Jenis Kelamin</td>
                                    <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                    <td>{{ $data['pasien']->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr class="align-top">
                                    <td>NIK</td>
                                    <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                    <td>{{ $data['pasien']->ktp }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="text-right" style="font-weight: normal; padding-right: 20px;">
                            <i> *Tempel Label</i>
                        </p>
                    </th>
                </tr>
            </tbody>
        </table>

        <form action="{{ route('serah_terima_bayi_rawat_gabung.store') }}" method="POST">
            @csrf
            <input hidden name="nama_mengetahui" id="nama_mengetahui" />
            <textarea hidden name="ttd_mengetahui" id="ttd_mengetahui"></textarea>

            <input hidden name="nama_menerima" id="nama_menerima" />
            <textarea hidden name="ttd_menerima" id="ttd_menerima"></textarea>

            <input type="hidden" name="id_dokumen" value="{{ $data['dokumen']->id }}">
            <div class="container mt-3">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table table-bordered table-0 custom-table"
                    style="width: 100%;  border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" class="text-center"
                                style="background-color: lightgrey; margin-bottom:0; border-color: black;">SERAH TERIMA
                                BAYI RAWAT GABUNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="font-weight: bold;">
                            <td colspan="2" style="text-indent: 10px;">
                                <span> *beri tanda &#10004; pada tanda <input type="checkbox" disabled></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-indent: 10px;">
                                Berdasarkan observasi yang dilakukan bahwa bayi tersebut saat ini sudah diperbolehkan
                                untuk rawat gabung oleh dokter.
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px; width: 30%;">
                                Petugas yang Memberikan
                            </td>
                            <td style="width: 70%;">
                                {{-- <input name="petugas" type="text" class="form-control" --}}
                                {{--     value="{{ $data['data_serah_terima']->petugas ?? old('petugas') }}" required> --}}
                                <select class="select2" name="petugas" id="petugas" required>
                                    <option value="{{ $data['data_serah_terima']->petugas ?? old('petugas') }}">
                                        {{ $data['data_serah_terima']->petugas ?? old('petugas') }}</option>
                                    @foreach ($data['petugas'] as $ptg)
                                        <option value="{{ $ptg->nama }}">{{ $ptg->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px;">
                                Penerima Bayi
                            </td>
                            <td>
                                <input
                                    {{ ($data['data_serah_terima']->penerima_bayi ?? old('penerima_bayi')) == 'ayah' ? 'checked' : '' }}
                                    name="penerima_bayi" value="ayah" type="radio" required> Ayah
                                <input
                                    {{ ($data['data_serah_terima']->penerima_bayi ?? old('penerima_bayi')) == 'ibu' ? 'checked' : '' }}
                                    name="penerima_bayi" value="ibu" type="radio" required> Ibu
                                <input
                                    {{ ($data['data_serah_terima']->penerima_bayi ?? old('penerima_bayi')) == 'keluarga' ? 'checked' : '' }}
                                    name="penerima_bayi" id="penerima_bayi" value="keluarga" type="radio" required> keluarga : <input
                                    type="text" name="keluarga_penerima_bayi" id="keluarga_penerima_bayi"
                                    style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent"
                                    class="mb-2" 
                                    {{ ($data['data_serah_terima']->penerima_bayi ?? old('penerima_bayi')) == 'keluarga' ? '' : 'readonly' }}
                                    value="{{ $data['data_serah_terima']->keluarga_penerima_bayi ?? old('keluarga_penerima_bayi') }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px;">
                                Nama Bayi
                            </td>
                            <td>
                                <input name="nama_bayi" type="text" class="form-control"
                                    value="{{ $data['data_serah_terima']->nama_bayi ?? old('nama_bayi') }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px;">
                                Tgl Lahir
                            </td>
                            <td>
                                <input name="tgl_lahir" type="date" class="form-control"
                                    value="{{ $data['data_serah_terima']->tgl_lahir ?? old('tgl_lahir') }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px;">
                                Umur
                            </td>
                            <td>
                                <input name="umur" type="text" class="form-control"
                                    value="{{ $data['data_serah_terima']->umur ?? old('umur') }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px;">
                                Diagnosa
                            </td>
                            <td>
                                {{-- <input id="diagnosa" name="diagnosa" type="text" class="form-control"
                                    value="{{ $data['data_serah_terima']->diagnosa ?? old('diagnosa') }}" required>
                                <div id="diagnosis-suggestions"
                                    style="z-index: 99; display: block; position: absolute; background-color: #fff; padding-left: 2%;">
                                </div> --}}
                                <div class="input-group">
                                    <input type="text" 
                                        value="{{ $data['data_serah_terima']->diagnosa ?? old('diagnosa') }}"
                                        id="diagnosa" name="diagnosa" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button" onclick="open_modal_diagnosa()">
                                            <i class="fa fa-list"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px;">
                                Jenis Kelamin
                            </td>
                            <td>
                                <input
                                    {{ ($data['data_serah_terima']->jenis_kelamin ?? old('jenis_kelamin')) == 1 ? 'checked' : '' }}
                                    name="jenis_kelamin" type="radio" value="1"> Laki-laki <input
                                    name="jenis_kelamin" value="0" type="radio"
                                    {{ ($data['data_serah_terima']->jenis_kelamin ?? old('jenis_kelamin')) == 0 ? 'checked' : '' }}
                                    required>
                                Perempuan
                            </td>
                        </tr>
                        <tr>
                            <td style="text-indent: 10px;">
                                Tanggal Penyerahan
                            </td>
                            <td>
                                <input
                                    value="{{ isset($data['data_serah_terima']->tgl_penyerahan) ? date('Y-m-d', strtotime($data['data_serah_terima']->tgl_penyerahan)) : old('tgl_penyerahan') }}"
                                    type="date" name="tgl_penyerahan"> Jam : <input type="time"
                                    name="jam_penyerahan"
                                    value="{{ isset($data['data_serah_terima']->tgl_penyerahan) ? date('H:i', strtotime($data['data_serah_terima']->tgl_penyerahan)) : old('jam_penyerahan') }}"
                                    required> WIB
                            </td>
                        </tr>
                        <tr>
                            <td style="width:50%; text-align:center">
                                Yang Menyerahkan
                                <br>
                                <a onclick="open_modal_dokter()" style="cursor: pointer;">
                                    @if ($data['dokumen']->id_verifikator == 0)
                                        <br />
                                        <br />
                                        <br />
                                        <p>klik disini</p>
                                        <br />
                                        <br />
                                        (.................................................)
                                    @else
                                        @if (isset($data['employee']->ttd))
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $data['employee']->ttd }}"
                                                style="height: 4cm; width: 5cm;" alt="">
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                                style="height: 4cm; width: 5cm;" alt="">
                                        @endif
                                        <br>({{ $data['dokumen']->nama_verifikator }})
                                    @endif
                                </a>
                            </td>

                            <td style="width:50%; text-align:center">
                                Yang Menerima
                                <a onclick="open_modal_menerima()" style="cursor: pointer;">
                                    <div id="tmp-ttd-menerima">

                                    </div>
                                    <div id="ttd-show-menerima">

                                        @if (isset($data['data_serah_terima']->ttd_menerima))
                                            <img src="{{ asset('signature_patient/' . $data['data_serah_terima']->ttd_menerima) }}"
                                                alt="">
                                            <br>
                                        @else
                                            <br />
                                            <br />
                                            <br />
                                            <p>klik disini</p>
                                            <br />
                                            <br />
                                        @endif
                                    </div>
                                </a>
                                <label id="label-ttd-menerima">
                                    ({{ isset($data['data_serah_terima']->nama_menerima) ? $data['data_serah_terima']->nama_menerima : old('nama_menerima') ?? '............................................' }}
                                    ) </label><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style=" text-align:center">
                                Mengetahui
                                <a onclick="open_modal_pasien()" style="cursor: pointer;">

                                    <div id="tmp-ttd-mengetahui">

                                    </div>

                                    <div id="ttd-show-mengetahui">
                                        @if (isset($data['data_serah_terima']->ttd_mengetahui))
                                            <img style="max-width: 15vw;"
                                                src="{{ asset('signature_patient/' . $data['data_serah_terima']->ttd_mengetahui) }}"
                                                alt="">
                                            <br>
                                        @else
                                            <br />
                                            <br />
                                            <br />
                                            <p>klik disini</p>
                                            <br />
                                            <br />
                                        @endif
                                    </div>
                                </a>
                                <label id="label-ttd-mengetahui">
                                    ({{ isset($data['data_serah_terima']->nama_mengetahui) ? $data['data_serah_terima']->nama_mengetahui : old('nama_mengetahui') ?? '............................................' }}
                                    )</label><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-right">RSHM/RI/12.00/Rev.01</p>
            </div>
            <div class="text-center pb-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script> --}}
    <script>
        const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            minWidth: 3,
            maxWidth: 6,
            penColor: 'rgb(0, 0, 0)',
            maxWidth: 2
        });

        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.clear();
            $("#signature64").val('');
            $("#nama_pasien").val('');
        });

        const signaturePadMenerima = new SignaturePad(document.getElementById('signature-pad-menerima'), {
            minWidth: 3,
            maxWidth: 6,
            penColor: 'rgb(0, 0, 0)',
            maxWidth: 2
        });

        $('#clear-menerima').click(function(e) {
            e.preventDefault();
            signaturePadMenerima.clear();
            $("#menerima_signature64").val('');
            $("#menerima").val('');
        });

        function open_modal_dokter() {
            $('#modal_petugas').modal('show');
        }

        function open_modal_pasien() {
            $('#modal_pasien').modal('show');
        }

        function open_modal_menerima() {
            $('#modal_menerima').modal('show');
        }

        $(document).ready(function() {
            $('#diagnosa').on('input', function() {
                const searchTerm = $(this).val(); // Get the current search term

                if (searchTerm.length >=
                    2) { // Trigger AJAX only when search term is at least 2 characters long
                    $.ajax({
                        url: '{{ url('ajax_request/autocomplete_diagnosa') }}', // Replace with your actual URL
                        data: { // Send the search term as a parameter
                            query: searchTerm
                        },
                        method: 'GET', // Use the GET method
                        dataType: 'json', // Ensure the response is treated as JSON
                        success: function(response) { // Handle the successful AJAX response
                            //console.log(response.suggestions);
                            if (response && response.suggestions) {

                                const suggestions = response
                                    .suggestions; // Assuming your response contains a 'suggestions' array

                                // Clear any existing suggestions
                                $('#diagnosis-suggestions').empty();

                                // Create and append suggestion list items
                                if (suggestions.length > 0) {
                                    suggestions.forEach(suggestion => {
                                        const suggestionItem = $(
                                            '<li class="li-suggestion">').text(
                                            suggestion
                                            .value
                                        ); // Use suggestion.value for the full text
                                        suggestionItem.on('click', function() {
                                            $('#diagnosa').val(suggestion
                                                .value
                                            ); // Set the selected suggestion as the input value
                                            $('#diagnosis-suggestions')
                                                .empty(); // Clear the suggestion list
                                        });
                                        $('#diagnosis-suggestions').append(
                                            suggestionItem);
                                    });
                                } else {
                                    $('#diagnosis-suggestions').append(
                                        '<li>No suggestions found.</li>');
                                }
                            }
                        }
                    });
                }
            });

            $('#modal_pasien_form').on('submit', function(e) {
                e.preventDefault();

                let mengetahui = $('#mengetahui').val();
                let signed = signaturePad.toDataURL();
                // Access the container element using jQuery
                const $tmpTTDContainer = $('#tmp-ttd-mengetahui');
                $tmpTTDContainer.empty();

                // Create an img element
                const signatureImage = $('<img style="max-width:15vw;" >');

                // Set the data URL as the img element's source
                signatureImage.attr('src', signed);

                // Append the img element to the tmpTTDContainer
                $tmpTTDContainer.append(signatureImage);

                $('#ttd-show-mengetahui').hide();
                $('#nama_mengetahui').val(mengetahui);
                $('#ttd_mengetahui').text(signed);
                $('#label-ttd-mengetahui').text("(" + mengetahui + ")");
                $('#modal_pasien').modal('hide');
            });

            $('#modal_menerima_form').on('submit', function(e) {
                e.preventDefault();

                let menerima = $('#menerima').val();
                let signed = signaturePadMenerima.toDataURL();;
                // Access the container element using jQuery
                const $tmpTTDContainer = $('#tmp-ttd-menerima');
                $tmpTTDContainer.empty();

                // Create an img element
                const signatureImage = $('<img style="max-width:15vw;" >');

                // Set the data URL as the img element's source
                signatureImage.attr('src', signed);

                // Append the img element to the tmpTTDContainer
                $tmpTTDContainer.append(signatureImage);

                $('#ttd-show-menerima').hide();
                $('#nama_menerima').val(menerima);
                $('#ttd_menerima').text(signed);
                $('#label-ttd-menerima').text("(" + menerima + ")");
                $('#modal_menerima').modal('hide');
            });

            $('.select2').select2();

        });
        document.getElementById('verifyForm').addEventListener('submit', checkVerifyData);

        function checkVerifyData(event) {
            @if (!isset($data['data_serah_terima']->nama_menerima))
                event.preventDefault();
                $("#modal_petugas").modal("hide");
                alert('Data belum ditanda tangani penerima, silahkan ttd dan simpan untuk verifikasi');
            @endif
        }

        $('[name=penerima_bayi]').change(function() {
            if ($('[name=penerima_bayi]:checked').val() == 'keluarga') {
                $('#keluarga_penerima_bayi').removeAttr('readonly');
                return;
            }

            $('#keluarga_penerima_bayi').attr('readonly', true);
            $('#keluarga_penerima_bayi').val("");
        })

        function get_data_diagnosa() {
            if ($.fn.DataTable.isDataTable("#tabel_kepada")) {
                $('#tabel_kepada').DataTable().clear().destroy();
            }

            table = $('#tabel_kepada').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                "destroy": true,
                ajax: '{{ url("ajax_request/diagnosa") }}',
                columns: [
                    { // mengambil & menampilkan kolom sesuai tabel database
                        data: 'id',
                        name: 'id',
                        render(data, type, row, meta) {
                            return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</p>';
                        }
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        render(data, type, row) {
                            return '<p class="text-center">' + row.icd +" - "+ row.nama + '</p>';
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render(data, type, row) {
                            var fungsi_set = "";
                            fungsi_set = 'set_kepada(' + "'" + row.icd + "','" + row.nama + "'" + ')';
                            return '<div class="text-center"><button type="button" onclick="' + fungsi_set + '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                        }
                    }
                ]
            });
        }

        function open_modal_diagnosa() {
            get_data_diagnosa();
            $('#modal_diagnosa').modal('show');
        }

        function set_kepada(icd, nama) {
            $('#diagnosa').val(icd+" - "+nama);
            $('#modal_diagnosa').modal('hide');
        }
    </script>
</body>
</html>
