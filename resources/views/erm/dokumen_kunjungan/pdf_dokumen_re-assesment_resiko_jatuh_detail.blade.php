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

        .table-basic input[type:text]{
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
    <h6>MONITORIN RESIKO JATUH</h6>
    <hr>
    @if ($detailAssesment)
        @foreach ($detailAssesment as $keyItem => $detailItem)
            <div class="container-fluid">
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
                                        TGL: {{ $oneDataDetail && $oneDataDetail->TanggalJam1 ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam1)->format('d/m/Y') : '' }}
                                    </td>
                                    <td colspan="3" style="width: 6%;" class="cel-date">
                                        TGL: {{ $oneDataDetail && $oneDataDetail->TanggalJam2 ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam2)->format('d/m/Y') : '' }}
                                    </td>
                                    <td colspan="3" style="width: 6%;" class="cel-date">
                                        TGL : {{ $oneDataDetail && $oneDataDetail->TanggalJam3 ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam3)->format('d/m/Y') : '' }}
                                    </td>
                                    <td colspan="3" style="width: 6%;" class="cel-date">
                                        TGL : {{ $oneDataDetail && $oneDataDetail->TanggalJam4 ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam4)->format('d/m/Y') : '' }}
                                    </td>
                                    <td colspan="3" style="width: 6%;" class="cel-date">
                                        TGL : {{ $oneDataDetail && $oneDataDetail->TanggalJam5 ? Illuminate\Support\Carbon::parse($oneDataDetail->TanggalJam5)->format('d/m/Y') : '' }}
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
                                        <td style="" rowspan="{{count($detailItem)}}">{{$keyItem}}</td>
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
                                        @endif
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <p>*Keterangan: 1.Resiko rendah dilakukan monitoring 3 hari sekali, 2.Resiko sedang dan berat dilakukan monitoring perhari, 3.Jika sudah dimonitoring</p>
                    </form>
                </div>

            </div>
            <hr>
        @endforeach
    @endif
</body>

</html>
