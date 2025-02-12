<div>
    <form style="display: contents;" action="{{ route('casemix.filter') }}">
        <div class="row" style="width: 100%; margin-left: 0;" id="form_filter">

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Mode</label>
                    <select class="form-control" name="mode" id="mode" required>
                        <option {{ ($request['mode'] ?? '') == 'MRS' ? 'selected' : '' }} value="MRS">MRS</option>
                        <option {{ ($request['mode'] ?? '') == 'KRS' ? 'selected' : '' }} value="KRS">KRS</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Dari Tanggal</label>
                    <input type="text" name="dari_tanggal" id="sampai"
                        value="{{ $request['dari_tanggal'] ?? '' }}" class="form-control datepicker" required>
                </div>
                <div class="form-group">
                    <label for="">Sampai Tanggal</label>
                    <input type="text" name="sampai_tanggal" id="sampai"
                        value="{{ $request['sampai_tanggal'] ?? date('d-m-Y') }}" class="form-control datepicker"
                        required>
                </div>
                <div class="form-group">
                    <label for="">Ruangan</label>
                    <select class="form-control select2" name="ruangan" id="ruangan">
                        <option value="">--Pilih Pilihan--</option>
                        @foreach ($data_filter['ruangan'] as $ruangan)
                            <option {{ ($request['ruangan'] ?? '') == $ruangan->nama ? 'selected' : '' }}
                                value="{{ $ruangan->nama }}">{{ $ruangan->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Rajal/Ranap</label>
                    <select class="form-control" name="urji" id="urji" required>
                        <option {{ ($request['urji'] ?? '') == 0 ? 'selected' : '' }} value="0">Rawat Jalan
                        </option>
                        <option {{ ($request['urji'] ?? '') == 1 ? 'selected' : '' }} value="1">Rawat Inap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Cara Bayar</label>
                    <select class="form-control" name="carabayar" id="carabayar" required>

                        @foreach ($data_filter['carabayar'] as $carabayar)
                            <option {{ ($request['carabayar'] ?? 'bpjs') == $carabayar ? 'selected' : '' }}
                                value="{{ $carabayar }}">{{ $carabayar }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Asuransi</label>
                    <select name="asuransi" id="asuransi" class="form-control">
                        <option value="">--Pilih Pilihan--</option>
                        @foreach ($data_filter['asuransi'] as $asuransi)
                            <option {{ ($request['asuransi'] ?? '') == $asuransi->id ? 'selected' : '' }}
                                value="{{ $asuransi->id }}">{{ $asuransi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Perusahaan</label>
                    <select name="perusahaan" id="perusahaan" class="form-control">
                        <option value="">--Pilih Pilihan--</option>
                        @foreach ($data_filter['perusahaan'] as $perusahaan)
                            <option {{ ($request['perusahaan'] ?? '') == $perusahaan->id ? 'selected' : '' }}
                                value="{{ $perusahaan->id }}">{{ $perusahaan->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="pb-4 col-lg-12 d-flex">
            <button style="margin-left: auto;" class="btn btn-primary" type="submit">Terapkan</button>
            {{-- <button class="btn btn-success" type="button" onclick="prepareSend()"><i class="fa fa-paper-plane"></i>
                Kirim Data</button>
            <button class="btn btn-warning" style="color:#fff;" type="button" onclick="export_excel()"><i
                    class="fa fa-file"></i> Export Excel</button> --}}
        </div>
    </form>
</div>
<div class="col-lg-6 mb-4">
    <form action="{{ route('casemix.search') }}" method="get" id="form_search">
        <label for="">Cari</label>
        <input placeholder="Cari berdasarkan nrm/noreg/nama pasien" type="text" name="search" id="search"
            value="{{ $request['search'] ?? '' }}" class="form-control">
    </form>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Tanggal</th>
            <th>Tanggal Pulang</th>
            <th>Layanan</th>
            <th>Nama Pasien</th>
            <th>NRM</th>
            <th>Noreg</th>
            <th>No BPJS</th>
            <th>No SEP</th>
            <th>Diagnosa</th>
            <th>Ruangan Akhir</th>
            <th>Cara Bayar</th>
            <th>Nama Asuransi</th>
            <th>Nama Perusahaan</th>
            <th>Action</th>
        </thead>
        <tbody>
            @isset($data_pasiens)
                @inject('casemixService', 'App\Services\casemixService')
                @forelse ($data_pasiens as $dp)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ date('d-m-Y', strtotime($dp->tanggal)) }}</td>
                        <td>{{ date('d-m-Y H:i', strtotime($dp->tanggal_pulang)) }}</td>
                        <td>{{ $dp->layanan }}</td>
                        <td>{{ $dp->nama_pasien }}</td>
                        <td>{{ $dp->nrm }}</td>
                        <td>{{ $dp->noreg }}</td>
                        <td>{{ $dp->nobpjs }}</td>
                        <td>{{ $dp->nomor_sep }}</td>
                        <td>{{ $casemixService->getDiagnosaById($dp->noreg) ?? "-" }}</td>
                        <td>{{ $dp->ruangan_akhir }}</td>
                        <td>{{ $dp->carabayar }}</td>
                        <td>{{ $casemixService->getAsuransiById($dp->asuransi) ?? "-" }}</td>
                        <td>{{ $casemixService->getPerusahaanById($dp->nama_perusahaan) ?? "-" }}</td>
                        <td>
                            <div class="d-flex flex-row">
                                <a class="btn btn-info"
                                    href="{{ route('casemix.index') }}?slug=folder&working_dir={{ $dp->noreg }}"
                                    target="_blank">Direct</a>
                                <a class="btn btn-success ml-2" onclick="open_modal_status({{ $dp->noreg }})"
                                   style="cursor:pointer; color:white;" >Status</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data untuk ditampilkan</td>
                    </tr>
                @endforelse
            @else
                <tr>
                    <td colspan="10" class="text-center">Terapkan filter untuk menampilkan data</td>
                </tr>
            @endisset
        </tbody>
    </table>
</div>
<div style="width: 100%; text-align: right;">
    <div class="col-lg-6" style="justify-content: flex-end; display: flex; margin-left: auto;">
        {{ isset($data_pasiens) ? $data_pasiens->appends(Request::query())->links('pagination::bootstrap-4') : '' }}
    </div>
</div>
<script>
    window.routeCasemixUpload = "{{ route('casemix.manual_upload') }}";
    window.routeCasemixCheckFolder = "{{ route('casemix.checkfolder') }}";
    window.routeMergeDocument = "{{ route('casemix.merge_document') }}";
    window.routeDownload = "{{ route('casemix.download') }}";
</script>
<script src="{{ asset('js/casemix.js') }}"></script>
