<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Survei Infeksi Rumah Sakit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .custom-table td {
            padding: 0px;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }

        input[type="text"] {
            padding: 2px;
            /* Adjust padding for input elements */
        }

        #tabel_identitas tr td {
            border: 1px solid transparent;
        }

        .inputan {
            border: none;
            border-bottom: 1px dotted;
        }
    </style>
</head>

<body class="p-2">
    <form class="container-fluid mt-3" id="form_dokumen">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" name="password">
        <input type="hidden" name="jenis_verif" id="jenis_verif">
        <textarea style="display:none" name="tempat_dirawat"></textarea>
        <textarea style="display:none" name="faktor_resiko"></textarea>
        <textarea style="display:none" name="iadp"></textarea>
        <textarea style="display:none" name="infeksi_saluran_kemih"></textarea>
        <textarea style="display:none" name="pneumonia_ventilator"></textarea>
        <textarea style="display:none" name="infeksi_luka_operasi"></textarea>
        <table class="table table-bordered table-0 custom-table" style="width: 100%; margin-bottom:0;">
            <tr>
                <th>
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                    <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                </th>
                <th>
                    <table id="tabel_identitas">
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien->nama }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien->id }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien ? ($pasien->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien->ktp }}</td>
                        </tr>
                    </table>
                    <p class="text-right" style="font-weight: normal">
                        <i> *Tempel Label</i>
                    </p>
                </th>
            </tr>
        </table>
        <table class="table table-bordered table-0 custom-table">
            <thead>
                <tr>
                    <th scope="col" colspan="12" class="text-center" style="font-size: 20px; background-color: lightgrey; margin-bottom:0; border-color: black;">SURVEI INFEKSI RUMAH SAKIT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="pl-2">
                        SMF Utama : <input type="text" value="{{ $data ? $data->smf_utama : '' }}" name="smf_utama" class="inputan">
                    </td>
                    <td colspan="6" class="pl-2">
                        TB : <input type="text" name="tb" style="width: 8%; text-align: center;" value="{{ $data ? $data->tb : '' }}" class="inputan"> cm.
                        BB: <input type="text" name="bb" style="width: 8%; text-align: center;" value="{{ $data ? $data->bb : '' }}" class="inputan my-2">Kg.
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="pl-2">
                        Tanggal Masuk : <input type="text" value="{{ $data ? date('d-m-Y', strtotime($data->tanggal_masuk)) : '' }}" name="tanggal_masuk" class="inputan datepicker my-2">
                    </td>
                    <td colspan="6" class="pl-2">
                        Cara Masuk RS <span class="pl-2 pr-2">:</span>
                        <input type="radio" name="cara_masuk" {{ $data ? $data->cara_masuk == 'IGD' ? 'checked' : '' : '' }} value="IGD"> IGD
                        <span style="margin-left: 5%;">&nbsp;</span>
                        <input type="radio" name="cara_masuk" {{ $data ? $data->cara_masuk == 'IRJ' ? 'checked' : '' : '' }} value="IRJ"> IRJ
                        <span style="margin-left: 5%;">&nbsp;</span>
                        <input type="radio" name="cara_masuk" {{ $data ? $data->cara_masuk == 'Langsung' ? 'checked' : '' : '' }} value="Langsung"> Langsung
                        <span style="margin-left: 5%;">&nbsp;</span>
                        <input type="radio" name="cara_masuk" {{ $data ? $data->cara_masuk == 'Rujukan' ? 'checked' : '' : '' }} value="Rujukan"> Rujukan

                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="pl-2">
                        Tanggal Keluar : <input type="text" name="tanggal_keluar" value="{{ $data ? date('d-m-Y', strtotime($data->tanggal_keluar)) : '' }}" class="inputan datepicker my-2">
                    </td>
                    <td colspan="6" class="pl-2">
                        Keadaan Keluar <span class="pl-2 pr-2">:</span>
                        <input type="radio" name="keadaan_keluar" {{ $data ? $data->keadaan_keluar == 'Hidup' ? 'checked ' : '' : '' }} value="Hidup"> Hidup
                        <span style="margin-left: 5%;">&nbsp;</span>
                        <input type="radio" name="keadaan_keluar" {{ $data ? $data->keadaan_keluar == 'Meninggal' ? 'checked ' : '' : '' }} value="Meninggal"> Meninggal
                        <span style="margin-left: 5%;">&nbsp;</span>
                        <input type="radio" name="keadaan_keluar" {{ $data ? $data->keadaan_keluar == 'Kabur' ? 'checked ' : '' : '' }} value="Kabur"> Kabur
                        <span style="margin-left: 5%;">&nbsp;</span>
                        <input type="radio" name="keadaan_keluar" {{ $data ? $data->keadaan_keluar == 'Pindah RS' ? 'checked ' : '' : '' }} value="Pindah RS"> Pindah RS
                        <span style="margin-left: 5%;">&nbsp;</span>
                        <input type="radio" name="keadaan_keluar" {{ $data ? $data->keadaan_keluar == 'PP' ? 'checked ' : '' : '' }} value="PP"> PP
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="p-2">
                        Diagnosa Akhir :
                        <textarea name="diagnosa_akhir" id="" cols="10" rows="5" class="form-control">{{ $data ? $data->diagnosa_akhir : '' }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="p-2">
                        <?php $tempat_dirawat = $data ? json_decode($data->tempat_dirawat) : [null, null, null] ?>
                        <p>Tempat Dirawat dan Nama Dokter yang Merawat</p>
                        <ul style="list-style-type: decimal;">
                            <li class="pb-3">Ruang <input type="text" value="{{ $tempat_dirawat[0] ? $tempat_dirawat[0]->ruang : '' }}" id="ruang_1" class="inputan"> Tgl. : <input value="{{ $tempat_dirawat[0] ? $tempat_dirawat[0]->tanggal_dari : '' }}" id="tanggal_dari_1" type="text" class="inputan datepicker"> s/d Tgl. : <input value="{{ $tempat_dirawat[0] ? $tempat_dirawat[0]->tanggal_sampai : '' }}" type="text" id="tanggal_sampai_1" class="inputan datepicker"> Dr: <input value="{{ $tempat_dirawat[0] ? $tempat_dirawat[0]->dokter : '' }}" type="text" id="dokter_1" class="inputan"></li>
                            <li class="pb-3">Ruang <input type="text" value="{{ $tempat_dirawat[1] ? $tempat_dirawat[1]->ruang : '' }}" id="ruang_2" class="inputan"> Tgl. : <input value="{{ $tempat_dirawat[1] ? $tempat_dirawat[1]->tanggal_dari : '' }}" id="tanggal_dari_2" type="text" class="inputan datepicker"> s/d Tgl. : <input value="{{ $tempat_dirawat[1] ? $tempat_dirawat[1]->tanggal_sampai : '' }}" type="text" id="tanggal_sampai_2" class="inputan datepicker"> Dr: <input value="{{ $tempat_dirawat[1] ? $tempat_dirawat[1]->dokter : '' }}" type="text" id="dokter_2" class="inputan"></li>
                            <li>Ruang <input value="{{ $tempat_dirawat[2] ? $tempat_dirawat[2]->ruang : '' }}" type="text" id="ruang_3" class="inputan"> Tgl. : <input value="{{ $tempat_dirawat[2] ? $tempat_dirawat[2]->tanggal_dari : '' }}" id="tanggal_dari_3" type="text" class="inputan datepicker"> s/d Tgl. : <input value="{{ $tempat_dirawat[2] ? $tempat_dirawat[2]->tanggal_sampai : '' }}" type="text" id="tanggal_sampai_3" class="inputan datepicker"> Dr: <input value="{{ $tempat_dirawat[2] ? $tempat_dirawat[2]->dokter : '' }}" type="text" id="dokter_3" class="inputan"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="pl-2">
                        Faktor Resiko
                    </td>
                    <?php $faktor_resiko = $data ? json_decode($data->faktor_resiko) : null ?>
                    <td colspan="8" class="p-2">
                        <input type="checkbox" id="faktor_resiko_1" {{ $faktor_resiko ? in_array('Diabetes Melitus', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Diabetes Melitus"> Diabetes Melitus
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_2" {{ $faktor_resiko ? in_array('Obesitas', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Obesitas"> Obesitas
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_3" {{ $faktor_resiko ? in_array('Gangguan Faal Hati', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Gangguan Faal Hati"> Gangguan Faal Hati
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_4" {{ $faktor_resiko ? in_array('Gangguan Faal Ginjal', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Gangguan Faal Ginjal"> Gangguan Faal Ginjal
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_5" {{ $faktor_resiko ? in_array('Perokok', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Perokok"> Perokok
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_6" {{ $faktor_resiko ? in_array('Gizi Buruk', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Gizi Buruk"> Gizi Buruk
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_7" {{ $faktor_resiko ? in_array('Gangguan Sistem Kekebalan Tubuh', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Gangguan Sistem Kekebalan Tubuh"> Gangguan Sistem Kekebalan Tubuh
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_8" {{ $faktor_resiko ? in_array('Keganasan', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Keganasan"> Keganasan
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_9" {{ $faktor_resiko ? in_array('Lanjut Usia', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Lanjut Usia"> Lanjut Usia
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="faktor_resiko_10" {{ $faktor_resiko ? in_array('Bayi', $faktor_resiko->value) ? 'checked' : '' : '' }} value="Bayi"> Bayi, Partus Normal
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="partus_normal_ya" {{ $faktor_resiko ? $faktor_resiko->partus_normal == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="partus_normal_tidak" {{ $faktor_resiko ? $faktor_resiko->partus_normal == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="text-center font-weight-bold"> IADP & PHLEBITIS</td>
                </tr>
                <?php $iadp = $data ? json_decode($data->iadp) : null ?>
                <tr>
                    <td colspan="4" class="pl-2">
                        Pemasangan
                    </td>
                    <td colspan="8" class="p-2">
                        Kateter V Perifer :
                        <input type="checkbox" id="kateter_v_ya" {{ $iadp ? $iadp->pemasangan->kateter_v == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="kateter_v_tidak" {{ $iadp ? $iadp->pemasangan->kateter_v == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                        <span style="margin-left: 5%;">&nbsp;</span>
                        Kateter Vena Central :
                        <input type="checkbox" id="kateter_vena_ya" {{ $iadp ? $iadp->pemasangan->kateter_vena == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="kateter_vena_tidak" {{ $iadp ? $iadp->pemasangan->kateter_vena == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                        <span style="margin-left: 5%;">&nbsp;</span>
                        Kateter Umbilikal :
                        <input type="checkbox" id="kateter_umbilikal_ya" {{ $iadp ? $iadp->pemasangan->kateter_umbilikal == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" id="kateter_umbilikal_tidak" {{ $iadp ? $iadp->pemasangan->kateter_umbilikal == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    </td>
                </tr>

                <tr>
                    <td colspan="6" class="p-2">
                        Tujuaan Pemasangan : <br>
                        Pemberian Obat : <input {{ $iadp ? $iadp->tujuan_pemasangan->pemberian_obat->antibiotik == 1 ? 'checked' : '' : '' }} type="checkbox" id="antibiotik"> Antibiotik / <input {{ $iadp ? $iadp->tujuan_pemasangan->pemberian_obat->statistika == 1 ? 'checked' : '' : '' }} type="checkbox" id="statistika"> Statistika / <input type="text" value="{{ $iadp ? $iadp->tujuan_pemasangan->pemberian_obat->lain : '' }}" id="pemberian_obat_lain" class="inputan"> <br>
                        Transfusi : <input type="checkbox" {{ $iadp ? $iadp->tujuan_pemasangan->transfusi->wb == 1 ? 'checked' : '' : '' }} id=wb"> WB / <input type="checkbox" {{ $iadp ? $iadp->tujuan_pemasangan->transfusi->prc == 1 ? 'checked' : '' : '' }} id="prc"> PRC / <input type="checkbox" {{ $iadp ? $iadp->tujuan_pemasangan->transfusi->ffp == 1 ? 'checked' : '' : '' }} id="ffp"> FFP / <input type="checkbox" {{ $iadp ? $iadp->tujuan_pemasangan->transfusi->trombosit == 1 ? 'checked' : '' : '' }} id="trombosit"> Trombosit <br>
                        Nutrisi parenteral : <input {{ $iadp ? $iadp->tujuan_pemasangan->nutrisi_parenteral->protein == 1 ? 'checked' : '' : '' }} type="checkbox" id="protein"> Protein / <input {{ $iadp ? $iadp->tujuan_pemasangan->nutrisi_parenteral->lemak == 1 ? 'checked' : '' : '' }} type="checkbox" id="lemak"> Lemak / <input {{ $iadp ? $iadp->tujuan_pemasangan->nutrisi_parenteral->glukosa == 1 ? 'checked' : '' : '' }} type="checkbox" id="glukosa"> Glukosa / <input {{ $iadp ? $iadp->tujuan_pemasangan->nutrisi_parenteral->lain : '' }} type="text" class="inputan" id="nutrisi_parenteral_lain"> <br>
                        Terapi Cairan : <input type="checkbox" {{ $iadp ? $iadp->tujuan_pemasangan->terapi_cairan->rl == 1 ? 'checked' : '' : '' }} id="rl"> RL / <input type="checkbox" {{ $iadp ? $iadp->tujuan_pemasangan->terapi_cairan->nacl == 1 ? 'checked' : '' : '' }} id="nacl"> NaCl 0,9% / <input type="checkbox" {{ $iadp ? $iadp->tujuan_pemasangan->terapi_cairan->kaen == 1 ? 'checked' : '' : '' }} id="kaen"> KaEN 3B
                    </td>
                    <td colspan="3" class="p-2">
                        Kultur Darah :
                        <input type="checkbox" {{ $iadp ? $iadp->kultur_darah->value == 'Ya' ? 'checked' : '' : '' }} id="kultur_darah_ya"> Ya
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" {{ $iadp ? $iadp->kultur_darah->value == 'Tidak' ? 'checked' : '' : '' }} id="kultur_darah_tidak">
                        Tidak,Ke : <br>
                        1. Tgl: <input type="text" value="{{ $iadp ? $iadp->kultur_darah->tanggal : '' }}" class="inputan datepicker" id="tanggal_kultur_darah"> <br>
                        2. Hasil: <input type="text" value="{{ $iadp ? $iadp->kultur_darah->hasil : '' }}" id="hasil_kultur_darah" class="inputan">
                    </td>
                    <td colspan="3" class="p-2">
                        Kultur Pus :
                        <input type="checkbox" {{ $iadp ? $iadp->kultur_pus->value == 'Ya' ? 'checked' : '' : '' }} id="kultur_pus_ya"> Ya
                        <span style="margin-left: 2%;">&nbsp;</span>
                        <input type="checkbox" {{ $iadp ? $iadp->kultur_pus->value == 'Tidak' ? 'checked' : '' : '' }} id="kultur_pus_tidak">
                        Tidak,Ke : <br>
                        1. Tgl: <input type="text" value="{{ $iadp ? $iadp->kultur_pus->tanggal : '' }}" class="inputan datepicker" id="tanggal_kultur_pus"> <br>
                        2. Hasil: <input type="text" value="{{ $iadp ? $iadp->kultur_pus->hasil : '' }}" id="hasil_kultur_pus" class="inputan">
                    </td>
                </tr>

                <tr class="text-center">
                    <td colspan="2" class="p-2"> LOKASI</td>
                    <td colspan="3" style="width: 20%"> Tgl. ........ s/d Tgl ........</td>
                    <td> Suhu > 38 &#176 C</td>
                    <td> Hari Ke</td>
                    <td> Nyeri</td>
                    <td> Merah</td>
                    <td> Kalor</td>
                    <td> Pus</td>
                    <td> Bengkak</td>
                </tr>
                @for($i=0; $i< 4; $i++) <tr>
                    <td colspan="2" class="pl-2">{{ $i+1 }}. <input type="text" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->lokasi : '' : '' }}" id="iadp_lokasi_{{ $i }}" class="inputan" style="width: 95%;"></td>
                    <td colspan="3" class="text-center">
                        <input type="text" class="inputan datepicker" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->tanggal_dari : '' : '' }}" id="iadp_tanggal_dari_{{ $i }}" style="width:35%;"> s/d <input type="text" id="iadp_tanggal_sampai_{{ $i }}" class="inputan datepicker" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->tanggal_sampai : '' : '' }}" style="width:35%;">
                    </td>
                    <td class="text-center">
                        <input type="text" id="iadp_suhu_{{ $i }}" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->suhu : '' : '' }}" class="form-control inputan">
                    </td>
                    <td class="text-center">
                        <input type="text" id="iadp_hari_ke_{{ $i }}" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->hari_ke : '' : '' }}" class="form-control inputan">
                    </td>
                    <td class="text-center">
                        <input type="text" id="iadp_nyeri_{{ $i }}" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->nyeri : '' : '' }}" class="form-control inputan">
                    </td>
                    <td class="text-center">
                        <input type="text" id="iadp_merah_{{ $i }}" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->merah : '' : '' }}" class="form-control inputan">
                    </td>
                    <td class="text-center">
                        <input type="text" id="iadp_kalor_{{ $i }}" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->kalor : '' : '' }}" class="form-control inputan">
                    </td>
                    <td class="text-center">
                        <input type="text" id="iadp_pus_{{ $i }}" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->pus : '' : '' }}" class="form-control inputan">
                    </td>
                    <td class="text-center">
                        <input type="text" id="iadp_bengkak_{{ $i }}" value="{{ $iadp ? isset($iadp->list[$i]) ? $iadp->list[$i]->bengkak : '' : '' }}" class="form-control inputan">
                    </td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="12" class="text-center font-weight-bold"> INFEKSI SALURAN KEMIH</td>
                    </tr>
                    <?php $isk = $data ? json_decode($data->infeksi_saluran_kemih) : null  ?>
                    <tr>
                        <td colspan="3" class="p-2">
                            Pemasangan :
                        </td>
                        <td colspan="9" class="pl-2">
                            Kateter Urine : <input type="checkbox" {{ $isk ? $isk->pemasangan->kateter_urine == 'Ya' ? 'checked' : '' : '' }} id="kateter_urine_ya"> Ya <input type="checkbox" {{ $isk ? $isk->pemasangan->kateter_urine == 'Tidak' ? 'checked' : '' : '' }} id="kateter_urine_tidak"> Tidak
                            <span style="margin-left: 5%;">&nbsp;</span>
                            Jenis : <input type="checkbox" {{ $isk ? $isk->pemasangan->jenis->spp == 1 ? 'checked' : '' : '' }} id="spp"> SPP
                            <span style="margin-left: 2%;">&nbsp;</span>
                            <input type="checkbox" {{ $isk ? $isk->pemasangan->jenis->dauer == 1 ? 'checked' : '' : '' }} id="dauer"> Dauer
                            <span style="margin-left: 2%;">&nbsp;</span>
                            <input type="checkbox" {{ $isk ? $isk->pemasangan->jenis->intermintten == 1 ? 'checked' : '' : '' }} id="intermintten"> Intermintten
                            <span style="margin-left: 2%;">&nbsp;</span>
                            <input type="checkbox" {{ $isk ? $isk->pemasangan->jenis->silicone == 1 ? 'checked' : '' : '' }} id="silicone"> Silicone, Tgl : <input value="{{ $isk ? $isk->pemasangan->tanggal : '' }}" type="text" id="tanggal_silicone" class="inputan" name="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="pl-2">
                            Pemeriksaan :
                        </td>
                        <td colspan="5" class="p-2">
                            Urine :
                            <input type="checkbox" id="isk_urine_ya" {{ $isk ? $isk->pemeriksaan->urine->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                            <span style="margin-left: 2%;">&nbsp;</span>
                            <input type="checkbox" id="isk_urine_tidak" {{ $isk ? $isk->pemeriksaan->urine->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak <br>
                            1. Tgl: <input type="text" value="{{ $isk ? $isk->pemeriksaan->urine->tanggal[0] : '' }}" id="isk_tanggal_urine_1" class="inputan datepicker" style="width: 90px;"> Leukosit : <input value="{{ $isk ? $isk->pemeriksaan->urine->leukosit[0] : '' }}" type="text" id="isk_leukosit_urine_1" class="inputan"> <br>
                            2. Tgl: <input type="text" value="{{ $isk ? $isk->pemeriksaan->urine->tanggal[1] : '' }}" id="isk_tanggal_urine_2" class="inputan datepicker" style="width: 90px;"> Leukosit : <input value="{{ $isk ? $isk->pemeriksaan->urine->leukosit[1] : '' }}" type="text" id="isk_leukosit_urine_2" class="inputan my-3">
                        </td>
                        <td colspan="4" class="p-2">
                            Biakan Urine :
                            <input type="checkbox" id="isk_biakan_urine_ya" {{ $isk ? $isk->pemeriksaan->biakan_urine->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                            <span style="margin-left: 2%;">&nbsp;</span>
                            <input type="checkbox" id="isk_biakan_urine_tidak" {{ $isk ? $isk->pemeriksaan->biakan_urine->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak <br>
                            1. Tgl: <input type="text" value="{{ $isk ? $isk->pemeriksaan->biakan_urine->tanggal[0] : '' }}" id="isk_tanggal_biakan_urine_1" class="inputan datepicker" style="width: 90px;"> Leukosit : <input value="{{ $isk ? $isk->pemeriksaan->biakan_urine->leukosit[0] : '' }}" type="text" id="isk_leukosit_biakan_urine_1" class="inputan"> <br>
                            2. Tgl: <input type="text" value="{{ $isk ? $isk->pemeriksaan->biakan_urine->tanggal[1] : '' }}" id="isk_tanggal_biakan_urine_2" class="inputan datepicker" style="width: 90px;"> Leukosit : <input value="{{ $isk ? $isk->pemeriksaan->biakan_urine->leukosit[1] : '' }}" type="text" id="isk_leukosit_biakan_urine_2" class="inputan my-3">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"> Pasang Ke</td>
                        <td style="width: 20%" class="text-center"> Tgl. ........ s/d Tgl ........</td>
                        <td class="text-center"> Suhu > 38 &#176 C</td>
                        <td class="text-center"> Hari Ke</td>
                        <td class="text-center"> Anyang-anyangan</td>
                        <td class="text-center"> Hari Ke</td>
                        <td class="text-center"> Nyeri Supra Pubik</td>
                        <td class="text-center"> Hari Ke</td>
                        <td class="text-center"> Nyeri Berkemih</td>
                        <td class="text-center"> Hari Ke</td>
                        <td class="text-center"> Pus</td>
                        <td class="text-center"> Hari Ke</td>
                    </tr>
                    @for($i=0; $i< 5; $i++) <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        <td class="text-center">
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->tanggal_dari : '' : '' }}" id="isk_tanggal_dari_{{ $i }}" class="inputan datepicker" style="width:35%;"> s/d <input type="text" id="isk_tanggal_sampai_{{ $i }}" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->tanggal_sampai : '' : '' }}" class="inputan datepicker" style="width:35%;">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->suhu->value : '' : '' }}" id="isk_suhu_{{ $i }}" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->suhu->hari_ke : '' : '' }}" id="isk_hari_ke_{{ $i }}_1" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->anyang_anyangan->value : '' : '' }}" id="isk_anyang_anyangan_{{ $i }}" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->anyang_anyangan->hari_ke : '' : '' }}" id="isk_hari_ke_{{ $i }}_2" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->nyeri_supra->value : '' : '' }}" id="isk_nyeri_supra_{{ $i }}" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->nyeri_supra->hari_ke : '' : '' }}" id="isk_hari_ke_{{ $i }}_3" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->nyeri_berkemih->value : '' : '' }}" id="isk_nyeri_berkemih_{{ $i }}" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->nyeri_berkemih->hari_ke : '' : '' }}" id="isk_hari_ke_{{ $i }}_4" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->pus->value : '' : '' }}" id="isk_pus_{{ $i }}" class="form-control inputan">
                        </td>
                        <td>
                            <input type="text" value="{{ $isk ? isset($isk->list[$i]) ? $isk->list[$i]->pus->hari_ke : '' : '' }}" id="isk_hari_ke_{{ $i }}_5" class="form-control inputan">
                        </td>
                        </tr>
                        @endfor
            </tbody>
        </table>

        <p> MR.02.15.003.REV.0</p>
        <table class="table table-bordered table-0 custom-table">
            <tr>
                <td colspan="21" class="text-center font-weight-bold"> PNEUMONIA VENTILATOR</td>
            </tr>
            <?php $pneumonia = $data ? json_decode($data->pneumonia_ventilator) : null ?>
            <tr>
                <td colspan="4" class="pl-2">
                    Ventilator
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="ventilator" {{ $pneumonia ? $pneumonia->ventilator->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 1%;">&nbsp;</span>
                    <input type="radio" name="ventilator" {{ $pneumonia ? $pneumonia->ventilator->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    <span style="margin-left: 2%;">&nbsp;</span>
                    Nomor ETT: <input type="text" id="nomor_ett" value="{{ $pneumonia ? $pneumonia->ventilator->nomor_ett : '' }}" class="inputan">
                    <span style="margin-left: 2%;">&nbsp;</span>
                    Tgl Pasang : <input type="text" value="{{ $pneumonia ? $pneumonia->ventilator->tanggal_pasang_dari : '' }}" id="tanggal_pasang_ventilator_dari" class="inputan datepicker" style="width: 10%;"> s/d <input type="text" class="inputan datepicker" value="{{ $pneumonia ? $pneumonia->ventilator->tanggal_pasang_sampai : '' }}" id="tanggal_pasang_ventilator_sampai" style="width: 10%;">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Suhu > 38 &#176 C
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="suhu_ventilator" {{ $pneumonia ? $pneumonia->suhu->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 1%;">&nbsp;</span>
                    <input type="radio" name="suhu_ventilator" {{ $pneumonia ? $pneumonia->suhu->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    <span style="margin-left: 2%;">&nbsp;</span>
                    Hari ke : <input type="text" id="hari_ke_suhu_ventilator" value="{{ $pneumonia ? $pneumonia->suhu->hari_ke : '' }}" style="width: 5%;" class="inputan"> Setelah pemasangan Ventilator
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Sekresi dahak purulen
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="sekresi" {{ $pneumonia ? $pneumonia->sekresi->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 1%;">&nbsp;</span>
                    <input type="radio" name="sekresi" {{ $pneumonia ? $pneumonia->sekresi->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="sekresi" {{ $pneumonia ? $pneumonia->sekresi->value == 'Konsistensi' ? 'checked' : '' : '' }} value="Konsistensi"> Konsistensi : <input type="text" value="{{ $pneumonia ? $pneumonia->sekresi->konsistensi : '' }}" id="konsistensi_sekresi" style="width: 20%;" class="inputan">
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    FIO2 / Po2 (mmHg)
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="fio" {{ $pneumonia ? $pneumonia->fio->value == 'Lebih dari 240 mmHg' ? 'checked' : '' : '' }} value="Lebih dari 240 mmHg"> Lebih dari 240 mmHg, Hari ke : <input type="text" value="{{ $pneumonia ? $pneumonia->fio->hari_ke[0] : '' }}" id="hari_ke_fio_1" style="width: 5%;" class="inputan"> Setelah pemasangan Ventilator <br>
                    <input type="radio" name="fio" {{ $pneumonia ? $pneumonia->fio->value == 'kurang dari 240 mmHg' ? 'checked' : '' : '' }} value="kurang dari 240 mmHg"> kurang dari 240 mmHg, Hari ke : <input type="text" value="{{ $pneumonia ? $pneumonia->fio->hari_ke[1] : '' }}" id="hari_ke_fio_2" style="width: 5%;" class="inputan"> Setelah pemasangan Ventilator
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Foto Thorax
                </td>
                <td colspan="17" class="p-2">
                    <input type="checkbox" id="infitrat" {{ $pneumonia ? in_array('Infitrat', $pneumonia->foto_thorax) ? 'checked' : '' : '' }} value="Infitrat"> Infitrat
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="checkbox" id="merata" {{ $pneumonia ? in_array('Merata', $pneumonia->foto_thorax) ? 'checked' : '' : '' }} value="Merata"> Merata
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="checkbox" id="patchy" {{ $pneumonia ? in_array('Patchy', $pneumonia->foto_thorax) ? 'checked' : '' : '' }} value="Patchy"> Patchy
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="checkbox" id="terlokalisir" {{ $pneumonia ? in_array('Terlokalisir', $pneumonia->foto_thorax) ? 'checked' : '' : '' }} value="Terlokalisir"> Terlokalisir
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Kultur Aspirat / Blopsi
                </td>
                <td colspan="17" class="p-2">
                    <table style="border-collapse: collapse; width:100%;">
                        <tr>
                            <td style="border: 1px solid transparent;"><input type="radio" {{ $pneumonia ? $pneumonia->kultur_aspirat->value == 'Ya' ? 'checked' : '' : '' }} value="Ya" name="kultur_aspirat"> Ya </td>
                            <td style="border: 1px solid transparent;"><input type="radio" {{ $pneumonia ? $pneumonia->kultur_aspirat->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak" name="kultur_aspirat"> Tidak</td>
                            <td style="border: 1px solid transparent; width:5%;"><input type="checkbox" {{ $pneumonia ? $pneumonia->kultur_aspirat->tanggal[0]->check == 1 ? 'checked' : '' : '' }} id="tanggal_kultur_aspirat_1"> Tanggal </td>
                            <td style="border: 1px solid transparent;"> : </td>
                            <td style="border: 1px solid transparent;"><input type="text" value="{{ $pneumonia ? $pneumonia->kultur_aspirat->tanggal[0]->value : '' }}" id="value_tanggal_kultur_aspirat_1" style="width: 10%;" class="inputan datepicker"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid transparent;"></td>
                            <td style="border: 1px solid transparent;"></td>
                            <td style="border: 1px solid transparent;"><input type="checkbox" {{ $pneumonia ? $pneumonia->kultur_aspirat->tanggal[1]->check == 1 ? 'checked' : '' : '' }} id="tanggal_kultur_aspirat_2"> Tanggal </td>
                            <td style="border: 1px solid transparent;"> : </td>
                            <td style="border: 1px solid transparent;"><input type="text" value="{{ $pneumonia ? $pneumonia->kultur_aspirat->tanggal[1]->value : '' }}" id="value_tanggal_kultur_aspirat_2" style="width: 10%;" class="inputan datepicker"> Hasil : <input type="text" id="hasil_kultur_aspirat" style="width: 20%;" class="inputan"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="21" class="text-center font-weight-bold"> INFEKSI LUKA OPERASI</td>
                <?php $ilo = $data ? json_decode($data->infeksi_luka_operasi) : null; ?>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Dilakukan Operasi
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="dilakukan_operasi" {{ $ilo ? $ilo->dilakukan_operasi->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="dilakukan_operasi" {{ $ilo ? $ilo->dilakukan_operasi->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    <span style="margin-left: 2%;">&nbsp;</span>
                    Tanggal : <input type="text" class="inputan datepicker" value="{{ $ilo ? $ilo->dilakukan_operasi->tanggal : '' }}" id="tanggal_dilakukan_operasi">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Tindakan Operasi
                </td>
                <td colspan="17" class="p-2">
                    <input type="text" id="tindakan_operasi" value="{{ $ilo ? $ilo->tindakan_operasi : '' }}" class="form-control inputan">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Nama Dokter Operator
                </td>
                <td colspan="17" class="p-2">
                    <input type="text" id="nama_dokter_operator" value="{{ $ilo ? $ilo->nama_dokter_operator : '' }}" class="form-control inputan">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Nama Dokter Konsultan
                </td>
                <td colspan="17" class="p-2">
                    <input type="text" id="nama_dokter_konsultan" value="{{ $ilo ? $ilo->nama_dokter_konsultan : '' }}" class="form-control inputan">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Sifat Operasi Emergensi
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="sifat_operasi_emergensi" {{ $ilo ? $ilo->sifat_operasi_emergensi == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="sifat_operasi_emergensi" {{ $ilo ? $ilo->sifat_operasi_emergensi == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="2" class="pl-2">
                    Jenis Operasi
                </td>
                <td colspan="19" class="p-2">
                    <input type="checkbox" id="bersih" {{ $ilo ? in_array('Bersih', $ilo->jenis_operasi) ? 'checked' : '' : '' }} value="Bersih"> Bersih
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="checkbox" id="bersih_terkontaminasi" {{ $ilo ? in_array('Bersih Terkontaminasi', $ilo->jenis_operasi) ? 'checked' : '' : '' }} value="Bersih Terkontaminasi"> Bersih Terkontaminasi
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="checkbox" id="kontaminasi" {{ $ilo ? in_array('Kontaminasi', $ilo->jenis_operasi) ? 'checked' : '' : '' }} value="Kontaminasi"> Kontaminasi
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="checkbox" id="kotor" {{ $ilo ? in_array('Kotor', $ilo->jenis_operasi) ? 'checked' : '' : '' }} value="Kotor"> Kotor
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Anestesi Umum
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="anestesi_umum" {{ $ilo ? $ilo->anestesi_umum == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="anestesi_umum" {{ $ilo ? $ilo->anestesi_umum == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Kamar Operasi Nomor
                </td>
                <td colspan="17" class="p-2">
                    <input type="text" id="kamar_operasi_nomor" value="{{ $ilo ? $ilo->kamar_operasi_nomor->value : '' }}" style="width: 30%;" class="inputan">
                    Ronde Ke :<input type="text" id="ronde_ke" value="{{ $ilo ? $ilo->kamar_operasi_nomor->ronde_ke : '' }}" style="width: 30%;" class="inputan">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Menggunakan Implant
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="menggunakan_implant" {{ $ilo ? $ilo->menggunakan_implant == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="menggunakan_implant" {{ $ilo ? $ilo->menggunakan_implant == 'Tidak' ? 'checked' : '' : '' }} value="Tidak">Tidak
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Laparoskopi
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="laparoskopi" {{ $ilo ? $ilo->laparoskopi == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="laparoskopi" {{ $ilo ? $ilo->laparoskopi == 'Tidak' ? 'checked' : '' : '' }} value="Tidak">Tidak
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Lama Operasi
                </td>
                <td colspan="17" class="p-2">
                    <input type="text" id="jam_lama_operasi" value="{{ $ilo ? $ilo->lama_operasi->jam : '' }}" style="width: 20%;" class="inputan">
                    Jam : <input type="text" id="menit_lama_operasi" value="{{ $ilo ? $ilo->lama_operasi->menit : '' }}" style="width: 5%;" class="inputan"> Menit
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Skor ASA
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="skor_asa" {{ $ilo ? $ilo->skor_asa == '1' ? 'checked' : '' : '' }} value="1"> 1
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="skor_asa" {{ $ilo ? $ilo->skor_asa == '2' ? 'checked' : '' : '' }} value="2"> 2
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="skor_asa" {{ $ilo ? $ilo->skor_asa == '3' ? 'checked' : '' : '' }} value="3"> 3
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="skor_asa" {{ $ilo ? $ilo->skor_asa == '4' ? 'checked' : '' : '' }} value="4"> 4
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="skor_asa" {{ $ilo ? $ilo->skor_asa == '5' ? 'checked' : '' : '' }} value="5"> 5
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Dilakukan PA
                </td>
                <td colspan="17" class="p-2">
                    <input type="radio" name="dilakukan_pa" {{ $ilo ? $ilo->dilakukan_pa->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya
                    <span style="margin-left: 2%;">&nbsp;</span>
                    <input type="radio" name="dilakukan_pa" {{ $ilo ? $ilo->dilakukan_pa->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak
                    <span style="margin-left: 2%;">&nbsp;</span>
                    Tanggal : <input type="text" value="{{ $ilo ? $ilo->dilakukan_pa->tanggal : '' }}" id="tanggal_dilakukan_pa" class="inputan datepicker">
                    Hasil : <input type="text" id="hasil_dilakukan_pa" value="{{ $ilo ? $ilo->dilakukan_pa->hasil : '' }}" style="width: 20%;" class="inputan">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">Penanggung Jawab</td>
                <td colspan="17" class="p-2"><input type="text" value="{{ $ilo ? $ilo->penanggung_jawab : '' }}" id="penanggung_jawab" class="form-control inputan"></td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">Tanggal</td>
                @for($i=0; $i< 17; $i++) <td class="p-1"><input type="text" value="{{ $ilo ? isset($ilo->list_satu->tanggal[$i]) ? $ilo->list_satu->tanggal[$i] : '' : '' }}" id="tanggal_infeksi_{{ $i }}" style="width: 100%;" class="inputan datepicker"></td>
                    @endfor
            </tr>
            <tr>
                <td colspan="4" class="pl-2">Hari Ke</td>
                @for($i=0; $i< 17; $i++) <td class="p-1" style="text-align: center">{{ $i+1 }}</td>
                    @endfor
            </tr>
            <tr>
                <td colspan="4" class="pl-2">Drainage</td>
                @for($i=0; $i< 17; $i++) <td class="p-1"> <input value="{{ $ilo ? isset($ilo->list_satu->drainage[$i]) ? $ilo->list_satu->drainage[$i] : '' : '' }}" type="text" id="drainage_{{$i}}" class="form-control inputan"></td>
                    @endfor
            </tr>
            <tr>
                <td colspan="4" class="pl-2">Pus</td>
                @for($i=0; $i< 17; $i++) <td class="p-1"> <input type="text" value="{{ $ilo ? isset($ilo->list_satu->pus[$i]) ? $ilo->list_satu->pus[$i] : '' : '' }}" id="pus_{{$i}}" class="form-control inputan"></td>
                    @endfor
            </tr>
            <tr>
                <td colspan="4" class="pl-2">Perforasi</td>
                @for($i=0; $i< 17; $i++) <td class="p-1"> <input type="text" value="{{ $ilo ? isset($ilo->list_satu->perforasi[$i]) ? $ilo->list_satu->perforasi[$i] : '' : '' }}" id="perforasi_{{$i}}" class="form-control inputan"></td>
                    @endfor
            </tr>
            <tr>
                <td colspan="4" class="pl-2">Fishule </td>
                @for($i=0; $i< 17; $i++) <td class="p-1"> <input type="text" value="{{ $ilo ? isset($ilo->list_satu->fishule[$i]) ? $ilo->list_satu->fishule[$i] : '' : '' }}" id="fishule_{{$i}}" class="form-control inputan"></td>
                    @endfor
            </tr>
            <tr>
                <td colspan="4" class="pl-2">
                    Dilakukan Kultur
                </td>
                <td colspan="17" class="p-2">
                    <table style="border-collapse: collapse; width:100%;">
                        <tr>
                            <td style="border: 1px solid transparent;"><input type="radio" name="dilakukan_kultur" {{ $ilo ? $ilo->dilakukan_kultur->value == 'Ya' ? 'checked' : '' : '' }} value="Ya"> Ya </td>
                            <td style="border: 1px solid transparent;"><input type="radio" name="dilakukan_kultur" {{ $ilo ? $ilo->dilakukan_kultur->value == 'Tidak' ? 'checked' : '' : '' }} value="Tidak"> Tidak</td>
                            <td style="border: 1px solid transparent; width:5%;"><input type="checkbox" {{ $ilo ? $ilo->dilakukan_kultur->tanggal[0] ? $ilo->dilakukan_kultur->tanggal[0]->check == 1 ? 'checked' : '' : '' : '' }} id="check_tanggal_dilakukan_kultur_1"> Tanggal </td>
                            <td style="border: 1px solid transparent;"> : </td>
                            <td style="border: 1px solid transparent;"><input type="text" value="{{ $ilo ? $ilo->dilakukan_kultur->tanggal[0] ? $ilo->dilakukan_kultur->tanggal[0]->value : '' : '' }}" id="tanggal_dilakukan_kultur_1" style="width: 10%;" class="inputan datepicker"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid transparent;"></td>
                            <td style="border: 1px solid transparent;"></td>
                            <td style="border: 1px solid transparent;"><input type="checkbox" {{ $ilo ? $ilo->dilakukan_kultur->tanggal[1] ? $ilo->dilakukan_kultur->tanggal[1]->check == 1 ? 'checked' : '' : '' : '' }} id="check_tanggal_dilakukan_kultur_2"> Tanggal </td>
                            <td style="border: 1px solid transparent;"> : </td>
                            <td style="border: 1px solid transparent;"><input type="text" value="{{ $ilo ? $ilo->dilakukan_kultur->tanggal[1] ? $ilo->dilakukan_kultur->tanggal[1]->value : '' : '' }}" id="tanggal_dilakukan_kultur_2" style="width: 10%;" class="inputan datepicker"> Hasil : <input value="{{ $ilo ? $ilo->dilakukan_kultur->hasil : '' }}" type="text" id="hasil_dilakukan_kultur" style="width: 20%;" class="inputan"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-2">PEMAKAIAN ANTIBIOTIK</td>
                <td colspan="17" class="p-2"><input type="text" id="pemakaian_antibiotik" value="{{ $ilo ? $ilo->pemakaian_antibiotik : '' }}" class="form-control inputan"></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="2" style="text-align: center"> Nama Obat</td>
                <td colspan="5" rowspan="2" style="text-align: center"> Tanggal Pemakaian</td>
                <td colspan="4" rowspan="2" style="text-align: center"> Dosis</td>
                <td colspan="3" rowspan="2" style="text-align: center"> PD / IV / IM</td>
                <td colspan="4" style="text-align: center"> Indikasi</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">Profilaksis</td>
                <td colspan="2" style="text-align: center">Pengobatan</td>
            </tr>
            @for($i=0; $i < 4; $i++) <tr>
                <td colspan="5" class="p-2">{{ $i+1 }}
                    <input type="text" value="{{ $ilo ? isset($ilo->list_dua[$i]) ? $ilo->list_dua[$i]->nama_obat : '' : '' }}" id="operasi_nama_obat_{{ $i }}" style="width: 90%;" class="inputan">
                </td>
                <td class="text-center" colspan="5"><input value="{{ $ilo ? isset($ilo->list_dua[$i]) ? $ilo->list_dua[$i]->tanggal_dari : '' : '' }}" type="text" id="operasi_tanggal_dari_{{ $i }}" style="width: 35%;" class="inputan datepicker"> s/d <input value="{{ $ilo ? isset($ilo->list_dua[$i]) ? $ilo->list_dua[$i]->tanggal_sampai : '' : '' }}" type="text" id="operasi_tanggal_sampai_{{ $i }}" style="width:35%;" class="inputan datepicker"></td>
                <td class="p-2" colspan="4"><input value="{{ $ilo ? isset($ilo->list_dua[$i]) ? $ilo->list_dua[$i]->dosis : '' : '' }}" type="text" id="operasi_dosis_{{ $i }}" class="form-control inputan"></td>
                <td class="p-2" colspan="3"><input type="text" value="{{ $ilo ? isset($ilo->list_dua[$i]) ? $ilo->list_dua[$i]->pd_iv_im : '' : '' }}" id="operasi_pd_iv_im_{{ $i }}" class="form-control inputan"></td>
                <td class="p-2" colspan="4"><input type="text" value="{{ $ilo ? isset($ilo->list_dua[$i]) ? $ilo->list_dua[$i]->indikasi : '' : '' }}" id="operasi_indikasi_{{ $i }}" class="form-control inputan"></td>
                </tr>
                @endfor
        </table>
        <p style="font-style: italic; font-size: 13px">Catatan : beri tanda checklist &#10003; pada setiap jawaban yang dipilih</p>

        <div class="row my-5">
            <div class="col-md-6 text-center">
                Mengetahui <br>
                Dokter yang merawat
                <div id="box_tanda_tangan_dokter" onclick="open_modal_verifikasi('dokter')">
                    @if($data)
                    @if($data->id_dokter != 0)
                    <br>
                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.($dokter ? $dokter->ttd : '') }}" style="width:4cm; height:2.5cm" alt="">
                    <br>
                    ({{ $data->nama_dokter }})
                    @else
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    (..................................................)
                    @endif
                    @else
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    (..................................................)
                    @endif
                </div>
            </div>
            <div class="col-md-6 text-center">
                Bekasi, <input type="text" name="tanggal_verifikasi" value="{{ $data ? $data->tanggal_verifikasi != '0000-00-00' ? date('d-m-Y', strtotime($data->tanggal_verifikasi)) : date('d-m-Y') : date('d-m-Y') }}" class="inputan datepicker" style="width: 10%;"> <br>
                Kepala Ruangan
                <div id="box_tanda_tangan_kepala_ruangan" onclick="open_modal_verifikasi('kepala_ruangan')">
                    @if($data)
                    @if($data->id_kepala_ruangan != 0)
                    <br>
                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.($kepala_ruangan ? $kepala_ruangan->ttd : '') }}" style="width:4cm; height:2.5cm" alt="">
                    <br>
                    ({{ $data->nama_kepala_ruangan }})
                    @else
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    (..................................................)
                    @endif
                    @else
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    (..................................................)
                    @endif
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="modal_verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verif">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" id="password" placeholder="Masukkan password anda" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Verifikasi</button>
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
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#partus_normal_ya').click(function() {
        $('#partus_normal_tidak').prop('checked', false);
    })

    $('#partus_normal_tidak').click(function() {
        $('#partus_normal_ya').prop('checked', false);
    })
</script>

<script>
    function update_dokumen() {
        let tempat_dirawat = [];

        for (let i = 1; i <= 3; i++) {
            tempat_dirawat.push({
                'ruang': $('#ruang_' + i).val(),
                'tanggal_dari': $('#tanggal_dari_' + i).val(),
                'tanggal_sampai': $('#tanggal_sampai_' + i).val(),
                'dokter': $('#dokter_' + i).val(),
            });
        }

        let faktor_resiko = {
            'value': [],
            'partus_normal': $('#partus_normal_ya').is(':checked') ? 'Ya' : ($('#partus_normal_tidak').is(':checked') ? 'Tidak' : '')
        };

        for (let i = 0; i < 10; i++) {
            if ($('#faktor_resiko_' + (i + 1)).is(':checked')) {
                faktor_resiko.value.push($('#faktor_resiko_' + (i + 1)).val());
            } else {
                faktor_resiko.value.push('');
            }
        }

        let list_iadp = [];

        for (let i = 0; i < 4; i++) {
            list_iadp.push({
                'lokasi': $('#iadp_lokasi_' + i).val(),
                'tanggal_dari': $('#iadp_tanggal_dari_' + i).val(),
                'tanggal_sampai': $('#iadp_tanggal_sampai_' + i).val(),
                'suhu': $('#iadp_suhu_' + i).val(),
                'hari_ke': $('#iadp_hari_ke_' + i).val(),
                'nyeri': $('#iadp_nyeri_' + i).val(),
                'merah': $('#iadp_merah_' + i).val(),
                'kalor': $('#iadp_kalor_' + i).val(),
                'pus': $('#iadp_pus_' + i).val(),
                'bengkak': $('#iadp_bengkak_' + i).val(),
            });
        }

        let iadp = {
            'pemasangan': {
                'kateter_v': $('#kateter_v_ya').is(':checked') ? 'Ya' : $('#kateter_v_tidak').is(':checked') ? 'Tidak' : '',
                'kateter_vena': $('#kateter_vena_ya').is(':checked') ? 'Ya' : $('#kateter_vena_tidak').is(':checked') ? 'Tidak' : '',
                'kateter_umbilikal': $('#kateter_umbilikal_ya').is(':checked') ? 'Ya' : $('#kateter_umbilikal_tidak').is(':checked') ? 'Tidak' : '',
            },
            'tujuan_pemasangan': {
                'pemberian_obat': {
                    'antibiotik': $('#antibiotik').is(':checked') ? 1 : 0,
                    'statistika': $('#statistika').is(':checked') ? 1 : 0,
                    'lain': $('#pemberian_obat_lain').val(),
                },
                'transfusi': {
                    'wb': $('#wb').is(':checked') ? 1 : 0,
                    'prc': $('#prc').is(':checked') ? 1 : 0,
                    'ffp': $('#ffp').is(':checked') ? 1 : 0,
                    'trombosit': $('#trombosit').is(':checked') ? 1 : 0,
                },
                'nutrisi_parenteral': {
                    'protein': $('#protein').is(':checked') ? 1 : 0,
                    'lemak': $('#lemak').is(':checked') ? 1 : 0,
                    'glukosa': $('#glukosa').is(':checked') ? 1 : 0,
                    'lain': $('#nutrisi_parenteral_lain').val(),
                },
                'terapi_cairan': {
                    'rl': $('#rl').is(':checked') ? 1 : 0,
                    'nacl': $('#nacl').is(':checked') ? 1 : 0,
                    'kaen': $('#kaen').is(':checked') ? 1 : 0,
                }
            },
            'kultur_darah': {
                'value': $('#kultur_darah_ya').is(':checked') ? 'Ya' : $('#kultur_darah_tidak').is(':checked') ? 'Tidak' : '',
                'tanggal': $('#tanggal_kultur_darah').val(),
                'hasil': $('#hasil_kultur_darah').val(),
            },
            'kultur_pus': {
                'value': $('#kultur_pus_ya').is(':checked') ? 'Ya' : $('#kultur_pus_tidak').is(':checked') ? 'Tidak' : '',
                'tanggal': $('#tanggal_kultur_pus').val(),
                'hasil': $('#hasil_kultur_pus').val(),
            },
            'list': list_iadp
        };

        let list_infeksi_saluran_kemih = [];

        for (let i = 0; i < 5; i++) {
            list_infeksi_saluran_kemih.push({
                'tanggal_dari': $('#isk_tanggal_dari_' + i).val(),
                'tanggal_sampai': $('#isk_tanggal_sampai_' + i).val(),
                'suhu': {
                    'value': $('#isk_suhu_' + i).val(),
                    'hari_ke': $('#isk_hari_ke_' + i + '_1').val()
                },
                'anyang_anyangan': {
                    'value': $('#isk_anyang_anyangan_' + i).val(),
                    'hari_ke': $('#isk_hari_ke_' + i + '_2').val()
                },
                'nyeri_supra': {
                    'value': $('#isk_nyeri_supra_' + i).val(),
                    'hari_ke': $('#isk_hari_ke_' + i + '_3').val()
                },
                'nyeri_berkemih': {
                    'value': $('#isk_nyeri_berkemih_' + i).val(),
                    'hari_ke': $('#isk_hari_ke_' + i + '_4').val()
                },
                'pus': {
                    'value': $('#isk_pus_' + i).val(),
                    'hari_ke': $('#isk_hari_ke_' + i + '_5').val()
                },
            });
        }

        let infeksi_saluran_kemih = {
            'pemasangan': {
                'kateter_urine': $('#kateter_urine_ya').is('checked') ? 'Ya' : $('#kateter_urine_tidak').is('checked') ? 'Tidak' : '',
                'jenis': {
                    'spp': $('#spp').is(':checked') ? 1 : 0,
                    'dauer': $('#dauer').is(':checked') ? 1 : 0,
                    'intermintten': $('#intermintten').is(':checked') ? 1 : 0,
                    'silicone': $('#silicone').is(':checked') ? 1 : 0,
                },
                'tanggal': $('#tanggal_silicone').val(),
            },
            'pemeriksaan': {
                'urine': {
                    'value': $('#isk_urine_ya').is(':checked') ? 'Ya' : $('#isk_urine_tidak').is(':checked') ? 'Tidak' : '',
                    'tanggal': [
                        $('#isk_tanggal_urine_1').val(),
                        $('#isk_tanggal_urine_2').val(),
                    ],
                    'leukosit': [
                        $('#isk_leukosit_urine_1').val(),
                        $('#isk_leukosit_urine_2').val(),
                    ]
                },
                'biakan_urine': {
                    'value': $('#isk_biakan_urine_ya').is(':checked') ? 'Ya' : $('#isk_biakan_urine_tidak').is(':checked') ? 'Tidak' : '',
                    'tanggal': [
                        $('#isk_tanggal_biakan_urine_1').val(),
                        $('#isk_tanggal_biakan_urine_2').val(),
                    ],
                    'leukosit': [
                        $('#isk_leukosit_biakan_urine_1').val(),
                        $('#isk_leukosit_biakan_urine_2').val(),
                    ]
                }
            },
            'list': list_infeksi_saluran_kemih
        }

        let foto_thorax = [];

        if ($('#infitrat').is(':checked')) {
            foto_thorax.push($('#infitrat').val());
        }
        if ($('#merata').is(':checked')) {
            foto_thorax.push($('#merata').val());
        }
        if ($('#patchy').is(':checked')) {
            foto_thorax.push($('#patchy').val());
        }
        if ($('#terlokalisir').is(':checked')) {
            foto_thorax.push($('#terlokalisir').val());
        }

        let pneumonia_ventilator = {
            'ventilator': {
                'value': $('[name=ventilator]:checked').val() != undefined ? $('[name=ventilator]:checked').val() : '',
                'nomor_ett': $('#nomor_ett').val(),
                'tanggal_pasang_dari': $('#tanggal_pasang_ventilator_dari').val(),
                'tanggal_pasang_sampai': $('#tanggal_pasang_ventilator_sampai').val(),
            },
            'suhu': {
                'value': $('[name=suhu_ventilator]:checked').val() != undefined ? $('[name=suhu_ventilator]:checked').val() : '',
                'hari_ke': $('#hari_ke_suhu_ventilator').val(),
            },
            'sekresi': {
                'value': $('[name=sekresi]:checked').val() != undefined ? $('[name=sekresi]:checked').val() : '',
                'konsistensi': $('#konsistensi_sekresi').val(),
            },
            'fio': {
                'value': $('[name=fio]:checked').val() != undefined ? $('[name=fio]:checked').val() : '',
                'hari_ke': [
                    $('#hari_ke_fio_1').val(),
                    $('#hari_ke_fio_2').val(),
                ],
            },
            'foto_thorax': foto_thorax,
            'kultur_aspirat': {
                'value': $('[name=kultur_aspirat]:checked').val() != undefined ? $('[name=kultur_aspirat]:checked').val() : '',
                'tanggal': [{
                    'check': $('#tanggal_kultur_aspirat_1').is(':checked') ? 1 : 0,
                    'value': $('#value_tanggal_kultur_aspirat_1').val(),
                }, {
                    'check': $('#tanggal_kultur_aspirat_2').is(':checked') ? 1 : 0,
                    'value': $('#value_tanggal_kultur_aspirat_2').val(),
                }],
                'hasil': $('#hasil_kultur_aspirat').val()
            }
        }

        let list_satu_tanggal = [];
        let list_satu_drainage = [];
        let list_satu_pus = [];
        let list_satu_perforasi = [];
        let list_satu_fishule = [];
        let list_dua = [];

        for (let i = 0; i < 17; i++) {
            list_satu_tanggal.push($('#tanggal_infeksi_' + i).val());
            list_satu_drainage.push($('#drainage_' + i).val());
            list_satu_pus.push($('#pus_' + i).val());
            list_satu_perforasi.push($('#perforasi_' + i).val());
            list_satu_fishule.push($('#fishule_' + i).val());
        }

        for (let i = 0; i < 4; i++) {
            list_dua.push({
                'nama_obat': $('#operasi_nama_obat_' + i).val(),
                'tanggal_dari': $('#operasi_tanggal_dari_' + i).val(),
                'tanggal_sampai': $('#operasi_tanggal_sampai_' + i).val(),
                'dosis': $('#operasi_dosis_' + i).val(),
                'pd_iv_im': $('#operasi_pd_iv_im_' + i).val(),
                'indikasi': $('#operasi_indikasi_' + i).val(),
            });
        }

        let infeksi_luka_operasi = {
            'dilakukan_operasi': {
                'value': $('[name=dilakukan_operasi]:checked').val() != undefined ? $('[name=dilakukan_operasi]:checked').val() : '',
                'tanggal': $('#tanggal_dilakukan_operasi').val(),
            },
            'tindakan_operasi': $('#tindakan_operasi').val(),
            'nama_dokter_operator': $('#nama_dokter_operator').val(),
            'nama_dokter_konsultan': $('#nama_dokter_konsultan').val(),
            'sifat_operasi_emergensi': $('[name=sifat_operasi_emergensi]:checked').val() != undefined ? $('[name=sifat_operasi_emergensi]:checked').val() : '',
            'jenis_operasi': [
                $('#bersih').is(':checked') ? $('#bersih').val() : '',
                $('#bersih_terkontaminasi').is(':checked') ? $('#bersih_terkontaminasi').val() : '',
                $('#terkontaminasi').is(':checked') ? $('#terkontaminasi').val() : '',
                $('#kotor').is(':checked') ? $('#kotor').val() : '',
            ],
            'anestesi_umum': $('[name=anestesi_umum]:checked').val() != undefined ? $('[name=anestesi_umum]:checked').val() : '',
            'kamar_operasi_nomor': {
                'value': $('#kamar_operasi_nomor').val(),
                'ronde_ke': $('#ronde_ke').val()
            },
            'menggunakan_implant': $('[name=menggunakan_implant]:checked').val() != undefined ? $('[name=menggunakan_implant]:checked').val() : '',
            'laparoskopi': $('[name=laparoskopi]:checked').val() != undefined ? $('[name=laparoskopi]:checked').val() : '',
            'lama_operasi': {
                'jam': $('#jam_lama_operasi').val(),
                'menit': $('#menit_lama_operasi').val(),
            },
            'skor_asa': $('[name=skor_asa]:checked').val() != undefined ? $('[name=skor_asa]:checked').val() : '',
            'dilakukan_pa': {
                'value': $('[name=dilakukan_pa]:checked').val() != undefined ? $('[name=dilakukan_pa]:checked').val() : '',
                'tanggal': $('#tanggal_dilakukan_pa').val(),
                'hasil': $('#hasil_dilakukan_pa').val(),
            },
            'penanggung_jawab': $('#penanggung_jawab').val(),
            'list_satu': {
                'tanggal': list_satu_tanggal,
                'drainage': list_satu_drainage,
                'pus': list_satu_pus,
                'perforasi': list_satu_perforasi,
                'fishule': list_satu_fishule
            },
            'dilakukan_kultur': {
                'value': $('[name=dilakukan_kultur]:checked').val() != undefined ? $('[name=dilakukan_kultur]:checked').val() : '',
                'tanggal': [{
                    'check': $('#check_tanggal_dilakukan_kultur_1').is(':checked') ? 1 : 0,
                    'value': $('#tanggal_dilakukan_kultur_1').val(),
                }, {
                    'check': $('#check_tanggal_dilakukan_kultur_2').is(':checked') ? 1 : 0,
                    'value': $('#tanggal_dilakukan_kultur_2').val(),
                }],
                'hasil': $('#hasil_dilakukan_kultur').val(),
            },
            'pemakaian_antibiotik': $('#pemakaian_antibiotik').val(),
            'list_dua': list_dua
        }

        $('[name=tempat_dirawat]').val(JSON.stringify(tempat_dirawat));
        $('[name=faktor_resiko]').val(JSON.stringify(faktor_resiko));
        $('[name=iadp]').val(JSON.stringify(iadp));
        $('[name=infeksi_saluran_kemih]').val(JSON.stringify(infeksi_saluran_kemih));
        $('[name=pneumonia_ventilator]').val(JSON.stringify(pneumonia_ventilator));
        $('[name=infeksi_luka_operasi]').val(JSON.stringify(infeksi_luka_operasi));

        $('#form_dokumen').submit();
    }
</script>

<script>
    function open_modal_verifikasi(jenis_verif) {
        $('#jenis_verif').val(jenis_verif);
        $('#modal_verif').modal('show');
    }

    $('#form_verif').submit(function(e) {
        e.preventDefault();

        if ($('#password').val() == '') {
            toastr.error('Password harus diisi');
            return;
        }

        $('[name=password]').val($('#password').val());
        update_dokumen();
    })

    $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        toastr.warning('Sedang update dokumen, harap tunggu...');
        $('#modal_verif').modal('hide');
        $('#form_verif')[0].reset();

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/survei_infeksi_rumah_sakit/store') }}",
            data: $('#form_dokumen').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                render_tanda_tangan(response.employee);
            }
        })
    })

    function render_tanda_tangan(employee) {
        var ins = '<br>' +
            `<img src="{{ env('SMIS_UPLOAD_URL') }}/` + employee.ttd + `" style="width:4cm; height:2.5cm" alt="">` +
            '<br>' +
            '('+employee.nama+')';
        $('#jenis_verif').val() == 'dokter' ? $('#box_tanda_tangan_dokter').html(ins) : $('#box_tanda_tangan_kepala_ruangan').html(ins);
    }
</script>
<script>
    $('.datetimepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm'
        },
        useCurrent: false,
        autoUpdateInput: true,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });

    $('.timepicker').daterangepicker({
        locale: {
            format: 'HH:mm'
        },
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY'
        },
        useCurrent: false,
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: false,
        timePicker24Hour: false,
    });

    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>

</html>