<!-- MODAL RIWAYAT LAB -->
<div class="modal fade" id="modal_riwayat_rad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Riwayat Radiologi</h5>
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
                    <table id="tabel_riwayat_rad" class="table table-striped mt-2" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>Tgl. Pemeriksaan</th>
                                <th>No. Rad</th>
                                <th>Ruangan</th>
                                <th>Nama Dokter</th>
                                <th>Pemeriksaan</th>
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
<!-- END MODAL RIWAYAT LAB -->

<!-- MODAL LIST RAD -->
<div class="modal fade" id="modal_list_file_rad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar File Radiologi </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tabel_list_file_rad" class="table table-striped mt-2" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama File</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- END MODAL LIST RAD -->

