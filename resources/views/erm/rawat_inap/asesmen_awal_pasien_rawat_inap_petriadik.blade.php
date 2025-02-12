<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ASESMEN AWAL PASIEN RAWAT INAP (PEDIATRIK)</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            textarea {
                border: 1px solid transparent !important;
                height: auto;
                overflow: visible!important;
                page-break-inside: avoid !important;
                resize: none;
            }

            .hidden_on_print{
                display: none;
            }
        }

        #form_neonatus {
            border: 1px solid transparent;
        }

        .tabel_layout {
            width: 100%;
            border-collapse: collapse;
        }

        .tabel_layout tr {
            vertical-align: text-top;
        }

        .tabel_layout tr td {
            padding: 5px;
            padding-right: 15px;
        }

        #tabel_list_penggunaan_obat thead tr th {
            padding: 10px;
        }

        #tabel_list_obat thead tr th {
            padding: 10px;
        }

        #tabel_identitas_orang_tua tr td {
            border: 1px solid;
        }

        #tabel_list_obat tbody tr td {
            padding: 10px;
        }

        #box_ttd_dokter:hover{
            cursor: pointer;
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

        #resep_obat_racikan{
            height: 100% !important;
        }
    </style>
</head>

<body class="p-2">
    @include('erm.riwayat_laboratorium')
    @include('erm.riwayat_radiologi')
    <!--FORM LAB-->
    <div class="modal fade" id="modal_form_lab" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesanan Lab</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="form_laboratorium" method="post">
                    @csrf
                    <input type="hidden" name="keluhan_klinis" id="keluhan_klinis">
                    <input type="hidden" name="id_pesanan" id="id_pesanan_lab">
                    <input name="alamat" type="hidden" class="form-control"
                        value="{{ $layanan ? $layanan->alamat_pasien : '-' }}">
                    <input type="hidden" name="ibu" value="{{ $layanan->ibu }}" class="form-control">
                    <input type="hidden" name="jenis_pasien" value="{{ $layanan->carabayar }}"
                        class="form-control">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Reg</label>
                            <input type="text" class="form-control" name="noreg"
                                value="{{ $layanan->id }}" readonly>
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
                        </div>
                        <div class="form-group">
                            <label for="">BED</label>
                            <input type="text" readonly value="{{ $layanan->last_bed != "" ? $layanan->last_bed : "" }}" name="last_bed"
                                class="form-control">
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
                            <input type="text" id="dokter_lab" name="dokter" readonly
                                placeholder="Pilih dokter" value="{{ Auth::user()->realname }}"
                                class="form-control">
                            <input type="hidden" value="{{ Auth::user()->id }}" id="id_dokter_lab"
                                name="id_dokter">
                        </div>
                        <div class="form-group">
                            <label for="">Diagnosa</label>
                            <input type="text" readonly id="diagnosa_lab" name="diagnosa" value="{{ $diagnosa ? $diagnosa->kode_icd != '' ? $diagnosa->nama_icd : $diagnosa->diagnosa : '' }}" class="form-control">
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
    <!--END FORM LAB-->

    <!--FORM RAD-->
    <div class="modal fade" id="modal_form_rad" tabindex="-1" role="dialog"
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
                    <input type="hidden" name="id_pesanan" id="id_pesanan_rad">
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
                            <select name="pesan_pemeriksaan[]" multiple="multiple" id="pesan_pemeriksaan_rad"
                                style="width: 100%" class="form-control">
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
    <!-- END FORM RAD -->

    <!-- FORM RESEP-->
    <div class="modal fade" style="overflow-y: scroll" id="modal_resep" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulir E-Resep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_resep">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_resep" id="id_resep"
                        value="{{ $resep ? $resep->id : '0' }}">
                    <input type="hidden" name="detail" id="detail_resep">
                    <input type="hidden" name="ruangan" id="ruangan">
                    <div class="modal-body">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Waktu</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" name="waktu"
                                        id="resep_waktu" type="date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">NRM</label>
                                    <input class="form-control" name="nrm" id="resep_nrm" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input class="form-control" name="usia" id="resep_usia" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Asuransi</label>
                                    <input class="form-control" name="asuransi" value="{{ $layanan->asuransi }}" id="resep_asuransi"
                                        type="text" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dokter"
                                            value="{{ Auth::user()->realname }}" id="resep_dokter" type="text"
                                            readonly>
                                        <input class="form-control" name="id_dokter"
                                            value="{{ Auth::user()->id }}" id="resep_id_dokter" type="hidden">
                                        <div class="input-grou-append">
                                            <button class="btn btn-dark" type="button"
                                                onclick="open_modal_dokter_resep()"><i
                                                    class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" name="nama" id="resep_nama" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Badan</label>
                                    <input class="form-control" name="berat_badan"
                                        value="{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '' }}"
                                        id="resep_berat_badan" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Depo Tujuan</label>
                                    <select name="depo_tujuan" id="resep_depo_tujuan" class="form-control">
                                        <option value="depo_farmasi">DEPO FARMASI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">SIP</label>
                                    <input class="form-control" name="sip" id="resep_sip" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="alamat" id="resep_alamat" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Pasien</label>
                                    <input class="form-control" name="jenis_pasien" id="resep_jenis_pasien"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Obat Racikan</label>
                                    <textarea rows="5" name="catatan_obat_racikan" id="resep_obat_racikan" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">No. Reg</label>
                                    <input class="form-control" id="resep_noreg" name="noreg"
                                        value="{{ $dokumen->noreg }}" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Telp</label>
                                    <input class="form-control" name="telp" id="resep_telp" value="{{ $pasien->telpon }}" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <input class="form-control" name="perusahaan" value="{{ $layanan->nama_perusahaan }}" id="resep_perusahaan"
                                        type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12" style="border: 1px dashed"></div>
                        </div>
                        <div class="row pt-3" style="width: 100%; margin-left: 0;">
                            <input type="hidden" id="resep_id_obat" readonly class="form-control">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" id="resep_kode_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Obat</label>
                                    <div class="input-group">
                                        <input type="text" id="resep_nama_obat" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button"
                                                onclick="open_modal_list_obat('')">
                                                <i class="fa fa-list"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis</label>
                                    <input type="text" id="resep_jenis_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Sisa</label>
                                    <input type="text" id="resep_sisa_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <input type="text" id="resep_satuan_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" id="resep_jumlah_obat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga (Rp.)</label>
                                    <input type="text" id="resep_harga_obat" readonly class="form-control">
                                    <input type="hidden" id="resep_markup" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Signa</label>
                                    <input class="form-control" name="signa" id="resep_signa" type="text">
                                </div>
                                <div id="additional_form_resep"></div>
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;"
                                        onclick="tambah_detail_resep()">Tambahkan
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-9 pr-0" style="padding-top: 30px; font-size:12px;">
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
                                        <tbody id="list_detail_resep"></tbody>
                                        <tfoot id="footer_list_detail_resep"></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row" style="width: 100%; margin-left: 0;">
                            <div class="col-lg-12 pl-0 pr-0" id="msg_resep"></div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END FORM RESEP -->

    <!-- MODAL LIST OBAT -->
    <div class="modal fade" id="modal_list_obat" style="overflow-y: scroll;" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                                <input type="text" id="search_obat" placeholder="Cari.."
                                    class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="submit"><i
                                            class="fa fa-search"></i></button>
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
    <!-- END MODAL LIST OBAT -->

    <!-- MODAL DOKTER RESEP -->
    <div class="modal fade" id="modal_dokter_resep" tabindex="-1" style="overflow-y: scroll;" role="dialog"
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
                        <table class="table" id="tabel_dokter_resep" style="width: 100%;">
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
    <!-- END MODAL DOKTER RESEP -->

    <!-- MODAL PREVIEW RESEP -->
    <div class="modal fade" id="modal_preview" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p style="text-align:center"><b>RUMAH SAKIT HARAPAN MULIA</b><br>Jl. Raya Cibarusah
                                    No. 5 Kebon Kopi, Cibarusah Jaya
                                    <br><b>Kabupaten Bekasi Jawa Barat</b>
                                </p>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 20%">Dokter</td>
                                        <td style="width: 3%"> :</td>
                                        <td style="width: 57%">
                                            {{ $resep ? $resep->nama_dokter : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>SIP</td>
                                        <td> :</td>
                                        <td>{{ $resep ? $resep->sip_dokter : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unit Pelayanan</td>
                                        <td> :</td>
                                        <td style="text-transform: uppercase">
                                            {{ $resep ? str_replace('_', ' ', $resep->ruangan) : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Catatan Obat Racikan</td>
                                        <td> :</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            {{ $resep ? $resep->catatan_obat_racikan : '' }}
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
                                            Jombang,
                                            {{ $layanan ? date('d-m-Y', strtotime($layanan->tanggal)) : '' }}
                                        </td>
                                    </tr>
                                    @if ($resep)
                                        @foreach ($resep->detail as $det)
                                            <tr>
                                                <td colspan="4">{{ 'R/' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20px;"></td>
                                                <td>{{ $det->nama_obat }}</td>
                                                <td>{{ $det->signa }}</td>
                                                <td style="padding-left: 20px;">
                                                    {{ $det->jumlah . ' ' . $det->satuan }}</td>
                                            </tr>
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
                                        <td>{{ $layanan->alamat_pasien }}</td>
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
    <!-- END MODAL PREVIEW RESEP -->

    <!-- MODAL PENGGUNAAN OBAT -->
    <div class="modal fade" id="modal_form_penggunaan_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Penggunaan Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_penggunaan_obat">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Obat</label>
                        <input type="text" class="form-control" id="nama_obat">
                    </div>
                    <div class="form-group">
                        <label for="">Dosis</label>
                        <input type="text" class="form-control" id="dosis">
                    </div>
                    <div class="form-group">
                        <label for="">Cara Pemberian</label>
                        <input type="text" class="form-control" id="cara_pemberian">
                    </div>
                    <div class="form-group">
                        <label for="">Frekuensi</label>
                        <input type="text" class="form-control" id="frekuensi">
                    </div>
                    <div class="form-group">
                        <label for="">Waktu & Tgl Terakhir diberikan</label>
                        <input type="datetime-local" class="form-control" id="waktu">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- END MODAL PENGGUNAAN OBAT -->

    <!-- MODAL TTD DOKTER -->
    <div class="modal fade" id="modal_ttd_dokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_ttd_dokter">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" id="pass" class="form-control" placeholder="Masukkan password" required>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- END MODAL TTD DOKTER -->

    <!-- MODAL DIAGNOSA -->
    <div class="modal fade" id="modal_diagnosa" style="overflow-y: scroll;" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Diagnosa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_diagnosa">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="POST" />
                    <input type="hidden" name="id_diagnosa" value="{{ $diagnosa ? $diagnosa->id : 0 }}" />
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
                            <input type="text" name="ruangan" value="{{ ucwords(str_replace('_', ' ', $layanan->last_ruangan)) }}" readonly
                                class="form-control">
                        </div>
                        <hr>
                        <p style="font-weight: bold; font-size:14px;">DATA DOKTER / PSIKOLOG</p>
                        <div class="form-group">
                            <label for="">Dokter / Psikolog</label>
                            <input type="text" name="dokter" value="{{ Auth::user()->realname }}"
                                id="dokter" readonly class="form-control">
                        </div>
                        <input type="hidden" name="nip_dokter" value="{{ $dokter ? $dokter->nip : '' }}"
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
                                <label for="">Diagnosa Pembanding</label>
                                <input type="text" class="form-control" name="diagnosa_pembanding"
                                    id="diagnosa_pembanding">
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
                        <div id="box_msg"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_simpan_diagnosa" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL DIAGNOSA -->

    <!-- MODAL HASIL LABORATORIUM -->
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
    <!-- END MODAL HASIL LABORATORIUM -->
    
    <!-- MODAL HASIL RADIOLOGI -->
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
                    <div id="link_lampiran_rad" class="pb-2"></div>
                    <table id="list_hasil_radiologi" style="border-collapse: collapse; width:100%;">

                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL HASIL RADIOLOGI -->

    <form id="form_petriadik" class="container-fluid">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="list_riwayat_imunisasi">
        <input type="hidden" name="pass">
        <input type="hidden" name="list_penggunaan_obat">
        <input type="hidden" name="id_pesanan_lab" id="id_pesanan_lab_neo"
            value="{{ $petriadik ? $petriadik->id_pesanan_lab : '0' }}">
        <input type="hidden" name="id_pesanan_rad" id="id_pesanan_rad_neo"
            value="{{ $petriadik ? $petriadik->id_pesanan_rad : '0' }}">
        <input type="hidden" name="id_e_resep" id="id_resep_neo" value="{{ $petriadik ? $petriadik->id_e_resep : '0' }}">
        <input type="hidden" name="id_diagnosa" id="id_diagnosa_neo"
            value="{{ $petriadik ? $petriadik->id_diagnosa : '0' }}">
        @csrf
        <div class="row pt-2">
            <div class="col-md-6">
                <img src="{{ asset('filelogo/logo_rshm.jpeg') }}" alt="" style="width: 50%">
                <p style="font-weight: bold">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya,<br>Kec.
                    Cibarusah, Kab. Bekasi - Jawa
                    Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
                <a class="btn btn-primary" id="btn_riwayat_lab">Riwayat Laboratorium</a>
                <a class="btn btn-info" id="btn_riwayat_rad">Riwayat Radiologi</a>
            </div>
            <div class="col-md-6" style="display: flex; align-items: center">
                <div style="border: 2px solid; padding:30px; border-radius:10px; width:100%; font-weight: bold;">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? $pasien->nama : '' }}</td>
                        </tr>
                        <tr>
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? $pasien->id : '' }}</td>
                        </tr>
                        <tr>
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '00-00-0000' }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? ($pasien->kelamin == 1 ? 'Perempuan' : 'Laki-Laki') : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-12 text-center"
                style="background-color: #111; color:#fff; font-weight: bold; border:1px solid #111;">
                ASESMEN AWAL PASIEN RAWAT INAP (PEDIATRIK)
            </div>
            <div class="col-md-12" style="border: 1px solid;">
                * Beri Tanda ✓ Pada Tanda <input type="checkbox" class="ml-1" onclick="return false;">
            </div>
            <div class="col-md-6 pl-0 pr-0">
                <table style="width: 100%; border-collapse: collapse; border-right:1px solid transparent;">
                    <tr style="border: 1px solid;">
                        <td style="width: 27%" class="pl-2">Tiba Diruangan</td>
                        <td class="pl-2 pr-2" style="width: 3%"> : </td>
                        <td>
                            <input type="text" class="datepicker" value="{{ $petriadik ? date('Y-m-d', strtotime($petriadik->tanggal_tiba)) : '' }}" name="tiba_tanggal" style="border-radius:5px; border:1px solid lightgrey;">, Jam
                            <input type="text" class="timepicker" value="{{ $petriadik ? date('H:i', strtotime($petriadik->tanggal_tiba)) : '' }}" name="tiba_jam" style="border-radius:5px; border:1px solid lightgrey; width:20%"> WIB
                        </td>
                    </tr>
                    <tr style="border: 1px solid; border-bottom:1px solid transparent;">
                        <td class="pl-2">Diperoleh Dari</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>
                            <input type="text" name="diperoleh_dari" value="{{ $petriadik ? $petriadik->diperoleh_dari : '' }}" style="width:100%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 pl-0 pr-0">
                <table style="width: 100%; border-collapse: collapse; border-left:1px solid transparent;">
                    <tr style="border: 1px solid; border-left:1px solid transparent;">
                        <td style="width: 40%" class="pl-2" colspan="3">Pengkajian : 
                            <input type="text" class="datepicker"  value="{{ $petriadik ? date('Y-m-d', strtotime($petriadik->tanggal_pengkajian)) : '' }}" name="pengkajian_tanggal" class="ml-1" style="border-radius:5px; border:1px solid lightgrey;">, Jam
                            <input type="text" class="timepicker"  value="{{ $petriadik ? date('H:i', strtotime($petriadik->tanggal_pengkajian)) : '' }}" name="pengkajian_jam" style="border-radius:5px; border:1px solid lightgrey; width:20%"> WIB
                        </td>
                    </tr>
                    <tr
                        style="border: 1px solid; border-left:1px solid transparent; border-bottom:1px solid transparent;">
                        <td class="pl-2" style="width: 10%;">Hubungan Dengan Pasien</td>
                        <td class="pl-2 pr-2" style="width: 1.5%;"> : </td>
                        <td>
                            <input type="text" name="hubungan_dengan_pasien" value="{{ $petriadik ? $petriadik->hubungan_dengan_pasien : '' }}" style="width:100%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pl-0 pr-0">
                <table style="width: 100%; border-collapse: collapse; border-right:1px solid transparent;">
                    <tr style="border: 1px solid;">
                        <td style="width: 13.5%" class="pl-2">Nama Perawat</td>
                        <td class="pl-2 pr-2" style="width: 1.5%"> : </td>
                        <td>
                            <input type="text" name="nama_perawat" value="{{ $petriadik ? $petriadik->nama_perawat : '' }}" style="width:100%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center" style="border:1px solid #111; border-top:1px solid transparent;">
                PENGKAJIAN MEDIS
            </div>
            @php
            $anamnesis = $petriadik ? json_decode($petriadik->anamnesis) : null;
            @endphp
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <input type="hidden" name="anamnesis">
                <h5>I. Anamnesis</h5>
                <table class="tabel_layout" style="margin-left: 20px;">
                    <tr>
                        <td style="width: 3%">1.</td>
                        <td style="width: 25%">Keluhan Utama</td>
                        <td style="width: 3%"> : </td>
                        <td colspan="2">
                            <textarea id="keluhan_utama" class="form-control"  cols="30" rows="1">{{ $anamnesis ? $anamnesis->keluhan_utama : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">2.</td>
                        <td style="width: 25%">Riwayat Penyakit Sekarang</td>
                        <td style="width: 3%"> : </td>
                        <td colspan="2">
                            <textarea id="riwayat_penyakit_sekarang" class="form-control"  cols="30" rows="1">{{ $anamnesis ? $anamnesis->riwayat_penyakit_sekarang : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">3.</td>
                        <td style="width: 25%">Riwayat Penyakit Dahulu</td>
                        <td style="width: 3%"> : </td>
                        <td colspan="2">
                            <textarea id="riwayat_penyakit_dahulu" class="form-control"  cols="30" rows="1">{{ $anamnesis ? $anamnesis->riwayat_penyakit_dahulu : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">4.</td>
                        <td style="width: 25%">Riwayat Penyakit Keluarga</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" name="riwayat_penyakit_keluarga" {{ $anamnesis ? $anamnesis->riwayat_penyakit_keluarga->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} value="Tidak Ada" >
                            Tidak Ada
                        </td>
                        <td>
                            <input type="radio" name="riwayat_penyakit_keluarga" {{ $anamnesis ? $anamnesis->riwayat_penyakit_keluarga->value == 'Ada' ? 'checked' : '' : '' }} value="Ada" >
                            Ada, Sebutkan <input type="text" value="{{ $anamnesis ? $anamnesis->riwayat_penyakit_keluarga->desc : '' }}" id="desc_riwayat_penyakit_keluarga" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">5.</td>
                        <td style="width: 25%">Riwayat Penggunaan Obat</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" name="riwayat_penggunaan_obat" {{ $anamnesis ? $anamnesis->riwayat_penggunaan_obat->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} value="Tidak Ada" >
                            Tidak Ada
                        </td>
                        <td>
                            <input type="radio" name="riwayat_penggunaan_obat" {{ $anamnesis ? $anamnesis->riwayat_penggunaan_obat->value == 'Ada' ? 'checked' : '' : '' }} value="Ada" > Ada,
                            Sebutkan <input type="text" value="{{ $anamnesis ? $anamnesis->riwayat_penggunaan_obat->desc : '' }}" id="desc_riwayat_penggunaan_obat" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <table class="tabel_layout" id="tabel_list_penggunaan_obat" border="1">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Obat</th>
                                        <th>Dosis</th>
                                        <th>Cara Pemberian</th>
                                        <th>Frekuensi</th>
                                        <th>Waktu & Tgl Terakhir diberikan</th>
                                        <th class="hidden_on_print">
                                            <button onclick="open_modal_form_penggunaan_obat()" class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="list_penggunaan_obat">
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">6.</td>
                        <td style="width: 25%">Riwayat Alergi</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" name="riwayat_alergi" {{ $anamnesis ? $anamnesis->riwayat_alergi->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} value="Tidak Ada" > Tidak Ada
                        </td>
                        <td>
                            <input type="radio" name="riwayat_alergi" {{ $anamnesis ? $anamnesis->riwayat_alergi->value == 'Ada' ? 'checked' : '' : '' }} value="Ada" > Ada, Sebutkan
                            <input type="text" id="desc_riwayat_alergi" value="{{ $anamnesis ? $anamnesis->riwayat_alergi->desc : '' }}" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            @php
            $pemeriksaan_fisik = $petriadik ? json_decode($petriadik->pemeriksaan_fisik) : null;
            @endphp
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <input type="hidden" name="pemeriksaan_fisik">
                <h5>II. Pemeriksaan Fisik</h5>
                <table class="tabel_layout" style="margin-left: 20px;">
                    <tr>
                        <td style="width: 3%">1.</td>
                        <td>Keadaan Umum</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->keadaan_umum == 'Tampak Tidak Sakit' ? 'checked' : '' : '' }} name="keadaan_umum" value="Tampak Tidak Sakit" >
                            Tampak Tidak Sakit
                        </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->keadaan_umum == 'Sakit Ringan' ? 'checked' : '' : '' }} name="keadaan_umum" value="Sakit Ringan" > Sakit
                            Ringan
                        </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->keadaan_umum == 'Sakit Sedang' ? 'checked' : '' : '' }} name="keadaan_umum" value="Sakit Sedang" > Sakit
                            Sedang
                        </td>
                        <td colspan="2">
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->keadaan_umum == 'Sakit Berat' ? 'checked' : '' : '' }} name="keadaan_umum" value="Sakit Berat" > Sakit
                            Berat
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">2.</td>
                        <td>Kesadaran</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->kesadaran == 'Compos Mentis' ? 'checked' : '' : 'checked' }} name="kesadaran" value="Compos Mentis" > Compos
                            Mentis
                        </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->kesadaran == 'Apatis' ? 'checked' : '' : '' }} name="kesadaran" value="Apatis" > Apatis
                        </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->kesadaran == 'Somnolen' ? 'checked' : '' : '' }} name="kesadaran" value="Somnolen" > Somnolen
                        </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->kesadaran == 'Sopor' ? 'checked' : '' : '' }} name="kesadaran" value="Sopor" > Sopor
                        </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->kesadaran == 'Sopor Coma' ? 'checked' : '' : '' }} name="kesadaran" value="Sopor Coma" > Sopor Coma
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="5">
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->kesadaran == 'Coma' ? 'checked' : '' : '' }} name="kesadaran" value="Coma"> Coma
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">3.</td>
                        <td>GCS</td>
                        <td style="width: 3%"> : </td>
                        <td colspan="5">
                            E : <input type="text" id="gcs_e" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->gcs->e : '' }}" style="width: 20%; border-radius:5px; border:1px solid lightgrey; margin-right: 20px;">
                            M : <input type="text" id="gcs_m" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->gcs->m : '' }}" style="width: 20%; border-radius:5px; border:1px solid lightgrey; margin-right: 20px;">
                            V : <input type="text" id="gcs_v" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->gcs->v : '' }}" style="width: 20%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">4.</td>
                        <td>Tanda Vital</td>
                        <td style="width: 3%"> : </td>
                        <td colspan="5">
                            TD : <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->tanda_vital->td : '' }}" id="td" name="td" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> mmHg
                            <span style="margin-left: 15px">&nbsp;</span>
                            Suhu : <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->tanda_vital->suhu : '' }}" id="suhu" name="suhu" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> C
                            <span style="margin-left: 15px">&nbsp;</span>
                            Nadi : <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->tanda_vital->nadi : '' }}" id="nadi" name="nadi" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> x/m
                            <span style="margin-left: 15px">&nbsp;</span>
                            RR : <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->tanda_vital->rr : '' }}" id="rr" name="rr" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> x/m
                        </td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Imunisasi</td>
                        <td> : </td>
                        <td colspan="5">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[0]->value == '1' ? 'checked' : '' : '' }} value="bcg" id="imunisasi_bcg"> BCG <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[0]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_bcg">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[1]->value == '1' ? 'checked' : '' : '' }} value="hepatitis_b" id="imunisasi_hepatitis_b"> Hepatitis B <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[1]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_hepatitis_b">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[2]->value == '1' ? 'checked' : '' : '' }} value="dpt" id="imunisasi_dpt"> DPT <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[2]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_dpt">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[3]->value == '1' ? 'checked' : '' : '' }} value="polio" id="imunisasi_polio"> Polio <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[3]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_polio">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[4]->value == '1' ? 'checked' : '' : '' }} value="campak" id="imunisasi_campak"> Campak <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[4]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_campak">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[5]->value == '1' ? 'checked' : '' : '' }} value="tifoid" id="imunisasi_tifoid"> Tifoid <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[5]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_tifoid">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[6]->value == '1' ? 'checked' : '' : '' }} value="hib" id="imunisasi_hib"> Hib <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[6]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_hib">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[7]->value == '1' ? 'checked' : '' : '' }} value="influenza" id="imunisasi_influenza"> Influenza <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[7]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_influenza">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[8]->value == '1' ? 'checked' : '' : '' }} value="hepatitis_a" id="imunisasi_hepatitis_a"> Hepatitis A <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[8]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_hepatitis_a">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[9]->value == '1' ? 'checked' : '' : '' }} value="rotavirus" id="imunisasi_rotavirus"> Rotavirus <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[9]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_rotavirus">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[10]->value == '1' ? 'checked' : '' : '' }} value="mmr" id="imunisasi_mmr"> MMR <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[10]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_mmr">
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[11]->value == '1' ? 'checked' : '' : '' }} value="varicella" id="imunisasi_varicella"> Varicella <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->imunisasi[11]->desc : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="desc_imunisasi_varicella">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">6.</td>
                        <td colspan="2">Riwayat Prenatal</td>
                        <td colspan="5">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%"></td>
                        <td colspan="7">
                            <table class="tabel_layout">
                                <tr>
                                    <td style="width: 17%">Periksa di</td>
                                    <td style="width: 3%"> : </td>
                                    <td style="width: 15%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->periksa_di->value == 'Bidan' ? 'checked' : '' : '' }} name="periksa_di" value="Bidan"> Bidan
                                    </td>
                                    <td style="width: 15%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->periksa_di->value == 'Puskesmas' ? 'checked' : '' : '' }} name="periksa_di"  value="Puskesmas">
                                        Puskesmas
                                    </td>
                                    <td style="width: 15%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->periksa_di->value == 'RS' ? 'checked' : '' : '' }} name="periksa_di"  value="RS"> RS
                                    </td>
                                    <td style="width: 35%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->periksa_di->value == 'Lain' ? 'checked' : '' : '' }} name="periksa_di" value="Lain">
                                        <input type="text" id="periksa_di_lain" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->periksa_di->lain : '' }}" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 17%" colspan="6">Penyakit Kehamilan <span class="pl-2 pr-2">
                                            : </span> <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->penyakit_kehamilan->value == 'tidak' ? 'checked' : '' : '' }} name="penyakit_kehamilan" value="tidak"> Tidak
                                        <span style="margin-left:30px;">&nbsp;</span>
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->penyakit_kehamilan->value == 'ya' ? 'checked' : '' : '' }} name="penyakit_kehamilan" value="ya"> Ya, 
                                        <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->penyakit_kehamilan->desc : '' }}" id="desc_penyakit_kehamilan" style="width: 40%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 17%" colspan="6">Obat-obatan yang dikonsumsi 
                                        <span class="pl-2 pr-2"> : </span> 
                                        <input type="radio" name="obat_obatan_dikonsumsi" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->obat_obatan_dikonsumsi->value == 'tidak' ? 'checked' : '' : '' }} value="tidak"> Tidak
                                        <span style="margin-left:30px;">&nbsp;</span>
                                        <input type="radio" name="obat_obatan_dikonsumsi" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->obat_obatan_dikonsumsi->value == 'ya' ? 'checked' : '' : '' }} value="ya"> Ya, 
                                        <input type="text" id="desc_obat_obatan_dikonsumsi" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->obat_obatan_dikonsumsi->desc : '' }}" style="width: 40%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 17%">Lahir di</td>
                                    <td style="width: 3%"> : </td>
                                    <td style="width: 20%;" colspan="4">
                                        <input type="text" id="lahir_di" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->lahir_di : '' }}" style="width: 40%; border-radius:5px; border:1px solid lightgrey;"> ,
                                        Ditolong : <input type="text" id="ditolong" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_prenatal->ditolong : '' }}" style="width: 40%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">7.</td>
                        <td colspan="2">Riwayat Kelahiran</td>
                        <td colspan="5">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7">Berapa bulan dalam kandungan : <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_kelahiran->berapa_bulan : '' }}" id="berapa_bulan" style="width:50%;border-radius:5px; border:1px solid lightgrey;"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7">
                            Jenis Partu <span class="pl-3 pr-3">:</span>
                            <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_kelahiran->jenis_partu->value == 'normal' ? 'checked' : '' : '' }} value="normal" name="jenis_partu"> Normal 
                            <input class="ml-3" type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_kelahiran->jenis_partu->value == 'sc' ? 'checked' : '' : '' }} value="sc" name="jenis_partu"> SC
                            <input class="ml-3" type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_kelahiran->jenis_partu->value == 'lain' ? 'checked' : '' : '' }} value="lain" name="jenis_partu"> 
                            <input type="text" id="jenis_partu_lain" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_kelahiran->jenis_partu->lain : '' }}" style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7">
                            Berat Badan Lahir : <input type="number" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_kelahiran->berat_badan_lahir : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="berat_badan_lahir"> Kg <span class="ml-5"></span>
                            Panjang Badan Lahir : <input type="number" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_kelahiran->panjang_badan_lahir : '' }}" style="border-radius:5px; border:1px solid lightgrey;" id="panjang_badan_lahir">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">8.</td>
                        <td colspan="2">Riwayat Postnatal</td>
                        <td colspan="5">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 17%">Periksa di</td>
                                    <td style="width: 3%"> : </td>
                                    <td style="width: 15%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->periksa_di->value == 'Bidan' ? 'checked' : '' : '' }} name="postnatal_periksa_di" value="Bidan"> Bidan
                                    </td>
                                    <td style="width: 15%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->periksa_di->value == 'Puskesmas' ? 'checked' : '' : '' }} name="postnatal_periksa_di"  value="Puskesmas">
                                        Puskesmas
                                    </td>
                                    <td style="width: 15%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->periksa_di->value == 'RS' ? 'checked' : '' : '' }} name="postnatal_periksa_di"  value="RS"> RS
                                    </td>
                                    <td style="width: 35%;">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->periksa_di->value == 'Lain' ? 'checked' : '' : '' }} name="postnatal_periksa_di" value="Lain">
                                        <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->periksa_di->lain : '' }}" id="postnatal_periksa_di_lain" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keadaan Anak</td>
                                    <td> : </td>
                                    <td>
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->keadaan_anak->value == 'normal' ? 'checked' : '' : '' }} name="keadaan_anak" value="normal"> Normal
                                    </td>
                                    <td>
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->keadaan_anak->value == 'kelainan' ? 'checked' : '' : '' }} name="keadaan_anak" value="kelainan"> Kelainan
                                    </td>
                                    <td colspan="2">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->keadaan_anak->value == 'lain' ? 'checked' : '' : '' }} name="keadaan_anak" value="lain"> 
                                        <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->keadaan_anak->lain : '' }}" style="width: 70%; border-radius:5px; border:1px solid lightgrey;" id="keadaan_anak_lain">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Riwayat Penggunaan Obat</td>
                                    <td> : </td>
                                    <td>
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->riwayat_penggunaan_obat->value == 'tidak' ? 'checked' : '' : '' }} name="riwayat_penggunaan_obat_p" value="tidak"> Tidak
                                    </td>
                                    <td colspan="3">
                                        <input type="radio" {{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->riwayat_penggunaan_obat->value == 'ya' ? 'checked' : '' : '' }} name="riwayat_penggunaan_obat_p" value="ya"> Ya,
                                        <input type="text" value="{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->riwayat_postnatal->riwayat_penggunaan_obat->desc : '' }}" id="desc_riwayat_penggunaan_obat_p" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">9.</td>
                        <td>Pemeriksaan</td>
                        <td style="width: 3%"> : </td>
                        <td colspan="5">
                            Status Generalis dan Status Lokalis (Inspeksi, Palpasi, Perkusi, Auskultasi)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <textarea id="status_generalis"  cols="30" class="form-control" rows="1">{{ $pemeriksaan_fisik ? $pemeriksaan_fisik->pemeriksaan : '' }}</textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5>III. Pemeriksaan Penunjang</h5>
                <div>
                    <span style="font-weight: bold; font-size: 18px;">Laboratorium</span>
                    <div id="box_button_lab">
                        @if ($pesanan_lab)
                            @if($pesanan_lab->status == 'Pesanan ERM')
                            <button class="btn btn-warning hidden_on_print" style="color: #fff;" type="button"
                                onclick="open_form_lab()"><i class="fa fa-pencil"></i></button>
                            @endif
                            <button class="btn btn-info hidden_on_print" type="button" onclick="open_hasil_lab('{{ $pesanan_lab->id }}')"><i
                                    class="fa fa-book"></i></button>
                            @if($pesanan_lab->status == 'Pesanan ERM')
                                <button class="btn btn-danger hidden-on-print" type="button" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_lab('{{ $pesanan_lab->id }}')"><i class="fa fa-trash" style="color:#fff;"></i></button>
                            @endif
                            @php
                                $iterasi_pesanan_lab = 0;
                                $pesan = '';
                            @endphp
                            <?php $yang_dipesan = json_decode($pesanan_lab->periksa); ?>
                            @foreach ($pemeriksaan as $pem)
                                @php
                                    $temp_slug = $pem->slug;
                                @endphp
                                @if ($yang_dipesan->$temp_slug == 1)
                                    @if ($iterasi_pesanan_lab > 0)
                                        @php
                                            $pesan .= ', ' . $pem->nama;
                                        @endphp
                                    @else
                                        @php
                                            $pesan .= $pem->nama;
                                        @endphp
                                    @endif
                                    @php
                                        $iterasi_pesanan_lab++;
                                    @endphp
                                @endif
                            @endforeach
                            {{ $pesanan_lab->no_lab }} - {{ $pesan }}
                        @else
                            <button class="btn btn-dark hidden_on_print" type="button" onclick="open_form_lab()"><i
                                    class="fa fa-plus"></i></button>
                        @endif
                    </div>
                </div>
                <div class="pt-3">
                    <span style="font-weight: bold; font-size: 18px;">Radiologi</span>
                    <div id="box_button_rad">
                        @if ($pesanan_rad)
                            @if($pesanan_rad->status == 'Pesanan ERM')
                            <button type="button" class="btn btn-warning hidden_on_print" onclick="open_form_rad()"><i
                                    class="fa fa-pencil" style="color:#fff;"></i>
                            </button>
                            @endif
                            <button type="button" class="btn btn-info hidden_on_print" data-toggle="tooltip" title="Hasil"
                                onclick="open_hasil_rad('{{ $pesanan_rad->id }}')"><i class="fa fa-book"
                                    style="color:#fff;"></i></button>
                            @if($pesanan_rad->status == 'Pesanan ERM')
                                <button class="btn btn-danger hidden-on-print" type="button" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_rad('{{ $pesanan_rad->id }}')"><i class="fa fa-trash" style="color:#fff;"></i></button>
                            @endif
                            @php
                                $iterasi_pesanan_radiologi = 0;
                                $pesan_radiologi = '';
                            @endphp
                            <?php $yang_dipesan = json_decode($pesanan_rad->periksa); ?>
                            @foreach ($pemeriksaan_radiologi as $pemrad)
                                @php
                                    $temp_slug = 'rad_' . $pemrad->id;
                                @endphp
                                @if ($yang_dipesan->$temp_slug == 1)
                                    @if ($iterasi_pesanan_radiologi > 0)
                                        @php
                                            $pesan_radiologi .= ', ' . $pemrad->nama;
                                        @endphp
                                    @else
                                        @php
                                            $pesan_radiologi .= $pemrad->nama;
                                        @endphp
                                    @endif
                                    @php
                                        $iterasi_pesanan_radiologi++;
                                    @endphp
                                @endif
                            @endforeach
                            {{ $pesanan_rad->no_lab }} - {{ $pesan_radiologi }}
                        @else
                            <button class="btn btn-dark hidden_on_print" type="button" onclick="open_form_rad()"><i
                                    class="fa fa-plus"></i></button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5>IV. Diagnosa Kerja : </h5>
                <table>
                    <tr>
                        <td style="vertical-align: top" id="box_btn_diagnosa">
                            @if($diagnosa)
                                <button class="btn btn-warning hidden_on_print mr-1" style="color:#fff;" type="button" onclick="open_form_diagnosa()"><i class="fa fa-pencil"></i></button>
                            @else
                                <button class="btn btn-dark hidden_on_print" type="button" onclick="open_form_diagnosa()"><i class="fa fa-plus"></i></button>
                            @endif
                        </td>
                        <td style="vertical-align: top" id="box_list_diagnosa">
                            @if(!is_null($diagnosa))
                                {{ $diagnosa->kode_icd != '' ? $diagnosa->kode_icd.' - '.$diagnosa->nama_icd : $diagnosa->diagnosa }}
                                <br>
                                <?php
                                if ($diagnosa != null) {
                                    $temp = '';
                                    if ($diagnosa->diagnosa_sekunder1 != null) {
                                        $temp .= ($kode_sekunder1 ? $kode_sekunder1->icd : '') . ' - ' . $diagnosa->diagnosa_sekunder1;
                                    }
                                    if ($diagnosa->diagnosa_sekunder2 != null) {
                                        $temp .= '<br>' . ($kode_sekunder2 ? $kode_sekunder2->icd : '') . ' - ' . $diagnosa->diagnosa_sekunder2;
                                    }
                                    if ($diagnosa->diagnosa_sekunder3 != null) {
                                        $temp .= '<br>' . ($kode_sekunder3 ? $kode_sekunder3->icd : '') . ' - ' . $diagnosa->diagnosa_sekunder3;
                                    }
                                    if ($diagnosa->diagnosa_sekunder4 != null) {
                                        $temp .= '<br>' . ($kode_sekunder4 ? $kode_sekunder4->icd : '') . ' - ' . $diagnosa->diagnosa_sekunder4;
                                    }
                                    if ($diagnosa->diagnosa_sekunder5 != null) {
                                        $temp .= '<br>' . ($kode_sekunder5 ? $kode_sekunder5->icd : '') . ' - ' . $diagnosa->diagnosa_sekunder5;
                                    }
                                    echo $temp;
                                }
                                ?>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5>V. Diagnosa Pembanding : </h5>
                <div id="box_diagnosa_pembanding">
                    @if(!is_null($diagnosa))
                        {{ $diagnosa->kode_icd_diagnosa_pembanding != '' ? $diagnosa->kode_icd_diagnosa_pembanding . ' - ' . $diagnosa->nama_diagnosa_pembanding : $diagnosa->diagnosa_pembanding }}
                    @endif
                </div>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5>VI. Penatalaksanaan / Perencanaan Pelayanan</h5>
                <textarea name="tindakan_perawat" cols="30" rows="5" class="form-control">{{ $petriadik ? $petriadik->tindakan_perawat : '' }}</textarea>
                <br>
                <div>
                    <span style="font-size: 18px; font-weight: bold;">Terapi</span>
                    <div id="box_btn_terapi">
                        @if ($resep)
                            @if ($resep->locked == 0)
                                <button class="btn btn-warning hidden_on_print" type="button" onclick="open_form_resep()">
                                    <i class="fa fa-pencil" style="color:#fff;"></i>
                                </button>
                                <button class="btn btn-info hidden_on_print" type="button"
                                    onclick="lock_terapi('{{ $resep->id }}')">
                                    <i class="fa fa-lock" style="color:#fff;"></i>
                                </button>
                            @endif
                            <button class="btn btn-info hidden_on_print" type="button"
                                onclick="preview_terapi('{{ $resep->id }}')">
                                <i class="fa fa-book" style="color:#fff;"></i>
                            </button>
                            No. Resep Elektronik {{ $resep->id }}
                        @else
                            <button class="btn btn-dark hidden_on_print" type="button" onclick="open_form_resep()"><i
                                    class="fa fa-plus"></i></button>
                        @endif
                    </div>
                    <div id="box_resep" class="pt-3">
                        <table style="border-collapse: collapse; width:50%;" class="tabel_terapi">
                            @if ($resep)
                                @foreach ($resep->detail as $det)
                                    <tr>
                                        <td class="pl-4">{{ 'R/' }}</td>
                                        <td>{{ $det->nama_obat }}</td>
                                        <td>{{ $det->signa }}</td>
                                        <td style="padding-left: 20px;">
                                            {{ $det->jumlah . ' ' . $det->satuan }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
                <br>
                <table style="width:100%; border-collapse: collapse" border="1" class="mt-2">
                    <thead>
                        <tr class="text-center">
                            <th colspan="2">Diisi oleh Dokter yang Melakukan Penkajian Medis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td style="width:50%; vertical-align: text-center">
                                Cibarusah, {{ date('d/m/Y', strtotime($dokumen->updated_at)) }}, Jam : {{ date('H:i', strtotime($dokumen->updated_at)) }} WIB
                            </td>
                            <td style="width:50%;" id="box_ttd_dokter" onclick="open_modal_ttd_dokter()">
                                Dokter
                                <br>
                                @if ($dokumen->status == 1)
                                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($dokter ? $dokter->ttd : '') }}" style="height: 2cm; width: 3cm;" alt="">
                                    <br>
                                    {{ $dokumen->nama_verifikator }}
                                @else
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (................................................)
                                    <br>
                                    Ttd & Nama Terang
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1"
                style="border:1px solid #111; border-top:1px solid transparent; text-align: center">
                PENGKAJIAN KEPERAWATAN
            </div>
            @php
            $anamnesis_p = $petriadik ? json_decode($petriadik->anamnesis_perawat) : null;
            @endphp
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <input type="hidden" name="anamnesis_p">
                <h5>I. Anamnesis</h5>
                <table class="tabel_layout">
                    <tr>
                        <td style="width:3%">1.</td>
                        <td style="width: 15%">Tiba diruangan</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="text" class="datepicker" value="{{ $anamnesis_p ? $anamnesis_p->tiba_tanggal : '' }}" id="tiba_tanggal_p" style="border-radius:5px; border:1px solid lightgrey;">, Jam
                            <input type="text" class="timepicker" value="{{ $anamnesis_p ? $anamnesis_p->tiba_jam : '' }}" id="tiba_jam_p" style="border-radius:5px; border:1px solid lightgrey; width:10%;"> WIB
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%">Pengkajian</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="text" class="datepicker" value="{{ $anamnesis_p ? $anamnesis_p->pengkajian_tanggal : '' }}" id="pengkajian_tanggal_p" style="border-radius:5px; border:1px solid lightgrey;">, Jam
                            <input type="text" class="timepicker" value="{{ $anamnesis_p ? $anamnesis_p->pengkajian_jam : '' }}" id="pengkajian_jam_p" style="border-radius:5px; border:1px solid lightgrey; width:10%;"> WIB
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%">Diperoleh dari</td>
                        <td style="width:3%"> : </td>
                        <td>
                            <input type="text" id="diperoleh_dari_p" value="{{ $anamnesis_p ? $anamnesis_p->diperoleh_dari : '' }}" style="width: 90%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                        <td>
                            Hubungan dengan pasien : <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->hubungan_dengan_pasien : '' }}" id="hubungan_dengan_pasien_p" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">2</td>
                        <td style="width: 15%">Cara Masuk</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->caramasuk == 'Menggunakan Incubator' ? 'checked' : '' : '' }} name="caramasuk" value="Menggunakan Incubator" >Menggunakan Incubator
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->caramasuk == 'Coves' ? 'checked' : '' : '' }} name="caramasuk" value="Coves" style="margin-left: 5%"> Coves
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->caramasuk == 'Digendong' ? 'checked' : '' : '' }} name="caramasuk" value="Digendong" style="margin-left: 5%"> Digendong
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->caramasuk == 'Box Bayi' ? 'checked' : '' : '' }} name="caramasuk" value="Box Bayi" style="margin-left: 5%"> Box Bayi
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">3</td>
                        <td style="width: 15%">Asal Pasien</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->asal_pasien == 'IGD' ? 'checked' : '' : '' }} name="asal_pasien" value="IGD"> IGD
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->asal_pasien == 'Poliklinik' ? 'checked' : '' : '' }} name="asal_pasien" style="margin-left: 5%" value="Poliklinik"> Poliklinik
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->asal_pasien == 'Rujukan dr.Spesial/RS Luar/Bidan/Klinik' ? 'checked' : '' : '' }} name="asal_pasien" value="Rujukan dr.Spesial/RS Luar/Bidan/Klinik" style="margin-left: 5%"> Rujukan dr.Spesial/RS Luar/Bidan/Klinik
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->asal_pasien == 'Kamar Bersalin' ? 'checked' : '' : '' }} name="asal_pasien" style="margin-left: 5%" value="Kamar Bersalin"> Kamar Bersalin
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%"></td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->asal_pasien == 'Kamar Bedah' ? 'checked' : '' : '' }} name="asal_pasien" value="Kamar Bedah"> Kamar Bedah
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">4</td>
                        <td style="width: 15%">Penanggung Jawab</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->nama_pj : '' }}" id="nama_pj" style="width: 25%; border-radius:5px; border:1px solid lightgrey;">,
                            Usia :
                            <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->usia_pj : '' }}" id="usia_pj" style="width: 25%; border-radius:5px; border:1px solid lightgrey;">,
                            Pekerjaan :
                            <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->pekerjaan_pj : '' }}" id="pekerjaan_pj" style="width: 25%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">5</td>
                        <td style="width: 15%">Suku Bangsa</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->suku_bangsa : '' }}" id="suku_bangsa" style="border-radius:5px; border:1px solid lightgrey; width:85%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">6</td>
                        <td style="width: 15%">Keluhan Utama</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <textarea id="keluhan_utama_p" class="form-control"  cols="30" rows="1">{{ $anamnesis_p ? $anamnesis_p->keluhan_utama : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">7</td>
                        <td style="width: 15%">Riwayat Obstetric</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            G <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_obstetric->g : '' }}" id="riwayat_obstetric_g" style="width: 15%; border-radius:5px; border:1px solid lightgrey;">
                            P <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_obstetric->p : '' }}" id="riwayat_obstetric_p" style="width: 15%; border-radius:5px; border:1px solid lightgrey;">
                            A <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_obstetric->a : '' }}" id="riwayat_obstetric_a" style="width: 15%; border-radius:5px; border:1px solid lightgrey;">
                            Usia Gestasi : <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_obstetric->usia_gestasi : '' }}" id="usia_gestasi" style="width: 15%; border-radius:5px; border:1px solid lightgrey;"> mg
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">8</td>
                        <td style="width: 15%">Pernah dirawat</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->pernah_dirawat->value == 'Ya/Tidak' ? 'checked' : '' : '' }} name="pernah_dirawat" value="Ya/Tidak" > Ya/Tidak
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->pernah_dirawat->value == 'Indikasi Rawat' ? 'checked' : '' : '' }} name="pernah_dirawat" value="Indikasi Rawat" style="margin-left: 10%"> Indikasi Rawat :
                            <input type="text" id="indikasi_rawat" value="{{ $anamnesis_p ? $anamnesis_p->pernah_dirawat->indikasi : '' }}" style="width: 30%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%">Status Gizi Ibu</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->status_gizi_ibu == 'Baik' ? 'checked' : '' : 'checked' }} value="Baik" name="status_gizi_ibu" > Baik
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->status_gizi_ibu == 'Buruk' ? 'checked' : '' : '' }} value="Buruk" name="status_gizi_ibu" style="margin-left: 14.5%"> Buruk
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">9</td>
                        <td colspan="4">
                            Obat-obatan yang dikonsumsi selama kehamilan :
                            <input style="margin-left: 1%" type="radio" {{ $anamnesis_p ? $anamnesis_p->obat_obatan_yang_dikonsumsi_selama_hamil->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} name="obat_obatan_yang_dikonsumsi_selama_hamil" value="Tidak Ada" >
                            Tidak Ada
                            <input style="margin-left: 10%" type="radio" {{ $anamnesis_p ? $anamnesis_p->obat_obatan_yang_dikonsumsi_selama_hamil->value == 'Ada' ? 'checked' : '' : '' }} name="obat_obatan_yang_dikonsumsi_selama_hamil" value="Ada" > Ada,
                            Jenis
                            <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->obat_obatan_yang_dikonsumsi_selama_hamil->desc : '' }}" style="width: 25%; border-radius:5px; border:1px solid lightgrey;" id="desc_obat_obatan_yang_dikonsumsi_selama_hamil">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">10</td>
                        <td style="width: 15%">Kebiasaan Ibu</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->kebiasaan_ibu->value == 'Merokok' ? 'checked' : '' : '' }} name="kebiasaan_ibu" value="Merokok" > Merokok
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->kebiasaan_ibu->value == 'Minum Jamu' ? 'checked' : '' : '' }} name="kebiasaan_ibu" value="Minum Jamu" style="margin-left: 5%"> Minum Jamu
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->kebiasaan_ibu->value == 'Minuman Beralkohol' ? 'checked' : '' : '' }} name="kebiasaan_ibu" value="Minuman Beralkohol" style="margin-left: 5%"> Minuman Beralkohol
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->kebiasaan_ibu->value == 'Lain' ? 'checked' : '' : '' }} name="kebiasaan_ibu" value="Lain" style="margin-left: 5%"> 
                            <input id="kebiasaan_ibu_lain" value="{{ $anamnesis_p ? $anamnesis_p->kebiasaan_ibu->lain : '' }}" type="text" style="width: 30%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">11</td>
                        <td style="width: 15%">Riwayat Persalinan</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_persalinan == 'SC' ? 'checked' : '' : '' }} value="SC" name="riwayat_persalinan" > SC
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_persalinan == 'Spontan Kepala/Bokong' ? 'checked' : '' : '' }} value="Spontan Kepala/Bokong" name="riwayat_persalinan" style="margin-left: 5%"> Spontan Kepala/Bokong
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_persalinan == 'VE' ? 'checked' : '' : '' }} value="VE" name="riwayat_persalinan" style="margin-left: 5%"> VE
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_persalinan == 'FORCEP' ? 'checked' : '' : '' }} value="FORCEP" name="riwayat_persalinan" style="margin-left: 5%"> FORCEP
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%">Ketuban</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->ketuban->value == 'Jernih' ? 'checked' : '' : '' }} value="Jernih" name="ketuban" > Jernih
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->ketuban->value == 'Hijau Encer / Kental' ? 'checked' : '' : '' }} value="Hijau Encer / Kental" name="ketuban" style="margin-left: 5%"> Hijau Encer / Kental
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->ketuban->value == 'Meconium' ? 'checked' : '' : '' }} value="Meconium" name="ketuban" style="margin-left: 5%"> Meconium
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->ketuban->value == 'Darah' ? 'checked' : '' : '' }} value="Darah" name="ketuban" style="margin-left: 5%"> Darah
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->ketuban->value == 'Putih Keruh' ? 'checked' : '' : '' }} value="Putih Keruh" name="ketuban" style="margin-left: 5%"> Putih Keruh
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%"></td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->ketuban->value == 'Lain' ? 'checked' : '' : '' }} name="ketuban" value="Lain" > 
                            <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->ketuban->lain : '' }}" id="ketuban_lain" style="width: 30%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%">Volume</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->volume->value == 'Normal' ? 'checked' : '' : 'checked' }} value="Normal" name="volume" > Normal
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->volume->value == 'Oligohidramnion' ? 'checked' : '' : '' }} value="Oligohidramnion" name="volume" style="margin-left: 5%"> Oligohidramnion
                            <input type="radio" {{ $anamnesis_p ? $anamnesis_p->volume->value == 'Poligohidramnion' ? 'checked' : '' : '' }} value="Poligohidramnion" name="volume" style="margin-left: 5%"> Poligohidramnion, APGAR SCORE
                            <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->volume->apgar_score : '' }}" style="width: 30%; border-radius:5px; border:1px solid lightgrey;" id="apgar_score">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">12</td>
                        <td style="width: 15%">Antopometri BBL</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            BB <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->antopometri->bb : '' }}" id="bb" name="bb" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> gram
                            <span style="margin-left: 5%">&nbsp;</span>
                            PB <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->antopometri->pb : '' }}" id="pb" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                            <span style="margin-left: 5%">&nbsp;</span>
                            LD <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->antopometri->ld : '' }}" id="ld" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                            <span style="margin-left: 5%">&nbsp;</span>
                            LK <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->antopometri->lk : '' }}" id="lk" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%"></td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            LP <input type="text" value="{{ $anamnesis_p ? $anamnesis_p->antopometri->lp : '' }}" id="lp" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">13</td>
                        <td colspan="4">
                            Riwayat Penyakit Keluarga :
                            <input style="margin-left: 1%" type="radio" name="riwayat_penyakit_keluarga_p" {{ $anamnesis_p ? $anamnesis_p->riwayat_penyakit_keluarga->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} value="Tidak Ada" > Tidak Ada
                            <input style="margin-left: 10%" type="radio" name="riwayat_penyakit_keluarga_p" {{ $anamnesis_p ? $anamnesis_p->riwayat_penyakit_keluarga->value == 'Ada' ? 'checked' : '' : '' }} value="Ada" > Ada,
                            <input type="text" style="width: 25%; border-radius:5px; border:1px solid lightgrey;" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_penyakit_keluarga->desc : '' }}" id="desc_riwayat_penyakit_keluarga_p">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">14</td>
                        <td colspan="4">
                            Riwayat Alergi Obat / Makanan :
                            <input style="margin-left: 1%" type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_alergi_obat->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} name="riwayat_alergi_obat" value="Tidak Ada" > Tidak Ada
                            <input style="margin-left: 10%" type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_alergi_obat->value == 'Ada' ? 'checked' : '' : '' }} name="riwayat_alergi_obat" value="Ada" > Ada,
                            <input type="text" style="width: 25%; border-radius:5px; border:1px solid lightgrey;" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_alergi_obat->desc : '' }}" id="desc_riwayat_alergi_obat">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">15</td>
                        <td style="width: 15%">Riwayat Transfusi Darah</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input style="margin-left: 1%" type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_transfusi_darah->value == 'Tidak' ? 'checked' : '' : 'checked' }} name="riwayat_transfusi_darah" value="Tidak" > Tidak
                            <input style="margin-left: 10%" type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_transfusi_darah->value == 'Ya' ? 'checked' : '' : '' }} name="riwayat_transfusi_darah" value="Ya" > Ya, Kapan
                            <input type="text" style="width: 25%; border-radius:5px; border:1px solid lightgrey;" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_transfusi_darah->desc : '' }}" id="desc_riwayat_transfusi_darah">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%"></td>
                        <td style="width: 15%">Timbul Reaksi</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input style="margin-left: 1%" type="radio" {{ $anamnesis_p ? $anamnesis_p->timbul_reaksi->value == 'Tidak' ? 'checked' : '' : 'checked' }} name="timbul_reaksi" value="Tidak"> Tidak
                            <input style="margin-left: 10%" type="radio" {{ $anamnesis_p ? $anamnesis_p->timbul_reaksi->value == 'Ya' ? 'checked' : '' : '' }} name="timbul_reaksi" value="Ya"> Ya
                            <input type="text" style="width: 25%; border-radius:5px; border:1px solid lightgrey;" value="{{ $anamnesis_p ? $anamnesis_p->timbul_reaksi->desc : '' }}" id="desc_timbul_reaksi">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">16</td>
                        <td style="width: 15%">Riwayat Imunisasi</td>
                        <td style="width:3%"> : </td>
                        <td colspan="2">
                            <input style="margin-left: 1%" type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_imunisasi->value == 'Tidak' ? 'checked' : '' : 'checked' }} name="riwayat_imunisasi" value="Tidak"> Tidak
                            <input style="margin-left: 10%" type="radio" {{ $anamnesis_p ? $anamnesis_p->riwayat_imunisasi->value == 'Ya' ? 'checked' : '' : '' }} name="riwayat_imunisasi" value="Ya"> Ya
                            <input type="text" style="width: 25%; border-radius:5px; border:1px solid lightgrey;" value="{{ $anamnesis_p ? $anamnesis_p->riwayat_imunisasi->desc : '' }}" id="desc_riwayat_imunisasi">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                @php
                $pemeriksaan_fisik_p = $petriadik ? json_decode($petriadik->pemeriksaan_fisik_perawat) : null;
                @endphp
                <input type="hidden" name="pemeriksaan_fisik_p">
                <h5>II. Pemeriksaan Fisik</h5>
                <table class="tabel_layout">
                    <tr>
                        <td style="width:3%">1</td>
                        <td style="width: 15%">Keadaan Umum</td>
                        <td style="width:3%"> : </td>
                        <td>
                            <input {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->keadaan_umum == 'Tampak Tidak Sakit' ? 'checked' : '' : 'checked' }} type="radio" name="keadaan_umum_p" value="Tampak Tidak Sakit">Tampak Tidak Sakit
                            <input style="margin-left: 10%" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->keadaan_umum == 'Sakit Ringan' ? 'checked' : '' : '' }} type="radio" name="keadaan_umum_p" value="Sakit Ringan"> Sakit Ringan
                            <input style="margin-left: 10%" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->keadaan_umum == 'Sakit Sedang' ? 'checked' : '' : '' }} type="radio" name="keadaan_umum_p" value="Sakit Sedang"> Sakit Sedang
                            <input style="margin-left: 10%" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->keadaan_umum == 'Sakit Berat' ? 'checked' : '' : '' }} type="radio" name="keadaan_umum_p" value="Sakit Berat"> Sakit Berat
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">2.</td>
                        <td>Kesadaran</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->kesadaran == 'Compos Mentis' ? 'checked' : '' : 'checked' }} type="radio" name="kesadaran_p" value="Compos Mentis"> Compos Mentis
                            <input {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->kesadaran == 'Apatis' ? 'checked' : '' : '' }} style="margin-left: 10%" type="radio" name="kesadaran_p" value="Apatis"> Apatis
                            <input {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->kesadaran == 'Somnolen' ? 'checked' : '' : '' }} style="margin-left: 10%" type="radio" name="kesadaran_p" value="Somnolen"> Somnolen
                            <input {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->kesadaran == 'Sopor' ? 'checked' : '' : '' }} style="margin-left: 10%" type="radio" name="kesadaran_p" value="Sopor"> Sopor
                            <input {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->kesadaran == 'Sopor Coma' ? 'checked' : '' : '' }} style="margin-left: 10%" type="radio" name="kesadaran_p" value="Sopor Coma"> Sopor Coma
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">3.</td>
                        <td>GCS</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            E : <input value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->gcs->e : '' }}" type="text" id="gcs_e_p" style="width: 20%; border-radius:5px; border:1px solid lightgrey; margin-right: 20px;">
                            M : <input value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->gcs->m : '' }}" type="text" id="gcs_m_p" style="width: 20%; border-radius:5px; border:1px solid lightgrey; margin-right: 20px;">
                            V : <input value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->gcs->v : '' }}" type="text" id="gcs_v_p" style="width: 20%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">4.</td>
                        <td>Tanda Vital</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            TD : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->tanda_vital->td : '' }}" id="td_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> mmHg
                            <span style="margin-left: 15px">&nbsp;</span>
                            S : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->tanda_vital->s : '' }}" id="s_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> C
                            <span style="margin-left: 15px">&nbsp;</span>
                            N : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->tanda_vital->n : '' }}" id="n_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> x/m
                            <span style="margin-left: 15px">&nbsp;</span>
                            RR : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->tanda_vital->rr : '' }}" id="rr_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> x/m
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">5.</td>
                        <td>Antropometri</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            BB : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->antopometri->bb : '' }}" id="bb_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> kg
                            <span style="margin-left: 15px">&nbsp;</span>
                            TB : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->antopometri->tb : '' }}" id="tb_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                            <span style="margin-left: 15px">&nbsp;</span>
                            Lingkar Kepala : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->antopometri->lk : '' }}" id="lk_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%"></td>
                        <td></td>
                        <td style="width: 3%"> : </td>
                        <td>
                            Lingkar Dada : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->antopometri->ld : '' }}" id="ld_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                            <span style="margin-left: 15px">&nbsp;</span>
                            Lingkar Perut : <input type="text" value="{{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->antopometri->lp : '' }}" id="lp_p" style="width: 10%; border-radius:5px; border:1px solid lightgrey;"> cm
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">6.</td>
                        <td>Golongan Darah / Rh (Bayi)</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->bayi->value == 'A' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_bayi" value="A">A
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->bayi->value == 'B' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_bayi" value="B">B
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->bayi->value == 'AB' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_bayi" value="AB">AB
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->bayi->value == 'O' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_bayi" value="O">O
                            <span style="margin-left: 15px">Rh : </span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->bayi->rh == 'Positif' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="rh_bayi" value="Positif">Positif
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->bayi->rh == 'Negatif' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="rh_bayi" value="Negatif">Negatif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%"></td>
                        <td>Golongan Darah / Rh (Ibu)</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ibu->value == 'A' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ibu" value="A">A
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ibu->value == 'B' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ibu" value="B">B
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ibu->value == 'AB' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ibu" value="AB">AB
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ibu->value == 'O' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ibu" value="O">O
                            <span style="margin-left: 15px">Rh : </span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ibu->rh == 'Positif' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="rh_ibu" value="Positif">Positif
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ibu->rh == 'Negatif' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="rh_ibu" value="Negatif">Negatif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%"></td>
                        <td>Golongan Darah / Rh (Ayah)</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ayah->value == 'A' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ayah" value="A">A
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ayah->value == 'B' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ayah" value="B">B
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ayah->value == 'AB' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ayah" value="AB">AB
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ayah->value == 'O' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="goldar_ayah" value="O">O
                            <span style="margin-left: 15px">Rh : </span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ayah->rh == 'Positif' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="rh_ayah" value="Positif">Positif
                            <span style="margin-left: 15px">&nbsp;</span>
                            <input type="radio" {{ $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->golongan_darah->ayah->rh == 'Negatif' ? 'checked' : '' : '' }} style="margin-right: 0.5%" name="rh_ayah" value="Negatif">Negatif
                        </td>
                    </tr>
                    @php
                    $sistem_susunan_saraf = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_susunan_saraf : null;
                    @endphp
                    <tr>
                        <td style="width: 3%">7.</td>
                        <td colspan="4">Pengkajian Persistem : </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <table class="tabel_layout" border="1">
                                <tr class="text-center">
                                    <td style="width: 25%">Pengkajian Persistem</td>
                                    <td style="width: 75%">Hasil Pemeriksaan</td>
                                </tr>
                                <tr>
                                    <td>Sistem Susunan Saraf Pusat</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td style="width: 16%">Gerak Bayi</td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 16.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->gerak_bayi == 'Aktif' ? 'checked' : '' : 'checked' }} name="gerak_bayi" value="Aktif"> Aktif
                                                </td>
                                                <td colspan="4" style="width: 64.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->gerak_bayi == 'Tidak Aktif' ? 'checked' : '' : '' }} name="gerak_bayi" value="Tidak Aktif"> Tidak Aktif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 16%">Ubun-ubun</td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 16.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->ubun_ubun->value == 'Datar' ? 'checked' : '' : '' }} name="ubun_ubun" value="Datar"> Datar
                                                </td>
                                                <td style="width: 18%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->ubun_ubun->value == 'Cekung' ? 'checked' : '' : '' }} name="ubun_ubun" value="Cekung"> Cekung
                                                </td>
                                                <td style="width: 16.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->ubun_ubun->value == 'Menonjol' ? 'checked' : '' : '' }} name="ubun_ubun" value="Menonjol"> Menonjol
                                                </td>
                                                <td colspan="2" style="width: 30%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->ubun_ubun->value == 'Lain' ? 'checked' : '' : '' }} name="ubun_ubun" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_susunan_saraf ? $sistem_susunan_saraf->ubun_ubun->lain : '' }}" id="ubun_ubun_lain" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 16%">Kejang</td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 16.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->kejang->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} name="kejang" value="Tidak Ada"> Tidak Ada
                                                </td>
                                                <td colspan="4" style="width: 64.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->kejang->value == 'Ada' ? 'checked' : '' : '' }} name="kejang" value="Ada"> Ada 
                                                    <input type="text" id="desc_kejang" value="{{ $sistem_susunan_saraf ? $sistem_susunan_saraf->kejang->desc : '' }}" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 16%">Refleks</td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 16.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->refleks->value == 'Moro' ? 'checked' : '' : '' }} name="refleks" value="Moro"> Moro
                                                </td>
                                                <td style="width: 18%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->refleks->value == 'Menelan' ? 'checked' : '' : '' }} name="refleks" value="Menelan"> Menelan
                                                </td>
                                                <td style="width: 15.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->refleks->value == 'Hisap' ? 'checked' : '' : '' }} name="refleks" value="Hisap"> Hisap
                                                </td>
                                                <td style="width: 16%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->refleks->value == 'Babinsk' ? 'checked' : '' : '' }} name="refleks" value="Babinsk"> Babinsk
                                                </td>
                                                <td style="width: 16%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->refleks->value == 'Rooting' ? 'checked' : '' : '' }} name="refleks" value="Rooting"> Rooting
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 16%"></td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 81%" colspan="5">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->refleks->value == 'Lain' ? 'checked' : '' : '' }} name="refleks" value="Lain"> 
                                                    <input type="text" id="refleks_lain" value="{{ $sistem_susunan_saraf ? $sistem_susunan_saraf->refleks->lain : '' }}" style="width: 90%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 16%">Tangis Bayi</td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 16.5%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->tangis_bayi->value == 'Kuat' ? 'checked' : '' : 'checked' }} name="tangis_bayi" value="Kuat"> Kuat
                                                </td>
                                                <td style="width: 30%" colspan="2">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->tangis_bayi->value == 'Melengking' ? 'checked' : '' : '' }} name="tangis_bayi" value="Melengking"> Melengking
                                                </td>
                                                <td colspan="3" style="width: 57%">
                                                    <input type="radio" {{ $sistem_susunan_saraf ? $sistem_susunan_saraf->tangis_bayi->value == 'Lain' ? 'checked' : '' : '' }} name="tangis_bayi" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_susunan_saraf ? $sistem_susunan_saraf->tangis_bayi->lain : '' }}" id="tangis_bayi_lain" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    $sistem_penglihatan = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_penglihatan : null;
                                    @endphp
                                    <td>Sistem Penglihatan</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td style="width: 17%">Posisi Mata</td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 15%">
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->posisi_mata == 'Simetris' ? 'checked' : '' : 'checked' }} name="posisi_mata" value="Simetris"> Simetris
                                                </td>
                                                <td colspan="3" style="width: 65%">
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->posisi_mata == 'Asimetris' ? 'checked' : '' : '' }} name="posisi_mata" value="Asimetris"> Asimetris
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pupil</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->pupil == 'Isokor' ? 'checked' : '' : 'checked' }} name="pupil" value="Isokor"> Isokor
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->pupil == 'Anisokor' ? 'checked' : '' : '' }} name="pupil" value="Anisokor"> Anisokor
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelopak Mata</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->kelopak_mata->value == 'TAK' ? 'checked' : '' : 'checked' }} name="kelopak_mata" value="TAK"> TAK
                                                </td>
                                                <td style="width: 15.5%">
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->kelopak_mata->value == 'Edema' ? 'checked' : '' : '' }} name="kelopak_mata" value="Edema"> Edema
                                                </td>
                                                <td style="width: 20%">
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->kelopak_mata->value == 'Cekung' ? 'checked' : '' : '' }} name="kelopak_mata" value="Cekung"> Cekung
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->kelopak_mata->value == 'Lain' ? 'checked' : '' : '' }} name="kelopak_mata" value="Lain"> Lain-lain 
                                                    <input type="text" value="{{ $sistem_penglihatan ? $sistem_penglihatan->kelopak_mata->lain : '' }}" id="kelopak_mata_lain" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Konjungtiva</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->konjungtiva->value == 'TAK' ? 'checked' : '' : 'checked' }} name="konjungtiva" value="TAK"> TAK
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->konjungtiva->value == 'Anemis' ? 'checked' : '' : '' }} name="konjungtiva" value="Anemis"> Anemis
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->konjungtiva->value == 'Konjungtivis' ? 'checked' : '' : '' }} name="konjungtiva" value="Konjungtivis"> Konjungtivis
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->konjungtiva->value == 'Lain' ? 'checked' : '' : '' }} name="konjungtiva" value="Lain"> Lain-lain 
                                                    <input type="text" value="{{ $sistem_penglihatan ? $sistem_penglihatan->konjungtiva->lain : '' }}" id="konjungtiva_lain" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sklera</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->sklera->value == 'TAK' ? 'checked' : '' : 'checked' }} name="sklera" value="TAK"> TAK
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->sklera->value == 'Ikterik' ? 'checked' : '' : '' }} name="sklera" value="Ikterik"> Ikterik
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->sklera->value == 'Pendarahan' ? 'checked' : '' : '' }} name="sklera" value="Pendarahan"> Pendarahan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->sklera->value == 'Lain' ? 'checked' : '' : '' }} name="sklera" value="Lain"> Lain-lain 
                                                    <input type="text" value="{{ $sistem_penglihatan ? $sistem_penglihatan->sklera->lain : '' }}" id="sklera_lain" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Alat Bantu Penglihatan
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->alat_bantu_penglihatan == 'tidak' ? 'checked' : '' : 'checked' }} name="alat_bantu_penglihatan" value="tidak"> Tidak
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->alat_bantu_penglihatan == 'ya' ? 'checked' : '' : '' }} name="alat_bantu_penglihatan" value="ya"> Ya
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->alat_bantu_penglihatan == 'mata_palsu' ? 'checked' : '' : '' }} name="alat_bantu_penglihatan" value="mata_palsu"> Mata Palsu
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->alat_bantu_penglihatan == 'kaca_mata' ? 'checked' : '' : '' }} name="alat_bantu_penglihatan" value="kaca_mata"> Kaca Mata
                                                    <input type="radio" {{ $sistem_penglihatan ? $sistem_penglihatan->alat_bantu_penglihatan == 'lensa_kontak' ? 'checked' : '' : '' }} name="alat_bantu_penglihatan" value="lensa_kontak" style="margin-left: 5%;"> Lensa Kontak
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    $sistem_pendengaran = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_pendengaran : null;
                                    @endphp
                                    <td>Sistem Pendengaran</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td>
                                                    <input type="radio" {{ $sistem_pendengaran ? $sistem_pendengaran->value == 'TAK' ? 'checked' : '' : 'checked' }} name="sistem_pendengaran" value="TAK"> TAK
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pendengaran ? $sistem_pendengaran->value == 'Asimetris' ? 'checked' : '' : '' }} name="sistem_pendengaran" value="Asimetris"> Asimetris
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pendengaran ? $sistem_pendengaran->value == 'Serumen' ? 'checked' : '' : '' }} name="sistem_pendengaran" value="Serumen"> Serumen
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pendengaran ? $sistem_pendengaran->value == 'Cairan' ? 'checked' : '' : '' }} name="sistem_pendengaran" value="Keluar Cairan"> Keluar Cairan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pendengaran ? $sistem_pendengaran->value == 'Tidak Ada Lubang Drum' ? 'checked' : '' : '' }} name="sistem_pendengaran" value="Tidak Ada Lubang Drum"> Tidak Ada Lubang Drum
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <input type="radio" {{ $sistem_pendengaran ? $sistem_pendengaran->value == 'Lain' ? 'checked' : '' : '' }} name="sistem_pendengaran" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_pendengaran ? $sistem_pendengaran->lain : '' }}" id="sistem_pendengaran_lain" style="width: 90%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    $sistem_penciuman = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_penciuman : null;
                                    @endphp
                                    <td>Sistem Penciuman</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td>
                                                    <input type="radio" {{ $sistem_penciuman ? $sistem_penciuman->value == 'TAK' ? 'checked' : '' : 'checked' }} name="sistem_penciuman" value="TAK"> TAK
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penciuman ? $sistem_penciuman->value == 'Asimetris' ? 'checked' : '' : '' }} name="sistem_penciuman" value="Asimetris"> Asimetris
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penciuman ? $sistem_penciuman->value == 'Cairan' ? 'checked' : '' : '' }} name="sistem_penciuman" value="Pengeluaran Cairan"> Pengeluaran Cairan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_penciuman ? $sistem_penciuman->value == 'Lain' ? 'checked' : '' : '' }} name="sistem_penciuman" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_penciuman ? $sistem_penciuman->lain : '' }}" id="sistem_penciuman_lain" style="width: 90%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    $sistem_pernafasan = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_pernafasan : null;
                                    @endphp
                                    <td>Sistem Pernafasan</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td>
                                                    Pola Napas
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->pola_napas == 'Normal' ? 'checked' : '' : '' }} name="pola_napas" value="Normal"> Normal
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->pola_napas == 'Bradipnea' ? 'checked' : '' : '' }} name="pola_napas" value="Bradipnea"> Bradipnea
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->pola_napas == 'Tachipnea' ? 'checked' : '' : '' }} name="pola_napas" value="Tachipnea"> Tachipnea
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Jenis Pernapasan
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->jenis_pernapasan->value == 'Pernapasan Dada' ? 'checked' : '' : '' }} name="jenis_pernapasan" value="Pernapasan Dada"> Pernapasan Dada
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->jenis_pernapasan->value == 'Pernapasan Perut' ? 'checked' : '' : '' }} name="jenis_pernapasan" value="Pernapasan Perut"> Pernapasan Perut
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="4">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->jenis_pernapasan->value == 'Alat Bantu Napas' ? 'checked' : '' : '' }} name="jenis_pernapasan" value="Alat Bantu Napas"> Alat Bantu Napas, Sebutkan 
                                                    <input type="text" value="{{ $sistem_pernafasan ? $sistem_pernafasan->jenis_pernapasan->desc : '' }}" id="desc_jenis_pernapasan" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Irama Napas
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->irama_napas == 'Teratur' ? 'checked' : '' : '' }} name="irama_napas" value="Teratur"> Teratur
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->irama_napas == 'Tidak Teratur' ? 'checked' : '' : '' }} name="irama_napas" value="Tidak Teratur"> Tidak Teratur
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Retraksi
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->retraksi == 'Tidak Ada' ? 'checked' : '' : '' }} name="retraksi" value="Tidak Ada"> Tidak Ada
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->retraksi == 'Ringan' ? 'checked' : '' : '' }} name="retraksi" value="Ringan"> Ringan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->retraksi == 'Sedang' ? 'checked' : '' : '' }} name="retraksi" value="Sedang"> Sedang
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->retraksi == 'Berat' ? 'checked' : '' : '' }} name="retraksi" value="Berat"> Berat
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Air Entri
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->air_entri == 'Udara Masuk' ? 'checked' : '' : '' }} name="air_entri" value="Udara Masuk"> Udara Masuk
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->air_entri == 'Penurunan Udara Masuk' ? 'checked' : '' : '' }} name="air_entri" value="Penurunan Udara Masuk"> Penurunan Udara Masuk
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="4">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->air_entri == 'Tidak Ada Udara Masuk' ? 'checked' : '' : 'checked' }} name="air_entri" value="Tidak Ada Udara Masuk"> Tidak Ada Udara Masuk
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Merintih
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->merintih == 'Tidak Ada' ? 'checked' : '' : 'checked' }} name="merintih" value="Tidak Ada"> Tidak Ada
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->merintih == 'Terdengar dengan Stetoskop' ? 'checked' : '' : '' }} name="merintih" value="Terdengar dengan Stetoskop"> Terdengar dengan Stetoskop
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="4">
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->merintih == 'Terdengar tanpa Stetoskop' ? 'checked' : '' : '' }} name="merintih" value="Terdengar tanpa Stetoskop"> Terdengar tanpa Stetoskop
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Suara Napas
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->suara_napas == 'Vesikuler' ? 'checked' : '' : '' }} name="suara_napas" value="Vesikuler"> Vesikuler
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->suara_napas == 'Wheezing' ? 'checked' : '' : '' }} name="suara_napas" value="Wheezing"> Wheezing
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->suara_napas == 'Ronchi' ? 'checked' : '' : '' }} name="suara_napas" value="Ronchi"> Ronchi
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pernafasan ? $sistem_pernafasan->suara_napas == 'Stridor' ? 'checked' : '' : '' }} name="suara_napas" value="Stridor"> Stridor
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    $sistem_kardiovaskuler = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_kardiovaskuler : null;
                                    @endphp
                                    <td>Sistem Kardiovaskuler</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td>Warna Kulit</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->warna_kulit->value == 'Kemerahan' ? 'checked' : '' : 'checked' }} name="warna_kulit" value="Kemerahan"> Kemerahan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->warna_kulit->value == 'Sianosis' ? 'checked' : '' : '' }} name="warna_kulit" value="Sianosis"> Sianosis
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->warna_kulit->value == 'Pucat' ? 'checked' : '' : '' }} name="warna_kulit" value="Pucat"> Pucat
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->warna_kulit->value == 'Lain' ? 'checked' : '' : '' }} name="warna_kulit" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->warna_kulit->lain : '' }}" id="warna_kulit_lain" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Denyut Nadi</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->denyut_nadi == 'Teratur' ? 'checked' : '' : '' }} name="denyut_nadi" value="Teratur"> Teratur
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->denyut_nadi == 'Tidak Teratur' ? 'checked' : '' : '' }} name="denyut_nadi" value="Tidak Teratur"> Tidak Teratur
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sirkulasi</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->value == 'Akral Hangat' ? 'checked' : '' : '' }} name="sirkulasi" value="Akral Hangat"> Akral Hangat
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->value == 'Akral Dingin' ? 'checked' : '' : '' }} name="sirkulasi" value="Akral Dingin"> Akral Dingin
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->value == 'Rasa Kebas' ? 'checked' : '' : '' }} name="sirkulasi" value="Rasa Kebas"> Rasa Kebas
                                                    <input style="margin-left: 10%" type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->value == 'Palpitasi' ? 'checked' : '' : '' }} name="sirkulasi"  value="Palpitasi"> Palpitasi
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->value == 'CRT' ? 'checked' : '' : '' }} name="sirkulasi" value="CRT"> CRT : 
                                                    <input type="number" value="{{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->crt : '' }}" id="crt" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                    detik
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->value == 'Edema' ? 'checked' : '' : '' }} name="sirkulasi" value="Edema"> Edema, Lokasi 
                                                    <input type="text" value="{{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->sirkulasi->edema : '' }}" id="edema" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pulsasi</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" name="pulsasi" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->pulsasi->value == 'Kuat' ? 'checked' : '' : '' }} value="Kuat"> Kuat
                                                </td>
                                                <td>
                                                    <input type="radio" name="pulsasi" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->pulsasi->value == 'Lemah' ? 'checked' : '' : '' }} value="Lemah"> Lemah
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" name="pulsasi" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->pulsasi->value == 'Mur-mur' ? 'checked' : '' : '' }} value="Mur-mur"> Mur-mur
                                                    <input style="margin-left: 5%" {{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->pulsasi->value == 'Lain' ? 'checked' : '' : '' }} type="radio" name="pulsasi" value="Lain"> 
                                                    <input type="text" id="pulsasi_lain" value="{{ $sistem_kardiovaskuler ? $sistem_kardiovaskuler->pulsasi->lain : '' }}" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php $sistem_pencernaan = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_pencernaan : null @endphp
                                    <td>Sistem Pencernaan</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td style="width: 10%">Mulut</td>
                                                <td style="width: 3%"> : </td>
                                                <td style="width: 26%">
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->mulut->value == 'Tidak Ada Kelainan' ? 'checked' : '' : 'checked' }} name="mulut" value="Tidak Ada Kelainan"> Tidak Ada Kelainan
                                                </td>
                                                <td style="width: 14%">
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->mulut->value == 'Simetris' ? 'checked' : '' : '' }} name="mulut" value="Simetris"> Simetris
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->mulut->value == 'Asimetris' ? 'checked' : '' : '' }} name="mulut" value="Asimetris"> Asimetris
                                                    <input style="margin-left: 5%" {{ $sistem_pencernaan ? $sistem_pencernaan->mulut->value == 'Mukosa Kering' ? 'checked' : '' : '' }} type="radio" name="mulut" value="Mukosa Kering"> Mukosa Kering
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->mulut->value == 'Bibir Pucat' ? 'checked' : '' : '' }} name="mulut" value="Bibir Pucat"> Bibir Pucat
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->mulut->value == 'Lain' ? 'checked' : '' : '' }} name="mulut" value="Lain"> 
                                                    <input type="text" id="mulut_lain" value="{{ $sistem_pencernaan ? $sistem_pencernaan->mulut->lain : '' }}" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gigi</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->gigi->value == 'Tidak Ada Kelainan' ? 'checked' : '' : 'checked' }} name="gigi" value="Tidak Ada Kelainan"> Tidak Ada Kelainan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->gigi->value == 'Kotor' ? 'checked' : '' : '' }} name="gigi" value="Kotor"> Kotor
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->gigi->value == 'Gerakan Simetris' ? 'checked' : '' : '' }} name="gigi" value="Gerakan Simetris"> Gerakan Simetris
                                                    <input style="margin-left: 5%" {{ $sistem_pencernaan ? $sistem_pencernaan->gigi->value == 'Lain' ? 'checked' : '' : '' }} type="radio" name="gigi" value="Lain" > 
                                                    <input type="text" id="gigi_lain" value="{{ $sistem_pencernaan ? $sistem_pencernaan->gigi->lain : '' }}" style="width: 35%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lidah</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->lidah->value == 'Tidak Ada Kelainan' ? 'checked' : '' : 'checked' }} name="lidah" value="Tidak Ada Kelainan"> Tidak Ada Kelainan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->lidah->value == 'Kotor' ? 'checked' : '' : '' }} name="lidah" value="Kotor"> Kotor
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->lidah->value == 'Gerakan Simetris' ? 'checked' : '' : '' }} name="lidah" value="Gerakan Simetris"> Gerakan Simetris
                                                    <input style="margin-left: 5%" {{ $sistem_pencernaan ? $sistem_pencernaan->lidah->value == 'Lain' ? 'checked' : '' : '' }} type="radio" name="lidah" value="Lain" > 
                                                    <input type="text" id="lidah_lain" value="{{ $sistem_pencernaan ? $sistem_pencernaan->lidah->lain : '' }}" style="width: 35%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oesofagus</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->oesofagus->value == 'Tidak Ada Kelainan' ? 'checked' : '' : 'checked' }} name="oesofagus" value="Tidak Ada Kelainan"> Tidak Ada Kelainan
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_pencernaan ? $sistem_pencernaan->oesofagus->value == 'Lain' ? 'checked' : '' : '' }} name="oesofagus" value="Lain">
                                                    <input type="text" value="{{ $sistem_pencernaan ? $sistem_pencernaan->oesofagus->lain : '' }}" id="oesofagus_lain" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Abdomen</td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_pencernaan ? $sistem_pencernaan->abdomen->value == 'Supel' ? 'checked' : '' : '' }} type="radio" name="abdomen" value="Supel"> Supel
                                                    <input {{ $sistem_pencernaan ? $sistem_pencernaan->abdomen->value == 'Asites' ? 'checked' : '' : '' }} style="margin-left: 5%" type="radio" name="abdomen"value="Asites"> Asites
                                                </td>
                                                <td colspan="2">
                                                    <input {{ $sistem_pencernaan ? $sistem_pencernaan->abdomen->value == 'Bising Usus' ? 'checked' : '' : '' }} type="radio" name="abdomen" value="Bising Usus"> Bising Usus
                                                    x/menit
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td colspan="4">
                                                    <input {{ $sistem_pencernaan ? $sistem_pencernaan->abdomen->value == 'Lain' ? 'checked' : '' : '' }} type="radio" name="abdomen" value="Lain">
                                                    <input type="text" value="{{ $sistem_pencernaan ? $sistem_pencernaan->abdomen->lain : '' }}" id="abdomen_lain" style="width: 90%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php $sistem_genitourinaria = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_genitourinaria : null; @endphp
                                    <td>Sistem Genitourinaria</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td>BAB</td>
                                                <td> : </td>
                                                <td style="width: 14%">
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->value == 'Normal' ? 'checked' : '' : '' }} name="bab" value="Normal"> Normal
                                                </td>
                                                <td style="width: 20%">
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->value == 'Konstipasi' ? 'checked' : '' : '' }} name="bab" value="Konstipasi"> Konstipasi
                                                </td>
                                                <td style="width: 23%">
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->value == 'Melena' ? 'checked' : '' : '' }} name="bab" value="Melena"> Melena
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->value == 'Colostomy' ? 'checked' : '' : '' }} name="bab" value="Colostomy"> Colostomy
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="4">
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->value == 'Diare, Frekuensi' ? 'checked' : '' : '' }} name="bab" value="Diare"> Diare, Frekuensi 
                                                    <input type="number" value="{{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->frekuensi : '' }}" id="frekuensi_diare" style="width: 10%; border-radius:5px; border:1px solid lightgrey;">
                                                    / Hari
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="4">
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->value == 'Meco Pertama, tgl/jam' ? 'checked' : '' : '' }} name="bab" value="Meco Pertama"> Meco Pertama, tgl/jam 
                                                    <input type="text" class="datetimepicker" value="{{ $sistem_genitourinaria ? $sistem_genitourinaria->bab->meco_pertama : '' }}" id="meco_pertama" style="width: 30%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Warna</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bab->value == 'Kuning' ? 'checked' : '' : '' }} name="warna_bab" value="Kuning"> Kuning
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bab->value == 'Dempul' ? 'checked' : '' : '' }} name="warna_bab" value="Dempul"> Dempul
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bab->value == 'Cokelat' ? 'checked' : '' : '' }} name="warna_bab" value="Cokelat"> Cokelat
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bab->value == 'Hijau' ? 'checked' : '' : '' }} name="warna_bab" value="Hijau"> Hijau
                                                    <input style="margin-left: 5%" type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bab->value == 'Lain' ? 'checked' : '' : '' }} name="warna_bab" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bab->lain : '' }}" id="warna_bab_lain" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>BAK</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bak->value == 'Normal' ? 'checked' : '' : '' }} name="bak" value="Normal" > Normal
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bak->value == 'Hematuri' ? 'checked' : '' : '' }} name="bak" value="Hematuri" > Hematuri
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bak->value == 'Urine Menetes' ? 'checked' : '' : '' }} name="bak" value="Urine Menetes"> Urine Menetes
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bak->value == 'Oliguri' ? 'checked' : '' : '' }} name="bak" value="Oliguri" > Oliguri
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="4">
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->bak->value == 'BAK pertama' ? 'checked' : '' : '' }} name="bak" value="BAK pertama"> BAK pertama : tgl/jam 
                                                    <input type="text" class="datetimepicker" value="{{ $sistem_genitourinaria ? $sistem_genitourinaria->bak->bak_pertama : '' }}" id="bak_pertama" style="width: 30%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Warna</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bak->value == 'Jernih' ? 'checked' : '' : '' }} name="warna_bak" value="Jernih"> Jernih
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bak->value == 'Kuning' ? 'checked' : '' : '' }} name="warna_bak" value="Kuning"> Kuning
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bak->value == 'Kuning Pekat' ? 'checked' : '' : '' }} name="warna_bak" value="Kuning Pekat"> Kuning Pekat
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bak->value == 'Lain' ? 'checked' : '' : '' }} name="warna_bak" value="Lain"> 
                                                    <input type="text" id="warna_bak_lain" value="{{ $sistem_genitourinaria ? $sistem_genitourinaria->warna_bak->lain : '' }}" style="width: 50%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php $sistem_reproduksi = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_reproduksi : null @endphp
                                    <td>Sistem Reproduksi</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td>Laki-laki</td>
                                                <td> : </td>
                                                <td style="width: 15%">
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->laki_laki->value == 'Normal' ? 'checked' : '' : 'checked' }} name="sistem_reproduksi_l" value="Normal"> Normal
                                                </td>
                                                <td style="width: 20%">
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->laki_laki->value == 'Hipospadia' ? 'checked' : '' : '' }} name="sistem_reproduksi_l" value="Hipospadia"> Hipospadia
                                                </td>
                                                <td style="width: 24%">
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->laki_laki->value == 'Epispadia' ? 'checked' : '' : '' }} name="sistem_reproduksi_l" value="Epispadia"> Epispadia
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->laki_laki->value == 'Fimois' ? 'checked' : '' : '' }} name="sistem_reproduksi_l" value="Fimois"> Fimois
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->laki_laki->value == 'Hidrokel' ? 'checked' : '' : '' }} name="sistem_reproduksi_l" value="Hidrokel"> Hidrokel
                                                </td>
                                                <td colspan="3">
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->laki_laki->value == 'Lain' ? 'checked' : '' : '' }} name="sistem_reproduksi_l" value="Lain" > 
                                                    <input type="text" value="{{ $sistem_reproduksi ? $sistem_reproduksi->laki_laki->lain : '' }}" id="sistem_reproduksi_l_lain" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Perempuan</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->perempuan->value == 'Normal' ? 'checked' : '' : 'checked' }} name="sistem_reproduksi_p" value="Normal"> Normal
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->perempuan->value == 'Keputihan' ? 'checked' : '' : '' }} name="sistem_reproduksi_p" value="Keputihan"> Keputihan
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->perempuan->value == 'Vagina Skintag' ? 'checked' : '' : '' }} name="sistem_reproduksi_p" value="Vagina Skintag"> Vagina Skintag
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_reproduksi ? $sistem_reproduksi->perempuan->value == 'Lain' ? 'checked' : '' : '' }} name="sistem_reproduksi_p" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_reproduksi ? $sistem_reproduksi->perempuan->lain : '' }}" id="sistem_reproduksi_p_lain" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php $sistem_integumen = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_integumen : null @endphp
                                    <td>Sistem Integumen</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td>Vernic Kaseosa</td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->vernic_kaseosa->value == 'Ada' ? 'checked' : '' : '' }} type="radio" name="vernic_kaseosa" value="Ada"> Ada
                                                </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->vernic_kaseosa->value == 'Tidak Ada' ? 'checked' : '' : 'checked' }} type="radio" name="vernic_kaseosa" value="Tidak Ada"> Tidak Ada
                                                </td>
                                                <td colspan="2">
                                                    <input {{ $sistem_integumen ? $sistem_integumen->vernic_kaseosa->value == 'Lain' ? 'checked' : '' : '' }} type="radio" name="vernic_kaseosa" value="Lain"> 
                                                    <input type="text" id="vernic_kaseosa_lain" value="{{ $sistem_integumen ? $sistem_integumen->vernic_kaseosa->lain : '' }}" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lanugo</td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->lanugo == 'Tidak Ada' ? 'checked' : '' : 'checked' }} type="radio" name="lanugo" value="Tidak Ada"> Tidak Ada
                                                </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->lanugo == 'Banyak' ? 'checked' : '' : '' }} type="radio" name="lanugo" value="Banyak"> Banyak
                                                </td>
                                                <td colspan="2">
                                                    <input {{ $sistem_integumen ? $sistem_integumen->lanugo == 'Tipis' ? 'checked' : '' : '' }} type="radio" name="lanugo" value="Tipis"> Tipis
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td colspan="2">
                                                    <input {{ $sistem_integumen ? $sistem_integumen->lanugo == 'Bercak-bercak Tanpa Lanugo' ? 'checked' : '' : '' }} type="radio" name="lanugo" value="Bercak-bercak Tanpa Lanugo"> Bercak-bercak Tanpa Lanugo
                                                </td>
                                                <td colspan="2">
                                                    <input {{ $sistem_integumen ? $sistem_integumen->lanugo == 'Sebagian Besar Tanpa Lanugo' ? 'checked' : '' : '' }} type="radio" name="lanugo" value="Sebagian Besar Tanpa Lanugo"> Sebagian Besar Tanpa Lanugo
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Warna</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->warna->value == 'Pucat' ? 'checked' : '' : '' }} name="warna_integumen" value="Pucat"> Pucat
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->warna->value == 'Ikterik' ? 'checked' : '' : '' }} name="warna_integumen" value="Ikterik"> Ikterik
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->warna->value == 'Cyanosis' ? 'checked' : '' : '' }} name="warna_integumen" value="Cyanosis"> Cyanosis
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->warna->value == 'Normal' ? 'checked' : '' : '' }} name="warna_integumen" value="Normal"> Normal
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td colspan="4">
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->warna->value == 'Lain' ? 'checked' : '' : '' }} name="warna_integumen" value="Lain"> 
                                                    <input type="text" id="warna_integumen_lain" value="{{ $sistem_integumen ? $sistem_integumen->warna->lain : '' }}" style="width: 90%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tugor</td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->tugor == 'Baik' ? 'checked' : '' : '' }} type="radio" name="tugor" value="Baik"> Baik
                                                </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->tugor == 'Sedang' ? 'checked' : '' : '' }} type="radio" name="tugor" value="Sedang"> Sedang
                                                </td>
                                                <td colspan="2">
                                                    <input {{ $sistem_integumen ? $sistem_integumen->tugor == 'Buruk' ? 'checked' : '' : '' }} type="radio" name="tugor" value="Buruk"> Buruk
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kulit</td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->kulit == 'Normal' ? 'checked' : '' : '' }} type="radio" name="kulit" value="Normal"> Normal
                                                </td>
                                                <td colspan="4">
                                                    <input {{ $sistem_integumen ? $sistem_integumen->kulit == 'Rash Kemerahan' ? 'checked' : '' : '' }} type="radio" name="kulit" value="Rash Kemerahan"> Rash Kemerahan
                                                    <input {{ $sistem_integumen ? $sistem_integumen->kulit == 'Lesi' ? 'checked' : '' : '' }} style="margin-left: 5%" type="radio" name="kulit" value="Lesi"> Lesi
                                                    <input {{ $sistem_integumen ? $sistem_integumen->kulit == 'Luka' ? 'checked' : '' : '' }} style="margin-left: 5%" type="radio" name="kulit" value="Luka"> Luka
                                                    <input {{ $sistem_integumen ? $sistem_integumen->kulit == 'Memar' ? 'checked' : '' : '' }} style="margin-left: 5%" type="radio" name="kulit" value="Memar"> Memar
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_integumen ? $sistem_integumen->kulit == 'Ptechi' ? 'checked' : '' : '' }} type="radio" name="kulit" value="Ptechi"> Ptechi
                                                </td>
                                                <td colspan="3">
                                                    <input {{ $sistem_integumen ? $sistem_integumen->kulit == 'Bula' ? 'checked' : '' : '' }} type="radio" name="kulit" value="Bula"> Bula
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td>Kriteria Resiko Dekubitus</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->kriteria_resiko_dekubitus == 'Jaringan / Elastisitas Kulit Kurang' ? 'checked' : '' : '' }} name="kriteria_resiko_dekubitus" value="Jaringan / Elastisitas Kulit Kurang">
                                                    Jaringan / Elastisitas Kulit Kurang
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->kriteria_resiko_dekubitus == 'Immobilisasi' ? 'checked' : '' : '' }} name="kriteria_resiko_dekubitus" value="Immobilisasi"> Immobilisasi
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_integumen ? $sistem_integumen->kriteria_resiko_dekubitus == 'di rawat perina / NICU' ? 'checked' : '' : '' }} name="kriteria_resiko_dekubitus" value="di rawat perina / NICU"> 
                                                    di rawat perina / NICU
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="font-style: italic; font-weight: bold">
                                                    (Bila terhadap satu atau lebih kriteria diatas, lakukan pengkajian
                                                    dengan menggunakan formulir pengkajian risiko dekubitus)
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php $sistem_muskuloskeletal = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_peristem->sistem_muskuloskeletal : null; @endphp
                                    <td>Sistem Muskuloskeletal</td>
                                    <td>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td style="width:18%;">Lengan</td>
                                                <td> : </td>
                                                <td style="width: 30%">
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->lengan->value == 'Fleksi' ? 'checked' : '' : '' }} name="lengan" value="Fleksi"> Fleksi
                                                </td>
                                                <td style="width:20%;">
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->lengan->value == 'Ekstensi' ? 'checked' : '' : '' }} name="lengan" value="Ekstensi"> Ekstensi
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->lengan->value == 'Pergerakan Aktif' ? 'checked' : '' : 'checked' }} name="lengan" value="Pergerakan Aktif"> Pergerakan Aktif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->lengan->value == 'Pergerakan Tidak Aktif' ? 'checked' : '' : '' }} name="lengan" value="Pergerakan Tidak Aktif"> Pergerakan Tidak Aktif
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->lengan->value == 'Lain' ? 'checked' : '' : '' }} name="lengan" value="Lain"> 
                                                    <input type="text" id="lengan_lain" value="{{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->lengan->lain : '' }}" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tungkai</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->tungkai->value == 'Fleksi' ? 'checked' : '' : '' }} name="tungkai" value="Fleksi"> Fleksi
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->tungkai->value == 'Ekstensi' ? 'checked' : '' : '' }} name="tungkai" value="Ekstensi"> Ekstensi
                                                </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->tungkai->value == 'Pergerakan Aktif' ? 'checked' : '' : 'checked' }} name="tungkai" value="Pergerakan Aktif"> Pergerakan Aktif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->tungkai->value == 'Pergerakan Tidak Aktif' ? 'checked' : '' : '' }} name="tungkai" value="Pergerakan Tidak Aktif"> Pergerakan Tidak Aktif
                                                </td>
                                                <td colspan="2">
                                                    <input type="radio" {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->tungkai->value == 'Lain' ? 'checked' : '' : '' }} name="tungkai" value="Lain"> 
                                                    <input type="text" value="{{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->tungkai->lain : '' }}" id="tungkai_lain" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rekoil Telinga</td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->rekoil_telinga->value == 'Rekoil Lambat' ? 'checked' : '' : '' }} type="radio" name="rekoil_telinga" value="Rekoil Lambat"> Rekoil Lambat
                                                </td>
                                                <td>
                                                    <input {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->rekoil_telinga->value == 'Rekoil Cepat' ? 'checked' : '' : '' }} type="radio" name="rekoil_telinga" value="Rekoil Cepat"> Rekoil Cepat
                                                </td>
                                                <td>
                                                    <input {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->rekoil_telinga->value == 'Lain' ? 'checked' : '' : '' }} type="radio" name="rekoil_telinga" value="Lain"> 
                                                    <input type="text" id="rekoil_telinga_lain" value="{{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->rekoil_telinga->lain : '' }}" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="tabel_layout">
                                            <tr>
                                                <td style="width: 22%">Garis Telapak Kaki</td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->garis_telapak_kaki == 'Tipis' ? 'checked' : '' : '' }} type="radio" name="garis_telapak_kaki" value="Tipis"> Tipis
                                                </td>
                                                <td>
                                                    <input {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->garis_telapak_kaki == 'Garis Transversal Anterior' ? 'checked' : '' : '' }} type="radio" name="garis_telapak_kaki" value="Garis Transversal Anterior"> Garis Transversal Anterior
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->garis_telapak_kaki == 'Garis 2/3 Anterior' ? 'checked' : '' : '' }} type="radio" name="garis_telapak_kaki" value="Garis 2/3 Anterior"> Garis 2/3 Anterior
                                                </td>
                                                <td>
                                                    <input {{ $sistem_muskuloskeletal ? $sistem_muskuloskeletal->garis_telapak_kaki == 'Seluruh Telapak Kaki' ? 'checked' : '' : '' }} type="radio" name="garis_telapak_kaki" value="Seluruh Telapak Kaki"> Seluruh Telapak Kaki
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        @php $nyeri_a = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_nyeri->a : null; @endphp
                        <td style="width: 3%">8.</td>
                        <td colspan="4">Kenyamanan / Pengkajian Nyeri (Asesmen Nyeri)</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <table class="tabel_layout">
                                <tr>
                                    <td>A.</td>
                                    <td>Nyeri</td>
                                    <td> : </td>
                                    <td>
                                        <input type="radio" {{ $nyeri_a ? $nyeri_a->nyeri->value == 'Tidak Ada' ? 'checked' : '' : '' }} name="nyeri_a"  value="Tidak Ada">
                                        Tidak Ada
                                    </td>
                                    <td colspan="3">
                                        <input type="radio" {{ $nyeri_a ? $nyeri_a->nyeri->value == 'Ada' ? 'checked' : '' : '' }} name="nyeri_a"  value="Ada"> Ada,
                                        Skor Nyeri : <input type="number" value="{{ $nyeri_a ? $nyeri_a->nyeri->skor : '' }}" id="skor_nyeri_a" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Dengan Skala Nyeri</td>
                                    <td> : </td>
                                    <td colspan="4">
                                        <input type="checkbox" {{ $nyeri_a ? $nyeri_a->dengan_skala_nyeri == 1 ? 'checked' : '' : '' }} id="dengan_skala_nyeri_a"  value="FLACCS"> FLACCS
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="6">
                                        <table border="1" style="width: 100%;">
                                            <tr class="text-center">
                                                <td>Pengkajian</td>
                                                <td>0</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>Nilai</td>
                                            </tr>
                                            <tr>
                                                <td>Wajah</td>
                                                <td>Tersenyum / Tidak Ada Ekspresi Khusus</td>
                                                <td>Terkadang Meringis / Menarik Diri</td>
                                                <td>Sering Menggetar Dagu Mmengatupkan Rahang</td>
                                                <td class="text-center">
                                                    <select id="nyeri_wajah">
                                                        <option {{ $nyeri_a ? $nyeri_a->wajah == 0 ? 'selected' : '' : '' }} value="0">0</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->wajah == 1 ? 'selected' : '' : '' }} value="1">1</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->wajah == 2 ? 'selected' : '' : '' }} value="2">2</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kaki</td>
                                                <td>Gerakan Normal / Relaksasi</td>
                                                <td>Tidak Tenang / Tegang</td>
                                                <td>Kaki dibuat Menendang / Menarik Diri</td>
                                                <td class="text-center">
                                                    <select id="nyeri_kaki">
                                                        <option {{ $nyeri_a ? $nyeri_a->kaki == 0 ? 'selected' : '' : '' }} value="0">0</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->kaki == 1 ? 'selected' : '' : '' }} value="1">1</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->kaki == 2 ? 'selected' : '' : '' }} value="2">2</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Aktifitas</td>
                                                <td>Tidur Posisi Noemal, Mudah Bergerak</td>
                                                <td>Gerakan Menggeliat, Berguling, Kaku</td>
                                                <td>Melengkungkang Punggung / Kaki / Menghentak</td>
                                                <td class="text-center">
                                                    <select id="nyeri_aktifitas">
                                                        <option {{ $nyeri_a ? $nyeri_a->aktifitas == 0 ? 'selected' : '' : '' }} value="0">0</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->aktifitas == 1 ? 'selected' : '' : '' }} value="1">1</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->aktifitas == 2 ? 'selected' : '' : '' }} value="2">2</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Menangis</td>
                                                <td>Tidak Menangis (Bangun Tidur)</td>
                                                <td>Mengerang, Merengek-rengek</td>
                                                <td>Menangis Terus Menerus, Terisaak, Menjerit</td>
                                                <td class="text-center">
                                                    <select id="nyeri_menangis">
                                                        <option {{ $nyeri_a ? $nyeri_a->menangis == 0 ? 'selected' : '' : '' }} value="0">0</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->menangis == 1 ? 'selected' : '' : '' }} value="1">1</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->menangis == 2 ? 'selected' : '' : '' }} value="2">2</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bersuara</td>
                                                <td>Bersuara, Normal, Tenang</td>
                                                <td>Tenang Bila dipeluk, digendong, diajak Bicara</td>
                                                <td>Sulit Untuk Menenangkan</td>
                                                <td class="text-center">
                                                    <select id="nyeri_bersuara">
                                                        <option {{ $nyeri_a ? $nyeri_a->bersuara == 0 ? 'selected' : '' : '' }} value="0">0</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->bersuara == 1 ? 'selected' : '' : '' }} value="1">1</option>
                                                        <option {{ $nyeri_a ? $nyeri_a->bersuara == 2 ? 'selected' : '' : '' }} value="2">2</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Skor</td>
                                    <td> : </td>
                                    <td colspan="4">
                                        <input {{ $nyeri_a ? $nyeri_a->skor == 'Nyaman' ? 'checked' : '' : '' }} type="radio" name="hasil_skor_nyeri_a" value="Nyaman"> Nyaman
                                        <input {{ $nyeri_a ? $nyeri_a->skor == '1 - 3 Kurang Nyaman' ? 'checked' : '' : '' }} style="margin-left: 10%;" type="radio" name="hasil_skor_nyeri_a" value="1 - 3 Kurang Nyaman"> 1 - 3 Kurang Nyaman
                                        <input {{ $nyeri_a ? $nyeri_a->skor == '4 - 6 Nyeri Sedang' ? 'checked' : '' : '' }} style="margin-left: 10%;" type="radio" name="hasil_skor_nyeri_a" value="4 - 6 Nyeri Sedang"> 4 - 6 Nyeri Sedang
                                        <input {{ $nyeri_a ? $nyeri_a->skor == '7 - 10 Nyeri Berat' ? 'checked' : '' : '' }} style="margin-left: 10%;" type="radio" name="hasil_skor_nyeri_a" value="7 - 10 Nyeri Berat"> 7 - 10 Nyeri Berat
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Tipe</td>
                                    <td> : </td>
                                    <td>
                                        <input type="radio" {{ $nyeri_a ? $nyeri_a->tipe->value == 'Akut' ? 'checked' : '' : '' }} name="tipe"  value="Akut"> Akut
                                    </td>
                                    <td colspan="3">
                                        <input type="radio" {{ $nyeri_a ? $nyeri_a->tipe->value == 'Kronik' ? 'checked' : '' : '' }} name="tipe"  value="Kronik">
                                        Kronik, deskripsi : <input type="text" value="{{ $nyeri_a ? $nyeri_a->tipe->desc : '' }}" id="desc_tipe" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>                                    
                                    <td>Frekuensi</td>
                                    <td> : </td>
                                    <td>
                                        <input type="radio" {{ $nyeri_a ? $nyeri_a->frekuensi == 'Jarang' ? 'checked' : '' : '' }} name="frekuensi"  value="Jarang"> Jarang
                                    </td>
                                    <td>
                                        <input type="radio" {{ $nyeri_a ? $nyeri_a->frekuensi == 'Hilang Timbul' ? 'checked' : '' : '' }} name="frekuensi" value="Hilang Timbul"> Hilang Timbul
                                    </td>
                                    <td>
                                        <input type="radio" {{ $nyeri_a ? $nyeri_a->frekuensi == 'Terus Menerus' ? 'checked' : '' : '' }} name="frekuensi" value="Terus Menerus"> Terus Menerus
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Lama Nyeri</td>
                                    <td> : </td>
                                    <td colspan="4">
                                        <input type="number" id="lama_nyeri" value="{{ $nyeri_a ? $nyeri_a->lama_nyeri : '' }}" style="width: 95%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="6">
                                        <p style="font-style: italic;">(Jika terdapat nyeri, lakukan observasi lanjutan dengan menggunakan formulir observasai pasien nyeri)</p>
                                    </td>
                                </tr>
                                @php $nyeri_b = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->pengkajian_nyeri->b : null; @endphp
                                <tr>
                                    <td>B.</td>
                                    <td>Nyeri</td>
                                    <td> : </td>
                                    <td>
                                        <input type="radio" {{ $nyeri_b ? $nyeri_b->nyeri->value == 'Tidak Ada' ? 'checked' : '' : '' }} name="nyeri_b" value="Tidak Ada"> Tidak Ada
                                    </td>
                                    <td colspan="3">
                                        <input type="radio" {{ $nyeri_b ? $nyeri_b->nyeri->value == 'Ada' ? 'checked' : '' : '' }} name="nyeri_b" value="Ada"> Ada, Skor <input value="{{ $nyeri_b ? $nyeri_b->nyeri->skor : '' }}" type="number" style="border-radius:5px; border:1px solid lightgrey;" id="skor_nyeri_b">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Dengan Skala Nyeri</td>
                                    <td> : </td>
                                    <td colspan="4">
                                        <input type="checkbox" {{ $nyeri_b ? $nyeri_b->dengan_skala_nyeri == 1 ? 'checked' : '' : '' }} id="dengan_skala_nyeri_b"  value="Wrong Breaker Face Pain Rating Scale"> Wrong Breaker Face Pain Rating Scale
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <img src="{{ str_replace('/index.php', '', url('images/petriadik_nyeri_b.png')) }}" alt="" style="width:50%">
                                    </td>
                                    <td colspan="3">
                                        <table>
                                            <tr>
                                                <td>Lokasi nyeri</td>
                                                <td> : </td>
                                                <td colspan="3">
                                                    <input type="text" value="{{ $nyeri_b ? $nyeri_b->lokasi_nyeri : '' }}" id="lokasi_nyeri" style="border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Skor</td>
                                                <td> : </td>
                                                <td>
                                                    <input type="checkbox" {{ $nyeri_b ? $nyeri_b->numerik->is_checked == 1 ? 'checked' : '' : '' }} id="skor_numerik_b"> Numerik
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="number" value="{{ $nyeri_b ? $nyeri_b->numerik->value : '' }}" id="value_skor_numerik_b" style="border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> : </td>
                                                <td>
                                                    <input type="checkbox" {{ $nyeri_b ? $nyeri_b->wrong_breaker->is_checked == 1 ? 'checked' : '' : '' }} id="skor_wrong_breaker_b"> Wrong Breaker
                                                </td>
                                                <td> : </td>
                                                <td>
                                                    <input type="number" value="{{ $nyeri_b ? $nyeri_b->wrong_breaker->value : '' }}" id="value_wrong_breaker_b" style="border-radius:5px; border:1px solid lightgrey;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">Tingkat Keparahan : </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <table>
                                            <tr>
                                                <td>
                                                    <input type="radio" {{ $nyeri_b ? $nyeri_b->tingkat_keparahan == '0' ? 'checked' : '' : '' }} name="tingkat_keparahan" value="0">
                                                </td>
                                                <td>(0)</td>
                                                <td>Tidak Nyeri</td>
                                                <td>
                                                    <input type="radio" {{ $nyeri_b ? $nyeri_b->tingkat_keparahan == '2-3' ? 'checked' : '' : '' }} name="tingkat_keparahan" value="2-3">
                                                </td>
                                                <td>(2 - 3)</td>
                                                <td>Sedikit Rasa Nyeri</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio" {{ $nyeri_b ? $nyeri_b->tingkat_keparahan == '4-5' ? 'checked' : '' : '' }} name="tingkat_keparahan" value="4-5">
                                                </td>
                                                <td>(4 - 5)</td>
                                                <td>Cukup Nyeri</td>
                                                <td>
                                                    <input type="radio" {{ $nyeri_b ? $nyeri_b->tingkat_keparahan == '6-7' ? 'checked' : '' : '' }} name="tingkat_keparahan" value="6-7">
                                                </td>
                                                <td>(6 - 7)</td>
                                                <td>Lumayan Nyeri</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio" {{ $nyeri_b ? $nyeri_b->tingkat_keparahan == '8-9' ? 'checked' : '' : '' }} name="tingkat_keparahan" value="8-9">
                                                </td>
                                                <td>(8 - 9)</td>
                                                <td>Sangat Nyeri</td>
                                                <td>
                                                    <input type="radio" {{ $nyeri_b ? $nyeri_b->tingkat_keparahan == '10' ? 'checked' : '' : '' }} name="tingkat_keparahan" value="10">
                                                </td>
                                                <td>(10)</td>
                                                <td>Nyeri Amat Nyeri</td>
                                            </tr>
                                        </table>                                        
                                    </td>
                                    <td colspan="3">
                                        Jenis : <input type="radio" {{ $nyeri_b ? $nyeri_b->jenis == 'akut' ? 'checked' : '' : '' }} name="jenis_nyeri" value="akut"> Akut <input class="ml-5" type="radio" {{ $nyeri_b ? $nyeri_b->jenis == 'kronis' ? 'checked' : '' : '' }} name="jenis_nyeri" value="kronis"> Kronis
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Faktor yang memperburuk Rasa Nyeri</td>
                                    <td colspan="4">
                                        <table style="width: 50%;">
                                            <tr>
                                                <td> : <input {{ $nyeri_b ? $nyeri_b->faktor->value == 'cahaya' ? 'checked' : '' : '' }} type="radio" name="faktor_nyeri_b" value="cahaya"> Cahaya</td>
                                                <td><input {{ $nyeri_b ? $nyeri_b->faktor->value == 'gelap' ? 'checked' : '' : '' }} type="radio" name="faktor_nyeri_b" value="gelap"> Gelap</td>
                                                <td><input {{ $nyeri_b ? $nyeri_b->faktor->value == 'gerakan' ? 'checked' : '' : '' }} type="radio" name="faktor_nyeri_b" value="gerakan"> Gerakan</td>
                                                <td><input {{ $nyeri_b ? $nyeri_b->faktor->value == 'berbaring' ? 'checked' : '' : '' }} type="radio" name="faktor_nyeri_b" value="berbaring"> Berbaring</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"> : <input {{ $nyeri_b ? $nyeri_b->faktor->value == 'lainnya' ? 'checked' : '' : '' }} type="radio" name="faktor_nyeri_b" value="lainnya"> Lainnya <input type="text" value="{{ $nyeri_b ? $nyeri_b->faktor->lain : '' }}" id="faktor_nyeri_b_lain" style="border-radius:5px; border:1px solid lightgrey;"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Rasa Nyeri Seperti</td>
                                    <td colspan="4">
                                        <table style="width: 50%;">
                                            <tr>
                                                <td> : <input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'ditusuk' ? 'checked' : '' : '' }} name="rasa_nyeri" value="ditusuk"> Ditusuk</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'dipukul' ? 'checked' : '' : '' }} name="rasa_nyeri" value="dipukul"> Dipukul</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'berdenyut' ? 'checked' : '' : '' }} name="rasa_nyeri" value="berdenyut"> Berdenyut</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'ditikam' ? 'checked' : '' : '' }} name="rasa_nyeri" value="ditikam"> Ditikam</td>
                                            </tr>
                                            <tr>
                                                <td> : <input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'kram' ? 'checked' : '' : '' }} name="rasa_nyeri" value="kram"> Kram</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'ditarik' ? 'checked' : '' : '' }} name="rasa_nyeri" value="ditarik"> Ditarik</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'dibakar' ? 'checked' : '' : '' }} name="rasa_nyeri" value="dibakar"> Dibakar</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->rasa_nyeri == 'tajam' ? 'checked' : '' : '' }} name="rasa_nyeri" value="tajam"> Tajam</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Nyeri Menjalar ke Bagian Tubuh yang lain</td>
                                    <td colspan="4">
                                        <table style="width: 25%;">
                                            <tr>
                                                <td> : <input type="radio" {{ $nyeri_b ? $nyeri_b->menjalar == 'tidak' ? 'checked' : '' : '' }} name="menjalar" value="tidak"> Tidak</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->menjalar == 'ya' ? 'checked' : '' : '' }} name="menjalar" value="ya"> Ya</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Nyeri Berlangsung</td>
                                    <td colspan="4">
                                        <table style="width: 30%;">
                                            <tr>
                                                <td> : <input type="radio" {{ $nyeri_b ? $nyeri_b->berlangsung == 'terus_menerus' ? 'checked' : '' : '' }} name="berlangsung" value="terus_menerus"> Terus Menerus</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->berlangsung == 'hilang_timbul' ? 'checked' : '' : '' }} name="berlangsung" value="hilang_timbul"> Hilang Timbul</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Lama</td>
                                    <td colspan="4">
                                        <table style="width: 30%;">
                                            <tr>
                                                <td> : <input type="radio" {{ $nyeri_b ? $nyeri_b->lama_nyeri_b == '<30' ? 'checked' : '' : '' }} name="lama_nyeri_b" value="<30"> {{'< 30 menit'}}</td>
                                                <td><input type="radio" {{ $nyeri_b ? $nyeri_b->lama_nyeri_b == '>30' ? 'checked' : '' : '' }} name="lama_nyeri_b" value=">30"> {{'> 30 menit'}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @php $riwayat_prenatal = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->riwayat_prenatal : null; @endphp
                    <tr>
                        <td style="width: 3%">9.</td>
                        <td colspan="4">Riwayat Prenatal : </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="pl-4">
                            <table class="tabel_layout">
                                <tr>
                                    <td style="width: 3%">a.</td>
                                    <td>Lama Kehamilan</td>
                                    <td>
                                        <input {{ $riwayat_prenatal ? $riwayat_prenatal->lama_kehamilan == 'Cukup Bulan' ? 'checked' : '' : 'checked' }} type="radio" name="lama_kehamilan" value="Cukup Bulan"> Cukup Bulan
                                    </td>
                                    <td>
                                        <input {{ $riwayat_prenatal ? $riwayat_prenatal->lama_kehamilan == 'Kurang Bulan' ? 'checked' : '' : '' }} type="radio" name="lama_kehamilan" value="Kurang Bulan"> Kurang Bulan
                                    </td>
                                </tr>
                                <tr>
                                    <td>b.</td>
                                    <td>Komplikasi</td>
                                    <td>
                                        <input {{ $riwayat_prenatal ? $riwayat_prenatal->komplikasi->value == 'Tidak' ? 'checked' : '' : 'checked' }} type="radio" name="komplikasi" value="Tidak">
                                        Tidak
                                    </td>
                                    <td>
                                        <input {{ $riwayat_prenatal ? $riwayat_prenatal->komplikasi->value == 'Ya' ? 'checked' : '' : '' }} type="radio" name="komplikasi" value="Ya">
                                        Ya, Sebutkan <input type="text" value="{{ $riwayat_prenatal ? $riwayat_prenatal->komplikasi->desc : '' }}" id="desc_komplikasi" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>c.</td>
                                    <td>Masalah Neonatus</td>
                                    <td>
                                        <input {{ $riwayat_prenatal ? $riwayat_prenatal->masalah_neonatus->value == 'Tidak' ? 'checked' : '' : 'checked' }} type="radio" name="masalah_neonatus" value="Tidak"> Tidak
                                    </td>
                                    <td>
                                        <input {{ $riwayat_prenatal ? $riwayat_prenatal->masalah_neonatus->value == 'Ya' ? 'checked' : '' : '' }} type="radio" name="masalah_neonatus" value="Ya"> Ya, Sebutkan <input type="text" value="{{ $riwayat_prenatal ? $riwayat_prenatal->masalah_neonatus->desc : '' }}" id="desc_masalah_neonatus" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>d.</td>
                                    <td>Masalah Maternal</td>
                                    <td>
                                        <input type="radio" {{ $riwayat_prenatal ? $riwayat_prenatal->masalah_maternal->value == 'Tidak' ? 'checked' : '' : 'checked' }} name="masalah_maternal" value="Tidak"> Tidak
                                    </td>
                                    <td>
                                        <input type="radio" {{ $riwayat_prenatal ? $riwayat_prenatal->masalah_maternal->value == 'Ya' ? 'checked' : '' : '' }} name="masalah_maternal" value="Ya"> Ya, Sebutkan <input type="text" value="{{ $riwayat_prenatal ? $riwayat_prenatal->masalah_maternal->desc : '' }}" id="desc_masalah_maternal" style="width: 70%; border-radius:5px; border:1px solid lightgrey;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @php $riwayat_tumbuh_kembang = $pemeriksaan_fisik_p ? $pemeriksaan_fisik_p->riwayat_tumbuh_kembang : ['','','','','','','','','','']; @endphp
                    <tr>
                        <td style="width: 3%">10.</td>
                        <td colspan="4">Riwayat Tumbuh Kembang </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="pl-4">
                            <table class="tabel_layout">
                                <tr>
                                    <td style="width: 3%">a.</td>
                                    <td style="width: 30%">BB Anak Saat Lahir</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[0]) ? $riwayat_tumbuh_kembang[0] : '' }}" type="text" id="bb_anak_saat_lahir" style="width: 80%; border-radius:5px; border:1px solid lightgrey;"> Gr
                                    </td>
                                </tr>
                                <tr>
                                    <td>b.</td>
                                    <td>PB Anak Saat Lahir</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[1]) ? $riwayat_tumbuh_kembang[1] : '' }}" type="text" id="pb_anak_saat_lahir" style="width: 80%; border-radius:5px; border:1px solid lightgrey;"> Cm
                                    </td>
                                </tr>
                                <tr>
                                    <td>c.</td>
                                    <td>Asi Sampai Umur</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[2]) ? $riwayat_tumbuh_kembang[2] : '' }}" type="text" id="asi_sampai_umur" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                                <tr>
                                    <td>d.</td>
                                    <td>Susu Formula dimulai</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[3]) ? $riwayat_tumbuh_kembang[3] : '' }}" type="text" id="susu_formula_dimulai" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                                <tr>
                                    <td>e.</td>
                                    <td>Makanan Padat dimulai</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[4]) ? $riwayat_tumbuh_kembang[4] : '' }}" type="text" id="makanan_padat_dimulai" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                                <tr>
                                    <td>f.</td>
                                    <td>Makanan Tambahan Mulai Umur</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[5]) ? $riwayat_tumbuh_kembang[5] : '' }}" type="text" id="makanan_tambahan_mulai_umur" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                                <tr>
                                    <td>g.</td>
                                    <td>Tengkurap</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[6]) ? $riwayat_tumbuh_kembang[6] : '' }}" type="text" id="tengkurap" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                                <tr>
                                    <td>h.</td>
                                    <td>Duduk</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[7]) ? $riwayat_tumbuh_kembang[7] : '' }}" type="text" id="duduk" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                                <tr>
                                    <td>i.</td>
                                    <td>Berdiri</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[8]) ? $riwayat_tumbuh_kembang[8] : '' }}" type="text" id="berdiri" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                                <tr>
                                    <td>j.</td>
                                    <td>Berjalan</td>
                                    <td> : </td>
                                    <td>
                                        <input value="{{ isset($riwayat_tumbuh_kembang[9]) ? $riwayat_tumbuh_kembang[9] : '' }}" type="text" id="berjalan" style="width: 80%; border-radius:5px; border:1px solid lightgrey;">
                                        Bln/Thn
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 3%">11.</td>
                        <td colspan="4">Riwayat Imunisasi </td>
                    </tr>
                    <tr>
                        <td colspan="5" id="box_tabel_imunisasi">

                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5>III. Spiritual</h5>
                <input type="hidden" name="spiritual">
                @php
                    $spiritual = $petriadik ? json_decode($petriadik->spiritual) : null;
                @endphp
                <table class="tabel_layout">
                    <tr>
                        <td style="width: 3%">1.</td>
                        <td>Agama</td>
                        <td> : </td>
                        <td>
                            <input type="radio" value="Islam" {{ $spiritual ? $spiritual->agama->value == 'Islam' ? 'checked' : '' : '' }} name="agama_spiritual"> Islam
                        </td>
                        <td>
                            <input type="radio" value="Protestan" {{ $spiritual ? $spiritual->agama->value == 'Protestan' ? 'checked' : '' : '' }} name="agama_spiritual"> Protestan
                        </td>
                        <td>
                            <input type="radio" value="Katolik" {{ $spiritual ? $spiritual->agama->value == 'Katolik' ? 'checked' : '' : '' }} name="agama_spiritual"> Katolik
                        </td>
                        <td>
                            <input type="radio" value="Hindu" {{ $spiritual ? $spiritual->agama->value == 'Hindu' ? 'checked' : '' : '' }} name="agama_spiritual"> Hindu
                        </td>
                        <td>
                            <input type="radio" value="Budha" {{ $spiritual ? $spiritual->agama->value == 'Budha' ? 'checked' : '' : '' }} name="agama_spiritual"> Budha
                        </td>
                        <td>
                            <input type="radio" value="Lain" {{ $spiritual ? $spiritual->agama->value == 'Lain' ? 'checked' : '' : '' }} name="agama_spiritual"> <input type="text" name="agama_spiritual_input" value="{{ $spiritual ? $spiritual->agama->lain : '' }}"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td colspan="8">
                            Mengungkapkan keprihatinan yang berhubungan dengan rawat inap :
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="radio" name="mengungkapkan_spiritual" {{ $spiritual ? $spiritual->mengungkapkan->value == 'tidak' ? 'checked' : '' : ''  }} value="tidak"> Tidak
                            <input type="radio" class="ml-3" name="mengungkapkan_spiritual" {{ $spiritual ? $spiritual->mengungkapkan->value == 'ya' ? 'checked' : '' : ''  }} value="ya"> Ya
                        </td>
                        <td colspan="7">
                            : <input type="radio" {{ $spiritual ? $spiritual->mengungkapkan->yes == 'Ketidakmampuan untuk mempertahankan praktek spiritual seperti biasa' ? 'checked' : '' : '' }} value="Ketidakmampuan untuk mempertahankan praktek spiritual seperti biasa" class="ml-2" name="mengungkapkan_spiritual_ya" > Ketidakmampuan untuk mempertahankan praktek spiritual seperti biasa<br>
                            : <input type="radio" {{ $spiritual ? $spiritual->mengungkapkan->yes == 'Perasaan negatif tentang sistem kepercayaan terhadap spiritual' ? 'checked' : '' : '' }} value="Perasaan negatif tentang sistem kepercayaan terhadap spiritual" class="ml-2" name="mengungkapkan_spiritual_ya" > Perasaan negatif tentang sistem kepercayaan terhadap spiritual<br>
                            : <input type="radio" {{ $spiritual ? $spiritual->mengungkapkan->yes == 'Konflik antara kepercayaan spiritual dengan ketentuan sistem kesehatan' ? 'checked' : '' : '' }} value="Konflik antara kepercayaan spiritual dengan ketentuan sistem kesehatan" class="ml-2" name="mengungkapkan_spiritual_ya" > Konflik antara kepercayaan spiritual dengan ketentuan sistem kesehatan<br>
                            : <input type="radio" {{ $spiritual ? $spiritual->mengungkapkan->yes == 'Bimbingan Rohani' ? 'checked' : '' : '' }} value="Bimbingan Rohani" class="ml-2" name="mengungkapkan_spiritual_ya" > Bimbingan Rohani<br>
                            : <input type="radio" {{ $spiritual ? $spiritual->mengungkapkan->yes == 'Lain - lain' ? 'checked' : '' : '' }} value="Lain - lain" class="ml-2" name="mengungkapkan_spiritual_ya" > Lain - lain : <input type="text" value="{{ $spiritual ? $spiritual->mengungkapkan->lain : '' }}" name="mengungkapkan_spiritual_ya_input"  style="border-radius:5px; width:80%; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5>IV. Status Psikologis (Orang Tua)</h5>
                <input type="hidden" name="status_psikologis">
                @php
                    $sp = $petriadik ? json_decode($petriadik->status_psikologis) : null;
                @endphp
                <table class="tabel_layout">
                    <tr>
                        <td>
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'tenang' ? 'checked' : '' : 'checked' }}  value="tenang"> Tenang
                        </td>
                        <td>
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'cemas' ? 'checked' : '' : '' }}  value="cemas"> Cemas
                        </td>
                        <td>
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'sedih' ? 'checked' : '' : '' }}  value="sedih"> Sedih
                        </td>
                        <td>
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'depresi' ? 'checked' : '' : '' }}  value="depresi"> Depresi
                        </td>
                        <td>
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'marah' ? 'checked' : '' : '' }}  value="marah"> Marah
                        </td>
                        <td>
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'hiperaktif' ? 'checked' : '' : '' }}  value="hiperaktif"> Hiperaktif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'mengganggu_sekitar' ? 'checked' : '' : '' }}  value="mengganggu_sekitar"> Mengganggu Sekitar
                        </td>
                        <td colspan="5">
                            <input type="radio" name="status_psikologis" {{ $sp ? $sp->value == 'lain' ? 'checked' : '' : '' }}  value="lain"> <input type="text" value="{{ $sp ? $sp->lain : '' }}" name="status_psikologis_input"  style="border-radius:5px; width:80%; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5>V. Kebutuhan Komunikasi / Pendidikan dan Pengajaran Orang Tua</h5>
                <input type="hidden" name="kebutuhan_komunikasi">
                @php
                    $kk = $petriadik ? json_decode($petriadik->kebutuhan_komunikasi) : null;
                @endphp
                <table class="tabel_layout">
                    <tr>
                        <td style="width: 17%">Bicara</td>
                        <td style="width: 3%"> : </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->bicara == 'normal' ? 'checked' : '' : 'checked' }} name="bicara"  value="normal"> Normal
                        </td>
                        <td colspan="3">
                            <input type="radio" {{ $kk ? $kk->bicara == 'tidak_ada_gangguan' ? 'checked' : '' : '' }} name="bicara"  value="tidak_ada_gangguan"> Tidak Ada Gangguan : <input type="text" value="{{ $kk ? $kk->bicara_input : '' }}" name="bicara_input"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>Bahasa Sehari-hari</td>
                        <td> : </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->bahasa == 'indonesia' ? 'checked' : '' : 'checked' }} name="bahasa_sehari_hari"  value="indonesia"> Indonesia
                        </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->bahasa == 'daerah' ? 'checked' : '' : '' }} name="bahasa_sehari_hari"  value="daerah"> Daerah : <input type="text" value="{{ $kk ? $kk->daerah_input : '' }}" name="daerah_input"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->bahasa == 'inggris' ? 'checked' : '' : '' }} name="bahasa_sehari_hari"  value="inggris"> Inggris aktif/pasif*
                        </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->bahasa == 'lain' ? 'checked' : '' : '' }} name="bahasa_sehari_hari"  value="lain"> <input type="text" value="{{ $kk ? $kk->bahasa_input : '' }}" name="bahasa_sehari_hari_input"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>Penerjemah</td>
                        <td> : </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->penerjemah == 'tidak' ? 'checked' : '' : 'checked' }} name="penerjemah"  value="tidak"> Tidak
                        </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->penerjemah == 'ya' ? 'checked' : '' : '' }} name="penerjemah"  value="ya"> Ya, Bahasa : <input value="{{ $kk ? $kk->bahasa_penerjemah : '' }}" type="text" name="bahasa_penerjemah_input"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->penerjemah == 'isyarat' ? 'checked' : '' : '' }} name="penerjemah"  value="isyarat"> Bahasa Isyarat : Ya / Tidak*
                        </td>
                    </tr>
                    <tr>
                        <td>Masalah Penglihatan</td>
                        <td> : </td>
                        <td>
                            <input type="radio" {{ $kk ? $kk->masalah_penglihatan == 'tidak' ? 'checked' : '' : 'checked' }} name="masalah_penglihatan"  value="tidak"> Tidak
                        </td>
                        <td colspan="3">
                            <input type="radio" {{ $kk ? $kk->masalah_penglihatan == 'ya' ? 'checked' : '' : '' }} name="masalah_penglihatan"  value="ya"> Ya, Sebutkan <input type="text" name="masalah_penglihatan_input" value="{{ $kk ? $kk->masalah_penglihatan_input : '' }}" style="width:80%; border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>Pendidikan Penanggung Jawab</td>
                        <td> : </td>
                        <td colspan="4">
                            <input type="radio" {{ $kk ? $kk->pendidikan == 'sd' ? 'checked' : '' : '' }} name="pendidikan_pj"  value="sd"> SD
                            <input type="radio" {{ $kk ? $kk->pendidikan == 'smp' ? 'checked' : '' : '' }} name="pendidikan_pj"  value="smp" class="ml-3"> SMP
                            <input type="radio" {{ $kk ? $kk->pendidikan == 'slta' ? 'checked' : '' : '' }} name="pendidikan_pj"  value="slta" class="ml-3"> SLTA
                            <input type="radio" {{ $kk ? $kk->pendidikan == 'akademi' ? 'checked' : '' : '' }} name="pendidikan_pj"  value="akademi" class="ml-3"> Akademi/PT
                            <input type="radio" {{ $kk ? $kk->pendidikan == 'pasca_sarjana' ? 'checked' : '' : '' }} name="pendidikan_pj"  value="pasca_sarjana" class="ml-3"> Pasca Sarjana
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Pasien atau keluarga menginginkan infomasi tentang : 
                            <input type="radio" {{ $kk ? $kk->menginginkan_informasi == 'proses_penyakit' ? 'checked' : '' : "checked" }} name="menginginkan_informasi"  value="proses_penyakit" class="ml-3"> Proses Penyakit
                            <input type="radio" {{ $kk ? $kk->menginginkan_informasi == 'terapi_obat' ? 'checked' : '' : "" }} name="menginginkan_informasi"  value="terapi_obat" class="ml-5"> Terapi / Obat
                            <input type="radio" {{ $kk ? $kk->menginginkan_informasi == 'nutrisi_gizi' ? 'checked' : '' : "" }} name="menginginkan_informasi"  value="nutrisi_gizi" class="ml-5"> Nutrisi / Gizi
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> : </td>
                        <td colspan="4">
                            <input type="radio" {{ $kk ? $kk->menginginkan_informasi == 'penggunaan_alat_medis' ? 'checked' : '' : "" }} name="menginginkan_informasi"  value="penggunaan_alat_medis"> Penggunaan Alat Medis
                            <input type="radio" {{ $kk ? $kk->menginginkan_informasi == 'tindakan' ? 'checked' : '' : "" }} name="menginginkan_informasi"  value="tindakan" class="ml-5"> Tindakan
                            <input type="radio" {{ $kk ? $kk->menginginkan_informasi == 'lain' ? 'checked' : '' : "" }} name="menginginkan_informasi"  value="lain" class="ml-5"> <input type="text" name="menginginkan_informasi_input" value="{{ $kk ? $kk->menginginkan_informasi_input : '' }}" style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                @php
                    $kpot = $petriadik ? json_decode($petriadik->kebutuhan_privasi_orang_tua) : null;
                @endphp
                <h5>VIII. Kebutuhan Privasi Orang Tua : <input type="radio" {{ $kpot ? $kpot->value == 'ya' ? 'checked' : '' : 'checked' }} name="kebutuhan_privasi_orang_tua" value="ya"> Ya <input type="radio" class="ml-4" {{ $kpot ? $kpot->value == 'tidak' ? 'checked' : '' : '' }} name="kebutuhan_privasi_orang_tua" value="tidak"> Tidak</h5>
                <input type="hidden" name="kebutuhan_privasi_orang_tua">
                <p>
                    <input type="checkbox" {{ $kpot ? $kpot->list->keinginan ? 'checked' : '' : 'checked' }} id="kebutuhan_privasi_ortu_keinginan_waktu"> Keinginan waktu / tempat khusus saat wawancara & tindakan : <input type="text" value="{{ $kpot ? $kpot->list->keinginan_input : '' }}" id="kebutuhan_privasi_ortu_keinginan_waktu_input" style="width:40%; border-radius:5px; border:1px solid lightgrey;">
                </p>
                <p>
                    <input type="checkbox" {{ $kpot ? $kpot->list->pengobatan ? 'checked' : '' : '' }} id="kebutuhan_privasi_ortu_pengobatan"> Pengobatan
                    <input type="checkbox" {{ $kpot ? $kpot->list->kondisi_penyakit ? 'checked' : '' : 'checked' }} id="kebutuhan_privasi_ortu_kondisi_penyakit" class="ml-4"> Kondisi Penyakit
                    <input type="checkbox" {{ $kpot ? $kpot->list->transportasi ? 'checked' : '' : '' }} id="kebutuhan_privasi_ortu_transportasi" class="ml-4"> Transportasi
                    <input type="checkbox" {{ $kpot ? $kpot->list->lain ? 'checked' : '' : '' }} id="kebutuhan_privasi_ortu_lain" class="ml-4"> <input value="{{ $kpot ? $kpot->list->lain_input : '' }}" type="text" id="kebutuhan_privasi_ortu_lain_input" style="width:40%; border-radius:5px; border:1px solid lightgrey;">
                </p>
            </div>
            <div class="col-md-12 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5 class="text-center">SKRINING GIZI OLEH PERAWATAN</h5>
                <input type="hidden" name="skrining_gizi">
                @php
                    $sg = $petriadik ? json_decode($petriadik->skrining_gizi) : null;
                @endphp
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <table class="tabel_layout">
                    <tr>
                        <td>1.</td>
                        <td>Masalah</td>
                        <td>
                            : <input type="radio" name="masalah_skrining_gizi" {{ $sg ? $sg->masalah == 'ada' ? 'checked' : '' : '' }} value="ada"> Ada Scoring (1)
                        </td>
                        <td>
                            <input type="radio" name="masalah_skrining_gizi" {{ $sg ? $sg->masalah == 'tidak_ada' ? 'checked' : '' : 'checked' }} value="tidak_ada"> Tidak Ada Scoring (0)
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Penuruanan Nafsu Makan</td>
                        <td>
                            : <input type="radio" name="penurunan_nafsu_makan_skrining_gizi" {{ $sg ? $sg->penurunan_nafsu_makan == '0' ? 'checked' : '' : '' }}  value="0"> Tidak (0)
                        </td>
                        <td>
                            <input type="radio" name="penurunan_nafsu_makan_skrining_gizi" {{ $sg ? $sg->penurunan_nafsu_makan == '1' ? 'checked' : '' : '' }}  value="1"> Ya (1)
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Penuruanan BB 6 Bulang Terakhir > 10%</td>
                        <td>
                            : <input type="radio" name="penurunan_bb_skrining_gizi" {{ $sg ? $sg->penurunan_bb == '0' ? 'checked' : '' : '' }}  value="0"> Tidak (0)
                        </td>
                        <td>
                            <input type="radio" name="penurunan_bb_skrining_gizi" {{ $sg ? $sg->penurunan_bb == '1' ? 'checked' : '' : '' }}  value="1"> Ya (1)
                        </td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td colspan="3">Penyakit / kelainan yang menyertai pasien jika ada salah satu atau lebih scoringnya (2)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">
                            <input type="checkbox" {{ $sg ? $sg->penyakit->sepsis ? 'checked' : "" : '' }} id="sepsis"> Sepsis
                            <input type="checkbox" {{ $sg ? $sg->penyakit->jantung ? 'checked' : "" : '' }} class="ml-3" id="jantung"> Jantung
                            <input type="checkbox" {{ $sg ? $sg->penyakit->bblr ? 'checked' : "" : '' }} class="ml-3" id="bblr"> BBLR
                            <input type="checkbox" {{ $sg ? $sg->penyakit->hypoglikemia ? 'checked' : "" : '' }} class="ml-3" id="hypoglikemia"> Hypoglikemia
                            <input type="checkbox" {{ $sg ? $sg->penyakit->diarhoe ? 'checked' : "" : '' }} class="ml-3" id="diarhoe"> Diarhoe
                            <input type="checkbox" {{ $sg ? $sg->penyakit->lain ? 'checked' : "" : '' }} class="ml-3" id="lain"> <input value="{{ $sg ? $sg->penyakit->lain_input : '' }}" type="text" name="penyakit_kelainan_skrining_gizi_input"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Total Skor</td>
                        <td> : </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jika ≤ 2</td>
                        <td colspan="2">
                             : 
                            <input type="checkbox" {{ $sg ? $sg->less_two->diet ? 'checked' : "" : '' }} id="diet_yg_diberikan_skrining_gizi"> Diet yg diberikan
                            <input type="checkbox" {{ $sg ? $sg->less_two->asi ? 'checked' : "" : '' }} class="ml-5" id="asi_skrining_gizi"> ASI
                            <input type="checkbox" {{ $sg ? $sg->less_two->pasi ? 'checked' : "" : '' }} class="ml-5" id="pasi_skrining_gizi"> PASI
                            <input type="checkbox" {{ $sg ? $sg->less_two->per_oral ? 'checked' : "" : '' }} class="ml-5" id="per_oral_skrining_gizi"> Per Oral/NGT
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jika ≥ 2</td>
                        <td colspan="2">
                            : 
                           <input type="checkbox" {{ $sg ? $sg->more_two->dpjp ? 'checked' : "" : '' }} id="lapor_dpjp_skrining_gizi"> Lapor DPJP
                           <input type="checkbox" {{ $sg ? $sg->more_two->asesmen_lanjutan ? 'checked' : "" : '' }} class="ml-5" id="asesmen_lanjutan_skrining_gizi"> Asesmen Lanjutan Oleh Ahli Gizi
                       </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5 class="text-center">DAFTAR MASALAH KEPERAWATAN</h5>
                @php
                    $dmk = $petriadik ? json_decode($petriadik->daftar_masalah_keperawatan) : null;
                @endphp
                <input type="hidden" name="daftar_masalah_keperawatan">
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <table class="tabel_layout">
                    <tr>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->nyeri ? 'checked' : '' : '' }} id="nyeri_daftar_masalah_keperawatan"> Nyeri
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->keselamatan ? 'checked' : '' : '' }} id="keselamatan_pasien_daftar_masalah_keperawatan"> Keselamatan Pasien
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->tumbuh_kembang ? 'checked' : '' : '' }} id="tumbuh_kembang_daftar_masalah_keperawatan"> Tumbuh Kembang
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->nutrisi ? 'checked' : '' : '' }} id="nutrisi_daftar_masalah_keperawatan"> Nutrisi
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->peningkatan_billirubin ? 'checked' : '' : '' }} id="peningkatan_billirubin_daftar_masalah_keperawatan"> Peningkatan Billirubin
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->suhu_tubuh ? 'checked' : '' : '' }} id="suhu_tubuh_daftar_masalah_keperawatan"> Suhu Tubuh
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->mobilitas_aktivitas ? 'checked' : '' : '' }} id="mobilitas_aktivitas__daftar_masalah_keperawatan"> Mobilitas / Aktivitas
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->eliminasi ? 'checked' : '' : '' }} id="eliminasi_daftar_masalah_keperawatan"> Eliminasi
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->perfusi_jaringan ? 'checked' : '' : '' }} id="perfusi_jaringan_daftar_masalah_keperawatan"> Perfusi Jaringan
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->integritas_kulit ? 'checked' : '' : '' }} id="integritas_kulit_daftar_masalah_keperawatan"> Integritas Kulit
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->pengetahuan_komunikasi ? 'checked' : '' : '' }} id="pengetahuan_komunikasi_daftar_masalah_keperawatan"> Pengetahuan / Komunikasi
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->konflik_peran ? 'checked' : '' : '' }} id="konflik_peran_daftar_masalah_keperawatan"> Konflik Peran
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->perawatan_diri ? 'checked' : '' : '' }} id="perawatan_diri_daftar_masalah_keperawatan"> Perawatan Diri
                        </td>
                        <td colspan="2">
                            <input type="checkbox" {{ $dmk ? $dmk->keseimbangan_cairan ? 'checked' : '' : '' }} id="keseimbangan_cairan_daftar_masalah_keperawatan"> Keseimbangan Cairan dan Elektrolit
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->jalan_nafas ? 'checked' : '' : '' }} id="jalan_nafas_daftar_masalah_keperawatan"> Jalan Nafas / Pertukaran Gas
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->infeksi ? 'checked' : '' : '' }} id="infeksi_daftar_masalah_keperawatan"> Infeksi
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->pola_nafas ? 'checked' : '' : '' }} id="pola_nafas_daftar_masalah_keperawatan"> Pola Nafas
                        </td>
                        <td>
                            <input type="checkbox" {{ $dmk ? $dmk->lain ? 'checked' : '' : '' }} id="lain_daftar_masalah_keperawatan"> <input type="text" value="{{ $dmk ? $dmk->lain_input : '' }}" id="daftar_masalah_keperawatan_input" style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5 class="text-center">RENCANA KEPERAWATAN</h5>
                <input type="hidden" name="rencana_keperawatan">
            </div>
            @php
                $rencana_keperawatan = $petriadik ? json_decode($petriadik->rencana_keperawatan) : [];
            @endphp
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <ul style="list-style-type: numeric">
                    @for ($i = 0; $i < 7; $i++)
                        <li class="mb-1">
                            <input type="text" id="rencana_keperawatan_{{$i}}" class="form-control" value="{{ isset($rencana_keperawatan[$i]) ? $rencana_keperawatan[$i] : '' }}">
                        </li>
                    @endfor
                </ul>
            </div>
            <div class="col-md-12 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5 class="text-center">PERENCANAAN PERAWATAN INTERDISIPLIN / REFERAL</h5>
                @php
                    $ppi = $petriadik ? json_decode($petriadik->perencanaan_perawatan) : null;
                @endphp
                <input type="hidden" name="perencanaan_perawatan">
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <table class="tabel_layout">
                    <tr>
                        <td style="width:3%">1.</td>
                        <td style="width: 15%">Diet dan Nutrisi</td>
                        <td>
                            : <input type="radio" {{ $ppi ? $ppi->diet_nutrisi->value == 'Tidak' ? 'checked' : '' : '' }} name="diet_nutrisi_perencanaan_perawatan"  value="Tidak"> Tidak
                        </td>
                        <td>
                            <input type="radio" {{ $ppi ? $ppi->diet_nutrisi->value == 'Ya' ? 'checked' : '' : '' }} name="diet_nutrisi_perencanaan_perawatan"  value="Ya"> Ya : <input type="text" name="diet_nutrisi_perencanaan_perawatan_input" value="{{ $ppi ? $ppi->diet_nutrisi->input : '' }}" style="border-radius:5px; border:1px solid lightgrey; width:80%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">2.</td>
                        <td>Rehabilitasi Medik</td>
                        <td>
                            : <input type="radio" {{ $ppi ? $ppi->rehabilitasi_medik->value == 'Tidak' ? 'checked' : '' : '' }} name="rehabilitasi_medik_perencanaan_perawatan"  value="Tidak"> Tidak
                        </td>
                        <td>
                            <input type="radio" {{ $ppi ? $ppi->rehabilitasi_medik->value == 'Ya' ? 'checked' : '' : '' }} name="rehabilitasi_medik_perencanaan_perawatan"  value="Ya"> Ya : <input type="text" value="{{ $ppi ? $ppi->rehabilitasi_medik->input : '' }}" name="rehabilitasi_medik_perencanaan_perawatan_input"  style="border-radius:5px; border:1px solid lightgrey; width:80%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">3.</td>
                        <td>Farmasi</td>
                        <td>
                            : <input type="radio" {{ $ppi ? $ppi->farmasi->value == 'Tidak' ? 'checked' : '' : '' }} name="farmasi_perencanaan_perawatan"  value="Tidak"> Tidak
                        </td>
                        <td>
                            <input type="radio" {{ $ppi ? $ppi->farmasi->value == 'Ya' ? 'checked' : '' : '' }} name="farmasi_perencanaan_perawatan"  value="Ya"> Ya : <input type="text" value="{{ $ppi ? $ppi->farmasi->input : '' }}" name="farmasi_perencanaan_perawatan_input"  style="border-radius:5px; border:1px solid lightgrey; width:80%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">4.</td>
                        <td>Perawatan Luka</td>
                        <td>
                            : <input type="radio" {{ $ppi ? $ppi->perawatan_luka->value == 'Tidak' ? 'checked' : '' : '' }} name="perawatan_luka_perencanaan_perawatan"  value="Tidak"> Tidak
                        </td>
                        <td>
                            <input type="radio" {{ $ppi ? $ppi->perawatan_luka->value == 'Ya' ? 'checked' : '' : '' }} name="perawatan_luka_perencanaan_perawatan"  value="Ya"> Ya : <input type="text" value="{{ $ppi ? $ppi->perawatan_luka->input : '' }}" name="perawatan_luka_perencanaan_perawatan_input"  style="border-radius:5px; border:1px solid lightgrey; width:80%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:3%">5.</td>
                        <td>Managemen Nyeri</td>
                        <td>
                            : <input type="radio" {{ $ppi ? $ppi->managemen_nyeri->value == 'Tidak' ? 'checked' : '' : '' }} name="managemen_nyeri_perencanaan_perawatan"  value="Tidak"> Tidak
                        </td>
                        <td>
                            <input type="radio" {{ $ppi ? $ppi->managemen_nyeri->value == 'Ya' ? 'checked' : '' : '' }} name="managemen_nyeri_perencanaan_perawatan"  value="Ya"> Ya : <input type="text" value="{{ $ppi ? $ppi->managemen_nyeri->input : '' }}" name="managemen_nyeri_perencanaan_perawatan_input"  style="border-radius:5px; border:1px solid lightgrey; width:80%;">
                        </td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Lain - Lain</td>
                        <td colspan="2">
                            : <input type="text" value="{{ $ppi ? $ppi->lain_lain : '' }}" name="lain_lain_perencanaan_perawatan_input"  style="border-radius:5px; border:1px solid lightgrey; width:89%;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <h5 class="text-center">PERENCANAAN PULANG (<span style="font-style: italic">DISCHARGE PLANNING</span>)</h5>
                <input type="hidden" name="perencanaan_pulang">
                @php
                    $pp = $petriadik ? json_decode($petriadik->perencanaan_pulang) : null;
                @endphp
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <p>
                    Pasien dan keluarga diberikan informasi tentang perencanaan pulang ? 
                    <input type="radio" name="informasi_perencanaan_pulang" {{ $pp ? $pp->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    <input type="radio" name="informasi_perencanaan_pulang" {{ $pp ? $pp->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya : <input value="{{ $pp ? $pp->value_input : '' }}" type="text" name="informasi_perencanaan_pulang_input"  style="border-radius:5px; border:1px solid lightgrey;">
                </p>
                <table class="tabel_layout">
                    <tr>
                        <td style="width: 3%">1.</td>
                        <td style="width: 22%">Lama perawatan rata-rata</td>
                        <td>
                            : <input type="text" name="lama_perawatan_input" value="{{ $pp ? $pp->lama_perawatan : '' }}" style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Tanggal perencanaan pulang</td>
                        <td>
                            : <input type="date" name="tanggal_perencanaan_pulang" value="{{ $pp ? $pp->tanggal : '' }}" style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td colspan="2">
                            Perawatan lanjutan yang diberikan dirumah :
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->hygiene ? 'checked' : '' : '' }} id="hygiene_perawatan_lanjutan"> Hygiene (mandi, BAB/BAK)
                        </td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->latihan ? 'checked' : '' : '' }} id="latihan_perawatan_lanjutan"> Latihan Gerak / Exercise
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->perawatan_luka ? 'checked' : '' : '' }} id="perawatan_luka_perawatan_lanjutan"> Perawatan Luka
                        </td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->pemberian_minum ? 'checked' : '' : '' }} id="pemberian_minum_perawatan_lanjutan"> Pemberian Minum / Makan Melalui NGT
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->perawatan_bayi ? 'checked' : '' : '' }} id="perawatan_bayi_perawatan_lanjutan"> Perawatan Bayi
                        </td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->nutrisi ? 'checked' : '' : '' }} id="nutrisi_perawatan_lanjutan"> Nutrisi
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->pemberian_obat ? 'checked' : '' : '' }} id="pemberian_obat_perawatan_lanjutan"> Pemberian Obat
                        </td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->pemeriksaan_lab ? 'checked' : '' : '' }} id="pemeriksaan_lab_perawatan_lanjutan"> Pemeriksaan Laboratorium Lanjutan
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->lain ? 'checked' : '' : '' }} id="lain_perawatan_lanjutan"> <input value="{{ $pp ? $pp->perawatan->lain_input : '' }}" type="text" id="lain_perawatan_lanjutan_input"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                        <td>
                            <input type="checkbox" {{ $pp ? $pp->perawatan->diagnosa_pulang ? 'checked' : '' : '' }} id="diagnosa_pulang_perawatan_lanjutan"> Diagnosa Pulang <input value="{{ $pp ? $pp->perawatan->diagnosa_pulang_input : '' }}" type="text" id="diagnosa_pulang_input"  style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Bayi Tinggal Bersama</td>
                        <td>
                            : <input type="radio" name="bayi_tinggal_bersama" {{ $pp ? $pp->bayi_tinggal == 'orang_tua_kandung' ? 'checked' : '' : '' }} value="orang_tua_kandung"> Orang Tua Kandung
                            <input class="ml-5" type="radio" name="bayi_tinggal_bersama" {{ $pp ? $pp->bayi_tinggal == 'keluarga' ? 'checked' : '' : '' }} value="keluarga"> Keluarga : <input type="text" id="bayi_tinggal_bersama_input" value="{{ $pp ? $pp->bayi_tinggal_input : '' }}" style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Transportasi yang digunakan</td>
                        <td>
                            : <input type="radio" name="transportasi_digunakan" {{ $pp ? $pp->transportasi == 'kendaraan_pribadi' ? 'checked' : "" : '' }} value="kendaraan_pribadi"> Kendaraan Pribadi
                            <input class="ml-5" type="radio" name="transportasi_digunakan" {{ $pp ? $pp->transportasi == 'ambulance' ? 'checked' : "" : '' }} value="ambulance"> Ambulance
                            <input class="ml-5" type="radio" name="transportasi_digunakan" {{ $pp ? $pp->transportasi == 'kendaraan_umum' ? 'checked' : "" : '' }} value="kendaraan_umum"> Kendaraan Umum : <input type="text" id="transportasi_digunakan_input" value="{{ $pp ? $pp->transportasi_input : '' }}" style="border-radius:5px; border:1px solid lightgrey;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pb-2 pt-1" style="border:1px solid #111; border-top:1px solid transparent;">
                <div class="text-center pb-4 pt-4">
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
                <p style="text-align: center" id="box_ttd_perawat">
                    Bekasi, {{ date('d/m/Y', strtotime($dokumen->created_at)) }}, Jam {{ date('H:i', strtotime($dokumen->created_at)) }}<br>
                    Perawat<br>
                    <!-- @if ($dokumen->status == 1) -->
                        @if(!is_null($perawat))
                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.($perawat ? $perawat->ttd : '') }}" alt="" style="width: 5cm; height:3cm;">
                        @else
                        <br>
                        <br>
                        <br>
                        <br>
                        (................................................)
                        @endif
                        <br>
                        ({{ $petriadik ? $petriadik->nama_perawat_verif : '' }})
                    <!-- @else
                        <br>
                        <br>
                        <br>
                        <br>
                        (................................................)
                    @endif -->
                    <br>Ttd & Nama Terang
                </p>
            </div>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('erm.script_riwayat_laboratorium')
@include('erm.script_riwayat_radiologi')
<script>
    $('#form_petriadik').submit(function(e){
        e.preventDefault();
        update_petriadik();
    })

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function rupiah(param) {
        if (param == '' || param == null) {
            return '';
        }
        var temp = param.toString().replaceAll('.', ',');
        return temp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }
</script>
<script>
    let riwayat_imunisasi = [['', '', '', '', '', '', '', '', '', '', '', ''], ['', '', '', '', '', '', '', '', '', '', '', ''], ['', '', '', '', '', '', '', '', '', '', '', ''], ['', '', '', '', '', '', '', '', '', '', '', ''], ['', '', '', '', '', '', '', '', '', '', '', ''], ['', '', '', '', '', '', '', '', '', '', '', ''], ['', '', '', '', '', '', '', '', '', '', '', ''], ['', '', '', '', '', '', '', '', '', '', '', '']];
    let list_penggunaan_obat = [];
    let koor_x_imunisasi = '';
    let koor_y_imunisasi = '';

    function hitung_skor_nips(){
        let skor_nips = 0;
        if($('[name=ekspresi_wajah_nips]:checked').val() != undefined){
            skor_nips += parseInt($('[name=ekspresi_wajah_nips]:checked').val());
        }
        if($('[name=tangisan_nips]:checked').val() != undefined){
            skor_nips += parseInt($('[name=tangisan_nips]:checked').val());
        }
        if($('[name=pola_nafas_nips]:checked').val() != undefined){
            skor_nips += parseInt($('[name=pola_nafas_nips]:checked').val());
        }
        if($('[name=gerakan_lengan_nips]:checked').val() != undefined){
            skor_nips += parseInt($('[name=gerakan_lengan_nips]:checked').val());
        }
        if($('[name=gerakan_tungkai_nips]:checked').val() != undefined){
            skor_nips += parseInt($('[name=gerakan_tungkai_nips]:checked').val());
        }
        if($('[name=status_jaga_nips]:checked').val() != undefined){
            skor_nips += parseInt($('[name=status_jaga_nips]:checked').val());
        }
        $('#total_nips').html(skor_nips);
    }

    $('.timepicker').daterangepicker({
        locale: {
            format: 'HH:mm'
        },
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('.datetimepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm'
        },
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });

    $('textarea').on('input', function () {
        this.style.height = 'auto';
        this.style.height =
        (this.scrollHeight) + 'px';
    });

    function open_modal_ttd_dokter(){
        $('#modal_ttd_dokter').modal('show');
    }

    $('#form_ttd_dokter').submit(function(e){
        e.preventDefault();
        $('[name=pass]').val($('#pass').val());
        $('#modal_ttd_dokter').modal('hide');
        $('#pass').val('');
        update_petriadik();
    })

    $('#form_penggunaan_obat').submit(function(e){
        e.preventDefault();
        if (confirm('Yakin data yang dimasukkan sudah benar ?')) {
            let temp_waktu = '';
            console.log($('#waktu').val());
            if ($('#waktu').val() != '') {
                let temp = $('#waktu').val().split('T');
                let temp_tgl = temp[0].split('-');
                temp_waktu = temp_tgl[2]+'-'+temp_tgl[1]+'-'+temp_tgl[0]+' '+temp[1];
            }
            list_penggunaan_obat.push({
                nama_obat : $('#nama_obat').val(),
                dosis : $('#dosis').val(),
                cara_pemberian : $('#cara_pemberian').val(),
                frekuensi : $('#frekuensi').val(),
                waktu : temp_waktu
            });
            $('#modal_form_penggunaan_obat').modal('hide');
            $('#nama_obat').val('');
            $('#dosis').val('');
            $('#cara_pemberian').val('');
            $('#frekuensi').val('');
            $('#waktu').val('');
            render_list_penggunaan_obat();
        }
    })

    function render_list_penggunaan_obat(){
        if (list_penggunaan_obat.length < 1) {
            $('#list_penggunaan_obat').html('<tr class="text-center"><td colspan="6">Tidak Ada Data</td></tr>');
            return;
        }
        var ins = '';
        for (let i = 0; i < list_penggunaan_obat.length; i++) {
            ins += '<tr>'+
                '<td class="pl-1">'+list_penggunaan_obat[i].nama_obat+'</td>'+
                '<td class="pl-1">'+list_penggunaan_obat[i].dosis+'</td>'+
                '<td class="pl-1">'+list_penggunaan_obat[i].cara_pemberian+'</td>'+
                '<td class="pl-1">'+list_penggunaan_obat[i].frekuensi+'</td>'+
                '<td class="text-center">'+list_penggunaan_obat[i].waktu+'</td>'+
                '<td class="text-center hidden_on_print"><button class="btn btn-danger" type="button" onclick="hapus_penggunaan_obat('+"'"+i+"'"+')"><i class="fa fa-trash"></i></button></td>'+
                '</tr>';   
        }
        $('#list_penggunaan_obat').html(ins);
    }

    function hapus_penggunaan_obat(index){
        if (confirm('Yakin hapus data penggunaan obat ?')) {
            list_penggunaan_obat.splice(index, 1);
            render_list_penggunaan_obat();
        }
    }

    function open_modal_form_penggunaan_obat(){
        $('#modal_form_penggunaan_obat').modal('show');
    }

    $(document).ready(function() {
        $("textarea").each(function () {
            this.style.height = (this.scrollHeight+10)+'px';
        });
        
        @if ($petriadik)
            pemeriksaan_fisik_perawat = <?php echo !is_null($petriadik->pemeriksaan_fisik_perawat) ? $petriadik->pemeriksaan_fisik_perawat : 'null' ?>;
            riwayat_imunisasi = pemeriksaan_fisik_perawat != null ? pemeriksaan_fisik_perawat.riwayat_imunisasi : [];
        @endif

        @if ($petriadik)
            let temp_anamnesis = <?php echo !is_null($petriadik->anamnesis) ? $petriadik->anamnesis : 'null' ?>;
            list_penggunaan_obat = temp_anamnesis != null ? temp_anamnesis.list_penggunaan_obat : [];
        @endif
        render_list_penggunaan_obat();
        render_tabel_imunisasi();

        $('.datepicker').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            singleDatePicker: true,
            timePicker: false,
            timePicker24Hour: true,
        });

        $('.datepicker_imunisasi').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            autoApply: true,
            autoUpdateInput: false,
            singleDatePicker: true,
            timePicker: false,
            timePicker24Hour: true,
        }).on("apply.daterangepicker", function (e, picker) {
            riwayat_imunisasi[koor_y_imunisasi][koor_x_imunisasi] = picker.startDate.format(picker.locale.format);
            console.log(riwayat_imunisasi);
            console.log(picker.startDate.format(picker.locale.format));
            picker.element.val(picker.startDate.format(picker.locale.format));
        });
    })

    function update_petriadik() {
        let anamnesis = {
            'keluhan_utama' : $('#keluhan_utama').val(),
            'riwayat_penyakit_sekarang' : $('#riwayat_penyakit_sekarang').val(),
            'riwayat_penyakit_dahulu' : $('#riwayat_penyakit_dahulu').val(),
            'riwayat_penyakit_keluarga' : {
                'value' : $('[name=riwayat_penyakit_keluarga]:checked').val() != undefined ? $('[name=riwayat_penyakit_keluarga]:checked').val() : '',
                'desc' : $('#desc_riwayat_penyakit_keluarga').val(),
            },
            'riwayat_penggunaan_obat' : {
                'value' : $('[name=riwayat_penggunaan_obat]:checked').val() != undefined ? $('[name=riwayat_penggunaan_obat]:checked').val() : '',
                'desc' : $('#desc_riwayat_penggunaan_obat').val(),
            },
            'list_penggunaan_obat' : list_penggunaan_obat,
            'riwayat_alergi' : {
                'value' : $('[name=riwayat_alergi]:checked').val() != undefined ? $('[name=riwayat_alergi]:checked').val() : '',
                'desc' : $('#desc_riwayat_alergi').val(),
            },
        }

        $('[name=anamnesis]').val(JSON.stringify(anamnesis));

        let pemeriksaan_fisik = {
            'keadaan_umum' : $('[name=keadaan_umum]:checked').val() != undefined ? $('[name=keadaan_umum]:checked').val() : '',
            'kesadaran' : $('[name=kesadaran]:checked').val() != undefined ? $('[name=kesadaran]:checked').val() : '',
            'gcs' : {
                'e' : $('#gcs_e').val(),
                'm' : $('#gcs_m').val(),
                'v' : $('#gcs_v').val(),
            },
            'tanda_vital' : {
                'td' : $('#td').val(),
                'suhu' : $('#suhu').val(),
                'nadi' : $('#nadi').val(),
                'rr' : $('#rr').val(),
            },
            'imunisasi' : [
                {
                    'slug' : 'bcg',
                    'value' : $("#imunisasi_bcg").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_bcg').val()
                },{
                    'slug' : 'hepatitis_b',
                    'value' : $("#imunisasi_hepatitis_b").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_hepatitis_b').val()
                },{
                    'slug' : 'dpt',
                    'value' : $("#imunisasi_dpt").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_dpt').val()
                },{
                    'slug' : 'polio',
                    'value' : $("#imunisasi_polio").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_polio').val()
                },{
                    'slug' : 'campak',
                    'value' : $("#imunisasi_campak").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_campak').val()
                },{
                    'slug' : 'tifoid',
                    'value' : $("#imunisasi_tifoid").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_tifoid').val()
                },{
                    'slug' : 'hib',
                    'value' : $("#imunisasi_hib").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_hib').val()
                },{
                    'slug' : 'influenza',
                    'value' : $("#imunisasi_influenza").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_influenza').val()
                },{
                    'slug' : 'hepatitis_a',
                    'value' : $("#imunisasi_hepatitis_a").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_hepatitis_a').val()
                },{
                    'slug' : 'rotavirus',
                    'value' : $("#imunisasi_rotavirus").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_rotavirus').val()
                },{
                    'slug' : 'mmr',
                    'value' : $("#imunisasi_mmr").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_mmr').val()
                },{
                    'slug' : 'varicella',
                    'value' : $("#imunisasi_varicella").is(':checked') ? 1 : 0,
                    'desc' : $('#desc_imunisasi_varicella').val()
                }
            ],
            'riwayat_prenatal' : {
                'periksa_di' : {
                    'value' : $('[name=periksa_di]:checked').val() != undefined ? $('[name=periksa_di]:checked').val() : '',
                    'lain' : $('#periksa_di_lain').val()
                },
                'penyakit_kehamilan' : {
                    'value' : $('[name=penyakit_kehamilan]:checked').val() != undefined ? $('[name=penyakit_kehamilan]:checked').val() : '',
                    'desc' : $('#desc_penyakit_kehamilan').val()
                },
                'obat_obatan_dikonsumsi' : {
                    'value' : $('[name=obat_obatan_dikonsumsi]:checked').val() != undefined ? $('[name=obat_obatan_dikonsumsi]:checked').val() : '',
                    'desc' : $('#desc_obat_obatan_dikonsumsi').val()
                },
                'lahir_di' : $('#lahir_di').val(),
                'ditolong' : $('#ditolong').val(),
            },
            'riwayat_kelahiran' : {
                'berapa_bulan' : $('#berapa_bulan').val(),
                'jenis_partu' : {
                    'value' : $('[name=jenis_partu]:checked').val() != undefined ? $('[name=jenis_partu]:checked').val() : '',
                    'lain' : $('#jenis_partu_lain').val()
                },
                'berat_badan_lahir' : $('#berat_badan_lahir').val(),
                'panjang_badan_lahir' : $('#panjang_badan_lahir').val(),
            },
            'riwayat_postnatal' : {
                'periksa_di' : {
                    'value' : $('[name=postnatal_periksa_di]:checked').val() != undefined ? $('[name=postnatal_periksa_di]:checked').val() : '',
                    'lain' : $('#postnatal_periksa_di_lain').val()
                },
                'keadaan_anak' : {
                    'value' : $('[name=keadaan_anak]:checked').val() != undefined ? $('[name=keadaan_anak]:checked').val() : '',
                    'lain' : $('#keadaan_anak_lain').val()
                },
                'riwayat_penggunaan_obat' : {
                    'value' : $('[name=riwayat_penggunaan_obat_p]:checked').val() != undefined ? $('[name=riwayat_penggunaan_obat_p]:checked').val() : '',
                    'desc' : $('#desc_riwayat_penggunaan_obat_p').val()
                },
            },
            'pemeriksaan' : $('#status_generalis').val()
        }

        $('[name=pemeriksaan_fisik]').val(JSON.stringify(pemeriksaan_fisik));

        let anamnesis_p = {
            'tiba_tanggal' : $('#tiba_tanggal_p').val(),
            'tiba_jam' : $('#tiba_jam_p').val(),
            'pengkajian_tanggal' : $('#pengkajian_tanggal_p').val(),
            'pengkajian_jam' : $('#pengkajian_jam_p').val(),
            'diperoleh_dari' : $('#diperoleh_dari_p').val(),
            'hubungan_dengan_pasien' : $('#hubungan_dengan_pasien_p').val(),
            'caramasuk' : $('[name=caramasuk]:checked').val() != undefined ? $('[name=caramasuk]:checked').val() : '',
            'asal_pasien' : $('[name=asal_pasien]:checked').val() != undefined ? $('[name=asal_pasien]:checked').val() : '',
            'nama_pj' : $('#nama_pj').val(),
            'usia_pj' : $('#usia_pj').val(),
            'pekerjaan_pj' : $('#pekerjaan_pj').val(),
            'suku_bangsa' : $('#suku_bangsa').val(),
            'keluhan_utama' : $('#keluhan_utama_p').val(),
            'riwayat_obstetric' : {
                'g' : $('#riwayat_obstetric_g').val(),
                'p' : $('#riwayat_obstetric_p').val(),
                'a' : $('#riwayat_obstetric_a').val(),
                'usia_gestasi' : $('#usia_gestasi').val(),
            },
            'pernah_dirawat' : {
                'value' : $('[name=pernah_dirawat]:checked').val() != undefined ? $('[name=pernah_dirawat]:checked').val() : '',
                'indikasi' : $('#indikasi_rawat').val()
            },
            'status_gizi_ibu' : $('[name=status_gizi_ibu]:checked').val() != undefined ? $('[name=status_gizi_ibu]:checked').val() : '',
            'obat_obatan_yang_dikonsumsi_selama_hamil' : {
                'value' : $('[name=obat_obatan_yang_dikonsumsi_selama_hamil]:checked').val() != undefined ? $('[name=obat_obatan_yang_dikonsumsi_selama_hamil]:checked').val() : '',
                'desc' : $('#desc_obat_obatan_yang_dikonsumsi_selama_hamil').val()
            },
            'kebiasaan_ibu' : {
                'value' : $('[name=kebiasaan_ibu]:checked').val() != undefined ? $('[name=kebiasaan_ibu]:checked').val() : '',
                'lain' : $('#kebiasaan_ibu_lain').val()
            },
            'riwayat_persalinan' : $('[name=riwayat_persalinan]:checked').val() != undefined ? $('[name=riwayat_persalinan]:checked').val() : '',
            'ketuban' : {
                'value' : $('[name=ketuban]:checked').val() != undefined ? $('[name=ketuban]:checked').val() : '',
                'lain' : $('#ketuban_lain').val(),
            },
            'volume' : {
                'value' : $('[name=volume]:checked').val() != undefined ? $('[name=volume]:checked').val() : '',
                'apgar_score' : $('#apgar_score').val()
            },
            'antopometri' : {
                'bb' : $('#bb').val(),
                'pb' : $('#pb').val(),
                'ld' : $('#ld').val(),
                'lk' : $('#lk').val(),
                'lp' : $('#lp').val(),
            },
            'riwayat_penyakit_keluarga' : {
                'value' : $('[name=riwayat_penyakit_keluarga_p]:checked').val() != undefined ? $('[name=riwayat_penyakit_keluarga_p]:checked').val() : '',
                'desc' : $('#desc_riwayat_penyakit_keluarga_p').val()
            },
            'riwayat_alergi_obat' : {
                'value' : $('[name=riwayat_alergi_obat]:checked').val() != undefined ? $('[name=riwayat_alergi_obat]:checked').val() : '',
                'desc' : $('#desc_riwayat_alergi_obat').val()
            },
            'riwayat_transfusi_darah' : {
                'value' : $('[name=riwayat_transfusi_darah]:checked').val() != undefined ? $('[name=riwayat_transfusi_darah]:checked').val() : '',
                'desc' : $('#desc_riwayat_transfusi_darah').val()
            },
            'timbul_reaksi' : {
                'value' : $('[name=timbul_reaksi]:checked').val() != undefined ? $('[name=timbul_reaksi]:checked').val() : '',
                'desc' : $('#desc_timbul_reaksi').val()
            },
            'riwayat_imunisasi' : {
                'value' : $('[name=riwayat_imunisasi]:checked').val() != undefined ? $('[name=riwayat_imunisasi]:checked').val() : '',
                'desc' : $('#desc_riwayat_imunisasi').val()
            }
        }

        $('[name=anamnesis_p]').val(JSON.stringify(anamnesis_p));

        let pemeriksaan_fisik_p = {
            'keadaan_umum' : $('[name=keadaan_umum_p]:checked').val() != undefined ? $('[name=keadaan_umum_p]:checked').val() : '',
            'kesadaran' : $('[name=kesadaran_p]:checked').val() != undefined ? $('[name=kesadaran_p]:checked').val() : '',
            'gcs' : {
                'e' : $('#gcs_e_p').val(),
                'm' : $('#gcs_m_p').val(),
                'v' : $('#gcs_v_p').val(),
            },
            'tanda_vital' : {
                'td' : $('#td_p').val(),
                's' : $('#s_p').val(),
                'n' : $('#n_p').val(),
                'rr' : $('#rr_p').val(),
            },
            'antopometri' : {
                'bb' : $('#bb_p').val(),
                'tb' : $('#tb_p').val(),
                'lk' : $('#lk_p').val(),
                'ld' : $('#ld_p').val(),
                'lp' : $('#lp_p').val(),
            },
            'golongan_darah' : {
                'bayi' : {
                    'value' : $('[name=goldar_bayi]:checked').val() != undefined ? $('[name=goldar_bayi]:checked').val() : '',
                    'rh' : $('[name=rh_bayi]:checked').val() != undefined ? $('[name=rh_bayi]:checked').val() : ''
                },
                'ibu' : {
                    'value' : $('[name=goldar_ibu]:checked').val() != undefined ? $('[name=goldar_ibu]:checked').val() : '',
                    'rh' : $('[name=rh_ibu]:checked').val() != undefined ? $('[name=rh_ibu]:checked').val() : ''
                },
                'ayah' : {
                    'value' : $('[name=goldar_ayah]:checked').val() != undefined ? $('[name=goldar_ayah]:checked').val() : '',
                    'rh' : $('[name=rh_ayah]:checked').val() != undefined ? $('[name=rh_ayah]:checked').val() : ''
                }
            },
            'pengkajian_peristem' : {
                'sistem_susunan_saraf' : {
                    'gerak_bayi' : $('[name=gerak_bayi]:checked').val() != undefined ? $('[name=gerak_bayi]:checked').val() : '',
                    'ubun_ubun' : {
                        'value' : $('[name=ubun_ubun]:checked').val() != undefined ? $('[name=ubun_ubun]:checked').val() : '',
                        'lain' : $('#ubun_ubun_lain').val()
                    },
                    'kejang' : {
                        'value' : $('[name=kejang]:checked').val() != undefined ? $('[name=kejang]:checked').val() : '',
                        'desc' : $('#desc_kejang').val()
                    },
                    'refleks' : {
                        'value' : $('[name=refleks]:checked').val() != undefined ? $('[name=refleks]:checked').val() : '',
                        'lain' : $('#refleks_lain').val()
                    },
                    'tangis_bayi' : {
                        'value' : $('[name=tangis_bayi]:checked').val() != undefined ? $('[name=tangis_bayi]:checked').val() : '',
                        'lain' : $('#tangis_bayi_lain').val()
                    }
                },
                'sistem_penglihatan' : {
                    'posisi_mata' : $('[name=posisi_mata]:checked').val() != undefined ? $('[name=posisi_mata]:checked').val() : '',
                    'pupil' : $('[name=pupil]:checked').val() != undefined ? $('[name=pupil]:checked').val() : '',
                    'kelopak_mata' : {
                        'value' : $('[name=kelopak_mata]:checked').val() != undefined ? $('[name=kelopak_mata]:checked').val() : '',
                        'lain' : $('#kelopak_mata_lain').val()
                    },
                    'konjungtiva' : {
                        'value' : $('[name=konjungtiva]:checked').val() != undefined ? $('[name=konjungtiva]:checked').val() : '',
                        'lain' : $('#konjungtiva_lain').val()
                    },
                    'sklera' : {
                        'value' : $('[name=sklera]:checked').val() != undefined ? $('[name=sklera]:checked').val() : '',
                        'lain' : $('#sklera_lain').val()
                    },
                    'alat_bantu_penglihatan' : $('[name=alat_bantu_penglihatan]:checked').val() != undefined ? $('[name=alat_bantu_penglihatan]:checked').val() : '',
                },
                'sistem_pendengaran' : {
                    'value' : $('[name=sistem_pendengaran]:checked').val() != undefined ? $('[name=sistem_pendengaran]:checked').val() : '',
                    'lain' : $('#sistem_pendengaran_lain').val()
                },
                'sistem_penciuman' : {
                    'value' : $('[name=sistem_penciuman]:checked').val() != undefined ? $('[name=sistem_penciuman]:checked').val() : '',
                    'lain' : $('#sistem_penciuman_lain').val()
                },
                'sistem_pernafasan' : {
                    'pola_napas' : $('[name=pola_napas]:checked').val() != undefined ? $('[name=pola_napas]:checked').val() : '',
                    'jenis_pernapasan' : {
                        'value' : $('[name=jenis_pernapasan]:checked').val() != undefined ? $('[name=jenis_pernapasan]:checked').val() : '',
                        'desc' : $('#desc_jenis_pernapasan').val()
                    },
                    'irama_napas' : $('[name=irama_napas]:checked').val() != undefined ? $('[name=irama_napas]:checked').val() : '',
                    'retraksi' : $('[name=retraksi]:checked').val() != undefined ? $('[name=retraksi]:checked').val() : '',
                    'air_entri' : $('[name=air_entri]:checked').val() != undefined ? $('[name=air_entri]:checked').val() : '',
                    'merintih' : $('[name=merintih]:checked').val() != undefined ? $('[name=merintih]:checked').val() : '',
                    'suara_napas' : $('[name=suara_napas]:checked').val() != undefined ? $('[name=suara_napas]:checked').val() : '',
                },
                'sistem_kardiovaskuler' : {
                    'warna_kulit' : {
                        'value' : $('[name=warna_kulit]:checked').val() != undefined ? $('[name=warna_kulit]:checked').val() : '',
                        'lain' : $('#warna_kulit_lain').val()
                    },
                    'denyut_nadi' : $('[name=denyut_nadi]:checked').val() != undefined ? $('[name=denyut_nadi]:checked').val() : '',
                    'sirkulasi' : {
                        'value' : $('[name=sirkulasi]:checked').val() != undefined ? $('[name=sirkulasi]:checked').val() : '',
                        'crt' : $('#crt').val(),
                        'edema' : $('#edema').val()
                    },
                    'pulsasi' : {
                        'value' : $('[name=pulsasi]:checked').val() != undefined ? $('[name=pulsasi]:checked').val() : '',
                        'lain' : $('#pulsasi_lain').val()
                    }
                },
                'sistem_pencernaan' : {
                    'mulut' : {
                        'value' : $('[name=mulut]:checked').val() != undefined ? $('[name=mulut]:checked').val() : '',
                        'lain' : $('#mulut_lain').val()
                    },
                    'gigi' : {
                        'value' : $('[name=gigi]:checked').val() != undefined ? $('[name=gigi]:checked').val() : '',
                        'lain' : $('#gigi_lain').val()
                    },
                    'lidah' : {
                        'value' : $('[name=lidah]:checked').val() != undefined ? $('[name=lidah]:checked').val() : '',
                        'lain' : $('#lidah_lain').val()
                    },
                    'oesofagus' : {
                        'value' : $('[name=oesofagus]:checked').val() != undefined ? $('[name=oesofagus]:checked').val() : '',
                        'lain' : $('#oesofagus_lain').val()
                    },
                    'abdomen' : {
                        'value' : $('[name=abdomen]:checked').val() != undefined ? $('[name=abdomen]:checked').val() : '',
                        'lain' : $('#abdomen_lain').val()
                    }
                },
                'sistem_genitourinaria' : {
                    'bab' : {
                        'value' : $('[name=bab]:checked').val() != undefined ? $('[name=bab]:checked').val() : '',
                        'frekuensi' : $('#frekuensi_diare').val(),
                        'meco_pertama' : $('#meco_pertama').val()
                    },
                    'warna_bab' : {
                        'value' : $('[name=warna_bab]:checked').val() != undefined ? $('[name=warna_bab]:checked').val() : '',
                        'lain' : $('#warna_bab_lain').val()
                    },
                    'bak' : {
                        'value' : $('[name=bak]:checked').val() != undefined ? $('[name=bak]:checked').val() : '',
                        'bak_pertama' : $('#bak_pertama').val()
                    },
                    'warna_bak' : {
                        'value' : $('[name=warna_bak]:checked').val() != undefined ? $('[name=warna_bak]:checked').val() : '',
                        'lain' : $('#warna_bak_lain').val()
                    }
                },
                'sistem_reproduksi' : {
                    'laki_laki' : {
                        'value' : $('[name=sistem_reproduksi_l]:checked').val() != undefined ? $('[name=sistem_reproduksi_l]:checked').val() : '',
                        'lain' : $('#sistem_reproduksi_l_lain').val()
                    },
                    'perempuan' : {
                        'value' : $('[name=sistem_reproduksi_p]:checked').val() != undefined ? $('[name=sistem_reproduksi_p]:checked').val() : '',
                        'lain' : $('#sistem_reproduksi_p_lain').val()
                    }
                },
                'sistem_integumen' : {
                    'vernic_kaseosa' : {
                        'value' : $('[name=vernic_kaseosa]:checked').val() != undefined ? $('[name=vernic_kaseosa]:checked').val() : '',
                        'lain' : $('#vernic_kaseosa_lain').val()
                    },
                    'lanugo' : $('[name=lanugo]:checked').val() != undefined ? $('[name=lanugo]:checked').val() : '',
                    'warna' : {
                        'value' : $('[name=warna_integumen]:checked').val() != undefined ? $('[name=warna_integumen]:checked').val() : '',
                        'lain' : $('#warna_integumen_lain').val()
                    },
                    'tugor' : $('[name=tugor]:checked').val() != undefined ? $('[name=tugor]:checked').val() : '',
                    'kulit' : $('[name=kulit]:checked').val() != undefined ? $('[name=kulit]:checked').val() : '',
                    'kriteria_resiko_dekubitus' : $('[name=kriteria_resiko_dekubitus]:checked').val() != undefined ? $('[name=kriteria_resiko_dekubitus]:checked').val() : '',
                },
                'sistem_muskuloskeletal' : {
                    'lengan' : {
                        'value' : $('[name=lengan]:checked').val() != undefined ? $('[name=lengan]:checked').val() : '',
                        'lain' : $('#lengan_lain').val()
                    },
                    'tungkai' : {
                        'value' : $('[name=tungkai]:checked').val() != undefined ? $('[name=tungkai]:checked').val() : '',
                        'lain' : $('#tungkai_lain').val()
                    },
                    'rekoil_telinga' : {
                        'value' : $('[name=rekoil_telinga]:checked').val() != undefined ? $('[name=rekoil_telinga]:checked').val() : '',
                        'lain' : $('#rekoil_telinga_lain').val()
                    },
                    'garis_telapak_kaki' : $('[name=garis_telapak_kaki]:checked').val() != undefined ? $('[name=garis_telapak_kaki]:checked').val() : '',
                }
            },
            'pengkajian_nyeri' : {
                'a' : {
                    'nyeri' : {
                        'value' : $('[name=nyeri_a]:checked').val() != undefined ? $('[name=nyeri_a]:checked').val() : '',
                        'skor' : $('#skor_nyeri_a').val()
                    },
                    'dengan_skala_nyeri' : $('#dengan_skala_nyeri_a').is(':checked') ? 1 : 0,
                    'wajah' : $('#nyeri_wajah').val(),
                    'kaki' : $('#nyeri_kaki').val(),
                    'aktifitas' : $('#nyeri_aktifitas').val(),
                    'menangis' : $('#nyeri_menangis').val(),
                    'bersuara' : $('#nyeri_bersuara').val(),
                    'skor' : $('[name=hasil_skor_nyeri_a]:checked').val() != undefined ? $('[name=hasil_skor_nyeri_a]:checked').val() : '',
                    'tipe' : {
                        'value' : $('[name=tipe]:checked').val() != undefined ? $('[name=tipe]:checked').val() : '',
                        'desc' : $('#desc_tipe').val()
                    },
                    'frekuensi' : $('[name=frekuensi]:checked').val() != undefined ? $('[name=frekuensi]:checked').val() : '',
                    'lama_nyeri' : $('#lama_nyeri').val()
                },
                'b' : {
                    'nyeri' : {
                        'value' : $('[name=nyeri_b]:checked').val() != undefined ? $('[name=nyeri_b]:checked').val() : '',
                        'skor' : $('#skor_nyeri_b').val()
                    },
                    'dengan_skala_nyeri' : $('#dengan_skala_nyeri_b').is(':checked') ? 1 : 0,
                    'lokasi_nyeri' : $('#lokasi_nyeri').val(),
                    'numerik' : {
                        'is_checked' : $('#skor_numerik_b').is(':checked') ? 1 : 0,
                        'value' : $('#value_skor_numerik_b').val()
                    },
                    'wrong_breaker' : {
                        'is_checked' : $('#wrong_breaker_b').is(':checked') ? 1 : 0,
                        'value' : $('#value_wrong_breaker_b').val()
                    },
                    'tingkat_keparahan' : $('[name=tingkat_keparahan]:checked').val() != undefined ? $('[name=tingkat_keparahan]:checked').val() : '', 
                    'jenis' : $('[name=jenis_nyeri]:checked').val() != undefined ? $('[name=jenis_nyeri]:checked').val() : '',
                    'faktor' : {
                        'value' : $('[name=faktor_nyeri_b]:checked').val() != undefined ? $('[name=faktor_nyeri_b]:checked').val() : '',
                        'lain' : $('#faktor_nyeri_b_lain').val()
                    },
                    'rasa_nyeri' : $('[name=rasa_nyeri]:checked').val() != undefined ? $('[name=rasa_nyeri]:checked').val() : '',
                    'menjalar' : $('[name=menjalar]:checked').val() != undefined ? $('[name=menjalar]:checked').val() : '',
                    'berlangsung' : $('[name=berlangsung]:checked').val() != undefined ? $('[name=berlangsung]:checked').val() : '',
                    'lama_nyeri_b' : $('[name=lama_nyeri_b]:checked').val() != undefined ? $('[name=lama_nyeri_b]:checked').val() : '',
                }
            },
            'riwayat_prenatal' : {
                'lama_kehamilan' : $('[name=lama_kehamilan]:checked').val() != undefined ? $('[name=lama_kehamilan]:checked').val() : '',
                'komplikasi' : {
                    'value' : $('[name=komplikasi]:checked').val() != undefined ? $('[name=komplikasi]:checked').val() : '',
                    'desc' : $('#desc_komplikasi').val()
                },
                'masalah_neonatus' : {
                    'value' : $('[name=masalah_neonatus]:checked').val() != undefined ? $('[name=masalah_neonatus]:checked').val() : '',
                    'desc' : $('#desc_masalah_neonatus').val()
                },
                'masalah_maternal' : {
                    'value' : $('[name=masalah_maternal]:checked').val() != undefined ? $('[name=masalah_maternal]:checked').val() : '',
                    'desc' : $('#desc_masalah_maternal').val()
                }
            },
            'riwayat_tumbuh_kembang' : [
                $('#bb_anak_saat_lahir').val(),
                $('#pb_anak_saat_lahir').val(),
                $('#asi_sampai_umur').val(),
                $('#susu_formula_dimulai').val(),
                $('#makanan_padat_dimulai').val(),
                $('#makanan_tambahan_mulai_umur').val(),
                $('#tengkurap').val(),
                $('#duduk').val(),
                $('#berdiri').val(),
                $('#berjalan').val()
            ],
            'riwayat_imunisasi' : riwayat_imunisasi
        }
        
        $('[name=pemeriksaan_fisik_p]').val(JSON.stringify(pemeriksaan_fisik_p));

        spiritual = {
            'agama' : {
                'value' : $('[name=agama_spiritual]:checked').val() != undefined ? $('[name=agama_spiritual]:checked').val() : '',
                'lain' : $('[name=agama_spiritual_input]').val()
            },
            'mengungkapkan' : {
                'value' : $('[name=mengungkapkan_spiritual]:checked').val() != undefined ? $('[name=mengungkapkan_spiritual]:checked').val() : '',
                'yes' : $('[name=mengungkapkan_spiritual_ya]:checked').val() != undefined ? $('[name=mengungkapkan_spiritual_ya]:checked').val() : '',
                'lain' : $('[name=mengungkapkan_spiritual_ya_input]').val()
            }
        };

        $('[name=spiritual]').val(JSON.stringify(spiritual));
        
        status_psikologis = {
            'value' : $('[name=status_psikologis]:checked').val() != undefined ? $('[name=status_psikologis]:checked').val() : '',
            'lain' : $('[name=status_psikologis_input]').val()
        }

        $('[name=status_psikologis]').val(JSON.stringify(status_psikologis));

        nyeri_instrumen = [
            $('[name=ekspresi_wajah_nips]:checked').val() != undefined ? $('[name=ekspresi_wajah_nips]:checked').val() : '',
            $('[name=tangisan_nips]:checked').val() != undefined ? $('[name=tangisan_nips]:checked').val() : '',
            $('[name=pola_nafas_nips]:checked').val() != undefined ? $('[name=pola_nafas_nips]:checked').val() : '',
            $('[name=gerakan_lengan_nips]:checked').val() != undefined ? $('[name=gerakan_lengan_nips]:checked').val() : '',
            $('[name=gerakan_tungkai_nips]:checked').val() != undefined ? $('[name=gerakan_tungkai_nips]:checked').val() : '',
            $('[name=status_jaga_nips]:checked').val() != undefined ? $('[name=status_jaga_nips]:checked').val() : '',
        ];

        $('[name=skrining_nyeri]').val(JSON.stringify(nyeri_instrumen));

        kebutuhan_komunikasi = {
            'bicara' : $('[name=bicara]:checked').val() != undefined ? $('[name=bicara]:checked').val() : '',
            'bicara_input' : $('[name=bicara_input]').val(),
            'bahasa' : $('[name=bahasa_sehari_hari]:checked').val() != undefined ? $('[name=bahasa_sehari_hari]:checked').val() : '',
            'daerah_input' : $('[name=daerah_input]').val(),
            'bahasa_input' : $('[name=bahasa_sehari_hari_input]').val(),
            'penerjemah' : $('[name=penerjemah]:checked').val() != undefined ? $('[name=penerjemah]:checked').val() : '',
            'bahasa_penerjemah' : $('[name=bahasa_penerjemah_input]').val(),
            'masalah_penglihatan' : $('[name=masalah_penglihatan]:checked').val() ? $('[name=masalah_penglihatan]:checked').val() : '',
            'masalah_penglihatan_input' : $('[name=masalah_penglihatan_input]').val(),
            'pendidikan' : $('[name=pendidikan_pj]:checked').val() != undefined ? $('[name=pendidikan_pj]:checked').val() : '',
            'menginginkan_informasi' : $('[name=menginginkan_informasi]:checked').val() != undefined ? $('[name=menginginkan_informasi]:checked').val() : '',
            'menginginkan_informasi_input' : $('[name=menginginkan_informasi_input]').val()
        };

        $('[name=kebutuhan_komunikasi]').val(JSON.stringify(kebutuhan_komunikasi));

        kebutuhan_privasi_orang_tua = {
            'value' : $('[name=kebutuhan_privasi_orang_tua]:checked').val() != undefined ? $('[name=kebutuhan_privasi_orang_tua]:checked').val() : '',
            'list' : {
                'keinginan' : $('#kebutuhan_privasi_ortu_keinginan_waktu').is(':checked') ? 1 : 0,
                'keinginan_input' : $('#kebutuhan_privasi_ortu_keinginan_waktu_input').val(),
                'pengobatan' : $('#kebutuhan_privasi_ortu_pengobatan').is(':checked') ? 1 : 0,
                'kondisi_penyakit' : $('#kebutuhan_privasi_ortu_kondisi_penyakit').is(':checked') ? 1 : 0,
                'transportasi' : $('#kebutuhan_privasi_ortu_transportasi').is(':checked') ? 1 : 0,
                'lain' : $('#kebutuhan_privasi_ortu_lain').is(':checked') ? 1 : 0,
                'lain_input' : $('#kebutuhan_privasi_ortu_lain_input').val(),
            }
        }

        $('[name=kebutuhan_privasi_orang_tua]').val(JSON.stringify(kebutuhan_privasi_orang_tua));

        skrining_gizi = {
            'masalah' : $('[name=masalah_skrining_gizi]:checked').val() != undefined ? $('[name=masalah_skrining_gizi]:checked').val() : '',
            'penurunan_nafsu_makan' : $('[name=penurunan_nafsu_makan_skrining_gizi]:checked').val() != undefined ? $('[name=penurunan_nafsu_makan_skrining_gizi]:checked').val() : '',
            'penurunan_bb' : $('[name=penurunan_bb_skrining_gizi]:checked').val() != undefined ? $('[name=penurunan_bb_skrining_gizi]:checked').val() : '',
            'penyakit' : {
                'sepsis' : $('#sepsis').is(':checked') ? 1 : 0,
                'jantung' : $('#jantung').is(':checked') ? 1 : 0,
                'bblr' : $('#bblr').is(':checked') ? 1 : 0,
                'hypoglikemia' : $('#hypoglikemia').is(':checked') ? 1 : 0,
                'diarhoe' : $('#diarhoe').is(':checked') ? 1 : 0,
                'lain' : $('#lain').is(':checked') ? 1 : 0,
                'lain_input' : $('[name=penyakit_kelainan_skrining_gizi_input]').val()
            },
            'less_two' : {
                'diet' : $('#diet_yg_diberikan_skrining_gizi').is(':checked') ? 1 : 0,
                'asi' : $('#asi_skrining_gizi').is(':checked') ? 1 : 0,
                'pasi' : $('#pasi_skrining_gizi').is(':checked') ? 1 : 0,
                'per_oral' : $('#per_oral_skrining_gizi').is(':checked') ? 1 : 0,
            },
            'more_two' : {
                'dpjp' : $('#lapor_dpjp_skrining_gizi').is(':checked') ? 1 : 0,
                'asesmen_lanjutan' : $('#asesmen_lanjutan_skrining_gizi').is(':checked') ? 1 : 0
            }
        }

        $('[name=skrining_gizi]').val(JSON.stringify(skrining_gizi));

        daftar_masalah_keperawatan = {
            'nyeri' : $('#nyeri_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'keselamatan' : $('#keselamatan_pasien_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'tumbuh_kembang' : $('#tumbuh_kembang_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'nutrisi' : $('#nutrisi_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'peningkatan_billirubin' : $('#peningkatan_billirubin_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'suhu_tubuh' : $('#suhu_tubuh_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'mobilitas_aktivitas' : $('#mobilitas_aktivitas__daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'eliminasi' : $('#eliminasi_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'perfusi_jaringan' : $('#perfusi_jaringan_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'integritas_kulit' : $('#integritas_kulit_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'pengetahuan_komunikasi' : $('#pengetahuan_komunikasi_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'konflik_peran' : $('#konflik_peran_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'perawatan_diri' : $('#perawatan_diri_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'keseimbangan_cairan' : $('#keseimbangan_cairan_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'jalan_nafas' : $('#jalan_nafas_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'infeksi' : $('#infeksi_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'pola_nafas' : $('#pola_nafas_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'lain' : $('#lain_daftar_masalah_keperawatan').is(':checked') ? 1 : 0,
            'lain_input' : $('#daftar_masalah_keperawatan_input').val(),
        };

        $('[name=daftar_masalah_keperawatan]').val(JSON.stringify(daftar_masalah_keperawatan));

        rencana_keperawatan = [];
        for (let i = 0; i < 7; i++) {
            rencana_keperawatan[i] = $('#rencana_keperawatan_'+i).val();
        };

        $('[name=rencana_keperawatan]').val(JSON.stringify(rencana_keperawatan));

        perencanaan_perawatan = {
            'diet_nutrisi' : {
                'value' : $('[name=diet_nutrisi_perencanaan_perawatan]:checked').val() != undefined ? $('[name=diet_nutrisi_perencanaan_perawatan]:checked').val() : '',
                'input' : $('[name=diet_nutrisi_perencanaan_perawatan_input]').val()
            },
            'rehabilitasi_medik' : {
                'value' : $('[name=rehabilitasi_medik_perencanaan_perawatan]:checked').val() != undefined ? $('[name=rehabilitasi_medik_perencanaan_perawatan]:checked').val() : '',
                'input' : $('[name=rehabilitasi_medik_perencanaan_perawatan_input]').val()
            },
            'farmasi' : {
                'value' : $('[name=farmasi_perencanaan_perawatan]:checked').val() != undefined ? $('[name=farmasi_perencanaan_perawatan]:checked').val() : '',
                'input' : $('[name=farmasi_perencanaan_perawatan_input]').val()
            },
            'perawatan_luka' : {
                'value' : $('[name=perawatan_luka_perencanaan_perawatan]:checked').val() != undefined ? $('[name=perawatan_luka_perencanaan_perawatan]:checked').val() : '',
                'input' : $('[name=perawatan_luka_perencanaan_perawatan_input]').val()
            },
            'managemen_nyeri' : {
                'value' : $('[name=managemen_nyeri_perencanaan_perawatan]:checked').val() != undefined ? $('[name=managemen_nyeri_perencanaan_perawatan]:checked').val() : '',
                'input' : $('[name=managemen_nyeri_perencanaan_perawatan_input]').val()
            },
            'lain_lain' : $('[name=lain_lain_perencanaan_perawatan_input]').val(),
        }

        $('[name=perencanaan_perawatan]').val(JSON.stringify(perencanaan_perawatan));

        perencanaan_pulang = {
            'value' : $('[name=informasi_perencanaan_pulang]:checked').val() != undefined ? $('[name=informasi_perencanaan_pulang]:checked').val() : '',
            'value_input' : $('[name=informasi_perencanaan_pulang_input]').val(),
            'lama_perawatan' : $('[name=lama_perawatan_input]').val(),
            'tanggal' : $('[name=tanggal_perencanaan_pulang]').val(),
            'perawatan' : {
                'hygiene' : $('#hygiene_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'latihan' : $('#latihan_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'perawatan_luka' : $('#perawatan_luka_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'pemberian_minum' : $('#pemberian_minum_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'perawatan_bayi' : $('#perawatan_bayi_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'nutrisi' : $('#nutrisi_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'pemberian_obat' : $('#pemberian_obat_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'pemeriksaan_lab' : $('#pemeriksaan_lab_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'lain' : $('#lain_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'lain_input' : $('#lain_perawatan_lanjutan_input').val(),
                'diagnosa_pulang' : $('#diagnosa_pulang_perawatan_lanjutan').is(':checked') ? 1 : 0,
                'diagnosa_pulang_input' : $('#diagnosa_pulang_input').val()
            },
            'bayi_tinggal' : $('[name=bayi_tinggal_bersama]:checked').val() != undefined ? $('[name=bayi_tinggal_bersama]:checked').val() : '',
            'bayi_tinggal_input' : $('#bayi_tinggal_bersama_input').val(),
            'transportasi' : $('[name=transportasi_digunakan]:checked').val() != undefined ? $('[name=transportasi_digunakan]:checked').val() : '',
            'transportasi_input' : $('#transportasi_digunakan_input').val(),
        }

        $('[name=perencanaan_pulang]').val(JSON.stringify(perencanaan_pulang));

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/smis_doc_asesmen_awal_pasien_ranap_pediatrik/store') }}",
            method: 'post',
            data: $('#form_petriadik').serialize(),
            success: function(response) {
                console.log(response);
                alert(response.message);

                if (!response.status) {
                    return;
                }

                if (response.dokter != undefined) {
                    var ins = 'Dokter'+
                            '<br>'+
                            `<img src="{{ env('SMIS_UPLOAD_URL')}}/`+response.dokter.ttd+`" style="height: 2cm; width: 3cm;" alt="">`+
                            `<br>`+
                            response.dokter.nama + '<br>'+
                            `Ttd & Nama Terang`;   
                    $('#box_ttd_dokter').html(ins);
                }

                if (response.perawat != undefined) {
                    var ins = `<img src="{{ env('SMIS_UPLOAD_URL')}}/`+response.perawat.ttd+`" alt="" style="width: 5cm; height:3cm;">`+
                    '<br>'+
                    response.perawat.nama+
                    '<br>Ttd & Nama Terang';
                    $('#box_ttd_perawat').html(ins);
                }
            }
        })
    }

    $('#form_neonatus').submit(function(e){
        e.preventDefault();
        if (!confirm('Yakin simpan dokumen ?')) {
            return;
        }
        update_petriadik();
    })

    function set_riwayat_imunisasi(row,column,value){
        koor_x_imunisasi = column;
        koor_y_imunisasi = row;
        riwayat_imunisasi[row][column] = value;
    }

    function render_tabel_imunisasi() {
        var ins = '<table class="tabel_layout" border="1">' +
            '<tr class="text-center">' +
            '<td>Imunisasi</td>' +
            '@for ($i = 1; $i <= 6; $i++)' +
            '<td>{{ $i }}</td>' +
            '@endfor' +
            '<td>Imunisasi</td>' +
            '@for ($i = 1; $i <= 6; $i++)' +
            '<td>{{ $i }}</td>' +
            '@endfor' +
            '</tr>' +
            '<tr>' +
            '<td>BCG</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'0,'+i+',this.value'+')" value="'+(riwayat_imunisasi[0] ? riwayat_imunisasi[0][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'0,'+i+',this.value'+')" value="'+(riwayat_imunisasi[0] ? riwayat_imunisasi[0][i] : '') +'" /></td>';
            }
            ins += '<td>Flu</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'0,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[0] ? riwayat_imunisasi[0][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'0,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[0] ? riwayat_imunisasi[0][i+6] : '') +'" /></td>';
            }
            ins += '</tr>' +
            '<tr>' +
            '<td>Hepatitis B</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'1,'+i+',this.value'+')" value="'+(riwayat_imunisasi[1] ? riwayat_imunisasi[1][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'1,'+i+',this.value'+')" value="'+(riwayat_imunisasi[1] ? riwayat_imunisasi[1][i] : '') +'" /></td>';
            }
            ins += '<td>Cacar Air</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'1,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[1] ? riwayat_imunisasi[1][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'1,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[1] ? riwayat_imunisasi[1][i+6] : '') +'" /></td>';
            }
            ins += '</tr>' +
            '<tr>' +
            '<td>DPT</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'2,'+i+',this.value'+')" value="'+(riwayat_imunisasi[2] ? riwayat_imunisasi[2][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'2,'+i+',this.value'+')" value="'+(riwayat_imunisasi[2] ? riwayat_imunisasi[2][i] : '') +'" /></td>';
            }
            ins += '<td>MMR</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'2,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[2] ? riwayat_imunisasi[2][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'2,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[2] ? riwayat_imunisasi[2][i+6] : '') +'" /></td>';
            }
            ins += '</tr>' +
            '<tr>' +
            '<td>Polio</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'3,'+i+',this.value'+')" value="'+(riwayat_imunisasi[3] ? riwayat_imunisasi[3][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'3,'+i+',this.value'+')" value="'+(riwayat_imunisasi[3] ? riwayat_imunisasi[3][i] : '') +'" /></td>';
            }
            ins += '<td>Thypoid</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'3,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[3] ? riwayat_imunisasi[3][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'3,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[3] ? riwayat_imunisasi[3][i+6] : '') +'" /></td>';
            }
            ins+= '</tr>' +
            '<tr>' +
            '<td>Campak</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'4,'+i+',this.value'+')" value="'+(riwayat_imunisasi[4] ? riwayat_imunisasi[4][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'4,'+i+',this.value'+')" value="'+(riwayat_imunisasi[4] ? riwayat_imunisasi[4][i] : '') +'" /></td>';
            }
            ins += '<td>Hepatitis A</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'4,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[4] ? riwayat_imunisasi[4][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'4,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[4] ? riwayat_imunisasi[4][i+6] : '') +'" /></td>';
            }
            ins += '</tr>' +
            '<tr>' +
            '<td>HIB</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'5,'+i+',this.value'+')" value="'+(riwayat_imunisasi[5] ? riwayat_imunisasi[5][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'5,'+i+',this.value'+')" value="'+(riwayat_imunisasi[5] ? riwayat_imunisasi[5][i] : '') +'" /></td>';
            }
            ins += '<td>HPV</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'5,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[5] ? riwayat_imunisasi[5][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'5,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[5] ? riwayat_imunisasi[5][i+6] : '') +'" /></td>';
            }
            ins += '</tr>' +
            '<tr>' +
            '<td>IPD</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'6,'+i+',this.value'+')" value="'+(riwayat_imunisasi[6] ? riwayat_imunisasi[6][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'6,'+i+',this.value'+')" value="'+(riwayat_imunisasi[6] ? riwayat_imunisasi[6][i] : '') +'" /></td>';
            }
            ins += '<td>Rotavirus</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'6,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[6] ? riwayat_imunisasi[6][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'6,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[6] ? riwayat_imunisasi[6][i+6] : '') +'" /></td>';
            }
            ins += '</tr>' +
            '<tr>' +
            '<td>Typhim</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'7,'+i+',this.value'+')" value="'+(riwayat_imunisasi[7] ? riwayat_imunisasi[7][i] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'7,'+i+',this.value'+')" value="'+(riwayat_imunisasi[7] ? riwayat_imunisasi[7][i] : '') +'" /></td>';
            }
            ins += '<td>Influenza</td>';
            for (let i = 0; i < 6; i++) {
                ins += '<td class="text-center"><input onclick="set_riwayat_imunisasi('+'7,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[7] ? riwayat_imunisasi[7][i+6] : '') +'" style="width:100%; text-align:center;" class="form-control datepicker_imunisasi" onkeyup="set_riwayat_imunisasi('+'7,'+(i+6)+',this.value'+')" value="'+(riwayat_imunisasi[7] ? riwayat_imunisasi[7][i+6] : '') +'" /></td>';
            }
            ins += '</tr>' +
            '</table>';
        $('#box_tabel_imunisasi').html(ins);
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

<!-- SCRIPT PESANAN LAB -->
<script>
    let id_pesanan_lab = <?php echo $petriadik ? $petriadik->id_pesanan_lab : '0' ?>;

    function open_form_lab() {
        $('#loading_pesanan_lab').html('');
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: id_pesanan_lab
            },
            success: function(response) {
                $('#id_pesanan_lab').val(response != null ? response.id : 0);
                $('#pesan_pemeriksaan').select2();

                if (Object.entries(response).length !== 0) {

                    if (response.status != 'Pesanan ERM') {
                        alert('Tidak diperkenankan ubah pesanan laboratorium');
                        return;
                    }

                    let temp = [];
                    const periksa = JSON.parse(response.periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push(`${key}`);
                        }
                    });
                    $('#pesan_pemeriksaan').val(temp).change();
                    $('#cito').val(response.cito);
                }

                $('#ruangan_lab').val(Object.keys(response).length !== 0 ? response.ruangan : '{{ $layanan->last_ruangan }}');
                $('#modal_form_lab').modal('show');
            }
        })
    }

    $('#form_laboratorium').submit(function(e) {
        e.preventDefault();
        $('#loading_pesanan_lab').html('<div class="alert alert-info">' + loading('Sedang menyimpan data...',
            'sm') + '</div>');
        $('#keluhan_klinis').val($('[name=keluhan_utama]').val());
        console.log($('#form_laboratorium').serialize());
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
                $('#modal_form_lab').modal('hide');
                let data = response.data;
                id_pesanan_lab = data.id;
                $('#loading_pesanan_lab').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                let pemeriksaan = <?php echo $pemeriksaan; ?>;
                var ins = data.no_lab + ' - ';
                var temp = JSON.parse(data.periksa);
                let iterasi_pesanan = 0;
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
                $('#box_button_lab').html(
                    '<button type="button" class="btn btn-warning hidden_on_print" onclick="open_form_lab()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_hasil_lab(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-danger ml-1" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_lab(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                    ins
                );
                $('#id_pesanan_lab_neo').val(id_pesanan_lab);
                update_pesanan();
            }
        })
    })

    function hapus_pesanan_lab(param) {
        if (confirm('Yakin melanjutkan hapus pesanan laboratorium ?')) {
            $.ajax({
                url: "{{ url('ajax_request/hapus_pesanan_lab') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#box_button_lab').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_pesanan_lab').val(0);
                    id_pesanan_lab = 0;
                    update_pesanan();
                }
            })
        }
    }

    function open_hasil_lab(param) {
        let cek = false
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                console.log(param);
                console.log(response);
                if (Object.entries(response).length === 0) {
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
                                    '<td class="text-center" style="' + cek_nilai_normal(temp[master_hasil[i]
                                        .slug], master_hasil[i]) + '">' + temp[master_hasil[i].slug] + '</td>' +
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
                let file = response.file == '' ? [''] : JSON.parse(response.file);
                if(file[0] != ''){
                    $('#link_lampiran_lab').html('<a target="_blank" style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL') }}/'+file[0]+'">Lampiran Hasil Laboratorium</a>');
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
<!-- END SCRIPT LAB -->

<!-- SCRIPT RAD -->
<script>
    let id_pesanan_rad = <?php echo $petriadik ? $petriadik->id_pesanan_rad : '0' ?>;

    function open_form_rad() {
        $('#loading_pesanan_rad').html('');
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: id_pesanan_rad
            },
            success: function(response) {
                let temp = [];
                $('#id_pesanan_rad').val(Object.keys(response).length !== 0 ? response.id : 0);
                $('#pesan_pemeriksaan_rad').select2();
                if (Object.keys(response).length !== 0) {
                    if (response.status != 'Pesanan ERM') {
                        alert('Tidak diperkenankan ubah pesanan radiologi');
                        return;
                    }

                    const periksa = JSON.parse(response.periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push((`${key}`).replace('rad_', ''));
                        }
                    });
                    $('#pesan_pemeriksaan_rad').val(temp).change();
                    $('#ruangan_rad').val(response.ruangan);
                }
                $('#ruangan_rad').val(Object.keys(response).length !== 0 ? response.ruangan : '{{ $layanan->last_ruangan }}');
                $('#modal_form_rad').modal('show');
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
                if (!response.status) {
                    $('#loading_pesanan_rad').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                    return;
                }
                console.log(response);
                $('#loading_pesanan_rad').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                $('#modal_form_rad').modal('hide');
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
                $('#box_button_rad').html(
                    '<button type="button" class="btn btn-warning hidden_on_print" onclick="open_form_rad()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_hasil_rad(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-danger ml-1 mr-2" data-toggle="tooltip" title="Hapus" onclick="hapus_pesanan_rad(' +
                    "'" + data.id + "'" +
                    ')"><i class="fa fa-trash" style="color:#fff;"></i></button>' +
                    ins
                );
                console.log(id_pesanan_rad);
                $('#id_pesanan_rad_neo').val(id_pesanan_rad);
                update_pesanan();
            }
        })
    })

    function hapus_pesanan_rad(param) {
        if (confirm('Yakin melanjutkan hapus pesanan radiologi ?')) {
            $.ajax({
                url: "{{ url('ajax_request/hapus_pesanan_rad') }}",
                data: {
                    id: param
                },
                success: function(response) {
                    if (!response.status) {
                        alert(response.message);
                        return;
                    }
                    $('#box_button_rad').html('<button type="button" class="btn btn-dark" onclick="open_modal_lab()"><i class="fa fa-plus" style="color:#fff;"></i></button>');
                    $('#id_pesanan_rad').val(0);
                    id_pesanan_rad = 0;
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

    function open_hasil_rad(param) {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_id') }}",
            data: {
                id: param
            },
            success: function(response) {
                if (response == null) {
                    return;
                }
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
                    // console.log(periksa);
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
                    let file = response.file == '' ? [''] : JSON.parse(response.file);
                    if(file[0] != ''){
                        $('#link_lampiran_rad').html('<a target="_blank" style="text-decoration:underline; color:#111;" href="{{ env('SMIS_UPLOAD_URL') }}/'+file[0]+'">Lampiran Hasil Radiologi</a>');
                    }
                    $('#list_hasil_radiologi').html(ins);
                    $('#modal_hasil_radiologi').modal('show');
                }
            }
        })
    }
</script>
<!-- END SCRIPT RAD -->

<!-- SCRIPT E RESEP -->
<script>
    let id_resep = "{{ !is_null($resep) ? $resep->id : '0' }}";
    let detail_resep = [];

    $("#resep_nama_obat").autocomplete({
        serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
        dataType: "JSON", // Tipe data JSON
        params: {
            'depo': function() {
                return $('#resep_depo_tujuan').val();
            }
        },
        onSelect: function(suggestion) {
            $('#additional_form_e_resep').html('');
            $("#resep_nama_obat").val(suggestion.nama);
            $('#resep_kode_obat').val(suggestion.kode_obat);
            $("#resep_id_obat").val(suggestion.id);
            $("#resep_jenis_obat").val(suggestion.jenis_obat);
            $("#resep_satuan_obat").val(suggestion.satuan_obat);
            $("#resep_sisa_obat").val(suggestion.sisa);

            get_harga_obat(suggestion.id);
        }
    })

    function open_form_resep() {
        $('#msg_resep').html('');
        $.ajax({
            url: "{{ url('ajax_request/select_resep') }}",
            data: {
                id: id_resep
            },
            success: function(response) {
                console.log(response);
                let null_resep = Object.entries(response).length !== 0;
                $('#resep_id').val(null_resep ? response.id : '0');
                $('#resep_nrm').val(null_resep ? response.nrm_pasien : '{{ $layanan->nrm }}');
                $('#resep_noreg').val(null_resep ? response.noreg_pasien : '{{ $layanan->id }}');
                $('#resep_nama').val(null_resep ? response.nama_pasien : '{{ $layanan->nama_pasien }}');
                $('#resep_usia').val(null_resep ? response.usia : '{{ $layanan->umur }}');
                $('#resep_dokter').val(null_resep ? response.nama_dokter : '');
                $('#resep_id_dokter').val(null_resep ? response.id_dokter : '0');
                $('#resep_sip').val(null_resep ? response.sip_dokter : '');
                $('#resep_alamat').val(null_resep ? response.alamat_pasien :
                    '{{ $layanan->alamat_pasien }}');
                $('#resep_telp').val(null_resep ? response.no_telpon : '{{ $pasien->telpon }}');
                $('#resep_jenis_pasien').val(null_resep ? response.jenis : '{{ $layanan->carabayar }}');
                $('#resep_depo_tujuan').val(null_resep ? response.depo : 'depo_farmasi').trigger('change');
                $('#resep_obat_racikan').val(null_resep ? response.catatan_obat_racikan : '');
                $('#resep_signa').val(null_resep ? response.signa : '');

                mapping_detail(response.detail);
            }
        })
    }

    function mapping_detail(data) {
        detail_resep = [];
        if (data != undefined) {
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    detail_resep.push({
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
        render_detail_resep();
    }

    function render_detail_resep() {
        var ins = '';
        var footer = '';
        let jml = 0;
        for (let i = 0; i < detail_resep.length; i++) {
            if (!detail_resep[i].deleted) {
                ins += '<tr>' +
                    '<td class="text-center">' + (i + 1) + '</td>' +
                    '<td>' + detail_resep[i].nama_obat + '</td>' +
                    '<td class="text-center">' + detail_resep[i].nama_jenis_obat + '</td>' +
                    '<td class="text-center">' + detail_resep[i].jumlah + '</td>' +
                    '<td class="text-center">' + detail_resep[i].satuan + '</td>' +
                    '<td>Rp. ' + rupiah(detail_resep[i].harga) + '</td>' +
                    '<td>Rp. ' + rupiah((detail_resep[i].harga * detail_resep[i].jumlah).toFixed(2)) +
                    '</td>' +
                    '<td class="text-center">' + detail_resep[i].signa + '</td>' +
                    '<td class="text-center"><button onclick="hapus_detail_resep(' + i +
                    ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>' +
                    '</tr>';
                jml += parseFloat((detail_resep[i].harga * detail_resep[i].jumlah).toFixed(2));
            }
        }
        if (detail_resep.length > 0) {
            footer = '<tr>' +
                '<td colspan="6" style="text-align:right; font-weight:bold;">Total : </td>' +
                '<td style="font-weight:bold;">Rp. ' + rupiah(jml) + '</td>' +
                '<td colspan="2"></td>' +
                '</tr>';
        }
        $('#list_detail_resep').html(ins);
        $('#footer_list_detail_resep').html(footer);
        $('#modal_resep').modal('show');
    }

    function open_modal_list_obat(param) {
        if ($('#resep_depo_tujuan').val() == '') {
            alert('Pilih depo tujuan dahulu');
            return;
        }
        $('#modal_resep').modal('hide');
        get_list_obat(param);
        $('#modal_list_obat').modal('show');
    }

    function get_list_obat(kriteria) {
        $('#msg_list_obat').html('');
        if ($.fn.DataTable.isDataTable("#tabel_list_obat")) {
            $('#tabel_list_obat').DataTable().clear().destroy();
        }
        $('#tabel_list_obat').DataTable({
            processing: true,
            serverSide: true,
            searching: false,

            ajax: "../../ajax_request/list_obat?depo=" + $('#resep_depo_tujuan').val() + '&kriteria=' +
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
                            "','" + row.sisa + "'" +
                            ')" class="btn btn-dark"><i class="fa fa-check"></i></button>' +
                            '</div>';
                    }
                },
            ]
        });
    }

    function get_detail_obat(param, kode, nama, satuan, jenis, sisa) {
        $('#msg_list_obat').html(loading('Sedang mengambil harga obat, harap tunggu...', 'info'));
        $('#resep_id_obat').val(param);
        $('#resep_kode_obat').val(kode);
        $('#resep_nama_obat').val(nama);
        $('#resep_satuan_obat').val(satuan);
        $('#resep_jenis_obat').val(jenis);
        $('#resep_sisa_obat').val(sisa);
        get_harga_obat(param);
    }

    function get_harga_obat(param) {
        $.ajax({
            url: "{{ url('ajax_request/harga_obat') }}",
            data: {
                noreg: "{{ $layanan->id }}",
                id_obat: param,
                // kategori: (tipe_form == 'tambah' ? $('#e_resep_kategori').val() : $('#edit_kategori')
                //     .val()),
                depo: $('#resep_depo_tujuan').val()
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
                $('#resep_harga_obat').val(rupiah(response.toFixed(2)));
                $('#modal_list_obat').modal('hide');
                $('#modal_resep').modal('show');
            }
        })
    }

    function tambah_detail_resep() {
        if ($('#resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }
        if ($('#resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }
        if (confirm('Yakin data yang dimasukkan sudah benar ?')) {
            detail_resep.push({
                id: '',
                id_obat: parseInt($('#resep_id_obat').val()),
                kode_obat: $('#resep_kode_obat').val(),
                nama_obat: $('#resep_nama_obat').val(),
                nama_jenis_obat: $('#resep_jenis_obat').val(),
                jumlah: parseFloat($('#resep_jumlah_obat').val()),
                satuan: $('#resep_satuan_obat').val(),
                aturan_pakai: $('#resep_aturan_pakai').val(),
                obat_luar_check: parseInt($('#resep_obat_luar_aktif').val()),
                malam_check: $('#resep_malam').is(':checked') ? 1 : 0,
                malam: "",
                sore_check: $('#resep_sore').is(':checked') ? 1 : 0,
                sore: "",
                siang_check: $('#resep_siang').is(':checked') ? 1 : 0,
                siang: "",
                pagi_check: $('#resep_pagi').is(':checked') ? 1 : 0,
                pagi: "",
                pemakaian: $('#resep_pemakaian').val(),
                keterangan_tambahan: "",
                satuan_pakai: $('#resep_satuan_obat').val(),
                takaran_pakai: $('#resep_satuan_pakai').val(),
                jumlah_pakai_sehari: $('#resep_jumlah_pakai').val(),
                aturan_pakai_mode: $('#resep_aturan_pakai_mode').val(),
                harga: parseFloat($('#resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(',',
                    '.')),
                markup: parseInt($('resep_markup').val()),
                signa: $('#resep_signa').val(),
                deleted: false
            });
            $('#resep_id_obat').val('');
            $('#resep_kode_obat').val('');
            $('#resep_nama_obat').val('');
            $('#resep_jenis_obat').val('');
            $('#resep_sisa_obat').val('');
            $('#resep_satuan_obat').val('');
            $('#resep_jumlah_obat').val('');
            $('#resep_harga_obat').val('');
            $('#resep_signa').val('');
            $('#additional_form_resep').html('');
            console.log(detail_resep);
            render_detail_resep();
        }
    }

    function hapus_detail_resep(index) {
        if (confirm('Yakin melanjutkan hapus data ?')) {
            detail_resep[index].deleted = true;
            render_detail_resep();
        }
    }

    function open_modal_dokter_resep() {
        if ($.fn.DataTable.isDataTable('#tabel_dokter_resep')) {
            $('#tabel_dokter_resep').dataTable().fnClearTable();
            $('#tabel_dokter_resep').dataTable().fnDestroy();
        }
        $('#tabel_dokter_resep').DataTable({
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
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_dokter_resep(' +
                            "'" + row.nama + "','" + data + "','" + row.no_ijin + "'" +
                            ')"><i class="fa fa-check"></i></button></div>';
                    }
                },
            ]
        });
        $('#modal_resep').modal('hide');
        $('#modal_dokter_resep').modal('show');
    }

    function set_dokter_resep(nama, id, sip) {
        $('#resep_dokter').val(nama);
        $('#resep_id_dokter').val(id);
        $('#resep_sip').val(sip);
        $('#modal_dokter_resep').modal('hide');
        $('#modal_resep').modal('show');
    }

    $('#form_resep').submit(function(e) {
        e.preventDefault();
        $('#detail_resep').val(JSON.stringify(detail_resep));
        $('#msg_resep').html('<div class="alert alert-info">' + loading(
            'Sedang menyimpan resep, harap tunggu...', 'sm') + '</div>');
        $.ajax({
            url: "{{ url('ajax_request/resep_store_by_id') }}",
            method: 'post',
            data: $('#form_resep').serialize(),
            success: function(response) {
                console.log(response);
                if (response.code == 200) {
                    $('#msg_resep').html('<div class="alert alert-success">' + response.message +
                        '</div>');
                    var ins = '';
                    id_resep = response.data.id;
                    if (response.data.locked == 0) {
                        ins +=
                            '<button type="button" class="btn btn-warning hidden_on_print" onclick="open_form_resep()"><i class="fa fa-pencil" style="color:#fff;"></i></button>';
                    }
                    ins += '<button type="button" class="btn btn-info hidden_on_print ml-1"' +
                        'onclick="lock_terapi(' + response.data.id + ')"><i class="fa fa-lock"' +
                        'style="color:#fff;"></i></button>' +
                        '<button type="button" class="btn btn-info hidden_on_print ml-1"' +
                        'onclick="preview_terapi(' + response.data.id + ')"><i class="fa fa-book"' +
                        'style="color:#fff;"></i></button>';
                    $('#box_btn_terapi').html(ins + ' No. Resep Elektronik ' + response.data.id);
                    $('#modal_resep').modal('hide');
                    $('#id_resep_neo').val(response.data.id);
                    update_petriadik();
                    render_resep(response.data.detail);
                    return;
                } else {
                    $('#msg_resep').html('<div class="alert alert-danger">' + response.message +
                        '</div>');
                }
            }
        })
    })

    function render_resep(data) {
        if (data.length < 1) {
            $('#box_resep').html('');
            return;
        }

        var ins = '<table style="border-collapse: collapse; width:50%;" class="tabel_terapi">';

        for (let i = 0; i < data.length; i++) {
            ins += '<tr>' +
                '<td class="pl-4">R/</td>' +
                '<td>' + data[i].nama_obat + '</td>' +
                '<td>' + data[i].signa + '</td>' +
                '<td style="padding-left: 20px;">' + data[i].jumlah + ' ' + data[i].satuan + '</td>' +
                '</tr>';
        }
        ins += '</table>';
        $('#box_resep').html(ins);
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
                        var ins = '<button type="button" class="btn btn-info hidden_on_print" onclick="preview_terapi(' +
                            "'" + response.data.id + "'" +
                            ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                            ' No. Resep Elektronik ' + response.data.id;
                        $('#box_btn_terapi').html(ins);
                    }
                }
            })
        }
    }

    function preview_terapi(param) {
        $('#modal_preview').modal('show');
    }
</script>
<!-- END SCRIPT E RESEP -->

<!-- SCRIPT DIAGNOSA -->
<script>
    let id_diagnosa = "{{ !is_null($diagnosa) ? $diagnosa->id : '0' }}";

    function open_form_diagnosa(){
        $.ajax({
            url: "{{ url('ajax_request/diagnosa_by_id') }}",
            data: {
                id: id_diagnosa,
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
                    $('#diagnosa_pembanding').val(response.diagnosa_pembanding);
                    $('#icd').val(response.nama_icd);
                    $('#kode_icd').val(response.kode_icd);
                }
                $('#modal_diagnosa').modal('show');
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

    $('#form_diagnosa').submit(function(e) {
        e.preventDefault();
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
            url: "{{ url('ajax_request/update_diagnosa_by_id') }}",
            method: 'post',
            data: $('#form_diagnosa').serialize(),
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    alert(response.message);
                    $('#box_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                    $('#btn_simpan_diagnosa').removeAttr('disabled');
                } else {
                    $('#box_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    let data = response.data;
                    id_diagnosa = data.id;
                    var temp = data.kode_icd != '' ? data.kode_icd + ' - ' + data.nama_icd : data.diagnosa;
                    if (data.diagnosa_sekunder1 != '') {
                        temp += '<br>' + response.kode_sekunder1.icd + ' - ' + data.diagnosa_sekunder1;
                    }
                    if (data.diagnosa_sekunder2 != '') {
                        temp += '<br>' + response.kode_sekunder2.icd + ' - ' + data.diagnosa_sekunder2;
                    }
                    if (data.diagnosa_sekunder3 != '') {
                        temp += '<br>' + response.kode_sekunder3.icd + ' - ' + data.diagnosa_sekunder3;
                    }
                    if (data.diagnosa_sekunder4 != '') {
                        temp += '<br>' + response.kode_sekunder4.icd + ' - ' + data.diagnosa_sekunder4;
                    }
                    if (data.diagnosa_sekunder5 != '') {
                        temp += '<br>' + response.kode_sekunder5.icd + ' - ' + data.diagnosa_sekunder5;
                    }
                    data.kode_icd_diagnosa_pembanding != '' ? $('#box_diagnosa_pembanding').html(data.kode_icd_diagnosa_pembanding + ' - ' + data
                        .nama_diagnosa_pembanding) :  $('#box_diagnosa_pembanding').html(data.diagnosa_pembanding);
                    $('#box_btn_diagnosa').html('<button class="btn btn-warning hidden_on_print mr-1" type="button" onclick="open_form_diagnosa()" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>');
                    $('#box_list_diagnosa').html(temp);
                    $('#btn_simpan_diagnosa').removeAttr('disabled');
                    $('#box_msg').html('');
                    $('#modal_diagnosa').modal('hide');
                    $('#id_diagnosa_neo').val(id_diagnosa);
                    $('#diagnosa_lab').val(data.kode_icd != '' ? data.nama_icd : data.diagnosa);
                    update_petriadik();
                }
            }
        })
    })

    function update_pesanan() {
        $.ajax({
            url: "{{ url('ajax_request/update_pesanan') }}",
            method: 'post',
            data: {
                id_dokumen: '{{ $dokumen->id }}',
                dokumen: 'asesmen_awal_pasien_ranap_petriadik',
                id_pesanan_lab: id_pesanan_lab,
                id_pesanan_rad: id_pesanan_rad,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
            }
        })
    }
</script>
<!-- END SCRIPT DIAGNOSA -->
</html>
