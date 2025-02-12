<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Pemantauan Tanda-Tanda Vital</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <style>
        .border {
            border: 1px solid black !important;
        }

        .table.table-bordered td,
        .table.table-bordered th {
            border: 1px solid black !important;
        }

        .input-dotted {
            border: none !important;
            border-bottom: 1px dotted black !important;
        }

        .col-input {
            width: 64px;
        }

        .bg-green {
            background-color: greenyellow;
        }

        .bg-red {
            background-color: red;
        }

        .bg-blue {
            background-color: cyan;
        }

        #customTable {
            border-collapse: collapse;
        }

        #customTable td {
            width: 50px;
            height: 50px;
            border: 1px solid black;
            text-align: center;
        }

        .line {
            position: absolute;
            border: 1px solid black;
        }

        .dataTables_wrapper {
            margin-top: 2rem;
        }
    </style>
</head>

<body class="p-2">
    <div class="w-100 text-right">MR 02.17.001.Rev.1</div>

    <table class="w-100">
        <tr>
            <td class="p-1 align-top" style="width: 50%;">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
            </td>
            <td></td>
            <td class="align-top" style="width: 45%;font-size: .7rem;">
                <div class="px-2 py-1 w-100" style="border: 1px solid black;border-radius: 10px;">
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
            </td>
        </tr>
    </table>

    <table class="w-100" style="font-size: 0.8rem;">
        <tr>
            <td class="border table-secondary font-weight-bold text-uppercase text-center" colspan="24">Pemantauan Tanda-Tanda Vital</td>
        </tr>
        <tr>
            <td class="border" colspan="4">Tanggal</td>
            @for($i=0;$i<=4;$i++) <td class="border p-0 text-center" colspan="4">{{ isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : '' }}</td>
                @endfor
        </tr>
        <tr>
            <td class="border" colspan="4">Ruang Rawat</td>
            @for($i=0;$i<=4;$i++) <td class="border p-0 text-center" colspan="4">{{ isset($tanggal[$i]) ? $tanggal[$i]['ruang_rawat'] : '' }}</td>
                @endfor
        </tr>
        <tr>
            <td class="border" colspan="4">Paraf Petugas</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-middle bg-green">RR</td>
            <td class="border text-center align-middle bg-red">N</td>
            <td class="border text-center align-middle bg-blue">S</td>
            <td class="border text-center align-middle">TD</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle" style="width:25px;">{{ Str::substr($waktu, 0, 1) }}</td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green" rowspan="7"></td>
            <td class="border text-center align-bottom bg-red">172</td>
            <td class="border text-center align-bottom bg-blue" rowspan="2">41</td>
            <td class="border text-center align-bottom">200</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 172) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'suhu', 41) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 200) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 200) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-red">160</td>
            <td class="border text-center align-bottom">190</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 160) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 190) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 190) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-red">144</td>
            <td class="border text-center align-bottom bg-blue" rowspan="2">40</td>
            <td class="border text-center align-bottom">180</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 144) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'suhu', 40) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 180) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 180) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-red">132</td>
            <td class="border text-center align-bottom">170</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 132) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 170) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 170) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-red">120</td>
            <td class="border text-center align-bottom bg-blue" rowspan="4">39</td>
            <td class="border text-center align-bottom">160</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 120) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'suhu', 39) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 160) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 160) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-red">112</td>
            <td class="border text-center align-bottom">150</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 112) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 150) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 150) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-red">104</td>
            <td class="border text-center align-bottom">140</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 104) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 140) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 140) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">52</td>
            <td class="border text-center align-bottom bg-red">100</td>
            <td class="border text-center align-bottom">130</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 52) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 100) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 130) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 130) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">48</td>
            <td class="border text-center align-bottom bg-red">96</td>
            <td class="border text-center align-bottom bg-blue" rowspan="4">38</td>
            <td class="border text-center align-bottom">120</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 48) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 96) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'suhu', 38) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 120) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 120) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">44</td>
            <td class="border text-center align-bottom bg-red">92</td>
            <td class="border text-center align-bottom">110</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 44) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 92) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 110) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 110) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">40</td>
            <td class="border text-center align-bottom bg-red">88</td>
            <td class="border text-center align-bottom">100</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 40) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 88) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 100) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 100) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">36</td>
            <td class="border text-center align-bottom bg-red">84</td>
            <td class="border text-center align-bottom">90</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 36) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 84) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 90) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 90) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">32</td>
            <td class="border text-center align-bottom bg-red">80</td>
            <td class="border text-center align-bottom bg-blue" rowspan="4">37</td>
            <td class="border text-center align-bottom">80</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 32) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 80) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'suhu', 37) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 80) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 80) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">28</td>
            <td class="border text-center align-bottom bg-red">76</td>
            <td class="border text-center align-bottom">70</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 28) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 76) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 70) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 70) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">24</td>
            <td class="border text-center align-bottom bg-red">72</td>
            <td class="border text-center align-bottom">60</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 24) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 72) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 60) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 60) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">20</td>
            <td class="border text-center align-bottom bg-red">68</td>
            <td class="border text-center align-bottom">50</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 20) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 68) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 50) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 50) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">16</td>
            <td class="border text-center align-bottom bg-red">64</td>
            <td class="border text-center align-bottom bg-blue" rowspan="4">36</td>
            <td class="border text-center align-bottom">40</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 16) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 64) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'suhu', 36) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 40) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 40) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">12</td>
            <td class="border text-center align-bottom bg-red">60</td>
            <td class="border text-center align-bottom">30</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 12) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 60) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 30) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 30) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">8</td>
            <td class="border text-center align-bottom bg-red">56</td>
            <td class="border text-center align-bottom">20</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 8) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 56) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 20) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 20) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green">4</td>
            <td class="border text-center align-bottom bg-red">52</td>
            <td class="border text-center align-bottom">10</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <!-- {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'pernafasan', 4) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'nadi', 52) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'sistol', 10) : '' !!}
                {!! isset($tanggal[$i]) ? $checkmark($tanggal[$i]['tanggal'], $waktu, 'diastol', 10) : '' !!} -->
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border" colspan="4">Berat Badan (BB)</td>
            <td class="border" colspan="20">{{ $data->berat_badan }}</td>
        </tr>
        <tr>
            <td class="border" colspan="4">Tinggi Badan (TB)</td>
            <td class="border" colspan="20">{{ $data->tinggi_badan }}</td>
        </tr>
        <tr>
            <td class="border" colspan="4">Lingkar Kepala (LK)</td>
            <td class="border" colspan="20">{{ $data->lingkar_kepala }}</td>
        </tr>
        <tr>
            <td class="p-0" colspan="24">
                <table class="w-100">
                    <tr>
                        <td class="border py-2 px-4" style="width: 50%;border-top: none !important;">
                            Kode Gambar:
                            <ol>
                                <li>RR : Pernafasan (x)</li>
                                <li>N : Nadi (&bull;)</li>
                                <li>S : Suhu (&deg;)</li>
                                <li>Sistol : (<sub>v</sub>)</li>
                                <li>Diatol : (^)</li>
                            </ol>
                        </td>
                        <td class="border py-2 px-4" style="width: 50%;border-top: none !important;">
                            Penggunaan Tinta Warna:
                            <ol>
                                <li>Tekanan Darah : Hitam</li>
                                <li>Nadi : Merah</li>
                                <li>Suhu : Biru</li>
                                <li>Pernafasan : Hijau</li>
                            </ol>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div>
        <?php
        $diastol = [];
        $nadi = [];
        $suhu = [];
        $rr = [];

        $checklist = null;

        if ($data) {
            $checklist = $data->checklist;
        }
        if (!is_null($checklist)) {
            for ($i = 0; $i < 20; $i++) {
                if(isset($checklist[$i])){
                    $diastol[$i] =  (int) $checklist[$i]['diastol'] ;
                }
                if(isset($checklist[$i])){
                    $nadi[$i] =  (int) $checklist[$i]['nadi'] ;
                }
                if(isset($checklist[$i])){
                    $suhu[$i] =  (int) $checklist[$i]['suhu'] ;
                }
                if(isset($checklist[$i])){
                    $rr[$i] =  (int) $checklist[$i]['pernafasan'] ;
                }
            }
        }
        //[10,50,30,80,100,90,10,50,30,80,100,90,10,50,30,80,100,90,10,50]
        // dd($diastol);

        $chartConfig = "{type:'line', options:{maintainAspectRatio: false, legend: { display: false },scales:{yAxes:[{display:false,gridLines: { display: false },ticks: {min: 0, max:210, stepSize:10, fontSize:7,display: false, backdropPadding : 0}}],xAxes:[{display:false,gridLines: { display: false },ticks: { display: false, padding : 0, maxTicksLimit: 20}}]}},data:{labels:['P','S','M','M','P','S','M','M','P','S','M','M','P','S','M','M','P','S','M','M'],datasets:[{backgroundColor:'red',borderColor:'red',data:".json_encode($nadi).",label:'',fill:'red',borderWidth:1,pointRadius: 1},{backgroundColor:'blue',borderColor:'blue',data:".json_encode($suhu).",label:'',fill:'blue',borderWidth:1,pointRadius: 1},{backgroundColor:'green',borderColor:'green',data:".json_encode($rr).",label:'',fill:'green',borderWidth:1,pointRadius: 1},{backgroundColor:'black',borderColor:'black',data:".json_encode($diastol).",label:'',fill:'black',borderWidth:1,pointRadius: 1}]}}";
        $chartUrl = 'https://image-charts.com/chart.js/2.8.0?width=250&height=240&bkg=white&c=' . urlencode($chartConfig);
        ?>
        <div style="background-color: transparent; width:100%">
            <img style="opacity: 0.5; filter: alpha(opacity=10); mix-blend-mode: multiply; color:transparent; border:1px solid transparent; position: absolute; top:199; left:140;" src="{{$chartUrl}}" />
        </div>
    </div>
</body>

</html>