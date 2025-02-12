<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <td colspan="13" style="font-weight: bold; font-size: 18pt; text-align: center;">Data Riwayat Pasien</td>
        </tr>
        <tr>
            <td colspan="13" style="font-size: 14pt; text-align: center;">Ruangan :
                {{ str_replace('_', ' ', ucwords($request['ruangan'], '_')) }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">Tanggal : {{ date('d F Y', strtotime($request['dari'])) }} s/d
                {{ date('d F Y', strtotime($request['sampai'])) }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">No.</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Masuk</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Keluar</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Status</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Asal</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Kunjungan</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">No. Reg</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">NRM</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Kelamin</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Pasien</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Umur</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Cara Bayar</th>
            <th style="border: 1px solid black; text-align: center; font-weight: bold; ">Cara Keluar</th>
        </tr>
        @isset($data_riwayats)
            @forelse ($data_riwayats as $data_riwayat)
                <tr>
                    <td style="border: 1px solid black; text-align: center;">{{ $loop->index + 1 }}</td>
                    <td style="border: 1px solid black;">{{ date('d F Y H:i', strtotime($data_riwayat->waktu_register)) }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $data_riwayat->waktu_keluar == '0000-00-00 00:00:00' ? '-' : date('d F Y H:i', strtotime($data_riwayat->waktu_keluar)) }}
                    </td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->selesai == 1 ? 'Non Aktif' : 'Aktif' }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->asal }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->kunjungan }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->no_register }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->nrm_pasien }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $data_riwayat->jk == 1 ? 'P' : 'L' }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->nama_pasien }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->umur }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->carabayar }}</td>
                    <td style="border: 1px solid black;">{{ $data_riwayat->cara_keluar }}</td>
                </tr>
            @empty
                <tr>
                    <th colspan="14" class="text-center">Data Tidak Ditemukan</th>
                </tr>
            @endforelse
        @else
            <tr>
                <th colspan="14" class="text-center">Silahkan isi bidang masukan untuk menampilkan
                    data</th>
            </tr>
        @endisset
    </table>
</body>

</html>
