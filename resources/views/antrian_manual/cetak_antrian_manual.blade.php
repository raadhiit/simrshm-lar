<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Antrian</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
</head>

<body onload="printPage()">
    <div class="row" style="margin-left: 100px; width:100%;">
        <div class="col-lg-6" style="border:1px solid transparent; width:95mm; padding:30px;">
            <p style="text-align: center; font-size: 16pt;">RUMAH SAKIT HARAPAN MULIA</p>
            <p style="text-align: center; font-size: 16pt; margin-top: -18px;">KABUPATEN BEKASI</p>
            <p class="pt-2" style="text-align: center; font-size:16pt;">NO ANTRIAN<br>
                <span style="font-size: 72pt; font-weight: bold;">{{ $nomor_antrean }}</span>
            </p>
            <p style="text-align: center; font-size: 16pt;">SILAHKAN MENUJU KE</p>
            <p style="text-align: center; font-size: 16pt; margin-top: -18px;">PENDAFTARAN
            </p>
            <br>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script>
    function printPage() {
        window.print();
        setTimeout(function() {
            window.location.href = '{{ url("antrian_manual") }}';
        }, 3000);
    }
</script>

</html>