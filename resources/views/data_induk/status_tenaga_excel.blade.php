<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <td colspan="4" style="text-align: center; font-weight: bold; font-size: 24pt;">Data Induk - Status Tenaga
            </td>
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
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">KETERANGAN
            </td>
        </tr>
        @foreach ($data as $dt)
            <tr>
                <td style="border: 1px solid black; text-align: center;">{{ $loop->index + 1 }}</td>
                <td style="border: 1px solid black;">{{ $dt->status_tenaga }}</td>
                <td style="border: 1px solid black;">{{ $dt->keterangan }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
