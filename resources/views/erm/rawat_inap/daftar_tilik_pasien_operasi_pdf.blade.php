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
    <div class="w-100 text-right">MR 02.25.001.REV 0</div>
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
            <td class="p-1 border bg-dark text-light text-center">Daftar Tilik Pasien Operasi</td>
        </tr>
        <tr>
            <td class="border p-1">
                <table class="w-100">
                    <tr>
                        <td class="align-top" style="width: 164px;">Tanggal</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">{{ $data && $data->tanggal ? $data->tanggal->format('d/m/Y') : '' }}</td>
                        <td class="align-top" style="width: 164px;">Asal Unit</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">{{ $data && $data->asal_unit ? $data->asal_unit : '' }}</td>
                    </tr>
                    <tr>
                        <td class="align-top">Transfer Ke</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">Kamar Operasi</td>
                        <td class="align-top">Jam Transfer</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">{{ $data && $data->jam_transfer ? Carbon\Carbon::createFromFormat('H:i:s', $data->jam_transfer)->format('H:i') : '' }}</td>
                    </tr>
                    <tr>
                        <td class="align-top">Tindakan / Operasi</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">{{ $data && $data->tindakan_operasi ? $data->tindakan_operasi : '' }}</td>
                        <td class="align-top">Rencana Operasi Jam</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">{{ $data && $data->jam_rencana_operasi ? Carbon\Carbon::createFromFormat('H:i:s', $data->jam_rencana_operasi)->format('H:i') : '' }}</td>
                    </tr>
                    <tr>
                        <td class="align-top">Dokter Spesialis</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">{{ $data && $data->dokter_spesialis ? $data->dokter_spesialis->nama : '' }}</td>
                        <td class="align-top">Spesialis Anestesi</td>
                        <td class="align-top">:</td>
                        <td class="align-top pr-2">
                            {{ $data && $data->dokter_anestesi ? $data->dokter_anestesi->nama : '' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="border p-1">
                <table class="w-100" border="1">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center" style="width: 40%">Daftar Periksa</th>
                            <th class="text-uppercase text-center" style="width: 10%">Ya</th>
                            <th class="text-uppercase text-center" style="width: 10%">Tidak</th>
                            <th class="text-uppercase text-center" style="width: 40%">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([
                        'Berkas rekam medis',
                        'Puasa sesuai ketentuan',
                        'Lepas gigi palsu, kaca mata, kontak lensa, hearing aid, wig telah dilepas dan disimpan',
                        'Gelang identitas terpasang, lengkap, benar',
                        'Edukasi nyeri pasca operasi',
                        'Persetujuan tindakan / operasi',
                        'Persetujuan anestesi',
                        'Penandaan lokasi operasi (Site Marking)',
                        'Asesmen beda dan pra operasi lengkap',
                        'Persiapan darah, termasuk persetujuan transfusi bila ada',
                        'Persiapan implan',
                        'Stabilisasi kondisi pasien' => ['Terpasang Infus', 'Terpasang Kateter'],
                        'Konsul dokter anak',
                        'Konsul dokter penyakit dalam',
                        'Konsul dokter kardiologi',
                        'Konsul dokter anastesi',
                        'Konsul dokter paru',
                        'Golongan darah dan darah tersedia',
                        'Formulir transfer terisi lengkap',
                        'Hasil laboratorium terlampir',
                        'Hasil radiologi, USG, CT Scan, MRI',
                        'Huknah / Klisma',
                        'Kebersihan Pasien (Mandi dengan antiseptic)',
                        'Area operasi di cukur',
                        'Tata rias dan cat kuku di hapus',
                        'Pesan ICU tersedia',
                        ] as $index => $item)
                        @if (!is_array($item))
                        <tr>
                            <td class="align-middle px-1"><span class="mr-2">&bull;</span>{{ $item }}</td>
                            <td class="align-middle text-center">
                                {{ isset($data->daftar_periksa[$item]['nilai']) && $data->daftar_periksa[$item]['nilai'] == 1 ? 'v' : '' }}
                            </td>
                            <td class="align-middle text-center">
                                {{ isset($data->daftar_periksa[$item]['nilai']) && $data->daftar_periksa[$item]['nilai'] == 0 ? 'v' : '' }}
                            </td>
                            <td class="align-middle px-1">{{ isset($data->daftar_periksa[$item]['catatan']) ? $data->daftar_periksa[$item]['catatan'] : '' }}</td>
                        </tr>
                        @else
                        <tr>
                            <td class="px-1"><span class="mr-2">&bull;</span>{{ $index }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($item as $subitem)
                        <tr>
                            <td><span class="mr-2 ml-3">&bull;</span>{{ $subitem }}</td>
                            <td class="align-middle text-center">
                                {{ isset($data->daftar_periksa[$index][$subitem]['nilai']) && $data->daftar_periksa[$index][$subitem]['nilai'] == 1 ? 'v' : '' }}
                            </td>
                            <td class="align-middle text-center">
                                {{ isset($data->daftar_periksa[$index][$subitem]['nilai']) && $data->daftar_periksa[$index][$subitem]['nilai'] == 0 ? 'v' : '' }}
                            </td>
                            <td class="align-middle px-1">{{ isset($data->daftar_periksa[$index][$subitem]['catatan']) ? $data->daftar_periksa[$index][$subitem]['catatan'] : '' }}</td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                        <tr>
                            <td colspan="4" class="p-1">
                                Pesan: {{ $data && $data->pesan ? $data->pesan : '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td class="border p-2">
                <table class="w-100">
                    <tr>
                        <td>
                            <div>Pelaksana daftar tilik:</div>
                            <div style="height: 128px;" class="d-flex align-items-center">
                                @if ($data && $data->status && $data->user_pelaksana)
                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $data->user_pelaksana->hrd_employee->ttd }}" style="height: 100%;object-fit: contain;" alt="">
                                @endif
                            </div>
                            <div>Nama: {{ $data && $data->nama_pelaksana ? $data->nama_pelaksana : '' }}</div>
                        </td>
                        <td>
                            <div>Penerima Pasien:</div>
                            <div style="height: 128px;" class="d-flex align-items-center">
                                @if ($data && $data->status && $dokumen && $dokumen->status && $dokumen->id_verifikator)
                                <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $dokumen->ttd }}" style="height: 100%;object-fit: contain;" alt="">
                                @endif
                            </div>
                            <div>Nama: {{ $dokumen->nama_verifikator ?? '' }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>