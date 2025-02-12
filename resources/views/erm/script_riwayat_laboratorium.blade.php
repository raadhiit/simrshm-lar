<script>
    $("#btn_riwayat_lab").click(function() {
        datatabel();
        $('#modal_riwayat_lab').modal('show');
    });

    function datatabel() {
        if ($.fn.DataTable.isDataTable("#tabel_riwayat_lab")) {
            $('#tabel_riwayat_lab').DataTable().clear().destroy();
        }

        $('#tabel_riwayat_lab').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('ajax_request/riwayat_lab') }}",
                data: {
                    nrm: '{{ $layanan->nrm }}'
                },
            },
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function(data, type, row, meta) {
                        return reformat_tanggal(data);
                    }
                },
                {
                    data: 'no_lab',
                    name: 'no_lab'
                },
                {
                    data: 'ruangan',
                    name: 'ruangan',
                    render: function(data, type, row) {
                        return data.replaceAll('_', ' ');
                    }
                },
                {
                    data: 'nama_dokter',
                    name: 'nama_dokter'
                },
                {
                    data: 'periksa',
                    name: 'periksa',
                    render: function(data, type, row) {
                        return convert_json_periksa(row.periksa);
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row) {
                        var url = `{{ env('SMIS_URL_RIWAYAT_LAB') }}${data}`;
                        return `
                                <div style="display: flex; gap: 10px;">
                                    <a href="${url}" target="_blank" class="btn btn-info" type="button" style="display: flex; align-items: center;">
                                        <i class="fa fa-book mr-1"></i> Hasil
                                    </a>

                                    <button onclick="showFileList(${row.file})" type="button" class="btn btn-primary" style="display: flex; align-items: center;">
                                        <i class="fa fa-file mr-1"></i> Lihat File
                                    </button>
                                </div>
                            `;
                    },
                    'className': 'text-center'
                }
            ],
            "columnDefs": [{
                "orderable": false
            }]
        })
    }

    function convert_json_periksa(param) {
        let pemeriksaan = <?php echo $pemeriksaan; ?>;
        let iterasi_pesanan = 0;
        let periksa = JSON.parse(param.replace(/&quot;/g, '"'));
        let string_pesanan = '';

        for (let j = 0; j < pemeriksaan.length; j++) {
            var temp_slug = pemeriksaan[j].slug;
            if (periksa[temp_slug] == 1) {
                if (iterasi_pesanan < 1) {
                    string_pesanan += pemeriksaan[j].nama;
                } else {
                    string_pesanan += ', ' +
                        pemeriksaan[j].nama;
                }
                iterasi_pesanan++;
            }
        }

        return string_pesanan;
    }

    function reformat_tanggal(params) {
        var hasil = "";

        if (params != "" && params !== undefined) {
            if (params.includes(' ')) {
                let arr_datetime = params.split(' ');
                let arr_date = arr_datetime[0].split('-');
                hasil = arr_date[2] + "-" + arr_date[1] + "-" + arr_date[0];
            } else {
                let tmp = params.split("-");
                hasil = tmp[2] + "-" + tmp[1] + "-" + tmp[0];
            }
        }

        return hasil;
    }

    function showFileList(files = []) {
        var tbody = $('#tabel_list_file_lab tbody');
        tbody.empty();

        if (files.length == 0) {
            tbody.append('<tr> <td colspan="2"> Data tidak ditemukan </td> <tr/>');
        }

        files.forEach(function(file, index) {
            console.log(file);
            var url = `{{ env('SMIS_UPLOAD_URL') }}/${file}`;

            var row = `
                <tr>
                    <td>${index + 1}</td> <!-- Nomor urut -->
                    <td><a href="${url}" target="_blank">${file}</a></td> <!-- Link ke file -->
                </tr>
            `;

            tbody.append(row);
        });

        $('#modal_list_file_lab').modal('show');
    }
</script>

