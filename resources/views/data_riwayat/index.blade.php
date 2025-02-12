@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Riwayat</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('riwayat.filter') }}" method="get">
                        <div class="col-lg-12 row p-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Dari :</label>
                                    <input class="form-control datetimepicker" type="text"
                                        value="{{ $request['dari'] ?? '' }}" name="dari" id="dari" required />
                                </div>
                                <div class="form-group">
                                    <label>Ruangan :</label>
                                    <select class="form-control" name="ruangan" id="ruangan" required>
                                        <option value="">--Silahkan Pilih Pilihan--</option>
                                        @foreach ($ruangan as $ruang)
                                            <option {{ ($request['ruangan'] ?? '') == $ruang->slug ? 'selected' : '' }}
                                                value="{{ $ruang->slug }}">{{ $ruang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Sampai :</label>
                                    <input class="form-control datetimepicker" type="text"
                                        value="{{ $request['sampai'] ?? '' }}" name="sampai" id="sampai" required />
                                </div>
                                <div class="form-group">
                                    <label>NRM Pasien :</label>
                                    <input class="form-control" type="text" value="{{ $request['nrm'] ?? '' }}"
                                        name="nrm" id="nrm" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Keluar :</label>
                                    <select class="form-control" name="keluar" id="keluar">
                                        <option value="">--Silahkan Pilih Pilihan--</option>
                                        <option {{ ($request['keluar'] ?? '') == 'Tidak Datang' ? 'selected' : '' }}
                                            value="Tidak Datang"> Tidak Datang</option>
                                        <option {{ ($request['keluar'] ?? '') == 'Dipulangkan Hidup' ? 'selected' : '' }}
                                            value="Dipulangkan Hidup"> Dipulangkan Hidup</option>
                                        <option
                                            {{ ($request['keluar'] ?? '') == 'Dipulangkan Mati <=24 Jam' ? 'selected' : '' }}
                                            value="Dipulangkan Mati <=24 Jam"> Dipulangkan Mati &lt;=24 Jam
                                        </option>
                                        <option
                                            {{ ($request['keluar'] ?? '') == 'Dipulangkan Mati <=48 Jam' ? 'selected' : '' }}
                                            value="Dipulangkan Mati <=48 Jam"> Dipulangkan Mati &lt;=48 Jam
                                        </option>
                                        <option
                                            {{ ($request['keluar'] ?? '') == 'Dipulangkan Mati >48 Jam' ? 'selected' : '' }}
                                            value="Dipulangkan Mati >48 Jam"> Dipulangkan Mati &gt;48 Jam
                                        </option>
                                        <option {{ ($request['keluar'] ?? '') == 'Pulang Paksa' ? 'selected' : '' }}
                                            value="Pulang Paksa"> Pulang Paksa</option>
                                        <option {{ ($request['keluar'] ?? '') == 'Kabur' ? 'selected' : '' }}
                                            value="Kabur"> Kabur</option>
                                        <option {{ ($request['keluar'] ?? '') == 'Masuk IGD' ? 'selected' : '' }}
                                            value="Masuk IGD"> Masuk IGD</option>
                                        <option {{ ($request['keluar'] ?? '') == 'Pindah Kamar' ? 'selected' : '' }}
                                            value="Pindah Kamar"> Pindah Kamar</option>
                                        <option {{ ($request['keluar'] ?? '') == 'Rujuk Poli Lain' ? 'selected' : '' }}
                                            value="Rujuk Poli Lain"> Dirujuk Ke Poli Lain</option>
                                        <option {{ ($request['keluar'] ?? '') == 'Rujuk RS Lain' ? 'selected' : '' }}
                                            value="Rujuk RS Lain"> Dirujuk Ke RS Lain</option>
                                        <option
                                            {{ ($request['keluar'] ?? '') == 'Dikembalikan ke Perujuk' ? 'selected' : '' }}
                                            value="Dikembalikan ke Perujuk"> Dikembalikan ke Perujuk
                                        </option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No.Register :</label>
                                    <input class="form-control" type="text" value="{{ $request['noreg'] ?? '' }}"
                                        name="noreg" id="noreg" />
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 text-center mb-4">
                            <button class="btn btn-primary">Terapkan</button>
                            <a class="btn btn-success" style="color: white; cursor: pointer;"
                                onclick="downloadExcel()">Download</a>
                        </div>

                    </form>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Status</th>
                                        <th>Asal</th>
                                        <th>Kunjungan</th>
                                        <th>No. Reg</th>
                                        <th>NRM</th>
                                        <th>Kelamin</th>
                                        <th>Pasien</th>
                                        <th>Umur</th>
                                        <th>Cara Bayar</th>
                                        <th>Cara Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data_riwayats)
                                        @forelse ($data_riwayats as $data_riwayat)
                                            <tr>
                                                <td>{{ $data_riwayats->firstItem() + $loop->index }}</td>
                                                <td>{{ date('d F Y H:i', strtotime($data_riwayat->waktu_register)) }}</td>
                                                <td>{{ $data_riwayat->waktu_keluar == '0000-00-00 00:00:00' ? '-' : date('d F Y H:i', strtotime($data_riwayat->waktu_keluar)) }}
                                                </td>
                                                <td>{{ $data_riwayat->selesai == 1 ? 'Non Aktif' : 'Aktif' }}</td>
                                                <td>{{ $data_riwayat->asal }}</td>
                                                <td>{{ $data_riwayat->kunjungan }}</td>
                                                <td>{{ $data_riwayat->no_register }}</td>
                                                <td>{{ $data_riwayat->nrm_pasien }}</td>
                                                <td>{{ $data_riwayat->jk == 1 ? 'P' : 'L' }}</td>
                                                <td>{{ $data_riwayat->nama_pasien }}</td>
                                                <td>{{ $data_riwayat->umur }}</td>
                                                <td>{{ $data_riwayat->carabayar }}</td>
                                                <td>{{ $data_riwayat->cara_keluar }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th colspan="14" class="text-center">Data Tidak Ditemukan</th>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <th colspan="14" class="text-center">Silahkan isi bidang masukan untuk menampilkan
                                                data</th>
                                        </tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3" style="width: 100%; margin-left:0;">
                            <div class="col-lg-12" style="justify-content: flex-end; display: flex;">
                                {{ isset($data_riwayats) ? $data_riwayats->appends(Request::only('dari', 'ruangan', 'sampai', 'keluar', 'nrm', 'noreg'))->links('pagination::bootstrap-4') : '' }}
                            </div>

                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(".datetimepicker")
            .datepicker({
                format: "dd-mm-yyyy",
                startView: "day",
                minViewMode: "day",
                autoclose: true,
            });

        function downloadExcel() {

            var dari = $('input[name=dari]').val();
            var sampai = $('input[name=sampai]').val();
            var nrm = $('input[name=nrm]').val();
            var noreg = $('input[name=noreg]').val();
            var keluar = $('select[name=keluar]').val();
            var ruangan = $('select[name=ruangan]').val();
            var url = "{{ route('riwayat.download') }}/?dari=" + dari + "&sampai=" + sampai + "&keluar=" + keluar +
                "&ruangan=" + ruangan + "&nrm=" + nrm + "&noreg=" + noreg;
            if (confirm("Apakah anda ingin melanjutkan download ?")) {
                if ('{{ isset($data_riwayats) }}') {
                    window.location.href = url;
                } else {
                    alert('Silahkan isi bidang masukan untuk mendownload data')
                }
            } else {
                return false;
            }
        }
    </script>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ruangan').select2({
                templateSelection: function(data) {
                    var $result = $(
                        '<span class="select2-selection__rendered pt-1">' +
                        data.text +
                        '</span>'
                    );

                    return $result;
                },
            });
        });
    </script>
@endpush
