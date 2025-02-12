<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Detail Hpp</title>
</head>
<body>
    <table>
        <tr>
            <td colspan="6" style="font-size: 13pt; font-weight: bold; text-align: center;">Laporan Detail HPP</td>
        </tr>
        <tr>
            <td colspan="6" style="font-size: 13pt; font-weight: bold; text-align: center;">{{$request['tanggal_dari']}} s.d {{$request['tanggal_sampai']}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style=" font-size: 12pt; font-weight: bold; text-align: center; border: 1px solid black; " >No.</td>
            <td style=" font-size: 12pt; font-weight: bold; text-align: center; border: 1px solid black; " >Nama Pasien</td>
            <td style=" font-size: 12pt; font-weight: bold; text-align: center; border: 1px solid black; " >NRM</td>
            <td style=" font-size: 12pt; font-weight: bold; text-align: center; border: 1px solid black; " >Noreg</td>
            <td style=" font-size: 12pt; font-weight: bold; text-align: center; border: 1px solid black; " >Nama Tagihan</td>
            <td style=" font-size: 12pt; font-weight: bold; text-align: center; border: 1px solid black; " >Jumlah Tagihan</td>
            <td style=" font-size: 12pt; font-weight: bold; text-align: center; border: 1px solid black; " >Hpp</td>
        </tr>
        @isset($data)
            @forelse ($data as $dt)
                <tr>
                    <td style="border: 1px solid black; text-align: center;" >{{ $loop->iteration }}</td>
                    <td style="border: 1px solid black;" >{{ $dt->nama_pasien }}</td>
                    <td style="border: 1px solid black;" >{{ $dt->nrm }}</td>
                    <td style="border: 1px solid black;" >{{ $dt->noreg_pasien }}</td>
                    <td style="border: 1px solid black;" >{{ $dt->nama_tagihan }}</td>
                    <td style="border: 1px solid black;" >{{ $dt->total }} </td>
                    <td style="border: 1px solid black;" >{{ $dt->hpp }}</td>
                </tr>
            @empty
                <td class="text-center" colspan="7">Data tidak ditemukan</td>
            @endforelse
            <tr></tr>
        @else
            <td class="text-center" colspan="7">Silahkan terapkan filter untuk menampilkan data</td>
        @endisset

    </table>
</body>
</html>
