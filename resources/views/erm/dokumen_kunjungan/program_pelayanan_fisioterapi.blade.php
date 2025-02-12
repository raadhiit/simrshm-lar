<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>SMIS - Assesment Perioperatif Medis</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <title>Program Pelayanan Fisioterapi Pasien BPJS Kesehatan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .custom-table td{
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }
        .custom-table th{
            border-color: black;
        }
    </style>
</head>

<body class="p-2">
    <div class="modal fade" id="modal_tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('e_rekam_medis/detail/save_program_pelayanan_fisioterapi') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal Pelayanan :</label>
                            <input type="text" name="tgl_pelayanan" placeholder="Tanggal pelayanan"
                            class="form-control tanggal_dmy" value="{{ $data_cppt ? date('d-m-Y', strtotime($data_cppt->tanggal)) : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Pelayanan :</label>
                            <input type="text" name="jenis_pelayanan" placeholder="Tambah Jenis Pelayanan"
                            class="form-control" value="{{ $data_cppt ? $data_cppt->tindak_lanjut : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">No SEP :</label>
                            <input type="text" name="no_sep" placeholder="Tambah No SEP"
                            class="form-control" value="{{ isset($layanan->no_sep_rj) ? $layanan->no_sep_rj : '' }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_dokter" tabindex="-1" role="dialog"aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('e_rekam_medis/detail/ttd_petugas_program_pelayanan_fisioterapi') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" id="hide_index_program" name="index_program">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password"
                            class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_ttd_pasien" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda Tangan Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" onsubmit="return doing_ttd()" action="{{ url('e_rekam_medis/detail/ttd_pasien_program_pelayanan_fisioterapi') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <input type="hidden" id="hide_index_program_ttd" name="index_program">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Nama Pasien</h6>
                            <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" required>
                        </div>
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400
                                height=200></canvas>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="button" id="clear" class="btn btn-danger btn-sm">Clear
                                Signature</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" onsubmit="return doing_cek()" action="{{ url('e_rekam_medis/detail/verif_program_pelayanan_fisioterapi') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}"/>
                    <input type="hidden" name="noreg_selesai" value="{{ $layanan ? $layanan->id : 0 }}"/>
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
    <div class="container">
        <div class="row">
            <div class="col-12 text-right">MR 03.23.001.Rev.0</div>
        </div>
        <div class="row align-items-stretch justify-conten-between">
            <div class="col-sm-12 col-md-5">
                <div class="w-100">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png')  }}" alt="Logo" style="height: 80px; margin-bottom: 80px;">
                    {{-- <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p> --}} <br>
                    <h5 class="text-center mt-3 bold" style="padding-left: 80px"> PROGRAM PELAYANAN FISIOTERAPI <br> PASIEN BPJS KESEHATAN</h5>
                </div>
            </div>
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-5">
                <div class="w-100" style="border: 2px solid; padding:10px; font-weight: bold;height: 100%; border-radius: 10px;">
                    <table>
                        <p class="text-right" style="font-weight: normal">
                            <i> *Stiker Identitas Pasien</i>
                        </p>
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? $pasien->nama : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? $pasien->ktp : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? $pasien->id : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien && !is_null($pasien->kelamin) ? ($pasien->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Pasien</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $layanan && !is_null($layanan->carabayar) ? $layanan->carabayar : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>No. kartu BPJS</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $layanan && !is_null($layanan->nobpjs) ? $layanan->nobpjs : '-' }}</td>
                        </tr>
                        
                    </table>
                    
                </div>
            </div>
        </div>
        <button style="float: right" class="btn btn-sm btn-primary d-print-none mt-2" onclick="open_modal_tambah_data()">Tambah Data</button>
        <button style="float: right" class="btn btn-sm btn-danger d-print-none mt-2 mr-2" onclick="open_modal_verifikasi()">KUNCI PELAYANAN</button>
        <div class="row mt-5">
            <div class="col-md-12">
                <table class="table table-bordered" style="padding: 1em">
                    <thead style="background-color: rgb(238, 238, 238)">
                        <tr>
                            <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center">No</th>
                            <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center">Tanggal</th>
                            <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center">Jenis Pelayanan</th>
                            <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center">No. SEP</th>
                            <th scope="col" colspan="2" class="text-center">Paraf</th> 
                        </tr>
                        <tr>
                            <th scope="col" class="text-center">Pasien</th>
                            <th scope="col" class="text-center">Petugas</th>
                        </tr>
                        <tbody>
                            @if(isset($program_pelayanan_fisioterapi) && $program_pelayanan_fisioterapi->program != null)
                            @foreach (json_decode($program_pelayanan_fisioterapi->program) as $key => $item)
                            <tr>
                                <td style="vertical-align: text-top; text-align: center">{{ $key+1 }}</td>
                                <td style="vertical-align: text-top; text-align: center">{{ $item->tgl_pelayanan }}</td>
                                <td style="vertical-align: text-top; text-align: center">{{ $item->jenis_pelayanan }}</td>
                                <td style="vertical-align: text-top; text-align: center">{{ $item->no_sep }}</td>
                                <td style="text-align: center; vertical-align: text-top">
                                    @if (!isset($item->signature_pasien))
                                    <a href="#" style="color: #111; text-decoration: none;"
                                    onclick="open_modal_pasien({{ $key }})">Klik disini</a>
                                    @else
                                    <a href="#" style="color: #111; text-decoration: none;"
                                    onclick="open_modal_pasien({{ $key }})">
                                    <img style="width: 3cm; height:1.5cm;"
                                    src="{{ asset('signature_patient/' . $item->signature_pasien) }}" alt="">
                                </a>
                                <p>
                                    ({{ $item->nama_pasien }})<br>
                                </p>
                                @endif
                            </td>
                            <td style="vertical-align: text-top; text-align: center">
                                @if (!isset($item->id_dokter))
                                <a href="#" style="color: #111; text-decoration: none;"
                                onclick="open_modal_dokter({{ $key }})">Klik disini</a>
                                @else
                                @php
                                $ttd = \App\Models\SmisHrdEmployee::where('nama', $item->nama_dokter)->select('ttd')->first()
                                @endphp
                                <a href="#" style="color: #111; text-decoration: none;"
                                onclick="open_modal_dokter({{ $key }})"><img style="width: 3cm; height:1.5cm;"
                                src="{{ env('SMIS_UPLOAD_URL') ."/". ($ttd->ttd) }}"
                                alt="">
                            </a>
                            <br>
                            ({{ $item->nama_dokter }})
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @for ($i = 0; $i < 6; $i++)
                    <tr>
                        <td style="vertical-align: text-top; text-align: center">{{ $i+1 }}.</td>
                        <td style="vertical-align: text-top; text-align: center"></td>
                        <td style="vertical-align: text-top; text-align: center"></td>
                        <td style="vertical-align: text-top; text-align: center"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('.tanggal_dmy').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        singleDatePicker: true,
        timePicker: false,
    });

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    function doing_cek() {
        if (!confirm('Dokumen tidak akan muncul pada kunjungan pasien selanjutnya setelah dilakukan verifikasi. Apakah Anda yakin akan memverifikasi dokumen ? ')) {
            return false;
        }
    }

    function doing_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if (!confirm('Dengan ini, Anda menyetujui bahwa identitas tersebut adalah benar.')) {
            return false;
        }
    }

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature64").val('');
    });

    function open_modal_verifikasi() {
        window.event.preventDefault();
        @if ($dokumen->status == 0)
        $('#modal_verifikasi').modal('show');
        @else
        alert('Dokumen Telah Terverifikasi')
        @endif
    }
    
    function open_modal_tambah_data() {
        window.event.preventDefault();
        $('#modal_tambah_data').modal('show');
    }
    
    function open_modal_dokter(key) {
        window.event.preventDefault();
        $('#hide_index_program').val(key);
        $('#modal_dokter').modal('show');
    }
    
    function open_modal_pasien(key) {
        window.event.preventDefault();
        $('#hide_index_program_ttd').val(key);
        $('#modal_ttd_pasien').modal('show');
    }
</script>
</html>