<!-- MODAL RIWAYAT RM -->
<div class="modal fade" id="modal_riwayat_rm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Riwayat RM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        Nama Pasien <span style="float: right">:</span>
                    </div>
                    <div class="col-md-10">
                        <b>{{ $layanan->nama_pasien }}</b>
                    </div>
                    <div class="col-md-2">
                        NRM <span style="float: right">:</span>
                    </div>
                    <div class="col-md-10">
                        <b>{{ $layanan->nrm }}</b>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tabel_riwayat_rm" class="table table-striped mt-2" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>Tgl. Pemeriksaan</th>
                                <th>Noreg</th>
                                <th>Nama Verifikator</th>
                                <th>Nama Dokumen</th>
                                <th style="min-width: fit-content;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- END MODAL RIWAYAT RM -->

<script>
    $(document).ready(function() {
        $("#btn_riwayat_rm").click(function() {
            datatabel_rm();
            $('#modal_riwayat_rm').modal('show');
        });
    });

    function datatabel_rm() {
        if ($.fn.DataTable.isDataTable("#tabel_riwayat_rm")) {
            $('#tabel_riwayat_rm').DataTable().clear().destroy();
        }

        $('#tabel_riwayat_rm').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax.riwayat_rm') }}",
                data: {
                    nrm: '{{ $layanan->nrm }}'
                },
            },
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function(data, type, row, meta) {
                        return reformat_tanggal_rm(data);
                    },
                    'className': 'text-center'
                },
                {
                    data: 'noreg',
                    name: 'noreg',
                    'className': 'text-center'
                },
                {
                    data: 'nama_verifikator',
                    name: 'nama_verifikator'
                },
                {
                    data: 'path_dokumen',
                    name: 'path_dokumen'
                },
                {
                    data: 'path_dokumen',
                    name: 'path_dokumen',
                    render: function(data, type, row) {
                        var url = '{{ asset('dokumen_kunjungan/') }}/' + data;
                        return `
                                <div style="display: flex; gap: 10px;">
                                    <a href="${url}" target="_blank" class="btn btn-info" type="button" style="display: flex; align-items: center; margin: 0 auto;">
                                        <i class="fa fa-book mr-1"></i> Hasil
                                    </a>
                                </div>
                            `;
                    },
                    'className': 'text-center'
                }
            ]
        })
    }

    function reformat_tanggal_rm(params) {
        console.log('this tgl ', params)
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
</script>
