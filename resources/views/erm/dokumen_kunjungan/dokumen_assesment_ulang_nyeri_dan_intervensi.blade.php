<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIMRS - Assesment Ulang Nyeri & Intervensi</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
        <style>
            .table-renpra td {
                border: black 1px solid;
            }

            .table-renpra .header-renpra {
                background-color: #ccc;
            }

            .text-bold{
                font-weight: 600;
            }

            .table-mini{
                display: block;
                padding: 5pt 10pt;
                align-items: center;
            }
            .table-mini td{
                border: white!important;
            }

            .table-content{
                width: 100%;
                outline: 0rem;
                padding: 0px;
                margin: -1px;
            }

            .table-content td{
            }

            .table-content thead td{
                font-weight: bold;
                font-size: 14px;
                padding: 5px 5px;
                text-align: center;

            }

            .table-content input{
                width: 100%;
                border:0;
                outline:0;
            }

            .table-content input:focus{
                outline: none !important;
                border:1px solid #ccc;
                box-shadow: 0 0 20px #719ECE;
            }

            .cell-vertical{
                -ms-writing-mode: tb-rl;
                -webkit-writing-mode: vertical-rl;
                writing-mode: vertical-rl;
                transform: rotate(180deg);
                white-space: nowrap;
            }
        </style>
    </head>
    <body class="p-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-8">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                    <p style="font-weight: bold">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya,<br>Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="w-100" style="border: 2px solid; padding:30px; border-radius:10px; font-weight: bold;float: right;">
                        <table>
                            <tr class="align-top">
                                <td>Nama</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $dokumen->nama_pasien }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>No. RM</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $dokumen->nrm }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tgl Lahir</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis Kelamin</td>
                                <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                                <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="m-0 p-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form id="formInput" action="{{ url('e_rekam_medis/detail/save_assesment_ulang_nyeri_dan_intervensi') }}" method="post">
                @csrf
                <div class="row item-wrapper">
                    <div class="col-12">
                        <table class="w-100 table-renpra mt-1">
                            <thead>
                                <tr class="header-renpra">
                                    <td colspan="7" class="font-weight-bold text-center">ASSESMENT ULANG NYERI & INTERVENSI</td>
                                </tr>
                                <tr class="text-bold text-center">
                                    <td>SKALA NYERI</td>
                                    <td>PASORO - MCCAFERRYOPIOID -INDUCED SEDATION SCALE(POSS)</td>
                                    <td>INTERVENSI NON FARMAKOLOGI</td>
                                    <td>ASESMEN ULANG</td>
                                </tr>
                                <tr>
                                    <td style="align-items: center;font-size: 14px;">
                                        <table class="table-mini">
                                            <tbody>
                                                <tr>
                                                    <td>0</td>
                                                    <td>:</td>
                                                    <td>Tidak ada Nyeri</td>
                                                </tr>
                                                <tr>
                                                    <td>1-3</td>
                                                    <td>:</td>
                                                    <td>Nyeri Ringan</td>
                                                </tr>
                                                <tr>
                                                    <td>4-6</td>
                                                    <td>:</td>
                                                    <td>Nyeri Sedang</td>
                                                </tr>
                                                <tr>
                                                    <td>7-10</td>
                                                    <td>:</td>
                                                    <td>Nyeri Berat</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table-mini">
                                            <tbody>
                                                <tr>
                                                    <td>4</td>
                                                    <td>:</td>
                                                    <td>Samnolent, minimal/tidak respon terhadap rangsangan fisik</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>:</td>
                                                    <td>Sering mengantuk, bisa dibangunkan, mudah tertidur saat sedang bicara</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>:</td>
                                                    <td>Agak mengantuk, mudan dibangunkan</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>:</td>
                                                    <td>Bangun dan Sadar</td>
                                                </tr>
                                                <tr>
                                                    <td>0</td>
                                                    <td>:</td>
                                                    <td>Tidur, mudah dibangunkan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table-mini">
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>:</td>
                                                    <td>Dingin</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>:</td>
                                                    <td>Panas</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>:</td>
                                                    <td>Posisi</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>:</td>
                                                    <td>Pijat</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>:</td>
                                                    <td>Musik</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>:</td>
                                                    <td>TENS</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>:</td>
                                                    <td>Relaksasi & Pernapasan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table-mini">
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>:</td>
                                                    <td>15 Menit setelah intervensi obat Injeksi</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>:</td>
                                                    <td>1 Jam setelahintervensi obat oral / lainnya</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>:</td>
                                                    <td>1x shift bila skor nyert 1 - 3</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>:</td>
                                                    <td>Setiap 3 jam bilaskor nyeri 4- 6</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>:</td>
                                                    <td>Setiap 1 jam bila skor nyeri 7- 10</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>:</td>
                                                    <td>Dihentikan bila skor nyeri: 0</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">
                                        <table class="table-content">
                                            <thead>
                                                <tr>
                                                    <td rowspan="2" >Tgl & Jam</td>
                                                    <td rowspan="2" class="cell-vertical">Skor <br> Nyeri</td>
                                                    <td rowspan="2" class="cell-vertical">Skor <br> Sedasi</td>
                                                    <td rowspan="2">Tekanan Darah</td>
                                                    <td rowspan="2">Nadi</td>
                                                    <td rowspan="2">Suhu</td>
                                                    <td rowspan="2" class="cell-vertical">Respirasi</td>
                                                    <td colspan="2">Perawat / Bidan</td>
                                                    <td rowspan="2">Tgl & Jam</td>
                                                    <td colspan="4">Intervensi Farmakologi</td>
                                                    <td rowspan="2">Intervensi Non Farmakologi</td>
                                                    <td colspan="2">Perawat / Bidan</td>
                                                    <td rowspan="2">Waktu Kaji Ulang</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>Paraf</td>
                                                    <td>Nama Obat</td>
                                                    <td>Dosis / Frekuensi</td>
                                                    <td>Rute</td>
                                                    <td>Efek Samping Obat</td>
                                                    <td>Nama</td>
                                                    <td>Paraf</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i =0;$i < 10; $i++)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="idx[]" class="inputIdx" value="{{$i+1}}">
                                                        <input type="hidden" name="id_dokumen[]" value="{{ $dokumen->id }}">
                                                        <input type="text" class="inputTgl1 datetimepicker" name="Tgl1[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->Tanggal1Nice : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="inputSkorNyeri" min="0" max="10" name="SkorNyeri[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->skor_nyeri : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="inputSkorSedasi" min="0" max="4" name="SkorSedasi[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->skor_sedasi : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputTekananDarah" name="TekanaDarah[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->tekanan_darah : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputNadi" name="Nadi[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->nadi : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputSuhu" name="Suhu[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->suhu : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputRespirasi" name="Respirasi[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->respirasi : '' }}">
                                                    </td>
                                                    <td>
                                                         <div>{{ isset($assesment[$i]) && $assesment[$i]->verifikator1 ? $assesment[$i]->user_verifikator1->realname : (isset($assesment[$i]) ? $assesment[$i]->verifikator1 : '') }}</div>
                                                    </td>
                                                    <td>
                                                        @if (isset($assesment[$i]) && $assesment[$i]->verifikator1 )
                                                            @if ($assesment[$i]->user_verifikator1->hrd_employee && $assesment[$i]->user_verifikator1->hrd_employee->ttd)
                                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $assesment[$i]->user_verifikator1->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                            @else
                                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                            @endif
                                                        @else
                                                            <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="1">Verifikasi</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputTgl2 datetimepicker" name="Tgl2[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->Tanggal2Nice : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputNamaObat" name="NamaObat[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->nama_obat : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputDosis" name="Dosis[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->dosis : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputRute" name="Rute[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->rute : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputEfekSamping" name="EfekSamping[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->efek_samping : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" min="1" max="7" class="inputIntervensiNonFarmakologi" name="IntervensiNonFarmakologi[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->intervensi_non_farmakologi : '' }}">
                                                    </td>
                                                    <td>
                                                        <div>{{ isset($assesment[$i]) && $assesment[$i]->verifikator2 ? $assesment[$i]->user_verifikator2->realname : (isset($assesment[$i]) ? $assesment[$i]->verifikator2 : '') }}</div>
                                                    </td>
                                                    <td>
                                                        @if (isset($assesment[$i]) && $assesment[$i]->verifikator2 )
                                                            @if ($assesment[$i]->user_verifikator2->hrd_employee && $assesment[$i]->user_verifikator2->hrd_employee->ttd)
                                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $assesment[$i]->user_verifikator2->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                                                            @else
                                                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                                                            @endif
                                                        @else
                                                            <button class="btn btn-sm btn-primary m-0 btnVerif" data-verif="2">Verifikasi</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="text" class="inputWaktuKajiUlang datetimepicker" name="WaktuKajiUlang[]" value="{{ isset($assesment[$i]) ? $assesment[$i]->TanggalKajiUlangNice : '' }}">
                                                    </td>
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 ">
                        <button type="submit" class="pull-right btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
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
                    <form id="formVerif" method="post" action="{{ url('e_rekam_medis/detail/verif_assesment_ulang_nyeri_dan_intervensi') }}">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" name="verif" id="inputTipeVerifModal" value="1">
                        <input type="hidden" name="idxModal" id="inputIdxModal" value="1">
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
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        $(function() {

            $("#formVerif").submit(function (e) {
                e.preventDefault();

                var isDetail = $('#formVerif').find("#inputIsDetail").val();

                $('#formVerif :input').each(function() {

                    if( isDetail == "1" ){
                        if($(this).attr('name')){
                            $("#formInputDetail").append($(this));
                        }
                    }else{
                        if($(this).attr('name')){
                            $("#formInput").append($(this));
                        }
                    }

                });

                if(isDetail == "1"){

                    $("#formInputDetail").submit();

                }else{

                    $("#formInput").submit();

                }


            });


            $(".btnVerif").click(function (e) {
                e.preventDefault();

                var verif = $(this).data('verif');
                var idx = $(this).closest("tr").find(".inputIdx").val();

                // alert("Asdasd "+idx);

                $("#inputTipeVerifModal").val(verif);
                $("#inputIdxModal").val(idx);

                $("#modal_petugas").modal().show();
            });

            $('#modal_petugas').on('hidden.bs.modal', function () {

                $("#inputTipeVerifModal").val(0);
                $("#inputIdxModal").val(0);
            })

            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY HH:mm'
                },
                useCurrent: false,
                autoUpdateInput: true,
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        });
    </script>
    </body>
</html>
