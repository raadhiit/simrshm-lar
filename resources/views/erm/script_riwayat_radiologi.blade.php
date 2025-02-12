<script>
    $("#btn_riwayat_rad").click(function() {
        datatabel_rad();
        $('#modal_riwayat_rad').modal('show');
    });

    function datatabel_rad() {
        if ($.fn.DataTable.isDataTable("#tabel_riwayat_rad")) {
            $('#tabel_riwayat_rad').DataTable().clear().destroy();
        }

        $('#tabel_riwayat_rad').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{ url('ajax_request/riwayat_rad') }}",
                data : {
                    nrm : '{{ $layanan->nrm }}'
                },
            },
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function(data, type, row, meta) {
                        return reformat_tanggal_radiologi(data);
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
                        return convert_json_periksa_radiologi(row.periksa);
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row) {
                        var url = '{{ env("SMIS_URL_RIWAYAT_RAD") }}'+data;
                        return `
                                <div style="display: flex; gap: 10px;">
                                    <a href="${url}" target="_blank" class="btn btn-info" type="button" style="display: flex; align-items: center;">
                                        <i class="fa fa-book mr-1"></i> Hasil
                                    </a>

                                    <button onclick="showFileListRadiologi(${row.file})" type="button" class="btn btn-primary" style="display: flex; align-items: center;">
                                        <i class="fa fa-file mr-1"></i> Lihat File
                                    </button>
                                </div>
                            `;
                    },
                    'className': 'text-center'
                }
            ]
        })
    }

    function convert_json_periksa_radiologi(param){
        let pemeriksaan = <?php echo $pemeriksaan_radiologi; ?>;
        let iterasi_pesanan = 0;
        let periksa = JSON.parse(param.replace(/&quot;/g,'"'));
        let string_pesanan = '';

        for (let j = 0; j < pemeriksaan.length; j++) {
            var temp_slug = 'rad_' + pemeriksaan[j].id;
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

    function reformat_tanggal_radiologi(params) {
        var hasil = "";

        if (params != "" && params !== undefined) {
            if (params.includes(' ')) {
                let arr_datetime = params.split(' ');
                let arr_date = arr_datetime[0].split('-');
                hasil = arr_date[2]+"-"+arr_date[1]+"-"+arr_date[0];
            }else{
                let tmp = params.split("-");
                hasil = tmp[2]+"-"+tmp[1]+"-"+tmp[0];
            }
        }

        return hasil;
    }

    function showFileListRadiologi(files = []) {
        var tbody = $('#tabel_list_file_rad tbody');
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

        $('#modal_list_file_rad').modal('show');
    }

</script>
