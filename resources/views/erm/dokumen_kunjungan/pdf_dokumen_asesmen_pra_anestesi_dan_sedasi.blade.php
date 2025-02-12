<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Daftar Tilik Pasien Operasi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <style>
        @page { margin: 5px 5px; }
        body { margin: 5px 5px; }
        body {
            width: 100%;
            font-size: 11pt;
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

        .table-basic{
            width: 100%;
            border: 1px;
            /* height: 100%; */
        }

        .table-basic h6{
            text-decoration: underline;
        }

        .table-basic td {
            border: black 1px solid;
        }

        .table-basic tbody td{
            padding: 10px 20px;
        }

        .table-basic .header-renpra {
            background-color: #ccc;
        }

        .table-basic input[type=text]{
            border:0;
            outline:0;
            border-bottom: 2px dotted #000;
        }

        .flex-container {
            display: inline-block;
            width: 100%;
            line-height: 10px;
            /* height: 2rem; */
        }

        .flex-items {
            display: block;
            float: left;
            margin: auto;
            margin-right: 30px;

        }

        .group-checkbox{
            display: inline;
            line-height: 1rem;
            overflow: auto;
            white-space:nowrap;
        }

        .group-checkbox input[type=checkbox]{
            vertical-align: middle;
        }

        .group-checkbox *{
            display: inline-block;
        }

        .table-content td {
            border: black 0px solid!important;
            font-size: 14px;
            padding: 0px;
        }

    </style>
</head>

<body>
    <table class="w-100">
        <tr>
            <td class="p-1 align-top" style="width: 47.5%;border: 1px solid black;">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
            </td>
            <td style="width: 5%;"></td>
            <td class="p-1 align-top" style="width: 47.5%;border: 1px solid black;">
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
                        <td>{{ $layanan->ktp }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="table-basic">
        <tr>
            <td class="font-weight-bold text-center">Asesmen Pra Anestesi & Sedasi</td>
        </tr>
        <tr>
            <td class="font-italic">*Beri Tanda <i class="fa fa-check-square-o"></i> Pada Tanda <i class="fa fa-square-o"></i></td>
        </tr>
        <tr>
            <td style="height: 5%;">
                <div class="flex-container">
                    <div class="flex-items">
                        Tanggal Pengkajian :
                        <input data-state='{{$detail && $detail->tanggal ? 1 : 0}}' type="text" class="datepicker" value="{{ ($detail) ? Illuminate\Support\Carbon::parse($detail->tanggal)->format('d/m/Y') : date("d/m/Y")}}" name="tanggal" id="">
                    </div>
                    <div class="flex-items">
                        Jam :
                        <input type="text" class="timepicker" name="jam" value="{{ ($detail) ? $detail->jam : ''}}" id="">
                    </div>
                    <div class="flex-items">
                        Oleh :
                        <input type="text" name="" id="" value="{{ ($detail) ? $detail->user_operator->realname : Auth::user()->realname}}">
                    </div>
                 </div>
            </td>
        </tr>
        <tr>
            <td style="height: 10%;">
                <h6>1. SOSIAL</h6>
                <div class="flex-container">
                    <div class="flex-items">
                        Menikah :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="sosial[menikah][value]" {{ ($detail && isset($detail->sosial['menikah']) && $detail->sosial['menikah']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                            T <input type="checkbox" name="sosial[menikah][value]" {{ ($detail && isset($detail->sosial['menikah']) && $detail->sosial['menikah']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                        </div>
                    </div>
                    <div class="flex-items">
                        Pekerjaan :
                        <input type="text" name="sosial[perkerjaan][value]" value="{{ ($detail) ? isset($detail->sosial['perkerjaan']) && $detail->sosial['perkerjaan']['value'] : $layanan->pekerjaan}}" id="">
                    </div>
                 </div>
            </td>
        </tr>
        <tr>
            <td>
                <h6>2. KEBIASAAN</h6>
                <div class="flex-container">
                    <div class="flex-items">
                        Merokok :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="kebiasaan[merokok][value]" {{ ($detail && isset($detail->kebiasaan['merokok']) && $detail->kebiasaan['merokok']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                            T <input type="checkbox" name="kebiasaan[merokok][value]" {{ ($detail && isset($detail->kebiasaan['merokok']) && $detail->kebiasaan['merokok']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                        </div>
                    </div>
                    <div class="flex-items">
                        Kopi/Teh/Cola :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="kebiasaan[kopitehgula][value]" {{ ($detail && isset($detail->kebiasaan['kopitehgula']) && $detail->kebiasaan['kopitehgula']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                            T <input type="checkbox" name="kebiasaan[kopitehgula][value]" {{ ($detail && isset($detail->kebiasaan['kopitehgula']) && $detail->kebiasaan['kopitehgula']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                        </div>
                    </div>
                    <div class="flex-items">
                        Alkohol :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="kebiasaan[alkohol][value]" {{ ($detail && isset($detail->kebiasaan['alkohol']) && $detail->kebiasaan['alkohol']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                            T <input type="checkbox" name="kebiasaan[alkohol][value]" {{ ($detail && isset($detail->kebiasaan['alkohol']) && $detail->kebiasaan['alkohol']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                        </div>
                    </div>
                    <div class="flex-items">
                        Olahraga rutin :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="kebiasaan[olahraga][value]" {{ ($detail && isset($detail->kebiasaan['olahraga']) && $detail->kebiasaan['olahraga']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                            T <input type="checkbox" name="kebiasaan[olahraga][value]" {{ ($detail && isset($detail->kebiasaan['olahraga']) && $detail->kebiasaan['olahraga']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                        </div>
                    </div>
                 </div>
            </td>
        </tr>
        <tr>
            <td>
                <h6>3. PENGOBATAN : Sebutkan dosis atau jumlah pil perhari.</h6>
                 <table class="table-content" style="width: 100%;">
                    <tr>
                        <td colspan="4">
                            <div class="flex-container" style="display: block;">
                                <div class="flex-items">
                                    Obat resep :
                                    <input type="text" name="pengobatan[obat_resep][note]" value="{{ ($detail && isset($detail->pengobatan['obat_resep']) && isset($detail->pengobatan['obat_resep']['note'])) ? $detail->pengobatan['obat_resep']['note'] : ''}}"  id="">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="flex-container" style="display: block;">
                                <div class="flex-items">
                                    Obat bebas (vitamin, herbal) :
                                    <input type="text" name="pengobatan[obat_bebas][note]" value="{{ ($detail && isset($detail->pengobatan['obat_bebas']) && isset($detail->pengobatan['obat_bebas']['note'])) ? $detail->pengobatan['obat_bebas']['note'] : ''}}" id="">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Penggunaan aspirin rutin </td>

                        <td style="width: 5%;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="pengobatan[Penggunaan aspirin rutin][value]" {{ ($detail &&  isset($detail->pengobatan['Penggunaan aspirin rutin']['value']) && $detail->pengobatan['Penggunaan aspirin rutin']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="pengobatan[Penggunaan aspirin rutin][value]" {{ ($detail &&  isset($detail->pengobatan['Penggunaan aspirin rutin']['value']) && $detail->pengobatan['Penggunaan aspirin rutin']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Dosis dan frekuensi</td>

                        <td><input type="text" name="pengobatan[Penggunaan aspirin rutin][note]" value="{{ ($detail && isset($detail->pengobatan['Penggunaan aspirin rutin']['note'])) ? $detail->pengobatan['Penggunaan aspirin rutin']['note'] : ''}}"  id=""></td>
                    </tr>
                    <tr>
                        <td>Obat anti sakit </td>

                        <td style="min-width: 10px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="pengobatan[Obat anti sakit][value]" {{ ($detail &&  isset($detail->pengobatan['Obat anti sakit']['value']) && $detail->pengobatan['Obat anti sakit']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                                T <input type="checkbox" name="pengobatan[Obat anti sakit][value]" {{ ($detail &&  isset($detail->pengobatan['Obat anti sakit']['value']) && $detail->pengobatan['Obat anti sakit']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                            </div>
                        </td>
                        <td>Dosis dan frekuensi</td>

                        <td><input type="text" name="pengobatan[Obat anti sakit][note]" value="{{ ($detail && isset($detail->pengobatan['Obat anti sakit']['note'])) ? $detail->pengobatan['Obat anti sakit']['note'] : ''}}" id=""></td>
                    </tr>
                    <tr>
                        <td>Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir </td>

                        <td style="min-width: 10px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="pengobatan[Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir][value]" {{ ($detail &&  isset($detail->pengobatan['Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir']['value']) && $detail->pengobatan['Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="pengobatan[Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir][value]" {{ ($detail &&  isset($detail->pengobatan['Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir']['value']) && $detail->pengobatan['Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Tanggal dan lokasi injeksi</td>

                        <td><input type="text" name="pengobatan[Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir][note]" value="{{ ($detail && isset($detail->pengobatan['Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir']['note'])) ? $detail->pengobatan['Dosis dan frekuensi: Injeksi steroid pada tahun tahun terakhir']['note'] : ''}}" id=""></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="flex-container" style="">
                                <div class="flex-items">
                                    Alergi Obat :
                                    <div class="group-checkbox">
                                        Y <input type="checkbox" name="pengobatan[Alergi Obat][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi Obat']['value']) && $detail->pengobatan['Alergi Obat']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                        T <input type="checkbox" name="pengobatan[Alergi Obat][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi Obat']['value']) && $detail->pengobatan['Alergi Obat']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                                    </div>
                                </div>
                                <div class="flex-items">
                                    Daftar obat dan tipe reaksi :
                                    <input type="text" name="pengobatan[Alergi Obat][note]" value="{{ ($detail && isset($detail->pengobatan['Alergi Obat']['note'])) ? $detail->pengobatan['Alergi Obat']['note'] : ''}}" id="">
                                </div>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="flex-container">
                                <div class="flex-items">
                                    Alergi Lateks :
                                    <div class="group-checkbox">
                                        Y <input type="checkbox" name="pengobatan[Alergi Lateks][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi Lateks']['value']) && $detail->pengobatan['Alergi Lateks']['value'] == 1) ? 'checked' : ''}} value="1"  id="">
                                        T <input type="checkbox" name="pengobatan[Alergi Lateks][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi Lateks']['value']) && $detail->pengobatan['Alergi Lateks']['value'] == 0) ? 'checked' : ''}} value="0"  id="">
                                    </div>
                                </div>
                                <div class="flex-items">
                                    Alergi plester:
                                    <div class="group-checkbox">
                                        Y <input type="checkbox" name="pengobatan[Alergi plester][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi plester']['value']) && $detail->pengobatan['Alergi plester']['value'] == 1) ? 'checked' : ''}} value="1"  id="">
                                        T <input type="checkbox" name="pengobatan[Alergi plester][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi plester']['value']) && $detail->pengobatan['Alergi plester']['value'] == 0) ? 'checked' : ''}} value="0"  id="">
                                    </div>
                                </div>
                                <div class="flex-items">
                                    Alergi makanan:
                                    <div class="group-checkbox">
                                    Y <input type="checkbox" name="pengobatan[Alergi makanan][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi makanan']['value']) && $detail->pengobatan['Alergi makanan']['value'] == 1) ? 'checked' : ''}} value="1"  id="">
                                    T <input type="checkbox" name="pengobatan[Alergi makanan][value]" {{ ($detail &&  isset($detail->pengobatan['Alergi makanan']['value']) && $detail->pengobatan['Alergi makanan']['value'] == 0) ? 'checked' : ''}} value="0"  id="">
                                    <input type="text" name="pengobatan[Alergi makanan][note]" value="{{ ($detail && isset($detail->pengobatan['Alergi makanan']['note'])) ? $detail->pengobatan['Alergi makanan']['note'] : ''}}" id="">
                                    </div>
                                </div>
                             </div>
                        </td>
                    </tr>
                 </table>
            </td>
        </tr>
        <tr>
            <td>
                <h6>4. RIWAYAT KELUARGA : Apakah keluarga pernah mendapatkan masalah seperti dibawah ini?</h6>
                <table class="table-content" style="width: 100%;border:#fff;">
                    <tr>
                        <td style="width: 25%;">Pendarahan yang tidak normal </td>

                        <td style="width: 5%">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Pendarahan yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Pendarahan yang tidak normal']['value']) && $detail->riwayat_keluarga['Pendarahan yang tidak normal']['value'] == 1) ? 'checked' : ''}} value="1"  id="">
                                T <input type="checkbox" name="riwayat_keluarga[Pendarahan yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Pendarahan yang tidak normal']['value']) && $detail->riwayat_keluarga['Pendarahan yang tidak normal']['value'] == 0) ? 'checked' : ''}} value="0"  id="">
                            </div>
                        </td>
                        <td style="width: 25%;">Serangan Jantung</td>

                        <td style="width: 5%">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Serangan Jantung][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Serangan Jantung']['value']) && $detail->riwayat_keluarga['Serangan Jantung']['value'] == 1) ? 'checked' : ''}} value="1"  id="">
                                T <input type="checkbox" name="riwayat_keluarga[Serangan Jantung][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Serangan Jantung']['value']) && $detail->riwayat_keluarga['Serangan Jantung']['value'] == 0) ? 'checked' : ''}} value="0"  id="">
                            </div>
                        </td>
                        <td style="width: 25%">Diabetes</td>

                        <td style="">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Diabetes][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Diabetes']['value']) && $detail->riwayat_keluarga['Diabetes']['value'] == 1) ? 'checked' : ''}} value="1"  id="">
                                T <input type="checkbox" name="riwayat_keluarga[Diabetes][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Diabetes']['value']) && $detail->riwayat_keluarga['Diabetes']['value'] == 0) ? 'checked' : ''}} value="0"  id="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Pembekuan darah yang tidak normal </td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Pembekuan darah yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Pembekuan darah yang tidak normal']['value']) && $detail->riwayat_keluarga['Pembekuan darah yang tidak normal']['value'] == 1) ? 'checked' : ''}} value="1" >
                                T <input type="checkbox" name="riwayat_keluarga[Pembekuan darah yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Pembekuan darah yang tidak normal']['value']) && $detail->riwayat_keluarga['Pembekuan darah yang tidak normal']['value'] == 0) ? 'checked' : ''}} value="0">
                            </div>
                        </td>
                        <td>Hipertensi</td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Hipertensi][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Hipertensi']['value']) && $detail->riwayat_keluarga['Hipertensi']['value'] == 1) ? 'checked' : ''}} value="1">
                                T <input type="checkbox" name="riwayat_keluarga[Hipertensi][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Hipertensi']['value']) && $detail->riwayat_keluarga['Hipertensi']['value'] == 0) ? 'checked' : ''}} value="0">
                            </div>
                        </td>
                        <td>Kanker</td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Kanker][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Kanker']['value']) && $detail->riwayat_keluarga['Kanker']['value'] == 1) ? 'checked' : ''}} value="1">
                                T <input type="checkbox" name="riwayat_keluarga[Kanker][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Kanker']['value']) && $detail->riwayat_keluarga['Kanker']['value'] == 0) ? 'checked' : ''}} value="0">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Permasalahan dalam pembiusan</td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Permasalahan dalam pembiusan][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Permasalahan dalam pembiusan']['value']) && $detail->riwayat_keluarga['Permasalahan dalam pembiusan']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_keluarga[Permasalahan dalam pembiusan][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Permasalahan dalam pembiusan']['value']) && $detail->riwayat_keluarga['Permasalahan dalam pembiusan']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Penyakit Ginjal</td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Penyakit Ginjal][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Penyakit Ginjal']['value']) && $detail->riwayat_keluarga['Penyakit Ginjal']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_keluarga[Penyakit Ginjal][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Penyakit Ginjal']['value']) && $detail->riwayat_keluarga['Penyakit Ginjal']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Tuberkulosis</td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Tuberkulosis][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Tuberkulosis']['value']) && $detail->riwayat_keluarga['Tuberkulosis']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_keluarga[Tuberkulosis][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Tuberkulosis']['value']) && $detail->riwayat_keluarga['Tuberkulosis']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Operasi Jantung Koroner</td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Operasi Jantung Koroner][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Operasi Jantung Koroner']['value']) && $detail->riwayat_keluarga['Operasi Jantung Koroner']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_keluarga[Operasi Jantung Koroner][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Operasi Jantung Koroner']['value']) && $detail->riwayat_keluarga['Operasi Jantung Koroner']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Penyakit berat lainnya</td>

                        <td style="width: 80px;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_keluarga[Penyakit berat lainnya][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Penyakit berat lainnya']['value']) && $detail->riwayat_keluarga['Penyakit berat lainnya']['value'] == 1) ? 'checked' : ''}} value="1"  id="">
                                T <input type="checkbox" name="riwayat_keluarga[Penyakit berat lainnya][value]" {{ ($detail &&  isset($detail->riwayat_keluarga['Penyakit berat lainnya']['value']) && $detail->riwayat_keluarga['Penyakit berat lainnya']['value'] == 0) ? 'checked' : ''}} value="0"  id="">
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                 </table>
                 <p>Jelaskan penyakit berat lainnya apabila dijawab "Ya" :
                    <input type="text" name="riwayat_keluarga[Penyakit berat lainnya][note]" value="{{ ($detail && isset($detail->riwayat_keluarga['Penyakit berat lainnya']['note'])) ? $detail->riwayat_keluarga['Penyakit berat lainnya']['note'] : ''}}" id="">
                 </p>
            </td>
        </tr>
        <tr>
            <td>
                <h6>5. RIWAYAT PENYAKIT PASIEN :</h6>
                <table class="table-content" style="width: 100%;border:#fff;">
                    <tr>
                        <td style="width: 20%;">Pendarahan yang tidak normal </td>
                        <td style="width: 5%;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Pendarahan yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Pendarahan yang tidak normal']['value']) && $detail->riwayat_penyakit['Pendarahan yang tidak normal']['value'] == 1) ? 'checked' : ''}}  value="1"  id="">
                                T <input type="checkbox" name="riwayat_penyakit[Pendarahan yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Pendarahan yang tidak normal']['value']) && $detail->riwayat_penyakit['Pendarahan yang tidak normal']['value'] == 0) ? 'checked' : ''}}  value="0"  id="">
                            </div>
                        </td>
                        <td style="width: 20%;">Serangan Jantung</td>
                        <td style="width: 5%;">
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Serangan Jantung][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Serangan Jantung']['value']) && $detail->riwayat_penyakit['Serangan Jantung']['value'] == 1) ? 'checked' : ''}}  value="1"  id="">
                                T <input type="checkbox" name="riwayat_penyakit[Serangan Jantung][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Serangan Jantung']['value']) && $detail->riwayat_penyakit['Serangan Jantung']['value'] == 0) ? 'checked' : ''}}  value="0"  id="">
                            </div>
                        </td>
                        <td>Pingsan</td>
                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Pingsan][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Pingsan']['value']) && $detail->riwayat_penyakit['Pingsan']['value'] == 1) ? 'checked' : ''}}  value="1"  id="">
                                T <input type="checkbox" name="riwayat_penyakit[Pingsan][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Pingsan']['value']) && $detail->riwayat_penyakit['Pingsan']['value'] == 0) ? 'checked' : ''}}  value="0"  id="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Pembekuan darah yang tidak normal </td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Pembekuan darah yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Pembekuan darah yang tidak normal']['value']) && $detail->riwayat_penyakit['Pembekuan darah yang tidak normal']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Pembekuan darah yang tidak normal][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Pembekuan darah yang tidak normal']['value']) && $detail->riwayat_penyakit['Pembekuan darah yang tidak normal']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                            </div>
                        </td>
                        <td>Hepatitis/sakit kuning</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Hepatitis][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Hepatitis']['value']) && $detail->riwayat_penyakit['Hepatitis']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Hepatitis][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Hepatitis']['value']) && $detail->riwayat_penyakit['Hepatitis']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                            </div>
                        </td>
                        <td>Diabetes</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Diabetes][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Diabetes']['value']) && $detail->riwayat_penyakit['Diabetes']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Diabetes][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Diabetes']['value']) && $detail->riwayat_penyakit['Diabetes']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Permasalahan dalam pembiusan</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Permasalahan dalam pembiusan][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Permasalahan dalam pembiusan']['value']) && $detail->riwayat_penyakit['Permasalahan dalam pembiusan']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Permasalahan dalam pembiusan][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Permasalahan dalam pembiusan']['value']) && $detail->riwayat_penyakit['Permasalahan dalam pembiusan']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Hipertensi</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Hipertensi][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Hipertensi']['value']) && $detail->riwayat_penyakit['Hipertensi']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Hipertensi][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Hipertensi']['value']) && $detail->riwayat_penyakit['Hipertensi']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Asma</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Asma][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Asma']['value']) && $detail->riwayat_penyakit['Asma']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Asma][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Asma']['value']) && $detail->riwayat_penyakit['Asma']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>BB berubah dalam 12 bulan</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[BB berubah dalam 12 bulan][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['BB berubah dalam 12 bulan']['value']) && $detail->riwayat_penyakit['BB berubah dalam 12 bulan']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[BB berubah dalam 12 bulan][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['BB berubah dalam 12 bulan']['value']) && $detail->riwayat_penyakit['BB berubah dalam 12 bulan']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                            </div>
                        </td>
                        <td>Sumbatan jalan nafas</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Sumbatan jalan nafas][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Sumbatan jalan nafas']['value']) && $detail->riwayat_penyakit['Sumbatan jalan nafas']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Sumbatan jalan nafas][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Sumbatan jalan nafas']['value']) && $detail->riwayat_penyakit['Sumbatan jalan nafas']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                            </div>
                        </td>
                        <td>Mengorok</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Mengorok][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Mengorok']['value']) && $detail->riwayat_penyakit['Mengorok']['value'] == 1) ? 'checked' : ''}}  value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Mengorok][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Mengorok']['value']) && $detail->riwayat_penyakit['Mengorok']['value'] == 0) ? 'checked' : ''}}  value="0" id="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Angine/nyeri dada</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Angine][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Angine']['value']) && $detail->riwayat_penyakit['Angine']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Angine][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Angine']['value']) && $detail->riwayat_penyakit['Angine']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Tidur/Sleep Apneu</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Sleep Apneu][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Sleep Apneu']['value']) && $detail->riwayat_penyakit['Sleep Apneu']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Sleep Apneu][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Sleep Apneu']['value']) && $detail->riwayat_penyakit['Sleep Apneu']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                        <td>Anemia</td>

                        <td>
                            <div class="group-checkbox">
                                Y <input type="checkbox" name="riwayat_penyakit[Anemia][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Anemia']['value']) && $detail->riwayat_penyakit['Anemia']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                                T <input type="checkbox" name="riwayat_penyakit[Anemia][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Anemia']['value']) && $detail->riwayat_penyakit['Anemia']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                            </div>
                        </td>
                    </tr>
                 </table>
                 <span>
                    Penyakit berat lainnya:
                    <div class="group-checkbox">
                        Y <input type="checkbox" name="riwayat_penyakit[Penyakit berat lainnya][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Penyakit berat lainnya']['value']) && $detail->riwayat_penyakit['Penyakit berat lainnya']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                        T <input type="checkbox" name="riwayat_penyakit[Penyakit berat lainnya][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Penyakit berat lainnya']['value']) && $detail->riwayat_penyakit['Penyakit berat lainnya']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                    </div>
                    <span>
                        apabila dijawab"Ya"
                        <input type="text" name="riwayat_penyakit[Penyakit berat lainnya][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Penyakit berat lainnya']['note'])) ? $detail->riwayat_penyakit['Penyakit berat lainnya']['note'] : ''}}" id="">
                    </span>
                 </span>
                 <br>
                 <div class="flex-container">
                    <div class="flex-items">
                        Lensa Kontak :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="riwayat_penyakit[Lensa Kontak][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Lensa Kontak']['value']) && $detail->riwayat_penyakit['Lensa Kontak']['value'] == 1) ? 'checked' : ''}} value="1" >
                            T <input type="checkbox" name="riwayat_penyakit[Lensa Kontak][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Lensa Kontak']['value']) && $detail->riwayat_penyakit['Lensa Kontak']['value'] == 0) ? 'checked' : ''}} value="0" >
                        </div>
                    </div>
                    <div class="flex-items">
                        Kacamata :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="riwayat_penyakit[Kacamata][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Kacamata']['value']) && $detail->riwayat_penyakit['Kacamata']['value'] == 1) ? 'checked' : ''}} value="1" >
                            T <input type="checkbox" name="riwayat_penyakit[Kacamata][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Kacamata']['value']) && $detail->riwayat_penyakit['Kacamata']['value'] == 0) ? 'checked' : ''}} value="0" >
                        </div>
                    </div>
                    <div class="flex-items">
                        Alat bantu dengar :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="riwayat_penyakit[Alat bantu dengar][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Alat bantu dengar']['value']) && $detail->riwayat_penyakit['Alat bantu dengar']['value'] == 1) ? 'checked' : ''}} value="1" >
                            T <input type="checkbox" name="riwayat_penyakit[Alat bantu dengar][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Alat bantu dengar']['value']) && $detail->riwayat_penyakit['Alat bantu dengar']['value'] == 0) ? 'checked' : ''}} value="0" >
                        </div>
                    </div>
                    <div class="flex-items">
                        Gigi palsu :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="riwayat_penyakit[Gigi palsu][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Gigi palsu']['value']) && $detail->riwayat_penyakit['Gigi palsu']['value'] == 1) ? 'checked' : ''}} value="1" >
                            T <input type="checkbox" name="riwayat_penyakit[Gigi palsu][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Gigi palsu']['value']) && $detail->riwayat_penyakit['Gigi palsu']['value'] == 0) ? 'checked' : ''}} value="0" >
                        </div>
                    </div>
                 </div>
                 <div class="flex-container">
                    <div class="flex-items">
                        Malampati :
                        <input type="text" name="riwayat_penyakit[Malampati][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Malampati']['note'])) ? $detail->riwayat_penyakit['Malampati']['note'] : ''}}">
                    </div>
                 </div>
                 <br>
                 <span>
                    Apakah pasien pernah mendapatkan transfusi darah?
                    <div class="group-checkbox">
                        Y <input type="checkbox" name="riwayat_penyakit[Apakah pasien pernah mendapatkan transfusi darah][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Apakah pasien pernah mendapatkan transfusi darah']['value']) && $detail->riwayat_penyakit['Apakah pasien pernah mendapatkan transfusi darah']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                        T <input type="checkbox" name="riwayat_penyakit[Apakah pasien pernah mendapatkan transfusi darah][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Apakah pasien pernah mendapatkan transfusi darah']['value']) && $detail->riwayat_penyakit['Apakah pasien pernah mendapatkan transfusi darah']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                    </div>
                    <span>
                        Bila Ya, tahun berapa?
                        <input type="text" name="riwayat_penyakit[Apakah pasien pernah mendapatkan transfusi darah][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Apakah pasien pernah mendapatkan transfusi darah']['note'])) ? $detail->riwayat_penyakit['Apakah pasien pernah mendapatkan transfusi darah']['note'] : ''}}" id="">
                    </span>
                 </span>
                 <br>
                 <span>
                    Apakah pasien pernah diperiksa untuk diagnosis HIV?
                    <div class="group-checkbox">
                        Y <input type="checkbox" name="riwayat_penyakit[Apakah pasien pernah diperiksa untuk diagnosis HIV][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Apakah pasien pernah diperiksa untuk diagnosis HIV']['value']) && $detail->riwayat_penyakit['Apakah pasien pernah diperiksa untuk diagnosis HIV']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                        T <input type="checkbox" name="riwayat_penyakit[Apakah pasien pernah diperiksa untuk diagnosis HIV][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Apakah pasien pernah diperiksa untuk diagnosis HIV']['value']) && $detail->riwayat_penyakit['Apakah pasien pernah diperiksa untuk diagnosis HIV']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                    </div>
                    <span>
                        Bila Ya, tahun berapa?
                        <input type="text" name="riwayat_penyakit[Apakah pasien pernah diperiksa untuk diagnosis HIV][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Apakah pasien pernah diperiksa untuk diagnosis HIV']['note'])) ? $detail->riwayat_penyakit['Apakah pasien pernah diperiksa untuk diagnosis HIV']['note'] : ''}}" id="">
                    </span>
                 </span>
                 <br>
                 <span>
                    Hasil pemeriksaan HIV :
                    <div class="group-checkbox">
                        Positif <input type="checkbox" name="riwayat_penyakit[Hasil pemeriksaan HIV][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Hasil pemeriksaan HIV']['value']) && $detail->riwayat_penyakit['Hasil pemeriksaan HIV']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                        Negatif <input type="checkbox" name="riwayat_penyakit[Hasil pemeriksaan HIV][value]" {{ ($detail &&  isset($detail->riwayat_penyakit['Hasil pemeriksaan HIV']['value']) && $detail->riwayat_penyakit['Hasil pemeriksaan HIV']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                    </div>
                    <span>
                        , Riwayat Operasi, tahun & jenis operasi
                        <input type="text" name="riwayat_penyakit[Hasil pemeriksaan HIV][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Hasil pemeriksaan HIV']['note'])) ? $detail->riwayat_penyakit['Hasil pemeriksaan HIV']['note'] : ''}}" id="">
                    </span>
                 </span>
                 <br>
                 <span>Anestesi yang digunakan dan sebutkan komplikasi/reaksi yang dialami  <input type="text" name="riwayat_penyakit[Anestesi yang digunakan dan sebutkan komplikasi/reaksi yang dialami][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Anestesi yang digunakan dan sebutkan komplikasi/reaksi yang dialami']['note'])) ? $detail->riwayat_penyakit['Anestesi yang digunakan dan sebutkan komplikasi/reaksi yang dialami']['note'] : ''}}" id=""></span>
                 <br>
                 <span>Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi : <input type="text" name="riwayat_penyakit[Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi']['note'])) ? $detail->riwayat_penyakit['Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi']['note'] : ''}}" id=""></span>
                 <br>
                 <span>Tanggal terakhir kali periksa kesehatan ke Dokter : <input type="text" name="riwayat_penyakit[Tanggal terakhir kali periksa kesehatan ke Dokter][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Tanggal terakhir kali periksa kesehatan ke Dokter']['note'])) ? $detail->riwayat_penyakit['Tanggal terakhir kali periksa kesehatan ke Dokter']['note'] : ''}}" id=""></span> dimana  <input type="text" name="riwayat_penyakit[dimana][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['dimana']['note'])) ? $detail->riwayat_penyakit['dimana']['note'] : ''}}" id="">
                 <br>
                 <span>Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi : <input type="text" name="riwayat_penyakit[Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi][note]" value="{{ ($detail && isset($detail->riwayat_penyakit['Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi']['note'])) ? $detail->riwayat_penyakit['Anestesi Umum/Regional/Lokal- Komplikasi /Reaksi']['note'] : ''}}" id=""></span>
            </td>
        </tr>
        <tr>
            <td>
                <h6>6. KHUSUS PASIEN PEREMPUAN :</h6>
                <div class="flex-container">
                    <div class="flex-items">
                        Jumlah Kehamilan :
                        <input type="text" name="pasien_perempuan[Jumlah Kehamilan][note]" value="{{ ($detail && isset($detail->pasien_perempuan['Jumlah Kehamilan']['note'])) ? $detail->pasien_perempuan['Jumlah Kehamilan']['note'] : ''}}" id="">
                    </div>
                    <div class="flex-items">
                        Jumlah Anak :
                        <input type="text" name="pasien_perempuan[Jumlah Anak][note]" value="{{ ($detail && isset($detail->pasien_perempuan['Jumlah Anak']['note'])) ? $detail->pasien_perempuan['Jumlah Anak']['note'] : ''}}" id="">
                    </div>
                </div>
                <div class="flex-container">
                    <div class="flex-items">
                        Menstruasi Terakhir :
                        <input type="text" name="pasien_perempuan[Menstruasi Terakhir][note]" value="{{ ($detail && isset($detail->pasien_perempuan['Menstruasi Terakhir']['note'])) ? $detail->pasien_perempuan['Menstruasi Terakhir']['note'] : ''}}" id="">
                    </div>
                    <div class="flex-items">
                        Menyusui :
                        <div class="group-checkbox">
                            Y <input type="checkbox" name="pasien_perempuan[Menyusui][value]" {{ ($detail &&  isset($detail->pasien_perempuan['Menyusui']['value']) && $detail->pasien_perempuan['Menyusui']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                            T <input type="checkbox" name="pasien_perempuan[Menyusui][value]" {{ ($detail &&  isset($detail->pasien_perempuan['Menyusui']['value']) && $detail->pasien_perempuan['Menyusui']['value'] == 0) ? 'checked' : ''}} value="0" id="">
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <h6>7. HASIL PEMERIKSAAN PENUNJANG :</h6>
                <span>
                    <input type="checkbox" name="pemeriksaan_penunjang[Laboratorium][value]" {{ ($detail &&  isset($detail->pemeriksaan_penunjang['Laboratorium']['value']) && $detail->pemeriksaan_penunjang['Laboratorium']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                    Laboratorium
                </span>
                <span>
                <input type="checkbox" name="pemeriksaan_penunjang[EKG][value]" {{ ($detail &&  isset($detail->pemeriksaan_penunjang['EKG']['value']) && $detail->pemeriksaan_penunjang['EKG']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                EKG
                </span>
                <br>
                <span>
                    <input type="checkbox" name="pemeriksaan_penunjang[Foto Thorax][value]" {{ ($detail &&  isset($detail->pemeriksaan_penunjang['Foto Thorax']['value']) && $detail->pemeriksaan_penunjang['Foto Thorax']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                    Foto Thorax
                </span>
                <span>
                    <input type="checkbox" name="pemeriksaan_penunjang[Lain-Lain][value]" {{ ($detail &&  isset($detail->pemeriksaan_penunjang['Lain-Lain']['value']) && $detail->pemeriksaan_penunjang['Lain-Lain']['value'] == 1) ? 'checked' : ''}} value="1" id="">
                    Lain-Lain
                    <input type="text" name="pemeriksaan_penunjang[Lain-Lain][note]" value="{{ ($detail && isset($detail->pemeriksaan_penunjang['Lain-Lain']['note'])) ? $detail->pemeriksaan_penunjang['Lain-Lain']['note'] : ''}}" id="">
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <h6>8. ASESMEN DOKTER ANESTESI :</h6>
                <input type="text" name="asesmen_dokter_anestesi[Hasil][note]" value="{{ ($detail && isset($detail->asesmen_dokter_anestesi['Hasil']['note'])) ? $detail->asesmen_dokter_anestesi['Hasil']['note'] : ''}}" id="" style="width: 100%">
                <br>
                <span>Asa :
                    <input type="text" name="asesmen_dokter_anestesi[Asa][note]" value="{{ ($detail && isset($detail->asesmen_dokter_anestesi['Asa']['note'])) ? $detail->asesmen_dokter_anestesi['Asa']['note'] : ''}}" id="" style="width: 100%">
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="" style="text-align: center;padding-right: 100px;">

                @if ($detail && $detail->verifikator)
                    @if ($detail->user_verifikator->hrd_employee && $detail->user_verifikator->hrd_employee->ttd)
                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $detail->user_verifikator->hrd_employee->ttd }}" style="width: 10rem;object-fit: contain;" alt="">
                        <p class="text-small">{{$detail->user_verifikator->hrd_employee->nama}}</p>
                    @else
                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                    @endif
                @else
                <button type="button" class="btn btn-primary btnVerif">Verifikasi</button>
                @endif
            </td>
        </tr>
    </table>
</body>

</html>
