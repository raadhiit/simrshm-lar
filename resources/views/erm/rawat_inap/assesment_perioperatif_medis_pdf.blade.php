<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMIS - Assesment Perioperatif Medis</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <style>
        body {
            width: 100%;
            font-size: 9pt;
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
    </style>
</head>

<body>
    <div class="w-100 text-right">MR 02.01.007.REV 0</div>
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

    <table cellpadding="0" class="w-100 mt-2">
        <tr>
            <td colspan="2" class="p-1 border bg-dark text-light text-center">Assesment Perioperatif Medis</td>
        </tr>
        <tr>
            <td colspan="2" class="border p-2">
                <p class="font-weight-bold">
                    Tanggal Asesmen: <span class="input-dotted font-weight-normal mr-1 px-2">{{ old('tanggal_assesment') ?? ($data && $data->tanggal_jam_assesmen ? $data->tanggal_jam_assesmen->format('d/m/Y') : '') }}</span>
                    jam: <span class="input-dotted font-weight-normal mr-1 px-2">{{ old('jam_assesment') ?? ($data && $data->tanggal_jam_assesmen ? $data->tanggal_jam_assesmen->format('H:i') : '') }}</span>
                    oleh: <span class="input-dotted font-weight-normal mr-1 px-2">{{ old('assesment_oleh') ?? ($data && $data->assesment_oleh ? $data->assesment_oleh : '') }}</span>
                    dari: <span class="input-dotted font-weight-normal mr-1 px-2">{{ old('assesment_dari') ?? ($data && $data->assesment_dari ? $data->assesment_dari : '') }}</span>
                </p>
                <table class="w-100">
                    <tr>
                        <td class="align-top font-weight-bold" style="width: 12%;">Asal pasien : </td>
                        <td class="align-top text-left">
                            @foreach(['IGD', 'Poliklinik', 'Rujukan dari luar dokter/klinik', 'Ruang perawatan', 'Lain-lain'] as $index => $asal_pasien)
                            <span class="mr-2">
                                {!! (old('asal_pasien') && old('asal_pasien') == $asal_pasien) || ($data && $data->asal_pasien == $asal_pasien) ? '<span class="mr-1 px-1 border">v</span>' : '<span class="mr-1 px-1 border">&nbsp;</span>' !!}
                                {{ $asal_pasien }}
                                @if ($asal_pasien == 'Lain-lain')
                                : <span class="input-dotted">{!! $data && $data->asal_pasien_lain ? $data->asal_pasien_lain : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' !!}</span>
                                @endif
                            </span>
                            @endforeach
                        </td>
                    </tr>
                </table>
                <div class="w-100 mt-2">
                    <p class="font-weight-bold">I. Assesmen Medis Pra Operasi (diisi oleh dokter)</p>
                    <ol>
                        <li>
                            <div class="font-weight-bold">
                                Anamnesis:
                                <table class="w-100 font-weight-normal">
                                    @foreach([
                                    'a' => 'Keluhan utama',
                                    'b' => 'Riwayat penyakit sekarang',
                                    'c' => 'Riwayat penyakit dahulu',
                                    'd' => 'Riwayat penyakit keluarga',
                                    'e' => 'Riwayat penggunaan obat',
                                    'f' => 'Riwayat alergi obat / makanan / lain-lain',
                                    ] as $index => $anamnesis)
                                    <tr>
                                        <td style="width: 12pt;" class="align-top text-right">{{ $index }}.</td>
                                        <td style="width: 35%;" class="align-top">{{ $anamnesis }}</td>
                                        <td style="width: 8pt" class="align-top">:</td>
                                        <td class="input-dotted align-top">{{ isset($data->anamnesis[$anamnesis]) ? $data->anamnesis[$anamnesis] : '' }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </li>
                        <li>
                            <div class="font-weight-bold">
                                Pemeriksaan Fisik dan Status Generalis:
                                <p class="font-weight-normal">
                                    Keadaan umum: <span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['Keadaan umum']) ? $data->pemeriksaan_fisik['Keadaan umum'] : '' }}</span>,
                                    Kesadaran: <span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['Kesadaran']) ? $data->pemeriksaan_fisik['Kesadaran'] : '' }}</span>,
                                    BB/TB: <span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['BB']) ? $data->pemeriksaan_fisik['BB'] : '' }}</span>kg/<span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['TB']) ? $data->pemeriksaan_fisik['TB'] : '' }}</span>cm</p>
                                <p class="font-weight-normal">
                                    TD: <span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['TD']) ? $data->pemeriksaan_fisik['TD'] : '' }}</span> mmHg,
                                    Nadi: <span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['Nadi']) ? $data->pemeriksaan_fisik['Nadi'] : '' }}</span> x/menit,
                                    Suhu: <span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['Suhu']) ? $data->pemeriksaan_fisik['Suhu'] : '' }}</span> &deg;C,
                                    RR: <span class="input-dotted px-2">{{ isset($data->pemeriksaan_fisik['RR']) ? $data->pemeriksaan_fisik['RR'] : '' }}</span>x/menit</p>
                                <div class="w-100 font-weight-normal input-dotted">Status Generalis:<br />{{ old('status_generalis') ?? ($data && $data->status_generalis ? $data->status_generalis : '') }}</div>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="font-weight-bold">Pemeriksaan Penunjang / Diagnostik:</div>
                            <div class="w-100 font-weight-normal input-dotted">{{ old('pemeriksaan_penunjang_diagnostik') ?? ($data && $data->pemeriksaan_penunjang_diagnostik ? $data->pemeriksaan_penunjang_diagnostik : '') }}</div>
                        </li>
                        <li>
                            <div class="font-weight-bold">Diagnosis Pra Operasi :</div>
                            <div class="w-100 font-weight-normal input-dotted">{{ old('diagnosis_pra_operasi') ?? ($data && $data->diagnosis_pra_operasi ? $data->diagnosis_pra_operasi : '') }}</div>
                        </li>
                        <li>
                            <div class="font-weight-bold">Rencana Tindakan dan Pengobatan:</div>
                            <div class="w-100 font-weight-normal input-dotted">{{ old('rencana_tindakan_pengobatan') ?? ($data && $data->rencana_tindakan_pengobatan ? $data->rencana_tindakan_pengobatan : '') }}</div>
                        </li>
                    </ol>
                </div>
            </td>
        </tr>
        <tr>
            <td class="border text-center font-weight-bold p-2" style="width: 50%;">Diisi Oleh Dokter Yang Melakukan Pengkajian</td>
            <td class="border text-center font-weight-bold p-2" style="width: 50%;">Tanda Tangan & Nama Jelas</td>
        </tr>
        <tr>
            <td class="border p-2 align-top">
                Tanggal dan Jam Selesai<br />
                <div class="w-100 input-dotted">{{ $data && $data->tanggal_jam_selesai ? $data->tanggal_jam_selesai->format('d/m/Y H:i') : '' }}</div>
            </td>
            <td class="border p-2 align-top text-center">
                <div style="height: 128px;" class="d-flex align-items-center justify-content-center">
                    @if ($data && $data->status)
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}" style="height: 100%;object-fit: contain;" alt="">
                    @endif
                </div>
                <div>{{ $dokumen->nama_verifikator ?? '' }}</div>
            </td>
        </tr>
    </table>

    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
</body>

</html>