@extends('layouts.app')
@section('content')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Antrian</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="row pt-3" style="width:100%; margin-left: 0;">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Jenis Filter</label>
                            <select id="jenis" class="form-control">
                                <option value="hari">Hari</option>
                                <option value="bulan">Bulan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <div id="box_filter_tanggal"></div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="padding-top: 30px;">
                        <button id="btn_tampilkan" class="btn btn-success"><i class="fas fa-search"></i> Tampilkan</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row pt-3 pb-3" style="width:100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Kode Poli</th>
                                    <th rowspan="2">Nama Poli</th>
                                    <th rowspan="2">Jumlah Antrian</th>
                                    <th rowspan="2">Tanggal</th>
                                    <th colspan="6">Waktu</th>
                                </tr>
                                <tr class="text-center">
                                    <th>Task 1</th>
                                    <th>Task 2</th>
                                    <th>Task 3</th>
                                    <th>Task 4</th>
                                    <th>Task 5</th>
                                    <th>Task 6</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                <tr class="text-center">
                                    <td colspan="11">Cari terlebih dahulu.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Pilih Poli</label>
                            <select name="" id="select_option_poli" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <label for="" style="font-weight: bold;">Task 1</label>
                        <canvas id="chart_satu" width="250" height="250"></canvas>
                    </div>
                    <div class="col-lg-2 text-center">
                        <label for="" style="font-weight: bold;">Task 2</label>
                        <canvas id="chart_dua" width="250" height="250"></canvas>
                    </div>
                    <div class="col-lg-2 text-center">
                        <label for="" style="font-weight: bold;">Task 3</label>
                        <canvas id="chart_tiga" width="250" height="250"></canvas>
                    </div>
                    <div class="col-lg-2 text-center">
                        <label for="" style="font-weight: bold;">Task 4</label>
                        <canvas id="chart_empat" width="250" height="250"></canvas>
                    </div>
                    <div class="col-lg-2 text-center">
                        <label for="" style="font-weight: bold;">Task 5</label>
                        <canvas id="chart_lima" width="250" height="250"></canvas>
                    </div>
                    <div class="col-lg-2 text-center">
                        <label for="" style="font-weight: bold;">Task 6</label>
                        <canvas id="chart_enam" width="250" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $('#box_filter_tanggal').html('<input type="text" class="form-control" id="tanggal">');
        $('#tanggal').datepicker({
            format: 'dd/mm/yyyy'
        });
    })

    $('#jenis').on('change', function() {
        $('#box_filter_tanggal').html('<input type="text" class="form-control" id="tanggal">');
        if ($('#jenis').val() == 'bulan') {
            $('#tanggal').datepicker({
                format: 'mm/yyyy'
            });
        } else {
            $('#tanggal').datepicker({
                format: 'dd/mm/yyyy'
            });
        }
    })

    var data = [];
    var select_option_poli = [];
    var data_chart_satu = [];
    var label_chart_satu = ['Task 1'];
    var data_chart_dua = [];
    var label_chart_dua = ['Task 2'];
    var data_chart_tiga = [];
    var label_chart_tiga = ['Task 3'];
    var data_chart_empat = [];
    var label_chart_empat = ['Task 4'];
    var data_chart_lima = [];
    var label_chart_lima = ['Task 5'];
    var data_chart_enam = [];
    var label_chart_enam = ['Task 6'];

    const box_chart_satu = document.getElementById('chart_satu');
    const box_chart_dua = document.getElementById('chart_dua');
    const box_chart_tiga = document.getElementById('chart_tiga');
    const box_chart_empat = document.getElementById('chart_empat');
    const box_chart_lima = document.getElementById('chart_lima');
    const box_chart_enam = document.getElementById('chart_enam');

    function render_chart_task_satu() {
        let chartStatus = Chart.getChart("chart_satu"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        const chart_satu = new Chart(box_chart_satu, {
            type: 'pie',
            data: {
                labels: label_chart_satu,
                datasets: [{
                    label: '# of Votes',
                    data: data_chart_satu,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }

    function render_chart_task_dua() {
        let chartStatus = Chart.getChart("chart_dua"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        const chart_dua = new Chart(box_chart_dua, {
            type: 'pie',
            data: {
                labels: label_chart_dua,
                datasets: [{
                    label: '# of Votes',
                    data: data_chart_dua,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }

    function render_chart_task_tiga() {
        let chartStatus = Chart.getChart("chart_tiga"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        const chart_tiga = new Chart(box_chart_tiga, {
            type: 'pie',
            data: {
                labels: label_chart_tiga,
                datasets: [{
                    label: '# of Votes',
                    data: data_chart_tiga,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }

    function render_chart_task_empat() {
        let chartStatus = Chart.getChart("chart_empat"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        const chart_empat = new Chart(box_chart_empat, {
            type: 'pie',
            data: {
                labels: label_chart_empat,
                datasets: [{
                    label: '# of Votes',
                    data: data_chart_empat,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }

    function render_chart_task_lima() {
        let chartStatus = Chart.getChart("chart_lima"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        const chart_lima = new Chart(box_chart_lima, {
            type: 'pie',
            data: {
                labels: label_chart_lima,
                datasets: [{
                    label: '# of Votes',
                    data: data_chart_lima,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }

    function render_chart_task_enam() {
        let chartStatus = Chart.getChart("chart_enam"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        const chart_enam = new Chart(box_chart_enam, {
            type: 'pie',
            data: {
                labels: label_chart_enam,
                datasets: [{
                    label: '# of Votes',
                    data: data_chart_enam,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }

    function loading(param) {
        return '<tr class="text-center"><td colspan="11"><div class="spinner-border spinner-border-sm mr-1" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' + param + '</td></tr>';
    }

    function row_table(param) {
        return '<tr class="text-center"><td colspan="11">' + param + '</td></tr>';
    }

    $('#select_option_poli').change(function() {
        data_chart_satu = [];
        data_chart_dua = [];
        data_chart_tiga = [];
        data_chart_empat = [];
        data_chart_lima = [];
        data_chart_enam = [];
        for (let i = 0; i < data.length; i++) {
            var cek = false;
            if (data[i].kodepoli == $('#select_option_poli').val()) {
                data_chart_satu.push(data[i].avg_waktu_task1);
                data_chart_dua.push(data[i].avg_waktu_task2);
                data_chart_tiga.push(data[i].avg_waktu_task3);
                data_chart_empat.push(data[i].avg_waktu_task4);
                data_chart_lima.push(data[i].avg_waktu_task5);
                data_chart_enam.push(data[i].avg_waktu_task6);
            }
        }
        console.log(data_chart_satu);
        render_chart_task_satu();
        render_chart_task_dua();
        render_chart_task_tiga();
        render_chart_task_empat();
        render_chart_task_lima();
        render_chart_task_enam();
    })

    function render_select_option_poli() {
        if (select_option_poli.length == 0) {
            $('#select_option_poli').html('');
        } else {
            var ins = '<option value="">--Select Here--</option>';
            for (let i = 0; i < select_option_poli.length; i++) {
                ins += '<option value="' + select_option_poli[i].kodepoli + '">' + select_option_poli[i].namapoli + '</option>';
            }
            $('#select_option_poli').html(ins);
        }
    }

    function render_data() {
        var ins = '';
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                ins += '<tr>' +
                    '<td class="text-center">' + (i + 1) + '</td>' +
                    '<td class="text-center">' + data[i].kodepoli + '</td>' +
                    '<td>' + data[i].namapoli + '</td>' +
                    '<td class="text-center">' + data[i].jumlah_antrean + '</td>' +
                    '<td class="text-center">' + format_tanggal(data[i].tanggal) + '</td>' +
                    '<td class="text-center">' + data[i].waktu_task1 + '</td>' +
                    '<td class="text-center">' + data[i].waktu_task2 + '</td>' +
                    '<td class="text-center">' + data[i].waktu_task3 + '</td>' +
                    '<td class="text-center">' + data[i].waktu_task4 + '</td>' +
                    '<td class="text-center">' + data[i].waktu_task5 + '</td>' +
                    '<td class="text-center">' + data[i].waktu_task6 + '</td>' +
                    '</tr>';

                if (select_option_poli.length > 0) {
                    var cek = false;
                    for (let j = 0; j < select_option_poli.length; j++) {
                        if (select_option_poli[j].kodepoli == data[i].kodepoli) {
                            cek = true;
                        }
                    }
                    if (cek == false) {
                        select_option_poli.push({
                            kodepoli: data[i].kodepoli,
                            namapoli: data[i].namapoli
                        });
                    }
                } else {
                    select_option_poli.push({
                        kodepoli: data[i].kodepoli,
                        namapoli: data[i].namapoli
                    });
                }
            }
            $('#list').html(ins);

            var grouping_data = data.reduce(function(r, a) {
                r[a.kodepoli] = r[a.kodepoli] || [];
                r[a.kodepoli].push(a);
                return r;
            }, Object.create(null));
            console.log(grouping_data);

            let temp = [];
            Object.keys(grouping_data).map(function(key, index) {
                let avg1 = 0.0;
                let avg2 = 0.0;
                let avg3 = 0.0;
                let avg4 = 0.0;
                let avg5 = 0.0;
                let avg6 = 0.0;
                for (let i = 0; i < grouping_data[key].length; i++) {
                    avg1 += grouping_data[key][i].avg_waktu_task1;
                    avg2 += grouping_data[key][i].avg_waktu_task2;
                    avg3 += grouping_data[key][i].avg_waktu_task3;
                    avg4 += grouping_data[key][i].avg_waktu_task4;
                    avg5 += grouping_data[key][i].avg_waktu_task5;
                    avg6 += grouping_data[key][i].avg_waktu_task6;
                }
                avg1 = avg1 / grouping_data[key].length;
                avg2 = avg2 / grouping_data[key].length;
                avg3 = avg3 / grouping_data[key].length;
                avg4 = avg4 / grouping_data[key].length;
                avg5 = avg5 / grouping_data[key].length;
                avg6 = avg6 / grouping_data[key].length;
                temp.push({
                    'kodepoli': key,
                    'avg_waktu_task1': avg1,
                    'avg_waktu_task2': avg2,
                    'avg_waktu_task3': avg3,
                    'avg_waktu_task4': avg4,
                    'avg_waktu_task5': avg5,
                    'avg_waktu_task6': avg6
                });
            });

            data = temp;
            console.log(data);

            data_chart_satu = [];
            data_chart_dua = [];
            data_chart_tiga = [];
            data_chart_empat = [];
            data_chart_lima = [];
            data_chart_enam = [];
            render_select_option_poli();
        } else {
            select_option_poli = [];
            data_chart_satu = [];
            data_chart_dua = [];
            data_chart_tiga = [];
            data_chart_empat = [];
            data_chart_lima = [];
            data_chart_enam = [];
            $('#list').html(row_table('Data tidak ditemukan.'));
            render_select_option_poli();
        }
    }

    $('#btn_tampilkan').click(function() {
        if ($('#tanggal').val() == '') {
            alert('Pilih tanggal dahulu');
            return;
        }

        if ($('#jenis').val() == 'hari') {
            get_data_perhari();
        } else {
            get_data_perbulan();
        }
    })

    function reformat_tanggal(param){
        var temp = param.split('/');
        return temp[0]+'-'+temp[1]+'-'+temp[2];
    }

    function get_data_perhari() {
        if ($('#tanggal').val() == '') {
            alert('Pilih tanggal dahulu');
        } else {
            console.log(reformat_tanggal($('#tanggal').val()));
            $('#list').html(loading('Sedang mengambil data ...'))
            $('#btn_tampilkan').attr('disabled', true);
            data = [];
            $('#select_option_poli').html('');
            data_chart_satu = [];
            data_chart_dua = [];
            data_chart_tiga = [];
            data_chart_empat = [];
            data_chart_lima = [];
            data_chart_enam = [];
            select_option_poli = [];
            render_chart_task_satu();
            render_chart_task_dua();
            render_chart_task_tiga();
            render_chart_task_empat();
            render_chart_task_lima();
            render_chart_task_enam();
            render_select_option_poli();
            $.ajax({
                url: "{{ url('ajax_request/dashboard_bpjs_per_tanggal') }}",
                data: {
                    tanggal: reformat_tanggal($('#tanggal').val()),
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == false) {
                        $('#list').html(row_table(response.message));
                        data_chart_satu = [];
                        data_chart_dua = [];
                        data_chart_tiga = [];
                        data_chart_empat = [];
                        data_chart_lima = [];
                        data_chart_enam = [];
                        select_option_poli = [];
                        render_chart_task_satu();
                        render_chart_task_dua();
                        render_chart_task_tiga();
                        render_chart_task_empat();
                        render_chart_task_lima();
                        render_chart_task_enam();
                        render_select_option_poli();
                    } else {
                        data = response.data;
                        render_data();
                    }
                    $('#btn_tampilkan').removeAttr('disabled');
                }
            })
        }
    }

    function format_tanggal(param) {
        if (param == '') {
            return param;
        } else {
            var temp = param.split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        }
    }

    function get_data_perbulan() {
        if ($('#tanggal').val() == '') {
            alert('Pilih bulan dahulu');
        } else {
            var temp = $('#tanggal').val().split('/');

            $('#list').html(loading('Sedang mengambil data ...'))
            $('#btn_tampilkan').attr('disabled', true);
            data = [];
            $('#select_option_poli').html('');
            data_chart_satu = [];
            data_chart_dua = [];
            data_chart_tiga = [];
            data_chart_empat = [];
            data_chart_lima = [];
            data_chart_enam = [];
            select_option_poli = [];
            render_chart_task_satu();
            render_chart_task_dua();
            render_chart_task_tiga();
            render_chart_task_empat();
            render_chart_task_lima();
            render_chart_task_enam();
            render_select_option_poli();
            $.ajax({
                url: "{{ url('ajax_request/dashboard_bpjs_per_bulan') }}",
                data: {
                    bulan: temp[0],
                    tahun: temp[1]
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == false) {
                        $('#list').html(row_table(response.message));
                        data_chart_satu = [];
                        data_chart_dua = [];
                        data_chart_tiga = [];
                        data_chart_empat = [];
                        data_chart_lima = [];
                        data_chart_enam = [];
                        select_option_poli = [];
                        render_chart_task_satu();
                        render_chart_task_dua();
                        render_chart_task_tiga();
                        render_chart_task_empat();
                        render_chart_task_lima();
                        render_chart_task_enam();
                        render_select_option_poli();
                    } else {
                        data = response.data;
                        render_data();
                    }
                    $('#btn_tampilkan').removeAttr('disabled');
                }
            })
        }
    }
</script>
@endpush