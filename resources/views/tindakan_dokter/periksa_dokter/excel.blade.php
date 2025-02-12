<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Tarif Periksa Dokter</title>
</head>

<body>
    <table>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Jenis Pasien</th>
            <th>Kelas</th>
            <th>Tarif Sekarang</th>
        </tr>
        @forelse ($data as $index=>$item)
        <tr>
                <td>{{++$index}}</td>
                <td>{{$item->nama_periksa}}</td>
                <td>{{$item->carabayar}}</td>
                <td>{{$item->kelas}}</td>
                <td>{{$item->tarif}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="20">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
    </table>
</body>

</html>
