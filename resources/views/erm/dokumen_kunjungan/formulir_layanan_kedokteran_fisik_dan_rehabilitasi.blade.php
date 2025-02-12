<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Formulir Layanan Kedokteran Fisik dan Rehabilitasi</title>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        .custom-table td{
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }
        .custom-table th{
            border-color: black;
        }
        
        #box_ttd:hover {
            cursor: pointer;
        }
        
        .input-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Adjust the gap between elements as needed */
            vertical-align: middle;
        }
        
        .input-container input[type="text"],
        .input-container input[type="date"],
        .input-container input[type="time"] {
            margin-bottom: 0; /* Override the margin-bottom set by the form-control class */
            align-items: center;
        }
        
        .input-container label {
            margin-right: 5px; /* Adjust the space between labels and inputs */
        }
        
        .text-input {
            flex: 1; /* This makes the text input take up remaining space */
        }
        
        .date-input,
        .time-input {
            width: 150px; /* Set a fixed width for date and time inputs */
        }
        
        .signature-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .signature-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .signature-box {
            /* border: 2px solid #000; */
            padding: 20px;
            cursor: pointer;
            width: 200px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .signature-box img {
            max-width: 100%;
            max-height: 100%;
        }
        
        .signature-placeholder {
            text-align: center;
        }
        
        .name-box {
            flex: 1;
            display: flex;
            height: 100px;
            align-items: center;
            justify-content: left;
        }
        
        .slash {
            font-size: 24px;
            margin: 0 10px;
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
    </style>
</head>

<body class="p-2">
    @if(Session::has('message'))
    <script>
        alert('{{ Session::get("message") }}');
    </script>
    @endif
    <div class="container">
        <form action="" id="form_dokumen" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
            <input type="hidden" name="password">
            {{-- <div class="row">
                <div class="col-12 text-right">MR 02.01.007.REV 0</div>
            </div> --}}
            <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
                <div class="col-lg-8">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                    {{-- <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Telp.: (021) 8995 2340, Fax: (021) 8995 2340</p> --}}
                </div>
                <div class="col-lg-4 pt-3 pl-3">
                    <div class="col-12 text-right">MR 03.21.001.Rev.0</div>
                    {{-- <div style="border: 1px solid; border-radius: 20px; padding:15px;">
                        <table>
                            <tr class="align-top">
                                <td>Nama</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $layanan->nama_pasien }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>No. RM</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $dokumen->nrm }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tgl Lahir</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis Kelamin</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>NIK</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->ktp }}</td>
                            </tr>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="container">
            <hr style="border: 1px solid black;">
        </div>    
        <div class="container">
            <h6 class="text-center bol my-3"> Lembar Formulir <br> Layanan Kedokteran Fisik dan Rehabilitasi</h6>
            <div style="border:1px solid; padding: 5px;" class="">
                <div class="row">
                    <div class="col-md-6">
                        1. Diisi Oleh Pasien/Peserta
                    </div>
                    <div class="col-md-6 text-right">
                        No. Rekam Medis : {{ $layanan->nrm }}
                    </div>
                    <div class="col-md-12">
                        <table style="border-collapse: collapse; width:100%" class="mb-3">
                            <tr class="align-top">
                                <td style="width: 12%; padding-left: 15px;">Nama Pasien</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%; border-bottom: 1px dotted"> 
                                    {{ $layanan->nama_pasien }}
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 12%; padding-left: 15px;">Tanggal Lahir</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%; border-bottom: 1px dotted">
                                    {{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 12%; padding-left: 15px;">Alamat</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%; border-bottom: 1px dotted">
                                    {{ $pasien->alamat}}
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 12%; padding-left: 15px;">Telp/HP</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%; border-bottom: 1px dotted">
                                    {{ $pasien->telpon}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <span style="padding-left: 15px">
                    Hubungan dengan tertanggung: 
                    <input {{ $data ? ($data->radio_hubungan == 'Pribadi' ? 'checked' : '') : '' }}
                        type="radio" value="Pribadi" name="radio_hubungan"> Pribadi
                    <input {{ $data ? ($data->radio_hubungan == 'suami_istri' ? 'checked' : '') : '' }}
                        type="radio" value="suami_istri" name="radio_hubungan" class="ml-4"> Suami/Istri
                    <input {{ $data ? ($data->radio_hubungan == 'anak' ? 'checked' : '') : '' }}
                        type="radio" value="anak" name="radio_hubungan" class="ml-4"> Anak
                    {{-- <input type="checkbox" name="hubungan" {{ $data && $data->hubungan == 'on' ? 'checked' : '' }}>Pribadi &nbsp;&nbsp;
                    <input type="checkbox" name="hubungan" {{ $data && $data->suami == 'on' ? 'checked' : '' }}> Suami/Istri  &nbsp;&nbsp;
                    <input type="checkbox" name="hubungan" {{ $data && $data->anak == 'on' ? 'checked' : '' }}> Anak --}}
                </span>
            </tr>
        </div>
    </div>
    
    <div class="container mt-3">
        <div style="border:1px solid; padding: 5px;" class="">
            2. Diisi Oleh Dokter Sp.KFR <br/>
            &nbsp;&nbsp;&nbsp;Tanggal Pelayanan : <input style="margin-top: 8px; border: hidden; border-bottom: 1px dotted" type="text" name="tanggal_pelayanan" class="mb-2 tanggal_dmy" value="{{ $data ? $data->tanggal_pelayanan : '' }}">
            <div class="row">
                <div class="col-md-12">
                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                        <tr class="align-top">
                            <td style="width: 25%;">
                                <ul>
                                    <li>Anamnesa</li>
                                </ul>
                            </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 72%;"> 
                                <input type="text" name="anamnesa" value="{{ $data ? $data->anamnesa : ($data_cppt ? $data_cppt->subjective : '') }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 30%;">
                                <ul>
                                    <li>Pemeriksaan Fisik dan Uji Fungsi</li>
                                </ul>
                            </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 72%;"> 
                                <input type="text" name="pemeriksaan_fisik" value="{{ $data ? $data->pemeriksaan_fisik : ($data_cppt ? $data_cppt->objective_lain : '') }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 25%;">
                                <ul>
                                    <li>Diagnosis Medis (ICD-10) </li>
                                </ul>
                            </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 72%;"> 
                                <input type="text" id="diagnosa_medis" name="diagnosa_medis" value="{{ $data ? $data->diagnosa_medis : ($data_cppt && isset($data_cppt->diagnosa) ? $data_cppt->diagnosa->kode_icd." - ".$data_cppt->diagnosa->nama_icd : '') }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 25%;">
                                <ul>
                                    <li>Diagnosis Fungsi (ICD-10)</li>
                                </ul>
                            </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 72%;"> 
                                <input type="text" id="diagnosa_fungsi" name="diagnosa_fungsi" value="{{ $data ? $data->diagnosa_fungsi : ($data_cppt && isset($data_cppt->diagnosa) ? $data_cppt->diagnosa->kode_icd." - ".$data_cppt->diagnosa->nama_icd : '') }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 25%;">
                                <ul>
                                    <li>Pemeriksaan Penunjang</li>
                                </ul>
                            </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 72%;"> 
                                @php
                                    $lab_rad = "";
                                @endphp
                                @if (isset($data_cppt->lab))
                                    @php
                                        $iterasi_pesanan_lab = 0;
                                        $pesan = '';
                                    @endphp
                                        <?php $yang_dipesan = json_decode($data_cppt->lab->periksa); ?>
                                    @foreach ($pemeriksaan as $pem)
                                        @php
                                            $temp_slug = $pem->slug;
                                        @endphp
                                        @if ($yang_dipesan->$temp_slug == 1)
                                            @if ($iterasi_pesanan_lab > 0)
                                                @php
                                                    $pesan .= ', ' . $pem->nama;
                                                @endphp
                                            @else
                                                @php
                                                    $pesan .= $pem->nama;
                                                @endphp
                                            @endif
                                            @php
                                                $iterasi_pesanan_lab++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $lab_rad .= $pesan;
                                    @endphp
                                @endif
                                @if (isset($data_cppt->rad))
                                    @php
                                        $iterasi_pesanan_radiologi = 0;
                                        $pesan_radiologi = '';
                                    @endphp
                                        <?php $yang_dipesan = json_decode($data_cppt->rad->periksa); ?>
                                    @foreach ($pemeriksaan_radiologi as $pemrad)
                                        @php
                                            $temp_slug = 'rad_' . $pemrad->id;
                                        @endphp
                                        @if ($yang_dipesan->$temp_slug == 1)
                                            @if ($iterasi_pesanan_radiologi > 0)
                                                @php
                                                    $pesan_radiologi .= ', ' . $pemrad->nama;
                                                @endphp
                                            @else
                                                @php
                                                    $pesan_radiologi .= $pemrad->nama;
                                                @endphp
                                            @endif
                                            @php
                                                $iterasi_pesanan_radiologi++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        if (empty($lab_rad)) {
                                            $lab_rad .= $pesan_radiologi;
                                        } else {
                                            $lab_rad .= " | ". $pesan_radiologi;
                                        }
                                    @endphp
                                @endif
                                <input type="text" name="pemeriksaan_penunjang" value="{{ $data ? $data->pemeriksaan_penunjang : $lab_rad }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 25%;">
                                <ul>
                                    <li>Tata Laksana KFR (ICD 9 CM)</li>
                                </ul>
                            </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 72%;"> 
                                <input type="text" name="tata_laksana" value="{{ $data ? $data->tata_laksana : ($data_cppt ? $data_cppt->tindak_lanjut : '') }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 25%;">
                                <ul>
                                    <li>Anjuran</li>
                                </ul>
                            </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 72%;"> 
                                <input type="text" name="anjuran" value="{{ $data ? $data->anjuran : ($data_cppt ? $data_cppt->tindak_lanjut : '') }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td style="width: 25%;">
                                <ul>
                                    <li>Evaluasi</li>
                                </ul>
                            </td>
                            <td style="width: 2%"> : </td>
                            <td style="width: 72%;"> 
                                <input type="text" name="evaluasi" value="{{ $data ? $data->evaluasi : ($data_cppt ? $data_cppt->tindak_lanjut : '') }}" style="border: none; border-bottom: 1px dotted; width: 100%">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 text-center">
                <p class="mb-2">&nbsp;</p>
                <p>Tanda Tangan Pasien</p>
                <div onclick="open_modal_nama_yang_menyatakan()" id="box_ttd_pasien">
                    @if(is_null($dokumen) || is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                    <br>
                    Klik Disini
                    <br>
                    <br>
                    ________________________________
                    {{-- <p>Tanda Tangan & Nama Jelas</p> --}}
                    @else
                    @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                    <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}" style="height: 2.5cm; width: 4cm;" alt="">
                    @else
                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                    @endif
                    <br>({{ $dokumen->nama_pasien }})
                    @endif
                </div>
            </div>
            
            <div class="col-md-6 text-center">
                Bekasi, <input style="border: hidden; border-bottom: 1px dotted" type="text" name="tanggal_dokumen" class="tanggal_dmy" value="{{ $data ? $data->tanggal_dokumen : '' }}">
                <p>Cap dan Tanda tangan dr. SpKFR</p>
                <span onclick="open_modal_verifikasi()" id="box_ttd">
                    @if ($dokumen->id_verifikator == 0)
                    <br>
                    Simpan & verifikasi
                    <br>
                    <br>
                    ________________________________
                    {{-- <p>Tanda Tangan & Nama Jelas</p> --}}
                    @else
                    @if (isset($employee))
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 2.5cm; width: 4cm;" alt="">
                    @else
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                    @endif
                    <br>({{ $dokumen->nama_verifikator }})
                    @endif
                </span>
            </div>

            <div class="col-md-12 text-center">
                <button class="btn btn-success" onclick="confirm_simpan()">Simpan</button>
            </div>
        </div>
    </div>
</form>
</div>

<div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_verif">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" id="password" placeholder="Masukkan password anda" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan penerima informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/detail/ttd_formulir_klaim_fisioterapi') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Nama Pasien</h6>
                            <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                        </div>
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
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

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var verif = false;
    $('.tanggal_dmy').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        singleDatePicker: true,
        timePicker: false,
    });
    
    function open_modal_employee(param) {
        if ($.fn.DataTable.isDataTable("#tabel_employee")) {
            $('#tabel_employee').DataTable().clear().destroy();
        }
        
        $('#tabel_employee').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("e_rekam_medis/rawat_inap/datatable_employee") }}', // memanggil route yang menampilkan data json
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                data: 'id',
                name: 'id',
                "sortable": false,
                render: function(data, type, row, meta) {
                    return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</div>';
                }
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'id',
                name: 'id',
                render: function(data, type, row) {
                    return '<div class="text-center"><button class="btn btn-dark" onclick="set_employee(' + "'" + data + "','" + row.nama + "','" + param + "'" + ')"><i class="fa fa-check"></i></button></div>';
                }
            }
            ]
        });
        
        $('#modal_employee').modal('show');
    }
    
    function set_employee(id, nama, jenis) {
        $('[name=id_' + jenis + ']').val(id);
        $('[name=' + jenis + ']').val(nama);
        $('#modal_employee').modal('hide');
    }
    
    function loading(message, tipe) {
    return '<div class="alert alert-' + tipe + '">' +
        '<div class="spinner-border spinner-border-sm mr-1"></div>' +
        message +
        '</div>';
    }
    
    $(document).ready(function() {
        verif = '{{ $data ? true : false }}';
        console.log(verif);
        
        $("#diagnosa_medis").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                console.log(suggestion);
                $("#diagnosa_medis").val(suggestion.icd+' - '+suggestion.nama);
            }
        });
        
        $("#diagnosa_fungsi").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_fungsi").val(suggestion.icd+' - '+suggestion.nama);
            }
        });
    });
    
    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });
    
    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature64").val('');
        $("#nama_pasien").val('');
    });
    
    function konfirmasi_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);
        
        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }
        
        if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami layanan kedokteran fisik dan rehabilitasi')) {
            return false;
        }
    }
    
    $('#clear_pemberi').click(function(e) {
        e.preventDefault();
        signaturePadNamaSaksiSatu.clear();
        $("#signature64_saksi_satu").val('');
        $("#saksi_satu").val('');
    });
    
    function open_modal_nama_yang_menyatakan() {
        if (!verif) {
            alert('Dokumen Belum Diverifikasi')
        } else {
            $('#modal_pasien').modal('show');
        }
        
    }
    
    function open_modal_verifikasi() {
        $('#modal_verifikasi').modal('show');
    }

    $('#form_verif').submit(function(e) {
        e.preventDefault();

        if ($('#password').val() == '') {
            toastr.error('Password harus diisi');
            return;
        }

        $('[name=password]').val($('#password').val());
        $('#form_dokumen').submit();
    })

    function confirm_simpan() {
        if (!confirm('Apakah Anda yakin akan menyimpan dokumen ?')) {
            return false;
        } 
    }

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang update dokumen, harap tunggu...');

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/verifikasi_formulir_klaim_fisioterapi') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                    $('#modal_verifikasi').modal('hide');
                    $('#form_verif')[0].reset();
                }
                toastr.success(response.message);
                if ($('[name=password]').val() != "") {
                    render_tanda_tangan(response);
                    verif = true;
                }
                $('#modal_verifikasi').modal('hide');
                $('#form_verif')[0].reset();
            }
        })
    })

    function render_tanda_tangan(response) {
        console.log(response);
        var ins = '';
        ins += '' +
            `<img class="mt-2" src="{{ env('SMIS_UPLOAD_URL') }}/` + response.data.employee.ttd + `" alt="" style="width: 4cm; height: 2.5cm; text-align: center;">` +
            '<br>' +
            '(' + response.data.dokumen.nama_verifikator + ')';
        console.log(ins);
        $('#box_ttd').html(ins);
    }
</script>

</html>