{{-- pending dluu --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Kontrol Ranap</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style type="text/css">
        input[type=text] {
            border: hidden;
            border-bottom: 1px dotted;
        }

        input[type=checkbox] {
            display: inline;
        }

        .tabel_layout {
            border-collapse: collapse;
            width: 100%;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <table class="tabel_layout" border="1" style="margin-left: 1.5px; width:99.65% !important">
        <tr>
            <td style="width: 50%;">
                <table class="tabel_layout" border="0">
                    <tr>
                        <td style="width:20%">
                            <img id="logo_rshm" src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 100%;">
                        </td>
                        <td class="pt-1">
                            <p style="font-weight: bold; font-size:16px; text-align: left">
                                RUMAH SAKIT HARAPAN MULIA
                            </p>
                            <p style="text-align: left; margin-top:-20px; font-size:10px; font-weight: bold; line-height:1.5;">
                                <span style="font-weight: normal">
                                    Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                                    <br>Kabupaten Bekasi Jawa Barat (17340).
                                    <br>Telp.: (021) 8995 2340
                                    <br>Email : info@rumahsakit-harapanmulia.id
                                </span>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%;">
                <table border="0" style="font-size: 12px;">
                    <tr>
                        <td class="pl-2">Nama</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{ $pasien->nama }}</td>
                    </tr>
                    <tr>
                        <td class="pl-2">No. RM</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{ $pasien->id }}</td>
                    </tr>
                    <tr>
                        <td class="pl-2">Tgl Lahir</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                    </tr>
                    <tr>
                        <td class="pl-2">Jenis Kelamin</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}</td>
                    </tr>
                    <tr>
                        <td class="pl-2">NIK</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{ $pasien->ktp }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="tabel_layout" border="0" style="margin-top: -12px;">
        <tr>
            <td>
                <div class="text-center" style="background: black; ">
                    <h6 class="text-white pb-2 pt-2" style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">SURAT KONTROL</h6>
                </div>
            </td>
        </tr>
    </table>

    <table class="tabel_layout" border="1" style="margin-top: -12px; margin-left: 1.5px; width:99.65% !important">
        <tr>
            <td colspan="2">
                <table class="tabel_layout" border="0" style="font-size: 12px;">
                    <tr>
                        <td class="pl-2" style="width: 5%;">1.</td>
                        <td colspan="3">
                            <b>RESUME</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 75%;">Serahkan pada saat kontrol / untuk diserahkan kepada instansi yang bersangkutan.</td>
                        <td style="width:10%; vertical-align: top;">
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_resume == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_resume" value="ya">
                        </td>
                        <td style="width:10%; vertical-align: top;">
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_resume == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_resume" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3" style="vertical-align: top;">
                            Bila tidak ada, alasan :
                            {{ $data ? $data->resume : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="pl-2" style="width: 5%;">2.</td>
                        <td colspan="3">
                            <b>SURAT KETERANGAN KONTROL</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 75%;">
                            Tanggal Kontrol : {{ $data ? $data->tgl_kontrol : '' }}
                            <span style="margin-left: 5%;">&nbsp;</span>
                            Jam : {{ $data ? $data->jam_kontrol : '' }}
                            <span style="margin-left: 5%;">&nbsp;</span>
                            Pada Dokter : {{ $data ? $data->nama_dokter : '' }}
                        </td>
                        <td style="width:10%; vertical-align: top;">
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_kontrol == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_kontrol" value="ya">
                        </td>
                        <td style="width:10%; vertical-align: top;">
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_kontrol == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_kontrol" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">Serahkan keterangan tersebut pada rumah sakit harapan mulia</td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="pl-2" style="width: 5%;">3.</td>
                        <td colspan="3">
                            <b>SURAT KETERANGAN DOKTER (Ketrangan Rawat / Istirahat)</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Bila tidak ada, alasan : {{ $data ? $data->alasan_istirahat : '' }}
                        </td>
                        <td>
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_dokter == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_dokter" value="ya">
                        </td>
                        <td>
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_dokter == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_dokter" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="pl-2" style="width: 5%;">4.</td>
                        <td colspan="3">
                            <b>HASIL RADIOLOGI</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            No. Radiologi : {{ $data ? $data->no_rad : '' }}
                        </td>
                        <td>
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_rad == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_rad" value="ya">
                        </td>
                        <td>
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_rad == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_rad" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">
                            Jenis Pemeriksaan : {{ $data ? $data->rad : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="pl-2" style="width: 5%;">5.</td>
                        <td colspan="3">
                            <b>HASIL LABORATORIUM</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Jenis Pemeriksaan : {{ $data ? $data->lab : '' }}
                        </td>
                        <td>
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_lab == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_lab" value="ya">
                        </td>
                        <td>
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_lab == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_lab" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="pl-2" style="width: 5%;">6.</td>
                        <td colspan="3">
                            <b>OBAT - OBATAN</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table border="0" class="tabel_layout">
                                <tr>
                                    <td style="width: 25%; vertical-align:top;">Jenis Obat dan Dosis</td>
                                    <td style="width: 3%; vertical-align:top;"> : </td>
                                    <td>
                                        <textarea style="width: 90%; border-radius:5px; padding-left: 5px;" readonly id="">{{ $data ? $data->terapi : '' }}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align: top;">
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_terapi == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_terapi" value="ya">
                        </td>
                        <td style="vertical-align: top;">
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_terapi == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_terapi" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="pl-2" style="width: 5%;">7.</td>
                        <td colspan="3">
                            <b>DIAGNOSA</b> : {{ $data ? $data->diagnosa : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">
                            <table class="tabel_layout" border="0">
                                <tr>
                                    <td style="width: 14%;">Tinggi Badan</td>
                                    <td style="width: 3%;"> : </td>
                                    <td>{{ $data ? $data->tinggi_badan.' cm' : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Berat Badan</td>
                                    <td> : </td>
                                    <td>{{ $data ? $data->berat_badan.' kg' : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="pl-2" style="width: 5%;"></td>
                        <td colspan="3">
                            <b>LAIN - LAIN</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            a. Surat Konsul Ditujukan : {{ $data ? $data->surat_konsul : '' }}
                        </td>
                        <td>
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_konsul == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_konsul" value="ya">
                        </td>
                        <td>
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_konsul == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_konsul" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            b. Surat Jawaban Konsul Ditujukan : {{ $data ? $data->surat_jawaban_konsul : '' }}
                        </td>
                        <td>
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_jawaban_konsul == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_jawaban_konsul" value="ya">
                        </td>
                        <td>
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_jawaban_konsul == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_jawaban_konsul" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            c. Surat Kematian : {{ $data ? $data->surat_kematian : '' }}
                        </td>
                        <td>
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_kematian == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_kematian" value="ya">
                        </td>
                        <td>
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_kematian == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_kematian" value="tidak">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            d. Asuransi : {{ $data ? $data->asuransi : '' }}
                        </td>
                        <td>
                            Ya <input class="mr-3 ml-1" {{ $data ? ($data->radio_asuransi == "ya" ? 'checked' : '') : '' }} type="checkbox" id="radio_asuransi" value="ya">
                        </td>
                        <td>
                            Tidak <input class="ml-1" {{ $data ? ($data->radio_asuransi == "tidak" ? 'checked' : '') : '' }} type="checkbox" id="radio_asuransi" value="tidak">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="font-size: 12px; text-align: center;">
                Petugas
                @if($dokumen->id_verifikator == 0)
                <br>
                <br>
                <br>
                <br>
                (.................................................)
                <br>
                Ttd & Nama Terang
                @else
                <br>
                @if(isset($employee))
                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                    style="height: 2.5cm; width: 4cm;" alt="">
                @else
                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                @endif
                <br>({{$dokumen->nama_verifikator}})
                @endif
            </td>
            <td style="font-size: 12px; text-align: center;">
                Pasien
                @if(is_null($dokumen) || is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                <br>
                <br>
                <br>
                <br>
                (.................................................)
                <br>
                Ttd & Nama Terang
                @else
                <br>
                @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}" style="height: 2.5cm; width: 4cm;" alt="">
                @else
                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 4cm;" alt="">
                @endif
                <br>({{ $dokumen->nama_pasien }})
                @endif
            </td>
        </tr>
    </table>
</body>
</html>