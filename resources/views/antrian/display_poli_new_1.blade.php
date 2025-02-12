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
            $antrian_paru = [];
            $antrian_tht = [];
            $antrian_bedah = [];
            $antrian_internis = [];
            
            $dokter_paru = [];
            $dokter_tht = [];
            $dokter_bedah = [];
            
            foreach ($dokter as $dok) {
                switch ($dok->slug_poli) {
                    case 'poli_paru':
                        array_push($dokter_paru, $dok->nama_dokter);
                        break;
                    case 'poli_tht':
                        array_push($dokter_tht, $dok->nama_dokter);
                        break;
                    case 'poli_bedah_umum':
                        array_push($dokter_bedah, $dok->nama_dokter);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            
            foreach ($antrian as $ant) {
                switch ($ant->slug_poli) {
                    case 'poli_paru':
                        array_push($antrian_paru, $ant);
                        break;
                    case 'poli_tht':
                        array_push($antrian_tht, $ant);
                        break;
                    case 'poli_bedah_umum':
                        array_push($antrian_bedah, $ant);
                        break;
                    case 'poli_penyakit_dalam':
                        if ($ant->namadokter == 'dr. MHD. RIVANDIO ARTIANDA SIMATUPANG, SP.PD') {
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

                {{-- Data columns --}}

                @php

                    $tbColumns = 2;
                    $antrianParu = sizeof($antrian_paru);
                    $antrianTht = sizeof($antrian_tht);
                    // $antrianBedah = sizeof($antrian_bedah);
                    // $antrianInternis = sizeof($antrian_internis);

                    if ($antrianParu > 0) {
                        $tbColumns++;
                    }
                    if ($antrianTht > 0) {
                        $tbColumns++;
                    }

                    $columns = 'col-md-12';

                    if ($tbColumns == 1) {
                        $columns = 'col-md-12';
                    } elseif ($tbColumns == 2) {
                        $columns = 'col-md-6';
                    } elseif ($tbColumns == 3) {
                        $columns = 'col-md-4';
                    } elseif ($tbColumns == 4) {
                        $columns = 'col-md-3';
                    }

                @endphp

                {{-- @if ($antrianParu == 0 && $antrianTht == 0)
                    <h3 class="text-center">Belum ada antrian</h3>
                @endif --}}

                <!-- Col Antrian Paru -->
                @if (sizeof($antrian_paru) > 0)
                    <div class="{{ $columns }} pb-5">
                        <table class="table">
                            <thead>
                                <tr style="height: 150px;">
                                    <th scope="col" class="p-3 text-white bg-danger" style="vertical-align: middle;">
                                        <div class="h1" style="line-height: 1;">
                                            Poli Paru<br>
                                            <span style="font-size: 16px;">
                                                @if (isset($dokter_paru[0]))
                                                    {{ $dokter_paru[0] }}
                                                @else
                                                    &nbsp;
                                                @endif
                                            </span><br>
                                            <span style="font-size: 16px;">
                                                @if (isset($dokter_paru[1]))
                                                    {{ $dokter_paru[1] }}
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
                                        <div class="h1 p-3" id="panggilan_poli_paru">
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid;"></td>
                                </tr>
                                <tr>
                                    <td>

                                        <div style="font-size: 40px; font-weight: bold;">

                                            <?php
                                            $mod_antrian_paru = sizeof($antrian_paru) % 5;
                                            $jumlah_bagi_antrian_paru = (int) floor(sizeof($antrian_paru) / 5);
                                            $arr_antrian_paru = [];
                                            $count_antrian_paru = 0;
                                            
                                            if ($jumlah_bagi_antrian_paru > 0) {
                                                for ($i = 0; $i < $jumlah_bagi_antrian_paru; $i++) {
                                                    array_push($arr_antrian_paru, []);
                                                    for ($j = 0; $j < 5; $j++) {
                                                        array_push($arr_antrian_paru[$i], $antrian_paru[$count_antrian_paru * 5 + $j]);
                                                    }
                                                    $count_antrian_paru++;
                                                }
                                            }
                                            
                                            if ($mod_antrian_paru > 0) {
                                                array_push($arr_antrian_paru, []);
                                                for ($j = 0; $j < $mod_antrian_paru; $j++) {
                                                    array_push($arr_antrian_paru[$jumlah_bagi_antrian_paru], $antrian_paru[$count_antrian_paru * 5 + $j]);
                                                }
                                            }
                                            
                                            ?>
                                        </div>

                                        {{-- list antrian --}}
                                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                                data-bs-ride="carousel" style="min-height: 250px">
                                                <div class="carousel-indicators">
                                                    <?php for ($i = 0; $i < sizeof($arr_antrian_paru); $i++) { ?>
                                                    @if ($i == 0)
                                                        <button type="button"
                                                            data-bs-target="#carouselExampleIndicators"
                                                            data-bs-slide-to="0" class="active" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                    @else
                                                        <button type="button"
                                                            data-bs-target="#carouselExampleIndicators"
                                                            data-bs-slide-to="{{ $i }}"
                                                            aria-label="Slide {{ $i + 1 }}"></button>
                                                    @endif
                                                    <?php } ?>
                                                </div>
                                                <div class="carousel-inner">
                                                    <?php for ($i = 0; $i < sizeof($arr_antrian_paru); $i++) { ?>
                                                    @if ($i == 0)
                                                        <div class="carousel-item active">
                                                        @else
                                                            <div class="carousel-item">
                                                    @endif
                                                    <table class="table table-bordered">
                                                        <tbody class="table-group-divider">
                                                            <?php for ($j = 0; $j < sizeof($arr_antrian_paru[$i]); $j++) { ?>
                                                            <tr>
                                                                <td class="text-center"
                                                                    style="font-size: 30px; font-weight: bold;">
                                                                    {{ $arr_antrian_paru[$i][$j]->nomorantrean }}</td>
                                                            </tr>
                                                            <?php } ?>
                                                            <?php
                                                                    if (sizeof($arr_antrian_paru[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_paru[$i])); $k++) { ?>
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
                                        {{-- end list antrian --}}
                                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_paru) }}</div>
                    </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
        </div>
        @endif

        <!-- End Col Antrian Paru -->

        <!-- Col Antrian THT -->
        {{-- Perubahaan saat antrian kosong --}}
        @if (sizeof($antrian_tht) > 0)
            <div class="{{ $columns }} pb-5">
                <table class="table">
                    <thead>
                        <tr style="height: 150px;">
                            <th scope="col" class="p-3 text-black bg-warning" style="vertical-align: middle;">
                                <div class="h1" style="line-height: 1;">
                                    Poli THT<br>
                                    <span style="font-size: 16px;">
                                        @if (isset($dokter_tht[0]))
                                            {{ $dokter_tht[0] }}
                                        @else
                                            &nbsp;
                                        @endif
                                    </span><br>
                                    <span style="font-size: 12px;">
                                        @if (isset($dokter_tht[1]))
                                            {{ $dokter_tht[1] }}
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
                                <div class="h1 p-3" id="panggilan_poli_tht">
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td>

                                {{-- Antrian yg sedang di layani --}}
                                <div style="font-size: 40px; font-weight: bold;">

                                    <?php
                                    $mod_antrian_tht = sizeof($antrian_tht) % 5;
                                    $jumlah_bagi_antrian_tht = (int) floor(sizeof($antrian_tht) / 5);
                                    $arr_antrian_tht = [];
                                    $count_antrian_tht = 0;
                                    
                                    if ($jumlah_bagi_antrian_tht > 0) {
                                        for ($i = 0; $i < $jumlah_bagi_antrian_tht; $i++) {
                                            array_push($arr_antrian_tht, []);
                                            for ($j = 0; $j < 5; $j++) {
                                                array_push($arr_antrian_tht[$i], $antrian_tht[$count_antrian_tht * 5 + $j]);
                                            }
                                            $count_antrian_tht++;
                                        }
                                    }
                                    
                                    if ($mod_antrian_tht > 0) {
                                        array_push($arr_antrian_tht, []);
                                        for ($j = 0; $j < $mod_antrian_tht; $j++) {
                                            array_push($arr_antrian_tht[$jumlah_bagi_antrian_tht], $antrian_tht[$count_antrian_tht * 5 + $j]);
                                        }
                                    }
                                    
                                    ?>
                                </div>

                                {{-- list antrian --}}
                                <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                    <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                        data-bs-ride="carousel" style="min-height: 250px">
                                        <div class="carousel-indicators">
                                            <?php for ($i = 0; $i < sizeof($arr_antrian_tht); $i++) { ?>
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
                                            <?php for ($i = 0; $i < sizeof($arr_antrian_tht); $i++) { ?>
                                            @if ($i == 0)
                                                <div class="carousel-item active">
                                                @else
                                                    <div class="carousel-item">
                                            @endif
                                            <table class="table table-bordered">
                                                <tbody class="table-group-divider">
                                                    <?php for ($j = 0; $j < sizeof($arr_antrian_tht[$i]); $j++) { ?>
                                                    <tr>
                                                        <td class="text-center"
                                                            style="font-size: 30px; font-weight: bold;">
                                                            {{ $arr_antrian_tht[$i][$j]->nomorantrean }}</td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php
                                                                    if (sizeof($arr_antrian_tht[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_tht[$i])); $k++) { ?>
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
                                {{-- end list antrian --}}
                                <div class="col text-end">Total Antrian : {{ sizeof($antrian_tht) }}</div>
            </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    @endif

    <!-- End Col Antrian THT -->

    <!-- Col Antrian Bedah -->
    {{-- @if (sizeof($antrian_bedah) > 0) --}}

    <div class="{{ $columns }} pb-5">
        <table class="table">
            <thead>
                <tr style="height: 150px;">
                    <th scope="col" class="p-3 text-white bg-success" style="vertical-align: middle;">
                        <div class="h1" style="line-height: 1;">
                            Poli Bedah<br>
                            <span style="font-size: 16px;">
                                @if (isset($dokter_bedah[0]))
                                    {{ $dokter_bedah[0] }}
                                @else
                                    &nbsp;
                                @endif
                            </span><br>
                            <span style="font-size: 16px;">
                                @if (isset($dokter_bedah[1]))
                                    {{ $dokter_bedah[1] }}
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
                        <div class="h1 p-3" id="panggilan_poli_bedah_umum">
                        </div>
                    </th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>
                        {{-- Antrian yg sedang di panggil --}}
                        <div style="font-size: 30px; font-weight: bold;">
                            <?php
                            $mod_antrian_bedah = sizeof($antrian_bedah) % 5;
                            $jumlah_bagi_antrian_bedah = (int) floor(sizeof($antrian_bedah) / 5);
                            $arr_antrian_bedah = [];
                            $count_antrian_bedah = 0;
                            
                            if ($jumlah_bagi_antrian_bedah > 0) {
                                for ($i = 0; $i < $jumlah_bagi_antrian_bedah; $i++) {
                                    array_push($arr_antrian_bedah, []);
                                    for ($j = 0; $j < 5; $j++) {
                                        array_push($arr_antrian_bedah[$i], $antrian_bedah[$count_antrian_bedah * 5 + $j]);
                                    }
                                    $count_antrian_bedah++;
                                }
                            }
                            
                            if ($mod_antrian_bedah > 0) {
                                array_push($arr_antrian_bedah, []);
                                for ($j = 0; $j < $mod_antrian_bedah; $j++) {
                                    array_push($arr_antrian_bedah[$jumlah_bagi_antrian_bedah], $antrian_bedah[$count_antrian_bedah * 5 + $j]);
                                }
                            }
                            
                            ?>
                        </div>

                        {{-- list antrian --}}
                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                data-bs-ride="carousel" style="min-height: 250px">
                                <div class="carousel-indicators">
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_bedah); $i++) { ?>
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
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_bedah); $i++) { ?>
                                    @if ($i == 0)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <table class="table table-bordered">
                                        <tbody class="table-group-divider">
                                            <?php for ($j = 0; $j < sizeof($arr_antrian_bedah[$i]); $j++) { ?>
                                            <tr>
                                                <td class="text-center" style="font-size: 30px; font-weight: bold;">
                                                    {{ $arr_antrian_bedah[$i][$j]->nomorantrean }}</td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                                                    if (sizeof($arr_antrian_bedah[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_bedah[$i])); $k++) { ?>
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
                        {{-- end list antrian --}}

                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_bedah) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    {{-- @endif --}}

    <!-- End Col Antrian Bedah -->

    <!-- Col Antrian Internis -->
    {{-- @if (sizeof($antrian_internis) > 0) --}}

    <div class="{{ $columns }} pb-5">
        <table class="table">
            <thead>
                <tr style="height: 150px;">
                    <th scope="col" class="p-3 text-white bg-primary" style="vertical-align: middle;">
                        <div class="h1" style="line-height: 1;">
                            Poli Internis 2<br>
                            <span style="font-size: 16px;">dr. MHD. RIVANDIO ARTIANDA SIMATUPANG, SP.PD</span><br>
                            <span style="font-size: 14px;">&nbsp;</span>
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

                        {{-- display yang sedang dipanggil --}}
                        <div style="font-size: 40px; font-weight: bold;">

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
                        </div>

                        {{-- list antrian --}}
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
                                                <td class="text-center" style="font-size: 30px; font-weight: bold;">
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
                        {{-- end list antrian --}}

                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_internis) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    {{-- @endif --}}

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    setInterval(() => {
        location.reload();
    }, 60000);
</script>
<script>
    window.speechSynthesis.cancel();

    let history = [];

    let synth = window.speechSynthesis;

    Pusher.logToConsole = true;

    console.log('{{ env('PUSHER_APP_KEY') }}');

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(data);
        if (data.bagian == 'poli') {
            if (data.jadwal.slug_poli == 'poli_paru' || data.jadwal.slug_poli == 'poli_tht' || data.jadwal
                .slug_poli == 'poli_bedah_umum' || (data.jadwal.slug_poli == 'poli_penyakit_dalam' && data
                    .jadwal.nama_dokter == 'dr. MHD. RIVANDIO ARTIANDA SIMATUPANG, SP.PD')) {
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
</script>

</html>
