@extends('layouts.app')
@section('content')
    <style>
        /* Mengatur posisi spinner */
        .spinner-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        /* Mengatur latar belakang yang diburamkan */
        .dim-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }
    </style>
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Pilih Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('loader_bpjs_layak.import') }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" value="" name="id_header" id="id_header" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fileInput">Pilih file template yang anda download</label>
                            <input type="file" class="form-control-file" id="fileInput" accept=".xlsx" name="file_xlsx">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-info mr-auto"
                            href="{{ asset('template/Template Data Loader Klaim BPJS Layak.xlsx') }}" data-toggle="tooltip"
                            title="Download Template Excel">Template</a>
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin-top: -15px;">
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Form Data Loader Klaim Layak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('loader_bpjs_layak.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body mt-3">
                        <div class="form-group">
                            <label for="">Tanggal Jurnal</label>
                            <input type="text" class="form-control dmypicker" required name="tanggal_jurnal"
                                id="tanggal_jurnal" placeholder="" value="{{ old('tanggal_jurnal') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Bulan Klaim</label>
                            <input type="text" class="form-control mypicker" required name="bulan_klaim" id="bulan_klaim"
                                placeholder="" value="{{ old('bulan_klaim') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Layanan</label>
                            <select class="form-control" name="jenis_layanan" id="jenis_layanan" required>
                                <option value="">--Silahkan Pilh Pilhan---</option>
                                <option value="0">Rawat Jalan</option>
                                <option value="1">Rawat Inap</option>
                            </select>
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
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Ubah Jenis Kunjungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('konsul_dokter.update', 0) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" hidden id="id_edit" name="id">
                    <div class="modal-body mt-3">
                        <div class="form-group">
                            <label for="">Nama Konsul</label>
                            <input type="text" class="form-control" required name="nama_konsul" id="nama_edit"
                                placeholder="" value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select class="form-control select-2-edit" name="kelas" id="kelas_edit">
                                <option value="">--Silahkan Pilh Pilhan---</option>
                                <option value="non_kelas">Non Kelas</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Carabayar</label>
                            <select class="form-control" name="carabayar" id="carabayar_edit">
                                <option value="">--Silahkan Pilh Pilhan---</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tarif</label>
                            <input type="number" class="form-control" required name="tarif" id="tarif_edit"
                                placeholder="" value="{{ old('tarif') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading UI -->
    <div id="box-loading" class="spinner-container" style="display: none;">
        <div class="card pl-3 pr-3">
            <div class="card-body text-center">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="sr-only">Loading...</span>
                </div>
                <h6 class="card-title mt-3">Loading...</h6>
                <p id="content_progress" style="margin-top: -10px;"></p>
            </div>
        </div>
    </div>

    <!-- Report UI -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalTitle">Proses Generate Data Selesai</h5>
                    <button onclick="directPage()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group" id="input_list">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button onclick="directPage()" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <div id="dim-content" class="dim-background" style="display: none;">
    </div>

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Loader Klaim BPJS Layak</h1>
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
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Jurnal</th>
                                        <th>Bulan Klaim</th>
                                        <th>Jenis Layanan</th>
                                        <th>Jumlah Data</th>
                                        <th>Nomor Jurnal</th>
                                        <th>Status</th>
                                        <th>Log Upload</th>
                                        <th>Log Hapus</th>
                                        <th>Log Generate</th>
                                        <th>
                                            <div class="row">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalAdd" title="Tambah Data Baru"><i
                                                        class="fas fa-plus"></i></button>
                                                {{-- <button onclick="downloadExcel()"class="btn btn-info" --}}
                                                {{--     style="margin-left:3px ;"><i style="font-size:12pt;" --}}
                                                {{--         class="fa fa-print"></i></button> --}}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @inject('loaderService', 'App\Services\LoaderBpjsLayakService')
                                    @forelse ($data as $key => $dt)
@php
    $status = $dt->prop == 'del' ? 'Hapus' : $loaderService->statusJurnal($dt->id_draft_jurnal, $dt->id);
@endphp
                                        <tr class="">
                                            <td>{{ $key + $data->firstItem() }}</td>
                                            <td>{{ date('d-m-Y', strtotime($dt->tanggal_jurnal)) }}</td>
                                            <td>{{ convertMonthYear($dt->bulan_klaim) ?? '-' }}</td>
                                            <td>{{ $dt->jenis_layanan == 1 ? 'Rawat Inap' : 'Rawat Jalan' }}</td>
                                            <td>{{ $loaderService->getDataDetail($dt->id)->get()->count() }}</td>
                                            <td>{{ $loaderService->getJurnalNum($dt->id_draft_jurnal) }}</td>
                                            <td>{{ $status }}
                                            </td>
                                            <td>{{ $dt->user_upload }} <br>
                                                {{ $dt->tanggal_upload != null ? date('d-m-Y H:i', strtotime($dt->tanggal_upload)) : '-' }}
                                            </td>
                                            <td>{{ $dt->user_hapus }} <br>
                                                {{ $dt->tanggal_hapus != null ? date('d-m-Y H:i', strtotime($dt->tanggal_hapus)) : '-' }}
                                            </td>
                                            <td>{{ $dt->user_generate }} <br>
                                                {{ $dt->tanggal_generate != null ? date('d-m-Y H:i', strtotime($dt->tanggal_generate)) : '-' }}
                                            </td>
                                            <td style="width:5%;">
                                                <div style="display: flex; flex-direction: row;">
                                                    @if ($dt->user_upload == null && $dt->tanggal_upload == null)
                                                        <button onclick="modalUpload('{{ $dt->id }}')"
                                                            class="btn btn-warning mr-1" data-toggle="tooltip"
                                                            title="Upload Detail Jurnal"><i
                                                                class="fas fa-cloud-upload-alt"></i></button>
                                                    @endif
                                                    @if ($dt->user_upload != null && $dt->tanggal_upload != null)
                                                        <a href="{{ route('loader_bpjs_layak.detail', $dt->id) }}"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Lihat Detail Data" class="btn btn-info mr-1"><i
                                                                class="fas fa-book-open"></i></a>
                                                    @endif
                                                    @if ($dt->user_hapus == null && $dt->tanggal_hapus == null && $status != 'Diterima' && $status != 'Ditolak')
                                                        @if ($dt->user_upload != null && $dt->tanggal_upload != null)
                                                            <button onclick="generateJurnal({{ $dt->id }})"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Generate Jurnal Auto"
                                                                class="btn btn-success mr-1"><i
                                                                    class="fas fa-sync"></i></button>
                                                        @endif
                                                        @if ($dt->id_draft_jurnal == null)
                                                            <form
                                                                action="{{ route('loader_bpjs_layak.destroy', $dt->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    onclick="return confirm('Yakin melanjutkan hapus data {{ $dt->nama_konsul }} ?')"
                                                                    class="btn btn-danger"><i
                                                                        class="fas fa-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    @endif
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function directPage() {
            window.location.href = "{{ route('loader_bpjs_layak.index') }}";
        }

        function generateJurnal(id) {
            var konfirmasi = confirm('Apakah ingin generate jurnal? Pastikan Jenis Layanan sudah sesuai');

            if (konfirmasi) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var url = "{{ route('loader_bpjs_layak.data_generate', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#box-loading').show();
                        $('#dim-content').show();
                        postToDraftHeader(response.header)
                            .then(function(
                                result
                            ) { // Result will be take id from klaim_bpjs_layak_details.id_draft_jurnal if success created 
                                messageProgress('Progres input data ke draf jurnal selesai....');
                                inputMessageModal('Input data header berhasil', 'black')
                                postToDraftDetail(response.detail, result);
                            })
                            .catch(function(error) {
                                // Handle faild process create 
                                hideLoading();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: error.errorMessage,
                                });
                            });
                    },
                    error: function(xhr, status, error) {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengambil data silahkan hubungi admin ',
                        });
                    }
                });
            }
        }

        function postToDraftDetail(dataDetail, idDraft) {
            if (dataDetail.length < 1) {
                hideLoading();
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: 'Semua data detail telah di-generate',
                });
                return;
            }
            for (var i = 0; i < dataDetail.length; i++) { // Using looping for checkin dataDetail count
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var message = 'Progres input data draft jurnal detail id ' + i + '....';
                messageProgress(message);
                var dataToSend = dataDetail[i];
                dataToSend.id_draft = idDraft; // Add properti idDraft to objek dataDetail[i]
                dataToSend.length_data = dataDetail.length;
                dataToSend.index_data = i;
                console.log(dataToSend);
                $.ajax({
                    url: "{{ route('loader_bpjs_layak.post_detail_draft') }}",
                    type: 'POST',
                    data: dataToSend,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        //console.log(response);
                        if (response.status == 'diajukan') {
                            inputMessageModal('Berhasil input data detail sep :' + response.no_sep, 'black');
                            hideLoading();
                            $('#reportModal').modal('show');
                        } else {
                            messageProgress('Proses input data detail sep :' + response.no_sep + '.....');
                            inputMessageModal('Berhasil input data detail sep :' + response.no_sep, 'black');
                        }
                    },
                    error: function(xhr, status, error) {
                        inputMessageModal('Error input data detail ' + xhr.responseText, 'red');
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat input data silahkan ulangi kembali, jika masalah terus berlanjut hubungi admin',
                        });
                        $('#reportModal').modal('show');
                    }
                });
            }
        }

        function postToDraftHeader(dataHeader) {
            return new Promise(function(resolve, reject) {
                messageProgress('Progres input data ke draf jurnal....');

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var dataToSend = dataHeader;
                var statusProses = false;

                $.ajax({
                    url: "{{ route('loader_bpjs_layak.post_draft') }}",
                    type: 'POST',
                    data: dataToSend,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        resolve(response);
                    },
                    error: function(xhr, status, error) {
                        reject({
                            errorType: 'process',
                            errorMessage: 'Terjadi kegagalan saat proses input data ke Draft Jurnal ' +
                                xhr.responseText
                        });
                    }
                });
            });
        }

        function inputMessageModal(message, color) {
            $('#input_list').append(
                '<li class="list-group-item" style="margin-bottom:5px; color:' + color + ';">' + message + '</li>'
            );
        }

        function messageProgress(param) {
            $('#dim-content').text('');
            $('#content_progress').text(param);
        }

        function hideLoading() {
            $('#box-loading').hide();
            $('#dim-content').hide();
        }

        function modalUpload(param) {
            $('#id_header').val(param);
            $('#uploadModal').modal('show');
        }

        $(".dmypicker")
            .datepicker({
                format: "dd-mm-yyyy",
                startView: "day",
                minViewMode: "day",
                autoclose: true,
            });

        $(".mypicker")
            .datepicker({
                format: "M yyyy",
                startView: "months",
                minViewMode: "months",
                autoclose: true,
            });
    </script>
@endsection
@push('scripts')
@endpush
