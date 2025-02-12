<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        @page {
            margin: 1.27cm;
        }

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

        #tabel_hpp tr th {
            border: 1px solid;
        }

        #tabel_hpp tr td {
            border: 1px solid;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="row" style="margin-left: 0;">
        <div style="width:50%; float:left;">
            <table>
                <tr>
                    <th>No. RM</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>{{$pasien->nrm}}</th>
                </tr>
                <tr>
                    <th>No. Reg</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>{{$pasien->id}}</th>
                </tr>
                <tr>
                    <th>Nama Pasien</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>{{$pasien->nama_pasien}}</th>
                </tr>
                <tr>
                    <th>Jenis Pasien</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>
                        @if($pasien->carabayar == 'bpjs' || $pasien->carabayar == 'asuransi')
                        {{$pasien->asuransi }}
                        @elseif($pasien->carabayar == 'perusahaan')
                        {{$pasien->carabayar.' - '.$pasien->nama_perusahaan }}
                        @else
                        {{'UMUM'}}
                        @endif
                    </th>
                </tr>
            </table>
        </div>
        <div style="width:50%; float:left;">
            <table>
                <tr>
                    <th>Tgl. MRS</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>@if($pasien->tanggal_inap != '0000-00-00 00:00:00'){{ date('d-m-Y', strtotime($pasien->tanggal_inap)) }}@endif</th>
                </tr>
                <tr>
                    <th>Tgl. KRS</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>@if($pasien->tanggal_pulang != '0000-00-00 00:00:00'){{ date('d-m-Y', strtotime($pasien->tanggal_pulang)) }}@endif</th>
                </tr>
                <tr>
                    <th>Lawa Dirawat</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>{{$pasien->lama_dirawat+1}}</th>
                </tr>
                <tr>
                    <th>Ruangan Terakhir</th>
                    <th style="padding-left: 15px; padding-right: 15px;"> : </th>
                    <th>{{$pasien->last_nama_ruangan}}</th>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-left: 0; margin-top: 20px;">
        <div style="width:100%; float:left;">
            <table style="border-collapse: collapse; width:95%;" id="tabel_hpp">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama Tagihan</th>
                        <th>Qty</th>
                        <th>Harga Jual</th>
                        <th>HPP</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = 0; $total_hpp = 0;
                    @endphp
                    @if(sizeof($pasien->hpp) < 1) <tr style="text-align: center;">
                        <td colspan="5">Tidak ada data.</td>
                        </tr>
                        @else
                        @foreach($pasien->hpp as $h)
                        <tr>
                            <td style="text-align: center;">{{$loop->iteration}}</td>
                            <td>{{$h->nama_tagihan}}</td>
                            <td style="text-align: center;">{{$h->quantity}}</td>
                            <td style="text-align: right;">{{ number_format($h->total,0, ',', '.') }}</td>
                            <td style="text-align: right;">{{ number_format($h->hpp,0, ',', '.') }}</td>
                        </tr>
                        @php
                        $total += $h->total;
                        $total_hpp += $h->hpp;
                        @endphp
                        @endforeach
                        @endif
                        <tr>
                            <td style="text-align: center;" colspan="3">Total</td>
                            <td style="text-align: right;">{{ number_format($total,0, ',', '.') }}</td>
                            <td style="text-align: right;">{{ number_format($total_hpp,0, ',', '.') }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>