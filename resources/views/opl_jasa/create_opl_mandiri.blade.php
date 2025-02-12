@extends('layouts.app')
@section('content')
<link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
<div class="modal fade" id="modalListVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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

<div class="modal fade" id="modalListBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                        <tr class="text-center">
                            <th style="width:3%;">No.</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Jenis Barang</th>
                            <th hidden></th>
                            <th hidden></th>
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
            <h1>Pembuatan PO Jasa</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Pembelian : Pembuatan PO Jasa Mandiri</h4>
                </div>
                <div class="col-lg-12 alert alert-danger" id="msg_error" style="display:none ;"></div>
                <div class="card-body">
                    <div class="row">
                        <input hidden type="text" name="id_header" id="id_header" value=" {{isset($dataHeader) ? $dataHeader->id : ''}}">
                        <input hidden type="text" name="id_vendor" id="id_vendor" value=" {{isset($dataHeader) ? $dataHeader->id_vendor : ''}}">
                        <input hidden type="text" name="kode_vendor" id="kode_vendor" value="  {{isset($dataHeader) ? $dataHeader->kode_vendor : ''}}">
                        <input hidden type="text" name="alamat" id="alamat" value=" {{isset($dataHeader) ? $dataHeader->alamat : ''}}">
                        <div class="col-lg-3" style="margin-left:-8px;">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input class="form-control tanggalan" type="text" name="tanggal" id="tanggal" value="{{isset($dataHeader) ? $dataHeader->tanggal : date('d-m-Y')}}">
                            </div>
                            <div class="form-group">
                                <label for="">PPh (%)</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" name="pph" id="pph" value="{{isset($dataHeader) ? $dataHeader->pph : '' }}" onchange="getPPN(this.value)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">No. PO</label>
                                <input class="form-control" type="text" readonly name="no_opl" id="no_opl" value="{{isset($dataHeader) ? $dataHeader->no_opl : ''}}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Vendor</label>
                                <div class="input-group">
                                    <input class="form-control" name="vendor" id="vendor" type="text" placeholder="Pilih Vendor" value="{{isset($dataHeader) ? $dataHeader->nama_vendor : ''}}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" onclick="showListVendor()"><i class="fas fa-list"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">PPN</label>
                                <select class="form-control" name="ppn" id="ppn" onchange="getPPN(this.value)">
                                    <option value="0" {{isset($dataHeader) && $dataHeader->ppn == 0 ? 'selected' : '' }}>0%</option>
                                    <option value="10" {{isset($dataHeader) && $dataHeader->ppn == 10 ? 'selected' : '' }}>10%</option>
                                    <option value="11" {{isset($dataHeader) && $dataHeader->ppn == 11 ? 'selected' : '' }}>11%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12 row">
                        <div class="col-lg-3" style="">
                            <input hidden type="text" name="hfRowIndex" id="hfRowIndex" value="">
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <div class="input-group">
                                    <input class="form-control" name="nama_barang" id="nama_barang" type="text" placeholder="Pilih Barang" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" onclick="showListBarang()"><i class="fas fa-list"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Kode Barang</label>
                                <input readonly class="form-control" type="text" name="kode_barang" id="kode_barang">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Barang</label>
                                <input readonly class="form-control" type="text" name="jenis_barang" id="jenis_barang">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Dipesan</label>
                                <input class="form-control" type="number" name="jml_disetujui" id="jml_disetujui">
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <input readonly class="form-control" type="text" name="satuan" id="satuan">
                            </div>
                            <div class="form-group">
                                <label for="">Harga Satuan</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="hna" name="hna">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Diskon</label>
                                <input class="form-control" type="text" name="diskon" id="diskon">
                            </div>
                            <div class="form-group">
                                <label for="">T. Diskon</label>
                                <select class="form-control" name="t_diskon" id="t_diskon">
                                    <option value="persen">Persen (%)</option>
                                    <option value="nominal">Nominal (Rp.)</option>
                                </select>
                            </div>
                            <div>
                                <button id="tambah" class="btn btn-primary">Tambahkan</button>
                                <button type='button' id='btnUpdate' class="btn btn-warning" style="display: none;">Update</button>
                                <button type='button' id='btnCancel' class="btn btn-danger" style="display: none;">Cancel</button>
                            </div>
                        </div>
                        <div class="col-lg-9 pt-3" style="">
                            <div style="overflow-x: auto;">
                                <table class="no-wrap table table-bordered table-striped" id="table_faktur">
                                    <thead>
                                        <tr class="text-center">
                                            <th hidden></th>
                                            <th hidden></th>
                                            <th>No.</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Jumlah Dipesan</th>
                                            <th>Satuan</th>
                                            <th>HNA</th>
                                            <th>Diskon</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list">
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-right">
                                            <th colspan="8">Total</th>
                                            <th id="total">{{isset($dataHeader) ? number_format( $dataHeader->total , 0 , '.' , ',' ): 0.000}}</th>
                                        </tr>
                                        <tr class="text-right">
                                            <th colspan="8">PPh</th>
                                            <th id="th_pph">{{isset($dataHeader) ? number_format( $dataHeader->jml_pph , 0 , '.' , ',' ) : 0.000}}</th>
                                        </tr>
                                        <tr class="text-right">
                                            <th colspan="8">PPN</th>
                                            <th id="th_ppn">{{isset($dataHeader) ? number_format( $dataHeader->jml_ppn , 0 , '.' , ',' ) : 0.000}}</th>
                                        </tr>

                                        <tr class="text-right">
                                            <th colspan="8">Total Akhir</th>
                                            <th id="th_tot_ppn">{{isset($dataHeader) ? number_format( $dataHeader->jml_bayar , 0 , '.' , ',' ) : 0.000}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="pt-3" style="text-align:right ;">
                                <a class="btn btn-dark" href="{{url('/pembelian/po-jasa')}}">Kembali</a>
                                <button class="btn btn-info" id="simpan_opl">Simpan PO</button>
                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

<script>
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
        console.log(date2.toLocaleDateString()); //My device lang is en-US
    });
    $(document).ready(function() {
        var id_header = "<?php echo isset($_GET['id_header']) ? $_GET['id_header'] : ''; ?>"
        console.log(id_header);
        if (id_header != "") {
            @foreach($dataDetail as $d)
            var buttonAksi = "<div class='inline-group' style='width:70px;'><a class='btn btn-warning btn-sm edit' href='JavaScript:void(0);'><i class='fas fa-edit'></i></a><a style='margin-left:5px;' class='btn btn-danger btn-sm delete' href='JavaScript:void(0);'><i class='fas fa-trash'></i></a></div>"

            var table = "<tr><td>" + "{{$loop->iteration}}" + "</td><td>" + "{{$d->kode_barang}}" + "</td><td>" + "{{$d->nama_barang}}" + "</td><td>" + "{{$d->jenis_barang}}" +
                "</td><td>" + "{{$d->jumlah_dipesan}}" + "</td><td>" + "{{$d->satuan}}" + "</td><td>" + "{{$d->hna}}" + "</td><td>" + "{{$d->diskon}}" +
                "</td><td>" + "{{$d->subtotal}}" + "</td><td>" + buttonAksi + "</td><td hidden>" + "{{$d->id_header}}" + "</td></tr>";
            $("#list").append(table);

            @endforeach
        } else {

        }

    });
    $('#simpan_opl').on('click', function() {
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
        headerFaktur.no_opl = $('#no_opl').val();
        headerFaktur.vendor = $('#vendor').val();
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
            faktur.kode_barang = row.find("TD").eq(1).html();
            faktur.nama_barang = row.find("TD").eq(2).html();
            faktur.jenis_barang = row.find("TD").eq(3).html();
            faktur.jumlah_dipesan = row.find("TD").eq(4).html();
            faktur.satuan = row.find("TD").eq(5).html();
            faktur.hna = row.find("TD").eq(6).html();
            faktur.diskon = row.find("TD").eq(7).html();
            faktur.subtotal = row.find("TD").eq(8).html();
            faktur.id_detail = row.find("TD").eq(10).html();
            fakturs.push(faktur);
        });
        if (fakturs.length < 1) {
            alert('Silahkan isi data terlebih dulu');
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{url('pembelian/po-jasa/opl-mandiri/store')}}",
            data: JSON.stringify(fakturs),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(r) {
                alert(r);
                window.location.href = "{{url('/pembelian/po-jasa')}}";
            }
        });

    });

    function isValidDataHeader() {
        $("#msg_error").html("");
        $("#msg_error").hide();
        var html_error = "";
        var valid = true;
        var tanggal = $('input[name="tanggal"]').val();
        var vendor = $('input[name="vendor"]').val();
        var jenisBarang = $('input[name="jenis_barang"]').val();
        var pph = $('input[name="pph"]').val();

        if (tanggal == "") {
            valid = false;
            html_error += "<li><strong>Tanggal</strong> tidak diperkenankan kosong.</li>";
        }
        if (vendor == "") {
            valid = false;
            html_error += "<li><strong>Vendor</strong> tidak diperkenankan kosong.</li>";
        }
        if (pph == "") {
            valid = false;
            html_error += "<li><strong>PPh </strong> tidak diperkenankan kosong.</li>";
        }

        if (!valid && html_error.length > 0) {
            $("#msg_error").html("<div class='alert-title'>Peringatan</div><ul>" + html_error + "</ul>");
            $("#msg_error").show();
            $("html, body").animate({
                scrollTop: 0
            }, "slow");

        }
        return valid;


    }

    function isValidDataInput() {
        $("#msg_error").html("");
        $("#msg_error").hide();
        var html_error = "";
        var valid = true;
        var namaBarang = $('input[name="nama_barang"]').val();
        var kodeBarang = $('input[name="kode_barang"]').val();
        var jenisBarang = $('input[name="jenis_barang"]').val();
        var jmlDisetujui = $('input[name="jml_disetujui"]').val();
        var satuan = $('input[name="satuan"]').val();
        var hna = $('input[name="hna"]').val();
        var diskon = $('input[name="diskon"]').val();

        if (namaBarang == "") {
            valid = false;
            html_error += "<li><strong>Nama Barang</strong> tidak diperkenankan kosong.</li>";
        }
        if (kodeBarang == "") {
            valid = false;
            html_error += "<li><strong>Kode Barang</strong> tidak diperkenankan kosong.</li>";
        }
        if (jenisBarang == "") {
            valid = false;
            html_error += "<li><strong>Jenis Barang</strong> tidak diperkenankan kosong.</li>";
        }
        if (jmlDisetujui == "") {
            valid = false;
            html_error += "<li><strong>Jumlah Disetujui</strong> tidak diperkenankan kosong dan inputan hanya boleh menggunakan angka.</li>";
        }
        if (isNaN(parseComa(hna))) {
            valid = false;
            html_error += "<li><strong>HNA</strong> silahkan isi dengan angka.</li>";
        }
        if (satuan == "") {
            valid = false;
            html_error += "<li><strong>Satuan</strong> tidak diperkenankan kosong.</li>";
        }
       
        if (hna == "") {
            valid = false;
            html_error += "<li><strong>HNA</strong> tidak diperkenankan kosong.</li>";
        }
        if (diskon != "" && isNaN(parseComa(diskon))) {
            valid = false;
            html_error += "<li><strong>Diskon</strong> silahkan isi dengan angka.</li>";
        }
        if (!valid && html_error.length > 0) {
            $("#msg_error").html("<div class='alert-title'>Peringatan</div><ul>" + html_error + "</ul>");
            $("#msg_error").show();
            $("html, body").animate({
                scrollTop: 0
            }, "slow");

        }
        return valid;
    }

    $(function() {
        $('#tambah').on('click', function() {
            var kode_barang, nama_barang, jenis_barang, jml_pesan, satuan, hna, diskon, subtotal;
            kode_barang = $("#kode_barang").val();
            nama_barang = $("#nama_barang").val();
            jenis_barang = $("#jenis_barang").val();
            jml_pesan = $("#jml_disetujui").val();
            satuan = $("#satuan").val();
            hna = $("#hna").val();
            var vDiskon = $("#diskon").val() == "" ? "0" : $("#diskon").val();
            diskon = $("#t_diskon").val() === "persen" ? vDiskon + '%' : 'Rp.' + vDiskon;
            var tmpTotal = parseComa(jml_pesan) * parseComa(hna);
            subtotal = getDiskon(tmpTotal);
            var buttonAksi = "<div class='inline-group' style='width:70px;'><a class='btn btn-warning btn-sm edit' href='JavaScript:void(0);'><i class='fas fa-edit'></i></a><a style='margin-left:5px;' class='btn btn-danger btn-sm delete' href='JavaScript:void(0);'><i class='fas fa-trash'></i></a></div>"

            var nIndex = $('#list tr').length + 1;

            if (!isValidDataInput()) {
                return;
            } else {
                var table = "<tr><td>" + nIndex + "</td><td>" + kode_barang + "</td><td>" + nama_barang + "</td><td>" + jenis_barang +
                    "</td><td>" + jml_pesan + "</td><td>" + satuan + "</td><td>" + hna + "</td><td>" + diskon +
                    "</td><td>" + format(subtotal) + "</td><td>" + buttonAksi + "</td></tr>";
                $("#list").append(table);
            }
            clear();
            sumTotalTable();
            getPPN();
            $('html, body').animate({
                scrollTop: $("#table_faktur").offset().top
            }, 500);
        });

        $("#list").on("click", ".edit", function(e) {
            var row = $(this).closest('tr');
            $('#hfRowIndex').val($(row).index());
            var td = $(row).find("td");
            $('#nama_barang').val($(td).eq(2).html());
            $('#kode_barang').val($(td).eq(1).html());
            $('#jenis_barang').val($(td).eq(3).html());
            $('#jml_disetujui').val($(td).eq(4).html());
            $('#satuan').val($(td).eq(5).html());
            $('#hna').val($(td).eq(6).html());
            var lengthTd = $(td).eq(7).html().length;
            if (lengthTd < 4) {
                $(td).eq(7).html().substr(0, 1);
            }

            $('#diskon').val(lengthTd < 4 ? $(td).eq(7).html().substr(0, lengthTd - 1) : $(td).eq(7).html().substr(3, lengthTd));
            $('#tambah').hide();
            $('#btnUpdate').show();
            $('#btnCancel').show();
        });

        $("#list").on("click", ".delete", function(e) {
            var row = $(this).closest('tr');
            id_detail = row.find("TD").eq(12).html();
            if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
                if (id_detail == "") {
                    $(this).closest('tr').remove();
                } else {
                    $(this).closest('tr').remove();
                    $.ajax({
                        url: '{{ url("pembelian/po-jasa/hapus-detail") }}',
                        data: {
                            _token: "{{csrf_token()}}",
                            id_detail: id_detail
                        },
                        success: function(response) {

                        }
                    })

                }
                sumTotalTable();
                getPPN();
            } else {
                e.preventDefault();
            }
        });

        $('#btnUpdate').on('click', function() {
            if (!isValidDataInput()) {
                return;
            } else {

                var kode_barang, nama_barang, jenis_barang, jml_pesan, satuan, hna, diskon, subtotal;
                kode_barang = $("#kode_barang").val();
                nama_barang = $("#nama_barang").val();
                jenis_barang = $("#jenis_barang").val();
                jml_pesan = $("#jml_disetujui").val();
                satuan = $("#satuan").val();
                hna = $("#hna").val();
                var vDiskon = $("#diskon").val() == "" ? " " : $("#diskon").val();
                diskon = $("#t_diskon").val() === "persen" ? vDiskon + '%' : 'Rp.' + vDiskon;
                var tmpTotal = parseComa(jml_pesan) * parseComa(hna);
                subtotal = getDiskon(tmpTotal);

                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(1).html(kode_barang);
                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(2).html(nama_barang)
                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(3).html(jenis_barang)
                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(4).html(jml_pesan)
                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(5).html(satuan)
                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(6).html(hna)
                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(7).html(diskon)
                $('#list tr').eq($('#hfRowIndex').val()).find('td').eq(8).html(subtotal)

                $('#tambah').show();
                $('#btnCancel').hide();
                $('#btnUpdate').hide();
                clear();
                sumTotalTable();
                getPPN();
                $('html, body').animate({
                    scrollTop: $("#table_faktur").offset().top
                }, 500);
            }
        });

        $('#btnCancel').on('click', function() {
            clear();
            $('#tambah').show();
            $('#btnCancel').hide();
            $('#btnUpdate').hide();

        });
    })

    function sumTotalTable() {
        var total = 0;

        $("#list tr > td:nth-child(9)").each(
            (_, el) => total += Number(parseComa($(el).text())) || 0
        );

        $("#total").text(format(total));
    }

    function getPPN() {
        var pph = parseComa($('#pph').val());
        var ppn = parseComa($('#ppn').val());
        var total = parseComa($('#total').text());
        var hasilPPN = 0;
        var totalBayar = 0;
        hasilPPN = (ppn / 100) * total;
        hasilPPH = (pph / 100) * total;
        totalBayar = total - hasilPPH + hasilPPN;
        $('#th_pph').text(format(hasilPPH));
        $('#th_ppn').text(format(hasilPPN));
        $('#th_tot_ppn').text(format(totalBayar));

    }

    function getDiskon(param) {
        var rDiskon = "";
        if ($('#diskon').val() != "") {
            if ($('#t_diskon').val() == "nominal") {
                var totalDiskon = param - parseComa($('#diskon').val());
                rDiskon = format(totalDiskon);
            }
            if ($('#t_diskon').val() == "persen") {
                var potongan = param * ($('#diskon').val() / 100);
                var total = param - potongan;
                rDiskon = format(total);
            }

        } else {
            rDiskon = param;
        }

        return rDiskon;
    }

    function clear() {
        $("#kode_barang").val("");
        $("#nama_barang").val("");
        $("#jenis_barang").val("");
        $("#jml_disetujui").val("");
        $("#satuan").val("");
        $("#hna").val("");
        $("#diskon").val("");
    }

    function parseComa(param) {
        var a = param;
        a = a.replace(/\,/g, '');
        a = Number(a);
        return a;
    }

    function showListBarang() {
        $('#tabelListBarang').dataTable().fnClearTable();
        $('#tabelListBarang').dataTable().fnDestroy();

        $('#tabelListBarang').DataTable({
            serverSide: 'true',
            processing: 'true',
            paging: 'true',
            deferRender: 'true',
            ajax: '{{ url("pembelian/po-jasa/barang") }}',
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
                    data: 'nama_jenis_barang',
                    name: 'nama_jenis_barang',

                },
                {
                    data: 'satuan',
                    name: 'satuan',
                    render: function(data, type, row, meta) {
                        return '<div class="text-center"><button onclick="setBarang(' + "'" + row.nama + "'," + "'" + row.kode + "'," + "'" + row.nama_jenis_barang + "'," + "'" + row.satuan + "'" + ')" class="btn btn-dark"><i class="fas fa-check"></i></button></div>';
                    }
                }
            ]
        });
        $('#modalListBarang').modal('show');
    }

    function setBarang(nama_barang, kode, jenis, satuan) {
        console.log(nama_barang, jenis, kode, satuan);
        $('#nama_barang').val(nama_barang);
        $('#kode_barang').val(kode);
        $('#jenis_barang').val(jenis);
        $('#satuan').val(satuan);
        $('#modalListBarang').modal('hide');
    }

    function showListVendor() {
        $('#tabelListVendor').dataTable().fnClearTable();
        $('#tabelListVendor').dataTable().fnDestroy();

        $('#tabelListVendor').DataTable({
            serverSide: 'true',
            processing: 'true',
            paging: 'true',
            deferRender: 'true',
            ajax: '{{ url("pembelian/po-jasa/vendor") }}',
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
                        return '<div class="text-center"><button onclick="setVendor(' + "'" + row.id + "','" + row.nama + "','" + row.kode + "','" + row.alamat + "'" + ')" class="btn btn-dark"><i class="fas fa-check"></i></button></div>';
                    }
                }
            ]
        });
        $('#modalListVendor').modal('show');
    }

    function setVendor(id, nama, kode, alamat) {
        var splitDate = $('#tanggal').val().split('-');
        $('#vendor').val(nama);
        $('#no_opl').val(id + splitDate[2] + splitDate[1] + splitDate[0]);
        $('#id_vendor').val(id);
        $('#kode_vendor').val(kode);
        $('#alamat').val(alamat);
        $('#modalListVendor').modal('hide');
    }

    $(function() {
        $("#hna").keyup(function(e) {
            $(this).val(format($(this).val()));
        });

        $("#diskon").keyup(function(e) {
            $(this).val(format($(this).val()));
        });

    });
    var format = function(num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
</script>
@endsection