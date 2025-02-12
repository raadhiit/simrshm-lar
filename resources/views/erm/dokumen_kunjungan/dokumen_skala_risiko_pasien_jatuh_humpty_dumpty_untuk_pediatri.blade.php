<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMIS - Skala Risiko Pasien Jatuh Humpty Dumpty untuk pediatri</title>
   
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

        .custom-table td input.form-control {
            text-align: center;
            vertical-align: middle;
            /* width: 50%; */
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

        <div class="row pt-3 pb-3" style="width: 100%; margin-left: 0;">
            <div class="col-lg-8 mt-5">
                <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 80px;">
                {{-- <p class="font-weight-bold" style="font-size: 8pt;">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kec. Cibarusah, Kab. Bekasi - Jawa Barat (17340)<br>Telp.: (021) 8995 2340, Fax: (021) 8995 2340</p> --}}
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
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            <td>{{ $pasien->ktp }}</td>
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
                    </table>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h4 class="text-center mt-3 bold"> SKALA RISIKO JATUH HUMPTY DUMPTY UNTUK PEDIATRI</h4>
            <table class="table table-bordered custom-table">
                <tbody>    
                  <tr class="text-center">
                    <td class="font-weight-bold">Parameter</td>
                    <td class="font-weight-bold">Kriteria</td>
                    <td class="font-weight-bold">Nilai</td>
                    <td class="font-weight-bold" style="width: 50px;">Skor</td>
                  </tr>

                  <tr>
                    <td rowspan="5" class="font-weight-bold text-center"> Usia</td>
                  </tr>

                  <tr>
                    <td>&nbsp;< 3 tahun</td>
                    <td class="text-center">4</td>
                    <td rowspan="4" style="vertical-align: middle; text-align: center;" style="padding: 5px;">
                        <input type="text" id="usia" name="usia" class="form-control" value="{{ $data ? $data->usia : '' }}">
                     </td>
                  </tr>

                  <tr>
                    <td>&nbsp;3-7 tahun</td>
                    <td class="text-center">3</td>
                  </tr>

                  <tr>
                    <td>&nbsp;7-13 tahun</td>
                    <td class="text-center">2</td>
                  </tr>

                  <tr>
                    <td>&nbsp;>= 13 tahun</td>
                    <td class="text-center">1</td>
                  </tr>

                  <tr>
                    <td rowspan="3" class="font-weight-bold text-center"> Jenis Kelamin</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Laki-laki</td>
                    <td class="text-center">2</td>
                    <td rowspan="3" style="vertical-align: middle; text-align: center;">
                        <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" value="{{ $data ? $data->jenis_kelamin : '' }}">
                     </td>
                  </tr>

                  <tr>
                    <td>&nbsp;Perempuan</td>
                    <td class="text-center">1</td>
                  </tr>
                  {{-- --------------------------------- --}}
                  <tr>
                    <td rowspan="5" class="font-weight-bold text-center"> Diagnosis</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Diagnosis Neurologi</td>
                    <td class="text-center"> 4</td>
                    <td rowspan="4" style="vertical-align: middle; text-align: center;">
                        <input type="text" id="diagnosis" name="diganosis" class="form-control" value="{{ $data ? $data->diganosis : '' }}">
                     </td>
                  </tr>

                  <tr>
                    <td>&nbsp;Perubahan oksigenasi (diagnosis respiratorik, dehidrasi, anemia, anoreksia, sinkop, pusing, dsb)</td>
                    <td class="text-center">3</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Gangguan perilaku / psikiatri</td>
                    <td class="text-center">2</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Diagnosis lainnya</td>
                    <td class="text-center">1</td>
                  </tr>
                  {{-- --------------------------------- --}}
                  <tr>
                    <td rowspan="4" class="font-weight-bold text-center"> Gangguan Kognitif</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Tidak menyadari keterbatasan dirinya</td>
                    <td class="text-center"> 3</td>
                    <td rowspan="4" style="vertical-align: middle; text-align: center;">
                        <input type="text" id="gangguan_kognitif" name="gangguan_kognitif" class="form-control" value="{{ $data ? $data->gangguan_kognitif : '' }}">
                     </td>
                  </tr>

                  <tr>
                    <td>&nbsp;Lupa akan adanya keterbatasan</td>
                    <td class="text-center">2</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Orientasi baik terhadap diri sendiri</td>
                    <td class="text-center">1</td>
                  </tr>
                  {{-- --------------------------------- --}}
                  <tr>
                    <td rowspan="5" class="font-weight-bold text-center"> Faktor lingkungan</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Riwayat jatuh / bayi diletakkan di tempat tidur dewasa</td>
                    <td class="text-center"> 4</td>
                    <td rowspan="4" style="vertical-align: middle; text-align: center;">
                        <input type="text" id="faktor_lingkungan" name="faktor_lingkungan" class="form-control" value="{{ $data ? $data->faktor_lingkungan : '' }}">
                     </td>
                  </tr>

                  <tr>
                    <td>&nbsp;Pasien menggunakan alat bantu / bayi diletakkan dalam tempat tidur bayi / perabot rumah</td>
                    <td class="text-center">3</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Pasien diletakkan di tempat tidur</td>
                    <td class="text-center">2</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Area di luar rumah sakit</td>
                    <td class="text-center">1</td>
                  </tr>
                  {{-- --------------------------------- --}}
                  <tr>
                    <td rowspan="4" class="font-weight-bold text-center"> Pembedahan / Sedasi / anestesi</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Dalam 24 jam</td>
                    <td class="text-center"> 3</td>
                    <td rowspan="4" style="vertical-align: middle; text-align: center;">
                        <input type="text" id="pembedahan" name="pembedahan" class="form-control" value="{{ $data ? $data->pembedahan : '' }}">
                     </td>
                  </tr>

                  <tr>
                    <td>&nbsp;Dalam 48 jam</td>
                    <td class="text-center">2</td>
                  </tr>

                  <tr>
                    <td>&nbsp;> 48 jam atau tidak menjalani pembedaahan/sedasi/anestesi </td>
                    <td class="text-center">1</td>
                  </tr>
                  {{-- --------------------------------- --}}
                  <tr>
                    <td rowspan="4" class="font-weight-bold text-center"> Penggunaan medikamentosa</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Penggunaan multipel: sedatif, obat hipnosis, barbiturat, fenotiazin, <br>
                        &nbsp;antidepresan, pencahar, diuretik, narkose
                    </td>
                    <td class="text-center"> 3</td>
                    <td rowspan="3" style="vertical-align: middle; text-align: center;">
                        <input type="text" id="medikamentosa" name="medikamentosa" class="form-control" value="{{ $data ? $data->medikamentosa : '' }}">
                     </td>
                  </tr>

                  <tr>
                    <td>&nbsp;Penggunaan salah satu obat di atas</td>
                    <td class="text-center">2</td>
                  </tr>

                  <tr>
                    <td>&nbsp;Penggunaan medika lainnya / tidak ada medikasi </td>
                    <td class="text-center">1</td>
                  </tr>

                  <tr>
                    <td colspan="3" class="text-center font-weight-bold"> Jumlah Skor Humpty Dumpty</td>
                    <td class="text-center h6">
                        <input type="text" style="font-size: 18px;" id="total_skor" name="jumlah_skor" class="form-control text-center" value="{{ $data ? $data->jumlah_skor : '' }}">
                    </td>
                  </tr>
                
                 
                  {{-- <tr>
                    <td class="text-center">9</td>
                    <td>
                        Prognosis: <br/>
                        prognosis vital <br/>
                        prognosis fungsi <br/>
                        prognosis penyembuh
                    </td>
                    <td><input type="text" name="prognosis" class="form-control" value="{{ $data ? $data->prognosis : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_prognosis" {{ $data && $data->checkbox_prognosis == 'on' ? 'checked' : '' }}></td>
                  </tr>
                  <tr>
                    <td class="text-center">10</td>
                    <td>Alternatif & Risiko <br/>
                        Pilihan pengobatan/tatalaksana
                    </td>
                    <td><input type="text" name="alternatif" class="form-control" value="{{ $data ? $data->alternatif : '' }}"></td>
                    <td class="text-center"><input type="checkbox" name="checkbox_alternatif" {{ $data && $data->checkbox_alternatif == 'on' ? 'checked' : '' }}></td>
                  </tr> --}}
                </tbody>
            </table>

            <p>Skor asesment risiko jatuh: (skor minimum 7, skor maksimum 23)</p>
            <ul>
              <li>Skor 7-11 : risiko rendah</li>
              <li>Skor >= 12 : risiko tinggi</li>
            </ul>
            
            <div class="col-lg-12 pb-2 mt-3 text-center mb-5">
                <button type="submit" id="btn_simpan" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
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
        const fields = ['usia', 'jenis_kelamin', 'diagnosis', 'gangguan_kognitif', 'faktor_lingkungan', 'pembedahan', 'medikamentosa'];

        fields.forEach(field => {
            document.getElementById(field).addEventListener('input', calculateTotalScore);
        });

        function calculateTotalScore() {
            let totalScore = 0;

            fields.forEach(field => {
                const value = parseInt(document.getElementById(field).value) || 0;
                totalScore += value;
            });

            document.getElementById('total_skor').value = totalScore;
        }
    });
</script>

<script>
      $('#form_dokumen').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ url('e_rekam_medis/detail/skala_risiko_jatuh_humpty_dumpty_untuk_pediatri/store') }}",
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

</script>

</html>