 @extends('layouts.app')
 
 @section('content')
 <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Antrian Poli</h1>
        </div>

        <div class="section-body">
            @if(Session::has('berhasil'))
            <div class="row" style="width:100%; margin-left: 0;">
                <div class="col-lg-12 alert alert-success">
                    {{Session::get('berhasil')}}
                </div>
            </div>
            @endif
            @if(Session::has('gagal'))
            <div class="row" style="width:100%; margin-left: 0;">
                <div class="col-lg-12 alert alert-danger">
                    {{Session::get('gagal')}}
                </div>
            </div>
            @endif
            <div class="card pt-3">
                <div class="row" style="width: 100%; margin-left: 0;">
                    {{-- <div class="col-lg-12" id="box_msg"></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Poli</label>
                            <select id="poli" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($poli as $p)
                                <option value="{{$p->nama}}">{{$p->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Dokter</label>
                            <select id="dokter" class="form-control">
                                <option value="">--Select Here--</option>
                                @foreach($dokter as $d)
                                <option value="{{$d->nama}}">{{$d->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group" style="padding-top: 30px;">
                            <button id="btn_tampilkan" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </div> --}}
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped table-hover" id="table-cuti">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011-04-25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011-07-25</td>
                                    <td>$170,750</td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('table-cuti').DataTable();
    });
</script>
@endpush