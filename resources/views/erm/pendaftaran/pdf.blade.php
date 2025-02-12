<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>General Consent</title>
    <style>
        .half_column {
            float: left;
            width: 50%;
            border: 1px solid;
        }

        .column {
            float: left;
            width: 100%;
            border: 1px solid;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        #tabel_kop_identitas tr {
            line-height: 2;
            font-size: 14px;
        }

        #tabel_pj tr {
            line-height: 1.4;
        }

        .pagebreak {
            page-break-before: always;
        }
    </style>
</head>

<body style="border: 1px solid">
    <div style="border:1px solid; width: 15%; text-align: center; position: absolute; right:0; top:-15;">RM.RJ.1.1/2
    </div>
    <div class="row" style="width:96.7%;">
        <div class="half_column" style="padding: 10px; height:80px;">
            <img src="{{ asset('filelogo/logo_rs.png') }}" alt="" style="width: 20%;">
            <p style="font-weight: bold; padding-left: 60px; text-align: center; margin-top:-75px;">
                RUMAH SAKIT ISLAM JOMBANG<br>
                <span style="font-weight: normal">Jl. Brigjen Kretarto 22 A<br>Telp : (0321) 860074 -
                    868972</span>
                <br>Jombang
            </p>
        </div>
        <div class="half_column" style="height: 100px;">
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 18px;">
                <tr>
                    <td style="padding-left: 10px;">Nama</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $dokumen->nama_pasien }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">No. Rekam Medis</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $dokumen->nrm }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">Tgl. Lahir</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="width: 99.8%; margin-top: -2px;">
        <div class="column">
            <p style="font-size: 14px; font-weight: bold; text-align: center; padding-top: 10px;">PERSETUJUAN UMUM
                (GENERAL CONSENT)</p>
        </div>
    </div>
    <div class="row" style="width: 99.8%; margin-top: -2px;">
        <div class="column" style="padding-bottom: 30px; border:1px solid transparent;">
            <p style="font-size: 14px; font-weight: bold; text-align: center; padding-top: 10px;">PASIEN DAN WALI
                DI
                MOHON MEMBACA, MEMAHAMI DAN MENGISI
                <br>INFORMASI BERIKUT
            </p>
            <p style="padding-left: 10px;">
                Yang bertanda tangan dibawah ini :
            </p>
            <table id="tabel_pj" style="border-collapse: collapse; width: 100%;">
                <tr>
                    <td style="padding-left: 25px; width:30%;">Nama</td>
                    <td style="width:5%;"> : </td>
                    <td style="width: 65%;">
                        {{ $dokumen->nama_pj }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 25px; width:30%;">Tanggal Lahir</td>
                    <td style="width:5%;"> : </td>
                    <td style="width: 65%;">
                        {{ date('Y-m-d', strtotime($dokumen->tgl_lahir_pj)) }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 25px; width:30%;">Alamat</td>
                    <td style="width:5%;"> : </td>
                    <td style="width: 65%;">
                        {{ $dokumen->alamat_pj }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 25px; width:30%;">Nomor telepon</td>
                    <td style="width:5%;"> : </td>
                    <td style="width: 65%;">
                        {{ $dokumen->telp_pj }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 25px; width:30%;">Hubungan dengan pasien</td>
                    <td style="width:5%;"> : </td>
                    <td style="width: 65%;">
                        {{ $dokumen->hubungan }}
                    </td>
                </tr>
                <tr style="line-height: 2.5;">
                    <td colspan="3" style="padding-left: 10px;">Adalah penanggung jawab untuk Pasien : </td>
                </tr>
                <tr>
                    <td style="padding-left: 25px; width:30%;">Nama</td>
                    <td style="width:5%;"> : </td>
                    <td style="width: 65%;">
                        {{ $dokumen->nama_pasien }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 25px; width:30%;">Tanggal Lahir</td>
                    <td style="width:5%;"> : </td>
                    <td style="width: 65%;">
                        {{ date('Y-m-d', strtotime($pasien->tgl_lahir)) }}
                    </td>
                </tr>
            </table>
            <p style="padding-left: 10px; margin-top: 20px;">
                Dengan ini menyatakan persetujuan :
            </p>
            <p style="font-weight: bold; padding-left:10px;">A. PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Saya menyetujui untuk perawatan di Rumah Sakit Islam Jombang sebagai pasien rawat jalan atau
                    rawat inap tergantung kepada kebutuhan medis. Pengobatan dapat meliputi pemeriksaan x-ray /
                    radiologi, elektrokardiogram (ECG), tes darah, tindakan fisioterapi, pemberian obat (injeksi,
                    oral, per
                    rectal, per vagina dan inhalasi), infuse, pasang NGT (Naso Gastric Tube), OGT (Oral Gastric
                    Tube),
                    kateter urine dan evaluasi (contohnya wawancara dan pemeriksaan fisik)
                </li>
                <li style="text-align: justify">
                    Persetujuan yang saya berikan tidak termasuk persetujuan untuk prosedur / tindakan invasive
                    (misalnya Operasi) atau tindakan yang mempunyai resiko tinggi
                </li>
                <li style="text-align: justify">
                    Jika saya memutuskan untuk menghentikan perawatan medis untuk diri saya sendiri, Saya memahami
                    dan menyadari bahwa Rumah Sakit Islam Jombang atau Dokter tidak bertanggung jawab atas hasil
                    yang merugikan saya
                </li>
                <li style="text-align: justify">
                    Saya sadar bahwa praktik kedokteran dan bedah bukanlah ilmu pasti dan saya mengakui bahwa tidak
                    ada jaminan atas hasil apapun terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan
                    kepada saya
                </li>
                <li style="text-align: justify">
                    Saya mengerti dan memahami bahwa:
                    <ul style="list-style-type: lower-alpha">
                        <li style="text-align: justify">
                            Saya memiliki hak untuk mengajukan pertanyaan tentang pengobatan yang diusulkan
                            (termasuk
                            identitas setiap orang yang memberikan atau mengamati pengobatan) setiap saat
                        </li>
                        <li style="text-align: justify">
                            Saya memiliki hak untuk persetujuan atau menolak persetujuan, untuk setiap prosedur /
                            terapi
                        </li>
                        <li style="text-align: justify">
                            Banyak dokter dan tenaga kesehatan rumah sakit yang bukan staf tetapi staf tamu yang
                            telah
                            diberikan hak menggunakan fasilitas untuk perawatan dan pengobatan pasien mereka
                        </li>
                    </ul>
                </li>
                <li style="text-align: justify">
                    Saya akan menggunakan fasilitas :
                    <ul style="list-style-type: lower-alpha">
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'umum' ? 'checked' : '' }} name="carabayar"
                                value="umum"> Umum Reguler (Bayar
                            Sendiri)&emsp;
                        </li>
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'bpjs_tenaker' ? 'checked' : '' }}
                                name="carabayar" value="bpjs_tenaker"> BPJS
                            Ketenagakerjaan&emsp;
                        </li>
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'bpjs' ? 'checked' : '' }} name="carabayar"
                                value="bpjs"> BPJS Kesehatan&emsp;
                        </li>
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'bpjs_persero' ? 'checked' : '' }}
                                name="carabayar" value="bpjs_persero"> BPJS Kesehatan dengan
                            kasus Kecelakaan Lalu Lintas yang ditanggung PT. Jasa Raharja
                            (Persero)&emsp;
                        </li>
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'rencana_bpjs' ? 'checked' : '' }}
                                name="carabayar" value="rencana_bpjs"> Rencana BPJS
                            Kesehatan&emsp;
                        </li>
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'rencana_bpjs_persero' ? 'checked' : '' }}
                                name="carabayar" value="rencana_bpjs_persero"> Rencana BPJS
                            Kesehatan dengan kasus Kecelakaan Lalu Lintas yang ditanggung PT. Jasa
                            Raharja (Persero)&emsp;
                        </li>
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'asauransi' ? 'checked' : '' }}
                                name="carabayar" value="asuransi"> PT. Asuransi Jiwa Inhealth
                            Indonesia&emsp;
                        </li>
                        <li>
                            <input type="radio" {{ $dokumen->carabayar == 'lain' ? 'checked' : '' }} name="carabayar"
                                value="lain"> Lain-Lain : {{ $dokumen->carabayar_lain }}
                        </li>
                    </ul>
                </li>
            </ul>
            <p style="font-weight: bold; padding-left:10px;">B. PERSETUJUAN PELEPASAN INFORMASI</p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Saya memahami informasi yang ada dalam diri saya, termasuk diagnosis, hasil laboratorium dan
                    hasil tes diagnostik yang akan digunakan untuk perawatan medis, Rumah Sakit Islam Jombang akan
                    menjamin kerahasiaannya
                </li>
                <li style="text-align: justify">
                    Saya memberikan wewenang kepada rumah sakit untuk memberikan informasi tentang diagnosis,
                    hasil pelayanan dan pengobatan bila diperlukan untuk memproses klaim asuransi
                    kesehatan/perusahaan dan atau lembaga pemerintah
                </li>
                <li style="text-align: justify">
                    Saya memberikan wewenang kepada rumah sakit untuk memberikan informasi tentang diagnosis
                    hasil pelayanan dan hasil pengobatan saya kepada
                    <ul style="list-style-type: lower-alpha">
                        @php
                            $temp = [
                                json_decode(
                                    json_encode([
                                        'nama' => '',
                                        'hubungan' => '',
                                    ]),
                                ),
                                json_decode(
                                    json_encode([
                                        'nama' => '',
                                        'hubungan' => '',
                                    ]),
                                ),
                                json_decode(
                                    json_encode([
                                        'nama' => '',
                                        'hubungan' => '',
                                    ]),
                                ),
                            ];
                        @endphp
                        @if ($dokumen->pelepasan_informasi != '')
                            @php
                                $temp = json_decode($dokumen->pelepasan_informasi);
                            @endphp
                        @endif
                        <li>
                            {{ $temp[0]->nama != '' ? $temp[0]->nama : '.........................' }}
                            ({{ $temp[0]->hubungan != '' ? $temp[0]->hubungan : '.........................' }})
                        </li>
                        <li>
                            {{ $temp[1]->nama != '' ? $temp[1]->nama : '.........................' }}
                            ({{ $temp[1]->hubungan != '' ? $temp[1]->hubungan : '.........................' }})
                        </li>
                        <li>
                            {{ $temp[2]->nama != '' ? $temp[2]->nama : '.........................' }}
                            ({{ $temp[2]->hubungan != '' ? $temp[2]->hubungan : '.........................' }})
                        </li>
                    </ul>
                </li>
            </ul>
            <p style="font-weight: bold; padding-left: 10px;">C. KEINGINAN PRIVASI PASIEN</p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Saya <span
                        style="{{ $dokumen->mengijinkan != '1' ? 'text-decoration:line-through' : '' }}">mengijinkan</span>
                    atau
                    <span style="{{ $dokumen->mengijinkan != '0' ? 'text-decoration:line-through' : '' }}">
                        tidak mengijinkan</span> rumah sakit
                    memberikan akses bagi
                    keluarga serta orang-orang yang menengok / menemui saya (sebut nama / profesi bila ada
                    permintaan khusus)<br>
                    {{ $dokumen->deskripsi_mengijinkan }}
                </li>
                <li class="pt-3" style="text-align: justify">
                    Saya <input {{ $dokumen->privasi_khusus == '1' ? 'checked' : '' }} type="radio"
                        name="menginginkan" value="1"> menginginkan atau <input type="radio"
                        {{ $dokumen->privasi_khusus == '0' ? 'checked' : '' }} name="menginginkan" value="0">
                    tidak menginginkan privasi khusus
                    sebutkan bila ada
                    permintaan privasi khusus.<br>
                    {{ $dokumen->deskripsi_privasi }}
                </li>
            </ul>
            <p style="font-weight: bold; padding-left: 10px;">D. HAK DAN KEWAJIBAN PASIEN</p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Saya memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit saya dan dalam
                    hal perawatan medis dan rencana pengobatan.
                </li>
                <li style="text-align: justify">
                    Saya telah mendapat informasi tentang “Hak Dan Tanggung Jawab Pasien” di Rumah Sakit Islam
                    Jombang sebagai berikut:
                </li>
            </ul>
            <p style="font-weight: bold; font-size:16px; padding-left:20px;">Hak – hak Pasien (Peraturan Menteri
                Kesehatan Republik
                Indonesia Nomor 4 Tahun 2018)
                meliputi:</p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Memperoleh informasi mengenai tata tertib dan peraturan yang berlaku di Rumah Sakit
                </li>
                <li style="text-align: justify">
                    Memperoleh informasi tentang hak dan kewajiban Pasien
                </li>
                <li style="text-align: justify">
                    Memperoleh layanan yang manusiawi, adil, jujur, dan tanpa diskriminasi
                </li>
                <li style="text-align: justify">
                    Memperoleh layanan kesehatan yang bermutu sesuai dengan standard profesi dan standard prosedur
                    operasional
                </li>
                <li style="text-align: justify">
                    Memperoleh layanan yang efektif dan efisien sehingga Pasien terhindar dari kerugian fisik dan
                    materi
                </li>
                <li style="text-align: justify">
                    Mengajukan pengaduan atas kualitas pelayanan yang didapatkan
                </li>
                <li style="text-align: justify">
                    Memilih dokter, dokter gigi, dan kelas perawatan sesuai dengan keinginannya dan peraturan yang
                    berlaku di Rumah Sakit
                </li>
                <li style="text-align: justify">
                    Meminta konsultasi tentang penyakit yang dideritanya kepada dokter lain yang mempunyai Surat
                    Izin
                    Praktik (SIP) baik di dalam maupun di luar Rumah Sakit
                </li>
                <li style="text-align: justify">
                    Mendapatkan privasi dan kerahasiaan penyakit yang diderita termasuk data medisnya
                </li>
                <li style="text-align: justify">
                    Mendapat informasi yang meliputi diagnosis dan tata cara tindakan medis, tujuan tindakan medis,
                    alternatif tindakan, risiko dan komplikasi yang mungkin terjadi, dan prognosis terhadap tindakan
                    yang dilakukan serta perkiraan biaya pengobatan
                </li>
                <li style="text-align: justify">
                    Memberikan persetujuan atau menolak atas tindakan yang akan dilakukan oleh Tenaga Kesehatan
                    terhadap penyakit yang dideritanya
                </li>
                <li style="text-align: justify">
                    Didampingi keluarganya dalam keadaan kritis
                </li>
                <li style="text-align: justify">
                    Menjalankan ibadah sesuai agama atau kepercayaan yang dianutnya selama hal itu tidak mengganggu
                    Pasien lainnya
                </li>
                <li style="text-align: justify">
                    Memperoleh keamanan dan keselamatan dirinya selama dalam perawatan di Rumah Sakit
                </li>
                <li style="text-align: justify">
                    Mengajukan usul, saran, perbaikan atas perlakuan Rumah Sakit terhadap dirinya
                </li>
                <li style="text-align: justify">
                    Menolak pelayanan bimbingan rohani yang tidak sesuai dengan agama dan kepercayaan
                    yang dianutnya
                </li>
                <li style="text-align: justify">
                    Menggugat dan/atau menuntut Rumah Sakit apabila Rumah Sakit diduga memberikan
                    pelayanan yang tidak sesuai dengan standard baik secara perdata ataupun pidana
                </li>
                <li style="text-align: justify">
                    Mengeluhkan pelayanan Rumah Sakit yang tidak sesuai dengan standard pelayanan melalui
                    media cetak dan elektronik sesuai dengan ketentuan peraturan perundang-undangan
                </li>
            </ul>
        </div>
    </div>
    <div class="pagebreak"></div>
    <div style="border:1px solid; width: 15%; text-align: center; position: absolute; right:0; top:-15;">RM.RJ.1.2/2
    </div>
    <div class="row" style="width:96.7%;">
        <div class="half_column" style="padding: 10px; height:80px;">
            <img src="{{ asset('filelogo/logo_rs.png') }}" alt="" style="width: 20%;">
            <p style="font-weight: bold; padding-left: 60px; text-align: center; margin-top:-75px;">
                RUMAH SAKIT ISLAM JOMBANG<br>
                <span style="font-weight: normal">Jl. Brigjen Kretarto 22 A<br>Telp : (0321) 860074 -
                    868972</span>
                <br>Jombang
            </p>
        </div>
        <div class="half_column" style="height: 100px;">
            <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 18px;">
                <tr>
                    <td style="padding-left: 10px;">Nama</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $dokumen->nama_pasien }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">No. Rekam Medis</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $dokumen->nrm }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">Tgl. Lahir</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="width: 99.8%; margin-top: -2px;">
        <div class="column" style="padding-bottom: 30px; border:1px solid transparent;">
            <p style="font-weight: bold; font-size:16px; padding-left: 20px;">Kewajiban Pasien (Peraturan Menteri
                Kesehatan Republik
                Indonesia Nomor 4 Tahun 2018)
                meliputi:</p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Mematuhi peraturan yang berlaku di Rumah Sakit
                </li>
                <li style="text-align: justify">
                    Menggunakan fasilitas Rumah Sakit secara bertanggungjawab
                </li>
                <li style="text-align: justify">
                    Menghormati hak Pasien lain, pengunjung dan hak Tenaga Kesehatan serta petugas lainnya yang
                    bekerja di Rumah Sakit
                </li>
                <li style="text-align: justify">
                    Memberikan informasi yang jujur, lengkap dan akurat sesuai dengan kemampuan dan
                    pengetahuannya tentang masalah kesehatannya
                </li>
                <li style="text-align: justify">
                    Memberikan informasi mengenai kemampuan finansial dan jaminan kesehatan yang dimilikinya
                </li>
                <li style="text-align: justify">
                    Mematuhi rencana terapi yang direkomendasikan oleh Tenaga Kesehatan di Rumah Sakit dan
                    disetujui oleh pasien yang bersangkutan setelah mendapatkan penjelasan sesuai dengan ketentuan
                    peraturan perundang-undangan
                </li>
                <li style="text-align: justify">
                    Menerima segala konsekuensi atas keputusan pribadinya untuk menolak rencana terapi yang
                    direkomendasikan oleh Tenaga Kesehatan dan/atau tidak mematuhi petunjuk yang diberikan oleh
                    Tenaga Kesehatan untuk penyembuhan penyakit atau masalah kesehatannya; dan
                </li>
                <li style="text-align: justify">
                    Memberikan imbalan jasa atas pelayanan yang diterima
                </li>
            </ul>
            <p style="font-weight: bold; padding-left: 10px;">E. INFORMASI RAWAT JALAN</p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Saya telah menerima tentang peraturan yang telah diberlakukan oleh rumah sakit dan saya beserta
                    keluarga bersedia untuk mematuhi termasuk akan mematuhi jam berkunjung pasien sesuai dengan
                    aturan di rumah sakit.
                </li>
                <li style="text-align: justify">
                    Anggota keluarga saya yang menunggu bersedia untuk selalu memakai tanda pengenal khusus yang
                    selalu diberikan oleh rumah sakit dan demi keamanan seluruh pasien setiap keluarga dan siapapun
                    yang akan menunggu saya diluar jam berkunjung, bersedia untuk diminta / diperiksa identitasnya.
                </li>
            </ul>
            <p style="font-size:16px; padding-left:20px;">Tata tertib pelanggan / pengunjung / pengguna Jasa
                Pelayan RSI Jombang, meliputi:</p>
            <ul style="list-style-type: lower-alpha; padding-left: 60px; width:90%;">
                <li style="text-align: justify">Tidak diperkenankan merokok</li>
                <li style="text-align: justify">Membuang sampah pada tempat yang telah disediakan sesuai dengan
                    jenis sampah</li>
                <li style="text-align: justify">Tidak diperkenankan membuat gaduh</li>
                <li style="text-align: justify">Tidak membawa dan memakan makanan yang berbau tajam (misalnya :
                    durian) di lingkungan
                    rumah sakit</li>
                <li style="text-align: justify">Tidak membawa anak usia dibawah 10 tahun (kecuali Pasien) masuk
                    lingkungan rumah sakit
                    untuk menghindari tertularnya penyakit</li>
                <li style="text-align: justify">Tidak diperkenankan membeli dan membawa makanan beserta
                    peralatannya dari luar food court
                    RSI Jombang ke area pelayanan rawat jalan</li>
            </ul>
            <p style="font-weight: bold; padding-left: 10px;">F. INFORMASI BIAYA</p>
            <p style="padding-left: 20px; text-align: justify; width:90%;">
                Saya memahami tentang informasi biaya pengobatan atau <span
                    style="font-weight: bold; text-decoration: underline">biaya tindakan yang dijelaskan oleh staf
                    rumah sakit.</span>
            </p>
            <p style="font-weight: bold; padding-left: 10px;">G. INFORMASI PENGADUAN</p>
            <p style="padding-left: 20px; text-align: justify">
                Saya telah menerima informasi tentang mekanisme penyampaian pengaduan di RSI Jombang:</span>
            </p>
            <ul style="list-style-type: number; width:90%;">
                <li style="text-align: justify">
                    Pengaduan dapat disampaikan secara langsung kepada staf di unit pelayanan atau langsung kepada
                    Bagian Humas.
                </li>
                <li style="text-align: justify">
                    Sarana pengaduan :
                </li>
                <li style="text-align: justify">
                    Sarana pengaduan :
                    <ul style="list-style-type: square">
                        <li>WA/SMS/ Telepon, dengan nomor 081336937743</li>
                        <li>Kotak saran.</li>
                        <li>Scan barcode layanan pengaduan</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="column" style="border: 1px solid transparent;">
            <p style="font-size:20px; margin-top: 100px; font-weight: bold; text-align: center">TANDA TANGAN</p>
            <p style="padding-left: 10px;">Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah membaca dan memahami
                item pada Persetujuan Umum / <span style="font-style:italic">General Consent</span></p>
        </div>
    </div>
    <div class="row">
        <div class="half_column" style="text-align: center; border:1px solid transparent;">
            <p>Staf</p>
            <br>
            <br>
            <a href="#" style="color: #111; text-decoration: none;" onclick="open_modal_verifikasi()"><img
                    style="width: 5cm; height:2.5cm;"
                    src="{{ env('SMIS_UPLOAD') . ($employee ? $employee->ttd : '') }}" alt="">
            </a>
            <p>
                ({{ $dokumen->nama_verifikator }})<br>
                Tanda tangan & Nama terang
            </p>
        </div>
        <div class="half_column" style="text-align: center; border:1px solid transparent;">
            <p>
                Jombang
                {{ $dokumen->created_at ? date('d-m-Y', strtotime($dokumen->created_at)) : '........................' }},
                Pukul
                {{ $dokumen->created_at ? date('H:i', strtotime($dokumen->created_at)) : '..............' }}<br>
                Yang membuat pernyataan
            </p>
            <br>
            <a href="#" style="color: #111; text-decoration: none;" onclick="open_modal_tanda_tangan()"><img
                    style="width: 5cm; height:2.5cm;" src="{{ asset('tanda_tangan/' . $dokumen->ttd_pj) }}"
                    alt="">
            </a>
            <p>
                ({{ $dokumen->nama_pj }})<br>
                Tanda tangan & Nama terang
            </p>
        </div>
    </div>
</body>

</html>
