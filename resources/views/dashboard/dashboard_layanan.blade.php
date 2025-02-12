@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Layanan</h1>
        </div>

        <div class="section-body">
            <div class="card pt-4">
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <h6>Filter :</h6>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <input type="date" id="date_from" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <input type="date" id="date_to" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group" style="text-align: center;">
                            <button class="btn btn-success" onclick="tampilkan()">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" id="kunjungan_total"></div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" id="kunjungan_rj"></div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" id="kunjungan_igd"></div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" id="kunjungan_ri"></div>
            </div>
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-lg-8 pl-0">
                    <div class="card p-3">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-4 pl-0">
                                <div class="form-group">
                                    <select id="filter_cara_bayar" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="rawat jalan">Rawat Jalan</option>
                                        <option value="rawat inap">Rawat Inap</option>
                                        <option value="igd">IGD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 pr-0 pt-2">
                                <h5>Kunjungan Berdasarkan Jenis Pasien</h5>
                            </div>
                        </div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-lg-6 pl-0">
                            <div class="card p-3">
                                <h5>10 Tertinggi Kecamatan</h5>
                                <canvas id="chart_tertinggi_kecamatan" width="400" height="410"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6 pr-0">
                            <div class="card p-3">
                                <h5>10 Terendah Kecamatan</h5>
                                <canvas id="chart_terendah_kecamatan" width="400" height="410"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pr-0">
                    <div class="card p-3">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-4 pl-0">
                                <div class="form-group">
                                    <select id="filter_jenis_kelamin" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="rawat jalan">Rawat Jalan</option>
                                        <option value="rawat inap">Rawat Inap</option>
                                        <option value="igd">IGD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 pr-0 pt-1">
                                <h5 style="font-size: 15px;">Kunjungan Berdasarkan Jenis Kelamin</h5>
                            </div>
                        </div>
                        <div style="width: 100%; height: 40px; position: absolute; top: 65%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999" id="label_center_jenis_kelamin">
                        </div>
                        <canvas id="chart_berdasarkan_jenis_kelamin" width="50" height="50"></canvas>
                    </div>
                    <div class="card p-3">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-4 pl-0">
                                <div class="form-group">
                                    <select id="filter_baru_lama" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="rawat jalan">Rawat Jalan</option>
                                        <option value="rawat inap">Rawat Inap</option>
                                        <option value="igd">IGD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 pr-0 pt-1">
                                <h5 style="font-size: 15px;">Kunjungan Berdasarkan Baru Lama</h5>
                            </div>
                        </div>
                        <div style="width: 100%; height: 40px; position: absolute; top: 65%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999" id="label_center_baru_lama">
                        </div>
                        <canvas id="chart_berdasarkan_baru_lama" width="30" height="20"></canvas>
                    </div>
                </div>
            </div>
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-lg-12 pl-0 pr-0">
                    <div class="card p-3">
                        <h5>Kunjungan Rawat Jalan</h5>
                        <canvas id="chart_kunjungan_rawat_jalan" width="800" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-lg-12 pl-0 pr-0">
                    <div class="card p-3">
                        <h5>Kunjungan Rawat Inap</h5>
                        <canvas id="chart_kunjungan_rawat_inap" width="800" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-lg-12 pl-0 pr-0">
                    <div class="card p-3">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-2">
                                <select id="filter_diagnosa" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="rawat jalan">Rawat Jalan</option>
                                    <option value="rawat inap">Rawat Inap</option>
                                    <option value="igd">IGD</option>
                                </select>
                            </div>
                            <div class="col-lg-10 pt-2">
                                <h5>10 Tertinggi Diagnosa</h5>
                            </div>
                        </div>
                        <canvas id="chart_tertinggi_diagnosa" width="800" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="col-lg-12 pl-0 pr-0">
                    <div class="card p-3">
                        <h5>Ketersediaan Kamar</h5>
                        <canvas id="chart_ketersediaan_kamar" width="800" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>
    function chart_berdasarkan_jenis_kelamin(data) {
        var label = [];
        var deta = [];
        var bg_color = [];
        var border_color = [];
        var total = 0;

        for (let i = 0; i < data.length; i++) {
            if (data[i].kelamin == 0) {
                label.push('Laki-Laki');
            } else if (data[i].kelamin == 1) {
                label.push('Perempuan');
            }
            deta.push(data[i].total);
            bg_color.push('#F4D13B');
            border_color.push('#3ABAF4');
            total += data[i].total;
        }

        $('#label_center_jenis_kelamin').html('Total : ' + total);

        let chartStatus = Chart.getChart("chart_berdasarkan_jenis_kelamin"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }

        const ctx = document.getElementById('chart_berdasarkan_jenis_kelamin');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    label: 'Total',
                    data: deta,
                    backgroundColor: [
                        '#F4D13B',
                        '#3ABAF4'
                    ],
                    hoverOffset: 4,
                    datalabels: {
                        color: '#fff',
                    }
                }]
            },
            plugins: [ChartDataLabels]
        });
    }

    function chart_berdasarkan_baru_lama(data) {
        var label = [];
        var deta = [];
        var bg_color = [];
        var border_color = [];
        var total = 0;

        for (let i = 0; i < data.length; i++) {
            if (data[i].barulama == 0) {
                label.push('Lama');
            } else if (data[i].barulama == 1) {
                label.push('Baru');
            }
            deta.push(data[i].total);
            total += data[i].total;
        }

        $('#label_center_baru_lama').html('Total : ' + total);

        let chartStatus = Chart.getChart("chart_berdasarkan_baru_lama"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }

        const ctx = document.getElementById('chart_berdasarkan_baru_lama');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    label: 'Total',
                    data: deta,
                    backgroundColor: [
                        '#F4D13B',
                        '#3ABAF4'
                    ],
                    hoverOffset: 4,
                    datalabels: {
                        color: '#fff',
                    }
                }]
            },
            plugins: [ChartDataLabels]
        });
    }

    function chart_kunjungan_tertinggi_kecamatan(data) {
        if (data == null) {
            $('#chart_tertinggi_kecamatan').html('Tidak ada data');
        } else {

            var label = [];
            var deta = [];
            var bg_color = [];
            var border_color = [];

            for (let i = 0; i < data.length; i++) {
                label.push(data[i].kecamatan);
                deta.push(data[i].total);
                bg_color.push('#3ABAF4');
                border_color.push('#3ABAF4');
            }

            let chartStatus = Chart.getChart("chart_tertinggi_kecamatan"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }

            const ctx = document.getElementById('chart_tertinggi_kecamatan');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        data: deta,
                        backgroundColor: bg_color,
                        borderColor: border_color,
                        borderWidth: 1,
                        datalabels: {
                            color: '#fff',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
        }
    }

    function chart_kunjungan_terendah_kecamatan(data) {
        if (data == null) {
            $('#chart_terendah_kecamatan').html('Tidak ada data');
        } else {

            var label = [];
            var deta = [];
            var bg_color = [];
            var border_color = [];

            for (let i = 0; i < data.length; i++) {
                label.push(data[i].kecamatan);
                deta.push(data[i].total);
                bg_color.push('#3ABAF4');
                border_color.push('#3ABAF4');
            }

            let chartStatus = Chart.getChart("chart_terendah_kecamatan"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }

            const ctx = document.getElementById('chart_terendah_kecamatan');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        data: deta,
                        backgroundColor: bg_color,
                        borderColor: border_color,
                        borderWidth: 1,
                        datalabels: {
                            color: '#fff',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
        }
    }

    function chart_berdasarkan_cara_bayar(data) {
        if (data == null) {
            $('#myChart').html('Tidak ada data');
        } else {

            var label = [];
            var deta = [];
            var bg_color = [];
            var border_color = [];

            for (let i = 0; i < data.length; i++) {
                label.push(data[i].carabayar);
                deta.push(data[i].total);
                bg_color.push('#3ABAF4');
                border_color.push('#3ABAF4');
            }

            let chartStatus = Chart.getChart("myChart"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }

            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        data: deta,
                        backgroundColor: bg_color,
                        borderColor: border_color,
                        borderWidth: 1,
                        datalabels: {
                            color: '#fff',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
        }
    }

    function chart_kunjungan_rawat_jalan(data) {
        if (data == null) {
            $('#chart_kunjungan_rawat_jalan').html('Tidak ada data');
        } else {

            var label = [];
            var deta = [];
            var bg_color = [];
            var border_color = [];

            for (let i = 0; i < data.length; i++) {
                label.push(data[i].jenislayanan);
                deta.push(data[i].total);
                bg_color.push('#3ABAF4');
                border_color.push('#3ABAF4');
            }

            let chartStatus = Chart.getChart("chart_kunjungan_rawat_jalan"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }

            const ctx = document.getElementById('chart_kunjungan_rawat_jalan');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        data: deta,
                        backgroundColor: bg_color,
                        borderColor: border_color,
                        borderWidth: 1,
                        datalabels: {
                            color: '#fff',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
        }
    }

    function chart_ketersediaan_kamar(data) {
        if (data.length < 1) {
            $('#chart_ketersediaan_kamar').html('Tidak ada data');
        } else {
            var label = [];
            var deta = [];
            var bg_color = [];
            var border_color = [];

            for (let i = 0; i < data.length; i++) {
                label.push(data[i].namaruang);
                deta.push(data[i].tersedia);
                bg_color.push('#3ABAF4');
                border_color.push('#3ABAF4');
            }

            let chartStatus = Chart.getChart("chart_ketersediaan_kamar"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }

            const ctx = document.getElementById('chart_ketersediaan_kamar');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        data: deta,
                        backgroundColor: bg_color,
                        borderColor: border_color,
                        borderWidth: 1,
                        datalabels: {
                            color: '#fff',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
        }
    }

    function chart_kunjungan_rawat_inap(data) {
        if (data == null) {
            $('#chart_kunjungan_rawat_inap').html('Tidak ada data');
        } else {

            var label = [];
            var deta = [];
            var bg_color = [];
            var border_color = [];

            for (let i = 0; i < data.length; i++) {
                label.push(data[i].kamar_inap);
                deta.push(data[i].total);
                bg_color.push('#3ABAF4');
                border_color.push('#3ABAF4');
            }

            let chartStatus = Chart.getChart("chart_kunjungan_rawat_inap"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }

            const ctx = document.getElementById('chart_kunjungan_rawat_inap');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        data: deta,
                        backgroundColor: bg_color,
                        borderColor: border_color,
                        borderWidth: 1,
                        datalabels: {
                            color: '#fff',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
        }
    }

    function chart_tertinggi_diagnosa(data) {
        if (data == null) {
            $('#chart_tertinggi_diagnosa').html('Tidak ada data');
        } else {

            var label = [];
            var deta = [];
            var bg_color = [];
            var border_color = [];

            for (let i = 0; i < data.length; i++) {
                label.push(data[i].nama_icd);
                deta.push(data[i].total);
                bg_color.push('#3ABAF4');
                border_color.push('#3ABAF4');
            }

            let chartStatus = Chart.getChart("chart_tertinggi_diagnosa"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }

            const ctx = document.getElementById('chart_tertinggi_diagnosa');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        data: deta,
                        backgroundColor: bg_color,
                        borderColor: border_color,
                        borderWidth: 1,
                        datalabels: {
                            color: '#fff',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
        }
    }

    var spin = '<div class="spinner-grow" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div>';

    function elemen_kunjungan_total(param) {
        return '<div class="card card-statistic-1">' +
            '<div class="card-icon bg-info">' +
            '<i class="far fa-user"></i>' +
            '</div>' +
            '<div class="card-wrap">' +
            '<div class="card-header">' +
            '<h4>Kunjungan Total</h4>' +
            '</div>' +
            '<div class="card-body">' +
            param +
            '</div>' +
            '</div>' +
            '</div>';
    }

    function elemen_kunjungan_rj(param) {
        return '<div class="card card-statistic-1">' +
            '<div class="card-icon bg-info">' +
            '<i class="far fa-user"></i>' +
            '</div>' +
            '<div class="card-wrap">' +
            '<div class="card-header">' +
            '<h4>Kunjungan Rawat Jalan</h4>' +
            '</div>' +
            '<div class="card-body">' +
            param +
            '</div>' +
            '</div>' +
            '</div>';
    }

    function elemen_kunjungan_igd(param) {
        return '<div class="card card-statistic-1">' +
            '<div class="card-icon bg-info">' +
            '<i class="far fa-user"></i>' +
            '</div>' +
            '<div class="card-wrap">' +
            '<div class="card-header">' +
            '<h4>Kunjungan IGD</h4>' +
            '</div>' +
            '<div class="card-body">' +
            param +
            '</div>' +
            '</div>' +
            '</div>';
    }

    function elemen_kunjungan_ri(param) {
        return '<div class="card card-statistic-1">' +
            '<div class="card-icon bg-info">' +
            '<i class="far fa-user"></i>' +
            '</div>' +
            '<div class="card-wrap">' +
            '<div class="card-header">' +
            '<h4>Kunjungan Rawat Inap</h4>' +
            '</div>' +
            '<div class="card-body">' +
            param +
            '</div>' +
            '</div>' +
            '</div>';
    }

    $(document).ready(function() {
        get_jumlah_kunjungan();
        get_kunjungan_berdasarkan_cara_bayar();
        get_kunjungan_berdasarkan_jenis_kelamin();
        get_kunjungan_tertinggi_kecamatan();
        get_kunjungan_terendah_kecamatan();
        get_kunjungan_berdasarkan_baru_lama('');
        get_kunjungan_rawat_jalan();
        get_ketersediaan_kamar();
        get_kunjungan_rawat_inap();
        get_kunjungan_tertinggi_diagnosa('');
    });

    function tampilkan() {
        if ($('#date_from').val() == '') {
            alert('Pilih tanggal awal dahulu');
        } else if ($('#date_to').val() == '') {
            alert('Pilih tanggal akhir dahulu');
        } else {
            get_jumlah_kunjungan();
            get_kunjungan_berdasarkan_cara_bayar('');
            get_kunjungan_berdasarkan_jenis_kelamin('');
            get_kunjungan_tertinggi_kecamatan();
            get_kunjungan_terendah_kecamatan();
            get_kunjungan_berdasarkan_baru_lama('');
            get_kunjungan_rawat_jalan();
            get_kunjungan_rawat_inap();
            get_kunjungan_tertinggi_diagnosa('');
        }
    }

    function get_jumlah_kunjungan() {
        $('#kunjungan_total').html(elemen_kunjungan_total(spin));
        $('#kunjungan_rj').html(elemen_kunjungan_rj(spin));
        $('#kunjungan_igd').html(elemen_kunjungan_igd(spin));
        $('#kunjungan_ri').html(elemen_kunjungan_ri(spin));

        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
            },
            success: function(response) {
                console.log(response);
                try {
                    $('#kunjungan_total').html(elemen_kunjungan_total(response.total_kunjungan));
                    $('#kunjungan_rj').html(elemen_kunjungan_rj(response.total_rj));
                    $('#kunjungan_igd').html(elemen_kunjungan_igd(response.total_igd));
                    $('#kunjungan_ri').html(elemen_kunjungan_ri(response.total_ri));
                } catch (error) {
                    $('#kunjungan_total').html(elemen_kunjungan_total('Terjadi kesalahan'));
                    $('#kunjungan_rj').html(elemen_kunjungan_rj('Terjadi kesalahan'));
                    $('#kunjungan_igd').html(elemen_kunjungan_igd('Terjadi kesalahan'));
                    $('#kunjungan_ri').html(elemen_kunjungan_ri('Terjadi kesalahan'));
                }
            }
        })
    }

    function get_kunjungan_berdasarkan_cara_bayar(param) {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_berdasarkan_cara_bayar") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
                category: param
            },
            success: function(response) {
                console.log(response);
                chart_berdasarkan_cara_bayar(response);
            }
        });
    }

    function get_kunjungan_berdasarkan_jenis_kelamin(param) {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_berdasarkan_jenis_kelamin") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
                category: param
            },
            success: function(response) {
                console.log(response);
                chart_berdasarkan_jenis_kelamin(response);
            }
        });
    }

    function get_kunjungan_berdasarkan_baru_lama(param) {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_berdasarkan_baru_lama") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
                category: param
            },
            success: function(response) {
                console.log(response);
                chart_berdasarkan_baru_lama(response);
            }
        });
    }

    function get_kunjungan_tertinggi_kecamatan() {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_tertinggi_kecamatan") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
            },
            success: function(response) {
                console.log(response);
                chart_kunjungan_tertinggi_kecamatan(response);
            }
        });
    }

    function get_kunjungan_terendah_kecamatan() {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_terendah_kecamatan") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
            },
            success: function(response) {
                console.log(response);
                chart_kunjungan_terendah_kecamatan(response);
            }
        });
    }

    $('#filter_cara_bayar').on('change', function() {
        get_kunjungan_berdasarkan_cara_bayar($('#filter_cara_bayar').val());
    })

    $('#filter_jenis_kelamin').on('change', function() {
        get_kunjungan_berdasarkan_jenis_kelamin($('#filter_jenis_kelamin').val());
    });

    $('#filter_baru_lama').on('change', function() {
        get_kunjungan_berdasarkan_baru_lama($('#filter_baru_lama').val());
    });

    $('#filter_diagnosa').on('change', function() {
        get_kunjungan_tertinggi_diagnosa($('#filter_diagnosa').val());
    });

    function get_kunjungan_rawat_jalan() {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_rawat_jalan") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
            },
            success: function(response) {
                console.log(response);
                chart_kunjungan_rawat_jalan(response);
            }
        });
    }

    function get_ketersediaan_kamar() {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_ketersediaan_kamar") }}',
            success: function(response) {
                console.log(response);
                chart_ketersediaan_kamar(response);
            }
        });
    }

    function get_kunjungan_rawat_inap() {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_rawat_inap") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
            },
            success: function(response) {
                console.log(response);
                chart_kunjungan_rawat_inap(response);
            }
        });
    }

    function get_kunjungan_tertinggi_diagnosa(param) {
        $.ajax({
            url: '{{ url("ajax_request/jumlah_kunjungan_tertinggi_diagnosa") }}',
            data: {
                from: $('#date_from').val(),
                to: $('#date_to').val(),
                category: param
            },
            success: function(response) {
                console.log(response);
                chart_tertinggi_diagnosa(response);
            }
        });
    }
</script>
@endpush