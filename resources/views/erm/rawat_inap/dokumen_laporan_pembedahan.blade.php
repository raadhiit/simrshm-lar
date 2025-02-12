<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMIS - Dokumen Laporan Pembedahan</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @media print {
            .input-group-append {
                display: none;
            }

            .col-lg-4 {
                width: 33.3333333333%;
            }

            .col-lg-3 {
                width: 25%;
            }

            .col-lg-8 {
                width: 66.66%;
            }

            #btn_simpan {
                display: none;
            }

            input[type='file'] {
                display: none;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }

        #box_ttd:hover {
            cursor: pointer;
        }

        body {
            width: 100%;
            font-size: 10pt;
        }

        .border {
            border: 1px solid black !important;
        }

        .table.table-bordered td,
        .table.table-bordered th {
            border: 1px solid black !important;
        }

        .input-dotted {
            border: none !important;
            border-bottom: 1px dotted black !important;
        }
    </style>
</head>

<body>
    @if(Session::has('message'))
    <script>
        alert('{{ Session::get("message") }}');
    </script>
    @endif
    <form class="container pl-0 pr-0 pb-3" id="form_dokumen" style="border: 1px solid transparent;" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
        
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-lg-12" style="text-align: right;">
                RSHM/OK/03.00/Rev.01
            </div>
        </div>
        <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
            <div class="col-lg-8">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Telp.: (021) 8995 2340, Fax: (021) 8995 2340</p>
            </div>
            <div class="col-lg-4 pt-3 pl-3">
                <div style="border: 1px solid; border-radius: 20px; padding:15px;">
                    <table>
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $dokumen->nama_pasien }}</td>
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
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border:1px solid;">
            <div class="col-lg-12 pl-0 pr-0">
                <h5 class="text-center pt-2 pb-2" style="background-color: lightgrey; margin-bottom:0">LAPORAN PEMBEDAHAN</h5>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border:1px solid;">
            <div class="col-lg-12 pt-1 pb-1 pr-0">
                * Beri tanda ✔ pada tanda <input type="checkbox" onclick="return false">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-lg-4" style="border: 1px solid; border-top:1px solid transparent; border-right:1px solid transparent;">
                <div class="form-group pt-2">
                    <label>Dokter Operator : </label>
                    <div class="input-group">
                        <input type="hidden" value="{{ $data ? $data->id_dokter_operator : '' }}" name="id_dokter_operator">
                        <input type="text" value="{{ $data ? $data->dokter_operator : '' }}" name="dokter_operator" readonly class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_employee('dokter_operator')"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="border: 1px solid; border-top:1px solid transparent; border-right:1px solid transparent;">
                <div class="form-group pt-2">
                    <label>Asisten Operator : </label>
                    <div class="input-group">
                        <input type="hidden" value="{{ $data ? $data->id_asisten_operator : '' }}" name="id_asisten_operator">
                        <input type="text" value="{{ $data ? $data->asisten_operator : '' }}" name="asisten_operator" readonly class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_employee('asisten_operator')"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="border: 1px solid; border-top:1px solid transparent;">
                <div class="form-group pt-2">
                    <label>Instrumen : </label>
                    <div class="input-group">
                        <input type="hidden" value="{{ $data ? $data->id_instrumen : '' }}" name="id_instrumen">
                        <input type="text" value="{{ $data ? $data->instrumen : '' }}" name="instrumen" readonly class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_employee('instrumen')"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="border: 1px solid; border-top:1px solid transparent; border-right:1px solid transparent; border-bottom:1px solid transparent;">
                <div class="form-group pt-2">
                    <label>Spesialis Anestesi : </label>
                    <div class="input-group">
                        <input type="hidden" value="{{ $data ? $data->id_spesialis_anestesi : '' }}" name="id_spesialis_anestesi">
                        <input type="text" value="{{ $data ? $data->spesialis_anestesi : '' }}" name="spesialis_anestesi" readonly class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_employee('spesialis_anestesi')"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="border: 1px solid; border-top:1px solid transparent; border-right:1px solid transparent; border-bottom:1px solid transparent;">
                <div class="form-group pt-2">
                    <label>Asisten Anestesi : </label>
                    <div class="input-group">
                        <input type="hidden" value="{{ $data ? $data->id_asisten_anestesi : '' }}" name="id_asisten_anestesi">
                        <input type="text" value="{{ $data ? $data->asisten_anestesi : '' }}" name="asisten_anestesi" readonly class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_employee('asisten_anestesi')"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="border: 1px solid; border-top:1px solid transparent; border-bottom:1px solid transparent;">
                <div class="form-group pt-2">
                    <label>Jenis Anestesi : </label>
                    <select name="jenis_anestesi" id="jenis_anestesi" class="form-control">
                        <option value="">--Select Here--</option>
                        <option {{ $data ? $data->jenis_anestesi == 'ANESTESI GENERAL (GA)' ? 'selected' : '' : '' }} value="ANESTESI GENERAL (GA)">ANESTESI GENERAL (GA)</option>
                        <option {{ $data ? $data->jenis_anestesi == 'ANESTESI SPINAL' ? 'selected' : '' : '' }} value="ANESTESI SPINAL">ANESTESI SPINAL</option>
                        <option {{ $data ? $data->jenis_anestesi == 'ANESTESI LOKAL' ? 'selected' : '' : '' }} value="ANESTESI LOKAL">ANESTESI LOKAL</option>
                        <option {{ $data ? $data->jenis_anestesi == 'ANESTESI TIVA' ? 'selected' : '' : '' }} value="ANESTESI TIVA">ANESTESI TIVA</option>
                    </select>
                    <!-- <div class="input-group">
                        <input type="hidden" value="{{ $data ? $data->id_jenis_anestesi : '' }}" name="id_jenis_anestesi">
                        <input type="text" value="{{ $data ? $data->jenis_anestesi : '' }}" name="jenis_anestesi" readonly class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="open_modal_employee('jenis_anestesi')"><i class="fa fa-list"></i></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border:1px solid;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid;">
                    <td class="pl-2" style="width: 15%;">Diagnosis Pra Bedah</td>
                    <td style="width: 3%;"> : </td>
                    <td colspan="2">
                        {{-- <input type="text" class="form-control" name="diagnosa_pra_bedah" value="{{ $data ? $data->diagnosa_pra_bedah : '' }}"> --}}
                        <textarea name="diagnosa_pra_bedah" onkeydown="if(event.key === 'Enter') event.preventDefault();" class="form-control">{{ $data ? $data->diagnosa_pra_bedah : '' }}</textarea>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid;">
                    <td class="pl-2" style="width: 15%;">Diagnosis Pasca Bedah</td>
                    <td style="width: 3%;"> : </td>
                    <td colspan="2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="diagnosis_pasca_bedah" value="{{ $data ? $data->diagnosis_pasca_bedah : ($diagnosa ? $diagnosa->diagnosa_pasca_bedah : '') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-dark" onclick="open_modal_diagnosis_pasca_bedah()"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid;">
                    <td class="pl-2" style="width: 15%;">Tindakan</td>
                    <td style="width: 3%;"> : </td>
                    <td colspan="2">
                        <div class="input-group">
                            <input type="text" name="tindakan" class="form-control" value="{{ $data ? $data->tindakan : '' }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-dark" onclick="open_modal_tindakan()"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid;">
                    <td class="pl-2" style="width: 15%;">Indikasi Operasi</td>
                    <td style="width: 3%;"> : </td>
                    <td style="width: 50%;">
                        <div class="input-group">
                            <input type="text" name="indikasi_operasi" value="{{ $data ? $data->indikasi_operasi : '' }}" class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-dark"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                    <td style="border-left: 1px solid;" class="pl-3">
                        Posisi : <input type="radio" name="posisi" {{ $data ? $data->posisi == 'supine' ? 'checked' : '' : '' }} value="supine"> Supine / <input type="radio" name="posisi" {{ $data ? $data->posisi == 'miring' ? 'checked' : '' : '' }} value="miring"> Miring / <input type="radio" name="posisi" {{ $data ? $data->posisi == 'tengkurap' ? 'checked' : '' : '' }} value="tengkurap"> Tengkurap  / <input type="radio" name="posisi" {{ $data ? $data->posisi == 'litotomi' ? 'checked' : '' : '' }} value="litotomi"> Litotomi
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid;">
                    <td class="pl-2 pt-2 pb-2" style="width: 15%;">Jenis Pembedahan</td>
                    <td style="width: 3%;"> : </td>
                    <td style="width: 50%;">
                        <input type="radio" name="jenis_pembedahan" {{ $data ? $data->jenis_pembedahan == 'khusus' ? 'checked' : '' : '' }} value="khusus"> Khusus
                        <input type="radio" class="ml-3" name="jenis_pembedahan" {{ $data ? $data->jenis_pembedahan == 'besar' ? 'checked' : '' : '' }} value="besar"> Besar
                        <input type="radio" class="ml-3" name="jenis_pembedahan" {{ $data ? $data->jenis_pembedahan == 'sedang' ? 'checked' : '' : '' }} value="sedang"> Sedang
                        <input type="radio" class="ml-3" name="jenis_pembedahan" {{ $data ? $data->jenis_pembedahan == 'kecil' ? 'checked' : '' : '' }} value="kecil"> Kecil
                    </td>
                    <td style="border-left: 1px solid;" class="pl-3">
                        <input type="radio" name="jenis_pembedahan_rencana" {{ $data ? $data->jenis_pembedahan_rencana == 'terencana' ? 'checked' : '' : '' }} value="terencana"> Terencana
                        <input type="radio" class="ml-3" name="jenis_pembedahan_rencana" {{ $data ? $data->jenis_pembedahan_rencana == 'gawat_darurat' ? 'checked' : '' : '' }} value="gawat_darurat"> Gawat Darurat
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid;">
                    <td class="pl-2 pt-2 pb-2" style="width: 15%;">Jenis Luka Operasi</td>
                    <td style="width: 3%;"> : </td>
                    <td colspan="2">
                        <input type="radio" name="jenis_luka_operasi" {{ $data ? $data->jenis_luka_operasi == 'bersih' ? 'checked' : '' : '' }} value="bersih"> Bersih
                        <input type="radio" class="ml-3" name="jenis_luka_operasi" {{ $data ? $data->jenis_luka_operasi == 'bersih_terkontaminasi' ? 'checked' : '' : '' }} value="bersih_terkontaminasi"> Bersih Terkontaminasi
                        <input type="radio" class="ml-3" name="jenis_luka_operasi" {{ $data ? $data->jenis_luka_operasi == 'terkontaminasi' ? 'checked' : '' : '' }} value="terkontaminasi"> Terkontaminasi
                        <input type="radio" class="ml-3" name="jenis_luka_operasi" {{ $data ? $data->jenis_luka_operasi == 'kotor' ? 'checked' : '' : '' }} value="kotor"> Kotor/Terinfeksi
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-lg-3 pt-2 pb-2" style="border: 1px solid; border-top:1px solid transparent; border-right:1px solid transparent;">
                <p>Tanggal : </p>
                <input type="text" name="tanggal" value="{{ $data ? date('d-m-Y', strtotime($data->tanggal)) : date('d-m-Y') }}" class="form-control tanggal_dmy">
            </div>
            <div class="col-lg-3 pt-2 pb-2" style="border: 1px solid; border-top:1px solid transparent; border-right:1px solid transparent;">
                <p>Mulai : </p>
                <input type="text" name="mulai" value="{{ $data ? date('H:i', strtotime($data->mulai)) : '' }}" class="form-control timepicker">
            </div>
            <div class="col-lg-3 pt-2 pb-2" style="border: 1px solid; border-top:1px solid transparent; border-right:1px solid transparent;">
                <p>Selesai : </p>
                <input type="text" name="selesai" value="{{ $data ? date('H:i', strtotime($data->selesai)) : '' }}" class="form-control timepicker">
            </div>
            <div class="col-lg-3 pt-2 pb-2" style="border: 1px solid; border-top:1px solid transparent;">
                <p>Lama Pembedahan : </p>
                <input type="text" name="lama_pembedahan" value="{{ $data ? $data->lama_pembedahan : '' }}" readonly class="form-control">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border:1px solid;">
            <div class="col-lg-12 pt-2 pb-2">
                <p>LAPORAN PEMBEDAHAN : </p>
                <textarea name="laporan_pembedahan" class="form-control" cols="30" rows="16">{{ $data ? $data->laporan_pembedahan : '' }}</textarea>
                <input type="file" name="lampiran_pembedahan" class="mt-2">
                @if($data && $data->lampiran_pembedahan != '')
                <br>
                <br>
                <img style="width: 100%;" src="{{ asset('lampiran_pembedahan/'.$data->lampiran_pembedahan) }}" alt="">
                @endif
            </div>
            <div class="col-lg-12 pb-2 text-center">
                <button type="submit" id="btn_simpan" class="btn btn-success">Simpan</button>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-lg-8 pt-2" style="border: 1px solid;">
                <table style="border-collapse: collapse; width:100%">
                    <tr>
                        <td style="width: 17%;">No. Batch Impian</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 80%;">
                            <input class="form-control" name="no_batch" value="{{ $data ? $data->no_batch : '' }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Komplikasi</td>
                        <td> : </td>
                        <td>
                            <input class="form-control" name="komplikasi" value="{{ $data ? $data->komplikasi : '' }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Pendarahan</td>
                        <td> : </td>
                        <td>
                            <input class="form-control" name="pendarahan" value="{{ $data ? $data->pendarahan : '' }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Dikirim PA</td>
                        <td> : </td>
                        <td class="pt-1">
                            <input type="radio" name="dikirim_pa" {{ $data ? $data->dikirim_pa == 'ya' ? 'checked' : '' : '' }} value="ya"> Ya
                            <input type="radio" name="dikirim_pa" {{ $data ? $data->dikirim_pa == 'tidak' ? 'checked' : '' : '' }} class="ml-3" value="tidak"> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td>Asal Jaringan</td>
                        <td> : </td>
                        <td>
                            <input class="form-control" name="asal_jaringan" value="{{ $data ? $data->asal_jaringan : '' }}" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-style: italic;">* Instruksi Post Op Ditulis Dalam CPPT</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4 pt-2" id="box_ttd" onclick="open_modal_verifikasi()" style="border: 1px solid; text-align: center;">
                <p>Dokter Operator</p>
                @if ($dokumen->id_verifikator == 0)
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>(...................................................)<br>Ttd & Nama Terang</p>
                @else
                @if (isset($employee))
                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 4cm; width: 5cm;" alt="">
                @else
                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 4cm; width: 5cm;" alt="">
                @endif
                <br>({{ $dokumen->nama_verifikator }})
                @endif
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Tindakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tabel_tindakan">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Tindakan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_diagnosis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Diagnosa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tabel_diagnosis">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Diagnosa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tabel_employee">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
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
                <form action="{{ url('e_rekam_medis/detail/dokumen_laporan_pembedahan/verifikasi') }}" method="post">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" id="" required>
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
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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

    $('.tanggal_dmy').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        setUmur();
    });

    $('.tanggal_dmy').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('[name=mulai]').change(function() {
        hitung_lama_operasi('mulai');
    })

    $('[name=selesai]').change(function() {
        hitung_lama_operasi('selesai');
    })

    function hitung_lama_operasi(param) {
        console.log($('[name=mulai]').val());
        if ($('[name=mulai]').val() == '' || $('[name=selesai]').val() == '') {
            $('[name=lama_pembedahan]').val('');
            return;
        }

        if ($('[name=selesai]').val() != '') {
            if ($('[name=selesai]').val() < $('[name=mulai]').val()) {
                // alert('Jam selesai tidak boleh lebih dahulu dari jam mulai');
                // $('[name=selesai]').val('');
                $('[name=lama_pembedahan]').val('');
                return;
            }
        }

        if ($('[name=mulai]').val() != '' && $('[name=selesai]').val() != '') {
            $('[name=lama_pembedahan]').val(selisih_hari($('[name=selesai]').val(), $('[name=mulai]').val()))
        }else{
            $('[name=lama_pembedahan]').val('');
        }
    }

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

    function selisih_hari(date1, date2) {
        // const ONE_DAY = 1000 * 60 * 60;

        // const differenceMs = Math.abs(date1 - date2);
        var time_start = new Date();
        var time_end = new Date();
        var value_start = (date2+':00').split(':');
        var value_end = (date1+':00').split(':');

        time_start.setHours(value_start[0], value_start[1], value_start[2], 0)
        time_end.setHours(value_end[0], value_end[1], value_end[2], 0)

        let diff = time_end - time_start // millisecond 
        let menit = (diff / 60000);
        let sisa_menit = menit % 60;

        console.log(menit);
        console.log(sisa_menit);

        return Math.floor(menit/60) + ' Jam' + (sisa_menit > 0 ? ' '+sisa_menit+' Menit' : '');

    }

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/dokumen_laporan_pembedahan/store') }}",
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            method: 'post',
            success: function(response) {
                alert(response.message);
            }
        })
    })

    function open_modal_tindakan() {
        if ($.fn.DataTable.isDataTable("#tabel_tindakan")) {
            $('#tabel_tindakan').DataTable().clear().destroy();
        }

        $('#tabel_tindakan').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("e_rekam_medis/rawat_inap/datatable_tindakan_operasi") }}', // memanggil route yang menampilkan data json
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
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_tindakan(' + "'" + row.nama + "'" + ')"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });

        $('#modal_tindakan').modal('show');
    }

    function set_tindakan(value) {
        $('[name=tindakan]').val(value);
        $('#modal_tindakan').modal('hide');
    }

    function open_modal_diagnosis_pasca_bedah() {
        if ($.fn.DataTable.isDataTable("#tabel_diagnosis")) {
            $('#tabel_diagnosis').DataTable().clear().destroy();
        }

        $('#tabel_diagnosis').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("e_rekam_medis/rawat_inap/datatable_diagnosa") }}', // memanggil route yang menampilkan data json
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
                    data: 'icd',
                    name: 'icd',
                    render: function(data, type, row) {
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_diagnosis_pasca_bedah(' + "'" + row.nama + "','" + data + "'" + ')"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });

        $('#modal_diagnosis').modal('show');
    }

    function set_diagnosis_pasca_bedah(value, kode) {
        $('[name=kode_diagnosis_pasca_bedah]').val(kode);
        $('[name=diagnosis_pasca_bedah]').val(value);
        $('#modal_diagnosis').modal('hide');
    }

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

    function open_modal_verifikasi() {
        $('#modal_verifikasi').modal('show');
    }
</script>

</html>