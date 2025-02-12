@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Hutang Non PO</h1>
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
                                    <option value="Belum Selesai">Belum Selesai</option>
                                    <option value="Sudah Selesai">Sudah Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-3">
                                <label for="">Hutang Outstanding</label>
                                <input type="text" class="form-control" readonly id="outstand">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-3">
                                <div style="display: inline-flex; padding-top:30px;">
                                    <button class="btn btn-success" type="button" id="tmbl_proses" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;">Proses</button>
                                    <button type="button" class="btn btn-primary" id="tmbl_download" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" disabled>Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="width: 100%; margin-left: 0;">
                        <form id="fakeForm" action="{{ route('download.excel.laporan_hutang_non_po') }}" style="visibility: hidden;" method="get">
                            <input type="hidden" id="namafile" name="namafile">
                        </form>
                        <div class="col-12 table-responsive">
                            <div id="loadingdownload" class="mb-2 mt-2"></div>
                            <table class="table table-bordered" id="tabellaporan" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; font-weight: bolder;">No</th>
                                        <th style="text-align: center; font-weight: bolder;">Nama Vendor / Karyawan</th>
                                        <th style="text-align: center; font-weight: bolder;">No. Invoice</th>
                                        <th style="text-align: center; font-weight: bolder;">Tgl. Invoice</th>
                                        <th style="text-align: center; font-weight: bolder;">Total Tagihan</th>
                                        <th style="text-align: center; font-weight: bolder;">Total Dibayar</th>
                                        <th style="text-align: center; font-weight: bolder;">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="show">
                                    <tr class="text-center">
                                        <td colspan="7">Proses terlebih dahulu</td>
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
        '<td colspan="7">' +
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
        '<td colspan="7">' +
        'Tidak ada data' +
        '</td>' +
        '</tr>';

    $('#tmbl_download').on('click', function() {
        $('#loadingdownload').html(loadingdownload);
        $('#tmbl_download').attr('disabled', true);
        $('#tmbl_proses').attr('disabled', true);
        var deta = {
            nama_vendor: $('#nama_vendor').select2('data')[0]['text'],
            status: $('#status').val(),
            outstanding: $('#outstand').val()
        };
        $.ajax({
            url: '{{url("ajax_request/prepare_excel/laporan_hutang_non_po")}}',
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
            status: $('#status').val(),
            nama_file: namafile
        }
        $.ajax({
            url: '{{ url("ajax_request/write_excel/laporan_hutang_non_po") }}',
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
        if ($('#nama_vendor').val() == '' || $('#status').val() == '') {
            alert('Filter tidak valid');
        } else {
            $('#loadingdownload').html('');
            var deta = {
                nama_vendor: $('#nama_vendor').val(),
                status: $('#status').val()
            };
            $('#show').html(loading);
            $.ajax({
                url: '{{ url("ajax_request/doing_filter_laporan_hutang_non_po") }}',
                data: deta,
                success: function(response) {
                    console.log(response);
                    if (response.length <= 0) {
                        $('#show').html(kosong);
                        $('#outstand').val(formatRupiah('0'));
                    } else {
                        var ins = '';
                        var outstand = 0;
                        var tot_tagihan = 0;
                        var tot_bayar = 0;
                        for (let u = 0; u < response.length; u++) {
                            outstand += response[u].nilai - response[u].total_terbayar;
                            ins += '<tr>' +
                                '<td>' + (u + 1) + '</td>' +
                                '<td>' + response[u].nama_vendor + '</td>' +
                                '<td>' + response[u].nomor_invoice + '</td>' +
                                '<td>' + formatTanggal(response[u].tanggal_jurnal) + '</td>' +
                                '<td>' + formatRupiah(response[u].nilai) + '</td>' +
                                '<td>' + formatRupiah(response[u].total_terbayar) + '</td>' +
                                '<td>' + response[u].status + '</td>' +
                                '</tr>';
                            tot_bayar += response[u].total_terbayar;
                            tot_tagihan += response[u].nilai;
                        }
                        ins += '<tr>' +
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
        $('#status').val('Belum Selesai');

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