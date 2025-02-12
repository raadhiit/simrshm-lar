<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Daftar Tilik Pasien Operasi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <style>
        .table-basic{
            width: 100%;
            border: 1px;
            font-size: 10px;
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
            /* width: 1rem; */
            width: 100%;
            min-width: 5rem;
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

<body>
    <table class="" style="width: 100%;">
        <tr>
            <td class="p-1 align-top" style="width: 47.5%;border: 1px solid black;">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
            </td>
            <td style="width: 5%;"></td>
            <td class="p-1 align-top" style="width: 47.5%;border: 1px solid black;">
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
            </td>
        </tr>
    </table>
    <br>
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
                <td rowspan="2" style="width: 48%;">PARAMETER</td>
                <td rowspan="2" style="width: 5%;">SKOR</td>
                <td colspan="6" style="width: 20%;">Tanggal dan Jam</td>
            </tr>
            <tr>
                <td class="cel-date"> {{ $detail && $detail->TanggalJam1 ? Illuminate\Support\Carbon::parse($detail->TanggalJam1)->format('d/m/Y H:i') : '' }} </td>
                <td class="cel-date"> {{ $detail && $detail->TanggalJam2 ? Illuminate\Support\Carbon::parse($detail->TanggalJam2)->format('d/m/Y H:i') : '' }} </td>
                <td class="cel-date"> {{ $detail && $detail->TanggalJam3 ? Illuminate\Support\Carbon::parse($detail->TanggalJam3)->format('d/m/Y H:i') : '' }} </td>
                <td class="cel-date"> {{ $detail && $detail->TanggalJam4 ? Illuminate\Support\Carbon::parse($detail->TanggalJam4)->format('d/m/Y H:i') : '' }}</td>
                <td class="cel-date"> {{ $detail && $detail->TanggalJam5 ? Illuminate\Support\Carbon::parse($detail->TanggalJam5)->format('d/m/Y H:i') : '' }} </td>
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
                $arrTotal = [
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                    5 => 0,
                ];
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
                                @php
                                    $arrTotal[1] = ($oneData && $oneData->Score1 == 1) ? $arrTotal[1] + $item["Skor"] : $arrTotal[1] + 0;
                                @endphp
                                {{ $oneData && $oneData->Score1 == 1 ? 'Ya' : 'Tidak'}}
                            </td>
                            <td class="cel-date">
                                @php
                                    $arrTotal[2] = ($oneData && $oneData->Score2 == 1) ? $arrTotal[2] + $item["Skor"] : $arrTotal[2] + 0;
                                @endphp
                                {{ $oneData && $oneData->Score2 == 1 ? 'Ya' : 'Tidak'}}
                            </td>
                            <td class="cel-date">
                                @php
                                    $arrTotal[3] = ($oneData && $oneData->Score3 == 1) ? $arrTotal[3] + $item["Skor"] : $arrTotal[3] + 0;
                                @endphp
                                {{ $oneData && $oneData->Score3 == 1 ? 'Ya' : 'Tidak'}}
                            </td>
                            <td class="cel-date">
                                @php
                                    $arrTotal[4] = ($oneData && $oneData->Score4 == 1) ? $arrTotal[4] + $item["Skor"] : $arrTotal[4] + 0;
                                @endphp
                                {{ $oneData && $oneData->Score4 == 1 ? 'Ya' : 'Tidak'}}
                            </td>
                            <td class="cel-date">
                                @php
                                    $arrTotal[5] = ($oneData && $oneData->Score5 == 1) ? $arrTotal[5] + $item["Skor"] : $arrTotal[5] + 0;
                                @endphp
                                {{ $oneData && $oneData->Score5 == 1 ? 'Ya' : 'Tidak'}}
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
                    <input type="text" name="TotalScore1" class="totalScore" id="totalSkor1" value="{{$arrTotal[1]}}" readonly>
                </td>
                <td class="cel-date">
                    <input type="text" name="TotalScore2" class="totalScore" id="totalSkor2" value="{{$arrTotal[2]}}" readonly>
                </td>
                <td class="cel-date">
                    <input type="text" name="TotalScore3" class="totalScore" id="totalSkor3" value="{{$arrTotal[3]}}" readonly>
                </td>
                <td class="cel-date">
                    <input type="text" name="TotalScore4" class="totalScore" id="totalSkor4" value="{{$arrTotal[4]}}" readonly>
                </td>
                <td class="cel-date">
                    <input type="text" name="TotalScore5" class="totalScore" id="totalSkor5" value="{{$arrTotal[5]}}" readonly>
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
                    {{-- <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="1">Verifikasi</button> --}}
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
                    {{-- <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="2">Verifikasi</button> --}}
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
                    {{-- <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="3">Verifikasi</button> --}}
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
                    {{-- <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="4">Verifikasi</button> --}}
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
                    {{-- <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="5">Verifikasi</button> --}}
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
    <br>
</body>

</html>
