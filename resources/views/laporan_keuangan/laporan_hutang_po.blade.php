@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Hutang PO</h1>
        </div>

        <div class="section-body">
            <div class="row" style="width: 100%; margin-left: 0;">
                <div class="card col-12 pt-3 pb-3">
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <div class="col-4">
                            <div class="form-group mb-3">
                                <label for="">Nama Vendor</label>
                                <select class="form-control" name="nama_vendor" id="nama_vendor">
                                    <option value="semua">Semua</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="semua">Semua</option>
                                    <option value="belum lunas">Belum Lunas</option>
                                    <option value="sudah lunas">Sudah Lunas</option>
                                    <option value="lebih bayar">Lebih Bayar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-3">
                                <label for="">Jenis Faktur</label>
                                <select id="jenis_faktur" name="jenis_faktur" class="form-control">
                                    <option value="semua">Semua</option>
                                    <option value="farmasi">Farmasi</option>
                                    <option value="umum">Umum</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Hutang Outstanding</label>
                                <input type="text" class="form-control" readonly id="outstand">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-3">
                                <label for="">Tanggal Jatuh Tempo</label>
                                <select id="tanggal_jt" name="tanggal_jt" class="form-control">
                                    <option value="0-30">0-30 hari</option>
                                    <option value="30-60">30-60 hari</option>
                                    <option value="60-90">60-90 hari</option>
                                    <option value=">90"> >90 hari</option>
                                    <option value="semua">Semua</option>
                                    <option value="jatuh tempo">Sudah Jatuh Tempo</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <div style="display: inline-flex;" class="mt-4">
                                    <button class="btn btn-success" type="button" id="tmbl_proses" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;">Proses</button>
                                    <button type="button" class="btn btn-primary" id="tmbl_download" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" disabled>Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <form id="fakeForm" action="{{ route('download.excel') }}" style="visibility: hidden;" method="get">
                            <input type="hidden" id="namafile" name="namafile">
                        </form>
                        <div class="col-12 table-responsive">
                            <div id="loadingdownload" class="mb-2 mt-2"></div>
                            <table class="table table-bordered" id="tabellaporan" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; font-weight: bolder;">No</th>
                                        <th style="text-align: center; font-weight: bolder;">Nama Vendor</th>
                                        <th style="text-align: center; font-weight: bolder;">No PO</th>
                                        <th style="text-align: center; font-weight: bolder;">Jenis Faktur</th>
                                        <th style="text-align: center; font-weight: bolder;">No. Faktur</th>
                                        <th style="text-align: center; font-weight: bolder;">Tgl. Faktur</th>
                                        <th style="text-align: center; font-weight: bolder;">Tgl. Jatuh Tempo</th>
                                        <th style="text-align: center; font-weight: bolder;">Total Tagihan</th>
                                        <th style="text-align: center; font-weight: bolder;">Total DIbayar</th>
                                        <th style="text-align: center; font-weight: bolder;">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="show">
                                    <tr class="text-center">
                                        <td colspan="10">Proses terlebih dahulu</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var loading = '<tr class="text-center">' +
        '<td colspan="10">' +
        '<div class="spinner-border spinner-border-sm" role="status">' +
        '</div><span style="padding-left:10px">Sedang memproses data, harap tunggu..</span>' +
        '</td>' +
        '</tr>';

    var loadingdownload = '<div class="alert alert-info">' +
        '<div class="spinner-border spinner-border-sm" role="status">' +
        '</div><span style="padding-left:10px">Sedang menyiapkan file excel, harap tunggu..</span>' +
        '</div>';

    var sukses = '<div class="alert alert-success">' +
        '<span style="padding-left:10px">Selamat, tabel berhasil di export</span>' +
        '</div>';

    var gagal = '<div class="alert alert-danger">' +
        '<span style="padding-left:10px">Terjadi kesalahan</span>' +
        '</div>';

    var kosong = '<tr class="text-center">' +
        '<td colspan="10">' +
        'Tidak ada data' +
        '</td>' +
        '</tr>';

    $('#tmbl_download').on('click', function() {
        $('#loadingdownload').html(loadingdownload);
        $('#tmbl_download').attr('disabled', true);
        $('#tmbl_proses').attr('disabled', true);
        var deta = {
            nama_vendor: $('#nama_vendor').select2('data')[0]['text'],
            jenis_faktur: $('#jenis_faktur').val(),
            tanggal_jt: $('#tanggal_jt').val(),
            status: $('#status').val(),
            outstanding: $('#outstand').val()
        };
        $.ajax({
            url: '{{url("ajax_request/prepare_excel")}}',
            data: deta,
            success: function(response) {
                if (response.status) {
                    isiFileExcel(response.namafile);
                } else {
                    $('#tmbl_download').removeAttr('disabled');
                    $('#tmbl_proses').removeAttr('disabled');
                    $('#loadingdownload').html(gagal);
                }
            }
        })
    })

    function isiFileExcel(namafile) {
        var deta = {
            nama_vendor: $('#nama_vendor').val(),
            jenis_faktur: $('#jenis_faktur').val(),
            tanggal_jt: $('#tanggal_jt').val(),
            status: $('#status').val(),
            nama_file: namafile
        }
        $.ajax({
            url: '{{ url("ajax_request/write_excel") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: deta,
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#loadingdownload').html(sukses);
                $('#tmbl_download').removeAttr('disabled');
                $('#tmbl_proses').removeAttr('disabled');
                fake = document.getElementById('fakeForm');
                $('#namafile').val(response);
                fake.submit();
            }
        })
    }

    $('#tmbl_proses').on('click', function() {
        if ($('#nama_vendor').val() == '' || $('#jenis_faktur') == '' || $('#tanggal_jt').val() == '' || $('#status').val() == '') {
            alert('Filter tidak valid');
        } else {
            $('#loadingdownload').html('');
            var deta = {
                nama_vendor: $('#nama_vendor').val(),
                jenis_faktur: $('#jenis_faktur').val(),
                tanggal_jt: $('#tanggal_jt').val(),
                status: $('#status').val()
            };
            $('#show').html(loading);
            $.ajax({
                url: '{{ url("ajax_request/doing_filter_laporan_hutang_po") }}',
                data: deta,
                success: function(response) {
                    if (response.length <= 0) {
                        $('#show').html(kosong);
                        $('#outstand').val(formatRupiah('0'));
                    } else {
                        var ins = '';
                        var outstand = 0;
                        var tot_tagihan = 0;
                        var tot_bayar = 0;
                        for (let u = 0; u < response.length; u++) {
                            if ((response[u].total_tagihan - response[u].total_dibayar) > 0) {
                                outstand += response[u].total_tagihan - response[u].total_dibayar;
                            }
                            ins += '<tr>' +
                                '<td>' + (u + 1) + '</td>' +
                                '<td>' + response[u].nama_vendor + '</td>' +
                                '<td>' + ( response[u].no_po || 0 ) + '</td>' +
                                '<td>' + ubahTipe(response[u].tipe) + '</td>' +
                                '<td>' + response[u].no_faktur + '</td>' +
                                '<td>' + formatTanggal(response[u].tanggal) + '</td>' +
                                '<td>' + formatTanggal(response[u].tanggal_tempo) + '</td>' +
                                '<td>' + formatRupiah(response[u].total_tagihan) + '</td>' +
                                '<td>' + formatRupiah(response[u].total_dibayar) + '</td>' +
                                '<td>' + cekStatus(response[u].total_dibayar, response[u].total_tagihan) + '</td>' +
                                '</tr>';
                            tot_bayar += response[u].total_dibayar;
                            tot_tagihan += response[u].total_tagihan;
                        }
                        ins += '<tr>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>' + formatRupiah(tot_tagihan) + '</td>' +
                            '<td>' + formatRupiah(tot_bayar) + '</td>' +
                            '<td></td>' +
                            '</tr>';
                        $('#show').html(ins);
                        $('#outstand').val(formatRupiah(outstand));
                        $('#tmbl_download').removeAttr('disabled');
                    }
                }
            })
        }
    })

    function formatTanggal(param) {
        if (param == null || param == '') {
            return '';
        } else {
            var tgl = param.split('-');
            return tgl[2] + '-' + tgl[1] + '-' + tgl[0];
        }
    }

    function ubahTipe(param) {
        if (param == 'reguler') {
            return 'Umum'
        } else if (param == 'farmasi') {
            return 'Farmasi'
        }
    }

    $('#nama_vendor').on('change', function() {
        $('#tmbl_download').attr('disabled', true);
    })

    $('#status').on('change', function() {
        $('#tmbl_download').attr('disabled', true);
    })
    $('#tanggal_jt').on('change', function() {
        $('#tmbl_download').attr('disabled', true);
    })
    $('#jenis_faktur').on('change', function() {
        $('#tmbl_download').attr('disabled', true);
    })

    function formatRupiah(param) {
        if (param === null) {
            return 0;
        } else {
            return param.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    function cekStatus(bayar, tagihan) {
        if (bayar == tagihan) {
            return 'Sudah Lunas';
        } else if (bayar > tagihan) {
            return 'Lebih Bayar'
        } else if (bayar < tagihan) {
            return 'Belum Lunas'
        }
    }

    $(document).ready(function() {
        $('#tanggal_jt').val('semua');
        $('#status').val('belum lunas');

        $('#nama_vendor').select2({
            minimumInputLength: 2,
            theme: 'bootstrap4',
            ajax: {
                url: '{{ url("ajax_request/search_vendor") }}',
                dataType: 'json',
                type: "GET",
                data: function(params) {
                    var queryParameters = {
                        vendor: params.term,
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.items, function(item) {
                            return {
                                text: item.nama,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    });
</script>
@endpush
