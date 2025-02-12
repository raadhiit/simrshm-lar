<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Catatan Perkembangan Pasien Terintegrasi</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <style type="text/css">
        #data_diri_header tr td {
            font-size: 16px;
            vertical-align: top;
        }

        #data_diri_ttd tr td {
            font-size: 20px;
            vertical-align: top;
        }

        #list_numbering li {
            font-size: 18px;
            list-style-type: decimal;
        }

        #list_alfabeth li {
            font-size: 18px;
            list-style-type: lower-alpha;
        }

        .kbw-signature {
            width: 100%;
            height: 450px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
            position: relative;
            left: 0;
            top: 0;
            border: 1px solid;
        }

        #sig {
            opacity: 0.5;
        }

        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
            cursor: pointer;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }

        .table_isian {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian td {}

        .table_isian_bordered td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        .table_isian_bordered th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        .table_isian2 tr {
            border: 1px solid black;
            border-collapse: collapse;
        }

        #tabel_obat_resep tr td {
            border: 1px solid transparent !important;
            white-space: nowrap;
            padding: 0px 5px;
        }

        #tabel_obat_resep {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>

<body style="margin: 20px;">
    @if(Session::has('success'))
    <script>
        alert('{{ Session::get("success") }}');
    </script>
    @endif
    @if(Session::has('failed'))
    <script>
        alert('{{ Session::get("failed") }}');
    </script>
    @endif
    @include('erm.riwayat_laboratorium')
    @include('erm.riwayat_radiologi')
    <div class="modal fade" id="modal_tambah_asesmen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih PPA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_tambah_asesmen">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Jenis PPA</label>
                            <select name="jenis_ppa" class="form-control" required>
                                <option value="">Pilih Salah Satu</option>
                                <option value="dpjp_utama">DPJP Utama</option>
                                <option value="dpjp_pendamping">DPJP Pendamping</option>
                                <option value="ns">Ns</option>
                                <option value="dr">Dr. Ruangan</option>
                                <option value="fp">Ft</option>
                                <option value="apt">Apt</option>
                                <option value="gizi">Gz</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Buat Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('e_rekam_medis/detail/verifikasi_dokumen_kunjungan') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
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

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ url('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi_v2?dokumen='.$dokumen->id) }}" class="btn btn-success">CPPT Saat Ini</a>
            <a href="{{ url('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi_v2/asesmen_medis_terakhir?dokumen='.$dokumen->id) }}" class="btn btn-outline-secondary">Asesmen Medis Terakhir</a>
            <a href="{{ url('e_rekam_medis/detail/catatan_perkembangan_pasien_terintegrasi_v2/riwayat?dokumen='.$dokumen->id) }}" class="btn btn-outline-secondary">Riwayat CPPT</a>
            <button class="btn btn-primary" id="btn_riwayat_lab">Riwayat Laboratorium</button>
            <button class="btn btn-info" id="btn_riwayat_rad">Riwayat Radiologi</button>
        </div>
    </div>
    <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-lg-6" style="border: 1px solid;">
            <div class="row" style="width: 100%;">
                <div class="col-lg-3" style="">
                    <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
                </div>
                <div class="col-lg-9" style="margin-top: 10px">
                    <p style="font-weight: bold; font-size:18px; text-align: left">
                        RUMAH SAKIT HARAPAN MULIA
                    </p>
                    <p style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
                        <span style="font-weight: normal">
                            Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                            <br>Kabupaten Bekasi Jawa Barat (17340).
                            <br>Telp.: (021) 8995 2340
                            <br>Email : info@rumahsakit-harapanmulia.id
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6" style="width: 100%; margin-left: 0; border:1px solid; padding:10px;">
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px;">
                <tr>
                    <td style="width: 40%;">Nama</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nama_pasien }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">No Rekam Medis</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nrm }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Tgl Lahir</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis Kelamin</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">NIK</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->ktp }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="margin-top: -17px;">
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
                <h6 style="color: white">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI</h6>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-right pt-2 pb-2 pr-0">
                <button class="btn btn-success" onclick="openModalTambahAsesmen()"><i class="fa fa-plus"></i>
                    Tambah Asesmen</button>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-left: 0;">
            <table style="width: 100%;" class="table_isian_bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%">Tanggal/Jam</th>
                        <th class="text-center" style="width: 20%">Profesi<br>(PPA)</th>
                        <th class="text-center" style="width: 30%">HASIL PEMERIKSAAN, ANALISA, RENCANA
                            PELATALAKSANAAN PASIEN</th>
                        <th class="text-center" style="width: 20%">Instruksi Tenaga Kesehatan Termasuk Pasca Bedah /
                            Prosedur</th>
                        <th class="text-center">DPJP</th>
                    </tr>
                </thead>
                <tbody id="body_dokumen"></tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="row">
                                <div class="col-3" style="text-align: right">PPA:</div>
                                <div class="col-2">Dr: Dokter</div>
                                <div class="col-2">Ns: Perawat</div>
                                <div class="col-2">Ft: Fisioterapi</div>
                                <div class="col-3">Apt: Apoteker</div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
        <div style="text-align: center;" class="col-md-12">
            <a href="{{ url('e_rekam_medis/detail/pdf_catatan_perkembangan_pasien_terintegrasi_rawat_inap?dokumen=' . $dokumen->id) }}" class="btn btn-success" target="_blank">Download PDF</a>
        </div>
    </div>

    <div class="modal fade" id="modal_diagnosa" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asesmen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_diagnosa">
                    <input type="hidden" name="id_diagnosa" id="id_diagnosa">
                    <input type="hidden" name="id" id="id_cppt">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="POST" />
                    <input type="hidden" name="noreg" value="{{ $layanan->id }}" />
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}" />
                    <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}" id="id_dokter" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" readonly class="form-control" value="{{ date('Y-m-d', strtotime($dokumen->created_at)) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Asal Ruangan</label>
                            <input type="hidden" name="ruangan" id="ruangan" value="{{ $layanan->last_ruangan }}" readonly class="form-control">
                            <input type="text" value="{{ $layanan->last_nama_ruangan }}" readonly class="form-control">
                        </div>
                        <hr>
                        <p style="font-weight: bold; font-size:14px;">DATA DOKTER / PSIKOLOG</p>
                        <div class="form-group">
                            <label for="">Dokter / Psikolog</label>
                            <input type="text" name="dokter" value="{{ Auth::user()->realname }}" id="dokter" readonly class="form-control">
                        </div>
                        <input type="hidden" name="nip_dokter" value="{{ $employee ? $employee->nip : '' }}" id="nip_dokter" readonly class="form-control">
                        <hr>
                        <p style="font-weight: bold; font-size:14px;">DIAGNOSA</p>
                        <div id="diagnosa">
                            <div class="form-group">
                                <label for="">Diagnosa Utama</label>
                                <input type="text" class="form-control" name="diagnosa" id="diagnosa_primer">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 1</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_satu" id="diagnosa_sekunder_satu">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 2</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_dua" id="diagnosa_sekunder_dua">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 3</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_tiga" id="diagnosa_sekunder_tiga">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 4</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_empat" id="diagnosa_sekunder_empat">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 5</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_lima" id="diagnosa_sekunder_lima">
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="">Diagnosa Pembanding</label>
                                <input type="text" class="form-control" name="diagnosa_pembanding" id="diagnosa_pembanding">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dokter_e_resep" tabindex="-1" style="overflow-y: scroll;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <table class="table" id="tabel_dokter_e_resep" style="width: 100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>NIP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: 14px;">
                    <table id="tabel_preview" style="border: 1px solid; width:100%;">
                        <tr style="border:1px solid;">
                            <td style="padding: 10px;">
                                <p style="text-align:center"><b>RUMAH SAKIT HARAPAN MULIA</b><br>Jl. Raya Cibarusah No.
                                    5 Kebon Kopi, Cibarusah Jaya
                                    <br><b>Kabupaten Bekasi Jawa Barat</b>
                                </p>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 40%">Dokter</td>
                                        <td style="width: 3%"> : </td>
                                        <td style="width: 57%" id="preview_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>SIP</td>
                                        <td> : </td>
                                        <td id="preview_sip_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Unit Pelayanan</td>
                                        <td> : </td>
                                        <td id="preview_unit_pelayanan" style="text-transform: uppercase">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Catatan Obat Racikan</td>
                                        <td> : </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td id="preview_catatan_obat_racikan" colspan="3">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td colspan="4" style="text-align: right">
                                            Bekasi, <span id="preview_tanggal"></span>
                                        </td>
                                    </tr>
                                </table>
                                <table style="width: 100%;" id="preview_list_obat"></table>
                            </td>
                        </tr>
                        <tr style="border: 1px solid red;">
                            <td style="border: 1px solid; padding:10px;">
                                <table style="width: 100%">
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td> :</td>
                                        <td>{{ $pasien->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Reg</td>
                                        <td> :</td>
                                        <td>{{ $layanan->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. RM</td>
                                        <td> :</td>
                                        <td>{{ $layanan->nrm }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td> :</td>
                                        <td>{{ $pasien->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Pasien</td>
                                        <td> :</td>
                                        <td style="text-transform: uppercase">
                                            {{ str_replace('_', ' ', $layanan->carabayar) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Perusahaan</td>
                                        <td> :</td>
                                        <td>{{ $layanan->nama_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Asuransi</td>
                                        <td> :</td>
                                        <td>{{ $layanan->asuransi == null ? '' : $layanan->asuransi }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- modal list obat -->
    <div class="modal fade" id="modal_list_obat" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="msg_list_obat"></div>
                    <div class="row">
                        <div class="col-lg-8"></div>
                        <form class="col-lg-4" id="form_search_obat">
                            <div class="input-group">
                                <input type="hidden" id="tipe_form_search_obat">
                                <input type="text" id="search_obat" placeholder="Cari.." class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table-striped" id="tabel_list_obat" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>Obat</th>
                                <th>Jenis</th>
                                <th>Zat Aktif</th>
                                <th>Komposisi</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- end modal list obat -->

    <!-- modal list riwayat eResep -->
    <div class="modal fade" id="modal_list_riwayat_eresep" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Riwayat eResep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_browse_riwayat_eresep_button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div id='riwayat_eresep_section' class="col-lg-7">
                            <div id="msg_list_riwayat_eresep"></div>
                            <table class="table-striped" id="tabel_list_riwayat_eresep" style="width: 100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No. Resep</th>
                                        <th>Tanggal</th>
                                        <th>Nama Dokter</th>
                                        <th>Poli</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id='detail_riwayat_eresep_section' class="col-lg-5">
                            <table class="table-striped" id="tabel_list_detail_riwayat_eresep" style="width: 100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama Obat</th>
                                        <th>Signa</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- end modal list riwayat eResep -->

    <!-- modal e_resep -->
    <div class="modal fade" style="overflow-y: scroll" id="modal_resep" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulir E-Resep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_e_resep">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="detail" id="detail_resep">
                    <input type="hidden" name="id_resep" id="id_resep">
                    <input type="hidden" name="id" id="id_cppt_resep">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="ruangan" value="{{ $layanan->last_ruangan }}">
                    <div class="modal-body">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Waktu</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" name="waktu" id="e_resep_waktu" type="date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">NRM</label>
                                    <input class="form-control" name="nrm" value="{{ $pasien->id }}" id="e_resep_nrm" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input class="form-control" name="usia" value="{{ $layanan->umur }} Tahun" id="e_resep_usia" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Asuransi</label>
                                    <input class="form-control" name="asuransi" id="e_resep_asuransi" value="{{ $layanan->asuransi }}" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dokter" value="{{ Auth::user()->realname }}" id="e_resep_dokter" type="text" readonly>
                                        <input class="form-control" name="id_dokter" value="{{ Auth::user()->id }}" id="e_resep_id_dokter" type="hidden">
                                        <div class="input-grou-append">
                                            <button class="btn btn-dark" type="button" onclick="open_modal_dokter_e_resep('tambah')"><i class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" name="nama" value="{{ $pasien->nama }}" id="e_resep_nama" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Badan</label>
                                    <input class="form-control" name="berat_badan" value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '' }}" id="e_resep_berat_badan" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Depo Tujuan</label>
                                    <select name="depo_tujuan" id="e_resep_depo_tujuan" class="form-control">
                                        <option value="depo_farmasi">DEPO FARMASI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">SIP</label>
                                    <input class="form-control" name="sip" id="e_resep_sip" value="{{ Session::has('sip') ? Session::get('sip') : '' }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="alamat" id="e_resep_alamat" value="{{ $pasien->alamat }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Pasien</label>
                                    <input class="form-control" name="jenis_pasien" id="e_resep_jenis_pasien" value="{{ $layanan->carabayar }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Obat Racikan</label>
                                    <textarea style="height: 100%;" name="catatan_obat_racikan" id="e_resep_obat_racikan" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">No. Reg</label>
                                    <input class="form-control" name="noreg" value="{{ $dokumen->noreg }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Telp</label>
                                    <input class="form-control" name="telp" value="{{ $pasien->telpon }}" id="e_resep_telp" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <input class="form-control" name="perusahaan" id="e_resep_perusahaan" value="{{ $layanan->nama_perusahaan }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Catatan</label>
                                    <textarea style="height: 100%;" name="catatan" id="e_resep_catatan" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12" style="border: 1px dashed"></div>
                        </div>
                        <div class="row pt-3" style="width: 100%; margin-left: 0;">
                            <input type="hidden" id="e_resep_id_obat" readonly class="form-control">
                            <input type="hidden" id="e_resep_index_edit" readonly class="form-control">
                            <div class="col-lg-4">
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;" onclick="browse_riwayat_eresep('add')">Copy Riwayat eResep</button>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label for="">Kode</label>
                                    <input type="text" id="e_resep_kode_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Obat</label>
                                    <div class="input-group">
                                        <input type="text" id="e_resep_nama_obat" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button" onclick="open_modal_list_obat()"><i class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label for="">Jenis</label>
                                    <input type="text" id="e_resep_jenis_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Sisa</label>
                                    <input type="text" id="e_resep_sisa_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <input type="text" id="e_resep_satuan_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga (Rp.)</label>
                                    <input type="text" id="e_resep_harga_obat" readonly class="form-control">
                                    <input type="hidden" id="e_resep_markup" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" id="e_resep_jumlah_obat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Signa</label>
                                    <input class="form-control" name="signa" id="e_resep_signa" type="text">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;" onclick="simpan_detail_e_resep()">Simpan
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-8 pr-0" style="padding-top: 30px; font-size:12px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center" style="line-height: 1.15">
                                                <th>No</th>
                                                <th>Obat</th>
                                                <th>Jenis</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
                                                <th>Subtotal</th>
                                                <th>Signa</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_detail_e_resep"></tbody>
                                        <tfoot id="footer_list_detail_e_resep"></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12 pl-0 pr-0" id="msg_e_resep"></div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal e_resep -->

    <!-- Modal lab -->
    <div class="modal fade" id="modal_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesanan Lab</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_laboratorium" method="post">
                    <input type="hidden" name="keluhan_klinis">
                    <input type="hidden" name="id" id="id_cppt_lab">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="id_pesanan" id="id_lab">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" class="form-control" name="noreg" value="{{ $layanan->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" name="nama_pasien" value="{{ $pasien->nama }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">NRM</label>
                            <input type="text" name="nrm" value="{{ $pasien->id }}" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">L/P</label>
                            <select name="kelamin" disabled class="form-control">
                                <option value="1" @if ($layanan->kelamin == 1) {{ 'selected' }} @endif>
                                    Perempuan
                                </option>
                                <option value="0" @if ($layanan->kelamin == 0) {{ 'selected' }} @endif>
                                    Laki-Laki
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Umur</label>
                            <input type="text" readonly value="{{ $layanan->umur }}" name="umur" class="form-control">
                        </div>
                        <input name="alamat" type="hidden" class="form-control" value="{{ $layanan->alamat_pasien }}">
                        <input type="hidden" name="ibu" value="{{ $layanan->ibu }}" class="form-control">
                        <input type="hidden" name="jenis_pasien" value="{{ $layanan->carabayar }}" class="form-control">
                        <div class="form-group">
                            <label for="">Ruangan</label>
                            <select id="ruangan_lab" name="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($ruangan as $ru)
                                <option value="{{ $ru->slug }}" @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                    {{ $ru->nama }}
                                </option>
                                @endforeach
                                <option value="pendaftaran" @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                                </option>
                                <option value="laboratory" @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                                </option>
                                <option value="radiology" @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                                    Radiology
                                </option>
                                <option value="elektromedis" @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                                </option>
                                <option value="medical_checkup" @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">BED</label>
                            <input type="text" readonly value="{{ $layanan->last_bed != "" ? $layanan->last_bed : "" }}" name="last_bed"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" readonly value="{{ date('Y-m-d') }}" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select id="kelas" name="kelas" readonly style="pointer-events: none;" onclick="return false;" onkeydown="return false;" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($list_kelas as $kls)
                                <option value="{{ $kls->slug }}" @if ($kelas_lab) @if ($kls->slug == $kelas_lab->value)
                                    {{ 'selected' }} @endif
                                    @endif>{{ $kls->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Reguler / Cito</label>
                            <select id="cito" name="cito" class="form-control">
                                <option value="0">Reguler</option>
                                <option value="1">Cito</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Dokter</label>
                            <input type="text" id="dokter_lab" name="dokter" readonly placeholder="Pilih dokter" value="{{ Auth::user()->realname }}" class="form-control">
                            <input type="hidden" value="{{ Auth::user()->id }}" id="id_dokter_lab" name="id_dokter">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa</label>
                            <input type="text" id="diagnosa_lab" name="diagnosa" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan Pemeriksaan</label>
                            <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan" style="width: 100%" class="form-control">
                                @foreach ($pemeriksaan as $pe)
                                <option value="{{ $pe->slug }}">{{ $pe->nama }}</option>
                                @endforeach
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

    <!-- Modal hasil lab -->
    <div class="modal fade" id="modal_hasil_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hasil Laboratorium</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="link_lampiran_lab" class="pb-2"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Jenis Pemeriksaan</th>
                                <th>Hasil</th>
                                <th>Nilai Rujukan</th>
                            </tr>
                        </thead>
                        <tbody id="list_hasil_lab">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- End modal hasil lab -->

    <!-- Modal hasil radiologi -->
    <div class="modal fade" id="modal_hasil_radiologi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hasil Radiologi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="link_lampiran_radiologi" class="pb-2"></div>
                    <table id="list_hasil_radiologi" style="border-collapse: collapse; width:100%;">

                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- End modal hasil radiologi -->

    <!-- Modal pesanan radiologi -->
    <div class="modal fade" id="modal_rad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Radiologi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_radiologi">
                    <input type="hidden" name="id_pesanan" id="id_rad">
                    <input type="hidden" name="id" id="id_cppt_rad">
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" name="_method" value="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" name="noreg" value="{{ $layanan->id }}" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pasien</label>
                            <input type="text" name="pasien" value="{{ $pasien->nama }}" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">NRM</label>
                            <input type="text" name="nrm" value="{{ $layanan->nrm }}" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <input type="hidden" name="kelamin" value="{{ $layanan->kelamin }}" readonly class="form-control">
                            <input type="text" readonly value="{{ $layanan->kelamin == 0 ? 'Laki-laki' : 'Perempuan' }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Umur</label>
                            <input type="text" name="umur" value="{{ $layanan->umur }}" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Ruangan</label>
                            <select id="ruangan_rad" name="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($ruangan as $ru)
                                <option value="{{ $ru->slug }}" @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                    {{ $ru->nama }}
                                </option>
                                @endforeach
                                <option value="pendaftaran" @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                                </option>
                                <option value="laboratory" @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                                </option>
                                <option value="radiology" @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                                    Radiology
                                </option>
                                <option value="elektromedis" @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                                </option>
                                <option value="medical_checkup" @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Dokter</label>
                            <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}">
                            <input type="text" name="dokter" value="{{ Auth::user()->realname }}" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan Pemeriksaan</label>
                            <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan_radiologi" style="width: 100%" class="form-control">
                                @foreach ($pemeriksaan_radiologi as $per)
                                <option value="{{ $per->id }}">{{ $per->nama }}</option>
                                @endforeach
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
    <!-- End modal pesanan radiologi -->

    <div class="modal fade" id="modal_yth" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Kepada Yth.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_yth">
                    <input type="hidden" id="jenis_yth">
                    <table id="tabel_kepada" class="table table-striped mt-2" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <form id="form_fp" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="jenis_ppa" value="fp">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="id" id="id_fp">
        <input type="hidden" id="id_ppa_fp" name="id_ppa">
        <input type="hidden" id="nama_ppa_fp" name="nama_ppa">
        <input type="hidden" id="subjective_fp" name="subjective">
        <input type="hidden" id="objective_fp" name="objective">
        <input type="hidden" id="asesmen_fp" name="asesmen">
        <input type="hidden" id="planning_fp" name="planning">
        <input type="hidden" id="instruksi_fp" name="instruksi">
    </form>

    <form id="form_apt" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="jenis_ppa" value="apt">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="id" id="id_apt">
        <input type="hidden" id="id_ppa_apt" name="id_ppa">
        <input type="hidden" id="nama_ppa_apt" name="nama_ppa">
        <input type="hidden" id="subjective_apt" name="subjective">
        <input type="hidden" id="objective_apt" name="objective">
        <input type="hidden" id="asesmen_apt" name="asesmen">
        <input type="hidden" id="planning_apt" name="planning">
        <input type="hidden" id="instruksi_apt" name="instruksi">
    </form>

    <form id="form_gizi" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="jenis_ppa" value="gizi">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="id" id="id_gizi">
        <input type="hidden" id="id_ppa_gizi" name="id_ppa">
        <input type="hidden" id="nama_ppa_gizi" name="nama_ppa">
        <input type="hidden" id="subjective_gizi" name="subjective">
        <input type="hidden" id="objective_gizi" name="objective">
        <input type="hidden" id="asesmen_gizi" name="asesmen">
        <input type="hidden" id="catatan_asesmen_gizi" name="catatan_asesmen">
        <input type="hidden" id="planning_gizi" name="planning">
        <input type="hidden" id="instruksi_gizi" name="instruksi">
    </form>

    <form id="form_ns" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="jenis_ppa" value="ns">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="id" id="id_ns">
        <input type="hidden" id="id_ppa_ns" name="id_ppa">
        <input type="hidden" id="nama_ppa_ns" name="nama_ppa">
        <input type="hidden" id="subjective_ns" name="subjective">
        <input type="hidden" id="keadaan_umum_ns" name="keadaan_umum">
        <input type="hidden" id="kesadaran_ns" name="kesadaran">
        <input type="hidden" id="bb_ns" name="berat_badan">
        <input type="hidden" id="tb_ns" name="tinggi_badan">
        <input type="hidden" id="imt_ns" name="imt">
        <input type="hidden" id="status_gizi_ns" name="status_gizi">
        <input type="hidden" id="tensi_ns" name="tensi">
        <input type="hidden" id="nadi_ns" name="nadi">
        <input type="hidden" id="suhu_ns" name="suhu">
        <input type="hidden" id="rr_ns" name="rr">
        <input type="hidden" id="spo_ns" name="spo">
        <input type="hidden" id="asesmen_ns" name="asesmen">
        <input type="hidden" id="planning_ns" name="planning">
        <input type="hidden" id="instruksi_ns" name="instruksi">
    </form>

    <form id="form_dr" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="jenis_ppa" value="dr">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="id" id="id_dr">
        <input type="hidden" id="id_ppa_dr" name="id_ppa">
        <input type="hidden" id="nama_ppa_dr" name="nama_ppa">
        <input type="hidden" id="subjective_dr" name="subjective">
        <input type="hidden" id="objective_dr" name="objective">
        <input type="hidden" id="instruksi_dr" name="instruksi">
        <input type="hidden" id="tindak_lanjut_dr" name="tindak_lanjut">
        <input type="hidden" id="catatan_dpjp_dr" name="catatan_dpjp">
        <input type="hidden" id="is_dpjp_dr" name="is_dpjp">
        <input type="hidden" id="file_penunjang_dr" name="file_penunjang">
    </form>

    <form id="form_dpjp_utama" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="jenis_ppa" value="dpjp_utama">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="id" id="id_dpjp_utama">
        <input type="hidden" id="id_ppa_dpjp_utama" name="id_ppa">
        <input type="hidden" id="nama_ppa_dpjp_utama" name="nama_ppa">
        <input type="hidden" id="subjective_dpjp_utama" name="subjective">
        <input type="hidden" id="objective_dpjp_utama" name="objective">
        <input type="hidden" id="instruksi_dpjp_utama" name="instruksi">
        <input type="hidden" id="tindak_lanjut_dpjp_utama" name="tindak_lanjut">
    </form>

    <form id="form_dpjp_pendamping" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="jenis_ppa" value="dpjp_pendamping">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="id" id="id_dpjp_pendamping">
        <input type="hidden" id="id_ppa_dpjp_pendamping" name="id_ppa">
        <input type="hidden" id="nama_ppa_dpjp_pendamping" name="nama_ppa">
        <input type="hidden" id="subjective_dpjp_pendamping" name="subjective">
        <input type="hidden" id="objective_dpjp_pendamping" name="objective">
        <input type="hidden" id="instruksi_dpjp_pendamping" name="instruksi">
        <input type="hidden" id="tindak_lanjut_dpjp_pendamping" name="tindak_lanjut">
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@include('erm.script_riwayat_laboratorium')
@include('erm.script_riwayat_radiologi')
<!-- Script Diagnosa -->
<script>
    function open_modal_diagnosa(id, id_cppt) {
        $('#id_diagnosa').val(id);
        $('#id_cppt').val(id_cppt);

        if (id == 0) {
            $('#modal_diagnosa').modal('show');
            return;
        }

        $.ajax({
            url: "{{ url('ajax_request/diagnosa_by_id') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }

                $('#diagnosa_primer').val(response.nama_icd);
                $('#diagnosa_sekunder_satu').val(response.diagnosa_sekunder1);
                $('#diagnosa_sekunder_dua').val(response.diagnosa_sekunder2);
                $('#diagnosa_sekunder_tiga').val(response.diagnosa_sekunder3);
                $('#diagnosa_sekunder_empat').val(response.diagnosa_sekunder4);
                $('#diagnosa_sekunder_lima').val(response.diagnosa_sekunder5);
                $('#modal_diagnosa').modal('show');
            }
        })
    }

    $('#form_diagnosa').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang menyimpan data harap tunggu...');
        $.ajax({
            url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/diagnosa_store') }}",
            data: $('#form_diagnosa').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                $('#modal_diagnosa').modal('hide');
                for (let i = 0; i < data.length; i++) {
                    if (data[i].id == response.data.id) {
                        data[i] = response.data;
                        break;
                    }
                }
                $('#box_diagnosa_'+response.data.id).html(render_diagnosa(response.data));
                // render_dokumen();
            }
        })
    })

    $("#diagnosa_primer").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_primer").val(suggestion.nama);
        }
    });

    $("#diagnosa_pembanding").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_pembanding").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_satu").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_satu").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_dua").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_dua").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_tiga").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_tiga").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_empat").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_empat").val(suggestion.nama);
        }
    });

    $("#diagnosa_sekunder_lima").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        onSelect: function(suggestion) {
            $("#diagnosa_sekunder_lima").val(suggestion.nama);
        }
    });
</script>
<!-- End Script Diagnosa -->

<!-- Script Laboratorium -->
<script>
    function open_modal_lab(id, id_cppt) {
        $('#id_lab').val(id);
        $('#id_cppt_lab').val(id_cppt);

        let select = null;

        for (let i = 0; i < data.length; i++) {
            if (data[i].id == id_cppt) {
                select = data[i];
                break;
            }
        }

        console.log(data);

        $('#diagnosa_lab').val(select.diagnosa ? select.diagnosa.nama_icd : '');

        if (id == 0) {
            $('#modal_lab').modal('show');
            return;
        }

        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                let temp = [];
                if (Object.keys(response).length !== 0) {
                    if (response.status != 'Pesanan ERM') {
                        toastr.error('Tidak diperkenankan ubah pesanan laboratorium');
                        return;
                    }
                }
                if (Object.keys(response).length !== 0) {
                    const periksa = JSON.parse(response.periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push(`${key}`);
                        }
                    });
                    $('#pesan_pemeriksaan').val(temp).change();
                    $('#ruangan_lab').val(response.ruangan);
                    $('#kelas').val(response.kelas);
                    $('#cito').val(response.cito);
                }
                $('#id_lab').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#modal_lab').modal('show');
            }
        })
    }

    $('#pesan_pemeriksaan').select2();

    $('#form_laboratorium').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang menyimpan data, harap tunggu...');
        $('[name=keluhan_klinis]').val($('#subjective_dr').val());
        $.ajax({
            url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/lab_store') }}",
            method: 'post',
            data: $('#form_laboratorium').serialize(),
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                $('#modal_lab').modal('hide');
                toastr.success(response.message);
                for (let i = 0; i < data.length; i++) {
                    if (data[i].id == response.data.id) {
                        data[i] = response.data;
                        break;
                    }
                }
                $('#box_laboratorium_'+response.data.id).html(render_pesanan_lab(response.data));
                // render_dokumen();
            }
        })
    });

    function hapus_pesanan_lab(param, id) {
        if (confirm('Yakin melanjutkan hapus pesanan laboratorium ?')) {
            window.event.preventDefault();
            toastr.warning('Sedang menghapus data, harap tunggu...');
            $.ajax({
                url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/lab_delete') }}",
                data: {
                    id: param,
                    id_cppt: id,
                    dokumen: '{{ $dokumen->id }}'
                },
                success: function(response) {
                    if (!response.status) {
                        toastr.error(response.message);
                        return;
                    }
                    $('#box_laboratorium_'+id).empty();
                    $('#box_laboratorium_'+id).html('<button type="button" class="btn btn-dark" onclick="open_modal_lab(`'+param+'`, `'+id+'`)"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_lab').val(0);
                    toastr.success(response.message);
                    // data = response.data;
                    // render_dokumen();
                }
            })
        }
    }

    function open_modal_hasil_lab(param) {
        let cek = false
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                let temp = JSON.parse(response.hasil);
                let hasil = Object.entries(temp);
                let key_hasil = Object.keys(hasil);
                for (let i = 0; i < hasil.length; $i++) {
                    if (hasil[key_hasil[i]] != '') {
                        cek = true;
                        break;
                    }
                }
                var ins = '';
                if (cek) {
                    let temp_grup = '';
                    let master_hasil = <?php echo $master_hasil; ?>;
                    for (let i = 0; i < master_hasil.length; i++) {
                        if (temp[master_hasil[i].slug] != '') {
                            if (temp_grup != master_hasil[i].grup) {
                                ins += '<tr>' +
                                    '<th colspan="3">' + master_hasil[i].grup + '</th>' +
                                    '</tr>';
                                temp_grup = master_hasil[i].grup;
                            }
                            if (temp[master_hasil[i].slug] != undefined && temp[master_hasil[i].slug] != '') {
                                ins += '<tr>' +
                                    '<td style="padding-left: 40px">' + master_hasil[i].name + '</td>' +
                                    '<td class="text-center" style="' + cek_nilai_normal(temp[master_hasil[i].slug], master_hasil[i]) + '">' + temp[master_hasil[i].slug] +
                                    '</td>' +
                                    '<td class="text-center">' + master_hasil[i].nt + '</td>' +
                                    '</tr>';
                            }
                        }
                    }
                } else {
                    ins = '<tr>' +
                        '<th colspan="3" class="text-center">Tidak ada hasil</th>' +
                        '</tr>';
                }
                let file = response.file != '' ? JSON.parse(response.file) : [''];
                if (file[0] != '') {
                    $('#link_lampiran_lab').html(`<a style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL ') }}/' + file[0] + '" target="_blank">Download lampiran klik disini</a>`);
                }
                $('#list_hasil_lab').html(ins);
                $('#modal_hasil_lab').modal('show');
            }
        })
    }

    function cek_nilai_normal(nilai, master) {
        let kelamin = '{{ $layanan->kelamin }}';
        switch (master.nn) {
            case 'less-than':
                if (nilai < master.lessthan) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'more-than':
                if (nilai > master.morethan) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'between':
                if (nilai >= master.valmin && nilai <= master.valmax) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'diantara_sampai':
                if (nilai >= master.valmin && nilai <= master.valmax) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'same':
                if (nilai == master.sameval) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'reaktif_nonreaktif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif_2':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'normal':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'negatif_positif':
                if (nilai == master.nt) {
                    return '';
                }
                return 'font-weight:bold; color:red';
                break;
            case 'laper':
                if (kelamin == '0') {
                    if (nilai >= master.lmin && nilai <= master.lmax) {
                        return '';
                    }
                    return 'font-weight:bold; color:red';
                } else if (kelamin == '1') {
                    if (nilai >= master.pmin && nilai <= master.pmax) {
                        return '';
                    }
                    return 'font-weight:bold; color:red';
                }
                return '';
                break;

            default:
                return '';
                break;
        }
    }
</script>
<!-- End Script Laboratorium -->

<!-- Script Radiologi -->
<script>
    function open_modal_rad(id, id_cppt) {
        $('#id_rad').val(id);
        $('#id_cppt_rad').val(id_cppt);

        if (id == 0) {
            $('#modal_rad').modal('show');
            return;
        }

        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: id,
            },
            success: function(response) {
                if (Object.keys(response).length !== 0) {
                    if (response.status != 'Pesanan ERM') {
                        alert('Tidak diperkenankan ubah pesanan radiologi');
                        return;
                    }
                }

                let temp = [];
                if (Object.keys(response).length !== 0) {
                    const periksa = JSON.parse(response.periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push((`${key}`).replace('rad_', ''));
                        }
                    });
                    $('#pesan_pemeriksaan_radiologi').val(temp).change();
                    $('#ruangan_rad').val(response.ruangan);
                }
                $('#id_rad').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#modal_rad').modal('show');
            }
        })
    }

    $('#form_radiologi').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang menyimpan data, harap tunggu...');
        $.ajax({
            url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/rad_store') }}",
            method: 'post',
            data: $('#form_radiologi').serialize(),
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                $('#modal_rad').modal('hide');
                toastr.success(response.message);
                for (let i = 0; i < data.length; i++) {
                    if (data[i].id == response.data.id) {
                        data[i] = response.data;
                        break;
                    }
                }
                $('#box_radiologi_'+response.data.id).html(render_pesanan_rad(response.data));
                // render_dokumen();
            }
        })
    });

    $('#pesan_pemeriksaan_radiologi').select2();

    function hapus_pesanan_rad(param, id) {
        window.event.preventDefault();
        if (confirm('Yakin melanjutkan hapus pesanan radiologi ?')) {
            toastr.warning('Sedang menghapus data, harap tunggu...');
            $.ajax({
                url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/rad_delete') }}",
                data: {
                    id: param,
                    id_cppt: id,
                    dokumen: '{{ $dokumen->id }}'
                },
                success: function(response) {
                    if (!response.status) {
                        toastr.error(response.message);
                        return;
                    }
                    $('#box_radiologi_'+id).empty();
                    $('#box_radiologi_'+id).html('<button type="button" class="btn btn-dark" onclick="open_modal_rad(`'+param+'`, `'+id+'`)"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_rad').val(0);
                    toastr.success(response.message);
                    // data = response.data;
                    // render_dokumen();
                }
            })
        }
    }
    
    function sortObject(obj) {
        if(typeof obj !== 'object')
            return obj
        var temp = {};
        var keys = [];
        for(var key in obj)
            keys.push(key.replace('rad_',''));
        keys.sort(function(a,b){return a - b});
        for(var index in keys)
            temp['rad_'+keys[index]] = sortObject(obj['rad_'+keys[index]]);       
        return temp;
    }

    function open_modal_hasil_rad(param) {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                if (response.hasil == '') {
                    toastr.error('Belum ada hasil radiologi yang diinput');
                    return;
                }
                var ins = '';
                let temp = JSON.parse(response.hasil);
                let temp2 = sortObject(JSON.parse(response.periksa));
                let hasil = Object.entries(temp);
                let key_hasil = Object.keys(temp);
                let periksa = Object.entries(temp2);
                let key_periksa = Object.keys(temp2);
                let pemeriksaan = <?php echo $pemeriksaan_radiologi ?>;
                let no = 1;
                for (let i = 0; i < hasil.length; i++) {
                    let temp_slug = key_hasil[i];
                    if (temp[key_hasil[i]] != '') {
                        for (let j = 0; j < periksa.length; j++) {
                            if (temp_slug == key_periksa[j] && periksa[j][1] == 1) {
                                ins += '<tr>' +
                                    '<td style="vertical-align:top; line-height:2;">' + no + '. </td>' +
                                    '<td style="vertical-align:top; line-height:2;" class="pl-2">' +
                                    pemeriksaan[j].nama + '</td>' +
                                    '<td style="vertical-align:top; line-height:2;" class="pl-4 pr-4"> : </td>' +
                                    '<td style="vertical-align:top; line-height:2;">' + (hasil[i][1] ? hasil[i][1].includes('img') ? hasil[i][1].replace('\n', '<br>').replace('smis-upload', "{{ request()->getScheme().'://' .request()->getHost() . env('SMIS_URL').'/smis-upload' }}") : hasil[i][1].replace('\n', '<br>') : '') + '</td>' +
                                    '</tr>';
                                no++;
                                break;
                            }
                        }
                    }
                }
                let file = response.file != '' ? JSON.parse(response.file) : [''];
                if (file[0] != '') {
                    $('#link_lampiran_radiologi').html(`<a style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL ') }}/' + file[0] + '" target="_blank">Download lampiran klik disini</a>`);
                }
                $('#list_hasil_radiologi').html(ins);
                $('#modal_hasil_radiologi').modal('show');
            }
        })
    }
</script>
<!-- End Script Radiologi -->

<!-- Script Resep -->
<script>
    let detail_e_resep = [];

    function empty_detail_e_resep() {
        if (detail_e_resep.length > 0)
            detail_e_resep.splice(0, detail_e_resep.length);
    }

    function preview_riwayat_eresep(id, action) {
        $.ajax({
            type     : 'GET',
            url      : '<?php echo url("ajax_request/preview_riwayat_eresep"); ?>',
            data     : {
                'id' : id
            },
            success  : function(response) {
                let html = "";
                if (response.data != null) {
                    for (let i = 0; i < response.data.length; i++) {
                        html += "<tr>" +
                                    "<td>" + (i + 1) + "</td>" +
                                    "<td>" + response.data[i].nama_obat + "</td>" +
                                    "<td>" + response.data[i].signa + "</td>" +
                                    "<td>" + response.data[i].jumlah + " " + response.data[i].satuan + "</td>" +
                                "</tr>";
                    };
                }
                $('#tabel_list_detail_riwayat_eresep tbody').html(html);
                reset_detail_riwayat_eresep();
                $('#button_preview_' + id).hide();
                $('#button_action_' + id).show();
            }
        });
    }

    function select_riwayat_eresep(id, action) {
        $.ajax({
            type     : 'GET',
            url      : '<?php echo url("ajax_request/select_riwayat_eresep"); ?>',
            data     : {
                'id' : id
            },
            success  : function(response) {
                console.log(response);
                
                empty_detail_e_resep();
                if (response.data.length > 0) {
                    for (let i = 0; i < response.data.length; i++) {
                        detail_e_resep.push({
                            id: '',
                            id_obat: response.data[i].id_obat,
                            kode_obat: response.data[i].kode_obat,
                            nama_obat: response.data[i].nama_obat,
                            nama_jenis_obat: response.data[i].nama_jenis_obat,
                            jumlah: parseFloat(response.data[i].jumlah),
                            satuan: response.data[i].satuan,
                            aturan_pakai: response.data[i].aturan_pakai ? response.data[i].aturan_pakai : '',
                            obat_luar_check: response.data[i].obat_luar_check ? response.data[i].obat_luar_check : 0,
                            malam_check: response.data[i].malam_check ? response.data[i].malam_check : 0,
                            malam: response.data[i].malam ? response.data[i].malam : '',
                            sore_check: response.data[i].sore_check ? response.data[i].sore_check : 0,
                            sore: response.data[i].sore ? response.data[i].sore : '',
                            siang_check: response.data[i].siang_check ? response.data[i].siang_check : 0,
                            siang: response.data[i].siang ? response.data[i].siang : '',
                            pagi_check: response.data[i].pagi_check ? response.data[i].pagi_check : 0,
                            pagi: response.data[i].pagi ? response.data[i].pagi : '',
                            pemakaian: response.data[i].pemakaian,
                            keterangan_tambahan: response.data[i].keterangan_tambahan ? response.data[i].keterangan_tambahan : '',
                            satuan_pakai: response.data[i].satuan_pakai,
                            takaran_pakai: response.data[i].takaran_pakai,
                            jumlah_pakai_sehari: response.data[i].jumlah_pakai_sehari,
                            aturan_pakai_mode: response.data[i].aturan_pakai_mode ? response.data[i].aturan_pakai_mode : '',
                            harga: parseFloat(response.data[i].harga).toFixed(2),
                            markup: response.data[i].markup,
                            signa: response.data[i].signa,
                            deleted: false
                        });
                    }
                }
                render_detail_resep();
                
                reset_detail_riwayat_eresep();
                $('#modal_list_riwayat_eresep').modal('hide');
                if (action == "add") {
                    $('#modal_resep').modal('show');
                } else if (action == "edit") {
                    $('#modal_edit_resep').modal('show');
                }
            }
        });
    }

    function reset_detail_riwayat_eresep() {
        const n_row = $('#tabel_list_riwayat_eresep tbody tr').length;
        for (let i = 0; i < n_row; i++) {
            const id = $('#tabel_list_riwayat_eresep tbody tr:eq(' + i + ') td:eq(0)').text();
            $('#button_preview_' + id).show();
            $('#button_action_' + id).hide();
        }
    }

    function browse_riwayat_eresep(action) {
        let prefix = "e_resep";
        if (action == "edit") {
            prefix = "edit_resep";
        }

        const nrm_pasien = $("#" + prefix + "_nrm").val();
        const id_dokter = $("#" + prefix + "_id_dokter").val();

        if (nrm_pasien == "" || nrm_pasien == null || id_dokter == "" || id_dokter == null) {
            return;
        }

        $.ajax({
            type     : 'GET',
            url      : '<?php echo url("ajax_request/list_riwayat_eresep"); ?>',
            data     : {
                'nrm_pasien'    : nrm_pasien,
                'id_dokter'     : id_dokter
            },
            success  : function(response) {
                let html = "";
                if (response.data != null) {
                    for (let i = 0; i < response.data.length; i++) {
                        html += "<tr>" +
                                    "<td>" + response.data[i].id + "</td>" +
                                    "<td>" + response.data[i].tanggal + "</td>" +
                                    "<td>" + response.data[i].nama_dokter + "</td>" +
                                    "<td>" + response.data[i].ruangan + "</td>" +
                                    "<td>" + 
                                        '<div class="text-center">' +
                                            '<button id="button_preview_' + response.data[i].id + '" class="btn btn-dark" onclick="preview_riwayat_eresep(' + "'" + response.data[i].id + "','" + action + "'" + ')">' +
                                                '<i class="fa fa-arrow-right"></i>' + 
                                            '</button>' +
                                            '<div id="button_action_' + response.data[i].id + '" class="btn-group" role="group" style="display: none;">' +
                                                '<button class="btn btn-danger" onclick="clear_detail_riwayat_eresep(' + "'" + response.data[i].id + "'" + ')">' +
                                                    '<i class="fa fa-times"></i>' + 
                                                '</button>' +
                                                '<button class="btn btn-success" onclick="select_riwayat_eresep(' + "'" + response.data[i].id + "','" + action + "'" + ')">' +
                                                    '<i class="fa fa-check"></i>' + 
                                                '</button>' +
                                            '</div>' +
                                        '</div>' +
                                    "</td>" +
                                "</tr>";
                    };
                }
                $('#tabel_list_riwayat_eresep tbody').html(html);
                if (action == "add") {
                    $('#modal_resep').modal('hide');
                } else if (action == "edit") {
                    $('#modal_edit_resep').modal('hide');
                }
                $('#close_browse_riwayat_eresep_button').removeAttr('tag');
                $('#close_browse_riwayat_eresep_button').attr('tag', action);
                reset_detail_riwayat_eresep(); 
                $('#modal_list_riwayat_eresep').modal('show');
            }
        });
    }

    $("#e_resep_nama_obat").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        params: {
            'depo': function() {
                return $('#e_resep_depo_tujuan').val();
            }
        },
        onSelect: function(suggestion) {
            $('#additional_form_e_resep').html('');
            $("#e_resep_nama_obat").val(suggestion.nama);
            $('#e_resep_kode_obat').val(suggestion.kode_obat);
            $("#e_resep_id_obat").val(suggestion.id);
            $("#e_resep_jenis_obat").val(suggestion.jenis_obat);
            $("#e_resep_satuan_obat").val(suggestion.satuan_obat);
            $("#e_resep_sisa_obat").val(suggestion.sisa);

            get_harga_obat(suggestion.id, 'tambah');
        }
    })

    function open_modal_resep(id, id_cppt) {
        $('#id_resep').val(id);
        $('#id_cppt_resep').val(id_cppt);

        if (id == 0) {
            $('#modal_resep').modal('show');
        }

        $.ajax({
            url: "{{ url('ajax_request/select_resep') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }

                console.log("{{Session::get('sip')}}");

                $('#e_resep_obat_racikan').val(response.catatan_obat_racikan);
                $('#e_resep_catatan').val(response.catatan);
                $('#e_resep_dokter').val(Object.keys(response).length > 0 ? response.nama_dokter : '{{ Auth::user()->realname }}');
                $('#e_resep_id_dokter').val(Object.keys(response).length > 0 ? response.id_dokter : '{{ Auth::user()->id }}');
                $('#e_resep_sip').val(Object.keys(response).length > 0 ? response.sip_dokter : '{{ Session::get("sip") }}');

                detail_e_resep = [];

                if(Object.keys(response).length > 0){
                    for (let i = 0; i < response.detail.length; i++) {
                        detail_e_resep[i] = response.detail[i];
                        detail_e_resep[i].deleted = false;
                    }
                }

                render_detail_resep();

                $('#modal_resep').modal('show');
            }
        })
    }

    function open_modal_list_obat() {
        if ($('#e_resep_depo_tujuan').val() == '') {
            alert('Pilih depo tujuan dahulu');
            return;
        }
        $('#modal_resep').modal('hide');
        get_list_obat();
        $('#modal_list_obat').modal('show');
    }

    function get_list_obat() {
        $('#msg_list_obat').html('');
        if ($.fn.DataTable.isDataTable("#tabel_list_obat")) {
            $('#tabel_list_obat').DataTable().clear().destroy();
        }
        $('#tabel_list_obat').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: "../../ajax_request/list_obat?depo=" + $('#e_resep_depo_tujuan').val() + '&kriteria=' + $('#search_obat').val(),
            columns: [{
                    data: 'nama_obat',
                    name: 'nama_obat'
                },
                {
                    data: 'nama_jenis_obat',
                    name: 'nama_jenis_obat'
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    render: function(data, type, row) {
                        return '';
                    }
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    render: function(data, type, row) {
                        return '';
                    }
                },
                {
                    data: 'sisa',
                    name: 'sisa',
                    render: function(data, type, row) {
                        return data + ' ' + capitalizeFirstLetter(row.satuan);
                    }
                },
                {
                    data: 'id_obat',
                    name: 'id_obat',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<div class="text-center">' +
                            '<button onclick="get_detail_obat(' + "'" + data + "','" + row.kode_obat +
                            "','" + row.nama_obat + "','" + row.satuan + "','" + row.nama_jenis_obat +
                            "','" + row.sisa + "'" +
                            ')" class="btn btn-dark"><i class="fa fa-check"></i></button>' +
                            '</div>';
                    }
                },
            ]
        });
    }

    $('#form_search_obat').submit(function(e) {
        e.preventDefault();
        get_list_obat();
    })

    function get_detail_obat(param, kode, nama, satuan, jenis, sisa) {
        $('#msg_list_obat').html(loading('Sedang mengambil harga obat, harap tunggu...', 'info'));
        $('#e_resep_id_obat').val(param);
        $('#e_resep_kode_obat').val(kode);
        $('#e_resep_nama_obat').val(nama);
        $('#e_resep_satuan_obat').val(satuan);
        $('#e_resep_jenis_obat').val(jenis);
        $('#e_resep_sisa_obat').val(sisa);
        get_harga_obat(param);
    }

    function get_harga_obat(param) {
        $.ajax({
            url: "{{ url('ajax_request/harga_obat') }}",
            data: {
                noreg: "{{ $layanan->id }}",
                id_obat: param,
                depo: $('#e_resep_depo_tujuan').val()
            },
            success: function(response) {
                if (response == null) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">Harga obat tidak ditemukan</div>');
                    return;
                } else if (response.code == 500) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">' + response.message + '</div>');
                    return;
                }
                $('#e_resep_harga_obat').val(rupiah(response.toFixed(2)));
                $('#modal_list_obat').modal('hide');
                $('#modal_resep').modal('show');
            }
        })
    }

    function simpan_detail_e_resep() {
        if (
            $('#e_resep_sisa_obat').val() == '' ||
            $('#e_resep_satuan_obat').val() == '' ||
            $('#e_resep_harga_obat').val() == ''
        ) {
            alert('Obat tidak valid');
            return;
        }

        if ($('#e_resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }
        if ($('#e_resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }

        let obj_ins = {
            id: $('#e_resep_index_edit').val() != '' ? detail_e_resep[$('#e_resep_index_edit').val()].id : '',
            id_obat: parseInt($('#e_resep_id_obat').val()),
            kode_obat: $('#e_resep_kode_obat').val(),
            nama_obat: $('#e_resep_nama_obat').val(),
            nama_jenis_obat: $('#e_resep_jenis_obat').val(),
            jumlah: parseFloat($('#e_resep_jumlah_obat').val()),
            satuan: $('#e_resep_satuan_obat').val(),
            aturan_pakai: $('#e_resep_aturan_pakai').val() != undefined ? $('#e_resep_aturan_pakai').val() : '',
            obat_luar_check: $('#e_resep_obat_luar_aktif').val() != undefined ? $('#e_resep_obat_luar_aktif').val() : '',
            malam_check: $('#e_resep_malam').is(':checked') ? 1 : 0,
            malam: "",
            sore_check: $('#e_resep_sore').is(':checked') ? 1 : 0,
            sore: "",
            siang_check: $('#e_resep_siang').is(':checked') ? 1 : 0,
            siang: "",
            pagi_check: $('#e_resep_pagi').is(':checked') ? 1 : 0,
            pagi: "",
            pemakaian: $('#e_resep_pemakaian').val() != undefined ? $('#e_resep_pemakaian').val() : '',
            keterangan_tambahan: "",
            satuan_pakai: $('#e_resep_satuan_obat').val(),
            takaran_pakai: $('#e_resep_satuan_pakai').val() != undefined ? $('#e_resep_satuan_pakai').val() : '',
            jumlah_pakai_sehari: $('#e_resep_jumlah_pakai').val() != undefined ? $('#e_resep_jumlah_pakai').val() : '',
            aturan_pakai_mode: $('#e_resep_aturan_pakai_mode').val() != undefined ? $('#e_resep_aturan_pakai_mode').val() : '',
            harga: parseFloat($('#e_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(
                ',', '.')),
            markup: $('#e_resep_markup').val() != undefined ? parseInt($('#e_resep_markup').val()) : '',
            signa: $('#e_resep_signa').val(),
            deleted: false
        };

        if ($('#e_resep_index_edit').val() != '') {
            detail_e_resep[$('#e_resep_index_edit').val()] = obj_ins;
        }else{
            detail_e_resep.push(obj_ins);
        }

        console.log(detail_e_resep);

        $('#e_resep_index_edit').val('');
        $('#e_resep_id_obat').val('');
        $('#e_resep_kode_obat').val('');
        $('#e_resep_nama_obat').val('');
        $('#e_resep_jenis_obat').val('');
        $('#e_resep_sisa_obat').val('');
        $('#e_resep_satuan_obat').val('');
        $('#e_resep_jumlah_obat').val('');
        $('#e_resep_harga_obat').val('');
        $('#e_resep_signa').val('');
        $('#e_resep_signa').val('');

        render_detail_resep();
    }

    function render_detail_resep() {
        var ins = '';
        var footer = '';
        let jml = 0;
        for (let i = 0; i < detail_e_resep.length; i++) {
            if (!detail_e_resep[i].deleted) {
                ins += '<tr>' +
                    '<td class="text-center">' + (i + 1) + '</td>' +
                    '<td>' + detail_e_resep[i].nama_obat + '</td>' +
                    '<td class="text-center">' + detail_e_resep[i].nama_jenis_obat + '</td>' +
                    '<td class="text-center">' + detail_e_resep[i].jumlah + '</td>' +
                    '<td class="text-center">' + detail_e_resep[i].satuan + '</td>' +
                    '<td>Rp. ' + rupiah(detail_e_resep[i].harga) + '</td>' +
                    '<td>Rp. ' + rupiah((detail_e_resep[i].harga * detail_e_resep[i].jumlah).toFixed(2)) +
                    '</td>' +
                    '<td class="text-center">' + detail_e_resep[i].signa + '</td>' +
                    '<td class="text-center" style="display:inline-flex;">' +
                    '<button onclick="edit_detail_e_resep(' + i + ')" class="btn btn-warning mr-1" style="color:#fff" type="button"><i class="fa fa-pencil"></i></button>' +
                    '<button onclick="hapus_detail_e_resep(' + i + ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>' +
                    '</td>' +
                    '</tr>';
                jml += parseFloat((detail_e_resep[i].harga * detail_e_resep[i].jumlah).toFixed(2));
            }
        }
        if (detail_e_resep.length > 0) {
            footer = '<tr>' +
                '<td colspan="6" style="text-align:right; font-weight:bold;">Total : </td>' +
                '<td style="font-weight:bold;">Rp. ' + rupiah(jml.toFixed(2)) + '</td>' +
                '<td colspan="2"></td>' +
                '</tr>';
        }
        $('#list_detail_e_resep').html(ins);
        $('#footer_list_detail_e_resep').html(footer);
    }

    function edit_detail_e_resep(index) {
        $('#e_resep_index_edit').val(index);
        $('#e_resep_id_obat').val(detail_e_resep[index].id_obat);
        $('#e_resep_kode_obat').val(detail_e_resep[index].kode_obat);
        $('#e_resep_nama_obat').val(detail_e_resep[index].nama_obat);
        $('#e_resep_jenis_obat').val(detail_e_resep[index].nama_jenis_obat);
        $('#e_resep_satuan_obat').val(detail_e_resep[index].satuan);
        $('#e_resep_jumlah_obat').val(detail_e_resep[index].jumlah);
        $('#e_resep_harga_obat').val(detail_e_resep[index].harga);
        $('#e_resep_signa').val(detail_e_resep[index].signa);

        select_obat(detail_e_resep[index].id_obat);
    }

    function select_obat(id) {
        let prefix = 'e';

        $.ajax({
            url: "{{ url('ajax_request/select_obat') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                $('#e_resep_sisa_obat').val(response.sisa);
            }
        })
    }

    function hapus_detail_e_resep(index) {
        detail_e_resep[index].deleted = true;
        render_detail_resep();
    }

    $('#form_e_resep').submit(function(e) {
        e.preventDefault();
        $('#detail_resep').val(JSON.stringify(detail_e_resep));
        toastr.warning('Sedang menyimpan resep, harap tunggu...');
        $.ajax({
            url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/resep_store') }}",
            method: 'post',
            data: $('#form_e_resep').serialize(),
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return
                }
                $('#modal_resep').modal('hide');
                toastr.success(response.message);
                for (let i = 0; i < data.length; i++) {
                    if (data[i].id == response.data.id) {
                        data[i] = response.data;
                        break;
                    }
                }
                $('#box_resep_'+response.data.id).html(render_resep(response.data));
                // render_dokumen();
            }
        })
    })

    function preview_resep(param) {
        $.ajax({
            url : "{{ url('ajax_request/select_resep') }}",
            data : {
                id : param
            },
            success:function(response){
                if (response == null) {
                    return;
                }
                console.log(response);
                $('#preview_tanggal').html(dmyhi_to_dmy(response.tanggal));
                $('#preview_dokter').html(response.nama_dokter);
                $('#preview_sip_dokter').html(response.sip_dokter);
                $('#preview_catatan_obat_racikan').html(response.catatan_obat_racikan);
                $('#preview_list_obat').html(render_obat_resep(response.detail));
                $('#modal_preview').modal('show');
            }
        })
    }

    function lock_resep(param, id_formulir) {
        if (confirm('Apakah anda yakin melanjutkan lock e-resep ? resep yang dilock tidak dapat diubah lagi')) {
            $.ajax({
                url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/resep_lock') }}",
                method: 'post',
                data: {
                    id: param,
                    id_formulir : id_formulir,
                    dokumen : '{{ $dokumen->id }}',
                    _token : '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (!response.status) {
                        toastr.error(response.message);
                    }
                    toastr.success(response.message);
                    $('#box_resep_'+id_formulir).html(render_resep(response.data));
                }
            })
        }
    }

    function open_modal_dokter_e_resep() {
        if ($.fn.DataTable.isDataTable('#tabel_dokter_e_resep')) {
            $('#tabel_dokter_e_resep').dataTable().fnClearTable();
            $('#tabel_dokter_e_resep').dataTable().fnDestroy();
        }
        $('#tabel_dokter_e_resep').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('ajax_request/datatable_dokter') }}",
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'no_ijin',
                    name: 'no_ijin'
                },
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_dokter_e_resep(' +
                            "'" + row.nama + "','" + data + "','" + row.no_ijin + "'" +
                            ')"><i class="fa fa-check"></i></button></div>';
                    }
                },
            ]
        });
        $('#modal_resep').modal('hide');
        $('#modal_dokter_e_resep').modal('show');
    }

    function set_dokter_e_resep(nama, id, sip) {
        $('#e_resep_dokter').val(nama);
        $('#e_resep_id_dokter').val(id);
        $('#e_resep_sip').val(sip);
        $('#modal_dokter_e_resep').modal('hide');
        $('#modal_resep').modal('show');
    }
</script>
<!-- End Script Resep -->

<script>
    let data = <?php echo $data ?>;

    $(document).ready(function() {
        render_dokumen();
    })

    function batal_form(id){
        if (!confirm('Anda yakin ingin membatalkan form ini ?')) {
            return;
        }
        toastr.warning('Sedang menyimpan data harap tunggu...');
        $.ajax({
            url : "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/batal_form') }}",
            data : {
                id : id,
                dokumen : '{{ $dokumen->id }}'
            },
            success:function(response){
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                data = response.data;
                render_dokumen();
            }
        })
    }

    function dmyhi_to_dmy(deta){
        if (deta == null || deta == '') {
            return '';
        }
        let temp = deta.split(' ');
        let tgl = temp[0].split('-');
        return tgl[2]+'-'+tgl[1]+'-'+tgl[0];
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }

    function rupiah(param) {
        if (param == '' || param == null) {
            return '';
        }
        var temp = param.toString().replaceAll('.', ',');
        return temp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function render_dokumen() {
        if (data.length > 0) {
            var ins = '';
            for (let i = 0; i < data.length; i++) {
                switch (data[i].jenis_ppa) {
                    case 'ns':
                        ins += render_ns(data[i]);
                        break;
                    case 'fp':
                        ins += render_fp(data[i]);
                        break;
                    case 'apt':
                        ins += render_apt(data[i]);
                        break;
                    case 'gizi':
                        ins += render_gizi(data[i]);
                        break;
                    case 'dr':
                        ins += render_dr(data[i]);
                        break;
                    case 'dpjp_utama':
                        ins += render_dpjp_utama(data[i]);
                        break;
                    case 'dpjp_pendamping':
                        ins += render_dpjp_pendamping(data[i]);
                        break;
                    default:
                        break;
                }
            }
            $('#body_dokumen').html(ins);
        }
    }

    function simpan(id, jenis, is_dpjp=null) {

        if (jenis == 'fp' || jenis == 'apt') {
            $('#id_' + jenis).val(id);
            $('#id_ppa_' + jenis).val($('#id_ppa_' + jenis + '_' + id).val());
            $('#nama_ppa_' + jenis).val($('#nama_ppa_' + jenis + '_' + id).val());
            $('#subjective_' + jenis).val($('#subjective_' + jenis + '_' + id).val());
            $('#objective_' + jenis).val($('#objective_' + jenis + '_' + id).val());
            $('#asesmen_' + jenis).val($('#asesmen_' + jenis + '_' + id).val());
            $('#planning_' + jenis).val($('#planning_' + jenis + '_' + id).val());
            $('#instruksi_' + jenis).val($('#instruksi_' + jenis + '_' + id).val());
        } else if (jenis == 'ns') {
            $('#id_' + jenis).val(id);
            $('#id_ppa_' + jenis).val($('#id_ppa_' + jenis + '_' + id).val());
            $('#nama_ppa_' + jenis).val($('#nama_ppa_' + jenis + '_' + id).val());
            $('#subjective_' + jenis).val($('#subjective_' + jenis + '_' + id).val());
            $('#keadaan_umum_' + jenis).val($('#keadaan_umum_' + jenis + '_' + id).val());
            $('#kesadaran_' + jenis).val($('#kesadaran_' + jenis + '_' + id).val());
            $('#bb_' + jenis).val($('#bb_' + jenis + '_' + id).val());
            $('#tb_' + jenis).val($('#tb_' + jenis + '_' + id).val());
            $('#imt_' + jenis).val($('#imt_' + jenis + '_' + id).val());
            $('#status_gizi_' + jenis).val($('[name=status_gizi_' + jenis + '_' + id + ']:checked').val() != undefined ? $('[name=status_gizi_' + jenis + '_' + id + ']:checked').val() : '');
            $('#tensi_' + jenis).val($('#tensi_' + jenis + '_' + id).val());
            $('#nadi_' + jenis).val($('#nadi_' + jenis + '_' + id).val());
            $('#suhu_' + jenis).val($('#suhu_' + jenis + '_' + id).val());
            $('#rr_' + jenis).val($('#rr_' + jenis + '_' + id).val());
            $('#spo_' + jenis).val($('#spo2_' + jenis + '_' + id).val());
            $('#asesmen_' + jenis).val($('#asesmen_' + jenis + '_' + id).val());
            $('#planning_' + jenis).val($('#planning_' + jenis + '_' + id).val());
            $('#instruksi_' + jenis).val($('#instruksi_' + jenis + '_' + id).val());
        } else if (jenis == 'dr' || jenis == 'dpjp_utama' || jenis == 'dpjp_pendamping') {
            $('#id_' + jenis).val(id);
            $('#id_ppa_' + jenis).val($('#id_ppa_' + jenis + '_' + id).val());
            $('#nama_ppa_' + jenis).val($('#nama_ppa_' + jenis + '_' + id).val());
            $('#subjective_' + jenis).val($('#subjective_' + jenis + '_' + id).val());
            $('#objective_' + jenis).val($('#objective_' + jenis + '_' + id).val());
            $('#instruksi_' + jenis).val($('#instruksi_' + jenis + '_' + id).val());
            $('#tindak_lanjut_' + jenis).val($('#tindak_lanjut_' + jenis + '_' + id).val());
            $('#catatan_dpjp_' + jenis).val($('#catatan_dpjp_'+jenis+'_'+id).val());
            $('#file_penunjang_' + jenis).val($('#file_penunjang_'+jenis+'_'+id).val());
            $('#is_dpjp_'+jenis).val(is_dpjp);
        } else if (jenis == 'gizi') {
            $('#id_' + jenis).val(id);
            $('#id_ppa_' + jenis).val($('#id_ppa_' + jenis + '_' + id).val());
            $('#nama_ppa_' + jenis).val($('#nama_ppa_' + jenis + '_' + id).val());
            $('#subjective_' + jenis).val($('#subjective_' + jenis + '_' + id).val());
            $('#objective_' + jenis).val($('#objective_' + jenis + '_' + id).val());
            $('#asesmen_' + jenis).val($('#asesmen_' + jenis + '_' + id).val());
            $('#planning_' + jenis).val($('#planning_' + jenis + '_' + id).val());
            $('#catatan_asesmen_' + jenis).val($('#catatan_asesmen_' + jenis + '_' + id).val());
            $('#instruksi_' + jenis).val($('#instruksi_' + jenis + '_' + id).val());
        } 

        window.event.preventDefault();
        toastr.warning('Sedang menyimpan data harap tunggu...');
        
        let formData = new FormData($('#form_'+jenis)[0]);

        if (jenis == 'dr' || jenis == 'dpjp_utama' || jenis == 'dpjp_pendamping') {
            formData.append("file_penunjang", $('#file_penunjang_'+jenis+'_'+id)[0].files[0]);
        }

        $.ajax({
            url: "{{ url('e_rekam_medis/catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/store') }}",
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }

                toastr.success(response.message);
                data = response.data;
                render_dokumen();
            }
        })
    }

    function openModalTambahAsesmen() {
        $('#modal_tambah_asesmen').modal('show');
    }

    $('#form_tambah_asesmen').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang membuat form harap tunggu...');
        $.ajax({
            url: "../catatan_perkembangan_pasien_terintegrasi_rawat_inap/ajax_request/create",
            method: 'post',
            data: $('#form_tambah_asesmen').serialize(),
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }

                toastr.success(response.message);
                $('#modal_tambah_asesmen').modal('hide');
                $('#form_tambah_asesmen')[0].reset();

                data = response.data;
                render_dokumen();
            }
        })
    })

    function render_diagnosa(deta) {
        if (deta.id_diagnosa == 0) {
            return '<button class="btn btn-success" onclick="open_modal_diagnosa(' + "'" + deta.id_diagnosa + "','" + deta.id + "'" + ')"><i class="fa fa-plus"></i></button><br>';
        }

        if (deta.diagnosa) {
            var diagnosa = deta.diagnosa.kode_icd + ' - ' + deta.diagnosa.nama_icd;

            if (deta.diagnosa.diagnosa_sekunder1 != '') {
                diagnosa += '<br>' + deta.diagnosa.kode_icd_diagnosa_sekunder1 + ' - ' + deta.diagnosa.diagnosa_sekunder1;
            }

            if (deta.diagnosa.diagnosa_sekunder2 != '') {
                diagnosa += '<br>' + deta.diagnosa.kode_icd_diagnosa_sekunder2 + ' - ' + deta.diagnosa.diagnosa_sekunder2;
            }

            if (deta.diagnosa.diagnosa_sekunder3 != '') {
                diagnosa += '<br>' + deta.diagnosa.kode_icd_diagnosa_sekunder3 + ' - ' + deta.diagnosa.diagnosa_sekunder3;
            }

            if (deta.diagnosa.diagnosa_sekunder4 != '') {
                diagnosa += '<br>' + deta.diagnosa.kode_icd_diagnosa_sekunder4 + ' - ' + deta.diagnosa.diagnosa_sekunder4;
            }

            if (deta.diagnosa.diagnosa_sekunder5 != '') {
                diagnosa += '<br>' + deta.diagnosa.kode_icd_diagnosa_sekunder5 + ' - ' + deta.diagnosa.diagnosa_sekunder5;
            }

            return '<div style="display:flex; flex-direction:row;">' +
                '<div>' +
                '<button style="color:#fff" class="btn btn-warning" onclick="open_modal_diagnosa(' + "'" + deta.id_diagnosa + "','" + deta.id + "'" + ')"><i class="fa fa-pencil"></i></button>' +
                '</div>' +
                '<div class="pl-2">' +
                diagnosa +
                '</div>' +
                '</div>';
        }
        return '<button class="btn btn-success" onclick="open_modal_diagnosa(' + "'0','" + deta.id + "'" + ')"><i class="fa fa-plus"></i></button><br>';
    }

    function render_pesanan_lab(deta) {
        if (deta.id_lab == 0 || deta.lab == null) {
            return '<button class="btn btn-dark" onclick="open_modal_lab(' + "'" + deta.id_lab + "','" + deta.id + "'" + ')"><i class="fa fa-plus"></i></button><br>';
        }

        let result = [];
        let pemeriksaan = <?php echo $pemeriksaan ? $pemeriksaan : [] ?>;
        let yang_dipesan = deta.lab ? JSON.parse(deta.lab.periksa) : null;

        if (yang_dipesan != null) {
            for (let i = 0; i < pemeriksaan.length; i++) {
                if (yang_dipesan[pemeriksaan[i].slug] != undefined) {
                    if (yang_dipesan[pemeriksaan[i].slug] == 1) {
                        result.push(pemeriksaan[i].nama);
                    }
                }
            }
        }

        var ins = '<div style="display: flex; flex-direction: row">' +
            '<div style="width:30%">' +
            (deta.lab.status == 'Pesanan ERM' ? '<button type="button" data-toggle="tooltip" title="Ubah Pemeriksaan" class="btn btn-warning" onclick="open_modal_lab(' + "'" + (deta.lab ? deta.lab.id : 0) + "','" + deta.id + "'" + ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>' : '') +
            '<button type="button" data-toggle="tooltip" title="Hasil Lab" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_lab(' + "'" + (deta.lab ? deta.lab.id : 0) + "'" + ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
            (deta.lab.status == 'Pesanan ERM' ? '<button type="button" data-toggle="tooltip" title="Hapus" class="btn btn-danger ml-1" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_lab(' + "'" + (deta.lab ? deta.lab.id : 0) + "','" + deta.id + "'" + ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' : '') +
            '</div>' +
            '<div class="pl-3 pt-1" style="width:70%">' +
            (deta.lab ? deta.lab.no_lab + ' - ' + result.join(', ') : '') +
            '</div>' +
            '</div>';

        return ins;
    }

    function render_pesanan_rad(deta) {
        if (deta.id_rad == 0 || deta.rad == null) {
            return '<button class="btn btn-dark" onclick="open_modal_rad(' + "'" + deta.id_rad + "','" + deta.id + "'" + ')"><i class="fa fa-plus"></i></button><br>';
        }

        let result = [];
        let pemeriksaan = <?php echo $pemeriksaan_radiologi ? $pemeriksaan_radiologi : [] ?>;

        let yang_dipesan = JSON.parse(deta.rad.periksa);

        for (let i = 0; i < pemeriksaan.length; i++) {
            if (yang_dipesan['rad_' + pemeriksaan[i].id] != undefined) {
                if (yang_dipesan['rad_' + pemeriksaan[i].id] == 1) {
                    result.push(pemeriksaan[i].nama);
                }
            }
        }

        var ins = '<div style="display: flex; flex-direction: row">' +
            '<div style="width:30%">' +
            (deta.rad.status == 'Pesanan ERM' ? '<button type="button" data-toggle="tooltip" title="Ubah Pemeriksaan" class="btn btn-warning" onclick="open_modal_rad(' + "'" + deta.rad.id + "','" + deta.id + "'" + ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>' : '') +
            '<button type="button" data-toggle="tooltip" title="Hasil Radiologi" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_rad(' + "'" + deta.rad.id + "'" + ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
            (deta.rad.status == 'Pesanan ERM' ? '<button type="button" data-toggle="tooltip" title="Hapus" class="btn btn-danger ml-1" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_rad(' + "'" + deta.rad.id + "','" + deta.id + "'" + ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' : '') +
            '</div>' +
            '<div class="pl-3 pt-1" style="width:70%">' +
            deta.rad.no_lab + ' - ' + result.join(', ') +
            '</div>' +
            '</div>';

        return ins;
    }

    function render_resep(deta) {
        if (deta.id_resep == 0) {
            return '<button class="btn btn-dark" onclick="open_modal_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "','" + deta.id + "'" + ')"><i class="fa fa-plus"></i></button><br>';
        }
        var ins = '<div style="display: flex; flex-direction: row">' +
            '<div style="width:30%">' +
            (deta.resep ? deta.resep.locked == 0 ? '<button type="button" data-toggle="tooltip" title="Ubah Resep" class="btn btn-warning" onclick="open_modal_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "','" + deta.id + "'" + ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>' : '' : '') +
            '<button type="button" data-toggle="tooltip" title="Preview Resep" class="btn btn-info ml-1" onclick="preview_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "'" + ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
            (deta.resep ? deta.resep.locked == 0 ? '<button type="button" data-toggle="tooltip" title="Lock Resep" class="btn btn-info ml-1" onclick="lock_resep(' + "'" + (deta.resep ? deta.id_resep : 0) + "','" + deta.id + "'" +')"><i class="fa fa-lock" style="color:#fff;"></i></button>' : '' : '') +
            '</div>' +
            '<div class="pl-3 pt-1" style="width:70%">' +
            (deta.resep ? 'No Resep Elektronik ' + deta.resep.id : '') +
            '</div>' +
            '</div>';

        ins += deta.resep ? render_obat_resep(deta.resep.detail) : '';

        return ins;
    }

    function render_obat_resep(deta) {
        var ins = '<table id="tabel_obat_resep">';
        for (let i = 0; i < deta.length; i++) {
            ins += '<tr><td colspan="4">R/</td></tr>' +
                '<tr>' +
                '<td></td>' +
                '<td>' + deta[i].nama_obat + '</td>' +
                '<td>' + deta[i].signa + '</td>' +
                '<td>' + deta[i].jumlah + ' ' + deta[i].satuan + '</td>' +
                '</tr>';
        }
        ins += '</table>';
        return ins;
    }

    function render_dpjp_utama(deta) {
        return '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<span style="font-size: 20px"><b>DPJP UTAMA</b></span>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="vertical-align: text-top; text-align: center;">' +
            '<span id="tgl_dpjp_utama">' + tanggal(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '<br>' +
            '<span id="jam_dpjp_utama">' + jam(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '</td>' +
            '<td style="vertical-align: text-top">' +
            '<div class="input-group">' +
            '<input type="text" hidden value="' + deta.id_ppa + '" id="id_ppa_dpjp_utama_' + deta.id + '">' +
            '<input type="text" readonly value="' + (deta.nama_ppa == '' ? '{{ Auth::user()->realname }}' : deta.nama_ppa) + '" id="nama_ppa_dpjp_utama_' + deta.id + '" class="form-control">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-dark" type="button" onclick="open_modal_yth(`dpjp_utama`,`' + deta.id + '`)"><i class="fa fa-list"></i></button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<span style="font-size: 20px"><b>Subjective :</b></span>' +
            '<br>' +
            '<textarea id="subjective_dpjp_utama_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.subjective + '</textarea>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Objective :</b></span>' +
            '<textarea id="objective_dpjp_utama_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.objective_lain + '</textarea>' +
            '<br>' +
            '<span style="font-size: 20px"><b>File Penunjang : </b></span>' +
            '<input type="file" id="file_penunjang_dpjp_utama_'+deta.id+'"/>' +
            '<br>' +
            (deta.file_penunjang_eksternal != '' ? `<br>Download file : <a style="text-decoration:none; color:#111;" href="{{ url('e_rekam_medis') }}/detail/catatan_perkembangan_pasien_terintegrasi_rawat_inap/download_file_penunjang_eksternal?file=`+deta.file_penunjang_eksternal+`">`+deta.file_penunjang_eksternal+'</a><br>' : '')+
            '<br>' +
            '<span style="font-size: 20px"><b>Assesmen :</b></span>' +
            '<br>' +
            '<div id="box_diagnosa_'+deta.id+'">'+render_diagnosa(deta) +'</div>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Planning :</b></span>' +
            '<br>' +
            'A. Laboratorium' +
            '<br>' +
            '<div id="box_laboratorium_'+deta.id+'">'+ render_pesanan_lab(deta) +'</div>' +
            '<br>' +
            'B. Radiologi' +
            '<br>' +
            '<div id="box_radiologi_'+deta.id+'">'+render_pesanan_rad(deta) +'</div>' +
            '<br>' +
            'Terapi' +
            '<br>' +
            '<div id="box_resep_'+deta.id+'">'+render_resep(deta) +'</div>' +
            '<br>' +
            '<span>Tindak Lanjut</span>' +
            '<textarea id="tindak_lanjut_dpjp_utama_' + deta.id + '" cols="30" rows="6" class="form-control" style="width: 100%;">' + deta.tindak_lanjut + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<textarea id="instruksi_dpjp_utama_' + deta.id + '" cols="30" rows="10" class="form-control" style="width: 100%;">' + deta.instruksi + '</textarea>' +
            '</td>' +
            '<td style="text-align: center; vertical-align:top">' +
            show_tanda_tangan(deta) +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<button class="btn btn-success" style="width:10%" type="button" onclick="simpan(' + "'" + deta.id + "','dpjp_utama'" + ')">Simpan</button>' +
            (deta.status == 0 ? '<button class="btn btn-danger ml-1" style="width:10%" type="button" onclick="batal_form(' + "'" + deta.id + "'" + ')">Batal</button>' : '') +
            '</td>' +
            '</tr>';
    }

    function render_dpjp_pendamping(deta) {
        return '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<span style="font-size: 20px"><b>DPJP Pendamping</b></span>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="vertical-align: text-top; text-align: center;">' +
            '<span id="tgl_dpjp_pendamping">' + tanggal(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '<br>' +
            '<span id="jam_dpjp_pendamping">' + jam(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '</td>' +
            '<td style="vertical-align: text-top">' +
            '<div class="input-group">' +
            '<input type="text" hidden value="' + deta.id_ppa + '" id="id_ppa_dpjp_pendamping_' + deta.id + '">' +
            '<input type="text" readonly value="' + (deta.nama_ppa == '' ? '{{ Auth::user()->realname }}' : deta.nama_ppa) + '" id="nama_ppa_dpjp_pendamping_' + deta.id + '" class="form-control">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-dark" type="button" onclick="open_modal_yth(`dpjp_pendamping`,`' + deta.id + '`)"><i class="fa fa-list"></i></button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<span style="font-size: 20px"><b>Subjective :</b></span>' +
            '<br>' +
            '<textarea id="subjective_dpjp_pendamping_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.subjective + '</textarea>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Objective :</b></span>' +
            '<textarea id="objective_dpjp_pendamping_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.objective_lain + '</textarea>' +
            '<br>' +
            '<span style="font-size: 20px"><b>File Penunjang : </b></span>' +
            '<input type="file" id="file_penunjang_dpjp_pendamping_'+deta.id+'"/>' +
            '<br>' +
            (deta.file_penunjang_eksternal != '' ? `<br>Download file : <a style="text-decoration:none; color:#111;" href="{{ url('e_rekam_medis') }}/detail/catatan_perkembangan_pasien_terintegrasi_rawat_inap/download_file_penunjang_eksternal?file=`+deta.file_penunjang_eksternal+`">`+deta.file_penunjang_eksternal+'</a><br>' : '')+
            '<br>' +
            '<span style="font-size: 20px"><b>Assesmen :</b></span>' +
            '<br>' +
            '<div id="box_diagnosa_'+deta.id+'">'+render_diagnosa(deta) +'</div>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Planning :</b></span>' +
            '<br>' +
            'A. Laboratorium' +
            '<br>' +
            '<div id="box_laboratorium_'+deta.id+'">'+ render_pesanan_lab(deta) +'</div>' +
            '<br>' +
            'B. Radiologi' +
            '<br>' +
            '<div id="box_radiologi_'+deta.id+'">'+render_pesanan_rad(deta) +'</div>' +
            '<br>' +
            'Terapi' +
            '<br>' +
            '<div id="box_resep_'+deta.id+'">'+render_resep(deta) +'</div>' +
            '<br>' +
            '<span>Tindak Lanjut</span>' +
            '<textarea id="tindak_lanjut_dpjp_pendamping_' + deta.id + '" cols="30" rows="6" class="form-control" style="width: 100%;">' + deta.tindak_lanjut + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<textarea id="instruksi_dpjp_pendamping_' + deta.id + '" cols="30" rows="10" class="form-control" style="width: 100%;">' + deta.instruksi + '</textarea>' +
            '</td>' +
            '<td style="text-align: center; vertical-align:top">' +
            show_tanda_tangan(deta) +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<button class="btn btn-success" style="width:10%" type="button" onclick="simpan(' + "'" + deta.id + "','dpjp_pendamping'" + ')">Simpan</button>' +
            (deta.status == 0 ? '<button class="btn btn-danger ml-1" style="width:10%" type="button" onclick="batal_form(' + "'" + deta.id + "'" + ')">Batal</button>' : '') +
            '</td>' +
            '</tr>';
    }

    function render_dr(deta) {
        return '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<span style="font-size: 20px"><b>DR Ruangan</b></span>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="vertical-align: text-top; text-align: center;">' +
            '<span id="tgl_dr">' + tanggal(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '<br>' +
            '<span id="jam_dr">' + jam(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '</td>' +
            '<td style="vertical-align: text-top">' +
            '<div class="input-group">' +
            '<input type="text" hidden value="' + deta.id_ppa + '" id="id_ppa_dr_' + deta.id + '">' +
            '<input type="text" readonly value="' + (deta.nama_ppa == '' ? '{{ Auth::user()->realname }}' : deta.nama_ppa) + '" id="nama_ppa_dr_' + deta.id + '" class="form-control">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-dark" type="button" onclick="open_modal_yth(`dr`,`' + deta.id + '`)"><i class="fa fa-list"></i></button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<span style="font-size: 20px"><b>Subjective :</b></span>' +
            '<br>' +
            '<textarea id="subjective_dr_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.subjective + '</textarea>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Objective :</b></span>' +
            '<textarea id="objective_dr_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.objective_lain + '</textarea>' +
            '<br>' +
            '<span style="font-size: 20px"><b>File Penunjang : </b></span>' +
            '<input type="file" id="file_penunjang_dr_'+deta.id+'"/>' +
            '<br>' +
            (deta.file_penunjang_eksternal != '' ? `<br>Download file : <a style="text-decoration:none; color:#111;" href="{{ url('e_rekam_medis') }}/detail/catatan_perkembangan_pasien_terintegrasi_rawat_inap/download_file_penunjang_eksternal?file=`+deta.file_penunjang_eksternal+`">`+deta.file_penunjang_eksternal+'</a><br>' : '')+
            '<br>' +
            '<span style="font-size: 20px"><b>Assesmen :</b></span>' +
            '<br>' +
            '<div id="box_diagnosa_'+deta.id+'">'+render_diagnosa(deta) +'</div>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Planning :</b></span>' +
            '<br>' +
            'A. Laboratorium' +
            '<br>' +
            '<div id="box_laboratorium_'+deta.id+'">'+ render_pesanan_lab(deta) +'</div>' +
            '<br>' +
            'B. Radiologi' +
            '<br>' +
            '<div id="box_radiologi_'+deta.id+'">'+render_pesanan_rad(deta) +'</div>' +
            '<br>' +
            'Terapi' +
            '<br>' +
            '<div id="box_resep_'+deta.id+'">'+render_resep(deta) +'</div>' +
            '<br>' +
            '<span>Tindak Lanjut</span>' +
            '<textarea id="tindak_lanjut_dr_' + deta.id + '" cols="30" rows="6" class="form-control" style="width: 100%;">' + deta.tindak_lanjut + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<textarea id="instruksi_dr_' + deta.id + '" cols="30" rows="10" class="form-control" style="width: 100%;">' + deta.instruksi + '</textarea>' +
            '</td>' +
            '<td style="text-align: center; vertical-align:top">' +
            show_tanda_tangan(deta) +
            '<br><br><span style="font-size: 20px; text-align:center;"><b>Catatan DPJP :</b></span>' +
            '<textarea id="catatan_dpjp_dr_' + deta.id + '" cols="30" rows="3" class="form-control mt-2" style="width: 100%;">' + deta.catatan_dpjp + '</textarea>' +
            (deta.id_dpjp != 0 ? deta.ttd_dpjp != '' && deta.ttd_dpjp != null ? '<br><img src="{{ env("SMIS_UPLOAD_URL") }}/' + deta.ttd_dpjp + '" class="mt-2" style="height: 2cm; width: 4cm;" alt="">' : '' : '')+
            '<br><button class="btn btn-dark mt-3" type="button" onclick="simpan(' + "'" + deta.id + "','dr','1'" + ')">Simpan Catatan DPJP</button>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<button class="btn btn-success" style="width:10%" type="button" onclick="simpan(' + "'" + deta.id + "','dr','0'" + ')">Simpan</button>' +
            (deta.status == 0 ? '<button class="btn btn-danger ml-1" style="width:10%" type="button" onclick="batal_form(' + "'" + deta.id + "'" + ')">Batal</button>' : '') +
            '</td>' +
            '</tr>';
    }

    function render_fp(deta) {
        return '<form>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<span style="font-size: 20px"><b>Fisioterapi</b></span>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="vertical-align: text-top; text-align: center;">' +
            '<span id="tgl_fp">' + tanggal(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '<br>' +
            '<span id="jam_fp">' + jam(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '</td>' +
            '<td class="text-center" style="vertical-align: text-top">' +
            '<div class="input-group">' +
            '<input type="text" hidden value="' + (deta.id_ppa == 0 ? '{{ Auth::user()->id }}' : deta.id_ppa) + '" id="id_ppa_fp_' + deta.id + '">' +
            '<input type="text" readonly value="' + (deta.nama_ppa == '' ? '{{ Auth::user()->realname }}' : deta.nama_ppa) + '" id="nama_ppa_fp_' + deta.id + '" class="form-control">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-dark" type="button" onclick="open_modal_yth(`fp`,`' + deta.id + '`)""><i class="fa fa-list"></i></button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<span style="font-size: 20px"><b>Subjective :</b></span>' +
            '<br>' +
            '<textarea id="subjective_fp_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.subjective + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Objective :</b></span>' +
            '<br>' +
            '<textarea id="objective_fp_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.objective_lain + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Assesmen :</b></span>' +
            '<br>' +
            '<textarea id="asesmen_fp_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.asesmen + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Planning :</b></span>' +
            '<br>' +
            '<textarea id="planning_fp_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.planning + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<textarea id="instruksi_fp_' + deta.id + '" cols="30" rows="10" class="form-control" style="width: 100%;">' + deta.instruksi + '</textarea>' +
            '</td>' +
            '<td style="text-align: center; vertical-align:top;">' +
            show_tanda_tangan(deta) +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<button class="btn btn-success" style="width:10%" type="button" onclick="simpan(' + "'" + deta.id + "','fp'" + ')">Simpan</button>' +
            (deta.status == 0 ? '<button class="btn btn-danger ml-1" style="width:10%" type="button" onclick="batal_form(' + "'" + deta.id + "'" + ')">Batal</button>' : '') +
            '</td>' +
            '</tr>' +
            '</form>';
    }

    function render_apt(deta) {
        return '<form>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<span style="font-size: 20px"><b>Apt</b></span>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="vertical-align: text-top; text-align: center;">' +
            '<span id="tgl_apt">' + tanggal(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '<br>' +
            '<span id="jam_apt">' + jam(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '</td>' +
            '<td class="text-center" style="vertical-align: text-top">' +
            '<div class="input-group">' +
            '<input type="text" hidden value="' + (deta.id_ppa == 0 ? '{{ Auth::user()->id }}' : deta.id_ppa) + '" id="id_ppa_apt_' + deta.id + '">' +
            '<input type="text" readonly value="' + (deta.nama_ppa == '' ? '{{ Auth::user()->realname }}' : deta.nama_ppa) + '" id="nama_ppa_apt_' + deta.id + '" class="form-control">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-dark" type="button" onclick="open_modal_yth(`apt`,`' + deta.id + '`)""><i class="fa fa-list"></i></button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<span style="font-size: 20px"><b>Subjective :</b></span>' +
            '<br>' +
            '<textarea id="subjective_apt_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.subjective + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Objective :</b></span>' +
            '<br>' +
            '<textarea id="objective_apt_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.objective_lain + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Assesmen :</b></span>' +
            '<br>' +
            '<textarea id="asesmen_apt_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.asesmen + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Planning :</b></span>' +
            '<br>' +
            '<textarea id="planning_apt_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.planning + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<textarea id="instruksi_apt_' + deta.id + '" cols="30" rows="10" class="form-control" style="width: 100%;">' + deta.instruksi + '</textarea>' +
            '</td>' +
            '<td style="text-align: center; vertical-align:top;">' +
            show_tanda_tangan(deta) +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<button class="btn btn-success" style="width:10%" type="button" onclick="simpan(' + "'" + deta.id + "','apt'" + ')">Simpan</button>' +
            (deta.status == 0 ? '<button class="btn btn-danger ml-1" style="width:10%" type="button" onclick="batal_form(' + "'" + deta.id + "'" + ')">Batal</button>' : '') +
            '</td>' +
            '</tr>' +
            '</form>';
    }

    function render_ns(deta) {
        return '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<span style="font-size: 20px"><b>Ns</b></span>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="vertical-align: text-top; text-align: center;">' +
            '<span id="tgl_ns">' + tanggal(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '<br>' +
            '<span id="jam_ns">' + jam(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '</td>' +
            '<td style="vertical-align: text-top">' +
            '<div class="input-group">' +
            '<input type="text" hidden id="id_ppa_ns_' + deta.id + '" value="' + deta.id_ppa + '">' +
            '<input type="text" readonly value="' + (deta.nama_ppa == '' ? '{{ Auth::user()->realname }}' : deta.nama_ppa) + '" id="nama_ppa_ns_' + deta.id + '" class="form-control">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-dark" type="button" onclick="open_modal_yth(`ns`,`' + deta.id + '`)""><i class="fa fa-list"></i></button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td style="vertical-align:top;">' +
            '<span style="font-size: 20px"><b>Subjective :</b></span>' +
            '<br>' +
            '<textarea id="subjective_ns_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.subjective + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Objective :</b></span>' +
            '<div class="row">' +
            '<div class="row">' +
            '<div class="col-md-12">' +
            '<p style="padding-left:15px ;">Keadaan Umum : </p>' +
            '<textarea id="keadaan_umum_ns_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 95%; margin-left: 10px">' + (deta.ttv ? deta.ttv.keadaan_umum : '') + '</textarea>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex;">' +
            '<p style="width: 30%; padding-left:15px; vertical-align: text-top">Kesadaran : </p>' +
            '<div class="pl-2 pr-2" style="width:70%; vertical-align: text-top">' +
            '<select style="width: 73%;" id="kesadaran_ns_' + deta.id + '" class="form-control">' +
            '<option value="Komposmentis" ' + (deta.ttv ? deta.ttv.kesadaran == 'Komposmentis' ? 'selected' : '' : '') + '>Komposmentis</option>' +
            '<option value="Somnolen" ' + (deta.ttv ? deta.ttv.kesadaran == 'Somnolen' ? 'selected' : '' : '') + '>Somnolen</option>' +
            '<option value="Apatis" ' + (deta.ttv ? deta.ttv.kesadaran == 'Apatis' ? 'selected' : '' : '') + '>Apatis</option>' +
            '<option value="Sopor Coma" ' + (deta.ttv ? deta.ttv.kesadaran == 'Sopor Coma' ? 'selected' : '' : '') + '>Sopor Coma</option>' +
            '<option value="Coma" ' + (deta.ttv ? deta.ttv.kesadaran == 'Coma' ? 'selected' : '' : '') + '>Coma</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-12" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">Berat badan : </p>' +
            '<input style="width: 50%;" value="' + (deta.ttv ? deta.ttv.berat_badan : '') + '" onkeyup="hitung_imt(' + "'" + deta.id + "',this.value" + ')" type="number" min="0" step="0.01" id="bb_ns_' + deta.id + '" class="form-control ml-2">' +
            '<p class="pl-2" style="width:20%;">kg</p>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">Tinggi badan : </p>' +
            '<input style="width: 50%;" value="' + (deta.ttv ? deta.ttv.tinggi_badan : '') + '" onkeyup="hitung_imt(' + "'" + deta.id + "',this.value" + ')" type="number" min="0" step="0.01" id="tb_ns_' + deta.id + '" class="form-control ml-2">' +
            '<p class="pl-2" style="width:20%;">cm</p>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">IMT : </p>' +
            '<input style="width: 20%;" readonly id="imt_ns_' + deta.id + '" value="' + render_imt(deta) + '" type="number" min="0" step="0.01" class="form-control ml-2">' +
            '<p class="pl-2" style="width:20%;">kg/m2</p>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; align-items: center;">' +
            '<p style="width: 30%; padding-left:15px; vertical-align: text-top">Status Gizi : </p>' +
            '<div class="pl-2 pr-2" style="width:70%; vertical-align: text-top">' +
            '<input type="radio" ' + (deta.ttv ? deta.ttv.status_gizi == 'normal' ? 'checked' : '' : '') + ' value="normal" name="status_gizi_ns_' + deta.id + '"> Normal' +
            '<input class="ml-2" ' + (deta.ttv ? deta.ttv.status_gizi == 'kurang' ? 'checked' : '' : '') + ' type="radio" value="kurang" name="status_gizi_ns_' + deta.id + '"> Gizi Kurang' +
            '<input class="ml-2" ' + (deta.ttv ? deta.ttv.status_gizi == 'lebih' ? 'checked' : '' : '') + ' type="radio" value="lebih" name="status_gizi_ns_' + deta.id + '"> Gizi Lebih' +
            '</div>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">Tensi : </p>' +
            '<input style="width: 50%" value="' + (deta.ttv ? deta.ttv.tensi : '') + '" type="text" id="tensi_ns_' + deta.id + '" placeholder="Contoh : 100/70">' +
            '<p class="pl-2" style="width:20%;">mmHg</p>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">Nadi : </p>' +
            '<input style="width: 50%" value="' + (deta.ttv ? deta.ttv.nadi : '') + '" type="text" id="nadi_ns_' + deta.id + '">' +
            '<p class="pl-2" style="width:20%;">x/mnt</p>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">Suhu : </p>' +
            '<input style="width: 50%" value="' + (deta.ttv ? deta.ttv.suhu : '') + '" type="text" id="suhu_ns_' + deta.id + '">' +
            '<p class="pl-2" style="width:20%;">&deg;C</p>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">RR : </p>' +
            '<input style="width: 50%" value="' + (deta.ttv ? deta.ttv.rr : '') + '" type="text" id="rr_ns_' + deta.id + '">' +
            '<p class="pl-2" style="width:20%;">x/mnt</p>' +
            '</div>' +
            '<div class="col-md-12 pt-2" style="display: inline-flex; ">' +
            '<p style="width: 30%; padding-left:15px ;">SpO2 : </p>' +
            '<input style="width: 50%" value="' + (deta.ttv ? deta.ttv.spo2 : '') + '" type="text" id="spo2_ns_' + deta.id + '">' +
            '<p class="pl-2" style="width:20%;"></p>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Assesmen :</b></span>' +
            '<br>' +
            '<textarea id="asesmen_ns_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.asesmen + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Planning :</b></span>' +
            '<br>' +
            '<textarea id="planning_ns_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.planning + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:top;">' +
            '<textarea id="instruksi_ns_' + deta.id + '" cols="30" rows="10" class="form-control" style="width: 100%;">' + deta.instruksi + '</textarea>' +
            '</td>' +
            '<td style="text-align: center; vertical-align:top;">' +
            show_tanda_tangan(deta) +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<button class="btn btn-success" style="width:10%" type="button" onclick="simpan(' + "'" + deta.id + "','ns'" + ')">Simpan</button>' +
            (deta.status == 0 ? '<button class="btn btn-danger ml-1" style="width:10%" type="button" onclick="batal_form(' + "'" + deta.id + "'" + ')">Batal</button>' : '') +
            '</td>' +
            '</tr>';
    }

    function render_gizi(deta) {
        return '<form>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<span style="font-size: 20px"><b>Gizi</b></span>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="vertical-align: text-top; text-align: center;">' +
            '<span id="tgl_gizi">' + tanggal(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '<br>' +
            '<span id="jam_gizi">' + jam(deta.tanggal == '' || deta.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : deta.tanggal) + '</span>' +
            '</td>' +
            '<td class="text-center" style="vertical-align: text-top">' +
            '<div class="input-group">' +
            '<input type="text" hidden value="' + (deta.id_ppa == 0 ? '{{ Auth::user()->id }}' : deta.id_ppa) + '" id="id_ppa_gizi_' + deta.id + '">' +
            '<input type="text" readonly value="' + (deta.nama_ppa == '' ? '{{ Auth::user()->realname }}' : deta.nama_ppa) + '" id="nama_ppa_gizi_' + deta.id + '" class="form-control">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-dark" type="button" onclick="open_modal_yth(`apt`,`' + deta.id + '`)""><i class="fa fa-list"></i></button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<span style="font-size: 20px"><b>Assesment :</b></span>' +
            '<br>' +
            '<textarea id="asesmen_gizi_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.asesmen + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Diagnose :</b></span>' +
            '<br>' +
            '<textarea id="objective_gizi_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.objective_lain + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Intervention :</b></span>' +
            '<br>' +
            '<textarea id="subjective_gizi_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.subjective + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Monitoring :</b></span>' +
            '<br>' +
            '<textarea id="planning_gizi_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.planning + '</textarea>' +
            '<br>' +
            '<br>' +
            '<span style="font-size: 20px"><b>Evaluation :</b></span>' +
            '<br>' +
            '<textarea id="catatan_asesmen_gizi_' + deta.id + '" cols="30" rows="3" class="form-control" style="width: 100%;">' + deta.catatan_asesmen + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:top">' +
            '<textarea id="instruksi_gizi_' + deta.id + '" cols="30" rows="10" class="form-control" style="width: 100%;">' + deta.instruksi + '</textarea>' +
            '</td>' +
            '<td style="text-align: center; vertical-align:top;">' +
            show_tanda_tangan(deta) +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="5" class="text-center">' +
            '<button class="btn btn-success" style="width:10%" type="button" onclick="simpan(' + "'" + deta.id + "','gizi'" + ')">Simpan</button>' +
            (deta.status == 0 ? '<button class="btn btn-danger ml-1" style="width:10%" type="button" onclick="batal_form(' + "'" + deta.id + "'" + ')">Batal</button>' : '') +
            '</td>' +
            '</tr>' +
            '</form>';
    }

    function open_modal_yth(jenis, id) {
        $('#id_yth').val(id);
        $('#jenis_yth').val(jenis);
        $('#modal_yth').modal('show');
    }

    $('#tabel_kepada').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: "{{ url('ajax_request/employee') }}",
        columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                data: 'id',
                name: 'id',
                render(data, type, row, meta) {
                    return '<p class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) +
                        '</p>';
                }
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'nama_jabatan',
                name: 'nama_jabatan',
                render(data, type, row) {
                    return '<p class="text-center">' + data + '</p>';
                }
            },
            {
                data: 'id',
                name: 'id',
                render(data, type, row) {
                    var fungsi_set = 'set_kepada(' + "'" + data + "','" + row.nama + "','" + row
                        .nama_jabatan + "'" + ')';
                    return '<div class="text-center"><button type="button" onclick="' + fungsi_set +
                        '" class="btn btn-dark"><i class="fa fa-check"></i></button></div>';
                }
            }
        ]
    });

    function set_kepada(id, nama) {
        $('#nama_ppa_' + $('#jenis_yth').val() + '_' + $('#id_yth').val()).val(nama);
        $('#id_ppa_' + $('#jenis_yth').val() + '_' + $('#id_yth').val()).val(id);

        $('#modal_yth').modal('hide');
    }

    function hitung_imt(id) {
        if ($('#bb_ns_' + id).val() == '' || $('#tb_ns_' + id).val() == '') {
            return;
        }
        var imt = $('#bb_ns_' + id).val() / (($('#tb_ns_' + id).val() / 100) * ($('#tb_ns_' + id).val() / 100));
        $('#imt_ns_' + id).val(imt.toFixed(2));
        if (imt < 18.5) {
            $("input[name='status_gizi_ns_" + id + "'][value='kurang']").prop("checked", true);
        } else if (imt > 18.5 && imt < 24.9) {
            $("input[name='status_gizi_ns_" + id + "'][value='normal']").prop("checked", true);
        } else if (imt > 25) {
            $("input[name='status_gizi_ns_" + id + "'][value='lebih']").prop("checked", true);
        }
    }

    function show_tanda_tangan(deta) {
        if (deta.ttd == '' || deta.ttd == null) {
            return '';
        }
        return '<img src="{{ env("SMIS_UPLOAD_URL") }}/' + deta.ttd + '" style="height: 2cm; width: 4cm;" alt="">';
    }

    function render_imt(deta) {
        if (deta.ttv) {
            if (deta.ttv.berat_badan == '' || deta.ttv.tinggi_badan == '') {
                return '';
            }
            var imt = deta.ttv.berat_badan / ((deta.ttv.tinggi_badan / 100) * (deta.ttv.tinggi_badan / 100));
            return imt.toFixed(2);
        }
        return '';
    }

    function tanggal(param) {
        if (param == '' || param == null) {
            return '';
        }
        let temp = param.split(' ');
        let tgl = temp[0].split('-');
        return tgl[2] + '-' + tgl[1] + '-' + tgl[0];
    }

    function jam(param) {
        if (param == '' || param == null) {
            return '';
        }
        let temp = param.split(' ');
        let jam = temp[1].split(':');
        return jam[0] + ':' + jam[1];
    }
</script>

</html>