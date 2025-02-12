<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Serah Terima Bayi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .pagebreak {
            page-break-after: always;
        }

        @media print {
            body {
                width: 100%;
                font-size: 10pt;
                padding: 0px;
            }

            .inputan {
                border: none !important;
                border-bottom: 1px solid transparent !important;
            }

            #tabel_pemantauan {
                font-size: 10px !important;
            }

            #logo_rshm {
                width: 20% !important;
            }

            @page {
                size: legal;
                margin: 0;
            }

            #gambar_partograf {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }

            #canvas {
                position: absolute;
                top: 265px !important;
                left: 170px !important;
                width: 898px !important;
                height: 1288px !important;
                border: 1px solid;
            }

            .hidden_print {
                display: none;
            }
        }

        #logo_rshm {
            width: 20%;
        }

        body {
            width: 100%;
            font-size: 12pt;
            padding: 20px;
        }

        .row {
            width: 100%;
            margin-left: 0;
        }

        .col-lg-1 {
            width: 8%;
            float: left;
        }

        .col-lg-2 {
            width: 16%;
            float: left;
        }

        .col-lg-3 {
            width: 25%;
            float: left;
        }

        .col-lg-4 {
            width: 33%;
            float: left;
        }

        .col-lg-5 {
            width: 42%;
            float: left;
        }

        .col-lg-6 {
            width: 50%;
            float: left;
        }

        .col-lg-7 {
            width: 58%;
            float: left;
        }

        .col-lg-8 {
            width: 66%;
            float: left;
        }

        .col-lg-9 {
            width: 75%;
            float: left;
        }

        .col-lg-10 {
            width: 83%;
            float: left;
        }

        .col-lg-11 {
            width: 92%;
            float: left;
        }

        .col-lg-12 {
            width: 100%;
            float: left;
        }

        .inputan {
            border: none;
            border-bottom: 1px solid !important;
        }

        #tabel_header tr td {
            /* width: 10%; */

            padding-left: 5px;
            padding-right: 5px;
        }

        #tabel_header tr:nth-child(even) td {
            padding-top: 5px;
        }

        #title_tabel_3 {
            -webkit-transform: rotate(270deg);
        }
    </style>
</head>

<body>
    @if(Session::has('sukses'))
    <script>
        alert('{{ Session::get("sukses") }}')
    </script>
    @endif
    @if(Session::has('gagal'))
    <script>
        alert('{{ Session::get("gagal") }}')
    </script>
    @endif
    <div class="container">
        <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" onsubmit="return cek_form(this)" action="{{ url('e_rekam_medis/detail/save_formulir_serah_terima_bayi') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" id="hide_nama_ibu" name="nama_ibu">
                        <input type="hidden" id="hide_nama_ayah" name="nama_ayah">
                        <input type="hidden" id="hide_bb_saat_pulang" name="bb_saat_pulang">
                        <input type="hidden" id="hide_hari_control" name="hari_control">
                        <input type="hidden" id="hide_tgl_control" name="tgl_control">
                        <input type="hidden" id="hide_jk" name="jk">
                        <input type="hidden" id="hide_checklist_satu" name="checklist_satu">
                        <input type="hidden" id="hide_checklist_dua" name="checklist_dua">
                        <input type="hidden" id="hide_checklist_tiga" name="checklist_tiga">
                        <input type="hidden" id="hide_checklist_empat" name="checklist_empat">
                        <input type="hidden" id="hide_checklist_lima" name="checklist_lima">
                        <input type="hidden" id="hide_checklist_enam" name="checklist_enam">
                        <input type="hidden" id="hide_checklist_tujuh" name="checklist_tujuh">
                        <input type="hidden" id="hide_checklist_delapan" name="checklist_delapan">
                        <input type="hidden" id="hide_checklist_sembilan" name="checklist_sembilan">
                        <input type="hidden" id="hide_checklist_sepuluh" name="checklist_sepuluh">
                        <input type="hidden" id="hide_nama_dokter" name="nama_dokter">
                        <input type="hidden" id="hide_hari_dokumen" name="hari_dokumen">
                        <input type="hidden" id="hide_tgl_dokumen" name="tgl_dokumen">
                        <input type="hidden" id="hide_jam_dokumen" name="jam_dokumen">
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
                    <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/detail/save_ttd_dokumen_kunjungan') }}">
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
        <div class="row">
            <div class="col-lg-7">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="" id="logo_rshm">
                <p style="font-weight: bold; font-size: 12px;">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya, Kec. Cibarusah<br>
                    Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
            </div>
            <div class="col-lg-5">
                <div style="width: 100%; padding:10px; border: 1px solid; border-radius:10px;">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ $pasien->nama }}</td>
                        </tr>
                        <tr>
                            <td>No. RM</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ $pasien->id }}</td>
                        </tr>
                        <tr>
                            <td>Tgl Lahir</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td class="pl-2 pr-2"> : </td>
                            <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <table class="table table-bordered table-0 custom-table">
                <thead>
                  <tr>
                    <th scope="col" colspan="4" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">CHECKLIST SERAH TERIMA BAYI SAAT DIPULANGKAN</th>
                  </tr>
                </thead>
                <tbody>
                    <tr style="font-weight: bold;">
                        <td colspan="4" style="text-indent: 10px;">
                            Nama Orang Tua : <br>
                            &nbsp;&nbsp;Ibu  &nbsp;&nbsp; : <input type="text" id="nama_ibu" value="{{ $data ? $data->nama_ibu : '' }}" style="border: hidden; border-bottom: 1px dotted"> <br>
                            &nbsp;&nbsp;Ayah :   <input type="text" id="nama_ayah" value="{{ $data ? $data->nama_ayah : '' }}" style="border: hidden; border-bottom: 1px dotted" class="mb-2"> 
                        </td>
                    </tr>
                    <tr class="text-center mt-2" >
                        <td class="font-weight-bold" style="width: 5%" >NO</td>
                        <td class="font-weight-bold" style="width: 45%">KETERANGAN</td>
                        <td class="font-weight-bold" style="width:10%">Ya</td>
                        <td class="font-weight-bold"style="width: 10%">Tidak</td>
                    </tr>
                    <tr>
                        <td class="text-center">1</td>
                        <td > &nbsp;&nbsp;Jenis Kelamin : <input type="radio" value="laki-laki" name="radio_jk" {{ $data ? ($data->jk == 'laki-laki' ? 'checked' : '') : '' }}> Laki-laki 
                            <input type="radio" value="perempuan" name="radio_jk" {{ $data ? ($data->jk == 'perempuan' ? 'checked' : '') : '' }}>Perempuan</td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_satu" {{ $data ? ($data->checklist_satu == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_satu" {{ $data ? ($data->checklist_satu == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td > &nbsp;&nbsp;Gelang bayi dan ibu sesuai</td>
                        <td  style="text-align: center"><input type="radio" value="ya" name="radio_checklist_dua" {{ $data ? ($data->checklist_dua == 'ya' ? 'checked' : '') : '' }}></td>
                        <td  style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_dua" {{ $data ? ($data->checklist_dua == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td> &nbsp;&nbsp;BB saat pulang : <input type="text" id="bb_saat_pulang" style="border: hidden; border-bottom: 1px dotted" class="mb-2" value="{{ $data ? $data->bb_saat_pulang : '' }}"> gram </td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_tiga" {{ $data ? ($data->checklist_tiga == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_tiga" {{ $data ? ($data->checklist_tiga == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td style="text-indent: 5px;">Bayi dimandikan 2x sehari dengan air hangat, kemudian untuk menjaga tali pusat tidak infeksi jaga tali pusat tetap bersih dan kering tanpa memberikan obat apapun dan dibungkus dengan kassa kering. <br>
                            Jika terdapat masalah segera konsultasikan dengan dokter.
                        </td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_empat" {{ $data ? ($data->checklist_empat == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_empat" {{ $data ? ($data->checklist_empat == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td> &nbsp;&nbsp;Berikan ASI saja sampai bayi berusia 6 bulan ( ASI Eksekutif 6 bulan)
                        </td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_lima" {{ $data ? ($data->checklist_lima == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_lima" {{ $data ? ($data->checklist_lima == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td> &nbsp;&nbsp;Memberikan minum ASI secara teratur setiap 2 - 3 jam. <br>
                            Setelah diberi minum letakkan bayi dengan posisi tegak dengan kepala bersandar di bahu dan di tepuk-tepuk/diusap punggung bayi sampai sendawa.</td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_enam" {{ $data ? ($data->checklist_enam == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_enam" {{ $data ? ($data->checklist_enam == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">7</td>
                        <td> &nbsp;&nbsp;Bawalah bayi anda untuk diperiksa ke dokter secara teratur, untuk mendapatkan imunisasi secara teratur.</td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_tujuh" {{ $data ? ($data->checklist_tujuh == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_tujuh" {{ $data ? ($data->checklist_tujuh == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">8</td>
                        <td> &nbsp;&nbsp;Segera hubungi dan konsultasikan ke dokter anak apabila terdapat keadaan seperti berikut
                            <ol>
                                <li> Bayi tampak kuning</li>
                                <li> Tinja berwarna seperti dempul </li>
                                <li> Muntah hebat, perut kembung dan diare</li>
                                <li> Panas tinggi, kejang dan malas minum</li>
                                <li> Sesak nafas</li>
                                <li> Bila saat menangis bayi terlihat biru di sekitar mulut</li>
                            </ol>
                        </td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_delapan" {{ $data ? ($data->checklist_delapan == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_delapan" {{ $data ? ($data->checklist_delapan == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">9</td>
                        <td>
                            &nbsp;&nbsp;Penjelasan tentang metode kanggoro (jika bayi kurang dari &lt; 200 gram)
                        </td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_sembilan" {{ $data ? ($data->checklist_sembilan == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_sembilan" {{ $data ? ($data->checklist_sembilan == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td class="text-center">10</td>
                        <td> &nbsp;&nbsp;Kontrol Hari dan tanggal : <input type="text" id="hari_control" style="border: hidden; border-bottom: 1px dotted" class="mb-2" value="{{ $data ? $data->hari_control : '' }}">, 
                            <input type="text" id="tgl_control" class="tanggal_dmy" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? date('d-m-Y', strtotime($data->tgl_control)) : date('d-m-Y') }}"> <br>
                           &nbsp; Ke dokter &nbsp;&nbsp; : <input type="text" id="nama_dokter" style="border: hidden; border-bottom: 1px dotted" class="mb-2" value="{{ $data ? $data->nama_dokter : '' }}">
                        </td>
                        <td style="text-align: center"><input type="radio" value="ya" name="radio_checklist_sepuluh" {{ $data ? ($data->checklist_sepuluh == 'ya' ? 'checked' : '') : '' }}></td>
                        <td style="text-align: center"><input type="radio" value="tidak" name="radio_checklist_sepuluh" {{ $data ? ($data->checklist_sepuluh == 'tidak' ? 'checked' : '') : '' }}></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-indent: 10px;">
                            Bekasi : <input type="text" id="hari_dokumen" style="border: hidden; border-bottom: 1px dotted" class="mb-2" value="{{ $data ? $data->hari_dokumen : '' }}">
                            <input type="text" id="tgl_dokumen" class="tanggal_dmy" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? date('d-m-Y', strtotime($data->tgl_dokumen)) : date('d-m-Y') }}">, Jam 
                            <input type="text" id="jam_dokumen" class="waktu_24" style="border: hidden; border-bottom: 1px dotted" value="{{ $data ? date('H:i', strtotime($data->jam_dokumen)) : date('H:i') }}"> WIB
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width: 50%; text-align:center" onclick="open_modal_pasien()">
                            Orang Tua Bayi
                            @if (!is_null($dokumen))
                                @if(is_null($dokumen->signature_pasien) || $dokumen->signature_pasien == "")
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    (.................................................)
                                    <br>
                                    Ttd & Nama Terang
                                @else
                                    <br>
                                    @if(!is_null($dokumen->signature_pasien) || $dokumen->signature_pasien != "")
                                        <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                                style="height: 4cm; width: 5cm;" alt="">
                                    @else
                                        <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                    @endif
                                    <br>({{$dokumen->nama_pasien}})
                                @endif
                            @else
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>
                                Ttd & Nama Terang
                            @endif
                        </td>
                        <td colspan="2" style="width: 50% !important; text-align:center;" onclick="open_modal_petugas()">
                            Petugas yang Menyerahkan
                            @if($dokumen->id_verifikator == 0)
                                <br>
                                <br>
                                Simpan & Verifikasi
                                <br>
                                <br>
                                <br>
                                (.................................................)
                                <br>
                                Ttd & Nama Terang
                            @else
                                @if(isset($employee))
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                            style="height: 4cm; width: 5cm;" alt="">
                                @else
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                                @endif
                                <br>({{$dokumen->nama_verifikator}})
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="text-right">RSHM/RI/13.00/Rev.01</p>
        </div>
    </div>
</body>
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
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

    $('.tanggal_dmy').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
    });
    
    $('.tanggal_dmy').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        setUmur();
    });

    $('.tanggal_dmy').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    $('.waktu_24').daterangepicker({
        locale: {
            format: 'HH:mm',
            cancelLabel: 'Clear'
        },
        singleClasses: "",
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('.waktu_24').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('HH:mm'));
    });

    $('.waktu_24').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }

    function cek_form() {
        $('#hide_id_ppa').val($("#id_ppa").val());
        $('#hide_perawatan_dirumah').val($('[name="radio_perawatan_dirumah"]:checked').val());
        $('#hide_nama_ibu').val($('#nama_ibu').val());
        $('#hide_nama_ayah').val($('#nama_ayah').val());
        $('#hide_bb_saat_pulang').val($('#bb_saat_pulang').val());
        $('#hide_hari_control').val($('#hari_control').val());
        $('#hide_tgl_control').val($('#tgl_control').val());
        $('#hide_jk').val($('[name="radio_jk"]:checked').val());
        $('#hide_checklist_satu').val($('[name="radio_checklist_satu"]:checked').val());
        $('#hide_checklist_dua').val($('[name="radio_checklist_dua"]:checked').val());
        $('#hide_checklist_tiga').val($('[name="radio_checklist_tiga"]:checked').val());
        $('#hide_checklist_empat').val($('[name="radio_checklist_empat"]:checked').val());
        $('#hide_checklist_lima').val($('[name="radio_checklist_lima"]:checked').val());
        $('#hide_checklist_enam').val($('[name="radio_checklist_enam"]:checked').val());
        $('#hide_checklist_tujuh').val($('[name="radio_checklist_tujuh"]:checked').val());
        $('#hide_checklist_delapan').val($('[name="radio_checklist_delapan"]:checked').val());
        $('#hide_checklist_sembilan').val($('[name="radio_checklist_sembilan"]:checked').val());
        $('#hide_checklist_sepuluh').val($('[name="radio_checklist_sepuluh"]:checked').val());
        $('#hide_nama_dokter').val($('#nama_dokter').val());
        $('#hide_hari_dokumen').val($('#hari_dokumen').val());
        $('#hide_tgl_dokumen').val($('#tgl_dokumen').val());
        $('#hide_jam_dokumen').val($('#jam_dokumen').val());

        return true;
    }
</script>

</html>