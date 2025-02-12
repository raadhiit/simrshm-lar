<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Display Antrian Operasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --secondary-color: #6c757d;
        }

        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 1rem;
        }

        .queue-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-card {
            border-radius: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            margin-bottom: 1.5rem;
            color: white;
            transition: transform 0.3s ease;
        }

        .header-card h2 {
            margin: 0;
            font-size: calc(1.2rem + 1vw);
            font-weight: 600;
        }

        .queue-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            height: 100%;
            min-height: 400px;
        }

        .table-responsive {
            margin-bottom: 1rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            /* padding: 1rem; */
        }

        .table td {
            vertical-align: middle;
            padding: 0.5rem;
            /* font-size: calc(0.9rem + 0.3vw); */
        }

        .carousel {
            min-height: 320px;
        }

        .carousel-indicators {
            bottom: -50px;
        }

        .carousel-indicators button {
            background-color: var(--primary-color) !important;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .total-count {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6c757d;
            padding: 0.5rem 1rem;
            background: #f8f9fa;
            border-radius: 5px;
            display: inline-block;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .queue-section {
                margin-bottom: 2rem;
            }

            .table td {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="queue-container">
        {{-- <div class="row">
            <div class="col">
                <h1 class="text-center">Antrian Operasi</h1>
            </div>
        </div> --}}
        <div class="row g-4">
            <!-- Pending Operations -->
            <div class="col-12 col-lg-6">
                <div class="header-card bg-secondary">
                    <h2 class="text-center">Belum Terlaksana</h2>
                </div>
                <div class="queue-section">
                    <div id="carouselPending" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        @if (sizeOf($ant_belum) > 0)
                            <div class="carousel-indicators">
                                @for ($i = 0; $i < sizeOf($ant_belum); $i++)
                                    <button type="button" data-bs-target="#carouselPending"
                                        data-bs-slide-to="{{ $i }}"
                                        @if ($i == 0) class="active" aria-current="true" @endif
                                        aria-label="Slide {{ $i + 1 }}">
                                    </button>
                                @endfor
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Pasien</th>
                                        <th>Poli</th>
                                        {{-- <th>Jenis Tindakan</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="carousel-inner">
                            @foreach ($ant_belum as $ant_page)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                @foreach ($ant_page as $ant)
                                                    <tr>
                                                        <td style="font-size: 34px; font-weight: bold">
                                                            {{ $ant['nama'] }}</td>
                                                        <td style="font-size: 34px">{{ $ant['namapoli'] }}</td>
                                                        {{-- <td style="font-size: 30px">{{ $ant['jenistindakan'] }}</td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="total-count">
                            Total: {{ $total_ant_belum }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Completed Operations -->
            <div class="col-12 col-lg-6">
                <div class="header-card bg-success">
                    <h2 class="text-center">Sudah Terlaksana</h2>
                </div>
                <div class="queue-section">
                    <div id="carouselCompleted" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        @if (sizeOf($ant_sudah) > 0)
                            <div class="carousel-indicators">
                                @for ($i = 0; $i < sizeOf($ant_sudah); $i++)
                                    <button type="button" data-bs-target="#carouselCompleted"
                                        data-bs-slide-to="{{ $i }}"
                                        @if ($i == 0) class="active" aria-current="true" @endif
                                        aria-label="Slide {{ $i + 1 }}">
                                    </button>
                                @endfor
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Pasien</th>
                                        <th>Poli</th>
                                        {{-- <th>Jenis Tindakan</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="carousel-inner">
                            @foreach ($ant_sudah as $ant_page)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                @foreach ($ant_page as $ant)
                                                    <tr>
                                                        <td style="font-size: 34px; font-weight: bold">
                                                            {{ $ant['nama'] }}</td>
                                                        <td style="font-size: 34px">{{ $ant['namapoli'] }}</td>
                                                        {{-- <td style="font-size: 30px">{{ $ant['jenistindakan'] }}</td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="total-count">
                            Total: {{ $total_ant_sudah }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto refresh setiap 60 detik
        window.setTimeout(function() {
            window.location.reload();
        }, 60000);

        // Mengatur interval carousel
        const carousels = document.querySelectorAll('.carousel');
        carousels.forEach(carousel => {
            new bootstrap.Carousel(carousel, {
                interval: 5000,
                pause: 'hover'
            });
        });
    </script>
</body>

</html>
