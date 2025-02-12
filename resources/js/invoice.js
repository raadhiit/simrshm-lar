var format = function (num) {
    var str = num.toString().replace("", ""),
        parts = false,
        output = [],
        i = 1,
        formatted = null;
    if (str.indexOf(",") > 0) {
        parts = str.split(",");
        str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
        if (str[j] != ".") {
            output.push(str[j]);
            if (i % 3 == 0 && j < (len - 1)) {
                output.push(".");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};

$(document).ready(function () {
    $('#tambah_row').on('click', function () {
        var index = $('#list tr').length + 1
        var input = '<input style="width:150px;" class="form-control" oninput="sparator(this)" type="text">';
        var inputDiskon = `
    <div class="input-group" style="width:fit-content; flex-wrap:initial; ">
        <div class="input-group-append">
            <select id="diskon_type" class="form-control" style="width:fit-content;">
                <option value="Rp">Rp</option>
                <option value="%">%</option>
            </select>
        </div>
        <input style="width:150px;" class="form-control" oninput="sparator(this)" type="text">
    </div>
`;
        var buttonAksi = "<div class='inline-group' style='width:70px;'><a style='margin-left:5px;' class='btn btn-danger btn-sm delete' href='JavaScript:void(0);'><i class='fas fa-trash'></i></a></div>";
        var inputKodeBarang = `
    <div class="input-group" style="width:300px;">
        <input class="form-control" name="kode_barang" id="kode_barang" type="text" placeholder="Barang">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="showListBarang(this)">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>`;


        if (isValidDataHeader()) {
            var tableRow = "<tr>" +
                "<td>" + index + "</td>" +
                "<td>" + inputKodeBarang + "</td>" +
                "<td>" + input + "</td>" +
                "<td>" + input + "</td>" +
                "<td>" + '' + "</td>" +
                "<td>" + input + "</td>" +
                "<td>" + inputDiskon + "</td>" +
                "<td>" + '' + "</td>" +
                "<td class='text-center'>" + buttonAksi + "</td>" +
                "</tr>";
            $("#list").append(tableRow).find('tr:last').fadeIn();
        } else {
            return;
        }

    });

    $("#tabelListBarang").on("click", "#btn_list_barang", function () {
        var row = $(this).closest("tr");

        var kode_barang = row.find("td:eq(1)").text();
        var nama_barang = row.find("td:eq(2)").text();
        var satuan = row.find("td:eq(3)").text();
        var indexRow = $(this).data('rowindex');

        $("#list tr").each(function () {
            var currentNoUrut = $(this).find('td:first').text();
            if (Number(currentNoUrut) === Number(indexRow)) {
                //$(this).find('td:nth-child(2)').text(kode_barang + " - " + nama_barang );
                $(this).find('td:nth-child(3) input').val(kode_barang);
                $(this).find('td:nth-child(5)').text(satuan);
                $(this).find('input[name="kode_barang"]').val(kode_barang + " - " + nama_barang);
            }
        });

        $('#modalListBarang').modal('hide');
    });

    $("#list").on("input change", "input, #diskon_type", function () {
        var row = $(this).closest("tr");

        var qty = parseInt(removeSeparator(row.find("td:eq(3) input").val()) || 0);
        var harga = parseFloat(removeSeparator(row.find("td:eq(5) input").val()) || 0);
        var diskon = row.find("td:eq(6) input").val() || 0;
        var diskonType = row.find("td:eq(6) select").val() || Rp;
        var total;
        if (diskon && diskonType === '%') {
            var diskonPersen = parseFloat(diskon.replace('%', '')) || 0;
            total = (qty * harga) * (1 - diskonPersen / 100);
        } else {
            var diskonNominal = parseFloat(removeSeparator(diskon)) || 0;
            total = (qty * harga) - diskonNominal;
        }
        row.find("td:eq(7)").text(format(total));
        sumTotalTable();
        getPPN();
    });

    $(".duplikasi_button").on("click", function () {
        var id_header = $(this).data("header");
        var route_with_header = window.routeShowInvoice.replace('id_header', id_header);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: route_with_header,
            success: function (response) {
                var dataToSaveString = JSON.stringify(response);

                localStorage.setItem('invoiceData', dataToSaveString);
                createNewRowHeader();
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });

    });

    //Menambahkan draft header dan draft detail secara otomatis
    if (localStorage.getItem('invoiceData')) {
        createNewRowHeader();
    }

    if (window.countDataDetail == 0 && window.createPage == 0) {
        createDetailDraft();
    }

});

window.sparator = function (element) {
    // Hapus karakter selain angka, titik desimal, dan tanda minus di awal string
    let value = $(element).val().replace(/[^\d,-]|(?!^)-/g, "")
        // Menghapus titik desimal yang duplikat, jika ada
        .replace(/^([^.]*\.)(.*$)/, (_, g1, g2) => g1 + g2.replace(/\./g, ''))
        // Menyimpan hanya dua digit setelah titik desimal
        .replace(/\.(\d{2})\d+/, '.$1')
        // Menambahkan separator ribuan
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Set nilai yang diformat kembali ke elemen input
    $(element).val(value);
};

function removeSeparator(angka) {
    angka = angka.toString();
    return Number(angka.replace(/\./g, ''));
}

function createDetailDraft() {
    var storedDataString = localStorage.getItem('invoiceData');
    var storedData = JSON.parse(storedDataString);

    var dataDetail = storedData.dataDetail;
    var dataHeader = storedData.dataHeader;

    var randomNum = Math.floor(Math.random() * 99) + 1;
    var splitDate = $('#tanggal').val().split('-');

    $('#vendor').val(dataHeader.nama_vendor);
    $('#no_opl').val(randomNum + splitDate[2] + splitDate[1] + splitDate[0]);
    $('#id_vendor').val(dataHeader.id_vendor);
    $('#kode_vendor').val(dataHeader.kode_vendor);
    $('#alamat').val(dataHeader.alamat);
    $('#pph').val(dataHeader.pph);
    $('#ppn').val(dataHeader.ppn);


    for (let index = 0; index < dataDetail.length; index++) {
        var inputField = function (value) {
            return '<input style="width:150px;" class="form-control" oninput="sparator(this)" type="text" value="' + value + '">';
        };
        var buttonAksi = "<div class='inline-group' style='width:70px;'><a style='margin-left:5px;' class='btn btn-danger btn-sm delete' href='JavaScript:void(0);'><i class='fas fa-trash'></i></a></div>";
        var inputKodeBarang = `
             <div class="input-group" style="width:300px;">
                 <input value="`+ dataDetail[index].nama_barang + `" class="form-control" name="kode_barang" id="kode_barang" type="text" placeholder="Barang">
                 <div class="input-group-append">
                     <button class="btn btn-primary" type="button" onclick="showListBarang(this)">
                         <i class="fas fa-list"></i>
                     </button>
                 </div>
             </div>`;
       var inputDiskon = `
            <div class="input-group" style="width:fit-content; flex-wrap:initial;">
                <div class="input-group-append">
                    <select id="diskon_type" class="form-control" style="width:fit-content;">
                        <option value="Rp">Rp</option>
                        <option value="%">%</option>
                    </select>
                </div>
                <input style="width:150px;" class="form-control" oninput="sparator(this)" type="text" value="`+ dataDetail[index].diskon + `">
            </div>
        `;

        var tableRow = "<tr>" +
            "<td>" + (index + 1) + "</td>" +
            "<td>" + inputKodeBarang + "</td>" +
            "<td>" + inputField(dataDetail[index].kode_barang) + "</td>" +
            "<td>" + inputField(dataDetail[index].jumlah_dipesan) + "</td>" +
            "<td>" + dataDetail[index].satuan + "</td>" +
            "<td>" + inputField(dataDetail[index].hna) + "</td>" +
            "<td>" + inputDiskon + "</td>" +
            "<td>" + dataDetail[index].subtotal + "</td>" +
            "<td class='text-center'>" + buttonAksi + "</td>" +
            "</tr>";
        $("#list").append(tableRow).find('tr:last').fadeIn();
    }

    sumTotalTable();
    getPPN();
}

function createNewRowHeader() {
    var storedDataString = localStorage.getItem('invoiceData');

    if (storedDataString) {
        delRowDuplicate();

        var index = $('#header-tbody tr').length + 1;
        var storedData = JSON.parse(storedDataString);
        var urlDetail = window.routeShowDetail;

        var dataHeader = storedData.dataHeader;

        var buttonEdit = '<a data-toggle="tooltip" data-placement="top" title="" style="" href="' + urlDetail + '" class="btn btn-warning ml-1" data-original-title="Edit"><i class="fas fa-edit"></i></a>';
        var buttonHapus = '<a onclick="hapusDraft()" data-toggle="tooltip" data-placement="top" title="" style="color:white; cursor:pointer;" class="btn btn-danger ml-1 del_draft" data-original-title="Hapus"><i class="fas fa-trash"></i></a>';
        var tableRow = "<tr class='text-center' >" +
            "<td>" + index + "</td>" +
            "<td style='color:red;' >" + 'draft' + "</td>" +
            "<td>" + '' + "</td>" +
            "<td>" + dataHeader.kode_vendor + "</td>" +
            "<td>" + dataHeader.nama_vendor + "</td>" +
            "<td>" + format(dataHeader.jml_bayar) + "</td>" +
            "<td class='text-center'>" + buttonEdit + buttonHapus + "</td>" +
            "</tr>";
        $("#header-tbody").append(tableRow).find('tr:last').fadeIn();

    } else {
        alert('Data tidak ditemukan coba kembali atau hubungi admin.');
    }
}

function delRowDuplicate() {
    var lastRow = $('#header-tbody tr:last td:eq(1)').text();
    if (lastRow == 'draft') {
        $('#header-tbody tr:last').remove();
    }
}

function sumTotalTable() {
    var total = 0;

    $("#list tr > td:nth-child(8)").each(
        (_, el) => total += Number(parseComa($(el).text())) || 0
    );

    $("#total").text(format(total));
}

window.getPPN = function() {
    var pph = parseComa($('#pph').val());
    var ppn = parseComa($('#ppn').val());
    var total = parseComa($('#total').text());
    var hasilPPN = 0;
    var totalBayar = 0;

    var pphDecimal = pph / 100;
    var ppnDecimal = ppn / 100;

    var hasilPPH = Math.round(pphDecimal * total);
    var hasilPPN = Math.round(ppnDecimal * total);

    totalBayar = total - hasilPPH + hasilPPN;

    $('#th_pph').text(format(hasilPPH));
    $('#th_ppn').text(format(hasilPPN));
    $('#th_tot_ppn').text(format(totalBayar));
}

window.parseComa = function (param) {
    var a = param;
    a = a.replace(/\./g, '');
    a = Number(a);
    return a;
}

window.isValidDataHeader = function () {
    $("#msg_error").html("");
    $("#msg_error").hide();
    var html_error = "";
    var valid = true;
    var tanggal = $('input[name="tanggal"]').val();
    var jatuh_tempo = $('input[name="jatuh_tempo"]').val();
    var vendor = $('input[name="vendor"]').val();
    var pph = $('input[name="pph"]').val();

    if (tanggal == "") {
        valid = false;
        html_error += "<li><strong>Tanggal</strong> tidak diperkenankan kosong.</li>";
    }

    if (jatuh_tempo == "") {
        valid = false;
        html_error += "<li><strong>Tanggal Jatuh Tempo</strong> tidak diperkenankan kosong.</li>";
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

window.hapusDraft = function () {
    $('#header-tbody tr:last td [data-toggle="tooltip"]').tooltip('dispose');
    localStorage.removeItem('invoiceData');
    delRowDuplicate();
}

