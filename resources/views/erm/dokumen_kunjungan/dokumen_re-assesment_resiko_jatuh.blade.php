<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIMRS - Re-Assesment Resiko Jatuh</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
        <style>
            .table-basic{
                width: 100%;
                border: 1px;
            }

            .text-small{
                font-size: 0.5rem;
                display: block;
                text-align: center;
            }

            .table-basic h6{
                text-decoration: underline;
            }

            .table-basic td {
                border: black 1px solid;
            }

            .table-basic tbody td{
                padding: 5px 3px;
            }

            .table-basic .header-renpra {
                background-color: #ccc;
            }

            .table-basic input{
                border:0;
                outline:0;
                border-bottom: 2px dotted #000;
            }

            .table-content{
                width: 100%;
                outline: 0rem;
                padding: 0px;
                margin: -1px;
            }

            .table-content   tbody td{
                padding: 0px;
                border: black 0px solid;
            }

            .flex-container {
                display: inline-flex;
                flex-direction: row;
                flex-wrap: nowrap;
                justify-content: flex-start;
                align-items: flex-start;
                align-content: stretch;
            }

            .flex-items {
                display: block;
                flex-grow: 0;
                margin-right: 30px;
                flex-shrink: 1;
                flex-basis: auto;
                align-self: auto;
                order: 0;
            }
            .cel-date{
                width: 1rem;
                text-align: center;

            }

            .cel-date input{
                width: 100%;
                font-size: 12px;
                text-align: center;
            }

            .totalScore{
                font-size: 16px!important;
            }

            .table-detail thead{
                text-align: center;
                font-weight: bold;
            }

            .table-detail tbody .check{
                text-align: center;
            }

            .table-detail tfoot img{
                width: 80%!important;
            }
        </style>
    </head>
    <body class="p-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-8">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                    <p style="font-weight: bold">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya,<br>Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="w-100" style="border: 2px solid; padding:30px; border-radius:10px; font-weight: bold;float: right;">
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
                        </table>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="m-0 p-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <form id="formInput" style="width: 100%;" action="{{ url('e_rekam_medis/detail/save_reassesment_resiko_jatuh') }}" method="post">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <table class="table-basic">
                        <thead>
                            <tr class="header-renpra">
                                <td colspan="9" class="font-weight-bold text-center">RE-ASSESMENT RESIKO JATUH
                                    <br>
                                    METODE MORSE
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" class="font-italic">Asesment resiko jatuh pada pasien dewasa ( > 18 s/d < 60 tahun </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center;">
                                <td rowspan="2" style="width: 5%;">NO</td>
                                <td rowspan="2" style="width: 38%;">PARAMETER</td>
                                <td rowspan="2" style="width: 5%;">SKOR</td>
                                <td colspan="6" style="width: 30%;">Tanggal dan Jam</td>
                            </tr>
                            <tr>
                                <td class="cel-date"> <input type="text" name="TanggalJam1" data-state='{{$detail && $detail->TanggalJam1 ? 1 : 0}}' value="{{ $detail ? Illuminate\Support\Carbon::parse($detail->TanggalJam1)->format('d/m/Y H:i') : '' }}" class="datetimepicker"> </td>
                                <td class="cel-date"> <input type="text" name="TanggalJam2" data-state='{{$detail && $detail->TanggalJam2 ? 1 : 0}}' value="{{ $detail ? Illuminate\Support\Carbon::parse($detail->TanggalJam2)->format('d/m/Y H:i') : '' }}" class="datetimepicker"> </td>
                                <td class="cel-date"> <input type="text" name="TanggalJam3" data-state='{{$detail && $detail->TanggalJam3 ? 1 : 0}}' value="{{ $detail ? Illuminate\Support\Carbon::parse($detail->TanggalJam3)->format('d/m/Y H:i') : '' }}" class="datetimepicker"> </td>
                                <td class="cel-date"> <input type="text" name="TanggalJam4" data-state='{{$detail && $detail->TanggalJam4 ? 1 : 0}}' value="{{ $detail ? Illuminate\Support\Carbon::parse($detail->TanggalJam4)->format('d/m/Y H:i') : '' }}" class="datetimepicker"> </td>
                                <td class="cel-date"> <input type="text" name="TanggalJam5" data-state='{{$detail && $detail->TanggalJam5 ? 1 : 0}}' value="{{ $detail ? Illuminate\Support\Carbon::parse($detail->TanggalJam5)->format('d/m/Y H:i') : '' }}" class="datetimepicker"> </td>
                            </tr>
                            @php
                                $arrlist = [
                                    [
                                        "No" => 1,
                                        "Q" => "Apakah ada riwayat jatuh dalam waktu 3 bulan terakhir sebab apapun ?",
                                        "Tipe" => 1,
                                        "Skor" => 25
                                    ],
                                    [
                                        "No" => 2,
                                        "Q" => "Apakah mempunyai penyakit penyerta ( Diagnosis skunder ) >1",
                                        "Tipe" => 1,
                                        "Skor" => 15
                                    ],
                                    [
                                        "No" => 3,
                                        "Q" => "Menggunakan alat berialan :",
                                        "Tipe" => 2,
                                        "Skor" => 0
                                    ],
                                    [
                                        "No" => 3,
                                        "Q" => "Dibantu perawat / tidak menggunakan alat bantu",
                                        "Tipe" => 1,
                                        "Skor" => 0
                                    ],
                                    [
                                        "No" => 3,
                                        "Q" => "Menggunakan alat bantu : Kruk/Tongkat, Kursi roda",
                                        "Tipe" => 1,
                                        "Skor" => 15,
                                    ],
                                    [
                                        "No" => 3,
                                        "Q" => "Merambat dengan berpegangan pada meja, kursi. dll",
                                        "Tipe" => 1,
                                        "Skor" => 30,
                                    ],
                                    [
                                        "No" => 4,
                                        "Q" => "Apakah terpasang infuse/pemberian antikoagulan ( Heparin )/obat yang lain yang mempunyai efek samping resiko jatuh",
                                        "Tipe" => 1,
                                        "Skor" => 20
                                    ],
                                    [
                                        "No" => 5,
                                        "Q" => "Kondisi untuk melakukan gerakan berpindah/Mobilisasi",
                                        "Tipe" => 2,
                                        "Skor" => 0
                                    ],
                                    [
                                        "No" => 5,
                                        "Q" => "Normal/Bedrest/Imobilisasi",
                                        "Tipe" => 1,
                                        "Skor" => 0
                                    ],
                                    [
                                        "No" => 5,
                                        "Q" => "Lemah",
                                        "Tipe" => 1,
                                        "Skor" => 10
                                    ],
                                    [
                                        "No" => 5,
                                        "Q" => "Ada keterbatasan berialan",
                                        "Tipe" => 1,
                                        "Skor" => 20
                                    ],
                                    [
                                        "No" => 6,
                                        "Q" => "Bagaimana status mental",
                                        "Tipe" => 1,
                                        "Skor" => 0
                                    ],
                                    [
                                        "No" => 6,
                                        "Q" => "Menyadari kelemahannya",
                                        "Tipe" => 1,
                                        "Skor" => 0
                                    ],
                                    [
                                        "No" => 6,
                                        "Q" => "Tidak menyadari kelemahannva",
                                        "Tipe" => 1,
                                        "Skor" => 15
                                    ],
                                ];

                                $arrlists = [];
                                foreach ($arrlist as $key => $value) {
                                    $arrlists[$value["No"]][] = $value;
                                }

                                // dd($arrlists);
                            @endphp

                            @php
                                $lastNumber = 0;
                                $countSame = 0;
                                $idx = 0;
                            @endphp
                            @foreach ($arrlists as $key => $items)
                                @foreach ($items as $key2 => $item)
                                    @php
                                        $objAssest = clone $assesment;
                                        $oneData = $objAssest->where(['idx' => $idx])->first();
                                    @endphp
                                    <tr>
                                        @if ($key2 == 0)
                                            <td rowspan="{{count($items)}}">{{$item["No"]}}</td>
                                        @endif
                                        <td>
                                            {{$item["Q"]}}
                                            <input type="hidden" name="Parameter[{{$idx}}]" value="{{$item["Q"]}}">
                                            <input type="hidden" name="Tipe[{{$idx}}]" value="{{$item["Tipe"]}}">
                                            <input type="hidden" name="Idx[]" value="{{$idx}}">
                                            <input type="hidden" name="ScoreParameter[{{$idx}}]" value="{{$item["Skor"]}}">
                                        </td>
                                        @if (($item['Tipe'] == 2))
                                            <td {{($item['Tipe'] == 2) ? "colspan=6" : ""}}></td>
                                        @else
                                            <td class="cel-date" style="text-align: left;">
                                                Ya : {{$item["Skor"]}}
                                                <br>
                                                Tidak : 0
                                            </td>
                                            <td class="cel-date">
                                                {{-- s ini : {{$idx}}, itu : {{$oneData ? $oneData->Score1 : ''}} --}}
                                                <select class="inputScore" name="Score1[{{$idx}}]" data-score="{{$item["Skor"]}}" data-idx="1">
                                                    <option {{ $oneData && $oneData->Score1 == null ? 'selected' : ''}} value=""></option>
                                                    <option {{ $oneData ? $oneData->Score1 == 1 ? 'selected' : '' : ($item['No'] == 4 ? 'selected' : '' ) }} value="1">Ya</option>
                                                    <option {{ $oneData ? $oneData->Score1 == '0' ? 'selected' : '' : ($item['No'] == 1 || $item['No'] == 2 || $item['No'] == 3 || $item['No'] == 5 || $item['No'] == 6 ? 'selected' : '' )}} value="0" data-score="0">Tidak</option>
                                                </select>
                                            </td>
                                            <td class="cel-date">
                                                <select class="inputScore" name="Score2[{{$idx}}]" data-score="{{$item["Skor"]}}" data-idx="2">
                                                    <option {{ $oneData && $oneData->Score2 == null ? 'selected' : ''}} value=""></option>
                                                    <option {{ $oneData && $oneData->Score2 == 1 ? 'selected' : ''}} value="1">Ya</option>
                                                    <option {{ $oneData && $oneData->Score2 == '0' ? 'selected' : ''}} value="0" data-score="0">Tidak</option>
                                                </select>
                                            </td>
                                            <td class="cel-date">
                                                <select class="inputScore" name="Score3[{{$idx}}]" data-score="{{$item["Skor"]}}" data-idx="3">
                                                    <option {{ $oneData && $oneData->Score3 == null ? 'selected' : ''}} value=""></option>
                                                    <option {{ $oneData && $oneData->Score3 == 1 ? 'selected' : ''}} value="1">Ya</option>
                                                    <option {{ $oneData && $oneData->Score3 == '0' ? 'selected' : ''}} value="0" data-score="0">Tidak</option>
                                                </select>
                                            </td>
                                            <td class="cel-date">
                                                <select class="inputScore" name="Score4[{{$idx}}]" data-score="{{$item["Skor"]}}" data-idx="4">
                                                    <option {{ $oneData && $oneData->Score4 == null ? 'selected' : ''}} value=""></option>
                                                    <option {{ $oneData && $oneData->Score4 == 1 ? 'selected' : ''}} value="1">Ya</option>
                                                    <option {{ $oneData && $oneData->Score4 == '0' ? 'selected' : ''}} value="0" data-score="0">Tidak</option>
                                                </select>
                                            </td>
                                            <td class="cel-date">
                                                <select class="inputScore" name="Score5[{{$idx}}]" data-score="{{$item["Skor"]}}" data-idx="5">
                                                    <option {{ $oneData && $oneData->Score5 == null ? 'selected' : ''}} value=""></option>
                                                    <option {{ $oneData && $oneData->Score5 == 1 ? 'selected' : ''}} value="1">Ya</option>
                                                    <option {{ $oneData && $oneData->Score5 == '0' ? 'selected' : ''}} value="0" data-score="0">Tidak</option>
                                                </select>
                                            </td>
                                        @endif
                                    </tr>
                                    @php
                                        $idx++;
                                    @endphp
                                @endforeach
                            @php

                            @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Jumlah Skor</td>
                                <td class="cel-date">
                                    <input type="text" name="TotalScore1" class="totalScore" id="totalSkor1"  readonly>
                                </td>
                                <td class="cel-date">
                                    <input type="text" name="TotalScore2" class="totalScore" id="totalSkor2" readonly>
                                </td>
                                <td class="cel-date">
                                    <input type="text" name="TotalScore3" class="totalScore" id="totalSkor3" readonly>
                                </td>
                                <td class="cel-date">
                                    <input type="text" name="TotalScore4" class="totalScore" id="totalSkor4" readonly>
                                </td>
                                <td class="cel-date">
                                    <input type="text" name="TotalScore5" class="totalScore" id="totalSkor5" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="cel-date" colspan="3">Tanda tangan dan nama petugas yang menilai</td>

                                <td class="cel-date">

                                    @if ($detail  && $detail->verifikator1 )
                                        @if ($detail->user_verifikator1 && $detail->user_verifikator1->hrd_employee && $detail->user_verifikator1->hrd_employee->ttd)
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $detail->user_verifikator1->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                            <span class="text-small">{{$detail->user_verifikator1->hrd_employee->nama}}</span>
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                        @endif
                                    @else
                                    <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="1">Verifikasi</button>
                                    @endif
                                </td>
                                <td class="cel-date">

                                    @if ($detail  && $detail->verifikator2 )
                                        @if ($detail->user_verifikator2 && $detail->user_verifikator2->hrd_employee && $detail->user_verifikator2->hrd_employee->ttd)
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $detail->user_verifikator2->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                            <span class="text-small">{{$detail->user_verifikator2->hrd_employee->nama}}</span>
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                        @endif
                                    @else
                                    <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="2">Verifikasi</button>
                                    @endif
                                </td>
                                <td class="cel-date">
                                    @if ($detail  && $detail->verifikator3 )
                                        @if ($detail->user_verifikator3 && $detail->user_verifikator3->hrd_employee && $detail->user_verifikator3->hrd_employee->ttd)
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $detail->user_verifikator3->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                            <span class="text-small">{{$detail->user_verifikator3->hrd_employee->nama}}</span>
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                        @endif
                                    @else
                                    <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="3">Verifikasi</button>
                                    @endif
                                </td>
                                <td class="cel-date">
                                    @if ($detail  && $detail->verifikator4 )
                                        @if ($detail->user_verifikator4 && $detail->user_verifikator4->hrd_employee && $detail->user_verifikator4->hrd_employee->ttd)
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $detail->user_verifikator4->hrd_employee->ttd }}" style="width: 400%;object-fit: contain;" alt="">
                                            <span class="text-small">{{$detail->user_verifikator4->hrd_employee->nama}}</span>
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                        @endif
                                    @else
                                    <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="4">Verifikasi</button>
                                    @endif
                                </td>
                                <td class="cel-date">
                                    @if ($detail  && $detail->verifikator5 )
                                        @if ($detail->user_verifikator5 && $detail->user_verifikator5->hrd_employee && $detail->user_verifikator5->hrd_employee->ttd)
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $detail->user_verifikator5->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                            <span class="text-small">{{$detail->user_verifikator5->hrd_employee->nama}}</span>
                                        @else
                                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                        @endif
                                    @else
                                    <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="5">Verifikasi</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <span>Keterangan tingkat resiko :</span>
                                    <ul>
                                        <li>Resiko Ringan ( 0-24 ) : Lakukan perawatan yang baik</li>
                                        <li>Resiko Sedang ( 25-50 ) : Lakukan intervensi jatuh standar</li>
                                        <li>Resiko Berat ( > 50 ) : Lakukan intervensi resiko jatuh tinggi</li>
                                    </ul>
                                </td>
                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row mt-4">
                        <div class="col-md-12 ">
                            <button type="submit" class=" btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

            <div></div>

        </div>
        <br>
        <h6>MONITORIN RESIKO JATUH</h6>
        <hr>
        @if ($detailAssesment)
            @foreach ($detailAssesment as $keyItem => $detailItem)
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-8">
                            <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                            <p style="font-weight: bold">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya,<br>Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="w-100" style="border: 2px solid; padding:30px; border-radius:10px; font-weight: bold;float: right;">
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
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="m-0 p-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <form id="formInputDetail" style="width: 100%;" action="{{ url('e_rekam_medis/detail/save_reassesment_resiko_jatuh_detail') }}" method="post">
                            @csrf
                            <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                            <table class="table-basic table-detail">
                                <thead>
                                    @php
                                        $objAssestDetail = clone $detailAsesment;
                                        $oneDataDetail = $objAssestDetail->where(['jenis' => $keyItem])->first();
                                    @endphp
                                    <tr class="header-renpra">
                                        <td colspan="18" class="font-weight-bold text-center">MONITORING RESIKO JATUH
                                        </td>
                                    </tr>
                                    <tr style="text-align: center;">
                                        <td rowspan="2" style="width: 5%;">JENIS RESIKO</td>
                                        <td rowspan="2" style="width: 5%;">NO</td>
                                        <td rowspan="2" style="width: 40%;">PARAMETER</td>
                                        <td colspan="3" style="width: 6%;" class="cel-date">
                                            TGL: <input type="text" name="TanggalJamDetail1" data-state='{{$oneDataDetail && $oneDataDetail->TanggalJam1 ? 1 : 0}}' value="{{ $oneDataDetail ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam1)->format('d/m/Y') : '' }}" class="datepicker">
                                        </td>
                                        <td colspan="3" style="width: 6%;" class="cel-date">
                                            TGL: <input type="text" name="TanggalJamDetail2" data-state='{{$oneDataDetail && $oneDataDetail->TanggalJam2 ? 1 : 0}}' value="{{ $oneDataDetail ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam2)->format('d/m/Y') : ''}}" class="datepicker">
                                        </td>
                                        <td colspan="3" style="width: 6%;" class="cel-date">
                                            TGL: <input type="text" name="TanggalJamDetail3" data-state='{{$oneDataDetail && $oneDataDetail->TanggalJam3 ? 1 : 0}}' value="{{ $oneDataDetail ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam3)->format('d/m/Y') : ''}}" class="datepicker">
                                        </td>
                                        <td colspan="3" style="width: 6%;" class="cel-date">
                                            TGL: <input type="text" name="TanggalJamDetail4" data-state='{{$oneDataDetail && $oneDataDetail->TanggalJam4 ? 1 : 0}}' value="{{ $oneDataDetail ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam4)->format('d/m/Y') : ''}}" class="datepicker">
                                        </td>
                                        <td colspan="3" style="width: 6%;" class="cel-date">
                                            TGL: <input type="text" name="TanggalJamDetail5" data-state='{{$oneDataDetail && $oneDataDetail->TanggalJam5 ? 1 : 0}}' value="{{ $oneDataDetail ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam5)->format('d/m/Y') : ''}}" class="datepicker">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>P</td>
                                        <td>S</td>
                                        <td>M</td>

                                        <td>P</td>
                                        <td>S</td>
                                        <td>M</td>

                                        <td>P</td>
                                        <td>S</td>
                                        <td>M</td>

                                        <td>P</td>
                                        <td>S</td>
                                        <td>M</td>

                                        <td>P</td>
                                        <td>S</td>
                                        <td>M</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailItem as $keyQ => $item)
                                    @php
                                        $idx = $keyQ;
                                        $objAssest = clone $assesmentDetail;
                                        $oneData = $objAssest->where(['idx' => $idx,'jenis' => $keyItem])->first();
                                    @endphp
                                    <tr>
                                        @if ($keyQ == 0)
                                            <td style="transform: rotate(-90deg);" rowspan="{{count($detailItem)}}">{{$keyItem}}</td>
                                        @endif
                                        <td>
                                            {{$keyQ+1}}

                                            <input type="hidden" name="Parameter[{{$idx}}]" value="{{$item}}">
                                            <input type="hidden" name="Jenis[{{$idx}}]" value="{{$keyItem}}">
                                            <input type="hidden" name="Idx[]" value="{{$idx}}">
                                        </td>
                                        <td>{{$item}}</td>

                                        <td class="check">
                                            <input type="checkbox" {{ $oneData && $oneData->P1 == 1 ? 'checked' : ''}} name="P1[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" {{ $oneData && $oneData->S1 == 1 ? 'checked' : ''}} name="S1[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" {{ $oneData && $oneData->M1 == 1 ? 'checked' : ''}} name="M1[{{$keyQ}}]"  value="1">
                                        </td>

                                        <td class="check">
                                            <input type="checkbox" {{ $oneData && $oneData->P2 == 1 ? 'checked' : ''}} name="P2[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" {{ $oneData && $oneData->S2 == 1 ? 'checked' : ''}} name="S2[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" {{ $oneData && $oneData->M2 == 1 ? 'checked' : ''}} name="M2[{{$keyQ}}]"  value="1">
                                        </td>

                                        <td class="check">
                                            <input type="checkbox" {{ $oneData && $oneData->P2 == 1 ? 'checked' : ''}}name="P3[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" name="S3[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" name="M3[{{$keyQ}}]"  value="1">
                                        </td>

                                        <td class="check">
                                            <input type="checkbox" name="P4[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" name="S4[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" name="M4[{{$keyQ}}]"  value="1">
                                        </td>

                                        <td class="check">
                                            <input type="checkbox" name="P5[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" name="S5[{{$keyQ}}]"  value="1">
                                        </td>
                                        <td class="check">
                                            <input type="checkbox" name="M5[{{$keyQ}}]"  value="1">
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Tanda tangan dan nama petugas yang menilai</td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorP1 )
                                                @if ($oneDataDetail->user_verifikatorP1 && $oneDataDetail->user_verifikatorP1->hrd_employee && $oneDataDetail->user_verifikatorP1->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorP1->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorP1->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="P1"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorS1 )
                                                @if ($oneDataDetail->user_verifikatorS1 && $oneDataDetail->user_verifikatorS1->hrd_employee && $oneDataDetail->user_verifikatorS1->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorS1->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorS1->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="S1"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorM1 )
                                                @if ($oneDataDetail->user_verifikatorM1 && $oneDataDetail->user_verifikatorM1->hrd_employee && $oneDataDetail->user_verifikatorM1->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorM1->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorM1->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="M1"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorP2 )
                                                @if ($oneDataDetail->user_verifikatorP2 && $oneDataDetail->user_verifikatorP2->hrd_employee && $oneDataDetail->user_verifikatorP2->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorP2->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorP2->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="P2"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorS2 )
                                                @if ($oneDataDetail->user_verifikatorS2 && $oneDataDetail->user_verifikatorS2->hrd_employee && $oneDataDetail->user_verifikatorS2->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorS2->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorS2->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="S2"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorM2 )
                                                @if ($oneDataDetail->user_verifikatorM2 && $oneDataDetail->user_verifikatorM2->hrd_employee && $oneDataDetail->user_verifikatorM2->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorM2->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorM2->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="M2"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorP3 )
                                                @if ($oneDataDetail->user_verifikatorP3 && $oneDataDetail->user_verifikatorP3->hrd_employee && $oneDataDetail->user_verifikatorP3->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorP3->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorP3->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="P3"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorS3 )
                                                @if ($oneDataDetail->user_verifikatorS3 && $oneDataDetail->user_verifikatorS3->hrd_employee && $oneDataDetail->user_verifikatorS3->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorS3->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorS3->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="S3"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorM3 )
                                                @if ($oneDataDetail->user_verifikatorM3 && $oneDataDetail->user_verifikatorM3->hrd_employee && $oneDataDetail->user_verifikatorM3->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorM3->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorM3->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="M3"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorP4 )
                                                @if ($oneDataDetail->user_verifikatorP4 && $oneDataDetail->user_verifikatorP4->hrd_employee && $oneDataDetail->user_verifikatorP4->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorP4->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorP4->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="P4"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorS4 )
                                                @if ($oneDataDetail->user_verifikatorS4 && $oneDataDetail->user_verifikatorS4->hrd_employee && $oneDataDetail->user_verifikatorS4->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorS4->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorS4->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="S4"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorM4 )
                                                @if ($oneDataDetail->user_verifikatorM4 && $oneDataDetail->user_verifikatorM4->hrd_employee && $oneDataDetail->user_verifikatorM4->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorM4->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorM4->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="M4"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorP5 )
                                                @if ($oneDataDetail->user_verifikatorP5 && $oneDataDetail->user_verifikatorP5->hrd_employee && $oneDataDetail->user_verifikatorP5->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorP5->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorP5->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="P5"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorS5 )
                                                @if ($oneDataDetail->user_verifikatorS5 && $oneDataDetail->user_verifikatorS5->hrd_employee && $oneDataDetail->user_verifikatorS5->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorS5->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorS5->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="S5"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($oneDataDetail  && $oneDataDetail->verifikatorM5 )
                                                @if ($oneDataDetail->user_verifikatorM5 && $oneDataDetail->user_verifikatorM5->hrd_employee && $oneDataDetail->user_verifikatorM5->hrd_employee->ttd)
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $oneDataDetail->user_verifikatorM5->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                    <span class="text-small">{{$oneDataDetail->user_verifikatorM5->hrd_employee->nama}}</span>
                                                @else
                                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-primary m-0 btnVerifDetail" data-jenis="{{$keyItem}}" data-verif="M5"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p>*Keterangan: 1.Resiko rendah dilakukan monitoring 3 hari sekali, 2.Resiko sedang dan berat dilakukan monitoring perhari, 3.Jika sudah dimonitoring</p>
                            <div class="row mt-4">
                                <div class="col-md-12 ">
                                    <button type="submit" class=" btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <hr>
            @endforeach
        @endif

        <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formVerif" method="post" action="{{ url('e_rekam_medis/detail/verif_reassesment_resiko_jatuh') }}">
                        {{-- @csrf --}}
                        <input type="hidden" name="IsVerif" value="1">
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" name="verif" id="inputTipeVerifModal" value="1">
                        <input type="hidden" name="isDetail" id="inputIsDetail" value="0">
                        <input type="hidden" name="JenisDetail" id="inputJenisDetail" value="">
                        <input type="hidden" name="idx" id="inputIdxModal" value="1">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Password :</label>
                                <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        $(function() {

            $("#formVerif").submit(function (e) {
                e.preventDefault();

                var isDetail = $('#formVerif').find("#inputIsDetail").val();

                $('#formVerif :input').each(function() {

                    if( isDetail == "1" ){
                        if($(this).attr('name')){
                            $("#formInputDetail").append($(this));
                        }
                    }else{
                        if($(this).attr('name')){
                            $("#formInput").append($(this));
                        }
                    }

                });

                if(isDetail == "1"){

                    $("#formInputDetail").submit();

                }else{

                    $("#formInput").submit();

                }


            });

            calculateAll();
            function calculateAll() {
                var allScore = $('.inputScore');

                $.each(allScore, function (i, item) {
                    var idx = $(item).attr("data-idx");
                    var listScore = $('.inputScore[data-idx="'+idx+'"]');

                    var result = 0;
                    $.each(listScore, function (indexInArray, valueOfElement) {
                        var element = $(valueOfElement);
                        // console.log(element,result);
                        var selectedOption = element.find('option:selected');
                        if(selectedOption.val() == 1){
                            result = result + parseInt(element.attr("data-score"));
                        }else{

                        }

                    });

                    $("#totalSkor"+idx).val(result || 0);
                });
            }



            $(".inputScore").change(function (e) {
                e.preventDefault();

                var idx = $(this).attr("data-idx");

                var listScore = $('.inputScore[data-idx="'+idx+'"]');

                var result = 0;
                $.each(listScore, function (indexInArray, valueOfElement) {
                    var element = $(valueOfElement);
                    // console.log(element,result);
                    var selectedOption = element.find('option:selected');
                    if(selectedOption.val() == 1){
                        result = result + parseInt(element.attr("data-score"));
                    }else{

                    }

                });
                console.log(result);

                $("#totalSkor"+idx).val(result || 0);

                // console.log("asd",idx,listScore);
            });


            $(".btnVerif").click(function (e) {
                e.preventDefault();
                console.log("asd")

                $("#inputTipeVerifModal").val($(this).attr('data-verif'));
                $("#inputIsDetail").val(0);
                $("#inputJenisDetail").val($(this).attr('data-jenis'));
                $("#modal_petugas").modal().show();
            });

            $(".btnVerifDetail").click(function (e) {
                e.preventDefault();
                console.log("asd")

                $("#inputTipeVerifModal").val($(this).attr('data-verif'));
                $("#inputIsDetail").val(1);
                $("#inputJenisDetail").val($(this).attr('data-jenis'));
                $("#modal_petugas").modal().show();
            });



            $('#modal_petugas').on('hidden.bs.modal', function () {

                $("#inputTipeVerifModal").val(0);
                $("#inputIsDetail").val(0);
                $("#inputJenisDetail").val('');
                $("#inputIdxModal").val(0);
            })

            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY HH:mm'
                },
                useCurrent: false,
                autoUpdateInput: true,
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });

            $.each($('.datetimepicker'), function (indexInArray, valueOfElement) {
                if($(valueOfElement).attr("data-state") == 1){

                }else{
                    $(valueOfElement).val("");
                }
            });



            $('.datepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                useCurrent: false,
                autoUpdateInput: true,
                singleDatePicker: true,
                timePicker: false,
                timePicker24Hour: false,
            });

            $.each($('.datepicker'), function (indexInArray, valueOfElement) {
                if($(valueOfElement).attr("data-state") == 1){

                }else{
                    $(valueOfElement).val("");
                }
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
        });
    </script>
    </body>
</html>
