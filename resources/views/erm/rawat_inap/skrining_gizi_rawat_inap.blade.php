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
    <title>Asesmen Gizi Lanjut Rawat Inap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
    <div class="container">
        <div class="row">
            <div class="col-12 text-right">MR 02.01.007.REV 0</div>
        </div>
        <div class="row align-items-stretch justify-conten-between">
            <div class="col-sm-12 col-md-5 mt-3">
                <div class="w-100">
                     <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                    <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-5">
                <div class="w-100" style="border: 2px solid; padding:30px; font-weight: bold;height: 90%; border-radius: 10px">
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
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                        </tr>
                    </table>
                    <p class="text-right" style="font-weight: normal">
                        <i> *Tempel Label</i>
                    </p>
                </div>
            </div>
        </div>


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

        <form id="form_dokumen">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <div class="container">
            <div class="row">
                <table class="table table-bordered custom-table">
                    <thead>
                      <tr>
                        <th scope="col" colspan="5" class="text-center" style="border: 1px solid; padding: 0px">ASESMEN GIZI LANJUT RAWAT INAP</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="4" style="border-top: 1px solid; width: 20%; text-align: center; font-weight: bold">Riwayat klien</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding: 5px;"> 
                                Kemampuan Baca :     <input type="radio" id="kemampuan_baca_ya" value="1" name="kemampuan_baca" {{ $data && !is_null($data->kemampuan_baca) ? ($data->kemampuan_baca == 1 ? 'checked' : '') : '' }} > Bisa 
                                                    <input type="radio"  id="kemampuan_baca_tidak" name="kemampuan_baca" value="0" {{ $data && !is_null($data->kemampuan_baca) ? ($data->kemampuan_baca == 0 ? 'checked' : '') : '' }}> Tidak 
                                                    <br>
                                Alamat : <input type="text" id="alamat" name="alamat" class="form-control" value="{{$data->alamat??''}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;"> 
                                Pekerjaan : <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" value="{{$data->pekerjaan??''}}">
                            </td>
                            <td style="padding: 5px;"> 
                                Peran dalam Keluarga <input type="text" id="peran" name="peran" class="form-control"  value="{{$data->peran??''}}">
                            </td>
                            <td style="padding: 5px;" colspan="2"> 
                                Keterbatasan Fisik <br> <input type="radio" id="keterbatasan_fisik_ya" name="keterbatasan_fisik" value="1" {{ $data && !is_null($data->keterbatasan_fisik) ? ($data->keterbatasan_fisik == 1 ? 'checked' : '') : '' }}> Ya 
                                                        <input  id="keterbatasan_fisik_tidak" name="keterbatasan_fisik" type="radio"  {{ $data && !is_null($data->keterbatasan_fisik) ? ($data->keterbatasan_fisik == 0 ? 'checked' : '') : '' }}> Tidak
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding: 5px;"> 
                                Mobilitas : <input type="text" id="mobilitas" name="mobilitas"  class="form-control" value="{{$data->mobilitas??''}}">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" style="border-top: 1px solid; padding: 5px">
                                Riwayat Medis Keluarga Pasien : <input type="text" id="riwayat_medis"  name="riwayat_medis"  style="width: 75%; border-style: none; border-bottom: 1px dotted"  value="{{$data->riwayat_medis??''}}"> <br><br>
                                Diagnosa Medis 
                                <span style="padding-left: 102px"> :</span>
                                <input type="text"  id="diagnosa_medis"   name="diagnosa_medis"  value="{{$data->diagnosa_medis??''}}"  style="width: 75%; border-style: none; border-bottom: 1px dotted">
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold text-center">
                                Riwayat Diet
                            </td>
                            <td colspan="4" style="padding: 5px">
                                Alergi Makanan&nbsp;&nbsp; : <input type="radio" id="alergi_makan_ya" name="alergi_makan"  {{ $data && !is_null($data->alergi_makan) ? ($data->alergi_makan == 1 ? 'checked' : '') : '' }}> Ada &nbsp;&nbsp;&nbsp;&nbsp; 
                                                                <input name="alergi_makan"  type="radio" id="alergi_makan_tidak" {{ $data && !is_null($data->alergi_makan) ? ($data->alergi_makan == 0 ? 'checked' : '') : '' }}> Tidak <br>
                                Ketidak sukaan &nbsp;&nbsp; : <input type="radio" id="tidak_suka_ya" name="tidak_suka"  {{ $data && !is_null($data->tidak_suka) ? ($data->tidak_suka == 1 ? 'checked' : '') : '' }}> Ada  &nbsp;&nbsp;&nbsp;&nbsp; 
                                                                <input type="radio" id="tidak_suka_tidak" name="tidak_suka" {{ $data && !is_null($data->tidak_suka) ? ($data->tidak_suka == 0 ? 'checked' : '') : '' }}> Tidak <br>
                                Pengalaman diet : <input type="radio" name="pengalaman_diet" id="pengalaman_diet_ya" value="1"  {{ $data && !is_null($data->pengalaman_diet) ? ($data->pengalaman_diet == 1 ? 'checked' : '') : '' }}> pernah 
                                                    <input name="pengalaman_diet" id="pengalaman_diet_tidak" value="1"name="pengalaman_diet" id="pengalaman_diet_ya" value="0" type="radio"  {{ $data && !is_null($data->pengalaman_diet) ? ($data->pengalaman_diet == 0 ? 'checked' : '') : '' }} > Tidak <br>
                                Dengan siapa : <input type="text" id="dengan_siapa" name="dengan_siapa"  value="{{$data->dengan_siapa??''}}"  style="width: 75%; border-style: none; border-bottom: 1px dotted"> <br><br>
                                Keluhan mengenai makan : <input id="keluhan_makan"  name="keluhan_makan"  value="{{$data->keluhan_makan??''}}"  type="text" style="width: 75%; border-style: none; border-bottom: 1px dotted"> <br><br>
                            </td>
                        </tr>

                        <tr>
                            <th scope="col" colspan="5" class="text-center" style="border: 1px solid; padding: 0px">ASSESMENT GIZI</th>
                        </tr>

                        <tr>
                            <td rowspan="3" style="border-top: 1px solid; width: 20%; text-align: center; font-weight: bold">Penilaian Antropometri</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; text-align: center"> 
                                BB : <input type="text" id="bb"  name="bb"   value="{{$data->bb??''}}"   style="border-style: none; border-bottom: 1px dotted; width: 50%" > Kg
                            </td>
                            <td style="padding: 5px; text-align: center"> 
                                PB/TB : <input type="text" id="pbtb" name="pbtb"   value="{{$data->pbtb??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 50%" > Cm
                            </td>
                            <td style="padding: 5px; text-align: center"> 
                                IMT : <input type="text"  id="imt" name="imt"  value="{{$data->imt??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 50%" > Kg/m2
                            </td>
                            <td style="padding: 5px; text-align: center"> 
                                LLA : <input type="text"  id="lla"  name="lla"  value="{{$data->lla??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 50%" > Cm
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding: 5px;"> 
                                Kesimpulan : <input type="text"  id="kesimpulan_antropemetri"  value="{{$data->kesimpulan_antropemetri??''}}"  name="kesimpulan_antropemetri"  class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold text-center">
                                Biokimia Gizi
                            </td>
                            <td colspan="4" style="padding: 5px;"> 
                                Kesimpulan : <input type="text"  id="kesimpulan_biokimia"  value="{{$data->kesimpulan_biokimia??''}}" name="kesimpulan_biokimia" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="3" style="border-top: 1px solid; width: 20%; text-align: center; font-weight: bold">Fisik Klinis</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; text-align: center"> 
                                Keadaan : <input type="text"  id="keadaan"  name="keadaan"  value="{{$data->keadaan??''}}" style="border-style: none; border-bottom: 1px dotted; width: 50%" >
                            </td>
                            <td style="padding: 5px; text-align: center"> 
                               Hilang Lemak : <input type="radio"  id="hilang_lemak_ya"    name="hilang_lemak" value="1" {{ $data && !is_null($data->hilang_lemak) ? ($data->hilang_lemak == 1 ? 'checked' : '') : '' }} > Ada  
                                            <input type="radio"  id="hilang_lemak_tidak" name="hilang_lemak" value="0"  {{ $data && !is_null($data->hilang_lemak) ? ($data->hilang_lemak == 0 ? 'checked' : '') : '' }} > Tidak 
                            </td>
                            <td style="padding: 5px; text-align: center" colspan="2"> 
                                Edema/Acites : <input type="radio"  id="edema_ya"   name="edema" {{ $data && !is_null($data->edema) ? ($data->edema == 1 ? 'checked' : '') : '' }}> Ada  
                                                <input type="radio" id="edema_tidak"  name="edema"  {{ $data && !is_null($data->edema) ? ($data->edema == 0 ? 'checked' : '') : '' }} > Tidak 
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; text-align: center"> 
                                TD : <input type="text"  id="td"   name="td"  value="{{$data->td??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 50%" > mm/Hg
                            </td>
                            <td style="padding: 5px; text-align: center"> 
                                N : <input type="text"  id="n" name="n"  value="{{$data->n??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 50%" > /menit
                            </td>
                            <td style="padding: 5px; text-align: center"> 
                                RR : <input type="text"  id="rr"   name="rr"  value="{{$data->rr??''}}"   style="border-style: none; border-bottom: 1px dotted; width: 50%" > x/menit
                            </td>
                            <td style="padding: 5px; text-align: center"> 
                                T : <input type="text"  id="t" name="t"  value="{{$data->t??''}}"   style="border-style: none; border-bottom: 1px dotted; width: 50%" > &deg;C
                            </td>
                        </tr>

                        <tr>
                            <th scope="col" colspan="5" class="text-center" style="border: 1px solid; padding: 0px">RECALL KONSUMSI 1X24 JAM</th>
                        </tr>

                        <tr>
                            <td colspan="5" style="border-top: 1px solid; padding: 5px">
                                <textarea name="recall" id="recall" cols="7"    class="form-control">{{$data->recall??''}}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <th scope="col" colspan="5" class="text-center" style="border: 1px solid;padding: 0px">DIAGNOSA GIZI</th>
                        </tr>

                        <tr>
                            <td colspan="5" style="border-top: 1px solid; padding: 5px; font-weight: bold">
                                Nutrition Intake (NI) &nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" id="ni"  value="{{$data->ni??''}}"  name="ni" style="border-style: none; border-bottom: 1px dotted; width: 80%" >
                                Nutrition CLinical (NC) &nbsp;: <input type="text" id="nc"  name="nc"  value="{{$data->nc??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 80%" >
                                Nutrition Behavior (NB) : <input type="text" id="nb" name="nb"  value="{{$data->nb??''}}"   style="border-style: none; border-bottom: 1px dotted; width: 80%" >
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered custom-table" style="margin-top: -17px">
                    <tr>
                        <th scope="col" colspan="5" class="text-center" style="border: 1px solid;padding: 0px">INTERVENSI GIZI</th>
                    </tr>

                    <tr>
                        <td rowspan="3" style="border-top: 1px solid; width: 50%; font-weight: bold; padding: 5px">
                            Terapi Gizi : <input type="text" id="terapi_gizi"  value="{{$data->terapi_gizi??''}}"  name="terapi_gizi"  style="border-style: none; border-bottom: 1px dotted; width: 70%" > <br>
                            Jenis makanan : <input type="text" id="jenis_makanan"  value="{{$data->jenis_makanan??''}}"  name="jenis_makanan"  style="border-style: none; border-bottom: 1px dotted; width: 70%" > <br>
                            Rute : <input type="text" id="rute"  name="rute"  value="{{$data->rute??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 70%" > <br>
                            Jadwal Pemberian : <input id="jadwal_pemberian"  value="{{$data->jadwal_pemberian??''}}"   name="jadwal_pemberian"  type="text" style="border-style: none; border-bottom: 1px dotted; width: 70%" > <br>
                            Edukasi Gizi : <input type="text"  id="edukasi_gizi"  value="{{$data->edukasi_gizi??''}}"   name="edukasi_gizi"  style="border-style: none; border-bottom: 1px dotted; width: 70%" > <br>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding: 5px; font-weight: bold; text-align: center"> 
                            PERHITUNGAN KEBUTUHAN
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="margin: 0px;"> 
                            <textarea name="perhitungan_kebutuhan"  id="perhitungan_kebutuhan" cols="7"  class="form-control">{{$data->perhitungan_kebutuhan??''}}</textarea>
                         </td>
                    </tr>

                    <tr style="margin: 0px;">
                        <th scope="col" colspan="5" class="text-center" style="border: 1px solid; padding: 0px">ESTIMASI KEBUTUHAN</th>
                    </tr>
                </table>
                <table class="table table-bordered custom-table" style="margin-top: -17px;">
                    <tr style="padding: 3px;">
                        <td style="border-top: 1px solid; font-weight: bold; padding: 5px; text-align: center">
                            E : <input type="text"  id="e"  name="e"  value="{{$data->e??''}}"   style="border-style: none; border-bottom: 1px dotted; width: 50%" > Kkal
                        </td>
                        <td style="border-top: 1px solid; font-weight: bold; padding: 5px; text-align: center">
                            P : <input type="text"  id="p" name="p"  value="{{$data->p??''}}"  style="border-style: none; border-bottom: 1px dotted; width: 50%" > gr
                        </td>
                        <td style="border-top: 1px solid; font-weight: bold; padding: 5px; text-align: center">
                            L : <input type="text"  id="l"  name="l"  value="{{$data->l??''}}" style="border-style: none; border-bottom: 1px dotted; width: 50%" > gr
                        </td>
                        <td style="border-top: 1px solid; font-weight: bold; padding: 5px; text-align: center">
                            KH : <input type="text"  id="kh"  name="kh"  value="{{$data->kh??''}}" style="border-style: none; border-bottom: 1px dotted; width: 50%" > gr
                        </td>
                    </tr>

                    <tr style="margin: 0px;">
                        <th scope="col" colspan="5" class="text-center" style="border: 1px solid; padding: 0px">RENCANA MONITORING DAN EVALUASI GIZI</th>
                    </tr>
                </table>
                <table class="table table-bordered custom-table" style="margin-top: -17px;">
                    <tr>
                        <td rowspan="3" style="border-top: 1px solid; width: 75%; font-weight: bold; margin: 0px">
                            <textarea name="monitoring_evaluasi_gizi"  id="monitoring_evaluasi_gizi" cols="7"  class="form-control">{{$data->monitoring_evaluasi_gizi??''}}</textarea>
                        </td>
                    </tr>
                    <tr style="margin: 0px">
                        <td colspan="4" style="font-weight: bold; text-align: center;"> 
                            DIETISIEN
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="margin: 0px;"> 
                            <textarea name="dietisien" id="dietisien" cols="7"  class="form-control">{{$data->dietisien??''}}</textarea>
                         </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-right">
                    RSHM/DMT/26/00/Rev.00
                </div>
            </div>
        </div>


        <div class="row pt-5" style="width:100%; margin-left:0; text-align:center;">
            <button class="btn btn-success" style="margin-left: 48%; display: inline-block; " onclick="open_modal_verifikasi()" type="button">Simpan</button>
            <!-- <button class="btn btn-success" id="submit_form_btn" style="display:none; margin-left: 48%; display: inline-block;" type="submit">Simpan</button> -->
        </div>
        </form>
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


<script>
    $(document).ready(function() {
        var verif = '{{$dokumen->status}}';
        if (verif != 0) {
            window.scrollTo({
                left: 0,
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        }

        
    });

    function open_modal_verifikasi(){
        $('#modal_verifikasi').modal('show');
    }

    $('#form_verifikasi').submit(function(e) {
        e.preventDefault();
        jenis_submit = 'verif';
        $('[name=password]').val($('#password').val());
        $('#modal_verifikasi').modal('hide');
        $('#form_verifikasi')[0].reset();
        $('#form_dokumen').submit();
        //$("#submit_form_btn").trigger("click");
    })


    $('#form_ttd').submit(function(e) {
        e.preventDefault();
        jenis_submit = 'ttd';
        $('#modal_tanda_tangan').modal('hide');
        $('#form_dokumen').submit();
    })

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        $('[name=kemampuan_baca]').val($('#kemampuan_baca_ya').is(":checked")?1:0);
        $('[name=alergi_makan]').val($('#alergi_makan_ya').is(":checked")?1:0);
        $('[name=tidak_suka]').val($('#tidak_suka_ya').is(":checked")?1:0);
        $('[name=pengalaman_diet]').val($('#pengalaman_diet_ya').is(":checked")?1:0);
        $('[name=hilang_lemak]').val($('#hilang_lemak_ya').is(":checked")?1:0);
        $('[name=edema]').val($('#edema_ya').is(":checked")?1:0);
        $('[name=keterbatasan_fisik]').val($('#keterbatasan_fisik_ya').is(":checked")?1:0);

        
        $('[name=alamat]').val($('#alamat').val());
        $('[name=pekerjaan]').val($('#pekerjaan').val());
        $('[name=peran]').val($('#peran').val());
        $('[name=mobilitas]').val($('#mobilitas').val());
        $('[name=riwayat_medis]').val($('#riwayat_medis').val());
        $('[name=diagnosa_medis]').val($('#diagnosa_medis').val());
        $('[name=dengan_siapa]').val($('#dengan_siapa').val());
        $('[name=keluhan_makan]').val($('#keluhan_makan').val());
        $('[name=dengan_siapa]').val($('#dengan_siapa').val());
        $('[name=keluhan_makan]').val($('#keluhan_makan').val());
        $('[name=bb]').val($('#bb').val());
        $('[name=pbtb]').val($('#pbtb').val());
        $('[name=imt]').val($('#imt').val());
        $('[name=lla]').val($('#lla').val());
        $('[name=kesimpulan_antropemetri]').val($('#kesimpulan_antropemetri').val());
        $('[name=kesimpulan_biokimia]').val($('#kesimpulan_biokimia').val());
        $('[name=keadaan]').val($('#keadaan').val());


        $('[name=td]').val($('#td').val());
        $('[name=n]').val($('#n').val());
        $('[name=rr]').val($('#rr').val());
        $('[name=t]').val($('#t').val());
        $('[name=recall]').val($('#recall').val());
        $('[name=ni]').val($('#ni').val());
        $('[name=nc]').val($('#nc').val());
        $('[name=nb]').val($('#nb').val());
        $('[name=terapi_gizi]').val($('#terapi_gizi').val());
        $('[name=jenis_makanan]').val($('#jenis_makanan').val());
        $('[name=rute]').val($('#rute').val());
        $('[name=jadwal_pemberian]').val($('#jadwal_pemberian').val());
        $('[name=edukasi_gizi]').val($('#edukasi_gizi').val());

        $('[name=perhitungan_kebutuhan]').val($('#perhitungan_kebutuhan').val());
        $('[name=e]').val($('#e').val());
        $('[name=p]').val($('#p').val());
        $('[name=l]').val($('#l').val());
        $('[name=kh]').val($('#kh').val());
        $('[name=monitoring_evaluasi_gizi]').val($('#monitoring_evaluasi_gizi').val());
        $('[name=dietisien]').val($('#dietisien').val());

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/skrining_gizi_rawat_inap/store') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                $('[name=signed]').val('');
                toastr.success(response.message);
                
                switch (jenis_submit) {
                    case 'verif':
                        $('#box_verifikasi').html(
                            `<img src="{{ env('SMIS_UPLOAD_URL') }}/` + (response.employee ? response.employee.ttd : '') + `" alt="" style="width: 4cm; height:2.5cm;">` +
                            '<br>' +
                            '(' + response.data.nama_dokter + ')'
                        );
                        break;

                    case 'ttd':
                        $('#box_tanda_tangan').html(
                            `<img src="{{ asset('signature_patient') }}/`+response.data.tanda_tangan+`" alt="" style="width: 4cm; height:2.5cm;">`
                            +`<br>`
                            +`(`+ response.data.nama +`)`
                        )
                        break;

                    default:
                        break;
                }
            }
        })
    });






    /*const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature64").val('');
    });*/

   


 
</script>

</html>