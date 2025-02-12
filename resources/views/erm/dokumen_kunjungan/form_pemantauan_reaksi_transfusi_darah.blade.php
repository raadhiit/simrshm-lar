{{-- pending dluu --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Form Reaksi Transfusi Darah</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/datetimepicker-bootstrap/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap4.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <style>
        #table-masalah {
            width: 100%;
            border-collapse: collapse;
        }

        #table-masalah th,
        #table-masalah td {
            border: 1px solid black;
            text-align: left;
        }

        #table-transfusi {
            width: 100%;
            border-collapse: collapse;
        }

        #table-transfusi th,
        #table-transfusi td {
            border: 1px solid black;
            text-align: left;
        }

        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
        }

        .row-span {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            border-top: 1px solid black;
            padding: 5px;
        }

        .inputan {
            border: none;
            border-bottom: 1px dotted;
        }

        .tabel_collapse {
            width: 100%;
            border-collapse: collapse;
        }

        @media print {
            @page {
                margin: none;
                transform: scale(70);
            }

            .col-md-1 {
                width: 8%;
                float: left;
            }

            .col-md-2 {
                width: 16%;
                float: left;
            }

            .col-md-3 {
                width: 25%;
                float: left;
            }

            .col-md-4 {
                width: 33%;
                float: left;
            }

            .col-md-5 {
                width: 42%;
                float: left;
            }

            .col-md-6 {
                width: 50%;
                float: left;
            }

            .col-md-7 {
                width: 58%;
                float: left;
            }

            .col-md-8 {
                width: 66%;
                float: left;
            }

            .col-md-9 {
                width: 75%;
                float: left;
            }

            .col-md-10 {
                width: 83%;
                float: left;
            }

            .col-md-11 {
                width: 92%;
                float: left;
            }

            .col-md-12 {
                width: 100%;
                float: left;
            }

            #table-transfusi td:nth-child(10) {
                display: none;
            }

            #table-transfusi th:nth-child(4) {
                display: none;
            }

            #table-masalah th:nth-child(4) {
                display: none;
            }

            #table-masalah td:nth-child(4) {
                display: none;
            }

            .hidden-on-print {
                display: none;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>

</head>

<body style="margin: 20px;">
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

    <!-- Header -->
    <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-md-6" style="border: 1px solid;">
            <div class="row" style="width: 100%;">
                <div class="col-md-3" style="">
                    <img id="logo_rshm" src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
                </div>
                <div class="col-md-9" style="margin-top: 10px">
                    <p style="font-weight: bold; font-size:18px; text-align: left">
                        RUMAH SAKIT HARAPAN MULIA
                    </p>
                    <p style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
                        <span style="font-weight: normal">
                            Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                            <br>Kabupaten Bekasi Jawa Barat (17340).
                            <br>Telp.: (021) 8995 2340
                            <br>Email : info@rumahsakit-harapanmulia.id
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-left: 0; border:1px solid; padding:10px;">
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px;">
                <tr>
                    <td style="width: 40%;">Nama</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->nama }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">No Rekam Medis</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->id }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Tgl Lahir</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis Kelamin</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">NIK</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->ktp }}</td>
                </tr>
            </table>
        </div>
    </div>
    <!-- End Of Header -->

    <!-- isian -->
    <form style="margin-top: -17px; margin-left: 0;" id="form_dokumen">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center" style="background: black; padding-top: 5px;">
                <h6 class="text-white">FORM REAKSI TRANSFUSI DARAH</h6>
            </div>
        </div>

        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 pt-2 pb-2" style="border: 1px solid;">
                Tanggal Transfusi : <input type="text" name="tanggal_transfusi" value="{{ $data ? date('d-m-Y', strtotime($data->tanggal_transfusi)) : date('d-m-Y') }}" id="tanggal_transfusi" style="border: hidden; border-bottom: 1px dotted;" class="datepicker">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border-left: 1px solid; border-right: 1px solid;">
            <div class="col-md-4 pt-2 pb-2" style="border: hidden; border-right: 1px solid;">
                Nama Pasien : <input type="text" name="nama_pasien" value="{{ $data ? $data->nama_pasien : $pasien->nama }}" id="nama_pasien" style="border: hidden; border-bottom: 1px dotted; width: 60%;">
            </div>
            <div class="col-md-4 pt-2 pb-2" style="border: hidden; border-right: 1px solid;">
                <table class="tabel_collapse">
                    <tr>
                        <td style="width:30%;">Tanggal Lahir</td>
                        <td> : </td>
                        <td>
                            <input type="text" class="datepicker" name="tanggal_lahir" value="{{ $data ? date('d-m-Y', strtotime($data->tanggal_lahir)) : ($pasien ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '') }}" id="tanggal_lahir" style="border: hidden; border-bottom: 1px dotted;">
                        </td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td> : </td>
                        <td>
                            <input type="text" name="umur" id="umur" value="{{ $data ? $data->umur : ($layanan ? $layanan->umur : '') }}" style="border: hidden; border-bottom: 1px dotted;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 pt-2 pb-2">
                {{-- get rm for table, jadi readonly aja nanti ya mas --}}
                NO RM : <input type="text" name="nrm" id="nrm" style="border: hidden; border-bottom: 1px dotted;" value="{{ $data ? $data->nrm : $pasien->id }}" readonly>
                <br>
                <input type="hidden" name="nrm_sesuai">
                <span>
                    <input type="checkbox" id="nrm_sesuai" {{ $data && $data->nrm_sesuai == 'sesuai' ? 'checked' : '' }} value="sesuai"> Sesuai
                    <span style="margin-left: 40%;">&nbsp;</span>
                    <input type="checkbox" id="nrm_tidak_sesuai" {{ $data && $data->nrm_sesuai == 'tidak sesuai' ? 'checked' : '' }} value="tidak sesuai"> Tdk Sesuai
                </span>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border: 1px solid;">
            <div class="col-md-6 pt-2 pb-2" style="border: hidden; border-right: 1px solid;">
                Jenis Kelamin :
                <input type="hidden" name="kelamin">
                <label><input type="checkbox" value="0" {{ $data ? $data->kelamin == 0 ? 'checked' : ($pasien->kelamin == 0 ? 'checked' : '' ) : ($pasien->kelamin == 0 ? 'checked' : '' ) }} id="kelamin_l"> L</label>
                <span style="margin-left: 20%;">&nbsp;</span>
                <label><input type="checkbox" value="1" {{ $data ? $data->kelamin == 1 ? 'checked' : ($pasien->kelamin == 1 ? 'checked' : '' ) : ($pasien->kelamin == 1 ? 'checked' : '' ) }} id="kelamin_p"> P</label>
            </div>
            <div class="col-md-6 pt-2 pb-2">
                <table>
                    <tr>
                        <td style="width: 37%;">Nama Dokter Penanggung Jawab Pasien</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 60%;">
                            <div class="input-group">
                                <input type="text" value="{{ $data ? $data->nama_dokter_pj : '' }}" name="nama_dokter_pj" readonly id="nama_dokter_pj" style="border: hidden; border-bottom: 1px dotted; width: 90%;">
                                <div class="input-group-append hidden-on-print">
                                    <button type="button" onclick="open_modal_employee('dokter_pj')" class="btn btn-dark btn-sm"><i class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
            <div class="col-md-6 pt-2 pb-2" style="border: hidden; border-right: 1px solid;">
                Berat Badan :
                <input type="text" name="berat_badan_kg" class="ml-1" value="{{ $data ? $data->berat_badan_kg : '' }}" id="berat_badan_kilo" style="border: hidden; border-bottom: 1px dotted;"> Kg,
                <input type="text" name="berat_badan_gr" class="ml-2" value="{{ $data ? $data->berat_badan_gr : '' }}" id="berat_badan_gram" style="border: hidden; border-bottom: 1px dotted;"> Gr
            </div>
            <div class="col-md-6 pt-2 pb-2">
                Ruangan : <input type="text" name="ruangan" id="ruangan" value="{{ $data ? $data->ruangan : '' }}" class="ml-1" style="border: hidden; border-bottom: 1px dotted; width: 60%;">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border-left: 1px solid; border-right: 1px solid;">
            <div class="col-md-4 pt-2 pb-2" style="border: hidden; border-right: 1px solid;">
                Golongan Darah : <input type="text" name="golongan_darah" value="{{ $data ? $data->golongan_darah : '' }}" id="golongan_darah" class="ml-1" style="border: hidden; border-bottom: 1px dotted;">
            </div>
            <div class="col-md-4 pt-2 pb-2" style="border: hidden; border-right: 1px solid;">
                <input type="hidden" name="riwayat_transfusi_sebelumnya">
                Riwayat Transfusi Sebelumnya :
                <span style="margin-left: 10px;">
                    <label><input type="checkbox" id="riwayat_transfusi_ya" {{ $data && $data->riwayat_transfusi_sebelumnya == 'ya' ? 'checked' : '' }} value="ya"> Ya</label>
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <label><input type="checkbox" id="riwayat_transfusi_tidak" {{ $data && $data->riwayat_transfusi_sebelumnya == 'tidak' ? 'checked' : '' }} value="tidak"> Tidak</label>
                </span>
            </div>
            <div class="col-md-4 pt-2 pb-2">
                Jika Iya, Tanggal Berapa Transfusi<br>Sebelumnya :
                <input type="text" class="datepicker" value="{{ $data && $data->tanggal_transfusi_sebelumnya != '0000-00-00' ? date('d-m-Y', strtotime($data->tanggal_transfusi_sebelumnya)) : '' }}" name="tanggal_transfusi_sebelumnya" id="tanggal_transfusi_sebelumnya" style="border: hidden; border-bottom: 1px dotted; width: 50%;">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border: 1px solid;">
            <div class="col-md-6 pt-2 pb-2" style="border-right: 1px solid;">
                <input type="hidden" name="riwayat_kehamilan">
                <?php $riwayat_kehamilan = $data ? json_decode($data->riwayat_kehamilan) : [] ?>
                Riwayat Kehamilan :
                <span style=" margin-left: 5px;">
                    <label><input type="checkbox" id="g" value="g" {{ in_array('g', $riwayat_kehamilan) ? 'checked' : '' }}> G</label>
                    <span style="margin-left: 10%;">&nbsp;</span>
                    <label><input type="checkbox" id="p" value="p" {{ in_array('p', $riwayat_kehamilan) ? 'checked' : '' }}> P</label>
                    <span style="margin-left: 10%;">&nbsp;</span>
                    <label><input type="checkbox" id="a" value="a" {{ in_array('a', $riwayat_kehamilan) ? 'checked' : '' }}> A</label>
                </span>
            </div>
            <div class="col-md-6 pt-2 pb-2">
                Riwayat Penyakit Berkaitan :
                <input type="text" name="riwayat_penyakit_berkaitan" value="{{ $data ? $data->riwayat_penyakit_berkaitan : '' }}" id="riwayat_penyakit_berkaitan" style="width: 60%; border: hidden; border-bottom: 1px dotted;">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
            <!-- Kolom Jenis Komponen Darah -->
            <div class="col-md-6 pt-2" style="border-right: 1px solid;">
                <input type="hidden" name="jenis_komponen_darah">
                <?php $jenis_komponen_darah = $data ? json_decode($data->jenis_komponen_darah) : [] ?>
                <p>Jenis Komponen Darah:</p>
                <div class="row">
                    <div class="col-md-4">
                        <label><input type="checkbox" id="jenis_darah_fwb" {{ in_array('FWB', $jenis_komponen_darah) ? 'checked' : '' }} value="FWB"> FWB</label>
                    </div>
                    <div class="col-md-4">
                        <label><input type="checkbox" id="jenis_darah_prc" {{ in_array('PRC', $jenis_komponen_darah) ? 'checked' : '' }} value="PRC"> PRC</label>
                    </div>
                    <div class="col-md-4">
                        <label><input type="checkbox" id="jenis_darah_ffp" {{ in_array('FFP', $jenis_komponen_darah) ? 'checked' : '' }} value="FFP"> FFP</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label><input type="checkbox" id="jenis_darah_ahf" {{ in_array('AHF', $jenis_komponen_darah) ? 'checked' : '' }} value="AHF"> AHF</label>
                    </div>
                    <div class="col-md-4">
                        <label><input type="checkbox" id="jenis_darah_tc" {{ in_array('TC', $jenis_komponen_darah) ? 'checked' : '' }} value="TC"> TC</label>
                    </div>
                    <div class="col-md-4">
                        <label><input type="checkbox" id="jenis_darah_lain_lain" {{ in_array('lain-lain', $jenis_komponen_darah) ? 'checked' : '' }} value="lain-lain"> Lain-lain</label>
                    </div>
                </div>
            </div>

            <!-- Kolom Volume / Unit -->
            <div class="col-md-3 pt-2" style="border-right: 1px solid;">
                Volume / Unit :
                <input type="text" name="volume_unit" value="{{ $data ? $data->volume_unit : '' }}" id="volume_unit" style="width: 100%; border:hidden; border-bottom: 1px dotted;">
            </div>

            <!-- Kolom No. Kantong Darah dan Tanggal Kadaluwarsa -->
            <div class="col-md-3 pt-2">
                No. kantong darah :
                <input type="text" name="no_kantong_darah" value="{{ $data ? $data->no_kantong_darah : '' }}" style="width: 100%; border: hidden; border-bottom: 1px dotted;">
                <p style="margin-top: 5px;">Tanggal Kadaluwarsa : </p>
                <input class="mb-2 datepicker" type="text" value="{{ $data && $data->tanggal_kadaluwarsa != '0000-00-00' ? date('d-m-Y', strtotime($data->tanggal_kadaluwarsa)) : '' }}" name="tanggal_kadaluwarsa" id="tanggal_kadaluwarsa" style="width: 100%; border: hidden; border-bottom: 1px dotted;">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;  border-left: 1px solid; border-right: 1px solid;">
            <div class="col-md-4" style="border: hidden; border-right: 1px solid;">
                <input type="hidden" name="golongan_darah_donor">
                Golongan Darah Donor :
                <br>
                <span>
                    <label><input type="checkbox" value="sesuai" {{ $data && $data->golongan_darah_donor == 'sesuai' ? 'checked' : '' }} id="golongan_darah_donor_sesuai"> Sesuai</label>
                    <span style="margin-left: 5%;">&nbsp;</span>
                    <label><input type="checkbox" value="tidak sesuai" {{ $data && $data->golongan_darah_donor == 'tidak sesuai' ? 'checked' : '' }} id="golongan_darah_donor_tidak_sesuai"> Tidak Sesuai</label>
                </span>
            </div>
            <div class="col-md-4" style="border: hidden; border-right: 1px solid;">
                <input type="hidden" name="cross_match">
                Dilakukan Cross Match?
                <span style="margin-left: 20px;">
                    <label><input type="checkbox" id="cross_match_ya" {{ $data && $data->cross_match == 'ya' ? 'checked' : '' }} value="ya"> Ya</label>
                    <label><input type="checkbox" id="cross_match_tidak" {{ $data && $data->cross_match == 'tidak' ? 'checked' : '' }} value="tidak" style="margin-left: 20px;"> Tidak</label>
                </span>
            </div>
            <div class="col-md-4">
                <input type="hidden" name="kompatibel">
                Kompatibel :
                <span style="margin-left: 20px;">
                    <label><input type="checkbox" value="ya" {{ $data && $data->kompatibel == 'ya' ? 'checked' : '' }} id="kompatibel_ya"> Ya</label>
                    <label><input type="checkbox" value="tidak" {{ $data && $data->kompatibel == 'tidak' ? 'checked' : '' }} id="kompatibel_tidak" style="margin-left: 20px;"> Tidak</label>
                </span>
                <br>
                <input type="hidden" name="skrining_antibodi">
                Skrining Antibodi :
                <span style="margin-left: 20px;">
                    <label><input type="checkbox" value="ya" {{ $data && $data->skrining_antibodi == 'ya' ? 'checked' : '' }} id="skrining_antibodi_ya"> Ya</label>
                    <label><input type="checkbox" value="tidak" {{ $data && $data->skrining_antibodi == 'tidak' ? 'checked' : '' }} id="skrining_antibodi_tidak" style="margin-left: 20px;"> Tidak</label>
                </span>
                <br>
                <input type="hidden" name="hasil_skrining_antibodi">
                Jika Ya, Hasil :
                <span style="margin-left: 20px;">
                    <label><input type="checkbox" value="positif" {{ $data && $data->hasil_skrining_antibodi == 'positif' ? 'checked' : '' }} id="skrining_hasil_positif"> (+) Positif</label>
                    <label><input type="checkbox" value="negatif" {{ $data && $data->hasil_skrining_antibodi == 'negatif' ? 'checked' : '' }} id="skrining_hasil_negatif" style="margin-left: 20px;"> (-) Negatif</label>
                </span>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <input type="hidden" name="masalah">
            <table id="table-masalah">
                <thead>
                    <tr>
                        <th class="text-center">Masalah Pasien Yang Ada</th>
                        <th class="text-center">Pengobatan Saat Ini</th>
                        <th class="text-center">Premedikasi Yang Diberikan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="list_masalah">

                </tbody>
            </table>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-2 pb-2 pt-2" style="border-right: 1px solid; border-left: 1px solid;">
                Double Check :
            </div>
            <div class="col-md-5 pb-2 pt-2" style="border-right: 1px solid;">
                <table class="tabel_collapse">
                    <tr>
                        <td style="width: 25%;">Nama Petugas 1</td>
                        <td> : </td>
                        <td style="width: 85%;">
                            <div class="input-group">
                                <input type="text" value="{{ $data ? $data->petugas_satu : '' }}" name="petugas_satu" id="petugas_satu" readonly style="border: none; border-bottom: 1px dotted; width:70%">
                                <div class="input-group-append hidden-on-print">
                                    <button type="button" onclick="open_modal_employee('petugas_1')" class="btn btn-dark btn-sm"><i class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-5 pb-2 pt-2" style="border-right: 1px solid;">
                <table class="tabel_collapse">
                    <tr>
                        <td style="width: 25%;">Nama Petugas 2</td>
                        <td> : </td>
                        <td style="width: 85%;">
                            <div class="input-group">
                                <input type="text" value="{{ $data ? $data->petugas_dua : '' }}" readonly name="petugas_dua" id="petugas_dua" style="border: none; border-bottom: 1px dotted; width:70%">
                                <div class="input-group-append hidden-on-print">
                                    <button type="button" onclick="open_modal_employee('petugas_2')" class="btn btn-dark btn-sm"><i class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center" style="border: 1px solid;">
                <span style="font-weight: bold;">PEMANTAUAN TRANSFUSI DARAH</span>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;  border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
            <div class="col-md-6 pt-2 pb-2" style="border-right: 1px solid;">
                Jam Mulai :
                <input type="text" value="{{ $data ? $data->jam_mulai : '' }}" class="timepicker" name="jam_mulai" id="jam_mulai" style="border: hidden; border-bottom: 1px dotted; width: 80%;">
            </div>
            <div class="col-md-6 pt-2 pb-2">
                Jam Berakhir :
                <input type="text" value="{{ $data ? $data->jam_berakhir : '' }}" class="timepicker" name="jam_berakhir" id="jam_berakhir" style="border: hidden; border-bottom: 1px dotted; width: 80%;">
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border-left: 1px solid; border-right: 1px solid;">
            <div class="col-md-12 pt-2 pb-2">
                Kecepatan Tetesan : <input type="text" value="{{ $data ? $data->kecepatan_tetesan : '' }}" name="kecepatan_tetesan" id="kecepatan_tetesan" style="border: hidden; border-bottom: 1px dotted; width: 85%;">
            </div>
        </div>
        <input type="hidden" name="tanda_vital">
        <input type="hidden" name="gejala">
        <input type="hidden" name="lain_lain">
        <div class="row" style="width: 100%; margin-left: 0;" id="box_tabel_transfusi">

        </div>
        <div class="row py-2" style="width: 100%; margin-left: 0; border-left: 1px solid; border-bottom: 1px solid; border-right: 1px solid;">
            <div class="col-12" style="margin-left: 0;">
                <h6>
                    Mohon isi form ini dengan lengkap dan jelas, kirim rangkap ke 2 dari form ini ke bangian bank darah 30 menit seteleh
                    pemantauan transufsi selesai. Bila terjadi reaksi transfusi, sertakan kantong sisa darah dan contoh darah yang baru dalam tabung bertutup merah dan ungu.
                </h6>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0; border-bottom: 1px solid; border-left: 1px solid;">
            <div class="col-md-6 text-center" style="border-right: 1px solid;">
                <div class="form-group">
                    <label for="">Nama Dokter</label>
                    <div class="input-group">
                        <input type="text" value="{{ $data ? $data->nama_dokter : '' }}" name="nama_dokter" readonly id="nama_dokter" style="width: 95%; border:none; border-bottom: 1px dotted;">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-dark btn-sm hidden-on-print" onclick="open_modal_employee('dokter')"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center" style="border-right: 1px solid;">
                <div class="form-group">
                    <label for="">Nama Perawat</label>
                    <div class="input-group">
                        <input type="text" value="{{ $data ? $data->nama_perawat : '' }}" name="nama_perawat" readonly id="nama_perawat" style="width: 95%; border:none; border-bottom: 1px dotted;">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-dark btn-sm hidden-on-print" onclick="open_modal_employee('perawat')"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hidden-on-print" style="margin-left: 0; width:100%;">
            <div class="col-lg-12 text-center pt-3">
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>
        </div>
    </form>
    <!-- End Of isian -->

    <div class="modal fade" id="modal_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tabel_employee" style="width: 100%;">
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
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>
    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD-MM-Y'
        },
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
    });

    $('.timepicker').daterangepicker({
        locale: {
            format: 'HH:mm'
        },
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('.datetimepicker').daterangepicker({
        locale: {
            format: 'DD-MM-Y HH:mm'
        },
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });

    $('.datepicker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('.datepicker').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    $('.timepicker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('HH:mm'));
    });

    $('.timepicker').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
</script>
<script>
    $('#kelamin_l').click(function() {
        if ($('#kelamin_l').is(':checked')) {
            $('#kelamin_p').prop('checked', false);
        }
    })

    $('#kelamin_p').click(function() {
        if ($('#kelamin_p').is(':checked')) {
            $('#kelamin_l').prop('checked', false);
        }
    })

    $('#norm_sesuai').click(function() {
        if ($('#norm_sesuai').is(':checked')) {
            $('#norm_tidak_sesuai').prop('checked', false);
        }
    })

    $('#norm_tidak_sesuai').click(function() {
        if ($('#norm_tidak_sesuai').is(':checked')) {
            $('#norm_sesuai').prop('checked', false);
        }
    })

    $('#golongan_darah_donor_sesuai').click(function() {
        if ($('#golongan_darah_donor_sesuai').is(':checked')) {
            $('#golongan_darah_donor_tidak_sesuai').prop('checked', false);
        }
    })

    $('#golongan_darah_donor_tidak_sesuai').click(function() {
        if ($('#golongan_darah_donor_tidak_sesuai').is(':checked')) {
            $('#golongan_darah_donor_sesuai').prop('checked', false);
        }
    })

    $('#cross_match_ya').click(function() {
        if ($('#cross_match_ya').is(':checked')) {
            $('#cross_match_tidak').prop('checked', false);
        }
    })

    $('#cross_match_tidak').click(function() {
        if ($('#cross_match_ya').is(':checked')) {
            $('#cross_match_ya').prop('checked', false);
        }
    })

    $('#kompatibel_tidak').click(function() {
        if ($('#kompatibel_ya').is(':checked')) {
            $('#kompatibel_ya').prop('checked', false);
        }
    })

    $('#kompatibel_ya').click(function() {
        if ($('#kompatibel_tidak').is(':checked')) {
            $('#kompatibel_tidak').prop('checked', false);
        }
    })

    $('#skrining_antibodi_tidak').click(function() {
        if ($('#skrining_antibodi_ya').is(':checked')) {
            $('#skrining_antibodi_ya').prop('checked', false);
        }
    })

    $('#skrining_antibodi_ya').click(function() {
        if ($('#skrining_antibodi_tidak').is(':checked')) {
            $('#skrining_antibodi_tidak').prop('checked', false);
        }
    })

    $('#skrining_hasil_positif').click(function() {
        if ($('#skrining_hasil_positif').is(':checked')) {
            $('#skrining_hasil_negatif').prop('checked', false);
        }
    })

    $('#skrining_hasil_negatif').click(function() {
        if ($('#skrining_hasil_negatif').is(':checked')) {
            $('#skrining_hasil_positif').prop('checked', false);
        }
    })

    $('#riwayat_transfusi_ya').click(function() {
        if ($('#riwayat_transfusi_ya').is(':checked')) {
            $('#riwayat_transfusi_tidak').prop('checked', false);
        }
    })

    $('#riwayat_transfusi_tidak').click(function() {
        if ($('#riwayat_transfusi_tidak').is(':checked')) {
            $('#riwayat_transfusi_ya').prop('checked', false);
        }
    })
</script>
<script>
    let masalah = [{
        'masalah': '',
        'pengobatan': '',
        'premedikasi': '',
    }];

    let tanda_vital = [{
        'parameter': '',
        'jam_satu': '',
        'jam_dua': '',
        'jam_tiga': '',
        'jam_empat': '',
        'jam_lima': '',
        'jam_enam': '',
        'jam_tujuh': '',
        'catatan': '',
    }];

    let gejala = [{
        'parameter': '',
        'jam_satu': '',
        'jam_dua': '',
        'jam_tiga': '',
        'jam_empat': '',
        'jam_lima': '',
        'jam_enam': '',
        'jam_tujuh': '',
        'catatan': '',
    }];

    let lain_lain = [{
        'parameter': '',
        'jam_satu': '',
        'jam_dua': '',
        'jam_tiga': '',
        'jam_empat': '',
        'jam_lima': '',
        'jam_enam': '',
        'jam_tujuh': '',
        'catatan': '',
    }];

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();

        $('[name=nrm_sesuai]').val($('#nrm_sesuai').is(':checked') ? $('#nrm_sesuai').val() : ($('#nrm_tidak_sesuai').is(':checked') ? $('#nrm_tidak_sesuai').val() : ''));
        $('[name=kelamin]').val($('#kelamin_l').is(':checked') ? $('#kelamin_l').val() : ($('#kelamin_p').is(':checked') ? $('#kelamin_p').val() : ''));
        $('[name=riwayat_transfusi_sebelumnya]').val($('#riwayat_transfusi_ya').is(':checked') ? $('#riwayat_transfusi_ya').val() : ($('#riwayat_transfusi_tidak').is(':checked') ? $('#riwayat_transfusi_tidak').val() : ''));

        let riwayat_kehamilan = [];

        if ($('#g').is(':checked')) {
            riwayat_kehamilan.push($('#g').val());
        }

        if ($('#p').is(':checked')) {
            riwayat_kehamilan.push($('#p').val());
        }

        if ($('#a').is(':checked')) {
            riwayat_kehamilan.push($('#a').val());
        }

        $('[name=riwayat_kehamilan]').val(JSON.stringify(riwayat_kehamilan));

        let jenis_komponen_darah = [];

        if ($('#jenis_darah_fwb').is(':checked')) {
            jenis_komponen_darah.push($('#jenis_darah_fwb').val());
        }
        if ($('#jenis_darah_prc').is(':checked')) {
            jenis_komponen_darah.push($('#jenis_darah_prc').val());
        }
        if ($('#jenis_darah_ffp').is(':checked')) {
            jenis_komponen_darah.push($('#jenis_darah_ffp').val());
        }
        if ($('#jenis_darah_ahf').is(':checked')) {
            jenis_komponen_darah.push($('#jenis_darah_ahf').val());
        }
        if ($('#jenis_darah_tc').is(':checked')) {
            jenis_komponen_darah.push($('#jenis_darah_tc').val());
        }
        if ($('#jenis_darah_lain_lain').is(':checked')) {
            jenis_komponen_darah.push($('#jenis_darah_lain_lain').val());
        }

        $('[name=jenis_komponen_darah]').val(JSON.stringify(jenis_komponen_darah));
        $('[name=golongan_darah_donor]').val($('#golongan_darah_donor_sesuai').is(':checked') ? $('#golongan_darah_donor_sesuai').val() : ($('#golongan_darah_donor_tidak_sesuai').is(':checked') ? $('#golongan_darah_donor_tidak_sesuai').val() : ''));
        $('[name=cross_match]').val($('#cross_match_ya').is(':checked') ? $('#cross_match_ya').val() : ($('#cross_match_tidak').is(':checked') ? $('#cross_match_tidak').val() : ''));
        $('[name=kompatibel]').val($('#kompatibel_ya').is(':checked') ? $('#kompatibel_ya').val() : ($('#kompatibel_tidak').is(':checked') ? $('#kompatibel_tidak').val() : ''));
        $('[name=skrining_antibodi]').val($('#skrining_antibodi_ya').is(':checked') ? $('#skrining_antibodi_ya').val() : ($('#skrining_antibodi_tidak').is(':checked') ? $('#skrining_antibodi_tidak').val() : ''));
        $('[name=hasil_skrining_antibodi]').val($('#skrining_hasil_positif').is(':checked') ? $('#skrining_hasil_positif').val() : ($('#skrining_hasil_negatif').is(':checked') ? $('#skrining_hasil_negatif').val() : ''));
        $('[name=masalah]').val(JSON.stringify(masalah));
        $('[name=tanda_vital]').val(JSON.stringify(tanda_vital));
        $('[name=gejala]').val(JSON.stringify(gejala));
        $('[name=lain_lain]').val(JSON.stringify(lain_lain));

        toastr.warning('Sedang menyimpan dokumen, harap tunggu...');

        $.ajax({
            url : "{{ url('e_rekam_medis/form_pemantauan_reaksi_transfusi_darah/store') }}",
            data : $('#form_dokumen').serialize(),
            method : 'post',
            success : function(response){
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }

                toastr.success(response.message);
            }
        })
    })

    $(document).ready(function() {
        <?php if($data) { ?>
            masalah = <?php echo $data->masalah ?>;
            tanda_vital = <?php echo $data->tanda_vital ?>;
            gejala = <?php echo $data->gejala ?>;
            lain_lain = <?php echo $data->lain_lain ?>;
        <?php } ?>

        render_tabel_transfusi();
        render_masalah();
    })

    function render_masalah() {
        var ins = '';
        for (let i = 0; i < masalah.length; i++) {
            ins += '<tr>' +
                '<td class="text-center"><input class="inputan" value="'+masalah[i].masalah+'" onkeyup="set_value_masalah('+i+')" type="text" id="masalah_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input class="inputan" value="'+masalah[i].pengobatan+'" onkeyup="set_value_masalah('+i+')" type="text" id="pengobatan_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input class="inputan" value="'+masalah[i].premedikasi+'" onkeyup="set_value_masalah('+i+')" type="text" id="premedikasi_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center">' +
                '<button type="button" onclick="add_row_masalah()" class="btn btn-primary mr-1"><i class="fa fa-plus"></i></a>' +
                '<button type="button" onclick="delete_row_masalah(' + i + ')" class="btn btn-danger"><i class="fa fa-trash"></i></a>' +
                '</td>' +
                '</tr>';
        }

        $('#list_masalah').html(ins);
    }

    function set_value_masalah(index){
        masalah[index] = {
            'masalah' : $('#masalah_'+index).val(),
            'pengobatan' : $('#pengobatan_'+index).val(),
            'premedikasi' : $('#premedikasi_'+index).val(),
        }
    }

    function add_row_masalah() {
        masalah.push({
            'masalah': '',
            'pengobatan': '',
            'premedikasi': '',
        });
        render_masalah();
    }

    function delete_row_masalah(index) {
        if (masalah.length == 1) {
            return;
        }
        masalah.splice(index, 1);
        render_masalah();
    }

    function render_tabel_transfusi() {

        let html_tanda_vital = render_tanda_vital();
        let html_gejala = render_gejala();
        let html_lain_lain = render_lain_lain();

        let = tabel = '<table id="table-transfusi">' +
            '<tr>' +
            '<th rowspan="3" colspan="2" class="text-center">PARAMATER</th>' +
            '<th colspan="7" class="text-center">WAKTU</th>' +
            '<th rowspan="2" class="text-center">CATATAN<br>TAMBAHAN</th>' +
            '<th rowspan="2" class="text-center" style="width: 7%;">ACTION</th>' +
            '</tr>' +
            '<tr>' +
            '<th class="text-center">15"</th>' +
            '<th class="text-center">30"</th>' +
            '<th class="text-center">1 Jam</th>' +
            '<th class="text-center">2 Jam</th>' +
            '<th class="text-center">3 Jam</th>' +
            '<th class="text-center">5 Jam</th>' +
            '<th class="text-center">12 Jam</th>' +
            '</tr>' +
            '<tr></tr>' +
            '<tr>' +
            '<th class="row-span" id="label_tanda_vital">TANDA VITAL</th>' +
            '</tr>' +
            html_tanda_vital +
            '<tr></tr>' +
            '<tr>' +
            '<th rowspan="3" class="row-span" id="label_gejala">GEJALA</th>' +
            '</tr>' +
            html_gejala +
            '<tr></tr>' +
            '<tr>' +
            '<th rowspan="3" class="row-span" id="label_lain_lain">LAIN - LAIN</th>' +
            '</tr>' +
            html_lain_lain +
            '</table>';

        $('#box_tabel_transfusi').html(tabel);
        $('#label_tanda_vital').attr('rowspan', tanda_vital.length + 1);
        $('#label_tanda_vital').css('text-align', 'center');
        $('#label_gejala').attr('rowspan', gejala.length + 1);
        $('#label_gejala').css('text-align', 'center');
        $('#label_lain_lain').attr('rowspan', lain_lain.length + 1);
        $('#label_lain_lain').css('text-align', 'center');
    }

    function render_tanda_vital() {
        var ins = '';
        for (let i = 0; i < tanda_vital.length; i++) {
            ins += '<tr>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].parameter + '" id="tanda_vital_parameter_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].jam_satu + '" id="tanda_vital_15_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].jam_dua + '" id="tanda_vital_30_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].jam_tiga + '" id="tanda_vital_1_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].jam_empat + '" id="tanda_vital_2_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].jam_lima + '" id="tanda_vital_3_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].jam_enam + '" id="tanda_vital_5_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].jam_tujuh + '" id="tanda_vital_12_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'tanda_vital'," + i + ')" value="' + tanda_vital[i].catatan + '" id="tanda_vital_catatan_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center">' +
                `<button type="button" class="btn btn-primary mr-1" onclick="add_row_transfusi('tanda_vital')"><i class="fa fa-plus"></i></a>` +
                `<button type="button" class="btn btn-danger" onclick="delete_row_transfusi('tanda_vital','` + i + `')"><i class="fa fa-trash"></i></a>` +
                '</td>' +
                '</tr>';
        }

        return ins;
    }

    function render_gejala() {
        var ins = '';
        for (let i = 0; i < gejala.length; i++) {
            ins += '<tr>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].parameter + '" id="gejala_parameter_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].jam_satu + '" id="gejala_15_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].jam_dua + '" id="gejala_30_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].jam_tiga + '" id="gejala_1_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].jam_empat + '" id="gejala_2_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].jam_lima + '" id="gejala_3_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].jam_enam + '" id="gejala_5_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].jam_tujuh + '" id="gejala_12_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'gejala'," + i + ')" value="' + gejala[i].catatan + '" id="gejala_catatan_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center">' +
                `<button type="button" class="btn btn-primary mr-1" onclick="add_row_transfusi('gejala')"><i class="fa fa-plus"></i></a>` +
                `<button type="button" class="btn btn-danger" onclick="delete_row_transfusi('gejala','` + i + `')"><i class="fa fa-trash"></i></a>` +
                '</td>' +
                '</tr>';
        }

        return ins;
    }

    function render_lain_lain() {
        var ins = '';
        for (let i = 0; i < lain_lain.length; i++) {
            ins += '<tr>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].parameter + '" id="lain_lain_parameter_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].jam_satu + '" id="lain_lain_15_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].jam_dua + '" id="lain_lain_30_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].jam_tiga + '" id="lain_lain_1_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].jam_empat + '" id="lain_lain_2_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].jam_lima + '" id="lain_lain_3_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].jam_enam + '" id="lain_lain_5_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].jam_tujuh + '" id="lain_lain_12_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center"><input type="text" class="inputan" onkeyup="set_value_transfusi(' + "'lain_lain'," + i + ')" value="' + lain_lain[i].catatan + '" id="lain_lain_catatan_' + i + '" style="width: 90%;"></td>' +
                '<td class="text-center">' +
                `<button type="button" class="btn btn-primary mr-1" onclick="add_row_transfusi('lain_lain')"><i class="fa fa-plus"></i></a>` +
                `<button type="button" class="btn btn-danger" onclick="delete_row_transfusi('lain_lain','` + i + `')"><i class="fa fa-trash"></i></a>` +
                '</td>' +
                '</tr>';
        }

        return ins;
    }

    function delete_row_transfusi(jenis, index) {
        switch (jenis) {
            case 'tanda_vital':
                if (tanda_vital.length == 1) {
                    return;
                }
                tanda_vital.splice(index, 1);
                break;
            case 'gejala':
                if (gejala.length == 1) {
                    return;
                }
                gejala.splice(index, 1);
                break;
            case 'lain_lain':
                if (lain_lain.length == 1) {
                    return;
                }
                lain_lain.splice(index, 1);
                break;

            default:
                break;
        }
        render_tabel_transfusi();
    }

    function add_row_transfusi(jenis) {
        switch (jenis) {
            case 'tanda_vital':
                tanda_vital.push({
                    'parameter': '',
                    'jam_satu': '',
                    'jam_dua': '',
                    'jam_tiga': '',
                    'jam_empat': '',
                    'jam_lima': '',
                    'jam_enam': '',
                    'jam_tujuh': '',
                    'catatan': '',
                });
                break;
            case 'gejala':
                gejala.push({
                    'parameter': '',
                    'jam_satu': '',
                    'jam_dua': '',
                    'jam_tiga': '',
                    'jam_empat': '',
                    'jam_lima': '',
                    'jam_enam': '',
                    'jam_tujuh': '',
                    'catatan': '',
                });
                break;
            case 'lain_lain':
                lain_lain.push({
                    'parameter': '',
                    'jam_satu': '',
                    'jam_dua': '',
                    'jam_tiga': '',
                    'jam_empat': '',
                    'jam_lima': '',
                    'jam_enam': '',
                    'jam_tujuh': '',
                    'catatan': '',
                });
                break;

            default:
                break;
        }
        render_tabel_transfusi();
    }

    function set_value_transfusi(jenis, index) {
        switch (jenis) {
            case 'tanda_vital':
                tanda_vital[index] = {
                    'parameter': $('#tanda_vital_parameter_' + index).val(),
                    'jam_satu': $('#tanda_vital_15_' + index).val(),
                    'jam_dua': $('#tanda_vital_30_' + index).val(),
                    'jam_tiga': $('#tanda_vital_1_' + index).val(),
                    'jam_empat': $('#tanda_vital_2_' + index).val(),
                    'jam_lima': $('#tanda_vital_3_' + index).val(),
                    'jam_enam': $('#tanda_vital_5_' + index).val(),
                    'jam_tujuh': $('#tanda_vital_12_' + index).val(),
                    'catatan': $('#tanda_vital_catatan_' + index).val(),
                };
                break;
            case 'gejala':
                gejala[index] = {
                    'parameter': $('#gejala_parameter_' + index).val(),
                    'jam_satu': $('#gejala_15_' + index).val(),
                    'jam_dua': $('#gejala_30_' + index).val(),
                    'jam_tiga': $('#gejala_1_' + index).val(),
                    'jam_empat': $('#gejala_2_' + index).val(),
                    'jam_lima': $('#gejala_3_' + index).val(),
                    'jam_enam': $('#gejala_5_' + index).val(),
                    'jam_tujuh': $('#gejala_12_' + index).val(),
                    'catatan': $('#gejala_catatan_' + index).val(),
                };
                break;
            case 'lain_lain':
                lain_lain[index] = {
                    'parameter': $('#lain_lain_parameter_' + index).val(),
                    'jam_satu': $('#lain_lain_15_' + index).val(),
                    'jam_dua': $('#lain_lain_30_' + index).val(),
                    'jam_tiga': $('#lain_lain_1_' + index).val(),
                    'jam_empat': $('#lain_lain_2_' + index).val(),
                    'jam_lima': $('#lain_lain_3_' + index).val(),
                    'jam_enam': $('#lain_lain_5_' + index).val(),
                    'jam_tujuh': $('#lain_lain_12_' + index).val(),
                    'catatan': $('#lain_lain_catatan_' + index).val(),
                };
                break;

            default:
                break;
        }
    }

    function open_modal_employee(jenis) {
        if ($.fn.DataTable.isDataTable("#tabel_employee")) {
            $('#tabel_employee').DataTable().clear().destroy();
        }

        $('#tabel_employee').DataTable({
            processing: true,
            serverSide: true,
            pagingType: 'simple',
            bLengthChange: false,
            ajax: jenis != 'dokter_pj' && jenis != 'dokter' ? '{{ url("e_rekam_medis/rawat_inap/datatable_employee") }}' : '{{ url("ajax_request/datatable_dokter") }}', // memanggil route yang menampilkan data json
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
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_employee(' + "'" + row.nama + "','" + jenis + "'" + ')"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });

        $('#modal_employee').modal('show');
    }

    function set_employee(nama, jenis) {
        switch (jenis) {
            case 'dokter_pj':
                $('#nama_dokter_pj').val(nama);
                break;
            case 'petugas_1':
                $('#petugas_satu').val(nama);
                break;
            case 'petugas_2':
                $('#petugas_dua').val(nama);
                break;
            case 'dokter':
                $('#nama_dokter').val(nama);
                break;
            case 'perawat':
                $('#nama_perawat').val(nama);
                break;

            default:
                break;
        }
        $('#modal_employee').modal('hide');
    }
</script>

</html>