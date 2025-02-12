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
                <h1>Laporan Detail HPP</h1>
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
                        <form method="get" action="{{ route('laporan_detail_hpp.filter') }}">
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Dari Tanggal :</label>
                                        <input type="text" id="date_dari" name="tanggal_dari"
                                            class="yearpicker form-control col-lg-12" placeholder="Pilih Tanggal"
                                            value="{{ date('d-m-Y', strtotime($request['tanggal_dari'] ?? date('Y-m-d'))) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Sampai Tanggal :</label>
                                        <input type="text" id="date_sampai" name="tanggal_sampai"
                                            class="yearpicker form-control col-lg-12" placeholder="Pilih Tanggal"
                                            value="{{ date('d-m-Y', strtotime($request['tanggal_sampai'] ?? date('Y-m-d'))) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Nama :</label>
                                        <input type="text" id="nama" name="nama" class="form-control col-lg-12"
                                            placeholder="" value="{{ $request['nama'] ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">NRM :</label>
                                        <input type="text" id="nrm" name="nrm" class=" form-control col-lg-12"
                                            placeholder="" value="{{ $request['nrm'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Noreg :</label>
                                        <input type="number" id="noreg" name="noreg" class=" form-control col-lg-12"
                                            placeholder="" value="{{ $request['noreg'] ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <div style="margin-top: 55px;">

                                            <button class="btn btn-primary" type="submit">
                                                Cari</button>
                                            <a onclick="downloadExcel()" class="btn btn-success" data-toggle="tooltip"
                                                data-placement="top" title="Download Data"
                                                style="margin-left:8px ; color:white; cursor:pointer;">Download Excel</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>NRM</th>
                                <th>Noreg</th>
                                <th style="width: 15vw;" >Nama Tagihan</th>
                                <th>Jumlah Tagihan</th>
                                <th>Hpp</th>
                            </thead>
                            <tbody>
                                @isset($data)
                                    @forelse ($data as $dt)
                                        <tr>
                                            <td>{{  $loop->iteration + $data->firstItem() - 1  }}</td>
                                            <td>{{ $dt->nama_pasien }}</td>
                                            <td>{{ $dt->nrm }}</td>
                                            <td>{{ $dt->noreg_pasien }}</td>
                                            <td style="width: 15vw;" >{{ $dt->nama_tagihan }}</td>
                                            <td>@currency($dt->total) </td>
                                            <td>@currency($dt->hpp)</td>
                                        </tr>
                                    @empty
                                        <td class="text-center" colspan="7">Data tidak ditemukan</td>
                                    @endforelse
                                    <tr></tr>
                                @else
                                    <td class="text-center" colspan="7">Silahkan terapkan filter untuk menampilkan data</td>
                                @endisset
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ count($data ?? []) >= 1 ? $data->links('pagination::bootstrap-4') : '' }}
                        </div>
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
            var nrm = $('input[name=nrm]').val();
            var noreg = $('input[name=noreg]').val();
            var nama = $('input[name=nama]').val();

            var url = "{{ route('laporan_detail_hpp.download') }}?tanggal_dari=" + tanggalDari +
                "&tanggal_sampai=" + tanggalSampai + "&nrm=" + nrm + "&nama=" + nama + "&noreg=" + noreg + "";

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
