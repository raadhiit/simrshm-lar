<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rekonsiliasi Obat</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.3.7/jquery.datetimepicker.min.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <style type="text/css">
        .col-content {
            border-bottom: 1pt solid black;
            border-left: 1pt solid black;
            padding: 8px;
            vertical-align: top;
        }
        .col-content-end {
            border-bottom: 1pt solid black;
            border-left: 1pt solid black;
            border-right: 1pt solid black;
            padding: 8px;
            vertical-align: top;
        }
        .cell-content {
            border-right: 1px solid; 
            border-bottom: 1px solid; 
            padding: 8px;
            vertical-align: top;
        }
        .cell-content-end {
            border-bottom: 1px solid; 
            padding: 8px;
            vertical-align: top;
        }
        .cell-content-last_row {
            border-right: 1px solid; 
            padding: 8px;
            vertical-align: top;
        }
        .cell-content-last_row-end {
            padding: 8px;
            vertical-align: top;
        }

        input.erm-field {
            border: none;
            border-bottom: 1px dotted;
            width: 100%;
            font-size: 12px;
        }

        select.erm-select {
            border: none;
            border-bottom: 1px dotted;
            width: 100%;
            font-size: 10px;
        }

        textarea {
            resize: none;
            border: none;
            width: 100%;
            height: 100px;
            max-height: 100px;
            font-size: 12px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(240, 240, 240, 0.7);
            display: none;
            z-index: 100;
        }

        @media print {
            .col-md-1,.col-md-2,.col-md-3,.col-md-4,
            .col-md-5,.col-md-6,.col-md-7,.col-md-8, 
            .col-md-9,.col-md-10,.col-md-11,.col-md-12 {
                float: left;
            }

            .col-md-1 {
                width: 8%;
            }
            .col-md-2 {
                width: 16%;
            }
            .col-md-3 {
                width: 25%;
            }
            .col-md-4 {
                width: 33%;
            }
            .col-md-5 {
                width: 42%;
            }
            .col-md-6 {
                width: 50%;
            }
            .col-md-7 {
                width: 58%;
            }
            .col-md-8 {
                width: 66%;
            }
            .col-md-9 {
                width: 75%;
            }
            .col-md-10 {
                width: 83%;
            }
            .col-md-11 {
                width: 92%;
            }
            .col-md-12 {
                width: 100%;
            }

            .no-print {
                display: none !important;
            }

            select::-ms-expand {
                display: none;
            }

            select {
                /* for Firefox */
                -moz-appearance: none;
                /* for Chrome */
                -webkit-appearance: none;
            }

            input.erm-field {
                border: none !important;
            }

            select.erm-select {
                border: none !important;
            }

            input[type="date"]::-webkit-inner-spin-button,
            input[type="date"]::-webkit-calendar-picker-indicator {
                display: none;
                -webkit-appearance: none;
            }

            @page {
                padding-top: 0;
                padding-bottom: 0;
                size: landscape;
            }
        }
    </style>
</head>

<body style="margin: 20px;">
    <div id="overlay" class="overlay"></div>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach
    @endif
    @if(Session::has('gagal'))
    <div class="alert alert-danger">{{Session::get('gagal')}}</div>
    @endif
    @if(Session::has('sukses'))
    <div class="alert alert-success">{{Session::get('sukses')}}</div>
    @endif
    <form id="form_dokumen">
    @csrf
    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
    <div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12 text-right">
                <p style="font-size: 20px; font-weight: bold;">MR 03.14.001</p>
            </div>
            <div class="col-md-6 pl-0 pr-0">
                <div class="row" style="width:100%; margin-left: 0; border-left: 1px solid; border-top: 1px solid;">
                    <div class="col-md-2" style="display:flex; justify-content:center; align-items:center;">
                        <img id="logo_rs" src="{{ asset('filelogo/logo_rshm.png') }}" style="width: 100%;">
                    </div>
                    <div class="col-md-10 pt-4">
                        <h4>RUMAH SAKIT HARAPAN MULIA</h4>
                        <p style="font-size:12px">
                            Jl. Raya Cibarusah No.5, Cibarusahjaya, Kec. Cibarusah Kabupaten Bekasi
                            <br/>Telp: (021) 89952340 Email: info@rumahsakit-harapanmulia.com
                        </p>
                    </div>
                    <div class="col-md-12 text-center pt-4 pb-4" style="border-top:1px solid; border-bottom:1px solid">
                        <h4>REKONSILIASI OBAT</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pt-2 pb-2" style="border:1px solid">
                <table style="border-collapse:collapse;" id="profil_pasien">
                    <tr>
                        <td style="width: 30%;">No RM</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{$layanan->nrm}}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">No Register</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{$layanan->id}}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">Nama</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{$layanan->nama_pasien}}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">Jenis Kelamin</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ $pasien ? ($pasien->kelamin == 0 ? 'L' : 'P') : '-'}}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">Tgl Lahir</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ $pasien ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">Ruang</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ str_replace('_', ' ', strtoupper($layanan->last_ruangan)) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">Diagnosa</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td>{{ $diagnosa }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row" style="width:100%; margin-left: 0;">
        <div class="col-md-12 pl-0 pr-0 text-center">
            <table class="table" border="1" id="detail_data">
                <thead>
                    <tr>
                        <th width="1%">No.</th>
                        <th width="13%">NAMA OBAT</th>
                        <th width="8%">DOSIS</th>
                        <th width="8%">ATURAN PAKAI</th>
                        <th width="8%">CARA PEMBERIAN</th>
                        <th width="8%">TANGGAL MULAI</th>
                        <th width="8%">TANGGAL STOP / BERUBAH ATURAN PAKAI</th>
                        <th width="11%">PENGOBATAN PADA SAAT ADMISI</th>
                        <th width="11%">TINDAKLANJUT PENGOBATAN PADA MASA PERAWATAN (TRANSFER)</th>
                        <th width="11%">TINDAKLANJUT PENGOBATAN PADA SAAT PULANG (DISCHARGE)</th>
                        <th width="11%">PERUBAHAN ATURAN PAKAI</th>
                        <th width="2%" class="no-print">
                            <div class="btn btn-square-md btn-primary" onclick="add_new_row()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody id="detail_data_list">
                    @if ($data == null || count($data) == 0)
                    <tr id="no_data">
                        <td colspan="12" class="text-center">Tidak Ada Data</td>
                    </tr>
                    @else
                        @foreach ($data as $d)
                            <tr class="data">
                                <td style="display: none;">
                                    <input type="hidden" id="id" name="id[]" value="{{ $d->id }}">
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="deleted" name="deleted[]" value="">
                                </td>
                                <td width="1%" id="nomor">{{ $loop->iteration }}.</td>
                                <td width="13%">
                                    <textarea maxlength="64" id="nama_obat" name="nama_obat[]">{{ $d->nama_obat }}</textarea>
                                </td>
                                <td width="8%">
                                    <textarea maxlength="64" id="dosis" name="dosis[]">{{ $d->dosis }}</textarea>
                                </td>
                                <td width="8%">
                                    <textarea maxlength="64" id="aturan_pakai" name="aturan_pakai[]">{{ $d->aturan_pakai }}</textarea>
                                </td>
                                <td width="8%">
                                    <textarea maxlength="64" id="cara_pemberian" name="cara_pemberian[]">{{ $d->cara_pemberian }}</textarea>
                                </td>
                                <td width="8%">
                                    <input type="date" data-date-format="yyyy-mm-dd" id="tanggal_mulai" name="tanggal_mulai[]" class="erm-field" value="{{ $d->tanggal_mulai }}">
                                </td>
                                <td width="8%">
                                    <input type="date" data-date-format="yyyy-mm-dd" id="tanggal_selesai" name="tanggal_selesai[]" class="erm-field" value="{{ $d->tanggal_selesai }}">
                                </td>
                                <td width="11%">
                                    <select id="pengobatan_admisi" name="pengobatan_admisi[]" class="erm-select">
                                        <option 
                                            @if ($d->pengobatan_admisi == "LANJUT ATURAN PAKAI SAMA") 
                                                selected
                                            @endif
                                            value="LANJUT ATURAN PAKAI SAMA">LANJUT ATURAN PAKAI SAMA
                                        </option>
                                        <option 
                                            @if ($d->pengobatan_admisi == "LANJUT ATURAN PAKAI BERUBAH") 
                                                selected
                                            @endif
                                            value="LANJUT ATURAN PAKAI BERUBAH">LANJUT ATURAN PAKAI BERUBAH
                                        </option>
                                        <option 
                                            @if ($d->pengobatan_admisi == "STOP") 
                                                selected
                                            @endif
                                            value="STOP">STOP
                                        </option>
                                        <option 
                                            @if ($d->pengobatan_admisi == "TERAPI OBAT BARU") 
                                                selected
                                            @endif
                                            value="TERAPI OBAT BARU">TERAPI OBAT BARU
                                        </option>
                                    </select>
                                </td>
                                <td width="11%">
                                    <select id="tl_pengobatan_transfer" name="tl_pengobatan_transfer[]" class="erm-select">
                                        <option 
                                            @if ($d->tl_pengobatan_transfer == "LANJUT ATURAN PAKAI SAMA") 
                                                selected
                                            @endif
                                            value="LANJUT ATURAN PAKAI SAMA">LANJUT ATURAN PAKAI SAMA
                                        </option>
                                        <option 
                                            @if ($d->tl_pengobatan_transfer == "LANJUT ATURAN PAKAI BERUBAH") 
                                                selected
                                            @endif
                                            value="LANJUT ATURAN PAKAI BERUBAH">LANJUT ATURAN PAKAI BERUBAH
                                        </option>
                                        <option 
                                            @if ($d->tl_pengobatan_transfer == "STOP") 
                                                selected
                                            @endif
                                            value="STOP">STOP
                                        </option>
                                        <option 
                                            @if ($d->tl_pengobatan_transfer == "TERAPI OBAT BARU") 
                                                selected
                                            @endif
                                            value="TERAPI OBAT BARU">TERAPI OBAT BARU
                                        </option>
                                    </select>
                                </td>
                                <td width="11%">
                                    <select id="tl_pengobatan_discharge" name="tl_pengobatan_discharge[]" class="erm-select">
                                        <option 
                                            @if ($d->tl_pengobatan_discharge == "LANJUT ATURAN PAKAI SAMA") 
                                                selected
                                            @endif
                                            value="LANJUT ATURAN PAKAI SAMA">LANJUT ATURAN PAKAI SAMA
                                        </option>
                                        <option 
                                            @if ($d->tl_pengobatan_discharge == "LANJUT ATURAN PAKAI BERUBAH") 
                                                selected
                                            @endif
                                            value="LANJUT ATURAN PAKAI BERUBAH">LANJUT ATURAN PAKAI BERUBAH
                                        </option>
                                        <option 
                                            @if ($d->tl_pengobatan_discharge == "STOP") 
                                                selected
                                            @endif
                                            value="STOP">STOP
                                        </option>
                                        <option 
                                            @if ($d->tl_pengobatan_discharge == "TERAPI OBAT BARU") 
                                                selected
                                            @endif
                                            value="TERAPI OBAT BARU">TERAPI OBAT BARU
                                        </option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <textarea maxlength="64" id="perubahan_aturan_pakai" name="perubahan_aturan_pakai[]">{{ $d->perubahan_aturan_pakai }}</textarea>
                                </td>
                                <td width="2%" class="no-print">
                                    <div class="btn btn-square-md btn-danger" onclick="delete_row({{ $loop->iteration }})">
                                        <i class="fa fa-times"></i>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="row pt-1" style="width:100%; margin-left: 0;">
        <div class="col-md-3 pt-2 pb-2 text-center" style="vertical-align: middle; border-left: 1px solid; border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">
            NAMA DAN TTD APOTEKER
        </div>
        <div class="col-md-3 pt-2 pb-2 text-center" style="vertical-align: middle; border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">
            REKONSILIASI (MEMBANDINGKAN)
        </div>
        <div class="col-md-3 pt-2 pb-2 text-center" style="vertical-align: middle; border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">
            NAMA DAN TTD DOKTER
        </div>
        <div class="col-md-3 pt-2 pb-2 text-center" style="vertical-align: middle; border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">
            PETUNJUK BAGI DOKTER
        </div>
    </div>
    <div class="row" style="width:100%; margin-left: 0;">
        <div class="col-md-3 pt-2 pb-2 text-center" style="border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">
            <div id="box_verifikasi_apoteker" onclick="open_modal_verifikasi_apoteker()">
                @if($single_data && $single_data->id_apoteker != 0)
                <img src="{{ env('SMIS_UPLOAD_URL').'/'.($verifikator_apoteker ? $verifikator_apoteker->ttd : '') }}" alt="" style="width: 4cm; height:2.5cm;">
                <br>
                ({{ ($single_data ? $single_data->nama_apoteker : '') }})
                @else
                <br>
                <br>
                <div class="no-print">Verifikasi dan Simpan</div>
                <br>
                <br>
                (.............................................................)
                <br>
                @endif
            </div>
        </div>
        <div class="col-md-3 pt-2 pb-2" style="border-right: 1px solid; border-bottom: 1px solid; font-size: small;">
            <ul>
                <li>DAFTAR PENGGUNAAN OBAT SEBELUM ADMISI</li>
                <li>DAFTAR PENGGUNAAN OBAT SAAT PERAWATAN</li>
                <li>DAFTAR PENGGUNAAN OBAT SAAT PULANG</li>
            </ul>
        </div>
        <div class="col-md-3 pt-2 pb-2 text-center" style="border-right: 1px solid; border-bottom: 1px solid;">
            <div id="box_verifikasi_dokter" onclick="open_modal_verifikasi_dokter()">
                @if($dokumen && $dokumen->id_verifikator != 0)
                <img src="{{ env('SMIS_UPLOAD_URL').'/'.($verifikator_dokter ? $verifikator_dokter->ttd : '') }}" alt="" style="width: 4cm; height:2.5cm;">
                <br>
                ({{ ($dokumen ? $dokumen->nama_verifikator : '') }})
                @else
                <br>
                <br>
                <div class="no-print">Verifikasi dan Simpan</div>
                <br>
                <br>
                (.............................................................)
                <br>
                @endif
            </div>
        </div>
        <div class="col-md-3 pt-2 pb-2" style="border-right: 1px solid; border-bottom: 1px solid; font-size: small;">
            <ul>
                <li>Dokter menjelaskan obat yang tidak dilanjutkan dan didokumentasikan dalam catatan terintegrasi</li>
                <li>Dokter akan Mereview daftar penggunaan obat di atas</li>
            </ul>
        </div>
    </div>
    </form>

    <div class="modal fade" id="modal_verifikasi_apoteker" tabindex="-1" role="dialog" aria-labelledby="Verifikasi Apoteker" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_verifikator">Verifikasi Apoteker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verifikasi_apoteker">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_verifikasi_dokter" tabindex="-1" role="dialog" aria-labelledby="Verifikasi Dokter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_verifikator">Verifikasi Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verifikasi_dokter">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_verifikasi_dokter" tabindex="-1" role="dialog" aria-labelledby="Verifikasi Dokter" aria-hidden="true">
        <div class="modal-content">
            <form id="form_update_info_apoteker">
                @csrf
                <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                <input type="hidden" id="id_apoteker" name="id_apoteker" value="">
                <input type="hidden" id="nama_apoteker" name="nama_apoteker" value="">
            </form>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        var verif = '{{$dokumen->status}}';
        if (verif != 0) {
            window.scrollTo({
                left: 0,
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        }
        $('.timepicker').datetimepicker({
            datepicker: false,
            format: 'H:i',
            step: 1
        });
    });

    $('input[type="checkbox"]').change(function() {
        let id = $(this).attr('id');
        if (this.checked)
            $('[name=' + id + ']').val(1);
        else
            $('[name=' + id + ']').val(0);
    });

    $("textarea").keydown(function(e){
        if (
            (e.keyCode == 13 && !e.shiftKey) || 
            (e.keyCode == 13 && e.shiftKey)
        ) {
            e.preventDefault();
            return false;
        }
    });

    function open_modal_verifikasi_apoteker() {
        $('#modal_verifikasi_apoteker').modal('show');
    }

    function open_modal_verifikasi_dokter() {
        $('#modal_verifikasi_dokter').modal('show');
    }

    $('#form_verifikasi_apoteker').submit(function(e) {
        e.preventDefault();
        $('#modal_verifikasi_apoteker').modal('hide');
        showOverlay();
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/rekonsiliasi_obat/verifikasi_apoteker') }}",
            data: $('#form_verifikasi_apoteker').serialize(),
            method: 'post',
            success: function(response) {
                if (response.status) {
                    $('#id_apoteker').val(response.id_apoteker);
                    $('#nama_apoteker').val(response.nama_apoteker);
                    $.ajax({
                        url: "{{ url('e_rekam_medis/detail/rekonsiliasi_obat/store') }}",
                        data: $('#form_dokumen').serialize(),
                        method: 'post',
                        success: function(response) {
                            if (!response.status) {
                                dismissOverlay();
                                $('#modal_verifikasi_apoteker').modal('show');
                                toastr.error(response.message);
                                return;
                            }
                            $.ajax({
                                url: "{{ url('e_rekam_medis/detail/rekonsiliasi_obat/update_info_apoteker') }}",
                                data: $('#form_update_info_apoteker').serialize(),
                                method: 'post',
                                success: function(response) {
                                    if (!response.status) {
                                        dismissOverlay();
                                        $('#modal_verifikasi_apoteker').modal('show');
                                        toastr.error(response.message);
                                        return;
                                    }
                                    dismissOverlay();
                                    toastr.success(response.message);
                                    location.reload();
                                }
                            });
                        }
                    });
                } else {
                    dismissOverlay();
                    $('#modal_verifikasi_apoteker').modal('show');
                    toastr.error(response.message);
                }
            }
        });
    });

    $('#form_verifikasi_dokter').submit(function(e) {
        e.preventDefault();
        $('#modal_verifikasi_dokter').modal('hide');
        showOverlay();
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/rekonsiliasi_obat/verifikasi_dokter') }}",
            data: $('#form_verifikasi_dokter').serialize(),
            method: 'post',
            success: function(response) {
                if (response.status) {
                    $.ajax({
                        url: "{{ url('e_rekam_medis/detail/rekonsiliasi_obat/store') }}",
                        data: $('#form_dokumen').serialize(),
                        method: 'post',
                        success: function(response) {
                            if (!response.status) {
                                dismissOverlay();
                                $('#modal_verifikasi_dokter').modal('show');
                                toastr.error(response.message);
                                return;
                            }
                            dismissOverlay();
                            toastr.success(response.message);
                            location.reload();
                        }
                    });             
                } else {
                    dismissOverlay();
                    $('#modal_verifikasi_dokter').modal('show');
                    toastr.error(response.message);
                }
            }
        });
    });

    function add_new_row() {
        if ($('#no_data').length > 0)
            $('#no_data').remove();
        let r_num = $('#detail_data_list tr.data').length + 1;
        $('#detail_data_list').append(
            '<tr class="data">' +
                '<td style="display: none;">' +
                    '<input type="hidden" id="id" name="id[]" value="">' +
                '</td>' +
                '<td style="display: none;">' +
                    '<input type="hidden" id="deleted" name="deleted[]" value="">' +
                '</td>' +
                '<td width="1%" id="nomor"></td>' +
                '<td width="13%">' +
                    '<textarea maxlength="64" id="nama_obat" name="nama_obat[]"></textarea>' +
                '</td>' +
                '<td width="8%">' +
                    '<textarea maxlength="64" id="dosis" name="dosis[]"></textarea>' +
                '</td>' +
                '<td width="8%">' +
                    '<textarea maxlength="64" id="aturan_pakai" name="aturan_pakai[]"></textarea>' +
                '</td>' +
                '<td width="8%">' +
                    '<textarea maxlength="64" id="cara_pemberian" name="cara_pemberian[]"></textarea>' +
                '</td>' +
                '<td width="8%">' +
                    '<input type="date" data-date-format="yyyy-mm-dd" id="tanggal_mulai" name="tanggal_mulai[]" class="erm-field" value="">' +
                '</td>' +
                '<td width="8%">' +
                    '<input type="date" data-date-format="yyyy-mm-dd" id="tanggal_selesai" name="tanggal_selesai[]" class="erm-field" value="">' +
                '</td>' +
                '<td width="11%">' +
                    '<select id="pengobatan_admisi" name="pengobatan_admisi[]" class="erm-select">' +
                        '<option value="LANJUT ATURAN PAKAI SAMA">LANJUT ATURAN PAKAI SAMA</option>' +
                        '<option value="LANJUT ATURAN PAKAI BERUBAH">LANJUT ATURAN PAKAI BERUBAH</option>' +
                        '<option value="STOP">STOP</option>' +
                        '<option value="TERAPI OBAT BARU">TERAPI OBAT BARU</option>' +
                    '</select>' +
                '</td>' +
                '<td width="11%">' +
                    '<select id="tl_pengobatan_transfer" name="tl_pengobatan_transfer[]" class="erm-select">' +
                        '<option value="LANJUT ATURAN PAKAI SAMA">LANJUT ATURAN PAKAI SAMA</option>' +
                        '<option value="LANJUT ATURAN PAKAI BERUBAH">LANJUT ATURAN PAKAI BERUBAH</option>' +
                        '<option value="STOP">STOP</option>' +
                        '<option value="TERAPI OBAT BARU">TERAPI OBAT BARU</option>' +
                    '</select>' +
                '</td>' +
                '<td width="11%">' +
                    '<select id="tl_pengobatan_discharge" name="tl_pengobatan_discharge[]" class="erm-select">' +
                        '<option value="LANJUT ATURAN PAKAI SAMA">LANJUT ATURAN PAKAI SAMA</option>' +
                        '<option value="LANJUT ATURAN PAKAI BERUBAH">LANJUT ATURAN PAKAI BERUBAH</option>' +
                        '<option value="STOP">STOP</option>' +
                        '<option value="TERAPI OBAT BARU">TERAPI OBAT BARU</option>' +
                    '</select>' +
                '</td>' +
                '<td width="10%">' +
                    '<textarea maxlength="64" id="perubahan_aturan_pakai" name="perubahan_aturan_pakai[]"></textarea>' +
                '</td>' +
                '<td width="2%" class="no-print">' +
                    '<div class="btn btn-square-md btn-danger" onclick="delete_row(' + r_num + ')">' +
                        '<i class="fa fa-times"></i>' +
                    '</div>' +
                '</td>' +
            '</tr>'
        );
        render();
    }

    function delete_row(number) {
        let id = $('#detail_data_list tr.data:eq(' + (number - 1) + ') td:eq(0) input#id').val();
        if (id == "")
            $('#detail_data_list tr.data:eq(' + (number - 1) + ')').remove();
        else {
            $('#detail_data_list tr.data:eq(' + (number - 1) + ')').hide();
            $('#detail_data_list tr.data:eq(' + (number - 1) + ') td:eq(1) input#deleted').val(true);
        }
        render();
    }

    function render() {
        let nor = $('#detail_data_list tr.data').length;
        if (nor > 0) {
            let nomor = 1;
            let exist_nor = 0;
            for (var i = 1; i <= nor; i++) {
                let deleted = $('#detail_data_list tr.data:eq(' + (i - 1) + ') td:eq(1) input#deleted').val();
                if (!deleted) {
                    $('#detail_data_list tr.data:eq(' + (i - 1) + ') td#nomor').html(nomor++);
                    exist_nor++;
                }
                let id = $('#detail_data_list tr.data:eq(' + (i - 1) + ') td:eq(0) input#id').val();
                if (id == "") {
                    $('#detail_data_list tr.data:eq(' + (i - 1) + ') td:eq(12) div.btn').attr("onclick", "delete_row(" + i + ")");
                }
            }
            if (exist_nor == 0) {
                if ($('#no_data').length == 0) {
                    $('#detail_data_list').append(
                        '<tr id="no_data">' +
                            '<td colspan="12" class="text-center">Tidak Ada Data</td>' +
                        '</tr>'
                    );
                }
            }
        } else {
            $('#detail_data_list').html(
                '<tr id="no_data">' +
                    '<td colspan="12" class="text-center">Tidak Ada Data</td>' +
                '</tr>'
            );
        }
    }

    function showOverlay() {
        $('#overlay').show();
    }

    function dismissOverlay() {
        $('#overlay').hide();
    }
</script>

</html>
