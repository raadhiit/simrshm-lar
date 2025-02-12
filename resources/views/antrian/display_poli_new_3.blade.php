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
            $antrian_obgyn_1 = [];
            $antrian_obgyn_2 = [];
            $antrian_anak_1 = [];
            $antrian_anak_2 = [];
            
            foreach ($antrian as $ant) {
                switch ($ant->slug_poli) {
                    // case 'poli_kandungan':
                    //     if ($ant->namadokter == 'dr. Tanko Lotisna, Sp.OG' || $ant->namadokter == 'dr. SLAMET SUSANTO, SPOG') {
                    //         array_push($antrian_obgyn_1, $ant);
                    //     } elseif ($ant->namadokter == 'dr. ANAK AGUNG SAGUNG IMP, SP.OG' || $ant->namadokter == 'dr. RANDY FREDERICK HESSEL TUMBELAKA, SP.OG') {
                    //         array_push($antrian_obgyn_2, $ant);
                    //     }
                    //     break;
                    case 'poli_kandungan':
                        if ($ant->namadokter == 'dr. TANKO LOTISNA, SP.OG' || $ant->namadokter == 'dr. S. SUSANTO, Sp.OG') {
                            array_push($antrian_obgyn_1, $ant);
                        } elseif ($ant->namadokter == 'dr. ANAK AGUNG SAGUNG IMP, SP.OG' || $ant->namadokter == 'dr. RANDY FREDERICK HESSEL TUMBELAKA, SP.OG') {
                            array_push($antrian_obgyn_2, $ant);
                        }
                        break;
                    case 'poli_anak_spesialis':
                        if ($ant->namadokter == 'dr. DIAN AYUNINGTYAS, SPA') {
                            array_push($antrian_anak_1, $ant);
                        } elseif ($ant->namadokter == 'dr. Ramadianty, Sp.A' || $ant->namadokter == 'dr. SILVIA FEBRIANTI SUGIARTO, SP.A') {
                            array_push($antrian_anak_2, $ant);
                        }
                        break;
                    default:
                        break;
                }
            }
            
            ?>
            <div class="row">

                <!-- Col Antrian Obgyn 1 -->
                <div class="col-3 pb-5">
                    <table class="table">
                        <thead>
                            <tr style="height: 150px;">
                                <th scope="col" class="p-3 text-white bg-danger" style="vertical-align: middle;">
                                    <div class="h1 pb-4" style="line-height: 1;">
                                        Poli Obgyn 1<br>
                                    </div>
                                    <br>
                                    <div class="h1 pb-4">
                                        <span style="font-size:24px;">dr. Tanko Lotisna, Sp.OG</span><br>
                                        {{-- <span style="font-size:12px;">dr. SLAMET SUSANTO, SPOG</span> --}}
                                        <span style="font-size:24px;">dr. S SUSANTO, SPOG</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div class="h1 p-3" id="panggilan_poli_kandungan_satu">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;"></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $mod_antrian_obgyn_1 = sizeof($antrian_obgyn_1) % 5;
                                    $jumlah_bagi_antrian_obgyn_1 = (int) floor(sizeof($antrian_obgyn_1) / 5);
                                    $arr_antrian_obgyn_1 = [];
                                    $count_antrian_obgyn_1 = 0;
                                    
                                    if ($jumlah_bagi_antrian_obgyn_1 > 0) {
                                        for ($i = 0; $i < $jumlah_bagi_antrian_obgyn_1; $i++) {
                                            array_push($arr_antrian_obgyn_1, []);
                                            for ($j = 0; $j < 5; $j++) {
                                                array_push($arr_antrian_obgyn_1[$i], $antrian_obgyn_1[$count_antrian_obgyn_1 * 5 + $j]);
                                            }
                                            $count_antrian_obgyn_1++;
                                        }
                                    }
                                    
                                    if ($mod_antrian_obgyn_1 > 0) {
                                        array_push($arr_antrian_obgyn_1, []);
                                        for ($j = 0; $j < $mod_antrian_obgyn_1; $j++) {
                                            array_push($arr_antrian_obgyn_1[$jumlah_bagi_antrian_obgyn_1], $antrian_obgyn_1[$count_antrian_obgyn_1 * 5 + $j]);
                                        }
                                    }
                                    
                                    ?>
                                    <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                        <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                            data-bs-ride="carousel" style="min-height: 250px">
                                            <div class="carousel-indicators">
                                                <?php for ($i = 0; $i < sizeof($arr_antrian_obgyn_1); $i++) { ?>
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
                                                <?php for ($i = 0; $i < sizeof($arr_antrian_obgyn_1); $i++) { ?>
                                                @if ($i == 0)
                                                    <div class="carousel-item active">
                                                    @else
                                                        <div class="carousel-item">
                                                @endif
                                                <table class="table table-bordered">
                                                    <tbody class="table-group-divider">
                                                        <?php for ($j = 0; $j < sizeof($arr_antrian_obgyn_1[$i]); $j++) { ?>
                                                        <tr>
                                                            <td class="text-center" style="font-size: 32px;">
                                                                {{ $arr_antrian_obgyn_1[$i][$j]->nomorantrean }}</td>
                                                        </tr>
                                                        <?php } ?>
                                                        <?php
                                                                    if (sizeof($arr_antrian_obgyn_1[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_obgyn_1[$i])); $k++) { ?>
                                                        <tr>
                                                            <td style="font-size: 32px;">&nbsp;</td>
                                                        </tr>
                                                        <?php }
                                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col text-end">Total Antrian : {{ sizeof($antrian_obgyn_1) }}</div>
                </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
        </div>
        <!-- End Col Antrian Obgyn 1 -->

        <!-- Col Antrian Obgyn 2 -->
        <div class="col-3 pb-5">
            <table class="table">
                <thead>
                    <tr style="height: 150px;">
                        <th scope="col" class="p-3 text-black bg-warning" style="vertical-align: middle;">
                            <div class="h1 pb-4" style="line-height: 1;">
                                Poli Obgyn 2<br>
                            </div>
                            <div class="h1" style="line-height: 0.9;">
                                <span style="font-size: 20px;">dr. ANAK AGUNG SAGUNG IMP, SP.OG</span><br>
                                <span style="font-size: 20px;">dr. RANDY FREDERICK HESSEL TUMBELAKA, SP.OG</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <div class="h1 p-3" id="panggilan_poli_kandungan_dua">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid;"></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $mod_antrian_obgyn_2 = sizeof($antrian_obgyn_2) % 5;
                            $jumlah_bagi_antrian_obgyn_2 = (int) floor(sizeof($antrian_obgyn_2) / 5);
                            $arr_antrian_obgyn_2 = [];
                            $count_antrian_obgyn_2 = 0;
                            
                            if ($jumlah_bagi_antrian_obgyn_2 > 0) {
                                for ($i = 0; $i < $jumlah_bagi_antrian_obgyn_2; $i++) {
                                    array_push($arr_antrian_obgyn_2, []);
                                    for ($j = 0; $j < 5; $j++) {
                                        array_push($arr_antrian_obgyn_2[$i], $antrian_obgyn_2[$count_antrian_obgyn_2 * 5 + $j]);
                                    }
                                    $count_antrian_obgyn_2++;
                                }
                            }
                            
                            if ($mod_antrian_obgyn_2 > 0) {
                                array_push($arr_antrian_obgyn_2, []);
                                for ($j = 0; $j < $mod_antrian_obgyn_2; $j++) {
                                    array_push($arr_antrian_obgyn_2[$jumlah_bagi_antrian_obgyn_2], $antrian_obgyn_2[$count_antrian_obgyn_2 * 5 + $j]);
                                }
                            }
                            ?>
                            <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                    data-bs-ride="carousel" style="min-height: 250px">
                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < sizeof($arr_antrian_obgyn_2); $i++) { ?>
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
                                        <?php for ($i = 0; $i < sizeof($arr_antrian_obgyn_2); $i++) { ?>
                                        @if ($i == 0)
                                            <div class="carousel-item active">
                                            @else
                                                <div class="carousel-item">
                                        @endif
                                        <table class="table table-bordered">
                                            <tbody class="table-group-divider">
                                                <?php for ($j = 0; $j < sizeof($arr_antrian_obgyn_2[$i]); $j++) { ?>
                                                <tr>
                                                    <td class="text-center" style="font-size: 32px;">
                                                        {{ $arr_antrian_obgyn_2[$i][$j]->nomorantrean }}</td>
                                                </tr>
                                                <?php } ?>
                                                <?php
                                                                    if (sizeof($arr_antrian_obgyn_2[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_obgyn_2[$i])); $k++) { ?>
                                                <tr>
                                                    <td style="font-size: 32px;">&nbsp;</td>
                                                </tr>
                                                <?php }
                                                                    } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col text-end">Total Antrian : {{ sizeof($antrian_obgyn_2) }}</div>
        </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Obgyn 2 -->

    <!-- Col Antrian Anak 1 -->
    <div class="col-3 pb-5">
        <table class="table">
            <thead>
                <tr style="height: 150px;">
                    <th scope="col" class="p-3 text-white bg-success" style="vertical-align: middle;">
                        <div class="h1 pb-4" style="line-height: 1;">
                            Poli Anak 1<br>
                        </div>
                        <div class="h1 pb-4 pt-4">
                            <span style="font-size:20px;">dr. DIAN AYUNINGTYAS, SPA</span> <br>
                            <span style="font-size:18px;">dr. SILVIA FEBRIANTI SUGIARTO, SP.A</span>
                            <span style="font-size:12px;">&nbsp;</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <div class="h1 p-3" id="panggilan_poli_anak_spesialis_satu">
                        </div>
                    </th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $mod_antrian_anak_1 = sizeof($antrian_anak_1) % 5;
                        $jumlah_bagi_antrian_anak_1 = (int) floor(sizeof($antrian_anak_1) / 5);
                        $arr_antrian_anak_1 = [];
                        $count_antrian_anak_1 = 0;
                        
                        if ($jumlah_bagi_antrian_anak_1 > 0) {
                            for ($i = 0; $i < $jumlah_bagi_antrian_anak_1; $i++) {
                                array_push($arr_antrian_anak_1, []);
                                for ($j = 0; $j < 5; $j++) {
                                    array_push($arr_antrian_anak_1[$i], $antrian_anak_1[$count_antrian_anak_1 * 5 + $j]);
                                }
                                $count_antrian_anak_1++;
                            }
                        }
                        
                        if ($mod_antrian_anak_1 > 0) {
                            array_push($arr_antrian_anak_1, []);
                            for ($j = 0; $j < $mod_antrian_anak_1; $j++) {
                                array_push($arr_antrian_anak_1[$jumlah_bagi_antrian_anak_1], $antrian_anak_1[$count_antrian_anak_1 * 5 + $j]);
                            }
                        }
                        
                        ?>
                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                data-bs-ride="carousel" style="min-height: 250px">
                                <div class="carousel-indicators">
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_anak_1); $i++) { ?>
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
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_anak_1); $i++) { ?>
                                    @if ($i == 0)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <table class="table table-bordered">
                                        <tbody class="table-group-divider">
                                            <?php for ($j = 0; $j < sizeof($arr_antrian_anak_1[$i]); $j++) { ?>
                                            <tr>
                                                <td class="text-center" style="font-size: 32px;">
                                                    {{ $arr_antrian_anak_1[$i][$j]->nomorantrean }}</td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                                                    if (sizeof($arr_antrian_anak_1[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_anak_1[$i])); $k++) { ?>
                                            <tr>
                                                <td style="font-size: 32px;">&nbsp;</td>
                                            </tr>
                                            <?php }
                                                                    } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_anak_1) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Anak 1 -->

    <!-- Col Antrian Anak 2 -->
    <div class="col-3 pb-5">
        <table class="table">
            <thead>
                <tr style="height: 150px;">
                    <th scope="col" class="p-3 text-white bg-primary" style="vertical-align: middle;">
                        <div class="h1" style="line-height: 1.5; margin-top: -10px; padding-bottom: 1.6em;">
                            Poli Anak 2<br>
                        </div>
                        <div class="h1 pb-5">
                            <span style="font-size:24px;">dr. Ramadianty, Sp.A</span><br>
                            {{-- <span style="font-size:18px;">dr. SILVIA FEBRIANTI SUGIARTO, SP.A</span> --}}
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <div class="h1 p-3" id="panggilan_poli_anak_spesialis_dua">
                        </div>
                    </th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $mod_antrian_anak_2 = sizeof($antrian_anak_2) % 5;
                        $jumlah_bagi_antrian_anak_2 = (int) floor(sizeof($antrian_anak_2) / 5);
                        $arr_antrian_anak_2 = [];
                        $count_antrian_anak_2 = 0;
                        
                        if ($jumlah_bagi_antrian_anak_2 > 0) {
                            for ($i = 0; $i < $jumlah_bagi_antrian_anak_2; $i++) {
                                array_push($arr_antrian_anak_2, []);
                                for ($j = 0; $j < 5; $j++) {
                                    array_push($arr_antrian_anak_2[$i], $antrian_anak_2[$count_antrian_anak_2 * 5 + $j]);
                                }
                                $count_antrian_anak_2++;
                            }
                        }
                        
                        if ($mod_antrian_anak_2 > 0) {
                            array_push($arr_antrian_anak_2, []);
                            for ($j = 0; $j < $mod_antrian_anak_2; $j++) {
                                array_push($arr_antrian_anak_2[$jumlah_bagi_antrian_anak_2], $antrian_anak_2[$count_antrian_anak_2 * 5 + $j]);
                            }
                        }
                        
                        ?>
                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                data-bs-ride="carousel" style="min-height: 250px">
                                <div class="carousel-indicators">
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_anak_2); $i++) { ?>
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
                                    <?php for ($i = 0; $i < sizeof($arr_antrian_anak_2); $i++) { ?>
                                    @if ($i == 0)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <table class="table table-bordered">
                                        <tbody class="table-group-divider">
                                            <?php for ($j = 0; $j < sizeof($arr_antrian_anak_2[$i]); $j++) { ?>
                                            <tr>
                                                <td class="text-center" style="font-size: 32px;">
                                                    {{ $arr_antrian_anak_2[$i][$j]->nomorantrean }}</td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                                                    if (sizeof($arr_antrian_anak_2[$i]) < 5) {
                                                                        for ($k = 0; $k < (5 - sizeof($arr_antrian_anak_2[$i])); $k++) { ?>
                                            <tr>
                                                <td style="font-size: 32px;">&nbsp;</td>
                                            </tr>
                                            <?php }
                                                                    } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col text-end">Total Antrian : {{ sizeof($antrian_anak_2) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <!-- End Col Antrian Anak 2 -->

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
            if (data.jadwal.slug_poli == 'poli_anak_spesialis' || data.jadwal.slug_poli == 'poli_kandungan') {
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

                if (data.jadwal.nama_dokter == 'dr. Tanko Lotisna, Sp.OG' || data.jadwal.nama_dokter ==
                    'dr. SLAMET SUSANTO, SPOG') {
                    $('#panggilan_' + slug_poli + '_satu').html(data.nomor);
                } else if (data.jadwal.nama_dokter == 'dr. ANAK AGUNG SAGUNG IMP, SP.OG' || data.jadwal
                    .nama_dokter == 'dr. RANDY FREDERICK HESSEL TUMBELAKA, SP.OG') {
                    $('#panggilan_' + slug_poli + '_dua').html(data.nomor);
                } else if (data.jadwal.nama_dokter == 'dr. DIAN AYUNINGTYAS, SPA') {
                    $('#panggilan_' + slug_poli + '_satu').html(data.nomor);
                } else if (data.jadwal.nama_dokter == 'dr. Ramadianty, Sp.A' || data.jadwal.nama_dokter ==
                    'dr. SILVIA FEBRIANTI SUGIARTO, SP.A') {
                    $('#panggilan_' + slug_poli + '_dua').html(data.nomor);
                }
            }
        }
    });
</script>

</html>
