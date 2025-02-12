<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tata Tertib dan Peraturan Pelayanan Rawat Inap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .custom-table td {
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }

        .custom-table th {
            border-color: black;
        }

        #judul_dokumen {
            margin-left: -30%;
        }

        #tanggal_verifikasi {
            border: none;
            border-bottom: 1px dotted;
            width: 12%;
        }

        #box_tanda_tangan:hover {
            cursor: pointer;
        }

        #box_verifikasi:hover {
            cursor: pointer;
        }

        @media print {
            #judul_dokumen {
                margin-left: 10%;
                margin-top: -10%;
            }

            #tanggal_verifikasi {
                border: none;
                border-bottom: 1px dotted;
                width: 13.5%;
            }

            .col-md-2 {
                width: 16.6%;
            }

            .col-md-4 {
                width: 33.3%;
            }
        }
    </style>
</head>

<body class="p-2">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="">
            </div>

            <div class="col-md-9 font-weight-bold text-center">
                <p id="judul_dokumen">
                    TATA TERTIB DAN PERATURAN PELAYANAN RAWAT INAP<br>RUMAH SAKIT HARAPAN MULIA
                </p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>
                    Selaku pasien/wali hukum Rumah Sakit Harapan Mulia dengan ini menyatakan persetujuan untuk mematuhi tata tertib dan peraturan di Rumah Sakit Harapan Mulia :
                </p>

                <p> 1. PERSETUJUAN TATA TERTIB RS HARAPAN MULIA</p>

                <p class="font-weight-bold">a. Waktu Berkunjung</p>
                <p>
                    &nbsp;&nbsp; Siang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Jam 11.00 - 13.00 WIB <br>
                    &nbsp;&nbsp; Siang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Jam 17.00 - 19.00 WIB <br>
                    &nbsp;&nbsp; Kelas VIP dan VVIP : Tidak dibatasi, kecuaali jika kondisi pasien yang tidak memungkinkan untuk menerima kunjungan.
                </p>

                <p>
                    Untuk kenyamanan dan ketenangan pasien, pengunjung yang datang di atas jam 21.00 akan ditertibkan oleh petugas Rumah Sakit harapan Mulia. <br>
                    Untuk ketenangan dan kenyamanan pasien, pengunjung yang datang di luar jam berkunjung akan ditertibkan oleh petugas Rumah Sakit Harapan Mulia.
                </p>

                <p class="font-weight-bold">b. Penunggu Pasien</p>
                <ol>
                    <li>Menggunakan masker selama di lingkungan Rumah Sakit.</li>
                    <li>Pasien anak dapat ditunggu oleh 1 (satu) orang anggota keluarga</li>
                    <li>Pasien dewasa kelas i, ii, dan iii tidak dapat ditunggu anggota keluarga kecuali dalam kondisi tertentu</li>
                    <li>Penunggu pasien wajib menggunakan kartu akses lift pada saat pasien dirawat, dan akan diserahkan kembali pada saat selesai masa perawatan pasien. Jika kartu hilang dikenakan denda sebesar Rp. 100.000,-</li>
                    <li>Anggota keluarga pasien perina-ICU dapat menunggu di ruang tunggu.</li>
                    <li>Anggota keluarga yang akan memasuki ruang pulih sadar wajib menggunakan baju pengunjung yang sudah disediakan oleh RS Harapan Mulia. Setiap pasien hanya dapat dikunjungi 1 (satu) orang secara bergantian.</li>
                    <li>Barang berharga milik pasien/keluarga pasien seperti : uang, perhiasan, handphone, laptop dan barang berharga lainnya, sepenuhnya menjadi tanggung jawab pasien dan keluarga.</li>
                    <li>Tidak membawa tikar, karpet, kasur atau apapun kedalam ruang perawatan untuk alas tidur.</li>
                    <li>Tidak mencuci pakaian dan peralatan makanan di kamar mandi ruang perawatan untuk alas tidur.</li>
                    <li>Tidak merokok, tidak membawa minuman keras, narkotik, senjata tajam, senjata api, dan lainnya dan bahan lain yang dapat membahayakan kesehatan dan jiwa di dalam ruang perawatan.</li>
                    <li>Barang/peralatan milik atau merupakan inventaris rumah sakit, tidak boleh dibawa pulang oleh pasien, kerusakan/kehilangan barang-barang milik rumah sakit yang disebabkan oleh pasien/keluarga pasien, maka akan dikenakan biaya penggantian.</li>
                    <li>Pada saat pasien akan pulang, periksa kembali barang-barang milik pasien jangan sampai ada yang tertinggal di dalam ruangan perawatan. </li>
                </ol>

                <p class="font-weight-bold">c. Pengunjung Pasien</p>
                <ol>
                    <li>Menggunakan masker selama di lingkungan rumah sakit.</li>
                    <li>Anak di bawah 12 tahun tidak diperbolehkan masuk ke ruangan rawat inap.</li>
                    <li>Tidak merokok, tidak membawa minuman keras, narkotik, senjata tajam, senjata api, dan lainnya dan bahan lain yang dapat membahayakan kesehatan dan jiwa di dalam ruang perawatan.</li>
                    <li>Tidak membawa tikar, karpet, kasur atau apapun kedalam ruang perawatan untuk alas tidur.</li>
                    <li>Tidak memberikan makanan dan minuman dari luar rumah sakit untuk pasien yang mendapat diet khusus.</li>
                </ol>

                <p> 2. PERSETUJUAN PEMBIAYAAN RUMAH SAKIT</p>
                <p class="font-weight-bold">a. Pasien Umum</p>
                <ol>
                    <li>Bersedia membayar deposit rawat inap sesuai peraturan RS harapan Mulia</li>
                    <li>Pasien yang terencana akan dilakukan tindakan operasi/persalinan wajib membayar deposit sesuai peraturan RS Harapan Mulia.</li>
                    <li>Deposit tersebut di atas (poin 1 dan 2) , wajib dilunasi dalam waktu 1x24 jam</li>
                    <li>Apabila sampai hari kedua setalah tindakan operasi/persalinan/perawatan pasien belum memberikan deposit, maka: <br>
                        <span>
                            &#10003; Obat-obatan yang diresepkan harus dibeli sendiri <br>
                            &#10003; Pemeriksaan penunjang atau pemeriksaan lainnya dibayar secara tunai <br>
                            &#10003; Pasien dipindahkan ke kelas yang lebih rendah
                        </span>
                    </li>
                    <li>Sebelum pulang, pasien/keluarga wajib melunasi seluruh biaya perawatan </li>
                </ol>

                <p class="font-weight-bold">b. Pasien Jaminan (Asuransi/Perusahaan/Pemerintah)</p>
                <ol>
                    <li>Bila dalam waktu 1x24 Jam surat jaminan belum diterima dan atau setelah dikonfirmasi mengenai lembar medis awal tidak dijamin, maka akan diberlakukan ketentuan pembayaran seperti pasien umum.</li>
                    <li>Manajemen RS Harapan Mulia berwenang untuk memberikan keterangan medis baik secara tertulis maupun lisan kepada pihak penjamin.</li>
                    <li>Apabila kelas tidak tersedia sesuai haknya, maka pihak rumah sakit akan melakukan konfirmasi ke instansi penjamin dalam waktu 1x24 jam.</li>
                    <li>Apabila pasien/keluarga pasien memilih kelas yang lebih tinggi dari haknya, maka selisih dari seluruh biaya perawatan menjadi tanggung jawab sepenuhnya oleh pasien/keluarga pasien dan dilunasi saat pasien pulang</li>
                    <li>Batas waktu pasien pulang pukul 19.00 WIB, maka pasien akan dipulangkan keesokan harinya.</li>
                </ol>

                <p> 3. TANDA TANGAN</p>
                <p>&nbsp;&nbsp; Dengan tanda tangan dibawah ini, saya menyatakan bahwa saya telah membaca dan memahami isi tata tertib dan peraturan pelayanan rawat inap di Rumah Sakit Harapan Mulia.</p>
            </div>
        </div>

        <p class="mt-5">Bekasi, <input type="text" id="tanggal_verifikasi" value="{{ $data ? $data->tanggal_verifikasi != '0000-00-00 00:00:00' ? date('d-m-Y H:i', strtotime($data->tanggal_verifikasi)) : date('d-m-Y H:i') : date('d-m-Y H:i') }}" class="datetimepicker"></p>

        <div class="row my-5">
            <div class="col-md-4 text-center" onclick="open_modal_tanda_tangan()">
                <span class="font-weight-bold"> Pasien/Wali</span>
                <div id="box_tanda_tangan" class="text-center">
                    @if($data)
                    <br>
                    <img src="{{ asset('signature_patient/'.$data->signature) }}" style="width: 4cm; height:2.5cm;" />
                    <br>
                    ({{ $data->nama_pasien }})
                    <br>
                    @else
                    <br />
                    <br />
                    Klik Disini
                    <br />
                    <br />
                    <br />
                    (............................................)<br>
                    @endif
                </div>
                Ttd & Nama Terang
            </div>
            <div class="col-md-2">

            </div>

            <div class="col-md-4 text-center" onclick="open_modal_verifikasi()">
                <span class="font-weight-bold"> RS Harapan Mulia</span>
                <div id="box_verifikasi">
                    @if($dokumen->status == 1)
                    <br>
                    <img src="{{ env('SMIS_UPLOAD_URL').'/'.($employee ? $employee->ttd : '') }}" style="width: 4cm; height:2.5cm;" />
                    <br>
                    ({{ $dokumen->nama_verifikator }})
                    <br>
                    @else
                    <br />
                    <br />
                    Klik Disini
                    <br />
                    <br />
                    <br />
                    (............................................)<br>
                    @endif
                </div>
                Ttd & Nama Terang
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_tanda_tangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_tanda_tangan">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <h6>Signature :</h6>
                                <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                                <textarea id="signature" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <input type="text" id="nama_pasien" class="form-control" name="nama_pasien">
                            </div>
                            <div class="form-group text-center">
                                <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_verifikasi">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                        <input type="hidden" name="tanggal_verifikasi">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password anda">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function open_modal_verifikasi(){
        $('#form_verifikasi')[0].reset();
        $('#modal_verifikasi').modal('show');
    }

    $('#form_verifikasi').submit(function(e){
        e.preventDefault();

        toastr.warning('Sedang verifikasi dokumen, harap tunggu...');
        $('[name=tanggal_verifikasi]').val($('#tanggal_verifikasi').val());
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/tata_tertib_dan_peraturan_pelayanan_rawat_inap/verifikasi') }}",
            data: $('#form_verifikasi').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                $('#modal_verifikasi').modal('hide');
                var ins = '<br>' +
                    `<img src="{{ env('SMIS_UPLOAD_URL') }}/` + (response.employee ? response.employee.ttd : '') + `" style="width: 4cm; height:2.5cm;" />` +
                    '<br>' +
                    '(' + response.data.nama_verifikator + ')' +
                    '<br>';
                $('#box_verifikasi').html(ins);
            }
        })
    })
</script>
<script>
    function open_modal_tanda_tangan() {
        signaturePad.clear();
        $("#signature").val('');
        $("#nama_pasien").val('');
        $('#modal_tanda_tangan').modal('show');
    }

    $('#form_tanda_tangan').submit(function(e) {
        e.preventDefault();
        if (!confirm('Yakin melanjutkan tanda tangan ?')) {
            return;
        }

        $('#signature').val(signaturePad.toDataURL('image/png'));

        toastr.warning('Sedang tanda tangan dokumen, harap tunggu...');

        $.ajax({
            url: "{{ url('e_rekam_medis/detail/tata_tertib_dan_peraturan_pelayanan_rawat_inap/signature') }}",
            data: $('#form_tanda_tangan').serialize(),
            method: 'post',
            success: function(response) {
                if (!response.status) {
                    toastr.error(response.message);
                    return;
                }
                toastr.success(response.message);
                $('#modal_tanda_tangan').modal('hide');
                var ins = '<br>' +
                    `<img src="{{ asset('signature_patient') }}/` + response.data.signature + `" style="width: 4cm; height:2.5cm;" />` +
                    '<br>' +
                    '(' + response.data.nama_pasien + ')' +
                    '<br>';
                $('#box_tanda_tangan').html(ins);
            }
        })
    })
</script>
<script>
    $('.datetimepicker').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY HH:mm'
        },
        useCurrent: false,
        autoUpdateInput: true,
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
    });

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
        $("#signature").val('');
        $("#nama_pasien").val('');
    });
</script>

</html>