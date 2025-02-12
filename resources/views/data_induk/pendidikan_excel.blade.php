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
            <td colspan="9" style="text-align: center; font-weight: bold; font-size: 24pt;">Data Induk - Pendidikan
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
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">KETERANGAN</td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">KEBUTUHAN LK
            </td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">KEBUTUHAN PR
            </td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">TERSEDIA LK
            </td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">TERSEDIA PR
            </td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">KEKURANGAN LK
            </td>
            <td style=" border: 1px solid black; font-weight: bold; text-align: center; font-size: 12pt;">KEKURANGAN PR
            </td>
        </tr>
        @foreach ($data as $dt)
            <tr style="font-size: 12pt;">
                <td style="border: 1px solid black; text-align: center;">{{ $loop->index + 1 }}</td>
                <td style="border: 1px solid black;">{{ $dt->pendidikan }}</td>
                <td style="border: 1px solid black;">{{ $dt->keterangan }}</td>
                <td style="border: 1px solid black;">{{ $dt->butuh_lk }}</td>
                <td style="border: 1px solid black;">{{ $dt->butuh_pr }}</td>
                <td style="border: 1px solid black;">
                    {{-- mengambil data smis_hrd_employee pada DataIndukService.php --}}
                    {{ $tersediaLK = $service->getHrdEmploye(1, $dt->pendidikan) }}
                </td>
                <td style="border: 1px solid black;">
                    {{ $tersediaPR = $service->getHrdEmploye(0, $dt->pendidikan) }}
                </td>
                <td style="border: 1px solid black;">
                    {{ $tersediaLK - $dt->butuh_lk }}
                </td>
                <td style="border: 1px solid black;">
                    {{ $tersediaPR - $dt->butuh_pr }}
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
