<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Skrining Awal Gizi Dewasa</title>
   
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>

    <style>
         .custom-table td{
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }
       .custom-table th{
            border-color: black;
        }

        #box_ttd:hover {
            cursor: pointer;
        }

        .input-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Adjust the gap between elements as needed */
            vertical-align: middle;
        }

        .input-container input[type="text"],
        .input-container input[type="date"],
        .input-container input[type="time"] {
            margin-bottom: 0; /* Override the margin-bottom set by the form-control class */
            align-items: center;
        }

        .input-container label {
            margin-right: 5px; /* Adjust the space between labels and inputs */
        }

        .text-input {
            flex: 1; /* This makes the text input take up remaining space */
        }

        .date-input,
        .time-input {
            width: 150px; /* Set a fixed width for date and time inputs */
        }

        .signature-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .signature-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .signature-box {
        /* border: 2px solid #000; */
        padding: 20px;
        cursor: pointer;
        width: 200px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .signature-box img {
        max-width: 100%;
        max-height: 100%;
    }

    .signature-placeholder {
        text-align: center;
    }

    .name-box {
        flex: 1;
        display: flex;
        height: 100px;
        align-items: center;
        justify-content: left;
    }

    .slash {
        font-size: 24px;
        margin: 0 10px;
    }
    </style>
</head>

<body class="p-2">
    @if(Session::has('message'))
    <script>
        alert('{{ Session::get("message") }}');
    </script>
    @endif
    <div class="container">
    <form action="" id="form_dokumen" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dokumen" value="{{$dokumen->id}}">

        {{-- <div class="row">
            <div class="col-12 text-right">MR 02.01.007.REV 0</div>
        </div> --}}
        <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
            <div class="col-lg-8">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 62px;">
                <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Telp.: (021) 8995 2340, Fax: (021) 8995 2340</p>
            </div>
            <div class="col-lg-4 pt-3 pl-3">
                <div style="border: 1px solid; border-radius: 20px; padding:15px;">
                    <table>
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $layanan->nama_pasien }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $dokumen->nrm }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ Illuminate\Support\Carbon::parse($pasien->tgl_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien->ktp }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="container">
            <h5 class="text-center mt-3 font-weight-bold"> FORMULIR SKRINING AWAL GIZI DEWASA</h5>
            <p class="font-weight-bold mt-3">A. Malnutrition Screening Tools<br>
                &nbsp;&nbsp;&nbsp;&nbsp;DPJP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $layanan ? $layanan->nama_dokter : '' }} <br>
                &nbsp;&nbsp;&nbsp;&nbsp;Diagnosa : {{ $diagnosa ? $diagnosa->nama_icd : '' }}
            </p>
            <table class="table table-bordered custom-table">
                <thead>
                  <tr>
                    <th scope="col" colspan="3" style="border-color: black; background-color: #cbcbcb">Apakah Ada Penurunan Berat Badan 3-6 Bulan Terakhir</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 80%">&nbsp;&nbsp;Tidak Ada</td>
                        <td style="width: 10%; text-align: center">&nbsp;&nbsp;0</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_satu" name="penurunan_satu" class="form-control text-center" value="{{ $data ? $data->penurunan_satu : '' }}">
                        </td>
                    </tr>  
                    <tr>
                        <td style="width: 80%">&nbsp;&nbsp;Tidak Yakin</td>
                        <td style="width: 10%; text-align: center">&nbsp;&nbsp;1</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_dua" name="penurunan_dua" class="form-control text-center" value="{{ $data ? $data->penurunan_dua : ''}}">
                        </td>
                    </tr>  
                    <tr>
                        <td colspan="2" style="width: 80%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ya, berapa kg?</td>
                        <td style="width: 10%; text-align: center">
                        </td>
                    </tr> 
                    <tr>
                        <td style="width: 80%; text-align: right;">&nbsp;&nbsp;1-5 kg</td>
                        <td style="width: 10%; text-align:center">1</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_tiga" name="penurunan_tiga" class="form-control text-center" value="{{ $data ? $data->penurunan_tiga : ''}}">
                        </td>
                    </tr> 
                    <tr>
                        <td style="width: 80%; text-align: right;">&nbsp;&nbsp;6-10 kg</td>
                        <td style="width: 10%; text-align:center">2</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_empat" name="penurunan_empat" class="form-control text-center" value="{{ $data ? $data->penurunan_empat : ''}}">
                        </td>
                    </tr> 
                    <tr>
                        <td style="width: 80%; text-align: right;">&nbsp;&nbsp;11-15 kg</td>
                        <td style="width: 10%; text-align:center">3</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_lima" name="penurunan_lima" class="form-control text-center" value="{{ $data ? $data->penurunan_lima : ''}}">
                        </td>
                    </tr> 
                    <tr>
                        <td style="width: 80%; text-align: right;">&nbsp;&nbsp;Lebih dari 15 kg</td>
                        <td style="width: 10%; text-align:center">4</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_enam" name="penurunan_enam" class="form-control text-center" value="{{ $data ? $data->penurunan_enam : ''}}">
                        </td>
                    </tr> 

                    <tr>
                        <th scope="col" colspan="3" style="border-color: black; background-color: #cbcbcb">Apakah Ada Penurunan Asupan Makanan</th>
                    </tr>
                    <tr>
                        <td style="width: 80%">&nbsp;&nbsp;Ada</td>
                        <td style="width: 10%; text-align: center">&nbsp;&nbsp;1</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_tujuh" name="penurunan_tujuh" class="form-control text-center" value="{{ $data ? $data->penurunan_tujuh : ''}}">
                        </td>
                    </tr>  
                    <tr>
                        <td style="width: 80%">&nbsp;&nbsp;Tidak Ada</td>
                        <td style="width: 10%; text-align: center">&nbsp;&nbsp;0</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_delapan" name="penurunan_delapan" class="form-control text-center" value="{{ $data ? $data->penurunan_delapan : ''}}">
                        </td>
                    </tr>  
                    <tr>
                        <th scope="col" colspan="3" style="border-color: black; background-color: #cbcbcb">Apabila Pasien Memiliki Kondisi Penyakit Khusus? (Lihat Diagnosa)</th>
                    </tr>
                    <tr>
                        <td style="width: 80%">&nbsp;&nbsp;(DM, TB Paru, penyakit hati, gangguan ginjal, stroke, kanker, hipertensi, hemodialisa, sakit kritis</td>
                        <td style="width: 10%; text-align: center">&nbsp;&nbsp;2</td>
                        <td style="width: 10%; text-align: center">
                            <input type="text" id="penurunan_sembilan" name="penurunan_sembilan" class="form-control text-center" value="{{ $data ? $data->penurunan_sembilan : ''}}">
                        </td>
                    </tr> 
                    
                    <tr>
                        <td scope="col" colspan="2" class="text-center font-weight-bold" >TOTAL</td>
                        <td>
                            <input type="text" style="font-size: 18px;" id="skor" name="total" class="form-control text-center" value="{{ $data ? $data->total : '' }}">
                        </td>
                    </tr>

                    <tr>
                        <td scope="col" colspan="3" >
                            &nbsp;&nbsp;Apabila skor >= 2 maka dilakukan assessment gizi tingkat lanjut oleh ahli gizi
                        </td>
                    </tr>
                </tbody>     
            </table>  
            
            <p>
                Tanyakan pada pasien apakah pasien memiliki riwayat penyakit kronis/degeneratif, apakah pasien memiliki alergi atau pantangan terhadap sesuatu bahan makanan tertentu, tanyakan apakah pasien memiliki kesulitan dalam makan.
            </p>

            <div class="row">
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4 text-center mt-5">
                    <p>Ahli Gizi</p>
                    <div onclick="open_modal_verifikasi()" id="box_ttd">
                        @if ($dokumen->id_verifikator == 0)
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        ________________________________
                        <p>Tanda Tangan & Nama Jelas</p>
                    @else
                        @if (isset($employee))
                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="height: 2cm; width: 4cm;" alt="">
                        @else
                        <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="height: 2cm; width: 4cm;" alt="">
                        @endif
                        <br>({{ $dokumen->nama_verifikator }})
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-right mt-5">
                <p> RSHM/DMT/26.00/Rev.00</p>
            </div>

            <div class="col-lg-12 pb-2 mt-3 text-center mb-5">
                <button type="submit" id="btn_simpan" class="btn btn-success">Simpan</button>
            </div>

        </div>
    </form>
    </div>

    <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('e_rekam_medis/detail/formulir_skrining_awal_gizi_dewasa/verifikasi') }}" method="post">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{ $dokumen->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" id="" required>
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
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fields = ['penurunan_satu', 'penurunan_dua', 'penurunan_tiga', 'penurunan_empat', 'penurunan_lima', 'penurunan_enam', 'penurunan_tujuh', 'penurunan_delapan', 'penurunan_sembilan'];

        fields.forEach(field => {
            document.getElementById(field).addEventListener('input', calculateTotalScore);
        });

        function calculateTotalScore() {
            let totalScore = 0;

            fields.forEach(field => {
                const value = parseInt(document.getElementById(field).value) || 0;
                totalScore += value;
            });

            document.getElementById('skor').value = totalScore;
        }
    });
</script>

<script>
      $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/formulir_skrining_awal_gizi_dewasa/store') }}",
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            method: 'post',
            success: function(response) {
                alert(response.message);
            }
        })
    })
    
    function open_modal_employee(param) {
        if ($.fn.DataTable.isDataTable("#tabel_employee")) {
            $('#tabel_employee').DataTable().clear().destroy();
        }

        $('#tabel_employee').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("e_rekam_medis/rawat_inap/datatable_employee") }}', // memanggil route yang menampilkan data json
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'id',
                    name: 'id',
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</div>';
                    }
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row) {
                        return '<div class="text-center"><button class="btn btn-dark" onclick="set_employee(' + "'" + data + "','" + row.nama + "','" + param + "'" + ')"><i class="fa fa-check"></i></button></div>';
                    }
                }
            ]
        });

        $('#modal_employee').modal('show');
    }

    function set_employee(id, nama, jenis) {
        $('[name=id_' + jenis + ']').val(id);
        $('[name=' + jenis + ']').val(nama);
        $('#modal_employee').modal('hide');
    }

    function loading(message, tipe) {
        return '<div class="alert alert-' + tipe + '">' +
            '<div class="spinner-border spinner-border-sm mr-1"></div>' +
            message +
            '</div>';
    }
    
    $(document).ready(function() {
        var verif = '{{$dokumen->id_verifikator}}';
        if (verif != 0) {
            window.scrollTo({
                left: 0,
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        }
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
        $("#signature64").val('');
        $("#nama_pasien").val('');
    });

    function konfirmasi_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    const signaturePadNamaYangMenyatakan = new SignaturePad(document.getElementById('signature-pad-yang-menyatakan'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear_pemberi').click(function(e) {
        e.preventDefault();
        signaturePadNamaYangMenyatakan.clear();
        $("#signature64_nama_yang_menyatakan").val('');
        $("#nama_yang_menyatakan").val('');
    });

    function konfirmasi_nama_yang_menyatakan() {
        var data = signaturePadNamaYangMenyatakan.toDataURL('image/png');
        $('#signature64_nama_yang_menyatakan').val(data);

        if ($('#signature64_nama_yang_menyatakan').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    const signaturePadNamaSaksiSatu = new SignaturePad(document.getElementById('signature-pad-saksi-satu'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear_pemberi').click(function(e) {
        e.preventDefault();
        signaturePadNamaSaksiSatu.clear();
        $("#signature64_saksi_satu").val('');
        $("#saksi_satu").val('');
    });

    function konfirmasi_saksi_satu() {
        var data = signaturePadNamaSaksiSatu.toDataURL('image/png');
        $('#signature64_saksi_satu').val(data);

        if ($('#signature64_saksi_satu').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    const signaturePadNamaSaksiDua = new SignaturePad(document.getElementById('signature-pad-saksi-dua'), {
        minWidth: 5,
        maxWidth: 10,
        penColor: 'rgb(0, 0, 0)',
        maxWidth: 2
    });

    $('#clear_pemberi').click(function(e) {
        e.preventDefault();
        signaturePadNamaSaksiDua.clear();
        $("#signature64_saksi_dua").val('');
        $("#saksi_dua").val('');
    });

    function konfirmasi_saksi_dua() {
        var data = signaturePadNamaSaksiDua.toDataURL('image/png');
        $('#signature64_saksi_dua').val(data);

        if ($('#signature64_saksi_dua').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah mengerti dan memahami persetujuan tindakan kedokteran tersebut.')) {
            return false;
        }
    }

    function open_modal_nama_yang_menyatakan() {
        $('#modal_nama_yang_menyatakan').modal('show');
    }

    function open_modal_saksi_satu() {
        $('#modal_saksi_satu').modal('show');
    }

    function open_modal_saksi_dua() {
        $('#modal_saksi_dua').modal('show');
    }

    function open_modal_verifikasi() {
        $('#modal_verifikasi').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
    }
</script>

</html>