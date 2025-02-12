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
                        <form action="{{ route('data_karyawan.store') }}" method="post" accept-charset="utf-8"
                            enctype="multipart/form-data">
                            @csrf
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
                                <img id="preview_image" src="#" alt="Foto Karyawan"
                                    style="width: 270px; height: 350px; margin-top: 15px;" />
                            </div>
                            <h2 style="font-size: 19px;" class="section-title">Identitas</h2>
                            <br>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Nomor Karyawan</label>
                                        <input class="form-control" type="text" name="no_pegawai" id="no_pegawai"
                                            value="{{ old('no_pegawai') }}" required />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input class="form-control" type="text" name="nama" id="nama"
                                            value="{{ old('nama') }}" required />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">--Silahkan Pilih--</option>
                                            <option {{ old('gender') == '1' ? 'selected' : ' ' }} value="1">Laki-Laki
                                            </option>
                                            <option {{ old('gender') == '0' ? 'selected' : ' ' }} value="0">Perempuan
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
                                            value="{{ old('alamat') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            value="{{ old('tanggal_lahir') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir"
                                            value="{{ old('tempat_lahir') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No.KTP</label>
                                        <input class="form-control" type="number" name="no_ktp" id="no_ktp"
                                            value="{{ old('no_ktp') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No.KK</label>
                                        <input class="form-control" type="text" name="no_kk" id="no_kk"
                                            value="{{ old('no_kk') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <input class="form-control" type="text" name="agama" id="agama"
                                            value="{{ old('agama') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Status Nikah</label>
                                        <select class="form-control" name="status_menikah" id="status_menikah">
                                            <option value="">--Silahkan Pilih--</option>
                                            <option {{ old('status_menikah') == 'Menikah' ? 'selected' : ' ' }}
                                                value="Menikah">Menikah</option>
                                            <option {{ old('status_menikah') == 'Belum Menikah' ? 'selected' : ' ' }}
                                                value="Belum Menikah">Belum Menikah</option>
                                            <option {{ old('status_menikah') == 'Duda' ? 'selected' : ' ' }}
                                                value="Duda">
                                                Duda</option>
                                            <option {{ old('status_menikah') == 'Janda' ? 'selected' : ' ' }}
                                                value="Janda">Janda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Telp</label>
                                        <input class="form-control" type="number" name="telp" id="telp"
                                            value="{{ old('telp') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>HP</label>
                                        <input class="form-control" type="number" name="no_hp" id="no_hp"
                                            value="{{ old('no_hp') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No. BPJS Ketenagakerjaan</label>
                                        <input class="form-control" type="number" name="no_bpjs_ketenagakerjaan"
                                            id="no_bpjs_ketenagakerjaan" value="{{ old('no_bpjs_ketenagakerjaan') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No. BPJS Kesehatan</label>
                                        <input class="form-control" type="number" name="no_bpjs_kesehatan"
                                            id="no_bpjs_kesehatan" value="{{ old('no_bpjs_kesehatan') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No. NPWP</label>
                                        <input class="form-control" type="text" name="no_npwp" id="no_npwp"
                                            value="{{ old('no_npwp') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input name="tahun_lulus" id="tahun_lulus" class="form-control" type="number"
                                            min="1900" max="2099" step="1"
                                            value="{{ old('tahun_lulus') }}" />
                                    </div>
                                    {{-- <div class="form-group"> --}}
                                    {{--     <label>Email</label> --}}
                                    {{--     <input class="form-control" type="email" name="email" id="email" --}}
                                    {{--         value="{{ old('email') }}" /> --}}
                                    {{-- </div> --}}
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <select class="form-control" name="pendidikan" id="pendidikan" required>
                                            <option value="">--Silahkan Pilih--</option>
                                            @foreach ($pendidikan as $p)
                                                <option {{ old('pendidikan') == $p->pendidikan ? 'selected' : ' ' }}
                                                    value="{{ $p->pendidikan }}">{{ $p->pendidikan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h2 style="font-size: 19px;" class="section-title">Info Karyawan Terbaru</h2>
                            <br>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tanggal Awal Kontrak</label>
                                        <input class="form-control" type="date" name="tgl_awal_kontrak"
                                            id="tgl_awal_kontrak" value="{{ old('tgl_awal_kontrak') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tanggal Akhir Kontrak</label>
                                        <input class="form-control" type="date" name="tgl_akhir_kontrak"
                                            id="tgl_akhir_kontrak" value="{{ old('tgl_akhir_kontrak') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <input class="form-control" type="text" name="golongan" id="golongan"
                                            value="{{ old('golongan') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Bagian</label>
                                        <select class="form-control" name="bagian" id="bagian" required>
                                            <option value="">--Silahkan Pilih--</option>
                                            @foreach ($bagian as $dt)
                                                <option {{ old('bagian') == $dt->nama ? 'selected' : ' ' }}
                                                    value="{{ $dt->nama }}"> {{ $dt->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Jabatan Struktural</label>
                                        <input class="form-control" type="text" name="jabatan_struktural"
                                            id="jabatan_struktural" value="{{ old('jabatan_struktural') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Status Tenaga Kerja</label>
                                        <select class="form-control" name="status_tenaga_kerja" id="status_tenaga_kerja">
                                            <option value="">--Silahkan Pilih--</option>
                                            <option {{ old('status_tenaga_kerja') == 'Tetap' ? 'selected' : ' ' }}
                                                value="Tetap">Tenaga Tetap</option>
                                            <option {{ old('status_tenaga_kerja') == 'Kontrak' ? 'selected' : ' ' }}
                                                value="Kontrak">Tenaga Kontrak</option>
                                            <option {{ old('status_tenaga_kerja') == 'Percobaan' ? 'selected' : ' ' }}
                                                value="Percobaan">Tenaga Percobaan</option>
                                            <option {{ old('status_tenaga_kerja') == 'Honorer' ? 'selected' : ' ' }}
                                                value="Honorer">Tenaga Honrer</option>
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
                                            <option {{ old('ruangan_pegawai') == 'IT' ? 'selected' : ' ' }}
                                                value="IT">
                                                IT</option>
                                            <option {{ old('ruangan_pegawai') == 'Kamar Operasi' ? 'selected' : ' ' }}
                                                value="Kamar Operasi"> Kamar Operasi</option>
                                            <option {{ old('ruangan_pegawai') == 'Kasir' ? 'selected' : ' ' }}
                                                value="Kasir">Kasir</option>
                                            <option {{ old('ruangan_pegawai') == 'Manajemen' ? 'selected' : ' ' }}
                                                value="Manajemen">Manajemen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" width="40" style="height: 140px;">{{ old('keterangan') }}</textarea>
                                    </div>
                                    {{-- <div class="form-group"> --}}
                                    {{--     <label>Unit Kerja</label> --}}
                                    {{--     <input class="form-control" type="text" name="unit_kerja" id="unit_kerja" --}}
                                    {{--         value="{{ old('unit_kerja') }}" /> --}}
                                    {{-- </div> --}}

                                </div>
                                <div class="col-lg-4">
                                    {{-- <div class="form-group"> --}}
                                    {{--     <label>Ruangan Otorisasi</label> --}}
                                    {{--     <input class="form-control" type="text" name="ruangan_otorisasi" --}}
                                    {{--         id="ruangan_otorisasi" value="{{ old('ruangan_otorisasi') }}" /> --}}
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


        function showEditModal(param) {
            var url = "{{ route('bagian.edit', ':id') }}";
            url = url.replace(':id', param);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response == null) {
                        return;
                    }
                    $('#id_edit').val(response.id);
                    $('#nama_edit').val(response.nama);
                    $('#slug_edit').val(response.slug);
                    $('#keterangan_edit').val(response.keterangan);
                    $('#modalEdit').modal('show');
                },
                error: function(request, status, error) {
                    alert("Terjadi error saat edit data, silahkan hubungi admin");
                }
            })
        }

        function downloadExcel() {

            var keyword = $('input[name=keyword]').val();
            var url = "{{ route('bagian.download') }}/?keyword=" + keyword;
            if (confirm("Apakah anda ingin melanjutkan download ?")) {
                window.location.href = url;
            } else {
                return false;
            }
        }
    </script>
@endsection
