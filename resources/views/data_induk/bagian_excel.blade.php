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
            <td colspan="4" style="text-align: center; font-weight: bold; font-size: 24pt;">Data Induk - Bagian</td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td style="border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">NO</td>
            <td style="border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">NAMA</td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">SLUG</td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">KETERANGAN</td>
        </tr>
        @foreach ($data as $dt)
            <tr style="font-size: 12pt;">
                <td style="border: 1px solid black; text-align: center;">{{ $loop->index + 1 }}</td>
                <td style="border: 1px solid black;">{{ $dt->nama }}</td>
                <td style="border: 1px solid black;">{{ $dt->slug }}</td>
                <td style="border: 1px solid black;">{{ $dt->keterangan }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
