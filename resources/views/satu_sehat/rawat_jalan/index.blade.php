@extends('layouts.app')
@section('content')
<div class="main-content">
    <!-- Modal List Error -->
    <div class="modal fade" id="modalListError" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Daftar Pesan Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tabe-responsive">

                        <table class="table table-striped">
                            <thead>
                                <th>Noreg</th>
                                <th>Nrm</th>
                                <th>Nama Pasien</th>
                                <th>Kode Error</th>
                                <th>Pesan Error</th>
                            </thead>

                            <tbody id="tbody-list-error"></tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Error -->
    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Pesan Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Kode Error : </label>
                    <span id="error_code"></span>
                    <br>
                    <label>Pesan : </label> <br>
                    <span id="error_message"></span>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="section-header">
            <h1>Riwayat Kunjungan Pasien Rawat Jalan</h1>
        </div>

        <div class="section-body">
            <form action="{{ url('satu_sehat/rawat_jalan/export') }}" id="fake_form" method="post">
                @csrf
                <input type="hidden" name="from" id="hide_from">
                <input type="hidden" name="to" id="hide_to">
            </form>
            <div class="pb-3" id="msg_loading"></div>
            <div class="card pt-3">
                <form class="row" style="width: 100%; margin-left: 0;" id="form_filter" action="{{ url('satu_sehat/rawat_jalan/datatable') }}">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Dari</label>
                            <input type="date" name="dari" id="dari" onchange="$('#dari_filter').val(this.value)"
                                value="{{ $date_filter['dari'] ?? date('Y-m-d') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Sampai</label>
                            <input type="date" name="sampai" id="sampai" onchange="$('#sampai_filter').val(this.value)"
                                value="{{ $date_filter['sampai'] ?? date('Y-m-d') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4" style="padding-top: 30px;">
                        <button class="btn btn-primary" type="submit">Terapkan</button>
                        <button class="btn btn-success" type="button" onclick="prepareSend()"><i class="fa fa-paper-plane"></i> Kirim Data</button>
                        <button class="btn btn-warning" style="color:#fff;" type="button" onclick="export_excel()"><i class="fa fa-file"></i> Export Excel</button>
                    </div>
                </form>
            </div>
            <div class="card pt-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <form action="{{ url('satu_sehat/rawat_jalan/datatable') }}" method="get"
                            id="form_search">
                            <input type="hidden" name="sampai" id="sampai_filter"
                                value="{{ $date_filter['sampai'] ?? date('Y-m-d') }}" class="form-control" required>
                            <input type="hidden" name="dari" id="dari_filter"
                                value="{{ $date_filter['dari'] ?? date('Y-m-d') }}" class="form-control" required>
                            <label for="">Search</label>
                            <input placeholder="Cari berdasarkan nrm/noreg/nama pasien" type="text" name="search" id="search" value=""
                                class="form-control" onkeydown="if (event.key == 'Enter'){$('#form_search').submit()}">
                        </form>
                    </div>
                </div>
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-12">
                        <table class="table table-striped table-responsive" style="width: 100%" id="tabel">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Tanggal Dilayani</th>
                                    <th>Tanggal Pulang</th>
                                    <th>Nama Poli</th>
                                    <th>Nama Pasien</th>
                                    <th>NRM</th>
                                    <th>Noreg</th>
                                    <th>No KTP</th>
                                    <th>No IHS</th>
                                    <th>Diagnosa</th>
                                    <th>Dokter</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $dt)
                                    @php

                                        $waktuKeluar = null;
                                        $buttonStatus = '';
                                        if (Schema::hasTable('smis_rwt_antrian_' . $dt->jenislayanan)) {
                                            $waktuKeluar = DB::table('smis_rwt_antrian_' . $dt->jenislayanan)
                                                ->where('no_register', $dt->id)
                                                ->value('waktu_keluar');
                                        }

                                        if ($dt->status_ss == 0) {
                                            if ($dt->response_code_satu_sehat == '') {
                                                $buttonStatus = '<div class="text-center">Belum Dikirim</div>';
                                            } elseif ($dt->response_code_satu_sehat != 200) {
                                                $buttonStatus = '<div class="text-center"><button data-toggle="tooltip" title="Lihat Error" class="btn btn-sm btn-danger" onclick="showModal(\'' . $dt->response_code_satu_sehat . '\', \'' . $dt->response_message_satu_sehat . '\')">Gagal</button></div>';
                                            } elseif ($dt->status_ss == 1) {
                                                $buttonStatus = '<div class="text-center"><button class="btn btn-sm btn-primary">Berhasil</button></div>';
                                            } else {
                                                $buttonStatus = '<div class="text-center">Belum Dikirim</div>';
                                            }
                                        } else {
                                            $buttonStatus = '<div class="text-center">' . ($dt->status_ss ? 'Berhasil' : 'Gagal') . '</div>';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($dt->tanggal)) }}</td>
                                        <td>{{ $waktuKeluar != null ? date('d-m-Y H:i', strtotime($waktuKeluar)) : '00-00-0000' }}
                                        </td>
                                        <td>{{ date('d-m-Y H:i', strtotime($dt->tanggal_pulang)) }}</td>
                                        <td>{{ $dt->last_nama_ruangan }}</td>
                                        <td>{{ $dt->nama_pasien }}</td>
                                        <td>{{ $dt->nrm }}</td>
                                        <td>{{ $dt->id }}</td>
                                        <td>{{ $dt->ktp }}</td>
                                        <td>{{ $dt->ihs_number }}</td>
                                        <td>{{ $dt->nama_icd }}</td>
                                        <td>{{ $dt->nama_dokter }}</td>
                                        <td>{!! $buttonStatus !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center">Silahkan Terapkan filter</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ count($datas) >= 1 ? $datas->links('pagination::bootstrap-4') : '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    let data = [];

    function progress_loading(now, max) {
        return '<div class="progress" style="height: 30px;">' +
            '<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="' +
            now + '" aria-valuemin="0" aria-valuemax="' + max + '" style="width: ' + ((now / max) * 100) + '%">' + now +
            ' dari ' + max + ' (' + Math.floor((now / max) * 100) + ' %)</div>' +
            '</div>';
    }

    function export_excel() {
        $('#hide_from').val($('#dari').val());
        $('#hide_to').val($('#sampai').val());
        $('#fake_form').submit();
    }

    $(document).ready(function() {
        {{-- data = <?php echo $all_data ? $all_data : '[]' ?>; --}}
        // datatabel();
        // get_data();
    })

    // $('#form_filter').submit(function(e) {
    //     e.preventDefault();
    //     datatabel();
    //     get_data();
    // })

    function showModal(code, message) {
        $('#error_code').text(code);
        $('#error_message').text(message);
        $('#modalError').modal('show');
    }

    function send(index) {
        console.log('jumlah data : ' + data.length)
        console.log('kirim data ke : ' + (index + 1))
        // setTimeout(function(){
        $('#msg_loading').html(progress_loading(index, data.length));
        let temp_index = index + 1;
        if (data[index].status_ss == 0) {
            $.ajax({
                url: "{{ url('satu_sehat/rawat_jalan/send') }}",
                data: {
                    id: data[index].id
                },
                success: function(response) {
                    console.log(response);
                    if (response.code != 200) {
                        // $('#msg_loading').html('<div class="alert alert-danger text-center">Selesai ' + index + ' dari ' + data.length + '. Jika ingin mengulangi / melanjutkan tekan terapkan terlebih dahulu</div>');
                        var html_el = `
                                    <tr>
                                        <td>${data[index].id}</td>
                                        <td>${data[index].nrm}</td>
                                        <td>${data[index].nama_pasien}</td>
                                        <td>${response.code}</td>
                                        <td>${response.message}</td>
                                    </tr>
                                    `;
                        $('#tbody-list-error').append(html_el);
                    }

                    if (temp_index < data.length) {
                        send(temp_index);
                    } else {
                        $('#msg_loading').html('<div class="alert alert-success text-center">Selesai ' + (index + 1) + ' dari ' + data.length + '.</div>');
                        $('#modalListError').modal('show');
                    }
                }
            })
        } else {
            if (temp_index < data.length) {
                send(temp_index);
            } else {
                $('#msg_loading').html('<div class="alert alert-success text-center">Selesai ' + (index + 1) + ' dari ' + data.length + '.</div>');
                $('#modalListError').modal('show');
            }
        }
        // }, 2000);
    }

    function get_data() {
            return new Promise((resolve, reject) => {
                data = [];
                $.ajax({
                    url: "{{ url('satu_sehat/rawat_jalan/filter') }}",
                    data: $('#form_filter').serialize(),
                    success: function(response) {
                        data = response;
                        $('#msg_loading').html('');
                        console.log(data);
                        resolve("ok");
                    }
                })
            });
    }

    function datatabel() {
        if ($.fn.DataTable.isDataTable("#tabel")) {
            $('#tabel').DataTable().clear().destroy();
        }

        $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            bLengthChange: false,
            ajax: '{{ url("satu_sehat/rawat_jalan/datatable?dari=") }}' + $('#dari').val() + '&sampai=' +
            $('#sampai').val(),
            columns : [{
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart +
                            1) + '</div>';
                    }
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function(data, type, row) {
                        return '<div class="text-center">' + reformat_tanggal(data) + '</div>';
                    }
                },
                {
                    data: 'last_nama_ruangan',
                    name: 'last_nama_ruangan',
                },
                {
                    data: 'nama_pasien',
                    name: 'nama_pasien',
                },
                {
                    data: 'nrm',
                    name: 'nrm',
                },
                {
                    data: 'diagnosa',
                    name: 'smis_mr_diagnosa.diagnosa',
                },
                {
                    data: 'status_ss',
                    name: 'status_ss',
                    render: function(data, type, row) {
                        if (data == '') {
                            return '';
                        }
                        return '<div class="text-center">' + (data ? 'Berhasil' : 'Gagal') + '</div>';
                    }
                }
            ],
            "columnDefs": [{
                "targets": [0, 1, 2, 3, 4, 5, 6],
                "orderable": false
            }]
        })
    }

    function convert_slug(param) {
        if (param == '' || param == null) {
            return '';
        }
        arr = param.split('_');

        for (var i = 0; i < arr.length; i++) {
            arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

        }
        return arr.join(' ');
    }

    function reformat_tanggal(tanggal) {
        if (tanggal == '' || tanggal == null) {
            return '';
        }
        var temp = [];
        var jam = [];
        if (tanggal.includes(' ')) {
            var tgl = tanggal.split(' ');
            temp = tgl[0].split('-');
            jam = tgl[1].split(':');
            return temp[2] + '-' + temp[1] + '-' + temp[0] + ' ' + jam[0] + ':' + jam[1];
        } else {
            temp = tanggal.split('-');
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        }
    }

    function prepareSend() {
            $('#msg_loading').html(
                '<div class="progress" style="height: 30px;">' +
                '<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" ' +
                'aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">' +
                'Prosess pengambilan data' +
                '</div>' +
                '</div>'
            );

            get_data().then(result => {
                if (result === "ok") {
                    send(0);
                }
            }).catch(error => {
                console.error("AJAX request failed:", error);
            });
        }
</script>
@endpush
