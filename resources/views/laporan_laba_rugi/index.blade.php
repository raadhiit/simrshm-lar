@extends('layouts.app')
@section('content')
    <style type="text/css" media="screen">
        .table-data {
            width: 100%;
        }

        td {
            width: 50% !important;
        }
    </style>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Laba Rugi</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    @if ($errors->any())
                        <div class="col-lg-12 mt-3">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="card-body" style="">
                        <form method="get" action="{{ route('laporan_laba_rugi.filter') }}">
                            <div class="col-lg-12 row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Dari Tanggal :</label>
                                        <input type="text" id="date_dari" name="tanggal_dari"
                                            class="yearpicker form-control col-lg-12" placeholder="Pilih Tanggal"
                                            value="{{ date('d-m-Y', strtotime($request['tanggal_dari'])) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Sampai Tanggal :</label>
                                        <input type="text" id="date_sampai" name="tanggal_sampai"
                                            class="yearpicker form-control col-lg-12" placeholder="Pilih Tanggal"
                                            value="{{ date('d-m-Y', strtotime($request['tanggal_sampai'])) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3" style="margin-top: 35px;">
                                    <button class="btn btn-primary" type="submit">
                                        Cari</button>
                                    <a onclick="downloadExcel()" class="btn btn-success" data-toggle="tooltip"
                                        data-placement="top" title="Download Data"
                                        style="margin-left:8px ; color:white; cursor:pointer;">Download Excel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <tbody>
                                @if (!isset($index))
                                    @inject('laporanLabaRugiService', 'App\Services\LaporanLabaRugiService')
                                    @php
                                        $pendapatanOperasional = $laporanLabaRugiService->getData('5', 'kredit', $request);
                                        $hargaPokok = $laporanLabaRugiService->getData('6', 'debet', $request);
                                        $labaKotor = $pendapatanOperasional - $hargaPokok;
                                        
                                        $bebanPemasaran = $laporanLabaRugiService->getData('7.1', 'debet', $request);
                                        $bebanAdministrasi = $laporanLabaRugiService->getData('7.2', 'debet', $request);
                                        $bebanUsaha = $bebanPemasaran + $bebanAdministrasi;
                                        
                                        $pendapatanNonOperasional = $laporanLabaRugiService->getData('8', 'kredit', $request);
                                        $biayaNonOperasional = $laporanLabaRugiService->getData('9', 'debet', $request);
                                        $bebanNonOperasional = $pendapatanNonOperasional + $biayaNonOperasional;
                                    @endphp
                                    <tr>
                                        <td>Pendapatan Operasional</td>
                                        <td>Rp.@currency($pendapatanOperasional)</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Pokok Pendapatan Operasional</td>
                                        <td>Rp.@currency($hargaPokok)</td>
                                    </tr>
                                    <tr style="background-color: #ebebeb;">
                                        <th>Laba Kotor</th>
                                        <th>Rp.@currency($labaKotor)</th>
                                    </tr>
                                    <tr>
                                        <td>Beban Pemasaran</td>
                                        <td>Rp.@currency($bebanPemasaran)</td>
                                    </tr>
                                    <tr>
                                        <td>Beban Administrasi Dan Umum</td>
                                        <td>Rp.@currency($bebanAdministrasi)</td>
                                    </tr>
                                    <tr style="background-color: #ebebeb;">
                                        <th>Beban Usaha</th>
                                        <th>Rp.@currency($bebanUsaha)</th>
                                    </tr>
                                    <tr>
                                        <td>Pendapatan Non Operasional</td>
                                        <td>Rp.@currency($pendapatanNonOperasional)</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Non Operasiolan</td>
                                        <td>Rp.@currency($biayaNonOperasional)</td>
                                    </tr>
                                    <tr style="background-color: #ebebeb;">
                                        <th>Pendapatan/(Beban) Non Operasional</th>
                                        <th>Rp.@currency($bebanNonOperasional)</th>
                                    </tr>
                                    <tr style="background-color: #ebebeb;">
                                        <th>Laba Bersih</th>
                                        <th>Rp.@currency($labaKotor - $bebanUsaha + $pendapatanNonOperasional)</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="text-center">Silahkan terapkan filter untuk menampilkan data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            var columnTotal = 0;

            $("#table_oksigen tr").each(function() {

                var columnTotalValue = $(this).find(".total").text();

                if (columnTotalValue.length > 0) {
                    columnTotal += hapusRibuan(columnTotalValue);
                }
            });

            $(".result-total").text(buatRibuan(columnTotal));
        });

        function hapusRibuan(param) {
            var inputValue = param;
            var parsedValue = parseFloat(inputValue.replace(/\./g, ''));
            return parsedValue;
        }

        function buatRibuan(param) {
            var inputValue = param;
            var parsedValue = inputValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return parsedValue;
        }

        $("#date_dari")
            .datepicker({
                format: "dd-mm-yyyy",
                startView: "day",
                minViewMode: "day",
                autoclose: true,
            });

        $("#date_sampai")
            .datepicker({
                format: "dd-mm-yyyy",
                startView: "day",
                minViewMode: "day",
                autoclose: true,
            });

        function downloadExcel() {
            var tanggalDari = $('input[name=tanggal_dari]').val();
            var tanggalSampai = $('input[name=tanggal_sampai]').val();
            //var carabayar = $('select[name=carabayar] option').filter(':selected').val();
            //var ruangan = $('select[name=ruangan] option').filter(':selected').val();
            var url = "{{ route('laporan_laba_rugi.download') }}?tanggal_dari=" + tanggalDari +
                "&tanggal_sampai=" + tanggalSampai; // + "&carabayar=" + carabayar + "&ruangan=" + ruangan + "";

            if (confirm("Apakah anda ingin download data dari tanggal " + tanggalDari + " sampai " + tanggalSampai + "?")) {
                window.location.href = url;
            } else {
                return false;
            }
        }
    </script>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.select').select2({
                    theme: 'bootstrap',
                    templateSelection: function(data) {
                        var $result = $(
                            '<span class="select2-selection__rendered pt-1">' +
                            data.text +
                            '</span>'
                        );

                        return $result;
                    }
                });
            });
        </script>
    @endpush
@endsection
