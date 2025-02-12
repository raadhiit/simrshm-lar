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
            $antrian_jantung = [];
            $antrian_mata = [];
            $antrian_saraf = [];
            $antrian_internis = [];
            
            $dokter_jantung = [];
            $dokter_mata = [];
            $dokter_saraf = [];
            
            foreach ($dokter as $dok) {
                switch ($dok->slug_poli) {
                    case 'poli_jantung_dan_pembuluh_darah':
                        array_push($dokter_jantung, $dok->nama_dokter);
                        break;
                    case 'poli_mata':
                        array_push($dokter_mata, $dok->nama_dokter);
                        break;
                    case 'poli_syaraf':
                        array_push($dokter_saraf, $dok->nama_dokter);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            
            foreach ($antrian as $ant) {
                switch ($ant->slug_poli) {
                    case 'poli_jantung_dan_pembuluh_darah':
                        array_push($antrian_jantung, $ant);
                        break;
                    case 'poli_mata':
                        array_push($antrian_mata, $ant);
                        break;
                    case 'poli_syaraf':
                        array_push($antrian_saraf, $ant);
                        break;
                    case 'poli_penyakit_dalam':
                        if ($ant->namadokter == 'dr. SUBAGIO SP.PD' || $ant->namadokter == 'dr. Eric Nelson, Sp.PD') {
                            array_push($antrian_internis, $ant);
                        }
                        break;
            
                    default:
                        # code...
                        break;
                }
            }
            
            ?>
            <div class="row">
                {{-- <button onclick="speakText()">Klik untuk Bicara</button> --}}

                <!-- Col Antrian Jantung -->
                <div class="col-3 pb-5">
                    <table class="table">
                        <thead>
                            <tr style="height: 150px;">
                                <th scope="col" class="p-3 text-white bg-danger" style="vertical-align: middle;">
                                    <div class="h1" style="line-height: 1; font-weight: bold;">
                                        Poli Jantung<br>
                                        <span style="font-size: 24px;">
                                            @if (isset($dokter_jantung[0]))
                                                {{ $dokter_jantung[0] }}
                                            @else
                                                &nbsp;
                                            @endif
                                        </span><br>
                                        <span style="font-size: 18px;">
                                            @if (isset($dokter_jantung[1]))
                                                {{ $dokter_jantung[1] }}
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
                                    <div class="h1 p-3" id="panggilan_poli_jantung_dan_pembuluh_darah">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;"></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $mod_antrian_jantung = sizeof($antrian_jantung) % 5;
                                    $jumlah_bagi_antrian_jantung = (int) floor(sizeof($antrian_jantung) / 5);
                                    $arr_antrian_jantung = [];
                                    $count_antrian_jantung = 0;
                                    
                                    if ($jumlah_bagi_antrian_jantung > 0) {
                                        for ($i = 0; $i < $jumlah_bagi_antrian_jantung; $i++) {
                                            array_push($arr_antrian_jantung, []);
                                            for ($j = 0; $j < 5; $j++) {
                                                array_push($arr_antrian_jantung[$i], $antrian_jantung[$count_antrian_jantung * 5 + $j]);
                                            }
                                            $count_antrian_jantung++;
                                        }
                                    }
                                    
                                    if ($mod_antrian_jantung > 0) {
                                        array_push($arr_antrian_jantung, []);
                                        for ($j = 0; $j < $mod_antrian_jantung; $j++) {
                                            array_push($arr_antrian_jantung[$jumlah_bagi_antrian_jantung], $antrian_jantung[$count_antrian_jantung * 5 + $j]);
                                        }
                                    }
                                    
                                    ?>
                                    <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                        <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                            data-bs-ride="carousel" style="min-height: 250px">
                                            <div class="carousel-indicators">
                                                <?php for ($i = 0; $i < sizeof($arr_antrian_jantung); $i++) { ?>
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
                                                <?php for ($i = 0; $i < sizeof($arr_antrian_jantung); $i++) { ?>
                                                @if ($i == 0)
                                                    <div class="carousel-item active">
                                                    @else
                                                        <div class="carousel-item">
                                                @endif
                                                <table class="table table-bordered">
                                                    <tbody class="table-group-divider">
                                                        <?php for ($j = 0; $j < sizeof($arr_antrian_jantung[$i]); $j++) { ?>
                                                        <tr>
                                                            <td class="text-center" style="font-size: 32px">
                                                                {{ $arr_antrian_jantung[$i][$j]->nomorantrean }}</td>
                                                        </tr>
                                                        <?php } ?>
                                                        <?php
                                                                    if (sizeof($arr_antrian_jantung[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_jantung[$i])); $k++) { ?>
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
                                    <div class="col text-end">Total Antrian : {{ sizeof($antrian_jantung) }}</div>
                </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
        </div>
        <!-- End Col Antrian Jantung -->

        <!-- Col Antrian Mata -->
        <div class="col-3 pb-5">
            <table class="table">
                <thead>
                    <tr style="height: 150px;">
                        <th scope="col" class="p-3 text-black bg-warning" style="vertical-align: middle;">
                            <div class="h1" style="line-height: 1; font-weight: bold;">
                                Poli Mata<br>
                                <span style="font-size: 24px;">
                                    @if (isset($dokter_mata[0]))
                                        {{ $dokter_mata[0] }}
                                    @else
                                        &nbsp;
                                    @endif
                                </span><br>
                                <span style="font-size: 24px;">
                                    @if (isset($dokter_mata[1]))
                                        {{ $dokter_mata[1] }}
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
                            <div class="h1 p-3" id="panggilan_poli_mata">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $mod_antrian_mata = sizeof($antrian_mata) % 5;
                            $jumlah_bagi_antrian_mata = (int) floor(sizeof($antrian_mata) / 5);
                            $arr_antrian_mata = [];
                            $count_antrian_mata = 0;
                            
                            if ($jumlah_bagi_antrian_mata > 0) {
                                for ($i = 0; $i < $jumlah_bagi_antrian_mata; $i++) {
                                    array_push($arr_antrian_mata, []);
                                    for ($j = 0; $j < 5; $j++) {
                                        array_push($arr_antrian_mata[$i], $antrian_mata[$count_antrian_mata * 5 + $j]);
                                    }
                                    $count_antrian_mata++;
                                }
                            }
                            
                            if ($mod_antrian_mata > 0) {
                                array_push($arr_antrian_mata, []);
                                for ($j = 0; $j < $mod_antrian_mata; $j++) {
                                    array_push($arr_antrian_mata[$jumlah_bagi_antrian_mata], $antrian_mata[$count_antrian_mata * 5 + $j]);
                                }
                            }
                            
                            ?>
                            <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                    data-bs-ride="carousel" style="min-height: 250px">
                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < sizeof($arr_antrian_mata); $i++) { ?>
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
                                        <?php for ($i = 0; $i < sizeof($arr_antrian_mata); $i++) { ?>
                                        @if ($i == 0)
                                            <div class="carousel-item active">
                                            @else
                                                <div class="carousel-item">
                                        @endif
                                        <table class="table table-bordered">
                                            <tbody class="table-group-divider">
                                                <?php for ($j = 0; $j < sizeof($arr_antrian_mata[$i]); $j++) { ?>
                                                <tr>
                                                    <td class="text-center" style="font-size: 32px">
                                                        {{ $arr_antrian_mata[$i][$j]->nomorantrean }}</td>
                                                </tr>
                                                <?php } ?>
                                                <?php
                                                                    if (sizeof($arr_antrian_mata[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_mata[$i])); $k++) { ?>
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
                            <div class="col text-end">Total Antrian : {{ sizeof($antrian_mata) }}</div>
        </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Mata -->

    <!-- Col Antrian Saraf -->
    <div class="col-3 pb-5">
        <table class="table">
            <thead>
                <tr style="height: 150px;">
                    <th scope="col" class="p-3 text-white bg-success" style="vertical-align: middle;">
                        <div class="h1" style="line-height: 1; font-weight: bold;">
                            Poli Saraf<br>
                            <span style="font-size: 24px;">
                                @if (isset($dokter_saraf[0]))
                                    {{ $dokter_saraf[0] }}
                                @else
                                    &nbsp;
                                @endif
                            </span><br>
                            <span style="font-size: 24px;">
                                @if (isset($dokter_saraf[1]))
                                    {{ $dokter_saraf[1] }}
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
                        <div class="h1 p-3" id="panggilan_poli_syaraf">
                        </div>
                    </th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $mod_antrian_saraf = sizeof($antrian_saraf) % 5;
                        $jumlah_bagi_antrian_saraf = (int) floor(sizeof($antrian_saraf) / 5);
                        $arr_antrian_saraf = [];
                        $count_antrian_saraf = 0;
                        
                        if ($jumlah_bagi_antrian_saraf > 0) {
                            for ($i = 0; $i < $jumlah_bagi_antrian_saraf; $i++) {
                                array_push($arr_antrian_saraf, []);
                                for ($j = 0; $j < 5; $j++) {
                                    array_push($arr_antrian_saraf[$i], $antrian_saraf[$count_antrian_saraf * 5 + $j]);
                                }
                                $count_antrian_saraf++;
                            }
                        }
                        
                        if ($mod_antrian_saraf > 0) {
                            array_push($arr_antrian_saraf, []);
                            for ($j = 0; $j < $mod_antrian_saraf; $j++) {
                                array_push($arr_antrian_saraf[$jumlah_bagi_antrian_saraf], $antrian_saraf[$count_antrian_saraf * 5 + $j]);
                            }
                        }
                        
                        ?>
                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                data-bs-ride="carousel" style="min-height: 250px">
                                <div class="carousel-indicators">
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_saraf); $i++) { ?>
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
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_saraf); $i++) { ?>
                                    @if ($i == 0)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <table class="table table-bordered">
                                        <tbody class="table-group-divider">
                                            <?php for ($j = 0; $j < sizeof($arr_antrian_saraf[$i]); $j++) { ?>
                                            <tr>
                                                <td class="text-center" style="font-size: 32px">
                                                    {{ $arr_antrian_saraf[$i][$j]->nomorantrean }}
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                                                    if (sizeof($arr_antrian_saraf[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_saraf[$i])); $k++) { ?>
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
                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_saraf) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Saraf -->

    <!-- Col Antrian Internis -->
    <div class="col-3 pb-5">
        <table class="table">
            <thead>
                <tr style="height: 150px;">
                    <th scope="col" class="p-3 text-white bg-primary" style="vertical-align: middle;">
                        <div class="h1" style="line-height: 1; font-weight: bold;">
                            Poli Internis 1<br>
                            <span style="font-size: 24px;">dr. SUBAGIO SP.PD</span><br>
                            <span style="font-size: 24px;">dr. Eric Nelson, Sp.PD</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <div class="h1 p-3" id="panggilan_poli_penyakit_dalam">
                        </div>
                    </th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $mod_antrian_internis = sizeof($antrian_internis) % 5;
                        $jumlah_bagi_antrian_internis = (int) floor(sizeof($antrian_internis) / 5);
                        $arr_antrian_internis = [];
                        $count_antrian_internis = 0;
                        
                        if ($jumlah_bagi_antrian_internis > 0) {
                            for ($i = 0; $i < $jumlah_bagi_antrian_internis; $i++) {
                                array_push($arr_antrian_internis, []);
                                for ($j = 0; $j < 5; $j++) {
                                    array_push($arr_antrian_internis[$i], $antrian_internis[$count_antrian_internis * 5 + $j]);
                                }
                                $count_antrian_internis++;
                            }
                        }
                        
                        if ($mod_antrian_internis > 0) {
                            array_push($arr_antrian_internis, []);
                            for ($j = 0; $j < $mod_antrian_internis; $j++) {
                                array_push($arr_antrian_internis[$jumlah_bagi_antrian_internis], $antrian_internis[$count_antrian_internis * 5 + $j]);
                            }
                        }
                        
                        ?>
                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                data-bs-ride="carousel" style="min-height: 250px">
                                <div class="carousel-indicators">
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_internis); $i++) { ?>
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
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_internis); $i++) { ?>
                                    @if ($i == 0)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <table class="table table-bordered">
                                        <tbody class="table-group-divider">
                                            <?php for ($j = 0; $j < sizeof($arr_antrian_internis[$i]); $j++) { ?>
                                            <tr>
                                                <td class="text-center" style="font-size: 32px">
                                                    {{ $arr_antrian_internis[$i][$j]->nomorantrean }}</td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                                                    if (sizeof($arr_antrian_internis[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_internis[$i])); $k++) { ?>
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
                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_internis) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Internis -->

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
    // let history = [];

    const synth = window.speechSynthesis;

    Pusher.logToConsole = true;

    console.log('{{ env('PUSHER_APP_KEY') }}');

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // synth.cancel();
        console.log(data);
        if (data.bagian == 'poli') {
            if (data.jadwal.slug_poli == 'poli_jantung_dan_pembuluh_darah' || data.jadwal.slug_poli ==
                'poli_mata' || data.jadwal.slug_poli == 'poli_syaraf' || ((data.jadwal.slug_poli ==
                    'poli_penyakit_dalam' && data.jadwal.nama_dokter == 'dr. SUBAGIO SP.PD') || (data.jadwal
                    .slug_poli == 'poli_penyakit_dalam' && data.jadwal.nama_dokter ==
                    'dr. Eric Nelson, Sp.PD'))) {
                var temp_pasien = data.pasien.toLowerCase();
                var msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien +
                    '. Silahkan menuju ' + data.loket);
                var slug_poli = data.jadwal != undefined ? data.jadwal != null ? data.jadwal.slug_poli : '' :
                    '';
                var id_poli = data.jadwal != undefined ? data.jadwal != null ? data.jadwal.id : '' : '';
                $('#panggilan_' + slug_poli).html(data.nomor);
                msg.rate = 0.9;
                msg.pitch = 1;
                // msg.voice = model_suara[$('#model').val()];
                msg.lang = 'id-ID';
                synth.speak(msg);
                tesSuara = synth.speak(msg);
                console.log(tesSuara);
            }
        }
    });

    // setInterval(() => { location.reload(); }, 50000));
    setInterval(() => {
        location.reload();
    }, 50000);
</script>

</html>
