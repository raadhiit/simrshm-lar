@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

    <div class="main-content">
        <div class="modal fade" id="modal_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Checklist Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th><b>PERSYARATAN BPJS RAJAL</b></th>
                                    <th class="text-center"><b>Ada</b></th>
                                </thead>
                                <tbody id="tbody_list_dokumen">
                                </tbody>
                            </table>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th><b>PERSYARATAN BPJS RAJAL POLI (FISIOTERAPI)</b></th>
                                    <th class="text-center"><b>Ada</b></th>
                                </thead>
                                <tbody id="tbody_list_dokumen2">
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <div class="modal-footer">
                        <button id="btn_merge_dokumen" type="button" class="btn btn-success">Merge Dokument</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Checklist Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" id="uploadFormManual" >
                          @csrf
                          <div class="form-group" >
                              <label for="">Upload File</label>
                              <input type="hidden" name="noreg" id="noreg_hidden">
                              <input type="hidden" name="document_code" id="document_code_hidden">
                              <input type="hidden" name="name_document" id="name_document_hidden">
                              <input class="form-control" type="file" name="upload_file" value="">
                          </div>
                          <button class="btn btn-primary" type="submit">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="section-header">
                <h1>Casemix</h1>
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
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class=" nav-link {{ ($slug ?? '') == 'data_pasien' ? 'active' : '' }}"
                                    href="{{ route('casemix.index') }}?slug=data_pasien" style="font-weight:bold;"><i
                                        class="fas fa-star"></i>Data Pasien</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ ($slug ?? '') == 'folder' ? 'active' : '' }}"
                                    href="{{ route('casemix.index') }}?slug=folder" style="font-weight:bold;"><i
                                        class="fas fa-folder"></i> Folder</a>
                            </li>
                        </ul>
                    </div>
                    <h4></h4>
                    <div class="card-body">
                        @if (($slug ?? '') == 'folder')
                            @include('casemix.folder')
                        @else
                            @include('casemix.data_pasien')
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
