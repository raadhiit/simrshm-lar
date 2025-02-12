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
    <div class="container-fluid" style="padding-top: 10px">

        <!-- mapping data dalam antrean  -->
        <?php
        $mod_dalam_antrian = sizeof($dalam_antrian) % 5;
        $jumlah_bagi_dalam_antrian = (int) floor(sizeof($dalam_antrian) / 5);
        $arr_dalam_antrian = [];
        $count_dalam_antrian = 0;
        
        if ($jumlah_bagi_dalam_antrian > 0) {
            for ($i = 0; $i < $jumlah_bagi_dalam_antrian; $i++) {
                array_push($arr_dalam_antrian, []);
                for ($j = 0; $j < 5; $j++) {
                    array_push($arr_dalam_antrian[$i], $dalam_antrian[$count_dalam_antrian * 5 + $j]);
                }
                $count_dalam_antrian++;
            }
        }
        
        if ($mod_dalam_antrian > 0) {
            array_push($arr_dalam_antrian, []);
            for ($j = 0; $j < $mod_dalam_antrian; $j++) {
                array_push($arr_dalam_antrian[$jumlah_bagi_dalam_antrian], $dalam_antrian[$count_dalam_antrian * 5 + $j]);
            }
        }
        
        ?>
        <!-- end mapping data dalam antrean  -->

        <!-- mapping data sedang diproses  -->
        <?php
        $mod_sedang_diproses = sizeof($sedang_diproses) % 5;
        $jumlah_bagi_sedang_diproses = (int) floor(sizeof($sedang_diproses) / 5);
        $arr_sedang_diproses = [];
        $count_sedang_diproses = 0;
        
        if ($jumlah_bagi_sedang_diproses > 0) {
            for ($i = 0; $i < $jumlah_bagi_sedang_diproses; $i++) {
                array_push($arr_sedang_diproses, []);
                for ($j = 0; $j < 5; $j++) {
                    array_push($arr_sedang_diproses[$i], $sedang_diproses[$count_sedang_diproses * 5 + $j]);
                }
                $count_sedang_diproses++;
            }
        }
        
        if ($mod_sedang_diproses > 0) {
            array_push($arr_sedang_diproses, []);
            for ($j = 0; $j < $mod_sedang_diproses; $j++) {
                array_push($arr_sedang_diproses[$jumlah_bagi_sedang_diproses], $sedang_diproses[$count_sedang_diproses * 5 + $j]);
            }
        }
        
        ?>

        <!-- end mapping data sedang diproses  -->

        <!-- mapping data siap diambil  -->
        <?php
        $mod_siap_diambil = sizeof($siap_diambil) % 5;
        $jumlah_bagi_siap_diambil = (int) floor(sizeof($siap_diambil) / 5);
        $arr_siap_diambil = [];
        $count_siap_diambil = 0;
        
        if ($jumlah_bagi_siap_diambil > 0) {
            for ($i = 0; $i < $jumlah_bagi_siap_diambil; $i++) {
                array_push($arr_siap_diambil, []);
                for ($j = 0; $j < 5; $j++) {
                    array_push($arr_siap_diambil[$i], $siap_diambil[$count_siap_diambil * 5 + $j]);
                }
                $count_siap_diambil++;
            }
        }
        
        if ($mod_siap_diambil > 0) {
            array_push($arr_siap_diambil, []);
            for ($j = 0; $j < $mod_siap_diambil; $j++) {
                array_push($arr_siap_diambil[$jumlah_bagi_siap_diambil], $siap_diambil[$count_siap_diambil * 5 + $j]);
            }
        }
        
        ?>

        <!-- end mapping data siap diambil  -->

        <div class="overflow-hidden text-center mb-3">
            <div class="row gy-5">
                <div class="col-3">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="p-3 bg-danger text-white rounded-4">
                                    <div class="h1">Antrian</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="shadow-sm p-3 bg-body-tertiary rounded mt-3" style="min-height: 370px">
                                        <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                            data-bs-ride="carousel" style="min-height: 300px">
                                            <div class="carousel-indicators">
                                                <?php for ($i = 0; $i < sizeof($arr_dalam_antrian); $i++) { ?>
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
                                                <?php for ($i = 0; $i < sizeof($arr_dalam_antrian); $i++) { ?>
                                                @if ($i == 0)
                                                    <div class="carousel-item active">
                                                    @else
                                                        <div class="carousel-item">
                                                @endif
                                                <table class="table table-bordered">
                                                    <tbody>

                                                        <?php for ($j = 0; $j < sizeof($arr_dalam_antrian[$i]); $j++) { ?>
                                                        <tr>
                                                            <td class="text-center h3">
                                                                {{ $arr_dalam_antrian[$i][$j]->nomorantrean }}</td>
                                                        </tr>
                                                        <?php } ?>
                                                        <?php
																	if (sizeof($arr_dalam_antrian[$i]) < 5) {
																		for ($k = 0; $k < (5 - sizeof($arr_dalam_antrian[$i])); $k++) { ?>
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
                                    <div class="col text-end h4">Total Antrian : {{ sizeof($dalam_antrian) }}</div>
                </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
        </div>
        <div class="col-3">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col" class="p-3 rounded-4" style="background-color: yellow">
                            <div class="h1">Diproses</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="shadow-sm p-3 bg-body-tertiary rounded mt-3" style="min-height: 370px">
                                <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                    data-bs-ride="carousel" style="min-height: 300px">
                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < sizeof($arr_sedang_diproses); $i++) { ?>
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
                                        <?php for ($i = 0; $i < sizeof($arr_sedang_diproses); $i++) { ?>
                                        @if ($i == 0)
                                            <div class="carousel-item active">
                                            @else
                                                <div class="carousel-item">
                                        @endif
                                        <table class="table table-bordered">
                                            <tbody>

                                                <?php for ($j = 0; $j < sizeof($arr_sedang_diproses[$i]); $j++) { ?>
                                                <tr>
                                                    <td class="text-center h3">
                                                        {{ $arr_sedang_diproses[$i][$j]->nomorantrean }}</td>
                                                    <td class="text-center h3">
                                                        {{ $arr_sedang_diproses[$i][$j]->jenis_obat == 1 ? 'Racikan' : ($arr_sedang_diproses[$i][$j]->jenis_obat == 0 ? 'Non Racikan' : '') }}
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <?php
																	if (sizeof($arr_sedang_diproses[$i]) < 5) {
																		for ($k = 0; $k < (5 - sizeof($arr_sedang_diproses[$i])); $k++) { ?>
                                                <tr>
                                                    <td>&nbsp;</td>
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
                            <div class="col text-end h4">Total Antrian : {{ sizeof($sedang_diproses) }}</div>
        </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <div class="col-3">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col" class="p-3 bg-success text-white rounded-4">
                        <div class="h1">Selesai</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="shadow-sm p-3 bg-body-tertiary rounded mt-3" style="min-height: 370px">
                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                data-bs-ride="carousel" style="min-height: 300px">
                                <div class="carousel-indicators">
                                    <?php for ($i = 0; $i < sizeof($arr_siap_diambil); $i++) { ?>
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
                                    <?php for ($i = 0; $i < sizeof($arr_siap_diambil); $i++) { ?>
                                    @if ($i == 0)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <table class="table table-bordered">
                                        <tbody>

                                            <?php for ($j = 0; $j < sizeof($arr_siap_diambil[$i]); $j++) { ?>
                                            <tr>
                                                <td class="text-center h3">
                                                    {{ $arr_siap_diambil[$i][$j]->nomorantrean }}
                                                </td>
                                                <td class="text-center h3">
                                                    {{ $arr_siap_diambil[$i][$j]->jenis_obat == 1 ? 'Racikan' : ($arr_siap_diambil[$i][$j]->jenis_obat == 0 ? 'Non Racikan' : '') }}
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php
																	if (sizeof($arr_siap_diambil[$i]) < 5) {
																		for ($k = 0; $k < (5 - sizeof($arr_siap_diambil[$i])); $k++) { ?>
                                            <tr>
                                                <td>&nbsp;</td>
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
                        <div class="col text-end h4">Total Antrian : {{ sizeof($siap_diambil) }}</div>
    </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <div class="col-3">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col" class="p-3 bg-primary text-white rounded-4">
                        <div class="h1">Panggilan</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="shadow-sm p-3 bg-body-tertiary rounded mt-3" style="min-height: 370px">
                            <div class="border border-2 border-dark rounded-3 row justify-content-center align-items-center"
                                style="min-height: 320px">
                                <div class="col h1" id="called_nomor">-</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

{{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    let synth = window.speechSynthesis;

    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        if (data.bagian == 'farmasi') {
            console.log(data);
            var temp_pasien = data.pasien.toLowerCase();
            var msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien +
                '. Silahkan menuju farmasi');
            msg.rate = 0.9;
            msg.pitch = 1;
            // msg.voice = model_suara[$('#model').val()];
            msg.lang = 'id-ID';
            synth.speak(msg);
            $('#called_nomor').html(data.nomor);
        }
    });

    setInterval(() => {
        location.reload();
    }, 120000);
</script> --}}

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    window.speechSynthesis.cancel();

    let synth = window.speechSynthesis;

    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        if (data.bagian == 'farmasi') {
            console.log(data);
            var temp_pasien = data.pasien.toLowerCase();
            var msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien +
                '. Silahkan menuju farmasi');
            msg.rate = 0.9;
            msg.pitch = 1;
            // msg.voice = model_suara[$('#model').val()];
            msg.lang = 'id-ID';
            synth.speak(msg);
            $('#called_nomor').html(data.nomor);
        }
    });

    setInterval(() => {
        location.reload();
    }, 120000);
</script>

</html>
