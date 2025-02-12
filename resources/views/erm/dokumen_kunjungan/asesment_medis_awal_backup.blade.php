<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Asesment Medis Awal Rawat Jalan</title>

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

        .table_isian td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        #tabel_subyektif tr td {
            padding-top: 10px;
            padding-bottom: 10px;
            vertical-align: top;
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

        .tabel_terapi tr td {
            border: none;
        }
    </style>
</head>

<body style="margin: 20px;">
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
    <form onsubmit="return cek_form_ttd(this)" id="form_persetujuan"
        action="{{ url('e_rekam_medis/detail/save_asesment_medis_awal_rawat_jalan') }}" method="post">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" id="hide_ruangan" name="ruangan" />
        <input type="hidden" id="hide_keluhan_utama" name="keluhan_utama" />
        <input type="hidden" id="hide_riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" />
        <input type="hidden" id="hide_riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu" />
        <input type="hidden" id="hide_riwayat_alergi_obat" name="riwayat_alergi_obat" />
        <input type="hidden" id="hide_kesadaran" name="kesadaran" />
        <input type="hidden" id="hide_ket_sopor_koma" name="ket_sopor_koma" />
        <input type="hidden" id="hide_kesadaran_umum" name="kesadaran_umum" />
        <input type="hidden" id="hide_berat_badan" name="berat_badan" />
        <input type="hidden" id="hide_saudara" name="saudara" />
        <input type="hidden" id="hide_ket_kandung" name="ket_kandung" />
        <input type="hidden" id="hide_ket_tiri" name="ket_tiri" />
        <input type="hidden" id="hide_tinggal_bersama" name="tinggal_bersama" />
        <input type="hidden" id="hide_ket_tinggal_lainnya" name="ket_tinggal_lainnya" />
        <input type="hidden" id="hide_bicara" name="bicara" />
        <input type="hidden" id="hide_komunikasi" name="komunikasi" />
        <input type="hidden" id="hide_emosional" name="emosional" />
        <input type="hidden" id="hide_gangguan_jiwa" name="gangguan_jiwa" />
        <input type="hidden" id="hide_tahun_gangguan_jiwa" name="tahun_gangguan_jiwa" />
        <input type="hidden" id="hide_riwayat_trauma" name="riwayat_trauma" />
        <input type="hidden" id="hide_ket_kriminal" name="ket_kriminal" />
        <input type="hidden" id="hide_perasaan" name="perasaan" />
        <input type="hidden" id="hide_wawancara" name="wawancara" />
        <input type="hidden" id="hide_spiritual" name="spiritual" />
        <input type="hidden" id="hide_kebutuhan_spiritual" name="kebutuhan_spiritual" />
        <input type="hidden" id="hide_agama_spiritual" name="agama_spiritual" />
        <input type="hidden" id="hide_bantuan_ibadah" name="bantuan_ibadah" />
        <input type="hidden" id="hide_status_pernikahan" name="status_pernikahan" />
        <input type="hidden" id="hide_pekerjaan" name="pekerjaan" />
        <input type="hidden" id="hide_pekerjaan_lain_lain" name="pekerjaan_lain_lain" />
        <input type="hidden" id="hide_nyeri" name="nyeri" />
        <input type="hidden" id="hide_sifat_nyeri" name="sifat_nyeri" />
        <input type="hidden" id="hide_kualitas_nyeri" name="kualitas_nyeri" />
        <input type="hidden" id="hide_nyeri_menjalar" name="nyeri_menjalar" />
        <input type="hidden" id="hide_ket_nyeri_menjalar" name="ket_nyeri_menjalar" />
        <input type="hidden" id="hide_skor_nyeri" name="skor_nyeri" />
        <input type="hidden" id="hide_frekuensi_nyeri" name="frekuensi_nyeri" />
        <input type="hidden" id="hide_pengaruh_nyeri" name="pengaruh_nyeri" />
        <input type="hidden" id="hide_cara_berjalan" name="cara_berjalan" />
        <input type="hidden" id="hide_memegang_kursi" name="memegang_kursi" />
        <input type="hidden" id="hide_hasil_resiko_jatuh" name="hasil_resiko_jatuh" />
        <input type="hidden" id="hide_beritahu_dokter" name="beritahu_dokter" />
        <input type="hidden" id="hide_jam_diberitahukan" name="jam_diberitahukan" />
        <input type="hidden" id="hide_hasil_skrining_resiko_jatuh" name="hasil_skrining_resiko_jatuh" />
        <input type="hidden" id="hide_saran_resiko_jatuh" name="saran_resiko_jatuh" />
        <input type="hidden" id="hide_bb_gizi" name="bb_gizi" />
        <input type="hidden" id="hide_pb_gizi" name="pb_gizi" />
        <input type="hidden" id="hide_imt_gizi" name="imt_gizi" />
        <input type="hidden" id="hide_tampak_kurus" name="tampak_kurus" />
        <input type="hidden" id="hide_penurunan_bb" name="penurunan_bb" />
        <input type="hidden" id="hide_asupan_makanan" name="asupan_makanan" />
        <input type="hidden" id="hide_hasil_skrining_gizi" name="hasil_skrining_gizi" />
        <input type="hidden" id="hide_saran_skrining_gizi" name="saran_skrining_gizi" />
        <input type="hidden" id="hide_sensorik_penglihatan" name="sensorik_penglihatan" />
        <input type="hidden" id="hide_sensorik_penciuman" name="sensorik_penciuman" />
        <input type="hidden" id="hide_sensorik_pendengaran" name="sensorik_pendengaran" />
        <input type="hidden" id="hide_kognitif_satu" name="kognitif_satu" />
        <input type="hidden" id="hide_kognitif_dua" name="kognitif_dua" />
        <input type="hidden" id="hide_motorik_satu" name="motorik_satu" />
        <input type="hidden" id="hide_motorik_dua" name="motorik_dua" />
        <input type="hidden" id="hide_saran_satu" name="saran_satu" />
        <input type="hidden" id="hide_saran_dua" name="saran_dua" />
        <input type="hidden" id="hide_saran_tiga" name="saran_tiga" />
        <input type="hidden" id="hide_hasil_discharge_planning" name="hasil_discharge_planning" />
        <input type="hidden" id="hide_saran_discharge_planning" name="saran_discharge_planning" />
        <input type="hidden" id="hide_pemeriksaan_penunjang" name="pemeriksaan_penunjang" />
        <input type="hidden" id="hide_status_generalis" name="status_generalis" />
        <input type="hidden" id="hide_kontrol_ulang" name="kontrol_ulang" />
        <input type="hidden" id="hide_tgl_kontrol_ulang" name="tgl_kontrol_ulang" />
        <input type="hidden" id="hide_rujuk" name="rujuk" />
        <input type="hidden" id="hide_tgl_rujuk" name="tgl_rujuk" />
        <input type="hidden" id="hide_penyampaian_edukasi" name="penyampaian_edukasi" />
        <input type="hidden" id="hide_subyektif" name="subyektif" />
        <input type="hidden" id="hide_id_ppa" name="id_ppa" />
        <input type="hidden" id="hide_ppa" name="ppa" />
        <input type="hidden" id="hide_instruksi_kesehatan" name="instruksi_kesehatan" />
        <input type="hidden" id="hide_nama_obat_1" name="nama_obat_1" />
        <input type="hidden" id="hide_jumlah_obat_1" name="jumlah_obat_1" />
        <input type="hidden" id="hide_aturan_pakai_obat_1" name="aturan_pakai_obat_1" />
        <input type="hidden" id="hide_tanggal_mulai_minum_obat_1" name="tanggal_mulai_minum_obat_1" />
        <input type="hidden" id="hide_keterangan_obat_1" name="keterangan_obat_1" />
        <input type="hidden" id="hide_nama_obat_2" name="nama_obat_2" />
        <input type="hidden" id="hide_jumlah_obat_2" name="jumlah_obat_2" />
        <input type="hidden" id="hide_aturan_pakai_obat_2" name="aturan_pakai_obat_2" />
        <input type="hidden" id="hide_tanggal_mulai_minum_obat_2" name="tanggal_mulai_minum_obat_2" />
        <input type="hidden" id="hide_keterangan_obat_2" name="keterangan_obat_2" />
        <input type="hidden" id="hide_nama_obat_3" name="nama_obat_3" />
        <input type="hidden" id="hide_jumlah_obat_3" name="jumlah_obat_3" />
        <input type="hidden" id="hide_aturan_pakai_obat_3" name="aturan_pakai_obat_3" />
        <input type="hidden" id="hide_tanggal_mulai_minum_obat_3" name="tanggal_mulai_minum_obat_3" />
        <input type="hidden" id="hide_keterangan_obat_3" name="keterangan_obat_3" />
        <input type="hidden" id="hide_nama_obat_4" name="nama_obat_4" />
        <input type="hidden" id="hide_jumlah_obat_4" name="jumlah_obat_4" />
        <input type="hidden" id="hide_aturan_pakai_obat_4" name="aturan_pakai_obat_4" />
        <input type="hidden" id="hide_tanggal_mulai_minum_obat_4" name="tanggal_mulai_minum_obat_4" />
        <input type="hidden" id="hide_keterangan_obat_4" name="keterangan_obat_4" />
        <input type="hidden" id="hide_nama_obat_5" name="nama_obat_5" />
        <input type="hidden" id="hide_jumlah_obat_5" name="jumlah_obat_5" />
        <input type="hidden" id="hide_aturan_pakai_obat_5" name="aturan_pakai_obat_5" />
        <input type="hidden" id="hide_tanggal_mulai_minum_obat_5" name="tanggal_mulai_minum_obat_5" />
        <input type="hidden" id="hide_keterangan_obat_5" name="keterangan_obat_5" />
        <input type="hidden" id="hide_nama_obat_6" name="nama_obat_6" />
        <input type="hidden" id="hide_jumlah_obat_6" name="jumlah_obat_6" />
        <input type="hidden" id="hide_aturan_pakai_obat_6" name="aturan_pakai_obat_6" />
        <input type="hidden" id="hide_tanggal_mulai_minum_obat_6" name="tanggal_mulai_minum_obat_6" />
        <input type="hidden" id="hide_keterangan_obat_6" name="keterangan_obat_6" />
        <input type="hidden" name="gcs_e" id="hide_gcs_e">
        <input type="hidden" name="gcs_v" id="hide_gcs_v">
        <input type="hidden" name="gcs_m" id="hide_gcs_m">
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
                <tr>
                    <td style="width: 40%;">NIK</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->ktp }}</td>
                </tr>
            </table>
        </div>
    </div>
    <form action="#" onsubmit="return fake_submit()" id="formulir">
        <div style="border:1px solid; margin-top: -17px;">
            <div class="row pb-3" style="width: 100%; margin-left: 0;">
                <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
                    <h6 style="color: white">ASESMENT MEDIS AWAL RAWAT JALAN</h6>
                </div>
            </div>
            <p>* Beri tanda &#9989 pada tanda <input type="checkbox" readonly disabled></p>
            <table class="table_isian" style="border-collapse:collapse; border: 1px solid; width: 100%;">
                <tr>
                    <td colspan="2" class="text-center" style="width: 33%;">
                        Tanggal Kunjungan : {{ date('d-m-Y', strtotime($dokumen->created_at)) }}
                    </td>
                    <td colspan="2" class="text-center" class="text-center" style="width: 33%;">
                        Pukul : {{ date('H:i', strtotime($dokumen->created_at)) }}
                    </td>
                    <td colspan="2" class="text-center" style="width: 33%;">
                        Unit Kerja : <input type="text" style="border: 0; border-bottom: 2px dotted;"
                            id="ruangan" required
                            value="{{ $dokumen->asesment_medis_awal ? ucwords(str_replace('_', ' ', $dokumen->asesment_medis_awal->last_nama_ruangan)) : $layanan->last_nama_ruangan }}">
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>ANAMNESIS</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table style="width:100%; border: hidden" id="tabel_subyektif">
                            <tr>
                                <td style="width: 20%;">Keluhan Utama</td>
                                <td style="width:5%; text-align: center; border-left: hidden; border-right: hidden"> :
                                </td>
                                <td style="width: 75%;">
                                    <input type="text" class="form-control" required
                                        value="@if(old('keluhan_utama')) {{ old('keluhan_utama') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keluhan_utama : '' }}@endif"
                                        id="keluhan_utama">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Riwayat Penyakit Sekarang</td>
                                <td style="width:5%; text-align: center; border-left: hidden; border-right: hidden"> :
                                </td>
                                <td style="width: 75%;">
                                    <input type="text" class="form-control" required
                                        value="@if(old('riwayat_penyakit_sekarang')) {{ old('riwayat_penyakit_sekarang') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->riwayat_penyakit_sekarang : '' }}@endif"
                                        id="riwayat_penyakit_sekarang">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Riwayat Penyakit Dahulu</td>
                                <td style="width:5%; text-align: center; border-left: hidden; border-right: hidden"> :
                                </td>
                                <td style="width: 75%;">
                                    <input type="text" class="form-control" required
                                        value="@if(old('riwayat_penyakit_dahulu')) {{ old('riwayat_penyakit_dahulu') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->riwayat_penyakit_dahulu : '' }}@endif"
                                        id="riwayat_penyakit_dahulu">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Riwayat Alergi Obat</td>
                                <td style="width:5%; text-align: center; border-left: hidden; border-right: hidden"> :
                                </td>
                                <td style="width: 75%;">
                                    <input type="text" class="form-control" required
                                        value="@if(old('riwayat_alergi_obat')) {{ old('riwayat_alergi_obat') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->riwayat_alergi_obat : '' }}@endif"
                                        id="riwayat_alergi_obat">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>PEMERIKSAAN FISIK</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Kesadaran</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td colspan="4">
                        <input onclick="cek_radio_kesadaran()" required
                            @if (old('kesadaran')) {{ old('kesadaran') == 'compos_mentis' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'compos_mentis' ? 'checked' : '') : 'checked' }} @endif
                            type="radio" value="compos_mentis" name="radio_kesadaran"> Compos Mentis
                        <input onclick="cek_radio_kesadaran()"
                            @if (old('kesadaran')) {{ old('kesadaran') == 'apatis' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'apatis' ? 'checked' : '') : '' }} @endif
                            type="radio" value="apatis" name="radio_kesadaran" class="ml-4"> Apatis
                        <input onclick="cek_radio_kesadaran()"
                            @if (old('kesadaran')) {{ old('kesadaran') == 'somnolen' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'somnolen' ? 'checked' : '') : '' }} @endif
                            type="radio" value="somnolen" name="radio_kesadaran" class="ml-4"> Somnolen
                        <input onclick="cek_radio_kesadaran()"
                            @if (old('kesadaran')) {{ old('kesadaran') == 'sopor_koma' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'sopor_koma' ? 'checked' : '') : '' }} @endif
                            type="radio" value="sopor_koma" name="radio_kesadaran" class="ml-4"> Sopor
                        koma/Koma,
                        <input type="text" readonly {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->kesadaran == 'sopor_koma' ? 'required' : '' : '' }}
                            value="@if (old('ket_sopor_koma')) {{ old('ket_sopor_koma') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_sopor_koma : '' }} @endif"
                            id="ket_sopor_koma" style="border: 0; border-bottom: 2px dotted;"
                            @if (old('kesadaran')) {{ old('kesadaran') == 'sopor_koma' ? '' : 'readonly' }}
                    @else
                    {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kesadaran == 'sopor_koma' ? '' : 'readonly') : 'readonly' }} @endif>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">GCS</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td style="widtn: 88%" colspan="4">
                        E : <input type="text" style="border: none; border-bottom: 2px dotted;" value="{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->gcs_e : '' }}" id="gcs_e">
                        V : <input type="text" style="border: none; border-bottom: 2px dotted;" value="{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->gcs_v : '' }}" id="gcs_v">
                        M : <input type="text" style="border: none; border-bottom: 2px dotted;" value="{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->gcs_m : '' }}" id="gcs_m">
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Keadaan Umum</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td style="border-right: hidden">
                        <input type="text" required
                            value="{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->kesadaran_umum : ($layanan ? $layanan->tanda_vital ? $layanan->tanda_vital->keadaan_umum : '' : '') }}"
                            id="kesadaran_umum" style="border: 0; border-bottom: 2px dotted;">
                    </td>
                    <td style="width: 10%; border-right: hidden">Berat Badan</td>
                    <td colspan="2">: <input type="number" required
                            value="@if(old('berat_badan')) {{ old('berat_badan') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->berat_badan == '' ? ($layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '') : $dokumen->asesment_medis_awal->berat_badan : ($layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '') }}@endif"
                            id="berat_badan" style="border: 0; border-bottom: 2px dotted;"> Kg
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Tanda - Tanda Vital</td>
                    <td style="width: 2%; border-left: hidden; border-right: hidden;">:</td>
                    <td colspan="4">
                        <div class="row">
                            <div class="col-md-2">
                                TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                            </div>
                            <div class="col-md-2">
                                RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                            </div>
                            <div class="col-md-2">
                                Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                            </div>
                            <div class="col-md-2">
                                Suhu {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} ᵒC
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>STATUS PSIKOLOGIS, SOSIAL SPIRITUAL</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Saudara</td>
                    <td colspan="2" style="padding-left: 10px">
                        <input onclick="cek_radio_saudara()" required
                            @if (old('saudara')) {{ old('saudara') == 'kandung' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'kandung' ? 'checked' : '') : '' }} @endif
                            type="radio" value="kandung" name="radio_saudara"> Kandung, Jumlah
                        <input type="number" readonly {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'kandung' ? 'required' : '') : '' }}
                            value="@if (old('ket_kandung')) {{ old('ket_kandung') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_kandung : '' }} @endif"
                            id="ket_kandung" style="border: 0; border-bottom: 2px dotted;"
                            @if (old('saudara')) {{ old('saudara') == 'kandung' ? '' : 'readonly' }}
                    @else
                    {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'kandung' ? '' : 'readonly') : 'readonly' }} @endif>
                    </td>
                    <td colspan="3" style="border-left: hidden">
                        <input onclick="cek_radio_saudara()"
                            @if (old('saudara')) {{ old('saudara') == 'tiri' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'tiri' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tiri" name="radio_saudara"> Tiri, Jumlah
                        <input type="number" readonly {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'tiri' ? 'required' : '') : '' }}
                            value="@if (old('ket_tiri')) {{ old('ket_tiri') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_tiri : '' }} @endif"
                            id="ket_tiri" style="border: 0; border-bottom: 2px dotted;"
                            @if (old('saudara')) {{ old('saudara') == 'tiri' ? '' : 'readonly' }}
                    @else
                    {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saudara == 'tiri' ? '' : 'readonly') : 'readonly' }} @endif>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Tinggal Bersama</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input onclick="cek_radio_tinggal_bersama()" required
                                    @if (old('tinggal_bersama')) {{ old('tinggal_bersama') == 'ortu' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tinggal_bersama == 'ortu' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="ortu" name="radio_tinggal_bersama"> Orang Tua
                            </div>
                            <div class="col-md-4">
                                <input onclick="cek_radio_tinggal_bersama()"
                                    @if (old('tinggal_bersama')) {{ old('tinggal_bersama') == 'tinggal_lainnya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tinggal_bersama == 'tinggal_lainnya' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tinggal_lainnya" name="radio_tinggal_bersama"> Lainnya,
                                <input type="text" value="" id="ket_tinggal_lainnya" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tinggal_bersama == 'tinggal_lainnya' ? 'required' : '') : '' }}
                                    value="@if (old('ket_tinggal_lainnya')) {{ old('ket_tinggal_lainnya') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_tinggal_lainnya : '' }} @endif"
                                    style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('tinggal_bersama')) {{ old('tinggal_bersama') == 'tinggal_lainnya' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tinggal_bersama == 'tinggal_lainnya' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Bicara</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input required
                                    @if (old('bicara')) {{ old('bicara') == 'jelas' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->bicara == 'jelas' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="jelas" name="radio_bicara"> Jelas
                            </div>
                            <div class="col-md-4">
                                <input
                                    @if (old('bicara')) {{ old('bicara') == 'tidak_dimengerti' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->bicara == 'tidak_dimengerti' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tidak_dimengerti" name="radio_bicara"> Tidak Dapat
                                Dimengerti
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Komunikasi</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input required
                                    @if (old('komunikasi')) {{ old('komunikasi') == 'verbal' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->komunikasi == 'verbal' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="verbal" name="radio_komunikasi"> Verbal
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('komunikasi')) {{ old('komunikasi') == 'non_verbal' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->komunikasi == 'non_verbal' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="non_verbal" name="radio_komunikasi"> Non Verbal
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Status Emosional</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input required
                                    @if (old('emosional')) {{ old('emosional') == 'stabil' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'stabil' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="stabil" name="radio_emosional"> Stabil
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('emosional')) {{ old('emosional') == 'tenang' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'tenang' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tenang" name="radio_emosional"> Tenang
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('emosional')) {{ old('emosional') == 'cemas' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'cemas' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="cemas" name="radio_emosional"> Cemas
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('emosional')) {{ old('emosional') == 'takut' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->emosional == 'takut' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="takut" name="radio_emosional"> Takut
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-md-3">Riwayat pernah mengalami gangguan jiwa</div>
                            <div>:</div>
                            <div class="col-md-1">
                                <input onclick="cek_radio_gangguan_jiwa()" required
                                    @if (old('gangguan_jiwa')) {{ old('gangguan_jiwa') == 'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->gangguan_jiwa == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak" name="radio_gangguan_jiwa"> Tidak
                            </div>
                            <div class="col-md-4">
                                <input onclick="cek_radio_gangguan_jiwa()"
                                    @if (old('gangguan_jiwa')) {{ old('gangguan_jiwa') == 'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->gangguan_jiwa == 'ya' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="ya" name="radio_gangguan_jiwa"> Ya, Tahun :
                                <input type="number" id="tahun_gangguan_jiwa" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->gangguan_jiwa == 'ya' ? 'required' : '') : '' }}
                                    value="@if (old('tahun_gangguan_jiwa')) {{ old('tahun_gangguan_jiwa') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tahun_gangguan_jiwa : '' }} @endif"
                                    style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('gangguan_jiwa')) {{ old('gangguan_jiwa') == 'ya' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->gangguan_jiwa == 'ya' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Riwayat Trauma</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input onclick="cek_radio_riwayat_trauma()" required
                                    @if (old('riwayat_trauma')) {{ old('riwayat_trauma') == 'tidak_ada' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'tidak_ada' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak_ada" name="radio_trauma"> Tidak Ada
                            </div>
                            <div class="col-md-2">
                                <input onclick="cek_radio_riwayat_trauma()"
                                    @if (old('riwayat_trauma')) {{ old('riwayat_trauma') == 'aniaya_fisik' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'aniaya_fisik' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="aniaya_fisik" name="radio_trauma"> Aniaya Fisik
                            </div>
                            <div class="col-md-2">
                                <input onclick="cek_radio_riwayat_trauma()"
                                    @if (old('riwayat_trauma')) {{ old('riwayat_trauma') == 'psikologis' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'psikologis' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="psikologis" name="radio_trauma"> Psikologis
                            </div>
                            <div class="col-md-2">
                                <input onclick="cek_radio_riwayat_trauma()"
                                    @if (old('riwayat_trauma')) {{ old('riwayat_trauma') == 'kdrt' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'kdrt' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kdrt" name="radio_trauma"> KDRT
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input onclick="cek_radio_riwayat_trauma()"
                                    @if (old('riwayat_trauma')) {{ old('riwayat_trauma') == 'pemerkosaan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'pemerkosaan' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="pemerkosaan" name="radio_trauma"> Aniaya Sex/Pemerkosaan
                            </div>
                            <div class="col-md-8">
                                <input onclick="cek_radio_riwayat_trauma()"
                                    @if (old('riwayat_trauma')) {{ old('riwayat_trauma') == 'kriminal' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'kriminal' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kriminal" name="radio_trauma"> Tindakan Kriminal, Sebutkan
                                :
                                <input type="text" readonly
                                    value="@if (old('ket_kriminal')) {{ old('ket_kriminal') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_kriminal : '' }} @endif"
                                    id="ket_kriminal" style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('riwayat_trauma')) {{ old('riwayat_trauma') == 'kriminal' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->riwayat_trauma == 'kriminal' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Alam Perasaan</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input required
                                    @if (old('perasaan')) {{ old('perasaan') == 'sedih' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'sedih' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="sedih" name="radio_perasaan"> Sedih
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('perasaan')) {{ old('perasaan') == 'putus_asa' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'putus_asa' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="putus_asa" name="radio_perasaan"> Putus Asa
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('perasaan')) {{ old('perasaan') == 'ketakutan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'ketakutan' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="ketakutan" name="radio_perasaan"> Ketakutan
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('perasaan')) {{ old('perasaan') == 'gembira_berlebih' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->perasaan == 'gembira_berlebih' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="gembira_berlebih" name="radio_perasaan"> Gembira Berlebih
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Interaksi Selama Wawancara</td>
                    <td colspan="5" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input required
                                    @if (old('wawancara')) {{ old('wawancara') == 'Kooperatif' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'Kooperatif' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="Kooperatif" name="radio_wawancara"> Kooperatif
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('wawancara')) {{ old('wawancara') == 'bermusuhan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'bermusuhan' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="bermusuhan" name="radio_wawancara"> Bermusuhan
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('wawancara')) {{ old('wawancara') == 'tidak_kooperatif' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'tidak_kooperatif' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tidak_kooperatif" name="radio_wawancara"> Tidak Kooperatif
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('wawancara')) {{ old('wawancara') == 'mudah_tersinggung' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'mudah_tersinggung' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="mudah_tersinggung" name="radio_wawancara"> Mudah
                                Tersinggung
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input
                                    @if (old('wawancara')) {{ old('wawancara') == 'kontak_mata' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->wawancara == 'kontak_mata' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kontak_mata" name="radio_wawancara"> Kontak Mata Berkurang
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-md-3">Kebutuhan Spiritual Pasien</div>
                            <div>:</div>
                            <div class="col-md-1">
                                <input required
                                    @if (old('spiritual')) {{ old('spiritual') == 'baik' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->spiritual == 'baik' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="baik" name="radio_spiritual"> Baik
                            </div>
                            <div class="col-md-4">
                                <input
                                    @if (old('spiritual')) {{ old('spiritual') == 'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->spiritual == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak" name="radio_spiritual"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-md-3">Pasien Membutuhkan Spiritual Agama :</div>
                            <div>:</div>
                            <div class="col-md-1">
                                <input onclick="cek_radio_kebutuhan_spiritual()" required
                                    @if (old('kebutuhan_spiritual')) {{ old('kebutuhan_spiritual') == 'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kebutuhan_spiritual == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak" name="radio_butuh_spiritual"> tidak
                            </div>
                            <div class="col-md-4">
                                <input onclick="cek_radio_kebutuhan_spiritual()"
                                    @if (old('kebutuhan_spiritual')) {{ old('kebutuhan_spiritual') == 'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kebutuhan_spiritual == 'ya' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="ya" name="radio_butuh_spiritual"> Ya, Agama :
                                <input type="text" id="agama_spiritual" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kebutuhan_spiritual == 'ya' ? 'required' : '') : '' }}
                                    value="@if (old('agama_spiritual')) {{ old('agama_spiritual') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->agama_spiritual : '' }} @endif"
                                    style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('kebutuhan_spiritual')) {{ old('kebutuhan_spiritual') == 'ya' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kebutuhan_spiritual == 'ya' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        Pasien Membutuhkan Bantuan dalam Menjalakan Ibadah dan Menyetujuinya :
                        <input type="text" required
                            value="@if (old('bantuan_ibadah')) {{ old('bantuan_ibadah') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->bantuan_ibadah : '' }} @endif"
                            id="bantuan_ibadah" style="border: 0; border-bottom: 2px dotted;">
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>STATUS EKONOMI</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Status Pernikahan</td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input required
                                    @if (old('status_pernikaan')) {{ old('status_pernikaan') == 'single' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->status_pernikahan == 'single' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="single" name="radio_status_pernikahan"> Single
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('status_pernikahan')) {{ old('status_pernikahan') == 'menikah' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->status_pernikahan == 'menikah' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="menikah" name="radio_status_pernikahan"> Menikah
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('status_pernikahan')) {{ old('status_pernikahan') == 'janda_duda' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->status_pernikahan == 'janda_duda' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="janda_duda" name="radio_status_pernikahan"> Janda / Duda
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">Pekerjaan</td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4" style="padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <input onclick="cek_radio_pekerjaan()" required
                                    @if (old('pekerjaan')) {{ old('pekerjaan') == 'pns' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'pns' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="pns" name="radio_pekerjaan"> PNS
                            </div>
                            <div class="col-md-2">
                                <input onclick="cek_radio_pekerjaan()"
                                    @if (old('pekerjaan')) {{ old('pekerjaan') == 'swasta' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'swasta' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="swasta" name="radio_pekerjaan"> Swasta
                            </div>
                            <div class="col-md-2">
                                <input onclick="cek_radio_pekerjaan()"
                                    @if (old('pekerjaan')) {{ old('pekerjaan') == 'tni_polri' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'tni_polri' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tni_polri" name="radio_pekerjaan"> TNI/POLRI
                            </div>
                            <div class="col-md-4">
                                <input onclick="cek_radio_pekerjaan()"
                                    @if (old('pekerjaan')) {{ old('pekerjaan') == 'lain_lain' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'lain_lain' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="lain_lain" name="radio_pekerjaan"> Lain-lain
                                <input type="text" readonly {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'lain_lain' ? 'required' : '') : '' }}
                                    value="@if (old('pekerjaan_lain_lain')) {{ old('pekerjaan_lain_lain') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->pekerjaan_lain_lain : '' }} @endif"
                                    id="pekerjaan_lain_lain" style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('pekerjaan')) {{ old('pekerjaan') == 'lain_lain' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pekerjaan == 'lain_lain' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>ASESMEN NYERI</b>
                    </td>
                </tr>
                <tr style="border-bottom: hidden">
                    <td colspan="3" style="border-right: hidden">
                        Nyeri :
                        <input required
                            @if (old('nyeri')) {{ old('nyeri') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                            type="radio" value="tidak" name="radio_nyeri"> Tidak
                        <input
                            @if (old('nyeri')) {{ old('nyeri') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_nyeri"> Ya
                    </td>
                    <td colspan="3">
                        Sifat :
                        <input {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'ya' ? 'required' : '') : '' }}
                            @if (old('sifat_nyeri')) {{ old('sifat_nyeri') == 'akut' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sifat_nyeri == 'akut' ? 'checked' : '') : '' }} @endif
                            type="radio" value="akut" name="radio_sifat_nyeri"> Akut
                        <input
                            @if (old('sifat_nyeri')) {{ old('sifat_nyeri') == 'kronis' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sifat_nyeri == 'kronis' ? 'checked' : '') : '' }} @endif
                            type="radio" value="kronis" name="radio_sifat_nyeri"> Kronis
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-md-12 pt-2">
                                <table style="width: 100%;" border="1">
                                    <tr>
                                        <td style="width: 16.5%;">
                                            <p style="font-size:100px; text-align: center;">&#128516;</p>
                                        </td>
                                        <td style="width: 16.5%;">
                                            <p style="font-size:100px; text-align: center;">&#128522;</p>
                                        </td>
                                        <td style="width: 16.5%;">
                                            <p style="font-size:100px; text-align: center;">&#128528;</p>
                                        </td>
                                        <td style="width: 16.5%;">
                                            <p style="font-size:100px; text-align: center;">&#128542;</p>
                                        </td>
                                        <td style="width: 16.5%;">
                                            <p style="font-size:100px; text-align: center;">&#128534;</p>
                                        </td>
                                        <td style="width: 16.5%;">
                                            <p style="font-size:100px; text-align: center;">&#128557;</p>
                                        </td>
                                    </tr>
                                    <tr class="text-center" style="font-weight: bold;">
                                        <td>0<br>Tidak sakit</td>
                                        <td>2<br>Sedikit sakit</td>
                                        <td>4<br>Agak mengganggu</td>
                                        <td>6<br>Mengganggu aktivitas</td>
                                        <td>8<br>Sangat mengganggu</td>
                                        <td>10<br>Tak tertahankan</td>
                                    </tr>
                                </table>
                                <!-- <img src="{{ asset('images/asesmen_nyeri.png') }}" alt=""> -->
                            </div>
                            <div class="col-md-12">
                                <p>Klasifikasi nyeri : </p>
                            </div>
                            <div class="col-md-4">
                                <ul style="list-style-type: none; margin-left: -30px;">
                                    <li>0 = tidak ada nyeri</li>
                                    <li>1 = nyeri seperti gatal, nyut-nyutan</li>
                                    <li>2 = nyeri seperti melilit atau terpukul</li>
                                    <li>3 = nyeri seperti perih atau mules</li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul style="list-style-type: none; margin-left: -70px;">
                                    <li>4 = nyeri seperti kram atau kaku</li>
                                    <li>5 = nyeri seperti tertekan</li>
                                    <li>6 = nyeri seperti terbakar atau ditusuk-tusuk</li>
                                    <li>7-9 = sangat nyeri tapi masih bisa dikontrol oleh pasien</li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul style="list-style-type: none; margin-left: -30px;">
                                    <li>10 = sangat nyeri, tidak dapat dikontrol oleh pasien</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">1. Kualitas Nyeri</div>
                            <div>:</div>
                            <div class="col-md-2">
                                <input {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'ya' ? 'required' : '') : '' }}
                                    @if (old('kualitas_nyeri')) {{ old('kualitas_nyeri') == 'nyeri_tumpul' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kualitas_nyeri == 'nyeri_tumpul' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="nyeri_tumpul" name="radio_kualitas_nyeri"> Nyeri Tumpul
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('kualitas_nyeri')) {{ old('kualitas_nyeri') == 'nyeri_tajam' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="nyeri_tajam" name="radio_kualitas_nyeri"> Nyeri Tajam
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('kualitas_nyeri')) {{ old('kualitas_nyeri') == 'panas' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kualitas_nyeri == 'panas' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="panas" name="radio_kualitas_nyeri"> Panas / Terbakar
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">2. Menjalar</div>
                            <div>:</div>
                            <div class="col-md-2">
                                <input onclick="cek_radio_nyeri_menjalar()" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'ya' ? 'required' : '') : '' }}
                                    @if (old('nyeri_menjalar')) {{ old('nyeri_menjalar') == 'tidak' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri_menjalar == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak" name="radio_menjalar"> Tidak
                            </div>
                            <div class="col-md-6">
                                <input onclick="cek_radio_nyeri_menjalar()"
                                    @if (old('nyeri_menjalar')) {{ old('nyeri_menjalar') == 'ya' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri_menjalar == 'ya' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="ya" name="radio_menjalar"> Ya, Ke
                                <input type="text" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri_menjalar == 'ya' ? 'required' : '') : '' }}
                                    value="@if (old('ket_nyeri_menjalar')) {{ old('ket_nyeri_menjalar') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_nyeri_menjalar : '' }} @endif"
                                    id="ket_nyeri_menjalar" style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('nyeri_menjalar')) {{ old('nyeri_menjalar') == 'ya' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri_menjalar == 'ya' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">3. Skor Nyeri</div>
                            <div>:</div>
                            <div class="col-md-9">
                                <select id="skor_nyeri" class="form-control" style="width: 15%;">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option
                                            @if (old('skor_nyeri')) {{ old('skor_nyeri') == $i ? 'selected' : '' }}
                                        @elseif(isset($dokumen->asesment_medis_awal))
                                            {{ $dokumen->asesment_medis_awal->skor_nyeri == $i ? 'selected' : '' }} @endif
                                            value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">4. Frekuensi Nyeri</div>
                            <div>:</div>
                            <div class="col-md-2">
                                <input {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'ya' ? 'required' : '') : '' }}
                                    @if (old('frekuensi_nyeri')) {{ old('frekuensi_nyeri') == 'jarang' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->frekuensi_nyeri == 'jarang' ? 'checked' : '') : 'required' }} @endif
                                    type="radio" value="jarang" name="radio_frekuensi_nyeri"> Jarang
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('frekuensi_nyeri')) {{ old('frekuensi_nyeri') == 'hilang_timbul' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="hilang_timbul" name="radio_frekuensi_nyeri"> Hilang Timbul
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('frekuensi_nyeri')) {{ old('frekuensi_nyeri') == 'terus_menerus' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->frekuensi_nyeri == 'terus_menerus' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="terus_menerus" name="radio_frekuensi_nyeri"> Terus Menerus
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">5. Nyeri Mempengaruhi</div>
                            <div>:</div>
                            <div class="col-md-2">
                                <input {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->nyeri == 'ya' ? 'required' : '') : '' }}
                                    @if (old('pengaruh_nyeri')) {{ old('pengaruh_nyeri') == 'tidur' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'tidur' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tidur" name="radio_pengaruh_nyeri"> Tidur
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('pengaruh_nyeri')) {{ old('pengaruh_nyeri') == 'aktifitas_fisik' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="aktifitas_fisik" name="radio_pengaruh_nyeri"> Aktifitas
                                Fisik
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('pengaruh_nyeri')) {{ old('pengaruh_nyeri') == 'konsentrasi' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'konsentrasi' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="konsentrasi" name="radio_pengaruh_nyeri"> Konsentrasi
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('pengaru_nyeri')) {{ old('pengaru_nyeri') == 'emosi' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'emosi' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="emosi" name="radio_pengaruh_nyeri"> Emosi
                            </div>
                            <div class="offset-2 col-md-2" style="padding-left: 19px">
                                <input
                                    @if (old('pengaru_nyeri')) {{ old('pengaru_nyeri') == 'nafsu_makan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->pengaruh_nyeri == 'nafsu_makan' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="nafsu_makan" name="radio_pengaruh_nyeri"> Nafsu Makan
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>PENILAIAN RESIKO JATUH</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        a. Perhatikan cara berjalan pasien saat duduk di kursi. Apakah pasien tampak tidak seimbang
                        (sempoyongan) ?
                    </td>
                    <td style="padding-left: 10px">
                        <input 
                            @if (old('cara_berjalan')) {{ old('cara_berjalan') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->cara_berjalan == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_cara_berjalan"> Ya
                        <input
                            @if (old('cara_berjalan')) {{ old('cara_berjalan') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->cara_berjalan == 'tidak' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak" name="radio_cara_berjalan"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan
                        duduk
                        ?
                    </td>
                    <td style="padding-left: 10px">
                        <input 
                            @if (old('memegang_kursi')) {{ old('memegang_kursi') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->memegang_kursi == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_memegang_kursi"> Ya
                        <input
                            @if (old('memegang_kursi')) {{ old('memegang_kursi') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->memegang_kursi == 'tidak' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak" name="radio_memegang_kursi"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="3" class="text-center">
                        <b>HASIL</b>
                    </td>
                    <td colspan="3" style="padding-left: 10px">
                        <input 
                            @if (old('hasil_resiko_jatuh')) {{ old('hasil_resiko_jatuh') == 'tidak_beresiko' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->hasil_resiko_jatuh == 'tidak_beresiko' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak_beresiko" name="radio_hasil"> Tidak Beresiko (Tidak ditemukan
                        a
                        dan b)
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 10px">
                        <input
                            @if (old('hasil_resiko_jatuh')) {{ old('hasil_resiko_jatuh') == 'resiko_rendah' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->hasil_resiko_jatuh == 'resiko_rendah' ? 'checked' : '') : '' }} @endif
                            type="radio" value="resiko_rendah" name="radio_hasil"> Resiko Rendah (Ditemukan a atau
                        b)
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 10px">
                        <input
                            @if (old('hasil_resiko_jatuh')) {{ old('hasil_resiko_jatuh') == 'resiko_tinggi' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->hasil_resiko_jatuh == 'resiko_tinggi' ? 'checked' : '') : '' }} @endif
                            type="radio" value="resiko_tinggi" name="radio_hasil"> Resiko Tinggi (Ditemukan a dan
                        b)
                    </td>
                </tr>
                <tr style="border-bottom: hidden">
                    <td colspan="6">
                        Diberitahukan kepada dokter :
                        <input onclick="cek_radio_beritahu_dokter()" 
                            @if (old('beritahu_dokter')) {{ old('beritahu_dokter') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->beritahu_dokter == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_beritahu_dokter"> Ya, Jam
                        <input type="time" readonly {{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->beritahu_dokter == 'ya' ? '' : '' : '' }}
                            value="@if (old('jam_diberitahukan')) {{ old('jam_diberitahukan') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jam_diberitahukan : '' }} @endif"
                            id="jam_diberitahukan" style="border: 0; border-bottom: 2px dotted;"
                            @if (old('beritahu_dokter')) {{ old('beritahu_dokter') == 'ya' ? '' : 'readonly' }}
                    @else
                    {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->beritahu_dokter == 'ya' ? '' : 'readonly') : 'readonly' }} @endif>
                        WIB
                        <input onclick="cek_radio_beritahu_dokter()"
                            @if (old('beritahu_dokter')) {{ old('beritahu_dokter') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->beritahu_dokter == 'tidak' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak" name="radio_beritahu_dokter"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <i>* (Jika Ya, Pasien diberi Gelang warna kuning)</i>
                    </td>
                </tr>
                <tr>
                    <td>
                        Hasil Skrining
                    </td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4">
                        <textarea required id="hasil_resiko_jatuh" class="form-control" rows="5" class="form-control">
@if (old('hasil_skrining_resiko_jatuh')){{ old('hasil_skrining_resiko_jatuh') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->hasil_skrining_resiko_jatuh : '' }}@endif
</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Saran
                    </td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4">
                        <textarea required id="saran_resiko_jatuh" class="form-control" rows="5" class="form-control">
@if (old('saran_resiko_jatuh')){{ old('saran_resiko_jatuh') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->saran_resiko_jatuh : '' }}@endif
</textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="6" class="text-center">
                        <b>SKRINING GIZI</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-md-4">
                                BB :
                                <input type="number" onkeyup="hitung_imt()" 
                                    value="@if(old('bb_gizi')) {{ old('bb_gizi') }}@else{{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->bb_gizi == '' ? ($layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '') : $dokumen->asesment_medis_awal->bb_gizi) : ($layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '') }}@endif"
                                    id="bb_gizi" min="0" step="0.01"
                                    style="border: 0; border-bottom: 2px dotted;"> Kg
                            </div>
                            <div class="col-md-4">
                                PB/TB :
                                <input type="number" onkeyup="hitung_imt()" 
                                    value="@if(old('pb_gizi')) {{ old('pb_gizi') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->pb_gizi : '' }}@endif"
                                    id="pb_gizi" min="0" step="0.01"
                                    style="border: 0; border-bottom: 2px dotted;"> cm
                            </div>
                            <div class="col-md-4">
                                IMT :
                                <input type="number" readonly 
                                    value="@if(old('imt_gizi')) {{ old('imt_gizi') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->imt_gizi : '' }}@endif"
                                    id="imt_gizi" style="border: 0; border-bottom: 2px dotted;">, BB/TB
                                (M<sup>3</sup>)
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        1. Apakah Klien tampak kurus ?
                    </td>
                    <td style="padding-left: 10px">
                        <input 
                            @if (old('tampak_kurus')) {{ old('tampak_kurus') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tampak_kurus == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_tampak_kurus"> Ya
                        <input
                            @if (old('tampak_kurus')) {{ old('tampak_kurus') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->tampak_kurus == 'tidak' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak" name="radio_tampak_kurus"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        2. Apakah terjadi kenaikan atau penurunan berat badan 1 bulan terakhir ?
                    </td>
                    <td style="padding-left: 10px">
                        <input 
                            @if (old('penurunan_bb')) {{ old('penurunan_bb') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penurunan_bb == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_penurunan_bb"> Ya
                        <input
                            @if (old('penurunan_bb')) {{ old('penurunan_bb') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penurunan_bb == 'tidak' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak" name="radio_penurunan_bb"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        3. Apakah asupan makanan menurut yang dikarenakan penurunan nafsu makan ?
                    </td>
                    <td style="padding-left: 10px">
                        <input 
                            @if (old('asupan_makanan')) {{ old('asupan_makanan') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->asupan_makanan == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_asupan_makanan"> Ya
                        <input
                            @if (old('asupan_makanan')) {{ old('asupan_makanan') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->asupan_makanan == 'tidak' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak" name="radio_asupan_makanan"> Tidak
                    </td>
                </tr>
                <tr>
                    <td>
                        Hasil Skrining
                    </td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4">
                        <textarea required id="hasil_skrining_gizi" class="form-control" rows="5" class="form-control">
@if (old('hasil_skrining_gizi')){{ old('hasil_skrining_gizi') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->hasil_skrining_gizi : '' }}@endif
</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Saran
                    </td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4">
                        <textarea required id="saran_skrining_gizi" class="form-control" rows="5" class="form-control">
@if (old('saran_skrining_gizi')){{ old('saran_skrining_gizi') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->saran_skrining_gizi : '' }}@endif
</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>ASSESMEN FUNGSIONAL</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <b>PENGKAJIAN FUNGSI</b>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" class="text-center">
                        a. Sensorik
                    </td>
                    <td style="border-right: hidden">Penglihatan</td>
                    <td colspan="4">
                        <div class="row">
                            <div class="col-md-3">
                                <input required
                                    @if (old('sensorik_penglihatan')) {{ old('sensorik_penglihatan') == 'normal' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'normal' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="normal" name="radio_sensorik_penglihatan"> Normal
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('sensorik_penglihatan')) {{ old('sensorik_penglihatan') == 'kabur' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'kabur' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kabur" name="radio_sensorik_penglihatan"> Kabur
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('sensorik_penglihatan')) {{ old('sensorik_penglihatan') == 'kacamata' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'kacamata' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kacamata" name="radio_sensorik_penglihatan"> Kacamata
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('sensorik_penglihatan')) {{ old('sensorik_penglihatan') == 'lensa_kontak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penglihatan == 'lensa_kontak' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="lensa_kontak" name="radio_sensorik_penglihatan"> Lensa
                                Kontak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">Penciuman</td>
                    <td colspan="4">
                        <div class="row">
                            <div class="col-md-3">
                                <input required
                                    @if (old('sensorik_penciuman')) {{ old('sensorik_penciuman') == 'normal' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penciuman == 'normal' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="normal" name="radio_sensorik_penciuman"> Normal
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('sensorik_penciuman')) {{ old('sensorik_penciuman') == 'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_penciuman == 'tidak' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tidak" name="radio_sensorik_penciuman"> Tidak
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: hidden">Pendengaran</td>
                    <td colspan="4">
                        <div class="row">
                            <div class="col-md-3">
                                <input required
                                    @if (old('sensorik_pendengaran')) {{ old('sensorik_pendengaran') == 'normal' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_pendengaran == 'normal' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="normal" name="radio_sensorik_pendengaran"> Normal
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('sensorik_pendengaran')) {{ old('sensorik_pendengaran') == 'tuli' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_pendengaran == 'tuli' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tuli" name="radio_sensorik_pendengaran"> Tuli
                                Kanan/Kiri
                            </div>
                            <div class="col-md-6">
                                <input
                                    @if (old('sensorik_pendengaran')) {{ old('sensorik_pendengaran') == 'alat_bantu' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->sensorik_pendengaran == 'alat_bantu' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="alat_bantu" name="radio_sensorik_pendengaran"> Alat
                                Bantu
                                dengar
                                kanan dan kiri
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="text-center">
                        b. Kognitif
                    </td>
                    <td colspan="5">
                        <div class="row">
                            <div class="col-md-3">
                                <input required
                                    @if (old('kognitif_satu')) {{ old('kognitif_satu') == 'normal' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_satu == 'normal' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="normal" name="radio_kognitif_satu"> Normal
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('kognitif_satu')) {{ old('kognitif_satu') == 'pelupa' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_satu == 'pelupa' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="pelupa" name="radio_kognitif_satu"> Pelupa
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="row">
                            <div class="col-md-3">
                                <input
                                    @if (old('kognitif_satu')) {{ old('kognitif_satu') == 'bingung' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_satu == 'bingung' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="bingung" name="radio_kognitif_satu"> Bingung
                            </div>
                            <div class="col-md-3">
                                <input
                                    @if (old('kognitif_satu')) {{ old('kognitif_satu') == 'tidak_mengerti' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kognitif_satu == 'tidak_mengerti' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="tidak_mengerti" name="radio_kognitif_satu"> Tidak dapat
                                dimengerti
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="text-center">
                        c. Motorik
                    </td>
                    <td colspan="5">
                        <div class="row">
                            <div class="col-md-2">
                                Aktifitas sehari-hari
                            </div>
                            <div class="col-md-2">
                                <input required
                                    @if (old('motorik_satu')) {{ old('motorik_satu') == 'mandiri' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_satu == 'mandiri' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="mandiri" name="radio_motorik_satu"> Mandiri
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('motorik_satu')) {{ old('motorik_satu') == 'bantuan_minimal' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_satu == 'bantuan_minimal' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="bantuan_minimal" name="radio_motorik_satu"> Bantuan
                                Minimal
                            </div>
                            <div class="col-md-4">
                                <input
                                    @if (old('motorik_satu')) {{ old('motorik_satu') == 'bantuan_total' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_satu == 'bantuan_total' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="bantuan_total" name="radio_motorik_satu"> Bantuan
                                Ketergantungan
                                Total
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="row">
                            <div class="col-md-2">
                                Berjalan
                            </div>
                            <div class="col-md-2">
                                <input required
                                    @if (old('motorik_dua')) {{ old('motorik_dua') == 'tidak_kesulitan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'tidak_kesulitan' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak_kesulitan" name="radio_motorik_dua"> Tidak ada
                                kesulitan
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('motorik_dua')) {{ old('motorik_dua') == 'perlu_bantuan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'perlu_bantuan' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="perlu_bantuan" name="radio_motorik_dua"> Perlu bantuan
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('motorik_dua')) {{ old('motorik_dua') == 'sering_jatuh' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'sering_jatuh' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="sering_jatuh" name="radio_motorik_dua"> Sering jatuh
                            </div>
                            <div class="col-md-2">
                                <input
                                    @if (old('motorik_dua')) {{ old('motorik_dua') == 'kelumpuhan' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->motorik_dua == 'kelumpuhan' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="kelumpuhan" name="radio_motorik_dua"> Kelumpuhan
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>DISCHARGE PLANNING</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <b>SARAN</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        1. Pasien Perlu Pelayanan Home Care ?
                    </td>
                    <td style="padding-left: 10px">
                        <input required
                            @if (old('saran_satu')) {{ old('saran_satu') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_satu == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_saran_satu"> Ya
                        <input
                            @if (old('saran_satu')) {{ old('saran_satu') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_satu == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                            type="radio" value="tidak" name="radio_saran_satu"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        2. Pasien Perlu Pemasangan Implan ?
                    </td>
                    <td style="padding-left: 10px">
                        <input required
                            @if (old('saran_dua')) {{ old('saran_dua') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_dua == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_saran_dua"> Ya
                        <input
                            @if (old('saran_dua')) {{ old('saran_dua') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_dua == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                            type="radio" value="tidak" name="radio_saran_dua"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        3. Apakah Pasien ketika pulang perlu perawatan dirumah ?
                    </td>
                    <td style="padding-left: 10px">
                        <input required
                            @if (old('saran_tiga')) {{ old('saran_tiga') == 'ya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_tiga == 'ya' ? 'checked' : '') : '' }} @endif
                            type="radio" value="ya" name="radio_saran_tiga"> Ya
                        <input
                            @if (old('saran_tiga')) {{ old('saran_tiga') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->saran_tiga == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                            type="radio" value="tidak" name="radio_saran_tiga"> Tidak
                    </td>
                </tr>
                <tr>
                    <td>
                        Hasil Skrining
                    </td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4">
                        <textarea id="hasil_discharge_planning" class="form-control" rows="5" class="form-control">
@if (old('hasil_discharge_planning')){{ old('hasil_discharge_planning') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->hasil_discharge_planning : '' }}@endif
</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Saran
                    </td>
                    <td style="border-left: hidden; border-right: hidden">:</td>
                    <td colspan="4">
                        <textarea id="saran_discharge_planning" class="form-control" rows="5" class="form-control">
@if (old('saran_discharge_planning')){{ old('saran_discharge_planning') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->saran_discharge_planning : '' }}@endif
</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <b>RIWAYAT PENGGUNAAN OBAT</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 30%">Nama Obat</th>
                                    <th style="width: 10%">Jumlah</th>
                                    <th style="width: 20%">Aturan Pakai</th>
                                    <th style="width: 20%">Tgl. Mulai Minum Obat</th>
                                    <th style="width: 15%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 5%">1</td>
                                    <td style="width: 30%">
                                        <input type="text" class="form-control" id="nama_obat_1"
                                            value="@if(old('nama_obat_1')) {{ old('nama_obat_1') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->nama_obat_1 : '' }}@endif">
                                    </td>
                                    <td style="width: 10%">
                                        <input type="number" class="form-control" id="jumlah_obat_1"
                                            value="@if(old('jumlah_obat_1')) {{ old('jumlah_obat_1') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jumlah_obat_1 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="text" class="form-control" id="aturan_pakai_obat_1"
                                            value="@if(old('aturan_pakai_obat_1')) {{ old('aturan_pakai_obat_1') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->aturan_pakai_obat_1 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="date" class="form-control" id="tanggal_mulai_minum_obat_1" value="@if(old('tanggal_mulai_minum_obat_1')) {{ old('tanggal_mulai_minum_obat_1') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_1 : '' }}@endif">
                                    </td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="keterangan_obat_1"
                                            value="@if(old('keterangan_obat_1')) {{ old('keterangan_obat_1') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keterangan_obat_1 : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%">2</td>
                                    <td style="width: 30%">
                                        <input type="text" class="form-control" id="nama_obat_2"
                                            value="@if(old('nama_obat_2')) {{ old('nama_obat_2') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->nama_obat_2 : '' }}@endif">
                                    </td>
                                    <td style="width: 10%">
                                        <input type="number" class="form-control" id="jumlah_obat_2"
                                            value="@if(old('jumlah_obat_2')) {{ old('jumlah_obat_2') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jumlah_obat_2 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="text" class="form-control" id="aturan_pakai_obat_2"
                                            value="@if(old('aturan_pakai_obat_2')) {{ old('aturan_pakai_obat_2') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->aturan_pakai_obat_2 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="date" class="form-control" id="tanggal_mulai_minum_obat_2" value="@if(old('tanggal_mulai_minum_obat_2')) {{ old('tanggal_mulai_minum_obat_2') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_2 : '' }}@endif">
                                    </td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="keterangan_obat_2"
                                            value="@if(old('keterangan_obat_2')) {{ old('keterangan_obat_2') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keterangan_obat_2 : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%">3</td>
                                    <td style="width: 30%">
                                        <input type="text" class="form-control" id="nama_obat_3"
                                            value="@if(old('nama_obat_3')) {{ old('nama_obat_3') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->nama_obat_3 : '' }}@endif">
                                    </td>
                                    <td style="width: 10%">
                                        <input type="number" class="form-control" id="jumlah_obat_3"
                                            value="@if(old('jumlah_obat_3')) {{ old('jumlah_obat_3') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jumlah_obat_3 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="text" class="form-control" id="aturan_pakai_obat_3"
                                            value="@if(old('aturan_pakai_obat_3')) {{ old('aturan_pakai_obat_3') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->aturan_pakai_obat_3 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="date" class="form-control" id="tanggal_mulai_minum_obat_3" value="@if(old('tanggal_mulai_minum_obat_3')) {{ old('tanggal_mulai_minum_obat_3') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_3 : '' }}@endif">
                                    </td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="keterangan_obat_3"
                                            value="@if(old('keterangan_obat_3')) {{ old('keterangan_obat_3') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keterangan_obat_3 : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%">4</td>
                                    <td style="width: 30%">
                                        <input type="text" class="form-control" id="nama_obat_4"
                                            value="@if(old('nama_obat_4')) {{ old('nama_obat_4') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->nama_obat_4 : '' }}@endif">
                                    </td>
                                    <td style="width: 10%">
                                        <input type="number" class="form-control" id="jumlah_obat_4"
                                            value="@if(old('jumlah_obat_4')) {{ old('jumlah_obat_4') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jumlah_obat_4 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="text" class="form-control" id="aturan_pakai_obat_4"
                                            value="@if(old('aturan_pakai_obat_4')) {{ old('aturan_pakai_obat_4') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->aturan_pakai_obat_4 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="date" class="form-control" id="tanggal_mulai_minum_obat_4" value="@if(old('tanggal_mulai_minum_obat_4')) {{ old('tanggal_mulai_minum_obat_4') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_4 : '' }}@endif">
                                    </td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="keterangan_obat_4"
                                            value="@if(old('keterangan_obat_4')) {{ old('keterangan_obat_4') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keterangan_obat_4 : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%">5</td>
                                    <td style="width: 30%">
                                        <input type="text" class="form-control" id="nama_obat_5"
                                            value="@if(old('nama_obat_5')) {{ old('nama_obat_5') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->nama_obat_5 : '' }}@endif">
                                    </td>
                                    <td style="width: 10%">
                                        <input type="number" class="form-control" id="jumlah_obat_5"
                                            value="@if(old('jumlah_obat_5')) {{ old('jumlah_obat_5') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jumlah_obat_5 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="text" class="form-control" id="aturan_pakai_obat_5"
                                            value="@if(old('aturan_pakai_obat_5')) {{ old('aturan_pakai_obat_5') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->aturan_pakai_obat_5 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="date" class="form-control" id="tanggal_mulai_minum_obat_5" value="@if(old('tanggal_mulai_minum_obat_5')) {{ old('tanggal_mulai_minum_obat_5') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_5 : '' }}@endif">
                                    </td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="keterangan_obat_5"
                                            value="@if(old('keterangan_obat_5')) {{ old('keterangan_obat_5') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keterangan_obat_5 : '' }}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%">6</td>
                                    <td style="width: 30%">
                                        <input type="text" class="form-control" id="nama_obat_6"
                                            value="@if(old('nama_obat_6')) {{ old('nama_obat_6') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->nama_obat_6 : '' }}@endif">
                                    </td>
                                    <td style="width: 10%">
                                        <input type="number" class="form-control" id="jumlah_obat_6" value="@if(old('jumlah_obat_6')){{ old('jumlah_obat_6') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->jumlah_obat_6 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="text" class="form-control" id="aturan_pakai_obat_6"
                                            value="@if(old('aturan_pakai_obat_6')) {{ old('aturan_pakai_obat_6') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->aturan_pakai_obat_6 : '' }}@endif">
                                    </td>
                                    <td style="width: 20%">
                                        <input type="date" class="form-control" id="tanggal_mulai_minum_obat_6" value="@if(old('tanggal_mulai_minum_obat_6')) {{ old('tanggal_mulai_minum_obat_6') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tanggal_mulai_minum_obat_6 : '' }}@endif">
                                    </td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="keterangan_obat_6"
                                            value="@if(old('keterangan_obat_6')) {{ old('keterangan_obat_6') }}
                                   @else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->keterangan_obat_6 : '' }}@endif">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-12">
                                Pemeriksaan Penunjang :
                            </div>
                            <div class="col-md-12">
                                A. Laboratorium
                                <div id="box_button_pesanan_lab">
                                    @if (sizeof($layanan->pesanan_lab) < 1)
                                        <button class="btn btn-dark" type="button" onclick="open_modal_lab()"><i
                                                class="fa fa-plus"></i></button>
                                    @endif
                                </div>
                                <div id="list_pesanan">
                                    @if ($layanan->pesanan_lab)
                                        @foreach ($layanan->pesanan_lab as $pl)
                                            <button class="btn btn-warning" type="button"
                                                onclick="open_modal_lab()"><i class="fa fa-pencil"
                                                    style="color:#fff;"></i></button>
                                            <button class="btn btn-info" type="button" data-toggle="tooltip"
                                                title="Hasil"
                                                onclick="open_modal_hasil_lab('{{ $pl->id }}')"><i
                                                    class="fa fa-book" style="color:#fff;"></i></button>
                                            @php
                                                $iterasi_pesanan_lab = 0;
                                                $pesan = '';
                                            @endphp
                                            <?php $yang_dipesan = json_decode($pl->periksa); ?>
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
                                            {{ $pl->no_lab }} - {{ $pesan }}
                                        @endforeach
                                    @endif
                                </div>
                                <br>
                                B. Radiologi
                                <div id="box_button_pesanan_radiologi">
                                    @if (sizeof($layanan->pesanan_radiologi) < 1)
                                        <button onclick="open_modal_pesanan_radiologi()" class="btn btn-dark"><i
                                                class="fa fa-plus"></i></button>
                                    @endif
                                </div>
                                <div id="list_pesanan_radiologi">
                                    @if ($layanan->pesanan_radiologi)
                                        @foreach ($layanan->pesanan_radiologi as $pr)
                                            <button class="btn btn-warning"
                                                onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil"
                                                    style="color:#fff;"></i>
                                            </button>
                                            <button class="btn btn-info" data-toggle="tooltip" title="Hasil"
                                                onclick="open_modal_hasil_radiologi('{{ $pr->id }}')"><i
                                                    class="fa fa-book" style="color:#fff;"></i></button>
                                            @php
                                                $iterasi_pesanan_radiologi = 0;
                                                $pesan_radiologi = '';
                                            @endphp
                                            <?php $yang_dipesan = json_decode($pr->periksa); ?>
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
                                            {{ $pr->no_lab }} - {{ $pesan_radiologi }}
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-12">
                                Status Generalis :
                            </div>
                            <div class="col-md-12">
                                <textarea required id="status_generalis" class="form-control" rows="5" class="form-control">
@if (old('status_generalis')){{ old('status_generalis') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->status_generalis : '' }}@endif
</textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        Diagnosa :
                        <div style="display: flex; flex-direction: row" class="pt-3">
                            <div id="box_btn_asesmen">
                                @if ($layanan->diagnosa == null)
                                    <button type="button" class="btn btn-success"
                                        onclick="open_form_tambah_diagnosa('diagnosa')"><i
                                            class="fa fa-plus"></i></button>
                                @else
                                    <button type="button" class="btn btn-warning"
                                        onclick="open_form_tambah_diagnosa('diagnosa')"
                                        style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>
                                @endif
                            </div>
                            <div id="box_diagnosa" class="ml-2">
                                @if(!is_null($layanan->diagnosa))
                                {{ $layanan->diagnosa->diagnosa == '' ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : $layanan->diagnosa->diagnosa }}
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Diagnosa Banding :
                        <div style="display: flex; flex-direction: row" class="pt-3">
                            {{-- <div id="box_btn_asesmen_pembanding">
                                @if ($layanan->diagnosa == null)
                                    <button type="button" class="btn btn-success"
                                        onclick="open_form_tambah_diagnosa('pembanding')"><i
                                            class="fa fa-plus"></i></button>
                                @else
                                    <button type="button" class="btn btn-warning"
                                        onclick="open_form_tambah_diagnosa('pembanding')"
                                        style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>
                                @endif
                            </div> --}}
                            <div id="box_diagnosa_pembanding" class="ml-2">
                                @if ($layanan->diagnosa != null)
                                    {{ $layanan->diagnosa->diagnosa_pembanding == '' ? $layanan->diagnosa->kode_icd_diagnosa_pembanding . ' - ' . $layanan->diagnosa->diagnosa_pembanding : $layanan->diagnosa->diagnosa_pembanding }}
                                @endif
                            </div>
                        </div>
                    </td>
                    <td colspan="3">
                        Terapi :
                        <div id="list_e_resep" class="pt-3">
                            <div id="box_btn_terapi">
                                @if ($layanan->resep == null)
                                    <button class="btn btn-dark" type="button" onclick="open_modal_e_resep()"><i
                                            class="fa fa-plus"></i></button>
                                @else
                                    @if ($layanan->resep->locked == 0)
                                        <button class="btn btn-warning" type="button"
                                            onclick="open_modal_edit_resep('{{ $layanan->resep->id }}')"><i
                                                class="fa fa-pencil" style="color:#fff;"></i></button>
                                        <button class="btn btn-info" type="button"
                                            onclick="lock_terapi('{{ $layanan->resep->id }}')"><i
                                                class="fa fa-lock" style="color:#fff;"></i></button>
                                    @endif
                                    <button class="btn btn-info" type="button"
                                        onclick="preview_terapi('{{ $layanan->resep->id }}')"><i
                                            class="fa fa-book" style="color:#fff;"></i></button>
                                @endif
                                No. Resep Elektronik
                                @if (sizeof($all_resep))
                                    @foreach ($all_resep as $ar)
                                        @if ($loop->iteration > 1)
                                            {{ ', ' . $ar->id }}
                                        @else
                                            {{ $ar->id }}
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div id="box_resep">
                                <table style="border-collapse: collapse; width:100%;" class="tabel_terapi">
                                    @if (sizeof($all_resep))
                                        @foreach ($all_resep as $ar)
                                            @foreach ($ar->detail as $ar_det)
                                                <tr>
                                                    {{-- @if ($loop->iteration == 1) --}}
                                                    <td>{{ 'R/' }}</td>
                                                    {{-- @else
                                                <td style="width:20px;"></td>
                                            @endif --}}
                                                    <td>{{ $ar_det->nama_obat }}</td>
                                                    <td>{{ $ar_det->signa }}</td>
                                                    <td style="padding-left: 20px;">
                                                        {{ $ar_det->jumlah . ' ' . $ar_det->satuan }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <b>RENCANA TINDAK LANJUT</b>
                    </td>
                    <td colspan="2" rowspan="4" class="text-center">
                        <div class="row" style="width: 100%; display: inline-block">
                            Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}
                            <br>
                            Jam: {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                            <br>
                            <a onclick="open_modal_dokter()" href="#"
                                style="text-decoration:none; color:#111; text-align: center">
                                @if ($dokumen->id_verifikator == 0)
                                    <br>
                                    <br>
                                    <br>
                                    Dokter
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>Ttd & nama jelas
                                @else
                                    @if (isset($employee))
                                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>({{ $dokumen->nama_verifikator }})
                                @endif
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <div class="col-md-3">
                                Kontrol Diulang
                            </div>
                            <div class="col-md-6">
                                <input onclick="cek_radio_kontrol_ulang()" required
                                    @if (old('kontrol_ulang')) {{ old('kontrol_ulang') == 'ya' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kontrol_ulang == 'ya' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="ya" name="radio_kontrol_ulang"> Ya, Tanggal :
                                <input type="date" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kontrol_ulang == 'ya' ? 'required' : '') : '' }}
                                    value="@if (old('tgl_kontrol_ulang')) {{ old('tgl_kontrol_ulang') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tgl_kontrol_ulang : '' }} @endif"
                                    id="tgl_kontrol_ulang" style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('kontrol_ulang')) {{ old('kontrol_ulang') == 'ya' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kontrol_ulang == 'ya' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                            <div class="col-md-3">
                                <input onclick="cek_radio_kontrol_ulang()"
                                    @if (old('kontrol_ulang')) {{ old('kontrol_ulang') == 'tidak' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->kontrol_ulang == 'tidak' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak" name="radio_kontrol_ulang"> Tidak
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Rujuk Ke
                            </div>
                            <div class="col-md-6">
                                <input onclick="cek_radio_rujuk()" required
                                    @if (old('rujuk')) {{ old('rujuk') == 'tidak_dirujuk' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'tidak_dirujuk' ? 'checked' : '') : 'checked' }} @endif
                                    type="radio" value="tidak_dirujuk" name="radio_rujuk_ke"> Tidak Dirujuk
                            </div>
                            <div class="col-md-3">
                                <input onclick="cek_radio_rujuk()"
                                    @if (old('rujuk')) {{ old('rujuk') == 'rs' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'rs' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="rs" name="radio_rujuk_ke"> Rs,
                                <input type="date" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'rs' ? 'required' : '') : '' }}
                                    value="@if (old('tgl_rujuk')) {{ old('tgl_rujuk') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->tgl_rujuk : '' }} @endif"
                                    id="tgl_rujuk" style="border: 0; border-bottom: 2px dotted;"
                                    @if (old('rujuk')) {{ old('rujuk') == 'rs' ? '' : 'readonly' }}
                            @else
                            {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'rs' ? '' : 'readonly') : 'readonly' }} @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-3 col-md-6">
                                <input onclick="cek_radio_rujuk()"
                                    @if (old('rujuk')) {{ old('rujuk') == 'puskesmas' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'puskesmas' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="puskesmas" name="radio_rujuk_ke"> Puskesmas
                            </div>
                            <div class="col-md-3">
                                <input onclick="cek_radio_rujuk()"
                                    @if (old('rujuk')) {{ old('rujuk') == 'dokter' ? 'checked' : '' }}
                               @else
                                   {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->rujuk == 'dokter' ? 'checked' : '') : '' }} @endif
                                    type="radio" value="dokter" name="radio_rujuk_ke"> Dokter
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <b>EDUKASI PASIEN</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Edukasi awal disampaikan tentang diagnosis, rencana dan tujuan terapi kepada :
                        <br>
                        <input onclick="cek_radio_penyampaian_edukasi()" required
                            @if (old('penyampaian_edukasi')) {{ old('penyampaian_edukasi') == 'pasien' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'pasien' ? 'checked' : '') : 'checked' }} @endif
                            type="radio" value="pasien" name="radio_penyampaian_edukasi"> Pasien
                        <br>
                        <input onclick="cek_radio_penyampaian_edukasi()"
                            @if (old('penyampaian_edukasi')) {{ old('penyampaian_edukasi') == 'keluarga' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'keluarga' ? 'checked' : '') : '' }} @endif
                            type="radio" value="keluarga" name="radio_penyampaian_edukasi"> Keluarga
                        <br>
                        <input onclick="cek_radio_penyampaian_edukasi()"
                            @if (old('penyampaian_edukasi')) {{ old('penyampaian_edukasi') == 'tidak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'tidak' ? 'checked' : '') : '' }} @endif
                            type="radio" value="tidak" name="radio_penyampaian_edukasi"> tidak dapat memberikan
                        edukasi,
                        karena :
                        <br>
                        <input type="text" class="form-control" {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'tidak' ? 'required' : '') : '' }}
                            value="@if (old('ket_penyampaian_edukasi')) {{ old('ket_penyampaian_edukasi') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ket_penyampaian_edukasi : '' }} @endif"
                            id="ket_penyampaian_edukasi" style="border: 0; border-bottom: 2px dotted;"
                            @if (old('penyampaian_edukasi')) {{ old('penyampaian_edukasi') == 'tidak' ? '' : 'readonly' }}
                    @else
                    {{ $dokumen->asesment_medis_awal ? ($dokumen->asesment_medis_awal->penyampaian_edukasi == 'tidak' ? '' : 'readonly') : 'readonly' }} @endif>
                        <br>
                    </td>
                </tr>

                {{-- <tr>
            <td class="text-center" style="width: 10%">Tanggal/Jam</td>
            <td class="text-center">Profesi<br>(PPA)</td>
            <td class="text-center" colspan="2">HASIL PEMERIKSAAN, ANALISA, RENCANA PELATALAKSANAAN PASIEN</td>
            <td class="text-center" style="width: 20%">Instruksi Tenaga Kesehatan Termasuk Pasca Bedah / Prosedur</td>
            <td class="text-center">DPJP</td>
        </tr>
        <tr>
            <td style="vertical-align: text-top; text-align: center">
                &nbsp;
                <br>
                {{ $dokumen ? date('d-m-Y H:i', strtotime($dokumen->created_at)) : '' }}
            </td>
            <td style="vertical-align: text-top">
                &nbsp;
                <div class="input-group">
                    <input type="text" hidden id="id_ppa">
                    <input type="text" readonly
                           value="{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->ppa : ''}}"
                           id="ppa" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" onclick="open_modal_yth()"><i
                                class="fa fa-list"></i></button>
                    </div>
                </div>
            </td>
            <td colspan="2">
                SUBYEKTIF
                <br>
                <textarea id="subyektif" class="form-control"
                          rows="5">@if (old('subyektif')){{ old('subyektif') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->subyektif : '' }}@endif</textarea>
                <br>
                <br>
                OBYEKTIF
                <br>
                ASESMEN
                <br>
                Diagnosa Utama :
                <div style="display: flex; flex-direction: row">
                    <div id="box_diagnosa" class="ml-2">
                        {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd . ' - ' . $layanan->diagnosa->nama_icd : '' }}
                    </div>
                </div>
                <br>
                Diagnosa Sekunder :
                <div style="display: flex; flex-direction: row" id="box_diagnosa_sekunder">
                    <?php
                    if ($layanan->diagnosa != null) {
                        $temp = '';
                        if ($layanan->diagnosa->diagnosa_sekunder1 != null) {
                            $temp .= ($kode_sekunder1 ? $kode_sekunder1->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder1;
                        }
                        if ($layanan->diagnosa->diagnosa_sekunder2 != null) {
                            $temp .= '<br>' . ($kode_sekunder2 ? $kode_sekunder2->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder2;
                        }
                        if ($layanan->diagnosa->diagnosa_sekunder3 != null) {
                            $temp .= '<br>' . ($kode_sekunder3 ? $kode_sekunder3->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder3;
                        }
                        if ($layanan->diagnosa->diagnosa_sekunder4 != null) {
                            $temp .= '<br>' . ($kode_sekunder4 ? $kode_sekunder4->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder4;
                        }
                        if ($layanan->diagnosa->diagnosa_sekunder5 != null) {
                            $temp .= '<br>' . ($kode_sekunder5 ? $kode_sekunder5->icd : '') . ' - ' . $layanan->diagnosa->diagnosa_sekunder5;
                        }
                        echo $temp;
                    }
                    ?>
                </div>
                <br>
                PLANNING
                <br>
                A. Laboratorium
                <div id="list_pesanan">
                    @if ($layanan->pesanan_lab)
                        @foreach ($layanan->pesanan_lab as $pl)
                            @php
                                $iterasi_pesanan_lab = 0;
                                $pesan = '';
                            @endphp
                                <?php $yang_dipesan = json_decode($pl->periksa); ?>
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
                            {{ $pl->no_lab }} - {{ $pesan }}
                        @endforeach
                    @endif
                </div>
                <br>
                B. Radiologi
                <div id="list_pesanan_radiologi">
                    @if ($layanan->pesanan_radiologi)
                        @foreach ($layanan->pesanan_radiologi as $pr)
                            @php
                                $iterasi_pesanan_radiologi = 0;
                                $pesan_radiologi = '';
                            @endphp
                                <?php $yang_dipesan = json_decode($pr->periksa); ?>
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
                            {{ $pr->no_lab }} - {{ $pesan_radiologi }}
                        @endforeach
                    @endif
                </div>
                C. Terapi
                <div id="list_e_resep" class="pt-3">
                    <div id="box_btn_terapi">
                        No. Resep Elektronik
                        @if (sizeof($all_resep))
                            @foreach ($all_resep as $ar)
                                @if ($loop->iteration > 1)
                                    {{ ', ' . $ar->id }}
                                @else
                                    {{ $ar->id }}
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <table style="border-collapse: collapse; width:100%;">
                        @if (sizeof($all_resep))
                            @foreach ($all_resep as $ar)
                                @foreach ($ar->detail as $ar_det)
                                    <tr>
                                        <td colspan="4">{{ 'R/' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:20px;"></td>
                                        <td>{{ $ar_det->nama_obat }}</td>
                                        <td>{{ $ar_det->jumlah_pakai_sehari . ' x 1' }}</td>
                                        <td style="padding-left: 20px;">
                                            {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                    </table>
                </div>
            </td>
            <td style="width: 20%; vertical-align: text-top">
                Instruksi Kesehatan
                <br>
                <textarea id="instruksi_kesehatan" class="form-control"
                          rows="5">@if (old('instruksi_kesehatan')){{ old('instruksi_kesehatan') }}@else{{ $dokumen->asesment_medis_awal ? $dokumen->asesment_medis_awal->instruksi_kesehatan : '' }}@endif</textarea>
            </td>
            <td style="vertical-align: text-top; text-align: center">
                &nbsp;
                <br>
                @if ($dokumen->asesment_medis_awal)
                    @if (isset($data_ppa))
                        <img src="{{ env('SMIS_UPLOAD_URL').'/'.$data_ppa->ttd }}"
                             style="height: 4cm; width: 5cm;" alt="">
                    @else
                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                    @endif
                    <br>({{$dokumen->asesment_medis_awal->ppa}})
                @endif
            </td>
        </tr>
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
        </tr> --}}
            </table>
        </div>
    </form>
    <div class="row pt-5" style="width:100%; margin-left:0">
        <div class="col-md-12 text-center">
            <button onclick="submit_form()" class="btn btn-success">Simpan</button>
        </div>
    </div>
    <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
        <div style="text-align: center;" class="col-md-12">
            @if ($dokumen->id_verifikator != 0)
                <a href="{{ url('e_rekam_medis/detail/pdf_asesment_medis_awal_rawat_jalan?dokumen=' . $dokumen->id) }}"
                    class="btn btn-success" target="_blank">Download PDF</a>
            @endif
        </div>
    </div>

    {{-- Diagnosa --}}
    <div class="modal fade" id="modal_tambah_diagnosa" style="overflow-y: scroll;" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" name="ruangan" value="{{ $layanan->last_ruangan }}" readonly
                                class="form-control">
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
    {{-- End Of Diagnosa --}}

    {{-- Modal Diagnosa Pembanding --}}
    <div class="modal fade" id="modal_diagnosa_pembanding" style="overflow-y: scroll;" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asesmen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="submit_diagnosa()" id="form_pembanding">
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
                            <input type="text" name="ruangan" value="{{ $layanan->last_ruangan }}" readonly
                                class="form-control">
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
                        <div class="form-group">
                            <label for="">Diagnosa Pembanding</label>
                            <input type="text" class="form-control" name="diagnosa_pembanding"
                                id="diagnosa_pembanding">
                        </div>
                        <div id="box_msg_pembanding"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_simpan_diagnosa_pembanding"
                            class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End modal diagnosa pembanding --}}

    {{-- Resep --}}
    <div class="modal fade" id="modal_dokter_e_resep" tabindex="-1" style="overflow-y: scroll;"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            Jombang,
                                            {{ $dokumen->asesmen_ulang ? date('d-m-Y', strtotime($dokumen->asesmen_ulang->tanggal)) : '' }}
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
                                        <td>{{ $layanan->perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Asuransi</td>
                                        <td> :</td>
                                        <td>{{ $layanan->asuransi == 0 ? '' : $layanan->asuransi }}</td>
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
    <!-- end modal list obat -->

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
                                    <input class="form-control" name="asuransi" id="e_resep_asuransi"
                                        type="text" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <div class="input-group">
                                        <input class="form-control" name="dokter"
                                            value="{{ Auth::user()->realname }}" id="e_resep_dokter"
                                            type="text" readonly>
                                        <input class="form-control" name="id_dokter"
                                            value="{{ Auth::user()->id }}" id="e_resep_id_dokter"
                                            type="hidden">
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
                                    <input class="form-control" name="sip" id="e_resep_sip" type="text"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="alamat" id="e_resep_alamat"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Pasien</label>
                                    <input class="form-control" name="jenis_pasien" id="e_resep_jenis_pasien"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Obat Racikan</label>
                                    <textarea style="height: 100%;" name="catatan_obat_racikan" id="e_resep_obat_racikan" cols="30"
                                        rows="5" class="form-control"></textarea>
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
                            <div class="col-lg-3">
                                <div class="form-group">
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
                                <div class="form-group">
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
                                    <label for="">Jumlah</label>
                                    <input type="text" id="e_resep_jumlah_obat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga (Rp.)</label>
                                    <input type="text" id="e_resep_harga_obat" readonly class="form-control">
                                    <input type="hidden" id="e_resep_markup" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Signa</label>
                                    <input class="form-control" name="signa" id="e_resep_signa"
                                        type="text">
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
                                        onclick="tambah_detail_e_resep()">Tambahkan
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
                    <input type="hidden" name="ruangan" id="edit_ruangan">
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
                                    <input class="form-control" name="nrm" id="edit_resep_nrm"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input class="form-control" name="usia" id="edit_resep_usia"
                                        type="text" readonly>
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
                                        <input class="form-control" name="id_dokter"
                                            value="{{ Auth::user()->id }}" id="edit_resep_id_dokter"
                                            type="hidden">
                                        <div class="input-grou-append">
                                            <button class="btn btn-dark" type="button"
                                                onclick="open_modal_dokter_e_resep('edit')"><i
                                                    class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" name="nama" id="edit_resep_nama"
                                        type="text" readonly>
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
                                    <input class="form-control" name="sip" id="edit_resep_sip"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="alamat" id="edit_resep_alamat"
                                        type="text" readonly>
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
                                    <input class="form-control" name="telp" id="edit_resep_telp"
                                        type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <input class="form-control" name="perusahaan" id="edit_resep_perusahaan"
                                        type="text" readonly>
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
                            <div class="col-lg-3">
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label for="">Jenis</label>
                                    <input type="text" id="edit_resep_jenis_obat" readonly
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Sisa</label>
                                    <input type="text" id="edit_resep_sisa_obat" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <input type="text" id="edit_resep_satuan_obat" readonly
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" id="edit_resep_jumlah_obat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga (Rp.)</label>
                                    <input type="text" id="edit_resep_harga_obat" readonly
                                        class="form-control">
                                    <input type="hidden" id="edit_resep_markup" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Signa</label>
                                    <input class="form-control" name="signa" id="edit_resep_signa"
                                        type="text">
                                </div>
                                <div id="additional_form_edit_resep"></div>
                                <div class="form-group text-center">
                                    <button class="btn btn-dark" type="button" style="color:#fff;"
                                        onclick="tambah_detail_edit_resep()">Tambahkan
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
                    @csrf
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
                                <option value="1"
                                    @if ($layanan->kelamin == 1) {{ 'selected' }} @endif>
                                    Perempuan
                                </option>
                                <option value="0"
                                    @if ($layanan->kelamin == 0) {{ 'selected' }} @endif>
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
                        <input name="alamat" type="hidden" class="form-control"
                            value="{{ $layanan->alamat }}">
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
                            <select id="kelas" name="kelas" readonly style="pointer-events: none;" onclick="return false;" onkeydown="return false;" class="form-control">
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
                            <input type="text" id="dokter_lab" name="dokter" readonly
                                placeholder="Pilih dokter" value="{{ Auth::user()->realname }}"
                                class="form-control">
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
                            <input type="text" readonly id="diagnosa_lab" name="diagnosa"
                                class="form-control">
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

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js">
</script>
{{-- diagnosa --}}
<script>
    var tipe_diagnosa = '';
    $(document).ready(function() {
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

    function fake_submit(){
        window.event.preventDefault();
        return false;
    }

    function open_modal_dokter() {
        $('#formulir').submit();
        if ($("#formulir")[0].checkValidity()) {
            $('#modal_petugas').modal('show');
        } else {
            $("#formulir")[0].reportValidity()
        }
    }

    function open_form_tambah_diagnosa(tipe) {
        tipe_diagnosa = tipe;
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
                tipe == 'diagnosa' ? $('#modal_tambah_diagnosa').modal('show') : $(
                    '#modal_diagnosa_pembanding').modal('show');
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
        // if ($('#nip_dokter').val() == '') {
        //     alert('Pilih dokter dahulu');
        //     return;
        // }
        if (tipe_diagnosa == 'diagnosa') {
            if ($('#diagnosa_primer').val() == '') {
                alert('Pilih diagnosa utama dahulu');
                return;
            }
        }else{
            if ($('#diagnosa_pembanding').val() == '') {
                alert('Pilih diagnosa pembanding dahulu');
                return;
            }
        }
        tipe_diagnosa == 'diagnosa' ? $('#box_msg').html(loading('Sedang menyimpan data...', 'info')) : $('#box_msg_pembanding').html(loading('Sedang menyimpan data...', 'info'));
        tipe_diagnosa == 'diagnosa' ? $('#btn_simpan_diagnosa').attr('disabled', true) : $('#btn_simpan_diagnosa_pembanding').attr('disabled', true);
        $.ajax({
            url: "{{ url('ajax_request/update_diagnosa') }}",
            method: 'post',
            data: tipe_diagnosa == 'diagnosa' ? $('#form_asesmen').serialize() : $('#form_pembanding')
                .serialize(),
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    alert(response.message);
                    $('#box_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                } else {
                    $('#box_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    let data = response.data;
                    var temp = '';
                    if (data.diagnosa_sekunder1 != '') {
                        temp += response.kode_sekunder1.icd + ' - ' + data.diagnosa_sekunder1;
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
                    data.kode_icd != '' ? $('#box_diagnosa').html(data.kode_icd + ' - ' + data.nama_icd) : $('#box_diagnosa').html(data.diagnosa);
                    data.kode_icd_diagnosa_pembanding != '' ? $('#box_diagnosa_pembanding').html(data.kode_icd_diagnosa_pembanding + ' - ' + data
                        .nama_diagnosa_pembanding) :  $('#box_diagnosa_pembanding').html(data.diagnosa_pembanding);
                    $('#box_diagnosa_sekunder').html(temp);
                    tipe_diagnosa == 'diagnosa' ? $('#box_btn_asesmen').html(
                        '<button class="btn btn-warning" type="button" onclick="open_form_tambah_diagnosa(' +
                        "'diagnosa'" +
                        ')" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>'
                    ) : $('#box_btn_asesmen_pembanding').html(
                        '<button class="btn btn-warning" type="button" onclick="open_form_tambah_diagnosa(' +
                        "'pembanding'" +
                        ')" style="color:#fff; font-weight: bold;"><i class="fa fa-pencil"></i></button>'
                    );
                }
                if (tipe_diagnosa == 'diagnosa') {
                    $('#btn_simpan_diagnosa').removeAttr('disabled');
                    $('#box_msg').html('');
                    $('#modal_tambah_diagnosa').modal('hide');
                } else {
                    $('#btn_simpan_diagnosa_pembanding').removeAttr('disabled');
                    $('#box_msg_pembanding').html('');
                    $('#modal_diagnosa_pembanding').modal('hide');
                }
            }
        })
    }
</script>
{{-- end of diagnosa --}}

{{-- E RESEP --}}
<script>
    var detail_e_resep = [];
    var detail_edit_resep = [];

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
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
                $('#edit_resep_nrm').val(response.nrm_pasien);
                $('#edit_resep_noreg').val(response.noreg_pasien);
                $('#edit_resep_nama').val(response.nama_pasien);
                $('#edit_resep_usia').val(response.usia);
                $('#edit_resep_dokter').val(response.nama_dokter);
                $('#edit_resep_id_dokter').val(response.id_dokter);
                $('#edit_resep_alamat').val(response.alamat_pasien);
                $('#edit_resep_telp').val(response.no_telpon);
                $('#edit_resep_jenis_pasien').val(response.jenis);
                $('#edit_resep_depo_tujuan').val(response.depo).trigger('change');
                // $('#edit_kategori').val(response.kategori).trigger('change');
                $('#edit_resep_obat_racikan').val(response.catatan_obat_racikan);
                $('#edit_resep_signa').val(response.signa);

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
        if ($('#edit_resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }
        if ($('#edit_resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }
        if (confirm('Yakin data yang dimasukkan sudah benar ?')) {
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
                harga: parseFloat($('#edit_resep_harga_obat').val().toString().replaceAll('.', '').replaceAll(
                    ',', '.')),
                markup: parseInt($('#edit_resep_markup').val()),
                signa: $('#edit_resep_signa').val(),
                deleted: false
            });
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
            console.log(detail_edit_resep);
            render_detail_edit_resep();
        }
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
                        var ins = '<button type="button" class="btn btn-info" onclick="preview_terapi(' +
                            "'" + response
                            .data.id + "'" + ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                            'No. Resep Elektronik ' + response.data.id;
                        $('#box_btn_terapi').html(ins);
                    }
                }
            })
        }
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
        get_list_obat(param, tipe_form);
        $('#modal_list_obat').modal('show');
    }

    function tambah_detail_e_resep() {
        if ($('#e_resep_jumlah_obat').val() == '') {
            alert('Jumlah obat harus diisi');
            return;
        }
        if ($('#e_resep_jumlah_pakai').val() == '') {
            alert('Jumlah pakai obat harus diisi');
            return;
        }
        if (confirm('Yakin data yang dimasukkan sudah benar ?')) {
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
            console.log(detail_e_resep);
            render_detail_e_resep();
        }
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
                '</td>' +
                '<td class="text-center">' + detail_e_resep[i].signa + '</td>' +
                '<td class="text-center"><button onclick="hapus_detail_e_resep(' + i +
                ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>' +
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

        // if (detail_e_resep.length > 0) {
        //     $('#e_resep_kategori').prop('disabled', true);
        // }
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
                    '</td>' +
                    '<td class="text-center">' + detail_edit_resep[i].signa + '</td>' +
                    '<td class="text-center"><button onclick="hapus_detail_edit_resep(' + i +
                    ')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>' +
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

        // if (detail_edit_resep.length > 0) {
        //     $('#edit_kategori').prop('disabled', true);
        // }
    }

    function set_dokter_e_resep(nama, id, sip, tipe) {
        $('#e_resep_dokter').val(nama);
        $('#e_resep_id_dokter').val(id);
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
        get_list_obat(param, tipe_form);
        $('#modal_list_obat').modal('show');
    }

    $('#form_search_obat').submit(function(e) {
        e.preventDefault();
        get_list_obat($('#search_obat').val(), "tambah");
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
        $.ajax({
            url: "{{ url('ajax_request/harga_obat') }}",
            data: {
                noreg: "{{ $layanan->id }}",
                id_obat: param,
                // kategori: (tipe_form == 'tambah' ? $('#e_resep_kategori').val() : $('#edit_kategori')
                //     .val()),
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
                        ins += '<button type="button" class="btn btn-warning"' +
                            'onclick="open_modal_edit_resep(' + response.data.id +
                            ')"><i class="fa fa-pencil" style="color:#fff;"></i></button>';
                    }
                    ins += '<button type="button" class="btn btn-info ml-1"' +
                        'onclick="preview_terapi(' + response.data.id + ')"><i class="fa fa-book"' +
                        'style="color:#fff;"></i></button>' +
                        '<button type="button" class="btn btn-info ml-1"' +
                        'onclick="lock_terapi(' + response.data.id + ')"><i class="fa fa-lock"' +
                        'style="color:#fff;"></i></button>';
                    $('#box_btn_terapi').html(ins)
                    $('#modal_e_resep').modal('hide');
                    render_resep(response.data.detail);
                    return;
                } else {
                    $('#msg_e_resep').html('<div class="alert alert-danger">' + response
                        .message + '</div>');
                }
            }
        })
    })

    function render_resep(data) {
        if (data.length < 1) {
            $('#box_resep').html('');
            return;
        }

        var ins = '<table style="border-collapse: collapse; width:100%;" class="tabel_terapi">';

        for (let i = 0; i < data.length; i++) {
            ins += '<tr>' +
                '<td>R/</td>' +
                '<td>' + data[i].nama_obat + '</td>' +
                '<td>' + data[i].signa + '</td>' +
                '<td style="padding-left: 20px;">' + data[i].jumlah + ' ' + data[i].satuan + '</td>' +
                '</tr>';
        }
        ins += '</table>';
        $('#box_resep').html(ins);
    }

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
                    $('#modal_edit_resep').modal('hide');
                    render_resep(response.data.detail);
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
{{-- END OF E RESEP --}}

{{-- LAB --}}
<script>
    function open_modal_lab() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_by_noreg') }}",
            data: {
                noreg: '{{ $layanan->id }}',
            },
            success: function(response) {
                let temp = [];
                if (response.diagnosa) {
                    $('#diagnosa_lab').val(response.diagnosa.nama_icd);
                }
                if (response.pesanan_lab) {
                    const periksa = JSON.parse(response.pesanan_lab.periksa);
                    console.log(periksa);
                    Object.entries(periksa).forEach(([key, value]) => {
                        if (`${value}` == 1) {
                            temp.push(`${key}`);
                        }
                        console.log(`${key} ${value}`);
                    });
                    console.log('-------------------');
                    $('#pesan_pemeriksaan').val(temp).change();
                    $('#ruangan_lab').val(response.pesanan_lab.ruangan);
                    $('#kelas').val(response.pesanan_lab.kelas);
                }
                $('#modal_lab').modal('show');
            }
        })
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
        console.log($('#form_laboratorium').serialize());
        $.ajax({
            url: "{{ url('ajax_request/pesanan_lab_store') }}",
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
                console.log(data);
                $('#loading_pesanan_lab').html('<div class="alert alert-success">' + response
                    .message + '</div>');
                let pemeriksaan = <?php echo $pemeriksaan; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                for (let i = 0; i < data.length; i++) {
                    ins += data[i].no_lab + ' - ';
                    var temp = JSON.parse(data[i].periksa);
                    console.log(temp);
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
                }
                $('#list_pesanan').html(
                    '<button type="button" class="btn btn-warning" onclick="open_modal_lab()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_lab(' +
                    "'" + data[0].id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' +
                    ins);
            }
        })
    });
</script>
{{-- END OF LAB --}}

{{-- RADIOLOGI --}}
<script>
    function open_modal_pesanan_radiologi() {
        $.ajax({
            url: "{{ url('ajax_request/pesanan_radiologi_by_noreg') }}",
            data: {
                noreg: '{{ $layanan->id }}',
            },
            success: function(response) {
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
                $('#modal_pesanan_radiologi').modal('show');
            }
        })
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
            url: "{{ url('ajax_request/pesanan_radiologi_store') }}",
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
                console.log(data);
                let pemeriksaan = <?php echo $pemeriksaan_radiologi; ?>;
                var ins = '';
                let iterasi_pesanan = 0;
                for (let i = 0; i < data.length; i++) {
                    ins += data[i].no_lab + ' - ';
                    var temp = JSON.parse(data[i].periksa);
                    console.log(temp);
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
                }
                $('#list_pesanan_radiologi').html(
                    '<button type="button" class="btn btn-warning" onclick="open_modal_pesanan_radiologi()"><i class="fa fa-pencil" style="color:#fff;"></i></button>' +
                    '<button type="button" class="btn btn-info ml-1 mr-2" data-toggle="tooltip" title="Hasil" onclick="open_modal_hasil_radiologi(' +
                    "'" + data[0].id + "'" +
                    ')"><i class="fa fa-book" style="color:#fff;"></i></button>' + ins);
            }
        })
    })
</script>
{{-- END OF RADIOLOGI --}}

{{-- PPA --}}
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
        $('#ppa').val(nama);
        $('#id_ppa').val(id);
        $('#modal_yth').modal('hide');
    }

    function open_modal_yth() {
        $('#modal_yth').modal('show');
    }
</script>
{{-- END OF PPA --}}

{{-- asesment medis awal --}}
<script>
    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_radio_kesadaran() {
        // if ($('[name="radio_kesadaran"]:checked').val() == 'sopor_koma') {
        //     $('#ket_sopor_koma').removeAttr('readonly');
        //     $('#ket_sopor_koma').attr('required', true);
        // } else {
        //     $('#ket_sopor_koma').attr('readonly', true);
        //     $('#ket_sopor_koma').removeAttr('required');
        //     $('#ket_sopor_koma').val('');
        // }
    }

    function cek_radio_saudara() {
        // if ($('[name="radio_saudara"]:checked').val() == 'kandung') {
        //     $('#ket_kandung').removeAttr('readonly');
        //     $('#ket_tiri').attr('readonly', true);
        //     $('#ket_tiri').val('');
        // } else {
        //     $('#ket_tiri').removeAttr('readonly');
        //     $('#ket_kandung').attr('readonly', true);
        //     $('#ket_kandung').val('');
        // }
    }

    function cek_radio_tinggal_bersama() {
        // if ($('[name="radio_tinggal_bersama"]:checked').val() == 'tinggal_lainnya') {
        //     $('#ket_tinggal_lainnya').removeAttr('readonly');
        // } else {
        //     $('#ket_tinggal_lainnya').attr('readonly', true);
        //     $('#ket_tinggal_lainnya').val('');
        // }
    }

    function cek_radio_gangguan_jiwa() {
        // if ($('[name="radio_gangguan_jiwa"]:checked').val() == 'ya') {
        //     $('#tahun_gangguan_jiwa').removeAttr('readonly');
        // } else {
        //     $('#tahun_gangguan_jiwa').attr('readonly', true);
        //     $('#tahun_gangguan_jiwa').val('');
        // }
    }

    function cek_radio_riwayat_trauma() {
        // if ($('[name="radio_trauma"]:checked').val() == 'kriminal') {
        //     $('#ket_kriminal').removeAttr('readonly');
        // } else {
        //     $('#ket_kriminal').attr('readonly', true);
        //     $('#ket_kriminal').val('');
        // }
    }

    function cek_radio_kebutuhan_spiritual() {
        // if ($('[name="radio_butuh_spiritual"]:checked').val() == 'ya') {
        //     $('#agama_spiritual').removeAttr('readonly');
        // } else {
        //     $('#agama_spiritual').attr('readonly', true);
        //     $('#agama_spiritual').val('');
        // }
    }

    function cek_radio_pekerjaan() {
        // if ($('[name="radio_pekerjaan"]:checked').val() == 'lain_lain') {
        //     $('#pekerjaan_lain_lain').removeAttr('readonly');
        // } else {
        //     $('#pekerjaan_lain_lain').attr('readonly', true);
        //     $('#pekerjaan_lain_lain').val('');
        // }
    }

    function cek_radio_nyeri_menjalar() {
        // if ($('[name="radio_menjalar"]:checked').val() == 'ya') {
        //     $('#ket_nyeri_menjalar').removeAttr('readonly');
        // } else {
        //     $('#ket_nyeri_menjalar').attr('readonly', true);
        //     $('#ket_nyeri_menjalar').val('');
        // }
    }

    function cek_radio_beritahu_dokter() {
        // if ($('[name="radio_beritahu_dokter"]:checked').val() == 'ya') {
        //     $('#jam_diberitahukan').removeAttr('readonly');
        // } else {
        //     $('#jam_diberitahukan').attr('readonly', true);
        //     $('#jam_diberitahukan').val('');
        // }
    }

    function cek_radio_kontrol_ulang() {
        // if ($('[name="radio_kontrol_ulang"]:checked').val() == 'ya') {
        //     $('#tgl_kontrol_ulang').removeAttr('readonly');
        // } else {
        //     $('#tgl_kontrol_ulang').attr('readonly', true);
        //     $('#tgl_kontrol_ulang').val('');
        // }
    }

    function cek_radio_rujuk() {
        // if ($('[name="radio_rujuk_ke"]:checked').val() == 'rs') {
        //     $('#tgl_rujuk').removeAttr('readonly');
        // } else {
        //     $('#tgl_rujuk').attr('readonly', true);
        //     $('#tgl_rujuk').val('');
        // }
    }

    function cek_radio_penyampaian_edukasi() {
        // if ($('[name="radio_penyampaian_edukasi"]:checked').val() == 'ya') {
        //     $('#ket_penyampaian_edukasi').removeAttr('readonly');
        // } else {
        //     $('#ket_penyampaian_edukasi').attr('readonly', true);
        //     $('#ket_penyampaian_edukasi').val('');
        // }
    }

    function hitung_imt() {
        if ($('#bb_gizi').val() != '' && $('#pb_gizi').val() != '') {
            var pb = $('#pb_gizi').val() / 100;
            var imt = $('#bb_gizi').val() / (pb * pb);
            $('#imt_gizi').val(imt.toFixed(2));
            return;
        }
        $('#imt_gizi').val('');
    }

    function cek_form_ttd() {
        // console.log($('[name="radio_sifat_nyeri"]:checked').val());
        // return false;
        // if ($('[name="radio_nyeri"]:checked').val() == 'ya') {
        //     if ($('[name="radio_sifat_nyeri"]:checked').val() == undefined) {
        //         alert('Sifat nyeri harus diisi');
        //         return false;
        //     };
        //     if ($('[name="radio_kualitas_nyeri"]:checked').val() == undefined) {
        //         alert('Kualitas nyeri harus diisi');
        //         return false;
        //     };
        //     if ($('[name="radio_menjalar"]:checked').val() == undefined) {
        //         alert('Menjalar harus diisi');
        //         return false;
        //     };
        //     if ($('[name="radio_frekuensi_nyeri"]:checked').val() == undefined) {
        //         alert('Frekuensi nyeri harus diisi');
        //         return false;
        //     };
        //     if ($('[name="radio_pengaruh_nyeri"]:checked').val() == undefined) {
        //         alert('Pengaruh nyeri harus diisi');
        //         return false;
        //     };
        // }

        $("#hide_ruangan").val($("#ruangan").val());
        $("#hide_keluhan_utama").val($("#keluhan_utama").val());
        $("#hide_riwayat_penyakit_sekarang").val($("#riwayat_penyakit_sekarang").val());
        $("#hide_riwayat_penyakit_dahulu").val($("#riwayat_penyakit_dahulu").val());
        $("#hide_riwayat_alergi_obat").val($("#riwayat_alergi_obat").val());
        $('#hide_kesadaran').val($('[name="radio_kesadaran"]:checked').val());
        $("#hide_ket_sopor_koma").val($("#ket_sopor_koma").val());
        $("#hide_kesadaran_umum").val($("#kesadaran_umum").val());
        $("#hide_berat_badan").val($("#berat_badan").val());
        $('#hide_saudara').val($('[name="radio_saudara"]:checked').val());
        $("#hide_ket_kandung").val($("#ket_kandung").val());
        $("#hide_ket_tiri").val($("#ket_tiri").val());
        $('#hide_tinggal_bersama').val($('[name="radio_tinggal_bersama"]:checked').val());
        $("#hide_ket_tinggal_lainnya").val($("#ket_tinggal_lainnya").val());
        $('#hide_bicara').val($('[name="radio_bicara"]:checked').val());
        $('#hide_komunikasi').val($('[name="radio_komunikasi"]:checked').val());
        $('#hide_emosional').val($('[name="radio_emosional"]:checked').val());
        $('#hide_gangguan_jiwa').val($('[name="radio_gangguan_jiwa"]:checked').val());
        $("#hide_tahun_gangguan_jiwa").val($("#tahun_gangguan_jiwa").val());
        $('#hide_riwayat_trauma').val($('[name="radio_trauma"]:checked').val());
        $("#hide_ket_kriminal").val($("#ket_kriminal").val());
        $('#hide_perasaan').val($('[name="radio_perasaan"]:checked').val());
        $('#hide_wawancara').val($('[name="radio_wawancara"]:checked').val());
        $('#hide_spiritual').val($('[name="radio_spiritual"]:checked').val());
        $('#hide_kebutuhan_spiritual').val($('[name="radio_butuh_spiritual"]:checked').val());
        $('#hide_agama_spiritual').val($('#agama_spiritual').val());
        $('#hide_bantuan_ibadah').val($('#bantuan_ibadah').val());
        $('#hide_status_pernikahan').val($('[name="radio_status_pernikahan"]:checked').val());
        $('#hide_pekerjaan').val($('[name="radio_pekerjaan"]:checked').val());
        $('#hide_pekerjaan_lain_lain').val($('#pekerjaan_lain_lain').val());
        $('#hide_nyeri').val($('[name="radio_nyeri"]:checked').val());
        $('#hide_sifat_nyeri').val($('[name="radio_sifat_nyeri"]:checked').val());
        $('#hide_kualitas_nyeri').val($('[name="radio_kualitas_nyeri"]:checked').val());
        $('#hide_nyeri_menjalar').val($('[name="radio_menjalar"]:checked').val());
        $('#hide_ket_nyeri_menjalar').val($('#ket_nyeri_menjalar').val());
        $('#hide_skor_nyeri').val($('#skor_nyeri').val());
        $('#hide_frekuensi_nyeri').val($('[name="radio_frekuensi_nyeri"]:checked').val());
        $('#hide_pengaruh_nyeri').val($('[name="radio_pengaruh_nyeri"]:checked').val());
        $('#hide_cara_berjalan').val($('[name="radio_cara_berjalan"]:checked').val());
        $('#hide_memegang_kursi').val($('[name="radio_memegang_kursi"]:checked').val());
        $('#hide_hasil_resiko_jatuh').val($('[name="radio_hasil"]:checked').val());
        $('#hide_beritahu_dokter').val($('[name="radio_beritahu_dokter"]:checked').val());
        $('#hide_jam_diberitahukan').val($("#jam_diberitahukan").val());
        $('#hide_hasil_skrining_resiko_jatuh').val($("#hasil_resiko_jatuh").val());
        $('#hide_saran_resiko_jatuh').val($("#saran_resiko_jatuh").val());
        $('#hide_bb_gizi').val($("#bb_gizi").val());
        $('#hide_pb_gizi').val($("#pb_gizi").val());
        $('#hide_imt_gizi').val($("#imt_gizi").val());
        $('#hide_tampak_kurus').val($('[name="radio_tampak_kurus"]:checked').val());
        $('#hide_penurunan_bb').val($('[name="radio_penurunan_bb"]:checked').val());
        $('#hide_asupan_makanan').val($('[name="radio_asupan_makanan"]:checked').val());
        $('#hide_hasil_skrining_gizi').val($("#hasil_skrining_gizi").val());
        $('#hide_saran_skrining_gizi').val($("#saran_skrining_gizi").val());
        $('#hide_sensorik_penglihatan').val($('[name="radio_sensorik_penglihatan"]:checked').val());
        $('#hide_sensorik_penciuman').val($('[name="radio_sensorik_penciuman"]:checked').val());
        $('#hide_sensorik_pendengaran').val($('[name="radio_sensorik_pendengaran"]:checked').val());
        $('#hide_kognitif_satu').val($('[name="radio_kognitif_satu"]:checked').val());
        // $('#hide_kognitif_dua').val($('[name="radio_kognitif_dua"]:checked').val());
        $('#hide_motorik_satu').val($('[name="radio_motorik_satu"]:checked').val());
        $('#hide_motorik_dua').val($('[name="radio_motorik_dua"]:checked').val());
        $('#hide_saran_satu').val($('[name="radio_saran_satu"]:checked').val());
        $('#hide_saran_dua').val($('[name="radio_saran_dua"]:checked').val());
        $('#hide_saran_tiga').val($('[name="radio_saran_tiga"]:checked').val());
        $('#hide_hasil_discharge_planning').val($("#hasil_discharge_planning").val());
        $('#hide_saran_discharge_planning').val($("#saran_discharge_planning").val());
        $('#hide_pemeriksaan_penunjang').val($("#pemeriksaan_penunjang").val());
        $('#hide_status_generalis').val($("#status_generalis").val());
        $('#hide_kontrol_ulang').val($('[name="radio_kontrol_ulang"]:checked').val());
        $('#hide_tgl_kontrol_ulang').val($('#tgl_kontrol_ulang').val());
        $('#hide_rujuk').val($('[name="radio_rujuk_ke"]:checked').val());
        $('#hide_tgl_rujuk').val($('#tgl_rujuk').val());
        $('#hide_penyampaian_edukasi').val($('[name="radio_penyampaian_edukasi"]:checked').val());
        $('#hide_subyektif').val($("#subyektif").val());
        $('#hide_id_ppa').val($("#id_ppa").val());
        $('#hide_ppa').val($("#ppa").val());
        $('#hide_instruksi_kesehatan').val($("#instruksi_kesehatan").val());
        $("#hide_nama_obat_1").val($("#nama_obat_1").val());
        $("#hide_jumlah_obat_1").val($("#jumlah_obat_1").val());
        $("#hide_aturan_pakai_obat_1").val($("#aturan_pakai_obat_1").val());
        $("#hide_tanggal_mulai_minum_obat_1").val($("#tanggal_mulai_minum_obat_1").val());
        $("#hide_keterangan_obat_1").val($("#keterangan_obat_1").val());
        $("#hide_nama_obat_2").val($("#nama_obat_2").val());
        $("#hide_jumlah_obat_2").val($("#jumlah_obat_2").val());
        $("#hide_aturan_pakai_obat_2").val($("#aturan_pakai_obat_2").val());
        $("#hide_tanggal_mulai_minum_obat_2").val($("#tanggal_mulai_minum_obat_2").val());
        $("#hide_keterangan_obat_2").val($("#keterangan_obat_2").val());
        $("#hide_nama_obat_3").val($("#nama_obat_3").val());
        $("#hide_jumlah_obat_3").val($("#jumlah_obat_3").val());
        $("#hide_aturan_pakai_obat_3").val($("#aturan_pakai_obat_3").val());
        $("#hide_tanggal_mulai_minum_obat_3").val($("#tanggal_mulai_minum_obat_3").val());
        $("#hide_keterangan_obat_3").val($("#keterangan_obat_3").val());
        $("#hide_nama_obat_4").val($("#nama_obat_4").val());
        $("#hide_jumlah_obat_4").val($("#jumlah_obat_4").val());
        $("#hide_aturan_pakai_obat_4").val($("#aturan_pakai_obat_4").val());
        $("#hide_tanggal_mulai_minum_obat_4").val($("#tanggal_mulai_minum_obat_4").val());
        $("#hide_keterangan_obat_4").val($("#keterangan_obat_4").val());
        $("#hide_nama_obat_5").val($("#nama_obat_5").val());
        $("#hide_jumlah_obat_5").val($("#jumlah_obat_5").val());
        $("#hide_aturan_pakai_obat_5").val($("#aturan_pakai_obat_5").val());
        $("#hide_tanggal_mulai_minum_obat_5").val($("#tanggal_mulai_minum_obat_5").val());
        $("#hide_keterangan_obat_5").val($("#keterangan_obat_5").val());
        $("#hide_nama_obat_6").val($("#nama_obat_6").val());
        $("#hide_jumlah_obat_6").val($("#jumlah_obat_6").val());
        $("#hide_aturan_pakai_obat_6").val($("#aturan_pakai_obat_6").val());
        $("#hide_tanggal_mulai_minum_obat_6").val($("#tanggal_mulai_minum_obat_6").val());
        $("#hide_keterangan_obat_6").val($("#keterangan_obat_6").val());
        $('#hide_gcs_e').val($('#gcs_e').val());
        $('#hide_gcs_v').val($('#gcs_v').val());
        $('#hide_gcs_m').val($('#gcs_m').val());
    }
</script>
{{-- end of asesment medis awal --}}

</html>
