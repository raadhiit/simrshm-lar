<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            font-family: sans-serif;
        }

        .pagebreak {
            page-break-before: always;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .identitas_pasien {
            padding: 8px;
            line-height: 23px;
            font-size: 14px;
        }

        .biodata_3 {
            line-height: 18px;
        }

        .hak tr td {
            vertical-align: top;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="row" style="width: 100%;">
        <div style="float: left; width: 20%; text-align: left; height: 120px;">
            <!-- <img src="{{ asset('filelogo/rolasmedika.png') }}" alt="" style="width:120%"> -->
            <img src="{{ asset('filelogo/kotakihc.png') }}" alt="" style="width:130%; margin-top: -20px;">
        </div>
        <div style="float: left; width: 60%; height: 120px; text-align: center;">
            <p style="color: #111; font-weight: bold; font-size: 18px;">
                PT. ROLAS NUSANTARA MEDIKA
                <br><span style="font-size: 20px; text-transform: uppercase;">{{$klinik->nama}}</span>
                <br><span style="font-size: 14px; text-transform: uppercase;">{{$klinik->alamat}}<br>{{ $klinik->telpon }}</span>
            </p>
        </div>
        <div style="float: left; width: 20%; text-align: left; height: 120px;">
            <!-- <img src="{{ asset('filelogo/kotakihc.jpg') }}" alt="" style="width:130%"> -->
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: left; border:1px solid">
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 70%; text-align: left;">
            <p>&nbsp;</p>
        </div>
        <div style="float: left; width: 30%; text-align: center;">
            <h4>
                Nomor Rekam Medis<br>
                @if(strlen($pasien->nrm) == 1)
                {{ '00000'.$pasien->nrm}}
                @elseif(strlen($pasien->nrm) == 2)
                {{ '0000'.$pasien->nrm}}
                @elseif(strlen($pasien->nrm) == 3)
                {{ '000'.$pasien->nrm}}
                @elseif(strlen($pasien->nrm) == 4)
                {{ '00'.$pasien->nrm}}
                @elseif(strlen($pasien->nrm) == 5)
                {{ '0'.$pasien->nrm}}
                @else
                {{ $pasien->nrm}}
                @endif
            </h4>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <h1 style="font-family: serif; font-size: 40px;">REKAM MEDIS PASIEN</h1>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <table style="width: 100%; border-collapse: collapse; font-size: 20px;">
                <tr>
                    <td style="text-align: right; width: 20%;">NAMA PASIEN</td>
                    <td style="padding-left: 5px; padding-right: 5px; width: 5%;"> : </td>
                    <td style="text-align: center; width:75%; padding-top: 8px; padding-bottom: 8px;">
                        <div style="border: 2px solid; border-radius: 10px; box-shadow: 10px 10px;">
                            <h4>{{$pasien->nama}}</h4>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; width: 20%;">ALAMAT</td>
                    <td style="padding-left: 5px; padding-right: 5px; width: 5%;"> : </td>
                    <td style="text-align: center; width:75%; padding-top: 8px; padding-bottom: 8px;">
                        <div style="border: 2px solid; border-radius: 10px; box-shadow: 10px 10px;">
                            <h4>{{$pasien->alamat}}<br>{{$pasien->kelurahan.' - '.$pasien->kecamatan.' - '.$pasien->kabupaten}}</h4>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; width: 20%;">STATUS</td>
                    <td style="padding-left: 5px; padding-right: 5px; width: 5%;"> : </td>
                    <td style="text-align: center; width:75%; padding-top: 8px; padding-bottom: 8px;">
                        <div style="border: 2px solid; border-radius: 10px; box-shadow: 10px 10px;">
                            <h4 style="text-transform: uppercase;">
                                @if($pasien->carabayar == 'bpjs' || $pasien->carabayar == 'asuransi')
                                {{$pasien->asuransi }}
                                @elseif($pasien->carabayar == 'perusahaan')
                                {{$pasien->carabayar.' - '.$pasien->nama_perusahaan }}
                                @else
                                {{'UMUM'}}
                                @endif
                            </h4>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 90%; text-align: center; padding-top: 60px;">
            <h1 style="text-align: center; color:red; font-size: 75px;">RAHASIA</h1>
            <div style="text-align: left; padding-top: 40px;">
                <p style="color: red;">
                    <span style="font-weight: bold;">PERHATIAN</span><br>
                    1. BERKAS REKAM MEDIS TIDAK BOLEH DIBAWA Pulang<br>
                    2. KEMBALIKAN SECEPATNYA KE BAGIAN REKAM MEDIS (2 X 24 JAM)
                </p>
            </div>
        </div>
        <div style="float: left; width: 10%; text-align: center; padding-top: 150px;">
            <table style="border-collapse: collapse; font-size: 20px;">
                <tr>
                    <th style="border: 1px solid; padding:10px">2021</th>
                </tr>
                <tr>
                    <th style="border: 1px solid; padding:10px">2022</th>
                </tr>
                <tr>
                    <th style="border: 1px solid; padding:10px">2023</th>
                </tr>
                <tr>
                    <th style="border: 1px solid; padding:10px">2024</th>
                </tr>
                <tr>
                    <th style="border: 1px solid; padding:10px">2025</th>
                </tr>
            </table>

        </div>
    </div>
    <div class="pagebreak"></div>
    <div class="row" style="width: 100%;">
        <div style="float: left; width: 65%; text-align: left; height: 100px;">
            <!-- <img src="{{ asset('filelogo/rolasmedika.png') }}" alt="" style="width:40%; margin-left: -30px;"> -->
            <img src="{{ asset('filelogo/kotakihc.png') }}" alt="" style="width:35%; margin-top: -20px;">
        </div>
        <div style="float: left; width: 35%; height: 100px;">
            <p style="color: #111; font-weight: bold; font-size: 14px; padding-top: 20px;">
                PT. ROLAS NUSANTARA MEDIKA
                <br><span style="text-transform: uppercase;">{{$klinik->nama}}</span>
                <br><span style="font-size: 12px; font-weight: normal; text-transform: uppercase;">{{$klinik->alamat}}<br>{{ $klinik->telpon }}</span>
            </p>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: left; border:1px solid">
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <p style="font-weight: bold; font-family: serif; font-size: 20px;">REKAM MEDIS PASIEN/PENDERITA GAWAT DARURAT</p>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; border:1px solid">
            <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
                <tr>
                    <td style="font-weight: bold;" colspan="3">DATA IDENTITAS PASIEN</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Nama Pasien</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->nama}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Tanggal Lahir</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Jenis Kelamin</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">@if($pasien->kelamin == 0){{'Laki-Laki'}}@else{{'Perempuan'}}@endif</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Agama</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->agama}}</td>
                </tr>
                <tr>
                    <td style="width: 20%; vertical-align: top;">Alamat</td>
                    <td style="padding-left: 3px; vertical-align: top; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->alamat.' - '.$pasien->kabupaten}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">No. HP</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->telpon}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">No. Telp</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->telpon}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Status Perkawinan</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->status}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Pendidikan</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->pendidikan}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Pekerjaan</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->pekerjaan}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Suku/Bangsa/Bahasa</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->suku}}</td>
                </tr>
            </table>
            <hr>
            <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
                <tr>
                    <td style="font-weight: bold;" colspan="3">ORANG YANG DAPAT DIHUBUNGI</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Nama</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->namapenanggungjawab}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Alamat</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->alamat_pj.' - '.$pasien->desa_pj.' - '.$pasien->kecamatan_pj.' - '.$pasien->kabupaten_pj}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">No. Telp</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->telponpenanggungjawab}}</td>
                </tr>
            </table>
            <hr>
            <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
                <tr>
                    <td style="font-weight: bold;" colspan="3">PENANGGUNG JAWAB BIAYA PERAWATAN</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Nama</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->namapenanggungjawab}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Alamat</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->alamat_pj.' - '.$pasien->desa_pj.' - '.$pasien->kecamatan_pj.' - '.$pasien->kabupaten_pj}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">No. Telp</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">{{$pasien->telponpenanggungjawab}}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Cara Pembayaran</td>
                    <td style="padding-left: 3px; padding-right: 3px; width:3%;"> : </td>
                    <td style="width: 77%; border-bottom: 2px dotted;">
                        @if($pasien->carabayar == 'bpjs' || $pasien->carabayar == 'asuransi')
                        {{$pasien->asuransi }}
                        @elseif($pasien->carabayar == 'perusahaan')
                        {{$pasien->carabayar.' - '.$pasien->nama_perusahaan }}
                        @else
                        {{'UMUM'}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 50%; text-align: center;">
            <p style="font-size: 14px;">PETUGAS PENDAFTARAN</p>
            <br>
            <br>
            <br>
            <br>
            <hr style="width: 60%;">
        </div>
        <div style="float: left; width: 50%; text-align: center;">
            <p style="font-size: 14px;">PASIEN / KELUARGA</p>
            <br>
            <br>
            <br>
            <br>
            <hr style="width: 60%;">
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 70%; text-align: center;">
            <p>&nbsp;</p>
        </div>
        <div style="float: left; width: 30%; text-align: center; padding-top: 10px;">
            <img src="{{ asset('filelogo/logoihc.png') }}" style="width: 100%;" alt="">
        </div>
    </div>
    <div class="pagebreak"></div>
    <div class="row" style="width: 100%;">
        <div style="float: left; width: 65%; text-align: left; height: 100px;">
            <!-- <img src="{{ asset('filelogo/rolasmedika.png') }}" alt="" style="width:40%; margin-left: -30px;"> -->
            <img src="{{ asset('filelogo/kotakihc.png') }}" alt="" style="width:35%; margin-top: -20px;">
        </div>
        <div style="float: left; width: 35%; height: 100px;">
            <p style="color: #111; font-weight: bold; font-size: 14px; padding-top: 20px;">
                PT. ROLAS NUSANTARA MEDIKA
                <br><span style="text-transform: uppercase;">{{$klinik->nama}}</span>
                <br><span style="font-size: 12px; font-weight: normal; text-transform: uppercase;">{{$klinik->alamat}}<br>{{ $klinik->telpon }}</span>
            </p>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: left; border:1px solid">
        </div>
    </div>
    <div class="row" style="padding-top: 5px;">
        <div style="float: left; width: 50%; border:1px solid; height:120px">
            <table style="border-collapse: collapse; font-size: 14px; margin:10px" class="biodata_3">
                <tr>
                    <td rowspan="2" style="width: 29%; vertical-align: top;">Nama</td>
                    <td rowspan="2" style="padding-left: 5px; padding-right: 5px; width:3%; vertical-align: top;"> : </td>
                    <td rowspan="2" style="width: 68%;">{{$pasien->nama}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>@if($pasien->kelamin == 0){{'Laki-Laki'}}@else{{'Perempuan'}}@endif</td>
                </tr>
                <tr>
                    <td>Telp / No. HP</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{$pasien->telpon}}</td>
                </tr>
            </table>
        </div>
        <div style="float: left; width: 50%; border:1px solid; height:120px">
            <table style="border-collapse: collapse; font-size: 14px; margin:10px; padding-right: 5px;" class="biodata_3">
                <tr>
                    <td style="width: 29%; vertical-align: top;">Alamat</td>
                    <td style="padding-left: 5px; padding-right: 5px; width:3%; vertical-align: top;"> : </td>
                    <td style="width: 68%;">{{$pasien->alamat}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{$pasien->kabupaten}}</td>
                </tr>
                <tr>
                    <td>Status Peserta</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td style="text-transform: uppercase;">
                        @if($pasien->carabayar == 'bpjs' || $pasien->carabayar == 'asuransi')
                        {{$pasien->asuransi }}
                        @elseif($pasien->carabayar == 'perusahaan')
                        {{$pasien->carabayar.' - '.$pasien->nama_perusahaan }}
                        @else
                        {{'UMUM'}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>No. JKN</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>{{$pasien->nobpjs}}</td>
                </tr>
                <tr>
                    <td>No. RM</td>
                    <td style="padding-left: 5px; padding-right: 5px;"> : </td>
                    <td>
                        @if(strlen($pasien->nrm) == 1)
                        {{ '00000'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 2)
                        {{ '0000'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 3)
                        {{ '000'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 4)
                        {{ '00'.$pasien->nrm}}
                        @elseif(strlen($pasien->nrm) == 5)
                        {{ '0'.$pasien->nrm}}
                        @else
                        {{ $pasien->nrm}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <p style="font-weight: bold; font-family: serif; font-size: 20px;">HAK DAN KEWAJIBAN PASIEN</p>
        </div>
    </div>
    <div class="row" style="margin-top: -20px;">
        <div style="float: left; width: 100%;">
            <p style="font-weight: bold; font-size: 16px;">A. Hak Pasien</p>
            <table style="border-collapse: collapse; padding-left: 25px;" class="hak">
                <tr>
                    <td>1.</td>
                    <td style="padding-left: 10px;">Memperoleh informasi mengenai tata tertib dan peraturan pelayanan kesehatan yang berlaku di {{$klinik->nama}}.</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="padding-left: 10px;">Memperoleh informasi atas</td>
                </tr>
            </table>
            <table style="border-collapse: collapse; padding-left: 50px;" class="hak">
                <tr>
                    <td>a.</td>
                    <td style="padding-left: 10px;">Penyakit yang diderita.</td>
                </tr>
                <tr>
                    <td>b.</td>
                    <td style="padding-left: 10px;">Tindakan medis yang akan dilakukan dan kemungkinan penyulit sebagai akibat tindakan tersebut, cara mengatasi dan alternatif lainnya.</td>
                </tr>
                <tr>
                    <td>c.</td>
                    <td style="padding-left: 10px;">Upuaya pencegahan agar penyakit tidak kambuh lagi dan anggota keluarga/orang lain tidak tertular.</td>
                </tr>
            </table>
            <table style="border-collapse: collapse; padding-left: 25px;" class="hak">
                <tr>
                    <td>3.</td>
                    <td style="padding-left: 10px;">Meminta konsultasi medis.</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td style="padding-left: 10px;">Menyampaikan keluhan, kritik dan saran terkait dengan pelayanan kesehatan.</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td style="padding-left: 10px;">Memperoleh layanan kesehatan yang bermutu dan berkualitas.</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td style="padding-left: 10px;">Memperoleh informasi hasil pemeriksaan, rencana tindakan dan prognosis.</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td style="padding-left: 10px;">Memberikan persetujuan atau menolak tindakan yang akan dilakukan.</td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td style="padding-left: 10px;">Didampingi keluarga saat menerima pelayanan kesehatan.</td>
                </tr>
            </table>
            <p style="font-weight: bold; font-size: 16px;">B. Kewajiban Pasien</p>
            <table style="border-collapse: collapse; padding-left: 25px;" class="hak">
                <tr>
                    <td>1.</td>
                    <td style="padding-left: 10px;">Membawa kartu identitas (KTP/SIM).</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="padding-left: 10px;">Membawa persyaratan Jaminan Pelayanan Kesehatan (Jika ada).</td>
                </tr>
            </table>
            <table style="border-collapse: collapse; padding-left: 50px;" class="hak">
                <tr>
                    <td>a.</td>
                    <td style="padding-left: 10px;">Pasien Baru</td>
                </tr>
            </table>
            <table style="border-collapse: collapse; padding-left: 75px;" class="hak">
                <tr>
                    <td>1.</td>
                    <td style="padding-left: 10px;">Kartu BPJS / KIS / ASKES yang asli</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="padding-left: 10px;">Foto copy Kartu BPJS / KIS / ASKES</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td style="padding-left: 10px;">Foto copy KTP dan KK</td>
                </tr>
            </table>
            <table style="border-collapse: collapse; padding-left: 50px;" class="hak">
                <tr>
                    <td>b.</td>
                    <td style="padding-left: 10px;">Pasien Lama</td>
                </tr>
            </table>
            <table style="border-collapse: collapse; padding-left: 75px;" class="hak">
                <tr>
                    <td>1.</td>
                    <td style="padding-left: 10px;">Menunjukkan Kartu BPJS / MS / ASKES / Kartu Berobat</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="padding-left: 10px;">Mengikuti alur pelayanan kesehatan {{$klinik->nama}}.</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td style="padding-left: 10px;">Mentaati aturan pelayanan dan petunjuk pengobatan.</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td style="padding-left: 10px;">Memberikan informasi yang lengkap dan benar tentang masalah kesehatannya.</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td style="padding-left: 10px;">Membayar biaya pelayanan kesehatan yang telah diberikan sesuai dengan tarif yang berlaku.</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 70%; text-align: center;">
            <p>&nbsp;</p>
        </div>
        <div style="float: left; width: 30%; text-align: center; padding-top: 10px;">
            <img src="{{ asset('filelogo/logoihc.png') }}" style="width: 100%;" alt="">
        </div>
    </div>
    <div class="pagebreak"></div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <p style="font-weight: bold; font-family: serif; font-size: 20px;">TATA TERTIB PENGUNJUNG</p>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%;">
            <table style="border-collapse: collapse;" class="hak">
                <tr>
                    <td>1.</td>
                    <td style="padding-left: 10px;">Pasien mengambil nomor antrian di loket pendaftaran sebelum ke poli yang dituju.</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="padding-left: 10px;">Pasien masuk ke poli yang dituju setelah mendapat panggilan.</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td style="padding-left: 10px;">Pengantar di dalam poli maksimal 2 orang.</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td style="padding-left: 10px;">Dilarang membawa makanan di dalam poli.</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td style="padding-left: 10px;">Bagi orangtua yang membawa anak kecil, mohon diawasi dan tidak diperkenankan menyentuh alat-alat yang ada dalam poli.</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td style="padding-left: 10px;">Bila ada kerusakan barang atau alat di dalam poli dikarenakan kelalaian pengunjung, wajib mengganti kerugian.</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td style="padding-left: 10px;">Dilarang merokok di lingkungan {{$klinik->nama}}.</td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td style="padding-left: 10px;">Jagalah kebersihan.</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <p style="font-weight: bold; font-family: serif; font-size: 26px;">ALUR PELAYANAN<br><span style="text-transform: uppercase;">{{$klinik->nama}}</span></p>
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 100%; text-align: center;">
            <img src="{{ asset('images/alur_pelayanan.png') }}" style="width: 65%;" alt="">
        </div>
    </div>
    <div class="row">
        <div style="float: left; width: 50%; text-align: center;">
            <p style="font-size: 12px;">&nbsp;<br>Pasien / Keluarga</p>
            <br>
            <br>
            <br>
            <br>
            <p style="font-size: 12px;">(...................................)<br>Tanda tangan & Nama Terang</p>
        </div>
        <div style="float: left; width: 50%; text-align: center;">
            <p style="font-size: 12px;">.................., {{ date('d-m-Y') }} <br>Petugas Pendaftaran Pasien</p>
            <br>
            <br>
            <br>
            <br>
            <p style="font-size: 12px;">(...................................)<br>Tanda tangan & Nama Terang</p>
        </div>
    </div>
</body>

</html>