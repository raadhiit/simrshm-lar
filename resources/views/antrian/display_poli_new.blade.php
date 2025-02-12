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
            <?php $arr_color = ['#e42d2d', 'yellow', '#329532', '#2e93bb', 'lightblue']; ?>
            <div class="row">
                @foreach ($antrian as $ant)
                    <div class="col-3 pb-5">
                        <table class="table table-borderless">
                            <thead>
                                <tr style="height: 150px;">
                                    <th scope="col"
                                        class="p-3 rounded-4 {{ $arr_color[$loop->iteration - 1] == 'yellow' ? 'text-black' : 'text-white' }}"
                                        style="vertical-align: middle;  background-color: <?php echo $arr_color[$loop->iteration - 1]; ?>;">
                                        <div class="h1">
                                            <?php
                                            switch ($ant->slug_poli) {
                                                case 'poli_penyakit_dalam':
                                                    echo $display == 1 ? 'Poli Interins 2' : 'Poli Internis 1';
                                                    break;
                                                case 'poli_paru':
                                                    echo 'Poli Paru';
                                                    break;
                                                case 'poli_tht':
                                                    echo 'Poli THT';
                                                    break;
                                                case 'poli_bedah_umum':
                                                    echo 'Poli Bedah';
                                                    break;
                                                case 'poli_jantung_dan_pembuluh_darah':
                                                    echo 'Poli Jantung';
                                                    break;
                                                case 'poli_mata':
                                                    echo 'Poli Mata';
                                                    break;
                                                case 'poli_syaraf':
                                                    echo 'Poli Saraf';
                                                    break;
                                                case 'poli_kandungan':
                                                    echo $display == 3 && $ant->poli_ke == 1 ? 'Poli Obgyn 1' : 'Poli Obgyn 2';
                                                    break;
                                                case 'poli_anak_spesialis':
                                                    echo $display == 3 && $ant->poli_ke == 1 ? 'Poli Anak 1' : 'Poli Anak 2';
                                                    break;
                                                case 'poli_rehab_medik':
                                                    echo 'Poli Rehab';
                                                    break;
                                                case 'poli_urologi':
                                                    echo 'Poli Urologi';
                                                    break;
                                                case 'poli_ortopedi':
                                                    echo 'Poli Orthopedi';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                            ?>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <div class="h1 p-3 border border-black rounded mt-3"
                                            id="panggilan_{{ $ant->slug_poli . '_' . $ant->id }}"
                                            style="min-height: 85px">
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        $mod_antrian = sizeof($ant->antrian) % 5;
                                        $jumlah_bagi_antrian = (int) floor(sizeof($ant->antrian) / 5);
                                        $arr_antrian = [];
                                        $count_antrian = 0;
                                        
                                        if ($jumlah_bagi_antrian > 0) {
                                            for ($i = 0; $i < $jumlah_bagi_antrian; $i++) {
                                                array_push($arr_antrian, []);
                                                for ($j = 0; $j < 5; $j++) {
                                                    array_push($arr_antrian[$i], $ant->antrian[$count_antrian * 5 + $j]);
                                                }
                                                $count_antrian++;
                                            }
                                        }
                                        
                                        if ($mod_antrian > 0) {
                                            array_push($arr_antrian, []);
                                            for ($j = 0; $j < $mod_antrian; $j++) {
                                                array_push($arr_antrian[$jumlah_bagi_antrian], $ant->antrian[$count_antrian * 5 + $j]);
                                            }
                                        }
                                        
                                        ?>
                                        <div class="shadow-sm p-3 mb-2 bg-body-tertiary rounded">
                                            <div id="carouselExampleSlidesOnly" class="carousel carousel-dark slide"
                                                data-bs-ride="carousel" style="min-height: 300px">
                                                <div class="carousel-indicators">
                                                    <?php for ($i = 0; $i < sizeof($arr_antrian); $i++) { ?>
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
                                                    <?php for ($i = 0; $i < sizeof($arr_antrian); $i++) { ?>
                                                    @if ($i == 0)
                                                        <div class="carousel-item active">
                                                        @else
                                                            <div class="carousel-item">
                                                    @endif
                                                    <table class="table table-bordered border-dark">
                                                        <tbody>
                                                            <?php for ($j = 0; $j < sizeof($arr_antrian[$i]); $j++) { ?>
                                                            <tr>
                                                                <td class="text-center h3">
                                                                    {{ $arr_antrian[$i][$j]->nomorantrean }}</td>
                                                            </tr>
                                                            <?php } ?>
                                                            <?php
																	if (sizeof($arr_antrian[$i]) < 5) {
																		for ($k = 0; $k < (5 - sizeof($arr_antrian[$i])); $k++) { ?>
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
                                        <div class="col text-end h4">Total Antrian : {{ sizeof($ant->antrian) }}
                                        </div>
                    </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
        </div>
        @endforeach
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

    // console.log('{{ env('PUSHER_APP_KEY') }}');

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
            // synth.cancel();
            console.log(data);
            if (data.bagian == 'poli') {
                var msg;
                var temp_pasien = data.pasien.toLowerCase();
                msg = new SpeechSynthesisUtterance('Nomor antrian. ' + data.nomor + '. ' + temp_pasien +
                    '. Silahkan menuju ' + data.loket);
                var slug_poli = data.jadwal != undefined ? data.jadwal != null ? data.jadwal.slug_poli : '' : '';
                var id_poli = data.jadwal != undefined ? data.jadwal != null ? data.jadwal.id : '' : '';
                $('#panggilan_' + slug_poli + '_' + id_poli).html(data.nomor);

                msg.rate = 0.9;
                msg.pitch = 1;
                // msg.voice = model_suara[$('#model').val()];
                msg.lang = 'id-ID';
                synth.speak(msg);
            }
        }
        setInterval(() => {
            location.reload();
        }, 50000);
    );
</script>

</html>
