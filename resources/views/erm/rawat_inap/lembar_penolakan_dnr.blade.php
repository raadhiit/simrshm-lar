<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Penolakan DNR</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <style>
        .pagebreak {
            page-break-after: always;
        }
        
        @media print {
            body {
                width: 100%;
                font-size: 10pt;
                padding: 0px;
            }
            
            .inputan {
                border: none !important;
                border-bottom: 1px solid transparent !important;
            }
            
            #tabel_pemantauan {
                font-size: 10px !important;
            }
            
            #logo_rshm {
                width: 20% !important;
            }
            
            @page {
                size: legal;
                margin: 0;
            }
            
            #gambar_partograf {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }
            
            #canvas {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }
            
            .hidden_print {
                display: none;
            }
        }
        
        #logo_rshm {
            width: 20%;
        }
        
        body {
            width: 100%;
            font-size: 12pt;
            padding: 20px;
        }
        
        .row {
            width: 100%;
            margin-left: 0;
        }
        
        .col-lg-1 {
            width: 8%;
            float: left;
        }
        
        .col-lg-2 {
            width: 16%;
            float: left;
        }
        
        .col-lg-3 {
            width: 25%;
            float: left;
        }
        
        .col-lg-4 {
            width: 33%;
            float: left;
        }
        
        .col-lg-5 {
            width: 42%;
            float: left;
        }
        
        .col-lg-6 {
            width: 50%;
            float: left;
        }
        
        .col-lg-7 {
            width: 58%;
            float: left;
        }
        
        .col-lg-8 {
            width: 66%;
            float: left;
        }
        
        .col-lg-9 {
            width: 75%;
            float: left;
        }
        
        .col-lg-10 {
            width: 83%;
            float: left;
        }
        
        .col-lg-11 {
            width: 92%;
            float: left;
        }
        
        .col-lg-12 {
            width: 100%;
            float: left;
        }
        
        .inputan {
            border: none;
            border-bottom: 1px solid !important;
        }
        
        #tabel_header tr td {
            /* width: 10%; */
            
            padding-left: 5px;
            padding-right: 5px;
        }
        
        #tabel_header tr:nth-child(even) td {
            padding-top: 5px;
        }
        
        #title_tabel_3 {
            -webkit-transform: rotate(270deg);
        }

        .table-main tr td {
            border: 1px solid;
            padding: 5px
        }

        .table-main tr th {
            border: 1px solid
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

<body>
    @if(Session::has('success'))
    <script>
        alert('{{ Session::get("success") }}')
    </script>
    @endif
    <div class="container">
        <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" onsubmit="return cek_form(this)" action="{{ url('e_rekam_medis/detail/save_lembar_penolakan_dnr') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" id="hide_dokter" name="dokter">
                        <input type="hidden" id="hide_perawat" name="perawat">
                        <input type="hidden" id="hide_penerima_informasi" name="penerima_informasi">
                        <input type="hidden" id="hide_informasi" name="informasi">
                        <input type="hidden" id="hide_diagnosa" name="diagnosa">
                        <input type="hidden" id="hide_dasar_diagnosa" name="dasar_diagnosa">
                        <input type="hidden" id="hide_tindakan_dokter" name="tindakan_dokter">
                        <input type="hidden" id="hide_indikasi_tindakan" name="indikasi_tindakan">
                        <input type="hidden" id="hide_tata_cara" name="tata_cara">
                        <input type="hidden" id="hide_tujuan" name="tujuan">
                        <input type="hidden" id="hide_risiko" name="risiko">
                        <input type="hidden" id="hide_komplikasi" name="komplikasi">
                        <input type="hidden" id="hide_prognosis" name="prognosis">
                        <input type="hidden" id="hide_alternatif" name="alternatif">
                        <input type="hidden" id="hide_lain_lain" name="lain_lain">
                        <input type="hidden" id="hide_nama_pasien" name="nama_pasien">
                        <input type="hidden" id="hide_alamat_pasien" name="alamat_pasien">
                        <input type="hidden" id="hide_menolak" name="menolak">
                        <input type="hidden" id="hide_terhadap" name="terhadap">
                        <input type="hidden" id="hide_nama_wali" name="nama_wali">
                        <input type="hidden" id="hide_tgl_lahir_wali" name="tgl_lahir_wali">
                        <input type="hidden" id="hide_kelamin" name="kelamin">
                        <input type="hidden" id="hide_alamat" name="alamat">
                        <input type="hidden" id="hide_tgl_ttd" name="tgl_ttd">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Password :</label>
                                <input type="password" name="pass" placeholder="Input your password" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/detail/save_ttd_lembar_penolakan_dnr') }}">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                            <input type="hidden" name="status" id="status">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <h6>Nama Penerima Edukasi</h6>
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
        <div class="row">
            <div class="col-lg-7">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="" id="logo_rshm">
                <p style="font-weight: bold; font-size: 12px;">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya, Kec. Cibarusah<br>
                    Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
                </div>
                <div class="col-lg-5">
                    <div style="width: 100%; padding:10px; border: 1px solid; border-radius:10px;">
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td class="pl-2 pr-2"> : </td>
                                <td>{{ $pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td>No. RM</td>
                                <td class="pl-2 pr-2"> : </td>
                                <td>{{ $pasien->id }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td class="pl-2 pr-2"> : </td>
                                <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td class="pl-2 pr-2"> : </td>
                                <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td class="pl-2 pr-2"> : </td>
                                <td>{{ $pasien->ktp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="container mt-3">
                <table class="table table-main">
                    <thead>
                        <tr>
                            <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">LEMBAR PENOLAKAN DNR (<i>Do Not Resuscitate</i>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="font-weight-bold" style="font-size: 12px;">
                                &nbsp;&nbsp;&nbsp; *Coret yang tidak perlu
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-center">
                                PEMBERI INFORMASI
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 20px;">Dokter Pelaksana Tindakan</td>
                            <td colspan="2">
                                <input type="text" id="dokter" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->dokter : '' }}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 20px;">Pemberi Informasi</td>
                            <td colspan="2">
                                <input type="text" id="perawat" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->perawat : '' }}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 20px;">Penerima informasi</td>
                            <td colspan="2">
                                <input type="text" id="penerima_informasi" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->penerima_informasi : $pasien->nama }}">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td class="font-weight-bold">NO</td>
                            <td class="font-weight-bold">JENIS INFORMASI</td>
                            <td class="font-weight-bold">ISI INFORMASI</td>
                            <td class="font-weight-bold">TANDA (V)</td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>&nbsp;&nbsp;Diagnosis (DK) dan (DB)**</td>
                            <td><input type="text" id="diagnosa" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->diagnosa : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="diagnosis"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("diagnosis", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>&nbsp;&nbsp;Dasar Diagnosa</td>
                            <td><input type="text" id="dasar_diagnosa" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->dasar_diagnosa : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="dasar_diagnosis"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("dasar_diagnosis", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>&nbsp;&nbsp;Tindakan Kedokteran</td>
                            <td><input type="text" id="tindakan_dokter" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->tindakan_dokter : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="tindakan_dokter"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("tindakan_dokter", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>&nbsp;&nbsp;Indikasi Tindakan</td>
                            <td><input type="text" id="indikasi_tindakan" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->indikasi_tindakan : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="indikasi_tindakan"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("indikasi_tindakan", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>&nbsp;&nbsp;Tata Cara
                            </td>
                            <td><input type="text" id="tata_cara" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->tata_cara : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="tata_cara"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("tata_cara", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>&nbsp;&nbsp;Tujuan</td>
                            <td><input type="text" id="tujuan" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->tujuan : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="tujuan"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("tujuan", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td>&nbsp;&nbsp;Risiko</td>
                            <td><input type="text" id="risiko" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->risiko : '' }}">
                            </td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="risiko"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("risiko", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td>&nbsp;&nbsp;Komplikasi</td>
                            <td><input type="text" id="komplikasi" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->komplikasi : '' }}">
                            </td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="komplikasi"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("komplikasi", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td>
                                &nbsp;&nbsp;Prognosis:
                            </td>
                            <td><input type="text" id="prognosis" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->prognosis : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="prognosis"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("prognosis", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">10</td>
                            <td>&nbsp;&nbsp;Alternatif & Risiko</td>
                            <td><input type="text" id="alternatif" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->alternatif : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="alternatif"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("alternatif", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">11</td>
                            <td>&nbsp;&nbsp;lain-lain  
                            </td>
                            <td><input type="text" id="lain_lain" style="width: 100%; border: hidden; border-bottom: 1px dotted" value="{{ $data ? $data->lain_lain : '' }}"></td>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" name="informasi" value="lain_lain"
                                    {{ $data ? (is_array(json_decode($data->informasi)) && in_array("lain_lain", json_decode($data->informasi)) ? 'checked' : '') : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jelas serta memberikan kesempatan untuk bertanya dan/atau berdikusi</td>
                            <td class="text-center" onclick="open_modal_petugas()">
                                Tanda tangan dokter
                                @if ($dokumen->id_verifikator == 0)
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>
                                    Ttd & Nama Terang
                                @else
                                    <br>
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($employee ? $employee->ttd : '') }}" style="height: 2.5cm; width: 4cm;" alt="">
                                    <br>
                                    {{ $dokumen->nama_verifikator }}
                                    <br>
                                    Ttd & Nama Terang
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana diatas yang saya tanda tangani di kolom kanan sebagai tanda telah memahaminya.</td>
                            <td class="text-center" onclick="open_modal_pasien('keluarga')">
                                Tanda tangan pasien/keluarga
                                @if (!is_null($data))
                                    @if(is_null($data->nama_keluarga) || $data->nama_keluarga == "")
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        (.................................................)
                                        <br>
                                        Ttd & Nama Terang
                                    @else
                                        <br>
                                        @if(!is_null($data->ttd_keluarga) || $data->ttd_keluarga != "")
                                            <img src="{{ asset('signature_patient/'.$data->ttd_keluarga) }}"
                                                    style="height: 2.5cm; width: 4cm;" alt="">
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                                        @endif
                                        <br>({{$data->nama_keluarga}})
                                    @endif
                                @else
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>
                                    Ttd & Nama Terang
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-size: 14px;">
                                *Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat.
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; padding: 0;">PERNYATAAN</th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Saya yang bertanda tangan dibawah ini: <br/>
                            
                                <table style="border-collapse: collapse; width:100%; border: hidden" class="mb-3">
                                    <tr class="align-top; border: hidden">
                                        <td style="width: 12%; border: hidden">Nama Pasien</td>
                                        <td style="width: 3%; border: hidden"> : </td>
                                        <td style="width: 85%; border: hidden">
                                            <input type="text" id="nama_pasien_pernyataan" style="border: hidden; border-bottom: 1px dotted; width: 100%" value="{{ $data ? $data->nama_pasien : $pasien->nama }}">
                                        </td>
                                    </tr>
                                    
                                    <tr class="align-top; border: hidden">
                                        <td style="width: 12%; border: hidden">Alamat</td>
                                        <td style="width: 3%; border: hidden"> : </td>
                                        <td style="width: 85%; border: hidden">
                                            <input type="text" id="alamat_pasien" style="border: hidden; border-bottom: 1px dotted; width: 100%" value="{{ $data ? $data->alamat_pasien : $layanan->alamat_pasien }}">
                                        </td>
                                    </tr>    
                                </table>
                                
                                <p class="mt-3">
                                    Dengan ini menyatakan <input type="checkbox" id="menolak" {{ $data ? ($data->menolak == "on" ? "checked" : '' ) : '' }}> <b><u>MENOLAK</u></b> untuk dilakukan tindakan <span style="font-weight: bold; text-decoration-line: underline">RESUSITASI </span> terhadap saya / 
                                    <input type="text" style="border:hidden; border-bottom: 1px dotted" id="terhadap" value="{{ $data ? $data->terhadap : '' }}"> saya yang bernama 
                                    <input type="text" style="border:hidden; border-bottom: 1px dotted" id="nama_wali" value="{{ $data ? $data->nama_wali : '' }}"> Tgl lahir : 
                                    <input type="text" class="tanggal_dmy" style="border:hidden; border-bottom: 1px dotted" id="tgl_lahir_wali" value="{{ $data ? date('d-m-Y', strtotime($data->tgl_lahir_wali)) : date('d-m-Y', strtotime($pasien->tgl_lahir)) }}"> 
                                    <input type="radio" value="laki-laki" name="radio_kelamin" {{ $data ? ($data->kelamin == "laki-laki" ? "checked" : '') : '' }}> L <input type="radio" value="perempuan" name="radio_kelamin" {{ $data ? ($data->kelamin == "perempuan" ? "checked" : '') : '' }}> P
                                </p>
                                
                                
                                <table style="border-collapse: collapse; width:100%; border: hidden" class="mb-3">
                                    <tr class="align-top; border: hidden">
                                        <td style="width: 12%; border: hidden">Alamat</td>
                                        <td style="width: 3%; border: hidden"> : </td>
                                        <td style="width: 85%; border: hidden">
                                            <input type="text" style="border:hidden; border-bottom: 1px dotted; width: 100%" id="alamat" value="{{ $data ? $data->alamat : '' }}">
                                        </td>
                                    </tr>    
                                </table>
                                
                                <p class="mt-3">
                                    Saya memahami atas manfaat tindakan tersebut sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk risiko dan komplikasi yang mungkin timbul. Saya juga menyadari bahwa ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat tergantung kepada izin Tuhan Yang Maha Esa.
                                </p>
                                
                                <p class="mt-3 text-right">
                                    Cibarusah, <input type="text" id="tgl_ttd" class="fulldate" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? date('d-m-Y H:i', strtotime($data->tgl_ttd)) : date('d-m-Y H:i') }}">
                                </p>
                                
                                <div class="row justify-content-center">
                                    <table style="width: 100%; border: hidden">
                                        <tr>
                                            <td style="width: 33%; text-align: center; border: hidden" onclick="open_modal_pasien('saksi')">
                                                @if (!is_null($data))
                                                    @if(is_null($data->nama_saksi) || $data->nama_saksi == "")
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        (.................................................)
                                                        <br>
                                                        Yang Menyatakan
                                                    @else
                                                        @if(!is_null($data->ttd_saksi) || $data->ttd_saksi != "")
                                                            <img src="{{ asset('signature_patient/'.$data->ttd_saksi) }}"
                                                                    style="height: 2.5cm; width: 4cm;" alt="">
                                                        @else
                                                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                                                        @endif
                                                        <br>({{$data->nama_saksi}})
                                                    @endif
                                                @else
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    (.................................................)
                                                    <br>
                                                    Yang Menyatakan
                                                @endif
                                            </td>
                                            <td style="width: 33%; text-align: center; border: hidden" onclick="open_modal_pasien('saksi_dua')">
                                                @if (!is_null($data))
                                                    @if(is_null($data->nama_saksi_dua) || $data->nama_saksi_dua == "")
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        (.................................................)
                                                        <br>
                                                        Yang Menyatakan
                                                    @else
                                                        @if(!is_null($data->ttd_saksi_dua) || $data->ttd_saksi_dua != "")
                                                            <img src="{{ asset('signature_patient/'.$data->ttd_saksi_dua) }}"
                                                                    style="height: 2.5cm; width: 4cm;" alt="">
                                                        @else
                                                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                                                        @endif
                                                        <br>({{$data->nama_saksi_dua}})
                                                    @endif
                                                @else
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    (.................................................)
                                                    <br>
                                                    Yang Menyatakan
                                                @endif
                                            </td>
                                            <td style="width: 33%; text-align: center; border: hidden" onclick="open_modal_petugas()">
                                                @if ($dokumen->id_verifikator == 0)
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    (.................................................)
                                                    <br>
                                                    Ttd & Nama Terang
                                                @else
                                                    <br>
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($employee ? $employee->ttd : '') }}" style="height: 2.5cm; width: 4cm;" alt="">
                                                    <br>
                                                    {{ $dokumen->nama_verifikator }}
                                                    <br>
                                                    Ttd & Nama Terang
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-right">RSHM/RI/32.00/Rev.00</p>
            </div>
        </div>
    </body>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
    <script>
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
        
        function open_modal_petugas() {
            $('#modal_petugas').modal('show');
        }
        
        function open_modal_pasien(status) {
            $('#status').val(status);
            $('#modal_pasien').modal('show');
        }
        
        function cek_form() {
            var informasi = [];
            $.each($("input[name='informasi']:checked"), function (K, V) {    
                informasi.push(V.value);        
            });

            $('#hide_dokter').val($('#dokter').val());
            $('#hide_perawat').val($('#perawat').val());
            $('#hide_penerima_informasi').val($('#penerima_informasi').val());
            $('#hide_informasi').val(JSON.stringify(informasi));
            $('#hide_diagnosa').val($('#diagnosa').val());
            $('#hide_dasar_diagnosa').val($('#dasar_diagnosa').val());
            $('#hide_tindakan_dokter').val($('#tindakan_dokter').val());
            $('#hide_indikasi_tindakan').val($('#indikasi_tindakan').val());
            $('#hide_tata_cara').val($('#tata_cara').val());
            $('#hide_tujuan').val($('#tujuan').val());
            $('#hide_risiko').val($('#risiko').val());
            $('#hide_komplikasi').val($('#komplikasi').val());
            $('#hide_prognosis').val($('#prognosis').val());
            $('#hide_alternatif').val($('#alternatif').val());
            $('#hide_lain_lain').val($('#lain_lain').val());
            $('#hide_nama_pasien').val($('#nama_pasien_pernyataan').val());
            $('#hide_alamat_pasien').val($('#alamat_pasien').val());
            $('#hide_menolak').val($('#menolak').val());
            $('#hide_terhadap').val($('#terhadap').val());
            $('#hide_nama_wali').val($('#nama_wali').val());
            $('#hide_tgl_lahir_wali').val($('#tgl_lahir_wali').val());
            $('#hide_kelamin').val($('[name="radio_kelamin"]:checked').val());
            $('#hide_alamat').val($('#alamat').val());
            $('#hide_tgl_ttd').val($('#tgl_ttd').val());
            
            return true;
        }
        
        $("#dokter").devbridgeAutocomplete({
            serviceUrl: "{{ url('ajax_request/get_dokter') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function(suggestion) {
                $("#dokter").val(suggestion.nama);
            }
        });

        $("#perawat").devbridgeAutocomplete({
            serviceUrl: "{{ url('ajax_request/get_perawat') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function(suggestion) {
                $("#perawat").val(suggestion.nama);
            }
        });

        $("#diagnosa").devbridgeAutocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function(suggestion) {
                $("#diagnosa").val(suggestion.icd+" - "+suggestion.nama);
            }
        });

        // $("#dasar_diagnosa").devbridgeAutocomplete({
        //     serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        //     dataType: "JSON", // Tipe data JSON
        //     onSelect: function(suggestion) {
        //         $("#dasar_diagnosa").val(suggestion.nama);
        //     }
        // });
    </script>
    
    </html>