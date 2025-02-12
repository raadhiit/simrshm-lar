@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Set token CSRF dari Laravel -->
    <div class="modal fade" id="editDetail" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('loader_bpjs_diverifikasi.update_detail') }}" method="POST"
                    enctype='multipart/form-data'>
                    @method('PUT')
                    @csrf
                    <input type="hidden" value="" name="id" id="id" />
                    <input type="hidden" value="" name="id_header" id="id_header" />
                    <div class="modal-body row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kelas Rawat</label>
                                <input class="form-control" type="text" value="" name="kelas_rawat"
                                    id="kelas_rawat" />
                            </div>
                            <div class="form-group">
                                <label>PTD</label>
                                <input class="form-control" type="text" value="" name="ptd" id="ptd" />
                            </div>
                            <div class="form-group">
                                <label>Admission Date</label>
                                <input class="form-control" type="date" value="" name="admission_date"
                                    id="admission_date" />
                            </div>
                            <div class="form-group">
                                <label>Discharge Date</label>
                                <input class="form-control" type="date" value="" name="discharge_date"
                                    id="discharge_date" />
                            </div>
                            <div class="form-group">
                                <label>Birth Date</label>
                                <input class="form-control" type="date" value="" name="birth_date"
                                    id="birth_date" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input class="form-control" type="text" value="" name="nama_pasien"
                                    id="nama_pasien" />
                            </div>
                            <div class="form-group">
                                <label>MRN</label>
                                <input class="form-control" type="text" value="" name="mrn" id="mrn" />
                            </div>
                            <div class="form-group">
                                <label>Umur (Tahun)</label>
                                <input class="form-control" type="text" value="" name="umur_tahun"
                                    id="umur" />
                            </div>
                            <div class="form-group">
                                <label>DPJP</label>
                                <input class="form-control" type="text" value="" name="dpjp" id="dpjp" />
                            </div>
                            <div class="form-group">
                                <label>SEP</label>
                                <input class="form-control" type="text" value="" name="sep" id="sep" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Loader Klaim BPJS Diverifikasi</h1>
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
                    <h4></h4>
                    <div class="card-body d-flex">
                        <a href="{{ route('loader_bpjs_diverifikasi.index') }}"
                            class="btn btn-primary mr-1 mb-3">Kembali</a>
                        <div>
                            <form action="{{ route('loader_bpjs_diverifikasi.generate_detail') }}" method="post"
                                accept-charset="utf-8">
                                @csrf
                                <input type="hidden" value="{{ $id_header }}" name="id_header" id="id_header" />
                                <input type="hidden" value="{{ $uri }}" name="uri" id="uri" />
                                <button type="submit" class="btn btn-warning"
                                    onclick="return confirm('Ingin generate data? Pastikan data sudah benar')">Generate</button>
                            </form>
                        </div>

                        {{-- <div class="card-header" style="margin-left: -25px;"> --}}
                        {{--     <div class="card-header-form"> --}}
                        {{--         <form method="get" action="{{ route('konsul_dokter.search') }}"> --}}
                        {{--             <div class="input-group"> --}}
                        {{--                 <input type="text" name="keyword" class="form-control" placeholder="Search" --}}
                        {{--                     value="{{ $keyword ?? '' }}"> --}}
                        {{--                 <div class="input-group-btn ml-2"> --}}
                        {{--                     <button type="submit" class="btn btn-primary"><i --}}
                        {{--                             class="fas fa-search"></i></button> --}}
                        {{--                 </div> --}}
                        {{--             </div> --}}
                        {{--         </form> --}}
                        {{--     </div> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas Rawat</th>
                                    <th>PTD</th>
                                    <th>Admission Date</th>
                                    <th>Discharge Date</th>
                                    <th>Birth Date</th>
                                    <th>Nama Pasien</th>
                                    <th>MRN</th>
                                    <th>Umur (tahun)</th>
                                    <th>DPJP</th>
                                    <th>SEP</th>
                                    <th>Noreg</th>
                                    <th>inacbgs</th>
                                    <th>Plafon BPJS</th>
                                    <th>Total HPP</th>
                                    <th>Selisih</th>
                                    <th>Id Jurnal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $key => $dt)
                                    <tr class="">
                                        <td>{{ $key + $data->firstItem() }}</td>
                                        <td>{{ $dt->kelas_rawat }}</td>
                                        <td>{{ $dt->ptd }}</td>
                                        <td>{{ date('d-m-Y', strtotime($dt->admission_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($dt->discharge_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($dt->birth_date)) }}</td>
                                        <td>{{ $dt->nama_pasien }}</td>
                                        <td>{{ $dt->mrn }}</td>
                                        <td>{{ $dt->umur_tahun }} Tahun</td>
                                        <td>{{ $dt->dpjp }}</td>
                                        <td>{{ $dt->sep }}</td>

                                        @if (isset($dt->noreg) &&
                                            isset($dt->inacbgs) &&
                                            isset($dt->plafon_bpjs) &&
                                            isset($dt->total_hpp) &&
                                            isset($dt->selisih))
                                            <td>{{ $dt->noreg }}</td>
                                            <td>{{ $dt->inacbgs }}</td>
                                            <td>@currency($dt->plafon_bpjs)</td>
                                            <td>@currency($dt->total_hpp)</td>
                                            <td>@currency($dt->selisih)</td>
                                        @else
                                            <td colspan="6" class="text-center">Data tidak ditemukan silahkan generate
                                                /
                                                <span style="cursor: pointer; color: blue; text-decoration: underline;"
                                                    onclick="modalEditDetail('{{ $dt->id }}')">periksa data</span>
                                            </td>
                                        @endif
                                        <td>{{ $dt->id_detail_draft }}</td>
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
        function modalEditDetail(id) {
            var url = "{{ route('loader_bpjs_diverifikasi.detail_edit', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                    $('#id').val(response.id);
                    $('#id_header').val(response.id_header);
                    $('#kelas_rawat').val(response.kelas_rawat);
                    $('#ptd').val(response.ptd);
                    $('#admission_date').val(response.admission_date);
                    $('#discharge_date').val(response.discharge_date);
                    $('#birth_date').val(response.birth_date);
                    $('#nama_pasien').val(response.nama_pasien);
                    $('#mrn').val(response.mrn);
                    $('#umur').val(response.umur_tahun);
                    $('#dpjp').val(response.dpjp);
                    $('#sep').val(response.sep);
                    $('#modalEdit').modal('show');
                },
                error: function(request, status, error) {
                    alert("Terjadi error saat edit data, silahkan hubungi admin");
                }
            })
            $('#editDetail').modal('show');
        }

        function generateDetail() {
            var isConfirmed = confirm('Ingin generate data? Pastikan data sudah benar');
            if (!isConfirmed) {
                return;
            }
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var id_header = "{{ $id_header }}";
            var uri = "{{ $uri }}";

            var url = "{{ route('loader_bpjs_diverifikasi.generate_detail') }}";
            //url = url.replace(':id', id_header);
            //console.log(url);
            //return;
            $.ajax({
                url: url,
                data: {
                    id_header: id_header,
                    uri: uri
                },
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                },
                error: function(request, status, error) {
                    alert("Terjadi error saat edit data, silahkan hubungi admin");
                }
            })

        }

        $(document).ready(function() {
            // saat input1 berubah ke input-input
            $('#nama, #nama_edit').on('change', function() {
                var text = $(this).val().toLowerCase().replace(/ /g, "-").replace(/\//g, "-");
                $('#slug, #slug_edit').val(text);
            });
        });


        function showEditModal(param) {
            var url = "{{ route('konsul_dokter.edit', ':id') }}";
            url = url.replace(':id', param);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                    $('#id_edit').val(response.id);
                    $('#nama_edit').val(response.nama_konsul);
                    $('#kelas_edit').val(response.kelas).trigger('change');
                    $('#carabayar_edit').val(response.carabayar).trigger('change');
                    $('#tarif_edit').val(response.tarif);
                    $('#modalEdit').modal('show');
                },
                error: function(request, status, error) {
                    alert("Terjadi error saat edit data, silahkan hubungi admin");
                }
            })
        }

        function downloadExcel() {

            var keyword = $('input[name=keyword]').val();
            {{-- var url = "{{ route('konsul_dokter.download') }}/?keyword=" + keyword; --}}
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
