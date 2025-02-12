@extends('layouts.app')
@section('content')
<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('jadwal_poli/create') }}" method="POST">
                @csrf
                <input type="hidden" name="poli_bpjs" id="hide_poli_bpjs">
                <input type="hidden" name="kode_sub" id="hide_kode_sub">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Display</label>
                        <select name="display" id="display" class="form-control">
                            <option value=""></option>
                            @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Poli-ke (Pada display)</label>
                        <select name="poli_ke" id="poli_ke" class="form-control">
                            <option value=""></option>
                            @for($i = 1; $i <= 2; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Poli</label>
                        <select style="height:100%;" name="poli" id="poli" required class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($poli_local as $pl)
                            <option value="{{$pl->nama.'-'.$pl->slug}}">{{$pl->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Poli BPJS</label>
                        <select style="height:100%;" required id="poli_bpjs" class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($poli as $p)
                            <option value="{{$p->kode_poli.'-'.$p->kode_sub_spesialis}}">{{$p->kode_poli.' - '.$p->nama_sub_spesialis}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Dokter</label>
                        <select style="height:100%;" name="dokter" required id="dokter" class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($dokter_local as $dl)
                            <option value="{{$dl->id.'-'.$dl->nama}}">{{$dl->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Dokter BPJS</label>
                        <select style="height:100%;" name="dokter_bpjs" required id="dokter_bpjs" class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($dokter as $d)
                            <option value="{{$d->kode_dokter}}">{{$d->kode_dokter.' - '.$d->nama_dokter}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hari</label>
                        <select name="hari" required id="hari" class="form-control">
                            <option value="">--Select Here--</option>
                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                            <option value="6">Sabtu</option>
                            <option value="7">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jam Mulai</label>
                        <input type="time" required value="{{ date('H:i', strtotime('+7 hours')) }}" name="jam_mulai" class="form-control waktu">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Selesai</label>
                        <input type="time" required value="{{ date('H:i', strtotime('+7 hours')) }}" name="jam_selesai" class="form-control waktu">
                    </div>
                    <div class="form-group">
                        <label for="">Estimasi Layanan</label>
                        <input type="number" min="0" class="form-control" name="estimasi" placeholder="dalam menit">
                    </div>
                    <div class="form-group">
                        <label for="">Kuota JKN</label>
                        <input type="number" required name="kuota_jkn" min="0" value="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kuota non JKN</label>
                        <input type="number" required name="kuota_non_jkn" min="0" value="0" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah Jadwal Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('jadwal_poli/update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="poli_bpjs" id="edit_hide_poli_bpjs">
                <input type="hidden" name="kode_sub" id="edit_hide_kode_sub">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Display</label>
                        <select name="display" id="edit_display" class="form-control">
                            <option value=""></option>
                            @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Poli-ke (Pada display)</label>
                        <select name="poli_ke" id="edit_poli_ke" class="form-control">
                            <option value=""></option>
                            @for($i = 1; $i <= 2; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Poli</label>
                        <select style="height:100%;" name="poli" id="edit_poli" required class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($poli_local as $pl)
                            <option value="{{$pl->nama.'-'.$pl->slug}}">{{$pl->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Poli BPJS</label>
                        <select style="height:100%;" required id="edit_poli_bpjs" class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($poli as $p)
                            <option value="{{$p->kode_poli.'-'.$p->kode_sub_spesialis}}">{{$p->kode_poli.' - '.$p->nama_sub_spesialis}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Dokter</label>
                        <select style="height:100%;" name="dokter" required id="edit_dokter" class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($dokter_local as $dl)
                            <option value="{{$dl->id.'-'.$dl->nama}}">{{$dl->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Dokter BPJS</label>
                        <select style="height:100%;" name="dokter_bpjs" required id="edit_dokter_bpjs" class="form-control pilihan">
                            <option value="">--Select Here--</option>
                            @foreach($dokter as $d)
                            <option value="{{$d->kode_dokter}}">{{$d->kode_dokter.' - '.$d->nama_dokter}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hari</label>
                        <select name="hari" required id="edit_hari" class="form-control">
                            <option value="">--Select Here--</option>
                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                            <option value="6">Sabtu</option>
                            <option value="7">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jam Mulai</label>
                        <input type="time" required value="{{ date('H:i', strtotime('+7 hours')) }}" id="edit_jam_mulai" name="jam_mulai" class="form-control waktu">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Selesai</label>
                        <input type="time" required value="{{ date('H:i', strtotime('+7 hours')) }}" id="edit_jam_selesai" name="jam_selesai" class="form-control waktu">
                    </div>
                    <div class="form-group">
                        <label for="">Estimasi Layanan</label>
                        <input type="number" id="edit_estimasi" min="0" class="form-control" name="estimasi" placeholder="dalam menit">
                    </div>
                    <div class="form-group">
                        <label for="">Kuota JKN</label>
                        <input type="number" required name="kuota_jkn" id="edit_kuota_jkn" min="0" value="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kuota non JKN</label>
                        <input type="number" required name="kuota_non_jkn" id="edit_kuota_non_jkn" min="0" value="0" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jadwal Poli</h1>
        </div>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger col-lg-12">{{$error}}</div>
        @endforeach
        @endif
        @if(Session::has('sukses'))
        <div class="alert alert-success col-lg-12">
            {{Session::get('sukses')}}
        </div>
        @endif
        @if(Session::has('gagal'))
        <div class="alert alert-danger col-lg-12">
            {{Session::get('gagal')}}
        </div>
        @endif
        <div class="section-body">
            <div class="card pt-3 pb-3">
                <div class="row" style="margin-left: 0; width:100%;">
                    <div class="col-lg-8">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <form class="col-lg-4" action="{{ url('jadwal_poli/local') }}">
                        <div class="input-group">
                            <input type="text" name="keyword" placeholder="Cari..." value="{{ isset($keyword) ? $keyword : '' }}" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-12 table-responsive pt-3">
                        <table class="table table-striped" style="width:1200px;">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kuota JKN</th>
                                    <th>Kuota Non JKN</th>
                                    <th>Kode Poli BPJS</th>
                                    <th>Kode Dokter BPJS</th>
                                    <th>Nama Poli</th>
                                    <th>Nama Dokter</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Hari</th>
                                    <th>Estimasi Pelayanan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($data) < 1) <tr class="text-center">
                                    <td colspan="12">Data tidak ditemukan.</td>
                                    </tr>
                                    @else
                                    @foreach($data as $d)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$d->kuota_jkn}}</td>
                                        <td class="text-center">{{$d->kuota_non_jkn}}</td>
                                        <td>{{$d->kodepoli_bpjs}}</td>
                                        <td>{{$d->kodedokter_bpjs}}</td>
                                        <td>{{$d->nama_poli}}</td>
                                        <td>{{$d->nama_dokter}}</td>
                                        <td class="text-center">{{$d->jam_mulai}}</td>
                                        <td class="text-center">{{$d->jam_selesai}}</td>
                                        <td class="text-center">
                                            <?php
                                            switch ($d->hari) {
                                                case '1':
                                                    echo 'Senin';
                                                    break;
                                                case '2':
                                                    echo 'Selasa';
                                                    break;
                                                case '3':
                                                    echo 'Rabu';
                                                    break;
                                                case '4':
                                                    echo 'Kamis';
                                                    break;
                                                case '5':
                                                    echo 'Jumat';
                                                    break;
                                                case '6':
                                                    echo 'Sabtu';
                                                    break;
                                                case '7':
                                                    echo 'Minggu';
                                                    break;
                                                default:
                                                    echo '';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">{{$d->estimasi_layanan}} Menit</td>
                                        <td>
                                            <div style="display: inline-flex;">
                                                <button data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-warning mr-1" onclick="open_modal_edit('{{$d->id}}')"><i class="fas fa-pencil-alt"></i></button>
                                                <a data-toggle="tooltip" data-placement="top" href="{{ url('jadwal_poli/delete?id='.$d->id) }}" title="Hapus" class="btn btn-danger" onclick="return confirm('Yakin melanjutkan hapus data ? data yang dihapus tidak dapat dikembalikan')"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="width: 100%; margin-left:0;">
                        <div class="col-lg-6" style="display: flex; align-items: center;">
                            @if(sizeof($data) > 0)
                            Showing data {{$data->firstItem()}} to {{$data->lastItem()}}, Page {{ $data->currentPage() }} of {{$data->lastPage()}} @if($keyword != '') (Filtered) @endif
                            @else
                            Empty result @if($keyword != '') (Filtered) @endif
                            @endif
                        </div>
                        <div class="col-lg-6" style="justify-content: flex-end; display:flex;">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.pilihan').select2({
            theme: 'bootstrap4'
        });
    });

    $('#poli_bpjs').change(function(){
        var temp = $('#poli_bpjs').val();
        if (temp == '') {
            $('#hide_poli_bpjs').val('');
            $('#hide_kode_sub').val('');
        }else{
            var arr = temp.split('-');
            $('#hide_poli_bpjs').val(arr[0]);
            $('#hide_kode_sub').val(arr[1]);
        }
    })

    $('#edit_poli_bpjs').change(function(){
        var temp = $('#edit_poli_bpjs').val();
        if (temp == '') {
            $('#edit_hide_poli_bpjs').val('');
            $('#edit_hide_kode_sub').val('');
        }else{
            var arr = temp.split('-');
            $('#edit_hide_poli_bpjs').val(arr[0]);
            $('#edit_hide_kode_sub').val(arr[1]);
        }
    })

    function open_modal_edit(param){
        $.ajax({
            url : '{{ url("ajax_request/select_jadwal_poli") }}',
            data : {
                id : param
            },
            success:function(response){
                console.log(response);
                if (response == null) {
                    return;
                }
                $('#edit_id').val(response.id);
                $('#edit_display').val(response.display);
                $('#edit_poli_ke').val(response.poli_ke);
                $('#edit_hide_kode_sub').val(response.kodesubspesialis_bpjs);
                $('#edit_hide_poli_bpjs').val(response.kodepoli_bpjs);
                $('#edit_kuota_jkn').val(response.kuota_jkn);
                $('#edit_kuota_non_jkn').val(response.kuota_non_jkn);
                $('#edit_poli_bpjs').val(response.kodepoli_bpjs+'-'+response.kodesubspesialis_bpjs).trigger('change');
                $('#edit_dokter_bpjs').val(response.kodedokter_bpjs).trigger('change');
                $('#edit_poli').val(response.nama_poli+'-'+response.slug_poli).trigger('change');
                $('#edit_dokter').val(response.id_dokter+'-'+response.nama_dokter).trigger('change');
                $('#edit_jam_mulai').val(response.jam_mulai);
                $('#edit_jam_selesai').val(response.jam_selesai);
                $('#edit_hari').val(response.hari);
                $('#edit_estimasi').val(response.estimasi_layanan);
                $('#modalEdit').modal('show');
            }
        })
    }
</script>
@endpush