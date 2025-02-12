<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran Rawat Inap</title>
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

            .col-lg-8 {
                width: 75%;
            }

            .col-lg-6 {
                width: 50%;
            }

            .col-lg-4 {
                width: 25%;
            }

            .inputan {
                border: none !important;
            }

            #tanggal_verifikasi{
                width: 40% !important;
            }

            textarea {
                border: none !important;
                outline: none !important;
            }
        }
    </style>
</head>

<body>
    <form class="container mt-3" style="border: 1px solid;" id="form_dokumen">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="password">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">
                    RS. HARAPAN MULIA
                    <br>
                    Jl. Raya Cibarusah No. 5 Kebon Kopi - Bekasi
                    <br>
                    Telp : (021) 69952340, Fax : (021) 8992460
                    <br>
                    Email : RSHM@gmail.com
                </h4>
            </div>
            <div class="col-lg-12" style="border: 1px solid;"></div>
            <div class="col-lg-12">
                <h5>Bukti Pendaftaran Rawat Inap</h5>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 15%;">No. Reg</td>
                        <td style="width: 5%;"> : </td>
                        <td>{{ $layanan ? $layanan->id : '' }}</td>
                    </tr>
                    <tr>
                        <td>Kontraktor</td>
                        <td> : </td>
                        <td>
                            <input type="text" class="inputan" name="kontraktor" value="{{ $data ? $data->kontraktor : '' }}" style="width:90%;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 30%;">No. Rekam Medis</td>
                        <td style="width: 5%;"> : </td>
                        <td>{{ $pasien ? $pasien->id : '' }} [{{ $layanan ? strtoupper($layanan->carabayar) : '' }}]</td>
                    </tr>
                    <tr>
                        <td>No. SEP/Jaminan</td>
                        <td> : </td>
                        <td>
                            {{ $layanan ? $layanan->no_sep_ri : '' }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <p>Yang bertanda tangan dibawah ini, menerangkan dengan sebenarnya</p>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 5%; vertical-align:top;">1.</td>
                        <td style="width: 25%; vertical-align:top;">Nama Pasien</td>
                        <td class="text-center" style="width: 5%; vertical-align: top;"> : </td>
                        <td>{{ $pasien ? $pasien->nama : '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="vertical-align: top;">Tempat / Tgl Lahir</td>
                        <td style="vertical-align: top;" class="text-center"> : </td>
                        <td style="vertical-align: top;">{{ $pasien ? $pasien->tempat_lahir.' / '.date('d-m-Y', strtotime($pasien->tgl_lahir)) : '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Umur</td>
                        <td class="text-center"> : </td>
                        <td>{{ $layanan ? $layanan->umur : '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Ibu</td>
                        <td class="text-center"> : </td>
                        <td>{{ $pasien ? $pasien->ibu : '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Agama</td>
                        <td class="text-center"> : </td>
                        <td>{{ $pasien ? $pasien->agama : '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 5%;">2.</td>
                        <td style="vertical-align:top; width: 25%;">Tanggal Masuk</td>
                        <td style="vertical-align:top; width: 5%;"> : </td>
                        <td>
                            {{ $layanan ? date('d-m-Y', strtotime($layanan->tanggal_inap)) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Ruangan Inap</td>
                        <td> : </td>
                        <td>{{ $layanan ? ucwords(str_replace('_',' ',$layanan->kamar_inap)) : '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kelas</td>
                        <td> : </td>
                        <td>{{ $layanan ? ucwords(str_replace('_',' ',$layanan->last_kelas)) : '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Dokter</td>
                        <td> : </td>
                        <td>{{ $diagnosa ? $diagnosa->nama_dokter : '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="vertical-align: top;">Diagnosa</td>
                        <td style="vertical-align: top;"> : </td>
                        <td>{{ $diagnosa ? $diagnosa->nama_icd : '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 2.5%;">3.</td>
                        <td style="width: 12%;">Alamat</td>
                        <td class="text-center" style="width: 2.5%;"> : </td>
                        <td>
                            {{ $pasien ? $pasien->alamat : '' }}
                            <span style="margin-left: 5%;">&nbsp;</span>
                            RT {{ $pasien ? $pasien->rt : '' }}
                            <span style="margin-left: 5%;">&nbsp;</span>
                            RW {{ $pasien ? $pasien->rw : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kelurahan</td>
                        <td class="text-center"> : </td>
                        <td>
                            {{ $pasien ? $pasien->nama_kelurahan : '' }}
                            <span style="margin-left: 15%;">&nbsp;</span>
                            Kecamatan : {{ $pasien ? $pasien->nama_kecamatan : '' }}
                            <span style="margin-left: 15%;">&nbsp;</span>
                            Kota : {{ $pasien ? $pasien->nama_kabupaten : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>No. Telepon</td>
                        <td class="text-center"> : </td>
                        <td>
                            <input type="number" value="{{ $data ? $data->telepon : '' }}" name="telepon" class="inputan">
                            <span style="margin-left: 15%;">&nbsp;</span>
                            No. HP : {{ $pasien ? $pasien->telpon : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Cara Masuk</td>
                        <td class="text-center"> : </td>
                        <td>
                            <input type="text" name="cara_masuk" class="inputan" value="{{ $data ? $data->cara_masuk : ($layanan ? $layanan->caradatang : '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Datang Melalui</td>
                        <td class="text-center"> : </td>
                        <td>
                            <input type="text" name="datang_melalui" class="inputan" value="{{ $data ? $data->datang_melalui : ($layanan ? ucfirst(str_replace('_',' ',$layanan->jenislayanan)) : '') }}">
                            <span style="margin-left: 15%;">&nbsp;</span>
                            Dikirim Oleh : <input type="text" value="{{ $data ? $data->dikirim_oleh : ''}}" name="dikirim_oleh" class="inputan">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-8 pt-1">
                &nbsp;
            </div>
            <div class="col-lg-4 pt-1">
                Bekasi, <input type="text" name="tanggal_verifikasi" id="tanggal_verifikasi" class="datepicker inputan" style="width:25%;" value="{{ $data ? $data->tanggal_verifikasi != '0000-00-00' ? date('d-m-Y', strtotime($data->tanggal_verifikasi)) : date('d-m-Y') : date('d-m-Y') }}">
                <div id="box_verifikasi" onclick="open_modal_verifikasi()">
                    @if($dokumen && $dokumen->status != '')
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
        $('#form_verifikasi')[0].reset();
        $('#modal_verifikasi').modal('show');
    }

    $('#form_verifikasi').submit(function(e) {
        e.preventDefault();
        $('#form_dokumen').submit();
    })

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        $('[name=password]').val($('#password').val());

        toastr.warning('Sedang update dokumen, harap tunggu...');

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/bukti_pendaftaran_rawat_inap/store') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                console.log(response);
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);

                $('#modal_verifikasi').modal('hide');

                var ins = `<img src="{{ env('SMIS_UPLOAD_URL') }}/` + (response.employee ? respone.employee.ttd : '') + `" style="width: 4cm; height:2.5cm;" />` +
                    '<br>' +s
                    '(' + response.dokumen.nama_verifikator + ')' +
                    '<br>';
                $('#box_verifikasi').html(ins);

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