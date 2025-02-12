<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RS Harapan Mulia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
    <div class="container-fluid" style="padding-top: 20px">
        <div class="overflow-hidden text-center mb-3">
            <?php
            //Mapping data
            $antrian_rehab_medik = [];
            $antrian_urologi = [];
            $antrian_orthopedi = [];
            
            $dokter_rehab_medik = [];
            $dokter_urologi = [];
            $dokter_orthopedi = [];
            
            foreach ($dokter as $dok) {
                switch ($dok->slug_poli) {
                    case 'poli_rehab_medik':
                        array_push($dokter_rehab_medik, $dok->nama_dokter);
                        break;
                    case 'poli_urologi':
                        array_push($dokter_urologi, $dok->nama_dokter);
                        break;
                    case 'poli_ortopedi':
                        array_push($dokter_orthopedi, $dok->nama_dokter);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            
            foreach ($antrian as $ant) {
                switch ($ant->slug_poli) {
                    case 'poli_rehab_medik':
                        array_push($antrian_rehab_medik, $ant);
                        break;
                    case 'poli_urologi':
                        array_push($antrian_urologi, $ant);
                        break;
                    case 'poli_ortopedi':
                        array_push($antrian_orthopedi, $ant);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            
            ?>
            <div class="row">

                <!-- Col Antrian Rehab Medik -->
                <div class="col-4 pb-5">
                    <table class="table">
                        <thead>
                            <tr style="height: 150px;">
                                <th scope="col" class="p-3 text-white bg-danger" style="vertical-align: middle;">
                                    <div class="h1" style="line-height: 1; font-weight: bold;">
                                        Poli Rehab Medik<br>
                                        <span style="font-size: 24px;">
                                            @if (isset($dokter_rehab_medik[0]))
                                                {{ $dokter_rehab_medik[0] }}
                                            @else
                                                &nbsp;
                                            @endif
                                        </span><br>
                                        <span style="font-size: 24px;">
                                            @if (isset($dokter_rehab_medik[1]))
                                                {{ $dokter_rehab_medik[1] }}
                                            @else
                                                &nbsp;
                                            @endif
                                        </span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div class="h1 p-3" id="panggilan_poli_rehab_medik">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;"></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $mod_antrian_rehab_medik = sizeof($antrian_rehab_medik) % 5;
                                    $jumlah_bagi_antrian_rehab_medik = (int) floor(sizeof($antrian_rehab_medik) / 5);
                                    $arr_antrian_rehab_medik = [];
                                    $count_antrian_rehab_medik = 0;
                                    
                                    if ($jumlah_bagi_antrian_rehab_medik > 0) {
                                        for ($i = 0; $i < $jumlah_bagi_antrian_rehab_medik; $i++) {
                                            array_push($arr_antrian_rehab_medik, []);
                                            for ($j = 0; $j < 5; $j++) {
                                                array_push($arr_antrian_rehab_medik[$i], $antrian_rehab_medik[$count_antrian_rehab_medik * 5 + $j]);
                                            }
                                            $count_antrian_rehab_medik++;
                                        }
                                    }
                                    
                                    if ($mod_antrian_rehab_medik > 0) {
                                        array_push($arr_antrian_rehab_medik, []);
                                        for ($j = 0; $j < $mod_antrian_rehab_medik; $j++) {
                                            array_push($arr_antrian_rehab_medik[$jumlah_bagi_antrian_rehab_medik], $antrian_rehab_medik[$count_antrian_rehab_medik * 5 + $j]);
                                        }
                                    }
                                    
                                    ?>
                                    <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                        <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                            data-bs-ride="carousel" style="min-height: 250px">
                                            <div class="carousel-indicators">
                                                <?php for ($i = 0; $i < sizeof($arr_antrian_rehab_medik); $i++) { ?>
                                                @if ($i == 0)
                                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                                        data-bs-slide-to="0" class="active" aria-current="true"
                                                        aria-label="Slide 1"></button>
                                                @else
                                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                                        data-bs-slide-to="{{ $i }}"
                                                        aria-label="Slide {{ $i + 1 }}"></button>
                                                @endif
                                                <?php } ?>
                                            </div>
                                            <div class="carousel-inner">
                                                <?php for ($i = 0; $i < sizeof($arr_antrian_rehab_medik); $i++) { ?>
                                                @if ($i == 0)
                                                    <div class="carousel-item active">
                                                    @else
                                                        <div class="carousel-item">
                                                @endif
                                                <table class="table table-bordered">
                                                    <tbody class="table-group-divider">
                                                        <?php for ($j = 0; $j < sizeof($arr_antrian_rehab_medik[$i]); $j++) { ?>
                                                        <tr>
                                                            <td class="text-center" style="font-size: 32px;">
                                                                {{ $arr_antrian_rehab_medik[$i][$j]->nomorantrean }}
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        <?php
                                                                    if (sizeof($arr_antrian_rehab_medik[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_rehab_medik[$i])); $k++) { ?>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <?php }
                                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col text-end">Total Antrian : {{ sizeof($antrian_rehab_medik) }}</div>
                </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
        </div>
        <!-- End Col Antrian Rehab Medik -->

        <!-- Col Antrian Urologi -->
        <div class="col-4 pb-5">
            <table class="table">
                <thead>
                    <tr style="height: 150px;">
                        <th scope="col" class="p-3 text-black bg-warning" style="vertical-align: middle;">
                            <div class="h1" style="line-height: 1; font-weight: bold;">
                                Poli Urologi<br>
                                <span style="font-size: 24px;">
                                    @if (isset($dokter_urologi[0]))
                                        {{ $dokter_urologi[0] }}
                                    @else
                                        &nbsp;
                                    @endif
                                </span><br>
                                <span style="font-size: 24px;">
                                    @if (isset($dokter_urologi[1]))
                                        {{ $dokter_urologi[1] }}
                                    @else
                                        &nbsp;
                                    @endif
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <div class="h1 p-3" id="panggilan_poli_urologi">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $mod_antrian_urologi = sizeof($antrian_urologi) % 5;
                            $jumlah_bagi_antrian_urologi = (int) floor(sizeof($antrian_urologi) / 5);
                            $arr_antrian_urologi = [];
                            $count_antrian_urologi = 0;
                            
                            if ($jumlah_bagi_antrian_urologi > 0) {
                                for ($i = 0; $i < $jumlah_bagi_antrian_urologi; $i++) {
                                    array_push($arr_antrian_urologi, []);
                                    for ($j = 0; $j < 5; $j++) {
                                        array_push($arr_antrian_urologi[$i], $antrian_urologi[$count_antrian_urologi * 5 + $j]);
                                    }
                                    $count_antrian_urologi++;
                                }
                            }
                            
                            if ($mod_antrian_urologi > 0) {
                                array_push($arr_antrian_urologi, []);
                                for ($j = 0; $j < $mod_antrian_urologi; $j++) {
                                    array_push($arr_antrian_urologi[$jumlah_bagi_antrian_urologi], $antrian_urologi[$count_antrian_urologi * 5 + $j]);
                                }
                            }
                            
                            ?>
                            <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                    data-bs-ride="carousel" style="min-height: 250px">
                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < sizeof($arr_antrian_urologi); $i++) { ?>
                                        @if ($i == 0)
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="0" class="active" aria-current="true"
                                                aria-label="Slide 1"></button>
                                        @else
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $i }}"
                                                aria-label="Slide {{ $i + 1 }}"></button>
                                        @endif
                                        <?php } ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php for ($i = 0; $i < sizeof($arr_antrian_urologi); $i++) { ?>
                                        @if ($i == 0)
                                            <div class="carousel-item active">
                                            @else
                                                <div class="carousel-item">
                                        @endif
                                        <table class="table table-bordered">
                                            <tbody class="table-group-divider">
                                                <?php for ($j = 0; $j < sizeof($arr_antrian_urologi[$i]); $j++) { ?>
                                                <tr>
                                                    <td class="text-center" style="font-size: 32px">
                                                        {{ $arr_antrian_urologi[$i][$j]->nomorantrean }}</td>
                                                </tr>
                                                <?php } ?>
                                                <?php
                                                                    if (sizeof($arr_antrian_urologi[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_urologi[$i])); $k++) { ?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <?php }
                                                                    } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col text-end">Total Antrian : {{ sizeof($antrian_urologi) }}</div>
        </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Urologi -->

    <!-- Col Antrian Orthopedi -->
    <div class="col-4 pb-5">
        <table class="table">
            <thead>
                <tr style="height: 150px;">
                    <th scope="col" class="p-3 text-white bg-success" style="vertical-align: middle;">
                        <div class="h1" style="line-height: 1; font-weight: bold;">
                            Poli Orthopedi<br>
                            <span style="font-size: 24px;">
                                @if (isset($dokter_orthopedi[0]))
                                    {{ $dokter_orthopedi[0] }}
                                @else
                                    &nbsp;
                                @endif
                            </span><br>
                            <span style="font-size: 24px;">
                                @if (isset($dokter_orthopedi[1]))
                                    {{ $dokter_orthopedi[1] }}
                                @else
                                    &nbsp;
                                @endif
                            </span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <div class="h1 p-3" id="panggilan_poli_orthopedi">
                        </div>
                    </th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $mod_antrian_orthopedi = sizeof($antrian_orthopedi) % 5;
                        $jumlah_bagi_antrian_orthopedi = (int) floor(sizeof($antrian_orthopedi) / 5);
                        $arr_antrian_orthopedi = [];
                        $count_antrian_orthopedi = 0;
                        
                        if ($jumlah_bagi_antrian_orthopedi > 0) {
                            for ($i = 0; $i < $jumlah_bagi_antrian_orthopedi; $i++) {
                                array_push($arr_antrian_orthopedi, []);
                                for ($j = 0; $j < 5; $j++) {
                                    array_push($arr_antrian_orthopedi[$i], $antrian_orthopedi[$count_antrian_orthopedi * 5 + $j]);
                                }
                                $count_antrian_orthopedi++;
                            }
                        }
                        
                        if ($mod_antrian_orthopedi > 0) {
                            array_push($arr_antrian_orthopedi, []);
                            for ($j = 0; $j < $mod_antrian_orthopedi; $j++) {
                                array_push($arr_antrian_orthopedi[$jumlah_bagi_antrian_orthopedi], $antrian_orthopedi[$count_antrian_orthopedi * 5 + $j]);
                            }
                        }
                        
                        ?>
                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                data-bs-ride="carousel" style="min-height: 250px">
                                <div class="carousel-indicators">
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_orthopedi); $i++) { ?>
                                    @if ($i == 0)
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                    @else
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $i }}"
                                            aria-label="Slide {{ $i + 1 }}"></button>
                                    @endif
                                    <?php } ?>
                                </div>
                                <div class="carousel-inner">
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_orthopedi); $i++) { ?>
                                    @if ($i == 0)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <table class="table table-bordered">
                                        <tbody class="table-group-divider">
                                            <?php for ($j = 0; $j < sizeof($arr_antrian_orthopedi[$i]); $j++) { ?>
                                            <tr>
                                                <td class="text-center" style="font-size: 32px">
                                                    {{ $arr_antrian_orthopedi[$i][$j]->nomorantrean }}</td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                                                    if (sizeof($arr_antrian_orthopedi[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_orthopedi[$i])); $k++) { ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php }
                                                                    } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_orthopedi) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Orthopedi -->
    </div>
    </div>

    <?php
    
    ?>

    <div class="overflow-hidden text-center">
        <div class="row gy-5">

        </div>
    </div>
    </div>
</body>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    // window.speechSynthesis.cancel();

    // let history = [];

    const synth = window.speechSynthesis;

    Pusher.logToConsole = true;

    console.log('{{ env('PUSHER_APP_KEY') }}');

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
            console.log(data);
            if (data.bagian == 'poli') {
                if (data.jadwal.slug_poli == 'poli_urologi' || data.jadwal.slug_poli == 'poli_ortopedi' || data
                    .jadwal.slug_poli == 'poli_rehab_medik') {
                    var temp_pasien = data.pasien.toLowerCase();
                    var msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien +
                        '. Silahkan menuju ' + data.loket);
                    msg.rate = 0.9;
                    msg.pitch = 1;
                    // msg.voice = model_suara[$('#model').val()];
                    msg.lang = 'id-ID';
                    synth.speak(msg);
                    var slug_poli = data.jadwal != undefined ? data.jadwal != null ? data.jadwal.slug_poli : '' :
                        '';
                    var id_poli = data.jadwal != undefined ? data.jadwal != null ? data.jadwal.id : '' : '';
                    $('#panggilan_' + slug_poli).html(data.nomor);
                }
            }
        });
        
        setInterval(() => {
            location.reload();
        }, 6000);
</script>

</html>
