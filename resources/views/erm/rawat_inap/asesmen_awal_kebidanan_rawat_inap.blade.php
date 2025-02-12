<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Asesmen Awal Kebidanan Rawat Inap</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    <style>
        #tabel_screening tr th {
            padding: 10px;
            border: 1px solid;
        }

        #tabel_screening {
            border-style: hidden;
        }

        #tabel_list_kehamilan {
            border-style: hidden;
        }

        #tabel_list_kehamilan tr th {
            padding: 10px;
            border: 1px solid;
        }

        .tabel_subjektif tr th {
            line-height: 40px;
        }
        
        #tabel_list_kehamilan tr td {
            padding: 10px;
            border: 1px solid;
        }

        .tabel_subjektif tr th {
            /* line-height: 40px; */
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .inputan {
            border: none;
            border-bottom: 2px dotted;
        }

        input[type="number"] {
            text-align: center;
        }

        #box_ttd:hover {
            cursor: pointer;
        }
    </style>

</head>

<body class="pt-2 pb-2">
    <div class="modal fade" id="modal_bidan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Bidan</h5>
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
                                >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_riwayat_kehamilan" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Riwayat Kehamilan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="form_riwayat_kehamilan" onsubmit="return add_riwayat_kehamilan()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tahun Partus</label>
                            <input type="number" id="tahun_partus" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Partus</label>
                            <input type="tetxt" id="tempat_partus" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Umur Hamil</label>
                            <input type="text" id="umur_hamil" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Persalinan</label>
                            <input type="text" id="jenis_persalinan" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Penolong Persalinan</label>
                            <input type="text" id="penolong_persalinan" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Penyulit</label>
                            <input type="text" id="penyulit" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin / Berat Lahir</label>
                            <input type="text" id="kelamin_bb" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Keadaan Anak Sekarang</label>
                            <input type="text" id="keadaan" class="form-control" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_ubah_riwayat_kehamilan" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Riwayat Kehamilan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="form_riwayat_kehamilan" onsubmit="return ubah_riwayat_kehamilan()">
                    <input type="hidden" id="index_ubah_riwayat_kehamilan">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tahun Partus</label>
                            <input type="number" id="ubah_tahun_partus" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Partus</label>
                            <input type="tetxt" id="ubah_tempat_partus" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Umur Hamil</label>
                            <input type="text" id="ubah_umur_hamil" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Persalinan</label>
                            <input type="text" id="ubah_jenis_persalinan" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Penolong Persalinan</label>
                            <input type="text" id="ubah_penolong_persalinan" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Penyulit</label>
                            <input type="text" id="ubah_penyulit" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin / Berat Lahir</label>
                            <input type="text" id="ubah_kelamin_bb" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Keadaan Anak Sekarang</label>
                            <input type="text" id="ubah_keadaan" class="form-control" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form action="{{ url('e_rekam_medis/detail/save_asesmen_awal_kebidanan_rawat_inap') }}" method="post"
        id="hidden_form">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="ruangan" id="hide_ruangan">
        <input type="hidden" name="dpjp" id="hide_dpjp">
        <input type="hidden" name="caradatang_ruangan" id="hide_caradatang_ruangan">
        <input type="hidden" name="rujukan" id="hide_rujukan">
        <input type="hidden" name="rujukan_lain" id="hide_rujukan_lain">
        <input type="hidden" name="caradatang" id="hide_caradatang">
        <input type="hidden" name="riwayat_alergi" id="hide_riwayat_alergi">
        <input type="hidden" name="riwayat_alergi_ada" id="hide_riwayat_alergi_ada">
        <input type="hidden" name="keluhan_utama" id="hide_keluhan_utama">
        <input type="hidden" name="nyeri" id="hide_nyeri">
        <input type="hidden" name="skor_nyeri" id="hide_skor_nyeri">
        <input type="hidden" name="skrining_satu" id="hide_skrining_satu">
        <input type="hidden" name="penurunan_bbs" id="hide_penurunan_bb">
        <input type="hidden" name="skrining_dua" id="hide_skrining_dua">
        <input type="hidden" name="skor_risiko_jatuh" id="hide_skor_risiko_jatuh">
        <input type="hidden" name="menarche" id="hide_menarche">
        <input type="hidden" name="siklus" id="hide_siklus">
        <input type="hidden" name="teratur_menarche" id="hide_teratur_menarche">
        <input type="hidden" name="lama_hari_menarche" id="hide_lama_hari_menarche">
        <input type="hidden" name="keluhans" id="hide_keluhan">
        <input type="hidden" name="keluhan_lain" id="hide_keluhan_lain">
        <input type="hidden" name="hpht" id="hide_hpht">
        <input type="hidden" name="hpl" id="hide_hpl">
        <input type="hidden" name="uk" id="hide_uk">
        <input type="hidden" name="menikah" id="hide_menikah">
        <input type="hidden" name="jumlah_pernikahan" id="hide_jumlah_pernikahan">
        <input type="hidden" name="usia_pernikahan" id="hide_usia_pernikahan">
        <input type="hidden" name="keluarga_terdekat" id="hide_keluarga_terdekat">
        <input type="hidden" name="hubungan" id="hide_hubungan">
        <input type="hidden" name="tinggal_dengan" id="hide_tinggal_dengan">
        <input type="hidden" name="tinggal_dengan_lain" id="hide_tinggal_dengan_lain">
        <input type="hidden" name="curiga" id="hide_curiga">
        <input type="hidden" name="ibadah" id="hide_ibadah">
        <input type="hidden" name="status_emosional" id="hide_status_emosional">
        <input type="hidden" name="g" id="hide_g">
        <input type="hidden" name="p" id="hide_p">
        <input type="hidden" name="a" id="hide_a">
        <input type="hidden" name="riwayat_kehamilan" id="hide_riwayat_kehamilan">
        <input type="hidden" name="riwayat_penyakit_dahulu" id="hide_riwayat_penyakit_dahulu">
        <input type="hidden" name="riwayat_operasi" id="hide_riwayat_operasi">
        <input type="hidden" name="tahun_operasi" id="hide_tahun_operasi">
        <input type="hidden" name="riwayat_penyakit_keluarga" id="hide_riwayat_penyakit_keluarga">
        <input type="hidden" name="riwayat_ginekologi" id="hide_riwayat_ginekologi">
        <input type="hidden" name="riwayat_ginekologi_lain" id="hide_riwayat_ginekologi_lain">
        <input type="hidden" name="flour_albus" id="hide_flour_albus">
        <input type="hidden" name="berbaus" id="hide_berbau">
        <input type="hidden" name="warna" id="hide_warna">
        <input type="hidden" name="metode_kb" id="hide_metode_kb">
        <input type="hidden" name="komplikasi_kb" id="hide_komplikasi_kb">
        <input type="hidden" name="komplikasi_kb_lain" id="hide_komplikasi_kb_lain">
        <input type="hidden" name="bak" id="hide_bak">
        <input type="hidden" name="bab" id="hide_bab">
        <input type="hidden" name="warna_eliminasi" id="hide_warna_eliminasi">
        <input type="hidden" name="karakteristik" id="hide_karakteristik">
        <input type="hidden" name="tidur_malam" id="hide_tidur_malam">
        <input type="hidden" name="tidur_siang" id="hide_tidur_siang">
        <input type="hidden" name="kepala" id="hide_kepala">
        <input type="hidden" name="kepala_lain" id="hide_kepala_lain">
        <input type="hidden" name="rambut" id="hide_rambut">
        <input type="hidden" name="muka" id="hide_muka">
        <input type="hidden" name="mata" id="hide_mata">
        <input type="hidden" name="hidung" id="hide_hidung">
        <input type="hidden" name="telinga" id="hide_telinga">
        <input type="hidden" name="mulut" id="hide_mulut">
        <input type="hidden" name="mulut_lain" id="hide_mulut_lain">
        <input type="hidden" name="leher" id="hide_leher">
        <input type="hidden" name="dada" id="hide_dada">
        <input type="hidden" name="payudaras" id="hide_payudara">
        <input type="hidden" name="payudara_lain" id="hide_payudara_lain">
        <input type="hidden" name="abdomens" id="hide_abdomen">
        <input type="hidden" name="abdomen_lain" id="hide_abdomen_lain">
        <input type="hidden" name="inspeksi" id="hide_inspeksi">
        <input type="hidden" name="inspeksi_lain" id="hide_inspeksi_lain">
        <input type="hidden" name="palpasi" id="hide_palpasi">
        <input type="hidden" name="obstetri" id="hide_obstetri">
        <input type="hidden" name="tfu" id="hide_tfu">
        <input type="hidden" name="tfj" id="hide_tfj">
        <input type="hidden" name="his" id="hide_his">
        <input type="hidden" name="teratur_his" id="hide_teratur_his">
        <input type="hidden" name="durasi" id="hide_durasi">
        <input type="hidden" name="kriteria_durasis" id="hide_kriteria_durasi">
        <input type="hidden" name="djj" id="hide_djj">
        <input type="hidden" name="kriteria_djjs" id="hide_kriteria_djj">
        <input type="hidden" name="inspeksi_genitalia" id="hide_inspeksi_genitalia">
        <input type="hidden" name="banyaknya" id="hide_banyaknya">
        <input type="hidden" name="konsistensi" id="hide_konsistensi">
        <input type="hidden" name="inspekulo" id="hide_inspekulo">
        <input type="hidden" name="inspekulo_lain" id="hide_inspekulo_lain">
        <input type="hidden" name="uretra" id="hide_uretra">
        <input type="hidden" name="vulva" id="hide_vulva">
        <input type="hidden" name="vagina" id="hide_vagina">
        <input type="hidden" name="portio" id="hide_portio">
        <input type="hidden" name="pembukaan" id="hide_pembukaan">
        <input type="hidden" name="selaput" id="hide_selaput">
        <input type="hidden" name="srld" id="hide_srld">
        <input type="hidden" name="mekonium" id="hide_mekonium">
        <input type="hidden" name="bg_terendah" id="hide_bg_terendah">
        <input type="hidden" name="uuk" id="hide_uuk">
        <input type="hidden" name="penurunan" id="hide_penurunan">
        <input type="hidden" name="pecah_ketuban" id="hide_pecah_ketuban">
        <input type="hidden" name="bishope" id="hide_bishope">
        <input type="hidden" name="ekstremitas" id="hide_ekstremitas">
        <input type="hidden" name="diagnosa_kebidanan" id="hide_diagnosa_kebidanan">
        <input type="hidden" name="rencana" id="hide_rencana">
        <input type="hidden" name="td" id="hide_td">
        <input type="hidden" name="bb" id="hide_bb">
        <input type="hidden" name="tb" id="hide_tb">
        <input type="hidden" name="kesadaran" id="hide_kesadaran">
        <input type="hidden" name="keadaan_umum" id="hide_keadaan_umum">
        <input type="hidden" name="nadi" id="hide_nadi">
        <input type="hidden" name="suhu" id="hide_suhu">
        <input type="hidden" name="rr" id="hide_rr">
        <input type="hidden" name="gcs_e" id="hide_gcs_e">
        <input type="hidden" name="gcs_v" id="hide_gcs_v">
        <input type="hidden" name="gcs_m" id="hide_gcs_m">
    </form>
    @if (Session::has('gagal'))
        <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
    @endif
    @if (Session::has('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    <form class="container" id="form_not_submitted" onsubmit="return check_all_field(event)">
        <div class="row">
            <div class="col-md-6 pl-0">
                <img src="{{ asset('filelogo/logo_rshm.jpeg') }}" alt="" style="width: 50%">
                <p style="font-weight: bold">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya,<br>Kec.
                    Cibarusah, Kab. Bekasi - Jawa
                    Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5 pr-0" style="display: flex; align-items: center">
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

                        <tr>
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? $pasien->ktp : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-3" style="border: 1px solid;">
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h4 style="text-align: center; font-size: 22px; font-weight:bolder;">ASSESMENT AWAL KEBIDANAN RAWAT
                    INAP<br><span style="font-style: italic">(diisi oleh Bidan)</span></h4>
            </div>
            <div class="col-md-12 pt-3" style="border: 1px solid; font-weight:bold;">
                <p>*Beri Tanda ✓ Pada Tanda <input style="margin-left: 5px; outline: 2px solid #111;" type="checkbox"
                        disabled>
                </p>
            </div>
            <div class="col-md-6 pt-2 pb-2" style="border: 1px solid;">
                <table style="border-collapse: collapse; width: 100%">
                    <tr>
                        <th style="width: 10%;">Ruang</th>
                        <th style="padding-left: 10px; padding-right: 10px; width:5%;"> : </th>
                        <th style="width: 85%">
                            <select name="ruangan" id="ruangan" class="inputan" style="width: 100%" >
                                <option value=""></option>
                                @foreach ($ruangan as $r)
                                    <option value="{{ $r->nama }}"
                                        {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->ruangan == $r->nama ? 'selected' : '') : ($layanan ? ($layanan->last_nama_ruangan == $r->nama ? 'selected' : '') : '') }}>
                                        {{ $r->nama }}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 10%;">DPJP</th>
                        <th style="padding-left: 10px; padding-right: 10px; width:5%;"> : </th>
                        <th style="width: 85%">
                            <select name="dpjp" id="dpjp" class="inputan" style="width: 100%" >
                                <option value=""></option>
                                @foreach ($dokter as $d)
                                    <option value="{{ $d->nama }}"
                                        {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->dpjp == $d->nama ? 'selected' : '') : ($layanan ? ($layanan->nama_dokter == $d->nama ? 'selected' : '') : '') }}>
                                        {{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="col-md-6"
                style="border: 1px solid; display: flex; align-items: center; justify-content: center">
                <h6 style="text-align: center; font-weight:bold;">Tanggal : <input  type="date"
                        class="inputan" value="{{ $layanan ? date('Y-m-d', strtotime($layanan->tanggal)) : '' }}"
                        name="tanggal">, Jam : <input type="time" 
                        value="{{ $layanan ? date('H:i', strtotime($layanan->tanggal)) : '' }}" class="inputan"
                        name="jam"> WIB
                </h6>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h5 style="text-align: center;">DATA UMUM</h5>
            </div>
            <div class="col-md-12 pt-2 pb-2" style="border: 1px solid;">
                <table style="border-collapse: collapse; width:100%;">
                    <tr>
                        <th style="width: 25%;">
                            Tiba di Ruangan Dengan Cara
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="caradatang"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->caradatang_ruangan == 'jalan' ? 'checked' : '') : '' }}
                                value="jalan" > Jalan
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="caradatang"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->caradatang_ruangan == 'kursi_roda' ? 'checked' : '') : '' }}
                                value="kursi_roda"> Kursi Roda
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="caradatang"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->caradatang_ruangan == 'brankar' ? 'checked' : '') : '' }}
                                value="brankar"> Brankar
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 25%;">
                            Rujukan
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="rujukan"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->rujukan == 'puskesmas' ? 'checked' : '') : '' }}
                                value="puskesmas" > Puskesmas
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="rujukan"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->rujukan == 'bidan' ? 'checked' : '') : '' }}
                                value="bidan"> Bidan
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="rujukan"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->rujukan == 'lain_lain' ? 'checked' : '') : '' }}
                                value="lain_lain">
                            <input type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->rujukan_lain : '' }}"
                                class="inputan"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->rujukan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                id="rujukan_lain">
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 25%;">
                            Masuk Melalui
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="caramasuk"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->caradatang == 'igd' ? 'checked' : '') : '' }}
                                value="igd" > IGD
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="caramasuk"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->caradatang == 'poliklinik' ? 'checked' : '') : '' }}
                                value="poliklinik"> Poliklinik
                        </th>
                        <th style="width: 25%;">
                            <input type="radio" name="caramasuk"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->caradatang == 'kamar_operasi' ? 'checked' : '') : '' }}
                                value="kamar_operasi"> Kamar Operasi
                        </th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h5 style="text-align: center;">RIWAYAT ALERGI</h5>
            </div>
            <div class="col-md-12 pt-2 pb-2" style="border: 1px solid; font-weight:bold;">
                <input type="radio" name="riwayat_alergi"
                    {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_alergi == 'tidak' ? 'checked' : '') : '' }}
                    value="tidak" > Tidak
                <input style="margin-left: 50px;" type="radio"
                    {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_alergi == 'ada' ? 'checked' : '') : '' }}
                    value="ada" name="riwayat_alergi"> Ada, Sebutkan
                :
                <input type="text" class="inputan"
                    value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->riwayat_alergi_ada : '' }}"
                    {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_alergi == 'ada' ? '' : 'readonly') : 'readonly' }}
                    id="riwayat_alergi_ada" style="width: 76%">
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h5 style="text-align: center;">KELUHAN UTAMA</h5>
            </div>
            <div class="col-md-12 pt-2 pb-2" style="border: 1px solid;">
                <textarea id="keluhan_utama" class="form-control" cols="30" rows="5">{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->keluhan_utama : '' }}</textarea>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h5 style="text-align: center;">ASESMEN NYERI</h5>
            </div>
            <div class="col-md-12 pt-2 pb-2" style="border: 1px solid;">
                <table style="border-collapse: collapse; width: 100%;">
                    <tr>
                        <th style="width: 10%">Nyeri</th>
                        <th style="width: 5%"> : </th>
                        <th style="width: 15%">
                            <input type="radio" value="tidak"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->nyeri == 'tidak' ? 'checked' : '') : '' }}
                                name="nyeri" > Tidak
                        </th>
                        <th style="width: 10%">
                            <input type="radio" value="ya"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->nyeri == 'ya' ? 'checked' : '') : '' }}
                                name="nyeri"> Ya
                        </th>
                        <th style="width: 60%">
                            Skor Nyeri :
                            <select id="skor_nyeri" class="inputan"  style="width: 85%">
                                @for ($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}"
                                        {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skor_nyeri == $i ? 'selected' : '') : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5" style="padding-top: 15px;">(Tidak Ada Nyeri : 0, Nyeri Ringan : 1-3, Nyeri
                            Sedang : 4-6, Nyeri Berat : 7-10)</th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h5 style="text-align: center;">SKRINING GIZI AWAL<br><span style="font-style: italic">(Malnutrition
                        Screening Tools)</span></h5>
            </div>
            <div class="col-md-12 pl-0 pr-0" style="border: 1px solid;">
                <table style="border-collapse: collapse; width: 100%;" id="tabel_screening">
                    <tr>
                        <th style="text-align: center">1</th>
                        <th>Apakah pasien mengalami penurunan berat badan yang tidak direncanakan / tidak diinginkan
                            dalam 6 bulan tetrakhir ?</th>
                        <th style="text-align: center">Skor</th>
                        <th style="text-align: center">Skor Pasien</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="radio" name="skrining_satu"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'tidak' ? 'checked' : '') : '' }}
                                 value="tidak"> Tidak
                        </th>
                        <th style="text-align: center">0</th>
                        <th rowspan="8" id="box_skor_penurunan_bb"
                            style="vertical-align: center; text-align: center">
                            <?php
                            if ($dokumen->asesmen_awal_kebidanan_ranap) {
                                if ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'ya') {
                                    switch ($dokumen->asesmen_awal_kebidanan_ranap->penurunan_bb) {
                                        case '1-5':
                                            echo '1';
                                            break;
                                        case '6-10':
                                            echo '2';
                                            break;
                                        case '11-15':
                                            echo '3';
                                            break;
                                        case '> 15':
                                            echo '4';
                                            break;
                                        default:
                                            echo '';
                                            break;
                                    }
                                } else {
                                    switch ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu) {
                                        case 'tidak':
                                            echo '0';
                                            break;
                                        case 'tidak_yakin':
                                            echo '2';
                                            break;
                                        case 'tidak_tahu':
                                            echo '2';
                                            break;
                                        default:
                                            echo '';
                                            break;
                                    }
                                }
                            }
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="radio" name="skrining_satu"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'tidak_yakin' ? 'checked' : '') : '' }}
                                value="tidak_yakin"> Tidak Yakin (ada tanda :
                            baju menjadi longgar)
                        </th>
                        <th style="text-align: center">2</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="radio" name="skrining_satu"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'ya' ? 'checked' : '') : '' }}
                                value="ya"> Ya, ada penurunan BB Sebanyak
                            :
                        </th>
                        <th style="text-align: center"></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="padding-left: 100px;">
                            <input type="radio" name="penurunan_bb"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'ya' ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan_bb == '1-5' ? 'checked' : '') : 'disabled') : 'disabled' }}
                                value="1-5"> 1 - 5 kg
                        </th>
                        <th style="text-align: center">1</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="padding-left: 100px;">
                            <input type="radio" name="penurunan_bb"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'ya' ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan_bb == '6-10' ? 'checked' : '') : 'disabled') : 'disabled' }}
                                value="6-10"> 6 - 10 kg
                        </th>
                        <th style="text-align: center">2</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="padding-left: 100px;">
                            <input type="radio" name="penurunan_bb"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'ya' ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan_bb == '11-15' ? 'checked' : '') : 'disabled') : 'disabled' }}
                                value="11-15"> 11 - 15 kg
                        </th>
                        <th style="text-align: center">3</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="padding-left: 100px;">
                            <input type="radio" name="penurunan_bb"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'ya' ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan_bb == '> 15' ? 'checked' : '') : 'disabled') : 'disabled' }}
                                value="> 15"> > 15 kg
                        </th>
                        <th style="text-align: center">4</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="radio" name="skrining_satu"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'tidak_tahu' ? 'checked' : '') : '' }}
                                value="tidak_tahu"> Tidak Tahu Berapa kg
                            Penurunannya
                        </th>
                        <th style="text-align: center">2</th>
                    </tr>
                    <tr>
                        <th style="text-align: center">2</th>
                        <th>Apakah asupan makan pasien berkurang karena penurunan nafsu makan / kesulitan menerima
                            makanan ?</th>
                        <th style="text-align: center">Skor</th>
                        <th style="text-align: center">Skor Pasien</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="radio" name="skrining_dua"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_dua == 'tidak' ? 'checked' : '') : '' }}
                                 value="tidak"> Tidak
                        </th>
                        <th style="text-align: center">0</th>
                        <th rowspan="2" id="box_skor_asupan_makan"
                            style="vertical-align: center; text-align: center">
                            <?php
                            if ($dokumen->asesmen_awal_kebidanan_ranap) {
                                switch ($dokumen->asesmen_awal_kebidanan_ranap->skrining_dua) {
                                    case 'tidak':
                                        echo '0';
                                        break;
                                    case 'ya':
                                        echo '1';
                                        break;
                                    default:
                                        echo '';
                                        break;
                                }
                            }
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="radio" name="skrining_dua"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->skrining_dua == 'ya' ? 'checked' : '') : '' }}
                                value="ya"> Ya
                        </th>
                        <th style="text-align: center">1</th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h6>Total Skor : <span id="box_total_skor">
                        <?php
                        if ($dokumen->asesmen_awal_kebidanan_ranap) {
                            if ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu != '' && $dokumen->asesmen_awal_kebidanan_ranap->skrining_dua != '') {
                                $penurunan_bb = '';
                                $asupan_makan = '';
                        
                                if ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu == 'ya') {
                                    switch ($dokumen->asesmen_awal_kebidanan_ranap->penurunan_bb) {
                                        case '1-5':
                                            $penurunan_bb = 1;
                                            break;
                                        case '6-10':
                                            $penurunan_bb = 2;
                                            break;
                                        case '11-15':
                                            $penurunan_bb = 3;
                                            break;
                                        case '> 15':
                                            $penurunan_bb = 4;
                                            break;
                                        default:
                                            $penurunan_bb = '';
                                            break;
                                    }
                                } else {
                                    switch ($dokumen->asesmen_awal_kebidanan_ranap->skrining_satu) {
                                        case 'tidak_yakin':
                                            $penurunan_bb = 2;
                                            break;
                                        case 'tidak_tahu':
                                            $penurunan_bb = 2;
                                            break;
                                        default:
                                            $penurunan_bb = '';
                                            break;
                                    }
                                }
                        
                                switch ($dokumen->asesmen_awal_kebidanan_ranap->skrining_dua) {
                                    case 'tidak':
                                        $asupan_makan = 0;
                                        break;
                                    case 'ya':
                                        $asupan_makan = 1;
                                        break;
                                    default:
                                        $asupan_makan = '';
                                        break;
                                }
                        
                                echo (int)$penurunan_bb + (int)$asupan_makan;
                            }
                        }
                        ?>
                    </span> <span style="font-style: italic">(Bila skor > 2,
                        pasien beresiko malnutrisi, konsul ke
                        ahli GIZI)</span></h6>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h5 style="text-align: center;">ASESMEN RISIKO JATUH</h5>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h6>Skor : <input type="number" class="inputan" id="skor_risiko_jatuh">(Lanjutkan dengan mengisi
                    Formulir Pengkajian Risiko jatuh)</h6>
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h5 style="text-align: center;">ASUHAN KEBIDANAN</h5>
            </div>
            <div class="col-md-12 pt-2 pb-4" style="border: 1px solid;">
                <h6>A. SUBJEKTIF</h6>
                <table style="border-collapse: collapse; width:100%;" class="tabel_subjektif">
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">1.</th>
                        <th style="width: 95%">
                            Riwayat Menstruasi
                            <table style="border-collapse: collapse; width:100%">
                                <tr>
                                    <th style="width: 15%">Menarche</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 83%"><input type="number"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->menarche : '' }}"
                                            class="inputan" id="menarche">
                                        Tahun</th>
                                </tr>
                                <tr>
                                    <th style="width: 15%">Siklus</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 83%">
                                        <input type="number" class="inputan"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->siklus : '' }}"
                                            name="hari_siklus"> Hari

                                        <input style="margin-left: 50px;"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->teratur_menarche == 'teratur' ? 'checked' : '') : '' }}
                                            type="radio" name="siklus_haid"  value="teratur"> Teratur

                                        <input style="margin-left: 50px;"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->teratur_menarche == 'tidak_teratur' ? 'checked' : '') : '' }}
                                            type="radio" name="siklus_haid" value="tidak_teratur"> Tidak Teratur,

                                        Lama : 
                                        <input type="number" 
                                        value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->lama_hari_menarche : '' }}"
                                        class="inputan" 
                                        name="hari_tidak_teratur"> Hari

                                        {{-- <input type="number" 
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->lama_hari_menarche : '' }}"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->teratur_menarche == 'tidak_teratur' ? '' : 'readonly') : 'readonly' }}
                                            class="inputan" name="hari_tidak_teratur">  --}}
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 15%">Keluhan</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 83%">
                                        <input type="radio" name="keluhan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->keluhan == 'dismenorhoe' ? 'checked' : '') : '' }}
                                             value="dismenorhoe">
                                        Dismenorhoe
                                        <input style="margin-left: 50px;"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->keluhan == 'spotting' ? 'checked' : '') : '' }}
                                            type="radio" name="keluhan" value="spotting"> Spotting
                                        <input style="margin-left: 50px;"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->keluhan == 'menorrhagia' ? 'checked' : '') : '' }}
                                            type="radio" name="keluhan" value="menorrhagia"> Menorrhagia
                                        <input style="margin-left: 50px;"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->keluhan == 'lain_lain' ? 'checked' : '') : '' }}
                                            type="radio" name="keluhan" value="lain_lain"> <input type="text"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->keluhan_lain : '' }}"
                                            class="inputan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->keluhan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                            id="keluhan_lain" name="keluhan_lain">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 15%">HPHT</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 83%"><input type="text" 
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->hpht : '' }}"
                                            class="inputan" id="hpht"> HPL
                                        :
                                        <input type="text" class="inputan" 
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->hpl : '' }}"
                                            id="hpl"> UK :
                                        <input type="text" class="inputan"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->uk : '' }}"
                                            id="uk" >
                                    </th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">2.</th>
                        <th style="width: 95%">
                            Riwayat Psikososial dan Spiritual
                            <table style="border-collapse: collapse; width:100%">
                                <tr>
                                    <th style="width: 30%">Status Pernikahan</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="radio" name="status_pernikahan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->menikah == 'menikah' ? 'checked' : '') : '' }}
                                            value="menikah" >
                                        Menikah
                                        <input type="radio" name="status_pernikahan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->menikah == 'belum_menikah' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="belum_menikah"> Belum Menikah
                                        <input type="radio" name="status_pernikahan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->menikah == 'janda' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="janda"> Janda
                                    </th>
                                </tr>
                                <?php
                                // $jumlah_pernikahan = $dokumen->asesmen_awal_kebidanan_ranap ? json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan) : [json_decode(json_encode(['suami' => ''])), json_decode(json_encode(['istri' => '']))];
                                ?>
                                <tr>
                                    <th style="width: 30%">Jumlah Pernikahan</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        Istri&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" @if(isset($dokumen->asesmen_awal_kebidanan_ranap) && is_array(json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan))) {{ in_array('istrisatu', json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan)) ? 'checked' : '' }} @endif id="istrisatu"> 1X &nbsp;&nbsp;&nbsp;

                                        <input type="checkbox" @if(isset($dokumen->asesmen_awal_kebidanan_ranap) && is_array(json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan))) {{ in_array('istridua', json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan)) ? 'checked' : '' }} @endif id="istridua"> 2X&nbsp;&nbsp;&nbsp;

                                        <input type="checkbox" @if(isset($dokumen->asesmen_awal_kebidanan_ranap) && is_array(json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan))) {{ in_array('istrilebihdua', json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan)) ? 'checked' : '' }} @endif id="istrilebihdua"> > 2X
                                        
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%"></th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        Suami &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" @if(isset($dokumen->asesmen_awal_kebidanan_ranap) && is_array(json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan))) {{ in_array('suamisatu', json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan)) ? 'checked' : '' }} @endif id="suamisatu"> 1X&nbsp;&nbsp;&nbsp;

                                        <input type="checkbox" @if(isset($dokumen->asesmen_awal_kebidanan_ranap) && is_array(json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan))) {{ in_array('suamidua', json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan)) ? 'checked' : '' }} @endif id="suamidua"> 2X&nbsp;&nbsp;&nbsp;

                                        <input type="checkbox" @if(isset($dokumen->asesmen_awal_kebidanan_ranap) && is_array(json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan))) {{ in_array('suamilebihdua', json_decode($dokumen->asesmen_awal_kebidanan_ranap->jumlah_pernikahan)) ? 'checked' : '' }} @endif id="suamilebihdua"> > 2X
                                        {{-- <input type="radio" name="jumlah_pernikahan_suami"
                                            style="margin-left:20px;"
                                            {{ $jumlah_pernikahan[0]->suami == '1' ? 'checked' : '' }} value="1"
                                            > 1X
                                        <input type="radio" name="jumlah_pernikahan_suami"
                                            style="margin-left: 50px;"
                                            {{ $jumlah_pernikahan[0]->suami == '2' ? 'checked' : '' }} value="2">
                                        2X
                                        <input type="radio" name="jumlah_pernikahan_suami"
                                            style="margin-left: 50px;"
                                            {{ $jumlah_pernikahan[0]->suami == '> 2' ? 'checked' : '' }}
                                            value="> 2"> > 2X --}}
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Usia Perkawinan</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="number" name="usia_perkawinan"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->usia_pernikahan : '' }}"
                                            style="border: none; border-bottom: 2px dotted; width:10%;" > Tahun
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Keluarga Terdekat</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="text" id="keluarga_terdekat"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->keluarga_terdekat : '' }}"
                                            style="border: none; border-bottom: 2px dotted; width:40%;" >
                                        Hubungan : <input type="text" name="hubungan_keluarga"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->hubungan : '' }}"
                                            style="border: none; border-bottom: 2px dotted; width:40%;" >
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Tinggal Dengan</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="radio" name="tinggal_dengan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->tinggal_dengan == 'orang_tua' ? 'checked' : '') : '' }}
                                            value="orang_tua" > Orang
                                        Tua
                                        <input type="radio" name="tinggal_dengan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->tinggal_dengan == 'suami' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="suami"> Suami
                                        <input type="radio" name="tinggal_dengan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->tinggal_dengan == 'anak' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="anak"> Anak
                                        <input type="radio" name="tinggal_dengan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->tinggal_dengan == 'sendiri' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="sendiri"> Sendiri
                                        <input type="radio" name="tinggal_dengan"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->tinggal_dengan == 'lain_lain' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="lain_lain"> <input type="text"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->tinggal_dengan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                            id="tinggal_dengan_lain" name="tinggal_dengan_lain"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->tinggal_dengan_lain : '' }}"
                                            style="border: none; border-bottom: 2px dotted; width:25%;">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Curiga Penganiayaan / Penelantaran</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->curiga == 'tidak' ? 'checked' : '') : '' }}
                                            name="curiga_penganiayaan" value="tidak" >
                                        Tidak
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->curiga == 'ya' ? 'checked' : '') : '' }}
                                            name="curiga_penganiayaan" style="margin-left: 50px;" value="ya"> Ya
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Kegiatan Ibadah</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="text" name="kegiatan_ibadah"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->ibadah : '' }}"
                                            style="border: none; border-bottom: 2px dotted; width:100%;" >
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Status Emosional</th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="radio" name="status_emosional"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->status_emosional == 'normal' ? 'checked' : '') : '' }}
                                            value="normal" > Normal
                                        <input type="radio" name="status_emosional"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->status_emosional == 'tidak_semangat' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="tidak_semangat"> Tidak Semangat
                                        <input type="radio" name="status_emosional"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->status_emosional == 'tertekan' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="tertekan"> Tertekan
                                        <input type="radio" name="status_emosional"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->status_emosional == 'depresi' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;" value="depresi"> Depresi
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%"></th>
                                    <th style="width: 2%"> : </th>
                                    <th style="width: 68%">
                                        <input type="radio" name="status_emosional"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->status_emosional == 'cemas' ? 'checked' : '') : '' }}
                                            value="cemas"> Cemas
                                        <input type="radio" name="status_emosional"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->status_emosional == 'sulit_tidur' ? 'checked' : '') : '' }}
                                            style="margin-left: 58px;" value="sulit_tidur"> Sulit Tidur
                                    </th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">3.</th>
                        <th style="width: 95%">
                            Riwayat Kehamilah, Persalinan, dan Nifas
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;"></th>
                        <th style="width: 95%">
                            G : <input type="text" name="riwayat_kehamilan_g"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->g : '' }}"
                                style="border: none; border-bottom:2px dotted; width:25%; margin-right:50px;" >
                            P : <input type="text" name="riwayat_kehamilan_p"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->p : '' }}"
                                style="border: none; border-bottom:2px dotted; width:25%; margin-right:50px;" >
                            A : <input type="text" name="riwayat_kehamilan_a"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->a : '' }}"
                                style="border: none; border-bottom:2px dotted; width:25%;" >
                        </th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pl-0 pr-0" style="border: 1px solid">
                <table style="border-collapse: collapse; width:100%;" id="tabel_list_kehamilan">
                    <thead>
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Tahun Partus</th>
                            <th>Tempat Partus</th>
                            <th>Umur Hamil</th>
                            <th>Jenis Persalinan</th>
                            <th>Penolong Persalinan</th>
                            <th>Penyulit</th>
                            <th>Jenis Kelamin / Berat Lahir</th>
                            <th>Keadaan Anak Sekarang</th>
                            <th><button type="button" onclick="open_modal_riwayat_kehamilan()"
                                    class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="list_riwayat_kehamilan"></tbody>
                </table>
            </div>
            <div class="col-md-12 pt-2 pb-4" style="border: 1px solid;">
                <table style="border-collapse: collapse; width:100%;" class="tabel_subjektif">
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">4.</th>
                        <th style="width: 95%">
                            Riwayat Penyakit Dahulu
                            <input type="text" id="riwayat_penyakit_dahulu"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->riwayat_penyakit_dahulu : '' }}"
                                style="border: none; border-bottom:2px dotted; width:100%; margin-bottom: 20px;"
                                >
                            Riwayat Operasi :
                            <input type="text" id="riwayat_operasi"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->riwayat_operasi : '' }}"
                                style="border: none; border-bottom:2px dotted; width:71%;" >
                            Tahun : <input type="text" id="tahun_operasi"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->tahun_operasi : '' }}"
                                style="border: none; border-bottom:2px dotted; width:10%;" >
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">5.</th>
                        <th style="width: 95%">
                            Riwayat Penyakit Keluarga<br>
                            <input type="text" id="riwayat_penyakit_keluarga"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->riwayat_penyakit_keluarga : '' }}"
                                style="border: none; border-bottom:2px dotted; width:100%;" >
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">6.</th>
                        <th style="width: 95%">
                            Riwayat Ginekologi
                            <table style="border-collapse: collapse; width:100%">
                                <tr>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'infertilitas' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi"  value="infertilitas"> Infertilitas
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'infeksi_virus' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="infeksi_virus">
                                        Infeksi Virus
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'pms' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="pms"> PMS
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'cervisitis_kronis' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="cervisitis_kronis">
                                        Cervisitis Kronis
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'endometriosis' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="endometriosis">
                                        Endometriosis
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'myoma' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="myoma"> Myoma
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'polip_serviks' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="polip_serviks">
                                        Polip Serviks
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'kangker_kandungan' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="kangker_kandungan">
                                        Kangker Kandungan
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'operasi_kandungan' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="operasi_kandungan">
                                        Opeasi Kandungan
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'perkosaan' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="perkosaan"> Perkosaan
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 20%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'flour_albus' ? 'checked' : '') : '' }}
                                            name="riwayat_ginekologi" value="flour_albus"> Flour
                                        Albus (Gatal) :
                                    </th>
                                    <th colspan="4" style="width: 80%">
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->flour_albus == 'tidak' ? 'checked' : '') : '' }}
                                            name="flour_albus"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'flour_albus' ? '' : 'disabled') : 'disabled' }}
                                            value="tidak"> Tidak
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->flour_albus == 'ya' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px;"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'flour_albus' ? '' : 'disabled') : 'disabled' }}
                                            name="flour_albus" value="ya"> Ya,
                                        <span style="margin-left:50px;">Berbau : </span>
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->berbau == 'tidak' ? 'checked' : '') : '' }}
                                            name="berbau"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'flour_albus' ? '' : 'disabled') : 'disabled' }}
                                            value="tidak"> Tidak
                                        <input type="radio"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->berbau == 'ya' ? 'checked' : '') : '' }}
                                            style="margin-left: 50px"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'flour_albus' ? '' : 'disabled') : 'disabled' }}
                                            name="berbau" value="ya"> Ya
                                        <span style="margin-left:50px;">Warna : </span>
                                        <input type="text"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->warna : '' }}"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'flour_albus' ? '' : 'readonly') : 'readonly' }}
                                            id="warna"
                                            style="border: none; border-bottom:2px dotted; width:35%;">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 20%">
                                        <input type="radio" name="riwayat_ginekologi"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'post_coital_bleeding' ? 'checked' : '') : '' }}
                                            value="post_coital_bleeding">
                                        Post Coital Bleeding
                                    </th>
                                    <th colspan="4" style="width: 80%">
                                        <input type="radio" name="riwayat_ginekologi" value="lain_lain"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'lain_lain' ? 'checked' : '') : '' }}>
                                        <input type="text" name="riwayat_ginekologi_lain"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi_lain : '' }}"
                                            id="riwayat_ginekologi_lain"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->riwayat_ginekologi == 'post_coital_bleeding' ? '' : 'readonly') : 'readonly' }}
                                            style="border: none; border-bottom:2px dotted; width:97%;">
                                    </th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">7.</th>
                        <th style="width: 95%">
                            Riwayat KB
                            <?php
                            $metode_kb = $dokumen->asesmen_awal_kebidanan_ranap ? json_decode($dokumen->asesmen_awal_kebidanan_ranap->metode_kb) : [json_decode(json_encode(['metode' => '', 'lama' => ''])), json_decode(json_encode(['metode' => '', 'lama' => ''])), json_decode(json_encode(['metode' => '', 'lama' => '']))];
                            ?>
                            <table style="border-collapse: collapse; width:100%;">
                                <tr>
                                    <th style="width: 25%">Metode KB yang pernah dipakai</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width:72%">1. <input type="text"
                                            value="{{ $metode_kb[0]->metode }}"
                                            style="border: none; border-bottom:2px dotted; width:50%; margin-right:50px;"
                                            id="kb_satu">Lama : <input type="number"
                                            value="{{ $metode_kb[0]->lama }}"
                                            style="border: none; border-bottom :2px dotted; width:10%;"
                                            id="lama_kb_satu">Tahun</th>
                                </tr>
                                <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width:72%">2. <input type="text"
                                            value="{{ $metode_kb[1]->metode }}"
                                            style="border: none; border-bottom:2px dotted; width:50%; margin-right:50px;"
                                            id="kb_dua">Lama : <input type="number"
                                            value="{{ $metode_kb[1]->lama }}"
                                            style="border: none; border-bottom :2px dotted; width:10%;"
                                            id="lama_kb_dua">Tahun</th>
                                </tr>
                                <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width:72%">3. <input type="text"
                                            value="{{ $metode_kb[2]->metode }}"
                                            style="border: none; border-bottom:2px dotted; width:50%; margin-right:50px;"
                                            id="kb_tiga">Lama : <input type="number"
                                            value="{{ $metode_kb[2]->lama }}"
                                            style="border: none; border-bottom :2px dotted; width:10%;"
                                            id="lama_kb_tiga">Tahun</th>
                                </tr>
                                <tr>
                                    <th colspan="3" style="width: 100%">
                                        Komplikasi dari KB : <input type="radio" name="komplikasi_kb"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->komplikasi_kb == 'pendarahan' ? 'checked' : '') : '' }}
                                            value="pendarahan"> Pendarahan
                                        <input style="margin-left: 50px;" type="radio" name="komplikasi_kb"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->komplikasi_kb == 'pid' ? 'checked' : '') : '' }}
                                            value="pid"> PID / Radang Panggul
                                        <input style="margin-left: 50px;" type="radio" name="komplikasi_kb"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->komplikasi_kb == 'lain_lain' ? 'checked' : '') : '' }}
                                            value="lain_lain"> <input type="text" id="komplikasi_kb_lain"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->komplikasi_kb_lain : '' }}"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->komplikasi_kb == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                            style="border: none; border-bottom:2px dotted; width:30%;"
                                            name="komplikasi_kb_lain">
                                    </th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th style="width: 5%; padding-left: 20px;">8.</th>
                        <th style="width: 95%">
                            Pola Eliminasi / Istirahat
                            <table style="border-collapse: collapse; width:100%;">
                                <tr>
                                    <th style="width: 15%">Pola Eliminasi</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 36%">BAK : <input type="text"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->bak : '' }}"
                                            id="bak"  class="inputan"> cc/hari,</th>
                                    <th style="width: 12%">Warna</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 34%"><input type="text" id="warna_bak"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->warna_eliminasi : '' }}"
                                            class="inputan">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 15%"></th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 36%">BAB : <input type="text"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->bab : '' }}"
                                            id="bab"  class="inputan"> x/hari,</th>
                                    <th style="width: 12%">Karakteristik</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 34%"><input type="text" id="karakteristik_bab"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->karakteristik : '' }}"
                                            class="inputan"></th>
                                </tr>
                                <tr>
                                    <th style="width: 15%">Pola Istirahat</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 36%">Tidur Malam : <input type="text"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->tidur_malam : '' }}"
                                            id="tidur_malam"  class="inputan"> Jam/Hari,</th>
                                    <th style="width: 12%">Tidur Siang</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 34%"><input type="text"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->tidur_siang : '' }}"
                                            id="tidur_siang" class="inputan">
                                        Jam/Hari</th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-2 pb-4" style="border: 1px solid;">
                <h6>B. OBJEKTIF</h6>
                <table style="border-collapse: collapse; width:100%;" class="tabel_subjektif">
                    <tr style="vertical-align: top;">
                        <th>1.</th>
                        <th>Pemeriksaan Umum</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            Keadaan Umum : <input type="text" style="width: 25%" id="keadaan_umum" 
                                class="inputan"
                                value="{{ $layanan ? ($layanan->tanda_vital ? $layanan->tanda_vital->keadaan_umum : '') : '' }}">,
                            Kesadaran :
                            <select id="kesadaran"  class="inputan">
                                <option value="">--Select Here--</option>
                                <option
                                    {{ $dokumen ? ($dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kesadaran == 'composmentis' ? 'selected' : '') : '') : '' }}
                                    value="composmentis">Composmentis</option>
                                <option
                                    {{ $dokumen ? ($dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kesadaran == 'sompolen' ? 'selected' : '') : '') : '' }}
                                    value="sompolen">Sompolen</option>
                                <option
                                    {{ $dokumen ? ($dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kesadaran == 'sopor' ? 'selected' : '') : '') : '' }}
                                    value="sopor">Sopor</option>
                                <option
                                    {{ $dokumen ? ($dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kesadaran == 'coma' ? 'selected' : '') : '') : '' }}
                                    value="coma">Coma</option>
                            </select>
                            {{-- <input type="text" style="width: 25%" name="kesadaran" 
                                class="inputan"
                                value="{{ $layanan ? ($layanan->tanda_vital ? $layanan->tanda_vital->kesadaran : '') : '' }}"> --}}
                            , BB/TB : <input type="number"  id="bb" style="width: 10%"
                                class="inputan"
                                value="{{ $layanan ? ($layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '') : '' }}">
                            / <input type="number" id="tb" style="width: 10%"  class="inputan"
                                value="{{ $dokumen ? ($dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->tb : '') : '' }}">
                            <br>
                            <br>
                            GCS : E : <input
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->gcs_e : '' }}"
                                 type="text" id="gcs_e" class="inputan"
                                style="margin-right: 20px; width:25%">
                            V : <input type="text" id="gcs_v"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->gcs_v : '' }}"
                                 class="inputan" style="margin-right: 20px; width:25%">
                            M : <input
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->gcs_m : '' }}"
                                 style=" width:25%" type="text" id="gcs_m" class="inputan">
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            TD : <input type="text" style="width: 15%; text-align:center;" id="td"
                                value="{{ $layanan ? ($layanan->tanda_vital ? $layanan->tanda_vital->tensi : '') : '' }}"
                                class="inputan" >
                            mmHg,
                            Nadi : <input type="text" style="width: 15%; text-align:center;" id="nadi"
                                value="{{ $layanan ? ($layanan->tanda_vital ? $layanan->tanda_vital->nadi : '') : '' }}"
                                class="inputan" >
                            x/Menit,
                            Suhu : <input type="text" style="width: 15%; text-align:center;" id="suhu"
                                value="{{ $layanan ? ($layanan->tanda_vital ? $layanan->tanda_vital->suhu : '') : '' }}"
                                class="inputan" >
                            °C,
                            RR : <input type="text" style="width: 15%; text-align:center;" id="rr"
                                value="{{ $layanan ? ($layanan->tanda_vital ? $layanan->tanda_vital->rr : '') : '' }}"
                                class="inputan" >
                            x/Menit
                        </th>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th>2.</th>
                        <th>
                            Pemeriksaan Fisik
                            <table style="border-collapse: collapse; width:100%">
                                <tr>
                                    <th style="width: 12%;">Kepala</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="kepala"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kepala == 'misochepal' ? 'checked' : '') : '' }}
                                            value="misochepal" class="inputan" > Misochepal
                                    </th>
                                    <th colspan="3" style="width: 65%">
                                        <input type="radio" name="kepala"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kepala == 'lain_lain' ? 'checked' : '') : '' }}
                                            value="lain_lain" class="inputan">
                                        <input type="text" name="kepala_lain" style="width: 93%"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kepala == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                            id="kepala_lain"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->kepala_lain : '' }}"
                                            class="inputan">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Rambut</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="rambut"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->rambut == 'bersih' ? 'checked' : '') : '' }}
                                            value="bersih" class="inputan" > Bersih
                                    </th>
                                    <th colspan="3" style="width: 65%">
                                        <input type="radio" name="rambut"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->rambut == 'kotor' ? 'checked' : '') : '' }}
                                            value="kotor" class="inputan">
                                        Kotor
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Muka</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="muka"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->muka == 'normal' ? 'checked' : '') : '' }}
                                            value="normal" class="inputan" > Normal
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="muka"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->muka == 'pucat' ? 'checked' : '') : '' }}
                                            value="pucat" class="inputan">
                                        Pucat
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="muka"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->muka == 'oedema' ? 'checked' : '') : '' }}
                                            value="oedema" class="inputan">
                                        Oedema
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="muka"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->muka == 'cloasma' ? 'checked' : '') : '' }}
                                            value="cloasma" class="inputan">
                                        Cloasma
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Mata</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="mata"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->mata == 'konjungtiva_merah' ? 'checked' : '') : '' }}
                                            value="konjungtiva_merah" class="inputan" > Konjungtiva Merah
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="mata"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->mata == 'sklera_ikterik' ? 'checked' : '') : '' }}
                                            value="sklera_ikterik" class="inputan">
                                        Sklera Ikterik
                                    </th>
                                    <th style="width: 40%" colspan="2">
                                        <input type="radio" name="mata"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->mata == 'pandangan_kabur' ? 'checked' : '') : '' }}
                                            value="pandangan_kabur" class="inputan"> Pandangan Kabur
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Hidung</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="hidung"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->hidung == 'normal' ? 'checked' : '') : '' }}
                                            value="normal" class="inputan" > Normal
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="hidung"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->hidung == 'sekret' ? 'checked' : '') : '' }}
                                            value="sekret" class="inputan">
                                        Sekret
                                    </th>
                                    <th style="width: 40%" colspan="2">
                                        <input type="radio" name="hidung"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->hidung == 'polip' ? 'checked' : '') : '' }}
                                            value="polip" class="inputan">
                                        Polip
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Telinga</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="telinga"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->telinga == 'bersih' ? 'checked' : '') : '' }}
                                            value="bersih" class="inputan" > Bersih
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="telinga"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->telinga == 'serumen' ? 'checked' : '') : '' }}
                                            value="serumen" class="inputan">
                                        Serumen
                                    </th>
                                    <th style="width: 40%" colspan="2">
                                        <input type="radio" name="telinga"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->telinga == 'polip' ? 'checked' : '') : '' }}
                                            value="polip" class="inputan">
                                        Polip
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Mulut</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="mulut"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->mulut == 'bersih' ? 'checked' : '') : '' }}
                                            value="bersih" class="inputan" > Bersih
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="mulut"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->mulut == 'kotor' ? 'checked' : '') : '' }}
                                            value="kotor" class="inputan">
                                        Kotor
                                    </th>
                                    <th style="width: 40%" colspan="2">
                                        <input type="radio" name="mulut"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->mulut == 'lain_lain' ? 'checked' : '') : '' }}
                                            value="lain_lain" class="inputan">
                                        <input type="text" name="mulut_lain" class="inputan" id="mulut_lain"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->mulut_lain : '' }}"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->mulut == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                            style="width:90%;">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Leher</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="leher"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->leher == 'pembesaran_limfe' ? 'checked' : '') : '' }}
                                            value="pembesaran_limfe" class="inputan" > Pembesaran Limfe
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="leher"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->leher == 'pembesaran_kel_tiroid' ? 'checked' : '') : '' }}
                                            value="pembesaran_kel_tiroid" class="inputan"> Pembesaran Kel.Tiroid
                                    </th>
                                    <th style="width: 40%" colspan="2">
                                        <input type="radio" name="leher"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->leher == 'pembesaran_vena_jugularis' ? 'checked' : '') : '' }}
                                            value="pembesaran_vena_jugularis" class="inputan"> Pembesaran vena
                                        Jugularis
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Dada</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="dada"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->dada == 'simetris' ? 'checked' : '') : '' }}
                                            value="simetris" class="inputan" > Simetris
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="dada"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->dada == 'asimetris' ? 'checked' : '') : '' }}
                                            value="asimetris" class="inputan">
                                        Asimetris
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="dada"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->dada == 'pernafasan_normal' ? 'checked' : '') : '' }}
                                            value="pernafasan_normal" class="inputan"> Pernafasan Normal
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="dada"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->dada == 'sesak' ? 'checked' : '') : '' }}
                                            value="sesak" class="inputan">
                                        Sesak
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Payudara</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="payudara"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->payudara == 'keluar_asi' ? 'checked' : '') : '' }}
                                            value="keluar_asi" class="inputan" > Keluar ASI
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="payudara"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->payudara == 'puting_datar' ? 'checked' : '') : '' }}
                                            value="puting_datar" class="inputan">
                                        Puting Datar/Tenggelam
                                    </th>
                                    <th style="width: 40%" colspan="2">
                                        <input type="radio" name="payudara"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->payudara == 'puting_menonjol' ? 'checked' : '') : '' }}
                                            value="puting_menonjol" class="inputan"> Puting Menonjol
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;"></th>
                                    <th style="width: 3%"> : </th>
                                    <th colspan="4">
                                        <input type="radio" name="payudara"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->payudara == 'lain_lain' ? 'checked' : '') : '' }}
                                            value="lain_lain" class="inputan">
                                        <input type="text"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->payudara == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                            id="payudara_lain" style="width: 95%"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->payudara_lain : '' }}"
                                            class="inputan">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;">Abdomen</th>
                                    <th style="width: 3%"> : </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="abdomen"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->abdomen == 'luka_bekas_operasi' ? 'checked' : '') : '' }}
                                            value="luka_bekas_operasi" class="inputan" > Luka Bekas Operasi
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="abdomen"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->abdomen == 'nyeri_tekan' ? 'checked' : '') : '' }}
                                            value="nyeri_tekan" class="inputan">
                                        Nyeri Tekan
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="abdomen"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->abdomen == 'ya' ? 'checked' : '') : '' }}
                                            value="ya" class="inputan"> Ya
                                        <input type="radio" style="margin-left: 20px;"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->abdomen == 'tidak' ? 'checked' : '') : '' }}
                                            name="abdomen" value="tidak" class="inputan"> Tidak
                                    </th>
                                    <th style="width: 20%">
                                        <input type="radio" name="abdomen"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->abdomen == 'massa_tumor' ? 'checked' : '') : '' }}
                                            value="massa_tumor" class="inputan">
                                        Massa Tumor
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 12%;"></th>
                                    <th style="width: 3%"> : </th>
                                    <th colspan="4">
                                        <input type="radio" name="abdomen"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->abdomen == 'lain_lain' ? 'checked' : '') : '' }}
                                            value="lain_lain" class="inputan">
                                        <input type="text"
                                            value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->abdomen_lain : '' }}"
                                            {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->abdomen == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                            id="abdomen_lain" style="width: 95%" class="inputan">
                                    </th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-2 pb-4" style="border: 1px solid;">
                <h6 style="font-style: italic">Khusus Obstetri</h6>
                <table style="border-collapse: collapse; width:100%;">
                    <tr>
                        <th style="width: 10%">Inspeksi</th>
                        <th style="width: 3%"> : </th>
                        <th style="width: 87%"></th>
                    </tr>
                    <tr>
                        <th style="width: 100%" colspan="3">
                            <input type="radio" name="inspeksi"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'membesar' ? 'checked' : '') : '' }}
                                value="membesar" > Membesar dengan arah
                            memanjang / melebar
                            <input style="margin-left: 50px;"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'pelebaran_vena' ? 'checked' : '') : '' }}
                                type="radio" name="inspeksi" value="pelebaran_vena">
                            Pelebaran Vena
                            <input style="margin-left: 50px;"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'linea_alba' ? 'checked' : '') : '' }}
                                type="radio" name="inspeksi" value="linea_alba">
                            Linea Alba
                            <input style="margin-left: 50px;"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'linea_nigra' ? 'checked' : '') : '' }}
                                type="radio" name="inspeksi" value="linea_nigra">
                            Linea Nigra
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 100%" colspan="3">
                            <input type="radio" name="inspeksi"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'striae_livide' ? 'checked' : '') : '' }}
                                value="striae_livide"> Striae Livide
                            <input style="margin-left: 50px;"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'striae_albican' ? 'checked' : '') : '' }}
                                type="radio" name="inspeksi" value="striae_albican">
                            Striae Albican
                            <input style="margin-left: 50px;"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'luka_bekas_operasi' ? 'checked' : '') : '' }}
                                type="radio" name="inspeksi" value="luka_bekas_operasi"> Luka Bekas Operasi
                            <input style="margin-left: 50px;"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi == 'lain_lain' ? 'checked' : '') : '' }}
                                type="radio" name="inspeksi" value="lain_lain">
                            <input type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->inspeksi_lain : '' }}"
                                name="inspeksi_lain"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                id="inspeksi_lain" class="inputan" style="width: 25%">
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 10%">Palpasi</th>
                        <th style="width: 3%"> : </th>
                        <th style="width: 87%"></th>
                    </tr>
                    <?php
                    $palpasi = $dokumen->asesmen_awal_kebidanan_ranap ? json_decode($dokumen->asesmen_awal_kebidanan_ranap->palpasi) : ['', '', '', ''];
                    ?>
                    <tr>
                        <th style="width: 10%">Leopold I</th>
                        <th style="width: 3%"> : </th>
                        <th style="width: 87%">
                            <input type="text" id="leopold_satu" value="{{ $palpasi[0] }}" 
                                style="width: 100%" class="inputan">
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 10%">Leopold II</th>
                        <th style="width: 3%"> : </th>
                        <th style="width: 87%">
                            <input type="text" id="leopold_dua" value="{{ $palpasi[1] }}" 
                                style="width: 100%" class="inputan">
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 10%">Leopold III</th>
                        <th style="width: 3%"> : </th>
                        <th style="width: 87%">
                            <input type="text" id="leopold_tiga" value="{{ $palpasi[2] }}" 
                                style="width: 100%" class="inputan">
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 10%">Leopold IV</th>
                        <th style="width: 3%"> : </th>
                        <th style="width: 87%">
                            <input type="text" id="leopold_empat" value="{{ $palpasi[3] }}" 
                                style="width: 100%" class="inputan">
                        </th>
                    </tr>
                </table>
                <div class="pt-2" style="font-weight: bold">
                    <input type="radio" name="nyeri_obstetri"
                        {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->obstetri == 'nyeri_tekan' ? 'checked' : '') : '' }}
                        value="nyeri_tekan" > Nyeri Tekan
                    <input style="margin-left: 100px;" type="radio" name="nyeri_obstetri"
                        {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->obstetri == 'osborn_tes' ? 'checked' : '') : '' }}
                        value="osborn_tes">
                    Osborn Test
                    <input style="margin-left: 100px;" type="radio" name="nyeri_obstetri"
                        {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->obstetri == 'cekungan_pada_perut' ? 'checked' : '') : '' }}
                        value="cekungan_pada_perut"> Cekungan Pada
                    Perut
                </div>
                <table style="border-collapse: collapse; width:100%">
                    <tr>
                        <th style="width: 20%">Nyeri Fundus Uteri (TFU)</th>
                        <th style="width: 30%">: <input type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->tfu : '' }}"
                                id="tfu" style="width: 60%" class="inputan" > cm</th>
                        <th style="width: 15%"></th>
                        <th style="width: 15%"></th>
                        <th style="width: 20%"></th>
                    </tr>
                    <tr>
                        <th style="width: 20%">Taksiran Berat Janin (TFJ)</th>
                        <th style="width: 30%">: <input type="text" id="tfj"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->tfj : '' }}"
                                style="width: 60%" class="inputan" > gram</th>
                        <th style="width: 15%"></th>
                        <th style="width: 15%"></th>
                        <th style="width: 20%"></th>
                    </tr>
                    <tr>
                        <th style="width: 20%">His</th>
                        <th style="width: 30%">: <input id="his"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->his : '' }}"
                                type="text" style="width: 60%" class="inputan" > x/10
                            menit</th>
                        <th style="width: 15%"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->teratur_his == 'teratur' ? 'checked' : '') : '' }}
                                value="teratur" name="teratur_his" > Teratur</th>
                        <th style="width: 15%"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->teratur_his == 'tidak_teratur' ? 'checked' : '') : '' }}
                                value="tidak_teratur" name="teratur_his"> Tidak Teratur</th>
                        <th style="width: 20%"></th>
                    </tr>
                    <tr>
                        <th style="width: 20%">Durasi</th>
                        <th style="width: 30%">: <input type="text" id="durasi" 
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->durasi : '' }}"
                                style="width: 60%" class="inputan"> detik</th>
                        <th style="width: 15%"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kriteria_durasi == 'kuat' ? 'checked' : '') : '' }}
                                value="kuat" name="kriteria_durasi" > Kuat</th>
                        <th style="width: 15%"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kriteria_durasi == 'sedang' ? 'checked' : '') : '' }}
                                value="sedang" name="kriteria_durasi"> Sedang</th>
                        <th style="width: 20%"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kriteria_durasi == 'lemah' ? 'checked' : '') : '' }}
                                value="lemah" name="kriteria_durasi"> Lemah</th>
                    </tr>
                    <tr>
                        <th style="width: 20%">Auskultasi : DJJ</th>
                        <th style="width: 30%">: <input type="text" style="width: 60%"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->djj : '' }}"
                                class="inputan"  id="djj">
                            x/menit</th>
                        <th style="width: 15%"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kriteria_djj == 'teratur' ? 'checked' : '') : '' }}
                                value="teratur" name="kriteria_djj" > Teratur</th>
                        <th style="width: 15%"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->kriteria_djj == 'tidak_teratur' ? 'checked' : '') : '' }}
                                value="tidak_teratur" name="kriteria_djj"> Tidak Teratur</th>
                        <th style="width: 20%"></th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 pt-2 pb-4" style="border: 1px solid;">
                <h6>GENITALIA</h6>
                <table style="border-collapse: collapse; width:100%" class="tabel_subjektif">
                    <tr>
                        <th>Inspeksi</th>
                        <th> : </th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi_genitalia == 'bersih' ? 'checked' : '') : '' }}
                                value="bersih" name="inspeksi_genitalia" > Bersih</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi_genitalia == 'kotor' ? 'checked' : '') : '' }}
                                value="kotor" name="inspeksi_genitalia"> Kotor</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi_genitalia == 'varies' ? 'checked' : '') : '' }}
                                value="varies" name="inspeksi_genitalia"> Varies</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi_genitalia == 'oedema' ? 'checked' : '') : '' }}
                                value="oedema" name="inspeksi_genitalia"> Oedema</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi_genitalia == 'abses' ? 'checked' : '') : '' }}
                                value="abses" name="inspeksi_genitalia"> Abses</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspeksi_genitalia == 'hematon' ? 'checked' : '') : '' }}
                                value="hematon" name="inspeksi_genitalia"> Hematom</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th> : </th>
                        <th colspan="2">Pengeluaran Per Vagina : </th>
                        <th colspan="5">Banyaknya : <input type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->banyaknya : '' }}"
                                name="pengeluaran"  class="inputan"> cc
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Konsistensi</th>
                        <th> : <input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->konsistensi == 'encer' ? 'checked' : '') : '' }}
                                value="encer" name="konsistensi" > Encer</th>
                        <th colspan="2"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->konsistensi == 'gumpalan' ? 'checked' : '') : '' }}
                                value="gumpalan" name="konsistensi"> Gumpalan/Stolsel</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th> : <input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->konsistensi == 'keputihan' ? 'checked' : '') : '' }}
                                value="keputihan" name="konsistensi"> Keputihan</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->konsistensi == 'darah' ? 'checked' : '') : '' }}
                                value="darah" name="konsistensi"> Darah</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->konsistensi == 'darah_lendir' ? 'checked' : '') : '' }}
                                value="darah_lendir" name="konsistensi"> Darah Lendir</th>
                    </tr>
                    <tr>
                        <th>Inspekulo</th>
                        <th> : </th>
                        <th colspan="6"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspekulo == 'vagina' ? 'checked' : '') : '' }}
                                value="vagina" name="inspekulo"> Vagina : <input type="text"
                                id="inspekulo_lain" style="width: 90%;"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->inspekulo_lain : '' }}"
                                class="inputan"></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th> : </th>
                        <th>Portio</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspekulo == 'merah' ? 'checked' : '') : '' }}
                                value="merah" name="inspekulo"> Merah</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspekulo == 'darah' ? 'checked' : '') : '' }}
                                value="darah" name="inspekulo"> Darah</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspekulo == 'keputihan' ? 'checked' : '') : '' }}
                                value="keputihan" name="inspekulo"> Kepeutihan</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->inspekulo == 'ketuban' ? 'checked' : '') : '' }}
                                value="ketuban" name="inspekulo"> Air Ketuban</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="8">Periksa Dalam</th>
                    </tr>
                    <tr>
                        <th>Uretra</th>
                        <th> : </th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->uretra == 'infeksi' ? 'checked' : '') : '' }}
                                value="infeksi" name="uretra" > Infeksi</th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->uretra == 'tidak_ada' ? 'checked' : '') : '' }}
                                value="tidak_ada" name="uretra"> Tidak Ada</th>
                    </tr>
                    <tr>
                        <th>Vulva</th>
                        <th> : </th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->vulva == 'pembengkakan' ? 'checked' : '') : '' }}
                                value="pembengkakan" name="vulva" > Pembengkakan Kelenjar
                            Bartholini
                        </th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->vulva == 'tidak_ada' ? 'checked' : '') : '' }}
                                value="tidak_ada" name="vulva"> Tidak Ada</th>
                    </tr>
                    <tr>
                        <th>Vagina</th>
                        <th> : </th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->vagina == 'licin' ? 'checked' : '') : '' }}
                                value="licin" name="vagina" > Licin</th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->vagina == 'benjolan' ? 'checked' : '') : '' }}
                                value="benjolan" name="vagina"> Benjolan</th>
                    </tr>
                    <tr>
                        <th>Portio</th>
                        <th> : </th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->portio == 'tebal' ? 'checked' : '') : '' }}
                                value="tebal" name="portio" > Tebal</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->portio == 'tipis' ? 'checked' : '') : '' }}
                                value="tipis" name="portio"> Tipis</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->portio == 'lunak' ? 'checked' : '') : '' }}
                                value="lunak" name="portio"> Lunak</th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->portio == 'kaku' ? 'checked' : '') : '' }}
                                value="kaku" name="portio"> Kaku</th>
                    </tr>
                    <tr>
                        <th>Pembukaan</th>
                        <th> : </th>
                        <th colspan="2"><input type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->pembukaan : '' }}"
                                class="inputan" id="pembukaan" > cm
                        </th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->selaput == 'selaput_ketu' ? 'checked' : '') : '' }}
                                value="selaput_ketu" name="selaput"> Selaput Ketu</th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->selaput == 'ketuban' ? 'checked' : '') : '' }}
                                value="ketuban" name="selaput"> Ketuban</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th> : </th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->selaput == 'srld' ? 'checked' : '') : '' }}
                                value="srld" name="selaput" > SRLD : <input style="width:75%;"
                                type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->srld : '' }}"
                                id="srld" class="inputan"></th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->selaput == 'mekonium' ? 'checked' : '') : '' }}
                                value="mekonium" name="selaput"> Mekonium : <input style="width:75%;"
                                type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->mekonium : '' }}"
                                id="mekonium" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>Bg. Terendah</th>
                        <th> : </th>
                        <th colspan="6"><input style="width:100%;"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->bg_terendah : '' }}"
                                type="text"  id="bg_terendah" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>UUK</th>
                        <th> : </th>
                        <th colspan="6"><input style="width:100%;" type="text"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->uuk : '' }}"
                                 id="uuk" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>Penurunan</th>
                        <th> : </th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan == 'h_i' ? 'checked' : '') : '' }}
                                name="penurunan" value="h_i" > H I</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan == 'h_ii' ? 'checked' : '') : '' }}
                                name="penurunan" value="h_ii"> H II</th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan == 'h_iii' ? 'checked' : '') : '' }}
                                name="penurunan" value="h_iii"> H III</th>
                        <th colspan="3"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->penurunan == 'h_iv' ? 'checked' : '') : '' }}
                                name="penurunan" value="h_iv"> H IV</th>
                    </tr>
                    <tr>
                        <th>Ketuban Pecah Jam</th>
                        <th> : </th>
                        <th colspan="6"><input type="text" class="inputan"
                                value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->pecah_ketuban : '' }}"
                                name="jam_pecah_ketuban"> WIB
                        </th>
                    </tr>
                    <tr>
                        <th>Bishope Score</th>
                        <th> : </th>
                        <th><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->bishope == '>=6' ? 'checked' : '') : '' }}
                                value=">=6" name="bishope_score" > ≥ 6</th>
                        <th colspan="5"><input type="radio"
                                {{ $dokumen->asesmen_awal_kebidanan_ranap ? ($dokumen->asesmen_awal_kebidanan_ranap->bishope == '< 6' ? 'checked' : '') : '' }}
                                value="< 6" name="bishope_score">
                            < 6</th>
                    </tr>
                    <?php
                    $ekstremitas = $dokumen->asesmen_awal_kebidanan_ranap ? json_decode($dokumen->asesmen_awal_kebidanan_ranap->ekstremitas) : [json_decode(json_encode(['atas' => '', 'bawah' => '']))];
                    ?>
                    <tr>
                        <th>Ekstremitas</th>
                        <th> : </th>
                        <th>Atas</th>
                        <th> : <input value="oedema" type="radio"
                                {{ $ekstremitas[0]->atas == 'oedema' ? 'checked' : '' }} name="ekstremitas_atas"
                                > Oedema</th>
                        <th colspan="4"><input value="normal" type="radio"
                                {{ $ekstremitas[0]->atas == 'normal' ? 'checked' : '' }} name="ekstremitas_atas">
                            Normal</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th> : </th>
                        <th>Bawah</th>
                        <th> : <input value="oedema" type="radio"
                                {{ $ekstremitas[0]->bawah == 'oedema' ? 'checked' : '' }} name="ekstremitas_bawah"
                                > Oedema</th>
                        <th colspan="4"><input value="normal" type="radio"
                                {{ $ekstremitas[0]->bawah == 'normal' ? 'checked' : '' }} name="ekstremitas_bawah">
                            Normal</th>
                    </tr>
                    <tr>
                        <th colspan="8">3. Pemeriksaan Penunjang</th>
                    </tr>
                    <tr>
                        <th colspan="8">
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
                                            @if (isset($yang_dipesan->$temp_slug) && $yang_dipesan->$temp_slug == 1)
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
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Jenis Pemeriksaan</th>
                                                <th>Hasil</th>
                                                <th>Nilai Rujukan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_hasil_lab">
                                            <?php
                                            if (isset($layanan->pesanan_lab[0])) {
                                                $cek = false;
                                                $hasil = json_decode($layanan->pesanan_lab[0]->hasil, true);
                                                $key_hasil = is_array($hasil) ? array_keys($hasil) : [];
                                                for ($i = 0; $i < count($key_hasil); $i++) {
                                                    if (isset($hasil[$key_hasil[$i]]) && $hasil[$key_hasil[$i]] != '') {
                                                        $cek = true;
                                                        break;
                                                    }
                                                }
                                                $ins = '';
                                                if ($cek) {
                                                    $temp_grup = '';
                                                    foreach ($master_hasil as $item) {
                                                        if (isset($hasil[$item->slug]) && $hasil[$item->slug] != '') {
                                                            if ($temp_grup != $item->grup) {
                                                                $ins .= '<tr>' . '<th colspan="3">' . $item->grup . '</th>' . '</tr>';
                                                                $temp_grup = $item->grup;
                                                            }
                                                            $ins .= '<tr>' . '<td style="padding-left: 40px">' . $item->name . '</td>' . '<td class="text-center">' . $hasil[$item->slug] . '</td>' . '<td class="text-center">' . $item->nt . '</td>' . '</tr>';
                                                        }
                                                    }
                                                } else {
                                                    $ins = '<tr>' . '<th colspan="3" class="text-center">Tidak ada hasil</th>' . '</tr>';
                                                }
                                                echo $ins;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            
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
                                            @if (isset($yang_dipesan->$temp_slug) && $yang_dipesan->$temp_slug == 1)
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
                                    <table>
                                        <?php
                                        if (isset($layanan->pesanan_radiologi[0])) {
                                            $ins = '';
                                            $hasil = json_decode($layanan->pesanan_radiologi[0]->hasil, true);
                                            $key_hasil = is_array($hasil) ? array_keys($hasil) : [];
                                            $periksa = json_decode($layanan->pesanan_radiologi[0]->periksa, true);
                                            $key_periksa = is_array($periksa) ? array_keys($periksa) : [];
                                            $pemeriksaan = $pemeriksaan_radiologi;
                                            $no = 1;
                                            for ($i = 0; $i < count($key_hasil); $i++) {
                                                $temp_slug = $key_hasil[$i];
                                                $index = explode('_', $temp_slug);
                                                if (isset($hasil[$temp_slug]) && $hasil[$temp_slug] != '') {
                                                    for ($j = 0; $j < count($key_periksa); $j++) {
                                                        if (isset($periksa[$temp_slug]) && $periksa[$temp_slug] == 1) {
                                                            $ins .= '<tr>' . '<td style="vertical-align:top; line-height:2;">' . $no . '. </td>' . '<td style="vertical-align:top; line-height:2;" class="pl-2">' . $pemeriksaan[$index[1] - 1]->nama . '</td>' . '<td style="vertical-align:top; line-height:2;" class="pl-4 pr-4"> : </td><td style="vertical-align:top; line-height:2;">' . $hasil[$temp_slug] . '</td></tr>';
                                                            $no++;
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                            echo $ins;
                                        }
                                        ?>
                                    </table>
                                @endif
                            </div>
                            
                        </th>
                    </tr>
                    {{-- <tr>
                        <th>Darah</th>
                        <th class="pr-3"> : </th>
                        <th colspan="2"><input type="radio" name=""> HB : <input style="width: 50%"
                                type="text" name="hb" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> Golongan Darah : <input
                                style="width: 50%" type="text" name="golongan_darah" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> Leukosit : <input
                                style="width: 50%" type="text" name="leukosit" class="inputan"></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="pr-3"> : </th>
                        <th colspan="2"><input type="radio" name=""> Trombosit : <input
                                style="width: 50%;" type="text" name="trombosit" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> HBSAG : <input
                                style="width: 50%;" type="text" name="hbsag" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> GDS : <input
                                style="width: 50%;" type="text" name="gds" class="inputan"></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="pr-3"> : </th>
                        <th colspan="2"><input type="radio" name=""> HIV : <input
                                style="width: 50%;" type="text" name="hiv" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> PPT : <input
                                style="width: 50%;" type="text" name="ppt" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> APTT : <input
                                style="width: 50%;" type="text" name="aptt" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>Urine</th>
                        <th class="pr-3"> : </th>
                        <th colspan="2"><input type="radio" name=""> Protein : <input
                                style="width: 50%;" type="text" name="protein" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> Keton : <input
                                style="width: 50%;" type="text" name="keton" class="inputan"></th>
                        <th colspan="2"><input type="radio" name=""> Urine Easbach : <input
                                style="width: 50%;" type="text" name="urine_easbach" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>CTG</th>
                        <th class="pr-3"> : </th>
                        <th colspan="6"><input type="text" name="" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>Rontgen</th>
                        <th class="pr-3"> : </th>
                        <th colspan="6"><input type="text" name="" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>USG</th>
                        <th class="pr-3"> : </th>
                        <th colspan="6"><input type="text" name="" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>EKG</th>
                        <th class="pr-3"> : </th>
                        <th colspan="6"><input type="text" name="" class="inputan"></th>
                    </tr>
                    <tr>
                        <th>Lain-lain</th>
                        <th class="pr-3"> : </th>
                        <th colspan="6"><input type="text" name="" class="inputan"></th>
                    </tr> --}}
                </table>
            </div>
            <div class="col-md-12 pt-2 pb-4" style="border: 1px solid;">
                <h6>C. DIAGNOSA KEBIDANAN</h6>
                <input type="text" class="inputan"
                    value="{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->diagnosa_kebidanan : '' }}"
                    id="diagnosa_kebidanan"  style="width: 100%">
            </div>
            <div class="col-md-12 pt-2" style="border: 1px solid;">
                <h6>D. RENCANA ASUHAN KEBIDANAN</h6>
                <textarea id="rencana" style="width: 100%" rows="10" >{{ $dokumen->asesmen_awal_kebidanan_ranap ? $dokumen->asesmen_awal_kebidanan_ranap->rencana : '' }}</textarea>
            </div>
            <div class="col-md-12 pt-2 text-center" style="border: 1px solid;">
                <p style="font-weight: bold" id="box_ttd" onclick="open_modal_verifikasi()">
                    Cibarusah, {{ date('d-m-Y') }}, Jam : {{ date('H:i') }} WIB
                    <br>
                    @if ($dokumen->id_verifikator == 0)
                        Bidan
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.....................................................)
                        <br>
                        Ttd & Nama Terang
                    @else
                        @if (isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}"
                                style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 4cm; width: 5cm;"
                                alt="">
                        @endif
                        <br>({{ $dokumen->nama_verifikator }})
                    @endif
                </p>
            </div>
        </div>
    </form>
    <div style="text-align: center; width:100%" class="pt-4 pb-2">
        <button class="btn btn-success" onclick="set_hidden_form()">Simpan</button>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let riwayat_kehamilan = [];

    $("[name=jam_pecah_ketuban]").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 1
    });

    // $(document).ready(function() {
    //     @if (isset($dokumen->asesmen_awal_kebidanan_ranap))
    //         riwayat_kehamilan = <?php echo $dokumen->asesmen_awal_kebidanan_ranap->riwayat_kehamilan; ?>;
    //     @endif
    //     render_riwayat_kehamilan();
    // })

    $(document).ready(function() {
        @if (isset($dokumen->asesmen_awal_kebidanan_ranap))
            riwayat_kehamilan = JSON.parse(@json($dokumen->asesmen_awal_kebidanan_ranap->riwayat_kehamilan ?? '[]'));
        @endif
        render_riwayat_kehamilan();
    });

    function open_modal_verifikasi() {
        $('#form_not_submitted').submit();
        if ($("#form_not_submitted")[0].checkValidity()) {
            $('#modal_bidan').modal('show');
        } else {
            $("#form_not_submitted")[0].reportValidity()
        }
    }

    function check_all_field(event) {
    event.preventDefault();
    return false; 
}


    function add_riwayat_kehamilan() {
        riwayat_kehamilan.push({
            'tahun_partus': $('#tahun_partus').val(),
            'tempat_partus': $('#tempat_partus').val(),
            'umur_hamil': $('#umur_hamil').val(),
            'jenis_persalinan': $('#jenis_persalinan').val(),
            'penolong_persalinan': $('#penolong_persalinan').val(),
            'penyulit': $('#penyulit').val(),
            'kelamin_bb': $('#kelamin_bb').val(),
            'keadaan': $('#keadaan').val(),
            'deleted': false
        });
        $('#modal_riwayat_kehamilan').modal('hide');
        render_riwayat_kehamilan();
        return false;
    }

    function ubah_riwayat_kehamilan() {
        riwayat_kehamilan[$('#index_ubah_riwayat_kehamilan').val()] = {
            'tahun_partus': $('#ubah_tahun_partus').val(),
            'tempat_partus': $('#ubah_tempat_partus').val(),
            'umur_hamil': $('#ubah_umur_hamil').val(),
            'jenis_persalinan': $('#ubah_jenis_persalinan').val(),
            'penolong_persalinan': $('#ubah_penolong_persalinan').val(),
            'penyulit': $('#ubah_penyulit').val(),
            'kelamin_bb': $('#ubah_kelamin_bb').val(),
            'keadaan': $('#ubah_keadaan').val(),
            'deleted': false
        };
        $('#modal_ubah_riwayat_kehamilan').modal('hide');
        render_riwayat_kehamilan();
        return false;
    }

    function render_riwayat_kehamilan() {
        var ins = '';
        var no = 1;
        for (let i = 0; i < riwayat_kehamilan.length; i++) {
            if (!riwayat_kehamilan[i].deleted) {
                ins += '<tr>' +
                    '<td style="text-align:center;">' + no + '</td>' +
                    '<td>' + riwayat_kehamilan[i].tahun_partus + '</td>' +
                    '<td>' + riwayat_kehamilan[i].tempat_partus + '</td>' +
                    '<td>' + riwayat_kehamilan[i].umur_hamil + '</td>' +
                    '<td>' + riwayat_kehamilan[i].jenis_persalinan + '</td>' +
                    '<td>' + riwayat_kehamilan[i].penolong_persalinan + '</td>' +
                    '<td>' + riwayat_kehamilan[i].penyulit + '</td>' +
                    '<td>' + riwayat_kehamilan[i].kelamin_bb + '</td>' +
                    '<td>' + riwayat_kehamilan[i].keadaan + '</td>' +
                    '<td>' +
                    '<div style="display:inline-flex">' +
                    '<button class="btn btn-warning mr-1" onclick="open_modal_ubah_riwayat_kehamilan(' + i +
                    ')" style="color:#fff;" type="button"><i class="fa fa-pencil"></i></button>' +
                    '<button class="btn btn-danger" onclick="hapus_riwayat_kehamilan(' + i +
                    ')" type="button"><i class="fa fa-trash"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                no++;
            }
        }
        $('#list_riwayat_kehamilan').html(ins);
    }

    function hapus_riwayat_kehamilan(index) {
        if (confirm('Yakin melanjutkan hapus riwayat kehamilan ?')) {
            riwayat_kehamilan[index].deleted = true;
            render_riwayat_kehamilan();
        }
    }

    function open_modal_riwayat_kehamilan() {
        $('#form_riwayat_kehamilan')[0].reset();
        $('#modal_riwayat_kehamilan').modal('show');
    }

    function open_modal_ubah_riwayat_kehamilan(index) {
        $('#index_ubah_riwayat_kehamilan').val(index);
        $('#ubah_tahun_partus').val(riwayat_kehamilan[index].tahun_partus);
        $('#ubah_tempat_partus').val(riwayat_kehamilan[index].tempat_partus);
        $('#ubah_umur_hamil').val(riwayat_kehamilan[index].umur_hamil);
        $('#ubah_jenis_persalinan').val(riwayat_kehamilan[index].jenis_persalinan);
        $('#ubah_penolong_persalinan').val(riwayat_kehamilan[index].penolong_persalinan);
        $('#ubah_penyulit').val(riwayat_kehamilan[index].penyulit);
        $('#ubah_kelamin_bb').val(riwayat_kehamilan[index].kelamin_bb);
        $('#ubah_keadaan').val(riwayat_kehamilan[index].keadaan);
        $('#modal_ubah_riwayat_kehamilan').modal('show');
    }

    $('[name=rujukan]').change(function() {
        if ($('[name=rujukan]:checked').val() == 'lain_lain') {
            $('#rujukan_lain').removeAttr('readonly');
            return;
        }
        $('#rujukan_lain').val('');
        $('#rujukan_lain').attr('readonly', true);
    })

    $('[name=riwayat_alergi]').change(function() {
        if ($('[name=riwayat_alergi]:checked').val() == 'ada') {
            $('#riwayat_alergi_ada').removeAttr('readonly');
            return;
        }
        $('#riwayat_alergi_ada').val('');
        $('#riwayat_alergi_ada').attr('readonly', true);
    })

    $('[name=skrining_satu]').change(function() {
        if ($('[name=skrining_satu]:checked').val() == 'ya') {
            $('[name=penurunan_bb]').removeAttr('disabled');
            $('#box_skor_penurunan_bb').html('');
            return;
        }
        $('[name=penurunan_bb]').prop('checked', false);
        $('[name=penurunan_bb]').attr('disabled', true);

        if ($('[name=skrining_satu]:checked').val() == 'tidak') {
            $('#box_skor_penurunan_bb').html('0');
        } else if ($('[name=skrining_satu]:checked').val() == 'tidak_yakin' || $('[name=skrining_satu]:checked')
            .val() == 'tidak_tahu') {
            $('#box_skor_penurunan_bb').html('2');
        }
        hitung_skor_skrining_gizi();
    })

    $('[name=penurunan_bb]').change(function() {
        switch ($('[name=penurunan_bb]:checked').val()) {
            case '1-5':
                $('#box_skor_penurunan_bb').html('1');
                hitung_skor_skrining_gizi();
                break;
            case '6-10':
                $('#box_skor_penurunan_bb').html('2');
                hitung_skor_skrining_gizi();
                break;
            case '11-15':
                $('#box_skor_penurunan_bb').html('3');
                hitung_skor_skrining_gizi();
                break;
            case '> 15':
                $('#box_skor_penurunan_bb').html('4');
                hitung_skor_skrining_gizi();
                break;
            default:
                $('#box_skor_penurunan_bb').html('');
                hitung_skor_skrining_gizi();
                break;
        }
    })

    $('[name=skrining_dua]').change(function() {
        if ($('[name=skrining_dua]:checked').val() == 'tidak') {
            $('#box_skor_asupan_makan').html('0');
        } else if ($('[name=skrining_dua]:checked').val() == 'ya') {
            $('#box_skor_asupan_makan').html('1');
        }
        hitung_skor_skrining_gizi();
    });

    function hitung_skor_skrining_gizi() {
        if ($('#box_skor_asupan_makan').html() == '' || $('#box_skor_penurunan_bb').html() == '') {
            $('#box_total_skor').html('');
            return;
        }
        let asupan_makan = parseInt($('#box_skor_asupan_makan').html());
        let penurunan_bb = parseInt($('#box_skor_penurunan_bb').html());
        $('#box_total_skor').html(asupan_makan + penurunan_bb);
    }

    $('[name=siklus_haid]').change(function() {
        if ($('[name=siklus_haid]:checked').val() == 'tidak_teratur') {
            $('#hari_tidak_teratur').removeAttr('readonly');
            return;
        }
        $('#hari_tidak_teratur').val('');
        $('#hari_tidak_teratur').attr('readonly', true);
    })

    $('[name=keluhan]').change(function() {
        if ($('[name=keluhan]:checked').val() == 'lain_lain') {
            $('#keluhan_lain').removeAttr('readonly');
            return;
        }
        $('#keluhan_lain').val('');
        $('#keluhan_lain').attr('readonly', true);
    })

    $('[name=tinggal_dengan]').change(function() {
        if ($('[name=tinggal_dengan]:checked').val() == 'lain_lain') {
            $('#tinggal_dengan_lain').removeAttr('readonly');
            return;
        }
        $('#tinggal_dengan_lain').val('');
        $('#tinggal_dengan_lain').attr('readonly', true);
    })

    $('[name=riwayat_ginekologi]').change(function() {
        if ($('[name=riwayat_ginekologi]:checked').val() == 'flour_albus') {
            $('[name=flour_albus]').removeAttr('disabled');
            $('[name=berbau]').removeAttr('disabled');
            $('#warna').removeAttr('readonly');
        } else {
            $('[name=flour_albus]').prop('checked', false);
            $('[name=berbau]').prop('checked', false);
            $('#warna').val('');
            $('[name=flour_albus]').attr('disabled', true);
            $('[name=berbau]').attr('disabled', true);
            $('#warna').attr('readonly', true);
        }

        if ($('[name=riwayat_ginekologi]:checked').val() == 'lain_lain') {
            $('#riwayat_ginekologi_lain').removeAttr('readonly');
        } else {
            $('#riwayat_ginekologi_lain').val('');
            $('#riwayat_ginekologi_lain').attr('readonly', true);
        }
    })

    $('[name=komplikasi_kb]').change(function() {
        if ($('[name=komplikasi_kb]:checked').val() == 'lain_lain') {
            $('#komplikasi_kb_lain').removeAttr('readonly');
            return;
        }
        $('#komplikasi_kb_lain').val('');
        $('#komplikasi_kb_lain').attr('readonly', true);
    })

    $('[name=kepala]').change(function() {
        if ($('[name=kepala]:checked').val() == 'lain_lain') {
            $('#kepala_lain').removeAttr('readonly');
            return;
        }
        $('#kepala_lain').val('');
        $('#kepala_lain').attr('readonly', true);
    })

    $('[name=mulut]').change(function() {
        if ($('[name=mulut]:checked').val() == 'lain_lain') {
            $('#mulut_lain').removeAttr('readonly');
            return;
        }
        $('#mulut_lain').val('');
        $('#mulut_lain').attr('readonly', true);
    })

    $('[name=payudara]').change(function() {
        if ($('[name=payudara]:checked').val() == 'lain_lain') {
            $('#payudara_lain').removeAttr('readonly');
            return;
        }
        $('#payudara_lain').val('');
        $('#payudara_lain').attr('readonly', true);
    })

    $('[name=abdomen]').change(function() {
        if ($('[name=abdomen]:checked').val() == 'lain_lain') {
            $('#abdomen_lain').removeAttr('readonly');
            return;
        }
        $('#abdomen_lain').val('');
        $('#abdomen_lain').attr('readonly', true);
    })

    $('[name=inspeksi]').change(function() {
        if ($('[name=inspeksi]:checked').val() == 'lain_lain') {
            $('#inspeksi_lain').removeAttr('readonly');
            return;
        }
        $('#inspeksi_lain').val('');
        $('#inspeksi_lain').attr('readonly', true);
    })

    function set_hidden_form() {
        $('#hide_ruangan').val($('#ruangan').val());
        $('#hide_dpjp').val($('#dpjp').val());
        $('#hide_caradatang_ruangan').val($('[name=caradatang]:checked').val() != undefined ? $(
            '[name=caradatang]:checked').val() : '');
        $('#hide_rujukan').val($('[name=rujukan]:checked').val() != undefined ? $('[name=rujukan]:checked').val() : '');
        $('#hide_rujukan_lain').val($('#rujukan_lain').val());
        $('#hide_caradatang').val($('[name=caramasuk]:checked').val() != undefined ? $('[name=caramasuk]:checked')
            .val() : '');
        $('#hide_riwayat_alergi').val($('[name=riwayat_alergi]:checked').val() != undefined ? $(
            '[name=riwayat_alergi]:checked').val() : '');
        $('#hide_riwayat_alergi_ada').val($('#riwayat_alergi_ada').val());
        $('#hide_keluhan_utama').val($('#keluhan_utama').val());
        $('#hide_nyeri').val($('[name=nyeri]:checked').val() != undefined ? $('[name=nyeri]:checked').val() : '');
        $('#hide_skor_nyeri').val($('#skor_nyeri').val());
        $('#hide_skrining_satu').val($('[name=skrining_satu]:checked').val() != undefined ? $(
            '[name=skrining_satu]:checked').val() : '');
        $('#hide_penurunan_bb').val($('[name=penurunan_bb]:checked').val() != undefined ? $(
            '[name=penurunan_bb]:checked').val() : '');
        $('#hide_skrining_dua').val($('[name=skrining_dua]:checked').val() != undefined ? $(
            '[name=skrining_dua]:checked').val() : '');
        $('#hide_skor_risiko_jatuh').val($('#skor_risiko_jatuh').val());
        $('#hide_menarche').val($('#menarche').val());
        $('#hide_siklus').val($('[name=hari_siklus]').val());
        $('#hide_teratur_menarche').val($('[name=siklus_haid]:checked').val() != undefined ? $(
            '[name=siklus_haid]:checked').val() : '');
        $('#hide_lama_hari_menarche').val($('[name=hari_tidak_teratur]').val());
        $('#hide_keluhan').val($('[name=keluhan]:checked').val());
        $('#hide_keluhan_lain').val($('#keluhan_lain').val());
        $('#hide_hpht').val($('#hpht').val());
        $('#hide_hpl').val($('#hpl').val());
        $('#hide_uk').val($('#uk').val());
        $('#hide_menikah').val($('[name=status_pernikahan]').val());

        // let jumlah_pernikahan = [{
        //     'suami': ($('[name=jumlah_pernikahan_suami]').val() != undefined ? $(
        //         '[name=jumlah_pernikahan_suami]').val() : '')
        // }, {
        //     'istri': ($('[name=jumlah_pernikahan_istri]').val() != undefined ? $(
        //         '[name=jumlah_pernikahan_istri]').val() : '')
        // }];
        var jumlah_pernikahan = [];
        if ($('#istrisatu').is(":checked")){
            jumlah_pernikahan.push('istrisatu');
        }
        if ($('#istridua').is(":checked")){
            jumlah_pernikahan.push('istridua');
        }
        if ($('#istrilebihdua').is(":checked")){
            jumlah_pernikahan.push('istrilebihdua');
        }
        if ($('#suamisatu').is(":checked")){
            jumlah_pernikahan.push('suamisatu');
        }
        if ($('#suamidua').is(":checked")){
            jumlah_pernikahan.push('suamidua');
        }
        if ($('#suamilebihdua').is(":checked")){
            jumlah_pernikahan.push('suamilebihdua');
        }

        $('#hide_jumlah_pernikahan').val(JSON.stringify(jumlah_pernikahan));
        $('#hide_usia_pernikahan').val($('[name=usia_perkawinan]').val());
        $('#hide_keluarga_terdekat').val($('#keluarga_terdekat').val());
        $('#hide_hubungan').val($('[name=hubungan_keluarga]').val());
        $('#hide_tinggal_dengan').val($('[name=tinggal_dengan]:checked').val() != undefined ? $(
            '[name=tinggal_dengan]:checked').val() : '');
        $('#hide_tinggal_dengan_lain').val($('#tinggal_dengan_lain').val());
        $('#hide_curiga').val($('[name=curiga_penganiayaan]:checked').val() != undefined ? $(
            '[name=curiga_penganiayaan]:checked').val() : '');
        $('#hide_ibadah').val($('[name=kegiatan_ibadah]').val());
        $('#hide_status_emosional').val($('[name=status_emosional]:checked').val() != undefined ? $(
            '[name=status_emosional]:checked').val() : '');
        $('#hide_g').val($('[name=riwayat_kehamilan_g]').val());
        $('#hide_p').val($('[name=riwayat_kehamilan_p]').val());
        $('#hide_a').val($('[name=riwayat_kehamilan_a]').val());
        $('#hide_riwayat_kehamilan').val(JSON.stringify(riwayat_kehamilan));
        $('#hide_riwayat_penyakit_dahulu').val($('#riwayat_penyakit_dahulu').val());
        $('#hide_riwayat_operasi').val($('#riwayat_operasi').val());
        $('#hide_tahun_operasi').val($('#tahun_operasi').val());
        $('#hide_riwayat_penyakit_keluarga').val($('#riwayat_penyakit_keluarga').val());
        $('#hide_riwayat_ginekologi').val($('[name=riwayat_ginekologi]:checked').val() != undefined ? $(
            '[name=riwayat_ginekologi]:checked').val() : '');
        $('#hide_flour_albus').val($('[name=flour_albus]:checked').val() != undefined ? $('[name=flour_albus]:checked')
            .val() : '');
        $('#hide_berbau').val($('[name=berbau]:checked').val());
        $('#hide_warna').val($('#warna').val());
        $('#hide_riwayat_ginekologi_lain').val($('#riwayat_ginekologi_lain').val());

        let metode_kb = [{
            'metode': $('#kb_satu').val(),
            'lama': $('#lama_kb_satu').val(),
        }, {
            'metode': $('#kb_dua').val(),
            'lama': $('#lama_kb_dua').val(),
        }, {
            'metode': $('#kb_tiga').val(),
            'lama': $('#lama_kb_tiga').val(),
        }];

        $('#hide_metode_kb').val(JSON.stringify(metode_kb));
        $('#hide_komplikasi_kb').val($('[name=komplikasi_kb]:checked').val());
        $('#hide_komplikasi_kb_lain').val($('#komplikasi_kb_lain').val());
        $('#hide_bak').val($('#bak').val());
        $('#hide_bab').val($('#bab').val());
        $('#hide_warna_eliminasi').val($('#warna_bak').val());
        $('#hide_karakteristik').val($('#karakteristik_bab').val());
        $('#hide_tidur_malam').val($('#tidur_malam').val());
        $('#hide_tidur_siang').val($('#tidur_siang').val());
        $('#hide_kepala').val($('[name=kepala]:checked').val() != undefined ? $('[name=kepala]:checked').val() : '');
        $('#hide_kepala_lain').val($('#kepala_lain').val());
        $('#hide_rambut').val($('[name=rambut]:checked').val() != undefined ? $('[name=rambut]:checked').val() : '');
        $('#hide_muka').val($('[name=muka]:checked').val() != undefined ? $('[name=muka]:checked').val() : '');
        $('#hide_mata').val($('[name=mata]:checked').val() != undefined ? $('[name=mata]:checked').val() : '');
        $('#hide_hidung').val($('[name=hidung]:checked').val() != undefined ? $('[name=hidung]:checked').val() : '');
        $('#hide_telinga').val($('[name=telinga]:checked').val() != undefined ? $('[name=telinga]:checked').val() : '');
        $('#hide_mulut').val($('[name=mulut]:checked').val() != undefined ? $('[name=mulut]:checked').val() : '');
        $('#hide_mulut_lain').val($('#mulut_lain').val());
        $('#hide_leher').val($('[name=leher]:checked').val() != undefined ? $('[name=leher]:checked').val() : '');
        $('#hide_dada').val($('[name=dada]:checked').val() != undefined ? $('[name=dada]:checked').val() : '');
        $('#hide_payudara').val($('[name=payudara]:checked').val() != undefined ? $('[name=payudara]:checked').val() :
            '');
        $('#hide_payudara_lain').val($('#payudara_lain').val());
        $('#hide_abdomen').val($('[name=abdomen]:checked').val() != undefined ? $('[name=abdomen]:checked').val() : '');
        $('#hide_abdomen_lain').val($('#abdomen_lain').val());
        $('#hide_inspeksi').val($('[name=inspeksi]:checked').val() != undefined ? $('[name=inspeksi]:checked').val() :
            '');
        $('#hide_inspeksi_lain').val($('#inspeksi_lain').val());

        let palpasi = [
            $('#leopold_satu').val(),
            $('#leopold_dua').val(),
            $('#leopold_tiga').val(),
            $('#leopold_empat').val(),
        ];

        $('#hide_palpasi').val(JSON.stringify(palpasi));
        $('#hide_obstetri').val($('[name=nyeri_obstetri]:checked').val() != undefined ? $(
                '[name=nyeri_obstetri]:checked').val() :
            '');
        $('#hide_tfu').val($('#tfu').val());
        $('#hide_tfj').val($('#tfj').val());
        $('#hide_his').val($('#his').val());
        $('#hide_teratur_his').val($('[name=teratur_his]:checked').val() != undefined ? $('[name=teratur_his]:checked')
            .val() : '');
        $('#hide_durasi').val($('#durasi').val());
        $('#hide_kriteria_durasi').val($('[name=kriteria_durasi]:checked').val() != undefined ? $(
            '[name=kriteria_durasi]:checked').val() : '');
        $('#hide_djj').val($('#djj').val());
        $('#hide_kriteria_djj').val($('[name=kriteria_djj]:checked').val() != undefined ? $(
            '[name=kriteria_djj]:checked').val() : '');
        $('#hide_inspeksi_genitalia').val($('[name=inspeksi_genitalia]:checked').val() != undefined ? $(
            '[name=inspeksi_genitalia]:checked').val() : '');
        $('#hide_banyaknya').val($('[name=pengeluaran]').val());
        $('#hide_konsistensi').val($('[name=konsistensi]:checked').val() != undefined ? $('[name=konsistensi]:checked')
            .val() : '');
        $('#hide_inspekulo').val($('[name=inspekulo]:checked').val() != undefined ? $('[name=inspekulo]:checked')
            .val() : '');
        $('#hide_inspekulo_lain').val($('#inspekulo_lain').val());
        $('#hide_uretra').val($('[name=uretra]:checked').val() != undefined ? $('[name=uretra]:checked').val() : '');
        $('#hide_vulva').val($('[name=vulva]:checked').val() != undefined ? $('[name=vulva]:checked').val() : '');
        $('#hide_vagina').val($('[name=vagina]:checked').val() != undefined ? $('[name=vagina]:checked').val() : '');
        $('#hide_portio').val($('[name=portio]:checked').val() != undefined ? $('[name=portio]:checked').val() : '');
        $('#hide_pembukaan').val($('#pembukaan').val());
        $('#hide_selaput').val($('[name=selaput]:checked').val() != undefined ? $('[name=selaput]:checked').val() : '');
        $('#hide_srld').val($('#srld').val());
        $('#hide_mekonium').val($('#mekonium').val());
        $('#hide_bg_terendah').val($('#bg_terendah').val());
        $('#hide_uuk').val($('#uuk').val());
        $('#hide_penurunan').val($('[name=penurunan]:checked').val() != undefined ? $('[name=penurunan]:checked')
            .val() : '');
        $('#hide_pecah_ketuban').val($('[name=jam_pecah_ketuban]').val());
        $('#hide_bishope').val($('[name=bishope_score]:checked').val() != undefined ? $('[name=bishope_score]:checked')
            .val() : '');

        let ekstremitas = [{
            'atas': $('[name=ekstremitas_atas]:checked').val() != undefined ? $(
                '[name=ekstremitas_atas]:checked').val() : '',
            'bawah': $('[name=ekstremitas_bawah]:checked').val() != undefined ? $(
                '[name=ekstremitas_bawah]:checked').val() : '',
        }]
        $('#hide_ekstremitas').val(JSON.stringify(ekstremitas));
        $('#hide_diagnosa_kebidanan').val($('#diagnosa_kebidanan').val());
        $('#hide_rencana').val($('#rencana').val());

        $('#hide_td').val($('#td').val());
        $('#hide_bb').val($('#bb').val());
        $('#hide_tb').val($('#tb').val());
        $('#hide_kesadaran').val($('#kesadaran').val());
        $('#hide_keadaan_umum').val($('#keadaan_umum').val());
        $('#hide_nadi').val($('#nadi').val());
        $('#hide_suhu').val($('#suhu').val());
        $('#hide_rr').val($('#rr').val());

        $('#hide_gcs_e').val($('#gcs_e').val());
        $('#hide_gcs_v').val($('#gcs_v').val());
        $('#hide_gcs_m').val($('#gcs_m').val());

        $('#hidden_form').submit();
    }
</script>

</html>
