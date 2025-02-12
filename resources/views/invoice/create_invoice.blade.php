@extends('layouts.app')
@section('content')
    <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
    <div class="modal fade" id="modalListVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulListVendor">List Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tabelListVendor" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th style="width:3%;">No.</th>
                                <th>Kode</th>
                                <th>Vendor</th>
                                <th>Alamat</th>
                                <th style="width:5%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalListBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulListBarang">List Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tabelListBarang" style="width: 100%;">
                        <thead>
                            <tr class="">
                                <th style="width:3%;">No.</th>
                                <th>Kode</th>
                                <th>Barang</th>
                                <th>Satuan</th>
                                <th style="width:5%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pembuatan Invoice</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Pembelian : Pembuatan Invoice</h4>
                    </div>
                    <div class="col-lg-12 alert alert-danger" id="msg_error" style="display:none ;"></div>
                    <div class="card-body">
                        <div class="row">
                            <input hidden type="text" name="id_header" id="id_header"
                                value="{{ $dataHeader->id ?? 'false' }}">
                            <input hidden type="text" name="id_vendor" id="id_vendor"
                                value=" {{ $dataHeader->id_vendor ?? ' ' }}">
                            <input hidden type="text" name="kode_vendor" id="kode_vendor"
                                value="  {{ $dataHeader->kode_vendor ?? ' ' }}">
                            <input hidden type="text" name="alamat" id="alamat"
                                value=" {{ $dataHeader->alamat ?? ' ' }}">
                            <div class="col-lg-3" style="margin-left:-8px;">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input class="form-control tanggalan" type="text" name="tanggal" id="tanggal"
                                        value="{{ $dataHeader->tanggal ?? date('d-m-Y') }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Jatuh Tempo</label>
                                    <input class="form-control tanggalan" type="text" name="jatuh_tempo" id="jatuh_tempo"
                                        value="{{ $dataHeader->jatuh_tempo ?? date('d-m-Y', strtotime('+1 day')) }}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">No.Invoice</label>
                                    <input class="form-control" type="text" readonly name="no_opl" id="no_opl"
                                        value="{{ $dataHeader->no_invoice ?? ' ' }}">
                                </div>
                                <div class="form-group">
                                    <label for="">PPh (%)</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="pph" id="pph"
                                            value="{{ isset($dataHeader) ? $dataHeader->pph : '' }}"
                                            onchange="getPPN(this.value)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Vendor</label>
                                    <div class="input-group">
                                        <input class="form-control" name="vendor" id="vendor" type="text"
                                            placeholder="Pilih Vendor"
                                            value="{{ isset($dataHeader) ? $dataHeader->nama_vendor : '' }}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="showListVendor()"><i
                                                    class="fas fa-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea name="catatan" id="catatan" class="form-control">{{ $dataHeader->catatan ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">PPN</label>
                                    <select class="form-control" name="ppn" id="ppn"
                                        onchange="getPPN(this.value)">
                                        <option value="0"
                                            {{ isset($dataHeader) && $dataHeader->ppn == 0 ? 'selected' : '' }}>0%</option>
                                        <option value="10"
                                            {{ isset($dataHeader) && $dataHeader->ppn == 10 ? 'selected' : '' }}>10%
                                        </option>
                                        <option value="11"
                                            {{ isset($dataHeader) && $dataHeader->ppn == 11 ? 'selected' : '' }}>11%
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button id="tambah_row" class="btn btn-primary"
                                        style="margin-top: 33px;">Tambah</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="pt-3" style="">
                            <div style="overflow-x: auto;">
                                <table class="no-wrap table table-bordered table-striped" id="table_faktur">
                                    <thead>
                                        <tr class="text-center">
                                            <th hidden></th>
                                            <th hidden></th>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Kode Barang</th>
                                            <th>Qty</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list">
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-right">
                                            <th colspan="7">Total</th>
                                            <th id="total">
                                                {{ isset($dataHeader) ? number_format($dataHeader->total, 0, '.', '.') : 0.0 }}
                                            </th>
                                        </tr>
                                        <tr class="text-right">
                                            <th colspan="7">PPh</th>
                                            <th id="th_pph">
                                                {{ isset($dataHeader) ? number_format($dataHeader->jml_pph, 0, '.', '.') : 0.0 }}
                                            </th>
                                        </tr>
                                        <tr class="text-right">
                                            <th colspan="7">PPN</th>
                                            <th id="th_ppn">
                                                {{ isset($dataHeader) ? number_format($dataHeader->jml_ppn, 0, '.', '.') : 0.0 }}
                                            </th>
                                        </tr>

                                        <tr class="text-right">
                                            <th colspan="7">Total Akhir</th>
                                            <th id="th_tot_ppn">
                                                {{ isset($dataHeader) ? number_format($dataHeader->jml_bayar, 0, '.', '.') : 0.0 }}
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="pt-3" style="text-align:right ;">
                                <a class="btn btn-dark" href="{{ route('invoice.index') }}">Kembali</a>
                                <button class="btn btn-info" id="simpan_invoice">Simpan Invoice</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

    <script src="{{ asset('js/invoice.js') }}"></script>
    <script>
        window.countDataDetail = "{{ count($dataDetail) }}";
        window.createPage = "{{ $create ?? 0 }}";
        $(function() {
            $('.tanggalan').datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                defaultDate: new Date(),
            });
        });

        $('#tanggal').change(function() {
            var date2 = $('#tanggal').datepicker('getDate');
            date2.setDate(date2.getDate() - 1);
            document.getElementById('dtpToDate').innerHTML = date2.toLocaleDateString('en-GB');
        });

        $(document).ready(function() {
            @foreach ($dataDetail as $d)
                var buttonAksi =
                    "<div class='inline-group' style='width:70px;'><a style='margin-left:5px;' class='btn btn-danger btn-sm delete' href='JavaScript:void(0);'><i class='fas fa-trash'></i></a></div>";
                var inputKodeBarang = `
                     <div class="input-group" style='width:300px;'>
                         <input class="form-control" value="{{ $d->nama_barang }}" name="kode_barang" id="kode_barang" type="text" placeholder="Barang">
                         <div class="input-group-append">
                             <button class="btn btn-primary" type="button" onclick="showListBarang(this)">
                                 <i class="fas fa-list"></i>
                             </button>
                         </div>
                         </div>`;

                var inputDiskon = `
                        <div class="input-group" style="width:fit-content; flex-wrap:initial; ">
                            <div class="input-group-append">
                                <select id="diskon_type" class="form-control" style="width:fit-content;" >
                                    <option value="Rp">Rp</option>
                                    <option value="%">%</option>
                                </select>
                            </div>
                            <input style="width:150px;" class="form-control" oninput="sparator(this)" type="text" value="{{ $d->diskon }}">
                        </div>
                    `;

                var tableRow = "<tr>" +
                    "<td>{{ $loop->iteration }}</td>" +
                    "<td>" + inputKodeBarang + "</td>" +
                    "<td> <input style='width:150px;' class='form-control' type='text' value = '{{ $d->kode_barang }}'></td>" +
                    //"<td>{{ $d->jenis_barang }}</td>" +
                    "<td> <input style='width:150px;' class='form-control' type='text' value = '{{ $d->jumlah_dipesan }}'></td>" +
                    "<td>{{ $d->satuan }}</td>" +
                    "<td> <input style='width:150px;' class='form-control' type='text' value = '{{ $d->hna }}'></td>" +
                    "<td>" + inputDiskon + "</td>" +
                    "<td>{{ str_replace(',', '.', $d->subtotal) }}</td>" +
                    "<td class='text-center'>" + buttonAksi + "</td>" +
                    "<td hidden>{{ $d->id_header }}</td>" +
                    "<td hidden>{{ $d->id }}</td>" +
                    "</tr>";

                $("#list").append(tableRow);
            @endforeach

        });

        $('#simpan_invoice').on('click', function() {
            if (!isValidDataHeader()) {
                return;
            }
            var fakturs = new Array();
            var headerFaktur = {};
            headerFaktur.id_header = $('#id_header').val();
            headerFaktur.id_vendor = $('#id_vendor').val();
            headerFaktur.kode_vendor = $('#kode_vendor').val();
            headerFaktur.alamat = $('#alamat').val();
            headerFaktur.tanggal = $('#tanggal').val();
            headerFaktur.jatuh_tempo = $('#jatuh_tempo').val();
            headerFaktur.no_invoice = $('#no_opl').val();
            headerFaktur.vendor = $('#vendor').val();
            headerFaktur.catatan = $('#catatan').val();
            headerFaktur.inc_ppn = $('#inc_ppn').val();
            headerFaktur.ppn = $('#ppn').val();
            headerFaktur.total = parseComa($('#total').text());
            headerFaktur.jml_ppn = parseComa($('#th_ppn').text());
            headerFaktur.jml_pph = parseComa($('#th_pph').text());
            headerFaktur.jml_bayar = parseComa($('#th_tot_ppn').text());
            headerFaktur.pph = $('#pph').val();
            fakturs.push(headerFaktur);
            $("#table_faktur TBODY TR").each(function() {
                var row = $(this);

                var faktur = {};
                faktur.nama_barang = $(this).find('input[name="kode_barang"]').val();
                faktur.kode_barang = row.find("td:eq(2) input").val();
                faktur.jenis_barang = "-";
                faktur.jumlah_dipesan = row.find("td:eq(3) input").val();
                faktur.satuan = row.find("TD").eq(4).html() || "-";
                faktur.hna = row.find("td:eq(5) input").val();
                faktur.diskon = row.find("td:eq(6) input").val() || 0;
                faktur.subtotal = row.find("TD").eq(7).html();
                faktur.id_detail = row.find("TD").eq(10).html();
                fakturs.push(faktur);
            });
            if (fakturs.length < 1) {
                alert('Silahkan isi data terlebih dulu');
                return;
            }

            if ($('#id_header').val() === "false") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('invoice.store') }}",
                    data: JSON.stringify(fakturs),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(r) {
                        alert(r);
                        if (window.countDataDetail == 0) {
                            localStorage.removeItem('invoiceData');
                        }
                        window.location.href = "{{ route('invoice.index') }}";
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            } else {
                var url = "{{ route('invoice.update', ':id') }}";
                url = url.replace(':id', $('#id_header').val());

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "PUT",
                    url: url,
                    data: JSON.stringify(fakturs),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(r) {
                        alert(r);
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            }
        });

        function showListBarang(param) {
            var trElement = $(param).closest('tr');
            var rowIndex = trElement.find('td:eq(0)').text();

            $('#tabelListBarang').dataTable().fnClearTable();
            $('#tabelListBarang').dataTable().fnDestroy();

            $('#tabelListBarang').DataTable({
                serverSide: 'true',
                processing: 'true',
                paging: 'true',
                deferRender: 'true',
                ajax: '{{ url('pembelian/po-jasa/barang') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return (meta.row + 1); // This contains the row index
                        }
                    }, {
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'satuan',
                        name: 'satuan',
                    },
                    {
                        data: 'satuan',
                        name: 'satuan',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center"><button data-rowIndex = "' + rowIndex +
                                '" id="btn_list_barang" class="btn btn-dark"><i class="fas fa-check"></i></button></div>';
                        }
                    }
                ]
            });
            $('#modalListBarang').modal('show');
        }

        function showListVendor() {
            $('#tabelListVendor').dataTable().fnClearTable();
            $('#tabelListVendor').dataTable().fnDestroy();

            $('#tabelListVendor').DataTable({
                serverSide: 'true',
                processing: 'true',
                paging: 'true',
                deferRender: 'true',
                ajax: '{{ url('pembelian/po-jasa/vendor') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return (meta.row + 1); // This contains the row index
                        }
                    }, {
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',

                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        render: function(data, type, row, meta) {
                            return '<div class="text-center"><button onclick="setVendor(' + "'" + row.id +
                                "','" + row.nama + "','" + row.kode + "','" + row.alamat + "'" +
                                ')" class="btn btn-dark"><i class="fas fa-check"></i></button></div>';
                        }
                    }
                ]
            });
            $('#modalListVendor').modal('show');
        }

        $("#list").on("click", ".delete", function(e) {
            var row = $(this).closest('tr');
            id_detail = row.find("TD").eq(10).html();

            var url = "{{ route('invoice.destroy_detail', ['id' => ':id']) }}";
            url = url.replace(':id', id_detail);

            if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
                if (id_detail == "") {
                    $(this).closest('tr').remove();
                } else {
                    $(this).closest('tr').remove();

                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id_detail: id_detail
                        },
                        success: function(response) {
                            alert(response);
                        },
                        error: function(request, status, error) {
                            alert(request.responseText);
                        }
                    })

                }
                sumTotalTable();
                getPPN();
            } else {
                e.preventDefault();
            }
        });

        function setVendor(id, nama, kode, alamat) {
            var splitDate = $('#tanggal').val().split('-');
            $('#vendor').val(nama);
            $('#no_opl').val(id + splitDate[2] + splitDate[1] + splitDate[0]);
            $('#id_vendor').val(id);
            $('#kode_vendor').val(kode);
            $('#alamat').val(alamat);
            $('#modalListVendor').modal('hide');
        }
    </script>
@endsection
