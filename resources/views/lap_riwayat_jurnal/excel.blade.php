<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Laporan</title>
</head>
<body>
    <table>
        <tr>
            <td colspan="8" style="font-size: 16pt; text-align: center;">Laporan Acc Jurnal Keuangan</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: center;">
                Tanggal {{ $request['tanggal_dari'] ? date('d-m-Y', strtotime($request['tanggal_dari'])) : '' }} s.d
                {{ $request['tanggal_sampai'] ? date('d-m-Y', strtotime($request['tanggal_sampai'])) : '' }}
            </td>
        </tr>
        <tr></tr>
        <tr>
            <th style="border: 1px solid black; font-weight: bold;" width="5%">No.</th>
            <th style="border: 1px solid black; font-weight: bold;">Jenis Jurnal</th>
            <th style="border: 1px solid black; font-weight: bold;">Operator</th>
            <th style="border: 1px solid black; font-weight: bold;">Tanggal Input</th>
            <th style="border: 1px solid black; font-weight: bold;">Tanggal Jurnal</th>
            <th style="border: 1px solid black; font-weight: bold;">Nomor Jurnal</th>
            <th style="border: 1px solid black; font-weight: bold;" width="25%">Keterangan</th>
            <th style="border: 1px solid black; font-weight: bold;">Status</th>
        </tr>
        @isset($data)
            @forelse ($data as $index => $item)
                <tr>
                    <td style="border: 1px solid black;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black;">{{ $item->jenis_jurnal }}</td>
                    <td style="border: 1px solid black;">{{ $item->operator }}</td>
                    <td style="border: 1px solid black;">{{ $item->tanggal_input }}</td>
                    <td style="border: 1px solid black;">{{ $item->tanggal_jurnal }}</td>
                    <td style="border: 1px solid black;">{{ $item->nomor_jurnal }}</td>
                    <td style="border: 1px solid black;">{{ $item->keterangan }}</td>
                    <td style="border: 1px solid black;">{{ $item->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Data tidak ditemukan</td>
                </tr>
            @endforelse
        @endisset

    </table>
</body>
</html>
