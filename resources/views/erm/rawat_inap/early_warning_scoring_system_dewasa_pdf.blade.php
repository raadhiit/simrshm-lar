<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Early Warning Scoring System (Dewasa)</title>
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

        @page {
            margin: 5px;
        }

        body {
            margin: 5px;
        }
    </style>
</head>

<body style="font-size: .5rem;">
    <div class="w-100 text-right">MR 01.35.001.REV 1</div>
    <table class="w-100">
        <tr>
            <td class="p-1 align-top">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
            </td>
            <td style="width: 5%;"></td>
            <td class="p-1 align-top" style="border: 1px solid black;">
                <table class="text-uppercase">
                    <tr class="align-top">
                        <td>Nama</td>
                        <td style="padding-left: 10px; padding-right: 5px;"> : </td>
                        <td class="text-nowrap">{{ $dokumen->nama_pasien }}</td>
                    </tr>
                    <tr class="align-top">
                        <td>No. RM</td>
                        <td style="padding-left: 10px; padding-right: 5px;"> : </td>
                        <td>{{ $dokumen->nrm }}</td>
                    </tr>
                    <tr class="align-top">
                        <td>Tanggal Lahir</td>
                        <td style="padding-left: 10px; padding-right: 5px;"> : </td>
                        <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr class="align-top">
                        <td>Jenis Kelamin</td>
                        <td style="padding-left: 10px; padding-right: 5px;"> : </td>
                        <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <h5 class="p-2 font-weight-bold text-center text-uppercase">Early Warning Scoring System (Dewasa)</h5>
    <table cellpadding="0" class="w-100">
        <tr>
            <td class="px-2" style="border-top: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;">Tanggal</td>
            <td class="px-2" style="border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;" colspan="2">: {{ $data->tanggal_jam->format('d/m/Y') }}</td>
            <td colspan="24" class="border">&nbsp;</td>
            <td rowspan="2" class="border">&nbsp;</td>
        </tr>
        <tr>
            <td class="px-2" style="border-top: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;">Jam</td>
            <td class="px-2" style="border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;" colspan="2">: {{ $data->tanggal_jam->format('H:i') }}</td>
            @for($i=7;$i<=24;$i++) <td class="border text-center">{{ $i }}</td>
                @endfor
                @for($i=1;$i<=6;$i++) <td class="border text-center">{{ $i }}</td>
                    @endfor
        </tr>
        <tr>
            <td class="" colspan="2">&nbsp;</td>
            <td class="text-center border px-2">Score</td>
            @for($i=1;$i<=24;$i++) <td class="border text-center">&nbsp;</td>
                @endfor
                <td class="border"></td>
        </tr>
        @foreach($items as $item)
        <?php for ($j = 0; $j < count($item['items']); $j++) : ?>
            <tr>
                @if($j == 0)
                <td rowspan="{{ count($item['items']) }}" class="border px-2 text-center align-middle">{{ $item['text'] }}</td>
                @endif
                <td class="border px-2 text-nowrap">{{ $item['items'][$j]['kriteria'] }}</td>
                <td class="text-center border">{{ $item['items'][$j]['score'] }}</td>
                @for($i=7;$i<=24;$i++) <td class="border text-center col-input">
                    {{ $isCheckedItem($item['key'], $i, $item['items'][$j]['score']) ? 'V' : '' }}
                    </td>
                    @endfor
                    @for($i=1;$i<=6;$i++) <td class="border text-center col-input">
                        {{ $isCheckedItem($item['key'], $i, $item['items'][$j]['score']) ? 'V' : '' }}
                        </td>
                        @endfor
                        <td class="border px-2 text-nowrap">{{ $item['items'][$j]['kriteria'] }}</td>
            </tr>
        <?php endfor; ?>
        @if ($item['key'] == 'saturasi_o2')
        <tr>
            <td class="border text-center">O2</td>
            <td class="border px-2">%</td>
            <td class="border"></td>
            @for($i=7;$i<=24;$i++) <td class="border text-center col-input">
                </td>
                @endfor
                @for($i=1;$i<=6;$i++) <td class="border text-center col-input">
                    </td>
                    @endfor
                    <td class="border px-2 text-nowrap">%</td>
        </tr>
        @endif
        <tr>
            <td colspan="28">&nbsp;</td>
        </tr>
        @endforeach
        <tr>
            <td class="border px-2">Total Score</td>
            <td class="border"></td>
            <td class="border"></td>
            @for($i=7;$i<=24;$i++) <td class="border px-2 text-center col-input total-score" data-hour="{{ $i }}">
                {{ $getTotalScore($i) }}
                </td>
                @endfor
                @for($i=1;$i<=6;$i++) <td class="border px-2 text-center col-input total-score" data-hour="{{ $i }}">
                    {{ $getTotalScore($i) }}
                    </td>
                    @endfor
                    <td class="border text-nowrap"></td>
        </tr>
        <tr>
            <td colspan="28">&nbsp;</td>
        </tr>
        <?php for ($j = 0; $j < count($additional); $j++) : ?>
            <tr>
                @if ($j == 0)
                <td rowspan="{{ count($additional) + 1 }}" class="border px-2 text-center text-uppercase">Parameter Tambahan yang Mendukung</td>
                @endif
                <td class="border px-2 text-uppercase text-nowrap">{{ $additional[$j] }}</td>
                <td class="border px-2"></td>
                @for($i=7;$i<=24;$i++) <td class="border text-center col-input">
                    {{ $getParameterTambahanValue($additional[$j], $i) }}
                    </td>
                    @endfor
                    @for($i=1;$i<=6;$i++) <td class="border text-center col-input">
                        {{ $getParameterTambahanValue($additional[$j], $i) }}
                        </td>
                        @endfor
                        <td class="border px-2 text-nowrap"></td>
            </tr>
        <?php endfor; ?>
        <tr>
            <td class="border">&nbsp;</td>
            <td class="border" colspan="26"></td>
        </tr>
        <tr>
            <td colspan="2" class="border px-2 text-uppercase text-center">Skor 0</td>
            <td colspan="26" class="border px-2 text-uppercase text-center">Observasi</td>
        </tr>
        <tr>
            <td colspan="2" class="border px-2 text-uppercase">Skor 1 s/d 4 (Resiko Ringan)</td>
            <td colspan="26" class="border px-2 text-uppercase text-center">Asesment segera oleh perawat senior, eskalasi perawatan dan monitoring per 4 sampai 6 jam jika diperlukan konsultasi segera ke dokter jaga</td>
        </tr>
        <tr>
            <td colspan="2" class="border px-2 text-uppercase">Skor 5 s/d 6 (Resiko Sedang)</td>
            <td colspan="26" class="border px-2 text-uppercase text-center">Asesment segera oleh dokter jaga (respon segera, max 5 menit) konsultasi DPJP dan spesialis terkait dan monitoring tiap 1 jam, pertimbangkan perawatan di HCU</td>
        </tr>
        <tr>
            <td colspan="2" class="border px-2 text-uppercase text-center">Skor 7 atau lebih / 1 Parameter Kriteria (Resiko Tinggi)</td>
            <td colspan="26" class="border px-2 text-uppercase text-center">Resusitasi dari monitoring secara terus menerus oleh dokter jaga dan perawat senior, informasikan dan konsultasikan ke DPJP dan transfer ke ICU</td>
        </tr>
    </table>
    <div class="text-center float-right pt-2" style="width: 6cm;">
        @if ($data && $data->status)
        <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}" style="width: 5cm;object-fit: contain;" alt="" />
        @else
        <div class="pb-4">&nbsp;</div>
        @endif
        <div>{{ $dokumen->nama_verifikator ?? '' }}</div>
        <div style="text-decoration: underline;">( Ka Instalasi / Dokter Jaga )</div>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
</body>

</html>