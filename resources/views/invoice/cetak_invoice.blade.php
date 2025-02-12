<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Document</title>
    <style>
        * {
            padding-right: 5pt;
        }

        @media print {
            .header {
                background-color: #cccccc !important;
                print-color-adjust: exact;
            }

            .center {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100vh;
            }
        }

        body {
            font-size: 14px;
            font-family: 'Helvetica';
        }

        .font-size {
            font-size: 13pt;
        }

        .text-center {
            text-align: center;
        }

        tfoot td {
            text-align: right;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div style="width: 400px; height: 100px;">
        <div style="float: left; margin-top:8px ;">
            <img style="width: 90px; height: 90px;" src="data:image/jpeg;base64,{{ $logo }}" alt="logo">
        </div>
        <div style="float: left; margin-left: 30px;">
            <h2 style="margin-bottom: 0px;">{{ $setting->nama_perusahaan }}</h2>
            <label>{{ $setting->alamat }}</label>
            <span class="font-size"></span><br>
            <span class="font-size"></span><br>
            <span class="font-size"></span><br>
        </div>
    </div>
    <div style="width:100%; height:50px ;">
        <div style="float: right;">
            <h2 style="font-weight: bold;">INVOICE</h2>
        </div>
    </div>
    <div style="width: 100%;">
        <table width="100%">
            <tr>
                <td style="font-weight: bold; width: 50%;">Kepada:</td>
                <td style="width: 25%; font-weight: bold;">No.Invoice:</td>
                <td style="width: 25%; text-align: right;">{{ $dataHeader->no_invoice }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">{{ $dataHeader->nama_vendor }}</td>
                <td style="width: 25%; font-weight: bold;">Tgl. Invoice:</td>
                <td style="width: 25%; text-align: right;"> {{ $dataHeader->tanggal }}</td>
            </tr>
            <tr>
                <td rowspan="2" style="vertical-align: top;">{{ $dataHeader->alamat }}</td>
                <td style="width: 25%; font-weight: bold;">Term:</td>
                <td style="width: 25%; text-align: right;"> {{ $dataHeader->term }}</td>
            </tr>
            <tr>
                <td style="width: 25%; font-weight: bold;">Tgl. Jatuh Tempo:</td>
                <td style="width: 25%; text-align: right;">{{ $dataHeader->jatuh_tempo }}</td>
            </tr>
        </table>
    </div>
    <div style="width: 100%; margin-top: 10pt;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr class="header"
                    style="text-align: left; height: 40px; border-bottom: 1px solid black; background-color: #cccccc;">
                    <th style="width: 2%;">No.</th>
                    <th>Kode Barang</th>
                    <th style="width: 20%;">Nama Barang</th>
                    <th style="width: 15%;">Qty</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th style="width: 10%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @if (sizeof($dataDetail) < 1)
                    <tr class="text-center">
                        <td colspan="9">Tidak ditemukan barang atau jasa</td>
                    </tr>
                @else
                    @php
                        $totalJumlah = 0;
                    @endphp
                    @foreach ($dataDetail as $d)
                        @php
                            $totalJumlah += $d->jumlah_dipesan;
                        @endphp
                        <tr style="height: 40px; border-bottom: 1.5px solid #cccccc;;">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $d->kode_barang }}</td>
                            <td class="text-center">{{ $d->nama_barang }}</td>
                            <td class="text-center">{{ $d->jumlah_dipesan }}</td>
                            <td class="text-center">{{ $d->satuan }}</td>
                            <td class="text-center">{{ str_replace(',', '.', $d->hna) }}</td>
                            <td style="text-align: center;">{{ $d->diskon }}</td>
                            <td class="text-right">{{ str_replace(',', '.', $d->subtotal) }}</td>
                        </tr>
                    @endforeach
                @endif
                <tr style="height: 40px; border-bottom: 1.5px solid #cccccc;;">
                    <td></td>
                </tr>
            </tbody>
            <tfoot style="text-align: right;">
                <tr style="height: 30px;">
                    <td colspan="3" style="text-align: right; padding-right: 10px;">Total Jumlah Dipesan</td>
                    <td style="text-align: center;">{{ $totalJumlah }}</td>
                    <td colspan="3">Total</td>
                    <td>{{ number_format($dataHeader->total, 0, '.', '.') }}</td>
                </tr>
                <tr style="height: 30px;">
                    <td colspan="7">PPh</td>
                    <td id="th_pph">{{ number_format($dataHeader->jml_pph, 0, '.', '.') }}</td>
                </tr>
                <tr style="height: 30px;">
                    <td colspan="7">PPN</td>
                    <td id="th_ppn">{{ number_format($dataHeader->jml_ppn, 0, '.', '.') }}</td>
                </tr>
                <tr style="height: 30px;">
                    <td colspan="7">Total Akhir</td>
                    <td id="th_tot_ppn">{{ number_format($dataHeader->jml_bayar, 0, '.', '.') }}</td>
                </tr>
                <tr style="">
                    <td>Terbilang: </td>
                    <th colspan="6" class="text-right">Sudah dibayar</th>
                    <th class="text-right" style="border-bottom: 1.5px solid black;">0</th>
                </tr>
                <tr style="">
                    <td colspan="4" style="text-align: left;">{{ $terbilang }}</td>
                    <th colspan="3" class="text-right">Sisa</th>
                    <th class="text-right">
                        {{ number_format($dataHeader->jml_bayar, 0, '.', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    <div style="width: 100%; margin-top: 10pt;">
        <div style="float: left; width: 50%;">
            <div style="width: 300pt; height: 80pt; border: 1px solid black;">
                <p style="margin-top: 1pt; margin-left: 3px;"> Catatan : <br> {{$dataHeader->catatan}} </p>
            </div>
            <div style="margin-top: 10px; line-height: 5pt; ">
                <div id="deskripsi">{!! isset($deskripsi) ? $deskripsi->deskripsi : '' !!}</div>
            </div>
        </div>
        <div style="float: right; margin-top: 0pt;">
            <div style="width: 200pt; text-align: center;">
                <span>Menyetujui,</span> <br>
                <span>{{ $setting->kota }}, {{ tgl_indo(date('Y-m-d')) }}</span> <br>
                <br>
                <img style="display: block; height: 100px; width: 100px;"
                    src="data:image/png;base64, {{ DNS2D::getBarcodePNG($url_invoice, 'QRCODE') }}" alt="Barcode">
                <br>
                <br>
                <span>{{ $setting->nama_penanggungjawab }}</span>
            </div>
        </div>
    </div>
    {{-- <div style="height: 25px; width: 100%; position: relative;"> --}}
    {{-- <h2 style="text-align: center;"> Terima kasih Atas Kerjasamanya</h2> --}}
    {{-- <table style="width: 100%;"> --}}
    {{--     <tr style="text-align: center;"> --}}
    {{--         <th style="font-size: 18pt; font-weight: bold;">Terima kasih Atas Kerjasamanya</th> --}}
    {{--     </tr> --}}
    {{-- </table> --}}
    {{-- </div> --}}

    <?php
    function tgl_indo($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
</body>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" --}}
{{--     integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
{{-- <script> --}}
{{--     $(document).ready(function() { --}}
{{--         <?php if (isset($deskripsi)) { ?> --}}
{{--         var sc = '<?php echo $deskripsi->deskripsi; ?>'; --}}
{{--         $('#deskripsi').html(sc); --}}
{{--         <?php } ?> --}}
{{--         window.print(); --}}
{{--     }); --}}
{{-- </script> --}}

</html>
