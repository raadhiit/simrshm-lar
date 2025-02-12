@extends('layouts.app')
@section('content')
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Pilih CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('periksa_dokter.import') }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fileInput">Pilih file dari template yang anda download</label>
                            <input type="file" class="form-control-file" id="fileInput" accept=".csv" name="file_csv">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin-top: -15px;">
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Tambah Periksa Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('periksa_dokter.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body mt-3">
                        <div class="form-group">
                            <label for="">Nama Periksa</label>
                            <input type="text" class="form-control" required name="nama_periksa" id="nama_periksa"
                                placeholder="" value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select class="form-control select-2-add" name="kelas" id="kelas">
                                <option value="">--Silahkan Pilih Pilihan--</option>
                                <option value="non_kelas">Non Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->slug }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Cara Bayar</label>
                            <select class="form-control" name="carabayar" id="carabayar">
                                <option value="">--Silahkan Pilih Pilihan--</option>
                                @foreach ($carabayar as $item)
                                    <option value="{{ $item->slug }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Total Tarif</label>
                            <input type="text" class="form-control" required name="tarif" id="total_tarif" placeholder=""
                                value="{{ old('tarif') }}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Margin</label>
                            <input type="number" class="form-control" required name="margin" id="margin" placeholder=""
                                value="{{ old('margin') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin-top: -15px;">
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Ubah Periksa Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('periksa_dokter.update', 0) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" hidden id="id_edit" name="id">
                    <div class="modal-body mt-3">
                        <div class="form-group">
                            <label for="">Nama Periksa</label>
                            <input type="text" class="form-control" required name="nama_periksa" id="nama_edit"
                                placeholder="" value="{{ old('nama_periksa') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select class="form-control select-2-edit" name="kelas" id="kelas_edit">
                                <option value="">--Silahkan Pilih Pilihan---</option>
                                <option value="non_kelas">Non Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->slug }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Cara Bayar</label>
                            <select class="form-control" name="carabayar" id="carabayar_edit">
                                <option value="">--Silahkan Pilih Pilihan---</option>
                                @foreach ($carabayar as $item)
                                    <option value="{{ $item->slug }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Total Tarif</label>
                            <input type="text" class="form-control" required name="tarif" id="total_tarif_edit"
                                placeholder="" value="{{ old('total_tarif') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Margin</label>
                            <input type="number" class="form-control" required name="margin" id="margin_edit"
                                placeholder="" value="{{ old('margin') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tindakan Dokter</h1>
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
                    @include('tindakan_dokter.nav_tab')
                    <h4></h4>
                    <div class="card-body">
                        <div class="card-header" style="margin-left: -25px;">
                            <div class="card-header-form">
                                <form method="get" action="{{ route('periksa_dokter.search') }}">
                                    <div class="input-group">
                                        <input type="text" name="keyword" class="form-control" placeholder="Search"
                                            value="{{ $keyword ?? '' }}">
                                        <div class="input-group-btn ml-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-search"></i></button>
                                                    <a class="btn btn-info" href="#"
                                                onclick="downloadExcel()"
                                                data-toggle="tooltip" title="Download Excel">Download Tarif</a>
                                            <a class="btn btn-info"
                                                href="{{ asset('template/template_periksa_dokter.csv') }}"
                                                data-toggle="tooltip" title="Download template CSV">Download Template</a>
                                            <a class="btn btn-dark" href="#" data-toggle="tooltip"
                                                title="Import data ke database" onclick="chooseFile()">Import</a>
                                        </div>
                                    </div>
                                </form>
                                <input type="file" accept=".csv" id="fileInput" style="display: none;">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Cara Bayar</th>
                                        <th>Kelas</th>
                                        <th>Tarif Sekarang</th>
                                        <th>
                                            <div class="row">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalAdd"><i class="fas fa-plus"></i></button>
                                                {{-- <button onclick="downloadExcel()"class="btn btn-info" --}}
                                                {{--     style="margin-left:3px ;"><i style="font-size:12pt;" --}}
                                                {{--         class="fa fa-print"></i></button> --}}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $dt)
                                        <tr class="">
                                            <td>{{ $key + $data->firstItem() }}</td>
                                            <td>{{ $dt->nama_periksa }}</td>
                                            <td>{{ $dt->carabayar }}</td>
                                            <td>{{ $dt->kelas }}</td>
                                            <td>@currency($dt->tarif)</td>
                                            </td>
                                            <td style="width:5%;">
                                                <div style="display: flex; flex-direction: row;">
                                                    <button onclick="showEditModal('{{ $dt->id }}')"
                                                        class="btn btn-warning mr-1"><i class="fa fa-pencil"></i></button>
                                                    <form action="{{ route('periksa_dokter.destroy', $dt->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Yakin melanjutkan hapus data {{ $dt->nama_periksa }} ?')"
                                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="10">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3" style="width: 100%; margin-left:0;">
                            <div class="col-lg-6" style="display: flex; align-items: center;">
                                @if (sizeof($data) > 0)
                                    Showing data {{ $data->firstItem() }} to {{ $data->lastItem() }}, Page
                                    {{ $data->currentPage() }} of {{ $data->lastPage() }} @if ($keyword != '')
                                        (Filtered)
                                    @endif
                                @else
                                    Empty result @if ($keyword != '')
                                        (Filtered)
                                    @endif
                                @endif
                            </div>
                            <div class="col-lg-6" style="justify-content: flex-end; display: flex;">
                                {{ $data->appends(Request::only('keyword'))->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        function chooseFile() {
            //document.getElementById('fileInput').click();
            $('#uploadModal').modal('show');
        }
        $(document).ready(function() {
            var count_inputs = $('input[type="number"]');
            var total_tarif = 0;

            for (var i = 0; i < count_inputs.length; i++) {
                addEventListener("input", function() {
                    calculateTotal();
                });
            }

            function calculateTotal() {
                var total = 0;
                for (var i = 0; i < count_inputs.length; i++) {
                    //var getValue = parseNumber(count_inputs[i].value);
                    var value = parseFloat(count_inputs[i].value);
                    if (!isNaN(value)) {
                        total += value;
                    }
                }
                $('#total_tarif, #total_tarif_edit').val(total);
                total_tarif = total;
                // Lakukan tindakan lain dengan nilai total, seperti menampilkan atau menyimpannya
            }

            // saat input1 berubah ke input-input
            $('#nama, #nama_edit').on('change', function() {
                var text = $(this).val().toLowerCase().replace(/ /g, "-").replace(/\//g, "-");
                $('#slug, #slug_edit').val(text);
            });
        });


        function showEditModal(param) {
            var url = "{{ route('periksa_dokter.edit', ':id') }}";
            url = url.replace(':id', param);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                    $('#id_edit').val(response.id);
                    $('#nama_edit').val(response.nama_periksa);
                    $('#kelas_edit').val(response.kelas).trigger('change');
                    $('#carabayar_edit').val(response.carabayar).trigger('change');
                    $('#total_tarif_edit').val(response.tarif);
                    $('#margin_edit').val(response.margin);
                    $('#modalEdit').modal('show');
                },
                error: function(request, status, error) {
                    alert("Terjadi error saat edit data, silahkan hubungi admin");
                }
            })
        }

        function downloadExcel() {
            var url = "{{ route('periksa_dokter.download') }}";
            if (confirm("Apakah anda ingin melanjutkan download ?")) {
                window.location.href = url;
            } else {
                return false;
            }
        }
    </script>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select-2-add').select2({
                dropdownParent: $("#modalAdd"),
                templateSelection: function(data) {
                    var $result = $(
                        '<span class="select2-selection__rendered pt-1">' +
                        data.text +
                        '</span>'
                    );
                    return $result;
                },
            });

            $('.select-2-edit').select2({
                dropdownParent: $("#modalEdit"),
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
