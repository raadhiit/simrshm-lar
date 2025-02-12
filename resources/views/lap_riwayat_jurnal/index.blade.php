@extends('layouts.app')
@section('content')
    <style type="text/css" media="screen">
        .table-data {
            width: 100%;
        }
    </style>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Riwayat Acc Jurnal Keuangan</h1>
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
                        <form method="get" action="{{ route('lap_riwayat_jurnal.filter') }}">
                            <div class="col-lg-12 row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Dari Tanggal Input (optional) :</label>
                                        <input type="text" id="date_dari" name="tanggal_dari"
                                            class="yearpicker form-control col-lg-12" placeholder="Pilih Tanggal"
                                            value="{{ $request['tanggal_dari'] ? date('d-m-Y', strtotime($request['tanggal_dari'])) : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Sampai Tanggal Input (optional) :</label>
                                        <input type="text" id="date_sampai" name="tanggal_sampai"
                                            class="yearpicker form-control col-lg-12" placeholder="Pilih Tanggal"
                                            value="{{ $request['tanggal_sampai'] ? date('d-m-Y', strtotime($request['tanggal_sampai'])) : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Status :</label>
                                        <select name="status" id="status" class="form-control">
                                            <option {{ $request['status'] == 'semua' ? 'selected' : '' }} value="semua">
                                                Semua</option>
                                            <option {{ $request['status'] == 'belum_dikunci' ? 'selected' : '' }}
                                                value="belum_dikunci">Belum Dikunci</option>
                                            <option {{ $request['status'] == 'belum_di_acc' ? 'selected' : '' }}
                                                value="belum_di_acc">Belum Di Acc</option>
                                            <option {{ $request['status'] == 'sudah_di_acc' ? 'selected' : '' }}
                                                value="sudah_di_acc">Sudah Di Acc</option>
                                        </select>
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
                        <table class="table table-striped" width="100%">
                            <thead>
                                <th width="5%" >No.</th>
                                <th>Jenis Jurnal</th>
                                <th>Operator</th>
                                <th>Tanggal Input</th>
                                <th>Tanggal Jurnal</th>
                                <th>Nomor Jurnal</th>
                                <th width="25%" >Keterangan</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @isset($data)
                                    @forelse ($data as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{$item->jenis_jurnal}}</td>
                                            <td>{{$item->operator}}</td>
                                            <td>{{$item->tanggal_input}}</td>
                                            <td>{{$item->tanggal_jurnal}}</td>
                                            <td>{{$item->nomor_jurnal}}</td>
                                            <td>{{$item->keterangan}}</td>
                                            <td>{{$item->status}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                @endisset
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
            var status_filter = $('select[name=status] option:selected').val();

            var url = "{{ route('lap_riwayat_jurnal.download') }}?tanggal_dari=" + tanggalDari +
                "&tanggal_sampai=" + tanggalSampai + '&status=' + status_filter ;

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
