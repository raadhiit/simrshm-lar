<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Catatan Perkembangan Pasien Terintegrasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style type="text/css">
        .table_isian {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian_bordered td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        .table_isian_bordered th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        .table_isian2 tr {
            border: 1px solid black;
            border-collapse: collapse;
        }

        #tabel_tindakan_gawat_darurat tr td {
            border: 1px solid;
            padding-left: 10px;
        }

        #tabel_identitas_orang_tua tr td {
            border: 1px solid;
            padding-left: 10px;
        }

        #tabel_pengkajian_peristem tr td {
            border: 1px solid;
            padding-left: 10px;
        }

        .tabel_inner_peristem tr td {
            border: 1px solid transparent !important;
        }

        #tabel_riwayat_imunisasi tr td {
            border: 1px solid;
        }

        #tabel_skrining_nips tr th {
            border: 1px solid;
        }

        #tabel_skrining_nips tr td {
            border: 1px solid;
            padding-left: 10px;
        }

        .accordion-button:not(.collapsed)::after {
            background-color: transparent;
            background-image: url("https://cdn.pixabay.com/photo/2017/09/05/15/51/plus-2718200_960_720.png");
            transform: rotate(45deg);
            transition: transform 0.5s;
        }

        .accordion-button.collapsed::after {
            background-image: url("https://cdn.pixabay.com/photo/2017/09/05/15/51/plus-2718200_960_720.png");
        }

        .accordion-button:not(.collapsed) {
            color: yellow;
            background-color: #d2153d;
        }
    </style>
</head>

<body style="margin: 20px;">
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ url('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi_v2?dokumen='.$dokumen->id) }}" class="btn btn-outline-secondary">CPPT Saat Ini</a>
            <a href="{{ url('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi_v2/asesmen_medis_terakhir?dokumen='.$dokumen->id) }}" class="btn btn-success">Asesmen Medis Terakhir</a>
            <a href="{{ url('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi_v2/riwayat?dokumen='.$dokumen->id) }}" class="btn btn-outline-secondary">Riwayat CPPT</a>
        </div>
    </div>
    <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-lg-6" style="border: 1px solid;">
            <div class="row" style="width: 100%;">
                <div class="col-lg-3" style="">
                    <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
                </div>
                <div class="col-lg-9" style="margin-top: 10px">
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
        <div class="col-lg-6" style="margin-left: 0; border:1px solid; padding:10px;">
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px;">
                <tr>
                    <td style="width: 40%;">Nama</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nama_pasien }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">NIK</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->ktp }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">No Rekam Medis</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nrm }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Tgl Lahir</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis Kelamin</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="margin-top: -17px;">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
                <h6 style="color: white">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI</h6>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-lg-12 pt-3" style="padding-left:0; padding-right:0;">
            <div class="accordion" id="accordionExample">
                    <?php if (!is_null($asesmen_medis_awal_rajal)) { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button style="background-color: #34c21b; font-weight:bold; color:#fff;" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Kunjungan {{ ($asesmen_medis_awal_rajal->uri == 1 ? 'Rawat Inap' : 'Rawat Jalan') }} - {{ ucwords(str_replace('_', ' ', $asesmen_medis_awal_rajal->last_ruangan)) }} - {{ date('d-m-Y', strtotime($asesmen_medis_awal_rajal->tanggal_masuk)) }}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <iframe style="width: 100%; height:100vw;" src="{{ url('e_rekam_medis/detail/asesment_medis_awal_rawat_jalan?dokumen='.$asesmen_medis_awal_rajal->id) }}" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (!is_null($asesmen_gawat_darurat)) {
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" style="background-color: #34c21b; font-weight:bold; color:#fff;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Kunjungan {{ ($asesmen_gawat_darurat->uri == 1 ? 'Rawat Inap' : 'Rawat Jalan') }} - {{ ucwords(str_replace('_', ' ', $asesmen_gawat_darurat->last_ruangan)) }} - {{ date('d-m-Y', strtotime($asesmen_gawat_darurat->tanggal_masuk)) }}
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <iframe style="width: 100%; height:100vw;" src="{{ url('e_rekam_medis/detail/dokumen_asesment_awal_medis_gawat_darurat?dokumen='.$asesmen_gawat_darurat->id) }}" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!is_null($asesmen_awal_pasien_ranap)) { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" style="background-color: #34c21b; font-weight:bold; color:#fff;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Kunjungan {{ $asesmen_awal_pasien_ranap->uri == 1 ? 'Rawat Inap' : 'Rawat Jalan' }} - {{ ucwords(str_replace('_',' ', $asesmen_awal_pasien_ranap->last_ruangan)) }} - {{ date('d-m-Y', strtotime($asesmen_awal_pasien_ranap->tanggal_masuk)) }}
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php 
                                        switch($asesmen_awal_pasien_ranap->nama_dokumen) {
                                            case 'Asesmen Awal Pasien Rawat Inap (Neonatus)':
                                    ?>
                                            <iframe style="width: 100%; height:100vw;" src="{{ url('e_rekam_medis/detail/asesmen_awal_pasien_rawat_inap_neonatus?dokumen='.$asesmen_awal_pasien_ranap->id) }}" frameborder="0"></iframe>
                                    <?php 
                                            break;

                                            case 'Asesmen Awal Pasien Rawat Inap (Pediatrik)':
                                    ?>
                                            <iframe style="width: 100%; height:100vw;" src="{{ url('e_rekam_medis/detail/asesmen_awal_pasien_rawat_inap_pediatrik?dokumen='.$asesmen_awal_pasien_ranap->id) }}" frameborder="0"></iframe>
                                    <?php 
                                            break;

                                            case 'Formulir Asesmen Awal Pasien Rawat Inap Dewasa':
                                    ?>
                                            <iframe style="width: 100%; height:100vw;" src="{{ url('e_rekam_medis/detail/formulir_asesmen_awal_pasien_rawat_inap_dewasa?dokumen='.$asesmen_awal_pasien_ranap->id) }}" frameborder="0"></iframe>
                                    <?php
                                            break;

                                            default:
                                                # code...
                                                break;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</html>