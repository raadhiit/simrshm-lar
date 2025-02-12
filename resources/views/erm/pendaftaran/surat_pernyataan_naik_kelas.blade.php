<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Naik Kelas</title>
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
        input[type=text]
        {
        height: 25px; 
        line-height: 25px;
        }
        #box_ttd:hover {
            cursor: pointer;
        }
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }
        @media print and (max-width: 767px) {
        .no-print,
            .no-print * {
            display: none !important;
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
    }
    </style>
</head>

<body class="container">
    @if (Session::get('sukses'))
        <script>
            alert('{{ Session::get('sukses') }}')
        </script>
    @endif
    @if (Session::get('gagal'))
        <script>
            alert('{{ Session::get('gagal') }}')
        </script>
    @endif
    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" onclick="cek_data_informasi()"
                    action="{{ url('e_rekam_medis/detail/save_pernyataan_naik_kelas') }}">
                    @csrf
                    <input type="hidden" id="hide_dokumen" name="dokumen" value="{{$dokumen->id}}">   
                    <input type="hidden" id="hide_nama_pengampu" name="nama_pengampu">
                    <input type="hidden" id="hide_alamat_pengampu" name="alamat_pengampu">
                    <input type="hidden" id="hide_telp_pengampu" name="telp_pengampu">
                    <input type="hidden" id="hide_hubungan" name="hubungan">
                    <input type="hidden" id="hide_nama_pasien" name="nama_pasien">
                    <input type="hidden" id="hide_nobpjs_pasien" name="nobpjs_pasien">
                    <input type="hidden" id="hide_hak_kelas" name="hak_kelas">
                    <input type="hidden" id="hide_kelas_ditempati" name="kelas_ditempati">
                    <input type="hidden" id="hide_tgl_ttd" name="tgl_ttd">
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
    <div class="modal fade" id="modal_ttd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="konfirmasi_ttd()"
                    action="{{ url('e_rekam_medis/detail/save_pernyataan_naik_kelas') }}">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">   
                    <input type="hidden" id="hide_nama_pengampu2" name="nama_pengampu">
                    <input type="hidden" id="hide_alamat_pengampu2" name="alamat_pengampu">
                    <input type="hidden" id="hide_telp_pengampu2" name="telp_pengampu">
                    <input type="hidden" id="hide_hubungan2" name="hubungan">
                    <input type="hidden" id="hide_nama_pasien2" name="nama_pasien">
                    <input type="hidden" id="hide_nobpjs_pasien2" name="nobpjs_pasien">
                    <input type="hidden" id="hide_hak_kelas2" name="hak_kelas">
                    <input type="hidden" id="hide_kelas_ditempati2" name="kelas_ditempati">
                    <input type="hidden" id="hide_tgl_ttd2" name="tgl_ttd">
                    <div class="modal-body">
                        @csrf
                        <label>Nama Pasien / Keluarga</label>
                        <input type="text" class="form-control" id="form_nama_pasien" name="nama_pernyataan" required>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400
                                    height=200></canvas>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" id="clear" class="btn btn-danger btn-sm">Clear
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

        <div class="modal fade" id="modal_ttd_saksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan saksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="save_info_from_saksi()"
                    action="{{ url('e_rekam_medis/detail/save_pernyataan_naik_kelas') }}">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">   
                    <input type="hidden" id="hide_nama_pengampu3" name="nama_pengampu">
                    <input type="hidden" id="hide_alamat_pengampu3" name="alamat_pengampu">
                    <input type="hidden" id="hide_telp_pengampu3" name="telp_pengampu">
                    <input type="hidden" id="hide_hubungan3" name="hubungan">
                    <input type="hidden" id="hide_nama_pasien3" name="nama_pasien">
                    <input type="hidden" id="hide_nobpjs_pasien3" name="nobpjs_pasien">
                    <input type="hidden" id="hide_hak_kelas3" name="hak_kelas">
                    <input type="hidden" id="hide_kelas_ditempati3" name="kelas_ditempati">
                    <input type="hidden" id="hide_tgl_ttd3" name="tgl_ttd">
                    <div class="modal-body">
                        @csrf
                        <label>Nama Saksi</label>
                        <input type="text" class="form-control" id="form_nama_saksi" name="nama_saksi" required>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad2" class="signature-pad2" width=400
                                    height=200></canvas>
                                <textarea id="signature2" name="signed2" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" id="clear2" class="btn btn-danger btn-sm">Clear
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

        <table class="w-100 mb-4">
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
                            <td>{{ $layanan->nama }}</td>
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
        <div class="row mb-2">
            <div class="col-md-12">
                <h3 class="text-center mt-5">SURAT PERNYATAAN NAIK KELAS</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <p class="font-weight-bold">
                        Saya yang bertanda tangan dibawah ini:
                    </p>
                    <form action="{{ url('e_rekam_medis/detail/save_pernyataan_naik_kelas') }}" method="post">
                    @csrf 
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">   
                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                        <tr class="align-top">
                            <td style="width: 12%;">Nama</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="nama_pengampu" id="nama_pengampu" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                 value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas?$dokumen->surat_pernyataan_naik_kelas->nama_pengampu:''}}">
                            </td>
                        </tr>
    
                        <tr class="align-top">
                            <td style="width: 12%;">Alamat</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="alamat_pengampu" id="alamat_pengampu" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas?$dokumen->surat_pernyataan_naik_kelas->alamat_pengampu:''}}"> 
                            </td>
                        </tr>    
                        <tr class="align-top">
                            <td style="width: 12%;">No. Telepon</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="telp_pengampu" id="telp_pengampu" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas?$dokumen->surat_pernyataan_naik_kelas->telp_pengampu:''}}"> 
                            </td>
                        </tr>    
                        <tr class="align-top">
                            <td style="width: 12%;">Hubungan dengan Pasien</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="hubungan" id="hubungan" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                 value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas&&$dokumen->surat_pernyataan_naik_kelas?$dokumen->surat_pernyataan_naik_kelas->hubungan:''}}"> 
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
                                <input type="text" name="nama_pasien" id="nama_pasien" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                 value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas&&$dokumen->surat_pernyataan_naik_kelas->nama_pasien?$dokumen->surat_pernyataan_naik_kelas->nama_pasien:$layanan->nama}}">
                            </td>
                        </tr>
    
                        <tr class="align-top">
                            <td style="width: 12%;">No BPJS</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="nobpjs_pasien" id="nobpjs_pasien" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                 value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas&&$dokumen->surat_pernyataan_naik_kelas->nobpjs_pasien?$dokumen->surat_pernyataan_naik_kelas->nobpjs_pasien:$layanan->nobpjs}}"> 
                            </td>
                        </tr>    
                        <tr class="align-top">
                            <td style="width: 12%;">Hak kelas Rawat </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="hak_kelas" id="hak_kelas" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                 value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas?$dokumen->surat_pernyataan_naik_kelas->hak_kelas:''}}">  
                            </td>
                        </tr>    
                        <tr class="align-top">
                            <td style="width: 12%;">Kelas Rawat yang di Tempati</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="kelas_ditempati" id="kelas_ditempati" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"
                                 value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas?$dokumen->surat_pernyataan_naik_kelas->kelas_ditempati:''}}">   
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
                        Cibarusah, <input type="text" class="datepicker" name="tgl_ttd" id="tgl_ttd" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;"
                        value="{{$dokumen&&$dokumen->surat_pernyataan_naik_kelas?date('d-m-Y',strtotime($dokumen->surat_pernyataan_naik_kelas->tgl_ttd)):''}}">  
                    </p>
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-4 text-center" id="box_ttd" onclick="open_modal_verifikasi()">
                            <p style="margin: 0;padding:0">Petugas Pendaftaran</p>
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
                        <span id="petugas_pendaftaran">{{$dokumen&&isset($employee)?$dokumen->nama_verifikator:''}}</span>
                        </div>
    
                        <div class="col-md-4 text-center" id="box_ttd" onclick="open_ttd_saksi()">
                            <p style="margin: 0;padding:0">Saksi</p>
                            @if($dokumen->surat_pernyataan_naik_kelas==""||is_null($dokumen->surat_pernyataan_naik_kelas->ttd_saksi) || $dokumen->surat_pernyataan_naik_kelas->ttd_saksi == "")
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                (............................................)
                            @else
                            <img src="{{ asset('signature_patient/'.$dokumen->surat_pernyataan_naik_kelas->ttd_saksi) }}"
                                style="height: 4cm; width: 5cm;" alt="">
                            @endif
                        <br>                            
                        <span id="namaterang_saksi">{{$dokumen->surat_pernyataan_naik_kelas&&$dokumen->surat_pernyataan_naik_kelas->ttd_saksi?$dokumen->surat_pernyataan_naik_kelas->nama_saksi:''}}</span>                        
                        </div>
                        <div class="col-md-4 text-center" id="box_ttd" onclick="open_modal_ttd()">
                        <p style="margin: 0;padding:0">Yang membuat pernyataan</p>
                            @if($dokumen->surat_pernyataan_naik_kelas==""||is_null($dokumen->surat_pernyataan_naik_kelas->ttd_pernyataan) || $dokumen->surat_pernyataan_naik_kelas->ttd_pernyataan == "")
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                (............................................)
                            @else
                            <img src="{{ asset('signature_patient/'.$dokumen->surat_pernyataan_naik_kelas->ttd_pernyataan) }}"
                                style="height: 4cm; width: 5cm;" alt="">
                            @endif
                        <br>                            
                        <span id="namaterang_pernyataan">{{$dokumen->surat_pernyataan_naik_kelas&&$dokumen->surat_pernyataan_naik_kelas->ttd_pernyataan?$dokumen->surat_pernyataan_naik_kelas->nama_pernyataan:''}}</span>                        
                        </div>
                    </div>
                    {{-- <div class="text-center">
                        <button type="submit" class="btn btn-success text-center no-print">Simpan</button>
                        <button type="button" class="btn btn-dark text-center no-print print"><i class="bi bi-printer"></i>Print</button>
                    </div> --}}
                    </form>
            </div>
        </div>
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
        var nama_pasien = $('#nama_pasien').val();
        $('.select2').select2();
    });    
    function cek_data_informasi() {
        $('#hide_nama_pengampu').val($("#nama_pengampu").val());
        $('#hide_alamat_pengampu').val($("#alamat_pengampu").val());
        $('#hide_telp_pengampu').val($("#telp_pengampu").val());
        $('#hide_hubungan').val($("#hubungan").val());
        $('#hide_nama_pasien').val($("#nama_pasien").val());
        $('#hide_nobpjs_pasien').val($("#nobpjs_pasien").val());
        $('#hide_hak_kelas').val($("#hak_kelas").val());
        $('#hide_kelas_ditempati').val($("#kelas_ditempati").val());
        $('#hide_tgl_ttd').val($("#tgl_ttd").val());
    }
    function save_info_from_saksi(){
        konfirmasi_ttd_saksi();
        $('#hide_nama_pengampu3').val($("#nama_pengampu").val());
        $('#hide_alamat_pengampu3').val($("#alamat_pengampu").val());
        $('#hide_telp_pengampu3').val($("#telp_pengampu").val());
        $('#hide_hubungan3').val($("#hubungan").val());
        $('#hide_nama_pasien3').val($("#nama_pasien").val());
        $('#hide_nobpjs_pasien3').val($("#nobpjs_pasien").val());
        $('#hide_hak_kelas3').val($("#hak_kelas").val());
        $('#hide_kelas_ditempati3').val($("#kelas_ditempati").val());
        $('#hide_tgl_ttd3').val($("#tgl_ttd").val());
    }
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
    function open_ttd_saksi() {
        $('#modal_ttd_saksi').modal('show');
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

     const signaturePad2 = new SignaturePad(document.getElementById('signature-pad2'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });
        
    $('#clear2').click(function(e) {
        e.preventDefault();
        signaturePad2.clear();
        $("#signature2").val('');
    });
    function konfirmasi_ttd() {
        $('#hide_nama_pengampu2').val($("#nama_pengampu").val());
        $('#hide_alamat_pengampu2').val($("#alamat_pengampu").val());
        $('#hide_telp_pengampu2').val($("#telp_pengampu").val());
        $('#hide_hubungan2').val($("#hubungan").val());
        $('#hide_nama_pasien2').val($("#nama_pasien").val());
        $('#hide_nobpjs_pasien2').val($("#nobpjs_pasien").val());
        $('#hide_hak_kelas2').val($("#hak_kelas").val());
        $('#hide_kelas_ditempati2').val($("#kelas_ditempati").val());
        $('#hide_tgl_ttd2').val($("#tgl_ttd").val());

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
    
    function konfirmasi_ttd_saksi() {
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
    $('.print').click(function (e) {
        window.scrollTo(0, 0); 
        $('#print_hidden').click() 
    });
</script>
</body>
</html>