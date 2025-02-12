    $(document).ready(function() {
        $('#uploadFormManual').on('submit', function(e) {
            e.preventDefault();

            // Create form data object
            var formData = new FormData(this);

            $.ajax({
                url: routeCasemixUpload, // URL route ke upload file
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting content type
                success: function(response) {
                    $('#modal_upload').modal('hide');
                    alert(response.message);
                    open_modal_status(response.noreg);
                },
                error: function(response) {
                    alert('File upload failed');
                }
            });
        });

        $('#btn_merge_dokumen').on('click', function() {
            var dataId = $(this).attr('data-id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: routeMergeDocument,
                method: 'POST',
                data: {
                    id: dataId
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                     alert('Success: Merged Dokumen CASEMIX');
                    var route = routeDownload;
                    var filePath = encodeURIComponent(response.file);
                    var fullUrl = `${route}?file_path=${filePath}`;

                    window.open(fullUrl, '_blank');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Error:', error);
                }
            });
        });

    });

    window.open_modal_status = function (params) {
        $('#modal_status').modal('show');
        $('#tbody_list_dokumen2').empty();
        $('#btn_merge_dokumen').attr('data-id', params);
        $.ajax({
            url: routeCasemixCheckFolder,
            data: {
                noreg: params,
            },
            success: function(response) {
                const data = [{
                        kode: 1,
                        persyaratan: "SEP Rajal",
                        ada: false
                    },
                    {
                        kode: 2,
                        persyaratan: "Surat Rujukan Online (Ke RS Harmul dan Dari RS Harmul)",
                        ada: false
                    },
                    {
                        kode: 4,
                        persyaratan: "Surat Rencana Kontrol Online",
                        ada: false
                    },
                    {
                        kode: 7,
                        persyaratan: "Surat kontrol manual",
                        ada: false
                    },
                    {
                        kode: 8,
                        persyaratan: "surat kontrol post ranap",
                        ada: false
                    },
                    {
                        kode: 9,
                        persyaratan: "Surat Rujukan internal",
                        ada: false
                    },
                    {
                        kode: 10,
                        persyaratan: "Surat rujukan FKTP",
                        ada: false
                    },
                    {
                        kode: 11,
                        persyaratan: "Print usg obgyn",
                        ada: false
                    },
                    {
                        kode: 12,
                        persyaratan: "Bukti pendaftaran rajal",
                        ada: false
                    },
                    {
                        kode: 14,
                        persyaratan: "Rincian Obat / farmasi",
                        ada: false
                    },
                    {
                        kode: 18,
                        persyaratan: "Bilingan / rincian kasir",
                        ada: false
                    },
                    {
                        kode: 15,
                        persyaratan: "Hasil Laboratorium",
                        ada: false
                    },
                    {
                        kode: 16,
                        persyaratan: "Hasil Radiologi",
                        ada: false
                    },
                    {
                        kode: 17,
                        persyaratan: "Hasil usg urologi",
                        ada: false
                    },
                    {
                        kode: 27,
                        persyaratan: "Triase",
                        ada: false
                    },
                    {
                        kode: 28,
                        persyaratan: "Hasil Echocardiography",
                        ada: false
                    },
                    {
                        kode: 29,
                        persyaratan: "EKG",
                        ada: false
                    },
                    {
                        kode: 30,
                        persyaratan: "Treadmil",
                        ada: false
                    },
                    {
                        kode: 31,
                        persyaratan: "Laporan pembedahan",
                        ada: false
                    },
                    {
                        kode: 32,
                        persyaratan: "Kronologis",
                        ada: false
                    },
                    {
                        kode: 33,
                        persyaratan: "Surat kematian",
                        ada: false
                    }
                ];

                const data2 = [{
                        kode: 1,
                        persyaratan: "SEP Rajal",
                        ada: false
                    },
                    {
                        kode: 2,
                        persyaratan: "Surat Rujukan online",
                        ada: false
                    },
                    {
                        kode: 6,
                        persyaratan: "Surat rujukan internal (bila ada)",
                        ada: false
                    },
                    {
                        kode: 34,
                        persyaratan: "Progam pelayanan fisioterapi",
                        ada: false
                    },
                    {
                        kode: 12,
                        persyaratan: "Bukti pendaftaran rajal",
                        ada: false
                    },
                    {
                        kode: 18,
                        persyaratan: "Bilingan kasir",
                        ada: false
                    },
                    {
                        kode: 35,
                        persyaratan: "Lembar formulir layanan kedokteran fisik dan rehabilitasi",
                        ada: false
                    },
                    {
                        kode: 36,
                        persyaratan: "Lembar hasil tindakan uji fungsi prosedur kedokteran fisik dan rehabilitasi",
                        ada: false
                    }
                ];
                $('#tbody_list_dokumen').empty();
                if (response.status) {
                    response.data.forEach(element => {
                        // get character before underscore
                        let kode = parseInt(element.split('_')[0]);

                        // find index array by unix
                        objIndex = data.findIndex(obj => obj.kode == kode);
                        if (objIndex != -1) {
                            data[objIndex].ada = true;
                        }

                        objIndex2 = data2.findIndex(obj => obj.kode == kode);
                        if (objIndex2 != -1) {
                            data2[objIndex2].ada = true;
                        }
                    });
                    render_list_dokumen(data, data2, response.noreg);
                }
            }
        });
    }

    window.showUpload = function (noreg, code_document, name_document){
        $('#noreg_hidden').val('');
        $('#document_code_hidden').val('');
        $('#name_document_hidden').val('');

        $('#noreg_hidden').val(noreg);
        $('#document_code_hidden').val(code_document);
        $('#name_document_hidden').val(name_document);

        $('#modal_upload').modal('show');
    }

    function render_list_dokumen(params, params2, noreg) {
        var html = "";
        var btn = "";
        $('#tbody_list_dokumen').empty();
        params.forEach(element => {
            btn = `<button onclick="showUpload('${noreg}', '${element.kode}', '${element.persyaratan}')" data-toggle="tooltip" title="Upload Dokumen" class="btn btn-info" type="button"><i class="fas fa-upload"></i></button>`;
            html += `
                <tr>
                    <td>${element.persyaratan}</td>
                    <td class="text-center " style="font-size:18px"; >${element.ada ? " ✔  " : btn}</td>
                </tr>
            `;
        });
        $('#tbody_list_dokumen').append(html);

        var html2 = "";
        $('#tbody_list_dokumen2').empty();
        params2.forEach(element => {
            html2 += `
                <tr>
                    <td>${element.persyaratan}</td>
                    <td class="text-center " style="font-size:18px"; >${element.ada ? " ✔  " : btn}</td>
                </tr>
            `;
        });
        $('#tbody_list_dokumen2').append(html2);
    }

