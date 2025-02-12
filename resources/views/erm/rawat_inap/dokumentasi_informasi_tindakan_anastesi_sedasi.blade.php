<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"
        integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dokumentasi Pemberian Informasi Tindakan Anestesi Umum atau Sedasi</title>
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
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <style>
        .main_table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .main_table th {
            border-color: black;
        }
        .main_table tr th {
            border: 1px solid;
            padding: 5px;
        }
        
        .main_table {
            width: 100%;
        }
        
        .main_table tr td {
            border: 1px solid;
            padding: 5px;
        }
        #box_ttd:hover {
            cursor: pointer;
        }
        @media print and (max-width: 767px) {
        .no-print,
            .no-print * {
            display: none !important;
        }
        select {
        color: #ffffff;
        color: rgb(255, 255, 255);
        text-shadow: 0 0 0 #ffffff;
        }
        .row{
            display: flex;
            flex-direction: row;
        }
        .col-md-3{
            flex-basis: 25%;
        }
        .col-md-1{
            flex-basis: 8.33%;
        }
        .col-md-8{
            flex-basis: 66.67%;
        }
        .col-md-6{
            flex-basis: 50%;
        }
        input:not(#hubungan_lain),select{
            border: solid white !important;
            border-bottom-style: none;          
            padding: 0;
            border: none;
        }
        .tgl_ttd{
            margin-left: 20px;
            padding: 0;
        }
        body {
            font-family:'Times New Roman';
            color:#000000; 
        }
        }
    </style>
</head>
<div class="modal fade" id="modal_ttd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda Tangan Pernyataan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
            $hubungan_lain=False;
            $hubungan='';
            if (isset($dokumen->informasi_tindakan_anestesi_sedasi)) {
                if($dokumen->informasi_tindakan_anestesi_sedasi->hubungan != "Saya Sendiri" && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan != "Suami" &&
                    $dokumen->informasi_tindakan_anestesi_sedasi->hubungan != "Istri" && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan != "Anak" &&
                    $dokumen->informasi_tindakan_anestesi_sedasi->hubungan != "Ayah" && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan != "Ibu"){
                    $hubungan_lain=True;
                    $hubungan=$dokumen->informasi_tindakan_anestesi_sedasi->hubungan;
                }
            }
            @endphp
            <form method="POST" onsubmit="return konfirmasi_ttd(this)"
                action="{{ url('e_rekam_medis/detail/ttd_informasi_tindakan_anestesi_umum_atau_sedasi') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400
                                height=200></canvas>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                        </div>
                    </div>
                    <br />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success no-print">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('e_rekam_medis/rekam_medis/verifikasi_dokumen_kunjungan') }}" method="post">
                @csrf
                <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="pass" class="form-control" id="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_diagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Data Diagnosa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table id="tabel_kepada" class="table table-striped mt-2" style="width: 100%;">
                <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Diagnosa</th>
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
<body>
    <button id="print_hidden" hidden onclick="window.print();"></button>
    <div class="container" >
        <div class="row">
            <div class="col-12 text-right">MR 02.39.001.REV.1</div>
        </div>
    <table class="w-100">
        <tr>
            <td class="align-top" style="width: 65.5%;">
                <div class="col-sm-12 col-md-8">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                    <p style="font-weight: bold" id="alamat_rs">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya,<br>Kec.
                        Cibarusah, Kab.
                        Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
                </div>
            </td>
            <td style="width: 5%;"></td>
            <td class="align-top" style="width: 47.5%;">
                <div class="float-right px-4 py-3" style="border: 1px solid;height: 100%; border-radius:20px;">
                    <table>
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $dokumen->nama_pasien }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $dokumen->nrm }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' :
                                'Laki-laki') : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;">:</td>
                            <td>{{ $layanan ? $layanan->ktp: '-' }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        </table>    
        <div id="box_message_top" class="no-print">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            @if (Session::has('gagal'))
            <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
            @endif
            @if (Session::has('sukses'))
            <div class="alert alert-success">{{ Session::get('sukses') }}</div>
            @endif
        </div>
        <div class="container mt-3">
            <form method="post" onsubmit="return cek_pemberi_informasi()" action="{{url('e_rekam_medis/detail/save_informasi_tindakan_anestesi_umum_atau_sedasi')}}">
            @csrf
            <input type="hidden" name="id_dokumen" value="{{$dokumen->id}}">
            <input type="hidden" name="dasar_diagnosis" id="dasar_diagnosis">
            <input type="hidden" name="checklist" id="checklist">
            <table class="table table-bordered table-0 main_table">
                <thead>
                    <tr>
                        <th scope="col" colspan="8" class="text-center"
                            style="background-color: lightgrey; margin-bottom:0; border-color: black;">DOKUMENTASI
                            PEMBERIAN INFORMASI TINDAKAN ANESTESI UMUM/SEDASI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            Dokter Pelaksana Tindakan
                        </td>
                        <td colspan="2">
                            <select name="id_dokter_pelaksana" id="id_dokter_pelaksana" class="form-control select2" style="width: 100%">
                                <option value="" selected disabled>Select item...</option>
                                @foreach ($dokter_pelaksana as $dokter)
                                    <option value="{{$dokter->id}}" {{$dokumen->informasi_tindakan_anestesi_sedasi&&$dokumen->informasi_tindakan_anestesi_sedasi->id_dokter_pelaksana==$dokter->id?'selected':''}}>{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Pemberi Informasi
                        </td>
                        <td colspan="2">
                            <select name="id_pemberi_informasi" id="id_pemberi_informasi" class="form-control select2" style="width: 100%">
                                <option value="" selected disabled>Select item...</option>
                                @foreach ($pemberi_informasi as $pemberi_info)
                                    <option value="{{ $pemberi_info->id }}" {{$dokumen->informasi_tindakan_anestesi_sedasi&&$dokumen->informasi_tindakan_anestesi_sedasi->id_pemberi_informasi==$pemberi_info->id?'selected':''}}>{{ $pemberi_info->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="vertical-align: middle;">Penerima Informasi / <br> Pemberi
                            Persetujuan</td>
                        <td colspan="2">
                            <input type="text" name="penerima_informasi" class="form-control" value="{{$dokumen->informasi_tindakan_anestesi_sedasi?$dokumen->informasi_tindakan_anestesi_sedasi->penerima_informasi:$dokumen->nama_pasien}}" required>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td class="font-weight-bold" style="width: 5%">NO</td>
                        <td class="font-weight-bold" style="width:25%">JENIS INFORMASI</td>
                        <td class="font-weight-bold" style="width:60%">ISI INFORMASI</td>
                        <td class="font-weight-bold">TANDA (V)</td>
                    </tr>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Diagnosa</td>
                        <td>
                            <div class="input-group">
                                <input type="text" 
                                    value="{{$dokumen->informasi_tindakan_anestesi_sedasi?$dokumen->informasi_tindakan_anestesi_sedasi->diagnosa:''}}"
                                    id="diagnosa" name="diagnosa" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" onclick="open_modal_diagnosa()">
                                        <i class="fa fa-list"></i>
                                    </button>
                                </div>
                            </div>
                            {{-- <select name="id_diagnosa" id="id_diagnosa" class="form-control select2" style="width: 100%">
                            <option value="{{$dokumen->informasi_tindakan_anestesi_sedasi?$dokumen->informasi_tindakan_anestesi_sedasi->indikasi_tindakan:''}}" selected disabled>Select item...</option>
                                @foreach ($diagnosa as $icd)
                                    <option value="{{ $icd->id }}" {{$dokumen->informasi_tindakan_anestesi_sedasi && $dokumen->informasi_tindakan_anestesi_sedasi->id_diagnosa==$icd->id?'selected':''}}>{{$icd->icd .'-'. $icd->nama }}</option>
                                @endforeach
                            </select> --}}
                        </td>
                        <td class="text-center">
                            <input type="checkbox" id="satu" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('satu', json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist)) ?'checked' : '') : '' }} >
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Dasar Diagnosis</td>
                        <td>
                            <input type="checkbox" id="dasar_satu" {{ $dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis)  
                            ? (in_array('satu',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis))?'checked' : '') : '' }}> Anamnesis,
                            <input type="checkbox" id="dasar_dua" {{ $dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis)
                            ? (in_array('dua',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis))?'checked' : '') : '' }}> Pemeriksaan Fisik,
                            <input type="checkbox" id="dasar_tiga" {{ $dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis)
                            ? (in_array('tiga',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis))?'checked' : '') : '' }}> Hasil Pemeriksaan Laboratorium,
                            <input type="checkbox" id="dasar_empat" {{ $dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis)
                            ? (in_array('empat',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis))?'checked' : '') : '' }}> EKG,<br>
                            <input type="checkbox" id="dasar_lima" {{ $dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis)
                            ? (in_array('lima',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis))?'checked' : '') : '' }}> Pemeriksaan checkboxlogi (Toraks, MRI, USG, dll),
                            <input type="checkbox" id="dasar_enam" {{ $dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis)
                            ? (in_array('empat',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->dasar_diagnosis))?'checked' : '') : '' }}> Lain-lain
                        </td>
                        <td class="text-center">
                            <input type="checkbox" id="dua" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('dua', json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Tindakan Kedokteran</td>
                        <td>Anestesi Umum</td>
                        <td class="text-center">
                            <input type="checkbox" id="tiga" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('tiga',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Indikasi Tindakan</td>
                        <td><input type="text" name="indikasi_tindakan" class="form-control" value="{{$dokumen->informasi_tindakan_anestesi_sedasi?$dokumen->informasi_tindakan_anestesi_sedasi->indikasi_tindakan:''}}"></td>
                        <td class="text-center">
                            <input type="checkbox" id="empat" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('empat',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Tata Cara:
                        </td>
                        <td>
                            <ul>
                                <li>Menggunakan obat bius diberikan dengan cara suntikan kepembuluh darah atau dihirup
                                    melalui sungkup mata.</li>
                                <li>Dilakukam pemasangan alat/pipa pernafasan khusus melalui mulit atau hidung ke
                                    tenggorokan (pipa endotrakheal) atau LMA (sungkup Laring) untuk menjaga jalan nafas
                                    dan memelihara kedalam pembiusan.</li>

                            </ul>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" id="lima" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('lima',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td>Tujuan</td>
                        <td>
                            <ul>
                                <li>Membuat pasien tidak sadar dan tidak merasakan apa-apa.</li>
                                <li>Lama pembiusan dapat disamakan dengan lamanya operasi.</li>
                                <li>Kedalaman anestesi : hilangnya kesadaran, hilangnya rasa nyeri dan lemasnya
                                    otot-otot diatur sesuai kebutuhan.</li>
                            </ul>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" id="enam" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('enam',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">7</td>
                        <td>Risiko</td>
                        <td>
                            <ul>
                                <li>Dapat timbul reaksi alergi/hypersensitif terhadap obat, mulai derajat ringan hingga
                                    berat/fatal</li>
                                <li>Pada pasien yang tidak berpuasa bisa terjadi aspirasi yaitu masuknya isi lambung
                                    kedalam jalan nafas atau paru.</li>
                                <li>Dapat terjadi spasme laring (kejang pita suara), spasme bronkus (kejang jalan nafas
                                    bawah) dari yang ringan hingga berat yang bisa menyebabkan henti jantung </li>
                            </ul>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" id="tujuh" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('tujuh',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">8</td>
                        <td>Komplikasi</td>
                        <td>
                            <ul>
                                <li>Dapat terjadi kesulitan saat pemasangan pipa pernafasan yang tidak diduga sebelumnya
                                </li>
                                <li>Pipa pernafasan dapat mencederai gigi dan gusi</li>
                                <li>Dapat terjadi nyeri tenggorokan dan batuk batuk akibat pemasangan pipa pernafasan
                                    yang bersifat sementara dan dapat diatasi dengan obat.</li>
                                <li>Pasca bedah dapat berupa mual/muntah, menggigil, pusing, mengantuk dan bisa diatasi
                                    dengan obat.</li>
                            </ul>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" id="delapan" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('delapan',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">9</td>
                        <td>
                            Prognosis:
                        </td>
                        <td>Bergantung kondisi/status fisik ASA Pasien</td>
                        <td class="text-center">
                            <input type="checkbox" id="sembilan" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('sembilan',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">10</td>
                        <td>Alternatif</td>
                        <td><input type="text" name="alternatif" class="form-control" value="{{$dokumen->informasi_tindakan_anestesi_sedasi?$dokumen->informasi_tindakan_anestesi_sedasi->alternatif:''}}"></td>
                        <td class="text-center">
                            <input type="checkbox" id="sepuluh" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('sepuluh',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">11</td>
                        <td>lain-lain
                        </td>
                        <td>
                            <ul>
                                <li>Pasca bedah pasien harus sadar penuh sebelum diberikan makan/minum</li>
                                <li>Pemulihan lebih lama dapat terjadi</li>
                                <li>Jika terjadi komplikasi yang tanpa diduga sebelumnya akan diatasi sesuai prosedur
                                </li>
                            </ul>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" id="sebelas" {{ $dokumen->informasi_tindakan_anestesi_sedasi ? (in_array('sebelas',json_decode($dokumen->informasi_tindakan_anestesi_sedasi->checklist))?'checked' : '') : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Dengan ini menyatakan bahwa saya perwakilan dari Rumah Sakit, telah menerangkan
                            hal-hal diatas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan
                            berdiskusi</td>
                        <td id="box_ttd" onclick="open_modal_verifikasi()">
                               @if($dokumen->id_verifikator == 0)
                            @else
                                @if(isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 5cm;" alt="">
                                @endif
                            @endif
                        <br>                            
                        <span id="namaterang_dokter">{{$dokumen->informasi_tindakan_anestesi_sedasi&&$dokumen->id_verifikator == 0?'Ttd Dokter':''}}</span>                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Dengan ini menyatakan saya/keluarga pasien telah menerima informasi dari dokter,
                            sebagaimana diatas saya beri tanda tangan/paraf dikolom kananya serta telah diberi
                            kesempatan untuk bertanya/berdiskusi dan telah memahaminya</td>
                        <td class="col-md-6 text-center" id="box_ttd" onclick="open_modal_ttd()">
                            @if($dokumen->informasi_tindakan_anestesi_sedasi==""||is_null($dokumen->informasi_tindakan_anestesi_sedasi->ttd_pengampu) || $dokumen->informasi_tindakan_anestesi_sedasi->ttd_pengampu == "")
                            @else
                            <img src="{{ asset('signature_patient/'.$dokumen->informasi_tindakan_anestesi_sedasi->ttd_pengampu) }}"
                                style="height: 1cm; width: 5cm;" alt="">
                            @endif
                        <br>                            
                        <span id="namaterang_pengampu">{{$dokumen->informasi_tindakan_anestesi_sedasi&&$dokumen->informasi_tindakan_anestesi_sedasi->ttd_pengampu?'':'Ttd Pasien'}}</span>                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="font-size: 14px;">
                            *Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi
                            adalah wali atau keluarga terdekat. <br />
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12">
                <h4 class="text-center">PERNYATAAN PERSETUJUAN/PENOLAKAN TINDAKAN KEDOKTERAN ANESTESI <br> UMUM/SEDASI
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>
                    Yang bertanda tangan dibawah ini :
                </p>
                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Nama</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" name="pengampu" id="pengampu" value="{{$dokumen->informasi_tindakan_anestesi_sedasi&&$dokumen->informasi_tindakan_anestesi_sedasi->pengampu?$dokumen->informasi_tindakan_anestesi_sedasi->pengampu:$dokumen->nama_pasien}}"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control mt-n2" required>
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Tgl Lahir</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" name="tgl_lahir_pengampu" value="{{$dokumen->informasi_tindakan_anestesi_sedasi&&$dokumen->informasi_tindakan_anestesi_sedasi->tgl_lahir_pengampu?$dokumen->informasi_tindakan_anestesi_sedasi->tgl_lahir_pengampu:$layanan->tgl_lahir}}"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control mt-n2 datepicker">
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td style="width: 12%;">Alamat</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" name="alamat_pengampu" value="{{$dokumen->informasi_tindakan_anestesi_sedasi&&$dokumen->informasi_tindakan_anestesi_sedasi->alamat_pengampu?$dokumen->informasi_tindakan_anestesi_sedasi->alamat_pengampu:$layanan->alamat}}"
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control mt-n2">
                        </td>
                    </tr>
                </table>
                <p> Dengan ini menyatakan <span style="font-weight: bold;">
                    <span class="group-checkbox">
                        <input type="checkbox" name="status_tindakan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->status_tindakan)
                            && $dokumen->informasi_tindakan_anestesi_sedasi->status_tindakan == 1) ? 'checked' : 'selected'}}
                            value="1" id=""> SETUJU /
                        <input type="checkbox" name="status_tindakan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->status_tindakan)
                            && $dokumen->informasi_tindakan_anestesi_sedasi->status_tindakan == 0) ? 'checked' : ''}}
                            value="0" id=""> TIDAK SETUJU
                    </span>
                    </span> untuk dilakukan tindakan <span style="font-weight: bold"> ANESTESI UMUM/SEDASI </span> kepada
                    <span class="group-checkbox">
                    <input type="checkbox" name="hubungan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan == "Saya Sendiri") ? 'checked' : ''}} value="Saya Sendiri" id="hubungan"> Saya Sendiri / 
                    <input type="checkbox" name="hubungan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan == "Suami") ? 'checked' : ''}} value="Suami" id="hubungan"> Suami / 
                    <input type="checkbox" name="hubungan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan == "Istri") ? 'checked' : ''}} value="Istri" id="hubungan"> Istri /
                    <input type="checkbox" name="hubungan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan == "Anak") ? 'checked' : ''}} value="Anak" id="hubungan"> Anak /
                    <input type="checkbox" name="hubungan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan == "Ayah") ? 'checked' : ''}} value="Ayah" id="hubungan"> Ayah /
                    <input type="checkbox" name="hubungan" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $dokumen->informasi_tindakan_anestesi_sedasi->hubungan == "Ibu") ? 'checked' : ''}} value="Ibu" id="hubungan"> Ibu /
                    <input type="checkbox" name="hubungan_hidden" id="hubungan_hidden" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $hubungan_lain=True) ? 'checked' : ''}} id="" hidden> 
                    <input type="text" name="hubungan2" id="hubungan_lain" {{ ($dokumen->informasi_tindakan_anestesi_sedasi && isset($dokumen->informasi_tindakan_anestesi_sedasi->hubungan)
                        && $hubungan_lain=True) ? 'checked' : ''}} value="{{$hubungan}}" id="" 
                        style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">
                    yang bernama :
                    </span>
                </p>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Nama</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" name=""
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control mt-n2" value="{{$dokumen->nama_pasien}}" disabled>
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Tgl Lahir </td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            <input type="text" name=""
                                style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;"
                                class="form-control mt-n2" value="{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}" disabled>
                        </td>
                    </tr>
                </table>

                <p class="mt-3">
                    Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti diatas kepada saya,
                    termasuk resiko dan komplikasi yang mungkin timbul. Saya juga menyadari bahwa oleh karena ilmu
                    kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan,
                    melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.
                </p>

                <p class="mt-5 text-right mb-5 tgl_ttd" style="margin-right:90px;">
                    Bekasi, <input type="text" class="datepicker" name="tanggal_ttd" value="{{$dokumen->informasi_tindakan_anestesi_sedasi?date('d-m-Y',strtotime($dokumen->informasi_tindakan_anestesi_sedasi->tanggal_diampu)):''}}"
                        style="width:100px;border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">
                    Jam <input type="text" class="timepicker" name="jam_ttd" value="{{$dokumen->informasi_tindakan_anestesi_sedasi?date('H:i',strtotime($dokumen->informasi_tindakan_anestesi_sedasi->tanggal_diampu)):''}}" 
                        style="width:50px;border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">WIB
                </p>
                <table>
                    
                </table>
                <div class="row justify-content-center mb-5">
                    <div class="col-md-6 text-center" id="box_ttd" onclick="open_modal_ttd()">
                        <p style="margin: 0;padding:0">Yang Menyatakan</p>
                            @if($dokumen->informasi_tindakan_anestesi_sedasi==""||is_null($dokumen->informasi_tindakan_anestesi_sedasi->ttd_pengampu) || $dokumen->informasi_tindakan_anestesi_sedasi->ttd_pengampu == "")
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                (............................................)
                            @else
                            <img src="{{ asset('signature_patient/'.$dokumen->informasi_tindakan_anestesi_sedasi->ttd_pengampu) }}"
                                style="height: 4cm; width: 5cm;" alt="">
                            @endif
                        <br>                            
                        <span id="namaterang_pengampu">{{$dokumen->informasi_tindakan_anestesi_sedasi?$dokumen->informasi_tindakan_anestesi_sedasi->pengampu:'Ttd & Nama Terang'}}</span>                        
                    </div>
                    <div class="col-md-6 text-center" id="box_ttd" onclick="open_modal_verifikasi()">
                        <p style="margin: 0;padding:0">Dokter</p>
                            @if($dokumen->id_verifikator == 0)
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                (............................................)
                            @else
                                @if(isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 4cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                @endif
                            @endif
                        <br>
                        <span id="namaterang_pengampu">{{$dokumen?$dokumen->nama_verifikator:'Ttd & Nama Terang'}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success text-center no-print">Simpan</button>
            <button type="button" class="btn btn-dark text-center no-print print"><i class="bi bi-printer"></i>Print</button>
        </div>
        </form>
        <p class="mt-5" style="font-size: 14px; font-style: italic; font-weight: bold">*Coret yang Tidak Perlu</p>
        <p>RSHM/OK/13.02/Rev.01</p>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"
        integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });    
        function cek_pemberi_informasi() {
            var checklist = [];
            var dasar_diagnosis = [];
            if ($('#satu').is(':checked')) {
                checklist.push('satu');
            }
            if ($('#dua').is(':checked')) {
                checklist.push('dua');
            }
            if ($('#tiga').is(':checked')) {
                checklist.push('tiga');
            }
            if ($('#empat').is(':checked')) {
                checklist.push('empat');
            }
            if ($('#lima').is(':checked')) {
                checklist.push('lima');
            }
            if ($('#enam').is(':checked')) {
                checklist.push('enam');
            }
            if ($('#tujuh').is(':checked')) {
                checklist.push('tujuh');
            }
            if ($('#delapan').is(':checked')) {
                checklist.push('delapan');
            }
            if ($('#sembilan').is(':checked')) {
                checklist.push('sembilan');
            }
            if ($('#sepuluh').is(':checked')) {
                checklist.push('sepuluh');
            }
            if ($('#sebelas').is(':checked')) {
                checklist.push('sebelas');
            }
            if ($('#duabelas').is(':checked')) {
                checklist.push('duabelas');
            }
            if ($('#tigabelas').is(':checked')) {
                checklist.push('tigabelas');
            }
            if ($('#dasar_satu').is(':checked')) {
                dasar_diagnosis.push('satu');
            }
            if ($('#dasar_dua').is(':checked')) {
                dasar_diagnosis.push('dua');
            }
            if ($('#dasar_tiga').is(':checked')) {
                dasar_diagnosis.push('tiga');
            }
            if ($('#dasar_empat').is(':checked')) {
                dasar_diagnosis.push('empat');
            }
            if ($('#dasar_lima').is(':checked')) {
                dasar_diagnosis.push('lima');
            }
            $('#dasar_diagnosis').val(JSON.stringify(dasar_diagnosis));
            $('#checklist').val(JSON.stringify(checklist));
        }
        $('#dokter_pelaksana').change(function (e) { 
            e.preventDefault();
            var dokter = $('#dokter_pelaksana').val();
            $('#namaterang_dokter').text('textString');
            $('#namaterang_dokter').text(dokter);
        });
        $('#pengampu').change(function (e) {
            e.preventDefault();
            var pengampu = $('#pengampu').val();
            $('#namaterang_pengampu').text(pengampu);
        });
        $('.datepicker').daterangepicker({
            locale: {
            format: 'DD-MM-YYYY'
            },
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
        });
        function open_modal_ttd() {
            $('#modal_ttd').modal('show');
        }
        function open_modal_verifikasi() {
            $('#modal_verifikasi').modal('show');
        }
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
            
            if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
                return false;
            }
        }
        $(".group-checkbox :checkbox").change(function (e) {
            var current = $(this);
            var all = $(this).closest(".group-checkbox").find("input[type=checkbox]");
            $.each(all, function (indexInArray, valueOfElement) {
                $(valueOfElement).prop('checked', false);
            });
            current.prop('checked', true);
        });
        $('[name="hubungan"]').change(function (e) { 
            var hubungan=$(this).val();
            if(!hubungan==false){
                $("#hubungan_lain").val('');
                $('#hubungan_lain').attr('name', 'hubungan2');
            }            
        });
        $("#hubungan_lain").change(function (e) { 
            var hubungan_lain=$(this).val();
            if(!hubungan_lain==false){
                $('[name="hubungan"]').prop('checked', false);
                $('#hubungan_hidden').prop('checked', true);
                $('#hubungan_lain').attr('name', 'hubungan');
            }else{
                $('#hubungan_hidden').prop('checked', false);
                $('#hubungan_lain').attr('name', 'hubungan2');
            }
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
        $('.print').click(function (e) {
            window.scrollTo(0, 0); 
           $('#print_hidden').click() 
        });

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