<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>General Consent</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
        #data_diri_header tr td {
            font-size: 16px;
            vertical-align: top;
        }

        #data_diri_ttd tr td {
            font-size: 20px;
            vertical-align: top;
        }

        #list_numbering li {
            font-size: 18px;
            list-style-type: decimal;
        }

        #list_alfabeth li {
            font-size: 18px;
            list-style-type: lower-alpha;
        }
    </style>
</head>

<body style="margin: 20px;">
    <div class="modal fade" id="modal_petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('e_rekam_medis/rekam_medis/verifikasi_dokumen_kunjungan') }}">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password :</label>
                            <input type="password" name="pass" placeholder="Input your password" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" onsubmit="return konfirmasi_ttd(this)"
                    action="{{ url('e_rekam_medis/rekam_medis/save_ttd_dokumen_kunjungan') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400
                                    height=200></canvas>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button id="clear" type="button" class="btn btn-danger btn-sm">Clear
                                    Signature</button>
                            </div>
                        </div>
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form onsubmit="return cek_form_ttd(this)" id="form_persetujuan"
        action="{{ url('e_rekam_medis/rekam_medis/save_general_consent') }}" method="post">
        @csrf
        <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
        <input type="hidden" id="hide_nama" name="nama">
        <input type="hidden" id="hide_alamat" name="alamat">
        <input type="hidden" id="hide_telpon" name="telpon">
        <input type="hidden" id="hide_no_identitas" name="no_identitas">
        <input type="hidden" id="hide_pi_satu" name="pi_satu">
        <input type="hidden" id="hide_pi_dua" name="pi_dua">
        <input type="hidden" id="hide_pi_tiga" name="pi_tiga">
        <input type="hidden" id="hide_hubungan_satu" name="hubungan_satu">
        <input type="hidden" id="hide_hubungan_dua" name="hubungan_dua">
        <input type="hidden" id="hide_hubungan_tiga" name="hubungan_tiga">
        <input type="hidden" id="hide_mengijinkan" name="mengijinkan">
        <input type="hidden" id="hide_keterangan_mengijinkan" name="keterangan_mengijinkan">
    </form>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    @if (Session::has('gagal'))
        <div class="alert alert-danger">{{ Session::get('gagal') }}</div>
    @endif
    @if (Session::has('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
        <div class="col-lg-6" style="border: 1px solid;">
            <div class="row" style="width: 100%;">
                <div class="col-lg-3" style="">
                    <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 120%;">
                </div>
                <div class="col-lg-9" style="margin-top: 10px">
                    <p style="font-weight: bold; font-size:18px; text-align: left">
                        RUMAH SAKIT HARAPAN MULIA
                    </p>
                    <p
                        style="text-align: left; margin-top:-20px; font-size:14px; font-weight: bold; line-height:1.15;">
                        <span style="font-weight: normal">
                            Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya
                            <br>Kabupaten Bekasi Jawa Barat (17340).
                            <br>Telp.: (021) 8995 2340
                            <br>Email : info@rumahsakit-harapanmulia.id
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6" style="width: 100%; margin-left: 0; border:1px solid; padding:10px;">
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 16px;">
                <tr>
                    <td style="width: 40%;">Nama</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nama_pasien }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">No Rekam Medis</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->nrm }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Tgl Lahir</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis Kelamin</td>
                    <td style="padding-left:10px; padding-right:10px"> :</td>
                    <td>{{ $layanan->kelamin == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">*Tempel Label</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="border:1px solid; margin-top: -17px;">
        <div class="row pb-3" style="width: 100%; margin-left: 0;">
            <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
                <h6 style="color: white">PERSETUJUAN UMUM (GENERAL CONSENT)</h6>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <table style="border-collapse:collapse;" id="data_diri_ttd">
                    <tr>
                        <td colspan="3">Yang bertanda tangan dibawah ini :</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">Nama</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td style="width: 80%">
                            <input class="form-control" type="text" id="nama"
                                value="{{ $dokumen->general_consent ? $dokumen->general_consent->nama : $layanan->nama_pasien }}"
                                class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">Alamat</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td style="width: 80%">
                            <input class="form-control" type="text" id="alamat"
                                value="{{ $dokumen->general_consent ? $dokumen->general_consent->alamat : $layanan->alamat . ', RT ' . $layanan->rt . ' RW ' . $layanan->rw . ', ' . $layanan->nama_kelurahan . ', ' . $layanan->nama_kecamatan . ', ' . $layanan->nama_kabupaten }}"
                                class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">Telepon</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td style="width: 80%">
                            <input class="form-control" type="number" min="0" id="telpon"
                                value="{{ $dokumen->general_consent ? $dokumen->general_consent->telpon : $layanan->telpon }}"
                                class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">No. Identitas/KTP/SIM</td>
                        <td style="padding-left:10px; padding-right:10px"> : </td>
                        <td style="width: 80%">
                            <input class="form-control" type="number" min="0" id="no_identitas"
                                value="{{ $dokumen->general_consent ? $dokumen->general_consent->no_identitas : $layanan->ktp }}"
                                class="form-control">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p>Selaku pasien / Wali hukum di RS Harapan Mulia dengan menyatakan ini persetujuan :</p>
                <p style="font-weight:bold;">1. PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</p>
                <ul id="list_alfabeth">
                    <li>Saya/pasien menyetujui untuk perawatan di Rumah Sakit Harapan Mulia sebagai pasien rawat
                        jalan/rawat inap tergantung
                        kepada kebutuhan medis, meliputi pemeriksaan radiologi, pemeriksaan laboratorium, dan prosedur
                        seperti pemasangan infus
                        atau suntikan dan evaluasi (misal : wawancara dan pemeriksaan fisik).</li>
                    <li>Persetujuan saya/pasien berikan tidak termasuk persetujuan untuk prosedur atau tindakan invasif
                        (misal : operasi) atau tindakan yang mempunyai resiko tinggi.</li>
                </ul>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">2. PERSETUJUAN PELEPASAN INFORMASI</p>
                <ul id="list_alfabeth">
                    <li>Saya/pasien memahami informasi yang ada didalam diri saya/pasien termasuk diagnosis dan hasil
                        tes diagnostik yang akan digunakan untuk perawatan medis, Rumah Sakit Harapan Mulia akan
                        menjamin kerahasiaannya</li>
                    <li>Saya/pasien memberikan wewenang kepada Rumah Sakit Harapan Mulia untuk memberikan informasi
                        tentang diagnosis,
                        hasil pelayanan dan pengobatan saya kepada : </li>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 2%;">1. </td>
                            <td style="width: 40%;">
                                <input class="form-control" type="text" id="pi_satu"
                                    value="{{ $dokumen->general_consent ? $dokumen->general_consent->pi_satu : '' }}"
                                    class="form-control">
                            </td>
                            <td style="width: 15%; text-align: center">Hubungan</td>
                            <td style="width: 40%;">
                                <input class="form-control" type="text" id="hubungan_satu"
                                    value="{{ $dokumen->general_consent ? $dokumen->general_consent->hubungan_satu : '' }}"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 2%;">2. </td>
                            <td style="width: 40%;">
                                <input class="form-control" type="text" id="pi_dua"
                                    value="{{ $dokumen->general_consent ? $dokumen->general_consent->pi_dua : '' }}"
                                    class="form-control">
                            </td>
                            <td style="width: 15%; text-align: center">Hubungan</td>
                            <td style="width: 40%;">
                                <input class="form-control" type="text" id="hubungan_dua"
                                    value="{{ $dokumen->general_consent ? $dokumen->general_consent->hubungan_dua : '' }}"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 2%;">3. </td>
                            <td style="width: 40%;">
                                <input class="form-control" type="text" id="pi_tiga"
                                    value="{{ $dokumen->general_consent ? $dokumen->general_consent->pi_tiga : '' }}"
                                    class="form-control">
                            </td>
                            <td style="width: 15%; text-align: center">Hubungan</td>
                            <td style="width: 40%;">
                                <input class="form-control" type="text" id="hubungan_tiga"
                                    value="{{ $dokumen->general_consent ? $dokumen->general_consent->hubungan_tiga : '' }}"
                                    class="form-control">
                            </td>
                        </tr>
                    </table>
                    <li>Saya/pasien memberikan wewenang kepada Rumah Sakit Harapan Mulia untuk memberikan informasi
                        tentang diagnosis,
                        hasil pelayanan dan pengobatan bila diperlukan untuk proses klaim asuransi atau perusahaan
                        dan/atau
                        lembaga pemerintahan. </li>
                </ul>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">3. HAK DAN KEWAJIBAN PASIEN</p>
                <ul id="list_alfabeth">
                    <li>Saya/pasien memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit saya dan dalam
                        hal perawatan
                        medis dan rencana pengobatan.</li>
                    <li>Saya/pasien telah mendapat informasi tentang "Hak dan Kewajiban Pasien" di Rumah Sakit Harapan
                        Mulia melalui
                        leaflet yang disediakan</li>
                </ul>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">4. INFORMASI RAWAT JALAN/RAWAT INAP</p>
                <ul id="list_alfabeth">
                    <li>Saya/pasien tidak diperkenankan untuk membawa barang berharga ke ruang rawat jalan/rawat inap
                        jika ada
                        anggota keluarga atau teman harus diminta untuk membawa pulang barang berharga tersebut.</li>
                    <li>Bila tidak ada anggota keluarga, rumah sakit menyediakan tempat penitipan barang milik pasien di
                        tempat
                        resmi yang telah disediakan rumah sakit.</li>
                    <li>Saya telah menerima informasi tentang peraturan yang diberlakukan oleh rumah sakit dan saya
                        beserta
                        keluarga bersedia mematuhinya, termasuk akan mematuhi jam berkunjung pasien sesuai dengan aturan
                        di rumah sakit.</li>
                    <li>Anggota keluarga saya yang menunggu saya, bersedia untuk selalu memakai tanda pengenal khusus
                        yang diberikan
                        oleh rumah sakit, dan demi keamanan seluruh pasien setiap keluarga dan siapapun yang akan
                        mengunjungi saya diluar
                        jam berkunjung, bersedia untuk diminta/diperiksa identitasnya dan memakai identitas yang
                        diberikan oleh rumah sakit.</li>
                </ul>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">5. PRIVASI</p>
                <p style="padding-left: 18px;">Saya <input type="radio" name="izin" value="0"
                        <?php if (!is_null($dokumen->general_consent)) {
                            echo $dokumen->general_consent->mengijinkan == 0 ? 'checked' : '';
                        } ?>> mengizinkan /
                    <input type="radio" name="izin" value="1" <?php if (!is_null($dokumen->general_consent)) {
                        echo $dokumen->general_consent->mengijinkan == 1 ? 'checked' : '';
                    } ?>> tidak mengizinkan* Rumah
                    Sakit memberi akses bagi keluarga dan handaitaulan
                    serta orang-orang yang akan menengok saya (sebutkan nama bila ada permintaan khusus yang tidak
                    diizinkan):
                    <input type="text"
                        value="{{ $dokumen->general_consent ? $dokumen->general_consent->keterangan_mengijinkan : '' }}"
                        placeholder=".............................." class="mt-2 pl-2" id="keterangan_mengijinkan">
                </p>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">6. INFORMASI BIAYA</p>
                <p style="padding-left: 18px;">
                    Saya memahami tentang informasi biaya pengobatan atau biaya pengobatan yang dijelaskan oleh petugas
                    rumah sakit.
                </p>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">7. PELAYANAN KEROHANIAN</p>
                <ul id="list_alfabeth">
                    <li>Menjalankan ibadah sesuai agama atau kepercayaan yang dianutnya selama hal itu tidak mengganggu
                        pasien lainnya.</li>
                    <li>Menolak pelayanan bimbingan rohani yang tidak sesuai agama dan kepercayaan yang dianutnya.</li>
                    <li>Informasi tentang pelayanan kerohanian yang berada di Rumah Sakit sesuai dengan agama /
                        kepercayaan pasien, dan
                        cara pemberian / bimbingan yang disesuaikan dengan fasilitas Rumah Sakit yang tersedia.</li>
                </ul>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">8. PERATURAN RUMAH SAKIT LAINNYA</p>
                <ul id="list_alfabeth">
                    <li>Saya/ pasien/ penunggu pasien tersebut diatas, tidak akan merokok di lingkungan Rumah Sakit
                        Harapan Mulia.</li>
                    <li>Saya/ pasien/ penunggu pasien bersedia mematuhi seluruh peraturan Rumah Sakit.</li>
                </ul>
            </div>
        </div>
        <div class="row" style="width:100%; margin-left: 0;">
            <div class="col-md-12">
                <p style="font-weight:bold;">8. TANDA TANGAN</p>
                <p style="padding-left: 18px;">Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah
                    membaca dan memahami
                    isi Persetujuan Umum (General Consent).</p>
            </div>
            <div class="col-md-12 text-center">
                <button onclick="submit_form()" class="btn btn-success">Simpan</button>
            </div>
        </div>
        <div class="row pt-4" style="width:100%; margin-left: 0; ">
            <div class="col-md-6 text-center" style="padding-top:30px; font-weight:bold;">
                <p>Saksi dari Rumah Sakit</p>
                @if ($dokumen->id_verifikator == 0)
                    <br>
                    <br>
                    <br>
                    <br>
                    (.................................................)
                    <br>Tanda tangan & nama terang
                @else
                    @if (isset($employee))
                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 2.5cm; width: 5cm;"
                            alt="">
                    @else
                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 2.5cm; width: 5cm;"
                            alt="">
                    @endif
                    <br>{{ $dokumen->nama_verifikator }}
                @endif
            </div>
            <div class="col-md-6 text-center pt-2" style="padding-top: 20px; font-weight:bold;">
                <p>Bekasi, @if (is_null($dokumen->tanggal_update))
                        ..........................................
                    @else
                        {{ date('d-m-Y', strtotime($dokumen->tanggal_update)) }}
                    @endif
                </p>
                <p style="margin-top:-6px;">Yang Memberi persetujuan</p>
                @if (is_null($dokumen->signature_pasien))
                    <br>
                    <br>
                    <br>
                    <br>
                    (.................................................)
                    <br>Tanda tangan & nama terang
                @else
                    <img src="{{ asset('signature_patient/' . $dokumen->signature_pasien) }}"
                        style="height: 2.5cm; width: 5cm;" alt="">
                    <br><?php echo $dokumen->general_consent ? $dokumen->general_consent->nama : $dokumen->nama_pasien; ?>
                @endif
            </div>
        </div>
    </div>
    <div class="row pt-5" style="width:100%; margin-left:0">
        <div class="col-md-1"></div>
        <div class="col-md-4" onclick="open_modal_petugas()"
            style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
            <h5>Saksi dari Rumah Sakit</h5>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4" onclick="open_modal_pasien()"
            style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
            <h5>Pemberi Persetujuan</h5>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
        <div style="text-align: center;" class="col-md-12">
            @if ($dokumen->id_verifikator != 0)
                <a href="{{ url('e_rekam_medis/rekam_medis/pdf_general_consent?dokumen=' . $dokumen->id) }}"
                    class="btn btn-success" target="_blank">Download PDF</a>
            @endif
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    $(document).ready(function() {
        var verif = '{{ $dokumen->id_verifikator }}';
        if (verif != 0) {
            window.scrollTo({
                left: 0,
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        }
    })

    function submit_form() {
        $('#form_persetujuan').submit();
    }

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature64").val('');
    });

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }

    function cek_form_ttd() {
        $('#hide_nama').val($('#nama').val());
        $('#hide_alamat').val($('#alamat').val());
        $('#hide_telpon').val($('#telpon').val());
        $('#hide_no_identitas').val($('#no_identitas').val());

        if ($('#pi_satu').val() == '' && $('#pi_dua').val() == '' && $('#pi_tiga').val() == '') {
            alert('Penanggung jawab harus diisi minimal satu');
            return false;
        }

        if ($('#pi_satu').val() != '') {
            if ($('#hubungan_satu').val() == '') {
                alert('Nomor isian hubungan penanggung jawab yang diisi tidak sesuai');
                return false;
            }
        }

        if ($('#pi_dua').val() != '') {
            if ($('#hubungan_dua').val() == '') {
                alert('Nomor isian hubungan penanggung jawab yang diisi tidak sesuai');
                return false;
            }
        }

        if ($('#pi_tiga').val() != '') {
            if ($('#hubungan_tiga').val() == '') {
                alert('Nomor isian hubungan penanggung jawab yang diisi tidak sesuai');
                return false;
            }
        }

        $('#hide_pi_satu').val($('#pi_satu').val());
        $('#hide_pi_dua').val($('#pi_dua').val());
        $('#hide_pi_tiga').val($('#pi_tiga').val());
        $('#hide_hubungan_satu').val($('#hubungan_satu').val());
        $('#hide_hubungan_dua').val($('#hubungan_dua').val());
        $('#hide_hubungan_tiga').val($('#hubungan_tiga').val());
        $('#hide_mengijinkan').val($('input[name=izin]:checked').val());
        $('#hide_keterangan_mengijinkan').val($('#keterangan_mengijinkan').val());
        return true;
    }

    function konfirmasi_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm(
                'Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.'
                )) {
            return false;
        }
    }
</script>

</html>
