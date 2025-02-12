<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Formulir Penandaan Lokasi Operasi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        @media print {
            .hidden_on_print {
                display: none;
            }

            #tabel_data td:nth-child(12) {
                display: none;
            }

            #tabel_data th:nth-child(12) {
                display: none;
            }

            #hasil_gambar {
                width: 98.5%;
            }
        }

        .border {
            border: 1px solid black !important;
        }

        .table.table-bordered td,
        .table.table-bordered th {
            border: 1px solid black !important;
        }

        .input-dotted {
            border: none !important;
            border-bottom: 1px dotted black !important;
        }

        #box_ttd_pasien:hover {
            cursor: pointer;
        }

        #box_verifikasi:hover {
            cursor: pointer;
        }
    </style>
</head>

<body class="p-2">
    @if(Session::has('message'))
    <script>
        alert('{{ Session::get("message") }}')
    </script>
    @endif
    <form method="post" onsubmit="return set_lokasi()" action="{{ url('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi/store') }}" class="container-fluid pl-0 pr-0">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <div class="w-100 text-right">RSHM/OK/01.00/Rev.01</div>
        <table class="w-100">
            <tr>
                <td class="align-top" style="width: 47.5%;">
                    <div class="px-4 py-3" style="height: 100%;">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                        <div class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Kel. Cibarusah Jaya<br />Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340).<br>Telp : (021) 8995 2340, Fax : (021) 8995 2340</div>
                    </div>
                </td>
                <td style="width: 5%;"></td>
                <td class="align-top" style="width: 47.5%;">
                    <div class="float-right px-4 py-3 border" style="height: 100%; border-radius:20px;">
                        <table>
                            <tr class="align-top">
                                <td>Nama</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ $dokumen->nama_pasien }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>No. RM</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ $dokumen->nrm }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tgl Lahir</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis Kelamin</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>NIK</td>
                                <td style="padding-left: 10px; padding-right: 10px;">:</td>
                                <td>{{ $pasien->ktp }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <table class="mt-2 w-100" border="1">
            <tr>
                <th class="align-middle text-center" style="background-color: #111;" colspan="2">&nbsp;</th>
            </tr>
            <tr>
                <th class="align-top p-2" style="width: 50%;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label for="">Prosedur</label>
                        <input type="text" name="prosedur" value="{{ $data ? $data->prosedur : '' }}" class="form-control">
                    </div>
                </th>
                <th class="align-top p-2" style="width: 50%;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label for="">Tanggal Prosedur</label>
                        <input type="date" name="tanggal" value="{{ $data ? date('Y-m-d', strtotime($data->tanggal)) : '' }}" class="form-control">
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <img id="gambar_penandaan" src="{{ asset('images/penandaan_lokasi_operasi.png') }}" style="width: 100%; border:1px solid;" alt="">
                    @if(is_null($data) || ($data && $data->lokasi_operasi == ''))
                    <canvas id="canvas_main" style="position: absolute; left:0; margin-left: 10px; border:1px solid;"></canvas>
                    <textarea name="lokasi_operasi" id="lokasi_operasi" style="display: none;"></textarea>
                    @else
                    <img src="{{ asset('penandaan_lokasi_operasi/'.$data->lokasi_operasi) }}" id="hasil_gambar" style="position: absolute; left:0; margin-left: 10px;" alt="">
                    @endif
                    <div class="text-center hidden_on_print pt-3 pb-3" style="width: 100%;">
                        @if(is_null($data) || ($data && $data->lokasi_operasi == ''))
                        <button class="btn btn-danger" type="button" id="btn_hapus">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                        @else
                        <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menggambar ulang ? ')" type="button" href="{{ url('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi/gambar_ulang?dokumen='.$dokumen->id) }}">
                            <i class="fa fa-trash"></i> Gambar Ulang
                        </a>
                        @endif
                        <button class="btn btn-success" type="submit">
                            Simpan
                        </button>
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border-top: 1px solid transparent; border-bottom: 1px solid transparent;">
                    <p class="pl-2">Saya menyatakan bahwa penandaan area operasi dilakukan dengan benar sesuai pada gambar diatas.</p>
                </th>
            </tr>
            <tr>
                <th style="border-top: 1px solid transparent; border-right: 1px solid transparent; text-align:center;" id="box_ttd_pasien">
                    @if(is_null($data))
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    (........................................)<br>
                    @else
                    <img src="{{ asset('signature_patient/'.$data->tanda_tangan) }}" alt="" style="width: 5cm; height:3cm"><br>
                    ({{ $data->nama }})<br>
                    @endif
                    Pasien/Keluarga
                </th>
                <th id="box_verifikasi" style="border-top: 1px solid transparent; border-left: 1px solid transparent; text-align:center;">
                    Cibarusah {{ date('d/m/Y', strtotime($dokumen->created_at)) }}, Jam {{ date('H:i', strtotime($dokumen->created_at)) }}
                    @if(is_null($employee))
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    (........................................)<br>
                    @else
                    <br>
                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.($employee ? $employee->ttd : '') }}" alt="" style="width: 5cm; height:3cm"><br>
                    ({{ $dokumen->nama_verifikator }})<br>
                    @endif
                    Dokter
                </th>
            </tr>
        </table>
    </form>

    <div class="modal fade" id="modal_ttd_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tanda Tangan Pasien / Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="return set_ttd()" method="post" action="{{ url('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi/tanda_tangan') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <label for="" style="font-weight: bold;">Signature : </label>
                            <br>
                            <canvas style="border:1px solid;" id="canvas_ttd"></canvas>
                            <textarea name="tanda_tangan" id="tanda_tangan" style="display: none;"></textarea><br>
                            <button class="btn btn-danger" id="btn_hapus_ttd" type="button"><i class="fa fa-trash"></i>Hapus </button>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama" value="{{ $data ? $data->nama : '' }}" placeholder="Nama pasien / keluarga" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="return set_ttd()" method="post" action="{{ url('e_rekam_medis/detail/formulir_penandaan_lokasi_operasi/verifikasi') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Password : </label>
                            <input type="password" class="form-control" name="pass" required placeholder="Masukkan password anda">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
    let screen_width = window.screen.width;

    <?php if (is_null($data) || ($data && $data->lokasi_operasi == '')) { ?>
        let canvas = document.getElementById("canvas_main");

        let signaturePad = new SignaturePad(canvas, {
            minWidth: 1,
            maxWidth: 1,
            penColor: "red",
        });

        function resizeCanvas() {
            let gambar = document.getElementById('gambar_penandaan');
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = screen_width == 1920 ? 1880 : 1345;
            canvas.height = screen_width == 1920 ? 1773 : 1267;
            canvas.getContext("2d").scale(1, 1);

            console.log('lebar canvas : '+canvas.width);
            console.log(gambar.height);

            signaturePad.clear(); // otherwise isEmpty() might return incorrect value
        }

        // window.addEventListener("resize", resizeCanvas);
        // resizeCanvas();

        $(document).ready(function() {
            resizeCanvas();
        })
    <?php } ?>

    let signaturePadTtd = new SignaturePad(canvas_ttd, {
        minWidth: 2,
        maxWidth: 2,
        penColor: "#111",
    });

    $('#btn_hapus').click(function() {
        signaturePad.clear();
    })

    $('#btn_hapus_ttd').click(function() {
        signaturePadTtd.clear();
    })

    $('#box_ttd_pasien').click(function() {
        $('#modal_ttd_pasien').modal('show');
    })

    $('#box_verifikasi').click(function() {
        $('#modal_verifikasi').modal('show');
    })

    function set_ttd() {
        $('#tanda_tangan').val(signaturePadTtd.toDataURL());
    }

    function set_lokasi() {
        $('#lokasi_operasi').val(signaturePad.toDataURL());
    }
</script>

</html>