<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMIS - Checklist Keselamatan Pasien Operasi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.datetimepicker.css') }}" />
    <style>
        @page {
            margin: 0px;
        }

        body {
            font-size: .75rem;
            margin: 0px;
        }

        .border {
            border: 1px solid black !important;
        }

        .border-left {
            border-left: 1px solid black !important;
        }

        .border-right {
            border-right: 1px solid black !important;
        }

        .border-top {
            border-top: 1px solid black !important;
        }

        .border-bottom {
            border-bottom: 1px solid black !important;
        }

        .border-left-0 {
            border-left: none !important;
        }

        .border-right-0 {
            border-right: none !important;
        }

        .border-top-0 {
            border-top: none !important;
        }

        .border-bottom-0 {
            border-bottom: none !important;
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

<body class="mx-2">
    <div class="w-100 text-right">MR 02.23.001.Rev.2</div>

    <table class="w-100">
        <tr>
            <td class="align-top" style="width: 400px;">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 46px;">
                <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
            </td>
            <td></td>
            <td class="align-top" style="width: 8cm;">
                <div class="py-2 w-100" style="border: 1px solid black;border-radius: 10px;">
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
                </div>
            </td>
        </tr>
    </table>

    <table class="w-100">
        <tr>
            <td class="border font-weight-bold text-uppercase text-center" colspan="3">Checklist Keselamatan Pasien Operasi</td>
        </tr>
        <tr>
            <td class="border font-weight-bold font-italic" colspan="3">*Beri Tanda [v] Pada Tanda [ ]</td>
        </tr>
        <tr>
            <td class="border font-weight-bold text-center" colspan="3">Tanggal: {{ $data && $data->tanggal ? $data->tanggal->format('d/m/Y') : '' }}</td>
        </tr>
        <tr>
            <td class="border font-weight-bold text-center" style="width: 33.33%;">SIGN IN, Jam: {{ $data && $data->sign_in_jam ? $data->sign_in_jam->format('H:i') : '' }} WIB</td>
            <td class="border font-weight-bold text-center" style="width: 33.33%;">TIME OUT, Jam: {{ $data && $data->time_out_jam ? $data->time_out_jam->format('H:i') : '' }} WIB</td>
            <td class="border font-weight-bold text-center" style="width: 33.33%;">SIGN OUT, Jam: {{ $data && $data->sign_out_jam ? $data->sign_out_jam->format('H:i') : '' }} WIB</td>
        </tr>
        <tr>
            <td class="border-bottom border-left align-top p-0">
                <table>
                    <tr>
                        <td class="border border-left-0 border-top-0 text-center align-middle" style="height: 38pt;">Dilakukan Sebelum Induksi Anestesi, Minimalnya Oleh Perawat dan Dokter Anestesi</td>
                        <td class="border border-top-0 text-center align-middle" style="height: 38pt;">Sudah</td>
                        <td class="border border-right-0 border-top-0 text-center align-middle" style="height: 38pt;">Belum</td>
                    </tr>
                    <?php $no = 1; ?>
                    @foreach($sign_in_checklist as $key => $row)

                    @if($no == 5)
                    <tr>
                        <td class="border border-left-0"></td>
                        <td class="border text-center align-middle">Ya</td>
                        <td class="border border-right-0 text-center align-middle">Tidak</td>
                    </tr>
                    @endif

                    @if(is_array($row))
                    <tr>
                        <td class="border-left border-left-0 border-right">{{ $no }}. {{ $key }}</td>
                        <td class="border-left border-right"></td>
                        <td class="border-left border-right-0"></td>
                    </tr>
                    <?php $char = 'abcdefghijklmnopqrstu';
                    $subno = 0; ?>
                    @foreach($row as $subrow)
                    <tr>
                        <td class="border-left border-left-0 border-right pl-4">{{ Str::substr($char, $subno, 1) }}. {{ $subrow }}</td>
                        <td class="border-left border-right text-center"><input type="radio" name="sign_in_checklist[{{ $key }}][{{ $subrow }}]" value="1" {{ $data->getChecklistValue('sign_in_checklist', $subrow) == '1' ? 'checked' : '' }} /></td>
                        <td class="border-left border-right-0 text-center"><input type="radio" name="sign_in_checklist[{{ $key }}][{{ $subrow }}]" value="0" {{ $data->getChecklistValue('sign_in_checklist', $subrow) == '0' ? 'checked' : '' }} /></td>
                    </tr>
                    <?php $subno++; ?>
                    @endforeach
                    @else
                    <tr>
                        <td class="{{ $no == 8 ? 'border-bottom' : '' }} border-left border-left-0 border-right ">{{ $no }}. {{ $row }}</td>
                        <td class="{{ $no == 8 ? 'border-bottom' : '' }} border-left border-right text-center"><input type="radio" name="sign_in_checklist[{{ $row }}]" value="1" {{ $data->getChecklistValue('sign_in_checklist', $row) == '1' ? 'checked' : '' }} /></td>
                        <td class="{{ $no == 8 ? 'border-bottom' : '' }} border-left border-right-0 text-center"><input type="radio" name="sign_in_checklist[{{ $row }}]" value="0" {{ $data->getChecklistValue('sign_in_checklist', $row) == '0' ? 'checked' : '' }} /></td>
                    </tr>
                    @endif
                    <?php $no++; ?>
                    @endforeach
                </table>
            </td>

            <td class="border-bottom align-top p-0">
                <table>
                    <tr>
                        <td class="border border-top-0 border-left text-center align-middle" style="height: 38pt;">Dilakukan Sebelum Insisi Kulit diisi Oleh Perawat, Dokter Anastesi dan Operator</td>
                        <td class="border border-top-0 text-center align-middle" style="height: 38pt;">Sudah</td>
                        <td class="border border-top-0 border-right-0 text-center align-middle" style="height: 38pt;">Belum</td>
                    </tr>
                    <?php $no = 1; ?>
                    @foreach($time_out_checklist as $key => $row)
                    @if(isset($row['subitem']) && is_array($row['subitem']))
                    <tr>
                        <td class="border-right border-left">{{ $no }}. {{ $row['label'] }}</td>
                        <td class="border-right"></td>
                        <td class="border-right"></td>
                    </tr>
                    <?php $char = 'abcdefghijklmnopqrstu';
                    $subno = 0; ?>
                    @foreach($row['subitem'] as $subrow)
                    <tr>
                        <td class="pl-4 border-right border-left">
                            {{ Str::substr($char, $subno, 1) }}. {{ $subrow['label'] }}
                            @if(isset($subrow['input']) && $subrow['input'] == 'text')
                            <input type="text" class="input-dotted rounded-0" name="time_out_checklist[{{ $subrow['label'] }}]" value="{{ $data->getChecklistValue('time_out_checklist', $subrow['label']) }}" />
                            @endif
                        </td>
                        <td class="text-center align-top border-right">
                            @if(isset($subrow['input']) && $subrow['input'] == 'radio')
                            <input type="radio" name="time_out_checklist[{{ $subrow['label'] }}]" value="1" {{ $data->getChecklistValue('time_out_checklist', $subrow['label']) == '1' ? 'checked' : '' }} />
                            @endif
                        </td>
                        <td class="text-center align-top border-right">
                            @if(isset($subrow['input']) && $subrow['input'] == 'radio')
                            <input type="radio" name="time_out_checklist[{{ $subrow['label'] }}]" value="0" {{ $data->getChecklistValue('time_out_checklist', $subrow['label']) == '0' ? 'checked' : '' }} />
                            @endif
                        </td>
                    </tr>
                    <?php $subno++; ?>
                    @endforeach
                    @else
                    <tr>
                        <td class="border-right border-left">
                            {{ $no }}. {{ $row['label'] }}
                            @if(isset($row['input']) && $row['input'] == 'text')
                            <input type="text" class="input-dotted rounded-0" name="time_out_checklist[{{ $row['label'] }}]" value="{{ $data->getChecklistValue('time_out_checklist', $row['label']) }}" />
                            @endif
                        </td>
                        <td class="border-right text-center align-top">
                            @if(isset($row['input']) && $row['input'] == 'radio')
                            <input type="radio" name="time_out_checklist[{{ $row['label'] }}]" value="1" {{ $data->getChecklistValue('time_out_checklist', $row['label']) == '1' ? 'checked' : '' }} />
                            @endif
                        </td>
                        <td class="border-right text-center align-top">
                            @if(isset($row['input']) && $row['input'] == 'radio')
                            <input type="radio" name="time_out_checklist[{{ $row['label'] }}]" value="0" {{ $data->getChecklistValue('time_out_checklist', $row['label']) == '0' ? 'checked' : '' }} />
                            @endif
                        </td>
                    </tr>
                    @endif
                    <?php $no++; ?>
                    @endforeach
                </table>
            </td>

            <td class="border-bottom border-right align-top p-0">
                <table>
                    <tr>
                        <td class="border border-top-0 text-center align-middle" style="height: 38pt;">Sebelum dilakukan Penutupan Daerah Operasi</td>
                        <td class="border border-top-0 text-center align-middle" style="height: 38pt;">Sudah</td>
                        <td class="border border-right-0 border-top-0 text-center align-middle" style="height: 38pt;">Belum</td>
                    </tr>
                    @foreach($sign_out_checklist as $row)

                    @if(isset($row['subitem']) && is_array($row['subitem']))
                    <tr>
                        <td class="border-right">{{ $row['index'] }}. {{ $row['label'] }}</td>
                        <td class="border-right"></td>
                        <td class=""></td>
                    </tr>
                    @foreach($row['subitem'] as $subrow)

                    @if($row['index'] == '1' && $subrow['index'] == 'd')
                    <tr>
                        <td class="border-right border-top border-bottom text-center"></td>
                        <td class="border-right border-top border-bottom text-center">L</td>
                        <td class="border-top border-bottom text-center">TL</td>
                    </tr>
                    @elseif($row['index'] == '1' && $subrow['index'] == 'e')
                    <tr>
                        <td class="border-right border-top border-bottom text-center"></td>
                        <td class="border-right border-top border-bottom text-center">Ya</td>
                        <td class="border-top border-bottom text-center">Tidak</td>
                    </tr>
                    @endif

                    <tr>
                        <td class="border-right pl-4">{!! $subrow['index'] != '' ? $subrow['index'].'. ' : '&nbsp;&nbsp;&nbsp;&nbsp;' !!}{{ $subrow['label'] }}</td>
                        <td class="border-right text-center align-top">@if($subrow['input'] == 'radio') <input type="radio" name="sign_out_checklist[{{ $row['label'] }}][{{ $subrow['label'] }}]" value="1" {{ $data->getChecklistValue('sign_out_checklist', $subrow['label']) == '1' ? 'checked' : '' }} /> @endif</td>
                        <td class="text-center align-top">@if($subrow['input'] == 'radio') <input type="radio" name="sign_out_checklist[{{ $row['label'] }}][{{ $subrow['label'] }}]" value="0" {{ $data->getChecklistValue('sign_out_checklist', $subrow['label']) == '0' ? 'checked' : '' }} /> @endif</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="{{ $row['label'] == 'Hal yang harus diperhatikan:' ? 'border-bottom' : '' }} border-right">
                            {{ $row['index'] != '' ? $row['index'].'. ' : '' }}{{ $row['label'] }}
                            @if(isset($row['input']) && $row['input'] == 'textarea')
                            <br /><textarea name="sign_out_checklist[{{ $row['label'] }}]" rows="4" class="input-dotted rounded-0 w-100">{{ $data->getChecklistValue('sign_out_checklist', $row['label']) }}</textarea>
                            @endif
                        </td>
                        <td class="{{ $row['label'] == 'Hal yang harus diperhatikan:' ? 'border-bottom' : '' }} border-right text-center align-top">@if(isset($row['input']) && $row['input'] == 'radio') <input type="radio" name="sign_out_checklist[{{ $row['label'] }}]" value="1" {{ $data->getChecklistValue('sign_out_checklist', $row['label']) == '1' ? 'checked' : '' }} /> @endif</td>
                        <td class="{{ $row['label'] == 'Hal yang harus diperhatikan:' ? 'border-bottom' : '' }} text-center align-top">@if(isset($row['input']) && $row['input'] == 'radio') <input type="radio" name="sign_out_checklist[{{ $row['label'] }}]" value="0" {{ $data->getChecklistValue('sign_out_checklist', $row['label']) == '0' ? 'checked' : '' }} /> @endif</td>
                    </tr>
                    @endif
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="p-0">
                <table class="w-100">
                    <tr>
                        <td class="border-right border-bottom border-left text-center">
                            {{ Str::title(Str::replace('_', ' ', 'perawat_sirkuler')) }}
                            @if($data->sign_in_status_perawat_sirkuler && $data->sign_in_perawat_sirkuler)
                            <br />
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->sign_in_perawat_sirkuler ? $data->sign_in_perawat_sirkuler->hrd_employee ? $data->sign_in_perawat_sirkuler->hrd_employee->ttd : '' : '') }}" style="height: 43pt;object-fit: contain;" />
                            <br />
                            {{ $data->sign_in_perawat_sirkuler->hrd_employee->nama }}
                            @else
                            <br />
                            <br />
                            <br />
                            <br />
                            (..............................)
                            @endif
                        </td>
                        <td class="border-right border-bottom text-center">
                            {{ Str::title(Str::replace('_', ' ', 'dokter_anastesi')) }}
                            @if($data->sign_in_status_dokter_anastesi && $data->sign_in_dokter_anastesi)
                            <br />
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->sign_in_dokter_anastesi ? $data->sign_in_dokter_anastesi->hrd_employee ? $data->sign_in_dokter_anastesi->hrd_employee->ttd : '' : '') }}" style="height: 43pt;object-fit: contain;" />
                            <br />
                            {{ $data->sign_in_dokter_anastesi->hrd_employee->nama }}
                            @else
                            <br />
                            <br />
                            <br />
                            <br />
                            (..............................)
                            @endif
                        </td>
                        <td class="border-right border-bottom text-center">
                            {{ Str::title(Str::replace('_', ' ', 'perawat_sirkuler')) }}
                            @if($data->time_out_status_perawat_sirkuler && $data->time_out_perawat_sirkuler)
                            <br />
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->time_out_perawat_sirkuler ? $data->time_out_perawat_sirkuler->hrd_employee ? $data->time_out_perawat_sirkuler->hrd_employee->ttd : '' : '') }}" style="height: 43pt;object-fit: contain;" />
                            <br />
                            {{ $data->time_out_perawat_sirkuler->hrd_employee->nama }}
                            @else
                            <br />
                            <br />
                            <br />
                            <br />
                            (..............................)
                            @endif
                        </td>
                        <td class="border-right border-bottom text-center">
                            {{ Str::title(Str::replace('_', ' ', 'perawat_instrumen')) }}
                            @if($data->time_out_status_perawat_instrumen && $data->time_out_perawat_instrumen)
                            <br />
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->time_out_perawat_instrumen ? $data->time_out_perawat_instrumen->hrd_employee ? $data->time_out_perawat_instrumen->hrd_employee->ttd : '' : '') }}" style="height: 43pt;object-fit: contain;" />
                            <br />
                            {{ $data->time_out_perawat_instrumen->hrd_employee->nama }}
                            @else
                            <br />
                            <br />
                            <br />
                            <br />
                            (..............................)
                            @endif
                        </td>
                        <td class="border-right border-bottom text-center">
                            {{ Str::title(Str::replace('_', ' ', 'dokter_bedah')) }}
                            @if($data->sign_out_status_dokter_bedah && $data->sign_out_dokter_bedah)
                            <br />
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->sign_out_dokter_bedah ? $data->sign_out_dokter_bedah->hrd_employee ? $data->sign_out_dokter_bedah->hrd_employee->ttd : '' : '') }}" style="height: 43pt;object-fit: contain;" />
                            <br />
                            {{ $data->sign_out_dokter_bedah->hrd_employee->nama }}
                            @else
                            <br />
                            <br />
                            <br />
                            <br />
                            (..............................)
                            @endif
                        </td>
                        <td class="border-right border-bottom text-center">
                            {{ Str::title(Str::replace('_', ' ', 'dokter_anastesi')) }}
                            @if($data->sign_out_status_dokter_anastesi && $data->sign_out_dokter_anastesi)
                            <br />
                            <img src="{{ env('SMIS_UPLOAD_URL') . '/' . ($data->sign_out_dokter_anastesi ? $data->sign_out_dokter_anastesi->hrd_employee ? $data->sign_out_dokter_anastesi->hrd_employee->ttd : '' : '') }}" style="height: 43pt;object-fit: contain;" />
                            <br />
                            {{ $data->sign_out_dokter_anastesi->hrd_employee->nama }}
                            @else
                            <br />
                            <br />
                            <br />
                            <br />
                            (..............................)
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
</body>

</html>