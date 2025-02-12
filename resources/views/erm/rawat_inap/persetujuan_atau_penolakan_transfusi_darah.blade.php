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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"
        integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Persetujuan atau Penolakan Transfusi Darah</title>
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
        input[type="checkbox"]:not('#id_diagnosis'){
            transform:scale(0.8,0.8);
        }
        .select2-selection__arrow b{
            display:none !important;
        }
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
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
        @media print and (max-width: 767px) {
        .bio_pengampu{
            margin-bottom: -20px;
        }

        col-md-1,.col-md-2,.col-md-3,.col-md-4,
        .col-md-5,.col-md-6,.col-md-7,.col-md-8, 
        .col-md-9,.col-md-10,.col-md-11,.col-md-12 {
            float: left;
        }

        .col-md-1 {
            width: 8%;
        }
        .col-md-2 {
            width: 16%;
        }
        .col-md-3 {
            width: 25%;
        }
        .col-md-4 {
            width: 33%;
        }
        .col-md-5 {
            width: 42%;
        }
        .col-md-6 {
            width: 50%;
            float: left;
        }
        .no-print,
            .no-print * {
            display: none !important;
        }
        .header-pasien{
            font-size: 12px;
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
        
        input[type="text"],select{
            font-size: 13px;
        }
        .tgl_ttd{
            margin-left: 20px;
            padding: 0;
        }
        body {
            font-size: 13px;
            font-family:'Times New Roman';
            color:#000000; 
            -webkit-print-color-adjust:exact !important;
            print-color-adjust:exact !important;
        }
        }
        .pernyataan:not(#header_pernyataan){
            padding: 5px;
        }
    </style>
</head>
<body class="p-2">
    <form method="post" onsubmit="return cek_pemberi_informasi()" action="{{url('e_rekam_medis/detail/save_persetujuan_atau_penolakan_transfusi_darah')}}" id="transfusiForm">
    @csrf
    <button id="print_hidden" hidden onclick="window.print();"></button>
    <div class="container">
        <table class="w-100 mb-n3">
                <tr>
                    <td class="align-top" style="width: 65.5%;">
                        <div class="col-sm-12 col-md-8">
                            <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                            <p style="font-weight: bold" id="alamat_rs">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah
                                Jaya,<br>Kec.
                                Cibarusah, Kab.
                                Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
                        </div>
                    </td>
                    <td style="width: 5%;"></td>
                    <td class="align-top" style="width: 47.5%;">
                        <div class="float-right px-4 py-3 header-pasien" style="border: 1px solid;height: 100%; border-radius:20px;">
                            <table>
                                <tr class="align-top" style="font-size: 14px;">
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
                <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                <input type="hidden" name="checklist" id="checklist">
                <input type="hidden" name="action">
            <table class="table table-bordered table-0 custom-table">
                <thead>
                  <tr>
                    <th scope="col" colspan="8" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color:black;">PERSETUJUAN / PENOLAKAN PEMBERIAN TRANSFUSI DARAH</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="4" class="font-weight-bold" style="font-size: 12px;" >
                        &nbsp;&nbsp;&nbsp; *Coret yang tidak perlu
                    </td>
                  </tr>
                  <tr>
                    <th colspan="4" class="text-center" >
                    PEMBERI INFORMASI
                    </th>
                  </tr>
                  <tr>
                    <td colspan="2"> &nbsp;&nbsp;Dokter Pelaksana Tindakan</td>
                    <td colspan="2" >
                       <select name="id_dokter_pelaksana" id="id_dokter_pelaksana" class="form-control form-control-lg select2" style="width: 100%">
                            <option value="" selected disabled>Pilih Dokter Pelaksana...</option>
                            @foreach ($dokter_pelaksana as $dokter)
                            <option value="{{$dokter->id}}" {{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->id_dokter_pelaksana==$dokter->id?'selected':''}}>{{
                                $dokter->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 0;"> &nbsp;&nbsp;Pemberi Informasi</td>
                    <td colspan="2"><select name="id_pemberi_informasi" id="id_pemberi_informasi" class="form-control select2" style="width: 100%">
                            <option value="" selected disabled>Pilih Pemberi Informasi....</option>
                            @foreach ($pemberi_informasi as $pemberi_info)
                            <option value="{{ $pemberi_info->id }}" {{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->id_pemberi_informasi==$pemberi_info->id?'selected':''}}>{{
                                $pemberi_info->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" > &nbsp;&nbsp;Penerima informasi</td>
                    <td colspan="2" >
                         <input type="text" name="penerima_informasi" class="form-control" value="{{$dokumen->persetujuan_transfusi_darah?$dokumen->persetujuan_transfusi_darah->penerima_informasi:$dokumen->nama_pasien}}">
                    </td>
                  </tr>
                  <tr class="text-center" >
                    <td class="font-weight-bold" >NO</td>
                    <td class="font-weight-bold" style="width: 20%;">JENIS INFORMASI</td>
                    <td class="font-weight-bold">ISI INFORMASI</td>
                    <td class="font-weight-bold">TANDA (V)</td>
                  </tr>
                  <tr>
                    <td class="text-center">1</td>
                    <td>&nbsp;&nbsp;Diagnosis (DK) dan (DB)**</td>
                    <td>
                        <span class="group-checkbox" style="margin-left:10px;">
                            <input type="checkbox" value="0" name="id_diagnosis" {{ ($dokumen->persetujuan_transfusi_darah &&
                                isset($dokumen->persetujuan_transfusi_darah->id_diagnosis) && $dokumen->persetujuan_transfusi_darah->id_diagnosis == 0) ? 'checked' : ''}} 
                                id="id_diagnosis"> Anemia, 
                            <input type="checkbox" value="1" name="id_diagnosis" {{ ($dokumen->persetujuan_transfusi_darah &&
                                isset($dokumen->persetujuan_transfusi_darah->id_diagnosis) && $dokumen->persetujuan_transfusi_darah->id_diagnosis == 1) ? 'checked' : ''}}
                                id="id_diagnosis"> Trombositopenia
                        </span>
                    </td>
                    <td class="text-center"><input type="checkbox" id="satu" {{ $dokumen->persetujuan_transfusi_darah ?
                    (in_array('satu',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">2</td>
                    <td>&nbsp;&nbsp;Dasar Diagnosa</td>
                    <td style="padding-left:10px">Badan lemah, letih, lesu, pucat, tanda-tanda pendarahan, demam</td>
                    <td class="text-center"><input type="checkbox" id="dua" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('dua',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">3</td>
                    <td>&nbsp;&nbsp;Tindakan Kedokteran</td>
                    <td style="padding-left:10px">Darah lengkap, darah merah dicuci, darah merah pekat, trombosit konsentrat, plasma beku, kriopresipitat</td>
                    <td class="text-center"><input type="checkbox" id="tiga" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('tiga',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">4</td>
                    <td>&nbsp;&nbsp;Indikasi Tindakan</td>
                    <td style="padding-left:10px">Adanya pendarahan akut/kehilangan darah, meningkatkan masa eritrosit, meningkatkan trombosit, gangguan koagulasi, mengatasi defisiensi faktor-faktor pembekuan darah</td>
                    <td class="text-center"><input type="checkbox" id="empat" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('empat',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">5</td>
                    <td>&nbsp;&nbsp;Tata Cara:
                    </td>
                    <td style="padding-left:10px">Formulir permintaan darah/komponen ditandatangani dokter, pengambilan sampel darah, pemberian transfusi darah secara benar dan cermat, darah dihangatkan dahulu, saat transfusi 5-10 menit pertama harus diawasi, kecepatan jangan melebihi 100 cc/menit</td>
                    <td class="text-center"><input type="checkbox" id="lima" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('lima',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">6</td>
                    <td>&nbsp;&nbsp;Tujuan</td>
                    <td style="padding-left:10px">Memberikan kebutuhan sel darah atau komponen darah sesuai indikasi</td>
                    <td class="text-center"><input type="checkbox" id="enam" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('enam',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">7</td>
                    <td>&nbsp;&nbsp;Risiko</td>
                    <td style="padding-left:10px">Reaksi transfusi cepat : hemolitik kuat, hypervolemik, hermolisis non imun, sepsis
                        <br> Reaksi transfusi lambar : hemolitik lambat, infeksi, reaksi lambat lainnya
                    </td>
                    <td class="text-center"><input type="checkbox" id="tujuh" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('tujuh',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">8</td>
                    <td>&nbsp;&nbsp;Komplikasi</td>
                    <td style="padding-left:10px">Reaksi transfusi cepat : hemolitik kuat, hypervolemik, hermolisis non imun, sepsis
                        <br> Reaksi transfusi lambar : hemolitik lambat, infeksi, reaksi lambat lainnya
                    </td>
                    <td class="text-center"><input type="checkbox" id="delapan" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('delapan',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">9</td>
                    <td>
                        &nbsp;&nbsp;Prognosis:
                    </td>
                    <td style="padding-left:10px">Ad Bonam</td>
                    <td class="text-center"><input type="checkbox" id="sembilan" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('sembilan',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">10</td>
                    <td>&nbsp;&nbsp;Alternatif & Risiko</td>
                    <td style="padding-left:3px"><input type="text" name="alternatif" id="alternatif" class="form-control" value="{{$dokumen->persetujuan_transfusi_darah&&isset($dokumen->persetujuan_transfusi_darah->alternatif)?$dokumen->persetujuan_transfusi_darah->alternatif:''}}"></td>
                    <td class="text-center"><input type="checkbox" id="sepuluh" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('sepuluh',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">11</td>
                    <td>&nbsp;&nbsp;lain-lain  
                    </td>
                    <td style="padding-left:3px"><input type="text" name="lain_lain" id="lain_lain" class="form-control" value="{{$dokumen->persetujuan_transfusi_darah&&isset($dokumen->persetujuan_transfusi_darah->lain_lain)?$dokumen->persetujuan_transfusi_darah->lain_lain:''}}">
                    </td>
                    <td class="text-center"><input type="checkbox" id="sebelas" {{ $dokumen->persetujuan_transfusi_darah ?
                        (in_array('sebelas',json_decode($dokumen->persetujuan_transfusi_darah->checklist))?'checked' : '') : '' }}></td>
                  </tr>
                  <tr style="border-spacing:50px;">
                    <td colspan="3"><p style="margin-left:5px;margin-bottom:0;">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jelas serta memberikan kesempatan untuk bertanya dan/atau berdikusi</td>
                    <td id="box_ttd" onclick="open_modal_ttd_dokter()">
                        @if($dokumen->persetujuan_transfusi_darah==""||is_null($dokumen->persetujuan_transfusi_darah->username_ttd_dokter))
                        <br/>   
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.($dokumen->persetujuan_transfusi_darah ? $dokumen->persetujuan_transfusi_darah->hrd_dokter ? $dokumen->persetujuan_transfusi_darah->hrd_dokter->ttd : '' : '') }}" style="height: 1cm; width: 5cm;" alt="">
                        @endif
                        <p class="text-center" style="margin-left:5px;margin-bottom:0;">{{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->username_ttd_dokter?'':'Tanda tangan dokter'}}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3"><p style="margin-left:5px;margin-bottom:0;">Dengan ini menyatakan bahwa saya telah menerima informasi hal dari dokter sebagaimana diatas kemudian yang saya tanda tangani di kolom kanan sebagai tanda telah memahaminya.</td>
                    <td id="box_ttd" onclick="open_modal_ttd()">
                        @if($dokumen->persetujuan_transfusi_darah==""||is_null($dokumen->persetujuan_transfusi_darah->ttd_pengampu)
                            || $dokumen->persetujuan_transfusi_darah->ttd_pengampu == "")
                        <br/>   
                        @else
                            <img src="{{ asset('signature_patient/'.$dokumen->persetujuan_transfusi_darah->ttd_pengampu) }}"
                                style="height: 1cm; width: 5cm;" alt="">
                        @endif
                        <span id="namaterang_pengampu" class="text-center">{{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->ttd_pengampu?'':'Pasien/Keluarga'}}</span>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" style="font-size: 14px; border-bottom:2px solid"> 
                        <p style="margin-left:5px;margin-bottom:0;">*Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat.
                    </td>
                  </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-12">
                    <div style="border:1px solid black; padding: 5px; margin-top: -18px;" class="pernyataan">
                        <table style="border-collapse: collapse; width:100%" class="bio_pengampu mb-2">
                             <tr class="align-top" style="padding-top:-20px">
                                <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; border-color:black;" id="header_pernyataan">PERNYATAAN</th>
                            </tr>
                            <tr class="align-top">
                                <td colspan="4">Saya yang bertanda tangan dibawah ini: </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 12%;">Nama</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" name="pengampu" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control mt-n2" value="{{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->pengampu?$dokumen->persetujuan_transfusi_darah->pengampu:$dokumen->nama_pasien}}">
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td style="width: 12%;">Alamat</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" name="alamat_pengampu" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control mt-n2" value="{{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->alamat_pengampu?$dokumen->persetujuan_transfusi_darah->alamat_pengampu:$dokumen->alamat}}"> 
                                </td>
                            </tr>    
                        </table>
                        <span>
                        Dengan ini menyatakan
                            <span class="group-checkbox"> 
                                <input type="checkbox" value="0" name="status_tindakan" {{ ($dokumen->persetujuan_transfusi_darah &&
                                    isset($dokumen->persetujuan_transfusi_darah->status_tindakan) && $dokumen->persetujuan_transfusi_darah->status_tindakan == 0) ? 'checked' : ''}} value="Saya Sendiri"
                                    id="status_tindakan">  menyetujui / 
                                <input type="checkbox" value="1" name="status_tindakan" {{ ($dokumen->persetujuan_transfusi_darah &&
                                    isset($dokumen->persetujuan_transfusi_darah->status_tindakan) && $dokumen->persetujuan_transfusi_darah->status_tindakan == 1) ? 'checked' : ''}} value="Saya Sendiri"
                                    id="status_tindakan"> menolak untuk dilakukan tindakan transfusi
                            </span>
                            <span class="group-checkbox"> terhadap 
                                <input type="checkbox" name="hubungan" {{ ($dokumen->persetujuan_transfusi_darah &&
                                 isset($dokumen->persetujuan_transfusi_darah->hubungan) && $dokumen->persetujuan_transfusi_darah->hubungan == "saya") ? 'checked' : ''}} value="saya"
                                    id="hubungan"> Saya,/
                                <input type="checkbox" name="hubungan" id="hubungan_hidden" {{ ($dokumen->persetujuan_transfusi_darah &&
                                isset($dokumen->persetujuan_transfusi_darah->hubungan) && $dokumen->persetujuan_transfusi_darah->hubungan != "saya") ? 'checked' : ''}} hidden>
                            </span>
                             terhadap 
                                <input type="text" style="border:1px solid transparent; border-bottom: 2px dotted; width: 10%; background-color: transparent;" id="hubungan_lain" name="hubungan_lain" value="{{ ($dokumen->persetujuan_transfusi_darah &&
                                isset($dokumen->persetujuan_transfusi_darah->hubungan) && $dokumen->persetujuan_transfusi_darah->hubungan != "saya") ? $dokumen->persetujuan_transfusi_darah->hubungan : ''}}"> saya yang bernama <input type="text" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40%; background-color: transparent;" value="{{$dokumen->nama_pasien}}" disabled> 
                            Tgl lahir : <input type="text" value="{{$layanan&&isset($layanan->tgl_lahir)?date('d-m-Y',strtotime($layanan->tgl_lahir)):''}}" style="border:1px solid transparent; border-bottom: 2px dotted; width: 10%; background-color: transparent;" disabled>          
                            <span class="group-checkbox">
                                <input type="checkbox" {{ ($layanan&&isset($layanan->kelamin) && $layanan->kelamin == 0) ? 'checked' :''}}> L/
                                <input type="checkbox"  {{ ($layanan&&isset($layanan->kelamin) && $layanan->kelamin == 1) ? 'checked' :''}}> P
                            </span>
                        </span>
                        <table style="border-collapse: collapse; width:100%" class="mb-3 mt-2">
                            <tr class="align-top">
                                <td style="width: 12%;">Alamat</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" name="alamat_pasien" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control mt-n2" value="{{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->alamat_pasien?$dokumen->persetujuan_transfusi_darah->alamat_pasien:$dokumen->alamat}}"> 
                                </td>
                            </tr>    
                        </table>
                        <p class="mt-3 mb-n2">
                            Saya telah dijelaskan dan memahami tindakan Transfusi beserta manfaat, risiko dan kompiklasi yang mungkin belum diprediksi. Saya menyadari bahwa ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan tramsfusi bukanlah keniscayaan, melainkan sangat tergantung kepada izin Tuhan Yang Maha Esa.
                        </p>
        
                        <p class="text-right mt-2">
                            Cibarusah, Tanggal <input type="text" class="datepicker" name="tanggal_diampu"
                                value="{{$dokumen->persetujuan_transfusi_darah?date('d-m-Y',strtotime($dokumen->persetujuan_transfusi_darah->tanggal_diampu)):''}}"
                                style="width:100px;border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">
                            Pukul <input type="text" class="timepicker" name="jam_ttd"
                                value="{{$dokumen->persetujuan_transfusi_darah?date('H:i',strtotime($dokumen->persetujuan_transfusi_darah->tanggal_diampu)):''}}"
                                style="width:50px;border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">
                        </p>
        
                        <div class="row">
                            <div class="col-md-4 text-center" id="box_ttd" onclick="open_modal_ttd()">
                            @if($dokumen->persetujuan_transfusi_darah==""||is_null($dokumen->persetujuan_transfusi_darah->ttd_pengampu)
                                || $dokumen->persetujuan_transfusi_darah->ttd_pengampu == "")
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                (............................................)<br>
                            @else
                                <img src="{{ asset('signature_patient/'.$dokumen->persetujuan_transfusi_darah->ttd_pengampu) }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                                <br>
                            @endif
                            <span
                            id="namaterang_pengampu">{{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->pengampu?$dokumen->persetujuan_transfusi_darah->pengampu:'Yang Menyatakan'}}</span>
                            </div>
                            <div class="col-md-4 text-center" id="box_ttd" onclick="open_modal_ttd_keluarga()">
                                @if($dokumen->persetujuan_transfusi_darah==""||is_null($dokumen->persetujuan_transfusi_darah->ttd_keluarga)
                                    || $dokumen->persetujuan_transfusi_darah->ttd_keluarga == "")
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                (............................................)<br>
                            @else
                            <img src="{{ asset('signature_patient/'.$dokumen->persetujuan_transfusi_darah->ttd_keluarga) }}"
                                style="height: 4cm; width: 5cm;" alt="">
                            <br>
                            @endif
                            <span id="namaterang_keluarga">{{$dokumen->persetujuan_transfusi_darah&&$dokumen->persetujuan_transfusi_darah->ttd_keluarga?$dokumen->persetujuan_transfusi_darah->nama_keluarga:'Keluarga/Wali'}}</span>
                            </div>
                            <div class="col-md-4 text-center" id="box_ttd" onclick="open_modal_verifikasi()">
                                @if($dokumen->id_verifikator == 0)
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                (............................................)<br>
                                @else
                                    @if(isset($employee))
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>
                                @endif 
                                <span id="namaterang_perawat">{{$dokumen&&$dokumen->nama_verifikator?$dokumen->nama_verifikator:'Perawat'}}</span>                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-right mb-0">RSHM/RI/16.00/Rev.00</p>
            <div class="text-center">
                <button type="submit" class="btn btn-success text-center no-print save-dokumen">Simpan</button>
                <button type="button" class="btn btn-dark text-center no-print print"><i class="bi bi-printer"></i>Print</button>
            </div>
        </div>
    </div> 

    {{-- <div>modal ttd dan verif</div> --}}

    <div class="modal fade" id="modal_ttd_keluarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda Tangan Pernyataan Keluarga/Wali</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Nama Keluarga/Wali</h6>
                            <input type="text" name="nama_keluarga" class="form-control" required><br>
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400
                                height=200></canvas>
                            <textarea id="signature" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                        </div>
                    </div>
                    <br />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success no-print save-ttd-keluarga">Simpan</button>
                </div>
                </div>
            </div>
        </div>
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
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad2" class="signature-pad2" width=400
                                height=200></canvas>
                            <textarea id="signature2" name="signed2" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button id="clear2" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                        </div>
                    </div>
                    <br />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success no-print save-ttd">Simpan</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_ttd_dokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">TTD Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" id="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success save-ttd-dokter">Simpan</button>
            </div>
            </div>
        </div>
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
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="pass" class="form-control" id="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success verifikasi">Verifikasi</button>
            </div>
            </div>
        </div>
    </div>
    {{-- <div>end modal ttd dan verif</div> --}}
    </form>

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
            $('.select2').select2({
                border: "none",
            });
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
        function open_modal_ttd_keluarga() {
            $('#modal_ttd_keluarga').modal('show');
        }
        function open_modal_verifikasi() {
            $('#modal_verifikasi').modal('show');
        }
        function open_modal_ttd_dokter() {
            $('#modal_ttd_dokter').modal('show');
        }

        const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            minWidth: 5,
            maxWidth: 10,
            penColor: 'rgb(0, 0, 0)',
            maxWidth: 2
        });
        const signaturePad2 = new SignaturePad(document.getElementById('signature-pad2'), {
            minWidth: 5,
            maxWidth: 10,
            penColor: 'rgb(0, 0, 0)',
            maxWidth: 2
        });    
        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.clear();
            $("#signature").val('');
        });
        $('#clear2').click(function(e) {
            e.preventDefault();
            signaturePad2.clear();
            $("#signature2").val('');
        });
        function konfirmasi_ttd() {
            var data = signaturePad2.toDataURL('image/png');
            $('#signature2').val(data);
    
            if ($('#signature2').val() == '') {
                alert('Tambahkan tanda tangan anda dahulu');
                return false;
            }
        
            if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
                return false;
            }
        }
        
        function konfirmasi_ttd_keluarga() {
            var data = signaturePad.toDataURL('image/png');
            $('#signature').val(data);
    
            if ($('#signature').val() == '') {
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
        $('.save-dokumen').click(function (e) { 
            cek_pemberi_informasi();
            var form = $('#transfusiForm')[0];
            form.submit();
        });
        $('.save-ttd').click(function (e) { 
            $("input[name='action']").val("ttd");
            konfirmasi_ttd();
            cek_pemberi_informasi();
            var form = $('#transfusiForm')[0];
            form.submit();
        });
        $('.save-ttd-dokter').click(function (e) { 
            $("input[name='action']").val("ttd_dokter");
            cek_pemberi_informasi();
            var form = $('#transfusiForm')[0];
            form.submit();
        });
        $('.save-ttd-keluarga').click(function (e) { 
            $("input[name='action']").val("ttd");
            konfirmasi_ttd_keluarga();
            cek_pemberi_informasi();
            var form = $('#transfusiForm')[0];
            form.submit();
        });
        $('.verifikasi').click(function (e) { 
            $("input[name='action']").val("verif");
            cek_pemberi_informasi();
            var form = $('#transfusiForm')[0];
            form.submit();
        });
</script>
</body>

</html>