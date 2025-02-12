<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Pemantauan Tanda-Tanda Vital</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <style>
        @media print{
            #table-detail{
                display: none;
            }
        }

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
            <td class="p-1 align-top" style="width: 400px;">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
            </td>
            <td></td>
            <td class="align-top" style="width: 400px;">
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

    @if($errors->any())
    <script>
        <?php foreach ($errors->all() as $error){ ?>
        toastr.error('<?php echo $error ?>')
        <?php } ?>
    </script>
    <!-- <div class="my-2 alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul class="p-0 m-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> -->
    @endif

    @if(session()->has('message'))
    <script>
        toastr.success("{!! session('message') !!}");
    </script>
    <!-- <div class="my-2 alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('message') !!}
    </div> -->
    @endif

    <table class="w-100">
        <tr>
            <td class="border table-secondary font-weight-bold text-uppercase text-center" colspan="24">Pemantauan Tanda-Tanda Vital</td>
        </tr>
        <tr>
            <td class="border" colspan="4">Tanggal</td>
            @for($i=0;$i<=4;$i++) <td class="border p-0" colspan="4"><input type="text" name="tanggal[{{ $i }}]" class="datepick text-center input-dotted rounded-0 w-100" value="{{ isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : '' }}" /></td>
                @endfor
        </tr>
        <tr>
            <td class="border" colspan="4">Ruang Rawat</td>
            @for($i=0;$i<=4;$i++) <td class="border p-0" colspan="4">
                <select name="ruang_rawat[{{ $i }}]" class="select2 w-100 rounded-0">
                    <option disabled selected></option>
                    @foreach($ruangan as $ruang)
                    <option value="{{ $ruang }}" {{ isset($tanggal[$i]) && $tanggal[$i]['ruang_rawat'] == $ruang ? 'selected' : '' }}>{{ $ruang }}</option>
                    @endforeach
                </select>
                </td>
                @endfor
        </tr>
        <tr>
            <td class="border" colspan="4">Paraf Petugas</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">
                <button type="button" class="py-0 btn btn-outline-secondary btn-sm btn-edit" data-colindex="{{ $i }}" data-waktu="{{ $waktu }}" data-tanggal="{{ isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : '' }}" data-nadi="{{ $getValue((isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : null), $waktu, 'nadi') }}" data-suhu="{{ $getValue((isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : null), $waktu, 'suhu') }}" data-sistol="{{ $getValue((isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : null), $waktu, 'sistol') }}" data-diastol="{{ $getValue((isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : null), $waktu, 'diastol') }}" data-pernafasan="{{ $getValue((isset($tanggal[$i]) ? $tanggal[$i]['tanggal'] : null), $waktu, 'pernafasan') }}">
                    <i class="fa fa-edit"></i>
                </button>
                </td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-middle bg-green">RR</td>
            <td class="border text-center align-middle bg-red">N</td>
            <td class="border text-center align-middle bg-blue">S</td>
            <td class="border text-center align-middle">TD</td>
            @for($i=0;$i<=4;$i++) @foreach(['Pagi', 'Siang' , 'Malam' , 'Midnight' ] as $waktu) <td class="border p-0 text-center align-middle">{{ Str::substr($waktu, 0, 1) }}</td>
                @endforeach
                @endfor
        </tr>
        <tr>
            <td class="border text-center align-bottom bg-green" rowspan="7"></td>
            <td class="border text-center align-bottom bg-red">128</td>
            <td class="border text-center align-bottom bg-blue" rowspan="4">40</td>
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
            <td class="border text-center align-bottom bg-red">124</td>
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
            <td class="border text-center align-bottom bg-red">120</td>
            <!-- <td class="border text-center align-bottom bg-blue" rowspan="2">40</td> -->
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
            <td class="border text-center align-bottom bg-red">116</td>
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
            <td class="border text-center align-bottom bg-red">112</td>
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
            <td class="border text-center align-bottom bg-red">108</td>
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
            <td class="border" colspan="20"><input type="text" class="input-bawah input-dotted w-100 rounded-0" id="BB" name="BB" value="{{ $data->berat_badan }}" /></td>
        </tr>
        <tr>
            <td class="border" colspan="4">Tinggi Badan (TB)</td>
            <td class="border" colspan="20"><input type="text" class="input-bawah input-dotted w-100 rounded-0" id="TB" name="TB" value="{{ $data->tinggi_badan }}" /></td>
        </tr>
        <tr>
            <td class="border" colspan="4">Lingkar Kepala (LK)</td>
            <td class="border" colspan="20"><input type="text" class="input-bawah input-dotted w-100 rounded-0" id="LK" name="LK" value="{{ $data->lingkar_kepala }}" /></td>
        </tr>
        <tr>
            <td class="p-0" colspan="24">
                <table style="margin-left: -1px; width:100.1%;">
                    <tr>
                        <td class="border py-2 px-4" style="width: 50%; border-top: none !important;">
                            Kode Gambar:
                            <ol>
                                <li>RR : Pernafasan (x)</li>
                                <li>N : Nadi (&bull;)</li>
                                <li>S : Suhu (&deg;)</li>
                                <li>Sistol : (<sub>v</sub>)</li>
                                <li>Diatol : (^)</li>
                            </ol>
                        </td>
                        <td class="border py-2 px-4" style="width: 50%; border-top: none !important;">
                            Penggunaan Tinta Warna:
                            <ol>
                                <li>Tekanan Darah (Sistol) : Hitam</li>
                                <li>Tekanan Darah (Diastol) : Abu-Abu</li>
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
    <div id="box_canvas_sistole">
        <canvas id="chart" style="height:100%; width:98%; border:1px solid transparent;"></canvas>
    </div>
    
    <div id="box_canvas_diastole">
        <canvas id="chart_diastol" style="height:100%; width:98%; border:1px solid transparent;"></canvas>
    </div>

    <div id="box_canvas_rr">
        <canvas id="chart_rr" style="height:100%; width:98%; border:1px solid transparent;"></canvas>
    </div>

    <div id="box_canvas_nadi">
        <canvas id="chart_nadi" style="height:100%; width:98%; border:1px solid transparent;"></canvas>
    </div>

    <div id="box_canvas_suhu">
        <canvas id="chart_suhu" style="height:100%; width:98%; border:1px solid transparent;"></canvas>
    </div>

    <script>
        if (window.screen.width == 1366) {
            document.getElementById('box_canvas_sistole').style.width = '85%';
            document.getElementById('box_canvas_sistole').style.height = '540px';
            document.getElementById('box_canvas_sistole').style.position = 'absolute';
            document.getElementById('box_canvas_sistole').style.top = '325px';
            document.getElementById('box_canvas_sistole').style.left = '200px';

            document.getElementById('box_canvas_diastole').style.width = '85%';
            document.getElementById('box_canvas_diastole').style.height = '540px';
            document.getElementById('box_canvas_diastole').style.position = 'absolute';
            document.getElementById('box_canvas_diastole').style.top = '321px';
            document.getElementById('box_canvas_diastole').style.left = '200px';

            document.getElementById('box_canvas_rr').style.width = '85%';
            document.getElementById('box_canvas_rr').style.height = '353px';
            document.getElementById('box_canvas_rr').style.position = 'absolute';
            document.getElementById('box_canvas_rr').style.top = '513px';
            document.getElementById('box_canvas_rr').style.left = '200px';

            document.getElementById('box_canvas_nadi').style.width = '85%';
            document.getElementById('box_canvas_nadi').style.height = '542px';
            document.getElementById('box_canvas_nadi').style.position = 'absolute';
            document.getElementById('box_canvas_nadi').style.top = '324px';
            document.getElementById('box_canvas_nadi').style.left = '200px';

            document.getElementById('box_canvas_suhu').style.width = '85%';
            document.getElementById('box_canvas_suhu').style.height = '460px';
            document.getElementById('box_canvas_suhu').style.position = 'absolute';
            document.getElementById('box_canvas_suhu').style.top = '402px';
            document.getElementById('box_canvas_suhu').style.left = '200px';
        }else if (window.screen.width == 1920) {
            document.getElementById('box_canvas_sistole').style.width = '85%';
            document.getElementById('box_canvas_sistole').style.height = '540px';
            document.getElementById('box_canvas_sistole').style.position = 'absolute';
            document.getElementById('box_canvas_sistole').style.top = '325px';
            document.getElementById('box_canvas_sistole').style.left = '280px';

            document.getElementById('box_canvas_diastole').style.width = '85%';
            document.getElementById('box_canvas_diastole').style.height = '540px';
            document.getElementById('box_canvas_diastole').style.position = 'absolute';
            document.getElementById('box_canvas_diastole').style.top = '321px';
            document.getElementById('box_canvas_diastole').style.left = '280px';

            document.getElementById('box_canvas_rr').style.width = '85%';
            document.getElementById('box_canvas_rr').style.height = '353px';
            document.getElementById('box_canvas_rr').style.position = 'absolute';
            document.getElementById('box_canvas_rr').style.top = '513px';
            document.getElementById('box_canvas_rr').style.left = '280px';

            document.getElementById('box_canvas_nadi').style.width = '85%';
            document.getElementById('box_canvas_nadi').style.height = '542px';
            document.getElementById('box_canvas_nadi').style.position = 'absolute';
            document.getElementById('box_canvas_nadi').style.top = '324px';
            document.getElementById('box_canvas_nadi').style.left = '280px';

            document.getElementById('box_canvas_suhu').style.width = '85%';
            document.getElementById('box_canvas_suhu').style.height = '460px';
            document.getElementById('box_canvas_suhu').style.position = 'absolute';
            document.getElementById('box_canvas_suhu').style.top = '402px';
            document.getElementById('box_canvas_suhu').style.left = '280px';
        }
        
    </script>

    <table id="table-detail" class="table table-bordered table-striped table-hover w-100">
        <thead>
            <tr>
                <th>Operator</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Pernafasan (x/menit)</th>
                <th>Nadi (x/menit)</th>
                <th>Suhu (&deg;C)</th>
                <th>Sistol (mmHg)</th>
                <th>Diastol (mmHg)</th>
            </tr>
        </thead>
        <tbody>
            @if($data && $data->checklist && is_array($data->checklist))
            @foreach($data->checklist as $row)
            <tr>
                <td>{{ $row['operator'] }}</td>
                <td>{{ $row['tanggal'] }}</td>
                <td>{{ $row['waktu'] }}</td>
                <td>{{ $row['pernafasan'] }}</td>
                <td>{{ $row['nadi'] }}</td>
                <td>{{ $row['suhu'] }}</td>
                <td>{{ $row['sistol'] }}</td>
                <td>{{ $row['diastol'] }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form method="post" class="modal-content" autocomplete="off" onsubmit="return confirm('Apakah Anda yakin?')">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tanda-Tanda Vital</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="tanggal" class="col-form-label col-4">Tanggal</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="tanggal" name="tanggal" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ruang_rawat" class="col-form-label col-4">Ruang Rawat</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="ruang_rawat" name="ruang_rawat" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu" class="col-form-label col-4">Waktu</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="waktu" name="waktu" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="operator" class="col-form-label col-4">Operator</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="operator" name="operator" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pernafasan" class="col-form-label col-4">Pernafasan (x/menit)</label>
                        <div class="col-8">
                            <input type="number" step="0.01" class="form-control" id="pernafasan" name="pernafasan" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nadi" class="col-form-label col-4">Nadi (x/menit)</label>
                        <div class="col-8">
                            <input type="number" step="0.01" class="form-control" id="nadi" name="nadi" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="suhu" class="col-form-label col-4">Suhu (&deg;C)</label>
                        <div class="col-8">
                            <input type="number" step="0.01" class="form-control" id="suhu" name="suhu" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sistol" class="col-form-label col-4">Sistol (mmHg)</label>
                        <div class="col-8">
                            <input type="number" step="0.01" class="form-control" id="sistol" name="sistol" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diastol" class="col-form-label col-4">Diastol (mmHg)</label>
                        <div class="col-8">
                            <input type="number" step="0.01" class="form-control" id="diastol" name="diastol" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart');
        const ctx_diastol = document.getElementById('chart_diastol');
        const ctx_rr = document.getElementById('chart_rr');
        const ctx_nadi = document.getElementById('chart_nadi');
        const ctx_suhu = document.getElementById('chart_suhu');

        let sistol = ['', '', '', '', '','', '', '', '', '','', '', '', '', '','', '', '', '', ''];
        let diastol = ['', '', '', '', '','', '', '', '', '','', '', '', '', '','', '', '', '', ''];
        let nadi = ['', '', '', '', '','', '', '', '', '','', '', '', '', '','', '', '', '', ''];
        let suhu = ['', '', '', '', '','', '', '', '', '','', '', '', '', '','', '', '', '', ''];
        let rr = ['', '', '', '', '','', '', '', '', '','', '', '', '', '','', '', '', '', ''];
        let chart_iteration = 0;

        <?php if ($data) {
            $checklist = $data->checklist;
        }
        if (!is_null($checklist)) {
            for ($i = 0; $i < 20; $i++) {
        ?>
                sistol[chart_iteration] = parseInt("{{ isset($checklist[$i]) ? (int) $checklist[$i]['sistol'] : '' }}");
                diastol[chart_iteration] = parseInt("{{ isset($checklist[$i]) ? (int) $checklist[$i]['diastol'] : '' }}");
                nadi[chart_iteration] = parseInt("{{ isset($checklist[$i]) ? (int) $checklist[$i]['nadi'] : '' }}");
                suhu[chart_iteration] = parseInt("{{ isset($checklist[$i]) ? (int) $checklist[$i]['suhu'] : '' }}");
                rr[chart_iteration] = parseInt("{{ isset($checklist[$i]) ? (int) $checklist[$i]['pernafasan'] : '' }}");
                chart_iteration++;
        <?php
            }
        }
        ?>

        new Chart(ctx, {
            type: 'line',
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display:false,
                        title: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display:false,
                        title: {
                            display: false,
                        },
                        grid: {
                            display: false
                        },
                        min: 10,
                        max: 200,
                        ticks: {
                            stepSize: 10,
                            display: false,
                            font: {
                                size: 14
                            }
                        },
                        afterFit: function(scale) {
                            scale.marginBottom = 400 //<-- set value as you wish 
                        },
                    }
                }
            },
            data: {
                labels: ['P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M'],
                datasets: [
                {
                    backgroundColor: 'black',
                    borderColor: 'black',
                    data: sistol,
                    label: '',
                    fill: 'black',
                    borderWidth: 1,
                    pointRadius: 5
                }]
            }
        });

        new Chart(ctx_diastol, {
            type: 'line',
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display:false,
                        title: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display:false,
                        title: {
                            display: false,
                        },
                        grid: {
                            display: false
                        },
                        min: 10,
                        max: 200,
                        ticks: {
                            stepSize: 10,
                            display: false,
                            font: {
                                size: 14
                            }
                        },
                        afterFit: function(scale) {
                            scale.marginBottom = 400 //<-- set value as you wish 
                        },
                    }
                }
            },
            data: {
                labels: ['P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M'],
                datasets: [
                {
                    backgroundColor: 'grey',
                    borderColor: 'grey',
                    data: diastol,
                    label: '',
                    fill: 'grey',
                    borderWidth: 1,
                    pointRadius: 5
                }]
            }
        });

        new Chart(ctx_rr, {
            type: 'line',
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display:false,
                        title: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display:false,
                        title: {
                            display: false,
                        },
                        grid: {
                            display: false
                        },
                        min: 4,
                        max: 52,
                        ticks: {
                            stepSize: 4,
                            display: false,
                            font: {
                                size: 18
                            }
                        },
                        afterFit: function(scale) {
                            scale.marginBottom = 400 //<-- set value as you wish 
                        },
                    }
                }
            },
            data: {
                labels: ['P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M'],
                datasets: [{
                    backgroundColor: '#ADFF2F',
                    borderColor: '#ADFF2F',
                    data: rr,
                    label: '',
                    fill: '#ADFF2F',
                    borderWidth: 1,
                    pointRadius: 5
                }]
            }
        });

        new Chart(ctx_nadi, {
            type: 'line',
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display:false,
                        title: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display:false,
                        title: {
                            display: false,
                        },
                        grid: {
                            display: false
                        },
                        min: 128,
                        max: 52,
                        ticks: {
                            stepSize: 4,
                            display: false,
                            font: {
                                size: 18
                            }
                        },
                        afterFit: function(scale) {
                            scale.marginBottom = 400 //<-- set value as you wish 
                        },
                    }
                }
            },
            data: {
                labels: ['P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M'],
                datasets: [{
                    backgroundColor: 'red',
                    borderColor: 'red',
                    data: nadi,
                    label: '',
                    fill: 'red',
                    borderWidth: 1,
                    pointRadius: 5
                }]
            }
        });

        new Chart(ctx_suhu, {
            type: 'line',
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display:false,
                        title: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display:false,
                        title: {
                            display: false,
                        },
                        grid: {
                            display: false
                        },
                        min: 36,
                        max: 40,
                        ticks: {
                            stepSize: 1,
                            display: false,
                            font: {
                                size: 18
                            }
                        },
                        afterFit: function(scale) {
                            scale.marginBottom = 400 //<-- set value as you wish 
                        },
                    }
                }
            },
            data: {
                labels: ['P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M', 'P', 'S', 'M', 'M'],
                datasets: [{
                    backgroundColor: 'cyan',
                    borderColor: 'cyan',
                    data: suhu,
                    label: '',
                    fill: 'cyan',
                    borderWidth: 1,
                    pointRadius: 5
                }]
            }
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $('select.select2').select2({
                placeholder: 'Pilih',
                theme: 'bootstrap',
                width: '100%',
            });

            $('.datepick').datepicker({
                dateFormat: 'dd/mm/yy',
            });

            $('.datepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                },
                autoclose: true,
                clearBtn: true,
                singleDatePicker: true,
                timePicker: false,
            });

            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY HH:mm',
                },
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

            let validator = null;

            // $('#table-detail').DataTable({
            //     paging: false,
            //     order: [
            //         [1, 'asc']
            //     ],
            //     language: {
            //         processing: "Sedang memproses...",
            //         search: "Cari:",
            //         lengthMenu: "Tampilkan _MENU_ data",
            //         info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            //         infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            //         infoFiltered: "(Filter dari _MAX_ total data)",
            //         emptyTable: "Tidak ada data yang ditampilkan",
            //         paginate: {
            //             first: "Pertama",
            //             previous: "Sebelumnya",
            //             next: "Selanjutnya",
            //             last: "Terakhir"
            //         },
            //     },
            //     rowCallback: function(row, data) {
            //         $("td:eq(1)", row).text(moment(data[1]).format('DD/MM/YYYY'));
            //     }
            // });

            $('.btn-edit').on('click', function(e) {
                e.preventDefault();

                const index = $(this).data('colindex');
                const waktu = $(this).data('waktu');
                const nadi = $(this).attr('data-nadi');
                const suhu = $(this).attr('data-suhu');
                const sistol = $(this).attr('data-sistol');
                const diastol = $(this).attr('data-diastol');
                const pernafasan = $(this).attr('data-pernafasan');
                const tanggal = $('input[name="tanggal[' + index + ']"]').val();
                const ruang_rawat = $('select[name="ruang_rawat[' + index + ']"]').val();
                console.log($(this), index, waktu, nadi, suhu, sistol, diastol, pernafasan, tanggal, ruang_rawat);
                if (tanggal && ruang_rawat) {
                    $('#tanggal').val(tanggal);
                    $(`.btn-edit[data-waktu="${waktu}"][data-colindex="${index}"]`).attr('data-tanggal', tanggal);
                    $('#ruang_rawat').val(ruang_rawat);
                    $('#waktu').val(waktu);
                    $('#operator').val('{{ auth()->user()->realname }}');
                    $('#pernafasan')
                        .val(pernafasan)
                        .off('keyup')
                        .on('keyup', function(e) {
                            $(`.btn-edit[data-waktu="${waktu}"][data-colindex="${index}"]`).attr('data-pernafasan', $(this).val());
                        });
                    $('#nadi')
                        .val(nadi)
                        .off('keyup')
                        .on('keyup', function(e) {
                            $(`.btn-edit[data-waktu="${waktu}"][data-colindex="${index}"]`).attr('data-nadi', $(this).val());
                        });
                    $('#suhu')
                        .val(suhu)
                        .off('keyup')
                        .on('keyup', function(e) {
                            $(`.btn-edit[data-waktu="${waktu}"][data-colindex="${index}"]`).attr('data-suhu', $(this).val());
                        });
                    $('#sistol')
                        .val(sistol)
                        .off('keyup')
                        .on('keyup', function(e) {
                            $(`.btn-edit[data-waktu="${waktu}"][data-colindex="${index}"]`).attr('data-sistol', $(this).val());
                        });
                    $('#diastol')
                        .val(diastol)
                        .off('keyup')
                        .on('keyup', function(e) {
                            $(`.btn-edit[data-waktu="${waktu}"][data-colindex="${index}"]`).attr('data-diastol', $(this).val());
                        });

                    $('#editModal').modal('show');
                } else {
                    alert('Mohon isi Tanggal dan Ruang Rawat terlebih dahulu.');
                }
            });

            $('#editModal').on('hidden.bs.modal', function(e) {
                $(this).find('form').first().trigger('reset');
            });

            $('#BB, #TB, #LK').on('blur', function(e) {
                $.ajax({
                    url: "{{ url()->full() }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "BB": $("#BB").val(),
                        "TB": $("#TB").val(),
                        "LK": $("#LK").val(),
                    },
                    dataType: "json",
                    success: function(data, status, xhr) {
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });
            });
        });
    </script>
</body>

</html>