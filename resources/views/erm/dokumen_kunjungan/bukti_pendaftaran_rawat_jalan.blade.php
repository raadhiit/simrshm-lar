<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran Rawat Jalan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .inputan {
            border: none;
            border-bottom: 1px dotted;
        }

        @media print {
            .col-lg-12 {
                width: 100%;
            }

            .col-lg-6 {
                width: 50%;
            }

            .inputan {
                border: none !important;
            }

            textarea {
                border: none !important;
                outline: none !important;
            }
        }
    </style>
</head>

<body>
    <form class="container pt-4 pb-4 mt-2" style="border: 1px solid;" id="form_dokumen">
        @csrf
        <input type="hidden" name="jenis_verif">
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="password">
        <input type="hidden" name="nama_pasien">
        <textarea type="hidden" name="signed" style="display: none;"></textarea>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">
                    RS. HARAPAN MULIA
                    <br>
                    Jl. Raya Cibarusah No. 5 Kebon Kopi - Bekasi
                    <br>
                    Telp : (021) 69952340, Fax : (021) 8992460
                    <br>
                    Email : info@rumahsakit-harapanmulia.id
                </h4>
            </div>
            <div class="col-lg-12 mt-4" style="border: 1px solid;"></div>
            <div class="col-lg-12 pt-2">
                <h5>Bukti Pendaftaran Rawat Jalan</h5>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 15%;">No. Reg</td>
                        <td style="width: 5%;"> : </td>
                        <td>{{ $layanan ? $layanan->id : '' }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td> : </td>
                        <td>{{ $layanan ? date('d/m/Y H:i:s', strtotime($layanan->tanggal)) : '' }}</td>
                    </tr>
                    <tr>
                        <td>No. MR</td>
                        <td> : </td>
                        <td>{{ $layanan ? $layanan->nrm : '' }} [{{ $layanan ? $layanan->barulama == 1 ? 'LAMA' : 'BARU' : '' }}]</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td> : </td>
                        <td>{{ $pasien ? $pasien->nama : '' }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td> : </td>
                        <td>{{ $layanan ? $layanan->umur : '' }} / {{ $pasien ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '' }}</td>
                    </tr>
                    <tr>
                        <td>Mitra</td>
                        <td> : </td>
                        <td>{{ $mitra ? $mitra->nama : '' }}</td>
                    </tr>
                    <tr>
                        <td>Pengirim</td>
                        <td> : </td>
                        <td>
                            <input type="text" class="inputan" name="pengirim" value="{{ $data ? $data->pengirim : '' }}" style="width:90%;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 30%;">No. SEP/Jaminan</td>
                        <td style="width: 5%;"> : </td>
                        <td>{{ $layanan ? $layanan->no_sep_rj : '' }}</td>
                    </tr>
                    <tr>
                        <td>Ditujukan</td>
                        <td> : </td>
                        <td>
                            <input type="text" class="inputan" name="ditujukan" value="{{ $data ? $data->ditujukan : '' }}" style="width:90%;">
                        </td>
                    </tr>
                    <tr>
                        <td>Klinik</td>
                        <td> : </td>
                        <td>
                            {{ $layanan ? strtoupper(str_replace('_', ' ', $layanan->jenislayanan)) : '' }}
                            <span style="margin-left: 15%;">&nbsp;</span>
                            Urut : {{ $layanan ? $layanan->no_urut : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td> : </td>
                        <td>{{ $layanan ? $layanan->nama_dokter : '' }}</td>
                    </tr>
                    <tr>
                        <td>Penang. Jwb</td>
                        <td> : </td>
                        <td>{{ $mitra ? $mitra->nama : '' }}</td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td> : </td>
                        <td>
                            <input type="text" class="inputan" name="nama_user" style="width:90%;"
                            value="{{ $layanan->oprj . ' [' . date('H:i') . ']' }}" readonly>
                            {{-- <input type="text" class="inputan" name="nama_user" style="width:90%;" value="{{ $data ? $data->nama_user : Auth::user()->realname.' ['.date('H:i').']' }}" readonly> --}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12 mt-3 mb-3" style="border: 1px solid;"></div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 15%;">Diagnosa</td>
                        <td style="width: 5%;"> : </td>
                        <td>
                            {{-- {{ $diagnosa ? $diagnosa->nama_icd : '' }} --}}
                            <textarea name="diagnosa" class="form-control" rows="3">{{ $data ? $data->diagnosa : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Tindakan</td>
                        <td style="vertical-align: top;"> : </td>
                        <td>
                            {{-- {{ $kasir ? $kasir->nama_tagihan : '' }} --}}
                            <textarea name="tindakan" class="form-control" rows="3">{{ $data ? $data->tindakan : '' }}</textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="vertical-align:top; width: 30%;">Catatan</td>
                        <td style="vertical-align:top; width: 5%;"> : </td>
                        <td>
                            <textarea name="catatan" class="form-control" rows="3">{{ $data ? $data->catatan : '' }}</textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 pt-5">
                Pasien,
                <div id="box_tanda_tangan" onclick="open_modal_tanda_tangan()">
                    @if($data && $data->signature != '')
                    <br>
                    <img src="{{ asset('signature_patient/'.$data->signature) }}" alt="" style="width: 4cm; height:2.5cm;">
                    <br>
                    ({{ $data->nama_pasien }})
                    @else
                    <br>
                    <br>
                    Klik disini
                    <br>
                    <br>
                    <br>
                    (.............................................................)
                    @endif
                </div>
            </div>
            <div class="col-lg-6 pt-5">
                Bekasi, <input type="text" class="datepicker inputan" style="width:20%;" value="{{ $data ? $data->tanggal_verifikasi != '0000-00-00' ? date('d-m-Y', strtotime($data->tanggal_verifikasi)) : date('d-m-Y') : date('d-m-Y') }}">
                <div id="box_verifikasi" onclick="open_modal_verifikasi()">
                    @if($dokumen && $dokumen->status != '')
                    <br>
                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.($employee ? $employee->ttd : '') }}" alt="" style="width: 4cm; height:2.5cm;">
                    <br>
                    ({{ $dokumen->nama_verifikator }})
                    @else
                    <br>
                    <br>
                    Klik disini
                    <br>
                    <br>
                    <br>
                    (.............................................................)
                    @endif
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_tanda_tangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_tanda_tangan">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <input type="text" id="nama_pasien" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verifikasi">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" name="tanggal_verifikasi">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Masukkan password anda">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    function open_modal_verifikasi() {
        $('[name=jenis_verif]').val('verifikasi');
        $('#form_verifikasi')[0].reset();
        $('#modal_verifikasi').modal('show');
    }

    function open_modal_tanda_tangan() {
        $('[name=jenis_verif]').val('tanda_tangan');
        signaturePad.clear();
        $("#signature").val('');
        $("#nama_pasien").val('');
        $('#modal_tanda_tangan').modal('show');
    }

    $('#form_verifikasi').submit(function(e) {
        e.preventDefault();
        $('#form_dokumen').submit();
    })

    $('#form_tanda_tangan').submit(function(e) {
        e.preventDefault();
        $('#form_dokumen').submit();
    })

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();

        $('[name=signed]').val(signaturePad.toDataURL('image/png'));
        $('[name=password]').val($('#password').val());
        $('[name=nama_pasien]').val($('#nama_pasien').val());

        toastr.warning('Sedang update dokumen, harap tunggu...');

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/bukti_pendaftaran_rawat_jalan/store') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);

                $('[name=jenis_verif]').val() == 'tanda_tangan' ? $('#modal_tanda_tangan').modal('hide') : $('#modal_verifikasi').modal('hide');

                var ins = '';
                switch ($('[name=jenis_verif]').val()) {
                    case 'tanda_tangan':
                        var ins = '<br>' +
                            `<img src="{{ asset('signature_patient') }}/` + response.data.signature + `" style="width: 4cm; height:2.5cm;" />` +
                            '<br>' +
                            '(' + response.data.nama_pasien + ')' +
                            '<br>';
                        $('#box_tanda_tangan').html(ins);
                        break;
                    case 'verifikasi':
                        var ins = '<br>' +
                            `<img src="{{ asset('SMIS_UPLOAD_URL') }}/` + (response.employee ? response.employee.ttd : '') + `" style="width: 4cm; height:2.5cm;" />` +
                            '<br>' +
                            '(' + response.dokumen.nama_verifikator + ')' +
                            '<br>';
                        $('#box_verifikasi').html(ins);
                        break;

                    default:
                        break;
                }

            }
        })
    })
</script>
<script>
    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY'
        },
        useCurrent: false,
        autoUpdateInput: true,
        singleDatePicker: true,
    });

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature").val('');
        $("#nama_pasien").val('');
    });
</script>

</html>