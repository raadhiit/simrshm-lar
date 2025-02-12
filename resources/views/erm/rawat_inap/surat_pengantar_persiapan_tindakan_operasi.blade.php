<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar Tindakan Operasi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
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
        alert('{{ Session::get("message") }}');p
    </script>
    @endif
    <form class="container pl-0 pr-0 pb-3" id="form_dokumen" style="border: 1px solid transparent;" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
        <div class="row mt-2" style="width: 100%; margin-left: 0;">
            <div class="col-lg-12" style="text-align: right;">
                MR 02.26.001 Rev.0
            </div>
        </div>
        <div class="row pb-3" style="width: 100%; margin-left: 0;">
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
                            <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
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
                <h5 class="text-center pt-2 pb-2" style="background-color: lightgrey; margin-bottom:0">SURAT PENGANTAR PERSIAPAN TINDAKAN/OPERASI</h5>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border:1px solid;">
            <div class="col-lg-12 pt-2 pr-0 pb-3">
                <p>Kepada YTH</p>
                <p>Bagian Admission / Registrasi Kamar Operasi - VK</p>
                <p>RS Harapan Mulia</p>
                <span>Bersama ini kami kirim pasien : </span>
                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Diagnosis</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85;">
                            <input type="text" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" readonly value="{{ $diagnosa ? $diagnosa->diagnosa : '' }}" class="form-control">
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td>Atas Indikasi</td>
                        <td> : </td>
                        <td>
                            <textarea name="atas_indikasi" class="form-control" cols="30" rows="5">{{ $data ? $data->atas_indikasi : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">Untuk indikasi</td>
                    </tr>
                    <tr class="align-top">
                        <td>Tindakan</td>
                        <td> : </td>
                        <td>
                            <textarea name="tindakan" class="form-control" cols="30" rows="5">{{ $data ? $data->tindakan : '' }}</textarea>
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="pt-3">Pada Tanggal</td>
                        <td class="pt-3"> : </td>
                        <td class="pt-3">
                            <input type="date" name="tanggal" value="{{ $data ? date('Y-m-d', strtotime($data->tanggal)) : '' }}"> <input class="ml-3" {{ $data ? $data->ranap ? 'checked' : '' : '' }} type="radio" name="ranap" value="ranap"> dengan Rawat Inap / <input type="radio" name="ranap" {{ $data ? $data->tidak_dirawat ? 'checked' : '' : '' }} value="tidak_rawat"> tidak dirawat di RS Harapan Mulia
                        </td>
                    </tr>
                </table>
                <p>Adapun petunjuk untuk persiapan Operasi, Anestesi, dan tindakan medis lain telah kami beritahu sebagai berikut : </p>
                <ul style="list-style-type: numeric;">
                    <li>
                        Puasa<br>
                        <table style="border-collapse: collapse; width:100%">
                            <tr class="align-top">
                                <td style="width: 3%;">a.</td>
                                <td style="width: 14%;">Untuk Pasien Dewasa</td>
                                <td style="width: 3%;"> : </td>
                                <td colspan="3">6 Jam sebelum operasi</td>
                            </tr>
                            <tr class="align-top">
                                <td>b.</td>
                                <td>Untuk Pasien Anak</td>
                                <td> : </td>
                                <td>Umur<br>< 6 Bulan<br>6 - 36 Bulan<br>> 36 Bulan</td>
                                <td>Makanan padat/susu<br>4 Jam Sebelum Operasi<br>6 Jam Sebelum Operasi<br>6 Jam Sebelum Operasi</td>
                                <td>Air Jernih/mineral<br>2 Jam Sebelum Operasi<br>3 Jam Sebelum Operasi<br>3 Jam Sebelum Operasi</td>
                            </tr>
                        </table>
                    </li>
                    <li>
                        Sudah berada di RS Harapan Mulia<br>
                        <ul style="list-style-type: lower-alpha;">
                            <li>Untuk Operasi tanpa rawat inap minimal 2 jam sebelum Operasi.</li>
                            <li>
                                <?php $pp = $data ? json_decode($data->pemeriksaan_penunjang) : null ?>
                                Untuk Operasi Pagi Hari dengan rawat inap, harus datang sebelum jam 22:00 WIB<br>
                                Tujuan : <br>
                                <ul>
                                    <li>Agar pasien dapat beristirahat terlebih dahulu sehingga Basal Metabolisme (BMR) rendah untuk mengurangi bahaya komplikasi saat operasi</li>
                                    <li>
                                        <input type="hidden" name="pemeriksaan_penunjang">
                                        Persiapan pemeriksaan penunjang<br>
                                        1. <input type="checkbox" {{ $pp ? $pp->ekg ? 'checked' : '' : '' }} id="ekg"> EKG<span class="pl-5"></span>2. <input {{ $pp ? $pp->ctg ? 'checked' : '' : '' }} type="checkbox" id="ctg"> CTG<span class="pl-5"></span>3. <input type="checkbox" {{ $pp ? $pp->rontgent ? 'checked' : '' : '' }} id="rontgent"> Rontgent<span class="pl-5"></span>4. <input {{ $pp ? $pp->lainnya ? 'checked' : '' : '' }} type="checkbox" id="lainnya"> Lainya <input value="{{ $pp ? $pp->lain : '' }}" type="text" id="pp_lain" style="width: 30%;">
                                    </li>
                                </ul>
                            </li>
                            <li>Tidak diperkenankan memakai perhiasan, gigi palsu yang mudah lepas serta barang berharga lainnya</li>
                            <li>Catatan Medik : Diharapkan membawa semua catatan medik, bukti-bukti administrasi yang ada.</li>
                        </ul>
                    </li>
                </ul>
                <p>Demikian kami sampaikan agar ditindak lanjuti</p>
            </div>
            <div class="col-lg-12 text-center pb-4">
                <button type="submit" id="btn_simpan" class="btn btn-success">Simpan</button>
            </div>
            <div class="col-lg-8 pb-3"></div>
            <div class="col-lg-4 pb-3 text-center" id="box_ttd" onclick="open_modal_verifikasi()">
                Cibarusah, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}
                <br>
                @if ($dokumen->id_verifikator == 0)
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <span style="border-top: 1px solid;">Tanda Tangan & Nama Jelas</span>
                @else
                @if (isset($employee))
                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 4cm; width: 5cm;" alt="">
                @else
                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 4cm; width: 5cm;" alt="">
                @endif
                <br>
                <hr style="border-top: 1px solid; width:60%;">
                {{ $dokumen->nama_verifikator }}
                @endif
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('e_rekam_medis/detail/surat_pengantar_persiapan_tindakan_operasi/verifikasi') }}" method="post">
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $('#form_dokumen').submit(function(e){
        e.preventDefault();
        let pp = {
            'ekg' : $('#ekg').is(':checked') ? 1 : 0,
            'ctg' : $('#ctg').is(':checked') ? 1 : 0,
            'rontgent' : $('#rontgent').is(':checked') ? 1 : 0,
            'lainnya' : $('#lainnya').is(':checked') ? 1 : 0,
            'lain' : $('#pp_lain').val()
        };

        $('[name=pemeriksaan_penunjang]').val(JSON.stringify(pp));

        $.ajax({
            url : "{{ url('e_rekam_medis/detail/surat_pengantar_persiapan_tindakan_operasi/store') }}",
            data : $('#form_dokumen').serialize(),
            method : 'post',
            success:function(response){
                alert(response.message)
            }
        })
    })

    function open_modal_verifikasi(){
        $('#modal_verifikasi').modal('show');
    }
</script>
</html>