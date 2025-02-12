<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan atau Penolakan Tindakan Kedokteran</title>
   
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>

    <style>
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

        .input-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Adjust the gap between elements as needed */
            vertical-align: middle;
        }

        .input-container input[type="text"],
        .input-container input[type="date"],
        .input-container input[type="time"] {
            margin-bottom: 0; /* Override the margin-bottom set by the form-control class */
            align-items: center;
        }

        .input-container label {
            margin-right: 5px; /* Adjust the space between labels and inputs */
        }

        .text-input {
            flex: 1; /* This makes the text input take up remaining space */
        }

        .date-input,
        .time-input {
            width: 150px; /* Set a fixed width for date and time inputs */
        }

        .signature-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .signature-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .signature-box {
        /* border: 2px solid #000; */
        padding: 20px;
        cursor: pointer;
        width: 200px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .signature-box img {
        max-width: 100%;
        max-height: 100%;
    }

    .signature-placeholder {
        text-align: center;
    }

    .name-box {
        flex: 1;
        display: flex;
        height: 100px;
        align-items: center;
        justify-content: left;
    }

    .slash {
        font-size: 24px;
        margin: 0 10px;
    }
    </style>
</head>

<body class="p-2">
    @if(Session::has('message'))
    <script>
        alert('{{ Session::get("message") }}');
    </script>
    @endif
    <div class="container">
    <form action="" id="form_dokumen" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">

        <div class="row">
            <div class="col-12 text-right">MR 02.01.007.REV 0</div>
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
                            <td>{{ $layanan->nama_pasien }}</td>
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

        <div class="container">
            <h5 class="text-center mt-3 bold"> PERSETUJUAN / PENOLAKAN TINDAKAN KEDOKTERAN</h5>
            <table class="table table-bordered custom-table">
                <thead>
                  <tr>
                    <th scope="col" colspan="8" class="text-center" style="border-color: black">PEMBERIAN INFORMASI TINDAKAN KEDOKTERAN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="2">Dokter Pelaksana Tindakan</td>
                    <td colspan="2">
                        <div class="input-group">
                            <input type="hidden" value="{{ $data ? $data->id_dokter_pelaksana_tindakan : '' }}" name="id_dokter_pelaksana_tindakan">
                            <input type="text" value="{{ $data ? $data->dokter_pelaksana_tindakan : '' }}" name="dokter_pelaksana_tindakan" readonly class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" onclick="open_modal_employee('dokter_pelaksana_tindakan')"><i class="fa fa-list"></i></button>
                            </div>    
                        </div>
                  </tr>
                  <tr>
                    <td colspan="2">Pemberi Informasi</td>
                    <td colspan="2">
                        <div class="input-group">
                            <input type="hidden" value="{{ $data ? $data->id_pemberi_informasi : '' }}" name="id_pemberi_informasi">
                            <input type="text" value="{{ $data ? $data->pemberi_informasi : '' }}" name="pemberi_informasi" readonly class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" onclick="open_modal_employee('pemberi_informasi')"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">Penerima informasi / Pemberi persetujuan</td>
                    <td colspan="2">
                        <div class="input-container">
                            <input style="margin-top: 8px;" type="text" name="penerima_informasi" class="form-control mb-2 text-input" value="{{ $data ? $data->penerima_informasi : '' }}" >
                            <label>Tanggal: </label><input style="margin-top: 8px;" type="date" name="tanggal" class="form-control mb-2 date-input" value="{{ $data ? $data->tanggal : '' }}">
                            <label>Pukul: </label><input style="margin-top: 8px;" type="time" name="pukul" class="form-control mb-2 time-input" value="{{ $data ? $data->pukul : '' }}">
                        </div>
                    </td>
                </tr>                                  
                  <tr class="text-center">
                    <td class="font-weight-bold">NO</td>
                    <td class="font-weight-bold">JENIS INFORMASI</td>
                    <td class="font-weight-bold">ISI INFORMASI</td>
                    <td class="font-weight-bold">PAHAM / TDK PAHAM</td>
                  </tr>
                  <tr>
                    <td class="text-center">1</td>
                    <td>Diagnosa (WD & DD)</td>
                    <td><input type="text" name="diagnosa" class="form-control" value="{{ $data ? $data->diagnosa : '' }}"></td>
                    <td class="text-center
                    "><input type="checkbox" name="checkbox_diagnosa" {{ $data && $data->checkbox_diagnosa == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">2</td>
                    <td>Dasar Diagnosis</td>
                    <td><input type="text" name="dasar_diagnosis" class="form-control" value="{{ $data ? $data->dasar_diagnosis : '' }}"></td>
                    <td class="text-center
                    "><input type="checkbox" name="checkbox_dasar_diagnosis" {{ $data && $data->checkbox_dasar_diagnosis == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">3</td>
                    <td>Tindakan Kedokteran</td>
                    <td><input type="text" name="tindakan_kedokteran" class="form-control" value="{{ $data ? $data->tindakan_kedokteran : '' }}"></td>
                    <td class="text-center
                    "><input type="checkbox" name="checkbox_tindakan_kedokteran" {{ $data && $data->checkbox_tindakan_kedokteran == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">4</td>
                    <td>Indikasi Tindakan</td>
                    <td><input type="text" name="indikasi_tindakan" class="form-control" value="{{ $data ? $data->indikasi_tindakan : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_indikasi_tindakan" {{ $data && $data->checkbox_indikasi_tindakan == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">5</td>
                    <td>Tata Cara:<br/> 
                        Tipe Sedasi/Anestesi <br/>
                        Uraian singkat prosedur dan tahapan penting
                        </span>
                    </td>
                    <td><input type="text" name="tata_cara" class="form-control" value="{{ $data ? $data->tata_cara : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_tata_cara" {{ $data && $data->checkbox_tata_cara == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">6</td>
                    <td>Tujuan</td>
                    <td><input type="text" name="tujuan" class="form-control" value="{{ $data ? $data->tujuan : '' }}" ></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_tujuan" {{ $data && $data->checkbox_tujuan == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">7</td>
                    <td>Risiko</td>
                    <td><input type="text" name="risiko" class="form-control" value="{{ $data ? $data->risiko : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_tujuan" {{ $data && $data->checkbox_tujuan == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">8</td>
                    <td>Komplikasi</td>
                    <td><input type="text" name="komplikasi" class="form-control" value="{{ $data ? $data->komplikasi : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_komplikasi" {{ $data && $data->checkbox_komplikasi == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">9</td>
                    <td>
                        Prognosis: <br/>
                        prognosis vital <br/>
                        prognosis fungsi <br/>
                        prognosis penyembuh
                    </td>
                    <td><input type="text" name="prognosis" class="form-control" value="{{ $data ? $data->prognosis : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_prognosis" {{ $data && $data->checkbox_prognosis == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">10</td>
                    <td>Alternatif & Risiko <br/>
                        Pilihan pengobatan/tatalaksana
                    </td>
                    <td><input type="text" name="alternatif" class="form-control" value="{{ $data ? $data->alternatif : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_alternatif" {{ $data && $data->checkbox_alternatif == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">11</td>
                    <td>Hal lain yang akan dilakukan untuk <br/>
                        Penyelamatan pasien <br/>    
                        Perluasan tindakan <br/>    
                        Konsultasi selama tindakan <br/>    
                        Resusitasi <br/>    
                    </td>
                    <td><input type="text" name="hal_lain" class="form-control" value="{{ $data ? $data->hal_lain : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_hal_lain"  {{ $data && $data->checkbox_hal_lain == 'on' ? 'checked' : '' }} ></td>
                  </tr>
                  <tr>
                    <td colspan="3">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdikusi</td>
                    <td class="text-center">
                        <div onclick="open_modal_verifikasi()" id="box_ttd">
                            @if ($dokumen->id_verifikator == 0)
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p><u>Nama Jelas & TTD </u></p>
                            @else
                            @if (isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 2cm; width: 4cm;" alt="">
                            @else
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 2cm; width: 4cm;" alt="">
                            @endif
                            <br>({{ $dokumen->nama_verifikator }})
                            @endif
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Dengan ini menyatakan bahwa saya telah menerima informasi hal dari dokter sebagaimana diatas kemudian yang saya beri tanda/paraf dikolom kanannya dan telah memahaminya.</td>
                    <td class="text-center">
                        <div onclick="open_modal_pasien()" id="box_ttd">
                            @if(is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p><u>Nama Jelas & TTD </u></p>
                        @else
                            @if(!is_null($dokumen->signature_pasien) || $dokumen->signature_pasien != "")
                                <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                        style="height: 4cm; width: 5cm;" alt="">
                            @else
                                <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                            @endif
                            <br>({{$dokumen->nama_pasien}})
                        @endif
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">*Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat.</td>
                    <td></td>
                  </tr>
                </tbody>
            </table>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 text-left">MR 02.39.001.REV.1</div>
            </div>

            <h6 class="text-center font-weight-bold">FORMULIR PERSETUJUAN/PENOLAKAN TINDAKAN KEDOKTERAN</h6>
            <div style="border:1px solid; padding: 5px;" class="">
                Yang bertanda tangan dibawah ini: <br/>
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>Nama :</td>
                                <td>
                                    <input type="text" name="nama" id="dit" style="border: 0; border-bottom: 2px dotted; width: 150%;" value="{{ $data ? $data->nama : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Pekerjaan :</td>
                                <td>
                                    <input type="text" name="pekerjaan" id="dit" style="border: 0; border-bottom: 2px dotted; width: 150%;" value="{{ $data ? $data->pekerjaan : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat :</td>
                                <td>
                                    <input type="text" name="alamat" id="dit" style="border: 0; border-bottom: 2px dotted; width: 150%;" value="{{ $data ? $data->alamat : '' }}">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>Umur :</td>
                                <td>
                                    <input type="text" name="umur" id="dit" style="border: 0; border-bottom: 2px dotted; width: 20%;" value="{{ $data ? $data->umur : '' }}"> 
                                    Jenis Kelamin : <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ $data && $data->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}> Laki-laki 
                                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ $data && $data->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}> Perempuan
                                </td>
                            </tr>
                            <tr>
                                <td>No. KTP/Identitas :</td>
                                <td>
                                    <input type="text" name="no_ktp" id="dit" style="border: 0; border-bottom: 2px dotted; width: 100%;" value="{{ $data ? $data->no_ktp : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Telp :</td>
                                <td>
                                    <input type="text" name="telepon" id="dit" style="border: 0; border-bottom: 2px dotted; width: 100%;" value="{{ $data ? $data->telepon : '' }}">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <p class="mt-3">
                    Dengan ini menyatakan 
                    <input type="radio" name="menyatakan" value="Menyetujui" {{ $data && $data->menyatakan == 'Menyetujui' ? 'checked' : '' }}> MENYETUJUI / 
                    <input type="radio" name="menyatakan" value="Menolak" {{ $data && $data->menyatakan == 'Menolak' ? 'checked' : '' }}> MENOLAK untuk dilakukan tindakan kedokteran
                </p>

                <table style="border-collapse: collapse; width:100%" class="mb-3">
                    <tr class="align-top">
                        <td style="width: 12%;">Nama Pasien</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            {{-- {{ $dokumen->nama_pasien }} --}}
                            {{ $layanan->nama_pasien }}
                            {{-- <input type="text" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"> --}}
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Umur/Tgl. Lahir</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            {{$pasien->umur}} tahun / {{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }} &nbsp;&nbsp;
                            {{-- <input type="text" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">  --}}
                            <span>Jenis Kelamin : {{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }} </span>
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Alamat</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            {{ $pasien->alamat}}
                            {{-- <input type="text" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">  --}}
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">Dirawat di</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            Kamar : {{ $layanan->last_nama_ruangan}} &nbsp;&nbsp;&nbsp;
                            {{-- <input type="text" name=""  style="border:1px solid transparent; border-bottom: 2px dotted; width: 40%; background-color: transparent;"> --}}
                            Kelas : {{ $layanan->last_kelas}}
                            {{-- <input type="text" name=""  style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;"> --}}
                        </td>
                    </tr>

                    <tr class="align-top">
                        <td style="width: 12%;">No Rekam medis</td>
                        <td style="width: 3%;"> : </td>
                        <td style="width: 85%;">
                            {{ $dokumen->nrm }}
                            {{-- <input type="text" name="" class="form-control"> --}}
                        </td>
                    </tr>

                </table>

                <p> Hubungan dengan pasien :  
                    <input type="radio" name="hubungan_dengan_pasien" value="Pasien Sendiri"  {{ $data && $data->hubungan_dengan_pasien == 'Pasien Sendiri' ? 'checked' : '' }}> Pasien Sendiri
                    <input type="radio" name="hubungan_dengan_pasien" value="Suami"  {{ $data && $data->hubungan_dengan_pasien == 'Suami' ? 'checked' : '' }}> Suami
                    <input type="radio" name="hubungan_dengan_pasien" value="Istri" {{ $data && $data->hubungan_dengan_pasien == 'Istri' ? 'checked' : '' }}> Istri
                    <input type="radio" name="hubungan_dengan_pasien" value="Anak"  {{ $data && $data->hubungan_dengan_pasien == 'Anak' ? 'checked' : '' }}> Anak
                    <input type="radio" name="hubungan_dengan_pasien" value="Ayah"  {{ $data && $data->hubungan_dengan_pasien == 'Ayah' ? 'checked' : '' }}> Ayah
                    <input type="radio" name="hubungan_dengan_pasien" value="Ibu"  {{ $data && $data->hubungan_dengan_pasien == 'Ibu' ? 'checked' : '' }}> Ibu
                    <input type="radio" name="hubungan_dengan_pasien" value="lain-lain"  {{ $data && $data->hubungan_dengan_pasien == 'lain-lain' ? 'checked' : '' }}> lain-lain <input type="text" name="lain_lain" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;"  value="{{ $data ? $data->lain_lain : '' }}">
                </p>

                <p>
                    Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk risiko dan komplikasi yang timbul.
                </p>

                <p>
                    Saya juga menyadari bahwa dokter melakukan suatu upaya dan oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat tergantung kepada ijin Tuhan Yang Maha Esa.

                </p>

                <p class="mt-5">
                    Bekasi, tanggal <input type="date" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;" name="tanggal_formulir" value="{{ $data ? $data->tanggal_formulir : '' }}">
                    Pukul <input type="time" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;" name="waktu_formulir" value="{{ $data ? $data->waktu_formulir : '' }}">
                </p>

                <div class="row justify-content-center mt-5">
                     <div class="col-md-6 text-center">
        <p>Yang Menyatakan</p>
        <div onclick="open_modal_nama_yang_menyatakan()" id="box_ttd">
            @if(is_null($data) || is_null($data->signature_nama_yang_menyatakan) || $data->signature_nama_yang_menyatakan == "")
                <br>
                <br>
                <br>
                <br>
                <br>
                ________________________________
                <p>Tanda Tangan & Nama Jelas</p>
            @else
                @if(!is_null($data->signature_nama_yang_menyatakan) && $data->signature_nama_yang_menyatakan != "")
                    <img src="{{ asset('signature_patient/'.$data->signature_nama_yang_menyatakan) }}" style="height: 4cm; width: 5cm;" alt="">
                @else
                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                @endif
                <br>({{ $data->nama_yang_menyatakan }})
            @endif
        </div>
    </div>

                    <div class="col-md-6 text-center">
                        <p>Dokter Pelaksana Tindakan</p>
                        <div onclick="open_modal_verifikasi()" id="box_ttd">
                            @if ($dokumen->id_verifikator == 0)
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            ________________________________
                            <p>Tanda Tangan & Nama Jelas</p>
                        @else
                            @if (isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 2cm; width: 4cm;" alt="">
                            @else
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 2cm; width: 4cm;" alt="">
                            @endif
                            <br>({{ $dokumen->nama_verifikator }})
                            @endif
                        </div>
                    </div>
                </div>

                <p class="mt-5"> Saksi :</p>
                <div class="signature-container">
                    <div class="signature-item">
                        <p>1. </p>
                        <div class="signature-box" onclick="open_modal_saksi_satu()">
                            @if(is_null($data) || is_null($data->signature_saksi_satu) || $data->signature_saksi_satu == "")
                            <div class="signature-placeholder">
                                <br>
                                <br>
                                ________________________________
                                <p>Tanda Tangan</p>
                            </div>
                            @else
                            <img src="{{ asset('signature_patient/'.$data->signature_saksi_satu) }}" alt="Signature">
                            @endif
                        </div>
                        <div class="slash">/</div>
                        <div class="name-box">
                            @if(!is_null($data) && !is_null($data->saksi_satu))
                            <p>{{ $data->saksi_satu }}</p>
                            @else
                            <p>Nama Jelas</p>
                            @endif
                        </div>
                    </div>
                
                    <div class="signature-item">
                        <p>2.</p>
                        <div class="signature-box" onclick="open_modal_saksi_dua()">
                            @if(is_null($data) || is_null($data->signature_saksi_dua) || $data->signature_saksi_dua == "")
                            <div class="signature-placeholder">
                                <br>
                                <br>
                                ________________________________
                                <p>Tanda Tangan</p>
                            </div>
                            @else
                            <img src="{{ asset('signature_patient/'.$data->signature_saksi_dua) }}" alt="Signature">
                            @endif
                        </div>
                        <div class="slash">/</div>
                        <div class="name-box">
                            @if(!is_null($data) && !is_null($data->saksi_dua))
                            <p>{{ $data->saksi_dua }}</p>
                            @else
                            <p>Nama Jelas</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 pb-2 mt-3 text-center mb-5">
                <button type="submit" id="btn_simpan" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
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
                <form action="{{ url('e_rekam_medis/detail/persetujuan_atau_penolakan_tindakan_kedokteran/verifikasi') }}" method="post">
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

    <div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan penerima informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/detail/save_ttd_dokumen_kunjungan') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Nama Penerima Informasi</h6>
                                <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
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

    <div class="modal fade" id="modal_nama_yang_menyatakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan yang menyatakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="return konfirmasi_nama_yang_menyatakan(this)" action="{{route('save.nama_yang_menyatakan')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Nama yang Menyatakan</h6>
                                <input type="text" class="form-control" name="nama_yang_menyatakan" id="nama_yang_menyatakan">
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad-yang-menyatakan" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature64_nama_yang_menyatakan" name="signed_nama_yang_menyatakan" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button id="clear_pemberi" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
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

    <div class="modal fade" id="modal_saksi_satu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan saksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="return konfirmasi_saksi_satu(this)" action="{{route('save.saksi_satu')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Nama Saksi</h6>
                                <input type="text" class="form-control" name="saksi_satu" id="saksi_satu">
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad-saksi-satu" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature64_saksi_satu" name="signed_saksi_satu" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button id="clear_pemberi" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
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

    <div class="modal fade" id="modal_saksi_dua" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan saksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="return konfirmasi_saksi_dua(this)" action="{{route('save.saksi_dua')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Nama Saksi</h6>
                                <input type="text" class="form-control" name="saksi_dua" id="saksi_dua">
                            </div>
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad-saksi-dua" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature64_saksi_dua" name="signed_saksi_dua" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button id="clear_pemberi" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
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
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>

<script>
      $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/persetujuan_atau_penolakan_tindakan_kedokteran/store') }}",
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

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }
    
    $(document).ready(function() {
        var verif = '{{$dokumen->id_verifikator}}';
        if (verif != 0) {
            window.scrollTo({
                left: 0,
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        }
    });

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

    function konfirmasi_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    const signaturePadNamaYangMenyatakan = new SignaturePad(document.getElementById('signature-pad-yang-menyatakan'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear_pemberi').click(function(e) {
        e.preventDefault();
        signaturePadNamaYangMenyatakan.clear();
        $("#signature64_nama_yang_menyatakan").val('');
        $("#nama_yang_menyatakan").val('');
    });

    function konfirmasi_nama_yang_menyatakan() {
        var data = signaturePadNamaYangMenyatakan.toDataURL('image/png');
        $('#signature64_nama_yang_menyatakan').val(data);

        if ($('#signature64_nama_yang_menyatakan').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    const signaturePadNamaSaksiSatu = new SignaturePad(document.getElementById('signature-pad-saksi-satu'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear_pemberi').click(function(e) {
        e.preventDefault();
        signaturePadNamaSaksiSatu.clear();
        $("#signature64_saksi_satu").val('');
        $("#saksi_satu").val('');
    });

    function konfirmasi_saksi_satu() {
        var data = signaturePadNamaSaksiSatu.toDataURL('image/png');
        $('#signature64_saksi_satu').val(data);

        if ($('#signature64_saksi_satu').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    const signaturePadNamaSaksiDua = new SignaturePad(document.getElementById('signature-pad-saksi-dua'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear_pemberi').click(function(e) {
        e.preventDefault();
        signaturePadNamaSaksiDua.clear();
        $("#signature64_saksi_dua").val('');
        $("#saksi_dua").val('');
    });

    function konfirmasi_saksi_dua() {
        var data = signaturePadNamaSaksiDua.toDataURL('image/png');
        $('#signature64_saksi_dua').val(data);

        if ($('#signature64_saksi_dua').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    function open_modal_nama_yang_menyatakan() {
        $('#modal_nama_yang_menyatakan').modal('show');
    }

    function open_modal_saksi_satu() {
        $('#modal_saksi_satu').modal('show');
    }

    function open_modal_saksi_dua() {
        $('#modal_saksi_dua').modal('show');
    }

    function open_modal_verifikasi() {
        $('#modal_verifikasi').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }
</script>

</html>