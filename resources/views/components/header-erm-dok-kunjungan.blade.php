<style>
    @media print {
        body {
            width: 100%;
            font-size: 10pt;
            padding: 0px;
        }

        .inputan {
            border: none !important;
            border-bottom: 1px solid transparent !important;
        }

        #tabel_pemantauan {
            font-size: 10px !important;
        }

        #logo_rshm {
            width: 20% !important;
        }

        @page {
            size: legal;
            margin: 0;
        }

        #gambar_partograf {
            position: absolute;
            top: 265px !important;
            left: 170px !important;
            width: 898px !important;
            height: 1288px !important;
            border: 1px solid;
        }

        #canvas {
            position: absolute;
            top: 265px !important;
            left: 170px !important;
            width: 898px !important;
            height: 1288px !important;
            border: 1px solid;
        }

        .hidden_print {
            display: none;
        }
    }

    #logo_rshm {
        width: 20%;
    }

    .row {
        width: 100%;
        margin-left: 0;
    }

    .col-lg-1 {
        width: 8%;
        float: left;
    }

    .col-lg-2 {
        width: 16%;
        float: left;
    }

    .col-lg-3 {
        width: 25%;
        float: left;
    }

    .col-lg-4 {
        width: 33%;
        float: left;
    }

    .col-lg-5 {
        width: 42%;
        float: left;
    }

    .col-lg-6 {
        width: 50%;
        float: left;
    }

    .col-lg-7 {
        width: 58%;
        float: left;
    }

    .col-lg-8 {
        width: 66%;
        float: left;
    }

    .col-lg-9 {
        width: 75%;
        float: left;
    }

    .col-lg-10 {
        width: 83%;
        float: left;
    }

    .col-lg-11 {
        width: 92%;
        float: left;
    }

    .col-lg-12 {
        width: 100%;
        float: left;
    }

    .inputan {
        border: none;
        border-bottom: 1px solid !important;
    }

    #tabel_header tr td {
        /* width: 10%; */

        padding-left: 5px;
        padding-right: 5px;
    }

    #tabel_header tr:nth-child(even) td {
        padding-top: 5px;
    }

    #title_tabel_3 {
        -webkit-transform: rotate(270deg);
    }
</style>

<div class="row">
    <div class="col-lg-7">
        <img src="{{ asset('filelogo/logo_rshm_tulisan.png') }}" alt="" id="logo_rshm">
        <p style="font-weight: bold; font-size: 12px;">Jl. Raya Cibarusah No. 05 Kebon Kopi, Kel. Cibarusah Jaya, Kec. Cibarusah<br>
            Kab. Bekasi - Jawa Barat (17340)<br>Tlp : (021) 8995 2340, Fax : (021) 8995 2460</p>
    </div>
    <div class="col-lg-5">
        <div style="width: 100%; padding:10px; border: 1px solid; border-radius:10px;">
            <table>
                <tr>
                    <td>Nama</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->nama }}</td>
                </tr>
                <tr>
                    <td>No. RM</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->id }}</td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->kelamin == 0 ? 'Laki-Laki' : ($pasien->kelamin == 1 ? 'Perempuan' : '') }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td class="pl-2 pr-2"> : </td>
                    <td>{{ $pasien->ktp }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>