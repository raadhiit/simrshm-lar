<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Display Aplicare</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .tabel_detail tr th {
            line-height: 3;
            font-size: 20px;
        }
    </style>
</head>

<body style="background-color: #EBEFF1">
    <div class="row" style="margin-left:0; width:100%;">
        <div class="col-lg-12 pt-4 pb-4">
            <h2 class="text-center">Ketersediaan Ruang Perawatan RUMAH SAKIT HARAPAN MULIA</h2>
        </div>
        {{-- @if (sizeof($beds) > 0)
            @php
                $middle = sizeof($beds) % 2 == 1 ? (int) round(sizeof($beds) / 3) + 1 : (int) round(sizeof($beds) / 3);
            @endphp
            @for ($i = 0; $i < sizeof($beds); $i++)
                <div class="col-md-4">
                    <div class="row"
                        style="width: 100%; margin-left: 0; background-color: #fff; box-shadow: 0px 15px 10px -15px #111; border-radius:10px; margin-bottom:20px;">
                        <div class="col-md-3"
                            style="background-color: #2395D4; border-radius:10px; display: flex; justify-content: center; align-items: center">
                            <span
                                style="font-size: 30px; text-align: center; color: #fff; font-weight: bold;">{{ $beds[$i]->namakelas }}<br>{{ $beds[$i]->total_tersedia }}</span>
                        </div>
                        <div class="col-md-9" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="h1 text-center mt-2 font-weight-bold">{{ $beds[$i]->namaruang }}</div>
                            <table class="tabel_detail" style="width: 100%;">
                                <tr>
                                    <th><i class="fa fa-bed"></i></th>
                                    <th class="pl-3">Total Tempat Tidur</th>
                                    <th style="text-align: right">{{ $beds[$i]->total }}</th>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-check"></i></th>
                                    <th class="pl-3">Tersedia</th>
                                    <th style="text-align: right">{{ $beds[$i]->total_tersedia }}</th>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-calendar"></i></th>
                                    <th class="pl-3">Last Update</th>
                                    <th style="text-align: right">
                                        {{ $beds[$i]->updated_at ? date('d-m-Y H:i', strtotime($beds[$i]->updated_at)) : '' }}
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endfor
        @endif --}}

        @if (sizeof($beds) > 0)
            @php
                $itemsPerSlide = 4; 
                $totalItems = sizeof($beds);
                $totalSlides = ceil($totalItems / $itemsPerSlide); 
            @endphp

            <div class="carousel-container" style="padding: 0 20px;">
                <div class="carousel-inner">
                    @for ($slide = 0; $slide < $totalSlides; $slide++)
                        <div class="carousel-item" style="display: {{ $slide === 0 ? 'flex' : 'none' }};">
                            <div class="row">
                                @for ($i = $slide * $itemsPerSlide; $i < min(($slide + 1) * $itemsPerSlide, $totalItems); $i++)
                                    <div class="col-12 col-md-6 mb-4 mt-3">
                                        <div class="row" style="width: 100%; margin-left: 0; background-color: #fff; box-shadow: 0px 15px 10px -15px #111; border-radius:10px;">
                                            <div class="col-2" style="background-color: #2395D4; border-radius:10px; display: flex; justify-content: center; align-items: center">
                                                <span style="font-size: 2rem; text-align: center; color: #fff; font-weight: bold;">
                                                    {{ $beds[$i]->namakelas }}<br>{{ $beds[$i]->total_tersedia }}
                                                </span>
                                            </div>
                                            <div class="col-10"
                                                style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                <div class="h1 text-center mt-2 font-weight-bold" style="font-size: 2.5rem">{{ $beds[$i]->namaruang }}</div>
                                                <table class="tabel_detail" style="width: 100%; font-size: 1.5rem;">
                                                    <tr>
                                                        <th><i class="fa fa-bed"></i></th>
                                                        <th class="pl-3" style="font-size: 2rem">Total Tempat Tidur
                                                        </th>
                                                        <th style="text-align: right; font-size: 36px;">
                                                            {{ $beds[$i]->total }}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th><i class="fa fa-check"></i></th>
                                                        <th class="pl-3" style="font-size: 2rem">Tersedia</th>
                                                        <th style="text-align: right; font-size: 36px;">
                                                            {{ $beds[$i]->total_tersedia }}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th><i class="fa fa-calendar"></i></th>
                                                        <th class="pl-3" style="font-size: 1.5rem">Last Update</th>
                                                        <th style="text-align: right; font-size: 20px;">
                                                            {{ $beds[$i]->updated_at ? date('d-m-Y H:i', strtotime($beds[$i]->updated_at)) : '' }}
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        @endif

    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            reload_page();
        }, 300000);

        let currentIndex = 0;
        const items = $(".carousel-item");
        const itemCount = items.length; 
        const intervalTime = 7000; 

        function showNextItem() {
            items.eq(currentIndex).hide(); 
            currentIndex = (currentIndex + 1) % itemCount; 
            items.eq(currentIndex).fadeIn(400); 
        }

        setInterval(showNextItem, intervalTime);

    });

    function reload_page() {
        window.location.reload(true);
    }
</script>

</html>
