<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style>
        .pagebreak{
            page-break-before: always;
        }

        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }

        #tabel_bawah_keluhan tr td {
            border: 1px solid transparent;
            vertical-align: top;
            padding-bottom: 20px;
        }

        #tabel_bawah_keluhan {
            width: 100%;
        }

        .isian {
            border: 1px solid transparent;
            border-bottom: 2px dotted;
        }

        #tabel_kepada tr td {
            border: 1px solid transparent;
        }

        #tabel_identitas tr td {
            border: 1px solid transparent;
        }

        #box_ttd_konsul:hover {
            cursor: pointer;
        }

        #box_ttd_jawab:hover {
            cursor: pointer;
        }

        * {
            font-size: 12px;
        }

        input[type=checkbox] {
            display: inline;
        }
    </style>
</head>

<body>
    <div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-lg-12 text-right">MR 02.15.003.REV.0</div>
        </div>
        <div class="container-fluid mt-3">
            <table class="table table-bordered table-0 custom-table" style="width: 100%">
                <tr>
                    <th style="text-align: left;">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="width:50%">
                        <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                    </th>
                    <th>
                        <table id="tabel_identitas">
                            <tr class="align-top">
                                <td>Nama</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->nama }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>No. RM</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->id }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tgl Lahir</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis Kelamin</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien ? ($pasien->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>NIK</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $pasien->ktp }}</td>
                            </tr>
                        </table>
                        <p class="text-right" style="font-weight: normal">
                            <i> *Tempel Label</i>
                        </p>
                    </th>
                </tr>
                <tr>
                    <th scope="col" colspan="2" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">LEMBAR KONSULTASI</th>
                </tr>
                <tr>
                    <td style="width: 50%; padding-left: 5px;">
                        Kepada Yth : {{ $data ? $data->kepada : '' }}
                    </td>
                    <td class="p-2">
                        Spesialis <span class="pl-2 pr-2">:</span> {{ $data ? $data->spesialis : '' }}
                    </td>
                </tr>

                <tr>
                    <td style="width: 50%; font-style: italic; font-size: 14px; padding-left: 5px;">*Lingkari pilihan nomor sesuai kebutuhan</td>
                    <td style="width: 50%; font-style: italic; font-size: 14px; padding-left: 5px;">(Coret yang tidak perlu*)</td>
                </tr>

                <tr>
                    <td style="width: 50%; padding-left: 5px;">
                        <p> Dengan hormat, <br /> Mohon bantuan sejawat atas pasien berikut untuk : </p>
                        <ol>
                            <li>Konsultasi/Tindakan* masalah medis saat ini</li>
                            <li>Mengambil alih kasus ini selanjutnya</li>
                            <li>Perawatan bersama untuk selanjutnya</li>
                        </ol>
                    </td>
                    <td style="width: 50%; padding-left: 5px;">
                        Jenis Konsul <span class="pl-2 pr-2">:</span> <input {{ $data ? $data->jenis_konsul == 'biasa' ? 'checked' : '' : '' }} type="checkbox" name="jenis_konsul" value="biasa"> Biasa / <input {{ $data ? $data->jenis_konsul == 'cito' ? 'checked' : '' : '' }} type="checkbox" name="jenis_konsul" value="cito"> Cito <br /><br />
                        Tanggal <span class="pl-2 pr-2">:</span> {{ $data ? date('d-m-Y H:i', strtotime($data->tanggal)) : date('d-m-Y H:i', strtotime($dokumen->created_at)) }}
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="pt-2" style="padding-left: 10px; padding-right: 10px;">
                        <p>
                            Keterangan klinis terpenting adalah : <br>
                            {{ $data ? $data->keterangan_klinis : '' }}
                        </p>

                        <p>Diagnosa <span class="pl-2 pr-2"> : </span> {{ $data ? $data->diagnosa : '' }}</p>

                        <div class="row pt-3 pb-4" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-4 text-center" id="box_ttd_konsul" onclick="open_modal_verifikasi('konsul')" style="width:25%;">
                                Terima kasih,
                                @if($data)
                                @if($data->id_konsul != 0)
                                <br>
                                <img class="mt-2" src="{{ env('SMIS_UPLOAD_URL').'/'.($employee_konsul ? $employee_konsul->ttd : '') }}" alt="" style="width: 4cm; height: 2.5cm;">
                                <br>
                                ({{ $data->nama_konsul }})
                                <br>
                                @else
                                <br />
                                <br />
                                <br />
                                Klik Disini
                                <br />
                                <br />
                                <br />
                                (..............................................................)<br>
                                @endif
                                @else
                                <br />
                                <br />
                                <br />
                                Klik Disini
                                <br />
                                <br />
                                <br />
                                (..............................................................)<br>
                                @endif
                                Ttd & Nama Terang
                            </div>
                            <div class="col-lg-8">
                                &nbsp;
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="pagebreak"></div>
            <table class="table table-bordered table-0 custom-table" style="width: 100%">
                <tr>
                    <th scope="col" colspan="2" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">
                        JAWABAN KONSUL
                    </th>
                </tr>

                <tr>
                    <td colspan="2" style="padding-left: 10px; padding-right: 10px;">
                        <p class="pt-2">Dengan Hormat, <br> Sesuai dengan permohonan konsultasi, pada kasus ini dijumpai : <br> {{ $data ? $data->temuan : '' }}</p>


                        <p>Keluhan : <br> {{ $data ? $data->keluhan : '' }}</p>


                        <table id="tabel_bawah_keluhan" style="margin-left: -8px;">
                            <tr>
                                <td class="pl-2" style="width: 30%;">Saran tindakan medik/pengobatan</td>
                                <td class="text-center" style="width: 3%;"> : </td>
                                <td>
                                    {{ $data ? $data->saran_tindakan : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-2">Konsultasi ulang tanggal</td>
                                <td class="text-center"> : </td>
                                <td>
                                    {{ $data ? $data->konsultasi_ulang != '0000-00-00' ? date('d-m-Y', strtotime($data->konsultasi_ulang)) : '' : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-2">Tindakan Khusus</td>
                                <td class="text-center"> : </td>
                                <td>
                                    {{ $data ? $data->tindakan_khusus : '' }}
                                </td>
                            </tr>
                        </table>

                        <div class="row pt-3 pb-4" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-4 pl-2" style="width: 25%;">
                                Terima kasih, <br>
                                Bekasi, {{ $data ? $data->tanggal_verifikasi != '0000-00-00 00:00:00' ? date('d-m-Y H:i', strtotime($data->tanggal_verifikasi)) : '' : '' }} WIB
                                <span onclick="open_modal_verifikasi('jawab')" id="box_ttd_jawab">
                                    @if($data)
                                    @if($data->id_jawab != 0)
                                    <img class="mt-2" src="{{ env('SMIS_UPLOAD_URL').'/'.($employee_jawab ? $employee_jawab->ttd : '') }}" alt="" style="width: 4cm; height: 2.5cm;">
                                    <br>
                                    ({{ $data->nama_jawab }})
                                    <br>
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    <span style="padding-left: 20%;"></span>Klik Disini
                                    <br />
                                    <br />
                                    <br />
                                    (.....................................................)<br>
                                    @endif
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    <span style="padding-left: 20%;"></span>Klik Disini
                                    <br />
                                    <br />
                                    <br />
                                    (.....................................................)<br>
                                    @endif
                                    Tanda tangan & nama jelas
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>