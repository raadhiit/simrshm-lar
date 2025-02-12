<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>General Consent</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">

    <style type="text/css">
        .half_column {
            float: left;
            width: 50%;
            border: 1px solid;
        }

        #data_diri_header tr td {
            font-size: 10px;
            vertical-align: top;
        }

        #data_diri_ttd tr td {
            font-size: 14px;
            vertical-align: top;
        }

        #list_numbering li {
            font-size: 14px;
            list-style-type: decimal;
        }

        #list_alfabeth li {
            font-size: 14px;
            list-style-type: lower-alpha;
        }

        p {
            font-size: 14px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            color: #111;
        }

        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>

<body style="border:1px solid;">
<footer>
    <div class="row" style="width: 100%; margin-left: 0;">
        <div style="width: 50%; float:left;">
            Halaman <span class="pagenum"></span>
        </div>
        <div style="width: 50%; float:left; text-align:right; color:#777; font-style:italic;">
            MR. 04.06.001.Rev.1
        </div>
    </div>
</footer>
<div class="row" style="width:96.7%; margin-left: 0px">
    <div class="half_column" style="padding: 10px; height:120px;">
        <img src="{{ asset('filelogo/logo_rshm.png') }}" alt="" style="width: 20%;">
        <p style="font-weight: bold; padding-left: 60px; text-align: center; margin-top:-75px;">
            RUMAH SAKIT HARAPAN MULIA<br>
            <span style="font-weight: normal; font-size: 14px">
                Jl. Raya Cibarusah No. 5 Kebon Kopi
                <br>Cibarusah Jaya
                <br>Kabupaten Bekasi Jawa Barat (17340).
                <br>Telp.: (021) 8995 2340
                <br>Email : info@rumahsakit-harapanmulia.id
            </span>
        </p>
    </div>
    <div class="half_column" style="height: 140px;">
        <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 13px;">
            <tr>
                <td style="padding-left: 10px;">Nama</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->nama }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">No. Rekam Medis</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->nrm }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Tgl. Lahir</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ date('d-m-Y', strtotime($layanan->tgl_lahir)) }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">Jenis Kelamin</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">NIK</td>
                <td class="pl-2 pr-2"> :</td>
                <td>{{ $layanan->ktp }}</td>
            </tr>
            {{-- <br> --}}
            <tr>
                <td colspan="3" style="text-align: right">*Tempel Label</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div style="float: left; width: 96%; background: black; margin-left: 14px; margin-top: -1px">
        <p style="color: white; text-align: center; justify-items: center">PERSETUJUAN UMUM (GENERAL CONSENT)</p>
    </div>
</div>
<div style="padding-left: 10px;">
    <table style="border-collapse:collapse; width:100%;" id="data_diri_ttd">
        <tr>
            <td colspan="3">Yang bertanda tangan dibawah ini :</td>
        </tr>
        <tr>
            <td style="width:25%;">Nama</td>
            <td style="width:4%;"> :</td>
            <td style="width: 71%;">
                {{ $dokumen->general_consent ? $dokumen->general_consent->nama : $layanan->nama_pasien}}
            </td>
        </tr>
        <tr>
            <td style="width:25%;">Alamat</td>
            <td style="width:4%;"> :</td>
            <td style="width: 71%;">
                {{ $dokumen->general_consent ? $dokumen->general_consent->alamat : $layanan->alamat.', RT '.$layanan->rt.' RW '.$layanan->rw.', '.$layanan->nama_kelurahan.', '.$layanan->nama_kecamatan.', '.$layanan->nama_kabupaten }}
            </td>
        </tr>
        <tr>
            <td style="width:25%;">Telepon</td>
            <td style="width:4%;"> :</td>
            <td style="width: 71%;">
                {{ $dokumen->general_consent ? $dokumen->general_consent->telpon : $layanan->telpon}}
            </td>
        </tr>
        <tr>
            <td style="width:25%;">No. Identitas/KTP/SIM</td>
            <td style="width:4%;"> :</td>
            <td style="width: 71%;">
                {{ $dokumen->general_consent ? $dokumen->general_consent->no_identitas : $layanan->ktp}}
            </td>
        </tr>
    </table>
    <br>
    <p>Selaku pasien / Wali hukum di RS Harapan Mulia dengan menyatakan ini persetujuan :</p>
    <p style="font-weight:bold;">1. PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</p>
    <ul id="list_alfabeth">
        <li>Saya/pasien menyetujui untuk perawatan di Rumah Sakit Harapan Mulia sebagai pasien rawat jalan/rawat inap
            tergantung
            kepada kebutuhan medis, meliputi pemeriksaan radiologi, pemeriksaan laboratorium, dan prosedur seperti
            pemasangan infus
            atau suntikan dan evaluasi (misal : wawancara dan pemeriksaan fisik).
        </li>
        <li>Persetujuan saya/pasien berikan tidak termasuk persetujuan untuk prosedur atau tindakan invasif
            (misal : operasi) atau tindakan yang mempunyai resiko tinggi.
        </li>
    </ul>
    <p style="font-weight:bold;">2. PERSETUJUAN PELEPASAN INFORMASI</p>
    <ul id="list_alfabeth">
        <li>Saya/pasien memahami informasi yang ada didalam diri saya/pasien termasuk diagnosis dan hasil
            tes diagnostik yang akan digunakan untuk perawatan medis, Rumah Sakit Harapan Mulia akan menjamin
            kerahasiaannya
        </li>
        <li>Saya/pasien memberikan wewenang kepada Rumah Sakit Harapan Mulia untuk memberikan informasi tentang
            diagnosis,
            hasil pelayanan dan pengobatan saya kepada :
        </li>
        <p>
            {{ $dokumen->general_consent ? $dokumen->general_consent->pi_satu ?  "1. ".$dokumen->general_consent->pi_satu. " Hubungan ".$dokumen->general_consent->hubungan_satu : '' : '' }}
            {{ $dokumen->general_consent ? $dokumen->general_consent->pi_dua ?  "2. ".$dokumen->general_consent->pi_dua. " Hubungan ".$dokumen->general_consent->hubungan_dua : '' : '' }}
            {{ $dokumen->general_consent ? $dokumen->general_consent->pi_tiga ?  "3. ".$dokumen->general_consent->pi_tiga. " Hubungan ".$dokumen->general_consent->hubungan_tiga : '' : '' }}
        </p>
        <li>Saya/pasien memberikan wewenang kepada Rumah Sakit Harapan Mulia untuk memberikan informasi tentang
            diagnosis,
            hasil pelayanan dan pengobatan bila diperlukan untuk proses klaim asuransi atau perusahaan dan/atau
            lembaga pemerintahan.
        </li>
    </ul>
    <p style="font-weight:bold;">3. HAK DAN KEWAJIBAN PASIEN</p>
    <ul id="list_alfabeth">
        <li>Saya/pasien memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit saya dan dalam hal
            perawatan
            medis dan rencana pengobatan.
        </li>
        <li>Saya/pasien telah mendapat informasi tentang "Hak dan Kewajiban Pasien" di Rumah Sakit Harapan Mulia melalui
            leaflet yang disediakan
        </li>
    </ul>
    <p style="font-weight:bold;">4. INFORMASI RAWAT JALAN/RAWAT INAP</p>
    <ul id="list_alfabeth">
        <li>Saya/pasien tidak diperkenankan untuk membawa barang berharga ke ruang rawat jalan/rawat inap jika ada
            anggota keluarga atau teman harus diminta untuk membawa pulang barang berharga tersebut.
        </li>
        <li>Bila tidak ada anggota keluarga, rumah sakit menyediakan tempat penitipan barang milik pasien di tempat
            resmi yang telah disediakan rumah sakit.
        </li>
        <li>Saya telah menerima informasi tentang peraturan yang diberlakukan oleh rumah sakit dan saya beserta
            keluarga bersedia mematuhinya, termasuk akan mematuhi jam berkunjung pasien sesuai dengan aturan di rumah
            sakit.
        </li>
        <li>Anggota keluarga saya yang menunggu saya, bersedia untuk selalu memakai tanda pengenal khusus yang diberikan
            oleh rumah sakit, dan demi keamanan seluruh pasien setiap keluarga dan siapapun yang akan mengunjungi saya
            diluar
            jam berkunjung, bersedia untuk diminta/diperiksa identitasnya dan memakai identitas yang diberikan oleh
            rumah sakit.
        </li>
    </ul>
    <p style="font-weight:bold;">5. PRIVASI</p>
    <p style="padding-left: 18px;">Saya <input type="radio" name="izin"
                                               value="0" <?php if (!is_null($dokumen->general_consent)) {
            echo $dokumen->general_consent->mengijinkan == 0 ? 'checked' : '';
        } ?>> mengizinkan /
        <input type="radio" name="izin" value="1" <?php if (!is_null($dokumen->general_consent)) {
            echo $dokumen->general_consent->mengijinkan == 1 ? 'checked' : '';
        } ?>> tidak mengizinkan* Rumah Sakit memberi akses bagi keluarga dan handaitaulan
        serta orang-orang yang akan menengok saya (sebutkan nama bila ada permintaan khusus yang tidak diizinkan):
        {{ $dokumen->general_consent ? $dokumen->general_consent->keterangan_mengijinkan : '-' }}
    </p>
    <p style="font-weight:bold;">6. INFORMASI BIAYA</p>
    <p style="padding-left: 18px;">
        Saya memahami tentang informasi biaya pengobatan atau biaya pengobatan yang dijelaskan oleh petugas rumah sakit.
    </p>
    <p style="font-weight:bold;">7. PELAYANAN KEROHANIAN</p>
    <ul id="list_alfabeth">
        <li>Menjalankan ibadah sesuai agama atau kepercayaan yang dianutnya selama hal itu tidak mengganggu pasien
            lainnya.
        </li>
        <li>Menolak pelayanan bimbingan rohani yang tidak sesuai agama dan kepercayaan yang dianutnya.</li>
        <li>Informasi tentang pelayanan kerohanian yang berada di Rumah Sakit sesuai dengan agama / kepercayaan pasien,
            dan
            cara pemberian / bimbingan yang disesuaikan dengan fasilitas Rumah Sakit yang tersedia.
        </li>
    </ul>
    <p style="font-weight:bold;">8. PERATURAN RUMAH SAKIT LAINNYA</p>
    <ul id="list_alfabeth">
        <li>Saya/ pasien/ penunggu pasien tersebut diatas, tidak akan merokok di lingkungan Rumah Sakit Harapan Mulia.
        </li>
        <li>Saya/ pasien/ penunggu pasien bersedia mematuhi seluruh peraturan Rumah Sakit.</li>
    </ul>
    <p style="font-weight:bold;">8. TANDA TANGAN</p>
    <p style="padding-left: 18px;">Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah membaca dan
        memahami
        isi Persetujuan Umum (General Consent).</p>
    <div class="row" style="width: 100%; margin-left: 0; font-size:14px; margin-top: -15px">
        <div style="width: 50%; float:left; text-align:center;">
            <p>&nbsp;</p>
            <p>Saksi dari Rumah Sakit</p>
            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 2.5cm; width: 5cm;" alt="">
            <br>{{$dokumen->nama_verifikator}}
        </div>
        <div style="width: 50%; float:left; text-align:center;">
            <p>Bekasi, {{ date('d-m-Y', strtotime($dokumen->tanggal_update)) }}</p>
            <p style="margin-top:-6px;">Pasien / Wali</p>
            <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}" style="height: 2.5cm; width: 5cm;"
                 alt="">
            <br><?php echo $dokumen->general_consent ? $dokumen->general_consent->nama : $dokumen->nama_pasien ?>
        </div>
    </div>
</div>
</body>

</html>
