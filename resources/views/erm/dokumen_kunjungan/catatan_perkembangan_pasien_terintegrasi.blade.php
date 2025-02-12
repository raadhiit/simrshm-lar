<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Catatan Perkembangan Pasien Terintegrasi</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />

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
    <div class="modal fade" id="modal_pilihan_tipe_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih PPA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_pilihan_jenis_ppa">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Jenis PPA</label>
                            <select id="jenis_ppa" class="form-control">
                                <option value="">Pilih Salah Satu</option>
                                <option value="ns">Ns</option>
                                <option value="dr">Dr</option>
                                <option value="fp">Fp</option>
                                <option value="apt">Apt</option>
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

    <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
                            <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form onsubmit="return cek_form(this)" id="form_persetujuan"
        action="{{ url('e_rekam_medis/detail/save_catatan_perkembangan_pasien_terintegrasi') }}" method="post">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type='hidden' id='hide_id_ppa' name='id_ppa'>
        <input type='hidden' id='hide_ppa' name='ppa'>
        <input type='hidden' id='hide_subyektif' name='subyektif'>
        <input type='hidden' id='hide_instruksi_kesehatan' name='instruksi_kesehatan'>
    </form>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    @if (Session::has('gagal'))
        <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
    @endif
    @if (Session::has('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
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
                    <p
                        style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
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
                    <td style="width: 40%;">NIK</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $pasien->ktp }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">No Rekam Medis</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nrm }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Tgl Lahir</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis Kelamin</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
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
                <button class="btn btn-success" onclick="open_modal_pilihan_tipe_form()"><i class="fa fa-plus"></i>
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
                                <div class="col-2">Fp: Fisioterapist</div>
                                <div class="col-3">Apt: Apoteker</div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    {{-- <div class="row pt-5" style="width:100%; margin-left:0">
        <div class="col-md-2"></div>
        <div class="col-md-8" onclick="open_modal_petugas()"
            style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
            <h5>TTD DJPJ</h5>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <button onclick="submit_form()" class="btn btn-success">Simpan</button>
        </div>
    </div> --}}
    <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
        <div style="text-align: center;" class="col-md-12">
            {{-- @if ($dokumen->id_verifikator != 0) --}}
                <a href="{{ url('e_rekam_medis/detail/pdf_catatan_perkembangan_pasien_terintegrasi?dokumen=' . $dokumen->id) }}"
                    class="btn btn-success" target="_blank">Download PDF</a>
            {{-- @endif --}}
        </div>
    </div>

    {{-- Diagnosa --}}
    <div class="modal fade" id="modal_tambah_diagnosa" style="overflow-y: scroll;" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asesmen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="submit_diagnosa()" id="form_asesmen">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="POST" />
                    <input type="hidden" name="kode_icd_tindakan" id="kode_icd_tindakan" />
                    <input type="hidden" name="noreg" value="{{ $layanan->id }}" />
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}" />
                    <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}" id="id_dokter" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" readonly class="form-control"
                                value="{{ date('Y-m-d', strtotime($dokumen->created_at)) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Asal Ruangan</label>
                            <input type="text" name="ruangan" id="ruangan"
                                value="{{ $layanan->last_ruangan }}" readonly class="form-control">
                        </div>
                        <hr>
                        <p style="font-weight: bold; font-size:14px;">DATA DOKTER / PSIKOLOG</p>
                        <div class="form-group">
                            <label for="">Dokter / Psikolog</label>
                            <input type="text" name="dokter" value="{{ Auth::user()->realname }}"
                                id="dokter" readonly class="form-control">
                        </div>
                        <input type="hidden" name="nip_dokter" value="{{ $employee ? $employee->nip : '' }}"
                            id="nip_dokter" readonly class="form-control">
                        {{-- </div> --}}
                        <hr>
                        <p style="font-weight: bold; font-size:14px;">DIAGNOSA</p>
                        <div id="diagnosa">
                            <div class="form-group">
                                <label for="">Diagnosa Utama</label>
                                <input type="text" class="form-control" name="diagnosa" id="diagnosa_primer">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 1</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_satu"
                                    id="diagnosa_sekunder_satu">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 2</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_dua"
                                    id="diagnosa_sekunder_dua">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 3</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_tiga"
                                    id="diagnosa_sekunder_tiga">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 4</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_empat"
                                    id="diagnosa_sekunder_empat">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnosa Sekunder 5</label>
                                <input type="text" class="form-control" name="diagnosa_sekunder_lima"
                                    id="diagnosa_sekunder_lima">
                            </div>
                        </div>
                        <div id="pembanding">
                            <div class="form-group">
                                <label for="">Diagnosa Pembanding</label>
                                <input type="text" class="form-control" name="diagnosa_pembanding"
                                    id="diagnosa_pembanding">
                            </div>
                        </div>
                        <div id="box_msg"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_simpan_diagnosa" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Of Diagnosa --}}

    {{-- Resep --}}
    <div class="modal fade" id="modal_dokter_e_resep" tabindex="-1" style="overflow-y: scroll;" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <table class="table" id="tabel_dokter_e_resep">
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

    <div class="modal fade" id="modal_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                                        <td style="width: 3%"> :</td>
                                        <td style="width: 57%">
                                            {{ sizeof($all_resep) > 0 ? $all_resep[0]->nama_dokter : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>SIP</td>
                                        <td> :</td>
                                        <td>{{ sizeof($all_resep) > 0 ? $all_resep[0]->sip_dokter : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unit Pelayanan</td>
                                        <td> :</td>
                                        <td style="text-transform: uppercase">
                                            {{ sizeof($all_resep) > 0 ? str_replace('_', ' ', $all_resep[0]->ruangan) : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Catatan Obat Racikan</td>
                                        <td> :</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            {{ sizeof($all_resep) > 0 ? $all_resep[0]->catatan_obat_racikan : '' }}
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
                                            Bekasi,
                                            {{ $dokumen->catatan_perkembangan_pasien_terintegrasi ? date('d-m-Y', strtotime($dokumen->catatan_perkembangan_pasien_terintegrasi->tanggal_dr)) : '' }}
                                        </td>
                                    </tr>
                                    @if (sizeof($all_resep) > 0)
                                        @foreach ($all_resep as $ar)
                                            @foreach ($ar->detail as $ar_det)
                                                <tr>
                                                    <td colspan="4">{{ 'R/' }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:20px;"></td>
                                                    <td>{{ $ar_det->nama_obat }}</td>
                                                    <td>{{ $ar_det->signa }}</td>
                                                    <td style="padding-left: 20px;">
                                                        {{ $ar_det->jumlah . ' ' . $ar_det->satuan }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </table>
                            </td>
                        </tr>
                        <tr style="border: 1px solid red;">
                            <td style="border: 1px solid; padding:10px;">
                                <table style="width: 100%">
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td> :</td>
                                        <td>{{ $layanan->nama_pasien }}</td>
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
                                        <td>{{ $layanan->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Pasien</td>
                                        <td> :</td>
                                        <td style="text-transform: uppercase">
                                            {{ str_replace('_', ' ', $layanan->carabayar) }}</td>
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
    <div class="modal fade" id="modal_list_obat" style="overflow-y: scroll;" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="modal_list_riwayat_eresep" style="overflow-y: scroll;" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" style="overflow-y: scroll" id="modal_e_resep" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="hidden" name="ruangan" value="{{ $layanan->last_ruangan }}">
                    <div class="modal-body">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Waktu</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" name="waktu"
                                        id="e_resep_waktu" type="date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">NRM</label>
                                    <input class="form-control" name="nrm" id="e_resep_nrm" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input class="form-control" name="usia" id="e_resep_usia" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Asuransi</label>
                                    <input class="form-control" name="asuransi" id="e_resep_asuransi" type="text"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dokter"
                                            value="{{ Auth::user()->realname }}" id="e_resep_dokter" type="text"
                                            readonly>
                                        <input class="form-control" name="id_dokter" value="{{ Auth::user()->id }}"
                                            id="e_resep_id_dokter" type="hidden">
                                        <div class="input-grou-append">
                                            <button class="btn btn-dark" type="button"
                                                onclick="open_modal_dokter_e_resep('tambah')"><i
                                                    class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" name="nama" id="e_resep_nama" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Badan</label>
                                    <input class="form-control" name="berat_badan"
                                        value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '' }}"
                                        id="e_resep_berat_badan" type="text" readonly>
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
                                    <input class="form-control" name="sip" id="e_resep_sip" value="{{ Session::has('sip') ? Session::get('sip') : '' }}" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="alamat" id="e_resep_alamat" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Pasien</label>
                                    <input class="form-control" name="jenis_pasien" id="e_resep_jenis_pasien"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Obat Racikan</label>
                                    <textarea style="height: 100%;" name="catatan_obat_racikan" id="e_resep_obat_racikan" cols="30" rows="5"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">No. Reg</label>
                                    <input class="form-control" name="noreg" value="{{ $dokumen->noreg }}"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Telp</label>
                                    <input class="form-control" name="telp" id="e_resep_telp" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <input class="form-control" name="perusahaan" id="e_resep_perusahaan"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Catatan</label>
                                    <textarea style="height: 100%;" name="catatan" id="e_resep_catatan" cols="30" rows="5"
                                        class="form-control"></textarea>
                                </div>
                                {{-- <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="kategori" id="e_resep_kategori" class="form-control">
                                    <option value="">--Select Here--</option>
                                    <option value="umum">UMUM</option>
                                    <option value="ina_cbgs">INA CBGS</option>
                                    <option value="covid">COVID</option>
                                    <option value="kronis">KRONIS</option>
                                    <option value="inhealth">INHEALTH</option>
                                </select>
                            </div> --}}
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
                                            <button class="btn btn-dark" type="button"
                                                onclick="open_modal_list_obat('', 'tambah')"><i
                                                    class="fa fa-list"></i></button>
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
                                <div id="additional_form_e_resep"></div>
                                {{-- <div class="form-group">
                                <label for="">Jml. Pakai (x Sehari)</label>
                                <input type="number" value="1" id="e_resep_aturan_pakai"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Pemakaian</label>
                                <input type="text" placeholder="Ex : Sesudah makan" id="e_resep_pemakaian"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Takaran</label>
                                <input type="text" id="e_resep_takaran" class="form-control">
                            </div> --}}
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;"
                                        onclick="tambah_detail_e_resep()">Simpan
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

    <!-- modal edit resep -->
    <div class="modal fade" style="overflow-y: scroll" id="modal_edit_resep" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulir E-Resep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_resep">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_resep" id="edit_resep_id">
                    <input type="hidden" name="detail" id="edit_detail_resep">
                    <input type="hidden" name="ruangan" id="edit_resep_ruangan">
                    <div class="modal-body">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Waktu</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" name="waktu"
                                        id="edit_resep_waktu" type="date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">NRM</label>
                                    <input class="form-control" name="nrm" id="edit_resep_nrm" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input class="form-control" name="usia" id="edit_resep_usia" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Asuransi</label>
                                    <input class="form-control" name="asuransi" id="edit_resep_asuransi"
                                        type="text" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dokter"
                                            value="{{ Auth::user()->realname }}" id="edit_resep_dokter"
                                            type="text" readonly>
                                        <input class="form-control" name="id_dokter" value="{{ Auth::user()->id }}"
                                            id="edit_resep_id_dokter" type="hidden">
                                        <div class="input-grou-append">
                                            <button class="btn btn-dark" type="button"
                                                onclick="open_modal_dokter_e_resep('edit')"><i
                                                    class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" name="nama" id="edit_resep_nama" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Badan</label>
                                    <input class="form-control" name="berat_badan"
                                        value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '' }}"
                                        id="edit_resep_berat_badan" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Depo Tujuan</label>
                                    <select name="depo_tujuan" id="edit_resep_depo_tujuan" class="form-control">
                                        <option value="depo_farmasi">DEPO FARMASI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">SIP</label>
                                    <input class="form-control" name="sip" id="edit_resep_sip" value="{{ Session::has('sip') ? Session::get('sip') : '' }}" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="alamat" id="edit_resep_alamat" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Pasien</label>
                                    <input class="form-control" name="jenis_pasien" id="edit_resep_jenis_pasien"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Obat Racikan</label>
                                    <textarea style="height: 100%;" name="catatan_obat_racikan" id="edit_resep_obat_racikan" cols="30"
                                        rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">No. Reg</label>
                                    <input class="form-control" id="edit_resep_noreg" name="noreg"
                                        value="{{ $dokumen->noreg }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Telp</label>
                                    <input class="form-control" name="telp" id="edit_resep_telp" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <input class="form-control" name="perusahaan" id="edit_resep_perusahaan"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Catatan</label>
                                    <textarea style="height: 100%;" name="catatan" id="edit_resep_catatan" cols="30" rows="5"
                                        class="form-control"></textarea>
                                </div>
                                {{-- <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="kategori" id="edit_kategori" class="form-control">
                                    <option value="">--Select Here--</option>
                                    <option value="umum">UMUM</option>
                                    <option value="ina_cbgs">INA CBGS</option>
                                    <option value="covid">COVID</option>
                                    <option value="kronis">KRONIS</option>
                                    <option value="inhealth">INHEALTH</option>
                                </select>
                            </div> --}}
                            </div>
                        </div>
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12" style="border: 1px dashed"></div>
                        </div>
                        <div class="row pt-3" style="width: 100%; margin-left: 0;">
                            <input type="hidden" id="edit_resep_id_obat" readonly class="form-control">
                            <input type="hidden" id="edit_resep_index_edit" readonly class="form-control">
                            <div class="col-lg-4">
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;" onclick="browse_riwayat_eresep('edit')">Copy Riwayat eResep</button>
                                </div>
                                <div class="form-group" style="display:none">
                                    <label for="">Kode</label>
                                    <input type="text" id="edit_resep_kode_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Obat</label>
                                    <div class="input-group">
                                        <input type="text" id="edit_resep_nama_obat" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button"
                                                onclick="open_modal_list_obat('', 'edit')"><i
                                                    class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label for="">Jenis</label>
                                    <input type="text" id="edit_resep_jenis_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Sisa</label>
                                    <input type="text" id="edit_resep_sisa_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <input type="text" id="edit_resep_satuan_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga (Rp.)</label>
                                    <input type="text" id="edit_resep_harga_obat" readonly class="form-control">
                                    <input type="hidden" id="edit_resep_markup" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" id="edit_resep_jumlah_obat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Signa</label>
                                    <input class="form-control" name="signa" id="edit_resep_signa" type="text">
                                </div>
                                <div id="additional_form_edit_resep"></div>
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;"
                                        onclick="tambah_detail_edit_resep()">Simpan
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
                                        <tbody id="list_detail_edit_resep"></tbody>
                                        <tfoot id="footer_list_detail_edit_resep"></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12 pl-0 pr-0" id="msg_edit_resep"></div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal edit resep -->
    {{-- End Of Resep --}}

    {{-- Lab --}}
    <div class="modal fade" id="modal_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="overflow-y: scroll">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesanan Lab</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="form_laboratorium" method="post">
                    <input type="hidden" name="keluhan_klinis">
                    <input type="hidden" name="id_pesanan" id="id_lab">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" class="form-control" name="noreg" value="{{ $layanan->id }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" name="nama_pasien" value="{{ $layanan->nama_pasien }}"
                                class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">NRM</label>
                            <input type="text" name="nrm" value="{{ $layanan->nrm }}" readonly
                                class="form-control">
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
                            <input type="text" readonly value="{{ $layanan->umur }}" name="umur"
                                class="form-control">
                        </div>
                        {{-- <div class="form-group">
                        <label for="">Alamat</label> --}}
                        <input name="alamat" type="hidden" class="form-control" value="{{ $layanan->alamat }}">
                        {{-- </div> --}}
                        {{-- <div class="form-group">
                        <label for="">Ibu Kandung</label> --}}
                        <input type="hidden" name="ibu" value="{{ $layanan->ibu }}" class="form-control">
                        {{-- </div> --}}
                        {{-- <div class="form-group">
                        <label for="">Jenis Pasien</label> --}}
                        <input type="hidden" name="jenis_pasien" value="{{ $layanan->carabayar }}"
                            class="form-control">
                        {{-- </div> --}}
                        <div class="form-group">
                            <label for="">Ruangan</label>
                            <select id="ruangan_lab" name="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($ruangan as $ru)
                                    <option value="{{ $ru->slug }}"
                                        @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                        {{ $ru->nama }}
                                    </option>
                                @endforeach
                                <option value="pendaftaran"
                                    @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                                </option>
                                <option value="laboratory"
                                    @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                                </option>
                                <option value="radiology"
                                    @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                                    Radiology
                                </option>
                                <option value="elektromedis"
                                    @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                                </option>
                                <option value="medical_checkup"
                                    @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                                </option>
                            </select>
                            {{-- <input type="text" name="ruangan" value="{{ $layanan->last_ruangan }}"
                        class="form-control"> --}}
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" readonly value="{{ date('Y-m-d') }}" name="tanggal"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select id="kelas" name="kelas" readonly style="pointer-events: none;"
                                onclick="return false;" onkeydown="return false;" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($list_kelas as $kls)
                                    <option value="{{ $kls->slug }}"
                                        @if ($kelas_lab) @if ($kls->slug == $kelas_lab->value)
                                        {{ 'selected' }} @endif
                                        @endif>{{ $kls->nama }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" name="kelas" value="{{ $kelas ? $kelas->value : '' }}"
                        class="form-control"> --}}
                        </div>
                        <div class="form-group">
                            <label for="">Dokter</label>
                            {{-- <div class="input-group"> --}}
                            <input type="text" id="dokter_lab" name="dokter" readonly placeholder="Pilih dokter"
                                value="{{ Auth::user()->realname }}" class="form-control">
                            <input type="hidden" value="{{ Auth::user()->id }}" id="id_dokter_lab"
                                name="id_dokter">
                            {{-- <div class="input-group-append">
                                <button type="button" onclick="open_modal_dokter_lab()"
                                    class="btn btn-primary"><i class="fa fa-list"></i></button>
                            </div>
                        </div> --}}
                        </div>
                        {{-- <div class="form-group">
                        <label for="">Konsultan</label>
                        <div class="input-group">
                            <input type="text" name="konsultan" id="konsultan" readonly
                                placeholder="Pilih konsultan" class="form-control">
                            <input type="hidden" name="id_konsultan" id="id_konsultan">
                            <div class="input-group-append">
                                <button type="button" onclick="open_modal_konsultan()"
                                    class="btn btn-primary"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </div> --}}
                        {{-- <div class="form-group">
                        <label for="">Petugas</label>
                        <div class="input-group">
                            <input type="text" name="petugas" id="petugas_lab" readonly
                                placeholder="Pilih petugas" class="form-control">
                            <input type="hidden" name="id_petugas" id="id_petugas_lab">
                            <div class="input-group-append">
                                <button type="button" onclick="open_modal_petugas_lab()"
                                    class="btn btn-primary"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </div> --}}
                        <div class="form-group">
                            <label for="">Diagnosa</label>
                            <input type="text" id="diagnosa_lab" name="diagnosa" value="{{ $layanan->diagnosa ? $layanan->diagnosa->diagnosa != '' ? $layanan->diagnosa->diagnosa : $layanan->diagnosa->nama_icd : '' }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan Pemeriksaan</label>
                            <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan"
                                style="width: 100%" class="form-control">
                                @foreach ($pemeriksaan as $pe)
                                    <option value="{{ $pe->slug }}">{{ $pe->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="loading_pesanan_lab"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_hasil_lab" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- End Of Lab --}}

    {{-- Radiologi --}}
    <!-- Modal hasil radiologi -->
    <div class="modal fade" id="modal_hasil_radiologi" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="modal_pesanan_radiologi" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="_method" value="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" name="noreg" value="{{ $layanan->id }}" readonly
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pasien</label>
                            <input type="text" name="pasien" value="{{ $layanan->nama_pasien }}" readonly
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">NRM</label>
                            <input type="text" name="nrm" value="{{ $layanan->nrm }}" readonly
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <input type="hidden" name="kelamin" value="{{ $layanan->kelamin }}" readonly
                                class="form-control">
                            <input type="text" readonly
                                value="{{ $layanan->kelamin == 0 ? 'Laki-laki' : 'Perempuan' }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Umur</label>
                            <input type="text" name="umur" value="{{ $layanan->umur }}" readonly
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Ruangan</label>
                            <select id="ruangan_rad" name="ruangan" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach ($ruangan as $ru)
                                    <option value="{{ $ru->slug }}"
                                        @if ($layanan->last_ruangan == $ru->slug) {{ 'selected' }} @endif>
                                        {{ $ru->nama }}
                                    </option>
                                @endforeach
                                <option value="pendaftaran"
                                    @if ($layanan->last_ruangan == 'pendaftaran') {{ 'selected' }} @endif>Pendaftaran
                                </option>
                                <option value="laboratory"
                                    @if ($layanan->last_ruangan == 'laboratory') {{ 'selected' }} @endif>Laboratory
                                </option>
                                <option value="radiology"
                                    @if ($layanan->last_ruangan == 'radiology') {{ 'selected' }} @endif>
                                    Radiology
                                </option>
                                <option value="elektromedis"
                                    @if ($layanan->last_ruangan == 'elektromedis') {{ 'selected' }} @endif>Elektromedis
                                </option>
                                <option value="medical_checkup"
                                    @if ($layanan->last_ruangan == 'medical_checkup') {{ 'selected' }} @endif>Medical Checkup
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Dokter</label>
                            <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}">
                            <input type="text" name="dokter" value="{{ Auth::user()->realname }}" readonly
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan Pemeriksaan</label>
                            <select name="pesan_pemeriksaan[]" multiple="multiple"
                                id="pesan_pemeriksaan_radiologi" style="width: 100%" class="form-control">
                                @foreach ($pemeriksaan_radiologi as $per)
                                    <option value="{{ $per->id }}">{{ $per->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="loading_pesanan_rad"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal pesanan radiologi -->
    {{-- End Of Radiologi --}}

    <div class="modal fade" id="modal_yth" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Kepada Yth.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="index_yth">
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

    {{-- <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                <form method="post" id="form_cppt" action="{{ url('e_rekam_medis/rawat_jalan/catatan_perkembangan_pasien_terintegrasi/verifikasi') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="modal-body"> --}}
                        <input type="hidden" name="id" id="verifikasi_id_dokumen">
                        <input type="hidden" name="jenis" id="verifikasi_jenis_ppa">
                        <input type="hidden" name="active_form" id="verifikasi_active_form">
                        <input type="hidden" name="body" id="verifikasi_body">
                        <input hidden type="file" name="dokumen_penunjang" id="verifikasi_dokumen_penunjang">
                        {{-- <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="pass" required placeholder="Masukkan password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                    </div> --}}
                </form>
            {{-- </div>
        </div>
    </div> --}}

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    let active_form = <?php echo $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->active_form != '' ? $dokumen->catatan_perkembangan_pasien_terintegrasi->active_form : '[]' : '[]' ?>;

    let isian_ns = {
        tanggal : '{{ date("Y-m-d H:i:s") }}',
        id_ppa : '{{ Auth::user()->id }}',
        ppa : '{{ Auth::user()->realname }}',
        subjective : '',
        keadaan_umum : '',
        kesadaran : '',
        berat_badan : 0,
        tinggi_badan : 0,
        imt : 0,
        status_gizi : '',
        tensi : '',
        nadi : '',
        suhu : '',
        rr : '',
        spo2 : '',
        asesmen : '',
        planning : '',
        instruksi : '',
    };

    let isian_dr = {
        tanggal : '{{ date("Y-m-d H:i:s") }}',
        id_ppa : '{{ Auth::user()->id }}',
        ppa : '{{ Auth::user()->realname }}',
        subjective : '',
        lain_lain : '',
        dokumen_penunjang : '',
        tindak_lanjut : '',
        instruksi : '',
    };

    let isian_fp = {
        tanggal : '{{ date("Y-m-d H:i:s") }}',
        id_ppa : '{{ Auth::user()->id }}',
        ppa : '{{ Auth::user()->realname }}',
        subjective : '',
        objective : '',
        asesmen : '',
        planning : '',
        instruksi : ''
    };

    let isian_apt = {
        tanggal : '{{ date("Y-m-d H:i:s") }}',
        id_ppa : '{{ Auth::user()->id }}',
        ppa : '{{ Auth::user()->realname }}',
        subjective : '',
        objective : '',
        asesmen : '',
        planning : '',
        instruksi : ''
    };

    function open_modal_pilihan_tipe_form() {
        $('#modal_pilihan_tipe_form').modal('show');
    }

    $('#form_pilihan_jenis_ppa').submit(function(e){
        e.preventDefault();
        tambah_form();
    })

    function tambah_form(){
        if ($('#jenis_ppa').val() == '') {
            alert('Pilih jenis PPA dahulu');
            return;
        }

        if (active_form.includes($('#jenis_ppa').val())) {
            alert('Form sudah pernah ditambahkan');
            $('#modal_pilihan_tipe_form').modal('hide');
            $('#jenis_ppa').val('');
            return;
        }

        active_form.unshift($('#jenis_ppa').val());
        render_form();
    }

    function render_form(){
        if (active_form.length == 0) {
            $('#body_dokumen').html('');
        }

        var ins = '';

        for (let i = 0; i < active_form.length; i++) {
            switch (active_form[i]) {
                case 'ns':
                    ins += element_ns();
                    break;
                case 'dr':
                    ins += element_dr();
                    break;
                case 'fp':
                    ins += element_fp();
                    break;
                case 'apt':
                    ins += element_apt();
                    break;
                default:
                    break;
            }
        }
        $('#body_dokumen').html(ins);
        $('#jenis_ppa').val('');
        $('#modal_pilihan_tipe_form').modal('hide');
    }

    function set_form_ns(key, value){
        isian_ns[key] = value;
        console.log(isian_ns);
        if (key == 'berat_badan' || key == 'tinggi_badan') {
            hitung_imt();
        }
    }

    function set_form_dr(key, value){
        isian_dr[key] = value;
        console.log(isian_dr);
    }

    function set_form_fp(key, value){
        isian_fp[key] = value;
        console.log(isian_fp);
    }

    function set_form_apt(key, value){
        isian_apt[key] = value;
        console.log(isian_apt);
    }

    function hitung_imt() {
        var imt = isian_ns.berat_badan / ((isian_ns.tinggi_badan / 100) * (isian_ns.tinggi_badan / 100));
        isian_ns.imt = imt.toFixed(2);
        $('#imt').val(imt.toFixed(2));
        if (imt < 18.5) {
            $("input[name='form_status_gizi'][value='kurang']").prop("checked",true);
            isian_ns.status_gizi = 'kurang';
        } else if (imt > 18.5 && imt < 24.9) {
            $("input[name='form_status_gizi'][value='normal']").prop("checked",true);
            isian_ns.status_gizi = 'normal';
        } else if (imt > 25) {
            $("input[name='form_status_gizi'][value='lebih']").prop("checked",true);
            isian_ns.status_gizi = 'lebih';
        }
    }

    function tanggal(param){
        if (param == '' || param == null) {
            return '';
        }
        let temp = param.split(' ');
        let tgl = temp[0].split('-');
        return tgl[2]+'-'+tgl[1]+'-'+tgl[0];
    }

    function jam(param){
        if (param == '' || param == null) {
            return '';
        }
        let temp = param.split(' ');
        let jam = temp[1].split(':');
        return jam[0]+':'+jam[1];
    }

    function verifikasi(id, jenis){
        window.event.preventDefault();
        $('#verifikasi_jenis_ppa').val(jenis);
        $('#verifikasi_id_dokumen').val(id);
        $('#verifikasi_active_form').val(JSON.stringify(active_form));
        switch (jenis) {
            case 'ns':
                $('#verifikasi_body').val(JSON.stringify(isian_ns));
                break;
            case 'dr':
                $('#verifikasi_body').val(JSON.stringify(isian_dr));
                break;
            case 'fp':
                $('#verifikasi_body').val(JSON.stringify(isian_fp));
                break;
            case 'apt':
                $('#verifikasi_body').val(JSON.stringify(isian_apt));
                break;
            default:
                break;
        }
        $('#form_cppt').submit();
    }

    function set_dokumen_penunjang(param){
        $("#verifikasi_dokumen_penunjang").prop("files",$("#penunjang_eksternal").prop("files"));
    }
</script>
<script language="javascript">
    function element_ns(){
        return '    <tr>'
        +'        <td colspan="5" class="text-center">'
        +'            <span style="font-size: 20px"><b>Ns</b></span>'
        +'        </td>'
        +'    </tr>'
        +'    <tr>'
        +'        <td style="vertical-align: text-top; text-align: center;">'
        +'            <span id="tgl_ns">'+tanggal(isian_ns.tanggal == '' || isian_ns.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_ns.tanggal)+'</span>'
        +'            <br>'
        +'            <span id="jam_ns">'+jam(isian_ns.tanggal == '' || isian_ns.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_ns.tanggal)+'</span>'
        +'        </td>'
        +'        <td style="vertical-align: text-top">'
        +'            <div class="input-group">'
        +'                <input type="text" hidden id="id_ppa_1" value="'+isian_ns.id_ppa+'">'
        +'                <input type="text" readonly'
        +'                    value="'+(isian_ns.ppa == '' ? '{{ Auth::user()->realname }}' : isian_ns.ppa)+'"'
        +'                    id="ppa_1" class="form-control">'
        +'                <div class="input-group-append">'
        +'                    <button class="btn btn-dark" type="button" onclick="open_modal_yth(`1`)"><i'
        +'                            class="fa fa-list"></i></button>'
        +'                </div>'
        +'            </div>'
        +'        </td>'
        +'        <td style="vertical-align:top;">'
        +'            @if(!isset($dokumen->catatan_perkembangan_pasien_terintegrasi))'
        +'                <button type="button" class="btn btn-success" onclick="ambil_data_sebelumnya()"><i class="fa fa-plus"></i> Ambil data sebelumnya</button>'
        +'                <br>'
        +'            @endif'
        +'            <span style="font-size: 20px"><b>Subjective :</b></span>'
        +'            <br>'
        +'            <textarea id="subjective_ns" onkeyup="set_form_ns('+"'subjective'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_ns.subjective+'</textarea>'
        +'            <br>'
        +'            <br>'
        +'            <span style="font-size: 20px"><b>Objective :</b></span>'
        +'            <div class="row">'
        +'                <div class="row">'
        +'                    <div class="col-md-12">'
        +'                        <p style="padding-left:15px ;">Keadaan Umum : </p>'
        +'                        <textarea id="keadaan_umum" cols="30" rows="3" onkeyup="set_form_ns('+"'keadaan_umum'"+', this.value)" class="form-control" style="width: 95%; margin-left: 10px">'+isian_ns.keadaan_umum+'</textarea>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex;">'
        +'                        <p style="width: 30%; padding-left:15px; vertical-align: text-top">Kesadaran : </p>'
        +'                        <div class="pl-2 pr-2" style="width:70%; vertical-align: text-top">'
        +'                            <select style="width: 73%;" onchange="set_form_ns('+"'kesadaran'"+', this.value)" name="kesadaran" class="form-control">'
        +'                            <option value="Komposmentis" '+(isian_ns.kesadaran == 'Komposmentis' ? 'selected' : '')+'>Komposmentis</option>'
        +'                            <option value="Somnolen" '+(isian_ns.kesadaran == 'Somnolen' ? 'selected' : '')+'>Somnolen</option>'
        +'                            <option value="Apatis" '+(isian_ns.kesadaran == 'Apatis' ? 'selected' : '')+'>Apatis</option>'
        +'                            <option value="Sopor Coma" '+(isian_ns.kesadaran == 'Sopor Coma' ? 'selected' : '')+'>Sopor Coma</option>'
        +'                            <option value="Coma" '+(isian_ns.kesadaran == 'Coma' ? 'selected' : '')+'>Coma</option>'
        +'                            </select>'
        +'                        </div>'
        +'                    </div>'
        +'                    <div class="col-md-12" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">Berat badan : </p>'
        +'                        <input style="width: 50%;" onkeyup="set_form_ns('+"'berat_badan'"+', this.value)"'
        +'                            value="'+isian_ns.berat_badan+'"'
        +'                            type="number" min="0" step="0.01" id="bb" class="form-control ml-2">'
        +'                        <p class="pl-2" style="width:20%;">kg</p>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">Tinggi badan : </p>'
        +'                        <input style="width: 50%;" onkeyup="set_form_ns('+"'tinggi_badan'"+', this.value)"'
        +'                            value="'+isian_ns.tinggi_badan+'"'
        +'                            type="number" min="0" step="0.01" id="tb" class="form-control ml-2">'
        +'                        <p class="pl-2" style="width:20%;">cm</p>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">IMT : </p>'
        +'                        <input style="width: 30%;" readonly id="imt"'
        +'                            value="'+(isian_ns.berat_badan/((isian_ns.tinggi_badan / 100) * (isian_ns.tinggi_badan / 100))).toFixed(2)+'"'
        +'                            type="number" min="0" step="0.01" class="form-control ml-2">'
        +'                        <p class="pl-2" style="width:20%;">kg/m2</p>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; align-items: center;">'
        +'                        <p style="width: 30%; padding-left:15px; vertical-align: text-top">Status Gizi : </p>'
        +'                        <div class="pl-2 pr-2" style="width:70%; vertical-align: text-top">'
        +'                            <input onclick="set_form_ns('+"'status_gizi'"+', this.value)" type="radio" '+ (isian_ns.status_gizi == 'normal' ? 'checked' : '')
        +'                                  value="normal" name="form_status_gizi"> Normal'
        +'                            <input onclick="set_form_ns('+"'status_gizi'"+', this.value)" class="ml-2" '+ (isian_ns.status_gizi == 'kurang' ? 'checked' : '') +' type="radio" value="kurang" name="form_status_gizi"> Gizi Kurang'
        +'                            <input onclick="set_form_ns('+"'status_gizi'"+', this.value)" '+ (isian_ns.status_gizi == 'lebih' ? 'checked' : '')+' type="radio" value="lebih" name="form_status_gizi"> Gizi Lebih'
        +'                        </div>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">Tensi : </p>'
        +'                        <input style="width: 50%" value="'+isian_ns.tensi+'" onkeyup="set_form_ns('+"'tensi'"+', this.value)"'
        +'                            type="text" id="tensi" placeholder="Contoh : 100/70"> '
        +'                        <p class="pl-2" style="width:20%;">mmHg</p>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">Nadi : </p>'
        +'                        <input style="width: 50%" value="'+isian_ns.nadi+'" onkeyup="set_form_ns('+"'nadi'"+', this.value)"'
        +'                            type="text" id="nadi"> '
        +'                        <p class="pl-2" style="width:20%;">x/mnt</p>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">Suhu : </p>'
        +'                        <input style="width: 50%" value="'+isian_ns.suhu+'" onkeyup="set_form_ns('+"'suhu'"+', this.value)"'
        +'                            type="text" id="suhu"> '
        +'                        <p class="pl-2" style="width:20%;">&deg;C</p>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">RR : </p>'
        +'                        <input style="width: 50%" value="'+isian_ns.rr+'" onkeyup="set_form_ns('+"'rr'"+', this.value)"'
        +'                            type="text" id="rr"> '
        +'                        <p class="pl-2" style="width:20%;">x/mnt</p>'
        +'                    </div>'
        +'                    <div class="col-md-12 pt-2" style="display: inline-flex; ">'
        +'                        <p style="width: 30%; padding-left:15px ;">SpO2 : </p>'
        +'                        <input style="width: 50%" value="'+isian_ns.spo2+'" onkeyup="set_form_ns('+"'spo2'"+', this.value)"'
        +'                            type="text" id="spo2"> '
        +'                        <p class="pl-2" style="width:20%;"></p>'
        +'                    </div>'
        +'                </div>'
        +'            </div>'
        +'            <br>'
        +'            <span style="font-size: 20px"><b>Assesmen :</b></span>'
        +'            <br>'
        +'            <textarea id="assesmen_ns" cols="30" rows="3" class="form-control" style="width: 100%;" onkeyup="set_form_ns('+"'asesmen'"+', this.value)">'+isian_ns.asesmen+'</textarea>'
        +'            <br>'
        +'            <br>'
        +'            <span style="font-size: 20px"><b>Planning :</b></span>'
        +'            <br>'
        +'            <textarea id="planning_ns" cols="30" rows="3" onkeyup="set_form_ns('+"'planning'"+', this.value)" class="form-control" style="width: 100%;">'+isian_ns.planning+'</textarea>'
        +'        </td>'
        +'        <td style="vertical-align:top;">'
        +'            <textarea id="intruksi_ppa" cols="30" rows="3" onkeyup="set_form_ns('+"'instruksi'"+', this.value)" class="form-control" style="width: 100%;">'+isian_ns.instruksi+'</textarea>'
        +'        </td>'
        +'        <td style="text-align: center; vertical-align:top;">'
        +'            @if (isset($dokumen->catatan_perkembangan_pasien_terintegrasi->status_ns) && $dokumen->catatan_perkembangan_pasien_terintegrasi->status_ns != 0)'
        // +'                <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `ns`)"'
        // +'                style="width:100%; height:120px; display: flex; justify-content: center; align-items: center; text-decoration: none; color:#111;">'
        +'                @if($employee_ns)'
        +'                    <img src="{{ env("SMIS_UPLOAD_URL") . "/" . $employee_ns->ttd }}"'
        +'                        style="height: 2cm; width: 4cm;" alt="">'
        +'                    @else'
        +'                    <img src=""'
        +'                        style="height: 2cm; width: 4cm;" alt="">'
        +'                    @endif'
        // +'                </a>'
        +'                <br>{{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_ns }}'
        // +'            @else'
        // +'                <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `ns`)" class="col-md-12"'
        // +'                style="text-decoration:none; color:#111; border: 1px solid; justify-content: center; align-items: center; display: flex; height:120px;">'
        // +'                    <p style="font-weight: bold; font-size: 20px; margin: 10px; text-align: center;">Klik disini untuk verifikasi</p>'
        // +'                </a>'
        +'            @endif'
        +'        </td>'
        +'    </tr>'
        +'    <tr>'
        +'        <td colspan="5" class="text-center">'
        +'            <button class="btn btn-success" style="width:10%" type="button" onclick="verifikasi(`{{ $dokumen->id }}`,`ns`)">Simpan</button>'
        +'        </td>'
        +'    </tr>';
    }

    function element_dr(){
        return '<tr>'
        +'    <td colspan="5" class="text-center">'
        +'        <span style="font-size: 20px"><b>Dr</b></span>'
        +'    </td>'
        +'</tr>'
        +'<tr>'
        +'    <td style="vertical-align: text-top; text-align: center;">'
        +'        <span id="tgl_dr">'+tanggal(isian_dr.tanggal == '' || isian_dr.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_dr.tanggal)+'</span>'
        +'        <br>'
        +'        <span id="jam_dr">'+jam(isian_dr.tanggal == '' || isian_dr.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_dr.tanggal)+'</span>'
        +'    </td>'
        +'    <td style="vertical-align: text-top">'
        +'        <div class="input-group">'
        +'            <input type="text" hidden value="'+isian_dr.id_ppa+'" id="id_ppa_2">'
        +'            <input type="text" readonly'
        +'                value="'+(isian_dr.ppa == '' ? '{{ Auth::user()->realname }}' : isian_dr.ppa)+'"'
        +'                id="ppa_2" class="form-control">'
        +'            <div class="input-group-append">'
        +'                <button class="btn btn-dark" type="button" onclick="open_modal_yth(`2`)"><i'
        +'                        class="fa fa-list"></i></button>'
        +'            </div>'
        +'        </div>'
        +'    </td>'
        +'    <td style="vertical-align:top">'
        +'        <span style="font-size: 20px"><b>Subjective :</b></span>'
        +'        <br>'
        +'        <textarea id="subjective_dr" onkeyup="set_form_dr('+"'subjective'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_dr.subjective+'</textarea>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Objective :</b></span>'
        +'        <div class="row" style="font-size:12px;">'
        +'            <div class="col-md-12" style="display: inline-flex;"">'
        +'                <span style="width: 30%;">Keadaan Umum <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                <span id="keadaan_umum_dr">{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->keadaan_umum) : '-' }}</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex; align-items: center;">'
        +'                <span style="width: 30%;">Kesadaran <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                <span id="kesadaran_dr">{{ $layanan->tanda_vital ? ucwords($layanan->tanda_vital->kesadaran) : '-' }}</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex;">'
        +'                <span style="width: 30%;">Berat badan <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                {{-- <input style="width: 50%;"readonly id="berat_badan_dr"'
        +'                       value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '0' }}"'
        +'                       type="number" min="0" step="0.01" class="ml-2"> --}}'
        +'                <span>{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '0' }}</span>'
        +'                <span class="pl-2" style="width:20%;">kg</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex; ">'
        +'                <span style="width: 30%;">Tinggi badan <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                {{-- <input style="width: 50%;"readonly id="tinggi_badan_dr"'
        +'                       value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '0' }}"'
        +'                       type="number" min="0" step="0.01" class="ml-2"> --}}'
        +'                <span>{{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '0' }}</span>'
        +'                <span class="pl-2" style="width:20%;">cm</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex; align-items: center;">'
        +'                <span style="width: 30%;">Status Gizi <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                <span id="status_gizi_dr">{{ $layanan->tanda_vital ? ucfirst($layanan->tanda_vital->status_gizi) : '-' }}</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex; ">'
        +'                <span style="width: 30%;">Tensi <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                {{-- <input style="width: 50%" id="tensi_dr" value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '-' }}"'
        +'                    type="text" readonly placeholder="Contoh : 100/70">  --}}'
        +'                <span>{{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '-' }}</span>'
        +'                <span class="pl-2" style="width:20%;">mmHg</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex; ">'
        +'                <span style="width: 30%;">Nadi <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                {{-- <input style="width: 50%" id="nadi_dr" value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '-' }}"'
        +'                    type="text" readonly>  --}}'
        +'                <span>{{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '-' }}</span>'
        +'                <span class="pl-2" style="width:20%;">x/mnt</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex; ">'
        +'                <span style="width: 30%;">Suhu <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                {{-- <input style="width: 50%" id="suhu_dr" value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '-' }}"'
        +'                    type="text" readonly>  --}}'
        +'                <span>{{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '-' }}</span>'
        +'                <span class="pl-2" style="width:20%;">&deg;C</span>'
        +'            </div>'
        +'            <div class="col-md-12" style="display: inline-flex; ">'
        +'                <span style="width: 30%;">RR <span style="float: right; padding-right: 5px">: </span> </span>'
        +'                {{-- <input style="width: 50%" id="rr_dr" value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '-' }}"'
        +'                    type="text" readonly>  --}}'
        +'                <span>{{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '-' }}</span>'
        +'                <span class="pl-2" style="width:20%;">x/mnt</span>'
        +'            </div>'
        +'            <div class="col-md-12 pt-2">'
        +'                <p>Dokumen Penunjang Eksternal : </p>'
        +'                <input type="file" id="penunjang_eksternal" onchange="set_dokumen_penunjang(this.value)">'
        +'                <br>'
        +'                @if ($dokumen->catatan_perkembangan_pasien_terintegrasi && $dokumen->catatan_perkembangan_pasien_terintegrasi->dokumen_penunjang != '')'
        +'                    <br>File : {{ $dokumen->catatan_perkembangan_pasien_terintegrasi->dokumen_penunjang }} <a'
        +'                        href="{{ url("e_rekam_medis/rawat_jalan/catatan_perkembangan_pasien_terintegrasi/download_dokumen_penunjang_eksternal?dokumen=" . $dokumen->id) }}"'
        +'                        target="_blank" class="btn btn-info mt-2" type="button"'
        +'                        data-toggle="tooltip" title="Download"><i class="fa fa-arrow-down"></i></a>'
        +'                @endif'
        +'            </div>'
        +'            <div class="col-md-12 pt-4">'
        +'                  <span style="font-size: 20px"><b>Lain - lain :</b></span>'
        +'                  <br>'
        +'                  <textarea id="lain_lain_dr" onkeyup="set_form_dr('+"'lain_lain'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_dr.lain_lain+'</textarea>'
        // +'                  <br>'
        // +'                  <br>'
        +'            </div>'
        +'        </div>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Assesmen :</b></span>'
        +'        <br>'
        +'        <div style="display: flex; flex-direction: row">'
        +'            <div id="box_button_diagnosa">'
        +'                @if ($layanan->diagnosa == null)'
        +'                    <button type="button" class="btn btn-success"'
        +'                        onclick="open_form_tambah_diagnosa()"><i class="fa fa-plus"></i></button>'
        +'                @else'
        +'                    <button type="button" class="btn btn-warning"'
        +'                        onclick="open_form_tambah_diagnosa()"'
        +'                        style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>'
        +'                @endif'
        +'            </div>'
        +'            <div id="box_diagnosa" class="ml-2">'
        +'                {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd != '' ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : $layanan->diagnosa->diagnosa : '' }}'
        +'                <div id="box_diagnosa_sekunder">'
        +'                    <?php if ($layanan->diagnosa != null) { $temp = ""; if ($layanan->diagnosa->diagnosa_sekunder1 != null) { $temp .= ($kode_sekunder1 ? $kode_sekunder1->icd : "") . " - " . $layanan->diagnosa->diagnosa_sekunder1; } if ($layanan->diagnosa->diagnosa_sekunder2 != null) { $temp .= "<br>" . ($kode_sekunder2 ? $kode_sekunder2->icd : "") . " - " . $layanan->diagnosa->diagnosa_sekunder2; } if ($layanan->diagnosa->diagnosa_sekunder3 != null) { $temp .= "<br>" . ($kode_sekunder3 ? $kode_sekunder3->icd : "") . " - " . $layanan->diagnosa->diagnosa_sekunder3; } echo $temp; } ?>'
        +'                </div>'
        +'            </div>'
        +'        </div>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Planning :</b></span>'
        +'        <br>'
        +'        Laboratorium'
        +'        <div style="display: flex; flex-direction: row">'
        +'            <div id="box_button_pesanan_lab">'
        +'                @if (is_null($pesanan_lab))'
        +'                    <button type="button" class="btn btn-dark" data-toggle="tooltip"'
        +'                        title="Tambah pemeriksaan" onclick="open_modal_lab()"><i'
        +'                            class="fa fa-plus"></i></button>'
        +'                @else'
        +'                        <button type="button" data-toggle="tooltip" title="Ubah Pemeriksaan"'
        +'                            class="btn btn-warning" onclick="open_modal_lab()"><i'
        +'                                class="fa fa-pencil" style="color:#fff;"></i></button>'
        +'                        <button type="button" data-toggle="tooltip" title="Hasil Lab"'
        +'                            class="btn btn-info" data-toggle="tooltip" title="Hasil"'
        +'                            onclick="open_modal_hasil_lab(`{{ $pesanan_lab->id }}`)"><i'
        +'                                class="fa fa-book" style="color:#fff;"></i></button>'
        +'                      @if ($pesanan_lab->status == "" || $pesanan_lab->status == "Pesanan ERM")'
        +'                        <button type="button" data-toggle="tooltip" title="Hapus"'
        +'                            class="btn btn-danger" data-toggle="tooltip" title="Hapus"'
        +'                            onclick="hapus_pesanan_lab(`{{ $pesanan_lab->id }}`)"><i'
        +'                                class="fa fa-trash" style="color:#fff;"></i></button>'
        +'                      @endif'
        +'                @endif'
        +'            </div>'
        +'            <div id="list_pesanan" class="pl-3 pt-1">'
        +'                @if ($pesanan_lab)'
        +'                    @php $iterasi_pesanan_lab = 0; $pesan = ''; @endphp'
        +'                    <?php $yang_dipesan = json_decode($pesanan_lab->periksa); ?>'
        +'                    @foreach ($pemeriksaan as $pem) @php $temp_slug = $pem->slug; @endphp'
        +'                        @if(isset($yang_dipesan->$temp_slug)) @if ($yang_dipesan->$temp_slug == 1) @if ($iterasi_pesanan_lab > 0) @php $pesan .= ', ' . $pem->nama; @endphp @else @php $pesan .= $pem->nama; @endphp @endif @php $iterasi_pesanan_lab++; @endphp @endif @endif'
        +'                    @endforeach'
        +'                    {{ $pesanan_lab->no_lab }} - {{ $pesan }}'
        +'                @endif'
        +'            </div>'
        +'        </div>'
        +'        <br>'
        +'B. Radiologi'
        +'<div style="display: flex; flex-direction: row">'
        +'<div id="box_button_pesanan_radiologi">'
        +'@if (is_null($pesanan_rad))'
        +'<button onclick="open_modal_pesanan_radiologi()" type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button>'
        +'@endif'
        +'</div>'
        +'<div id="list_pesanan_radiologi">'
        +'@if ($pesanan_rad)'
        +'<button class="btn btn-warning" type="button" onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil" style="color:#fff;"></i></button>'
        +'<button class="btn btn-info ml-1" type="button" data-toggle="tooltip" title="Hasil"'
        +'onclick="open_modal_hasil_radiologi(`{{ $pesanan_rad->id }}`)"><i class="fa fa-book" style="color:#fff;"></i></button>'
        +'                      @if ($pesanan_rad->status == "" || $pesanan_rad->status == "Pesanan ERM")'
        +'                        <button type="button" data-toggle="tooltip" title="Hapus"'
        +'                            class="btn btn-danger mr-3" data-toggle="tooltip" title="Hapus"'
        +'                            onclick="hapus_pesanan_rad(`{{ $pesanan_rad->id }}`)"><i'
        +'                                class="fa fa-trash" style="color:#fff;"></i></button>'
        +'                      @endif'
        +'@php $iterasi_pesanan_radiologi = 0; $pesan_radiologi = ''; @endphp'
        +'<?php $yang_dipesan = json_decode($pesanan_rad->periksa); ?>'
        +'@foreach ($pemeriksaan_radiologi as $pemrad)'
        +'@php $temp_slug = "rad_" .$pemrad->id; @endphp'
        +'@if (isset($yang_dipesan->$temp_slug) && $yang_dipesan->$temp_slug == 1)'
        +'@if ($iterasi_pesanan_radiologi > 0)'
        +'@php $pesan_radiologi .= ', ' . $pemrad->nama; @endphp'
        +'@else'
        +'@php $pesan_radiologi .= $pemrad->nama; @endphp'
        +'@endif'
        +'@php $iterasi_pesanan_radiologi++; @endphp'
        +'@endif'
        +'@endforeach'
        +'{{ $pesanan_rad->no_lab }} - {{ $pesan_radiologi }}'
        +'@endif'
        +'</div>'
        +'</div>'
        +'<br>'
        +'        Terapi'
        +'        <br>'
        +'        <div id="box_btn_eresep">'
        +'            @if ($layanan->resep)'
        +'                @if ($layanan->resep->locked == 0)'
        +'                    <button class="btn btn-warning" type="button" style="color: #fff;"'
        +'                        onclick="open_modal_edit_resep(`{{ $layanan->resep->id }}`)"'
        +'                        data-toggle="tooltip" title="Ubah resep"><i'
        +'                            class="fa fa-pencil"></i></button>'
        +'                    <button class="btn btn-info" type="button" style="color: #fff;"'
        +'                        onclick="lock_terapi(`{{ $layanan->resep->id }}`)" data-toggle="tooltip"'
        +'                        title="Lock resep"><i class="fa fa-lock"></i></button>'
        +'                @endif'
        +'                <button class="btn btn-info" type="button" style="color: #fff;"'
        +'                    onclick="preview_terapi(`{{ $layanan->resep->id }}`)" data-toggle="tooltip"'
        +'                    title="Preview resep"><i class="fa fa-book"></i></button>'
        +'            @else'
        +'                <button onclick="open_modal_e_resep()" class="btn btn-dark" type="button"'
        +'                    data-toggle="tooltip" title="Tambah resep"><i class="fa fa-plus"></i></button>'
        +'            @endif'
        +'            No. Resep Elektronik'
        +'            @if (sizeof($all_resep) > 0)'
        +'                @foreach ($all_resep as $ar)'
        +'                    @if ($loop->iteration > 1)'
        +'                        {{ ', ' . $ar->id }}'
        +'                    @else'
        +'                        {{ $ar->id }}'
        +'                    @endif'
        +'                @endforeach'
        +'            @endif'
        +'        </div>'
        +'        <div id="box_eresep">'
        +'            <table style="border-collapse: collapse; width:100%;" id="tabel_resep">'
        +'                @if (sizeof($all_resep) > 0)'
        +'                    @foreach ($all_resep as $ar)'
        +'                        @foreach ($ar->detail as $ar_det)'
        +'                            <tr>'
        +'                                <td style="border:1px solid transparent; font-size:12px;">{{ "R/" }}</td>'
        +'                                <td style="border:1px solid transparent; font-size:12px;">{{ $ar_det->nama_obat }}</td>'
        +'                                <td style="border:1px solid transparent; font-size:12px;">{{ $ar_det->signa }}</td>'
        +'                                <td style="padding-left: 20px; border:1px solid transparent; font-size:12px;">'
        +'                                    {{ $ar_det->jumlah . ' ' . $ar_det->satuan }}</td>'
        +'                            </tr>'
        +'                        @endforeach'
        +'                    @endforeach'
        +'                @endif'
        +'            </table>'
        +'            <br><b>Resep Racikan</b><br>'
        +'            @if (sizeof($all_resep) > 0)'
        +'                @foreach ($all_resep as $ar)'
        +'                  @php $cor = ''; $temp_catatan = $ar->catatan_obat_racikan ? substr(PHP_OS, 0, 3) == 'WIN' ? explode("\r\n", $ar->catatan_obat_racikan) : explode("\r\n", $ar->catatan_obat_racikan) : []; @endphp'
        +'                  @for ($i =0; $i < sizeof($temp_catatan); $i++)'
        +'                  @if($i > 0)'
        +"                      {{ str_replace('\\', '', $temp_catatan[$i] ) }}<br>"
        +'                  @else'
        +"                      {{ str_replace('\\', '', $temp_catatan[$i] ) }}<br>"
        +'                  @endif'
        +'                  @endfor'        
        +'                @endforeach'
        +'            @endif'
        +'        </div>'
        +'        <br>'
        +'        <span>Tindak Lanjut</span>'
        +'        <textarea id="planning_dr" onkeyup="set_form_dr('+"'tindak_lanjut'"+', this.value)" cols="30" rows="6" class="form-control" style="width: 100%;">'+isian_dr.tindak_lanjut+'</textarea>'
        +'    </td>'
        +'    <td style="vertical-align:top">'
        +'        <textarea id="intruksi_ppa_dr" onkeyup="set_form_dr('+"'instruksi'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_dr.instruksi+'</textarea>'
        +'    </td>'
        +'    <td style="text-align: center; vertical-align:top">'
        // +'        @if (isset($dokumen->catatan_perkembangan_pasien_terintegrasi->status_dr) && $dokumen->catatan_perkembangan_pasien_terintegrasi->status_dr != 0)'
        // +'            <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `dr`)"'
        // +'            style="width:100%; height:120px; display: flex; justify-content: center; align-items: center; text-decoration: none; color:#111;">'
        +'            @if($employee_dr)'
        +'                <img src="{{ env("SMIS_UPLOAD_URL") . "/" . $employee_dr->ttd }}"'
        +'                    style="height: 2cm; width: 4cm;" alt="">'
        +'                @else'
        +'                <img src=""'
        +'                    style="height: 2cm; width: 4cm;" alt="">'
        +'                @endif'
        // +'            </a>'
        +'            <br>{{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_dr }}'
        // +'        @else'
        // +'            <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `dr`)" class="col-md-12"'
        // +'            style="text-decoration:none; color:#111; border: 1px solid; justify-content: center; align-items: center; display: flex; height:120px;">'
        // +'                <p style="font-weight: bold; font-size: 20px; margin: 10px; text-align: center;">Klik disini untuk verifikasi</p>'
        // +'            </a>'
        +'        @endif'
        +'    </td>'
        +'</tr>'
        +'    <tr>'
        +'        <td colspan="5" class="text-center">'
        +'            <button class="btn btn-success" style="width:10%" type="button" onclick="verifikasi(`{{ $dokumen->id }}`,`dr`)">Simpan</button>'
        +'        </td>'
        +'    </tr>';
    }

    function element_fp(){
        return '<tr>'
        +'    <td colspan="5" class="text-center">'
        +'        <span style="font-size: 20px"><b>Fp</b></span>'
        +'    </td>'
        +'</tr>'
        +'<tr>'
        +'    <td style="vertical-align: text-top; text-align: center;">'
        +'        <span id="tgl_fp">'+tanggal(isian_fp.tanggal == '' || isian_fp.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_fp.tanggal)+'</span>'
        +'        <br>'
        +'        <span id="jam_fp">'+jam(isian_fp.tanggal == '' || isian_fp.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_fp.tanggal)+'</span>'
        +'    </td>'
        +'    <td class="text-center" style="vertical-align: text-top">'
        +'        <div class="input-group">'
        +'            <input type="text" hidden value="'+isian_fp.id_ppa+'" id="id_ppa_3">'
        +'            <input type="text" readonly'
        +'                value="'+(isian_fp.ppa == '' ? '{{ Auth::user()->realname }}' : isian_fp.ppa)+'"'
        +'                id="ppa_3" class="form-control">'
        +'            <div class="input-group-append">'
        +'                <button class="btn btn-dark" type="button" onclick="open_modal_yth(`3`)"><i'
        +'                        class="fa fa-list"></i></button>'
        +'            </div>'
        +'        </div>'
        +'    </td>'
        +'    <td style="vertical-align:top">'
        +'        <span style="font-size: 20px"><b>Subjective :</b></span>'
        +'        <br>'
        +'        <textarea id="subjective_fp" onkeyup="set_form_fp('+"'subjective'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_fp.subjective+'</textarea>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Objective :</b></span>'
        +'        <br>'
        +'        <textarea id="objective_fp" onkeyup="set_form_fp('+"'objective'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_fp.objective+'</textarea>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Assesmen :</b></span>'
        +'        <br>'
        +'        <textarea id="assesmen_fp" onkeyup="set_form_fp('+"'asesmen'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_fp.asesmen+'</textarea>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Planning :</b></span>'
        +'        <br>'
        +'        <textarea id="planning_fp" onkeyup="set_form_fp('+"'planning'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_fp.planning+'</textarea>'
        +'    </td>'
        +'    <td style="vertical-align:top">'
        +'        <textarea id="intruksi_ppa_fp" onkeyup="set_form_fp('+"'instruksi'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_fp.instruksi+'</textarea>'
        +'    </td>'
        +'    <td style="text-align: center; vertical-align:top;">'
        +'        @if (isset($dokumen->catatan_perkembangan_pasien_terintegrasi->status_fp) && $dokumen->catatan_perkembangan_pasien_terintegrasi->status_fp != 0)'
        // +'            <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `fp`)"'
        // +'            style="width:100%; height:120px; display: flex; justify-content: center; align-items: center; text-decoration: none; color:#111;">'
        +'            @if($employee_fp)'
        +'                <img src="{{ env("SMIS_UPLOAD_URL") . "/" . $employee_fp->ttd }}" style="height: 2cm; width: 4cm;" alt="">'
        +'                @else'
        +'                <img src=""'
        +'                    style="height: 2cm; width: 4cm;" alt="">'
        +'                @endif'
        // +'            </a>'
        +'            <br>{{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_fp }}'
        // +'        @else'
        // +'            <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `fp`)" class="col-md-12"'
        // +'            style="text-decoration:none; color:#111; border: 1px solid; justify-content: center; align-items: center; display: flex; height:120px;">'
        // +'                <p style="font-weight: bold; font-size: 20px; margin: 10px; text-align: center;">Klik disini untuk verifikasi</p>'
        // +'            </a>'
        +'        @endif'
        +'    </td>'
        +'</tr>'
        +'    <tr>'
        +'        <td colspan="5" class="text-center">'
        +'            <button class="btn btn-success" style="width:10%" type="button" onclick="verifikasi(`{{ $dokumen->id }}`,`fp`)">Simpan</button>'
        +'        </td>'
        +'    </tr>';
    }

    function element_apt(){
        return '<tr>'
        +'    <td colspan="5" class="text-center">'
        +'        <span style="font-size: 20px"><b>Apt</b></span>'
        +'    </td>'
        +'</tr>'
        +'<tr>'
        +'    <td style="vertical-align: text-top; text-align: center;">'
        +'        <span id="tgl_apt">'+tanggal(isian_apt.tanggal == '' || isian_apt.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_apt.tanggal)+'</span>'
        +'        <br>'
        +'        <span id="jam_apt">'+jam(isian_apt.tanggal == '' || isian_apt.tanggal == null ? '{{ date("Y-m-d H:i:s") }}' : isian_apt.tanggal)+'</span>'
        +'    </td>'
        +'    <td class="text-center" style="vertical-align: text-top">'
        +'        <div class="input-group">'
        +'            <input type="text" value="'+isian_apt.id_ppa+'" hidden id="id_ppa_4">'
        +'            <input type="text" readonly'
        +'                value="'+(isian_apt.ppa == '' ? '{{ Auth::user()->realname }}' : isian_apt.ppa)+'"'
        +'                id="ppa_4" class="form-control">'
        +'            <div class="input-group-append">'
        +'                <button class="btn btn-dark" type="button" onclick="open_modal_yth(`4`)"><i'
        +'                        class="fa fa-list"></i></button>'
        +'            </div>'
        +'        </div>'
        +'    </td>'
        +'    <td style="vertical-align:top">'
        +'        <span style="font-size: 20px"><b>Subjective :</b></span>'
        +'        <br>'
        +'        <textarea id="subjective_apt" onkeyup="set_form_apt('+"'subjective'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_apt.subjective+'</textarea>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Objective :</b></span>'
        +'        <br>'
        +'        <textarea id="objective_apt" onkeyup="set_form_apt('+"'objective'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_apt.objective+'</textarea>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Assesmen :</b></span>'
        +'        <br>'
        +'        <textarea id="assesmen_apt" onkeyup="set_form_apt('+"'asesmen'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_apt.asesmen+'</textarea>'
        +'        <br>'
        +'        <br>'
        +'        <span style="font-size: 20px"><b>Planning :</b></span>'
        +'        <br>'
        +'        <textarea id="planning_apt" onkeyup="set_form_apt('+"'planning'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_apt.planning+'</textarea>'
        +'    </td>'
        +'    <td style="vertical-align:top">'
        +'        <textarea id="intruksi_ppa_apt" onkeyup="set_form_apt('+"'instruksi'"+', this.value)" cols="30" rows="3" class="form-control" style="width: 100%;">'+isian_apt.instruksi+'</textarea>'
        +'    </td>'
        +'    <td style="text-align: center; vertical-align:top;">'
        +'        @if (isset($dokumen->catatan_perkembangan_pasien_terintegrasi->status_apt) && $dokumen->catatan_perkembangan_pasien_terintegrasi->status_apt != 0)'
        // +'            <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `apt`)"'
        // +'            style="width:100%; height:120px; display: flex; justify-content: center; align-items: center; text-decoration: none; color:#111;">'
        +'            @if($employee_apt)'
        +'                <img src="{{ env("SMIS_UPLOAD_URL") . "/" . $employee_apt->ttd }}"'
        +'                    style="height: 2cm; width: 4cm;" alt="">'
        +'                @else'
        +'                <img src=""'
        +'                    style="height: 2cm; width: 4cm;" alt="">'
        +'                @endif'
        // +'            </a>'
        +'            <br>{{ $dokumen->catatan_perkembangan_pasien_terintegrasi->nama_verifikator_apt }}'
        // +'        @else'
        // +'            <a href="#" onclick="open_modal_verifikasi(`{{ $dokumen->id }}`, `apt`)" class="col-md-12"'
        // +'            style="text-decoration:none; color:#111; border: 1px solid; justify-content: center; align-items: center; display: flex; height:120px;">'
        // +'                <p style="font-weight: bold; font-size: 20px; margin: 10px; text-align: center;">Klik disini untuk verifikasi</p>'
        // +'            </a>'
        +'        @endif'
        +'    </td>'
        +'</tr>'
        +'    <tr>'
        +'        <td colspan="5" class="text-center">'
        +'            <button class="btn btn-success" style="width:10%" type="button" onclick="verifikasi(`{{ $dokumen->id }}`,`apt`)">Simpan</button>'
        +'        </td>'
        +'    </tr>';
    }
</script>
<script>
    function update_pesanan(){
        $.ajax({
            url : "{{ url('ajax_request/update_pesanan') }}",
            method : 'post',
            data : {
                id_dokumen : '{{ $dokumen->id }}',
                dokumen : 'catatan_perkembangan_pasien_terintegrasi',
                id_pesanan_lab : id_pesanan_lab,
                id_pesanan_rad : id_pesanan_rad,
                _token : '{{ csrf_token() }}'
            },
            success:function(response){
                console.log(response);
            }
        })
    }

    $(document).ready(function() {
        @if ($dokumen->catatan_perkembangan_pasien_terintegrasi)
            let cppt = <?php echo $dokumen->catatan_perkembangan_pasien_terintegrasi ?>;
            let ttv = <?php echo $layanan->tanda_vital ? $layanan->tanda_vital : 'null' ?>;

            isian_ns.tanggal = cppt.tanggal_ns == null ? '{{ date("Y-m-d H:i:s") }}': cppt.tanggal_ns;
            isian_ns.id_ppa = cppt.id_ppa == '0' ? '{{ Auth::user()->id }}': cppt.id_ppa;
            isian_ns.ppa = cppt.ppa == '' ? '{{ Auth::user()->realname }}': cppt.ppa;
            isian_ns.subjective = cppt.subjective_ns;
            isian_ns.keadaan_umum = ttv ? ttv.keadaan_umum : '' ;
            isian_ns.kesadaran = ttv ? ttv.kesadaran : '' ;
            isian_ns.berat_badan = ttv ? ttv.berat_badan : 0;
            isian_ns.tinggi_badan = ttv ? ttv.tinggi_badan : 0;
            isian_ns.imt = ttv ? ttv.imt : 0;
            isian_ns.status_gizi = ttv ? ttv.status_gizi : '' ;
            isian_ns.tensi = ttv ? ttv.tensi : '';
            isian_ns.nadi = ttv ? ttv.nadi : '';
            isian_ns.suhu = ttv ? ttv.suhu : '';
            isian_ns.rr = ttv ? ttv.rr : '';
            isian_ns.spo2 = ttv ? ttv.spo2 : '';
            isian_ns.asesmen = cppt.asesmen_ns;
            isian_ns.planning = cppt.planning_ns;
            isian_ns.instruksi = cppt.instruksi_ns;

            console.log(isian_ns);

            isian_dr.tanggal = cppt.tanggal_dr == null ? '{{ date("Y-m-d H:i:s") }}' : cppt.tanggal_dr;
            isian_dr.id_ppa = cppt.id_ppa_dr == '0' ? '{{ Auth::user()->id }}' : cppt.id_ppa_dr;
            isian_dr.ppa = cppt.ppa_dr == '' ? '{{ Auth::user()->realname }}' : cppt.ppa_dr;
            isian_dr.subjective = cppt.subjective_dr;
            isian_dr.lain_lain = cppt.lain_lain_dr;
            isian_dr.tindak_lanjut = cppt.tindak_lanjut_dr;
            isian_dr.instruksi = cppt.instruksi_dr;

            isian_fp.tanggal = cppt.tanggal_fp == null ? '{{ date("Y-m-d H:i:s") }}' : cppt.tanggal_fp;
            isian_fp.id_ppa = cppt.id_ppa_fp == '0' ? '{{ Auth::user()->id }}' : cppt.id_ppa_fp;
            isian_fp.ppa = cppt.ppa_fp == '' ? '{{ Auth::user()->realname }}' : cppt.ppa_fp;
            isian_fp.subjective = cppt.subjective_fp;
            isian_fp.objective = cppt.objective_fp;
            isian_fp.asesmen = cppt.asesmen_fp;
            isian_fp.planning = cppt.planning_fp;
            isian_fp.instruksi = cppt.instruksi_fp;

            isian_apt.tanggal = cppt.tanggal_apt == null ? '{{ date("Y-m-d H:i:s") }}' : cppt.tanggal_apt;
            isian_apt.id_ppa = cppt.id_ppa_apt == '0' ? '{{ Auth::user()->id }}' : cppt.id_ppa_apt;
            isian_apt.ppa = cppt.ppa_apt == '' ? '{{ Auth::user()->realname }}' : cppt.ppa_apt;
            isian_apt.subjective = cppt.subjective_apt;
            isian_apt.objective = cppt.objective_apt;
            isian_apt.asesmen = cppt.asesmen_apt;
            isian_apt.planning = cppt.planning_apt;
            isian_apt.instruksi = cppt.instruksi_apt;

        @endif

        render_form();

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

        $("#edit_resep_nama_obat").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            params: {
                'depo': function() {
                    return $('#edit_resep_depo_tujuan').val();
                }
            },
            onSelect: function(suggestion) {
                $('#additional_form_edit_resep').html('');
                $("#edit_resep_nama_obat").val(suggestion.nama);
                $('#edit_resep_kode_obat').val(suggestion.kode_obat);
                $("#edit_resep_id_obat").val(suggestion.id);
                $("#edit_resep_jenis_obat").val(suggestion.jenis_obat);
                $("#edit_resep_satuan_obat").val(suggestion.satuan_obat);
                $("#edit_resep_sisa_obat").val(suggestion.sisa);

                get_harga_obat(suggestion.id, 'edit');
            }
        })

        $('#pesan_pemeriksaan').select2();
        $('#pesan_pemeriksaan_radiologi').select2();
    });

    function open_modal_dokter() {
        $('#modal_petugas').modal('show');
    }

    function open_form_tambah_diagnosa(tipe) {
        if (tipe == 'diagnosa') {
            $("#diagnosa").removeAttr('hidden');
            $("#pembanding").prop('hidden', true);
        } else if (tipe == 'pembanding') {
            $("#diagnosa").prop('hidden', true);
            $("#pembanding").removeAttr('hidden');
        }
        $.ajax({
            url: "{{ url('ajax_request/diagnosa_by_noreg') }}",
            data: {
                noreg: '{{ $layanan->id }}',
            },
            success: function(response) {
                console.log(response);
                if (Object.keys(response).length > 0) {
                    $('#tanggal').val(response.tanggal);
                    $('#dokter').val(response.nama_dokter);
                    $('#nip_dokter').val(response.id_dokter);
                    $('#id_dokter').val(response.id_dokter);
                    $('#diagnosa_primer').val(response.diagnosa);
                    $('#diagnosa_sekunder_satu').val(response.diagnosa_sekunder1);
                    $('#diagnosa_sekunder_dua').val(response.diagnosa_sekunder2);
                    $('#diagnosa_sekunder_tiga').val(response.diagnosa_sekunder3);
                    $('#diagnosa_sekunder_empat').val(response.diagnosa_sekunder4);
                    $('#diagnosa_sekunder_lima').val(response.diagnosa_sekunder5);
                    $('#diagnosa_tindakan_satu').val(response.diagnosa_tindakan);
                    $('#diagnosa_tindakan_dua').val(response.diagnosa_tindakan2);
                    $('#diagnosa_tindakan_tiga').val(response.diagnosa_tindakan3);
                    $('#diagnosa_tindakan_empat').val(response.diagnosa_tindakan4);
                    $('#diagnosa_tindakan_lima').val(response.diagnosa_tindakan5);
                    $('#diagnosa_kematian').val(response.diagnosa_kematian);
                    $('#diagnosa_pembanding').val(response.diagnosa_pembanding);
                    $('#icd').val(response.nama_icd);
                    $('#kode_icd').val(response.kode_icd);
                    $('#kode_icd_tindakan').val(response.kode_icd_tindakan);
                    $('#penyebab').val(response.sebab_sakit);
                }
                $('#modal_tambah_diagnosa').modal('show');
            }
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
    }

    function submit_diagnosa() {
        window.event.preventDefault();
        if ($('#tanggal').val() == '') {
            alert('Pilih tanggal dahulu');
            return;
        }
        if ($('#dokter').val() == '') {
            alert('Pilih dokter dahulu');
            return;
        }
        if ($('#diagnosa_primer').val() == '') {
            alert('Pilih diagnosa utama dahulu');
            return;
        }
        $('#box_msg').html(loading('Sedang menyimpan data...', 'info'));
        $('#btn_simpan_diagnosa').attr('disabled', true);
        $.ajax({
            url: "{{ url('ajax_request/update_diagnosa') }}",
            method: 'post',
            data: $('#form_asesmen').serialize(),
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    alert(response.message);
                    $('#box_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                } else {
                    $('#box_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    let data = response.data;
                    var temp = '';
                    $('#box_diagnosa').html(data.diagnosa+'<div id="box_diagnosa_sekunder"></div>');
                    if (data.diagnosa_sekunder1 != '') {
                        temp += response.kode_sekunder1.icd + ' - ' + response.kode_sekunder1.nama;
                    }
                    if (data.diagnosa_sekunder2 != '') {
                        temp += '<br>' + response.kode_sekunder2.icd + ' - ' + response.kode_sekunder2.nama;
                    }
                    if (data.diagnosa_sekunder3 != '') {
                        temp += '<br>' + response.kode_sekunder3.icd + ' - ' + response.kode_sekunder3.nama;
                    }
                    if (data.diagnosa_sekunder4 != '') {
                        temp += '<br>' + response.kode_sekunder4.icd + ' - ' + response.kode_sekunder4.nama;
                    }
                    if (data.diagnosa_sekunder5 != '') {
                        temp += '<br>' + response.kode_sekunder5.icd + ' - ' + response.kode_sekunder5.nama;
                    }
                    data.kode_icd != '' ? $('#diagnosa_lab').val(data.nama_icd) : $('#diagnosa_lab').html(data.diagnosa);
                    $('#box_diagnosa').html(data.kode_icd != '' ? data.kode_icd + ' - ' + data.nama_icd+'<div id="box_diagnosa_sekunder"></div>' : data.diagnosa+'<div id="box_diagnosa_sekunder"></div>');
                    $('#box_diagnosa_pembanding').html(data.kode_icd_diagnosa_pembanding + ' - ' + data
                        .nama_diagnosa_pembanding);
                        console.log(temp);
                    $('#box_diagnosa_sekunder').html(temp);
                    $('#box_btn_asesmen').html(
                        '<button class="btn btn-warning" onclick="open_form_tambah_diagnosa()" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>'
                    );
                }
                $('#btn_simpan_diagnosa').removeAttr('disabled');
                $('#box_msg').html('');
                $('#modal_tambah_diagnosa').modal('hide');
            }
        })
    }
</script>

<script>
    var detail_e_resep = [];
    var detail_edit_resep = [];

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
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
                if (action == "add") {
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
                    render_detail_e_resep();
                } else if (action == "edit") {
                    empty_detail_edit_resep();
                    if (response.data.length > 0) {
                        for (let i = 0; i < response.data.length; i++) {
                            detail_edit_resep.push({
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
                    render_detail_edit_resep();
                }
                reset_detail_riwayat_eresep();
                $('#modal_list_riwayat_eresep').modal('hide');
                if (action == "add") {
                    $('#modal_e_resep').modal('show');
                } else if (action == "edit") {
                    $('#modal_edit_resep').modal('show');
                }
            }
        });
    }

    function clear_detail_riwayat_eresep(id) {
        $('#tabel_list_detail_riwayat_eresep tbody').empty();   
        $('#button_preview_' + id).show();
        $('#button_action_' + id).hide();
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
                    $('#modal_e_resep').modal('hide');
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

    function empty_detail_e_resep() {
        if (detail_e_resep.length > 0)
            detail_e_resep.splice(0, detail_e_resep.length);
    }

    function empty_detail_edit_resep() {
        if (detail_edit_resep.length > 0) {
            let new_detail = new Array();
            for (let i = 0; i < detail_edit_resep.length; i++) {
                let id = detail_edit_resep[i].id;
                if (id != "") {
                    new_detail.push({
                        id: detail_edit_resep[i].id,
                        id_obat: detail_edit_resep[i].id_obat,
                        kode_obat: detail_edit_resep[i].kode_obat,
                        nama_obat: detail_edit_resep[i].nama_obat,
                        nama_jenis_obat: detail_edit_resep[i].nama_jenis_obat,
                        jumlah: parseFloat(detail_edit_resep[i].jumlah),
                        satuan: detail_edit_resep[i].satuan,
                        aturan_pakai: detail_edit_resep[i].aturan_pakai ? detail_edit_resep[i].aturan_pakai : '',
                        obat_luar_check: detail_edit_resep[i].obat_luar_check ? detail_edit_resep[i].obat_luar_check : 0,
                        malam_check: detail_edit_resep[i].malam_check ? detail_edit_resep[i].malam_check : 0,
                        malam: detail_edit_resep[i].malam ? detail_edit_resep[i].malam : '',
                        sore_check: detail_edit_resep[i].sore_check ? detail_edit_resep[i].sore_check : 0,
                        sore: detail_edit_resep[i].sore ? detail_edit_resep[i].sore : '',
                        siang_check: detail_edit_resep[i].siang_check ? detail_edit_resep[i].siang_check : 0,
                        siang: detail_edit_resep[i].siang ? detail_edit_resep[i].siang : '',
                        pagi_check: detail_edit_resep[i].pagi_check ? detail_edit_resep[i].pagi_check : 0,
                        pagi: detail_edit_resep[i].pagi ? detail_edit_resep[i].pagi : '',
                        pemakaian: detail_edit_resep[i].pemakaian,
                        keterangan_tambahan: detail_edit_resep[i].keterangan_tambahan ? detail_edit_resep[i].keterangan_tambahan : '',
                        satuan_pakai: detail_edit_resep[i].satuan_pakai,
                        takaran_pakai: detail_edit_resep[i].takaran_pakai,
                        jumlah_pakai_sehari: detail_edit_resep[i].jumlah_pakai_sehari,
                        aturan_pakai_mode: detail_edit_resep[i].aturan_pakai_mode ? detail_edit_resep[i].aturan_pakai_mode : '',
                        harga: parseFloat(detail_edit_resep[i].harga).toFixed(2),
                        markup: detail_edit_resep[i].markup,
                        signa: detail_edit_resep[i].signa,
                        deleted: true
                    });
                }
            }
            detail_edit_resep = new_detail;
        }
    }

    function open_modal_e_resep() {
        $.ajax({
            url: "{{ url('ajax_request/select_kunjungan') }}",
            data: {
                noreg: '{{ $dokumen->noreg }}'
            },
            success: function(response) {
                console.log(response);
                $('#e_resep_nrm').val(response.nrm);
                $('#e_resep_nama').val(response.nama_pasien);
                $('#e_resep_usia').val(response.umur);
                $('#e_resep_alamat').val(response.alamat_pasien);
                $('#e_resep_telp').val(response.telp);
                $('#e_resep_jenis_pasien').val(response.carabayar);
                $('#e_resep_asuransi').val(response.nama_asuransi);
                $('#e_resep_perusahaan').val(response.nama_perusahaan);
                $('#modal_e_resep').modal('show');
            }
        })
    }

    function open_modal_edit_resep(param) {
        $.ajax({
            url: "{{ url('ajax_request/select_resep') }}",
            data: {
                id: param
            },
            success: function(response) {
                console.log(response);
                $('#edit_resep_id').val(response.id);
                $('#edit_resep_ruangan').val(response.ruangan);
                $('#edit_resep_nrm').val(response.nrm_pasien);
                $('#edit_resep_noreg').val(response.noreg_pasien);
                $('#edit_resep_nama').val(response.nama_pasien);
                $('#edit_resep_usia').val(response.usia);
                $('#edit_resep_dokter').val(response.nama_dokter);
                $('#edit_resep_sip').val(response.sip_dokter);
                $('#edit_resep_id_dokter').val(response.id_dokter);
                $('#edit_resep_alamat').val(response.alamat_pasien);
                $('#edit_resep_telp').val(response.no_telpon);
                $('#edit_resep_jenis_pasien').val(response.jenis);
                $('#edit_resep_depo_tujuan').val(response.depo).trigger('change');
                $('#edit_resep_obat_racikan').val(response.catatan_obat_racikan);
                $('#edit_resep_signa').val(response.signa);
                $('#edit_resep_catatan').val(response.catatan);
                $('#edit_resep_jenis_pasien').val(response.carabayar);
                $('#edit_resep_asuransi').val(response.nama_asuransi);
                $('#edit_resep_perusahaan').val(response.nama_perusahaan);

                mapping_edit_detail(response.detail);
            }
        })
    }

    function mapping_edit_detail(data) {
        detail_edit_resep = [];
        if (data != undefined) {
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    detail_edit_resep.push({
                        id: data[i].id,
                        id_obat: data[i].id_obat,
                        kode_obat: data[i].kode_obat,
                        nama_obat: data[i].nama_obat,
                        nama_jenis_obat: data[i].nama_jenis_obat,
                        jumlah: parseFloat(data[i].jumlah),
                        satuan: data[i].satuan,
                        aturan_pakai: data[i].aturan_pakai ? data[i].aturan_pakai : '',
                        obat_luar_check: data[i].obat_luar_check ? data[i].obat_luar_check : 0,
                        malam_check: data[i].malam_check ? data[i].malam_check : 0,
                        malam: data[i].malam ? data[i].malam : '',
                        sore_check: data[i].sore_check ? data[i].sore_check : 0,
                        sore: data[i].sore ? data[i].sore : '',
                        siang_check: data[i].siang_check ? data[i].siang_check : 0,
                        siang: data[i].siang ? data[i].siang : '',
                        pagi_check: data[i].pagi_check ? data[i].pagi_check : 0,
                        pagi: data[i].pagi ? data[i].pagi : '',
                        pemakaian: data[i].pemakaian,
                        keterangan_tambahan: data[i].keterangan_tambahan ? data[i].keterangan_tambahan : '',
                        satuan_pakai: data[i].satuan_pakai,
                        takaran_pakai: data[i].takaran_pakai,
                        jumlah_pakai_sehari: data[i].jumlah_pakai_sehari,
                        aturan_pakai_mode: data[i].aturan_pakai_mode ? data[i].aturan_pakai_mode : '',
                        harga: parseFloat(data[i].harga),
                        markup: data[i].markup,
                        signa: data[i].signa,
                        deleted: false
                    });
                }
            }
        }
        console.log(detail_edit_resep);
        render_detail_edit_resep();
    }

    function tambah_detail_edit_resep() {
        if (
            $('#edit_resep_sisa_obat').val() == '' ||
            $('#edit_resep_satuan_obat').val() == '' ||
            $('#edit_resep_harga_obat').val() == ''
        ) {
            alert('Obat tidak valid');
            return;
        }

        if ($('#edit_resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }

        if ($('#edit_resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }

        if ($('#edit_resep_index_edit').val() == '') {

            for (let o = 0; o < detail_edit_resep.length; o++) {
                if ($('#edit_resep_kode_obat').val() == detail_edit_resep[o].kode_obat) {
                    alert('Obat sudah pernah ditambahkan');
                    return;
                }
            }

            detail_edit_resep.push({
                id: '',
                id_obat: parseInt($('#edit_resep_id_obat').val()),
                kode_obat: $('#edit_resep_kode_obat').val(),
                nama_obat: $('#edit_resep_nama_obat').val(),
                nama_jenis_obat: $('#edit_resep_jenis_obat').val(),
                jumlah: parseFloat($('#edit_resep_jumlah_obat').val()),
                satuan: $('#edit_resep_satuan_obat').val(),
                aturan_pakai: $('#edit_resep_aturan_pakai').val(),
                obat_luar_check: parseInt($('#edit_resep_obat_luar_aktif').val()),
                malam_check: $('#edit_resep_malam').is(':checked') ? 1 : 0,
                malam: "",
                sore_check: $('#edit_resep_sore').is(':checked') ? 1 : 0,
                sore: "",
                siang_check: $('#edit_resep_siang').is(':checked') ? 1 : 0,
                siang: "",
                pagi_check: $('#edit_resep_pagi').is(':checked') ? 1 : 0,
                pagi: "",
                pemakaian: $('#edit_resep_pemakaian').val(),
                keterangan_tambahan: "",
                satuan_pakai: $('#edit_resep_satuan_obat').val(),
                takaran_pakai: $('#edit_resep_satuan_pakai').val(),
                jumlah_pakai_sehari: $('#edit_resep_jumlah_pakai').val(),
                aturan_pakai_mode: $('#edit_resep_aturan_pakai_mode').val(),
                harga: parseFloat($('#edit_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(',', '.')),
                markup: parseInt($('#edit_resep_markup').val()),
                signa: $('#edit_resep_signa').val(),
                deleted: false
            });
        }else{
            detail_edit_resep[$('#edit_resep_index_edit').val()].id_obat = parseInt($('#edit_resep_id_obat').val());
            detail_edit_resep[$('#edit_resep_index_edit').val()].kode_obat = $('#edit_resep_kode_obat').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].nama_obat = $('#edit_resep_nama_obat').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].nama_jenis_obat = $('#edit_resep_jenis_obat').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].jumlah = parseFloat($('#edit_resep_jumlah_obat').val());
            detail_edit_resep[$('#edit_resep_index_edit').val()].satuan = $('#edit_resep_satuan_obat').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].aturan_pakai = $('#edit_resep_aturan_pakai').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].obat_luar_check = parseInt($('#edit_resep_obat_luar_aktif').val());
            detail_edit_resep[$('#edit_resep_index_edit').val()].malam_check = $('#edit_resep_malam').is(':checked') ? 1 : 0;
            detail_edit_resep[$('#edit_resep_index_edit').val()].malam = "";
            detail_edit_resep[$('#edit_resep_index_edit').val()].sore_check = $('#edit_resep_sore').is(':checked') ? 1 : 0;
            detail_edit_resep[$('#edit_resep_index_edit').val()].sore = "";
            detail_edit_resep[$('#edit_resep_index_edit').val()].siang_check = $('#edit_resep_siang').is(':checked') ? 1 : 0;
            detail_edit_resep[$('#edit_resep_index_edit').val()].siang = "";
            detail_edit_resep[$('#edit_resep_index_edit').val()].pagi_check = $('#edit_resep_pagi').is(':checked') ? 1 : 0;
            detail_edit_resep[$('#edit_resep_index_edit').val()].pagi = "";
            detail_edit_resep[$('#edit_resep_index_edit').val()].pemakaian = $('#edit_resep_pemakaian').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].keterangan_tambahan = "";
            detail_edit_resep[$('#edit_resep_index_edit').val()].satuan_pakai = $('#edit_resep_satuan_obat').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].takaran_pakai = $('#edit_resep_satuan_pakai').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].jumlah_pakai_sehari = $('#edit_resep_jumlah_pakai').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].aturan_pakai_mode = $('#edit_resep_aturan_pakai_mode').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].harga = parseFloat($('#edit_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(',', '.'));
            detail_edit_resep[$('#edit_resep_index_edit').val()].markup = parseInt($('#edit_resep_markup').val());
            detail_edit_resep[$('#edit_resep_index_edit').val()].signa = $('#edit_resep_signa').val();
            detail_edit_resep[$('#edit_resep_index_edit').val()].deleted = false;
        }

        $('#edit_resep_index_edit').val('')
        $('#edit_resep_id_obat').val('');
        $('#edit_resep_kode_obat').val('');
        $('#edit_resep_nama_obat').val('');
        $('#edit_resep_jenis_obat').val('');
        $('#edit_resep_sisa_obat').val('');
        $('#edit_resep_satuan_obat').val('');
        $('#edit_resep_jumlah_obat').val('');
        $('#edit_resep_harga_obat').val('');
        $('#edit_resep_signa').val('');
        $('#additional_form_edit_resep').html('');
        render_detail_edit_resep();
    }

    function preview_terapi(param) {
        $('#modal_preview').modal('show');
    }

    function lock_terapi(param) {
        if (confirm('Apakah anda yakin melanjutkan lock e-resep ? resep yang dilock tidak dapat diubah lagi')) {
            $.ajax({
                url: "{{ url('ajax_request/lock_resep') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    alert(response.message);
                    if (response.status) {
                        $('#box_btn_eresep').html('<button class="btn btn-info ml-1"' +
                        'onclick="preview_terapi(' + response.data.id + ')"><i class="fa fa-book"' +
                        'style="color:#fff;"></i></button> No. Resep Elektronik '+response.data.id);
                    }
                }
            })
        }
    }

    function tambah_detail_e_resep() {
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

        if ($('#e_resep_index_edit').val() == '') {

            for (let o = 0; o < detail_e_resep.length; o++) {
                if ($('#e_resep_kode_obat').val() == detail_e_resep[o].kode_obat) {
                    alert('Obat sudah pernah ditambahkan');
                    return;
                }
            }
            detail_e_resep.push({
                id: '',
                id_obat: parseInt($('#e_resep_id_obat').val()),
                kode_obat: $('#e_resep_kode_obat').val(),
                nama_obat: $('#e_resep_nama_obat').val(),
                nama_jenis_obat: $('#e_resep_jenis_obat').val(),
                jumlah: parseFloat($('#e_resep_jumlah_obat').val()),
                satuan: $('#e_resep_satuan_obat').val(),
                aturan_pakai: $('#e_resep_aturan_pakai').val(),
                obat_luar_check: $('#e_resep_obat_luar_aktif').val(),
                malam_check: $('#e_resep_malam').is(':checked') ? 1 : 0,
                malam: "",
                sore_check: $('#e_resep_sore').is(':checked') ? 1 : 0,
                sore: "",
                siang_check: $('#e_resep_siang').is(':checked') ? 1 : 0,
                siang: "",
                pagi_check: $('#e_resep_pagi').is(':checked') ? 1 : 0,
                pagi: "",
                pemakaian: $('#e_resep_pemakaian').val(),
                keterangan_tambahan: "",
                satuan_pakai: $('#e_resep_satuan_obat').val(),
                takaran_pakai: $('#e_resep_satuan_pakai').val(),
                jumlah_pakai_sehari: $('#e_resep_jumlah_pakai').val(),
                aturan_pakai_mode: $('#e_resep_aturan_pakai_mode').val(),
                harga: parseFloat($('#e_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(
                    ',', '.')),
                markup: parseInt($('#e_resep_markup').val()),
                signa: $('#e_resep_signa').val()
            });
        }else{
            detail_e_resep[$('#e_resep_index_edit').val()].id_obat = parseInt($('#e_resep_id_obat').val());
            detail_e_resep[$('#e_resep_index_edit').val()].kode_obat = $('#e_resep_kode_obat').val();
            detail_e_resep[$('#e_resep_index_edit').val()].nama_obat = $('#e_resep_nama_obat').val();
            detail_e_resep[$('#e_resep_index_edit').val()].nama_jenis_obat = $('#e_resep_jenis_obat').val();
            detail_e_resep[$('#e_resep_index_edit').val()].jumlah = parseFloat($('#e_resep_jumlah_obat').val());
            detail_e_resep[$('#e_resep_index_edit').val()].satuan = $('#e_resep_satuan_obat').val();
            detail_e_resep[$('#e_resep_index_edit').val()].aturan_pakai = $('#e_resep_aturan_pakai').val();
            detail_e_resep[$('#e_resep_index_edit').val()].obat_luar_check = $('#e_resep_obat_luar_aktif').val();
            detail_e_resep[$('#e_resep_index_edit').val()].malam_check = $('#e_resep_malam').is(':checked') ? 1 : 0;
            detail_e_resep[$('#e_resep_index_edit').val()].malam = "";
            detail_e_resep[$('#e_resep_index_edit').val()].sore_check = $('#e_resep_sore').is(':checked') ? 1 : 0;
            detail_e_resep[$('#e_resep_index_edit').val()].sore = "";
            detail_e_resep[$('#e_resep_index_edit').val()].siang_check = $('#e_resep_siang').is(':checked') ? 1 : 0;
            detail_e_resep[$('#e_resep_index_edit').val()].siang = "";
            detail_e_resep[$('#e_resep_index_edit').val()].pagi_check = $('#e_resep_pagi').is(':checked') ? 1 : 0;
            detail_e_resep[$('#e_resep_index_edit').val()].pagi = "";
            detail_e_resep[$('#e_resep_index_edit').val()].pemakaian = $('#e_resep_pemakaian').val();
            detail_e_resep[$('#e_resep_index_edit').val()].keterangan_tambahan = "";
            detail_e_resep[$('#e_resep_index_edit').val()].satuan_pakai = $('#e_resep_satuan_obat').val();
            detail_e_resep[$('#e_resep_index_edit').val()].takaran_pakai = $('#e_resep_satuan_pakai').val();
            detail_e_resep[$('#e_resep_index_edit').val()].jumlah_pakai_sehari = $('#e_resep_jumlah_pakai').val();
            detail_e_resep[$('#e_resep_index_edit').val()].aturan_pakai_mode = $('#e_resep_aturan_pakai_mode').val();
            detail_e_resep[$('#e_resep_index_edit').val()].harga = parseFloat($('#e_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(',', '.'));
            detail_e_resep[$('#e_resep_index_edit').val()].markup = parseInt($('#e_resep_markup').val());
            detail_e_resep[$('#e_resep_index_edit').val()].signa = $('#e_resep_signa').val();
        }

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
            $('#additional_form_e_resep').html('');
            $('#e_resep_signa').val('');
            
            render_detail_e_resep();
    }

    function render_detail_e_resep() {
        var ins = '';
        var footer = '';
        let jml = 0;
        for (let i = 0; i < detail_e_resep.length; i++) {
            ins += '<tr>' +
                '<td class="text-center">' + (i + 1) + '</td>' +
                '<td>' + detail_e_resep[i].nama_obat + '</td>' +
                '<td class="text-center">' + detail_e_resep[i].nama_jenis_obat + '</td>' +
                '<td class="text-center">' + detail_e_resep[i].jumlah + '</td>' +
                '<td class="text-center">' + detail_e_resep[i].satuan + '</td>' +
                '<td>Rp. ' + rupiah(detail_e_resep[i].harga) + '</td>' +
                '<td>Rp. ' + rupiah((detail_e_resep[i].harga * detail_e_resep[i].jumlah).toFixed(2)) +
                '</td>'+
                '<td class="text-center">' + detail_e_resep[i].signa + '</td>' +
                '<td class="text-center" style="display:inline-flex;">'+
                '<button onclick="edit_detail_e_resep(' + i + ')" class="btn btn-warning mr-1" style="color:#fff" type="button"><i class="fa fa-pencil"></i></button>'+
                '<button onclick="hapus_detail_e_resep(' + i + ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>'+
                '</td>'+
                '</tr>';
            jml += parseFloat((detail_e_resep[i].harga * detail_e_resep[i].jumlah).toFixed(2));
        }
        if (detail_e_resep.length > 0) {
            footer = '<tr>' +
                '<td colspan="6" style="text-align:right; font-weight:bold;">Total : </td>' +
                '<td style="font-weight:bold;">Rp. ' + rupiah(jml) + '</td>' +
                '<td colspan="2"></td>' +
                '</tr>';
        }
        $('#list_detail_e_resep').html(ins);
        $('#footer_list_detail_e_resep').html(footer);
    }

    function render_detail_edit_resep() {
        var ins = '';
        var footer = '';
        let jml = 0;
        for (let i = 0; i < detail_edit_resep.length; i++) {
            if (!detail_edit_resep[i].deleted) {
                ins += '<tr>' +
                '<td class="text-center">' + (i + 1) + '</td>' +
                '<td>' + detail_edit_resep[i].nama_obat + '</td>' +
                '<td class="text-center">' + detail_edit_resep[i].nama_jenis_obat + '</td>' +
                '<td class="text-center">' + detail_edit_resep[i].jumlah + '</td>' +
                '<td class="text-center">' + detail_edit_resep[i].satuan + '</td>' +
                '<td>Rp. ' + rupiah(detail_edit_resep[i].harga) + '</td>' +
                '<td>Rp. ' + rupiah((detail_edit_resep[i].harga * detail_edit_resep[i].jumlah).toFixed(2)) +
                '</td>'+
                '<td class="text-center">' + detail_edit_resep[i].signa + '</td>' +
                '<td class="text-center" style="display:inline-flex;">'+
                '<button onclick="edit_detail_edit_resep(' + i + ')" class="btn btn-warning mr-1" style="color:#fff" type="button"><i class="fa fa-pencil"></i></button>'+
                '<button onclick="hapus_detail_edit_resep(' + i + ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>'+
                '</td>'+
                '</tr>';
                jml += parseFloat((detail_edit_resep[i].harga * detail_edit_resep[i].jumlah).toFixed(2));
            }
        }
        if (detail_edit_resep.length > 0) {
            footer = '<tr>' +
                '<td colspan="6" style="text-align:right; font-weight:bold;">Total : </td>' +
                '<td style="font-weight:bold;">Rp. ' + rupiah(jml) + '</td>' +
                '<td colspan="2"></td>' +
                '</tr>';
        }
        $('#list_detail_edit_resep').html(ins);
        $('#footer_list_detail_edit_resep').html(footer);
        $('#modal_edit_resep').modal('show');
    }

    function set_dokter_e_resep(nama, id, sip, tipe) {
        tipe == 'tambah' ? $('#e_resep_dokter').val(nama) : $('#edit_resep_dokter').val(nama);
        tipe == 'tambah' ? $('#e_resep_id_dokter').val(id) : $('#edit_resep_id_dokter').val(id);
        tipe == 'tambah' ? $('#e_resep_sip').val(sip) : $('#edit_resep_sip').val(sip);
        $('#modal_dokter_e_resep').modal('hide');
        tipe == 'tambah' ? $('#modal_e_resep').modal('show') : $('#modal_edit_resep').modal('show');
    }

    function hapus_detail_e_resep(index) {
        if (confirm('Yakin melanjutkan hapus data ?')) {
            detail_e_resep.splice(index, 1);
            render_detail_e_resep();
        }
    }

    function hapus_detail_edit_resep(index) {
        if (confirm('Yakin melanjutkan hapus data ?')) {
            detail_edit_resep[index].deleted = true;
            render_detail_edit_resep();
        }
    }

    function edit_detail_e_resep(index){
        $('#e_resep_index_edit').val(index);
        $('#e_resep_id_obat').val(detail_e_resep[index].id_obat);
        $('#e_resep_kode_obat').val(detail_e_resep[index].kode_obat);
        $('#e_resep_nama_obat').val(detail_e_resep[index].nama_obat);
        $('#e_resep_jenis_obat').val(detail_e_resep[index].nama_jenis_obat);
        $('#e_resep_satuan_obat').val(detail_e_resep[index].satuan);
        $('#e_resep_jumlah_obat').val(detail_e_resep[index].jumlah);
        $('#e_resep_harga_obat').val(detail_e_resep[index].harga);
        $('#e_resep_signa').val(detail_e_resep[index].signa);
        $('#additional_form_e_resep').html('');

        select_obat(detail_e_resep[index].id_obat, 'add');
    }

    function edit_detail_edit_resep(index){
        $('#edit_resep_index_edit').val(index);
        $('#edit_resep_id_obat').val(detail_edit_resep[index].id_obat);
        $('#edit_resep_kode_obat').val(detail_edit_resep[index].kode_obat);
        $('#edit_resep_nama_obat').val(detail_edit_resep[index].nama_obat);
        $('#edit_resep_jenis_obat').val(detail_edit_resep[index].nama_jenis_obat);
        $('#edit_resep_satuan_obat').val(detail_edit_resep[index].satuan);
        $('#edit_resep_jumlah_obat').val(detail_edit_resep[index].jumlah);
        $('#edit_resep_harga_obat').val(detail_edit_resep[index].harga);
        $('#edit_resep_signa').val(detail_edit_resep[index].signa);
        $('#additional_form_edit_resep').html('');

        select_obat(detail_edit_resep[index].id_obat, 'edit');
    }

    function select_obat(id, form){
        let prefix = 'e';

        if (form == 'edit') {
            prefix = 'edit';
        }

        $.ajax({
            url : "{{ url('ajax_request/select_obat') }}",
            data : {
                id : id
            },
            success:function(response){
                if (response == null) {
                    return;
                }
                $('#'+prefix+'_resep_sisa_obat').val(response.sisa);
                console.log($('#'+prefix+'_resep_sisa_obat').val())
            }
        })
    }

    function open_modal_list_obat(param, tipe_form) {
        if (tipe_form == 'tambah') {
            if ($('#e_resep_depo_tujuan').val() == '') {
                alert('Pilih depo tujuan dahulu');
                return;
            }
            $('#modal_e_resep').modal('hide');
        } else {
            if ($('#edit_resep_depo_tujuan').val() == '') {
                alert('Pilih depo tujuan dahulu');
                return;
            }
            $('#modal_edit_resep').modal('hide');
        }
        console.log('iki : '+tipe_form);
        $('#tipe_form_search_obat').val(tipe_form);
        get_list_obat(param, tipe_form);
        $('#modal_list_obat').modal('show');
    }

    $('#form_search_obat').submit(function(e) {
        e.preventDefault();
        get_list_obat($('#search_obat').val(), $('#tipe_form_search_obat').val());
    })

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function get_list_obat(kriteria, tipe_form) {
        $('#msg_list_obat').html('');
        if ($.fn.DataTable.isDataTable("#tabel_list_obat")) {
            $('#tabel_list_obat').DataTable().clear().destroy();
        }
        $('#tabel_list_obat').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: "../../ajax_request/list_obat?depo=" + (tipe_form == 'tambah' ? $('#e_resep_depo_tujuan')
                    .val() : $('#edit_resep_depo_tujuan').val()) + '&kriteria=' +
                kriteria,
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
                            "','" + row.sisa + "','" + tipe_form + "'" +
                            ')" class="btn btn-dark"><i class="fa fa-check"></i></button>' +
                            '</div>';
                    }
                },
            ]
        });
    }

    function get_detail_obat(param, kode, nama, satuan, jenis, sisa, tipe_form) {
        $('#msg_list_obat').html(loading('Sedang mengambil harga obat, harap tunggu...', 'info'));
        if (tipe_form == 'edit') {
            $('#edit_resep_id_obat').val(param);
            $('#edit_resep_kode_obat').val(kode);
            $('#edit_resep_nama_obat').val(nama);
            $('#edit_resep_satuan_obat').val(satuan);
            $('#edit_resep_jenis_obat').val(jenis);
            $('#edit_resep_sisa_obat').val(sisa);
        } else {
            $('#e_resep_id_obat').val(param);
            $('#e_resep_kode_obat').val(kode);
            $('#e_resep_nama_obat').val(nama);
            $('#e_resep_satuan_obat').val(satuan);
            $('#e_resep_jenis_obat').val(jenis);
            $('#e_resep_sisa_obat').val(sisa);
        }
        get_harga_obat(param, tipe_form);
    }

    function get_harga_obat(param, tipe_form) {
        console.log(tipe_form);
        $.ajax({
            url: "{{ url('ajax_request/harga_obat') }}",
            data: {
                noreg: "{{ $layanan->id }}",
                id_obat: param,
                depo: (tipe_form == 'tambah' ? $('#e_resep_depo_tujuan').val() : $('#edit_resep_depo_tujuan')
                    .val())
            },
            success: function(response) {
                console.log(response);
                if (response == null) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">Harga obat tidak ditemukan</div>');
                    return;
                } else if (response.code == 500) {
                    $('#msg_list_obat').html(
                        '<div class="alert alert-danger">' + response.message + '</div>');
                    return;
                }
                if (tipe_form == 'edit') {
                    $('#edit_resep_harga_obat').val(rupiah(response.toFixed(2)));
                    $('#modal_list_obat').modal('hide');
                    $('#modal_edit_resep').modal('show');
                } else {
                    $('#e_resep_harga_obat').val(rupiah(response.toFixed(2)));
                    $('#modal_list_obat').modal('hide');
                    $('#modal_e_resep').modal('show');
                }
            }
        })
    }

    function render_field_pemakaian(data) {
        var ins = '';
        if (data.pemakaian_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Pemakaian</label>' +
                '<select class="form-control" id="e_resep_pemakaian">' +
                '<option value="">--Select Here--</option>';

            let temp_pemakaian_option = data.pemakaian_option.split(';');
            console.log(temp_pemakaian_option);

            for (let i = 0; i < temp_pemakaian_option.length; i++) {
                ins += '<option value="' + temp_pemakaian_option[i] + '">' + temp_pemakaian_option[i] + '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_satuan_pakai(data) {
        var ins = '<div class="form-group">' +
            '<label>Satuan Pakai</label>' +
            '<select class="form-control" id="e_resep_satuan_pakai">' +
            '<option value="">--Select Here--</option>';

        let temp_satuan_pakai_option = data.satuan_pakai_option.split(';');

        for (let i = 0; i < temp_satuan_pakai_option.length; i++) {
            ins += '<option value="' + temp_satuan_pakai_option[i] + '">' + temp_satuan_pakai_option[i] +
                '</option>';
        }

        ins += '</select>' +
            '</div>';

        return ins;
    }

    function render_field_edit_satuan_pakai(data) {
        var ins = '<div class="form-group">' +
            '<label>Satuan Pakai</label>' +
            '<select class="form-control" id="edit_resep_satuan_pakai">' +
            '<option value="">--Select Here--</option>';

        let temp_satuan_pakai_option = data.satuan_pakai_option.split(';');

        for (let i = 0; i < temp_satuan_pakai_option.length; i++) {
            ins += '<option value="' + temp_satuan_pakai_option[i] + '">' + temp_satuan_pakai_option[i] +
                '</option>';
        }

        ins += '</select>' +
            '</div>';

        return ins;
    }

    function render_field_aturan_pakai(data) {
        var ins = '';
        if (data.aturan_pakai_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Aturan Pakai</label>' +
                '<select class="form-control" id="e_resep_aturan_pakai">' +
                '<option value="">--Select Here--</option>';

            let temp_aturan_pakai_option = data.aturan_pakai_option.split(';');
            console.log(temp_aturan_pakai_option);

            for (let i = 0; i < temp_aturan_pakai_option.length; i++) {
                ins += '<option value="' + temp_aturan_pakai_option[i] + '">' + temp_aturan_pakai_option[i] +
                    '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_pagi_siang_sore(data) {
        var ins = '';
        ins += '<div class="form-group">' +
            '<label>Pagi</label>' +
            '<input style="margin-left:34px" type="checkbox" id="e_resep_pagi">';

        ins += '<div class="form-group">' +
            '<label>Siang</label>' +
            '<input style="margin-left:25px;" type="checkbox" id="e_resep_siang">';
        ins += '<div class="form-group">' +
            '<label>Sore</label>' +
            '<input style="margin-left:33px" type="checkbox" id="e_resep_sore">';
        ins += '<div class="form-group">' +
            '<label>Malam</label>' +
            '<input class="ml-3" type="checkbox" id="e_resep_malam">';
        return ins;
    }

    function render_field_edit_pemakaian(data) {
        var ins = '';
        if (data.pemakaian_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Pemakaian</label>' +
                '<select class="form-control" id="edit_resep_pemakaian">' +
                '<option value="">--Select Here--</option>';

            let temp_pemakaian_option = data.pemakaian_option.split(';');
            console.log(temp_pemakaian_option);

            for (let i = 0; i < temp_pemakaian_option.length; i++) {
                ins += '<option value="' + temp_pemakaian_option[i] + '">' + temp_pemakaian_option[i] + '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_edit_aturan_pakai(data) {
        var ins = '';
        if (data.aturan_pakai_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Aturan Pakai</label>' +
                '<select class="form-control" id="edit_resep_aturan_pakai">' +
                '<option value="">--Select Here--</option>';

            let temp_aturan_pakai_option = data.aturan_pakai_option.split(';');
            console.log(temp_aturan_pakai_option);

            for (let i = 0; i < temp_aturan_pakai_option.length; i++) {
                ins += '<option value="' + temp_aturan_pakai_option[i] + '">' + temp_aturan_pakai_option[i] +
                    '</option>';
            }

            ins += '</select>' +
                '</div>';
        }
        return ins;
    }

    function render_field_edit_pagi_siang_sore(data) {
        var ins = '';
        if (data.pagi_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Pagi</label>' +
                '<input style="margin-left:34px" checked value="1" type="checkbox" id="edit_resep_pagi">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Pagi</label>' +
                '<input style="margin-left:34px" type="checkbox" id="edit_resep_pagi">';
        }
        if (data.siang_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Siang</label>' +
                '<input style="margin-left:25px;" checked value="1" type="checkbox" id="edit_resep_siang">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Siang</label>' +
                '<input style="margin-left:25px;" type="checkbox" id="edit_resep_siang">';
        }
        if (data.sore_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Sore</label>' +
                '<input style="margin-left:33px" checked value="1" type="checkbox" id="edit_resep_sore">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Sore</label>' +
                '<input style="margin-left:33px" type="checkbox" id="edit_resep_sore">';
        }
        if (data.malam_aktif == 1) {
            ins += '<div class="form-group">' +
                '<label>Malam</label>' +
                '<input class="ml-3" checked value="1" type="checkbox" id="edit_resep_malam">';
        } else {
            ins += '<div class="form-group">' +
                '<label>Malam</label>' +
                '<input class="ml-3" type="checkbox" id="edit_resep_malam">';
        }
        return ins;
    }

    function rupiah(param) {
        if (param == '' || param == null) {
            return '';
        }
        var temp = param.toString().replaceAll('.', ',');
        return temp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#form_e_resep').submit(function(e) {
        e.preventDefault();
        $('#detail_resep').val(JSON.stringify(detail_e_resep));
        $('#msg_e_resep').html('<div class="alert alert-info">' + loading(
            'Sedang menyimpan resep, harap tunggu...', 'sm') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/resep_store') }}",
            method: 'post',
            data: $('#form_e_resep').serialize(),
            success: function(response) {
                console.log(response);
                if (response.code == 200) {
                    $('#msg_e_resep').html('<div class="alert alert-success">' + response
                        .message + '</div>');
                    var ins = '';
                    if (response.data.locked == 0) {
                        ins += '<button class="btn btn-warning"' +
                            'onclick="open_modal_edit_resep(' + response.data.id +
                            ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>';
                    }
                    ins += '<button class="btn btn-info ml-1"' +
                        'onclick="preview_terapi(' + response.data.id + ')"><i class="fa fa-book"' +
                        'style="color:#fff;"></i></button>' +
                        '<button class="btn btn-info ml-1"' +
                        'onclick="lock_terapi(' + response.data.id + ')"><i class="fa fa-lock"' +
                        'style="color:#fff;"></i></button> No Resep Elektronik '+response.data.id;
                    var list_resep = '<table style="border-collapse: collapse; width:100%;" id="tabel_resep">';
                    for (let i = 0; i < response.data.detail.length; i++) {
                        list_resep +=   '<tr>'+
                                        '<td style="border:1px solid transparent;">R/</td>'+
                                        '<td style="border:1px solid transparent;">'+response.data.detail[i].nama_obat+'</td>'+
                                        '<td style="border:1px solid transparent;">'+response.data.detail[i].signa+'</td>'+
                                        '<td style="padding-left: 20px; border:1px solid transparent;">'+response.data.detail[i].jumlah+' '+response.data.detail[i].satuan+'</td>'+
                                        '</tr>';
                    }
                    list_resep += '</table> '+response.data.catatan_obat_racikan;
                    $('#box_btn_eresep').html(ins);
                    $('#box_eresep').html(list_resep);
                    $('#modal_e_resep').modal('hide');
                    return;
                } else {
                    $('#msg_e_resep').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                }
            }
        })
    })

    $('#form_edit_resep').submit(function(e) {
        window.event.preventDefault();
        $('#edit_detail_resep').val(JSON.stringify(detail_edit_resep));
        $('#msg_edit_resep').html('<div class="alert alert-info">' + loading(
            'Sedang menyimpan resep, harap tunggu...', 'sm') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/resep_update') }}",
            method: 'post',
            data: $('#form_edit_resep').serialize(),
            success: function(response) {
                console.log(response);
                if (response.code == 200) {
                    $('#msg_edit_resep').html('<div class="alert alert-success">' + response
                        .message + '</div>');
                        var list_resep = '<table style="border-collapse: collapse; width:100%;" id="tabel_resep">';
                    for (let i = 0; i < response.data.detail.length; i++) {
                        list_resep +=   '<tr>'+
                                        '<td style="border:1px solid transparent;">R/</td>'+
                                        '<td style="border:1px solid transparent;">'+response.data.detail[i].nama_obat+'</td>'+
                                        '<td style="border:1px solid transparent;">'+response.data.detail[i].signa+'</td>'+
                                        '<td style="padding-left: 20px; border:1px solid transparent;">'+response.data.detail[i].jumlah+' '+response.data.detail[i].satuan+'</td>'+
                                        '</tr>';
                    }
                    list_resep += '</table> '+response.data.catatan_obat_racikan;
                    $('#box_eresep').html(list_resep);
                    $('#modal_edit_resep').modal('hide');
                    return;
                } else {
                    $('#msg_edit_resep').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                }
            }
        })
    })

    function open_modal_dokter_e_resep(param) {
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
                            "'" + row.nama + "','" + data + "','" + row.no_ijin + "','" + param + "'" +
                            ')"><i class="fa fa-check"></i></button></div>';
                    }
                },
            ]
        });
        param == 'tambah' ? $('#modal_e_resep').modal('hide') : $('#modal_edit_resep').modal('hide');
        $('#modal_dokter_e_resep').modal('show');
    }
</script>
<script>
    let id_pesanan_lab = <?php echo $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->id_pesanan_lab : 0 ?>;

    function open_modal_lab() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: id_pesanan_lab,
            },
            success: function(response) {
                console.log(response);
                let temp = [];
                if(Object.keys(response).length !== 0){
                    if (response.status != '') {
                        alert('Tidak diperkenankan ubah pesanan laboratorium');
                        return;
                    }
                }
                if(Object.keys(response).length !== 0){
                    const periksa = JSON.parse(response.periksa);
                    console.log(periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push(`${key}`);
                        }
                        console.log(`${key} ${value}`);
                    });
                    console.log('-------------------');
                    $('#pesan_pemeriksaan').val(temp).change();
                    $('#ruangan_lab').val(response.ruangan);
                    $('#kelas').val(response.kelas);
                }
                $('#id_lab').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#modal_lab').modal('show');
            }
        })
    }

    function hapus_pesanan_lab(param){
        if (confirm('Yakin melanjutkan hapus pesanan laboratorium ?')) {
            $.ajax({
                url : "{{ url('ajax_request/hapus_pesanan_lab') }}",
                data : {
                    id : param
                },
                success : function(response){
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#list_pesanan').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_lab').val(0);
                    update_pesanan();
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
                console.log(response);
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
                    console.log(master_hasil);
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
                if(file[0] != ''){
                    $('#link_lampiran_lab').html('<a style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL') }}/'+file[0]+'" target="_blank">Download lampiran klik disini</a>');
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

    $('#form_laboratorium').submit(function(e) {
        e.preventDefault();
        $('#loading_pesanan_lab').html('<div class="alert alert-info">' + loading('Sedang menyimpan data...',
            'sm') + '</div>');
        $('[name=keluhan_klinis]').val(isian_dr.subjective);
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_store_by_id') }}",
            method: 'post',
            data: $('#form_laboratorium').serialize(),
            success: function(response) {
                if (!response.status) {
                    $('#loading_pesanan_lab').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                    return;
                }
                $('#modal_lab').modal('hide');
                let data = response.data;
                id_pesanan_lab = data.id;
                $('#id_lab').val(id_pesanan_lab);
                $('#loading_pesanan_lab').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                let pemeriksaan = <?php echo $pemeriksaan; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                ins += data.no_lab + ' - ';
                var temp = JSON.parse(data.periksa);
                for (let j = 0; j < pemeriksaan.length; j++) {
                    var temp_slug = pemeriksaan[j].slug;
                    if (temp[temp_slug] == 1) {
                        if (iterasi_pesanan < 1) {
                            ins += pemeriksaan[j].nama;
                        } else {
                            ins += ', ' + pemeriksaan[j].nama;
                        }
                        iterasi_pesanan++;
                    }
                }
                $('#box_button_pesanan_lab').html('');
                $('#list_pesanan').html(
                    '<button type="button" class="btn btn-warning" onclick="open_modal_lab()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_lab(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-danger ml-1" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_lab(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' +
                    ins);
                update_pesanan();
            }
        })
    });
</script>
<script>
    let id_pesanan_rad = <?php echo $dokumen->catatan_perkembangan_pasien_terintegrasi ? $dokumen->catatan_perkembangan_pasien_terintegrasi->id_pesanan_rad : 0 ?>;
    function open_modal_pesanan_radiologi() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: id_pesanan_rad,
            },
            success: function(response) {
                console.log(response);
                if(Object.keys(response).length !== 0){
                    if (response.status != '') {
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
                    console.log(temp);
                    console.log('-------------------');
                    $('#pesan_pemeriksaan_radiologi').val(temp).change();
                    $('#ruangan_rad').val(response.ruangan);
                }
                $('#id_rad').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#modal_pesanan_radiologi').modal('show');
            }
        })
    }

    function hapus_pesanan_rad(param){
        if (confirm('Yakin melanjutkan hapus pesanan radiologi ?')) {
            $.ajax({
                url : "{{ url('ajax_request/hapus_pesanan_rad') }}",
                data : {
                    id : param
                },
                success : function(response){
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#list_pesanan_radiologi').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_rad').val(0);
                    update_pesanan();
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

    function open_modal_hasil_radiologi(param) {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
                console.log(response);
                if (response.hasil != '') {
                    var ins = '';
                    let temp = JSON.parse(response.hasil);
                    let temp2 = sortObject(JSON.parse(response.periksa));
                    let hasil = Object.entries(temp);
                    let key_hasil = Object.keys(temp);
                    let periksa = Object.entries(temp2);
                    let key_periksa = Object.keys(temp2);
                    let pemeriksaan = <?php echo $pemeriksaan_radiologi ?>;
                    let no = 1;
                    console.log(periksa);
                    // console.log(pemeriksaan);
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
                                        '<td style="vertical-align:top; line-height:2;">' + (hasil[i][1] ? hasil[i][1].includes('img') ?  hasil[i][1].replace('\n', '<br>').replace('smis-upload', '{{ request()->getScheme().'://' .request()->getHost() . env('SMIS_URL').'/smis-upload' }}') : hasil[i][1].replace('\n', '<br>') : '') + '</td>' +
                                        '</tr>';
                                    no++;
                                    break;
                                }
                            }
                        }
                    }
                    let file = response.file != '' ? JSON.parse(response.file) : [''];
                    if(file[0] != ''){
                        $('#link_lampiran_radiologi').html('<a style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL') }}/'+file[0]+'" target="_blank">Download lampiran klik disini</a>');
                    }
                    $('#list_hasil_radiologi').html(ins);
                    $('#modal_hasil_radiologi').modal('show');
                }
            }
        })
    }

    $('#form_radiologi').submit(function(e) {
        e.preventDefault();
        $('#loading_pesanan_rad').html(loading('Sedang menyimpan data harap tunggu...', 'info'));
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_store_by_id') }}",
            method: "post",
            data: $('#form_radiologi').serialize(),
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    $('#loading_pesanan_rad').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                    return;
                }
                $('#loading_pesanan_rad').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                $('#modal_pesanan_radiologi').modal('hide');
                let data = response.data;
                id_pesanan_rad = data.id;
                let pemeriksaan = <?php echo $pemeriksaan_radiologi; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                ins += data.no_lab + ' - ';
                var temp = JSON.parse(data.periksa);
                for (let j = 0; j < pemeriksaan.length; j++) {
                    var temp_slug = 'rad_' + pemeriksaan[j].id;
                    if (temp[temp_slug] == 1) {
                        if (iterasi_pesanan < 1) {
                            ins += pemeriksaan[j].nama;
                        } else {
                            ins += ', ' + pemeriksaan[j].nama;
                        }
                        iterasi_pesanan++;
                    }
                }
                $('#box_button_pesanan_radiologi').html('');
                $('#list_pesanan_radiologi').html(
                    '<button type="button" class="btn btn-warning" onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_radiologi(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' + 
                    '<button type="button" class="btn btn-danger mr-2" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_rad(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' + 
                    ins);
                $('#id_rad').val(id_pesanan_rad);
                update_pesanan();
            }
        })
    })
</script>

<script>
    $('#tabel_kepada').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: '{{ url('ajax_request/employee') }}',
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
        $('#ppa_'+$('#index_yth').val()).val(nama);
        $('#id_ppa_'+$('#index_yth').val()).val(id);

        switch ($('#index_yth').val()) {
            case '1':
                isian_ns.id_ppa = id;
                isian_ns.ppa = nama;
                break;
            case '2':
                isian_dr.id_ppa = id;
                isian_dr.ppa = nama;
                break;
            case '3':
                isian_fp.id_ppa = id;
                isian_fp.ppa = nama;
                break;
            case '4':
                isian_apt.id_ppa = id;
                isian_apt.ppa = nama;
                break;
            default:
                break;
        }

        $('#modal_yth').modal('hide');
    }

    function open_modal_yth(param) {
        $('#index_yth').val(param);
        $('#modal_yth').modal('show');
    }
</script>

<script>
    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        $('#hide_id_ppa').val($("#id_ppa").val());
        $('#hide_ppa').val($("#ppa").val());
        $('#hide_subyektif').val($("#subyektif").val());
        $('#hide_instruksi_kesehatan').val($("#instruksi_kesehatan").val());

        return true;
    }

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }
</script>
</html>
