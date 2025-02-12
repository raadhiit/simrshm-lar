<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Hasil Tindakan Uji Fungsi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verifikasi">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" id="pass" name="pass" placeholder="Input your password" class="form-control" required>
                        </div>
                        <div id="box_msg_petugas"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="form_dokumen">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="password">
        <div class="container">
            <div class="row">
                <div class="col-12 text-right">MR 03.22.001.REV.0</div>
            </div>
            <div class="row align-items-stretch justify-conten-between">
                <div class="col-sm-12 col-md-5">
                    <div class="w-100">
                        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 80px;">
                    </div>
                </div>
            </div>
    
            <div class="container">
                <h5 class="text-center font-weight-bold"> Lembar Hasil Tindakan Uji Fungsi <br> Prosedur Kedokteran Fisik dan Rehabilitasi</h5>
                <div style="border:1px solid; padding: 5px;" class="">
                    Lembar Hasil Tindakan Uji/Fungsi Prosedur KFR <input type="text" name="lembar_hasil" id="lembar_hasil" style="border: 0; border-bottom: 2px dotted;"> (Koding <input type="text" name="koding" id="koding" style="border: 0; border-bottom: 2px dotted;">  )
                    <br/>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%">No MR</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <input type="text" readonly value="{{ $pasien ? $pasien->id : '' }}" style="border-style: none; border-bottom: 2px dotted; width: 100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Nama</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <input type="text" readonly value="{{ $pasien ? $pasien->nama : '' }}" style="border-style: none; border-bottom: 2px dotted; width: 100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Tanggal lahir</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <input type="text" readonly value="{{ $pasien ? $pasien->tgl_lahir : '' }}" style="border-style: none; border-bottom: 2px dotted; width: 100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Usia</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <input type="text" readonly value="{{ $pasien ? \Carbon\Carbon::parse($pasien->tgl_lahir)->diff(\Carbon\Carbon::now())->format('%y Tahun %m Bulan dan %d Hari') : '' }}" style="border-style: none; border-bottom: 2px dotted; width: 100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Alamat</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <input type="text" readonly value="{{ $pasien ? $pasien->alamat : '' }}" style="border-style: none; border-bottom: 2px dotted; width: 100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Telepon</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <input type="text" readonly value="{{ $pasien ? $pasien->telpon : '' }}" style="border-style: none; border-bottom: 2px dotted; width: 100%">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 10%"> <input type="radio" {{ $pasien ? ($pasien->kelamin == 0 ? 'checked' : '') : '' }}> L / <input type="radio" {{ $pasien ? ($pasien->kelamin == 1 ? 'checked' : '') : '' }}> P </td>
                                    <td style="width: 3%"> </td>
                                    <td style="width: 70%">
                                        {{-- <input type="text" class="form-control" style="border-style: none; border-bottom: 2px dotted"> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 10%">Tanggal Pemeriksaan</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <input type="text" id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" class="tanggal_dmy" style="border-style: none; border-bottom: 2px dotted; width: 100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 10%">Diagnosis Fungsional</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <textarea name="diagnosis_fungsional" id="diagnosis_fungsional" cols="50" rows="" class="form-control" style="border-style: none; border-bottom: 2px dotted">{{ $dokumen->lembar_hasil_tindakan_uji_fungsi ? $dokumen->lembar_hasil_tindakan_uji_fungsi->diagnosis_fungsional : ($data_cppt && isset($data_cppt->diagnosa) ? $data_cppt->diagnosa->kode_icd." - ".$data_cppt->diagnosa->nama_icd : '') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 10%">Diagnosis Medis</td>
                                    <td style="width: 3%"> :</td>
                                    <td style="width: 70%">
                                        <textarea name="diagnosis_medis" id="diagnosis_medis" cols="50" rows="" class="form-control" style="border-style: none; border-bottom: 2px dotted">{{ $dokumen->lembar_hasil_tindakan_uji_fungsi ? $dokumen->lembar_hasil_tindakan_uji_fungsi->diagnosis_medis : ($data_cppt && isset($data_cppt->diagnosa) ? $data_cppt->diagnosa->kode_icd." - ".$data_cppt->diagnosa->nama_icd : '') }}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="container">
                <div style="border:1px solid; padding: 5px; margin-top: 3px;" class="">
                    Instrumen Uji Fungsi/Prosedur KFR :
                    <div class="row">
                        <div class="col-md-12">
                            <p>Hasil yang didapat</p>
                            <textarea name="hasil" id="hasil" cols="50" rows="" class="form-control" style="border-style: none; border-bottom: 2px dotted">{{ $dokumen->lembar_hasil_tindakan_uji_fungsi ? $dokumen->lembar_hasil_tindakan_uji_fungsi->hasil : ($data_cppt ? $data_cppt->objective_lain : '') }}</textarea>
    
                            <p>Kesimpulan</p>
                            <textarea name="kesimpulan" id="kesimpulan" cols="50" rows="" class="form-control" style="border-style: none; border-bottom: 2px dotted">{{ $dokumen->lembar_hasil_tindakan_uji_fungsi ? $dokumen->lembar_hasil_tindakan_uji_fungsi->kesimpulan : ($data_cppt && isset($data_cppt->diagnosa) ? $data_cppt->diagnosa->kode_icd." - ".$data_cppt->diagnosa->nama_icd : '') }}</textarea>
    
                            <p>Rekomendasi</p>
                            <textarea name="rekomendasi" id="rekomendasi" cols="50" rows="" class="form-control" style="border-style: none; border-bottom: 2px dotted">{{ $dokumen->lembar_hasil_tindakan_uji_fungsi ? $dokumen->lembar_hasil_tindakan_uji_fungsi->rekomendasi : ($data_cppt ? $data_cppt->tindak_lanjut : '') }}</textarea>
                         
                        </div>
                    </div>
                </div>
                *) Formilir ini disalin dari Panduan Formulir PERDOSRI
    
                <br>
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center">
                            <div style="border: 1px solid;">
                                Dokter Pemeriksa
                                <div id="box_verifikasi" onclick="open_modal_petugas()">
                                    @if($dokumen && $dokumen->status != 0)
                                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.($employee ? $employee->ttd : '') }}" alt="" style="width: 4cm; height:2.5cm;">
                                    <br>
                                    ({{ $dokumen->nama_verifikator }})
                                    @else
                                    <br>
                                    <br>
                                    Verifikasi dan Simpan
                                    <br>
                                    <br>
                                    <br>
                                    (.............................................................)
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    $('#form_verifikasi').submit(function(e) {
        e.preventDefault();
        $('[name=password]').val($('#pass').val());
        $('#box_msg_petugas').html(loading('Sedang menyimpan data...', 'info'));
        $('#form_dokumen').submit();
    })

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/save_lembar_hasil_tindakan_uji_fungsi') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    $('#box_msg_petugas').html("");
                    $('#form_verifikasi')[0].reset();
                    $('#modal_petugas').modal('hide');
                    return;
                }
                toastr.success(response.message);

                $('#box_verifikasi').html(
                    `<img src="{{ env('SMIS_UPLOAD_URL') }}/` + (response.data.employee ? response.data.employee.ttd : '') + `" alt="" style="width: 4cm; height:2.5cm;">` +
                    '<br>' +
                    '(' + response.data.dokumen.nama_verifikator + ')'
                );

                $('#box_msg_petugas').html("");
                $('#form_verifikasi')[0].reset();
                $('#modal_petugas').modal('hide');
            }
        })
    });
</script>

</html>