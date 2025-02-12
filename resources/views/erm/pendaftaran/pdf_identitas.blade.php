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

        .half_column {
            float: left;
            width: 50%;
            border: 1px solid;
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

        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            color: #111;
            text-align: right;
            line-height: 35px;
            font-weight: bold;
            font-style: italic;
        }
    </style>
</head>

<body>
<div class="row" style="width:96.7%;">
    <div class="half_column" style="padding: 10px; height:100px;">
        <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 20%;">
        <p style="font-weight: bold; padding-left: 60px; text-align: center; margin-top:-75px;">
            RUMAH SAKIT HARAPAN MULIA<br>
            <span style="font-weight: normal; font-size: 14px">
                Jl. Raya Cibarusah No. 5 Kebon Kopi
                <br>Cibarusah Jaya
                <br>Kabupaten Bekasi Jawa Barat (17340).
                <br>Telp.: (021) 8995 2340
                <br>Email : info@rumahsakit-harapanmulia.id
            </span>
        </p>
    </div>
    <div class="half_column" style="height: 120px;">
        <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 13px;">
            <tr>
                <td style="padding-left: 10px;">Nama</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $pasien->nama }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">No. Rekam Medis</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $pasien->nrm }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Tgl. Lahir</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Jenis Kelamin</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $pasien->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
            </tr>
        </table>
    </div>
</div>
</div>
<div class="row">
    <div style="float: left; width: 100%">
        <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
            <tr>
                <td style="width: 20%;">NO REKAM MEDIS</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{$pasien->nrm}}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Medical Record Number</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Identitas Pasien</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">
                    <div style="clear:both; position:relative;">
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:0pt; top:4pt;">@if(isset($persetujuan)) @if($persetujuan->identitas == "ktp")
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif @endif</div>
                        <span style="margin-left:18px;">KTP</span>
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:0pt; top:4pt;">@if(isset($persetujuan)) @if($persetujuan->identitas == "sim")
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif @endif</div>
                        <span style="margin-left:18px;">SIM</span>
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:0pt; top:4pt;">@if(isset($persetujuan)) @if($persetujuan->identitas == "passport")
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif @endif</div>
                        <span style="margin-left:18px;">Passport</span>
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:0pt; top:4pt;">@if(isset($persetujuan)) @if($persetujuan->identitas == "lainnya")
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif @endif</div>
                        <span style="margin-left:18px;">Lainnya</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>Identity Patient</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">No Identitas</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">
                    <input type="text"
                           value="{{ $persetujuan ? $persetujuan->nomer_identitas ? $persetujuan->nomer_identitas : "" : "" }}"
                           class="form-control" id="nomer_identitas" style="border: 0px">
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>Identity Number</i></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div style="float: left; width: 100%; background: black;">
        <p style="color: white; text-align: center; justify-items: center">FORMULIR PENDAFTARAN PASIEN BARU</p>
    </div>
</div>
<div class="row">
    <div style="float: left; width: 100%">
        <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
            <tr>
                <td style="width: 20%;">Nama Pasien</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{$pasien->nama}}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Patient Name</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Jenis Kelamin</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 75%; border-bottom: 2px dotted;">
                    <div style="clear:both; position:relative;">
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:0pt; top:4pt;">@if($pasien->kelamin == 0)
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif</div>
                        <span style="margin-left:18px;">Laki-Laki</span>
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:70pt; top:4pt;">@if($pasien->kelamin == 1)
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif</div>
                        <span style="margin-left:33px;">Perempuan</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>sex</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Tempat dan Tanggal Lahir</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{$pasien->tempat_lahir}}
                    , @if($pasien->tgl_lahir != '')
                        {{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}
                    @endif</td>
            </tr>
            <tr>
                <td colspan="3"><i>Place & Date of birth</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Kebangsaan</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">
                    <input type="text"
                           value="{{ $persetujuan ? $persetujuan->kebangsaan ? $persetujuan->kebangsaan : "" : "" }}"
                           class="form-control" id="kebangsaan" style="border: 0px">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;"><i>Nationality</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Suku Bangsa</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">
                    {{ $persetujuan ? $persetujuan->suku : ($pasien->suku ? $pasien->suku : '-') }}
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>Nationality</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Pekerjaan</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{$pasien->pekerjaan}}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Employment</i></td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top;">Agama</td>
                <td style="padding-left: 3px; vertical-align: top; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{$pasien->agama}}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Religion</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Status Perkawinan</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">
                    <div style="clear:both; position:relative;">
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:0pt; top:4pt;">@if($pasien->status == 'Belum Menikah')
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif</div>
                        <span style="margin-left:18px;">Belum Menikah</span>
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:100pt; top:4pt;">@if($pasien->status == 'Menikah')
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif</div>
                        <span style="margin-left:33px;">Menikah</span>
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:170pt; top:4pt;">@if($pasien->status == 'Duda')
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif</div>
                        <span style="margin-left:38px;">Duda</span>
                        <div
                            style="width:13px; height:13px; border: 1px solid; position:absolute; left:225pt; top:4pt;">@if($pasien->status == 'Janda')
                                <span style="position: absolute; top: -5pt; left:2pt;">{{'v'}}</span>
                            @endif</div>
                        <span style="margin-left:35px;">Janda</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>Marital status</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Pendidikan Terakhir</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{$pasien->pendidikan}}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Latest education</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Alamat sesuai KTP</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->alamat }}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Address based on ID</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">No. Telp. / HP</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->telpon }}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Phone / Mobile number</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Nama Ibu Kandung</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->ibu ? $pasien->ibu : "-" }}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Mother name</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Alamat Domisili</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">{{ $pasien->alamat }}</td>
            </tr>
            <tr>
                <td colspan="3"><i>Address based on ID</i></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div style="float: left; width: 100%">
        <p><b>KONTAK DARURAT</b></p>
        <table style="border-collapse: collapse; width: 100%;" class="identitas_pasien">
            <tr>
                <td style="width: 20%;">Nama Wali Pasien</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;">
                    {{ $persetujuan ? $persetujuan->nama_wali ? $persetujuan->nama_wali : "" : "" }}
                    / {{ $persetujuan ? $persetujuan->hubungan_pasien ? $persetujuan->hubungan_pasien : "" : "" }}
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>Patient Guardian</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">Alamat Wali</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;" colspan="3">
                    {{ $persetujuan ? $persetujuan->alamat_wali ? $persetujuan->alamat_wali : "" : "" }}
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>Address based on ID</i></td>
            </tr>
            <tr>
                <td style="width: 20%;">No Telp. / HP Wali</td>
                <td style="padding-left: 3px; padding-right: 3px; width:3%;"> :</td>
                <td style="width: 68%; border-bottom: 2px dotted;" colspan="3">
                    {{ $persetujuan ? $persetujuan->telpon ? $persetujuan->telpon : "" : "" }}
                </td>
            </tr>
            <tr>
                <td colspan="3"><i>Phone / Mobile number</i></td>
            </tr>
        </table>
    </div>
</div>
<div class="row" style="padding-top:20px">
    <div style="float: left; width: 50%; text-align: center;">
        <p style="font-size: 14px;">Bekasi, {{date('d/m/Y', strtotime($rm->tanggal_update))}}</p>
    </div>
    <div style="float: left; width: 50%; text-align: center;">
        &nbsp;
    </div>
</div>
<div class="row">
    <div style="float: left; width: 50%; text-align: center;">
        <p style="font-size: 12px;">Petugas Pendaftaran,</p>
        @if(isset($rm->nama_verifikator) && $rm->nama_verifikator != "")
            @if(isset($employee))
                <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" alt=""
                     style="height: 2.5cm; width: 5cm;"><br>
            @else
                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" alt=""
                     style="height: 2.5cm; width: 5cm;"><br>
            @endif
            {{ strtoupper($rm->nama_verifikator) }}
        @else
            <br>
            <br>
            <br>
            <br>
            <hr style="width: 60%;">
        @endif
    </div>
    <div style="float: left; width: 50%; text-align: center;">
        <p style="font-size: 12px;">Pasien / Keluarga</p>
        @if($rm->signature_pasien != null)
            <img src="{{ asset('signature_patient/'.$rm->signature_pasien) }}" alt=""
                 style="height: 2.5cm; width: 5cm;"><br>
            {{ strtoupper($rm->nama_pasien) }}
        @else
            <br>
            <br>
            <br>
            <br>
            <hr style="width: 60%;">
        @endif
    </div>
</div>
</body>

</html>
