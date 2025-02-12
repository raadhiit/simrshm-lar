<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Resume Medis Pasien Pulang</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>

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

        .table_isian td {
        }

        .table_isian_bordered td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian2 tr {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body style="margin: 20px;">
<div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('e_rekam_medis/rekam_medis/verifikasi_dokumen_kunjungan') }}">
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
<div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/rekam_medis/save_ttd_dokumen_kunjungan') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Nama Penerima Edukasi</h6>
                            <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                        </div>
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                        </div>
                    </div>
                    <br />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form onsubmit="return cek_form(this)" id="form_persetujuan"
      action="{{ url('e_rekam_medis/rekam_medis/save_resume_medis_pasien_pulang') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type="hidden" name="noreg" value="{{ $layanan->id }}">
    <input type="hidden" name="nrm" value="{{ $layanan->nrm }}">
    <input type="hidden" name="nama_pasien" value="{{ $layanan->nama_pasien }}">
    <input type="hidden" name="ruangan" value="{{ $layanan->last_nama_ruangan }}">
    <input type="hidden" name="id_ttv" value="{{ $tanda_vital ? $tanda_vital->id : '' }}">
    <input type="hidden" id="hide_indikasi_rawat_inap" name="indikasi_rawat_inap">
    <input type="hidden" id="hide_riwayat_kesehatan" name="riwayat_kesehatan">
    <input type="hidden" id="hide_pemeriksaan_fisik" name="pemeriksaan_fisik">
    <input type="hidden" id="hide_pemeriksaan_penunjang" name="pemeriksaan_penunjang">
    <input type="hidden" id="hide_ket_pemeriksaan_penunjang" name="ket_pemeriksaan_penunjang">
    <input type="hidden" id="hide_tgl_kontrol" name="tgl_kontrol">
    <input type="hidden" id="hide_tgl_keluar" name="tgl_keluar">
    <input type="hidden" id="hide_perawatan_dirumah" name="perawatan_dirumah">
    <input type="hidden" id="hide_rencana_pemeriksaan_penunjang" name="rencana_pemeriksaan_penunjang">
    <input type="hidden" id="hide_kebutuhan_edukasi" name="kebutuhan_edukasi">
    <input type="hidden" id="hide_ket_pertolongan_mendesak" name="ket_pertolongan_mendesak">
    <input type="hidden" id="hide_ket_kebutuhan_edukasi" name="ket_kebutuhan_edukasi">
    <input type="hidden" id="hide_keadaan_akhir" name="keadaan_akhir">
    <input type="hidden" id="hide_mobilisasi_pulang" name="mobilisasi_pulang">
    <input type="hidden" id="hide_alat_bantu" name="alat_bantu">
    <input type="hidden" id="hide_alkes" name="alkes">
    <input type="hidden" id="hide_dit" name="dit">
    <input type="hidden" id="hide_disertakan_waktu_pulang" name="disertakan_waktu_pulang">
    <input type="hidden" id="hide_ket_disertakan_waktu_pulang" name="ket_disertakan_waktu_pulang">
    <input type="hidden" id="hide_penyakit_berhubungan" name="penyakit_berhubungan">
    <input type="hidden" id="hide_icd_tindakan" name="icd_tindakan">
    <input type="hidden" id="hide_keadaan_umum" name="keadaan_umum">
    <input type="hidden" id="hide_kesadaran" name="kesadaran">
    <input type="hidden" id="hide_tensi" name="tensi">
    <input type="hidden" id="hide_nadi" name="nadi">
    <input type="hidden" id="hide_suhu" name="suhu">
    <input type="hidden" id="hide_rr" name="rr">
</form>
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
                <td>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
            </tr>
        </table>
    </div>
</div>
<div style="margin-top: -17px;">
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
            <h6 style="color: white">RESUME MEDIS PASIEN PULANG</h6>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%;" class="table_isian_bordered">
            <tr>
                <td style="width: 50%">
                    <u>No. Rekam Medis</u> : <span>{{ $layanan->nrm }}</span>
                    <br>
                    Medical Record Number
                </td>
                <td style="width: 50%">
                    <u>Tanggal Masuk RS</u> : <span>{{ date('d-m-Y', strtotime($layanan->tanggal_inap)) }}</span>
                    <br>
                    Admitted
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <u>Nama Pasien</u> : <span>{{ $layanan->nama }}</span>
                    <br>
                    Patient Name
                </td>
                <td style="width: 50%">
                    <u>Tanggal Keluar RS</u> : <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_keluar"
                    value="@if(old('tgl_keluar')){{ old('tgl_keluar') }}@else{{ $dokumen->resume_medis_pasien_pulang ? date('d-m-Y', strtotime($dokumen->resume_medis_pasien_pulang->tgl_keluar)) : '' }}@endif">
                    <br>
                    Date of discharge
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <u>Nama Orang Tua / Suami / Istri</u> : <span>{{ $layanan->namapenanggungjawab }}</span>
                    <br>
                    Family Name
                </td>
                <td style="width: 50%">
                    <u>Jenis Kelamin</u> : <span>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</span>
                    <br>
                    Sex
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <u>Tanggal Lahir</u> : <span>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</span>
                    <br>
                    Date of Birthday
                </td>
                <td style="width: 50%">
                    <u>Kelas / Kamar</u> : <span>{{ $layanan->last_kelas }} / {{ $layanan->last_nama_ruangan }}</span>
                    <br>
                    Class / Room
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Indikasi Rawat Inap : 
                    <br>
                    <textarea id="indikasi_rawat_inap" class="form-control"
                              rows="5">@if(old('indikasi_rawat_inap')){{ old('indikasi_rawat_inap') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->indikasi_rawat_inap : '' }}@endif</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Riwayat Kesehatan (Medical History): 
                    <br>
                    <textarea id="riwayat_kesehatan" class="form-control"
                              rows="5">@if(old('riwayat_kesehatan')){{ old('riwayat_kesehatan') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->riwayat_kesehatan : '' }}@endif</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Pemeriksaan Fisik (Physical Examination): 
                    <br>
                    <textarea id="pemeriksaan_fisik" class="form-control"
                              rows="5">@if(old('pemeriksaan_fisik')){{ old('pemeriksaan_fisik') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->pemeriksaan_fisik : '' }}@endif</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Pemeriksaan Penunjang Diagnosis (Significant Ancillary Examination Result) :
                    <br>
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('pemeriksaan_penunjang_ct_scan',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang)) ? 'checked' : '' }}
                            @endif id="pemeriksaan_penunjang_ct_scan"> CT Scan
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('pemeriksaan_penunjang_usg',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                            @endif id="pemeriksaan_penunjang_usg"> USG
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('pemeriksaan_penunjang_ekg',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                            @endif id="pemeriksaan_penunjang_ekg"> EKG
                    <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('pemeriksaan_penunjang_echocardiography',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                            @endif id="pemeriksaan_penunjang_echocardiography"> Echocardiography
                    <input onclick="cek_pemeriksaan_penunjang()" type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                        {{ in_array('pemeriksaan_penunjang_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? 'checked' : '' }}
                        @endif id="pemeriksaan_penunjang_lain_lain" class="ml-4"> Lain - lain
                    <input type="text" readonly
                        value="@if(old('ket_pemeriksaan_penunjang')){{ old('ket_pemeriksaan_penunjang') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_pemeriksaan_penunjang : '' }}@endif"
                        id="ket_pemeriksaan_penunjang" style="border: 0; border-bottom: 2px dotted;"
                        @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('pemeriksaan_penunjang_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->pemeriksaan_penunjang )) ? '' : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-8" style="border-right: 1px solid">
                            Diagnosis primer (Primary Diagnose):
                            <div style="display: flex; flex-direction: row">
                                {{-- <div id="box_btn_asesmen">
                                    @if ($layanan->diagnosa == null)
                                        <button class="btn btn-success" onclick="open_form_tambah_diagnosa()"><i
                                                class="fa fa-plus"></i></button>
                                    @else
                                        <button class="btn btn-warning" onclick="open_form_tambah_diagnosa()"
                                                style="color:#fff; font-weight: bold;"><i
                                                class="fa fa-pencil"></i></button>
                                    @endif
                                </div> --}}
                                <div id="box_diagnosa" class="ml-2">
                                    {{ $layanan->diagnosa ? $layanan->diagnosa->nama_icd : '' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            Kode ICD X :
                            <br>
                            <div id="box_diagnosa" class="ml-2">
                                {{ $layanan->diagnosa ? $layanan->diagnosa->kode_icd : '' }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-8" style="border-right: 1px solid">
                            Diagnosis sekunder & Diagnosis Penyerta (Secondary Diagnose & Comorbide Diagnose):
                            <br>
                            <div id="box_diagnosa" class="ml-2">
                                {{ $layanan->diagnosa ? $layanan->diagnosa->diagnosa_sekunder1 : '' }}
                                {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder2 : '' !!}
                                {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder3 : '' !!}
                                {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder4 : '' !!}
                                {!! $layanan->diagnosa ? '<br>'.$layanan->diagnosa->diagnosa_sekunder5 : '' !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            Kode ICD X :
                            <br>
                            <div id="box_diagnosa" class="ml-2">
                                {{ isset($kode_sekunder1) ? $kode_sekunder1->icd : '' }}
                                {!! isset($kode_sekunder2) ? '<br>'.$kode_sekunder2->icd : '' !!}
                                {!! isset($kode_sekunder3) ? '<br>'.$kode_sekunder3->icd : '' !!}
                                {!! isset($kode_sekunder4) ? '<br>'.$kode_sekunder4->icd : '' !!}
                                {!! isset($kode_sekunder5) ? '<br>'.$kode_sekunder5->icd : '' !!}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-8" style="border-right: 1px solid">
                            Tindakan/Prosedur Bedah (Medical/Surgical Procedures)
                            <br>
                            <div>
                                @if (isset($tindakan))
                                    @foreach ($tindakan as $key => $td)
                                        {{ ($key+1).". ".$td->nama_tindakan }}
                                        <br>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div>
                            {{-- A. Tindakan Dokter
                            <div>
                                @if ($tindakan_dokter)
                                    @foreach ($tindakan_dokter as $key => $td)
                                        {{ ($key+1)." ".$td->nama_tagihan }}
                                        <br>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div>
                            B. Tindakan Perawat
                            <div>
                                @if ($tindakan_perawat)
                                    @foreach($tindakan_perawat as $key2 => $tp)
                                        {{ ($key2+1)." ".$tp->nama_tagihan }}
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div>
                            C. Oksigen Manual
                            <div>
                                @if ($oksigen_manual)
                                    @foreach ($oksigen_manual as $key3 => $om)
                                        {{ ($key3+1)." ".$om->nama_tagihan." ".$om->keterangan }}
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div>
                            D. Oksigen Central
                            <div>
                                @if ($oksigen_central)
                                    @foreach ($oksigen_central as $key4 => $oc)
                                        {{ ($key4+1)." ".$oc->nama_tagihan." ".$oc->keterangan }}
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div> --}}
                        </div>
                        <div class="col-md-4">
                            Kode ICD X :
                            <textarea id="icd_tindakan" class="form-control"
                              rows="5">@if(old('icd_tindakan')){{ old('icd_tindakan') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->icd_tindakan : '' }}@endif</textarea>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Terapi / Pengobatan (Terapy / Treatment) :
                    Selama Dirawat (Durante Treatment) :
                    <br>
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
                                            <td style="width:20px;">{{ 'R/' }}</td>
                                            <td>{{ $ar_det->nama_obat }}</td>
                                            <td>{{ $ar_det->signa . ' x 1' }}</td>
                                            <td style="padding-left: 20px;">
                                                {{ $ar_det->jumlah . ' ' . $ar_det->satuan_pakai }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Setelah Dirawat (Post Treatment) :
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Instruksi / Tindak Lanjut (Instruction/Follow Up/Medical Advice) : Rencana Kontrol Tgl :</b>
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kontrol"
                                value="@if(old('tgl_kontrol')){{ old('tgl_kontrol') }}@else{{ $dokumen->resume_medis_pasien_pulang ? date('d-m-Y', strtotime($dokumen->resume_medis_pasien_pulang->tgl_kontrol)) : '' }}@endif">
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 150px">Perawatan Dirumah :</span>
                        <div class="col-md-2">
                            <input @if(old('perawatan_dirumah'))
                                {{ old('perawatan_dirumah') ==  'tidak_ada' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'tidak_ada' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="tidak_ada" name="radio_perawatan_dirumah"> Tidak Ada
                        </div>
                        <div class="col-md-2">
                            <input @if(old('perawatan_dirumah'))
                                {{ old('perawatan_dirumah') ==  'home_visite' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'home_visite' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="home_visite" name="radio_perawatan_dirumah"> Home Visite/Care
                        </div>
                        <div class="col-md-2">
                            <input @if(old('perawatan_dirumah'))
                                {{ old('perawatan_dirumah') ==  'perawatan_lanjutan' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'perawatan_lanjutan' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="perawatan_lanjutan" name="radio_perawatan_dirumah"> Perawatan Lanjutan
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 150px"></span>
                        <div class="col-md-2">
                            <input @if(old('perawatan_dirumah'))
                                {{ old('perawatan_dirumah') ==  'perawatan_luka' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'perawatan_luka' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="perawatan_luka" name="radio_perawatan_dirumah"> Perawatan Luka
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-2">
                            <input @if(old('perawatan_dirumah'))
                                {{ old('perawatan_dirumah') ==  'pengobatan_lanjutan' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->perawatan_dirumah == 'pengobatan_lanjutan' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="pengobatan_lanjutan" name="radio_perawatan_dirumah"> Pengobatan Lanjutan
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Rencana pemeriksaan penunjang : 
                            <input @if(old('rencana_pemeriksaan_penunjang'))
                                {{ old('rencana_pemeriksaan_penunjang') ==  'laboratorium' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->rencana_pemeriksaan_penunjang == 'laboratorium' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="laboratorium" name="radio_rencana_pemeriksaan_penunjang"> Laboratorium
                            <input @if(old('rencana_pemeriksaan_penunjang'))
                                {{ old('rencana_pemeriksaan_penunjang') ==  'radiologi' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->rencana_pemeriksaan_penunjang == 'radiologi' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="radiologi" name="radio_rencana_pemeriksaan_penunjang" class="ml-4"> Radiologi
                            <input @if(old('rencana_pemeriksaan_penunjang'))
                                {{ old('rencana_pemeriksaan_penunjang') ==  'lain_lain' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->rencana_pemeriksaan_penunjang == 'lain_lain' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="lain_lain" name="radio_rencana_pemeriksaan_penunjang" class="ml-4"> Lain-lain
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 150px">Kebutuhan Edukasi :</span>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('penyakit',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="penyakit"> Penyakit
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('efek_obat',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="efek_obat"> Obat dan efek samping obat
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('diet',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="diet"> Diet
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('istirahat_dirumah',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="istirahat_dirumah"> Aktifitas dan istirahat dirumah
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 150px"></span>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('hygine',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif id="hygine"> Hygine
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('perawatan_luka',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="perawatan_luka"> Perawatan luka dirumah
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('perawatan_ibu_bayi',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="perawatan_ibu_bayi"> Perawatan ibu dan bayi
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('nyeri',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="nyeri"> Nyeri
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 150px"></span>
                        <div class="col-md-10">
                            <input onclick="cek_pertolongan_mendesak()" type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('pertolongan_mendesak',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif id="pertolongan_mendesak"> Pertolongan mendesak
                            <input type="text" readonly
                            value="@if(old('ket_pertolongan_mendesak')){{ old('ket_pertolongan_mendesak') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_pertolongan_mendesak : '' }}@endif"
                            id="ket_pertolongan_mendesak" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('pertolongan_mendesak',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? '' : 'readonly' }}
                            @endif>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 150px"></span>
                        <div class="col-md-10">
                            <input onclick="cek_kebutuhan_edukasi()"  type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('kebutuhan_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? 'checked' : '' }}
                            @endif  id="kebutuhan_lain_lain"> Lain-lain
                            <input type="text" readonly
                            value="@if(old('ket_kebutuhan_edukasi')){{ old('ket_kebutuhan_edukasi') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_kebutuhan_edukasi : '' }}@endif"
                            id="ket_kebutuhan_edukasi" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('kebutuhan_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->kebutuhan_edukasi )) ? '' : 'readonly' }}
                            @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Keadaan akhir Perawatan (Discharge Condition) :
                    <div class="row">
                        <div class="col-md-4">
                            <input @if(old('keadaan_akhir'))
                                {{ old('keadaan_akhir') ==  'pulang_dengan_indikasi' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'pulang_dengan_indikasi' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="pulang_dengan_indikasi" name="radio_keadaan_akhir"> <u>Pulang atas Indikasi Medis</u>
                            <br><span style="padding-left: 18px">Accord on Medical Indication</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keadaan_akhir'))
                                {{ old('keadaan_akhir') ==  'pulang_sendiri' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'pulang_sendiri' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="pulang_sendiri" name="radio_keadaan_akhir"> <u>Pulang atas Permintaan Sendiri</u>
                            <br><span style="padding-left: 18px">Accord on Patient Request</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keadaan_akhir'))
                                {{ old('keadaan_akhir') ==  'kondisi_khusus' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'kondisi_khusus' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="kondisi_khusus" name="radio_keadaan_akhir"> <u>Pulang kondisi khusus</u>
                            <br><span style="padding-left: 18px">Accord on Special Condition</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input @if(old('keadaan_akhir'))
                                {{ old('keadaan_akhir') ==  'rujuk' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'rujuk' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="rujuk" name="radio_keadaan_akhir"> <u>Pindah / Rujuk ke RS lain</u>
                            <br><span style="padding-left: 18px">Reffered to Another Hospital</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keadaan_akhir'))
                                {{ old('keadaan_akhir') ==  'meninggal' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'meninggal' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="meninggal" name="radio_keadaan_akhir"> <u>Meninggal</u>
                            <br><span style="padding-left: 18px">Death</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keadaan_akhir'))
                                {{ old('keadaan_akhir') ==  'lain_lain' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->keadaan_akhir == 'lain_lain' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="lain_lain" name="radio_keadaan_akhir"> <u>Lain-lain</u>
                            <br><span style="padding-left: 18px">Other</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 155px">Keadaan saat pulang : </span>
                        <div class="col-md-2">
                            KU <input type="text"
                            value="@if(old('keadaan_umum')){{ old('keadaan_umum') }}@else{{ $tanda_vital ? $tanda_vital->keadaan_umum : '' }}@endif"
                            id="keadaan_umum" style="border: 0; border-bottom: 2px dotted; width: 100px">
                        </div>
                        <div class="col-md-5">
                            Kesadaran 
                            <input type="radio" name="kesadaran"
                                {{ $layanan->tanda_vital ? ($layanan->tanda_vital->kesadaran == 'komposmentis' ? 'checked' : '') : '' }}
                                value="komposmentis"> Komposmentis
                            <input type="radio" name="kesadaran"
                                {{ $layanan->tanda_vital ? ($layanan->tanda_vital->kesadaran == 'somnolen' ? 'checked' : '') : '' }} 
                                value="somnolen"> Somnolen
                            <input type="radio" name="kesadaran"
                                {{ $layanan->tanda_vital ? ($layanan->tanda_vital->kesadaran == 'Sopor' ? 'checked' : '') : '' }} 
                                value="Sopor"> Sopor
                            <input type="radio" name="kesadaran"
                                {{ $layanan->tanda_vital ? ($layanan->tanda_vital->kesadaran == 'Coma' ? 'checked' : '') : '' }} 
                                value="Coma"> Coma
                        </div>
                        <div class="col-md-2">
                            TD <input type="text"
                            value="@if(old('tensi')){{ old('tensi') }}@else{{ $tanda_vital ? $tanda_vital->tensi : '' }}@endif"
                            id="tensi" style="border: 0; border-bottom: 2px dotted; width: 70px"> mmHg
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 155px"></span>
                        <div class="col-md-2">
                            Nadi <input type="number"
                            value="@if(old('nadi')){{ old('nadi') }}@else{{ $tanda_vital ? $tanda_vital->nadi : '' }}@endif"
                            id="nadi" style="border: 0; border-bottom: 2px dotted; width: 70px"> x/menit
                        </div>
                        <div class="col-md-2">
                            Suhu <input type="number"
                            value="@if(old('suhu')){{ old('suhu') }}@else{{ $tanda_vital ? $tanda_vital->suhu : '' }}@endif"
                            id="suhu" style="border: 0; border-bottom: 2px dotted; width: 100px"> ᵒC
                        </div>
                        <div class="col-md-4">
                            Pernafasan <input type="number"
                            value="@if(old('rr')){{ old('rr') }}@else{{ $tanda_vital ? $tanda_vital->rr : '' }}@endif"
                            id="rr" style="border: 0; border-bottom: 2px dotted; width: 100px"> x/menit
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 165px">Mobilisasi saat pulang : </span>
                        <div class="col-md-2">
                            <input @if(old('mobilisasi_pulang'))
                                {{ old('mobilisasi_pulang') ==  'mandiri' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->mobilisasi_pulang == 'mandiri' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="mandiri" name="radio_mobilisasi_pulang"> Mandiri
                        </div>
                        <div class="col-md-2">
                            <input @if(old('mobilisasi_pulang'))
                                {{ old('mobilisasi_pulang') ==  'dibantu_sebagian' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->mobilisasi_pulang == 'dibantu_sebagian' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="dibantu_sebagian" name="radio_mobilisasi_pulang"> Dibantu Sebagian
                        </div>
                        <div class="col-md-2">
                            <input @if(old('mobilisasi_pulang'))
                                {{ old('mobilisasi_pulang') ==  'dibantu_penuh' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->mobilisasi_pulang == 'dibantu_penuh' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="dibantu_penuh" name="radio_mobilisasi_pulang"> Dibantu Penuh
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 165px">Alat bantu : </span>
                        <div class="col-md-2">
                            <input @if(old('alat_bantu'))
                                {{ old('alat_bantu') ==  'tongkat' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'tongkat' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="tongkat" name="radio_alat_bantu"> Tongkat
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alat_bantu'))
                                {{ old('alat_bantu') ==  'kursi_roda' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'kursi_roda' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="kursi_roda" name="radio_alat_bantu"> Kursi roda
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alat_bantu'))
                                {{ old('alat_bantu') ==  'brandcard' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'brandcard' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="brandcard" name="radio_alat_bantu"> Brandcard
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alat_bantu'))
                                {{ old('alat_bantu') ==  'walker' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'walker' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="walker" name="radio_alat_bantu"> Walker
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alat_bantu'))
                                {{ old('alat_bantu') ==  'lain_lain' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alat_bantu == 'lain_lain' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="lain_lain" name="radio_alat_bantu"> Lain-lain
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 165px">Alkes yang terpasang : </span>
                        <div class="col-md-2">
                            <input @if(old('alkes'))
                                {{ old('alkes') ==  'tidak_ada' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'tidak_ada' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="tidak_ada" name="radio_alkes"> Tidak ada
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alkes'))
                                {{ old('alkes') ==  'catheter' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'catheter' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="catheter" name="radio_alkes"> IV Catheter
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alkes'))
                                {{ old('alkes') ==  'dobel_lumen' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'dobel_lumen' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="dobel_lumen" name="radio_alkes"> Dobel Lumen
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alkes'))
                                {{ old('alkes') ==  'ngt' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'ngt' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="ngt" name="radio_alkes"> NGT
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 165px"></span>
                        <div class="col-md-2">
                            <input @if(old('alat_bantu'))
                                {{ old('alkes') ==  'oksigen' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'oksigen' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="oksigen" name="radio_alkes"> Oksigen
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alkes'))
                                {{ old('alkes') ==  'catheter_urine' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'catheter_urine' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="catheter_urine" name="radio_alkes"> Catheter urine
                        </div>
                        <div class="col-md-2">
                            <input @if(old('alkes'))
                                {{ old('alkes') ==  'lain_lain' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->alkes == 'lain_lain' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="lain_lain" name="radio_alkes"> Lain-lain
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Dit : <input type="text" value="@if(old('dit')){{ old('dit') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->dit : '' }}@endif"
                            id="dit" style="border: 0; border-bottom: 2px dotted; width: 97%">
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 190px">Disertakan waktu pulang : </span>
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('foto_rongent',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                            @endif id="foto_rongent"> Foto Rongent
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('ct_scan',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                            @endif id="ct_scan" class="ml-4"> CT Scan
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('ekg',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                            @endif id="ekg" class="ml-4"> EKG
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('hasil_lab',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                            @endif id="hasil_lab" class="ml-4"> Hasil Lab
                    </div>
                    <div class="row" style="padding-left: 15px">
                        <span style="width: 190px"></span>
                        <input type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('obat_tidak_terpakai',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                            @endif id="obat_tidak_terpakai"> Obat yang tidak terpakai
                        <input onclick="cek_disertakan_waktu_pulang()" type="checkbox" @if(isset($dokumen->resume_medis_pasien_pulang))
                            {{ in_array('disertakan_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? 'checked' : '' }}
                            @endif id="disertakan_lain_lain" class="ml-4"> Lain - lain
                        <input type="text" readonly
                            value="@if(old('ket_disertakan_waktu_pulang')){{ old('ket_disertakan_waktu_pulang') }}@else{{ $dokumen->resume_medis_pasien_pulang ? $dokumen->resume_medis_pasien_pulang->ket_disertakan_waktu_pulang : '' }}@endif"
                            id="ket_disertakan_waktu_pulang" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->resume_medis_pasien_pulang))
                                {{ in_array('disertakan_lain_lain',json_decode($dokumen->resume_medis_pasien_pulang->disertakan_waktu_pulang )) ? '' : 'readonly' }}
                            @endif>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Penyakit Berhubungan Dengan (Related Diseases) : 
                    <div class="row">
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'kelainan_bawaan' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kelainan_bawaan' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="kelainan_bawaan" name="radio_penyakit_berhubungan"> <u>Kelainan Bawaan/kongenital</u>
                            <br><span style="padding-left: 18px">Kongenital Disorders</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'kesuburan' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kesuburan' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="kesuburan" name="radio_penyakit_berhubungan"> <u>Kesuburan</u>
                            <br><span style="padding-left: 18px">Fertility</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'gangguan_hormonal' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'gangguan_hormonal' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="gangguan_hormonal" name="radio_penyakit_berhubungan"> <u>Gangguan Hormonal</u>
                            <br><span style="padding-left: 18px">Hormonal Disorders</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'gangguan_mental' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'gangguan_mental' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="gangguan_mental" name="radio_penyakit_berhubungan"> <u>Gangguan Mental</u>
                            <br><span style="padding-left: 18px">Mental Disorders</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'kecelakaan_kerja' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kecelakaan_kerja' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="kecelakaan_kerja" name="radio_penyakit_berhubungan"> <u>Kecelakaan Kerja</u>
                            <br><span style="padding-left: 18px">Accident</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'kosmetik' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kosmetik' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="kosmetik" name="radio_penyakit_berhubungan"> <u>Kosmetik / Estetika</u>
                            <br><span style="padding-left: 18px">Cosmetics / Estetics</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'kehamilan' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'kehamilan' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="kehamilan" name="radio_penyakit_berhubungan"> <u>Kehamilan / Keguguran</u>
                            <br><span style="padding-left: 18px">Pregnancy / Abortion</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('penyakit_berhubungan'))
                                {{ old('penyakit_berhubungan') ==  'hpht' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->resume_medis_pasien_pulang ? ($dokumen->resume_medis_pasien_pulang->penyakit_berhubungan == 'hpht' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="hpht" name="radio_penyakit_berhubungan"> <u>HPHT :</u>
                            <br><span style="padding-left: 18px">Estimated Day of Birth</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            Bekasi, {{ date('Y-m-d', strtotime($dokumen->created_at)) }}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            @if(is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br><u>Tanda Tangan & Nama Jelas Pasien</u>
                                <br>Attending Patient Name And Signature
                            @else
                                @if(!is_null($dokumen->signature_pasien) || $dokumen->signature_pasien != "")
                                    <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                @endif
                                <br>({{$dokumen->nama_pasien}})
                            @endif
                        </div>
                        <div class="col-md-6 text-center">
                            @if($dokumen->id_verifikator == 0)
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br><u>Tanda Tangan & Nama Jelas Dokter</u>
                                <br>Attending Doctors Name And Signature
                            @else
                                @if(isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                @endif
                                <br>({{$dokumen->nama_verifikator}})
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row pt-5" style="width:100%; margin-left:0">
    <div class="col-md-1"></div>
    <div class="col-md-4" onclick="open_modal_pasien()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Pasien / Keluarga</h5>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-4" onclick="open_modal_petugas()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Perawat / Bidan</h5>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <button onclick="submit_form()" class="btn btn-success">Simpan</button>
    </div>
</div>
<div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/rekam_medis/pdf_resume_medis_pasien_pulang?dokumen='.$dokumen->id) }}"
               class="btn btn-success" target="_blank">Download PDF</a>
        @endif
    </div>
</div>

{{--Diagnosa--}}
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
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="_method" value="POST"/>
                <input type="hidden" name="kode_icd_tindakan" id="kode_icd_tindakan"/>
                <input type="hidden" name="noreg" value="{{ $layanan->id }}"/>
                <input type="hidden" name="dokumen" value="{{ $dokumen->id }}"/>
                <input type="hidden" name="id_dokter" value="{{ Auth::user()->id }}" id="id_dokter"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" readonly class="form-control"
                               value="{{ date('Y-m-d', strtotime($dokumen->created_at)) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Asal Ruangan</label>
                        <input type="text" name="ruangan" id="ruangan" value="{{ $layanan->last_ruangan }}"
                               readonly class="form-control">
                    </div>
                    <hr>
                    <p style="font-weight: bold; font-size:14px;">DATA DOKTER / PSIKOLOG</p>
                    <div class="form-group">
                        <label for="">Dokter / Psikolog</label>
                        <input type="text" name="dokter" value="{{ Auth::user()->realname }}" id="dokter"
                               readonly class="form-control">
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
                            <input type="text" class="form-control" name="diagnosa_pembanding" id="diagnosa_pembanding">
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
{{--End Of Diagnosa--}}

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
{{--diagnosa--}}
<script>
    $(document).ready(function () {
        $("#e_resep_nama_obat").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_obat') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            params: {
                'depo': function () {
                    return $('#e_resep_depo_tujuan').val();
                }
            },
            onSelect: function (suggestion) {
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
                'depo': function () {
                    return $('#edit_resep_depo_tujuan').val();
                }
            },
            onSelect: function (suggestion) {
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
            success: function (response) {
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
            onSelect: function (suggestion) {
                $("#diagnosa_primer").val(suggestion.nama);
            }
        });

        $("#diagnosa_pembanding").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_pembanding").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_satu").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_satu").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_dua").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_dua").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_tiga").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_tiga").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_empat").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
                $("#diagnosa_sekunder_empat").val(suggestion.nama);
            }
        });

        $("#diagnosa_sekunder_lima").autocomplete({
            serviceUrl: "{{ url('ajax_request/autocomplete_diagnosa') }}", // Kode php untuk prosesing data
            dataType: "JSON", // Tipe data JSON
            onSelect: function (suggestion) {
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
            success: function (response) {
                console.log(response);
                if (!response.status) {
                    alert(response.message);
                    $('#box_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                } else {
                    $('#box_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                    let data = response.data;
                    var temp = '';
                    $('#box_diagnosa').html(data.diagnosa);
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
                    $('#box_diagnosa').html(data.kode_icd + ' - ' + data.nama_icd);
                    $('#box_diagnosa_pembanding').html(data.kode_icd_diagnosa_pembanding + ' - ' + data.nama_diagnosa_pembanding);
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
{{--end of diagnosa--}}

<script>
    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }
    
    $(document).ready(function() {
        var verif = '{{$dokumen->id_verifikator}}';
        if (verif != 0) {
            window.scrollTo({
                left: 0,
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        }
    })

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature64").val('');
        $("#nama_pasien").val('');
    });

    function konfirmasi_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
            return false;
        }
    }

    function cek_pemeriksaan_penunjang() {
        if ($("#pemeriksaan_penunjang_lain_lain").prop('checked') == true){
            $('#ket_pemeriksaan_penunjang').removeAttr('readonly');
        } else {
            $('#ket_pemeriksaan_penunjang').attr('readonly', true);
            $('#ket_pemeriksaan_penunjang').val('');
        }
    }

    function cek_pertolongan_mendesak() {
        if ($("#pertolongan_mendesak").prop('checked') == true){
            $('#ket_pertolongan_mendesak').removeAttr('readonly');
        } else {
            $('#ket_pertolongan_mendesak').attr('readonly', true);
            $('#ket_pertolongan_mendesak').val('');
        }
    }

    function cek_kebutuhan_edukasi() {
        if ($("#kebutuhan_lain_lain").prop('checked') == true){
            $('#ket_kebutuhan_edukasi').removeAttr('readonly');
        } else {
            $('#ket_kebutuhan_edukasi').attr('readonly', true);
            $('#ket_kebutuhan_edukasi').val('');
        }
    }

    function cek_disertakan_waktu_pulang() {
        if ($("#disertakan_lain_lain").prop('checked') == true){
            $('#ket_disertakan_waktu_pulang').removeAttr('readonly');
        } else {
            $('#ket_disertakan_waktu_pulang').attr('readonly', true);
            $('#ket_disertakan_waktu_pulang').val('');
        }
        // if ($('[name="radio_disertakan_waktu_pulang"]:checked').val() == 'lain_lain') {
        //     $('#ket_disertakan_waktu_pulang').removeAttr('disabled');
        // } else {
        //     $('#ket_disertakan_waktu_pulang').attr('disabled', true);
        //     $('#ket_disertakan_waktu_pulang').val('');
        // }
    }

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        var kebutuhan_edukasi = [];
        if ($('#penyakit').is(":checked")) {
            kebutuhan_edukasi.push('penyakit')
        }
        if ($('#efek_obat').is(":checked")) {
            kebutuhan_edukasi.push('efek_obat')
        }
        if ($('#diet').is(":checked")) {
            kebutuhan_edukasi.push('diet')
        }
        if ($('#istirahat_dirumah').is(":checked")) {
            kebutuhan_edukasi.push('istirahat_dirumah')
        }
        if ($('#hygine').is(":checked")) {
            kebutuhan_edukasi.push('hygine')
        }
        if ($('#perawatan_luka').is(":checked")) {
            kebutuhan_edukasi.push('perawatan_luka')
        }
        if ($('#perawatan_ibu_bayi').is(":checked")) {
            kebutuhan_edukasi.push('perawatan_ibu_bayi')
        }
        if ($('#nyeri').is(":checked")) {
            kebutuhan_edukasi.push('nyeri')
        }
        if ($('#pertolongan_mendesak').is(":checked")) {
            kebutuhan_edukasi.push('pertolongan_mendesak')
        }
        if ($('#kebutuhan_lain_lain').is(":checked")) {
            kebutuhan_edukasi.push('kebutuhan_lain_lain')
        }

        var disertakan_waktu_pulang = [];
        if ($('#foto_rongent').is(":checked")){
            disertakan_waktu_pulang.push('foto_rongent');
        }
        if ($('#ct_scan').is(":checked")){
            disertakan_waktu_pulang.push('ct_scan');
        }
        if ($('#ekg').is(":checked")){
            disertakan_waktu_pulang.push('ekg');
        }
        if ($('#hasil_lab').is(":checked")){
            disertakan_waktu_pulang.push('hasil_lab');
        }
        if ($('#obat_tidak_terpakai').is(":checked")){
            disertakan_waktu_pulang.push('obat_tidak_terpakai');
        }
        if ($('#disertakan_lain_lain').is(":checked")){
            disertakan_waktu_pulang.push('disertakan_lain_lain');
        }

        var pemeriksaan_penunjang = [];
        if ($('#pemeriksaan_penunjang_ct_scan').is(":checked")) {
            pemeriksaan_penunjang.push('pemeriksaan_penunjang_ct_scan');
        }
        if ($('#pemeriksaan_penunjang_usg').is(":checked")) {
            pemeriksaan_penunjang.push('pemeriksaan_penunjang_usg');
        }
        if ($('#pemeriksaan_penunjang_ekg').is(":checked")) {
            pemeriksaan_penunjang.push('pemeriksaan_penunjang_ekg');
        }
        if ($('#pemeriksaan_penunjang_echocardiography').is(":checked")) {
            pemeriksaan_penunjang.push('pemeriksaan_penunjang_echocardiography');
        }
        if ($('#pemeriksaan_penunjang_lain_lain').is(":checked")) {
            pemeriksaan_penunjang.push('pemeriksaan_penunjang_lain_lain');
        }

        $('#hide_id_ppa').val($("#id_ppa").val());
        $('#hide_indikasi_rawat_inap').val($("#indikasi_rawat_inap").val());
        $('#hide_riwayat_kesehatan').val($("#riwayat_kesehatan").val());
        $('#hide_pemeriksaan_fisik').val($("#pemeriksaan_fisik").val());
        $('#hide_pemeriksaan_penunjang').val(JSON.stringify(pemeriksaan_penunjang));
        $('#hide_ket_pemeriksaan_penunjang').val($("#ket_pemeriksaan_penunjang").val());
        $('#hide_tgl_keluar').val($("#tgl_keluar").val());
        $('#hide_tgl_kontrol').val($("#tgl_kontrol").val());
        $('#hide_perawatan_dirumah').val($('[name="radio_perawatan_dirumah"]:checked').val());
        $('#hide_rencana_pemeriksaan_penunjang').val($('[name="radio_rencana_pemeriksaan_penunjang"]:checked').val());
        $('#hide_kebutuhan_edukasi').val(JSON.stringify(kebutuhan_edukasi));
        $('#hide_ket_pertolongan_mendesak').val($("#ket_pertolongan_mendesak").val());
        $('#hide_ket_kebutuhan_edukasi').val($("#ket_kebutuhan_edukasi").val());
        $('#hide_keadaan_akhir').val($('[name="radio_keadaan_akhir"]:checked').val());
        $('#hide_mobilisasi_pulang').val($('[name="radio_mobilisasi_pulang"]:checked').val());
        $('#hide_alat_bantu').val($('[name="radio_alat_bantu"]:checked').val());
        $('#hide_alkes').val($('[name="radio_alkes"]:checked').val());
        $('#hide_dit').val($("#dit").val());
        // $('#hide_disertakan_waktu_pulang').val($('[name="radio_disertakan_waktu_pulang"]:checked').val());
        $('#hide_disertakan_waktu_pulang').val(JSON.stringify(disertakan_waktu_pulang));
        $('#hide_ket_disertakan_waktu_pulang').val($("#ket_disertakan_waktu_pulang").val());
        $('#hide_penyakit_berhubungan').val($('[name="radio_penyakit_berhubungan"]:checked').val());
        $('#hide_icd_tindakan').val($("#icd_tindakan").val());
        $('#hide_keadaan_umum').val($('#keadaan_umum').val());
        $('#hide_kesadaran').val($('[name="kesadaran"]:checked').val());
        $('#hide_tensi').val($('#tensi').val());
        $('#hide_nadi').val($('#nadi').val());
        $('#hide_suhu').val($('#suhu').val());
        $('#hide_rr').val($('#rr').val());

        return true;
    }

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }
</script>

</html>
