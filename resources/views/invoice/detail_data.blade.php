@extends('layouts.app')
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pembuatan Invoice</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input hidden type="text" name="id_vendor" id="id_vendor" value="">
                            <input hidden type="text" name="kode_vendor" id="kode_vendor" value="">
                            <input hidden type="text" name="alamat" id="alamat" value="">
                            <div class="col-lg-3" style="margin-left:-8px;">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input class="form-control" type="text" name="tanggal" id="tanggal"
                                        value="{{ $dataHeader->tanggal }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Jatuh Tempo</label>
                                    <input class="form-control" type="text" name="jatuh_tempo" id="jatuh_tempo"
                                        value="{{ $dataHeader->jatuh_tempo }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">No. Invoice</label>
                                    <input class="form-control" type="text" readonly name="no_opl" id="no_opl"
                                        value="{{ $dataHeader->no_invoice }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">PPh (%)</label>
                                    <input class="form-control" type="text" name="pph" id="pph"
                                        value="{{ $dataHeader->pph . '%' }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Vendor</label>
                                    <input class="form-control" type="text" name="" id=""
                                        value="{{ $dataHeader->nama_vendor }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">PPN</label>
                                    <input class="form-control" type="tex" name="" id=""
                                        value="{{ $dataHeader->ppn . '%' }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <table class="no-wrap table table-bordered table-striped" id="table_faktur">
                                <thead>
                                    <tr class="text-center">
                                        <th width="30px">No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah Dipesan</th>
                                        <th>Satuan</th>
                                        <th>HNA</th>
                                        <th>Diskon</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="list">
                                    @if (sizeof($dataDetail) < 1)
                                        <tr class="text-center">
                                            <td colspan="9">Data tidak ditemukan.</td>
                                        </tr>
                                    @else
                                        @foreach ($dataDetail as $d)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $d->kode_barang }}</td>
                                                <td class="text-center">{{ $d->nama_barang }}</td>
                                                <td class="text-center">{{ $d->jenis_barang }}</td>
                                                <td class="text-center">{{ $d->jumlah_dipesan }}</td>
                                                <td class="text-center">{{ $d->satuan }}</td>
                                                <td class="text-center">{{ str_replace(',', '.', $d->hna) }}</td>
                                                <td class="text-center">{{ $d->diskon }}</td>
                                                <td class="text-center">{{ str_replace(',', '.', $d->subtotal) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="text-right">
                                        <th colspan="8">Total</th>
                                        <th id="total">{{ number_format($dataHeader->total, 0, '.', '.') }}</th>
                                    </tr>
                                    <tr class="text-right">
                                        <th colspan="8">PPh</th>
                                        <th id="th_pph">{{ number_format($dataHeader->jml_pph, 0, '.', '.') }}</th>
                                    </tr>
                                    <tr class="text-right">
                                        <th colspan="8">PPN</th>
                                        <th id="th_ppn">{{ number_format($dataHeader->jml_ppn, 0, '.', '.') }}</th>
                                    </tr>
                                    <tr class="text-right">
                                        <th colspan="8">Total Akhir</th>
                                        <th id="th_tot_ppn">{{ number_format($dataHeader->jml_bayar, 0, '.', '.') }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div style="float:right ;">
                                <a class="btn btn-dark" href="{{ route('invoice.index') }}"
                                    style="color:white; cursor:pointer;">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    <script></script>
@endsection
