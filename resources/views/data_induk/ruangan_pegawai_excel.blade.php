<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table width="100%" style="font-size:15pt; ">
        <tr>
            <td colspan="4" style="text-align: center; font-weight: bold; font-size: 24pt;">Data Induk - Ruangan Pegawai 
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
                <td style="border: 1px solid black;">{{ $dt->ruangan_pegawai }}</td>
                <td style="border: 1px solid black;">{{ $dt->keterangan }}</td>
            </tr>
        @endforeach
    </table>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
</script>

</html>
