<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Persetujuan atau Penolakan Tindakan Bedah</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }

        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
            cursor: pointer;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }

        @media print {

            #box_nomor_dokumen {
                margin-left: 25px !important;
                width: 100%;
            }

            .col-lg-12 {
                width: 100%;
            }

            body {
                -webkit-print-color-adjust: exact;
            }

            .col-md-4{
                width: 33.3%;
            }
        }

        .pagebreak {
            page-break-before: always;
        }
    </style>

</head>

<body class="p-2">
    <div class="container">
        <div class="row" id="box_nomor_dokumen" style="width: 100%; margin-left: 0;">
            <div class="col-lg-12 text-right">MR 02.39.001.REV.1</div>
        </div>
        <div class="container mt-3">
            <table border="1" style="width: 100%;">
                <tr>
                    <th style="width: 50%; padding-left: 20px; padding-top: 10px;">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                        <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                    </th>
                    <th style="width: 50%; padding-left: 20px;">
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
                        <p class="text-right" style="font-weight: normal; padding-right: 20px;">
                            <i> *Tempel Label</i>
                        </p>
                    </th>
                </tr>
            </table>
            <table class="table table-bordered table-0 custom-table">
                <form id="form_satu">
                    @csrf
                    <input type="hidden" name="form" value="1">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="password" id="password_form_satu">
                    <input type="hidden" name="jenis" id="jenis_verif_form_satu">
                    <textarea hidden name="tanda_tangan" id="tanda_tangan_pasien"></textarea>
                    <input type="hidden" name="nama_keluarga" id="nama_keluarga">
                    <tr>
                        <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; margin-bottom:0">PERSETUJUAN / PENOLAKAN TINDAKAN BEDAH</th>
                    </tr>
                    <tr>
                        <td colspan="4" class="font-weight-bold pl-2">
                            *Coret yang tidak perlu
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center">
                            PEMBERI INFORMASI
                        </th>
                    </tr>
                    <tr>
                        <td class="pl-2" colspan="2">Dokter Pelaksana Tindakan</td>
                        <td colspan="2">
                            <div class="input-group">
                                <input type="hidden" value="{{ $data ? $data->id_dokter_pelaksana : '' }}" name="id_dokter_pelaksana">
                                <input type="text" name="dokter_pelaksana" class="form-control" value="{{ $data ? $data->nama_dokter_pelaksana : '' }}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" onclick="open_modal_dokter_pelaksana()"><i class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl-2" colspan="2" style="padding: 0; vertical-align: middle;">Pemberi Informasi</td>
                        <td colspan="2">
                            <div class="input-group">
                                <input type="hidden" value="{{ $data ? $data->id_pemberi_informasi : '' }}" name="id_pemberi_informasi">
                                <input type="text" value="{{ $data ? $data->nama_pemberi_informasi : '' }}" name="pemberi_informasi" class="form-control" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" onclick="open_modal_pemberi_informasi()"><i class="fa fa-list"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl-2" colspan="2">Penerima informasi</td>
                        <td colspan="2">
                            <input type="text" name="penerima_informasi" value="{{ $data ? $data->penerima_informasi : '' }}" class="form-control">
                        </td>
                    </tr>
                    <input type="hidden" name="informasi">
                    <?php $informasi = $data ? json_decode($data->informasi) : []; ?>
                    <tr class="text-center">
                        <td class="font-weight-bold" style="width: 3%;">NO</td>
                        <td class="font-weight-bold" style="width: 25%;">JENIS INFORMASI</td>
                        <td class="font-weight-bold" style="width: 50%;">ISI INFORMASI</td>
                        <td class="font-weight-bold">TANDA (V)</td>
                    </tr>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="pl-2">Diagnosis (DK) dan (DB)**</td>
                        <td><input type="text" value="{{ isset($informasi[0]) ? $informasi[0]->value : '' }}" id="diagnosis" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[0]) ? $informasi[0]->check ? 'checked' : '' : '' }} type="checkbox" id="diagnosis_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td class="pl-2">Dasar Diagnosis</td>
                        <td><input type="text" value="{{ isset($informasi[1]) ? $informasi[1]->value : '' }}" id="dasar_diagnosis" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[1]) ? $informasi[1]->check ? 'checked' : '' : '' }} type="checkbox" id="dasar_diagnosis_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td class="pl-2">Tindakan Kedokteran</td>
                        <td><input type="text" value="{{ isset($informasi[2]) ? $informasi[2]->value : '' }}" id="tindakan_kedokteran" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[2]) ? $informasi[2]->check ? 'checked' : '' : '' }} type="checkbox" id="tindakan_kedokteran_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td class="pl-2">Indikasi Tindakan</td>
                        <td><input type="text" value="{{ isset($informasi[3]) ? $informasi[3]->value : '' }}" id="indikasi_tindakan" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[3]) ? $informasi[3]->check ? 'checked' : '' : '' }} type="checkbox" id="indikasi_tindakan_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td class="pl-2">Tata Cara
                        </td>
                        <td><input type="text" value="{{ isset($informasi[4]) ? $informasi[4]->value : '' }}" id="tata_cara" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[4]) ? $informasi[4]->check ? 'checked' : '' : '' }} type="checkbox" id="tata_cara_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td class="pl-2">Tujuan</td>
                        <td><input type="text" value="{{ isset($informasi[5]) ? $informasi[5]->value : '' }}" id="tujuan" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[5]) ? $informasi[5]->check ? 'checked' : '' : '' }} type="checkbox" id="tujuan_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">7</td>
                        <td class="pl-2">Risiko</td>
                        <td><input type="text" value="{{ isset($informasi[6]) ? $informasi[6]->value : '' }}" id="risiko" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[6]) ? $informasi[6]->check ? 'checked' : '' : '' }} type="checkbox" id="risiko_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">8</td>
                        <td class="pl-2">Komplikasi</td>
                        <td><input type="text" value="{{ isset($informasi[7]) ? $informasi[7]->value : '' }}" id="komplikasi" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[7]) ? $informasi[7]->check ? 'checked' : '' : '' }} type="checkbox" id="komplikasi_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">9</td>
                        <td class="pl-2">
                            Prognosis
                        </td>
                        <td><input type="text" value="{{ isset($informasi[8]) ? $informasi[8]->value : '' }}" id="prognosis" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[8]) ? $informasi[8]->check ? 'checked' : '' : '' }} type="checkbox" id="prognosis_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">10</td>
                        <td class="pl-2">Alternatif dan Risiko</td>
                        <td><input type="text" value="{{ isset($informasi[9]) ? $informasi[9]->value : '' }}" id="alternatif_risiko" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[9]) ? $informasi[9]->check ? 'checked' : '' : '' }} type="checkbox" id="alternatif_risiko_check"></td>
                    </tr>
                    <tr>
                        <td class="text-center">11</td>
                        <td class="pl-2">Lain - lain
                        </td>
                        <td><input type="text" value="{{ isset($informasi[10]) ? $informasi[10]->value : '' }}" id="lain_lain" class="form-control"></td>
                        <td class="text-center"><input {{ isset($informasi[10]) ? $informasi[10]->check ? 'checked' : '' : '' }} type="checkbox" id="lain_lain_check"></td>
                    </tr>
                </form>
                <tr>
                    <td colspan="3" class="p-2" style="text-align: justify;">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jelas serta memberikan kesempatan untuk bertanya dan/atau berdikusi</td>
                    <td style="text-align: center; vertical-align: top;">
                        Tanda tangan dokter
                        <div id="box_ttd_dokter" onclick="open_modal_verifikasi('dokter')">
                            @if($data)
                            @if($data->id_dokter != 0)
                            <br>
                            <img src="{{ env('SMIS_URL_UPLOAD').'/'.($dokter ? $dokter->ttd : '') }}" alt="" style="width: 4cm; height:2.5cm;">
                            <br>
                            ({{ $data->nama_dokter }})
                            @else
                            <br />
                            <br />
                            <br />
                            Klik disini
                            <br />
                            <br />
                            <br />
                            (............................................)
                            @endif
                            @else
                            <br />
                            <br />
                            <br />
                            Klik disini
                            <br />
                            <br />
                            <br />
                            (............................................)
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="p-2" style="text-align: justify;">Dengan ini menyatakan bahwa saya telah menerima informasihal dari dokter sebagaimana diatas kemudiana yang saya beri tanda/paraf dikolom kanannya dan telah memahaminya.</td>
                    <td style="text-align: center; vertical-align: top;">
                        Tanda tangan pasien/keluarga
                        <div id="box_ttd_keluarga" onclick="open_modal_tanda_tangan('keluarga')">
                            @if($data)
                            @if($data->tanda_tangan_keluarga != '')
                            <br>
                            <img src="{{ asset('signature_patient/'.$data->tanda_tangan_keluarga) }}" alt="" style="width: 4cm; height:2.5cm;">
                            <br>
                            ({{ $data->nama_keluarga }})
                            @else
                            <br />
                            <br />
                            <br />
                            Klik disini
                            <br />
                            <br />
                            <br />
                            (............................................)
                            @endif
                            @else
                            <br />
                            <br />
                            <br />
                            Klik disini
                            <br />
                            <br />
                            <br />
                            (............................................)
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="p-2" style="text-align: justify; font-size: 14px;">
                        *Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat. <br />
                        **DK = Diagnosis Kerja, DB = Diganosis Banding
                    </td>
                </tr>
                <tr>
                    <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; padding: 0;">PERNYATAAN</th>
                </tr>
            </table>
            <div class="row">
                <?php $pernyataan = $data ? json_decode($data->pernyataan) : null; ?>
                <form class="col-sm-12" id="form_dua">
                    @csrf
                    <input type="hidden" name="jenis" id="jenis_verif_form_dua">
                    <input type="hidden" name="pernyataan" id="pernyataan">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="form" value="2">
                    <input type="hidden" name="password" id="password_form_dua">
                    <input type="hidden" name="tanda_tangan" id="tanda_tangan_form_dua">
                    <input type="hidden" name="nama_keluarga" id="nama_keluarga_form_dua">
                    <div style="border:1px solid; padding: 5px; margin-top: -18px;">
                        Saya yang bertanda tangan dibawah ini: <br />

                        <table style="border-collapse: collapse; width:100%" class="mb-3">
                            <tr class="">
                                <td style="width: 12%;">Nama</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" value="{{ $pernyataan ? $pernyataan->nama_pasien : $pasien->nama }}" id="nama_pasien_p" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">
                                </td>
                            </tr>

                            <tr class="">
                                <td style="width: 12%;">Alamat</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" value="{{ $pernyataan ? $pernyataan->alamat_pasien : $pasien->alamat }}" id="alamat_pasien" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">
                                </td>
                            </tr>
                        </table>
                        <p class="mt-3" style="line-height: 1.5;">
                            Dengan ini menyatakan <input type="radio" {{ $pernyataan ? $pernyataan->menyetujui == '1' ? 'checked' : '' : ''  }} name="menyetujui" value="1"> MENYETUJUI / <input {{ $pernyataan ? $pernyataan->menyetujui == '0' ? 'checked' : '' : ''  }} type="radio" name="menyetujui" value="0"> MENOLAK untuk dilakukan tindakan <input type="text" id="tindakan" value="{{ $pernyataan ? $pernyataan->tindakan : '' }}" style="border:1px solid transparent; border-bottom: 2px dotted; width: 100%; background-color: transparent;" class="mb-3 mt-3"> <br />
                            terhadap saya / <input value="{{ $pernyataan ? $pernyataan->hubungan : '' }}" type="text" id="hubungan" style="border:1px solid transparent; border-bottom: 2px dotted; width: 10%; background-color: transparent;"> saya yang bernama <input id="nama_kerabat" value="{{ $pernyataan ? $pernyataan->nama_keluarga : $pasien->nama }}" type="text" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40%; background-color: transparent;"> Tgl lahir : <input id="tanggal_lahir_keluarga" value="{{ $pernyataan ? $pernyataan->tanggal_lahir_keluarga != '' ? date('d-m-Y', strtotime($pernyataan->tanggal_lahir_keluarga)) : date('d-m-Y', strtotime($pasien->tgl_lahir)) : date('d-m-Y', strtotime($pasien->tgl_lahir)) }}" type="text" class="datepicker" id="tanggal_lahir" style="border:1px solid transparent; border-bottom: 2px dotted; width: 10%; background-color: transparent;"> <input type="radio" name="kelamin_keluarga" {{ $pernyataan ? $pernyataan->kelamin_keluarga == '0' ? 'checked' : '' : ($pasien->kelamin == 0 ? 'checked' : '') }} value="0"> L <input type="radio" name="kelamin_keluarga" {{ $pernyataan ? $pernyataan->kelamin_keluarga == '1' ? 'checked' : '' : ($pasien->kelamin == 1 ? 'checked' : '') }} value="1"> P
                        </p>


                        <table style="border-collapse: collapse; width:100%" class="mb-3">
                            <tr class="">
                                <td style="width: 12%;">Alamat</td>
                                <td style="width: 3%;"> : </td>
                                <td style="width: 85%;">
                                    <input type="text" value="{{ $pernyataan ? $pernyataan->alamat_keluarga : $pasien->alamat }}" id="alamat_keluarga" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">
                                </td>
                            </tr>
                        </table>

                        <p class="mt-3" style="text-align: justify;">
                            Saya memahami atas manfaat tindakan tersebut sebagaimana telah dijelaskan seperti di atas kepada saya, termasuk resiko dan kompilasi yang mungkin timbul. Saya juga menyadari bahwa ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat tergantung kepada izin Tuhan Yang Maha Esa.
                        </p>

                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center ">
                                <div id="box_ttd_pasien" onclick="open_modal_tanda_tangan('pasien')">
                                    @if($data)
                                    @if($data->tanda_tangan_menyatakan != '')
                                    <br>
                                    <img src="{{ asset('signature_patient/'.$data->tanda_tangan_menyatakan) }}" alt="" style="width: 4cm; height:2.5cm;">
                                    <br>
                                    ({{ $data->nama_menyatakan }})
                                    <br>
                                    Yang menyatakan
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik disini
                                    <br />
                                    <br />
                                    <br />
                                    (............................................)
                                    <br>
                                    Yang menyatakan
                                    @endif
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik disini
                                    <br />
                                    <br />
                                    <br />
                                    (............................................)
                                    <br>
                                    Yang menyatakan
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <div id="box_ttd_wali" onclick="open_modal_tanda_tangan('wali')">
                                    @if($data)
                                    @if($data->tanda_tangan_wali != '')
                                    <br>
                                    <img src="{{ asset('signature_patient/'.$data->tanda_tangan_wali) }}" alt="" style="width: 4cm; height:2.5cm;">
                                    <br>
                                    ({{ $data->nama_wali }})
                                    <br>
                                    Keluarga/Wali
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik disini
                                    <br />
                                    <br />
                                    <br />
                                    (............................................)
                                    <br>
                                    Keluarga/Wali
                                    @endif
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik disini
                                    <br />
                                    <br />
                                    <br />
                                    (............................................)
                                    <br>
                                    Keluarga/Wali
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                Cibarusah, <input type="text" class="datetimepicker" name="tanggal_verifikasi" value="{{ $data && $data->tanggal_verifikasi != '0000-00-00 00:00:00' ? date('d-m-Y H:i', strtotime($data->tanggal_verifikasi)) : date('d-m-Y H:i') }}" style="border:1px solid transparent; border-bottom: 2px dotted; width:40%; background-color: transparent;">
                                <span id="box_ttd_perawat" onclick="open_modal_verifikasi('perawat')">
                                    @if($data)
                                    @if($data->id_perawat != 0)
                                    <br>
                                    <img src="{{ env('SMIS_URL_UPLOAD').'/'.($perawat ? $perawat->ttd : '') }}" alt="" style="width: 4cm; height:2.5cm;">
                                    <br>
                                    ({{ $data->nama_perawat }})
                                    <br>
                                    Perawat
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik disini
                                    <br />
                                    <br />
                                    <br />
                                    (............................................)
                                    <br>
                                    Perawat
                                    @endif
                                    @else
                                    <br />
                                    <br />
                                    <br />
                                    Klik disini
                                    <br />
                                    <br />
                                    <br />
                                    (............................................)
                                    <br>
                                    Perawat
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dokter_pelaksana" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dokter Mengirim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="tabel_dokter_pelaksana" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
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

    <div class="modal fade" id="modal_pemberi_informasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dokter Mengirim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="tabel_pemberi_informasi" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
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

    <div class="modal fade" id="modal_verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verif">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" id="password" placeholder="Masukkan password anda" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_tanda_tangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda Tangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_tanda_tangan">
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                        </div>
                        <div class="form-group text-center">
                            <input type="text" id="tanda_tangan_nama" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="button" id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#modal_tanda_tangan').on('hidden.bs.modal', function() {
        $('#tanda_tangan_pasien').val('');
        $('#nama_pasien').val('');
        $('#tanda_tangan_keluarga').val('');
        $('#nama_keluarga').val('');
        $('#tanda_tangan_wali').val('');
        $('#nama_wali').val('');
        $('#form_tanda_tangan')[0].reset();
        signaturePad.clear();
    });

    $('#modal_verif').on('hidden.bs.modal', function() {
        $('#tanda_tangan_pasien').val('');
        $('#nama_pasien').val('');
        $('#tanda_tangan_keluarga').val('');
        $('#nama_keluarga').val('');
        $('#tanda_tangan_wali').val('');
        $('#nama_wali').val('');
        $('#form_verif')[0].reset();
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $('#tanda_tangan_pasien').val('');
        $('#nama_pasien').val('');
        $('#tanda_tangan_keluarga').val('');
        $('#nama_keluarga').val('');
        $('#tanda_tangan_wali').val('');
        $('#nama_wali').val('');
    });

    function open_modal_tanda_tangan(param) {
        $('#jenis_verif_form_satu').val('');
        $('#jenis_verif_form_dua').val('');
        param == 'keluarga' ? $('#jenis_verif_form_satu').val(param) : $('#jenis_verif_form_dua').val(param);
        $('#modal_tanda_tangan').modal('show');
    }

    function open_modal_verifikasi(param) {
        $('#jenis_verif_form_satu').val('');
        $('#jenis_verif_form_dua').val('');
        param == 'dokter' ? $('#jenis_verif_form_satu').val(param) : $('#jenis_verif_form_dua').val(param);
        $('#modal_verif').modal('show');
    }

    $('#form_tanda_tangan').submit(function(e) {
        e.preventDefault();
        if ($('#jenis_verif_form_satu').val() == 'keluarga') {
            let informasi = [{
                'value': $('#diagnosis').val(),
                'check': $('#diagnosis_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#dasar_diagnosis').val(),
                'check': $('#dasar_diagnosis_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#tindakan_kedokteran').val(),
                'check': $('#tindakan_kedokteran_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#indikasi_tindakan').val(),
                'check': $('#indikasi_tindakan_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#tata_cara').val(),
                'check': $('#tata_cara_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#tujuan').val(),
                'check': $('#tujuan_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#risiko').val(),
                'check': $('#risiko_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#komplikasi').val(),
                'check': $('#komplikasi_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#prognosis').val(),
                'check': $('#prognosis_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#alternatif_risiko').val(),
                'check': $('#alternatif_risiko_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#lain_lain').val(),
                'check': $('#lain_lain_check').is(':checked') ? 1 : 0
            }];

            $('[name=informasi]').val(JSON.stringify(informasi));

            $('#tanda_tangan_pasien').val(signaturePad.toDataURL('image/png'));
            $('#nama_keluarga').val($('#tanda_tangan_nama').val());
            $('#form_satu').submit();
        } else {
            let pernyataan = {
                'nama_pasien': $('#nama_pasien_p').val(),
                'alamat_pasien': $('#alamat_pasien').val(),
                'menyetujui': $('[name=menyetujui]:checked').val() != undefined ? $('[name=menyetujui]:checked').val() : '',
                'tindakan': $('#tindakan').val(),
                'hubungan': $('#hubungan').val(),
                'nama_keluarga': $('#nama_kerabat').val(),
                'tanggal_lahir_keluarga': $('#tanggal_lahir_keluarga').val(),
                'kelamin_keluarga': $('[name=kelamin_keluarga]:checked').val() != undefined ? $('[name=kelamin_keluarga]:checked').val() : '',
                'alamat_keluarga': $('#alamat_keluarga').val()
            };

            $('#pernyataan').val(JSON.stringify(pernyataan));
            $('#tanda_tangan_form_dua').val(signaturePad.toDataURL('image/png'));
            $('#nama_keluarga_form_dua').val($('#tanda_tangan_nama').val());
            $('#form_dua').submit();
        }
    })



    $('#form_verif').submit(function(e) {
        e.preventDefault();

        if ($('#password').val() == '') {
            toastr.error('Password harus diisi');
            return;
        }

        if ($('#jenis_verif_form_satu').val() == 'dokter') {
            let informasi = [{
                'value': $('#diagnosis').val(),
                'check': $('#diagnosis_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#dasar_diagnosis').val(),
                'check': $('#dasar_diagnosis_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#tindakan_kedokteran').val(),
                'check': $('#tindakan_kedokteran_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#indikasi_tindakan').val(),
                'check': $('#indikasi_tindakan_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#tata_cara').val(),
                'check': $('#tata_cara_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#tujuan').val(),
                'check': $('#tujuan_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#risiko').val(),
                'check': $('#risiko_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#komplikasi').val(),
                'check': $('#komplikasi_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#prognosis').val(),
                'check': $('#prognosis_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#alternatif_risiko').val(),
                'check': $('#alternatif_risiko_check').is(':checked') ? 1 : 0
            }, {
                'value': $('#lain_lain').val(),
                'check': $('#lain_lain_check').is(':checked') ? 1 : 0
            }];

            $('[name=informasi]').val(JSON.stringify(informasi));
            $('#password_form_satu').val($('#password').val());
            $('#form_satu').submit();
        } else {
            let pernyataan = {
                'nama_pasien': $('#nama_pasien_p').val(),
                'alamat_pasien': $('#alamat_pasien').val(),
                'menyetujui': $('[name=menyetujui]:checked').val() != undefined ? $('[name=menyetujui]:checked').val() : '',
                'tindakan': $('#tindakan').val(),
                'hubungan': $('#hubungan').val(),
                'nama_keluarga': $('#nama_kerabat').val(),
                'tanggal_lahir_keluarga': $('#tanggal_lahir_keluarga').val(),
                'kelamin_keluarga': $('[name=kelamin_keluarga]:checked').val() != undefined ? $('[name=kelamin_keluarga]:checked').val() : '',
                'alamat_keluarga': $('#alamat_keluarga').val()
            };

            $('#pernyataan').val(JSON.stringify(pernyataan));
            $('#password_form_dua').val($('#password').val());
            $('#form_dua').submit();
        }
    })

    $('#form_satu').submit(function(e) {
        e.preventDefault();
        toastr.warning('Harap tunggu, sedang update dokumen...');
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/persetujuan_atau_penolakan_tindakan_bedah/store') }}",
            data: $('#form_satu').serialize(),
            method: 'post',
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                $('#form_verif')[0].reset();
                $('#modal_tanda_tangan').modal('hide');
                $('#modal_verif').modal('hide');
                $('#jenis_verif_form_satu').val() == 'dokter' ? render_tanda_tangan(response.employee, response.jenis) : render_tanda_tangan_pasien(response.data.nama_keluarga, response.data.tanda_tangan_keluarga, 'keluarga');
                $('#jenis_verif_form_satu').val('');
                $('#jenis_verif_form_dua').val('');
            }
        })
    })

    $('#form_dua').submit(function(e) {
        e.preventDefault();
        toastr.warning('Harap tunggu, sedang update dokumen...');
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/persetujuan_atau_penolakan_tindakan_bedah/store') }}",
            data: $('#form_dua').serialize(),
            method: 'post',
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                $('#modal_tanda_tangan').modal('hide');
                $('#modal_verif').modal('hide');

                switch (response.jenis) {
                    case 'pasien':
                        render_tanda_tangan_pasien(response.data.nama_menyatakan, response.data.tanda_tangan_menyatakan, response.jenis)
                        break;
                    case 'wali':
                        render_tanda_tangan_pasien(response.data.nama_wali, response.data.tanda_tangan_wali, response.jenis)
                        break;
                    case 'perawat':
                        render_tanda_tangan(response.employee, response.jenis)
                        break;
                    default:
                        break;
                }
                $('#jenis_verif_form_satu').val('');
                $('#jenis_verif_form_dua').val('');
            }
        })
    })

    function render_tanda_tangan(employee, jenis) {
        var ins = '<br>' +
            `<img class="mt-2" src="{{ env('SMIS_UPLOAD_URL') }}/` + employee.ttd + `" alt="" style="width: 4cm; height: 2.5cm;">` +
            '<br>' +
            '(' + employee.nama + ')';


        $('#box_ttd_' + jenis).html(ins);
    }

    function render_tanda_tangan_pasien(pasien, ttd, jenis) {
        var ins = '<br>' +
            `<img class="mt-2" src="{{ asset('signature_patient') }}/` + ttd + `" alt="" style="width: 4cm; height: 2.5cm;">` +
            '<br>' +
            '(' + pasien + ')' +
            '<br>' +
            (jenis == 'wali' ? 'Keluarga/Wali' : 'Yang menyatakan');

        $('#box_ttd_' + jenis).html(ins);
    }
</script>

<script>
    function open_modal_pemberi_informasi() {
        if ($.fn.DataTable.isDataTable("#tabel_pemberi_informasi")) {
            $('#tabel_pemberi_informasi').DataTable().clear().destroy();
        }

        $('#tabel_pemberi_informasi').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('ajax_request/datatable_dokter_dan_perawat') }}",
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'no_ijin',
                    name: 'no_ijin'
                },
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<div class="text-center">' +
                            '<button class="btn btn-dark" onclick="set_pemberi_informasi(' + "'" + row.nama + "','" + data + "'" + ')">' +
                            '<i class="fa fa-check"></i>' +
                            '</button>' +
                            '</div>';
                    }
                },
            ]
        });

        $('#modal_pemberi_informasi').modal('show');
    }

    function set_pemberi_informasi(nama, id) {
        $('[name=id_pemberi_informasi]').val(id);
        $('[name=pemberi_informasi]').val(nama);
        $('#modal_pemberi_informasi').modal('hide');
    }
</script>

<script>
    function open_modal_dokter_pelaksana() {
        if ($.fn.DataTable.isDataTable("#tabel_dokter_pelaksana")) {
            $('#tabel_dokter_pelaksana').DataTable().clear().destroy();
        }

        $('#tabel_dokter_pelaksana').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('ajax_request/datatable_dokter') }}",
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'no_ijin',
                    name: 'no_ijin'
                },
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<div class="text-center">' +
                            '<button class="btn btn-dark" onclick="set_dokter_pelaksana(' + "'" + row.nama + "','" + data + "'" + ')">' +
                            '<i class="fa fa-check"></i>' +
                            '</button>' +
                            '</div>';
                    }
                },
            ]
        });

        $('#modal_dokter_pelaksana').modal('show');
    }

    function set_dokter_pelaksana(nama, id) {
        $('[name=id_dokter_pelaksana]').val(id);
        $('[name=dokter_pelaksana]').val(nama);
        $('#modal_dokter_pelaksana').modal('hide');
    }
</script>

<!-- script autocomplete -->
<script>
    $("#diagnosis").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosis").val(suggestion.icd + ' - ' + suggestion.nama);
        }
    });
</script>
<!-- end script autocomplete -->

<script>
    $('.datetimepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm'
        },
        useCurrent: false,
        autoUpdateInput: true,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });

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

    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY'
        },
        useCurrent: false,
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
        timePicker24Hour: false,
    });

    $('#tanggal_lahir_keluarga').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('#tanggal_lahir_keluarga').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>

</html>