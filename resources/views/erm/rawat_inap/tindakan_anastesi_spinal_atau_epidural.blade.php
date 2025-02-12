<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <title>INFORMASI TINDAKAN ANASTESI SPINAL ATAU EPIDURAL</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"defer></script>
    <style>
       .custom-table td{
            padding: 0;
            vertical-align: middle;
            border-color: black;
        }
       .custom-table th{
            border-color: black;
        }

    </style>
</head>

<body class="p-2">
    <div class="container">
        <div class="row align-items-stretch justify-conten-between">
            <div class="col-sm-12 col-md-5">
                <div class="w-100" style="border: 2px solid; padding:30px; font-weight: bold;">
                    <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="Logo" style="height: 112px;">
                    <p style="font-weight: bold">Jl. Raya Cibarusah No. 5 Kebon Kopi, Cibarusah Jaya<br />Kabupater Bekasi Jawa Barat (17340). Telp.: (021) 8995 2340<br />Email: info@rumahsakit-harapanmulia.id</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-5">
                <div class="w-100" style="border: 2px solid; padding:30px; font-weight: bold;height: 100%;">
                    <table>
                        <tr class="align-top">
                            <td>Nama</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            {{-- <td>{{ $dokumen->nama_pasien }}</td> --}}
                        </tr>
                        <tr class="align-top">
                            <td>No. RM</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            {{-- <td>{{ $dokumen->nrm }}</td> --}}
                        </tr>
                        <tr class="align-top">
                            <td>Tgl Lahir</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            {{-- <td>{{ Illuminate\Support\Carbon::parse($layanan->tgl_lahir)->format('d-m-Y') }}</td> --}}
                        </tr>
                        <tr class="align-top">
                            <td>Jenis Kelamin</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                            {{-- <td>{{ $layanan && !is_null($layanan->kelamin) ? ($layanan->kelamin == 1 ? 'Perempuan' : 'Laki-laki') : '-' }}</td> --}}
                        </tr>
                        <tr class="align-top">
                            <td>NIK</td>
                            <td style="padding-left: 10px; padding-right: 10px;"> : </td>
                        </tr>
                    </table>
                    <p class="text-right" style="font-weight: normal">
                        <i> *Tempel Label</i>
                    </p>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <table class="table table-bordered table-0 custom-table">
                <thead>
                  <tr>
                    <th scope="col" colspan="8" class="text-center" style="background-color: lightgrey; margin-bottom:0; border-color: black;">DOKUMENTASI PEMBERIAN INFORMASI TINDAKAN ANESTESI SPINAL/EPIDURAL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="2">
                        Dokter Pelaksana Tindakan
                    </td>
                    <td colspan="2">
                        <input type="text" name="" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                        Pemberi Informasi
                    </td>
                    <td colspan="2">
                        <input type="text" name="" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 0; vertical-align: middle;">Penerima Informasi / <br> Pemberi Persetujuan</td>
                    <td colspan="2"  ><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr class="text-center" >
                    <td class="font-weight-bold" >NO</td>
                    <td class="font-weight-bold" style="width: 20%">JENIS INFORMASI</td>
                    <td class="font-weight-bold">ISI INFORMASI</td>
                    <td class="font-weight-bold">TANDA (V)</td>
                  </tr>
                  <tr>
                    <td class="text-center">1</td>
                    <td >Diagnosa</td>
                    <td ><input type="text" name="" class="form-control"></td>
                    <td ><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">2</td>
                    <td >Dasar Diagnosis</td>
                    <td >
                        <input type="checkbox" name="">Anamnesis, 
                        <input type="checkbox" name="">Pemeriksaan Fisik,
                        <input type="checkbox" name="">Hasil Pemeriksaan Laboratorium,
                        <input type="checkbox" name="">EKG,
                        <input type="checkbox" name="">Pemeriksaan Radiologi (Toraks, MRI, USG, dll),
                        <input type="checkbox" name="">Lain-lain
                    </td>
                    <td ><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">3</td>
                    <td>Tindakan Kedokteran</td>
                    <td>Anestesi Spinal/Epidural</td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">4</td>
                    <td>Indikasi Tindakan</td>
                    <td><input type="text" name="" class="form-control"></td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">5</td>
                    <td>Tata Cara:
                    </td>
                    <td>
                        <ul>
                            <li>
                                Pada Spinal, disuntik dengan jarum khusus yang sangat Halus (25/26/27 quinge) didaerah sela tulang punggung ke dalam sumsum tulang belakang.
                            </li>
                            <li>
                                Pada epidural, daerah yang akan ditusuk jarum khusus ukuran besar, yang sebelumnya disuntikan obat bius lokal penghilang nyeri tusukan, melalui jarum epidural yang dapat dimasukan selang halus kearah ruangan disekeliling ruangan sumsum tulang belakang yang berfungsi untuk menyalurkan obat bius ke syaraf yang ada disekitar.
                            </li>
                            <li>
                                Penyuntikan spinal/epidural dilakukan pada posisi duduk membungkuk atau tidur meringkuk miring ke salah satu sisi.
                            </li>
                            <li>
                                Saat obat dimauskan, pasien akan merasakan hangat dipunggungnya, kedua tungkai akan terasa kesemutan dan lama kelamaan berat, tidak dapat digerakan seolah-olah kedua tungkai hilang.
                            </li>
                            
                        </ul>
                    </td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">6</td>
                    <td>Tujuan</td>
                    <td>
                        <ul>
                            <li>Anestesi Spinal/Epidural : pembiusan setengah badan meliputi daerah perut sampai ujung kaki dengan pasien tetap sadar tanpa merasakan nyeri saat operasi</li>
                        </ul>
                    </td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">7</td>
                    <td>Risiko</td>
                    <td>
                        <ul>
                            <li>Dapat timbul reaksi alergi/hypersensitif terhadap obat, mulai derajat ringan hingga berat/fatal</li>
                            <li>
                                Dapat terjadi gangguan pernafasan sementara dari ringan/agak berat/sampai berat (henti nafas) yang dapat diatasi dengan alat bantu nafas
                            </li>
                            <li>
                                Dapat terjadi kelumpuhan/kesemutan/rasa baal ditungkai yang memanjang bersifat semenntara dan bisa sembuh kembali.
                            </li>
                            <li>
                                Dapat terjadi nyeri pinggang pasca bedah bersifat sementara.
                            </li>
                            <li>
                                Untuk epidural dapat terjadi kejang bila obat masuk dalam pembuluh darah (jarang terjadi) dan dapat ditangani sesuai prosedur tanpa gejala sisa.
                            </li>
                        </ul>
                    </td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">8</td>
                    <td>Komplikasi</td>
                    <td>
                        <ul>
                            <li>
                                Pasca bedah dapat berupa mual/mentah, menggigil, gatal-gatal terutama dimuka/daerah wajah dan bisa diatasi dengan obat.
                            </li>
                            <li>
                                Efek samping yang jarang terjadi yaitu sakit kepala bagian depan/belakang pada hari kedua/ketiga terutama pada waktu mengangkat kepala dan akan menghilang setelah 5-7 hari, jika tidak hilang akan diberikan terapi pengobatan.
                            </li>
                            <li>
                                Mungkin dapat terjadi kesulitan buang air kecil, dapat diatasi dengan pemasangan selang urine.
                            </li>
                        </ul>
                    </td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">9</td>
                    <td>
                        Prognosis:
                    </td>
                    <td>Bergantung kondisi/status fisik ASA Pasien</td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">10</td>
                    <td>Alternatif</td>
                    <td>Bila gagal spinal/epidural dapat dilanjutkan dengan pembiusan total</td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td class="text-center">11</td>
                    <td>lain-lain  
                    </td>
                    <td>
                        <ul>
                            <li>
                                Mobilisasi duduk baru dapat dilakukan setelah 12 jam dan berdiri setelah 24 jam untuk menghindari nyeri kepala.
                            </li>
                            <li>
                                Jumlah obat yang diberikan sedikit sekali (epidural jumlah obat lebih banyak)
                            </li>
                            <li>
                                Obat bius tidak masuk ke dalam ari ari atau rahim, sehingga baik untuk operasi sesar/sectio sesaria.
                            </li>
                            <li>
                                Obat tidak mempengaruhi organ lain dalam tubuh/pengaruhnya minimal dan dapat ditambahkan obat penghilang sakit sesuai kebutuhan 24 jam pertama, epidural dapat ditambahkan berkelanjutan (anti nyeri) sesuai kebutuhan. <br>
                                Bila tidak mual/muntah pasca bedah bisa langsung minum tanpa harus menunggu buang angin.
                            </li>
                        </ul>
                    </td>
                    <td><input type="text" name="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td colspan="3">Dengan ini menyatakan bahwa saya perwakilan dari Rumah Sakit, telah menerangkan hal-hal diatas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan berdiskusi</td>
                    <td>.........</td>
                  </tr>
                  <tr>
                    <td colspan="3">Dengan ini menyatakan saya/keluarga pasien telah menerima informasi dari dokter, sebagaimana diatas saya beri tanda tangan/paraf dikolom kananya serta telah diberi kesempatan untuk bertanya/berdiskusi dan telah memahaminya</td>
                    <td>.........</td>
                  </tr>
                  <tr>
                    <td colspan="4" style="font-size: 14px;">
                        *Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat. <br/>
                    </td>
                  </tr>
                 
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12">
                <h4 class="text-center">PERNYATAAN PERSETUJUAN/PENOLAKAN TINDAKAN KEDOKTERAN <br> ANESTESI SPINAL/EPIDURAL</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">    
                    <p>
                        Yang bertanda tangan dibawah ini :
                    </p>
                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                        <tr class="align-top">
                            <td style="width: 12%;">Nama</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">
                            </td>
                        </tr>
    
                        <tr class="align-top">
                            <td style="width: 12%;">Tgl Lahir</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"> 
                            </td>
                        </tr>    
                        <tr class="align-top">
                            <td style="width: 12%;">Alamat</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"> 
                            </td>
                        </tr>    
                    </table>

                    <p> Dengan ini menyatakan <span style="font-weight: bold;">  <input type="checkbox" name=""> SETUJU / <input type="checkbox" name=""> TIDAK SETUJU </span> untuk dilakukan tindakan <span style="font-weight: bold"> <input type="checkbox" name="">  ANESTESI SPINAL / <input type="checkbox" name=""> EPIDURAL </span> kepada 
                        <input type="checkbox" name=""> Saya Sendiri /
                        <input type="checkbox" name=""> Suami /
                        <input type="checkbox" name=""> Istri /
                        <input type="checkbox" name=""> Anak /
                        <input type="checkbox" name=""> Ayah /
                        <input type="checkbox" name=""> Ibu /
                        <input type="text" name="" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">
                        yang bernama :
                    </p>

                    <table style="border-collapse: collapse; width:100%" class="mb-3">
                        <tr class="align-top">
                            <td style="width: 12%;">Nama</td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control">
                            </td>
                        </tr>
    
                        <tr class="align-top">
                            <td style="width: 12%;">Tgl Lahir </td>
                            <td style="width: 3%;"> : </td>
                            <td style="width: 85%;">
                                <input type="text" name="" style="border:1px solid transparent; border-bottom: 2px dotted; background-color: transparent;" class="form-control"> 
                            </td>
                        </tr>      
                    </table>
    
                    <p class="mt-3">
                        Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul. <br> Saya juga menyadari bahwa oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.
                    </p>
    
                    <p class="mt-5 text-right mb-5">
                        Bekasi, <input type="date" style="border:1px solid transparent; border-bottom: 2px dotted; width: 40% background-color: transparent;">
                        Jam <input type="time" name="">WIB
                    </p>
    
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-6 text-center ">
                            Yang Menyatakan
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            (............................................)<br>
                            Ttd & Nama Terang
                        </div>
    
                        <div class="col-md-6 text-center">
                            Dokter
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            (............................................)<br>
                            Ttd & Nama Terang
                        </div>
                    </div>
            </div>
        </div>

        <p class="mt-5" style="font-size: 14px; font-style: italic;">*Coret yang Tidak Perlu</p>
        <p class="font-weight-bold">RSHM/OK/12.02/Rev.01</p>
    </div>

</body>

</html>