@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Karyawan</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('data_karyawan.update', 0) }}" method="post" accept-charset="utf-8"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $data->id }}" name="id" id="id" />
                            <input type="hidden" value="{{ $data->foto }}" name="old_image" id="old_image" />
                            <h2 style="font-size: 19px; margin-bottom: 10px;" class="section-title">Foto Karyawan</h2>
                            <div class="form-group col-lg-12 text-center">
                                <div class="input-group">
                                    <input class="form-control" type="file" accept=".jpg,.jpeg,.png" name="foto"
                                        id="foto" value="{{ old('foto') }}" />
                                    <div class="input-group-append">
                                        <a style="text-align: center;" class="btn btn-primary" onclick="showImage()">
                                            <i style="color:white; font-size: 18px; margin-top: 5px;"
                                                class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <img id="preview_image" src="{{ asset('/file_data_karyawan/' . $data->foto) }}"
                                    alt="Gambar Karyawan" style="width: 270px; height: 350px; margin-top: 15px;" />
                            </div>
                            <h1 style="font-size: 18px;" class="section-title">Identitas</h1>
                            <br>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Nomor Karyawan</label>
                                        <input class="form-control" type="text" name="no_pegawai" id="no_pegawai"
                                            value="{{ $data->kode }}" required />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input class="form-control" type="text" name="nama" id="nama"
                                            value="{{ $data->nama }}" required />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">--Silahkan Pilih--</option>
                                            <option {{ $data->jk == 1 ? 'selected' : ' ' }} value="1">Laki-Laki
                                            </option>
                                            <option {{ $data->jk == 0 ? 'selected' : ' ' }} value="0">Perempuan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input class="form-control" type="text" name="alamat" id="alamat"
                                            value="{{ $data->alamat }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            value="{{ $data->tgl_lahir == '1111-11-11' ? ' ' : $data->tgl_lahir }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir"
                                            value="{{ $data->tmp_lahir }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No.KTP</label>
                                        <input class="form-control" type="number" name="no_ktp" id="no_ktp"
                                            value="{{ $data->noktp }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No.KK</label>
                                        <input class="form-control" type="text" name="no_kk" id="no_kk"
                                            value="{{ $data->nokk }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <input class="form-control" type="text" name="agama" id="agama"
                                            value="{{ $data->agama }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Status Nikah</label>
                                        <select class="form-control" name="status_menikah" id="status_menikah">
                                            <option value="">--Silahkan Pilih--</option>
                                            <option {{ $data->menikah == 'Menikah' ? 'selected' : ' ' }} value="Menikah">
                                                Menikah</option>
                                            <option {{ $data->menikah == 'Belum Menikah' ? 'selected' : ' ' }}
                                                value="Belum Menikah">Belum Menikah</option>
                                            <option {{ $data->menikah == 'Duda' ? 'selected' : ' ' }} value="Duda">
                                                Duda</option>
                                            <option {{ $data->menikah == 'Janda' ? 'selected' : ' ' }} value="Janda">
                                                Janda
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Telp</label>
                                        <input class="form-control" type="number" name="telp" id="telp"
                                            value="{{ $data->telp }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>HP</label>
                                        <input class="form-control" type="number" name="no_hp" id="no_hp"
                                            value="{{ $data->hp }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No. BPJS Ketenagakerjaan</label>
                                        <input class="form-control" type="number" name="no_bpjs_ketenagakerjaan"
                                            id="no_bpjs_ketenagakerjaan" value="{{ $data->bpjs_ketenagakerjaan }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No. BPJS Kesehatan</label>
                                        <input class="form-control" type="number" name="no_bpjs_kesehatan"
                                            id="no_bpjs_kesehatan" value="{{ $data->bpjs_kesehatan }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No. NPWP</label>
                                        <input class="form-control" type="text" name="no_npwp" id="no_npwp"
                                            value="{{ $data->npwp }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <select class="form-control" name="pendidikan" id="pendidikan">
                                            <option value="">--Silahkan Pilih--</option>
                                            @foreach ($pendidikan as $p)
                                                <option {{ $data->pendidikan == $p->pendidikan ? 'selected' : ' ' }}
                                                    value="{{ $p->pendidikan }}">{{ $p->pendidikan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input name="tahun_lulus" id="tahun_lulus" class="form-control" type="number"
                                            min="0" max="2099" step="1"
                                            value="{{ $data->tahun_lulus }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                </div>
                            </div>
                            <h2 style="font-size: 18px;" class="section-title">Info Karyawan Terbaru</h2>
                            <br>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <input class="form-control" type="date" name="tgl_awal_kontrak"
                                            id="tgl_awal_kontrak"
                                            value="{{ $data->tanggal_masuk == '1111-11-11' ? '' : $data->tanggal_masuk }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tanggal Akhir Kontrak</label>
                                        <input class="form-control" type="date" name="tgl_akhir_kontrak"
                                            id="tgl_akhir_kontrak"
                                            value="{{ $data->akhir_kontrak == '1111-11-11' ? ' ' : $data->akhir_kontrak }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <input class="form-control" type="text" name="golongan" id="golongan"
                                            value="{{ $data->golongan }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Bagian</label>
                                        <select class="form-control" name="bagian" id="bagian">
                                            <option value="">--Silahkan Pilih--</option>
                                            @foreach ($bagian as $dt)
                                                <option {{ $data->unit_kerja == $dt->nama ? 'selected' : ' ' }}
                                                    value="{{ $dt->nama }}"> {{ $dt->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Jabatan Struktural</label>
                                        <input class="form-control" type="text" name="jabatan_struktural"
                                            id="jabatan_struktural" value="{{ $data->struktural }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Status Tenaga Kerja</label>
                                        <select class="form-control" name="status_tenaga_kerja" id="status_tenaga_kerja">
                                            <option value="">--Silahkan Pilih--</option>
                                            <option {{ $data->tenaga == 'Tetap' ? 'selected' : ' ' }} value="Tetap">
                                                Tenaga Tetap</option>
                                            <option {{ $data->tenaga == 'Kontrak' ? 'selected' : ' ' }} value="Kontrak">
                                                Tenaga Kontrak</option>
                                            <option {{ $data->tenaga == 'Percobaan' ? 'selected' : ' ' }}
                                                value="Percobaan">Tenaga Percobaan</option>
                                            <option {{ $data->tenaga == 'Honorer' ? 'selected' : ' ' }} value="Honorer">
                                                Tenaga Honrer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Ruangan Karyawan</label>
                                        <select class="form-control" id="ruangan_pegawai" name="ruangan_pegawai">
                                            <option value="option">--Silahkan Plih--</option>
                                            <option {{ $data->ruangan_pegawai == 'IT' ? 'selected' : ' ' }}
                                                value="IT">
                                                IT</option>
                                            <option {{ $data->ruangan_pegawai == 'Kamar Operasi' ? 'selected' : ' ' }}
                                                value="Kamar Operasi"> Kamar Operasi</option>
                                            <option {{ $data->ruangan_pegawai == 'Kasir' ? 'selected' : ' ' }}
                                                value="Kasir">Kasir</option>
                                            <option {{ $data->ruangan_pegawai == 'Manajemen' ? 'selected' : ' ' }}
                                                value="Manajemen">Manajemen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" width="40" style="height: 140px;">{{ $data->keterangan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    {{-- <div class="form-group"> --}}
                                    {{--     <label>Ruangan Otorisasi</label> --}}
                                    {{--     <input class="form-control" type="text" name="ruangan_otorisasi" --}}
                                    {{--         id="ruangan_otorisasi" value="{{ $data->ruangan }}" /> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a href="{{ route('data_karyawan.index') }}" class="btn btn-dark float-left"
                                    style="color: white;">Kembali</a>
                                <button class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        var buttonImage = 0;

        function showImage() {
            const [file] = foto.files;
            if (file && buttonImage == 0) {
                preview_image.src = URL.createObjectURL(file);
                buttonImage = 1;
                $('#preview_image').show();
            } else {
                $('#preview_image').hide();
                buttonImage = 0;
            }
        }


        {{-- function showEditModal(param) { --}}
        {{--     var url = "{{ route('bagian.edit', ':id') }}"; --}}
        {{--     url = url.replace(':id', param); --}}

        {{--     $.ajax({ --}}
        {{--         url: url, --}}
        {{--         type: 'GET', --}}
        {{--         success: function(response) { --}}
        {{--             if (response == null) { --}}
        {{--                 return; --}}
        {{--             } --}}
        {{--             $('#id_edit').val(response.id); --}}
        {{--             $('#nama_edit').val(response.nama); --}}
        {{--             $('#slug_edit').val(response.slug); --}}
        {{--             $('#keterangan_edit').val(response.keterangan); --}}
        {{--             $('#modalEdit').modal('show'); --}}
        {{--         }, --}}
        {{--         error: function(request, status, error) { --}}
        {{--             alert("Terjadi error saat edit data, silahkan hubungi admin"); --}}
        {{--         } --}}
        {{--     }) --}}
        {{-- } --}}

        {{-- function downloadExcel() { --}}

        {{--     var keyword = $('input[name=keyword]').val(); --}}
        {{--     var url = "{{ route('bagian.download') }}/?keyword=" + keyword; --}}
        {{--     if (confirm("Apakah anda ingin melanjutkan download ?")) { --}}
        {{--         window.location.href = url; --}}
        {{--     } else { --}}
        {{--         return false; --}}
        {{--     } --}}
        {{-- } --}}
    </script>
@endsection
