<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Antrian</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <style>
        #tabel tr {
            vertical-align: top;
        }

        @media print {
            #tabel tr {
                vertical-align: top;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="row" style="margin-left: 100px; width:100%;">
        <div class="col-lg-6" style="border:1px solid transparent; width:95mm; padding:30px;">
            <h5 class="pt-2" style="text-align: center;">RUMAH SAKIT HARAPAN MULIA</h5>
            <table style="border-collapse: collapse; font-size:16px;" id="tabel" class="mt-5 mb-4">
                <tr>
                    <td style="width: 27%;">Tanggal</td>
                    <td style="width: 5%;" class="pl-2 pr-2"> : </td>
                    <td style="width: 68%;">{{date('d-m-Y', strtotime($data->tanggalperiksa))}}</td>
                </tr>
                <tr>
                    <td>No RM</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{$data->norm}}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{$data->pasien}}</td>
                </tr>
                <tr>
                    <td>Poliklinik</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{$data->namapoli}}</td>
                </tr>
                <tr>
                    <td>Dokter</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{$data->namadokter}}</td>
                </tr>
                <tr>
                    <td>Cara Bayar</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td style="text-transform: uppercase;">{{$data->carabayar}}</td>
                </tr>
            </table>
            <p style="text-align: center; font-size:16px;">Nomor antrian : <br><span style="font-size: 30px; font-weight: bold;">{{$data->nomorantrean}}</span></p>
            <p class="text-center" style="margin-top: -15px;">Estimasi dilayani : <?php echo date("d-m-Y H:i", $data->estimasidilayani / 1000); ?></p>
            <br>
            <p class="text-center">Kode Booking</p>
            <div class="text-center" style="padding-left: 93px;">
            
                {!! DNS2D::getBarcodeHTML($data->kodebooking, 'QRCODE', 5, 5) !!}
            </div>
            <p class="text-center" style="margin-top:15px; margin-bottom:30px;">{{$data->kodebooking}}</p>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>

</script>

</html>