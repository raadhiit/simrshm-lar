<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Laporan Laba Rugi</title>
</head>

<body>
    <table>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"
                style="border-left: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;  text-align: center; font-size: 14pt;">
                Laporan Laba Rugi</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"
                style="border-left: 1px solid black; text-align: center; border-bottom: 1px solid black; border-right: 1px solid black; font-size: 12pt;">
                Periode {{ $request['tanggal_dari'] }} s/d {{ $request['tanggal_sampai'] }}</td>
        </tr>
        @inject('laporanLabaRugiService', 'App\Services\LaporanLabaRugiService')
        @php
            $pendapatanOperasional = $laporanLabaRugiService->getData('5', 'kredit', $request);
            $hargaPokok = $laporanLabaRugiService->getData('6', 'debet', $request);
            $labaKotor = $pendapatanOperasional - $hargaPokok;
            
            $bebanPemasaran = $laporanLabaRugiService->getData('7.1', 'debet', $request);
            $bebanAdministrasi = $laporanLabaRugiService->getData('7.2', 'debet', $request);
            $bebanUsaha = $bebanPemasaran + $bebanAdministrasi;
            
            $pendapatanNonOperasional = $laporanLabaRugiService->getData('8', 'kredit', $request);
            $biayaNonOperasional = $laporanLabaRugiService->getData('9', 'debet', $request);
            $bebanNonOperasional = $pendapatanNonOperasional + $biayaNonOperasional;
        @endphp
        <tr>
            <td></td>
            <td style="border-left: 1px solid black;">Pendapatan Operasional</td>
            <td style="border-right:1px solid black ;">{{ $pendapatanOperasional }}</td>
        </tr>
        <tr>
            <td></td>
            <td style="border-left: 1px solid black;">Harga Pokok Pendapatan Operasional</td>
            <td style="border-right: 1px solid black;">{{ $hargaPokok }}</td>
        </tr>
        <tr>
            <td></td>
            <th style="background-color: #ebebeb; font-weight: bold; border-left: 1px solid black;">Laba Kotor</th>
            <th style="background-color: #ebebeb; font-weight: bold; border-right: 1px solid black;">{{ $labaKotor }}
            </th>
        </tr>
        <tr>
            <td></td>
            <td style="border-left: 1px solid black;">Beban Pemasaran</td>
            <td style="border-right: 1px solid black;">{{ $bebanPemasaran }}</td>
        </tr>
        <tr>
            <td></td>
            <td style="border-left: 1px solid black;">Beban Administrasi Dan Umum</td>
            <td style="border-right: 1px solid black;">{{ $bebanAdministrasi }}</td>
        </tr>
        <tr>
            <td></td>
            <th style="background-color: #ebebeb; border-left: 1px solid black; font-weight: bold;">Beban Usaha</th>
            <th style="background-color: #ebebeb; font-weight: bold ; border-right: 1px solid black;">
                {{ $bebanUsaha }}</th>
        </tr>
        <tr>
            <td></td>
            <td style="border-left: 1px solid black;">Pendapatan Non Operasional</td>
            <td style="border-right: 1px solid black;">{{ $pendapatanNonOperasional }}</td>
        </tr>
        <tr>
            <td></td>
            <td style="border-left: 1px solid black;">Biaya Non Operasiolan</td>
            <td style="border-right: 1px solid black;">{{ $biayaNonOperasional }}</td>
        </tr>
        <tr>
            <td></td>
            <th style="background-color: #ebebeb; border-left: 1px solid black; font-weight: bold;">Pendapatan/(Beban)
                Non Operasional</th>
            <th style="background-color: #ebebeb; border-right: 1px solid black; font-weight: bold;">
                {{ $bebanNonOperasional }}</th>
        </tr>
        <tr>
            <td></td>
            <th
                style="background-color: #ebebeb; border-left: 1px solid black; border-bottom: 1px solid black; font-weight: bold;">
                Laba Bersih</th>
            <th
                style="background-color: #ebebeb; border-right: 1px solid black; border-bottom: 1px solid black; font-weight: bold;">
                {{ $labaKotor - $bebanUsaha + $pendapatanNonOperasional }}</th>
        </tr>
    </table>
</body>

</html>
