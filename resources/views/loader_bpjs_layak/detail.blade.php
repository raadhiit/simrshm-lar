@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Data Loader Klaim BPJS Layak</h1>
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
                    <div class="card-body">
                        <a href="{{route('loader_bpjs_layak.index')}}" class="btn btn-primary mr-1 mb-3">Kembali</a>
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
                        {{-- </div> --}}
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. SEP</th>
                                        <th>Tgl. Verifikasi</th>
                                        <th>Biaya Riil RS</th>
                                        <th>Biaya Diajukan</th>
                                        <th>Biaya Disetujui</th>
                                        <th>Log Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $dt)
                                        <tr class="">
                                            <td>{{ $key + $data->firstItem() }}</td>
                                            <td>{{ $dt->no_sep }}</td>
                                            <td>{{ $dt->tgl_verifikasi }}</td>
                                            <td>@currency($dt->biaya_rs)</td>
                                            <td>@currency($dt->biaya_diajukan)</td>
                                            <td>@currency($dt->biaya_disetujui)</td>
                                            </td>
                                            <td>{{$dt->id_detail_draft}}</td>
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
